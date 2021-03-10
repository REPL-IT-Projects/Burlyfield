<?php 
//////////////////////////////////// check user login or not ///////////////////////////////////
 if (isset($_SESSION['login_user']) && $_SESSION['login_user'] == 'vendor'){
     redirect(base_url().'vendor/dashboard'); 
 } 
?> 
<!DOCTYPE html>
<html>
   <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>CI Ecommerce Vendor</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="robots" content="all,follow">
      <!-- Bootstrap CSS-->
      <link rel="stylesheet" href="<?php echo base_url();?>public/vendor_assets/bootstrap/css/bootstrap.min.css">
      <!-- Font Awesome CSS-->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <!-- Google fonts - Popppins for copy-->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,800">
      <!-- orion icons-->
      <link rel="stylesheet" href="<?php echo base_url();?>public/vendor_assets/css/orionicons.css">
      <!-- theme stylesheet-->
      <link rel="stylesheet" href="<?php echo base_url();?>public/vendor_assets/css/style.default.css" id="theme-stylesheet">
      <!-- Custom stylesheet - for your changes-->
      <link rel="stylesheet" href="<?php echo base_url();?>public/vendor_assets/css/custom.css">
      <!-- Favicon-->
      
      <script src="<?php echo base_url();?>public/vendor_assets/jquery/jquery.min.js"></script>
      
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
   </head>
   <body>
       
      <!-- navbar-->
    <!--   <header class="header">
         <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow">
            <a href="#" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"><i class="fas fa-align-left"></i></a><a href="JavaScript:;" class="navbar-brand font-weight-bold text-uppercase text-base"><img src="<?php echo base_url();?>public/front_assets/images/vruits-logo.png" style="width: 50px;"></a>
            
            
         </nav>
      </header> -->
      <div class="login-page">
      <div class="page-holder d-flex align-items-center">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="login-r-img">
              <img src="<?php echo base_url();?>public/front_assets/images/login-bg.png">
            </div>
          </div>
          <div class="col-lg-6 px-lg-6">
            <div class="login-right">
              <div class="login-logo"><img src="<?php echo base_url();?>public/front_assets/images/vruits-logo.png" style="width: 100px;"></div>
            <h1 class="text-base text-primary text-uppercase mb-4">Vendor Dashboard</h1>
            <h2 class="mb-4">Login Now</h2>
            <div id="msgSubmit_Error"></div>
            <form id="vendor_login_form" action="javascript:;" method="post" class="mt-4">
              <div class="form-group mb-4">
                  <input class="form-control border-0 shadow form-control-lg" placeholder="Mobile No." id="var_mobile_no" name="var_mobile_no" type="text" value="" required="">
              </div>
              <div class="form-group mb-4">
                  <input class="form-control border-0 shadow form-control-lg text-violet js-child-focus js-visible-password" placeholder="Password" name="password" id="password" type="password" value="" required="">
                 
              </div>
<!--            <div class="forgot-password">
          <a href="javascript:;" type="button" data-toggle="modal" data-target="#forgotVendorModal" >
            Forgot your password?
          </a>
           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#forgotVendorModal">
  Forgot your password?
</button> 
        </div>-->
      </br>
              <button type="submit" class="btn btn-primary shadow px-5">Log in</button>
            </form>
          </div></div>
        </div>
          
          <!-- <p class="mt-5 mb-0 text-gray-400 text-center">Copyright <i class="fa fa-copyright"></i> <a href="" target="_blank"></a> 2020 All Rights Reserved</p> -->
       
      </div>
    </div>
 </div>
      
      
<div class="modal fade" id="otpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">OTP Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div id="msgSubmit_modal"></div>
         <form method="post" id="user_otp_form" action="javascript:;">
            <input type="hidden" name="fk_user" id="fk_user" value="">

            <div class="form-group row ">
				<label class="col-md-2 form-control-label required">OTP Number</label>
				<div class="col-md-7">
					<input type="text" name="var_otp" id="var_otp" class="form-control" required="">
				</div>
				<div class="col-md-3 form-control-comment">
				</div>
			</div>
         
         <button type="button" class="btn btn-primary" onclick="resend_otp();">Resend</button>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="forgotVendorModal">
	<div class="modal-dialog">
        <div class="modal-content">     
        	<div class="modal-body">
	        	<button type="button" class="close" data-dismiss="modal">×</button>
	        	<h4 class="modal-title">Forgot Password</h4>
	        	<div id="msgForgot_modal"></div>
	        	<br>
	        	<form class="sign-in-form" id="frm_forgotpass" action="javascript:;">                
	        		<p class="text-center text-muted">Please submit your registered email address or mobile no. A message will be sent to registered email address or mobile no. generating to new password.</p>
              <br>
	        		<div class="form-group">
	        			<label for="var_email" class="sr-only">Email address</label>
	        			<input type="text" name="var_email" id="var_email" class="form-control" placeholder="Email address OR Mobile No." required="">
	        		</div>
	        		<button class="btn btn-primary btn-rounded btn-floating btn-lg btn-block" type="submit">Send</button>
        		</form>
        	</div>
        </div>
	</div>
