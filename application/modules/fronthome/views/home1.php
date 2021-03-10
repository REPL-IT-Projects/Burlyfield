<div class="banner home-banner-slider">
	<div class="container-fluid">
		<div class="owl-carousel owl-theme">
			<?php foreach ($banner_img as $row1){ ?>
				<div class="item">
					<div class="row">
						<div class="col-md-7 col-sm-9 col-lg-6">
							<div class="banner-heading-section">
								<div class="banner-text">
									<div class="banner-heading"><?php echo $row1['var_title'];?></div>
									<div class="banner-sub-heading"><?php echo $row1['txt_description'];?></div>
									<a href="<?php echo base_url(); ?>product" class="btn btn-banner d-flex align-items-center justify-content-center">SHOP NOW <i class="fa fa-angle-double-right"></i></a>
								</div>
							</div>
						</div>
						<div class="col-md-5 col-sm-3 col-lg-6">
							<div class="banner-img-size banner-heading-section banner-heading-section-width">
								<div class="banner-text">
									<div class="banner-img">
										<img src="<?php echo base_url().'uploads/banner_img/'.$row1['var_image']; ?>">
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

<section>
	<div class="welcome-section margin-top-150">
		<div class="container">
			<div class="text-intro">
				<div class="sub-title">
					<div class="how-pos1-parent">
						<div class="how-pos1">
							<img src="<?php echo base_url(); ?>public/front_assets/images/symbol-02.png" alt="IMG">
						</div>
					</div>
				</div>
				<h2 class="main-title margin-bottom-30">WELCOME TO VRUITS</h2>
				<div class="welcome-img-section">
					<div class="welcome-box">
						<div class="col-md-3-custom">
							<div class="item-welcome one">
								<img src="<?php echo base_url(); ?>public/front_assets/images/icon3.3.png">
								<h5 class="mb-3">Always Fresh</h5>
								<p>We procure goods in the morning and deliver it throughout the day. Same process is repeated everyday to reach unmatched level of freshness.
								</p>
							</div>
						</div>
						<div class="col-md-3-custom">
							<div class="item-welcome two">
								<img src="<?php echo base_url(); ?>public/front_assets/images/icon2.2.png">
								<h5 class="mb-3">Every Product Handpicked </h5>
								<p>We handpick each and every product before delivery to make sure they are fresh and of best quality.</p>
							</div>
						</div>
						<div class="col-md-3-custom">
							<div class="item-welcome">
								<img src="<?php echo base_url(); ?>public/front_assets/images/icon1.1.png">
								<h5 class="mb-3">Eat Healthy, Live Healthy</h5>
								<p>With a mix of everyday procurement and handpicking the products, we are able to provide only healthy fruits and vegetables.</p>
							</div>
						</div>
						<div class="col-md-3-custom">
							<div class="item-welcome four">
								<img src="<?php echo base_url(); ?>public/front_assets/images/icon4.4.png">
								<h5 class="mb-3">Food Safety</h5>
								<p>All our products go through a strict quality check before being delivered. All the products we deliver are completely safe to consume.</p>
							</div>
						</div>
						<div class="center-img-position">
							<img src="<?php echo base_url(); ?>public/front_assets/images/other-01.jpg">
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section>
		<div class="product-section">
			<div class="container">
				<div class="text-center">
					<div class="sub-title">
						<div class="how-pos1-parent">
							<div class="how-pos1">
								<img src="<?php echo base_url(); ?>public/front_assets/images/symbol-02.png" alt="IMG">
							</div>
						</div>
					</div>
					<h2 class="main-title margin-bottom-30">Our products</h2>
				</div>
				<div class="w3-bar w3-black tab-width-add">
					
					<?php if (count($category) > 0) {

						foreach ($category as $key => $value) {
							$cate_title = str_replace("'", '', $value['var_title']);
						?>
							<button class="w3-bar-item w3-button <?php if($value['var_title'] == $category[0]['var_title']){
								echo "active"; } ?>" onclick="openCity('<?php echo $cate_title; ?>')"><?php echo $value['var_title']; ?></button>

							<?php } } ?>
						</div>

						<?php if (count($category) > 0) {

							foreach ($category as $key => $cvalue) {
								$cate_ptitle = str_replace("'", '', $cvalue['var_title']);
								?>

								<div id="<?php echo $cate_ptitle; ?>" class="w3-container city" <?php if ($cvalue['var_title'] == $category[0]['var_title']) {
									echo "style='display:block;'";
								} else {
									echo "style='display:none;'";
								} ?>>
								<div class="row">
									<?php 
									$products = $this->model->getProducts($cvalue['int_glcode']); 
									if (count($products) > 0) {

										foreach ($products as $pkey => $pvalue) {

											if ($pvalue['category_name'] == $cvalue['var_title']) { ?>
												<div class="col-md-3 col-sm-6">
													<div class="product-grid6">
														<?php if($pvalue['var_offer'] != '0'){ ?>
									                       <div class="favourite-icon">
									                        <a href="javascript:;" class="fav-btn-present"><span><?php echo $pvalue['var_offer'];?>%</span></a>
									                      </div>
									                    <?php } ?>
														<div class="product-image6 thumbnail_container">
															<a class="thumbnail" href="<?php echo base_url().'product/detail/'.base64_encode($pvalue['int_glcode']);?>">
																<img class="pic-1" src="<?php echo base_url().'uploads/products/'.$pvalue['var_image'] ?>">
															</a>
														</div>
														<div class="product-content">
															<h3 class="title"><a href="#"><?php echo $pvalue['var_title']; ?></a></h3>
															<div class="price">&#x20b9;<?php echo $pvalue['var_price']; ?>&nbsp;
																(<?php echo $pvalue['var_quantity']; ?>)
															</div>
														</div>
														<ul class="social">
															<li><a href="<?php echo base_url().'product/detail/'.base64_encode($pvalue['int_glcode']);?>" data-tip="Quick View"><i class="fa fa-info"></i></a></li>
															<li><a href="<?php echo base_url().'product/detail/'.base64_encode($pvalue['int_glcode']);?>" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
														</ul>
													</div>
												</div>	
											<?php } } } else { ?>
												<div class="text-center">
													<div class="sub-title">
														<div class="how-pos1-parent">
															<h6 class="margin-bottom-30"><?php echo $cate_ptitle; ?> products are not available.</h6>
														</div>
													</div>
													<!-- <h2 class="main-title margin-bottom-30">Best Offers View </h2> -->
												</div>
											<?php } ?>
										</div>
									</div>
								<?php } } ?>
							</div>
						</div>
					</section>
					<section>
						<div class="client-say-section my-5">
							<div class="container">
								<div class="client-box-section">
									<div class="owl-carousel owl-theme">
										<div class=" item">
											<div class="client-box">
												<div class="client-img"><img src="<?php echo base_url(); ?>public/front_assets/images/client.png"></div>
												<p class="content"><span class="quate-width top-quate">&#8220;</span><span>Everything I had asked for and more in my<br> web site, and muchhelp from vice.</span><span class="quate-width bottom-quate">&#8221;</span></p>
												<h6> Jecob Joeckno</h6>
												<p>Lorem ipsum</p>
											</div>
										</div>
										<div class=" item">
											<div class="client-box">
												<div class="client-img"><img src="<?php echo base_url(); ?>public/front_assets/images/client.png"></div>
												<p class="content"><span class="quate-width top-quate">&#8220;</span><span>Everything I had asked for and more in my<br> web site, and muchhelp from vice.</span><span class="quate-width bottom-quate">&#8221;</span></p>
												<h6> Jecob Joeckno</h6>
												<p>Lorem ipsum</p>
											</div>
										</div>
										<div class=" item">
											<div class="client-box">
												<div class="client-img"><img src="<?php echo base_url(); ?>public/front_assets/images/client.png"></div>
												<p class="content"><span class="quate-width top-quate">&#8220;</span><span>Everything I had asked for and more in my<br> web site, and muchhelp from vice.</span><span class="quate-width bottom-quate">&#8221;</span></p>
												<h6> Jecob Joeckno</h6>
												<p>Lorem ipsum</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>

					<section>
						<div class="featured-product-section top-gap-margin">
							<div class="container">
								<div class="text-center">
									<div class="sub-title">
										<div class="how-pos1-parent">
											<h4 class="margin-bottom-30">Hot Products</h4>
											<div class="how-pos1">
												<img src="<?php echo base_url(); ?>public/front_assets/images/symbol-02.png" alt="IMG">
											</div>
										</div>
									</div>
									<!-- <h2 class="main-title margin-bottom-30">Best Offers View </h2> -->
								</div>
								<div class="row">
									<?php foreach($top_product as $rwr){ ?>
										<div class="col-md-3 col-sm-6">
											<div class="product-grid6">
												<?php if($rwr['var_offer'] != '0'){ ?>
							                       <div class="favourite-icon">
							                        <a href="javascript:;" class="fav-btn-present"><span><?php echo $rwr['var_offer'];?>%</span></a>
							                      </div>
							                    <?php } ?>
												<div class="product-image6 thumbnail_container">
													<a class="thumbnail" href="<?php echo base_url().'product/detail/'.base64_encode($rwr['int_glcode']);?>">
														<img class="pic-1" src="<?php echo base_url().'uploads/products/'.$rwr['var_image'];?>">
													</a>
												</div>
												<div class="product-content">
													<h3 class="title"><a href="<?php echo base_url().'product/detail/'.base64_encode($rwr['int_glcode']);?>"><?php echo $rwr['var_title'];?></a></h3>

													<div class="price">&#x20b9;<?php echo $rwr['var_price'];?> &nbsp; (<?php echo $rwr['var_quantity'];?>)
													<!--<span>$14.00</span>-->
												</div>
											</div>
											<ul class="social">
												<li><a href="<?php echo base_url().'product/detail/'.base64_encode($rwr['int_glcode']);?>" data-tip="Quick View"><i class="fa fa-info"></i></a></li>
												<li><a href="<?php echo base_url().'product/detail/'.base64_encode($rwr['int_glcode']);?>" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
											</ul>
										</div>
									</div>
								<?php } ?>

							</div>
						</div>
					</div>
				</section>
