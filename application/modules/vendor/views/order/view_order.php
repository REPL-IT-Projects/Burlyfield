<style>

    .orders_tabs .tabs {

  max-width: 100%;

  margin: 0 auto;

  padding: 30px 20px;

}

.orders_tabs #tab-button {

  display: table;

  table-layout: fixed;

  width: 100%;

  margin: 0;

  padding: 0;

  list-style: none;

}

.orders_tabs #tab-button li {

  display: table-cell;

  width: 20%;

}

.orders_tabs #tab-button li a {

  display: block;

  padding: .5em;

  background: #eee;



  text-align: center;

  color: #000;

  text-decoration: none;

}

.orders_tabs #tab-button li:not(:first-child) a {

  border-left: none;

}

/*.orders_tabs #tab-button li a:hover,*/

.orders_tabs #tab-button .is-active a {

  border-bottom-color:#ff4e00;

  background:#ff4e00;
  color: #ffffff;

}

.orders_tabs #tab-button .is-active .pending {
   border-bottom-color:#d89301;

  background:#d89301;
  color: #ffffff;
}
.pending-tab {
     border-bottom-color:#d89301;

  background:#d89301;
  color: #ffffff;

}

.orders_tabs #tab-button .is-active .acceting {
   border-bottom-color:#cf4916;

  background:#cf4916;
  color: #ffffff;
}

.acceting-tab {
   border-bottom-color:#cf4916;

  background:#cf4916;
  color: #ffffff;
}
.orders_tabs #tab-button .is-active .progress-working {
  border-bottom-color:#57b80f;

  background:#57b80f;
  color: #ffffff;
}
.progress-working-tab {
    border-bottom-color:#57b80f;

  background:#57b80f;
  color: #ffffff;
}
.orders_tabs .tab-contents {

  /*padding: .5em 2em 1em;*/
padding:20px 0px;
}







.orders_tabs .tab-button-outer {

  display: none;

}

.orders_tabs .tab-contents {

  margin-top: 20px;

}

@media screen and (min-width: 768px) {

  .orders_tabs .tab-button-outer {

    position: relative;

    z-index: 2;

    display: block;

  }

  .orders_tabs .tab-select-outer {

    display: none;

  }

  .orders_tabs .tab-contents {

    position: relative;

    top: -1px;

    margin-top: 0;

  }

}

</style>



<div class="page-holder w-100 d-flex flex-wrap">

            <div class="container-fluid px-xl-5">

<section class="order-grid-section py-5">

                  <div class="row mb-4">

                     <div class="card">

                        <!--<div class="card-body">-->



                           

                            

                           <div class="col-lg-12 mb-4 mb-lg-0">

                               <?php echo validation_errors(); ?>

                                    <?php if($this->session->flashdata('Invalid') != ''){ ?>

                                        <div class="alert alert-success hide_msg">

                                            <p><?php echo $this->session->flashdata('Invalid');?></p>

                                        </div>

                                    <?php } ?>

<div class="orders_tabs">

 <div class="tabs">

  <div class="tab-button-outer">

    <ul id="tab-button">

      <li><a class="pending" href="#tab01">Pending</a></li>

      <li><a class="acceting" href="#tab02">Accepting</a></li>

      <li><a class="progress-working" href="#tab03">In Progress</a></li>

    </ul>

  </div>

  <div class="tab-select-outer">

    <select id="tab-select">

      <option value="#tab01">

          Pending

      </option>

      <option value="#tab02">

          Accepting

      </option>

      <option value="#tab03">

          In Progress

      </option>

    </select>

  </div>



  <div id="tab01" class="tab-contents">

                             
   <div class="table-responsive">
       <table id="example1" class="table table-striped table-bordered example" style="width:100%">

                                    

                                       <thead>

                                          <tr class="pending-tab">


                                             <th style="width: 20%;">Order ID</th>

                                             <th style="width: 20%;">DateTime</th>
                                             <th style="width: 20%;">Status</th>
                                             <th style="width: 15%;">Action</th>

                                          </tr>

                                       </thead>

                                       <tbody>

                                      

                                           <?php if(count($pending_order) > 0){     

                                                    foreach ($pending_order as $row){

                                                        

                                               ?>

                                       <tr id="<?php echo $row['int_glcode'];?>">

                                             <td ><?php echo $row['order_id'];?></td>

                                             <td ><?php echo date('d/m/Y h:i A',strtotime($row['dt_createddate']));?></td>
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

                                                 <a href="javascript:void" id="order_detail" data-toggle="modal" data-target=".order_detail" class="btn btn-danger" onclick="order_detail('<?php echo $row['fk_order'];?>')">MORE DETAIL</a>

                                             </td>

                                          </tr>

                                           <?php }}else{ ?>

                                          <tr><td colspan="3">No Data Available.</td></tr>

                                           <?php } ?>

                                       </tbody>

                                    

                                 </table>

                                

  </div>
