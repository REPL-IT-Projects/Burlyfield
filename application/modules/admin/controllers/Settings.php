<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends Admin_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session','form_validation','mylibrary'));
		$this->load->model('common_model');
		$this->load->model('settings_model','model');
	}

	/*---------------------------- view data index -----------------------*/
	public function index()
	{

	}

	/*------------------ view rejection reasons ----------------------*/ 
	public function reasons()
	{
		
		$data['data'] = $this->model->getReasonsData();
		$this->load_view('settings/view_reason',$data);
	}

	/*------------------ add record in DB ----------------------*/ 
	public function insert_reason()
	{
		// validation not ok, send validation errors to the view
		// Set flash data 
		$this->model->addReasons();
		$this->session->set_flashdata('Invalid', ADD_SUCCESS);
		redirect('admin/settings/reasons');
	
	}

	/*------------------ add timeslot ----------------------*/ 
	public function insert_timeslot()
	{
		// validation not ok, send validation errors to the view
		// Set flash data 
		$this->model->addTimeslot();
		$this->session->set_flashdata('Invalid', ADD_SUCCESS);
		redirect('admin/settings/delivery_timeslot');
	
	}

	/*------------------ edit view reasons ----------------------*/ 
	public function editReason()
	{
		$key = $_POST['reasonKey'];
		$data['data'] = $this->model->getIdByValue($key);

		$this->load->view('settings/edit_reason',$data);
	}

	/*------------------ edit view timeslots ----------------------*/ 
	public function editTimeslot()
	{
		$key = $_POST['reasonKey'];
		$data['data'] = $this->model->getIdByValueTimeslot($key);

		$this->load->view('settings/edit_timeslot',$data);
	}

	/*------------------ edit record in DB ----------------------*/ 
	public function update_timeslot()
	{
		$this->model->updateTimeslot();
			
		redirect('admin/settings/delivery_timeslot');
	}

	/*------------------ edit record in DB ----------------------*/ 
	public function update_reason()
	{
		$this->model->updateReason();
			
		redirect('admin/settings/reasons');
	}

	// /*------------------ edit record in DB ----------------------*/ 
	// public function update_reason()
	// {
	// 	$this->model->updateReason();
			
	// 	redirect('admin/settings/reasons');
	// }

	/*----------------------- update publish  ----------------------*/ 
	public function UpdatePublish() 
	{
		$this->model->updatedisplay();
	}

	/*----------------------- update publish  ----------------------*/ 
	public function UpdateBannerPublish() 
	{
		$this->model->updatedisplay();
	}

	/*----------------------- delete multiple record  ----------------------*/ 
	public function delete_multiple() 
	{
		//$this->model->delMultiplePlan();
		$result = $this->model->delete_multiple('mst_order_reject_reason');
		echo $result;
	}

	/*----------------------- delete multiple record  ----------------------*/ 
	public function delete_multiple_banner() 
	{
		//$this->model->delMultiplePlan();
		$result = $this->model->delete_multiple('mst_home_banners');
		echo $result;
	}

	/*----------------------- delete multiple record  ----------------------*/ 
	public function delete_multiple_timeslot() 
	{
		//$this->model->delMultiplePlan();
		$result = $this->model->delete_multiple_timeslot('mst_delivery_timeslot');
		echo $result;
	}

	/*-------------------------- home page banner images ---------------------*/
	public function banner_images()
	{
		$data['offer_one'] = $this->db->get_where('mst_home_banners',array('int_glcode =' => '13'))->result_array();
		$data['offer_two'] = $this->db->get_where('mst_home_banners',array('int_glcode =' => '14'))->result_array();
		$data['category'] = $this->model->get_categories();
		$data['data'] = $this->model->getBannersData();
		// echo "<pre>";print_r($data);die();
		$this->load_view('settings/view_banners',$data);
	}

	/*------------------ add record in DB ----------------------*/ 
	public function insert_banner_images()
	{
		// validation not ok, send validation errors to the view
		// Set flash data 
		$this->model->addBanners();
		$this->session->set_flashdata('Invalid', ADD_SUCCESS);
		redirect('admin/settings/banner_images');
	
	}

	/*------------------ edit view reasons ----------------------*/ 
	public function editBanner()
	{
		$key = $_POST['reasonKey'];
		$data['data'] = $this->model->getIdByBannerImage($key);

		$this->load->view('settings/edit_banners',$data);
	}

	/*------------------ edit record in DB ----------------------*/ 
	public function update_banner()
	{
		$this->model->updateBanners();
			
		redirect('admin/settings/banner_images');
	}

	// Edit offer 2
	public function offer_second(){
		$this->model->offer_two();
		redirect('admin/settings/banner_images');
	}

	// Edit offer 1
	public function offer_first(){
		$this->model->offer_one();
		redirect('admin/settings/banner_images');
	}

	/*----------------------- delete multiple record  ----------------------*/ 
	public function delete_multiple_banners() 
	{
		//$this->model->delMultiplePlan();
		$result = $this->model->delete_multiple('mst_home_banners');
		echo $result;
	}

	/*--------------------- view delivery timeslot -----------------------*/
	public function delivery_timeslot()
	{
		$data['data'] = $this->model->getDeliveryTimeslot();
		$this->load_view('settings/view_timeslot',$data);
	}

}                                         