<!-- <section class="call-out">
			    <div class="container">
			        <div class="float_left">
			            <h2>Subscribe For Newsletter</h2>
			            <div id="msgNewsletterSubmit"></div> -->
			            <!-- <p>We send you latest news couple a month ( No Spam).</p> -->
			        <!-- </div>
			        <div class="float_right">
			        	<div class="contact-box">

		                    <form method="post" id="newsletter_form" class="contact-form" autocomplete="off" novalidate="novalidate">
		                            
		                        <div class="row clearfix"> -->
		                            <!-- <div class="form-group">
		                                <input type="text" name="username" value="" placeholder="Your Name*"><i class="fa fa-user" aria-hidden="true"></i>

		                            </div> -->

		                            <!-- <div class="form-group col-md-6">
		                                <input type="email" name="var_email" id="var_email" value="" placeholder="Email Address*"><i class="fa fa-envelope" aria-hidden="true"></i>
		                            </div>
		                           

		                            <div class="form-group">
		                                <button type="submit" name="submit" class="btn-style-one center">Submit now</button>
		                            </div>
		                        </div>
		                    </form>
		                </div>
			        </div>
			    </div>
			</section> -->
			<!-- Footer************************* -->
			<footer>
				<div class="main_footer">
					<div class="container">
						<div class="row">
							<div class="col-md-8">
								<div class="footer-newsletter">
									<!-- <h4 class="subscribe-title">Subscribe</h4> -->
			            			<!-- <div id="msgNewsletterSubmit"></div> -->
			            			<div class="contact-box">

		                    <form method="post" id="newsletter_form" class="contact-form" autocomplete="off" novalidate="novalidate">
		                            
		                      
		                            <div class="footer-input">
		                                <input type="email" name="var_email" id="var_email" value="" placeholder="Email Address*">
		                            </div>
		                           

		                            <div class="form-group subscribe-button-section">
		                                <button type="submit" name="submit" class="btn-style-one text-right">Subscribe</button>
		                            </div>
		                        
		                    </form>
		                </div>
								</div>
							</div>
							<div class="col-md-4 footer_contact">
								<ul class="list catagories">
		                            <li><a class="text-transform" href="#"><i class="fa fa-envelope"></i>Marketing@Gmail.Com</a></li>
		                            <li><a href="#"><i class="fa fa-phone"></i>+91 772 206 6378</a></li>
		                            <li><a href="#"><i class="fa fa-home"></i>Plot No. A3, Burlyfield Biotech, Dr Bhapkar Marg, MIDC, New Usmanpura, Aurangabad, Maharashtra, India 431001.</a></li>
		                        </ul>
		                        
							</div> <!-- End of .footer_contact -->
						</div>
					</div>
				</div> <!-- End of .main_footer -->

				<div class="bottom_footer clear_fix">
					<div class="container">
						<h6 class="pull-left">Copyrights © 2020 All Rights Reserved by <a href="<?php echo base_url(); ?>" target="_blank"> Burlyfield</a></h6>
						<!-- <ul class="social_icon pull-right">
							<li><a href="" class="tran3s"><i class="fa fa-cc-visa" aria-hidden="true"></i></a></li>
							<li><a href="" class="tran3s"><i class="fa fa-cc-mastercard" aria-hidden="true"></i></a></li>
							<li><a href="" class="tran3s"><i class="fa fa-paypal" aria-hidden="true"></i></a></li>
							<li><a href="" class="tran3s"><i class="fa fa-credit-card-alt" aria-hidden="true"></i></a></li>
							<li><a href="" class="tran3s"><i class="fa fa-cc-discover" aria-hidden="true"></i></a></li>
						</ul> -->
					</div>
				</div>
			</footer>
