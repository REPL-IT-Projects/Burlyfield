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

     <div class="table-title">
                                    <div class="row order-report-bg">
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-4"> 
                                          <h5>Wallet Amount :<spam style="margin-left: 20px;"><?php echo $getEarning['total_wallet'];?></spam></h5>
                                         
                                        </div>
                                        <div class="col-sm-4">
                                            <?php if($getEarning['total_wallet'] > 0){ $disable='';}else{ $disable='disabled';} ?>
                                            <button <?php echo $disable;?> onclick="withdraw_request('<?php echo $getEarning['total_wallet'];?>')" class="btn btn-success">Withdraw</button>
                                       
                                       </div>
                                
                                    </div>
                      
                        </div>
    
 <div class="tabs">

  <div class="tab-button-outer">

    <ul id="tab-button">

      <li><a class="completed-active" href="#tab01">Earning</a></li>

      <li><a class="completed-active" href="#tab02">Pending Request</a></li>
      
      <li><a class="completed-active" href="#tab03">Completed Request</a></li>

    </ul>

  </div>

  <div class="tab-select-outer">

    <select id="tab-select">

      <option value="#tab01">

          Earning

      </option>

      <option value="#tab02">

          Pending

      </option>
      
      <option value="#tab03">

          Completed

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

                                             <th style="width: 110px;">Amount</th>
                                             
                                             <th style="width: 20%;">DateTime</th>

                                          </tr>

                                       </thead>

                                       <tbody>

                                    

                                           <?php if(count($getEarning['data']) > 0){     

                                                    foreach ($getEarning['data'] as $row){

                                                        

                                               ?>

                                       <tr id="<?php echo $row['int_glcode'];?>">

                                             <td ><?php echo $row['order_id'];?></td>

                                             <td >Rs <?php echo $row['var_amount'];?></td>
                                              
                                             <td><?php echo date('d/m/Y h:i A',strtotime($row['dt_createddate']));?></td>

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

     <div class="table-responsive">        

                                 <table class="example table table-striped table-bordered">

                                    

                                       <thead>

                                          <tr class="completed-active-tab">

                                             <th style="width: 110px;">Withdraw Amount</th>
                                             
                                             <th style="width: 20%;">DateTime</th>

                                          </tr>

                                       </thead>

                                       <tbody>

                                    

                                           <?php if(count($getPending) > 0){     

                                                    foreach ($getPending as $row){

                                                        

                                               ?>

                                       <tr id="<?php echo $row['int_glcode'];?>">

                                             <td >Rs <?php echo $row['var_amount'];?></td>
                                              
                                             <td><?php echo date('d/m/Y h:i A',strtotime($row['dt_createddate']));?></td>

                                          </tr>

                                           <?php }}else{ ?>

                                          <tr><td colspan="2">No Data Available.</td></tr>

                                           <?php } ?>

                                       </tbody>

                                    

                                 </table>

                               </div>

  </div>
     
     <div id="tab03" class="tab-contents order-history-tab3"> 

  
         <div class="table-responsive">        

                                 <table class="example table table-striped table-bordered">

                                    

                                       <thead>

                                          <tr class="completed-active-tab">

                                             <th style="width: 110px;">Withdraw Amount</th>
                                             
                                             <th style="width: 20%;">DateTime</th>

                                          </tr>

                                       </thead>

                                       <tbody>

                                    

                                           <?php if(count($getCompleted) > 0){     

                                                    foreach ($getCompleted as $row){

                                                        

                                               ?>

                                       <tr id="<?php echo $row['int_glcode'];?>">

                                             <td >Rs <?php echo $row['var_amount'];?></td>
                                              
                                             <td><?php echo date('d/m/Y h:i A',strtotime($row['dt_createddate']));?></td>

                                          </tr>

                                           <?php }}else{ ?>

                                          <tr><td colspan="2">No Data Available.</td></tr>

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


function withdraw_request(price){

       var vendor_id = '<?php echo $_SESSION['fk_vendor'];?>';
       
       swal({
      title: "Are you sure?",
      text: "You Send Withdraw Request to Admin.",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      cancelButtonText: "No",
      confirmButtonText: "Yes",
    }).then((result) => {
      if (result.value) {
        $.ajax({

          url : sitepath+"vendor/withdraw_request/send_withdraw_request",

          data : 'vendor_id='+vendor_id+'&price='+price,      

          type : "POST",        

          success : function(data) {
              
              window.location.href = sitepath+"vendor/withdraw_request";
          },

          error : function(data) {
              
          }

        }); 
      }
    })
}


    </script>