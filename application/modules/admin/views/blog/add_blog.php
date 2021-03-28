<script type="text/javascript" src="https://cdn.ckeditor.com/4.12.1/standard-all/ckeditor.js"></script>
<style>
    .parent_name {
        font-weight: bold;
        color: #CF4916 !important;
    }
    .imageThumb {
                    width: 20%;
                }
</style>
<div id="main-wrapper">
  <div class="page-wrapper">
    <div class="page-breadcrumb">
     <div class="row">
      <div class="col-5 align-self-center">
        <h4 class="page-title">Blog</h4>
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/user">View Blog</a></li>
              <li class="breadcrumb-item active" aria-current="page">Add Blog</li>
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
        <form action="<?php echo base_url() ?>admin/blog/insert_record" method="POST" class="form-horizontal" enctype='multipart/form-data'>
          <div class="card-body">
            <div class="form-group row">
              <label for="var_name" class="col-sm-3 text-right control-label col-form-label">Name<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="var_name" name="var_name" placeholder="Name Here" required="">
              </div>
            </div>
            <div class="form-group row">
                <label for="var_quantity" class="col-sm-3 text-right control-label col-form-label">Short Description</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="short_desc" name="short_desc" placeholder="Product Short Description Here">
                    </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-sm-3 text-right control-label col-form-label">Description<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                         <textarea id="txt_description" class="form-control" name="txt_description" placeholder="Product Description Here"><?php echo $data['txt_description']; ?></textarea>
                   </div>
            </div>
            <div class="form-group row">
              <label for="var_author" class="col-sm-3 text-right control-label col-form-label">Author Name<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="var_author" name="var_author" placeholder="Author Name Here" required="">
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
   
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript">
  var site_path = '<?php echo base_url(); ?>';
  $(function(){
    $('button[name=cancel]').click(function(){
        window.location = site_path+'admin/blog';
    });
});

</script>



<script type="text/javascript">
$(document).ready(function (){
  CKEDITOR.replace('txt_description');
});
</script>

    



