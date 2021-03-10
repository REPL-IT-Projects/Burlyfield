<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages_model extends CI_Model {
   
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('common_model');    
    }

    public function add_contact_us()
    {
        $addData = array(
            'var_name' => $this->input->post('name'),
            'var_email' => $this->input->post('var_email_contact'),
            'var_subject' => $this->input->post('subject'),
            'var_phone' => $this->input->post('phone'),
            'var_message' => $this->input->post('message'),
            'dt_createddate' => date('Y-m-d H:i:s'),
            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
        );

        $id = $this->common_model->insertRow($addData, "mst_contact_us");
        
        return $id;
    }
    
    
    function product_list(){
        
        $this->db->select('mp.int_glcode,mp.fk_category,mp.var_title,mp.var_image,mp.var_offer');
        $this->db->from('mst_products mp');
        $this->db->where('mp.chr_publish','Y');
        $this->db->where('mp.chr_delete','N');
        $this->db->order_by('rand()');
        $query = $this->db->get();
        $result = $query->result_array();
        
        if(count($result) > 0){
        foreach($result as $rrr){
            $prices = $this->common_model->get_product_price($rrr['int_glcode']); 
            $rrr['var_price'] = $prices[0]['var_price'];
            $rrr['var_discount_price'] = $prices[0]['var_discount_price'];
            $rrr['var_quantity'] = $prices[0]['var_quantity']; 
            $new_arr[] = $rrr;
        }
        }else{
            $new_arr = array();
        }
        return $new_arr;
    }
    
    public function getBlog(){
        
        $this->db->select('*');
        $this->db->from('mst_blog');
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;
    }

    public function getNews(){
        
        $this->db->select('*');
        $this->db->from('mst_news');
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;
    }

    public function getStore(){
        
        $this->db->select('*');
        $this->db->from('mst_stors');
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;
    }

    public function getBlogdetails($id)
    {  
        $this->db->select('*');
        $this->db->from('mst_blog');
        $this->db->where('int_glcode',$id);
        $query = $this->db->get();
        $result = $query->result_array();
        
        return $result;
    }

    public function getNewsdetails($id)
    {  
        $this->db->select('*');
        $this->db->from('mst_news');
        $this->db->where('int_glcode',$id);
        $query = $this->db->get();
        $result = $query->result_array();
        
        return $result;
    }

    function top_product(){
        
        $this->db->select('mp.int_glcode,mp.fk_category,mp.var_title,mp.var_image,mp.var_offer');
        $this->db->from('mst_products mp');
        $this->db->where('mp.chr_publish','Y');
        $this->db->where('mp.chr_delete','N');
        $this->db->order_by('rand()');
        $this->db->limit('5');
        $query = $this->db->get();
        $result = $query->result_array();
        
        if(count($result) > 0){
        foreach($result as $rrr){
            $prices = $this->common_model->get_product_price($rrr['int_glcode']); 
            $rrr['q_id'] = $prices[0]['int_glcode'];
            $rrr['var_price'] = $prices[0]['var_price'];
            $rrr['var_discount_price'] = $prices[0]['var_discount_price'];
            $rrr['var_quantity'] = $prices[0]['var_quantity']; 
            $new_arr[] = $rrr;
        }
        }else{
            $new_arr = array();
        }
        return $new_arr;
    }

    public function getCategory()
    {
        $this->db->select('mp.*');
        $this->db->from('mst_category mp');
        $this->db->where('mp.chr_publish','Y');
        $this->db->where('mp.chr_delete','N');

        $query = $this->db->get();
        $row = $query->result_array();
        
        return $row;
    }
	//ingredient_health new page added  
	// Vaishali Magar 02-03-2021
	  public function ingredient_health(){
        
        $this->db->select('*');
        $this->db->from('mst_ingredient');
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;
    }
	//testimonials new page added
	// Vaishali Magar 02-03-2021
	 public function getTestimonial()
	 {
        $this->db->select('*');
        $this->db->from('mst_testimonial');
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;
    }
	// Fetch shop city
    public function shop_city()
    {
        $this->db->select('*');
        $this->db->from('mst_stors');
        $query = $this->db->get();
        if ($query->num_rows() >= 1) 
        {
            return $query;
        } 
        else 
        {
            return false;
        }
    }
	//shop Location Fetch 
    public function shop_location()
    {
        $this->db->select('*');
        $this->db->from('mst_stors');
        $this->db->group_by('var_address'); 
        $query = $this->db->get();
        if ($query->num_rows() >= 1) 
        {
            return $query;
        } 
        else 
        {
            return false;
        }
    }
    
	 //fetch plant Location details
    public function shopLocation($int_glcode) {
        $condition = "int_glcode =" . "'" . $int_glcode . "'";
        $this->db->select('*');
        $this->db->from('mst_stors');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->row();
    }


}