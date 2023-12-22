<?php

/**
 * Case Internal Ajax
 * 
 * @module Ajax Loader
 * @author LBS eBusiness Solutions Corp. 
 * @since 2017
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_details extends CI_Controller {

    const SUCCESS_RESPONSE = 1;
    const FAILED_RESPONSE = 0;

    public function __construct() {
        parent::__construct();

        // load models
        $this->load->model('agency/Case_model');
        $this->load->model('agency/Victims_model');
        $this->load->model('agency/Users_model');
        $this->load->model('agency/Case_details_model');
        $this->load->model('agency/Service_details_model');
        $this->load->model('administrator/Victim_services_model');
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
        $this->sessionPushLogout('agency');
    }

    public function getServiceDetails($aParam) {
        $aResponse = [];
        $aParam = $this->yel->safe_mode_clean_array($aParam);
        $aResponse['result'] = 0;
        $aParam['caseid'] = $this->yel->decrypt_param($aParam['caseid']);
        $services = $this->Service_details_model->getServiceDetails($aParam);
        if (empty($services) == false) {
            $aResponse['result'] = 1;
            foreach ($services as $key => $val) {
                $services[$key]['agency_branch_id'] = $this->yel->encrypt_param($val['agency_branch_id']);
                $services[$key]['case_victim_id'] = $this->yel->encrypt_param($val['case_victim_id']);
                $services[$key]['case_victim_services_id'] = $this->yel->encrypt_param($val['case_victim_services_id']);
                $services[$key]['services_id'] = $this->yel->encrypt_param($val['services_id']);
            }
        }

        $aResponse['services'] = $services;
        $aResponse['service_status'] = $this->Service_details_model->getServiceStatus($aParam);
        return $aResponse;
    }

    public function setServiceDetailStatus($aParam) {
        $aResponse = [];
        $aParam['case_id'] = $this->yel->decrypt_param($aParam['case_id']);
        $aParam['caseid'] = $aParam['case_id'];
        $case_number = $this->Case_details_model->getCaseNumberByCaseId($aParam);

        $aLog = [];
        $aLog['old_data'] = $this->Service_details_model->setServiceDetailByTaggedID($aParam);
        $aResponse = $this->Service_details_model->setServiceDetailStatus($aParam);
        $aLog['new_data'] = $this->Service_details_model->setServiceDetailByTaggedID($aParam);
        $aLog['log_event_type'] = 77;
        $aLog['log_message'] = "update service for the case report  <a href='update_case/" . $this->yel->encrypt_param($aParam['case_id']) . "'>" . $case_number . "</a>";
        $aLog['log_action'] = 2; // 1= new inserted // 2=update table
        $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
        $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
        $aLog['module_primary_id'] = $aParam['case_id'];
        $aLog['sub_module_primary_id'] = $aParam['servicetaggedid'];

        $aResponse['log'] = $this->audit->create($aLog);

        return $aResponse;
    }

    /*
     * For Criminal Case List 
     * 
     */

    public function getLisLegalServices($aParam) {
        $aResponse = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;
        $aParam = $this->yel->pagination($aParam);

        // get all legal services
        $services = $this->Service_details_model->getLisLegalServices($aParam);

        if (empty($services['listing']) == false) {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            foreach ($services['listing'] as $key => $val) {
                $services['listing'][$key]['case_victim_id'] = $this->yel->encrypt_param($val['case_victim_id']);
                $services['listing'][$key]['case_victim_services_id'] = $this->yel->encrypt_param($val['case_victim_services_id']);
                $services['listing'][$key]['services_id'] = $this->yel->encrypt_param($val['services_id']);
                $services['listing'][$key]['vict_info_id'] = $this->yel->encrypt_param($val['vict_info_id']);
                $services['listing'][$key]['victim_id'] = $this->yel->encrypt_param($val['victim_id']);
                $services['listing'][$key]['case_added_by'] = $this->yel->encrypt_param($val['case_added_by']);
            }
        }
        $aResponse['services'] = $services;
        return $aResponse;
    }

    /*
     * For Service  Legal
     */

    public function getArchivedLegalList($aParam) {
        $aResponse = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;

        $aParam = $this->yel->clean_array($aParam);
        $aParam = $this->yel->pagination($aParam);
        $aParam['c_keyword'] = '';
        if (isset($aParam['keyword']) == true && empty($aParam['keyword']) == false) {
            // for report id  and slip
            $aParam['c_keyword'] = " AND (MATCH (`c`.`case_number`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE) ) ";
        }

        $aResponse['list'] = $this->Service_details_model->getArchivedLegalList($aParam);

        if (isset($aResponse['list']['listing']) == true && empty($aResponse['list']['listing']) == false) {
            foreach ($aResponse['list']['listing'] as $key => $val) {
             $aResponse['list']['listing'][$key]['case_id'] = $this->yel->encrypt_param($val['case_id']);
                $aResponse['list']['listing'][$key]['victim_id'] = $this->yel->encrypt_param($val['victim_id']);
                $aResponse['list']['listing'][$key]['case_victim_services_id'] = $this->yel->encrypt_param($val['case_victim_services_id']);
                $aResponse['list']['listing'][$key]['case_victim_services_agency_tag_added_date'] = $this->cnvrtSqlDateFrmtToLongFrmt($val['case_victim_services_agency_tag_added_date']);
                $aResponse['list']['listing'][$key]['case_victim_services_agency_tag_date_modified'] = $this->cnvrtSqlDateFrmtToLongFrmt($val['case_victim_services_agency_tag_date_modified']);
                $aResponse['list']['listing'][$key]['tagged_by'] = $this->Victim_services_model->getTaggedAgencyBranchByUsingUserID($val['case_victim_services_agency_tag_added_by']);
                $aResponse['list']['listing'][$key]['tagged_to'] = $this->Victim_services_model->getTaggedToAgencyBranchByUsingBranchID($val['agency_branch_id']);
                $aResponse['list']['listing'][$key]['tagged_by']['agency_branch_id'] = $this->yel->encrypt_param($aResponse['list']['listing'][$key]['tagged_by']['agency_branch_id']);
                $aResponse['list']['listing'][$key]['tagged_to']['agency_branch_id'] = $this->yel->encrypt_param($aResponse['list']['listing'][$key]['tagged_to']['agency_branch_id']);
            }
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
        }

        return $aResponse;
    }

    public function reOpenLegalService($aParam) {

        $aResponse = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;
        $aParam['enc_case_id'] = $aParam['case_id'];
        $aParam['case_id'] = $this->yel->decrypt_param($aParam['case_id']);
        $aParam['cvsid'] = $this->yel->decrypt_param($aParam['cvsid']);
        $aParam['caseid'] = $aParam['case_id'];
        $aParam['document_hash'] = '';

        $case_number = $this->Case_details_model->getCaseNumberByCaseId($aParam);

        $aResponse['stat'] = $this->Service_details_model->reOpenLegalService($aParam);
        $aResponse['history'] = $this->Victim_services_model->saveNewServiceHistory($aParam);

        if ($aResponse['stat']['stat'] == '1') {
            $branchAdmin = $this->Users_model->getAdminUsersByAgencyBranchId($aParam);
            $aNotif = [];
            $aNotif['receiver'] = $branchAdmin['user_id'];
            $aNotif['tbl_id'] = $aParam['tagged_id'];
            $aNotif['method'] = "view_victim_services";
            $aNotif['notif_type'] = 2;
            $aNotif['msg'] = $_SESSION['userData']['user_firstname'] . " " . $_SESSION['userData']['user_lastname'] . " reopen ";
            $aNotif['msg'] .= "a  <a href='view_victim_services/" . $aParam['enc_case_id'] . "/" . $aParam['vicitm_id'] . "'>" . $aParam['service_title'] . "</a> service of " . $aParam['victim_name'];
            $aResponse['notif'] = $this->notif->create($aNotif);
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
        }

        return $aResponse;
    }

    /*
     *  For Reintegration 
     */

    public function getArchivedReintegrationList($aParam) {
        $aResponse = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;

        $aParam = $this->yel->clean_array($aParam);
        $aParam = $this->yel->pagination($aParam);
        $aParam['c_keyword'] = '';
        if (isset($aParam['keyword']) == true && empty($aParam['keyword']) == false) {
            // for report id  and slip
            $aParam['c_keyword'] = " AND (MATCH (`c`.`case_number`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE) ) ";
        }

        $aResponse['list'] = $this->Service_details_model->getArchivedReintegrationList($aParam);

        if (isset($aResponse['list']['listing']) == true && empty($aResponse['list']['listing']) == false) {
            foreach ($aResponse['list']['listing'] as $key => $val) {
               $aResponse['list']['listing'][$key]['case_id'] = $this->yel->encrypt_param($val['case_id']);
                $aResponse['list']['listing'][$key]['victim_id'] = $this->yel->encrypt_param($val['victim_id']);
                $aResponse['list']['listing'][$key]['case_victim_services_id'] = $this->yel->encrypt_param($val['case_victim_services_id']);
                $aResponse['list']['listing'][$key]['case_victim_services_agency_tag_added_date'] = $this->cnvrtSqlDateFrmtToLongFrmt($val['case_victim_services_agency_tag_added_date']);
                $aResponse['list']['listing'][$key]['case_victim_services_agency_tag_date_modified'] = $this->cnvrtSqlDateFrmtToLongFrmt($val['case_victim_services_agency_tag_date_modified']);
                $aResponse['list']['listing'][$key]['tagged_by'] = $this->Victim_services_model->getTaggedAgencyBranchByUsingUserID($val['case_victim_services_agency_tag_added_by']);
                $aResponse['list']['listing'][$key]['tagged_to'] = $this->Victim_services_model->getTaggedToAgencyBranchByUsingBranchID($val['agency_branch_id']);
                $aResponse['list']['listing'][$key]['tagged_by']['agency_branch_id'] = $this->yel->encrypt_param($aResponse['list']['listing'][$key]['tagged_by']['agency_branch_id']);
                $aResponse['list']['listing'][$key]['tagged_to']['agency_branch_id'] = $this->yel->encrypt_param($aResponse['list']['listing'][$key]['tagged_to']['agency_branch_id']);
            }
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
        }

        return $aResponse;
    }

    public function reOpenReintegrationService($aParam) {

        $aResponse = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;
        $aParam['enc_case_id'] = $aParam['case_id'];
        $aParam['case_id'] = $this->yel->decrypt_param($aParam['case_id']);
        $aParam['cvsid'] = $this->yel->decrypt_param($aParam['cvsid']);
        $aParam['caseid'] = $aParam['case_id'];
        $aParam['document_hash'] = '';

        $case_number = $this->Case_details_model->getCaseNumberByCaseId($aParam);

        $aResponse['stat'] = $this->Service_details_model->reOpenReintegrationService($aParam);
        $aResponse['history'] = $this->Victim_services_model->saveNewServiceHistory($aParam);

        if ($aResponse['stat']['stat'] == '1') {
            $branchAdmin = $this->Users_model->getAdminUsersByAgencyBranchId($aParam);
            $aNotif = [];
            $aNotif['receiver'] = $branchAdmin['user_id'];
            $aNotif['tbl_id'] = $aParam['tagged_id'];
            $aNotif['method'] = "view_victim_services";
            $aNotif['notif_type'] = 2;
            $aNotif['msg'] = $_SESSION['userData']['user_firstname'] . " " . $_SESSION['userData']['user_lastname'] . " reopen ";
            $aNotif['msg'] .= "a  <a href='view_victim_services/" . $aParam['enc_case_id'] . "/" . $aParam['vicitm_id'] . "'>" . $aParam['service_title'] . "</a> service of " . $aParam['victim_name'];
            $aResponse['notif'] = $this->notif->create($aNotif);
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
        }

        return $aResponse;
    }

    private function cnvrtSqlDateFrmtToLongFrmt($sDate) {
        $newDate = '';
        if (isset($sDate) == true && empty($sDate) == false) {
            $d = strtotime($sDate);
            $newDate = date("F j, Y, g:i a", $d);
        }
        return $newDate;
    }

    public function getTrialLogs($aParam) {
        $aResponse = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;

        $aParam = $this->yel->clean_array($aParam);

        // get all trial logs
        $aResponse = $this->Servince_details_model->getTrialLogs($aParam);

        // list of tables to be affected for this request
        // 1. icms_case_victim_services
        // 2. icms_case_victim_services_agency_tag
        // 3. icms_agency_services_offered
        // 4. icms_victim_info
        // 5. icms_victim

        return $aResponse;
    }

}
