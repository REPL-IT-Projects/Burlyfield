<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Place_order extends Front_Controller {
	
	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session','form_validation','pagination'));
        $this->load->helper(array('form','url'));
        $this->load->model('Place_model','model');
        $this->fk_user = $_SESSION['fk_user'];
        // header("Pragma: no-cache");
        // header("Cache-Control: no-cache");
        // header("Expires: 0");

        //$this->load->library('Stack_web_gateway_paytm_kit');
    }


    public function add_user_order()
    {
        // if ($_POST['var_payment_mode'] == 'C') {

            $orderid = $this->model->add_user_order($this->fk_user);
            
            $this->session->unset_userdata('cart_item');
            $_SESSION['user_order_id'] = $orderid;
            //redirect('order_success');
            // exit();
            echo "success";
            exit();
        // } 
       
        //redirect(base_url().'order_success');
    }

    public function order_success()
    {
        $data['order_id'] = $_SESSION['user_order_id'];
        $this->load_view('thankyou',$data);
        unset($_SESSION['order_id']);
    }

    // public function payby_paytm()
    // {
    //     header("Pragma: no-cache");
    //     header("Cache-Control: no-cache");
    //     header("Expires: 0");

    //     // following files need to be included
    //     require_once(APPPATH . "/third_party/paytmlib/config_paytm.php");
    //     require_once(APPPATH . "/third_party/paytmlib/encdec_paytm.php");

    //     $checkSum = "";
    //     $paramList = array();

    //     $ORDER_ID = $_POST["ORDER_ID"];
    //     $CUST_ID = $_POST["CUST_ID"];
    //     $INDUSTRY_TYPE_ID = $_POST["INDUSTRY_TYPE_ID"];
    //     $CHANNEL_ID = $_POST["CHANNEL_ID"];
    //     $TXN_AMOUNT = $_POST["TXN_AMOUNT"];

    //     // Create an array having all required parameters for creating checksum.
    //     $paramList["MID"] = PAYTM_MERCHANT_MID;
    //     $paramList["ORDER_ID"] = $ORDER_ID;
    //     $paramList["CUST_ID"] = $CUST_ID;
    //     $paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
    //     $paramList["CHANNEL_ID"] = $CHANNEL_ID;
    //     $paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
    //     $paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;

         
    //      $paramList["MSISDN"] = $MSISDN; //Mobile number of customer
    //      $paramList["EMAIL"] = $EMAIL; //Email ID of customer
    //      $paramList["VERIFIED_BY"] = "EMAIL"; //
    //      $paramList["IS_USER_VERIFIED"] = "YES"; //

         

    //     //Here checksum string will return by getChecksumFromArray() function.
    //      $checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);
    //      echo "<html>
    //      <head>
    //      <title>Merchant Check Out Page</title>
    //      </head>
    //      <body>
    //      <center><h1>Please do not refresh this page...</h1></center>
    //      <form method='post' action='".PAYTM_TXN_URL."' name='f1'>
    //      <table border='1'>
    //      <tbody>";

    //      foreach($paramList as $name => $value) {
    //        echo '<input type="hidden" name="' . $name .'" value="' . $value .         '">';
    //     }

    //     echo "<input type='hidden' name='CHECKSUMHASH' value='". $checkSum . "'>
    //     </tbody>
    //     </table>
    //     <script type='text/javascript'>
    //     document.f1.submit();
    //     </script>
    //     </form>
    //     </body>
    //     </html>";
    // }

    //public function paytm_response(){
        // $paytmChecksum  = "";
        // $paramList      = array();
        // $isValidChecksum= "FALSE";

        // $paramList = $_POST;
        //     $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

        //     header("Pragma: no-cache");
        //     header("Cache-Control: no-cache");
        //     header("Expires: 0");

        //     //Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
        //     $isValidChecksum = $this->stack_web_gateway_paytm_kit->verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


        //     if($isValidChecksum == "TRUE") {
        //         echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
                
        //         echo "<pre>";
        //         print_r($_POST);
        //         echo "<pre>";

        //         if ($_POST["STATUS"] == "TXN_SUCCESS") {
        //             echo "<b>Transaction status is success</b>" . "<br/>";
        //             //Process your transaction here as success transaction.
        //             //Verify amount & order id received from Payment gateway with your application's order id and amount.
        //         }
        //         else {
        //             echo "<b>Transaction status is failure</b>" . "<br/>";
        //         }

        //         if (isset($_POST) && count($_POST)>0 )
        //         { 
        //             foreach($_POST as $paramName => $paramValue) {
        //                 echo "<br/>" . $paramName . " = " . $paramValue;
        //             }
        //         }
                

        //     }
        //     else {
        //         echo "<b>Checksum mismatched.</b>";
        //         //Process transaction as suspicious.
        //     }
        // }
}                                    