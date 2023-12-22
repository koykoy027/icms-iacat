<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Report_details_model extends CI_Model {

    public function getVictimPersonalInfoByCaseId($aParam) {
        $sql = "  SELECT 
                    `cv`.`victim_id`,
                    `cv`.`case_victim_id`,
                    `vi`.`victim_info_first_name`,
                    `vi`.`victim_info_middle_name`,
                    `vi`.`victim_info_last_name`,
                    `vi`.`victim_info_suffix`,
                    `vi`.`victim_info_dob`,
                    `vi`.`victim_info_is_assumed`,
                    (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`vi`.`victim_info_city_pob` AND `location_type_id`='4') as `victim_pob`,
                    (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='9' AND `parameter_count_id`=`v`.`victim_gender` LIMIT 1) as `sex`,
                    (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='3' AND `parameter_count_id`=`v`.`victim_civil_status` LIMIT 1) as `civil_status`,
                    (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='4' AND `parameter_count_id`=`v`.`victim_civil_status` LIMIT 1) as `religion`                                    
                FROM
                    `icms_case_victim` `cv`,
                    `icms_victim_info` `vi`,
                    `icms_victim` `v`
                WHERE
                    `cv`.`case_id`='" . $aParam['case_id'] . "'
                AND `vi`.`victim_id`=`cv`.`victim_id`
                AND `v`.`victim_id`=`cv`.`victim_id`
                AND `vi`.`victim_info_is_active`='1'
                ORDER BY `v`.`victim_date_modified` DESC
                LIMIT 2
             ";
        $aResult = $this->yel->getAll($sql);
        return $aResult;
    }

    public function getEmploymentDetails($aParam) {
        $sql = "   SELECT 
                        `ve`.*,
                        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='7' AND `parameter_count_id`=`ve`.`case_victim_employment_type` LIMIT 1) as `employment_type`,
                        (SELECT 
                            `case_victim_employment_details_job_title` 
                        FROM 
                            `icms_case_victim_employment_details` 
                        WHERE 
                            `case_victim_employment_id`=`ve`.`case_victim_employment_id` 
                        AND `case_victim_employment_details_is_actual`='1'
                        LIMIT 1) as actual_work,
                        (SELECT 
                            `case_victim_employment_details_job_title` 
                        FROM 
                            `icms_case_victim_employment_details` 
                        WHERE 
                            `case_victim_employment_id`=`ve`.`case_victim_employment_id` 
                        AND `case_victim_employment_details_is_actual`='0'
                        LIMIT 1) as different_contract
                    FROM 
                        `icms_case_victim_employment` `ve`
                    WHERE
                        `ve`.`case_victim_id` ='" . $aParam['case_victim_id'] . "'
                    LIMIT 1   
                    ";
        $aResult = $this->yel->getRow($sql);
        return $aResult;
    }

    public function getEmployerDetailsByEmployerId($id) {
        $sql = "    SELECT 
                        `e`.`employer_name`,
                        `e`.`employer_city`,
                        `e`.`employer_full_address`,
                        (SELECT `country_name` FROM `icms_global_country` WHERE `country_id`=`e`.`employer_country_id` LIMIT 1 ) as `country`
                    FROM 
                        `icms_employer` `e`
                    WHERE
                        `e`.`employer_id` ='" . $id . "'
                    LIMIT 1   
                    ";
        
        $aResult = $this->yel->getRow($sql);
        return $aResult;
    }

    public function getLocalRecruitmentAgencyByAgencyID($id) {
        $sql = "    SELECT 
                        `ra`.`recruitment_agency_name`,
                        `ra`.`recruitment_agency_address`,
                        (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`ra`.`province_id` AND `location_type_id`='4') as `province`
                    FROM 
                        `icms_recruitment_agency` `ra`
                    WHERE
                        `ra`.`recruitment_agency_id` ='" . $id . "'
                    LIMIT 1   
                    ";
        $aResult = $this->yel->getRow($sql);
        return $aResult;
    }

    public function getForeignRecruitmentAgencyByAgencyID($id) {
        $sql = "    SELECT 
                        `ra`.`recruitment_agency_name`,
                        `ra`.`recruitment_agency_address`,
                        (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`ra`.`state_id` AND `location_type_id`='2') as `state`,
                        (SELECT `country_name` FROM `icms_global_country` WHERE `country_id`=`ra`.`country_id` LIMIT 1 ) as `country`
                    FROM 
                        `icms_recruitment_agency` `ra`
                    WHERE
                        `ra`.`recruitment_agency_id` ='" . $id . "'
                    LIMIT 1   
                    ";
        $aResult = $this->yel->getRow($sql);
        return $aResult;
    }

    public function getDeploymentDetails($aParam) {

        $sql = "    SELECT 
                        `vd`.`case_victim_deployment_date`,
                        `vd`.`case_victim_deployment_arrival_date`,
                        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='5' AND `parameter_count_id`=`vd`.`case_victim_deployment_type` LIMIT 1) as `departure_type`,
                        (SELECT `port_name` FROM `icms_global_ph_port` WHERE `port_id`=`vd`.`port_id` LIMIT 1) as `port_type`,
                        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='11' AND `parameter_count_id`=`vd`.`case_victim_visa_category_id` LIMIT 1) as `visa_category`,                        
                        (SELECT `country_name` FROM `icms_global_country` WHERE `country_id`=`vd`.`case_victim_deployment_country_destination` LIMIT 1 ) as `country`
                    FROM 
                        `icms_case_victim_deployment` `vd`
                    WHERE
                        `vd`.`case_victim_id` ='" . $aParam['case_victim_id'] . "'
                    LIMIT 1   
                    ";
        $aResult = $this->yel->getRow($sql);
        return $aResult;
    }

    public function getActMeansPurpose($aParam) {
        $sql = "    SELECT 
                       `tip`.`case_victim_tip_type_id`,
                       (SELECT `tip_details_name`  FROM `icms_tip_details` WHERE `tip_details_count`=`tip`.`case_victim_tip_type_content_id` AND `tip_form_type_id`=`tip`.`case_victim_tip_type_id` LIMIT 1)as `tip_type`
                    FROM 
                        `icms_case_victim_tip` `tip`
                    WHERE
                        `tip`.`case_victim_id` ='" . $aParam['case_victim_id'] . "'
                    ";
        $aResult = $this->yel->getAll($sql);
        return $aResult;
    }

    public function getCaseFacts($aParam) {
        $sql = "
                SELECT `case_facts`,`case_evaluation`,`case_risk_assessment`,`case_priority_level_id` FROM `icms_case` WHERE `case_id`='" . $aParam['case_id'] . "' LIMIT 1";
        $aResult = $this->yel->getRow($sql);
        return $aResult;
    }

    public function getReportComplainant($aParam) {
        $sql = "
                SELECT 
                    `cc`.`case_complainant_name`,
                    `cc`.`case_complainant_date_complained`,
                    `cc`.`case_complainant_relation_other`,
                    (SELECT `transaction_parameter_name` FROM `icms_transaction_parameter` WHERE `transaction_parameter_type_id` = '9' AND `transaction_parameter_count_id`=`cc`.`case_complainant_source_id` LIMIT 1) as `complain_source`,
                    (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id` = '8' AND `parameter_count_id`=`cc`.`case_complainant_relation` LIMIT 1) as `case_complainant_relation`
                FROM 
                    `icms_case_complainant` `cc`
                WHERE 
                    `case_victim_id`='" . $aParam['case_victim_id'] . "' LIMIT 1";

        $aResult = $this->yel->getRow($sql);
        return $aResult;
    }

    public function getReportServices($aParam) {
        $sql = "
                SELECT 
                    `cvs`.`services_id`,
                    `s`.`service_name`,
                    (SELECT `transaction_parameter_name` FROM `icms_transaction_parameter` WHERE `transaction_parameter_type_id`='8' AND `transaction_parameter_count_id`=`s`.`service_type_id`) as `service_type`,
                    (SELECT `transaction_parameter_name` FROM `icms_transaction_parameter` WHERE `transaction_parameter_type_id`='11' AND `transaction_parameter_count_id`=`s`.`service_category`) as `service_category`
                FROM 
                    `icms_case_victim_services` `cvs`,
                    `icms_services` `s`
                WHERE 
                    `s`.`case_victim_services_is_active` = '1' AND 
                    `cvs`.`case_victim_id`='" . $aParam['case_victim_id'] . "'
                AND `s`.`services_id`=`cvs`.`services_id`
                ";  
        $aResult = $this->yel->getAll($sql);
        return $aResult;
    }

}
