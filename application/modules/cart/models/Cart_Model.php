<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_Model extends CI_Model {
   
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('common_model');        
    }

    public function get_user_address($uid){
        
        $this->db->select('*');
        $this->db->where('fk_user',$uid);
        $this->db->where('chr_delete','N');
        $this->db->where('chr_publish','Y');
        $res = $this->db->get('mst_user_address');
        $result = $res->result_array(); 
        return $result;
    }

    public function get_user_details($uid){
        
        $this->db->select('int_glcode,var_name,var_email,txt_address,var_mobile_no,var_alt_mobile,var_default_no,var_wallet');
        $this->db->where('int_glcode',$uid);
        $this->db->where('chr_delete','N');
        $this->db->where('chr_publish','Y');
        $res = $this->db->get('mst_users');
        $result = $res->row_array(); 
        return $result;
    }
    
    public function get_delivery_charges(){
        
        $this->db->select('*');
        $res = $this->db->get('mst_delivery_charges');
        $result = $res->result_array();
        return $result;
    }
    
    public function get_delivery_timeslot($type,$delivery_date){
    
        if(date('Y-m-d') == $delivery_date){
            $this->db->select('*');
            $this->db->where('chr_type',$type);
            $this->db->where('dt_slot_end_time >',date('H:m'));
            $res = $this->db->get('mst_delivery_timeslot');
            $result = $res->result_array();
        }else{
            $this->db->select('*');
            $this->db->where('chr_type',$type);
            $res = $this->db->get('mst_delivery_timeslot');
            $result = $res->result_array();
        }
        //echo "<pre>"; print_r($result); exit();
        $html = '<div class="request_radio" id="delivery_timeslot">';
        if (!empty($result)) {
            foreach ($result as $key => $row){
            if ($row['chr_type'] == 'S') {
                $html .= '<div class="check_box_div"><input id="option_noncr'.$key.'" type="radio" name="delivery_timeslot" value="'.$row['dt_start_time'].' - '.$row['dt_end_time'].'" required="">            
                        <label for="option_noncr'.$key.'"><span><span>'.$row['dt_start_time'].' - '.$row['dt_end_time'].'</span></span></label></div>';
            } else {
                $html .= '<p><b>Within 1 hour</b></p>';
            }
            
            }
        } else {
            $html .= '<p>Current No Delivery Timeslot Found.';
        }
        

        $html .= '</div>';
        return $html; 
    }
    
}