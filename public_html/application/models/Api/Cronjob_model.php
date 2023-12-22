<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Cronjob_model extends CI_Model {

    /**
     * get service which about to date due
     * 
     * @param array $aParam
     * @return array $aResponse
     */
    public function getServicesAgeDueInThreeDays($aParam) {

        $add3Days = Date('Y-m-d', strtotime("+3 days"));
        $sql = "SELECT
                    `cvs`.`case_victim_id`,
                    `cvs`.`services_id`,
                    `cvs`.`case_victim_services_aging_date` as aging_date,
                    `cv`.`case_id`,
                    `ic`.`case_number`,
                    `ctu`.`user_id`,
                    (SELECT service_name FROM `icms_services` WHERE `services_id`=`cvs`.`services_id` LIMIT 1) as service_name,
                    (SELECT user_firstname FROM icms_user WHERE user_id=`ctu`.`user_id` LIMIT 1) as fname,
                    (SELECT user_lastname FROM icms_user WHERE user_id=`ctu`.`user_id` LIMIT 1) as lname,
                    (SELECT user_email FROM icms_user WHERE user_id=`ctu`.`user_id` LIMIT 1) as email                    
                FROM 
                    `icms_case_victim_services` `cvs`, 
                    `icms_case_victim_services_agency_tag` `cvsat`,
                    `icms_case_victim` `cv`,
                    `icms_case` `ic`,
                    `icms_case_tagged_users` `ctu`
                WHERE
                    `cvs`.`case_victim_services_aging_date`='".$add3Days."'
                AND  `cvs`.`case_victim_services_is_active` = 1 
                AND `cvsat`.`case_victim_services_agency_tag_is_active` = 1     
                AND (`cvsat`.`case_victim_services_id`= `cvs`.`case_victim_services_id` AND `cvsat`.`case_victim_services_agency_tag_status`='1') 
                AND `cv`.`case_victim_id`=`cvs`.`case_victim_id` 
                AND `ic`.`case_id`=`cv`.`case_id` 
                AND (`ctu`.`case_id`=`cv`.`case_id` AND `ctu`.`case_tagged_users_status`='1' AND `ctu`.`user_id`>0)
                ORDER BY `ctu`.`user_id`
            ";
        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }

    /**
     * get service which already due
     * 
     * @param array $aParam
     * @return array $aResponse
     */
    public function getServicesAgeAfterDue($aParam) {
        $sql = "SELECT
                    `cvs`.`case_victim_id`,
                    `cvs`.`services_id`,
                    `cvs`.`case_victim_services_aging_date` as aging_date,
                    `cv`.`case_id`,
                    `ic`.`case_number`,
                    `ctu`.`user_id`,
                    (SELECT service_name FROM `icms_services` WHERE `services_id`=`cvs`.`services_id` LIMIT 1) as service_name,
                    (SELECT user_firstname FROM icms_user WHERE user_id=`ctu`.`user_id` LIMIT 1) as fname,
                    (SELECT user_lastname FROM icms_user WHERE user_id=`ctu`.`user_id` LIMIT 1) as lname,
                    (SELECT user_email FROM icms_user WHERE user_id=`ctu`.`user_id` LIMIT 1) as email                    
                FROM 
                    `icms_case_victim_services` `cvs`, 
                    `icms_case_victim_services_agency_tag` `cvsat`,
                    `icms_case_victim` `cv`,
                    `icms_case` `ic`,
                    `icms_case_tagged_users` `ctu`
                WHERE
                    `cvs`.`case_victim_services_aging_date` < now() 
                AND  `cvs`.`case_victim_services_is_active` = 1 
                AND `cvsat`.`case_victim_services_agency_tag_is_active` = 1 
                AND (`cvsat`.`case_victim_services_id`= `cvs`.`case_victim_services_id` AND `cvsat`.`case_victim_services_agency_tag_status`='1') 
                AND `cv`.`case_victim_id`=`cvs`.`case_victim_id` 
                AND `ic`.`case_id`=`cv`.`case_id` 
                AND (`ctu`.`case_id`=`cv`.`case_id` AND `ctu`.`case_tagged_users_status`='1' AND `ctu`.`user_id` > 0)
                ORDER BY `ctu`.`user_id`
";

        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }

}
