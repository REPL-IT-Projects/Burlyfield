<div id="main-wrapper">
  <div class="page-wrapper">
    <div class="page-breadcrumb">
     <div class="row">
      <div class="col-5 align-self-center">
        <h4 class="page-title">Pincode Details</h4>
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/pincode">View Pincode Details</a></li>
              <li class="breadcrumb-item active" aria-current="page">Add Pincode</li>
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
        <form action="<?php echo base_url() ?>admin/pincode/insert_record" method="POST" class="form-horizontal" enctype='multipart/form-data'>
          <div class="card-body">
            <div class="form-group row">
              <label for="var_name" class="col-sm-3 text-right control-label col-form-label">Enter Pincode<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="var_name" name="var_pincode" placeholder="Enter Pincode Here" required="">
              </div>
            </div>
            <div class="form-group row">
              <!--<div class="col-sm-7">-->
                    <label class="control-label text-right col-md-3">Status<span class="valid-text">*</span></label>
                        <div class="col-md-7">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="flag" class="custom-control-input" value="E" checked="">
                                <label class="custom-control-label" for="customRadioInline1">Enabled</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="flag" class="custom-control-input" value="D" >
                                    <label class="custom-control-label" for="customRadioInline2">Disabled</label>
                            </div>
                            <!--<div class="custom-control custom-radio custom-control-inline">-->
                            <!--        <input type="radio" id="customRadioInline3" name="chr_type" class="custom-control-input" value="Driving Licence" >-->
                            <!--        <label class="custom-control-label" for="customRadioInline3">Driving Licence</label>-->
                            <!--</div>-->
                            <!--<div class="custom-control custom-radio custom-control-inline">-->
                            <!--        <input type="radio" id="customRadioInline4" name="chr_type" class="custom-control-input" value="Voter ID" >-->
                            <!--        <label class="custom-control-label" for="customRadioInline4">Voter ID</label>-->
                            <!--</div>-->
                        </div>
                <!--<input type="text" class="form-control" id="var_username" name="var_username" placeholder="Username Here">-->
              <!--</div>-->
            </div>
            <!-- <div class="form-group row">
              <label for="email" class="col-sm-3 text-right control-label col-form-label">Day<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                <select class="form-control" id ="var_city" name="int_day" required="">
                    <option value="">--Select Day--</option>
                    <option value="1">Tuesday Or Friday</option>
                    <option value="2">Wednesday Or Saturday</option>
                    <option value="3">Thursday Or Sunday</option>
                </select>
              </div>
            </div> -->
        </div>
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
    window.location = site_path+'admin/pincode';
  });
});

</script>