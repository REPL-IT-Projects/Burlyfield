
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>

<section class="breadcrumb-area" style="background-image:url(<?php echo base_url(); ?>public/front_assets/images/background/Store-Page.jpg);">
			    
			    
			</section>




			<!--gallery Section-->
		    <section class="gallery gallery-grid">
		        <div class="container">
					
		            <!--Filter-->
		            <!--<div class="filters text-center">
		                <select onchange="window.location.href=$(this).val();" data-style="g-select" data-width="100%">
								<option value="">Select City</option>
									<option value="https://www.burlyfield.com/pages/citydata/MQ==">Pune</option>
			            </select>
		            </div> -->
					<div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Find Us</label>
                                                <select class="form-control select2" style="width: 100%;" name="txt_city" id="txt_city" required onChange="FetchShopLocation(this.value);">
                                                    <option value="" >Select City</option>
													 
                                                </select>
                                            </div>   
                                        </div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Location</label>
												<textarea class="form-control"  rows="3"name="txt_Location" id="txt_Location" value=""  readonly></textarea>
											</div>
										</div>
									</div>


		         

		        </div>
			        
		    </section><!-- End of section -->
			
			<!-- <?php include_once 'scripts.php'; ?>
                   <script>
                        function FetchShopLocation(int_glcode)
		                {
                            var int_glcode = int_glcode;
			                $.ajax(
                            {
                                type: "get",
                                url: "<?php echo site_url('pages/Pages/shopLocation/')?>"+int_glcode,
                                data:{int_glcode:int_glcode},
                                dataType: 'JSON',
                                success:function(data)
                                {
                                    $('[name="txt_Location"]').val(data.var_address);
                                }
                            });
	 	                }
		            </script> -->
