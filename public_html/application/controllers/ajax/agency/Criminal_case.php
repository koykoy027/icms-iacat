<?php

/**
 * Agencies Internal Ajax
 * 
 * @module Ajax Loader
 * @author LBS eBusiness Solutions Corp. 
 * @since 2017
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Criminal_case extends CI_Controller {

    const SUCCESS_RESPONSE = 1;
    const FAILED_RESPONSE = 0;

    public function __construct() {
        parent::__construct();

        // load models
        $this->load->model('agency/Criminal_case_model');
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

    public function getCriminalCaseList($aParam) {

        $aResponse = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;
        $aParam = $this->yel->safe_mode_clean_array($aParam);
        $aParam = $this->yel->pagination($aParam);

        $aParam['c_keyword'] = "";
        if (!empty($aParam['keyword']) == true) {
            // for report id  and slip
            $aParam['c_keyword'] = " AND ( (MATCH (`c`.`case_number`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)) OR ( `c`.`case_id` IN (SELECT `case_id` FROM `icms_legal_cc_slip` WHERE (MATCH (`legal_cc_slip_investigation_no`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)))) )";
        }

        // get all legal services
        $services = $this->Criminal_case_model->getCriminalCaseList($aParam);

        if (empty($services['listing']) == false) {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            foreach ($services['listing'] as $key => $val) {
                $services['listing'][$key]['tagged_agency'] = $this->Criminal_case_model->getCriminalCaseListTaggedAgencyById($val['case_id']);
                $services['listing'][$key]['case_victim_id'] = $this->yel->encrypt_param($val['case_victim_id']);
                $services['listing'][$key]['case_id'] = $this->yel->encrypt_param($val['case_id']);
                $services['listing'][$key]['services_id'] = $this->yel->encrypt_param($val['services_id']);
                $services['listing'][$key]['victim_id'] = $this->yel->encrypt_param($val['victim_id']);
                $services['listing'][$key]['case_added_by'] = $this->yel->encrypt_param($val['case_added_by']);
            }
        }
        $aResponse['services'] = $services;
        return $aResponse;
    }

    public function setBatchVictimStatus($aParam) {
        $aResponse = [];
        $aResult = [];
        $aLog = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;
        $aParam = $this->yel->safe_mode_clean_array($aParam);

        $aParam['encrypt_legal_cc_batch_id'] = $aParam['legal_cc_batch_id'];

        $aParam['legal_cc_batch_victim_id'] = $this->yel->decrypt_param($aParam['legal_cc_batch_victim_id']);
        $aParam['legal_cc_batch_id'] = $this->yel->decrypt_param($aParam['legal_cc_batch_id']);

        $aParam['legal_cc_batch_nps_no'] = $this->Criminal_case_model->getCCBatchNPSNo($aParam);

        $aResult['res'] = $this->Criminal_case_model->setBatchVictimStatus($aParam);

        $aParam['victim_full_name'] = $this->Criminal_case_model->getVictimNamePerCCBatchVictimId($aParam);

        $aParam['status_name'] = ' active ';
        if ($aParam['status'] == '0') {
            $aParam['status_name'] = ' inactive ';
        }

        if ($aResult['res']['stat'] == '1') {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            $aResponse['res'] = $aResult['res'];

            // prepare log
            $aLog['log_event_type'] = 98;
            $aLog['log_message'] = " change <a href='victim_list/'> " . $aParam['victim_full_name'] . "</a> to " . $aParam['status_name'] . " in Criminal Case Docket Number:  <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
            $aLog['log_action'] = 1; // 1= new inserted // 2=update table
            $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
            $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
            $aResponse['log'] = $this->audit->create($aLog);
        }

        return $aResponse;
    }

    public function getVictimListPerBatch($aParam) {

        $aResponse = [];
        $aResult = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;
        $aParam = $this->yel->safe_mode_clean_array($aParam);

        $aParam['legal_cc_batch_id'] = $this->yel->decrypt_param($aParam['legal_cc_batch_id']);

        $aResult['res'] = $this->Criminal_case_model->getVictimListPerBatch($aParam);

        if (!empty($aResult['res']) == true) {

            foreach ($aResult['res'] as $key => $val) {
                $aResult['res'][$key]['case_id'] = $this->yel->encrypt_param($val['case_id']);
                $aResult['res'][$key]['legal_cc_batch_id'] = $this->yel->encrypt_param($val['legal_cc_batch_id']);
                $aResult['res'][$key]['legal_cc_batch_victim_id'] = $this->yel->encrypt_param($val['legal_cc_batch_victim_id']);
                $aResult['res'][$key]['legal_cc_slip_id'] = $this->yel->encrypt_param($val['legal_cc_slip_id']);
                $aResult['res'][$key]['victim_id'] = $this->yel->encrypt_param($val['victim_id']);
            }

            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            $aResponse['res'] = $aResult['res'];
        }
        return $aResponse;
    }

    public function addSetInvestigation($aParam) {

        $aResponse = [];
        $aResult = [];
        $aLog = [];

        $aResult['legal_cc_slip_date_filed'] = $aParam['legal_cc_slip_date_filed'];
        $aParam = $this->yel->safe_mode_clean_array($aParam);

        $aResponse['flag'] = self::FAILED_RESPONSE;
        $aParam['encrypt_case_id'] = $aParam['case_id'];
        $aParam['case_id'] = $this->yel->decrypt_param($aParam['case_id']);
        $aParam['legal_cc_slip_date_filed'] = date('Y-m-d', strtotime($aResult['legal_cc_slip_date_filed']));

        $aResult['check'] = $this->Criminal_case_model->checkInvestigationSlipExist($aParam);
        $aParam['legal_cc_slip_date_done'] = 'null';
        if ($aParam['legal_cc_slip_status'] == '1') {
            $aParam['legal_cc_slip_date_done'] = 'now()';
        }

        $aParam['case_number'] = $this->Criminal_case_model->getCaseNo($aParam);

        if ((int) $aResult['check'] > 0) {

            // get old data 
            $aLog['old_data'] = $this->Criminal_case_model->getInvestigationByCaseVicticeServicesId($aParam);

            //update
            $aResponse['res'] = $this->Criminal_case_model->setInvestigation($aParam);

            // get new data 
            $aLog['new_data'] = $this->Criminal_case_model->getInvestigationByCaseVicticeServicesId($aParam);

            /*             *  log              */
            $aLog['log_event_type'] = 127;
            $aLog['log_message'] = " made an update investigation and evidence gathering and slip no to Report Id: <a href='update_case/" . $aParam['encrypt_case_id'] . "'>" . $aParam['case_number'] . "</a>";
            $aLog['log_action'] = 2; // 1= new insert table 2=update table
            $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
            $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
            $aLog['module_primary_id'] = $aParam['case_id'];
            $aLog['log_link'] = 'criminal_case_list/';
            $aResponse['log'] = $this->audit->create($aLog);
        } else {
            //add
            $aResponse['res'] = $this->Criminal_case_model->addInvestigation($aParam);

            $aLog = [];
            $aLog['log_event_type'] = 126;

            $aLog['log_message'] = " added investigation and evidence gathering and slip no to Report Id: <a href='update_case/" . $aParam['encrypt_case_id'] . "'>" . $aParam['case_number'] . "</a>";
            $aLog['log_action'] = 1; // 1= new inserted // 2=update table
            $aLog['module_primary_id'] = $aParam['case_id'];
            $aLog['log_link'] = 'criminal_case_list/';
            $aResponse['log'] = $this->audit->create($aLog);
        }

        if ($aResponse['res']['stat'] == 1) {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            if ($aParam['legal_cc_slip_status'] == 1) {
                //send system notification to iacat admin 
                $aNotif = [];
                $aNotif['method'] = "criminal_case_list";
                $aNotif['tbl_id'] = $aParam['case_id'];
                $aNotif['receiver'] = 1;
                $aNotif['notif_type'] = "2";
                $aNotif['msg'] = "Investigation and Evidence Gathering for Report Id: <orange> <a href='update_case/" . $aParam['encrypt_case_id'] . "'>" . $aParam['case_number'] . " </a> </orange> is done.";
                $this->notif->create($aNotif);
            }
        }

        return $aResponse;
    }

    public function getInvestigationByCaseVicticeServicesId($aParam) {

        $aResponse = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;
        $aParam['case_id'] = $this->yel->decrypt_param($aParam['case_id']);

        $aResult['res'] = $this->Criminal_case_model->getInvestigationByCaseVicticeServicesId($aParam);

        if (!empty($aResult['res']) == true) {
            $aResponse['res'] = $aResult['res'];
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
        }

        return $aResponse;
    }

    public function getCriminalCaseListReportForBatch($aParam) {
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

        $aResult['res'] = $this->Criminal_case_model->getCriminalCaseListReportForBatch($aParam);
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

        $aResult['add_batch'] = $this->Criminal_case_model->addInitialLegalCCBatch($aParam);


        if (!empty($aResult['add_batch']['insert_id']) == true) {

            $legal_cc_batch_id = $aResult['add_batch']['insert_id'];
            $aParam['legal_cc_batch_id'] = $legal_cc_batch_id;
            $aResult['add_batch_stage_1'] = $this->Criminal_case_model->addBatchStagesForStage1($aParam);
            $aParam['legal_cc_batch_nps_no'] = $this->Criminal_case_model->getCCBatchNPSNo($aParam);
            $aParam['encrypt_legal_cc_batch_id'] = $this->yel->encrypt_param($aParam['legal_cc_batch_id']);

            /*             * Log         */
            $aLog['log_event_type'] = 82;
            $aLog['log_message'] = " added record for filling of complaint in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
            $aLog['log_action'] = 1; // 1= new inserted // 2=update table
            $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
            $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
            $aResponse['log'] = $this->audit->create($aLog);


            foreach ($aParam['case_id'] as $key => $val) {
                $aParam['case_id'][$key] = $this->yel->decrypt_param($val);
            }

            foreach ($aParam['case_id'] as $key => $val) {
                $aResult['add_victim'][$key] = $this->Criminal_case_model->addLegalCCBatchVictims($val, $legal_cc_batch_id);
            }

            $aResponse['flag'] = self::SUCCESS_RESPONSE;
        }

        return $aResponse;
    }

    public function getBatchDocketList($aParam) {

        $aResponse = [];
        $aResult = [];

        $aResponse['flag'] = self::FAILED_RESPONSE;

        $aParam = $this->yel->pagination($aParam);

        $aParam['c_keyword'] = "";
        if (!empty($aParam['keyword']) == true) {
            // for report id  and slip
            $aParam['c_keyword'] = " WHERE MATCH (`lccb`.`legal_cc_batch_nps_no`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)";
        }

        // get all legal services
        $aResult['res'] = $this->Criminal_case_model->getBatchDocketList($aParam);

        if (empty($aResult['res']) == false) {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            foreach ($aResult['res']['listing'] as $key => $val) {
                $aResult['res']['listing'][$key]['legal_cc_batch_id'] = $this->yel->encrypt_param($val['legal_cc_batch_id']);
            }
            $aResponse['res'] = $aResult['res'];
        }


        return $aResponse;
    }

    public function loadCriminalCaseInfoByStages($aParam) {
        $aResponse = [];
        $aResult = [];

        $aResponse['flag'] = self::FAILED_RESPONSE;
        $aParam = $this->yel->clean_array_walk_recursive($aParam);
        $aParam['legal_cc_batch_id'] = $this->yel->decrypt_param($aParam['legal_cc_batch_id']);

        switch ($aParam['stage']) {
            case '1':
                $aParam['legal_cc_stage_id'] = 1;
                $aResult['res'] = $this->Criminal_case_model->getFillingOfComplaintPerId($aParam);
                $aCCDateRemarksPerStage = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                if (empty($aCCDateRemarksPerStage['legal_cc_batch_stage_status']) == false) {
                    $aResult['res']['legal_cc_batch_stage_status'] = $aCCDateRemarksPerStage['legal_cc_batch_stage_status'];
                }
                break;
            case '2':
                $aParam['legal_cc_stage_id'] = 2;
                $aResult['res'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                break;
            case '2_1':
                $aParam['legal_cc_stage_id'] = 2;
                $aResult['res'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                break;
            case '2_2':
                $aParam['legal_cc_stage_id'] = 3;
                $aResult['res'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                break;
            case '2_3':
                $aParam['legal_cc_stage_id'] = 4;
                $aResult['res'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                break;
            case '2_4':
                $aParam['legal_cc_stage_id'] = 5;
                $aResult['res'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                break;
            case '2_5':
                $aParam['legal_cc_stage_id'] = 6;
                $aResult['res'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                break;
            case '2_6':
                $aParam['legal_cc_stage_id'] = 7;
                $aResult['res'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                break;
            case '2_7':
                $aParam['legal_cc_stage_id'] = 8;
                $aResult['res'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                break;
            case '3':
                $aParam['legal_cc_stage_id'] = 9;
                $aResult['res'] = $this->Criminal_case_model->getFillingOfComplaintPerId($aParam);
                $aCCDateRemarksPerStage = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);

                if (empty($aCCDateRemarksPerStage['legal_cc_batch_stage_date']) == false) {
                    $aResult['res']['legal_cc_batch_stage_date'] = $aCCDateRemarksPerStage['legal_cc_batch_stage_date'];
                    $aResult['res']['legal_cc_batch_stage_status'] = $aCCDateRemarksPerStage['legal_cc_batch_stage_status'];
                }

                break;
            case '4':
                $aParam['legal_cc_stage_id'] = 10;
                $aResult['res'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                break;
            case '5':
                $aParam['legal_cc_stage_id'] = 11;
                $aResult['res'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                break;
            case '6':
                $aParam['legal_cc_stage_id'] = 12;
                $aResult['res'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                break;
            case '7':
                $aParam['legal_cc_stage_id'] = 13;
                $aResult['res'] = $this->Criminal_case_model->getCourtTrialsByBatch($aParam);
                break;
            case '8':
                $aParam['legal_cc_stage_id'] = 14;
                $aResult['res'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                break;
            case '9':
                $aParam['legal_cc_stage_id'] = 15;
                $aResult['res'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                break;
            case '10':
                $aParam['legal_cc_stage_id'] = 16;
                $aResult['res'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                break;
            case '11':
                $aParam['legal_cc_stage_id'] = 17;
                $aResult['res'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                break;
            case '12':
                $aParam['legal_cc_stage_id'] = 18;
                $aResult['res'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                break;
            case '13':
                $aParam['legal_cc_stage_id'] = 19;
                $aResult['res'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                break;
            case '14':
                $aParam['legal_cc_stage_id'] = 20;
                $aResult['res'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                break;
            case '15':
                $aParam['legal_cc_stage_id'] = 21;
                $aResult['res'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                break;
        }


        if (empty($aResult['res']) == false) {

            // unset legal_cc_batch id's 
            unset($aResult['res']['legal_cc_batch_added_by'],
                    $aResult['res']['legal_cc_batch_id'],
                    $aResult['res']['legal_cc_batch_modified_by'],
                    $aResult['res']['legal_cc_batch_modified_by']
            );

            // unset legal_cc_stage id's
            if (empty($aResult['res']['legal_cc_stage_id']) == false) {
                unset($aResult['res']['legal_cc_stage_id'],
                        $aResult['res']['legal_cc_batch_stage_id'],
                        $aResult['res']['legal_cc_batch_stage_added_by']
                );
            }

            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            $aResponse['res'] = $aResult['res'];
        }

        return $aResponse;
    }

    public function setFillinfOfComplaint($aParam) {

        $aResponse = [];
        $aResult = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;

        $aResult['legal_cc_batch_date_filed'] = $aParam['legal_cc_batch_date_filed'];
        $aParam = $this->yel->safe_mode_clean_array($aParam);
        $aParam['legal_cc_batch_date_filed'] = $aResult['legal_cc_batch_date_filed'];
        $aParam['encrypt_legal_cc_batch_id'] = $aParam['legal_cc_batch_id'];
        $aParam['legal_cc_batch_id'] = $this->yel->decrypt_param($aParam['legal_cc_batch_id']);
        $aParam['legal_cc_stage_id'] = '1';

        $aLog = [];

        // get old value 
        $aLog['old_data'] = $this->Criminal_case_model->getFillingOfComplaintPerId($aParam);
        $aCCDateRemarksPerStage = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
        if (empty($aCCDateRemarksPerStage['legal_cc_batch_stage_status']) == false) {
            $aLog['old_data']['legal_cc_batch_stage_status'] = $aCCDateRemarksPerStage['legal_cc_batch_stage_status'];
        }

        // set 
        $aResult['res']['batch'] = $this->Criminal_case_model->setFillinfOfComplaint($aParam);
        $aResult['res']['stage'] = $this->Criminal_case_model->setBatchStatus($aParam);

        // get new value 
        $aLog['new_data'] = $this->Criminal_case_model->getFillingOfComplaintPerId($aParam);
        $aCCDateRemarksPerStage = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
        if (empty($aCCDateRemarksPerStage['legal_cc_batch_stage_status']) == false) {
            $aLog['new_data']['legal_cc_batch_stage_status'] = $aCCDateRemarksPerStage['legal_cc_batch_stage_status'];
        }

        $aLog['log_event_type'] = 83;
        $aLog['log_message'] = " made an update for filling of complaint in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
        $aLog['log_action'] = 2; // 1= new insert table 2=update table
        $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
        $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
        $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
        $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
        $aResponse['log'] = $this->audit->create($aLog);


        if (empty($aResult['res']) == false) {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            $aResponse['res'] = $aResult['res'];
        }

        return $aResult;
    }

    public function setStatusTrial($aParam) {
        $aResult = [];
        $aResponse = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;
        $aParam = $this->yel->safe_mode_clean_array($aParam);
        $aParam['encrypt_legal_cc_batch_id'] = $aParam['legal_cc_batch_id'];
        $aParam['legal_cc_batch_id'] = $this->yel->decrypt_param($aParam['legal_cc_batch_id']);
        $aParam['legal_cc_stage_id'] = '13';
        $aParam['legal_cc_batch_nps_no'] = $this->Criminal_case_model->getCCBatchNPSNo($aParam);

        $aResult['check'] = $this->Criminal_case_model->checkIfStageExist($aParam);
        if ((int) $aResult['check'] <= 0) {
            $aParam['legal_cc_batch_stage_date'] = null;
            $aParam['legal_cc_batch_stage_remarks'] = null;
            // insert trial batch in stage 
            $aResult['res-trial_batch_stage'] = $this->Criminal_case_model->addCourtTrialBatchInStage($aParam);

            $aLog = [];
            $aLog['log_event_type'] = 106;
            $aLog['log_message'] = " added record for trial stage in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
            $aLog['log_action'] = 1; // 1= new inserted // 2=update table
            $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
            $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
            $aResponse['log'] = $this->audit->create($aLog);
        } else {

            $aLog = [];
            // get old data 
            $aLog['old_data'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);

            // update 
            $aResult['res'] = $this->Criminal_case_model->setBatchStatus($aParam);

            // get new data 
            $aLog['new_data'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);

            /*             *  log              */

            $aLog['log_event_type'] = 107;
            $aLog['log_message'] = " made an update status for trial in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
            $aLog['log_action'] = 2; // 1= new insert table 2=update table
            $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
            $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
            $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
            $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
            $aResponse['log'] = $this->audit->create($aLog);
        }

        if (empty($aResult['res']) == false) {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            $aResponse['res'] = $aResult['res'];
        }

        return $aResponse;
    }

    public function checkSetAddLegalBatchPerStage($aParam) {

        $aResult = [];

        $aResult['check'] = $this->Criminal_case_model->checkIfStageExist($aParam);

        if ((int) $aResult['check'] > 0) {
            // update
            $aResult['old_data'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
            $aResult['res'] = $this->Criminal_case_model->setLegalCCBatchPerStage($aParam);
        } else {
            // insert 
            $aResult['res'] = $this->Criminal_case_model->addLegalCCBatchPerStage($aParam);
        }

        return $aResult;
    }

    public function checkSetAddTrialLogs($aParam) {
        $aResult = [];

        $aResult['check'] = $this->Criminal_case_model->checkIfStageExist($aParam);

        // insert 
        $aResult['res-batch_court_trials'] = $this->Criminal_case_model->addBatchCourtTrial($aParam);
        $aLog = [];
        $aLog['log_event_type'] = 124;
        $aLog['log_message'] = " added record for trial details in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
        $aLog['log_action'] = 1; // 1= new inserted // 2=update table
        $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
        $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
        $aResponse['log'] = $this->audit->create($aLog);


        if ((int) $aResult['check'] <= 0) {
            $aParam['legal_cc_batch_stage_date'] = null;
            $aParam['legal_cc_batch_stage_remarks'] = null;
            // insert trial batch in stage 
            $aResult['res-trial_batch_stage'] = $this->Criminal_case_model->addCourtTrialBatchInStage($aParam);

            $aLog = [];
            $aLog['log_event_type'] = 106;
            $aLog['log_message'] = " added record for trial stage in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
            $aLog['log_action'] = 1; // 1= new inserted // 2=update table
            $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
            $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
            $aResponse['log'] = $this->audit->create($aLog);
        }

        return $aResult;
    }

    public function setDateRemarksPerStageId($aParam) {

        $aResponse = [];
        $aResult = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;

        // clean array 
        $aParam = $this->yel->clean_array_walk_recursive($aParam);

        $aParam['legal_cc_batch_stage_date'] = $aParam['date_remarks'];
        $aParam['legal_cc_batch_stage_remarks'] = $aParam['remarks'];
        $aParam['encrypt_legal_cc_batch_id'] = $aParam['legal_cc_batch_id'];
        $aParam['legal_cc_batch_id'] = $this->yel->decrypt_param($aParam['legal_cc_batch_id']);
        $aParam['legal_cc_batch_nps_no'] = $this->Criminal_case_model->getCCBatchNPSNo($aParam);

        switch ($aParam['stage']) {
            case '2_1':
                $aParam['legal_cc_stage_id'] = '2';
                $aResult = $this->checkSetAddLegalBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 84;
                    $aLog['log_message'] = " added record for  preliminary investigation  in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }
                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['old_data'] = $aResult['old_data'];
                    $aLog['new_data'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                    $aLog['log_event_type'] = 85;
                    $aLog['log_message'] = " made an update for preliminary investigation in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                break;
            case '2_2':
                $aParam['legal_cc_stage_id'] = '3';
                $aResult = $this->checkSetAddLegalBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 86;
                    $aLog['log_message'] = " added record for inquest in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }
                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['old_data'] = $aResult['old_data'];
                    $aLog['new_data'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                    $aLog['log_event_type'] = 87;
                    $aLog['log_message'] = " made an update for inquest in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                break;
            case '2_3':
                $aParam['legal_cc_stage_id'] = '4';
                $aResult = $this->checkSetAddLegalBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 88;
                    $aLog['log_message'] = " added record for resolution of the investigation prosecutor in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }
                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['old_data'] = $aResult['old_data'];
                    $aLog['new_data'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                    $aLog['log_event_type'] = 89;
                    $aLog['log_message'] = " made an update for resolution of the investigation prosecutor in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                break;
            case '2_4':
                $aParam['legal_cc_stage_id'] = '5';
                $aResult = $this->checkSetAddLegalBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 90;
                    $aLog['log_message'] = " added record for motion for reconsideration on the resolution in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }
                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['old_data'] = $aResult['old_data'];
                    $aLog['new_data'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                    $aLog['log_event_type'] = 91;
                    $aLog['log_message'] = " made an update for motion for reconsideration on the resolution in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                break;
            case '2_5':
                $aParam['legal_cc_stage_id'] = '6';
                $aResult = $this->checkSetAddLegalBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 92;
                    $aLog['log_message'] = " added record for review of the city or provincial prosecutor in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }
                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['old_data'] = $aResult['old_data'];
                    $aLog['new_data'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                    $aLog['log_event_type'] = 93;
                    $aLog['log_message'] = " made an update for review of the city or provincial prosecutor in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                break;
            case '2_6':
                $aParam['legal_cc_stage_id'] = '7';
                $aResult = $this->checkSetAddLegalBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 94;
                    $aLog['log_message'] = " added record for petition for review to the secretary of justice in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }
                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['old_data'] = $aResult['old_data'];
                    $aLog['new_data'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                    $aLog['log_event_type'] = 95;
                    $aLog['log_message'] = " made an update for petition for review to the secretary of justice in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                break;
            case '2_7':
                $aParam['legal_cc_stage_id'] = '8';
                $aResult = $this->checkSetAddLegalBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 96;
                    $aLog['log_message'] = " added record for motion for reconsideration on the resolution of the SOJ in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }
                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['old_data'] = $aResult['old_data'];
                    $aLog['new_data'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                    $aLog['log_event_type'] = 97;
                    $aLog['log_message'] = " made an update for motion for reconsideration on the resolution of the SOJ in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                break;
            case '4':
                $aParam['legal_cc_stage_id'] = '10';
                $aResult = $this->checkSetAddLegalBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 100;
                    $aLog['log_message'] = " added record for dismissal or issuance of warrant or arrest or commitment order in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }
                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['old_data'] = $aResult['old_data'];
                    $aLog['new_data'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                    $aLog['log_event_type'] = 101;
                    $aLog['log_message'] = " made an update for dismissal or issuance of warrant or arrest or commitment order in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                break;
            case '5':
                $aParam['legal_cc_stage_id'] = '11';
                $aResult = $this->checkSetAddLegalBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 102;
                    $aLog['log_message'] = " added record for bail-hearing and resolution of petition for bail in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }
                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['old_data'] = $aResult['old_data'];
                    $aLog['new_data'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                    $aLog['log_event_type'] = 103;
                    $aLog['log_message'] = " made an update for bail-hearing and resolution of petition for bail in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                break;
            case '6':

                $aParam['legal_cc_stage_id'] = '12';
                $aResult = $this->checkSetAddLegalBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 104;
                    $aLog['log_message'] = " added record for arraignment and pre-trial conference in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }
                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['old_data'] = $aResult['old_data'];
                    $aLog['new_data'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                    $aLog['log_event_type'] = 105;
                    $aLog['log_message'] = " made an update for arraignment and pre-trial conference in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                break;
            case '7':
                $aParam['legal_cc_stage_id'] = '13';
                $aResult = $this->checkSetAddTrialLogs($aParam);

                break;
            case '8':
                $aParam['legal_cc_stage_id'] = '14';
                $aResult = $this->checkSetAddLegalBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 108;
                    $aLog['log_message'] = " added record for submission for resolution in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }
                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['old_data'] = $aResult['old_data'];
                    $aLog['new_data'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                    $aLog['log_event_type'] = 109;
                    $aLog['log_message'] = " made an update for submission for resolution in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }


                break;
            case '9':
                $aParam['legal_cc_stage_id'] = '15';
                $aResult = $this->checkSetAddLegalBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 110;
                    $aLog['log_message'] = " added record for promulgation of judgment in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }
                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['old_data'] = $aResult['old_data'];
                    $aLog['new_data'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                    $aLog['log_event_type'] = 111;
                    $aLog['log_message'] = " made an update for promulgation of judgment in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                break;
            case '10':
                $aParam['legal_cc_stage_id'] = '16';
                $aResult = $this->checkSetAddLegalBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 112;
                    $aLog['log_message'] = " added record for motion for reconsideration or new trial in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }
                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['old_data'] = $aResult['old_data'];
                    $aLog['new_data'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                    $aLog['log_event_type'] = 113;
                    $aLog['log_message'] = " made an update for motion for reconsideration or new trial in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }


                break;
            case '11':
                $aParam['legal_cc_stage_id'] = '17';
                $aResult = $this->checkSetAddLegalBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 114;
                    $aLog['log_message'] = " added record for appeal to court of appeals in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }
                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['old_data'] = $aResult['old_data'];
                    $aLog['new_data'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                    $aLog['log_event_type'] = 115;
                    $aLog['log_message'] = " made an update for appeal to court of appeals in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }


                break;
            case '12':
                $aParam['legal_cc_stage_id'] = '18';
                $aResult = $this->checkSetAddLegalBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 116;
                    $aLog['log_message'] = " added record for motion for reconsideration on the decision of CA in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }
                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['old_data'] = $aResult['old_data'];
                    $aLog['new_data'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                    $aLog['log_event_type'] = 117;
                    $aLog['log_message'] = " made an update for motion for reconsideration on the decision of CA in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }


                break;
            case '13':
                $aParam['legal_cc_stage_id'] = '19';
                $aResult = $this->checkSetAddLegalBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 118;
                    $aLog['log_message'] = " added record for decision of CA in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }
                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['old_data'] = $aResult['old_data'];
                    $aLog['new_data'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                    $aLog['log_event_type'] = 119;
                    $aLog['log_message'] = " made an update for decision of CA in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                break;
            case '14':
                $aParam['legal_cc_stage_id'] = '20';
                $aResult = $this->checkSetAddLegalBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 120;
                    $aLog['log_message'] = " added record for appeal to the supreme court in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }
                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['old_data'] = $aResult['old_data'];
                    $aLog['new_data'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                    $aLog['log_event_type'] = 121;
                    $aLog['log_message'] = " made an update for appeal to the supreme court in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                break;
            case '15':
                $aParam['legal_cc_stage_id'] = '21';
                $aResult = $this->checkSetAddLegalBatchPerStage($aParam);

                /*                 * Logs                 */
                // insert 
                if (($aResult['check'] == '0') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['log_event_type'] = 122;
                    $aLog['log_message'] = " added record for decision of sc in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 1; // 1= new inserted // 2=update table
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }
                // update
                else if (($aResult['check'] == '1') && ($aResult['res']['stat'] == '1')) {
                    $aLog = [];
                    $aLog['old_data'] = $aResult['old_data'];
                    $aLog['new_data'] = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
                    $aLog['log_event_type'] = 123;
                    $aLog['log_message'] = " made an update for decision of sc in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
                    $aLog['log_action'] = 2; // 1= new insert table 2=update table
                    $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
                    $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
                    $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
                    $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
                    $aResponse['log'] = $this->audit->create($aLog);
                }

                break;
            default:
                $aResult['res'] = "Something wen't wrong!";
        }

        if (empty($aResult['res']) == false) {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            $aResponse['res'] = $aResult['res'];
        }

        return $aResult;
    }

    public function setFillingInformationInCourt($aParam) {
        $aResponse = [];
        $aResult = [];
        $aLog = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;
        $aParam['legal_cc_stage_id'] = '9';

        // clean array 
        $aParam = $this->yel->clean_array_walk_recursive($aParam);
        $aParam['encrypt_legal_cc_batch_id'] = $aParam['legal_cc_batch_id'];
        $aParam['legal_cc_batch_id'] = $this->yel->decrypt_param($aParam['legal_cc_batch_id']);
        $aParam['legal_cc_batch_nps_no'] = $this->Criminal_case_model->getCCBatchNPSNo($aParam);

        $aResult['check_exist'] = $this->Criminal_case_model->checkFillingInformationInCourtExist($aParam);

        if ((int) $aResult['check_exist'] <= 0) {
            $aResult['res']['insert'] = $this->Criminal_case_model->addFillingInformationInCourt($aParam);

            $aLog['log_event_type'] = 98;
            $aLog['log_message'] = " added record for filing of information in court in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
            $aLog['log_action'] = 1; // 1= new inserted // 2=update table
            $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
            $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
            $aResponse['log'] = $this->audit->create($aLog);
        }

        // get old value 
        $aLog['old_data'] = $this->Criminal_case_model->getFillingOfComplaintPerId($aParam);
        $aCCDateRemarksPerStage = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
        if (empty($aCCDateRemarksPerStage['legal_cc_batch_stage_status']) == false) {
            $aLog['old_data']['legal_cc_batch_stage_status'] = $aCCDateRemarksPerStage['legal_cc_batch_stage_status'];
        }

        // set 
        $aResult['res']['update']['batch'] = $this->Criminal_case_model->setFillingInformationInCourt($aParam);
        $aResult['res']['update']['stage'] = $this->Criminal_case_model->setBatchStatus($aParam);

        // get new value 
        $aLog['new_data'] = $this->Criminal_case_model->getFillingOfComplaintPerId($aParam);
        $aCCDateRemarksPerStage = $this->Criminal_case_model->getCCDateRemarksPerStage($aParam);
        if (empty($aCCDateRemarksPerStage['legal_cc_batch_stage_status']) == false) {
            $aLog['new_data']['legal_cc_batch_stage_status'] = $aCCDateRemarksPerStage['legal_cc_batch_stage_status'];
        }

        $aLog['log_event_type'] = 99;
        $aLog['log_message'] = " made an update for filling of complaint in Docket Number: <a href='criminal_case_stages/" . $aParam['encrypt_legal_cc_batch_id'] . "'>" . $aParam['legal_cc_batch_nps_no'] . "</a>";
        $aLog['log_action'] = 2; // 1= new insert table 2=update table
        $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
        $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
        $aLog['module_primary_id'] = $aParam['legal_cc_batch_id'];
        $aLog['log_link'] = 'criminal_case_stages/' . $aParam['encrypt_legal_cc_batch_id'];
        $aResponse['log'] = $this->audit->create($aLog);

        if (empty($aResult['res']['update']) == false) {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            $aResponse['res'] = $aResult['res'];
        }

        return $aResponse;
    }

    public function getLogsByCCBatchId($aParam) {
        $aResult = [];
        $aResponse = [];
        $aResult['flag'] = self::FAILED_RESPONSE;

        $aResult = $this->audit->getActivityLogsCriminalCase($aParam);
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
