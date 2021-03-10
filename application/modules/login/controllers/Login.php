<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Front_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session','form_validation'));
		$this->load->library('GoogleLoginApi');
		$this->load->library('facebook');
		$this->load->library('recaptcha');
		$this->load->helper(array('form'));
		$this->load->model('Login_Model','model');
		
	}

	/*------------------------------- home login --------------------------*/
	public function index()
	{ 
		if(isset($_GET['code'])) {
			try {
				$gapi = new GoogleLoginApi();
				
				// Get the access token 
				$data = $gapi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL_REGISTER, CLIENT_SECRET, $_GET['code']);
				//echo "<pre>"; print_r($data);
				// Get user information
				$user_info = $gapi->GetUserProfileInfo($data['access_token']);

				//echo '<pre>';print_r($user_info); exit();

		                $email = $user_info["emails"][0]["value"];
		                $name = $user_info["displayName"];
		                $image = $user_info["image"]["url"];
		                
		                $sql = "select * from mst_users where chr_delete='N' AND var_email = '".$email."'";
		                $datas = $this->db->query($sql);
		                $counts = $datas->row_array();
		             	
		                if(count($counts) > 0){
		                	
		          		$uid = $counts['int_glcode'];
		                    $_SESSION['login_user'] = 'user';
					        $_SESSION['fk_user'] = $counts['int_glcode'];
					        $_SESSION['user_name'] = $counts['var_name'];
					        $_SESSION['mobile_no'] = $counts['var_mobile_no'];
					        $_SESSION['email'] = $counts['var_email'];

					        $this->model->social_save($counts['int_glcode']);

					        redirect(base_url());

		                } else {
		                    
		                    $userdata = array(
	                            'var_name' => $name,
	                            'var_email' => $email,
	                            'var_image' => $image,
	                            'chr_delete' => 'N',
	                            'dt_createddate' => date('Y-m-d-h-i-s'),
	                            'dt_modifydate' => date('Y-m-d-h-i-s'),
	                            'chr_publish' => 'Y',
	                            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
		                    );

		                    $this->db->insert('mst_users', $userdata);
		                    $uid = $this->db->insert_id();
		                   
		                }

		                if (isset($uid)) {
				        	$data['user_register'] = $this->model->getUserDetalis($uid);
				        } else {
				        	$data['user_register'] = array();
				        }
				        //echo "<pre>"; print_r($user_info);

				        /*----------------- google captcha ------------------*/
				        $recaptcha = $this->input->post('g-recaptcha-response');
				        if (!empty($recaptcha)) {
				            $response = $this->recaptcha->verifyResponse($recaptcha);
				            if (isset($response['success']) and $response['success'] === true) {
				                echo "You got it!";
				            }
				        }

				        $data = array(
				            'widget' => $this->recaptcha->getWidget(),
				            'script' => $this->recaptcha->getScriptTag(),
				        );
				        
						$this->load_view('view_register',$data);
		               // $takemeto = base_url();

		               // redirect(urldecode($takemeto));

				// Now that the user is logged in you may want to start some session variables
				// You may now want to redirect the user to the home page of your website
				// header('Location: home.php');
			}

			catch(Exception $e) {
				echo $e->getMessage();
				exit();
			}
           
        }
	}

	public function register()
	{ 
		if(isset($_GET['code'])) {
			try {
				$gapi = new GoogleLoginApi();
				
				// Get the access token 
				$data = $gapi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL_REGISTER, CLIENT_SECRET, $_GET['code']);
				//echo "<pre>"; print_r($data);
				// Get user information
				$user_info = $gapi->GetUserProfileInfo($data['access_token']);

				//echo '<pre>';print_r($user_info); exit();

		                $email = $user_info["emails"][0]["value"];
		                $name = $user_info["displayName"];
		                $image = $user_info["image"]["url"];
		                
		                $sql = "select * from mst_users where chr_delete='N' AND var_email = '".$email."'";
		                $datas = $this->db->query($sql);
		                $counts = $datas->row_array();
		             
		                if(count($counts) > 0){
		          			$uid = $counts['int_glcode'];
		                    $_SESSION['login_user'] = 'user';
					        $_SESSION['fk_user'] = $counts['int_glcode'];
					        $_SESSION['user_name'] = $counts['var_name'];
					        $_SESSION['mobile_no'] = $counts['var_mobile_no'];
					        $_SESSION['email'] = $counts['var_email'];
					        $this->model->social_save($counts['int_glcode']);
					        redirect(base_url());

		                } else {
		                    
		                    $userdata = array(
	                            'var_name' => $name,
	                            'var_email' => $email,
	                            'var_image' => $image,
	                            'chr_delete' => 'N',
	                            'dt_createddate' => date('Y-m-d-h-i-s'),
	                            'dt_modifydate' => date('Y-m-d-h-i-s'),
	                            'chr_publish' => 'Y',
	                            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
		                    );

		                    $this->db->insert('mst_users', $userdata);
		                    $uid = $this->db->insert_id();
		                   
		                }

		                if (isset($uid)) {
				        	$data['user_register'] = $this->model->getUserDetalis($uid);
				        } else {
				        	$data['user_register'] = array();
				        }
				        //echo "<pre>"; print_r($data['user_register']); exit();
				         /*----------------- google captcha ------------------*/
				        $recaptcha = $this->input->post('g-recaptcha-response');
				        if (!empty($recaptcha)) {
				            $response = $this->recaptcha->verifyResponse($recaptcha);
				            if (isset($response['success']) and $response['success'] === true) {
				                echo "You got it!";
				            }
				        }

				        $data['widget'] = $this->recaptcha->getWidget();
				        $data['script'] = $this->recaptcha->getScriptTag();
				       
						$this->load_view('view_register',$data);
		               // $takemeto = base_url();

		               // redirect(urldecode($takemeto));

				// Now that the user is logged in you may want to start some session variables
				// You may now want to redirect the user to the home page of your website
				// header('Location: home.php');
			}

			catch(Exception $e) {
				echo $e->getMessage();
				exit();
			}
           
        }
        
	}

	public function facebook_register()
	{
		$data['user'] = array();

		// Check if user is logged in
		if ($this->facebook->is_authenticated())
		{
			// User logged in, get user details
			$user = $this->facebook->request('get', '/me?fields=id,name,email');
			if (!isset($user['error']))
			{
				$email = $user["email"];
	            $name = $user["name"];
	                
	                $sql = "select * from mst_users where chr_delete='N' AND var_email = '".$email."'";
	                $datas = $this->db->query($sql);
	                $counts = $datas->row_array();
	             
	                if(count($counts) > 0){
	          			$uid = $counts['int_glcode'];
	                    $_SESSION['login_user'] = 'user';
				        $_SESSION['fk_user'] = $counts['int_glcode'];
				        $_SESSION['user_name'] = $counts['var_name'];
				        $_SESSION['mobile_no'] = $counts['var_mobile_no'];
				        $_SESSION['email'] = $counts['var_email'];
				        $this->model->social_save($counts['int_glcode']);
				        redirect(base_url()); 
				    } else{
				    	$userdata = array(
                            'var_name' => $name,
                            'var_email' => $email,
                            'chr_delete' => 'N',
                            'dt_createddate' => date('Y-m-d-h-i-s'),
                            'dt_modifydate' => date('Y-m-d-h-i-s'),
                            'chr_publish' => 'Y',
                            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
	                    );

	                    $this->db->insert('mst_users', $userdata);
	                    $uid = $this->db->insert_id();
	                   

	                if (isset($uid)) {
			        	$data['user_register'] = $this->model->getUserDetalis($uid);
			        } else {
			        	$data['user_register'] = array();
			        }
			        //echo "<pre>"; print_r($user_info);
			         /*----------------- google captcha ------------------*/
				        $recaptcha = $this->input->post('g-recaptcha-response');
				        if (!empty($recaptcha)) {
				            $response = $this->recaptcha->verifyResponse($recaptcha);
				            if (isset($response['success']) and $response['success'] === true) {
				                echo "You got it!";
				            }
				        }

					        $data['widget'] = $this->recaptcha->getWidget();
					        $data['script'] = $this->recaptcha->getScriptTag();
				        
					$this->load_view('view_register',$data);
				}
	            	
		} } 
		else 
		{
			echo 'We are unable fetch your facebook information.'; exit;
		}

	}

	public function signin()
	{
		$data['headerMenu'] = $this->facebook->login_url();
		$this->load_view('view_login',$data);
	}

	public function signup()
	{
		/*----------------- google captcha ------------------*/
        $data = array(
            'widget' => $this->recaptcha->getWidget(),
            'script' => $this->recaptcha->getScriptTag(),
        );

		$data['headerMenu'] = $this->facebook->login_url();
		$this->load_view('view_register',$data);
	}

	public function user_signup()
	{
		$email = $this->input->post('email');
		$mobile = $this->input->post('phone');

		$useremail = $this->model->checkEmail($email);
		$check_mobile = $this->model->checkMobile($mobile);
		if ($_POST['register_type'] == 'I') {
			if ($useremail == false) 
			{
				echo "email";
				exit();
			}
		
		}
		if ($check_mobile == false) {
			echo "mobile";
			exit();
		} else {

			$user = $this->model->addRecord();
			echo $user;
			
			  // $recaptcha = $this->input->post('g-recaptcha-response');
		   //      if (!empty($recaptcha)) {
		   //          $response = $this->recaptcha->verifyResponse($recaptcha);
		   //          if (isset($response['success']) and $response['success'] === true) {
		   //              $user = $this->model->addRecord();
					// 	echo $user;
						
		   //          } else {
		   //          	echo "captcha_verification";
		   //          	exit();
		   //          }
		   //      } else {
		   //      	echo "empty_captcha";
		   //          exit();
		   //      }
		}
	}

	public function user_signin()
	{
		$var_username = $_POST['var_mobile_no'];
        $var_password = $this->mylibrary->cryptPass($_POST['password']);

        $query =  $this->model->user_login($var_username,$var_password);
        $user_id = $query['int_glcode'];
      
            if (count($query) > 0) {

                $data = $this->model->getProfileDetalis($user_id);
//                if ($data['chr_verify'] == 'N') {
//
//                   $send_otp =  $this->common_model->send_otp_verification($data['fk_user'],$data['var_mobile_no'],'mst_users');
//                   $fk_user = $data['fk_user'];
//                   echo "otp_verify#".$fk_user;
//                   exit();
//                } else {
//                   
//                }
                echo $query['cart'];exit;
            } else {
                echo "failed";
                exit();
            }
	}

	public function user_verify_otp()
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
		if ($this->input->post('fk_user') != '') {
			$user_id = $this->input->post('fk_user');
		} else {
			$user_id = $this->input->post('fk_user_get_id');
		}
		
		$mobile_no = $this->input->post('mobile_no');

		$this->common_model->send_otp_verification($user_id,$mobile_no,'mst_users');

		echo "true";
		exit();
	}

	public function forgotPassword()
	{
		$var_email = $_POST['email'];
		$check_field = $this->model->checkForgotLink($var_email); 

		//echo $check_field; exit();

		if ($check_field == 'email') {
		
        	// $this->load->library('email');
            
	        // $id = $this->model->get_userid($var_email);

	        //     $this->load->library('email');

	        //     //SMTP & mail configuration
	        //     $this->load->library('smtpemail');
	        //     $config = $this->smtpemail->globalEmail();
	        //     $this->email->initialize($config);
	        //     $this->email->set_mailtype("html");
	        //     $this->email->set_newline("\r\n");

	        //     //Email content
	        //     $img_path = base_url();
	        //     $url = base_url().'store_user_reset_password/'.base64_encode($id);
	        //     $htmlContent = file_get_contents('public/templates/forgot.php');
	        //     $htmlContent = str_replace("@IMG_LOGO", $img_path, $htmlContent);
	        //     $htmlContent = str_replace("@BTN_URL", $url, $htmlContent);
	        //     $this->email->to($var_email);
	        //     $this->email->from(FROM_EMAIL,'Vruits');
	        //     $this->email->subject('Forgot Password');
	        //     $this->email->message($htmlContent);

	            //Send email
			$newpass = $this->random_strings(6);
            $to = $var_email;

            $subject = 'Forgot Password';

            $headers = "From: " . FROM_EMAIL . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            
            $message = "Your New Password : ".$newpass;
            $message .= "<br><p>For any clarifications or to know more about Burlyfield, please call us on +91-7722066378, and we will be glad to assist you.</p>\r\n\r\nBest Regards,<br>Team Burlyfield.";
            
            
	            
	            if (mail($to, $subject, $message, $headers)) {
	            	$updateTimeStamp = $this->model->updateTimeStamp($var_email);
	            	$this->model->updatePass($var_email,$newpass);
	                echo "success";
	                //exit();
	            } else {
	                echo "failed";
	                //exit();
	            }
        }


        // if ($check_field == 'mobile_no') {

	       //  	$user_id = $this->model->get_username_id($_POST['var_email']);
	       //  	$user = base64_encode($user_id);
	       //  	//echo $user_id; exit();
	       //  	$url = base_url().'store_user_reset_password/'.$user;

	       //  	$var_name = $this->model->get_user_name($_POST['var_email']);
	       //  	$this->common_model->user_forgot_password($var_name,$url,$_POST['var_email']);

	       //  	echo "success";
	       //      //exit();
        // }

        if ($check_field == 'failed_data') {
        	echo "failed_data";
        }

        exit();
        
	}

	function random_strings($length_of_string) 
        { 
          
            // String of all alphanumeric character 
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
          
            // Shufle the $str_result and returns substring 
            // of specified length 
            return substr(str_shuffle($str_result),  
                               0, $length_of_string); 
        }

	public function store_user_reset_password($id){
        $user_id = base64_decode($id);
        $select = "select int_glcode,dt_timestamp from mst_users where chr_delete = 'N' and int_glcode = '".$user_id."'";
        $result = $this->db->query($select);
        $data = $result->row_array();
        // echo $select;
        // print_r($data); exit();
        $time_stamp = $data['dt_timestamp'] + 60*60*24 ;
        //echo $data['dt_timestamp'].'</br>'; 
        //echo $time_stamp; exit();
        $current_time = time();
        if ($current_time <= $time_stamp) {
	        $this->session->set_userdata('reset_user',$user_id);
	        redirect('user_reset_password');
        } else {
        	redirect('user_expired_password');
        }

    }

    public function user_reset_password()
	{   
        if($this->session->userdata('reset_user') != ''){
			$this->load->view('login/reset_password');
       	} else {
        	redirect(base_url());
        }
	}

	public function user_expired_password()
	{   
		$this->load->view('login/expired_password');
	}

	public function reset_password_action(){
            
        $newp = $this->mylibrary->cryptPass($_POST["new_password"]);
        $conp = $this->mylibrary->cryptPass($_POST["confirm_password"]);
        $id = $this->session->userdata('reset_user');
        
        if($newp == $conp){
            
            $query = $this->db->query("update mst_users set var_password='".$newp."' where int_glcode='".$id."' ");
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
        $sel1 = $this->db->query("select var_password from mst_users where int_glcode='".$fk_user."' ");
        $res1 = $sel1->row_array();
        
        if($cupass == $res1['var_password']){
            if($nepass == $copass){
                
                $update = $this->db->query("update mst_users set var_password='$nepass' where int_glcode='".$fk_user."'");
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

	public function user_logout() 
	{  
 		if (isset($_SESSION['login_user']) && $_SESSION['login_user'] == 'user') {
			// remove session datas
			//echo "string"; exit(); 
            $this->model->update_shopping_cart();
                    
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
                        
			// user logout ok
			redirect(base_url(),'refresh');	
		} 	
	}

	public function logout()
	{
		$this->facebook->destroy_session();
		redirect('login/facebook_logout');
	}

	
        
}                                    