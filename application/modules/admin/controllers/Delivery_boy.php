<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery_boy extends Admin_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session','form_validation','pagination','mylibrary'));
		$this->load->model('common_model');
		$this->load->model('Deliveryboy_model','model');
	}

	/*---------------------------- view data index -----------------------*/
	public function index()
	{
		$allcount = $this->model->records_count();
		$data['total_rows'] = $allcount;

		$query = $this->db->where('chr_delete', 'N')->get('mst_delivery_boy');
		$data['total_data'] = $query->num_rows();

		$data['data'] = $this->model->getData(0,10);

		// Pagination Configuration
		$config['base_url'] = base_url() . 'delivery_boy/loadData/';
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $allcount;
		$config['per_page'] = 10;

        // Initialize
		$this->pagination->initialize($config);

        // Initialize $data Array
		$data['pagination'] = $this->pagination->create_links();
		$data['row'] = 0;

		$this->load_view('deliveryboy/view_delivery',$data);

	}

	/*---------------------------- Load view data -----------------------*/
	public function loadData($rowno=0) { 

		$search = $_GET['append'];           
		$_field = $_GET['field'];           
		$_sort = $_GET['sort'];           
           // Row per page
		$rowperpage = $_GET['entries'];

        // Row position
		if($rowno != 0){
			$rowno = ($rowno-1) * $rowperpage;
		}

        // All records count
		$allcount = $this->model->records_count($search);

		$data['total_rows'] = $allcount;

		$query = $this->db->where('chr_delete', 'N')->get('mst_delivery_boy');
		$data['total_data'] = $query->num_rows();
        // Get records
		$users_record = $this->model->getData($rowno,$rowperpage,$search,$_field,$_sort);

        // Pagination Configuration
		$config['base_url'] = base_url() . 'vendor/loadData/';
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $allcount;
		$config['per_page'] = $rowperpage;

        // Initialize
		$this->pagination->initialize($config);

        // Initialize $data Array
		$data['pagination'] = $this->pagination->create_links();
		$data['result'] = $users_record;
		$data['row'] = $rowno;

		echo json_encode($data);

	}

	/*------------------ add view record ----------------------*/ 
	public function add_deliveryboy()
	{
		$data['vendor'] = $this->model->getVendor();
		$this->load_view('deliveryboy/add_delivery',$data);
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
			redirect('admin/delivery_boy/add_deliveryboy');
		} elseif ($check_mobile == false) {
			$this->session->set_flashdata('Invalid', UNIQUE_MOBILE);
			redirect('admin/delivery_boy/add_deliveryboy');
		} else {
			// validation not ok, send validation errors to the view
			// Set flash data 
			$this->model->addRecord();
			$this->session->set_flashdata('Invalid', ADD_SUCCESS);
			redirect('admin/delivery_boy');
		}
	}

	/*------------------ edit view record ----------------------*/ 
	public function editDeliveryboy($Id)
	{
		$Id=base64_decode($Id);
		//echo $Id; exit();
		$data['data'] = $this->model->getIdByData($Id);
		$data['vendor'] = $this->model->getVendor();
		$this->load_view('deliveryboy/edit_delivery',$data);
	}

	/*------------------ edit record in DB ----------------------*/ 
	public function update_record($id)
	{
		if (isset($_POST['submit'])) {
			$this->model->updateRecord($id);
			$this->session->set_flashdata('Invalid', EDIT_SUCCESS);
			redirect('admin/delivery_boy');
		} else {
			redirect('admin/delivery_boy');
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