<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Place_Model extends CI_Model {
   
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('mail_model'); 
        $this->load->model('common_model');        
    }

    public function getCartDetails($uid){
        
        $this->db->select('*');
        $this->db->where('fk_user',$uid);
        $res = $this->db->get('trn_cart_details');
        $result = $res->result_array(); 
        return $result;
    }
    
    /*---------------------- delivery boy block unbloack --------------------*/
    public function add_user_order($fk_user)
    {
        // echo $fk_user; print_r($_POST); 
    	if ($_POST['var_payment_mode'] == 'C') {
    		$payment_mode = 'By Cash';
    	} else {
    		$payment_mode = 'By Online';
    	}

        $this->db->select('int_glcode,var_name,var_email,var_mobile_no,var_alt_mobile,var_wallet');
        $this->db->from('mst_users');
        $this->db->where('int_glcode',$fk_user);
        $query = $this->db->get();
        $user_row = $query->row_array();
        // print_r($user_row);exit();
        // $delivery_type = $this->input->post('delivery_type');

        // $super_del_amt = $this->getDeliveryCharges('S');
        // $ultra_del_amt = $this->getDeliveryCharges('U');

        // $tot_amount = $_POST['total_amount'];   

        // if (($delivery_type == 'S') && ($tot_amount < $super_del_amt['var_below'])) {
        //     $delivery_charge = $super_del_amt['var_charges'];
        // } elseif (($delivery_type == 'U') && ($tot_amount < $ultra_del_amt['var_below'])) {
        //     $delivery_charge = $ultra_del_amt['var_charges'];
        // } else {
        //     $delivery_charge = 0;
        // }

        // $discount_price = $_POST['total_discount_price'];

        $product_arr = $this->getUserProdctDetails($fk_user);
        $user_address = $this->getUserDefaultAddress($fk_user);

        if($user_address == ""){

            $var_country = $this->input->post('var_country');
            $var_address = $this->input->post('var_address');
            $var_city = $this->input->post('var_city');
            $var_pincode = $this->input->post('var_pincode');
            
            $get_address = $var_address.','.$var_city.','.$var_country.'-'.$var_pincode; 
        } else {
            $get_address = $user_address;
        }
        
        
        $data = array(
            'fk_user' => $fk_user,
            'fk_product_arr' => $product_arr,
            'var_payment_mode' => $payment_mode,
            // 'dt_timeslot' => $this->input->post('delivery_time'),
            // 'chr_delivery_status' => $delivery_type,
            'chr_status' => 'P',
            'var_user_address' => $get_address, 
            // 'dt_delivery_date' => $this->input->post('delivery_date'),
            'var_alternate_mobile' => $this->input->post('default_no'),
            'var_address_type' => $this->input->post('address_type'),
            'var_delivery_charge' => $_POST['delivery_charge'],
            // 'var_wallet_amount' => $_POST['var_wallet_amount'],
            // 'var_discount_amount' => $_POST['delivery_charge'],
            'var_total_amount' => $_POST['total_amount'],
            'var_payable_amount' => $_POST['payble_amount'], 
            'var_cashback' => $this->input->post('var_cashback'),
            'var_promocode' => $this->input->post('var_promocode'),
            'dt_createddate' => date('Y-m-d H:i:s')
        );
         //echo "<pre>"; print_r($data);exit();
        $id = $this->common_model->insertRow($data, "mst_orders");

        $to = $user_row['var_email'];

        $subject = 'Thank you for placing order with us';

        $headers = "From: " . FROM_EMAIL . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        $message = "Dear ".$user_row['var_name'].",\r\n\r\n <p>We have received your order and are working on it. You will shortly receive the shipping confirmation and tracking details. 
            <br><h4>Order details:</h4><br>";
        $message .= "<table><tr><th>Product Name</th><th>Quantity</th><th>Price</th></tr>";
        foreach($_SESSION["cart_item"] as $row){
            $message .= "<tr><td>".$row['title']."</td><td>".$row['quantity']."</td><td>".$row['price']."</td></tr>";
        }
        $message .= "<tr><th>Total Payable Amount : <th><td>".$_POST['payble_amount']."</td></tr>";
        $message .= "</table>\r\n\r\n<p>For any clarifications or to know more about Burlyfield, please call us on +91-7722066378, and we will be glad to assist you.</p>\r\n\r\nBest Regards,<br>Team Burlyfield.";

        mail($to, $subject, $message, $headers);

        //echo $this->db->last_query(); exit();

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

            if ($_POST['var_wallet_amount'] != '0') {

                $user_amount = $this->getUserWalletAmount($fk_user);

                $update_amount = $user_amount - $this->input->post('var_wallet_amount');

                $wallet_data = array(
                    'fk_order' => $id,
                    'fk_user' => $fk_user,
                    'var_amount' => $this->input->post('var_wallet_amount'),
                    'chr_transaction_type' => 'D',
                    'var_current_balance' => $update_amount,
                    'dt_createddate' => date('Y-m-d H:i:s'),
                    'dt_modifydate' => date('Y-m-d H:i:s')
                );

                $update = $this->db->query("update mst_users set var_wallet = var_wallet - ".$this->input->post('var_wallet_amount')."  where int_glcode='".$fk_user."' ");
                
                $this->common_model->insertRow($wallet_data, "trn_user_wallet");

                if (SMS_SERVICE == 'Y') {
                    $this->mail_model->user_transaction_wallet($user_row['var_email'],$user_row['var_name'],$user_row['var_mobile_no'],date('d/m/Y'),$gen_orderid,$this->input->post('var_wallet_amount'),$update_amount,'D');
                }
            }
            
            $add_Date = $this->input->post('delivery_time') . ' '. date('d/m/Y',strtotime($this->input->post('delivery_date')));

            if (SMS_SERVICE == 'Y') {
                $this->mail_model->user_order_email($user_row['var_name'],$user_row['var_email'],$product_arr,$tot_amount,$_POST['total_discount_price'],$_POST['delivery_charge'],$_POST['payble_amount'],$add_Date,$gen_orderid,$user_address);
            
                $this->common_model->user_order_msg($user_row['var_name'],$user_row['var_mobile_no'],'USER_ORDER',$gen_orderid,'',$_POST['payble_amount']);

                if ($user_row['var_alt_mobile'] != '') {
                    $this->common_model->user_order_msg($user_row['var_name'],$user_row['var_alt_mobile'],'USER_ORDER',$gen_orderid,'',$_POST['payble_amount']);
                }
            }
           
            $this->emptyUserCart($fk_user);

        return $gen_orderid;
    }

    /*-------------------------- get user product array --------------------- */
    public function emptyUserCart($fk_user)
    {
        unset ($_SESSION["promocode"]);
        unset ($_SESSION["promocode_amout"]);
        unset ($_SESSION["promocode_type"]);
        $this->db->where('fk_user',$fk_user);
        $this->db->delete('trn_cart_details');
           
        return true;
    }

    /*-------------------------- get user product array --------------------- */
    public function getUserProdctDetails($fk_user)
    {
        // $this->db->select('fk_product,var_name,var_quantity,var_price,var_unit,gst_price');
        // $this->db->from('trn_cart_details');
        // $this->db->where('fk_user',$fk_user);
        // $this->db->where('chr_status','A');
        // $query = $this->db->get();
        // $row_arr = $query->result_array();
        $data1 = array();

        
        foreach($_SESSION["cart_item"] as $row){

            $array = array(
                "fk_product"=>$row['int_glcode'],
                "var_name"=>$row['title'],
                "var_quantity"=>$row['weigth'],
                "var_price"=>$row['price'],
                "var_unit"=>$row['quantity'],
                "gst_price"=>$row['gst'],
                "cancel_status"=>"N"
            );
            $data1[] = $array;
            $this->db->select('var_stock');
            $this->db->from('mst_products');
            $this->db->where('int_glcode',$row['int_glcode']);
            $qry = $this->db->get();
            $rw = $qry->row_array();

            $quty = $rw['var_stock'] - $row['quantity'];
            $stock_data = array("var_stock" => $quty);
            $this->common_model->updateRow('mst_products', $stock_data, array("int_glcode" => $row['int_glcode']));

        }

        
        
        $data = json_encode($data1);
           
        return $data;
    }

    /*-------------------------- get user product array --------------------- */
    public function getUserDefaultAddress($fk_user)
    {
        $this->db->select('*');
        $this->db->from('mst_user_address');
        $this->db->where('fk_user',$fk_user);
        $this->db->where('default_status','Y');
        $query = $this->db->get();
        $row = $query->row_array();
        
        $get_address = $row['var_house_no'].','.$row['var_app_name'].','.$row['var_landmark'].','.$row['var_city'].','.$row['var_state'].','.$row['var_country'].'-'.$row['var_pincode']; 

        return $get_address;
    }

    /*-------------------------- get user product array --------------------- */
    public function getUserDetails($fk_user)
    {
        $this->db->select('*');
        $this->db->from('mst_users');
        $this->db->where('fk_user',$fk_user);
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }

    /*-------------------------- get user product array --------------------- */
    public function getUserWalletAmount($fk_user)
    {
        $this->db->select('int_glcode,var_wallet');
        $this->db->from('mst_users');
        $this->db->where('int_glcode',$fk_user);
        $query = $this->db->get();
        $row = $query->row_array();

        return $row['var_wallet'];
    }

    /*-------------------------- get delivery charges --------------------- */
    public function getDeliveryCharges($flag)
    {
        $this->db->select('var_charges,var_below');
        $this->db->from('mst_delivery_charges');
        $this->db->where('chr_type', $flag);
        
        $query = $this->db->get();
        $result = $query->row_array();

        return $result;

    }
    
}