</div>

<script type="text/javascript">

var site_path = '<?php echo base_url(); ?>';

function toggle_password() {
   var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

	function submitMSG_client(valid, msg) {
    if (valid) {
        var msgClasses = "h3 text-center tada animated text-success";
    } else {
        var msgClasses = "h3 text-center text-danger";
    }

    $("#msgSubmit_Error").removeClass().addClass(msgClasses).text(msg);
}

   function formSuccess_client() {
        // $("#member_infofrm")[0].reset();
        submitMSG_client(true, "User Details Submitted Successfully.");
   }

   //$("#basicinfofrm").validator().on("submit", function (event) {
  $("form#vendor_login_form").submit(function() {
  //  $('#client_infobtn').attr('disabled', true);

     $(".loading").show();

        var formData = new FormData($(this)[0]);

        if (formData == '') {
            formError_career();
            submitMSG_client(false, "Please fill all details");
            //   $('#client_infobtn').attr('disabled', false);
        } else {
            $.ajax({
                url: site_path + "vendor/vendor_signin",
                type: 'POST',
                data: formData,
                async: false,
                success: function(response) {
                	//alert(response)
                	var res_arr = response.split("#");
					        var res_msg = res_arr[0];
					        var res_user = res_arr[1];

                    $(".loading").hide();
                    if (response == 'failed') {
                        var msg = 'Invalid Mobile no. OR Password !';
                        var msgClasses = "h3 text-center tada animated text-danger";
                        $("#msgSubmit_Error").removeClass().addClass(msgClasses).text(msg);
                        //window.location.reload();
                        
                    } else if(res_msg == 'otp_verify'){
                       	//$("#forgetFrm")[0].reset();
                       	$('#fk_user').val(res_user);
                        $("#otpModal").modal('show');

                    } else {
                        var msg = 'Your Login Successfully !';
                        var msgClasses = "h3 text-center tada animated text-success";
                        $("#msgSubmit_Error").removeClass().addClass(msgClasses).text(msg);
                        window.location.href = site_path+'vendor';
                    }
                },

                cache: false,
                contentType: false,
                processData: false

            });
            return false;
        }
});

function resend_otp()
{
  var mobile_no = $('#var_mobile_no').val();
  var fk_user = $('#fk_user').val();
  $.ajax({
      url: site_path + "vendor/resend_otp",
      dataType: 'json',
      type: 'GET',
      data: { fk_user: fk_user,
        mobile_no: mobile_no },
      async: false,
      success: function(response) {

        var msg = 'OTP Sent Successfully !';
        var msgClasses = "h3 text-center tada animated text-success";
        $("#msgSubmit_modal").removeClass().addClass(msgClasses).text(msg);
          //window.location.reload();
                
        },
    });
}

$("form#user_otp_form").submit(function() {

    var var_otp = $('#var_otp').val();
   // var fk_user = $('#fk_user').val();

    if (var_otp == '') {
      var msg = 'Please enter received OTP !';
      var msgClasses = "h3 text-center tada animated text-danger";
      $("#msgSubmit_modal").removeClass().addClass(msgClasses).text(msg);
    } else {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: site_path + "vendor/vendor_verify_otp",
            type: 'POST',
            data: formData,
            async: false,
            success: function(response) {
              //alert(response)
                if (response == '') {

                    var msg = 'OTP Not Matched !';
                    var msgClasses = "h3 text-center tada animated text-danger";
                    $("#msgSubmit_modal").removeClass().addClass(msgClasses).text(msg);
                    //window.location.reload();
                    return false;
                } else {

                    window.location.href = site_path+'vendor';
                }
            },

            cache: false,
            contentType: false,
            processData: false

        });
    }
});

$('#frm_forgotpass').submit(function() {

	var formData = new FormData($(this)[0]);

    $.ajax({
    url: site_path + "vendor/vendorForgotPassword",
    type: 'POST',
    data: formData,
    async: false,
    success: function(response) {
    	if(response == "failed_data"){
                var msg = 'Please enter your registerd email address or mobile no. !';
                var msgClasses = "h3 text-center tada animated text-danger";
                $("#msgForgot_modal").removeClass().addClass(msgClasses).text(msg);
           } else if(response == 'failed'){
                var msg = 'Something wrong when email sent !';
                var msgClasses = "h3 text-center tada animated text-danger";
                $("#msgForgot_modal").removeClass().addClass(msgClasses).text(msg);
          } else {
              var msg = 'Message sent Successfully !';
            var msgClasses = "h3 text-center tada animated text-success";
            $("#msgForgot_modal").removeClass().addClass(msgClasses).text(msg);

		        window.location.href = site_path+'vendor';
           }
       },
       		  cache: false,
            contentType: false,
            processData: false
      
    });
  });
</script>