<?php 
    $this->load->view('front/theme1/'.$header_file);

    $path = $module.'/'.$view_file;
    
    $this->load->view($path);
    
    $this->load->view('front/theme1/'.$footer_file);
?>