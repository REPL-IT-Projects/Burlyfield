<div id="main-wrapper">
  <div class="page-wrapper">
    <div class="page-breadcrumb">
     <div class="row">
      <div class="col-5 align-self-center">
        <h4 class="page-title">Vendors</h4>
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/vendor">View Vendors</a></li>
              <li class="breadcrumb-item active" aria-current="page">Add Vendor</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <?php echo validation_errors(); ?>
  <?php if($this->session->flashdata('Invalid') != ''){ ?>
    <div class="alert alert-danger hide_msg">
      <p><?php echo $this->session->flashdata('Invalid');?></p>
    </div>
  <?php } ?>
  <div class="container-fluid">
   <div class="row">
    <div class="col-12">
      <div class="card card-body">
        <form action="<?php echo base_url() ?>admin/vendor/insert_record" method="POST" class="form-horizontal" enctype='multipart/form-data'>
          <div class="card-body">
            <div class="form-group row">
              <label for="var_name" class="col-sm-3 text-right control-label col-form-label">Name<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="var_name" name="var_name" placeholder="Name Here" required="">
              </div>
            </div>
            <div class="form-group row">
              <label for="var_username" class="col-sm-3 text-right control-label col-form-label">Username</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="var_username" name="var_username" placeholder="Username Here">
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-sm-3 text-right control-label col-form-label">Email<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Here" required="">
              </div>
            </div>
            <div class="form-group row">
              <label for="password" class="col-sm-3 text-right control-label col-form-label">Password<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password Here" required="">
                <span id="message"></span>
              </div>
            </div>
            <div class="form-group row">
              <label for="phone" class="col-sm-3 text-right control-label col-form-label">Mobile No.<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="phone" name="phone" onkeypress="return isNumberKey(event);" minlength="10" maxlength="10" placeholder="Mobile No. here" required="">
              </div>
            </div>
            <div class="form-group row">
              <label for="alt_phone" class="col-sm-3 text-right control-label col-form-label">Alt Mobile No.</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="alt_phone" name="alt_phone" onkeypress="return isNumberKey(event);" minlength="10" maxlength="10" placeholder="Alt Mobile No. here">
              </div>
            </div>
            <div class="form-group row">
              <label for="var_image" class="col-sm-3 text-right control-label col-form-label">Profile Image</label>
              <div class="col-sm-7">
                <input type="file" class="form-control" id="var_image" name="var_image">
              </div>
            </div>
            <div class="form-group row">
              <label for="get_location" class="col-sm-3 text-right control-label col-form-label"></label>
              <div class="col-sm-7">
                <button type="button" class="btn btn-warning" id="getLocation">Get Location</button>
              </div>
            </div>
            <div class="form-group row">
              <label for="var_address" class="col-sm-3 text-right control-label col-form-label">Address<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                <textarea id="var_address" class="form-control" name="var_address" required=""></textarea>
              </div>
            </div>
            <div class="form-group row">
              <label for="var_latitude" class="col-sm-3 text-right control-label col-form-label">Latitude</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="var_latitude" name="var_latitude" placeholder="Latitude Here">
              </div>
            </div>
            <div class="form-group row">
              <label for="var_longitude" class="col-sm-3 text-right control-label col-form-label">Longitude </label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="var_longitude" name="var_longitude" placeholder="Longitude  Here">
              </div>
            </div>
            <div class="form-group row">
                <label for="var_image" class="col-sm-3 text-right control-label col-form-label">Documents</label>
                <div class="col-sm-7">
                    <a class="btn btn-success" id="addFile"> + add document</a>
                    <div id="filesContainer"></div>
                </div>
            </div>
            <div class="form-group row">
              <label for="type" class="col-sm-3 text-right control-label">Membership Type:</label>
              <div class="col-sm-7">
                <div class="form-check form-check-inline">
                  <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="free" value="Free" name="membership_type" checked="">
                    <label class="custom-control-label" for="free">Free</label>
                  </div>
                </div>
                <div class="form-check form-check-inline">
                  <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="paid" value="Paid" name="membership_type">
                    <label class="custom-control-label" for="paid">Paid</label>
                  </div>
                </div>
                <div class="form-check form-check-inline">
                  <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="commission" value="Commission" name="membership_type">
                    <label class="custom-control-label" for="commission">Commission</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group row" id="hide_commission_div">
              <label for="var_latitude" class="col-sm-3 text-right control-label col-form-label">Commission Value</label>
              <div class="col-sm-7">
                  <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="Please enter value of commission" aria-label="commission" aria-describedby="basic-addon1" name="var_commission_value" id="var_commission_value" onkeypress="return isNumberKey(event);">
                      <div class="input-group-append">
                          <span class="input-group-text"><i class="fas fa-percent"></i></span>
                      </div>
                  </div>
              </div>
            </div>
            <div id="memship_duration">
              <div class="form-group row">
                <label for="dt_startdate" class="col-sm-3 text-right control-label col-form-label">Start Date<span class="mandatory">*</span></label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="dt_startdate" id="dt_startdate">
                </div>
              </div>
              <div class="form-group row">
                <label for="dt_enddate" class="col-sm-3 text-right control-label col-form-label">
                End Date<span class="mandatory">*</span></label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="dt_enddate" id="dt_enddate">
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="card-body">
            <div class="form-group mb-0 text-center">
              <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
              <button type="reset" name="cancel" class="btn btn-dark waves-effect waves-light">Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>          
