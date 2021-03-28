<section class="breadcrumb-area" style="background-image:url(<?php echo base_url(); ?>public/front_assets/images/background/25Testimonial_banner.jpg);">
			    <!-- <div class="container">
			        <div class="row">
			            <div class="col-md-12">
			                <div class="breadcrumbs text-center">
			                    <h1>Blog</h1>
			                    <h4>Welcome to certified burly field</h4>
			                </div>
			            </div>
			        </div>
			    </div>
				<div class="breadcrumb-bottom-area">
				    <div class="container">
				        <div class="row">
				            <div class="col-lg-8 col-md-5 col-sm-5">
				                <ul>
				                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
				                    <li><a href=""><i class="fa fa-angle-right"></i></a></li>
				                    <li>News massonary</li> 
				                </ul>
				            </div>
				            <div class="col-lg-4 col-md-7 col-sm-7">
				                <p>We provide <span>100% organic</span> products</p>
				            </div>
				        </div>
				    </div>
				</div> -->  
			</section>
	<!--23/03/2021	<section class="news single_news_page massonary_mode">
				<div class="container">
					<div id="isotop_wrapper">
					    <?php foreach($testimonial as $test) { ?>
						<div class="col-md-4 col-sm-6 col-xs-12 isotop_item">
							<div class="blogList_single_post clear_fix wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
	        				
									<img src="<?php echo base_url().'uploads/testimonial/'.$test['var_image'] ?>" alt="" class="img-responsive" style="padding:20px; height: 225px;">
									
								<div class="post">
									<div class="text">
										
										<ul>
										 <div class="author"><?php echo $test['var_name']; ?></div>
											<li><a href="" class="tran3s"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $test['var_position']; ?>&ensp;<i class="fa fa-tag" aria-hidden="true"></i> <?php echo $test['var_city']; ?></a></li><br>
											<li><a href="" class="tran3s"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php   $date=date_create($test['dt_createddate']);
													echo date_format($date,"d|m|Y");
											 ?></a></li>
										</ul>
										<p><?php echo $test['txt_description']; ?></p>		
									</div>
									
								</div> 
	        				</div>
							
						</div>
						<?php } ?>
					</div>
				</div>
			</section>    -->

 <section class="testimonials-section">
		    <div class="container">
		            <div class="testimonials">
		                <?php foreach($testimonial as $test) { ?>
			           
							<div class="col-md-4 col-sm-6 col-xs-12 mix mix_all default-item" style="display: inline-block;">
								<div class="slide-item">
										<div class="inner-box">  
		                        <div class="content">
		                        	<div class="text-bg">
			                            <div class="quote-icon"><span class="fa fa-quote-left"></span></div>
			                        	<div class="text"><?php echo $test['txt_description']; ?></div>                 		
		                        	</div>
		                            <div class="info clearfix">
		                            	<div class="author-thumb"><img src="<?php echo base_url().'uploads/testimonial/'.$test['var_image'] ?>" alt=""></div>
		                                <div class="author"><?php echo $test['var_name']; ?></div>
		                                <div class="author-title"><?php echo $test['var_position']; ?></div>
										<div class="author-city"><?php echo $test['var_city']; ?></div>
		                            </div>
		                        </div>
		                    </div> 
								</div> 
							</div>
						<?php } ?>
					</div>
				</div>
		   
		    </section>	
			
<!-- Right click disable on image-->
<script>			
$('img').bind('contextmenu', function(e) {
    return false;
}); 
</script>