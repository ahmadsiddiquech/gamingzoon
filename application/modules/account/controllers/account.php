<?php 
if ( ! defined('BASEPATH')) 
    exit('No direct script access allowed');

class Account extends MX_Controller {
    function __construct() {
        parent::__construct();
        Modules::run('site_security/is_login_gamer');
    }
////////////////////////// FOR HOME PAGE /////////////////////


    function index() {
        $data['view_file'] = 'index';
        $data['module'] = 'account';
        $data['header_file'] = 'header';
        $data['footer_file'] = 'footer';
        $this->load->module('template');
        $this->template->front($data);
    }

    function profile() {
        $gamers_data = $this->session->userdata('gamers_data');
        $data['news'] = $this->_get($gamers_data['user_id'])->result_array();
        $data['view_file'] = 'profile';
        $data['module'] = 'account';
        $data['header_file'] = 'header';
        $data['footer_file'] = 'footer';
        $this->load->module('template');
        $this->template->front($data);
    }


    function update(){
        $data['password'] = $this->input->post('password');
        $data['join_date'] = $this->input->post('join_date');
        $data['phone'] = $this->input->post('phone');
        $data['email'] = $this->input->post('email');
        $data['skype'] = $this->input->post('skype');
        $data['phone'] = $this->input->post('phone');
        $data['fullname'] = $this->input->post('fullname');
        $data['gender'] = $this->input->post('gender');
        $data['date_of_birth'] = $this->input->post('date_of_birth');
        $data['address'] = $this->input->post('address');
        $gamers_data = $this->session->userdata('gamers_data');
        $id = $gamers_data['user_id'];
        $this->_update($data,$id);
        redirect(BASE_URL.'account/profile');
    }

    function settings() {
        $data['view_file'] = 'settings';
        $data['module'] = 'account';
        $data['header_file'] = 'header';
        $data['footer_file'] = 'footer';
        $this->load->module('template');
        $this->template->front($data);
    }

    function withdraw() {
        $data['view_file'] = 'withdraw';
        $data['module'] = 'account';
        $data['header_file'] = 'header';
        $data['footer_file'] = 'footer';
        $this->load->module('template');
        $this->template->front($data);
    }

    function deposit() {
        $data['view_file'] = 'deposit';
        $data['module'] = 'account';
        $data['header_file'] = 'header';
        $data['footer_file'] = 'footer';
        $this->load->module('template');
        $this->template->front($data);
    }


    function _update($data,$id) {
        $this->load->model('mdl_account');
        $this->mdl_account->_update($data,$id);
    }

    function _get($user_id) {
        $this->load->model('mdl_account');
        return $this->mdl_account->_get($user_id);
    }

}
?>