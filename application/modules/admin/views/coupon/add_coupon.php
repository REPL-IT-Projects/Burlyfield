<div id="main-wrapper">
<div class="page-wrapper">
	<div class="page-breadcrumb">
	 <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Add Promocode</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/coupon">View Promocode</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Promocode</li>
                        </ol>
                    </nav>
                </div>
            </div>
       </div>
   </div>


<div class="container-fluid">

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-info alert-dismissible fade show mt-4" role="alert">
                        <span class="badge badge-info"><i class="fas fa-info"></i></span>
                        <strong> Add new Promocode.</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
               
                <hr>
                    <form action="<?php echo base_url() ?>admin/coupon/insert_coupon" method="POST" class="form-horizontal" enctype='multipart/form-data'>
                    
                        <div class="form-body">
							<div class="form-group row">
								<label class="control-label text-right col-md-3">Promo Code</label>
								<div class="col-md-5">
                                                                    <input type="text" placeholder="Please enter Promo Code" class="form-control" name="var_promocode" id="var_promocode" required>
								</div>
							</div>
                                                    <div class="form-group row">
								<label class="control-label text-right col-md-3">Discount Percentage</label>
								<div class="col-md-5">
                                                                    <input type="text" onkeypress="return isNumberKey(event);" placeholder="Please enter Discount Percentage" class="form-control" name="var_percentage" id="var_percentage" required>
								</div>
							</div>
                            <div class="form-group row">
								<label class="control-label text-right col-md-3">Max Discount Price</label>
								<div class="col-md-5">
                                                                    <input type="text" onkeypress="return isNumberKey(event);" placeholder="Please enter Maximum Discount Price" class="form-control" name="var_price" id="var_price" required>
								</div>
							</div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Min Order Price</label>
                                <div class="col-md-5">
                                    <input type="text" onkeypress="return isNumberKey(event);" placeholder="Please enter Minimum Order Price" class="form-control" name="min_order" id="min_order" required>
                                </div>
                            </div>
                                                    <div class="form-group row">
								<label class="control-label text-right col-md-3">Apply No. of time</label>
								<div class="col-md-5">
                                                                    <input type="text" onkeypress="return isNumberKey(event);" placeholder="Please enter No. of time apply code per user" class="form-control" name="no_of_time" id="no_of_time" required>
								</div>
							</div>
							<div class="form-group row">
								<label class="control-label text-right col-md-3">Expiry Date</label>
								<div class="col-md-5">
                                                                    <input type="text" placeholder="Please enter Expiry Date" class="form-control" name="expiry_date" id="expiry_date" required>
								</div>
							</div>
                            
                            <div class="form-group row">
								<label class="control-label text-right col-md-3">Description</label>
								<div class="col-md-5">
                                                                    <textarea placeholder="Please enter Description" class="form-control" name="txt_description" id="txt_description" required></textarea>
								</div>
							</div>
                                                    
						</div>
                        <div class="card-body">
                        <div class="form-group mb-0 text-center">
                            <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                            <button type="reset" class="btn btn-dark waves-effect waves-light" name="cancel">Cancel</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script>
  $( function() {
    $( "#expiry_date" ).datepicker({
        dateFormat: 'dd-mm-yy'
    });
  } );
  
  var site_path = '<?php echo base_url();?>';

	$(function(){
		$('button[name=cancel]').click(function(){
			window.location = site_path+'admin/coupon';
		});
	});
  </script>