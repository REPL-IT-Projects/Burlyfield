<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model {

	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		$this->load->model('common_model');
	}
	
	public function records_count($search = ''){

        $this->db->select('int_glcode');
        $this->db->from('mst_products');        

        if ($search != '') {

        $this->db->group_start();
        $this->db->like("var_title" , $search);
        
        $this->db->group_end();

        }

        $this->db->where('chr_delete','N');        

        $result = $this->db->get();
        $row = $result->result_array();
        //echo $this->db->last_query();die();
        return count($row);
    
    }
    
    /*------------------------ get records  ------------------------- */
    
    public function getData($_field = 'int_glcode',$_sort = 'desc')
    {          
        $this->db->select('*');
        $this->db->from('mst_products');
        $this->db->where('chr_delete','N');        
        $this->db->order_by($_field,$_sort);
        // $this->db->limit($rowperpage , $rowno);

        // if ($search != '') {

        //     $this->db->group_start();
        //     $this->db->like("var_title" , $search);
        //     $this->db->or_like("var_stock" , $search); 
        //     $this->db->group_end();
        // }

        $result = $this->db->get();
        $row = $result->result_array();

        return $row;
    }

    /*------------------------ get id by record ------------------------- */
    public function getIdByData($userId)
    {
        $this->db->select('*');
        $this->db->from('mst_products');
        $this->db->where('int_glcode',$userId);
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }


    /*------------------------ add record ------------------------- */
    public function updatestock()
    {  
        $id = $this->input->post('int_glcode');
        
        $data = array(
            'var_stock' => $this->input->post('var_stock'),
            'dt_modifydate' => date('Y-m-d H:i:s'),
            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
        );

        $this->common_model->updateRow('mst_products', $data, array("int_glcode" => $id)); 

        return TRUE;

    }
    

    /*-------------------------------- delete multiple -------------------------*/
    public function delete_multiple()
    {
        $id = [];
        $id = $_POST['id'];
        $i = 0;

        foreach ($id as $key => $value) {
            $data = array(
                'chr_delete' => 'Y'
            );
            //$this->db->set('column_header', $value); //value that used to update column  
            $this->db->where('int_glcode', $value);
            if($this->db->update("mst_products",$data))
            {
                $i++;
                $smsg = $i." Records successfully deleted...";
            }
            else
            {
                $smsg = $this->db->_error_message();
            }
                

        }
        // $this->db->query("DELETE from ci_users WHERE id='$id'");
        return $smsg;

    }

    /*-------------------------------- update publish -------------------------*/
    public function updatedisplay() 
    {
        $data = array(
            $this->input->get_post('fieldname')=>$this->input->get_post('value')
        );

        $this->db->where('int_glcode', $this->input->get_post('id'));
        $a=$this->db->update($this->input->get_post('tablename'), $data);

        echo ($a) ? "1" : "0";
        exit;
    }
	
}