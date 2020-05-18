<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <meta name="description" content="Bootstrap Admin App + jQuery">
   <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
   <title>Admin - Gaming Zoon</title>
   <link rel="icon" type="image/png" href="<?php echo STATIC_ADMIN_IMAGE ?>logo.png">
   
   <!-- JQUERY-->
   <script src="<?php echo STATIC_ADMIN_JS?>jquery.js"></script>

    <!-- =============== Custom CSS ===============-->
    <link rel="stylesheet" href="<?php echo STATIC_ADMIN_CSS?>custom.css">
    <!-- Image uplaod CSS -->
    
<!-- Image uplaod Css end -->
  <!-- ============== Toastr ====================== -->
       <link rel="stylesheet" href="<?php echo STATIC_ADMIN_CSS?>toastr.css">
       <link rel="stylesheet" href="<?php echo STATIC_ADMIN_CSS?>print-datatable.css"> 

   <!-- FONT AWESOME-->
   <link rel="stylesheet" href="<?php echo STATIC_ADMIN_CSS?>font-awesome.min.css">
   <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/> -->
   <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css"> -->

   <!-- SIMPLE LINE ICONS-->
   <link rel="stylesheet" href="<?php echo STATIC_ADMIN_CSS?>simple-line-icons.css">

   <!-- ANIMATE.CSS-->
   <link rel="stylesheet" href="<?php echo STATIC_ADMIN_CSS?>animate.min.css">

   <!-- WHIRL (spinners)-->
   <link rel="stylesheet" href="<?php echo STATIC_ADMIN_CSS?>whirl.css">

   <!-- SWEET ALERT-->
   <link rel="stylesheet" href="<?php echo STATIC_ADMIN_CSS?>sweetalert.css">

   <!-- DATATABLES-->
   <link rel="stylesheet" href="<?php echo STATIC_ADMIN_CSS?>dataTables.colVis.css">
   <link rel="stylesheet" href="<?php echo STATIC_ADMIN_CSS?>dataTables.bootstrap.css">

   <!-- =============== BOOTSTRAP STYLES ===============-->
   <link rel="stylesheet" href="<?php echo STATIC_ADMIN_CSS?>bootstrap.css" id="bscss">
   <!-- =============== APP STYLES ===============-->
   <link rel="stylesheet" href="<?php echo STATIC_ADMIN_CSS?>app.css"    id="maincss">
  
   <!-- =============== DATETIME PICKER STYLES ===============-->
   <link rel="stylesheet" href="<?php echo STATIC_ADMIN_CSS?>bootstrap-datetimepicker.min.css" id="maincss">
   <link rel="stylesheet" href="<?php echo STATIC_ADMIN_CSS?>bootstrap-fileupload.css">
   <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
</head>
<body>
<div class="wrapper">
      <!-- top navbar-->
      <header class="topnavbar-wrapper">
         <!-- START Top Navbar-->
         <nav role="navigation" class="navbar topnavbar" style="margin-top:15px;">
            <!-- START navbar header-->
            <div class="navbar-header">
               <a href="#/" class="navbar-brand">
                  <div class="brand-logo">
                     
                      <img src="<?php echo STATIC_ADMIN_IMAGE?>logo-full.png" style="width: 85%;" alt="App Logo" class="img-responsive">
                  </div>
                  <div class="brand-logo-collapsed">
                     <img src="<?php echo STATIC_ADMIN_IMAGE?>logo.png" style="width: 80%;padding-top: 5px;" alt="App Logo" class="img-responsive"> 
                     
                  </div>
               </a>
            </div>
            <div class="nav-wrapper">
               <ul class="nav navbar-nav">
                  <li>
                     <a href="#" data-toggle-state="aside-collapsed" class="hidden-xs">
                        <em class="fa fa-navicon"></em>
                     </a>
                     <a href="#" data-toggle-state="aside-toggled" data-no-persist="true" class="visible-xs sidebar-toggle">
                        <em class="fa fa-navicon"></em>
                     </a>
                  </li>
                  
               </ul>
               <ul class="nav navbar-nav navbar-right">
                  <li><a class="admin-logout" href="<?php echo ADMIN_BASE_URL?>login/logout" title="Lock screen"><em class="icon-lock"> </em> Logout</a></li>
               </ul>
            </div>
      </header>