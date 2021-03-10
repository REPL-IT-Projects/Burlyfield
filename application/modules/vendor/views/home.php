<div class="page-holder w-100 d-flex flex-wrap">
   <div class="container-fluid px-xl-5">
      <section class="py-5">
         <div class="row">
            <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
               <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
                  <div class="flex-grow-1 d-flex align-items-center">
                     <div class="dot mr-3 bg-violet"></div>
                     <div class="text">
                        <h6 class="mb-0">Total Product</h6>
                        <span class="text-gray"><?php echo $total_deliveryboy; ?></span>
                     </div>
                  </div>
                  <div class="icon text-white bg-violet"><i class="fas fa-server"></i></div>
               </div>
            </div>
            <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
               <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
                  <div class="flex-grow-1 d-flex align-items-center">
                     <div class="dot mr-3 bg-green"></div>
                     <div class="text">
                        <h6 class="mb-0">Pending Order</h6>
                        <span class="text-gray"><?php echo $pending_order; ?></span>
                     </div>
                  </div>
                  <div class="icon text-white bg-green"><i class="fas fa-clipboard"></i></div>
               </div>
            </div>
            <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
               <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
                  <div class="flex-grow-1 d-flex align-items-center">
                     <div class="dot mr-3 bg-blue"></div>
                     <div class="text">
                        <h6 class="mb-0">Inprogress Order</h6>
                        <span class="text-gray"><?php echo $inprogress_order; ?></span>
                     </div>
                  </div>
                  <div class="icon text-white bg-blue"><i class="fas fa-dolly-flatbed"></i></div>
               </div>
            </div>
            <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
               <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
                  <div class="flex-grow-1 d-flex align-items-center">
                     <div class="dot mr-3 bg-red"></div>
                     <div class="text">
                        <h6 class="mb-0">Complete Order</h6>
                        <span class="text-gray"><?php echo $complete_order; ?></span>
                     </div>
                  </div>
                  <div class="icon text-white bg-red"><i class="fas fa-receipt"></i></div>
               </div>
            </div>
         </div>
    
          <br><br>
    
                  <div class="row mb-4">

                     <div class="card">
                       <!-- 
                        <div class="card-body"> -->
                                
                           <div class="col-lg-12 mb-4 mb-lg-0">


                    <div class="table-wrapper">
                        <div class="table-title">
                                    <div class="row order-report-bg">
                                       <div class="col-sm-4">
                                          <h2 class="mt-0">Today Order Report</h2>
                                       </div>
                                        <div class="col-sm-4">
                                          <h5>Today Order :<spam style="margin-left: 20px;"><?php echo count($order_report['order_data']);?></spam></h5>
                                          
                                        </div>
                                        <div class="col-sm-4">
                                          <h5>Today Earning :<span style="margin-left: 20px;">Rs <?php echo $order_report['total_amount'];?></span></h5>
                                  
                                       </div>
                                   
                                    </div>
                      
                        </div>

                           <div class="table-responsive">        

                                 <table class="example table table-striped table-bordered" style="width:100%">

                                    

                                       <thead>

                                          <tr>

                                             <th style="width: 100px;">Order ID</th>
                                             <th style="width: 100px;">Date</th>
                                             <th style="width: 110px;">Price</th>
                                             <th style="width: 100px;">Status</th>
                                             <th>Action</th>

                                          </tr>

                                       </thead>

                                       <tbody>

                                    

                                           <?php   
                                                    if(count($order_report['order_data']) > 0){     

                                                    foreach ($order_report['order_data'] as $row){
                                                        //$product_arr = $row['fk_product_arr'];
                                                        $total=$row['var_payable_amount'];
//                                                        foreach($row['fk_product_arr'] as $res1){
//                                                            $total = $total + $res1->var_price;
//                                                        }         
                                                        if($row['chr_status'] == 'P'){
                                                            $status = 'Pending';
                                                        }else if($row['chr_status'] == 'A'){
                                                            $status = 'Accepted';
                                                        }else if($row['chr_status'] == 'R'){
                                                            $status = 'Rejected';
                                                        }else if($row['chr_status'] == 'W'){
                                                            $status = 'In Progress';
                                                        }else if($row['chr_status'] == 'C'){
                                                            $status = 'Cancelled';
                                                        }else if($row['chr_status'] == 'S'){
                                                            $status = 'Completed';
                                                        }
                                               ?>

                                       <tr id="<?php echo $row['int_glcode'];?>">

                                             <td ><?php echo $row['order_id'];?></td>

                                             <td ><?php echo date('d/m/Y h:m A',strtotime($row['dt_createddate']));?></td>
                                             <td >Rs <?php echo $total.' ('.$row['var_payment_mode'].')';?></td>
                                             <td >
                                                 <select name="chr_status" id="chr_status" onchange="update_status(this.value,'<?php echo $row['int_glcode'];?>')">
                                                     <option <?php if($row['chr_status'] == 'P'){ echo 'selected';}?> value="P">Pending</option>
                                                     <option <?php if($row['chr_status'] == 'A'){ echo 'selected';}?> value="A">Accepted</option>
                                                     <option <?php if($row['chr_status'] == 'R'){ echo 'selected';}?> value="R">Rejected</option>
                                                     <option <?php if($row['chr_status'] == 'W'){ echo 'selected';}?> value="W">Packed & Ready To Ship</option>
                                                     <option <?php if($row['chr_status'] == 'SH'){ echo 'selected';}?> value="SH">Shipped</option>
                                                     <option <?php if($row['chr_status'] == 'RC'){ echo 'selected';}?> value="RC">Reached your City</option>
                                                     <option <?php if($row['chr_status'] == 'S'){ echo 'selected';}?> value="S">Delivered</option>
                                                 </select>
                                                 </td>
                                             <td>

                                                 <a href="javascript:void" id="order_report" data-toggle="modal" data-target=".order_report" class="btn btn-danger" onclick="order_detail('<?php echo $row['int_glcode'];?>')">MORE DETAIL</a>

                                             </td>

                                          </tr>

                                           <?php }}else{ ?>

                                          <tr><td colspan="5">No Data Available.</td></tr>

                                           <?php } ?>

                                       </tbody>

                                    

                                 </table>

                               </div>   

                              </div>

