<div class="innovatoryBreadcrumb">
  <div class="container">
    <nav data-depth="2" class="breadcrumb hidden-sm-down">
      <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">

        <li itemprop="itemListElement" itemscope="" >
          <a itemprop="item" href="javascript:;">
            <span itemprop="name">Home</span>
          </a>
          <meta itemprop="position" content="1">
        </li>
        <li itemprop="itemListElement">
          <a itemprop="item" href="javascript:;">
            <span itemprop="name">Product List</span>
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
            <span class="custom-checkbox">
              <input class="ads_Checkbox" name="getOffers" onclick="search_by_offers()" type="checkbox" id="get_offer">
              
              <span class="ps-shown-by-js"><i class="fa fa-check checkbox-checked"></i></span>
            </span>
            <input type="hidden" value="No" id="offerValue"> 
            <a href="javascript:;" class="_gray-darker search-link js-search-link" rel="nofollow">View Offer Product</a>
          </div>
          </div>
        </div>
      
     <div id="search_filters_wrapper" class="hidden-sm-down">
        <div id="search_filters">
                <section class="facet clearfix">
                  <h1 class="h6 facet-title hidden-sm-down">Categories</h1>
                  <div class="title hidden-md-up" data-target="#facet_95001" data-toggle="collapse">
                   <h1 class="h6 facet-title">Categories</h1>
                   <span class="pull-xs-right">
                     <span class="navbar-toggler collapse-icons">
                       <i class="fa fa-check add">?</i>
                       <i class="fa fa-check remove">?</i>
                     </span>
                   </span>
                 </div>
                 <ul id="facet_95001" class="collapse">

                  <?php foreach($category as $row4){ ?>
                   <li>
                    <label class="facet-label">
                      <span class="custom-checkbox">
                        <input class="ads_Checkbox" onclick="search_by_category()" type="checkbox" name="fk_category" id="<?php echo $row4['int_glcode'];?>" value="<?php echo $row4['int_glcode'];?>">
                        <span class="ps-shown-by-js"><i class="fa fa-check checkbox-checked"></i></span>
                      </span>
                      <a href="javascript:;" class="_gray-darker search-link js-search-link" rel="nofollow"><?php echo $row4['var_title'];?></a>
                    </label>
                  </li>
                <?php } ?>
              </ul>
            </section>

          </div>
        </div>

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
                              <!-- <div class="click-all">
                                 <a href="#">See all New arrivals<i class="ion-android-arrow-dropright"></i></a>
                               </div> -->
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

                <section class="active_grid">
                 <div id="">
                  <div id="js-product-list-top" class="products-selection row">
                   <div class="col-lg-5 total-products" id="total_products">

                    <p>There are <?php echo $total_rows;?> products.</p>
                  </div>
                  <div class="col-lg-4">
                    <div class="products-sort-order dropdown pull-right" style="top: 8px;width: 125px;">
                      <select class="shot__byselect" id="shot_byselect" style="width: 125px;">

                        <option value="">Relevance</option>
                        <option value="var_title">Name A-Z</option>

                      </select>

                    </div>

                    <span class=" hidden-sm-down sort-by pull-right">Sort by:</span>      

                  </div>
                  <div class="col-lg-3">
                   <input type="text" name="search" id="search" class="shot__byselect form-control" placeholder="Search" style="width: 100%;height: 30px;"> 
                 </div>

               </div>
             </div>
             <div id="" class="hidden-sm-down">
              <section id="js-active-search-filters" class="hide">
               <h6 class="h6 active-filter-title">Active filters</h6>
             </section>
           </div>
           <div id="">
            <div id="js-product-list">
             <div class="innovatoryProductGrid innovatoryProducts">
               <div class="row" id="product_data">

                <?php foreach ($products as $row1){ ?>
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
                      <li><a href="<?php echo base_url().'product/detail/'.base64_encode($row1['int_glcode']);?>" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                  </div>
                </div>
              <?php } ?>
            </div>

            <?php if(count($products) > 0){ ?>
              <div id="pagination">
                <?php echo $pagination; ?>
              </div>
            <?php } ?>
          </div>

          <!-- <div class="hidden-md-up text-xs-right up">
            <a href="#header" class="btn btn-secondary">
              Back to top
              <i class="fa fa-check">?</i>
            </a>
          </div> -->
        </div>
      </div>
      <div id="js-product-list-bottom">
        <div id="js-product-list-bottom"></div>
      </div>
    </section>
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
  var site_path = '<?php echo base_url();?>';

    // $(document).ready(function(){
    //     $('input[name="getOffers"]').click(function(){
    //         if($(this).is(":checked")){
    //             $('#offerValue'). val('Yes');
    //         }

    //         else if($(this).is(":not(:checked)")){
    //             $('#offerValue'). val('No');
    //         }
    //     });
    // });
