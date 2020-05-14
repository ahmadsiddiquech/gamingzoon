<?php

if ( ! defined('BASEPATH')) 
    exit('No direct script access allowed');

class Account extends MX_Controller
{

    function __construct() {
        parent::__construct();
        Modules::run('site_security/is_login');
    }

    function index() {
        $this->manage();
    }

    function manage() {
        $data['news'] = $this->_get('id desc');
        $data['view_file'] = 'news';
        $this->load->module('template');
        $this->template->admin($data);
    }

    function create() {
        $update_id = $this->uri->segment(4);
        if (is_numeric($update_id) && $update_id != 0) {
            $data['news'] = $this->_get_data_from_db($update_id);
        } else {
            $data['news'] = $this->_get_data_from_post();
        }
        $data['update_id'] = $update_id;
        $data['view_file'] = 'newsform';
        $this->load->module('template');
        $this->template->admin($data);
    }

    function chart_of_account() {
        $account = $this->_get('id desc');
        $data['news'] = $account;
        $data['view_file'] = 'chart_of_account';
        $this->load->module('template');
        $this->template->admin($data);
    }

    function cash_payment() {
        $account = $this->_get('id desc')->result_array();
        $where['designation'] = 'Teacher';
        $teacher = Modules::run('users/_get_where_cols',$where)->result_array();
        $all = array_merge($account,$teacher);
        $data['account_cash'] = $account;
        $data['account'] = $all;
        $data['view_file'] = 'cash_payment';
        $this->load->module('template');
        $this->template->admin($data);
    }

    function submit_cash_payment() {
        $account_from = $this->input->post('account_from');
        if (isset($account_from) && !empty($account_from)) {
            $account_from2=explode(',', $account_from);
            $data['account_from_id'] = $account_from2[0];
            $data['account_from_name'] = $account_from2[1];
            $data['account_from_type'] = $account_from2[2];
            $type_from = $account_from2[2];
        }

        $account_to = $this->input->post('account_to');
        if (isset($account_to) && !empty($account_to)) {
            $account_to2=explode(',', $account_to);
            $data['account_to_id'] = $account_to2[0];
            $data['account_to_name'] = $account_to2[1];
            $data['account_to_type'] = $account_to2[2];
            $type_to = $account_to2[2];
        }
        $data['amount'] = $this->input->post('amount');
        $data['transaction_type'] ='CP';
        $data['ref_no'] = $this->input->post('ref_no');
        $data['pay_date'] = $this->input->post('pay_date');
        $data['pay_month'] = $this->input->post('pay_month');
        $user_data = $this->session->userdata('user_data');
        $data['outlet_id'] = $user_data['outlet_id'];

        if ($type_from == 'Cash-in-hand') {
            $account = $this->_get_account($data['account_from_id'],$type_from)->result_array();
            if ($data['amount'] <= $account[0]['remaining']) {
                $cash['opening_balance'] = $account[0]['opening_balance'] - $data['amount'];
                $cash['remaining'] = $account[0]['remaining'] - $data['amount'];
                $this->_update_account_balance($account[0]['id'],$type_from,$cash);
                $this->_insert_transaction($data);
                $this->session->set_flashdata('success', 'Transaction Successful');
                if ($type_to != 'Teacher') {
                    $account = $this->_get_account($data['account_to_id'],$type_to)->result_array();
                    $cash1['opening_balance'] = $account[0]['opening_balance'] + $data['amount'];
                    $cash1['remaining'] = $account[0]['remaining'] + $data['amount'];
                    $this->_update_account_balance($account[0]['id'],$type_to,$cash1);
                }
                elseif ($type_to == 'Teacher') {
                    $where['id'] = $data['account_to_id'];
                    $teacher_detail = Modules::run('teacher/_get_by_arr_id_teacher',$where)->result_array();
                    $data2['total'] = $teacher_detail[0]['total'] - $data['amount'];
                    $data2['paid'] = $teacher_detail[0]['paid'] + $data['amount'];
                    $data2['remaining'] = $teacher_detail[0]['remaining'] - $data['amount'];
                    $this->_update_teacher_pay($where,$data['outlet_id'],$data2);
                }
            }
            else {
                $this->session->set_flashdata('error', 'Account Limit Exceeded');
            }
        }
        redirect(ADMIN_BASE_URL . 'account/cash_payment');
    }

