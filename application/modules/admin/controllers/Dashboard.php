<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    public function __construct() {
		
		parent::__construct();
        $this->load->library(array('session','mylibrary'));
        $this->load->model('Dashboard_Model','model');
	}
        
	public function index()
	{
        $data['users'] = $this->model->getTotalData('mst_users');
        $data['products'] = $this->model->getTotalData('mst_products');
        $data['vendors'] = $this->model->getTotalData('mst_vendors');
        $data['orders'] = $this->model->getTotalData('mst_orders');

        $data['last_amt'] = $this->model->lastMonthEarnings();
        $data['total_amt'] = $this->model->totalEarning();
        $data['current_tot'] = $this->model->monthlyEarning();
        $data['current_order'] = $this->model->currentMonthlyOrders();

        $data['data'] = $this->model->todayOrder();

        $data['status_success'] = $this->model->statusOrder('C');
        $data['status_pending'] = $this->model->statusOrder('P');
        $data['status_failed'] = $this->model->statusOrder('R');

        /* ----------------------------------- week 1 ------------------------------ */
        $date1= date("Y-m-d");
        $date=date_create(date("Y-m-d"));
        date_sub($date,date_interval_create_from_date_string("7 days"));
        $week_date1 = date_format($date,"Y-m-d");
        //echo $week_date1.'77777777'; die();
        $data['week1'] = $this->model->monthlyOrders($week_date1,$date1);
        $data['w1_title'] = date("d M") .'-'. date_format($date,"d M");
        /* ----------------------------------- week 2 ------------------------------ */
        $nd = 1;
        $d1 = date('Y-m-d', strtotime($week_date1. ' - '.$nd.' days'));
        $date2=date_create($d1);
        date_sub($date2,date_interval_create_from_date_string("7 days"));
        $week_date2 = date_format($date2,"Y-m-d");

        $data['week2'] = $this->model->monthlyOrders($week_date2,$d1);
        $data['w2_title'] = date('d M', strtotime($week_date1. ' - '.$nd.' days')) .'-'. date_format($date2,"d M");
        // $week2; exit();

        /* ----------------------------------- week 3 ------------------------------ */
        $d2 = date('Y-m-d', strtotime($week_date2. ' - '.$nd.' days'));
        $date3=date_create($d2);
        date_sub($date3,date_interval_create_from_date_string("7 days"));
        $week_date3 = date_format($date3,"Y-m-d");

        $data['week3'] = $this->model->monthlyOrders($week_date3,$d2);
        $data['w3_title'] = date('d M', strtotime($week_date2. ' - '.$nd.' days')) .'-'. date_format($date3,"d M");

        /* ----------------------------------- week 4 ------------------------------ */
        $d3 = date('Y-m-d', strtotime($week_date3. ' - '.$nd.' days'));
        $date4=date_create($d3);
        date_sub($date4,date_interval_create_from_date_string("7 days"));
        $week_date4 = date_format($date4,"Y-m-d");

        $data['week4'] = $this->model->monthlyOrders($week_date4,$d3);
        $data['w4_title'] = date('d M', strtotime($week_date3. ' - '.$nd.' days')) .'-'. date_format($date4,"d M");

        /* ----------------------------------- week 5 ------------------------------ */
        $d4 = date('Y-m-d', strtotime($week_date4. ' - '.$nd.' days'));
        $date5=date_create($d4);
        date_sub($date5,date_interval_create_from_date_string("7 days"));
        $week_date5 = date_format($date5,"Y-m-d");

        $data['week5'] = $this->model->monthlyOrders($week_date5,$d4);
        $data['w5_title'] = date('d M', strtotime($week_date4. ' - '.$nd.' days')) .'-'. date_format($date5,"d M");

		$this->load_view('home',$data);
	}

    public function change_password(){
        
        $cupass = $this->mylibrary->cryptPass($this->input->post('opassword'));
        $nepass = $this->mylibrary->cryptPass($this->input->post('npassword'));
        $copass = $this->mylibrary->cryptPass($this->input->post('rpassword'));
        
        $sel1 = $this->db->query("select var_password from mst_admin where int_glcode='1' ");
        $res1 = $sel1->row_array();
        
        if($cupass != $nepass){
        if($cupass == $res1['var_password']){
            if($nepass == $copass){
                
                $update = $this->db->query("update mst_admin set var_password='$nepass' where int_glcode='1'");
                echo 1;exit;
            }else{
                echo 'new and confirm password does not match.';exit;
            }
        }else{
            echo 'current password does not match.';exit;
        }
        }else{
            echo 'Last 3 passwords should not be used again.';exit;
        }
    }       
}                                         