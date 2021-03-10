<style>
.address_type{
 background-color: #ff4e00;
 color: #fff;
 border: 1px solid #ff4e00;
 border-radius: 25px;
 padding: 5px 10px 5px 10px;
}
</style>
<div class="innovatoryBreadcrumb-padd">
 <div class="container">
  <nav data-depth="2" class="breadcrumb hidden-sm-down">
   <ol itemscope="" itemtype="">
    <li itemprop="itemListElement" itemscope="" >
     <a itemprop="item" href="<?php echo base_url();?>">
      <span itemprop="name">Home</span>
    </a>
    <meta itemprop="position" content="1">
  </li>
  <li itemprop="itemListElement">
   <a itemprop="item" href="javascript:;">
    <span itemprop="name">Order Page</span>
  </a>
  <meta itemprop="position" content="2">
</li>
</ol>
</nav>
</div>
</div>
<section>
 <div class="orderPage">
  <div class="container-fluid bg-gray" id="accordion-style-1">
   <div class="container">
    <section>
     <div class="row col-lg-offset-1">
      <div class="col-xs-12 col-md-10 col-lg-11 col-sm-10  mx-auto">
       <div class="accordion" id="accordionExample">
        <div class="card">
         <div class="card-header" id="headingOne">
          <h5 class="mb-0">
           <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fa fa-calendar main"></i> Order Details
          </button>
        </h5>
      </div>
      <div id="collapseOne" class="collapse fade show in" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
         <section id="checkout-personal-information-step" class="checkout-step -current -reachable js-current-step  order-step cart-table-design">
          <table id="ord_details">
            <?php 
            $product_arr = $data[0]['fk_product_arr'];
            ?>
            <thead>
              <tr>
                <th scope="col">Product</th>
                <th scope="col">Weight</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Subtotal</th>
                <th scope="col">GST</th>
                <th scope="col">GST Amount</th>
                <th scope="col">Total</th>
                
              </tr>
            </thead>
            <tbody>
              <?php
              
               foreach ($product_arr as $ckey => $cval) {

                if ($cval['cancel_status'] == 'N') {
                  $final_show_amt = $cval['var_unit'] * $cval['var_price'];
                  $g = $cval['gst_price'] + 100;
                  $total = ($final_show_amt*100)/$g;
                  // $GST = ($final_show_amt*$cval['gst_price'])/100;
                  // $total = $final_show_amt + $GST;
                  
               ?> 
                <tr id="remove_image<?php echo $ckey; ?>" class="row_count">
                  <td data-label="Account"><img src="<?php echo $cval['var_image']; ?>" style="width: 75px;height: 75px;">
                    <span><?php echo $cval['var_name']; ?></span></td>
                    <td data-label="Due Date"><?php echo $cval['var_quantity']; ?></td>
                    <td data-label="Price">&#x20b9;<?php echo $cval['var_price']; ?></td>
                    <td data-label="Unit"><?php echo $cval['var_unit']; ?></td>
                    <td data-label="Price">&#x20b9;<?php echo round($total); ?></td>
                    <td data-label="Price"><?php echo $cval['gst_price']; ?> %</td>
                    <td data-label="Price">&#x20b9;<?php echo $final_show_amt - round($total); ?></td>
                    <td data-label="Price">&#x20b9;<?php echo $final_show_amt; ?></td>
                </tr>
                  <?php } } ?>   
                </tbody>
              </table>
            </section>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingTwo">
         <h5 class="mb-0">
          <button class="btn btn-link collapsed btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
           <i class="fa fa-map-marker main"></i> Addresses Details
         </button>
       </h5>
     </div>
     <div id="collapseTwo" class="collapse fade" aria-labelledby="headingTwo" data-parent="#accordionExample">
       <div class="card-body">
        <section id="checkout-addresses-step" class="checkout-step -current -reachable js-current-step">
        <div class="row">
          <div class="col-md-4 col-sm-12">
           <div id="orderActive" class="order-address-section active">
            <div class="order-address">
          <div> 
              <?php echo $data[0]['var_user_address']; ?>
              <span class="address_type"><?php echo $data[0]['var_address_type'];?></span>
          </div>
          </div>
          <div class="button-position">
            <a class="btn btn-squre btn-primary">Delivery address</a>
          </div>
          </div>
    </div>
    <div class="col-md-4 col-sm-12">
           <div id="orderActive" class="order-address-section active">
            <div class="order-address">
          <div> 
            <label>Alternate Contact No: </label>
              <?php echo $data[0]['var_alternate_mobile']; ?>
          </div>
          </div>
          <div class="button-position">
            <a class="btn btn-squre btn-primary">Contact Details</a>
          </div>
          </div>
    </div>
  </div>
