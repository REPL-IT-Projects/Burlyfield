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

.orders_tabs #tab-button .is-active .completed-active {

  border-bottom-color: #57b80f;

  background: #57b80f;
  color: #ffffff;

}
.orders_tabs #tab-button .is-active .rejected-active {
    border-bottom-color:#cc0000;

  background:#cc0000;
  color: #ffffff;
}

.completed-active-tab {
   border-bottom-color: #57b80f;

  background: #57b80f;
  color: #ffffff;
}

.rejected-active-tab {
    border-bottom-color:#cc0000;

  background:#cc0000;
  color: #ffffff;
}
.orders_tabs .tab-contents {

 /* padding: .5em 2em 1em;*/
 padding: 20px 0px;

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
.order-history-tab2 th:nth-child(1) {
    width: 15% !important;
}
.order-history-tab3 th:nth-child(1) {
    width: 15% !important;
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

      <li><a class="completed-active" href="#tab01">Completed</a></li>

      <li><a class="rejected-active" href="#tab02">Rejected</a></li>
      
      <li><a class="acceting" href="#tab03">Cancelled</a></li>

    </ul>

  </div>

  <div class="tab-select-outer">

    <select id="tab-select">

      <option value="#tab01">

          Completed

      </option>

      <option value="#tab02">

          Rejected

      </option>
      
      <option value="#tab03">

          Canceled

      </option>

    </select>

  </div>



  <div id="tab01" class="tab-contents">

     <!-- <div class="table-wrapper"> -->

                           <div class="table-responsive">        

                                 <table class="example table table-striped table-bordered">

                                    

                                       <thead>

                                          <tr class="completed-active-tab">

                                             <th style="width: 20%;">Order ID</th>

                                             <th style="width: 20%;">DateTime</th>

                                             <th style="width: 15%;">Action</th>

                                          </tr>

                                       </thead>

                                       <tbody>

                                    

                                           <?php if(count($completed_order) > 0){     

                                                    foreach ($completed_order as $row){

                                                        

                                               ?>

                                       <tr id="<?php echo $row['fk_order'];?>">

                                             <td ><?php echo $row['order_id'];?></td>

                                             <td><?php echo date('d/m/Y h:i A',strtotime($row['dt_createddate']));?></td>

                                             <td>

                                                 <a href="javascript:void" id="order_history" data-toggle="modal" data-target=".order_history" class="btn btn-danger" onclick="order_detail('<?php echo $row['fk_order'];?>')">MORE DETAIL</a>

                                             </td>

                                          </tr>

                                           <?php }}else{ ?>

                                          <tr><td colspan="3">No Data Available.</td></tr>

                                           <?php } ?>

                                       </tbody>

                                    

                                 </table>

                               </div>   

                              <!-- </div> -->

  </div>

  <div id="tab02" class="tab-contents order-history-tab2">

     <!-- <div class="table-wrapper"> -->

                                   

                                 <table class="example table table-striped table-bordered">

                                    

                                       <thead>

                                          <tr class="rejected-active-tab">

                                             <th style="width: 20%;">Order ID</th>

                                             <th style="width: 20%;">DateTime</th>

                                             <th style="width: 15%;">Action</th>

                                          </tr>

                                       </thead>

                                       <tbody>

                                      

                                           <?php if(count($reject_order) > 0){     

                                                    foreach ($reject_order as $row){

                                                        

                                               ?>

                                       <tr id="<?php echo $row['fk_order'];?>">

                                             <td ><?php echo $row['order_id'];?></td>

                                             <td><?php echo date('d/m/Y h:i A',strtotime($row['dt_createddate']));?></td>

                                             <td>

                                                 <a href="javascript:void" id="order_history" data-toggle="modal" data-target=".order_history" class="btn btn-danger" onclick="order_detail('<?php echo $row['fk_order'];?>')">MORE DETAIL</a>

                                             </td>

                                          </tr>

                                           <?php }}else{ ?>

                                          <tr><td colspan="3">No Data Available.</td></tr>

                                           <?php } ?>

                                       </tbody>

                                    

                                 </table>

                                  

                             <!--  </div> -->

  </div>
     
     <div id="tab03" class="tab-contents order-history-tab3"> 

     <!-- <div class="table-wrapper"> -->

                           <div class="table-responsive">        

                                 <table class="example table table-striped table-bordered">

                                    

                                       <thead>

                                          <tr class="acceting-tab">

                                             <th style="width: 20%;">Order ID</th>

                                             <th style="width: 20%;">DateTime</th>

                                             <th style="width: 15%;">Action</th>

                                          </tr>

                                       </thead>

                                       <tbody>

                                    

                                           <?php if(count($cancel_order) > 0){     

                                                    foreach ($cancel_order as $row){

                                                        

                                               ?>

                                       <tr id="<?php echo $row['fk_order'];?>">

                                             <td ><?php echo $row['order_id'];?></td>

                                             <td><?php echo date('d/m/Y h:i A',strtotime($row['dt_createddate']));?></td>

                                             <td>

                                                 <a href="javascript:void" id="order_history" data-toggle="modal" data-target=".order_history" class="btn btn-danger" onclick="order_detail('<?php echo $row['fk_order'];?>')">MORE DETAIL</a>

                                             </td>

                                          </tr>

                                           <?php }}else{ ?>

                                          <tr><td colspan="3">No Data Available.</td></tr>

                                           <?php } ?>

                                       </tbody>

                                    

                                 </table>

                               </div>   

                              <!-- </div> -->

  </div>

 </div>

</div>

                               

                              

                           </div>

                        <!--</div>-->

                     </div>

                  </div>

               </section>

</div>

    

<div class="modal bs-example-modal-lg" tabindex="-1" role="dialog" id="update_status" aria-labelledby="myLargeModalLabel" aria-hidden="true" >

    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="longmodal">Order Reject Reason</h4>

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>

            </div>

            <div class="modal-body">

                <form method="POST" action="<?php echo base_url().'vendor/order/updateStatus';?>">

                    <textarea class="form-control" name="txt_reason" id="txt_reason" placeholder="Reason for Order Reject"></textarea><br><br>

                    <input type="hidden" name="fk_order" id="fk_order" value="">

                    <input type="hidden" name="flag" id="flag" value="">

                    <input class="btn btn-primary" type="submit" name="submit" value="Submit">

                </form>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>

            </div>

        </div>

        <!-- /.modal-content -->

    </div>

    <!-- /.modal-dialog -->

</div>

    



<div class="modal order_history" tabindex="-1" role="dialog" id="order_history" aria-labelledby="myLargeModalLabel" aria-hidden="true" >

    <div class="modal-dialog modal-xl">

        <div class="modal-content" style="overflow-y: scroll;max-height: 750px;">

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

    
<!--     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">

    Open modal

  </button>



  <div class="modal " id="myModal">

    <div class="modal-dialog modal-sm">

      <div class="modal-content">

      

        <div class="modal-header">

          <h4 class="modal-title">Modal Heading</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        

        <div class="modal-body">

          Modal body..

        </div>

        

        <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>

        

      </div>

    </div>

  </div>-->

    
    <script>

        var sitepath = '<?php echo base_url();?>';

        

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


function order_detail(fk_order){

        $('#order_detail_modal').html('');

        $.ajax({

          url : sitepath+"vendor/order_history/order_detail_modal",

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

                window.location.href = sitepath+"vendor/order_history";
          },

          error : function(data) {
              
          }

        }); 
}
    </script>