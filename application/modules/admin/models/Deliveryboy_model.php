<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deliveryboy_model extends CI_Model {

    
    public function __construct() {
        
        parent::__construct();
        $this->load->database();
        $this->load->model('common_model');
    }

    /*------------------------ get records count ------------------------- */
    public function records_count($search = ''){

        $this->db->select('int_glcode,var_email,chr_delete');
        $this->db->from('mst_delivery_boy');        

        if ($search != '') {

            $this->db->group_start();
            $this->db->like("var_name" , $search);
            $this->db->or_like("var_email" , $search);
            $this->db->or_like("var_mobile_no" , $search);
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
        $this->db->select('mb.int_glcode,mb.fk_vendor,mb.var_name,mb.var_email,mb.var_mobile_no,mb.var_profile,mb.chr_status,mb.current_status,mb.chr_publish,mb.chr_delete,mb.dt_createddate,mv.var_name as vendor_name');
        $this->db->from('mst_delivery_boy mb');
        $this->db->join('mst_vendors mv', 'mv.int_glcode = mb.fk_vendor', 'left');
        $this->db->where('mb.chr_delete','N');        
        $this->db->order_by($_field,$_sort);
        $this->db->limit($rowperpage , $rowno);

        if ($search != '') {

            $this->db->group_start();
            $this->db->like("mb.var_name" , $search);
            $this->db->or_like("mb.var_email" , $search);
            $this->db->or_like("mb.var_mobile_no" , $search);  
            $this->db->or_like("mv.var_name" , $search);  
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
        $this->db->from('mst_delivery_boy');
        $this->db->where('int_glcode',$userId);
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }

    /*-------------------------- get vendor listing ----------------------- */
    public function getVendor()
    {
        $this->db->select('int_glcode,var_name');
        $this->db->from('mst_vendors');
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;
    }

    /*------------------------ get vendors documents ------------------------- */
    public function getVendorDocuments($vendorId)
    {
        $this->db->select('int_glcode,fk_vendor,var_document');
        $this->db->from('trn_vendor_documents');
        $this->db->where('fk_vendor',$vendorId);
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;
    }

    /*------------------------ add record ------------------------- */
    public function addRecord()
    {
        if($_FILES['var_image']['name'] != '')
        {
            if (!is_dir('uploads/deliveryboy')) {
                mkdir('uploads/deliveryboy', 0777, TRUE);
            }
                $filename = time().'_'.$_FILES['var_image']['name'];
                $filename = str_replace('&', "_", $filename);
                $filename = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename);
                $destination = 'uploads/deliveryboy/';
                move_uploaded_file($_FILES['var_image']['tmp_name'],$destination.$filename);
            } else {
                $filename =  '';
            }

            if (!is_dir('uploads/deliveryboy_docs')) {
                mkdir('uploads/deliveryboy_docs', 0777, TRUE);
            }
            if($_FILES['var_aadhar']['name'] != '')
            {
                $var_aadhar = time().'_'.$_FILES['var_aadhar']['name'];
                $var_aadhar = str_replace('&', "_", $var_aadhar);
                $var_aadhar = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $var_aadhar);
                $destination = 'uploads/deliveryboy_docs/';
                move_uploaded_file($_FILES['var_aadhar']['tmp_name'],$destination.$var_aadhar);
            } else {
                $var_aadhar =  '';
            }

            if($_FILES['var_aadhar2']['name'] != '')
            {
                $var_aadhar2 = time().'_'.$_FILES['var_aadhar2']['name'];
                $var_aadhar2 = str_replace('&', "_", $var_aadhar2);
                $var_aadhar2 = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $var_aadhar2);
                $destination = 'uploads/deliveryboy_docs/';
                move_uploaded_file($_FILES['var_aadhar2']['tmp_name'],$destination.$var_aadhar2);
            } else {
                $var_aadhar2 =  '';
            }

            if($_FILES['var_pancard']['name'] != '')
            {
                $var_pancard = time().'_'.$_FILES['var_pancard']['name'];
                $var_pancard = str_replace('&', "_", $var_pancard);
                $var_pancard = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $var_pancard);
                $destination = 'uploads/deliveryboy_docs/';
                move_uploaded_file($_FILES['var_pancard']['tmp_name'],$destination.$var_pancard);
            } else {
                $var_pancard =  '';
            }

            $data = array(
                'fk_vendor' => $this->input->post('fk_vendor'),
                'var_name' => $this->input->post('var_name'),
                'var_email' => $this->input->post('email'),
                'var_mobile_no' => $this->input->post('phone'),
                'var_password' => $this->mylibrary->cryptPass($this->input->post('password')),
                'var_profile' => $filename,
                'var_aadharcard' => $var_aadhar,
                'var_aadharcard2' => $var_aadhar2,
                'var_pancard' => $var_pancard,
                'chr_publish' => 'Y',
                'chr_delete' => 'N',
                'dt_createddate' => date('Y-m-d H:i:s'),
                'dt_modifydate' => date('Y-m-d H:i:s'),
                'var_ipaddress' => $_SERVER['REMOTE_ADDR']
            );

        $id = $this->common_model->insertRow($data, "mst_delivery_boy");

        //echo $this->db->last_query(); exit();
           
        return TRUE;

    }

    /*---------------------------- update user app ----------------------*/
    public function updateRecord($vendorId)
    {
        if($_FILES['var_image']['name'] != '')
        {
            if (!is_dir('uploads/deliveryboy')) {
                mkdir('uploads/deliveryboy', 0777, TRUE);
            }

            $filename = time().'_'.$_FILES['var_image']['name'];
            $filename = str_replace('&', "_", $filename);
            $filename = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename);
            $destination = 'uploads/deliveryboy/';
            move_uploaded_file($_FILES['var_image']['tmp_name'],$destination.$filename);
        } else {
            $filename =  $this->input->post('hidvar_image');
        }

        if (!is_dir('uploads/deliveryboy_docs')) {
                mkdir('uploads/deliveryboy_docs', 0777, TRUE);
            }
            if($_FILES['var_aadhar']['name'] != '')
            {
                $var_aadhar = time().'_'.$_FILES['var_aadhar']['name'];
                $var_aadhar = str_replace('&', "_", $var_aadhar);
                $var_aadhar = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $var_aadhar);
                $destination = 'uploads/deliveryboy_docs/';
                move_uploaded_file($_FILES['var_aadhar']['tmp_name'],$destination.$var_aadhar);
            } else {
                $var_aadhar =  $this->input->post('hidvar_aadhar');
            }

            if($_FILES['var_aadhar2']['name'] != '')
            {
                $var_aadhar2 = time().'_'.$_FILES['var_aadhar2']['name'];
                $var_aadhar2 = str_replace('&', "_", $var_aadhar2);
                $var_aadhar2 = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $var_aadhar2);
                $destination = 'uploads/deliveryboy_docs/';
                move_uploaded_file($_FILES['var_aadhar2']['tmp_name'],$destination.$var_aadhar2);
            } else {
                $var_aadhar2 =  $this->input->post('hidvar_aadhar2');
            }

            if($_FILES['var_pancard']['name'] != '')
            {
                $var_pancard = time().'_'.$_FILES['var_pancard']['name'];
                $var_pancard = str_replace('&', "_", $var_pancard);
                $var_pancard = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $var_pancard);
                $destination = 'uploads/deliveryboy_docs/';
                move_uploaded_file($_FILES['var_pancard']['tmp_name'],$destination.$var_pancard);
            } else {
                $var_pancard =  $this->input->post('hidvar_pancard');
            }

       
        $data = array(
            'fk_vendor' => $this->input->post('fk_vendor'),
            'var_name' => $this->input->post('var_name'),
            'var_email' => $this->input->post('email'),
            'var_mobile_no' => $this->input->post('phone'),
            'var_password' => $this->mylibrary->cryptPass($this->input->post('password')),
            'var_profile' => $filename,
            'var_aadharcard' => $var_aadhar,
            'var_aadharcard2' => $var_aadhar2,
            'var_pancard' => $var_pancard,
            'dt_modifydate' => date('Y-m-d H:i:s'),
            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
        );

        $this->common_model->updateRow('mst_delivery_boy', $data, array("int_glcode" => $vendorId));
        
        //echo $this->db->last_query(); exit();
        return TRUE;

    }
    
    /*---------------- check email already exit or not --------------*/
    public function checkEmail($eaddress)
    {
        $select = "select int_glcode from mst_delivery_boy where chr_delete = 'N' and chr_publish = 'Y' and var_email = '".$eaddress."'";
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
        $select = "select int_glcode from mst_delivery_boy where chr_delete = 'N' and chr_publish = 'Y' and var_mobile_no = '".$mobile."'";
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
            if($this->db->update("mst_delivery_boy",$data))
            {
                $i++;
                $smsg = $i." Records successfully deleted...";
            }
            else
            {
                $smsg = $this->db->_error_message();
            }
                $this->db->select('int_glcode,var_name');
                $this->db->from('mst_delivery_boy');
                $this->db->where('int_glcode',$value);
                $query = $this->db->get();
                $row = $query->row_array();
                $var_name = $row['var_name'];

                $this->common_model->insertinlogmanager('Delete',$var_name);
        }
        // $this->db->query("DELETE from ci_users WHERE id='$id'");
        return $smsg;

    }

    /*-------------------------------- update publish -------------------------*/
    public function updatedisplay() 
    {
        if ($this->input->get_post('fieldname') == 'chr_status') {

            $this->db->select('int_glcode,var_device_token');
            $this->db->from('mst_delivery_boy');
            $this->db->where('int_glcode',$this->input->get_post('id'));
            $query = $this->db->get();
            $row = $query->row_array();

            $this->load->model('sendnotification_model');
            
            $this->sendnotification_model->block_unblock_notification($row['var_device_token'],$this->input->get_post('value'));
        }

        $data = array(
            $this->input->get_post('fieldname')=>$this->input->get_post('value')
        );

        $this->db->where('int_glcode', $this->input->get_post('id'));
        $a=$this->db->update($this->input->get_post('tablename'), $data);

        echo ($a) ? "1" : "0";
        exit;
    }

    
}