<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonial_model extends CI_Model {

	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		$this->load->model('common_model');
	}

    /*------------------------ get records count ------------------------- */
    public function records_count($search = ''){

        $this->db->select('*');
        $this->db->from('mst_testimonial');        

        if ($search != '') {

            $this->db->group_start();
            $this->db->like("var_name" , $search);
            $this->db->or_like("var_position" , $search);
            $this->db->or_like("txt_description" , $search);
            $this->db->or_like("var_image" , $search); 
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
        $this->db->select('*');
        $this->db->from('mst_testimonial');
        $this->db->where('chr_delete','N');        
        $this->db->order_by($_field,$_sort);
        $this->db->limit($rowperpage , $rowno);

        if ($search != '') {

            $this->db->group_start();
            $this->db->like("var_name" , $search);
            $this->db->or_like("var_position" , $search);
            $this->db->or_like("txt_description" , $search);
            $this->db->or_like("var_image" , $search); 
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
        $this->db->from('mst_testimonial');
        $this->db->where('int_glcode',$userId);
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }


    /*------------------------ add record ------------------------- */
    public function addRecord()
    {
        //echo "<pre>"; print_r($_POST); exit();
        if($_FILES['var_image']['name'] != '')
        {
	        if (!is_dir('uploads/testimonial')) {
			 	mkdir('uploads/testimonial', 0777, TRUE);
			}
	            $filename = time().'_'.$_FILES['var_image']['name'];
	            $filename = str_replace('&', "_", $filename);
	            $filename = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename);
	            $destination = 'uploads/testimonial/';
	            move_uploaded_file($_FILES['var_image']['tmp_name'],$destination.$filename);
	        } else {
	            $filename =  '';
	        }

	        $data = array(
		        'var_name' => $this->input->post('var_name'),
		        'var_position' => $this->input->post('var_position'),
		        'txt_description' => $this->input->post('txt_description'),
		        'var_image' => $filename,
		        'chr_publish' => 'Y',
		        'chr_delete' => 'N',
		        'dt_createddate' => date('Y-m-d H:i:s'),
		        'dt_modifydate' => date('Y-m-d H:i:s'),
		        'var_ipaddress' => $_SERVER['REMOTE_ADDR']
	     	);

        $id = $this->common_model->insertRow($data, "mst_testimonial");
        
        //echo $this->db->last_query(); exit();
        return TRUE;

    }

    /*---------------------------- update user admin ----------------------*/
    public function updateRecord($userId)
    {
        //echo "<pre>"; print_r($_POST); exit();
        if($_FILES['var_image']['name'] != '')
        {
            if (!is_dir('uploads/testimonial')) {
                mkdir('uploads/testimonial', 0777, TRUE);
            }

            $filename = time().'_'.$_FILES['var_image']['name'];
            $filename = str_replace('&', "_", $filename);
            $filename = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename);
            $destination = 'uploads/testimonial/';
            move_uploaded_file($_FILES['var_image']['tmp_name'],$destination.$filename);
        } else {
            $filename =  $this->input->post('hidvar_image');
        }
       
        $data = array(
	        'var_name' => $this->input->post('var_name'),
                'var_position' => $this->input->post('var_position'),
                'txt_description' => $this->input->post('txt_description'),
	        'var_image' => $filename,
	        'dt_modifydate' => date('Y-m-d H:i:s'),
	        'var_ipaddress' => $_SERVER['REMOTE_ADDR']
     	);

        $this->common_model->updateRow('mst_testimonial', $data, array("int_glcode" => $userId));
       
        //echo $this->db->last_query(); exit();
        return TRUE;

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
            if($this->db->update("mst_testimonial",$data))
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