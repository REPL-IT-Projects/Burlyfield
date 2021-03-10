<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw_request_model extends CI_Model {

	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		$this->load->model('common_model');
	}

   
    public function getEarning($id)
    {
        $this->db->select('w.*,o.order_id');
        $this->db->from('vendor_withdraw w');
        $this->db->join('mst_orders o','o.int_glcode = w.fk_order');
        $this->db->where('w.fk_vendor',$id);
        $this->db->where('w.chr_status','N');
        $query = $this->db->get();
        $row_data = $query->result_array();
        
        $total = 0;
        foreach ($row_data as $row){
            $total = $row['var_amount'] + $total;
        }
        $data['total_wallet'] = $total;
        $data['data'] = $row_data;
        return $data;
    }
    
    function getPending($id,$status){
        
        $this->db->select('*');
        $this->db->from('mst_withdraw_request');
        $this->db->where('fk_vendor',$id);
        $this->db->where('chr_status',$status);
        $query = $this->db->get();
        $row_data = $query->result_array();
        return $row_data;
    }
    
}