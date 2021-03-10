<style>
.address_type{
 background-color: #ff4e00;
 color: #fff;
 border: 1px solid #ff4e00;
 border-radius: 25px;
 padding: 5px 10px 5px 10px;
}
</style>
<div class="innovatoryBreadcrumb">
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
     <div class="row">
      <div class="col-xs-12 col-md-10 col-sm-10  mx-auto">
       <div class="accordion" id="accordionExample">
        <div class="card">
         <div class="card-header" id="headingOne">
          <h5 class="mb-0">
           <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fa fa-calendar main"></i> Order Details
          </button>
        </h5>
      </div>
      <div id="collapseOne" class="collapse  show fade" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
         <section id="checkout-personal-information-step" class="checkout-step -current -reachable js-current-step  order-step cart-table-design">
          <table>
            <thead>
              <tr>
                <th scope="col">Product</th>
                <th scope="col">Weight</th>
                <th scope="col">Price</th>
                <th scope="col">Payable Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
              </tr>
            </thead>
            <tbody>
              <?php $grand_total = 0;
              $total_final_amt = 0;
              $final_grand_total = 0;
              if (isset($_SESSION['cart_item'])) {
               foreach ($_SESSION['cart_item'] as $ckey => $cval) { ?>  
                <tr>
                  <td data-label="Account"><img src="<?php echo $cval['image']; ?>" style="width: 75px;height: 75px;">
                    <span><?php echo $cval['title']; ?></span></td>
                    <td data-label="Due Date"><?php echo $cval['weigth']; ?></td>
                    <td data-label="Period">&#x20b9;<?php echo $cval['price']; ?></td>
                    <td data-label="Period">&#x20b9;<?php echo $cval['dis_price']; ?></td>
                    <td data-label="Amount"><?php echo $cval['quantity']; ?></td>
                    <td data-label="Period">&#x20b9;<?php echo $cval['dis_price'] * $cval['quantity']; ?></td>
                  </tr>
                  <?php
                  $grand_total = $grand_total + $cval['grand_total']; 
                  $final_grand_total += $cval['dis_price'] * $cval['quantity'];

                  $total_final_amt = ($cval['price'] * $cval['quantity']) + $total_final_amt;
                } } 
                  if (isset($_SESSION['cart_item'])) {
                  	$total_amount_price = number_format(array_sum(array_column($_SESSION['cart_item'], 'price')),2);
                  	$total_discount_price = number_format(array_sum(array_column($_SESSION['cart_item'], 'dis_price')),2);
                  	$discount_price = number_format($total_final_amt - $final_grand_total,2);
                  	$total_quantity = array_sum(array_column($_SESSION['cart_item'], 'quantity'));
                    
                  } else {
                  	$total_amount_price = '0';
                  	$total_discount_price = '0';
                  	$total_quantity = '0';
                  }
                  
                  ?>
                  <tr>
                    <td colspan="2"><b>Total </b></td>
                    <td>&#x20b9;<?php echo $total_final_amt;?></td>
                    <td>&#x20b9;<?php echo $total_discount_price;?></td>
                    <td><?php echo $total_quantity;?></td>
                    <td>&#x20b9;<?php echo $final_grand_total;?></td>
                  </tr>
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
           <i class="fa fa-map-marker main"></i> Contact No. Details
         </button>
       </h5>
     </div>
     <div id="collapseTwo" class="collapse  show fade" aria-labelledby="headingTwo" data-parent="#accordionExample">
       <div class="card-body">
        <section id="checkout-addresses-step" class="checkout-step -current -reachable js-current-step">
        <div class="row">
            <form method="POST" id="updateAlterNo" action="" class="form-horizontal" enctype='multipart/form-data'>
                <input type="hidden" name="fk_user_no" id="fk_user_no" value="<?php echo $data['int_glcode']; ?>"> 
                    <div class="col-sm-3">
                      <label class="control-label">Current Default No. </label><p><?php echo $data['var_default_no']; ?></p>
                    </div>
                     <div class="col-sm-3">
                        <div class="form-group">
                          <?php 
                          if ($data['var_alt_mobile'] != '') {
                            $alternate_number = $data['var_alt_mobile'];
                            $btn_lable = "Edit Number";
                            $open_model = "updateOtpModal";
                          } else {
                            $alternate_number = '';
                            $btn_lable = "Add Number";
                            $open_model = "otpModal";
                          }
                          ?>
                           <label class="control-label">Alternate Mobile No. <span class="mandatory">*</span></label>
                           <input class="form-control border-form-control" value="<?php echo $alternate_number; ?>" placeholder="Please Enter Alternate Mobile No." type="text" name="var_alt_mobile" id="var_alt_mobile" onkeypress="return isNumberKey(event);" max="15" min="10" required> 
                        </div>
                     </div>
                     <div class="col-sm-3">
                      <?php 
                if($data['var_alt_mobile'] == $data['var_default_no']) { ?>
                  <a class="btn btn-squre btn-primary" onclick="setDefaultContact('<?php echo $data['int_glcode']; ?>','N');">Remove Default</a>
               <?php } elseif ($data['var_alt_mobile'] != '') { ?>
                  <a class="btn btn-squre btn-primary" onclick="setDefaultContact('<?php echo $data['int_glcode']; ?>','Y');">Set as Default</a>
               <?php } else { ?>
                  
               <?php } ?>
                     </div>
                     <div class="col-sm-3 text-right">
                        <label class="control-label"> </label>
                          <button name="submit" class="btn btn-primary form-control-submit pull-xs-right" data-toggle="modal" data-target="#<?php echo $open_model; ?>" type="submit">
                              <?php echo $btn_lable; ?>
                          </button>
                    </div>
                  </div>
              </form>
