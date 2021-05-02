<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_Model extends CI_Model {
   
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('common_model');        
    }

    /*------------------------ get parent category  ------------------------- */
    public function getProductsDetail($id)
    {  
        $this->db->select('*');
        $this->db->from('mst_products');
        $this->db->where('int_glcode',$id);
        $query = $this->db->get();
        $result = $query->result_array();

        if(count($result) > 0){
        foreach($result as $rrr){
            $prices = $this->common_model->get_product_price($rrr['int_glcode']); 
            $rrr['q_id'] = $prices[0]['int_glcode'];
            $rrr['var_price'] = $prices[0]['var_price'];
            $rrr['var_quantity'] = $prices[0]['var_quantity']; 
            $new_arr[] = $rrr;
        }
        }else{
            $new_arr = array();
        }
        return $new_arr;
    }
    
    public function cat_by_product($id,$cid)
    {
        $this->db->select('*');
        $this->db->from('mst_products');
        $this->db->where('fk_category',$id);
        $this->db->where('int_glcode !=',$cid);
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $this->db->order_by('rand()');
        $this->db->limit('3');
        $query = $this->db->get();
        $result = $query->result_array();

        if(count($result) > 0){
        foreach($result as $rrr){
            $prices = $this->common_model->get_product_price($rrr['int_glcode']);
            $rrr['q_id'] = $prices[0]['int_glcode'];
            $rrr['var_price'] = $prices[0]['var_price'];
            $rrr['var_quantity'] = $prices[0]['var_quantity']; 
            $new_arr[] = $rrr;
        }
        }else{
            $new_arr = array();
        }
        return $new_arr;
    }

    public function getProducts($rowno,$rowperpage,$search = '',$_field = 'mp.int_glcode',$_sort = 'desc',$country = '',$catid='',$offer=''){
   
       $this->db->select('mp.int_glcode,mp.fk_category,mp.var_title,mp.var_image,mp.var_offer,mp.var_stock');
        $this->db->where('mp.chr_publish','Y');
        $this->db->where('mp.chr_delete','N');

        if ($offer == 'Yes') {
            $this->db->where('mp.var_offer !=','0');
        }

       $this->db->limit($rowperpage , $rowno);
       
       if ($search != '') {

            $this->db->group_start();
            $this->db->like("mp.var_title", $search);
            $this->db->group_end();

        }
        if ($country != '') {
           
            $ord_var = 'mp.'.$country;
            $this->db->order_by($ord_var,'ASC');
        }
        if($catid != ''){
            if ($catid[0] != 'on') {
                $this->db->where_in('fk_category', $catid);
            }
            
        }

        $query = $this->db->get('mst_products mp');
        
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
    
    public function getProducts_list($rowno,$rowperpage,$cat_id,$search = '',$_field = 'mp.int_glcode',$_sort = 'desc',$country = '',$catid='',$offer=''){

        // echo "<pre>"; print_r($cat_id); 
       $this->db->select('mp.int_glcode,mp.fk_category,mp.var_title,mp.var_image,mp.var_offer,mp.var_stock');
        $this->db->where('mp.chr_publish','Y');
        $this->db->where('mp.chr_delete','N');
        $this->db->where('mp.fk_category',$cat_id);

        if ($offer == 'Yes') {
            $this->db->where('mp.var_offer !=','0');
        }

       $this->db->limit($rowperpage , $rowno);
       
       if ($search != '') {

            $this->db->group_start();
            $this->db->like("mp.var_title", $search);
            $this->db->group_end();

        }
        if ($country != '') {
           
            $ord_var = 'mp.'.$country;
            $this->db->order_by($ord_var,'ASC');
        }
        if($catid != ''){
            if ($catid[0] != 'on') {
                $this->db->where_in('fk_category', $catid);
            }
            
        }

        $query = $this->db->get('mst_products mp');
        //echo $this->db->last_query(); 
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

    public function product_count($search = '',$country = '',$catid='',$offer=''){

        $this->db->select('mp.int_glcode,mp.fk_category,mp.var_title,mp.var_image');
        $this->db->from('mst_products mp');
        $this->db->where('mp.chr_publish','Y');
        $this->db->where('mp.chr_delete','N');

        if ($offer == 'Yes') {
            $this->db->where('mp.var_offer !=','0');
        }

        if (($search != '')) {

            $this->db->group_start();
            $this->db->like("mp.var_title", $search);
            $this->db->group_end();

        }
        if ($country != '') {
           
            $ord_var = 'mp.'.$country;
            $this->db->order_by($ord_var,'ASC');
        }
        if($catid != ''){
            if ($catid[0] != 'on') {
                $this->db->where_in('fk_category', $catid);
            }
        }

        $result = $this->db->get();
        $row = $result->result_array();

        if (count($row) > 0) {
            $countArr = count($row);
        } else {
            $countArr = '0';
        }

        return $countArr;
        
    }
    
    /* ----------------------- get all products ------------------------ */
    public function new_product()
    {
        $this->db->select('mp.int_glcode,mp.fk_category,mp.var_title,mp.var_image,mp.var_offer');
        $this->db->from('mst_products mp');
        $this->db->where('mp.chr_publish','Y');
        $this->db->where('mp.chr_delete','N');
        $this->db->order_by('int_glcode','DESC');
        $this->db->limit('3');
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

    public function checkpin_pid(){
        $pincode = $this->input->post('pincode');
        $fk_product = $this->input->post('fk_product');

            $this->db->select('qc.*');
            $this->db->join('mst_pincode qc','qc.int_glcode = q.fk_pincode');
            $this->db->from('mst_product_pincode q');
            $this->db->where('q.fk_product',$fk_product);
            $query = $this->db->get();
            $row = $query->result_array();
            // echo "<pre>";print_r($row);
            foreach ($row as $key => $value) {
                if($value['var_pincode'] == $pincode){
                    return $pincode;
                }
            }
            
exit();
            

    }

}