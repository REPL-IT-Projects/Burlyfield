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

                                          <h2>Products List</h2>

                                       </div>

                                       <div class="col-sm-4">

                                          <a id="add_cate" href="<?php echo base_url();?>vendor/products/add_product" class="btn btn-info btn-rounded m-t-10 mb-2 float-right">+ Add New</a>

                                       </div>

                                    </div>

                                 </div>

                                  <?php echo validation_errors(); ?>

                                    <?php if($this->session->flashdata('Invalid') != ''){ ?>

                                        <div class="alert alert-success hide_msg">

                                            <p><?php echo $this->session->flashdata('Invalid');?></p>

                                        </div>

                                    <?php } ?>

                                  <table id="products_list" class="table table-striped table-bordered" style="width:100%">

                                    <div class="table-responsive">

                                       <thead>
                                           <tr><th colspan="4">
                                                Show:<select name="dp_entries">
                                                  <option value="10" selected="">10</option>
                                                  <option value="25">25</option>
                                                  <option value="50">50</option>
                                                  <option value="100">100</option>
                                              </select>entries
                                          </th><th colspan="1">
                                            <input type="search" name="search" id="search" class="form-control" placeholder="Search">
                                          </th><th colspan="1"></th></tr>
                                          <tr style="background-color: #f17427; color: #fff;">

                                             <th><input type="checkbox" onclick="checkAll(this)"></th>

                                             <th><a style="color: #fff;" href="javascript:void(0);" field="var_title" class="_sort">Product Title</a></th>

                                             <th><a style="color: #fff;" href="javascript:void(0);" field="cate_name" class="_sort">Category</a></th>

                                             <th><a style="color: #fff;" href="javascript:void(0);" field="var_image" class="_sort">Cover Image</a></th>
                                             
                                            <th><a style="color: #fff;" href="javascript:void(0);" field="price_details" class="_sort">Quantity & Price</a></th>
                                            
                                            <th><a style="color: #fff;" href="javascript:void(0);" field="chr_publish" class="_sort">Publish</a></th>

                                          </tr>

                                       </thead>
                                       <input type="hidden" name="module" id="module" value="products">
                                       <tbody>

                                           <?php if(count($data) > 0){ 

                                                    foreach ($data as $row){

                                                        

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

                                                        } else {

                                                            $Image = base_url().'public/assets/images/site_imges/no_image.png';

                                                        }



                                               ?>

                                       <tr id="<?php echo $row['int_glcode'];?>">

                                             <td><input type="checkbox" name="ids[]" class="checkboxes" value="<?php echo $row['int_glcode'];?>"></td>

                                             <td><a href="<?php echo base_url().'vendor/products/edit_product/'.base64_encode($row['int_glcode']); ?>"><i class=" fas fa-edit"></i> <?php echo $row['var_title'];?></a></td>

                                             <td><?php echo $row['cate_name'];?></td>

                                             <td>

                                                <a class="example-image-link" href="<?php echo $Image;?>" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."  ><img style="width: 100px;" class="example-image" src="<?php echo $Image;?>" id="cate_ig" alt="<?php echo $Image;?>"></a>

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

                                           <?php }}else{ ?>

                                          <tr><td colspan="6">No Data Available.</td></tr>

                                           <?php } ?>

                                       </tbody>

                                    </div>

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
               
                <button type="submit" class="btn btn-danger btn_fnt ml-3" name="btn_delete" id="btn_delete">Delete</button>
            <?php } ?>
                                  

                                  

                              </div>

                           </div>

                        </div>

                     </div>

                  </div>

               </section>