<div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

     <div class="modal-dialog" role="document">

         <div class="modal-content">

             <div class="modal-header">

                 <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>

                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                     <span aria-hidden="true" class="mdi mdi-close"></span>

                 </button>

             </div>
                <br>
                <center>
             <div class="card-body">
                <div id="msgSubmit_changep"></div>
                
                <div class="row">
                    <div class="col-md-12">
                 <form role="form" method="post" id="changepassword" class="f-form" data-toggle="validator">

                  <?php 

                  if (isset($_SESSION['login_user']) && $_SESSION['login_user'] == 'user'){

                     $fk_user = $_SESSION['fk_user'];

                  } else {

                     $fk_user = '';

                  }

                  ?>

                  <input type="hidden" name="fk_user" id="fk_user" value="<?php echo $fk_user; ?>">

                     <div class="form-group col-md-8">

                         <label class="sr-only" for="l-form-username">Old Password</label>

                         <input type="password" name="var_opassword" placeholder="Old Password" class="form-control" id="var_opassword" required>

                     </div>



                     <div class="form-group col-md-8">

                         <label class="sr-only" for="l-form-username">New Password</label>

                         <input type="password" name="var_npassword" placeholder="New Password" class="form-control" id="var_npassword" required>

                     </div>



                     <div class="form-group col-md-8">

                         <label class="sr-only" for="l-form-username">Confirm Password</label>

                         <input type="password" name="var_rpassword" placeholder="Confirm Password" class="form-control" id="var_rpassword" required>

                     </div>
                    <div class="form-group col-md-8">
                     <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                 </form>

             </div>
            </div>
         </div></center>
        </div>
     </div>

 </div>
 
 
