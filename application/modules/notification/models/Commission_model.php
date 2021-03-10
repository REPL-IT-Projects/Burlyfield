<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Commission_model extends CI_Model {

    public function __construct() {

        parent::__construct();

        $this->load->database();

        $this->load->model('common_model');
        $this->load->library('image_lib');
    }

    /*---------------------- vendor send 15 days notification --------------------*/
    public function vendor_half_commission()
    {
        $this->db->select('var_name,dt_startdate,dt_enddate,var_device_token');
        $this->db->from('mst_vendors');
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();

        $current_date = date('Y-m-d');
        
        $data = array();

        foreach ($row as $key => $value) {

        	$days_ago = date('Y-m-d', strtotime('-15 days', strtotime($value['dt_enddate'])));
            
            if ($current_date == $days_ago) {
                
                $send_date_vendor = date('d/m/Y',strtotime($days_ago));

                $notification = $this->vendorCommissionNotification($value['var_name'],$value['var_device_token'],$send_date_vendor);
            }

            $day_ago = date('Y-m-d', strtotime('-1 day', strtotime($value['dt_enddate'])));

            if ($current_date == $day_ago) {

                $send_date = date('d/m/Y',strtotime($day_ago));

                $notification = $this->vendorCommissionNotification($value['var_name'],$value['var_device_token'],$send_date);
            }

        }

        //echo "<pre>"; print_r($data); exit();
    }

    /*------------------------- send notification --------------------------------*/
    public function vendorCommissionNotification($name,$deviceId,$date)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $target = $deviceId;

        $data['type'] = 'Expired Membership';

        $data['message'] = 'Dear '.$name.', Your membership expire on '.$date;

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

    /*------------------------------ get product thumb creation script ----------------------------*/
    public function productThumbCreation()
    {
        $this->db->select('var_image');
        $this->db->from('mst_products');
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();

        $current_date = date('Y-m-d');
        
        $data = array();

        foreach ($row as $key => $value) {
            $destination = 'uploads/products/';
            $config['image_library'] = 'gd2';
            $config['source_image'] = $destination.$value['var_image'];
            $config['new_image'] =  'uploads/products/thumb_img/'.$value['var_image'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width']     = 200;
            $config['height']   = 200;

            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }

    }
}