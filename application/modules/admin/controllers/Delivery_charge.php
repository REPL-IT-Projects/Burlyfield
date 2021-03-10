<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery_charge extends Admin_Controller {

	public function __construct() {

		parent::__construct();

		$this->load->helper(array('form'));

		$this->load->library(array('session','form_validation','pagination','mylibrary'));

		$this->load->model('common_model');

		$this->load->model('Delivery_charge_model','model');

		

	}

	
        public function edit_delivery_charge($userId)
	{
		$userId=base64_decode($userId);

		$data['contact'] = $this->model->getIdByContact($userId);
		// print_r($data['contact']);
		$this->load_view('delivery_charge/edit_delivery_charge',$data);
	}
        
        public function update_contact()
	{

		// if (isset($_POST['submit'])) {
			
			$this->model->UpdateContactData();
			$this->session->set_flashdata('Invalid', EDIT_SUCCESS);
			redirect('admin/delivery_charge');
		// } else {
			
		// 	redirect('admin/pages/setting');
		// }
	}
        
	
        function index(){
          
            $data['contact'] = $this->model->get_contact();
            $this->load_view('delivery_charge/delivery_charge',$data);
        }
        
}                                      