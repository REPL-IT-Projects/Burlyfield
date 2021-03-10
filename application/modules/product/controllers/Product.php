<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends Front_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session','form_validation','mylibrary','pagination'));
		$this->load->helper(array('form','url'));
		$this->load->model('Product_Model','model');
		
	}

	public function index()
	{ 
      $data['category'] = $this->model->getCategory();
      $data['new_product'] = $this->model->new_product();
      $data['top_product'] = $this->model->top_product();
      
      $allcount = $this->model->product_count();
      $data['total_rows'] = $allcount;

      $query = $this->db->where('chr_delete','N')->get('mst_products');
      $data['total_users'] = $query->num_rows();

      $data['products'] = $this->model->getProducts(0,12);
      // Pagination Configuration
      $config['base_url'] = base_url() . 'product/loadProduct/';
      $config['use_page_numbers'] = TRUE;
      $config['total_rows'] = $allcount;
      $config['per_page'] = 15;

              // Initialize
      $this->pagination->initialize($config);

              // Initialize $data Array
      $data['pagination'] = $this->pagination->create_links();
      $data['row'] = 0;

      $this->load_view('product_list',$data);
		
	}

  public function check_pincode(){
      
      $check_pin = $this->model->checkpin_pid();
      echo $check_pin;
  }
	
	public function category($id)
	  {
	    $catid = base64_decode($id);
	    $data['category'] = $this->model->getCategory();
      $data['new_product'] = $this->model->new_product();
      $data['top_product'] = $this->model->top_product();
      
      $allcount = $this->model->product_count();
      $data['total_rows'] = $allcount;

      $query = $this->db->where('chr_delete','N')->get('mst_products');
      $data['total_users'] = $query->num_rows();
      $data['banner_cat'] = $this->db->get_where('mst_category',array('int_glcode =' => $catid))->result_array();
       // print_r($data['banner_cat']); die();
      $data['products'] = $this->model->getProducts_list(0,15,$catid);
      // Pagination Configuration
      $config['base_url'] = base_url() . 'product/loadProduct/';
      $config['use_page_numbers'] = TRUE;
      $config['total_rows'] = $allcount;
      $config['per_page'] = 15;

              // Initialize
      $this->pagination->initialize($config);

              // Initialize $data Array
      $data['pagination'] = $this->pagination->create_links();
      $data['row'] = 0;

      $this->load_view('category_list',$data);
	  }   


    public function loadProduct($rowno=0) { 

            $search = $_GET['append'];           
            $_field = $_GET['field'];           
            $_sort = $_GET['sort']; 
            $country = $_GET['sel_val'];
            $offer = $_GET['offer_val'];
                   // Row per page
            $rowperpage = $_GET['entries'];
            $catid = $_GET['catid'];

                // Row position
            if($rowno != 0){
              $rowno = ($rowno-1) * $rowperpage;
          }

                
          $data['category'] = $this->model->getCategory();
      $data['new_product'] = $this->model->new_product();
      $data['top_product'] = $this->model->top_product();
      
      $allcount = $this->model->product_count($search,$country,$catid,$offer);
      $data['total_rows'] = $allcount;

      $query = $this->db->where('chr_delete','N')->get('mst_products');
      $data['total_users'] = $query->num_rows();

      $data['products'] = $this->model->getProducts($rowno,$rowperpage,$search,$_field,$_sort,$country,$catid,$offer);
      // Pagination Configuration
      $config['base_url'] = base_url() . 'product/loadProduct/';
      $config['use_page_numbers'] = TRUE;
      $config['total_rows'] = $allcount;
      $config['per_page'] = 15;

              // Initialize
      $this->pagination->initialize($config);

                // Initialize $data Array
          $data['pagination'] = $this->pagination->create_links();
          $data['result'] = $users_record;
          $data['row'] = $rowno;

          echo json_encode($data);

      }

    public function detail($id)
	  { 
        $id = base64_decode($id);
        $data['category'] = $this->model->getCategory();
        $data['new_product'] = $this->model->new_product();
        $data['top_product'] = $this->model->top_product();
  		  $data['product'] = $this->model->getProductsDetail($id);
        $data['cat_by_product'] = $this->model->cat_by_product($data['product']['fk_category'],$data['product']['int_glcode']);
        $rev = array('fk_product='=>$id,'chr_publish'=>"Y");
        $data['review'] = $this->db->get_where('mst_review',$rev)->result_array();
        // echo "<pre>";print_r($data);die();
		    $this->load_view('product_detail',$data);
	  }
        
      public function get_price(){
            $qid = $_POST['qid']; 
            $qty = $_POST['qty']; 
            if($qty == ''){
                $qty = 0;
            }
            
            $sel = $this->db->query("select * from trn_product_price where int_glcode = '".$qid."'");

            $res = $sel->row_array();
            
            if($_POST['offer'] == '0'){
                $price = $res['var_price'];
            }else{ 
                $price = $res['var_discount_price'];
            }

            $total = $price * $qty;
                    
            echo $total;exit;
       }

    public function review(){

      $id = $this->input->post('id');

      $addData = array(
            'var_name' => $this->input->post('var_name'),
            'var_email' => $this->input->post('var_email'),
            'var_rate' => $this->input->post('rate'),
            'var_message' => $this->input->post('message'),
            'fk_product' => $id,
            'dt_createddate' => date('Y-m-d H:i:s'),
            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
        );
      // echo "<pre>";print_r($addData);die();
      $this->common_model->insertRow($addData, "mst_review");
      $data['category'] = $this->model->getCategory();
        $data['new_product'] = $this->model->new_product();
        $data['top_product'] = $this->model->top_product();
        $data['product'] = $this->model->getProductsDetail($id);
        $data['cat_by_product'] = $this->model->cat_by_product($data['product']['fk_category'],$data['product']['int_glcode']);
        $rev = array('fk_product='=>$id,'chr_publish'=>"Y");
        $data['review'] = $this->db->get_where('mst_review',$rev)->result_array();
        // echo "<pre>";print_r($data); die();
        $this->load_view('product_detail',$data);
    }
       
}                                    