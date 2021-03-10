<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery_boy extends Vendor_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session','form_validation','pagination','mylibrary'));
		$this->load->model('common_model');
		$this->load->model('Deliveryboy_model','model');
	}

	/*---------------------------- view data index -----------------------*/
	public function index()
	{
		
		$data['delivery_boy'] = $this->model->getData($_SESSION['fk_vendor']);

		$this->load_view('deliveryboy/view_delivery',$data);
	}

	/*------------------ add view record ----------------------*/ 
	public function add_deliveryboy()
	{
		$this->load_view('deliveryboy/add_delivery');
	}

	/*------------------ add record in DB ----------------------*/ 
	public function insert_record()
	{
		$email = $this->input->post('email');
		$mobile = $this->input->post('phone');
		$useremail = $this->model->checkEmail($email);
		$check_mobile = $this->model->checkMobile($mobile);

		if ($useremail == false) 
		{
			$this->session->set_flashdata('Invalid', UNIQUE_EMAIL);
			redirect('vendor/delivery_boy/add_deliveryboy');
		} elseif ($check_mobile == false) {
			$this->session->set_flashdata('Invalid', UNIQUE_MOBILE);
			redirect('vendor/delivery_boy/add_deliveryboy');
		} else {
			// validation not ok, send validation errors to the view
			// Set flash data 
			$this->model->addRecord();
			$this->session->set_flashdata('Invalid', ADD_SUCCESS);
			redirect('vendor/delivery_boy');
		}
	}

	/*------------------ edit view record ----------------------*/ 
	public function editDeliveryboy($Id)
	{
		$Id=base64_decode($Id);
		//echo $Id; exit();
		$data['data'] = $this->model->getIdByData($Id);
		$this->load_view('deliveryboy/edit_delivery',$data);
	}

	/*------------------ edit record in DB ----------------------*/ 
	public function update_record($id)
	{
		if (isset($_POST['submit'])) {
			$this->model->updateRecord($id);
			$this->session->set_flashdata('Invalid', EDIT_SUCCESS);
			redirect('vendor/delivery_boy');
		} else {
			redirect('vendor/delivery_boy');
		}
	}

	/*----------------------- update publish  ----------------------*/ 
	public function UpdatePublish() 
	{
		$this->model->updatedisplay();
	}

	/*----------------------- delete multiple record  ----------------------*/ 
	public function delete_multiple() 
	{
		//$this->model->delMultiplePlan();
		$result = $this->model->delete_multiple();
		echo $result;
	}

    /*----------------------- delete images --------------------------*/  
	public function deleteDocImges() 
	{
		//echo "hello";die();
		$id = $_POST['id'];
		$this->db->where('int_glcode', $id);
		$this->db->delete('trn_vendor_documents');
		
		return  $id = $this->db->affected_rows();
	}
        
}                                         