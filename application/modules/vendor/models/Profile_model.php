<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {

	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		$this->load->model('common_model');
	}

  function getIdByData($id){
      
      $this->db->select('*');
      $this->db->where('int_glcode',$id);
      $res = $this->db->get('mst_vendors');
      $row = $res->row_array();
      return $row;
  }
    /*---------------------------- update user admin ----------------------*/
    public function updateRecord($vendorId)
    {
        if($_FILES['var_image']['name'] != '')
        {
            if (!is_dir('uploads/vendor')) {
                mkdir('uploads/vendor', 0777, TRUE);
            }

            $filename = time().'_'.$_FILES['var_image']['name'];
            $filename = str_replace('&', "_", $filename);
            $filename = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename);
            $destination = 'uploads/vendor/';
            move_uploaded_file($_FILES['var_image']['tmp_name'],$destination.$filename);
        } else {
            $filename =  $this->input->post('hidvar_image');
        }
       
        $data = array(
            'var_name' => $this->input->post('var_name'),
            'var_mobile_no' => $this->input->post('phone'),
            'var_email' => $this->input->post('email'),
            'var_password' => $this->mylibrary->cryptPass($this->input->post('password')),
            'var_image' => $filename,
            'var_address' => $this->input->post('var_address'),
            'var_latitude' => $this->input->post('var_latitude'),
            'var_longitude' => $this->input->post('var_longitude'),
            'dt_modifydate' => date('Y-m-d H:i:s'),
            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
        );

        $this->common_model->updateRow('mst_vendors', $data, array("int_glcode" => $vendorId));
        //$this->common_model->insertinlogmanager('Update',$this->input->post('var_name'));
        //echo "<pre>"; print_r($_POST);
        // echo "<pre>"; print_r($_FILES['img_document']['tmp_name']); exit();

        //echo $this->db->last_query(); exit();
        return TRUE;

    }
    
    /*---------------- check email already exit or not --------------*/
    public function checkEmail($eaddress)
    {
        $select = "select int_glcode from mst_users where chr_delete = 'N' and chr_publish = 'Y' and var_email = '".$eaddress."'";
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
        $select = "select int_glcode from mst_users where chr_delete = 'N' and chr_publish = 'Y' and var_mobile_no = '".$mobile."'";
        $result = $this->db->query($select);
        $count = $result->num_rows();
        if($count > 0){
            return false;
        }else{
            return true;
        }
    }
    
    
}