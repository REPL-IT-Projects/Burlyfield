<?php //echo '<pre>'; print_r($order);?>
<label><b>ORDER ID</b> <span style="margin-left: 50px;"><?php echo $order['order_id'];?></span></label>

<label><h6 style="color: #ff4e00;">User Details</h6></label>

<label><b>Name</b> <span style="margin-left: 50px;"><?php echo $order['var_name'];?></span></label>

<label><b>Contact No</b> <span style="margin-left: 15px;"><?php echo $order['var_mobile_no'];?></span></label>

<label><b>Address</b> <span style="margin-left: 35px;"><?php echo $order['txt_address'];?></span></label>

<br>
<hr class="modal-line-hr">

<label><h6 style="color: #ff4e00;">Order Detail</h6></label>

<div class="row">

    

        

		<table id="bs4-table" class="table table-striped table-bordered">





			<tbody>

                                <tr>

					<th><strong> Product Name</strong></th>

                                        <th><strong> Quantity</strong></th>

                                        <th><strong> Price</strong></th>

				</tr>

                               

                                  <?php $total = 0;

                                        foreach($order['fk_product_arr'] as $res1){ ?>                                  

                                <tr>

                                    <td><img style="width: 20%;" src="<?php echo $res1['var_image'];?>"> <?php echo $res1['var_name'];?></td>

                                    <td><?php echo $res1['var_unit'];?> x <?php echo $res1['var_quantity'];?></td>

                                    <td>Rs <?php echo $res1['var_price'];?></td>

                                </tr>

                                  <?php } ?>

                             

                        </tbody>

		</table>

    

    </div>


<div class="order-popup-price">  

      <label><b>Total Amount</b> <span>Rs <?php echo $order['var_total_amount'];?></span></label>
    <label><b>Discount Amount(-)</b> <span>Rs <?php echo $order['var_discount_amount'];?></span></label>
    <label><b>Convenience Fee(+)</b> <span>Rs <?php echo $order['var_delivery_charge'];?></span></label>
    <label><b>Wallet Amount</b> <span>Rs <?php echo $order['var_wallet_amount'];?></span></label>
    <hr>
<label><b>Total Payable Amount</b> <span>Rs <?php echo $order['var_payable_amount'];?></span></label>

    <hr class="modal-line-hr">

    <label><h6 style="color: #ff4e00;">Payment Details</h6></label>

    <label><b>Payment Method</b> <span style="color: #ff4e00;"><?php echo $order['var_payment_mode'];?></span></label>

</div>

    <br>

    <script>

        function check_delivery_boy(id,fk_order){

            

            $.ajax({

                url : sitepath+"vendor/order/check_delivery_boy",

                data : 'id='+id,      

                type : "POST",        

                success : function(data) {

                    assign_delivery(data,id,fk_order);

                },

                error : function(data) {

                }

            }); 

        }

        

        function assign_delivery(flag,fk_delivery,fk_order){

        if (flag == 'F') {

                var msg = "This delivery boy is available for order.";

            } else {

                var msg = "Sorry ! This delivery boy is busy , Are you sure want to assign order.";

            }

            

            swal({

              title: "Are you sure?",

              text: msg,

              type: "warning",

              showCancelButton: true,

              confirmButtonColor: "#DD6B55",

              cancelButtonText: "No",

              confirmButtonText: "Yes",

            }).then((result) => {

              if (result.value) {

                $.ajax({

                type: "POST",

                dataType: 'json',

                cache: false,

                url: "<?php echo base_url();?>vendor/order/assign_order",

                data: { fk_delivery: fk_delivery,

                    fk_order: fk_order },



                    success: function(data){

                        //location.reload();



                        window.location.href = sitepath+"vendor/order";

                       

                    }

                });

            

                  }

                })

                }

    </script>