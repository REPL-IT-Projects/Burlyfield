<section class="breadcrumb-area" style="background-image:url(<?php echo base_url(); ?>public/front_assets/images/background/Recipes.jpg);">
			    <!-- <div class="container">
			        <div class="row">
			            <div class="col-md-12">
			                <div class="breadcrumbs text-center">
			                    <h1>Blog</h1>
			                    <h4>Welcome to certified burly field</h4>
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
				                    <li>News massonary</li> 
				                </ul>
				            </div>
				            <div class="col-lg-4 col-md-7 col-sm-7">
				                <p>We provide <span>100% organic</span> products</p>
				            </div>
				        </div>
				    </div>
				</div> -->
			    
			</section>

			<section class="news single_news_page massonary_mode">
				<div class="container">
					<div id="isotop_wrapper">
					    <?php foreach($blog as $blg) { ?>
						<div class="col-md-4 col-sm-6 col-xs-12 isotop_item">
							<div class="blogList_single_post clear_fix wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
	        				
									<img src="<?php echo base_url().'uploads/blog/'.$blg['var_image'] ?>" alt="News" class="img-responsive" style="padding:20px; height: 225px;">
		
								<div class="post">
									<div class="text">
										<h4><a href="<?php echo base_url().'pages/blog_details/'.base64_encode($blg['int_glcode']);?>"><?php echo $blg['var_name']; ?></a></h4>
										<ul>
											<!--<li><a href="" class="tran3s"><i class="fa fa-tag" aria-hidden="true"></i> Healthy</a></li> -->											
											<li><a href="" class="tran3s"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $blg['var_author']; ?></a></li>
											<li><a href="" class="tran3s"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php   $date=date_create($blg['dt_createddate']);
													echo date_format($date,"d|m|Y");
											 ?></a></li>
										</ul>
										<!--<p><?php echo $blg['txt_description']; ?></p>-->
										<span  class="wrap" data-toggle="tooltip" data-placement="top" title="<?php echo $blg['short_desc'];?>">
										<p><?php echo $blg['short_desc']; ?></p>
										<div class="link"><a href="<?php echo base_url().'pages/blog_details/'.base64_encode($blg['int_glcode']);?>" class="tran3s">READ MORE<span class="fa fa-sort-desc"></span></a></div></span>
										<!--<div class="link"><a href="<?php echo base_url().'pages/blog_details/'.base64_encode($blg['int_glcode']);?>" class="tran3s">READ MORE<span class="fa fa-sort-desc"></span></a></div>-->
										
									</div>
									
								</div> <!-- End of .post -->
	        				</div>
							
						</div>
						<?php } ?>
						
					</div>
				</div>
			</section>
			<script>
var charLimit = 20;

function truncate(el) {
 var clone = el.children().first(),
     originalContent = el.html(),
     text = clone.text();
 el.attr("data-originalContent", originalContent);
 clone.text(text.substring(0, charLimit) + "...")
 el.empty().append(clone);
}

function reveal(el) {
 el.html(el.attr("data-originalContent"));
}

$("#description").on("click", function (e) {
 e.preventDefault();
 var truncateElement = $(this).parent().prev().find(".truncate");
 if ($(this).text() === "Read More") {
 } else {
     $(this).text("Read More");
     truncate(truncateElement);
 }
});

$(".truncate").each(function () {
   truncate($(this));
});
 

</script>