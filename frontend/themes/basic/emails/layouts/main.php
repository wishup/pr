<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:v="urn:schemas-microsoft-com:vml"
      xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <!--[if gte mso 9]><xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml><![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="initial-scale=1.0" />
    <meta name="format-detection" content="telephone=no" />

    <title><?= Yii::$app->params["project_name"] ?></title>
    <style type="text/css">
        /* CLIENT-SPECIFIC RESETS */
        .ReadMsgBody{width:100%;} .ExternalClass{width:100%;}
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;}
        table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;}
        img{-ms-interpolation-mode: bicubic;}
        body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}
        .appleLinks a{color:#3c3c3c;}

        /* Ipad styles */
        @media only screen and (max-width: 640px) {
            a[href^="tel"], a[href^="sms"] {
                text-decoration: none;
                color: #000000;
                pointer-events: none;
                cursor: default;
            }
            .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                text-decoration: underline;
                color: #000000 !important;
                pointer-events: auto;
                cursor: default;
            }
            table[class="container"]{
                width: 100%!important;
                text-align: center!important;
            }
            td[class="fullwidth"]{
                width: 100%!important;
                display: block!important;
            }
            td[class="hide"]{
                display: none!important;
            }
            td[class="center"]{
                width: 100%!important;
                display: block!important;
                text-align: center!important;
            }
            img[class="imgwidth"]{
                width: 100%!important;
                height: auto!important;
            }
            td[class="padsm"]{
                height:25px;
            }
        }
        /*Iphone styles*/
        @media only screen and (max-width: 480px){
            img[class="smallimgwidth"]{
                width: 100%!important;
                height: auto!important;
            }
            table[class="btnxs"]{
                width:260px;
            }
            td[class="btnxs"]{
                width:260px;
            }
            td[class="titlexs"]{
                font-size:26px !important;
            }
            td[class="textxs"]{
                font-size:14px !important;
            }
        }
    </style>
</head>
<body style="margin: 0; padding: 0;">
<!-- wrapper -->
<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-collapse: collapse; background-color: #ffffff;">
    <tr>
        <td align="center" valign="top">
            <table class="container" width="580" align="center" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">
                <tr>
                    <td width="15">&nbsp;</td>
                    <td align="center" valign="top">
                        <!-- header -->
                        <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">

                            <tr><td height="30" style="font-size: 0; line-height: 0;">&nbsp;</td></tr>
                            <tr>
                                <td align="center" valign="top">
                                    <a href="<?= Yii::$app->params["domainUrl"] ?>" target="_blank" style="font-family: Arial, Helvetica, sans-serif; font-size: 40px; color: #bdd82e; text-decoration: none;">
                                        <img src="<?= Yii::$app->params["domainUrl"] ?>images/email/logo.jpg" alt="<?= Yii::$app->params["project_name"] ?>" width="251" height="67" border="0" style="display: block; outline: none" />
                                    </a>
                                </td>
                            </tr>
                        </table>
                        <!-- /header -->
                        <?= $content; ?>
                        <!-- footer -->
                        <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">
                            <tr><td class="padsm" colspan="3" height="40" style="font-size: 0; line-height: 0;">&nbsp;</td></tr>
                            <tr>
                                <td class="center" align="center" valign="top">
                                    <table class="container" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">
                                        <tr>
                                            <td>
                                                <table align="center" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">
                                                    <tr>
                                                        <td width="46" align="center" valign="middle" style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 15px; color: #c9d200;">
                                                            <a href="<?= Yii::$app->params["settings"]["facebook_link"] ?>" target="_blank" style="font-family: OpenSans, Arial, sans-serif; font-size: 11px; line-height: 25px;text-transform:uppercase;text-decoration:none;color:#4d4d4d;">
                                                                <img src="<?= Yii::$app->params["domainUrl"] ?>images/email/icon_fb.png" alt="facebook" width="46" height="40" border="0" style="display:block; outline: none;" />Facebook
                                                            </a>
                                                        </td>
                                                        <td width="30">&nbsp;</td>
                                                        <td width="46" align="center" valign="middle" style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 15px; color: #c9d200;">
                                                            <a href="<?= Yii::$app->params["domainUrl"] ?>contact" target="_blank" style="font-family: OpenSans, Arial, sans-serif; font-size: 11px; line-height: 25px;text-transform:uppercase;text-decoration:none;color:#4d4d4d;">
                                                                <img  src="<?= Yii::$app->params["domainUrl"] ?>images/email/icon_email.png" alt="email" width="46" height="40" border="0" style="display:block; outline: none;" />email
                                                            </a>
                                                        </td>
                                                        <td width="30">&nbsp;</td>
                                                        <td width="46" align="center" valign="middle" style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 15px; color: #c9d200;">
                                                            <a href="<?= Yii::$app->params["domainUrl"] ?>" target="_blank" style="font-family: OpenSans, Arial, sans-serif; font-size: 11px; line-height: 25px;text-transform:uppercase;text-decoration:none;color:#4d4d4d;">
                                                                <img  src="<?= Yii::$app->params["domainUrl"] ?>images/email/icon_website.png" alt="website" width="46" height="40" border="0" style="display:block; outline: none;" />website
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table width="50" align="center" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;border-bottom:solid 1px #dfe3e6;">
                                                    <tr><td height="15" style="font-size: 0; line-height: 0;">&nbsp;</td></tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr><td height="15" style="font-size: 0; line-height: 0;">&nbsp;</td></tr>
                                        <tr><td align="center" style="font-family: OpenSans, Arial, sans-serif; font-size: 11px; line-height: 11px;color:#3f4652;" >Copyright © <?= date("Y") ?> <?= Yii::$app->params["project_name"] ?>, All rights reserved.</td></tr>
                                        <tr><td height="10" style="font-size: 0; line-height: 0;">&nbsp;</td></tr>
                                        <tr><td align="center" style="font-family: OpenSans, Arial, sans-serif; font-size: 11px; line-height: 11px;color:#3f4652;" >Thank you for registering for <?= Yii::$app->params["project_name"] ?></td></tr>
                                        <?php if( isset($unsubscribe) ){ ?><tr><td align="center" style="font-family: OpenSans, Arial, sans-serif; font-size: 11px; line-height: 11px;color:#3f4652;" ><?= $unsubscribe; ?></td></tr><?php } ?>
                                        <tr>
                                            <td>
                                                <table width="180" align="center" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;border-bottom:solid 1px #dfe3e6;">
                                                    <tr><td height="10" style="font-size: 0; line-height: 0;">&nbsp;</td></tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr><td class="padsm" colspan="3" height="40" style="font-size: 0; line-height: 0;">&nbsp;</td></tr>
                        </table>
                        <!-- /footer -->
                    </td>
                    <td width="15">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<!-- /wrapper -->
</body>
</html>