<?php 
if ( ! defined('BASEPATH')) 
    exit('No direct script access allowed');

class Front extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library("pagination");
        $this->load->helper("url");
    }
////////////////////////// FOR HOME PAGE /////////////////////


    function index() {
        $data['view_file'] = 'index';
        $data['module'] = 'front';
        $data['header_file'] = 'header';
        $data['footer_file'] = 'footer';
        $this->load->module('template');
        $this->template->front($data);
    }

    function register(){
        $data['country'] = $this->input->post('country');
        $data['currency'] = $this->input->post('currency');
        $data['promo_code'] = $this->input->post('promo_code');
        $data['login_id'] = Modules::run('site_security/get_random_chars','12','login_id');
        $data['password'] = Modules::run('site_security/get_random_chars','12','password');
        date_default_timezone_set('Asia/Karachi');
        $data['join_date'] = date('Y-m-d H:i');
        $id = $this->insert($data);
        $data['user_id'] = $id;
        if (!empty($id)) {
            $gamers_data['country'] = $data['country'];
            $gamers_data['currency'] = $data['currency'];
            $gamers_data['promo_code'] = $data['promo_code'];
            $gamers_data['login_id'] = $data['login_id'];
            $gamers_data['user_id'] = $data['user_id'];
            $this->session->set_userdata('gamers_data', $gamers_data);
            
            $this->session->set_flashdata('username',$data['login_id']);
            $this->session->set_flashdata('password',$data['password']);
            redirect(BASE_URL.'account');
        }
        else{
            redirect(BASE_URL);
        }
    }

    function login(){
        $login_id = $this->input->post('login_id');
        $password = $this->input->post('password');
        $row = $this->get_where_login($login_id,$password)->row();
        if (!empty($row)) {
            $data['country'] = $row->country;
            $data['currency'] = $row->currency;
            $data['promo_code'] = $row->promo_code;
            $data['login_id'] = $row->login_id;
            $data['user_id'] = $row->id;
            $this->session->set_userdata('gamers_data', $data);
            redirect(BASE_URL.'account');
        }
        else{
            redirect(BASE_URL);
        }
    }

    function logout(){
        $this->session->unset_userdata('gamers_data');
        redirect(BASE_URL);
    }



//=================================================
    function insert($data) {
        $this->load->model('mdl_front');
        return $this->mdl_front->insert($data);
    }

    function get_where_login($login_id,$password) {
        $this->load->model('mdl_front');
        return $this->mdl_front->get_where_login($login_id,$password);
    }
}
?>