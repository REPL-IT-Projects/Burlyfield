<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promocode extends Admin_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session','form_validation','mylibrary'));
		$this->load->model('common_model');
		$this->load->model('promocode_model','model');
	}

	/*---------------------------- view data index -----------------------*/
	public function index()
	{
		$data['data'] = $this->model->getPromocodeData();
		$data['promo'] = $this->model->getPromocodeNewuser();
		$data['min_amt'] = $this->model->getMinimumAmount();

		$this->load_view('promocode/view_promo',$data);
	}

	/*------------------ add record in DB ----------------------*/ 
	public function insert_record()
	{
		// validation not ok, send validation errors to the view
		// Set flash data 
		$this->model->addRecord();
		$this->session->set_flashdata('Invalid', ADD_SUCCESS);
		redirect('admin/promocode');
	
	}
	
	/*------------------ set amount For Order ----------------------*/ 
	public function set_amount()
	{
		// validation not ok, send validation errors to the view
		// Set flash data 
		$this->model->addMinimumAmount();
		$this->session->set_flashdata('Invalid', ADD_SUCCESS);
		redirect('admin/promocode');
	
	}

	/*------------------ edit view reasons ----------------------*/ 
	public function editPromocode()
	{
		$key = $_POST['reasonKey'];
		$data['data'] = $this->model->getIdByValue($key);

		$this->load->view('promocode/edit_promo',$data);
	}

	public function new_user_price()
	{
		$this->model->updateNewUserPrice();

		redirect('admin/promocode');
	}


	/*------------------ edit record in DB ----------------------*/ 
	public function update_record()
	{
		$this->model->updateRecord();
			
		redirect('admin/promocode');
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
		$result = $this->model->delete_multiple('mst_promocode');
		echo $result;
	}

}                                         