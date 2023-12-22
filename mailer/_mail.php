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

                    $this->_setToProcess($val['mailbox_id']);

                    $api_link = "https://api.smtp2go.com/v3/email/send";
                    $api_key = "<SMTP2GO_API_KEY>";

                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curl, CURLOPT_POST, 1);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                      "Content-Type: application/json"
                    ));

                    curl_setopt($curl, CURLOPT_URL,
                      $api_link
                    );

                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array(
                      "sender" => $val['mailbox_sender_mail'],
                      "to" => array(
                        0 => $val['mailbox_receiver']
                      ),
                      "html_body" => $val['mailbox_message'],
                      "subject" => $val['mailbox_subject'],
                      "api_key" => $api_key
                    )));
                    $result = curl_exec($curl);

                    print_r(json_encode($result));

                    $this->_setToSent($val['mailbox_id']);

            }
        } else {
            echo " <br>  No record to be send.";
        }

        // double check
        $this->_secondAttempt();
    }

    public function sendEmails(){

        $aMail = $this->_getMails();

        if (!empty($aMail['unsent'][0]['mailbox_id']) !== false) {
            foreach ($aMail['unsent'] as $key => $val) {

                $this->_setToProcess($val['mailbox_id']);

                $eMail = "<ICMS_EMAIL_ADDRESS>";
                $eName = "ICMS Notification";
                $eSubject = $val['mailbox_subject'];
                $eContent =  base64_decode(htmlentities($val['mailbox_message']));
                $rEmail = $val['mailbox_receiver'];
                $rName = "ICMS User";
                $key = "<PEPIPOST_API_KEY>";

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.pepipost.com/v5/mail/send",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "{\"from\":{\"email\":\"" . $eMail . "\",\"name\":\"" . $eName . "\"},\"subject\":\"" . $eSubject . "\",\"content\":[{\"type\":\"html\",\"value\":\"" . $eContent . "\"}],\"personalizations\":[{\"to\":[{\"email\":\"" . $rEmail . "\",\"name\":\"" . $rName . "\"}]}]}",
                    CURLOPT_HTTPHEADER => array(
                        "api_key: <PEPIPOST_API_KEY>",
                        "content-type: application/json"
                    ),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    echo $response;
                    $this->_setToSent($val['mailbox_id']);
                }

                // $mail->addAttachment('images/phpmailer_mini.png');
            }
        } else {
            echo " <br>  No record to be send.";
        }

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
                $mail->Host = 'ssl://mail.smtp2go.com';
                $mail->Port = 465;
                $mail->SMTPSecure = 'tls';
                $mail->SMTPAuth = true;
                $mail->Username = "<SMTP2GO_USERNAME>";
                $mail->Password = "<SMTP2GO_PASSWORD>";

                $mail->setFrom($val['mailbox_sender_mail'], $val['mailbox_sender_name']);

                $mail->addAddress($val['mailbox_receiver'], 'ICMS User');

                $mail->Subject = $val['mailbox_subject'];


                $mail->msgHTML($val['mailbox_message']);

                $mail->AltBody = 'This is a plain-text message body';


                // $mail->addAttachment('images/phpmailer_mini.png');

                if (!$mail->send()) {

                $api_link = "https://api.smtp2go.com/v3/email/send";
                    $api_key = "<SMTP2GO_API_KEY>";

                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curl, CURLOPT_POST, 1);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                      "Content-Type: application/json"
                    ));

                    curl_setopt($curl, CURLOPT_URL,
                      $api_link
                    );

                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array(
                      "sender" => $val['mailbox_sender_mail'],
                      "to" => array(
                        0 => $val['mailbox_receiver']
                      ),
                      "html_body" => base64_decode($val['mailbox_message']),
                      "subject" => $val['mailbox_subject'],
                      "api_key" => $api_key
                    )));
                    $result = curl_exec($curl);


                    print_r(json_encode($result));
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
//$auto->sendEmails();

$i = 1;
while ($i <= 5) {

    sleep(10);

    $auto->doSend();
//    $auto->sendEmails();

    $i++;
}








