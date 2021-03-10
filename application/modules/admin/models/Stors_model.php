<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stors_model extends CI_Model {

	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		$this->load->model('common_model');
	}

    /*------------------------ get records count ------------------------- */
    public function records_count($search = ''){

        $this->db->select('*');
        $this->db->from('mst_stors');        

        if ($search != '') {

            $this->db->group_start();
            $this->db->like("var_name" , $search);
            $this->db->or_like("var_address" , $search);
            $this->db->group_end();

        }

        $this->db->where('chr_delete','N');        

        $result = $this->db->get();
        $row = $result->result_array();
        //echo $this->db->last_query();die();
        return count($row);
    
    }

    /*------------------------ get records  ------------------------- */
    public function getData($rowno,$rowperpage,$search = '',$_field = 'int_glcode',$_sort = 'desc')
    {          
        $this->db->select('*');
        $this->db->from('mst_stors');
        $this->db->where('chr_delete','N');        
        $this->db->order_by($_field,$_sort);
        $this->db->limit($rowperpage , $rowno);

        if ($search != '') {

            $this->db->group_start();
            $this->db->like("var_name" , $search);
            $this->db->or_like("var_address" , $search);
            $this->db->group_end();
        }

        $result = $this->db->get();
        $row = $result->result_array();

        return $row;
    }

    /*------------------------ get id by record ------------------------- */
    public function getIdByData($userId)
    {
        $this->db->select('*');
        $this->db->from('mst_stors');
        $this->db->where('int_glcode',$userId);
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }


    /*------------------------ add record ------------------------- */
    public function addRecord()
    {
        
	        $data = array(
		        'var_name' => $this->input->post('var_name'),
		        'var_address' => $this->input->post('var_address'),
		        'var_lat' => $this->input->post('var_lat'),
                'var_long' => $this->input->post('var_long'),
		        'chr_publish' => 'Y',
		        'chr_delete' => 'N'
	     	);

        $id = $this->common_model->insertRow($data, "mst_stors");
        
        //  echo $this->db->last_query(); die();
        return TRUE;

    }


    /*---------------------------- update user admin ----------------------*/
    public function updateRecord($userId)
    {
        
       
        $data = array(
	        'var_name' => $this->input->post('var_name'),
		        'var_address' => $this->input->post('var_address'),
		        'var_lat' => $this->input->post('var_lat'),
                'var_long' => $this->input->post('var_long')
     	);

        $this->common_model->updateRow('mst_stors', $data, array("int_glcode" => $userId));
       
        //echo $this->db->last_query(); exit();
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
            if($this->db->update("mst_stors",$data))
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