<?php

/**
 * Case Internal Ajax
 * 
 * @module Ajax Loader
 * @author LBS eBusiness Solutions Corp. 
 * @since 2017
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Recruitment extends CI_Controller {

    const SUCCESS_RESPONSE = 1;
    const FAILED_RESPONSE = 0;

    public function __construct() {
        parent::__construct();

        // load models
        $this->load->model('agency/Recruitment_model');
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

    /*
     * fetching recruitment list
     * by:dev_arvin
     */

    public function getListLocalRecruitment($aParam) {
        $aResponse = [];
        $aResult = [];
        $aParam = $this->yel->pagination($aParam);

        $aParam['sRelevance'] = '';
        $aParam['cRelevance'] = '';

        // pagination
        $aParam['pagination'] = $aParam;

        if ($aParam['orderby'] == "1") {
            $aParam['orderby'] = " ORDER BY `ra`.`recruitment_agency_name` ASC ";
        } else if ($aParam['orderby'] == "2") {
            $aParam['orderby'] = " ORDER BY `ra`.`recruitment_agency_name` DESC ";
        } else if ($aParam['orderby'] == "3") {
            $aParam['orderby'] = " ORDER BY `case_count` ASC ";
        } else if ($aParam['orderby'] == "4") {
            $aParam['orderby'] = " ORDER BY `case_count` DESC ";
        } else {
            $aParam['orderby'] = "";
        }

        $aParam['c_agency_local'] = "";
        if ($aParam ['display'] == 'with_cases') {
            $aParam['c_agency_local'] = " AND ( SELECT COUNT(1) FROM `icms_case_victim_employment` WHERE  `recruitment_agency_id_local` = `ra`.`recruitment_agency_id`)";
        }

        if ($aParam['keyword'] !== "" || empty($aParam['keyword']) == false) {
            $aParam['sRelevance'] = "
                    , MATCH (`ra`.`recruitment_agency_name`, `ra`.`recruitment_agency_owner_name`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)  as relevance1 
             ";
            $aParam['cRelevance'] = "
                 AND (MATCH (`ra`.`recruitment_agency_name`, `ra`.`recruitment_agency_owner_name`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE))                
            ";
        }

        //list 
        $aResponse['content'] = $this->Recruitment_model->getListLocalRecruitment($aParam);


        foreach ($aResponse['content']['list'] as $key => $val) {
            $aResponse['content']['list'][$key]['recruitment_agency_id'] = $this->yel->encrypt_param($val['recruitment_agency_id']);
        }

        return $aResponse;
    }

    public function getListForeignRecruitment($aParam) {
        $aResponse = [];
        $aResult = [];
        $aParam = $this->yel->pagination($aParam);

        $aParam['sRelevance'] = '';
        $aParam['cRelevance'] = '';

        // pagination
        $aParam['pagination'] = $aParam;

        if ($aParam['orderby'] == "1") {
            $aParam['orderby'] = " ORDER BY `ra`.`recruitment_agency_name` ASC ";
        } else if ($aParam['orderby'] == "2") {
            $aParam['orderby'] = " ORDER BY `ra`.`recruitment_agency_name` DESC ";
        } else if ($aParam['orderby'] == "3") {
            $aParam['orderby'] = " ORDER BY `case_count` ASC ";
        } else if ($aParam['orderby'] == "4") {
            $aParam['orderby'] = " ORDER BY `case_count` DESC ";
        } else {
            $aParam['orderby'] = "";
        }

        $aParam['c_agency_foreign'] = "";
        if ($aParam ['display'] == 'with_cases') {
            $aParam['c_agency_foreign'] = " AND ( SELECT COUNT(1) FROM `icms_case_victim_employment` WHERE  `recruitment_agency_id_local` = `ra`.`recruitment_agency_id`)";
        }
        if ($aParam['keyword'] !== "" || empty($aParam['keyword']) == false) {
            $aParam['sRelevance'] = "
                    , MATCH (`ra`.`recruitment_agency_name`, `ra`.`recruitment_agency_owner_name`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)  as relevance1 
             ";
            $aParam['cRelevance'] = "
                 AND (MATCH (`ra`.`recruitment_agency_name`, `ra`.`recruitment_agency_owner_name`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE))                
            ";
        }

        //list 
        $aResponse['content'] = $this->Recruitment_model->getListForeignRecruitment($aParam);

        foreach ($aResponse['content']['list'] as $key => $val) {
            $aResponse['content']['list'][$key]['recruitment_agency_id'] = $this->yel->encrypt_param($val['recruitment_agency_id']);
        }

        return $aResponse;
    }

    public function getRecruitmentDetailsByID($aParam) {
        $aResponse = [];
        $aParam['agency_id'] = $this->yel->decrypt_param($aParam['id']);
        $aResponse['details'] = $this->Recruitment_model->getRecruitmentDetailsByID($aParam);
        $aResponse['result'] = "0";
        if (!empty($aResponse['details']) == true) {
            $aResponse['details']['recruitment_agency_id'] = $this->yel->encrypt_param($aResponse['details']['recruitment_agency_id']);
            $aResponse['result'] = "1";
        }
        return $aResponse;
    }

    public function setRecruitmentAgencyDetails($aParam) {
        $aResult['flag'] = self::FAILED_RESPONSE;
        $aParam = $this->yel->safe_mode_clean_array($aParam);

        //validation rules
        $aRules = array(
            'agency_name' => 'required',
            'agency_email' => 'required',
            'agency_tel' => 'required',
            'agency_country' => 'required',
            'agency_state' => 'required',
            'agency_address' => 'required',
            'agency_owner' => 'required',
        );

        /**
         * Parameter Validation
         */
        $aAssert = $this->assert->formValidate($aParam, $aRules);

        $aResponse['php_validation'] = $aAssert;
        if ($aAssert['flag'] != self::ACTIVE_STATUS) {
            return $aResponse;
        }

        $aResponse['flag'] = self::ACTIVE_STATUS;
        $aParam['user_id'] = $this->yel->getUserIDByAccessKey($_SESSION['userData']['accessKey']);
        $aParam['agency_id'] = $this->yel->decrypt_param($aParam['agency_id']);
        $aLog['old_data'] = $this->Recruitment_model->getRecruitmentAgencyDetails($aParam);
        $aResponse['set_details'] = $this->Recruitment_model->setRecruitmentAgencyDetails($aParam);
        $aLog['new_data'] = $this->Recruitment_model->getRecruitmentAgencyDetails($aParam);
        $aLog['log_event_type'] = 28;
        $aLog['log_message'] = "update <a href='recruitment_and_employer/" . $this->yel->encrypt_param($aParam['agency_id']) . "'>recruitment agency</a> details";
        $aLog['log_action'] = 2; // 1= new inserted // 2=update table
        $aLog['log_link'] = 'recruitment_and_employer/' . $this->yel->encrypt_param($aParam['agency_id']);
        $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
        $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
        $aResponse['log'] = $this->audit->create($aLog);


        return $aResponse;
    }

    public function getLocalRecruitmentByKeyword($aParam) {
        $aResponse = [];
        $aResult = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;
        $aResult['list'] = $this->Recruitment_model->getLocalRecruitmentByKeyword($aParam);
        if (count($aResult['list']) > 0) {
            foreach ($aResult['list'] as $key => $val) {
                $aResult['list'][$key]['recruitment_agency_id'] = $this->yel->encrypt_param($val['recruitment_agency_id']);
            }
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            $aResponse['list'] = $aResult['list'];
        }
        return $aResponse;
    }

    public function getForeignRecruitmentByKeyword($aParam) {
        $aResponse = [];
        $aResult = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;
        $aResult['list'] = $this->Recruitment_model->getForeignRecruitmentByKeyword($aParam);
        if (count($aResult['list']) > 0) {
            foreach ($aResult['list'] as $key => $val) {
                $aResult['list'][$key]['recruitment_agency_id'] = $this->yel->encrypt_param($val['recruitment_agency_id']);
            }
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            $aResponse['list'] = $aResult['list'];
        }
        return $aResponse;
    }

}
