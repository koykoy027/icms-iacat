<?php

// switch error message
define('ERROR_DISPLAY_SWITCH', 1);

ini_set('display_errors', ERROR_DISPLAY_SWITCH);
ini_set('display_startup_errors', ERROR_DISPLAY_SWITCH);
error_reporting(E_ALL);

ini_set('memory_limit', '64M');

require_once('lib/constants.php');

require_once('lib/mailer/PHPMailerAutoload.php');

require_once "pepipost/vendor/autoload.php";

/**
 * CRON JOBS 
 */
class CronJob {

    public $yel;

    public function __construct() {

        // date time
        date_default_timezone_set('Asia/Manila');

        // database
        require('lib/yel.php');
        $this->yel = new Yel();
    }


    public function doSend() {

        $aMail = $this->_getMails();

        if (!empty($aMail['unsent'][0]['mailbox_id']) !== false) {
            foreach ($aMail['unsent'] as $key => $val) {

                $mail = new PHPMailer;

                $this->_setToProcess($val['mailbox_id']);

                $mail->isSMTP();

                //Enable SMTP debugging
                // 0 = off (for production use)
                // 1 = client messages
                // 2 = client and server messages
                $mail->SMTPDebug = 2;

                $mail->Debugoutput = 'html';

                /**
                 * Config
                 */
                $mail->Host = 'ssl://smtp.gmail.com';
                $mail->Port = 465;
                $mail->SMTPSecure = 'tls';
                $mail->SMTPAuth = true;
                $mail->Username = "<ICMS_EMAIL_ADDRESS>";
                $mail->Password = "<ICMS_EMAIL_ADDRESS_PASSWORD>";

                $mail->setFrom($val['mailbox_sender_mail'], $val['mailbox_sender_name']);

                $mail->addReplyTo('<ICMS_EMAIL_ADDRESS>', 'Support Team');

                $mail->addAddress($val['mailbox_receiver'], 'ICMS User');

                $mail->Subject = $val['mailbox_subject'];


                $mail->msgHTML($val['mailbox_message']);

                $mail->AltBody = 'This is a plain-text message body';

                if (!$mail->send()) {


                    $client = new PepipostAPILib\PepipostAPIClient();
                    $emailController = $client->getEmail();

                    $apiKey = '<PEPIPOST_API_KEY>'; #add apikey from panel here

                    $body = new PepipostAPILib\Models\EmailBody();


                    // List of Email Recipients
                    $body->personalizations = array();
                    $body->personalizations[0] = new PepipostAPILib\Models\Personalizations;
                    $body->personalizations[0]->recipient = $val['mailbox_receiver'];               #To/Recipient email address
                    // Email Header
                    $body->from = new PepipostAPILib\Models\From;
                    $body->from->fromEmail = '<ICMS_EMAIL_ADDRESS>';   #Sender Domain. Note: The sender domain should be verified and active under your Pepipost account.
                    $body->from->fromName = 'ICMS';       #Sender/From name
                    //Email Body Content
                    $body->subject = $val['mailbox_subject'];               #Subject of email
                    $body->content = $val['mailbox_message']; #HTML content which need to be send in the mail body
                    // Email Settings
                    $body->settings = new PepipostAPILib\Models\Settings;
                    $body->settings->clicktrack = 1;    #clicktrack for emails enable=1 | disable=0
                    $body->settings->opentrack = 1;     #opentrack for emails enable=1 | disable=0
                    $body->settings->unsubscribe = 0;   #unsubscribe for emails enable=1 | disable=0

                    $response = $emailController->createSendEmail($apiKey, $body);   #function sends email
                    // print_r(json_encode($response));

                    $this->_setToSent($val['mailbox_id']);
                } else {
                    echo " <br>  Message sent!";

                    $this->_setToSent($val['mailbox_id']);
                }
            }
        } else {
            echo " <br>  No record to be send.";
        }

        // double check
        $this->_secondAttempt();
    }