</div>

                              
                          <!--  </div> -->

                        </div>

                     </div>

                  <!--</div>-->

               </section>
       
   </div>
    
    <div class="modal order_report" tabindex="-1" role="dialog" id="order_report" aria-labelledby="myLargeModalLabel" aria-hidden="true" >

    <div class="modal-dialog modal-xl">

        <div class="modal-content" style="overflow-y: scroll;max-height: 750px;">

            <div class="modal-header">

                <h4 class="modal-title" id="longmodal">Order Detail</h4>

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>

            </div>

            <div class="modal-body" id="order_detail_modal" style="background: #eee;">

       

                  

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>

            </div>

        </div>

        <!-- /.modal-content -->

    </div>

    <!-- /.modal-dialog -->

</div>  
    
    <script>

        var sitepath = '<?php echo base_url();?>';

function order_detail(fk_order){

        $('#order_detail_modal').html('');

        $.ajax({

          url : sitepath+"vendor/order_report/order_detail_modal",

          data : 'fk_order='+fk_order,      

          type : "POST",        

          success : function(data) {

              $('#order_detail_modal').html(data);

              $('#order_detail').show();
          },

          error : function(data) {
              
          }

        }); 

    }

function update_status(status,id){
    
    $.ajax({

          url : sitepath+"vendor/dashboard/update_status",

          data : 'status='+status+'&id='+id,      

          type : "POST",        

          success : function(data) {

                window.location.href = sitepath+"vendor/dashboard";
          },

          error : function(data) {
              
          }

        }); 
}
    </script>