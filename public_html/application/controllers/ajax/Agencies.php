<?php

/**
 * Agencies Internal Ajax
 * 
 * @module Ajax Loader
 * @author LBS eBusiness Solutions Corp. 
 * @since 2017
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Agencies extends CI_Controller {

    const SUCCESS_RESPONSE = 1;
    const FAILED_RESPONSE = 0;
    
   
    public function __construct() {
        parent::__construct();

        // load models
        $this->load->model('Agencies_model');
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
        $this->sessionPushLogout('admininistrator');
    }

    public function getAgencies($aParam) {
        
        $aResponse = []; 
        $aResult = []; 
        $aList = [];

        $aParam = $this->yel->pagination($aParam);

        // pagination
        $aResult['pagination'] = $aParam;

        $aResult['content'] = $this->Agencies_model->getAgencies($aParam);

        foreach ($aResult['content']['listing'] as $key => $val) {
            $aResult['content']['listing'][$key]['govt_agency_id'] = $this->yel->encrypt_param($val['govt_agency_id']);
        }

        $aResponse = $aResult; 

        return $aResponse;

    }

    public function addAgency($aParam) {
        $aParam['lastInsertId'] = $this->Agencies_model->addAgency($aParam);
        $this->Agencies_model->addAgencyContactAddress($aParam);
        $this->Agencies_model->addAgencyAddress($aParam);
        return $aParam['lastInsertId'];
    }

    public function setAgency($aParam) {
        $aResponse = [];
        $aParam['agency_id'] = $this->yel->decrypt_param($aParam['agency_id']);
        $aResponse['agency'] = $this->Agencies_model->setGovernmentAgency($aParam);
        $aResponse['agencyaddress'] = $this->Agencies_model->setGovernmentAgencyContactAddress($aParam);
        $aResponse['agencycontactaddress'] = $this->Agencies_model->setGovernmentAgencyAddress($aParam);
        return $aResponse;
    }

    public function getAgenciesByAgencyId($aParam) {

        $aParam['govt_agency_id'] = $this->yel->decrypt_param($aParam['agency_id']);
        $agencies = $this->Agencies_model->getAgenciesByAgencyId($aParam);
        $agencies['agency_address'] = $this->Agencies_model->getGovernmentAddressByID($aParam['govt_agency_id']);
        $agencies['agency_contact_address'] = $this->Agencies_model->getGovernmentContactAddressByID($aParam['govt_agency_id']);


        if (isset($agencies['agency_address']['country_id']) == true && $agencies['agency_address']['country_id'] == "173") {
            if (isset($agencies['agency_address']['province_id']) == true) {
                $agencies['agency_address']['province_name'] = $this->Global_data_model->getProvinceByID($agencies['agency_address']['province_id']);
            }
        } else {
            if (isset($agencies['agency_address']['province_id']) == true) {
                $agencies['agency_address']['province_name'] = $this->Global_data_model->getStateByID($agencies['agency_address']['province_id']);
            }
        }


        if (isset($agencies['agency_contact_address']['country_id']) == true && $agencies['agency_contact_address']['country_id'] == "173") {
            if (isset($agencies['agency_contact_address']['province_id']) == true) {
                $agencies['agency_contact_address']['province_name'] = $this->Global_data_model->getProvinceByID($agencies['agency_contact_address']['province_id']);
            }
        } else {
            if (isset($agencies['agency_contact_address']['province_id']) == true) {
                $agencies['agency_contact_address']['province_name'] = $this->Global_data_model->getStateByID($agencies['agency_contact_address']['province_id']);
            }
        }
        unset($agencies['govt_agency_id']);

        return $agencies;
    }

}