</section>
</div>
</div>
</div>
      <div class="card">
        <div class="card-header" id="headingTwo">
         <h5 class="mb-0">
          <button class="btn btn-link collapsed btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
           <i class="fa fa-map-marker main"></i> Delivery Addresses
         </button>
       </h5>
     </div>
     <div id="collapseTwo" class="collapse  show fade" aria-labelledby="headingTwo" data-parent="#accordionExample">
       <div class="card-body">
        <section id="checkout-addresses-step" class="checkout-step -current -reachable js-current-step">
         <div class="row">
          <div class="col-md-6 col-xs-6 col-sm-9">
          </div>
          <div class="col-md-6 col-xs-6 col-sm-3">
            <button class="btn btn-primary continue pull-xs-right tg-btndropdown show-modal donorWantLogin" data-toggle="modal" data-target="#AddNewAddress">Add Address</button>
          </div>
        </div>
        <div class="row">

         <?php foreach ($address as $row1){ ?>
          <div class="col-md-4 col-sm-12" id="remove_image<?php echo $row1['int_glcode']; ?>">
           <div id="orderActive" class="order-address-section active">
            <div class="order-address">
             <button type="button" class="btn btn-secondary edit_address" data-toggle="modal" data-target="#addressEditModal" data-whatever="@mdo" data-id="<?php echo $row1['int_glcode']; ?>"><i class="fa fa-edit"></i> Edit</button>
             <div class="remove_add">
               <a href="javascript:;" class="btnRemove" onclick="confirmDelete('<?php echo $row1['int_glcode']; ?>')"><img id="img" class="closeicondrag" src="<?php echo base_url(); ?>public/assets/images/site_imges/x.png" alt="delete"></a>
             </div>
<!--<h6>Jhon Smith</h6><a href="mailto:jhons54684@example.com">jhons54684@example.com</a><br>-->
 <div> <?php echo $row1['var_house_no'].', '.$row1['var_app_name'].',';?><br>
  <?php echo $row1['var_landmark'].', '.$row1['var_city'].',';?><br>
  <?php echo $row1['var_state'].', '.$row1['var_country'].' - '.$row1['var_pincode'];?><br>
  <span class="address_type"><?php echo $row1['chr_type'];?></span>
</div>
</div>
<div class="button-position">
 <?php 
 if ($row1['default_status'] == 'Y') {
  $address_type = $row1['chr_type'];
  ?>
  <a class="btn btn-squre btn-primary" style="background-color: #51aa1b;">Delivery address</a>
<?php } else { ?>
  <a class="btn btn-squre btn-primary" onclick="setDefault('<?php echo $row1['int_glcode']; ?>','<?php echo $row1['fk_user']; ?>');">Deliver to this address</a>
<?php } ?>

</div>
</div>
</div>
<?php } ?>

</div>
</section>
</div>
</div>
</div>
<div class="card">
 <div class="card-header" id="headingOne">
  <h5 class="mb-0">
   <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
    <i class="fa fa-calendar main"></i> Set Date
  </button>
