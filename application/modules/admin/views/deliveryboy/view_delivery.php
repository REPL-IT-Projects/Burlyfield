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
                        <h4 class="page-title">Delivery Boys</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Delivery Boys</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                           <a id="add_cate" href="<?php echo base_url(); ?>admin/delivery_boy/add_deliveryboy" class="btn btn-info btn-rounded m-t-10 mb-2 float-right"><i class="mr-2 mdi mdi-plus"></i>Add New Deliveryboy</a>
                       </div>
                   </div>
               </div>
            </div>
            <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
            <div class="card-body table-responsive">
                <table id="delivery_boy_list" class="table table-striped table-bordered" style="width:100%">
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
                    <th><a href="javascript:void(0);" field="var_mobile_no" class="_sort">Mobile No</a></th>
                    <th><a href="javascript:void(0);" field="vendor_name" class="_sort">Vendor Name</a></th>
                    <th>Profile</th>
                    <th><a href="javascript:void(0);" field="chr_status" class="_sort">Block / UnBlock</a></th>
                    <th>Publish</th>
                </tr>
                </thead>
                <input type="hidden" name="module" id="module" value="delivery_boy">
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

                            $tickimg1 = ($row['chr_status'] == 'U') ? "tick.png" : "tick_cross.png";
                            if ($row['chr_status'] == 'U') {
                                $title1 = "Block me";
                                $update_val1 = 'B';
                            } else {
                                $title1 = "UnBlock me";
                                $update_val1 = 'U';
                            }
                            
                            if ($row['var_profile'] != '') {
                                $Image = base_url().'uploads/deliveryboy/'.$row['var_profile'];
                            } else {
                                $Image = base_url().'public/assets/images/site_imges/no_image.png';
                            }

                            ?>
                        <tr id="<?php echo $row["int_glcode"]; ?>">
                        <td><input type="checkbox" name="ids[]" class="checkboxes" value="<?php echo $row['int_glcode']; ?>"></td>
                        <td><a href="<?php echo base_url() . 'admin/delivery_boy/editDeliveryboy/'. base64_encode($row['int_glcode']); ?>"><i class=" fas fa-pencil-alt"> </i> <?php echo $row['var_name']; ?></a>
                        </td>
                        <td><?php echo $row['var_email']; ?></td> 
                        <td><?php echo $row['var_mobile_no']; ?></td>
                        <td><?php echo $row['vendor_name']; ?></td>
                        <td>
                            <a class="example-image-link" href="<?php echo $Image; ?>" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src="<?php echo $Image; ?>" id="cate_ig" alt="<?php echo $Image; ?>" /></a>
                        </td>
                        <td class="center">
                            <a href="javascript:void(0);">
                                <img id="tickblock-<?php echo $row['int_glcode']; ?>" height="16" width="16" alt="<?php echo $title1; ?>" title="<?php echo $title1; ?>" src="<?php echo base_url() . 'public/assets/images/site_imges/' . $tickimg1; ?>" style="vertical-align:middle;cursor:pointer;" onclick="blockUnblock('delivery_boy', 'mst_delivery_boy', 'chr_status', '<?php echo $update_val1; ?>', '<?php echo $row['int_glcode']; ?>');">
                            </a>
                        </td>
                        <td class="center">
                            <a href="javascript:void(0);">
                                <img id="tick-<?php echo $row['int_glcode']; ?>" height="16" width="16" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" src="<?php echo base_url() . 'public/assets/images/site_imges/' . $tickimg; ?>" style="vertical-align:middle;cursor:pointer;" onclick="UpdatePublish('delivery_boy', 'mst_delivery_boy', 'chr_publish', '<?php echo $update_val; ?>', '<?php echo $row['int_glcode']; ?>');">
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
<script type="text/javascript" src="<?php echo base_url(); ?>public/dist/js/delivery.js"></script>
<script type="text/javascript">
    ///////////////////// update publish /////////////////////////////////
function blockUnblock(folder,tablename,fieldname,value,id){
 
    if (value == 'U') {
        var msg = "You want to Block this Deliveryboy ?";
    } else {
        var msg = "You want to UnBlock this Deliveryboy ?";
    }
    
    swal({
      title: "Are you sure?",
      text: msg,
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      cancelButtonText: "No",
      confirmButtonText: "Yes",
    }).then((result) => {
      if (result.value) {
        $.ajax({
        type: "GET",
        dataType: 'json',
        cache: false,
        url: folder+"/UpdatePublish",
        data: { tablename: tablename,
            fieldname: fieldname,
            value: value,
            id: id },

            success: function(data){
                //location.reload();
                
                if(value == 'Y')
                {
                    var value1 = 'N';
                }
                else
                {
                    var value1 = 'Y';
                }
                if($('#tickblock-'+id).attr('src') == sitepath + 'public/assets/images/site_imges/tick.png')
                {
                    $('#tickblock-'+id).attr('src' , sitepath +'public/assets/images/site_imges/tick_cross.png');
                }
                else
                {
                    $('#tickblock-'+id).attr('src' , sitepath +'public/assets/images/site_imges/tick.png');
                }
                
                $('#tickblock-'+id).attr('onclick' , "blockUnblock('"+folder+"','"+tablename+"','"+fieldname+"','"+value1+"','"+id+"')");
            }
        });
            //$(location).attr('href','<?php //echo base_url() ?>album/deleteimges/'+id);
          }
        })
    }
</script>