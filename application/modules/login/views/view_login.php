<?php 
//////////////////////////////////// check user login or not ///////////////////////////////////
if (isset($_SESSION['fk_user'])){
    redirect(base_url());
}
?> 			
      <section class="breadcrumb-area" style="background-image:url(<?php echo base_url(); ?>public/front_assets/images/background/20Login.jpg);">
			    
			</section>


	        <!-- Account Page Content*********************** -->
	        <div class="account_page">
	        	<div class="container">
	        		<div class="row">
	        			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 login_form">
	        				<div class="theme-title">
								<h2>Login Now</h2>
							</div>
							 <div id="msgSubmit_Error"></div> 
	        				<form id="user_login_form" action="javascript:;" method="post" autocomplete="off">
	        					<input type="hidden" name="back" value="my-account">
	        					<div class="form_group">
	        						<label>Mobile Number</label>
	        						<div class="input_group">
	        							<input class="form-control" type="text" id="var_mobile_no" name="var_mobile_no" type="text" value="" required="" onkeypress="return isNumberKey(event);" maxlength="10" minlength="10" placeholder="0987654321">
	        							<i class="fa fa-phone" aria-hidden="true"></i>
	        						</div> <!-- End of .input_group -->
	        					</div> <!-- End of .form_group -->

	        					<div class="form_group">
	        						<label>Password</label>
	        						<div class="input_group">
	        							<input class="form-control js-child-focus js-visible-password" name="password" id="password" type="password" value="" required="" placeholder="******">
	        							<i class="fa fa-lock" aria-hidden="true"></i>
	        						</div> <!-- End of .input_group -->
	        					</div> <!-- End of .form_group -->

	        					<div class="clear_fix">
	        						<div class="float_left">
										<a onclick="toggle_password()">Show Password</a>
									</div> <!-- End .single_checkbox -->
									<a class="float_right" href="javascript:;" data-toggle="modal" data-target="#forgotpassModal">Forgot Password?</a>
	        					</div>
	        					<button class="color1_bg tran3s" data-link-action="sign-in" type="submit">Login now</button>
	        				</form>
	        			</div> <!-- End of .login_form -->



<div id="forgotpassModal" class="modal fade in" role="dialog" >
	<div class="modal-dialog">
		<div class="modal-content">     
        	<div class="modal-body">
	        	<button type="button" class="close" data-dismiss="modal">×</button>
	        	<h4 class="modal-title color1">Forgot Password</h4>
	        	<div id="msgForgot_modal"></div>
	        	<hr>
	        	<form class="sign-in-form" id="frm_forgotpass" action="javascript:;">                
	        		<p class="text-center text-muted">Please submit your registered email address or mobile no. A message will be sent to registered email address or mobile no. generating to new password.</p>
	        		<div class="form-group">
	        			<label for="email" class="sr-only">Email address</label>
	        			<input type="text" name="email" id="email" class="form-control" placeholder="Email address OR Mobile No.">
	        		</div>
	        		<button class="color1_bg tran3s" style="background-color: #7fb401;" type="submit">Send</button>
        		</form>
        	</div>
    	</div>
	</div>
