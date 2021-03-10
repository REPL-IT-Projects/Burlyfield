

			<section class="news single_news_page with_sidebar news_single">
				<div class="container">
					<div class="row">
						<div class="col-md-9 col-sm-8 col-xs-12">
							<div class="single_left_bar">
								<?php foreach($news as $blg) { ?>
								<div class="blogList_single_post clear_fix wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
		        					<div class="img_holder">
										<img src="<?php echo base_url().'uploads/news/'.$blg['var_image'] ?>" alt="News" class="img-responsive">
										<div class="opacity tran3s">
											<div class="icon">
												<span><a href="" class="border_round">+</a></span>
											</div> <!-- End of .icon -->
										</div> <!-- End of .opacity -->
									</div> <!-- End of .img_holder -->
									<div class="post">
											
										<div class="text">
											<h4><a href="<?php echo base_url().'pages/news_details/'.base64_encode($blg['int_glcode']);?>"><?php echo $blg['var_name']; ?></a></h4>
											<ul>
												<li><a href="#" class="tran3s"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $blg['var_author']; ?></a></li>
												<li><a href="#" class="tran3s"><i class="fa fa-tag" aria-hidden="true"></i> Healthy</a></li>
												<li><a href="#" class="tran3s"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php   $date=date_create($blg['dt_createddate']);
													echo date_format($date,"d|m|Y");
											 		?></a></li>
												<!-- <li><a href="blog-details.html" class="tran3s"><i class="fa fa-comments" aria-hidden="true"></i> 26</a></li>
												<li><a href="blog-details.html" class="tran3s"><i class="fa fa-heart" aria-hidden="true"></i> 26</a></li> -->
											</ul>
											<p><?php echo $blg['txt_description']; ?></p>
											
										</div>
										
									</div> <!-- End of .post -->
		        				</div>
								<?php } ?>
							</div>
						</div>
								
						
						
					</div>
				</div>
			</section>