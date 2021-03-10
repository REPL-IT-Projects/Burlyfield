<div id="main-wrapper">
  <div class="page-wrapper">
    <?php echo validation_errors(); ?>
    <?php if($this->session->flashdata('Invalid') != ''){ ?>
      <div class="alert alert-success hide_msg">
        <p><?php echo $this->session->flashdata('Invalid');?></p>
      </div>
    <?php } ?>
    <div class="page-breadcrumb">
      <div class="row">
        <div class="col-5 align-self-center">
          <h4 class="page-title">Promo Code</h4>
          <div class="d-flex align-items-center">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Promocodes</li>
              </ol>
            </nav>
          </div>
        </div>
        <div class="col-7 align-self-center">
          <div class="d-flex no-block justify-content-end align-items-center">
            <button type="button" class="btn btn-info btn-rounded" data-toggle="modal" data-target="#minimumAmtModal" data-whatever="@mdo"><i class="mr-2 mdi mdi-content-save-settings"></i>Set Minimum Amount</button>
            <button type="button" class="btn btn-info btn-rounded" data-toggle="modal" data-target="#promoModal" data-whatever="@mdo"><i class="mr-2 mdi mdi-plus"></i>Add Promo Code</button>
            <a id="csv_toggle" class="btn btn-success btn-rounded m-t-10 mb-2 float-right"><i class="mdi mdi-image-filter-vintage"></i> New User Promocode</a>

            <div class="modal fade" id="promoModal" tabindex="-1" role="dialog" aria-labelledby="reasonModalLabel1">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Add Promo Code</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                    <form action="#" method="POST" id="promocode_form" class="form-horizontal" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label for="var_title" class="col-sm-3 text-right control-label col-form-label">Promocode Title<span class="mandatory">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" name="var_title" id="var_title" class="form-control" required="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="var_title" class="col-sm-3 text-right control-label col-form-label">Value Type<span class="mandatory">*</span></label>
                         <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="var_type" name="chr_type" checked="" value="P">
                                <label class="custom-control-label" for="var_type">Percentage</label>
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="var_type1" name="chr_type" value="A">
                                <label class="custom-control-label" for="var_type1">Amount</label>
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="var_value" class="col-sm-3 text-right control-label col-form-label">
                          Value<span class="mandatory">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" name="var_value" id="var_value" placeholder="Enter promocode value" class="form-control" required="">
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Save</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="modal fade" id="minimumAmtModal" tabindex="-1" role="dialog" aria-labelledby="reasonModalLabel1">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Set Minimum Amount for order</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                    <form action="<?php echo base_url(); ?>admin/promocode/set_amount" method="POST" id="set_amt_form" class="form-horizontal" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label for="var_title" class="col-sm-3 text-right control-label col-form-label">Amount<span class="mandatory">*</span></label>
                        <div class="col-sm-9">
                          <?php if (!empty($min_amt)) { 
                            $var_min = $min_amt;
                          } else {
                            $var_min = '';
                          } ?>
                          <input type="text" name="var_set_amt" id="var_set_amt" value="<?php echo $var_min; ?>" class="form-control" required="">
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Save</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
           </div>
        </div>
      </div>
    </div>
   <div class="container-fluid">
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="csv_form" id='csv_form' style="display: none;">
              <form action="<?=base_url()?>admin/promocode/new_user_price" id="add_record" method="POST" class="form-horizontal" enctype='multipart/form-data'>
                <div class="form-group row">
                    <label class="control-label text-right col-md-3 label_color"> Promocode Title <span class="mandatory">*</span></label>
                      <div class="col-md-5">
                          <input type="text" class="form-control" name="var_new_title" id="var_new_title" required="" value="<?php if(isset($promo['var_promocode'])){echo $promo['var_promocode']; } ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label text-right col-md-3 label_color"> New User Promocode <span class="mandatory">*</span></label>
                      <div class="col-md-5">
                          <input type="text" class="form-control" name="var_new_value" id="var_new_value" required="" value="<?php if(isset($promo['var_promocode'])){echo $promo['var_amount']; } ?>">
                      </div>
                      <div class="side_by_side">
                          <button id="add_promo_code" class="btn btn-primary">Submit</button>
                      </div>
                  </div>
              </form>
            </div>

            <div class="card-body table-responsive">
              <table id="addonTable" class="table table-striped table-bordered">
                <thead>              
                  <tr style="background-color: rgba(0, 0, 3, 0.1);">
                    <th><span class="icon">
                        <input type="checkbox" onclick="checkAll('chkgrow')" id="checkAll" name="chkall_agt" />
                    </span></th>
                    <th>Sr No.</th>
                    <th>Title</th>
                    <th>Value</th>
                    <th>Publish</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <input type="hidden" name="module" id="module" value="promocode">
                <tbody>
                  <?php 
                  if (!empty($data)) {
                    $i = 1;
                    foreach ($data as $key => $row) {
                      $tickimg = ($row['chr_publish'] == 'Y') ? "tick.png" : "tick_cross.png";
                            if ($row['chr_publish'] == 'Y') {
                                $title = "Hide me";
                                $update_val = 'N';
                            } else {
                                $title = "Display me";
                                $update_val = 'Y';
                            }

                            if ($row['chr_type'] == 'A') {
                                $chr_type = "&#8377;".$row['var_amount'];
                            } else {
                                $chr_type = $row['var_amount']."%";
                            }

                      ?>
                        <tr id="<?php echo $row["int_glcode"]; ?>">
                        <td><input type="checkbox" name="ids[]" class="checkboxes" value="<?php echo $row['int_glcode']; ?>"></td>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['var_promocode']; ?></td>
                        <td><?php echo $chr_type; ?></td>
                        <td class="center">
                            <a href="javascript:void(0);">
                              <img id="tick-<?php echo $row['int_glcode']; ?>" height="16" width="16" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" src="<?php echo base_url() . 'public/assets/images/site_imges/' . $tickimg; ?>" style="vertical-align:middle;cursor:pointer;" onclick="UpdatePublish('promocode','mst_promocode', 'chr_publish', '<?php echo $update_val; ?>', '<?php echo $row['int_glcode']; ?>');">
                            </a>
                        </td>
                        <td>
                          <button type="button" class="btn btn-secondary edit_promocode" data-toggle="modal" data-target="#promocodeEditModal" data-whatever="@mdo" data-id="<?php echo $row['int_glcode']; ?>"><i class="fas fa-edit"></i></button>
                        </td>
                      </tr>
                    <?php } 
                  } else { ?>
                    <tr><td colspan="7">No data are available.</td></tr>
                  <?php } ?>
                </tbody>
              </table>
              <?php
              if (count($data) > 0) {
                ?>
                
                <button type="submit" class="btn btn-danger btn_fnt" name="btn_delete" id="btn_delete"><i class="icon dripicons-trash color_change"></i>Delete</button>
            <?php } ?>
            </div>
          </div>
        </div>
        <div class="modal fade" id="promocodeEditModal" tabindex="-1" role="dialog" aria-labelledby="addonLabel1">
          <div class="modal-dialog" role="document" >
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Edit Promo Code</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
              </div>
            </div>
          </div>
        </div>
<script type="text/javascript">

$("#csv_toggle").click(function() {
    $('#csv_form').toggle();
});

var siteurl = '<?php echo base_url(); ?>';
// this is the id of the form
$("#promocode_form").submit(function(e) {
  e.preventDefault(); // avoid to execute the actual submit of the form.
  var form = $(this);
  var url = form.attr('action');
  var formData = new FormData($("#promocode_form")[0]);
  $.ajax({
   type: "POST",
   url: siteurl+'admin/promocode/insert_record',
         data: formData, // serializes the form's elements.
          processData: false,
          contentType: false,
         success: function(data)
         {
           $('#promocode_form')[0].reset();
           window.location.href = siteurl+'admin/promocode';
         }
       });
  });

$(function(){
  $('.edit_promocode').on("click", function(){
    var reasonKey = $(this).attr("data-id");
    $.ajax({          
      type: "POST",
      url: siteurl+'admin/promocode/editPromocode',
      data: {'reasonKey':reasonKey},
      cache: false,
      success: function(result)
      {
          //alert(result)
          $('#promocodeEditModal .modal-body').html(result);
            //alert(result);
          //rating function calling
        }
      });
  })
});
</script>