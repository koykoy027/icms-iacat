<?php

/**
 * Case Internal Ajax
 * 
 * @module Ajax Loader
 * @author LBS eBusiness Solutions Corp. 
 * @since 2017
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Employer extends CI_Controller {

    const SUCCESS_RESPONSE = 1;
    const FAILED_RESPONSE = 0;

    public function __construct() {
        parent::__construct();

        // load models
        $this->load->model('agency/Employer_model');
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

    public function getListEmployer($aParam) {
        $aResponse = [];
        $aResult = [];
        $aParam['sRelevance'] = "";
        $aParam['cRelevance'] = "";

        $aParam = $this->yel->pagination($aParam);

        // pagination
        $aParam['pagination'] = $aParam;

        if ($aParam['orderby'] == "1") {
            $aParam['orderby'] = " ORDER BY `ie`.`employer_name` ASC ";
        } else if ($aParam['orderby'] == "2") {
            $aParam['orderby'] = " ORDER BY `ie`.`employer_name` DESC ";
        } else if ($aParam['orderby'] == "3") {
            $aParam['orderby'] = " ORDER BY `case_count` ASC ";
        } else if ($aParam['orderby'] == "4") {
            $aParam['orderby'] = " ORDER BY `case_count` DESC ";
        } else {
            $aParam['orderby'] = "";
        }

        $aParam['c_agency_employer'] = "";
        if ($aParam ['display'] == 'with_cases') {
            $aParam['c_agency_employer'] = " AND (SELECT COUNT(1) FROM `icms_case_victim_employment` WHERE `employer_id` = `ie`.`employer_id`)";
        }

        if ($aParam['keyword'] !== "" || empty($aParam['keyword']) == false) {
            $aParam['sRelevance'] = "
                    , MATCH (`ie`.`employer_name`, `ie`.`employer_representative_name`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)  as relevance1 
             ";
            $aParam['cRelevance'] = "
                 AND (MATCH (`ie`.`employer_name`, `ie`.`employer_representative_name`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE))                
            ";
        }

        //list 
        $aResponse['content'] = $this->Employer_model->getListEmployer($aParam);

        foreach ($aResponse['content']['list'] as $key => $val) {
            $aResponse['content']['list'][$key]['employer_id'] = $this->yel->encrypt_param($val['employer_id']);
        }

        return $aResponse;
    }

    public function getEmployerDetailsByID($aParam) {
        $aResponse = [];
        $aParam['employer_id'] = $this->yel->decrypt_param($aParam['employer_id']);
        $aResponse['details'] = $this->Employer_model->getEmployerDetailsByID($aParam);
        $aResponse['result'] = "0";
        if (!empty($aResponse['details']) == true) {
            $aResponse['details']['employer_id'] = $this->yel->encrypt_param($aResponse['details']['employer_id']);
            $aResponse['result'] = "1";
        }
        return $aResponse;
    }

    public function setEmployerDetails($aParam) {
        $aResponse = [];
        $aParam['user_id'] = $this->yel->getUserIDByAccessKey($_SESSION['userData']['accessKey']);
        $aParam['employer_id'] = $this->yel->decrypt_param($aParam['employer_id']);
        $aResponse = $this->Employer_model->setEmployerDetails($aParam);
        return $aResponse;
    }

    public function getEmployerByKeyword($aParam) {
        $aResponse = [];
        $aResult = [];

        $aResponse['flag'] = self:: FAILED_RESPONSE;
        //list 
        $aResult['list'] = $this->Employer_model->getEmployerByKeyword($aParam);

        if (count($aResult['list']) > 0) {
            $aResponse['flag'] = self:: SUCCESS_RESPONSE;
            $aResponse['list'] = $aResult['list'];
            foreach ($aResponse['list'] as $key => $val) {
                $aResponse['list'][$key]['employer_id'] = $this->yel->encrypt_param($val['employer_id']);
            }
        }

        return $aResponse;
    }

}
