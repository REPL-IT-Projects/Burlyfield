<?php $admin = $this->session->userdata('iso_front');
      if (!empty($admin)){ 
          redirect(base_url());
      }
?>
 
<div class="ht__bradcaump__area bg-image--6">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bradcaump__inner text-center">
                        	<h2 class="bradcaump-title">Register</h2>
                            <nav class="bradcaump-content">
                              <a class="breadcrumb_item" href="<?php echo base_url();?>">Home</a>
                              <span class="brd-separetor">/</span>
                              <span class="breadcrumb_item active">Register</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
		<!-- Start My Account Area -->
		<section class="my_account_area pt--80 pb--55 bg--white registeriniso">
			<div class="container">
				<div class="row">
					<div class="col-lg-4"></div>
						<div class="col-lg-4 col-12">
						<div class="my__account__wrapper">
							
                                                        <div id="msgSubmit_register"></div>
                                                        <form action="" method="POST" id="registerfrm">
								<div class="account__form">
                                    <h3 class="account__title titleformallsame">Create an account</h3>
                                                                        <div class="input__box">
										<label>Company Name </label>
                                                                                <input type="text" name="company_name" placeholder="Please enter Company Name" id="company_name" >
									</div>
                                                                        <div class="input__box">
										<label>Full Name <span>*</span></label>
                                                                                <input type="text" name="var_rname" placeholder="Please enter Name" id="var_rname" required="">
									</div>
                                                                        <div class="input__box">
										<label>Phone <span>*</span></label>
                                                                                <input type="text" maxlength="10" minlength="10" name="var_rphone" placeholder="Please enter Phone No" id="var_rphone" onkeypress="return isNumberKey(event)" required="">
									</div>
                                                                        <div class="input__box">
										<label>Fax <span>*</span></label>
                                                                                <input type="text" maxlength="10" minlength="10" name="var_faxno" placeholder="Please enter Fax No" id="var_faxno" onkeypress="return isNumberKey(event)" >
									</div>
                                                                        <div class="input__box">
										<label>VAT </label>
                                                                                <input type="text" name="vat_no" placeholder="Please enter VAT No" id="vat_no" >
									</div>
									<div class="input__box">
										<label>E-mail <span>*</span></label>
                                                                                <input type="email" name="var_remail" placeholder="Please enter Email address" id="var_remail" required="">
									</div>
									<div class="input__box">
										<label>Password<span>*</span></label>
										<input type="password" name="var_rpassword" placeholder="Please enter Password" id="var_rpassword" required="">
									</div>
                                                                        <div class="input__box">
										<label>Confirm Password<span>*</span></label>
										<input type="password" name="var_rcpassword" placeholder="Please enter Password" id="var_rcpassword" required="">
									</div>
                                                                        
                                                                    <div class="input__box">
										<label>Address 1 <span>*</span></label>
                                                                                <input type="text" name="var_address1" placeholder="Please enter Address 1" id="var_address1" required="">
									</div>
                                                                    <div class="input__box">
										<label>Address 2 </label>
                                                                                <input type="text" name="var_address2" placeholder="Please enter Address 2" id="var_address2" >
									</div>
                                                                    <div class="input__box">
										<label>Address 3 </label>
                                                                                <input type="text" name="var_address3" placeholder="Please enter Address 3" id="var_address3" >
									</div>





<div class="input__box">
<div class="zipcodeandcity">
<label>Zip code <span>*</span></label>
<input type="text" name="var_zipcode" placeholder="Zip code" id="var_zipcode" required="">
</div>
<div class="cityandzipcode">
<label>City <span>*</span></label>
<input type="text" name="var_city" placeholder="Please enter City" id="var_city" required="">
</div>
</div>



<!-- <div class="input__box">
<div class="zipcodeandcity">
<label>Zip code <span class="valid-text">*</span></label>
<input type="text" name="vZipCode" id="vZipCode" onkeypress="return isNumberKey(event);" required="">
</div>
<div class="cityandzipcode">
<label>City <span class="valid-text">*</span></label>
<input type="text" name="vCity" id="vCity" required="">
</div>
</div> -->




                                                                    <div class="input__box">
										<label>Country <span>*</span></label>
                                                                                <input type="text" name="var_country" placeholder="Please enter Country" id="var_country" required="">
									</div>
									<div class="form__btn">
                                                                            <button type="submit" name="submit" class="checkout-button-login">Submit</button>
									</div>
                                    <div class="text-center alreadylogin">Your have already an account ? <a href="<?php echo base_url();?>login" title="">Sign-in</a></div>
								</div>

							</form>

						</div>
					</div>
					
				</div>
			</div>
		</section>
                <script>
            function isNumberKey(evt){
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                return true;
            }
        </script>