<?php if (count($offer_product) > 0) { ?>
<section>
		<div class="free-shipping bottom-gap-margin top-gap-margin">
			<div class="container">
				<div class="text-center">
					<div class="sub-title">
						<div class="how-pos1-parent">
							<h4 class="margin-bottom-30">Best Offers View</h4>
							<div class="how-pos1">
								<img src="<?php echo base_url(); ?>public/front_assets/images/symbol-02.png" alt="IMG">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<?php foreach ($offer_product as $okey => $ovalue) { ?>
						<div class="col-md-3 col-sm-6">
							<div class="product-grid6">
								<?php if($ovalue['var_offer'] != '0'){ ?>
			                       <div class="favourite-icon">
			                        <a href="javascript:;" class="fav-btn-present"><span><?php echo $ovalue['var_offer'];?>%</span></a>
			                      </div>
			                    <?php } ?>
								<div class="product-image6 thumbnail_container">
									<a class="thumbnail" href="<?php echo base_url().'product/detail/'.base64_encode($ovalue['int_glcode']);?>">
										<img class="pic-1" src="<?php echo $ovalue['var_image'];?>">
									</a>
								</div>
								<div class="product-content">
									<h3 class="title"><a href="<?php echo base_url().'product/detail/'.base64_encode($ovalue['int_glcode']);?>"><?php echo $ovalue['var_title'];?></a></h3>

									<div class="price">&#x20b9;<?php echo $ovalue['var_price'];?> &nbsp; (<?php echo $ovalue['var_quantity'];?>)
								</div>
							</div>
							<ul class="social">
								<li><a href="<?php echo base_url().'product/detail/'.base64_encode($ovalue['int_glcode']);?>" data-tip="Quick View"><i class="fa fa-info"></i></a></li>
								<li><a href="<?php echo base_url().'product/detail/'.base64_encode($ovalue['int_glcode']);?>" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
							</ul>
						</div>
					</div>
				<?php } ?>

			</div>
		</div>
	</div>
</section>
<?php } ?>

