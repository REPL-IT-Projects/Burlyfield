<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_model extends CI_Model {

	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		$this->load->model('common_model');
	}

    /*------------------------ check forgot password link ------------------------- */
    public function checkForgotLink($var_email)
    {
        $select = "select int_glcode from mst_vendors where chr_publish = 'Y' AND chr_delete = 'N' and var_mobile_no = '".$var_email."'";
        $result = $this->db->query($select);
        $data = $result->row_array();

        if (!empty($data)) {
            $get_res = 'mobile_no';
            
        }

        $select1 = "select int_glcode from mst_vendors where chr_publish = 'Y' AND chr_delete = 'N' and var_email = '".$var_email."'";
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

    /*------------------------ get records count ------------------------- */
    public function checkEmail($eaddress)
    {
        $select = "select int_glcode from mst_vendors where chr_delete = 'N' and chr_publish = 'Y' and var_email = '".$eaddress."'";
        $result = $this->db->query($select);
        $count = $result->num_rows();
        if($count > 0){
            return false;
        }else{
            return true;
        }
    }

    /*---------------- check mobile no. already exit or not --------------*/
    public function checkMobile($mobile)
    {
        $select = "select int_glcode from mst_vendors where chr_delete = 'N' and chr_publish = 'Y' and var_mobile_no = '".$mobile."'";
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
        $select = "select int_glcode from mst_vendors where chr_delete = 'N' and chr_publish = 'Y' and var_email = '".$eaddress."'";
        $result = $this->db->query($select);
        $data = $result->row_array();
        return $data['int_glcode'];
    }

    public function get_vendorname_id($mobile)
    {
        $select = "select int_glcode from mst_vendors where chr_delete = 'N' and chr_publish = 'Y' and var_mobile_no = '".$mobile."'";
        $result = $this->db->query($select);
        $data = $result->row_array();
        return $data['int_glcode'];
    }

    public function get_vendor_name($var_mobile)
    {
        $select = "select var_name from mst_vendors where chr_delete = 'N' and chr_publish = 'Y' and var_mobile_no = '".$var_mobile."'";
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
        $this->db->update('mst_vendors'); 
    }

    /*----------------------- user login API -------------------------*/
    public function user_login($username,$password)
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

        if(count($row) > 0){
            
            $_SESSION['login_user'] = 'vendor';
            $_SESSION['fk_vendor'] = $row['int_glcode'];
            $_SESSION['vendor_name'] = $row['var_name'];
            $_SESSION['mobile_no'] = $row['var_mobile_no'];
            $_SESSION['email'] = $row['var_email'];
        }
        
        return $row;
    }

    
    /*--------------------------- get users list ------------------------------*/
    public function getProfileDetalis($userId)
    {
        $this->db->select('int_glcode as fk_user,var_mobile_no,verify_status');
        $this->db->from('mst_vendors');
        $this->db->where('int_glcode',$userId);
        $this->db->where('chr_delete','N');
        $this->db->where('chr_publish','Y');
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }

    /*--------------------------- get users details ------------------------------*/
    public function getUserDetalis($userId)
    {
        $this->db->select('*');
        $this->db->from('mst_vendors');
        $this->db->where('int_glcode',$userId);
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }


    /*------------------------------- get otp --------------------------- */
    public function get_otp($user_id,$var_otp) 
    {
        $this->db->select('int_glcode,var_otp,var_name,var_email,var_mobile_no');
        $this->db->from('mst_vendors');
        $this->db->where('int_glcode', $user_id);
        $this->db->where('var_otp', $var_otp);
        $result = $this->db->get(); 
        $row = $result->row_array();
        //echo "<pre>"; print_r($row); exit();
        if ($var_otp == $row['var_otp']) {
            $data = array(
                'verify_status' => 'Y'
            );

            $this->db->where('int_glcode', $user_id);
            $this->db->update('mst_vendors', $data);

            $this->common_model->send_register_user($row['var_name'],$row['var_email'],$row['var_mobile_no'],'U');

        }

        return $row['int_glcode'];  

    }
    
}