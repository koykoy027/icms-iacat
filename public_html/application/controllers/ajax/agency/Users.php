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
        $this->load->model('agency/Users_model');
        $this->load->model('User_access_model');
        $this->load->model('Global_data_model');
        $this->load->model('agency/Agencies_model');
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

    public function getUsersInfobyID($aParam) {

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

    public function addNewAgencyUser($aParam) {

        $aResponse = [];
        $aResult['flag'] = self::FAILED_RESPONSE;
        $aParam = $this->yel->safe_mode_clean_array($aParam);
        $aParam['agencytype'] = $_SESSION['userData']['agency_id'];
        $aParam['agencyid'] = $_SESSION['userData']['agency_branch_id'];


        //validation rules
        $aRules = array(
            'fname' => 'required',
            'lname' => 'required',
            'sex' => 'required',
            'email' => 'required',
            'agencytype' => 'required',
            'agencyid' => 'required',
            'userlevel' => 'required',
            'area_desc' => 'required',
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

        $abbr = $this->Users_model->getAgencyAbbreviation($aParam);
        $usercount = $this->Users_model->getUserCount($aParam);
        $aParam['username'] = strtoupper($abbr) . sprintf("%03d", $usercount + 1) . strtoupper(substr($aParam['fname'], 0, 1)) . strtoupper(substr($aParam['lname'], 0, 1));
        $aParam['accessCode'] = $this->yel->generateAcessCode(6);

        //check email availability
        $availability = $this->Users_model->getUserEmailAvailability($aParam);
        if ($availability == "0") {

            $aParam['newuserid'] = $newUserId = $this->Users_model->addNewAgencyUser($aParam);

            /*
             * Insert User Address
             */
            //$aResponse['result'] = $this->Users_model->addUserAddress($aParam);

            $accessCode = $this->yel->encrypt_param($aParam['accessCode']);
            $userId = $this->yel->encrypt_param($aParam['newuserid']);
            $dateTime = $this->yel->encrypt_param(date("Y-m-d H:i:s"));
            $link = AGENCY_SITE_URL . "snuavve/" . $userId . "/" . $accessCode . "/" . $dateTime;
            // the param $link will serve as add password link
            $aEmail = [];
            $aEmail['data']['username'] = $aParam['username'];
            $aEmail['data']['recipient_name'] = $aParam['fname'];
            $aEmail['data']['link'] = $link;
            $aEmail['to'] = $aParam['email'];
            $aEmail['subject'] = 'Set Password';
            $aSendMail = $this->mailbox->sendEmailWithTemplate('new_user', $aEmail);

            //add user logs
            $aLog = [];
            $aLog['log_event_type'] = 12; // base on table : icms_user_event_type
            $aLog['log_message'] = "added " . $aParam['fname'] . " " . $aParam['lname'] . " as new user";
            $aLog['log_link'] = 'agency_branch/' . $this->yel->encrypt_param($aParam['agencyid']);
            $aLog['log_action'] = 1; // 1= new insert table 2=update table
            $aResponse['log'] = $this->audit->create($aLog);

            $aNotif = [];
            $aNotif['receiver'] = $_SESSION['userData']['user_id'];
            $aNotif['notif_type'] = "3";
            $aNotif['method'] = "users";
            $aNotif['tbl_id'] = $aParam['newuserid'];
            $aNotif['msg'] = "You have successfully created a new user account";
            $this->notif->create($aNotif);
        } else {
            $aResponse['result'] = "1";
            //unavailable email
        }
        return $aResponse;
    }

    public function getUserDetails($aParam) {
        $aParam['user_id'] = $this->yel->decrypt_param($aParam['user_id']);
        $aResult = $this->Users_model->getUserDetails($aParam);
        $aResult['address'] = $this->Users_model->getUserAddressUserID($aParam['user_id']);
        $aResult['user_date_added'] = date("F d, Y", strtotime($aResult['user_date_added']));
        unset($aResult['govt_agency_id'], $aResult['user_id'], $aResult['user_password']);
        return $aResult;
    }

    public function getEmailAvailability($aParam) {
        $aResult = $this->Users_model->getUserEmailAvailability($aParam);
        return $aResult;
    }

    public function setUserDetails($aParam) {

        $aResponse = [];
        $aResult['flag'] = self::FAILED_RESPONSE;
        $aParam = $this->yel->safe_mode_clean_array($aParam);

        //validation rules
        $aRules = array(
            'user_id' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'sex' => 'required',
            'userLevel' => 'required',
            'txt_email' => 'required',
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
        $aLog_info = [];
        $aLog_address = [];

        //decrypt id
        $aParam['user_id'] = $this->yel->decrypt_param($aParam['user_id']);
        //get old details before update
        $aLog_info['old_data'] = $this->Users_model->getUserDetails_logs($aParam);
        $aLog_address['old_data'] = $this->Users_model->getUserAddress_logs($aParam);
        //update details
        $userInfo = $this->Users_model->setUserDetails($aParam);
        if($aParam['user_stats'] == '1'){
            // reset login_attempt
            $this->User_access_model->resetLoginAttempt($aParam);
        }
        //get old details after update
        $aLog_info['new_data'] = $this->Users_model->getUserDetails_logs($aParam);
        $aLog_address['new_data'] = $this->Users_model->getUserAddress_logs($aParam);

        //saving logs for user details
        $result = "0";
        if ($userInfo['stat'] == "1") {
            $result = "1";
            $aLog_info['log_event_type'] = 15; // base on table : icms_user_event_type
            if ($aParam['user_id'] == $_SESSION['userData']['user_id']) {
                $aLog_info['log_message'] = "changed own account details";
            } else {
                $user_details = $this->Users_model->getUserDetails($aParam);
                $aParam['agency_id'] = $user_details['agency_branch_id'];
                $agency_details = $this->Agencies_model->getAgencyInformationbyId($aParam);
                $aLog_info['log_message'] = "changed " . $agency_details['agency_abbr'] . " - " . $agency_details['agency_branch_name'] . " user account details";
            }
            $aLog_info['log_link'] = 'users/' . $this->yel->encrypt_param($aParam['user_id']);
            $aLog_info['log_action'] = 2; // 1= new insert table 2=update table
            $aLog_info['new_data'] = $this->yel->encrypt_param(json_encode($aLog_info['new_data']));
            $aLog_info['old_data'] = $this->yel->encrypt_param(json_encode($aLog_info['old_data']));
            $aResponse['log'] = $this->audit->create($aLog_info);
        }
        $aResponse['result'] = $result;
        return $aResponse;
    }

    public function changePassword($aParam) {
        $aResponse = [];
        $aResult['flag'] = self::FAILED_RESPONSE;
        $aParam = $this->yel->safe_mode_clean_array($aParam);

        //validation rules
        $aRules = array(
            'user_id' => 'required', 
            'password' => 'required',
        );

        /**
         * Parameter Validation
         */
        $aAssert = $this->assert->formValidate($aParam, $aRules);

        $aResponse['php_validation'] = $aAssert;
        if ($aAssert['flag'] != self::ACTIVE_STATUS) {
            return $aResponse;
        }
        
        //decrypt id
        $aParam['user_id'] = $this->yel->decrypt_param($aParam['user_id']);
        
        $this->Users_model->changePassword($aParam);
        
        $aResponse['flag'] = self::ACTIVE_STATUS;
        return $aResponse;
    }

}
