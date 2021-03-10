<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends API_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->library('mylibrary');
        $this->load->model('Category_model','model');
    }

    /*------------------------------------- Get All Category ---------------------------------*/
    public function getCategory()
    {
        $data = $this->model->getAllCategory();

        if ($data > 0) {
            $response['status'] = 200;
            $response['message'] = GET_SUCCESS;
            $response['data'] = $data;
        } else {
            $response['status'] = 404;
            $response['message'] = NO_CATEGORY;
        }
            
        echo (json_encode($response));
        exit;
    }

    /*--------------------------------get all products--------------------------- */
    public function getProducts()
    {
        $cateId = $this->input->post('category_id');
        $fk_user = $this->input->post('fk_user');

        $data =  $this->model->get_all_products($cateId,$fk_user);
                
            if (count($data) > 0) {
            
                $response['status'] = 200;
                $response['message'] = GET_SUCCESS;
                $response['data'] = $data;

            } else {
                $response['status'] = 404;
                $response['message'] = NO_PRODUCT;
            }

        echo (json_encode($response));
        exit;
    }

    /*--------------------------------get products details --------------------------- */
    public function getProductDetails()
    {
        $productId = $this->input->post('fk_product');
        $fk_user = $this->input->post('fk_user');

        $data =  $this->model->get_products_detail($productId,$fk_user);
                
            if (!empty($data)) {
            
                $response['status'] = 200;
                $response['message'] = GET_SUCCESS;
                $response['data'] = $data;

            } else {
                $response['status'] = 404;
                $response['message'] = NO_PRODUCT;
            }

        echo (json_encode($response));
        exit;
    }

    /*--------------------------------get Hot products--------------------------- */
    public function getHotProducts()
    {
        $fk_user = $this->input->post('fk_user');

        $data =  $this->model->get_hot_products($fk_user);
                
            if (count($data) > 0) {
            
                $response['status'] = 200;
                $response['message'] = GET_SUCCESS;
                $response['data'] = $data;

            } else {
                $response['status'] = 404;
                $response['message'] = NO_PRODUCT;
            }

        echo (json_encode($response));
        exit;
    }

    /*--------------------------------get Hot products--------------------------- */
    public function getRecentProducts()
    {
        $fk_user = $this->input->post('fk_user');

        // if ($fk_user == '') {
        //     $response['status'] = 404;
        //     $response['message'] = NO_PRODUCT;
        // } else {
            $data =  $this->model->get_recent_products($fk_user);
                
            if (count($data) > 0) {
            
                $response['status'] = 200;
                $response['message'] = GET_SUCCESS;
                $response['data'] = $data;

            } else {
                $response['status'] = 404;
                $response['message'] = NO_PRODUCT;
            }
        //}

        echo (json_encode($response));
        exit;
    }

    /*--------------------------------get offer products--------------------------- */
    public function getOfferProducts()
    {
        $fk_user = $this->input->post('fk_user');

            $data =  $this->model->get_offer_products($fk_user);
                
            if (count($data) > 0) {
            
                $response['status'] = 200;
                $response['message'] = GET_SUCCESS;
                $response['data'] = $data;

            } else {
                $response['status'] = 404;
                $response['message'] = NO_PRODUCT;
            }
        

        echo (json_encode($response));
        exit;
    }

    /*--------------------------------get similar products--------------------------- */
    public function getSimilarProducts()
    {
        $fk_user = $this->input->post('fk_user');
        $fk_product = $this->input->post('fk_product');
        $fk_category = $this->input->post('fk_category');

            $data =  $this->model->get_offer_products($fk_user,$fk_product,$fk_category);
                
            if (count($data) > 0) {
            
                $response['status'] = 200;
                $response['message'] = GET_SUCCESS;
                $response['data'] = $data;

            } else {
                $response['status'] = 404;
                $response['message'] = NO_PRODUCT;
            }
        

        echo (json_encode($response));
        exit;
    }

    function HomeAPI(){
        
        $category = $this->model->getAllCategory();
        $hot_product = $this->model->get_hot_products($_POST['user_id']);
        $recent_product = $this->model->get_recent_products($_POST['user_id']);
        $offer_product = $this->model->get_offer_products($_POST['user_id']);
        $Vendor_List = $this->model->VendorList();
        $banner_list = $this->model->getAllBanners();
        
        $response['status'] = 200;
        $response['category_list'] = $category;
        $response['vendor_list'] = $Vendor_List;
        $response['banner_list'] = $banner_list;
        $response['hot_product'] = $hot_product;
//        $response['recent_product'] = $recent_product;
//        $response['offer_product'] = $offer_product;
        
        echo (json_encode($response));
        exit;
    }
    
}