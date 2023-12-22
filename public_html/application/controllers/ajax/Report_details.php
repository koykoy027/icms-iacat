<?php

/**
 * Reports Internal Ajax
 * 
 * @module Ajax Loader
 * @author LBS eBusiness Solutions Corp. 
 * @since 2017
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_details extends CI_Controller {

    const SUCCESS_RESPONSE = 1;
    const FAILED_RESPONSE = 0;

    public function __construct() {
        parent::__construct();
        // load models
        $this->load->model('Report_details_model');
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

    public function getVictimPersonalInfoByCaseId($aParam) {
        $aResponse = [];
        $aParam['case_id'] = $this->yel->decrypt_param($aParam['case_id']);
        $aResponse['result'] = $this->Report_details_model->getVictimPersonalInfoByCaseId($aParam);
        foreach ($aResponse['result'] as $key => $val) {
            $aResponse['result'][$key]['case_victim_id'] = $this->yel->encrypt_param($val['case_victim_id']);
        }
        return $aResponse;
    }

    public function getEmploymentDetails($aParam) {
        $aResponse = [];
        $aParam['case_victim_id'] = $this->yel->decrypt_param($aParam['case_victim_id']);
        $result = $this->Report_details_model->getEmploymentDetails($aParam);
        if (empty($result) == FALSE) {
            $aResponse['result']['employment_type'] = $result['employment_type'];
            $aResponse['result']['actual_work'] = $result['actual_work'];
            $aResponse['result']['different_contract'] = $result['different_contract'];
            $aResponse['result']['employer']['details'] = $this->Report_details_model->getEmployerDetailsByEmployerId($result['employer_id']);
            $aResponse['result']['employer']['result'] = 1;
            if (isset($aResponse['result']['employer']['details']['employer_name']) == false) {
                $aResponse['result']['employer']['result'] = 0;
            }

            $aResponse['result']['local_recruitment']['details'] = $this->Report_details_model->getLocalRecruitmentAgencyByAgencyID($result['recruitment_agency_id_local']);
            $aResponse['result']['local_recruitment']['result'] = 1;
            if (isset($aResponse['result']['local_recruitment']['details']['recruitment_agency_name']) == false) {
                $aResponse['result']['local_recruitment']['result'] = 0;
            }
            $aResponse['result']['foreign_recruitment'] = $this->Report_details_model->getForeignRecruitmentAgencyByAgencyID($result['recruitment_agency_id_foreign']);
            $aResponse['result']['foreign_recruitment']['result'] = 1;
            if (isset($aResponse['result']['foreign_recruitment']['details']['recruitment_agency_name']) == false) {
                $aResponse['result']['foreign_recruitment']['result'] = 0;
            }
        }
        return $aResponse;
    }

    public function getDeploymentDetails($aParam) {
        $aResponse = [];
        $aParam['case_victim_id'] = $this->yel->decrypt_param($aParam['case_victim_id']);
        $aResponse = $this->Report_details_model->getDeploymentDetails($aParam);
        return $aResponse;
    }

    public function getActMeansPurpose($aParam) {
        $aResponse = [];
        $aParam['case_victim_id'] = $this->yel->decrypt_param($aParam['case_victim_id']);
        $aParam['case_id'] = $this->yel->decrypt_param($aParam['case_id']);
        $aResponse['tip'] = $this->Report_details_model->getActMeansPurpose($aParam);
        $aResponse['fact'] = $this->Report_details_model->getCaseFacts($aParam);
        return $aResponse;
    }

    public function getReportComplainant($aParam) {
        $aResponse = [];
        $aParam['case_victim_id'] = $this->yel->decrypt_param($aParam['case_victim_id']);
        $aResponse = $this->Report_details_model->getReportComplainant($aParam);
        return $aResponse;
    }

    public function getReportServices($aParam) {
        $aResponse = [];
        $aParam['case_victim_id'] = $this->yel->decrypt_param($aParam['case_victim_id']);
        $aResponse['services'] = $this->Report_details_model->getReportServices($aParam);
        $aResponse['result'] = 1;
        if (empty($aResponse['services']) == true) {
            $aResponse['result'] = 0;
        }
        return $aResponse;
    }

}
