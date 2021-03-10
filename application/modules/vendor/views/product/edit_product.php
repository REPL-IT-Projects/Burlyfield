<style>
    .parent_name {
        font-weight: bold;
        color: #CF4916 !important;
    }
    .imageThumb {
                    width: 20%;
                }
</style>
<div class="page-holder w-100 d-flex flex-wrap">
            <div class="container-fluid px-xl-5">
<section>
                  <div class="page-holder d-flex align-items-center">
                     <div class="container">
                        <div class="row align-items-center py-5">
                           <div class="col-lg-10  mx-auto">
                              <h2 class="mb-4">Edit Product</h2>
                              <!--<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>-->
                              <form action="<?php echo base_url().'vendor/products/update_record/'.$data['int_glcode']; ?>" method="POST" class="form-horizontal" enctype='multipart/form-data'>
                <input type="hidden" name="fk_vendor" id="fk_vendor" value="<?php echo $_SESSION['fk_vendor'];?>">
                <div class="card-body" style="border: 1px solid #e8e8e8;border-radius: 5px;">
                        <div class="form-group row">
                            <label for="var_name" class="col-sm-3  control-label col-form-label">Category<span class="mandatory">*</span></label>
                            <div class="col-sm-7">
                                <select class="form-control" id="fk_category" name="fk_category">
                                    <?php foreach ($category as $key => $value) { ?>
                                        <option class="parent_name" value="<?php echo $value->int_glcode; ?>" <?php if ($value->int_glcode == $data['fk_category']) {
                                                  echo "selected"; }?>><?php echo $value->var_title; ?></option>
                                        <?php if (!empty($value)) {
                                            foreach ($value->sub as $ckey => $cval) { ?>
                                                <option value="<?php echo $cval->int_glcode; ?>" <?php if ($cval->int_glcode == $data['fk_category']) {
                                                  echo "selected"; }?>><?php echo $cval->var_title; ?></option>
                                              <?php }
                                          } if (!empty($cval)) {
                                            foreach ($cval->sub as $sckey => $scval) { ?>
                                                <option value="<?php echo $scval->int_glcode; ?>" <?php if ($scval->int_glcode == $data['fk_category']) {
                                                  echo "selected"; }?>><?php echo $scval->var_title; ?></option>
                                              <?php }
                                          }
                                      } ?>
                                  </select>
                              </div>
                          </div>
                        
                          <div class="form-group row">
                            <label for="var_username" class="col-sm-3  control-label col-form-label">Product Name<span class="mandatory">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="var_name" name="var_name" value="<?php echo $data['var_title']; ?>" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="var_image" class="col-sm-3  control-label col-form-label">Cover Image</label>
                                  <?php
                            if ($data['var_image'] != '') {
                                $Image = base_url().'uploads/products/'.$data['var_image'];
                            } else{
                                $Image = base_url().'public/assets/images/site_imges/no_image.png';
                            }
                            ?>
                            <div class="col-sm-7">
                                <input type="file" class="form-control" id="var_cimg" name="var_cimg">
                            </div>
                            <a class="example-image-link" href="<?php echo $Image;?>" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img style="width: 50px;" class="example-image" src="<?php echo $Image;?>" id="cate_ig" alt="<?php echo $Image;?>"></a>
                            <input type="hidden" name="hidvar_image" value="<?php echo $data['var_image']; ?>">
                        </div>
                        <div class="form-group row">
                            <label for="var_quantity" class="col-sm-3  control-label col-form-label">Short Description</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="var_short_desc" name="var_short_desc" value="<?php echo $data['var_short_description'] ?>" placeholder="Product Short Description Here">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="var_description" class="col-sm-3  control-label col-form-label">Description</label>
                            <div class="col-sm-7">
                                <textarea id="var_description" class="form-control" name="var_description" placeholder="Product Description Here"><?php echo $data['txt_description']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="var_offer" class="col-sm-3  control-label col-form-label">Discount Offer</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="var_offer" name="var_offer" placeholder="discount" value="<?php echo $data['var_offer']; ?>" required>
                            </div>
                            <div class="col-sm-1">%</div>
                        </div>
                        <?php 
                        if (count($price_detail)) { ?>
                          <div class="form-group row price_detail_padd">
                            <label for="var_description" class="col-sm-3  control-label col-form-label">Price Details</label>
                            <div class="col-sm-7">
                          <?php foreach ($price_detail as $pkey => $pval) { ?>
                            <input type="hidden" name="price_id[]" value="<?php echo $pval['int_glcode']; ?>">
                            <div class="row" id="remove_price<?php echo $pval['int_glcode']; ?>">
                              <div class="col-sm-4">
                            <input type="text" class="form-control" id="var_quantity" name="var_quantity[]" value="<?php echo $pval['var_quantity'] ?>">
                            </div>
                            <div class="col-sm-3">
                            <input type="text" class="form-control" id="var_price" name="var_price[]" value="<?php echo $pval['var_price'] ?>">
                          </div>
                                <div class="col-sm-1">Rs</div>
                          <div class="col-sm-4">
                            <div class="mb-30 abcd" data-src="">
                            <div class="frame">
                          <a href="javascript:;" onclick="confirmPriceDelete(<?php echo $pval['int_glcode']; ?>)" class="delet_button"><img id="img" class="closeicondrag" src="<?php echo base_url(); ?>public/assets/images/site_imges/x.png" alt="delete">
                            </a>
                            
                        </div>
                      </div>
                          </div>
                            </div>
                        <?php } ?>
                          </div>
                        </div>
                        <?php } ?>
                        
                        <div class="form-group row">
                          <div class="col-sm-3 ">
                            <input class="btn btn-success" id="btnAdd" type="button" value="+ Add" />
                          </div>
                          <div id="manage_price" class="col-sm-7">
                          
                          </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="var_price" class="col-sm-3  control-label col-form-label">Nutrition Details </label>
                            <div class="col-sm-7">
                                <textarea id="txt_nutrition" name="txt_nutrition"><?php echo $data['txt_nutrition']; ?></textarea>
                            </div>
                        </div>
                    <div class="form-group row">
                      <label for="var_image" class="col-sm-3  control-label col-form-label">Product Images</label>
                  <div class="col-sm-7">
                    <?php
                    if (!empty($mul_images)) {
                      
                    foreach ($mul_images as $val) { 
                     
                        $Image = base_url().'uploads/products/'.$val['var_images'];
                    
                          $show_rimg = '<a class="example-image-link banner_aimg upload_doc_img" href="'.$Image.'" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src="'.$Image.'" id="cate_ig" alt="'.$Image.'"/></a>';
                        
                        ?>
                      
                        <div class="mb-30 abcd" data-src="">
                          <div class="frame" id="remove_image<?php echo $val['int_glcode']; ?>">
                          <a href="javascript:;" onclick="confirmDelete(<?php echo $val['int_glcode']; ?>)" class="delet_button"><img id="img" class="closeicondrag" src="<?php echo base_url(); ?>public/assets/images/site_imges/x.png" alt="delete">
                            </a>
                            <?php echo $show_rimg; ?>
                            
                        </div>
                      </div>

                      <?php } }?>
                      <a class="btn btn-success" id="addFile"> + Add Image</a>
                       <div id="filesContainer" class="connectedSortable"></div>
                     
                    </div>
                  </div>
                    <div class="card-body">
                        <div class="form-group mb-0 text-center">
                            <button type="submit" name="submit" class="btn btn-info waves-effect waves-light">Save</button>
                            <button type="reset" name="cancel" class="btn btn-dark waves-effect waves-light">Cancel</button>
                        </div>
                    </div>
                </form>
                           </div></form>
                        </div>
                     </div>
                  </div>
               </section>
            </div>
    <script type="text/javascript" src="https://cdn.ckeditor.com/4.12.1/standard-all/ckeditor.js"></script>
    
