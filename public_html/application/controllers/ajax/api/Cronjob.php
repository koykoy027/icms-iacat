<?php

/**
 * Reports Internal Ajax
 * 
 * @module Ajax Loader
 * @author LBS eBusiness Solutions Corp. 
 * @since 2017
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Cronjob extends CI_Controller {

    const SUCCESS_RESPONSE = 1;
    const FAILED_RESPONSE = 0;

    public function __construct() {
        parent::__construct();

        // load models
        $this->load->model('Api/Cronjob_model');
    }

    /**
     * Ajax Route :: Action Controller
     */
    public function ajax() {

        // route ajax api
        $this->base_action_ajax();
    }

//    public function sessionDestruct() {
//        // session destroy
//        $this->sessionPushLogout('');
//    }


    public function cronJobLink($aParam) {
        $threeDays = array();
        $xpiredIn3Days = $this->Cronjob_model->getServicesAgeDueInThreeDays($aParam);
        $currentID = "";
        $user_firstname = "";
        $user_lastname = "";
        $user_email = "";
        $caseAndservice = "";

        foreach ($xpiredIn3Days as $key => $val) {
            if ($currentID == "") {
                $currentID = $val['user_id'];
                $user_firstname = $val['fname'];
                $user_lastname = $val['lname'];
                $user_email = $val['email'];
                $caseAndservice = $val['case_number'] . " - " . $val['service_name'] . "-" . $val['aging_date'] . "; ";
            } else {
                if ($val['user_id'] == $currentID) {
                    $caseAndservice .= $val['case_number'] . " - " . $val['service_name'] . "-" . $val['aging_date'] . "; ";
                } else {
                    $newArray = array('user_id' => $currentID, 'fname' => $user_firstname, 'lname' => $user_lastname, 'email' => $user_email, 'caseAndService' => $caseAndservice);
                    array_push($threeDays, $newArray);
                    $currentID = $val['user_id'];
                    $user_firstname = $val['fname'];
                    $user_lastname = $val['lname'];
                    $user_email = $val['email'];
                    $caseAndservice = $val['case_number'] . " - " . $val['service_name'] . "-" . $val['aging_date'] . "; ";
                }
            }
        }

        $newArray = array('user_id' => $currentID, 'fname' => $user_firstname, 'lname' => $user_lastname, 'email' => $user_email, 'caseAndService' => $caseAndservice);
        array_push($threeDays, $newArray);


        $pastDue = array();
        $afterDue = $this->Cronjob_model->getServicesAgeAfterDue($aParam);
        $currentID = "";
        $user_firstname = "";
        $user_lastname = "";
        $user_email = "";
        $caseAndservice = "";


        foreach ($afterDue as $key => $val) {
            if ($currentID == "") {
                $currentID = $val['user_id'];
                $user_firstname = $val['fname'];
                $user_lastname = $val['lname'];
                $user_email = $val['email'];
                $caseAndservice = $val['case_number'] . " - " . $val['service_name'] . "-" . $val['aging_date'] . "; ";
            } else {
                if ($val['user_id'] == $currentID) {
                    $caseAndservice .= $val['case_number'] . " - " . $val['service_name'] . "-" . $val['aging_date'] . "; ";
                } else {
                    $newArrayPast = array('user_id' => $currentID, 'fname' => $user_firstname, 'lname' => $user_lastname, 'email' => $user_email, 'caseAndService' => $caseAndservice);
                    array_push($pastDue, $newArrayPast);
                    $currentID = $val['user_id'];
                    $user_firstname = $val['fname'];
                    $user_lastname = $val['lname'];
                    $user_email = $val['email'];
                    $caseAndservice = $val['case_number'] . " - " . $val['service_name'] . "-" . $val['aging_date'] . "; ";
                }
            }
        }

        $newArrayPast = array('user_id' => $currentID, 'fname' => $user_firstname, 'lname' => $user_lastname, 'email' => $user_email, 'caseAndService' => $caseAndservice);
        array_push($pastDue, $newArrayPast);

        $this->sendEmailToUpdateServices($threeDays, 'threeDaysBefore');
        $this->sendEmailToUpdateServices($pastDue, 'pastDue');
        return true;
    }

    private function sendEmailToUpdateServices($aData, $sendingType) {

        foreach ($aData as $key => $val) {
            $tblService = "";
            $reportNumberlist = "";
            $tblService = "<table cellpadding='5' style='border: 1px solid rgba(0,0,0,0.1)'>";
            $tblService .= "<thead >";
            $tblService .= "<tr>";
            $tblService .= "<th style='border-bottom: 1px solid rgba(0,0,0,0.1);'align='left'>Report Number</th>";
            $tblService .= "<th style='border-bottom: 1px solid rgba(0,0,0,0.1)' align='left'>Service Name</th>";
            $tblService .= "<th style='border-bottom: 1px solid rgba(0,0,0,0.1)' align='left'>Aging Date</th>";
            $tblService .= "</tr>";
            $tblService .= "</thead>";
            $tblService .= "<tbody>";

            $xpldService = explode(";", $val['caseAndService']);
            $ctr = 0;
            $service = "";
            foreach ($xpldService as $serv) {
                if ($service !== $serv) {
                    if (isset($serv[$ctr]) == true) {
                        //separate reportid and service name
                        $newVal = explode("-", $serv);
                        $tblService .= "<tr>";
                        $yearMonthDay = date('F d, Y', strtotime($newVal[2] . "-" . $newVal[3] . "-" . $newVal[4]));
                        $tblService .= "<td align>" . $newVal[0] . "</td><td>" . $newVal[1] . "</td><td>" . $yearMonthDay . "</td>";
                        $tblService .= "</tr>";
                    }
                    if ($reportNumberlist == "") {
                        $reportNumberlist = $newVal[0];
                    } else {
                        $reportNumberlist = ", " . $newVal[0];
                    }
                }
                $service = $serv;
                $ctr++;
            }

            $tblService .= "</body>";

            $tblService .= "</table>";
            // system notification here

            $aNotif['method'] = "cases";
            $aNotif['tbl_id'] = 0;
            $aNotif['receiver'] = $val['user_id'];
            $aNotif['notif_type'] = "1";
            if ($sendingType = "pastDue") {
                $aNotif['msg'] = "Attention : Tagged report <a href='cases'>" . $reportNumberlist . "</a> requires your attention.";
            } else {
                $aNotif['msg'] = "Reminder : Tagged report<a href='cases'> " . $reportNumberlist . "</a> will be due in 3 days time.";
            }
            $this->notif->create($aNotif);

            // send email in this part
            $aEmail = [];
            $aEmail['data']['recipient_name'] = $val['fname'];
            $aEmail['data']['serviceTBLList'] = $tblService;
            $aEmail['data']['sendingType'] = $sendingType;
            $aEmail['to'] = $val['email'];
            $aEmail['subject'] = 'Report:Service update';
            $aSendMail = $this->mailbox->sendEmailWithTemplate('service_update', $aEmail);
        }


        return true;
    }

}
