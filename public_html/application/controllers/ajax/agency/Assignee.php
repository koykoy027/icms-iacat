<?php

/**
 * Case Internal Ajax
 * 
 * @module Ajax Loader
 * @author LBS eBusiness Solutions Corp. 
 * @since 2017
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Assignee extends CI_Controller {

    const SUCCESS_RESPONSE = 1;
    const FAILED_RESPONSE = 0;

    public function __construct() {
        parent::__construct();

        // load models
        $this->load->model('agency/Assignee_model');
        $this->load->model('agency/Users_model');
    }

    /**
     * Ajax Route :: Action Controller
     */
    public function ajax() {
//        echo 'test'; exit();
        // route ajax api
        $this->base_action_ajax();
    }

    public function sessionDestruct() {
        // session destroy
        $this->sessionPushLogout('admininistrator');
    }

    public function setAssigneeByCaseId($aParam) {
        $aResponse = [];
        $aResult = [];
        $aLog_info = [];
        $sStatus = 'Tagged';
        $sAssign = 'assigned';
        $aResult['flag'] = self::FAILED_RESPONSE;
        $aParam['inp_user_id'] = $_SESSION['userData']['user_id'];
        $aParam['case_id'] = $this->yel->decrypt_param($aParam['case_id']);
        $aParam['user_id'] = $this->yel->decrypt_param($aParam['user_id']);

        $aResult['aParam'] = $aParam;
        $aResult['check'] = $this->Assignee_model->checkCaseTaggedExist($aParam);
        $aParam['case_number'] = $this->Assignee_model->getCaseNumberByCaseId($aParam);

        $aParam['user_info'] = $this->Users_model->getUsersInfobyID($aParam);

        if ($aParam['status'] == '0') {
            $sStatus = 'Untagged';
            $sAssign = ' unassigned ';
        }

        if (((int) $aResult['check']) > 0) {
            $aLog_info['old_data'] = $this->Assignee_model->getAssigneeStatus($aParam);
            $update_id = $this->Assignee_model->updateCaseTagged($aParam);
            $aResult['res']['stat'] = 1;
            $aLog_info['new_data'] = $this->Assignee_model->getAssigneeStatus($aParam);

            // Log info for update 
            $aLog_info['log_action'] = 2;
            $aLog_info['new_data'] = $this->yel->encrypt_param(json_encode($aLog_info['new_data']));
            $aLog_info['old_data'] = $this->yel->encrypt_param(json_encode($aLog_info['old_data']));
            $aLog['sub_module_primary_id'] = $update_id;

            $aNotif = [];
            $aNotif['receiver'] = $aParam['user_id'];
            $aNotif['method'] = "view_victim_services";
            $aNotif['notif_type'] = "1";
            $aNotif['tbl_id'] = $aParam['case_id'];
            $aNotif['msg'] = "You have been " . strtolower($sStatus) . " to ";
            $aNotif['msg'] .= "case report <orange><a href='update_case/" . $this->yel->encrypt_param($aParam['case_id']) . "'>" . $aParam['case_number'] . "</a></orange>";
            $this->notif->create($aNotif);

            $aEmail = [];
            $aEmail['to'] = $aParam['email'];
            $aEmail['subject'] = 'Report  ' . $sStatus . ' ';
            $aEmail['message'] = 'Hi ' . $aParam['fname'] . ',  <br><br> You have been ' . strtolower($sStatus) . ' to report number (' . $aParam['case_number'] . ')  <br>';
            $aEmail['message'] .= '<br>To view details of the case, login to ICMS using your account and search using the report number.<br>';
            $aResponse['mail'] = $this->mailbox->sendMail($aEmail);
        } else {
            $aResult['res'] = $this->Assignee_model->addCaseTagged($aParam);
            $aLog_info['log_action'] = 1;
            $aLog['sub_module_primary_id'] = $aResult['res']['insert_id'];

            $aNotif = [];
            $aNotif['receiver'] = $aParam['user_id'];
            $aNotif['method'] = "view_victim_services";
            $aNotif['notif_type'] = "1";
            $aNotif['tbl_id'] = $aParam['case_id'];
            $aNotif['msg'] = "You have been " . strtolower($sStatus) . "  to ";
            $aNotif['msg'] .= "case report <orange><a href='update_case/" . $this->yel->encrypt_param($aParam['case_id']) . "'>" . $aParam['case_number'] . "</a></orange>";
            $this->notif->create($aNotif);

            $aEmail = [];
            $aEmail['to'] = $aParam['email'];
            $aEmail['subject'] = 'Report  ' . $sStatus . ' ';
            $aEmail['message'] = 'Hi ' . $aParam['fname'] . ',  <br><br> You have been ' . strtolower($sStatus) . ' to report number (' . $aParam['case_number'] . ')  <br>';
            $aEmail['message'] .= '<br>To view details of the case, login to ICMS using your account and search using the report number.<br>';
            $aResponse['mail'] = $this->mailbox->sendMail($aEmail);
        }

        $aNotif = [];
        $aNotif['receiver'] = $_SESSION['userData']['user_id'];
        $aNotif['method'] = "view_victim_services";
        $aNotif['notif_type'] = "1";
        $aNotif['tbl_id'] = $aParam['case_id'];
        $aNotif['msg'] = "You have successfully " . $sAssign . " user for the ";
        $aNotif['msg'] .= "case report <orange><a href='update_case/" . $this->yel->encrypt_param($aParam['case_id']) . "'>" . $aParam['case_number'] . "</a></orange>";
        $this->notif->create($aNotif);


        // For Add
        $aLog['module_primary_id'] = $aParam['case_id'];

        $aLog_info['log_event_type'] = 19;
        $aParam['tag'] = '';
        $aLog_info['log_message'] = " " . strtolower($sStatus) . " " . $aParam['user_info']['user_firstname'] . ' ' . $aParam['user_info']['user_lastname'] . " to case report " . $aParam['case_number'];

        //saving logs for user details
        $result = "0";
        if ($aResult['res']['stat'] == "1") {
            $result = "1";
            $aLog_info['log_link'] = 'update_case/' . $this->yel->encrypt_param($aParam['case_id']);
            $aResult['log'] = $this->audit->create($aLog_info);
        }

        $aResponse = $aResult;
        return $aResponse;
    }

    public function getUserListByAgencyId($aParam) {
        $aResponse = [];
        $aResult['flag'] = self::FAILED_RESPONSE;

        if (isset($aParam['agency_branch_id']) != true) {
            $aParam['agency_branch_id'] = $_SESSION['userData']['agency_branch_id'];
        }
        $aParam['case_id'] = $this->yel->decrypt_param($aParam['case_id']);
        $aResult['list'] = $this->Assignee_model->getAndCheckUserListByCaseAndAgencyId($aParam);

        if (sizeof($aResult['list']) > 0) {
            foreach ($aResult['list'] as $key => $val) {
                $aResult['list'][$key]['user_id'] = $this->yel->encrypt_param($val['user_id']);
            }
            $aResult['flag'] = self::SUCCESS_RESPONSE;
        }


        $aResponse = $aResult;
        return $aResponse;
    }

}