</h5>
</div>
<div id="collapseThree" class="collapse  show fade" aria-labelledby="headingOne" data-parent="#accordionExample">
  <div class="card-body">
   <section id="checkout-personal-information-step" class="checkout-step -current -reachable js-current-step  order-step">
    <div class="deliveryOption">
     <div>
      <div>
       <h5><?php echo date('F Y');?></h5> 
       <div class="day-slider">
        <div class="request_radio-round">
         <div class="row">
          <div class="col-md-3 text-center">
           <div class="check_box_div-round">
            <input id="option_date12" type="radio" name="delivery_date" value="<?php echo date('Y-m-d');?>" onclick="get_delivery_timeslot1('<?php echo date('Y-m-d');?>')" required="">            
            <label for="option_date12"><span class="days-circle"><span class="date-day">Today</span></span> </label>    
            <p><?php echo date('l');?></p>
          </div>
        </div>
        <div class="col-md-3 text-center">
         <div class="check_box_div-round">
          <input id="option_date13" type="radio" name="delivery_date" value="<?php echo date('Y-m-d',strtotime('+1 day'));?>" onclick="get_delivery_timeslot1('<?php echo date('Y-m-d',strtotime('+1 day'));?>')" required="">            
          <label for="option_date13"><span class="days-circle"><span class="date-day">Tomorrow</span></span> </label>    
          <p><?php echo date('l',strtotime('+1 day'));?></p>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</section>
</div>
</div>
</div>
<div class="card">
 <div class="card-header" id="headingThree">
  <h5 class="mb-0">
   <button class="btn btn-link collapsed btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
    <i class="fa fa-truck main"></i> Delivery Type And Time
  </button>
</h5>
</div>
<div id="collapseFour" class="collapse  show fade" aria-labelledby="headingThree" data-parent="#accordionExample">
  <div class="card-body">
   <section id="checkout-delivery-step" class="checkout-step -current -reachable js-current-step">
    <div class="content">
     <div id="hook-display-before-carrier">
     </div>
     <div class="delivery-options-list">
      <form class="clearfix" id="js-delivery" data-url-update="javascript:;" method="post">
       <div class="form-fields">
        <div class="request_radio">

          <?php foreach($delivery_charge as $key => $row2){ ?>
           <div class="check_box_div" id="div_type<?php echo $row2['chr_type']; ?>">
             <input id="option_charge<?php echo $key;?>" type="radio" name="delivery_type" value="<?php echo $row2['chr_type'];?>" onclick="get_delivery_timeslot('<?php echo $row2['chr_type'];?>')" required="">            
             <label for="option_charge<?php echo $key;?>"><span><span><?php echo $row2['var_label'];?></span></span>  </label>              
           </div>
         <?php } ?>
       </div>

       <div class="order-options">
       </div>
       <div>
         <label>
          <h5>Selected a Delivery Slot</h5>
        </label>
        <div class="request_radio" id="delivery_timeslot" style="display:none;">
          <div class="check_box_div">                                           
           <input id="option_noncr15" type="radio" name="delivery_timeslot" value="08:00 am - 10:00 am" required="">            
           <label for="option_noncr15"><span><span>08:00 am - 10:00 am</span></span>  </label>
         </div>
       </div>
     </div>
   </div>
