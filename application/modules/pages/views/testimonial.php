
  <section class="testimonials-section" style="background-image:url(<?php echo base_url(); ?>public/front_assets/images/parallax/1.jpg);">
		        <div class="container">
		            <div class="theme_title">
						 <h2 style="color: #ffffff;  text-align: right;">testimonials</h2>
					</div>
				</div>
	</section>
	
			<section class="news single_news_page massonary_mode">
				<div class="container">
					<div id="isotop_wrapper">
					    <?php foreach($testimonial as $test) { ?>
						<div class="col-md-4 col-sm-6 col-xs-12 isotop_item">
							<div class="blogList_single_post clear_fix wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
	        				
									<img src="<?php echo base_url().'uploads/testimonial/'.$test['var_image'] ?>" alt="" class="img-responsive">
									<div class="opacity tran3s">
										<div class="icon">
											<span><a href="#" class="border_round">+</a></span>
										</div> <!-- End of .icon -->
									</div> <!-- End of .opacity -->
								
								<div class="post">
									<div class="text">
										<!--<h4><a href="<?php echo base_url().'pages/blog_details/'.base64_encode($test['int_glcode']);?>"><?php echo $test['var_name']; ?></a></h4>-->
										<ul>
										 <div class="author"><?php echo $test['var_name']; ?></div>
											<li><a href="" class="tran3s"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $test['var_position']; ?>&ensp;<i class="fa fa-tag" aria-hidden="true"></i> <?php echo $test['var_city']; ?></a></li>
											<li><a href="" class="tran3s"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php   $date=date_create($test['dt_createddate']);
													echo date_format($date,"d|m|Y");
											 ?></a></li>
										</ul>
										<p><?php echo $test['txt_description']; ?></p>		
									</div>
									
								</div> <!-- End of .post -->
	        				</div>
							
						</div>
						<?php } ?>
					</div>
				</div>
			</section>        