</div>

	        			<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 register_form">
	        				<div class="theme-title">
								<h2>Register Here</h2>
							</div>
							<div class="msgSubmit_Error"></div>
	        				<form id="user_register_form" class="js-customer-form" method="post" autocomplete="off">
	        					<input type="hidden" name="fk_user_id" id="fk_user_id" value="<?php echo isset($user_register['int_glcode']) ? $user_register['int_glcode'] : ''; ?>">
        						<input type="hidden" name="register_type" id="register_type" value="<?php echo isset($user_register['int_glcode']) ? 'E' : 'I'; ?>">
	        					<div class="row">
	        						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	        							<div class="form_group">
			        						<label>Username</label>
			        						<div class="input_group">
			        							<input class="form-control" name="var_name" type="text" value="<?php echo isset($user_register['var_name']) ? $user_register['var_name'] : ''; ?>" required="">
			        							<i class="fa fa-user" aria-hidden="true"></i>
			        						</div> <!-- End of .input_group -->
			        					</div> <!-- End of .form_group -->

			        					<div class="form_group">
			        						<label>Password</label>
			        						<div class="input_group">
			        							<input class="form-control js-child-focus js-visible-password" id="var_password" name="password" type="password" value="" required="">
			        							<i class="fa fa-lock" aria-hidden="true"></i>
			        						</div> <!-- End of .input_group -->
			        					</div> <!-- End of .form_group -->

			        					<div class="form_group">
			        						<label>Mobile Number</label>
			        						<div class="input_group">
			        							<input class="form-control" id="phone" name="phone" type="text" value=""  maxlength="10" minlength="10" required="" onkeypress="return isNumberKey(event);">
			        							<i class="fa fa-phone" aria-hidden="true"></i>
			        						</div> <!-- End of .input_group -->
			        					</div> <!-- End of .form_group -->
	        						</div>

	        						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	        							<div class="form_group">
			        						<label>Email Address</label>
			        						<div class="input_group">
			        							<input class="form-control" name="email" type="email" value="<?php echo isset($user_register['var_email']) ? $user_register['var_email'] : ''; ?>" required="">
			        							<i class="fa fa-envelope-o" aria-hidden="true"></i>
			        						</div> <!-- End of .input_group -->
			        					</div> <!-- End of .form_group -->

			        					<div class="form_group">
			        						<label>Confirm Password</label>
			        						<div class="input_group">
			        							<input class="form-control js-child-focus js-visible-password" id="confirm_password" type="password" value="" required="">
			        							<i class="fa fa-unlock-alt" aria-hidden="true"></i>
			        						</div> <!-- End of .input_group -->
			        					</div> <!-- End of .form_group -->

			        					<div class="form_group">
			        						<label>Address</label>
			        						<div class="input_group">
			        							<input class="form-control" type="text">
			        							<i class="fa fa-location-arrow" aria-hidden="true"></i>
			        						</div> <!-- End of .input_group -->
			        					</div> <!-- End of .form_group -->
	        						</div>
	        					</div> <!-- End of .row -->

	        					<div class="clear_fix">
	        						<div class="single_checkbox float_left">
										<input type="checkbox" id="terms">
										<label for="terms">I agree the term’s & conditions</label>
									</div> <!-- End .single_checkbox -->
	        					</div>
	        					<button class="color1_bg tran3s form-control-submit" type="submit">Create Account</button>
	        				</form>
	        			</div> <!-- End of .register_form -->
	        		</div> <!-- End of .row -->
	        	</div> <!-- End of .container -->
	        </div> <!-- End of .account_page -->

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
  $("form#user_login_form").submit(function() {
  //  $('#client_infobtn').attr('disabled', true);
  	 
     $(".loading").show();

        var formData = new FormData($(this)[0]);

        if (formData == '') {
            formError_career();
            submitMSG_client(false, "Please fill all details");
            //   $('#client_infobtn').attr('disabled', false);
        } else {
            $.ajax({
                url: site_path + "login/user_signin",
                type: 'POST',
                data: formData,
                async: false,
                success: function(response) {
                	
                	var res_arr = response.split("#");
        					var res_msg = res_arr[0];
        					var res_user = res_arr[1];

                    $(".loading").hide();
                    if (response == 'failed') {
                        var msg = 'Invalid Mobile no. OR Password !';
                        var msgClasses = "h3 text-center tada animated text-danger";
                        $("#msgSubmit_Error").removeClass().addClass(msgClasses).text(msg);
                        //window.location.reload();
                        
                    }else if (response == 'Y') {
                        var msg = 'Your Login Successfully !';
                        var msgClasses = "h3 text-center tada animated text-success";
                        $("#msgSubmit_Error").removeClass().addClass(msgClasses).text(msg);
                         window.location.href = site_path+'cart/checkout';
                        
                    } else {
                        var msg = 'Your Login Successfully !';
                        var msgClasses = "h3 text-center tada animated text-success";
                        $("#msgSubmit_Error").removeClass().addClass(msgClasses).text(msg);
                        
                        window.location.href = site_path;
                    }
                },

                cache: false,
                contentType: false,
                processData: false

            });
            return false;
        }
    });

 $("form#user_register_form").submit(function() {
  // $('#client_infobtn').attr('disabled', true);
    // alert("hello");
    var password = $("#var_password").val();
    var confirmPassword = $("#confirm_password").val();

    if (password != confirmPassword) {
         //$("#divCheckPasswordMatch").css("display", "block");
         var msg = 'Password and confirm password does not match !';
         var msgClasses = "h3 text-center tada animated text-danger";
         $(".msgSubmit_Error").addClass(msgClasses).text(msg);
         return false;
   } else {
      //$("#divCheckPasswordMatch").css("display", "none");

        var formData = new FormData($(this)[0]);

        if (formData == '') {
            formError_career();
            submitMSG_client(false, "Please fill all details");
            //   $('#client_infobtn').attr('disabled', false);
        } else {
            $.ajax({
                url: site_path + "login/user_signup",
                type: 'POST',
                data: formData,
                async: false,
                success: function(response) {

                    //alert(response)
                    if (response == 'email') {
                        var msg1 = 'This Email ID already exists !';
                        var msgClassese = "h3 text-center tada animated text-danger";
                        $(".msgSubmit_Error").addClass(msgClassese).text(msg1);
                        //window.location.reload();
                        
                    } else if(response == 'mobile'){

                        var msg2 = 'This Mobile No. already exists !';
                        var msgClassesm = "h3 text-center tada animated text-danger";
                        $(".msgSubmit_Error").addClass(msgClassesm).text(msg2);

                    

                  
                    } else {
                        // window.location.reload();
                        var msg = 'Your Registration Successfully !';
                        var msgClasses = "h3 text-center tada animated text-success";
                        $(".msgSubmit_Error").removeClass().addClass(msgClasses).text(msg);
                        $('#fk_user_get_id').val(response);
                        $("#user_register_form")[0].reset();
                        //$("#forgetFrm")[0].reset();
                         // $("#otpModal").modal('show');
                        //$('#member_infofrm')[0].reset();
                        // $('#client_infobtn').attr('disabled', false);
                    }
                },

                cache: false,
                contentType: false,
                processData: false

            });
            return false;
        }
   }
});

