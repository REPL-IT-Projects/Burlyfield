<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends Front_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session','form_validation','pagination'));
        $this->load->helper(array('form','url'));
        $this->load->model('Order_model','model');
        $this->fk_user = $_SESSION['fk_user'];
        
    }

    public function index()
    {
        $data['data'] = $this->model->getUserOrders($this->fk_user);
        $this->load_view('view_orders',$data);
    }

    public function viewDetails($Id)
    {
        $Id=base64_decode($Id);

        $data['data'] = $this->model->getOrderDetails($Id);
        $data['user_data'] = $this->model->get_user_details($_SESSION['fk_user']);
        // echo "<pre>";print_r($data);die();
        $this->load_view('order_details',$data);
    }
    
    public function cancel_order()
    {
        $order_id = $_POST['orderId'];
        $this->model->cancel_user_order($order_id);
        
    }

    public function UpdateOrder()
    {
        //echo "<pre>"; print_r($_POST); exit();

        $order_id = $_POST['order_id'];
        $fk_user = $_POST['user_id'];
        $delivery_type = $this->input->post('delivery_type');
        $var_name = $this->input->post('var_name');
        $var_quantity = $this->input->post('var_quantity');
        $var_price = $this->input->post('var_price');
        $var_unit = $this->input->post('var_unit');
        $cancel_status = $this->input->post('cancel_status');

        $data_p = array();

        foreach ($_POST['fk_product'] as $key => $value) {
            $data_p[] = array('fk_product'=>$value,'var_name'=>$var_name[$key],'var_quantity'=>$var_quantity[$key],'var_price'=>$var_price[$key],'var_unit'=>$var_unit[$key],'cancel_status'=>$cancel_status[$key]);
        }

        //echo "<pre>"; print_r($data_p); exit();

        $data = $this->model->getTotalCartDetails($data_p,$delivery_type,$order_id,$fk_user);

        //echo "<pre>"; print_r($data); exit();

        $super_del_amt = $this->model->getDeliveryCharges($delivery_type);
        $ultra_del_amt = $this->model->getDeliveryCharges($delivery_type);

        $tot_amount = array_sum(array_column($data, 'tot_price')); 
        //echo $tot_amount; exit();
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

        $data1 =  $this->model->update_order($order_id,$data_p,$tot_amount,$discount_price,$delivery_charge);

        echo "success";
        exit();
    }

    public function wallet_summary($Id)
    {
        $Id=base64_decode($Id);
        $data['data'] = $this->model->getUserTransaction($Id);
        
        $this->load_view('wallet_summary',$data);
    }
    
}                                    