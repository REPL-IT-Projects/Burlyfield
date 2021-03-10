<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-body printableArea">
                    <div class="row order-view-details">
                        <div class="col-md-2">
                            <div class="py-1">
                        <?php
                        if ($data[0]['chr_status'] == 'P') {
                            $status_cls = 'btn btn-info';
                            $status_lbl = 'Pending';
                        } elseif ($data[0]['chr_status'] == 'W') {
                            $status_cls = 'btn btn-warning';
                            $status_lbl = 'Packed & Ready To Ship';
                        } elseif ($data[0]['chr_status'] == 'SH') {
                            $status_cls = 'btn btn-warning';
                            $status_lbl = 'Shipped';
                        } elseif ($data[0]['chr_status'] == 'RC') {
                            $status_cls = 'btn btn-warning';
                            $status_lbl = 'Reached your City';
                        } elseif ($data[0]['chr_status'] == 'R') {
                            $status_cls = 'btn btn-danger';
                            $status_lbl = 'Rejected';
                        } elseif ($data[0]['chr_status'] == 'S') {
                            $status_cls = 'btn btn-success';
                            $status_lbl = 'Delivered';
                        } else if ($data[0]['chr_status'] == 'A') {
                                $status_cls = 'btn btn-success';
                                $status_lbl = 'Accepted';
                            }
                        ?>
                        <button id="order_status" class="<?php echo $status_cls; ?> btn-outline" type="button"><?php echo $status_lbl; ?></button>
                    </div>
                        </div>
                        <div class="col-md-4">
                            <h3 class="py-1"><b>INVOICE</b> <span class="pull-right">#<?php echo $data[0]['order_id']; ?></span></h3>
                        </div>
                        <div class="col-md-4 py-1">
                        <?php 
                            $created_date = date('M d, Y H:m',strtotime($data[0]['dt_createddate']));
                        ?>
                    <h5><b>ORDER</b> <span class="pull-right">DATE: <?php echo $created_date; ?></span></h5>
                        </div>
                        <div class="col-md-2">
                            <div class="text-right py-1">
                        <a id="print" class="btn btn-default btn-outline" type="button" href="<?php echo base_url().'admin/orders/pdf_viewer/'.$data[0]['int_glcode']; ?>"> <span><i class="fa fa-print"></i> Print</span> </a>
                    </div>
                        </div>
                    </div>
                    
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-left">
                                <address>
                                    <div> <h3> &nbsp;<b class="text-danger"><?php echo $data[0]['var_name']; ?></b></h3></div>
                                    <div class="row">
                                        <div class="col-md-4">
                                    <h4 class="font-bold">Address Details</h4>
                                    <p>
                                        <?php echo $data[0]['var_user_address']; ?></p>
                                        <h4 class="font-bold">Contact Details</h4>
                                            <p> Alternate Mobile No. :<?php echo $data[0]['var_alternate_mobile']; ?></p>
                                        <?php 
                                        if ($data[0]['chr_status'] == 'R') { ?>
                                        <h4 class="font-bold">Cancel By</h4>
                                        <p>
                                            <?php if($data[0]['canceled_by'] == 'U'){
                                                $cancel_by = 'User';
                                            } elseif ($data[0]['canceled_by'] == 'S') {
                                                $cancel_by = 'System';
                                            } else {
                                                $cancel_by = 'Vendor';
                                            } ?>
                                                <?php echo $cancel_by; ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <!-- <div class="col-md-4">
                                        <img src="<?php echo base_url();?>public/front_assets/images/logo.png">
                                    </div> -->
                                    <!-- <div class="col-md-4">
                                        <a class="btn btn-default btn-outline" href="" style="margin: 0 0 5px 0;padding: 4px 60px;">Accept</a><br>
                                        <a class="btn btn-default btn-outline" href="" style="margin: 0 0 5px 0;padding: 4px 61px;">Cancel</a><br>
                                        <a class="btn btn-default btn-outline" href="" style="margin: 0 0 5px 0;padding: 4px 28px;">Confirm Shipping</a><br>
                                        <a class="btn btn-default btn-outline" href="" style="margin: 0 0 5px 0;padding: 4px 60px;">Refund</a>
                                    </div> -->
                                   
                                </div>
                                    </address>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="table-responsive mt-5" style="clear: both;">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Weight</th>
                                                <th>Unit</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                                <th>GST</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php 
                                            $product_Arr = $data[0]['fk_product_arr'];
                                            $i = 1;
                                            foreach ($product_Arr as $key => $value) {
                                                $final_amt = $value['var_unit'] * $value['var_price'];
                                                $GST = ($final_amt*$value['gst_price'])/100;
                                                $total = $final_amt + $GST;
                                                if ($value['cancel_status'] == 'N') {
                                                    $var_status = '-';
                                                } else {
                                                    $var_status = 'Rejected';
                                                    $status_class = 'debit_class';
                                                }
                                            ?>

                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $value['var_name']; ?></td>
                                                    <td><img src="<?php echo $value['var_image']; ?>" width="75px" height="75px"></td>
                                                    <td><?php echo $value['var_quantity']; ?> </td>
                                                    <td><?php echo $value['var_unit']; ?> </td>
                                                    <td>&#x20b9; <?php echo $value['var_price']; ?> </td>
                                                    <td>&#x20b9; <?php echo $final_amt; ?> </td>
                                                    <td><?php echo $value['gst_price']; ?> %</td>
                                                    <td>&#x20b9;<?php echo $total; ?> </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="pull-right mt-4 text-right">
                                    <?php 
                                    if ($data[0]['var_cashback'] != '') {
                                        $cashback = $data[0]['var_cashback'];
                                        $promocode = $data[0]['var_promocode'];
                                    } else {
                                        $cashback = '-';
                                        $promocode = '-';
                                    }

                                    ?>

                                    <p>Payment Type: <?php echo $data[0]['var_payment_mode']; ?></p>
                                    <p>Applied Promocode: <?php echo $promocode; ?></p>
                                    <p>Cashback: &#x20b9; <?php echo $cashback; ?></p>
                                    <p>Total amount: &#x20b9; <?php echo $data[0]['var_total_amount']; ?></p>
                                    <!-- <p>Discount : &#x20b9; <?php echo $data[0]['var_discount_amount']; ?> </p> -->
                                    <p>Delivery Charges : &#x20b9; <?php echo $data[0]['var_delivery_charge']; ?> </p>
                                    <!-- <p>Wallet Amount : &#x20b9; <?php echo $data[0]['var_wallet_amount']; ?> </p> -->
                                    <hr>
                                    <h3><b>Payable Amount :</b> &#x20b9; <?php echo $data[0]['var_payable_amount']; ?></h3>
                                </div>
                            <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    var site_path = '<?php echo base_url(); ?>';
    function generateInvoice(orderId)
    {
        $.ajax({
        url: site_path + "cart/place_order/add_user_order",
        type: 'POST',
        data: {},
        success: function(response) {
                
                window.location.href = site_path +'admin/orders/viewDetails/'+orderId;      
        },
      });
    }
</script>