


<?php

$temp = '';


$temp .= '<head>';
$temp .= '    <title>Tagged Case</title>';
$temp .= '</head>';
$temp .= '<body background='.SITE_URL.'/modules/administrator/img/icms_1.png" style=" background-size: 750px 900px; background-repeat: no-repeat;">';
$temp .= '    <div class="card" style="width: 600px;  box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .25);  height: 730px; margin: 85px 65px; border-radius: 0px; border: 2px solid #f4f4f4; background-color: #fff; position: relative;">';
$temp .= '        <br><table width="" >';
$temp .= '            <tr>';
$temp .= '                <td width="20%">';
$temp .= '                    <img src="https://www.1343actionline.ph/images/logos/iacat.png"  style="width:50px; height:50px; margin-top: 20px; margin-left: 45px;">';
$temp .= '                </td>';
$temp .= '                <td width="80%">';
$temp .= '                    <p style=" margin-top: 17px; font-family: Microsoft Yahei, sans-serif;  font-size: 16px; color: #1e518a; text-transform: uppercase; font-weight: 600;">Integrated Case Management System</p>';
$temp .= '                </td>';
$temp .= '            </tr>';
$temp .= '        </table>';
$temp .= '        <div class="row">';
$temp .= '            <div class="col-lg-12 col-md-12 col-sm-12">';
$temp .= '                <div class="row" style=" margin-top: 0px;">';
$temp .= '                    <p style="font-size:16px;  font-family: san-serif; margin-left: 0; margin-top: 40px; color: #000; margin-left:50px;">';
$temp .= '                        Hi <span style="font-family: san-serif; font-size:20px; color: #12447b; text-transform:capitalize;">Kimmy</span>,';
$temp .= '                    </p>';
$temp .= '                    <p style=" font-size: 25px; color: #1e518a; font-family: san serif; text-align:center; line-height: 42px; margin-top: 40px; ">';
$temp .= '                      New Tagged Case';
$temp .= '                    </p>                                                                    ';
$temp .= '                    <img src="assets/modules/administrator/img/human_traffic.png" style=" width: 255px; margin-top: -32px; margin-left: 172px; height: 140px; ">';
$temp .= '                    <p style="padding-left:65px; padding-right:65px;margin-top: 0px; text-align:center; font-family: san serif; font-size:14px;  color: #000; line-height: 24px;">';
$temp .= '                        Your agency has been tagged in a new case filed by . A trafficked person with case number <b>CN13123123123</b> is in need of your help. ';
$temp .= '                    </p>';
$temp .= '                    <p style="padding-left:65px; padding-right:65px;margin-top: 0px; text-align:center; font-family: san serif; font-size:14px;  color: #000; line-height: 24px;">';
$temp .= '                        To view details of the case, login to ICMS using your account and search using the case number.';
$temp .= '                    </p>';
$temp .= '                    <button type="button" style="background-color:#ffb011;color: #000; font-family:sen-serif; border:1px solid #ffb011; border-radius: 5px;  color: #fff; padding: 6px 45px; font-size: 12px; margin-left: 190px; ">';
$temp .= '                        Login to your account';
$temp .= '                    </button>';
$temp .= '                    <p style="margin-left:50px; font-family: san-serif; font-size:14px; text-align: left; color: #000;">Thank you,</p>';
$temp .= '                    <span style="margin-left:50px; font-size:24px; text-align: left; font-family: cursive; color: #1e518a; margin-top: 0px;">IACAT</span>';
$temp .= '                    <br>';
$temp .= '                </div>';
$temp .= '            </div>';
$temp .= '        </div>';
$temp .= '    </div>';
$temp .= '</body>';

return $temp;
?>