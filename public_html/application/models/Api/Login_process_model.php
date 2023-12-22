<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Login_process_model extends CI_Model {

    /**
     * Create user log
     * 
     * @param array $aParam
     * @return array $aResponse
     */
    public function getUsers($aParam) {
        $sql = " SELECT 
                    `user_id`,
                    `user_firstname`,
                    `user_middlename`,
                    `user_lastname`,
                    `user_phone_number`,
                    `user_mobile_number`,
                    `user_gender`,
                    `user_job_title`,
                    `user_username`,
                    `user_email`,
                    `user_password`,
                    `user_access_code`,
                    `agency_branch_id`,
                    `user_level_id`,
                    `user_is_active`,
                    `agency_is_active`,
                    `agency_branch_is_active`,
                    `user_level_is_active`,
                    `user_is_verified`
                from 
                    icms_user
                LIMIT 1000";
        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function getAgency($aParam) {
        $sql = " SELECT
                    `agency_id`,
                    `agency_category_id`,
                    `agency_name`,
                    `agency_abbr`,
                    `agency_description`,
                    `agency_is_admin`,
                    `agency_is_active`
                FROM
                    `icms_agency`";
        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function getAgencyBranch($aParam) {
        $sql = " SELECT
                    `agency_branch_id`,
                    `agency_branch_name`,
                    `agency_branch_description`,
                    `agency_id`,
                    `agency_branch_email`,
                    `agency_branch_telephone_number`,
                    `agency_branch_mobile_number`,
                    `agency_branch_is_main`,
                    `agency_branch_is_active`,
                    `agency_is_active`
                FROM
                    `icms_agency_branch`";
        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function getAgencyServicesOffered($aParam) {
        $sql = " SELECT
                    `agency_services_offered_id`,
                    `services_id`,
                    `agency_branch_id`,
                    `agency_services_offered_is_active`
                FROM
                    `icms_agency_services_offered`";
        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function getGlobalCountry($aParam) {
        $sql = " SELECT
                    `country_id`,
                    `country_name`,
                    `country_code`,
                    `country_phone_code`,
                    `currency_name`,
                    `currency_sym`,
                    `currency_iso`,
                    `nationality`,
                    `is_active`                    
                FROM
                    `icms_global_country`";
        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function getGlobalLocation($aParam) {
        $sql = " SELECT
                    `location_id`,
                    `location_count_id`,
                    `location_name`,
                    `location_type_id`,
                    `location_prerequisite_id`,
                    `location_prerequisite_type_id`,
                    `location_is_active`           
                FROM
                    `icms_global_location`";
        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function getGlobalParameter($aParam) {
        $sql = " SELECT
                    `parameter_id`,
                    `parameter_type_id`,
                    `parameter_count_id`,
                    `parameter_status`,
                    `parameter_name`,
                    `parameter_description`,
                    `parameter_date_added`,
                    `parameter_date_modified`
                FROM
                    `icms_global_parameter`";
        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function getGlobalParameterType($aParam) {
        $sql = " SELECT
                    `global_parameter_type_id`,
                    `global_parameter_type_name`,
                    `global_parameter_field_name`,
                    `global_parameter_description`,
                    `global_parameter_type_is_show`
                FROM
                    `icms_global_parameter_type`";
        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function getGlobalPHPort($aParam) {
        $sql = " SELECT
                    `port_id`,
                    `port_name`,
                    `province_id`,
                    `city_id`,
                    `port_type`,
                    `port_is_active`
                FROM
                    `icms_global_ph_port`";
        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function getServices($aParam) {
        $sql = " SELECT
                    `services_id`,
                    `service_type_id`,
                    `service_category`,
                    `service_days`,
                    `service_name`,
                    `service_description`,
                    `service_is_active`
                FROM
                    `icms_services`";
        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function getTIPDetails($aParam) {
        $sql = " SELECT
                    `tip_details_id`,
                    `tip_details_count`,
                    `tip_form_type_id`,
                    `tip_details_name`,
                    `tip_details_is_active`
                FROM
                    `icms_tip_details`";
        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function getTransactionParameter($aParam) {
        $sql = "SELECT
                    `transaction_parameter_id`,
                    `transaction_parameter_type_id`,
                    `transaction_parameter_count_id`,
                    `transaction_parameter_name`,
                    `transaction_parameter_description`,
                    `transaction_parameter_status`,
                    `transaction_paramater_date_added`,
                    `transaction_parameter_added_by`
                FROM
                    `icms_transaction_parameter`";
        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function getTransactionParameterType($aParam) {
        $sql = " SELECT
                    `transaction_parameter_type_id`,
                    `transaction_parameter_type_name`,
                    `transaction_parameter_field_name`,
                    `transaction_parameter_description`,
                    `transaction_parameter_type_is_show`
                FROM
                    `icms_transaction_parameter_type`";
        $aResponse = $this->yel->GetAll($sql);
         return $aResponse;
    }

}
