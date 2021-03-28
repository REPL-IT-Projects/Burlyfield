<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

	
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		$this->load->model('common_model');
        $this->load->library('image_lib');
	}

    /*------------------------ get records count ------------------------- */
    public function records_count($search = ''){

        $this->db->select('int_glcode');
        $this->db->from('mst_products');        

        if ($search != '') {

        $this->db->group_start();
        $this->db->like("var_title" , $search);
        
        $this->db->group_end();

        }

        $this->db->where('chr_delete','N');        

        $result = $this->db->get();
        $row = $result->result_array();
        //echo $this->db->last_query();die();
        return count($row);
    
    }

    /*------------------------ get records  ------------------------- */
    public function getData($rowno,$rowperpage,$search = '',$_field = 'int_glcode',$_sort = 'desc',$category='',$vendor='')
    {          
        $this->db->select('mp.*,mc.var_title as cate_name,mv.var_name');
        $this->db->from('mst_products mp');
        $this->db->join('mst_category mc', 'mc.int_glcode = mp.fk_category', 'left');
        $this->db->join('mst_vendors mv', 'mv.int_glcode = mp.fk_vendor', 'left');
        $this->db->where('mp.chr_delete','N');        
        $this->db->order_by($_field,$_sort);
        $this->db->limit($rowperpage , $rowno);

        if ($search != '') {

            $this->db->group_start();
            $this->db->like("mp.var_title" , $search);
            $this->db->or_like("mc.var_title" , $search);
            $this->db->or_like("mv.var_name" , $search);
            $this->db->group_end();
        }
        if($category != ''){
            $this->db->where('mp.fk_category',$category);  
        }
        if($vendor != ''){
            $this->db->where('mp.fk_vendor',$vendor);  
        }
        $result = $this->db->get();
        //echo $this->db->last_query(); exit();
        $row = $result->result_array();

        $data = array();

        foreach ($row as $key => $value) {
            $price_details = $this->getProductPriceDetails($value['int_glcode']);
            
            if (count($price_details) > 0) {
                $price = '';
                foreach ($price_details as $pkey => $pval) { 
                   $price .= $pval['var_quantity'] .'=>'. ' &#8377; '.$pval['var_price'].' , ';
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

    /*------------------------ get product export -------------------- */
    public function getExportProducts()
    {
        $this->db->select('mp.int_glcode,mp.fk_category,mp.var_title,mp.var_short_description,mp.txt_description,mp.var_offer,mp.txt_nutrition,mp.chr_delete,mp.dt_createddate,mc.var_title as cate_name,v.var_name');
        $this->db->from('mst_products mp');
        $this->db->join('mst_vendors v', 'v.int_glcode = mp.fk_vendor', 'left');
        $this->db->join('mst_category mc', 'mc.int_glcode = mp.fk_category', 'left');
        $this->db->where('mp.chr_delete','N');       
        $query = $this->db->get();
        $row = $query->result_array();
        //echo "<pre>"; print_r($row); exit();

        $data = array();

        foreach ($row as $key => $value) {
            $price_details = $this->getProductPriceDetails($value['int_glcode']);
            
            if (count($price_details) > 0) {
                $price = '';
                foreach ($price_details as $pkey => $pval) { 
                   $price .= $pval['var_quantity'].'='.$pval['var_price'].',';
                }

                $price_name = array_map('trim',array_filter(explode(',',$price)));

                $final_price = implode(',', $price_name);

                $value['price_details'] = $final_price;
            } else {
                $value['price_details'] = 'N/A';
            }

            $value['dt_createddate'] = date('d/m/Y',strtotime($value['dt_createddate']));

            $data[] = $value;
        }
        
        return $data;
    }

    public function trim_value(&$value) 
    { 
        $value = trim($value);

        return $value; 
    }

    /*------------------------ get id by record ------------------------- */
    public function getIdByData($Id)
    {
        $this->db->select('*');
        $this->db->from('mst_products');
        $this->db->where('int_glcode',$Id);
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->row_array();
        //echo "<pre>"; print_r($row); exit();
        return $row;
    }

    /*------------------------ get category ------------------------- */
    public function getCategory()
    {
        $this->db->select('*');
        $this->db->from('mst_category');
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;
    }
    
    public function get_vendor()
    {
        $this->db->select('int_glcode,var_name');
        $this->db->from('mst_vendors');
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;
    }
    
    public function get_category()
    {
        $this->db->select('int_glcode,var_title');
        $this->db->from('mst_category');
        $this->db->where('chr_publish','Y');
        $this->db->where('chr_delete','N');
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;
    }

    function getPincode(){

            

            $this->db->select('*');

            $this->db->from('mst_pincode');

            $this->db->where('chr_delete','N');

            $this->db->where('flag','E');

            $query = $this->db->get();

            $row = $query->result_array();



            return $row;

        }

    /*------------------------ get product multiple images ----------------------- */
    public function getVendorDocuments($productId)
    {
        $this->db->select('int_glcode,fk_product,var_images,display_order');
        $this->db->from('trn_product_images ');
        $this->db->where('fk_product',$productId);
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;
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

    /*------------------------ add record ------------------------- */
    public function addRecord()
    {
        // $var_pincode = $this->input->post('var_pincode');
        
        // echo "<pre>"; print_r($var_pincode); die();
		//image 1
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
			// image 1
			 if($_FILES['var_img']['name'] != '')
        {
            if (!is_dir('uploads/products')) {
                mkdir('uploads/products', 0777, TRUE);
            }
                $filename1 = time().'_'.$_FILES['var_img']['name'];
                $filename1 = str_replace('&', "_", $filename1);
                $filename1 = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename1);
                $destination1 = 'uploads/products/';
                move_uploaded_file($_FILES['var_img']['tmp_name'],$destination1.$filename1);

                if (!is_dir('uploads/products/thumb_img')) {
                    mkdir('uploads/products/thumb_img', 0777, TRUE);
                }

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $destination1.$filename1;
                    $config['new_image'] =  'uploads/products/thumb_img/'.$filename1;
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']     = 100;
                    $config['height']   = 100;

                    $this->image_lib->clear();
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
            } else {
                $filename1 =  '';
            }
			// image 2
			 if($_FILES['var_img2']['name'] != '')
        {
            if (!is_dir('uploads/products')) {
                mkdir('uploads/products', 0777, TRUE);
            }
                $filename2 = time().'_'.$_FILES['var_img2']['name'];
                $filename2 = str_replace('&', "_", $filename2);
                $filename2 = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename2);
                $destination1 = 'uploads/products/';
                move_uploaded_file($_FILES['var_img']['tmp_name'],$destination2.$filename2);

                if (!is_dir('uploads/products/thumb_img')) {
                    mkdir('uploads/products/thumb_img', 0777, TRUE);
                }

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $destination2.$filename2;
                    $config['new_image'] =  'uploads/products/thumb_img/'.$filename2;
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']     = 100;
                    $config['height']   = 100;

                    $this->image_lib->clear();
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
            } else {
                $filename2 =  '';
            }
         // image 3
			 if($_FILES['var_img3']['name'] != '')
        {
            if (!is_dir('uploads/products')) {
                mkdir('uploads/products', 0777, TRUE);
            }
                $filename3 = time().'_'.$_FILES['var_img3']['name'];
                $filename3 = str_replace('&', "_", $filename3);
                $filename3 = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $filename3);
                $destination1 = 'uploads/products/';
                move_uploaded_file($_FILES['var_img']['tmp_name'],$destination3.$filename3);

                if (!is_dir('uploads/products/thumb_img')) {
                    mkdir('uploads/products/thumb_img', 0777, TRUE);
                }

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $destination3.$filename3;
                    $config['new_image'] =  'uploads/products/thumb_img/'.$filename3;
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']     = 100;
                    $config['height']   = 100;

                    $this->image_lib->clear();
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
            } else {
                $filename3 =  '';
            }
         
        //echo "<pre>"; print_r($_POST); exit();
        $data = array(
	        'fk_category' => $this->input->post('fk_category'),
            
	        'var_title' => $this->input->post('var_name'),
            'var_image' => $filename,
			 'var_image1' => $filename1,
			  'var_image2' => $filename2,
			   'var_image3' => $filename3,
            'var_short_description' => $this->input->post('var_short_desc'),
	        'txt_description' => $this->input->post('var_description'),
            'var_offer' => $this->input->post('var_offer'),
            'var_stock' => $this->input->post('var_stock'),
            'var_gst' => $this->input->post('var_gst'),
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
        
//image update
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
		 //vaishali magar 15-03-2021
		 //image 1
        if($_FILES['var_img']['name'] != '')
        {
            if (!is_dir('uploads/products')) {
                mkdir('uploads/products', 0777, TRUE);
            }

            $cover_file1 = time().'_'.$_FILES['var_img']['name'];
            $cover_file1 = str_replace('&', "_", $cover_file1);
            $cover_file1 = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $cover_file1);
            $destination1 = 'uploads/products/';
            move_uploaded_file($_FILES['var_img']['tmp_name'],$destination1.$cover_file1);

                if (!is_dir('uploads/products/thumb_img')) {
                    mkdir('uploads/products/thumb_img', 0777, TRUE);
                }

                $config['image_library'] = 'gd2';
                $config['source_image'] = $destination1.$cover_file1;
                $config['new_image'] =  'uploads/products/thumb_img/'.$cover_file1;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width']     = 100;
                $config['height']   = 100;

                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                $this->image_lib->resize();

        } else {
            $cover_file1 =  $this->input->post('hidvar_image1');
            $destination1 = 'uploads/products/';
            $config['image_library'] = 'gd2';
            $config['source_image'] = $destination1.$cover_file1;
            $config['new_image'] =  'uploads/products/thumb_img/'.$cover_file1;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width']     = 100;
            $config['height']   = 100;

            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }
		 //vaishali magar 25-03-2021
		 //image 2
        if($_FILES['var_img2']['name'] != '')
        {
            if (!is_dir('uploads/products')) {
                mkdir('uploads/products', 0777, TRUE);
            }

            $cover_file2 = time().'_'.$_FILES['var_img2']['name'];
            $cover_file2 = str_replace('&', "_", $cover_file2);
            $cover_file2 = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $cover_file2);
            $destination2 = 'uploads/products/';
            move_uploaded_file($_FILES['var_img2']['tmp_name'],$destination2.$cover_file2);

                if (!is_dir('uploads/products/thumb_img')) {
                    mkdir('uploads/products/thumb_img', 0777, TRUE);
                }

                $config['image_library'] = 'gd2';
                $config['source_image'] = $destination2.$cover_file2;
                $config['new_image'] =  'uploads/products/thumb_img/'.$cover_file2;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width']     = 100;
                $config['height']   = 100;

                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                $this->image_lib->resize();

        } else {
            $cover_file2 =  $this->input->post('hidvar_image2');
            $destination2 = 'uploads/products/';
            $config['image_library'] = 'gd2';
            $config['source_image'] = $destination2.$cover_file2;
            $config['new_image'] =  'uploads/products/thumb_img/'.$cover_file2;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width']     = 100;
            $config['height']   = 100;

            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }
		 //vaishali magar 25-03-2021
		 //image 3
        if($_FILES['var_img3']['name'] != '')
        {
            if (!is_dir('uploads/products')) {
                mkdir('uploads/products', 0777, TRUE);
            }

            $cover_file3 = time().'_'.$_FILES['var_img3']['name'];
            $cover_file3 = str_replace('&', "_", $cover_file3);
            $cover_file3 = preg_replace('/[^a-zA-Z0-9\[\]\.(\)&-\']/s', '', $cover_file3);
            $destination3 = 'uploads/products/';
            move_uploaded_file($_FILES['var_img3']['tmp_name'],$destination3.$cover_file3);

                if (!is_dir('uploads/products/thumb_img')) {
                    mkdir('uploads/products/thumb_img', 0777, TRUE);
                }

                $config['image_library'] = 'gd2';
                $config['source_image'] = $destination3.$cover_file3;
                $config['new_image'] =  'uploads/products/thumb_img/'.$cover_file3;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width']     = 100;
                $config['height']   = 100;

                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                $this->image_lib->resize();

        } else {
            $cover_file3 =  $this->input->post('hidvar_image3');
            $destination3 = 'uploads/products/';
            $config['image_library'] = 'gd2';
            $config['source_image'] = $destination3.$cover_file3;
            $config['new_image'] =  'uploads/products/thumb_img/'.$cover_file3;
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
            
            'var_title' => $this->input->post('var_name'),
            'var_image' => $cover_file,
			'var_image1' => $cover_file1,
			'var_image2' => $cover_file2,
			'var_image3' => $cover_file3,
            'var_short_description' => $this->input->post('var_short_desc'),
            'txt_description' => $this->input->post('var_description'),
            'var_offer' => $this->input->post('var_offer'),
            'var_stock' => $this->input->post('var_stock'),
            'var_gst' => $this->input->post('var_gst'),
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
    function getPincodedata($id){

            

            $this->db->select('qc.*');

            $this->db->join('mst_pincode qc','qc.int_glcode = q.fk_pincode');

            $this->db->from('mst_product_pincode q');

            $this->db->where('q.fk_product',$id);

            $query = $this->db->get();

            $row = $query->result_array();



            return $row;

        }

    /*--------------------------- csv file export ---------------------------*/
  public function uploadProductPrice()
  {
    $csvMimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');

        if(!empty($_FILES['var_file']['name']) && in_array($_FILES['var_file']['type'],$csvMimes)){
            //    echo "string";
            if(is_uploaded_file($_FILES['var_file']['tmp_name'])){
                  // echo "string";
                    //open uploaded csv file with read only mode
                $csvFile = fopen($_FILES['var_file']['tmp_name'], 'r');
               
                    // skip first line
                    // if your csv file have no heading, just comment the next line
                fgetcsv($csvFile);
                // while(($line = fgetcsv($csvFile)) !== FALSE){
                while(($line = fgetcsv($csvFile)) !== FALSE){
                        //check whether poadcast already exists in database with same link
                        
                    $price_details = explode(',', $line[5]);
                        //echo "<pre>"; print_r($price_details); exit();

                        foreach ($price_details as $key => $value) {
                           $pvalue = explode('=', $value);

                           //echo "<pre>"; print_r($pvalue); 

                           $percentage = $this->productOffers($line[1]);
                            if ($percentage != '0') {
                                $total_price = $pvalue[1];
                                $price = ($percentage / 100) * $total_price;
                                $discount_price = $total_price - $price;
                            } else {
                                $discount_price = $pvalue[1];
                            }   
                            
                            $this->db->select('int_glcode,var_quantity');
                            $this->db->from('trn_product_price ');
                            $this->db->where('var_quantity',$pvalue[0]);
                            $this->db->where('fk_product',$line[1]);
                            $query = $this->db->get();
                            $row = $query->row_array();
                            
                            //echo $this->db->last_query(); exit();
                            if ($row['var_quantity'] != $pvalue[0]) {
                                   // echo "<pre>"; echo $row['var_quantity'].'####'.$pvalue[0];
                                $this->db->where('int_glcode',$row['int_glcode']);
                                $this->db->delete('trn_product_price');
                            }

                            if (empty($row)) {
                                    
                                    $insert_csv  = array(
                                        'fk_product' => $line[1],
                                        'var_quantity' => $pvalue[0],
                                        'var_price' => $pvalue[1],
                                        'var_discount_price' => $discount_price,
                                        'dt_createddate' => date('Y-m-d H:i:s')
                                    );
                                
                                    $this->db->insert("trn_product_price",$insert_csv);

                            } else {
                                $update_data = array(
                                    'var_quantity' => $pvalue[0],
                                    'var_price' => $pvalue[1],
                                    'var_discount_price' => $discount_price,
                                    'dt_createddate' => date('Y-m-d H:i:s')
                                );

                                $this->common_model->updateRow('trn_product_price', $update_data, array("int_glcode" => $row['int_glcode']));

                                }

                                 

                            }

                           //echo "<pre>"; print_r($pvalue);
                        }
                   // exit();
                        //close opened csv file
                 
                 fclose($csvFile);

                 $qstring["status"] = 'CSV File Uploaded Successfully.';

              }else{

                  $qstring["status"] = 'No file Found';
              }
                }

        return $qstring["status"];
  }

    /*------------------ get products offers -----------------------------*/
    public function productOffers($productId)
    {
        $this->db->select('int_glcode,var_offer');
        $this->db->from('mst_products');
        $this->db->where('int_glcode',$productId);
        $query = $this->db->get();
        $row = $query->row_array();

        return $row['var_offer'];
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

    
}