<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_report_model extends CI_Model {

    public function __construct() {

        parent::__construct();

        $this->load->database();

        $this->load->model('common_model');
    }

    
    public function getOrderReport($vendor_id)
    {
        $this->db->select('mo.int_glcode as fk_order,mo.order_id,mo.fk_user,mo.fk_product_arr,mo.customize_arr,mo.var_payment_mode,mo.chr_status,mo.dt_createddate,mu.var_name,mu.var_username,mu.var_email,mu.  var_mobile_no,mu.txt_address,md.var_name as deliveryboy_name,md.var_mobile_no as deliveryboy_number,md.var_email as deliveryboy_email,mo.dt_timeslot,mo.dt_delivery_date,mo.var_payable_amount,to.var_name,to.var_mobile_no');
        $this->db->from('mst_orders mo');
        $this->db->join('mst_vendors to','to.int_glcode = mo.fk_vendor', 'left');
        $this->db->join('mst_users mu', 'mu.int_glcode = mo.fk_user', 'left');
        $this->db->join('mst_delivery_boy md', 'md.int_glcode = mo.fk_delivery', 'left');
        $this->db->where('mo.fk_vendor',$vendor_id);
        //$this->db->where('mo.dt_delivery_date',date('Y-m-d'));
        $this->db->where('mo.chr_status','S');
        $this->db->order_by('mo.int_glcode','desc');
        $query = $this->db->get();
        //echo $this->db->last_query(); exit();
        $row = $query->result_array();

        $data = array();
        $total = 0;
        foreach ($row as $key => $value) {
            $value['fk_product_arr'] = json_decode($value['fk_product_arr']);
            $value['customize_arr'] = json_decode($value['customize_arr']);
            
            if ($value['deliveryboy_name'] != null) {
                $value['deliveryboy_name'] = $value['deliveryboy_name'];
            } else {
                $value['deliveryboy_name'] = '';
            }

            if ($value['deliveryboy_number'] != null) {
                $value['deliveryboy_number'] = $value['deliveryboy_number'];
            } else {
                $value['deliveryboy_number'] = '';
            }

            if ($value['deliveryboy_email'] != null) {
                $value['deliveryboy_email'] = $value['deliveryboy_email'];
            } else {
                $value['deliveryboy_email'] = '';
            }

            $value['txt_reason'] = '';
            
                $total = $total + $value['var_payable_amount'];
    
            
            $data[] = $value;
        }
        $new_data['order_data'] = $data;
        $new_data['total_amount'] = $total;
        return $new_data;
        
    }

    public function get_orderData($vendor_id,$order_id)
    {
        $this->db->select('mo.int_glcode as fk_order,mo.order_id,mo.fk_user,mo.fk_product_arr,mo.customize_arr,mo.var_payment_mode,mo.chr_status,mo.dt_timeslot,mo.dt_delivery_date,mo.dt_createddate,mu.var_name,mu.var_username,mu.var_email,mu.var_mobile_no,mo.var_user_address as txt_address,md.var_name as deliveryboy_name,md.var_mobile_no as deliveryboy_number,md.var_email as deliveryboy_email,mo.fk_delivery,mo.var_payable_amount,mo.var_wallet_amount,mo.var_delivery_charge,mo.var_discount_amount,mo.var_total_amount');
        $this->db->from('mst_orders mo');
        //$this->db->join('mst_orders mo','mo.int_glcode = to.fk_order', 'left');
        $this->db->join('mst_users mu', 'mu.int_glcode = mo.fk_user', 'left');
        $this->db->join('mst_delivery_boy md', 'md.int_glcode = mo.fk_delivery', 'left');
        $this->db->where('mo.fk_vendor',$vendor_id);
        $this->db->where('mo.int_glcode',$order_id);
        $this->db->order_by('mo.int_glcode','desc');
        $query = $this->db->get();
        //echo $this->db->last_query(); exit();
        $value = $query->row_array();
        //echo "<pre>"; print_r($row); exit();
//        $data = array();
//        foreach ($row as $key => $value) {
            $fk_product_arr = json_decode($value['fk_product_arr'], true);
            $value['customize_arr'] = json_decode($value['customize_arr'], true);

            $product_arr = array();

            foreach ($fk_product_arr as $pikey => $pivalue) {
                $var_image = $this->getProductImage($pivalue['fk_product']);

                if($var_image != '')
                {
                    $pivalue['var_image'] = base_url().'uploads/products/'.$var_image;
                } else {
                    $pivalue['var_image'] = base_url().'public/assets/images/site_imges/no_image.png';
                }

                $product_arr[] = $pivalue;
            }

            $value['fk_product_arr'] = $product_arr;
            if ($value['deliveryboy_name'] != null) {
                $value['deliveryboy_name'] = $value['deliveryboy_name'];
            } else {
                $value['deliveryboy_name'] = '';
            }

            if ($value['deliveryboy_number'] != null) {
                $value['deliveryboy_number'] = $value['deliveryboy_number'];
            } else {
                $value['deliveryboy_number'] = '';
            }

            if ($value['deliveryboy_email'] != null) {
                $value['deliveryboy_email'] = $value['deliveryboy_email'];
            } else {
                $value['deliveryboy_email'] = '';
            }

            $txt_reason = $this->getVendorReasons($vendor_id,$value['fk_order']);
            if ($txt_reason != '') {
                $value['txt_reason'] = $txt_reason;
            } else {
                $value['txt_reason'] = '';
            }

//            $data[] = $value;
//
//        }

        return $value;
    }
    
    public function getProductImage($fk_product)
    {
        $this->db->select('var_image');
        $this->db->from('mst_products');
        $this->db->where('int_glcode',$fk_product);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit();
        $row = $query->row_array();

        return $row['var_image'];
    }
    
    public function getVendorReasons($vendorId,$orderId)
    {
        $this->db->select('txt_reason');
        $this->db->from('trn_order_status');
        $this->db->where('fk_vendor',$vendorId);
        $this->db->where('fk_order',$orderId);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit();
        $row = $query->row_array();

        return $row['txt_reason'];
    }
    
    public function getOrderFilter($vendor_id,$payment_method,$from_date,$to_date)
    {
        $this->db->select('mo.int_glcode as fk_order,mo.order_id,mo.fk_user,mo.fk_product_arr,mo.customize_arr,mo.var_payment_mode,mo.chr_status,mo.dt_createddate,mo.dt_timeslot,mo.dt_delivery_date,mo.var_payable_amount');
        $this->db->from('mst_orders mo');
        //$this->db->join('trn_assign_order to','to.fk_order = mo.int_glcode', 'left');
        $this->db->where('mo.fk_vendor',$vendor_id);
        if($payment_method != 'Both'){
            $this->db->where('mo.var_payment_mode',$payment_method);
        }
        $this->db->where('mo.chr_status','S');
        if($from_date != ''){
            $this->db->where('mo.dt_createddate >=',$from_date);
        }
        if($to_date != ''){
            $this->db->where('mo.dt_createddate <=',$to_date);
        }
        $this->db->order_by('mo.int_glcode','desc');
        $query = $this->db->get();
        //echo $this->db->last_query(); exit();
        $row = $query->result_array();
        $data = array();
 
        $total = 0;
        foreach ($row as $key => $value) {
            $value['fk_product_arr'] = json_decode($value['fk_product_arr']);
            $value['customize_arr'] = json_decode($value['customize_arr']);
            
            foreach ($value['fk_product_arr'] as $res){
                $total = $total + $res->var_price;
            }
            
            $data[] = $value;
        }
        $new_data['order_data'] = $data;
        $new_data['total_amount'] = $total;
        return $new_data;
    }
    
}