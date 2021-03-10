<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends Front_Controller {
	
	public function __construct() {
		
		parent::__construct();
            $this->load->library(array('session','form_validation','mylibrary'));
            $this->load->library('recaptcha');
			$this->load->helper(array('form'));
			$this->load->model('Pages_model','model');
	}

	public function index()
	{ 
		$this->load_view('home');
	}

	public function prrivacy_policy()
	{ 
		$this->load->view('privacy');
	}

	public function terms_conditions()
	{ 
		$this->load->view('terms');
	}
        
    public function aboutus()
	{ 
	    $data["product"] = $this->model->product_list();
	   // echo "<pre>";print_r($data);die();
		$this->load_view('about_us', $data);
	}

	public function blog()
	{ 
	    $data["blog"] = $this->model->getBlog();
		$this->load_view('blog', $data);
	}

	public function news()
	{ 
	    $data["news"] = $this->model->getNews();
		$this->load_view('news', $data);
	}

	public function blog_details($id)
	{ 
		$idb = base64_decode($id);
		$data['category'] = $this->model->getCategory();
        $data['top_product'] = $this->model->top_product();
	    $data["blog"] = $this->model->getBlogdetails($idb);
		$this->load_view('blog_details', $data);
	}

	public function news_details($id)
	{ 
		$idb = base64_decode($id);
		$data['category'] = $this->model->getCategory();
        $data['top_product'] = $this->model->top_product();
	    $data["news"] = $this->model->getNewsdetails($idb);
		$this->load_view('news_details', $data);
	}

	public function stores()
	{ 
	    $data["stores"] = $this->model->getStore();
		$this->load_view('stors_near_you', $data);
	}

	public function refund_policy()
	{
		$this->load_view('refund');
	}

	public function disclaimer_policy()
	{
		$this->load->view('disclaimer');
	}
	
	public function vendor_agreement()
	{
	    $this->load_view('vendor_agreement');
	}

    public function contact()
	{ 
		/*----------------- google captcha ------------------*/
        $recaptcha = $this->input->post('g-recaptcha-response');
        if (!empty($recaptcha)) {
            $response = $this->recaptcha->verifyResponse($recaptcha);
            if (isset($response['success']) and $response['success'] === true) {
                echo "You got it!";
            }
        }

        $data = array(
            'widget' => $this->recaptcha->getWidget(),
            'script' => $this->recaptcha->getScriptTag(),
        );

		$this->load_view('contact_us',$data);
	}
	
	public function contact_us()
	{  
	    $contact = $this->model->add_contact_us();
		echo $contact;
		exit;
	}
	//ingredient_health new page added
	// Vaishali Magar 02-03-2021
	public function ingredient_health()
	{
	    $data["ingredient_health"] = $this->model->ingredient_health();
		$this->load_view('ingredient_health', $data);
	}
	//testimonials new page added
	// Vaishali Magar 02-03-2021
	public function testimonial()
	{ 
	  $data["testimonial"] = $this->model->getTestimonial();
		$this->load_view('testimonial', $data);
	}
	// fetch all city
	function shop_city() 
	{
		$data['city'] = $this->Pages_model->shop_city();
        return $data['city'];
	}
	//fetch all Location
	function shop_location() 
	{
		$data['location'] = $this->Pages_model->shop_location();
        return $data['location'];
	}
	//shop location Details
	function shopLocation($int_glcode)
    {	
		$data = $this->Pages_model->shopLocation($int_glcode);
        echo json_encode($data);
    }
        
}                                    