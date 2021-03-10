<div class="innovatoryBreadcrumb"><div class="container">
  <nav data-depth="2" class="breadcrumb hidden-sm-down">
    <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
      <li itemprop="itemListElement" itemscope="" >
        <a itemprop="item" href="<?php echo base_url();?>">
          <span itemprop="name">Home</span>
        </a>
        <meta itemprop="position" content="1">
      </li>
      <li itemprop="itemListElement">
        <a itemprop="item" href="<?php echo base_url();?>product">
          <span itemprop="name">Product</span>
        </a>
        <meta itemprop="position" content="2">
      </li>
      <li itemprop="itemListElement">
        <a itemprop="item" href="javascript:;">
          <span itemprop="name">Details Page</span>
        </a>
        <meta itemprop="position" content="2">
      </li>
    </ol>
  </nav>
</div>
</div>

<section id="wrapper">
 <aside id="notifications">
  <div class="container">
  </div>
</aside>
<div class="container">
  <div class="row">
   <div id="left-column" class="col-xs-12 col-sm-4 col-md-3">
    <div class="it_new_product product-column-style" data-items="1" data-speed="1000" data-autoplay="0"   data-time="3000"  data-arrow="0" data-pagination="0" data-move="1" data-pausehover="0" data-lg="1" data-md="1" data-sm="1" data-xs="1" data-xxs="1">
     <div class="itProductList itcolumn">
      <div class="title_block">
       <h3><a href="">New products</a></h3>
     </div>
     <div class="block-content">
       <div class="itProductFilter row">
         <?php foreach($new_product as $row11){ ?>
           <div class="row border-bottom-right">
             <div class="col-md-12 col-sm-12 col-lg-6 col-xs-6">
              <div class="product-right-images">
               <a href="<?php echo base_url().'product/detail/'.base64_encode($row11['int_glcode']);?>">
                 <img src="<?php echo base_url().'uploads/products/'.$row11['var_image'];?>" >
               </a>
             </div>
           </div>
           <?php 
           if($row11['var_offer'] == '0'){
            $price = $row11['var_price'];
            $discount_price = '';
          }else{ 
            $price = $row11['var_discount_price'];
            $discount_price = $row11['var_price'];
          }
          ?>
          <div class="col-md-12 col-sm-12 col-lg-6 col-xs-6">
            <div class="product-images-content-box">
             <h6><a href="<?php echo base_url().'product/detail/'.base64_encode($row11['int_glcode']);?>"><?php echo $row11['var_title'];?></a></h6>
             <div class="innovatory-product-price-and-shipping">
              <span itemprop="price" class="price">&#x20b9;<?php echo $price;?></span>
              <?php if($row11['var_offer'] != '0'){ ?>
                <span class="reduction_percent_display"><?php echo $row11['var_offer'];?>%</span>
                <span class="regular-price">&#x20b9;<?php echo $discount_price;?></span>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>   
    <?php } ?>
  </div>
</div>
</div>
</div>

<div class="it-special-products product-column-style" data-items="1" data-speed="1000" data-autoplay="0" data-time="3000"  data-arrow="0" data-pagination="0" data-move="1" data-pausehover="0" data-md="1" data-sm="1" data-xs="1" data-xxs="1">
 <div class="itProductList itcolumn">
  <div class="title_block">
   <h3>Special Product</span></h3>
 </div>
 <div class="block-content">
   <div class="itProductFilter row">
    
     <?php foreach($top_product as $rwr){ ?>
       <div class="row border-bottom-right">
        <div class="col-md-12 col-sm-12 col-lg-6 col-xs-6">
         <div class="product-right-images">
           <a href="<?php echo base_url().'product/detail/'.base64_encode($rwr['int_glcode']);?>">
             <img src="<?php echo base_url().'uploads/products/'.$rwr['var_image'];?>" >
           </a>
         </div>
       </div>
       <?php 
       if($rwr['var_offer'] == '0'){
        $price = $rwr['var_price'];
        $discount_price = '';
      }else{ 
        $price = $rwr['var_discount_price'];
        $discount_price = $rwr['var_price'];
      }
      ?>
      <div class="col-md-12 col-sm-12 col-lg-6 col-xs-6">
       <div class="product-images-content-box">
        <h6><a href="<?php echo base_url().'product/detail/'.base64_encode($rwr['int_glcode']);?>"><?php echo $rwr['var_title'];?></a></h6>
        <div class="innovatory-product-price-and-shipping">
         <span itemprop="price" class="price">&#x20b9;<?php echo $price;?></span>
         <?php if($rwr['var_offer'] != '0'){ ?>
           <span class="reduction_percent_display"><?php echo $rwr['var_offer'];?>%</span>
           <span class="regular-price">&#x20b9;<?php echo $discount_price;?></span>
         <?php } ?>
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
<div id="content-wrapper" class="left-column col-xs-12 col-sm-8 col-md-9">
  <section id="main">
   <meta itemprop="url" content="">
   <div class="innovatoryProduct">
     <div class="row">
      <div class="col-md-6">
        <?php $images = $this->common_model->get_product_img($product['int_glcode']);?>
        <div class="shop-detail-left">
         <div class="shop-detail-slider">
           
           <?php if($product['var_offer'] != '0'){ ?>
            <div class="favourite-icon">
             <a href="javascript:;" class="fav-btn-present"><span><?php echo $product['var_offer'];?>%</span></a>
           </div>
         <?php } ?>
         
         <div id="sync1" class="owl-carousel sync-slider-one">
           <?php foreach($images as $row3){ ?>
             <div class="item"><img alt="" src="<?php echo base_url().'uploads/products/'.$row3['var_images'];?>" class="img-fluid img-center"></div>
           <?php } ?>
           
         </div>
         <div id="sync2" class="owl-carousel owl-carousel-border">
           <?php foreach($images as $row3){ ?>
             <div class="item"><img alt="" src="<?php echo base_url().'uploads/products/'.$row3['var_images'];?>" class="img-fluid img-center"></div>
           <?php } ?>
           
         </div>
       </div>
     </div>
   </div>

   <?php $prices = $this->common_model->get_product_price($product['int_glcode']);
   
   if($product['var_offer'] == '0'){
    $price = $prices[0]['var_price'];
    $discount_price = '';
  }else{ 
    $price = $prices[0]['var_discount_price'];
    $discount_price = $prices[0]['var_price'];
  }
  ?>
  <div class="col-md-6">
    <h1 class="h1" itemprop="name"><?php echo $product['var_title'];?></h1>
    
    <div class="product-prices">
     <div class="product-price h5 has-discount" itemprop="offers" itemscope="" itemtype="https://schema.org/Offer">
      <link itemprop="availability" href="https://schema.org/InStock">
      <meta itemprop="priceCurrency" content="USD">
      <div class="current-price">
        <span itemprop="price" id="product_price" content="<?php echo $price;?>">&#x20b9;<?php echo $price;?></span>
        <input type="hidden" id="var_price" name="var_price" value="<?php echo $price;?>">
        <input type="hidden" id="var_offer" name="var_offer" value="<?php echo $product['var_offer'];?>">
        <input type="hidden" id="product_id" name="product_id" value="<?php echo $product['int_glcode'];?>">
      </div>
      <?php if($product['var_offer'] != '0'){ ?>
        <div class="product-discount">
          <span class="discount discount-percentage">Save <?php echo $product['var_offer'];?>%</span>
          <span class="regular-price">&#x20b9;<?php echo $discount_price;?></span>
        </div>
      <?php } ?>
    </div>
    <div class="tax-shipping-delivery-label">
    </div>
  </div>
  <div class="product-description-short" id="product-description-short-29" itemprop="description">
   <p><?php echo $product['txt_description'];?></p>
 </div>
 <div class="product-information">
   <div class="product-actions">
    
     <div class="product-variants">

      <div class="clearfix product-variants-item">
       <span class="control-label">Weight</span>
       <select id="fk_price" name="fk_price" onchange="select_quantity(this.value)">
         <?php foreach($prices as $row2){ ?>
          <option value="<?php echo $row2['int_glcode'];?>"><?php echo $row2['var_quantity'];?></option>
        <?php } ?>
        
      </select>
    </div>
  </div>
  <section class="product-discounts">
  </section>
  <div class="product-add-to-cart">
    <span class="control-label">Quantity</span>
    <div class="product-quantity">
     
     <div class="qty">
      <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span>
        <input type="text" name="quantity_wanted" id="quantity_wanted" value="1" onkeyup="set_qty()" class="input-group form-control" min="1" style="display: block;">
        <span class="input-group-addon bootstrap-touchspin-postfix" style="display: none;"></span>
        <span class="input-group-btn-vertical">
          <a class="btn btn-touchspin js-touchspin bootstrap-touchspin-up d-flex align-items-center ddd" type="button" ><span class="mx-auto">+</span></a>
          <a class="btn btn-touchspin js-touchspin bootstrap-touchspin-down d-flex align-items-center ddd" type="button" ><span class="mx-auto">-</span></a>
        </span>
      </div>
    </div>
    
    <div class="add">
     <?php if(isset($_SESSION['fk_user'])){ ?>
       <button class="btn btn-primary add-to-cart" id="add_to_cart" onclick="add_to_cart1()">Add to cart</button>
     <?php }else{ ?>
       <button class="btn btn-primary tg-btndropdown show-modal donorWantLogin" data-toggle="modal" data-target="#wantDonate">Add to cart</button>
     <?php } ?>
   </div>
   <span id="product-availability">
   </span>
 </div>
 <div class="clearfix"></div>
 <p class="product-minimal-quantity">
 </p>
</div>

<input class="product-refresh ps-hidden-by-js" name="refresh" type="submit" value="Refresh" style="display: none;">

</div>

</div>
</div>
</div>

<div class="row">
 <div class="col-md-12 my-3">
  <p><?php echo $product['var_short_description'];?></p>
</div>
</div>
<?php if($product['txt_nutrition'] != ''){ ?>
  <div class="row">
   <div class="col-md-12 my-3">
     <h6>Nutrition Description</h6>
     <p><?php echo $product['txt_nutrition'];?></p>
   </div>
 </div>
<?php } ?>
</div>
<?php if(count($cat_by_product) > 0){ ?>
 <section>
  <div class="Categoryproducts innovatoryProductGrid mt-3">
   <div class="sec-heading text-center mb-30">
    <h3>other products in the same category:</h3>
  </div>
  
  <div id="js-product-list">
   <div class="innovatoryProductGrid innovatoryProducts">
     <div class="row">
      
       <?php foreach ($cat_by_product as $row1){ ?>
         <div class="item-inner col-lg-4 col-xl-4 col-md-4 col-sm-6 col-xs-6  first-in-line   first-item-of-tablet-line  first-item-of-mobile-line">
           <div class="product-grid6">
            <?php if($row1['var_offer'] != '0'){ ?>
             <div class="favourite-icon">
              <a href="javascript:;" class="fav-btn-present"><span><?php echo $row1['var_offer'];?>%</span></a>
              </div>
            <?php } ?>
            <div class="product-image6 thumbnail_container">
              <a class="thumbnail" href="<?php echo base_url().'product/detail/'.base64_encode($row1['int_glcode']);?>">
                <img class="pic-1" src="<?php echo base_url().'uploads/products/'.$row1['var_image'];?>">
              </a>
            </div>
            <div class="product-content">
              <h3 class="title"><a href="<?php echo base_url().'product/detail/'.base64_encode($row1['int_glcode']);?>"><?php echo $row1['var_title'];?></a></h3>
              <div class="price">&#x20b9;<?php echo $row1['var_price'];?>&nbsp;(<?php echo $row1['var_quantity'];?>)</div>
            </div>
            <ul class="social">
              <li><a href="<?php echo base_url().'product/detail/'.base64_encode($row1['int_glcode']);?>" data-tip="Quick View"><i class="fa fa-info"></i></a></li>
              <!--<li><a href="javascript:;" data-tip="Add to Wishlist"><i class="fa fa-shopping-bag"></i></a></li>-->
              <li><a href="javascript:;" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
            </ul>
          </div>
        </div>
      <?php } ?>
      
      
    </div>
<!--                                 </div>
                                 <div class="owl-nav"><button type="button" role="presentation" class="owl-prev disabled"><i class="fa fa-angle-left"></i></button><button type="button" role="presentation" class="owl-next"><i class="fa fa-angle-right"></i></button></div>
                                 <div class="owl-dots disabled"></div>-->
                               </div>
                             </div>
                           </div>
                         </section>
                       <?php } ?>
<!--                     <script type="text/javascript">
                        $(document).ready(function() {
                           var owl = $(".innovatoryCategoryproducts");
                           owl.owlCarousel({
                               loop:false,
                                 nav:true,
                                 dots:false,
                                 navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
                                 responsive:{
                                   0:{
                                     items:2
                                   },
                                   480:{
                                       items:2
                                   },
                                   768:{
                                       items:3
                                   },
                                   992:{
                                       items:3
                                   },
                                   1200:{
                                       items:3
                                   }
                                 }             
                             });
                        });
                      </script>-->
                      
                      <!-- /.modal -->
                      <footer class="page-footer">
                        <!-- Footer content -->
                      </footer>
                    </section>
                  </div>
                </div>
              </div>
              <div class="displayPosition displayPosition6">
                <!-- Static Block module -->
                <!-- /Static block module -->
              </div>
            </section>



            <script>
              
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
                    $(".page_loader").css("display", "none");
                    $(".page_loader_container").css("display", "none");
                    $('#cart_body').replaceWith(response);
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