<?php

/**
 * Reports Internal Ajax
 * 
 * @module Ajax Loader
 * @author LBS eBusiness Solutions Corp. 
 * @since 2017
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    const SUCCESS_RESPONSE = 1;
    const FAILED_RESPONSE = 0;

    public function __construct() {
        parent::__construct();

        // load models
        $this->load->model('administrator/Settings_model');
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

    public function getPermission() {
        return $_SESSION['userData'];
    }


    public function setGlobalDetails($aParam) {
        $aResponse = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;

        $aParam = $this->yel->clean_array($aParam);

        // Transaction Parameter 
        if ($aParam['sType'] == '1') {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            $aResponse['res'] = $this->Settings_model->setTransactionParameterTypebyId($aParam);
        }
        // Global  Parameter 
        else if ($aParam['sType'] == '2') {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            $aResponse['res'] = $this->Settings_model->setGlobalParameterTypebyId($aParam);
        }

        return $aResponse;
    }

    public function addGlobalData($aParam) {
        $aResponse = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;

        $aParam = $this->yel->clean_array($aParam);

        // Transaction Parameter 
        if ($aParam['sType'] == '1') {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            $aResponse['res'] = $this->Settings_model->addTransasctionParamaterData($aParam);
        }
        // Global  Parameter 
        else if ($aParam['sType'] == '2') {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            $aResponse['res'] = $this->Settings_model->addGlobalParamaterData($aParam);
        }

        return $aResponse;
    }

    public function setGlobalDataStatus($aParam) {

        $aResponse = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;

        $aParam = $this->yel->clean_array($aParam);

        // Transaction Parameter 
        if ($aParam['sType'] == '1') {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            $aResponse['res'] = $this->Settings_model->setTransasctionParamaterStatus($aParam);
        }
        // Global  Parameter 
        else if ($aParam['sType'] == '2') {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            $aResponse['res'] = $this->Settings_model->setGlobalParamaterStatus($aParam);
        }

        return $aResponse;
    }

    public function setGlobalData($aParam) {
        $aResponse = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;

        $aParam = $this->yel->clean_array($aParam);

        // Transaction Parameter 
        if ($aParam['sType'] == '1') {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            $aResponse['res'] = $this->Settings_model->setTransasctionParamaterData($aParam);
        }
        // Global  Parameter 
        else if ($aParam['sType'] == '2') {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            $aResponse['res'] = $this->Settings_model->setGlobalParamaterData($aParam);
        }

        return $aResponse;
    }

    public function getPhPort($aParam) {

        $aResponse = [];
        $aParam['sRelevance'] = "";
        $aParam['cRelevance'] = "";

        // clean parameter
        $aParam = $this->yel->clean_array($aParam);

        // include pagination parameter 
        $aParam = $this->yel->pagination($aParam);

        // pagination
        $aParam['pagination'] = $aParam;

        if ($aParam['keyword'] !== "" || empty($aParam['keyword']) == false) {
            $aParam['sRelevance'] = "
                    , MATCH (`gpp`.`port_name`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)  as relevance1 
             ";
            $aParam['cRelevance'] = "
                 AND (MATCH (`gpp`.`port_name`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE))                
            ";
        }

        //list 
        $aResponse['content'] = $this->Settings_model->getPhPort($aParam);

        return $aResponse;
    }

    public function addPhPort($aParam) {

        $aResponse = [];

        $aParam = $this->yel->clean_array($aParam);

        $aResponse = $this->Settings_model->addPort($aParam);

        return $aResponse;
    }

    public function setPhPort($aParam) {

        $aResponse = [];


        $aParam = $this->yel->clean_array($aParam);

        $aResponse = $this->Settings_model->setPort($aParam);

        return $aResponse;
    }

    public function getDictionary($aParam) {

        $aResponse = [];
        $aParam['sRelevance'] = "";
        $aParam['cRelevance'] = "";

        // clean parameter
        $aParam = $this->yel->clean_array($aParam);

        // include pagination parameter 
        $aParam = $this->yel->pagination($aParam);

        // pagination
        $aParam['pagination'] = $aParam;

        if ($aParam['keyword'] !== "" || empty($aParam['keyword']) == false) {
            $aParam['sRelevance'] = "
                    , MATCH (`dictionary_name`,`dictionary_description`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)  as relevance1 
             ";
            $aParam['cRelevance'] = "
                WHERE (MATCH (`dictionary_name`,`dictionary_description`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE))                
            ";
        }

        //list 
        $aResponse['content'] = $this->Settings_model->getDataDictionary($aParam);

        return $aResponse;
    }

    public function addDictionary($aParam) {

        $aResponse = [];

        $aParam = $this->yel->clean_array($aParam);

        $aResponse = $this->Settings_model->addDictionary($aParam);

        return $aResponse;
    }

    public function setDictionary($aParam) {

        $aResponse = [];

        $aParam = $this->yel->clean_array($aParam);

        $aResponse = $this->Settings_model->setDictionary($aParam);

        return $aResponse;
    }


    public function addTIPDetails($aParam) {
        $aResponse = [];

        // clean parameter
        $aParam = $this->yel->clean_array($aParam);

        $aResponse['res'] = $this->Settings_model->addTIPDetails($aParam);

        return $aResponse;
    }


    public function addService($aParam) {
        $aResponse = [];

        // clean parameter
        $aParam = $this->yel->clean_array($aParam);

        $aResponse['res'] = $this->Settings_model->addService($aParam);

        return $aResponse;
    }

    public function setServiceById($aParam) {
        $aResponse = [];

        // clean parameter
        $aParam = $this->yel->clean_array($aParam);
        $aResponse['res'] = $this->Settings_model->setServiceById($aParam);

        return $aResponse;
    }

}
