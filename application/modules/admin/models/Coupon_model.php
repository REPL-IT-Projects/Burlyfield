<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Coupon_model extends CI_Model {

    public function __construct() {

        parent::__construct();

        $this->load->database();

        $this->load->model('common_model');
    }



     function coupon_count($search = ''){

        $this->db->select('*');
        $this->db->from('mst_promocode'); 
               

        if ($search != '') {

        $this->db->group_start();
        $this->db->like("var_promocode" , $search);
        $this->db->group_end();

        }
        $this->db->where('fk_user',0);
        $this->db->where('chr_delete','N');        

        $result = $this->db->get();
        $row = $result->result_array();
        //echo $this->db->last_query();die();
        return count($row);
    
    }

    function getcouponData($rowno,$rowperpage,$search = '',$_field = 'int_glcode',$_sort = 'desc'){          
            $this->db->select('*');
            $this->db->from('mst_promocode');
            $this->db->where('chr_delete','N');  
            $this->db->where('fk_user',0);  
            $this->db->order_by($_field,$_sort);
            $this->db->limit($rowperpage , $rowno);

            if ($search != '') {

                $this->db->group_start();
                $this->db->like("var_promocode" , $search);
                $this->db->group_end();

            }

            $result = $this->db->get();
            $row = $result->result_array();

            return $row;
        
    }

    //////////////////////// add category /////////////////////////////////
    //////////////////////////////////////////////////////////////////
    public function addcoupon()
    {

        $data = array(
         'var_promocode' => $this->input->post('var_promocode'),
         'no_of_time' => $this->input->post('no_of_time'),
         'expiry_date' => $this->input->post('expiry_date'),
         'var_price' => $this->input->post('var_price'),
         'var_percentage' => $this->input->post('var_percentage'),
         'min_order' => $this->input->post('min_order'),   
         'txt_description' => $this->input->post('txt_description'),   
         'chr_publish' => 'Y',
         'chr_delete' => 'N',
         'dt_createddate' => date('Y-m-d H:i:s'),
         'dt_modifydate' => date('Y-m-d H:i:s'),
         'var_ipaddress' => $_SERVER['REMOTE_ADDR']
        );

        $GetID = $this->common_model->insertRow($data, "mst_promocode");

        return $GetID;

    }

     //////////////////////// update category /////////////////////////////////
    //////////////////////////////////////////////////////////////////
    public function updatecoupon($id)
    {

        $data = array(
         'var_promocode' => $this->input->post('var_promocode'),
         'no_of_time' => $this->input->post('no_of_time'),
         'expiry_date' => $this->input->post('expiry_date'),
         'var_price' => $this->input->post('var_price'),
         'min_order' => $this->input->post('min_order'),
         'var_percentage' => $this->input->post('var_percentage'),
         'txt_description' => $this->input->post('txt_description'),
         'dt_modifydate' => date('Y-m-d H:i:s')
        );

        $GetID = $this->common_model->updateRow('mst_promocode', $data, array('int_glcode' => $id)); 

        return $GetID;

    }

      /////////////////// get id by users list //////////////////
    ////////////////////////////////////////////////////
    public function coupon_edit($cate_id)
    {
        $this->db->select('*');
        $this->db->from('mst_promocode');
        $this->db->where('int_glcode',$cate_id);
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }
    


    ////////////////////////////// delete multiple ////////////////////////////////
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
            if($this->db->update("mst_promocode",$data))
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

    ////////////////////////// update publish ////////////////////////
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