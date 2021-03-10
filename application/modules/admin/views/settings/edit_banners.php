<form action="<?php echo base_url(); ?>admin/settings/update_banner" method="POST" id="addon_form" class="form-horizontal" enctype='multipart/form-data'>
  <input type="hidden" name="fk_banner" id="fk_banner" value="<?php echo $data['int_glcode']; ?>">
  <div class="form-group row">
    <label for="var_title" class="col-sm-3 text-right control-label col-form-label">Heading Title<span class="mandatory">*</span></label>
    <div class="col-sm-9">
      <input type="text" name="var_title" id="var_title" class="form-control" required="" value="<?php echo $data['var_title']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="txt_description" class="col-sm-3 text-right control-label col-form-label">Description<span class="mandatory">*</span></label>
    <div class="col-sm-9">
      <textarea name="txt_description" id="txt_description" class="form-control" required=""><?php echo $data['txt_description']; ?></textarea>
    </div>
  </div>
  <div class="form-group row">
        <label for="var_image" class="col-sm-3 text-right control-label col-form-label">Banner Image<span class="mandatory">*</span></label>
        <?php
	        if ($data['var_image'] != '') {
	            $Image = base_url().'uploads/banner_img/'.$data['var_image'];
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
<div class="modal-footer">
  <button type="submit" id="btn_addon" class="btn btn-success">Save</button>
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</form>