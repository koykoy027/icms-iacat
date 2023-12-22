<?php

/**
 * Users Internal Ajax
 * 
 * @module Ajax Loader
 * @author LBS eBusiness Solutions Corp. 
 * @since 2017
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    const SUCCESS_RESPONSE = 1;
    const FAILED_RESPONSE = 0;

    public function __construct() {
        parent::__construct();

        // load models
        $this->load->model('Users_model');
        $this->load->model('Global_data_model');
        $this->load->model('Agencies_model');
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

    public function getAllUsers() {

        $aResult['session'] = $_SESSION['userData']; 

        $aReponse = [];
        $aList = $this->Users_model->getAllUsers();

        foreach ($aList as $key => $val) {
            $aList[$key]['user_id'] = $this->yel->encrypt_param($val['user_id']);
        }



        foreach ($aList as $key => $value) {
            $useraddress = $this->Users_model->getUserAddressUserID($value['user_id']);
            $aList[$key]['userAddress'] = [];
            if (isset($useraddress['country_id']) == true) {
                if ($useraddress['country_id'] == "173") {
                    $aList[$key]['userAddress']['country'] = $useraddress['country_name'];
                    $aList[$key]['userAddress']['province'] = $this->Global_data_model->getProvinceByID($useraddress['province_id']);
                    $aList[$key]['userAddress']['region'] = $useraddress['region_name'];
                    $aList[$key]['userAddress']['city'] = $useraddress['city_name'];
                    $aList[$key]['userAddress']['brgy'] = $useraddress['brgy_name'];
                    $aList[$key]['userAddress']['address'] = $useraddress['address'];
                } else {
                    $aList[$key]['userAddress']['country'] = $useraddress['country_name'];
                    $aList[$key]['userAddress']['province'] = $this->Global_data_model->getStateByID($useraddress['province_id']);
                    $aList[$key]['userAddress']['region'] = $useraddress['region_name'];
                    $aList[$key]['userAddress']['city'] = $useraddress['city_name'];
                    $aList[$key]['userAddress']['brgy'] = $useraddress['brgy_name'];
                    $aList[$key]['userAddress']['address'] = $useraddress['address'];
                }
            }


            $agencyAddress = $this->Users_model->getAgencyAddressAgencyID($value['govt_agency_id']);
            $aList[$key]['agencyAddress'] = [];
            if (isset($agencyAddress['country_id']) == true) {
                if ($agencyAddress['country_id'] == "173") {
                    $aList[$key]['agencyAddress']['province'] = $this->Global_data_model->getProvinceByID($agencyAddress['province_id']);
                    $aList[$key]['agencyAddress']['country'] = $agencyAddress['country_name'];
                    $aList[$key]['agencyAddress']['region'] = $agencyAddress['region_name'];
                    $aList[$key]['agencyAddress']['city'] = $agencyAddress['city_name'];
                    $aList[$key]['agencyAddress']['brgy'] = $agencyAddress['brgy_name'];
                    $aList[$key]['agencyAddress']['address'] = $agencyAddress['address'];
                } else {
                    $aList[$key]['agencyAddress']['province'] = $this->Global_data_model->getStateByID($agencyAddress['province_id']);
                    $aList[$key]['agencyAddress']['country'] = $agencyAddress['country_name'];
                    $aList[$key]['agencyAddress']['region'] = $agencyAddress['region_name'];
                    $aList[$key]['agencyAddress']['city'] = $agencyAddress['city_name'];
                    $aList[$key]['agencyAddress']['brgy'] = $agencyAddress['brgy_name'];
                    $aList[$key]['agencyAddress']['address'] = $agencyAddress['address'];
                }
            }
        }
        return $aList;
    }

    public function getAgencyListForDropDown($aParam) {
        $aAgencies = $this->Agencies_model->getAgencies($aParam);
        $aResponse = [];
        foreach ($aAgencies as $key => $val) {
            $aAgenciesaddress = $this->Agencies_model->getGovernmentAddressByID($val['govt_agency_id']);
            $aResponse[$key]['agency_name'] = $val['govt_agency_type_name'];
            $aResponse[$key]['branch'] = "";
            $aResponse[$key]['branch_id'] = $val['govt_agency_id'];
            if (isset($aAgenciesaddress['country_id']) == true && $aAgenciesaddress['country_id'] == "173") {
                if (isset($aAgenciesaddress['province_id']) == true) {
                    $prov = $this->Global_data_model->getProvinceByID($aAgenciesaddress['province_id']);
                    if (!empty($prov) == TRUE) {
                        $aResponse[$key]['branch'] = " : " . $prov;
                    }
                }
            } else {
                if (isset($aAgenciesaddress['province_id']) == true) {
                    $prov = $this->Global_data_model->getStateByID($aAgenciesaddress['province_id']);
                    if (!empty($prov) == TRUE) {
                        $aResponse[$key]['branch'] = " : " . $prov;
                    }
                }
            }
        }
        return $aResponse;
    }

    public function validateUsername($aParam) {
        $response = [];
        $response['userCount'] = $this->Users_model->validateUsername($aParam);

        if ($response['userCount'] >= 1) {
            $response['result'] = 1;
        } else {
            $response['result'] = 0;
        }
        return $response;
    }

    public function addUsers($aParam) {

        $aResponse = [];

        $aResponse['flag'] = self::FAILED_RESPONSE;

        $aParam = $this->yel->clean_array($aParam);

        if (!empty($aParam) !== false) {

            //Insert Users 
            $aParam['newUserID'] = $this->Users_model->addUsers($aParam);

            //Insert Address 
            $addUserAddres = $this->Users_model->addUserAddress($aParam);

            $roles = explode(",", $aParam['user_role']);
            // Insert role 
            foreach ($roles as $key => $val) {
                $aParamRole['userRoleId'] = $val;
                $aParamRole['newUserID'] = $aParam['newUserID'];
                $addUserUserRole = $this->Users_model->addUserUserRole($aParamRole);
            }

            $aResponse['flag'] = self::SUCCESS_RESPONSE;
        }

        return $aResponse;
    }


    public function getUsersInfobyID($aParam){

       $aResponse = []; 

       $aResponse['flag'] = self::FAILED_RESPONSE;

       if (!empty($aParam) !== false) {
            
            $aParam['user_id'] = $this->yel->decrypt_param($aParam['user_id']);
            $aResult['detail'] = $this->Users_model->getUsersInfobyID($aParam);
            $aResult['address'] = $this->Users_model->getUserAddressUserID($aParam['user_id']);
            if (!empty($aResult['response']) !== false) {
                $aResponse['detail'] = $aResult['detail']; 

                $aResponse['flag'] = self::SUCCESS_RESPONSE;
            }
           
       }

       return $aResult; 
    }
}
