<!-- <section class="breadcrumb-area" style="background-image:url(<?php echo base_url();?>public/front_assets/images/background/2.jpg);"> -->
			   <!--  <div class="container">
			        <div class="row">
			            <div class="col-md-12">
			                <div class="breadcrumbs text-center">
			                    <h1>My Order List</h1>
			                    <h4>Welcome to certified Gramango</h4>
			                </div>
			            </div>
			        </div>
			    </div>
				<div class="breadcrumb-bottom-area">
				    <div class="container">
				        <div class="row">
				            <div class="col-lg-8 col-md-5 col-sm-5">
				                <ul>
				                    <li><a href="<?php echo base_url();?>">Home</a></li>
				                    <li><a href=""><i class="fa fa-angle-right"></i></a></li>
				                    <li>My Order List</li> 
				                </ul>
				            </div>
				            <div class="col-lg-4 col-md-7 col-sm-7">
				                <p>We provide <span>100% organic</span> products</p>
				            </div>
				        </div>
				    </div>
				</div> -->
			    
			<!-- </section> -->

<section class="about-story">
      <div class="container">
         
<div class="order-list-tabel-main table-responsive">
   <table class="datatabel table table-striped table-bordered" width="100%" cellspacing="0">
      <thead>
         <tr>
            <th>OrderID #</th>
            <th>Date Purchased</th>
            <th>Payment Mode</th>
            <th>Status</th>
            <th>Total</th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>
         <?php 
         if (count($data) > 0) {
            foreach ($data as $key => $value) {
               

               if ($value['chr_status'] == 'P') {
                  $status_class = 'warning';
                  $status_lable = 'Pending';
               } elseif ($value['chr_status'] == 'W') {
                  $status_class = 'info';
                  $status_lable = 'In Progress';
               } elseif ($value['chr_status'] == 'S') {
                  $status_class = 'success';
                  $status_lable = 'Completed';
               } elseif ($value['chr_status'] == 'R') {
                  $status_class = 'danger';
                  $status_lable = 'Rejected';
               } elseif ($value['chr_status'] == 'T') {
                  $status_class = 'info';
                  $status_lable = 'Return';
               } 

               if ($value['chr_status'] != 'R') { 
                    $btn_click = 'onclick="cancelOrder('.$value['int_glcode'].');"';
                    $btn_lbl = 'Cancel';
               } else {
                    $btn_click = '';
                    $btn_lbl = 'Canceled';
               }
            ?>
               <tr>
                  <td>#<?php echo $value['order_id']; ?></td>
                  <td><?php $date=date_create($value['dt_createddate']);
                              echo date_format($date,'M d , Y'); ?></td>
                  <td><?php echo $value['var_payment_mode']; ?></td>
                  <td><span class="badge badge-<?php echo $status_class; ?>"><?php echo $status_lable; ?></span></td>
                  <td><?php echo '&#x20b9;'. $value['var_payable_amount']; ?></td>
                  <td><a data-toggle="tooltip" data-placement="top" title="" href="<?php echo base_url() . 'orders/viewDetails/'. base64_encode($value['int_glcode']); ?>" data-original-title="View Detail" class="btn btn-info btn-sm view-table-btn"><i class="fa fa-eye"></i> View</a>
                    <?php if ($value['chr_status'] != 'C') { ?>
                     <!-- <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Cancel Order" class="btn btn-info btn-sm cancel-table-btn" <?php echo $btn_click; ?>><i class="fa fa-close"></i> <?php echo $btn_lbl; ?></a> --></td>
                   <?php } ?>
               </tr>
         <?php } } else { ?>
            <tr>
               <td colspan="6">No Orders Found.</td>
            </tr>
         <?php } ?> 
      </tbody>
   </table>
     </div>
   </div>
</section>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/front_assets/css/datatable.min.css">
<script type="text/javascript" src="<?php echo base_url(); ?>public/front_assets/js/datatable.min.js"></script>
<script src="<?php echo base_url(); ?>public/assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
   var site_path = '<?php echo base_url(); ?>';

   $(document).ready(function() {
      $('.datatabel').DataTable();
   });

function cancelOrder(orderId)
{
    swal({
      title: "Are you sure?",
      text: "You want to cancel this Order ?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      cancelButtonText: "No",
      confirmButtonText: "Yes"
    }).then((result) => {
      if (result.value) {
        $.ajax(
        {
          url: site_path + "orders/cancel_order",
          method: 'POST',
          data:
          {
            orderId:orderId
          },
          success: function (result)
          {
            alert(result);
             window.location.href = site_path+'orders';
          }
          });
            //$(location).attr('href','<?php //echo base_url() ?>album/deleteimges/'+id);
          }
        })
    }
</script>