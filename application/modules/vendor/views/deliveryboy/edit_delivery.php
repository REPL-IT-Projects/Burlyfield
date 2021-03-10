<div class="page-holder w-100 d-flex flex-wrap">
            <div class="container-fluid px-xl-5">
<section>
                  <div class="page-holder d-flex align-items-center">
                     <div class="container">
                        <div class="row align-items-center py-5">
                           <div class="col-lg-7 px-lg-4 mx-auto">
                              <h2 class="mb-4">Edit Delivery Boy</h2>
                              <!--<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>-->
                              <form id="loginForm" method="POST" action="<?php echo base_url().'vendor/delivery_boy/update_record/'.$data['int_glcode']; ?>" class="mt-4" enctype='multipart/form-data'>
                                  <input type="hidden" name="fk_vendor" id="fk_vendor" value="<?php echo $_SESSION['fk_vendor'];?>">
                                 <div class="form-group mb-4">
                                     <input type="text" name="var_name" id="var_name" placeholder="Name" value="<?php echo $data['var_name'];?>" required="" class="form-control border-0 shadow form-control-lg">
                                 </div>
                                 <div class="form-group mb-4">
                                     <input type="email" name="email" id="email" placeholder="Email address" value="<?php echo $data['var_email'];?>" required="" class="form-control border-0 shadow form-control-lg">
                                 </div>
                                 <div class="form-group mb-4">
                                     <input type="text" name="phone" id="phone" placeholder="Phone Number" value="<?php echo $data['var_mobile_no'];?>" required="" class="form-control border-0 shadow form-control-lg">
                                 </div>
                                 <div class="form-group mb-4">
                                     <input type="password" name="password" id="password" placeholder="Password" value="<?php echo $this->mylibrary->decryptPass($data['var_password']);?>" required="" class="form-control border-0 shadow form-control-lg text-violet">
                                 </div>
                                 <div class="form-group mb-4">
                                    <!-- <div class="custom-control custom-checkbox">
                                       <input id="customCheck1" type="checkbox" checked class="custom-control-input">
                                       <label for="customCheck1" class="custom-control-label">Remember Me</label>
                                       </div> -->
                                 </div>
                                 <div class="form-group">
                                    <label class=newbtn>
                                        <?php
                                        if ($data['var_profile'] != '') {
                                            $Image = base_url().'uploads/deliveryboy/'.$data['var_profile'];
                                        } else{
                                            $Image = base_url().'public/assets/images/site_imges/no_image.png';
                                        }
                                        ?>
                                       <img id="blah" src="<?php echo base_url();?>public/vendor_assets/img/add.png" >
                                       <p>Profile</p>
                                       <input id="var_image" name="var_image" class='pis' onchange="readURL(this);" type="file" >
                                       <a class="example-image-link" href="<?php echo $Image; ?>" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img style="width: 100px;" class="example-image" src="<?php echo $Image; ?>" id="cate_ig" alt="<?php echo $Image; ?>" /></a>
                                        <input type="hidden" name="hidvar_image" value="<?php echo $data['var_profile']; ?>">
                                    </label>
                                    <label class=newbtn>
                                        <?php
                                        if ($data['var_aadharcard'] != '') {
                                            $aImage = base_url().'uploads/deliveryboy_docs/'.$data['var_aadharcard'];
                                        } else{
                                            $aImage = base_url().'public/assets/images/site_imges/no_image.png';
                                        }
                                        ?>
                                       <img id="blah" name="" src="<?php echo base_url();?>public/vendor_assets/img/add.png" >
                                       <p>Aadhar Card</p>
                                       <input id="var_aadhar" name="var_aadhar" class='pis' onchange="readURL(this);" type="file" >
                                       <a class="example-image-link" href="<?php echo $aImage; ?>" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img style="width: 100px;" class="example-image" src="<?php echo $aImage; ?>" id="cate_ig" alt="<?php echo $aImage; ?>" /></a>
                                        <input type="hidden" name="hidvar_aadhar" value="<?php echo $data['var_aadharcard']; ?>">
                                    </label>
                                    <label class=newbtn>
                                        <?php
                                        if ($data['var_aadharcard2'] != '') {
                                            $aImage2 = base_url().'uploads/deliveryboy_docs/'.$data['var_aadharcard2'];
                                        } else{
                                            $aImage2 = base_url().'public/assets/images/site_imges/no_image.png';
                                        }
                                        ?>
                                       <img id="blah" name="" src="<?php echo base_url();?>public/vendor_assets/img/add.png" >
                                       <p>Aadhar Card2</p>
                                       <input id="var_aadhar2" name="var_aadhar2" class='pis' onchange="readURL(this);" type="file" >
                                       <a class="example-image-link" href="<?php echo $aImage2; ?>" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img style="width: 100px;" class="example-image" src="<?php echo $aImage2; ?>" id="cate_ig" alt="<?php echo $aImage2; ?>" /></a>
                                        <input type="hidden" name="hidvar_aadhar2" value="<?php echo $data['var_aadharcard2']; ?>">
                                    </label>
                                     <label class=newbtn>
                                         <?php
                                            if ($data['var_pancard'] != '') {
                                                $pImage = base_url().'uploads/deliveryboy_docs/'.$data['var_pancard'];
                                            } else{
                                                $pImage = base_url().'public/assets/images/site_imges/no_image.png';
                                            }
                                            ?>
                                       <img id="blah" name="" src="<?php echo base_url();?>public/vendor_assets/img/add.png" >
                                       <p>Pan Card</p>
                                       <input id="var_pancard" name="var_pancard" class='pis' onchange="readURL(this);" type="file" >
                                       <a class="example-image-link" href="<?php echo $pImage; ?>" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img style="width: 100px;" class="example-image" src="<?php echo $pImage; ?>" id="cate_ig" alt="<?php echo $pImage; ?>" /></a>
                                        <input type="hidden" name="hidvar_pancard" value="<?php echo $data['var_pancard']; ?>">
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