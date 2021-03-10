<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends API_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('Setting_model','model');
    }

    /*------------------------------------- Get Banner Images --------------------------*/
    public function getHomeBanners()
    {
        $data = $this->model->getAllBanners();

        if (count($data) > 0) {
            $response['status'] = 200;
            $response['message'] = GET_SUCCESS;
            $response['data'] = $data;
        } else {
            $response['status'] = 404;
            $response['message'] = GET_ERROR;
        }
            
        echo (json_encode($response));
        exit;
    }

    /*------------------------------------- Get delivery timeslot --------------------------*/
    public function getDeliveryTimeSlot()
    {
        $data = $this->model->getAllTimeslot();
        $current_time = date('Y-m-d H:i:s');
        if (count($data) > 0) {
            $response['status'] = 200;
            $response['message'] = GET_SUCCESS;
            $response['current_time'] = $current_time;
            $response['data'] = $data;
        } else {
            $response['status'] = 404;
            $response['message'] = GET_ERROR;
            $response['current_time'] = $current_time;
        }
            
        echo (json_encode($response));
        exit;
    }

    /*------------------------------------- Get promocode --------------------------*/
    public function getPromocodeList()
    {
        $data = $this->model->get_promocode_list();
        
        if (count($data) > 0) {
            $response['status'] = 200;
            $response['message'] = GET_SUCCESS;
            $response['data'] = $data;
        } else {
            $response['status'] = 404;
            $response['message'] = GET_ERROR;
        }
            
        echo (json_encode($response));
        exit;
    }

    /*------------------------------------- check user promocode --------------------------*/
    public function checkPromocode()
    {
        $fk_user = $this->input->post('fk_user');
        $promocode = $this->input->post('var_promocode');

        if (($fk_user != '') && ($promocode != '')) {

            $promo_msg = $this->model->check_promocode($fk_user,$promocode);

            if ($promo_msg != '') {

                $data = $this->model->get_promocode($promocode);

                if ($promo_msg == 'Promocode Applied Successfully !') {
                    $chr_status = 'Y';
                } else {
                    $chr_status = 'N';
                }

                $response['status'] = 200;
                $response['message'] = $promo_msg;
                $response['chr_status'] = $chr_status;
                $response['data'] = $data;

            } else {
                $response['status'] = 404;
                $response['message'] = GET_ERROR;
            }
        } else {
            $response['status'] = 404;
            $response['message'] = INCOMPLTE_DETAIL;
        }
          
        echo (json_encode($response));
        exit;
    }

}