</div>
</div>
</div>
<script type="text/javascript">
  var site_path = '<?php echo base_url(); ?>';
$('#hide_commission_div').hide();    
$(function(){
  $('button[name=cancel]').click(function(){
    window.location = site_path+'admin/vendor';
  });
});

$(document).ready(function() {
    $("input[name$='membership_type']").click(function() {
        var type_val = $(this).val();
        if (type_val == 'Commission') {
          $('#hide_commission_div').show();
        } else {
          $('#hide_commission_div').hide();
        }
    });
});
</script>
<script type="text/javascript">
  $(function() {
    $("#dt_startdate").datepicker({
      dateFormat: 'dd/mm/yy',
      changeMonth: true,
      changeYear: true,
      //maxDate: '0',
      onClose: function( selectedDate ) {
        $( "#dt_enddate" ).datepicker( "option", "minDate", selectedDate );
      }
    });

    $("#dt_enddate").datepicker({
      dateFormat: 'dd/mm/yy',
      changeMonth: true,
      changeYear: true,
      //maxDate: '0',
      onClose: function( selectedDate ) {
        $( "#dt_startdate" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
  var dId1 = 0;

$('#addFile').click(function() {
  $('#addFile').addClass('disabled');
  dId1++;
  $('#filesContainer').append(
    $('<input type="file" class="hide_img_tag" name="img_document[]" multiple="" id="doc_count_'+dId1+'">')
    );

  if (window.File && window.FileList && window.FileReader) {
    $("#doc_count_"+dId1).on("change", function(e) {
      var rem_input = "#doc_count_"+dId1;
      var files = e.target.files,
      filesLength = files.length;

      for (var i = 0; i < filesLength; i++) {
        var ext = files[i].name.substr(-4);
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          if ((ext == '.jpg') || (ext == '.png') || (ext == 'jpeg') || (ext == '.gif')) {
          $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove image</span>" +
            "</span>").insertAfter("#doc_count_"+dId1);
          } else {
            $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + site_path+'public/assets/images/site_imges/file_uploaded.png' + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove image</span>" +
            "</span>").insertAfter("#doc_count_"+dId1);
          }
          $("#doc_count_"+dId1).css("display", "none");
          $('#addFile').removeClass('disabled');

          $(".remove").click(function(){
            $(this).parent(".pip").remove(); 
            $(rem_input).remove(); 
          });
        });
        fileReader.readAsDataURL(f);
      }
    });
    //$("#doc_count_"+dId1).css("display", "none");
  } else {
    alert("Your browser doesn't support to File API")
  }
});
});
</script>
<script type="text/javascript">
$(document).ready(function(){
  $("#getLocation").click(function(){
    showPosition();
  });
});

  function showPosition(){
        navigator.geolocation.getCurrentPosition(function(position){
            var lat = position.coords.latitude;
            var long = position.coords.longitude;
   
          $.get( "https://maps.googleapis.com/maps/api/geocode/json?latlng="+ lat + "," + long +"&location_type=ROOFTOP&key=AIzaSyB-C0OZhzDLjWdpc-iFCZqd2YNX_1eu6_A", function(data) {
             console.log(data);
             var response = data.results[0].formatted_address;

             document.getElementById('var_address').value = response;
             document.getElementById('var_latitude').value = lat;
             document.getElementById('var_longitude').value = long;
          });

        });
}
</script>