<!--<button type="submit" class="continue btn btn-primary pull-xs-right" name="confirmDeliveryOption" value="1"> Continue </button>-->
               </form>
             </div>
             <div id="hook-display-after-carrier">
             </div>
             <div id="extra_carrier"></div>
           </div>
         </section>
       </div>
     </div>
   </div>
 <div class="card">
  <form id="place_order" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="total_amount" id="total_amount" value="<?php echo $total_final_amt;?>">
    <input type="hidden" name="default_no" id="default_no" value="<?php echo $data['var_default_no']; ?>">
    <input type="hidden" name="address_type" id="address_type" value="<?php echo $address_type; ?>">
    <input type="hidden" name="total_discount_price" id="total_discount_price" value="<?php echo $discount_price; ?>">
    <div class="card-header" id="headingFour">
     <h5 class="mb-0">
      <button class="btn btn-link collapsed btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
       <i class="fa fa-credit-card main"></i> Payment
     </button>
   </h5>
 </div>
 <div id="collapseFive" class="collapse  show fade" aria-labelledby="headingFour" data-parent="#accordionExample">
   <span class="anchor" id="formPayment"></span>
   <!-- form card cc payment -->
   <div class="card-outline-secondary">
    <div class="card-body">
     <div>
      <div class="row">
        <?php
          //$discount_price = floatval($total_amount_price) - floatval($total_discount_price);
          if ($data['var_wallet'] == '0') {
              $Wallet_dis = 'disabled';
          } else {
            $Wallet_dis = '';
          }
        ?>
        <div class="col-md-2 payable_div" id="payable_div">
          <input type="checkbox" class="form-control" name="var_wallet" id="var_wallet" onclick="userWallet('payable_div',$(this));" <?php echo $Wallet_dis; ?>>
          Wallet (&#x20b9; <?php echo $data['var_wallet']; ?>)
          <input type="hidden" name="var_wallet_amount" id="var_wallet_amount" value="<?php echo $data['var_wallet']; ?>">
          <input type="hidden" name="save_wallet_amount" id="save_wallet_amount" value="0">
          <input type="hidden" name="user_walllet" id="user_walllet" value="<?php echo $data['var_wallet']; ?>">
          <input type="hidden" name="use_walllet" id="use_walllet" value="">
        </div>
        <div class="col-md-2">
        	<?php 
          if (isset($_SESSION['promocode_amout'])) {
              if ($_SESSION['promocode_type'] == 'A') {
                  $cashback = $_SESSION['promocode_amout'];
                  $promocode = $_SESSION['promocode'];
              } elseif ($_SESSION['promocode_type'] == 'P') {
                  $percantage = ($_SESSION['promocode_amout'] / 100) * $final_grand_total;
                  $cashback = $percantage;
                  $promocode = $_SESSION['promocode'];
              } else {
                $cashback = '0';
                $promocode = '';
              }
          } else {
            $cashback = '0';
            $promocode = '';
          }
          ?>
          <label>Cashback:</label>
          <p id="show_cashback">&#x20b9; <?php echo $cashback; ?></p>
          <input type="hidden" name="get_cashback" id="get_cashback" value="<?php echo $cashback; ?>">
          <input type="hidden" name="get_promocode" id="get_promocode" value="<?php echo $promocode; ?>">
        </div>
        <div class="col-md-2">
          <label>Delivery Charges:</label>
          <p id="show_delivery_charge">&#x20b9; 0</p>
          <input type="hidden" value="0" id="add_delivery_charges">
          <input type="hidden" id="get_delivery_charges" name="get_delivery_charges">
          
        </div>
        <div class="col-md-2">
          <label>Discount:</label>
          <p id="show_delivery_charge">&#x20b9; <?php echo $discount_price; ?></p>
          <input type="hidden" value="0" id="add_delivery_charges">
        </div>
        <div class="col-md-2">
          <label>Total Amount:</label>
          <p id="amount_text">&#x20b9; <?php echo $total_final_amt; ?></p>
          <input type="hidden" name="show_payble_amount" id="show_payble_amount" value="<?php echo $total_amount_price; ?>">
          <input type="hidden" name="calculat_amount" id="calculat_amount" value="<?php echo $total_final_amt; ?>">
        </div>
        <div class="col-md-2">
          <label>Payble Amount:</label>
          <p id="payble_amount_text">&#x20b9; <?php echo $final_grand_total; ?></p>
          <input type="hidden" name="payble_amount" id="payble_amount" value="<?php echo $final_grand_total; ?>">
          <input type="hidden" name="cal_payable" id="cal_payable" value="<?php echo $final_grand_total;?>">
          <input type="hidden" id="checkbox_payable" value="<?php echo $final_grand_total;?>">
        </div>
      </div> 
      <div class="request_radio">
        <div class="check_box_div">                  
          <input id="paytm_charge0" type="radio" name="var_payment_mode" value="P" required="">            
          <label for="paytm_charge0"><span><span><img src="<?php echo base_url().'public/front_assets/images/paytm-radio.png';?>" style="width: 100px;"></span></span>  </label>              
        </div>
        <div class="check_box_div">            
          <input id="delivery_charge1" type="radio" name="var_payment_mode" value="C" required="">            
          <label for="delivery_charge1"><span><span><img src="<?php echo base_url().'public/front_assets/images/cod-radio.png';?>" style="width: 100px;"></span></span>  </label>              
        </div>
        <div class="check_box_div">  
        <?php 
        if (isset($_SESSION['promocode'])) { ?>
          <a class="btn btn-primary show-modal" data-toggle="modal" data-target="#promocodeModal"><img src="https://cidev.in/vruits/public/front_assets/images/discount.png" style="width: 16px;"> Change Promocode</a>
        <?php } else { ?>
          <a class="btn btn-primary show-modal" data-toggle="modal" data-target="#promocodeModal"><img src="https://cidev.in/vruits/public/front_assets/images/discount.png" style="width: 16px;"> Apply Promocode</a>
       <?php } ?>
                         
        </div>
        <div class="check_box_div">
          <button class="btn btn-primary" type="submit"><img src="https://cidev.in/vruits/public/front_assets/images/Icono_formu.png" style="width: 20px;"> Place Order</button>
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
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </section>

            <div class="modal fade in" id="AddNewAddress" tabindex="-1" role="dialog" aria-labelledby="login" style="display: none;">
              <div class="modal-dialog" role="document">
               <div class="modal-content">
                <div class="modal-body padding_0">
                 <div class="row">
                  <div class="col-md-12">
                   <div class="woocommerce-billing-fields">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">x</span>
                   </button>
                   <div class="vc_divider" style="height:30px"></div>
                   <h5 style="text-align: center;">Add New Address</h5>
                   <form class="contact-form row" method="post" id="add_user_address" action="<?php echo base_url(); ?>user/addAddress">
                     <div class="form-field col-lg-6">
                      <input id="var_house_no" name="var_house_no" class="input-text js-input" type="text" required="" placeholder="House No *">
                    </div>
                    <div class="form-field col-lg-6 ">
                      <input id="var_app_name" name="var_app_name" class="input-text js-input" type="var_app_name" required="" placeholder="Apar/Street name *">
                    </div>
                    <div class="form-field col-lg-12 ">
                      <input id="var_landmark" name="var_landmark" class="input-text js-input" type="text" required="" placeholder="Landmark *">
                    </div>
                    <div class="form-field col-lg-6 ">
                      <input id="var_city" name="var_city" class="input-text js-input" type="text" required="" placeholder="City name *">
                    </div>
                    <div class="form-field col-lg-6">
                      <input id="var_state" name="var_state" class="input-text js-input" type="text" required="" placeholder="State *">
                    </div>
                    <div class="form-field col-lg-6 ">
                      <input id="var_country" name="var_country" class="input-text js-input" type="text" required="" placeholder="Country *">
                    </div>
                    <div class="form-field col-lg-6">
                      <input id="var_pincode" name="var_pincode" class="input-text js-input" type="text" required="" placeholder="Pincode *">
                    </div>
                    <h6>Choose Nick name for this address</h6>
                    <div class="form-field col-lg-12 ">
                     <div class="request_radio">
                       <div class="check_box_div" style="margin:0px 0px;">                            
                         <input id="option_type0" type="radio" name="chr_type" value="Home" required="" checked="">            
                         <label for="option_type0"><span><span>Home</span></span>  </label>    
                       </div>
                       <div class="check_box_div" style="margin:0px 0px;">
                         <input id="option_type1" type="radio" name="chr_type" value="Office" required="">            
                         <label for="option_type1"><span><span>Office</span></span>  </label>          
                       </div>
                       <div class="check_box_div" style="margin:0px 0px;">  
                         <input id="option_type2" type="radio" name="chr_type" value="Other" required="">            
                         <label for="option_type2"><span><span>Other</span></span>  </label>          
                       </div>
                     </div>
                   </div> 

                   <div class=" col-lg-12">
                    <input type="checkbox" value="Y" name="default_status" id="default_status"> Set as default address
                  </div>
                  <div class="form-field col-lg-12">
                    <input class="btn btn-primary" type="submit" value="ADD ADDRESS">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="promocodeModal" tabindex="-1" role="dialog" aria-labelledby="addonLabel1">
    <div class="modal-dialog" role="document" >
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel1">Apply Promocode</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div id="msgPromocode_modal"></div>
         <form method="post" id="apply_promocode" action="javascript:;">
            <input type="hidden" name="fk_user_promo" id="fk_user_promo" value="<?php echo $data['int_glcode']; ?>">
        <div class="form-group row ">
        <label class="col-md-4 form-control-label required">Promocode <span class="mandatory">*</span></label>
        <div class="col-md-8">
          <?php 
          if (isset($_SESSION['promocode_amout'])) {
            $promocode = $_SESSION['promocode'];
          } else {
            $promocode = '';
          }
          ?>
          <input type="text" name="var_promocode" id="var_promocode" class="form-control" required="" placeholder="Enter Promocode" value="<?php echo $promocode; ?>">

          <input type="hidden" name="promocode_val" id="promocode_val" value="<?php echo $promocode; ?>">
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Apply</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
      </div>
      </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="addressEditModal" tabindex="-1" role="dialog" aria-labelledby="addonLabel1">
    <div class="modal-dialog" role="document" >
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel1">Edit Address</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="otpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">OTP Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div id="msgSubmit_modal"></div>
         <form method="post" id="user_otp_form" action="javascript:;">
            <input type="hidden" name="fk_user_id" id="fk_user_id" value="<?php echo $data['int_glcode']; ?>"> 
            <input type="hidden" name="alternate_no" id="alternate_no" value="">
            <input type="hidden" name="var_default_sts" id="var_default_sts" value="">
            <div class="form-group row ">
        <label class="col-md-2 form-control-label required">OTP Number</label>
        <div class="col-md-7">
          <input type="text" name="var_otp" id="var_otp" class="form-control" required="" onkeypress="return isNumberKey(event);">
        </div>
        <div class="col-md-3 form-control-comment">
        </div>
      </div>
         
         <button type="button" class="btn btn-primary" onclick="resend_otp();">Resend</button>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
  <script>
    var site_path = '<?php echo base_url();?>';
    var s_charges = Number('<?php echo $delivery_charge[0]['var_below']; ?>');
    var s_charges_amt = Number('<?php echo $delivery_charge[0]['var_charges']; ?>');

    var u_charges = Number('<?php echo $delivery_charge[1]['var_below']; ?>');
    var u_charges_amt = Number('<?php echo $delivery_charge[1]['var_charges']; ?>');

    function get_delivery_timeslot(type){

    	var del_type_val = $("input[name='delivery_type']:checked").val();

      	var payable_amt_val = Number($("#payble_amount").val());
      	var calculation_payable = Number($("#cal_payable").val());

	    if ((del_type_val == 'S') && (payable_amt_val < s_charges)) {
	    	
	    	$('#show_delivery_charge').html('&#x20b9;'+ s_charges_amt);
	    	$('#get_delivery_charges').val(s_charges_amt);
        	$('#add_delivery_charges').val(s_charges_amt);
	    	var final_payable_amt = parseFloat(calculation_payable) + parseFloat(s_charges_amt);
	    	$('#payble_amount_text').html('&#x20b9;'+ final_payable_amt);
	    	$('#payble_amount').val(final_payable_amt);
	    } else if ((del_type_val == 'U') && (payable_amt_val < u_charges)) {
	    	//alert("Ultra")
	    	$('#show_delivery_charge').html('&#x20b9;'+ u_charges_amt);
	    	$('#get_delivery_charges').val(u_charges_amt);
        	$('#add_delivery_charges').val(u_charges_amt);
	    	var final_payable_amt = parseFloat(calculation_payable) + parseFloat(u_charges_amt);
	    	$('#payble_amount_text').html('&#x20b9;'+ final_payable_amt);
	    	$('#payble_amount').val(final_payable_amt);
	    } else {
	    	$('#show_delivery_charge').html('&#x20b9; 0');
	    	$('#get_delivery_charges').val('0');
        	$('#add_delivery_charges').val('0');
	    	$('#payble_amount_text').html('&#x20b9;'+ calculation_payable);
	    	$('#payble_amount').val(calculation_payable);
	    }

      var radioValue = $("input[name='delivery_date']:checked").val();

      $.ajax({
        type:'POST',
        url:site_path+'cart/get_delivery_timeslot',
        data:'type='+type+'&delivery_date='+radioValue,
        success:function(response){
          $('#delivery_timeslot').show();
         $('#delivery_timeslot').replaceWith(response);

       }
     });
      	
    }

    function get_delivery_timeslot1(date){
      var radioValue = $("input[name='delivery_type']:checked").val();
      //alert(radioValue);
      $.ajax({
        type:'POST',
        url:site_path+'cart/get_delivery_timeslot',
        data:'type='+radioValue+'&delivery_date='+date,
        success:function(response){
         $('#delivery_timeslot').replaceWith(response);
         $('#delivery_timeslot').hide();
         var d = new Date();

        var month = d.getMonth()+1;
        var day = d.getDate();

        var output = d.getFullYear() + '-' +
            (month<10 ? '0' : '') + month + '-' +
            (day<10 ? '0' : '') + day;

         if (date != output) {
          $('#div_typeU').hide();
          
        } else {
         $('#div_typeU').show();

       }
        }
     });
    }

    $(function(){
      $('.edit_address').on("click", function(){
        var reasonKey = $(this).attr("data-id");
        $.ajax({          
          type: "POST",
          url: site_path+'user/edit_address',
          data: {'reasonKey':reasonKey},
          cache: false,
          success: function(result)
          {
          //alert(result)
          $('#addressEditModal .modal-body').html(result);
            //alert(result);
          //rating function calling
        }
      });
      })
    });
  </script>
  <script type="text/javascript">
    function confirmDelete(id)
    {
      swal({
        title: "Are you sure?",
        text: "You want to delete this address ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        cancelButtonText: "No",
        confirmButtonText: "Yes"
      }).then((result) => {
        if (result.value) {
          $.ajax(
          {
            url: site_path + "admin/user/deleteAddress",
            method: 'POST',
            data:
            {
              id: id
            },
            success: function (result)
            {
              //$("div#removeimages"+id).remove();
              $('div#remove_image' + id + '').remove();
            }
          });
            //$(location).attr('href','<?php //echo base_url() ?>album/deleteimges/'+id);
          }
        })
    }

    function setDefault(id,userId)
    {
      swal({
        title: "Are you sure?",
        text: "You want to deliver at this address ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        cancelButtonText: "No",
        confirmButtonText: "Yes"
      }).then((result) => {
        if (result.value) {
          $.ajax(
          {
            url: site_path + "user/default_address",
            method: 'POST',
            data:
            {
              id: id,userId:userId
            },
            success: function (result)
            {
             window.location.href = site_path+'cart/checkout';
           }
         });
            //$(location).attr('href','<?php //echo base_url() ?>album/deleteimges/'+id);
          }
        })
    }
 //$("#basicinfofrm").validator().on("submit", function (event) {
  $("form#updateAlterNo").submit(function() {
  //  $('#client_infobtn').attr('disabled', true);
    var alternate_no = $('#var_alt_mobile').val();
    $('#alternate_no').val(alternate_no);

    if ($("#default_status").is(":checked") ){
      $("#var_default_sts").val('Y');
  } else {
      $("#var_default_sts").val('N');
  }

     $(".loading").show();

        var formData = new FormData($(this)[0]);

            $.ajax({
                url: site_path + "user/update_contactno",
                type: 'POST',
                data: formData,
                async: false,
                success: function(response) {
                  //alert(response)
                  
                    $(".loading").hide();
                    $("#otpModal").modal('show');

                },

                cache: false,
                contentType: false,
                processData: false

            });
            return false;
        
  });

function resend_otp()
{
  var var_alt_mobile = $('#var_alt_mobile').val();
  var fk_user_no = $('#fk_user_no').val();
  $.ajax({
      url: site_path + "user/update_contactno",
      dataType: 'json',
      type: 'POST',
      data: { fk_user_no: fk_user_no,
        var_alt_mobile: var_alt_mobile },
      async: false,
      success: function(response) {

        var msg = 'OTP Sent Successfully !';
        var msgClasses = "h3 text-center tada animated text-success";
        $("#msgSubmit_modal").removeClass().addClass(msgClasses).text(msg);

        //window.location.href = site_path + 'user';
                
        },
    });
}


$("form#user_otp_form").submit(function() {

    var var_otp = $('#var_otp').val();
    // var fk_user = $('#fk_user').val();

    if (var_otp == '') {
      var msg = 'Please enter received OTP !';
      var msgClasses = "h3 text-center tada animated text-danger";
      $("#msgSubmit_modal").removeClass().addClass(msgClasses).text(msg);
    } else {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: site_path + "user/verify_otp",
            type: 'POST',
            data: formData,
            async: false,
            success: function(response) {
              //alert(response)
                if (response == '') {

                    var msg = 'OTP Not Matched !';
                    var msgClasses = "h3 text-center tada animated text-danger";
                    $("#msgSubmit_modal").removeClass().addClass(msgClasses).text(msg);
                    //window.location.reload();
                    return false;
                } else {

                    window.location.href = site_path + 'cart/checkout';
                }
            },

            cache: false,
            contentType: false,
            processData: false

        });
    }
});
function setDefaultContact(userId,flag)
{
  if (flag == 'Y') {
    var title = 'Set Default';
  } else {
    var title = 'Remove Default';
  }

    swal({
      title: "Are you sure?",
      text: "You want to "+title+" this contact no. ?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      cancelButtonText: "No",
      confirmButtonText: "Yes"
    }).then((result) => {
      if (result.value) {
        $.ajax(
        {
          url: site_path + "user/default_contact",
          method: 'POST',
          data:
          {
            userId:userId,flag:flag
          },
          success: function (result)
          {
             window.location.href = site_path+'cart/checkout';
            }
          });
            //$(location).attr('href','<?php //echo base_url() ?>album/deleteimges/'+id);
          }
        })
    }
  </script>
