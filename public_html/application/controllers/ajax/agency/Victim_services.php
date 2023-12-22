<?php

/**
 * Agencies Internal Ajax
 * 
 * @module Ajax Loader
 * @author LBS eBusiness Solutions Corp. 
 * @since 2017
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Victim_services extends CI_Controller {

    const SUCCESS_RESPONSE = 1;
    const FAILED_RESPONSE = 0;

    public function __construct() {
        parent::__construct();

        // load models
        $this->load->model('agency/Victim_services_model');
        $this->load->model('agency/Users_model');
        $this->load->model('Global_data_model');
        $this->load->model('agency/Case_model');
        $this->load->model('administrator/Case_details_model');
    }

    /**
     * Ajax Route :: Action Controller
     */
    public function ajax() {

        // route ajax api
        $this->base_action_ajax();
    }

    public function sessionDestruct() {
        // session destroy
        $this->sessionPushLogout('admininistrator');
    }

    public function getVictimServices($aParam) {
        $aResponse = [];
        $aResult = [];
        $aParam['case_id'] = $this->yel->decrypt_param($aParam['case_id']);
        $aParam['case_victim_id'] = $this->yel->decrypt_param($aParam['case_victim_id']);
        $aParam['victim_id'] = $this->yel->decrypt_param($aParam['victim_id']);
        $aParam['agency_branch_id'] = $_SESSION['userData']['agency_branch_id'];
        $aResponse['service_details'] = $this->Victim_services_model->getVictimServices($aParam);
        $aResponse['agency_service_id_list'] = $this->Victim_services_model->getServicesIdByBranchId($aParam);

        $x = 0;
        foreach ($aResponse['agency_service_id_list'] as $key => $val) {
            $aResult['service_id'][$x] = $val['services_id'];
            $x++;
        }


        foreach ($aResponse['service_details'] as $key => $val) {
            
            $aResponse['service_details'][$key]['is_removable'] = 0; 
            
            if($_SESSION['userData']['user_id'] == $val['case_victim_services_agency_tag_added_by']){
                $aResponse['service_details'][$key]['is_removable'] = 1; 
            }

            if($_SESSION['userData']['user_level_id'] == '1'){
                $aResponse['service_details'][$key]['is_removable'] = 1; 
            }

            $aResponse['service_details'][$key]['tagged_by'] = $this->Victim_services_model->getTaggedAgencyBranchByUsingUserID($val['case_victim_services_agency_tag_added_by']);
            $aResponse['service_details'][$key]['tagged_to'] = $this->Victim_services_model->getTaggedToAgencyBranchByUsingBranchID($val['agency_branch_id']);
            $aResponse['service_details'][$key]['tagged_by']['agency_branch_id'] = $this->yel->encrypt_param($aResponse['service_details'][$key]['tagged_by']['agency_branch_id']);
            $aResponse['service_details'][$key]['tagged_to']['agency_branch_id'] = $this->yel->encrypt_param($aResponse['service_details'][$key]['tagged_to']['agency_branch_id']);

            // this is getting ready for encryption
            $lnk = [];
            $lnk['case_victim_services_id'] = $aResponse['service_details'][$key]['case_victim_services_id'];
            $lnk['service_duration'] = $aResponse['service_details'][$key]['service_duration'];
            $lnk['service_name'] = $aResponse['service_details'][$key]['service_name'];
            $lnk['services_id'] = $aResponse['service_details'][$key]['services_id'];
            $lnk['agency_branch_name'] = $aResponse['service_details'][$key]['tagged_by']['agency_branch_name'];
            $lnk['agency_name'] = $aResponse['service_details'][$key]['tagged_by']['agency_name'];
            $lnk['agency_abbr'] = $aResponse['service_details'][$key]['tagged_by']['agency_abbr'];
            $lnk['case_id'] = $aParam['case_id'];
            $lnk['case_victim_id'] = $aParam['case_victim_id'];
            $lnk['victim_id'] = $aParam['victim_id'];


            if (in_array($val['services_id'], $aResult['service_id'])) {
                $aResponse['service_details'][$key]['is_offered'] = self::SUCCESS_RESPONSE;
            } else {
                $aResponse['service_details'][$key]['is_offered'] = self::FAILED_RESPONSE;
            }

            $aResponse['service_details'][$key]['lnk'] = $this->yel->encrypt_param(json_encode($lnk));
            $aResponse['service_details'][$key]['case_victim_services_id'] = $this->yel->encrypt_param($val['case_victim_services_id']);
            unset($aResponse['service_details'][$key]['case_victim_services_agency_tag_added_by']);
            unset($aResponse['service_details'][$key]['agency_branch_id']);
        }
        if (empty($aResponse['service_details']) == true) {
            $aResponse['result'] = 0;
        } else {
            $aResponse['result'] = 1;
        }

        // user_branch_id
        $aResponse['user_branch_id'] = $this->yel->encrypt_param($this->session->userdata('userData')['agency_branch_id']);

        return $aResponse;
    }

    public function saveNewServiceUpdate($aParam) {

        $aParam['case_id'] = $this->yel->decrypt_param($aParam['case_id']);
        $aParam['caseid'] = $this->yel->decrypt_param($aParam['case_id']);
        $aParam['cvsid'] = $this->yel->decrypt_param($aParam['cvsid']);

        $case_number = $this->Case_details_model->getCaseNumberByCaseId($aParam);

        $aEmail = [];

        //save history
        $history = $this->Victim_services_model->saveNewServiceHistory($aParam);
        
        // update date 
        $this->Victim_services_model->setServiceTagDate($aParam);
        
        if (isset($aParam['date_remind']) && empty($aParam['date_remind']) == false) {
            $aParam['date_remind'] = str_replace("/", "-", $aParam['date_remind']);
            $reminder = $this->Victim_services_model->addServiceReminderHistory($aParam);
        }

        // add user log
        $aLog = [];
        $aLog['log_action'] = 1; // 1= new inserted // 2=update table
        $aLog['log_event_type'] = 81; // base on table : icms_user_event_type
        $aLog['log_message'] = " made an update for the tagged services  <a href='view_victim_services/" . $aParam['dataloglnk'] . "'>" . $aParam['service_title'] . "</a>";
        $aLog['module_primary_id'] = $aParam['case_id'];
        $aLog['sub_module_primary_id'] = $history['insert_id'];
        $aResponse['log'] = $this->audit->create($aLog);
        $adminDetails = $this->Users_model->getSuperAdminUserId();

        //add admin notification log
        // send notif to iacat and branch admin
        $aNotif = [];
        $aNotif['receiver'] = $_SESSION['userData']['user_id'];
        $aNotif['tbl_id'] = $history['insert_id'];
        $aNotif['method'] = "legal_services_logs";
        $aNotif['notif_type'] = 2;
        $aNotif['msg'] = "You made an update for ";
        $aNotif['msg'] .= "the service <a href='view_victim_services/" . $aParam['dataloglnk'] . "'>" . $aParam['service_title'] . "</a>";
        $this->notif->create($aNotif);

        // send notif to branch admin
        if ($_SESSION['userData']['user_level_id'] !== "1") {
            $aParam['agency_branch_id'] = $_SESSION['userData']['agency_branch_id'];
            $branchAdmin = $this->Users_model->getAdminUsersByAgencyBranchId($aParam);
            $aNotif = [];
            $aNotif['receiver'] = $branchAdmin['user_id'];
            $aNotif['tbl_id'] = $history['insert_id'];
            $aNotif['method'] = "legal_services_logs";
            $aNotif['notif_type'] = 2;
            $aNotif['msg'] = $_SESSION['userData']['user_firstname'] . " " . $_SESSION['userData']['user_lastname'] . " made an update for ";
            $aNotif['msg'] .= "the service <a href='view_victim_services/" . $aParam['dataloglnk'] . "'>" . $aParam['service_title'] . "</a>";
            $this->notif->create($aNotif);
        }

        //notification for changing status
        if ($aParam['stat_change'] != $aParam['service_stats']) {
            
            // notif victim 
               $this->notif->sendNotificationToVictim([
                "notif_type" => "service-status",
                "id_type" => "case_id",
                "id" => $aParam['case_id']
            ]);

            $aLog['old_data'] = array('Service Status' => $this->Global_data_model->getServiceStatusNameById($aParam['stat_change']));
            $this->Victim_services_model->setServicestatus($aParam);
            $aLog['new_data'] = array('Service Status' => $this->Global_data_model->getServiceStatusNameById($aParam['service_stats']));
            $aLog['log_event_type'] = 128;
            $aLog['log_message'] = " made an update for the tagged services status <a href='view_victim_services/" . $aParam['dataloglnk'] . "'>" . $aParam['service_title'] . "</a>";
            $aLog['log_action'] = 2; // 1= new insert table 2=update table
            $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
            $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
            $aLog['module_primary_id'] = $aParam['tagged_id'];
            $this->audit->create($aLog);

            $aParam['agency_branch_id'] = $_SESSION['userData']['agency_branch_id'];
            $branchAdmin = $this->Users_model->getAdminUsersByAgencyBranchId($aParam);
            if ($_SESSION['userData']['user_level_id']) {
                $aNotif = [];
                $aNotif['receiver'] = $branchAdmin['user_id'];
                $aNotif['tbl_id'] = $aParam['tagged_id'];
                $aNotif['method'] = "legal_services_logs";
                $aNotif['notif_type'] = 2;
                $aNotif['msg'] = $_SESSION['userData']['user_firstname'] . " " . $_SESSION['userData']['user_lastname'] . " made a changes to status ";
                $aNotif['msg'] .= " of the report service  <a href='view_victim_services/" . $aParam['dataloglnk'] . "'>" . $aParam['service_title'] . "</a>";
                $this->notif->create($aNotif);
            }
            $aNotif = [];
            $aNotif['receiver'] = $_SESSION['userData']['user_id'];
            $aNotif['tbl_id'] = $aParam['tagged_id'];
            $aNotif['method'] = "legal_services_logs";
            $aNotif['notif_type'] = 2;
            $aNotif['msg'] = "You have successfully change ";
            $aNotif['msg'] .= "the status of the report service  <a href='view_victim_services/" . $aParam['dataloglnk'] . "'>" . $aParam['service_title'] . "</a>";
            $this->notif->create($aNotif);

            //email to admin
            $aEmail['to'] = $branchAdmin['user_email'];
            $aEmail['subject'] = 'Service Status Change';
            $aEmail['message'] = 'Hi ' . $branchAdmin['user_firstname'] . ',<br><br> ';
            $aEmail['message'] .= $aParam['service_title'] . ' service status for the report ' . $case_number . ')  has been changed.<br>';
            $aEmail['message'] .= '<br>To view details of the case, login to ICMS using your account and search using the case number.<br>';
            $aResponse['mail'] = $this->mailbox->sendMail($aEmail);
        }

        return $history;
    }

    public function deleteService($aParam)
    {
        $aParam['case_victim_services_id'] = $this->yel->decrypt_param($aParam['case_victim_services_id']);
        
        return $this->Victim_services_model->deleteService($aParam);
    
    }
}
