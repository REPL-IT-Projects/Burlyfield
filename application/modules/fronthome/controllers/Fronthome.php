<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fronthome extends Front_Controller {
    
    public function __construct() {
        
        parent::__construct();
        $this->load->library(array('session','form_validation','mylibrary'));
        $this->load->helper(array('form'));
        $this->load->model('Fronthome_Model','model');
        
    }

    public function index()
    { 
        //echo "<pre>"; print_r($_SESSION); exit();
        $data['banner_img'] = $this->model->get_banner_img();
        $data['top_product'] = $this->model->top_product();
        $data['category'] = $this->model->getCategory();
        $data['offer_product'] = $this->model->getOfferProduct();
        $data['testimonial'] = $this->model->getTestimonial();
        $data['blog'] = $this->model->getBlog();
        $data['offer1'] = $this->db->get_where('mst_home_banners',array('int_glcode' => 13))->result_array();
        $data['offer2'] = $this->db->get_where('mst_home_banners',array('int_glcode' => 14))->result_array();

        if (isset($_SESSION['fk_user'])) {
            $recent_p = $this->model->get_recent_products($_SESSION['fk_user']);
        } else {
            $recent_p = array();
        }
        // echo "<pre>"; print_r($data['category']); exit();
        $data['recent_p'] = $recent_p;
		
        $this->load_view('home',$data);
    }
    
    public function get_allproduct() {
        //echo "qweqeqe";die();
        $str = $_POST['keyword'];

        $result = $this->model->get_allproduct($str);

        echo $result;
    }

    public function faq()
    {
        $this->load_view('faq_tpl');
    }
	
    public function newsletter_submit(){
        
        $email = $this->input->post('email');
        
        if($email == ''){
            
            echo 'Please enter email address';exit;
        }else{
            
            $array = array(
                'var_email' => $email,
                'dt_createddate' => date('Y-m-d H:i:s'),
                'var_ipaddress' => $_SERVER['SERVER_ADDR']
            );
            $sql = $this->db->insert("mst_newsletter",$array);
            
            //$this->common_model->send_newsletter_user($email);
            //$this->common_model->send_newsletter_admin($email);

        }
        
        echo 1;exit;
    }
    
}                                    