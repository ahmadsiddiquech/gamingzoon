<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Template extends MX_Controller {
	
	function __construct(){
		parent::__construct();
	}
	
	function admin($data){
		$data['user_data'] = $user_data = $this->session->userdata('user_data');
		$role_id = 0;
		if (isset($user_data['role_id']) && !empty($user_data['role_id']))
			$role_id = $user_data['role_id'];
		$data['role_id'] = $role_id;
		$arr_outlet = Modules::run('outlet/_get','id asc')->result_array();
		$outlet = array();
		foreach($arr_outlet as $row){
            $outlet[$row['id']] = $row['building_name'];   
        }
        $data['outlet_title'] = $outlet;
		$this->load->view('admin/theme1/admin',$data);
	}
	function index(){
		$this->load->view('theme1');
	}
	function front($data){
        $top_panel_pages = Modules::run('webpages/_get_toppanel_pages')->result_array();
        $data['top_panel_pages'] = $top_panel_pages;
        $show_footer = 1;
		$data['contact'] = Modules::run('outlet/_get_contact', DEFAULT_OUTLET)->result_array();
		$page= $this->uri->segment(1);
		if ($page == '')
			$page = 'home';
		$this->load->view('front/theme1/front',$data);	
	}

	function change_outlet_id(){
		$outlet_id = $this->input->post('id');
		$data = $this->session->userdata('user_data');
		$data['outlet_id'] = $outlet_id;
		$this->session->set_userdata('user_data', $data);
		print_r($data);exit();

	}
}
