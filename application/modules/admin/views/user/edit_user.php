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
                            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form method="POST" action="<?php echo base_url().'admin/user/update_user/'.$data['int_glcode']; ?>" class="form-horizontal" enctype='multipart/form-data'>
                    <div class="card-body">
                      <div class="form-group row">
                        <label for="var_name" class="col-sm-3 text-right control-label col-form-label">Name<span class="mandatory">*</span></label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="var_name" name="var_name" placeholder="Name Here" value="<?php echo $data['var_name']; ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 text-right control-label col-form-label">Email</label>
                        <div class="col-sm-7">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Here" value="<?php echo $data['var_email']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 text-right control-label col-form-label">Password<span class="mandatory">*</span></label>
                        <div class="col-sm-7">
                           <div class="icon_show">
                            <input type="password" class="form-control" id="var_password" name="var_password" placeholder="Password Here" value="<?php echo $this->mylibrary->decryptPass($data['var_password']); ?>" required="">
                            <a href="javascript:void(0)" class="show_password" onclick="toggle_password()"><i class="mr-2 mdi mdi-eye-outline show_pass"></i></a>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="date" class="col-sm-3 text-right control-label col-form-label">Mobile No.</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="phone" onkeypress="return isNumberKey(event);" name="phone" value="<?php echo $data['var_mobile_no']; ?>" readonly>
                    </div>
                </div>
        <div class="form-group row">
            <label for="var_image" class="col-sm-3 text-right control-label col-form-label">Profile Image</label>
            <?php
            if ($data['var_image'] != '') {
                $Image = base_url().'uploads/user/'.$data['var_image'];
            } else{
                $Image = base_url().'public/assets/images/site_imges/no_image.png';
            }
            ?>
            <div class="col-sm-7">
                <input type="file" class="form-control" id="var_image" name="var_image">
            </div>
            <a class="example-image-link" href="<?php echo $Image; ?>" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src="<?php echo $Image; ?>" id="cate_ig" alt="<?php echo $Image; ?>" /></a>
            <input type="hidden" name="hidvar_image" value="<?php echo $data['var_image']; ?>">
        </div>
        <hr>
            <div class="form-group row">
              <div class="col-sm-3">
                <button type="button" class="btn btn-success" id="btn_address"> + Add Address</button>
              </div>
            </div>
            <div id="add_address"></div>
        <hr>
        <?php 
        if (count($address) > 0) {
            $count = 0;
            $iCount = 1;
            foreach ($address as $key => $value) {
                $radio_count = $count++;
            ?>
            <input type="hidden" name="fk_address[]" value="<?php echo $value['int_glcode']; ?>">
               <div class="form-group row" id="remove_image<?php echo $value['int_glcode']; ?>">
                <div class="col-sm-8"><h5>Address <?php echo $iCount++; ?></h5></div>
                    <div class="col-sm-4">
                        <div class="remove_add">
                            <a href="javascript:;" class="btnRemove" onclick="confirmDelete('<?php echo $value['int_glcode']; ?>')"><img id="img" class="closeicondrag" src="<?php echo base_url(); ?>public/assets/images/site_imges/x.png" alt="delete"></a>
                        </div>
                    </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="var_house_no[]" placeholder="House No." value="<?php echo $value['var_house_no']; ?>" required>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="var_app_name[]" placeholder="Apartment Name" value="<?php echo $value['var_app_name']; ?>" required>
                    </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="var_landmark[]" placeholder="Landmark Here" value="<?php echo $value['var_landmark']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="var_country[]" placeholder="Country" value="<?php echo $value['var_country']; ?>">
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="var_state[]" placeholder="State" value="<?php echo $value['var_state']; ?>">
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="var_city[]"   placeholder="City" value="<?php echo $value['var_city']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4">
                    <input type="text" class="form-control" onkeypress="return isNumberKey(event);" name="var_pincode[]" placeholder="Pincode" value="<?php echo $value['var_pincode']; ?>">
                </div>
                <label for="type" class="col-sm-1 text-right control-label">Type:</label>
                <div class="col-sm-3">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="home<?php echo $value['int_glcode']; ?>" value="Home" name="address_type[<?php echo $radio_count; ?>]" <?php if ($value['chr_type'] == 'Home') { echo "checked";} ?>>
                            <label class="custom-control-label" for="home<?php echo $value['int_glcode']; ?>">Home</label></div>
                        </div>
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="work<?php echo $value['int_glcode']; ?>" value="Work" name="address_type[<?php echo $radio_count; ?>]" <?php if ($value['chr_type'] == 'Work') { echo "checked";} ?>>
                                <label class="custom-control-label" for="work<?php echo $value['int_glcode']; ?>">Work</label>
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="other<?php echo $value['int_glcode']; ?>" value="Other" name="address_type[<?php echo $radio_count; ?>]" <?php if ($value['chr_type'] == 'Other') { echo "checked";} ?>>
                                <label class="custom-control-label" for="other<?php echo $value['int_glcode']; ?>">Other</label>
                            </div>
                        </div>
                    </div>
                    <label for="type" class="col-sm-2 text-left control-label">Set Default:</label><div class="col-sm-2 text-left"><input type="checkbox" class="form-control check_default" name="var_default_status[]" value="Y" <?php if ($value['default_status'] == 'Y') { echo "checked";} ?>></div></div>
                    <input type="hidden" name="var_default_status[]" value="N">
                    <hr>
                </div>
        <?php } } ?>
    </div>
            <div class="card-body">
                <div class="form-group mb-0 text-center">
                    <button type="submit" name="submit" class="btn btn-info waves-effect waves-light">Save</button>
                    <button type="reset" name="cancel" class="btn btn-dark waves-effect waves-light">Cancel</button>
                </div>
            </div>
        </form>
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

