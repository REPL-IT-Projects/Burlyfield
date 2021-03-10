<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_chat extends Admin_Controller {
 
	public function __construct() {
 
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('form'));
		$this->load->library(array('session','form_validation','mylibrary','pagination'));
		$this->load->model('User_chat_model','model');
	}

	public function index()
	{
		
		$data['chat_name'] = $this->model->get_chat_name();

		$this->load_view('user_chat/view_user_chat',$data);

	}

        function insert_chat(){
        
            $array = array(
                'fk_user' => $_POST['fk_user'],
                'send_by' => 'A',
                'txt_msg' => $_POST['txt_msg'],
                'dt_createddate' => date('Y-m-d H:i:s')
            );
            $insert = $this->db->insert('mst_user_chat',$array);

            $sql = $this->db->query("select var_device_token from mst_users where int_glcode='".$array['fk_user']."' ");
            $res = $sql->row_array();

            $url = "https://fcm.googleapis.com/fcm/send";
            $target = $res['var_device_token'];

            $data1['message'] = $array['txt_msg'];
            $data1['flag'] = 'chat';

            $fields = array();

            $fields['data'] = $data1;

            if (is_array($target)) {
                $fields['registration_ids'] = $target;
            } else {
                $fields['to'] = $target;
            }

            $headers = array(
                'Content-Type:application/json',
                'Authorization:key=' . NOTIFICATION_KEY
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

            $result = curl_exec($ch);
            curl_close($ch);

            echo 1;exit;
        }
    
        function load_chat(){
        
            $to_id = $_POST['fk_user'];

            $chat_data = $this->model->load_chat($to_id);
            $data = '';
            foreach($chat_data as $row){
                $date = $this->common_model->DateFormatter($row['dt_createddate']);
                if($row['send_by'] == 'U'){
                    $data .= "<div class='tg-offerermessage'><div class='tg-description'><p>".$row['txt_msg']."</p><time>".$date."</time></div></div>";
                }else{
                    $data .= "<div class='tg-memessage'><div class='tg-description'><p>".$row['txt_msg']."</p><time>".$date."</time></div></div>";
                }
            }

            echo $data;exit;
        }

        function load_chat_name(){
        
            $chat_data = $this->model->get_chat_name();
            $data = '<div id="chat_name">';
            foreach($chat_data as $row1){
                $count = $this->common_model->get_seen_count($row1['int_glcode']);
                if($row1['var_image'] != ''){
                    $image = base_url().'public/uploads/user/'.$row1['var_image'];
                }else{
                    $image = base_url().'public/assets/images/users/user.png';
                }
                if($count > 0){
                    $point = '<span class="point_round"></span>';
                }else{
                    $point = '';
                }
                    $data .= '<div class="tg-offerer"><a href="javascript:void(0)" onclick=get_chat_data("'.$row1['int_glcode'].'")><figure>'
                            . '<img src="'.$image.'" alt="user" class="mCS_img_loaded"></figure><h3>'.$row1['var_name'].$point.'</h3></a></div>';
              
            }
            $data .= '</div>';
            echo $data;exit;
        }
        
}                                      