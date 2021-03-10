<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends API_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->library('mylibrary');
        $this->load->model('Vendor_model','model');
    }

    public function demo()
    {
        phpinfo(); exit();
    }

    /*------------------------------------- vendor login ---------------------------------*/
    public function vendorLogin()
    {
        header('Content-Type: application/json');

        $var_username = $_POST['var_username'];
        $var_password = $this->mylibrary->cryptPass($_POST['var_password']);
        $device_id = $_POST['var_device_token'];
        
        if($var_username == '' || $var_password == ''){
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;

        }else{

            $query =  $this->model->vendor_login($var_username,$var_password);
            $vendor_id = $query['int_glcode'];

            if (count($query) > 0) {

                $this->model->updateDeviceId($vendor_id,$device_id);
                $this->common_model->generateToken($vendor_id);
                $query =  $this->model->viewVendorDetail($vendor_id);
                $row_arr = $query;
                //echo "<pre>"; print_r($row_arr); exit();
                if ($row_arr['verify_status'] == 'N') {

                   $send_otp =  $this->model->send_otp($row_arr['int_glcode'],$row_arr['var_mobile_no']);
                   
                } else {
                    
                }

                //print($query); exit();
                    if ($row_arr['var_image'] != '') {
                        $ImagePath = base_url().'uploads/vendor/'.$row_arr['var_image'];
                    } else {
                        $ImagePath = base_url().'public/assets/images/site_imges/no_image.png';
                    }

                    if ($row_arr['dt_startdate'] != '0000-00-00') {
                        $start_date = $row_arr['dt_startdate'];
                    } else {
                        $start_date = '';
                    }

                    if ($row_arr['dt_enddate'] != '0000-00-00') {
                        $end_date = $row_arr['dt_enddate'];
                    } else {
                        $end_date = '';
                    }

                    $data = array(
                        "int_glcode" => $row_arr['int_glcode'],
                        "var_name" => $this->common_model->emptyVar($row_arr['var_name']),
                        "var_username" => $row_arr['var_username'],
                        "var_mobile_no" => $row_arr['var_mobile_no'],
                        "var_email" => $this->common_model->emptyVar($row_arr['var_email']),
                        "var_auth_token" => $row_arr['var_auth_token'],
                        "var_image" => $ImagePath,
                        "var_address" => $row_arr['var_address'],
                        "var_latitude" => $row_arr['var_latitude'],
                        "var_longitude" => $row_arr['var_longitude'],
                        "verify_status" => $row_arr['verify_status'],
                        "var_alt_mobile" => $row_arr['var_alt_mobile'],
                        "var_membership_type" => $row_arr['var_membership_type'],
                        "var_commission_value" => $row_arr['var_commission_value'],
                        "dt_startdate" => $start_date,
                        "dt_enddate" => $end_date,
                        "dt_createddate" => $row_arr['dt_createddate'],
                        "var_device_token" => $row_arr['var_device_token']
                    );

                    $response['status'] = 200;
                    $response['message'] = SIGNIN;
                    $response['data'] = $data;

            } else {
                $response['status'] = 404;
                $response['message'] = NO_VENDOR;
            }
        }
        
        echo (json_encode($response));
        exit;
    }

    /*------------------------------------ send otp ----------------------------------- */
    public function sendOTP()
    {
        header('Content-Type: application/json');

        $vendorId = $this->input->post('var_vendor_id');
        $var_mobile = $this->input->post('var_mobile_no');

        $check_mobile = $this->model->checkMobileNo($vendorId,$var_mobile);
        if (($vendorId == '') || ($var_mobile == '')) {
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;
        }
        else
        {
            if ($var_mobile != $check_mobile) {
                $response['status'] = 404;
                $response['message'] = REGISTERD_MOBILE;
            } else {

                $send_otp =  $this->model->send_otp($vendorId,$var_mobile);
                
                $response['status'] = 200;
                $response['message'] = SEND_OTP;
            }
        }

        echo (json_encode($response));
        exit;
    }

    /*------------------------------------ verify otp ----------------------------------- */
    public function verifyOTP()
    {
        header('Content-Type: application/json');

        $vendorId = $this->input->post('var_vendor_id');
        $var_otp = $this->input->post('var_otp');
       
        if(($vendorId == '') || ($var_otp == '')){
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;

        }else{

            $row_arr =  $this->model->get_otp($vendorId,$var_otp);
                
            if (count($row_arr) > 0) {

                if ($row_arr['var_image'] != '') {
                    $ImagePath = base_url().'uploads/vendor/'.$row_arr['var_image'];
                } else {
                    $ImagePath = "N/A";
                }

                if ($row_arr['dt_startdate'] != '0000-00-00') {
                    $start_date = $row_arr['dt_startdate'];
                } else {
                    $start_date = '';
                }

                if ($row_arr['dt_enddate'] != '0000-00-00') {
                    $end_date = $row_arr['dt_enddate'];
                } else {
                    $end_date = '';
                }
                
                $data = array(
                    "int_glcode" => $row_arr['int_glcode'],
                    "var_name" => $this->common_model->emptyVar($row_arr['var_name']),
                    "var_username" => $row_arr['var_username'],
                    "var_mobile_no" => $row_arr['var_mobile_no'],
                    "var_email" => $this->common_model->emptyVar($row_arr['var_email']),
                    "var_auth_token" => $row_arr['var_auth_token'],
                    "var_image" => $ImagePath,
                    "var_address" => $row_arr['var_address'],
                    "var_latitude" => $row_arr['var_latitude'],
                    "var_longitude" => $row_arr['var_longitude'],
                    "verify_status" => $row_arr['verify_status'],
                    "var_alt_mobile" => $row_arr['var_alt_mobile'],
                    "var_membership_type" => $row_arr['var_membership_type'],
                    "var_commission_value" => $row_arr['var_commission_value'],
                    "dt_startdate" => $start_date,
                    "dt_enddate" => $end_date,
                    "dt_createddate" => $row_arr['dt_createddate'],
                    "var_device_token" => $row_arr['var_device_token']
                );

                $response['status'] = 200;
                $response['message'] = OTP_VERIFY;
                $response['data'] = $data;

            } else {
                $response['status'] = 404;
                $response['message'] = OTP_FAILED;
            }
        }
        echo (json_encode($response));
        exit;
    }

    /*------------------------------------ verify otp ----------------------------------- */
    public function updateOTP()
    {
        $vendorId = $this->input->post('var_vendor_id');
        $var_mobile_no = $this->input->post('var_mobile_no');
        $var_otp = $this->input->post('var_otp');
       
        if(($vendorId == '') || ($var_otp == '')){
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;

        }else{

            $row_arr =  $this->model->update_otp($vendorId,$var_mobile_no,$var_otp);
                
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

    /*-------------------------------- vendor update api -------------------------*/
    public function updateVendorProfile()
    {
        $vendorId = $_POST['var_vendor_id'];
        $check_email = $this->model->checkUpdateEmail($_POST['var_email'],$vendorId);

        if ($check_email == false) {
            $response['status'] = 404;
            $response['message'] = UNIQUE_EMAIL; 
        } else {

            $this->model->updateVendor($vendorId);
            $data = $this->model->viewVendorProfile($vendorId);
            
            $response['status'] = 200;
            $response['message'] = EDIT_SUCCESS;
            $response['data'] = $data;
        }
   
        echo (json_encode($response));
        exit;
    }

    /*--------------------------  change password  -----------------------------*/
    public function vendorChangePassword()
    {
        $vendor_id = $_POST['var_vendor_id'];
        
        $old_password = $this->mylibrary->cryptPass($_POST['old_password']);
        $new_password = $this->mylibrary->cryptPass($_POST['new_password']);

        if($old_password == '' || $new_password == ''){
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;

        }else if($old_password == $new_password){

            $response['status'] = 404;
            $response['message'] = SAME_PASSWORD;
        }
        else{

            $query = $this->model->chagePass($vendor_id,$old_password);
            $countmail = $query->num_rows();

            if ($countmail > 0) {

                $updateQuery = $this->model->updatePassChange($new_password,$vendor_id);
                $response['status'] = 200;
                $response['userdata'] = CHANGE_PASS;

            }else {

                $response['status'] = 404;
                $response['message'] = OLD_PASSWORD;
            }
        }

        echo(json_encode($response));
        exit;
    }

    /*------------------------------------- add delivery boy -------------------------------*/
    public function addDeliveryBoy()
    {
        //echo "<pre>"; print_r($_FILES); exit();
        $vendor_id = $_POST['var_vendor_id'];
        
        $check_email = $this->model->checkDEmail($_POST['var_email']);
        $check_mobile = $this->model->checkDMobile($_POST['var_mobile_no']);
        
        if ((!isset($_FILES['var_aadharcard']))) {
            $response['status'] = 400;
            $response['message'] = "Please Upload Aadhar card";
        } elseif (!isset($_FILES['var_pancard'])) {
            $response['status'] = 400;
            $response['message'] = "Please Upload PAN card";
        } else {
            if ($check_email == false) {
                $response['status'] = 404;
                $response['message'] = UNIQUE_EMAIL; 
            } elseif ($check_mobile == false) {
                $response['status'] = 404;
                $response['message'] = UNIQUE_MOBILE; 
            } else {
                    $data = $this->model->add_delivery_boy();
                    $response['status'] = 200;
                    $response['message'] = ADD_SUCCESS;
            }
        }
            
            
        echo (json_encode($response));
        exit;
    }

    /*------------------------------------- User Logout -------------------------------*/
    public function vendorLogout()
    {
        $vendor_id = $_POST['var_vendor_id'];
        
        if($vendor_id != '')
        {
            if($this->model->vendor_logout($vendor_id))
            {
                $response['status'] = 200;
                $response['message'] = LOGOUT;
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

    /*------------------------------- vendor get product list --------------------------*/
    public function productList()
    {
        $vendor_id = $_POST['var_vendor_id'];
        
        if(($vendor_id != ''))
        {
            $data = $this->model->getProductList($vendor_id);
            $response['status'] = 200;
            $response['message'] = GET_SUCCESS;
            $response['data'] = $data;

        } else {
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;
        }
        echo (json_encode($response));
        exit;
    }

    /*------------------------------- vendor get product list --------------------------*/
    public function stockUpdate()
    {
        $vendor_id = $_POST['var_vendor_id'];
        $fk_product = $_POST['fk_product'];
        $chr_status = $_POST['chr_status'];
        
        if(($vendor_id != '') || ($fk_product != '') || ($chr_status != ''))
        {
            $data = $this->model->updateStock($vendor_id,$fk_product,$chr_status);
            $response['status'] = 200;
            $response['message'] = STOCK_UPDATE;
        } else {
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;
        }

        echo (json_encode($response));
        exit;
    }

    /*------------------------------- vendor forgot password --------------------------*/
    public function forgotPassword()
    {
        $var_email = $_POST['var_email'];
        $check_field = $this->model->checkForgotLink($var_email); 

        //echo $check_field; exit();

        if ($check_field == 'email') {

            $this->load->library('email');
                
            $id = $this->model->get_vendorid($var_email);

                $this->load->library('email');

                //SMTP & mail configuration
                $this->load->library('smtpemail');
                $config = $this->smtpemail->globalEmail();
                $this->email->initialize($config);
                $this->email->set_mailtype("html");
                $this->email->set_newline("\r\n");

                //Email content
                $img_path = base_url();
                $url = base_url().'stor_rereset_password/'.base64_encode($id);
                $htmlContent = file_get_contents('public/templates/forgot.php');
                $htmlContent = str_replace("@IMG_LOGO", $img_path, $htmlContent);
                $htmlContent = str_replace("@BTN_URL", $url, $htmlContent);
                $this->email->to($var_email);
                $this->email->from(FROM_EMAIL,'Vruits');
                $this->email->subject('Forgot Password');
                $this->email->message($htmlContent);

                //Send email
            
                if ($this->email->send()) {
                    $updateTimeStamp = $this->model->updateTimeStamp($var_email);
                    $response['status'] = 200;
                    $response['message'] = FORGOT_MSG_SUCCESS;
                } else {
                    $response['status'] = 404;
                    $response['message'] = MAIL_FAILED;
                }
            } 

            if ($check_field == 'mobile_no') {

                $user_id = $this->model->get_username_id($_POST['var_email']);
                $user = base64_encode($user_id);
                //echo $user_id; exit();
                $url = base_url().'store_user_reset_password/'.$user;

                $var_name = $this->model->get_user_name($_POST['var_email']);
                $this->common_model->user_forgot_password($var_name,$url,$_POST['var_email']);

                $response['status'] = 200;
                $response['message'] = FORGOT_MSG_SUCCESS;
                //exit();
            }

            if($check_field == 'failed_data'){
                $response['status'] = 404;
                $response['message'] = FORGOT_MSG;
            }

            echo (json_encode($response));
            exit;
        }

    /*----------------------- order rejection reasons ----------------- */
    public function orderRejectionReasons()
    {
        $data =  $this->common_model->getRecord(array('int_glcode','var_title'),'mst_order_reject_reason');
                
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

    /*----------------------- delete delivery boy ----------------- */
    public function deleteDeliveryBoy()
    {
        $delivery_id = $_POST['fk_delivery'];
        
        if($delivery_id != '')
        {
            $delete_data = $this->model->delete_delivery_boy($delivery_id);

            if($delete_data == 'true')
            {
                $response['status'] = 200;
                $response['message'] = DELETE_RECORD;
            } else {
                $response['status'] = 404;
                $response['message'] = DELETE_ERROR;
            }
        } else {
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;

        }

        echo (json_encode($response));
        exit;
    }

    public function VendorList()
    {
        $data =  $this->model->VendorList();
                
        if (count($data) > 0) {
            
            foreach ($data as $res){
                
                $res['var_image'] = base_url().'uploads/vendor/'.$res['var_image'];
                $datanew[] = $res;
                
            }

            $response['status'] = 200;
            $response['message'] = GET_SUCCESS;
            $response['data'] = $datanew;

        } else {
            $response['status'] = 404;
            $response['message'] = GET_ERROR;
        }
        echo (json_encode($response));
        exit;
    }
    
}