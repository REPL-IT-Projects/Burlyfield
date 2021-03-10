<?php 
//////////////////////////////////// check user login or not ///////////////////////////////////
if (isset($_SESSION['login_user']) && $_SESSION['login_user'] == 'user'){
    redirect(base_url());
}
?> 
<div class="innovatoryBreadcrumb">
<div class="container">
<nav data-depth="2" class="breadcrumb hidden-sm-down">
  <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
        <li itemprop="itemListElement" itemscope="" >
          <a itemprop="item" href="<?php echo base_url(); ?>">
            <span itemprop="name">Home</span>
          </a>
          <meta itemprop="position" content="1">
        </li>
      
        <li itemprop="itemListElement">
          <a itemprop="item" href="javascript:;">
            <span itemprop="name">Login</span>
          </a>
          <meta itemprop="position" content="2">
        </li>
      </ol>
</nav>
</div>
</div>
<section id="wrapper">
	<aside id="notifications">
		<div class="container">
		</div>
	</aside>

	<div class="container">
   <div class="row">
      <div id="content-wrapper" class="left-column login-page-width">
         <div id="main">
            <header class="sec-heading mb-30">
                <h3>
                  Log in to your account
                </h3>
            </header>
            <div id="msgSubmit_Error"></div>
            <section id="content" class="page-content card card-block">
	<section class="login-form">
		<form id="user_login_form" action="javascript:;" method="post">
			<section>
				<input type="hidden" name="back" value="my-account">
				<div class="form-group row ">
					<label class="col-md-2 form-control-label required">Mobile Number<span class="mandatory">*</span></label>
					<div class="col-md-7">
						<input class="form-control" id="var_mobile_no" name="var_mobile_no" type="text" value="" required="" onkeypress="return isNumberKey(event);" maxlength="10" minlength="10">
					</div>
					<div class="col-md-3 form-control-comment">
					</div>
				</div>
				
				<div class="form-group row ">
					<label class="col-md-2 form-control-label required">Password<span class="mandatory">*</span></label>
					<div class="col-md-7">
						<div class="input-group js-parent-focus">
							<input class="form-control js-child-focus js-visible-password" name="password" id="password" type="password" value="" required="">
							<span class="input-group-btn">
								<button class="btn" type="button" data-action="show-password" data-text-show="Show" data-text-hide="Hide" onclick="toggle_password()">Show</button>
							</span>
						</div>
					</div>
					<div class="col-md-3 form-control-comment">
					</div>
				</div>
				<div class="forgot-password">
					<a href="javascript:;" data-toggle="modal" data-target="#forgotpassModal">
						Forgot your password?
					</a>
				</div>
			</section>
			<footer class="form-footer text-xs-center clearfix">
				<input type="hidden" name="submitLogin" value="1">
				<button class="btn btn-primary" data-link-action="sign-in" type="submit">
					Sign in
				</button>
			</footer>
		</form>
		<div class="row">
      <div class="col-md-12">
   <div class="or-seperator"><i>or</i></div>
</div>
	        <div class="col-md-6">
	          <a class="w-100 sign-up-facebook" href="<?php echo $headerMenu; ?>"> 
	              <i class="fa fa-facebook"></i> <span class="padd-left-20">Sign Up With Facebook</span>
	           </a>
	        </div>
	        <div class="col-md-6">
	          <?php $login_url = 'https://accounts.google.com/o/oauth2/v2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL_REGISTER) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online'; ?>
	          <a class="sign-up-google w-100" href="<?php echo $login_url; ?>"> 
	              <i class="fa fa-google"></i> <span class="padd-left-20">Sign Up With Google</span>
	           </a>
	        </div>
	     </div>
	</section>
	<hr>
	<div class="no-account">
		<a href="<?php echo base_url(); ?>signup" data-link-action="display-register-form">
			No account? Signup Here
		</a>
	</div>
</section>
					<footer class="page-footer">
						<!-- Footer content -->
					</footer>
				</div>
			</div>
		</div>
	</div>
	<div class="displayPosition displayPosition6">
		<!-- Static Block module -->
		<!-- /Static block module -->
	</div>
</section>
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
        <div class="row begin-countdown">
          <div class="col-md-12 text-center">
            <progress value="10" max="10" id="pageBeginCountdown"></progress>
            <p> Begining in <span id="pageBeginCountdownText">10 </span> seconds</p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div id="forgotpassModal" class="modal fade in" role="dialog" >
	<div class="modal-dialog">
		<div class="modal-content">     
        	<div class="modal-body">
	        	<button type="button" class="close" data-dismiss="modal">×</button>
	        	<h4 class="modal-title">Forgot Password</h4><br><br>
	        	<div id="msgForgot_modal"></div>
	        	<br>
	        	<form class="sign-in-form" id="frm_forgotpass" action="javascript:;">                
	        		<p class="text-center text-muted">Please submit your registered email address or mobile no. A message will be sent to registered email address or mobile no. generating to new password.</p>
	        		<div class="form-group">
	        			<label for="var_email" class="sr-only">Email address</label>
	        			<input type="text" name="var_email" id="var_email" class="form-control" placeholder="Email address OR Mobile No.">
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

function resend_otp()
{
  var mobile_no = $('#phone').val();
  var fk_user = $('#fk_user').val();
  $.ajax({
      url: site_path + "login/resend_otp",
      dataType: 'json',
      type: 'GET',
      data: { fk_user: fk_user,
        mobile_no: mobile_no },
      async: false,
      success: function(response) {

        var msg = 'OTP Send Successfully !';
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
            url: site_path + "login/user_verify_otp",
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

                    window.location.href = site_path;
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
    url: site_path + "login/forgotPassword",
    type: 'POST',
    data: formData,
    async: false,
    success: function(response) {
    	     //alert(response)
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

		        window.location.href = site_path+'signin';
           }
       },
       		cache: false,
            contentType: false,
            processData: false
      
    });
  });
</script>
<script type="text/javascript">
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
</script>