<script type="text/javascript">
    $( document ).ready(function() {  
     $("form#place_order").submit(function() {
    //  $('#client_infobtn').attr('disabled', true);
  
  if (!$("input[name='delivery_date']:checked").val()) {
    alert('Please select Delivery Date!');
    return false;
  } else if(!$("input[name='delivery_type']:checked").val()) {
    alert('Please select Delivery Time and Type!');
    return false;
  } else {
   $(".loading").show();

   var total_amount = $('#total_amount').val();
   var var_payment_mode = $("input[name='var_payment_mode']:checked").val();
   var default_no = $('#default_no').val();
   var delivery_date = $("input[name='delivery_date']:checked").val();
   var delivery_type = $("input[name='delivery_type']:checked").val();
   var delivery_time = $("input[name='delivery_timeslot']:checked").val();
   var delivery_charge = $("#get_delivery_charges").val();
   var address_type = $("#address_type").val();
   var total_discount_price = $("#total_discount_price").val();
   var payble_amount = $('#payble_amount').val();
   var var_wallet_amount = $('#save_wallet_amount').val();
   var var_cashback = $('#get_cashback').val();
   var var_promocode = $('#get_promocode').val();
   var user_wallet = $('#user_walllet').val();

   $.ajax({
    url: site_path + "cart/place_order/add_user_order",
    type: 'POST',
    data: {total_amount:total_amount,var_payment_mode:var_payment_mode,delivery_date:delivery_date,delivery_time:delivery_time,default_no:default_no,delivery_type:delivery_type,address_type:address_type,total_discount_price:total_discount_price,payble_amount:payble_amount,var_wallet_amount:var_wallet_amount,var_cashback:var_cashback,var_promocode:var_promocode,delivery_charge:delivery_charge,user_wallet:user_wallet},
    success: function(response) {
              
          window.location.href = site_path +'order_success';      
        },
      });
      return false;
    }
  });
});

