<?php 
if ( ! defined('BASEPATH')) 
    exit('No direct script access allowed');

class Front extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library("pagination");
        $this->load->helper("url");
    }
////////////////////////// FOR HOME PAGE /////////////////////


    function index() {
        $data['view_file'] = 'index';
        $data['module'] = 'front';
        $data['header_file'] = 'header';
        $data['footer_file'] = 'footer';
        $this->load->module('template');
        $this->template->front($data);
    }

}
?>