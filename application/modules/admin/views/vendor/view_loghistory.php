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
                        <h4 class="page-title">Vendors Log History</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Vendors Log History</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                           <a id="add_cate" href="<?php echo base_url(); ?>admin/vendor/add_vendor" class="btn btn-info btn-rounded m-t-10 mb-2 float-right"><i class="mr-2 mdi mdi-plus"></i>Add New Vendor</a>
                           <a id="add_cate" href="<?php echo base_url(); ?>admin/vendor/createXLSLoghistory" class="btn btn-primary btn-rounded m-t-10 mb-2 float-right"><i class="mr-2 mdi mdi-export"></i>Export Excel</a>
                           <a id="add_cate" href="<?php echo base_url(); ?>admin/vendor/pdf_viewer" class="btn btn-primary btn-rounded m-t-10 mb-2 float-right"><i class="mr-2 mdi mdi-export"></i>Export PDF</a>
                       </div>
                   </div>
               </div>
           </div>
           <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
            <div class="card-body table-responsive">
                <table id="vendor_history" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr><th colspan="5">
                          Show:<select name="dp_entries">
                            <option value="10" selected="">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>entries
                    </th><th colspan="1">
                      <input type="search" name="search" id="search" class="form-control" placeholder="Search">
                  </th></tr>                
                  <tr style="background-color: rgba(0, 0, 3, 0.1);">
                    <th><span class="icon">
                        <input type="checkbox" onclick="checkAll('chkgrow')" id="checkAll" name="chkall_agt" />
                    </span></th>
                    <th><a href="javascript:void(0);" field="fk_admin" class="_sort">Admin</a></th>
                    <th><a href="javascript:void(0);" field="fk_vendor" class="_sort">Vendor</a></th>
                    <th><a href="javascript:void(0);" field="chr_mode" class="_sort">Mode</a></th>
                    <th><a href="javascript:void(0);" field="dt_createddate" class="_sort">Date</a></th>
                    <th><a href="javascript:void(0);" field="var_ipaddress" class="_sort">IP Address</a></th>
                </tr>
                </thead>
                <input type="hidden" name="module" id="module" value="vendor">
                <tbody>
                    <?php 
                    if (count($data) > 0) {
                        foreach ($data as $row) {
                            
                    ?>
                        <tr id="<?php echo $row["int_glcode"]; ?>">
                        <td><input type="checkbox" name="ids[]" class="checkboxes" value="<?php echo $row['int_glcode']; ?>"></td>
                        <td><?php echo $row['fk_admin']; ?></td>
                        <td><?php echo $row['fk_vendor']; ?></td> 
                        <td><?php echo $row['chr_mode']; ?></td>   
                        <td><?php echo date('d/m/Y',strtotime($row['dt_createddate'])); ?></td>
                        <td><?php echo $row['var_ipaddress']; ?></td>
                        </tr>
                            <?php } 
                        } else { ?>
                            <tr><th colspan="6">No data are available.</th></tr>
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
<script type="text/javascript">
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

    url: siteurl+'admin/vendor/loadDataHistory/'+pagenumber,
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

      url: siteurl+'admin/vendor/loadDataHistory/'+pagenumber,
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

       url: siteurl+'admin/vendor/loadDataHistory/'+pagno,

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

       $('#vendor_history tbody').empty();

       if(result == null || result == ''){

        var tr = '<tr><td colspan="6">No results</td></tr>';        

        $('#vendor_history tbody').append(tr);

        $('#showing_').text('');

        return false;

      }


      for(index in result){

        var id = result[index].int_glcode;
        var var_admin = result[index].fk_admin;
        var fk_vendor = result[index].fk_vendor;
        var chr_mode = result[index].chr_mode;
        var dt_createddate = result[index].dt_createddate;
        var var_ipaddress = result[index].var_ipaddress;
        
        sno+=1;

        var tr = "<tr id='"+id+"'>";        

        tr += "<td class='center'><input type='checkbox' name='ids[]' class='checkboxes' value="+id+"></td>";
        tr += "<td>"+ var_admin +"</td>";
        tr += "<td>"+ fk_vendor +"</td>";
        tr += "<td>"+ chr_mode +"</td>";
        tr += "<td>"+ dt_createddate +"</td>";
        tr += "<td>"+ var_ipaddress +"</td>";
        tr += "</tr>";
        //var first_id = $('table tr:first').attr('id');
        //var last_id = $('table tr:last').attr('id');
        //console.log(last_id);
        $('#vendor_history tbody').append(tr);

        var search = $('#search').val();

        if(search == ''){
          $('#showing_').text('Showing '+start+' to '+end+' of '+total_rows+' entries');
        }else{
          $('#showing_').text('Showing '+start+' to '+end+' of '+total_rows+' entries (filtered from '+total_data+' total entries)');

        }
      }
    }
</script>