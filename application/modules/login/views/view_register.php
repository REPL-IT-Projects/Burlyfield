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
            <span itemprop="name">Register</span>
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
                    Create an account
                 </h3>
              </header>
              <div class="msgSubmit_Error"></div>
              <section id="content" class="page-content card card-block">

        <section class="register-form">
           <p>Already have an account? <a href="<?php echo base_url(); ?>signin">Log in instead!</a></p>
      <form id="user_register_form" class="js-customer-form" method="post">
        <input type="hidden" name="fk_user_id" id="fk_user_id" value="<?php echo isset($user_register['int_glcode']) ? $user_register['int_glcode'] : ''; ?>">
        <input type="hidden" name="register_type" id="register_type" value="<?php echo isset($user_register['int_glcode']) ? 'E' : 'I'; ?>">
         <section>
            <input type="hidden" name="back" value="my-account">
            <div class="form-group row ">
               <label class="col-md-2 form-control-label required">Name<span class="mandatory">*</span></label>
               <div class="col-md-7">
                
                  <input class="form-control" name="var_name" type="text" value="<?php echo isset($user_register['var_name']) ? $user_register['var_name'] : ''; ?>" required="">
               </div>
               <div class="col-md-3 form-control-comment">
               </div>
            </div>
            <div class="form-group row ">
               <label class="col-md-2 form-control-label required">Email<span class="mandatory">*</span></label>
               <div class="col-md-7">
                  <input class="form-control" name="email" type="email" value="<?php echo isset($user_register['var_email']) ? $user_register['var_email'] : ''; ?>" required="">
               </div>
               <div class="col-md-3 form-control-comment">
               </div>
            </div>
            <div class="form-group row ">
               <label class="col-md-2 form-control-label required">Mobile Number<span class="mandatory">*</span></label>
               <div class="col-md-7">
                  <input class="form-control" id="phone" name="phone" type="text" value=""  maxlength="10" minlength="10" required="" onkeypress="return isNumberKey(event);">
               </div>
               <div class="col-md-3 form-control-comment">
               </div>
            </div>
            <div class="form-group row ">
               <label class="col-md-2 form-control-label required">Block No.</label>
               <div class="col-md-7">
                  <input class="form-control" name="var_house_no" type="text" value="">
               </div>
               <div class="col-md-3 form-control-comment">
               </div>
            </div>
            <div class="form-group row ">
               <label class="col-md-2 form-control-label required">App/Street Name<span class="mandatory">*</span></label>
               <div class="col-md-7">
                  <input class="form-control" name="var_app_name" type="text" value="" required="">
               </div>
               <div class="col-md-3 form-control-comment">
               </div>
            </div>
            <div class="form-group row ">
               <label class="col-md-2 form-control-label required">Landmark<span class="mandatory">*</span></label>
               <div class="col-md-7">
                  <input class="form-control" name="var_landmark" type="text" value="" required="">
               </div>
               <div class="col-md-3 form-control-comment">
               </div>
            </div>
            <div class="form-group row ">
               <label class="col-md-2 form-control-label required">Country<span class="mandatory">*</span></label>
               <div class="col-md-7">
                  <input class="form-control" name="var_country" type="text" value="India" required="">
               </div>
               <div class="col-md-3 form-control-comment">
               </div>
            </div>
            <div class="form-group row ">
               <label class="col-md-2 form-control-label required">State<span class="mandatory">*</span></label>
               <div class="col-md-7">
                  <input class="form-control" name="var_state" type="text" value="" required="">
               </div>
               <div class="col-md-3 form-control-comment">
               </div>
            </div>
            <div class="form-group row ">
               <label class="col-md-2 form-control-label required">City<span class="mandatory">*</span></label>
               <div class="col-md-7">
                  <input class="form-control" name="var_city" type="text" value="" required="">
               </div>
               <div class="col-md-3 form-control-comment">
               </div>
            </div>
            <div class="form-group row ">
               <label class="col-md-2 form-control-label required">Zipcode<span class="mandatory">*</span></label>
               <div class="col-md-7">
                  <input class="form-control" name="var_pincode" type="text" value="" required="">
               </div>
               <div class="col-md-3 form-control-comment">
               </div>
            </div>
            <div class="form-group row ">
               <label class="col-md-2 form-control-label required">Password<span class="mandatory">*</span></label>
               <div class="col-md-7">
                  <div class="input-group js-parent-focus">
                     <input class="form-control js-child-focus js-visible-password" id="var_password" name="password" type="password" value="" required="" >
                     <span class="input-group-btn">
                        <button class="btn" id="hide_show_text" type="button" data-action="show-password" data-text-show="Show" data-text-hide="Hide" onclick="toggle_password()">Show</button>
                     </span>
                  </div>
               </div>
               <div class="col-md-3 form-control-comment">
               </div>
            </div>
            <div class="form-group row ">
               <label class="col-md-2 form-control-label required">Confirm Password<span class="mandatory">*</span></label>
               <div class="col-md-7">
                  <div class="input-group js-parent-focus">
                     <input class="form-control js-child-focus js-visible-password" id="confirm_password" type="password" value="" required="">
                     <span class="input-group-btn">
                        <button class="btn" id="hide_show_text_conf" type="button" data-action="show-password" data-text-show="Show" data-text-hide="Hide" onclick="confirm_password_toggle()">Show</button>
                     </span>
                  </div>
               </div>
               <div class="col-md-3 form-control-comment">
               </div>
            </div>
            <div class="form-group row">
              <?php echo $widget;?>
              <?php echo $script;?>
            </div>
            <div class="registrationFormAlert" id="divCheckPasswordMatch" style="display: none;">
             
         </section>
                     <footer class="form-footer clearfix">
                        <button class="btn btn-primary form-control-submit" type="submit" style="width: 20%;">
                           Save
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
                        <?php $register_url = 'https://accounts.google.com/o/oauth2/v2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL_REGISTER) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online'; ?>
                        <a class="sign-up-google w-100" href="<?php echo $register_url; ?>"> 
                            <i class="fa fa-google"></i> <span class="padd-left-20">Sign Up With Google</span>
                         </a>
                      </div>
                   </div>
               </section>
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

