$(document).ready(function() {
    var iCnt = 0;
    // CREATE A "DIV" ELEMENT AND DESIGN IT USING jQuery ".css()" CLASS.
    $('#btAdd').click(function() {
        iCnt = iCnt + 1;
        var heading = iCnt + 1 ;
            // ADD TEXTBOX.
            var tr = '<div class="form-group"><h5>'+heading+' Child</h5></div>';
            tr += '<div class="form-group row"><label class="control-label col-md-1">Name<span class="mandatory">*</span></label>';
            tr += '<div class="col-md-3"><input type="text" class="form-control" name="var_name[]" id="var_name'+iCnt+'" required></div>';
            tr += '<label class="control-label ">Blood Group</label>';
            tr += '<div class="col-md-3"><select class="form-control" name="var_blood_group[]" id="var_blood_group'+iCnt+
            '"><option selected="" disabled="">--- Select Blood Group ---</option><option value="O+">O+</option><option value="A+">A+</option><option value="B+">B+</option><option value="AB+">AB+</option><option value="O-">O-</option><option value="A-">A-</option><option value="B-">B-</option><option value="AB-">AB-</option></select></div>';
            tr += '<label class="control-label ">DOB</label>';
            tr += '<div class="col-md-3"><input type="text" class="form-control dt_bod_child" name="dt_bod[]" id="dt_bod'+iCnt+'"></div></div>';
            tr += '<div class="form-group row"><label class="control-label col-md-1">Age<span class="mandatory">*</span></label>';
            tr += '<div class="col-md-3"><input type="text" class="form-control" name="var_age[]" id="var_age'+iCnt+'" oninput="numberOnly(this.id);" maxlength="3" required></div>';
            tr += '<label class="control-label col-md-1">Gender</label>';
            tr += '<div class="col-md-5"><input type="radio" name="var_gender['+iCnt+']" id="var_genderM'+iCnt+
            '" value="Male" checked=""> Male<input type="radio" name="var_gender['+iCnt+']" id="var_genderF'+iCnt+'" value="Female"> Female</div></div>';

            tr += '<div class="form-group row"><label class="control-label col-md-3">Name of the school/college</label>';
            tr += '<div class="col-md-8"><input type="text" class="form-control" name="var_school_name[]" id="var_school_name'+iCnt+'"></div></div>';

            tr += '<div class="form-group row"><label class="control-label col-md-3">Interests/Hobbies/Extra Curriculum</label>';
            tr += '<div class="col-md-8"><input type="text" class="form-control" name="var_hobbies[]" id="var_hobbies'+iCnt+'"></div></div>';

            tr += '<div class="form-group row"><label class="control-label col-md-3">Specific Allergy(If any)</label>';
            tr += '<div class="col-md-8"><input type="text" class="form-control" name="var_allergy[]" id="var_allergy'+iCnt+'"></div></div>';
            tr += '<div class="form-group row"><label class="control-label col-md-3">Profile Image</label>';
            tr += '<div class="col-md-8"><input type="file" class="form-control" name="image[]" id="image'+iCnt+'"></div></div></br><hr></br>';

            // ADD BOTH THE DIV ELEMENTS TO THE "main" CONTAINER.
            $('#add_child').append(tr);
        });

    // REMOVE ONE ELEMENT PER CLICK.
    $('#btRemove').click(function() {
        if (iCnt != 0) { $('#tb' + iCnt).remove(); iCnt = iCnt - 1; }

        if (iCnt == 0) { 
            $(container)
            .empty() 
            .remove(); 

            $('#btSubmit').remove(); 
            $('#btAdd')
            .removeAttr('disabled') 
            .attr('class', 'bt');
        }
    });
});
// $(document).ready(function () {
//     $(".dt_bod_edit").datepicker({
//         dateFormat: "dd/mm/yy",
//         changeMonth: true, 
//         changeYear: true,
//     });
// });    
$('body').on('focus',".dt_bod_child", function(){
	$(this).datepicker({
	        dateFormat: "dd/mm/yy",
	        changeMonth: true, 
	        changeYear: true,
            endDate: "today",
            maxDate: "today",
            yearRange: "-100:+0",
        }).attr('readonly', 'readonly');
});

    $('#hide_reference').click(function() {
         $('li#disableBusiness').removeAttr('id');
    });

    $('#btn_skip_reference').click(function() {
         $('li#disableBusiness').removeAttr('id');
    });

    $('#skip_child_btn').click(function() {
         $('li#disableChildern').removeClass('disableChildern');
    });

    $('#btn_family_skip').click(function() {
         $('li.disbleFamily').removeClass('disbleFamily');
    });


 $(function () {
        $("input[name='var_member_types']").click(function () {

            if ($("#var_member_types13").is(":checked")) {
                $("#getMemberType").val('single_membership');
                $("#family_tab").hide();
                //$("#tab5").hide();

                $("#children_tab").hide();
               	// $("#tab6").hide();
               // $("#btn_reference").css("display", "none");
                // $("#btn_skip").css("display", "none");
                $("#hide_reference").css("display", "none");
                $("#btn_skip_reference").css("display", "block");

                $("#hide_save_reference").css("display", "block");
                $("#btn_save_reference").css("display", "none");
            } else {
                $("#family_tab").show();
                //$("#tab5").show();

                $("#children_tab").show();
                $("#hide_reference").css("display", "block");
                $("#btn_skip_reference").css("display", "none");

                $("#hide_save_reference").css("display", "none");
                $("#btn_save_reference").css("display", "block");
                //$("#tab6").show();
                // $("#btn_skip").css("display", "block");
                // $("#btn_reference").css("display", "block");
                // $("#hide_reference").css("display", "none");
                // $("#btn_skip_redirect").css("display", "none");
            }
        });
    });
