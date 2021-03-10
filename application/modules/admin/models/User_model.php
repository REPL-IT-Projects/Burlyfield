<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		$this->load->model('common_model');
	}

    /*------------------------ get records count ------------------------- */
    public function records_count($search = ''){

        $this->db->select('int_glcode,var_email,chr_delete');
        $this->db->from('mst_users');        

        if ($search != '') {

            $this->db->group_start();
            $this->db->like("var_name" , $search);
            $this->db->or_like("var_email" , $search);
//            $this->db->or_like("var_username" , $search);
            $this->db->or_like("var_mobile_no" , $search);
            $this->db->group_end();

        }

        $this->db->where('chr_delete','N');        

        $result = $this->db->get();
        $row = $result->result_array();
        //echo $this->db->last_query();die();
        return count($row);
    
    }

    /*------------------------ get records  ------------------------- */
    public function getData($rowno,$rowperpage,$search = '',$_field = 'int_glcode',$_sort = 'desc')
    {          
        $this->db->select('int_glcode,var_name,var_mobile_no,var_email,var_username,var_image,chr_publish,chr_delete,dt_createddate');
        $this->db->from('mst_users');
        $this->db->where('chr_delete','N');        
        $this->db->order_by($_field,$_sort);
        $this->db->limit($rowperpage , $rowno);

        if ($search != '') {

            $this->db->group_start();
            $this->db->like("var_name" , $search);
            $this->db->or_like("var_email" , $search);
//            $this->db->or_like("var_username" , $search);
            $this->db->or_like("var_mobile_no" , $search); 
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
        $this->db->from('mst_users');
        $this->db->where('int_glcode',$userId);
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }

    /*------------------------ get id by record ------------------------- */
    public function getUserByAddress($userId)
    {
        $this->db->select('*');
        $this->db->from('mst_user_address');
        $this->db->where('fk_user',$userId);
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;
    }

    /*------------------------ add record ------------------------- */
    public function addRecord()
    {
        //echo "<pre>"; print_r($_POST); exit();
        if($_FILES['var_image']['name'] != '')
        {
	        if (!is_dir('uploads/user')) {
			 	mkdir('uploads/user', 0777, TRUE);
			}
	            $filename = time().'_'.$_FILES['var_image']['name'];
	            $filename = str_replace('&', "_", $filename);
	            $filename = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename);
	            $destination = 'uploads/user/';
	            move_uploaded_file($_FILES['var_image']['tmp_name'],$destination.$filename);
	        } else {
	            $filename =  '';
	        }

	        $data = array(
		        'var_name' => $this->input->post('var_name'),
		        'var_mobile_no' => $this->input->post('phone'),
                'var_default_no' => $this->input->post('phone'),
		        'var_email' => $this->input->post('email'),
//                'var_username' => $this->input->post('var_username'),
		        'var_password' => $this->mylibrary->cryptPass($this->input->post('password')),
		        'var_image' => $filename,
		        'chr_publish' => 'Y',
		        'chr_delete' => 'N',
		        'dt_createddate' => date('Y-m-d H:i:s'),
		        'dt_modifydate' => date('Y-m-d H:i:s'),
		        'var_ipaddress' => $_SERVER['REMOTE_ADDR']
	     	);

        $id = $this->common_model->insertRow($data, "mst_users");

        if ($id != '') {

            if (isset($_POST['default_status'])) {
                if(in_array('Y', $_POST['default_status']))
                {
                    $get_default_status = 'N';
                }else {
                    $get_default_status = 'Y';
                }
            } else {
                $get_default_status = 'Y';
            }

            $addData = array(
                'fk_user' => $id,
                'var_house_no' => $this->input->post('var_house_no'),
                'var_app_name' => $this->input->post('var_app_name'),
                'var_landmark' => $this->input->post('var_landmark'),
                'var_country' => $this->input->post('var_country'),
                'var_state' => $this->input->post('var_state'),
                'var_city' => $this->input->post('var_city'),
                'var_pincode' => $this->input->post('var_pincode'),
                'chr_type' => 'Home',
                'default_status' => $get_default_status,
                'chr_publish' => 'Y',
                'chr_delete' => 'N',
                'dt_createddate' => date('Y-m-d H:i:s'),
                'dt_modifydate' => date('Y-m-d H:i:s'),
                'var_ipaddress' => $_SERVER['REMOTE_ADDR']
            );

            $this->common_model->insertRow($addData, "mst_user_address");
        }

        $var_email = $this->input->post('email');
        
        // $this->common_model->send_register_user($this->input->post('var_name'),$var_email,$this->input->post('phone'),'U');
        // $this->common_model->send_register_admin($this->input->post('var_name'),$var_email,$this->input->post('var_mobile_no'));

        $house_no = $this->input->post('new_var_house_no');
        $app_name = $this->input->post('new_var_app_name');
        $landmark = $this->input->post('new_var_landmark');
        $country = $this->input->post('new_var_country');
        $state = $this->input->post('new_var_state');
        $city = $this->input->post('new_var_city');
        $pincode = $this->input->post('new_var_pincode');
        $type = $this->input->post('new_address_type');
        $default_status = $this->input->post('default_status');

        if (!empty($house_no)) {
            foreach ($house_no as $key => $value) {
                $tval = $key + 1;
                $mulData = array(
                    'fk_user' => $id,
                    'var_house_no' => $house_no[$key],
                    'var_app_name' => $app_name[$key],
                    'var_landmark' => $landmark[$key],
                    'var_country' => $country[$key],
                    'var_state' => $state[$key],
                    'var_city' => $city[$key],
                    'var_pincode' => $pincode[$key],
                    'chr_type' => $type[$tval],
                    'default_status' => $default_status[$key],
                    'dt_createddate' => date('Y-m-d H:i:s'),
                    'dt_modifydate' => date('Y-m-d H:i:s'),
                    'var_ipaddress' => $_SERVER['REMOTE_ADDR']
                );

                $this->common_model->insertRow($mulData, "mst_user_address");
            }
        }
        
        //echo $this->db->last_query(); exit();
        return TRUE;

    }

    /*---------------------------- update user admin ----------------------*/
    public function updateRecord($userId)
    {
        //echo "<pre>"; print_r($_POST); exit();
        if($_FILES['var_image']['name'] != '')
        {
            if (!is_dir('uploads/user')) {
                mkdir('uploads/user', 0777, TRUE);
            }

            $filename = time().'_'.$_FILES['var_image']['name'];
            $filename = str_replace('&', "_", $filename);
            $filename = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename);
            $destination = 'uploads/user/';
            move_uploaded_file($_FILES['var_image']['tmp_name'],$destination.$filename);
        } else {
            $filename =  $this->input->post('hidvar_image');
        }
       
        $data = array(
	        'var_name' => $this->input->post('var_name'),
	        'var_mobile_no' => $this->input->post('phone'),
	        'var_email' => $this->input->post('email'),
//            'var_username' => $this->input->post('var_username'),
	        'var_password' => $this->mylibrary->cryptPass($this->input->post('var_password')),
	        'var_image' => $filename,
	        'dt_modifydate' => date('Y-m-d H:i:s'),
	        'var_ipaddress' => $_SERVER['REMOTE_ADDR']
     	);

        $this->common_model->updateRow('mst_users', $data, array("int_glcode" => $userId));
        if (isset($_POST['default_status'])) {
            if(in_array('Y', $_POST['var_default_status']))
            {
                $select = "select int_glcode,fk_user,default_status from mst_user_address where fk_user = '".$userId."'";
                $result = $this->db->query($select);
                $resArr = $result->result_array();

                if (count($resArr) > 0) {
                    foreach ($resArr as $key => $value) {
                        $this->db->set('default_status', 'N');
                        $this->db->where('fk_user',$userId);
                        $this->db->update('mst_user_address');
                    }
                }
            }
        }

        $addressId = $this->input->post('fk_address');
        $var_house_no = $this->input->post('var_house_no');
        $var_app_name = $this->input->post('var_app_name');
        $var_landmark = $this->input->post('var_landmark');
        $var_country = $this->input->post('var_country');
        $var_state = $this->input->post('var_state');
        $var_city = $this->input->post('var_city');
        $var_pincode = $this->input->post('var_pincode');
        $var_type = $this->input->post('address_type');
        $var_default_status = $this->input->post('var_default_status');

        if (isset($var_house_no)) {
            foreach ($var_house_no as $okey => $ovalue) {
                $mulData = array(
                    'var_house_no' => $var_house_no[$okey],
                    'var_app_name' => $var_app_name[$okey],
                    'var_landmark' => $var_landmark[$okey],
                    'var_country' => $var_country[$okey],
                    'var_state' => $var_state[$okey],
                    'var_city' => $var_city[$okey],
                    'var_pincode' => $var_pincode[$okey],
                    'chr_type' => $var_type[$okey],
                    'default_status' => $var_default_status[$okey],
                    'dt_modifydate' => date('Y-m-d H:i:s'),
                    'var_ipaddress' => $_SERVER['REMOTE_ADDR']
                );

                $this->common_model->updateRow('mst_user_address', $mulData, array("int_glcode" => $addressId[$okey]));

                //echo $this->db->last_query();
                //exit();
            }
        }

        $house_no = $this->input->post('new_var_house_no');
        $app_name = $this->input->post('new_var_app_name');
        $landmark = $this->input->post('new_var_landmark');
        $country = $this->input->post('new_var_country');
        $state = $this->input->post('new_var_state');
        $city = $this->input->post('new_var_city');
        $pincode = $this->input->post('new_var_pincode');
        $type = $this->input->post('new_address_type');
        $default_status = $this->input->post('default_status');

        if (isset($house_no)) {
            foreach ($house_no as $nkey => $nvalue) {
                $tval = $nkey + 1;
                $newMulData = array(
                    'fk_user' => $userId,
                    'var_house_no' => $house_no[$nkey],
                    'var_app_name' => $app_name[$nkey],
                    'var_landmark' => $landmark[$nkey],
                    'var_country' => $country[$nkey],
                    'var_state' => $state[$nkey],
                    'var_city' => $city[$nkey],
                    'var_pincode' => $pincode[$nkey],
                    'chr_type' => $type[$tval],
                    'default_status' => $default_status[$nkey],
                    'dt_createddate' => date('Y-m-d H:i:s'),
                    'dt_modifydate' => date('Y-m-d H:i:s'),
                    'var_ipaddress' => $_SERVER['REMOTE_ADDR']
                );

                $this->common_model->insertRow($newMulData, "mst_user_address");
            }
        }
        //echo $this->db->last_query(); exit();
        return TRUE;

    }
    
    /*---------------- check email already exit or not --------------*/
    public function checkEmail($eaddress)
    {
        $select = "select int_glcode from mst_users where chr_delete = 'N' and chr_publish = 'Y' and var_email = '".$eaddress."'";
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
        $select = "select int_glcode from mst_users where chr_delete = 'N' and chr_publish = 'Y' and var_mobile_no = '".$mobile."'";
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
            if($this->db->update("mst_users",$data))
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

    public function getExportUser()
    {
        $this->db->select('int_glcode,var_name,var_mobile_no,var_alt_mobile,var_email,dt_createddate');
        $this->db->from('mst_users');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();

        $data = array();

        foreach ($row as $key => $value) {
           
            $value['dt_createddate'] = date('d/m/Y',strtotime($value['dt_createddate']));

            $data[] = $value;
        }

        return $data;
    }
    
}