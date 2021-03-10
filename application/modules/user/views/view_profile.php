<!-- <section class="breadcrumb-area" style="background-image:url(<?php echo base_url();?>public/front_assets/images/background/2.jpg);">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="breadcrumbs text-center">
               <h1>My Profile</h1>
               <h4>Welcome to certified Gramango</h4>
            </div>
         </div>
      </div>
   </div>
   <div class="breadcrumb-bottom-area">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 col-md-5 col-sm-5">
               <ul>
                  <li><a href="<?php echo base_url();?>">Home</a></li>
                  <li><a href=""><i class="fa fa-angle-right"></i></a></li>
                  <li>My Profile</li>
               </ul>
            </div>
            <div class="col-lg-4 col-md-7 col-sm-7">
               <p>We provide <span>100% organic</span> products</p>
            </div>
         </div>
      </div>
   </div>
</section> -->
<section class="account-page section-padding-80">
   <div class="container">
   <div class="profile-upload-page">
   <div class="row col-lg-offset-1">
   <div class="col-lg-10 mx-auto">
   <header class="sec-heading mb-30">
      <h3 class="mb-30">
         My Profile
      </h3>
   </header>
   <div class="card card-body account-right">
      <div class="widget">
         <form method="POST" action="<?php echo base_url().'user/update_user/'.$data['int_glcode']; ?>" class="form-horizontal" enctype='multipart/form-data'>
            <div class="user-profile-header">
               <?php
                  if ($data['var_image'] != '') {
                      $Image = base_url().'uploads/user/'.$data['var_image'];
                  } else{
                      $Image = base_url().'public/front_assets/images/profile-header.jpg';
                  }
                  ?>
              <img class="mx-auto" alt="logo" src="<?php echo $Image; ?>" alt="<?php echo $data['var_name']; ?>">
               
                  <input type="file" name="var_image" class="form-control" id="var_image">
                  <input type="hidden" name="hidvar_image" value="<?php echo $data['var_image']; ?>">
                  <input type="hidden" name="hidvar_image" value="<?php echo $data['var_image']; ?>">
                  <h5 class="mb-1"><strong>Hi </strong> <?php echo $data['var_name']; ?></h5>
                  <p>Default Contact No. +91 <?php echo $data['var_default_no']; ?></p>
                  <h6 class="mb-1"><strong>Account Credits : </strong>₹ <?php echo $data['var_wallet']; ?></h6>
              
            </div>
            <div class="margin-left-right-15">
            <div class="row">
               <div class="col-sm-6">
                  <div class="form-group">
                     <label class="control-label">Name <span class="mandatory">*</span></label>
                     <input class="form-control border-form-control" value="<?php echo $data['var_name']; ?>" name="var_name" placeholder="Name" type="text">
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="form-group">
                     <label class="control-label">Mobile No.</label>
                     <input class="form-control border-form-control" value="<?php echo $data['var_mobile_no']; ?>" disabled="" onkeypress="return isNumberKey(event);" max="15" min="10">
                  </div>
               </div>
            </div>
          </div>
            <div class="row">
               <div class="col-sm-6">
                  <div class="form-group">
                     <label class="control-label">Email Address </label>
                     <input class="form-control border-form-control " value="<?php echo $data['var_email']; ?>" placeholder="Email Address" disabled="" type="email">
                  </div>
               </div>
               <div class="col-sm-6 text-right">
               </div>
            </div>
            <div class="row">
               <div class="col-sm-6">
               </div>
               <div class="col-sm-6 text-right">
                  <label class="control-label"> </label>
                  <button class="btn btn-primary form-control-submit mr-2" data-link-action="save-customer" type="submit">
                  Cancel
                  </button>
                  <button name="submit" class="btn btn-primary form-control-submit pull-xs-right" data-link-action="save-customer" type="submit">
                  Save Changes
                  </button>
               </div>
            </div>
         </form>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-10 mx-auto">
         <header class="sec-heading mb-30">
            <h3>
               Add / Update Alternate Contact No.
            </h3>
         </header>
         <div class="card card-body account-right">
            <div class="widget">
               <form method="POST" id="updateAlterNo" action="" class="form-horizontal" enctype='multipart/form-data'>
                  <input type="hidden" name="fk_user_no" id="fk_user_no" value="<?php echo $data['int_glcode']; ?>"> 
                  <div class="row align-center-colom">
                     <div class="col-sm-4">
                        <div class="form-group">
                           <?php 
                              if ($data['var_alt_mobile'] != '') {
                                $alternate_number = $data['var_alt_mobile'];
                                $btn_lable = "Edit Number";
                                $open_model = "updateOtpModal";
                              } else {
                                $alternate_number = '';
                                $btn_lable = "Add Number";
                                $open_model = "otpModal";
                              }
                              ?>
                           <label class="control-label">Alternate Mobile No. <span class="mandatory">*</span></label>
                           <input class="form-control border-form-control" value="<?php echo $alternate_number; ?>" placeholder="Please Enter Alternate Mobile No." type="text" name="var_alt_mobile" id="var_alt_mobile" onkeypress="return isNumberKey(event);" max="15" min="10" required> 
                        </div>
                     </div>
                     <div class="col-sm-4 mt-3">
                        <?php 
                           if($data['var_alt_mobile'] == $data['var_default_no']) { ?>
                        <a class="btn btn-squre btn-primary" onclick="setDefault('<?php echo $data['int_glcode']; ?>','N');">Remove Default</a>
                        <?php } elseif ($data['var_alt_mobile'] != '') { ?>
                        <a class="btn btn-squre btn-primary" onclick="setDefault('<?php echo $data['int_glcode']; ?>','Y');">Set as Default</a>
                        <?php } else { ?>
                        <?php } ?>
                     </div>
                     <div class="col-sm-4 text-right mt-4 pt-2">
                        <label class="control-label"> </label>
                        <button name="submit" class="btn btn-primary form-control-submit pull-xs-right" data-toggle="modal" data-target="#<?php echo $open_model; ?>" type="submit">
                        <?php echo $btn_lable; ?>
                        </button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-10 mx-auto">
         <header class="sec-heading mb-30">
            <h3>
               Wallet
            </h3>
         </header>
         <div class="card card-body account-right">
            <div class="widget">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="form-group">
                        <?php
                           if ($data['var_wallet'] != '') {
                              $data['var_wallet'] = $data['var_wallet'];
                           } else {
                              $data['var_wallet'] = '0.00';
                           }
                           
                           ?>
                        <p>
                           <a href="<?php echo base_url().'orders/wallet_summary/'.base64_encode($data['int_glcode']); ?>">Check Wallet Transaction
                           </a>
                        </p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<div class="modal fade" id="otpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">OTP Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div id="msgSubmit_modal"></div>
            <form method="post" id="user_otp_form" action="javascript:;">
               <input type="hidden" name="fk_user_id" id="fk_user_id" value="<?php echo $data['int_glcode']; ?>"> 
               <input type="hidden" name="alternate_no" id="alternate_no" value="">
               <input type="hidden" name="var_default_sts" id="var_default_sts" value="">
               <div class="form-group row ">
                  <label class="col-md-2 form-control-label required">OTP Number</label>
                  <div class="col-md-7">
                     <input type="text" name="var_otp" id="var_otp" class="form-control" required="" onkeypress="return isNumberKey(event);">
                  </div>
                  <div class="col-md-3 form-control-comment">
                  </div>
               </div>
               <button type="button" class="btn btn-primary" onclick="resend_otp();">Resend</button>
         </div>
         <div class="modal-footer">
         <button type="submit" class="btn btn-primary">Save</button>
         </div>
         </form>
      </div>
   </div>
