<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery_boy extends API_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->library('mylibrary');
        $this->load->model('Delivery_model','model');
    }

    /*------------------------------------- vendor login ---------------------------------*/
    public function deliveryBoyLogin()
    {
        $var_username = $_POST['var_mobile'];
        $var_password = $this->mylibrary->cryptPass($_POST['var_password']);
        $device_id = $_POST['var_device_token'];
        
        if($var_username == '' || $var_password == ''){
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;

        }else{

            $query =  $this->model->deliveryboy_login($var_username,$var_password);
            $id = $query['int_glcode'];

            if (count($query) > 0) {

                $this->model->updateDeviceId($id,$device_id);

                $query =  $this->model->viewDeliveryboyDetail($id);
                $row_arr = $query;
                //echo "<pre>"; print_r($row_arr); exit();
                // if ($row_arr['verify_status'] == 'N') {

                //    $send_otp =  $this->model->send_otp($row_arr['int_glcode'],$row_arr['var_mobile_no']);
                   
                // } else {
                    
                // }
                if ($row_arr['chr_status'] == 'B') {
                    $response['status'] = 404;
                    $response['message'] = BLOCK_BOY;
                } else {
                    //print($query); exit();
                    if ($row_arr['var_profile'] != '') {
                        $ImagePath = base_url().'uploads/deliveryboy/'.$row_arr['var_profile'];
                    } else {
                        $ImagePath = base_url().'public/assets/images/site_imges/no_image.png';
                    }

                    $data = array(
                        "fk_delivery" => $row_arr['int_glcode'],
                        "var_name" => $this->common_model->emptyVar($row_arr['var_name']),
                        "var_email" => $this->common_model->emptyVar($row_arr['var_email']),
                        "var_mobile_no" => $row_arr['var_mobile_no'],
                        "var_profile" => $ImagePath,
                        "var_device_token" => $row_arr['var_device_token']
                    );

                    $response['status'] = 200;
                    $response['message'] = LOGIN;
                    $response['data'] = $data;
                }
                
            } else {
                $response['status'] = 404;
                $response['message'] = NO_DELIVERY;
            }
        }
        
        echo (json_encode($response));
        exit;
    }

    /*------------------------------------- user signup ---------------------------------*/
    public function deliveryBoyListing()
    {
        $vendor_id = $_POST['var_vendor_id'];
        
        $data =  $this->model->getDeliveryListing($vendor_id);

        if (count($data) > 0) {
            $response['status'] = 200;
            $response['message'] = GET_SUCCESS;
            $response['data'] = $data;
        } else {
            $response['status'] = 404;
            $response['message'] = GET_ERROR;
        }

        echo (json_encode($response));
        exit;
    }

    /*------------------------------- delivery boy block unblock -------------------------*/
    public function blockUnblockDeliveryBoy()
    {
        $vendor_id = $_POST['var_vendor_id'];
        $delivery_id = $_POST['fk_delivery'];
        $chr_status = $_POST['chr_status'];

        $pass_token = $this->common_model->matchToken($vendor_id);

        if (($vendor_id == '') || ($delivery_id == '') || ($chr_status == '')) 
        {
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;
        } else {
           
            $data =  $this->model->updateStatus($delivery_id,$vendor_id,$chr_status);

            if ($chr_status == 'A') {
                $response['status'] = 200;
                $response['message'] = BLOCK;
            } else {
                $response['status'] = 200;
                $response['message'] = UNBLOCK;
            }
        }
        
        echo (json_encode($response));
        exit;
    }

    /*------------------------------------- user delivery boy ---------------------------------*/
    public function updateDeliveryBoyOTP()
    { 
        $vendorId = $_POST['var_vendor_id'];
        $var_mobile = $_POST['var_mobile'];
        $fk_delivery = $_POST['fk_delivery'];
        $aadhar = $this->model->check_image($fk_delivery);
     
        if(($aadhar['var_aadharcard'] == '') && (!isset($_POST['var_aadharcard']))){
            $response['status'] = 400;
            $response['message'] = "Please Upload Aadhar card";

        }elseif(($aadhar['var_pancard'] == '') && (!isset($_POST['var_pancard']))){

                $response['status'] = 400;
                $response['message'] = "Please Upload PAN card";

        } else {
                $this->load->model('vendor_model');
                $send_otp =  $this->vendor_model->send_otp($vendorId,$var_mobile);
                $response['status'] = 200;
                $response['message'] = SEND_OTP;
        }

        echo (json_encode($response));
        exit;
    }

    /*------------------------------------- user delivery boy ---------------------------------*/
    public function updateDeliveryBoy()
    { 
        $fk_delivery = $_POST['fk_delivery'];
        $vendorId = $_POST['var_vendor_id']; 
        $var_otp = $_POST['var_otp'];

        $otp =  $this->model->vendor_get_otp($vendorId,$var_otp);
        
        if(!empty($otp)){

            $data =  $this->model->update_delivery_boy($fk_delivery);
            $response['status'] = 200;
            $response['message'] = EDIT_SUCCESS;
            $response['data'] = $data;

        } else {

            $response['status'] = 404;
            $response['message'] = OTP_FAILED;
        }

        echo (json_encode($response));
        exit;
    }

    /*--------------------- check delivery boy is available or not ------------------------*/
    public function checkDeliverboyStatus()
    {
        $vendor_id = $_POST['var_vendor_id'];
        $fk_delivery = $_POST['fk_delivery'];
        
        $data =  $this->model->check_delivery_boy($fk_delivery);

        if ($data['current_status'] == 'F') {
            $response['status'] = 200;
            $response['message'] = FREE_BOY;
            $response['current_status'] = $data['current_status'];
        } else {
            $response['status'] = 200;
            $response['message'] = BUSY_BOY;
            $response['current_status'] = $data['current_status'];
        }

        echo (json_encode($response));
        exit;
    }

    /*--------------------- check delivery boy is available or not ------------------------*/
    public function availableDeliverboyList()
    {
        $vendor_id = $_POST['var_vendor_id'];
        
        $data =  $this->model->delivery_boy_list();

        if (count($data) > 0) {
            $response['status'] = 200;
            $response['message'] = GET_SUCCESS;
            $response['data'] = $data;
        } else {
            $response['status'] = 404;
            $response['message'] = GET_ERROR;
        }
       
        echo (json_encode($response));
        exit;
    }

    /*------------------------------------- delivery Logout -------------------------------*/
    public function deliveryBoyLogout()
    {
        $deliveryId = $_POST['fk_delivery'];
        
        if($deliveryId != '')
        {
            if($this->model->deliveryboy_logout($deliveryId))
            {
                $response['status'] = 200;
                $response['message'] = LOGOUT_SUCCESS;
            }
            else {
                $response['status'] = 404;
                $response['message'] = LOGOUT_ERROR;
            }
        }
        else
        {
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;
        }
        echo (json_encode($response));
        exit;
    }

}