<!-- Button trigger modal -->

<!-- Modal -->
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
          <input type="hidden" name="fk_user_get_id" id="fk_user_get_id" value="">
            <input type="hidden" placeholder="Please enter received OTP" name="fk_user" id="fk_user" value="<?php echo isset($user_register['int_glcode']) ? $user_register['int_glcode'] : ''; ?>">
         <input type="text" name="var_otp" id="var_otp" class="form-control">
         <button type="button" class="btn btn-primary" onclick="resend_otp();">Resend</button>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
var site_path = '<?php echo base_url(); ?>';

function toggle_password() {
   var x = document.getElementById("var_password");
    if (x.type === "password") {
        x.type = "text";
        $('#hide_show_text').text('Hide');
    } else {
        x.type = "password";
        $('#hide_show_text').text('Show');
    }
}

function confirm_password_toggle() {
   var x = document.getElementById("confirm_password");
    if (x.type === "password") {
        x.type = "text";
        $('#hide_show_text_conf').text('Hide');
    } else {
        x.type = "password";
        $('#hide_show_text_conf').text('Show');
    }
}

function submitMSG_client(valid, msg) {
    if (valid) {
        var msgClasses = "h3 text-center tada animated text-success";
    } else {
        var msgClasses = "h3 text-center text-danger";
    }

    $(".msgSubmit_Error").addClass(msgClasses).text(msg);
}

   function formSuccess_client() {
        // $("#member_infofrm")[0].reset();
        submitMSG_client(true, "User Details Submitted Successfully.");
   }

  // $("#basicinfofrm").validator().on("submit", function (event) {
  $("form#user_register_form").submit(function() {
  // $('#client_infobtn').attr('disabled', true);

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

                    } else if(response == 'captcha_verification'){
                        var msg3 = 'Robot verification failed, please try again. !';
                        var msgClassesc = "h3 text-center tada animated text-danger";
                        $(".msgSubmit_Error").addClass(msgClassesc).text(msg3);

                    } else if(response == 'empty_captcha'){
                        var msg4 = 'Please check on the reCAPTCHA box.';
                        var msgClassesec = "h3 text-center tada animated text-danger";
                        $(".msgSubmit_Error").addClass(msgClassesec).text(msg4);
                    } else {
                        formSuccess_client();
                        $('#fk_user_get_id').val(response);
                        //$("#forgetFrm")[0].reset();
                         $("#otpModal").modal('show');
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



function resend_otp()
{
  var mobile_no = $('#phone').val();
  var fk_user = $('#fk_user').val();
  var fk_user_get_id = $('#fk_user_get_id').val();
  $.ajax({
      url: site_path + "login/resend_otp",
      dataType: 'json',
      type: 'POST',
      data: { fk_user: fk_user,
        mobile_no: mobile_no,fk_user_get_id: fk_user_get_id },
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

</script>