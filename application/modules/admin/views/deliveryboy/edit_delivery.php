<div id="main-wrapper">
    <div class="page-wrapper">
       <div class="page-breadcrumb">
          <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Delivery Boys</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/delivery_boy">View Delivery Boys</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Delivery Boy</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form method="POST" action="<?php echo base_url().'admin/delivery_boy/update_record/'.$data['int_glcode']; ?>" class="form-horizontal" enctype='multipart/form-data'>
                    <div class="card-body">
                      <div class="form-group row">
                        <label for="var_name" class="col-sm-3 text-right control-label col-form-label">Vendor<span class="mandatory">*</span></label>
                        <div class="col-sm-7">
                          <select id="fk_vendor" name="fk_vendor" class="form-control">
                            <?php
                            if (count($vendor) > 0) {
                              foreach ($vendor as $key => $value) { ?>
                                <option value="<?php echo $value['int_glcode']; ?>" <?php if ($value['int_glcode'] == $data['fk_vendor']) { echo "selected";} ?>><?php echo $value['var_name']; ?></option>
                            <?php } } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="var_name" class="col-sm-3 text-right control-label col-form-label">Name<span class="mandatory">*</span></label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="var_name" name="var_name" placeholder="Name Here" value="<?php echo $data['var_name']; ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 text-right control-label col-form-label">Email</label>
                        <div class="col-sm-7">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Here" value="<?php echo $data['var_email']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 text-right control-label col-form-label">Password<span class="mandatory">*</span></label>
                        <div class="col-sm-7">
                           <div class="icon_show">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password Here" value="<?php echo $this->mylibrary->decryptPass($data['var_password']); ?>" required="">
                            <a href="javascript:void(0)" class="show_password" onclick="toggle_password()"><i class="mr-2 mdi mdi-eye-outline show_pass"></i></a>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="date" class="col-sm-3 text-right control-label col-form-label">Mobile No.</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $data['var_mobile_no']; ?>" readonly>
                    </div>
                </div> 
                      <div class="form-group row">
                          <label for="var_image" class="col-sm-3 text-right control-label col-form-label">Profile Image</label>
                                <?php
                          if ($data['var_profile'] != '') {
                              $Image = base_url().'uploads/deliveryboy/'.$data['var_profile'];
                          } else{
                              $Image = base_url().'public/assets/images/site_imges/no_image.png';
                          }
                          ?>
                          <div class="col-sm-7">
                              <input type="file" class="form-control" id="var_image" name="var_image">
                          </div>
                          <a class="example-image-link" href="<?php echo $Image; ?>" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src="<?php echo $Image; ?>" id="cate_ig" alt="<?php echo $Image; ?>" /></a>
                          <input type="hidden" name="hidvar_image" value="<?php echo $data['var_profile']; ?>">
                      </div>
                      <div class="form-group row">
                          <label for="var_image" class="col-sm-3 text-right control-label col-form-label"> National ID 1</label>
                                <?php
                          if ($data['var_aadharcard'] != '') {
                              $aImage = base_url().'uploads/deliveryboy_docs/'.$data['var_aadharcard'];
                          } else{
                              $aImage = base_url().'public/assets/images/site_imges/no_image.png';
                          }
                          ?>
                          <div class="col-sm-7">
                              <input type="file" class="form-control" id="var_aadhar" name="var_aadhar">
                          </div>
                          <a class="example-image-link" href="<?php echo $aImage; ?>" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src="<?php echo $aImage; ?>" id="cate_ig" alt="<?php echo $aImage; ?>" /></a>
                          <input type="hidden" name="hidvar_aadhar" value="<?php echo $data['var_aadharcard']; ?>">
                      </div>
                      <div class="form-group row">
                          <label for="var_image" class="col-sm-3 text-right control-label col-form-label">National ID 2</label>
                                <?php
                          if ($data['var_aadharcard2'] != '') {
                              $aImage2 = base_url().'uploads/deliveryboy_docs/'.$data['var_aadharcard2'];
                          } else{
                              $aImage2 = base_url().'public/assets/images/site_imges/no_image.png';
                          }
                          ?>
                          <div class="col-sm-7">
                              <input type="file" class="form-control" id="var_aadhar2" name="var_aadhar2">
                          </div>
                          <a class="example-image-link" href="<?php echo $aImage2; ?>" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src="<?php echo $aImage2; ?>" id="cate_ig" alt="<?php echo $aImage2; ?>" /></a>
                          <input type="hidden" name="hidvar_aadhar2" value="<?php echo $data['var_aadharcard2']; ?>">
                      </div>
                      <div class="form-group row">
                          <label for="var_image" class="col-sm-3 text-right control-label col-form-label">Vehicle image with number plate</label>
                                <?php
                          if ($data['var_pancard'] != '') {
                              $pImage = base_url().'uploads/deliveryboy_docs/'.$data['var_pancard'];
                          } else{
                              $pImage = base_url().'public/assets/images/site_imges/no_image.png';
                          }
                          ?>
                          <div class="col-sm-7">
                              <input type="file" class="form-control" id="var_pancard" name="var_pancard">
                          </div>
                          <a class="example-image-link" href="<?php echo $pImage; ?>" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src="<?php echo $pImage; ?>" id="cate_ig" alt="<?php echo $pImage; ?>" /></a>
                          <input type="hidden" name="hidvar_pancard" value="<?php echo $data['var_pancard']; ?>">
                      </div>
                  </div>
                <hr>
            <div class="card-body">
                <div class="form-group mb-0 text-center">
                    <button type="submit" name="submit" class="btn btn-info waves-effect waves-light">Save</button>
                    <button type="reset" name="cancel" class="btn btn-dark waves-effect waves-light">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>          
</div>
</div>

<script type="text/javascript">

var site_path = '<?php echo base_url(); ?>';
    
$(function(){
    $('button[name=cancel]').click(function(){
        window.location = site_path+'admin/delivery_boy';
    });
});

function toggle_password() {
    var x = document.getElementById("password");
     if (x.type === "password") {
         x.type = "text";
     } else {
         x.type = "password";
     }
 }
</script>
