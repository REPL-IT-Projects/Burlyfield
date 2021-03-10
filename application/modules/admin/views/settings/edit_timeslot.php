<form action="<?php echo base_url(); ?>admin/settings/update_timeslot" method="POST" id="addon_form" class="form-horizontal" enctype='multipart/form-data'>
  <input type="hidden" name="fk_timeslot" id="fk_timeslot" value="<?php echo $data['int_glcode']; ?>">
  <div class="form-group row">
    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Start Time<span class="mandatory">*</span></label>
    <div class="col-sm-9">
      <input type="text" name="dt_start_time" class="form-control" id="dt_start_time" value="<?php echo $data['dt_start_time']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="dt_end_time" class="col-sm-3 text-right control-label col-form-label">End Time<span class="mandatory">*</span></label>
    <div class="col-sm-9">
      <input type="text" name="dt_end_time" class="form-control" id="dt_end_time" value="<?php echo $data['dt_end_time']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="dt_end_time" class="col-sm-3 text-right control-label col-form-label">Slot End Time<span class="mandatory">*</span></label>
    <div class="col-sm-9">
      <input type="text" name="dt_slot_end_time" class="form-control" id="dt_slot_end_time" value="<?php echo $data['dt_slot_end_time']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="type" class="col-sm-3 text-right control-label">Delivery Type</label>
    <div class="col-sm-7">
      <div class="form-check form-check-inline">
        <div class="custom-control custom-radio">
          <input type="radio" class="custom-control-input" id="superfast" value="S" name="delivery_type" <?php if ($data['chr_type'] == 'S') { echo "checked" ;} ?> >
          <label class="custom-control-label" for="superfast">Superfast</label>
        </div>
      </div>
      <div class="form-check form-check-inline">
        <div class="custom-control custom-radio">
          <input type="radio" class="custom-control-input" id="ultrafast" value="U" name="delivery_type" <?php if ($data['chr_type'] == 'U') { echo "checked" ;} ?>>
          <label class="custom-control-label" for="ultrafast">Ultrafast</label>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" id="btn_addon" class="btn btn-success">Save</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</form>