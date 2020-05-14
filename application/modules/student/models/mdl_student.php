<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_student extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_table() {
        $table = "student";
        return $table;
    }

    function _get_by_arr_id($arr_col) {
        $table = $this->get_table();
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $this->db->where($arr_col);
        $this->db->where('outlet_id',$outlet_id);
        return $this->db->get($table);
    }

    function _get_parent_by_arr_id($update_id){
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $this->db->select('student.id,users.id parent_id');
        $this->db->from('student');
        $this->db->join("users", "users.id = student.parent_id", "full");
        $this->db->where('student.id',$update_id);
        $this->db->where('student.outlet_id',$outlet_id);
        return $this->db->get();
    }

    function _get_subject_teacher_detail($outlet_id){
        $this->db->select('subject.*,users.*,classes.*,sections.*,subject.name subject_name,subject.id subject_id,classes.name class_name,classes.id class_id,sections.section section_name,sections.id section_id,users.id teacher_id,users.full_name teacher_name');
        $this->db->from('subject');
        $this->db->join("users", "users.id = subject.teacher_id and users.designation = 'Teacher'", "full");
        $this->db->join("classes", "classes.id = subject.class_id", "full");
        $this->db->join("sections", "sections.id = subject.section_id", "full");
        $this->db->where('subject.outlet_id',$outlet_id);
        return $this->db->get();
    }


    function _get($order_by) {
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
    function _insert_username($data2) {
        $table = 'users';
        $this->db->insert($table, $data2);
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
        $this->db->where('id',$id);
        $query = $this->db->get($table);
        return $query->row();
    }

    function _get_student_subjects($where) {
        $table = 'student_subject';
        $this->db->where($where);
        return $this->db->get($table);
    }

    function _insert_subject($data) {
        $table = 'student_subject';
        $this->db->insert($table, $data);
    }
}