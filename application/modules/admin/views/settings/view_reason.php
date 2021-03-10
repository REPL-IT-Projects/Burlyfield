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
          <h4 class="page-title">Order Rejection Reasons</h4>
          <div class="d-flex align-items-center">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Reasons</li>
              </ol>
            </nav>
          </div>
        </div>
        <div class="col-7 align-self-center">
          <div class="d-flex no-block justify-content-end align-items-center">
            <button type="button" class="btn btn-info btn-rounded" data-toggle="modal" data-target="#reasonModal" data-whatever="@mdo"><i class="mr-2 mdi mdi-plus"></i>Add Reason</button>
            <div class="modal fade" id="reasonModal" tabindex="-1" role="dialog" aria-labelledby="reasonModalLabel1">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Add Order Rejection Reason</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                    <form action="#" method="POST" id="reason_form" class="form-horizontal" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Reason Title<span class="mandatory">*</span></label>
                        <div class="col-sm-9">
                          <textarea class="form-control" id="var_title" name="var_title" placeholder="PLease enter order rejection reason." required=""></textarea>
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
            <div class="card-body table-responsive">
              <table id="addonTable" class="table table-striped table-bordered">
                <thead>              
                  <tr style="background-color: rgba(0, 0, 3, 0.1);">
                    <th><span class="icon">
                        <input type="checkbox" onclick="checkAll('chkgrow')" id="checkAll" name="chkall_agt" />
                    </span></th>
                    <th>Sr No.</th>
                    <th>Title</th>
                    <th>Publish</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <input type="hidden" name="module" id="module" value="settings">
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
                      ?>
                        <tr id="<?php echo $row["int_glcode"]; ?>">
                        <td><input type="checkbox" name="ids[]" class="checkboxes" value="<?php echo $row['int_glcode']; ?>"></td>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['var_title']; ?></td>
                        <td class="center">
                            <a href="javascript:void(0);">
                              <img id="tick-<?php echo $row['int_glcode']; ?>" height="16" width="16" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" src="<?php echo base_url() . 'public/assets/images/site_imges/' . $tickimg; ?>" style="vertical-align:middle;cursor:pointer;" onclick="UpdateBannerPublish('mst_order_reject_reason', 'chr_publish', '<?php echo $update_val; ?>', '<?php echo $row['int_glcode']; ?>');">
                            </a>
                        </td>
                        <td>
                          <button type="button" class="btn btn-secondary edit_reason" data-toggle="modal" data-target="#reasonEditModal" data-whatever="@mdo" data-id="<?php echo $row['int_glcode']; ?>"><i class="fas fa-edit"></i></button>
                        </td>
                      </tr>
                    <?php } 
                  } else { ?>
                    <tr><td colspan="5">No data are available.</td></tr>
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
        <div class="modal fade" id="reasonEditModal" tabindex="-1" role="dialog" aria-labelledby="addonLabel1">
          <div class="modal-dialog" role="document" >
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Edit Order Rejection Reason</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
              </div>
            </div>
          </div>
        </div>
<script type="text/javascript">
var siteurl = '<?php echo base_url(); ?>';
// this is the id of the form
$("#reason_form").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr('action');
    var formData = new FormData($("#reason_form")[0]);
    $.ajax({
     type: "POST",
     url: siteurl+'admin/settings/insert_reason',
           data: formData, // serializes the form's elements.
            processData: false,
            contentType: false,
           success: function(data)
           {
             $('#reason_form')[0].reset();
             window.location.href = siteurl+'admin/settings/reasons';
           }
         });
  });

$(function(){
  $('.edit_reason').on("click", function(){
    var reasonKey = $(this).attr("data-id");
    $.ajax({          
      type: "POST",
      url: siteurl+'admin/settings/editReason',
      data: {'reasonKey':reasonKey},
      cache: false,
      success: function(result)
      {
          //alert(result)
          $('#reasonEditModal .modal-body').html(result);
            //alert(result);
          //rating function calling
        }
      });
  })
});
</script>