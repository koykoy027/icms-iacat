<?php

/**
 * Agencies Internal Ajax
 * 
 * @module Ajax Loader
 * @author LBS eBusiness Solutions Corp. 
 * @since 2017
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrative_case extends CI_Controller {

    const SUCCESS_RESPONSE = 1;
    const FAILED_RESPONSE = 0;

    public function __construct() {
        parent::__construct();

        // load models
        $this->load->model('agency/Administrative_case_model');
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

    public function getAdministrativeCaseList($aParam) {

        $aResponse = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;
        $aParam = $this->yel->clean_array($aParam);
        $aParam = $this->yel->pagination($aParam);

        $aParam['c_keyword'] = "";
        if (!empty($aParam['keyword']) == true) {
            // for report id  and slip
            $aParam['c_keyword'] = " AND ( (MATCH (`c`.`case_number`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)) OR ( `c`.`case_id` IN (SELECT `case_id` FROM `icms_legal_cc_slip` WHERE (MATCH (`legal_cc_slip_investigation_no`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)))) )";
        }

        // get all legal services
        $services = $this->Administrative_case_model->getAdministrativeCaseList($aParam);

        if (empty($services['listing']) == false) {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            foreach ($services['listing'] as $key => $val) {

                // get tagged agency
                $services['listing'][$key]['tagged_agency'] = $this->Administrative_case_model->getAdministrativeCaseListTaggedAgencyById($val['case_id']);

                // encrypt id's
                foreach ($services['listing'][$key]['tagged_agency'] as $akey => $aval) {
                    $services['listing'][$key]['tagged_agency'][$akey]['agnc_id'] = $this->yel->encrypt_param($aval['agnc_id']);
                }

                $services['listing'][$key]['case_victim_id'] = $this->yel->encrypt_param($val['case_victim_id']);
                $services['listing'][$key]['case_id'] = $this->yel->encrypt_param($val['case_id']);
                $services['listing'][$key]['services_id'] = $this->yel->encrypt_param($val['services_id']);
                $services['listing'][$key]['victim_id'] = $this->yel->encrypt_param($val['victim_id']);
                $services['listing'][$key]['case_added_by'] = $this->yel->encrypt_param($val['case_added_by']);
                $services['listing'][$key]['agnc_id'] = $this->yel->encrypt_param($val['agnc_id']);
            }
        }
        $aResponse['services'] = $services;
        return $aResponse;
    }

    public function getAdministrativeCaseListReportForBatch($aParam) {
        $aResponse = [];
        $aResult = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;
        $aParam = $this->yel->clean_array_walk_recursive($aParam);

        $aParam['condition'] = '';
        if (((!empty($aParam['case_id']) == true)) && ((is_array($aParam['case_id'])) == true)) {

            foreach ($aParam['case_id'] as $key => $val) {
                $a = $this->yel->decrypt_param($val);
                if (!empty($a) == true) {
                    $aParam['case_id'][$key] = $a;
                }
            }
            $aParam['case_id'] = (implode(", ", $aParam['case_id']));
            if ($aParam['case_id'] != ',') {
                $aParam['condition'] = ' AND `cv`.`case_id` NOT IN (' . $aParam['case_id'] . ')';
            }
        }

        $aResult['res'] = $this->Administrative_case_model->getAdministrativeCaseListReportForBatch($aParam);
        if (!empty($aResult['res']) == true) {
            $aResponse['res'] = $aResult['res'];

            foreach ($aResponse['res'] as $key => $val) {
                $aResponse['res'][$key]['case_victim_id'] = $this->yel->encrypt_param($val['case_victim_id']);
                $aResponse['res'][$key]['victim_id'] = $this->yel->encrypt_param($val['victim_id']);
                $aResponse['res'][$key]['case_id'] = $this->yel->encrypt_param($val['case_id']);
                $aResponse['res'][$key]['case_victim_services_id'] = $this->yel->encrypt_param($val['case_victim_services_id']);
                $aResponse['res'][$key]['services_id'] = $this->yel->encrypt_param($val['services_id']);
            }

            $aResponse['flag'] = self::SUCCESS_RESPONSE;
        }

        return $aResponse;
    }

    public function addBatchListForDocket($aParam) {
        $aResponse = [];
        $aResult = [];
        $aLog = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;
        $aParam = $this->yel->clean_array_walk_recursive($aParam);

        $aResult['add_batch'] = $this->Administrative_case_model->addBatchListForDocket($aParam);


        if (!empty($aResult['add_batch']['insert_id']) == true) {

            $aParam['legal_ac_docket_id'] = $aResult['add_batch']['insert_id'];
            $aParam['docket_number'] = $this->Administrative_case_model->getDocketNo($aParam);
            $aParam['encrypt_legal_ac_docket_id'] = $this->yel->encrypt_param($aParam['legal_ac_docket_id']);

            foreach ($aParam['case_id'] as $key => $val) {
                $aParam['case_id'][$key] = $this->yel->decrypt_param($val);
            }

            foreach ($aParam['case_id'] as $key => $val) {
                $aParam['victim_id'] = $this->Administrative_case_model->getVictimIdByCaseID($val);
                $aParam['legal_ac_case_id'] = $this->Administrative_case_model->getLegalACCaseIdByCaseID($val);
                $aParam['case_id'] = $val;
                $aResult['add_victim'][$key] = $this->Administrative_case_model->addLegalACDocketCasesVictim($aParam);
            }

            $aLog = [];
            $aLog['log_event_type'] = 170;
            $aLog['log_message'] = " created a new Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a> in Administrative Case.";
            $aLog['log_action'] = 1; // 1= new inserted // 2=update table
            $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
            $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
            $aResponse['log'] = $this->audit->create($aLog);

            $aResponse['flag'] = self::SUCCESS_RESPONSE;
        }

        return $aResponse;
    }

    public function addSetFilingReceiptComplaints($aParam) {
        $aResponse = [];
        $aResult = [];
        $aLog = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;
        $aParam = $this->yel->safe_mode_clean_array($aParam);

        $aParam['encrypt_case_id'] = $aParam['case_id'];
        $aParam['encrypt_victim_id'] = $aParam['victim_id'];

        $aParam['case_id'] = $this->yel->decrypt_param($aParam['case_id']);
        $aParam['victim_id'] = $this->yel->decrypt_param($aParam['victim_id']);

        $aResult['check'] = $this->Administrative_case_model->checkFillingRecieptComplaintsExist($aParam);

        $aParam['case_number'] = $this->Administrative_case_model->getCaseNo($aParam);
        $aParam['param'] = "";
        
        $aParam['legal_ac_stage_id'] = 1;
        $aParam['legal_ac_case_log_date_done'] = 'null';
        if ($aParam['legal_ac_case_log_status'] == '1') {
            $aParam['legal_ac_case_log_date_done'] = 'now()';
        }

        if ((int) $aResult['check'] > 0) {
            // update 
            // get old data 
            $aLogParam['stage'] = '1';
            $aLogParam['case_id'] = $aParam['encrypt_case_id'];
            $aLogParam['victim_id'] = $aParam['encrypt_victim_id'];
            $aLog['old_data_res'] = $this->loadCriminalCaseInfoByStages($aLogParam);
            if (array_key_exists('legal_ac_case_log_status', $aLog['old_data_res']['res'])) {
                $aLog['old_data_res']['res']['legal_ac_case_log_status'] = $this->changeStatusToString($aLog['old_data_res']['res']['legal_ac_case_log_status']);
            }
            $aLog['old_data'] = $aLog['old_data_res']['res'];
            unset($aLog['old_data_res']);

            // updates
            $aResponse['res'] = $this->Administrative_case_model->setFilingReceiptComplaints($aParam);
            $aResponse['res'] = $this->Administrative_case_model->setACCaseLogs($aParam);
            // get new data 
            $aLog['new_data_res'] = $this->loadCriminalCaseInfoByStages($aLogParam);

            if (array_key_exists('legal_ac_case_log_status', $aLog['new_data_res']['res'])) {
                $aLog['new_data_res']['res']['legal_ac_case_log_status'] = $this->changeStatusToString($aLog['new_data_res']['res']['legal_ac_case_log_status']);
            }

            $aLog['new_data'] = $aLog['new_data_res']['res'];
            unset($aLog['new_data_res']);

            /*             *  log              */
            $aLog['log_event_type'] = 130;
            $aLog['log_message'] = " made an update for administrative case, filing and receipt of complaints in Report Id: <a href='update_case/" . $aParam['encrypt_case_id'] . "'>" . $aParam['case_number'] . "</a>";
            $aLog['log_action'] = 2; // 1= new insert table 2=update table

            $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
            $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
            $aLog['module_primary_id'] = $aParam['case_id'];
            $aLog['log_link'] = 'admin_case/';

            $aResponse['log'] = $this->audit->create($aLog);
        } else {
            // add ac_cases
            $aResponse['add_ac_cases'] = $this->Administrative_case_model->addFilingReceiptComplaints($aParam);
            // add ac_cases_logs
            $aParam['legal_ac_case_id'] = $aResponse['add_ac_cases']['insert_id'];
            $aResponse['res'] = $this->Administrative_case_model->addACCaseLogs($aParam);

            $aLog = [];
            $aLog['log_event_type'] = 129;
            $aLog['log_message'] = " added record for administrative case, filing and receipt of complaints in Report Id: <a href='update_case/" . $aParam['encrypt_case_id'] . "'>" . $aParam['case_number'] . "</a>";
            $aLog['log_action'] = 1; // 1= new inserted // 2=update table
            $aLog['module_primary_id'] = $aParam['case_id'];
            $aLog['log_link'] = 'admin_case/';
            $aResponse['log'] = $this->audit->create($aLog);
        }

        if ($aResponse['res']['stat'] == '1') {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
        }

        return $aResponse;
    }

    /*
     * For Slip
     */

    public function setDateRemarksPerStageId($aParam) {

        $aResponse = [];
        $aResult = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;

        // clean array 
        $aParam = $this->yel->clean_array_walk_recursive($aParam);
        $aParam['encrypt_case_id'] = $aParam['case_id'];
        $aParam['encrypt_victim_id'] = $aParam['victim_id'];

        $aParam['case_id'] = $this->yel->decrypt_param($aParam['case_id']);
        $aParam['victim_id'] = $this->yel->decrypt_param($aParam['victim_id']);
        $aParam['legal_ac_case_no'] = $this->Administrative_case_model->getACCaseNo($aParam);
        $aParam['legal_ac_case_id'] = $this->Administrative_case_model->getACCaseId($aParam);
        $aParam['case_number'] = $this->Administrative_case_model->getCaseNo($aParam);

        $aParam['legal_ac_case_log_date_done'] = 'null';
        if ($aParam['legal_ac_case_log_status'] == '1') {
            $aParam['legal_ac_case_log_date_done'] = 'now()';
        }

        // get old data 
        $aLogParam['case_id'] = $aParam['encrypt_case_id'];
        $aLogParam['victim_id'] = $aParam['encrypt_victim_id'];

        switch ($aParam['stage']) {
            case '2':
                $aParam['legal_ac_stage_id'] = '2';
                $aResult = $this->checkSetAddACMPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 131;
                    $aLog['log_message'] = " added record for administrative case, on-site complaints for violation of POEA rules in Report Id: <a href='update_case/" . $aParam['encrypt_case_id'] . "'>" . $aParam['case_number'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['case_id'];
                    $aLog['log_link'] = 'admin_case/';
                    $aResponse['log'] = $this->audit->create($aLog);
                }
                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {

                    $aLog = [];
                    // get old value
                    $aLog['old_data'] = $aResult['old_data'];
                    $aLog['old_data']['legal_ac_case_log_date'] = str_replace("/", "-", $aLog['old_data']['legal_ac_case_log_date']);

                    // get new value
                    $aLogParam['stage'] = $aParam['legal_ac_stage_id'];
                    $aLog['new_data_res'] = $this->loadCriminalCaseInfoByStages($aLogParam);
                    if (array_key_exists('legal_ac_case_log_status', $aLog['new_data_res']['res'])) {
                        $aLog['new_data_res']['res']['legal_ac_case_log_status'] = $this->changeStatusToString($aLog['new_data_res']['res']['legal_ac_case_log_status']);
                    }
                    $aLog['new_data_res']['res']['legal_ac_case_log_date'] = str_replace("/", "-", $aLog['new_data_res']['res']['legal_ac_case_log_date']);
                    $aLog['new_data'] = $aLog['new_data_res']['res'];
                    unset($aLog['new_data_res']);

                    // prepare log aParam
                    $aLog['log_event_type'] = 132;
                    $aLog['log_message'] = " made an update for administrative case, on-site complaints for violation of POEA rules in Report Id: <a href='update_case/" . $aParam['encrypt_case_id'] . "'>" . $aParam['case_number'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['case_id'];
                    $aLog['log_link'] = 'admin_case/';
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                break;
            case '3':
                $aParam['legal_ac_stage_id'] = '3';
                $aResult = $this->checkSetAddACMPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 133;
                    $aLog['log_message'] = " added record for administrative case, issuance and implementation of closure order in Report Id: <a href='update_case/" . $aParam['encrypt_case_id'] . "'>" . $aParam['case_number'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['case_id'];
                    $aLog['log_link'] = 'admin_case/';
                    $aResponse['log'] = $this->audit->create($aLog);
                }
                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {

                    $aLog = [];
                    // get old value
                    $aLog['old_data'] = $aResult['old_data'];
                    $aLog['old_data']['legal_ac_case_log_date'] = str_replace("/", "-", $aLog['old_data']['legal_ac_case_log_date']);

                    // get new value
                    $aLogParam['stage'] = $aParam['legal_ac_stage_id'];
                    $aLog['new_data_res'] = $this->loadCriminalCaseInfoByStages($aLogParam);
                    if (array_key_exists('legal_ac_case_log_status', $aLog['new_data_res']['res'])) {
                        $aLog['new_data_res']['res']['legal_ac_case_log_status'] = $this->changeStatusToString($aLog['new_data_res']['res']['legal_ac_case_log_status']);
                    }
                    $aLog['new_data_res']['res']['legal_ac_case_log_date'] = str_replace("/", "-", $aLog['new_data_res']['res']['legal_ac_case_log_date']);
                    $aLog['new_data'] = $aLog['new_data_res']['res'];
                    unset($aLog['new_data_res']);

                    // prepare log aParam
                    $aLog['log_event_type'] = 134;
                    $aLog['log_message'] = " made an update for administrative case, issuance and implementation of closure order in Report Id: <a href='update_case/" . $aParam['encrypt_case_id'] . "'>" . $aParam['case_number'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['case_id'];
                    $aLog['log_link'] = 'admin_case/';
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                break;
            case '4':
                $aParam['legal_ac_stage_id'] = '4';
                $aResult = $this->checkSetAddACMPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 135;
                    $aLog['log_message'] = " added record for administrative case, mandatory conciliation of complaints in Report Id: <a href='update_case/" . $aParam['encrypt_case_id'] . "'>" . $aParam['case_number'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['case_id'];
                    $aLog['log_link'] = 'admin_case/';
                    $aResponse['log'] = $this->audit->create($aLog);
                }
                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {

                    $aLog = [];
                    // get old value
                    $aLog['old_data'] = $aResult['old_data'];
                    $aLog['old_data']['legal_ac_case_log_date'] = str_replace("/", "-", $aLog['old_data']['legal_ac_case_log_date']);

                    // get new value
                    $aLogParam['stage'] = $aParam['legal_ac_stage_id'];
                    $aLog['new_data_res'] = $this->loadCriminalCaseInfoByStages($aLogParam);
                    if (array_key_exists('legal_ac_case_log_status', $aLog['new_data_res']['res'])) {
                        $aLog['new_data_res']['res']['legal_ac_case_log_status'] = $this->changeStatusToString($aLog['new_data_res']['res']['legal_ac_case_log_status']);
                    }
                    $aLog['new_data_res']['res']['legal_ac_case_log_date'] = str_replace("/", "-", $aLog['new_data_res']['res']['legal_ac_case_log_date']);
                    $aLog['new_data'] = $aLog['new_data_res']['res'];
                    unset($aLog['new_data_res']);

                    // prepare log aParam
                    $aLog['log_event_type'] = 136;
                    $aLog['log_message'] = " made an update for administrative case, mandatory conciliation of complaints in Report Id: <a href='update_case/" . $aParam['encrypt_case_id'] . "'>" . $aParam['case_number'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['case_id'];
                    $aLog['log_link'] = 'admin_case/';
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                if ($aParam['legal_ac_case_log_status'] == '1') {
                    $aNotif = [];
                    $aNotif['method'] = "admin_case";
                    $aNotif['tbl_id'] = $aParam['case_id'];
                    $aNotif['receiver'] = 1;
                    $aNotif['notif_type'] = "2";
                    $aNotif['msg'] = "Administrative Case Management for Report Id: <orange> <a href='update_case/" . $aParam['encrypt_case_id'] . "'>" . $aParam['case_number'] . " </a> </orange> is done.";
                    $this->notif->create($aNotif);
                }

                break;
        }

        if (empty($aResult['res']) == false) {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            $aResponse['res'] = $aResult['res'];
        }

        return $aResult;
    }

    public function checkSetAddACMPerStage($aParam) {
        $aResult = [];
        $aParam['param'] = "";
        $aResult['check'] = $this->Administrative_case_model->checkIfStageExist($aParam);
        

        if ((int) $aResult['check'] > 0) {
            // update
            // get old data 
            $aLogParam['stage'] = $aParam['legal_ac_stage_id'];
            $aLogParam['case_id'] = $aParam['encrypt_case_id'];
            $aLogParam['victim_id'] = $aParam['encrypt_victim_id'];

            $aLog['old_data_res'] = $this->loadCriminalCaseInfoByStages($aLogParam);
            if (array_key_exists('legal_ac_case_log_status', $aLog['old_data_res']['res'])) {
                $aLog['old_data_res']['res']['legal_ac_case_log_status'] = $this->changeStatusToString($aLog['old_data_res']['res']['legal_ac_case_log_status']);
            }
            $aLog['old_data'] = $aLog['old_data_res']['res'];
            $aResult['old_data'] = $aLog['old_data'];

            $aResult['res'] = $this->Administrative_case_model->setACCaseLogs($aParam);
        } else {
            // insert 
            $aResult['res'] = $this->Administrative_case_model->addACCaseLogs($aParam);
        }

        return $aResult;
    }

    public function loadCriminalCaseInfoByStages($aParam) {
        $aResponse = [];
        $aResult = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;
        $aParam = $this->yel->clean_array($aParam);
        $aParam['case_id'] = $this->yel->decrypt_param($aParam['case_id']);
        $aParam['victim_id'] = $this->yel->decrypt_param($aParam['victim_id']);

        switch ($aParam['stage']) {
            case '1':
                $aParam['legal_ac_stage_id'] = 1;
                $aResult['res'] = $this->Administrative_case_model->getFillingReceiptOfComplaintPerId($aParam);
                $aCCDateRemarksPerStage = $this->Administrative_case_model->getCCDateRemarksPerStage($aParam);
                if (count($aCCDateRemarksPerStage) > 1) {
                    $aResult['res']['legal_ac_case_log_status'] = $aCCDateRemarksPerStage['legal_ac_case_log_status'];
                    $aResult['res']['legal_ac_case_log_date'] = $aCCDateRemarksPerStage['legal_ac_case_log_date'];
                    $aResult['res']['legal_ac_case_log_remarks'] = $aCCDateRemarksPerStage['legal_ac_case_log_remarks'];
                }
                break;
            case '2':
                $aParam['legal_ac_stage_id'] = 2;
                $aResult['res'] = $this->Administrative_case_model->getCCDateRemarksPerStage($aParam);
                break;
            case '3':
                $aParam['legal_ac_stage_id'] = 3;
                $aResult['res'] = $this->Administrative_case_model->getACDetailsPerStage($aParam);
                break;
            case '4':
                $aParam['legal_ac_stage_id'] = 4;
                $aResult['res'] = $this->Administrative_case_model->getCCDateRemarksPerStage($aParam);
                break;
        }

        if (empty($aResult['res']) == false) {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            $aResponse['res'] = $aResult['res'];
        }

        return $aResponse;
    }

    public function getAdministrativeCaseBatchList($aParam) {

        $aResponse = [];
        $aResult = [];

        $aResponse['flag'] = self::FAILED_RESPONSE;

        $aParam = $this->yel->pagination($aParam);

        $aParam['c_keyword'] = "";
        if (!empty($aParam['keyword']) == true) {
            // for report id  and slip
            $aParam['c_keyword'] = " WHERE MATCH (`lacd`.`legal_ac_docket_number`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)";
        }

        // get all legal services 
        $aResult['res'] = $this->Administrative_case_model->getAdministrativeCaseBatchList($aParam);

        if (empty($aResult['res']) == false) {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            foreach ($aResult['res']['listing'] as $key => $val) {
                $aResult['res']['listing'][$key]['legal_ac_docket_id'] = $this->yel->encrypt_param($val['legal_ac_docket_id']);
                $aResult['res']['listing'][$key]['last_stage_id'] = $this->yel->encrypt_param($val['last_stage_id']);
            }
            $aResponse['res'] = $aResult['res'];
        }


        return $aResponse;
    }

    public function loadAdministrativeCaseInfoBatchByStages($aParam) {
        $aResponse = [];
        $aResult = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;
        $aParam = $this->yel->clean_array($aParam);
        $aParam['legal_ac_docket_id'] = $this->yel->decrypt_param($aParam['legal_ac_docket_id']);

        switch ($aParam['stage']) {
            case '1':
                $aParam['legal_ac_stage_id'] = '5';
                $aResult['res'] = $this->Administrative_case_model->getCCDateRemarksPerBatchStage($aParam);
                break;
            case '2_1':
                $aParam['legal_ac_stage_id'] = '6';
                $aResult['res'] = $this->Administrative_case_model->getCCDateRemarksPerBatchStage($aParam);
                break;
            case '2_2':
                $aParam['legal_ac_stage_id'] = '7';
                $aResult['res'] = $this->Administrative_case_model->getCCDateRemarksPerBatchStage($aParam);
                break;
            case '2_3':
                $aParam['legal_ac_stage_id'] = '8';
                $aResult['res'] = $this->Administrative_case_model->getCCDateRemarksPerBatchStage($aParam);
                break;
            case '2_4':
                $aParam['legal_ac_stage_id'] = '9';
                $aResult['res'] = $this->Administrative_case_model->getCCDateRemarksPerBatchStage($aParam);
                break;
            case '3':
                $aParam['legal_ac_stage_id'] = '10';
                $aResult['res'] = $this->Administrative_case_model->getCCDateRemarksPerBatchStage($aParam);
                break;
            case '4_1':
                $aParam['legal_ac_stage_id'] = '11';
                $aResult['res'] = $this->Administrative_case_model->getCCDateRemarksPerBatchStage($aParam);
                break;
            case '4_2':
                $aParam['legal_ac_stage_id'] = '12';
                $aResult['res'] = $this->Administrative_case_model->getCCDateRemarksPerBatchStage($aParam);
                break;
            case '4_3':
                $aParam['legal_ac_stage_id'] = '13';
                $aResult['res'] = $this->Administrative_case_model->getCCDateRemarksPerBatchStage($aParam);
                break;
            case '4_4':
                $aParam['legal_ac_stage_id'] = '14';
                $aResult['res'] = $this->Administrative_case_model->getCCDateRemarksPerBatchStage($aParam);
                break;
            case '5':
                $aParam['legal_ac_stage_id'] = '15';
                $aResult['res'] = $this->Administrative_case_model->getCCDateRemarksPerBatchStage($aParam);
                break;
            case '6':
                $aParam['legal_ac_stage_id'] = '16';
                $aResult['res'] = $this->Administrative_case_model->getCCDateRemarksPerBatchStage($aParam);
                break;
            case '7_1':
                $aParam['legal_ac_stage_id'] = '17';
                $aResult['res'] = $this->Administrative_case_model->getCCDateRemarksPerBatchStage($aParam);
                break;
            case '7_2':
                $aParam['legal_ac_stage_id'] = '18';
                $aResult['res'] = $this->Administrative_case_model->getCCDateRemarksPerBatchStage($aParam);
                break;
            case '7_3':
                $aParam['legal_ac_stage_id'] = '19';
                $aResult['res'] = $this->Administrative_case_model->getCCDateRemarksPerBatchStage($aParam);
                break;
            case '8':
                $aParam['legal_ac_stage_id'] = '20';
                $aResult['res'] = $this->Administrative_case_model->getCCDateRemarksPerBatchStage($aParam);
                break;
        }

        if (empty($aResult['res']) == false) {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            $aResponse['res'] = $aResult['res'];
        }

        return $aResponse;
    }

    /*
     * For Docket 
     */

    public function setDateRemarksPerDocketStageId($aParam) {
        $aResponse = [];
        $aResult = [];
        $aLog = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;

        // clean array 
        $aParam = $this->yel->clean_array_walk_recursive($aParam);

        $aParam['encrypt_legal_ac_docket_id'] = $aParam['legal_ac_docket_id'];
        $aParam['legal_ac_docket_id'] = $this->yel->decrypt_param($aParam['legal_ac_docket_id']);
        $aParam['docket_number'] = $this->Administrative_case_model->getDocketNo($aParam);

        $aParam['legal_ac_docket_log_date_done'] = 'null';
        if ($aParam['legal_ac_docket_log_status'] == '1') {
            $aParam['legal_ac_docket_log_date_done'] = 'now()';
        }

        switch ($aParam['stage']) {
            case '1':
                $aParam['legal_ac_stage_id'] = '5';
                $aResult = $this->checkSetAddACMBatchPerStage($aParam);


                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 137;
                    $aLog['log_message'] = " added record for administrative case, docketing and assignment of cases in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog['old_data'] = $aResult['old_data'];

                    // get new data 
                    $aLogParam['stage'] = $aParam['stage'];
                    $aLogParam['legal_ac_docket_id'] = $aParam['encrypt_legal_ac_docket_id'];

                    $aLog['new_data_res'] = $this->loadAdministrativeCaseInfoBatchByStages($aLogParam);
                    if (array_key_exists('legal_ac_docket_log_status', $aLog['new_data_res']['res'])) {
                        $aLog['new_data_res']['res']['legal_ac_docket_log_status'] = $this->changeStatusToString($aLog['new_data_res']['res']['legal_ac_docket_log_status']);
                    }
                    $aLog['new_data'] = $aLog['new_data_res']['res'];
                    $aLog['new_data']['legal_ac_docket_log_date'] = str_replace("/", "-", $aLog['new_data']['legal_ac_docket_log_date']);
                    unset($aLog['new_data_res']);

                    // prepare log aParam
                    $aLog['log_event_type'] = 138;
                    $aLog['log_message'] = " made an update for administrative case, docketing and assignment of cases in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                break;
            case '2_1':
                $aParam['legal_ac_stage_id'] = '6';
                $aResult = $this->checkSetAddACMBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 139;
                    $aLog['log_message'] = " added record for administrative case, show cause order/summons  in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog['old_data'] = $aResult['old_data'];

                    // get new data 
                    $aLogParam['stage'] = $aParam['stage'];
                    $aLogParam['legal_ac_docket_id'] = $aParam['encrypt_legal_ac_docket_id'];

                    $aLog['new_data_res'] = $this->loadAdministrativeCaseInfoBatchByStages($aLogParam);
                    if (array_key_exists('legal_ac_docket_log_status', $aLog['new_data_res']['res'])) {
                        $aLog['new_data_res']['res']['legal_ac_docket_log_status'] = $this->changeStatusToString($aLog['new_data_res']['res']['legal_ac_docket_log_status']);
                    }
                    $aLog['new_data'] = $aLog['new_data_res']['res'];
                    $aLog['new_data']['legal_ac_docket_log_date'] = str_replace("/", "-", $aLog['new_data']['legal_ac_docket_log_date']);
                    unset($aLog['new_data_res']);

                    // prepare log aParam
                    $aLog['log_event_type'] = 140;
                    $aLog['log_message'] = " made an update for administrative case, show cause order/summons in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                break;
            case '2_2':
                $aParam['legal_ac_stage_id'] = '7';
                $aResult = $this->checkSetAddACMBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 141;
                    $aLog['log_message'] = " added record for administrative case, filling of answer in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog['old_data'] = $aResult['old_data'];

                    // get new data 
                    $aLogParam['stage'] = $aParam['stage'];
                    $aLogParam['legal_ac_docket_id'] = $aParam['encrypt_legal_ac_docket_id'];

                    $aLog['new_data_res'] = $this->loadAdministrativeCaseInfoBatchByStages($aLogParam);
                    if (array_key_exists('legal_ac_docket_log_status', $aLog['new_data_res']['res'])) {
                        $aLog['new_data_res']['res']['legal_ac_docket_log_status'] = $this->changeStatusToString($aLog['new_data_res']['res']['legal_ac_docket_log_status']);
                    }
                    $aLog['new_data'] = $aLog['new_data_res']['res'];
                    $aLog['new_data']['legal_ac_docket_log_date'] = str_replace("/", "-", $aLog['new_data']['legal_ac_docket_log_date']);
                    unset($aLog['new_data_res']);

                    // prepare log aParam
                    $aLog['log_event_type'] = 142;
                    $aLog['log_message'] = " made an update for administrative case, filling of answer in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                break;
            case '2_3':
                $aParam['legal_ac_stage_id'] = '8';
                $aResult = $this->checkSetAddACMBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 143;
                    $aLog['log_message'] = " added record for administrative case, filling of reply in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog['old_data'] = $aResult['old_data'];

                    // get new data 
                    $aLogParam['stage'] = $aParam['stage'];
                    $aLogParam['legal_ac_docket_id'] = $aParam['encrypt_legal_ac_docket_id'];

                    $aLog['new_data_res'] = $this->loadAdministrativeCaseInfoBatchByStages($aLogParam);
                    if (array_key_exists('legal_ac_docket_log_status', $aLog['new_data_res']['res'])) {
                        $aLog['new_data_res']['res']['legal_ac_docket_log_status'] = $this->changeStatusToString($aLog['new_data_res']['res']['legal_ac_docket_log_status']);
                    }
                    $aLog['new_data'] = $aLog['new_data_res']['res'];
                    $aLog['new_data']['legal_ac_docket_log_date'] = str_replace("/", "-", $aLog['new_data']['legal_ac_docket_log_date']);
                    unset($aLog['new_data_res']);

                    // prepare log aParam
                    $aLog['log_event_type'] = 144;
                    $aLog['log_message'] = " made an update for administrative case, filling of reply in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                break;
            case '2_4':
                $aParam['legal_ac_stage_id'] = '9';
                $aResult = $this->checkSetAddACMBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 145;
                    $aLog['log_message'] = " added record for administrative case, motion of extension to file a verified answer in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog['old_data'] = $aResult['old_data'];

                    // get new data 
                    $aLogParam['stage'] = $aParam['stage'];
                    $aLogParam['legal_ac_docket_id'] = $aParam['encrypt_legal_ac_docket_id'];

                    $aLog['new_data_res'] = $this->loadAdministrativeCaseInfoBatchByStages($aLogParam);
                    if (array_key_exists('legal_ac_docket_log_status', $aLog['new_data_res']['res'])) {
                        $aLog['new_data_res']['res']['legal_ac_docket_log_status'] = $this->changeStatusToString($aLog['new_data_res']['res']['legal_ac_docket_log_status']);
                    }
                    $aLog['new_data'] = $aLog['new_data_res']['res'];
                    $aLog['new_data']['legal_ac_docket_log_date'] = str_replace("/", "-", $aLog['new_data']['legal_ac_docket_log_date']);
                    unset($aLog['new_data_res']);

                    // prepare log aParam
                    $aLog['log_event_type'] = 146;
                    $aLog['log_message'] = " made an update for administrative case, motion of extension to file a verified answer in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                break;
            case '3':
                $aParam['legal_ac_stage_id'] = '10';
                $aResult = $this->checkSetAddACMBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 147;
                    $aLog['log_message'] = " added record for administrative case, issuance of order of preventive suspension in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog['old_data'] = $aResult['old_data'];

                    // get new data 
                    $aLogParam['stage'] = $aParam['stage'];
                    $aLogParam['legal_ac_docket_id'] = $aParam['encrypt_legal_ac_docket_id'];

                    $aLog['new_data_res'] = $this->loadAdministrativeCaseInfoBatchByStages($aLogParam);
                    if (array_key_exists('legal_ac_docket_log_status', $aLog['new_data_res']['res'])) {
                        $aLog['new_data_res']['res']['legal_ac_docket_log_status'] = $this->changeStatusToString($aLog['new_data_res']['res']['legal_ac_docket_log_status']);
                    }
                    $aLog['new_data'] = $aLog['new_data_res']['res'];
                    $aLog['new_data']['legal_ac_docket_log_date'] = str_replace("/", "-", $aLog['new_data']['legal_ac_docket_log_date']);
                    unset($aLog['new_data_res']);

                    // prepare log aParam
                    $aLog['log_event_type'] = 148;
                    $aLog['log_message'] = " made an update for administrative case, issuance of order of preventive suspension in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }


                break;
            case '4_1':
                $aParam['legal_ac_stage_id'] = '11';
                $aResult = $this->checkSetAddACMBatchPerStage($aParam);


                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 149;
                    $aLog['log_message'] = " added record for administrative case, preliminary hearing in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog['old_data'] = $aResult['old_data'];

                    // get new data 
                    $aLogParam['stage'] = $aParam['stage'];
                    $aLogParam['legal_ac_docket_id'] = $aParam['encrypt_legal_ac_docket_id'];

                    $aLog['new_data_res'] = $this->loadAdministrativeCaseInfoBatchByStages($aLogParam);
                    if (array_key_exists('legal_ac_docket_log_status', $aLog['new_data_res']['res'])) {
                        $aLog['new_data_res']['res']['legal_ac_docket_log_status'] = $this->changeStatusToString($aLog['new_data_res']['res']['legal_ac_docket_log_status']);
                    }
                    $aLog['new_data'] = $aLog['new_data_res']['res'];
                    $aLog['new_data']['legal_ac_docket_log_date'] = str_replace("/", "-", $aLog['new_data']['legal_ac_docket_log_date']);
                    unset($aLog['new_data_res']);

                    // prepare log aParam
                    $aLog['log_event_type'] = 150;
                    $aLog['log_message'] = " made an update for administrative case, preliminary hearing in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                break;
            case '4_2':
                $aParam['legal_ac_stage_id'] = '12';
                $aResult = $this->checkSetAddACMBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 151;
                    $aLog['log_message'] = " added record for administrative case, hearing for clarificatory questions in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog['old_data'] = $aResult['old_data'];

                    // get new data 
                    $aLogParam['stage'] = $aParam['stage'];
                    $aLogParam['legal_ac_docket_id'] = $aParam['encrypt_legal_ac_docket_id'];

                    $aLog['new_data_res'] = $this->loadAdministrativeCaseInfoBatchByStages($aLogParam);
                    if (array_key_exists('legal_ac_docket_log_status', $aLog['new_data_res']['res'])) {
                        $aLog['new_data_res']['res']['legal_ac_docket_log_status'] = $this->changeStatusToString($aLog['new_data_res']['res']['legal_ac_docket_log_status']);
                    }
                    $aLog['new_data'] = $aLog['new_data_res']['res'];
                    $aLog['new_data']['legal_ac_docket_log_date'] = str_replace("/", "-", $aLog['new_data']['legal_ac_docket_log_date']);
                    unset($aLog['new_data_res']);

                    // prepare log aParam
                    $aLog['log_event_type'] = 152;
                    $aLog['log_message'] = " made an update for administrative case, hearing for clarificatory questions in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                break;
            case '4_3':
                $aParam['legal_ac_stage_id'] = '13';
                $aResult = $this->checkSetAddACMBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 153;
                    $aLog['log_message'] = " added record for administrative case, order to appear/to produce documents in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog['old_data'] = $aResult['old_data'];

                    // get new data 
                    $aLogParam['stage'] = $aParam['stage'];
                    $aLogParam['legal_ac_docket_id'] = $aParam['encrypt_legal_ac_docket_id'];

                    $aLog['new_data_res'] = $this->loadAdministrativeCaseInfoBatchByStages($aLogParam);
                    if (array_key_exists('legal_ac_docket_log_status', $aLog['new_data_res']['res'])) {
                        $aLog['new_data_res']['res']['legal_ac_docket_log_status'] = $this->changeStatusToString($aLog['new_data_res']['res']['legal_ac_docket_log_status']);
                    }
                    $aLog['new_data'] = $aLog['new_data_res']['res'];
                    $aLog['new_data']['legal_ac_docket_log_date'] = str_replace("/", "-", $aLog['new_data']['legal_ac_docket_log_date']);
                    unset($aLog['new_data_res']);

                    // prepare log aParam
                    $aLog['log_event_type'] = 156;
                    $aLog['log_message'] = " made an update for administrative case, order to appear/to produce documents in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }


                break;
            case '4_4':
                $aParam['legal_ac_stage_id'] = '14';
                $aResult = $this->checkSetAddACMBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 155;
                    $aLog['log_message'] = " added record for administrative case, summary judgment in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog['old_data'] = $aResult['old_data'];

                    // get new data 
                    $aLogParam['stage'] = $aParam['stage'];
                    $aLogParam['legal_ac_docket_id'] = $aParam['encrypt_legal_ac_docket_id'];

                    $aLog['new_data_res'] = $this->loadAdministrativeCaseInfoBatchByStages($aLogParam);
                    if (array_key_exists('legal_ac_docket_log_status', $aLog['new_data_res']['res'])) {
                        $aLog['new_data_res']['res']['legal_ac_docket_log_status'] = $this->changeStatusToString($aLog['new_data_res']['res']['legal_ac_docket_log_status']);
                    }
                    $aLog['new_data'] = $aLog['new_data_res']['res'];
                    $aLog['new_data']['legal_ac_docket_log_date'] = str_replace("/", "-", $aLog['new_data']['legal_ac_docket_log_date']);
                    unset($aLog['new_data_res']);

                    // prepare log aParam
                    $aLog['log_event_type'] = 156;
                    $aLog['log_message'] = " made an update for administrative case, summary judgment in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }


                break;
            case '5':
                $aParam['legal_ac_stage_id'] = '15';
                $aResult = $this->checkSetAddACMBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 157;
                    $aLog['log_message'] = " added record for administrative case, submission for resolution in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog['old_data'] = $aResult['old_data'];

                    // get new data 
                    $aLogParam['stage'] = $aParam['stage'];
                    $aLogParam['legal_ac_docket_id'] = $aParam['encrypt_legal_ac_docket_id'];

                    $aLog['new_data_res'] = $this->loadAdministrativeCaseInfoBatchByStages($aLogParam);
                    if (array_key_exists('legal_ac_docket_log_status', $aLog['new_data_res']['res'])) {
                        $aLog['new_data_res']['res']['legal_ac_docket_log_status'] = $this->changeStatusToString($aLog['new_data_res']['res']['legal_ac_docket_log_status']);
                    }
                    $aLog['new_data'] = $aLog['new_data_res']['res'];
                    $aLog['new_data']['legal_ac_docket_log_date'] = str_replace("/", "-", $aLog['new_data']['legal_ac_docket_log_date']);
                    unset($aLog['new_data_res']);

                    // prepare log aParam
                    $aLog['log_event_type'] = 158;
                    $aLog['log_message'] = " made an update for administrative case, submission for resolution in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }


                break;
            case '6':
                $aParam['legal_ac_stage_id'] = '16';
                $aResult = $this->checkSetAddACMBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 159;
                    $aLog['log_message'] = " added record for administrative case, resolution of the case in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog['old_data'] = $aResult['old_data'];

                    // get new data 
                    $aLogParam['stage'] = $aParam['stage'];
                    $aLogParam['legal_ac_docket_id'] = $aParam['encrypt_legal_ac_docket_id'];

                    $aLog['new_data_res'] = $this->loadAdministrativeCaseInfoBatchByStages($aLogParam);
                    if (array_key_exists('legal_ac_docket_log_status', $aLog['new_data_res']['res'])) {
                        $aLog['new_data_res']['res']['legal_ac_docket_log_status'] = $this->changeStatusToString($aLog['new_data_res']['res']['legal_ac_docket_log_status']);
                    }
                    $aLog['new_data'] = $aLog['new_data_res']['res'];
                    $aLog['new_data']['legal_ac_docket_log_date'] = str_replace("/", "-", $aLog['new_data']['legal_ac_docket_log_date']);
                    unset($aLog['new_data_res']);

                    // prepare log aParam
                    $aLog['log_event_type'] = 160;
                    $aLog['log_message'] = " made an update for administrative case, resolution of the case in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }


                break;
            case '7_1':
                $aParam['legal_ac_stage_id'] = '17';
                $aResult = $this->checkSetAddACMBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 161;
                    $aLog['log_message'] = " added record for administrative case, appeal to the DOLE secretary in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog['old_data'] = $aResult['old_data'];

                    // get new data 
                    $aLogParam['stage'] = $aParam['stage'];
                    $aLogParam['legal_ac_docket_id'] = $aParam['encrypt_legal_ac_docket_id'];

                    $aLog['new_data_res'] = $this->loadAdministrativeCaseInfoBatchByStages($aLogParam);
                    if (array_key_exists('legal_ac_docket_log_status', $aLog['new_data_res']['res'])) {
                        $aLog['new_data_res']['res']['legal_ac_docket_log_status'] = $this->changeStatusToString($aLog['new_data_res']['res']['legal_ac_docket_log_status']);
                    }
                    $aLog['new_data'] = $aLog['new_data_res']['res'];
                    $aLog['new_data']['legal_ac_docket_log_date'] = str_replace("/", "-", $aLog['new_data']['legal_ac_docket_log_date']);
                    unset($aLog['new_data_res']);

                    // prepare log aParam
                    $aLog['log_event_type'] = 162;
                    $aLog['log_message'] = " made an update for administrative case, appeal to the DOLE secretary in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }


                break;
            case '7_2':
                $aParam['legal_ac_stage_id'] = '18';
                $aResult = $this->checkSetAddACMBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 163;
                    $aLog['log_message'] = " added record for administrative case, entry of judgment in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }
                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog['old_data'] = $aResult['old_data'];

                    // get new data 
                    $aLogParam['stage'] = $aParam['stage'];
                    $aLogParam['legal_ac_docket_id'] = $aParam['encrypt_legal_ac_docket_id'];

                    $aLog['new_data_res'] = $this->loadAdministrativeCaseInfoBatchByStages($aLogParam);
                    if (array_key_exists('legal_ac_docket_log_status', $aLog['new_data_res']['res'])) {
                        $aLog['new_data_res']['res']['legal_ac_docket_log_status'] = $this->changeStatusToString($aLog['new_data_res']['res']['legal_ac_docket_log_status']);
                    }
                    $aLog['new_data'] = $aLog['new_data_res']['res'];
                    $aLog['new_data']['legal_ac_docket_log_date'] = str_replace("/", "-", $aLog['new_data']['legal_ac_docket_log_date']);
                    unset($aLog['new_data_res']);

                    // prepare log aParam
                    $aLog['log_event_type'] = 164;
                    $aLog['log_message'] = " made an update for administrative case, entry of judgment in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                break;
            case '7_3':
                $aParam['legal_ac_stage_id'] = '19';
                $aResult = $this->checkSetAddACMBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 165;
                    $aLog['log_message'] = " added record for administrative case, resolution of appeal in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog['old_data'] = $aResult['old_data'];

                    // get new data 
                    $aLogParam['stage'] = $aParam['stage'];
                    $aLogParam['legal_ac_docket_id'] = $aParam['encrypt_legal_ac_docket_id'];

                    $aLog['new_data_res'] = $this->loadAdministrativeCaseInfoBatchByStages($aLogParam);
                    if (array_key_exists('legal_ac_docket_log_status', $aLog['new_data_res']['res'])) {
                        $aLog['new_data_res']['res']['legal_ac_docket_log_status'] = $this->changeStatusToString($aLog['new_data_res']['res']['legal_ac_docket_log_status']);
                    }
                    $aLog['new_data'] = $aLog['new_data_res']['res'];
                    $aLog['new_data']['legal_ac_docket_log_date'] = str_replace("/", "-", $aLog['new_data']['legal_ac_docket_log_date']);
                    unset($aLog['new_data_res']);

                    // prepare log aParam
                    $aLog['log_event_type'] = 166;
                    $aLog['log_message'] = " made an update for administrative case, resolution of appeal in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                break;
            case '8':
                $aParam['legal_ac_stage_id'] = '20';
                $aResult = $this->checkSetAddACMBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 167;
                    $aLog['log_message'] = " added record for administrative case, writ of execution in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog['old_data'] = $aResult['old_data'];

                    // get new data 
                    $aLogParam['stage'] = $aParam['stage'];
                    $aLogParam['legal_ac_docket_id'] = $aParam['encrypt_legal_ac_docket_id'];

                    $aLog['new_data_res'] = $this->loadAdministrativeCaseInfoBatchByStages($aLogParam);
                    if (array_key_exists('legal_ac_docket_log_status', $aLog['new_data_res']['res'])) {
                        $aLog['new_data_res']['res']['legal_ac_docket_log_status'] = $this->changeStatusToString($aLog['new_data_res']['res']['legal_ac_docket_log_status']);
                    }
                    $aLog['new_data'] = $aLog['new_data_res']['res'];
                    $aLog['new_data']['legal_ac_docket_log_date'] = str_replace("/", "-", $aLog['new_data']['legal_ac_docket_log_date']);
                    unset($aLog['new_data_res']);

                    // prepare log aParam
                    $aLog['log_event_type'] = 168;
                    $aLog['log_message'] = " made an update for administrative case, writ of execution in Docket Number: <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
                    $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                break;
        }

        if (empty($aResult['res']) == false) {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            $aResponse['res'] = $aResult['res'];
        }

        return $aResponse;
    }

    public function checkSetAddACMBatchPerStage($aParam) {
        $aResult = [];

        $aResult['check'] = $this->Administrative_case_model->checkIfBatchStageExist($aParam);
        
        if ($aParam['stage'] == '3') {
            if(empty($aParam['legal_ac_docket_log_param_one'])){
                $aParam['param'] = ", `legal_ac_docket_log_param_one` = NULL ";
            }else{
                $aParam['param'] = ", `legal_ac_docket_log_param_one` = " . $aParam['legal_ac_docket_log_param_one'] . " ";
            }
            
        } else {
            $aParam['param'] = " ";
        }

        if ((int) $aResult['check'] > 0) {
            // update
            // get old data 
            $aLogParam['stage'] = $aParam['stage'];
            $aLogParam['legal_ac_docket_id'] = $aParam['encrypt_legal_ac_docket_id'];

            $aLog['old_data_res'] = $this->loadAdministrativeCaseInfoBatchByStages($aLogParam);

            if (array_key_exists('legal_ac_docket_log_status', $aLog['old_data_res']['res'])) {
                $aLog['old_data_res']['res']['legal_ac_docket_log_status'] = $this->changeStatusToString($aLog['old_data_res']['res']['legal_ac_docket_log_status']);
            }

            $aLog['old_data'] = $aLog['old_data_res']['res'];
            $aLog['old_data']['legal_ac_docket_log_date'] = str_replace("/", "-", $aLog['old_data']['legal_ac_docket_log_date']);
            $aResult['old_data'] = $aLog['old_data'];

            // do update 
            $aResult['res'] = $this->Administrative_case_model->setACDocketLogs($aParam);
        } else {
            // insert 
            $aResult['res'] = $this->Administrative_case_model->addACDocketLogs($aParam);
        }

        return $aResult;
    }

    public function getVictimListPerBatch($aParam) {
        $aResponse = [];
        $aResult = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;
        $aParam = $this->yel->safe_mode_clean_array($aParam);

        $aParam['legal_ac_docket_id'] = $this->yel->decrypt_param($aParam['legal_ac_docket_id']);

        $aResult['res'] = $this->Administrative_case_model->getVictimListPerBatch($aParam);

        if (!empty($aResult['res']) == true) {

            foreach ($aResult['res'] as $key => $val) {
                $aResult['res'][$key]['case_id'] = $this->yel->encrypt_param($val['case_id']);
                $aResult['res'][$key]['victim_id'] = $this->yel->encrypt_param($val['victim_id']);
                $aResult['res'][$key]['legal_ac_case_id'] = $this->yel->encrypt_param($val['legal_ac_case_id']);
                $aResult['res'][$key]['legal_ac_docket_id'] = $this->yel->encrypt_param($val['legal_ac_docket_id']);
                $aResult['res'][$key]['legal_ac_docket_case_id'] = $this->yel->encrypt_param($val['legal_ac_docket_case_id']);
            }

            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            $aResponse['res'] = $aResult['res'];
        }
        return $aResponse;
    }

    public function setBatchVictimStatus($aParam) {
        $aResponse = [];
        $aResult = [];
        $aLog = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;
        $aParam = $this->yel->safe_mode_clean_array($aParam);

        $aParam['encrypt_legal_ac_docket_id'] = $aParam['legal_ac_docket_id'];

        $aParam['legal_ac_docket_case_id'] = $this->yel->decrypt_param($aParam['legal_ac_docket_case_id']);
        $aParam['legal_ac_docket_id'] = $this->yel->decrypt_param($aParam['legal_ac_docket_id']);

        $aResult['res'] = $this->Administrative_case_model->setBatchVictimStatus($aParam);

        $aParam['victim_full_name'] = $this->Administrative_case_model->getVictimNamePerACBatchVictimId($aParam);
        $aParam['docket_number'] = $this->Administrative_case_model->getDocketNo($aParam);

        $aParam['status_name'] = ' active ';
        if ($aParam['status'] == '0') {
            $aParam['status_name'] = ' inactive ';
        }

        if ($aResult['res']['stat'] == '1') {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            $aResponse['res'] = $aResult['res'];

            // prepare log
            $aLog['log_event_type'] = 169;
            $aLog['log_message'] = " change <a href='victim_list/'> " . $aParam['victim_full_name'] . "</a> to " . $aParam['status_name'] . " in Administrative Case Docket Number:  <a href='admin_case_stages/" . $aParam['encrypt_legal_ac_docket_id'] . "'>" . $aParam['docket_number'] . "</a>";
            $aLog['log_action'] = 1; // 1= new inserted // 2=update table
            $aLog['module_primary_id'] = $aParam['legal_ac_docket_id'];
            $aLog['log_link'] = 'admin_case_stages/' . $aParam['encrypt_legal_ac_docket_id'];
            $aResponse['log'] = $this->audit->create($aLog);
        }


        return $aResponse;
    }

    private function changeStatusToString($iStatus) {
        $sStatus = 'On going';
        if ($iStatus == '1') {
            $sStatus = 'Done';
        }
        return $sStatus;
    }

    public function getLogsByACBatchId($aParam) {
        $aResult = [];
        $aResponse = [];
        $aResult['flag'] = self::FAILED_RESPONSE;

        $aResult = $this->audit->getActivityLogsAdministrativeCase($aParam);
        if (empty($aResult) == false) {
            foreach ($aResult['list'] as $key => $val) {
                if ($val['user_id'] == $_SESSION['userData']['user_id']) {
                    $aResult['list'][$key]['user_log_fullname'] = "You";
                }
                unset($aResult['list'][$key]['user_log_event_type_id']);
                unset($aResult['list'][$key]['user_id']);
            }
            $aResult['flag'] = self::SUCCESS_RESPONSE;
        }

        $aResponse = $aResult;

        return $aResponse;
    }

}
