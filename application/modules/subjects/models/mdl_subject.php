<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_subject extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_table() {
        $table = "subject";
        return $table;

    }

    function _get_by_arr_id($arr_col) {
        $table = $this->get_table();
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $role_id = $user_data['role_id'];

        $this->db->select('program.id program_id,program.name program_name,classes.id class_id,classes.name class_name,sections.id section_id,sections.section section_name,subject.id,subject.name,subject.status,subject.s_type,subject.outlet_id,users.id teacher_id,users.full_name teacher_name,subject.*');
        $this->db->join("program", "program.id = subject.program_id", "full");
        $this->db->join("classes", "classes.id = subject.class_id", "full");
        $this->db->join("sections", "sections.id = subject.section_id", "full");
        $this->db->join("users", "users.id = subject.teacher_id", "full");
        $this->db->where($arr_col);
        $this->db->where('subject.outlet_id',$outlet_id);

        return $this->db->get($table);

    }
    function _get($order_by) {
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $table = $this->get_table();

        $this->db->select('classes.id,classes.name class_name,sections.id,sections.section section_name,subject.id,subject.name,subject.status,subject.s_type,users.id teacher_id,users.full_name teacher_name');

        $this->db->join("classes", "classes.id = subject.class_id", "full");

        $this->db->join("sections", "sections.id = subject.section_id", "full");
        $this->db->join("users", "users.id = subject.teacher_id", "full");
        
        $this->db->where('subject.outlet_id',$outlet_id);
        
        $this->db->order_by($order_by);
        $query = $this->db->get($table);
        return $query;
    }

    function _insert($data) {
        $table = $this->get_table();
        $this->db->insert($table, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
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
    function _get_by_arr_id_subject($section_id) {
        $table = $this->get_table();
        $this->db->select('id subject_id,name subject_name');
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $this->db->where('outlet_id',$outlet_id);
        $this->db->where('section_id',$section_id);
        $this->db->where('s_type','Optional');
        return $this->db->get($table);
    }

    function _get_subject($section_id) {
        $table = $this->get_table();
        $this->db->select('*');
        $this->db->where('section_id',$section_id);
        return $this->db->get($table);
    }

    function _get_subject_class($class_id) {
        $table = $this->get_table();
        $this->db->select('*');
        $this->db->where('class_id',$class_id);
        return $this->db->get($table);

    }
    function _get_subject_section($section_id) {
        $table = $this->get_table();
        $this->db->select('*');
        $this->db->where('section_id',$section_id);
        return $this->db->get($table);
    }

    function _get_subject_teacher($subject_id,$outlet_id){
        $this->db->select('users.id teacher_id,users.full_name teacher_name');
        $this->db->from('subject');
        $this->db->join("users", "users.id = subject.teacher_id", "full");
        $this->db->where('subject.id',$subject_id);
        $this->db->where('subject.outlet_id',$outlet_id);
        $query =  $this->db->get();
        return $query;
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
}