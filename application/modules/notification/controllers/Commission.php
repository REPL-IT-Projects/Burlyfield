<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Commission extends Admin_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('Commission_model','model');
    }

    /*--------------------------------- user orders ---------------------------*/
    public function vendor_commission_send()
    {
       $this->model->vendor_half_commission();
    }

    /*-------------------------- product thumb creation ---------------------*/
    public function product_thumb_creation()
    {
       $this->model->productThumbCreation();
    }

}