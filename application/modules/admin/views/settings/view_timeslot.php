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
          <h4 class="page-title">Delivery Time slot</h4>
          <div class="d-flex align-items-center">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Timeslot</li>
              </ol>
            </nav>
          </div>
        </div>
        <div class="col-7 align-self-center">
          <div class="d-flex no-block justify-content-end align-items-center">
            <button type="button" class="btn btn-info btn-rounded" data-toggle="modal" data-target="#reasonModal" data-whatever="@mdo"><i class="mr-2 mdi mdi-plus"></i>Add Timeslot</button>
            <div class="modal fade" id="reasonModal" tabindex="-1" role="dialog" aria-labelledby="reasonModalLabel1">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Add Delivery Time slot</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                    <form action="#" method="POST" id="timeslot_form" class="form-horizontal" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Start Time<span class="mandatory">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" name="dt_start_time" class="form-control" id="dt_start_time">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="dt_end_time" class="col-sm-3 text-right control-label col-form-label">End Time<span class="mandatory">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" name="dt_end_time" class="form-control" id="dt_end_time">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="dt_end_time" class="col-sm-3 text-right control-label col-form-label">Slot End Time<span class="mandatory">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" name="dt_slot_end_time" class="form-control" id="dt_slot_end_time">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="type" class="col-sm-3 text-right control-label">Delivery Type</label>
                        <div class="col-sm-7">
                          <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input" id="superfast" value="S" name="delivery_type" checked="">
                              <label class="custom-control-label" for="superfast">Superfast</label>
                            </div>
                          </div>
                          <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input" id="ultrafast" value="Paid" name="delivery_type">
                              <label class="custom-control-label" for="ultrafast">Ultrafast</label>
                            </div>
                          </div>
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
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Slot End Time</th>
                    <th>Delivery Type</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <input type="hidden" name="module" id="module" value="settings">
                <tbody>
                  <?php 
                  if (!empty($data)) {
                    $i = 1;
                    foreach ($data as $key => $row) {
                      if ($row['chr_type'] == 'S') {
                        $type = 'Superfast';
                      } else {
                        $type = 'Ultrafast';
                      }
                      ?>
                        <tr id="<?php echo $row["int_glcode"]; ?>">
                        <td><input type="checkbox" name="ids[]" class="checkboxes" value="<?php echo $row['int_glcode']; ?>"></td>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['dt_start_time']; ?></td>
                        <td><?php echo $row['dt_end_time']; ?></td>
                        <td><?php echo $row['dt_slot_end_time']; ?></td>
                        <td><?php echo $type; ?></td>
                        <td>
                          <button type="button" class="btn btn-secondary edit_timeslot" data-toggle="modal" data-target="#timeslotEditModal" data-whatever="@mdo" data-id="<?php echo $row['int_glcode']; ?>"><i class="fas fa-edit"></i></button>
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
                
                <button type="submit" class="btn btn-danger btn_fnt" name="btn_timeslot_delete" id="btn_timeslot_delete"><i class="icon dripicons-trash color_change"></i>Delete</button>
            <?php } ?>
            </div>
          </div>
        </div>
        <div class="modal fade" id="timeslotEditModal" tabindex="-1" role="dialog" aria-labelledby="addonLabel1">
          <div class="modal-dialog" role="document" >
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Edit Delivery Timeslot</h4>
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
$("#timeslot_form").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr('action');
    var formData = new FormData($("#timeslot_form")[0]);
    $.ajax({
     type: "POST",
     url: siteurl+'admin/settings/insert_timeslot',
           data: formData, // serializes the form's elements.
            processData: false,
            contentType: false,
           success: function(data)
           {
             $('#timeslot_form')[0].reset();
             window.location.href = siteurl+'admin/settings/delivery_timeslot';
           }
         });
  });

$(function(){
  $('.edit_timeslot').on("click", function(){
    var reasonKey = $(this).attr("data-id");
    $.ajax({          
      type: "POST",
      url: siteurl+'admin/settings/editTimeslot',
      data: {'reasonKey':reasonKey},
      cache: false,
      success: function(result)
      {
          //alert(result)
          $('#timeslotEditModal .modal-body').html(result);
            //alert(result);
          //rating function calling
        }
      });
  })
});
</script>