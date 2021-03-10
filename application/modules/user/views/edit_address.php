<div class="modal-body">
 <div class="row">
  <div class="col-md-12">
   <div class="woocommerce-billing-fields">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">x</span>
   </button>
   <div class="vc_divider" style="height:30px"></div>
   <form class="contact-form row" method="post" id="add_user_address" action="<?php echo base_url(); ?>user/editAddress">
   	<input type="hidden" name="fk_address" id="fk_address" value="<?php echo $data['int_glcode']; ?>">
     <div class="form-field col-lg-6">
      <input id="var_house_no" name="var_house_no" class="input-text js-input" type="text" value="<?php echo $data['var_house_no']; ?>" required="" placeholder="House No *">
    </div>
    <div class="form-field col-lg-6 ">
      <input id="var_app_name" name="var_app_name" class="input-text js-input" type="var_app_name" required="" value="<?php echo $data['var_app_name']; ?>" placeholder="Apar/Street name *">
    </div>
    <div class="form-field col-lg-12 ">
      <input id="var_landmark" name="var_landmark" class="input-text js-input" type="text" required="" value="<?php echo $data['var_landmark']; ?>" placeholder="Landmark *">
    </div>
    <div class="form-field col-lg-6 ">
      <input id="var_city" name="var_city" class="input-text js-input" type="text" required="" value="<?php echo $data['var_city']; ?>" placeholder="City name *">
    </div>
    <div class="form-field col-lg-6">
      <input id="var_state" name="var_state" class="input-text js-input" type="text" required="" value="<?php echo $data['var_state']; ?>" placeholder="State *">
    </div>
    <div class="form-field col-lg-6 ">
      <input id="var_country" name="var_country" class="input-text js-input" type="text" required="" value="<?php echo $data['var_country']; ?>" placeholder="Country *">
    </div>
    <div class="form-field col-lg-6">
      <input id="var_pincode" name="var_pincode" class="input-text js-input" type="text" required="" value="<?php echo $data['var_pincode']; ?>" placeholder="Pincode *">
    </div>

    <h6>Choose Nick name for this address</h6>
    <div class="form-field col-lg-12 ">
     <div class="request_radio">
       <div class="check_box_div" style="margin:0px 0px;">                                           
         <input id="option_home" type="radio" name="chr_type" value="Home" required="" <?php if ($data['chr_type'] == 'Home') { echo "checked"; } ?>>            
         <label for="option_home"><span><span>Home</span></span>  </label>              
       </div>
       <div class="check_box_div" style="margin:0px 0px;">                                           
         <input id="option_office" type="radio" name="chr_type" value="Office" required="" <?php if ($data['chr_type'] == 'Office') { echo "checked"; } ?>>            
         <label for="option_office"><span><span>Office</span></span>  </label>              
       </div>
       <div class="check_box_div" style="margin:0px 0px;">                                           
         <input id="option_other" type="radio" name="chr_type" value="Other" required="" <?php if ($data['chr_type'] == 'Other') { echo "checked"; } ?>>            
         <label for="option_other"><span><span>Other</span></span>  </label>              
       </div>
     </div>
   </div> 
   <div class=" col-lg-12">
    <input type="checkbox" value="Y" name="default_status" id="default_status" <?php if ($data['default_status'] == 'Y') { echo "checked"; } ?>> Set as default address
  </div>
  <div class="form-field col-lg-12">
    <input class="btn btn-primary" type="submit" value="Edit ADDRESS">
  </div>
</form>
</div>
</div>
</div>
</div>