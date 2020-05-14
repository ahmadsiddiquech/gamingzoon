<?php 
/*************************************************
Created By: Imran Haider
Dated: 01-01-2014
version: 1.0
*************************************************/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MX_Controller
{

function __construct() {
parent::__construct();
//print '<br>this ===>';

Modules::run('site_security/is_login');
//print '<br>this ===>';//exit;
}

function index(){

	//print '<br>this =index==>';exit;
 	 $data['view_file'] = 'home';
	 $this->load->module('template');
	 $config=array();
	$ci = & get_instance();

	 $ci->load->library('session');
	 $user_data = $ci->session->userdata('user_data');
	 /*print'<pre>';
	 print_r($user_data);
	 print'</pre>';*/
	 $this->template->admin($data);
	 
	} 
}