    private function _secondAttempt() {

        $aMail = $this->_getFailedMails();

        $mail = new PHPMailer;

        if (!empty($aMail['unsent'][0]['mailbox_id']) !== false) {
            foreach ($aMail['unsent'] as $key => $val) {


                $this->_setToProcess($val['mailbox_id']);

                $mail->isSMTP();

                //Enable SMTP debugging
                // 0 = off (for production use)
                // 1 = client messages
                // 2 = client and server messages
                $mail->SMTPDebug = 2;

                $mail->Debugoutput = 'html';

                /**
                 * Config
                 */
                $mail->Host = 'ssl://smtp.gmail.com';
                $mail->Port = 465;
                $mail->SMTPSecure = 'tls';
                $mail->SMTPAuth = true;
                $mail->Username = "<ICMS_EMAIL_ADDRESS>";
                $mail->Password = "<ICMS_EMAIL_ADDRESS_PASSWORD>";

                $mail->setFrom($val['mailbox_sender_mail'], $val['mailbox_sender_name']);

                $mail->addReplyTo('<ICMS_EMAIL_ADDRESS>', 'ICMS Team');

                $mail->addAddress($val['mailbox_receiver'], 'ICMS');

                $mail->Subject = $val['mailbox_subject'];


                $mail->msgHTML($val['mailbox_message']);

                $mail->AltBody = 'This is a plain-text message body';


                // $mail->addAttachment('images/phpmailer_mini.png');

                if (!$mail->send()) {
                        
                    $client = new PepipostAPILib\PepipostAPIClient();
                    $emailController = $client->getEmail();

                    $apiKey = '<PEPIPOST_API_KEY>'; #add apikey from panel here

                    $body = new PepipostAPILib\Models\EmailBody();


                    // List of Email Recipients
                    $body->personalizations = array();
                    $body->personalizations[0] = new PepipostAPILib\Models\Personalizations;
                    $body->personalizations[0]->recipient = $val['mailbox_receiver'];               #To/Recipient email address
                    // Email Header
                    $body->from = new PepipostAPILib\Models\From;
                    $body->from->fromEmail = '<ICMS_EMAIL_ADDRESS>';   #Sender Domain. Note: The sender domain should be verified and active under your Pepipost account.
                    $body->from->fromName = 'ICMS';       #Sender/From name
                    //Email Body Content
                    $body->subject = $val['mailbox_subject'];               #Subject of email
                    $body->content = $val['mailbox_message']; #HTML content which need to be send in the mail body
                    // Email Settings
                    $body->settings = new PepipostAPILib\Models\Settings;
                    $body->settings->clicktrack = 1;    #clicktrack for emails enable=1 | disable=0
                    $body->settings->opentrack = 1;     #opentrack for emails enable=1 | disable=0
                    $body->settings->unsubscribe = 0;   #unsubscribe for emails enable=1 | disable=0

                    $response = $emailController->createSendEmail($apiKey, $body);   #function sends email

                    $this->_setToSent($val['mailbox_id']);
                } else {
                    echo " <br>  Message sent!";

                    $this->_setToSent($val['mailbox_id']);
                }
            }
        } else {
            echo "<br> No record to be send for the second time around .. xD.";
        }
    }

    private function _setToProcess($id) {

        $aResponse = [];

        $sSequel = "
            UPDATE `icms_mailbox` SET
            `mailbox_is_process` = 1,
            `mailbox_date_modified` = now()
            WHERE
            `mailbox_id` = '" . $id . "' 
            ";
        $aResponse['set2process'] = $this->yel->GetAll($sSequel);

        return $aResponse;
    }

    private function _setToSent($id) {
        $aResponse = [];

        $sSequel = "
            UPDATE `icms_mailbox` SET
            `mailbox_is_sent` = 1,
            `mailbox_date_modified` = now()
            WHERE
            `mailbox_id` = '" . $id . "'
            ";
        $aResponse['set2sent'] = $this->yel->GetAll($sSequel);

        return $aResponse;
    }

    private function _getMails() {

        $aResponse = [];

        $sSequel = "
            SELECT 
            *
            FROM
            `icms_mailbox`
            WHERE
            `mailbox_is_process` = 0
            ";
        $aResponse['unsent'] = $this->yel->GetAll($sSequel);

        return $aResponse;
    }

    private function _getFailedMails() {

        $aResponse = [];

        $sSequel = "
            SELECT 
            *
            FROM
            `icms_mailbox`
            WHERE
            `mailbox_is_process` = 1 AND 
            `mailbox_is_sent` = 0 
            ";
        $aResponse['unsent'] = $this->yel->GetAll($sSequel);

        return $aResponse;
    }

}

$auto = new CronJob();
$auto->doSend();


$i = 1;
while ($i <= 5) {

    sleep(10);

    $auto->doSend();

    $i++;
}
