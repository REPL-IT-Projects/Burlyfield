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
                    <div class="col-3 align-self-center">
                        <h4 class="page-title">Products</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Products</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <!-- <div class="col-3 align-self-center">
                        <div class="pull-right">
                            <a id="csv_toggle" class="btn btn-success btn-rounded m-t-10 mb-2 float-right"><i class="mdi mdi-briefcase-upload"></i> Import Price CSV</a>
                            
                          </div>
                    </div> -->

                    <div class="col-6 align-self-right">
                        <div class="d-flex no-block justify-content-end align-items-center">
                           <a id="add_cate" href="<?php echo base_url(); ?>admin/products/add_product" class="btn btn-info btn-rounded m-t-10 mb-2 float-right"><i class="mr-2 mdi mdi-plus"></i>Add New Product</a>
                           <a id="add_cate" href="<?php echo base_url(); ?>admin/products/createXLSProducts" class="btn btn-primary btn-rounded m-t-10 mb-2 float-right"><i class="mr-2 mdi mdi-export"></i>Export Excel</a>
                           <a id="add_cate" href="<?php echo base_url(); ?>admin/products/pdf_viewer" class="btn btn-primary btn-rounded m-t-10 mb-2 float-right"><i class="mr-2 mdi mdi-export"></i>Export PDF</a>
                       </div>
                   </div>
               </div>
           </div>
           <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="csv_form" id='csv_form' style="display: none;">
        <form action="<?=base_url()?>admin/products/csv_product_price" id="add_information" method="POST" class="form-horizontal" enctype='multipart/form-data'>

          <div class="form-group row">
                <label class="control-label text-right col-md-3 label_color"> Upload CSV File </label>

                <div class="col-md-5">
                    <input type="file" class="form-control" name="var_file" id="var_file" required="" accept=".csv">
                </div>

                <div class="side_by_side">
                    <button id="add_link" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
      </div>
            <div class="card-body table-responsive">
                <table id="products_list" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr><th colspan="2">
                          Show:<select name="dp_entries">
                            <option value="10" selected="">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>entries
                    </th>
                    <th colspan="1">
                        <select name="fk_category" id="fk_category" onchange="category_filter(this.value)">
                            <option value="">--Category--</option>
                            <?php foreach ($category as $row){ ?>
                            <option value="<?php echo $row['int_glcode'];?>"><?php echo $row['var_title'];?></option>
                            <?php } ?>
                        </select>
                    </th>
                    <th></th>
                    <th colspan="2">
                      <input type="search" name="search" id="search" class="form-control" placeholder="Search">
                  </th></tr>                
                  <tr style="background-color: rgba(0, 0, 3, 0.1);">
                    <th><span class="icon">
                        <input type="checkbox" onclick="checkAll('chkgrow')" id="checkAll" name="chkall_agt" />
                    </span></th>
                    <th><a href="javascript:void(0);" field="var_title" class="_sort">Product Title</a></th>
                    <th><a href="javascript:void(0);" field="cate_name" class="_sort">Category</a></th>
                    <th>Image 1</th>
					<th>Image 2</th>
					<th>Image 3</th>
					<th>Image 4</th>
                    <th>Weight & Price</th>
                    <th>Publish</th>
                </tr>
                </thead>
                <input type="hidden" name="module" id="module" value="products">
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
                                $Image = base_url().'uploads/products/'.$row['var_image'];
                            } 
							
							else {
                                $Image =base_url().'public/assets/images/site_imges/no_image.png';
                            }
							 if ($row['var_image1'] != '') {
                                $Image1 = base_url().'uploads/products/'.$row['var_image1'];
                            } 
							
							else {
                                $Image1 =base_url().'public/assets/images/site_imges/no_image.png';
                            }
							 if ($row['var_image2'] != '') {
                                $Image2 = base_url().'uploads/products/'.$row['var_image2'];
                            } 
							
							else {
                                $Image2 =base_url().'public/assets/images/site_imges/no_image.png';
                            }
							 if ($row['var_image3'] != '') {
                                $Image3 = base_url().'uploads/products/'.$row['var_image3'];
                            } 
							
							else {
                                $Image3 =base_url().'public/assets/images/site_imges/no_image.png';
                            }
                           
                            ?>

                        <tr id="<?php echo $row["int_glcode"]; ?>">
                        <td><input type="checkbox" name="ids[]" class="checkboxes" value="<?php echo $row['int_glcode']; ?>"></td>
                        <td><a href="<?php echo base_url() . 'admin/products/editProduct/'. base64_encode($row['int_glcode']); ?>"><i class=" fas fa-pencil-alt"> </i> <?php echo $row['var_title']; ?></a>
                        </td>
                        <td><?php echo $row['cate_name']; ?></td>  
                          
                        <td>
                            <a class="example-image-link" href="<?php echo $Image; ?>" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src="<?php echo $Image; ?>" id="cate_ig" alt="<?php echo $Image; ?>" /></a>
                        </td>
						<td>
                            <a class="example-image-link" href="<?php echo $Image1; ?>" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src="<?php echo $Image1; ?>" id="cate_ig1" alt="<?php echo $Image1; ?>" /></a>
                        </td>
						<td>
                            <a class="example-image-link" href="<?php echo $Image2; ?>" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src="<?php echo $Image2; ?>" id="cate_ig1" alt="<?php echo $Image2; ?>" /></a>
                        </td>
						<td>
                            <a class="example-image-link" href="<?php echo $Image3; ?>" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src="<?php echo $Image3; ?>" id="cate_ig1" alt="<?php echo $Image3; ?>" /></a>
                        </td>
                            <td>
                                <?php echo $row['price_details']; ?>
                            </td>
                            <td class="center">
                                <a href="javascript:void(0);">
                                  <img id="tick-<?php echo $row['int_glcode']; ?>" height="16" width="16" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" src="<?php echo base_url() . 'public/assets/images/site_imges/' . $tickimg; ?>" style="vertical-align:middle;cursor:pointer;" onclick="UpdatePublish('products', 'mst_products', 'chr_publish', '<?php echo $update_val; ?>', '<?php echo $row['int_glcode']; ?>');">
                                </a>
                            </td>
                        </tr>
                            <?php } 
                        } else { ?>
                            <tr><th colspan="8">No data are available.</th></tr>
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
<script type="text/javascript" src="<?php echo base_url(); ?>public/dist/js/product.js"></script>
<script type="text/javascript">

  $("#csv_toggle").click(function() {
    $('#csv_form').toggle();
  });
</script>