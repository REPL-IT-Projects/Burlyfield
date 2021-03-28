<section class="breadcrumb-area" style="background-image:url(<?php echo base_url(); ?>public/front_assets/images/background/19Checkout.jpg);">
			    <!-- <div class="container">
			        <div class="row">
			            <div class="col-md-12">
			                <div class="breadcrumbs text-center">
			                    <h1>checkout</h1>
			                    <h4>Welcome to certified Burly Feild</h4>
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
				                    <li>checkout</li> 
				                </ul>
				            </div>
				            <div class="col-lg-4 col-md-7 col-sm-7">
				                <p>We provide <span>100% organic</span> products</p>
				            </div>
				        </div>
				    </div>
				</div> -->
			    
			</section>


	        <!-- Checkout page content******************* -->
	        <div class="check_out_form container">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 submit_form">
						<div class="theme-title">
							<h2>Billing Address</h2>
						</div>
						<form class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<span>Country *</span>
								<input type="text"  value="<?php echo $address[0]['var_country'];?>">
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<span>Full Name *</span>
								<input type="text" value="<?php echo $data['var_name'];?>"  placeholder="">
							</div>
							
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<span>Address</span>
								<?php if($address[0]['var_house_no']!= "" && $address[0]['var_app_name']!= "" && $address[0]['var_landmark']!= ""){ ?>
								<input type="text"  value="<?php echo $address[0]['var_house_no'].', '.$address[0]['var_app_name'].', '.$address[0]['var_landmark'];?>" placeholder="">
							<?php } else { ?>
								<input type="text"  value="" placeholder="">
							<?php } ?>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<span>Town / City *</span>
								<input type="text" placeholder="" value="<?php echo $address[0]['var_city'];?>">
							</div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <span>Pincode *</span>
                <input type="text" placeholder="" value="<?php echo $address[0]['var_pincode'];?>">
              </div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<span>Contact Info *</span>
								<input type="email" value="<?php echo $data['var_email'];?>" placeholder="Email Address">
								<input type="text" value="<?php echo $data['var_mobile_no'];?>" placeholder="Phone Number">
							</div>
						</form>
					</div> <!-- /submit_form -->

					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 submit_form shipping_address">
						<div class="theme-title">
							<h2>Shipping Address <input type="checkbox"></h2>
						</div>
						<form method="POST" id="place_order" action=""  enctype='multipart/form-data' class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<span>Country *</span>
								<input type="text" value="<?php echo $address[0]['var_country'];?>" name="var_country" required>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<span>First Name *</span>
								<input type="text" value="<?php echo $data['var_name'];?>" placeholder="" name="var_name" required>
							</div>
							
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<span>Address</span>
								<?php if($address[0]['var_house_no']!= "" && $address[0]['var_app_name']!= "" && $address[0]['var_landmark']!= ""){ ?>
								<input type="text" value="<?php echo $address[0]['var_house_no'].', '.$address[0]['var_app_name'].', '.$address[0]['var_landmark'];?>" required placeholder="" name="var_address">
								<?php } else { ?>
								<input type="text"  value="" required placeholder="" name="var_address">
							<?php } ?>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<span>Town / City *</span>
								<input type="text" placeholder="" required value="<?php echo $address[0]['var_city'];?>" name="var_city">
							</div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <span>Pincode *</span>
                <input type="text" placeholder="" required value="<?php echo $address[0]['var_pincode'];?>" name="var_pincode">
              </div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<span>Other Notes</span>
								<textarea></textarea>
							</div>
						
					</div> <!-- /submit_form -->
					
				</div> <!-- /row -->
			</div> <!-- /check_out_form -->




			<!-- cart table*********************** -->
			<div class="cart_table container">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="table-responsive">
							<table class="table table-1">
								<thead>
									<tr>
										<th><span>Product</span></th>
										<th style="padding-left:0"><span>Quantity</span></th>
										<th><span style="margin-left: 9px;">Total</span></th>
										<!-- <th><span style="margin-left: 5px;">GST</span></th>
										<th><span style="margin-left: 5px;">Subtotal</span></th> -->
									</tr>
								</thead> <!-- /thead -->
								<tbody>
                                    <?php $grand_total = 0;
                                      $total_final_amt = 0;
                                      $final_grand_total = 0;
                                      if (isset($_SESSION['cart_item'])) {
                                       foreach ($_SESSION['cart_item'] as $ckey => $cval) { 
                                       		$total = $cval['price']*$cval['quantity'];
                    //                    		$g = $cval['gst'] + 100;
								            // $total = ($tl*100)/$g;
                                       	?>
									<tr>
										<td class="flex_item clear_fix">
											<img src="<?php echo $cval['image']; ?>" style="width: 70px;height: 80px;" alt="images" class="float_left">
											<h6 class="float_left"><?php echo $cval['title']; ?></h6>
										</td>
										<td><input type="number" name="quantity" disabled value="<?php echo $cval['quantity']; ?>"></td>
										<td style="padding-top: 62px;">&#x20b9; <?php echo $total; ?></td>
										<!-- <td style="padding-top: 62px;"><?php echo $cval['gst']; ?> %</td> -->
										<!-- <td><span class="color2">&#x20b9; <?php echo $total; ?></span></td> -->
									</tr> <!-- /tr -->
                                    <?php
                                          $grand_total = $grand_total + $cval['grand_total']; 
                                          $final_grand_total += $cval['price'] * $cval['quantity'];
                        
                                          $total_final_amt = $total + $total_final_amt;
                                        } } 
                                          
                                          
                                          ?>
									

								</tbody> <!-- /tbody -->
							</table>
						</div> <!-- /table-responsive -->
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<h4>Cart Totals</h4>
						<div class="table-responsive">
							<table class="table table-2">
								<tbody>
									<tr>
										<td><span>Cart Subtotal</span></td>
										<td><span>&#x20b9; <?php echo $total_final_amt;?></span></td>
									</tr>
                  <tr>
                    <?php 
                      if (isset($_SESSION['promocode_amout'])) {
                         
                              $cashback = $_SESSION['promocode_amout'];
                              $promocode = $_SESSION['promocode'];
                         
                      } else {
                        $cashback = '0';
                        $promocode = '';
                      }
                      
                      // $final_grand_total += 50;
                      ?>
                    <td><span>Promocode Value</span></td>
                    <td><span>&#x20b9; <?php echo $cashback; ?></span>
                      <input type="hidden" name="get_cashback" id="get_cashback" value="<?php echo $cashback; ?>">
                      <input type="hidden" name="get_promocode" id="get_promocode" value="<?php echo $promocode; ?>">
                    </td>
                  </tr>
									<tr>
										<td><span>Shipping and Handling</span></td>
										<td><span><?php //$charge = $this->db->get('mst_delivery_charges')->row_array(); 
                                if($delivery_charge[0]['var_below'] < $total_final_amt){
                                    echo "Free Shipping";
                                    $dc = 0;
                                    $final_grand_total = $total_final_amt - $cashback;
                                } else {
                                    echo $delivery_charge[0]['var_charges'];
                                    $final_grand_total = $delivery_charge[0]['var_charges'] + $total_final_amt;
                                    $final_grand_total = $final_grand_total - $cashback;
                                    $dc = $delivery_charge[0]['var_charges'];
                                }?></span></td>
                                <input type="hidden" name="get_delivery_charges" id="get_delivery_charges" value="<?php echo $dc; ?>">
									</tr>
									<tr>
										<td><span>Order Total</span></td>
										<td><span>&#x20b9; <?php echo $final_grand_total;?></span></td>
									</tr>
								</tbody>
							</table>
						</div> <!-- /table-responsive -->
						<div class="payment_system">
							
							<div class="pay1">
								<input type="radio" name='var_payment_mode[]' value="Net Banking">
								<span>Net Banking</span>
							</div>
							<div class="pay1">
								<input type="radio" name='var_payment_mode[]' value="Credit Card">
								<span>Credit Card</span>
								<img src="<?php echo base_url(); ?>public/front_assets/images/check-out/1.jpg" alt="image" class="float_right">
							</div>
							<div class="pay1">
								<input type="radio" name='var_payment_mode[]' value="Debit Card">
								<span>Debit Card</span>
								<!-- <img src="<?php echo base_url(); ?>public/front_assets/images/check-out/1.jpg" alt="image" class="float_right"> -->
							</div>
              <input type="hidden" name="minimum_amount" id="minimum_amount" value="<?php echo $minimum_order;?>">
              <input type="hidden" name="total_amount" id="total_amount" value="<?php echo $total_final_amt ;?>">
              <input type="hidden" name="default_no" id="default_no" value="<?php echo $data['var_default_no']; ?>">
              <input type="hidden" name="address_type" id="address_type" value="<?php echo $address[0]['chr_type']; ?>">
              <input type="hidden" name="payble_amount" id="payble_amount" value="<?php echo $final_grand_total; ?>">
							<input type="submit" name="submit"  class="tran3s color2_bg float_right checkout-order-button" value="Place Order">
						</div>
            </form>
					</div>
				</div>
			</div> <!-- /cart_table -->
			
<script>
    var site_path = '<?php echo base_url();?>';
    
  </script>
<script type="text/javascript">
    $( document ).ready(function() {  
     $("form#place_order").submit(function() {
  
   $(".loading").show();

   var total_amount = $('#total_amount').val();
   var var_payment_mode = $("input[name='var_payment_mode']:checked").val();
   var default_no = $('#default_no').val();
   // var delivery_time = $("input[name='delivery_timeslot']:checked").val();
   var delivery_charge = $("#get_delivery_charges").val();
   var address_type = $("#address_type").val();
   var payble_amount = $('#payble_amount').val();
   var var_cashback = $('#get_cashback').val();
   var var_promocode = $('#get_promocode').val();
   var user_wallet = $('#user_walllet').val();

   $.ajax({
    url: site_path + "cart/place_order/add_user_order",
    type: 'POST',
    data: {total_amount:total_amount,var_payment_mode:var_payment_mode,default_no:default_no,address_type:address_type,payble_amount:payble_amount,var_cashback:var_cashback,var_promocode:var_promocode,delivery_charge:delivery_charge,user_wallet:user_wallet},
    success: function(response) {
         // alert (response);     
          window.location.href = site_path +'order_success';      
        },
      });
      return false;
    // }
  });
});
</script>