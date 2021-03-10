<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	
	public function __construct() {
		
		parent::__construct();

		  $this->load->database();
		  $this->load->model('common_model');
	}

    public function total_delivery_boy($id){
            
        $this->db->select('*');
        $this->db->where('fk_vendor',$id);
        $this->db->where('chr_delete','N');
        $result = $this->db->get('mst_products');
        $res = $result->result_array();
        return count($res);
    }

    public function total_order($vid,$flag){
            
        $this->db->select('int_glcode');
        $this->db->where('fk_vendor',$vid);
        $this->db->where('chr_status',$flag);
        $result = $this->db->get('mst_orders');
        $res = $result->result_array();
        return count($res);
    }

    public function getOrderReport($vendor_id)
    {

        $this->db->select('*');
        $this->db->from('mst_orders');
        $this->db->where('fk_vendor',$vendor_id);
        $this->db->where('date_format(dt_createddate,"%Y-%m-%d")',date('Y-m-d'));
        $this->db->order_by('int_glcode','desc');
        $query = $this->db->get();
//        echo $this->db->last_query(); 

        $row_data = $query->result_array();

        $data = array();
        $total = 0;
        foreach ($row_data as $key => $value) {
            $value['fk_product_arr'] = json_decode($value['fk_product_arr']);
            $value['customize_arr'] = json_decode($value['customize_arr']);
            
                $total = $total + $value['var_payable_amount'];
            
            $data[] = $value;
        }
        $new_data['order_data'] = $data;
        $new_data['total_amount'] = $total;
        return $new_data;
        
    }
    
}