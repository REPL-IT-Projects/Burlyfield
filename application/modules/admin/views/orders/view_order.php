<div id="main-wrapper">
    <div class="page-wrapper">
       <?php echo validation_errors(); ?>
            <?php if($this->session->flashdata('Invalid') != ''){ ?>
                <div class="alert alert-success hide_msg">
                    <p><?php echo $this->session->flashdata('Invalid');?></p>
                </div>
            <?php } ?>
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Orders</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Orders</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                           <a id="add_cate" href="<?php echo base_url(); ?>admin/orders/createXLS" class="btn btn-info btn-rounded m-t-10 mb-2 float-right"><i class="mr-2 mdi mdi-export"></i>Export Excel</a>
                           <a id="add_cate" href="<?php echo base_url(); ?>admin/orders/pdf_viewer_order" class="btn btn-info btn-rounded m-t-10 mb-2 float-right"><i class="mr-2 mdi mdi-export"></i>Export PDF</a>
                       </div>
                   </div>
               </div>
           </div>
   
           <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
            <div class="card-body table-responsive">
                <table id="orders_list_admin" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr><th colspan="7">
                          Show:<select name="dp_entries">
                            <option value="10" selected="">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>entries
                    </th>
                    <th colspan="2">
                      <input type="search" name="search" id="search" class="form-control" placeholder="Search">
                  </th></tr>                
                  <tr style="background-color: rgba(0, 0, 3, 0.1);">
                    <th><span class="icon">
                        <input type="checkbox" onclick="checkAll('chkgrow')" id="checkAll" name="chkall_agt" />
                    </span></th>
                    <th><a href="javascript:void(0);" field="mo.order_id" class="_sort">#Order ID</a></th>
                    <th><a href="javascript:void(0);" field="mu.var_name" class="_sort">User</a></th>
                    <th><a href="javascript:void(0);" field="var_alternate_mobile" class="_sort">Mobile No</a></th>
                    <th><a href="javascript:void(0);" field="mo.var_payable_amount" class="_sort">Payable Amount</a></th>
                    <th><a href="javascript:void(0);" field="mo.var_payment_mode" class="_sort">Payment Mode</a></th>
                    <th><a href="javascript:void(0);" field="mo.dt_delivery_date" class="_sort">Date</a></th>
                    <th><a href="javascript:void(0);" field="mo.chr_status" class="_sort">Status</a></th>
                    <th>Action</th>
                </tr>
                </thead>
                <input type="hidden" name="module" id="module" value="orders">
                <tbody>
                    <?php 
                    if (count($data) > 0) {
                        foreach ($data as $row) {
                            $id = $row["int_glcode"];
                            if ($row['chr_status'] == 'P') {
                                $status_cls = 'btn btn-info';
                                $status_lbl = 'Pending';
                            } elseif ($row['chr_status'] == 'W') {
                                $status_cls = 'btn btn-warning';
                                $status_lbl = 'Packed & Ready To Ship';
                            } elseif ($row['chr_status'] == 'SH') {
                                $status_cls = 'btn btn-warning';
                                $status_lbl = 'Shipped';
                            } elseif ($row['chr_status'] == 'RC') {
                                $status_cls = 'btn btn-warning';
                                $status_lbl = 'Reached your City';
                            } elseif ($row['chr_status'] == 'R') {
                                $status_cls = 'btn btn-danger';
                                $status_lbl = 'Rejected';
                            } elseif ($row['chr_status'] == 'S') {
                                $status_cls = 'btn btn-success';
                                $status_lbl = 'Delivered';
                            } else if ($row['chr_status'] == 'A') {
                                    $status_cls = 'btn btn-success';
                                    $status_lbl = 'Accepted';
                                } else if ($row['chr_status'] == 'C') {
                                    $status_cls = 'btn btn-danger';
                                    $status_lbl = 'Cancelled';
                                }

                            if ($row['var_alternate_mobile'] != '') {
                                $row['var_alternate_mobile'] = $row['var_alternate_mobile'];
                            } else {
                                $row['var_alternate_mobile'] = 'N/A';
                            }

                            ?>
                        <tr id="<?php echo $row["int_glcode"]; ?>">
                        <td><input type="checkbox" name="ids[]" class="checkboxes" value="<?php echo $row['int_glcode']; ?>"></td>
                        <td><?php echo $row['order_id']; ?></td>
                        <td><?php echo $row['var_name']; ?></td>
                        <td><?php echo $row['var_alternate_mobile']; ?></td>      
                        <td>&#x20b9; <?php echo $row['var_payable_amount']; ?></td>
                        <td><?php echo $row['var_payment_mode']; ?></td>
                        <td><?php echo date('d/m/Y',strtotime($row['dt_createddate'])); ?></td>
                        <td><?php if($row['chr_status'] == "W"){ ?>

                                <button class="btn btn-info" onclick="order_status('<?php echo $id; ?>','S')">Out for Delivery</button>

                            <?php }else if($row['chr_status'] == 'S'){ ?>

                                <button class="<?php echo $status_cls; ?>"><?php echo $status_lbl; ?></button><br>
                                <button class="btn btn-warning" style="margin-top:10px;" onclick="order_status('<?php echo $id; ?>','T')">Return</button>
 
                            <?php }else if($row['chr_status'] == 'P'){ ?>

                                <button class="btn btn-success" onclick="order_status('<?php echo $id; ?>','A')">Accept</button><br>
                                <button class="btn btn-danger" style="margin-top:10px;" onclick="order_status('<?php echo $id; ?>','R')">Reject</button>

                            <?php }else if($row['chr_status'] == 'R'){ ?>

                                <button class="btn btn-danger">Cancelled</button><br>
                                <button class="btn btn-success" style="margin-top:10px;" onclick="order_status('<?php echo $id; ?>','B')">Refund</button>

                            <?php } else if($row['chr_status'] == 'T'){ ?>
                                <button class="btn btn-warning">Returned</button>
                            <?php } else if($row['chr_status'] == 'B'){ ?>
                                <button class="btn btn-success">Refunded</button>
                            <?php } else { ?>
                                <button class="<?php echo $status_cls; ?>"><?php echo $status_lbl; ?></button>
                            }

                            <?php } ?></span></td>
                        <td><a class="btn btn-primary btn_view" href="<?php echo base_url() . 'admin/orders/viewDetails/'. base64_encode($row['int_glcode']); ?>">View</a><br>
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#shippingEditModal<?php echo $row['int_glcode']; ?>" data-whatever="@mdo" data-id="<?php echo $row['int_glcode']; ?>">Shipping</i></button>
                            <!-- <a class="btn btn-warning" href="#">Shipping</a> -->
                        </td>
                        </tr>
                        <div class="modal fade" id="shippingEditModal<?php echo $row['int_glcode']; ?>" tabindex="-1" role="dialog" aria-labelledby="addonLabel1">
                          <div class="modal-dialog" role="document" >
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel1">Edit Shipping Details</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              </div>
                              <div class="modal-body">
                                  <form action="<?php echo base_url(); ?>admin/orders/shipping" method="POST" id="addon_form" class="form-horizontal" enctype='multipart/form-data'>
                                      <input type="hidden" name="int_glcode" id="int_glcode" value="<?php echo $row['int_glcode']; ?>">
                                      <div class="form-group row">
                                        <label for="date" class="col-sm-3 text-right control-label col-form-label">Shipping</label>
                                        <div class="col-sm-9">
                                          <input type="date" class="form-control" id="shipping_date" name="shipping_date" value="<?php echo $row['shipping_date']; ?>" required="">
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Courier Service</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" id="var_courier" name="var_courier" value="<?php echo $row['var_courier']; ?>" required="">
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Tracking Number</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" id="var_tracking" name="var_tracking" value="<?php echo $row['var_tracking']; ?>" required="">
                                        </div>
                                      </div>
                                    <div class="modal-footer">
                                      <button type="submit" id="btn_addon" class="btn btn-success">Save</button>
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                    </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php } 
                        } else { ?>
                            <tr><th colspan="9">No data are available.</th></tr>
                        <?php } ?>
                    </tbody>
                </table>
                <input type="hidden" name="hfield" value="int_glcode">
                <input type="hidden" name="hsort" value="desc">
                <input type="hidden" name="hpageno" value="0">
              <?php
              if (count($data) > 0) {
                ?>
                <div>
                  <div id="pagination" style="float: right">
                      <?php echo $pagination; ?>
                  </div>
                  <label id="showing_"><?php echo 'Showing 1 to '.count($data).' of '.$total_data.' entries'; ?></label>
              </div>
                <input type="hidden" name="module" id="module" value="vendor">
                <button type="submit" class="btn btn-danger btn_fnt" name="btn_delete" id="btn_delete"><i class="icon dripicons-trash color_change"></i>Delete</button>
            <?php } ?>
        </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  var siteurl = '<?php echo base_url(); ?>';
  function order_status(id,status)

    {
        
        if(status == 'P')

        {

            var result = confirm("Are you sure to accept the order?");

        }else if(status == 'R'){

            var result = confirm("Are you sure to reject the order?");

        }else if(status == 'A'){

            var result = confirm("Are you sure to this order is in delivery?");

        }else if(status == 'S'){

            var result = confirm("Are you sure to order is completed?");

        }else if(status == 'T'){

            var result = confirm("Are you sure to order is returned?");

        }else if(status == 'B'){

            var result = confirm("Are you sure Refund for this Order?");

        }

        

        if(result==true)

        {

            $.ajax({

                url: siteurl+'admin/orders/OrderStatus',

                type: 'post',

                data: {id:id,status:status},

                dataType: 'json',

                success: function(response)

                {

                    window.location.href=siteurl+'admin/orders';

                }

            });

        }

    }   
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/dist/js/orders.js"></script>