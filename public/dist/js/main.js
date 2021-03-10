$('#checkAll').click(function (e) {

        $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);

    });

$('button[name=btn_delete]').click(function ()



  {

    var modulename = $('#module').val();

   // alert(modulename);

    var id = [];
 $("input[name='ids[]']:checked").each(function (i)

    {

      id[i] = $(this).val();

    });

    if (id.length === 0) //tell you if the array is empty

    {

      alert("Please Select atleast one checkbox");



    } else {



      if (confirm("Are you sure you want to delete records on this page?"))



      {

        //alert(modulename+'mo'+id);

        $.ajax(



        {

          url: sitepath + "admin/"+modulename+"/delete_multiple",

          method: 'POST',

          data:

          {

            id: id

          },



          success: function (result)

          {

                for (var i = 0; i < id.length; i++) {



                  $('tr#' + id[i] + '').css('background-color', '#ccc');



                  $('tr#' + id[i] + '').fadeOut('slow');



                }

            }

        });



      } else {



        return false;



      }



    }



  });





///////////////////// update publish /////////////////////////////////

function UpdatePublish(folder,tablename,fieldname,value,id){



 $.ajax({

  type: "GET",

  dataType: 'json',

  cache: false,

  url: sitepath + "admin/"+folder+"/UpdatePublish",

  data: { tablename: tablename,

   fieldname: fieldname,

   value: value,

   id: id },



   success: function(data){

                //location.reload();

                if(value == 'Y')

                {

                 value = 'N';

                }

                else

                {

                 value = 'Y';

                }

                if($('#tick-'+id).attr('src') == sitepath + 'public/assets/img/site_imges/tick.png')

                {

                 $('#tick-'+id).attr('src' , sitepath +'public/assets/img/site_imges/tick_cross.png');

                }

                else

                {

                 $('#tick-'+id).attr('src' , sitepath +'public/assets/img/site_imges/tick.png');

                }

                $('#tick-'+id).attr('onclick' , "UpdatePublish('"+folder+"','"+tablename+"','"+fieldname+"','"+value+"','"+id+"')");

            }

        });

 }

    $('#chkall').click(function (e) {

        $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);

    });

    

     function isNumberKey(evt) {

        var charCode = (evt.which) ? evt.which : event.keyCode

        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;

        return true;

    }

function cancel(module){

    location.href = sitepath+'admin/'+module;

}


function cancel_restau(module){

    location.href = sitepath+'restaurant/'+module;

}


        