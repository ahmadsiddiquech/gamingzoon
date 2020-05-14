
<div class="page-content-wrapper">
  <div class="page-content"> 
    <div class="content-wrapper">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3>
        <?php 
        if (empty($update_id)) 
                    $strTitle = 'Cash Receiving Report';
                else 
                    $strTitle = 'Cash Receiving Report';
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
                            echo form_open_multipart(ADMIN_BASE_URL . 'fee_report/submit/' . $update_id, $attributes, $hidden);
                        else
                            echo form_open_multipart(ADMIN_BASE_URL . 'fee_report/submit/' . $update_id, $attributes);
                        ?>
                  <div class="form-body">
              <div class="row" style="margin-top:15px;">
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
    $("#news_file").change(function() {
        var img = $(this).val();
        var replaced_val = img.replace("C:\\fakepath\\", '');
        $('#hdn_image').val(replaced_val);
    });
});


</script>