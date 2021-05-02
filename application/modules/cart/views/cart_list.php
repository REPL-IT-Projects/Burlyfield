<section class="breadcrumb-area" style="background-image:url(<?php echo base_url(); ?>public/front_assets/images/background/16shoppingCart.jpg);">
			    
			    
			</section>


<!-- cart Table*************************** -->
<div class="cart">
	        <div class="shop_cart_table container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="table-responsive">
							<table class="table table-1">
								<tr>
									<th><span>Product</span></th>
									<th><span>Quantity</span></th>
									<th><span>Price</span></th>
									<th><span>Total</span></th>
									<!-- <th><span>GST</span></th> -->
									<!-- <th><span>Subtotal</span></th> -->
									<th><span>Remove</span></th>
								</tr>
                                    <?php $final_grand_total = 0;
                                       if(isset($_SESSION["cart_item"])){
                                
                                        foreach($_SESSION["cart_item"] as $key => $row){
                                         ?>
									<tr id="li<?php echo $row['int_glcode'];?>">
										<td class="flex_item clear_fix">
											<img src="<?php echo $row['image'];?>" alt="<?php echo $row['title'];?>" style="height: 80px;" class="float_left">
											<h6 class="float_left"><?php echo $row['title'];?></h6>
										</td>
										<td>
										    <div class="input-group product_content" id="field<?php echo $key;?>"><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span>
										    <input type="hidden" name="product_id" class="prodcode" value="<?php echo $row['int_glcode'];?>">
                                            <input type="hidden" name="weight" value="<?php echo $row['weigth'];?>">
										    <input  id="<?php echo $key;?>" class="field quantity_wanted js-cart-line-product-quantity form-control" data-down-url="" data-up-url="" data-update-url="" data-product-id="" type="number" value="<?php echo $row['quantity'];?>" name="product-quantity-spin" min="1" pattern="[0-9]*" style="display: block;">
										    </div>
										</td>
										
										<td style="line-height: 125px"><span class="value">&#x20b9; <?php echo $row['price'];?></span></td>										
										<?php $total = $row['price'] * $row['quantity'];
												// $g = $row['gst'] + 100;
								    // $total = ($tl*100)/$g;
								                
								                // $GST = ($tl*$row['gst'])/100;
								                // $total = $tl + $GST;
								                ?>
										<td><span class="value color2" id="ptotal<?php echo $row['int_glcode'];?>"><b>&#x20b9;<?php echo $total;?></b></span></td>
										<!-- <td><span class="value"><?php echo $row['gst'];?> %</span></td> -->
										<!-- <td><span  id="sub_total" class="value">&#x20b9; <?php echo $total;?></span></td> -->
										<td><a class="remove-from-cart" rel="nofollow" href="javascript:;" onclick="delete_to_cart('<?php echo $row['int_glcode'];?>','<?php echo $row['weigth'];?>')">
                                            <i class="fa fa-trash pull-xs-left"></i>
                                          </a></td>
									</tr> <!-- /tr -->
                                    <?php $final_grand_total = $final_grand_total + $total;}}?>
									

							</table>
						</div> <!-- /table-responsive -->
					</div>
					<div sty id="msgPromocode_modal"></div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 d-flex-class margin-bottom-30">
						
						<form method="post" id="apply_promocode" action="javascript:;">
            			<input type="hidden" name="fk_user_promo" id="fk_user_promo" value="<?php echo $data['int_glcode']; ?>">
            			<?php 
				          if (isset($_SESSION['promocode_amout'])) {
				            $promocode = $_SESSION['promocode'];
				          } else {
				            $promocode = '';
				          }
				          ?>
						<input type="text" name="var_promocode" id="var_promocode" class="coupon" required="" placeholder="Enter Promocode" value="<?php echo $promocode; ?>">

						<input type="hidden" name="payble_amount" id="payble_amount" value="<?php echo $final_grand_total; ?>">
          				<input type="hidden" name="promocode_val" id="promocode_val" value="<?php echo $promocode; ?>">
						<button type="submit" class="btn btn-primary">Apply Coupon</button>
						</form><br>
						
					</div>
					<!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 cart_update" style="text-align:right;">
						<button class="btn cart_btn3 tran3s changepassword-button">Update Cart</button>
						<a href="<?php echo base_url();?>cart/checkout" class="btn btn-primary">Proceed to Checkout</a>
					</div> -->
				</div> <!-- /row -->

				<div class="row shipping_address">
				
					
					<div class="col-lg-6 col-md-6 col-sm-7 col-xs-12 wow fadeInUp">
						<h4>Cart Totals</h4>
						<div class="table-responsive">
							<table class="table table-2">
								<tbody>
									<tr>
										<td><span>Cart Subtotal</span></td>
										<td id="cart-subtotal-products">
										    
										    <span id="items_cart">&#x20b9; <?php echo $final_grand_total; ?></span></td>
										
									</tr>
									<tr>
										<td><span>Total Items</span></td>
										<td><span id="items_count">
                                                 <?php echo count($_SESSION["cart_item"]);?> Items
                                               </span>
										</td>
									</tr>
									<tr>
										
										<td><span>Shipping and Handling</span></td>
										<td><span id="spcharge">
										<?php $charge = $this->db->get('mst_delivery_charges')->row_array(); 
								                if(count($_SESSION["cart_item"]) == 0){
								                	echo 0;
								                }else if($charge['var_below'] < $final_grand_total){
								                    echo "Free Shipping";
								                    $final_grand_total = $final_grand_total;
								                } else {
								                    echo $charge['var_charges'];
								                    $final_grand_total = $charge['var_charges'] + $final_grand_total;
								                }?>

										</span></td>
									</tr>
									<tr>
										<td><span>Order Total</span></td>
										<td><span id="items_total">&#x20b9; <?php echo $final_grand_total; ?></span></td>
									</tr>
								</tbody>
							</table>
						</div> <!-- /table-responsive -->
					<?php  if(isset($_SESSION['fk_user'])){ if(empty($_SESSION["cart_item"])){ 
						echo '<a href="javascript:;" class="btn btn-primary margin-bottom-30">Proceed to Checkout</a>';
					 } else { ?>
						<a href="<?php echo base_url();?>cart/checkout" class="btn btn-primary margin-bottom-30">Proceed to Checkout</a>
					<?php  }} else { ?>
						<a href="javascript:;" data-toggle="modal" data-target="#wantDonate" class="btn btn-primary margin-bottom-30">Proceed to Checkout</a>
						
					<?php } ?>
					&nbsp;<a href="<?php echo base_url();?>product" class="btn btn-primary margin-bottom-30">Continue shopping</a>
					</div>
				</div>
			</div> <!-- /cart_table -->
		</div>
	<script>

    function select_quantity(qid){
        
      var qty = $('#quantity_wanted').val();
      $.ajax({

        url: '<?= base_url() ?>cart/get_price',
        type: 'post',
        data: 'qid='+qid+'&qty='+qty,

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


    $(document).on("change", ".quantity_wanted", function() {
    
     var quantity = parseInt($(this).val());
     var product_id = $(this).closest("div.product_content").find("input[name='product_id']").val();
     var weight = $(this).closest("div.product_content").find("input[name='weight']").val();
    
     $.ajax({
      url: "<?= base_url() ?>cart/update_cart",
      type: "POST",
      data: "quantity="+quantity+"&product_id="+product_id+"&weight="+weight,
      success: function(response) {
      	if(response == ""){
      		alert("Out of Stock");
      	} else {
       var res = response.split('***');
       $('#cart_body').replaceWith(res[0]);
       if(res[4] == "Free Shipping"){
       	  $('#items_total').replaceWith('<span class="value color2" id="items_total">&#x20b9; '+res[1]+'</span>');
       } else {
       	  $('#items_total').replaceWith('<span class="value color2" id="items_total">&#x20b9; '+res[5]+'</span>');
       }
       $('#items_cart').replaceWith('<span class="value" id="items_cart">&#x20b9; '+res[1]+'</span>');
       $('#spcharge').replaceWith('<span class="value" id="spcharge">'+res[4]+'</span>');
       $('#items_count').replaceWith('<span class="value" id="items_count">'+res[2]+' items</span>');
       $('#ptotal'+product_id).replaceWith('<span class="value color2" id="ptotal'+product_id+'">&#x20b9; '+res[3]+'</span>');
     } }
   });
   });

    $("form#apply_promocode").submit(function() {
   
    var var_promo = $('#var_promocode').val();
    // var fk_user = $('#fk_user').val();

    if (var_promo == '') {
      var msg = 'Please enter Valid Promocode !';
      var msgClasses = "h3 text-center tada animated text-danger";
      $("#msgPromocode_modal").removeClass().addClass(msgClasses).text(msg);
    } else {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?= base_url() ?>user/verify_promocode",
            type: 'POST',
            data: formData,
            async: false,
            success: function(response) {
            	var arr = $.parseJSON(response);
              	var status = arr.status;
                var msg = arr.message;
              
                if (status == '1') {
                    var msgClasses = "h3 text-left tada animated text-danger";
                    $("#msgPromocode_modal").removeClass().addClass(msgClasses).text(msg);
                    //window.location.reload();
                    return false;
                } else if (status == '2') {
                    var msgClasses = "h3 text-left tada animated text-danger";
                    $("#msgPromocode_modal").removeClass().addClass(msgClasses).text(msg);
                    return false;
                } else if (status == '3') {
                    var msgClasses = "h3 text-left tada animated text-danger";
                    $("#msgPromocode_modal").removeClass().addClass(msgClasses).text(msg);
                    return false;
                } else if (status == '4') {
                    var msgClasses = "h3 text-left tada animated text-danger";
                    $("#msgPromocode_modal").removeClass().addClass(msgClasses).text(msg);
                    return false;
                } else {
                  var msgClasses = "h3 text-left tada animated text-success";
                  $("#msgPromocode_modal").removeClass().addClass(msgClasses).text(msg);

                  var payble_amt = $('#payble_amount').val();
                  var promocode = arr.promocode;
                  var cashback = arr.discount_price;

                $('#show_cashback').html('&#x20b9; '+ cashback);
                $('#get_cashback').val(cashback);
	    		      $('#get_promocode').val(promocode);

	    		setTimeout(function() {$('#promocodeModal').modal('hide');}, 3000);
	    		setTimeout(function() {$('#msgPromocode_modal').modal('hide');}, 3000);
                  //window.location.href = site_path + 'cart/checkout';
                }
            },

            cache: false,
            contentType: false,
            processData: false

        });
    }
});
 </script>