    function cash_received() {
        $account = $this->_get('id desc')->result_array();
        $subject = $this->_get_student_subject()->result_array();

        $data['subjects'] = $subject;
        $data['account'] = $account;
        $data['view_file'] = 'cash_received';
        $this->load->module('template');
        $this->template->admin($data);
    }

    function add_subject(){
        $subject = $this->input->post('subject');
        $totalIn = $this->input->post('total');
        if(isset($subject) && !empty($subject)){
            $subject1 = explode(",",$subject);
            $subject_id = $subject1[0];
            $subject_name = $subject1[1];
            $class_id = $subject1[2];
            $class_name = $subject1[3];
            $section_id = $subject1[4];
            $section_name = $subject1[5];
            $teacher_id = $subject1[6];
            $teacher_name = $subject1[7];
            $amount = $subject1[8];
            $std_id = $subject1[9];
            $std_name = $subject1[10];
            $parent_id = $subject1[11];
            $parent_name = $subject1[12];
            

        }
        $html='';
        if (isset($subject) && !empty($subject)) {
            $html.='<tr>';
            $html.='<td><input style="text-align: center;" class="form-control" readonly type="text" name="student_list[]" value="'.$std_id.','.$std_name.'"></td>';
            $html.='<td><input style="text-align: center;" class="form-control" readonly type="text" name="parent_list[]" value="'.$parent_id.','.$parent_name.'"></td>';
            $html.='<td><input style="text-align: center;" class="form-control" readonly type="text" name="class_list[]" value="'.$class_id.','.$class_name.'"></td>';
            $html.='<td><input style="text-align: center;" class="form-control" readonly type="text"  name="section_list[]" value="'.$section_id.','.$section_name.'"></td>';            
            $html.='<td><input style="text-align: center;" class="form-control" readonly type="text" name="teacher_list[]" value="'.$teacher_id.','.$teacher_name.'"></td>';
            $html.='<td><input style="text-align: center;" class="form-control" readonly type="text" name="subject_list[]" value="'.$subject_id.','.$subject_name.'"></td>';
            $html.='<td><input style="text-align: center;" class="form-control" readonly type="text" name="amount_list[]" value="'.$amount.'"></td>';
            $html.='<td><a class="btn delete" onclick="delete_row(this)" amount='.$amount.'><i class="fa fa-remove"  title="Delete Item" style="color:red;"></i></a></td>';
            $html.='</tr>';
            $total = $totalIn + $amount;
        }
        else{
            $total = $totalIn;
        }
        $result_array = [$html,$total];
        echo json_encode($result_array);
    }

    function submit_cash_received() {
        $account_to = $this->input->post('account_to');
        if (isset($account_to) && !empty($account_to)) {
            $account_to2=explode(',', $account_to);
            $data['account_to_id'] = $account_to2[0];
            $data['account_to_name'] = $account_to2[1];
            $data['account_to_type'] = $account_to2[2];
            $type_to = $account_to2[2];
        }
        $data['total'] = $this->input->post('total');
        $data['paid'] = $this->input->post('paid');
        $data['remaining'] = $data['total'];
        $data['comment'] = $this->input->post('comment');
        $data['fee_issue_date'] = $this->input->post('fee_issue_date');
        $data['fee_month'] = $this->input->post('fee_month');
        $user_data = $this->session->userdata('user_data');
        $data['outlet_id'] = $user_data['outlet_id'];

        $c_r_id = $this->_insert_cash_received($data);

        $this->insert_cash_received_details($c_r_id,$data['outlet_id']);

        if ($type_to == 'Cash-in-hand') {
            $account = $this->_get_account($data['account_to_id'],$type_to)->result_array();
            $cash['opening_balance'] = $account[0]['opening_balance'] + $data['total'];
            $cash['remaining'] = $account[0]['remaining'] + $data['total'];
            $this->_update_account_balance($account[0]['id'],$type_to,$cash);
        }
        redirect(ADMIN_BASE_URL . 'account/print_cash_received/'.$c_r_id);
    }

    function print_cash_received($c_r_id){
        $c_r_id = $this->uri->segment(4);
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $data['invoice'] = $this->_get_invoice_data($c_r_id,$outlet_id)->result_array();
        $this->load->view('print',$data);
    }