//////////////////////Add bank button Hide show ////////////////////
$(document).ready(function() {
    $(".add_child").hide();
    $("#add_btn").click(function() {
        $(".add_child").toggle()
    });
});

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

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
        submitMSG_client(true, "Member Details Submitted Successfully.");
    }

    //$("#basicinfofrm").validator().on("submit", function (event) {
        $("form#member_infofrm").submit(function() {
        //  $('#client_infobtn').attr('disabled', true);
        $(".loading").show();
        var formData = new FormData($(this)[0]);

        if (formData == '') {
            formError_career();
            submitMSG_client(false, "Please fill all details");
            //   $('#client_infobtn').attr('disabled', false);
        } else {
            $.ajax({
                url: site_path + "admin/member/insert_memberinfo",
                type: 'POST',
                data: formData,
                async: false,
                success: function(response) {

                    //alert(response)
                    $(".loading").hide();
                    if (response == 'email') {
                    	var msg = 'This Email ID already exists !';
                        var msgClasses = "h3 text-center text-danger";
                        $("#msgSubmit_Error").removeClass().addClass(msgClasses).text(msg);
                        //window.location.reload();
                        
                    } else if(response == 'mobile'){
                    	var msg = 'This Mobile No. already exists !';
                        var msgClasses = "h3 text-center text-danger";
                        $("#msgSubmit_Error").removeClass().addClass(msgClasses).text(msg);

                    } else if(response == 'membership_id'){
                        var msg = 'This Membership ID already exists !';
                        var msgClasses = "h3 text-center text-danger";
                        $("#msgSubmit_Error").removeClass().addClass(msgClasses).text(msg);

                    } else {
                        $('li#disableMemberType').removeAttr('id');
                        $('li.memberType').addClass(" active");
                        $('li.personal_detail').removeClass("active");
                        $('div#tab1').removeClass('active');
                        $('div#tab2').addClass('active');
                    	$('.store_member').val(response);
                        formSuccess_client();
                        //$("#forgetFrm")[0].reset();
                       
                        //$('#member_infofrm')[0].reset();
                        // $('#client_infobtn').attr('disabled', false);
                    }
                },

                cache: false,
                contentType: false,
                processData: false

            });
            return false;
        }
    });

        /*---------------------------------- Business Details --------------------------------*/
        function submitMSG_business(valid, msg) {
            if (valid) {
                var msgClasses = "h3 text-center tada animated text-success";
            } else {
                var msgClasses = "h3 text-center text-danger";
            }
            $("#msgSubmit_Error").removeClass().addClass(msgClasses).text(msg);
        }

        function formSuccess_business() {
            // $("#business_details")[0].reset();
            submitMSG_business(true, "Business Details Submitted Successfully......");
        }

        //$("#basicinfofrm").validator().on("submit", function (event) {
        $("form#business_details").submit(function() {
        //$('#pan_infobtn').attr('disabled', true);
        var formData = new FormData($(this)[0]);

        if (formData == '') {
            formError_career();
            submitMSG_business(false, "Please fill all details");
            //  $('#pan_infobtn').attr('disabled', false);
        } else {
            $.ajax({
                url: site_path + "admin/member/insert_business_details",
                type: 'POST',
                data: formData,
                async: false,
                success: function(response) {
                    if (response == 1) {
                        //window.location.reload();
                        formSuccess_business();
                        $('li#disableReference').removeAttr('id');
                        $('li.reference_type').addClass(" active");
                        $('li.business_type').removeClass("active");
                        $('div#tab3').removeClass('active');
                        $('div#tab4').addClass('active');
                    } else {
                        //$("#forgetFrm")[0].reset();
                        var msg = response;
                        var msgClasses = "h3 text-center text-danger";
                        $("#msgSubmit_Error").removeClass().addClass(msgClasses).text(msg);

                        //      $('#pan_infobtn').attr('disabled', false);
                    }
                },

                cache: false,
                contentType: false,
                processData: false
            });
            return false;
        }
    });

            /*--------------------------- family_details ---------------------------*/
            function submitMSG_family(valid, msg) {
                if (valid) {
                    var msgClasses = "h3 text-center tada animated text-success";
                } else {
                    var msgClasses = "h3 text-center text-danger";
                }

                $("#msgSubmit_Error").removeClass().addClass(msgClasses).text(msg);

            }

            function formSuccess_family() {
        // $("#family_details")[0].reset();
        submitMSG_family(true, "Family Details Submitted Successfully.");
    }

    $("form#family_details").submit(function() {
        //$('#insert_depositoryinfo').attr('disabled', true);
        var formData = new FormData($(this)[0]);

        if (formData == '') {
            formError_career();
            submitMSG_family(false, "Please fill all details");
            //  $('#insert_depositoryinfo').attr('disabled', false);
        } else {
            $.ajax({

                url: site_path + "admin/member/insert_family_details",
                type: 'POST',
                data: formData,
                async: false,
                success: function(response) {
                    if (response == 1) {
                        //window.location.reload();
                        $('li.disbleFamily').removeClass('disbleFamily');
                        $('li.children_type').addClass(" active");
                        $('li.family_type').removeClass("active");
                        $('div#tab5').removeClass('active');
                        $('div#tab6').addClass('active');
                        formSuccess_family();
                    } else {
                        //$("#forgetFrm")[0].reset();
                        var msg = response;
                        var msgClasses = "h3 text-center text-danger";
                        //  $('#insert_depositoryinfo').attr('disabled', false);
                    }
                },

                cache: false,
                contentType: false,
                processData: false
            });

            return false;
        }
    });

    /*--------------------------- reference details ---------------------------*/
    function submitMSG_reference(valid, msg) {
        if (valid) {
            var msgClasses = "h3 text-center tada animated text-success";
        } else {
            var msgClasses = "h3 text-center text-danger";
        }

        $("#msgSubmit_Error").removeClass().addClass(msgClasses).text(msg);

    }

    function formSuccess_reference() {
        // $("#reference_detail")[0].reset();
        submitMSG_reference(true, "Reference Details Submitted Successfully.");
    }

    $("form#reference_detail").submit(function() {
        //$('#insert_depositoryinfo').attr('disabled', true);
        var formData = new FormData($(this)[0]);

        if (formData == '') {
            formError_career();
            submitMSG_reference(false, "Please fill all details");
            //  $('#insert_depositoryinfo').attr('disabled', false);
        } else {
            $.ajax({

                url: site_path + "admin/member/insert_reference_detail",
                type: 'POST',
                data: formData,
                async: false,
                success: function(response) {
                    if (response == 1) {
                        //window.location.reload();
                        formSuccess_reference();
                        if ($('#getMemberType').val() == 'single_membership') {
                            $('li.disableUploads').removeClass('disableUploads');
                            $('li.upload_type').addClass(" active");
                            $('li.reference_type').removeClass("active");
                            $('div#tab4').removeClass('active');
                            $('div#tab7').addClass('active');
                        } else {
                            $('li.disbleFamily').removeClass('disbleFamily');
                            $('li.family_type').addClass(" active");
                            $('li.reference_type').removeClass("active");
                            $('div#tab4').removeClass('active');
                            $('div#tab5').addClass('active');
                        }
                    } else {
                        //$("#forgetFrm")[0].reset();
                        var msg = response;
                        var msgClasses = "h3 text-center text-danger";
                        $("#msgSubmit_Error").removeClass().addClass(msgClasses).text(msg);
                       
                        //  $('#insert_depositoryinfo').attr('disabled', false);
                    }
                },

                cache: false,
                contentType: false,
                processData: false
            });

            return false;
        }
    });

    /*--------------------------- children details ---------------------------*/
    function submitMSG_children(valid, msg) {
        if (valid) {
            var msgClasses = "h3 text-center tada animated text-success";
        } else {
            var msgClasses = "h3 text-center text-danger";
        }

        $("#msgSubmit_Error").removeClass().addClass(msgClasses).text(msg);

    }

    function formSuccess_children() {
        // $("#child_details")[0].reset();
        submitMSG_children(true, "Children Details Submitted Successfully.");
    }

    $("form#child_details").submit(function() {
        //$('#insert_depositoryinfo').attr('disabled', true);
        var formData = new FormData($(this)[0]);

        if (formData == '') {
            formError_career();
            submitMSG_children(false, "Please fill all details");
            //  $('#insert_depositoryinfo').attr('disabled', false);
        } else {
            $.ajax({

                url: site_path + "admin/member/insert_children_details",
                type: 'POST',
                data: formData,
                async: false,
                success: function(response) {
                    if (response == 1) {
                        //window.location.reload();
                        //window.location.href = site_path+'admin/member/';
                        $('li.children_type').removeClass('children_type');
                        $('li.upload_type').addClass(" active");
                        $('li.children_type').removeClass("active");
                        $('div#tab6').removeClass('active');
                        $('div#tab7').addClass('active');
                        formSuccess_children();
                    } else {
                        //$("#forgetFrm")[0].reset();
                        var msg = response;
                        var msgClasses = "h3 text-center text-danger";
                        $("#msgSubmit_Error").removeClass().addClass(msgClasses).text(msg);
                         //window.location.href = site_path+'admin/member/';
                        //  $('#insert_depositoryinfo').attr('disabled', false);
                    }
                },

                cache: false,
                contentType: false,
                processData: false
            });

            return false;
        }
    });

    /*--------------------------- member types details ---------------------------*/
    function submitMSG_membertype(valid, msg) {
        if (valid) {
            var msgClasses = "h3 text-center tada animated text-success";
        } else {
            var msgClasses = "h3 text-center text-danger";
        }

        $("#msgSubmit_Error").removeClass().addClass(msgClasses).text(msg);

    }

    function formSuccess_membertype() {
        // $("#member_types")[0].reset();
        submitMSG_membertype(true, "Member Types Details Submitted Successfully.");
    }

    $("form#member_types").submit(function() {
        //$('#insert_depositoryinfo').attr('disabled', true);

        var formData = new FormData($(this)[0]);

        if (formData == '') {
            formError_career();
            submitMSG_membertype(false, "Please fill all details");
            //  $('#insert_depositoryinfo').attr('disabled', false);
        } else {
            $.ajax({

                url: site_path + "admin/member/insert_member_type",
                type: 'POST',
                data: formData,
                async: false,
                success: function(response) {
                	// alert(response)
                    if (response == 1) {
                        //window.location.reload();
                        formSuccess_membertype();
                        $('li#disableBusiness').removeAttr('id');
                        $('li.business_type').addClass(" active");
                        $('li.memberType').removeClass("active");
                        $('div#tab2').removeClass('active');
                        $('div#tab3').addClass('active');
                    } else {
                        //$("#forgetFrm")[0].reset();
                        var msg = response;
                        var msgClasses = "h3 text-center text-danger";
                        $("#msgSubmit_Error").removeClass().addClass(msgClasses).text(msg);

                        //  $('#insert_depositoryinfo').attr('disabled', false);
                    }
                },

                cache: false,
                contentType: false,
                processData: false
            });

            return false;
        }
    });

    /*--------------------------- documents details ---------------------------*/
    function submitMSG_documents(valid, msg) {
        if (valid) {
            var msgClasses = "h3 text-center tada animated text-success";
        } else {
            var msgClasses = "h3 text-center text-danger";
        }

        $("#msgSubmit_Error").removeClass().addClass(msgClasses).text(msg);

    }

    function formSuccess_document() {
        // $("#upload_documents")[0].reset();
        submitMSG_documents(true, "Documents Submitted Successfully.");
    }

    $("form#upload_documents").submit(function() {
        //$('#insert_depositoryinfo').attr('disabled', true);
        var formData = new FormData($(this)[0]);

        if (formData == '') {
            formError_career();
            submitMSG_documents(false, "Please fill all details");
            //  $('#insert_depositoryinfo').attr('disabled', false);
        } else {
            $.ajax({

                url: site_path + "admin/member/insert_document_details",
                type: 'POST',
                data: formData,
                async: false,
                success: function(response) {
                    if (response == 1) {
                        //window.location.reload();
                        window.location.href = site_path+'admin/member/';
                        formSuccess_document();
                    } else {
                        //$("#forgetFrm")[0].reset();
                        var msg = response;
                        var msgClasses = "h3 text-center text-danger";
                        $("#msgSubmit_Error").removeClass().addClass(msgClasses).text(msg);
                         //window.location.href = site_path+'admin/member/';
                        //  $('#insert_depositoryinfo').attr('disabled', false);
                    }
                },

                cache: false,
                contentType: false,
                processData: false
            });

            return false;
        }
    });


function numberOnly(id) {
    var element = document.getElementById(id);
    var regex = /[^0-9]/gi;
    element.value = element.value.replace(regex, "");
}

// $(document).ready(function(){
//   $("#hide_reference").click(function(){
//     window.location.href = site_path+'admin/member/';
//   });
// });
// $(document).ready(function(){
//   $("#btn_skip_redirect").click(function(){
//     window.location.href = site_path+'admin/member/';
//   });
// });

$(document).ready(function(){
  $("#btn_document_skip").click(function(){
    window.location.href = site_path+'admin/member/';
  });
});
$(document).ready(function(){
  $("#btn_skip_reference").click(function(){
    $('li#family_tab').removeClass("active");
    $('#upload_docs').addClass("active");
    $('div#tab5').removeClass(" active");
    $('div#tab7').addClass(" active");
  });
});

$(document).ready(function(){
  $("#hide_save_reference").click(function(){
    $('li#family_tab').removeClass("active");
    $('#upload_docs').addClass("active");
    $('div#tab5').removeClass(" active");
    $('div#tab7').addClass(" active");
  });
});