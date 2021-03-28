<section class="breadcrumb-area" style="background-image:url(<?php echo base_url(); ?>public/front_assets/images/background/OurProducts.jpg);">
			    
			    
			</section>


			<!-- Shop Page Content************************ -->
	        <div class="shop_page featured-product">
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
								
										<!-- <li><a href="" class="tran3s">Fruits & Drinks   (06)</a></li>
										<li><a href="" class="tran3s">Fresh Meat   (12)</a></li>
										<li><a href="" class="tran3s">Beauty Care   (14)</a></li> -->
									</ul>
	        					</div> <!-- End of .sidebar_categories --->

	        					

								<div class="best_sellers clear_fix wow fadeInUp">
									<div class="theme_inner_title">
										<h4>popular products</h4>
									</div>

									<?php foreach($top_product as $rwr){ ?>
									<div class="best_selling_item clear_fix border">
										<div class="img_holder float_left">
											<img src="<?php echo base_url().'uploads/products/'.$rwr['var_image'];?>" style="height: 80px; width: 70px;" alt="image">
										</div> <!-- End of .img_holder -->

										<div class="text float_left">
											<a href="<?php echo base_url().'product/detail/'.base64_encode($rwr['int_glcode']);?>"><h6><?php echo $rwr['var_title'];?></h6></a>
											<ul>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
											</ul>
											<span>&#x20b9; <?php echo $rwr['var_price'];?></span>
										</div> <!-- End of .text -->
									</div> <!-- End of .best_selling_item -->
								<?php } ?>
									
								</div> <!-- End of .best_sellers -->


								<!-- <div class="sidebar_tags wow fadeInUp">
	   								<div class="theme_inner_title">
										<h4>product Tags</h4>
									</div>

									<ul>
										<li><a href="#" class="tran3s">fruits</a></li>
										<li><a href="#" class="tran3s">Cosmetics</a></li>
										<li><a href="#" class="tran3s">Farmers</a></li>
										<li><a href="#" class="tran3s">Healthy</a></li>
										<li><a href="#" class="tran3s">Catering</a>  </li>
										<li><a href="#" class="tran3s">Chemical</a></li>
										<li><a href="#" class="tran3s">Post Format</a> </li>
										<li><a href="#" class="tran3s">Industry</a></li>
										<li><a href="#" class="tran3s">Research</a></li>
									</ul>
	   							</div>  --><!-- End of .sidebar_tags -->

	        				</div> <!-- End of .wrapper -->
	        			</div> <!-- End of .sidebar_styleTwo -->
	        			<div class="col-lg-9 col-md-8 col-sm-12 col-sx-12">
	        					        			
		        			<div class="row" id="product_data">
				            	<?php foreach ($products as $row1){ ?>
					            <!--Default Item-->
					            <div class="col-md-4 col-sm-6 col-xs-12 default-item" style="display: inline-block;">
					                <div class="inner-box">
					                    <div class="single-item center">
					                        <figure class="image-box"><img src="<?php echo base_url().'uploads/products/'.$row1['var_image'];?>" alt="" style=" height: 163px;">
					                        	<!-- <div class="product-model new">New</div> -->
					                        </figure>
					                        <div class="content">
					                        	<h3><a href="<?php echo base_url().'product/detail/'.base64_encode($row1['int_glcode']);?>"><?php echo $row1['var_title'];?></a></h3>
					                            <div class="rating"><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span></div>
					                            <div class="price">&#x20b9;<?php echo $row1['var_price'];?>&nbsp;(<?php echo $row1['var_quantity'];?>)</div>
					                        </div>
					                        <div class="overlay-box">
					                        	<div class="inner">
						                        	<div class="top-content">
						                        		<ul>
						                        			<!-- <li><a href="#"><span class="fa fa-eye"></span></a></li> -->
						                        			<li class="tultip-op"><span class="tultip"><i class="fa fa-sort-desc"></i>ADD TO CART</span>
						                        			<?php // if(isset($_SESSION['fk_user'])){ ?>
        				                        			<a href="javascript:;" onclick="add_to_cart('<?php echo $row1['q_id'];?>','1','<?php echo $row1['int_glcode'];?>','<?php echo $row1['var_offer'];?>')"><span class="icon-icon-32846"></span></a>
        													<?php // } else { ?>
        													<!--<a href="javascript:;" data-toggle="modal" data-target="#wantDonate"><span class="icon-icon-32846"></span></a>-->
        													<?php // } ?>
																
															</li>
						                        			<!-- <li><a href="#"><span class="fa fa-heart-o"></span></a></li> -->
						                        		</ul>
						                        	</div>
						                        	<div class="bottom-content">
						                        		<h4><a href="<?php echo base_url().'product/detail/'.base64_encode($row1['int_glcode']);?>"><?php echo $row1['var_title'];?></a></h4>
                                        <p><?php if($pvalue['var_stock'] == 0){ echo "Out of Stock"; } else if($pvalue['var_stock'] < 5) { echo $pvalue['var_stock']." Items left";}
                                        ?></p>
						                        		<p>&#x20b9;<?php echo $row1['var_price'];?>&nbsp;(<?php echo $row1['var_quantity'];?>)</p>
						                        	</div>
					                        	</div>
					                        </div>
						                </div>
					                </div>
					            </div>
					            <?php } ?>
					            <!--Default Item
					            <div class="col-md-4 col-sm-6 col-xs-12 default-item" style="display: inline-block;">
					                <div class="inner-box">
					                    <div class="single-item center">
					                        <figure class="image-box"><img src="<?php echo base_url(); ?>public/front_assets/images/shop/2.png" alt=""></figure>
					                        <div class="content">
					                        	<h3><a href="shop-single.html">Turmeric Powder</a></h3>
					                            <div class="rating"><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span></div>
					                            <div class="price">$12.99 <span class="prev-rate">$14.99</span></div>
					                        </div>
					                        <div class="overlay-box">
					                        	<div class="inner">
						                        	<div class="top-content">
						                        		<ul>
						                        			<li><a href="#"><span class="fa fa-eye"></span></a></li>
						                        			<li class="tultip-op"><span class="tultip"><i class="fa fa-sort-desc"></i>ADD TO CART</span><a href="#"><span class="icon-icon-32846"></span></a>
																
															</li>
						                        			<li><a href="#"><span class="fa fa-heart-o"></span></a></li>
						                        		</ul>
						                        	</div>
						                        	<div class="bottom-content">
						                        		<h4><a href="#">It Contains:</a></h4>
						                        		<p>35% of organic raisins 55% of oats and 10% of butter. </p>
						                        	</div>
					                        	</div>
					                        </div>
						                </div>
					                </div>
					            </div> -->
					            
					        </div>
					        <br>
					        <?php if(count($products) > 0){ ?>
                                <!-- <div id="pagination">
                                    <ul class="page_pagination" >
                                        <li><a href="" class="active tran3s"><?php echo $pagination; ?></a></li>
                                    </ul>
                                  
                                </div> -->
                              <?php } ?>
								<!--        <ul class="page_pagination" >-->
								<!--	<li><a href="#" class="tran3s"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a></li>-->
								<!--	<li><a href="#" class="active tran3s">1</a></li>-->
								<!--	<li><a href="#" class="tran3s">2</a></li>-->
								<!--	<li><a href="#" class="tran3s">3</a></li>-->
								<!--	<li><a href="#" class="tran3s"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></li>-->
								<!--</ul>-->
			        	


						</div> <!-- End of .row -->
					</div> <!-- End of .container -->
				</div> <!-- End of .shop_page -->


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

	function catagories() {
	    var id = document.getElementById("catval").value;
	    
   alert(id);
	}

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
   // alert(response);
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
       var q_id = result[index].q_id;
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

       var tr = '<div class="col-md-4 col-sm-6 col-xs-12 default-item" style="display: inline-block;"><div class="inner-box">';
       
       if(var_offer != '0'){
        tr += '<div class="favourite-icon"><a href="javascript:;" class="fav-btn-present"><span>'+var_offer+'%</span></a></div>';
      }

      tr += '<figure class="image-box"><img src="'+var_image+'" alt="" style=" height: 163px;"></figure><div class="content"><h3><a href="'+site_path+"product/detail/"+window.btoa(id)+'">'+var_title+'</a></h3><div class="rating"><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span></div><div class="price">&#x20b9;'+var_price+'&nbsp;('+var_quantity+')</div></div><div class="overlay-box"><div class="inner"><div class="top-content"><ul><li class="tultip-op"><span class="tultip"><i class="fa fa-sort-desc"></i>ADD TO CART</span><a href="javascript:;" onclick="add_to_cart('+q_id+','1','+id+','+var_offer+'"><span class="icon-icon-32846"></span></a></li></ul></div><div class="bottom-content"><h4><a href="'+site_path+"product/detail/"+window.btoa(id)+'">'+var_title+'</a></h4><p>&#x20b9;'+var_price+'&nbsp;('+var_quantity+')</p></div></div></div></div></div></div>';
      

      $('#product_data').append(tr);

    }

    if(total_rows == '1'){
      $('#total_products').html('<p>There are ' +total_rows+ ' product.</p>');
    
    } else {
      $('#total_products').html('<p>There are ' +total_rows+ ' products.</p>');
    }
    
  }

</script>