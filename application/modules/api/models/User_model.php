<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {

        parent::__construct();

        $this->load->database();

        $this->load->model('common_model');
    }

    /*------------------------------ add user ---------------------------- */
    public function addUser()
    {
        if(isset($_FILES['var_image']))
        {
            if (!is_dir('uploads/user')) {
                mkdir('uploads/user', 0777, TRUE);
            }
                $filename = time().'_'.$_FILES['var_image']['name'];
                $filename = str_replace('&', "_", $filename);
                $filename = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename);
                $destination = 'uploads/user/';
                move_uploaded_file($_FILES['var_image']['tmp_name'],$destination.$filename);
            } else {
                $filename =  '';
            }

        $data = array(
            'var_name' => $this->input->post('var_name'),
            'var_username' => $this->input->post('var_username'),
            'var_email' => $this->input->post('var_email'),
            'var_mobile_no' => $this->input->post('var_mobile_no'),
            'var_default_no' => $this->input->post('var_mobile_no'),
            'var_password' => $this->mylibrary->cryptPass($this->input->post('var_password')),
            'var_image' => $filename,
            'var_device_token' => $this->input->post('var_device_token'),
            'chr_publish' => 'Y',
            'chr_delete' => 'N',
            'dt_createddate' => date('Y-m-d H:i:s'),
            'dt_modifydate' => date('Y-m-d H:i:s')
        );

        $id = $this->common_model->insertRow($data, "mst_users");

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
                'dt_modifydate' => date('Y-m-d H:i:s')
            );

            $this->common_model->insertRow($addData, "mst_user_address");

          //  $this->common_model->send_register_user($this->input->post('var_name'),$this->input->post('var_email'),$this->input->post('var_mobile_no'),'U');

           // $this->common_model->send_register_admin($this->input->post('var_name'),$this->input->post('var_email'),$this->input->post('var_mobile_no'));
            //echo $this->db->last_query(); exit();
            //echo $id; exit();
            //echo $this->db->last_query(); exit();
            //$this->mylibrary->insertinlogmanager('user', 'mst_user', 'var_name', $id, 'I', 'int_glcode');
            return $id;
        } else {
            return false;
        }

    }

    /*------------------------------- get otp --------------------------- */
    public function send_otp($user_id,$var_mobile) 
    {
        $OTP = $this->mylibrary->generateOTP(4);
           
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://sms.bulksmsflash.com/rest/services/sendSMS/sendGroupSms?AUTH_KEY=5d18e29d53784559d4dccb96ffd39d0",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{\"smsContent\":\"$OTP is your Vruits verification code. Code valid only for 30 Second & one time use. Happy Shopping!\",\"routeId\":\"1\",\"mobileNumbers\":\"$var_mobile\",\"senderId\":\"vruits\",\"smsContentType\":\"english\"}",
          CURLOPT_HTTPHEADER => array(
            "Cache-Control: no-cache",
            "Content-Type: application/json"
          ),
        ));

        $response = curl_exec($curl);
        
        //echo'<pre>';print_r($response);die;
        
        
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          //echo "cURL Error #:" . $err;
        } else {
          //echo $response;
        }

        $data = array(
            'var_otp' => $OTP,
        );

        $this->db->where('int_glcode', $user_id);
        $this->db->update('mst_users', $data);

        return TRUE;  

    }

    /*--------------------------- get users search ------------------------------*/
    public function searchUser($keyword)
    {
        $this->db->select('int_glcode,var_fname,var_uname,var_email,e_gender,var_phoneno,dt_bod');
        $this->db->from('mst_user');
        $this->db->like('var_fname', $keyword);
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }
   
    /*--------------------------- get users list ------------------------------*/
    public function getProfileDetalis($userId)
    {
        $this->db->select('int_glcode as fk_user,var_name,var_email,var_mobile_no,var_alt_mobile,var_default_no,var_image,chr_verify');
        $this->db->from('mst_users');
        $this->db->where('int_glcode',$userId);
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();

        $row_arr = array();

        foreach ($row as $value) {
            if ($value['var_image'] != '') {
                $value['var_image'] = base_url().'uploads/user/'.$value['var_image'];
            } else {
                $value['var_image'] = '';
            }

            if ($value['var_alt_mobile'] != null) {
                $value['var_alt_mobile'] = $value['var_alt_mobile'];
            } else {
                $value['var_alt_mobile'] = '';
            }
            
            $row_arr[] = $value;

        }
        
        return $row_arr;
    }

    /*--------------------------- get id by users list --------------------*/
    public function getIdByUser($userId)
    {
        $this->db->select('*');
        $this->db->from('mst_user');
        $this->db->where('int_glcode',$userId);
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }

    /*--------------------------- get id by users list --------------------*/
    public function viewUserDetail($userId)
    {
        $this->db->select('*');
        $this->db->from('mst_users');
        $this->db->where('int_glcode',$userId);
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }

    /*--------------------------- get user details ---------------------------------*/
    public function getUserImage($id)
    {
        $this->db->select('var_image');
        $this->db->from('mst_users');
        $this->db->where('int_glcode',$id);
        $query = $this->db->get();
        $row = $query->row_array();
        return $row['var_image'];
    }

   
    /*--------------------------- update user ---------------------------*/
    public function updateUser($userId)
    {
        if(isset($_FILES['var_image']['name']))
        {
            $filename = time().'_'.$_FILES['var_image']['name'];
            $filename = str_replace('&', "_", $filename);
            $filename = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename);
            $destination = 'uploads/user/';
            move_uploaded_file($_FILES['var_image']['tmp_name'],$destination.$filename);
        } else {
            $filename =  $this->getUserImage($userId);
        }

        $data = array(
            'var_name' => $this->input->post('var_name'),
            'var_email' => $this->input->post('var_email'),
            'var_mobile_no' => $this->input->post('var_mobile_no'),
            'var_image' => $filename,
            'var_device_token' => $this->input->post('var_device_token'),
            'dt_modifydate' => date('Y-m-d H:i:s')
        );

        $this->common_model->updateRow('mst_users', $data, array("int_glcode" => $userId)); 

        return 'true';

    }

    /*--------------------- user logout  --------------------*/
    public function user_logout($userId)
    {
        $data = array(
            'var_device_token' => ''  
        );

        $this->common_model->updateRow('mst_users', $data, array("int_glcode" => $userId)); 
        return TRUE;
    }

    /*---------------------  check email already exit or not --------------------*/
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

    public function get_userid($eaddress)
    {
        $select = "select int_glcode from mst_users where chr_delete = 'N' and var_email = '".$eaddress."'";
        $result = $this->db->query($select);
        $data = $result->row_array();
        return $data['int_glcode'];
    }
    
    public function updateTimeStamp($email)
    {
        $time_stamp = time();
        $this->db->set('dt_timestamp', $time_stamp); 
        $this->db->where('var_email', $email);   
        $this->db->update('mst_users'); 
    }
    
    /*---------------------  check email already exit or not --------------------*/
    public function checkUpdateEmail($userId,$eaddress)
    {
        $select = "select int_glcode from mst_users where int_glcode NOT IN (".$userId.") AND var_email = '".$eaddress."' AND chr_delete = 'N' AND chr_publish = 'Y'";
        $result = $this->db->query($select);
        $count = $result->num_rows();
        if($count > 0){
            return false;
        }else{
            return true;
        }
    }
    

    /*---------------------  check userId and token is same or not --------------------*/
    public function checkUserToken($userId,$token)
    {
        $select = "select * from mst_user where chr_delete = 'N' and int_glcode != '".$userId."' and var_auth_token = '".$token."' ";
        $result = $this->db->query($select);
        $count = $result->num_rows();
        if($count > 0){
            return false;
        }else{
            return true;
        }
    }

    /*--------------------- check email already exit or not in update time -----------------*/
    public function checkEmailUser($email,$userId)
    {
        $select = "select int_glcode from mst_users where chr_delete = 'N' and var_email = '".$email."' and int_glcode != '".$userId."'";
        $result = $this->db->query($select);
        $count = $result->num_rows();
        if($count > 0){
            return false;
        }else{
            return true;
        }
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

        return $row;
    }

    public function user_social_login($username)
    {
        $this->db->select('*');
        $this->db->from('mst_users');
        $this->db->where('var_email',$username);
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();

        //echo $this->db->last_query(); exit();
        $row = $query->row_array();

        return $row;
    }
    
    public function checkMobileNo($var_mobile)
    {
        $select = "select int_glcode from mst_users where chr_delete = 'N' and chr_publish = 'Y' and var_mobile_no = '".$var_mobile."'";
        $result = $this->db->query($select);
        $count = $result->num_rows();
        if($count > 0){
            return false;
        }else{
            return true;
        }
    }

    public function get_user_name($var_mobile)
    {
        $select = "select var_name from mst_users where chr_delete = 'N' and var_mobile_no = '".$var_mobile."'";
        $result = $this->db->query($select);
        $data = $result->row_array();
        return $data['var_name'];
    }

    public function get_username_id($mobile)
    {
        $select = "select int_glcode from mst_users where chr_delete = 'N' and var_mobile_no = '".$mobile."'";
        $result = $this->db->query($select);
        $data = $result->row_array();
        return $data['int_glcode'];
    }

    public function checkUpdateMobileNo($userId,$var_mobile)
    {
        $select = "select int_glcode from mst_users where int_glcode NOT IN (".$userId.") AND var_mobile_no = '".$var_mobile."' AND chr_delete = 'N' AND chr_publish = 'Y'";
        $result = $this->db->query($select);
        $count = $result->num_rows();
        if($count > 0){
            return false;
        }else{
            return true;
        }
    }
   
    /*------------------------------- get otp --------------------------- */
    public function get_otp($user_id,$var_otp) 
    {
        $this->db->select('*');
        $this->db->from('mst_users');
        $this->db->where('int_glcode', $user_id);
        $this->db->where('var_otp', $var_otp);
        $result = $this->db->get(); 
        $row = $result->row_array();

        if ($var_otp == $row['var_otp']) {
            $data = array(
                'chr_verify' => 'Y'
            );

            $this->db->where('int_glcode', $user_id);
            $this->db->update('mst_users', $data);

        }

        return $row;  

    }

    /*------------------------------- get otp --------------------------- */
    public function update_otp($vendor_id,$var_mobile_no,$var_otp) 
    {
        $this->db->select('*');
        $this->db->from('mst_vendors');
        $this->db->where('int_glcode', $vendor_id);
        $this->db->where('var_otp', $var_otp);
        $result = $this->db->get(); 
        $row = $result->row_array();

        if ($var_otp == $row['var_otp']) {
            $data = array(
                'var_alt_mobile' => $var_mobile_no
            );

            $this->db->where('int_glcode', $vendor_id);
            $this->db->update('mst_vendors', $data);

        }

        return $row;  

    }

    /*----------------------- update device ID on login time in API --------------------*/
    public function updateDeviceId($deviceId,$userId)
    {
        $this->db->set('var_device_token', $deviceId);
        $this->db->where('int_glcode',$userId);
        $this->db->update('mst_users');
        return true;
    }

    /*----------------------- change password ---------------------------*/
    public function chagePass($userId,$pass)
    {
        $this->db->select('int_glcode');
        $this->db->from('mst_users');
        $this->db->where('int_glcode',$userId);
        $this->db->where('var_password',$pass);
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        return $query;
    }

    /*----------------------- forgot password ---------------------------*/
    public function updatePass($newpass,$email)
    {
        $this->db->set('var_password', $newpass); 
        $this->db->where('var_email', $email);   
        $this->db->update('mst_user'); 
    }

    /*----------------------- chage password ---------------------------*/
    public function updatePassChange($newpass,$userId)
    {
        $this->db->set('var_password', $newpass); 
        $this->db->where('int_glcode', $userId);   
        $this->db->update('mst_users'); 
    }

    /*----------------------- If vairable return null value then return blank ------------*/
    public function emptyVar($field)
    {
      if($field == NULL) {
            $field = "";
        }
        return $field;
    }


    /*-------------------------- add delivery boy from vendor ------------------------------*/
    public function add_delivery_boy()
    {
        $data = array(
            'fk_vendor' => $this->input->post('var_vendor_id'),
            'var_name' => $this->input->post('var_name'),
            'var_email' => $this->input->post('var_email'),
            'var_mobile_no' => $this->input->post('var_mobile_no'),
            'var_password' => $this->mylibrary->cryptPass($this->input->post('var_password')),
            'chr_publish' => "Y",
            'chr_delete' => "N",
            'dt_createddate' => date('Y-m-d H:i:s'),
            'dt_modifydate' => date('Y-m-d H:i:s')
            
        );

        $id = $this->common_model->insertRow($data, "mst_delivery_boy");

        return $id;
    }



    /*---------------- check email already exit or not delivery --------------*/
    public function checkDEmail($eaddress)
    {
        $select = "select int_glcode from mst_delivery_boy where chr_delete = 'N' and chr_publish = 'Y' and var_email = '".$eaddress."'";
        $result = $this->db->query($select);
        $count = $result->num_rows();
        if($count > 0){
            return false;
        }else{
            return true;
        }
    }

    /*---------------- check mobile no. already exit or not delivery --------------*/
    public function checkDMobile($mobile)
    {
        $select = "select int_glcode from mst_delivery_boy where chr_delete = 'N' and chr_publish = 'Y' and var_mobile_no = '".$mobile."'";
        $result = $this->db->query($select);
        $count = $result->num_rows();
        if($count > 0){
            return false;
        }else{
            return true;
        }
    }

    /*--------------------------- get user address list --------------------*/
    public function getUserAddress($userId)
    {
        $this->db->select('int_glcode as fk_address,fk_user,var_house_no,var_app_name,var_landmark,var_country,var_state,var_city,var_pincode,chr_type,default_status');
        $this->db->from('mst_user_address');
        $this->db->where('fk_user',$userId);
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;
    }

    /*--------------------------- get user address list --------------------*/
    public function getUserDefaultAddress($userId)
    {
        $this->db->select('int_glcode as fk_address,fk_user,var_house_no,var_app_name,var_landmark,var_country,var_state,var_city,var_pincode,chr_type,default_status');
        $this->db->from('mst_user_address');
        $this->db->where('fk_user',$userId);
        $this->db->where('default_status','Y');
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }

    /*--------------------- user address add --------------------------*/
    public function add_user_address($fk_user)
    {
        if($_POST['default_status'] == 'Y')
        {
            $select = "select int_glcode,fk_user,default_status from mst_user_address where fk_user = '".$fk_user."'";
            $result = $this->db->query($select);
            $resArr = $result->result_array();

            if (count($resArr) > 0) {
                foreach ($resArr as $key => $value) {
                    $this->db->set('default_status', 'N');
                    $this->db->where('fk_user',$fk_user);
                    $this->db->update('mst_user_address');
                }
            }
        }

        $addData = array(
            'fk_user' => $fk_user,
            'var_house_no' => $this->input->post('var_house_no'),
            'var_app_name' => $this->input->post('var_app_name'),
            'var_landmark' => $this->input->post('var_landmark'),
            'var_country' => $this->input->post('var_country'),
            'var_state' => $this->input->post('var_state'),
            'var_city' => $this->input->post('var_city'),
            'var_pincode' => $this->input->post('var_pincode'),
            'chr_type' => $this->input->post('chr_type'),
            'default_status' => $this->input->post('default_status'),
            'chr_publish' => 'Y',
            'chr_delete' => 'N',
            'dt_createddate' => date('Y-m-d H:i:s'),
            'dt_modifydate' => date('Y-m-d H:i:s')
        );

        $id = $this->common_model->insertRow($addData, "mst_user_address");

        return $id;
    }

    /*--------------------- user address add --------------------------*/
    public function update_user_address($fk_user,$fk_address)
    {
        if($_POST['default_status'] == 'Y')
        {
            $select = "select int_glcode,fk_user,default_status from mst_user_address where fk_user = '".$fk_user."'";
            $result = $this->db->query($select);
            $resArr = $result->result_array();

            if (count($resArr) > 0) {
                foreach ($resArr as $key => $value) {
                    $this->db->set('default_status', 'N');
                    $this->db->where('fk_user',$fk_user);
                    $this->db->update('mst_user_address');
                }
            }
        }

        $data = array(
            'var_house_no' => $this->input->post('var_house_no'),
            'var_app_name' => $this->input->post('var_app_name'),
            'var_landmark' => $this->input->post('var_landmark'),
            'var_country' => $this->input->post('var_country'),
            'var_state' => $this->input->post('var_state'),
            'var_city' => $this->input->post('var_city'),
            'var_pincode' => $this->input->post('var_pincode'),
            'chr_type' => $this->input->post('chr_type'),
            'default_status' => $this->input->post('default_status'),
            'dt_modifydate' => date('Y-m-d H:i:s')
        );

        $this->common_model->updateRow('mst_user_address', $data, array("int_glcode" => $fk_address));

        return 'true';
    }

    /*--------------------- user address add --------------------------*/
    public function update_user_default($fk_user,$fk_address)
    {
        $select = "select int_glcode,fk_user,default_status from mst_user_address where fk_user = '".$fk_user."'";
        $result = $this->db->query($select);
        $resArr = $result->result_array();

        if (count($resArr) > 0) {
            foreach ($resArr as $key => $value) {
                $this->db->set('default_status', 'N');
                $this->db->where('fk_user',$fk_user);
                $this->db->update('mst_user_address');
            }
        }

            $this->db->set('default_status', 'Y');
            $this->db->where('int_glcode',$fk_address);
            $this->db->update('mst_user_address');

        return 'true';
    }

    /*-------------------------------- delete address -------------------------*/
    public function delete_user_address($fk_address)
    {
            $data = array(
                'chr_delete' => 'Y'
            );
            //$this->db->set('column_header', $value); //value that used to update column  
            $this->db->where('int_glcode', $fk_address);
            $this->db->update("mst_user_address",$data);
            
        // $this->db->query("DELETE from ci_users WHERE id='$id'");
        return 'true';

    }

    /*----------------------------- update mobile no ------------------------ */
    public function update_mobileno($user_id,$var_mobile_no,$var_otp) 
    {
        $this->db->select('int_glcode,var_name,var_email,var_mobile_no,var_otp');
        $this->db->from('mst_users');
        $this->db->where('int_glcode', $user_id);
        $this->db->where('var_otp', $var_otp);
        $result = $this->db->get(); 
        $row = $result->row_array();

        if ($_POST['chr_type'] == 'Y') {
            $default_no = $var_mobile_no;
        } else {
            $default_no = '';
        }   

        if ($var_otp == $row['var_otp']) {
            $data = array(
                'var_alt_mobile' => $var_mobile_no,
                'var_default_no' => $default_no
            );

            $this->db->where('int_glcode', $user_id);
            $this->db->update('mst_users', $data);

//            $this->load->model('mail_model');
//
//            $this->mail_model->contact_update($row['var_name'],$row['var_email'],$var_mobile_no);
//
//            $this->common_model->user_order_msg($row['var_name'],$var_mobile_no,'CONTACT_NO','','');
        }

        return $row;  

    }

    /*----------------------------- add default mobile no ------------------------ */
    public function add_default_mobileno($user_id,$var_mobile_no) 
    {
        $data = array(
            'var_default_no' => $var_mobile_no
        );

        $this->db->where('int_glcode', $user_id);
        $this->db->update('mst_users', $data);

        return "true";  

    }

    /*----------------------------- delete alternate mobile no ------------------------ */
    public function delete_alternate_no($user_id) 
    {
        $this->db->select('int_glcode,var_mobile_no');
        $this->db->from('mst_users');
        $this->db->where('int_glcode', $user_id);
        $result = $this->db->get(); 
        $row = $result->row_array();

        $data = array(
            'var_alt_mobile' => '',
            'var_default_no' => $row['var_mobile_no']
        );

        $this->db->where('int_glcode', $user_id);
        $this->db->update('mst_users', $data);

        return "true";  

    }
    
    public function getUserWallet($user_id) 
    {
        $this->db->select('int_glcode,var_wallet');
        $this->db->from('mst_users');
        $this->db->where('int_glcode', $user_id);
        $result = $this->db->get(); 
        $row = $result->row_array();
        return $row;  

    }

    public function sendFeedback($userId,$message)
    {
        $data = array(
            'fk_user' => $userId,
            'var_name' => $this->input->post('var_name'),
            'var_message' => $message,
            'dt_createddate' => date('Y-m-d H:i:s')
        );

        $id = $this->common_model->insertRow($data, "mst_feedback");

//        $this->common_model->send_feedback_admin($this->input->post('var_name'),$this->input->post('var_email'),$message,'A');
//
//        $this->common_model->send_feedback_user($this->input->post('var_name'),$this->input->post('var_email'),$message,'U');

        return $id;
    }
    
    public function SellWithUs()
    {
        $data = array(
            'fk_user' => $this->input->post('fk_user'),
            'var_name' => $this->input->post('var_name'),
            'var_phone' => $this->input->post('var_phone'),
            'var_email' => $this->input->post('var_email'),
            'txt_description' => $this->input->post('var_message'),
            'dt_createddate' => date('Y-m-d H:i:s')
        );

        $id = $this->common_model->insertRow($data, "sell_with_us");

        return $id;
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

    public function getCartTotal($userId)
    {
        $this->db->select('COUNT(int_glcode) as tot_product');
        $this->db->from('trn_cart_details');
        $this->db->where('fk_user', $userId);
        
        $sel_query = $this->db->get();
        $sel_result = $sel_query->row_array();
        
        return $sel_result['tot_product'];
    }

    function send_msg(){
            
           $arr = array(
               'fk_user' => $_POST['fk_user'],
               'send_by' => 'U',
               'txt_msg' => $_POST['txt_msg'],
               'dt_createddate' => date('Y-m-d H:i:s')
           );
           $insert = $this->db->insert('mst_user_chat',$arr);
           
//            $this->db->select('*');
//            $this->db->where('int_glcode',$_POST['fk_user']);
//            $sql1 = $this->db->get('mst_user');
//            $res1 = $sql1->row_array();
            
         
//           $img_path = base_url();
//            $htmlContent = file_get_contents('public/email-teamplate/other_mail.php');
//            $htmlContent = str_replace("@IMG_LOGO", $img_path, $htmlContent);
//            $htmlContent = str_replace("@MSG", $message, $htmlContent);
//                   
//            $this->email->to($to);
//            $this->email->from('info@katchapp.in','KatchApp'); //info@developmentavenue.com
//            $this->email->subject($subject);
//            $this->email->message($htmlContent);
//            
//            $this->email->send();
            
//           $this->db->select('device_token');
//            $this->db->where('int_glcode','1');
//            $sql1 = $this->db->get('mst_admin');
//            $res1 = $sql1->row_array();
//            
//            $icon = base_url()."public/assets/katch_icon.png";
//            $redirect_url = base_url()."admin/user_chat";
//            $url = "https://fcm.googleapis.com/fcm/send";
//            $token = $res1['device_token'];
//            $serverKey = 'AIzaSyC0HRX0E_sg_weCoiCj239L5_zfFtcd-OI';
//            $title = "Katch Card User Support";
//            $body = $_POST['txt_msg'];
//            $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1', 'click_action' => $redirect_url, 'icon' => $icon);
//            $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
//            $json = json_encode($arrayToSend);
//            $headers = array();
//            $headers[] = 'Content-Type: application/json';
//            $headers[] = 'Authorization: key='. $serverKey;
//            $ch = curl_init();
//            curl_setopt($ch, CURLOPT_URL, $url);
//            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
//            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
//            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
//         
//            $response1 = curl_exec($ch);
//          
//            curl_close($ch);
            
           return true;
        }
        
        function get_msg(){
            
           $this->db->select('*');
           $this->db->where('fk_user',$_POST['fk_user']);
           $this->db->order_by('int_glcode','ASC');
           $res = $this->db->get('mst_user_chat');
           $row = $res->result_array();
           return $row;
        }
        
}