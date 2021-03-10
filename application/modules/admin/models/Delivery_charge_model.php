<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery_charge_model extends CI_Model {

    public function __construct() {

        parent::__construct();

        $this->load->database();

        $this->load->model('common_model');
    }


    public function UpdateContactData()
    {
        
            $data = array(
             'var_charges' => $this->input->post('var_charges'),
             'var_above' => $this->input->post('var_above'),
             'var_below' => $this->input->post('var_below'),
             'chr_type' => $this->input->post('chr_type')
            );

            //print_r($data); exit;

        $id = $this->common_model->updateRow('mst_delivery_charges', $data, array("int_glcode" => '1')); 

        return $id;

    }
   
    
    public function getIdByContact($userId)
    {
        $this->db->select('*');
        $this->db->from('mst_delivery_charges');
        $this->db->where('int_glcode',$userId);
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }
    
    function get_contact(){
        
        $this->db->select('*');
        $this->db->from('mst_delivery_charges');
        $this->db->where('int_glcode','1');
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }

}