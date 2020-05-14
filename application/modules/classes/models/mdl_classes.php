<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_classes extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_table() {
        $table = "classes";
        return $table;
    }
	
    function _get_by_arr_id($arr_col) {
        $table = $this->get_table();
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $role_id = $user_data['role_id'];
        $this->db->select('*');
        $this->db->select('classes.id,classes.name,classes.program_id,classes.description,classes.status,classes.outlet_id,program.id progra_id,program.name program_name');
        $this->db->join("program", "classes.program_id = program.id", "full");
        $this->db->where($arr_col);
        if($role_id!=1){
            $this->db->where('classes.outlet_id',$outlet_id);
        }
        return $this->db->get($table);
    }

    function _get_by_arr_id_program($program_id){
        $table = $this->get_table();
        $this->db->select('*');
        $this->db->where('program_id',$program_id);
        return $this->db->get($table);
    }

    function _get() {
        $user_data = $this->session->userdata('user_data');
        $role_id = $user_data['role_id'];
        $outlet_id = $user_data['outlet_id'];
        $table = $this->get_table();
        $this->db->select('classes.id,classes.name,classes.program_id,classes.description,classes.status,classes.outlet_id,program.id program_id,program.name program_name');
        $this->db->join("program", "classes.program_id = program.id", "full");
        if($role_id!= 1)
        {
        $this->db->where('classes.outlet_id',$outlet_id);
        }
        $this->db->order_by('classes.id','DESC');
        return $this->db->get($table);
    }

    function _insert($data) {
        $table = $this->get_table();
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function _update($arr_col, $outlet_id, $data) {
        $table = $this->get_table();
        $user_data = $this->session->userdata('user_data');
        $role_id = $user_data['role_id'];
        $this->db->where('id',$arr_col);
        if($role_id!=1){
            $this->db->where('outlet_id',$outlet_id);
        }
        $this->db->update($table, $data);
    }

    function _update_id($id, $data) {
        $table = $this->get_table();
        $this->db->where('id',$id);
        $this->db->update($table, $data);
    }

    function _delete($arr_col, $outlet_id) {       
        $table = $this->get_table();
        $user_data = $this->session->userdata('user_data');
        $role_id = $user_data['role_id'];
        $this->db->where('id', $arr_col);
        if($role_id!=1){
            $this->db->where('outlet_id',$outlet_id);
        }
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

    function _get_std_list($class_id) {
        $table = 'student';
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $this->db->select('classes.id class_id,classes.name class_name,sections.id section_id,sections.section section_name,student.id id,student.full_name name,student.parent_name parent_name');
        $this->db->join("student_subject", "student_subject.std_id = student.id and student_subject.class_id =".$class_id, "full");
        $this->db->join("classes", "classes.id = student_subject.class_id", "full");
        $this->db->join("sections", "sections.id = student_subject.section_id", "full");
        $this->db->order_by('student.id','DESC');
        $this->db->where('student.outlet_id',$outlet_id);
        return $this->db->get($table);
    }

}