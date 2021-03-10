<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery_model extends CI_Model {

    public function __construct() {

        parent::__construct();

        $this->load->database();

        $this->load->model('common_model');
    }

    /*----------------------- vendor login API -------------------------*/
    public function deliveryboy_login($username,$password)
    {
        $this->db->select('*');
        $this->db->from('mst_delivery_boy');
        $this->db->where('var_mobile_no',$username);
        $this->db->where('var_password', $password);
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();

        //echo $this->db->last_query(); exit();
        $row = $query->row_array();

        return $row;
    }

    /*----------------------- update device ID on login time in API --------------------*/
    public function updateDeviceId($Id,$deviceId)
    {
        $this->db->set('var_device_token', $deviceId);
        $this->db->where('int_glcode',$Id);
        $this->db->update('mst_delivery_boy');
        return true;
    }

    /*--------------------------- get vendor details ---------------------------------*/
    public function viewDeliveryboyDetail($id)
    {
        $this->db->select('*');
        $this->db->from('mst_delivery_boy');
        $this->db->where('int_glcode',$id);
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->row_array();
        return $row;
    }

    /*---------------------- get id by delivery boy list --------------------*/
    public function getDeliveryListing($vendorId)
    {
        $this->db->select('int_glcode as fk_delivery,var_name,var_email,var_mobile_no,var_password,chr_status,var_aadharcard,var_aadharcard2,var_pancard,var_profile');
        $this->db->from('mst_delivery_boy');
        $this->db->where('fk_vendor',$vendorId);
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();

        $data = array();

        foreach ($row as $key => $value) {
            $value['var_password'] = $this->mylibrary->decryptPass($value['var_password']);
            if ($value['var_aadharcard'] != '') {
                $value['var_aadharcard'] = base_url().'uploads/deliveryboy_docs/'.$value['var_aadharcard'];
            } else {
                $value['var_aadharcard'] = '';
            }

            if ($value['var_aadharcard2'] != '') {
                $value['var_aadharcard2'] = base_url().'uploads/deliveryboy_docs/'.$value['var_aadharcard2'];
            } else {
                $value['var_aadharcard2'] = '';
            }

            if ($value['var_pancard'] != '') {
                $value['var_pancard'] = base_url().'uploads/deliveryboy_docs/'.$value['var_pancard'];
            } else {
                $value['var_pancard'] = '';
            }
            
            if ($value['var_profile'] != '') {
                $value['var_profile'] = base_url().'uploads/deliveryboy/'.$value['var_profile'];
            } else {
                $value['var_profile'] = '';
            }

            $data[] = $value;
        }

        return $data;
    }

    /*------------------------------- get otp --------------------------- */
    public function vendor_get_otp($vendor_id,$var_otp) 
    {
        $this->db->select('*');
        $this->db->from('mst_vendors');
        $this->db->where('int_glcode', $vendor_id);
        $this->db->where('var_otp', $var_otp);
        $result = $this->db->get(); 
        $row = $result->row_array();

        return $row;  

    }

    /*---------------------- delivery boy block unbloack --------------------*/
    public function updateStatus($delivery_id,$vendorId,$chr_status)
    {
        $data = array(
            'chr_status' => $chr_status
        );

        $this->db->where('int_glcode', $delivery_id);
        $this->db->where('fk_vendor', $vendorId);
        $this->db->update('mst_delivery_boy', $data);

        return TRUE;
    }

    /*---------------- check email already exit or not delivery --------------*/
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

    /*---------------- check mobile no. already exit or not delivery --------------*/
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

    public function check_image($vid){
        
        $this->db->select('int_glcode,var_profile,var_aadharcard,var_aadharcard2,var_pancard');
        $this->db->where('int_glcode',$vid);
        $sql = $this->db->get('mst_delivery_boy');
        $res = $sql->row_array();
        return $res;
    }
    
    /*-------------------------- update delivery boy from vendor ------------------------------*/
    public function update_delivery_boy($id)
    {
        $img = $this->check_image($id);
        if(isset($_FILES['var_aadharcard']['name']))
        {
            if (!is_dir('uploads/deliveryboy_docs')) {
                mkdir('uploads/deliveryboy_docs', 0777, TRUE);
            }
                $filename = time().'_'.$_FILES['var_aadharcard']['name'];
                $filename = str_replace('&', "_", $filename);
                $filename = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename);
                $destination = 'uploads/deliveryboy_docs/';
                move_uploaded_file($_FILES['var_aadharcard']['tmp_name'],$destination.$filename);
            } else {
                $filename = $img['var_aadharcard'];
            }

        if(isset($_FILES['var_aadharcard1']['name']))
        {
            if (!is_dir('uploads/deliveryboy_docs')) {
                mkdir('uploads/deliveryboy_docs', 0777, TRUE);
            }
                $filename1 = time().'_'.$_FILES['var_aadharcard1']['name'];
                $filename1 = str_replace('&', "_", $filename1);
                $filename1 = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename1);
                $destination = 'uploads/deliveryboy_docs/';
                move_uploaded_file($_FILES['var_aadharcard1']['tmp_name'],$destination.$filename1);
        } else {
            $filename1 =  $img['var_aadharcard2'];
        }

        if(isset($_FILES['var_pancard']['name']))
        {
            if (!is_dir('uploads/deliveryboy_docs')) {
                mkdir('uploads/deliveryboy_docs', 0777, TRUE);
            }
                $pan_card = time().'_'.$_FILES['var_pancard']['name'];
                $pan_card = str_replace('&', "_", $pan_card);
                $pan_card = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $pan_card);
                $destination = 'uploads/deliveryboy_docs/';
                move_uploaded_file($_FILES['var_pancard']['tmp_name'],$destination.$pan_card);
        } else {
            $pan_card =  $img['var_pancard'];
        }
        
        if(isset($_FILES['var_profile']['name']))
        {
            if (!is_dir('uploads/deliveryboy')) {
                mkdir('uploads/deliveryboy', 0777, TRUE);
            }
                $filename2 = time().'_'.$_FILES['var_profile']['name'];
                $filename2 = str_replace('&', "_", $filename2);
                $filename2 = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename2);
                $destination = 'uploads/deliveryboy/';
                move_uploaded_file($_FILES['var_profile']['tmp_name'],$destination.$filename2);
        } else {
            $filename2 =  $img['var_profile'];
        }

        $data = array(
            'var_name' => $this->input->post('var_name'),
            'var_email' => $this->input->post('var_email'),
            'var_mobile_no' => $this->input->post('var_mobile_no'),
            'var_password' => $this->mylibrary->cryptPass($this->input->post('var_password')),
            'var_profile' => $filename2,
            'var_aadharcard' => $filename,
            'var_aadharcard2' => $filename1,
            'var_pancard' => $pan_card,
            'dt_modifydate' => date('Y-m-d H:i:s')
        );

        $this->common_model->updateRow('mst_delivery_boy', $data, array("int_glcode" => $id)); 

        $this->db->select('int_glcode as fk_delivery,var_name,var_email,var_mobile_no,var_password,chr_status,var_aadharcard,var_aadharcard2,var_profile,var_pancard');
        $this->db->from('mst_delivery_boy');
        $this->db->where('int_glcode',$id);
        $query = $this->db->get();
        $row = $query->result_array();

        $get_arr = array();
        foreach ($row as $key => $value) {
            $value['var_password'] = $this->mylibrary->decryptPass($value['var_password']);
            if ($value['var_aadharcard'] != '') {
                $value['var_aadharcard'] = base_url().'uploads/deliveryboy_docs/'.$value['var_aadharcard'];
            } else {
                $value['var_aadharcard'] = '';
            }

            if ($value['var_aadharcard2'] != '') {
                $value['var_aadharcard2'] = base_url().'uploads/deliveryboy_docs/'.$value['var_aadharcard2'];
            } else {
                $value['var_aadharcard2'] = '';
            }

            if ($value['var_pancard'] != '') {
                $value['var_pancard'] = base_url().'uploads/deliveryboy_docs/'.$value['var_pancard'];
            } else {
                $value['var_pancard'] = '';
            }
            
            if ($value['var_profile'] != '') {
                $value['var_profile'] = base_url().'uploads/deliveryboy/'.$value['var_profile'];
            } else {
                $value['var_profile'] = '';
            }
            
            $get_arr = $value;
        }

        return $get_arr;

    }

    public function check_delivery_boy($fk_delivery)
    {
        $this->db->select('int_glcode as fk_delivery,chr_status,current_status,chr_publish,chr_delete');
        $this->db->from('mst_delivery_boy');
        $this->db->where('int_glcode',$fk_delivery);
        $query = $this->db->get();
        $row = $query->row_array();
        return $row;
    }

    public function delivery_boy_list()
    {
        $this->db->select('int_glcode as fk_delivery,fk_vendor,var_name,var_email,var_mobile_no,chr_status,current_status');
        $this->db->from('mst_delivery_boy');
        $this->db->where('chr_status','U');
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }

    /*--------------------- deliveryboy logout  --------------------*/
    public function deliveryboy_logout($deliveryId)
    {
        $data = array(
            'var_device_token' => ''  
        );

        $this->common_model->updateRow('mst_delivery_boy', $data, array("int_glcode" => $deliveryId)); 
        return TRUE;
    }

}