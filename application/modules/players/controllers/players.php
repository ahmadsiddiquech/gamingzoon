<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Players extends MX_Controller
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
        $data['news'] = $this->_get('players.id desc');
        $data['view_file'] = 'news';
        $this->load->module('template');
        $this->template->admin($data);
    }
    
    function _get_data_from_db($update_id) {
        $where['players.id'] = $update_id;
        $query = $this->_get_by_arr_id($where);
        foreach ($query->result() as
                $row) {
            $data['id'] = $row->id;
            $data['login_id'] = $row->login_id;
            $data['join_date'] = $row->join_date;
            $data['phone'] = $row->phone;
            $data['email'] = $row->email;
            $data['skype'] = $row->skype;
            $data['fullname'] = $row->fullname;
            $data['gender'] = $row->gender;
            $data['date_of_birth'] = $row->date_of_birth;
            $data['address'] = $row->address;
            $data['country'] = $row->country;
            $data['promo_code'] = $row->promo_code;
            $data['currency'] = $row->currency;
            $data['status'] = $row->status;
        }
        if(isset($data))
            return $data;
    }

    function delete() {
        $delete_id = $this->input->post('id');
        $this->_delete($delete_id);
    }

    function set_publish() {
        $update_id = $this->uri->segment(4);
        $where['id'] = $update_id;
        $this->_set_publish($where);
        $this->session->set_flashdata('message', 'Post published successfully.');
        redirect(ADMIN_BASE_URL . 'players/manage/' . '');
    }

    function set_unpublish() {
        $update_id = $this->uri->segment(4);
        $where['id'] = $update_id;
        $this->_set_unpublish($where);
        $this->session->set_flashdata('message', 'Post un-published successfully.');
        redirect(ADMIN_BASE_URL . 'players/manage/' . '');
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

    function detail() {
        $update_id = $this->input->post('id');
        $data['user'] = $this->_get_data_from_db($update_id);
        $this->load->view('detail', $data);
    }
	
    function _set_publish($arr_col) {
        $this->load->model('mdl_players');
        $this->mdl_players->_set_publish($arr_col);
    }

    function _set_unpublish($arr_col) {
        $this->load->model('mdl_players');
        $this->mdl_players->_set_unpublish($arr_col);
    }

    function _get($order_by) {
        $this->load->model('mdl_players');
        return $this->mdl_players->_get($order_by);
    }

    function _get_by_arr_id($arr_col) {
        $this->load->model('mdl_players');
        return $this->mdl_players->_get_by_arr_id($arr_col);
    }

    function _update_id($id, $data) {
        $this->load->model('mdl_players');
        $this->mdl_players->_update_id($id, $data);
    }

    function _delete($arr_col) {       
        $this->load->model('mdl_players');
        $this->mdl_players->_delete($arr_col);
    }
}