<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends Front_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session','form_validation','mylibrary','pagination'));
		$this->load->helper(array('form'));
		$this->load->model('Cart_Model','model');
//		if(!isset($_SESSION['fk_user'])){
//            redirect(base_url());
//        }
	}

        Public function index(){
            
            $this->load_view('cart_list');
        }
        
        Public function checkout(){
            
            $data['address'] = $this->model->get_user_address($_SESSION['fk_user']);
            $data['delivery_charge'] = $this->model->get_delivery_charges();
            $data['data'] = $this->model->get_user_details($_SESSION['fk_user']);
            // echo "<pre>";print_r($data);die();
            $this->load_view('checkout',$data);
        }
        
        Public function get_price(){
            $qid = $_POST['qid']; 
            $qty = $_POST['qty']; 
            if($qty == ''){
                $qty = 0;
            }
            
            $sel = $this->db->query("select * from trn_product_price where int_glcode = '".$qid."'");
            $res = $sel->row_array();
            
            $total = $res['var_price'] * $qty;
                    
            echo $total;exit;
       }
       
        public function add_to_cart(){
           
            $sql = $this->db->query("select * from trn_product_price where int_glcode='".$_POST["qid"]."'");
            $res = $sql->row_array();
            
            $sql1 = $this->db->query("select * from mst_products where int_glcode='".$_POST["pid"]."'");
            $res1 = $sql1->row_array();

            if($res1["var_stock"] == 0 || $res1["var_stock"] == "" || $res1['stock_status'] == "N"){
                // echo "out";
                exit();
            }
            
            if($_POST['offer'] == '0'){
                $price = $res['var_price'];
                $dis_price = $res['var_price'];
            }else{ 
                $price = $res['var_discount_price'];
                $dis_price = $res['var_discount_price'];
            }
            
            $grand_total = number_format($_POST["qty"] * $price,2);
            
            if($res1["var_image"] != ''){
                $img = base_url().'uploads/products/'.$res1["var_image"];
            }else{
                $img = base_url().'public/assets/img/site_imges/no_image.png';
            }

            // if(isset($_SESSION['fk_user']) && $_SESSION['fk_user'] != ""){
            //     $fk_user = $_SESSION['fk_user'];
            // } else {
            //     echo "hii";exit();
            // }

           // $getCartDetail = $this->getCartDetails($_SESSION['fk_user'],$res1['int_glcode'],$_POST["qty"]);

           // if (empty($getCartDetail)) {
           //     $cart_data = array(
           //         'fk_user' => $_SESSION['fk_user'],
           //         'fk_product' => $res1['int_glcode'],
           //         'var_name' => $res1["var_title"],
           //         'var_quantity' => $res["var_quantity"],
           //         'var_price' => $res['var_price'],
           //         'var_unit' => $_POST["qty"],
           //         'gst_price' => $res1["var_gst"],
           //         'dt_createddate' => date('Y-m-d H:i:s'),
           //         'dt_modifydate' => date('Y-m-d H:i:s'),
           //         'var_ipaddress' => $_SERVER['REMOTE_ADDR']
           //     );

           //     $this->common_model->insertRow($cart_data, "trn_cart_details");
           // } else {
           //     $cart_data = array(
           //         'fk_user' => $_SESSION['fk_user'],
           //         'fk_product' => $res1['int_glcode'],
           //         'var_name' => $res1["var_title"],
           //         'var_quantity' => $res["var_quantity"],
           //         'var_price' => $res['var_price'],
           //         'var_unit' => $_POST["qty"],
           //         'gst_price' => $res1["var_gst"],
           //         'dt_modifydate' => date('Y-m-d H:i:s'),
           //         'var_ipaddress' => $_SERVER['REMOTE_ADDR']
           //     );

           //     $update_que = $this->common_model->updateRow('trn_cart_details', $cart_data, array("int_glcode" => $getCartDetail['int_glcode']));
           // }
            
            $cart_arr = array(
                'int_glcode' => $res1['int_glcode'],
                'image' => $img, 
                'price' => $res['var_price'], 
                'dis_price' => $dis_price,
                'title' => $res1["var_title"],
                'gst' => $res1["var_gst"], 
                'quantity' => $_POST["qty"], 
                'weigth' => $res["var_quantity"], 
                'offer' => $_POST['offer'],
                'grand_total' => $grand_total
            );

           
            $itemArray = array(
                $res1['int_glcode'].$res["var_quantity"] => $cart_arr
                );
            $match_id = $res1['int_glcode'].$res["var_quantity"];
            if (!empty($_SESSION["cart_item"])) {                
              if (in_array($match_id, array_keys($_SESSION["cart_item"]))) {
                    //foreach ($_SESSION["cart_item"] as $k => $v) {
                       
                            $_SESSION["cart_item"][$match_id] = $cart_arr;
                // if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                // $_SESSION["cart_item"][$k]["quantity"] = 0;
                // } else {
                // $_SESSION["cart_item"][$k]["quantity"] += $_GET["qty"];
                // }
                        
                    //}
                } else {
                    $_SESSION["cart_item"] = $_SESSION["cart_item"] + $itemArray;
                }
            } else {                
                $_SESSION["cart_item"] = $itemArray;
            }
            
//           $html = '<div id="cart_body" >
//           <button class="cart tran3s dropdown-toggle" id="cartDropdown"><i class="fa icon-icon-32846" aria-hidden="true"></i>
//           <span class="s_color_bg p_color">'.count($_SESSION["cart_item"]).'</span>
//           </button>
//				<div class="cart_list color2_bg" aria-labelledby="cartDropdown" ><ul>
//			';
//           
//           $grand_total = 0;
//           foreach($_SESSION["cart_item"] as $item){
//               $item_weight = ",'".$item['weigth']."'";
//               $html .= '
//               <li>
//					<div class="cart_item_wrapper clear_fix">
//						<div class="img_holder float_left"><img style="height: 80px;" src="'.$item['image'].'" alt="Cart Image" class="img-responsive"></div> 
//							   						
//						<div class="item_deatils float_left">
//							<h6>'.$item['title'].'</h6>
//							<ul>
//					            <li><i class="fa fa-star" aria-hidden="true"></i></li>
//					            <li><i class="fa fa-star" aria-hidden="true"></i></li>
//					            <li><i class="fa fa-star" aria-hidden="true"></i></li>
//					            <li><i class="fa fa-star" aria-hidden="true"></i></li>
//					            <li><i class="fa fa-star" aria-hidden="true"></i></li>
//				            </ul>
//				                <span class="font_fix">&#x20b9; '.$item['price'].' <span>x '.$item['quantity'].'</span>
//						</div> 
//					</div>
//				<a class="float-right remove-cart" href="javascript:;" onclick="delete_to_cart('.$item['int_glcode'].','.$item['weigth'].')"><i class="fa fa-times-circle"></i></a>
//				</li>
//               ';
//               
//
//               $tl = $item['price'] * $item['quantity'];
//               $GST = ($tl*$item['gst'])/100;
//               $total = $tl + $GST;
//               $grand_total = $total + $grand_total;
//           }
//
//           $html .= '</ul>
//                           <div class="cart_total clear_fix">
//                               <span class="total font_fix float_left">Total - &#x20b9; '.$grand_total.'</span>
//								    <a href="'.base_url().'cart" class="s_color_bg float_right tran3s">View Cart</a>
//							</div>
//						</div>
//           </div>';

            
            
            echo 1;exit;
        }
        
        public function delete_to_cart(){
            //unset($_SESSION["cart_item"]); echo 'fdf';die;
            $id = $this->input->post('id');
            $weight = $this->input->post('weight');
            
            if (!empty($_SESSION["cart_item"])) {
                foreach ($_SESSION["cart_item"] as $k => $v) {
                    if ($id.$weight == $v["int_glcode"].$v["weigth"]){
                        /*-------------- delete in cart detail table ---------------*/
                        $this->db->where('fk_product', $id);
                        $this->db->where('var_quantity', $weight);
                        $this->db->where('fk_user', $_SESSION['fk_user']);
                        $this->db->delete('trn_cart_details');

                        unset($_SESSION["cart_item"][$k]);
                    }
                    if (empty($_SESSION["cart_item"])){
                        unset($_SESSION["cart_item"]);
                    }
                }
            }
            $grand_total = 0;
            foreach($_SESSION["cart_item"] as $row){
              $total = $row['price'] * $row['quantity'];
              $grand_total = $total + $grand_total;
            }
           
            if(isset($_SESSION["cart_item"])){
                $count = count($_SESSION["cart_item"]);
            $html = '<div id="cart_body" class="active">
            <button class="cart tran3s dropdown-toggle" id="cartDropdown"><i class="fa icon-icon-32846" aria-hidden="true"></i>
            <span class="s_color_bg p_color">'.count($_SESSION["cart_item"]).'</span>
            </button>
            <div class="cart-info">
                <div>My Cart</div>
                <div class="doller">&#x20b9; '.$grand_total.'</div>
            </div>
				<div class="cart_list color2_bg" aria-labelledby="cartDropdown"><ul>
			';
            
             // $grand_total = 0;
            $count = 0;
            foreach($_SESSION["cart_item"] as $item){
                $item_weight = ",'".$item['weigth']."'";
                $html .= '<li>
					<div class="cart_item_wrapper clear_fix">
						<div class="img_holder float_left"><img style="height: 80px;" src="'.$item['image'].'" alt="Cart Image" class="img-responsive"></div> 
							   						
						<div class="item_deatils float_left">
							<h6>'.$item['title'].'</h6>
							<ul>
					            <li><i class="fa fa-star" aria-hidden="true"></i></li>
					            <li><i class="fa fa-star" aria-hidden="true"></i></li>
					            <li><i class="fa fa-star" aria-hidden="true"></i></li>
					            <li><i class="fa fa-star" aria-hidden="true"></i></li>
					            <li><i class="fa fa-star" aria-hidden="true"></i></li>
				            </ul>
				<span class="font_fix">&#x20b9; '.$item['price'].' <span>x '.$item['quantity'].'</span>
						</div> 
					</div>
					<a class="float-right remove-cart" href="javascript:;" onclick="delete_to_cart('.$item['int_glcode'].','.$item['weigth'].')"><i class="fa fa-times-circle"></i></a>
				</li>';
            
                // $tl = $item['price'] * $item['quantity'];
                // $g = $item['gst'] + 100;
                // $total = ($tl*100)/$g;
                //  $total = $tl - $GST;
                // $grand_total = $total + $grand_total;
            }

            $html .= '</ul>
                            <div class="cart_total clear_fix">
                                <span class="total font_fix float_left">Total - &#x20b9; '.$grand_total.'</span>
								    <a href="'.base_url().'cart" class="s_color_bg float_right tran3s">View Cart</a>
							</div>
						</div>
						</div>';
            
            }else{
                $html = '<div id="cart_body" class="active"><a href="javascript:;" class="dropdown-toggle nav-link " data-toggle="dropdown"><i class="fa fa-shopping-cart">
                    <span class="icon-header-noti">0</span></i></a><ul class="dropdown-menu dropdown-cart" role=""><span>Cart Empty</span></ul></div>';
               
            }
            $charge = $this->db->get('mst_delivery_charges')->row_array(); 
            if($charge['var_below'] < $grand_total){
                    $spcharge = 'Free Shipping';
                } else {
                    $spcharge = $charge['var_charges'];
                    $final_total = $spcharge + $grand_total;
                }
            echo $html.'***'.$grand_total.'***'.$count.'***'.$spcharge.'***'.$final_total;exit;
        }
        
        public function update_cart(){

            $sql1 = $this->db->query("select * from mst_products where int_glcode='".$_POST["product_id"]."'");
            $res1 = $sql1->row_array();

            if($res1["var_stock"] < $_POST["quantity"] || $res1["var_stock"] == "" || $res1['stock_status'] == "N"){
                // echo "out";
                exit();
            }
            
            foreach ($_SESSION["cart_item"] as $k => $v) {
                if ($_POST["product_id"].$_POST["weight"] == $k) {

                    $_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
                    $single_price = $_SESSION["cart_item"][$k]["price"] * $_POST["quantity"];
                    
                    $cart_data = array(
                        'var_unit' => $_POST["quantity"],
                        'var_price' => $_SESSION["cart_item"][$k]["price"]
                    );
                    $this->db->where('fk_user',$_SESSION['fk_user']);
                    $this->db->where('fk_product',$_POST["product_id"]);
                    $this->db->where('var_quantity',$_POST["weight"]);
                    $this->db->update("trn_cart_details",$cart_data);
                }
            }
             
            $grand_total = 0;
            foreach($_SESSION["cart_item"] as $row){
              $total = $row['price'] * $row['quantity'];
              $grand_total = $total + $grand_total;
            }       
            

            if(isset($_SESSION["cart_item"])){
                $count = count($_SESSION["cart_item"]);
            $html = '<div id="cart_body" class="active">
            <button class="cart tran3s dropdown-toggle" id="cartDropdown"><i class="fa icon-icon-32846" aria-hidden="true"></i>
            <span class="s_color_bg p_color">'.count($_SESSION["cart_item"]).'</span>
            </button>
            <div class="cart-info">
                <div>My Cart</div>
                <div class="doller">&#x20b9; '.$grand_total.'</div>
            </div>
				<div class="cart_list color2_bg" aria-labelledby="cartDropdown"><ul>';
            // $grand_total = 0;
            $count = 0;
            foreach($_SESSION["cart_item"] as $item){
                $item_weight = ",'".$item['weigth']."'";
                $html .= '<li>
					<div class="cart_item_wrapper clear_fix">
						<div class="img_holder float_left"><img style="height: 80px;" src="'.$item['image'].'" alt="Cart Image" class="img-responsive"></div> 
							   						
						<div class="item_deatils float_left">
							<h6>'.$item['title'].'</h6>
							<ul>
					            <li><i class="fa fa-star" aria-hidden="true"></i></li>
					            <li><i class="fa fa-star" aria-hidden="true"></i></li>
					            <li><i class="fa fa-star" aria-hidden="true"></i></li>
					            <li><i class="fa fa-star" aria-hidden="true"></i></li>
					            <li><i class="fa fa-star" aria-hidden="true"></i></li>
				            </ul>
				<span class="font_fix">&#x20b9; '.$item['price'].' <span>x '.$item['quantity'].'</span>
						</div> 
					</div>
					<a class="float-right remove-cart" href="javascript:;" onclick="delete_to_cart('.$item['int_glcode'].','.$item['weigth'].')"><i class="fa fa-times-circle"></i></a>
				</li>';
            
                // $tl = $item['price'] * $item['quantity'];
                // $GST = ($tl*$item['gst'])/100;
                // $total = $tl + $GST;
                // $grand_total = $total + $grand_total;
            }   

            $html .= '</ul>
                            <div class="cart_total clear_fix">
                                <span class="total font_fix float_left">Total - &#x20b9; '.$grand_total.'</span>
								    <a href="'.base_url().'cart" class="s_color_bg float_right tran3s">View Cart</a>
							</div>
						</div>
					</div>';
            
            }else{
                $html = '<div id="cart_body" class="active"><button class="cart tran3s dropdown-toggle" id="cartDropdown"><i class="fa icon-icon-32846" aria-hidden="true"></i><span class="s_color_bg p_color">0</span></button>
                        <div class="cart_list color2_bg" aria-labelledby="cartDropdown"><div class="cart_total clear_fix">
                            <span class="total font_fix float_left">Cart Empty</span>
						</div></div></div>';
               
            }
            $charge = $this->db->get('mst_delivery_charges')->row_array(); 
            

                if($charge['var_below'] < $grand_total){
                    $spcharge = 'Free Shipping';
                } else {
                    $spcharge = $charge['var_charges'];
                    $final_total = $spcharge + $grand_total;
                }
            echo $html.'***'.$grand_total.'***'.$count.'***'.$single_price.'***'.$spcharge.'***'.$final_total;exit;
                    
        }
        
        public function get_delivery_timeslot(){
        
            $type = $_POST['type'];
            $delivery_date = $_POST['delivery_date'];
            
            $html = $this->model->get_delivery_timeslot($type,$delivery_date);
            
            echo $html;exit;
            
        }
        
    public function getCartDetails($fk_user,$fk_product,$var_quantity)
    {
        $this->db->select('int_glcode,chr_status');
        $this->db->from('trn_cart_details');
        $this->db->where('fk_user', $fk_user);
        $this->db->where('fk_product', $fk_product);
        $this->db->where('var_quantity', $var_quantity);
        $this->db->where('chr_status', 'A');
        $query = $this->db->get();
        $result = $query->row_array();

        return $result;
    }
}                                    