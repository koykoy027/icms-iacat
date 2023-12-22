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
        $this->load->model('Settings_model');
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
        $aTableName = [];

        $aTableName = array(
            array('table_name' => 'icms_case_status',
                'table_full_name' => 'Case Status'
            ),
            array('table_name' => 'icms_case_assistance_status',
                'table_full_name' => 'Case Assistance Status',
            ),
            array('table_name' => 'icms_global_case_nature_main_category',
                'table_full_name' => 'Case Nature Category'
            ),
            array('table_name' => 'icms_global_civil_status',
                'table_full_name' => 'Civil Status'
            ),
            array('table_name' => 'icms_global_departure_type',
                'table_full_name' => 'Departure Type'
            ),
            array('table_name' => 'icms_global_employment_type',
                'table_full_name' => 'Employement Type'
            ),
            array('table_name' => 'icms_global_family_relation',
                'table_full_name' => 'Famil Relationship'
            ),
            array('table_name' => 'icms_global_gender',
                'table_full_name' => 'Gender'
            ),
            array('table_name' => 'icms_global_origin_address_type',
                'table_full_name' => 'Origin Type Address'
            ),
            array('table_name' => 'icms_global_religion',
                'table_full_name' => 'Religion'
            ),
            array('table_name' => 'icms_global_social_media_type',
                'table_full_name' => 'Social Media'
            ),
            array('table_name' => 'icms_global_visa_category',
                'table_full_name' => 'Visa Category'
            ),
            array('table_name' => 'icms_immediate_assistance_type',
                'table_full_name' => 'Immediate Assistance Type'
            ),
            array('table_name' => 'icms_govt_agency_type_category',
                'table_full_name' => 'Department Type '
            )
        );

        foreach ($aTableName as $key => $value) {
            $aTableName[$key]['list'] = $this->Settings_model->getListContentByTable($value['table_name']);
        }

        $aResponse = $aTableName;

        return $aResponse;
    }

    public function addDatabyTableName($aParam) {
        $aResponse = [];

        $aParam = $this->yel->clean_array($aParam);

        $sAColumnName = str_replace("icms_", "", $aParam['tbl_name']);
        $sAColumnName = str_replace("global_", "", $sAColumnName);
        $aParam['clm_name_desc'] = $sAColumnName . '_description';

        $aResponse['resp'] = $this->Settings_model->addDatabyTableName($aParam);

        return $aResponse;
    }

    public function setDatabyTableName($aParam) {
        $aResponse = [];

        $aParam = $this->yel->clean_array($aParam);

        $sAColumnName = str_replace("icms_", "", $aParam['tbl_name']);
        $sAColumnName = str_replace("global_", "", $sAColumnName);
        $aParam['clm_name_desc'] = $sAColumnName . '_description';
        $aParam['clm_id'] = $sAColumnName . '_id';

        $aResponse['resp'] = $this->Settings_model->setDatabyTableName($aParam);

        return $aResponse;
    }

}
