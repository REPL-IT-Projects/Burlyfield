<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends Admin_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->library(array('session','form_validation','pagination','mylibrary'));
		$this->load->model('common_model');
		$this->load->model('Order_model','model');

	}

	/*---------------------------- view data index -----------------------*/
	public function index()
	{
		$allcount = $this->model->records_count();
		$data['total_rows'] = $allcount;
		$query = $this->db->get('mst_orders');
		$data['total_data'] = $query->num_rows();
		$data['data'] = $this->model->getData(0,10);
		// Pagination Configuration
		$config['base_url'] = base_url() . 'orders/loadData/';
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $allcount;
		$config['per_page'] = 10;
    	// Initialize
		$this->pagination->initialize($config);
    	// Initialize $data Array
		$data['pagination'] = $this->pagination->create_links();
		$data['row'] = 0;

    $data['vendors'] = $this->model->getVendorList();
		$this->load_view('orders/view_order',$data);

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
		$query = $this->db->get('mst_orders');
		$data['total_data'] = $query->num_rows();
    	// Get records
		$users_record = $this->model->getData($rowno,$rowperpage,$search,$_field,$_sort);
        // Pagination Configuration
		$config['base_url'] = base_url() . 'orders/loadData/';
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

	/*------------------ edit view record ----------------------*/ 
	public function viewDetails($Id)
	{
		$Id=base64_decode($Id);
		//echo $vendorId; exit();
		$data['data'] = $this->model->getIdByData($Id);
// 		$data['vendor'] = $this->model->getIdByVendorData($Id);
		//echo "<pre>"; print_r($data); exit();
		$this->load_view('orders/view_details',$data);
	}

  function OrderStatus()
  {
      $id = $_POST['id'];
      $status = $_POST['status'];
      // echo $id." / ".$status;
      $data = $this->model->OrderStatus($id,$status);
      echo json_encode('true');
   }

   public function shipping(){
    $this->model->editshipping();
    redirect('admin/orders');
   }
	/*------------------ edit record in DB ----------------------*/ 
	public function update_product($id)
	{
		if (isset($_POST['submit'])) {
			$this->model->updateRecord($id);
			$this->session->set_flashdata('Invalid', EDIT_SUCCESS);
			redirect('admin/orders');
		} else {
			redirect('admin/orders');
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

	/*------------------------ delete product multiple images --------------------*/
	public function deleteProductImges()
	{
		//echo "hello";die();
		$id = $_POST['id'];
		$this->db->where('int_glcode', $id);
		$this->db->delete('trn_product_images');

		return  $id = $this->db->affected_rows();
	}

	/*------------------------ delete product multiple prices --------------------*/
	public function deleteProductPrices()
	{
		//echo "hello";die();
		$id = $_POST['id'];

		$this->db->where('int_glcode', $id);

		$this->db->delete('trn_product_price');

		return  $id = $this->db->affected_rows();
	}

	// create xlsx
    public function createXLS() 
    {
    	$orderInfo = $this->model->getExportOrders();
    	//echo "<pre>"; print_r($orderInfo); exit();
    	if (!is_dir('uploads/export_orders')) {
			 	mkdir('uploads/export_orders', 0777, TRUE);
		  }

    	// create file name
        $fileName = 'orders-'.date("jmYGis").'.xlsx';  
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
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Delivery Timeslot');       
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Delivery Status');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Delivery Charges'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Wallet Amount'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Discount Amount'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Total Amount'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Payable Amount'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Order Status'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('P1', 'Order Cancel By'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'Vendor Name'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('R1', 'Vendor Mobileno'); 

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
          

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $sr_no++);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['order_id']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['var_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['var_alternate_mobile']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['var_user_address']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['var_address_type']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['dt_createddate']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element['dt_timeslot']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element['chr_delivery_status']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element['var_delivery_charge']);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $element['var_wallet_amount']);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $element['var_discount_amount']);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $element['var_total_amount']);
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $element['var_payable_amount']);
            $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $element['chr_status']);
            $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $element['canceled_by']);
            $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $vendor_mame);
            $objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, $vendor_mobile);
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

    public function pdf_viewer_order() {

            $this->load->library('Pdf');
            $data = $this->model->getExportOrders();

            $custom_layout = array(300,300);

            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 018', PDF_HEADER_STRING);
            $pdf->SetFont('helvetica', 'B', 15);
            $pdf->setPrintHeader(false);

            $pdf->setPrintFooter(false);

            $pdf->AddPage('P', $custom_layout);

            $subject = 'Order';

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
                   <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Order ID</b></td>
                   <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>User</b></td>
                   <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Mobile No</b></td>
                   <td style="width:20%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>User Address</b></td>
                   <td style="width:5%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Address Type</b></td>
                   <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Order Date</b></td>
                   <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Order Status</b></td>
                   <td style="width:5%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Payable Amount</b></td>
                   
                </tr>';
                $i = 1;
                foreach ($data as $key => $value) {
 
                        

                $html .= '<tr>
                   <td style="width:5%;font-size:10px;text-align:center;border-right:1px solid #bdbdbd;">'.$i++.'</td>
                   <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; ">'.$value['order_id'].'</td>
                   <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; "> '.$value['var_name'].'</td>
                   <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; "> '.$value['var_alternate_mobile'].'</td>
                   <td style="width:20%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd;">'.$value['var_user_address'].'</td>
                   <td style="width:5%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; ">'.$value['var_address_type'].'</td>
                   <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; ">'.$value['dt_createddate'].'</td>
                   <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; "> '.$value['chr_status'].'</td>
                   <td style="width:5%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; "> '.$value['var_payable_amount'].'</td>
                   
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

            $pdf_name = date("jmYGis").'order';

            if (!is_dir('uploads/export_orders')) {
                                 mkdir('uploads/export_orders', 0777, TRUE);
                        }

            $pdf_path = base_url().'uploads/export_orders/';
            $pdf->Output($pdf_name.'.pdf', 'D');
            $get_pdf = $pdf_path.$pdf_name.'.pdf';
            //echo $get_pdf;
            return "True";
        }
        
    /*---------------------------------- generate invoice ---------------------------*/
    public function pdf_viewer($orderId) {

    	$this->load->library('Pdf');
    	$data = $this->model->getIdByDataPDF($orderId);
		  // $vendor = $this->model->getIdByVendorDataPDF($orderId);
      //echo "<pre>"; print_r($vendor); exit();
		  

      if ($data['canceled_by'] == 'U') {
        $cancel_data = 'User';
      } elseif ($data['canceled_by'] == 'S') {
        $cancel_data = 'System';
      } else {
        $cancel_data = 'Vendor';
      }
      	//echo "<pre>"; print_r($data); exit;
        //echo $name; echo $phoneno; echo $adminuser; exit;
        $custom_layout = array(300,300);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 018', PDF_HEADER_STRING);
        $pdf->SetFont('helvetica', 'B', 15);
        $pdf->setPrintHeader(false);

        $pdf->setPrintFooter(false);
        // add a page
       /* $pdf->AddPage('L', 'A4');*/

        $pdf->AddPage('P', $custom_layout);

        $subject = 'Vruits_Invoice';

        $pdf->SetFont('helvetica', 'n', 12);
        
       // $pdf->addTTFfont('fonts/arialuni.ttf', 'TrueTypeUnicode', '', 32);

        $date= date('d/m/y');

        $ch=0;

        $i = 1; 

        $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
   <head>

      <title>Invoice PDF</title>
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
      <table width="100%" cellspacing="0" cellpadding="0">
         <tbody>
            <tr>
               <td style="width:50%;vertical-align:middle;">
                  <br><br style="line-height:40px;">
                  <img src="'.base_url().'public/front_assets/images/logo.png"  alt="" style="width:200px;">
               </td>
               <td style="text-align:right;width:50%;">';
               if ($data['chr_status'] == 'C') {
                  $html .= '<img src="'.base_url().'public/front_assets/images/completed.png" alt="" style="width:150px;">';
               } elseif ($data['chr_status'] == 'R') {
                  $html .= '<img src="'.base_url().'public/front_assets/images/rejected.png" alt="" style="width:150px;">';
               } elseif ($data['chr_status'] == 'W' || $data['chr_status'] == 'SH' || $data['chr_status'] == 'RC') {
                  $html .= '<img src="'.base_url().'public/front_assets/images/in-progress.png" alt="" style="width:150px;">';
               } elseif ($data['chr_status'] == 'P') {
                  $html .= '<img src="'.base_url().'public/front_assets/images/pending.png" alt="" style="width:150px;">';
               } else {
                  $html .= '<img src="'.base_url().'public/front_assets/images/pending.png" alt="" style="width:150px;">';
               }
                
                  $html .= '<br><br style="line-height:10px;">
                      <p style="font-size:10px;right:50px;">'.$data['var_name'].'</p>
                  <p style="font-size:10px;right:50px;">'.$data['var_user_address'].'</p>
                  <p style="line-height:2px;font-size:8px;">'.$data['var_address_type'].'</p>
                  <p style="line-height:2px;font-size:10px;">Contact Details</p>
                  <p style="line-height:2px;font-size:8px;">'.$data['var_alternate_mobile'].'</p>';

                  if ($data['chr_status'] == 'R') {
                  $html .= '<p style="line-height:2px;font-size:8px;"><b>Canceled By</b>'.$cancel_data.'</p>';
               }

            $html .= '</td></tr>
         </tbody>
      </table>
      <br><br style="line-height:30px;">
      <table style="background-color:#EFEFEF;" width="100%" cellspacing="0" cellpadding="2">
         <tbody>
            <tr>
               <td style="font-size:18px;"><b>INVOICE #'.$data['order_id'].'</b></td>
            </tr>
            <tr>
               <td style="font-size:10px;">Order Date: '.date('d/m/Y',strtotime($data['dt_createddate'])).' </td>
            </tr>
         </tbody>
      </table>
      <br>';
            
         $html .= '
      <br><br style="line-height:15px;">
      <table style="border:1px solid #bdbdbd" width="100%" cellspacing="0" cellpadding="5">
         <tbody>
            <tr style="background-color:#EFEFEF;">
               <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>#</b></td>
               <td style="width:30%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Name</b></td>
               <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>QTY</b></td>
               <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Unit</b></td>
               <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>PRICE</b></td>
               <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Total</b></td>
               <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>GST</b></td>
               <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>SUBTOTAL</b></td>
            </tr>';
            $i = 1;
            foreach ($data['fk_product_arr'] as $key => $value) {
              $final_show_amt = $value['var_unit'] * $value['var_price'];
                  $GST = ($final_show_amt*$value['gst_price'])/100;
                  $total = $final_show_amt + $GST;
            if ($value['cancel_status'] == 'Y') {
                $value['cancel_status'] = 'Rejected';
            } else {
                $value['cancel_status'] = '-';
            }

            

            $html .= '<tr>
               <td style="width:10%;font-size:10px;text-align:center;border-right:1px solid #bdbdbd;">'.$i++.'</td>
               <td style="width:30%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; "> '.$value['var_name'].'</td>
               <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; "> '.$value['var_quantity'].'</td>
               <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd;">'.$value['var_unit'].'</td>
               <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; "><img src="'.base_url().'front_assets/images/rupee-indian.png" style="width: 7px;"> '.$value['var_price'].'</td>
               <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; "><img src="'.base_url().'public/front_assets/images/rupee-indian.png" style="width: 7px;"> '.$value['var_price'] * $value['var_unit'].'</td>
               <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; ">'.$value['gst_price'].' %</td>
               <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; "><img src="'.base_url().'public/front_assets/images/rupee-indian.png" style="width: 7px;"> '.$total.'</td>
            </tr>';
          }

          if ($data['var_cashback'] != '') {
                $cashback = $data['var_cashback'];
                $promocode = $data['var_promocode'];
            } else {
                $cashback = '-';
                $promocode = '-';
            }

            $html .= '<tr style="background-color:#EFEFEF;">
               <td colspan="8" style="width:90%;font-size:10px;text-align:right;border:1px solid #bdbdbd;"><b>Payment Type</b></td>
               <td style="width:10%;font-size:9px;text-align:center;border:1px solid #bdbdbd;"><b> '.$data['var_payment_mode'].'</b></td>
            </tr>
            <tr style="background-color:#EFEFEF;">
               <td colspan="8" style="width:90%;font-size:10px;text-align:right;border:1px solid #bdbdbd;"><b>Applied Promocode</b></td>
               <td style="width:10%;font-size:9px;text-align:center;border:1px solid #bdbdbd;"><b> '.$promocode.'</b></td>
            </tr>
            <tr style="background-color:#EFEFEF;">
               <td colspan="8" style="width:90%;font-size:10px;text-align:right;border:1px solid #bdbdbd;"><b>Cashback</b></td>
               <td style="width:10%;font-size:9px;text-align:center;border:1px solid #bdbdbd;"><b><img src="'.base_url().'public/front_assets/images/rupee-indian.png" style="width: 7px;">'.$cashback.'</b></td>
            </tr>
            <tr style="background-color:#EFEFEF;">
               <td colspan="8" style="width:90%;font-size:10px;text-align:right;border:1px solid #bdbdbd;"><b>Total Amount</b></td>
               <td style="width:10%;font-size:9px;text-align:center;border:1px solid #bdbdbd;"><b><img src="'.base_url().'public/front_assets/images/rupee-indian.png" style="width: 7px;"> '.$data['var_total_amount'].'</b></td>
            </tr>
            
            <tr style="background-color:#EFEFEF;">
               <td colspan="8" style="width:90%;font-size:9px;text-align:right;border-right:1px solid #bdbdbd;border-left:1px solid #bdbdbd;"><b>Delivery Charges</b></td>
               <td style="width:10%;font-size:9px;text-align:center;border-right:1px solid #bdbdbd;"><b><img src="'.base_url().'public/front_assets/images/rupee-indian.png" style="width: 7px;"> '.$data['var_delivery_charge'].'</b></td>
            </tr>
            
            <tr style="background-color:#EFEFEF;">
               <td colspan="8" style="width:90%;font-size:9px;text-align:right;border-right:1px solid #bdbdbd;border-left:1px solid #bdbdbd;"><b>Payable Amount</b></td>
               <td style="width:10%;font-size:9px;text-align:center;border-right:1px solid #bdbdbd;"><b><img src="'.base_url().'public/front_assets/images/rupee-indian.png" style="width: 7px;"> '.$data['var_payable_amount'].'</b></td>
            </tr>
         </tbody>
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

        $pdf_name = date("jmYGis").'Invoice'.$data['order_id'];

        if (!is_dir('uploads/order_invoice')) {
			     mkdir('uploads/order_invoice', 0777, TRUE);
		    }

        $pdf_path = base_url().'uploads/order_invoice/';
        //$pdf->Output(__DIR__ . '/uploads/order_invoice/'.$pdf_name.'.pdf', 'F');
        //$pdf->Output("uploads/order_invoice/".$pdf_name.".pdf", 'F');
        $pdf->Output($pdf_name.'.pdf', 'D');
        $get_pdf = $pdf_path.$pdf_name.'.pdf';
        //echo $get_pdf;
        return "True";
    }

}                                         