
    <form action="" method="POST">

        

        <label><h6 style="color: #ff4e00;">ASSIGN DELIVERY BOY</h6></label>

        <select name="fk_delivery" id="fk_delivery" class="form-control" required="" onchange="check_delivery_boy(this.value,'<?php echo $fk_order;?>')">

            <option value="">SELECT DELIVERY BOY</option>

            <?php foreach($delivery_boy as $res){ ?>

            <option value="<?php echo $res['fk_delivery'];?>"><?php echo $res['var_name'].' ('.$res['var_mobile_no'].')';?></option>

            <?php } ?>

        </select><br>

        <input type="submit" class="btn btn-primary" value="ASSIGN">

    </form>


    <script>

        function check_delivery_boy(id,fk_order){

            

            $.ajax({

                url : sitepath+"vendor/order/check_delivery_boy",

                data : 'id='+id,      

                type : "POST",        

                success : function(data) {

                    assign_delivery(data,id,fk_order);

                },

                error : function(data) {

                }

            }); 

        }

        

        function assign_delivery(flag,fk_delivery,fk_order){

        if (flag == 'F') {

                var msg = "This delivery boy is available for order.";

            } else {

                var msg = "Sorry ! This delivery boy is busy , Are you sure want to assign order.";

            }

            

            swal({

              title: "Are you sure?",

              text: msg,

              type: "warning",

              showCancelButton: true,

              confirmButtonColor: "#DD6B55",

              cancelButtonText: "No",

              confirmButtonText: "Yes",

            }).then((result) => {

              if (result.value) {

                $.ajax({

                type: "POST",

                dataType: 'json',

                cache: false,

                url: "<?php echo base_url();?>vendor/order/assign_order",

                data: { fk_delivery: fk_delivery,

                    fk_order: fk_order },



                    success: function(data){

                        //location.reload();



                        window.location.href = sitepath+"vendor/order";

                       

                    }

                });

            

                  }

                })

                }

    </script>