<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends API_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->library('mylibrary');
        $this->load->model('User_model','model');
    }

    /*------------------------------------- user signup ---------------------------------*/
    public function userSignup()
    {
        $email = $this->input->post('var_email');
        $mobile_no = $this->input->post('var_mobile_no');
        $useremail = $this->model->checkEmail($email);
        $userMobile = $this->model->checkMobileNo($mobile_no);

        if ($useremail == false) 
        {
            $response['status'] = 404;
            $response['message'] = UNIQUE_EMAIL;

        } elseif($userMobile == false) {

            $response['status'] = 404;
            $response['message'] = UNIQUE_MOBILE;

        } else {
            $userId = $this->model->addUser();
            $data = $this->model->getProfileDetalis($userId);

            if (($userId != '') || ($userId == 0)) {
            	$this->model->send_otp($userId,$data[0]['var_mobile_no']);
                $response['status'] = 200;
                $response['message'] = USER_SIGNUP;
                $response['data'] = $data;
                $response['fk_user'] = $userId;
            } else {
                $response['status'] = 404;
                $response['message'] = ADD_ERROR;
            }
            
        }

        echo (json_encode($response));
        exit;
    }

    /*--------------------------------- user edit profile -----------------------------*/
    public function userEditProfile()
    {
        $userId = $this->input->post('fk_user');
        $email = $this->input->post('var_email');
        $mobile_no = $this->input->post('var_mobile_no');
        $useremail = $this->model->checkUpdateEmail($userId,$email);
        $userMobile = $this->model->checkUpdateMobileNo($userId,$mobile_no);

        if ($useremail == false) 
        {
            $response['status'] = 404;
            $response['message'] = UNIQUE_EMAIL;

        } elseif($userMobile == false) {

            $response['status'] = 404;
            $response['message'] = UNIQUE_MOBILE;

        } else {
            $updateStatus = $this->model->updateUser($userId);

            $data = $this->model->getProfileDetalis($userId);
            if ($updateStatus == 'true') {
                $response['status'] = 200;
                $response['message'] = USER_EDIT;
                $response['data'] = $data;
            } else {
                $response['status'] = 404;
                $response['message'] = EDIT_ERROR;
            }
            
        }

        echo (json_encode($response));
        exit;
    }

    /*-------------------------------- user verify otp --------------------------- */
    public function userVerifyOTP()
    {
        $userId = $this->input->post('fk_user');
        $var_otp = $this->input->post('var_otp');
       
        if(($userId == '') || ($var_otp == '')){
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;

        } else {

            $row_arr =  $this->model->get_otp($userId,$var_otp);
            $data = $this->model->getProfileDetalis($userId);
            if (!empty($row_arr)) {
            
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

    /*------------------------------------- user login ---------------------------------*/
    public function userSignin()
    {
        if ($_POST["login_type"] == 'S') {
            $query = $this->model->user_social_login($_POST['var_username']);
            if (count($query) > 0) {
                $user_id = $query['int_glcode'];
                $data = $this->model->getProfileDetalis($user_id);
 
                $response['status'] = 200;
                $response['message'] = USER_SIGNIN;
                $response['data'] = $data;
            } else {
                $response['status'] = 404;
                $response['message'] = NO_USER;
            }
        } else {
        $var_username = $_POST['var_username'];
        $var_password = $this->mylibrary->cryptPass($_POST['var_password']);
        $device_id = $_POST['var_device_token'];
        
        if($var_username == '' || $var_password == ''){
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;

        } else {

            $query =  $this->model->user_login($var_username,$var_password);
            $user_id = $query['int_glcode'];

            if (count($query) > 0) {

                $this->model->updateDeviceId($device_id,$user_id);
                $data = $this->model->getProfileDetalis($user_id);
                if ($data[0]['chr_verify'] == 'N') {

                   $send_otp =  $this->model->send_otp($data[0]['fk_user'],$data[0]['var_mobile_no']);
                   
                } else {
                    
                }

                    $response['status'] = 200;
                    $response['message'] = USER_SIGNIN;
                    $response['data'] = $data;

            } else {
                $response['status'] = 404;
                $response['message'] = NO_USER;
            }
        }
        }
        echo (json_encode($response));
        exit;
    }

    /*------------------------------------ verify otp ----------------------------------- */
    public function verifyOTP()
    {
        $user_id = $this->input->post('fk_user');
        $var_otp = $this->input->post('var_otp');
       
        if(($user_id == '') || ($var_otp == '')){
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;

        }else{

            $row_arr =  $this->model->get_otp($user_id,$var_otp);
                
            if (!empty($row_arr)) {

                $data = $this->model->getProfileDetalis($user_id);

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

    /*--------------------------  change password  -----------------------------*/
    public function userChangePassword()
    {  
        $user_id = $_POST['fk_user'];

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

            $query = $this->model->chagePass($user_id,$old_password);
            $countmail = $query->num_rows();

            if ($countmail > 0) {

                $updateQuery = $this->model->updatePassChange($new_password,$user_id);
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

    /*------------------------------------- User Logout -------------------------------*/
    public function userLogout()
    {
        $user_id = $_POST['fk_user'];
        
        if($user_id != '')
        {
            if($this->model->user_logout($user_id))
            {
                $response['status'] = 200;
                $response['message'] = LOGOUT_USER;
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

    /*---------------------------------- get User address -------------------------*/
    public function getUserAddress()
    {
        $user_id = $_POST['fk_user'];
        
        if($user_id != '')
        {
            $data = $this->model->getUserAddress($user_id);

            if($data != ''){
                $response['status'] = 200;
                $response['message'] = GET_SUCCESS;
                $response['data'] = $data;
            }
            else {
                $response['status'] = 404;
                $response['message'] = GET_ERROR;
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

    /*---------------------------------- get User address -------------------------*/
    public function getUserDefaultAddress()
    {
        $user_id = $_POST['fk_user'];
        
        if($user_id != '')
        {
            $data = $this->model->getUserDefaultAddress($user_id);

            if($data != ''){
                $response['status'] = 200;
                $response['message'] = GET_SUCCESS;
                $response['data'] = $data;
            }
            else {
                $response['status'] = 404;
                $response['message'] = GET_ERROR;
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

    /*---------------------------------- add User address -------------------------*/
    public function addUserAddress()
    {
        $user_id = $_POST['fk_user'];
        
        if($user_id != '')
        {
            $address_id = $this->model->add_user_address($user_id);
            if($address_id != ''){
                $response['status'] = 200;
                $response['message'] = ADD_ADDRESS;
            }
            else {
                $response['status'] = 404;
                $response['message'] = ADD_ERROR;
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

    /*---------------------------------- add User address -------------------------*/
    public function updateUserAddress()
    {
        $address_id = $_POST['fk_address'];
        $fk_user = $_POST['fk_user'];

        if($fk_user != '')
        {
            $add_id = $this->model->update_user_address($fk_user,$address_id);
            if($add_id == 'true'){
                $response['status'] = 200;
                $response['message'] = UPDATE_ADDRESS;
            }
            else {
                $response['status'] = 404;
                $response['message'] = ADD_ERROR;
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

    /*---------------------------------- add User address -------------------------*/
    public function updateUserDefaultAddress()
    {
        $address_id = $_POST['fk_address'];
        $fk_user = $_POST['fk_user'];

        if(($fk_user != '') || ($address_id != ''))
        {
            $add_id = $this->model->update_user_default($fk_user,$address_id);
            if($add_id == 'true'){
                $response['status'] = 200;
                $response['message'] = UPDATE_ADDRESS;
            }
            else {
                $response['status'] = 404;
                $response['message'] = ADD_ERROR;
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

    /*---------------------------------- add User address -------------------------*/
    public function deleteUserAddress()
    {
        $address_id = $_POST['fk_address'];
        
        if($address_id != '')
        {
            $add_id = $this->model->delete_user_address($address_id);
            
            if($add_id == 'true'){
                $response['status'] = 200;
                $response['message'] = DELETE_ADDRESS;
            }
            else {
                $response['status'] = 404;
                $response['message'] = DELETE_ERROR;
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

    /*------------------------------ send user otp ------------------------------- */
    public function sendAlterMobileOTP()
    {
        $userId = $this->input->post('fk_user');
        $var_mobile = $this->input->post('alternate_mobile');

        
        if (($var_mobile == '') || ($userId == '')) {
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;
        }
        else
        {
            $send_otp =  $this->common_model->send_otp_verification($userId,$var_mobile,'mst_users');
            
            $response['status'] = 200;
            $response['message'] = SEND_OTP;
        }

        echo (json_encode($response));
        exit;
    }

    /*--------------------------- alternet mobile no update --------------------------- */
    public function updateMobileno()
    {
        $userId = $this->input->post('fk_user');
        $var_mobile_no = $this->input->post('alternate_mobile');
        $var_otp = $this->input->post('var_otp');
       
        if(($userId == '') || ($var_otp == '')){
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;

        }else{

            $row_arr =  $this->model->update_mobileno($userId,$var_mobile_no,$var_otp);
                
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

    /*--------------------------- add default mobile no. --------------------------- */
    public function addUserDefaultno()
    {
        $userId = $this->input->post('fk_user');
        $var_mobile_no = $this->input->post('var_mobile_no');
       
        if(($userId == '') || ($var_mobile_no == '')){
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;

        }else{

            $row_arr =  $this->model->add_default_mobileno($userId,$var_mobile_no);
                
            if ($row_arr == 'true') {

                $response['status'] = 200;
                $response['message'] = SET_DEFAULT;

            } else {
                $response['status'] = 404;
                $response['message'] = SET_DEFAULT_ERROR;
            }
        }
        echo (json_encode($response));
        exit;
    }

    /*--------------------------- add default mobile no. --------------------------- */
    public function deleteAlternateNo()
    {
        $userId = $this->input->post('fk_user');
       
        if($userId == ''){
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;

        }else{

            $row_arr =  $this->model->delete_alternate_no($userId);
                
            if ($row_arr == 'true') {

                $response['status'] = 200;
                $response['message'] = DELETE_RECORD;

            } else {
                $response['status'] = 404;
                $response['message'] = DELETE_ERROR;
            }
        }
        echo (json_encode($response));
        exit;
    }

    public function getUserWallet()
    {
        $userId = $this->input->post('fk_user');
       
        if($userId == ''){
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;

        }else{

            $row_arr =  $this->model->getUserWallet($userId);
                
            if (count($row_arr) > 0) {

                $response['status'] = 200;
                $response['wallet'] = $row_arr['var_wallet'];

            } else {
                $response['status'] = 404;
                $response['message'] = "Error while get wallet.";
            }
        }
        echo (json_encode($response));
        exit;
    }
    
    /*------------------------------- user forgot password --------------------------*/
    public function forgotPassword()
    {
        $var_email = $_POST['var_email'];
        $check_field = $this->model->checkForgotLink($var_email); 

        //echo $check_field; exit();

        if ($check_field == 'email') {

            $this->load->library('email');
                
            $id = $this->model->get_userid($var_email);

                $this->load->library('email');

                //SMTP & mail configuration
                $this->load->library('smtpemail');
                $config = $this->smtpemail->globalEmail();
                $this->email->initialize($config);
                $this->email->set_mailtype("html");
                $this->email->set_newline("\r\n");

                //Email content
                $img_path = base_url();
                $url = base_url().'store_user_reset_password/'.base64_encode($id);
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

        if($check_field == 'failed_data')
        {
            $response['status'] = 404;
            $response['message'] = FORGOT_MSG;
        } 

            echo (json_encode($response));
            exit;
        }


    public function userFeedback()
    {
        $userId = $this->input->post('fk_user');
        $message = $this->input->post('var_message');

        if($userId == ''){
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;

        }else{

            $row_arr =  $this->model->sendFeedback($userId,$message);
                
            if ($row_arr != '') {

                $response['status'] = 200;
                $response['message'] = USER_FEEDBACK;

            } else {
                $response['status'] = 404;
                $response['message'] = USER_FEEDBACK_FAILED;
            }
        }
        echo (json_encode($response));
        exit;
    }
    
    public function SellWithUs()
    {
        $userId = $this->input->post('fk_user');
        $message = $this->input->post('var_message');

        if($userId == ''){
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;

        }else{

            $row_arr =  $this->model->SellWithUs();
                
            if ($row_arr != '') {

                $response['status'] = 200;
                $response['message'] = "Thanks, We will contact you shortly.";

            } else {
                $response['status'] = 404;
                $response['message'] = USER_FEEDBACK_FAILED;
            }
        }
        echo (json_encode($response));
        exit;
    }

    public function userCartTotal()
    {
        $userId = $this->input->post('fk_user');
        
        $data =  $this->model->getCartTotal($userId);
            
        if ($data != '0') {

            $response['status'] = 200;
            $response['message'] = GET_SUCCESS;
            $response['cart_total'] = $data;

        } else {
            $response['status'] = 404;
            $response['message'] = GET_ERROR;
            $response['cart_total'] = '0';
        }

        echo (json_encode($response));
        exit;
    }
        
    function send_msg(){
           
            $status = $this->model->send_msg();
           
            if($status == true){
                
                $response['success'] = "1";
                $response['message'] = "Chat insert Successfully.";
            }else{
                $response['success'] = "0";
                $response['message'] = "Error while add chat.";
            }
           
        echo (json_encode($response));
        exit;
        }
        
        
        function get_msg(){
            
            $chat = $this->model->get_msg();
           
            if(count($chat) > 0){
                
                foreach($chat as $rer){
                    $rer['dt_createddate'] = $this->DateFormatter($rer['dt_createddate']);
                    $data[] = $rer;
                }
                
                $response['success'] = "1";
                $response['data'] = $data;
            }else{
                $response['success'] = "0";
                $response['message'] = "chat not found.";
            }
           
        echo (json_encode($response));
        exit;
        }
        
        function DateFormatter($date){

                $note_date = "";

                $timeStamp = strtotime($date);

                $str_time = date("Y-m-d G:i:sP", $timeStamp);
                $time = strtotime($str_time);
                $d = new DateTime($str_time);

                $weekDays = ['Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat', 'Sun'];
                $months = ['Jan', 'Feb', 'Mar', 'Apr', ' May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];

                if ($time > strtotime('-2 minutes')) {
                  $note_date = 'Just now';
                } elseif ($time > strtotime('-59 minutes')) {
                  $min_diff = floor((strtotime('now') - $time) / 60);
                 $note_date =  $min_diff . ' min' . (($min_diff != 1) ? "s" : "") . ' ago';
                } elseif ($time > strtotime('-23 hours')) {
                  $hour_diff = floor((strtotime('now') - $time) / (60 * 60));
                  $note_date =  $hour_diff . ' hour' . (($hour_diff != 1) ? "s" : "") . ' ago';
                } elseif ($time > strtotime('today')) {
                  $note_date =  $d->format('G:i');
                } elseif ($time > strtotime('yesterday')) {
                  $note_date =  'Yesterday at ' . $d->format('G:i');
                } elseif ($time > strtotime('this week')) {
                  $note_date =  $weekDays[$d->format('N') - 1] . ' at ' . $d->format('G:i');
                } else {
                  $note_date =  $d->format('j') . ' ' . $months[$d->format('n') - 1] .
                  (($d->format('Y') != date("Y")) ? $d->format(' Y') : "") .
                  ' at ' . $d->format('G:i');
                }

                return $note_date;

        }
        
}