</div>
    <style>
        #pagination strong {
            z-index: 2;
            color: #fff;
            background-color: #2962FF;
            border: 1px solid #2962FF;
            position: relative;
            display: inline-block;
            padding: .5rem .75rem;
            margin-left: -1px;
            line-height: 1.25;
        }
        #pagination a {
            position: relative;
            display: inline-block;
            padding: .5rem .75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #0275d8;
            background-color: #fff;
            border: 1px solid #ddd;
        }
        #products_list {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            -ms-overflow-style: -ms-autohiding-scrollbar;
            }
             
    </style>
    <script>
        var siteurl = '<?php echo base_url(); ?>';   
        var sitepath = '<?php echo base_url(); ?>'; 
         $('select[name=dp_entries]').change(function(){
  var entries = $(this).val();
  var append = $("#search").val();
  var field = $('input[name=hfield]').val();
  var sort = $('input[name=hsort]').val();

  loadPagination(0,field,sort,entries);
  $('input[name=hpageno]').val('0');
});

 var pagenumber = 0;

 $("#btn_search").click(function(){

  var append = $("#search").val();
  var field = $('input[name=hfield]').val();
  var sort = $('input[name=hsort]').val();
  var entries = $('select[name=dp_entries]').val();

  $.ajax({

    url: siteurl+'vendor/products/loadData/'+pagenumber,
    type: 'get',
    data: {append:append,field:field,sort:sort,entries:entries},
    dataType: 'json',
    success: function(response){


      $('#pagination').html(response.pagination);            

      createTable(response.result,response.row,response.total_rows,response.total_data);
    }
  });
});

 $('#search').on('keyup',function(){

  var entries = $('select[name=dp_entries]').val();
  var field = $('input[name=hfield]').val();
  var sort = $('input[name=hsort]').val();

  if($(this).val() == ''){            

    loadPagination(0,field,sort,entries);
    $('input[name=hpageno]').val('0');
  }else{

    var append = $("#search").val();
    var field = $('input[name=hfield]').val();
    var sort = $('input[name=hsort]').val();
    var entries = $('select[name=dp_entries]').val();

    $.ajax({

      url: siteurl+'vendor/products/loadData/'+pagenumber,
      type: 'get',
      data: {append:append,field:field,sort:sort,entries:entries},
      dataType: 'json',
      success: function(response){


        $('#pagination').html(response.pagination);
        createTable(response.result,response.row,response.total_rows,response.total_data);
      }
    });
  }

});
 $('#pagination').on('click','a',function(e){

   e.preventDefault(); 

   var pageno = $(this).attr('data-ci-pagination-page');    
   $('input[name=hpageno]').val(pageno);
   var entries = $('select[name=dp_entries]').val();
   var field = $('input[name=hfield]').val();
   var sort = $('input[name=hsort]').val();

   loadPagination(pageno,field,sort,entries);

 });

 $('._sort').on("click" , function(){

  var field = $(this).attr('field');
  $('input[name=hfield]').val(field);
  var sort = $('input[name=hsort]').val();
  if(sort == 'desc'){
    sort = 'asc';
    $(this).closest('tr').find('i').remove();
    $(this).closest('th').append('<i class="fa fa-long-arrow-up" style="font-size:15px"></i>');

  }
  else{
    sort = 'desc';
    $(this).closest('tr').find('i').remove();
    $(this).closest('th').append('<i class="fa fa-long-arrow-down" style="font-size:15px"></i>');
  }

  $('input[name=hsort]').val(sort);       
  var entries = $('select[name=dp_entries]').val();

        //var pagno = $('input[name=hpageno]').val();

        loadPagination(0,field,sort,entries);
      });

    //loadPagination(0,'int_glcode','desc');

    function loadPagination(pagno,field = 'int_glcode',sort = 'desc',entries = '10'){

      var append = $("#search").val();           

      $.ajax({

       url: siteurl+'vendor/products/loadData/'+pagno,

       type: 'get',

       data: {append:append,field:field,sort:sort,entries:entries},

       dataType: 'json',

       success: function(response){

        $('#pagination').html(response.pagination);          

        createTable(response.result,response.row,response.total_rows,response.total_data);
      }
    });
    }

    function createTable(result,sno,total_rows,total_data){
        //alert(JSON.stringify(result));
        //console.log(JSON.stringify(result));return false;
        var sno = Number(sno);

        var start = sno+1;

        if(result != null && result != ''){
         var count_rows = result.length;
       }  

       var end = sno + count_rows;

       $('#products_list tbody').empty();

       if(result == null || result == ''){

        var tr = '<tr><td colspan="6">No results</td></tr>';        

        $('#products_list tbody').append(tr);

        $('#showing_').text('');

        return false;

      }

      for(index in result){

        var id = result[index].int_glcode;

        var var_title = result[index].var_title;
        var cate_name = result[index].cate_name;
        var price_details = result[index].price_details;
        var var_image = result[index].var_image;

        if (var_image != '') {
          var image = siteurl+'uploads/products/'+var_image;
        } else {
          var image = siteurl+'public/assets/images/site_imges/no_image.png';
        }

        
        var publish = result[index].chr_publish;

        sno+=1;

        var tr = "<tr id='"+id+"'>";        

        tr += "<td class='center'><input type='checkbox' name='ids[]' class='checkboxes' value="+id+"></td>";
        tr += "<td><a href="+siteurl+"vendor/products/edit_product/"+window.btoa(id)+"><i class='fas fa-edit'></i> "+ var_title +"</a></td>";
        tr += "<td>"+ cate_name +"</td>";
        tr += '<td><a class="example-image-link" href='+image+
        ' data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src='+image+
        ' id="cate_ig" style="width: 100px;" alt='+var_title+' /></a></td>';
        tr += "<td>"+ price_details +"</td>";
        if(publish == 'Y'){

          var products = "'products'";
          var mst_module = "'mst_products'"; 
          var chr_publish = "'chr_publish'";
          var N = "'N'";

          tr += '<td><a href="javascript:void(0);"><img id="tick-'+id+
          '" height="16" width="16" alt="" title="" src="'+siteurl+
          'public/assets/images/site_imges/tick.png" style="vertical-align:middle;cursor:pointer;" onclick="UpdatePublish('+products+','+mst_module+','+chr_publish+','+N+','+id+');"></a></td>';            
        }else{

          var products = "'products'";
          var mst_module = "'mst_products'";
          var chr_publish = "'chr_publish'";
          var Y = "'Y'";

          tr += '<td><a href="javascript:void(0);"><img id="tick-'+id+
          '" height="16" width="16" alt="" title="" src="'+siteurl+
          'public/assets/images/site_imges/tick_cross.png" style="vertical-align:middle;cursor:pointer;" onclick="UpdatePublish('+products+','+mst_module+','+chr_publish+','+Y+','+id+');"></a></td>';
        }   

        tr += "</tr>";
        //var first_id = $('table tr:first').attr('id');
        //var last_id = $('table tr:last').attr('id');
        //console.log(last_id);
        $('#products_list tbody').append(tr);

        var search = $('#search').val();

        if(search == ''){
          $('#showing_').text('Showing '+start+' to '+end+' of '+total_rows+' entries');
        }else{
          $('#showing_').text('Showing '+start+' to '+end+' of '+total_rows+' entries (filtered from '+total_data+' total entries)');

        }
      }
    }
        </script>