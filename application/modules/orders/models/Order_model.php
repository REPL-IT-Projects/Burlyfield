<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_Model extends CI_Model {
   
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('mail_model'); 
        $this->load->model('common_model');        
    }

    public function getUserOrders($fk_user){
        
        $this->db->select('int_glcode,order_id,fk_user,var_payment_mode,chr_status,dt_delivery_date,var_payable_amount');
        $this->db->where('fk_user',$fk_user);
        $this->db->order_by('int_glcode','desc');
        $res = $this->db->get('mst_orders');
        $result = $res->result_array(); 
        return $result;
    }

    public function getOrderDetails($orderId){
        
        $this->db->select('*');
        $this->db->where('int_glcode',$orderId);
        $res = $this->db->get('mst_orders');
        $result = $res->result_array(); 

        $data = array();
        foreach ($result as $key => $value) {
            $fk_product_arr = json_decode($value['fk_product_arr'], true);

            $product_arr = array();

            foreach ($fk_product_arr as $pikey => $pivalue) {

                if ($pivalue['cancel_status'] == 'N') {
                    $var_image = $this->getProductImage($pivalue['fk_product']);

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
            $data[] = $value;

        }
        //echo "<pre>"; print_r($data); exit();
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

    public function get_user_details($uid){
        
        $this->db->select('int_glcode,var_name,var_mobile_no,var_alt_mobile,var_default_no,var_wallet');
        $this->db->where('int_glcode',$uid);
        $this->db->where('chr_delete','N');
        $this->db->where('chr_publish','Y');
        $res = $this->db->get('mst_users');
        $result = $res->row_array(); 
        return $result;
    }
    
    /*------------------------ user cancel order -----------------------------*/
    public function cancel_user_order($order_id)
    {
        $select = "select int_glcode,order_id,fk_user,fk_product_arr,var_payment_mode,var_wallet_amount,var_payable_amount,var_delivery_charge,var_total_amount,var_discount_amount,dt_delivery_date,dt_timeslot from mst_orders where int_glcode = '".$order_id."'";
        $result = $this->db->query($select);
        $data = $result->row_array();

        $pro = json_decode($data['fk_product_arr']);

        foreach ($pro as $stockvalue) {
            $this->db->select('var_stock');
            $this->db->from('mst_products');
            $this->db->where('int_glcode',$stockvalue->fk_product);
            $qry = $this->db->get();
            $rw = $qry->row_array();
           $quty = $rw['var_stock'] + $stockvalue->var_unit;
            $stock_data = array("var_stock" => $quty);
            $this->common_model->updateRow('mst_products', $stock_data, array("int_glcode" => $stockvalue->fk_product));
        }
        // echo "<pre>";print_r($pro);die();



        $this->db->where('int_glcode', $order_id);
        $query = $this->db->update('mst_orders', array('chr_status'=>'R','canceled_by'=>'U'));

        if ($data['var_payment_mode'] == 'By Online') {
           $amount = $data['var_payable_amount'];
        } else {
            $amount = $data['var_wallet_amount'];
        }

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

            $update = $this->db->query("update mst_users set var_wallet = var_wallet + ".$amount."  where int_glcode='".$data['fk_user']."' ");

        }
        
        /*------------------------ get user details -----------------------------*/
        $sel_user = "select var_name,var_email,var_mobile_no,var_alt_mobile,var_wallet from mst_users where int_glcode = '".$data['fk_user']."'";
        $res_user = $this->db->query($sel_user);
        $data_user = $res_user->row_array();

        $add_date = $data['dt_timeslot'].' '.date('d/m/Y',strtotime($data['dt_delivery_date']));

        if (SMS_SERVICE == 'Y') {
          $this->mail_model->user_order_cancel($data_user['var_name'],$data_user['var_email'],$data['fk_product_arr'],$data['var_total_amount'],$data['var_discount_amount'],$data['var_delivery_charge'],$data['var_payable_amount'],$add_date,$data['order_id']);
            $this->common_model->user_order_msg($data_user['var_name'],$data_user['var_mobile_no'],'cancel_order',$data['order_id'],'You',$data['var_payable_amount']);

            if ($data_user['var_alt_mobile'] != '') {

                $this->common_model->user_order_msg($data_user['var_name'],$data_user['var_alt_mobile'],'cancel_order',$data['order_id'],'You',$data['var_payable_amount']);

            } 
            
            if (($amount != '0') || ($amount != '0.0')) {
                if ($data_user['var_wallet'] != '0') {
                    $this->mail_model->user_transaction_wallet($data_user['var_email'],$data_user['var_name'],$data_user['var_mobile_no'],$add_date,$data['order_id'],$amount,$data_user['var_wallet'],'C');
                    
                    if ($data_user['var_alt_mobile'] != '') {
                        $this->common_model->user_transactions($data_user['var_name'],$data_user['var_alt_mobile'],$amount,$data_user['var_wallet'],'C');
                    }
                }
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

        //echo "<pre>"; print_r($result); exit();
        return $result;
    }

    public function update_order($order_id,$product_arr,$tot_amount,$discount_price,$delivery_charge){
        $product_arr = json_encode($product_arr);
        
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

            $this->sendnotification_model->update_order_venor($vendor['var_name'],$vendor['order_id'],$vendor['var_device_token']);

            $this->sendnotification_model->update_user_sms($vendor['var_name'],$vendor['order_id'],$vendor['var_mobile_no']);

            $this->mail_model->user_update_order($user['var_name'],$user['var_email'],$product_arr,$tot_amount,$discount_price,$delivery_charge,$user['var_payable_amount'],$added_date,$user['order_id'],$user['var_user_address']);

        }
        
        return true;
    }

    public function getTotalCartDetails($product_arr,$delivery_type,$order_id,$fk_user)
    {
        //echo '<pre>'; print_r($product_arr); exit();
        $data1 = array();
        $data2 = array();
        foreach ($product_arr as $rowa){ 

            if($rowa['cancel_status'] != 'Y'){
               
                $this->db->select('mp.*');
                $this->db->from('mst_products mp');
                $this->db->where('mp.int_glcode', $rowa['fk_product']);
                $query = $this->db->get();
                $value = $query->row_array();

                	//foreach ($result as $key => $value) {
                    if($value['var_image'] != '')
                    {
                        $value['var_image'] = base_url().'uploads/products/'.$value['var_image'];
                    } else {
                        $value['var_image'] = base_url().'public/assets/images/site_imges/no_image.png';
                    }

                    $total_price = $rowa['var_price'];
                    $price = ($value['var_offer'] / 100) * $total_price;
                    $discount_price = $total_price - $price;

                    $value['var_discount_price'] = number_format($discount_price,2);

                    $value['tot_price'] = number_format($rowa['var_price'] * $rowa['var_unit'],2,'.','');

                    $value['discount_price'] = number_format($price * $rowa['var_unit'],2);

                    $value['payable_price'] = number_format($rowa['var_price'] * $rowa['var_unit'],2,'.','');

                    $data1[] = $value;

                   // echo "<pre>"; print_r($data1); exit();
            } else {
            
                $this->db->select('mp.*');
                $this->db->from('mst_products mp');
                $this->db->where('mp.int_glcode', $rowa['fk_product']);
                $query = $this->db->get();
                $value = $query->row_array();

                //foreach ($result as $key => $value) {
                    if($value['var_image'] != '')
                    {
                        $value['var_image'] = base_url().'uploads/products/'.$value['var_image'];
                    } else {
                        $value['var_image'] = base_url().'public/assets/images/site_imges/no_image.png';
                    }

                    $total_price = $rowa['var_price'];
                    $price = ($value['var_offer'] / 100) * $total_price;
                    $discount_price = $total_price - $price;

                    $value['var_discount_price'] = number_format($discount_price,2);

                    $value['tot_price'] = number_format($rowa['var_price'] * $rowa['var_unit'],2,'.','');

                    $value['discount_price'] = number_format($price * $rowa['var_unit'],2);

                    $value['payable_price'] = number_format($rowa['var_price'] * $rowa['var_unit'],2,'.','');

                    $data2[] = $value;
            }
        }
        //echo "<pre>"; print_r($data2); exit();

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
                //echo $tot_amount1; exit();
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

                //echo $tot_amount1.'###'.$$tot_amount2; exit();

                //echo $prices1.'##'.$prices2; exit();

                $this->db->select('var_payment_mode,var_payable_amount,var_promocode');
                $this->db->from('mst_orders');
                $this->db->where('int_glcode', $order_id);
                $get_query = $this->db->get();
                $get_value = $get_query->row_array();

                $promoArr = $this->getPromocode($get_value['var_promocode']);
                if ($get_value['var_promocode'] != '') {
                    if ($promoArr['chr_type'] == 'A') {
                    $cashback = $promoArr['var_amount'];
                    } elseif ($promoArr['chr_type'] == 'P') {
                        $percantage = ($promoArr['var_amount'] / 100) * $prices1;
                        $cashback = $percantage;
                    } else {
                        $cashback = '0';
                    }
                } else {
                    $cashback = '0';
                }
                
                //echo $cashback; exit();

                $orddata = array(
                    'var_payable_amount' => $prices1,
                    'var_cashback' => $cashback
                );

                $this->db->where('int_glcode', $order_id);
                $this->db->update('mst_orders', $orddata);
               
                // $update1 = $this->db->query("update mst_orders set var_payable_amount = '".$prices1."' where int_glcode = '".$order_id."' ");

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

                    $fetch_wallet_cash = $this->userCurrentBalance($fk_user);
                    $trn_wallet_amt_cash = $fetch_wallet_cash + $cash_new_price;

                    $wallet_data = array(
                        'fk_order' => $order_id,
                        'fk_user' => $fk_user,
                        'var_amount' => $cash_new_price,
                        'chr_transaction_type' => 'C',
                        'var_current_balance' => $trn_wallet_amt_cash,
                        'dt_createddate' => date('Y-m-d H:i:s'),
                        'dt_modifydate' => date('Y-m-d H:i:s')
                    );

                    $this->common_model->insertRow($wallet_data, "trn_user_wallet");

                    $update_cash = $this->db->query("update mst_orders set var_payable_amount = '0' where int_glcode = '".$order_id."' ");
                }

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

    public function getUserTransaction($fk_user)
    {
        $this->db->select('int_glcode,fk_order,fk_user,var_amount,chr_transaction_type,var_current_balance,dt_modifydate');
        $this->db->from('trn_user_wallet');
        $this->db->where('fk_user',$fk_user);
        $this->db->order_by('int_glcode','ASC');
        $query = $this->db->get();

        //echo $this->db->last_query(); exit();
        $row = $query->result_array();

        $data = array();

        foreach ($row as $key => $value) {
            $value['current_amt'] = $value['var_current_balance'];

            if ($value['current_amt'] != '') {
                $value['current_amt'] = $value['current_amt'];
            } else {
                $value['current_amt'] = '0';
            }

            $order_id = $this->getOrderID($value['fk_order']);
            
            if ($order_id != NULL) {
                $value['order_id'] = $this->getOrderID($value['fk_order']);
            } else {
                $value['order_id'] = '';
            }

            $data[] = $value; 
            
        }
        //echo "<pre>"; print_r($data); exit();
        return $data;
    }
}