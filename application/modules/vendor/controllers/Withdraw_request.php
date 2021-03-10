<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw_request extends Vendor_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session','form_validation','pagination','mylibrary'));
		$this->load->model('common_model');
		$this->load->model('Withdraw_request_model','model');
	}

	/*---------------------------- view data index -----------------------*/
	public function index()
	{

		$data['getEarning'] = $this->model->getEarning($_SESSION['fk_vendor']);
                $data['getPending'] = $this->model->getPending($_SESSION['fk_vendor'],'N');
                $data['getCompleted'] = $this->model->getPending($_SESSION['fk_vendor'],'Y');
                
		$this->load_view('withdraw_request/view_withdraw_request',$data);

	}

        function send_withdraw_request(){
            
            $vid = $_POST['vendor_id'];
            $price = $_POST['price'];
            
            $update = $this->db->query("update vendor_withdraw set chr_status='Y' where fk_vendor='".$vid."' ");
            
            $arr =  array(
                'fk_vendor' => $vid,
                'var_amount' => $price,
                'dt_createddate' => date('Y-m-d H:i:s')
            );
            $insert = $this->db->insert('mst_withdraw_request',$arr);
            
            echo 1;exit;
        }
    
}                                         