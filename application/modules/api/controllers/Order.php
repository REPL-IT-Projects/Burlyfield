<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends API_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->library('mylibrary');
        $this->load->model('Order_model','model');
    }

    /*--------------------------------- vendor orders ---------------------------*/
    public function getOrders()
    {
        $vendor_id = $_POST['var_vendor_id'];
        $var_flag = $_POST['var_flag']; 

        $data =  $this->model->getOrders($vendor_id,$var_flag);

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

    public function sendUserNotification()
    {
        $deviceId = 'eLIIdMBnZCg:APA91bHxXG5BGOpuGdOsujvnGTvC4UDmqXLLtvMkLsgTJJf1bMk1SkOJJO4bEBwrjSD990AGN9wAKK0F6HnZPJa2zbQBWnrQJ56R9pKan-Knt7Ijtp_tBjVq9_WLM5rLgEZNQQTj5XAy';
        $url = 'https://fcm.googleapis.com/fcm/send';

        $target = $deviceId;

        $data['type'] = 'Receive Order';

        $data['message'] = 'You received an order !';

        $fields = array();

        $fields['data'] = $data;

        if (is_array($target)) {
            $fields['registration_ids'] = $target;
        } else {
            $fields['to'] = $target;
        }

        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . PUSH_NOTIFICATION_KEY_USER
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);

    }

    /*------------------------------- order Status Updated -------------------------*/
    public function orderStatusUpdate()
    {
        $vendor_id = $_POST['var_vendor_id'];
        $order_id = $_POST['fk_order'];
        $chr_status = $_POST['chr_status'];

        if (($vendor_id == '') || ($order_id == '') || ($chr_status == '')) 
        {
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;
        } else {

            $data =  $this->model->updateStatus($order_id,$chr_status);

            if ($chr_status == 'A') {
                $response['status'] = 200;
                $response['message'] = ACCEPT;
            } else {
                $response['status'] = 200;
                $response['message'] = REJECT;
            }
        }
        
        echo (json_encode($response));
        exit;
    }

    /*------------------------------- assign order -------------------------*/
    public function assignOrder()
    {
        $vendor_id = $_POST['var_vendor_id'];
        
        if (($vendor_id == '')) 
        {
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;
        } else {

            $data =  $this->model->assign_order($vendor_id);

            if ($data == 'true') {
                $response['status'] = 200;
                $response['message'] = ASSIGN_ORDER;
            } else {
                $response['status'] = 404;
                $response['message'] = REJECT;
            }
        }
        
        echo (json_encode($response));
        exit;
    }

    /*------------------------------- vendor order History -------------------------*/
    public function vendorOrderHistory()
    {
        $vendor_id = $_POST['var_vendor_id'];
        $var_flag = $_POST['var_flag'];

        if (($vendor_id == '')) 
        {
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;
        } else {

            $data =  $this->model->getOrderHistory($vendor_id,$var_flag);
            
            if (count($data) > 0) {
                $response['status'] = 200;
                $response['message'] = GET_SUCCESS;
                $response['data'] = $data;
            } else {
                $response['status'] = 404;
                $response['message'] = GET_ERROR;
            }
        }
        
        echo (json_encode($response));
        exit;
    }


    /*------------------------------- vendor order report -------------------------*/
    public function vendorOrderReport()
    {
        $vendor_id = $_POST['var_vendor_id'];
        
        if (($vendor_id == '')) 
        {
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;
        } else {

            $data =  $this->model->getOrderReport($vendor_id);

            if (count($data) > 0) {
                $response['status'] = 200;
                $response['message'] = GET_SUCCESS;
                $response['data'] = $data;
            } else {
                $response['status'] = 404;
                $response['message'] = GET_ERROR;
            }
        }
        
        echo (json_encode($response));
        exit;
    }

    /*------------------------------- deliveryboy orders -------------------------*/
    public function deliveryboyOrders()
    {
        $vendor_id = $_POST['var_vendor_id'];
        $fk_delivery = $_POST['fk_delivery'];
        
        if (($vendor_id == '') || ($fk_delivery == '')) 
        {
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;
        } else {

            $current_data = $this->model->getDCurrentOrders($fk_delivery);
            $complete_data = $this->model->getDCompleteOrders($fk_delivery);

            if ((count($current_data) > 0) || (count($complete_data) > 0)) {
                $response['status'] = 200;
                $response['message'] = GET_SUCCESS;
                $response['current_orders'] = $current_data;
                $response['complete_orders'] = $complete_data;
            } else {
                $response['status'] = 404;
                $response['message'] = GET_ERROR;
            }
        }
        
        echo (json_encode($response));
        exit;
    }

    /*--------------------------- deliveryboy list orders ---------------------*/
    public function getDeliveryboyOrders()
    {
        $fk_delivery = $_POST['fk_delivery'];
        
        if ($fk_delivery == '')
        {
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;
        } else {

            $data = $this->model->getDeliveryOrders($fk_delivery);
            
            if (count($data) > 0) {

                $response['status'] = 200;
                $response['message'] = GET_SUCCESS;
                $response['data'] = $data;

            } else {

                $response['status'] = 404;
                $response['message'] = GET_ERROR;
            }
        }
        
        echo (json_encode($response));
        exit;
    }

    /*------------------------------- deliveryboy update orders -------------------------*/
    public function deliveryboyUpdateOrder()
    {
        $fk_delivery = $_POST['fk_delivery'];
        $order_id = $_POST['fk_order'];
        
        if (($fk_delivery == '') || ($order_id == '')) 
        {
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;
        } else {

            $data = $this->model->updateOrder($order_id);
            
            if ($data == 'true') {
                $response['status'] = 200;
                $response['message'] = UPDATE_ORDER;
            } else {
                $response['status'] = 404;
                $response['message'] = EDIT_ERROR;
            }
        }
        
        echo (json_encode($response));
        exit;
    }

    /*------------------------------ send user otp ------------------------------- */
    public function sendUserOTP()
    {
        $userId = $this->input->post('fk_user');
        $var_mobile = $this->input->post('var_mobile_no');

        $check_mobile = $this->model->checkMobileNo($userId,$var_mobile);
        if (($var_mobile == '') || ($userId == '')) {
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;
        }
        else
        {
            if ($var_mobile != $check_mobile) {
                $response['status'] = 404;
                $response['message'] = REGISTERD_MOBILE;
            } else {

                $send_otp =  $this->common_model->send_otp_verification($userId,$var_mobile,'mst_users');
                
                $response['status'] = 200;
                $response['message'] = SEND_OTP;
            }
        }

        echo (json_encode($response));
        exit;
    }

    /*------------------------------ verify user otp ------------------------------- */
    public function verifyDeliveryboyOrderOTP()
    {
        $userId = $this->input->post('fk_user');
        $var_otp = $this->input->post('var_otp');

        if(($userId == '') || ($var_otp == '')){
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;

        }else{

            $row_arr =  $this->model->get_otp($userId,$var_otp);
                
            if (count($row_arr) > 0) {

                $response['status'] = 200;
                $response['message'] = OTP_VERIFY;

            } else {
                $response['status'] = 404;
                $response['message'] = OTP_FAILED;
            }
        }

        echo (json_encode($response));
        exit;
    }

}