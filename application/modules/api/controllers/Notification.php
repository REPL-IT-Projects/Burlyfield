<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends API_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('Notification_model','model');
    }

    /*--------------------------------- vendor  ---------------------------*/
    // public function vendor_commission_send()
    // {
    //    $this->model->vendor_half_commission();
    // }

   
}