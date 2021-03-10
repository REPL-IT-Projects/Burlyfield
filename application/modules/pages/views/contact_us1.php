<div class="innovatoryBreadcrumb">
   <div class="container">
      <nav data-depth="2" class="breadcrumb hidden-sm-down">
         <ol itemscope="" itemtype="">
            <li itemprop="itemListElement" itemscope="" >
               <a itemprop="item" href="<?php echo base_url();?>">
                  <span itemprop="name">Home</span>
               </a>
               <meta itemprop="position" content="1">
            </li>
            <li itemprop="itemListElement">
               <a itemprop="item" href="javascript:;">
                  <span itemprop="name">Contact Us</span>
               </a>
               <meta itemprop="position" content="2">
            </li>
         </ol>
      </nav>
   </div>
</div>

<section>
   <div class="get-in-touch contactPage">
      <div class="container">
         <h2 class="title">Get in touch</h2>
         <div class="row">
            <div class="col-lg-5 col-md-5">
               <div>
                  <h6><i class="mdi mdi-home-map-marker"></i> Address :</h6>
                  <p>Bharat seva sangh, Lane no-3, S.B Patil Marg, Santacruz-west, Mumbai, Maharashtra-400054.</p>
                  <h6><i class="mdi mdi-email"></i> Email :</h6>
                  <p>support@vruits.in</p>
                  <h6><i class="mdi mdi-link"></i> Website :</h6>
                  <p>www.vruits.in</p>

                  <div class="footer-social"><span>Follow : </span>
                     <a href="#"><i class="fa fa-facebook contact-icon-social"></i></a>
                     <a href="#"><i class="fa fa-twitter contact-icon-social"></i></a>
                     <a href="#"><i class="fa fa-instagram contact-icon-social"></i></a>
                     <a href="#"><i class="fa fa-google contact-icon-social"></i></a>
                  </div>
               </div>
            </div>
            <div class="col-lg-7 col-md-7">
               <div id="msgSubmit_contact"></div>
               <form class="contact-form row" id="contactfrm" method="post">
                  <div class="form-field col-lg-6">
                     <input id="var_name" name="var_name" class="input-text js-input" type="text" placeholder="Name" required>
                  </div>
                  <div class="form-field col-lg-6 ">
                     <input id="var_email_contact" name="var_email_contact" class="input-text js-input" type="email" placeholder="Email" required>
                  </div>
                  <div class="form-field col-lg-6 ">
                     <input id="var_subject" name="var_subject" class="input-text js-input" type="text" placeholder="Subject" required>
                  </div>
                  <div class="form-field col-lg-6 ">
                     <input id="var_phone" name="var_phone" class="input-text js-input" type="text" placeholder="Phone Number" required onkeypress="return isNumberKey(event);" maxlength="10" minlength="10">
                  </div>
                  <div class="form-field col-lg-12">
                     <input id="var_message" name="var_message" class="input-text js-input" type="text" placeholder="Message" required>
                  </div>
                  <div class="form-field col-lg-12">
                    <?php echo $widget;?>
                    <?php echo $script;?>
                  </div>
                  <div class="form-field col-lg-12">
                     <input class="btn btn-primary" type="submit" value="Submit">
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>
<script src="<?php echo base_url(); ?>public/front_assets/js/jquery.validate.js"></script>
<script type="text/javascript">
   var sitepath = '<?php echo base_url(); ?>';
   $("#contactfrm").validator().on("submit", function (event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        //formError();
        submitContactMSG(false, "Please fill all details");
    } else {
        // everything looks good!
        event.preventDefault();
        submitContactForm();
    }
});

function submitContactForm() {
    // Initiate Variables With Form Content
    var name = $("#var_name").val();
    var var_email_contact = $("#var_email_contact").val();
    var phone = $("#var_phone").val();
    var subject = $("#var_subject").val();
    var message = $("#var_message").val();

    $.ajax({
        type: "POST",
        url: sitepath + "pages/contact_us", 
        data: "name=" + name +"&var_email_contact=" + var_email_contact +"&phone=" + phone +"&subject=" + subject +"&message=" + message,
        success: function (response) {
            if (response == 'captcha_verification') {
              var msg3 = 'Robot verification failed, please try again. !';
              var msgClassesc = "h3 text-center tada animated text-danger";
              $("#msgSubmit_contact").addClass(msgClassesc).text(msg3);
            } else if (response == 'empty_captcha') {
              var msg4 = 'Please check on the reCAPTCHA box.';
              var msgClassesec = "h3 text-center tada animated text-danger";
              $("#msgSubmit_contact").addClass(msgClassesec).text(msg4);
            } else {
                //formError_regsiter();
                ContactformSuccess();
                submitContactMSG(false, response);

            }
        }
    });
}

function ContactformSuccess() {
    $("#contactfrm")[0].reset();
    submitContactMSG(true, "Contact Details successfully Sent!");
    //window.location.href = sitepath;
}

function submitContactMSG(valid, msg) {
    if (valid) {
        var msgClasses = "h3 text-center tada animated text-success";
    } else {
        var msgClasses = "h3 text-center text-danger";
    }
    $("#msgSubmit_contact").removeClass().addClass(msgClasses).text(msg);

    setTimeout(function(){$('#msgSubmit_contact').fadeOut();}, 10000);
}
</script>