<div class="modal fade in" id="wantDonate" tabindex="-1" role="dialog" aria-labelledby="login" style="display: none;">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-body padding_0">

        <div class="row">

          <div class="col-md-12">

            <div class="woocommerce-billing-fields">

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">x</span>

              </button>

              <div class="vc_divider" style="height:30px"></div>

              <center><h3><span>Please login before proceeding to checkout</span></h3></center>

              <div class="vc_divider" style="height:30px"></div>

              <div class="cretaccountope" style="text-align: center;">

                <a class="btn" style="background-color: #7fb401; color: #fff;" href="<?php echo base_url();?>signin">LOGIN</a>

              </div>

              <div class="vc_divider" style="height:30px"></div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>

			<!-- Scroll Top Button -->
			<button class="scroll-top tran3s color2_bg">
				<span class="fa fa-angle-up"></span>
			</button>
			<!-- pre loader  -->
		 	<div id="loader-wrapper">
				<div id="loader"></div>
			</div>
	



		<!-- Js File_________________________________ -->

		<!-- j Query -->
		
		<!-- Bootstrap JS -->
		<script type="text/javascript" src="<?php echo base_url(); ?>public/front_assets/js/bootstrap.min.js"></script>

		<!-- Vendor js _________ -->
		<!-- Google map js -->
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRvBPo3-t31YFk588DpMYS6EqKf-oGBSI"></script> <!-- Gmap Helper -->
		<script src="<?php echo base_url(); ?>public/front_assets/js/gmap.js"></script>
		<!-- owl.carousel -->
		<script type="text/javascript" src="<?php echo base_url(); ?>public/front_assets/js/owl.carousel.min.js"></script>
		<!-- ui js -->
		<script type="text/javascript" src="<?php echo base_url(); ?>public/front_assets/js/jquery-ui.min.js"></script>
		<!-- Responsive menu-->
		<script type="text/javascript" src="<?php echo base_url(); ?>public/front_assets/js/menuzord.js"></script>
		<!-- revolution -->
		<script src="<?php echo base_url(); ?>public/front_assets/vendor/revolution/jquery.themepunch.tools.min.js"></script>
		<script src="<?php echo base_url(); ?>public/front_assets/vendor/revolution/jquery.themepunch.revolution.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/front_assets/vendor/revolution/revolution.extension.slideanims.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/front_assets/vendor/revolution/revolution.extension.layeranimation.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/front_assets/vendor/revolution/revolution.extension.navigation.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/front_assets/vendor/revolution/revolution.extension.kenburn.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/front_assets/vendor/revolution/revolution.extension.actions.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/front_assets/vendor/revolution/revolution.extension.parallax.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/front_assets/vendor/revolution/revolution.extension.migration.min.js"></script>
		

		<!-- landguage switcher js -->
		<script type="text/javascript" src="<?php echo base_url(); ?>public/front_assets/js/jquery.polyglot.language.switcher.js"></script>
		<!-- Fancybox js -->
		<script type="text/javascript" src="<?php echo base_url(); ?>public/front_assets/js/jquery.fancybox.pack.js"></script>
		<!-- js count to -->
		<script type="text/javascript" src="<?php echo base_url(); ?>public/front_assets/js/jquery.appear.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/front_assets/js/jquery.countTo.js"></script>
		<!-- WOW js -->
		<script type="text/javascript" src="<?php echo base_url(); ?>public/front_assets/js/wow.min.js"></script>

		<script type="text/javascript" src="<?php echo base_url(); ?>public/front_assets/js/SmoothScroll.js"></script>

		<script src="<?php echo base_url(); ?>public/front_assets/js/bootstrap-select.min.js"></script>
		<script src="<?php echo base_url(); ?>public/front_assets/js/jquery.mixitup.min.js"></script>
		<!-- Theme js -->
		<script type="text/javascript" src="<?php echo base_url(); ?>public/front_assets/js/theme.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/front_assets/js/google-map.js"></script>
		
		

		<script type="text/javascript">
            var sitepath = '<?php echo base_url(); ?>';
            
			$("#newsletter_form").submit(function(event){
                  if(event.isDefaultPrevented()){
                      submitNewsletterMSG(false,"Please fill all details");
                  }else{
                      event.preventDefault();submitNewsletterForm();
                  }
              });
              
            function submitNewsletterForm(){
                var email=$("#var_email").val();

                $.ajax({
                    type:"POST",
                    url:sitepath+"fronthome/newsletter_submit",
                    data:"email="+email,
                    success:function(response){
                        if(response==1){
                            NewsletterformSuccess();
                        }else{   
                            submitNewsletterMSG(false,response);
                        }
                    }
                });
            }
            
            function NewsletterformSuccess(){ 
                $("#newsletter_form")[0].reset();
                submitNewsletterMSG(true,"Newsletter Send Successfully!");
            }
            
            function submitNewsletterMSG(valid,msg){
                if(valid){var msgClasses="h5 text-center tada animated text-success";
                }else{
                    var msgClasses="h5 text-center text-danger";
                }
                $('#msgNewsletterSubmit').show()
                $("#msgNewsletterSubmit").removeClass().addClass(msgClasses).text(msg);
                setTimeout(function(){
                    $('#msgNewsletterSubmit').fadeOut("slow")
                },3000);
            }
            
            $('#hide_cancel_btn').hide();
              function clearFields() {
            
                document.getElementById("search_all").value="";
            
                $('#suggesstion-box').css("display", "none");
                $('#hide_cancel_btn').hide();
              }
            $("#search_all").keyup(function(){
                $('#hide_cancel_btn').show();
                var str = $(this).val();

                if(str.length > 2){

                  $.ajax({

                    type: "POST",

                    url: sitepath+"fronthome/get_allproduct",

                    data:'keyword='+str,

                    beforeSend: function(){

                     $("#search_all").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");

                   },

                   success: function(data){ 

                     $("#suggesstion-box").show();

                     

                     $("#suggesstion-box").html(data);

                     $("#search_all").css("background","#FFF");
                   }
                 });
                }else{
                  $('#hide_cancel_btn').hide();
                  $("#suggesstion-box").css("display","none");
                }
              });

            function load_page(link)
              {
                window.location.href= link;
              }
              
              function add_to_cart(qid,qty,pid,offer){
                $(".page_loader").css("display", "block");
                $(".page_loader_container").css("display", "block");
//                alert(qid);
                $.ajax({

                  url: sitepath+'cart/add_to_cart',
                  type: 'POST',
                  data: 'qid='+qid+'&qty='+qty+'&pid='+pid+'&offer='+offer,
                  dataType: "html",
                  success: function(response){
                    if(response == ""){
                      alert("out of stock");
                      //location.reload();
                    } else {
//                      alert(response);
                    $(".page_loader").css("display", "none");
                    $(".page_loader_container").css("display", "none");
//                    $('#cart_body').replaceWith(response);
                    location.reload(); 
                    }
                    // 
                  }
                });
                
              }
              
              function delete_to_cart(id,weight){
                
                $.ajax({	        

                 type: "POST",

                 url: '<?= base_url() ?>cart/delete_to_cart',

                 data: "id="+id+"&weight="+weight,

                 success: function(response)

                 {    

                  var res = response.split('***');

                  $('#cart_body').replaceWith(res[0]);

                  $('#li'+id).remove();
                  if(res[3] == "Free Shipping"){
                      $('#items_total').replaceWith('<span class="value color2" id="items_total">&#x20b9; '+res[1]+'</span>');
                   } else {
                      $('#items_total').replaceWith('<span class="value color2" id="items_total">&#x20b9; '+res[4]+'</span>');
                   }
                   $('#spcharge').replaceWith('<span class="value" id="spcharge">'+res[3]+'</span>');

                  $('#items_cart').replaceWith('<span class="value" id="items_cart">&#x20b9;'+res[1]+'</span>');

                  $('#items_count').replaceWith('<span class="label js-subtotal" id="items_count">'+res[2]+' items</span>');
                  location.reload();

                }

              });

              }
              
