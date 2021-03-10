<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends CI_Model {

    public function __construct() {

        parent::__construct();

        $this->load->database();

        $this->load->model('common_model');
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

    public function getAllTimeslot()
    {
        $this->db->select('int_glcode,dt_start_time,dt_end_time,dt_slot_end_time,chr_type');
        $this->db->from('mst_delivery_timeslot');
        $query = $this->db->get();
        $result = $query->result_array();
        
        //echo "<pre>"; print_r($cateArr); exit();
        $data = array();

        foreach ($result as $key => $value) {
    
            $data[] = $value;
        }

        return $data;
    }

    public function get_promocode_list()
    {
        $this->db->select('var_promocode,var_amount,chr_type');
        $this->db->from('mst_promocode');
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $result = $query->result_array();
        
        return $result;
    }

    public function check_promocode($fk_user,$promocode)
    {
        $promo_code = $this->input->post('var_promocode');

        $this->db->select('int_glcode,var_promo_status');
        $this->db->where('int_glcode',$fk_user);
        $res_pro = $this->db->get('mst_users');
        $row_pro = $res_pro->row_array(); 

        $this->db->select('var_promocode');
        $this->db->where('chr_type','N');
        $result = $this->db->get('mst_promocode');
        $row = $result->row_array(); 

        $this->db->select('var_promocode,var_amount,chr_type');
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $this->db->where('var_promocode',$promo_code);
        $res_check = $this->db->get('mst_promocode');
        $row_check = $res_check->row_array(); 

        $this->db->select('int_glcode,var_promocode');
        $this->db->where('fk_user',$fk_user);
        $this->db->where('chr_status!=','R');
        $this->db->where('var_promocode',$promo_code);
        $ord_que = $this->db->get('mst_orders');
        $ord_result = $ord_que->row_array();

        if (empty($row_check)) {
            $promo_msg = "Please Enter Valid Promocode !";
            
        } elseif ($row['var_promocode'] == $promo_code) {

            if ($row_pro['var_promo_status'] == 'Y') {
                $promo_msg = "This Promocode is only for new user !";
            }
        
        } elseif (!empty($ord_result)) {
            $promo_msg = "This Promocode is use once per user !";
        } else {
            $promo_msg = "Promocode Applied Successfully !";
        }

        return $promo_msg;
    }

    public function get_promocode($promocode)
    {
        $this->db->select('var_promocode,var_amount,chr_type');
        $this->db->where('var_promocode',$promocode);
        $result = $this->db->get('mst_promocode');
        $row = $result->row_array(); 

        return $row;
    }
}