</section>
</div>
</div>
</div>
 <div class="card">
  <form id="place_order" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="total_amount" id="total_amount" value="<?php echo $data[0]['var_total_amount']; ?>">
    <input type="hidden" name="default_no" id="default_no" value="<?php echo $data[0]['var_alternate_mobile']; ?>">
    <input type="hidden" name="total_discount_price" id="total_discount_price" value="<?php echo $data[0]['var_discount_amount']; ?>">
    <div class="card-header" id="headingFour">
     <h5 class="mb-0">
      <button class="btn btn-link collapsed btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
       <i class="fa fa-credit-card main"></i> Payment Details &nbsp; &nbsp; &nbsp;
       (Payment By : <?php echo $data[0]['var_payment_mode']; ?>) <?php
        if ($data[0]['var_promocode'] != '') { ?> &nbsp; &nbsp; &nbsp;  (Applied Promocode : <?php echo $data[0]['var_promocode']; ?>) <?php } ?>
     </button>
   </h5>
 </div>
 <div id="collapseFive" class="collapse fade" aria-labelledby="headingFour" data-parent="#accordionExample">
   <span class="anchor" id="formPayment"></span>
   <!-- form card cc payment -->
   <div class="card-outline-secondary">
    <div class="card-body">
     <div>
      <div class="row">
        <div class="col-md-2">
          <label>Cashback:</label>
          <p>&#x20b9; <?php echo $data[0]['var_cashback']; ?></p>
        </div>
        <div class="col-md-2">
          <label>Total Amount:</label>
          <p id="amount_text">&#x20b9; <?php echo $data[0]['var_total_amount']; ?></p>
          <input type="hidden" name="show_payble_amount" id="show_payble_amount" value="<?php echo $data[0]['var_total_amount']; ?>">
        </div>
        <div class="col-md-2">
          <label>Delivery Charges:</label>
          <p id="show_delivery_charge">&#x20b9; <?php echo $data[0]['var_delivery_charge']; ?></p>
        </div>
        
        <div class="col-md-2">
          <label>Payble Amount:</label>
          <p id="payble_amount_text">&#x20b9; <?php echo $data[0]['var_payable_amount']; ?></p>
          <input type="hidden" name="payble_amount" id="payble_amount" value="<?php echo $data[0]['var_total_amount']; ?>">
          <input type="hidden" name="cal_payable" id="cal_payable" value="<?php echo $data[0]['var_payable_amount'];?>">
        </div>
      </div> 
    </div>
  </div>
</div>
</div>
</form>
</div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</section>
<script  type="text/javascript">
var site_path = "<?php echo base_url(); ?>";
    
function confirmDelete(id)
{
  swal({
    title: "Are you sure?",
    text: "You want to remove this order ?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    cancelButtonText: "No",
    confirmButtonText: "Yes"
  }).then((result) => {
    if (result.value) {

          $('tr#remove_image' + id + '').css("display", "none");
          $('#cancel_status'+id).val('Y');
          var updteRowCount = $("tr.row_count:visible").length;
          //alert(updteRowCount);

          if (updteRowCount == '1') {
            $('.remove_add').hide();
            $('.show_action').hide();
          }
          
        //$(location).attr('href','<?php //echo base_url() ?>album/deleteimges/'+id);
      }
    })
}

$(document).ready(function() {  
  var url_id = '<?php echo $this->uri->segment(3); ?>';
  $("form#update_table_order").submit(function() {
    var formData = new FormData($(this)[0]);
   $.ajax({
    url: site_path + "orders/UpdateOrder",
    type: 'POST',
    data: formData,
    async: false,
    success: function(response) {
          window.location.href = site_path +'orders/viewDetails/'+url_id;      
        },

          cache: false,
          contentType: false,
          processData: false

      });
      return false;
  });
});
</script>