$("#changepassword").validator().on("submit", function (event) {

  if (event.isDefaultPrevented()) {

        // alert("1");

        //formError_Set(this.id);

       // submitMSG_forget(false, "Please fill all details");

     } else {

     // alert("2");

     event.preventDefault();

     change_password();

   }

 });



function change_password() {

  var opass = $("#var_opassword").val();

  var npass = $("#var_npassword").val();

  var rpass = $("#var_rpassword").val();

  var fk_user = $("#fk_user").val();

  if(npass == '' || rpass == '' || opass == ''){

    var msg = "Please fill up all details.";



    var msgClasses = "h5 text-center text-danger";



                   // submitMSG_forget(false, msg);



                   $("#msgSubmit_changep").removeClass().addClass(msgClasses).text(msg);



                 } 

                 if(npass != rpass){

                  var msg = "new and confirm Password does not match.";



                  var msgClasses = "h5 text-center text-danger";



                   // submitMSG_forget(false, msg);



                   $("#msgSubmit_changep").removeClass().addClass(msgClasses).text(msg);

                   

                 }



                 $.ajax({

                  type: "POST",

                  url: sitepath + "login/change_password",

                  data: "opassword=" + opass +"&npassword=" + npass +"&rpassword=" + rpass+"&fk_user=" + fk_user,

                  success: function (response) {

                    if (response == 1) {



                  // $("#changepassword")[0].reset();

                  var msg =  "Your Password Changed Successfully.";

                  var msgClasses = "h5 text-center tada animated text-success";

                  $("#msgSubmit_changep").removeClass().addClass(msgClasses).text(msg);



                  window.location.href = sitepath + 'signin';

                } else {

                // $("#changepassword")[0].reset();

                var msg = response;

                var msgClasses = "h5 text-center text-danger";

                // submitMSG_forget(false, msg);

                $("#msgSubmit_changep").removeClass().addClass(msgClasses).text(msg);

              }

            }

          });

               }
                
//               $("#cartDropdown").on('click', function(event){ 
//                   alert('sd');
//                    $('.cart_list').css('display','block');
//                });

		</script>
   <!--   <script type="text/javascript">
     $(function() {
      $( 'ul.menuzord-menu li' ).on( 'click', function() {
            $( this ).parent().find( 'li.current_page' ).removeClass( 'current_page' );
            $( this ).addClass( 'active' );
      });
});
    </script> -->
		</div> <!-- End of .main_page -->
	</body>
</html>