// $(function() {
//   $('input[name="getOffers"]').change(function() {
//     if ($(this).is(":checked")) {
//       var offerValue = 'Yes';
//     } else {
//       var offerValue = 'No';
//     }
//   });
// });

  function search_by_offers(){

    if(document.getElementById("get_offer").checked==true){
        $('#offerValue'). val('Yes');
      } else {
        $('#offerValue'). val('No');
      }

  var test = new Array();
   $('.ads_Checkbox:checked').each(function () {
     test.push($(this).val());
   });
   if(test.length == 0){
     test = '';
   }

   var append = $("#search").val();
   var entries = '12';
   var field = 'int_glcode';
   var sort = 'DESC';
   var sel_val = $('#shot_byselect').val();
   var offer_val = $('#offerValue').val();

   //alert(offer_val)
   $.ajax({

    url: site_path+'product/loadProduct/'+pagenumber,
    type: 'get',
    data: {append:append,field:field,sort:sort,entries:entries,sel_val:sel_val,catid:test,offer_val:offer_val},
    dataType: 'json',
    success: function(response){

      $('#pagination').html(response.pagination);
      createTable(response.result,response.row,response.total_rows,response.total_members);
    }
  });
 }

  function search_by_category(){

   var test = new Array();
   $('.ads_Checkbox:checked').each(function () {
     test.push($(this).val());
   });
   if(test.length == 0){
     test = '';
   }
   var append = $("#search").val();
   var entries = '12';
   var field = 'int_glcode';
   var sort = 'DESC';
   var sel_val = $('#shot_byselect').val();
   var offer_val = $('#offerValue').val();
   $.ajax({

    url: site_path+'product/loadProduct/'+pagenumber,
    type: 'get',
    data: {append:append,field:field,sort:sort,entries:entries,sel_val:sel_val,catid:test,offer_val:offer_val},
    dataType: 'json',
    success: function(response){

      $('#pagination').html(response.pagination);
      createTable(response.result,response.row,response.total_rows,response.total_members);
    }
  });
 }

 var pagenumber = 0;
 $(document).ready(function () {
  $("#shot_byselect").change(function (event) {

    var test = new Array();
    $('.ads_Checkbox:checked').each(function () {
     test.push($(this).val());
   });
    if(test.length == 0){
     test = '';
   }
      //alert("Hello")
      var sel_val = $(this).val();
      var append = $("#search").val();
      var entries = '12';
      var field = 'int_glcode';
      var sort = 'DESC';
      var offer_val = $('#offerValue').val();
      $.ajax({
        type:"get",
        url : site_path+'product/loadProduct/'+pagenumber,
        data: {append:append,field:field,sort:sort,entries:entries,sel_val:sel_val,catid:test,offer_val:offer_val},
        dataType: 'json',
        async: false,
        success : function(response) {
          $('#pagination').html(response.pagination);
          createTable(response.result,response.row,response.total_rows,response.total_members);
        },
        error: function() {
          alert('Error occured');
        }
      });
    });
});

 $('#search').on('keyup',function(){

  var test = new Array();
  $('.ads_Checkbox:checked').each(function () {
    test.push($(this).val());
  });
  if(test.length == 0){
    test = '';
  }
 var append = $("#search").val();
 var entries = '12';
 var field = 'int_glcode';
 var sort = 'DESC';
 var sel_val = $('#shot_byselect').val();
 var offer_val = $('#offerValue').val();

 $.ajax({

  url: site_path+'product/loadProduct/'+pagenumber,
  type: 'get',
  data: {append:append,field:field,sort:sort,entries:entries,sel_val:sel_val,catid:test,offer_val:offer_val},
  dataType: 'json',
  success: function(response){


    $('#pagination').html(response.pagination);
    createTable(response.result,response.row,response.total_rows,response.total_members);
  }
});
                        //}

                      });

 $('#pagination').on('click','a',function(e){

  e.preventDefault(); 

  var pageno = $(this).attr('data-ci-pagination-page');    

  loadPagination(pageno);

});

 function loadPagination(pagno,field = 'int_glcode',sort = 'DESC',entries = '12'){

  var test = new Array();
  $('.ads_Checkbox:checked').each(function () {
   test.push($(this).val());
 });
  if(test.length == 0){
   test = '';
 }

 var sel_val = $('#shot_byselect').val();
 var append = $("#search").val();
 var offer_val = $('#offerValue').val();
 $.ajax({

  url: '<?= base_url() ?>product/loadProduct/'+pagno,

  type: 'get',

  data: {append:append,field:field,sort:sort,entries:entries,sel_val:sel_val,catid:test,offer_val:offer_val},

  dataType: 'json',

  success: function(response){

   $('#pagination').html(response.pagination);          

   createTable(response.result,response.row,response.total_rows,response.total_users);
 }
});
}

