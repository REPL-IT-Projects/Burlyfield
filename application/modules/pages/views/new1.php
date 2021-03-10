<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap Speech Bubble Testimonial Carousel</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
body {
	font-family: "Open Sans", sans-serif;
}
h2 {
	color: #000;
	font-size: 26px;
	font-weight: 300;
	text-align: center;
	position: relative;
	margin: 30px 0 60px;
}
h2::after {
	content: "";
	width: 100px;
	position: absolute;
	margin: 0 auto;
	height: 4px;
	border-radius: 1px;
	background: #1abc9c;
	left: 0;
	right: 0;
	bottom: -20px;
}
.carousel {
	margin: 0 auto;
	padding: 0 70px;
}
.carousel .item {
	color: #999;
	overflow: hidden;
    min-height: 120px;
	font-size: 13px;
}
.carousel .media {
	position: relative;
	padding: 0 0 0 20px;
}
.carousel .media img {
	width: 75px;
	height: 75px;
	display: block;
	border-radius: 50%;
}
.carousel .testimonial-wrapper {
	padding: 0 10px;
}
.carousel .testimonial {
    color: #808080;
    position: relative;
    padding: 15px;
    border: 1px solid #efefef;
    border-radius: 3px;
	margin-bottom: 15px;
}
.carousel .testimonial::after {
	content: "";
	width: 15px;
	height: 15px;
	display: block;
	background: #f1f1f1;
	border: 1px solid #efefef;
	border-width: 0 0 1px 1px;
	position: absolute;
	bottom: -8px;
	left: 46px;
	transform: rotateZ(-46deg);
}
.carousel .star-rating li {
	padding: 0 2px;
}
.carousel .star-rating i {
	font-size: 16px;
	color: #ffdc12;
}
.carousel .overview {
	padding: 3px 0 0 15px;
}
.carousel .overview .details {
	padding: 5px 0 8px;
}
.carousel .overview b {
	text-transform: uppercase;
	color: #1abc9c;
}
.carousel .carousel-indicators {
	bottom: -70px;
}
.carousel-indicators li, .carousel-indicators li.active {
	width: 18px;
    height: 18px;
	border-radius: 50%;
	margin: 1px 2px;
}
.carousel-indicators li {	
    background: #e2e2e2;
    border: 4px solid #fff;
}
.carousel-indicators li.active {
	color: #fff;
    background: #1abc9c;
    border: 5px double;    
}
.theme_title {
    position: relative;
    padding-bottom: 26px;
    margin-top: -6px;
    text-transform: uppercase;
</style>
</head>
<body>
  <section class="testimonials-section" style="background-image:url(<?php echo base_url(); ?>public/front_assets/images/parallax/1.jpg);">
		        <div class="container">
		            <div class="theme_title">
						 <h2 style="color: #ffffff">testimonials</h2>
					</div>
				</div>
	</section>
  <!-- <section class="testimonials-section"> -->
   <section class="news single_news_page massonary_mode" >
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<!-- Carousel indicators -->
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
					<li data-target="#myCarousel" data-slide-to="2"></li>
				</ol>   
				<!-- Wrapper for carousel items -->
				 <?php foreach($testimonial as $test) { ?>
				<div class="carousel-inner">
					<div class="item active">
					<div class="item">
						<div class="row">
							<div class="col-sm-12">
								<div class="testimonial-wrapper">
									<div class="testimonial"> <?php echo $test['txt_description']; ?></div>
									<div class="media">
										<div class="media-left d-flex mr-3">
											<img src="uploads/testimonial/1600239007author.png" alt="">	
												<!--<div class="info clearfix">
												<div class="author-thumb"><img src="<?php echo base_url().'uploads/testimonial/'.$test['var_image'] ?>" alt=""></div> -->	
										</div>
										<div class="media-body">
											<div class="overview">
												<div class="name"><b ><?php echo $test['var_name']; ?> </b></div>
												<div class="details"><?php echo $test['var_position']; ?><br>  <?php echo $test['var_city']; ?></div>											
												<div class="star-rating">
													<ul class="list-inline">
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star"></i></li>
														<li class="list-inline-item"><i class="fa fa-star-o"></i></li>
													</ul>
												</div>
											</div>
										</div><br>
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
</div>
</section>
</body>
</html>                                		
 