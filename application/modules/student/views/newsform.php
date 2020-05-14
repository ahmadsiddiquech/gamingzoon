<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<style type="text/css">
  th, td, tr {
    border-collapse: collapse;
    border: 1px solid black;
    text-align: center;
  }

select:invalid {
  height: 0px !important;
  opacity: 0 !important;
  position: absolute !important;
  display: flex !important;
}
  
</style>
<div class="page-content-wrapper">
  <div class="page-content"> 
    <div class="content-wrapper">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3>
        <?php 
        if (empty($update_id)) 
                    $strTitle = 'Add student';
                else 
                    $strTitle = 'Edit student';
                    echo $strTitle;
                    ?>
                    <a href="<?php echo ADMIN_BASE_URL . 'student'; ?>"><button type="button" class="btn btn-primary btn-lg pull-right"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;&nbsp;<b>Back</b></button></a>
       </h3>             
            
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tabbable tabbable-custom boxless">
          <div class="tab-content">
          <div class="panel panel-default" style="margin-top:-30px;">
         
            <div class="tab-pane  active" >
              <div class="portlet box green ">
                
                <div class="portlet-body form " style="padding-top:15px;"> 
                  
                  <!-- BEGIN FORM-->
                        <?php
                        $attributes = array('autocomplete' => 'off', 'id' => 'form_sample_1', 'class' => 'form-horizontal');
                        if (empty($update_id)) {
                            $update_id = 0;
                        } else {
                            $hidden = array('hdnId' => $update_id, 'hdnActive' => $news['status']); ////edit case
                        }
                        if (isset($hidden) && !empty($hidden))
                            echo form_open_multipart(ADMIN_BASE_URL . 'student/submit/' . $update_id, $attributes, $hidden);
                        else
                            echo form_open_multipart(ADMIN_BASE_URL . 'student/submit/' . $update_id, $attributes);
                        ?>
                  <div class="form-body">
                    
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
                              'value' => $news['user_name'],
                              'data-parsley-maxlength'=>TEXT_BOX_RANGE
                              );
                              $attribute = array('class' => 'control-label col-md-4');
                              ?>
                          <?php echo form_label('Username<span style="color:red">*</span>', 'user_name', $attribute); ?>
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
                            <div class="control-label col-md-4">
                              <label>Parent</label>
                            </div>
                            <div class="col-md-8">
                              <select name="parent_id" id="parent_id" class="chosen1 form-control parent_id" tabindex="2" required="required">
                                <option value=""></option>
                              <?php if(isset($parent) && !empty($parent))
                              foreach ($parent as $key => $value):?>
                                <option <?php if(isset($news['parent_id']) && $news['parent_id'] == $value['id']) echo "selected"; ?> value="<?php echo $value['id'].','.$value['full_name'].','.$value['phone'] ?>"><?=$value['full_name'];?></option>
                              <?php endforeach; ?>
                            </select>
                            </div>
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
                            'tabindex' => '5',
                            'value' => $news['full_name'],
                            'data-parsley-maxlength'=>TEXT_BOX_RANGE
                            );
                            $attribute = array('class' => 'control-label col-md-4');
                            ?>
                          <?php echo form_label('Full Name', 'full_name', $attribute); ?>
                          <div class="col-md-8"> <?php echo form_input($data); ?> </div>
                        </div>
                      </div>
                      <div class="col-sm-5">
                        <div class="form-group">
                          <?php
                            $data = array(
                            'name' => 'gender',
                            'id' => 'gender',
                            'class' => 'form-control',
                            'type' => 'text',
                            'required' => 'required',
                            'value' => $news['gender'],
                            'tabindex' => '6',
                            );
                            $attribute = array('class' => 'control-label col-md-4');
                            ?>
                          <?php echo form_label('Gender<span style="color:red">*</span>', 'gender', $attribute); ?>
                          <div class="col-md-8"> 
                            <select name="gender" class="form-control">
                              <option <?php if($news['gender'] == 'Male') echo "selected"; ?> value="Male">Male</option>
                              <option <?php if($news['gender'] == 'Female') echo "selected"; ?> value="Female">Female</option>
                              <option <?php if($news['gender'] == 'Other') echo "selected"; ?> value="Other">Other</option>
                            </select>
                      </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                          <?php
                            $data = array(
                            'name' => 'dob',
                            'id' => 'dob',
                            'class' => 'form-control datetimepicker2',
                            'type' => 'text',
                            'tabindex' => '7',
                            'max' => '2016-12-31',
                            'required' => 'required',
                            'data-parsley-maxlength'=>TEXT_BOX_RANGE,
                            'value' => $news['dob'],
                            );
                            $attribute = array('class' => 'control-label col-md-4');
                            ?>
                          <?php echo form_label('Date of Birth<span style="color:red">*</span>', 'dob', $attribute); ?>

                          <div class="col-md-8"> <?php echo form_input($data); ?> </div>
                        </div>
                      </div>
                    
                    <div class="row">
                       <div class="col-sm-5">
                        <div class="form-group">
                          <?php
                            $data = array(
                            'name' => 'addmission_date',
                            'id' => 'addmission_date',
                            'class' => 'form-control datetimepicker2',
                            'type' => 'text',
                            'tabindex' => '8',
                            'required' => 'required',
                            'min' => '2010-12-30',
                            'value' => $news['addmission_date'],
                            'data-parsley-maxlength'=>TEXT_BOX_RANGE
                            );
                            $attribute = array('class' => 'control-label col-md-4');
                            ?>
                          <?php echo form_label('Addmission Date<span style="color:red">*</span>', 'addmission_date', $attribute); ?>
                          <div class="col-md-8"> <?php echo form_input($data); ?> </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-5">
                        <div class="form-group">
                          <?php
                            $data = array(
                            'name' => 'last_class',
                            'id' => 'last_class',
                            'class' => 'form-control',
                            'type' => 'text',
                            'value' => $news['last_class'],
                            'tabindex' => '6',
                            );
                            $attribute = array('class' => 'control-label col-md-4');
                            ?>
                          <?php echo form_label('Last Attended Class', 'last_class', $attribute); ?>
                          <div class="col-md-8"> 
                            <select name="gender" class="form-control">
                              <option <?php if($news['gender'] == '9th') echo "selected"; ?> value="9th">9th</option>
                              <option <?php if($news['gender'] == '10th') echo "selected"; ?> value="10th">10th</option>
                              <option <?php if($news['gender'] == '1st Year') echo "selected"; ?> value="1st Year">1st Year</option>
                              <option <?php if($news['gender'] == '2nd Year') echo "selected"; ?> value="2nd Year">2nd Year</option>
                              <option <?php if($news['gender'] == '3rd Year') echo "selected"; ?> value="3rd Year">3rd Year</option>
                              <option <?php if($news['gender'] == '4th Year') echo "selected"; ?> value="4th Year">4th Year</option>
                            </select>
                      </div>
                        </div>
                      </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                          <?php
                            $data = array(
                            'name' => 'name_school',
                            'id' => 'name_school',
                            'class' => 'form-control',
                            'type' => 'text',
                            'tabindex' => '5',
                            'value' => $news['name_school'],
                            'data-parsley-maxlength'=>TEXT_BOX_RANGE
                            );
                            $attribute = array('class' => 'control-label col-md-4');
                            ?>
                          <?php echo form_label('Current School/College', 'name_school', $attribute); ?>
                          <div class="col-md-8"> <?php echo form_input($data); ?> </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-5">
                        <div class="form-group">
                          <?php
                            $data = array(
                            'name' => 'obt_marks',
                            'id' => 'obt_marks',
                            'class' => 'form-control',
                            'type' => 'number',
                            'tabindex' => '5',
                            'value' => $news['obt_marks'],
                            'data-parsley-maxlength'=>TEXT_BOX_RANGE
                            );
                            $attribute = array('class' => 'control-label col-md-4');
                            ?>
                          <?php echo form_label('Obtained Marks', 'obt_marks', $attribute); ?>
                          <div class="col-md-8"> <?php echo form_input($data); ?> </div>
                        </div>
                      </div>
                        <div class="col-sm-5">
                        <div class="form-group">
                          <?php
                            $data = array(
                            'name' => 'percentage',
                            'id' => 'percentage',
                            'class' => 'form-control',
                            'type' => 'text',
                            'tabindex' => '5',
                            'value' => $news['percentage'],
                            'data-parsley-maxlength'=>TEXT_BOX_RANGE
                            );
                            $attribute = array('class' => 'control-label col-md-4');
                            ?>
                          <?php echo form_label('Percentage', 'percentage', $attribute); ?>
                          <div class="col-md-8"> <?php echo form_input($data); ?> </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-5">
                        <div class="form-group">
                          <?php
                            $data = array(
                            'name' => 'address',
                            'id' => 'address',
                            'class' => 'form-control',
                            'type' => 'text',
                            'tabindex' => '5',
                            'value' => $news['address'],
                            'data-parsley-maxlength'=>TEXT_BOX_RANGE
                            );
                            $attribute = array('class' => 'control-label col-md-4');
                            ?>
                          <?php echo form_label('Address', 'address', $attribute); ?>
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
                            'name' => 'year',
                            'id' => 'year',
                            'class' => 'form-control',
                            'type' => 'text',
                            'tabindex' => '5',
                            'value' => $news['year'],
                            'data-parsley-maxlength'=>TEXT_BOX_RANGE
                            );
                            $attribute = array('class' => 'control-label col-md-4');
                            ?>
                          <?php echo form_label('Year', 'year', $attribute); ?>
                          <div class="col-md-8"> <?php echo form_input($data); ?> </div>
                        </div>
                      </div>
                      <div class="col-sm-5">
                                    <div class="form-group">
                                    <?php

                                    $options = array('' => 'Select')+$roles_title ;
                                    $attribute = array('class' => 'control-label col-md-4');
                                    echo form_label('Assign Role <span style="color:red">*</span>', 'role_id', $attribute);?>
                                    <div class="col-md-8"><?php echo form_dropdown('role_id', $options, $news['role_id'],  'class="form-control select2me required" id="role_id" tabindex ="12"'); ?></div>                            </div>
                    </div>
                    </div>
                    <div class="row">
                      <div class="col-md-5">
                                    <div class="form-group last">
                                        <label class="control-label col-md-4">Image Upload<span style="color:red">*</span> </label>
                                        <div class="col-md-8">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                    <?
                                                    if (isset($news['image']) && !empty($news['image'])) {
                                                    ?>
                                                    <img src = "<?php echo base_url() . 'uploads/student/medium_images/' . $news['image'] ?>" />
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">
                                            </div>
                                            <div>
                                                <span class="btn default btn-file">
                                                    <span class="fileupload-new">
                                                        <i class="fa fa-paper-clip"></i> Select image
                                                    </span>
                                                    <span class="fileupload-exists">
                                                        <i class="fa fa-undo"></i> Change
                                                    </span>
                                                    <input type="file" name="news_file" id="news_file" class="default" />
                                                    <input required="" type="hidden" id="hdn_image" value="<?php if(isset($news['image'])) echo $news['image'] ?>" name="hdn_image"/>
                                                </span>
                                                <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <?php if ($update_id==0) { ?>
                    <div class="row" style="padding-top: 15px;">
                      <div class="col-sm-10">
                          <div class="form-group">
                            <div class="control-label col-md-3">
                              <label>Applying Subject</label>
                            </div>
                            <div class="col-md-9">
                              <select name="subject" id="subject" class="chosen1 form-control subject" tabindex="9">
                                <option value=""></option>
                              <?php if(isset($subjects) && !empty($subjects))
                              foreach ($subjects as $key => $value):?>
                                <option  value="<?php echo $value['subject_id'].','.$value['subject_name'].','.$value['class_id'].','.$value['class_name'].','.$value['section_id'].','.$value['section_name'].','.$value['teacher_id'].','.$value['teacher_name'].','.$value['amount'] ?>"><?php echo $value['subject_name'].' - '.$value['class_name'].' - '.$value['section_name'].' - '.$value['teacher_name'].' - '.$value['amount'] ?></option>
                              <?php endforeach; ?>
                            </select>
                            </div>
                        </div>
                      </div>
                    <button class="btn btn-primary add_subject btn-lg" tabindex="10" style="border-radius: 7px !important;padding-left: 30px;padding-right: 30px;font-size: 20px;">Add</button>
                    </div>
                    <div class="row" style="padding-top: 20px;">
                      <div class="col-md-1">
                      </div>
                      <div class="col-md-10">
                      <table style="width: 100%;">
                      <thead>
                       <tr>
                        <th>Subject</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Teacher</th>
                        <th>Fee</th>
                        <th>Actions</th>
                       </tr>
                      </thead>
                      <tbody id="table_data">
                      </tbody>
                     </table>
                      </div>
                    </div>
                    <div class="row" style="padding-top: 15px;">
                      <div class="col-md-4"></div>
                      <div class="col-md-7">
                        <div class="row">
                          <div class="col-md-6">
                            <h4 style="text-align: right;">Total Fee</h4>
                          </div>
                          <div class="col-md-6">
                            <input type="number" readonly name="total" value="0" class="form-control" style="text-align: center;">
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                </div>


                  <div class="form-actions fluid no-mrg" style="padding-top: 25px; ">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="col-md-offset-2 col-md-9" style="padding-bottom:15px;">
                       <span style="margin-left:40px"></span> <button type="submit" id="button1" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp;Save</button>
                        <a href="<?php echo ADMIN_BASE_URL . 'student'; ?>">
                        <button type="button" class="btn green btn-default" style="margin-left:20px;"><i class="fa fa-undo"></i>&nbsp;Cancel</button>
                        </a> </div>
                    </div>
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


<script>
$(document).ready(function() {

  $("#user_name").change(function(){
        
             $("#message").html("<img src='<?= STATIC_ADMIN_IMAGE?>ajax-loader.gif' />"); 
            var user_name=$("#user_name").val();
      //alert(user_name);
              $.ajax({
                    type:"post",
                    data: {'user_name': user_name},
                   url: "<?php echo ADMIN_BASE_URL?>users/validate",
                            
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

  $(document).on("click", ".add_subject", function(event){
  event.preventDefault();
  var subject = $(this).parent().find('select[name=subject]').val();
  var total = $('input[name=total]').val();
    $.ajax({
                type: 'POST',
                url: "<?php echo ADMIN_BASE_URL?>student/add_subject",
                data: {'subject': subject ,'total' :total },
                dataType: 'json',
                async: false,
                success: function(result) {
                  $("#table_data").append(result[0]);
                  $('input[name=total]').val(result[1]);
              }
    });
  });

  $(document).on("click", ".delete", function(event){
    event.preventDefault();
    var amount = $(this).attr('amount');
    var total = $('input[name=total]').val();
    $('input[name=total]').val(total-amount);
  });


  $("#news_file").change(function() {
    var img = $(this).val();
    var replaced_val = img.replace("C:\\fakepath\\", '');
    $('#hdn_image').val(replaced_val);
  });

  $(".chosen1").chosen();

});

$.validator.setDefaults({
  ignore: []
});

function delete_row(x){
  var row_id = x.parentNode.parentNode.rowIndex;
  document.getElementById("table_data").deleteRow(row_id-1);
};

</script>