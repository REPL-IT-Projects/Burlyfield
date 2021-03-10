<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_history extends Vendor_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session','form_validation','pagination','mylibrary'));
		$this->load->model('common_model');
		$this->load->model('Order_history_model','model');
	}

	/*---------------------------- view data index -----------------------*/
	public function index()
	{

		$data['completed_order'] = $this->model->getOrderHistory($_SESSION['fk_vendor'],'S');
                $data['reject_order'] = $this->model->getOrderHistory($_SESSION['fk_vendor'],'R');
                $data['cancel_order'] = $this->model->getOrderHistory($_SESSION['fk_vendor'],'C');
                
		$this->load_view('order_history/view_order_history',$data);

	}

    public function updateStatus()
    {
        $data = array(
            'chr_status' => $this->input->post('flag')
        );

        $this->db->where('int_glcode', $this->input->post('fk_order'));
        $this->db->update('mst_orders', $data);

            $data = array(
                'fk_vendor' => $_SESSION['fk_vendor'],
                'fk_order' => $this->input->post('fk_order'),
                'chr_status' => $this->input->post('flag'),
                'txt_reason' => $this->input->post('txt_reason'),
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

		$this->load->view('order_history/order_detail_modal',$data);
    }
    
    public function assign_order()
    {
        $vendorId = $_SESSION['fk_vendor'];
        $data = array(
            'fk_vendor' => $vendorId,
            'fk_delivery' => $this->input->post('fk_delivery'),
            'fk_order' => $this->input->post('fk_order'),
            'chr_status' => 'A',
            'dt_createddate' => date('Y-m-d H:i:s')
        );

        //$id = $this->common_model->insertRow($data, "trn_assign_order");

        $this->common_model->updateRow('trn_assign_order', $data, array("fk_vendor" => $vendorId,"fk_order" => $this->input->post('fk_order')));

        $device_token = $this->getDeliveryBoyToken($this->input->post('fk_delivery'));
        $this->common_model->assign_order_notification($device_token['var_name'],$device_token['var_device_token']);
        $data = array(
            'chr_status' => 'W'
        );

        $this->db->where('int_glcode', $this->input->post('fk_order'));
        $this->db->update('mst_orders', $data);

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