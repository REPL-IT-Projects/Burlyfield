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
					<h2 class="bradcaump-title">Login</h2>
					<nav class="bradcaump-content">
						<a class="breadcrumb_item" href="<?php echo base_url();?>">Home</a>
						<span class="brd-separetor">/</span>
						<span class="breadcrumb_item active">Login</span>
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

					<div id="msgLoginSubmit"></div>
					<form action="" method="POST" id="loginfrm">

						<div class="account__form">
							<h4 class="account__title titleformallsame">Sign in</h4>
							<div class="input__box">
								<label>Email address <span>*</span></label>
								<input type="email" name="var_email" placeholder="Please enter Email address" id="var_email" required="">
							</div>
							<div class="input__box">
								<label class="passwordlabel">Password<span>*</span></label>
								<label class="label-for-checkbox forgetpasslabel">
									<a href="#" data-toggle="modal" data-target="#myModal123">Forget your Password?</a>
								</label>
								<input type="password" name="var_password" placeholder="Please enter Password" id="var_password" required="">
							</div>
							<div>
								<div class="check_box_div">
									<input id="option_Customers" type="radio" name="role" value="Customers" required="" >
									<label for="option_Customers">Subscriber</label>
									&nbsp;&nbsp;
									<input id="option_Members" type="radio" name="role" value="Members" required="" checked="">
									<label for="option_Members">Members</label>
								</div>
							</div>
							<div class="form__btn">
								<button type="submit" name="submit" class="checkout-button-login">Sign in</button>
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
	<div class="modal fade" id="myModal123">
		<div class="modal-dialog">
			<div class="modal-content">
		        <!-- <div class="modal-header">
		          <h4 class="modal-title">Modal Heading</h4>
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div> -->
		      <div class="modal-body">
		      	<form action="<?= base_url(); ?>fronthome/forgot_password" method="POST" id="forgotfrm" novalidate="true">
		      		<div id="msgSubmit_forgot"></div>
		      		<div class="account__form">
		      			<div class="input__box">
		      				<label>Email address <span>*</span></label>
		      				<input type="email" name="var_email" placeholder="Please enter Email address" id="var_email" required="">
		      			</div>
		      			<div>
		      				<div class="check_box_div">
		      					<input id="option_Customers1" type="radio" name="role" value="users" required="" checked="">
		      					<label for="option_Customers1">Subscriber</label>&nbsp;&nbsp;
		      					<input id="option_Members1" type="radio" name="role" value="members" required="">
		      					<label for="option_Members1">Members</label>
		      				</div>
		      			</div>
		      			<div class="form__btn">
		      				<button type="submit" name="submit" class="disabled" style="pointer-events: all; cursor: pointer;">Send</button>
		      				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		      			</div>
		      		</div>
		      	</form>
		      </div>
		  </div>
		</div>
	</div>
</section>
<script type="text/javascript">
	var siteurl = '<?= base_url(); ?>';

	$('#forgotfrm').submit(function(e){

		e.preventDefault();

		$.ajax({

			url:$(this).attr('action'),
			type:"post",
			data:$(this).serialize(),
			success:function(result){

				if(result == true){

					submitMSG_forgot(true, "E-mail sent successfully.");
					$("#forgotfrm")[0].reset();
					setTimeout(function(){
						$('#msgSubmit_forgot').hide();
					    $('#myModal123').modal('hide')
					}, 2000);
					
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

    $("#msgSubmit_forgot").removeClass().addClass(msgClasses).text(msg);
}
</script>