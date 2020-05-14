<div class="page-content-wrapper">
  <div class="page-content"> 
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="contractors_measurements_modal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Modal title</h4>
          </div>
          <div class="modal-body"> Widget settings form goes here </div>
          <div class="modal-footer">
            <button type="button" class="btn green" id="confirm"><i class="fa fa-check"></i>&nbsp;Save changes</button>
            <button type="button" class="btn default" data-dismiss="modal"><i class="fa fa-undo"></i>&nbsp;Close</button>
          </div>
        </div>
        <!-- /.modal-content --> 
      </div>
      <!-- /.modal-dialog --> 
    </div>
    <!-- /.modal --> 
    <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM--> 
    <!-- BEGIN PAGE HEADER-->
    <div class="content-wrapper">
      <h3> 
          <?php if (empty($update_id)) 
                        $strTitle = 'Add Users';
                    else 
                        $strTitle = 'Edit Users';
                        echo $strTitle;
             
                 ?>
                            <a href="<?php echo ADMIN_BASE_URL . 'users'; ?>"><button type="button" class="btn btn-primary pull-right"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;&nbsp;Back</button></a> 
        </h3>
          
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="tabbable tabbable-custom boxless">
           <div class="tab-content" style="margin-top:-30px;">
          <div class="panel panel-default">
            <div class="tab-pane  active" id="tab_2">
              <div class="portlet box green">
                <div class="portlet-title">

                </div>
                <div class="portlet-body form"> 
                  
                  <!-- BEGIN FORM-->

                   <?php
                                    $attributes = array('autocomplete' => 'off', 'id' => 'form_sample_1', 'class' => 'form-horizontal', 'data-parsley-validate' => '', 'novalidate' => '' );
                                    if (empty($update_id)) {
                                        $update_id = 0;
                                    } else {
                                        $hidden = array('hdnId' => $update_id); ////edit case
                                    }
                                    if (isset($hidden) && !empty($hidden))
                                        echo form_open_multipart(ADMIN_BASE_URL . 'users/submit/' . $update_id , $attributes, $hidden);
                                    else
                                        echo form_open_multipart(ADMIN_BASE_URL . 'users/submit/' . $update_id , $attributes);
                                    ?>

          
                  <div class="form-body">
                  
                    
                        </div>
                    <div class="row" style="margin-top:15px;">
                  
                       <div class="col-sm-5">
                        <div class="form-group">
                          <?php
                                                        $data = array(
                                                        'name' => 'user_name',
                                                        'id' => 'user_name',
                                                        'class' => 'form-control',
                                                        'type' => 'text',
                                                        'required' => 'required',
                                                        'tabindex' => '1',
                                                        'data-parsley-maxlength'=>TEXT_BOX_RANGE,
                                                        'value' => $users['user_name'],
                                                        );
                                                        $attribute = array('class' => 'control-label col-md-4');
                                                        ?>
                                                        
                          <?php echo form_label('User Name<span style="color:red">*</span>', 'user_name', $attribute); ?>
                          <div class="col-md-8"> <?php echo form_input($data); ?>  <span id="message"></span></div>
                         
                        </div>
                         <?php 
                    $read_only = false;
                   if (isset($update_id) && !empty($update_id))
                   {
                     ?>
                      <script type="text/javascript">jQuery('#user_name').attr('readonly', true);</script>
                     <?
                   }
                    ?>
                      </div>
                      <div class="col-sm-5">
                       <div class="form-group">
                          <?php
                                                        $data = array(
                                                        'name' => 'state',
                                                        'id' => 'state',
                                                        'class' => 'form-control',
                                                        'type' => 'text',
                                                        'tabindex' => '6',
                                                        'data-parsley-maxlength'=>TEXT_BOX_RANGE,

                                                       'value' => $users['state'],
                                                        );
                                                        $attribute = array('class' => 'control-label col-md-4');
                                                        ?>
                          <?php echo form_label('State', 'state', $attribute); ?>
                          <div class="col-md-8"> <?php echo form_input($data); ?> </div>
                        </div> 
                        
                      </div>
                      
                      
                    </div>
                    <div class="row">
                      <div class="col-sm-5">
                        <div class="form-group">
                          <?php
                                                        $data = array(
                                                        'name' => 'full_name',
                                                        'id' => 'full_name',
                                                        'class' => 'form-control',
                                                        'type' => 'text',
                                                        'tabindex' => '2',
                                                        'required' => 'required',
                                                       'data-parsley-maxlength'=>TEXT_BOX_RANGE,
                                                        'value' => $users['full_name'],
                                                        );
                                                        $attribute = array('class' => 'control-label col-md-4');
                                                        ?>
                          <?php echo form_label('Full Name<span style="color:red">*</span>', 'full_name', $attribute); ?>
                          <div class="col-md-8"> <?php echo form_input($data); ?> </div>
                        </div>
                      </div>
                       <div class="col-sm-5">
                       <div class="form-group">
                          <?php
                                                        $data = array(
                                                        'name' => 'country',
                                                        'id' => 'country',
                                                        'class' => 'form-control',
                                                        'type' => 'text',
                                                        'tabindex' => '7',
                            'data-parsley-maxlength'=>TEXT_BOX_RANGE,
                                                       'value' => $users['country'],
                                                        );
                                                        $attribute = array('class' => 'control-label col-md-4');
                                                        ?>
                          <?php echo form_label('Country ', 'country', $attribute); ?>
                          <div class="col-md-8"> <?php echo form_input($data); ?> </div>
                        </div> 
                      </div>
                     
                    </div>
                    <div class="row"> 
                     <div class="col-sm-5">
                        <div class="form-group">
                          <?php
                                                        $data = array(
                                                        'name' => 'phone',
                                                        'id' => 'phone',
                                                        'class' => 'form-control',
                                                        'type' => 'tel',
                                                        'tabindex' => '8',
                                                        'value' => $users['phone'],
                                                        );
                                                        $attribute = array('class' => 'control-label col-md-4');
                                                        ?>
                          <?php echo form_label('Phone ', 'phone', $attribute); ?>
                          <div class="col-md-8"> <?php echo form_input($data); ?> </div>
                        </div>
                      </div>
                      <div class="col-sm-5">
                        <div class="form-group">
                          <?php
                                                      $data = array(
                                                        'name' => 'city',
                                                        'id' => 'city',
                                                        'class' => 'form-control',
                                                        'type' => 'text',
                                                        'tabindex' => '5',
                                                          'data-parsley-maxlength'=>TEXT_BOX_RANGE,
                                                        'value' => $users['city'],
                                                        );
                                                        $attribute = array('class' => 'control-label col-md-4');
                                                        ?>
                          <?php echo form_label('City ', 'city', $attribute); ?>
                          <div class="col-md-8"> <?php echo form_input($data); ?> </div>
                        </div>
                      </div>
                     
                    </div>
                    
                    <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                          <?php
                                                        $data = array(
                                                        'name' => 'address1',
                                                        'id' => 'address1',
                                                        'class' => 'form-control',
                                                        'type' => 'text',
                                                        'tabindex' => '4',
                                                        'data-parsley-maxlength'=>TEXT_BOX_RANGE,
                                                        'value' => $users['address1'],
                                                        );
                                                        $attribute = array('class' => 'control-label col-md-4');
                                                        ?>
                          <?php echo form_label('Address 1 ', 'address1', $attribute); ?>
                          <div class="col-md-8"> <?php echo form_input($data); ?> </div>
                        </div>
                      </div>
                      <div class="col-sm-5">
                        <div class="form-group">
                          <?php
                                                        $data = array(
                                                        'name' => 'email',
                                                        'id' => 'email',
                                                        'class' => 'form-control',
                                                        'type' => 'email',
                                                        'tabindex' => '9',
                                                        'data-parsley-maxlength'=>TEXT_BOX_RANGE,
                                                        'value' => $users['email'],
                                                        );
                                                        $attribute = array('class' => 'control-label col-md-4');
                                                        ?>
                          <?php echo form_label('Email ', 'email', $attribute); ?>
                          <div class="col-md-8"> <?php echo form_input($data); ?> </div>
                        </div>
                      </div>
                      
                      
                    </div>
                    
                    <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                          <?php
                                                        $data = array(
                                                        'name' => 'address2',
                                                        'id' => 'address2',
                                                        'class' => 'form-control',
                                                        'type' => 'text',
                                                        'tabindex' => '5',
                                                        'data-parsley-maxlength'=>TEXT_BOX_RANGE,
                                                      'value' => $users['address2'],
                                                        );
                                                        $attribute = array('class' => 'control-label col-md-4');
                                                        ?>
                          <?php echo form_label('Address2 ', 'address2', $attribute); ?>
                          <div class="col-md-8"> <?php echo form_input($data); ?> </div>
                        </div>
                      </div>
                       <div class="col-sm-5" id="pass">
                        <div class="form-group">
                          <?php
                                                      $data = array(
                                                        'name' => 'password',
                                                        'id' => 'password',
                                                        'class' => 'form-control',
                                                        'type' => 'password',
                                                        'tabindex' => '10',
                                                        'data-parsley-maxlength'=>TEXT_BOX_RANGE,
                                                        
                                                        );
                                                        $attribute = array('class' => 'control-label col-md-4');
                                                        ?>
                          <?php echo form_label('Password ', 'password', $attribute); ?>
                          <div class="col-md-8"> <?php echo form_input($data); ?> </div>
                        </div>
                        <?php 
                   if (isset($update_id) && !empty($update_id))
                   {
                     ?>
                      <script type="text/javascript">jQuery('#pass').hide();</script>
                     <?
                   }
                    ?>
                      </div>
                     
      
                    </div>
                    
                    <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                          <?php
                            $data = array(
                            'name' => 'designation',
                            'id' => 'designation',
                            'class' => 'form-control',
                            'type' => 'text',
                            'required' => 'required',
                            'value' => $users['designation'],
                            'tabindex' => '6',
                            );
                            $attribute = array('class' => 'control-label col-md-4');
                            ?>
                          <?php echo form_label('User Type<span style="color:red">*</span>', 'designation', $attribute); ?>
                          <div class="col-md-8"> 
                            <select name="designation" class="form-control">
                              <option <?php if($users['designation'] == 'Teacher') echo "selected"; ?> value="Teacher">Teacher</option>
                              <option <?php if($users['designation'] == 'Parent') echo "selected"; ?> value="Parent">Parent</option>
                              <option <?php if($users['designation'] == 'User') echo "selected"; ?> value="User">User</option>
                            </select>
                      </div>
                        </div>
                      </div>
                     
                     <div class="col-sm-5">
                                    <div class="form-group">
                                    <?php

                                    $options = array('' => 'Select')+$roles_title ;
                                    $attribute = array('class' => 'control-label col-md-4');
                                    echo form_label('Assign Role <span style="color:red">*</span>', 'role_id', $attribute);?>
                                    <div class="col-md-8"><?php echo form_dropdown('role_id', $options, $users['role_id'],  'class="form-control select2me required" id="role_id" tabindex ="12"'); ?></div>                            </div>
                    </div>
                     
                    </div>
                  </div>
                </div>
                <div class="form-actions fluid no-mrg">
                  <div class="row">
                    <div class="col-md-6">
                     <div class="col-md-offset-3 col-md-9" style="padding-bottom:15px;">
                        <button type="submit" class="btn btn-primary " tabindex="13" style="margin-left:10px;"><i class="fa fa-check"></i>&nbsp;Save</button>
                        <a href="<?php echo ADMIN_BASE_URL . 'users'; ?>">
                         <button type="button"  class="btn green btn-default" style="margin-left:20px;"><i class="fa fa-undo"></i>&nbsp;Cancel</button>
                        </a> </div>
                    </div>
                    <div class="col-md-6"> </div>
                  </div>
                </div>
                <?php echo form_close(); ?> 
                <!-- END FORM--> 
              </div>
               </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<script type="text/javascript">
 
         $(document).ready(function(){
            $("#user_name").change(function(){
				
             $("#message").html("<img src='<?= STATIC_ADMIN_IMAGE?>ajax-loader.gif' />"); 
            var user_name=$("#user_name").val();
			//alert(user_name);
              $.ajax({
                    type:"post",
                    data: {'user_name': user_name},
                   url: "<?php ADMIN_BASE_URL?>users/validate",
                            
                        success:function(result){
                        if(result == 1){
                           $("#message").html("<span style='color:red;'>User already exists..!</span>");
                           
                        }
                        else{
                           $("#message").html("<img src='<?= STATIC_ADMIN_IMAGE?>ajax-loader.gif' />").hide(); 
                        }
                    }
                 });
 
            });
 
         });
 
       </script>