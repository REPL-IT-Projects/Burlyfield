<!-- <section class="breadcrumb-area" style="background-image:url(<?php echo base_url(); ?>public/front_assets/images/background/2.jpg);">
			    <div class="container">
			        <div class="row">
			            <div class="col-md-12">
			                <div class="breadcrumbs text-center">
			                    <h1>Product Details</h1>
			                    <h4>Welcome to certified BURLY FIELD</h4>
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
				                    <li>Product Details</li> 
				                </ul>
				            </div>
				            <div class="col-lg-4 col-md-7 col-sm-7">
				                <p>We provide <span>100% organic</span> products</p>
				            </div>
				        </div>
				    </div>
				</div>
			    
			</section> -->


			<!-- Single Shop page content __-______________ -->

	        <div class="shop_single_page">
	        	<div class="container">
	        		<div class="row">
						<!-- _______________________ SIDEBAR ____________________ -->
	        			<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 sidebar_styleTwo">
	        				<div class="wrapper">
	        					

	        					<div class="sidebar_categories">
	        						<div class="theme_inner_title">
										<h4>Categories</h4>
									</div>
									<ul>
										<!-- <li><a href="<?php echo base_url().'product';?>" class="tran3s">All</a></li> -->
										<?php foreach($category as $row4){ ?> 
										<li><a href="<?php echo base_url().'product/category/'.base64_encode($row4['int_glcode']);?>" class="tran3s" rel="nofollow"><?php echo $row4['var_title'];?></a></li>
									<?php } ?>
										
									</ul>
	        					</div> <!-- End of .sidebar_categories -->

								<div class="best_sellers clear_fix wow fadeInUp">
									<div class="theme_inner_title">
										<h4>popular products</h4>
									</div>
									<?php foreach($new_product as $row11){ ?>
									<div class="best_selling_item clear_fix border">
										<div class="img_holder float_left">
											<img src="<?php echo base_url().'uploads/products/'.$row11['var_image'];?>" style="height: 70px; width: 70px;" alt="image">
										</div> <!-- End of .img_holder -->
										<!--<div class="img_holder float_left">
											<img src="<?php echo base_url().'uploads/products/'.$row11['var_image1'];?>" style="height: 70px; width: 70px;" alt="image">
										</div>-->

										<div class="text float_left display-inline ">
											<a href="<?php echo base_url().'product/detail/'.base64_encode($row11['int_glcode']);?>"><h6><?php echo $row11['var_title'];?></h6></a>
											<ul>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
											</ul>
											<span>&#x20b9; <?php echo $row11['var_price'];?></span>
										</div> <!-- End of .text -->
									</div> <!-- End of .best_selling_item -->
								<?php } ?>
								<?php foreach($new_product as $row11){ ?>
									<div class="best_selling_item clear_fix border">
										<div class="img_holder float_left">
											<img src="<?php echo base_url().'uploads/products/'.$row11['var_image'];?>" style="height: 70px; width: 70px;" alt="image">
										</div> <!-- End of .img_holder -->
										<!--<div class="img_holder float_left">
											<img src="<?php echo base_url().'uploads/products/'.$row11['var_image1'];?>" style="height: 70px; width: 70px;" alt="image">
										</div>
										<div class="img_holder float_left">
											<img src="<?php echo base_url().'uploads/products/'.$row11['var_image2'];?>" style="height: 70px; width: 70px;" alt="image">
										</div>
											<div class="img_holder float_left">
											<img src="<?php echo base_url().'uploads/products/'.$row11['var_image3'];?>" style="height: 70px; width: 70px;" alt="image">
										</div>-->

										<div class="text float_left display-inline ">
											<a href="<?php echo base_url().'product/detail/'.base64_encode($row11['int_glcode']);?>"><h6><?php echo $row11['var_title'];?></h6></a>
											<ul>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
											</ul>
											<span>&#x20b9; <?php echo $row11['var_price'];?></span>
										</div> <!-- End of .text -->
									</div> <!-- End of .best_selling_item -->
								<?php } ?>
									
								</div> <!-- End of .best_sellers -->


	        				</div> <!-- End of .wrapper -->
	        			</div> <!-- End of .sidebar_styleTwo -->
	        			<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 product_details">
	        				<div class="wrapper">
	        					<?php foreach ($product as $pvalue) { ?>
	        						<!--<a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-mdb-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </a>
		<a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-mdb-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </a>
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Next</span> -->
	
			<div class="row">
				<div class="col-sm-6">
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<div class="item active">
								<div class="row">
									<div class="product_top_section clear_fix">
										<div class="img_holder float_left">
											 <?php
                            if ($pvalue['var_image'] != '') {?>
                              <img src="<?php echo base_url().'uploads/products/'.$pvalue['var_image'];?>" alt="img" class="img-responsive" >
                           <?php } else{ ?>
                                <img src="<?php echo base_url().'public/assets/images/site_imges/noimage.jpg' ?> ">;
                           <?php } ?>
										</div>
									</div>
								</div>
							</div>
							<div class="item">
							   <div class="row">
									<div class="product_top_section clear_fix">
										<div class="img_holder float_left">
											 <?php
                            if ($pvalue['var_image1'] != '') {?>
                              <img src="<?php echo base_url().'uploads/products/'.$pvalue['var_image1'];?>" alt="img" class="img-responsive" >
                           <?php } else{ ?>
                                <img src="<?php echo base_url().'public/assets/images/site_imges/noimage.jpg' ?> ">;
                           <?php } ?>
										</div> <!-- End of .img_holder -->
									</div>
								</div>
							</div>
							<div class="item">
							   <div class="row">
									<div class="product_top_section clear_fix">
										<div class="img_holder float_left">
							<?php   if ($pvalue['var_image2'] != '') {?>
                              <img src="<?php echo base_url().'uploads/products/'.$pvalue['var_image2'];?>" alt="img" class="img-responsive" >
                           <?php } else{ ?>
                                <img src="<?php echo base_url().'public/assets/images/site_imges/noimage.jpg' ?> ">;
                           <?php } ?>
										</div> <!-- End of .img_holder -->
									</div>
								</div>
							</div>
							<div class="item">
							   <div class="row">
									<div class="product_top_section clear_fix">
										<div class="img_holder float_left">
											 <?php
                            if ($pvalue['var_image3'] != '') {?>
                              <img src="<?php echo base_url().'uploads/products/'.$pvalue['var_image3'];?>" alt="img" class="img-responsive" >
                           <?php } else{ ?>
                                <img src="<?php echo base_url().'public/assets/images/site_imges/noimage.jpg' ?> ">;
                           <?php } ?>
										</div> <!-- End of .img_holder -->
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="controls testimonial_control pull-right">
							<a class="left fa fa-chevron-left btn btn-default testimonial_btn" style="background-color: #373d4b !important;
									color: #fff !important;" href="#carousel-example-generic" data-slide="prev"></a>

							<a class="right fa fa-chevron-right btn btn-default testimonial_btn" style="background-color: #373d4b !important;
									color: #fff !important;" href="#carousel-example-generic" data-slide="next"></a>
					</div>
				</div>
					<div class="col-sm-6">
						<div class="product_top_section clear_fix">
							<div class="item_description float_left">
	        							<h4><?php echo $pvalue['var_title'];?></h4>
	        							<ul>
											<li><i class="fa fa-star" aria-hidden="true"></i></li>
											<li><i class="fa fa-star" aria-hidden="true"></i></li>
											<li><i class="fa fa-star" aria-hidden="true"></i></li>
											<li><i class="fa fa-star" aria-hidden="true"></i></li>
											<li><i class="fa fa-star" aria-hidden="true"></i></li>
											<li>(<?php echo count($review);?> Customers Review)</li>
										</ul>
										<span class="item_price">&#x20b9; <?php echo $pvalue['var_price'];?></span>
										
										<span class="check_location"><!-- Do you Deliver at my Pincode ? --></span>
										<div class="clear_fix">
											<!-- <input type="text" class="float_left" id="pincode" name="pincode" placeholder="Pincode">
											<input type="hidden" class="float_left" id="fk_product" name="fk_product" value="<?php echo $pvalue['int_glcode'];?>" placeholder="Pincode">
											<button id="submitpin" class="float_left tran3s">Check</button> -->
											<span class="float_left color1" id="abl"><p><?php if($pvalue['var_stock'] == 0){ echo "Out of Stock"; } else if($pvalue['var_stock'] < 5) { echo $pvalue['var_stock']." Items left";}
				                        		?></p></span>
										</div>
										<input type="hidden" name="fk_price" id="fk_price" value="<?php echo $pvalue['q_id'];?>">
										<input type="hidden" name="product_id" id="product_id" value="<?php echo $pvalue['int_glcode'];?>">
										<input type="hidden" name="var_offer" id="var_offer" value="<?php echo $pvalue['var_offer'];?>">
										<input type="number" name="quantity_wanted" id="quantity_wanted" value="1" onkeyup="set_qty()" min="1">
										<?php // if(isset($_SESSION['fk_user'])){ ?>
				                        <a href="javascript:;" onclick="add_to_cart1()" class="tran3s ">Add to Cart</a>
										<?php // } else { ?>
										<!--<a href="javascript:;" data-toggle="modal" data-target="#wantDonate"><span  class="tran3s ">Add to Cart</a>-->
										<?php // } ?>
	        						</div> <!-- End of item_description -->
	        					</div> <!-- End of .product_top_section -->
			</div></div>
	

	        					<!-- __________________ Product review ___________________ -->
	        					<div class="product-review-tab">
									<ul class="nav nav-pills">
									    <li class="active"><a data-toggle="pill" href="#tab1">Description</a></li>
									    <li><a data-toggle="pill" href="#tab2">Reviews(<?php echo count($review);?>)</a></li>
								  	</ul>
								  
									 <div class="tab-content">
									    <div id="tab1" class="tab-pane fade in active">
									    	<h6>Product Description</h6>
									      <p><?php echo $pvalue['txt_description']; ?></p>
									      <h6>Benefits of Burlyfield Ingredients</h6>
									      <p><?php echo $pvalue['txt_nutrition']; ?></p>
									      
									    </div> <!-- End of #tab1 -->

									    <div id="tab2" class="tab-pane fade">
									      <!-- Single Review -->
									      <?php foreach ($review as $rv) { 
									      		
									      	?>
									      
									      <div class="item_review_content clear_fix">
									      	<div class="img_holder float_left">
									      		
									      	</div> <!-- End of .img_holder -->

									      	<div class="text float_left ">
									      		<div class="sec_up clear_fix">
									      			<h6 class="float_left"><?php echo $rv['var_name']; ?></h6>
									      			<div class="float_right">
									      				<span class="p_color"><?php echo $rv['dt_createddate']; ?></span>
									      				<ul>
									      					<?php for ($i=0; $i < $rv['var_rate']; $i++) { 
									      						echo "<li><i class='fa fa-star' aria-hidden='true'></i></li>";
									      					} ?>
															
														</ul>
									      			</div>
									      		</div> <!-- End of .sec_up -->
									      		<p class="text float_left "><?php echo $rv['var_message']; ?></p>
									      	</div> <!-- End of .text -->
									      </div> <!-- End of .item_review_content -->
									      <?php } ?>
									      
									      


									      <div class="add_your_review">
										      	<div class="theme_inner_title">
													<h4>Add Your Review</h4>
												</div>
												<span class="float_left color1" id="abcd"></span>
												<span>Your Rating</span>
												<form action="<?php echo base_url(); ?>product/review" method="post">
													<input type="hidden" name="id" value="<?php echo $pvalue['int_glcode']; ?>">
													<div class="row">
														<div class="col-lg-12">
														<div class="radio-review">
															
															<input class="color1" type="radio" name="rate" value="1"> <i class="fa fa-star" aria-hidden="true"></i>
														</div>
														<div class="radio-review">
															<input class="color1" type="radio" name="rate" value="2">
															<i class="fa fa-star" aria-hidden="true"></i>
															<i class="fa fa-star" aria-hidden="true"></i>
														</div>
														<div class="radio-review">
															<input class="color1" type="radio" name="rate" value="3">
															<i class="fa fa-star" aria-hidden="true"></i>
															<i class="fa fa-star" aria-hidden="true"></i>
															<i class="fa fa-star" aria-hidden="true"></i>
														</div>
														<div class="radio-review">
															<input class="color1" type="radio" name="rate" value="4">
															<i class="fa fa-star" aria-hidden="true"></i>
															<i class="fa fa-star" aria-hidden="true"></i>
															<i class="fa fa-star" aria-hidden="true"></i>
															<i class="fa fa-star" aria-hidden="true"></i>

														</div>
														<div class="radio-review">
															<input class="color1" type="radio" name="rate" value="5">
															<i class="fa fa-star" aria-hidden="true"></i>
															<i class="fa fa-star" aria-hidden="true"></i>
															<i class="fa fa-star" aria-hidden="true"></i>
															<i class="fa fa-star" aria-hidden="true"></i>
															<i class="fa fa-star" aria-hidden="true"></i>
														</div>
													</div>
												</div>
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
															<input type="text" id="var_name" name="var_name" required="" placeholder="Name*">
														</div>
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
															<input type="email" id="var_email" name="var_email" required="" placeholder="Email*">
														</div>
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
															<textarea id="message" name="message" placeholder="Your Review..."></textarea>
														</div>
													</div>
													<button type="submit" name="submit" class="color1_bg tran3s btn btn-primary">Add Review</button>
												</form>

									      </div> <!-- End of .add_your_review -->
									      
									    </div> <!-- End of #tab2 -->
									 </div> <!-- End of .tab-content -->
								</div> <!-- End of .product-review-tab -->

							<?php } ?>
							
	        				</div> <!-- End of .wrapper -->
	        			</div> <!-- End of .col -->


	        		</div> <!-- End of .row -->
	        	</div> <!-- End of .container -->
	        </div> <!-- End of .shop_single_page -->

