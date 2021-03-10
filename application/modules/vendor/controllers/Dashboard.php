<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Vendor_Controller {

    public function __construct() {
		
		parent::__construct();
                $this->load->library(array('session','mylibrary'));
                $this->load->model('Dashboard_Model','model');
	}
        
	public function index()
	{
        $data['total_deliveryboy'] = $this->model->total_delivery_boy($_SESSION['fk_vendor']);
        $data['pending_order'] = $this->model->total_order($_SESSION['fk_vendor'],'P');
        $data['inprogress_order'] = $this->model->total_order($_SESSION['fk_vendor'],'W');
        $data['complete_order'] = $this->model->total_order($_SESSION['fk_vendor'],'S');
        $data['order_report'] = $this->model->getOrderReport($_SESSION['fk_vendor']);
		$this->load_view('home',$data);
	}

    public function change_password(){
        
        $cupass = $this->mylibrary->cryptPass($this->input->post('opassword'));
        $nepass = $this->mylibrary->cryptPass($this->input->post('npassword'));
        $copass = $this->mylibrary->cryptPass($this->input->post('rpassword'));
        
        $sel1 = $this->db->query("select var_password from mst_admin where int_glcode='1' ");
        $res1 = $sel1->row_array();
        
        if($cupass == $res1['var_password']){
            if($nepass == $copass){
                
                $update = $this->db->query("update mst_admin set var_password='$nepass' where int_glcode='1'");
                echo 1;exit;
            }else{
                echo 'new and confirm password does not match.';exit;
            }
        }else{
            echo 'current password does not match.';exit;
        }
    }
    
    function update_status(){
        
        $id = $_POST['id'];
        $status = $_POST['status'];
        
        $update = $this->db->query("update mst_orders set chr_status='".$status."' where int_glcode='".$id."' ");
        
        $this->db->select('u.var_device_token,o.order_id');
        $this->db->join('mst_users u','u.int_glcode=o.fk_user');
        $this->db->from('mst_orders o');
        $this->db->where('o.int_glcode',$id);
        $query = $this->db->get();
        $res = $query->row_array();
                
        if($status == 'P'){
            $msg = $res['order_id'].' Order Placed Successfully.';
        }else if($status == 'A'){
            $msg = $res['order_id'].' Order Accepted.';
        }else if($status == 'R'){
            $msg = $res['order_id'].' Order Rejected.';
        }else if($status == 'W'){
            $msg = $res['order_id'].' Order Packed & Ready To Ship.';
        }else if($status == 'C'){
            $msg = $res['order_id'].' Order Cancelled.';
        }else if($status == 'S'){
            $msg = $res['order_id'].' Order Delivered.';
        }else if($status == 'SH'){
            $msg = $res['order_id'].' Order Shipped.';
        }else if($status == 'RC'){
            $msg = $res['order_id'].' Order Reached your City.';
        }

        $url = 'https://fcm.googleapis.com/fcm/send';

        $target = $res['var_device_token'];

        $data['message'] = $msg;
        $data['flag'] = $status;
        $data['order_id'] = $id;
        $data['order_num'] = $res['order_id'];

        $fields = array();

        $fields['data'] = $data;

        if (is_array($target)) {
            $fields['registration_ids'] = $target;
        } else {
            $fields['to'] = $target;
        }

        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . NOTIFICATION_KEY
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
       // print_r($result);
        curl_close($ch);
        
        echo 1;exit;
        
    }
}                                         