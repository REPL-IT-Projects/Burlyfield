<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_model extends CI_Model {

    public function __construct() {

        parent::__construct();

        $this->load->database();

        $this->load->model('common_model');
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
    
    public function VendorList()
    {
        $this->db->select('int_glcode,var_name,var_mobile_no,var_alt_mobile,var_email,var_username,var_address,var_image');
        $this->db->from('mst_vendors');
        $this->db->where('chr_delete','N');
        $this->db->where('chr_publish','Y');
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }

   
    /*--------------------------- get users list ------------------------------*/
    public function viewUser()
    {
        $this->db->select('int_glcode,var_name,var_email,var_role,var_profile_image,dt_bod,chr_device,var_registertype,chr_publish,chr_delete,dt_createddate');
        $this->db->from('mst_user');
        $this->db->where('chr_delete','N');
        $this->db->order_by("int_glcode", "desc");
        $query = $this->db->get();
        $row = $query->result_array();

        $row_arr = array();

        foreach ($row as $value) {

            $value['last_finish_date'] = $this->lastFinishedAlbum($value['int_glcode']);

            $value['activity_date'] = $this->userLastActivity($value['int_glcode']);

            $value['no_of_finish_album'] = $this->totalFinishAlbum($value['int_glcode']);

            $row_arr[] = $value;

        }
        
        return $row_arr;
    }

    /*--------------------------- get vendor details ---------------------------------*/
    public function viewVendorDetail($id)
    {
        $this->db->select('*');
        $this->db->from('mst_vendors');
        $this->db->where('int_glcode',$id);
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->row_array();
        return $row;
    }

    /////////////////////////// update time stamp ////////////////////////////
    public function updateTimeStamp($email)
    {
        $time_stamp = time();
        $this->db->set('dt_timestamp', $time_stamp); 
        $this->db->where('var_email', $email);   
        $this->db->update('mst_vendors'); 
    }

    /*---------------------------- get vendor profile ---------------------------*/
    public function viewVendorProfile($vendorId)
    {
        $this->db->select('int_glcode,var_name,var_username,var_image,var_address,var_latitude,var_longitude');
        $this->db->from('mst_vendors');
        $this->db->where('int_glcode',$vendorId);
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();

        $data = array();

        foreach ($row as $key => $value) {
            if ($value['var_image'] != '') {
                $value['var_image'] = base_url().'uploads/vendor/'.$value['var_image'];
            } else {
                $value['var_image'] = base_url().'public/assets/images/site_imges/no_image.png';
            }

            $data = $value;
        }

        return $data;
    }

    /*--------------------------- update vendor ---------------------------*/
    public function updateVendor($vendorId)
    {
        
        if(isset($_FILES['var_image']['name']))
        { 
            if (!is_dir('uploads/vendor')) {
                    mkdir('uploads/vendor', 0777, TRUE);
                }
                $filename = time().'_'.$_FILES['var_image']['name'];
                $filename = str_replace('&', "_", $filename);
                $filename = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename);
                $destination = 'uploads/vendor/';
                move_uploaded_file($_FILES['var_image']['tmp_name'],$destination.$filename);
            } else {
                $this->db->select('var_image');
                $this->db->where('int_glcode',$vendorId);
                $sql = $this->db->get('mst_vendors');
                $res = $sql->row_array();
                $filename =  $res['var_image'];
            }

        $data = array(
            'var_name' => $this->input->post('var_name'),
            'var_email' => $this->input->post('var_email'),
            'var_username' => $this->input->post('var_username'),
            'var_image' => $filename,
            'var_address' => $this->input->post('var_address'),
            'var_latitude' => $this->input->post('var_latitude'),
            'var_longitude' => $this->input->post('var_longitude'),
            'dt_modifydate' => date('Y-m-d H:i:s'),
            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
        );

        $this->common_model->updateRow('mst_vendors', $data, array("int_glcode" => $vendorId)); 
        return TRUE;

    }

    /*--------------------- vendor logout  --------------------*/
    public function vendor_logout($vendorId)
    {
        $data = array(
            'var_device_token' => '',
            'var_auth_token' => ''    
        );

        $this->common_model->updateRow('mst_vendors', $data, array("int_glcode" => $vendorId)); 
        return TRUE;
    }

    /*---------------------  check email already exit or not --------------------*/
    public function checkEmail($eaddress)
    {
        $select = "select * from mst_vendors where chr_delete = 'N' and var_email = '".$eaddress."'";
        $result = $this->db->query($select);
        $count = $result->num_rows();
        if($count > 0){
            return false;
        }else{
            return true;
        }
    }

    /*---------------------  check email already exit or not --------------------*/
    public function checkUpdateEmail($eaddress,$vendorId)
    {
        $select = "select * from mst_vendors where chr_delete = 'N' and var_email = '".$eaddress."' AND int_glcode NOT IN ('".$vendorId."')";
        $result = $this->db->query($select);
        $count = $result->num_rows();
        if($count > 0){
            return false;
        }else{
            return true;
        }
    }

    public function get_vendorid($eaddress)
    {
        $select = "select int_glcode from mst_vendors where chr_delete = 'N' and var_email = '".$eaddress."'";
        $result = $this->db->query($select);
        $data = $result->row_array();
        return $data['int_glcode'];
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
        $select = "select * from mst_user where chr_delete = 'N' and var_email = '".$email."' and int_glcode != '".$userId."'";
        $result = $this->db->query($select);
        $count = $result->num_rows();
        if($count > 0){
            return false;
        }else{
            return true;
        }
    }

    /*----------------------- vendor login API -------------------------*/
    public function vendor_login($username,$password)
    {
        $this->db->select('*');
        $this->db->from('mst_vendors');
        $this->db->where('var_mobile_no',$username);
        $this->db->where('var_password', $password);
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();

        //echo $this->db->last_query(); exit();
        $row = $query->row_array();

        return $row;
    }

    public function checkMobileNo($vendor_id,$var_mobile)
    {
        $this->db->select('int_glcode,var_mobile_no');
        $this->db->from('mst_vendors');
        $this->db->where('int_glcode',$vendor_id);
        $this->db->where('var_mobile_no', $var_mobile);
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();

        //echo $this->db->last_query(); exit();
        $row = $query->row_array();

        return $row['var_mobile_no'];
    }

    /*------------------------------- get otp --------------------------- */
    public function send_otp($vendor_id,$var_mobile) 
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
        //  echo "cURL Error #:" . $err;
        } else {
        //  echo $response;
        }
      //  exit();
        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //   CURLOPT_URL => "http://sms.sandeshbharat.in/rest/services/sendSMS/sendGroupSms?AUTH_KEY=faa3dc9681f4633c32ae45bc842284a3",
        //   CURLOPT_RETURNTRANSFER => true,
        //   CURLOPT_ENCODING => "",
        //   CURLOPT_MAXREDIRS => 10,
        //   CURLOPT_TIMEOUT => 30,
        //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //   CURLOPT_CUSTOMREQUEST => "POST",
        //   CURLOPT_POSTFIELDS => "{\"smsContent\":\"Your OTP Verification Code is : $OTP\",\"routeId\":\"1\",\"mobileNumbers\":\"$var_mobile\",\"senderId\":\"vruits\",\"smsContentType\":\"english\"}",
        //   CURLOPT_HTTPHEADER => array(
        //     "Cache-Control: no-cache",
        //     "Content-Type: application/json"
        //   ),
        // ));

        // $response = curl_exec($curl);
        // $err = curl_error($curl);

        // curl_close($curl);

        // if ($err) {
        //   //echo "cURL Error #:" . $err;
        // } else {
        //   //echo $response;
        // }

        $data = array(
            'var_otp' => $OTP,
        );

        $this->db->where('int_glcode', $vendor_id);
        $this->db->update('mst_vendors', $data);

        return TRUE;  

    }

    /*------------------------------- get otp --------------------------- */
    public function get_otp($vendor_id,$var_otp) 
    {
        $this->db->select('*');
        $this->db->from('mst_vendors');
        $this->db->where('int_glcode', $vendor_id);
        $this->db->where('var_otp', $var_otp);
        $result = $this->db->get(); 
        $row = $result->row_array();

        if ($var_otp == $row['var_otp']) {
            $data = array(
                'verify_status' => 'Y'
            );

            $this->db->where('int_glcode', $vendor_id);
            $this->db->update('mst_vendors', $data);

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
    public function updateDeviceId($vendorId,$deviceId)
    {
        $this->db->set('var_device_token', $deviceId);
        $this->db->where('int_glcode',$vendorId);
        $this->db->update('mst_vendors');
        return true;
    }

    /*----------------------- change password ---------------------------*/
    public function chagePass($vendorId,$pass)
    {
        $this->db->select('int_glcode');
        $this->db->from('mst_vendors');
        $this->db->where('int_glcode',$vendorId);
        $this->db->where('var_password',$pass);
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
    public function updatePassChange($newpass,$vendorId)
    {
        $this->db->set('var_password', $newpass); 
        $this->db->where('int_glcode', $vendorId);   
        $this->db->update('mst_vendors'); 
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
        if(isset($_FILES['var_aadharcard']['name']))
        {
            if (!is_dir('uploads/deliveryboy_docs')) {
                mkdir('uploads/deliveryboy_docs', 0777, TRUE);
            }
                $filename = time().'_'.$_FILES['var_aadharcard']['name'];
                $filename = str_replace('&', "_", $filename);
                $filename = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename);
                $destination = 'uploads/deliveryboy_docs/';
                move_uploaded_file($_FILES['var_aadharcard']['tmp_name'],$destination.$filename);
        } else {
            $filename =  '';
        }

        if(isset($_FILES['var_aadharcard1']['name']))
        {
            if (!is_dir('uploads/deliveryboy_docs')) {
                mkdir('uploads/deliveryboy_docs', 0777, TRUE);
            }
                $filename1 = time().'_'.$_FILES['var_aadharcard1']['name'];
                $filename1 = str_replace('&', "_", $filename1);
                $filename1 = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename1);
                $destination = 'uploads/deliveryboy_docs/';
                move_uploaded_file($_FILES['var_aadharcard1']['tmp_name'],$destination.$filename1);
        } else {
            $filename1 =  '';
        }

        if(isset($_FILES['var_pancard']['name']))
        {
            if (!is_dir('uploads/deliveryboy_docs')) {
                mkdir('uploads/deliveryboy_docs', 0777, TRUE);
            }
                $pan_card = time().'_'.$_FILES['var_pancard']['name'];
                $pan_card = str_replace('&', "_", $pan_card);
                $pan_card = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $pan_card);
                $destination = 'uploads/deliveryboy_docs/';
                move_uploaded_file($_FILES['var_pancard']['tmp_name'],$destination.$pan_card);
        } else {
            $pan_card =  '';
        }

        $data = array(
            'fk_vendor' => $this->input->post('var_vendor_id'),
            'var_name' => $this->input->post('var_name'),
            'var_email' => $this->input->post('var_email'),
            'var_mobile_no' => $this->input->post('var_mobile_no'),
            'var_password' => $this->mylibrary->cryptPass($this->input->post('var_password')),
            'var_aadharcard' => $filename,
            'var_aadharcard2' => $filename1,
            'var_pancard' => $pan_card,
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

    /*----------------------------- vendor product list -------------------------*/
    public function getProductList($vendorId)
    {
        $this->db->select('p.int_glcode as fk_product,p.var_title,p.var_quantity,ts.int_glcode as stock_id,ts.fk_vendor,IFNULL(ts.chr_status,"I") AS stock_status');
        $this->db->from('mst_products p');
        $this->db->where('p.chr_publish','Y');
        $this->db->where('p.chr_delete','N');
        $this->db->group_start();
        $this->db->where('ts.fk_vendor',$vendorId);
        $this->db->or_where('ts.fk_vendor',NULL);
        $this->db->group_end();
        $this->db->join('trn_product_stock ts', 'ts.fk_product = p.int_glcode', 'left');
        $query = $this->db->get();
        //echo $this->db->last_query(); exit();
        $row = $query->result_array();  

        $data = array();

        foreach ($row as $key => $value) {
            $val['fk_product'] = $value['fk_product'];
            $val['var_title'] = $value['var_title'];
            $val['var_quantity'] = $value['var_quantity'];
            $val['stock_status'] = $value['stock_status'];

            $data[] = $val;
        }

        return $data;
    }

    /*----------------------------- vendor stock update list -------------------------*/
    public function updateStock($vendorId,$productId,$status)
    {
        $select = "SELECT int_glcode FROM trn_product_stock WHERE fk_vendor = '".$vendorId."' AND fk_product = '".$productId."'";
        //echo $select; exit();
        $result = $this->db->query($select);
        $row = $result->row_array();

        if (!empty($row)) {

            $this->db->set('chr_status', $status); //value that used to update column  
            $this->db->where('fk_vendor', $vendorId); //which row want to upgrade  
            $this->db->where('fk_product', $productId); //which row want to upgrade  
            $this->db->update('trn_product_stock');

        } else {

            $add_data = array(
                'fk_vendor' => $vendorId,
                'fk_product' => $productId,
                'chr_status' => $status,
                'dt_createddate' => date('Y-m-d H:i:s'),
                'dt_modifydate' => date('Y-m-d H:i:s')
            );

            $this->common_model->insertRow($add_data, "trn_product_stock");
        }

        return TRUE;
    }

    /*-------------------------- delte deliveryboy -------------------------*/
    public function delete_delivery_boy($deliveryId)
    {
        $data = array(
            'chr_delete' => 'Y'
        );

        $this->db->where('int_glcode', $deliveryId);
        $this->db->update("mst_delivery_boy",$data);

        return "true";
    }

    public function get_user_name($var_mobile)
    {
        $select = "select var_name from mst_vendors where chr_delete = 'N' and var_mobile_no = '".$var_mobile."'";
        $result = $this->db->query($select);
        $data = $result->row_array();
        return $data['var_name'];
    }

    public function get_username_id($mobile)
    {
        $select = "select int_glcode from mst_vendors where chr_delete = 'N' and var_mobile_no = '".$mobile."'";
        $result = $this->db->query($select);
        $data = $result->row_array();
        return $data['int_glcode'];
    }

    public function checkForgotLink($var_email)
    {
        $select = "select int_glcode from mst_vendors where chr_delete = 'N' and var_mobile_no = '".$var_email."'";
        $result = $this->db->query($select);
        $data = $result->row_array();

        if (!empty($data)) {
            $get_res = 'mobile_no';
            
        }

        $select1 = "select int_glcode from mst_vendors where chr_delete = 'N' and var_email = '".$var_email."'";
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

}