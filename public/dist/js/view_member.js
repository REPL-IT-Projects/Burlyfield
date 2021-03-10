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

    url: siteurl+'admin/member/loadMembers/'+pagenumber,
    type: 'get',
    data: {append:append,field:field,sort:sort,entries:entries},
    dataType: 'json',
    success: function(response){


      $('#pagination').html(response.pagination);            

      createTable(response.result,response.row,response.total_rows,response.total_members);
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

      url: siteurl+'admin/member/loadMembers/'+pagenumber,
      type: 'get',
      data: {append:append,field:field,sort:sort,entries:entries},
      dataType: 'json',
      success: function(response){


        $('#pagination').html(response.pagination);
        createTable(response.result,response.row,response.total_rows,response.total_members);
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

       url: siteurl+'admin/member/loadMembers/'+pagno,

       type: 'get',

       data: {append:append,field:field,sort:sort,entries:entries},

       dataType: 'json',

       success: function(response){

        $('#pagination').html(response.pagination);          

        createTable(response.result,response.row,response.total_rows,response.total_members);
      }
    });
    }

    function createTable(result,sno,total_rows,total_members){
        //alert(JSON.stringify(result));
        //console.log(JSON.stringify(result));return false;
        var sno = Number(sno);

        var start = sno+1;

        if(result != null && result != ''){
         var count_rows = result.length;
       }  

       var end = sno + count_rows;

       $('#members_list tbody').empty();

       if(result == null || result == ''){

        var tr = '<tr><td colspan="9">No results</td></tr>';        

        $('#members_list tbody').append(tr);

        $('#showing_').text('');

        return false;

      }

       //alert(siteurl);

       for(index in result){

        var id = result[index].int_glcode;
        var member_id = result[index].member_id;
        var vCompany = result[index].vCompany;

        var vatno = result[index].vat_no;

        var vCountry = result[index].vCountry;

        var no_of_iso = result[index].no_of_iso;

        var publish = result[index].vStatus;

        sno+=1;

        var tr = "<tr id='"+id+"'>";        

        tr += "<td class='center'><input type='checkbox' name='ids[]' class='checkboxes' value="+id+"></td>";

        tr += "<td>"+member_id+"</td>";
        tr += "<td>"+vCompany+"</td>";
        tr += "<td>"+vatno+"</td>";
        tr += "<td>"+vCountry+"</td>";
        tr += "<td>"+no_of_iso+"</td>";

        if(publish == 'Y'){

          var member = "'member'";
          var mst_member = "'mst_member'"; 
          var chr_publish = "'vStatus'";
          var N = "'N'";

          tr += '<td><div class="custom-control custom-switch switchbtn" id="switch-box"><input type="checkbox" checked="" class="custom-control-input" id="customSwitch'+id+'" onclick="UpdateStatus('+member+', '+mst_member+', '+chr_publish+', '+N+', '+id+');"> <label class="custom-control-label" for="customSwitch'+id+'"></label></div></td>';            
        }else{

          var member = "'member'";
          var mst_member = "'mst_member'";
          var chr_publish = "'vStatus'";
          var Y = "'Y'";

          tr += '<td><div class="custom-control custom-switch switchbtn" id="switch-box"><input type="checkbox" class="custom-control-input" id="customSwitch'+id+'" onclick="UpdateStatus('+member+', '+mst_member+', '+chr_publish+', '+Y+', '+id+');"> <label class="custom-control-label" for="customSwitch'+id+'"></label></div></td>';
        }        

        tr += "<td><div aria-label='Basic example' class='btn-group btn-group-sm' role='group'><a href="+siteurl+"admin/member/editMember/"+window.btoa(id)+" class='btn btn-secondary'><i class='fas fa-edit'></i></a><a href='javascript:void(0)' id="+id+" class='btn btn-danger delete_member'><i class='mdi mdi-window-close'></i></a></div></td>";
        
        tr += "</tr>";
        //var first_id = $('table tr:first').attr('id');
        //var last_id = $('table tr:last').attr('id');
        //console.log(last_id);
        $('#members_list tbody').append(tr);

        var search = $('#search').val();

        if(search == ''){
          $('#showing_').text('Showing '+start+' to '+end+' of '+total_rows+' entries');
        }else{
          $('#showing_').text('Showing '+start+' to '+end+' of '+total_rows+' entries (filtered from '+total_members+' total entries)');

        }
      }
    }
    /*----------------------- delete demarch de soin------------------------------- */
    $(document).on("click", ".delete_member", function(e) {
      var get_id = $(this).attr('id');
      //var row = $(this).closest('tr');  
      if (get_id.length != 0) 
      {
        if (confirm("Are you sure you want to delete member on this page?"))
        {
          $.ajax(
          {
            url: siteurl + "admin/member/deleteMembers",
            method: 'GET',
            data:
            {
              get_id: get_id
            },
            success: function (result)
            {
              if(result == 1){
                $('#members_list tr#' + get_id + '').fadeOut('slow');
                 //var siblings = row.siblings();        
              //    $('#members_list tr').each(function(index) {
              //     $(this).find('td:nth-child(2)').html(index+1);
              // }); 
              }
            }
          });
        }
      }
    });