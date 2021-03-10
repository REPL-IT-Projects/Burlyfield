<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    public function __construct() {

        parent::__construct();

        $this->load->database();

        $this->load->model('common_model');
    }

    public function getAllCategory()
    {
        $this->db->select('int_glcode,fk_parent,var_title,var_icon');
        $this->db->from('mst_category');
        $this->db->where('fk_parent', 0);
        $this->db->where('chr_publish', 'Y');
        $this->db->where('chr_delete', 'N');

        $parent = $this->db->get();
        
        $categories = $parent->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->sub = $this->get_sub_categories($p_cat->int_glcode);
            $i++;
        }
        $cateArr = json_decode(json_encode($categories,true));

        //echo "<pre>"; print_r($cateArr); exit();

        $data = array();

        foreach ($cateArr as $key => $value) {
            if($value->var_icon != '')
            {
                $value->var_icon = base_url().'uploads/category/'.$value->var_icon;
            } else {
                $value->var_icon = base_url().'public/assets/images/site_imges/no_image.png';
            }

            $data[] = $value;
        }

        return $data;
    }


    public function get_sub_categories($category_id)
    {
        $this->db->select('int_glcode,fk_parent,var_title,var_icon');
        $this->db->from('mst_category');
        $this->db->where('fk_parent', $category_id);
        $this->db->where('chr_publish', 'Y');
        $this->db->where('chr_delete', 'N');

        $child = $this->db->get();
        $categories = $child->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->sub = $this->get_sub_categories($p_cat->int_glcode);
            $i++;
        }

        $data = array();

        foreach ($categories as $key => $value) {
            if($value->var_icon != '')
            {
                $value->var_icon = base_url().'uploads/category/'.$value->var_icon;
            } else {
                $value->var_icon = base_url().'public/assets/images/site_imges/no_image.png';
            }

            $data[] = $value;
        }

        //$cateArr = json_decode(json_encode($categories,true));
        return $data;  
    }

    /*---------------------- get product multiple images --------------------*/
    public function getProductImages($fk_product)
    {
        $this->db->select('int_glcode,var_images');
        $this->db->from('trn_product_images');
        $this->db->where('fk_product',$fk_product);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit();
        $row = $query->result_array();

        $data = array();

        foreach ($row as $key => $value) {
            $value['var_images'] = base_url().'uploads/products/'.$value['var_images'];
            $data[] = $value;
        }

        return $data;
    }

    /*--------------------- get user product units -------------------------*/
    public function getUserProductUnit($fk_user,$fk_product,$var_quantity)
    {
        if ($fk_user != '') {
            $this->db->select('var_unit');
            $this->db->from('trn_cart_details');
            $this->db->where('fk_user',$fk_user);
            $this->db->where('fk_product',$fk_product);
            $this->db->where('var_quantity',$var_quantity);
            $query = $this->db->get();
            //echo $this->db->last_query(); exit();
            $row = $query->row_array();

            return $row['var_unit'];
        } else {
            return '0';
        }

    }

    /*------------------------ get product wise price details --------------*/
    public function getProductPriceDetail($fk_product,$fk_user)
    {
        $this->db->select('var_quantity,var_price,var_discount_price');
        $this->db->from('trn_product_price');
        $this->db->where('fk_product',$fk_product);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit();
        $row = $query->result_array();

        $data = array();

        foreach ($row as $key => $value) { 
            $var_unit = $this->getUserProductUnit($fk_user,$fk_product,$value['var_quantity']); 
            if ($var_unit != '') {
                $value['var_unit'] = $var_unit;
            } else {
                $value['var_unit'] = '0';
            }

            if($value['var_discount_price'] == ''){
                $value['var_discount_price'] = $value['var_price'];
            }
            $data[] = $value;
        }

        return $data;
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
   
    /*--------------------------- get product list ------------------------------*/
    public function get_all_products($categoryId,$fk_user)
    {
        $this->db->select('mp.int_glcode,mp.fk_category,mp.var_title,mp.var_image,mc.var_title as category_name,mp.var_price,mp.var_quantity,mp.var_offer,v.var_name as vendor_name,v.int_glcode as vendor_id');
        $this->db->from('mst_products mp');
        $this->db->join('mst_category mc', 'mc.int_glcode = mp.fk_category', 'left');
        $this->db->join('mst_vendors v', 'v.int_glcode = mp.fk_vendor', 'left');
        $this->db->where('mp.fk_category',$categoryId);
        $this->db->where('mp.chr_publish','Y');
        $this->db->where('mp.chr_delete','N');

        $query = $this->db->get();
        $row = $query->result_array();

        $row_arr = array();

        foreach ($row as $value) {
            
            if($value['var_image'] != '')
            {
                $value['var_image'] = base_url().'uploads/products/thumb_img/'.$value['var_image'];
            } else {
                $value['var_image'] = base_url().'public/assets/images/site_imges/no_image.png';
            }
                
            $value['price_detail'] = $this->getProductPriceDetail($value['int_glcode'],$fk_user);

            $row_arr[] = $value;

        }
        
        return $row_arr;
    }


    /*--------------------------- get product details ------------------------------*/
    public function get_products_detail($productId,$fk_user)
    {
        $this->db->select('mp.int_glcode,mp.fk_category,mp.var_title,mp.var_image,mp.var_short_description,mp.txt_description,mp.var_price,mc.var_title as category_name,mp.var_quantity,txt_nutrition,mp.var_offer,v.var_name as vendor_name,v.int_glcode as vendor_id');
        $this->db->from('mst_products mp');
        $this->db->join('mst_category mc', 'mc.int_glcode = mp.fk_category', 'left');
        $this->db->join('mst_vendors v', 'v.int_glcode = mp.fk_vendor', 'left');
        if($_POST['vendor_id'] != ''){
            $this->db->where('mp.fk_vendor',$_POST['vendor_id']);
        }
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

            $value['price_detail'] = $this->getProductPriceDetail($value['int_glcode'],$fk_user);

            $value['product_images'] = $this->getProductImages($value['int_glcode']);

            $value['txt_nutrition'] = preg_replace('/(\v|\s)+/', '', $value['txt_nutrition']);

            $value['similar_products'] = $this->get_similar_products($fk_user,$productId,$value['fk_category']);

            $row_arr = $value;

        }
        
        return $row_arr;
    }

    /*--------------------------- get hot product list ------------------------------*/
    public function get_hot_products($fk_user)
    {
        $this->db->select('mp.int_glcode,mp.fk_category,mp.var_title,mp.var_image,mc.var_title as category_name,mp.var_price,mp.var_quantity,mp.var_offer,v.var_name as vendor_name,v.int_glcode as vendor_id');
        $this->db->from('mst_products mp');
        $this->db->join('mst_category mc', 'mc.int_glcode = mp.fk_category', 'left');
        $this->db->join('mst_vendors v', 'v.int_glcode = mp.fk_vendor', 'left');
        if($_POST['vendor_id'] != ''){
        $this->db->where('mp.fk_vendor',$_POST['vendor_id']);
        }
        $this->db->where('mp.chr_publish','Y');
        $this->db->where('mp.chr_delete','N');
        
        if ($_POST['type'] == 'H') {
            $this->db->limit(6); 
        } 

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
                
            $value['price_detail'] = $this->getProductPriceDetail($value['int_glcode'],$fk_user);

            $row_arr[] = $value;

        }
        
        return $row_arr;
    }

    public function getRecentProductArr($productId,$fk_user)
    {
        $this->db->select('mp.int_glcode,mp.fk_category,mp.var_title,mp.var_image,mc.var_title as category_name,mp.var_price,mp.var_quantity,mp.var_offer,v.var_name as vendor_name,v.int_glcode as vendor_id');
        $this->db->from('mst_products mp');
        $this->db->join('mst_category mc', 'mc.int_glcode = mp.fk_category', 'left');
        $this->db->join('mst_vendors v', 'v.int_glcode = mp.fk_vendor', 'left');
        if($_POST['vendor_id'] != ''){
            $this->db->where('mp.fk_vendor',$_POST['vendor_id']);
        }
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
                
            $value['price_detail'] = $this->getProductPriceDetail($value['int_glcode'],$fk_user);

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
                    $row_arr[] = $this->getRecentProductArr($pval['fk_product'],$fk_user);
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

    /*--------------------------- get recent product list ------------------------------*/
    public function get_offer_products($fk_user)
    {
        $this->db->select('mp.int_glcode,mp.fk_category,mp.var_title,mp.var_image,mc.var_title as category_name,mp.var_price,mp.var_quantity,mp.var_offer,v.var_name as vendor_name,v.int_glcode as vendor_id');
        $this->db->from('mst_products mp');
        $this->db->join('mst_category mc', 'mc.int_glcode = mp.fk_category', 'left');
        $this->db->join('mst_vendors v', 'v.int_glcode = mp.fk_vendor', 'left');
        if($_POST['vendor_id'] != ''){
            $this->db->where('mp.fk_vendor',$_POST['vendor_id']);
        }
        $this->db->where('mp.chr_publish','Y');
        $this->db->where('mp.chr_delete','N');
        $this->db->where('mp.var_offer!=','0');
        $this->db->order_by('mp.int_glcode','desc');
        $this->db->limit(6); 
        
        $query = $this->db->get();
        $row = $query->result_array();

        //echo "<pre>"; print_r($row); exit();
        $row_arr = array();

        foreach ($row as $rkey => $value) {

            if($value['var_image'] != '')
            {
                $value['var_image'] = base_url().'uploads/products/'.$value['var_image'];
            } else {
                $value['var_image'] = base_url().'public/assets/images/site_imges/no_image.png';
            }
                
            $value['price_detail'] = $this->getProductPriceDetail($value['int_glcode'],$fk_user);

            $row_arr[] = $value;
        }

        return $row_arr;
    }

    /*--------------------------- get similar product list ------------------------------*/
    public function get_similar_products($fk_user,$fk_product,$fk_category)
    {
        $this->db->select('mp.int_glcode,mp.fk_category,mp.var_title,mp.var_image,mc.var_title as category_name,mp.var_price,mp.var_quantity,mp.var_offer,v.var_name as vendor_name,v.int_glcode as vendor_id');
        $this->db->from('mst_products mp');
        $this->db->join('mst_category mc', 'mc.int_glcode = mp.fk_category', 'left');
        $this->db->join('mst_vendors v', 'v.int_glcode = mp.fk_vendor', 'left');
        if($_POST['vendor_id'] != ''){
        $this->db->where('mp.fk_vendor',$_POST['vendor_id']);
        }
        $this->db->where('mp.int_glcode !=',$fk_product);
        $this->db->where('mp.fk_category',$fk_category);
        $this->db->where('mp.chr_publish','Y');
        $this->db->where('mp.chr_delete','N');
        $this->db->order_by('rand()');
        $this->db->limit(6); 
        
        $query = $this->db->get();
        $row = $query->result_array();

        //echo "<pre>"; print_r($row); exit();
        $row_arr = array();

        foreach ($row as $rkey => $value) {

            if($value['var_image'] != '')
            {
                $value['var_image'] = base_url().'uploads/products/'.$value['var_image'];
            } else {
                $value['var_image'] = base_url().'public/assets/images/site_imges/no_image.png';
            }
                
            $value['price_detail'] = $this->getProductPriceDetail($value['int_glcode'],$fk_user);

            $row_arr[] = $value;
        }

        return $row_arr;
    }

    public function VendorList()
    {
        $this->db->select('int_glcode,var_name,var_mobile_no,var_alt_mobile,var_email,var_username,var_address,var_image');
        $this->db->from('mst_vendors');
        $this->db->where('chr_delete','N');
        $this->db->where('chr_publish','Y');
        $query = $this->db->get();
        $result = $query->result_array();
        
        $data = array();

        foreach ($result as $key => $value) {
            
            $value['var_image'] = base_url().'uploads/vendor/'.$value['var_image'];
            
            $data[] = $value;
        }
        
        return $data;
    }

    public function getAllBanners()
    {
        $this->db->select('var_image');
        $this->db->from('mst_home_banners');
        $this->db->where('chr_publish', 'Y');
        $this->db->where('chr_delete', 'N');
        $this->db->order_by('int_glcode', 'desc');
        $query = $this->db->get();
        $result = $query->result_array();
        
        //echo "<pre>"; print_r($cateArr); exit();
        $data = array();

        foreach ($result as $key => $value) {
            
            $value['var_image'] = base_url().'uploads/banner_img/'.$value['var_image'];
            
            $data[] = $value;
        }

        return $data;
    }
    
}