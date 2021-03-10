<div id="main-wrapper">
    <div class="page-wrapper">
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
           <!--  <h4 class="page-title">User</h4> -->
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>

                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?php echo base_url(); ?>admin/delivery_charge">View Delivery Charge</a>
                        </li>

                        <li class="breadcrumb-item active" aria-current="page">Edit Delivery Charge</li>

                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">

     <?php if ($this->session->flashdata('Invalid') != '') { ?>
            <div class="alert alert-danger hide_msg">
                <p><?php echo validation_errors(); ?></p>
                <p><?php echo $this->session->flashdata('Invalid'); ?></p>
            </div>
        <?php } ?>


    <div class="row">
        <div class="col">
            <div class="card">
                <h5 class="card-header">Edit Delivery Charge</h5>
                <div class="card-body">
                    
                    <form action="<?php echo base_url() . 'admin/delivery_charge/update_contact/'.$contact['id']; ?>" method="POST" class="form-horizontal" enctype='multipart/form-data'>

                        <div class="form-body">
                           <div class="form-group row" >
                                <label class="control-label text-right col-md-3">Delivery Charge Type<span class="text-danger">*</span> </label>
                                <div class="col-md-2">
                                    <div class="form-group" style="display: flex;">
                                        <input type="radio" class="form-control" id="chr_typeF" name="chr_type" value="F" <?php if($contact['chr_type']=='F'){echo 'checked';}?> required > Flat
                                        <input type="radio" class="form-control" id="chr_typeP" name="chr_type" value="P" <?php if($contact['chr_type']=='P'){echo 'checked';}?> required > Percentage    
                                    </div>

                            </div>

                        </div>

                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Delivery Charge<span class="text-danger">*</span> </label>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="var_charges" name="var_charges" value="<?php echo $contact['var_charges'];?>" required >
                                            
                                </div>

                            </div>

                        </div>
                            
                            
                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Delivery Charge Applied Upto(Rs)<span class="text-danger">*</span> </label>
                            
                                        <input type="hidden" class="form-control" id="var_above" name="var_above" value="0"  > 
                           
                            <div class="col-md-1">
                                <div class="form-group">
                                   
                                        <input type="text" class="form-control" id="var_below" name="var_below" value="<?php echo $contact['var_below'];?>" required >
                            </div>

                        </div>

                    </div>
                            
                        <div class="card-footer bg-light">
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="offset-sm-3 col-md-5">
                                                    <button class="btn btn-primary btn-rounded" type="submit" name="submit">Submit</button>
                                                    <a class="btn btn-secondary clear-form btn-rounded btn-outline" href="<?php echo base_url();?>admin/delivery_charge">Cancel</a>
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


</div>

    <script type="text/javascript">
var site_path = <?php echo base_url();?>;
$(function(){
  $('button[name=cancel]').click(function(){
    window.location = site_path+'admin/delivery_charge';
  });
});

</script>