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

    url: siteurl+'admin/staff/loadStaff/'+pagenumber,
    type: 'get',
    data: {append:append,field:field,sort:sort,entries:entries},
    dataType: 'json',
    success: function(response){


      $('#pagination').html(response.pagination);            

      createTable(response.result,response.row,response.total_rows,response.total_staff);
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

      url: siteurl+'admin/staff/loadStaff/'+pagenumber,
      type: 'get',
      data: {append:append,field:field,sort:sort,entries:entries},
      dataType: 'json',
      success: function(response){


        $('#pagination').html(response.pagination);
        createTable(response.result,response.row,response.total_rows,response.total_staff);
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

       url: siteurl+'admin/staff/loadStaff/'+pagno,

       type: 'get',

       data: {append:append,field:field,sort:sort,entries:entries},

       dataType: 'json',

       success: function(response){

        $('#pagination').html(response.pagination);          

        createTable(response.result,response.row,response.total_rows,response.total_staff);
      }
    });
    }

    function createTable(result,sno,total_rows,total_staff){
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

        var tr = '<tr><td colspan="6">No results</td></tr>';        

        $('#users_list tbody').append(tr);

        $('#showing_').text('');

        return false;

      }


      for(index in result){

        var id = result[index].int_glcode;

        var var_name = result[index].var_name;
        var var_position = result[index].var_position;
        var var_image = result[index].var_image;
        if (var_image != '') {
          var staff_img = siteurl+'public/assets/images/staff/'+var_image;
        } else {
          var staff_img = siteurl+'public/assets/images/site_imges/no_image.png';
        }
        var dt_createddate = result[index].dt_createddate;

          dt_createddate = new Date(dt_createddate);

          var year = dt_createddate.getFullYear();
          var month = dt_createddate.getMonth() + 1;
          var day = dt_createddate.getDate();

          dt_createddate = day+"/"+month+"/"+year;

        var publish = result[index].chr_publish;
        sno+=1;

        var tr = "<tr id='"+id+"'>";        

        tr += "<td class='center'><input type='checkbox' name='ids[]' class='checkboxes' value="+id+"></td>";

        tr += "<td><a href="+siteurl+"admin/staff/editStaff/"+window.btoa(id)+">"+ var_name +"</a></td>";
        tr += "<td>"+ var_position +"</td>";
        tr += '<td><a class="example-image-link" href='+staff_img+
        ' data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src='+staff_img+
        ' id="cate_ig" alt='+var_name+' /></a></td>';
        tr += "<td>"+dt_createddate+"</td>";
          if(publish == 'Y'){

          var staff = "'staff'";
          var mst_staff_module = "'mst_staff_module'"; 
          var chr_publish = "'chr_publish'";
          var N = "'N'";

          tr += '<td><a href="javascript:void(0);"><img id="tick-'+id+
          '" height="16" width="16" alt="" title="" src="'+siteurl+
          'public/assets/images/site_imges/tick.png" style="vertical-align:middle;cursor:pointer;" onclick="UpdatePublish('+staff+','+mst_staff_module+','+chr_publish+','+N+','+id+');"></a></td>';            
        }else{

          var staff = "'staff'";
          var mst_staff_module = "'mst_staff_module'";
          var chr_publish = "'chr_publish'";
          var Y = "'Y'";

          tr += '<td><a href="javascript:void(0);"><img id="tick-'+id+
          '" height="16" width="16" alt="" title="" src="'+siteurl+
          'public/assets/images/site_imges/tick_cross.png" style="vertical-align:middle;cursor:pointer;" onclick="UpdatePublish('+staff+','+mst_staff_module+','+chr_publish+','+Y+','+id+');"></a></td>';
        }   

        tr += "</tr>";
        //var first_id = $('table tr:first').attr('id');
        //var last_id = $('table tr:last').attr('id');
        //console.log(last_id);
        $('#users_list tbody').append(tr);

        var search = $('#search').val();

        if(search == ''){
          $('#showing_').text('Showing '+start+' to '+end+' of '+total_rows+' entries');
        }else{
          $('#showing_').text('Showing '+start+' to '+end+' of '+total_rows+' entries (filtered from '+total_staff+' total entries)');

        }
      }
    }