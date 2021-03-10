<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_chat_model extends CI_Model {

    public function __construct() {

        parent::__construct();        

        $this->load->model('common_model');   

    }    

    function get_chat_name(){
        
        $this->db->select("s.int_glcode,s.var_name,s.var_image,u.int_glcode as chat_id,u.fk_user");
        $this->db->join('mst_users s','s.int_glcode = u.fk_user');
        //$this->db->group_by("u.fk_user");
        $this->db->order_by("u.int_glcode","DESC");
        $sql1 = $this->db->get('mst_user_chat u');
        $array = $sql1->result_array();

        $temp = array_unique(array_column($array, 'fk_user'));
        $unique_arr = array_intersect_key($array, $temp);
        
        return $unique_arr;
    }
        
    function load_chat($to_id){
            
        $sql = $this->db->query("SELECT * FROM mst_user_chat WHERE fk_user = $to_id  order by int_glcode ASC");
        $res = $sql->result_array();
        
        $update = $this->db->query("UPDATE mst_user_chat set int_seen='1' WHERE fk_user = $to_id ");
        
        return $res;
    }
        
}