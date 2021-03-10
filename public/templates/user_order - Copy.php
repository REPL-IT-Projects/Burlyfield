 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

 <html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">



 <head>

    <meta name="viewport" content="width=device-width" />

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <link rel="icon" type="image/png" sizes="16x16" href="../../public/assets/images/site_imges/favicon.png">

    <title>Vruits Registration</title>

</head>



<body style="margin:0px; background: #f8f8f8; ">

    <div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">

        <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">

            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">

                <tbody>

                    <tr>

                        <td style="vertical-align: top; padding-bottom:30px;" align="center"><img src="http://cidev.in/vruits/public/assets/images/site_imges/Logo.png" alt="vruits" style="border:none"><br/>

                        </td>

                    </tr>

                </tbody>

            </table>

            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">

                <tbody>

                    <tr>

                        <td style="background:#ec7546; padding:20px; color:#fff; text-align:center;"> <b>Dear @NAME,</b> Thank you very much for order in vruits. </td>

                    </tr>

                </tbody>

            </table>

            <div style="padding: 40px; background: #fff;">

                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">

                    <tbody>

                        <tr>

                            <td><b>@NAME</b>

                                <p style="margin-top:0px;">Invoice #@ORDNO</p>

                            </td>

                            <td align="right" width="100"> @ADDDATE </td>

                        </tr>

                        <tr>

                            <td>

                                <b>Your Order Details:</b>

                            </td>

                        </tr>

                        

                        <tr>

    <td colspan="2" style="padding:20px 0; border-top:1px solid #f6f6f6;">

        <div>

            <table width="100%" cellpadding="0" cellspacing="0">

                <tbody>

                    @PRODUCT_ARR

                    <tr class="total">

                            <td style="font-family: "arial"; font-size: 14px; vertical-align: middle; border-top-width: 1px; border-top-color: #f6f6f6; border-top-style: solid; margin: 0; padding: 9px 0; font-weight:bold;" width="80%">Total Amount</td>

                            <td style="font-family: "arial"; font-size: 14px; vertical-align: middle; border-top-width: 1px; border-top-color: #f6f6f6; border-top-style: solid; margin: 0; padding: 9px 0; font-weight:bold;" align="right">@TOTAL_AMT</td>

                        </tr>

                        <tr class="total">

                            <td style="font-family: "arial"; font-size: 14px; vertical-align: middle; border-top-width: 1px; border-top-color: #f6f6f6; border-top-style: solid; margin: 0; padding: 9px 0; font-weight:bold;" width="80%">Payable Amount</td>

                            <td style="font-family: "arial"; font-size: 14px; vertical-align: middle; border-top-width: 1px; border-top-color: #f6f6f6; border-top-style: solid; margin: 0; padding: 9px 0; font-weight:bold;" align="right">@PAYABLE_AMT</td>

                        </tr>

                </tbody>

            </table>

        </div>

    </td>

                        </tr>

                        <tr>

                            <td><b>- Thanks (Vruits team)</b></td>

                        </tr>

                    </tbody>

                </table>

            </div>

            <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">

                <p> Powered by vruits

                    <br>

                    <a href="javascript: void(0);" style="color: #b2b2b5; text-decoration: underline;">Unsubscribe</a> </p>

                </div>

            </div>

        </div>

    </body>

    </html>