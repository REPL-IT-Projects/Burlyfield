<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw_request extends Admin_Controller {
 
	public function __construct() {
 
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('form'));
		$this->load->library(array('session','form_validation','mylibrary','pagination'));
		$this->load->model('Withdraw_request_model','model');
	}

	public function index()
	{
	
		$data['pending_request'] = $this->model->get_withdraw_request('N');
                $data['complete_request'] = $this->model->get_withdraw_request('Y');

		$this->load_view('withdraw_request/view_withdraw_request',$data);

	}

        function approved_request(){
            
            $this->db->where('int_glcode',$_POST['id']);
            $update = $this->db->update('mst_withdraw_request', array('chr_status'=>'Y'));
            
            return true;
        }
        
        public function admin_withdraw_toExcel() {

            $this->model->admin_withdraw_toExcel();
        }
        
}                                      