<footer class="footer bg-white shadow align-self-end py-3 px-xl-5 w-100">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-md-6 text-center text-md-right text-gray-400">
                        <p class="mb-0">Copyright <i class="fa fa-copyright"></i> <a href="" target="_blank"></a> 2020 All Rights Reserved</p>
                     </div>
                  </div>
               </div>
            </footer>
         </div>
      </div>
      <!-- JavaScript files-->
      <script src="<?php echo base_url();?>public/assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
      <script src="<?php echo base_url();?>public/vendor_assets/popper.js/umd/popper.min.js"> </script>
      <script src="<?php echo base_url();?>public/vendor_assets/bootstrap/js/bootstrap.min.js"></script>
      <script src="<?php echo base_url();?>public/vendor_assets/jquery.cookie/jquery.cookie.js"> </script>
      <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
      <script src="<?php echo base_url();?>public/vendor_assets/js/charts-home.js"></script>
      <script src="<?php echo base_url();?>public/vendor_assets/js/front.js"></script>
      <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
      <script src="<?php echo base_url();?>public/vendor_assets/js/ajax.js"></script>
      <script type="text/javascript">
         $(document).ready(function() {
            $('.example').DataTable();
         });
         
         
         function checkAll(bx) {
         var cbs = document.getElementsByTagName('input');
         for(var i=0; i < cbs.length; i++) {
         if(cbs[i].type == 'checkbox') {
         cbs[i].checked = bx.checked;
         }
         }
         }
      </script>
<!--      <script type="text/javascript">
         $(document).ready(function(){
         $('[data-toggle="tooltip"]').tooltip();
         var actions = $("table td:last-child").html();
         // Append table with add row form on add new button click
         $(".add-new").click(function(){
         $(this).attr("disabled", "disabled");
         var index = $("table tbody tr:last-child").index();
           var row = '<tr>' +
               '<td><input type="text" class="form-control" name="name" id="name"></td>' +
               '<td><input type="text" class="form-control" name="department" id="department"></td>' +
               '<td><input type="text" class="form-control" name="phone" id="phone"></td>' +'<td><input type="text" class="form-control" name="phone" id="phone"></td>' +'<td><input type="text" class="form-control" name="phone" id="phone"></td>' +
         '<td>' + actions + '</td>' +
           '</tr>';
         $("table").append(row);   
         $("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
           $('[data-toggle="tooltip"]').tooltip();
         });
         // Add row on add button click
         $(document).on("click", ".add", function(){
         var empty = false;
         var input = $(this).parents("tr").find('input[type="text"]');
           input.each(function(){
         if(!$(this).val()){
           $(this).addClass("error");
           empty = true;
         } else{
                   $(this).removeClass("error");
               }
         });
         $(this).parents("tr").find(".error").first().focus();
         if(!empty){
         input.each(function(){
           $(this).parent("td").html($(this).val());
         });     
         $(this).parents("tr").find(".add, .edit").toggle();
         $(".add-new").removeAttr("disabled");
         }   
         });
         // Edit row on edit button click
         $(document).on("click", ".edit", function(){    
           $(this).parents("tr").find("td:not(:last-child)").each(function(){
         $(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
         });   
         $(this).parents("tr").find(".add, .edit").toggle();
         $(".add-new").attr("disabled", "disabled");
         });
         // Delete row on delete button click
         $(document).on("click", ".delete", function(){
           $(this).parents("tr").remove();
         $(".add-new").removeAttr("disabled");
         });
         });
      </script>-->
   </body>
</html>