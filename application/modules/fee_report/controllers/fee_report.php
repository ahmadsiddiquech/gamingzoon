<?php
if ( ! defined('BASEPATH')) 
    exit('No direct script access allowed');
class fee_report extends MX_Controller
{

    function __construct() {
        parent::__construct();
        Modules::run('site_security/is_login');
    }

    function index() {
        $this->create();
    }

    function submit() {
        $form_data['from'] = $this->input->post('from_date');
        $form_data['to'] = $this->input->post('to_date');
        $user_data = $this->session->userdata('user_data');
        $form_data['outlet_id'] = $user_data['outlet_id'];

        $data['report'] = $this->_get_cash_received_report($form_data)->result_array();
        $data['from_date'] = $form_data['from'];
        $data['to_date'] = $form_data['to'];
        $this->load->view('cash_received_print',$data);
    }

    function create() {
        $data['view_file'] = 'newsform';
        $this->load->module('template');
        $this->template->admin($data);
    }

    function cash_summery(){
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $where_org['id'] = $outlet_id;
        $data['org'] = Modules::run('organizations/_get_by_arr_id',$where_org)->result_array();
        $where['account.outlet_id'] = $outlet_id;
        $data['account'] =  Modules::run('account/_get_by_arr_id',$where)->result_array();
        // $data['admin'] = $this->_get_employee_total_payment($outlet_id)->result_array();
        $data['teacher'] = $this->_get_teacher_total_payment($outlet_id)->result_array();
        $this->load->view('cash_summery_print',$data);
    }

    function unpaid_fee(){
        $data['view_file'] = 'unpaid_view';
        $this->load->module('template');
        $this->template->admin($data);
    }

    function unpaid_fee_submit(){
        $from = $this->input->post('from_date');
        if(isset($from) && !empty($from)){
            $from1 = explode("-",$from);
            $data['from_date'] = $from1[0].'/'.$from1[1].'/'.$from1[2];
        }
        $to = $this->input->post('to_date');
        if(isset($to) && !empty($to)){
            $to1 = explode("-",$to);
            $data['to_date'] = $to1[0].'/'.$to1[1].'/'.$to1[2];
        }
        $user_data = $this->session->userdata('user_data');
        $data['outlet_id'] = $user_data['outlet_id'];
        $data['report'] = $this->_get_unpaid_fee_report_print($data)->result_array();
        $this->load->view('unpaid_print',$data);
    }

    function paid_fee(){
        $data['view_file'] = 'paid_view';
        $this->load->module('template');
        $this->template->admin($data);
    }

    function paid_fee_submit(){
        $from = $this->input->post('from_date');
        if(isset($from) && !empty($from)){
            $from1 = explode("-",$from);
            $data['from_date'] = $from1[0].'/'.$from1[1].'/'.$from1[2];
        }
        $to = $this->input->post('to_date');
        if(isset($to) && !empty($to)){
            $to1 = explode("-",$to);
            $data['to_date'] = $to1[0].'/'.$to1[1].'/'.$to1[2];
        }
        $user_data = $this->session->userdata('user_data');
        $data['outlet_id'] = $user_data['outlet_id'];
        $data['report'] = $this->_get_paid_fee_report_print($data)->result_array();
        $this->load->view('paid_print',$data);
    }

    function teacher(){
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $where['users_add.outlet_id'] = $outlet_id;
        $arr_teacher = Modules::run('teacher/_get_by_arr_id',$where)->result_array();
        $data['teacher'] = $arr_teacher;
        $data['view_file'] = 'teacher_view';
        $this->load->module('template');
        $this->template->admin($data);
    }

    function teacher_submit(){
        $teacher_id = $this->input->post('teacher_id');
        if(isset($teacher_id) && !empty($teacher_id)){
            $stdData = explode(",",$teacher_id);
            $data['teacher_id'] = $stdData[0];
            $data['teacher_name'] = $stdData[1];
        }
        $data['from_date'] = $this->input->post('from_date');
        $data['to_date'] = $this->input->post('to_date');
        $user_data = $this->session->userdata('user_data');
        $data['outlet_id'] = $user_data['outlet_id'];
        $data['report'] = $this->_get_teacher_payment_list_print($data)->result_array();
        $this->load->view('teacher_print',$data);
    }

    function teacher_pay_report(){
        $arr_teacher = Modules::run('teacher/_get_by_arr_id_teacher')->result_array();
        $data['teacher'] = $arr_teacher;
        $data['view_file'] = 'teacher_pay_view';
        $this->load->module('template');
        $this->template->admin($data);
    }

