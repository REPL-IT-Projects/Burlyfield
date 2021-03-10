

<section class="breadcrumb-area" style="background-image:url(<?php echo base_url(); ?>public/front_assets/images/background/2.jpg);">
			    <div class="container">
			        <div class="row">
			            <div class="col-md-12">
			                <div class="breadcrumbs text-center">
			                    <h1>Shopping Cart</h1>
			                    <h4>Welcome to certified online organic products suppliersr</h4>
			                </div>
			            </div>
			        </div>
			    </div>
				<div class="breadcrumb-bottom-area">
				    <div class="container">
				        <div class="row">
				            <div class="col-lg-8 col-md-5 col-sm-5">
				                <ul>
				                    <li><a href="#">Home</a></li>
				                    <li><a href=""><i class="fa fa-angle-right"></i></a></li>
				                    <li><a href="#">Gallery</a></li>
				                    <li><a href=""><i class="fa fa-angle-right"></i></a></li>
				                    <li>Shopping Cart</li> 
				                </ul>
				            </div>
				            <div class="col-lg-4 col-md-7 col-sm-7">
				                <p>We provide <span>100% organic</span> products</p>
				            </div>
				        </div>
				    </div>
				</div>
			    
			</section>
<?php //echo '<pre>';print_r($_SESSION);?>
<section>
 <div class="cartPage">
  <div class="container">
   <div class="cart-grid row">
    <!-- Left Block: cart product informations & shpping -->
    <div class="cart-grid-body col-xs-12 col-lg-8">
     <!-- cart products detailed -->
     <div class="card cart-container">
      <div class="card-block">
       <h1 class="h1">Shopping Cart</h1>
     </div>
     <hr>
     <div class="cart-overview js-cart">
      <ul class="cart-items">

       <?php $grand_total = 0;
       if(isset($_SESSION["cart_item"])){

        foreach($_SESSION["cart_item"] as $key => $row){
         ?>
         <li class="cart-item" id="li<?php echo $row['int_glcode'];?>">
           <div class="product-line-grid">
            <!--  product left content: image-->
            <div class="product-line-grid-left col-md-3 col-xs-4">
             <span class="product-image media-middle">
              <img src="<?php echo $row['image'];?>" alt="<?php echo $row['title'];?>">
            </span>
          </div>
          <!--  product left body: description -->
          <div class="product-line-grid-body col-md-4 col-xs-8">
           <div class="product-line-info">
            <a class="label" href="<?php echo base_url().'product/detail/'.base64_encode($row['int_glcode']);?>" data-id_customization="0"><?php echo $row['title'];?></a>
          </div>
          <div class="product-line-info">
            <?php if ($row['offer'] != '0') { ?>
              <span class="regular-price">&#x20b9;<?php echo $row['price'];?></span>
            <?php } ?>
            <span class="value">&#x20b9;<?php echo $row['dis_price'];?></span>
          </div>
          <br>

          <div class="product-line-info">
            <span class="label">Weigth:</span>
            <span class="value"><?php echo $row['weigth'];?></span>
          </div>
        </div>
        <!--  product left body: description -->
        <div class="product-line-grid-right product-line-actions col-md-5 col-xs-12">
         <div class="row">
          <div class="col-xs-4 hidden-md-up"></div>
          <div class="col-md-10 col-xs-6">
           <div class="row">
            <div class="col-md-6 col-xs-6 qty">
              <div class="input-group bootstrap-touchspin product_content" id="field<?php echo $key;?>"><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span>
               <input type="hidden" name="product_id" class="prodcode" value="<?php echo $row['int_glcode'];?>">
               <input type="hidden" name="weight" value="<?php echo $row['weigth'];?>">
               <input class="js-cart-line-product-quantity form-control quantity_wanted" id="<?php echo $key;?>" class="field" data-down-url="" data-up-url="" data-update-url="" data-product-id="" type="number" value="<?php echo $row['quantity'];?>" name="product-quantity-spin" min="1" pattern="[0-9]*" style="display: block;">
             </div>
           </div>
           <?php
           $total = $row['dis_price'] * $row['quantity'];?>
           <div class="col-md-6 col-xs-6 price">
             <span class="product-price">
               <strong>
                 <span id="ptotal<?php echo $row['int_glcode'];?>">&#x20b9;<?php echo $total;?></span>
               </strong>
             </span>
           </div>
         </div>
       </div>
       <div class="col-md-2 col-xs-2 text-xs-right">
         <div class="cart-line-product-actions">
          <a class="remove-from-cart" rel="nofollow" href="javascript:;" onclick="delete_to_cart('<?php echo $row['int_glcode'];?>','<?php echo $row['weigth'];?>')">
            <i class="fa fa-trash pull-xs-left"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
</div>
</li>
<?php $grand_total = $total + $grand_total; }}else{ 

  ?>
  <span>Cart Empty</span>
<?php } ?>

</ul>
</div>
</div>
<a class="label" href="<?php echo base_url();?>product">
 <i class="fa fa-chevron-left"></i> Continue shopping
</a>
<!-- shipping informations -->
</div>
<!-- Right Block: cart subtotal & cart total -->
<?php if(isset($_SESSION["cart_item"])){ ?>
  <div class="cart-grid-right col-xs-12 col-lg-4">
   <div class="card cart-summary">
    <div class="cart-detailed-totals">
     <div class="card-block">
      <div class="cart-summary-line" id="cart-subtotal-products">
       <span class="label js-subtotal" id="items_count">
         <?php echo count($_SESSION["cart_item"]);?> items
       </span>
       <span class="value" id="items_cart">&#x20b9;<?php echo $grand_total;?></span>
     </div>
                    <!-- <div class="cart-summary-line" id="cart-subtotal-shipping">
                       <span class="label">
                       Shipping
                       </span>
                       <span class="value">FREE</span>
                       <div><small class="value"></small></div>
                     </div>-->
                   </div>
                   <hr>
                   <div class="card-block">
                    <div class="cart-summary-line cart-total">
                     <span class="label">Total </span>
                     <span class="value" id="items_total">&#x20b9;<?php echo $grand_total;?></span>
                   </div>
                    <!-- <div class="cart-summary-line">
                       <small class="label">Taxes</small>
                       <small class="value">$0.00</small>
                     </div>-->
                   </div>
                   <hr>
                 </div>
                 <div class="checkout cart-detailed-actions card-block">
                   <div class="text-xs-center">
                    <a href="<?php echo base_url();?>cart/checkout" class="btn btn-primary">Proceed to Checkout</a>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </section>

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

       var res = response.split('***');
       $('#cart_body').replaceWith(res[0]);
       $('#items_total').replaceWith('<span class="value" id="items_total">&#x20b9;'+res[1]+'</span>');
       $('#items_cart').replaceWith('<span class="value" id="items_cart">&#x20b9;'+res[1]+'</span>');
       $('#items_count').replaceWith('<span class="label js-subtotal" id="items_count">'+res[2]+' items</span>');
       $('#ptotal'+product_id).replaceWith('<span id="ptotal'+product_id+'">&#x20b9;'+res[3]+'</span>');
     }
   });
   });
 </script>