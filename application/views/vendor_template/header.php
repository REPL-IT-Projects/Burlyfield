<!DOCTYPE html>
<?php 
//////////////////////////////////// check user login or not ///////////////////////////////////
 if ($_SESSION['login_user'] != 'vendor'){
     redirect(base_url().'vendor'); 
 } 
?> 
<html>
   <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>public/assets/images/site_imges/favicon.png">
      <title>Gramango Vendor</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="robots" content="all,follow">
      <!-- Bootstrap CSS-->
      <link rel="stylesheet" href="<?php echo base_url();?>public/vendor_assets/bootstrap/css/bootstrap.min.css">
      <!-- Font Awesome CSS-->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <!-- Google fonts - Popppins for copy-->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,800">
      <!-- orion icons-->
      <link rel="stylesheet" href="<?php echo base_url();?>public/vendor_assets/css/orionicons.css">
      <!-- theme stylesheet-->
      <link rel="stylesheet" href="<?php echo base_url();?>public/vendor_assets/css/style.default.css" id="theme-stylesheet">
      <!-- Custom stylesheet - for your changes-->
      <link rel="stylesheet" href="<?php echo base_url();?>public/vendor_assets/css/custom.css">
      <!-- Favicon-->
      <!-- <link rel="shortcut icon" href="img/favicon.png?3"> -->
      <script src="<?php echo base_url();?>public/vendor_assets/jquery/jquery.min.js"></script>

      <!-- omprakash-->
   <!--  <link rel="stylesheet" href="https://cidev.in/sasa_ecommerce/public/dist/css/lightbox.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url();?>public/vendor_assets/css/lightbox.min.css">
   </head>
   <body>
      <!-- navbar-->
      <header class="header">
         <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow">
            <a href="#" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"><i class="fas fa-align-left"></i></a><a href="JavaScript:;" class="navbar-brand font-weight-bold text-uppercase text-base"><img src="<?php echo base_url();?>public/front_assets/images/vruits-logo.png" style="width: 100px;"></a>
            
            
            <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">    
                <li class="nav-item dropdown ml-auto"></li>
                <?php if (isset($_SESSION['login_user']) && $_SESSION['login_user'] == 'vendor'){ ?>
<!--               <li class="nav-item dropdown mr-3">
                  <a id="notifications" href="JavaScript:;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-gray-400 px-1"><i class="fa fa-bell"></i><span class="notification-icon"></span></a>
                  <div aria-labelledby="notifications" class="dropdown-menu">
                     <a href="#" class="dropdown-item">
                        <div class="d-flex align-items-center">
                           <div class="icon icon-sm bg-violet text-white"><i class="fab fa-twitter"></i></div>
                           <div class="text ml-2">
                              <p class="mb-0">You have 2 followers</p>
                           </div>
                        </div>
                     </a>
                     <a href="#" class="dropdown-item">
                        <div class="d-flex align-items-center">
                           <div class="icon icon-sm bg-green text-white"><i class="fas fa-envelope"></i></div>
                           <div class="text ml-2">
                              <p class="mb-0">You have 6 new messages</p>
                           </div>
                        </div>
                     </a>
                     <a href="#" class="dropdown-item">
                        <div class="d-flex align-items-center">
                           <div class="icon icon-sm bg-blue text-white"><i class="fas fa-upload"></i></div>
                           <div class="text ml-2">
                              <p class="mb-0">Server rebooted</p>
                           </div>
                        </div>
                     </a>
                     <a href="#" class="dropdown-item">
                        <div class="d-flex align-items-center">
                           <div class="icon icon-sm bg-violet text-white"><i class="fab fa-twitter"></i></div>
                           <div class="text ml-2">
                              <p class="mb-0">You have 2 followers</p>
                           </div>
                        </div>
                     </a>
                     <div class="dropdown-divider"></div>
                     <a href="#" class="dropdown-item text-center"><small class="font-weight-bold headings-font-family text-uppercase">View all notifications</small></a>
                  </div>
               </li>-->
<?php $vendor = $this->common_model->getIdByData($_SESSION['fk_vendor']); ?>
               <li class="nav-item dropdown ml-auto">
                  <a id="userInfo" href="JavaScript:;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><img src="<?php echo base_url().'uploads/vendor/'.$vendor['var_image'];?>" alt="<?php echo $vendor['var_name'];?>" style="max-width: 2.5rem;" class="img-fluid rounded-circle shadow"></a>
                  <div aria-labelledby="userInfo" class="dropdown-menu">
                     <a href="#" class="dropdown-item"><strong class="d-block text-uppercase headings-font-family"><?php echo $vendor['var_name'];?></strong><small><?php echo $vendor['var_email'];?><br> <?php echo $vendor['var_city'];?> <?php echo $vendor['var_state'];?></small></a>
                     
                     <div class="dropdown-divider"></div>
                     <!--<a href="javascript:void" id="membership_detail" data-toggle="modal" data-target=".bs-example-modal-lg" class="dropdown-item">Membership Detail</a>-->
                     <a href="<?php echo base_url().'vendor/profile'; ?>" class="dropdown-item">Edit Profile</a>
                     <a href="<?php echo base_url();?>vendor/vendor_logout" class="dropdown-item">Logout</a>
                  </div>
               </li>
               <?php } ?>
            </ul>
            
         </nav>
      </header>
      <div class="d-flex align-items-stretch">
          <?php if (isset($_SESSION['login_user']) && $_SESSION['login_user'] == 'vendor'){ ?>
         <div id="sidebar" class="sidebar py-3">
            <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">Vendor Panel</div>
            <ul class="sidebar-menu list-unstyled">
               <li class="sidebar-list-item"><a href="<?php echo base_url();?>vendor/dashboard" class="sidebar-link text-muted <?php if($this->uri->segment(2)=='dashboard'){ echo 'active';}?>"><i class="o-home-1 mr-3 text-gray"></i><span>Dashboard</span></a></li>
               <!--<li class="sidebar-list-item"><a href="<?php echo base_url();?>vendor/delivery_boy" class="sidebar-link text-muted <?php if($this->uri->segment(2)=='delivery_boy'){ echo 'active';}?>"><i class="o-user-1 mr-3 text-gray"></i><span>Delivery Boy</span></a></li>-->
               <li class="sidebar-list-item"><a href="<?php echo base_url();?>vendor/stock" class="sidebar-link text-muted <?php if($this->uri->segment(2)=='stock'){ echo 'active';}?>"><i class="o-sales-up-1 mr-3 text-gray"></i><span>Stock Update</span></a></li>
               <li class="sidebar-list-item"><a href="<?php echo base_url();?>vendor/products" class="sidebar-link text-muted <?php if($this->uri->segment(2)=='products'){ echo 'active';}?>"><i class="o-data-storage-1 mr-3 text-gray"></i><span>Products</span></a></li>
               <li class="sidebar-list-item"><a href="<?php echo base_url();?>vendor/order" class="sidebar-link text-muted <?php if($this->uri->segment(2)=='order'){ echo 'active';}?>"><i class="o-survey-1 mr-3 text-gray"></i><span>Order</span></a></li>
               <li class="sidebar-list-item"><a href="<?php echo base_url();?>vendor/order_history" class="sidebar-link text-muted <?php if($this->uri->segment(2)=='order_history'){ echo 'active';}?>"><i class="o-presentation-1 mr-3 text-gray"></i><span>Order History</span></a></li>
               <li class="sidebar-list-item"><a href="<?php echo base_url();?>vendor/order_report" class="sidebar-link text-muted <?php if($this->uri->segment(2)=='order_report'){ echo 'active';}?>"><i class="o-profile-1 mr-3 text-gray"></i><span>Order Report</span></a></li>
               <li class="sidebar-list-item"><a href="<?php echo base_url();?>vendor/withdraw_request" class="sidebar-link text-muted <?php if($this->uri->segment(2)=='withdraw_request'){ echo 'active';}?>"><i class="o-survey-1 mr-3 text-gray"></i><span>Reconciliation</span></a></li>
            </ul>
         </div>
          <?php } ?>

          
          <?php $member = $this->common_model->getIdByData($_SESSION['fk_vendor']); ?>
          <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="membership_detail" aria-labelledby="myLargeModalLabel" aria-hidden="true" >


    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="longmodal">Membership Detail</h4>

                <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">x</button>

            </div>

            <div class="modal-body">
                <?php if($member['var_membership_type'] == 'Commission'){ $per='('.$member['var_commission_value'].'%)';}else{ $per='';}?>
                <h4><center><?php echo $member['var_membership_type'].' '.$per;?></center></h4>
                
                <label>Your Membership Duration is <?php echo date('d-m-Y',strtotime($member['dt_startdate']));?> to <?php echo date('d-m-Y',strtotime($member['dt_enddate']));?></label>
            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>

            </div>

        </div>

  

    </div>

  

</div>