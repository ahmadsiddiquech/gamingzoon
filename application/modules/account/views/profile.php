<style type="text/css">
    hr{ 
      height: 1px;
      color: red;
      background-color: red;
      border: none;
    }
</style>
<section class="categories-grid-section spad">
        <div class="row" style="margin-right: 0px;">
            <div class="col-md-3">
                <div class="sidebar-option">
                    <div class="social-media">
                        <ul>
                            <li>
                                <a href="<?=BASE_URL?>account" style="color: white"><div class="sm-icon"><i class="fa fa-tachometer"></i></div>
                                <span>Dashboard</span></a>   
                            </li>
                            <li>
                                <a href="<?=BASE_URL?>account/profile" style="color: white"><div class="sm-icon"><i class="fa fa-user-plus"></i></div>
                                <span>Personal Profile</span></a>   
                            </li>
                            <li>
                                <a href="<?=BASE_URL?>account/settings" style="color: white"><div class="sm-icon"><i class="fa fa-cogs"></i></div>
                                <span>Account Settings</span></a>   
                            </li>
                            <li>
                                <a href="<?=BASE_URL?>account/withdraw" style="color: white"><div class="sm-icon"><i class="fa fa-money"></i></div>
                                <span>Withdraw</span></a>   
                            </li>
                            <li>
                                <a href="<?=BASE_URL?>account/deposit" style="color: white"><div class="sm-icon"><i class="fa fa-credit-card"></i></div>
                                <span>Deposit</span></a>   
                            </li>
                            <li>
                                <a href="<?=BASE_URL?>front/logout" style="color: white"><div class="sm-icon"><i class="fa fa-sign-out"></i></div>
                                <span>Logout</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8 pl-5 ml-5" style="color: white">
                <div class="row">
                        <div class="col-md-10">
                            <h4 style="color: white">Account Info</h4>
                        </div>
                        <div class="col-md-2">
                            Edit
                            <input type="checkbox" id="edit" onclick="myFunction()">
                        </div>
                    </div>
                <form action="<?=BASE_URL?>account/update" method="POST">
                    <div class="row pt-2">
                        <div class="col-lg-6">
                            <label>Login ID</label>
                            <input type="text" class="form-control" value="<?=$news[0]['login_id']?>" disabled>
                        </div>
                        <div class="col-lg-6">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" id="password" value="<?=$news[0]['password']?>" disabled>
                        </div>
                        <div class="col-lg-6 pt-4">
                            <label>Join Date</label>
                            <input type="text" class="form-control" name="join_date" id="join_date" value="<?=$news[0]['join_date']?>" disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="row pt-4">
                        <div>
                            <h4 style="color: white">Contact Details</h4>
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-lg-6">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" value="<?=$news[0]['phone']?>" disabled>
                        </div>
                        <div class="col-lg-6">
                            <label>Email Address</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?=$news[0]['email']?>" disabled>
                        </div>
                        <div class="col-lg-6 pt-4">
                            <label>Skype</label>
                            <input type="text" class="form-control" name="skype" id="skype" value="<?=$news[0]['skype']?>" disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="row pt-4">
                        <div>
                            <h4 style="color: white">Personal Details</h4>
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-lg-6">
                            <label>Full Name</label>
                            <input type="text" class="form-control" name="fullname" id="fullname" value="<?=$news[0]['fullname']?>" disabled>
                        </div>
                        <div class="col-lg-6">
                            <label>Gender</label>
                            <input type="text" class="form-control" name="gender" id="gender" value="<?=$news[0]['gender']?>" disabled>
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-lg-6">
                            <label>Date of Birth</label>
                            <input type="text" class="form-control" name="date_of_birth" id="date_of_birth" value="<?=$news[0]['date_of_birth']?>" disabled>
                        </div>
                        <div class="col-lg-6">
                            <label>Country</label>
                            <input type="text" class="form-control" value="<?=$news[0]['country']?>" disabled>
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-lg-6">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" id="address" value="<?=$news[0]['address']?>" disabled>
                        </div>
                    </div>
                    <hr>
                    <button class="form-control btn btn-success" id="submit" disabled type="submit">Save</button>
                </form>
            </div>
        </div>
    </section>
<script>
function myFunction() {
  var checkBox = document.getElementById("edit");
  if (checkBox.checked == true){
    $('#password').prop('disabled', false);
    $('#join_date').prop('disabled', false);
    $('#phone').prop('disabled', false);
    $('#email').prop('disabled', false);
    $('#skype').prop('disabled', false);
    $('#fullname').prop('disabled', false);
    $('#gender').prop('disabled', false);
    $('#date_of_birth').prop('disabled', false);
    $('#address').prop('disabled', false);
    $('#submit').prop('disabled', false);
  } else {
    $('#password').prop('disabled', true);
    $('#join_date').prop('disabled', true);
    $('#phone').prop('disabled', true);
    $('#email').prop('disabled', true);
    $('#skype').prop('disabled', true);
    $('#fullname').prop('disabled', true);
    $('#gender').prop('disabled', true);
    $('#date_of_birth').prop('disabled', true);
    $('#address').prop('disabled', true);
    $('#submit').prop('disabled', true);
  }
}
</script>