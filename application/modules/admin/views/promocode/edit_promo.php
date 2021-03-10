<form action="<?php echo base_url(); ?>admin/promocode/update_record" method="POST" id="edit_promocode_form" class="form-horizontal" enctype='multipart/form-data'>
  <input type="hidden" name="fk_promocode" id="fk_promocode" value="<?php echo $data['int_glcode']; ?>">
  <div class="form-group row">
    <label for="var_title" class="col-sm-3 text-right control-label col-form-label">Title<span class="mandatory">*</span></label>
    <div class="col-sm-9">
      <input type="text" name="var_title" id="var_title" class="form-control" required="" value="<?php echo $data['var_promocode']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="var_title" class="col-sm-3 text-right control-label col-form-label">Value Type<span class="mandatory">*</span></label>
     <div class="form-check form-check-inline">
        <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="var_type_edit" name="chr_type" <?php if ($data['chr_type'] == 'P') { echo "checked";} ?> value="P">
            <label class="custom-control-label" for="var_type_edit">Percentage</label>
        </div>
    </div>
    <div class="form-check form-check-inline">
        <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="var_type_edit1" name="chr_type" value="A" <?php if ($data['chr_type'] == 'A') { echo "checked";} ?> >
            <label class="custom-control-label" for="var_type_edit1">Amount</label>
        </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="var_value" class="col-sm-3 text-right control-label col-form-label">
      Value<span class="mandatory">*</span></label>
    <div class="col-sm-9">
      <input type="text" name="var_value" id="var_value" placeholder="Enter promocode value" class="form-control" required="" value="<?php echo $data['var_amount']; ?>">
    </div>
  </div>
<div class="modal-footer">
  <button type="submit" id="btn_addon" class="btn btn-success">Save</button>
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</form>