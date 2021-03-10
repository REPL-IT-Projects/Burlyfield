<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
   <meta name="viewport" content="width=device-width" />
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <link rel="icon" type="image/png" sizes="16x16" href="@IMG_LOGO/public/assets/images/site_imges/favicon.png">
   <title>Vruits Cancel Order</title>
</head>
<body>
   <div style="width:634px;margin:0 auto">
      <table style="width:612px;border:solid 1px #fff;padding:0px" cellspacing="0">
         <tbody>
            <tr>
               <td>
                  <table style="width:612px;border:solid 1px #fff;padding:0px" cellspacing="0">
                     <tbody>
                        <tr>
                           <td align="center">
                              <a style="margin:0 0 0 10px;display:inline-block" href="javascript:;">
                                 <img src="@IMG_LOGO/public/assets/images/site_imges/Logo.png" alt="http://cidev.in/vruits/" class="CToWUd">
                              </a>
                           </td>
                        </tr>
                        <tr>
                           <td style="padding:0px; background-color: #ec7546 ;" width="633px" height="51px">
                           </td>
                        </tr>
                        <tr style="background:#ec7546;width:100%;border-bottom:1px solid #ccc;padding:0px">
                           <td style="padding:0px">
                              <table style="width:612px;margin:0 auto;background:#fff;margin:0 10px 10px" cellspacing="0" cellpadding="0" border="0">
                                 <tbody>
                                    <tr>
                                       <td>
                                          <table style="width:612px" cellspacing="0" cellpadding="0" border="0">
                                             <tbody>
                                                <tr>
                                                   <td>
                                                      <table style="width:612px;" cellspacing="0" cellpadding="0" border="0">
                                                         <tbody>
                                                            <tr>
                                                               <td><br>
                                                                  <span style="font-family:Arial,Helvetica,sans-serif;color:#444;font-size:16px;font-weight:normal;text-align:left;padding:10px">Dear @NAME,</span>
                                                               </td>
                                                            </tr>
                                                            <tr>
                                                               <td style="font-family:Arial,Helvetica,sans-serif;color:#444;font-size:16px;font-weight:normal;text-align:center;padding:20px 0 25px">As Requested by you, we have cancelled your order with order id #@ORDNO
                                                               </td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td style="text-align:left;font-family:Arial,Helvetica,sans-serif;padding:10px 20px;border-bottom:2px solid #fff">
                                                      <table style="width:612px;font-size:10px;color:#6c6c6c" cellspacing="0" cellpadding="0" border="0">
                                                         <tbody>
                                                            <tr>
                                                               <td style="height:20px;color:#6c6c6c;width:80px">Order No:</td>
                                                               <td style="height:20px;font-weight:bold" class="">
                                                                  <a style="text-decoration:none" href="javascript:;">@ORDNO</a>
                                                               </td>
                                                            </tr>
                                                            <tr>
                                                               <td style="color:#6c6c6c;vertical-align:top">Delivery slot:</td>
                                                               <td style="font-weight:bold;vertical-align:top;width:145px;padding-right:30px">@ADDDATE</td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <table style="font-size:11px" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                         <tbody>
                                                            <tr>
                                                               <td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:18px;color:#6c6c6c;text-align:left;background-color:#d2d3d5;line-height:22px;padding-left:3px;font-weight:bold;width:50px">
                                                                  Sl No.
                                                               </td>

                                                               <td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:18px;color:#6c6c6c;text-align:left;background-color:#d2d3d5;line-height:22px;padding-left:3px;font-weight:bold;width:240px">
                                                                  Item Details
                                                               </td>
                                                               <td style="background-color:#d2d3d5;">&nbsp;</td>
                                                               <td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:18px;color:#6c6c6c;text-align:center;background-color:#d2d3d5;line-height:22px;padding-left:3px;font-weight:bold;width:70px">
                                                                  Qty.
                                                               </td>
                                                               <td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:18px;color:#6c6c6c;text-align:center;background-color:#d2d3d5;line-height:22px;padding-left:3px;font-weight:bold;width:70px">
                                                                  Unit
                                                               </td>
                                                               <td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:18px;color:#6c6c6c;text-align:center;background-color:#d2d3d5;line-height:22px;padding-left:3px;font-weight:bold;width:70px">
                                                                  Total Amount
                                                               </td>
                                                            </tr>

                                                            @PRODUCT_ARR
                                                            <tr style="background-color:#fff;font-weight:bold;color:#6c6c6c;font-family:arial">
                                                               <td colspan="4" style="text-align:right;white-space:nowrap;line-height:26px;border-top:1px solid #cccccc">
                                                                  Total Amount:
                                                               </td>
                                                               <td colspan="2" style="text-align:right;padding-left:15px;padding-right:15px; border-top:1px solid #cccccc"> Rs. @TOTAL_AMT</td>
                                                            </tr>
                                                            <tr style="background-color:#fff;font-weight:bold;color:#6c6c6c;font-family:arial">
                                                               <td colspan="4" style="text-align:right;white-space:nowrap;line-height:26px;border-top:1px solid #cccccc">
                                                                  Discount:
                                                               </td>
                                                               <td colspan="2" style="text-align:right;padding-left:15px; padding-right:15px;border-top:1px solid #cccccc"> Rs. @DISCOUNT</td>
                                                            </tr>
                                                            <tr style="background-color:#fff;font-weight:bold;color:#6c6c6c;font-family:arial">
                                                               <td colspan="4" style="text-align:right;white-space:nowrap;line-height:26px;border-top:1px solid #cccccc">
                                                                  Delivery Charges:
                                                               </td>
                                                               <td colspan="2" style="text-align:right;padding-left:15px; padding-right:15px;border-top:1px solid #cccccc"> Rs. @DELIVERY_CHARGE</td>
                                                            </tr>
                                                            <tr style="background-color:#fff;font-weight:bold;color:#6c6c6c;font-family:arial">
                                                               <td colspan="4" style="text-align:right;white-space:nowrap;line-height:26px;border-top:1px solid #cccccc;font-weight:bold">Payable Amount:</td>
                                                               <td colspan="2" style="text-align:right;padding-left:15px;padding-right:15px;border-top:1px solid #cccccc;font-weight:bold;color:#cc0000">@PAYABLE_AMT </td>
                                                            </tr>
                                                            <tr style="background-color:#fff;font-weight:bold;color:#6c6c6c;font-family:arial">
                                                               <td colspan="6" style="border-top:1px solid #cccccc;border-top:1px solid #666;font-weight:bold;color:#cc0000"></td>
                                                            </tr>
                                                            <tr>
                                                            </tr>
                                                            <tr style="background-color:#666;color:#fff;font-weight:bold;font-size:12px;font-family:arial">
                                                               <td colspan="4" style="text-align:right;white-space:nowrap;line-height:26px;font-weight:bold">
                                                                  Final Total:
                                                               </td>
                                                               <td colspan="2" style="text-align:right;padding-left:15px;padding-right:15px;white-space:nowrap;font-weight:bold">
                                                                  @PAYABLE_AMT
                                                               </td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </td>
                                                </tr>
                                                <tr style="background-color:#fff">
                                                   <td>
                                                      <p style="color:#6c6c6c;margin-bottom:5px;margin-left:20px;margin-right:0;margin-top:28px">Hope to see you soon again.</p><br>
                                                      <p style="color:#6c6c6c;margin-bottom:25px;margin-left:20px;margin-right:0;margin-top:28px">Happy shopping!<br><b> Team Vruits</b></p>
                                                   </td>
                                                </tr>
                                                <tr style="background-color:#fff">
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td style="background:#f2f2f2">
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
         </tbody>
      </table>
      <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
         <p> Powered by vruits </p>
      </div>
   </div>
</body>
</html>