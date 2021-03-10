<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends CI_Model {

    
    public function __construct() {
        
        parent::__construct();
        $this->load->database();
        $this->load->model('common_model');
        $this->load->library('image_lib');
    }
   
    public function records_count($search = ''){

        $this->db->select('int_glcode');
        $this->db->where('fk_vendor',$_SESSION['fk_vendor']);  
        $this->db->from('mst_products');        


        $this->db->where('chr_delete','N');        

        $result = $this->db->get();
        $row = $result->result_array();
        
        return count($row);
    
    }
    
    /*------------------------ get records  ------------------------- */
    public function getData($rowno,$rowperpage,$search = '',$_field = 'int_glcode',$_sort = 'desc')
    {          
        $this->db->select('mb.*,mc.var_title as cate_name');
        $this->db->from('mst_products mb');
        $this->db->join('mst_category mc', 'mc.int_glcode = mb.fk_category', 'left');
        $this->db->where('mb.fk_vendor',$_SESSION['fk_vendor']);  
        $this->db->where('mb.chr_delete','N');        
        $this->db->order_by($_field,$_sort);
        $this->db->limit($rowperpage , $rowno);

        if ($search != '') {

            $this->db->group_start();
            $this->db->like("mb.var_title" , $search);
            $this->db->or_like("mc.var_title" , $search);
            $this->db->group_end();
        }
        $result = $this->db->get();
        //echo $this->db->last_query();
        $row = $result->result_array();
        
        $data = array();

        foreach ($row as $key => $value) {
            $price_details = $this->getProductPriceDetails($value['int_glcode']);
            
            if (count($price_details) > 0) {
                $price = '';
                foreach ($price_details as $pkey => $pval) { 
                   $price .= $pval['var_quantity'] .'=>'. ' Rs '.$pval['var_price'].' , ';
                }
                $price_name = rtrim($price, ' , ');

                $value['price_details'] = $price_name;
            } else {
                $value['price_details'] = 'N/A';
            }

            $data[] = $value;
        }
        
        return $data;
    }

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
    
    /*------------------------ get id by record ------------------------- */
    public function getIdByData($userId)
    {
        $this->db->select('*');
        $this->db->from('mst_products');
        $this->db->where('int_glcode',$userId);
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->row_array();

        return $row;
    }

    /*-------------------------- get vendor listing ----------------------- */
    public function getVendor()
    {
        $this->db->select('int_glcode,var_name');
        $this->db->from('mst_vendors');
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();

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
        if($_FILES['var_cimg']['name'] != '')
        {
            if (!is_dir('uploads/products')) {
                mkdir('uploads/products', 0777, TRUE);
            }
                $filename = time().'_'.$_FILES['var_cimg']['name'];
                $filename = str_replace('&', "_", $filename);
                $filename = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename);
                $destination = 'uploads/products/';
                move_uploaded_file($_FILES['var_cimg']['tmp_name'],$destination.$filename);

                if (!is_dir('uploads/products/thumb_img')) {
                    mkdir('uploads/products/thumb_img', 0777, TRUE);
                }

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $destination.$filename;
                    $config['new_image'] =  'uploads/products/thumb_img/'.$filename;
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']     = 100;
                    $config['height']   = 100;

                    $this->image_lib->clear();
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
            } else {
                $filename =  '';
            }
        //echo "<pre>"; print_r($_FILES); exit(); 
        //echo "<pre>"; print_r($_POST); exit();
        $data = array(
	        'fk_category' => $this->input->post('fk_category'),
            'fk_vendor' => $this->input->post('fk_vendor'),
	        'var_title' => $this->input->post('var_name'),
            'var_image' => $filename,
            'var_short_description' => $this->input->post('var_short_desc'),
	        'txt_description' => $this->input->post('var_description'),
            'var_offer' => $this->input->post('var_offer'),
            'txt_nutrition' => $this->input->post('txt_nutrition'),
	        'chr_publish' => 'Y',
	        'chr_delete' => 'N',
	        'dt_createddate' => date('Y-m-d H:i:s'),
	        'dt_modifydate' => date('Y-m-d H:i:s'),
	        'var_ipaddress' => $_SERVER['REMOTE_ADDR']
     	);

        $id = $this->common_model->insertRow($data, "mst_products");
        if (isset($_POST['var_quantity'])) {
            $quantity_Arr = $_POST['var_quantity'];

            $price_Arr = $_POST['var_price'];
            $percentage = $this->input->post('var_offer');
            foreach ($quantity_Arr as $qkey => $qval) {
                $total_price = $price_Arr[$qkey];
                $price = ($percentage / 100) * $total_price;
                $discount_price = number_format($total_price - $price,2);

                    $data = array(
                        'fk_product' => $id,
                        'var_quantity' => $qval,
                        'var_price' => $price_Arr[$qkey],
                        'var_discount_price' => $discount_price,
                        'dt_createddate' => date('Y-m-d H:i:s')
                    );

                    $this->common_model->insertRow($data, "trn_product_price");
            }
        }
        

        //echo $this->db->last_query(); exit();
        
        // echo "<pre>"; print_r($_POST);
        //  echo "<pre>"; print_r($_FILES); exit();
        if (isset($_FILES['var_image'])) {
            $images = $_FILES['var_image']['name'];
            foreach ($images as $key => $value) {
                if (!is_dir('uploads/products')) {
                    mkdir('uploads/products', 0777, TRUE);
                }
                    $filename = time().'_'.$images[$key];
                    $filename = str_replace('&', "_", $filename);
                    $filename = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename);
                    $destination = 'uploads/products/';
                    move_uploaded_file($_FILES['var_image']['tmp_name'][$key],$destination.$filename);
                
                $data = array(
                    'fk_product' => $id,
                    'var_images' => $filename,
                    'dt_createddate' => date('Y-m-d H:i:s'),
                    'var_ipaddress' => $_SERVER['REMOTE_ADDR']
                );

                $this->common_model->insertRow($data, "trn_product_images");
            }
        }

        return TRUE;

    }

    /*---------------------------- update record ----------------------*/
    public function updateRecord($Id)
    {
        //echo "<pre>"; print_r($_POST); exit();
        //$quantity = array();
        // foreach ($_POST['var_quantity'] as $key => $value) {
        //     $quantity[] = array('var_quantity'=>$value);
        // }
        // echo "<pre>"; print_r($quantity); exit();
        

        if($_FILES['var_cimg']['name'] != '')
        {
            if (!is_dir('uploads/products')) {
                mkdir('uploads/products', 0777, TRUE);
            }

            $cover_file = time().'_'.$_FILES['var_cimg']['name'];
            $cover_file = str_replace('&', "_", $cover_file);
            $cover_file = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $cover_file);
            $destination = 'uploads/products/';
            move_uploaded_file($_FILES['var_cimg']['tmp_name'],$destination.$cover_file);

                if (!is_dir('uploads/products/thumb_img')) {
                    mkdir('uploads/products/thumb_img', 0777, TRUE);
                }

                $config['image_library'] = 'gd2';
                $config['source_image'] = $destination.$cover_file;
                $config['new_image'] =  'uploads/products/thumb_img/'.$cover_file;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width']     = 100;
                $config['height']   = 100;

                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                $this->image_lib->resize();

        } else {
            $cover_file =  $this->input->post('hidvar_image');
            $destination = 'uploads/products/';
            $config['image_library'] = 'gd2';
            $config['source_image'] = $destination.$cover_file;
            $config['new_image'] =  'uploads/products/thumb_img/'.$cover_file;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width']     = 100;
            $config['height']   = 100;

            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }

        // echo "<pre>"; print_r($_POST);
        //  echo "<pre>"; print_r($_FILES); exit();
        if (isset($_FILES['var_image'])) {
        $images = $_FILES['var_image']['name'];
            foreach ($images as $key => $value) {
                if (!is_dir('uploads/products')) {
                    mkdir('uploads/products', 0777, TRUE);
                }
                    $filename = time().'_'.$images[$key];
                    $filename = str_replace('&', "_", $filename);
                    $filename = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename);
                    $destination = 'uploads/products/';
                    move_uploaded_file($_FILES['var_image']['tmp_name'][$key],$destination.$filename);
                
                $data = array(
                    'fk_product' => $Id,
                    'var_images' => $filename,
                    'dt_createddate' => date('Y-m-d H:i:s'),
                    'var_ipaddress' => $_SERVER['REMOTE_ADDR']
                );

                $this->common_model->insertRow($data, "trn_product_images");
            }
        }
       
        $data = array(
            'fk_category' => $this->input->post('fk_category'),
            'fk_vendor' => $this->input->post('fk_vendor'),
            'var_title' => $this->input->post('var_name'),
            'var_image' => $cover_file,
            'var_short_description' => $this->input->post('var_short_desc'),
            'txt_description' => $this->input->post('var_description'),
            'var_offer' => $this->input->post('var_offer'),
            'txt_nutrition' => $this->input->post('txt_nutrition'),
            'dt_createddate' => date('Y-m-d H:i:s'),
            'var_ipaddress' => $_SERVER['REMOTE_ADDR']
        );

        $this->common_model->updateRow('mst_products', $data, array("int_glcode" => $Id)); 

        if (isset($_POST['var_quantity']) && !empty($_POST['var_quantity'])) {
            $price_id = $this->input->post('price_id');
            $quantity_Arr = $_POST['var_quantity'];
            $price_Arr = $_POST['var_price'];
            $percentage = $this->input->post('var_offer');
            foreach ($quantity_Arr as $qkey => $qval) {

                $total_price = $price_Arr[$qkey];
                $price = number_format(($percentage / 100) * $total_price,2);
                $discount_price = number_format($total_price - $price,2);

                    $data = array(
                        'fk_product' => $Id,
                        'var_quantity' => $qval,
                        'var_price' => $price_Arr[$qkey],
                        'var_discount_price' => $discount_price,
                        'dt_createddate' => date('Y-m-d H:i:s')
                    );

                    $this->common_model->updateRow("trn_product_price",$data,array("int_glcode" => $price_id[$qkey]));
            }
        }

        if (isset($_POST['var_quantity_new'])) {
        	$quantity_Arr_new = $_POST['var_quantity_new'];
        	$price_Arr_new = $_POST['var_price_new'];

	        if (!empty($quantity_Arr_new)) {
	            foreach ($quantity_Arr_new as $qnkey => $qnval) {
	                $data = array(
	                    'fk_product' => $Id,
	                    'var_quantity' => $qnval,
	                    'var_price' => $price_Arr_new[$qnkey],
	                    'dt_createddate' => date('Y-m-d H:i:s')
	                );

	                $this->common_model->insertRow($data, "trn_product_price");
	            }
	        }
        }
        
        //echo $this->db->last_query(); exit();
        return TRUE;

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
            if($this->db->update("mst_products",$data))
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

    public function get_categories()
    {
        $this->db->select('int_glcode,fk_parent,var_title');
        $this->db->from('mst_category');
        $this->db->where('fk_parent', 0);
        $this->db->where('chr_publish', 'Y');
        $this->db->where('chr_delete', 'N');

        $parent = $this->db->get();
        
        $categories = $parent->result();
        $i=0;

        foreach($categories as $p_cat){

            $categories[$i]->sub = $this->get_sub_categories($p_cat->int_glcode);
            $i++;
        }
        
        $cateArr = json_decode(json_encode($categories,true));

        //echo "<pre>"; print_r($cateArr); exit();

        return $cateArr;
    }
    
    public function get_sub_categories($category_id)
    {
        $this->db->select('int_glcode,fk_parent,var_title');
        $this->db->from('mst_category');
        $this->db->where('fk_parent', $category_id);
        $this->db->where('chr_publish', 'Y');
        $this->db->where('chr_delete', 'N');

        $child = $this->db->get();
        $categories = $child->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->sub = $this->get_sub_categories($p_cat->int_glcode);
            $i++;
        }
        //$cateArr = json_decode(json_encode($categories,true));
        return $categories;  
    }
    
}