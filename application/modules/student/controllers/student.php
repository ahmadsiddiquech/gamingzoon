<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Student extends MX_Controller
{

function __construct() {
parent::__construct();
Modules::run('site_security/is_login');
Modules::run('site_security/has_permission');

}

    function index() {
        $this->manage();
    }

    function manage() {
        $data['news'] = $this->_get('student.id desc');
        $data['view_file'] = 'news';
        $this->load->module('template');
        $this->template->admin($data);
    }

    function create() {
        $update_id = $this->uri->segment(4);
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        if (is_numeric($update_id) && $update_id != 0) {
            $data['news'] = $this->_get_data_from_db($update_id);
           
        } else {
            $data['news'] = $this->_get_data_from_post();
        }
        $data['update_id'] = $update_id;
        $where['designation'] = 'Parent';
        $arr_parent = Modules::run('users/_get_where_cols',$where)->result_array();

        $subject = $this->_get_subject_teacher_detail($outlet_id)->result_array();

        $user_data = $this->session->userdata('user_data');
        $arrWhere['outlet_id'] = $user_data['outlet_id'];
        $arr_roles = Modules::run('roles/_get_by_arr_id',$arrWhere)->result_array();
        $roles = array();
        foreach($arr_roles as $row){
            if($row['role'] == 'student' || $row['role'] == 'Student'){
                $roles[$row['id']] = $row['role'];
            }
        }
       
        $data['roles_title'] = $roles;
        $data['subjects'] = $subject;
        $data['parent'] = $arr_parent;
        $data['view_file'] = 'newsform';
        $this->load->module('template');
        $this->template->admin($data);
    }

    
    function _get_data_from_db($update_id) {
        $where['student.id'] = $update_id;
        $query = $this->_get_by_arr_id($where);
        foreach ($query->result() as
                $row) {
            $data['id'] = $row->id;
            $data['full_name'] = $row->full_name;
            $data['user_name'] = $row->user_name;
            $data['password'] = $row->password;
            $data['parent_id'] = $row->parent_id;
            $data['parent_name'] = $row->parent_name;
            $data['p_c_no'] = $row->p_c_no;
            $data['gender'] = $row->gender;
            $data['dob'] = $row->dob;
            $data['address'] = $row->address;
            $data['addmission_date'] = $row->addmission_date;
            $data['total'] = $row->total;
            $data['paid'] = $row->paid;
            $data['remaining'] = $row->remaining;
            $data['image'] = $row->image;
            $data['status'] = $row->status;
            $data['outlet_id'] = $row->outlet_id;
            $data['role_id'] = $row->role_id;
            $data['name_school'] = $row->name_school;
            $data['last_class'] = $row->last_class;
            $data['year'] = $row->year;
            $data['obt_marks'] = $row->obt_marks;
            $data['percentage'] = $row->percentage;
        }
        if(isset($data))
            return $data;
    }
    
    function _get_data_from_post() {
        $data['user_name'] = $this->input->post('user_name');
        $data['full_name'] = $this->input->post('full_name');
        $parent_id = $this->input->post('parent_id');
        if (isset($parent_id) && !empty($parent_id)) {
            $parent_id2=explode(',', $parent_id);
            $data['parent_id'] = $parent_id2[0];
            $data['parent_name'] = $parent_id2[1];
            $data['p_c_no'] = $parent_id2[2];
        }
        $data['name_school'] = $this->input->post('name_school');
        $data['last_class'] = $this->input->post('last_class');
        $data['year'] = $this->input->post('year');
        $data['obt_marks'] = $this->input->post('obt_marks');
        $data['percentage'] = $this->input->post('percentage');
        $data['dob'] = $this->input->post('dob');
        $data['gender'] = $this->input->post('gender');
        $data['address'] = $this->input->post('address');
        $data['addmission_date'] = $this->input->post('addmission_date');
        $data['password'] =  $this->hashpassword($this->input->post('password'));
        $data['total'] = $this->input->post('total');
        $data['paid'] = '0';
        $data['remaining'] = $data['total'];
        $data['role_id'] = $this->input->post('role_id');
        $user_data = $this->session->userdata('user_data');
        $data['outlet_id'] = $user_data['outlet_id'];
        return $data;

    }
    function hashpassword($password) {
        return md5($password);
    }

    function submit() {
            $update_id = $this->uri->segment(4);
            $data = $this->_get_data_from_post();
            $user_data = $this->session->userdata('user_data');
            if ($update_id != 0) {
                $itemInfo = $this->_getItemById($update_id);
                $actual_img_old = FCPATH . 'uploads/student/actual_images/' . $itemInfo->image;
                $medium_img_old = FCPATH . 'uploads/student/medium_images/' . $itemInfo->image;
                $large_img_old = FCPATH . 'uploads/student/large_images/' . $itemInfo->image;
                if (isset($_FILES['news_file']['name']) && !empty($_FILES['news_file']['name'])) {
                    if (file_exists($actual_img_old))
                        unlink($actual_img_old);
                    if (file_exists($medium_img_old))
                        unlink($medium_img_old);
                    if (file_exists($large_img_old))
                        unlink($large_img_old);
                    $this->upload_image($update_id,$user_data['outlet_id']);
                }
                $this->_update($update_id,$user_data['outlet_id'], $data);
            }
            else
            {
                $data2['user_name'] = $data['user_name'];
                $data2['outlet_id'] = $data['outlet_id'];
                $data2['role_id'] = $data['role_id'];
                $return = $this->_insert_username($data2);
                $id = $this->_insert($data);
                $this->insert_subject($id,$data['name']);
                $this->upload_image($id,$user_data['outlet_id']);
            }
                $this->session->set_flashdata('message', 'student'.' '.DATA_SAVED);										
		        $this->session->set_flashdata('status', 'success');
            
            redirect(ADMIN_BASE_URL . 'student');
    }

    function insert_subject($std_id,$std_name){
        $subject_list = $this->input->post('subject_list');
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

            $data['std_id'] = $std_id;
            $data['std_name'] = $std_name;
            $data['subject_id'] = $subject_id;
            $data['subject_name'] = $subject_name;
            $data['class_id'] = $class_id;
            $data['class_name'] = $class_name;
            $data['section_id'] = $section_id;
            $data['section_name'] = $section_name;
            $data['teacher_id'] = $teacher_id;
            $data['teacher_name'] = $teacher_name;
            $data['amount'] = $amount_list[$counter];
            $counter++;
            if(!empty($data)){
                $this->_insert_subject($data);
            }
        }
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

        }
        $html='';
        if (isset($subject) && !empty($subject)) {
            $html.='<tr>';
            $html.='<td><input style="text-align: center;" class="form-control" readonly type="text" name="subject_list[]" value="'.$subject_id.','.$subject_name.'"></td>';
            $html.='<td><input style="text-align: center;" class="form-control" readonly type="text" name="class_list[]" value="'.$class_id.','.$class_name.'"></td>';
            $html.='<td><input style="text-align: center;" class="form-control" readonly type="text"  name="section_list[]" value="'.$section_id.','.$section_name.'"></td>';
            $html.='<td><input style="text-align: center;" class="form-control" readonly type="text" name="teacher_list[]" value="'.$teacher_id.','.$teacher_name.'"></td>';
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

    function change_password() {
    $update_id = $this->input->post('id');
    $data['news'] = $this->_get_data_from_db($update_id);
    $data['update_id'] = $update_id;
    $this->load->view('password_form', $data);
}
    function change_pass() {  
            $update_id = $this->uri->segment(4);
            $data = $this->_get_data_from_post_password();
            
            if ($update_id && $update_id != 0) {
                    $id = $update_id;
                   
                    $this->_update_id($id, $data);
                        
                        $this->session->set_flashdata('message', 'Password'.' '.'updated successfully');                                     
                        $this->session->set_flashdata('status', 'success');
                    
                }
        
            redirect(ADMIN_BASE_URL . 'users');
    }
    function _get_data_from_post_password() {
        $data['user_name'] = $this->input->post('user_name');
        $data['password'] =  $this->hashpassword($this->input->post('password'));
        return $data;
    }


    function get_class(){
        $program_id = $this->input->post('id');
        $arr_class = Modules::run('classes/_get_by_arr_id_program',$program_id)->result_array();
        $html='';
        $html.='<option value="">Select</option>';
        foreach ($arr_class as $key => $value) {
            $html.='<option value='.$value['id'].'>'.$value['name'].'</option>';
        }
        echo $html;
    }
    function get_subject(){
        $section_id = $this->input->post('id');
        $arr_subject = Modules::run('subjects/_get_by_arr_id_subject',$section_id)->result_array();
        $html='';
        $html.='<option value="">Select</option>';
        foreach ($arr_subject as $key => $value) {
            $html.='<option value='.$value['subject_id'].'>'.$value['subject_name'].'</option>';
        }
        echo $html;
    }

    function get_section(){
        $class_id = $this->input->post('id');
        $arr_class = Modules::run('sections/_get_by_arr_id_class',$class_id)->result_array();
        $html='';
        $html.='<option value="">Select</option>';
        foreach ($arr_class as $key => $value) {
            $html.='<option value='.$value['id'].'>'.$value['section'].'</option>';
        }
        echo $html;
    }
    function delete() {
        $delete_id = $this->input->post('id');
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $itemInfo = $this->_getItemById($delete_id);
        $file = $itemInfo->image;
        unlink('./uploads/student/medium_images/' . $file);
        unlink('./uploads/student/large_images/' . $file);
        unlink('./uploads/student/actual_images/' . $file);
        $this->_delete($delete_id, $outlet_id);
    }

    function set_publish() {
        $update_id = $this->uri->segment(4);
        $where['id'] = $update_id;
        $this->_set_publish($where);
        $this->session->set_flashdata('message', 'Post published successfully.');
        redirect(ADMIN_BASE_URL . 'student/manage/' . '');
    }

    function set_unpublish() {
        $update_id = $this->uri->segment(4);
        $where['id'] = $update_id;
        $this->_set_unpublish($where);
        $this->session->set_flashdata('message', 'Post un-published successfully.');
        redirect(ADMIN_BASE_URL . 'student/manage/' . '');
    }


    function upload_image($nId, $outlet_id) {
        $upload_image_file = $this->input->post('hdn_image');
        if(isset($upload_image_file) && !empty($upload_image_file)){
            $upload_image_file = str_replace(' ', '_', $upload_image_file);
            $file_name = 'student_' . $nId.'_'.$outlet_id . '_' . $upload_image_file;
        }
        else{
            $file_name = '';
        }
        $config['upload_path'] = './uploads/student/actual_images';
        $config['allowed_types'] = '*';
        $config['max_size'] = '20000';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['file_name'] = $file_name;
        $this->load->library('upload');
        $this->upload->initialize($config);
        if (isset($_FILES['news_file'])) {
            $this->upload->do_upload('news_file');
        }
        $upload_data = $this->upload->data();

        /////////////// Large  Image ////////////////
        $config['source_image'] = $upload_data['full_path'];
        $config['image_library'] = 'gd2';
        $config['maintain_ratio'] = true;
        $config['width'] = 500;
        $config['height'] = 400;
        $config['new_image'] = './uploads/student/large_images';
        $this->load->library('image_lib');
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->clear();

        /////////////  Medium Size /////////////////// 
        $config['source_image'] = $upload_data['full_path'];
        $config['image_library'] = 'gd2';
        $config['maintain_ratio'] = true;
        $config['width'] = 300;
        $config['height'] = 200;
        $config['new_image'] = './uploads/student/medium_images';
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->clear();

        ////////////////////// Small Size ////////////////
        $config['source_image'] = $upload_data['full_path'];
        $config['image_library'] = 'gd2';
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 100;
        $config['height'] = 100;
        $config['new_image'] = './uploads/student/small_images';
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->clear();
        $data = array('image' => $file_name);
        // $where['id'] = $nId;
        $rsItem = $this->_update($nId, $outlet_id, $data);
        if ($rsItem)
            return true;
        else
            return false;
    }
   

    function change_status() {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        if ($status == PUBLISHED)
            $status = UN_PUBLISHED;
        else
            $status = PUBLISHED;
        $data = array('status' => $status);
        $status = $this->_update_id($id, $data);
        echo $status;
    }

    /////////////// for detail ////////////
    function detail() {
        $update_id = $this->input->post('id');
        $data['user'] = $this->_get_data_from_db($update_id);
        $where['std_id'] = $update_id;
        $data['subject'] = $this->_get_student_subjects($where)->result_array();
        $this->load->view('detail', $data);
    }
	
    function _getItemById($id) {
        $this->load->model('mdl_student');
        return $this->mdl_student->_getItemById($id);
    }

    function _get_student_subjects($where) {
        $this->load->model('mdl_student');
        return $this->mdl_student->_get_student_subjects($where);
    }


    function _set_publish($arr_col) {
        $this->load->model('mdl_student');
        $this->mdl_student->_set_publish($arr_col);
    }

    function _set_unpublish($arr_col) {
        $this->load->model('mdl_student');
        $this->mdl_student->_set_unpublish($arr_col);
    }

    function _get($order_by) {
        $this->load->model('mdl_student');
        return $this->mdl_student->_get($order_by);
    }

    function _get_by_arr_id($arr_col) {
        $this->load->model('mdl_student');
        return $this->mdl_student->_get_by_arr_id($arr_col);
    }


    function _insert($data) {
        $this->load->model('mdl_student');
        return $this->mdl_student->_insert($data);
    }
    function _insert_username($data2) {
        $this->load->model('mdl_student');
        return $this->mdl_student->_insert_username($data2);
    }

    function _update($arr_col, $outlet_id, $data) {
        $this->load->model('mdl_student');
        $this->mdl_student->_update($arr_col, $outlet_id, $data);
    }

    function _update_id($id, $data) {
        $this->load->model('mdl_student');
        $this->mdl_student->_update_id($id, $data);
    }

    function _delete($arr_col, $outlet_id) {       
        $this->load->model('mdl_student');
        $this->mdl_student->_delete($arr_col, $outlet_id);
    }

    function _get_by_arr_id_section($section_id){
        $this->load->model('mdl_student');
        return $this->mdl_student->_get_by_arr_id_section($section_id);
    }


    function _get_subject_teacher_detail($where){
        $this->load->model('mdl_student');
        return $this->mdl_student->_get_subject_teacher_detail($where);
    }

    function _insert_subject($data){
        $this->load->model('mdl_student');
        $this->mdl_student->_insert_subject($data);
    }
}