<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends Vendor_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session','form_validation','pagination','mylibrary'));
		$this->load->model('common_model');
		$this->load->model('Products_model','model');
	}

	/*---------------------------- view data index -----------------------*/
	public function index()
	{
		
		//$data['product'] = $this->model->getData($_SESSION['fk_vendor']);
            $allcount = $this->model->records_count();
		$data['total_rows'] = $allcount;

		$query = $this->db->where('chr_delete', 'N')->where('fk_vendor', $_SESSION['fk_vendor'])->get('mst_products');
		$data['total_data'] = $query->num_rows();

		$data['data'] = $this->model->getData(0,10);

		// Pagination Configuration
		$config['base_url'] = base_url() . 'products/loadData/';
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $allcount;
		$config['per_page'] = 10;

        // Initialize
		$this->pagination->initialize($config);

        // Initialize $data Array
		$data['pagination'] = $this->pagination->create_links();
		$data['row'] = 0;
                
		$this->load_view('product/view_product',$data);
	}
        
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

		$query = $this->db->where('chr_delete', 'N')->where('fk_vendor', $_SESSION['fk_vendor'])->get('mst_products');
		$data['total_data'] = $query->num_rows();
        // Get records
		$users_record = $this->model->getData($rowno,$rowperpage,$search,$_field,$_sort);

        // Pagination Configuration
		$config['base_url'] = base_url() . 'products/loadData/';
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
	public function add_product()
	{
            $data['category'] = $this->model->get_categories();
		$this->load_view('product/add_product',$data);
	}

	/*------------------ add record in DB ----------------------*/ 
	public function insert_record()
	{
		
			// validation not ok, send validation errors to the view
			// Set flash data 
			$this->model->addRecord();
			$this->session->set_flashdata('Invalid', ADD_SUCCESS);
			redirect('vendor/products');
	
	}

	/*------------------ edit view record ----------------------*/ 
	public function edit_product($Id)
	{
		$Id=base64_decode($Id);
		//echo $Id; exit();
		$data['data'] = $this->model->getIdByData($Id);
		$data['category'] = $this->model->get_categories();
		$data['price_detail'] = $this->model->getProductPriceDetails($Id);
		$data['mul_images'] = $this->model->getVendorDocuments($Id);
		$this->load_view('product/edit_product',$data);
	}

	/*------------------ edit record in DB ----------------------*/ 
	public function update_record($id)
	{
		if (isset($_POST['submit'])) {
			$this->model->updateRecord($id);
			$this->session->set_flashdata('Invalid', EDIT_SUCCESS);
			redirect('vendor/products');
		} else {
			redirect('vendor/products');
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
        
        public function deleteProductPrices()
	{
		//echo "hello";die();
		$id = $_POST['id'];
		$this->db->where('int_glcode', $id);
		$this->db->delete('trn_product_price');
		
		return  $id = $this->db->affected_rows();
	}
        
        public function deleteProductImges()
	{
		//echo "hello";die();
		$id = $_POST['id'];
		$this->db->where('int_glcode', $id);
		$this->db->delete('trn_product_images');
		
		return  $id = $this->db->affected_rows();
	}
        
}                                         