function userWallet(e, t) {
  if (t.is(':checked')) {
      var del_chr = $('#add_delivery_charges').val();
      var pay_mt = Number($('#payble_amount').val());
      var wallet_amt = Number($('#var_wallet_amount').val());

      if (wallet_amt < pay_mt) {
        var dis_amt = pay_mt - wallet_amt;
        var user_wallet = dis_amt;
        var final_amt = parseFloat(del_chr) + parseFloat(dis_amt);
        var send_wallet = wallet_amt;

      } else {
        var dis_amt = pay_mt - wallet_amt;
        var user_wallet = '0';
        var final_amt = '0';
        var send_wallet = pay_mt;
      }

      //alert(send_wallet);
      
      $('#payble_amount_text').html('&#x20b9; '+final_amt);
      $('#cal_payable').val(final_amt);
      $('#save_wallet_amount').val(send_wallet);
      $('#user_walllet').val(send_wallet);

    } else {
      var del_chr_else = $('#add_delivery_charges').val();
      var pay_mt_check = $('#payble_amount').val();
      var final_amt_else = parseFloat(pay_mt_check) + parseFloat(del_chr_else);
      $('#payble_amount_text').html('&#x20b9; '+final_amt_else);
      $('#cal_payable').val(final_amt_else);
      $('#save_wallet_amount').val('0');
      //$('#payble_amount').val(pay_mt);
    }
}

