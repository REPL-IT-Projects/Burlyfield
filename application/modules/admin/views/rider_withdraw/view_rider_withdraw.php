<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
            <?php echo validation_errors(); ?>
            <?php if($this->session->flashdata('Invalid') != ''){ ?>
                <div class="alert alert-success hide_msg">
                    <p><?php echo $this->session->flashdata('Invalid');?></p>
                </div>
            <?php } ?>
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Rider Withdraw Request</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Withdraw Request</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
               
               </div>
           </div>
           <!-- ============================================================== -->
           <!-- End Bread crumb and right sidebar toggle -->
           <!-- ============================================================== -->
           <!-- ============================================================== -->
           <!-- Container fluid  -->
           <!-- ============================================================== -->
           <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
            <div class="card-body table-responsive">
                
                <ul class="nav nav-tabs customtab" role="tablist">
                    
              <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#pending_request" role="tab"> <span class="hidden-xs-down">Pending Request</span></a> </li>
              <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#complete_request" role="tab"> <span class="hidden-xs-down">Complete Request</span></a> </li>
             </ul>
                <div class="tab-content">
              
                    
                    
              <div class="tab-pane p-20 active" id="pending_request" role="tabpanel">
                  <div class="row">
                    <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                  
                <table id="example1" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                                    
                  <tr style="background-color: rgba(0, 0, 3, 0.1);">
                     
                    <th>Rider Name</th>
                    <th>Rider Phone</th>
                    <th>Rider Email</th>
                    <th>Withdraw Amount</th>
                    <th>Approved</th>
                </tr>
                </thead>
                
                <tbody>
                    <?php 
                    if (count($pending_request) > 0) {
                        foreach ($pending_request as $row) {
                          
                        ?>
                        <tr id="<?php echo $row["int_glcode"]; ?>">
                       
                        <td><?php echo $row['var_name']; ?></td>   
                        <td><?php echo $row['var_mobile_no']; ?></td>
                        <td><?php echo $row['var_email']; ?></td>
                        <td>RM <?php echo $row['var_amount']; ?></td>
                        <td><a onclick="approved_request('<?php echo $row["int_glcode"]; ?>');" class="btn btn-success">Approved</a></td>
                     
                        </tr>
                        <?php } 
                        } else { ?>
                        <tr><td colspan="6">No data are available.</td></tr>
                        <?php } ?>
                    </tbody>
                </table>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
                    
                    <div class="tab-pane p-20" id="complete_request" role="tabpanel">
                  <div class="row">
                    <div class="col-12">
                      <div class="card">
                          <div class="card-body">
                              <div class="table-responsive">
                              <table id="example2" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                                    
                  <tr style="background-color: rgba(0, 0, 3, 0.1);">
          
                    <th>Rider Name</th>
                    <th>Rider Phone</th>
                    <th>Rider Email</th>
                    <th>Withdraw Amount</th>
                </tr>
                </thead>
                
                <tbody>
                    <?php 
                    if (count($complete_request) > 0) {
                        foreach ($complete_request as $row) {
                          
                        ?>
                        <tr id="<?php echo $row["int_glcode"]; ?>">
                     
                        <td><?php echo $row['var_name']; ?></td>   
                        <td><?php echo $row['var_mobile_no']; ?></td>
                        <td><?php echo $row['var_email']; ?></td>
                        <td>RM <?php echo $row['var_amount']; ?></td>
                        </tr>
                        <?php } 
                        } else { ?>
                        <tr><td colspan="5">No data are available.</td></tr>
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
        </div>
    </div>
</div>
<script src="<?php echo base_url();?>public/assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>public/dataTables.bootstrap4.css">
<script src="<?php echo base_url();?>public/datatables.min.js"></script>
<script>
    $(document).ready(function (){
        $('#example2').DataTable({
            "bSort" : false
        });
        $('#example1').DataTable({
            "bSort" : false
        });
   });

function approved_request(id){

            swal({
              title: "Are you sure?",
              text: "You want Approved this withdraw request.",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              cancelButtonText: "No",
              confirmButtonText: "Yes",
            }).then((result) => {
              if (result.value) {
                $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>admin/rider_withdraw/approved_request",
                data: 'id='+id,

                    success: function(data){
                        window.location.href = '<?php echo base_url();?>admin/rider_withdraw';
                  
                    }
                });
            
                  }
                })
            }
            
  $('#btn_exportExcel').click(function(){

    var url = "<?php echo base_url();?>admin/rider_withdraw/admin_withdraw_toExcel";
    window.location = url;
  });
</script>