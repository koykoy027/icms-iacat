<?php

/**
 *  Email Helper 
 * 
 * - GLOBAL Email Library 
 * - EMAIL TEMPLATE
 * 
 * @author kanashii Developers
 * @since 2016
 */
defined('BASEPATH') OR exit('No direct script access allowed');


// FUNCTIONS FOR EMAIL
// TEMPLATES

/**
 * Default Template 
 * 
 * @param mixed $mTitle
 * @param mixed $mContent
 * @param mixed $mCustomContent
 * @return mixed 
 */
function theme_default($mTitle = '', $mContent = '', $mCustomContent = null) {

    if (is_array($mCustomContent) !== true) {
        $mContent1 = $mCustomContent;
    }


    if (is_null($mCustomContent) !== false) {
        $mContent1 = '';
    }

    return '
    <html>

    <body>
        ' . $mTitle . ' <br>

        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td style="padding: 0 0 30px 0;">

                  ' . $mContent . ' <br>
                   ' . $mContent1 . '    

                </td>
            </tr>
        </table>
    </body>
    </html>';
}

/**
 * Email Message for  Failed Response
 * 
 * @param int $iId
 * @return array $aResponse
 */
function emailMessage($sId) {

    $sMessage = '';
    $aResponse = [];
    switch ($sId) {

        case 'invalid_email':
            $sMessage = 'Invalid Email';
            break;

        case 'to_should_array':
            $sMessage = 'Recepient should be in array form';
            break;

        case 'invalid_sms_parameter':
            $sMessage = 'Invalid SMS parameters';
            break;

        case 'invalid_email_parameter':
            $sMessage = 'Invalid email parameters [Email Subject  ]';
            break;

        case 'exclude_mail':
            $sMessage = 'sending mail for this record is not active';
            break;

        case 'missing_required_parameter':
            $sMessage = 'Required parameters are missing';
            break;

        case 'unacceptable_email':
            $sMessage = 'Unacceptable format of email. Doesnt passed on the whitelisting rules.';
            break;

        case 1:
            $sMessage = ' Sender ID is required. ';
            break;

        case 2:
            $sMessage = ' Recipient ID should be an array form or not empty ';
            break;

        case 3:
            $sMessage = ' Content shoud lbe an array form or not empty ';
            break;

        case 4:
            $sMessage = ' You must have atleast one recipient ';
            break;

        case 5:
            $sMessage = ' Content should be complete. [ title , body , href ] ';
            break;

        default:
            $sMessage = 'Notification message encountered some technical problem.';
    }

    // build return
    $aResponse = array(
        'flag' => 0,
        'message' => $sMessage
    );

    return $aResponse;
}
