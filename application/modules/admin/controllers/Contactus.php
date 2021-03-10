<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactus extends Admin_Controller {   

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public function __construct() {
		
		parent::__construct();
                $this->load->database();
		$this->load->helper(array('form'));
		$this->load->library(array('session','form_validation','mylibrary','pagination'));
                $this->load->model('Contactus_Model','model');
              
	}
        
	public function index()
	{
		//$data['data'] = $this->model->viewUser();
		$allcount = $this->model->staff_count();
		$data['total_rows'] = $allcount;

		$query = $this->db->get('mst_contact_us');
		$data['total_staff'] = $query->num_rows();

		$data['data'] = $this->model->getStaffData(0,10);

        // Pagination Configuration
		$config['base_url'] = base_url() . 'contactus/loadStaff/';
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $allcount;
		$config['per_page'] = 10;

        // Initialize
		$this->pagination->initialize($config);

        // Initialize $data Array
		$data['pagination'] = $this->pagination->create_links();
		$data['row'] = 0;

		$this->load_view('contactus/view_contactus',$data);

	}

	/////////////// list user pagination ////////////////////
	public function loadStaff($rowno=0) { 

		$search = $_GET['append'];           
		$_field = $_GET['field'];           
		$_sort = $_GET['sort'];           
           // Row per page
		$rowperpage = $_GET['entries'];

        // Row position
		if($rowno != 0){
			$rowno = ($rowno-1) * $rowperpage;
		}

        //print_r($search); exit();
        // All records count
		$allcount = $this->model->staff_count($search);

		$data['total_rows'] = $allcount;
        //$data['total_banners'] = $this->db->count_all('mst_user');

		$query = $this->db->get('mst_contact_us');
		$data['total_staff'] = $query->num_rows();
    	// Get records
		$users_record = $this->model->getStaffData($rowno,$rowperpage,$search,$_field,$_sort);

        // print_r($allcount); exit();
        // Pagination Configuration
		$config['base_url'] = base_url() . 'contactus/loadStaff/';
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

        public function delete_multiple() 
	{
		//$this->model->delMultiplePlan();
		$result = $this->model->delete_multiple();
		echo $result;
		//$this->load_view('invest/view_plan');
		//exit;
	}
        
        function submit_report(){
            
            $array = array(
                'var_action_report' => $this->input->post('txt_message')
            );
            $this->db->where('int_glcode',$this->input->post('int_glcode'));
            $update = $this->db->update('mst_contact',$array);
            
            echo 1;exit;
        }
        
        function export_csv(){
            
            $query = $this->db->query("SELECT * FROM mst_contact where chr_delete='N' ORDER BY int_glcode DESC");
            $result = $query->result_array();
            
            if(count($result) > 0){
                $delimiter = ",";
                $filename = "contactus_" . date('Y-m-d') . ".csv";

                //create a file pointer
                $f = fopen('php://memory', 'w');

                //set column headers
                $fields = array('ID', 'Name', 'Email', 'Subject', 'Message', 'Date');
                fputcsv($f, $fields, $delimiter);

                //output each row of the data, format line as csv and write to file pointer
                foreach($result as $key => $row){
                    $key += 1;
                    $lineData = array($key, $row['var_fname'].' '.$row['var_lname'], $row['var_email'], $row['var_subject'], $row['txt_comment'], $row['dt_createddate']);
                    fputcsv($f, $lineData, $delimiter);
                }

                //move back to beginning of file
                fseek($f, 0);

                //set headers to download file rather than displayed
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment; filename="' . $filename . '";');

                //output all remaining data on a file pointer
                fpassthru($f);
            }
            exit;
        }
        
}                                         