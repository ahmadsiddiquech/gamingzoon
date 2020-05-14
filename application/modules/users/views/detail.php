
<div class="page-content-wrapper">
<?php // print_r($news['title']);exit; ?>
        <!-- END PAGE HEADER-->
       
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                       
                            <div class="form-body">                               
                            
                                 <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group mrg-b-5">
                                            <label class="control-label col-md-4"><b>User Name:</b></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">
                                                    <?php echo $users_res['user_name']; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                   
                                 </div>

                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><b>Full Name:</b></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">
                                                   <?php echo $users_res['full_name']?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><b>Address1:</b></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">
                                                   <?php echo $users_res['address1']; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><b>Address2:</b></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">
                                                   <?php echo $users_res['address2']; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><b>Distance:</b></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">
                                                   <?php echo $users_res['city']; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    
                                    <!--/span-->
                                </div>
                                
                                <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><b>State:</b></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">
                                                   <?php echo $users_res['state']; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4"><b>Phone:</b></label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">
                                                   <?php echo $users_res['phone']; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    
                                    <!--/span-->
                                </div>
                            </div>
                        
                        <!-- END FORM-->
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
<!--    </div>-->
</div>
</div>