<script type="text/javascript">
  var site_path = '<?php echo base_url(); ?>';
</script>
<script type="text/javascript">
  $(document).ready(function() {
  $("#btnAdd").click(function() {
    $("#manage_price").append('<div class="con row"><div class="col-sm-4"><input type="text" class="form-control" name="var_quantity_new[]" placeholder="Quantity"></div><div class="col-sm-3"><input type="text" class="form-control" name="var_price_new[]" placeholder="Price"></div><div class="col-sm-1">Rs</div>' + '<div class="col-sm-4"><div class="mb-30 abcd" data-src=""><div class="frame"><a href="javascript:;" class="btnRemove"><img id="img" class="closeicondrag" src="'+site_path+'public/assets/images/site_imges/x.png" alt="delete"></a></div></div></div></div>');
  });
  $('body').on('click','.btnRemove',function() {
    $(this).parent().parent().parent().parent('div.con').remove();
  });
});
</script>
<script type="text/javascript">
$(document).ready(function (){
  CKEDITOR.replace('txt_nutrition');
});
</script>
<script type="text/javascript">
    var site_path = '<?php echo base_url(); ?>';
    
    $(function(){
        $('button[name=cancel]').click(function(){
            window.location = site_path+'vendor/products';
        });
    });

    $(document).ready(function() {
        var dId1 = 0;

        $('#addFile').click(function() {

          $('#addFile').addClass('disabled');
          dId1++;

          $('#filesContainer').append(
            $('<input type="file" class="hide_img_tag" name="var_image[]" id="1doc_count_'+dId1+'">')
            );
          if (window.File && window.FileList && window.FileReader) {
            $("#1doc_count_"+dId1).on("change", function(e) {
              var rem_input = "#1doc_count_"+dId1;
              var files = e.target.files,
              filesLength = files.length;
              for (var i = 0; i < filesLength; i++) {
                var ext = files[i].name.substr(-4);
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                    var file = e.target;
                    $("<span class=\"pip\">" +
                        "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                        "<br/><span class=\"remove\">Remove image</span></span>").insertAfter("#1doc_count_"+dId1);
                    $("#1doc_count_"+dId1).css("display", "none");
                    $('#addFile').removeClass('disabled');
                    $(".remove").click(function(){
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
  function confirmDelete(id)
  {
    swal({
      title: "Are you sure?",
      text: "You want to delete this image ?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      cancelButtonText: "No",
      confirmButtonText: "Yes",
      closeOnConfirm: false
    }).then((result) => {
      if (result.value) {
        $.ajax(
        {
          url: site_path + "vendor/products/deleteProductImges",
          method: 'POST',
          data:
          {
            id: id
          },
          success: function (result)
          {
              //$("div#removeimages"+id).remove();
              $('div#remove_image' + id + '').remove();
            }
          });
            //$(location).attr('href','<?php //echo base_url() ?>album/deleteimges/'+id);
          }
        })
  }
</script>

<script type="text/javascript">
  function confirmPriceDelete(id)
  {
    swal({
      title: "Are you sure?",
      text: "You want to delete this details ?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      cancelButtonText: "No",
      confirmButtonText: "Yes",
      closeOnConfirm: false
    }).then((result) => {
      if (result.value) {
        $.ajax(
        {
          url: site_path + "vendor/products/deleteProductPrices",
          method: 'POST',
          data:
          {
            id: id
          },
          success: function (result)
          {
              //$("div#removeimages"+id).remove();
              $('div#remove_price' + id + '').remove();
            }
          });
            //$(location).attr('href','<?php //echo base_url() ?>album/deleteimges/'+id);
          }
        })
  }
</script>