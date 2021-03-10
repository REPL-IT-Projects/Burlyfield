        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
	////////////////////hide all flashmsg after show /////////////////////
	setTimeout(function() {
		$('.hide_msg').hide('fast');
	}, 5000);

$('button[name=btn_delete]').click(function ()
	{
	  var href = window.location.href;
	  var modulename = $('#module').val();
	  var id = [];
	  $("input[name='ids[]']:checked").each(function (i)
	  {
	  	id[i] = $(this).val();
	  });
	  if (id.length === 0) //tell you if the array is empty
	  {
	  	alert("Please Select atleast one checkbox");
	  }
	  else
	  {
	  	if (confirm("Are you sure you want to delete records on this page?"))
	  	{
	  		$.ajax(
	  		{
	  			url: href + "/delete_multiple",
	  			method: 'POST',
	  			data:
	  			{
	  				id: id
	  			},
	  			success: function (result)
	  			{
	  				// alert(result);
	  				// for (var i = 0; i < id.length; i++) {
	  				// 	$('tr').remove('#'+id[i]);
	  				// }
	              //window.location = site_path + "cipanel/invest";
	              for (var i = 0; i < id.length; i++) {
	              	$('tr#' + id[i] + '').css('background-color', '#ccc');
	              	$('tr#' + id[i] + '').fadeOut('slow');
	              }
	          }
	      });
	  	}
	  	else
	  	{
	  		return false;
	  	}
	}
});


$('#chkall').click(function (e) {
        $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
});

///////////////////// update publish /////////////////////////////////
function UpdatePublish(folder,tablename,fieldname,value,id){
	swal({
      title: "Are you sure?",
      text: "You want to action this record ?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      cancelButtonText: "No",
      confirmButtonText: "Yes",
    }).then((result) => {
      if (result.value) {
        $.ajax({
		type: "GET",
		dataType: 'json',
		cache: false,
		url: folder+"/UpdatePublish",
		data: { tablename: tablename,
			fieldname: fieldname,
			value: value,
			id: id },

			success: function(data){
                //location.reload();
                
                if(value == 'Y')
                {
                	var value1 = 'N';
                }
                else
                {
                	var value1 = 'Y';
                }
                if($('#tick-'+id).attr('src') == sitepath + 'public/assets/images/site_imges/tick.png')
                {
                	$('#tick-'+id).attr('src' , sitepath +'public/assets/images/site_imges/tick_cross.png');
                }
                else
                {
                	$('#tick-'+id).attr('src' , sitepath +'public/assets/images/site_imges/tick.png');
                }
                
                $('#tick-'+id).attr('onclick' , "UpdatePublish('"+folder+"','"+tablename+"','"+fieldname+"','"+value1+"','"+id+"')");
            }
        });
            //$(location).attr('href','<?php //echo base_url() ?>album/deleteimges/'+id);
          }
        })
	}

/////// check all row ///////////
//	$('#chkall_agt').click(function(e) {
//		$(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
//	});


/////////////////////// delete multiple ///////////////////////////////////////	