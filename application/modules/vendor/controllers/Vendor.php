<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends MY_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->database();
		$this->load->library(array('session','form_validation','mylibrary','email'));
		$this->load->helper(array('form'));
		$this->load->model('Vendor_Model','model');
	}

	public function index()
	{
		$this->load->view('login');
	}
	
        
	public function vendor_signin()
	{
            $var_username = $_POST['var_mobile_no'];
            $var_password = $this->mylibrary->cryptPass($_POST['password']);

            $query =  $this->model->user_login($var_username,$var_password);
            $user_id = $query['int_glcode'];

                if (count($query) > 0) {

                    $data = $this->model->getProfileDetalis($user_id);
                    if ($data['verify_status'] == 'N') {

                       $send_otp =  $this->common_model->send_otp_verification($data['fk_user'],$data['var_mobile_no'],'mst_vendors');
                       $fk_user = $data['fk_user'];
                       echo "otp_verify#".$fk_user;
                       exit();
                    } else {

                    }

                } else {
                    echo "failed";
                    exit();
                }
	}

    ////////////////////////////////// forgot password /////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////
	public function vendor_verify_otp()
	{ 
		if ($this->input->post('fk_user') != '') {
			$userId = $this->input->post('fk_user');
		} else {
			$userId = $this->input->post('fk_user_get_id');
		}
		
		$var_otp = $this->input->post('var_otp');

		$verify_status = $this->model->get_otp($userId,$var_otp);

		echo $verify_status;
		exit();
	}

	public function resend_otp()
	{ 
		if ($this->input->get('fk_user') != '') {
			$user_id = $this->input->get('fk_user');
		} else {
			$user_id = $this->input->get('fk_user_get_id');
		}
		
		$mobile_no = $this->input->get('mobile_no');
        //echo $mobile_no; exit();
		$this->common_model->send_otp_verification($user_id,$mobile_no,'mst_vendors');

		echo "true";
		exit();
	}

	public function vendorForgotPassword()
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
                $url = base_url().'store_vendor_reset_password/'.base64_encode($id);
                $htmlContent = file_get_contents('public/templates/vendor_forgot.php');
                $htmlContent = str_replace("@IMG_LOGO", $img_path, $htmlContent);
                $htmlContent = str_replace("@BTN_URL", $url, $htmlContent);
                $this->email->to($var_email);
                $this->email->from(FROM_EMAIL);
                $this->email->subject('Forgot Password');
                $this->email->message($htmlContent);

                //Send email
                
                if ($this->email->send()) {
                    $updateTimeStamp = $this->model->updateTimeStamp($var_email);
                    echo "success";
                    //exit();
                } else {
                    echo "failed";
                    //exit();
                }
        }

        if ($check_field == 'mobile_no') {

                $user_id = $this->model->get_vendorname_id($_POST['var_email']);
                $user = base64_encode($user_id);
                //echo $user_id; exit();
                $url = base_url().'store_vendor_reset_password/'.$user;

                $var_name = $this->model->get_vendor_name($_POST['var_email']);
                $this->common_model->user_forgot_password($var_name,$url,$_POST['var_email']);

                echo "success";
                //exit();
        }

        if ($check_field == 'failed_data') {
            echo "failed_data";
        }

        exit();
        
    }

    public function store_vendor_reset_password($id){
        $user_id = base64_decode($id);
        $select = "select int_glcode,dt_timestamp from mst_vendors where chr_delete = 'N' and int_glcode = '".$user_id."'";
        $result = $this->db->query($select);
        $data = $result->row_array();
        // echo $select;
        // print_r($data); exit();
        $time_stamp = $data['dt_timestamp'] + 60*60*24 ;
        //echo $data['dt_timestamp'].'</br>'; 
        //echo $time_stamp; exit();
        $current_time = time();
        if ($current_time <= $time_stamp) {
            $this->session->set_userdata('reset_vendor',$user_id);
            redirect('vendor_reset_password');
        } else {
            redirect('vendor_expired_password');
        }

    }

    public function vendor_reset_password()
    {   
        if($this->session->userdata('reset_vendor') != ''){
            $this->load->view('vendor/vendor/reset_password');
        } else {
            redirect(base_url('vendor'));
        }
    }

    public function vendor_expired_password()
    {   
        $this->load->view('vendor/vendor/expired_password');
    }

    public function reset_password_action(){
            
        $newp = $this->mylibrary->cryptPass($_POST["new_password"]);
        $conp = $this->mylibrary->cryptPass($_POST["confirm_password"]);
        $id = $this->session->userdata('reset_vendor');
        
        if($newp == $conp){
            
            $query = $this->db->query("update mst_vendors set var_password='".$newp."' where int_glcode='".$id."' ");
            echo 1;exit;
        }else{
            echo 'New password and confirm password do not match.';exit;
        }
    }

    public function change_password(){
        
        $cupass = $this->mylibrary->cryptPass($this->input->post('opassword'));
        $nepass = $this->mylibrary->cryptPass($this->input->post('npassword'));
        $copass = $this->mylibrary->cryptPass($this->input->post('rpassword'));
        $fk_user = $this->input->post('fk_user');
        $sel1 = $this->db->query("select var_password from mst_vendors where int_glcode='".$fk_user."' ");
        $res1 = $sel1->row_array();
        
        if($cupass == $res1['var_password']){
            if($nepass == $copass){
                
                $update = $this->db->query("update mst_vendors set var_password='$nepass' where int_glcode='".$fk_user."'");
                if (isset($_SESSION['login_user']) && $_SESSION['login_user'] == 'user') {
			
					foreach ($_SESSION as $key => $value) {
						unset($_SESSION[$key]);
					}
						
				} 	
                echo 1;exit;
            }else{
                echo 'new and confirm password does not match.';exit;
            }
        }else{
            echo 'current password does not match.';exit;
        }
    }   

	public function vendor_logout() 
	{   //print_r($_SESSION['cart_item']);die;
 		if (isset($_SESSION['login_user']) && $_SESSION['login_user'] == 'vendor') {
			// remove session datas
			//echo "string"; exit(); 
                  
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
                        
			// user logout ok
			redirect(base_url().'vendor');	
		} 	
	}

}                                    