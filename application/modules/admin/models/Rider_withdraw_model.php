<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rider_withdraw_model extends CI_Model {

    public function __construct() {

        parent::__construct();        

        $this->load->model('common_model');   

    }    


    ////////////////// user list function //////////////////////////
    function get_withdraw_request($status){      
         
            $this->db->select('e.*,d.var_name,d.var_mobile_no,d.var_email'); 
            $this->db->join('mst_delivery_boy d','d.int_glcode = e.fk_delivery');
            $this->db->from('delivery_withdraw e');            
            $this->db->order_by('e.int_glcode','DESC');
            $this->db->where('e.chr_status',$status);    
            $result = $this->db->get();

            $row = $result->result_array();

        return $row;
        
   }
   
        
   public function admin_withdraw_toExcel(){

            $row = $this->get_valueby_admin();


        $filename = "admin_by_value.xls"; // File Name
            // Download file
            header("Content-Disposition: attachment; filename=\"$filename\"");
            header("Content-Type: application/vnd.ms-excel");

            $flag = false;
         
            foreach ($row as $key => $value) {
               
                if (!$flag) {
                    // display field/column names as first row
                    //echo implode("\t", array_keys($row)) . "\r\n";
                    echo "So.No."."\t"."Driver Code"."\t"."Driver Name"."\t"."Driver Phone"."\t"."Driver Email"."\t"."Amount"."\t"."Reason". "\r\n";
                    $flag = true;
                }
                //echo implode("\t", array_values($row)) . "\r\n";
                $key = $key+1;
                echo $key."\t".$value["unique_code"]."\t".$value["var_name"]."\t".$value["var_phone"]."\t".$value["var_email"]."\t".$value["var_amount"]."\t".$value["txt_reason"]."\r\n";
            }
    }
    
}