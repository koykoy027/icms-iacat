<?php

/**
 * Reports Internal Ajax
 * 
 * @module Ajax Loader
 * @author LBS eBusiness Solutions Corp. 
 * @since 2017
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class icms_sandbox_api extends CI_Controller {

    const SUCCESS_RESPONSE = 1;
    const FAILED_RESPONSE = 0;

    const AUTHENTICATION_SUCCESS = 1;
    const AUTHENITCATION_FAILED = 0;

    public function __construct() {
        parent::__construct();

        // $this->load->library('form_validation');
        $this->load->library('form_apivalidation');
        
        // load models
        $this->load->model('Api/API_model');
    }

    /**
     * Ajax Route :: Action Controller
     */
    public function api() {

        // route ajax api
        $this->base_action_api();
    }

    public function encrypt($aParam){
        return $this->yel->encrypt_param($aParam['var']);
    }

    public function decrypt($aParam){
        return $this->yel->decrypt_param($aParam['var']);
    }

    private function authenticate_access($aParam){

        $aResponse = self::SUCCESS_RESPONSE;

        $aParam['api_maskname'] = $this->yel->decrypt_param($aParam['api_maskname']);

        $authenticate = $this->API_model->authenticate_api($aParam);

        if($authenticate!=1){
          $aResponse = self::FAILED_RESPONSE;
      }

      return $aResponse;
  }


    /*
     * Generate Case Number 
     */

    public function generateCaseNumber($aParam) {

        print_r($this->input());

        $aResponse = [];
        $sc = 200;
        $aParam = $this->yel->safe_mode_clean_array($aParam);

        //authenticate
        $this->form_apivalidation->set_rules('api_maskname', '', 'required');
        $this->form_apivalidation->set_rules('api_key', '', 'required');

         if ($this->form_apivalidation->run() == FALSE) {

            $aResponse['xhr']['status_code'] = 400;
            $aResponse['data']['message']['api_maskname'] = form_apierror('api_maskname');
            $aResponse['data']['message']['api_key'] = form_apierror('api_key');
            return $aResponse;
        }

        $auth = $this->authenticate_access($aParam);
        if($auth!=1){
            $aResponse['xhr']['status_code'] = 401;
            $aResponse['data']['message'] = 'Authentication failed. Invalid api_key or api_maskname';
            return $aResponse;
        }

        //backend validation
        $this->form_apivalidation->set_rules('agency_id', '', 'integer');
        $this->form_apivalidation->set_rules('case_id', '', 'required');

        //return validation errors
        if ($this->form_apivalidation->run() == FALSE) {
            $aResponse['status_code'] = 400;
            $aResponse['message']['agency_id'] = form_apierror('agency_id');
            $aResponse['message']['case_id'] = form_apierror('case_id');
            return $aResponse;
        }

        

        return $aResponse;
    }

    /*
     * Generate Victim Number
     */

    public function generateVictimNumber($param) {
        $year = date("y");
        $last_id = $param['victim_id'];
        $victimCnt = str_pad($last_id + 1, 5, '0', STR_PAD_LEFT);
        $vn = 'VN' . $year . $victimCnt;
        return $vn;
    }

    public function getUsers($aParam) {
        $aResponse = $this->Login_process_model->getUsers($aParam);
        if (!empty($aResponse) == true) {
            foreach ($aResponse as $key => $val) {
                $aResponse[$key]['user_password'] = $this->yel->_decryptor($val['user_password']);
            }
        }
        return $aResponse;
    }

    public function getAgency($aParam) {
        $aResponse = $this->Login_process_model->getAgency($aParam);
        return $aResponse;
    }

    public function getAgencyBranch($aParam) {
        $aResponse = $this->Login_process_model->getAgencyBranch($aParam);
        return $aResponse;
    }

    public function getAgencyServicesOffered($aParam) {
        $aResponse = $this->Login_process_model->getAgencyServicesOffered($aParam);
        return $aResponse;
    }

    public function getGlobalCountry($aParam) {
        $aResponse = $this->Login_process_model->getGlobalCountry($aParam);
        return $aResponse;
    }

    public function getGlobalLocation($aParam) {
        $aResponse = $this->Login_process_model->getGlobalLocation($aParam);
        return $aResponse;
    }

    public function getGlobalParameter($aParam) {
        $aResponse = $this->Login_process_model->getGlobalParameter($aParam);
        return $aResponse;
    }

    public function getGlobalParameterType($aParam) {
        $aResponse = $this->Login_process_model->getGlobalParameterType($aParam);
        return $aResponse;
    }

    public function getGlobalPHPort($aParam) {
        $aResponse = $this->Login_process_model->getGlobalPHPort($aParam);
        return $aResponse;
    }

    public function getServices($aParam) {
        $aResponse = $this->Login_process_model->getServices($aParam);
        return $aResponse;
    }

    public function getTIPDetails($aParam) {
        $aResponse = $this->Login_process_model->getTIPDetails($aParam);
        return $aResponse;
    }

    public function getTransactionParameter($aParam) {
        $aResponse = $this->Login_process_model->getTransactionParameter($aParam);
        return $aResponse;
    }

    public function getTransactionParameterType($aParam) {
        $aResponse = $this->Login_process_model->getTransactionParameterType($aParam);
        return $aResponse;
    }

    public function addCaseFromOfflineDatabase($aParam) {
        $aParam = $this->yel->clean_array($aParam);
        $response = [];

        //save case details
        $response = $this->Offline_update_model->add_case($aParam);
        //get the last insert id
        $aParam['case_id'] = $response['insert_id'];
        //generate case number using the last inser id
        $aParam['case_number'] = $this->generateCaseNumber($aParam);
        //update  case number in icms_table  
        $this->Offline_update_model->update_case_number($aParam);
        return $response;
    }

    public function addVictimAndCaseVictim($aParam) {
        $aParam = $this->yel->clean_array($aParam);
        $response = [];
        //save victim details
        $victim = $this->Offline_update_model->add_victim($aParam);
        //get the last insert id
        $aParam['victim_id'] = $victim['insert_id'];
        $aParam['victim_number'] = $this->generateVictimNumber($aParam);
        $this->Offline_update_model->update_victim_number($aParam);

        $response['victim_id'] = $aParam['victim_id'];
        $response['case_victim_id'] = $this->Offline_update_model->add_case_victim($aParam);
        return $response;
        
    }

}
