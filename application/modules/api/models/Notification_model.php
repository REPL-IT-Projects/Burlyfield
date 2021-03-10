<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model {

    public function __construct() {

        parent::__construct();

        $this->load->database();

        $this->load->model('common_model');
    }


    
}