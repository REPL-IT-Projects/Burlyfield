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
    <span itemprop="name">Transaction Summary</span>
 </a>
 <meta itemprop="position" content="2">
</li>
</ol>
</nav>
</div>
</div>
<section>
   <div class="myorder-page">
      <div class="container">
         <div class="row">
            <div class="col-md-10 mx-auto">
               <header class="sec-heading mb-30">
                  <h3>
                     My Wallet Transaction
                  </h3>
               </header>
               <div class="card card-body account-right">
                  <div class="widget">
                     <div class="order-list-tabel-main table-responsive">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="section-header">
                                    <h5 class="heading-design-h5">
                                       Transaction List
                                    </h5>
                                 </div>
                                 <div class="order-list-tabel-main table-responsive">
   <table class="datatabel_wallet table table-striped table-bordered" width="100%" cellspacing="0">
      <thead>
         <tr>
            <th>OrderID #</th>
            <th>Credited</th>
            <th>Debited</th>
            <th>Current Balance</th>
            <th>Date</th>
         </tr>
      </thead>
      <tbody>
         <?php 
         if (count($data) > 0) {
            foreach ($data as $key => $value) {
               $purchas_Date = date('M d , Y',strtotime($value['dt_modifydate']));
               if ($value['chr_transaction_type'] == 'C') {
                  $credit_amt = '+ &#x20b9;'.$value['var_amount'];
               } else {
                  $credit_amt = '-';
               }

               if ($value['chr_transaction_type'] == 'D') {
                  $debit_amt = '- &#x20b9;'.$value['var_amount'];
               } else {
                  $debit_amt = '-';
               }
            ?>
               <tr>
                  <td>#<?php echo $value['order_id']; ?></td>
                  <td class="credit_class"><?php echo $credit_amt; ?></td>
                  <td class="debit_class"><?php echo $debit_amt; ?></td>
                  <td>&#x20b9; <?php echo $value['current_amt']; ?></td>
                  <td><?php echo $purchas_Date; ?></td>
               </tr>
         <?php } } else { ?>
            <tr>
               <td>No Transaction Reports Found.</td>
            </tr>
         <?php } ?> 
      </tbody>
   </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/front_assets/css/datatable.min.css">
<script type="text/javascript" src="<?php echo base_url(); ?>public/front_assets/js/datatable.min.js"></script>
<script type="text/javascript">
  $(document).ready( function() {
    $('.datatabel_wallet').dataTable({
        /* Disable initial sort */
        "aaSorting": []
    });
})
</script>