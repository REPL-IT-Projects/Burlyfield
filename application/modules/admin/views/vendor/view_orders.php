<?php $vendor_id = base64_decode($this->uri->segment(4)); ?>
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
                <h4 class="page-title">Orders</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Orders</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex no-block justify-content-end align-items-center">
                 <a id="add_cate" href="<?php echo base_url().'admin/vendor/createVendorOrderXLS/'.$vendor_id?>" class="btn btn-info btn-rounded m-t-10 mb-2 float-right"><i class="mr-2 mdi mdi-export"></i>Export Orders</a>
             </div>
         </div>
     </div>
 </div>
 <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <input type="hidden" name="fk_vendor" id="fk_vendor" value="<?php echo $vendor_id; ?>">
                    <table id="orders_list_vendor" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr><th colspan="7">
                              Show:<select name="dp_entries">
                                <option value="10" selected="">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>entries
                        </th>
                        <th colspan="2">
                          <input type="search" name="search" id="search" class="form-control" placeholder="Search">
                      </th></tr>                
                      <tr style="background-color: rgba(0, 0, 3, 0.1);">
                        <th>Sr No.</th>
                        <th><a href="javascript:void(0);" field="mo.order_id" class="_sort">#Order ID</a></th>
                        <th><a href="javascript:void(0);" field="mu.var_name" class="_sort">User</a></th>
                        <th><a href="javascript:void(0);" field="var_alternate_mobile" class="_sort">Mobile No</a></th>
                        <th><a href="javascript:void(0);" field="mo.var_payable_amount" class="_sort">Payable Amount</a></th>
                        <th><a href="javascript:void(0);" field="mo.var_payment_mode" class="_sort">Payment Mode</a></th>
                        <th><a href="javascript:void(0);" field="mo.dt_delivery_date" class="_sort">Date</a></th>
                        <th><a href="javascript:void(0);" field="mo.chr_status" class="_sort">Status</a></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <input type="hidden" name="module" id="module" value="orders">
                <tbody>
                    <?php 
                    if (count($data) > 0) {
                        $i = 1;
                        foreach ($data as $row) {

                            if ($row['chr_status'] == 'P') {
                                $status_cls = 'btn btn-info';
                                $status_lbl = 'Pending';
                            } elseif ($row['chr_status'] == 'W') {
                                $status_cls = 'btn btn-warning';
                                $status_lbl = 'Packed & Ready To Ship';
                            } elseif ($row['chr_status'] == 'SH') {
                                $status_cls = 'btn btn-warning';
                                $status_lbl = 'Shipped';
                            } elseif ($row['chr_status'] == 'RC') {
                                $status_cls = 'btn btn-warning';
                                $status_lbl = 'Reached your City';
                            } elseif ($row['chr_status'] == 'R') {
                                $status_cls = 'btn btn-danger';
                                $status_lbl = 'Rejected';
                            } elseif ($row['chr_status'] == 'S') {
                                $status_cls = 'btn btn-success';
                                $status_lbl = 'Delivered';
                            } else if ($row['chr_status'] == 'A') {
                                    $status_cls = 'btn btn-success';
                                    $status_lbl = 'Accepted';
                                }
                                
                            if ($row['var_alternate_mobile'] != '') {
                                $row['var_alternate_mobile'] = $row['var_alternate_mobile'];
                            } else {
                                $row['var_alternate_mobile'] = 'N/A';
                            }

                            ?>
                            <tr id="<?php echo $row["int_glcode"]; ?>">
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $row['order_id']; ?></td>
                                <td><?php echo $row['var_name']; ?></td>
                                <td><?php echo $row['var_alternate_mobile']; ?></td>      
                                <td>&#x20b9; <?php echo $row['var_payable_amount']; ?></td>
                                <td><?php echo $row['var_payment_mode']; ?></td>
                                <td><?php echo date('d/m/Y',strtotime($row['dt_createddate'])); ?></td>
                                <td><span class="<?php echo $status_cls; ?>" style="cursor: default;"><?php echo $status_lbl; ?></span></td>
                                <td><a class="btn btn-primary btn_view" href="<?php echo base_url() . 'admin/orders/viewDetails/'. base64_encode($row['int_glcode']); ?>">View</a></td>
                            </tr>
                        <?php } 
                    } else { ?>
                        <tr><th colspan="9">No data are available.</th></tr>
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
var vendor_id = $('#fk_vendor').val();
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

    url: siteurl+'admin/vendor/loadOrders/'+pagenumber,
    type: 'get',
    data: {append:append,field:field,sort:sort,entries:entries,vendor_id:vendor_id},
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

      url: siteurl+'admin/vendor/loadOrders/'+pagenumber,
      type: 'get',
      data: {append:append,field:field,sort:sort,entries:entries,vendor_id:vendor_id},
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

       url: siteurl+'admin/vendor/loadOrders/'+pagno,

       type: 'get',

       data: {append:append,field:field,sort:sort,entries:entries,vendor_id:vendor_id},

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

       $('#orders_list_vendor tbody').empty();

       if(result == null || result == ''){

        var tr = '<tr><td colspan="6">No results</td></tr>';        

        $('#orders_list_vendor tbody').append(tr);

        $('#showing_').text('');

        return false;

      }

      for(index in result){

        var id = result[index].int_glcode;
        var order_id = result[index].order_id;
        var var_name = result[index].var_name;
        var var_alternate_mobile = result[index].var_alternate_mobile;
        var var_payable_amount = result[index].var_payable_amount;
        var var_payment_mode = result[index].var_payment_mode;
        var dt_delivery_date = result[index].dt_createddate;
        var chr_status = result[index].chr_status;

        if (chr_status == 'P') {
                var status_cls = 'btn btn-info';
                var status_lbl = 'Pending';
            } else if (chr_status == 'W') {
                var status_cls = 'btn btn-warning';
                var status_lbl = 'Packed & Ready To Ship';
            } else if (chr_status == 'SH') {
                var status_cls = 'btn btn-warning';
                var status_lbl = 'Shipped';
            } else if (chr_status == 'RC') {
                var status_cls = 'btn btn-warning';
                var status_lbl = 'Reached your City';
            } else if (chr_status == 'R') {
                var status_cls = 'btn btn-danger';
                var status_lbl = 'Rejected';
            } else if (chr_status == 'S') {
                var status_cls = 'btn btn-success';
                var status_lbl = 'Delivered';
            } else if (chr_status == 'A') { 
                    var status_cls = 'btn btn-success';
                    var status_lbl = 'Accepted';
                }

        sno+=1;

        var tr = "<tr id='"+id+"'>";        

        tr += "<td class='center'><input type='checkbox' name='ids[]' class='checkboxes' value="+id+"></td>";
        tr += "<td>"+ order_id +"</td>";
        tr += "<td>"+ var_name +"</td>";
        tr += "<td>"+ var_alternate_mobile +"</td>";
        tr += "<td>&#x20b9; "+ var_payable_amount +"</td>";
        tr += "<td>"+ var_payment_mode +"</td>";
        tr += "<td>"+ dt_delivery_date +"</td>";
        tr += "<td><span class='"+status_cls+"' style='cursor: default;'>"+status_lbl+"</span></td>";
        tr += "<td><a class='btn btn-primary btn_view' href="+siteurl+"admin/orders/viewDetails/"+window.btoa(id)+">View</a></td>";
        tr += "</tr>";
        //var first_id = $('table tr:first').attr('id');
        //var last_id = $('table tr:last').attr('id');
        //console.log(last_id);
        $('#orders_list_vendor tbody').append(tr);

        var search = $('#search').val();

        if(search == ''){
          $('#showing_').text('Showing '+start+' to '+end+' of '+total_rows+' entries');
        }else{
          $('#showing_').text('Showing '+start+' to '+end+' of '+total_rows+' entries (filtered from '+total_data+' total entries)');
        }
      }
    }
</script>