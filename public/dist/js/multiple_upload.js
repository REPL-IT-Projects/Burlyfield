$(document).ready(function() {

  var dId1 = 0;

$('#addFile1').click(function() {
  $('#addFile1').addClass('disabled');
  dId1++;

  $('#filesContainer1').append(

    $('<input type="file" class="hide_img_tag" name="img_document[]" multiple="" id="1doc_count_'+dId1+'"><input type="hidden" name="doc_type[]" value="two_photo">')

    );

  if (window.File && window.FileList && window.FileReader) {

    $("#1doc_count_"+dId1).on("change", function(e) {
      
      var rem_input = "#1doc_count_"+dId1;

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

            "</span>").insertAfter("#1doc_count_"+dId1);

          } else {
            $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + base_url+'public/assets/images/site_imges/file_uploaded.png' + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove image</span>" +
            "</span>").insertAfter("#1doc_count_"+dId1);
          }
          $("#1doc_count_"+dId1).css("display", "none");
          $('#addFile1').removeClass('disabled');
          $(".remove").click(function(){

            $(this).parent(".pip").remove(); 

            $(rem_input).remove(); 

          });

        });

        fileReader.readAsDataURL(f);

      }

    });

    //$("#1doc_count_"+dId1).css("display", "none");

  } else {

    alert("Your browser doesn't support to File API")

  }

});

});



$(document).ready(function() {

  var dId2 = 0;

$('#addFile2').click(function() {
  $('#addFile2').addClass('disabled');
  dId2++;

  $('#filesContainer2').append(

    $('<input type="file" class="hide_img_tag" name="img_document[]" multiple="" id="2doc_count_'+dId2+'"><input type="hidden" name="doc_type[]" value="residence_proof">')

    );



  if (window.File && window.FileList && window.FileReader) {

    $("#2doc_count_"+dId2).on("change", function(e) {



      var rem_input = "#2doc_count_"+dId2;

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

            "</span>").insertAfter("#2doc_count_"+dId2);

          } else {

            $("<span class=\"pip\">" +

            "<img class=\"imageThumb\" src=\"" + base_url+'public/assets/images/site_imges/file_uploaded.png' + "\" title=\"" + file.name + "\"/>" +

            "<br/><span class=\"remove\">Remove image</span>" +

            "</span>").insertAfter("#2doc_count_"+dId2);

          }
          $("#2doc_count_"+dId2).css("display", "none");
          $('#addFile2').removeClass('disabled');
          $(".remove").click(function(){

            $(this).parent(".pip").remove(); 

            $(rem_input).remove(); 

          });

        });

        fileReader.readAsDataURL(f);

      }

    });

  } else {

    alert("Your browser doesn't support to File API")

  }

});

});





$(document).ready(function() {

  var dId3 = 0;

$('#addFile3').click(function() {
$('#addFile3').addClass('disabled');
  dId3++;

  $('#filesContainer3').append(

    $('<input type="file" class="hide_img_tag" name="img_document[]" multiple="" id="3doc_count_'+dId3+'"><input type="hidden" name="doc_type[]" value="birth_certificate">')

    );



  if (window.File && window.FileList && window.FileReader) {

    $("#3doc_count_"+dId3).on("change", function(e) {

      var rem_input = "#3doc_count_"+dId3;

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

            "</span>").insertAfter("#3doc_count_"+dId3);

          } else {

            $("<span class=\"pip\">" +

            "<img class=\"imageThumb\" src=\"" + base_url+'public/assets/images/site_imges/file_uploaded.png' + "\" title=\"" + file.name + "\"/>" +

            "<br/><span class=\"remove\">Remove image</span>" +

            "</span>").insertAfter("#3doc_count_"+dId3);

          }
          $("#3doc_count_"+dId3).css("display", "none");
          $('#addFile3').removeClass('disabled');
          $(".remove").click(function(){

            $(this).parent(".pip").remove(); 

            $(rem_input).remove(); 

          });

        });

        fileReader.readAsDataURL(f);

      }

    });

  } else {

    alert("Your browser doesn't support to File API")

  }

});

});



$(document).ready(function() {

  var dId4 = 0;

$('#addFile4').click(function() {
$('#addFile4').addClass('disabled');
  dId4++;

  $('#filesContainer4').append(

    $('<input type="file" class="hide_img_tag" name="img_document[]" multiple="" id="4doc_count_'+dId4+'"><input type="hidden" name="doc_type[]" value="pan_card">')

    );



  if (window.File && window.FileList && window.FileReader) {

    $("#4doc_count_"+dId4).on("change", function(e) {

      var rem_input = "#4doc_count_"+dId4;

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

            "</span>").insertAfter("#4doc_count_"+dId4);

          } else {

            $("<span class=\"pip\">" +

            "<img class=\"imageThumb\" src=\"" + base_url+'public/assets/images/site_imges/file_uploaded.png' + "\" title=\"" + file.name + "\"/>" +

            "<br/><span class=\"remove\">Remove image</span>" +

            "</span>").insertAfter("#4doc_count_"+dId4);

          }
          $("#4doc_count_"+dId4).css("display", "none");
          $('#addFile4').removeClass('disabled');
          $(".remove").click(function(){

            $(this).parent(".pip").remove(); 

            $(rem_input).remove(); 

          });

        });

        fileReader.readAsDataURL(f);

      }

    });

  } else {

    alert("Your browser doesn't support to File API")

  }

});

});