function createTable(result,sno,total_rows,total_users){
   //                    alert(JSON.stringify(result));
   //                    console.log(JSON.stringify(result));return false;
   var sno = Number(sno);

   var start = sno+1;

   if(result != null && result != ''){
    var count_rows = result.length;
  }  

  var end = sno + count_rows;

  $('#product_data').empty();

  if(result == null || result == ''){

   var tr = '<h4>No results</h4>';   

    $('#total_products').html('<p>There are no products.</p>');     

   $('#product_data').append(tr);

   return false;

 }

      //alert(siteurl);

      for(index in result){

       var id = result[index].int_glcode;

       var var_title = result[index].var_title;
       var var_price = result[index].var_price;
       var var_offer = result[index].var_offer;
       var var_discount_price = result[index].var_discount_price;
       var var_quantity = result[index].var_quantity;
       var var_image = result[index].var_image;

       if(var_image.substring(0, 4) === "http")
       {              

       } else if (var_image != '') {

         var_image = site_path+'uploads/products/'+var_image;

       } else {

         var_image = site_path+'public/assets/img/site_imges/no_image.png';

       }

       sno+=1;

       var tr = '<div class="item-inner col-lg-4 col-xl-4 col-md-4 col-sm-6 col-xs-6  first-in-line   first-item-of-tablet-line  first-item-of-mobile-line"><div class="product-grid6">';
       
       if(var_offer != '0'){
        tr += '<div class="favourite-icon"><a href="javascript:;" class="fav-btn-present"><span>'+var_offer+'%</span></a></div>';
      }

      tr += '<div class="product-image6 thumbnail_container"><a class="thumbnail" href="'+site_path+"product/detail/"+window.btoa(id)+'"><img class="pic-1" src="'+var_image+'"></a></div><div class="product-content">'+
      '<h3 class="title"><a href="'+site_path+"product/detail/"+window.btoa(id)+'">'+var_title+'</a></h3><div class="price">&#x20b9;'+var_price+'&nbsp;('+var_quantity+')</div></div>'+
      '<ul class="social"><li><a href="'+site_path+"product/detail/"+window.btoa(id)+'" data-tip="Quick View"><i class="fa fa-info"></i></a></li>'+
      '<li><a href="javascript:;" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li></ul></div></div>';

      $('#product_data').append(tr);

    }

    if(total_rows == '1'){
      $('#total_products').html('<p>There are ' +total_rows+ ' product.</p>');
    
    } else {
      $('#total_products').html('<p>There are ' +total_rows+ ' products.</p>');
    }
    
  }

</script>