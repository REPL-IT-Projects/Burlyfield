<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

    public function __construct() {

        parent::__construct();

        $this->load->database();

        $this->load->model('common_model');
    }

    
    /*---------------------- get order rejection reasons --------------------*/
    public function getReasonsData()
    {
        $this->db->select('*');
        $this->db->from('mst_order_reject_reason');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;
    }

    /*---------------------- get banner images --------------------*/
    public function getBannersData()
    {
        $this->db->select('*');
        $this->db->from('mst_home_banners');
        $this->db->where('chr_delete','N');
        $this->db->order_by('int_glcode','desc');
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;
    }

    /*------------------------ get delivery time slot ----------------------*/
    public function getDeliveryTimeslot()
    {
        $this->db->select('*');
        $this->db->from('mst_delivery_timeslot');
        $this->db->order_by('int_glcode','asc');
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;
    }

    /*---------------------- get order rejection reasons --------------------*/
    public function getIdByValue($id)
    {
        $this->db->select('*');
        $this->db->from('mst_order_reject_reason');
        $this->db->where('int_glcode',$id);
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }

    /*---------------------- get order rejection reasons --------------------*/
    public function getIdByValueTimeslot($id)
    {
        $this->db->select('*');
        $this->db->from('mst_delivery_timeslot');
        $this->db->where('int_glcode',$id);
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }

    /*---------------------- get order rejection reasons --------------------*/
    public function getIdByBannerImage($id)
    {
        $this->db->select('*');
        $this->db->from('mst_home_banners');
        $this->db->where('int_glcode',$id);
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }

    /*------------------------ add reasons ------------------------- */
    public function addReasons()
    {
        $data = array(
            'var_title' => $this->input->post('var_title'),
            'chr_publish' => 'Y',
            'chr_delete' => 'N',
            'dt_createddate' => date('Y-m-d H:i:s'),
            'dt_modifydate' => date('Y-m-d H:i:s'),
            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
        );

        $id = $this->common_model->insertRow($data, "mst_order_reject_reason");
        //echo $this->db->last_query(); exit();
           
        return TRUE;

    }

    /*------------------------ add reasons ------------------------- */
    public function addBanners()
    {
        if($_FILES['var_image']['name'] != '')
        {
            if (!is_dir('uploads/banner_img')) {
                mkdir('uploads/banner_img', 0777, TRUE);
            }
                $filename = time().'_'.$_FILES['var_image']['name'];
                $filename = str_replace('&', "_", $filename);
                $filename = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename);
                $destination = 'uploads/banner_img/';
                move_uploaded_file($_FILES['var_image']['tmp_name'],$destination.$filename);
            } else {
                $filename =  '';
            }

        $data = array(
            'var_title' => $this->input->post('var_title'),
            'txt_description' => $this->input->post('txt_description'),
            'var_image' => $filename,
            'chr_publish' => 'Y',
            'chr_delete' => 'N',
            'dt_createddate' => date('Y-m-d H:i:s'),
            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
        );

        $id = $this->common_model->insertRow($data, "mst_home_banners");
        //echo $this->db->last_query(); exit();
           
        return TRUE;

    }

    /*-------------------------- update reason ------------------------------*/
    public function updateReason()
    {
        $id = $this->input->post('fk_reason');
        $data = array(
            'var_title' => $this->input->post('var_title'),
            'dt_modifydate' => date('Y-m-d H:i:s'),
            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
        );

        $this->common_model->updateRow('mst_order_reject_reason', $data, array("int_glcode" => $id)); 

        return TRUE;

    }

    /*-------------------------- update banners ------------------------------*/
    public function updateBanners()
    {
        $id = $this->input->post('fk_banner');

        if($_FILES['var_image']['name'] != '')
        {
            if (!is_dir('uploads/banner_img')) {
                mkdir('uploads/banner_img', 0777, TRUE);
            }
                $filename = time().'_'.$_FILES['var_image']['name'];
                $filename = str_replace('&', "_", $filename);
                $filename = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename);
                $destination = 'uploads/banner_img/';
                move_uploaded_file($_FILES['var_image']['tmp_name'],$destination.$filename);
            } else {
                $filename =  $this->input->post('hidvar_image');
            }
        
        $data = array(
            'var_title' => $this->input->post('var_title'),
            'txt_description' => $this->input->post('txt_description'),
            'var_image' => $filename,
            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
        );

        $this->common_model->updateRow('mst_home_banners', $data, array("int_glcode" => $id)); 

        return TRUE;

    }

    // edit offer 2

    public function offer_two()
    {
        $id = 14;

        if($_FILES['var_image']['name'] != '')
        {
            if (!is_dir('uploads/banner_img')) {
                mkdir('uploads/banner_img', 0777, TRUE);
            }
                $filename = time().'_'.$_FILES['var_image']['name'];
                $filename = str_replace('&', "_", $filename);
                $filename = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename);
                $destination = 'uploads/banner_img/';
                move_uploaded_file($_FILES['var_image']['tmp_name'],$destination.$filename);
            } else {
                $filename =  $this->input->post('hidvar_image');
            }
        
        $data = array(
            'fk_category'=> $this->input->post('fk_category'),
            'var_title' => $this->input->post('var_title'),
            'txt_description' => $this->input->post('txt_description'),
            'var_image' => $filename,
            'offer' => $this->input->post('offer'),
            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
        );

        $this->common_model->updateRow('mst_home_banners', $data, array("int_glcode" => $id)); 

        return TRUE;

    }

    public function get_categories()
    {
        $this->db->select('int_glcode,fk_parent,var_title');
        $this->db->from('mst_category');
        $this->db->where('fk_parent', 0);
        $this->db->where('chr_publish', 'Y');
        $this->db->where('chr_delete', 'N');

        $parent = $this->db->get();
        
        $categories = $parent->result_array();

        return $categories;
    }

    // edit offer 1

    public function offer_one()
    {
        $id = 13;

        if($_FILES['var_image']['name'] != '')
        {
            if (!is_dir('uploads/banner_img')) {
                mkdir('uploads/banner_img', 0777, TRUE);
            }
                $filename = time().'_'.$_FILES['var_image']['name'];
                $filename = str_replace('&', "_", $filename);
                $filename = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename);
                $destination = 'uploads/banner_img/';
                move_uploaded_file($_FILES['var_image']['tmp_name'],$destination.$filename);
            } else {
                $filename =  $this->input->post('hidvar_image');
            }
        
        $data = array(
            'fk_category'=> $this->input->post('fk_category'),            
            'var_title' => $this->input->post('var_title'),
            'txt_description' => $this->input->post('txt_description'),
            'var_image' => $filename,
            'offer' => $this->input->post('offer'),
            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
        );

        $this->common_model->updateRow('mst_home_banners', $data, array("int_glcode" => $id)); 

        return TRUE;

    }

    /*------------------------ add timeslot ------------------------- */
    public function addTimeslot()
    {
        $data = array(
            'dt_start_time' => $this->input->post('dt_start_time'),
            'dt_end_time' => $this->input->post('dt_end_time'),
            'dt_slot_end_time' => $this->input->post('dt_slot_end_time'),
            'chr_type' => $this->input->post('delivery_type'),
            'dt_createddate' => date('Y-m-d H:i:s'),
            'dt_modifydate' => date('Y-m-d H:i:s'),
        );

        $id = $this->common_model->insertRow($data, "mst_delivery_timeslot");
        //echo $this->db->last_query(); exit();
           
        return TRUE;

    }

    /*------------------------ add reasons ------------------------- */
    public function updateTimeslot()
    {
        $id = $this->input->post('fk_timeslot');

        $data = array(
            'dt_start_time' => $this->input->post('dt_start_time'),
            'dt_end_time' => $this->input->post('dt_end_time'),
            'dt_slot_end_time' => $this->input->post('dt_slot_end_time'),
            'chr_type' => $this->input->post('delivery_type'),
            'dt_createddate' => date('Y-m-d H:i:s'),
            'dt_modifydate' => date('Y-m-d H:i:s'),
        );

        $this->common_model->updateRow('mst_delivery_timeslot', $data, array("int_glcode" => $id)); 
        //echo $this->db->last_query(); exit();
           
        return TRUE;

    }

    /*-------------------------------- delete multiple -------------------------*/
    public function delete_multiple($tbl_name)
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
            if($this->db->update($tbl_name,$data))
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

    /*-------------------------------- delete multiple -------------------------*/
    public function delete_multiple_timeslot($tbl_name)
    {
        $id = [];
        $id = $_POST['id'];
        $i = 0;

        foreach ($id as $key => $value) {
            
        //$this->db->set('column_header', $value); //value that used to update column  
            $this->db->where('int_glcode', $value);
            if($this->db->delete($tbl_name))
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

}