<?php

/**
 * Agencies Internal Ajax
 * 
 * @module Ajax Loader
 * @author LBS eBusiness Solutions Corp. 
 * @since 2017
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_settings extends CI_Controller {

    const SUCCESS_RESPONSE = 1;
    const FAILED_RESPONSE = 0;

    public function __construct() {
        parent::__construct();

        // load models
        $this->load->model('administrator/Account_settings_model');
        $this->load->model('Global_data_model');
    }

    /**
     * Ajax Route :: Action Controller
     */
    public function ajax() {

        // route ajax api
        $this->base_action_ajax();
    }

    private function validateSession() {
        $appAccess = $this->yel->getUserIDByAccessKey($_SESSION['userData']['accessKey']);
        if ($appAccess == "") {
            //will not be able to proceed
            exit();
        }
    }

    public function sessionDestruct() {
        // session destroy
        $this->sessionPushLogout('admininistrator');
    }

    public function addProfilePhoto($aParam) {
        $this->validateSession();
        $aParam['user_id'] = $this->yel->getUserIDByAccessKey($_SESSION['userData']['accessKey']);
        $pic = $this->Account_settings_model->addProfilePhoto($aParam);
        $_SESSION['userData']['profile_pic'] = $aParam['fileHash'];
        return $pic;
    }

    public function getProfilePhoto($aParam) {
        $this->validateSession();
        $aResponse = [];
        $aParam['user_id'] = $this->yel->getUserIDByAccessKey($_SESSION['userData']['accessKey']);
        $aResponse['profile'] = $this->Account_settings_model->getProfilePhoto($aParam);
        if (!empty($aResponse['profile']) == true) {
            $aResponse['result'] = "1";
        } else {
            $aResponse['result'] = "0";
        }
        return $aResponse;
    }

    public function setPhotoAsPrimary($aParam) {
        $this->validateSession();
        $aParam['user_id'] = $this->yel->getUserIDByAccessKey($_SESSION['userData']['accessKey']);
        $this->Account_settings_model->setPhotoAsPrimary($aParam);
        $pic = $this->Account_settings_model->getProfileHash($aParam);
        $_SESSION['userData']['profile_pic'] = $pic;
        return $pic;
    }

    public function removePicture($aParam) {
        $this->validateSession();
        $result = $this->Account_settings_model->removePicture($aParam);
        return $result;
    }

    public function getCaseCountPerUser($aParam) {
        $this->validateSession();
        $aParam['user_id'] = $this->yel->getUserIDByAccessKey($_SESSION['userData']['accessKey']);
        $result = $this->Account_settings_model->getCaseCountPerUser($aParam);
        return $result;
    }

    public function getUserActivityLogs($aParam) {
        $this->validateSession();
        
        $aLog = [];
        $aLog['user_id'] =  $this->yel->getUserIDByAccessKey($_SESSION['userData']['accessKey']);
        $aLog['log_panel'] = 1;
        $aLog['limit_start'] = $aParam['limit_start'];
        $aLog['limit_count'] = $aParam['limit_count'];
        $result = $this->audit->getActivityLogs($aLog);
        return $result;
    }

}
