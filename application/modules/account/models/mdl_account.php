<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_account extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function _update($data,$id){
    	$table = 'players';
    	$this->db->where('id',$id);
        $this->db->update($table,$data);
    }

    function _get($user_id){
    	$table = 'players';
        $this->db->where('id', $user_id);
        return $this->db->get($table);
    }
}
