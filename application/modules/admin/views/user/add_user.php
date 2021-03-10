<div id="main-wrapper">
  <div class="page-wrapper">
    <div class="page-breadcrumb">
     <div class="row">
      <div class="col-5 align-self-center">
        <h4 class="page-title">Users</h4>
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/user">View Users</a></li>
              <li class="breadcrumb-item active" aria-current="page">Add User</li>
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
        <form action="<?php echo base_url() ?>admin/user/insert_record" method="POST" class="form-horizontal" enctype='multipart/form-data'>
          <div class="card-body">
            <div class="form-group row">
              <label for="var_name" class="col-sm-3 text-right control-label col-form-label">Name<span class="mandatory">*</span></label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="var_name" name="var_name" placeholder="Name Here" required="">
              </div>
            </div>
<!--            <div class="form-group row">
              <label for="var_username" class="col-sm-3 text-right control-label col-form-label">Username</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="var_username" name="var_username" placeholder="Username Here">
              </div>
            </div>-->
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
              <label for="var_image" class="col-sm-3 text-right control-label col-form-label">Profile Image</label>
              <div class="col-sm-7">
                <input type="file" class="form-control" id="var_image" name="var_image">
              </div>
            </div>
            <div class="form-group row">
              <label for="address" class="col-sm-3 text-right control-label col-form-label">Address Details<span class="mandatory">*</span></label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="var_house_no" name="var_house_no" placeholder="House No.">
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="var_app_name" name="var_app_name" placeholder="Apartment Name">
              </div>
            </div>
            <div class="form-group row">
              <label for="address" class="col-sm-3 text-right control-label col-form-label"></label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="var_landmark" name="var_landmark" placeholder="Landmark Here">
              </div>
            </div>
            <div class="form-group row">
              <label for="address" class="col-sm-3 text-right control-label col-form-label"></label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="var_country" name="var_country" placeholder="Country">
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="var_state" name="var_state" placeholder="State">
              </div>
            </div>
            <div class="form-group row">
              <label for="address" class="col-sm-3 text-right control-label col-form-label"></label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="var_city" name="var_city" placeholder="City">
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="var_pincode" onkeypress="return isNumberKey(event);" name="var_pincode" placeholder="Pincode">
              </div>
            </div>
            <hr>
            <div class="form-group row">
              <div class="col-sm-3">
                <button type="button" class="btn btn-success" id="btn_address"> + Add Address</button>
              </div>
            </div>
            <div id="add_address"></div>
          </div>
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
$(function(){
  $('button[name=cancel]').click(function(){
    window.location = site_path+'admin/user';
  });
});

</script>
<script type="text/javascript">
$(document).ready(function() {
    var iCnt = 0;
    // CREATE A "DIV" ELEMENT AND DESIGN IT USING jQuery ".css()" CLASS.
    $('#btn_address').click(function() {
        iCnt = iCnt + 1;
            // ADD TEXTBOX.
            var tr = '<div class="con"><div class="form-group row"><div class="col-sm-8"><h5>Address '+iCnt+'</div><div class="col-sm-4"><div class="remove_add"><a href="javascript:;" class="btnRemove"><img id="img" class="closeicondrag" src="'+site_path+'public/assets/images/site_imges/x.png" alt="delete"></a></div></div></div><div class="form-group row"><div class="col-sm-4"><input type="text" class="form-control" name="new_var_house_no[]" placeholder="House No." required></div><div class="col-sm-4"><input type="text" class="form-control" name="new_var_app_name[]" placeholder="Apartment Name" required></div>';
            tr += '<div class="col-sm-4"><input type="text" class="form-control" name="new_var_landmark[]" placeholder="Landmark Here"></div></div>';
            tr += '<div class="form-group row"><div class="col-sm-4"><input type="text" class="form-control" name="new_var_country[]" placeholder="Country"></div>';
            tr += '<div class="col-sm-4"><input type="text" class="form-control" name="new_var_state[]" placeholder="State"></div>';
            tr += '<div class="col-sm-4"><input type="text" class="form-control" name="new_var_city[]" placeholder="City"></div></div>';
            tr += '<div class="form-group row"><div class="col-sm-4"><input type="text" class="form-control" name="new_var_pincode[]" placeholder="Pincode"></div>';
            tr += '<label for="type" class="col-sm-1 text-right control-label">Type:</label><div class="col-sm-3"><div class="form-check form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="home'+iCnt+'" value="Home" name="new_address_type['+iCnt+']" checked=""><label class="custom-control-label" for="home'+iCnt+'">Home</label></div></div><div class="form-check form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="work'+iCnt+'" value="Work" name="new_address_type['+iCnt+']"><label class="custom-control-label" for="work'+iCnt+'">Work</label></div></div><div class="form-check form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="other'+iCnt+'" value="Other" name="new_address_type['+iCnt+']"><label class="custom-control-label" for="other'+iCnt+'">Other</label></div></div></div><label for="type" class="col-sm-2 text-left control-label">Set Default:</label><div class="col-sm-2 text-left"><input type="checkbox" class="form-control" name="default_status[]" value="Y"></div></div><hr></div>';

            // ADD BOTH THE DIV ELEMENTS TO THE "main" CONTAINER.
            $('#add_address').append(tr);
        });
    $('body').on('click','.btnRemove',function() {
      $(this).parent().parent().parent().parent('div.con').remove();
    });
    // REMOVE ONE ELEMENT PER CLICK.
    // $('#btRemove').click(function() {
    //     if (iCnt != 0) { $('#tb' + iCnt).remove(); iCnt = iCnt - 1; }

    //     if (iCnt == 0) { 
    //         $(container)
    //         .empty() 
    //         .remove(); 

    //         $('#btSubmit').remove(); 
    //         $('#btAdd')
    //         .removeAttr('disabled') 
    //         .attr('class', 'bt');
    //     }
    // });
});
function onlyOne(checkbox) {
    var checkboxes = document.getElementsByName('default_status[]')
    checkboxes.forEach((item) => {
        if (item !== checkbox) item.checked = false
    })
} 

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>