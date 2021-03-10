<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session','form_validation','pagination','mylibrary'));
		$this->load->model('common_model');
		$this->load->model('User_model','model');
	}

	/*---------------------------- view data index -----------------------*/
	public function index()
	{
		$allcount = $this->model->records_count();
		$data['total_rows'] = $allcount;

		$query = $this->db->where('chr_delete', 'N')->get('mst_users');
		$data['total_data'] = $query->num_rows();

		$data['data'] = $this->model->getData(0,10);

		// Pagination Configuration
		$config['base_url'] = base_url() . 'user/loadData/';
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $allcount;
		$config['per_page'] = 10;

        // Initialize
		$this->pagination->initialize($config);

        // Initialize $data Array
		$data['pagination'] = $this->pagination->create_links();
		$data['row'] = 0;
		$this->load_view('user/view_user',$data);

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

		$query = $this->db->where('chr_delete', 'N')->get('mst_users');
		$data['total_data'] = $query->num_rows();
        // Get records
		$users_record = $this->model->getData($rowno,$rowperpage,$search,$_field,$_sort);

        // Pagination Configuration
		$config['base_url'] = base_url() . 'user/loadData/';
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
	public function add_user()
	{
		$this->load_view('user/add_user');
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
		    $this->session->set_flashdata('flash_message',UNIQUE_EMAIL);
            redirect('admin/user','refresh');
		} elseif ($check_mobile == false) {
		    $this->session->set_flashdata('flash_message',UNIQUE_MOBILE);
            redirect('admin/user','refresh');
		} else {
			// validation not ok, send validation errors to the view
			// Set flash data 
			$this->model->addRecord();
			$this->session->set_flashdata('flash_message',ADD_SUCCESS);
            redirect('admin/user','refresh');
		}
	}

	/*------------------ edit view record ----------------------*/ 
	public function editUser($userId)
	{
		$userId=base64_decode($userId);
		//echo $userId; exit();
		$data['data'] = $this->model->getIdByData($userId);
		$data['address'] = $this->model->getUserByAddress($userId);
		$this->load_view('user/edit_user',$data);
	}

	/*------------------ edit record in DB ----------------------*/ 
	public function update_user($id)
	{
		if (isset($_POST['submit'])) {
			$this->model->updateRecord($id);
			$this->session->set_flashdata('Invalid', EDIT_SUCCESS);
			redirect('admin/user');
		} else {
			redirect('admin/user');
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

	/*----------------------- delete user address ------------------------*/
	public function deleteAddress()
	{
		//echo "hello";die();
		$id = $_POST['id'];
		$this->db->set('chr_delete', 'Y');
		$this->db->where('int_glcode', $id);
		$this->db->update('mst_user_address');
		
		return  $id = $this->db->affected_rows();
	}

        public function createXLSVendors() {
            $venodrInfo = $this->model->getExportUser();
            //echo "<pre>"; print_r($venodrInfo); exit();
            if (!is_dir('uploads/export_user')) {
                                    mkdir('uploads/export_user', 0777, TRUE);
                    }
            // create file name
            $fileName = 'users-'.date("jmYGis").'.xlsx';  
            $save_file = 'uploads/export_user/'.$fileName;
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
            $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Created Date'); 
            // set Row
            $rowCount = 2;
            $sr_no = 1;
            foreach ($venodrInfo as $element) {
                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $sr_no++);
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['var_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['var_mobile_no']);
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['var_alt_mobile']);
                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['var_email']);
                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['dt_createddate']);
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
            $data = $this->model->getExportUser();

            $custom_layout = array(300,300);

            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 018', PDF_HEADER_STRING);
            $pdf->SetFont('helvetica', 'B', 15);
            $pdf->setPrintHeader(false);

            $pdf->setPrintFooter(false);

            $pdf->AddPage('P', $custom_layout);

            $subject = 'Users';

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
                   <td style="width:20%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Name</b></td>
                   <td style="width:20%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Mobile No.</b></td>
                   <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Alternate Mobile No.</b></td>
                   <td style="width:30%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Email</b></td>
                   <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Created Date</b></td>
                </tr>';
                $i = 1;
                foreach ($data as $key => $value) {


                $html .= '<tr>
                   <td style="width:10%;font-size:10px;text-align:center;border-right:1px solid #bdbdbd;">'.$i++.'</td>
                   <td style="width:20%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; "> '.$value['var_name'].'</td>
                   <td style="width:20%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; "> '.$value['var_mobile_no'].'</td>
                   <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd;">'.$value['var_alt_mobile'].'</td>
                   <td style="width:30%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; ">'.$value['var_email'].'</td>
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

            $pdf_name = date("jmYGis").'user';

            if (!is_dir('uploads/export_user')) {
                                 mkdir('uploads/export_user', 0777, TRUE);
                        }

            $pdf_path = base_url().'uploads/export_user/';
            $pdf->Output($pdf_name.'.pdf', 'D');
            $get_pdf = $pdf_path.$pdf_name.'.pdf';
            //echo $get_pdf;
            return "True";
        }
    
}                                     
