<div id="main-wrapper">
<div class="page-wrapper">
	<div class="page-breadcrumb">
	 <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Edit Promocode</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/coupon">View Promocode</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Promocode</li>
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
                    
                    <form action="<?php echo base_url() . 'admin/coupon/update_coupon/'.$coupon['int_glcode']; ?>" method="POST" class="form-horizontal" enctype='multipart/form-data'>

                        <div class="form-body">
							<div class="form-group row">
								<label class="control-label text-right col-md-3">Promo Code</label>
								<div class="col-md-5">
                                                                    <input type="text" placeholder="Please enter Promo Code" value="<?php echo $coupon['var_promocode'];?>" class="form-control" name="var_promocode" id="var_promocode" required>
								</div>
							</div>
                                                    <div class="form-group row">
								<label class="control-label text-right col-md-3">Discount Percentage</label>
								<div class="col-md-5">
                                                                    <input type="text" onkeypress="return isNumberKey(event);" placeholder="Please enter Discount Percentage" value="<?php echo $coupon['var_percentage'];?>" class="form-control" name="var_percentage" id="var_percentage" required>
								</div>
							</div>
                            <div class="form-group row">
								<label class="control-label text-right col-md-3">Max Discount Price</label>
								<div class="col-md-5">
                                                                    <input type="text" onkeypress="return isNumberKey(event);" placeholder="Please enter Maximum Discount Price" class="form-control" value="<?php echo $coupon['var_price'];?>" name="var_price" id="var_price" required>
								</div>
							</div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Min Order Price</label>
                                <div class="col-md-5">
                                    <input type="text" onkeypress="return isNumberKey(event);" placeholder="Please enter Minimum Order Price" class="form-control" name="min_order" id="min_order" value="<?php echo $coupon['min_order'];?>" required>
                                </div>
                            </div>
                                                    <div class="form-group row">
								<label class="control-label text-right col-md-3">Apply No. of time</label>
								<div class="col-md-5">
                                                                    <input type="text" onkeypress="return isNumberKey(event);" placeholder="Please enter No. of time apply code per user" value="<?php echo $coupon['no_of_time'];?>" class="form-control" name="no_of_time" id="no_of_time" required>
								</div>
							</div>
							<div class="form-group row">
								<label class="control-label text-right col-md-3">Expiry Date</label>
								<div class="col-md-5">
                                                                    <input type="text" placeholder="Please enter Expiry Date" value="<?php echo $coupon['expiry_date'];?>" class="form-control" name="expiry_date" id="expiry_date" required>
								</div>
							</div>
                            <div class="form-group row">
								<label class="control-label text-right col-md-3">Description</label>
								<div class="col-md-5">
                                                                    <textarea placeholder="Please enter Description" class="form-control" name="txt_description" id="txt_description" required><?php echo $coupon['txt_description'];?></textarea>
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