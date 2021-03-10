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

    url: siteurl+'admin/orders/loadData/'+pagenumber,
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

      url: siteurl+'admin/orders/loadData/'+pagenumber,
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

       url: siteurl+'admin/orders/loadData/'+pagno,

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

       $('#orders_list_admin tbody').empty();

       if(result == null || result == ''){

        var tr = '<tr><td colspan="6">No results</td></tr>';        

        $('#orders_list_admin tbody').append(tr);

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

        if (chr_status == 'P') {
                tr += "<td><button class='btn btn-success' onclick=order_status('"+id+"','A')>Accept</button><br><button class='btn btn-danger' style='margin-top:10px;' onclick=order_status('"+id+"','R')>Reject</button></td>";
            } else if (chr_status == 'W') {
                tr += "<td><button class='btn btn-info' onclick=order_status('"+id+"','S')>Out for Delivery</button></td>";
            } else if (chr_status == 'S') {
                tr += "<td><button class='btn btn-success'>Delivered</button><br><button class='btn btn-warning' style='margin-top:10px;' onclick=order_status('"+id+"','T')>Return</button></td>";
            } else if (chr_status == 'R') {
                tr += "<td><button class='btn btn-danger'>Cancelled</button></td>";
            } else if (chr_status == 'T') {
                tr += "<td><button class='btn btn-warning'>Returned</button></td>";
            }
        
        tr += "<td><a class='btn btn-primary btn_view' href="+siteurl+"admin/orders/viewDetails/"+window.btoa(id)+">View</a></td>";
        tr += "</tr>";
        //var first_id = $('table tr:first').attr('id');
        //var last_id = $('table tr:last').attr('id');
        //console.log(last_id);
        $('#orders_list_admin tbody').append(tr);

        var search = $('#search').val();

        if(search == ''){
          $('#showing_').text('Showing '+start+' to '+end+' of '+total_rows+' entries');
        }else{
          $('#showing_').text('Showing '+start+' to '+end+' of '+total_rows+' entries (filtered from '+total_data+' total entries)');
        }
      }
    }