<script>
	var sitepath = '<?php echo base_url(); ?>';
	$( document ).ready(function() {

    $('#submitpin').click(function(){                   
        if( $("#pincode").val().length == 0) {
            $('#abl').replaceWith('<span class="float_left color1" id="abl">Product is Availabe in this area.</span>');
        }
        else {
        	var pincode = $("#pincode").val();
        	var fk_product = $("#fk_product").val();
        	// alert(pincode);alert(fk_product);

            $.ajax({
		        type: "POST",
		        url: sitepath + "product/check_pincode", 
		        data: "pincode=" + pincode +"&fk_product=" + fk_product,
		        success: function (response) {
		        	if(response == pincode){
		        		$('#abl').replaceWith('<span class="float_left color1" id="abl">Product is Availabe in this area.</span>');
		        	} else {
		        		$('#abl').replaceWith('<span class="float_left color1" id="abl">Product is not Availabe in this area.</span>');
		        	}
	            
		        }
		    });
        }
    });

});




              
              function add_to_cart1(){
                $(".page_loader").css("display", "block");
                $(".page_loader_container").css("display", "block");
                var qty = $('#quantity_wanted').val();
                var qid = $('#fk_price').val();
                var pid = $('#product_id').val();
                var offer = $('#var_offer').val();
                
                $.ajax({

                  url: '<?= base_url() ?>cart/add_to_cart',
                  type: 'post',
                  data: 'qid='+qid+'&qty='+qty+'&pid='+pid+'&offer='+offer,
                  
                  success: function(response){ 
                  	if(response == ""){
                      alert("out of stock");
                      //location.reload();
                    } else {
                    $(".page_loader").css("display", "none");
                    $(".page_loader_container").css("display", "none");
                    //$('#cart_body').replaceWith(response);
                    location.reload();
                	}
                    // location.reload();
                  }
                });
                
              }
              
              function select_quantity(qid){
                var qty = $('#quantity_wanted').val();
                var offer = $('#var_offer').val();
                $.ajax({

                  url: '<?= base_url() ?>product/get_price',
                  type: 'post',
                  data: 'qid='+qid+'&qty='+qty+'&offer='+offer,
                  
                  success: function(response){
                    $('#product_price').replaceWith('<span itemprop="price" id="product_price">&#x20b9;'+response+'</span>');
                    document.getElementById('var_price').value = response;
                  }
                });
              }
              
              function set_qty(){
                
                var qty = $('#quantity_wanted').val();
                var qid = $('#fk_price').val();

                select_quantity(qid);
                
              }
              
              
              
              $(".ddd").on("click", function () {

                var $button = $(this);
                var oldValue = $("#quantity_wanted").val();

                if ($button.text() == "+") {
                  var newVal = parseFloat(oldValue) + 1;
                } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
              var newVal = parseFloat(oldValue) - 1;
            } else {
              newVal = 0;
            }
          }
          if (newVal != 0) {
            $("#add_to_cart").removeAttr("disabled");
          } else {
            $("#add_to_cart").attr("disabled", "disabled");
          }      
          $("#quantity_wanted").val(newVal);
          set_qty();
        });
      </script>