function toggle_password() {
	var x = document.getElementById("var_password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

</script>
<script type="text/javascript">
  function confirmDelete(id)
  {
    swal({
      title: "Are you sure?",
      text: "You want to delete this address ?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      cancelButtonText: "No",
      confirmButtonText: "Yes",
      closeOnConfirm: false
    }).then((result) => {
      if (result.value) {
        $.ajax(
        {
          url: site_path + "admin/user/deleteAddress",
          method: 'POST',
          data:
          {
            id: id
          },
          success: function (result)
          {
              //$("div#removeimages"+id).remove();
              $('div#remove_image' + id + '').remove();
            }
          });
            //$(location).attr('href','<?php //echo base_url() ?>album/deleteimges/'+id);
          }
        })
    }
</script>
<script type="text/javascript">
$(document).ready(function() {
    var iCnt = 0;
    // CREATE A "DIV" ELEMENT AND DESIGN IT USING jQuery ".css()" CLASS.
    $('#btn_address').click(function() {
        iCnt = iCnt + 1;
            // ADD TEXTBOX.
            var tr = '<div class="con"><div class="form-group row"><div class="col-sm-8"><h5>Address Details</div><div class="col-sm-4"><div class="remove_add"><a href="javascript:;" class="btnRemove"><img id="img" class="closeicondrag" src="'+site_path+'public/assets/images/site_imges/x.png" alt="delete"></a></div></div></div><div class="form-group row"><div class="col-sm-4"><input type="text" class="form-control" name="new_var_house_no[]" placeholder="House No." required></div><div class="col-sm-4"><input type="text" class="form-control" name="new_var_app_name[]" placeholder="Apartment Name" required></div>';
            tr += '<div class="col-sm-4"><input type="text" class="form-control" name="new_var_landmark[]" placeholder="Landmark Here"></div></div>';
            tr += '<div class="form-group row"><div class="col-sm-4"><input type="text" class="form-control" name="new_var_country[]" placeholder="Country"></div>';
            tr += '<div class="col-sm-4"><input type="text" class="form-control" name="new_var_state[]" placeholder="State"></div>';
            tr += '<div class="col-sm-4"><input type="text" class="form-control" name="new_var_city[]" placeholder="City"></div></div>';
            tr += '<div class="form-group row"><div class="col-sm-4"><input type="text" class="form-control" name="new_var_pincode[]" placeholder="Pincode"></div>';
            tr += '<label for="type" class="col-sm-1 text-right control-label">Type:</label><div class="col-sm-3"><div class="form-check form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="home'+iCnt+'" value="Home" name="new_address_type['+iCnt+']" checked=""><label class="custom-control-label" for="home'+iCnt+'">Home</label></div></div><div class="form-check form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="work'+iCnt+'" value="Work" name="new_address_type['+iCnt+']"><label class="custom-control-label" for="work'+iCnt+'">Work</label></div></div><div class="form-check form-check-inline"><div class="custom-control custom-radio"><input type="radio" class="custom-control-input" id="other'+iCnt+'" value="Other" name="new_address_type['+iCnt+']"><label class="custom-control-label" for="other'+iCnt+'">Other</label></div></div></div><label for="type" class="col-sm-2 text-left control-label">Set Default:</label><div class="col-sm-2 text-left"><input type="checkbox" class="form-control check_default" name="default_status[]" value="Y"></div></div><hr></div>';

            // ADD BOTH THE DIV ELEMENTS TO THE "main" CONTAINER.
            $('#add_address').append(tr);
        });
    $('body').on('click','.btnRemove',function() {
      $(this).parent().parent().parent().parent('div.con').remove();
    });
});

$(document).ready(function(){
    $('.check_default').click(function() {
        $('.check_default').not(this).prop('checked', false);
    });
});

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>