<!-- <link rel="stylesheet" href="https://cidev.in/book_change/public/front_assets/css/scrollbar.css">
<script src="https://cidev.in/book_change/public/front_assets/js/scrollbar.min.js"></script>
 -->

<style>

   .footer{

   display: none;

   }

</style>

<div id="main-wrapper" class="ChatingPage">

   <div class="page-wrapper" style="display: block;">

      <div class="page-breadcrumb">

         <section class="tg-dbsectionspace tg-haslayout" id="chat_contant" style="display: block">

            <div class="row">

               <div class="tg-formtheme-chat tg-formdashboard">

                  <fieldset style="border: none;">

                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                        <div class="tg-dashboardbox">

                           <div class="tg-dashboardboxtitle">

                              <h2>User Chat/Messages</h2>

                           </div>

                           <div class="tg-dashboardholder tg-offersmessages tg-offersmessageswithsearch">

                              <ul>

                                 <li class="chatUserList">

                                    <div class="tg-offerers tg-verticalscrollbar tg-dashboardscrollbar mCustomScrollbar _mCS_3 _mCS_1 mCS_no_scrollbar">

                                       <div id="mCSB_1" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" style="max-height: none;" tabindex="0">

                                          <div id="mCSB_1_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">

                                             <div id="chat_name">

                                                 

                                                 <?php if(count($chat_name) > 0){ 

                                                     $user_id = $chat_name[0]['int_glcode'];

                                                     

                                                        foreach ($chat_name as $row1){ 

                                                     $count = $this->common_model->get_seen_count($row1['int_glcode']);

                                                     if($row1['var_image'] != ''){

                                                         $image = base_url().'public/uploads/user/'.$row1['var_image'];

                                                     }else{

                                                         $image = base_url().'public/assets/images/users/user.png';

                                                     }

                                                     ?>

                                                <div class="tg-offerer">

                                                   <a href="javascript:void(0)" onclick="get_chat_data('<?php echo $row1['int_glcode'];?>')">

                                                      <figure>

                                                         <img src="<?php echo $image;?>" alt="user" class="mCS_img_loaded">

                                                      </figure>

                                                       <h3><?php echo $row1['var_name'];
                                                       
                                                       if($count > 0){
                                                       ?>
                                                           
                                                           <span class="point_round"></span>
                                                       <?php } ?>
                                                       </h3>

                                                   </a>

                                                </div>

                                                 <?php }}else{

                                                     $user_id = '0';

                                                 } ?>

                                                 

                                             </div>

                                          </div>

                                          <div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-light mCSB_scrollTools_vertical" style="display: none;">

                                             <div class="mCSB_draggerContainer">

                                                <div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; height: 0px; top: 0px;">

                                                   <div class="mCSB_dragger_bar" style="line-height: 30px;"></div>

                                                </div>

                                                <div class="mCSB_draggerRail"></div>

                                             </div>

                                          </div>

                                       </div>

                                    </div>

                                 </li>

                                 <li>

                                    <div class="tg-messages tg-verticalscrollbar tg-dashboardscrollbar mCustomScrollbar _mCS_4 _mCS_2">

                                       <div id="mCSB_2" class="mCustomScrollBox1 mCS-light mCSB_vertical mCSB_inside" tabindex="0" style="max-height: none;">

                                          <div id="mCSB_2_container" class="mCSB_container" style="position:relative; top:0; left:0;height: 365px;overflow: auto;" dir="ltr">

                                             <div id="chat_msg" style="display: none">

                                                 

                                                 

                                                <div class="tg-memessage">

                                                   <div class="tg-description">

                                                      <p>Hello</p>

                                                      <time>25 Jul at 11:40</time>

                                                   </div>

                                                </div>

                                                <div class="tg-offerermessage">

                                                   <div class="tg-description">

                                                      <p>whats up?</p>

                                                      <time>25 Jul at 11:41</time>

                                                   </div>

                                                </div>

                                                 

                                                 

                                             </div>

                                          </div>

                                          <div id="mCSB_2_scrollbar_vertical" class="mCSB_scrollTools mCSB_2_scrollbar mCS-light mCSB_scrollTools_vertical" style="display: block; visibility: hidden;">

                                             <div class="mCSB_draggerContainer">

                                                <div id="mCSB_2_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; top: 0px; display: block; height: 205px; max-height: 387px;">

                                                   <div class="mCSB_dragger_bar" style="line-height: 30px;"></div>

                                                </div>

                                                <div class="mCSB_draggerRail"></div>

                                             </div>

                                          </div>

                                       </div>

                                    </div>

                                    <div id="form_data">

                                       <form method="POST" id="insert_msg">

                                          <div class="tg-replaybox">

                                              <textarea class="form-control" id="txt_msg" name="txt_msg" placeholder="Type Here &amp; Press Enter" required=""></textarea>

                                             <input type="hidden" name="fk_user" id="fk_user" value="<?php echo $user_id;?>">

