
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <meta name="description" content="Bootstrap Admin App + jQuery">
   <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
   <title>Login</title>
   <!-- =============== VENDOR STYLES ===============-->
   <!-- FONT AWESOME-->
   <link rel="stylesheet" href="<?php echo STATIC_ADMIN_CSS?>font-awesome.min.css">
   <!-- SIMPLE LINE ICONS-->
   <link rel="stylesheet" href="<?php echo STATIC_ADMIN_CSS?>simple-line-icons.css">
   <!-- =============== BOOTSTRAP STYLES ===============-->
   <link rel="stylesheet" href="<?php echo STATIC_ADMIN_CSS?>bootstrap.css" id="bscss">
   <!-- =============== APP STYLES ===============-->
   <link rel="stylesheet" href="<?php echo STATIC_ADMIN_CSS?>app.css" id="maincss">
</head>

<body>
   <div class="wrapper">
      <div class="block-center mt-xl wd-xl">
         <!-- START panel-->
         <div class="panel panel-dark panel-flat">
            <div class="panel-heading text-center">
               <a href="#">
                <p> <h1> Find.Pk </h1> </p>   <!-- <img src="<?php //echo base_url().'uploads/general_setting/small_images/logo_appligion.png'?>" alt="logo" class="img-responsive" id="login_logo"/> -->
               </a>
            </div>
            <div class="panel-body">
               <p class="text-center pv">SIGN IN TO CONTINUE.</p>
               <?php

					$attributes = array('autocomplete' => 'off', 'id' => 'login');
					echo form_open(ADMIN_BASE_URL.'login/submit_login',$attributes);
	
	           echo '<div class="form-group has-feedback">';
					$data = array(
              'name'        => 'txtUserName',
              'id'          => 'form-validation-field-0',
              'class'   => 'form-control',
              'value'       => '',
            );
			echo form_input($data);
			echo '<span class="fa fa-envelope form-control-feedback text-muted"></span>';
			echo '</div>';       
			
			
			
			
			echo '<div class="form-group has-feedback">';
					$data = array(
              'name'        => 'txtPassword',
              'id'          => 'form-validation-field-1',
              'class'   => 'form-control',
			  'type'  =>'password',
              'value'       => '',
            );
			echo form_input($data);
			echo '<span class="fa fa-lock form-control-feedback text-muted"></span>';
			echo '</div>';         
                     
         ?>            
         

                  <div class="clearfix">
                     <div class="checkbox c-checkbox pull-left mt0">
                        <label>
                           <input type="checkbox" value="" name="remember">
                           <span class="fa fa-check"></span>Remember Me</label>
                     </div>
                     <div class="pull-right"><a href="../../../../../backend-jquery/app/recover.html" class="text-muted">Forgot your password?</a>
                     </div>
                  </div>
                  <button type="submit" class="btn btn-block btn-primary mt-lg">Login</button>
               </form>
               
            </div>
         </div>
         <!-- END panel-->
         <div class="p-lg text-center">
            <span>&copy;</span>
            <span>2015</span>
            <span>-</span>
            <span>Find.Pk</span>
            <br>
           
         </div>
      </div>
   </div>
   <!-- =============== VENDOR SCRIPTS ===============-->
   <!-- MODERNIZR-->
   <script src="<?php echo STATIC_ADMIN_JS?>modernizr.js"></script>
   <!-- JQUERY-->
   <script src="<?php echo STATIC_ADMIN_JS?>jquery.js"></script>
   <!-- BOOTSTRAP-->
   <script src="<?php echo STATIC_ADMIN_JS?>bootstrap.js"></script>
   <!-- STORAGE API-->
   <script src="<?php echo STATIC_ADMIN_JS?>jquery.storageapi.js"></script>
   <!-- PARSLEY-->
   <script src="<?php echo STATIC_ADMIN_JS?>parsley.min.js"></script>
   <!-- =============== APP SCRIPTS ===============-->
   <script src="<?php echo STATIC_ADMIN_JS?>app.js"></script>
</body>

</html>