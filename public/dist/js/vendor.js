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

    url: siteurl+'admin/vendor/loadData/'+pagenumber,
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

      url: siteurl+'admin/vendor/loadData/'+pagenumber,
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

       url: siteurl+'admin/vendor/loadData/'+pagno,

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

       $('#vendor_list tbody').empty();

       if(result == null || result == ''){

        var tr = '<tr><td colspan="6">No results</td></tr>';        

        $('#vendor_list tbody').append(tr);

        $('#showing_').text('');

        return false;

      }


      for(index in result){

        var id = result[index].int_glcode;

        var var_name = result[index].var_name;
        var var_email = result[index].var_email;
        var var_mobile = result[index].var_mobile_no;
        var membership_type = result[index].var_membership_type;
        var var_image = result[index].var_image;
        if (var_image != '') {
          var image = siteurl+'uploads/vendor/'+var_image;
        } else {
          var image = siteurl+'public/assets/images/site_imges/no_image.png';
        }
        
        var publish = result[index].chr_publish;

        sno+=1;

        var tr = "<tr id='"+id+"'>";        

        tr += "<td class='center'><input type='checkbox' name='ids[]' class='checkboxes' value="+id+"></td>";
        tr += "<td><a href="+siteurl+"admin/vendor/editVendor/"+window.btoa(id)+">"+ var_name +"</a></td>";
        tr += "<td>"+ var_email +"</td>";
        tr += "<td>"+ var_mobile +"</td>";
        tr += '<td><a class="example-image-link" href='+image+
        ' data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src='+image+
        ' id="cate_ig" alt='+var_name+' /></a></td>';
        tr += "<td>"+ membership_type +"</td>";
        if(publish == 'Y'){

          var vendor = "'vendor'";
          var mst_module = "'mst_vendors'"; 
          var chr_publish = "'chr_publish'";
          var N = "'N'";

          tr += '<td><a href="javascript:void(0);"><img id="tick-'+id+
          '" height="16" width="16" alt="" title="" src="'+siteurl+
          'public/assets/images/site_imges/tick.png" style="vertical-align:middle;cursor:pointer;" onclick="UpdatePublish('+vendor+','+mst_module+','+chr_publish+','+N+','+id+');"></a></td>';            
        }else{

          var vendor = "'vendor'";
          var mst_module = "'mst_vendors'";
          var chr_publish = "'chr_publish'";
          var Y = "'Y'";

          tr += '<td><a href="javascript:void(0);"><img id="tick-'+id+
          '" height="16" width="16" alt="" title="" src="'+siteurl+
          'public/assets/images/site_imges/tick_cross.png" style="vertical-align:middle;cursor:pointer;" onclick="UpdatePublish('+vendor+','+mst_module+','+chr_publish+','+Y+','+id+');"></a></td>';
        }   
        // tr += "<td><a href="+siteurl+"admin/vendor/editVendor/"+window.btoa(id)+">"+ var_name +"</a></td>";
        tr += "<td><a class='btn btn-primary btn_view' href="+siteurl+"admin/vendor/viewOrders/"+window.btoa(id)+">View Orders</a></td>";
        tr += "</tr>";
        //var first_id = $('table tr:first').attr('id');
        //var last_id = $('table tr:last').attr('id');
        //console.log(last_id);
        $('#vendor_list tbody').append(tr);

        var search = $('#search').val();

        if(search == ''){
          $('#showing_').text('Showing '+start+' to '+end+' of '+total_rows+' entries');
        }else{
          $('#showing_').text('Showing '+start+' to '+end+' of '+total_rows+' entries (filtered from '+total_data+' total entries)');

        }
      }
    }