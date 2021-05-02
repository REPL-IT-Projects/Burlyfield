
  			<!-- Menu ******************************* -->
			<div class="theme_menu color1_bg" style="position:fixed;width: 100%;top:0;">
				<div class="container">
					<nav class="menuzord pull-left" id="main_menu">
					   <ul class="menuzord-menu" id="nav">
					      <li ><a class="<?php if($this->uri->segment(1)==''){ echo 'current_page';}?>" href="<?php echo base_url(); ?>">Home</a></li>
					      <li><a class="<?php if($this->uri->segment(1)=='aboutus'){ echo 'current_page';}?>" href="<?php echo base_url(); ?>aboutus">About Us</a></li>
					      <li><a class="<?php if($this->uri->segment(1)=='product'){ echo 'current_page';}?>" href="<?php echo base_url(); ?>product">Products</a></li>
					      <li><a class="<?php if($this->uri->segment(1)=='contact'){ echo 'current_page';}?>" href="<?php echo base_url(); ?>contact">Contact us</a></li>
					      <li><a class="<?php if($this->uri->segment(1)=='blog' || $this->uri->segment(1)=='stores' || $this->uri->segment(1)=='ingredient_health' || $this->uri->segment(1)=='testimonial' || $this->uri->segment(1)=='news'){ echo 'current_page';}?>" href="#">More</a>
					      	<ul class="dropdown">
					            <li><a href="<?php echo base_url(); ?>news">Burlyfield News</a></li>
					            <li><a href="<?php echo base_url(); ?>blog"> Recipes</a></li>
								 <li><a href="<?php echo base_url(); ?>ingredient_health">Ingredients for health</a></li>
								 <li><a href="<?php echo base_url(); ?>testimonial">Testimonials</a></li>
					            <li><a href="<?php echo base_url(); ?>stores">Find Us</a></li>
					         </ul>
					      </li>  
					   </ul> <!-- End of .menuzord-menu -->
				   </nav> <!-- End of #main_menu --->

				   <!-- ******* Cart And Search Option ******** -->
				   <div class="nav_side_content pull-right">
				   		<ul class="icon_header">
							<li class="border_round tran3s"><a target="_blank" href="https://www.facebook.com/burlyfield"><i class="fa fa-facebook"></i></a></li>
							<li class="border_round tran3s"><a target="_blank" href="https://www.instagram.com/burlyfieldfoods/"><i class="fa fa-instagram"></i></a></li>
							<li class="border_round tran3s"><a target="_blank" href="https://www.youtube.com/channel/UCatrekUy_q1iI4JFJV0sShA"><i class="fa fa-youtube-play"></i></a></li>
							
						</ul>
				   </div> <!-- End of .nav_side_content -->
				     
			   </div> <!-- End of .conatiner -->
			</div> <!-- End of .theme_menu -->