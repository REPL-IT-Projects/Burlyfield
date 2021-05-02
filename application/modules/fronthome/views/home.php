

			<!-- Banner ____________________________________ -->
	        <div id="banner">
			
	        	<div class="rev_slider_wrapper">
					<!-- START REVOLUTION SLIDER 5.0 auto mode -->
						<div id="main_slider" class="rev_slider" data-version="5.0">
							<ul>
								<?php foreach ($banner_img as $row1){ ?>
								<!-- SLIDE1  -->
								<li data-index='rs-377' data-transition='parallaxtoright' data-delay="100ms" data-slotamount='1' data-easein='default' data-easeout='default' data-masterspeed='default' data-thumb='<?php echo base_url().'uploads/banner_img/'.$row1['var_image']; ?>' data-rotate='0' data-saveperformance='off'  data-title='Business Solutions' data-description='' >
									<!-- MAIN IMAGE -->
									<img src="<?php echo base_url().'uploads/banner_img/'.$row1['var_image']; ?>"  alt="image"  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"  class="rev-slidebg" style="max-width: 100%;height: auto;">
									<!-- LAYERS -->

									<!-- LAYER NR. 1 -->
									<div class="tp-caption tp-resizeme" 
										data-x="['center','center','center','center']" data-hoffset="['0','0','35','0']" 
										data-y="['middle','middle','middle','middle']" data-voffset="['-120','-120','-120','-120']"
										data-width="none"
										data-height="none"
										data-transform_idle="o:1;"
										data-transform_in="z:0;rX:0deg;rY:0;rZ:0;sX:1.5;sY:1.5;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeInOut;" 
										data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
										data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" 
										data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
										data-start="1000"
										data-splitout="none" 
										data-responsive_offset="on" 
										data-elementdelay="0.05" 
										style="z-index: 5;">
										<!-- <img src="<?php echo base_url(); ?>public/front_assets/images/home/3.png" alt=""> -->
									</div>

									<!-- LAYER NR. 2 -->
									
					                <div class="tp-caption tp-resizeme text-center"
					                    data-x="center" data-hoffset="0" 
					                    data-y="center" data-voffset="-40"
					                    data-transform_idle="o:1;"         
					                    data-transform_in="x:[-175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;" 
					                    data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" 
					                    data-mask_in="x:[100%];y:0;s:inherit;e:inherit;" 
					                    data-splitin="none" 
					                    data-splitout="none"                         
					                    data-start="500">
					                    <!-- <div class="banner-caption-h2"><?php echo $row1['var_title'];?></div>  -->                   
					                </div>
					                   
					                <div class="tp-caption tp-resizeme text-center"
					                    data-x="center" data-hoffset="0" 
					                    data-y="top" data-voffset="360"
					                    data-transform_idle="o:1;"                         
					                    data-transform_in="x:[175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;" 
					                    data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" 
					                    data-mask_in="x:[-100%];y:0;s:inherit;e:inherit;" 
					                    data-splitin="none" 
					                    data-splitout="none" 
					                    data-responsive_offset="on"                         
					                    data-start="1400">  
					                    <!-- <div class="banner-caption-h3">With Your Affortable</div>                   -->
					                    <!-- <div class="banner-caption-p"><p><?php echo $row1['txt_description'];?></p></div>                  
					                    <a href="<?php echo base_url(); ?>product" class="color1-bg contuct-us">shop now</a> -->
					                </div>             					         
								</li>
							<?php } ?>

							</ul>	
						</div>
					</div><!-- END REVOLUTION SLIDER -->
	        </div> <!-- End of #banner -->

	        <section class="free-shifting-section">
	        	<div class="container">
	        		<div>
	        			<div>Free shipping on order above Rs.1000</div>
	        		</div>
	        	</div>
	        </section>

			<!-- about Section ************************** -->
			<div class="about_section">
				<div class="container">
					<div class="row">
						<?php foreach ($offer1 as $v1) { ?>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12t">
							<div class="item wow fadeInLef" style="background-image: url(<?php echo base_url().'uploads/banner_img/'.$v1['var_image']; ?>);">
								<div class="offer-sec">
									<div class="inner-title"><?php echo $v1['var_title']; ?> <div class="offer"><span><?php echo $v1['offer']; ?>% <br>OFF</span></div></div>
								</div>
								<div class="content">
									<!-- <h3>We Grow Beauty</h3> -->
									<p><?php echo $v1['txt_description']; ?></p>
									<div class="link-btn"><a href="<?php echo base_url().'product/category/'.base64_encode($v1['fk_category']);?>" class="tran3s">Shop Now<span class="fa fa-sort-desc"></span></a></div>
								</div>
							</div>
						</div>
					<?php } foreach ($offer2 as $v2) { ?>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12t">
							<div class="item wow fadeInRight" style="background-image: url(<?php echo base_url().'uploads/banner_img/'.$v2['var_image']; ?>);">
								<div class="offer-sec">
									<div class="inner-title"><?php echo $v2['var_title']; ?><div class="offer"><span><?php echo $v2['offer']; ?>% <br>OFF</span></div></div>
								</div>
								<div class="content">
									<!-- <h3>We Grow Beauty</h3> -->
									<p><?php echo $v2['txt_description']; ?></p>
									<div class="link-btn"><a href="<?php echo base_url().'product/category/'.base64_encode($v2['fk_category']);?>" class="tran3s">Shop Now<span class="fa fa-sort-desc"></span></a></div>
								</div>
							</div>
						</div>
					<?php } ?>
					</div>
				</div> <!-- End of .container -->
			</div> <!-- End of .welcome_section -->


			    <!--feature Section-->
		    <section class="featured-product">
		        <div class="container">

		            <div class="theme_title center">
		                <h3>FEATURED PRODUCTS</h3>
		            </div>

		            <!--Filter-->
		            <div class="filters text-center">
		                <ul class="filter-tabs filter-btns clearfix">
		                    <li class="filter active" data-role="button" data-filter="all"><span class="txt">All</span></li>
		                	<?php if (count($category) > 0) {

						foreach ($category as $key => $value) {
							$rm = array(" ","-","'");
							$cate_title = str_replace($rm,"", $value['var_title']);
						?>
                            
							<li class="filter <?php if($key == 0){
								echo "active"; } ?>" data-role="button" data-filter=".<?php echo $cate_title; ?>"><span class="txt"><?php echo $value['var_title']; ?></span></li>
							<?php } } ?>
		                    <!-- <li class="filter active" data-role="button" data-filter="all"><span class="txt">Supergrain Flours</span></li>
		                    <li class="filter" data-role="button" data-filter=".fruits"><span class="txt">Healthy Herbs</span></li>
		                    <li class="filter" data-role="button" data-filter=".vegetables"><span class="txt">Refreshing Beverages</span></li>
		                    <li class="filter" data-role="button" data-filter=".beauty"><span class="txt">Nutritious Ready Meals</span></li>
		                    <li class="filter" data-role="button" data-filter=".others"><span class="txt">Super Combos</span></li> -->
		                </ul>
		            </div>

		            <div class="row filter-list clearfix" id="MixItUp717B05">
			           <?php if (count($category) > 0) {

							foreach ($category as $key => $cvalue) {
							    
								$rm = array(" ","-","'");
								$cate_ptitle = str_replace($rm, "", $cvalue['var_title']);
								?> 
								<?php 
									$products = $this->model->getProducts($cvalue['int_glcode']); 
									if (count($products) > 0) {
                                            // echo "<pre>";print_r($products);die();
										foreach ($products as $pkey => $pvalue) {
										     
											
											if ($pvalue['category_name'] == $cvalue['var_title']) {
											
											?>
			            <!--Default Item-->
			            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mix mix_all default-item <?php echo $cate_ptitle; ?>" <?php if ($cate_ptitle != '') {
									echo "style='display:inline-block;'";
								} else {
									echo "style='display:none;'";
								} ?>>

								
			                <div class="inner-box">
			                	
			                    <div class="single-item center">
			                        <figure class="image-box"><img src="<?php echo base_url().'uploads/products/'.$pvalue['var_image'] ?>" alt="" style=" height: 163px;"></figure>
			                        <div class="content">
			                        	<h3><a href="<?php echo base_url().'product/detail/'.base64_encode($pvalue['int_glcode']);?>"><?php echo $pvalue['var_title']; ?></a></h3>
			                            <div class="rating"><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span></div>
			                            <div class="price">&#x20b9;<?php echo $pvalue['var_price']; ?>&nbsp;
																(<?php echo $pvalue['var_quantity']; ?>) </div>
				                        <?php if($pvalue['var_stock'] == 0)
										{ ?> 
										<a href="javascript:;"><span class="btn btn-danger" id="OutOffStock">Out Off Stock</span></a>		
										<?php }
										
                                       
										else{ 
										 if($pvalue['var_stock'] < 5) 
										{ ?><span><?php echo $pvalue['var_stock']." Items left";?></span>
										<?php }?>
										<br><a href="javascript:;" onclick="add_to_cart('<?php echo $pvalue['q_id'];?>','1','<?php echo $pvalue['int_glcode'];?>','<?php echo $pvalue['var_offer'];?>')"><span class="btn btn-primary"  id="AddToCart">ADD TO CART</span></a>	
										<?php  } ?>
			                        </div>
			                      <!--  <div class="overlay-box">
			                        	<div class="inner">
				                        	<div class="top-content">
				                        		<ul>
				                        			<!-- <li><a href="#"><span class="fa fa-eye"></span></a></li> 
				                        			<li class="tultip-op"><span class="tultip"><i class="fa fa-sort-desc"></i>ADD TO CART</span>
				                        			
				                        			<a href="javascript:;" onclick="add_to_cart('<?php echo $pvalue['q_id'];?>','1','<?php echo $pvalue['int_glcode'];?>','<?php echo $pvalue['var_offer'];?>')"><span class="icon-icon-32846"></span></a>
													
													
													</li>
				                        			<!-- <li><a href="#"><span class="fa fa-heart-o"></span></a></li> 
				                        		</ul>
				                        		
				                        	</div>  
				                        	<div class="bottom-content">
				                        		<h4><a href="<?php echo base_url().'product/detail/'.base64_encode($pvalue['int_glcode']);?>"><?php echo $pvalue['var_title']; ?></a></h4>
				                        		<p><?php if($pvalue['var_stock'] == 0){ echo "Out of Stock"; } else if($pvalue['var_stock'] < 5) { echo $pvalue['var_stock']." Items left";}
                                        		?></p>
				                        		<p>&#x20b9;<?php echo $pvalue['var_price']; ?>&nbsp;
																(<?php echo $pvalue['var_quantity']; ?>) </p>
				                        	</div>
			                        	</div>
			                        </div>-->
				                </div>
			                </div>
			            
			            </div>
			            <?php } }}}} ?>  
			            <!--Default Item-->
			            
			            
			        </div>
		        </div>
			        
		    </section><!-- End of section -->


			<!-- Request Quote ******************************* -->
			<section class="why_choose_us">
				<div class="theme_title_bg" style="background-image: url(<?php echo base_url(); ?>public/front_assets/images/background/Why choose us.JPG);">
					<div class="theme_title center">
						<div class="container">
							<h2>Why Us</h2>
							<!-- <p style="color:#000;">There are many variations of passages of Lorem Ipsum available, but the majority have suffered <br>alteration in some form, by injected humour.</p> -->
							
						</div>
					</div>
					
				</div>
				<br>
				<div class="container">
					 <!-- End of .theme_title_center -->

					<div class="row">

						<!-- ______________ Item _____________ -->
						<div class="col-md-6 col-sm-12 col-xs-12">
							<div class="choose_us_item tran3s">
								<div class="icon p_color_bg border_round float_left"><span class="ficon icon-fruit-1"></span></div> <!-- End of .icon -->
								<div class="text float_left">
									<h3 class="tran3s">100% Natural Products</h3>
									<!-- <p class="tran3s">Duis aute irure dolor in reprehenderit voluptate velit esse seds cillum dolore eu fugiat nulla pariatur excepteur sint occaecat.</p> -->
								</div> <!-- End of .text -->
								<div class="clear_fix"></div>
							</div> <!-- End of .choose_us_item -->
						</div> <!-- End of .col -->

						<!-- ______________ Item _____________ -->
						<div class="col-md-6 col-sm-12 col-xs-12">
							<div class="choose_us_item tran3s">
								<div class="icon p_color_bg border_round float_left"><span class="ficon icon-wheat"></span></div> <!-- End of .icon -->
								<div class="text float_left">
									<h3 class="tran3s">Farm to Fork Processing</h3>
									<!-- <p class="tran3s">Duis aute irure dolor in reprehenderit voluptate velit esse seds cillum dolore eu fugiat nulla pariatur excepteur sint occaecat.</p> -->
								</div> <!-- End of .text -->
								<div class="clear_fix"></div>
							</div> <!-- End of .choose_us_item -->
						</div> <!-- End of .col -->

						<!-- ______________ Item _____________ -->
						<div class="col-md-6 col-sm-12 col-xs-12">
							<div class="choose_us_item tran3s">
								<div class="icon p_color_bg border_round float_left"><span class="ficon icon-food-2"></span></div> <!-- End of .icon -->
								<div class="text float_left">
									<h3 class="tran3s">No Additives</h3>
									<!-- <p class="tran3s">Duis aute irure dolor in reprehenderit voluptate velit esse seds cillum dolore eu fugiat nulla pariatur excepteur sint occaecat.</p> -->
								</div> <!-- End of .text -->
								<div class="clear_fix"></div>
							</div> <!-- End of .choose_us_item -->
						</div> <!-- End of .col -->

						<!-- ______________ Item _____________ -->
						<div class="col-md-6 col-sm-12 col-xs-12">
							<div class="choose_us_item tran3s">
								<div class="icon p_color_bg border_round float_left"><span class="ficon icon-fruit"></span></div> <!-- End of .icon -->
								<div class="text float_left">
									<h3 class="tran3s">Maximum Retention of Nutrients</h3>
									<!-- <p class="tran3s">Duis aute irure dolor in reprehenderit voluptate velit esse seds cillum dolore eu fugiat nulla pariatur excepteur sint occaecat.</p> -->
								</div> <!-- End of .text -->
								<div class="clear_fix"></div>
							</div> <!-- End of .choose_us_item -->
						</div> <!-- End of .col -->
					</div>
				</div> <!-- End of .container -->
			</section> <!-- End of why chooreus -->



			<!--gallery Section-->
		    <!-- <section class="gallery">
		        <div class="container">

		            <div class="theme_title">
		                <h3>Top Selling Products</h3>
		            </div>


		            <div class="row filter-list clearfix">
			            
			            <?php foreach($top_product as $rwr){ ?>
			            <div class="col-md-4 col-sm-6 col-xs-12 mix mix_all default-item all beauty others" style="display: inline-block;">
			            	
			                <div class="inner-box">
			                    <div class="single-item center">
			                        <figure class="image-box"><img src="<?php echo base_url().'uploads/products/'.$rwr['var_image'];?>" alt="" style="height: 250px;"></figure>
			                        <div class="overlay-box">
			                        	<div class="inner">
				                        	<div class="image-view">
				                                <div class="icon-holder">
				                                    <a href="<?php echo base_url().'uploads/products/'.$rwr['var_image'];?>" class="fancybox" data-fancybox-group="home-gallery" title="Gardener Gallery"><span class="icon-magnifier"></span></a>
				                                </div>
				                            </div>
				                        	<div class="bottom-content">
				                        		<h4><a href="<?php echo base_url().'product/detail/'.base64_encode($rwr['int_glcode']);?>"><?php echo $rwr['var_title'];?></a></h4>
				                        		<div class="price">&#x20b9;<?php echo $rwr['var_price'];?> &nbsp; (<?php echo $rwr['var_quantity'];?>)</div>
				                        		<div class="icon-box">
				                        		    <?php if(isset($_SESSION['fk_user'])){ ?>
				                        			<a href="javascript:;" onclick="add_to_cart('<?php echo $rwr['q_id'];?>','1','<?php echo $rwr['int_glcode'];?>','<?php echo $rwr['var_offer'];?>')"><span class="icon-icon-32846"></span></a>
													<?php } else { ?>
													<a href="javascript:;" data-toggle="modal" data-target="#wantDonate"><span class="icon-icon-32846"></span></a>
													<?php } ?>
				                        		    
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
			        
		    </section> -->

			<section class="news">
				<div class="container">
					<div class="theme_title center">
		                <h3>our latest news</h3>
		            </div>
					<div class="row">
					    <?php foreach($blog as $blg) { ?>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="blogList_single_post clear_fix wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
									<img src="<?php echo base_url().'uploads/blog/'.$blg['var_image'] ?>" alt="News" class="img-responsive">	
								<div class="post">
									<ul>
										<li><a href="<?php echo base_url(); ?>blog" class="tran3s"><i class="fa fa-tag" aria-hidden="true"></i> Healthy</a></li>
										<li><a href="<?php echo base_url(); ?>blog" class="tran3s"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $blg['var_author']; ?></a></li>
										<li><a href="<?php echo base_url(); ?>blog" class="tran3s"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php   $date=date_create($blg['dt_createddate']);
													echo date_format($date,"d|m|Y");
											 ?></a></li>
									</ul>
									<div class="text">
										<h4><a href="<?php echo base_url(); ?>blog"><?php echo $blg['var_name']; ?></a></h4>
										<p><?php echo $blg['short_description']; ?></p>
										<div class="link"><a href="<?php echo base_url().'pages/blog_details/'.base64_encode($blg['int_glcode']);?>" class="tran3s">READ MORE<span class="fa fa-sort-desc"></span></a></div>
										
									</div>
									
								</div> <!-- End of .post -->
	        				</div>
							
						</div>
						
						<?php } ?>
						
					</div>
				</div>
			</section>




		    <!--Testimonials Section-->
		    <section class="testimonials-section">
		        <div class="container">
		            <div class="theme_title">
						<h2>testimonials</h2>
					</div>
		            <div class="testimonials-carousel">
		                <?php foreach($testimonial as $test) { ?>
		            	<!--Slide Item-->
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
		                            </div>
		                        </div>
		                    </div>
		                </div>
		                <?php } ?>
		                
		            	
		            </div>
		        </div>
		    </section>

			<!-- Partner Logo********************** -->

	        <!-- <div class="partners wow fadeInUp">
	        	<div class="container">
	        		<div id="partner_logo" class="owl-carousel owl-theme">
						<div class="item"><img src="<?php echo base_url(); ?>public/front_assets/images/partner-logo/1.png" alt="logo"></div>
						<div class="item"><img src="<?php echo base_url(); ?>public/front_assets/images/partner-logo/2.png" alt="logo"></div>
						<div class="item"><img src="<?php echo base_url(); ?>public/front_assets/images/partner-logo/3.png" alt="logo"></div>
						<div class="item"><img src="<?php echo base_url(); ?>public/front_assets/images/partner-logo/4.png" alt="logo"></div>
						<div class="item"><img src="<?php echo base_url(); ?>public/front_assets/images/partner-logo/1.png" alt="logo"></div>
						<div class="item"><img src="<?php echo base_url(); ?>public/front_assets/images/partner-logo/2.png" alt="logo"></div>
						<div class="item"><img src="<?php echo base_url(); ?>public/front_assets/images/partner-logo/3.png" alt="logo"></div>
						<div class="item"><img src="<?php echo base_url(); ?>public/front_assets/images/partner-logo/4.png" alt="logo"></div>
						<div class="item"><img src="<?php echo base_url(); ?>public/front_assets/images/partner-logo/1.png" alt="logo"></div>
						<div class="item"><img src="<?php echo base_url(); ?>public/front_assets/images/partner-logo/2.png" alt="logo"></div>
						<div class="item"><img src="<?php echo base_url(); ?>public/front_assets/images/partner-logo/3.png" alt="logo"></div>
						<div class="item"><img src="<?php echo base_url(); ?>public/front_assets/images/partner-logo/4.png" alt="logo"></div>

					</div> End .partner_logo 
				</div>
			</div> -->
<script>
	$(document).on("scroll", function(){
	if
	($(document).scrollTop() > 86){
		$("#banner").addClass("shrink");
	}
	else
	{
		$("#banner").removeClass("shrink");
	}
	});

	</script>
	<script>
	function openCity(cityName) {

	var i;
	var x = document.getElementsByClassName("city");
	for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";  
	}
	document.getElementById(cityName).style.display = "block";  
	}
	</script>
	<script type="text/javascript">
	$(document).ready(function () {
	var itemsMainDiv = ('.MultiCarousel');
	var itemsDiv = ('.MultiCarousel-inner');
	var itemWidth = "";

	$('.leftLst, .rightLst').click(function () {
		var condition = $(this).hasClass("leftLst");
		if (condition)
			click(0, this);
		else
			click(1, this)
	});

	ResCarouselSize();

	$(window).resize(function () {
		ResCarouselSize();
	});

           //this function define the size of the items
           function ResCarouselSize() {
           	var incno = 0;
           	var dataItems = ("data-items");
           	var itemClass = ('.item');
           	var id = 0;
           	var btnParentSb = '';
           	var itemsSplit = '';
           	var sampwidth = $(itemsMainDiv).width();
           	var bodyWidth = $('body').width();
           	$(itemsDiv).each(function () {
           		id = id + 1;
           		var itemNumbers = $(this).find(itemClass).length;
           		btnParentSb = $(this).parent().attr(dataItems);
           		itemsSplit = btnParentSb.split(',');
           		$(this).parent().attr("id", "MultiCarousel" + id);


           		if (bodyWidth >= 1200) {
           			incno = itemsSplit[3];
           			itemWidth = sampwidth / incno;
           		}
           		else if (bodyWidth >= 992) {
           			incno = itemsSplit[2];
           			itemWidth = sampwidth / incno;
           		}
           		else if (bodyWidth >= 768) {
           			incno = itemsSplit[1];
           			itemWidth = sampwidth / incno;
           		}
           		else {
           			incno = itemsSplit[0];
           			itemWidth = sampwidth / incno;
           		}
           		$(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
           		$(this).find(itemClass).each(function () {
           			$(this).outerWidth(itemWidth);
           		});

           		$(".leftLst").addClass("over");
           		$(".rightLst").removeClass("over");

           	});
           }

           //this function used to move the items
           function ResCarousel(e, el, s) {
           	var leftBtn = ('.leftLst');
           	var rightBtn = ('.rightLst');
           	var translateXval = '';
           	var divStyle = $(el + ' ' + itemsDiv).css('transform');
           	var values = divStyle.match(/-?[\d\.]+/g);
           	var xds = Math.abs(values[4]);
           	if (e == 0) {
           		translateXval = parseInt(xds) - parseInt(itemWidth * s);
           		$(el + ' ' + rightBtn).removeClass("over");

           		if (translateXval <= itemWidth / 2) {
           			translateXval = 0;
           			$(el + ' ' + leftBtn).addClass("over");
           		}
           	}
           	else if (e == 1) {
           		var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
           		translateXval = parseInt(xds) + parseInt(itemWidth * s);
           		$(el + ' ' + leftBtn).removeClass("over");

           		if (translateXval >= itemsCondition - itemWidth / 2) {
           			translateXval = itemsCondition;
           			$(el + ' ' + rightBtn).addClass("over");
           		}
           	}
           	$(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
           }

           //It is used to get some elements from btn
           function click(ell, ee) {
           	var Parent = "#" + $(ee).parent().attr("id");
           	var slide = $(Parent).attr("data-slide");
           	ResCarousel(ell, Parent, slide);
           }

       });
	   
	  //Alert for ADD TO CART
	 $(document).ready ( function () 
	{
		$(document).on('click', "#AddToCart", function () 
		{
			alert("Product added to your cart");
		});
	});
   </script>
