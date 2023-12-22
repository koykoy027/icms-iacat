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
        $this->load->model('administrator/Agencies_model');
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

    public function getAgenciesBranchList($aParam) {

        $aResponse = [];
        $aResult = [];
        $aList = [];
        $aParam['sRelevance'] = "";
        $aParam['cRelevance'] = "";
        $aParam['cOrderBy'] = "";
        $aResult['cOderByRelevance'] = "";
        $aParam['countCondition'] = "";

        $aResponse['flag'] = self:: FAILED_RESPONSE;
        $aParam = $this->yel->pagination($aParam);

        // pagination
        $aResult['pagination'] = $aParam;

        // set filter where clause
        if ($aParam['keyword'] !== "" || empty($aParam['keyword']) == false) {
            $aParam['sRelevance'] = "
                    , MATCH (`a`.`agency_branch_name`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)  as relevance1
                    , MATCH (`at`.`agency_name`, `at`.`agency_abbr`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)  as relevance2 
             ";
            $aParam['cRelevance'] = "
                AND ( (MATCH (`a`.`agency_branch_name`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)) OR (MATCH (`at`.`agency_name`, `at`.`agency_abbr`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)))                 
            ";
        }

        // Order by 
        $aParam['cOrderBy'] = ' ORDER BY ' . $aResult['cOderByRelevance'] . ' `a`.`agency_branch_name` ASC';
        if ($aParam['orderby'] == '2') {
            $aParam['cOrderBy'] = ' ORDER BY ' . $aResult['cOderByRelevance'] . '  `a`.`agency_branch_name` DESC';
        }

        // Condition for Status 
        if ($aParam['aStatus'] !== "" || empty($aParam['aStatus']) == false) {
            $aParam['cRelevance'] .= ' AND `a`.`agency_is_active` IN(' . $aParam['aStatus'] . ')';
        }

        // Condition for Main Branch 
        if ($aParam['isMain'] !== "" || empty($aParam['isMain']) == false) {
            $aParam['cRelevance'] .= ' AND `a`.`agency_branch_is_main` = ' . $aParam['isMain'] . ' ';
        }

        //Condition for Category
//        if ($aParam['aAgency'] !== "" || empty($aParam['aAgency']) == false) {
//            $aParam['cRelevance'] .= ' AND `a`.`agency_id` IN(' . $aParam['aAgency'] . ')';
//        }

        $aResult['content'] = $this->Agencies_model->getAgencies($aParam);


        // Unset Result pagination and relevanceco ndtion
        unset($aResult['cOderByRelevance'], $aResult['pagination']);

        if (($aResult['content']['count']) > 0) {
            foreach ($aResult['content']['listing'] as $key => $val) {
                $aResult['content']['listing'][$key]['address'] = $this->Agencies_model->getGovernmentAddressByID($val['agency_branch_id']);
                $aParam['agency_id'] = $val['agency_branch_id'];
                //$aResult['content']['listing'][$key]['agency_contact_person'] = $this->Agencies_model->getGovernmentContactPersonbyAgencyID($aParam);

                $aResult['content']['listing'][$key]['agency_branch_id'] = $this->yel->encrypt_param($val['agency_branch_id']);
            }
            $aResponse = $aResult;
            $aResponse['flag'] = self:: SUCCESS_RESPONSE;
        }

        return $aResponse;
    }

    public function getAgencyList($aParam) {

        $aResponse = [];
        $aResult = [];
        $aResult['cOderByRelevance'] = "";
        $aParam['sRelevance'] = "";
        $aParam['cRelevance'] = "";
        $aParam['cOrderBy'] = "";
        $aParam['countCondition'] = "";
        $aParam['countConditionStatus'] = "";
        $aParam['countConditionCategory'] = "";

        $aParam = $this->yel->clean_array($aParam);
        $aParam = $this->yel->pagination($aParam);

        $aResponse['flag'] = self:: FAILED_RESPONSE;
        // pagination
        $aResult['pagination'] = $aParam;

        // Condition for keyword
        if ($aParam['keyword'] !== "" || empty($aParam['keyword']) == false) {
            $aParam['sRelevance'] = ", MATCH (`igat`.`agency_name`, `igat`.`agency_abbr`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)  as all_relevance";
            $aParam['cRelevance'] = " AND ( MATCH (`igat`.`agency_name`, `igat`.`agency_abbr`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE) ) ";
            $aResult['cOderByRelevance'] = ' all_relevance ,';
        }

        // Condition for Status 
        if ($aParam['aStatus'] !== "" || empty($aParam['aStatus']) == false) {
            $aParam['cRelevance'] .= ' AND `igat`.`agency_is_active` IN(' . $aParam['aStatus'] . ')';
        }

        //Condition for Category
        if ($aParam['aCategory'] !== "" || empty($aParam['aCategory']) == false) {
            $aParam['cRelevance'] .= ' AND `igat`.`agency_category_id` IN(' . $aParam['aCategory'] . ')';
        }


        // Order by 
        $aParam['cOrderBy'] = ' ORDER BY ' . $aResult['cOderByRelevance'] . ' `igat`.`agency_name` ASC';
        if ($aParam['orderby'] == '2') {
            $aParam['cOrderBy'] = ' ORDER BY ' . $aResult['cOderByRelevance'] . '  `igat`.`agency_name` DESC';
        }

        $aResult['content'] = $this->Agencies_model->getAgencyTypeList($aParam);

        // Unset Result pagination and relevanceco ndtion
        unset($aResult['cOderByRelevance'], $aResult['pagination']);

        if (($aResult['content']['count']) > 0) {
            foreach ($aResult['content']['listing'] as $key => $val) {
                $aResult['content']['listing'][$key]['agency_id'] = $this->yel->encrypt_param($val['agency_id']);
            }
            $aResponse = $aResult;
            $aResponse['flag'] = self:: SUCCESS_RESPONSE;
        }

        return $aResponse;
    }

    public function getAgencyTypes($aParam) {
        $aResult = $this->Agencies_model->getAgencyTypes($aParam);
        return $aResult;
    }

    public function addAgencyType($aParam) {
        $aResponse = [];

        $aResult['flag'] = self::FAILED_RESPONSE;
        $aParam = $this->yel->safe_mode_clean_array($aParam);

        //validation rules
        $aRules = array(
            'hash' => 'required',
            'agencyname' => 'required',
            'abbr' => 'required',
            'category' => 'required',
            'description' => 'required',
        );

        /**
         * Parameter Validation
         */
        $aAssert = $this->assert->formValidate($aParam, $aRules);

        $aResponse['php_validation'] = $aAssert;
        if ($aAssert['flag'] != self::ACTIVE_STATUS) {
            return $aResponse;
        }


        $aParam['userid'] = $this->Agencies_model->addAgencyType($aParam);
        //user log
        $aLog = [];
        $aLog['log_event_type'] = 4; // base on table : icms_user_event_type
        $aLog['log_message'] = "added new agency " . $aParam['agencyname'] . " (" . $aParam['abbr'] . ")";
        $aLog['log_link'] = 'agencies/' . $this->yel->encrypt_param($aParam['userid']);
        $aLog['log_action'] = 1; // 1= new inserted // 2=update table
        $aResponse['log'] = $this->audit->create($aLog);



        $agencyLogo = $this->Agencies_model->addAgencyTypeLogo($aParam);
        $aResult['flag'] = 1;
        $aResponse['result'] = $agencyLogo;

        return $aResponse;
    }

    public function addAgencyTypeLogo($aParam) {
        $aParam['userid'] = $this->yel->decrypt_param($aParam['id']);
        $agencyLogo = $this->Agencies_model->addAgencyTypeLogo($aParam);
        return $agencyLogo;
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

    public function validateAgencyAddress($aParam) {

        if (empty($aParam['agnregion']) == true) {
            $aParam['agnregion'] = '0';
        }
        if (empty($aParam['agncity']) == true) {
            $aParam['agncity'] = '0';
        }
        if (empty($aParam['agnbrgy']) == true) {
            $aParam['agnbrgy'] = '0';
        }
        if (empty($aParam['agnregioncon']) == true) {
            $aParam['agnregioncon'] = '0';
        }
        if (empty($aParam['agncitycon']) == true) {
            $aParam['agncitycon'] = '0';
        }
        if (empty($aParam['agnbrgycon']) == true) {
            $aParam['agnbrgycon'] = '0';
        }
        if (empty($aParam['is_primary']) == true) {
            $aParam['is_primary'] = '0';
        }

        return $aParam;
    }

    public function addAgencyBranch($aParam) {
        $aResponse = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;

        $Aagnconperson = $aParam['agnconperson'];
        $aParam = $this->yel->clean_array($aParam);
        $aParam['services'] = explode(",", $aParam['services']);

        $isBranchAdmitExist = $this->Agencies_model->getAgencyBranchAdminIfExist($aParam);

        if ($isBranchAdmitExist >= 1) {
            $aParam['isbranchadmin'] = "0";
        } else {
            $aParam['isbranchadmin'] = "1";
        }

        $aParam = $this->validateAgencyAddress($aParam);

        $aParam['agency_id'] = $this->Agencies_model->addAgencyBranch_govt_agency($aParam);

        //user log
        $aLog = [];
        $aLog['log_event_type'] = 5; // base on table : icms_user_event_type
        $aLog['log_message'] = "added new agency branch  " . $aParam['agntypename'] . " - " . $aParam['branchname'];
        $aLog['log_link'] = 'agency_branch/' . $this->yel->encrypt_param($aParam['agency_id']);
        $aLog['log_action'] = 1; // 1= new inserted // 2=update table
        $aResponse['log'] = $this->audit->create($aLog);



        if (!empty($aParam['agency_id']) !== false) {
            $aResponse['agnAddress'] = $this->Agencies_model->addAgencyBranch_address($aParam);
            $aParam['agnconperson'] = (json_decode($Aagnconperson, true));

            foreach ($aParam['agnconperson'] as $key => $value) {
                $govt_agency_contact_id = '';

                if (empty($aParam['agnconperson'][$key]['region']) == true) {
                    $aParam['agnconperson'][$key]['region'] = '0';
                }
                if (empty($aParam['agnconperson'][$key]['pro_state']) == true) {
                    $aParam['agnconperson'][$key]['pro_state'] = '0';
                }
                if (empty($aParam['agnconperson'][$key]['city']) == true) {
                    $aParam['agnconperson'][$key]['city'] = '0';
                }
                if (empty($aParam['agnconperson'][$key]['brgy']) == true) {
                    $aParam['agnconperson'][$key]['brgy'] = '0';
                }
                $aParam['agnconperson'][$key]['agency_id'] = $aParam['agency_id'];
                $govt_agency_contact_id = $this->Agencies_model->addAgencyBranch_govt_contact($aParam['agnconperson'][$key]);
                $aParam['agnconperson'][$key]['agency_contact_id'] = $govt_agency_contact_id;
                $this->Agencies_model->addAgencyBranch_contactaddress($aParam['agnconperson'][$key]);
            }

            foreach ($aParam['services'] as $key => $value) {
                $aService = [];
                $aService['service_id'] = $value;
                $aService['agency_id'] = $aParam['agency_id'];
                $this->Agencies_model->addAgencyServicesOffered($aService);
            }

            $aResponse['flag'] = self::SUCCESS_RESPONSE;
        }

        return $aResponse;
    }

    public function getAgencyBranchByAgencyTypeID($aParam) {
        $aResponse = [];
        $aResponse['result'] = "0";
        $aResponse['branches'] = $this->Global_data_model->getAgencyBranchByAgencyTypeID($aParam);
        if (count($aResponse['branches']) >= 1) {
            $aResponse['result'] = "1";
        }
        return $aResponse;
    }

    public function getUserLevelWithCondition($aParam) {
        $aParam['cond'] = " `transaction_parameter_type_id`='5' AND `transaction_parameter_status`='1'";     
        $aResponse = $this->Agencies_model->getUserLevel($aParam);
        return $aResponse;
    }

    public function getAgencyInformationbyId($aParam) {
        $aResponse = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;

        if (isset($aParam['agency_id']) == true) {

            $aParam['agency_id'] = $this->yel->decrypt_param($aParam['agency_id']);
            $aResponse = $this->Agencies_model->getAgencyInformationbyId($aParam);
            $aResponse['govt_agency_address'] = $this->Agencies_model->getGovernmentAddressByID($aParam['agency_id']);
            $aResponse['contact_details_result'] = "1";
            $aResponse['contact_details'] = $this->Agencies_model->getGovernmentContactPersonbyAgencyID($aParam);
            if (empty($aResponse['contact_details']) == true) {
                $aResponse['contact_details_result'] = "0";
            }
            $aResponse['govt_agency_id'] = $aParam['agency_id'];

            $aResponse['flag'] = self::SUCCESS_RESPONSE;
        }

        return $aResponse;
    }

    public function setAgencyType($aParam) {
        $aResponse = [];
        $aResult = [];

        $aResult['flag'] = self::FAILED_RESPONSE;
        $aParam = $this->yel->safe_mode_clean_array($aParam);

        //validation rules
        $aRules = array(
            'id' => 'required',
            'agencyname' => 'required',
            'abbr' => 'required',
            'category' => 'required',
            'description' => 'required',
//            'status' => 'required',
        );

        /**
         * Parameter Validation
         */
        $aAssert = $this->assert->formValidate($aParam, $aRules);

        $aResponse['php_validation'] = $aAssert;
        if ($aAssert['flag'] != self::ACTIVE_STATUS) {
            return $aResponse;
        }



        $aParam['id'] = $this->yel->decrypt_param($aParam['id']);
        $aLog = [];
        //get original data for logs
        $aLog['old_data'] = $this->Agencies_model->getAgencyTypeById($aParam);
        //update data
        $aResult['res'] = $this->Agencies_model->setAgencyType($aParam);
        //get the new data for logs after update
        $aLog['new_data'] = $this->Agencies_model->getAgencyTypeById($aParam);

        if ($aParam['curStatus'] != $aParam['status']) {
            //set deactivate branches and its users
            //get all branches
            $branches_id = $this->Agencies_model->getAgencyBranchIdByAgency($aParam);
            $id = array();
            foreach ($branches_id as $key => $val) {
                array_push($id, $val['agency_branch_id']);
            }
            $aParam['filterid'] = implode(',', $id);
            if (!empty($aParam['filterid']) == true) {
                $this->Agencies_model->setAllAgencyBranchAndAllUsersByBranchId($aParam);
            }
        }

        $aLog['log_event_type'] = 3; // base on table : icms_user_event_type
        $aLog['log_message'] = "update agency details on " . date("Y-m-d H:i:s");
        $aLog['log_link'] = 'agencies/' . $this->yel->encrypt_param($aParam['id']);
        $aLog['log_action'] = 2; // 1= new insert table 2=update table


        $aLog['old_data']['agency_category_id'] == 2 ? $aLog['old_data']['agency_category'] = "Non-Government" : $aLog['old_data']['agency_category'] = "Government";
        $aLog['new_data']['agency_category_id'] == 2 ? $aLog['new_data']['agency_category'] = "Non-Government" : $aLog['new_data']['agency_category'] = "Government";
        $aLog['old_data']['agency_is_active'] == 1 ? $aLog['old_data']['status'] = "Active" : $aLog['old_data']['status'] = "Inactive";
        $aLog['new_data']['agency_is_active'] == 1 ? $aLog['new_data']['status'] = "Active" : $aLog['new_data']['status'] = "Inactive";

        unset($aLog['old_data']['agency_is_admin']);
        unset($aLog['new_data']['agency_is_admin']);
        unset($aLog['old_data']['agency_is_active']);
        unset($aLog['new_data']['agency_is_active']);
        unset($aLog['old_data']['agency_category_id']);
        unset($aLog['new_data']['agency_category_id']);

        $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
        $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
        $aResponse['log'] = $this->audit->create($aLog);

        if ($aResult['res']['stat'] != '0') {
            $aResult['flag'] = self::SUCCESS_RESPONSE;
        }

        $aResponse['result'] = $aResult;

        return $aResponse;
    }

    public function setAgencyBranchStatusAndItsUsers($aParam) {
        $aResponse = [];

        $aResult['flag'] = self::FAILED_RESPONSE;
        $aParam = $this->yel->safe_mode_clean_array($aParam);

        //validation rules
        $aRules = array(
            'aid' => 'required'
        );

        /**
         * Parameter Validation
         */
        $aAssert = $this->assert->formValidate($aParam, $aRules);

        $aResponse['php_validation'] = $aAssert;
        if ($aAssert['flag'] != self::ACTIVE_STATUS) {
            return $aResponse;
        }

        $aParam['agency_id'] = $this->yel->decrypt_param($aParam['aid']);
        $aResult = $this->Agencies_model->setAgencyBranchStatusAndItsUsers($aParam);
        if ($aResult['usr'] == "1" || $aResult['brn'] == "1") {
            $aResponse['result'] = '1';
            $aResult['flag'] = self::ACTIVE_STATUS;
        } else {
            $aResponse['result'] = '0';
        }

        return $aResponse;
    }

    public function getServices() {
        $aResponse = [];
        $aResult = [];

        $aResponse['flag'] = self:: FAILED_RESPONSE;

        $aResult['list'] = $this->Global_data_model->getServices();

        if (!empty($aResult['list']) !== false) {
            $aResponse['list'] = $aResult['list'];
            $aResponse['type_name'] = array_unique(array_column($aResult['list'], 'service_type_name'));
            $aResponse['flag'] = self:: SUCCESS_RESPONSE;
        }

        return $aResponse;
    }

    public function getAgencyContactByAgencyBranchID($aParam) {
        $aResponse = [];
        $agencyid = $this->yel->decrypt_param($aParam['agency_id']);
        $aResponse['list'] = $this->Agencies_model->getAgencyContactByAgencyBranchID($agencyid);
        $aResponse['result'] = 0;
        foreach ($aResponse['list'] as $key => $val) {
            $aResponse['result'] = 1;
            $aResponse['list'][$key]['address'] = $this->Agencies_model->getGovernmentContactAddressByID($val['agency_contact_id']);
            $aResponse['list'][$key]['agency_branch_id'] = $this->yel->encrypt_param($val['agency_branch_id']);
            $aResponse['list'][$key]['agency_contact_id'] = $this->yel->encrypt_param($val['agency_contact_id']);
        }
        return $aResponse;
    }

    public function setAgencyAddress($aParam) {

        $aResult['flag'] = self::FAILED_RESPONSE;
        $aParam = $this->yel->safe_mode_clean_array($aParam);

        //validation rules
        $aRules = array(
            'country' => 'required',
            'detailed' => 'required',
            'prov' => 'required',
        );


        $aResponse['result'] = self::FAILED_RESPONSE;
        /**
         * Parameter Validation
         */
        $aAssert = $this->assert->formValidate($aParam, $aRules);

        $aResponse['php_validation'] = $aAssert;
        if ($aAssert['flag'] != self::ACTIVE_STATUS) {
            return $aResponse;
        }

        if ($aParam['region'] == "") {
            $aParam['region'] = "0";
        }
        if ($aParam['city'] == "") {
            $aParam['city'] = "0";
        }
        if ($aParam['brgy'] == "") {
            $aParam['brgy'] = "0";
        }

        $aParam['addressid'] = $this->yel->decrypt_param($aParam['addressid']);
        // get agency branch id
        $agency_branch_id = $this->Agencies_model->getAgencyBranchIDbyAgencyAddressId($aParam['addressid']);
        // get agency branch and abbr
        $agn_brnch_abbr = $this->Agencies_model->getAgencyToAgencyBranchDetailsByAgencyBranchID($agency_branch_id);
        
        $aLog = [];
        //get original address details for logs
        $aLog['old_data'] = $this->Agencies_model->getAddressByAddressID($aParam);
        //update agency address details
        $aResponse['details'] = $this->Agencies_model->setAgencyAddress($aParam);
        //get the new agency address details for logs
        $aLog['new_data'] = $this->Agencies_model->getAddressByAddressID($aParam);

        $aLog['log_event_type'] = 7; // base on table : icms_user_event_type
        $aLog['log_message'] = "modified the address details of  " . $agn_brnch_abbr['agency_abbr'] . " - " . $agn_brnch_abbr['agency_branch_name'];
        $aLog['log_link'] = 'agency_branch/' . $this->yel->encrypt_param($agency_branch_id);
        $aLog['log_action'] = 2; // 1= new insert table 2=update table
        $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
        $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
        $aResponse['log'] = $this->audit->create($aLog);

        return $aResponse;
    }   

    public function setAgencyDetails($aParam) {

        $aResponse = [];

        $aResult['flag'] = self::FAILED_RESPONSE;
        $aParam = $this->yel->safe_mode_clean_array($aParam);
        //validation rules
        $aRules = array(
            'branch_name' => 'required',
            'txt_email' => 'required',
            'txt_tel' => 'required',
            'txt_mobile' => 'required',
            'services_selected' => 'required',
            'agn_branch_id' => 'required',
        );

        $aResponse['msg'] = "Validation Failed";
        $aResponse['result'] = self::FAILED_RESPONSE;
        /**
         * Parameter Validation
         */
        $aAssert = $this->assert->formValidate($aParam, $aRules);

        $aResponse['php_validation'] = $aAssert;
        if ($aAssert['flag'] != self::ACTIVE_STATUS) {
            return $aResponse;
        }

        $aParam['agn_branch_id'] = $this->yel->decrypt_param($aParam['agn_branch_id']);
        
        //check if email changed
        $agencybranch_id = $this->Agencies_model->getEmailValidation($aParam);
        if (!empty($agencybranch_id) == true && $agencybranch_id !== $aParam['agn_branch_id'] & $aParam['changeEmail'] == "1") {
            $aResponse['msg'] = "email is not available";
        } else {
            $aLog = [];
            //get original details for logs
            $aLog['old_data'] = $this->Agencies_model->getAgencyBranchDetails($aParam);
            //update details
            $agencybranch_details = $this->Agencies_model->setAgencyDetails($aParam);
            // the new details after update
            $aLog['new_data'] = $this->Agencies_model->getAgencyBranchDetails($aParam);


            $aLog['log_event_type'] = 6; // base on table : icms_user_event_type
            $aLog['log_message'] = "updated the agency branch details of " . $aParam['txt_agency'];
            $aLog['log_link'] = 'agency_branch/' . $this->yel->encrypt_param($aParam['agn_branch_id']);
            $aLog['log_action'] = 2; // 1= new insert table 2=update table
            $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
            $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
            $aResponse['log'] = $this->audit->create($aLog);

            //update services
            $aResponse['result'] = self::ACTIVE_STATUS;
            $aResponse['msg'] = "Update Success";
            //disable all services by agency_branch_id
            $this->Agencies_model->disabledServicesById($aParam);
            $services = explode(",", $aParam['services_selected']);

            foreach ($services as $key => $val) {
                //check if service was just disabled
                $service_cnt = $this->Agencies_model->getServiceIfDisabled($val, $aParam['agn_branch_id']);
                if ($service_cnt >= 1) {
                    //activate
                    $this->Agencies_model->setServiceEnabled($val, $aParam['agn_branch_id']);
                } else {
                    //addnew
                    $this->Agencies_model->addAgencyBrancgService($val, $aParam['agn_branch_id']);
                }
            }
        }

        return $aResponse;
    }

    public function setAgencyContact($aParam) {
        $aResponse = [];

        $aResult['flag'] = self::FAILED_RESPONSE;
        $aParam = $this->yel->safe_mode_clean_array($aParam);

        //validation rules
        $aRules = array(
            'id' => 'required',
        );

        $aResponse['msg'] = "Validation Failed";
        $aResponse['result'] = self::FAILED_RESPONSE;
        /**
         * Parameter Validation
         */
        $aAssert = $this->assert->formValidate($aParam, $aRules);

        $aResponse['php_validation'] = $aAssert;
        if ($aAssert['flag'] != self::ACTIVE_STATUS) {
            return $aResponse;
        }
        $aResponse['result'] = self::ACTIVE_STATUS;

        $aParam['id'] = $this->yel->decrypt_param($aParam['id']);
        $aResponse['details'] = $this->Agencies_model->setAgencyContactDeleted($aParam);

        //save user log
        $contact_details = $this->Agencies_model->getAgencyContactDetails($aParam);
        $agency_details = $this->Agencies_model->getAgencyToAgencyBranchDetailsByAgencyBranchID($contact_details['agency_branch_id']);
        $aLog = [];
        $aLog['log_event_type'] = 9; // base on table : icms_user_event_type
        $aLog['log_message'] = "removed branch contact person <b>" . $contact_details['agency_contact_firstname'] . " " . $contact_details['agency_contact_lastname'] . "</b> from  " . $agency_details['agency_abbr'] . " - " . $agency_details['agency_branch_name'];
        $aLog['log_link'] = "";
        $aLog['log_action'] = 1; // 1= new insert table 2=update table
        $aResponse['log'] = $this->audit->create($aLog);

        return $aResponse;
    }

    public function addNewAgencyContactDetails($aParam) {
        $aResponse = [];

        $aResult['flag'] = self::FAILED_RESPONSE;
        $aParam = $this->yel->safe_mode_clean_array($aParam);

        //validation rules
        $aRules = array(
            'country' => 'required',
            'province' => 'required',
            'address' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'mob' => 'required',
            'email' => 'required',
            'agencyid' => 'required',
        );

        $aResponse['msg'] = "Validation Failed";
        $aResponse['result'] = self::FAILED_RESPONSE;
        /**
         * Parameter Validation
         */
        $aAssert = $this->assert->formValidate($aParam, $aRules);

        $aResponse['php_validation'] = $aAssert;
        if ($aAssert['flag'] != self::ACTIVE_STATUS) {
            return $aResponse;
        }
        $aResponse['result'] = self::ACTIVE_STATUS;
        $aParam['agencyid'] = $this->yel->decrypt_param($aParam['agencyid']);
        if ($aParam['action'] == "1") {
            $aParam['newContactId'] = $this->Agencies_model->addNewAgencyContactDetails($aParam);            
            $this->Agencies_model->addNewAgencyContactAddressDetails($aParam);
            $aLog = [];
            $aLog['log_event_type'] = 8; // base on table : icms_user_event_type
            $agency_branch_details = $this->Agencies_model->getAgencyToAgencyBranchDetailsByAgencyBranchID($aParam['agencyid']);
            $aLog['log_message'] = "added <b>" . $aParam['fname'] . " " . $aParam['lname'] . "</b> as new " . $agency_branch_details['agency_abbr'] . " - " . $agency_branch_details['agency_branch_name'] . " contact person";
            $aLog['log_link'] = 'agency_branch/' . $this->yel->encrypt_param($aParam['agencyid']);
            $aLog['log_action'] = 1; // 1= new insert table 2=update table
            $aResponse['log'] = $this->audit->create($aLog);
        } else {
            // update function
            $aParam['contactid'] = $this->yel->decrypt_param($aParam['contactid']);
            $this->saveLogsForEditingAgencyBranchContact($aParam);
            $this->saveLogsForEditingAgencyBranchContactaddress($aParam);
        }

        return $aResponse;
    }

    private function saveLogsForEditingAgencyBranchContact($aParam) {
        $aLog = [];
        //get original details for logs
        $aLog['old_data'] = $this->Agencies_model->getAgencyContactDetails($aParam);
        //update details
        $aResponse['details'] = $this->Agencies_model->setAgencyContactDetails($aParam);
        // the new details after update
        $aLog['new_data'] = $this->Agencies_model->getAgencyContactDetails($aParam);
        $agency_branch_details = $this->Agencies_model->getAgencyToAgencyBranchDetailsByAgencyBranchID($aParam['agencyid']);
        $aLog['log_event_type'] = 10; // base on table : icms_user_event_type
        $aLog['log_message'] = "updated the " . $agency_branch_details['agency_abbr'] . " - " . $agency_branch_details['agency_branch_name'] . " contact person details";
        $aLog['log_link'] = 'manage_agency_branch/' . $this->yel->encrypt_param($aParam['agencyid']);
        $aLog['log_action'] = 2; // 1= new insert table 2=update table
        $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
        $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
        $aResponse['log'] = $this->audit->create($aLog);
        return $aResponse;
    }

    private function saveLogsForEditingAgencyBranchContactaddress($aParam) {

        $aLog = [];
        //get original details for logs
        $aLog['old_data'] = $this->Agencies_model->getAddressByAddressID($aParam);


        //update details
        $aResponse['details'] = $this->Agencies_model->setAgencyContactAddressDetails($aParam);
        // the new details after update
        $aLog['new_data'] = $this->Agencies_model->getAddressByAddressID($aParam);
        $agency_branch_details = $this->Agencies_model->getAgencyToAgencyBranchDetailsByAgencyBranchID($aParam['agencyid']);
        $contact_person_details = $this->Agencies_model->getAgencyContactDetails($aParam);
        $aLog['log_event_type'] = 11; // base on table : icms_user_event_type
        $aLog['log_message'] = "changed the address of " . $agency_branch_details['agency_abbr'] . " - " . $agency_branch_details['agency_branch_name'] . " contact person " . $contact_person_details['agency_contact_firstname'] . " " . $contact_person_details['agency_contact_lastname'];
        $aLog['log_link'] = 'manage_agency_branch/' . $this->yel->encrypt_param($aParam['agencyid']);
        $aLog['log_action'] = 2; // 1= new insert table 2=update table
        $aLog['new_data'] = $this->yel->encrypt_param(json_encode($aLog['new_data']));
        $aLog['old_data'] = $this->yel->encrypt_param(json_encode($aLog['old_data']));
        $aResponse['log'] = $this->audit->create($aLog);
        return $aResponse;
    }

}
