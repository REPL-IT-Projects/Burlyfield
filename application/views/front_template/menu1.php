<nav class="navbar navbar-expand-xl navbar-dark fixed-top" id="banner">

   <div class="container-fluid">

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">

         <span class="navbar-toggler-icon"></span>

      </button>

      <div class="collapse navbar-collapse dual-nav order-1 order-md-0" id="collapsibleNavbar">

         <ul class="navbar-nav">

            <li class="nav-item ">

               <a class="nav-link <?php if($this->uri->segment(1) == ''){echo "active"; } ?>" href="<?php echo base_url(); ?>">Home</a>

            </li>

            <li class="nav-item">

               <a class="nav-link <?php if($this->uri->segment(1) == 'aboutus'){echo "active"; } ?>" href="<?php echo base_url(); ?>aboutus">About Us</a>

            </li>

            <li class="nav-item">

               <a class="nav-link <?php if($this->uri->segment(1) == 'product'){echo "active"; } ?>" href="<?php echo base_url(); ?>product">Products</a>

            </li>

            <!-- <li class="nav-item">

               <a class="nav-link" href="#">Fruits</a>

            </li>

            <li class="nav-item">

               <a class="nav-link" href="#">Vegetables</a>

            </li>

            <li class="nav-item">

               <a class="nav-link" href="#">More</a>

            </li> -->

            <li class="nav-item">

               <a class="nav-link <?php if($this->uri->segment(1) == 'contact'){echo "active"; } ?>" href="<?php echo base_url(); ?>contact">Contact</a>

            </li>

            <?php 

            if(isset($_SESSION['fk_user']))

            { ?>
               <li class="dropdown nav-item">
                  <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="javascript:void(0)">Hello, <?php echo $_SESSION['user_name']; ?></a>
                   <ul class="dropdown-menu">
                     <li><a href="<?php echo base_url(); ?>orders">My Orders</a></li>
                     <li><a href="<?php echo base_url(); ?>user">My Account</a></li>
                     <li><a href="#" data-toggle="modal" data-target="#changepassword">Change Password</a></li>
                     <li><a href="<?php echo base_url(); ?>login/user_logout">Logout </a></li>
                   </ul>
               </li>

            <?php } else { ?>

               <li class="nav-item">

                  <a class="nav-link <?php if($this->uri->segment(1) == 'login' || $this->uri->segment(1) == 'signin' || $this->uri->segment(1) == 'signup' || $this->uri->segment(1) == 'register'){echo "active"; } ?>" href="<?php echo base_url(); ?>signin">Login</a>

               </li>

            <?php } ?>

         </ul>

      </div>

      <div class="logo-center-mobile"> 
          <a class="navbar-brand" href="<?php echo base_url();?>">
              <img class="dark-logo" src="<?php echo base_url(); ?>public/front_assets/images/vruits-logo.png" style="width: 70px;">
              <img class="lite-logo" src="<?php echo base_url(); ?>public/front_assets/images/vruits-logo.png" style="width: 70px;">
          </a>
      </div>

       <div class="dual-nav shopping-inline-xs">
               <div class="shopping-line">
                   <div class="nav-item">
                       <div class="orderby__wrapper_search">
                       <div class="input-group stylish-input-group ">
                            <input type="text" name="search" id="search_all" class="shot__byselect_search" autocomplete="off" >
                            <i class="fa fa-close header-close-icon" id="hide_cancel_btn" onclick="clearFields()"></i>
                            <span class="input-group-addon">
                                <button type="submit">
                                    <span class="fa fa-search"></span>
                                </button>  
                            </span>
                        </div>
                       <div id="suggesstion-box"></div>
                       </div>
                  </div>
                  <div class="dropdown nav-item dropdown-hide shoppingcart-header">
                      <div id="cart_body">
                          <?php if(isset($_SESSION['fk_user'])){ ?>
                      <a href="javascript:;" class="dropdown-toggle nav-link " data-toggle="dropdown"><i class="fa fa-shopping-cart">
                              <?php if(isset($_SESSION["cart_item"])){ ?>
                              <span class="icon-header-noti"><?php echo count($_SESSION["cart_item"]);?></span>
                              <?php }else{ ?>
                              <span class="icon-header-noti">0</span>
                              <?php } ?>
                          </i></a>
                          <?php }else{ ?>
                          <a href="javascript:;" class="dropdown-toggle nav-link show-modal donorWantLogin" data-toggle="modal" data-target="#wantDonate"><i class="fa fa-shopping-cart"><span class="icon-header-noti">0</span></i></a>
                          <?php } ?>
                     <ul class="dropdown-menu dropdown-cart" role="">

                         <?php if(isset($_SESSION["cart_item"])){ ?>

                        <div class="cart-sidebar-body">

                            <?php $grand_total = 0;
                                  foreach($_SESSION["cart_item"] as $row){
                               ?>
                           <div class="cart-list-product">

                              <a class="float-right remove-cart" href="javascript:;" onclick="delete_to_cart('<?php echo $row['int_glcode'];?>','<?php echo $row['weigth'];?>')"><i class="fa fa-close"></i></a>

                              <img class="img-fluid" src="<?php echo $row['image'];?>" alt="">

                              <h5><a href="javascript:;"><?php echo $row['title'];?></a></h5>

                              <h6><strong><span class="fa fa-approval"></span> Weight</strong> - <?php echo $row['weigth'];?></h6>

                              <p class="offer-price mb-0">&#x20b9;<?php echo $row['dis_price'];?> <span>x <?php echo $row['quantity'];?></span></p>

                           </div>

                            <?php $total = $row['dis_price'] * $row['quantity'];?>

                           <?php $grand_total = $total + $grand_total; } ?>

                            

                        </div>

                        <div class="cart-sidebar-footer">

                           <div class="cart-store-details mb-2">

                              <p>Sub Total <strong class="float-right text-danger">&#x20b9;<?php echo $grand_total;?></strong></p>

                           </div>

                           <a href="<?php echo base_url().'cart';?>"><button class="btn btn-secondary btn-lg btn-block" type="button"><span class="text-center">Proceed to Checkout </span></button></a>

                        </div>

                         <?php }else{ ?>
                         <div class="cart-sidebar-body">
                             <div class="cart-list-product">
                              <span>Cart Empty</span>
                             </div>
                         </div>
                                    <?php } ?>

                         

                     </ul>

                      </div>

                  </div>

               </div>

              

            </div>

   </div>

