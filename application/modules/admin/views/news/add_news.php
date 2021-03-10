<div id="main-wrapper">
  <div class="page-wrapper">
    <div class="page-breadcrumb">
     <div class="row">
      <div class="col-5 align-self-center">
        <h4 class="page-title">News Management</h4>
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/user">View News</a></li>
              <li class="breadcrumb-item active" aria-current="page">Add News</li>
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
        <form action="<?php echo base_url() ?>admin/news/insert_record" method="POST" class="form-horizontal" enctype='multipart/form-data'>
          <div class="card-body">
            <div class="form-group row">
              <label for="var_name" class="col-sm-3 text-right control-label col-form-label">Name<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="var_name" name="var_name" placeholder="Name Here" required="">
              </div>
            </div>
            
            <div class="form-group row">
              <label for="email" class="col-sm-3 text-right control-label col-form-label">Description<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                  <textarea class="form-control" id="txt_description" name="txt_description" placeholder="Description Here" required></textarea>
              </div>
            </div>
         
            <div class="form-group row">
              <label for="var_image" class="col-sm-3 text-right control-label col-form-label">Profile Image (size : 870 X 470 px)<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                  <input type="file" class="form-control" id="var_image" name="var_image" required="">
              </div>
            </div>
           
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
    window.location = site_path+'admin/news';
  });
});

</script>
