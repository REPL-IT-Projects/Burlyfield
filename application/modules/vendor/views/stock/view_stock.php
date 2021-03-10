<div class="page-holder w-100 d-flex flex-wrap">
            <div class="container-fluid px-xl-5">
<section class="order-grid-section py-5">
                  <div class="row mb-4">
                     <div class="card">
                        <div class="card-body">
                           <div class="col-lg-12 mb-4 mb-lg-0">
                              <div class="table-wrapper">
                                 <div class="table-title">
                                    <div class="row">
                                       <div class="col-sm-8">
                                          <h2>Stock Update</h2>
                                       </div>
                                      
                                    </div>
                                 </div>
                                  <?php echo validation_errors(); ?>
                                    <?php if($this->session->flashdata('Invalid') != ''){ ?>
                                        <div class="alert alert-success hide_msg">
                                            <p><?php echo $this->session->flashdata('Invalid');?></p>
                                        </div>
                                    <?php } ?>
                                 <table class="example table table-striped table-bordered" style="width:100%">
                                    <thead>

                                  <tr style="background-color: #f17427; color: #fff;">

                                    <th>Product</th>
                                    <th style="width: 200px;">Status</th>
                                  </tr>
                                </thead>

                                <tbody>
                                    <?php  
                                    if (count($data) > 0) {
                                        foreach ($data as $row) {
                                         if($row['stock_status'] == 'I'){
                                             $status = 'In Stock';
                                             $flag = 'O';
                                         }else{
                                             $status = 'Out Stock';
                                             $flag = 'I';
                                         }
                                            ?>
                                        <tr id="<?php echo $row["int_glcode"]; ?>">

                                            <td><img style="width: 50px;" src="<?php echo $row["var_image"]; ?>">&nbsp;<?php echo $row['var_title']; ?></td>
                                            <td class="center">
                                                <div id="stock<?php echo $row['int_glcode']; ?>"><a href="javascript:void(0);" onclick="InOutStock('<?php echo $flag;?>', '<?php echo $row["int_glcode"];?>');"><?php echo $status; ?></a></div>
                                            </td>
                                        </tr>
                                            <?php } 
                                        } else { ?>
                                            <tr><td>No data available.</td></tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                 
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </section>
</div>
    
    <script>
        function InOutStock(flag,pid){

            if (flag == 'I') {
                var msg = "You want to In Stock this Product ?";
            } else {
                var msg = "You want to Out Stock this Product ?";
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
                url: "<?php echo base_url();?>vendor/stock/stockUpdate",
                data: { flag: flag,
                    pid: pid },

                    success: function(data){
                        //location.reload();

                        if(flag == 'I')
                        {
                            var value1 = 'O';
                            var label = 'In Stock';
                        }
                        else
                        {
                            var value1 = 'I';
                            var label = 'Out Stock';
                        }
                        
                        $('#stock'+pid).replaceWith("<div id='stock"+pid+"'><a href='javascript:void(0);' onclick=InOutStock('"+value1+"', '"+pid+"')>"+label+"</a></div>");
                       
                    }
                });
            
                  }
                })
            }
    </script>