

<?php 
$content = '
<head>
    <title>{{title}}</title>
</head>
<body background="assets/modules/administrator/img/icms_1.png" style=" background-size: 750px 900px; background-repeat: no-repeat;">

    <div class="card" style="width: 600px;  box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .25);  height: 730px; margin: 85px 65px; border-radius: 0px; border: 2px solid #f4f4f4; background-color: #fff; position: relative;">
        <br><table width="" >
            <tr>
                <td width="20%">
                    <img src="https://www.1343actionline.ph/images/logos/iacat.png"  style="width:50px; height:50px; margin-top: 20px; margin-left: 45px;">
                </td>
                <td width="80%">
                    <p style=" margin-top: 17px; font-family: Microsoft Yahei, sans-serif;  font-size: 16px; color: #1e518a; text-transform: uppercase; font-weight: 600;">Integrated Case Management System</p>
                </td>
            </tr>
        </table>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row" style=" margin-top: 0px;">
                   <p style="padding-left:65px; padding-right:65px;margin-top: 0px; text-align:center; font-family: san serif; font-size:14px;  color: #000; line-height: 24px;">
                        {{content}}
                    </p>
                    <p style="padding-left:65px; padding-right:65px;margin-top: 0px; text-align:center; font-family: san serif; font-size:14px;  color: #000; line-height: 24px;">
                        {{content-footer}}
                    </p>

                    <p style="margin-left:50px; font-family: san-serif; font-size:14px; text-align: left; color: #000;">Thank you,</p>
                    <span style="margin-left:50px; font-size:24px; text-align: left; font-family: cursive; color: #1e518a; margin-top: 0px;">IACAT</span>
                    <br>
                </div>
            </div>
        </div>
    </div>
</body>
';

return $content;

?>

