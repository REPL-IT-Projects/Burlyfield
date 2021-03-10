<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pincode extends Admin_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session','form_validation','pagination','mylibrary'));
		$this->load->model('common_model');
		$this->load->model('Pincode_model','model');
	}

	/*---------------------------- view data index -----------------------*/
	public function index()
	{
		$allcount = $this->model->records_count();
		$data['total_rows'] = $allcount;

		$query = $this->db->where('chr_delete', 'N')->get('mst_pincode');
		$data['total_data'] = $query->num_rows();

		$data['data'] = $this->model->getData(0,10);

		// Pagination Configuration
		$config['base_url'] = base_url() . 'pincode/loadData/';
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $allcount;
		$config['per_page'] = 10;

        // Initialize
		$this->pagination->initialize($config);

        // Initialize $data Array
		$data['pagination'] = $this->pagination->create_links();
		$data['row'] = 0;

		$this->load_view('pincode/view_pincode',$data);

	}

	/*---------------------------- Load view data -----------------------*/
	public function loadData($rowno=0) 
	{ 
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

		$query = $this->db->where('chr_delete', 'N')->get('mst_pincode');
		$data['total_data'] = $query->num_rows();
        // Get records
		$pincodes_record = $this->model->getData($rowno,$rowperpage,$search,$_field,$_sort);

        // Pagination Configuration
		$config['base_url'] = base_url() . 'pincode/loadData/';
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $allcount;
		$config['per_page'] = $rowperpage;

        // Initialize
		$this->pagination->initialize($config);

        // Initialize $data Array
		$data['pagination'] = $this->pagination->create_links();
		$data['result'] = $pincodes_record;
		$data['row'] = $rowno;

		echo json_encode($data);

	}

	/*------------------ add view record ----------------------*/ 
	public function add_pincode()
	{
		$this->load_view('pincode/add_pincode');
	}

	/*------------------ add record in DB ----------------------*/ 
	public function insert_record()
	{
	    $this->model->addRecord();
		$this->session->set_flashdata('Invalid', ADD_SUCCESS);
		redirect('admin/pincode');
	}

	/*------------------ edit view record ----------------------*/ 
	public function editpincode($pincodeId)
	{
		$pincodeId=base64_decode($pincodeId);
		//echo $pincodeId; exit();
		$data['data'] = $this->model->getIdByData($pincodeId);
// 		echo "<pre>";
// 		print_r($data);
		$this->load_view('pincode/edit_pincode',$data);
	}

	/*------------------ edit record in DB ----------------------*/ 
	public function update_pincode($id)
	{
		if (isset($_POST['submit'])) {
			$this->model->updateRecord($id);
			$this->session->set_flashdata('Invalid', EDIT_SUCCESS);
			redirect('admin/pincode');
		} else {
			redirect('admin/pincode');
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

	/*----------------------- delete pincode address ------------------------*/
	public function deleteAddress()
	{
		//echo "hello";die();
		$id = $_POST['id'];
		$this->db->set('chr_delete', 'Y');
		$this->db->where('int_glcode', $id);
		$this->db->update('mst_pincode_address');
		
		return  $id = $this->db->affected_rows();
	}

}                                         