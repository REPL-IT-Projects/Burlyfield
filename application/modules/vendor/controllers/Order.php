<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends Vendor_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session','form_validation','pagination','mylibrary'));
		$this->load->model('common_model');
		$this->load->model('Order_model','model');
	}

	/*---------------------------- view data index -----------------------*/
	public function index()
	{

		$data['pending_order'] = $this->model->getOrderHistory($_SESSION['fk_vendor'],'P');
                $data['accept_order'] = $this->model->getOrderHistory($_SESSION['fk_vendor'],'A');
                $data['working_order'] = $this->model->getOrderWorking($_SESSION['fk_vendor']);
                $data['reject_reason'] = $this->model->get_reject_reason();
                
		$this->load_view('order/view_order',$data);

	}

    public function updateStatus()
    {
        if($this->input->post('reason_option') == 'Others'){
            $reason = $this->input->post('txt_reason');
        }else{
            $reason = $this->input->post('reason_option');
        }
        
        $data = array(
            'chr_status' => $this->input->post('flag')
        );

        $this->db->where('int_glcode', $this->input->post('fk_order'));
        $this->db->update('mst_orders', $data);

            $data = array(
                'fk_vendor' => $_SESSION['fk_vendor'],
                'fk_order' => $this->input->post('fk_order'),
                'chr_status' => $this->input->post('flag'),
                'txt_reason' => $reason,
                'dt_createddate' => date('Y-m-d H:i:s')
            );

            $id = $this->common_model->insertRow($data, "trn_order_status");

            redirect(base_url().'vendor/order');
    }
    
      public function order_detail_modal(){

                $vendor_id = $_SESSION['fk_vendor'];
		$order_id = $_POST['fk_order'];

                $data['order'] = $this->model->get_orderData($vendor_id,$order_id);
                $data['delivery_boy'] = $this->model->delivery_boy_list();

		$this->load->view('order/order_detail_modal',$data);
    }
    
    public function accept_order_modal(){

                $vendor_id = $_SESSION['fk_vendor'];
		$order_id = $_POST['fk_order'];

                $data['delivery_boy'] = $this->model->delivery_boy_list();
                $data['fk_order'] = $order_id;

		$this->load->view('order/order_accept_modal',$data);
    }
    
    public function assign_order()
    {
        $vendorId = $_SESSION['fk_vendor'];
        
            $data1 = array(
                'fk_vendor' => $_SESSION['fk_vendor'],
                'fk_order' => $this->input->post('fk_order'),
                'chr_status' => 'A',
                'dt_createddate' => date('Y-m-d H:i:s')
            );

            $id = $this->common_model->insertRow($data1, "trn_order_status");
            
        $data2 = array(
            'fk_vendor' => $vendorId,
            'fk_delivery' => $this->input->post('fk_delivery'),
            'fk_order' => $this->input->post('fk_order'),
            'chr_status' => 'A',
            'dt_createddate' => date('Y-m-d H:i:s')
        );

        //$id = $this->common_model->insertRow($data, "trn_assign_order");

        $this->common_model->updateRow('trn_assign_order', $data2, array("fk_vendor" => $vendorId,"fk_order" => $this->input->post('fk_order')));

        $data3 = array(
            'chr_status' => 'W'
        );

        $this->db->where('int_glcode', $this->input->post('fk_order'));
        $this->db->update('mst_orders', $data3);

        $device_token = $this->getDeliveryBoyToken($this->input->post('fk_delivery'));
        $this->common_model->assign_order_notification($device_token['var_name'],$device_token['var_device_token']);
        
        echo 1;exit;
    }
    
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
    
    public function check_delivery_boy()
    {
        $fk_delivery = $_POST['id'];
        
        $this->db->select('int_glcode as fk_delivery,chr_status,current_status,chr_publish,chr_delete');
        $this->db->from('mst_delivery_boy');
        $this->db->where('int_glcode',$fk_delivery);
        $query = $this->db->get();
        $row = $query->row_array();
        
        echo $row['current_status'];exit;
        
    }
}                                         