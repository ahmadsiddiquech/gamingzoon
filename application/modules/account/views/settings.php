<style type="text/css">
    hr{ 
      height: 1px;
      color: red;
      background-color: red;
      border: none;
    }
/* Popup container - can be anything you want */
.popup {
  position: relative;
  display: inline-block;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* The actual popup */
.popup .popuptext {
  visibility: hidden;
  width: 160px;
  background-color: #28a745;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 8px 0;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -80px;
}

/* Popup arrow */
.popup .popuptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

/* Toggle this class - hide and show the popup */
.popup .show {
  visibility: visible;
  -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s;
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
  from {opacity: 0;} 
  to {opacity: 1;}
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity:1 ;}
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
                    <div class="col-md-12" style="background-color: #540000; border-radius: 2px;">
                        <h4 style="color: white;padding: 5px;">Security Settings</h4>
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-lg-6">
                        <label style="padding: 10px;">Logout in all Browsers</label>
                    </div>
                    <div class="col-lg-6">
                        <a href="<?=BASE_URL?>front/logout" class="btn btn-success pull-right">Logout</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12" style="background-color: #540000; border-radius: 2px;">
                        <h4 style="color: white;padding: 5px;">Account Settings</h4>
                    </div>
                </div>
                <div class="row pt-4 ">
                    <div class="col-lg-6">
                        <label style="padding: 10px;">Block e-mail sign in</label>
                    </div>
                    <div class="col-lg-6">
                        <button onclick="myFunction1()" class="btn btn-danger pull-right popup">Block
                        <span class="popuptext" id="myPopup1">Blocked!&nbsp;<span class="fa fa-check"></span></span></button>
                    </div>
                    <div class="col-lg-6">
                        <label style="padding: 10px;">Show balance in to panel</label>
                    </div>
                    <div class="col-lg-6">
                        <button onclick="myFunction2()" class="btn btn-primary pull-right popup">Show/Hide
                        <span class="popuptext" id="myPopup2">Done!&nbsp;<span class="fa fa-check"></span></span></button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" style="background-color: #540000; border-radius: 2px;">
                        <h4 style="color: white;padding: 5px;">Promo Code Check</h4>
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="promocode" placeholder="Enter Your Promo Code">
                    </div>
                    <div class="col-md-3">
                        <button onclick="myFunction4()" class="btn btn-secondary pull-right popup">History
                        <span class="popuptext" id="myPopup4" style="background-color: #dc3545">No Record Found!&nbsp;<span class="fa fa-close"></span></span></button>
                        <button onclick="myFunction3()" class="btn btn-success pull-right popup" style="margin-right: 10px;">Check
                        <span class="popuptext" id="myPopup3" style="background-color: #dc3545">Invalid Promo code!&nbsp;<span class="fa fa-close"></span></span></button>
                    </div>
                </div>
                    
            </div>
        </div>
    </section>
    <script>
// When the user clicks on div, open the popup
function myFunction1() {
  var popup = document.getElementById("myPopup1");
  popup.classList.toggle("show");
}

function myFunction2() {
  var popup = document.getElementById("myPopup2");
  popup.classList.toggle("show");
}
function myFunction3() {
  var popup = document.getElementById("myPopup3");
  popup.classList.toggle("show");
}
function myFunction4() {
  var popup = document.getElementById("myPopup4");
  popup.classList.toggle("show");
}
</script>