</nav>

<div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

     <div class="modal-dialog" role="document">

         <div class="modal-content">

             <div class="modal-header">

                 <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>

                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                     <span aria-hidden="true" class="mdi mdi-close"></span>

                 </button>

             </div>

             <div class="card-body">



                 <div id="msgSubmit_changep"></div>

                 <form role="form" method="post" id="changepassword" class="f-form" data-toggle="validator">

                  <?php 

                  if (isset($_SESSION['login_user']) && $_SESSION['login_user'] == 'user'){

                     $fk_user = $_SESSION['fk_user'];

                  } else {

                     $fk_user = '';

                  }

                  ?>

                  <input type="hidden" name="fk_user" id="fk_user" value="<?php echo $fk_user; ?>">

                     <div class="form-group">

                         <label class="sr-only" for="l-form-username">Old Password</label>

                         <input type="password" name="var_opassword" placeholder="Old Password" class="form-control" id="var_opassword" required>

                     </div>



                     <div class="form-group">

                         <label class="sr-only" for="l-form-username">New Password</label>

                         <input type="password" name="var_npassword" placeholder="New Password" class="form-control" id="var_npassword" required>

                     </div>



                     <div class="form-group">

                         <label class="sr-only" for="l-form-username">Conform Password</label>

                         <input type="password" name="var_rpassword" placeholder="Conform Password" class="form-control" id="var_rpassword" required>

                     </div>

                     <button type="submit" class="btn btn-primary">Save</button>

                 </form>

             </div>

         </div>

     </div>

 </div>