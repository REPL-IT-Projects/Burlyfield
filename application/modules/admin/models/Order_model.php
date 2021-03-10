<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		$this->load->model('common_model');
	}

    /*------------------------ get records count ------------------------- */
    public function records_count($search = ''){

        $this->db->select('mo.int_glcode,mo.order_id,mo.fk_user,mo.var_payment_mode,mo.chr_status,mo.dt_delivery_date,mo.var_alternate_mobile,mo.var_payable_amount,mu.var_name,mo.shipping_date,mo.var_courier,mo.var_tracking');
        $this->db->from('mst_orders mo');
        $this->db->join('mst_users mu', 'mu.int_glcode = mo.fk_user', 'left'); 

        if ($search != '') {

            $this->db->group_start();
            $this->db->like("order_id" , $search);
            $this->db->like("mo.order_id" , $search);
            $this->db->or_like("mo.var_payment_mode" , $search);
            $this->db->or_like("mo.chr_status" , $search);
            $this->db->or_like("mo.dt_delivery_date" , $search);
            $this->db->or_like("mo.var_alternate_mobile" , $search);
            $this->db->or_like("mo.var_payable_amount" , $search);
            $this->db->or_like("mu.var_name" , $search);
            $this->db->group_end();

        }

        $result = $this->db->get();
        $row = $result->result_array();
        //echo $this->db->last_query();die();
        return count($row);
    
    }

    /*------------------------ get records  ------------------------- */
    public function getData($rowno,$rowperpage,$search = '',$_field = 'mo.int_glcode',$_sort = 'desc')
    {          
        $this->db->select('mo.int_glcode,mo.order_id,mo.fk_user,mo.var_payment_mode,mo.chr_status,mo.dt_createddate,mo.var_alternate_mobile,mo.var_payable_amount,mu.var_name,mo.shipping_date,mo.var_courier,mo.var_tracking');
        $this->db->from('mst_orders mo');
        $this->db->join('mst_users mu', 'mu.int_glcode = mo.fk_user', 'left'); 

        $this->db->order_by($_field,$_sort);
        $this->db->limit($rowperpage , $rowno);

        if ($search != '') {

            $this->db->group_start();
            $this->db->like("order_id" , $search);
            $this->db->like("mo.order_id" , $search);
            $this->db->or_like("mo.var_payment_mode" , $search);
            $this->db->or_like("mo.chr_status" , $search);
            $this->db->or_like("mo.dt_delivery_date" , $search);
            $this->db->or_like("mo.var_alternate_mobile" , $search);
            $this->db->or_like("mo.var_payable_amount" , $search);
            $this->db->or_like("mu.var_name" , $search);
            $this->db->group_end();
        }

        $result = $this->db->get();
        //echo $this->db->last_query(); exit();
        $row = $result->result_array();

        return $row;
    }

    /*------------------------ get product by price details -------------------- */
    public function getExportOrders()
    {
        $this->db->select('mo.int_glcode,mo.order_id,mo.fk_user,mo.var_payment_mode,mo.chr_status,mo.var_user_address,mo.dt_timeslot,mo.chr_delivery_status,mo.dt_delivery_date,mo.var_alternate_mobile,mo.var_payable_amount,mo.var_address_type,mo.var_delivery_charge,mo.var_wallet_amount,mo.var_discount_amount,mo.var_total_amount,mo.var_payable_amount,mo.canceled_by,mu.var_name,mo.dt_createddate');
        $this->db->from('mst_orders mo');
        $this->db->join('mst_users mu', 'mu.int_glcode = mo.fk_user', 'left');
        $this->db->order_by('int_glcode','asc');
        $query = $this->db->get();
        $row = $query->result_array();
        
        $data = array();

        foreach ($row as $key => $value) {
            $value['dt_delivery_date'] = date('d/m/Y',strtotime($value['dt_delivery_date']));

            if ($value['chr_status'] == 'R') {
                $value['chr_status'] = 'Rejected';
            } elseif ($value['chr_status'] == 'C') {
                $value['chr_status'] = 'Cancelled';
            } elseif ($value['chr_status'] == 'P') {
                $value['chr_status'] = 'Pending';
            } elseif ($value['chr_status'] == 'W') {
                $value['chr_status'] = 'Packed & Ready To Ship';
            } elseif ($value['chr_status'] == 'SH') {
                $value['chr_status'] = 'Shipped';
            } elseif ($value['chr_status'] == 'RC') {
                $value['chr_status'] = 'Reached your City';
            } elseif ($value['chr_status'] == 'S') {
                $value['chr_status'] = 'Delivered';
            } elseif ($value['chr_status'] == 'A') {
                $value['chr_status'] = 'Accepted';
            } else {
                $value['chr_status'] = 'Active';
            }

            if($value['chr_delivery_status'] == 'S')
            {
                $value['chr_delivery_status'] = 'Superfast';
            } else {
                $value['chr_delivery_status'] = 'Ultrafast';
            }

            if($value['canceled_by'] == 'U')
            {
                $value['canceled_by'] = 'User';
            } elseif ($value['canceled_by'] == 'S') {
                $value['canceled_by'] = 'System';
            } else {
                $value['canceled_by'] = 'Vendor';
            }

            $vendor = $this->getIdByVendorExport($value['int_glcode']);
            $value['vendor'] = $vendor;


            $data[] = $value;

        }

        return $data;
    }

    function OrderStatus($id,$status)
    {
         // echo $id;
         $this->db->select('mu.var_email,mu.var_name,mo.order_id,mo.fk_product_arr,mo.shipping_date,mo.var_courier,mo.var_tracking');
        $this->db->from('mst_orders mo');
        $this->db->join('mst_users mu', 'mu.int_glcode = mo.fk_user');
        $this->db->where('mo.int_glcode',$id);
        $query = $this->db->get();
        $row = $query->result_array();
        // echo "<pre>";print_r($row);exit();
        if($status == 'P')
        {
            $data = array('chr_status' => 'A');
        }else if($status == 'R'){
            $data = array('chr_status' => 'R');
            foreach ($row as $value) {
            $to = $value['var_email'];

            $subject = 'Burlyfield Order Cancelation';

            $headers = "From: " . FROM_EMAIL . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            
            $message = "Dear ".$value['var_name'].",\r\n\r\n <p>We are extremely sorry that we can not process your order ".$value['order_id']." currently because “order cancelation reason that the admin has put”. We hope to serve you better next time. </p>";
            }
            $message .= "\r\n\r\n<p>For any clarifications or to know more about Burlyfield, please call us on +91-7722066378, and we will be glad to assist you.</p>\r\n\r\nBest Regards,<br>Team Burlyfield.";

            mail($to, $subject, $message, $headers);

        }else if($status == 'B'){
            $data = array('chr_status' => 'B');
            foreach ($row as $value) {
            $to = $value['var_email'];

            $subject = 'Burlyfield Order Refund';

            $headers = "From: " . FROM_EMAIL . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            
            $message = "Dear ".$value['var_name'].",\r\n\r\n <p>We have processed a full refund for your order ".$value['order_id']." The amount will be reflected in your account within 8-12 working days.</p>";
            }
            $message .= "\r\n\r\n<p>For any clarifications or to know more about Burlyfield, please call us on +91-7722066378, and we will be glad to assist you.</p>\r\n\r\nBest Regards,<br>Team Burlyfield.";

            mail($to, $subject, $message, $headers);

        }else if($status == 'A'){
            $data = array('chr_status' => 'W');

            foreach ($row as $value) {
                $date = date_create($value['shipping_date']);
                $spdate = date_format($date,"d - m - Y");
            
            
            $to = $value['var_email'];

            $subject = 'Your Burlyfield order is shipped';

            $headers = "From: " . FROM_EMAIL . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            
            $message = "Dear ".$value['var_name'].",\r\n\r\n <p>Sit Back and Relax, your order is on its way!</p> 
                <br>You can track your order using the following Shipping Details: (Take from the admin panel when the admin confirms shipping)<br><p>Shipping date : ".$spdate."</p><p>Courier service : ".$value['var_courier']."</p><p>Tracking number : ".$value['var_tracking']."</p>";
            }
            $message .= "\r\n\r\n<p>For any clarifications or to know more about Burlyfield, please call us on +91-7722066378, and we will be glad to assist you.</p>\r\n\r\nBest Regards,<br>Team Burlyfield.";

            mail($to, $subject, $message, $headers);

        }else if($status == 'T'){
            $data = array('chr_status' => 'T');
        }else {
            $data = array('chr_status' => 'S');

            foreach ($row as $value) {
                $product = json_decode($value['fk_product_arr']);
                $to = $value['var_email'];

                $subject = 'Review your Burlyfield Order';

                $headers = "From: " . FROM_EMAIL . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                $message = "Dear ".$value['var_name'].",\r\n\r\n <p>Your order has been successfully delivered. We would love to hear your feedback about our products. It helps us grow and serve you better!</p><br>";
                foreach ($product as $p_id) {
                   $message .= "<a target='_blank' href='".base_url()."product/detail/".base64_encode($p_id->fk_product)."'> Review ".$p_id->var_name."</a><br>";
                }
            }
            $message .= "\r\n\r\n<p>For any clarifications or to know more about Burlyfield, please call us on +91-7722066378, and we will be glad to assist you.</p>\r\n\r\nBest Regards,<br>Team Burlyfield.";

            mail($to, $subject, $message, $headers);

        }
        $this->common_model->updateRow('mst_orders', $data, array("int_glcode" => $id));
        

        return true;
    }


    /*------------------------ get vendor list --------------------------------*/
    public function getVendorList()
    {
        $this->db->select('int_glcode,var_name');
        $this->db->from('mst_vendors');
        $query = $this->db->get();
        $row = $query->result_array();
        //echo "<pre>"; print_r($row); exit();
        return $row;
    }

    /*------------------------ get product by price details -------------------- */
    public function getProductPriceDetails($Id)
    {
        $this->db->select('int_glcode,fk_product,var_quantity,var_price');
        $this->db->from('trn_product_price');
        $this->db->where('fk_product',$Id);
        $this->db->order_by('int_glcode','asc');
        $query = $this->db->get();
        $row = $query->result_array();
        //echo "<pre>"; print_r($row); exit();
        return $row;
    }

    public function getRejectedReason($fk_order)
    {
        $this->db->select('int_glcode,txt_reason');
        $this->db->from('trn_order_status');
        $this->db->where('fk_order',$fk_order);
        $query = $this->db->get();
        $row = $query->row_array();
        //echo "<pre>"; print_r($row); exit();
        return $row['txt_reason'];
    }

    public function getDeliveryboyData($fk_delivery)
    {
        if ($fk_delivery != '') {
            $this->db->select('int_glcode,var_name,var_email,var_mobile_no');
            $this->db->from('mst_delivery_boy');
            $this->db->where('int_glcode',$fk_delivery);
            $query = $this->db->get();
            $row = $query->row_array();
            //echo "<pre>"; print_r($row); exit();
            return $row;
        } else {
            return array();
        }
       
    }

    /*------------------------ get product by price details -------------------- */
    public function getIdByVendorData($Id)
    {
        $this->db->select('to.int_glcode,to.fk_vendor,to.fk_delivery,to.chr_status,mv.var_name,mv.var_mobile_no,mv.var_alt_mobile,mv.var_email,mv.var_address');
        $this->db->from('mst_orders to');
        $this->db->join('mst_vendors mv', 'mv.int_glcode = to.fk_vendor', 'left');
        $this->db->where('to.int_glcode',$Id);
        $query = $this->db->get();
        $row = $query->result_array();
        //echo "<pre>"; print_r($row); exit();
        $data = array();

        foreach ($row as $key => $value) {
            if(in_array('R', $value))
            {
                $txt_reason = $this->getRejectedReason($value['fk_order']);
            } else {
                $txt_reason = '';
            }

            $value['delivery_data'] = $this->getDeliveryboyData($value['fk_delivery']);

            $value['txt_reason'] = $txt_reason;
            $data[] = $value;
        }

        //echo "<pre>"; print_r($data); exit();
        return $data;
    }

    /*------------------------ get product by price details -------------------- */
    public function getIdByVendorExport($Id)
    {
        $this->db->select('to.int_glcode,to.fk_vendor,to.fk_delivery,to.chr_status,mv.var_name,mv.var_mobile_no,mv.var_alt_mobile,mv.var_email,mv.var_address');
        $this->db->from('mst_orders to');
        $this->db->join('mst_vendors mv', 'mv.int_glcode = to.fk_vendor', 'left');
        $this->db->where('to.int_glcode',$Id);
        $this->db->where('to.chr_status !=','R');
        $query = $this->db->get();
        $data = $query->row_array();
       
        return $data;
    }

    /*------------------------ get product by price details -------------------- */
    public function getIdByVendorDataPDF($Id)
    {
        $this->db->select('to.int_glcode,to.fk_order,to.fk_vendor,to.fk_delivery,to.chr_status,mv.var_name,mv.var_mobile_no,mv.var_alt_mobile,mv.var_email,mv.var_address');
        $this->db->from('trn_assign_order to');
        $this->db->join('mst_vendors mv', 'mv.int_glcode = to.fk_vendor', 'left');
        $this->db->where('to.fk_order',$Id);
        $this->db->where('to.chr_status','A');
        $query = $this->db->get();
        $row = $query->result_array();

        $data = array();

        foreach ($row as $key => $value) {
            $value['delivery_data'] = $this->getDeliveryboyData($value['fk_delivery']);
            $data = $value;

        }
        //echo "<pre>"; print_r($row); exit();
        return $data;
    }

    /*------------------------ get id by record ------------------------- */
    public function getIdByData($Id)
    {
        $this->db->select('mo.*,mu.var_name');
        $this->db->from('mst_orders mo');
        $this->db->join('mst_users mu', 'mu.int_glcode = mo.fk_user', 'left');
        $this->db->where('mo.int_glcode',$Id);
        $query = $this->db->get();
        $result = $query->result_array();
        //echo "<pre>"; print_r($row); exit();

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
            $value['dt_delivery_date'] = date('d/m/Y',strtotime($value['dt_delivery_date']));
            $value['fk_product_arr'] = $product_arr;
            $data[] = $value;

        }
        //echo "<pre>"; print_r($data); exit();
        return $data;
    }

    /*------------------------ get id by record ------------------------- */
    public function getIdByDataPDF($Id)
    {
        $this->db->select('mo.*,mu.var_name');
        $this->db->from('mst_orders mo');
        $this->db->join('mst_users mu', 'mu.int_glcode = mo.fk_user', 'left');
        $this->db->where('mo.int_glcode',$Id);
        $query = $this->db->get();
        $result = $query->result_array();
        //echo "<pre>"; print_r($row); exit();

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

                    $value['dt_delivery_date'] = date('M d , Y',strtotime($value['dt_delivery_date']));

                    $product_arr[] = $pivalue;
                } 
            }

            $value['fk_product_arr'] = $product_arr;
            $data = $value;

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

    /*-------------------------------- delete multiple -------------------------*/
    public function delete_multiple()
    {
        $id = [];
        $id = $_POST['id'];
        $i = 0;

        foreach ($id as $key => $value) {
            $data = array(
                'chr_delete' => 'Y'
            );
        //$this->db->set('column_header', $value); //value that used to update column  
            $this->db->where('int_glcode', $value);
            if($this->db->update("mst_orders",$data))
            {
                $i++;
                $smsg = $i." Records successfully deleted...";
            }
            else
            {
                $smsg = $this->db->_error_message();
            }
        }
        // $this->db->query("DELETE from ci_users WHERE id='$id'");
        return $smsg;

    }

    public function editshipping(){

        $data = array(
            'shipping_date' => $_POST['shipping_date'],
            'var_courier' => $_POST['var_courier'],
            'var_tracking' => $_POST['var_tracking'] 
        );
        
        $this->db->where('int_glcode',$_POST['int_glcode']);
        $this->db->update("mst_orders",$data);

    }

}