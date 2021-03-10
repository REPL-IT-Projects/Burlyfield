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
              <li class="breadcrumb-item active" aria-current="page">Add Delivery Boy</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <?php echo validation_errors(); ?>
  <?php if($this->session->flashdata('Invalid') != ''){ ?>
    <div class="alert alert-danger hide_msg">
      <p><?php echo $this->session->flashdata('Invalid');?></p>
    </div>
  <?php } ?>
  <div class="container-fluid">
   <div class="row">
    <div class="col-12">
      <div class="card card-body">
        <form action="<?php echo base_url() ?>admin/delivery_boy/insert_record" method="POST" class="form-horizontal" enctype='multipart/form-data'>
          <div class="card-body">
            <div class="form-group row">
              <label for="var_name" class="col-sm-3 text-right control-label col-form-label">Vendor<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                <select id="fk_vendor" name="fk_vendor" class="form-control">
                  <option disabled="" selected="">----- Select Vendor -----</option>
                  <?php
                  if (count($vendor) > 0) {
                    foreach ($vendor as $key => $value) { ?>
                      <option value="<?php echo $value['int_glcode']; ?>"><?php echo $value['var_name']; ?></option>
                  <?php } } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="var_name" class="col-sm-3 text-right control-label col-form-label">Name<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="var_name" name="var_name" placeholder="Name Here" required="">
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-sm-3 text-right control-label col-form-label">Email<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Here" required="">
              </div>
            </div>
            <div class="form-group row">
              <label for="password" class="col-sm-3 text-right control-label col-form-label">Password<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password Here" required="">
                <span id="message"></span>
              </div>
            </div>
            <div class="form-group row">
              <label for="phone" class="col-sm-3 text-right control-label col-form-label">Mobile No.<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="phone" name="phone" onkeypress="return isNumberKey(event);" minlength="10" maxlength="10" placeholder="Mobile No. here" required="">
              </div>
            </div>
            <div class="form-group row">
              <label for="var_image" class="col-sm-3 text-right control-label col-form-label">Profile Image</label>
              <div class="col-sm-7">
                <input type="file" class="form-control" id="var_image" name="var_image">
              </div>
            </div>
            <div class="form-group row">
              <label for="var_aadhar" class="col-sm-3 text-right control-label col-form-label">National ID 1</label>
              <div class="col-sm-7">
                <input type="file" class="form-control" id="var_aadhar" name="var_aadhar">
              </div>
            </div>
            <div class="form-group row">
              <label for="var_aadhar2" class="col-sm-3 text-right control-label col-form-label">National ID 2</label>
              <div class="col-sm-7">
                <input type="file" class="form-control" id="var_aadhar2" name="var_aadhar2">
              </div>
            </div>
            <div class="form-group row">
              <label for="var_pancard" class="col-sm-3 text-right control-label col-form-label">Vehicle image with number plate</label>
              <div class="col-sm-7">
                <input type="file" class="form-control" id="var_pancard" name="var_pancard">
              </div>
            </div>
          </div>
          <hr>
          <div class="card-body">
            <div class="form-group mb-0 text-center">
              <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
              <button type="reset" name="cancel" class="btn btn-dark waves-effect waves-light">Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>          
</div>
</div>
</div>
<script type="text/javascript">
var site_path = '<?php echo base_url(); ?>';
    
$(function(){
    $('button[name=cancel]').click(function(){
        window.location = site_path+'admin/vendor';
    });
});
</script>