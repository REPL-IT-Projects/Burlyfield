<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
   
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('common_model');  
        $this->userId = $_SESSION['fk_user'];      
    }

    public function getUserProfile($userId)
    {
        $this->db->select('*');
        $this->db->where('int_glcode',$userId);
        $this->db->where('chr_delete','N');
        $this->db->where('chr_publish','Y');
        $res = $this->db->get('mst_users');
        $result = $res->row_array(); 
        return $result;
    }

    public function get_user_address($uid){
        
        $this->db->select('*');
        $this->db->where('fk_user',$uid);
        $this->db->where('chr_delete','N');
        $this->db->where('chr_publish','Y');
        $res = $this->db->get('mst_user_address');
        $result = $res->result_array(); 
        return $result;
    }

    public function promocode_verify($fk_user)
    {
        $promocode = $_POST["var_promocode"];
        $total_amount = $_POST["payble_amount"];
  
        $this->db->select('*');
        $this->db->where('chr_delete', 'N');
        $this->db->where('var_promocode', $promocode);
        $query = $this->db->get('mst_promocode');
        $result = $query->row_array();
        
        $response = array();
        if (count($result) > 0) 
        {
            $this->db->select('*');
            $this->db->where('fk_user', $fk_user);
            $this->db->where('fk_promocode', $result["int_glcode"]);
            $this->db->where('flag', 'Y');
            $que1 = $this->db->get('mst_applied_promocode');
            $res = $que1->result_array();
            
            if($result["min_order"] <= $total_amount)
            {
                if (count($res) < $result["no_of_time"]) 
                {
                    if ((time() - (60 * 60 * 24)) < strtotime($result["expiry_date"])) {

                        $cal_amount = ($total_amount * $result["var_percentage"]) / 100;

                        if($cal_amount < $result["var_price"]){
                            $total = $cal_amount;
                            $payble_amount = $total_amount - $total;
                        }else{
                            $total = $result["var_price"];
                            $payble_amount = $total_amount - $total;
                        }

                        $_SESSION['promocode'] = $result['var_promocode'];
                        $_SESSION['promocode_amout'] = $total;

                        $response['promocode'] = $result["var_promocode"];
                        $response['discount_price'] = $total;
                        $response['payble_amount'] = round($payble_amount,2);
                        $response['message'] = "Promo code applied successfully";

                    } else {
                        $response['message'] = "Promo code expired";
                        $response['status'] = '1';
                    }
                } else {
                    $response['message'] = "Promo code limit over";
                    $response['status'] = '2';
                }
            } else {
                $response['message'] = "Minimum Order Amonut is Rs ".$result["min_order"];
                $response['status'] = '4';
            }
        } else {
            $response['message'] = "Invalid promo code";
            $response['status'] = '3';
        }

        //echo "<pre>"; print_r($message); exit();
        return $response;
    }

    public function add_address()
    {
        $addData = array(
            'fk_user' => $this->userId,
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
            'dt_modifydate' => date('Y-m-d H:i:s'),
            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
        );

        $id = $this->common_model->insertRow($addData, "mst_user_address");

        return $id;
    }

    public function update_address()
    {
        $addressId = $this->input->post('fk_address');

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
            'dt_modifydate' => date('Y-m-d H:i:s'),
            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
        );

        $this->common_model->updateRow('mst_user_address', $data, array("int_glcode" => $addressId));

        return true;
    }

    public function getIdByAddress($id)
    {
        $this->db->select('*');
        $this->db->from('mst_user_address');
        $this->db->where('int_glcode',$id);
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }

    /*---------------------------- update user admin ----------------------*/
    public function updateUserProfile($userId)
    {
        //echo "<pre>"; print_r($_POST); exit();
        if($_FILES['var_image']['name'] != '')
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
            $filename =  $this->input->post('hidvar_image');
        }
       
        $data = array(
            'var_name' => $this->input->post('var_name'),
            'var_image' => $filename,
            'dt_modifydate' => date('Y-m-d H:i:s'),
            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
        );

        $this->common_model->updateRow('mst_users', $data, array("int_glcode" => $userId));
        $_SESSION['user_name'] = $this->input->post('var_name');
        $_SESSION['var_image'] = base_url().'uploads/user/'.$filename;

        return TRUE;

    }

    // /*-------------------- update alternate number ---------------------------*/
    // public function updateAlternateNo($userId)
    // {
    //     if(isset($_POST['default_status']) && ($_POST['default_status'] == 'Y'))
    //     {
    //         $data = array(
    //             'var_alt_mobile' => $this->input->post('var_alt_mobile'),
    //             'var_default_no' => $this->input->post('var_alt_mobile')
    //         ); 
    //     } else {
    //         $data = array(
    //             'var_alt_mobile' => $this->input->post('var_alt_mobile')
    //         ); 
    //     }

    //     $this->common_model->updateRow('mst_users', $data, array("int_glcode" => $userId));

    //     return TRUE;
    // }

    /*--------------------- verify alternate no --------------------- */
    public function mobile_verify_otp($var_otp,$userId)
    {
        $this->db->select('int_glcode,var_otp,var_name,var_email,var_mobile_no,var_alt_mobile,var_default_no');
        $this->db->from('mst_users');
        $this->db->where('int_glcode', $userId);
        $this->db->where('var_otp', $var_otp);
        $result = $this->db->get(); 
        $row = $result->row_array();
        //echo "<pre>"; print_r($row); exit();
        if ($var_otp == $row['var_otp']) {
           
            $data = array(
                'var_alt_mobile' => $this->input->post('alternate_no')
            ); 
        
            $this->common_model->updateRow('mst_users', $data, array("int_glcode" => $userId));
            if (SMS_SERVICE == 'Y') {
                $this->load->model('mail_model');
                $this->mail_model->contact_update($row['var_name'],$row['var_email'],$this->input->post('alternate_no'));
                $this->common_model->user_order_msg($row['var_name'],$this->input->post('alternate_no'),'CONTACT_NO','');
            }
            
        }

        return $row['int_glcode'];  
    }
}