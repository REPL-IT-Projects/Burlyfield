<div id="main-wrapper">
    <div class="page-wrapper">
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
           <!--  <h4 class="page-title">Users</h4> -->
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
                                
                        <li class="breadcrumb-item active" aria-current="page">Delivery Charge</li>
                            
                    </ol>
                </nav>
            </div>
        </div>
 
    </div>
</div>

<div class="container-fluid">

    <div class="row">
            <div class="col-12">
                <div class="card">          
                    <h5 class="card-header dashoard_tabl_title">Manage Delivery Charge</h5>                   
          
                    <div class="card-body table-responsive">            
                        
                        <h3> 
                   <?php
                    if($contact['chr_type']=='F'){
                        $type = 'Flat';
                        $sign = '&#x20b9;';
                    }else{
                        $type = 'Percentage';
                        $sign = '%';
                    }
                   
                   ?>
                            <label class="col-md-4">Delivery Charge Type :</label> <b><?php echo $type;?></b><br><br>
                            <label class="col-md-4">Delivery Charge :</label> <b><?php echo $sign." ".$contact['var_charges'];?></b><br><br>
                            <label class="col-md-4">Delivery Charge Applied Below(&#x20b9;) :</label> <b><?php echo "&#x20b9; ".$contact['var_below'];?></b><br><br>
                        
                        </h3> 
                       
                    </div>
                </div>
                <button class="btn btn-primary" onclick="load_page('<?php echo base_url().'admin/delivery_charge/edit_delivery_charge/'.base64_encode($contact['int_glcode']);?>')" style="padding: 10px 30px;font-size: 16px;">Edit Setting</button>
            </div>
    </div>

</div>

<!-- ================== GLOBAL APP SCRIPTS ==================-->
<script src="<?php echo base_url(); ?>public/assets/js/global/app.js"></script>
<!-- ================== PAGE LEVEL COMPONENT SCRIPTS ==================-->
<script src="<?php echo base_url(); ?>public/assets/js/components/datatables-init.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.semanticui.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.semanticui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );

function load_page(link)
{
    window.location.href= link;
}
</script>