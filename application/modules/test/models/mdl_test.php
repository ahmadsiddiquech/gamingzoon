<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_test extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_table() {
        $table = "test";
        return $table;
    }

   function _get_by_arr_id($arr_col) {
        $table = $this->get_table();
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $this->db->select('*');
        $this->db->where($arr_col);
        $this->db->where('outlet_id',$outlet_id);
        return $this->db->get($table);
    }

    function _get($order_by) {
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $table = $this->get_table();
        $this->db->select('*');
        $this->db->where('outlet_id',$outlet_id);
        $this->db->order_by($order_by);
        return $this->db->get($table);
    }
    function _insert($data) {
        $table = $this->get_table();
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function _update($arr_col, $outlet_id, $data) {
        $table = $this->get_table();
        $this->db->where('id',$arr_col);
        $this->db->where('outlet_id',$outlet_id);
        $this->db->update($table, $data);
    }
       function _update_id($id, $data) {
        $table = $this->get_table();
        $this->db->where('id',$id);
        $this->db->update($table, $data);
    }

    function check_subject($subject_id){
        $table = $this->get_table();
        $user_data = $this->session->userdata('user_data');
        $this->db->select('*');
        $this->db->where('section_id',$section_id);
        return $this->db->get($table);
    }

    function _get_class_student_list($update_id,$outlet_id){
        $this->db->select('test.id test_id, test.test_title,test.class_name,test.total_marks, student.id std_id, student.name,student.roll_no');
        $this->db->from('test');
        $this->db->join("student", "student.section_id = test.section_id", "full");
        $this->db->where('test.id', $update_id);
        $this->db->where('test.outlet_id', $outlet_id);
        return $this->db->get();
    }

    function _get_class_student_marks($std_id,$test_id){
        $table = ('test_marks');
        $this->db->select('test_marks.obtained_marks');
        $this->db->where('std_id', $std_id);
        $this->db->where('test_id', $test_id);
        return $this->db->get($table);
    }

    function update_marks($std_id,$roll_no,$test_id,$obtained_marks){
        $table = "test_marks";
        $this->db->where('std_id', $std_id);
        $this->db->where('std_roll_no', $roll_no);
        $this->db->where('test_id', $test_id);
        $this->db->set('obtained_marks',$obtained_marks);
        $this->db->update($table);
        return $this->db->affected_rows();
    }

    function _delete($arr_col, $outlet_id) {       
        $table = $this->get_table();
        $this->db->where('id', $arr_col);
        $this->db->where('outlet_id',$outlet_id);
        $this->db->delete($table);
    }
    function _set_publish($where) {
        $table = $this->get_table();
        $set_publish['status'] = 1;
        $this->db->where($where);
        $this->db->update($table, $set_publish);
    }

    function _set_unpublish($where) {
        $table = $this->get_table();
        $set_un_publish['status'] = 0;
        $this->db->where($where);
        $this->db->update($table, $set_un_publish);
    }
    function _getItemById($id) {
        $table = $this->get_table();
        $this->db->where("( id = '" . $id . "'  )");
        $query = $this->db->get($table);
        return $query->row();
    }

    

    

    function _get_org_print_voucher($outlet_id) {
        $table = 'outlet';
        $this->db->where('id',$outlet_id);
        return $this->db->get($table);
    }

    function _get_test_print_voucher($test_id,$outlet_id){
        $this->db->select('test.*,test_marks.*');
        $this->db->from('test');
        $this->db->join("test_marks", "test.id = test_marks.test_id", "full");
        $this->db->where('test.id', $test_id);
        $this->db->where('test.outlet_id', $outlet_id);
        return $this->db->get();
    }
}