    function insert_cash_received_details($c_r_id,$outlet_id){
        $subject_list = $this->input->post('subject_list');
        $student_list = $this->input->post('student_list');
        $parent_list = $this->input->post('parent_list');
        $class_list = $this->input->post('class_list');
        $section_list = $this->input->post('section_list');
        $teacher_list = $this->input->post('teacher_list');
        $amount_list = $this->input->post('amount_list');
        $counter = 0;
        foreach ($subject_list as $key => $value) {
            $data = array();
            unset($data); 
            $data = array();
            $subject_list2=explode(',', $subject_list[$counter]);
            $subject_id = $subject_list2[0];
            $subject_name = $subject_list2[1];

            $class_list2=explode(',', $class_list[$counter]);
            $class_id = $class_list2[0];
            $class_name = $class_list2[1];

            $section_list2=explode(',', $section_list[$counter]);
            $section_id = $section_list2[0];
            $section_name = $section_list2[1];

            $teacher_list2=explode(',', $teacher_list[$counter]);
            $teacher_id = $teacher_list2[0];
            $teacher_name = $teacher_list2[1];

            $student_list2=explode(',', $student_list[$counter]);
            $student_id = $student_list2[0];
            $student_name = $student_list2[1];

            $parent_list2=explode(',', $parent_list[$counter]);
            $parent_id = $parent_list2[0];
            $parent_name = $parent_list2[1];

            $data['c_r_id'] = $c_r_id;
            $data['std_id'] = $student_id;
            $data['std_name'] = $student_name;
            $data['parent_id'] = $parent_id;
            $data['parent_name'] = $parent_name;
            $data['subject_id'] = $subject_id;
            $data['subject_name'] = $subject_name;
            $data['class_id'] = $class_id;
            $data['class_name'] = $class_name;
            $data['section_id'] = $section_id;
            $data['section_name'] = $section_name;
            $data['teacher_id'] = $teacher_id;
            $data['teacher_name'] = $teacher_name;
            $data['outlet_id'] = $outlet_id;
            $data['amount'] = $amount_list[$counter];
            $where['id'] = $data['teacher_id'];
            $teacher_detail = $this->_get_teacher_cut_subject($data['teacher_id'],$data['subject_id'],$data['outlet_id'])->result_array();
            foreach ($teacher_detail as $key => $value) {
                $data2['total'] = $value['total'] + ($data['amount']*($value['cut']/100));
                $data2['remaining'] = $value['remaining'] + $data2['total'];
                $data['teacher_share'] = $data['amount']*($value['cut']/100);
            }
            $this->_update_teacher_pay($where,$outlet_id,$data2);

            $counter++;
            if(!empty($data)){
                $this->_insert_cash_received_details($data);
                
            }
        }
    }


    function transaction_list() {
        $data['news'] = $this->_get_transaction_list();
        $data['view_file'] = 'transaction_list';
        $this->load->module('template');
        $this->template->admin($data);
    }
    

    function _get_data_from_db($update_id) {
        $where['account.id'] = $update_id;
        $query = $this->_get_by_arr_id($where);
        foreach ($query->result() as
                $row) {
            $data['id'] = $row->id;
            $data['name'] = $row->name;
            $data['comment'] = $row->comment;
            $data['opening_balance'] = $row->opening_balance;
            $data['paid'] = $row->paid;
            $data['remaining'] = $row->remaining;
            $data['type'] = $row->type;
            $data['status'] = $row->status;
            $data['outlet_id'] = $row->outlet_id;
        }
        if(isset($data))
            return $data;
    }
    
    function _get_data_from_post() {
        $data['name'] = $this->input->post('name');
        $data['type'] = $this->input->post('type');
        $data['opening_balance'] = $this->input->post('opening_balance');
        $data['date'] = date('Y-m-d');
        $data['paid'] = $this->input->post('paid');
        $data['remaining'] = $data['opening_balance'] - $data['paid'];
        $data['comment'] = $this->input->post('comment');
        $user_data = $this->session->userdata('user_data');
        $data['outlet_id'] = $user_data['outlet_id'];
        return $data;

    }

