<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pincode_model extends CI_Model {

	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		$this->load->model('common_model');
	}

    /*------------------------ get records count ------------------------- */
    public function records_count($search = ''){

        $this->db->select('int_glcode');
        $this->db->from('mst_pincode');        

        if ($search != '') {

            $this->db->group_start();
            $this->db->like("var_pincode" , $search);
            $this->db->group_end();

        }       

        $result = $this->db->get();
        $row = $result->result_array();
        return count($row);
    
    }

    /*------------------------ get records  ------------------------- */
    public function getData($rowno,$rowperpage,$search = '',$_field = 'int_glcode',$_sort = 'desc')
    {          
        $this->db->select('int_glcode,var_pincode,int_day,flag,chr_delete,dt_createddate');
        $this->db->from('mst_pincode');
        $this->db->where('chr_delete','N');        
        $this->db->order_by($_field,$_sort);
        $this->db->limit($rowperpage , $rowno);

        if ($search != '') 
        {
            $this->db->group_start();
            $this->db->like("var_pincode" , $search);
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
        $this->db->from('mst_pincode');
        $this->db->where('int_glcode',$userId);
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }
    
    public function addRecord()
    {
        $data = array(
		        'var_pincode' => $this->input->post('var_pincode'),
		        'int_day' => $this->input->post('int_day'),
                'flag' => $this->input->post('flag'),
                'dt_createddate' => date('Y-m-d H:i:s'),
		        'var_ipaddress' => $_SERVER['REMOTE_ADDR']
	     	);

        $id = $this->common_model->insertRow($data, "mst_pincode");
        
        return TRUE;

    }

    /*---------------------------- update user admin ----------------------*/
    public function updateRecord($userId)
    {
        $data = array(
		        'var_pincode' => $this->input->post('var_pincode'),
		        'int_day' => $this->input->post('int_day'),
                'flag' => $this->input->post('flag'),
		        'dt_modifydate' => date('Y-m-d H:i:s'),
		        'var_ipaddress' => $_SERVER['REMOTE_ADDR']
	     	);

        $this->common_model->updateRow('mst_pincode', $data, array("int_glcode" => $userId));
        return TRUE;

    }
    
    /*---------------- check email already exit or not --------------*/
    public function checkEmail($eaddress)
    {
        $select = "select int_glcode from mst_pincode where chr_delete = 'N' and chr_publish = 'Y' and var_email = '".$eaddress."'";
        $result = $this->db->query($select);
        $count = $result->num_rows();
        if($count > 0){
            return false;
        }else{
            return true;
        }
    }

    /*---------------- check mobile no. already exit or not --------------*/
    public function checkMobile($mobile)
    {
        $select = "select int_glcode from mst_pincode where chr_delete = 'N' and chr_publish = 'Y' and var_mobile_no = '".$mobile."'";
        $result = $this->db->query($select);
        $count = $result->num_rows();
        if($count > 0){
            return false;
        }else{
            return true;
        }
    }
    
    /*---------------- If vairable return null value then return blank --------------*/
    public function emptyVar($field)
    {
      if($field == NULL) {
            $field = "";
        }
        return $field;
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
            if($this->db->update("mst_pincode",$data))
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