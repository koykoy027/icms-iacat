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

    public function getListGlobalData() {

        $aResponse = [];
        #Load Global Data
        $aResponse['global'] = $this->Settings_model->getListGlobalParamType();
        #Load Transaction 
        $aResponse['transaction'] = $this->Settings_model->getListTransactionParamType();
        #Load other 
        $aResponse['other'] = array(['parameter_title' => 'Occupation', 'parameter_description' => 'List of Occupation', 'type' => 'occupation']);

        return $aResponse;
    }

    public function getListOccupation() {
        $aResponse = [];

        $aResponse['list'] = $this->Settings_model->getListOccupation();

        return $aResponse;
    }

    public function getListGlobalParameterByID($aParam) {
        $aResponse = [];

        $aParam = $this->yel->clean_array($aParam);

        $aResponse['list'] = $this->Settings_model->getListGlobalParameterByID($aParam);
        $aResponse['detail'] = $this->Settings_model->getListGlobalParamTypeByID($aParam);

        return $aResponse;
    }

    public function getListTransactionParameterByID($aParam) {
        $aResponse = [];
        $aParam['sCondition'] = '';
        $aParam = $this->yel->clean_array($aParam);

        if (isset($aParam['transaction_parameter_status'])) {
            $aParam['sCondition'] = " AND `transaction_parameter_status` = '" . $aParam['transaction_parameter_status'] . "'";
        }

        $aResponse['list'] = $this->Settings_model->getListTransactionParameterByID($aParam);
        $aResponse['detail'] = $this->Settings_model->getListTransactionParamTypeByID($aParam);

        return $aResponse;
    }

    public function getListServicesTypeById($aParam) {
        $aResponse = [];

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
                    , MATCH (`service_name`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)  as relevance1 
             ";
            $aParam['cRelevance'] = "
                AND  (MATCH (`service_name`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE))                
            ";
        }

        //list 
        $aResponse['content'] = $this->Settings_model->getListServicesTypeById($aParam);

        return $aResponse;
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

        // Occupation 
        else if ($aParam['sType'] == '3') {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            if ($aParam['status'] == '1') {
                $aResponse['res'] = $this->Settings_model->addOccupation($aParam);
            }
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

        // Occupation 
        else if ($aParam['sType'] == '3') {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            $aResponse['res'] = $this->Settings_model->setOccupationStatus($aParam);
           
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
        
        // Occupation
        else if ($aParam['sType'] == '3') {
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
            $aParam['prev_name'] =  $this->Settings_model->getOccupationNameById($aParam); 
            // Change also the occupation name in case employer 
            $this->Settings_model->setOccupationNameInEmploymentDetails($aParam);
            $aResponse['res'] = $this->Settings_model->setOccupation($aParam);
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

    public function getListTIPCategory() {
        $aResponse = [];
        $aResponse['list'] = $this->Settings_model->getListTIPCategory();
        return $aResponse;
    }

    public function getListTIPCategoryByID($aParam) {
        $aResponse = [];

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
                    , MATCH (`tip_details_name`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)  as relevance1 
             ";
            $aParam['cRelevance'] = "
                AND  (MATCH (`tip_details_name`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE))                
            ";
        }

        //list 
        $aResponse['content'] = $this->Settings_model->getListTIPCategoryByID($aParam);

        return $aResponse;
    }

    public function addTIPDetails($aParam) {
        $aResponse = [];

        // clean parameter
        $aParam = $this->yel->clean_array($aParam);

        $aResponse['res'] = $this->Settings_model->addTIPDetails($aParam);

        return $aResponse;
    }

    public function setTIPDetailsPerCategoryId($aParam) {
        $aResponse = [];

        // clean parameter
        $aParam = $this->yel->clean_array($aParam);

        $aResponse['res'] = $this->Settings_model->setTIPDetailsPerCategoryId($aParam);

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
//        print_r($aParam); exit();
        $aResponse['res'] = $this->Settings_model->setServiceById($aParam);

        return $aResponse;
    }

}
