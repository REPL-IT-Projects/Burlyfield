<script type="text/javascript" src="https://cdn.ckeditor.com/4.12.1/standard-all/ckeditor.js"></script>
<style>
    .parent_name {
        font-weight: bold;
        color: #CF4916 !important;
    }
    .imageThumb {
                    width: 20%;
                }
    .select2-container{

        width: 100% !important;

    }
</style>
<div id="main-wrapper">
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Products</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/products">View Products</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <?php echo validation_errors(); ?>
        <?php if ($this->session->flashdata('Invalid') != '') { ?>
            <div class="alert alert-danger hide_msg">
                <p><?php echo $this->session->flashdata('Invalid'); ?></p>
            </div>
        <?php } ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-body">
                        <form action="<?php echo base_url() ?>admin/products/insert_record" method="POST" class="form-horizontal" enctype='multipart/form-data'>
                            <div class="card-body"> 
                                <div class="form-group row">
                                    <label for="var_name" class="col-sm-3 text-right control-label col-form-label">Category<span class="mandatory">*</span></label>
                                    <div class="col-sm-7">
                                        <select class="form-control" id="fk_category" name="fk_category" required="">
                                            <option>--- Select Category ---</option>
                                            <?php foreach ($category as $key => $value) { ?>
                                                <option class="parent_name" value="<?php echo $value->int_glcode; ?>"><?php echo $value->var_title; ?></option>
                                                <?php if (!empty($value)) {
                                                    foreach ($value->sub as $ckey => $cval) {
                                                        ?>
                                                        <option value="<?php echo $cval->int_glcode; ?>"><?php echo $cval->var_title; ?></option>
                                                    <?php
                                                    }
                                                } if (!empty($cval)) {
                                                    foreach ($cval->sub as $sckey => $scval) {
                                                        ?>
                                                        <option value="<?php echo $scval->int_glcode; ?>"><?php echo $scval->var_title; ?></option>
                                                        <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="form-group row">
                                    <label for="var_name" class="col-sm-3 text-right control-label col-form-label">Vendor<span class="mandatory">*</span></label>
                                    <div class="col-sm-7">
                                        <select class="form-control" id="fk_vendor" name="fk_vendor" required="">
                                            <option>--- Select Vendor ---</option>
                                            <?php foreach ($vendor as $key => $value1) { ?>

                                                <option value="<?php echo $value1['int_glcode']; ?>"><?php echo $value1['var_name']; ?></option>

                                        <?php } ?>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="form-group row">
                                    <label for="var_username" class="col-sm-3 text-right control-label col-form-label">Product Name<span class="mandatory">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="var_name" name="var_name" placeholder="Product Name Here" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 text-right control-label col-form-label">Cover Image 1<span class="mandatory">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="file" class="form-control" id="var_cimg" name="var_cimg" required="">
                                    </div>
                                </div>
								 <div class="form-group row">
                                    <label for="contact" class="col-sm-3 text-right control-label col-form-label">Cover Image 2<span class="mandatory">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="file" class="form-control" id="var_img" name="var_img" required="">
                                    </div>
                                </div>
								 <div class="form-group row">
                                    <label for="contact" class="col-sm-3 text-right control-label col-form-label">Cover Image 3<span class="mandatory">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="file" class="form-control" id="var_img2" name="var_img2" required="">
                                    </div>
                                </div>
								 <div class="form-group row">
                                    <label for="contact" class="col-sm-3 text-right control-label col-form-label">Cover Image 4<span class="mandatory">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="file" class="form-control" id="var_img3" name="var_img3" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="var_quantity" class="col-sm-3 text-right control-label col-form-label">Short Description</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="var_short_desc" name="var_short_desc" placeholder="Product Short Description Here">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="var_description" class="col-sm-3 text-right control-label col-form-label">Description</label>
                                    <div class="col-sm-7">
                                        <textarea id="var_description" class="form-control" name="var_description" placeholder="Product Description Here"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="var_offer" class="col-sm-3 text-right control-label col-form-label">Discount Offer</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="var_offer" name="var_offer" placeholder="Please enter percent of product discount" value="0" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="var_stock" class="col-sm-3 text-right control-label col-form-label">Stock</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="var_stock" name="var_stock" placeholder="Please enter percent of product Stock" value="0" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="var_stock" class="col-sm-3 text-right control-label col-form-label">GST %</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="var_gst" name="var_gst" placeholder="Please enter percent of GST" value="0" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3 text-right">
                                        <input class="btn btn-success" id="btnAdd" type="button" value="+ Add Price Details" />
                                    </div>
                                    <div id="manage_price">
                                        <div class="con row">
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" name="var_quantity[]" placeholder="Product Quantity *" required="">
                                            </div>
                                            <div class="col-sm-4"><input type="text" class="form-control" name="var_price[]" placeholder="Product Price *" required="">
                                            </div></div></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="var_price" class="col-sm-3 text-right control-label col-form-label">Nutrition Details </label>
                                <div class="col-sm-7">
                                    <textarea id="add_txt_nutrition" name="txt_nutrition"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 text-right control-label col-form-label">Product Images</label>
                                <div class="col-sm-7">
                                    <a class="btn btn-success" id="addFile"> + Add Image</a>
                                    <div id="filesContainer" class="connectedSortable"></div>
                                </div>
                            </div>
                           <!--  <div class="form-group row">

                                <label class="col-sm-3 text-right control-label col-form-label">Select Multiple Pincode</label>

                                <div class="col-sm-3">

                                    <select class="form-control" name="var_pincode[]"  multiple="">

                                        <option value="" disabled="">--Select Pincode--</option>

                                        <?php foreach($pincode as $key => $row2){ ?>

                                        <option value="<?php echo $row2['int_glcode'];?>"><?php echo $row2['var_pincode'];?></option>

                                        <?php } ?>

                                    </select>
                                        
                                </div>
                            </div> -->
                            
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="form-group mb-0 text-center">
                            <button type="submit" name="submit" class="btn btn-info waves-effect waves-light">Save</button>
                            <button type="reset" name="cancel" class="btn btn-dark waves-effect waves-light">Cancel</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>          
    </div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        CKEDITOR.replace('add_txt_nutrition');
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        CKEDITOR.replace('var_description');
    });
</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script type="text/javascript">
    $('#var_pincode').select2();
    var site_path = '<?php echo base_url(); ?>';

    $(function () {
        $('button[name=cancel]').click(function () {
            window.location = site_path + 'admin/products';
        });
    });

    $(document).ready(function () {
        var dId1 = 0;

        $('#addFile').click(function () {

            $('#addFile').addClass('disabled');
            dId1++;

            $('#filesContainer').append(
                    $('<input type="file" class="hide_img_tag" name="var_image[]" id="1doc_count_' + dId1 + '">')
                    );
            if (window.File && window.FileList && window.FileReader) {
                $("#1doc_count_" + dId1).on("change", function (e) {
                    var rem_input = "#1doc_count_" + dId1;
                    var files = e.target.files,
                            filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var ext = files[i].name.substr(-4);
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function (e) {
                            var file = e.target;
                            $("<span class=\"pip\">" +
                                    "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                                    "<br/><span class=\"remove\">Remove image</span>" +
                                    "</span>").insertAfter("#1doc_count_" + dId1);
                            $("#1doc_count_" + dId1).css("display", "none");
                            $('#addFile').removeClass('disabled');
                            $(".remove").click(function () {
                                $(this).parent(".pip").remove();
                                $(rem_input).remove();
                            });
                        });
                        fileReader.readAsDataURL(f);
                    }
                });
                //$("#1doc_count_"+dId1).css("display", "none");
            } else {
                alert("Your browser doesn't support to File API")
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#btnAdd").click(function () {
            $("#manage_price").append('<div class="con row"><div class="col-sm-4"><input type="text" class="form-control" name="var_quantity[]" placeholder="Product Quantity"></div><div class="col-sm-4"><input type="text" class="form-control" name="var_price[]" placeholder="Product Price"></div>' + '<div class="col-sm-4"><div class="mb-30 abcd" data-src=""><div class="frame"><a href="javascript:;" class="btnRemove"><img id="img" class="closeicondrag" src="' + site_path + 'public/assets/images/site_imges/x.png" alt="delete"></a></div></div></div></div>');
        });
        $('body').on('click', '.btnRemove', function () {
            $(this).parent().parent().parent().parent('div.con').remove();
        });
    });
</script>