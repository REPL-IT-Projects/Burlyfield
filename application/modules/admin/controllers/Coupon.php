<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Coupon extends Admin_Controller {

	public function __construct() {

		parent::__construct();

		$this->load->helper(array('form'));

		$this->load->library(array('session','form_validation','pagination','mylibrary'));

		$this->load->model('common_model');

		$this->load->model('Coupon_model','model');

	}

	public function index()
	{
		//echo "ewrewr"; exit;
        $allcount = $this->model->coupon_count();
        $data['total_rows'] = $allcount;

        $query = $this->db->where('chr_delete', 'N')->where('fk_user',0)->get('mst_promocode');
		$data['total_users'] = $query->num_rows();

        $data['data'] = $this->model->getcouponData(0,50);

		// Pagination Configuration
        $config['base_url'] = base_url() . 'coupon/loadcoupon/';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = 50;

        // Initialize
        $this->pagination->initialize($config);

        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links();
        $data['row'] = 0;

		$this->load_view('coupon/view_coupon',$data);

	}

	public function loadcoupon($rowno=0) { 

            $search = $_GET['append'];           
            $_field = $_GET['field'];           
            $_sort = $_GET['sort'];           
           // Row per page
        $rowperpage = $_GET['entries'];

        // Row position
        if($rowno != 0){
          $rowno = ($rowno-1) * $rowperpage;
        }

          //echo "eii"; print_r($search); exit();
     
        // All records count
        $allcount = $this->model->coupon_count($search);

            $data['total_rows'] = $allcount;
            //$data['total_users'] = $this->db->count_all('mst_user');

            $query = $this->db->where('chr_delete', 'N')->where('fk_user',0)->get('mst_promocode');
			$data['total_users'] = $query->num_rows();
        // Get records
        	$users_record = $this->model->getcouponData($rowno,$rowperpage,$search,$_field,$_sort);

           // print_r($allcount); exit();
     
        // Pagination Configuration
        $config['base_url'] = base_url() . 'coupon/loadcoupon/';
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


   	public function add_coupon()
	{
		
		$this->load_view('coupon/add_coupon');
	}



	public function insert_coupon()
	{
		$res_id = $this->model->addcoupon();

		if($res_id != ''){
			$this->session->set_flashdata('Invalid', ADD_SUCCESS);
			redirect('admin/coupon');
		}else{
			$this->session->set_flashdata('Invalid', ADD_ERROR);
			$this->add_cate();
		}

		
	}

/////////////// edit user ////////////////////
	public function edit_coupon($userId)
	{
		$userId=base64_decode($userId);

		$data['coupon'] = $this->model->coupon_edit($userId);
		
		$this->load_view('coupon/edit_coupon',$data);
	}

	public function update_coupon($id)
	{

		//if (isset($_POST['submit'])) {
			
			$this->model->updatecoupon($id);
			$this->session->set_flashdata('Invalid', EDIT_SUCCESS);
			redirect('admin/coupon');
//		} else {
//			$this->session->set_flashdata('Invalid', EDIT_ERROR);
//			redirect('admin/coupon');
//		}
	}


	/////////////////// update publish //////////////////////
	public function UpdatePublish() 
	{
		$this->model->updatedisplay();
	}

	//////////////////// delete multiple /////////////////////
	public function delete_multiple() 
	{
		//$this->model->delMultiplePlan();
		$result = $this->model->delete_multiple();
		echo $result;
		//$this->load_view('invest/view_plan');
		//exit;
	}


}                                      