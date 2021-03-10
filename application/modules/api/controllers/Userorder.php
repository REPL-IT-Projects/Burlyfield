<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Userorder extends API_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->library('mylibrary');
        $this->load->model('Userorder_model','model');
    }

    /*--------------------------------- user orders ---------------------------*/
    public function userAddOrder()
    {
        $fk_user = $_POST['fk_user'];

        $data =  $this->model->add_user_order($fk_user);

        if (!empty($data)) {
            $response['status'] = 200;
            $response['message'] = ORDER_PLACE;
            $response['data'] = $data;
        } else {
            $response['status'] = 404;
            $response['message'] = ORDER_PLACE_ERROR;
        }

        echo (json_encode($response));
        exit;
    }

    /*--------------------------------- get user orders ---------------------------*/
    public function getUserOrders()
    {
        $fk_user = $_POST['fk_user'];

        $data =  $this->model->get_user_order($fk_user);

        if (count($data) > 0) {
            $response['status'] = 200;
            $response['message'] = GET_SUCCESS;
            $response['data'] = $data;
        } else {
            $response['status'] = 404;
            $response['message'] = GET_ERROR;
        }

        echo (json_encode($response));
        exit;
    }

    /*------------------------- get user transaction report ---------------------*/
    public function userTransactionWallet()
    {
        $fk_user = $_POST['fk_user'];

        $data =  $this->model->user_transaction_wallet($fk_user);

        if (count($data) > 0) {
            $response['status'] = 200;
            $response['message'] = GET_SUCCESS;
            $response['data'] = $data;
        } else {
            $response['status'] = 404;
            $response['message'] = GET_ERROR;
        }

        echo (json_encode($response));
        exit;
    }

    /*------------------------- single add order ---------------------*/
    public function SingleAddOrder()
    {
        $fk_user = $_POST['fk_user'];
        $fk_product = $_POST['fk_product'];
        $var_quantity = $_POST['var_quantity'];

        $data =  $this->model->single_user_order($fk_user,$fk_product,$var_quantity);

        if (!empty($data)) {
            $response['status'] = 200;
            $response['message'] = ORDER_PLACE;
            $response['data'] = $data;
        } else {
            $response['status'] = 404;
            $response['message'] = ORDER_PLACE_ERROR;
        }

        echo (json_encode($response));
        exit;
    }
    
    public function CancelOrder()
    {
        $order_id = $_POST['order_id'];

        $data =  $this->model->cancel_order($order_id);

        if (!empty($data)) {
            $response['status'] = 200;
            $response['message'] = "Order Cancel successfully.";
        } else {
            $response['status'] = 404;
            $response['message'] = "Error while cancel order.";
        }

        echo (json_encode($response));
        exit;
    }
    
    public function UpdateOrder()
    {
        $order_id = $_POST['order_id'];
        $fk_user = $_POST['fk_user'];
        $delivery_type = $this->input->post('delivery_type');
        
            $data = $this->model->getTotalCartDetails($_POST['product_arr'],$delivery_type,$order_id,$fk_user);
            $super_del_amt = $this->model->getDeliveryCharges($delivery_type);
            $ultra_del_amt = $this->model->getDeliveryCharges($delivery_type);

            $tot_amount = array_sum(array_column($data, 'tot_price')); 

            if (($delivery_type == 'S') && ($tot_amount < $super_del_amt['var_below'])) {
                $delivery_charge = $super_del_amt['var_charges'];
            } elseif (($delivery_type == 'U') && ($tot_amount < $ultra_del_amt['var_below'])) {
                $delivery_charge = $ultra_del_amt['var_charges'];
            } else {
                $delivery_charge = 0;
            }

            $discount_price = array_sum(array_column($data, 'discount_price')); 

            $final_tot_amount = number_format($tot_amount,2,'.','');
            $final_discount_amt = number_format($discount_price,2,'.','');
            $final_delivery_charges = number_format($delivery_charge,2,'.','');

            $payable_amount = $final_tot_amount - $final_discount_amt;
            $payable_amt_add = $payable_amount + $final_delivery_charges;
            $final_payable_amt = number_format($payable_amt_add,2,'.','');

            $data1 =  $this->model->update_order($order_id,$_POST['product_arr'],$tot_amount,$discount_price,$delivery_charge);

            if (count($data) > 0) {
                $response['status'] = 200;
                $response['message'] = GET_SUCCESS;
                $response['total_amount'] = $final_tot_amount; 
                $response['discount_amount'] = $final_discount_amt;
                $response['payable_amount'] = $final_payable_amt;
                $response['delivery_charges'] = $final_delivery_charges; 
                $response['data'] = $data;
            } else {
                $response['status'] = 404;
                $response['message'] = NO_ORDER;
                $response['total_amount'] = "0"; 
                $response['payable_amount'] = "0"; 
                $response['delivery_charges'] = "0";
            }
            
//        if ($data) {
//            $response['status'] = 200;
//            $response['message'] = "Update order successfully.";
//        } else {
//            $response['status'] = 404;
//            $response['message'] = "Error while update order.";
//        }

        echo (json_encode($response));
        exit;
    }
    
}