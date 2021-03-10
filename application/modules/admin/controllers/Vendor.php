<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends Admin_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session','form_validation','pagination','mylibrary'));
		$this->load->model('common_model');
		$this->load->model('Vendor_model','model');
	}

	/*---------------------------- view data index -----------------------*/
	public function index()
	{
		$allcount = $this->model->records_count();
		$data['total_rows'] = $allcount;

		$query = $this->db->where('chr_delete', 'N')->get('mst_vendors');
		$data['total_data'] = $query->num_rows();

		$data['data'] = $this->model->getData(0,10);

		// Pagination Configuration
		$config['base_url'] = base_url() . 'vendor/loadData/';
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $allcount;
		$config['per_page'] = 10;

        // Initialize
		$this->pagination->initialize($config);

        // Initialize $data Array
		$data['pagination'] = $this->pagination->create_links();
		$data['row'] = 0;

		$this->load_view('vendor/view_vendor',$data);

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

		$query = $this->db->where('chr_delete', 'N')->get('mst_vendors');
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
	public function add_vendor()
	{
		$this->load_view('vendor/add_vendor');
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
			redirect('admin/vendor/add_vendor');
		} elseif ($check_mobile == false) {
			$this->session->set_flashdata('Invalid', UNIQUE_MOBILE);
			redirect('admin/vendor/add_vendor');
		} else {
			// validation not ok, send validation errors to the view
			// Set flash data 
			$this->model->addRecord();
			$this->session->set_flashdata('Invalid', ADD_SUCCESS);
			redirect('admin/vendor');
		}
	}

	/*------------------ edit view record ----------------------*/ 
	public function editVendor($vendorId)
	{
		$vendorId=base64_decode($vendorId);
		//echo $vendorId; exit();
		$data['data'] = $this->model->getIdByData($vendorId);
		$data['documents'] = $this->model->getVendorDocuments($vendorId);

		$this->load_view('vendor/edit_vendor',$data);
	}

	/*------------------ edit record in DB ----------------------*/ 
	public function update_vendor($id)
	{
		if (isset($_POST['submit'])) {
			$this->model->updateRecord($id);
			$this->session->set_flashdata('Invalid', EDIT_SUCCESS);
			redirect('admin/vendor');
		} else {
			redirect('admin/vendor');
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

	public function store_reset_password($id){
        $user_id = base64_decode($id);
        $select = "select int_glcode,dt_timestamp from mst_vendors where chr_delete = 'N' and int_glcode = '".$user_id."'";
        $result = $this->db->query($select);
        $data = $result->row_array();
        // echo $select;
        // print_r($data); exit();
        $time_stamp = $data['dt_timestamp'] + 60*60*24 ;
        // echo $data['dt_timestamp'].'</br>'; 
        // echo $time_stamp; exit();
        $current_time = time();
        if ($current_time <= $time_stamp) {
	        $this->session->set_userdata('reset_userid',$user_id);
	        redirect('reset_password');
        } else {
        	redirect('expired_password');
        }

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
        
    public function reset_password()
	{   
        if($this->session->userdata('reset_userid') != ''){
			$this->load->view('vendor/reset_password');
        } else {
        	redirect(FRONT_URL);
        }
	}

	public function expired_password()
	{   
		$this->load->view('vendor/expired_password');
	}
        
    public function reset_password_action(){
            
            $newp = $this->mylibrary->cryptPass($_POST["new_password"]);
            $conp = $this->mylibrary->cryptPass($_POST["confirm_password"]);
            $id = $this->session->userdata('reset_userid');
            
            if($newp == $conp){
                
                $query = $this->db->query("update mst_vendors set var_password='".$newp."' where int_glcode='".$id."' ");
                echo 1;exit;
            }else{
                echo 'New password and confirm password do not match.';exit;
            }
        }



	/*--------------------------------- admin vendor history -------------------------- */
	public function vendor_log_history()
	{
		$allcount = $this->model->records_count_history();
		$data['total_rows'] = $allcount;

		$query = $this->db->get('mst_logmanager');
		$data['total_data'] = $query->num_rows();

		$data['data'] = $this->model->getVendorHistory(0,10);

		// Pagination Configuration
		$config['base_url'] = base_url() . 'vendor/loadDataHistory/';
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $allcount;
		$config['per_page'] = 10;

        // Initialize
		$this->pagination->initialize($config);

        // Initialize $data Array
		$data['pagination'] = $this->pagination->create_links();
		$data['row'] = 0;

		$this->load_view('vendor/view_loghistory',$data);
	}

	/*---------------------------- Load view data -----------------------*/
	public function loadDataHistory($rowno=0) { 

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
		$allcount = $this->model->records_count_history($search);

		$data['total_rows'] = $allcount;

		$query = $this->db->get('mst_logmanager');
		$data['total_data'] = $query->num_rows();
        // Get records
		$users_record = $this->model->getVendorHistory($rowno,$rowperpage,$search,$_field,$_sort);

        // Pagination Configuration
		$config['base_url'] = base_url() . 'vendor/loadDataHistory/';
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

	/*----------------------------- vedor wise orders display ---------------------------*/
	public function viewOrders($vendorId)
	{	
		$vendorId=base64_decode($vendorId);

		$allcount = $this->model->orders_count($vendorId);
		$data['total_rows'] = $allcount;
		$query = $this->db->where('fk_vendor', $vendorId)->get('trn_assign_order');
		$data['total_data'] = $query->num_rows();
		$data['data'] = $this->model->getOrders($vendorId,0,10);
		// Pagination Configuration
		$config['base_url'] = base_url() . 'vendor/loadOrders/';
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $allcount;
		$config['per_page'] = 10;
    	// Initialize
		$this->pagination->initialize($config);
    	// Initialize $data Array
		$data['pagination'] = $this->pagination->create_links();
		$data['row'] = 0;

		$this->load_view('vendor/view_orders',$data);

	}

	/*---------------------------- Load view data -----------------------*/
	public function loadOrders($rowno=0) { 

		$search = $_GET['append'];           
		$_field = $_GET['field'];           
		$_sort = $_GET['sort'];    
    	$vendor_id = $_GET['vendor_id'];       
    	// Row per page
		$rowperpage = $_GET['entries'];
    	// Row position
		if($rowno != 0){
			$rowno = ($rowno-1) * $rowperpage;
		}
    	// All records count
		$allcount = $this->model->orders_count($vendor_id,$search);
		$data['total_rows'] = $allcount;
		$query = $this->db->where('fk_vendor', $vendor_id)->get('trn_assign_order');
		$data['total_data'] = $query->num_rows();
    	// Get records
		$users_record = $this->model->getOrders($vendor_id,$rowno,$rowperpage,$search,$_field,$_sort);
        // Pagination Configuration
		$config['base_url'] = base_url() . 'vendor/loadOrders/';
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

public function createXLSVendors() {
    	$venodrInfo = $this->model->getExportVendors();
    	//echo "<pre>"; print_r($venodrInfo); exit();
    	if (!is_dir('uploads/export_venor')) {
			 	mkdir('uploads/export_venor', 0777, TRUE);
		}
    	// create file name
        $fileName = 'vendors-'.time().'.xlsx';  
        $save_file = 'uploads/export_venor/'.$fileName;
    	// load excel library
        $this->load->library('excel');
        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sr No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Mobile No');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Alternate Mobile No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Address');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Latitude');    
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Longitude');       
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Verify');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Member Type'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Commission'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Start Date'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'End Date'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Created Date'); 
        // set Row
        $rowCount = 2;
        $sr_no = 1;
        foreach ($venodrInfo as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $sr_no++);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['var_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['var_mobile_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['var_alt_mobile']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['var_email']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['var_address']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['var_latitude']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element['var_longitude']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element['verify_status']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element['var_membership_type']);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $element['var_commission_value']);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $element['dt_startdate']);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $element['dt_enddate']);
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $element['dt_createddate']);
            $rowCount++;
        }

        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {

          $objPHPExcel->setActiveSheetIndex($objPHPExcel->getIndex($worksheet));

          $sheet = $objPHPExcel->getActiveSheet();
          $cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
          $cellIterator->setIterateOnlyExistingCells(true);
          /** @var PHPExcel_Cell $cell */
          foreach ($cellIterator as $cell) {
              $sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
          }
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($save_file);
      // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(base_url().$save_file);        
    }
	// create xlsx
    public function createXLSLoghistory() {
    	$venodrInfo = $this->model->getExportLoghistory();
    	//echo "<pre>"; print_r($venodrInfo); exit();
    	if (!is_dir('uploads/export_venor')) {
			 	mkdir('uploads/export_venor', 0777, TRUE);
		}
    	// create file name
        $fileName = 'vendorsLoghistory-'.time().'.xlsx';  
        $save_file = 'uploads/export_venor/'.$fileName;
    	// load excel library
        $this->load->library('excel');
        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sr No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Admin');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Vendor');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Mode');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'IP Address');
        // set Row
        $rowCount = 2;
        $sr_no = 1;
        foreach ($venodrInfo as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $sr_no++);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['fk_admin']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['fk_vendor']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['chr_mode']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['dt_createddate']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['var_ipaddress']);
            $rowCount++;
        }

        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {

          $objPHPExcel->setActiveSheetIndex($objPHPExcel->getIndex($worksheet));

          $sheet = $objPHPExcel->getActiveSheet();
          $cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
          $cellIterator->setIterateOnlyExistingCells(true);
          /** @var PHPExcel_Cell $cell */
          foreach ($cellIterator as $cell) {
              $sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
          }
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($save_file);
      // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(base_url().$save_file);        
    }

    // create xlsx
    public function createVendorOrderXLS($vendorId) 
    {
    	$orderInfo = $this->model->getExportVendorOrders($vendorId);
    	//echo "<pre>"; print_r($orderInfo); exit();
    	if (!is_dir('uploads/export_orders')) {
			 	mkdir('uploads/export_orders', 0777, TRUE);
		  }

    	// create file name
        $fileName = 'Vruits_orders-'.time().'.xlsx';  
        $save_file = 'uploads/export_orders/'.$fileName;
    	// load excel library
        $this->load->library('excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sr No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Order ID');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'User');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Mobile No');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'User Address');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Address Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Delivery Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Delivery Timeslot');       
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Delivery Status');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Delivery Charges'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Wallet Amount'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Discount Amount'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Total Amount'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Payable Amount'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Order Status'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('P1', 'Order Cancel By'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'Delivery boy name'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('R1', 'Delivery boy mobileno');

        // set Row
        $rowCount = 2;
        $sr_no = 1;
        foreach ($orderInfo as $element) {
          if(!empty($element['vendor']))
          {
            if ($element['vendor']['var_name'] != '') {
              $vendor_mame = $element['vendor']['var_name'];
            } else {
                $vendor_mame = 'N/A';
            }

            if ($element['vendor']['var_mobile_no'] != '') {
              $vendor_mobile = $element['vendor']['var_mobile_no'];
            } else {
                $vendor_mobile = 'N/A';
            }
          } else {
            $vendor_mame = 'N/A';
            $vendor_mobile = 'N/A';
          }
          

          
          if(!empty($element['vendor']['delivery_data']))
          {
            if ($element['vendor']['delivery_data']['var_name'] != '') {
                $delivery_name = $element['vendor']['delivery_data']['var_name'];
            } else {
                $delivery_name = 'N/A';
            }

            if ($element['vendor']['delivery_data']['var_mobile_no'] != '') {
                $delivery_mobile = $element['vendor']['delivery_data']['var_mobile_no'];
            } else {
                $delivery_mobile = 'N/A';
            }
          } else {
            $delivery_name = 'N/A';
            $delivery_mobile = 'N/A';
          }

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $sr_no++);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['order_id']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['var_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['var_alternate_mobile']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['var_user_address']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['var_address_type']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['dt_delivery_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element['dt_timeslot']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element['chr_delivery_status']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element['var_delivery_charge']);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $element['var_wallet_amount']);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $element['var_discount_amount']);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $element['var_total_amount']);
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $element['var_payable_amount']);
            $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $element['chr_status']);
            $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $element['canceled_by']);
            $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $delivery_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, $delivery_mobile);
            $rowCount++;
        }

        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {

          $objPHPExcel->setActiveSheetIndex($objPHPExcel->getIndex($worksheet));
          $sheet = $objPHPExcel->getActiveSheet();
          $cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
          $cellIterator->setIterateOnlyExistingCells(true);
          /** @var PHPExcel_Cell $cell */
          foreach ($cellIterator as $cell) {
              $sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
          }
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($save_file);
      // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(base_url().$save_file);        
    }
    
    public function pdf_viewer() {

    	$this->load->library('Pdf');
    	$data = $this->model->getExportLoghistory();

        $custom_layout = array(300,300);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 018', PDF_HEADER_STRING);
        $pdf->SetFont('helvetica', 'B', 15);
        $pdf->setPrintHeader(false);

        $pdf->setPrintFooter(false);
       
        $pdf->AddPage('P', $custom_layout);

        $subject = 'Vendor_log_history';

        $pdf->SetFont('helvetica', 'n', 12);
        
        $ch=0;

        $i = 1; 

        $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
   <head>

      <title>Vendor Log History</title>
      <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
   </head>
   <body style=" position: relative;
      width:400px;
      height: 100%; 
      margin: 0 auto !important; 
      color: #001028;
      background: #FFFFFF; 
      font-size: 12px; 
      border: 1px solid #efefef;">
     
      <table style="border:1px solid #bdbdbd" width="100%" cellspacing="0" cellpadding="5">
         <tbody>
            <tr style="background-color:#EFEFEF;">
               <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>#</b></td>
               <td style="width:20%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Admin</b></td>
               <td style="width:40%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Vendor</b></td>
               <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Mode</b></td>
               <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Date</b></td>
               <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>P Address</b></td>
            </tr>';
            $i = 1;
            foreach ($data as $key => $value) {
      

            $html .= '<tr>
               <td style="width:10%;font-size:10px;text-align:center;border-right:1px solid #bdbdbd;">'.$i++.'</td>
               <td style="width:20%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; "> '.$value['fk_admin'].'</td>
               <td style="width:40%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; "> '.$value['fk_vendor'].'</td>
               <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd;">'.$value['chr_mode'].'</td>
               <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; ">'.$value['dt_createddate'].'</td>
               <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; ">'.$value['var_ipaddress'].'</td>
            </tr>';
          }

            $html .= '</tbody>
      </table>
   </body>
</html>';

//echo $html;exit;
      // set some language dependent data:
$lg = Array();
$l['a_meta_charset'] = 'UTF-8';
$l['a_meta_dir'] = 'ltr';
$l['a_meta_language'] = 'hi';
$lg['w_page'] = 'page';

// set some language-dependent strings (optional)
$pdf->setLanguageArray($lg);

// ---------------------------------------------------------

// set font
$pdf->SetFont('freesans', '', 12);
        $pdf->writeHTML($html, true, false, false, false, '');

        $pdf_name = time().'log'.$data['order_id'];

        if (!is_dir('uploads/vendor_log_history')) {
			     mkdir('uploads/vendor_log_history', 0777, TRUE);
		    }

        $pdf_path = base_url().'uploads/vendor_log_history/';
        $pdf->Output($pdf_name.'.pdf', 'D');
        $get_pdf = $pdf_path.$pdf_name.'.pdf';
        //echo $get_pdf;
        return "True";
    }
    
    public function pdf_viewer_vendor() {

            $this->load->library('Pdf');
            $data = $this->model->getExportVendors();

            $custom_layout = array(300,300);

            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 018', PDF_HEADER_STRING);
            $pdf->SetFont('helvetica', 'B', 15);
            $pdf->setPrintHeader(false);

            $pdf->setPrintFooter(false);

            $pdf->AddPage('P', $custom_layout);

            $subject = 'Vendor';

            $pdf->SetFont('helvetica', 'n', 12);

            $ch=0;

            $i = 1; 

            $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html lang="en">
       <head>

          <title>Vendor Log History</title>
          <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
       </head>
       <body style=" position: relative;
          width:400px;
          height: 100%; 
          margin: 0 auto !important; 
          color: #001028;
          background: #FFFFFF; 
          font-size: 12px; 
          border: 1px solid #efefef;">

          <table style="border:1px solid #bdbdbd" width="100%" cellspacing="0" cellpadding="5">
             <tbody>
                <tr style="background-color:#EFEFEF;">
                   <td style="width:5%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>#</b></td>
                   <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Name</b></td>
                   <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Mobile No.</b></td>
                   <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Alternate Mobile No.</b></td>
                   <td style="width:15%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Email</b></td>
                   <td style="width:20%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Address</b></td>
                   <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Latitude</b></td>
                   <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Longitude</b></td>
                   <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Created Date</b></td>
                </tr>';
                $i = 1;
                foreach ($data as $key => $value) {

                $html .= '<tr>
                   <td style="width:5%;font-size:10px;text-align:center;border-right:1px solid #bdbdbd;">'.$i++.'</td>
                   <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; "> '.$value['var_name'].'</td>
                   <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; "> '.$value['var_mobile_no'].'</td>
                   <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd;">'.$value['var_alt_mobile'].'</td>
                   <td style="width:15%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; ">'.$value['var_email'].'</td>
                   <td style="width:20%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; ">'.$value['var_address'].'</td>
                   <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; ">'.$value['var_latitude'].'</td>
                   <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; ">'.$value['var_longitude'].'</td>
                   <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; ">'.$value['dt_createddate'].'</td>
                </tr>';
              }

                $html .= '</tbody>
          </table>
       </body>
    </html>';

    //echo $html;exit;
          // set some language dependent data:
    $lg = Array();
    $l['a_meta_charset'] = 'UTF-8';
    $l['a_meta_dir'] = 'ltr';
    $l['a_meta_language'] = 'hi';
    $lg['w_page'] = 'page';

    // set some language-dependent strings (optional)
    $pdf->setLanguageArray($lg);

    // ---------------------------------------------------------

    // set font
    $pdf->SetFont('freesans', '', 12);
            $pdf->writeHTML($html, true, false, false, false, '');

            $pdf_name = time().'vendor';

            if (!is_dir('uploads/export_venor')) {
                                 mkdir('uploads/export_venor', 0777, TRUE);
                        }

            $pdf_path = base_url().'uploads/export_venor/';
            $pdf->Output($pdf_name.'.pdf', 'D');
            $get_pdf = $pdf_path.$pdf_name.'.pdf';
            //echo $get_pdf;
            return "True";
        }
    
}                                         