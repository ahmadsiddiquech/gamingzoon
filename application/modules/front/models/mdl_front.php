<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_front extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insert($data){
    	$table = 'players';
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function get_where_login($login_id,$password){
    	$table = 'players';
    	$this->db->select('login_id,country,currency,promo_code,id');
        $this->db->where('status',1);
    	$this->db->where('login_id', $login_id);
		$this->db->where('password', $password);
		return $this->db->get($table);
    }
}
