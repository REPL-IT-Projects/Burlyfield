<div class="page-holder w-100 d-flex flex-wrap">
            <div class="container-fluid px-xl-5">
<section>
                  <div class="page-holder d-flex align-items-center">
                     <div class="container">
                         
                        <div class="row align-items-center py-5">
                           <div class="col-lg-10 px-lg-4 mx-auto">
                              <h2 class="mb-4">Edit Profile</h2>
                              <?php echo validation_errors(); ?>
                                <?php if($this->session->flashdata('Invalid') != ''){ ?>
                                    <div class="alert alert-success hide_msg">
                                        <p><?php echo $this->session->flashdata('Invalid');?></p>
                                    </div>
                                <?php } ?>
                              <form method="POST" action="<?php echo base_url().'vendor/profile/update_vendor/'.$data['int_glcode']; ?>" class="form-horizontal" enctype='multipart/form-data'>
                                    <div class="card-body" style="border: 1px solid #e8e8e8;border-radius: 5px;">
                                      <div class="form-group row">
                                        <label for="var_name" class="col-sm-3 control-label col-form-label">Name<span class="mandatory">*</span></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="var_name" name="var_name" placeholder="Name Here" value="<?php echo $data['var_name']; ?>" required>
                                        </div>
                                    </div>
                                 
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 control-label col-form-label">Email</label>
                                        <div class="col-sm-7">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Here" value="<?php echo $data['var_email']; ?>" readonly>
                                        </div>
                                    </div>
                                    
                                <div class="form-group row">
                                    <label for="date" class="col-sm-3 control-label col-form-label">Phone</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $data['var_mobile_no']; ?>" readonly>
                                    </div>
                                </div>
                                        
                                        <div class="form-group row">
                                        <label for="email" class="col-sm-3 control-label col-form-label">Password</label>
                                        <div class="col-sm-7">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password Here" value="<?php echo $this->mylibrary->decryptPass($data['var_password']); ?>" >
                                        </div>
                                    </div>
                                        
<!--                              <div class="form-group row">
                                <label for="get_location" class="col-sm-3 control-label col-form-label"></label>
                                <div class="col-sm-7">
                                  <button type="button" class="btn btn-warning" id="getLocation">Get Location</button>
                                </div>
                              </div>-->
                              <div class="form-group row">
                                <label for="var_address" class="col-sm-3 control-label col-form-label">Address<span class="mandatory">*</span></label>
                                <div class="col-sm-7">
                                  <textarea id="var_address" class="form-control" name="var_address" required=""><?php echo $data['var_address']; ?></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="var_latitude" class="col-sm-3 control-label col-form-label">Latitude</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="var_latitude" name="var_latitude" placeholder="Latitude Here" value="<?php echo $data['var_latitude']; ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="var_longitude" class="col-sm-3 control-label col-form-label">Longitude </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="var_longitude" name="var_longitude" placeholder="Longitude  Here" value="<?php echo $data['var_longitude']; ?>">
                                </div>
                              </div>
                        <div class="form-group row">
                            <label for="var_image" class="col-sm-3 control-label col-form-label">Profile Image</label>
                                  <?php
                            if ($data['var_image'] != '') {
                                $Image = base_url().'uploads/vendor/'.$data['var_image'];
                            } else{
                                $Image = base_url().'public/assets/images/site_imges/no_image.png';
                            }
                            ?>
                            <div class="col-sm-7">
                                <input type="file" class="form-control" id="var_image" name="var_image">
                            </div>
                            <a class="example-image-link" href="<?php echo $Image; ?>" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img style="width: 50px;" class="example-image" src="<?php echo $Image; ?>" id="cate_ig" alt="<?php echo $Image; ?>" /></a>
                            <input type="hidden" name="hidvar_image" value="<?php echo $data['var_image']; ?>">
                        </div>
                   

                    </div>
                            <div class="card-body">
                                <div class="form-group mb-0 text-center">
                                    <button type="submit" name="submit" class="btn btn-info waves-effect waves-light">Update</button>
                                    <button type="reset" name="cancel" class="btn btn-dark waves-effect waves-light">Cancel</button>
                                </div>
                            </div>
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
        window.location = site_path+'vendor';
    });
});

$(document).ready(function(){
  $("#getLocation").click(function(){
    showPosition();
  });
});

  function showPosition(){
        navigator.geolocation.getCurrentPosition(function(position){
            var lat = position.coords.latitude;
            var long = position.coords.longitude;
   
          $.get( "https://maps.googleapis.com/maps/api/geocode/json?latlng="+ lat + "," + long +"&location_type=ROOFTOP&key=AIzaSyB-C0OZhzDLjWdpc-iFCZqd2YNX_1eu6_A", function(data) {
             console.log(data);
             var response = data.results[0].formatted_address;

             document.getElementById('var_address').value = response;
             document.getElementById('var_latitude').value = lat;
             document.getElementById('var_longitude').value = long;
          });

        });
}
</script>
