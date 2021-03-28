<div id="main-wrapper">
    <div class="page-wrapper">
       <div class="page-breadcrumb">
          <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Testimonial</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/user">View Testimonial</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Testimonial</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form method="POST" action="<?php echo base_url().'admin/testimonial/update_testimonial/'.$data['int_glcode']; ?>" class="form-horizontal" enctype='multipart/form-data'>
                    <div class="card-body">
                      <div class="form-group row">
              <label for="var_name" class="col-sm-3 text-right control-label col-form-label">Name<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                  <input type="text" class="form-control" id="var_name" name="var_name" value="<?php echo $data['var_name']; ?>" placeholder="Name Here" required="">
              </div>
            </div>
            <div class="form-group row">
              <label for="var_username" class="col-sm-3 text-right control-label col-form-label">Position</label>
              <div class="col-sm-7">
                  <input type="text" class="form-control" id="var_position" name="var_position" value="<?php echo $data['var_position']; ?>" placeholder="Position Here" required="">
              </div>
            </div>
			<!--City added 21/03/2021-->
			<div class="form-group row">
              <label for="city" class="col-sm-3 text-right control-label col-form-label">City<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                  <input type="text" class="form-control" id="var_city" name="var_city" placeholder="City Here" required="">
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-sm-3 text-right control-label col-form-label">Description<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                  <textarea class="form-control" id="txt_description" name="txt_description" placeholder="Description Here" required><?php echo $data['txt_description']; ?></textarea>
              </div>
            </div>
         
        <div class="form-group row">
            <label for="var_image" class="col-sm-3 text-right control-label col-form-label">Profile Image</label>
            <?php
            if ($data['var_image'] != '') {
                $Image = base_url().'uploads/testimonial/'.$data['var_image'];
            } else{
                $Image = base_url().'public/assets/images/site_imges/no_image.png';
            }
            ?>
            <div class="col-sm-7">
                <input type="file" class="form-control" id="var_image" name="var_image">
            </div>
            <a class="example-image-link" href="<?php echo $Image; ?>" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src="<?php echo $Image; ?>" id="cate_ig" alt="<?php echo $Image; ?>" /></a>
            <input type="hidden" name="hidvar_image" value="<?php echo $data['var_image']; ?>">
        </div>
        
    </div>
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
        window.location = site_path+'admin/testimonial';
    });
});

</script>
