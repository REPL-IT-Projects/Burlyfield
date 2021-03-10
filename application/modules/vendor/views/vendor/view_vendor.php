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
                        <h4 class="page-title">Vendors</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Vendors</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                           <a id="add_cate" href="<?php echo base_url(); ?>admin/vendor/add_vendor" class="btn btn-info btn-rounded m-t-10 mb-2 float-right"><i class="mr-2 mdi mdi-plus"></i>Add New Vendor</a>
                       </div>
                   </div>
               </div>
           </div>
           <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
            <div class="card-body table-responsive">
                <table id="vendor_list" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr><th colspan="6">
                          Show:<select name="dp_entries">
                            <option value="10" selected="">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>entries
                    </th><th colspan="3">
                      <input type="search" name="search" id="search" class="form-control" placeholder="Search">
                  </th></tr>                
                  <tr style="background-color: rgba(0, 0, 3, 0.1);">
                    <th><span class="icon">
                        <input type="checkbox" onclick="checkAll('chkgrow')" id="checkAll" name="chkall_agt" />
                    </span></th>
                    <th><a href="javascript:void(0);" field="var_name" class="_sort">Name</a></th>
                    <th><a href="javascript:void(0);" field="var_email" class="_sort">Email</a></th>

                    <th><a href="javascript:void(0);" field="var_username" class="_sort">Username</a></th>
                    <th><a href="javascript:void(0);" field="var_mobileno" class="_sort">Mobile No</a></th>
                    <th>Image</th>
                    <th><a href="javascript:void(0);" field="var_membership_type" class="_sort">Membership Type</a></th>
                    <th>Publish</th>
                </tr>
                </thead>
                <input type="hidden" name="module" id="module" value="vendor">
                <tbody>
                    <?php 
                    if (count($data) > 0) {
                        foreach ($data as $row) {
                            $tickimg = ($row['chr_publish'] == 'Y') ? "tick.png" : "tick_cross.png";
                            if ($row['chr_publish'] == 'Y') {
                                $title = "Hide me";
                                $update_val = 'N';
                            } else {
                                $title = "Display me";
                                $update_val = 'Y';
                            }
                            if ($row['var_image'] != '') {
                                $Image = base_url().'uploads/vendor/'.$row['var_image'];
                            } else {
                                $Image = base_url().'public/assets/images/site_imges/no_image.png';
                            }
                           
                            /////////////////////// if blank user name //////////////////
                            if ($row['var_username'] != '') {
                                $name = $row['var_username'];
                            } else {
                                $name = 'N/A';
                            }
                            ?>
                        <tr id="<?php echo $row["int_glcode"]; ?>">
                        <td><input type="checkbox" name="ids[]" class="checkboxes" value="<?php echo $row['int_glcode']; ?>"></td>
                        <td><a href="<?php echo base_url() . 'admin/vendor/editVendor/'. base64_encode($row['int_glcode']); ?>"><i class=" fas fa-pencil-alt"> </i> <?php echo $row['var_name']; ?></a>
                        </td>
                        <td><?php echo $row['var_email']; ?></td> 
                        <td><?php echo $name; ?></td>                  
                        <td><?php echo $row['var_mobile_no']; ?></td>
                        <td>
                            <a class="example-image-link" href="<?php echo $Image; ?>" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src="<?php echo $Image; ?>" id="cate_ig" alt="<?php echo $Image; ?>" /></a>
                        </td>
                            <td><?php echo $row['var_membership_type']; ?></td>
                            <td class="center">
                                <a href="javascript:void(0);">
                                  <img id="tick-<?php echo $row['int_glcode']; ?>" height="16" width="16" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" src="<?php echo base_url() . 'public/assets/images/site_imges/' . $tickimg; ?>" style="vertical-align:middle;cursor:pointer;" onclick="UpdatePublish('vendor', 'mst_vendors', 'chr_publish', '<?php echo $update_val; ?>', '<?php echo $row['int_glcode']; ?>');">
                                </a>
                            </td>
                        </tr>
                            <?php } 
                        } else { ?>
                            <tr><th colspan="8"><td>No data are available.</td></th></tr>
                        <?php } ?>
                    </tbody>
                </table>
                <input type="hidden" name="hfield" value="int_glcode">
                <input type="hidden" name="hsort" value="desc">
                <input type="hidden" name="hpageno" value="0">
              <?php
              if (count($data) > 0) {
                ?>
                <div>
                  <div id="pagination" style="float: right">
                      <?php echo $pagination; ?>
                  </div>
                  <label id="showing_"><?php echo 'Showing 1 to '.count($data).' of '.$total_data.' entries'; ?></label>
              </div>
                <input type="hidden" name="module" id="module" value="vendor">
                <button type="submit" class="btn btn-danger btn_fnt" name="btn_delete" id="btn_delete"><i class="icon dripicons-trash color_change"></i>Delete</button>
            <?php } ?>
        </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  var siteurl = '<?php echo base_url(); ?>';   
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/dist/js/vendor.js"></script>