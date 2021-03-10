
<div class="page-holder w-100 d-flex flex-wrap">

            <div class="container-fluid px-xl-5">

<section class="order-grid-section py-5">

                  <div class="row mb-4">

                     <div class="card">
                       <!-- 
                        <div class="card-body"> -->
                                
                           <div class="col-lg-12 mb-4 mb-lg-0">


                               <?php echo validation_errors(); ?>

                                    <?php if($this->session->flashdata('Invalid') != ''){ ?>

                                        <div class="alert alert-success hide_msg">

                                            <p><?php echo $this->session->flashdata('Invalid');?></p>

                                        </div>

                                    <?php } ?>


                    <div class="table-wrapper">
                        <div class="table-title">
                                    <div class="row order-report-bg">
                                       <div class="col-sm-3">
                                          <h2 class="mt-0">Order Report</h2>
                                       </div>
                                        <div class="col-sm-4">
                                          <h5>Total Order :<spam style="margin-left: 20px;"><?php echo count($order_report['order_data']);?></spam></h5>
                                          <!-- <h4><?php echo count($order_report['order_data']);?></h4> -->
                                        </div>
                                        <div class="col-sm-4">
                                          <h5>Total Earning :<span style="margin-left: 20px;">Rs <?php echo $order_report['total_amount'];?></span></h5>
                                          <!-- <h4>Rs <?php echo $order_report['total_amount'];?></h4> -->
                                       </div>
                                   <div class="col-sm-1">   
                                 <div class="filter-icon-right">
                                    <a href="javascript:void" id="order_filter" data-toggle="modal" data-target=".order_filter">
                                        <i class="fa fa-filter filter-icon-size" aria-hidden="true"></i>
                                    </a>
                                </div>
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

                                               ?>

                                       <tr id="<?php echo $row['fk_order'];?>">

                                             <td ><?php echo $row['order_id'];?></td>

                                             <td ><?php echo date('d/m/Y h:m A',strtotime($row['dt_createddate']));?></td>
                                             <td >Rs <?php echo $total.' ('.$row['var_payment_mode'].')';?></td>
                                             <td>

                                                 <a href="javascript:void" id="order_report" data-toggle="modal" data-target=".order_report" class="btn btn-danger" onclick="order_detail('<?php echo $row['fk_order'];?>')">MORE DETAIL</a>

                                             </td>

                                          </tr>

                                           <?php }}else{ ?>

                                          <tr><td colspan="4">No Data Available.</td></tr>

                                           <?php } ?>

                                       </tbody>

                                    

                                 </table>

                               </div>   

                              </div>
                               <div >
                             <a id="add_cate" href="<?php echo base_url(); ?>vendor/order_report/createXLS" class="btn btn-info btn-rounded m-t-10 mb-2 float-right"><i class="mr-2 mdi mdi-export"></i>Export Excel</a>
                           <a id="add_cate" href="<?php echo base_url(); ?>vendor/order_report/pdf_viewer_order" class="btn btn-info btn-rounded m-t-10 mb-2 float-right"><i class="mr-2 mdi mdi-export"></i>Export PDF</a>
                               </div>
</div>

                              
                          <!--  </div> -->

                        </div>

                     </div>

                  <!--</div>-->

               </section>

</div>

    <div class="modal fade order_filter" tabindex="-1" role="dialog" id="order_filter" aria-labelledby="myLargeModalLabel" aria-hidden="true" >


    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="longmodal">Order Filter</h4>

                <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">x</button>

            </div>

            <div class="modal-body">

                <form method="GET" action="<?php echo base_url().'vendor/order_report/filter';?>">
                    
                    <label><b>Payment Method</b></label>
                    <input type="radio" name="payment_method" id="payment_method" value="Both" checked=""> Both &nbsp;
                    <input type="radio" name="payment_method" id="payment_method" value="By Online"> Online &nbsp;
                    <input type="radio" name="payment_method" id="payment_method" value="By Cash"> Cash <br><br>
                    
                    <label><b>Date</b></label>
                    <div class="row">&nbsp;
                        <input type="text" name="from_date" value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date'];}?>" id="from_date" class="form-control" placeholder="From Date" style="width: 35%;"> &nbsp;
                        <input type="text" name="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date'];}?>" id="to_date" class="form-control" placeholder="To Date" style="width: 35%;"> 
                    </div>
                    <br>
                   
                    <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                    <input class="btn btn-primary" type="reset" name="reset" value="Reset">

                </form>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>

            </div>

        </div>

  

    </div>

  

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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>

        var sitepath = '<?php echo base_url();?>';

                $("#from_date").datepicker({
                     dateFormat: "yy-mm-dd"
                 });
                 $("#to_date").datepicker({
                     dateFormat: "yy-mm-dd"
                 });
               
        
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

    </script>