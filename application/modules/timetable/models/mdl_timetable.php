<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_timetable extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_table() {
        $table = "timetable_record";
        return $table;
    }

   function _get_by_arr_id($update_id) {
    $table = $this->get_table();
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $this->db->where('id', $update_id);
        $this->db->where('outlet_id',$outlet_id);
        return $this->db->get($table);
    }

    function _get($program_id,$class_id,$section_id) {
        $table = $this->get_table();
        $user_data = $this->session->userdata('user_data');
        $outlet_id = $user_data['outlet_id'];
        $this->db->where('program_id',$program_id);
        $this->db->where('class_id',$class_id);
        $this->db->where('section_id',$section_id);
        $this->db->where('outlet_id',$outlet_id);
        $this->db->order_by('day','ASC');
        return $this->db->get($table);
    }

    function _get_subject_data($timetable_id,$subject_id) {
        $table = "timetable_data";
        $this->db->select('*');
        $this->db->where('timetable_id',$timetable_id);
        $this->db->where('subject_id',$subject_id);
        return $this->db->get($table);
    }

    function _insert_timetable_subject($data2) {
        $table = 'timetable_data';
        $this->db->insert($table, $data2);
    }
    
    function _get_timetable_subject($timetable_id) {
        $table = 'timetable_data';
        $this->db->where('timetable_id',$timetable_id);
        return $this->db->get($table);
    }

    function _insert_timetable($data_timetable) {
        $table = 'timetable_record';
        $this->db->insert($table, $data_timetable);
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

    function update_subject($sbj_id,$timetable_id,$data){
        $table = "timetable_data";
        $this->db->where('timetable_id', $timetable_id);
        $this->db->where('subject_id', $sbj_id);
        $this->db->set($data);
        $this->db->update($table);
        return $this->db->affected_rows();
    }

    function check_day($day,$section_id){
        $table = $this->get_table();
        $this->db->where('day',$day);
        $this->db->where('section_id',$section_id);
        return $this->db->get($table);
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

    function _no_of_days($class_id,$section_id){
        $table = 'timetable_record';
        $this->db->where('class_id',$class_id);
        $this->db->where('section_id',$section_id);
        return $this->db->get($table);
    }

    

    function _get_org_print_voucher($outlet_id) {
        $table = 'outlet';
        $this->db->where('id',$outlet_id);
        return $this->db->get($table);
    }

    function _get_timetable_print_voucher($timetable_id,$outlet_id){
        $this->db->select('timetable_record.*,timetable_data.*');
        $this->db->from('timetable_record');
        $this->db->join("timetable_data", "timetable_record.id = timetable_data.timetable_id", "full");
        $this->db->where('timetable_record.id', $timetable_id);
        $this->db->where('timetable_record.outlet_id', $outlet_id);
        return $this->db->get();
    }
}
?>