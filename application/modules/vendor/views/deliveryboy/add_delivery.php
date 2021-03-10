<div class="page-holder w-100 d-flex flex-wrap">
            <div class="container-fluid px-xl-5">
<section>
                  <div class="page-holder d-flex align-items-center">
                     <div class="container">
                        <div class="row align-items-center py-5">
                           <div class="col-lg-7 px-lg-4 mx-auto">
                              <h2 class="mb-4">Add Delivery Boy</h2>
                              <!--<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>-->
                              <form id="loginForm" method="POST" action="<?php echo base_url().'vendor/delivery_boy/insert_record'; ?>" class="mt-4" enctype='multipart/form-data'>
                                  <input type="hidden" name="fk_vendor" id="fk_vendor" value="<?php echo $_SESSION['fk_vendor'];?>">
                                 <div class="form-group mb-4">
                                     <input type="text" name="var_name" id="var_name" placeholder="Name" required="" class="form-control border-0 shadow form-control-lg">
                                 </div>
                                 <div class="form-group mb-4">
                                     <input type="email" name="email" id="email" placeholder="Email address" required="" class="form-control border-0 shadow form-control-lg">
                                 </div>
                                 <div class="form-group mb-4">
                                     <input type="text" name="phone" id="phone" onkeypress="return isNumberKey(event);" placeholder="Phone Number" required="" class="form-control border-0 shadow form-control-lg">
                                 </div>
                                 <div class="form-group mb-4">
                                     <input type="password" name="password" id="password" placeholder="Password" required="" class="form-control border-0 shadow form-control-lg text-violet">
                                 </div>
                                 <div class="form-group mb-4">
                                    <!-- <div class="custom-control custom-checkbox">
                                       <input id="customCheck1" type="checkbox" checked class="custom-control-input">
                                       <label for="customCheck1" class="custom-control-label">Remember Me</label>
                                       </div> -->
                                 </div>
                                 <div class="form-group">
                                    <label class=newbtn>
                                       <img id="blah" src="<?php echo base_url();?>public/vendor_assets/img/add.png" >
                                       <p>Profile</p>
                                       <input id="var_image" name="var_image" class='pis' onchange="readURL(this);" type="file" >
                                    </label>
                                    <label class=newbtn>
                                       <img id="blah" name="" src="<?php echo base_url();?>public/vendor_assets/img/add.png" >
                                       <p>Aadhar Card</p>
                                       <input id="var_aadhar" name="var_aadhar" class='pis' onchange="readURL(this);" type="file" >
                                    </label>
                                    <label class=newbtn>
                                       <img id="blah" name="" src="<?php echo base_url();?>public/vendor_assets/img/add.png" >
                                       <p>Aadhar Card2</p>
                                       <input id="var_aadhar2" name="var_aadhar2" class='pis' onchange="readURL(this);" type="file" >
                                    </label>
                                     <label class=newbtn>
                                       <img id="blah" name="" src="<?php echo base_url();?>public/vendor_assets/img/add.png" >
                                       <p>Pan Card</p>
                                       <input id="var_pancard" name="var_pancard" class='pis' onchange="readURL(this);" type="file" >
                                    </label>
                                 </div>
                                 <button type="submit" class="btn btn-primary shadow px-5">Submit</button>
                                 <button type="reset" name="cancel" class="btn btn-dark waves-effect waves-light">Cancel</button>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </section>
            </div>
<script type="text/javascript">
var site_path = '<?php echo base_url(); ?>';
    
$(function(){
    $('button[name=cancel]').click(function(){
        window.location = site_path+'vendor/delivery_boy';
    });
});
</script>