<?php 
if (isset($_SESSION['fk_user'])) {

	$search_class = 'free-shipping';
	
	if (count($recent_p) > 0) { ?>
	<section>
         <div class="featured-product-section best-offer-slider" style="background-color: transparent; ">
            <div class="container">
               <div class="text-center">
                  <div class="sub-title">
                     <div class="how-pos1-parent">
                        
                        <div class="how-pos1">
                           <img src="<?php echo base_url(); ?>public/front_assets/images/symbol-02.png" alt="IMG">
                        </div>
                     </div>
                  </div>
                  
                  <h4 class="margin-bottom-30">Recently Bought Products </h4>
               </div>
               <div class="owl-carousel owl-theme">
               	<?php 
               		foreach ($recent_p as $rkey => $rvalue) { ?>
               			<div class="item">
	                     <div class="product-grid6">
	                     	<?php if($rvalue['var_offer'] != '0'){ ?>
		                       <div class="favourite-icon">
		                        <a href="javascript:;" class="fav-btn-present"><span><?php echo $rvalue['var_offer'];?>%</span></a>
		                      </div>
		                    <?php } ?>
	                        <div class="product-image6 thumbnail_container">
	                           <a class="thumbnail" href="<?php echo base_url().'product/detail/'.base64_encode($rvalue['int_glcode']);?>">
	                           <img class="pic-1" src="<?php echo $rvalue['var_image']; ?>">
	                           </a>
	                        </div>
	                        <div class="product-content">
	                           <h3 class="title"><a href="JavaScript:Void(0);"><?php echo $rvalue['var_title']; ?></a></h3>
	                           <div class="price">&#x20b9; <?php echo $rvalue['var_price']; ?> &nbsp;
	                              (<?php echo $rvalue['var_quantity']; ?>)
	                           </div>
	                        </div>
	                        <ul class="social">
	                           <li><a href="<?php echo base_url().'product/detail/'.base64_encode($rvalue['int_glcode']);?>" data-tip="Quick View"><i class="fa fa-search"></i></a></li>
	                           <li><a href="<?php echo base_url().'product/detail/'.base64_encode($rvalue['int_glcode']);?>" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
	                        </ul>
	                     </div>
	                  </div>
               	<?php } } ?>
               </div>
            </div>
         </div>
      </section>
<?php } else {
	$search_class = 'featured-product-section';
} ?>
	
<section>
	<div class="<?php echo $search_class; ?> bottom-gap-margin top-gap-margin">
	<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="free-shipping-box">
				<div class="media">
					<div class="icon-img"><img class="" src="<?php echo base_url(); ?>public/front_assets/images/ship-1.png" alt=""></div>
					<div class="media-body">
						<h6>Quick search</h6>
						<p class="text-overly-add">Set your location to start exploring fresh, hygienic and healthy fruits and vegetables around you on Vruits!</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="free-shipping-box">
				<div class="media">
					<div class="icon-img"><img class="" src="<?php echo base_url(); ?>public/front_assets/images/ship-2.png" alt=""></div>
					<div class="media-body">
						<h6>Variety of fruits and vegetables</h6>
						<p class="text-overly-add">Choose from a wide range of local and exotic fruits and vegetables which are delivered to you fresh and clean.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="free-shipping-box">
				<div class="media">
					<div class="icon-img"><img class="" src="<?php echo base_url(); ?>public/front_assets/images/ship-3.png" alt=""></div>
					<div class="media-body">
						<h6>Same day delivery</h6>
						<p class="text-overly-add">Get your products delivered on the same day and superfast delivery within 90 mins in your selected time slot.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
	</section>
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
   </script>