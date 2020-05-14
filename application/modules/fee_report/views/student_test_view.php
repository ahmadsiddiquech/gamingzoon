<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<style type="text/css">
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
                    $strTitle = 'Student Test Report';
                else 
                    $strTitle = 'Student Test Report';
                    echo $strTitle;
                    ?>
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
                        }
                        if (isset($hidden) && !empty($hidden))
                            echo form_open_multipart(ADMIN_BASE_URL . 'fee_report/student_test_submit/' . $update_id, $attributes, $hidden);
                        else
                            echo form_open_multipart(ADMIN_BASE_URL . 'fee_report/student_test_submit/' . $update_id, $attributes);
                        ?>
                  <div class="form-body">
              <div class="row" style="margin-top:15px;">
                <div class="col-sm-5">
                    <div class="form-group">
                      <div class="control-label col-md-4">
                        <label>Student</label>
                      </div>
                      <div class="col-md-8">
                        <select name="student_id" id="student_id" class="form-control chosen1" required="required">
                        <option value=""></option>
                        <?php if(isset($student) && !empty($student))
                        foreach ($student as $key => $value):?>
                          <option value="<?php echo $value['id'].','.$value['name'] ?>"><?php echo $value['name'].' - '.$value['parent_name'].' - '.$value['class_name'].' - '.$value['section_name'];?></option>
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
                          'name' => 'from_date',
                          'id' => 'from_date',
                          'class' => 'form-control',
                          'type' => 'date',
                          'tabindex' => '2',
                          'value' => date('Y-m-d')
                          );
                          $attribute = array('class' => 'control-label col-md-4');
                          ?>
                    <?php echo form_label('From Date', 'from_date', $attribute); ?>
                    <div class="col-md-8"> <?php echo form_input($data); ?></div>
                  </div>
                </div>
                <div class="col-sm-5">
                  <div class="form-group">
                    <?php
                          $data = array(
                          'name' => 'to_date',
                          'id' => 'to_date',
                          'class' => 'form-control',
                          'type' => 'date',
                          'tabindex' => '2',
                          'value' => date('Y-m-d')
                          );
                          $attribute = array('class' => 'control-label col-md-4');
                          ?>
                    <?php echo form_label('To Date', 'to_date', $attribute); ?>
                    <div class="col-md-8"> <?php echo form_input($data); ?></div>
                  </div>
                </div>
              </div>
  
            </div>
            </div>
                  <div class="form-actions fluid no-mrg">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="col-md-offset-2 col-md-9" style="padding-bottom:15px;">
                       <span style="margin-left:40px"></span> <button type="submit" id="button1" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp;Submit</button>
                     </div>
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

  $("#program_id").change(function () {
        var program_id = this.value;
       $.ajax({
            type: 'POST',
            url: "<?php echo ADMIN_BASE_URL?>fee_report/get_class",
            data: {'id': program_id },
            async: false,
            success: function(result) {
            $("#class_id").html(result);
          }
        });
  });

  $("#class_id").change(function () {
        var class_id = this.value;
           $.ajax({
            type: 'POST',
            url: "<?php echo ADMIN_BASE_URL?>fee_report/get_section",
            data: {'id': class_id },
            async: false,
            success: function(result) {
            $("#section_id").html(result);
          }
        });
  });
    $("#news_file").change(function() {
        var img = $(this).val();
        var replaced_val = img.replace("C:\\fakepath\\", '');
        $('#hdn_image').val(replaced_val);
    });
});

$(".chosen1").chosen();

$.validator.setDefaults({ 
  ignore: []
});

</script>