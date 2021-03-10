<form action="<?php echo base_url(); ?>admin/settings/update_reason" method="POST" id="addon_form" class="form-horizontal" enctype='multipart/form-data'>
  <input type="hidden" name="fk_reason" id="fk_reason" value="<?php echo $data['int_glcode']; ?>">
  <div class="form-group row">
    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Reason Title</label>
    <div class="col-sm-9">
      <textarea class="form-control" id="var_title" name="var_title" value="" required=""><?php echo $data['var_title']; ?></textarea>
    </div>
  </div>
<div class="modal-footer">
  <button type="submit" id="btn_addon" class="btn btn-success">Save</button>
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</form>