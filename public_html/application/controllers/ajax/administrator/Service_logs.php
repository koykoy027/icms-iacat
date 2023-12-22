<?php

/**
 * Agencies Internal Ajax
 * 
 * @module Ajax Loader
 * @author LBS eBusiness Solutions Corp. 
 * @since 2017
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_logs extends CI_Controller {

    const SUCCESS_RESPONSE = 1;
    const FAILED_RESPONSE = 0;

    public function __construct() {
        parent::__construct();

        // load models
        $this->load->model('administrator/Victim_services_model');
        $this->load->model('Global_data_model');
        $this->load->model('administrator/Service_log_model');
        
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

   public function getServicesLogs($aParam){
       $aResponse=[];
       $aResponse['result']=self::FAILED_RESPONSE;
       
       $aResponse['logs']=$this->Service_log_model->getServicesLogs($aParam);
       if(empty( $aResponse['logs'])==false){
           $aResponse['result']=self::SUCCESS_RESPONSE;
           foreach($aResponse['logs'] as $key=>$val){
               $aResponse['logs'][$key]['user']=$this->Service_log_model->getUserDetailsByUserId($val['case_vistim_services_history_added_by']);
           }
       }
       
       return $aResponse;
       
   }
    
}
