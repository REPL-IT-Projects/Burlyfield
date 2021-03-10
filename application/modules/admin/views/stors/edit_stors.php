<div id="main-wrapper">
    <div class="page-wrapper">
       <div class="page-breadcrumb">
          <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Stores</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/user">View Stores</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Store</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form method="POST" action="<?php echo base_url().'admin/stors/update_stors/'.$data['int_glcode']; ?>" class="form-horizontal" enctype='multipart/form-data'>
                    <div class="card-body">
                      <div class="form-group row">
              <label for="var_name" class="col-sm-3 text-right control-label col-form-label">Name<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                  <input type="text" class="form-control" id="var_name" name="var_name" value="<?php echo $data['var_name']; ?>" placeholder="Name Here" required="">
              </div>
            </div>
            <div class="form-group row">
              <label for="var_address" class="col-sm-3 text-right control-label col-form-label">Address</label>
              <div class="col-sm-7">
                  <input type="text" class="form-control" id="var_address" name="var_address" value="<?php echo $data['var_address']; ?>" placeholder="Position Here" required="">
              </div>
            </div>
            <div class="form-group row">
              <label for="var_lat" class="col-sm-3 text-right control-label col-form-label">Latitude<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                  <input type="text" class="form-control" id="var_lat" name="var_lat" value="<?php echo $data['var_lat']; ?>" placeholder="Latitude Here" required="">
              </div>
            </div>
            <div class="form-group row">
              <label for="var_long" class="col-sm-3 text-right control-label col-form-label">Longitude<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                  <input type="text" class="form-control" id="var_long" name="var_long" value="<?php echo $data['var_long']; ?>" placeholder="Longitude Here" required="">
              </div>
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
        window.location = site_path+'admin/stors';
    });
});

</script>