    function submit_teacher_pay(){
        $teacher_id = $this->input->post('teacher_id');
        if(isset($teacher_id) && !empty($teacher_id)){
            $stdData = explode(",",$teacher_id);
            $data['teacher_id'] = $stdData[0];
            $data['teacher_namae'] = $stdData[1];
        }
        $data['from_date'] = $this->input->post('from_date');
        $data['to_date'] = $this->input->post('to_date');
        $user_data = $this->session->userdata('user_data');
        $data['outlet_id'] = $user_data['outlet_id'];

        $report1 = $this->_get_teacher_pay_report1($data)->result_array();
        $report2 = $this->_get_teacher_pay_report2($data)->result_array();

        $report = array_merge($report1,$report2);

        function date_compare($element1, $element2) { 
            $datetime1 = strtotime($element1['fee_month']); 
            $datetime2 = strtotime($element2['fee_month']); 
            return $datetime1 - $datetime2; 
        }
        usort($report, 'date_compare');
        // print_r($report);exit();
        $data['report'] = $report;
        $this->load->view('teacher_pay_print',$data);
    }

    function student_fee_report(){
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $where['student.outlet_id'] = $outlet_id;
        $arr_student = Modules::run('student/_get_by_arr_id',$where)->result_array();
        $data['student'] = $arr_student;
        $data['view_file'] = 'student_fee_view';
        $this->load->module('template');
        $this->template->admin($data);
    }

    function student_fee_submit(){
        $student_id = $this->input->post('student_id');
        if(isset($student_id) && !empty($student_id)){
            $stdData = explode(",",$student_id);
            $data['student_id'] = $stdData[0];
            $data['student_name'] = $stdData[1];
        }
        $data['from_date'] = $this->input->post('from_date');
        $data['to_date'] = $this->input->post('to_date');
        $user_data = $this->session->userdata('user_data');
        $data['outlet_id'] = $user_data['outlet_id'];

        $data['report'] = $this->_get_student_fee_report($data)->result_array();
        $this->load->view('student_fee_print',$data);
    }

    function student_test(){
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $where['student.outlet_id'] = $outlet_id;
        $arr_student = Modules::run('student/_get_by_arr_id',$where)->result_array();
        $data['student'] = $arr_student;
        $data['view_file'] = 'student_test_view';
        $this->load->module('template');
        $this->template->admin($data);
    }

    function student_test_submit(){
        $student_id = $this->input->post('student_id');
        if(isset($student_id) && !empty($student_id)){
            $stdData = explode(",",$student_id);
            $data['student_id'] = $stdData[0];
            $data['student_name'] = $stdData[1];
        }
        $data['from_date'] = $this->input->post('from_date');
        $data['to_date'] = $this->input->post('to_date');
        $user_data = $this->session->userdata('user_data');
        $data['outlet_id'] = $user_data['outlet_id'];

        $data['report'] = $this->_get_student_test_print($data)->result_array();
        $this->load->view('student_test_print',$data);
    }

    function employee(){
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $where['account.outlet_id'] = $outlet_id;
        $where1['account.type'] = 'Employee';
        $arr_employee = $this->_get_account_by_type($where1,$where)->result_array();
        
        $data['employee'] = $arr_employee;
        $data['view_file'] = 'employee_view';
        $this->load->module('template');
        $this->template->admin($data);
    }

    function employee_submit(){
        $employee_id = $this->input->post('employee_id');
        if(isset($employee_id) && !empty($employee_id)){
            $stdData = explode(",",$employee_id);
            $data['employee_id'] = $stdData[0];
            $data['employee_name'] = $stdData[1];
        }
        $data['from_date'] = $this->input->post('from_date');
        $data['to_date'] = $this->input->post('to_date');
        $user_data = $this->session->userdata('user_data');
        $data['outlet_id'] = $user_data['outlet_id'];

        $data['report'] = $this->_get_employee_payment_list_print($data)->result_array();
        $this->load->view('employee_print',$data);
    }

    function section_fee(){
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        
        $arr_program = Modules::run('program/_get_by_arr_id_programs',$outlet_id)->result_array();
        $data['programs'] = $arr_program;
        $data['view_file'] = 'section_view';
        $this->load->module('template');
        $this->template->admin($data);
    }

