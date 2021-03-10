
<div class="ht__bradcaump__area bg-image--6">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="bradcaump__inner text-center">
					<h2 class="bradcaump-title">Change Password</h2>
					<nav class="bradcaump-content">
						<a class="breadcrumb_item" href="<?php echo base_url();?>">Home</a>
						<span class="brd-separetor">/</span>
						<span class="breadcrumb_item active">Change Password</span>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Bradcaump area -->
<!-- Start My Account Area -->
<section class="my_account_area pt--80 pb--55 bg--white">
	<div class="container">
		<div class="row">
			<div class="col-lg-4"></div>
			<div class="col-lg-4 col-12">
				<div class="my__account__wrapper">

					<div id="msgChange_PasswordSubmit"></div>
					<form action="" method="POST" id="change_passwordfrm">

						<div class="account__form">
							<h4 class="account__title titleformallsame">Change Password</h4>
							<div class="input__box">
								<label>Email address <span>*</span></label>
								<input type="email" name="var_cemail" placeholder="Please enter Email address" id="var_cemail" required="">
							</div>
							<div class="input__box">
								<label class="passwordlabel">Password<span>*</span></label>
								
								<input type="password" name="var_cpassword" placeholder="Please enter Password" id="var_cpassword" required="">
							</div>
                                                        <div class="input__box">
								<label class="passwordlabel">Confirm Password<span>*</span></label>
								
								<input type="password" name="var_confirm_cpassword" placeholder="Please enter Confirm Password" id="var_confirm_cpassword" required="">
							</div>
<!--							<div>
								<div class="check_box_div">
									<input id="option_Customers" type="radio" name="role" value="Customers" required="" checked="">
									<label for="option_Customers">Subscriber</label>
									&nbsp;&nbsp;
									<input id="option_Members" type="radio" name="role" value="Members" required="">
									<label for="option_Members">Members</label>
								</div>
							</div>-->
							<div class="form__btn">
								<button type="submit" name="submit" class="checkout-button-login">Submit</button>
							</div>
							<div class="form__btn text-center registerlable">
								<label class="labelbyiso"><p class="background"><span>New by ISO ?</span></p></label>
								<a href="<?php echo base_url();?>register" class="checkout-button-login-a">REGISTER</a>
							</div>
							<!--<a class="forget_pass" href="#">Lost your password?</a>-->
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
	
</section>
<script type="text/javascript">
	var siteurl = '<?= base_url(); ?>';

	$('#change_passwordfrm').submit(function(e){

		e.preventDefault();

		$.ajax({

			url:siteurl+'fronthome/changePassword',
			type:"post",
			data:$(this).serialize(),
			success:function(result){

				if(result == '1'){

					submitMSG_forgot(true, "Change Password successfully.");
					$("#change_passwordfrm")[0].reset();
                                        setTimeout(function(){
						window.location.href = siteurl+'login';
					}, 3000);
					
				} else {
					submitMSG_forgot(false, result);
				}
			},
			error:function(error){
				alert(error);
			}

		});
	})


function submitMSG_forgot(valid, msg) {

    if (valid) {

        var msgClasses = "h5 text-center tada animated text-success";
    } else {

        var msgClasses = "h5 text-center text-danger";
    }

    $("#msgChange_PasswordSubmit").removeClass().addClass(msgClasses).text(msg);
}
</script>