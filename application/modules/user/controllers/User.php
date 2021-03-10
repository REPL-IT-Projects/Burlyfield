<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Front_Controller {
    
    public function __construct() {
        
        parent::__construct();
        $this->load->library(array('session','form_validation','mylibrary','pagination'));
        $this->load->helper(array('form'));
        $this->load->model('User_model','model');
        $this->fk_user = $_SESSION['fk_user'];
    }

    public function index(){
        
        $data['data'] = $this->model->getUserProfile($this->fk_user);
        $this->load_view('view_profile',$data);
    }
        
    public function addAddress()
    {
        $this->model->add_address();

        redirect(base_url().'cart/checkout');
    }

    public function edit_address()
    {
        $key = $_POST['reasonKey'];

        $data['data'] = $this->model->getIdByAddress($key);

        $this->load->view('edit_address',$data);
    }

    /*------------------ edit user address -------------------------*/
    public function editAddress()
    {
        $this->model->update_address();

        redirect(base_url().'cart/checkout');
    }

    /*------------------ edit record in DB ----------------------*/ 
    public function update_user($id)
    {   
        unset($_SESSION['user_name']);
        unset($_SESSION['var_image']);
        $this->model->updateUserProfile($id);
        
        redirect(base_url().'user');
    }

    /*------------------ edit record in DB ----------------------*/ 
    public function update_contactno()
    {
        $user_id = $_POST['fk_user_no'];
        $send_otp =  $this->common_model->send_otp_verification($user_id,$_POST['var_alt_mobile'],'mst_users');
        //$this->model->updateAlternateNo($id,$send_otp);
        echo 1;
        exit;
        //redirect(base_url().'user');
    }

    /*---------------- update contact number --------------------*/
    public function verify_otp()
    {
        $verify_Status = $this->model->mobile_verify_otp($_POST['var_otp'],$_POST['fk_user_id']);

        echo $verify_Status;
        exit();
    }

    public function verify_promocode()
    {
        $verify_Status = $this->model->promocode_verify($_POST['fk_user_promo']);

        echo json_encode($verify_Status);
    }

    public function default_address()
    {
        $fk_user = $_POST['userId'];
        $this->db->set('default_status', 'N');
        $this->db->where('fk_user', $fk_user);
        $this->db->update('mst_user_address');

        $id = $_POST['id'];
        $this->db->set('default_status', 'Y');
        $this->db->where('int_glcode', $id);
        $this->db->update('mst_user_address');

        return  $id = $this->db->affected_rows();
    }

    public function default_contact()
    {
        $fk_user = $_POST['userId'];

        $this->db->select('int_glcode,var_otp,var_mobile_no,var_alt_mobile,var_default_no');
        $this->db->from('mst_users');
        $this->db->where('int_glcode', $fk_user);
        $result = $this->db->get(); 
        $row = $result->row_array();

        if ($_POST['flag'] == 'Y') {
            $this->db->set('var_default_no', $row['var_alt_mobile']);
            $this->db->where('int_glcode', $fk_user);
            $this->db->update('mst_users');
        } else {
            $this->db->set('var_default_no', $row['var_mobile_no']);
            $this->db->where('int_glcode', $fk_user);
            $this->db->update('mst_users');
        }

        return  $id = $this->db->affected_rows();
    }
}                                    