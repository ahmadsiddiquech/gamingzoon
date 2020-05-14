<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class users extends MX_Controller
{

function __construct() {
parent::__construct();
// Modules::run('site_security/is_login');
// Modules::run('site_security/has_permission');
}

function index(){
    $this->manage_record();
	
 }

function manage_record() {
		$data['users_rec'] = $this->_get()->result_array();
		$data['view_file'] = 'users_listing';
        $this->load->module('template');
        $this->template->admin($data);
}

function create(){		
      
        $update_id = $this->uri->segment(4);
         if ($update_id && $update_id != 0) {

            $data['users'] = $this->_get_data_from_db($update_id);
			
			
        } else {
            $data['users'] = $this->_get_data_from_post();
        }
	
        $data['update_id'] = $update_id; 
        $user_data = $this->session->userdata('user_data');
		$arrWhere['outlet_id'] = $user_data['outlet_id'];
        $arr_roles = Modules::run('roles/_get_by_arr_id',$arrWhere)->result_array();
		$roles = array();
        foreach($arr_roles as $row){
            $roles[$row['id']] = $row['role'];
			
        }
       
		$data['roles_title'] = $roles;
		
        $data['view_file'] = 'users_form';
        $this->load->module('template');
        $this->template->admin($data);
}

function submit() {
            $update_id = $this->uri->segment(4);
            $data = $this->_get_data_from_post();
            
            if ($update_id && $update_id != 0) {
                    $where['id'] = $update_id;
                    $itemInfo = $this->_getItemById($update_id);
                    $this->_update($where, $data);
						$this->session->set_flashdata('message', 'user'.' '.DATA_UPDATED);										
		                $this->session->set_flashdata('status', 'success');
                    
                }
            else {
                $data = $this->_get_data_from_post();
                $id = $this->_insert($data);
				$this->session->set_flashdata('message', 'user'.' '.DATA_SAVED);										
		        $this->session->set_flashdata('status', 'success');
                $data['users'] = $this->_get()->result_array();
                $data['view_file'] = 'users_listing';
                $this->load->module('template');
                $this->template->admin($data);
            }
        
            redirect(ADMIN_BASE_URL . 'users');
    }

function _get_data_from_db($update_id) {
        $where['id'] = $update_id;
        $query = $this->_get_by_arr_id($where);
        foreach ($query->result() as
                $row) {
            $data['user_name'] = $row->user_name;
            $data['designation'] = $row->designation;
            $data['country'] = $row->country;
            $data['full_name'] = $row->full_name;
            $data['phone'] = $row->phone;
            $data['address1'] = $row->address1;
            $data['address2'] = $row->address2;
            $data['city'] = $row->city;
            $data['email'] = $row->email;
            $data['country'] = $row->country;
            $data['state'] = $row->state;
            $data['password'] = $row->password;
			$data['role_id'] = $row->role_id;
        }
        return $data;
    }
function change_password() {
    $update_id = $this->input->post('id');
    $data['users'] = $this->_get_data_from_db($update_id);
    $data['update_id'] = $update_id;
    $this->load->view('password_form', $data);
}
function validate (){
    $user_name = $this->input->post('user_name');
    $id = DEFAULT_OUTLET;
  //  echo $user_name.$id; exit();
  $query = $this->_get_where_validate($id,$user_name);
 //print 'rows here '.$query->num_rows();exit;
 //echo  $query->num_rows();
 if ($query->num_rows() > 0) echo '1';
 else echo '0';

}
function _get_data_from_post() {
        $user_data = $this->session->userdata('user_data');
		$data['user_name'] = $this->input->post('user_name');
        $data['designation'] = $this->input->post('designation');
		$data['country'] = $this->input->post('country');
		$data['state'] = $this->input->post('state');
		$data['city'] = $this->input->post('city');
		$data['address1'] = $this->input->post('address1');
		$data['phone'] = $this->input->post('phone');
		$data['email'] = $this->input->post('email');
		$data['mobile'] = $this->input->post('mobile');
		$data['address2'] = $this->input->post('address2');
        $data['full_name'] = $this->input->post('full_name');
        $data['password'] =  $this->hashpassword($this->input->post('password'));
		$data['role_id'] = $this->input->post('role_id'); 
		$data['outlet_id'] = $user_data['outlet_id'];
        $data['status'] = 1;
     
        return $data;
    }

function delete(){
        $id = $this->input->post('id');
        $this->load->model('mdl_users');
        $this->mdl_users->_delete($id);
    }
    function change_pass() {  
            $update_id = $this->uri->segment(4);
            $data = $this->_get_data_from_post_password();
            
            if ($update_id && $update_id != 0) {
                    $where['id'] = $update_id;
                   
                    $this->_update($where, $data);
                        
                        $this->session->set_flashdata('message', 'Password'.' '.'updated successfully');                                     
                        $this->session->set_flashdata('status', 'success');
                    
                }
        
            redirect(ADMIN_BASE_URL . 'users');
    }

    function hashpassword($password) {
        return md5($password);
    }
function _get_data_from_post_password() {
        $data['user_name'] = $this->input->post('user_name');
        $data['password'] =  $this->hashpassword($this->input->post('password'));
        return $data;
    }
	
	function load_listing() {
		
		$data['users_rec'] = $this->_get_by_arr_id($where)->result_array();
        $this->load->view('users_load_listing',$data);      
}
function change_status_event() {
    $id = $this->input->post('id');
    $status = $this->input->post('status');
    echo $status; 
    if ($status == 1)
      {  echo "one";
        $status = 0; }
    else
         {  echo "two";
        $status = 1; }
    $data = array('status' => $status);
    $status = $this->_update_status_event($id, $data);
    echo $status;
    exit;
}



 /////////////// for detail ////////////
function detail() {
    $update_id = $this->input->post('id');
    $data['users_res'] = $this->_get_data_from_db($update_id);
    $data['update_id'] = $update_id;
    $this->load->view('detail', $data);
}

////////////////////////////////////////////////
function _get($order_by='id asc'){
$this->load->model('mdl_users');
$query = $this->mdl_users->_get($order_by);
return $query;
}

function _get_with_limit($limit, $offset, $order_by='id asc') {
$this->load->model('mdl_users');
$query = $this->mdl_users->_get_with_limit($limit, $offset, $order_by);
return $query;
}

function _getItemById($id) {
$this->load->model('mdl_users');
return $this->mdl_users->_getItemById($id);
}

function _get_by_arr_id($arr_col) {
$this->load->model('mdl_users');
return $this->mdl_users->_get_by_arr_id($arr_col);
}

function _get_zabiha($table , $distance, $longitude, $latitude) {
$this->load->model('mdl_users');
return $this->mdl_users->_get_zabiha($table , $distance, $longitude, $latitude);
}

function _get_where($id){
$this->load->model('mdl_users');
$query = $this->mdl_users->_get_where($id);
return $query;
}

function _get_where_login($username , $password){
$this->load->model('mdl_users');
$query = $this->mdl_users->_get_where_login($username,$password);
return $query;
}

function _get_where_user($id){
$this->load->model('mdl_users');
$query = $this->mdl_users->_get_where_user($id);
return $query;
}
function _get_where_validate($id,$user_name){
$this->load->model('mdl_users');
$query = $this->mdl_users->_get_where_validate($id,$user_name);
return $query;
}

function _get_where_cols($cols,$order_by='id asc'){
$this->load->model('mdl_users');
$query = $this->mdl_users->_get_where_cols($cols,$order_by);
return $query;
}

function _get_where_custom($col, $value,$order_by='id asc') {
   // print '<br>this =====controler ====>>';exit;
$this->load->model('mdl_users');
$query = $this->mdl_users->_get_where_custom($col, $value,$order_by);
return $query;
}
function _update_status_event($id, $data) {
    $this->load->model('mdl_users');
    $this->mdl_users->_update_id($id, $data);
}
function _insert($data){
$this->load->model('mdl_users');
return $this->mdl_users->_insert($data);
}

function _update_status_news($id, $data) {
    $this->load->model('mdl_users');
    $this->mdl_users->_update_id($id, $data);
}

function _update($arr_col, $data) {
$this->load->model('mdl_users');
$this->mdl_users->_update($arr_col, $data);
}

function _update_where_cols($cols, $data){
$this->load->model('mdl_users');
$this->mdl_users->_update_where_cols($cols, $data);
}



function _count_where($column, $value) {
$this->load->model('mdl_users');
$count = $this->mdl_users->_count_where($column, $value);
return $count;
}

function _get_max() {
$this->load->model('mdl_users');
$max_id = $this->mdl_users->_get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_users');
$query = $this->mdl_users->_custom_query($mysql_query);
return $query;
}

}