<?php

$privacy_link = MAIN_SITE_URL . "legal/privacy_policy";
$tns_link = MAIN_SITE_URL . "legal/term_of_use";
$support_link = MAIN_SITE_URL . "legal/contact_us";


$message = "";
$message .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
$message .= '<html xmlns="http://www.w3.org/1999/xhtml">';
$message .= '<head>';
$message .= '	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
$message .= '	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;">';
$message .= '	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />';

$message .= '    <title>E-Mail Verification</title>';
$message .= '    <style type="text/css">';
$message .= '    </style>';
$message .= '</head>';

$message .= '<body style="font-family:Arial,Helvetica,sans-serif;font-size:13px;background-color:#f2f2f4;color:#222;">';
$message .= '    <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">';
$message .= '        <tr>';
$message .= '            <td align="center" valign="top">';
$message .= '                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px; ">';
$message .= '                    <tr style="background-color:#0d9aac;">';
$message .= '                        <td></td>';
$message .= '                        <td>';
$message .= '                            <table border="0" cellpadding="10" cellspacing="0" width="100%">';
$message .= '                                <tr style="height:75px;">';
$message .= '                                    <td style="font-size:22px;color:#ffffff;padding-left:20px;" valign="bottom">E-Mail Verification</td>';
$message .= '                                    <td style="padding-right:20px;" valign="top" align="right">';
$message .= '                                        <img src="https://myjobopps.com/assets/modules/global/images/jobopps-logo.png" width="133px" height="43px" alt="JobOpps Logo">';
$message .= '                                    </td>';
$message .= '                                </tr>';
$message .= '                            </table>';
$message .= '                        </td>';
$message .= '                        <td></td>';
$message .= '                    </tr>';
$message .= '                   <tr>';
$message .= '                        <td style="width:10px;background-color:#f2f2f4;" valign="top">';
$message .= '                            <div style="height:30px;background-color:#0d9aac;"></div>';
$message .= '                        </td>';
$message .= '                        <td>';
$message .= '                            <table border="0" cellpadding="30" cellspacing="0" width="100%">';
$message .= '                                <tr>';
$message .= '                                    <td style="background-color:#ffffff;padding-top:25px;padding-right:25px;padding-bottom:0;padding-left:25px; " align="left" valign="top">';

//content start here
$message .= '                                          <h1 style="font-size:22px;font-weight:300;color:#0d9aac; ">Greetings from JobOpps!</h1>';
$message .= '                                          <p>Thank you for creating an account with us! You are just one step away from verifying your account.</p>';
$message .= '                                          <p>Click on the link below to verify your account.</p>';
$message .= '                                          <table border="0" cellpadding="30" cellspacing="0" width="100%">';
$message .= '                                              <tr>';
$message .= '                                                  <td style="background-color:#fafafa;padding-top:20px;padding-right:10px;padding-bottom:20px;padding-left:10px;" align="center">' . $aMailContent['data']['verification_link'] . '</td>';
$message .= '                                              </tr>';
$message .= '                                          </table>';
$message .= '                                          <br/>';
$message .= '                                          <p>Once verified, complete the required documents and information so you can start posting jobs. </p>';
$message .= '                                          <p>Moreover, you will receive our monthly newsletter (which is chock-full of JobOpps best practices and sample workflows, as well as productivity hacks). You will also get notification emails to let you know of changes within your JobOpps account.</p>';
$message .= '                                          <p>Thats all you need to get started with JobOpps! Feel free to contact us at <a href="#" style="color:#0d9aac; ">JobOpps Support</a> for further assistance.</p>';
//content end here

