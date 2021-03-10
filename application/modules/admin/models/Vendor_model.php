<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_model extends CI_Model {

	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		$this->load->model('common_model');
	}

    /*------------------------ get records count ------------------------- */
    public function records_count($search = ''){

        $this->db->select('int_glcode,var_email,chr_delete');
        $this->db->from('mst_vendors');        

        if ($search != '') {

            $this->db->group_start();
            $this->db->like("var_name" , $search);
            $this->db->or_like("var_email" , $search);
            $this->db->or_like("var_username" , $search);
            $this->db->or_like("var_mobile_no" , $search);
            $this->db->or_like("var_membership_type" , $search);
            $this->db->group_end();

        }

        $this->db->where('chr_delete','N');        

        $result = $this->db->get();
        $row = $result->result_array();
        //echo $this->db->last_query();die();
        return count($row);
    
    }

    public function updateTimeStamp($email)
    {
        $time_stamp = time();
        $this->db->set('dt_timestamp', $time_stamp); 
        $this->db->where('var_email', $email);   
        $this->db->update('mst_vendors'); 
    }

    /*------------------------ get records count ------------------------- */
    public function records_count_history($search = ''){

        $this->db->select('int_glcode');
        $this->db->from('mst_logmanager');        

        if ($search != '') {

            $this->db->group_start();
            $this->db->like("fk_admin" , $search);
            $this->db->or_like("fk_vendor" , $search);
            $this->db->or_like("chr_mode" , $search);
            $this->db->or_like("dt_createddate" , $search);
            $this->db->or_like("var_ipaddress" , $search);    
            $this->db->group_end();
        }      

        $result = $this->db->get();
        $row = $result->result_array();
        //echo $this->db->last_query();die();
        return count($row);
    
    }

    /*------------------------ get records  ------------------------- */
    public function getData($rowno,$rowperpage,$search = '',$_field = 'int_glcode',$_sort = 'desc')
    {          
        $this->db->select('int_glcode,var_name,var_mobile_no,var_alt_mobile,var_email,var_username, 	var_image,var_latitude,var_longitude,var_membership_type,chr_publish,chr_delete,dt_createddate');
        $this->db->from('mst_vendors');
        $this->db->where('chr_delete','N');        
        $this->db->order_by($_field,$_sort);
        $this->db->limit($rowperpage , $rowno);

        if ($search != '') {

            $this->db->group_start();
            $this->db->like("var_name" , $search);
            $this->db->or_like("var_email" , $search);
            $this->db->or_like("var_username" , $search);
            $this->db->or_like("var_mobile_no" , $search);
            $this->db->or_like("var_membership_type" , $search);    
            $this->db->group_end();
        }

        $result = $this->db->get();
        $row = $result->result_array();

        return $row;
    }

    /*------------------------ get export all vendors ------------------- */
    public function getExportVendors()
    {
        $this->db->select('int_glcode,var_name,var_mobile_no,var_alt_mobile,var_email,var_address,var_latitude,var_longitude,verify_status,var_membership_type,var_commission_value,dt_startdate,dt_enddate,dt_createddate');
        $this->db->from('mst_vendors');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();

        $data = array();

        foreach ($row as $key => $value) {
            if($value['verify_status'] == 'Y'){
                $value['verify_status'] = 'Yes';
            } else {
                $value['verify_status'] = 'No';
            }

            if($value['var_alt_mobile'] != ''){
                $value['verify_status'] = $value['verify_status'];
            } else {
                $value['verify_status'] = '-';
            }

            if($value['var_commission_value'] != ''){
                $value['var_commission_value'] = $value['var_commission_value'];
            } else {
                $value['var_commission_value'] = '-';
            }

            $value['dt_startdate'] = date('d/m/Y',strtotime($value['dt_startdate']));

            $value['dt_enddate'] = date('d/m/Y',strtotime($value['dt_enddate']));

            $value['dt_createddate'] = date('d/m/Y',strtotime($value['dt_createddate']));

            $data[] = $value;
        }

        return $data;
    }

    /*------------------------ get records  ------------------------- */
    public function getVendorHistory($rowno,$rowperpage,$search = '',$_field = 'int_glcode',$_sort = 'desc')
    {          
        $this->db->select('*');
        $this->db->from('mst_logmanager');      
        $this->db->order_by($_field,$_sort);
        $this->db->limit($rowperpage , $rowno);

        if ($search != '') {

            $this->db->group_start();
            $this->db->like("fk_admin" , $search);
            $this->db->or_like("fk_vendor" , $search);
            $this->db->or_like("chr_mode" , $search);
            $this->db->or_like("dt_createddate" , $search);
            $this->db->or_like("var_ipaddress" , $search);    
            $this->db->group_end();
        }

        $result = $this->db->get();
        $row = $result->result_array();

        return $row;
    }

    /*------------------------ get id by record ------------------------- */
    public function getIdByData($userId)
    {
        $this->db->select('*');
        $this->db->from('mst_vendors');
        $this->db->where('int_glcode',$userId);
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }

    /*------------------------ get vendors documents ------------------------- */
    public function getVendorDocuments($vendorId)
    {
        $this->db->select('int_glcode,fk_vendor,var_document');
        $this->db->from('trn_vendor_documents');
        $this->db->where('fk_vendor',$vendorId);
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;
    }

    /*------------------------ add record ------------------------- */
    public function addRecord()
    {
        if($_FILES['var_image']['name'] != '')
        {
	        if (!is_dir('uploads/vendor')) {
			 	mkdir('uploads/vendor', 0777, TRUE);
			}
	            $filename = time().'_'.$_FILES['var_image']['name'];
	            $filename = str_replace('&', "_", $filename);
	            $filename = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename);
	            $destination = 'uploads/vendor/';
	            move_uploaded_file($_FILES['var_image']['tmp_name'],$destination.$filename);
	        } else {
	            $filename =  '';
	        }

            $date1 = strtr($_POST['dt_startdate'], '/', '-');
            $start_date = date('Y-m-d', strtotime($date1));

            $date2 = strtr($_POST['dt_enddate'], '/', '-');
            $end_date = date('Y-m-d', strtotime($date2));

	        $data = array(
		        'var_name' => $this->input->post('var_name'),
		        'var_mobile_no' => $this->input->post('phone'),
		        'var_alt_mobile' => $this->input->post('alt_phone'),
		        'var_email' => $this->input->post('email'),
		        'var_password' => $this->mylibrary->cryptPass($this->input->post('password')),
		        'var_image' => $filename,
		        'var_address' => $this->input->post('var_address'),
		        'var_latitude' => $this->input->post('var_latitude'),
		        'var_longitude' => $this->input->post('var_longitude'),
                    'var_state' => $this->input->post('var_state'),
                'var_city' => $this->input->post('var_city'),
                'var_membership_type' => $this->input->post('membership_type'),
                'var_commission_value' => $this->input->post('var_commission_value'),
                'dt_startdate' => $start_date,
                'dt_enddate' => $end_date,
		        'chr_publish' => 'Y',
		        'chr_delete' => 'N',
                'fk_admin' => $_SESSION['adminuser'],
		        'dt_createddate' => date('Y-m-d H:i:s'),
		        'dt_modifydate' => date('Y-m-d H:i:s'),
		        'var_ipaddress' => $_SERVER['REMOTE_ADDR']
	     	);

        $id = $this->common_model->insertRow($data, "mst_vendors");

        $this->common_model->insertinlogmanager('Add',$this->input->post('var_name'));

        //echo "<pre>"; print_r($_POST);
        // echo "<pre>"; print_r($_FILES['img_document']['tmp_name']); exit();
        if (isset($_FILES['img_document'])) {

            $images = $_FILES['img_document']['name'];
            
            if (!is_dir('uploads/vendor_documents')) {
                mkdir('uploads/vendor_documents', 0777, TRUE);
            }
            foreach ($images as $key => $value) {

                if($images[$key] != ''){
                    $filename = time()."_".$images[$key];
                    $filename = str_replace('&', "_", $filename);
                    $filename = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename);
                    $destination = 'uploads/vendor_documents/';
                    move_uploaded_file($_FILES['img_document']['tmp_name'][$key],$destination.$filename);
                } else {
                    $filename = '';
                }
                //echo $filename
                $data = array(
                    'fk_vendor' => $id,
                    'var_document' => $filename,
                    'dt_createddate' => date('Y-m-d H:i:s'),
                    'var_ipaddress' => $_SERVER['REMOTE_ADDR']
                );

                $this->common_model->insertRow($data, "trn_vendor_documents");
            }
        }
        $var_email = $this->input->post('email');
        $address = $this->input->post('var_address');
        if ($address != '') {
            $address = $address;
        } else {
            $address = 'N/A';
        }
            $this->common_model->send_register_user($this->input->post('var_name'),$var_email,$this->input->post('phone'),'A');
            //echo $this->db->last_query(); exit();
           
        return TRUE;

    }

    /*---------------------------- update user app ----------------------*/
    public function updateRecord($vendorId)
    {
        if($_FILES['var_image']['name'] != '')
        {
            if (!is_dir('uploads/vendor')) {
                mkdir('uploads/vendor', 0777, TRUE);
            }

            $filename = time().'_'.$_FILES['var_image']['name'];
            $filename = str_replace('&', "_", $filename);
            $filename = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename);
            $destination = 'uploads/vendor/';
            move_uploaded_file($_FILES['var_image']['tmp_name'],$destination.$filename);
        } else {
            $filename =  $this->input->post('hidvar_image');
        }
       
        $date1 = strtr($_POST['dt_startdate'], '/', '-');
        $start_date = date('Y-m-d', strtotime($date1));

        $date2 = strtr($_POST['dt_enddate'], '/', '-');
        $end_date = date('Y-m-d', strtotime($date2));

        $data = array(
            'var_name' => $this->input->post('var_name'),
            'var_mobile_no' => $this->input->post('phone'),
            'var_alt_mobile' => $this->input->post('alt_phone'),
            'var_email' => $this->input->post('email'),
            'var_password' => $this->mylibrary->cryptPass($this->input->post('var_password')),
            'var_image' => $filename,
            'var_address' => $this->input->post('var_address'),
            'var_latitude' => $this->input->post('var_latitude'),
            'var_longitude' => $this->input->post('var_longitude'),
            'var_state' => $this->input->post('var_state'),
                'var_city' => $this->input->post('var_city'),
            'var_membership_type' => $this->input->post('membership_type'),
            'var_commission_value' => $this->input->post('var_commission_value'),
            'dt_startdate' => $start_date,
            'dt_enddate' => $end_date,
            'dt_modifydate' => date('Y-m-d H:i:s'),
            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
        );

        $this->common_model->updateRow('mst_vendors', $data, array("int_glcode" => $vendorId));
        $this->common_model->insertinlogmanager('Update',$this->input->post('var_name'));
        //echo "<pre>"; print_r($_POST);
        // echo "<pre>"; print_r($_FILES['img_document']['tmp_name']); exit();

        if (isset($_FILES['img_document'])) {
            $images = $_FILES['img_document']['name'];
            if (!is_dir('uploads/vendor_documents')) {
                mkdir('uploads/vendor_documents', 0777, TRUE);
            }
            foreach ($images as $key => $value) {

                if($images[$key] != ''){
                    $filename = time()."_".$images[$key];
                    $filename = str_replace('&', "_", $filename);
                    $filename = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename);
                    $destination = 'uploads/vendor_documents/';
                    move_uploaded_file($_FILES['img_document']['tmp_name'][$key],$destination.$filename);
                } else {
                    $filename = '';
                }
                //echo $filename
                $data = array(
                    'fk_vendor' => $vendorId,
                    'var_document' => $filename,
                    'dt_createddate' => date('Y-m-d H:i:s'),
                    'var_ipaddress' => $_SERVER['REMOTE_ADDR']
                );

                $this->common_model->insertRow($data, "trn_vendor_documents");
            }
        }

        //echo $this->db->last_query(); exit();
        return TRUE;

    }
    
    /*---------------- check email already exit or not --------------*/
    public function checkEmail($eaddress)
    {
        $select = "select int_glcode from mst_vendors where chr_delete = 'N' and chr_publish = 'Y' and var_email = '".$eaddress."'";
        $result = $this->db->query($select);
        $count = $result->num_rows();
        if($count > 0){
            return false;
        }else{
            return true;
        }
    }

    /*---------------- check mobile no. already exit or not --------------*/
    public function checkMobile($mobile)
    {
        $select = "select int_glcode from mst_vendors where chr_delete = 'N' and chr_publish = 'Y' and var_mobile_no = '".$mobile."'";
        $result = $this->db->query($select);
        $count = $result->num_rows();
        if($count > 0){
            return false;
        }else{
            return true;
        }
    }
    
    
    /*---------------- If vairable return null value then return blank --------------*/
    public function emptyVar($field)
    {
      if($field == NULL) {
            $field = "";
        }
        return $field;
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
            if($this->db->update("mst_vendors",$data))
            {
                $i++;
                $smsg = $i." Records successfully deleted...";
            }
            else
            {
                $smsg = $this->db->_error_message();
            }
                $this->db->select('int_glcode,var_name');
                $this->db->from('mst_vendors');
                $this->db->where('int_glcode',$value);
                $query = $this->db->get();
                $row = $query->row_array();
                $var_name = $row['var_name'];

                $this->common_model->insertinlogmanager('Delete',$var_name);
        }
        // $this->db->query("DELETE from ci_users WHERE id='$id'");
        return $smsg;

    }

    /*-------------------------------- update publish -------------------------*/
    public function updatedisplay() 
    {
        $data = array(
            $this->input->get_post('fieldname')=>$this->input->get_post('value')
        );

        $this->db->where('int_glcode', $this->input->get_post('id'));
        $a=$this->db->update($this->input->get_post('tablename'), $data);

        echo ($a) ? "1" : "0";
        exit;
    }

    /*---------------------------- display vendor orders ---------------------------*/
    public function orders_count($vendorId,$search = ''){

        $this->db->select('mo.int_glcode,mo.order_id,mo.fk_user,mo.var_payment_mode,mo.chr_status,mo.dt_delivery_date,mo.var_alternate_mobile,mo.var_payable_amount,mu.var_name');
        $this->db->from('mst_orders mo');
        //$this->db->join('mst_orders mo', 'mo.int_glcode = to.fk_order', 'left');
        $this->db->join('mst_users mu', 'mu.int_glcode = mo.fk_user', 'left'); 
        $this->db->where('mo.fk_vendor',$vendorId);
        
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
    public function getOrders($vendorId,$rowno,$rowperpage,$search = '',$_field = 'mo.int_glcode',$_sort = 'desc',$vendor_id='')
    {          
        $this->db->select('mo.int_glcode,mo.order_id,mo.fk_user,mo.var_payment_mode,mo.chr_status,mo.dt_createddate,mo.var_alternate_mobile,mo.var_payable_amount,mu.var_name');
        $this->db->from('mst_orders mo');
        //$this->db->join('mst_orders mo', 'mo.int_glcode = to.fk_order', 'left');
        $this->db->join('mst_users mu', 'mu.int_glcode = mo.fk_user', 'left'); 
        $this->db->where('mo.fk_vendor',$vendorId);
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

        //echo "<pre>"; print_r($row); exit();

        return $row;
    }

    /*------------------------ get product by price details -------------------- */
    public function getExportVendorOrders($vendorId)
    {
        $this->db->select('mo.int_glcode,mo.order_id,mo.fk_user,mo.var_payment_mode,mo.chr_status,mo.var_user_address,mo.dt_timeslot,mo.chr_delivery_status,mo.dt_delivery_date,mo.var_alternate_mobile,mo.var_payable_amount,mo.var_address_type,mo.var_delivery_charge,mo.var_wallet_amount,mo.var_discount_amount,mo.var_total_amount,mo.var_payable_amount,mo.canceled_by,mu.var_name,mo.dt_createddate');
        $this->db->from('mst_orders mo');
        //$this->db->join('mst_orders mo', 'mo.int_glcode = to.fk_order', 'left');
        $this->db->join('mst_users mu', 'mu.int_glcode = mo.fk_user', 'left');
        $this->db->where('to.fk_vendor',$vendorId);
        $this->db->order_by('int_glcode','asc');
        $query = $this->db->get();
        $row = $query->result_array();
        
        $data = array();

        foreach ($row as $key => $value) {
            $value['dt_delivery_date'] = date('d/m/Y',strtotime($value['dt_delivery_date']));

            if ($value['chr_status'] == 'R') {
                $value['chr_status'] = 'Rejected';
            } elseif ($value['chr_status'] == 'C') {
                $value['chr_status'] = 'Completed';
            } elseif ($value['chr_status'] == 'P') {
                $value['chr_status'] = 'Pending';
            } elseif ($value['chr_status'] == 'W') {
                $value['chr_status'] = 'In Progress';
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
            } elseif ($value['canceled_by'] == 'V') {
                $value['canceled_by'] = 'Vendor';
            } else {
                $value['canceled_by'] = '';
            }

            $vendor = $this->getIdByVendorExport($value['int_glcode']);
            $value['vendor'] = $vendor;


            $data[] = $value;

        }

        return $data;
    }

    /*------------------------ get product by price details -------------------- */
    public function getIdByVendorExport($Id)
    {
        $this->db->select('to.int_glcode,to.fk_order,to.fk_vendor,to.fk_delivery,to.chr_status,mv.var_name,mv.var_mobile_no,mv.var_alt_mobile,mv.var_email,mv.var_address');
        $this->db->from('trn_assign_order to');
        $this->db->join('mst_vendors mv', 'mv.int_glcode = to.fk_vendor', 'left');
        $this->db->where('to.fk_order',$Id);
        $this->db->where('to.chr_status !=','R');
        $query = $this->db->get();
        $row = $query->result_array();
        //echo "<pre>"; print_r($row); exit();
        $data = array();

        foreach ($row as $key => $value) {
            
            $value['delivery_data'] = $this->getDeliveryboyData($value['fk_delivery']);

            $data = $value;
        }

        //echo "<pre>"; print_r($data); exit();
        return $data;
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

    public function getExportLoghistory()
    {          
        $this->db->select('*');
        $this->db->from('mst_logmanager');      
        $result = $this->db->get();
        $row = $result->result_array();

        return $row;
    }
    
}