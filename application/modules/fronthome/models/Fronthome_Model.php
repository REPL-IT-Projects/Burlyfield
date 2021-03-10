<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fronthome_Model extends CI_Model {
   
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('common_model');        
    }
    
    public function getBlog(){
        
        $this->db->select('*');
        $this->db->from('mst_blog');
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $this->db->order_by('int_glcode','DESC');
        $this->db->limit(3);
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;
    }

    public function getTestimonial(){
        
        $this->db->select('*');
        $this->db->from('mst_testimonial');
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;
    }
    /*------------------------ get parent category  ------------------------- */
    public function getCategory()
    {
        $this->db->select('int_glcode,var_title,var_icon');
        $this->db->from('mst_category');
        $this->db->where('fk_parent','0');
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;
    }
    
    public function get_banner_img()
    {
        $this->db->select('int_glcode,var_title,txt_description,var_image');
        $this->db->from('mst_home_banners');
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $this->db->order_by('int_glcode','DESC');
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;
    }

    /*------------------------ get product wise price details --------------*/
    public function getProductPriceDetailRecent($fk_product)
    {
        $this->db->select('var_quantity,var_price,var_discount_price');
        $this->db->from('trn_product_price');
        $this->db->where('fk_product',$fk_product);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit();
        $row = $query->result_array();

        return $row;
    }

    public function getRecentProductArr($productId)
    {
        $this->db->select('mp.int_glcode,mp.fk_category,mp.var_title,mp.var_image,mc.var_title as category_name,mp.var_price,mp.var_quantity,mp.var_offer');
        $this->db->from('mst_products mp');
        $this->db->join('mst_category mc', 'mc.int_glcode = mp.fk_category', 'left');
        $this->db->where('mp.int_glcode',$productId);
        $this->db->where('mp.chr_publish','Y');
        $this->db->where('mp.chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();

        $row_arr = array();

        foreach ($row as $value) {
            
            if($value['var_image'] != '')
            {
                $value['var_image'] = base_url().'uploads/products/'.$value['var_image'];
            } else {
                $value['var_image'] = base_url().'public/assets/images/site_imges/no_image.png';
            }
                
            $prices = $this->common_model->get_product_price($value['int_glcode']); 
            $value['var_price'] = $prices[0]['var_price'];
            $value['var_quantity'] = $prices[0]['var_quantity']; 

            $row_arr = $value;

        }
        
        return $row_arr;
    }

    /*--------------------------- get recent product list ------------------------------*/
    public function get_recent_products($fk_user)
    {

        $this->db->select('int_glcode,chr_status,fk_product_arr');
        $this->db->from('mst_orders');
        $this->db->where('fk_user',$fk_user);
        $this->db->where('chr_status','C');
        $this->db->limit(6); 
        
        $query = $this->db->get();
        $row = $query->result_array();

        //echo "<pre>"; print_r($row); exit();
        $row_arr = array();

        foreach ($row as $rkey => $value) {

            $fk_product_arr = json_decode($value['fk_product_arr'], true);
            
            foreach ($fk_product_arr as $key => $pval) {
               // echo "<pre>";print_r($rkey);
                    $row_arr[] = $this->getRecentProductArr($pval['fk_product']);
                    unset($row[$rkey]);
                }
                
            }

        $newArray = array(); 
        $usedFruits = array(); 
        foreach ( $row_arr AS $fkey => $fline ) { 
            if ( !in_array($fline['int_glcode'], $usedFruits) ) { 
                $usedFruits[] = $fline['int_glcode']; 
                $newArray[] = $fline; 
            } 
        } 
        $row_arr = $newArray; 
        $newArray = NULL;
        $usedFruits = NULL;

        
        // $frow_arr = array();
        // $newArray = array();
        // foreach ($row_arr as $fkey => $fvalue) {
        //     if (!in_array($fvalue['int_glcode'], $row_arr) ) { 
        //         $frow_arr[] = $fvalue['int_glcode'];
        //         $newArray[$fkey] = $fvalue; 
        //     }

        // }

        //echo "<pre>"; print_r($newArray); exit();
    
        return $row_arr;
    }

    /* ----------------------- get all products ------------------------ */
    
    public function getProducts($cateId)
    {   
        $this->db->select('mp.int_glcode,mp.fk_category,mp.var_title,mp.var_image,mp.var_stock,mp.var_offer,mc.var_title as category_name');
        $this->db->from('mst_products mp');
        $this->db->join('mst_category mc', 'mc.int_glcode = mp.fk_category', 'left');
        $this->db->where('mp.chr_publish','Y');
        $this->db->where('mp.chr_delete','N');
        $this->db->where('mp.fk_category',$cateId);
        $this->db->limit('4');

        $query = $this->db->get();
        $row = $query->result_array();
        $new_arr = array();
        foreach($row as $rrr){
            $prices = $this->common_model->get_product_price($rrr['int_glcode']); 
            $rrr['q_id'] = $prices[0]['int_glcode'];
            $rrr['var_price'] = $prices[0]['var_price'];
            $rrr['var_quantity'] = $prices[0]['var_quantity']; 
            $new_arr[] = $rrr;
        }
        
        return $new_arr;
    }

    public function top_product(){
        
        $this->db->select('mp.int_glcode,mp.fk_category,mp.var_title,mp.var_image,mp.var_offer');
        $this->db->from('mst_products mp');
        $this->db->where('mp.chr_publish','Y');
        $this->db->where('mp.chr_delete','N');
        $this->db->order_by('rand()');
        $this->db->limit('6');
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

    public function getOfferProduct(){
        
        $this->db->select('mp.int_glcode,mp.fk_category,mp.var_title,mp.var_image,mp.var_offer');
        $this->db->from('mst_products mp');
        $this->db->where('mp.var_offer!=','0');
        $this->db->where('mp.chr_publish','Y');
        $this->db->where('mp.chr_delete','N');
        $this->db->order_by('mp.var_offer','asc');
        $this->db->limit('6');
        $query = $this->db->get();

        //echo $this->db->last_query(); exit();

        $result = $query->result_array();
        
        if(count($result) > 0){
            foreach($result as $rrr){
                $prices = $this->common_model->get_product_price($rrr['int_glcode']); 
                $rrr['var_price'] = $prices[0]['var_price'];
                $rrr['var_quantity'] = $prices[0]['var_quantity']; 

                if($rrr['var_image'] != '')
                {
                    $rrr['var_image'] = base_url().'uploads/products/'.$rrr['var_image'];
                } else {
                    $rrr['var_image'] = base_url().'public/assets/images/site_imges/no_image.png';
                }

                $new_arr[] = $rrr;
            }

        }else{
            $new_arr = array();
        }
        return $new_arr;
    }
    
    public function get_allproduct($str = '')
    {
        $html = '';
        if ($str != '') {
        //$str = urldecode($str);   
        //$str = ltrim($str); 
       
        
        if ($str != '') {

            $search = "and var_title LIKE '%" . $str . "%'";
        }
        
        $sql = "SELECT int_glcode,var_title,var_image,var_offer FROM mst_products WHERE chr_delete = 'N' and chr_publish = 'Y' and var_title LIKE '%" . $str . "%' ";
        
        $query = $this->db->query($sql);
        
            $html = '<ul id="list">';
            
            if($query->num_rows() > 0)
            {
            foreach ($query->result_array() as $key => $value) {

                    $url = base_url().'product/detail/'.base64_encode($value['int_glcode']);
                    $img = base_url().'uploads/products/'.$value['var_image'];
                    $html .= '<li><img style="width: 25px;" src="'.$img.'"><a href="javascript:void(0)" onClick=load_page("'.$url.'")>'.$value['var_title'].'</a></li>';
              
            }  
            }else{
                $html .= '<li>Result Not Found</li>';
            } 
            $html .= '</ul>';
        }else{
            $html .= '';
        }
     return $html;
     }
     
}