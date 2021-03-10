<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Vendor_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session','form_validation','encrypt','pagination','mylibrary'));
		$this->load->model('common_model');
		$this->load->model('Profile_model','model');
	}

	/*------------------ edit view record ----------------------*/ 
	public function index()
	{          
		$userId=$_SESSION['fk_vendor'];
		//echo $userId; exit();
		$data['data'] = $this->model->getIdByData($userId);
		$this->load_view('profile/edit_profile',$data);
	}

	/*------------------ edit record in DB ----------------------*/ 
	public function update_vendor($id)
	{
		if (isset($_POST['submit'])) {
			$this->model->updateRecord($id);
			$this->session->set_flashdata('Invalid', EDIT_SUCCESS);
			redirect('vendor/profile');
		} else {
			redirect('vendor/profile');
		}
	}

	
}                                         