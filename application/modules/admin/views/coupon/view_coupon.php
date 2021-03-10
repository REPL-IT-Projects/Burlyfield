
<div id="main-wrapper">
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
            <?php echo validation_errors(); ?>
            <?php if($this->session->flashdata('Invalid') != ''){ ?>
                <div class="alert alert-success hide_msg">
                    <p><?php echo $this->session->flashdata('Invalid');?></p>
                </div>
            <?php } ?>
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Promocode</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Promocode</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                           <a id="add_cate" href="<?php echo base_url(); ?>admin/coupon/add_coupon" class="btn btn-info btn-rounded m-t-10 mb-2 float-right"><i class="mr-2 mdi mdi-plus"></i>Add Promocode</a>
                       </div>
                   </div>
               </div>
           </div>

<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">          
          
          <div class="card-body table-responsive">      
            <table id="users_list" class="table table-striped table-bordered" style="width:100%">
              <!-- id bs4-table -->
              <thead>
                <tr><th colspan="5">
                  
                  Show:<select name="dp_entries" style="margin:0px 5px 0px 10px;">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50" selected="">50</option>
                    <option value="100">100</option>
                  </select>entries
                
                </th><th colspan="3">
                  <input type="search" name="search" id="search" class="form-control" placeholder="Search">
                </th></tr>                
                <tr style="background-color: rgba(0, 0, 3, 0.1);">
                  <th style="width: 3%;"><span class="icon">
              <input type="checkbox" onclick="checkAll('chkgrow')" id="checkAll" name="chkall_agt" />
                  </span></th>

          
                  <th><a href="#" field="var_promocode" class="_sort">Coupon Code</a></th>
                  <th><a href="#" field="var_percentage" class="_sort">Discount Percentage</a></th>
                      <th><a href="#" field="var_price" class="_sort">Max Discount Price</a></th>
                      <th><a href="#" field="var_price" class="_sort">Min Order Price</a></th>
                      <th><a href="#" field="no_of_time" class="_sort">Use Per User</a></th>
                      <th><a href="#" field="expiry_date" class="_sort">Expiry Date</a></th>
            
                  <th style="width: 7%;text-align: center;">Publish</th>
                </tr>
              </thead>
                <input type="hidden" name="module" id="module" value="coupon">
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

            ?>

<!-- '<?php echo $value['fk_user']; ?>' -->

            <tr id="<?php echo $row["int_glcode"]; ?>">
              <td><input type="checkbox" name="ids[]" class="checkboxes" value="<?php echo $row['int_glcode']; ?>"></td>
              
                    <td><a href="<?php echo base_url() . 'admin/coupon/edit_coupon/'. base64_encode($row['int_glcode']); ?>"> <?php echo $row['var_promocode']; ?></a>
                  </td>
                  <td><?php echo $row['var_percentage']; ?>%</td>
                  <td><?php echo $row['var_price']; ?></td>
                  <td><?php echo $row['min_order']; ?></td>
                  <td><?php echo $row['no_of_time']; ?></td>
                  <td><?php echo $row['expiry_date']; ?></td>

              <td class="center text-center">
                <a href="javascript:void(0);">
                  <img id="tick-<?php echo $row['int_glcode']; ?>" height="16" width="16" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" src="<?php echo base_url() . 'public/assets/img/site_imges/' . $tickimg; ?>" style="vertical-align:middle;cursor:pointer;" onclick="UpdatePublish('coupon', 'mst_promocode', 'chr_publish', '<?php echo $update_val; ?>', '<?php echo $row['int_glcode']; ?>');">
                </a>
              </td>
            </tr>
          <?php } 
        } else { ?>
          <tr><td colspan="8">No coupon are available.</td></tr>
        <?php } ?>
              </tbody>
            </table>

          <input type="hidden" id="module_name" name="module_name" value="coupon">


          <input type="hidden" name="hfield" value="int_glcode">
            <input type="hidden" name="hsort" value="desc">
            <input type="hidden" name="hpageno" value="0">
             <?php

              if (count($data) > 0) {

                ?>
            <div>
              <div id="pagination" style="float: right">
            <!-- <ul class="tsc_pagination" id="ajax_pagingsearc"> -->
              <!-- Show pagination links -->
                <?php echo $pagination; ?>
            </div>
              <label id="showing_"><?php echo 'Showing 1 to '.count($data).' of '.$total_users.' entries'; ?></label>
          </div>
                <div id="div_delete">
                <button type="submit" class="btn btn-danger btn_fnt" name="btn_delete" id="btn_delete"><i class="icon dripicons-trash color_change"></i>Delete</button>
                 </div>  
          <?php } ?>
          </div>
        </div>
      </div>
    </div>