    function submit() {
        $update_id = $this->uri->segment(4);
        $data = $this->_get_data_from_post();
        $user_data = $this->session->userdata('user_data');

        if ($update_id != 0) {
            $id = $this->_update($update_id,$user_data['outlet_id'], $data);
        }
        else
        {
            $id = $this->_insert($data);
        }
            $this->session->set_flashdata('message', 'account'.' '.DATA_SAVED);
	        $this->session->set_flashdata('status', 'success');
        redirect(ADMIN_BASE_URL . 'account');
    }

    function check_cash_in_hand(){
    $type = $this->input->post('type');
    $query = $this->_check_cash_in_hand($type);
        if ($query->num_rows() > 0){
            echo '1';
        }
        else{
            echo '0';
        }
    }

    function delete() {
        $delete_id = $this->input->post('id');
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $this->_delete($delete_id, $outlet_id);
    }
    

///////////////////////////     HELPER FUNCTIONS    ////////////////////

    function _delete($arr_col, $outlet_id) {       
        $this->load->model('mdl_account');
        $this->mdl_account->_delete($arr_col, $outlet_id);
    }

    function _update($arr_col, $outlet_id, $data) {
        $this->load->model('mdl_account');
        $this->mdl_account->_update($arr_col, $outlet_id, $data);
    }

    function _get($order_by) {
        $this->load->model('mdl_account');
        return $this->mdl_account->_get($order_by);
    }

    function _get_student_subject() {
        $this->load->model('mdl_account');
        return $this->mdl_account->_get_student_subject();
    }

    function _get_for_cash_recieved($order_by){
        $this->load->model('mdl_account');
        return $this->mdl_account->_get_for_cash_recieved($order_by);
    }

    function _get_chart_of_account($order_by){
        $this->load->model('mdl_account');
        return $this->mdl_account->_get_chart_of_account($order_by);
    }

    function _get_by_arr_id($arr_col) {
        $this->load->model('mdl_account');
        return $this->mdl_account->_get_by_arr_id($arr_col);
    }

    function _insert($data) {
        $this->load->model('mdl_account');
        return $this->mdl_account->_insert($data);
    }

    function _insert_transaction($data) {
        $this->load->model('mdl_account');
        return $this->mdl_account->_insert_transaction($data);
    }

    function _insert_cash_received($data) {
        $this->load->model('mdl_account');
        return $this->mdl_account->_insert_cash_received($data);
    }

    function _insert_cash_received_details($data){
        $this->load->model('mdl_account');
        $this->mdl_account->_insert_cash_received_details($data);
    }

    function _update_teacher_pay($where,$outlet_id,$data2){
        $this->load->model('mdl_account');
        $this->mdl_account->_update_teacher_pay($where,$outlet_id,$data2);
    }

    function _get_teacher_cut_subject($teacher_id,$subject_id,$outlet_id){
        $this->load->model('mdl_account');
        return $this->mdl_account->_get_teacher_cut_subject($teacher_id,$subject_id,$outlet_id);
    }

    function _get_transaction_list() {
        $this->load->model('mdl_account');
        return $this->mdl_account->_get_transaction_list();
    }

    function _check_cash_in_hand($type){
        $this->load->model('mdl_account');
        return $this->mdl_account->_check_cash_in_hand($type);
    }

    function _update_cash_in_hand($data) {
        $this->load->model('mdl_account');
        return $this->mdl_account->_update_cash_in_hand($data);
    }

    function _update_cash($type,$data) {
        $this->load->model('mdl_account');
        return $this->mdl_account->_update_cash($type,$data);
    }

    function _get_cash_in_hand() {
        $this->load->model('mdl_account');
        return $this->mdl_account->_get_cash_in_hand();
    }

    function _get_account_balance($type){
        $this->load->model('mdl_account');
        return $this->mdl_account->_get_account_balance($type);
    }

    function _update_account_balance($id,$type,$data){
        $this->load->model('mdl_account');
        return $this->mdl_account->_update_account_balance($id,$type,$data);
    }

    function _get_account($id,$type){
        $this->load->model('mdl_account');
        return $this->mdl_account->_get_account($id,$type);
    }

    function _get_invoice_data($c_r_id,$outlet_id){
        $this->load->model('mdl_account');
        return $this->mdl_account->_get_invoice_data($c_r_id,$outlet_id);
    }
}