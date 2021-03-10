<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
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
                        <h4 class="page-title">Contact Us</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
               </div>
           </div>
           <!-- ============================================================== -->
           <!-- End Bread crumb and right sidebar toggle -->
           <!-- ============================================================== -->
           <!-- ============================================================== -->
           <!-- Container fluid  -->
           <!-- ============================================================== -->
           <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
            <div class="card-body table-responsive">
                <table id="users_list" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr><th colspan="6">
                          Show:<select name="dp_entries">
                            <option value="10" selected="">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>entries
                        
                    </th><th>
                      <input type="search" name="search" id="search" class="form-control" placeholder="Search">
                  </th></tr>                
                  <tr style="background-color: rgba(0, 0, 3, 0.1);">
                    <th><span class="icon">
                        <input type="checkbox" id="chkall" name="chkall_agt" />
                    </span></th>
                   
                    <th><a href="javascript:void(0);" field="var_name" class="_sort">Name</a></th>
                    <th><a href="javascript:void(0);" field="var_email" class="_sort">Email</a></th>
                    <th><a href="javascript:void(0);" field="var_phone" class="_sort">Phone</a></th>
                    <th><a href="javascript:void(0);" field="var_subject" class="_sort">Subject</a></th>
                    <th><a href="javascript:void(0);" field="var_message" class="_sort">Message</a></th>
                    <th><a href="javascript:void(0);" field="dt_createddate" class="_sort">Date</a></th>
                    <!--<th>Action Report</th>-->
                </tr>
                </thead>
                <input type="hidden" name="module" id="module" value="contactus">
                <tbody>
                    <?php 
                    if (count($data) > 0) {
                        foreach ($data as $row) {
                          
                        ?>
                        <tr id="<?php echo $row["int_glcode"]; ?>">
                            <td><input type="checkbox" name="ids[]" class="checkboxes" value="<?php echo $row['int_glcode']; ?>"></td>
                            <td><?php echo $row['var_name']; ?></td> 
                            <td><?php echo $row['var_email']; ?></td>
                            <td><?php echo $row['var_phone']; ?></td>
                            <td><?php echo $row['var_subject']; ?></td>
                            <td><?php echo $row['var_message']; ?></td>
                            <td><?php echo $row['dt_createddate']; ?></td>
                            <!--<td><a href="javascript:void(0);" style="font-size: 28px;" onclick="UpdateActionReport('<?php //echo $row['int_glcode']; ?>','<?php //echo $row['var_action_report']; ?>')"><i class="fa fa-file"></i></a></td>-->
                        </tr>
                        <?php } 
                        } else { ?>
                        <tr><td colspan="7">No data are available.</td></tr>
                        <?php } ?>
                    </tbody>
                </table>
              <?php
                if (count($data) > 0) {
              ?>
              <input type="hidden" name="hfield" value="int_glcode">
                <input type="hidden" name="hsort" value="desc">
                <input type="hidden" name="hpageno" value="0">
                <div>
                  <div id="pagination" style="float: right">
                    <!-- <ul class="tsc_pagination" id="ajax_pagingsearc"> -->
                      <!-- Show pagination links -->
                      <?php echo $pagination; ?>
                  </div>
                  <label id="showing_"><?php echo 'Showing 1 to '.count($data).' of '.$total_staff.' entries'; ?></label>
                </div>
               
                <button type="submit" class="btn btn-danger btn_fnt" name="btn_delete" id="btn_delete"><i class="icon dripicons-trash color_change"></i>Delete</button>
             
            <?php } ?>
        </div>
            </div>
        </div>
    </div>
</div>
           
                <div class="modal" id="patient_info_Modal" role="dialog">
                        <div class="modal-dialog modal-lg">
                           Modal content
                           <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" onclick="$('#patient_info_Modal').hide();">&times;</button>

                            </div> 
                            <div class="modal-body">

                                <form action="" name="frm_MessageSubmit" id="frm_MessageSubmit" method="POST">
                                    <div class="col-lg-12 col-md-4">                                        
                                        <div class="form-group">
                                            <label>Action Report :</label>
                                            <textarea name="txt_message" id="txt_message" class="form-control" placeholder="Enter Action Report Here" value=""></textarea>

                                            <input type="hidden" name="int_glcode" id="int_glcode" value="">
                                        </div>
                                        <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                    </div>
                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="$('#patient_info_Modal').hide();">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
           
<script type="text/javascript">
  var siteurl = '<?php echo base_url(); ?>';      
  
  $('#frm_MessageSubmit').on('submit', (function (e) {
                        e.preventDefault();

                        var formData = $('#frm_MessageSubmit').serializeArray();
                        $.ajax({
                            url: siteurl + "admin/contactus/submit_report",
                            type: 'POST',
                            data: formData,
                            async: false,
                            success: function (response) {
                                window.location.href = '';
//                                document.getElementById("frm_MessageSubmit").reset();
//                                $("#patient_info_Modal").hide();
                            }
                        });
                    }));
                    
  function UpdateActionReport(id,msg){
      $("#patient_info_Modal").show();
      $('input[name=int_glcode]').val(id);
      $('textarea[name=txt_message]').val(msg);
  }
  
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

    url: siteurl+'admin/contactus/loadStaff/'+pagenumber,
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

      url: siteurl+'admin/contactus/loadStaff/'+pagenumber,
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

       url: siteurl+'admin/contactus/loadStaff/'+pagno,

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

        var tr = '<tr><td colspan="7">No results</td></tr>';        

        $('#users_list tbody').append(tr);

        $('#showing_').text('');

        return false;

      }


      for(index in result){

        var id = result[index].int_glcode;

        var var_name = result[index].var_name;
        var var_email = result[index].var_email;
        var var_phone = result[index].var_phone;
        var txt_comment = result[index].var_message;
        var dt_createddate = result[index].dt_createddate;
        var var_subject = result[index].var_subject;
       
        sno+=1;

        var tr = "<tr id='"+id+"'>";        

        tr += "<td class='center'><input type='checkbox' name='ids[]' class='checkboxes' value="+id+"></td>";

        tr += "<td>"+ var_name +"</td>";
        tr += "<td>"+ var_email +"</td>";
        tr += "<td>"+ var_phone +"</td>";
        tr += "<td>"+ var_subject +"</td>";
        tr += "<td>"+ txt_comment +"</td>";
        tr += "<td>"+ dt_createddate +"</td>";
       // tr += "<td><a href='javascript:void(0);' style='font-size: 28px;' onclick=UpdateActionReport('"+id+"','"+var_action_report+"')><i class='fa fa-file'></i></a></td>";
       
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
</script>
