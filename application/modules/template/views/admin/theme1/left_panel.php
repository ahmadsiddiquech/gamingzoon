<?php    
	$curr_url = $this->uri->segment(2);
	$active="active";
  $role_id = $this->session->userdata('user_data')['role_id'];
  $outlet_id = DEFAULT_OUTLET;
?>
<!-- sidebar-->
<aside class="aside" >
 <!-- START Sidebar (left)-->
 <div class="aside-inner" >
    <nav data-sidebar-anyclick-close="" class="sidebar">
       <!-- START sidebar nav-->
       <ul class="nav page-sidebar-menu">
          <!-- Iterates over all sidebar items-->
            <?php $permission = false;
              if ($user_data['role'] != 'portal admin')
                  $permission = Modules:: run('permission/has_control_permission',$role_id,$outlet_id,'dashboard');
              else  
                  $permission = true; 
              if ($permission){?>
               <li class="<?php if($curr_url == 'dashboard'){echo 'active';}    ?>">
                  <a href="<?php $controller='dashboard'; 
                     echo ADMIN_BASE_URL . $controller ?>">
                     <em class="fa fa-home"></em>
                     <span>Dashboard</span>
                  </a>
                </li>
              <?php
            }?>
            <?php $permission = false;
              if ($user_data['role'] != 'portal admin')
                  $permission = Modules:: run('permission/has_control_permission',$role_id,$outlet_id,'account');
              else
                  $permission = true; 
              if ($permission){?>
                <li>
                  <a href="#account" data-toggle="collapse">
                      <em class="fa fa-male"></em>
                      <span>Account</span>
                      <i class="fa fa-caret-down"></i>
                  </a>
                  <ul id="account" class="nav sidebar-subnav collapse" style="padding-left: 30px">
                      <li class="<?php if($curr_url == 'account'){echo 'active';}    ?>">
                        <a href="<?php $controller='account';
                          echo ADMIN_BASE_URL . $controller ?>">
                          <em class="fa fa-file-text-o"></em>
                          <span>View Account</span>
                        </a>
                      </li>
                      <li class="<?php if($curr_url == 'account/chart_of_account'){echo 'active';}    ?>">
                        <a href="<?php $controller='account/chart_of_account';
                          echo ADMIN_BASE_URL . $controller ?>">
                          <em class="fa fa-pie-chart"></em>
                          <span>Chart of Account</span>
                        </a>
                      </li>
                  </ul>
                </li>
              <?php
            }?>
            <?php $permission = false;
              if ($user_data['role'] != 'portal admin')
                  $permission = Modules:: run('permission/has_control_permission',$role_id,$outlet_id,'account');
              else  
                  $permission = true; 
              if ($permission){?>
               <li>
                  <a href="#transaction" data-toggle="collapse">
                      <em class="fa fa-dollar"></em>
                      <span>Transaction</span>
                      <i class="fa fa-caret-down"></i>
                  </a>
                  <ul id="transaction" class="nav sidebar-subnav collapse" style="padding-left: 30px">
                      <li class="<?php if($curr_url == 'account/cash_payment'){echo 'active';}    ?>">
                        <a href="<?php $controller='account/cash_payment';
                          echo ADMIN_BASE_URL . $controller ?>">
                          <em class="fa fa-plus-square"></em>
                          <span>Cash Payment</span>
                        </a>
                      </li>
                      <li class="<?php if($curr_url == 'account/cash_received'){echo 'active';}    ?>">
                        <a href="<?php $controller='account/cash_received';
                          echo ADMIN_BASE_URL . $controller ?>">
                          <em class="fa fa-plus-square"></em>
                          <span>Cash Received</span>
                        </a>
                      </li>
                      <li class="<?php if($curr_url == 'account/transaction_list'){echo 'active';}    ?>">
                        <a href="<?php $controller='account/transaction_list';
                          echo ADMIN_BASE_URL . $controller ?>">
                          <em class="fa fa-file-text-o"></em>
                          <span>Transaction Report</span>
                        </a>
                      </li>
                  </ul>
                </li>
              <?php
            }?>
            <?php $permission = false;
              if ($user_data['role'] != 'portal admin')
                  $permission = Modules:: run('permission/has_control_permission',$role_id,$outlet_id,'users');
              else
                  $permission = true; 
              if ($permission){?>
                <li class="<?php if($curr_url == 'users'){echo 'active';}    ?>">
                  <a href="<?php $controller='users'; 
                     echo ADMIN_BASE_URL . $controller ?>">
                     <em class="fa fa-user"></em>
                     <span>Users</span>
                  </a>
                </li>
              <?php
            }?>
            <?php $permission = false;
              if ($user_data['role'] != 'portal admin')
                  $permission = Modules:: run('permission/has_control_permission',$role_id,$outlet_id,'student');
              else
                  $permission = true; 
              if ($permission){?>
                <li class="<?php if($curr_url == 'student'){echo 'active';}    ?>">
                <a href="<?php $controller='student'; 
                   echo ADMIN_BASE_URL . $controller ?>">
                   <em class="fa fa-child"></em>
                   <span>Student</span>
                </a>
          </li>
              <?php
            }?>
            <?php $permission = false;
              if ($user_data['role'] != 'portal admin')
                  $permission = Modules:: run('permission/has_control_permission',$role_id,$outlet_id,'roles');
              else
                  $permission = true; 
              if ($permission){?>
                <li class="<?php if($curr_url == 'program'){echo 'active';}    ?>">
                  <a href="<?php $controller='program'; 
                     echo ADMIN_BASE_URL . $controller ?>">
                     <em class="fa fa-th-large"></em>
                     <span>Program</span>
                  </a>
                </li>
              <?php
            }?>
            <?php $permission = false;
              if ($user_data['role'] != 'portal admin')
                  $permission = Modules:: run('permission/has_control_permission',$role_id,$outlet_id,'classes');
              else
                  $permission = true; 
              if ($permission){?>
                <li class="<?php if($curr_url == 'classes'){echo 'active';}    ?>">
                  <a href="<?php $controller='classes'; 
                     echo ADMIN_BASE_URL . $controller ?>">
                     <em class="fa fa-th-list"></em>
                     <span>Class</span>
                  </a>
                </li>
              <?php
            }?>
            <?php $permission = false;
              if ($user_data['role'] != 'portal admin')
                  $permission = Modules:: run('permission/has_control_permission',$role_id,$outlet_id,'sections');
              else
                  $permission = true; 
              if ($permission){?>
                <li class="<?php if($curr_url == 'sections'){echo 'active';}    ?>">
                  <a href="<?php $controller='sections'; 
                     echo ADMIN_BASE_URL . $controller ?>">
                     <em class="fa fa-delicious"></em>
                     <span>Section</span>
                  </a>
                </li>
              <?php
            }?>
            <?php $permission = false;
              if ($user_data['role'] != 'portal admin')
                  $permission = Modules:: run('permission/has_control_permission',$role_id,$outlet_id,'subjects');
              else
                  $permission = true; 
              if ($permission){?>
                <li class="<?php if($curr_url == 'subjects'){echo 'active';}    ?>">
                  <a href="<?php $controller='subjects'; 
                     echo ADMIN_BASE_URL . $controller ?>">
                     <em class="fa fa-book"></em>
                     <span>Subject</span>
                  </a>
                </li>
              <?php
            }?>
            <?php $permission = false;
              if ($user_data['role'] != 'portal admin')
                  $permission = Modules:: run('permission/has_control_permission',$role_id,$outlet_id,'test');
              else
                  $permission = true; 
              if ($permission){?>
                <li class="<?php if($curr_url == 'test'){echo 'active';}    ?>">
                  <a href="<?php $controller='test'; 
                     echo ADMIN_BASE_URL . $controller ?>">
                     <em class="fa fa-pencil"></em>
                     <span>Test</span>
                  </a>
                </li>
              <?php
            }?>
            <?php $permission = false;
              if ($user_data['role'] != 'portal admin')
                  $permission = Modules:: run('permission/has_control_permission',$role_id,$outlet_id,'timetable');
              else
                  $permission = true; 
              if ($permission){?>
                <li class="<?php if($curr_url == 'timetable'){echo 'active';}    ?>">
                  <a href="<?php $controller='timetable'; 
                     echo ADMIN_BASE_URL . $controller ?>">
                     <em class="fa fa-clock-o"></em>
                     <span>Timetable</span>
                  </a>
                </li>
              <?php
            }?>
            <?php $permission = false;
              if ($user_data['role'] != 'portal admin')
                  $permission = Modules:: run('permission/has_control_permission',$role_id,$outlet_id,'fee_report');
              else
                  $permission = true; 
              if ($permission){?>
                <li>
                  <a href="#report" data-toggle="collapse">
                      <em class="fa fa-bar-chart"></em>
                      <span>Report</span>
                      <i class="fa fa-caret-down"></i>
                  </a>
                  <ul id="report" class="nav sidebar-subnav collapse" style="padding-left: 30px">
                      <li class="<?php if($curr_url == 'fee_report'){echo 'active';}    ?>">
                        <a href="<?php $controller='fee_report';
                          echo ADMIN_BASE_URL . $controller ?>">
                          <em class="fa fa-file-text-o"></em>
                          <span>Cash Receiving Report</span>
                        </a>
                      </li>
                      <li class="<?php if($curr_url == 'fee_report/teacher_pay_report'){echo 'active';}    ?>">
                        <a href="<?php $controller='fee_report/teacher_pay_report';
                          echo ADMIN_BASE_URL . $controller ?>">
                          <em class="fa fa-file-text-o"></em>
                          <span>Teacher Pay Report</span>
                        </a>
                      </li>
                      <li class="<?php if($curr_url == 'fee_report/student_fee_report'){echo 'active';}    ?>">
                        <a href="<?php $controller='fee_report/student_fee_report';
                          echo ADMIN_BASE_URL . $controller ?>">
                          <em class="fa fa-file-text-o"></em>
                          <span>Student Fee Report</span>
                        </a>
                      </li>
                      <li class="<?php if($curr_url == 'fee_report/cash_summery'){echo 'active';}    ?>">
                        <a href="<?php $controller='fee_report/cash_summery';
                          echo ADMIN_BASE_URL . $controller ?>">
                          <em class="fa fa-file-text-o"></em>
                          <span>Cash Summery</span>
                        </a>
                      </li>
                    </ul>
                </li>
              <?php
            }?>
            <?php $permission = false;
              if ($user_data['role'] != 'portal admin')
                  $permission = Modules:: run('permission/has_control_permission',$role_id,$outlet_id,'roles');
              else
                  $permission = true; 
              if ($permission){?>
                <li class="<?php if($curr_url == 'roles'){echo 'active';}    ?>">
                  <a href="<?php $controller='roles'; 
                     echo ADMIN_BASE_URL . $controller ?>">
                     <em class="fa fa-money"></em>
                     <span>Roles</span>
                  </a>
                </li>
              <?php
            }?>
            <?php $permission = false;
              if ($user_data['role'] != 'portal admin')
                  $permission = Modules:: run('permission/has_control_permission',$role_id,$outlet_id,'outlet');
              else
                  $permission = true; 
              if ($permission){?>
                <li class="<?php if($curr_url == 'outlet'){echo 'active';}    ?>">
                  <a href="<?php $controller='outlet'; 
                     echo ADMIN_BASE_URL . $controller ?>">
                     <em class="fa fa-money"></em>
                     <span>Outlet</span>
                  </a>
                </li>
              <?php
            }?>
       </ul>
       <!-- END sidebar nav-->
    </nav>
 </div>
 <!-- END Sidebar (left)-->
</aside>




