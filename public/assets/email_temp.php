<!DOCTYPE html>    
<html>
<head>
   <title>email-template</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
   <meta content="width=device-width, initial-scale=1.0" name="viewport">
   <style type="text/css">
   @media (max-width: 767px){
      .main-table{
         width: 80% !important;
      }
      .left-td{
         width: 26% !important;
         padding: 20px 0 20px 20px !important;
      }
      .right-td{
         padding: 20px 20px 20px 26px !important;
      }
   }
   @media (min-width:768px)and (max-width: 991px){
      .main-table{
         width: 80% !important;
      }
      .left-td{
         width: 26% !important;
      }
   }
   @media (min-width : 992px) and (max-width : 1024px){
      .main-table{
         width: 77% !important;
      }
      .left-td{
         width: 28% !important;
         padding: 20px 0 20px 59px !important;
      }
      .right-td{
         padding: 20px 20px 20px 69px !important;
      }
   }
   @media (min-width : 1025px) and (max-width : 1440px){
      .main-table{
         width: 67% !important;
      }
      .left-td{
         width: 31% !important;
         padding: 20px 0 20px 60px !important;
      }
      .right-td{
         padding: 20px 20px 20px 9px !important;
      }
   }
</style>
</head>
<body style=" font-family: poppins; margin: 0;">
   <table cellspacing="0" style="width: 100%; padding: 15px;" bgcolor="#F3F3F3" align="center">
      <tr>
         <td align="center" style="padding: 20px;" colspan="2"><img src="@IMG_LOGOpublic/assets/images/site_imges/logo.png" width="100" /></td>
      </tr>
      <tr>
         <td>
            <table align="center" width="80%" bgcolor="#ffffff" cellspacing="0" style="margin-bottom: 41px; padding: 15px;">
               <tr>
                  <td align="center" colspan="2">
                     <img src="@IMG_LOGOpublic/assets/images/site_imges/email_image.png" alt="header image" style="width: 100%; display: block;pointer-events:none;"/>
                  </td>
               </tr>
               <tr>
                  <td style="padding: 25px;text-align: center;font-size: 16px;font-weight:normal;" colspan="2">
                     Dear @ROLE, we have received your request for forget password. <br/>Now you can access your account with the following details.<br/>We are requesting you to use this password and change the password once.<br/>
                  </td>
               </tr>
               <tr>
                  <td style="text-align: center;font-size: 20px;padding: 20px;font-weight: 600;" colspan="2">
                     @ROLE Detail
                  </td>
               </tr>
               <tr>
                  <td style="word-wrap: normal;text-align: left;font-size: 16px;padding: 20px 0px 20px 44px;font-weight: 600;">
                     EMAIL
                  </td>
                  <td style="padding: 20px 20px 20px 61px;">
                     @EMAIL
                  </td>
               </tr>
               
               <tr>
                  <td style="word-wrap: normal;text-align: left;font-size: 16px;padding: 20px 0px 20px 44px;font-weight: 600;">
                     PASSWORD
                  </td>
                  <td style="padding: 20px 20px 20px 61px;">
                   @PASSWORD
                </td>
             </tr>
             <tr>
               <td colspan="2">
                  <div style="font-size: 16px;width: 75%;margin: 15px auto;text-align: center;background-color: #ffffff;"><?php echo date('Y'); ?> ISO </div>
               </td>
               
            </tr>
         </table>
      </td>
   </tr>
</table>
</body>
</html>