</div>
<script type="text/javascript">
   var site_path = '<?php echo base_url(); ?>';
   
   function submitMSG_client(valid, msg) {
   
      if (valid) {
          var msgClasses = "h3 text-center tada animated text-success";
      } else {
          var msgClasses = "h3 text-center text-danger";
      }
      $("#msgSubmit_Error").removeClass().addClass(msgClasses).text(msg);
   }
     function formSuccess_client() {
          // $("#member_infofrm")[0].reset();
          submitMSG_client(true, "Contact Details Submitted Successfully.");
     }
     //$("#basicinfofrm").validator().on("submit", function (event) {
   
    $("form#updateAlterNo").submit(function() {
    //  $('#client_infobtn').attr('disabled', true);
      var alternate_no = $('#var_alt_mobile').val();
      $('#alternate_no').val(alternate_no);
   
      if ($("#default_status").is(":checked") ){
       $("#var_default_sts").val('Y');
   } else {
       $("#var_default_sts").val('N');
   }
   
       $(".loading").show();
   
          var formData = new FormData($(this)[0]);
   
              $.ajax({
                  url: site_path + "user/update_contactno",
                  type: 'POST',
                  data: formData,
                  async: false,
                  success: function(response) {
                    //alert(response)
   
                      $(".loading").hide();
                      $("#otpModal").modal('show');
   
                  },
   
                  cache: false,
                  contentType: false,
                  processData: false
   
              });
              return false;
   });
   
   function resend_otp()
   {
    var var_alt_mobile = $('#var_alt_mobile').val();
    var fk_user_no = $('#fk_user_no').val();
    $.ajax({
        url: site_path + "user/update_contactno",
        dataType: 'json',
        type: 'POST',
        data: { fk_user_no: fk_user_no,
          var_alt_mobile: var_alt_mobile },
        async: false,
        success: function(response) {
   
          var msg = 'OTP Send Successfully !';
          var msgClasses = "h3 text-center tada animated text-success";
          $("#msgSubmit_modal").removeClass().addClass(msgClasses).text(msg);
   
          //window.location.href = site_path + 'user';
          },
      });
   }
   
   $("form#user_otp_form").submit(function() {
      var var_otp = $('#var_otp').val();
      // var fk_user = $('#fk_user').val();
      if (var_otp == '') {
        var msg = 'Please enter received OTP !';
        var msgClasses = "h3 text-center tada animated text-danger";
        $("#msgSubmit_modal").removeClass().addClass(msgClasses).text(msg);
      } else {
          var formData = new FormData($(this)[0]);
   
          $.ajax({
              url: site_path + "user/verify_otp",
              type: 'POST',
              data: formData,
              async: false,
              success: function(response) {
                //alert(response)
                  if (response == '') {
                      var msg = 'OTP Not Matched !';
                      var msgClasses = "h3 text-center tada animated text-danger";
                      $("#msgSubmit_modal").removeClass().addClass(msgClasses).text(msg);
                      //window.location.reload();
                      return false;
                  } else {
   
                      window.location.href = site_path + 'user';
                  }
              },
   
              cache: false,
              contentType: false,
              processData: false
          });
      }
   });
   
   function setDefault(userId,flag)
   {
   if (flag == 'Y') {
    var title = 'Set Default';
   } else {
    var title = 'Remove Default';
   }
      swal({
        title: "Are you sure?",
        text: "You want to "+title+" this contact no. ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        cancelButtonText: "No",
        confirmButtonText: "Yes"
      }).then((result) => {
        if (result.value) {
          $.ajax(
          {
            url: site_path + "user/default_contact",
            method: 'POST',
            data:
            {
              userId:userId,flag:flag
            },
            success: function (result)
            {
               window.location.href = site_path+'user';
              }
            });
              //$(location).attr('href','<?php //echo base_url() ?>album/deleteimges/'+id);
            }
          })
      }
</script>