<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model {

	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		$this->load->model('common_model');
	}

    /*------------------------ get records count ------------------------- */
    public function getProductList($vendorId)
    {
        $this->db->select('p.int_glcode as fk_product,p.var_title,p.var_quantity,ts.int_glcode as stock_id,ts.fk_vendor,IFNULL(ts.chr_status,"I") AS stock_status,p.var_image');
        $this->db->from('mst_products p');
        $this->db->where('p.chr_publish','Y');
        $this->db->where('p.chr_delete','N');
        $this->db->where('p.fk_vendor',$vendorId);
        $this->db->group_start();
        $this->db->where('ts.fk_vendor',$vendorId);
        $this->db->or_where('ts.fk_vendor',NULL);
        $this->db->group_end();
        $this->db->join('trn_product_stock ts', 'ts.fk_product = p.int_glcode', 'left');
        $query = $this->db->get();
        //echo $this->db->last_query(); exit();
        $row = $query->result_array();  

        $data = array();

        foreach ($row as $key => $value) {
            $val['int_glcode'] = $value['fk_product'];
            $val['var_title'] = $value['var_title'];
            $val['var_quantity'] = $value['var_quantity'];
            $val['stock_status'] = $value['stock_status'];
            $val['var_image'] = base_url().'uploads/products/'.$value['var_image'];

            $data[] = $val;
        }

        return $data;
    }

   public function updateStock($vendorId,$productId,$status)
    {
        $select = "SELECT int_glcode FROM trn_product_stock WHERE fk_vendor = '".$vendorId."' AND fk_product = '".$productId."'";
        //echo $select; exit();
        $result = $this->db->query($select);
        $row = $result->row_array();

        if (!empty($row)) {

            $this->db->set('chr_status', $status); //value that used to update column  
            $this->db->where('fk_vendor', $vendorId); //which row want to upgrade  
            $this->db->where('fk_product', $productId); //which row want to upgrade  
            $this->db->update('trn_product_stock');

        } else {

            $add_data = array(
                'fk_vendor' => $vendorId,
                'fk_product' => $productId,
                'chr_status' => $status,
                'dt_createddate' => date('Y-m-d H:i:s'),
                'dt_modifydate' => date('Y-m-d H:i:s')
            );

            $this->common_model->insertRow($add_data, "trn_product_stock");
        }

        return TRUE;
    }
    
}