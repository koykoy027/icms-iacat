<?php

/**
 * Reports Internal Ajax
 * 
 * @module Ajax Loader
 * @author LBS eBusiness Solutions Corp. 
 * @since 2017
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Global_data extends CI_Controller {

    const SUCCESS_RESPONSE = 1;
    const FAILED_RESPONSE = 0;

    public function __construct() {
        parent::__construct();

        // load models
        $this->load->model('Global_data_model');
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
        $this->sessionPushLogout('');
    }

    public function getPermission() {
//        $_SESSION['userData']['is_super_admin'] = 0;
        return $_SESSION['userData'];
    }

    public function getUserRoles() {
        $aResponse = [];
        $aResponse = $this->Global_data_model->getUserRoles();
        return $aResponse;
    }

    public function getAgencyTypes($aParam) {
        $aResponse = [];
        $aResponse = $this->Global_data_model->getAgencyTypes($aParam);
        return $aResponse;
    }

    public function getCountries($aParam) {
        $aResponse = [];
        $aResponse = $this->Global_data_model->getCountries($aParam);
        return $aResponse;
    }

    public function getRegions($aParam) {
        $aResponse = [];
        $aResponse = $this->Global_data_model->getRegions($aParam);
        return $aResponse;
    }

    public function getStateByCountryID($aParam) {
        $aResponse = [];
        $aResponse = $this->Global_data_model->getStateByCountryID($aParam);
        return $aResponse;
    }

    public function getProvinces($aParam) {
        $aResponse = [];
        $aResponse = $this->Global_data_model->getProvinces($aParam);
        return $aResponse;
    }

    public function getProvinceByRegionID($aParam) {
        $aResponse = [];
        $aResponse = $this->Global_data_model->getProvinceByRegionID($aParam);
        return $aResponse;
    }

    public function getCityByProvinceID($aParam) {
        $aResponse = [];
        $aResponse = $this->Global_data_model->getCityByProvinceID($aParam);
   
        return $aResponse;
        
    }

    public function getBrgyByCityID($aParam) {
        $aResponse = [];
        $aResponse = $this->Global_data_model->getBrgyByCityID($aParam);
        return $aResponse;
    }

    public function getGovtAgencyAndType() {
        $aResponse = [];
        $aResponse = $this->Global_data_model->getGovtAgencyAndType();
        return $aResponse;
    }

    public function getUserLevel() {
        $aResponse = [];
        $aResponse = $this->Global_data_model->getUserLevel();
        return $aResponse;
    }

}