    function section_fee_submit(){
        $section_id = $this->input->post('section_id');
        if(isset($section_id) && !empty($section_id)){
            $stdData = explode(",",$section_id);
            $data['section_id'] = $stdData[0];
            $data['section_name'] = $stdData[1];
        }

        $class_id = $this->input->post('class_id');
        if(isset($class_id) && !empty($class_id)){
            $stdData = explode(",",$class_id);
            $data['class_id'] = $stdData[0];
            $data['class_name'] = $stdData[1];
        }
        $program_id = $this->input->post('program_id');
        if(isset($program_id) && !empty($program_id)){
            $stdData = explode(",",$program_id);
            $data['program_id'] = $stdData[0];
            $data['program_name'] = $stdData[1];
        }

        $from = $this->input->post('from_date');
        if(isset($from) && !empty($from)){
            $from1 = explode("-",$from);
            $data['from_date'] = $from1[0].'/'.$from1[1].'/'.$from1[2];
        }
        $to = $this->input->post('to_date');
        if(isset($to) && !empty($to)){
            $to1 = explode("-",$to);
            $data['to_date'] = $to1[0].'/'.$to1[1].'/'.$to1[2];
        }
        $user_data = $this->session->userdata('user_data');
        $data['outlet_id'] = $user_data['outlet_id'];
        $data['report'] = $this->_get_section_fee_report_print($data)->result_array();
        $this->load->view('section_print',$data);
    }

    function get_class(){
        $program_id = $this->input->post('id');
        if(isset($program_id) && !empty($program_id)){
            $stdData = explode(",",$program_id);
            $program_id = $stdData[0];
        }
        $arr_class = Modules::run('classes/_get_by_arr_id_program',$program_id)->result_array();
        $html='';
        $html.='<option value="">Select</option>';
        foreach ($arr_class as $key => $value) {
            $html.='<option value='.$value['id'].','.$value['name'].'>'.$value['name'].'</option>';
        }
        echo $html;
    }

    function get_section(){
        $class_id = $this->input->post('id');
        if(isset($class_id) && !empty($class_id)){
            $stdData = explode(",",$class_id);
            $class_id = $stdData[0];
        }
        $arr_section = Modules::run('sections/_get_by_arr_id_class',$class_id)->result_array();
        $html='';
        $html.='<option value="">Select</option>';
        foreach ($arr_section as $key => $value) {
            $html.='<option value='.$value['id'].','.$value['section'].'>'.$value['section'].'</option>';
        }
        echo $html;
    }
    

    /////////////////// helper function /////////////////

    function _get_cash_received_report($data){
        $this->load->model('mdl_fee_report');
        return $this->mdl_fee_report->_get_cash_received_report($data);
    }

    function _get_teacher_pay_report1($data){
        $this->load->model('mdl_fee_report');
        return $this->mdl_fee_report->_get_teacher_pay_report1($data);
    }

    function _get_teacher_pay_report2($data){
        $this->load->model('mdl_fee_report');
        return $this->mdl_fee_report->_get_teacher_pay_report2($data);
    }

    function _get_account_by_type($where1,$where){
        $this->load->model('mdl_fee_report');
        return $this->mdl_fee_report->_get_account_by_type($where1,$where);
    }

    function _get_teacher_payment_list_print($data){
        $this->load->model('mdl_fee_report');
        return $this->mdl_fee_report->_get_teacher_payment_list_print($data);
    }

    function _get_employee_payment_list_print($data){
        $this->load->model('mdl_fee_report');
        return $this->mdl_fee_report->_get_employee_payment_list_print($data);
    }

    function _get_section_fee_report_print($data){
        $this->load->model('mdl_fee_report');
        return $this->mdl_fee_report->_get_section_fee_report_print($data);
    }

    function _get_unpaid_fee_report_print($data){
        $this->load->model('mdl_fee_report');
        return $this->mdl_fee_report->_get_unpaid_fee_report_print($data);
    }

    function _get_paid_fee_report_print($data){
        $this->load->model('mdl_fee_report');
        return $this->mdl_fee_report->_get_paid_fee_report_print($data);
    }

    function _get_teacher_total_payment($outlet_id){
        $this->load->model('mdl_fee_report');
        return $this->mdl_fee_report->_get_teacher_total_payment($outlet_id);
    }

    function _get_employee_total_payment($outlet_id){
        $this->load->model('mdl_fee_report');
        return $this->mdl_fee_report->_get_employee_total_payment($outlet_id);
    }

    function _get_student_fee_report($data){
        $this->load->model('mdl_fee_report');
        return $this->mdl_fee_report->_get_student_fee_report($data);
    }

    function _get_student_test_print($data){
        $this->load->model('mdl_fee_report');
        return $this->mdl_fee_report->_get_student_test_print($data);
    }

}