$message .= '                                        <br/>';
$message .= '                                        <p>We are excited to have you on board.</p>';
$message .= '                                        <p style="text-align:left;"><img src="https://myjobopps.com/assets/modules/global/images/team-jobopps.png" alt="Team JobOpps Text Photo" width="129px" height="76px"></p>';
$message .= '                                    </td>';
$message .= '                                </tr>';
$message .= '                                <tr>';
$message .= '                                        <td style="background-color:#fafafa;padding-top:16px;padding-right:5px;padding-bottom:16px;padding-left:5px;" align="center">';
$message .= '                                            <p style="margin-top:0;margin-bottom:0;">If you need help, email us at  <a href="mailto:info@jobopps.com.ph" style="color:#0d9aac;" target="_blank"> info@jobopps.com.ph </a> </p>';
$message .= '                                        </td>';
$message .= '                                </tr>';
$message .= '                                <tr>';
$message .= '                                    <td style="background:#ffffff;padding:15px;">';
$message .= '                                        <table border="0" cellpadding="5" cellspacing="0" width="100%">';
$message .= '                                            <tr>';
$message .= '                                                <td style="padding-bottom:5px;" align="center">';
$message .= '                                                    <a href="https://www.facebook.com/joboppsph/?jazoest=26510012154498467811018665571067057459010710578101531031036878747375551071021051189973101118107651171007189105103586510012152728080838099117122118748211390106116571107579105115859765571071149790521127865811071061221091204949119" target="_blank"><img src="https://myjobopps.com/assets/modules/global/images/social-media/facebook.png" alt="Facebook Logo" width="25px" height="25px"></a>';
$message .= '                                                    <a href="https://twitter.com/JobOppsPH" ><img src="https://myjobopps.com/assets/modules/global/images/social-media/twitter.png" alt="Twitter Logo" width="25px" height="25px"></a>';
$message .= '                                                    <a href="https://www.instagram.com/jobopps.ph/" target="_blank"><img src="https://myjobopps.com/assets/modules/global/images/social-media/instagram.png" alt="Instagram Logo" width="25px" height="25px"></a>';
$message .= '                                                </td>';
$message .= '                                            </tr>';
$message .= '                                            <tr>';
$message .= '                                                <td align="center">';
$message .= '                                                    <small style="font-style:italic;">Copyright &copy; 2018 JobOpps, All rights reserved.</small>';
$message .= '                                                </td>';
$message .= '                                            </tr>';
$message .= '                                            <tr>';
$message .= '                                                <td style="padding-bottom:2px;" align="center">';
$message .= '                                                </td>';
$message .= '                                            </tr>';
$message .= '                                            <tr>';
$message .= '                                                <td style="font-style:italic;" align="center">';
$message .= '                                                    <a href="' . $privacy_link . '" style="color:#0d9aac;text-decoration:none;"><small>Privacy Statement</small></a> / <a href="' . $tns_link . '" style="color:#0d9aac;text-decoration:none;"><small>Terms of Service</small></a> / <a href="#" style="color:#0d9aac;text-decoration:none;"><small>Unsubscribe</small></a>';
$message .= '                                                </td>';
$message .= '                                            </tr>';
$message .= '                                        </table>';
$message .= '                                    </td>';
$message .= '                                </tr>';
$message .= '                            </table>';
$message .= '                        </td>';
$message .= '                        <td style="width:10px;background-color:#f2f2f4;" valign="top">';
$message .= '                            <div style="height:30px;background-color:#0d9aac;"></div>';
$message .= '                        </td>';
$message .= '                    </tr>';
$message .= '                    <tr>';
$message .= '                        <td colspan="3" style="background-color:#444242;height:25px;">&nbsp;</td>';
$message .= '                    </tr>';
$message .= '                    <tr>';
$message .= '                        <td>&nbsp;</td>';
$message .= '                        <td style="background-color:#ffffff;padding:5px 16px;">';
$message .= '                            <p><small>If you did not create this account or have been registered in error, you can delete this account by clicking here. With your positive act of registering and continuous usage of <a href="https://jobopps.com.ph/" style="color:#0d9aac;" target="_blank">jobopps.com.ph</a>, you agree to be bound by the terms and conditions and  privacy policy. If you do not agree with any of the provision of these policies, you should not access or use <a href="https://jobopps.com.ph/" style="color:#0d9aac;" target="_blank">jobopps.com.ph</a> </small></p>';
$message .= '                        </td>';
$message .= '                        <td>&nbsp;</td>';
$message .= '                    </tr>';
$message .= '                </table>';
$message .= '            </td>';
$message .= '        </tr>';
$message .= '    </table>';
$message .= '</body>';
$message .= '</html>';

return $message;
?>