</div>

  <div id="tab02" class="tab-contents">

     <div class="table-wrapper">

                           <div class="table-responsive">        

                               <table class="table table-striped table-bordered example" style="width:100%">

                                    

                                       <thead>

                                          <tr class="acceting-tab">

                                             

                                             <th style="width: 20%;">Order ID</th>

                                             <th style="width: 20%;">DateTime</th>
                                             <th style="width: 20%;">Status</th>
                                             <th style="width: 15%;">Action</th>

                                          </tr>

                                       </thead>

                                       <tbody>

                                    

                                           <?php if(count($accept_order) > 0){     

                                                    foreach ($accept_order as $row){

                                                        

                                               ?>

                                       <tr id="<?php echo $row['int_glcode'];?>">

                                             <td ><?php echo $row['order_id'];?></td>

                                             <td ><?php echo date('d/m/Y h:i A',strtotime($row['dt_createddate']));?></td>
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

                                                 <a href="javascript:void" id="order_detail" data-toggle="modal" data-target=".order_detail" class="btn btn-danger" onclick="order_detail('<?php echo $row['fk_order'];?>')">MORE DETAIL</a>

                                             </td>

                                          </tr>

                                           <?php }}else{ ?>

                                          <tr><td colspan="3">No Data Available.</td></tr>

                                           <?php } ?>

                                       </tbody>

                                    

                                 </table>

                               </div>   

                              </div>

  </div>

  <div id="tab03" class="tab-contents">

     <div class="table-wrapper">

                                   

                                 <table id="example2" class="table table-striped table-bordered example" style="width:100%">

                                    

                                       <thead>

                                          <tr class="progress-working-tab">


                                             <th style="width: 20%;">Order ID</th>

                                             <th style="width: 20%;">DateTime</th>
                                             <th style="width: 20%;">Status</th>
                                             <th style="width: 15%;">Action</th>

                                          </tr>

                                       </thead>

                                       <tbody>

                                      

                                           <?php if(count($working_order) > 0){     

                                                    foreach ($working_order as $row){

                                                        

                                               ?>

                                       <tr id="<?php echo $row['int_glcode'];?>">

                                             <td ><?php echo $row['order_id'];?></td>

                                             <td ><?php echo date('d/m/Y h:i A',strtotime($row['dt_createddate']));?></td>
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

                                                 <a href="javascript:void" id="order_detail" data-toggle="modal" data-target=".order_detail" class="btn btn-danger" onclick="order_detail('<?php echo $row['fk_order'];?>')">MORE DETAIL</a>

                                             </td>

                                          </tr>

                                           <?php }}else{ ?>

                                          <tr><td colspan="3">No Data Available.</td></tr>

                                           <?php } ?>

                                       </tbody>

                                    

                                 </table>

                                  

                              </div>

  </div>

 </div>

</div>

                               

                              

                           </div>

                        <!--</div>-->

                     </div>

                  </div>

               </section>

</div>

    