$(document).ready(function() {

  var dId5 = 0;

$('#addFile5').click(function() {
$('#addFile5').addClass('disabled');
  dId5++;

  $('#filesContainer5').append(

    $('<input type="file" class="hide_img_tag" name="img_document[]" multiple="" id="5doc_count_'+dId5+'"><input type="hidden" name="doc_type[]" value="photo_id">')

    );



  if (window.File && window.FileList && window.FileReader) {

    $("#5doc_count_"+dId5).on("change", function(e) {

      var rem_input = "#5doc_count_"+dId5;

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

            "</span>").insertAfter("#5doc_count_"+dId5);

          } else {

            $("<span class=\"pip\">" +

            "<img class=\"imageThumb\" src=\"" + base_url+'public/assets/images/site_imges/file_uploaded.png' + "\" title=\"" + file.name + "\"/>" +

            "<br/><span class=\"remove\">Remove image</span>" +

            "</span>").insertAfter("#5doc_count_"+dId5);

          }
          $("#5doc_count_"+dId5).css("display", "none");
          $('#addFile5').removeClass('disabled');
          $(".remove").click(function(){

            $(this).parent(".pip").remove(); 

            $(rem_input).remove(); 

          });

        });

        fileReader.readAsDataURL(f);

      }

    });

  } else {

    alert("Your browser doesn't support to File API")

  }

});

});



$(document).ready(function() {

  var dId6 = 0;

$('#addFile6').click(function() {
$('#addFile6').addClass('disabled');
  dId6++;

  $('#filesContainer6').append(

    $('<input type="file" class="hide_img_tag" name="img_document[]" multiple="" id="6doc_count_'+dId6+'"><input type="hidden" name="doc_type[]" value="address_doc">')

    );



  if (window.File && window.FileList && window.FileReader) {

    $("#6doc_count_"+dId6).on("change", function(e) {

      var rem_input = "#6doc_count_"+dId6;

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

            "</span>").insertAfter("#6doc_count_"+dId6);

          } else {

            $("<span class=\"pip\">" +

            "<img class=\"imageThumb\" src=\"" + base_url+'public/assets/images/site_imges/file_uploaded.png' + "\" title=\"" + file.name + "\"/>" +

            "<br/><span class=\"remove\">Remove image</span>" +

            "</span>").insertAfter("#6doc_count_"+dId6);

          }
          $("#6doc_count_"+dId6).css("display", "none");
          $('#addFile6').removeClass('disabled');
          $(".remove").click(function(){

            $(this).parent(".pip").remove(); 

            $(rem_input).remove(); 

          });

        });

        fileReader.readAsDataURL(f);

      }

    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});
});

$(document).ready(function() {
  var dId7 = 0;
$('#addFile7').click(function() {
$('#addFile7').addClass('disabled');
  dId7++;
  $('#filesContainer7').append(
    $('<input type="file" class="hide_img_tag" name="img_document[]" multiple="" id="7doc_count_'+
      dId7+'"><input type="hidden" name="doc_type[]" value="passport">')
    );

  if (window.File && window.FileList && window.FileReader) {
    $("#7doc_count_"+dId7).on("change", function(e) {
      var rem_input = "#7doc_count_"+dId7;
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
            "</span>").insertAfter("#7doc_count_"+dId7);
          } else {
            $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + base_url+'public/assets/images/site_imges/file_uploaded.png' + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove image</span>" +
            "</span>").insertAfter("#7doc_count_"+dId7);
          }
          $("#7doc_count_"+dId7).css("display", "none");
          $('#addFile7').removeClass('disabled');
          $(".remove").click(function(){
            $(this).parent(".pip").remove(); 
            $(rem_input).remove(); 
          });
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});
});

$(document).ready(function() {
  var dId8 = 0;
$('#addFile8').click(function() {
$('#addFile8').addClass('disabled');
  dId8++;
  $('#filesContainer8').append(
    $('<input type="file" class="hide_img_tag" name="img_document[]" multiple="" id="8doc_count_'+
      dId8+'"><input type="hidden" name="doc_type[]" value="letter_emp">')
    );

  if (window.File && window.FileList && window.FileReader) {
    $("#8doc_count_"+dId8).on("change", function(e) {
      var rem_input = "#8doc_count_"+dId8;
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
            "</span>").insertAfter("#8doc_count_"+dId8);
          } else {
            $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + base_url+'public/assets/images/site_imges/file_uploaded.png' + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove image</span>" +
            "</span>").insertAfter("#8doc_count_"+dId8);
          }
          $("#8doc_count_"+dId8).css("display", "none");
          $('#addFile8').removeClass('disabled');
          $(".remove").click(function(){
            $(this).parent(".pip").remove(); 
            $(rem_input).remove(); 
          });
        });
        fileReader.readAsDataURL(f);
      }
    });
   // $("#8doc_count_"+dId8).css("display", "none");
  } else {
    alert("Your browser doesn't support to File API")
  }
});
});