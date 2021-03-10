<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model {

    public function __construct() {

        parent::__construct();

        $this->load->database();

        $this->load->model('common_model');
    }

    public function add_update_cart()
    {
        $fk_user = $this->input->post('fk_user');
        $fk_product = $this->input->post('fk_product');
        $fk_vendor = $this->input->post('vendor_id');

        $sel = $this->db->query("select fk_vendor from trn_cart_details where fk_user='".$fk_user."' limit 1");
        $res = $sel->row_array();
        
        //if((count($res) > 0) && ($res['fk_vendor'] == $fk_vendor)){
        
        $this->db->select('int_glcode,chr_status');
        $this->db->from('trn_cart_details');
        $this->db->where('fk_user', $fk_user);
        $this->db->where('fk_product', $fk_product);
        $this->db->where('var_quantity', $this->input->post('var_quantity'));
        $this->db->where('chr_status', 'A');
        $query = $this->db->get();
        $result = $query->row_array();

        if (empty($result)) {
            $insert_data = array(
                'fk_user' => $fk_user,
                'fk_product' => $fk_product,
                'fk_vendor' => $fk_vendor,
                'var_name' => $this->input->post('var_name'),
                'var_quantity' => $this->input->post('var_quantity'),
                'var_price' => $this->input->post('var_price'),
                'var_discount' => $this->input->post('var_discount'),
                'var_unit' => $this->input->post('var_unit'),
                'dt_createddate' => date('Y-m-d H:i:s'),
                'dt_modifydate' => date('Y-m-d H:i:s'),
                'var_ipaddress' => $_SERVER['REMOTE_ADDR']
            );
            //echo "<pre>"; print_r($insert_data); exit();
            
            $this->common_model->insertRow($insert_data, "trn_cart_details");
        } else {
            $ut_data = array(
                'fk_user' => $fk_user,
                'fk_product' => $fk_product,
                'fk_vendor' => $fk_vendor,
                'var_name' => $this->input->post('var_name'),
                'var_quantity' => $this->input->post('var_quantity'),
                'var_price' => $this->input->post('var_price'),
                'var_discount' => $this->input->post('var_discount'),
                'var_unit' => $this->input->post('var_unit'),
                'dt_modifydate' => date('Y-m-d H:i:s'),
                'var_ipaddress' => $_SERVER['REMOTE_ADDR']
            );
            if($ut_data['var_unit'] == 0){
                $delete = $this->db->query("delete from trn_cart_details where int_glcode ='".$result['int_glcode']."' ");
            }else{
                $update_que = $this->common_model->updateRow('trn_cart_details', $ut_data, array("int_glcode" => $result['int_glcode']));
            }
        }
//        }else{
//            $delete = $this->db->query("delete from trn_cart_details where fk_user ='".$fk_user."' ");
//            
//             $insert_data = array(
//                'fk_user' => $fk_user,
//                'fk_product' => $fk_product,
//                'fk_vendor' => $fk_vendor,
//                'var_name' => $this->input->post('var_name'),
//                'var_quantity' => $this->input->post('var_quantity'),
//                'var_price' => $this->input->post('var_price'),
//                'var_unit' => $this->input->post('var_unit'),
//                'dt_createddate' => date('Y-m-d H:i:s'),
//                'dt_modifydate' => date('Y-m-d H:i:s'),
//                'var_ipaddress' => $_SERVER['REMOTE_ADDR']
//            );
//            //echo "<pre>"; print_r($insert_data); exit();
//            
//            $this->common_model->insertRow($insert_data, "trn_cart_details");
//        }
        $this->db->select('COUNT(int_glcode) as tot_product');
        $this->db->from('trn_cart_details');
        $this->db->where('fk_user', $fk_user);
        
        $sel_query = $this->db->get();
        $sel_result = $sel_query->row_array();
        
        return $sel_result['tot_product'];

    }

    /*--------------------------- get user cart details --------------------------------*/
    public function getAllCartDetails($fk_user)
    {
        $this->db->select('mp.int_glcode,mp.fk_category,mp.var_title,mp.var_image,tc.var_quantity,tc.var_price,mp.var_offer,tc.var_unit,mc.var_title as category_name,v.var_name as vendor_name,v.int_glcode as vendor_id');
        $this->db->from('trn_cart_details tc');
        $this->db->join('mst_products mp', 'mp.int_glcode = tc.fk_product', 'left');
        $this->db->join('mst_category mc', 'mc.int_glcode = mp.fk_category', 'left');
        $this->db->join('mst_vendors v', 'v.int_glcode = tc.fk_vendor', 'left');
        if($_POST['vendor_id'] != ''){
        $this->db->where('tc.fk_vendor',$_POST['vendor_id']);
        }
        $this->db->where('fk_user', $fk_user);
        $this->db->where('chr_status', 'A');
        $this->db->where('var_unit !=', '0');
        $query = $this->db->get();
        $result = $query->result_array();
        
        $data = array();

        foreach ($result as $key => $value) {
            if($value['var_image'] != '')
            {
                $value['var_image'] = base_url().'uploads/products/'.$value['var_image'];
            } else {
                $value['var_image'] = base_url().'public/assets/images/site_imges/no_image.png';
            }

            $total_price = $value['var_price'];
            $price = ($value['var_offer'] / 100) * $total_price;
            $discount_price = $total_price - $price;

            $value['var_discount_price'] = $discount_price;
           

            $data[] = $value;

        }

        return $data;  
    }

    /*--------------------------- get user cart details --------------------------------*/
    public function getTotalCartDetails($fk_user)
    {
        $this->db->select('mp.int_glcode,mp.fk_category,mp.var_title,mp.var_image,tc.var_quantity,tc.var_price,mp.var_offer,tc.var_unit,mc.var_title as category_name');
        $this->db->from('trn_cart_details tc');
        $this->db->join('mst_products mp', 'mp.int_glcode = tc.fk_product', 'left');
        $this->db->join('mst_category mc', 'mc.int_glcode = mp.fk_category', 'left');
        $this->db->where('fk_user', $fk_user);
        $this->db->where('chr_status', 'A');
        $this->db->where('var_unit !=', '0');
        $query = $this->db->get();
        $result = $query->result_array();
        
        $data = array();

        foreach ($result as $key => $value) {
            if($value['var_image'] != '')
            {
                $value['var_image'] = base_url().'uploads/products/'.$value['var_image'];
            } else {
                $value['var_image'] = base_url().'public/assets/images/site_imges/no_image.png';
            }

            $total_price = $value['var_price'];
            $price = ($value['var_offer'] / 100) * $total_price;
            $discount_price = $total_price - $price;

            $value['var_discount_price'] = number_format($discount_price,2);
           
            $value['tot_price'] = number_format($value['var_price'] * $value['var_unit'],2,'.','');

            $value['discount_price'] = number_format($price * $value['var_unit'],2);

            $data[] = $value;

        }

        return $data;  
    }

    public function getDeliveryCharges($flag)
    {
        $this->db->select('var_charges,var_below');
        $this->db->from('mst_delivery_charges');
        $this->db->where('chr_type', $flag);
        
        $query = $this->db->get();
        $result = $query->row_array();

        return $result;

    }

    public function SingleCartDetails($fk_user,$fk_product,$var_quantity)
    {
        $this->db->select('mp.int_glcode,mp.fk_category,mp.var_title,mp.var_image,tc.var_quantity,tc.var_price,mp.var_offer,tc.var_unit,mc.var_title as category_name');
        $this->db->from('trn_cart_details tc');
        $this->db->join('mst_products mp', 'mp.int_glcode = tc.fk_product', 'left');
        $this->db->join('mst_category mc', 'mc.int_glcode = mp.fk_category', 'left');
        $this->db->where('fk_user', $fk_user);
        $this->db->where('fk_product', $fk_product);
        $this->db->where('tc.var_quantity', $var_quantity);
        $this->db->where('chr_status', 'A');
        $this->db->where('var_unit !=', '0');
        $query = $this->db->get();
        $result = $query->result_array();
        
        $data = array();

        foreach ($result as $key => $value) {
            if($value['var_image'] != '')
            {
                $value['var_image'] = base_url().'uploads/products/'.$value['var_image'];
            } else {
                $value['var_image'] = base_url().'public/assets/images/site_imges/no_image.png';
            }

            $total_price = $value['var_price'];
            $price = ($value['var_offer'] / 100) * $total_price;
            $discount_price = $total_price - $price;

            $value['var_discount_price'] = number_format($discount_price,2);
           
            $value['tot_price'] = number_format($value['var_price'] * $value['var_unit'],2);

            $value['discount_price'] = number_format($price * $value['var_unit'],2);

            $data[] = $value;

        }

        return $data;  
    }
    
}