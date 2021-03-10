<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav">
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/dashboard" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard </span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/user" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">User Management</span></a></li>

                <!--<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-user-secret"></i><span class="hide-menu">Vendor Management </span></a>-->
                <!--    <ul aria-expanded="false" class="collapse  first-level">-->
                <!--        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/vendor" aria-expanded="false"><i class="fas fa-user-circle"></i><span class="hide-menu">Vendor Details</span></a></li>   -->
                <!--        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/withdraw_request" aria-expanded="false"><i class="mdi mdi-reorder-horizontal"></i><span class="hide-menu">Vendor Withdraw Request</span></a></li>   -->
                <!--        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/vendor_log_history" aria-expanded="false"><i class="mdi mdi-chart-histogram"></i><span class="hide-menu">Vendor Log History</span></a></li>   -->
                <!--    </ul>-->
                <!--</li>-->
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/category" aria-expanded="false"><i class="mdi mdi-view-list"></i><span class="hide-menu">Category Management</span></a></li>    

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/products" aria-expanded="false"><i class="mdi mdi-book"></i><span class="hide-menu">Product Management</span></a></li>

                <!--<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-truck-delivery"></i><span class="hide-menu">Delivery Boy Management </span></a>-->
                <!--    <ul aria-expanded="false" class="collapse  first-level">-->
                <!--        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/delivery_boy" aria-expanded="false"><i class="mdi mdi-reorder-horizontal"></i><span class="hide-menu">Delivery Boy List</span></a></li>-->
                <!--        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/rider_withdraw" aria-expanded="false"><i class="mdi mdi-reorder-horizontal"></i><span class="hide-menu">Rider Withdraw Request</span></a></li>-->
                <!--    </ul>-->
                <!--</li>-->
                
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-reorder-horizontal"></i><span class="hide-menu">Order Management </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/orders" aria-expanded="false"><i class="mdi mdi-reorder-horizontal"></i><span class="hide-menu">Order List</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/settings/reasons" aria-expanded="false"><i class="fas fa-cubes"></i><span class="hide-menu">Order Rejection Reasons</span></a></li>
                    </ul>
                </li>    
                
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/settings/banner_images" aria-expanded="false"><i class="mdi mdi-playlist-plus"></i><span class="hide-menu">Home Banner Images</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/coupon" aria-expanded="false"><i class="mdi mdi-gift"></i><span class="hide-menu">Promo Code Management</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/blog" aria-expanded="false"><i class="mdi mdi-blogger"></i><span class="hide-menu">Blog</span></a></li>
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/ingredient" aria-expanded="false"><i class="mdi mdi-blogger"></i><span class="hide-menu">Ingredient Health</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/news" aria-expanded="false"><i class="mdi mdi-newspaper"></i><span class="hide-menu">What's New</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/stock" aria-expanded="false"><i class="mdi mdi-pen"></i><span class="hide-menu">Stock Update</span></a></li>
                <!-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/pincode" aria-expanded="false"><i class="mdi mdi-view-list"></i><span class="hide-menu">Manage Pincode </span></a></li> -->
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/delivery_charge" aria-expanded="false"><i class="fas fa-cubes"></i><span class="hide-menu">Delivery Charge</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/testimonial" aria-expanded="false"><i class="mdi mdi-view-list"></i><span class="hide-menu">Testimonial</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/newsletter" aria-expanded="false"><i class="mdi mdi-newspaper"></i><span class="hide-menu">Newsletter management</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/stors" aria-expanded="false"><i class="mdi mdi-map-marker"></i><span class="hide-menu">Stores Management</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/feedback" aria-expanded="false"><i class="mdi mdi-account-box-outline"></i><span class="hide-menu">Feedback Management</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/contactus" aria-expanded="false"><i class="mdi mdi-contact-mail"></i><span class="hide-menu">Contact Management</span></a></li>
                <!--<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/user_chat" aria-expanded="false"><i class="mdi mdi-reorder-horizontal"></i><span class="hide-menu">Grievance Management</span></a></li>-->
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>