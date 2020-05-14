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
        Cash Received
   <a href="<?php echo ADMIN_BASE_URL . 'account/transaction_list'; ?>"><button type="button" class="btn btn-lg btn-primary pull-right"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;&nbsp;<b>Back</b></button></a></h3>
            
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
                            echo form_open_multipart(ADMIN_BASE_URL . 'account/submit_cash_received/' . $update_id, $attributes, $hidden);
                        else
                            echo form_open_multipart(ADMIN_BASE_URL . 'account/submit_cash_received/' . $update_id, $attributes);
                          date_default_timezone_set("Asia/Karachi");
                        ?>
                  <div class="form-body">
                    
               <div class="row" style="margin-top:15px;">
                      <div class="col-sm-5">
                        <div class="form-group">
                          <?php
                                                        $data = array(
                                                        'name' => 'fee_issue_date',
                                                        'id' => 'fee_issue_date',
                                                        'class' => 'form-control',
                                                        'type' => 'datetime-local',
                                                        'tabindex' => '1',
                                                        'data-parsley-maxlength'=>TEXT_BOX_RANGE
                                                        );
                                                        $attribute = array('class' => 'control-label col-md-4');
                                                        ?>
                                                        
                          <?php echo form_label('Fee Issue Date', 'fee_issue_date', $attribute); ?>
                          <div class="col-md-8"> <?php echo form_input($data); ?> </div>
                        </div>
                      </div>
                      <div class="col-sm-5">
                      <div class="form-group">
                          <?php
                                                        $data = array(
                                                        'name' => 'fee_month',
                                                        'id' => 'fee_month',
                                                        'class' => 'form-control',
                                                        'type' => 'datetime-local',
                                                        'tabindex' => '4',
                                                        'data-parsley-maxlength'=>TEXT_BOX_RANGE
                                                        );
                                                        $attribute = array('class' => 'control-label col-md-4');
                                                        ?>
                                                        
                          <?php echo form_label('Fee Month', 'fee_month', $attribute); ?>
                          <div class="col-md-8"> <?php echo form_input($data); ?> </div>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-5">
                          <div class="form-group">
                            <div class="control-label col-md-4">
                              <label>Account To</label>
                            </div>
                            <div class="col-md-8">
                              <select name="account_to" id="account_to" class="chosen1 form-control" required="required" tabindex="2" required="required">
                                <option value=""></option>
                              <?php if(isset($account) && !empty($account))
                              foreach ($account as $key => $value):?>
                                <option <?php if ($value['type'] == 'Cash-in-hand') {
                                  print_r("selected");
                                } ?> &nbsp; value="<?php echo $value['id'].','.$value['name'].','.$value['type']?>">
                                  <?php echo $value['name'].' - '.$value['type'].' - '.$value['remaining'].' PKR';?></option>
                              <?php endforeach; ?>
                            </select>
                            </div>
                          </div>
                      </div>
                        <div class="col-sm-5">
                        <div class="form-group">
                          <?php
                                                        $data = array(
                                                        'name' => 'comment',
                                                        'id' => 'comment',
                                                        'class' => 'form-control',
                                                        'type' => 'text',
                                                        'tabindex' => '3',
                                                        'data-parsley-maxlength'=>TEXT_BOX_RANGE
                                                        );
                                                        $attribute = array('class' => 'control-label col-md-4');
                                                        ?>
                                                        
                          <?php echo form_label('Comment', 'comment', $attribute); ?>
                          <div class="col-md-8"> <?php echo form_input($data); ?></div>
                        </div>

                      </div>
                      </div>
                      <div class="row" style="padding-top: 15px;">
                      <div class="col-md-1"></div>
                      <div class="col-sm-9">
                          <div class="form-group">
                            <div class="control-label col-md-1">
                              <label>Subject</label>
                            </div>
                            <div class="col-md-11">
                              <select name="subject" id="subject" class="chosen1 form-control subject" tabindex="9">
                                <option value=""></option>
                              <?php if(isset($subjects) && !empty($subjects))
                              foreach ($subjects as $key => $value):?>
                                <option  value="<?php echo $value['subject_id'].','.$value['subject_name'].','.$value['class_id'].','.$value['class_name'].','.$value['section_id'].','.$value['section_name'].','.$value['teacher_id'].','.$value['teacher_name'].','.$value['amount'].','.$value['std_id'].','.$value['std_name'].','.$value['parent_id'].','.$value['parent_name'] ?>"><?php echo $value['std_name'].' - '.$value['parent_name'].' - '.$value['class_name'].' - '.$value['section_name'].' - '.$value['teacher_name'].' - '.$value['subject_name'].' - '.$value['amount'] ?></option>
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
                        <th>Student</th>
                        <th>Parent</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Teacher</th>
                        <th>Subject</th>
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
                        <!-- <div class="row">
                          <div class="col-md-6">
                            <h4 style="text-align: right;">Cash Received</h4>
                          </div>
                          <div class="col-md-6">
                            <input type="number" min="0" name="paid" id="paid" class="form-control" value="" style="text-align: center;" tabindex="8">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <h4 style="text-align: right;">Remaining</h4>
                          </div>
                          <div class="col-md-6">
                            <input type="number" readonly name="remaining" id="remaining" class="form-control" value="0" style="text-align: center;">
                          </div>
                        </div> -->
                      </div>
                    </div>
              </div>
              </div>

                  <div class="form-actions fluid no-mrg">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="col-md-offset-2 col-md-9" style="padding-bottom:15px;">
                       <span style="margin-left:40px"></span> <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp;Save</button> </div>
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
      document.getElementById("fee_issue_date").defaultValue = "<?php echo date('Y-m-d').'T'.date('H:i:s')?>";

      document.getElementById("fee_month").defaultValue = "<?php echo date('Y-m-d').'T'.date('H:i:s')?>";
      <?php if($this->session->flashdata('success')){ ?>
        toastr.success("<?php echo $this->session->flashdata('success'); ?>");
      <?php } elseif ($this->session->flashdata('error')) { ?>
        toastr.error("<?php echo $this->session->flashdata('error'); ?>");
      <?php } ?>

  $(document).on("click", ".add_subject", function(event){
  event.preventDefault();
  var subject = $(this).parent().find('select[name=subject]').val();
  var total = $('input[name=total]').val();
    $.ajax({
                type: 'POST',
                url: "<?php echo ADMIN_BASE_URL?>account/add_subject",
                data: {'subject': subject ,'total' :total },
                dataType: 'json',
                async: false,
                success: function(result) {
                  $("#table_data").append(result[0]);
                  $('input[name=total]').val(result[1]);
                  // $('input[name=remaining]').val(result[1]);
                  // $('input[name=paid]').attr({
                  //    "max" : result[1],
                  //    "min" : 0
                  // });
              }
    });
  });

  $(document).on("click", ".delete", function(event){
    event.preventDefault();
    var amount = $(this).attr('amount');
    var total = $('input[name=total]').val();
    $('input[name=total]').val(total-amount);
  });

//   $('input[name=paid]').keyup(function() {
//     var paid = parseInt($('input[name=paid]').val());
//     var total = parseInt($('input[name=total]').val());
//     var remaining = total - paid;
//     if (remaining > 0) {
//       $('input[name=remaining]').val(remaining);
//     }
//     else{
//       $('input[name=remaining]').val(0);
//     }
// });


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