<div class="modal update_status" tabindex="-1" role="dialog" id="update_status" aria-labelledby="myLargeModalLabel" aria-hidden="true" >


    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="longmodal">Order Reject Reason</h4>

                <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">x</button>

            </div>

            <div class="modal-body">
                
                <form method="POST" action="<?php echo base_url().'vendor/order/updateStatus';?>">
                    <?php foreach($reject_reason as $reject){ ?>
                    <input type="radio" name="reason_option" id="reason_option" onchange="select_reason_option()" value="<?php echo $reject['var_title'];?>"> <?php echo $reject['var_title'];?><br><br>
                    <?php } ?>
                    <input type="radio" name="reason_option" id="reason_option" onchange="select_reason_option()" value="Others"> Others <br><br>
                    
                    <div id="reject_other_option" style="display:none;"><br>
                    <textarea class="form-control" name="txt_reason" id="txt_reason" placeholder="Reason for Order Reject"></textarea><br><br>
                    </div>
                    <input type="hidden" name="fk_order" id="fk_order" value="">

                    <input type="hidden" name="flag" id="flag" value="">
                    
                    <input class="btn btn-primary" type="submit" name="submit" value="Submit">

                </form>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>

            </div>

        </div>

  

    </div>

  

</div>

    
<div class="modal order_accept" tabindex="-1" role="dialog" id="order_accept" aria-labelledby="myLargeModalLabel" aria-hidden="true" >


    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="longmodal">Accept Order</h4>

                <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">x</button>

            </div>

            <div class="modal-body" id="order_accept_data">
                
                
            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>

            </div>

        </div>

  

    </div>

  

</div>


<div class="modal order_detail" tabindex="-1" role="dialog" id="order_detail" aria-labelledby="myLargeModalLabel" aria-hidden="true" >

    <div class="modal-dialog modal-xl">

        <div class="modal-content" style="overflow-y: scroll;max-height: 100vh;">

            <div class="modal-header">

                <h4 class="modal-title" id="longmodal">Order Detail</h4>

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>

            </div>

            <div class="modal-body" id="order_detail_modal">

       

                  

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

        function select_reason_option(){
   
            var radioValue = $("input[name='reason_option']:checked").val();

            if(radioValue == 'Others'){
                document.getElementById('reject_other_option').style.display = 'block';
            }else{
                document.getElementById('reject_other_option').style.display = 'none';
            }

        }

        $(function() {

  var $tabButtonItem = $('#tab-button li'),

      $tabSelect = $('#tab-select'),

      $tabContents = $('.tab-contents'),

      activeClass = 'is-active';



  $tabButtonItem.first().addClass(activeClass);

  $tabContents.not(':first').hide();



  $tabButtonItem.find('a').on('click', function(e) {

    var target = $(this).attr('href');



    $tabButtonItem.removeClass(activeClass);

    $(this).parent().addClass(activeClass);

    $tabSelect.val(target);

    $tabContents.hide();

    $(target).show();

    e.preventDefault();

  });



  $tabSelect.on('change', function() {

    var target = $(this).val(),

        targetSelectNum = $(this).prop('selectedIndex');



    $tabButtonItem.removeClass(activeClass);

    $tabButtonItem.eq(targetSelectNum).addClass(activeClass);

    $tabContents.hide();

    $(target).show();

  });

});



function update_order(fk_order,flag){

    if(flag == 'R'){

        $('#fk_order').val(fk_order);

        $('#flag').val(flag);

        $('#update_status').show();
        
    }else{
        
        $('#order_accept_data').html('');

        $.ajax({

          url : sitepath+"vendor/order/accept_order_modal",

          data : 'fk_order='+fk_order,      

          type : "POST",        

          success : function(data) {

              $('#order_accept_data').html(data);

              $('#order_accept').show();

          },

          error : function(data) {

          }

        }); 
//        var radioValue = $("input[name='reason_option']:checked").val();
//        $.ajax({
//
//          url : sitepath+"vendor/order/updateStatus",
//
//          data : 'fk_order='+fk_order+'&flag='+flag+'&reason_option='+radioValue,      
//
//          type : "POST",        
//
//          success : function(data) {
//
//            window.location.href = sitepath+"vendor/order";
//
//          },
//
//          error : function(data) {
//
//          }
//
//        }); 

    }

}



function order_detail(fk_order){

        $('#order_detail_modal').html('');

        $.ajax({

          url : sitepath+"vendor/order/order_detail_modal",

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

                window.location.href = sitepath+"vendor/order";
          },

          error : function(data) {
              
          }

        }); 
}
    </script>