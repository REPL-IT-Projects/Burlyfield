<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Userorder_model extends CI_Model {

    public function __construct() {

        parent::__construct();

        $this->load->database();

        $this->load->model('common_model');
        $this->load->model('mail_model');
    }

    public function user_transaction_wallet($fk_user)
    {
        $this->db->select('int_glcode,fk_order,fk_user,var_amount,var_current_balance,chr_transaction_type,dt_createddate');
        $this->db->from('trn_user_wallet');
        $this->db->where('fk_user',$fk_user);
        $this->db->order_by('int_glcode','desc');
        $query = $this->db->get();
        $row = $query->result_array();

        $data = array();

        foreach ($row as $key => $value) {
            $value['dt_createddate'] = date('d M, y H:i',strtotime($value['dt_createddate']));
            $value['current_amt'] = $value['var_current_balance'];
            
            $order_id = $this->getOrderID($value['fk_order']);
            
            if ($order_id != NULL) {
                $value['order_id'] = $this->getOrderID($value['fk_order']);
            } else {
                $value['order_id'] = '';
            }

            $data[] = $value; 
            
        }

        return $data;
    }

    /*---------------------- get user current balance ----------------------*/
    public function userCurrentBalance($fk_user)
    {
        $this->db->select('var_wallet');
        $this->db->from('mst_users');
        $this->db->where('int_glcode',$fk_user);
        $query = $this->db->get();
        $row = $query->row_array();

        return $row['var_wallet'];
    }

    /*---------------------- get order id ----------------------*/
    public function getOrderID($fk_order)
    {
        $this->db->select('int_glcode,order_id');
        $this->db->from('mst_orders');
        $this->db->where('int_glcode',$fk_order);
        $query = $this->db->get();
        $row = $query->row_array();

        return $row['order_id'];
    }

    /*---------------------- delivery boy block unbloack --------------------*/
    public function add_user_order($fk_user)
    {
        $this->db->select('int_glcode,var_name,var_email,var_mobile_no,var_alt_mobile');
        $this->db->from('mst_users');
        $this->db->where('int_glcode',$fk_user);
        $query = $this->db->get();
        $user_row = $query->row_array();

        $product_arr = $this->getUserProdctDetails($fk_user);
//print_r($product_arr);die;
        foreach($product_arr as $rer){
        $data = array(
            'fk_user' => $fk_user,
            'fk_vendor' => $rer['fk_vendor'],
            'fk_product_arr' => $rer['product_arr'],
            'var_payment_mode' => $this->input->post('var_payment_mode'),
            'dt_timeslot' => $this->input->post('dt_timeslot'),
            'chr_delivery_status' => $this->input->post('chr_delivery_status'),
            'chr_status' => 'P',
            'var_user_address' => $this->input->post('var_user_address'), 
            'dt_delivery_date' => $this->input->post('dt_delivery_date'),
            'register_contact' => $this->input->post('register_contact'),
            'var_alternate_mobile' => $this->input->post('var_alternate_mobile'),
            'var_address_type' => $this->input->post('var_address_type'),
            'var_delivery_charge' => $this->input->post('var_delivery_charge'),
            'var_wallet_amount' => $this->input->post('var_wallet_amount'),
            'var_discount_amount' => $this->input->post('var_discount_amount'),
            'var_total_amount' => $this->input->post('var_total_amount'),
            'var_payable_amount' => $this->input->post('var_payable_amount'), 
            'convience_fee' => $this->input->post('convience_fee'), 
            'gst_price' => $this->input->post('gst_price'), 
            'var_cashback' => $this->input->post('var_cashback'),
            'var_promocode' => $this->input->post('var_promocode'), 
            'var_transaction_id' => $this->input->post('var_transaction_id'), 
            'dt_createddate' => date('Y-m-d H:i:s')
        );

        $id = $this->common_model->insertRow($data, "mst_orders");

            if ($id != '') {
                $order_id = $id;
                $length = strlen($order_id);
                //print_r($length); exit();
                if ($length == '1') {
                    $order_id1 = '00000' . $order_id;
                } else if ($length == '2') {
                    $order_id1 = '0000' . $order_id;
                } else if ($length == '3') {
                    $order_id1 = '000' . $order_id;
                } else if ($length == '4') {
                    $order_id1 = '00' . $order_id;
                } else if ($length == '5') {
                    $order_id1 = '0' . $order_id;
                }   
            } 

            $gen_orderid = 'ORD'.$order_id1;

            $this->db->set('order_id', $gen_orderid); //value that used to update column  
            $this->db->where('int_glcode', $id); //which row want to upgrade  
            $this->db->update('mst_orders');

            $fetch_wallet = $this->userCurrentBalance($fk_user);
            $trn_wallet_amt = $fetch_wallet - $this->input->post('var_wallet_amount');

            if ($_POST['var_wallet_amount'] != '0') {
                $wallet_data = array(
                    'fk_order' => $id,
                    'fk_user' => $fk_user,
                    'var_amount' => $this->input->post('var_wallet_amount'),
                    'chr_transaction_type' => 'D',
                    'var_current_balance' => $trn_wallet_amt,
                    'dt_createddate' => date('Y-m-d H:i:s'),
                    'dt_modifydate' => date('Y-m-d H:i:s')
                );

                $update = $this->db->query("update mst_users set var_wallet = var_wallet - ".$this->input->post('var_wallet_amount')."  where int_glcode='".$fk_user."' ");
                
                $this->common_model->insertRow($wallet_data, "trn_user_wallet");
            }
            
            $data = $this->getUserInsertedOrder($id);
            $add_Date = $this->input->post('dt_timeslot') . ' '. date('d/m/Y',strtotime($this->input->post('dt_delivery_date')));

//            if (SMS_SERVICE == 'Y') {
//                $this->mail_model->user_order_email($user_row['var_name'],$user_row['var_email'],$product_arr,$this->input->post('var_total_amount'),$this->input->post('var_discount_amount'),$this->input->post('var_delivery_charge'),$this->input->post('var_payable_amount'),$add_Date,$gen_orderid,$this->input->post('var_user_address'));
//            
//                $this->common_model->user_order_msg($user_row['var_name'],$user_row['var_mobile_no'],'USER_ORDER',$gen_orderid,'',$this->input->post('var_payable_amount'));
//
//                if ($user_row['var_alt_mobile'] != '') {
//                    $this->common_model->user_order_msg($user_row['var_name'],$user_row['var_alt_mobile'],'USER_ORDER',$gen_orderid,'',$this->input->post('var_payable_amount'));
//                }
//            }
        }
            $this->emptyUserCart($fk_user);

        return $data;
    }

    // /*---------------------- get user current balance ----------------------*/
    // public function userCurrentBalance($fk_user)
    // {
    //     $this->db->select('var_wallet');
    //     $this->db->from('mst_users');
    //     $this->db->where('int_glcode',$fk_user);
    //     $query = $this->db->get();
    //     $row = $query->row_array();

    //     return $row['var_wallet'];
    // }

    /*-------------------------- get user product array --------------------- */
    public function getUserProdctDetails($fk_user)
    {
        $sel = $this->db->query("select fk_vendor from trn_cart_details where fk_user='".$fk_user."' group by fk_vendor ");
        $res_arr = $sel->result_array();
        
        foreach ($res_arr as $rrr){
        
            $this->db->select('fk_product,var_name,var_quantity,var_price,var_unit');
            $this->db->from('trn_cart_details');
            $this->db->where('fk_user',$fk_user);
            $this->db->where('fk_vendor',$rrr['fk_vendor']);
            $this->db->where('chr_status','A');
            $query = $this->db->get();
            $row_arr = $query->result_array();
            $data1 = array();
            foreach ($row_arr as $row){
                $row['cancel_status'] = 'N';
                $data1[] = $row;
            }
            $data['product_arr'] = json_encode($data1);
            $data['fk_vendor'] = $rrr['fk_vendor'];
            $data_arr[] = $data;
        }
        
        return $data_arr;
    }
    
    public function getSingleProdctDetails($fk_user,$fk_product,$var_quantity)
    {
        $this->db->select('fk_product,var_name,var_quantity,var_price,var_unit');
        $this->db->from('trn_cart_details');
        $this->db->where('fk_user',$fk_user);
        $this->db->where('fk_product',$fk_product);
        $this->db->where('var_quantity',$var_quantity);
        $this->db->where('chr_status','A');
        $query = $this->db->get();
        $row_arr = $query->result_array();

        $data1 = array();

        foreach ($row_arr as $row){
            $row['cancel_status'] = 'N';
            $data1[] = $row;
        }
        $data = json_encode($data1);
           
        return $data;
    }

    /*-------------------------- get user product array --------------------- */
    public function emptyUserCart($fk_user)
    {
        $this->db->where('fk_user',$fk_user);
        $this->db->delete('trn_cart_details');
           
        return true;
    }
    
    public function emptySingleCart($fk_user,$fk_product,$var_quantity)
    {
        $this->db->where('fk_user',$fk_user);
        $this->db->where('fk_product',$fk_product);
        $this->db->where('var_quantity',$var_quantity);
        $this->db->delete('trn_cart_details');
           
        return true;
    }

    /*----------------------- get vendor reasons ---------------------------*/
    public function getUserInsertedOrder($orderId)
    {
        $this->db->select('int_glcode as fk_order,order_id,fk_user,var_payment_mode,chr_status,dt_timeslot,chr_delivery_status,fk_product_arr');
        $this->db->from('mst_orders');
        $this->db->where('int_glcode',$orderId);
        $query = $this->db->get();
        $row = $query->result_array();

        $data = array();

        foreach ($row as $key => $value) {
            $value['fk_product_arr'] = json_decode($value['fk_product_arr']);
            $data = $value;
        } 

        return $data;
    }

    public function getDeliveryboyDetails($fk_order,$fk_user,$chr_flag)
    {
        $this->db->select('mo.int_glcode,md.var_name,md.var_mobile_no');
        $this->db->from('mst_orders mo');
        $this->db->join('trn_assign_order to','to.fk_order = mo.int_glcode', 'left');
        $this->db->join('mst_delivery_boy md', 'md.int_glcode = to.fk_delivery', 'left');
        $this->db->where('mo.int_glcode',$fk_order);
        $this->db->where('mo.fk_user',$fk_user);
        $query = $this->db->get();
        $row = $query->row_array();

        if ($chr_flag == 'N') {
            $details = $row['var_name'];
        } else {
            $details = $row['var_mobile_no'];
        }

        if ($details != '') {
            $set_details = $details;
        } else {
            $set_details = '';
        }

        return $set_details;
    }

    /*---------------------- get order list history --------------------*/
    public function get_user_order($fk_user)
    {
        $this->db->select('*');
        $this->db->from('mst_orders');
        $this->db->where('fk_user',$fk_user);
        $this->db->order_by('int_glcode','DESC');
        $query = $this->db->get();
        $row = $query->result_array();

        $data = array();

        foreach ($row as $key => $value) {
            $fk_product_arr = json_decode($value['fk_product_arr'], true);
            $value['dt_createddate'] = date('d/m/Y h:i:s A',strtotime($value['dt_createddate']));
                $product_arr = array();

            foreach ($fk_product_arr as $pikey => $pivalue) {
                $var_image = $this->getProductImage($pivalue['fk_product']);

                if($var_image != '')
                {
                    $pivalue['var_image'] = base_url().'uploads/products/'.$var_image;
                } else {
                    $pivalue['var_image'] = base_url().'public/assets/images/site_imges/no_image.png';
                }

                $product_arr[] = $pivalue;
            }
                $value['fk_product_arr'] = $product_arr;

                $value['deliveryboy_name'] = $this->getDeliveryboyDetails($value['int_glcode'],$value['fk_user'],'N');

                $value['deliveryboy_number'] = $this->getDeliveryboyDetails($value['int_glcode'],$value['fk_user'],'C');
               
            $data[] = $value;
        } 

        return $data;
    }

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
    
    /*------------------------------ get order reports ----------------------------*/
    public function getOrderReport($vendor_id)
    {
        $this->db->select('mo.int_glcode as fk_order,mo.order_id,mo.fk_user,mo.fk_product_arr,mo.var_payment_mode,mo.chr_status,mo.dt_createddate,mu.var_name,mu.var_username,mu.var_email,mu.  var_mobile_no,mu.txt_address,md.var_name as deliveryboy_name,md.var_mobile_no as deliveryboy_number,md.var_email as deliveryboy_email');
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
            $value['fk_product_arr'] = json_decode($value['fk_product_arr']);

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
            $value['fk_product_arr'] = json_decode($value['fk_product_arr']);

            $data[] = $value;
        }

        return $data;
    }

    /*------------------------- get delivery boy current orders -----------------------*/
    public function getDeliveryOrders($fk_delivery)
    {
        $this->db->select('mo.int_glcode as fk_order,mo.order_id,mo.fk_product_arr,mo.var_payment_mode,mo.dt_createddate,mu.int_glcode as fk_user,mu.var_name,mu.var_username,mu.var_email,mu.var_mobile_no,mu.txt_address');
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
            $value['fk_product_arr'] = json_decode($value['fk_product_arr']);

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
        $fk_order = $this->input->post('fk_order');
        $fk_delivery = $this->input->post('fk_delivery');

        $this->db->select('int_glcode,var_otp');
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

        }

        return $row;  

    }

    public function single_user_order($fk_user,$fk_product,$var_quantity)
    {
        $this->db->select('int_glcode,var_name,var_email,var_mobile_no,var_alt_mobile');
        $this->db->from('mst_users');
        $this->db->where('int_glcode',$fk_user);
        $query = $this->db->get();
        $user_row = $query->row_array();

        $product_arr = $this->getSingleProdctDetails($fk_user,$fk_product,$var_quantity);

        $data = array(
            'fk_user' => $fk_user,
            'fk_product_arr' => $product_arr,
            'var_payment_mode' => $this->input->post('var_payment_mode'),
            'chr_status' => $this->input->post('chr_status'),
            'dt_timeslot' => $this->input->post('dt_timeslot'),
            'chr_delivery_status' => $this->input->post('chr_delivery_status'),
            'chr_status' => 'P',
            'var_user_address' => $this->input->post('var_user_address'), 
            'dt_delivery_date' => $this->input->post('dt_delivery_date'),
            'register_contact' => $this->input->post('register_contact'),
            'var_alternate_mobile' => $this->input->post('var_alternate_mobile'),
            'var_address_type' => $this->input->post('var_address_type'),
            'var_delivery_charge' => $this->input->post('var_delivery_charge'),
            'var_wallet_amount' => $this->input->post('var_wallet_amount'),
            'var_discount_amount' => $this->input->post('var_discount_amount'),
            'var_total_amount' => $this->input->post('var_total_amount'),
            'var_payable_amount' => $this->input->post('var_payable_amount'),
            'convience_fee' => $this->input->post('convience_fee'), 
            'gst_price' => $this->input->post('gst_price'), 
            'var_cashback' => $this->input->post('var_cashback'), 
            'var_promocode' => $this->input->post('var_promocode'), 
            'var_transaction_id' => $this->input->post('var_transaction_id'), 
            'dt_createddate' => date('Y-m-d H:i:s')
        );

        $id = $this->common_model->insertRow($data, "mst_orders");

            if ($id != '') {
                $order_id = $id;
                $length = strlen($order_id);
                //print_r($length); exit();
                if ($length == '1') {
                    $order_id1 = '00000' . $order_id;
                } else if ($length == '2') {
                    $order_id1 = '0000' . $order_id;
                } else if ($length == '3') {
                    $order_id1 = '000' . $order_id;
                } else if ($length == '4') {
                    $order_id1 = '00' . $order_id;
                } else if ($length == '5') {
                    $order_id1 = '0' . $order_id;
                }   
            } 

            $gen_orderid = 'ORD'.$order_id1;

            $this->db->set('order_id', $gen_orderid); //value that used to update column  
            $this->db->where('int_glcode', $id); //which row want to upgrade  
            $this->db->update('mst_orders');

            $wallet_data = array(
                'fk_user' => $fk_user,
                'var_amount' => $this->input->post('var_wallet_amount'),
                'dt_createddate' => date('Y-m-d H:i:s'),
                'dt_modifydate' => date('Y-m-d H:i:s')
            );

            $update = $this->db->query("update mst_users set var_wallet = var_wallet - ".$this->input->post('var_wallet_amount')."  where int_glcode='".$fk_user."' ");
            
            $this->common_model->insertRow($wallet_data, "trn_user_wallet");

            $data_user = $this->getUserInsertedOrder($id);
            $add_Date = $this->input->post('dt_timeslot') . ' '. date('d/m/Y',strtotime($this->input->post('dt_delivery_date')));

            if (SMS_SERVICE == 'Y') {
                $this->mail_model->user_order_email($user_row['var_name'],$user_row['var_email'],$product_arr,$this->input->post('var_total_amount'),$this->input->post('var_discount_amount'),$this->input->post('var_delivery_charge'),$this->input->post('var_payable_amount'),$add_Date,$gen_orderid,$this->input->post('var_user_address'));
                
                $this->common_model->user_order_msg($user_row['var_name'],$user_row['var_mobile_no'],'USER_ORDER',$gen_orderid,'',$this->input->post('var_payable_amount'));

                if ($user_row['var_alt_mobile'] != '') {
                    $this->common_model->user_order_msg($user_row['var_name'],$user_row['var_alt_mobile'],'USER_ORDER',$gen_orderid,'',$this->input->post('var_payable_amount'));
                }
            }

            $this->emptySingleCart($fk_user,$fk_product,$var_quantity);

        return $data_user;
    }
    
    /*------------------------ user cancel order -----------------------------*/
    public function cancel_order($order_id)
    {
        $select = "select int_glcode,order_id,fk_user,fk_product_arr,var_total_amount,var_payment_mode,var_wallet_amount,var_payable_amount,var_delivery_charge,var_discount_amount,dt_delivery_date,dt_timeslot from mst_orders where int_glcode = '".$order_id."'";
        $result = $this->db->query($select);
        $data = $result->row_array();

        $this->db->where('int_glcode', $order_id);
        $query = $this->db->update('mst_orders', array('chr_status'=>'R','canceled_by'=>'U'));

        if ($data['var_payment_mode'] == 'By Online') {
           $amount = $data['var_payable_amount'];
        } else {
            $amount = $data['var_wallet_amount'];
        }

        // $wallet_data = array(
        //     'fk_order' => $order_id,
        //     'fk_user' => $data['fk_user'],
        //     'var_amount' => $amount,
        //     'chr_transaction_type' => 'C',
        //     'dt_createddate' => date('Y-m-d H:i:s'),
        //     'dt_modifydate' => date('Y-m-d H:i:s')
        // );

        // $this->common_model->insertRow($wallet_data, "trn_user_wallet");

        // $update = $this->db->query("update mst_users set var_wallet = var_wallet + ".$amount."  where int_glcode='".$data['fk_user']."' ");


        $fetch_wallet = $this->userCurrentBalance($data['fk_user']);
        $trn_wallet_amt = $fetch_wallet + $amount;
        if (($amount != '0') || ($amount != '0.0')) {
            $wallet_data = array(
                'fk_order' => $order_id,
                'fk_user' => $data['fk_user'],
                'var_amount' => $amount,
                'chr_transaction_type' => 'C',
                'var_current_balance' => $trn_wallet_amt,
                'dt_createddate' => date('Y-m-d H:i:s'),
                'dt_modifydate' => date('Y-m-d H:i:s')
            );

            $this->common_model->insertRow($wallet_data, "trn_user_wallet");

        }

        $update = $this->db->query("update mst_users set var_wallet = var_wallet + ".$amount."  where int_glcode='".$data['fk_user']."' ");

        /*------------------------ get user details -----------------------------*/
        $sel_user = "select var_name,var_email,var_mobile_no,var_alt_mobile from mst_users where int_glcode = '".$data['fk_user']."'";
        $res_user = $this->db->query($sel_user);
        $data_user = $res_user->row_array();

        $add_date = $data['dt_timeslot'].' '.date('d/m/Y',strtotime($data['dt_delivery_date']));

        if (SMS_SERVICE == 'Y') {
            $this->mail_model->user_order_cancel($data_user['var_name'],$data_user['var_email'],$data['fk_product_arr'],$data['var_total_amount'],$data['var_discount_amount'],$data['var_delivery_charge'],$data['var_payable_amount'],$add_date,$data['order_id']);
            $this->common_model->user_order_msg($data_user['var_name'],$data_user['var_mobile_no'],'cancel_order',$order_id,'You',$data['var_payable_amount']);

            if ($data_user['var_alt_mobile'] != '') {
                $this->common_model->user_order_msg($data_user['var_name'],$data_user['var_alt_mobile'],'cancel_order',$order_id,'You',$data['var_payable_amount']);
            }
        }

        return true;
    }
    
    public function getDeliveryCharges($flag)
    {
        $this->db->select('var_charges,var_below');
        $this->db->from('mst_delivery_charges');
        $this->db->where('chr_type', $flag);
        
        $query = $this->db->get();
        $result = $query->row_array();

        return $result;

    }

    public function getVendorDetails($orderId)
    {
        $this->db->select('mv.var_name,mv.var_mobile_no,mv.var_device_token,mo.order_id');
        $this->db->from('trn_assign_order to');
        $this->db->join('mst_vendors mv','mv.int_glcode = to.fk_vendor','left');
        $this->db->join('mst_orders mo','mo.int_glcode = to.fk_order','left');
        $this->db->where('to.fk_order', $orderId);
        $this->db->where('to.chr_status!=', 'R');
        $query = $this->db->get();
        $result = $query->row_array();

        return $result;

    }

    public function getUserDetails($orderId)
    {
        $this->db->select('mu.var_name,mu.var_email,mo.order_id,mo.var_user_address,mo.dt_delivery_date,mo.var_payable_amount');
        $this->db->from('mst_orders mo');
        $this->db->join('mst_users mu','mu.int_glcode = mo.fk_user','left');
        $this->db->where('mo.int_glcode', $orderId);
        $query = $this->db->get();
        $result = $query->row_array();

        return $result;
    }

    public function update_order($order_id,$product_arr,$tot_amount,$discount_price,$delivery_charge){
        
        $arr = array(
            'fk_product_arr' => $product_arr,
            'var_delivery_charge' => $delivery_charge,
            'var_discount_amount' => $discount_price,
            'var_total_amount' => $tot_amount
        );
        
        $this->db->where('int_glcode',$order_id);
        $update = $this->db->update('mst_orders',$arr);

        $vendor = $this->getVendorDetails($order_id);

        $user = $this->getUserDetails($order_id);
        $added_date = date('d/m/Y',strtotime($user['dt_delivery_date']));

        if (SMS_SERVICE == 'Y') {
            $this->load->model('sendnotification_model');

            if (!empty($vendor)) {

                $this->sendnotification_model->update_order_venor($vendor['var_name'],$vendor['order_id'],$vendor['var_device_token']);

                $this->sendnotification_model->update_user_sms($vendor['var_name'],$vendor['order_id'],$vendor['var_mobile_no']);
            }

            $this->mail_model->user_update_order($user['var_name'],$user['var_email'],$product_arr,$tot_amount,$discount_price,$delivery_charge,$user['var_payable_amount'],$added_date,$user['order_id'],$user['var_user_address']);

        }
        
        return true;
    }
    
    public function getTotalCartDetails($product_arr,$delivery_type,$order_id,$fk_user)
    {
        $product_arr = json_decode($product_arr);
        //echo '<pre>'; print_r($product_arr); exit();
        $data1 = array();
        $data2 = array();
        foreach ($product_arr as $rowa){ 

            if($rowa->cancel_status != 'Y'){
               
                $this->db->select('mp.*');
                $this->db->from('mst_products mp');
                $this->db->where('mp.int_glcode', $rowa->fk_product);
                $query = $this->db->get();
                $value = $query->row_array();

                //foreach ($result as $key => $value) {
                    if($value['var_image'] != '')
                    {
                        $value['var_image'] = base_url().'uploads/products/'.$value['var_image'];
                    } else {
                        $value['var_image'] = base_url().'public/assets/images/site_imges/no_image.png';
                    }

                    $total_price = $rowa->var_price;
                    $price = ($value['var_offer'] / 100) * $total_price;
                    $discount_price = $total_price - $price;

                    $value['var_discount_price'] = number_format($discount_price,2);

                    $value['tot_price'] = number_format($rowa->var_price * $rowa->var_unit,2);

                    $value['discount_price'] = number_format($price * $rowa->var_unit,2);

                    $value['payable_price'] = number_format($rowa->var_price * $rowa->var_unit,2);

                    $data1[] = $value;

            }else{
            
                $this->db->select('mp.*');
                $this->db->from('mst_products mp');
                $this->db->where('mp.int_glcode', $rowa->fk_product);
                $query = $this->db->get();
                $value = $query->row_array();

                //foreach ($result as $key => $value) {
                    if($value['var_image'] != '')
                    {
                        $value['var_image'] = base_url().'uploads/products/'.$value['var_image'];
                    } else {
                        $value['var_image'] = base_url().'public/assets/images/site_imges/no_image.png';
                    }

                    $total_price = $rowa->var_price;
                    $price = ($value['var_offer'] / 100) * $total_price;
                    $discount_price = $total_price - $price;

                    $value['var_discount_price'] = number_format($discount_price,2);

                    $value['tot_price'] = number_format($rowa->var_price * $rowa->var_unit,2,'.','');

                    $value['discount_price'] = number_format($price * $rowa->var_unit,2);

                    $value['payable_price'] = number_format($rowa->var_price * $rowa->var_unit,2,'.','');

                    $data2[] = $value;
            }
        }

                $super_del_amt = $this->getDeliveryCharges($delivery_type);
                $ultra_del_amt = $this->getDeliveryCharges($delivery_type);

                if(count($data1) > 0){
                $tot_amount1 = array_sum(array_column($data1, 'tot_price')); 

                if (($delivery_type == 'S') && ($tot_amount1 < $super_del_amt['var_below'])) {
                    $delivery_charge1 = $super_del_amt['var_charges'];
                } elseif (($delivery_type == 'U') && ($tot_amount1 < $ultra_del_amt['var_below'])) {
                    $delivery_charge1 = $ultra_del_amt['var_charges'];
                } else {
                    $delivery_charge1 = 0;
                }

                $discount_price1 = array_sum(array_column($data1, 'discount_price')); 

                }else{
                    $tot_amount1=0;
                    $delivery_charge1=0;
                    $discount_price1=0;
                }
                
                if(count($data2) > 0){
                $tot_amount2 = array_sum(array_column($data2, 'tot_price')); 

                if (($delivery_type == 'S') && ($tot_amount2 < $super_del_amt['var_below'])) {
                    $delivery_charge2 = $super_del_amt['var_charges'];
                } elseif (($delivery_type == 'U') && ($tot_amount2 < $ultra_del_amt['var_below'])) {
                    $delivery_charge2 = $ultra_del_amt['var_charges'];
                } else {
                    $delivery_charge2 = 0;
                }

                $discount_price2 = array_sum(array_column($data2, 'discount_price')); 

                }else{
                    $tot_amount2=0;
                    $delivery_charge2=0;
                    $discount_price2=0;
                }
                
                $prices1 = ($tot_amount1 + $delivery_charge1) - $discount_price1;               
                $prices2 = ($tot_amount2 + $delivery_charge2) - $discount_price2;

                $this->db->select('var_payment_mode,var_payable_amount,var_promocode');
                $this->db->from('mst_orders');
                $this->db->where('int_glcode', $order_id);
                $get_query = $this->db->get();
                $get_value = $get_query->row_array();
               
                // $update1 = $this->db->query("update mst_orders set var_payable_amount = '".$prices1."' where int_glcode = '".$order_id."' ");

                $promoArr = $this->getPromocode($get_value['var_promocode']);
                if ($get_value['var_promocode'] != '') {
                    if ($promoArr['chr_type'] == 'A') {
                    $cashback = $promoArr['var_amount'];
                    } elseif ($promoArr['chr_type'] == 'P') {
                        $percantage = ($promoArr['var_amount'] / 100) * $tot_amount1;
                        $cashback = $percantage;
                    } else {
                        $cashback = '0';
                    }
                } else {
                    $cashback = '0';
                }

                $orddata = array(
                    'var_payable_amount' => $prices1,
                    'var_cashback' => $cashback
                );

                $this->db->where('int_glcode', $order_id);
                $this->db->update('mst_orders', $orddata);

                if ($prices2 > $get_value['var_payable_amount']) {
                    $new_price = $prices2 - $get_value['var_payable_amount'];
                } else {
                    $new_price = $prices2;
                }

                if ($get_value['var_payment_mode'] == 'By Online') {

                    $fetch_wallet = $this->userCurrentBalance($fk_user);
                    $trn_wallet_amt = $fetch_wallet + $tot_amount2;

                    if ($trn_wallet_amt != '') {
                        $trn_wallet_amt = $trn_wallet_amt;
                    } else {
                        $trn_wallet_amt = '0';
                    }

                    $wallet_data = array(
                        'fk_order' => $order_id,
                        'fk_user' => $fk_user,
                        'var_amount' => $tot_amount2,
                        'chr_transaction_type' => 'C',
                        'var_current_balance' => $trn_wallet_amt,
                        'dt_createddate' => date('Y-m-d H:i:s'),
                        'dt_modifydate' => date('Y-m-d H:i:s')
                    );
                    
                    $this->common_model->insertRow($wallet_data, "trn_user_wallet");

                    $update2 = $this->db->query("update mst_users set var_wallet = var_wallet + $tot_amount2 where int_glcode = '".$fk_user."' ");

                } 

                if(($get_value['var_payment_mode'] == 'By Cash') && ($prices2 > $get_value['var_payable_amount'])) {
                    $cash_new_price = $prices2 - $get_value['var_payable_amount'];
                    $update3 = $this->db->query("update mst_users set var_wallet = var_wallet + $cash_new_price where int_glcode = '".$fk_user."' ");

                    $wallet_data = array(
                        'fk_order' => $order_id,
                        'fk_user' => $fk_user,
                        'var_amount' => $cash_new_price,
                        'chr_transaction_type' => 'C',
                        'dt_createddate' => date('Y-m-d H:i:s'),
                        'dt_modifydate' => date('Y-m-d H:i:s')
                    );

                    $this->common_model->insertRow($wallet_data, "trn_user_wallet");

                    $update_cash = $this->db->query("update mst_orders set var_payable_amount = '0' where int_glcode = '".$order_id."' ");
                }

               //echo "<pre>"; print_r($data1); exit();

        return $data1;  
    }

    /*---------------------- get user current balance ----------------------*/
    public function getPromocode($var_promocode)
    {
        $this->db->select('var_promocode,var_amount,chr_type');
        $this->db->from('mst_promocode');
        $this->db->where('var_promocode',$var_promocode);
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }

    
}