<div class="page-holder w-100 d-flex flex-wrap">

            <div class="container-fluid px-xl-5">

<section class="order-grid-section py-5">

                  <div class="row mb-4">

                     <div class="card">

                        <div class="card-body">

                           <div class="col-lg-12 mb-4 mb-lg-0">

                              <div class="table-wrapper">

                                 <div class="table-title">

                                    <div class="row">

                                       <div class="col-sm-8">

                                          <h2>Delivery Boy</h2>

                                       </div>

                                       <div class="col-sm-4">

                                          <a id="add_cate" href="<?php echo base_url();?>vendor/delivery_boy/add_deliveryboy" class="btn btn-info btn-rounded m-t-10 mb-2 float-right">+ Add New</a>

                                       </div>

                                    </div>

                                 </div>

                                  <?php echo validation_errors(); ?>

                                    <?php if($this->session->flashdata('Invalid') != ''){ ?>

                                        <div class="alert alert-success hide_msg">

                                            <p><?php echo $this->session->flashdata('Invalid');?></p>

                                        </div>

                                    <?php } ?>

                                 <table  class=" example table table-striped table-bordered" style="width:100%">

                                    <div class="table-responsive">

                                       <thead>

                                          <tr>

                                             <th style="width: 60px;"><input type="checkbox" onclick="checkAll(this)"></th>

                                             <th>Name</th>

                                             <th>Email</th>

                                             <th>Mobile No</th>

                                             <th>Profile</th>

                                             <th>Block/Unblock</th>

                                             <th>Publish</th>

                                          </tr>

                                       </thead>

                                       <tbody>

                                       <input type="hidden" name="module" id="module" value="delivery_boy">

                                           <?php if(count($delivery_boy) > 0){ 

                                                    foreach ($delivery_boy as $row){

                                                        

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

                                       <tr id="<?php echo $row['int_glcode'];?>">

                                             <td><input type="checkbox" name="ids[]" class="checkboxes" value="<?php echo $row['int_glcode'];?>"></td>

                                             <td><a href="<?php echo base_url().'vendor/delivery_boy/editDeliveryboy/'.base64_encode($row['int_glcode']); ?>"><i class=" fas fa-edit"></i> <?php echo $row['var_name'];?></a></td>

                                             <td><?php echo $row['var_email'];?></td>

                                             <td><?php echo $row['var_mobile_no'];?></td>

                                             <td>

                                                <a class="example-image-link" href="<?php echo $Image;?>" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img style="width: 100px;" class="example-image" src="<?php echo $Image;?>" id="cate_ig" alt="<?php echo $Image;?>"></a>

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

                                           <?php }}else{ ?>

                                          <tr><td colspan="7">No Data Available.</td></tr>

                                           <?php } ?>

                                       </tbody>

                                    </div>

                                 </table>

                                  <button type="submit" class="btn btn-danger btn_fnt ml-3" name="btn_delete" id="btn_delete">Delete</button>

                                  

                              </div>

                           </div>

                        </div>

                     </div>

                  </div>

               </section>

</div>



<script type="text/javascript">

    var sitepath = '<?php echo base_url(); ?>';   

    ///////////////////// update publish /////////////////////////////////

function blockUnblock(folder,tablename,fieldname,value,id){
    if (value == 'U') {
        var msg = "You want to UnBlock this Deliveryboy ?";
    } else {
        var msg = "You want to Block this Deliveryboy ?";
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
                if(value == 'U')
                {
                    var value1 = 'B';
                }
                else
                {
                    var value1 = 'U';
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
//    function UpdatePublish(folder,tablename,fieldname,value,id){

// 

//        $.ajax({

//        type: "GET",

//        dataType: 'json',

//        cache: false,

//        url: folder+"/UpdatePublish",

//        data: { tablename: tablename,

//            fieldname: fieldname,

//            value: value,

//            id: id },

//

//            success: function(data){

//                //location.reload();

//                

//                if(value == 'Y')

//                {

//                    var value1 = 'N';

//                }

//                else

//                {

//                    var value1 = 'Y';

//                }

//                if($('#tick-'+id).attr('src') == sitepath + 'public/assets/images/site_imges/tick.png')

//                {

//                    $('#tick-'+id).attr('src' , sitepath +'public/assets/images/site_imges/tick_cross.png');

//                }

//                else

//                {

//                    $('#tick-'+id).attr('src' , sitepath +'public/assets/images/site_imges/tick.png');

//                }

//                

//                $('#tick-'+id).attr('onclick' , "blockUnblock('"+folder+"','"+tablename+"','"+fieldname+"','"+value1+"','"+id+"')");

//            }

//        });

//      

//    }

</script>