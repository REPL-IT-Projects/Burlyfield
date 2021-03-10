			<section class="breadcrumb-area" style="background-image:url(<?php echo base_url();?>public/front_assets/images/background/contact-us.jpg);">
			     
			    
			</section>

			<section class="single-contact_us">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="left_contact">
								<h5>Get In Touch</h5>
								<ul class="list catagories">
		                            <li><a href="#"><i class="fa fa-home color1"></i>Plot No. A3, Burlyfield Biotech, Dr Bhapkar Marg, MIDC, New Usmanpura, Aurangabad, Maharashtra, India 431001.</a></li>
		                            <li><a href="#"><i class="fa fa-envelope color1 blin"></i>marketing@burlyfield.com <br></a></li>
		                            <li><a href="#"><i class="fa fa-phone color1 blin"></i>+91 772 206 6378 <br> </a></li>
		                        </ul>

		                        <div class="border-area">
			                        <h6>Woriking Hours</h6>
									<div class="list Business">
			                            <p>Monday to Saturday : 09.00am to 06.00pm<br>Sunday : <span>Closed</span></p>
			                        </div>
		                        	
		                        </div>

		                        
							</div>
						</div>
						<div class="col-md-8 col-sm-6 col-xs-12">
			                <div class="contact_in-box">
				                <div class="theme-title ">
				                    <h2>send us Message</h2>
				                </div>
				                <div id="msgSubmit_contact"></div>
				                <div class="h3 text-center tada animated text-success"><?php echo $this->session->userdata('contct'); $this->session->unset_userdata('contct'); ?></div>
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
				                  
				                  <div class="form-field col-lg-12"><br>
				                     <input class="btn btn-primary" name="submit" type="submit" value="Submit">
				                  </div>
				               </form>
					                
				            </div> 
			            </div>
					</div>
				</div>
			</section>

			<!-- Google map************************ -->
			<section id="google-map-area">
				<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15009.159544337379!2d75.32666!3d19.8699776!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x2eca83d2ef00e32!2sBurlyfield%20Foods!5e0!3m2!1sen!2sin!4v1599564584121!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
				
				<!-- <div class="google-map-home" id="google-map" data-map-lat="40.717873" data-map-lng="-73.563033" data-icon-path="images/logo/map.png" data-map-title="Awesome Place" data-map-zoom="11"></div> -->
	   		</section>

<script src="<?php echo base_url(); ?>public/front_assets/js/jquery.validate.js"></script>
<script type="text/javascript">
   var sitepath = '<?php echo base_url(); ?>';
   $("#contactfrm").validator().on("submit", function (event) {
       //alert();
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
        	
            $("#contactfrm")[0].reset();
            var msg4 = 'Contact Details successfully Sent!';
              var msgClassesec = "h3 text-center tada animated text-success";
              $("#msgSubmit_contact").addClass(msgClassesec).text(msg4);
            
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