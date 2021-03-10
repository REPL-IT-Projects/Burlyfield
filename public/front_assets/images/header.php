<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<!-- For IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- For Resposive Device -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>Burlyfield </title>
		<!-- Favicon -->
		<link rel="" type="image/png"  href="<?php echo base_url(); ?>public/front_assets/images/fav-icon/favicon.png">



		<!-- Custom Css -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/front_assets/fonts/raleway/style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/front_assets/css/style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/front_assets/css/custom.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/front_assets/css/responsive.css">
		<script type="text/javascript" src="<?php echo base_url(); ?>public/front_assets/js/jquery-2.1.4.js"></script>
        <script src="<?php echo base_url(); ?>public/dist/js/validator.min.js"></script>

		<!-- Fixing Internet Explorer ______________________________________-->

		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<script src="vendor/html5shiv.js"></script>
		<![endif]-->
	</head>



	<body>
		<div class="main_page">


			<!-- Header *******************************  ---->
			<header>
				<div class="top_header">
					<div class="container">
						<div class="pull-left header_left">
							<ul>
		        				<li><a href="#">Order On Phone/Whatsapp: <span> +91 772 206 6378</span></a></li>
		        				<li><i class="fa fa-envelope-o s_color" aria-hidden="true"></i><a href="#">marketing@gmail.com</a></li>
		        			</ul>
						</div>

						<div class="pull-right header_right">
							<div class="state" id="value1">
								<ul><?php 

					            	if(isset($_SESSION['fk_user']))

					            { ?>
			        				<li><i class="fa fa-user s_color" aria-hidden="true"></i><a href="<?php echo base_url(); ?>user">My Account</a></li>
			        				<li><i class="fa fa-lock s_color" aria-hidden="true"></i><a href="" data-toggle="modal" data-target="#changepassword">Change Password </a></li>
			        			<?php } ?>
			        			    
			        				<!--class="btn changepassword-button" <li><i class="fa fa-heart s_color" aria-hidden="true"></i><a href="#">Whishlist </a></li>
			        				<li><i class="fa fa-truck s_color" aria-hidden="true"></i><a href="#">Whishlist</a></li> -->
			        			</ul>
			        			<!-- <div id="polyglotLanguageSwitcher">
									<form action="#">
										<select id="polyglot-language-options">
											<option id="en" value="en" selected>English</option>
											<option id="fr" value="fr">French</option>
											<option id="de" value="de">German</option>
											<option id="it" value="it">Italian</option>
											<option id="es" value="es">Spanish</option>
										</select>
									</form>
								</div> -->
							</div>

								
						</div>
					</div> <!-- End of .container -->
				</div> <!-- End of .top_header -->

				<div class="bottom_header">
					<div class="container">
						<div class="row">
							<div class="col-md-4 col-sm-12 col-xs-12">
								<div class="search-box">
									<form action="#" class="clearfix">
										<input type="text" name="search" id="search_all" placeholder="Search...">
										<i class="fa fa-close" id="hide_cancel_btn" onclick="clearFields()" ></i>
										<button type="submit"><i class="fa fa-search"></i></button>
									</form>
								</div>
								<div class="col-lg-12" id="suggesstion-box"></div>
							</div>
							<div class="col-md-4 col-sm-5 col-xs-6 logo-responsive">
								<div class="logo-area">
									<a href="<?php echo base_url(); ?>" class="pull-left logo">
										<img src="<?php echo base_url(); ?>public/front_assets/images/logo.png" alt="LOGO"></a>
								</div>
							</div>
							<div class="col-md-4 col-sm-7 col-xs-6 pdt-14">
								 <?php if(isset($_SESSION['fk_user'])){ ?>
					 
								<div class="login_option float_left">
							   		<div class="login_form">
							   			<div class="user">
							   			    
							   				<i class="icon-photo"></i>
							   			</div>
							   			<div class="login-info">
								   			<div class="welcome">Welcome!</div>
									   		<!-- select menu -->
									            <form action="#" class="select-form">
							                        <div class="g-input f1 mb-30">
							                            <select class="text-capitalize selectpicker" OnChange="window.location.href=$(this).val();" data-style="g-select" data-width="100%">
							                                <option value="0" selected=""><?php echo ucfirst($_SESSION['user_name']); ?></option>
							                                <option value="<?php echo base_url(); ?>orders">My Order</option>
							                                
							                                <option value="<?php echo base_url(); ?>login/user_logout">Sign Out</option>
							                            </select>
							                        </div>
							                    </form>
								   		</div>
							   		 </div> <!--End of .cart_list -->
							    </div>
							<?php } else { ?>

								<div class="login_option float_left">
							   		<div class="login_form">
							   			<div class="user">
							   				<i class="icon-photo"></i>
							   			</div>
							   			<div class="login-info"> 
							   				<!-- <div><a href="">Sign In</a></div> -->
							   				<div class="text-capitalize selectpicker"><a class="nav-link <?php if($this->uri->segment(1) == 'login' || $this->uri->segment(1) == 'signin' || $this->uri->segment(1) == 'signup' || $this->uri->segment(1) == 'register'){echo "active"; } ?>" href="<?php echo base_url(); ?>signin">Sign In</a></div> 
								   			
									   		
								   		</div>
							   		 </div> <!--End of .cart_list --->
							    </div>

							<?php } ?>
							    <div class="cart_option float_left">
							        <div id="cart_body">
							        <?php  //echo "<pre>";print_r($_SESSION["cart_item"]);die();
							        if(isset($_SESSION['fk_user'])){ ?>
							   		<button class="cart tran3s dropdown-toggle" id="cartDropdown"><i class="fa icon-icon-32846" aria-hidden="true"></i>
							   		
							   		<?php 
							   		if(isset($_SESSION["cart_item"])){ ?>
							   		<span class="s_color_bg p_color"><?php echo count($_SESSION["cart_item"]);?></span>
							   		<?php } else { ?>
							   		<span class="s_color_bg p_color">0</span>
							   		<?php } ?>
							   		</button>
							   		
							   		<?php }else{ ?>
                                      <button class="cart tran3s dropdown-toggle" data-toggle="modal" data-target="#wantDonate"><i class="fa icon-icon-32846" aria-hidden="true"></i><span class="s_color_bg p_color">0</span></button>
                                         
                                    <?php } ?>
								   		
							   		<div class="cart_list color2_bg" aria-labelledby="cartDropdown">
							   		    <?php if(isset($_SESSION["cart_item"])){ ?>
							   			<ul>
							   				<?php $grand_total = 0;
                                              foreach($_SESSION["cart_item"] as $row){
                                            ?>
							   				<li>
							   					<div class="cart_item_wrapper clear_fix">
							   						<div class="img_holder float_left"><img style="height: 80px;" src="<?php echo $row['image'];?>" alt="Cart Image" class="img-responsive"></div> <!-- End of .img_holder -->
							   						
							   						<div class="item_deatils float_left">
							   							<h6><?php echo $row['title'];?></h6>
							   							<ul>
															<li><i class="fa fa-star" aria-hidden="true"></i></li>
															<li><i class="fa fa-star" aria-hidden="true"></i></li>
															<li><i class="fa fa-star" aria-hidden="true"></i></li>
															<li><i class="fa fa-star" aria-hidden="true"></i></li>
															<li><i class="fa fa-star" aria-hidden="true"></i></li>
														</ul>
														<span class="font_fix">&#x20b9; <?php echo $row['price'];?> <span>x <?php echo $row['quantity'];?></span>
							   						</div> <!-- End of .item_deatils -->
							   					</div> <!-- End of .cart_item_wrapper -->
							   					<a class="float-right remove-cart" href="javascript:;" onclick="delete_to_cart('<?php echo $row['int_glcode'];?>','<?php echo $row['weigth'];?>')"></a>
							   				</li>
                                            <?php $total = $row['price'] * $row['quantity'];
                                                $grand_total = $total + $grand_total; } ?>
							   				
							   			</ul>
                                        
							   			<div class="cart_total clear_fix">

							   				<span class="total font_fix float_left">Total - &#x20b9; <?php echo $grand_total;?></span>
							   				<a href="<?php echo base_url();?>cart" class="s_color_bg float_right tran3s bg-light">View Cart</a>
							   			</div>
							   			<?php } else { ?>
							   			<div class="cart_total clear_fix">

							   				<span class="total font_fix float_left">Cart Empty</span>
							   				
							   			</div>
							   			<?php } ?>
							   			</div>
							   		</div> <!-- End of .cart_list -->
							   		
							    </div>

							</div>

						</div>

					</div>
				</div> <!-- End of .bottom_header -->
			</header>