</div>

<!-- ================== GLOBAL APP SCRIPTS ==================-->
<script src="<?php echo base_url(); ?>public/assets/js/global/app.js"></script>
<!-- ================== PAGE LEVEL COMPONENT SCRIPTS ==================-->
<script src="<?php echo base_url(); ?>public/assets/js/components/datatables-init.js"></script>
<script>
    var siteurl = '<?php echo base_url(); ?>';      
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
              
                url: '<?=base_url()?>admin/coupon/loadcoupon/'+pagenumber,
              type: 'get',
              data: {append:append,field:field,sort:sort,entries:entries},
              dataType: 'json',
             success: function(response){

                  
                $('#pagination').html(response.pagination);            

                createTable(response.result,response.row,response.total_rows,response.total_users);
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
              
                url: '<?=base_url()?>admin/coupon/loadcoupon/'+pagenumber,
              type: 'get',
              data: {append:append,field:field,sort:sort,entries:entries},
              dataType: 'json',
             success: function(response){


                $('#pagination').html(response.pagination);
                createTable(response.result,response.row,response.total_rows,response.total_users);
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

         url: '<?=base_url()?>admin/coupon/loadcoupon/'+pagno,

         type: 'get',

         data: {append:append,field:field,sort:sort,entries:entries},

         dataType: 'json',

         success: function(response){

          $('#pagination').html(response.pagination);          

          createTable(response.result,response.row,response.total_rows,response.total_users);
        }
      });
     }

     function createTable(result,sno,total_rows,total_users){
        //alert(JSON.stringify(result));
        //console.log(JSON.stringify(result));return false;
       var sno = Number(sno);

       var start = sno+1;

       if(result != null && result != ''){
       var count_rows = result.length;
      }  

       var end = sno + count_rows;

       $('#users_list tbody').empty();

       if(result == null || result == ''){

        var tr = '<tr><td colspan="8">No results</td></tr>';        

          $('#users_list tbody').append(tr);

          $('#showing_').text('');

          return false;

       }

       for(index in result){

        var id = result[index].int_glcode;
        var var_promocode = result[index].var_promocode;
        var var_price = result[index].var_price;
        var no_of_time = result[index].no_of_time;
        var expiry_date = result[index].expiry_date;
        var var_percentage = result[index].var_percentage;
        var min_order = result[index].min_order;
        var publish = result[index].chr_publish;

        sno+=1;

        var tr = "<tr id='"+id+"'>";

        tr += "<td class='center'><input type='checkbox' name='ids[]' class='checkboxes' value="+id+"></td></td>";


        tr += "<td><a href="+siteurl+"admin/coupon/edit_coupon/"+window.btoa(id)+">"+ var_promocode +"</a></td>";
        tr += "<td>"+ var_percentage +"%</td>";
        tr += "<td>"+ var_price +"</td>";
        tr += "<td>"+ min_order +"</td>";
        tr += "<td>"+ no_of_time +"</td>";
        tr += "<td>"+ expiry_date +"</td>";

        if(publish == 'Y'){

            var category = "'coupon'";
            var mst_category = "'mst_promocode'";
            var chr_publish = "'chr_publish'";
            var N = "'N'";

            tr += '<td><a href="javascript:void(0);"><img id="tick-'+id+'" height="16" width="16" alt="" title="" src="'+siteurl+'public/assets/img/site_imges/tick.png" style="vertical-align:middle;cursor:pointer;" onclick="UpdatePublish('+category+','+mst_category+','+chr_publish+','+N+','+id+');"></a></td>';            
        }else{

            var category = "'coupon'";
            var mst_category = "'mst_promocode'";
            var chr_publish = "'chr_publish'";
            var Y = "'Y'";

            tr += '<td><a href="javascript:void(0);"><img id="tick-'+id+'" height="16" width="16" alt="" title="" src="'+siteurl+'public/assets/img/site_imges/tick_cross.png" style="vertical-align:middle;cursor:pointer;" onclick="UpdatePublish('+category+','+mst_category+','+chr_publish+','+Y+','+id+');"></a></td>';
        }     

          //alert("+++");   

        tr += "</tr>";
        //var first_id = $('table tr:first').attr('id');
        //var last_id = $('table tr:last').attr('id');
        //console.log(last_id);
        $('#users_list tbody').append(tr);

        var search = $('#search').val();

        if(search == ''){
          $('#showing_').text('Showing '+start+' to '+end+' of '+total_rows+' entries');
        }else{
          $('#showing_').text('Showing '+start+' to '+end+' of '+total_rows+' entries (filtered from '+total_users+' total entries)');

        }
      }
    }
</script>