$("form#apply_promocode").submit(function() {

    var var_promo = $('#var_promocode').val();
    // var fk_user = $('#fk_user').val();

    if (var_promo == '') {
      var msg = 'Please enter Valid Promocode !';
      var msgClasses = "h3 text-center tada animated text-danger";
      $("#msgPromocode_modal").removeClass().addClass(msgClasses).text(msg);
    } else {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: site_path + "user/verify_promocode",
            type: 'POST',
            data: formData,
            async: false,
            success: function(response) {
            	var arr = $.parseJSON(response);
              	var message = arr.message;
              
                if (message == 'used') {
                    var msg = 'This Promocode is only for new user !';
                    var msgClasses = "h3 text-center tada animated text-danger";
                    $("#msgPromocode_modal").removeClass().addClass(msgClasses).text(msg);
                    //window.location.reload();
                    return false;
                } else if (message == 'invalid') {
                    var msg = 'Please Enter Valid Promocode !';
                    var msgClasses = "h3 text-center tada animated text-danger";
                    $("#msgPromocode_modal").removeClass().addClass(msgClasses).text(msg);
                    return false;
                } else if (message == 'ord_used') {
                    var msg = 'This Promocode is use once per user !';
                    var msgClasses = "h3 text-center tada animated text-danger";
                    $("#msgPromocode_modal").removeClass().addClass(msgClasses).text(msg);
                    return false;
                } else {
                  var msg = 'Promocode Applied Successfully !';
                  var msgClasses = "h3 text-center tada animated text-success";
                  $("#msgPromocode_modal").removeClass().addClass(msgClasses).text(msg);

                  var payble_amt = $('#payble_amount').val();
                  var promocode = arr.promocode;
                  var amt_type = arr.amt_type;
                  var amount = arr.amt;

                  if (amt_type == 'P') {
                  	var get_cal = (amount / 100) * payble_amt;
                  	var cashback = get_cal.toFixed(2);
                  } else if (amt_type == 'A') {
                  	var cashback = amount;
                  } else {
                  	var cashback = '';
                  }
                  	

                $('#show_cashback').html('&#x20b9; '+ cashback);
                $('#get_cashback').val(cashback);
	    		      $('#get_promocode').val(promocode);

	    		setTimeout(function() {$('#promocodeModal').modal('hide');}, 3000);
	    		setTimeout(function() {$('#msgPromocode_modal').modal('hide');}, 3000);
                  //window.location.href = site_path + 'cart/checkout';
                }
            },

            cache: false,
            contentType: false,
            processData: false

        });
    }
});
</script>