<!--                                             <div class="tg-iconbox">

                                                <button type="submit" class="btn btn-info btn-rounded m-t-10 mb-2 float-right">Send</button>

                                             </div>-->

                                          </div>

                                       </form>

                                    </div>

                                 </li>

                              </ul>

                           </div>

                        </div>

                     </div>

                  </fieldset>

               </div>

            </div>

         </section>

      </div>

   </div>

</div>

<!-- <link rel="stylesheet" href="<?php echo base_url();?>public/dist/scrollbar.css">

<script src="<?php echo base_url();?>public/dist/scrollbar.js"></script> -->

<script>

    var sitepath = '<?php echo base_url();?>';

        document.onkeyup = enter;    
        function enter(e) {
            if (e.which == 13) 
                submitForm();
        }
        function submitForm(){

        //$("#insert_msg").submit(function(event) {

               //event.preventDefault();   

               var to_id = $('#fk_user').val();

               var txt_msg = $('#txt_msg').val();

               

               $.ajax({



                url: sitepath + "admin/user_chat/insert_chat",

                type: 'POST',

                data: "fk_user=" + to_id + "&txt_msg=" + txt_msg,

                //async: false,

                success: function (response) {

                    $('#insert_msg')[0].reset();

                    load_data();

                    $(".mCustomScrollBox1").stop().animate({ scrollTop: $(".mCustomScrollBox1")[0].scrollHeight}, "fast");

                }

            });

        //});
        }
        

        function get_chat_data(to_id){

            

            $.ajax({



                url: sitepath + "admin/user_chat/load_chat",

                type: 'POST',

                data: "fk_user=" + to_id,

                //async: false,

                success: function (response) {

                    document.getElementById('fk_user').value = to_id;

                  

                    $('#chat_msg').replaceWith("<div id='chat_msg'>"+response+"</div>");

        

                    $(".mCustomScrollBox1").stop().animate({ scrollTop: $(".mCustomScrollBox1")[0].scrollHeight}, "fast");

                }

            });

        }

        

        function load_data(){

            var to_id = $('#fk_user').val();

               

            $.ajax({



                url: sitepath + "admin/user_chat/load_chat",

                type: 'POST',

                data: "fk_user=" + to_id,

                //async: false,

                success: function (response) {

                 

                    $('#chat_msg').replaceWith("<div id='chat_msg'>"+response+"</div>");

               

                }

            });

        }

        

         setInterval(function() {

            load_data();

          }, 5000);

        
        function load_chat_name(){

            $.ajax({

                url: sitepath + "admin/user_chat/load_chat_name",

                type: 'POST',

                data: "fk_user=1",

                //async: false,

                success: function (response) {

                    $('#chat_name').replaceWith("<div id='chat_name'>"+response+"</div>");

                }

            });

        }

        setInterval(function() {

            load_chat_name();

          }, 5000);

</script>