// function resend_otp()
// {
//   var mobile_no = $('#phone').val();
//   var fk_user = $('#fk_user').val();
//   $.ajax({
//       url: site_path + "login/resend_otp",
//       dataType: 'json',
//       type: 'GET',
//       data: { fk_user: fk_user,
//         mobile_no: mobile_no },
//       async: false,
//       success: function(response) {

//         var msg = 'OTP Send Successfully !';
//         var msgClasses = "h3 text-center tada animated text-success";
//         $("#msgSubmit_modal").removeClass().addClass(msgClasses).text(msg);
//           //window.location.reload();
                
//         },
//     });
// }


// $("form#user_otp_form").submit(function() {

//     var var_otp = $('#var_otp').val();
//    // var fk_user = $('#fk_user').val();

//     if (var_otp == '') {
//       var msg = 'Please enter received OTP !';
//       var msgClasses = "h3 text-center tada animated text-danger";
//       $("#msgSubmit_modal").removeClass().addClass(msgClasses).text(msg);
//     } else {
//         var formData = new FormData($(this)[0]);

//         $.ajax({
//             url: site_path + "login/user_verify_otp",
//             type: 'POST',
//             data: formData,
//             async: false,
//             success: function(response) {
//               //alert(response)
//                 if (response == '') {

//                     var msg = 'OTP Not Matched !';
//                     var msgClasses = "h3 text-center tada animated text-danger";
//                     $("#msgSubmit_modal").removeClass().addClass(msgClasses).text(msg);
//                     //window.location.reload();
//                     return false;
//                 } else {

//                     window.location.href = site_path;
//                 }
//             },

//             cache: false,
//             contentType: false,
//             processData: false

//         });
//     }
// });

$('#frm_forgotpass').submit(function() {

	var formData = new FormData($(this)[0]);

    $.ajax({
    url: site_path + "login/forgotPassword",
    type: 'POST',
    data: formData,
    async: false,
    success: function(response) {
    	     //alert(response)
            if(response == "failed_data"){
               	var msg = 'Please enter your registerd email address !';
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

		        window.location.href = site_path+'signin';
           }
       },
       		cache: false,
            contentType: false,
            processData: false
      
    });
  });
</script>
<!-- <script type="text/javascript">
ProgressCountdown(10, 'pageBeginCountdown', 'pageBeginCountdownText').then(value => alert(`Page has started: ${value}.`));

function ProgressCountdown(timeleft, bar, text) {
  return new Promise((resolve, reject) => {
    var countdownTimer = setInterval(() => {
      timeleft--;

      document.getElementById(bar).value = timeleft;
      document.getElementById(text).textContent = timeleft;

      if (timeleft <= 0) {
        clearInterval(countdownTimer);
        resolve(true);
      }
    }, 1000);
  });
}
</script> -->
	        