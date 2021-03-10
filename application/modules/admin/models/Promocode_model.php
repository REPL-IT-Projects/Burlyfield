<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Promocode_model extends CI_Model {

    public function __construct() {

        parent::__construct();

        $this->load->database();

        $this->load->model('common_model');
    }

    
    /*---------------------- get data --------------------*/
    public function getPromocodeData()
    {
        $this->db->select('*');
        $this->db->from('mst_promocode');
        $this->db->where('chr_type !=','N');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;
    }

    public function getMinimumAmount()
    {
        $this->db->select('int_glcode,var_value');
        $this->db->from('mst_settings');
        $this->db->where('var_title','minimum_amount');
        $result = $this->db->get(); 
        $row = $result->row_array();

        return $row['var_value'];
    }

    public function getPromocodeNewuser()
    {
        $this->db->select('*');
        $this->db->from('mst_promocode');
        $this->db->where('chr_type','N');
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }

    /*---------------------- get order rejection reasons --------------------*/
    public function getIdByValue($id)
    {
        $this->db->select('*');
        $this->db->from('mst_promocode');
        $this->db->where('int_glcode',$id);
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }

    /*------------------------ add reasons ------------------------- */
    public function addRecord()
    {
        $data = array(
            'var_promocode' => $this->input->post('var_title'),
            'var_amount' => $this->input->post('var_value'),
            'chr_type' => $this->input->post('chr_type'),
            'dt_createddate' => date('Y-m-d H:i:s'),
            'dt_modifydate' => date('Y-m-d H:i:s'),
            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
        );

        $id = $this->common_model->insertRow($data, "mst_promocode");

        $this->db->select('int_glcode,var_device_token');
        $this->db->from('mst_users');
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $result = $this->db->get(); 
        $row = $result->result_array();

        foreach ($row as $key => $value) {
            $this->addOffers($value['var_device_token'],$this->input->post('var_title'));
        }

        return TRUE;
    }

    /*----------------------- set amount ----------------------------*/
    
    public function addMinimumAmount()
    {
        $this->db->select('int_glcode');
        $this->db->from('mst_settings');
        $this->db->where('var_title','minimum_amount');
        $result = $this->db->get(); 
        $row = $result->row_array();

        if(empty($row)){
            $data = array(
                'var_title' => 'minimum_amount',
                'var_value' => $this->input->post('var_set_amt'),
                'dt_createddate' => date('Y-m-d H:i:s'),
                'dt_modifydate' => date('Y-m-d H:i:s'),
                'var_ipaddress' => $_SERVER['REMOTE_ADDR']
            );

            $this->common_model->insertRow($data, "mst_settings");
        } else {
            $data = array(
                'var_value' => $this->input->post('var_set_amt'),
                'dt_modifydate' => date('Y-m-d H:i:s'),
                'var_ipaddress' => $_SERVER['REMOTE_ADDR']
            );

            $this->common_model->updateRow('mst_settings', $data, array("var_title" => 'minimum_amount')); 
        }
        
        return TRUE;

    }

    /*-------------------------- update record ------------------------------*/
    public function updateRecord()
    {
        $id = $this->input->post('fk_promocode');

        $data = array(
            'var_promocode' => $this->input->post('var_title'),
            'var_amount' => $this->input->post('var_value'),
            'chr_type' => $this->input->post('chr_type'),
            'dt_modifydate' => date('Y-m-d H:i:s'),
            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
        );

        $this->common_model->updateRow('mst_promocode', $data, array("int_glcode" => $id)); 

        $this->db->select('int_glcode,var_device_token');
        $this->db->from('mst_users');
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $result = $this->db->get(); 
        $row = $result->result_array();

        foreach ($row as $key => $value) {
            $this->addOffers($value['var_device_token'],$this->input->post('var_title'));
        }

        return TRUE;

    }

    public function updateNewUserPrice()
    {
        $this->db->select('int_glcode');
        $this->db->from('mst_promocode');
        $this->db->where('chr_type','N');
        $result = $this->db->get(); 
        $row = $result->row_array();

        if (!empty($row)) {
            $data = array(
                'var_promocode' => $this->input->post('var_new_title'),
                'var_amount' => $this->input->post('var_new_value'),
                'chr_type' => 'N',
                'dt_modifydate' => date('Y-m-d H:i:s'),
                'var_ipaddress' => $_SERVER['REMOTE_ADDR']
            );

            $this->common_model->updateRow('mst_promocode', $data, array("chr_type" => 'N')); 
        } else {
            $data = array(
                'var_promocode' => $this->input->post('var_new_title'),
                'var_amount' => $this->input->post('var_new_value'),
                'chr_type' => 'N',
                'dt_createddate' => date('Y-m-d H:i:s'),
                'dt_modifydate' => date('Y-m-d H:i:s'),
                'var_ipaddress' => $_SERVER['REMOTE_ADDR']
            );

            $id = $this->common_model->insertRow($data, "mst_promocode");
        }

        return TRUE;
    }

    /*-------------------------------- delete multiple -------------------------*/
    public function delete_multiple($tbl_name)
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
            if($this->db->update($tbl_name,$data))
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

    /*------------------------- add offers ----------------------------*/
    public function addOffers($deviceId,$promocode)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $target = $deviceId;

        $data['type'] = 'New Offer';

        $data['message'] = 'Vruits Promo Code - '.$promocode.' Cashback On products (Select Users/1 Time)';

        $fields = array();

        $fields['data'] = $data;

        if (is_array($target)) {
            $fields['registration_ids'] = $target;
        } else {
            $fields['to'] = $target;
        }

        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . PUSH_NOTIFICATION_KEY
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
    }

}