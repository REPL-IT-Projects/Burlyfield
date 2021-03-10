<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model extends CI_Model {
   
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('common_model');        
    }

    /*---------------- check email already exit or not --------------*/
    public function checkEmail($eaddress)
    {
        $select = "select int_glcode from mst_users where chr_delete = 'N' and chr_publish = 'Y' and var_email = '".$eaddress."'";
        $result = $this->db->query($select);
        $count = $result->num_rows();
        if($count > 0){
            return false;
        }else{
            return true;
        }
    } 

    public function checkForgotLink($var_email)
    {
        $select = "select int_glcode from mst_users where chr_delete = 'N' and var_mobile_no = '".$var_email."'";
        $result = $this->db->query($select);
        $data = $result->row_array();

        if (!empty($data)) {
            $get_res = 'mobile_no';
            
        }

        $select1 = "select int_glcode from mst_users where chr_delete = 'N' and var_email = '".$var_email."'";
        $result1 = $this->db->query($select1);
        $data1 = $result1->row_array();
      
        if (!empty($data1)) {
            $get_res = 'email';
            
        }

        if (empty($data) && empty($data1)) {
            $get_res = 'failed_data';
            
        }

        return $get_res;

    }

    /*---------------- check mobile no. already exit or not --------------*/
    public function checkMobile($mobile)
    {
        $select = "select int_glcode from mst_users where chr_delete = 'N' and chr_publish = 'Y' and var_mobile_no = '".$mobile."'";
        $result = $this->db->query($select);
        $count = $result->num_rows();
        if($count > 0){
            return false;
        }else{
            return true;
        }
    }

    public function get_userid($eaddress)
    {
        $select = "select int_glcode from mst_users where chr_delete = 'N' and var_email = '".$eaddress."'";
        $result = $this->db->query($select);
        $data = $result->row_array();
        return $data['int_glcode'];
    }

    public function get_username_id($mobile)
    {
        $select = "select int_glcode from mst_users where chr_delete = 'N' and var_mobile_no = '".$mobile."'";
        $result = $this->db->query($select);
        $data = $result->row_array();
        return $data['int_glcode'];
    }

    public function get_user_name($var_mobile)
    {
        $select = "select var_name from mst_users where chr_delete = 'N' and var_mobile_no = '".$var_mobile."'";
        $result = $this->db->query($select);
        $data = $result->row_array();
        return $data['var_name'];
    }

    /////////////////////////// update time stamp ////////////////////////////
    public function updateTimeStamp($email)
    {
        $time_stamp = time();
        $this->db->set('dt_timestamp', $time_stamp); 
        $this->db->where('var_email', $email);   
        $this->db->update('mst_users'); 
        //echo $this->db->last_query(); exit();
    }

    public function updatePass($var_email,$newpass)
    {
        $var_password = $this->mylibrary->cryptPass($newpass);
        $this->db->set('var_password', $var_password); 
        $this->db->where('var_email', $var_email);   
        $this->db->update('mst_users'); 
        //echo $this->db->last_query(); exit();
    }

    /*----------------------- user login API -------------------------*/
    public function user_login($username,$password)
    {
        $this->db->select('*');
        $this->db->from('mst_users');
        $this->db->where('var_mobile_no',$username);
        $this->db->where('var_password', $password);
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();

        //echo $this->db->last_query(); exit();
        $row = $query->row_array();
        if(count($row) > 0){
        if ($row['var_image'] != '') {
            $Image1 = base_url().'uploads/user/'.$row['var_image'];
        } else{
            $Image1 = base_url().'public/front_assets/images/profile-header.jpg';
        }

        $_SESSION['login_user'] = 'user';
        $_SESSION['fk_user'] = $row['int_glcode'];
        $_SESSION['user_name'] = $row['var_name'];
        $_SESSION['var_image'] = $Image1;
        $_SESSION['mobile_no'] = $row['var_mobile_no'];
        $_SESSION['email'] = $row['var_email'];

        if (!empty($_SESSION["cart_item"])) {
            $row["cart"] = 'Y';
        } else {
            $row["cart"] = 'N';
        }

            $this->db->select('c.*,p.var_image,p.var_offer,pp.var_discount_price,pp.var_price as price');
            $this->db->from('trn_cart_details c');
            $this->db->join('mst_products p','p.int_glcode = c.fk_product');
            $this->db->join('trn_product_price pp','pp.fk_product = c.fk_product AND pp.var_quantity = c.var_quantity');
            //$this->db->join('trn_product_price pp','pp.var_quantity = c.var_quantity');
            $this->db->where('c.fk_user' , $row['int_glcode']);

            $query1 = $this->db->get();      
               $count = $query1->num_rows();
         
                if ($count > 0) {

                    $row_arr = $query1->result_array(); 

                    foreach($row_arr as $row1){
                        
                        if($row1['var_offer'] == '0'){
                            $price = $row1["price"];
                            $dis_price = $row1["price"];
                        }else{ 
                            $price = $row1['price'];
                            $dis_price = $row1['price'];
                        }
                        
                        $grand_total = $row1["var_unit"] * $price;
            
                        if($row1["var_image"] != ''){
                            $img = base_url().'uploads/products/'.$row1["var_image"];
                        }else{
                            $img = base_url().'public/assets/img/site_imges/no_image.png';
                        }

                        $itemArray = array(
                            $row1['fk_product'].$row1["var_quantity"] => array(
                                    'int_glcode' => $row1['fk_product'],
                                    'image' => $img, 
                                    'price' => $price, 
                                'dis_price' => $dis_price,
                                    'title' => $row1["var_name"], 
                                    'quantity' => $row1["var_unit"], 
                                    'weigth' => $row1["var_quantity"], 
                                'offer' => $row1['var_offer'],
                                    'grand_total' => $grand_total
                                )
                            );
                        
                       
                          if (!empty($_SESSION["cart_item"])) {
                              $_SESSION["cart_item"] = $_SESSION["cart_item"] + $itemArray;
                          } else {
                              $_SESSION["cart_item"] = $itemArray;
                          }
            }
    
          }

          //echo "<pre>"; print_r($itemArray); exit();
          
        return $row;
    }else{
        return array();
    }
    }

    public function social_save($fk_user)
    {
        $this->db->select('c.*,p.var_image,p.var_offer,pp.var_discount_price,pp.var_price as price');
        $this->db->from('trn_cart_details c');
        $this->db->join('mst_products p','p.int_glcode = c.fk_product');
        $this->db->join('trn_product_price pp','pp.fk_product = c.fk_product AND pp.var_quantity = c.var_quantity');
        //$this->db->join('trn_product_price pp','pp.var_quantity = c.var_quantity');
        $this->db->where('c.fk_user' , $fk_user);

        $query1 = $this->db->get();      
   
           $count = $query1->num_rows();
     
            if ($count > 0) {
                $row_arr = $query1->result_array(); 

                //echo "<pre>"; print_r($row_arr); exit();
                
                foreach($row_arr as $row){
                    
                    $price = $row['price'];
                    $dis_price = $row['price'];
                    
                    $grand_total = $row["var_unit"] * $price;
        
                    if($row["var_image"] != ''){
                        $img = base_url().'uploads/products/'.$row["var_image"];
                    }else{
                        $img = base_url().'public/assets/img/site_imges/no_image.png';
                    }

                    $itemArray = array(
                        $row['fk_product'].$row["var_quantity"] => array(
                                'int_glcode' => $row['fk_product'],
                                'image' => $img, 
                                'price' => $price, 
                            'dis_price' => $dis_price,
                                'title' => $row["var_name"], 
                                'quantity' => $row["var_unit"], 
                                'weigth' => $row["var_quantity"], 
                            'offer' => $row['var_offer'],
                                'grand_total' => $grand_total
                            )
                        );
                    
                   
                      if (!empty($_SESSION["cart_item"])) {
                          $_SESSION["cart_item"] = $_SESSION["cart_item"] + $itemArray;
                      } else {
                          $_SESSION["cart_item"] = $itemArray;
                      }
            }
    
          }

          return True;
    }

    public function update_shopping_cart()
    {
      $user_id = $_SESSION['fk_user'];
      $delete = array("fk_user" => $user_id);
      $this->db->delete('trn_cart_details' , $delete);
      if (isset($_SESSION["cart_item"])) {
          foreach ($_SESSION["cart_item"] as $key => $value) {
        
            $data = array(
                'fk_product' => $value["int_glcode"],
                'fk_user' => $user_id,
                'var_name' => $value["title"],
                'var_quantity' => $value["weigth"],
                'var_price' => $value["price"],
                'var_unit' => $value["quantity"],
                'dt_createddate' => date('Y-m-d-h-i-s'),
                'dt_modifydate' => date('Y-m-d-h-i-s'),
                'var_ipaddress' => $_SERVER['REMOTE_ADDR']
            );

            $this->db->insert('trn_cart_details' , $data);
          }
      }
      
    }
    
    /*--------------------------- get users list ------------------------------*/
    public function getProfileDetalis($userId)
    {
        $this->db->select('int_glcode as fk_user,var_mobile_no,chr_verify');
        $this->db->from('mst_users');
        $this->db->where('int_glcode',$userId);
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }

    /*--------------------------- get users details ------------------------------*/
    public function getUserDetalis($userId)
    {
        $this->db->select('*');
        $this->db->from('mst_users');
        $this->db->where('int_glcode',$userId);
        $query = $this->db->get();
        $row = $query->row_array();
        //echo $this->db->last_query(); exit();
        return $row;
    }

    /*------------------------ add record ------------------------- */
    public function addRecord()
    {
        //echo "<pre>"; print_r($_POST); exit();
        $fk_user = $this->input->post('fk_user_id');
        $var_email = $this->input->post('email');
        $name = $this->input->post('var_name');

        if ($fk_user == '') {
            $data = array(
                'var_name' => $this->input->post('var_name'),
                'var_mobile_no' => $this->input->post('phone'),
                'var_default_no' => $this->input->post('phone'),
                'var_email' => $this->input->post('email'),
                'var_password' => $this->mylibrary->cryptPass($this->input->post('password')),
                'var_image' => '',
                'chr_publish' => 'Y',
                'chr_delete' => 'N',
                'dt_createddate' => date('Y-m-d H:i:s'),
                'dt_modifydate' => date('Y-m-d H:i:s'),
                'var_ipaddress' => $_SERVER['REMOTE_ADDR']
            );

            $id = $this->common_model->insertRow($data, "mst_users");

            $this->common_model->send_otp_verification($id,$this->input->post('phone'),'mst_users');
            $_SESSION['login_user'] = 'user';
            $_SESSION['fk_user'] = $id;
            $_SESSION['user_name'] = $this->input->post('var_name');
            $_SESSION['mobile_no'] = $this->input->post('phone');
            $_SESSION['email'] = $this->input->post('email');
            $_SESSION['var_image'] = base_url().'public/front_assets/images/profile-header.jpg';

            if ($id != '') {

                $addData = array(
                    'fk_user' => $id,
                    'var_house_no' => $this->input->post('var_house_no'),
                    'var_app_name' => $this->input->post('var_app_name'),
                    'var_landmark' => $this->input->post('var_landmark'),
                    'var_country' => $this->input->post('var_country'),
                    'var_state' => $this->input->post('var_state'),
                    'var_city' => $this->input->post('var_city'),
                    'var_pincode' => $this->input->post('var_pincode'),
                    'chr_type' => 'Home',
                    'default_status' => 'Y',
                    'chr_publish' => 'Y',
                    'chr_delete' => 'N',
                    'dt_createddate' => date('Y-m-d H:i:s'),
                    'dt_modifydate' => date('Y-m-d H:i:s'),
                    'var_ipaddress' => $_SERVER['REMOTE_ADDR']
                );

                $this->common_model->insertRow($addData, "mst_user_address");
            }


           //Send email 
            $to = $var_email;

            $subject = 'Welcome to Burlyfield!';

            $headers = "From: " . FROM_EMAIL . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            $message = "Hi ".$name.",\r\n\r\n <p>Your Burlyfield account has been created! You may use your account to browse our finest natural products and order from us. We are very delighted to have you.</p>\r\n<p>For any clarifications or to know more about Burlyfield, please call us on +91-7722066378, and we will be glad to assist you.</p>\r\n\r\nBest Regards,<br>Team Burlyfield.";


            mail($to, $subject, $message, $headers);
        

        
            
            // $this->common_model->send_register_user($this->input->post('var_name'),$var_email,$this->input->post('phone'),'U');
            $user_get_id = $id;
        } else {
            $data = array(
                'var_name' => $this->input->post('var_name'),
                'var_mobile_no' => $this->input->post('phone'),
                'var_default_no' => $this->input->post('phone'),
                'var_email' => $this->input->post('email'),
                'var_password' => $this->mylibrary->cryptPass($this->input->post('password')),
                'var_image' => '',
                'chr_publish' => 'Y',
                'chr_delete' => 'N',
                'dt_createddate' => date('Y-m-d H:i:s'),
                'dt_modifydate' => date('Y-m-d H:i:s'),
                'var_ipaddress' => $_SERVER['REMOTE_ADDR']
            );

            $this->common_model->updateRow('mst_users', $data, array("int_glcode" => $fk_user));

            $this->common_model->send_otp_verification($fk_user,$this->input->post('phone'),'mst_users');

            $_SESSION['login_user'] = 'user';
            $_SESSION['fk_user'] = $fk_user;
            $_SESSION['user_name'] = $this->input->post('var_name');
            $_SESSION['mobile_no'] = $this->input->post('phone');
            $_SESSION['email'] = $this->input->post('email');
            $_SESSION['var_image'] = base_url().'public/front_assets/images/profile-header.jpg';

                $updateData = array(
                    'fk_user' => $fk_user,
                    'var_house_no' => $this->input->post('var_house_no'),
                    'var_app_name' => $this->input->post('var_app_name'),
                    'var_landmark' => $this->input->post('var_landmark'),
                    'var_country' => $this->input->post('var_country'),
                    'var_state' => $this->input->post('var_state'),
                    'var_city' => $this->input->post('var_city'),
                    'var_pincode' => $this->input->post('var_pincode'),
                    'chr_type' => 'Home',
                    'default_status' => 'Y',
                    'chr_publish' => 'Y',
                    'chr_delete' => 'N',
                    'dt_createddate' => date('Y-m-d H:i:s'),
                    'dt_modifydate' => date('Y-m-d H:i:s'),
                    'var_ipaddress' => $_SERVER['REMOTE_ADDR']
                );

                $this->common_model->insertRow($updateData, "mst_user_address");

                    $to = $var_email;

                    $subject = 'Welcome to Burlyfield!';

                    $headers = "From: " . FROM_EMAIL . "\r\n";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                    $message = "Hi ".$name.",\r\n\r\n <p>Your Burlyfield account has been created! You may use your account to browse our finest natural products and order from us. We are very delighted to have you.</p>\r\n<p>For any clarifications or to know more about Burlyfield, please call us on +91-7722066378, and we will be glad to assist you.</p>\r\n\r\nBest Regards,<br>Team Burlyfield.";


                    mail($to, $subject, $message, $headers);
            
            // $this->common_model->send_register_user($this->input->post('var_name'),$var_email,$this->input->post('phone'),'U');
            $user_get_id = $fk_user;
            
        }

        return $user_get_id;
        //echo $this->db->last_query(); exit();
        
    }

    /*------------------------------- get otp --------------------------- */
    public function get_otp($user_id,$var_otp) 
    {
        $this->db->select('int_glcode,var_otp,var_name,var_email,var_mobile_no');
        $this->db->from('mst_users');
        $this->db->where('int_glcode', $user_id);
        $this->db->where('var_otp', $var_otp);
        $result = $this->db->get(); 
        $row = $result->row_array();
        //echo "<pre>"; print_r($row); exit();
        if ($var_otp == $row['var_otp']) {
            $data = array(
                'chr_verify' => 'Y'
            );

            $this->db->where('int_glcode', $user_id);
            $this->db->update('mst_users', $data);

            $this->common_model->send_register_user($row['var_name'],$row['var_email'],$row['var_mobile_no'],'U');

            $this->common_model->send_register_admin($row['var_name'],$row['var_email'],$row['var_mobile_no']);

        }

        return $row['int_glcode'];  

    }

}