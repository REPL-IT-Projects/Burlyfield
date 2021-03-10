<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model {

    public function __construct() {

        parent::__construct();

        $this->load->database();

        $this->load->model('common_model');
    }

    /*---------------------- get lat long from address --------------------*/
    public function get_user_address()
    {
        $this->db->select('int_glcode as fk_order,var_user_address');
        $this->db->from('mst_orders');
        $this->db->where('chr_status','P');
        $query = $this->db->get();
        $row = $query->result_array();
        //echo "<pre>"; print_r($row); exit();
        $data = array();

        foreach ($row as $key => $value) {
            $address = $this->get_lat_long($value['var_user_address']);

            if (!empty($address)) {

                $select = "SELECT ( 6371 * acos( cos( radians( ".$address['latitude']." ) ) * cos( radians( var_latitude ) ) * 
                 cos( radians( var_longitude ) - radians( ".$address['longitude']." ) ) + sin( radians(".$address['latitude'].")
                 ) * sin( radians( var_latitude ) ) ) ) AS distance,int_glcode,var_device_token from mst_vendors WHERE chr_delete = 'N' AND chr_publish = 'Y'
                 HAVING distance <= 4000 ORDER BY distance ";

                //$select = "SELECT int_glcode,var_device_token from mst_vendors WHERE int_glcode = '2'";

                //echo $select; 
                $result = $this->db->query($select);
                $add_vendor_arr = $result->row_array();

                $this->sendVendorNotification($add_vendor_arr['var_device_token']);
                $this->addVendorOrder($add_vendor_arr['int_glcode'],$value['fk_order']);
            }

        }
        //exit();
        //echo "<pre>"; print_r($data); exit();

    }

    /*----------------------- get vendor reasons ---------------------------*/
    public function get_lat_long($address){
        
        $key = GEOCODE_KEY;
        $address = str_replace(" ", "+", $address);

        $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&key=".$key.""); 
        $json = json_decode($json);

        //echo "<pre>"; print_r($json->{'status'}); 

        if (!empty($json->{'results'})) {
            $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
            $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

            $latlongArray = array('latitude' => $lat, 'longitude' => $long);
        } else {
            $latlongArray = array();
        }
        

        // $key = GEOCODE_KEY;
        // $url = "https://maps.google.com/maps/api/geocode/json?address=".urlencode($address)."&key=".$key."";

        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
        // $responseJson = curl_exec($ch);
        // curl_close($ch);

        // $response = json_decode($responseJson,true);

        // //echo "<pre>"; print_r($response); exit();

        // if ($response['status'] == 'OK') {
        //     $data = $response['results'][0]['geometry']['location'];
        // } else {
        //     $data = array('latitude' => '','longitude' => '');
        // }


        return $latlongArray;
    }

    /*------------------------- send notification --------------------------------*/
    public function sendVendorNotification($deviceId)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $target = $deviceId;

        $data['type'] = 'Receive Order';

        $data['message'] = 'Congratulation! You have received a new order.';

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

    /*---------------------- get lat long from address --------------------*/
    public function send_second_vendor_notification()
    {
        $this->db->select('int_glcode as fk_order,chr_status,var_user_address,canceled_by,dt_createddate');
        $this->db->from('mst_orders');
        $this->db->group_start();
        $this->db->where('chr_status','P');
        $this->db->or_where('chr_status','R');
        $this->db->group_end();
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();

        $current_date = date('Y-m-d H:i:s');

        // echo $current_date."</br>"; 
        // echo $send_time;
        $data = array();

        foreach ($row as $key => $value) {
            if($value['chr_status'] == 'P')
            {   
                $get_time = $value['dt_createddate'];

                $send_time = date("Y-m-d H:i:s",strtotime("+1 minutes", strtotime($get_time)));
                //echo $send_time; 

                if ($send_time >= $get_time) {

                    $select_vendor = "SELECT fk_order,fk_vendor FROM trn_assign_order WHERE fk_order = '".$value['fk_order']."' AND chr_status = 'P'";
                    $result_vendor = $this->db->query($select_vendor);
                    $vendor_arr = $result_vendor->row_array();

                    $this->db->where('fk_vendor', $vendor_arr['fk_vendor']);
                    $this->db->where('fk_order', $vendor_arr['fk_order']);
                    $this->db->delete('trn_assign_order');

                    $address = $this->get_lat_long($value['var_user_address']);

                    if (!empty($address)) {
                        $select = "SELECT ( 6371 * acos( cos( radians( ".$address['latitude']." ) ) * cos( radians( var_latitude ) ) * 
                         cos( radians( var_longitude ) - radians( ".$address['longitude']." ) ) + sin( radians(".$address['latitude'].")
                         ) * sin( radians( var_latitude ) ) ) ) AS distance,int_glcode,var_device_token from mst_vendors WHERE chr_delete = 'N' AND chr_publish = 'Y'
                         HAVING distance <= 5000 ORDER BY distance ASC LIMIT 1";

                        //$select = "SELECT int_glcode,var_device_token from mst_vendors WHERE int_glcode = '2'";

                        //echo $select;
                        $result = $this->db->query($select);
                        $add_vendor_arr = $result->row_array();

                        $this->sendVendorNotification($add_vendor_arr['var_device_token']);
                        $this->addVendorOrder($add_vendor_arr['int_glcode'],$value['fk_order']);
                        //$data[] = $vendor_arr;
                    }

                }
            } elseif (($value['chr_status'] == 'R') && ($value['canceled_by'] == 'V')){

                $get_time = $value['dt_createddate'];

                $send_time = date("Y-m-d H:i:s",strtotime("+1 minutes", strtotime($get_time)));
                //echo $send_time; 

                if ($send_time >= $get_time) {

                    $select_vendor = "SELECT fk_order,fk_vendor FROM trn_assign_order WHERE fk_order = '".$value['fk_order']."' AND chr_status = 'P'";
                    $result_vendor = $this->db->query($select_vendor);
                    $vendor_arr = $result_vendor->row_array();

                    $pre_vendor = $vendor_arr['fk_vendor'];

                    $this->db->where('fk_vendor', $vendor_arr['fk_vendor']);
                    $this->db->where('fk_order', $vendor_arr['fk_order']);
                    $this->db->delete('trn_assign_order');

                    $address = $this->get_lat_long($value['var_user_address']);

                    if (!empty($address)) {
                        $select = "SELECT ( 6371 * acos( cos( radians( ".$address['latitude']." ) ) * cos( radians( var_latitude ) ) * 
                         cos( radians( var_longitude ) - radians( ".$address['longitude']." ) ) + sin( radians(".$address['latitude'].")
                         ) * sin( radians( var_latitude ) ) ) ) AS distance,int_glcode,var_device_token from mst_vendors WHERE chr_delete = 'N' AND int_glcode NOT IN(".$pre_vendor.") AND chr_publish = 'Y'
                         HAVING distance <= 15 ORDER BY distance ASC LIMIT 1";

                        //$select = "SELECT int_glcode,var_device_token from mst_vendors WHERE int_glcode = '2'";

                        //echo $select;
                        $result = $this->db->query($select);
                        $add_vendor_arr = $result->row_array();

                        $this->sendVendorNotification($add_vendor_arr['var_device_token']);
                        $this->addVendorOrder($add_vendor_arr['int_glcode'],$value['fk_order']);

                        $this->db->set('chr_status', 'P'); 
                        $this->db->set('canceled_by', '');  
                        $this->db->where('int_glcode', $value['fk_order']); 
                        $this->db->update('mst_orders');
                        //$data[] = $vendor_arr;
                    }

                }
            } else {

            }
            
            
        }
        //exit();
        return true;

    }

    /*---------------------- get lat long from address --------------------*/
    public function cancel_user_order()
    {
        $this->db->select('int_glcode as fk_order,var_user_address,dt_createddate');
        $this->db->from('mst_orders');
        $this->db->where('int_glcode','30');
        $this->db->where('chr_status','P');
        $query = $this->db->get();
        $row = $query->result_array();

        $current_date = date('Y-m-d H:i:s');

        // echo $current_date."</br>"; 
        // echo $send_time;
        $data = array();

        foreach ($row as $key => $value) {

            $get_time = $value['dt_createddate'];

            $send_time = date("Y-m-d H:i:s",strtotime("+20 minutes", strtotime($get_time)));
            //echo $get_time.'###'.$send_time; 

            if ($send_time >= $get_time) {

                $select_vendor = "SELECT int_glcode,fk_order,fk_vendor FROM trn_assign_order WHERE fk_order = '".$value['fk_order']."' AND chr_status = 'P'";
                $result_vendor = $this->db->query($select_vendor);
                $vendor_arr = $result_vendor->row_array();

                if (!empty($vendor_arr)) {
                    $ut_data = array(
                        'chr_status' => 'R',
                    );

                    $update_que = $this->common_model->updateRow('trn_assign_order', $ut_data, array("int_glcode" => $vendor_arr['int_glcode']));

                    $ord_data = array(
                        'chr_status' => 'R',
                        'canceled_by' => 'S'
                    );
                    
                    $update_que = $this->common_model->updateRow('mst_orders', $ord_data, array("int_glcode" => $vendor_arr['fk_order']));
           
                //$data[] = $vendor_arr;
                }
            }
            //exit();
        }
        //exit();
        return true;

    }

    /*----------------------------- add vendor order ----------------------------- */
    public function addVendorOrder($fk_vendor,$fk_order)
    {
        $select = "SELECT int_glcode,chr_status from trn_assign_order WHERE fk_vendor = '".$fk_vendor."' AND fk_order = '".$fk_order."'";
        $result = $this->db->query($select);
        $row = $result->row_array();

        if ((empty($row)) || ($row['chr_status'] == 'R')) {

            //echo "string";
                $data = array(
                'fk_vendor' => $fk_vendor,
                'fk_delivery' => '0',
                'fk_order' => $fk_order,
                'chr_status' => 'P',
                'dt_createddate' => date('Y-m-d H:i:s')
            );

            $this->common_model->insertRow($data, "trn_assign_order");
        }

        return true;
    }
    
}