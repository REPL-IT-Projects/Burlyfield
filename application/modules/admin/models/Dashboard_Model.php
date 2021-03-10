<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Dashboard_model extends CI_Model {

	
	public function __construct() {
		
		parent::__construct();

		 $this->load->database();
		 $this->load->model('common_model');
	}

    /*------------------------ get total data in dashboard ------------------------- */
    public function getTotalData($tableName)
    {
        $this->db->select('int_glcode');
        $this->db->from($tableName);
        if($tableName != 'mst_orders'){
        	$this->db->where('chr_delete','N');
        }
        
        $query = $this->db->get();
        $row = $query->num_rows();

        return $row;
    }

    /*----------------------- get last month earning -----------------------------------*/
    public function lastMonthEarnings()
    {
    	$select = "SELECT SUM(var_payable_amount) AS Total_Amount FROM mst_orders
					WHERE YEAR(dt_createddate) = YEAR(CURDATE() - INTERVAL 1 MONTH)
					AND MONTH(dt_createddate) = MONTH(CURDATE() - INTERVAL 1 MONTH)";
		$query = $this->db->query($select);
		$row = $query->row_array();
		//echo $select; exit();
		//echo "<pre>"; print_r($row); exit();
		return $row['Total_Amount'];
    }

    /*----------------------- get last month earning -----------------------------------*/
    public function totalEarning()
    {
    	$this->db->select('SUM(var_payable_amount) as total_amt');
        $this->db->from('mst_orders');
        
        $query = $this->db->get();
        $row = $query->row_array();

        return $row['total_amt'];
    }

    /////////////////////////////////// monthly display orders /////////////////////////////////
    public function monthlyOrders($start_date,$end_date)
    {
        $this->db->select('COUNT(int_glcode) as order_total');
        $this->db->from('mst_orders');
        $this->db->where('dt_createddate BETWEEN "'.$start_date.'" AND "'.$end_date.'"');
        $query = $this->db->get();
        $row = $query->row_array();
        
        return $row['order_total'];
    }

    /*-------------------------- current month earnings ------------------------*/
    public function monthlyEarning()
    {
        $sql = "SELECT SUM(`var_payable_amount`) AS total FROM mst_orders WHERE MONTH(`dt_createddate`)=MONTH( CURRENT_DATE )";
        $query= $this->db->query($sql);
        return $query->row('total');
    }

    /*------------------------- current month orders ----------------------- */
    public function currentMonthlyOrders()
    {
        $sql = "SELECT count(`int_glcode`) AS total_order FROM mst_orders WHERE MONTH(`dt_createddate`)=MONTH( CURRENT_DATE )";
        $query= $this->db->query($sql);
        return $query->row('total_order');
    }

    /*----------------------- get today orders -----------------------*/
    public function todayOrder()
    {
        $date = new DateTime("now");

        $curr_date = $date->format('Y-m-d ');

        $this->db->select('mo.int_glcode,mo.order_id,mo.fk_user,mo.var_payment_mode,mo.chr_status,mo.dt_delivery_date,mo.var_alternate_mobile,mo.var_payable_amount,mu.var_name');
        $this->db->from('mst_orders mo');
        $this->db->join('mst_users mu', 'mu.int_glcode = mo.fk_user', 'left'); 
        $this->db->where('DATE(mo.dt_createddate)',$curr_date);
        $this->db->order_by('mo.int_glcode','asc');
        $this->db->limit(10);

        $result = $this->db->get();
        //echo $this->db->last_query(); exit();
        $row = $result->result_array();

        return $row;
    }

    /*------------------------ dashboard status ------------------------*/
    public function statusOrder($chr_status)
    {
        $this->db->select('int_glcode');
        $this->db->from('mst_orders');
        $this->db->where('chr_status',$chr_status);
        
        $query = $this->db->get();
        $row = $query->num_rows();

        return $row;
    }

}