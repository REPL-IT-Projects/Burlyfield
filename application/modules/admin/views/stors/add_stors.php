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
              <li class="breadcrumb-item active" aria-current="page">Add Store</li>
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
        <form action="<?php echo base_url() ?>admin/stors/insert_record" method="POST" class="form-horizontal" enctype='multipart/form-data'>
          <div class="card-body">
            <div class="form-group row">
              <label for="var_name" class="col-sm-3 text-right control-label col-form-label">Name<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="var_name" name="var_name" placeholder="Name Here" required="">
              </div>
            </div>
            <div class="form-group row">
              <label for="var_address" class="col-sm-3 text-right control-label col-form-label">Address<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                  <input type="text" class="form-control" id="var_address" name="var_address" placeholder="Address Here" required="">
              </div>
            </div>
			 <div class="form-group row">
				<label for="var_city" class="col-sm-3 text-right control-label col-form-label">City<span class="mandatory">*</span></label>
			 &nbsp;&nbsp;<select data-style="g-select" data-width="10%" name="var_state" class="form-control" style="width:200px">
							<option value="">Select City</option>
			            	<?php 
			            	$stor = $this->db->get('mst_city')->result_array();
			            	foreach($stor as $str) { ?>
			            		<option value="<?php echo $str['intglcode']; ?>"><?php echo $str['var_city']; ?></option>
			            	<?php } ?>
						</select>&emsp;&emsp; <button type="submit" class="btn btn-info waves-effect waves-light"  data-toggle="modal" data-target="#modal_AddCity">Add New City</button>
						
					<!--&emsp;&emsp; <br><i class="fa fa-plus" type="button" aria-hidden="true"  data-toggle="modal" data-target="#modal_AddCity"></i>-->
			</div>
			  
            <div class="form-group row">
              <label for="var_lat" class="col-sm-3 text-right control-label col-form-label">Latitude<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                  <input type="text" class="form-control" id="var_lat" name="var_lat" placeholder="Latitude Here" required="">
              </div>
            </div>
            <div class="form-group row">
              <label for="var_long" class="col-sm-3 text-right control-label col-form-label">Longitude<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                  <input type="text" class="form-control" id="var_long" name="var_long" placeholder="Longitude Here" required="">
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
 <div class="modal fade" id="modal_AddCity" >
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="btn btn-info waves-effect waves-light">
              	<h4 class="modal-title" style="color:#FFFFFF;">Add City</h4>
              		<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#FFFFFF;">
                		<span aria-hidden="true">&times;</span>
                	</button>
            </div>
            <div class="modal-body">
            <form method="post" role="form" enctype="multipart/form-data" action="<?php echo site_url('admin/Stors/insert_city') ?>" >
              <input type="hidden" name="txt_mpId" id="txt_mpId" value="<?php  echo $mpow->mp_id ?>"  class="form-control">
                <input type="hidden" name="txt_rctTrack_id" id="txt_rctTrack_id" value=""  class="form-control">
                <input type="hidden" name="txt_emp_code" id="txt_emp_code" value="<?php  echo $emp_code ?>"  class="form-control">
                <input type="hidden" name="txt_Dept_code" id="txt_Dept_code" value="<?php  echo $mpow->dept_code ?>" class="form-control" readonly>
                <input type="hidden" name="txt_plant_id" id="txt_plant_id" value="<?php  echo $mpow->plant_id ?>"  class="form-control" readonly>
                <input type="hidden" name="txt_Position_id" id="txt_Position_id"  value="<?php  echo $mpow->position_id ?>"  class="form-control" readonly>
        
            		<div class="col-sm-12">
                      <div class="form-group">
                        <label>Enter city Name:</label><span style="color:red;font-size:18px"><b> *</b></span>
                        <input type="text" name="txt_City" id="txt_City"  class="form-control" required></textarea>
                      </div>
                    </div>
                
            </div>
            <div class="modal-footer justify-content-between">
              <button type="reset" name="cancel" class="btn btn-dark waves-effect waves-light">Cancel</button>
              <button type="submit" class="btn btn-info waves-effect waves-light">Add</button>
            </div>
            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
	</div>
	
				

<script type="text/javascript">
var site_path = '<?php echo base_url(); ?>';
$(function(){
  $('button[name=cancel]').click(function(){
    window.location = site_path+'admin/stors';
  });
});

</script>
