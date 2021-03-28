
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>

<section class="breadcrumb-area" style="background-image:url(<?php echo base_url(); ?>public/front_assets/images/background/23Stores.jpg);">
			       
			</section>

		<!--gallery Section-->
		   <!-- <section class="gallery gallery-grid">
		        <div class="container">

		           
		            <div class="filters text-center">
		                <select OnChange="window.location.href=$(this).val();" data-style="g-select" data-width="100%">
			            	<option value="">Select City</option>
			            	<?php 
			            	$stor = $this->db->get('mst_city')->result_array();
			            	foreach($stor as $str) { ?>
			            		<option value="<?php echo base_url().'pages/citydata/'.base64_encode($str['intglcode']);?>"><?php echo $str['var_city']; ?></option>
			            	<?php } ?>
			            </select>
		            </div>


		            <div class="row filter-list clearfix">
			            
			            
			            <?php foreach($stores as $str) { 
			            	
			            	?>
			            
			            <div id="demo"></div>

		            	<input type="hidden" name="var_lat" id="var_lat" value="<?php echo $str['var_lat']; ?>">
		            	<input type="hidden" name="var_long" id="var_long" value="<?php echo $str['var_long']; ?>">
		            	<input type="hidden" name="int_glcode" id="int_glcode" value="<?php echo $str['int_glcode']; ?>">
			           
			            <div class="col-md-3 col-sm-6 col-xs-12 mix mix_all default-item" style="display: inline-block;">
			                <div class="inner-box">
			                   
			                        <figure class="image-box" ></figure>
			                        
			                        	<div style="background-color:olivedrab;color:white;padding:20px; height: 225px;">
				                        	<div class="inner">
					                        	
					                        	<div class="bottom-content">
					                        		<h4><a href=""><?php echo $str['var_name']; ?></a></h4>
					                        		<div class="price"><?php echo $str['var_address']; ?>
					                        			<br>Mo. : <?php echo $str['var_phone']; ?>
					                        		</div>
					                        		
					                        	</div>
				                        	</div>
				                        
				                    

				                </div>
			                </div>
			            </div>
			            <?php } ?>
			        </div>

		        </div>
			        
		    </section><!-- End of section -->
			
<!--	<section class="gallery gallery-grid">
		<div class="container">
			<div class="shop_single_page">
	        	<div class="container">
	        		<div class="row">
						<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 sidebar_styleTwo">
	        				<div class="wrapper">
	        					

	        					<div class="sidebar_categories">
	        						<div class="theme_inner_title">
										<h4>Location</h4>
									</div>
									<ul>
							<?php 
								$stor = $this->db->get('mst_city')->result_array();
								foreach($stor as $str) { ?>
									<li OnChange="window.location.href=$(this).val();"><a href="<?php echo base_url().'pages/citydata/'.base64_encode($str['intglcode']);?>"><?php echo $str['var_city']; ?></a></li>
			            	<?php } ?>
										
										
									</ul>
	        					</div>
							</div>
						</div>
						<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 product_details">
						<div class="row filter-list clearfix">
						<br><br>
						<div class="theme_inner_title">
			             <h4>Shop Address</h4>
						 </div>
						 <hr>
			            
			            <?php foreach($stores as $str) { 
			            	
			            	?>
			            
			            <div id="demo"></div>

		            	<input type="hidden" name="var_lat" id="var_lat" value="<?php echo $str['var_lat']; ?>">
		            	<input type="hidden" name="var_long" id="var_long" value="<?php echo $str['var_long']; ?>">
		            	<input type="hidden" name="int_glcode" id="int_glcode" value="<?php echo $str['int_glcode']; ?>">
			            
			            <div class="col-md-6 col-sm-6 col-xs-12 mix mix_all default-item" style="display: inline-block;">
			                <div class="inner-box">
			                   
			                        <figure class="image-box" ></figure>
			                       
			                        	<div style="background-color:olivedrab;color:white;padding:10px;">
				                        	<div class="inner">
					                        	
					                        	<div class="bottom-content">
					                        		<h4><a href=""><?php echo $str['var_name']; ?></a></h4>
					                        		<div class="price"><?php echo $str['var_address']; ?>
					                        			<br>Mo. : <?php echo $str['var_phone']; ?>
					                        		</div>
					                        		
					                        	</div>
				                        	</div>
				                        
				                    

				                </div>
			                </div>
			            </div>
			            <?php } ?>
			        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</section>-->
	<section class="testimonials-section">
			<div class="container">
	        	<div class="row">
					<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 sidebar_styleTwo">	        			
	        				<div class="sidebar_categories">
	        					<div class="theme_inner_title">
									<h4>Location</h4>
								</div>
								<ul>
									<?php 
											$stor = $this->db->get('mst_city')->result_array();
											foreach($stor as $str) { ?>
											<li OnChange="window.location.href=$(this).val();"><a href="<?php echo base_url().'pages/citydata/'.base64_encode($str['intglcode']);?>"><?php echo $str['var_city']; ?></a></li>
									<?php } ?>	
								</ul>
	        				</div>						
					</div>
					<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 product_details">
						
							<br><br>
							<div class="theme_inner_title">
								<h4><center>Shop Address</center></h4>
							</div>
							<div class="testimonials">
								<?php foreach($stores as $str) { ?>			           
									<div class="col-md-4 col-sm-6 col-xs-12 mix mix_all default-item" style="display: inline-block;">
										<div class="slide-item">
											<div class="inner-box">  
												<div class="content">
													<div class="text-bg" >
														<div class="quote-icon"><span class="fa fa-quote-left"></span></div>
															<div class="text"><h4><a href=""><?php echo $str['var_name']; ?></a></h4>
																<div class="price"><?php echo $str['var_address']; ?>
																	<br> <?php echo $str['var_phone']; ?>
																</div>
															</div>                 		
													</div>
												</div>	
											</div>
										</div> 
									</div>
								<?php } ?>
							
						</div>
					</div>
				</div>
			</div>
		
	</section>
	        			