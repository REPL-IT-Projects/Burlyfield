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
          <h4 class="page-title">Home Banner Images</h4>
          <div class="d-flex align-items-center">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Banners</li>
              </ol>
            </nav>
          </div>
        </div>
        <div class="col-7 align-self-center">
          <div class="d-flex no-block justify-content-end align-items-center">
            <button type="button" class="btn btn-info btn-rounded" data-toggle="modal" data-target="#reasonModal" data-whatever="@mdo"><i class="mr-2 mdi mdi-plus"></i>Add Banner</button>
            <button type="button" class="btn btn-info btn-rounded" data-toggle="modal" data-target="#offer1" data-whatever="@mdo"><i class="mr-2 fa fa-edit"></i>Edit Offer1</button>
            <button type="button" class="btn btn-info btn-rounded" data-toggle="modal" data-target="#offer2" data-whatever="@mdo"><i class="mr-2 fa fa-edit"></i>Edit Offer2</button>
            <div class="modal fade" id="reasonModal" tabindex="-1" role="dialog" aria-labelledby="reasonModalLabel1">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Add Home Banner Image</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                    <form action="#" method="POST" id="banner_form" class="form-horizontal" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label for="var_title" class="col-sm-3 text-right control-label col-form-label">Heading Title<span class="mandatory">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" name="var_title" id="var_title" class="form-control" required="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="txt_description" class="col-sm-3 text-right control-label col-form-label">Description<span class="mandatory">*</span></label>
                        <div class="col-sm-9">
                          <textarea name="txt_description" id="txt_description" class="form-control" required=""></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="var_image" class="col-sm-3 text-right control-label col-form-label">Banner Image<span class="mandatory">*</span></label>
                        <div class="col-sm-9">
                          <input type="file" name="var_image" id="var_image" required="">
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
            <!-- Offier 1 -->
            <div class="modal fade" id="offer1" tabindex="-1" role="dialog" aria-labelledby="reasonModalLabel1">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Add Home Banner Image</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                    <?php foreach ($offer_one as $v1) { 
                        $Image = base_url().'uploads/banner_img/'.$v1['var_image'];
                      ?>
                    
                    <form action="<?php echo base_url();?>admin/settings/offer_first" method="POST" class="form-horizontal" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label for="var_title" class="col-sm-3 text-right control-label col-form-label">Category Name<span class="mandatory">*</span></label>
                        <div class="col-sm-9">
                          <select class="form-control" id="fk_category" name="fk_category">
                            <?php foreach ($category as $catvel) { ?>
                                <option value="<?php echo $catvel['int_glcode']; ?>" <?php if($catvel['int_glcode'] == $v1['fk_category']) { echo "selected";} ?>><?php echo $catvel['var_title']; ?></option>
                             <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="var_title" class="col-sm-3 text-right control-label col-form-label">Heading Title<span class="mandatory">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" name="var_title" id="var_title" value="<?php echo $v1['var_title']; ?>" class="form-control" required="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="txt_description" class="col-sm-3 text-right control-label col-form-label">Description<span class="mandatory">*</span></label>
                        <div class="col-sm-9">
                          <textarea name="txt_description" id="txt_description" class="form-control" required=""><?php echo $v1['txt_description']; ?>"</textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="offer" class="col-sm-3 text-right control-label col-form-label">Heading Title<span class="mandatory">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" name="offer" id="offer" value="<?php echo $v1['offer']; ?>" class="form-control" required="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="var_image" class="col-sm-3 text-right control-label col-form-label">Banner Image<span class="mandatory">*</span></label>
                        <div class="col-sm-9">
                          <input type="file" name="var_image" id="var_image">
                          <input type="hidden" name="hidvar_image" value="<?php echo $v1['var_image']; ?>">
                          <img class="example-image" src="<?php echo $Image; ?>" id="cate_ig" alt="<?php echo $Image; ?>" />
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Save</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </form>
                <?php } ?>
                </div>
              </div>
            </div>

            <!-- Offer 2 -->

            <div class="modal fade" id="offer2" tabindex="-1" role="dialog" aria-labelledby="reasonModalLabel1">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Add Home Banner Image</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                    <?php foreach ($offer_two as $v2) { 
                        $Image = base_url().'uploads/banner_img/'.$v2['var_image'];
                      ?>
                    
                    <form action="<?php echo base_url();?>admin/settings/offer_second" method="POST" class="form-horizontal" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label for="var_title" class="col-sm-3 text-right control-label col-form-label">Category Name<span class="mandatory">*</span></label>
                        <div class="col-sm-9">
                          <select class="form-control" id="fk_category" name="fk_category">
                            <?php foreach ($category as $catvel) { ?>
                                <option value="<?php echo $catvel['int_glcode']; ?>" <?php if($catvel['int_glcode'] == $v2['fk_category']) { echo "selected";} ?>><?php echo $catvel['var_title']; ?></option>
                              <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="var_title" class="col-sm-3 text-right control-label col-form-label">Heading Title<span class="mandatory">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" name="var_title" id="var_title" value="<?php echo $v2['var_title']; ?>" class="form-control" required="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="txt_description" class="col-sm-3 text-right control-label col-form-label">Description<span class="mandatory">*</span></label>
                        <div class="col-sm-9">
                          <textarea name="txt_description" id="txt_description" class="form-control" required=""><?php echo $v2['txt_description']; ?>"</textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="offer" class="col-sm-3 text-right control-label col-form-label">Heading Title<span class="mandatory">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" name="offer" id="offer" value="<?php echo $v2['offer']; ?>" class="form-control" required="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="var_image" class="col-sm-3 text-right control-label col-form-label">Banner Image<span class="mandatory">*</span></label>
                        <div class="col-sm-9">
                          <input type="file" name="var_image" id="var_image">
                          <input type="hidden" name="hidvar_image" value="<?php echo $v2['var_image']; ?>">
                          <img class="example-image" src="<?php echo $Image; ?>" id="cate_ig" alt="<?php echo $Image; ?>" />
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Save</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </form>
                <?php } ?>
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
                    <th>Description</th>
                    <th>Banner Image</th>
                    <th>Publish</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <input type="hidden" name="module" id="module" value="settings">
                <tbody>
                  <?php 
                  if (!empty($data)) {
                    $i = 1;
                    foreach ($data as $key => $row) { if($row['int_glcode'] != 13 && $row['int_glcode'] != 14){
                      $tickimg = ($row['chr_publish'] == 'Y') ? "tick.png" : "tick_cross.png";
                            if ($row['chr_publish'] == 'Y') {
                                $title = "Hide me";
                                $update_val = 'N';
                            } else {
                                $title = "Display me";
                                $update_val = 'Y';
                            }

                            if ($row['var_image'] != '') {
                                $Image = base_url().'uploads/banner_img/'.$row['var_image'];
                            } else{
                                $Image = base_url().'public/assets/images/site_imges/no_image.png';
                            }
                            
                      ?>
                        <tr id="<?php echo $row["int_glcode"]; ?>">
                        <td><input type="checkbox" name="ids[]" class="checkboxes" value="<?php echo $row['int_glcode']; ?>"></td>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['var_title']; ?></td>
                        <td><?php echo $row['txt_description']; ?></td>
                        <td>
                            <a class="example-image-link" href="<?php echo $Image; ?>" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src="<?php echo $Image; ?>" id="cate_ig" style=" width: 147px;" alt="<?php echo $Image; ?>" /></a>
                        </td>
                        <td class="center">
                            <a href="javascript:void(0);">
                              <img id="tick-<?php echo $row['int_glcode']; ?>" height="16" width="16" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" src="<?php echo base_url() . 'public/assets/images/site_imges/' . $tickimg; ?>" style="vertical-align:middle;cursor:pointer;" onclick="UpdateBannerPublish('mst_home_banners', 'chr_publish', '<?php echo $update_val; ?>', '<?php echo $row['int_glcode']; ?>');">
                            </a>
                        </td>
                        <td>
                          <button type="button" class="btn btn-secondary edit_banner" data-toggle="modal" data-target="#bannerEditModal" data-whatever="@mdo" data-id="<?php echo $row['int_glcode']; ?>"><i class="fas fa-edit"></i></button>
                        </td>
                      </tr>
                    <?php } }
                  } else { ?>
                    <tr><td colspan="5">No data are available.</td></tr>
                  <?php } ?>
                </tbody>
              </table>
              <?php
              if (count($data) > 0) {
                ?>
                
                <button type="submit" class="btn btn-danger btn_fnt" name="btn_banner_delete" id="btn_banner_delete"><i class="icon dripicons-trash color_change"></i>Delete</button>
            <?php } ?>
            </div>
          </div>
        </div>
        <div class="modal fade" id="bannerEditModal" tabindex="-1" role="dialog" aria-labelledby="addonLabel1">
          <div class="modal-dialog" role="document" >
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Edit Banner Images</h4>
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
$("#banner_form").submit(function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var form = $(this);
    var url = form.attr('action');
    var formData = new FormData($("#banner_form")[0]);
    $.ajax({
     type: "POST",
     url: siteurl+'admin/settings/insert_banner_images',
           data: formData, // serializes the form's elements.
            processData: false,
            contentType: false,
           success: function(data)
           {
             $('#banner_form')[0].reset();
             window.location.href = siteurl+'admin/settings/banner_images';
           }
         });
  });

$(function(){
  $('.edit_banner').on("click", function(){
    var reasonKey = $(this).attr("data-id");
    $.ajax({          
      type: "POST",
      url: siteurl+'admin/settings/editBanner',
      data: {'reasonKey':reasonKey},
      cache: false,
      success: function(result)
      {
          //alert(result)
          $('#bannerEditModal .modal-body').html(result);
            //alert(result);
          //rating function calling
        }
      });
  })
});
</script>