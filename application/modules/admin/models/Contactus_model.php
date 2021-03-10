<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactus_model extends CI_Model {

    public function __construct() {

        parent::__construct();        

        $this->load->model('common_model');   

    }    

    ////////////////// banner count get function //////////////////////////
    public function staff_count($search = ''){

        $this->db->select('e.*');
        $this->db->from('mst_contact_us e');              

        if ($search != '') {

        $this->db->group_start();
        $this->db->like("e.var_name", $search);
        $this->db->or_like("e.var_email", $search);
        $this->db->or_like("e.var_phone", $search);
        $this->db->or_like("e.var_subject", $search);
        $this->db->or_like("e.var_message", $search);
        $this->db->group_end();

        }
      

        $result = $this->db->get();
        $row = $result->result_array();
        //echo $this->db->last_query();die();
        return count($row);
    
    }   

    ////////////////// user list function //////////////////////////
    function getStaffData($rowno,$rowperpage,$search = '',$_field = 'e.int_glcode',$_sort = 'desc'){      
        
            $this->db->select('e.*');     
            $this->db->from('mst_contact_us e');            
            $this->db->order_by($_field,$_sort);
            $this->db->limit($rowperpage , $rowno);

            if ($search != '') {

                $this->db->group_start();
                $this->db->like("e.var_name", $search);
                $this->db->or_like("e.var_email", $search);
                $this->db->or_like("e.var_phone", $search);
                $this->db->or_like("e.var_subject", $search);
                $this->db->or_like("e.var_message", $search);
                $this->db->group_end();
            }
   
            $result = $this->db->get();

            $row = $result->result_array();

        return $row;
        
   }
    
    ////////////////////////// update publish ////////////////////////
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

    ////////////////////////////// delete multiple ////////////////////////////////
	public function delete_multiple()   
	{
		// $id = [];
		$id = $_POST['id'];
		$i = 0;
		foreach ($id as $key => $value) {

			$data = array(

				'chr_delete' => 'Y'
			);
            
			//$this->db->set('column_header', $value); //value that used to update column  
			$this->db->where('int_glcode', $value);
			if($this->db->delete('mst_contact_us'))
			{
                            
				$i++;
				$smsg = $i." Records successfully deleted...";
			}else{
				$smsg = $this->db->_error_message();
			}
		}

        // $this->db->query("DELETE from ci_users WHERE id='$id'");
		return $smsg;
	}
        
}