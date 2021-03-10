<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends Admin_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session','form_validation','pagination','mylibrary'));
		$this->load->model('common_model');
		$this->load->model('Stock_model','model');
	}

	/*---------------------------- view data index -----------------------*/
	public function index()
	{
		// $allcount = $this->model->records_count();
		// $data['total_rows'] = $allcount;

		// $query = $this->db->where('chr_delete', 'N')->get('mst_products');
		// $data['total_data'] = $query->num_rows();

		// $data['data'] = $this->model->getData(0,10);

		// $product = $this->db->get('trn_cart_details')->result_array();
		
		// // Pagination Configuration
		// $config['base_url'] = base_url() . 'stock/loadData/';
		// $config['use_page_numbers'] = TRUE;
		// $config['total_rows'] = $allcount;
		// $config['per_page'] = 10;

  //       // Initialize
		// $this->pagination->initialize($config);

  //       // Initialize $data Array
		// $data['pagination'] = $this->pagination->create_links();
		// $data['row'] = 0;
		$data['data'] = $this->model->getData();
		$this->load_view('stock/view_stock',$data);

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

		$query = $this->db->where('chr_delete', 'N')->get('mst_products');
		$data['total_data'] = $query->num_rows();
        // Get records
		$users_record = $this->model->getData($rowno,$rowperpage,$search,$_field,$_sort);
		// print_r($users_record);die();
        // Pagination Configuration
		$config['base_url'] = base_url() . 'stock/loadData/';
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
	public function add_stock()
	{
		$data['data'] = $this->model->stockdata();
		$this->load_view('stock/add_stock',$data);
	}

	public function update_stock()
	{
		$this->model->updatestock();
			
		redirect('admin/stock');
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

	

}                                         