<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_account extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_table() {
        $table = "account";
        return $table;
    }

    function _delete($arr_col, $outlet_id) {       
        $table = $this->get_table();
        $this->db->where('id', $arr_col);
        $this->db->where('outlet_id',$outlet_id);
        $this->db->delete($table);
    }

    function _get_by_arr_id($arr_col) {
        $table = $this->get_table();
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $this->db->where($arr_col);
        $this->db->where('outlet_id',$outlet_id);
        return $this->db->get($table);
    }

    function _get($order_by) {
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $table = $this->get_table();
        $this->db->where('outlet_id',$outlet_id);
        $this->db->order_by($order_by);
        return $this->db->get($table);
    }

    function _get_transaction_list() {
        $table = 'account_transaction';
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $this->db->order_by('id','DESC');
        $this->db->where('outlet_id',$outlet_id);
        return $this->db->get($table);
    }

    function _get_chart_of_account($order_by){
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $table = $this->get_table();
        $this->db->where('outlet_id',$outlet_id);
        $this->db->order_by($order_by);
        return $this->db->get($table);
    }

    function _insert($data) {
        $table = $this->get_table();
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function _check_cash_in_hand($type){
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $table = $this->get_table();
        $this->db->where('type',$type);
        $this->db->where('outlet_id',$outlet_id);
        return $this->db->get($table);
    }

    function _insert_transaction($data) {
        $table = 'account_transaction';
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function _insert_cash_received($data) {
        $table = 'cash_received';
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function _insert_cash_received_details($data) {
        $table = 'cash_received_details';
        $this->db->insert($table, $data);
    }

    function _update($arr_col, $outlet_id, $data) {
        $table = $this->get_table();
        $this->db->where('id',$arr_col);
        $this->db->where('outlet_id',$outlet_id);
        $this->db->update($table, $data);
    }

    function _update_teacher_pay($where,$outlet_id,$data2){
        $table = 'users_add';
        $this->db->where($where);
        $this->db->where('outlet_id',$outlet_id);
        $this->db->update($table, $data2);
    }

    function _get_cash_in_hand() {
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $table = $this->get_table();
        $this->db->where('type','Cash-in-hand');
        $this->db->where('outlet_id',$outlet_id);
        return $this->db->get($table);
    }

    function _get_teacher_cut_subject($teacher_id,$subject_id,$outlet_id){
        $this->db->select('users.*,subject.*');
        $this->db->from('users');
        $this->db->join("subject", "subject.teacher_id = users.id and subject.id =".$subject_id, "full");
        $this->db->where('users.id',$teacher_id);
        $this->db->where('users.outlet_id',$outlet_id);
        return $this->db->get();
    }

    function _get_account_balance($type){
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $table = $this->get_table();
        $this->db->where('type',$type);
        $this->db->where('outlet_id',$outlet_id);
        return $this->db->get($table);
    }

    function _update_cash_in_hand($data) {
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $table = $this->get_table();
        $this->db->where('type','Cash-in-hand');
        $this->db->where('outlet_id',$outlet_id);
        $this->db->update($table, $data);
    }

    function _update_cash($type,$data) {
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $table = $this->get_table();
        $this->db->where('type','Cash-in-hand');
        $this->db->where('outlet_id',$outlet_id);
        $this->db->update($table, $data);
    }

    function _update_account_balance($id,$type,$data){
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $table = $this->get_table();
        $this->db->where('type',$type);
        $this->db->where('id',$id);
        $this->db->where('outlet_id',$outlet_id);
        $this->db->update($table, $data);
    }

    function _get_account($id,$type){
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $table = $this->get_table();
        $this->db->where('type',$type);
        $this->db->where('id',$id);
        $this->db->where('outlet_id',$outlet_id);
        return $this->db->get($table);
    }

    function _get_student_subject() {
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $this->db->select('student.id,users.id parent_id,student.*,users.*,student_subject.*');
        $this->db->from('student');
        $this->db->join("student_subject", "student_subject.std_id = student.id", "full");
        $this->db->join("users", "users.id = student.parent_id", "full");
        $this->db->where('student.outlet_id',$outlet_id);
        return $this->db->get();
    }

    function _get_invoice_data($c_r_id,$outlet_id){
        $this->db->select('outlet.*,cash_received.*,cash_received_details.*,users.*,cash_received.total tota_fee');
        $this->db->from('cash_received');
        $this->db->join("cash_received_details", "cash_received_details.c_r_id = cash_received.id", "full");
        $this->db->join("outlet", "outlet.id = cash_received.outlet_id", "full");
        $this->db->join("users", "users.id = cash_received_details.teacher_id", "full");
        $this->db->where('cash_received.id', $c_r_id);
        $this->db->where('cash_received.outlet_id', $outlet_id);
        return $this->db->get();
    }
}