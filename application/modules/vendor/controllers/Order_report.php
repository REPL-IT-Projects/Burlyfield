<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_report extends Vendor_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session','form_validation','mylibrary'));
		$this->load->model('common_model');
		$this->load->model('Order_report_model','model');
	}

	/*---------------------------- view data index -----------------------*/
	public function index()
	{
                $data['order_report'] = $this->model->getOrderReport($_SESSION['fk_vendor']);
                $this->load_view('order_report/view_order_report',$data);
	}

	public function order_detail_modal(){

                $vendor_id = $_SESSION['fk_vendor'];
		$order_id = $_POST['fk_order'];

                $data['order'] = $this->model->get_orderData($vendor_id,$order_id);

		$this->load->view('order_report/order_detail_modal',$data);
    }
    
        public function filter()
	{
            $payment_method = $_GET['payment_method'];
            $from_date = $_GET['from_date'];
            $to_date = $_GET['to_date'];
            
                $data['order_report'] = $this->model->getOrderFilter($_SESSION['fk_vendor'],$payment_method,$from_date,$to_date);
                $this->load_view('order_report/view_order_report',$data);
	}
    
         public function createXLS() 
    {
    	$orderInfo = $this->model->getOrderReport($_SESSION['fk_vendor']);
    	//echo "<pre>"; print_r($orderInfo); exit();
    	if (!is_dir('uploads/export_orders')) {
			 	mkdir('uploads/export_orders', 0777, TRUE);
		  }

    	// create file name
        $fileName = 'orders-'.time().'.xlsx';  
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
        foreach ($orderInfo['order_data'] as $element) {
        

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
            $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $element['var_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, $element['var_mobile_no']);
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
            $data = $this->model->getOrderReport($_SESSION['fk_vendor']);

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
                   <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Vendor Name</b></td>
                   <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Vendor Mobileno</b></td>
                </tr>';
                $i = 1;
                foreach ($data['order_data'] as $key => $value) {
 
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
                   <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd;">'.$value['var_name'].'</td>
                   <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; ">'.$value['var_mobile_no'].'</td>
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

            $pdf_name = time().'order';

            if (!is_dir('uploads/export_orders')) {
                                 mkdir('uploads/export_orders', 0777, TRUE);
                        }

            $pdf_path = base_url().'uploads/export_orders/';
            $pdf->Output($pdf_name.'.pdf', 'D');
            $get_pdf = $pdf_path.$pdf_name.'.pdf';
            //echo $get_pdf;
            return "True";
        }
        
}                                         