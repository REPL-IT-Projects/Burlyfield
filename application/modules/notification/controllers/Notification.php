<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends Admin_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('Notification_model','model');
    }

    /*--------------------------------- user orders ---------------------------*/
    public function sendVendorNotification()
    {
       $this->model->get_user_address();
    }

   /*--------------------------------- user orders ---------------------------*/
    public function secondVendorNotification()
    {
       $this->model->send_second_vendor_notification();
    }

    /*--------------------------------- user orders ---------------------------*/
    public function cancelOrderNotification()
    {
       $this->model->cancel_user_order();
    }


    public function sendDemoMail()
    {
        
        
       
        
        $this->load->library('smtpemail');
        $config = $this->smtpemail->globalEmail();
        
        
        
        $config['charset'] = 'utf-8';
          

      
        
      //   print '<pre>';
     //   print_r($config);
       
        
        
        
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
      //  $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
       // $this->email->set_header('Content-type', 'text/html');
        $this->email->set_newline("\r\n");

        //Email content
            
        $htmlContent = "Hello";
        $htmlContent .= "नमस्ते";
         $htmlContent .= 'test message in hindi --- ऊपर दिए गए उदाहरण में';

        //$this->email->to('grishma.conceptioni@gmail.com');
        $this->email->to('komalrathod1190@gmail.com');
        $this->email->from(FROM_EMAIL,'Vruits');
        $this->email->subject('Registration');
        $this->email->message($htmlContent);

        //Send email
        if($this->email->send())
        {
          echo "success";
        } else {
          echo "failed";
        }
    }
}