<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends API_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->library('mylibrary');
        $this->load->model('Cart_model','model');
    }

    /*------------------------------------- Get cart details ---------------------------------*/
    public function getCartDetails()
    {
        $fk_user = $this->input->post('fk_user');

        if ($fk_user == '') {
            $response['status'] = 404;
            $response['message'] = NO_ORDER;
        } else {
            $data = $this->model->getAllCartDetails($fk_user);

            if (count($data) > 0) {
                $response['status'] = 200;
                $response['message'] = GET_SUCCESS;
                $response['data'] = $data;
            } else {
                $response['status'] = 404;
                $response['message'] = NO_ORDER;
            }
        }
  
        echo (json_encode($response));
        exit;
    }

    /*------------------------------------- Get cart details ---------------------------------*/
    public function totalCartDetails()
    {
        $fk_user = $this->input->post('fk_user');
        $delivery_type = $this->input->post('delivery_type');

        if ($fk_user == '') {
            $response['status'] = 404;
            $response['message'] = NO_ORDER;
            $response['total_amount'] = "0";
            $response['delivery_charges'] = "0"; 
        } else {
            $data = $this->model->getTotalCartDetails($fk_user);
            $super_del_amt = $this->model->getDeliveryCharges($delivery_type);
            $ultra_del_amt = $this->model->getDeliveryCharges($delivery_type);

            $tot_amount = array_sum(array_column($data, 'tot_price')); 
            
            if($tot_amount <= 100)
            {
                $convience_fee = ($tot_amount * 20) / 100;
            }else if($tot_amount > 100 && $tot_amount <= 500 )
            {
                $convience_fee = ($tot_amount * 10) / 100;
            }else{
                $convience_fee = ($tot_amount * 5) / 100;
            }
            
            $gst_price = ($tot_amount * 6) / 100;

            if (($delivery_type == 'S') && ($tot_amount < $super_del_amt['var_below'])) {
                $delivery_charge = $super_del_amt['var_charges'];
            } elseif (($delivery_type == 'U') && ($tot_amount < $ultra_del_amt['var_below'])) {
                $delivery_charge = $ultra_del_amt['var_charges'];
            } else {
                $delivery_charge = 0;
            }

            $discount_price = array_sum(array_column($data, 'discount_price')); 

            $sel = $this->db->query("select cod_status from mst_admin where int_glcode='1' ");
            $res = $sel->row_array();
            
            if (count($data) > 0) {
                $response['status'] = 200;
                $response['message'] = GET_SUCCESS;
                $response['cod_status'] = $res['cod_status'];
                $response['total_amount'] = number_format($tot_amount,2,'.',''); 
                $response['discount_amount'] = number_format($discount_price,2,'.','');
                $response['delivery_charges'] = number_format($delivery_charge,2,'.',''); 
                $response['convience_fee'] = number_format($convience_fee,2,'.','');
                $response['gst_price'] = number_format($gst_price,2,'.','');
                $response['data'] = $data;
            } else {
                $response['status'] = 404;
                $response['message'] = NO_ORDER;
                $response['total_amount'] = "0"; 
                $response['delivery_charges'] = "0"; 
            }
        }
  
        echo (json_encode($response));
        exit;
    }

    /*------------------------- add / update on cart ------------------------ */
    public function updateUserCart()
    {
        $data =  $this->model->add_update_cart();
                   
            // if ($data == TRUE) {
            
                $response['status'] = 200;
                $response['message'] = ADD_CART;
                $response['unit'] = $this->input->post('var_unit');
                $response['cart_total'] = $data;

            // } else {
            //     $response['status'] = 404;
            //     $response['message'] = ADD_ERROR;
            // }

        echo (json_encode($response));
        exit;
    }

    public function ClearUserCart()
    {
        
        $del = $this->db->query("delete from trn_cart_details where fk_user='".$_POST['user_id']."' ");
            // if ($data == TRUE) {
            
                $response['status'] = 200;
                $response['message'] = 'Cart Clear Successfully.';

            // } else {
            //     $response['status'] = 404;
            //     $response['message'] = ADD_ERROR;
            // }

        echo (json_encode($response));
        exit;
    }
    
    public function SingleCartDetails()
    {
        $fk_user = $this->input->post('fk_user');
        $delivery_type = $this->input->post('delivery_type');
        $fk_product = $this->input->post('fk_product');
        $var_quantity = $this->input->post('var_quantity');

        if ($fk_user == '') {
            $response['status'] = 404;
            $response['message'] = NO_ORDER;
            $response['total_amount'] = "0";
            $response['delivery_charges'] = "0"; 
        } else {
            $data = $this->model->SingleCartDetails($fk_user,$fk_product,$var_quantity);
            $super_del_amt = $this->model->getDeliveryCharges($delivery_type);
            $ultra_del_amt = $this->model->getDeliveryCharges($delivery_type);

            $tot_amount = array_sum(array_column($data, 'tot_price')); 
            
            if($tot_amount <= 100)
            {
                $convience_fee = ($tot_amount * 20) / 100;
            }else if($tot_amount > 100 && $tot_amount <= 500 )
            {
                $convience_fee = ($tot_amount * 10) / 100;
            }else{
                $convience_fee = ($tot_amount * 5) / 100;
            }
            
            $gst_price = ($tot_amount * 6) / 100;

            if (($delivery_type == 'S') && ($tot_amount < $super_del_amt['var_below'])) {
                $delivery_charge = $super_del_amt['var_charges'];
            } elseif (($delivery_type == 'U') && ($tot_amount < $ultra_del_amt['var_below'])) {
                $delivery_charge = $ultra_del_amt['var_charges'];
            } else {
                $delivery_charge = 0;
            }

            $discount_price = array_sum(array_column($data, 'discount_price')); 

            $sel = $this->db->query("select cod_status from mst_admin where int_glcode='1' ");
            $res = $sel->row_array();
            
            if (count($data) > 0) {
                $response['status'] = 200;
                $response['message'] = GET_SUCCESS;
                $response['cod_status'] = $res['cod_status'];
                $response['total_amount'] = number_format($tot_amount,2,'.',''); 
                $response['discount_amount'] = number_format($discount_price,2,'.','');
                $response['delivery_charges'] = number_format($delivery_charge,2,'.',''); 
                $response['convience_fee'] = number_format($convience_fee,2,'.','');
                $response['gst_price'] = number_format($gst_price,2,'.','');
                $response['data'] = $data;
            } else {
                $response['status'] = 404;
                $response['message'] = NO_ORDER;
                $response['total_amount'] = "0"; 
                $response['delivery_charges'] = "0"; 
            }
        }
  
        echo (json_encode($response));
        exit;
    }
    
}