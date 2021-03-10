<link rel="stylesheet" type="text/css" href="/DataTables/datatables.css">
 
<script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>

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
                        <h4 class="page-title">Stock Upadte</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Stock Upadte</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                   <!-- <div class="col-7 align-self-center">-->
                   <!--     <div class="d-flex no-block justify-content-end align-items-center">-->
                   <!--        <a id="add_cate" href="<?php echo base_url(); ?>admin/stock/add_stock" class="btn btn-info btn-rounded m-t-10 mb-2 float-right"><i class="mr-2 mdi mdi-plus"></i>Add Product Stock</a>-->
                   <!--    </div>-->
                   <!--</div>-->
               </div>
           </div>
           <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
            <div class="card-body table-responsive">
                <table id="stock_list" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <!-- <tr><th colspan="4">
                          Show: <select name="dp_entries">
                            <option value="10" selected="">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select> entries
                        <img src="<?php echo base_url() . 'public/assets/images/site_imges/tick.png'; ?>" height="16" width="16"> In Stock
                        <img src="<?php echo base_url() . 'public/assets/images/site_imges/tick_cross.png'; ?>" height="16" width="16"> Out Stock
                    </th><th colspan="2">
                      <input type="search" name="search" id="search" class="form-control" placeholder="Search">
                  </th></tr>  -->               
                  <tr style="background-color: rgba(0, 0, 3, 0.1);">
                    <!-- <th><span class="icon">
                        <input type="checkbox" onclick="checkAll('chkgrow')" id="checkAll" name="chkall_agt" />
                    </span></th> -->
                    <th>Sr. no</th>
                    <th>Product</th>
                    <th>Stock</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Option</th>
                </tr>
                </thead>
                <input type="hidden" name="module" id="module" value="testimonial">
                <tbody>
                    <?php $i = 1;
                    if (count($data) > 0) {
                        foreach ($data as $row) {
                            $tickimg = ($row['stock_status'] == 'Y') ? "tick.png" : "tick_cross.png";
                            if ($row['stock_status'] == 'Y') {
                                $title = "Out of stock";
                                $update_val = 'N';
                            } else {
                                $title = "In of stock";
                                $update_val = 'Y';
                            }
                            
                            if(substr($row['var_image'], 0, 4 ) === "http")
                            {
                                $Image = $row['var_image'];
                            } elseif ($row['var_image'] != '') {
                                $Image = base_url().'uploads/products/'.$row['var_image'];
                            } else {
                                $Image = base_url().'public/assets/images/site_imges/no_image.png';
                            }
                           
                            ?>
                        <tr>
                        <!-- <td><input type="checkbox" name="ids[]" class="checkboxes" value="<?php echo $row['int_glcode']; ?>"></td> -->
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['var_title']; ?></td>
                        <td><?php echo $row['var_stock']; ?></td>             
                        
                        <td>
                            <a class="example-image-link" href="<?php echo $Image; ?>" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src="<?php echo $Image; ?>" id="cate_ig" alt="<?php echo $Image; ?>" /></a>
                        </td>
                            <td class="center">
                                <a href="javascript:void(0);">
                                  <img id="tick-<?php echo $row['int_glcode']; ?>" height="16" width="16" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" src="<?php echo base_url() . 'public/assets/images/site_imges/' . $tickimg; ?>" style="vertical-align:middle;cursor:pointer;" onclick="UpdateStock('stock', 'mst_products', 'stock_status', '<?php echo $update_val; ?>', '<?php echo $row['int_glcode']; ?>');">
                                </a>
                            </td>
                        <td>
                          <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#stockEditModal<?php echo $row['int_glcode']; ?>" data-whatever="@mdo" data-id="<?php echo $row['int_glcode']; ?>"><i class="fas fa-edit"></i></button>
                        </td>
                        </tr>
                        <div class="modal fade" id="stockEditModal<?php echo $row['int_glcode']; ?>" tabindex="-1" role="dialog" aria-labelledby="addonLabel1">
                          <div class="modal-dialog" role="document" >
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel1">Edit Stock</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              </div>
                              <div class="modal-body">
                                  <form action="<?php echo base_url(); ?>admin/stock/update_stock" method="POST" id="addon_form" class="form-horizontal" enctype='multipart/form-data'>
                                      <input type="hidden" name="int_glcode" id="int_glcode" value="<?php echo $row['int_glcode']; ?>">
                                      <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Product Name</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" id="var_title" name="var_title" value="<?php echo $row['var_title']; ?>" required="">
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Stock</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" id="var_stock" name="var_stock" value="<?php echo $row['var_stock']; ?>" required="">
                                        </div>
                                      </div>
                                    <div class="modal-footer">
                                      <button type="submit" id="btn_addon" class="btn btn-success">Save</button>
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                    </form>
                              </div>
                            </div>
                          </div>
                        </div>
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
        
<script type="text/javascript">
  var siteurl = '<?php echo base_url(); ?>'; 
  $(document).ready( function () {
    $('#stock_list').DataTable();
} );

function UpdateStock(folder,tablename,fieldname,value,id){
    if (value == 'N') {
        var msg = "Are you sure it's Out of Stock ?";
    } else {
        var msg = "Are you sure it's In of Stock ?";
    }
  swal({
      title: "Confirm the Action !",
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
                if($('#tick-'+id).attr('src') == sitepath + 'public/assets/images/site_imges/tick.png')
                {
                  $('#tick-'+id).attr('src' , sitepath +'public/assets/images/site_imges/tick_cross.png');
                }
                else
                {
                  $('#tick-'+id).attr('src' , sitepath +'public/assets/images/site_imges/tick.png');
                }
                
                $('#tick-'+id).attr('onclick' , "UpdatePublish('"+folder+"','"+tablename+"','"+fieldname+"','"+value1+"','"+id+"')");
            }
        });
            //$(location).attr('href','<?php //echo base_url() ?>album/deleteimges/'+id);
          }
        })
  }

  //cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js
</script>
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>public/dist/js/stock.js"></script> -->