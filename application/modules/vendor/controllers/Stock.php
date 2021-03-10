<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends Vendor_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session','form_validation','pagination','mylibrary'));
		$this->load->model('common_model');
		$this->load->model('Stock_model','model');
	}

	/*---------------------------- view data index -----------------------*/
	public function index()
	{
    
		$data['data'] = $this->model->getProductList($_SESSION['fk_vendor']);
		$this->load_view('stock/view_stock',$data);

	}
        
        public function stockUpdate()
        {
            $vendor_id = $_SESSION['fk_vendor'];
            $fk_product = $_POST['pid'];
            $chr_status = $_POST['flag'];

                $data = $this->model->updateStock($vendor_id,$fk_product,$chr_status);
              
            echo 1;
            exit;
        }

}                                         