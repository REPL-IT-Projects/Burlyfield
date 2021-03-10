<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

    public function __construct() {

        parent::__construct();

        $this->load->database();

        $this->load->model('common_model');
        $this->load->model('mail_model');
    }

    /*----------------------- update order by delivery boy -----------------------*/
    public function updateOrder($order_id)
    {
        $data = array(
            'fk_product_arr' => $this->input->post('fk_product_arr'),
        );

        $this->db->where('int_glcode', $order_id);
        $this->db->update('mst_orders', $data);

        return 'true';
    }

    /*---------------------- get order list --------------------*/
    public function getOrderDeliveryBoy($fk_delivery)
    {
        $this->db->select('var_name,var_email,var_mobile_no');
        $this->db->from('mst_orders mo');
        $this->db->where('int_glcode',$fk_delivery);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit();
        $row = $query->result_array();

        return $data;
    }

    /*---------------------- get delivery boy device token --------------------*/
    public function getDeliveryBoyToken($fk_delivery)
    {
        $this->db->select('int_glcode,var_name,var_device_token');
        $this->db->from('mst_delivery_boy');
        $this->db->where('int_glcode',$fk_delivery);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit();
        $row = $query->row_array();

        return $row;
    }
    
    /*---------------------- get order list --------------------*/
    public function getOrders($vendorId,$flag)
    {
        $this->db->select('mo.int_glcode as fk_order,mo.order_id,mo.fk_user,mo.fk_product_arr,mo.var_payment_mode,mo.chr_status,mo.dt_createddate,mu.var_name,mu.var_username,mu.var_email,mu.  var_mobile_no,mu.txt_address,md.var_name as deliveryboy_name,md.var_mobile_no as deliveryboy_number,md.var_email as deliveryboy_email');
        $this->db->from('mst_orders mo');
        $this->db->join('trn_assign_order to', 'to.fk_order = mo.int_glcode', 'left');
        $this->db->join('mst_delivery_boy md', 'md.int_glcode = to.fk_delivery', 'left');
        $this->db->join('mst_users mu', 'mo.fk_user = mu.int_glcode', 'left');
        $this->db->join('trn_order_status ts', 'mo.int_glcode = ts.fk_order', 'left');
        $this->db->where('ts.fk_vendor',$vendorId);
        $this->db->where('ts.chr_status',$flag);
        $this->db->order_by('mo.int_glcode','desc');
        $query = $this->db->get();
        //echo $this->db->last_query(); exit();
        $row = $query->result_array();

        $data = array();
        foreach ($row as $key => $value) {
            $value['fk_product_arr'] = json_decode($value['fk_product_arr']);

            if ($value['deliveryboy_name'] != null) {
                $value['deliveryboy_name'] = $value['deliveryboy_name'];
            } else {
                $value['deliveryboy_name'] = '';
            }

            if ($value['deliveryboy_number'] != null) {
                $value['deliveryboy_number'] = $value['deliveryboy_number'];
            } else {
                $value['deliveryboy_number'] = '';
            }

            if ($value['deliveryboy_email'] != null) {
                $value['deliveryboy_email'] = $value['deliveryboy_email'];
            } else {
                $value['deliveryboy_email'] = '';
            }

            $value['txt_reason'] = '';

            $data[] = $value;

        }

        return $data;
    }

    /*---------------------- delivery boy block unbloack --------------------*/
    public function updateStatus($order_id,$chr_status)
    {
        $data = array(
            'chr_status' => $chr_status
        );

        $this->db->where('int_glcode', $order_id);
        $this->db->update('mst_orders', $data);

            $data = array(
                'fk_vendor' => $this->input->post('var_vendor_id'),
                'fk_order' => $this->input->post('fk_order'),
                'chr_status' => $chr_status,
                'txt_reason' => $this->input->post('rejection_reason'),
                'dt_createddate' => date('Y-m-d H:i:s')
            );

            $id = $this->common_model->insertRow($data, "trn_order_status");

        return TRUE;
    }

    /*---------------------- assign order to delivery boy --------------------*/
    public function assign_order($vendorId)
    {
        $data = array(
            'fk_vendor' => $vendorId,
            'fk_delivery' => $this->input->post('fk_delivery'),
            'fk_order' => $this->input->post('fk_order'),
            'chr_status' => 'A',
            'dt_createddate' => date('Y-m-d H:i:s')
        );

        //$id = $this->common_model->insertRow($data, "trn_assign_order");

        $this->common_model->updateRow('trn_assign_order', $data, array("fk_vendor" => $vendorId,"fk_order" => $this->input->post('fk_order')));

        $data = $this->getDeliveryBoyToken($this->input->post('fk_delivery'));
        $this->common_model->assign_order_notification($data['var_name'],$data['var_device_token']);

        $this->load->model('sendnotification_model');

        $user = $this->getUserDetail($this->input->post('fk_order'));
        
        if (SMS_SERVICE == 'Y') {

            $this->sendnotification_model->assign_notification_user($user['var_name'],$user['var_device_token'],$data['var_name']);

            $this->mail_model->assign_order_user($user['var_email'],$user['var_name'],$data['var_name']);

            $this->sendnotification_model->assigned_user_sms($user['var_name'],$data['var_name'],$user['var_mobile_no']);
        }

        $data1 = array(
            'chr_status' => 'W'
        );

        $this->db->where('int_glcode', $this->input->post('fk_order'));
        $this->db->update('mst_orders', $data1);

        return 'true';
    }

    public function getUserDetail($fk_order)
    {
        $this->db->select('mo.int_glcode,mu.var_name,mu.var_email,mu.var_mobile_no,mu.var_device_token');
        $this->db->from('mst_orders mo');
        $this->db->join('mst_users mu','mu.int_glcode = mo.fk_user', 'left');
        $this->db->where('mo.int_glcode',$fk_order);
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }


    /*----------------------- get vendor reasons ---------------------------*/
    public function getVendorReasons($vendorId,$orderId)
    {
        $this->db->select('txt_reason');
        $this->db->from('trn_order_status');
        $this->db->where('fk_vendor',$vendorId);
        $this->db->where('fk_order',$orderId);
        $this->db->where('chr_status','R');
        $query = $this->db->get();
        //echo $this->db->last_query(); exit();
        $row = $query->row_array();

        return $row['txt_reason'];
    }

    /*---------------------- get order list history --------------------*/
    public function getOrderHistory($vendor_id,$flag)
    {
        $this->db->select('mo.int_glcode as fk_order,mo.order_id,mo.fk_user,mo.fk_product_arr,mo.var_payment_mode,mo.chr_status,mo.dt_timeslot,mo.dt_delivery_date,mo.dt_createddate,mu.var_name,mu.var_username,mu.var_email,mu.var_mobile_no,mo.var_user_address as txt_address,mo.chr_delivery_status,mo.dt_delivery_date,mo.var_alternate_mobile,mo.var_address_type,mo.var_delivery_charge,mo.var_wallet_amount,mo.var_discount_amount,mo.var_total_amount,mo.var_payable_amount,mo.   canceled_by,md.var_name as deliveryboy_name,md.var_mobile_no as deliveryboy_number,md.var_email as deliveryboy_email');
        $this->db->from('trn_assign_order to');
        $this->db->join('mst_orders mo','mo.int_glcode = to.fk_order', 'left');
        $this->db->join('mst_users mu', 'mu.int_glcode = mo.fk_user', 'left');
        $this->db->join('mst_delivery_boy md', 'md.int_glcode = to.fk_delivery', 'left');
        $this->db->where('to.fk_vendor',$vendor_id);
        $this->db->where('mo.chr_status',$flag);
        $this->db->order_by('fk_order','desc');
        $query = $this->db->get();
        //echo $this->db->last_query(); exit();
        $row = $query->result_array();
        //echo "<pre>"; print_r($row); exit();
        $data = array();
        foreach ($row as $key => $value) {
            $fk_product_arr = json_decode($value['fk_product_arr'], true);

            $product_arr = array();

            foreach ($fk_product_arr as $pikey => $pivalue) {
                $var_image = $this->getProductImage($pivalue['fk_product']);
                if ($pivalue['cancel_status'] == 'N') {
                    if($var_image != '')
                    {
                        $pivalue['var_image'] = base_url().'uploads/products/'.$var_image;
                    } else {
                        $pivalue['var_image'] = base_url().'public/assets/images/site_imges/no_image.png';
                    }

                    $product_arr[] = $pivalue;
                } 
                
            }

            $value['fk_product_arr'] = $product_arr;
            if ($value['deliveryboy_name'] != null) {
                $value['deliveryboy_name'] = $value['deliveryboy_name'];
            } else {
                $value['deliveryboy_name'] = '';
            }

            if ($value['deliveryboy_number'] != null) {
                $value['deliveryboy_number'] = $value['deliveryboy_number'];
            } else {
                $value['deliveryboy_number'] = '';
            }

            if ($value['deliveryboy_email'] != null) {
                $value['deliveryboy_email'] = $value['deliveryboy_email'];
            } else {
                $value['deliveryboy_email'] = '';
            }

            $txt_reason = $this->getVendorReasons($vendor_id,$value['fk_order']);
            if ($txt_reason != '') {
                $value['txt_reason'] = $txt_reason;
            } else {
                $value['txt_reason'] = '';
            }

            $data[] = $value;

        }

        return $data;
    }

    /*------------------------------ get order reports ----------------------------*/
    public function getOrderReport($vendor_id)
    {
        $this->db->select('mo.int_glcode as fk_order,mo.order_id,mo.fk_user,mo.fk_product_arr,mo.var_payment_mode,mo.chr_status,mo.dt_timeslot,mo.dt_delivery_date,mo.dt_createddate,mu.var_name,mu.var_username,mu.var_email,mu.var_mobile_no,mo.var_user_address as txt_address,mo.chr_delivery_status,mo.dt_delivery_date,mo.var_alternate_mobile,mo.var_address_type,mo.var_delivery_charge,mo.var_wallet_amount,mo.var_discount_amount,mo.var_total_amount,mo.var_payable_amount,mo.   canceled_by,,md.var_name as deliveryboy_name,md.var_mobile_no as deliveryboy_number,md.var_email as deliveryboy_email,mo.dt_timeslot,mo.dt_delivery_date');
        $this->db->from('mst_orders mo');
        $this->db->join('trn_assign_order to','to.fk_order = mo.int_glcode', 'left');
        $this->db->join('mst_users mu', 'mu.int_glcode = mo.fk_user', 'left');
        $this->db->join('mst_delivery_boy md', 'md.int_glcode = to.fk_delivery', 'left');
        $this->db->where('to.fk_vendor',$vendor_id);
        $this->db->where('mo.chr_status','C');
        $this->db->order_by('fk_order','desc');
        $query = $this->db->get();
        //echo $this->db->last_query(); exit();
        $row = $query->result_array();

        $data = array();

        foreach ($row as $key => $value) {
            $fk_product_arr = json_decode($value['fk_product_arr'],true);

            $product_arr = array();

            foreach ($fk_product_arr as $pikey => $pivalue) {
                $var_image = $this->getProductImage($pivalue['fk_product']);
                if ($pivalue['cancel_status'] == 'N') {
                    if($var_image != '')
                    {
                        $pivalue['var_image'] = base_url().'uploads/products/'.$var_image;
                    } else {
                        $pivalue['var_image'] = base_url().'public/assets/images/site_imges/no_image.png';
                    }

                    $product_arr[] = $pivalue;
                }
            }

            $value['fk_product_arr'] = $product_arr;
            
            if ($value['deliveryboy_name'] != null) {
                $value['deliveryboy_name'] = $value['deliveryboy_name'];
            } else {
                $value['deliveryboy_name'] = '';
            }

            if ($value['deliveryboy_number'] != null) {
                $value['deliveryboy_number'] = $value['deliveryboy_number'];
            } else {
                $value['deliveryboy_number'] = '';
            }

            if ($value['deliveryboy_email'] != null) {
                $value['deliveryboy_email'] = $value['deliveryboy_email'];
            } else {
                $value['deliveryboy_email'] = '';
            }

            $value['txt_reason'] = '';

            $data[] = $value;
        }

        return $data;
    }

    /*------------------------- get delivery boy current orders -----------------------*/
    public function getProductImage($fk_product)
    {
        $this->db->select('var_image');
        $this->db->from('mst_products');
        $this->db->where('int_glcode',$fk_product);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit();
        $row = $query->row_array();

        return $row['var_image'];
    }

    /*------------------------- get delivery boy current orders -----------------------*/
    public function getDCurrentOrders($fk_delivery)
    {
        $this->db->select('mo.int_glcode as fk_order,mo.order_id,mo.fk_product_arr,mo.var_payment_mode,mo.dt_createddate');
        $this->db->from('mst_orders mo');
        $this->db->join('trn_assign_order to','to.fk_order = mo.int_glcode', 'left');
        $this->db->where('to.fk_delivery',$fk_delivery);
         $this->db->where('to.chr_status','A');
        $this->db->order_by('fk_order','desc');
        $query = $this->db->get();
        //echo $this->db->last_query(); exit();
        $row = $query->result_array();

        $data = array();

        foreach ($row as $key => $value) {
            //$value['fk_product_arr'] = json_decode($value['fk_product_arr']);

            $fk_product_arr = json_decode($value['fk_product_arr'], true);

            $product_arr = array();

            foreach ($fk_product_arr as $pikey => $pivalue) {
            
                if ($pivalue['cancel_status'] == 'N') {
                    
                    $product_arr[] = $pivalue;
                } 
                
            }

            $value['fk_product_arr'] = $product_arr;

            $data[] = $value;
        }

        return $data;
    }

    /*------------------------- get delivery boy current orders -----------------------*/
    public function getDCompleteOrders($fk_delivery)
    {
        $this->db->select('mo.int_glcode as fk_order,mo.order_id,mo.fk_product_arr,mo.var_payment_mode,mo.dt_createddate');
        $this->db->from('mst_orders mo');
        $this->db->join('trn_assign_order to','to.fk_order = mo.int_glcode', 'left');
        $this->db->where('to.fk_delivery',$fk_delivery);
         $this->db->where('to.chr_status','C');
        $this->db->order_by('fk_order','desc');
        $query = $this->db->get();
        //echo $this->db->last_query(); exit();
        $row = $query->result_array();

        $data = array();

        foreach ($row as $key => $value) {
            $fk_product_arr = json_decode($value['fk_product_arr'], true);

            $product_arr = array();

            foreach ($fk_product_arr as $pikey => $pivalue) {
                
                if ($pivalue['cancel_status'] == 'N') {
                   
                    $product_arr[] = $pivalue;
                } 
                
            }

            $value['fk_product_arr'] = $product_arr;

            $data[] = $value;
        }

        return $data;
    }

    /*------------------------- get delivery boy current orders -----------------------*/
    public function getDeliveryOrders($fk_delivery)
    {
        $this->db->select('mo.*,mu.int_glcode as fk_user,mu.var_name,mu.var_username,mu.var_email,mu.var_mobile_no,mo.var_user_address as txt_address');
        $this->db->from('mst_orders mo');
        $this->db->join('trn_assign_order to','to.fk_order = mo.int_glcode', 'left');
        $this->db->join('mst_users mu', 'mu.int_glcode = mo.fk_user', 'left');
        $this->db->where('to.fk_delivery',$fk_delivery);
        $this->db->where('to.chr_status','A');
        $this->db->order_by('fk_order','desc');
        $query = $this->db->get();
        //echo $this->db->last_query(); exit();
        $row = $query->result_array();

        $data = array();

        foreach ($row as $key => $value) {

            $fk_product_arr = json_decode($value['fk_product_arr'], true);

            $product_arr = array();

            foreach ($fk_product_arr as $pikey => $pivalue) {
                
                if ($pivalue['cancel_status'] == 'N') {
                   
                    $product_arr[] = $pivalue;
                } 
                
            }

            $value['fk_product_arr'] = $product_arr;

            $data[] = $value;
        }

        return $data;
    }

    /*------------------------------- check user mobile number --------------------------- */
    public function checkMobileNo($user_id,$var_mobile)
    {
        $this->db->select('int_glcode,var_mobile_no');
        $this->db->from('mst_users');
        $this->db->where('int_glcode',$user_id);
        $this->db->where('var_mobile_no', $var_mobile);
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();

        //echo $this->db->last_query(); exit();
        $row = $query->row_array();

        return $row['var_mobile_no'];
    }

    /*------------------------------- get otp --------------------------- */
    public function get_otp($user_id,$var_otp) 
    {
        $current_date = date('d/m/Y');
        $fk_order = $this->input->post('fk_order');
        $fk_delivery = $this->input->post('fk_delivery');

        $this->db->select('int_glcode,var_name,var_email,var_mobile_no,var_otp,var_device_token');
        $this->db->from('mst_users');
        $this->db->where('int_glcode', $user_id);
        $this->db->where('var_otp', $var_otp);
        $result = $this->db->get(); 
        $row = $result->row_array();

        if ($var_otp == $row['var_otp']) {
            $data = array(
                'chr_status' => 'C'
            );

            $this->db->where('fk_delivery', $fk_delivery);
            $this->db->where('fk_order', $fk_order);
            $this->db->update('trn_assign_order', $data);

            $data1 = array(
                'chr_status' => 'C'
            );
            
            $this->db->where('int_glcode', $fk_order);
            $this->db->update('mst_orders', $data1);

            $this->db->select('int_glcode,order_id,fk_vendor,fk_product_arr,var_user_address,dt_delivery_date,var_delivery_charge,var_discount_amount,var_total_amount,var_payable_amount,var_promocode,var_cashback');
            $this->db->from('mst_orders');
            $this->db->where('int_glcode', $fk_order);
            $this->db->where('fk_user', $user_id);
            $res_ord = $this->db->get(); 
            $row_ord = $res_ord->row_array();

            $vendor_token = $this->vendorDevicetoken($fk_order);

            $arr = array(
                'fk_vendor' => $row_ord['fk_vendor'],
                'fk_order' => $fk_order,
                'var_amount' => $row_ord['var_total_amount'],
                'dt_createddate' => date('Y-m-d H:i:s')
            );
            $inser = $this->db->insert('vendor_withdraw',$arr);
            
            $this->load->model('sendnotification_model');

            if (SMS_SERVICE == 'Y') {

                $this->sendnotification_model->complete_order_notification($vendor_token['var_name'],$vendor_token['var_device_token']);

                $this->sendnotification_model->complete_order_user($row['var_name'],$row_ord['order_id'],$row['var_device_token']);

                $this->mail_model->user_order_complete($row['var_name'],$row['var_email'],$row_ord['fk_product_arr'],$row_ord['var_total_amount'],$row_ord['var_discount_amount'],$row_ord['var_delivery_charge'],$row_ord['var_payable_amount'],$row_ord['dt_delivery_date'],$row_ord['order_id'],$row_ord['var_user_address']);
            }

            if (($row_ord['var_cashback'] != '0') || ($row_ord['var_cashback'] != '0.0')) {

                $wallet_update_amount = $row_ord['var_wallet_amount'] + $row_ord['var_cashback'];
                    $wallet_data = array(
                        'fk_order' => $fk_order,
                        'fk_user' => $user_id,
                        'var_amount' => $row_ord['var_cashback'],
                        'chr_transaction_type' => 'C',
                        'var_current_balance' => $wallet_update_amount,
                        'dt_createddate' => date('Y-m-d H:i:s'),
                        'dt_modifydate' => date('Y-m-d H:i:s')
                    );

                $update = $this->db->query("update mst_users set var_wallet = var_wallet + ".$row_ord['var_cashback']."  where int_glcode='".$user_id."' ");
                    
                $this->common_model->insertRow($wallet_data, "trn_user_wallet");


                if (SMS_SERVICE == 'Y') {
                    $var_user_wallet = $this->getUserWallet($user_id);
                    
                    $this->mail_model->user_cashback($row['var_email'],$row['var_name'],$row['var_mobile_no'],$current_date,$row_ord['order_id'],$var_user_wallet,$row_ord['var_cashback']);
                }
            }

        }

        return $row;  

    }

    public function vendorDevicetoken($fk_order)
    {
        $this->db->select('mv.var_name,mv.var_device_token');
        $this->db->from('trn_assign_order to');
        $this->db->join('mst_vendors mv', 'mv.int_glcode = to.fk_vendor', 'left');
        $this->db->where('to.chr_status!=','R');
        $this->db->where('to.fk_order',$fk_order);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit();
        $row = $query->row_array();

        return $row;
    }

    public function getUserWallet($fk_user)
    {
        $this->db->select('int_glcode,var_wallet');
        $this->db->from('mst_users');
        $this->db->where('int_glcode',$fk_user);
        $query = $this->db->get();

        //echo $this->db->last_query(); exit();
        $row = $query->row_array();

        return $row['var_wallet'];
    }

}