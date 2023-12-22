<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Validate_model extends CI_Model {

    public function getVictimWithRelName($aParam) {
        $sql = "SELECT `victim_info_id`, `victim_id`,
                CONCAT(`victim_info_first_name`, ' ', `victim_info_last_name`) as rel_content,
                MATCH (`victim_info_first_name`,`victim_info_last_name`) AGAINST ('+" . $aParam . "*') as `rel` 
                FROM `icms_victim_info` WHERE MATCH (`victim_info_first_name`,`victim_info_last_name`) AGAINST ('+" . $aParam . "*')";

        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }

    public function getVictimWithRelFullName($aParam) {
        $sql = "SELECT `victim_info_id`, `victim_id`, 
                CONCAT(`victim_info_first_name`, ' ', COALESCE(`victim_info_middle_name`, ''), ' ', `victim_info_last_name`) as rel_content,
                MATCH (`victim_info_first_name`, `victim_info_middle_name`,`victim_info_last_name`) AGAINST ('+" . $aParam . "*') as `rel` 
                FROM `icms_victim_info` WHERE MATCH (`victim_info_first_name`, `victim_info_middle_name`,`victim_info_last_name`) AGAINST ('+" . $aParam . "*')";

        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }

    public function getVictimWithRelDob($aParam) {
        $sql = "SELECT `victim_info_id`, `victim_id` FROM `icms_victim_info` WHERE `victim_info_dob` = '" . $aParam . "'";

        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }

    public function getVictimWithRelPob($aParam) {
        $sql = "SELECT `victim_info_id`, `victim_id` FROM `icms_victim_info` WHERE `victim_info_city_pob` = '" . $aParam . "'";

        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }

    public function getVictimWithRelOffendersName($aParam) {
        $sql = "SELECT `case_offender_id`, `case_id`, `case_offender_name`
                MATCH (`case_offender_name`) AGAINST ('+" . $aParam . "*' IN BOOLEAN MODE) as `rel_offender` 
                FROM `icms_case_offender` WHERE MATCH (`case_offender_name`) AGAINST ('+" . $aParam . "*' IN BOOLEAN MODE)";

        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }

    public function getVictimByCaseId($aParam) {
        $sql = "SELECT `victim_id` FROM `icms_case_victim` WHERE `case_id` = '" . $aParam . "' LIMIT 1";

        $aResponse = $this->yel->GetRow($sql);

        return $aResponse;
    }

    public function getEmployerNameRel($aParam) {
        $sql = "SELECT `employer_id`, `employer_name`,
                MATCH (`employer_name`) AGAINST ('+" . $aParam . "*') AS `rel_employer` 
                FROM `icms_employer` WHERE MATCH (`employer_name`) AGAINST ('+" . $aParam . "*')";

        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }

    public function getVictimByEmployerId($aParam) {
        $sql = "SELECT `a`.`case_victim_id`,
                (SELECT `victim_id` FROM `icms_case_victim` WHERE `case_victim_id` = `a`.`case_victim_id`) as `victim_id`
                FROM `icms_case_victim_employment` `a` WHERE `a`.`employer_id` = '" . $aParam . "'";

        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }

    public function getAgencyNameRel($aParam) {
        $sql = "SELECT `recruitment_agency_id`, `recruitment_agency_name`
                MATCH (`recruitment_agency_name`) AGAINST ('+" . $aParam . "*') AS `rel_agency` 
                FROM `icms_recruitment_agency` WHERE MATCH (`recruitment_agency_name`) AGAINST ('+" . $aParam . "*') AND `recruitment_agency_is_local` = '1'";

        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }

    public function getVictimByAgencyId($aParam) {
        $sql = "SELECT `a`.`case_victim_id`,
                (SELECT `victim_id` FROM `icms_case_victim` WHERE `case_victim_id` = `a`.`case_victim_id`) as `victim_id`
                FROM `icms_case_victim_employment` `a` WHERE `a`.`recruitment_agency_id_local` = '" . $aParam . "'";

        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }
    
    //OLD
    public function _getDeployedDateRel($aParam) {
        $sql = "SELECT `case_victim_id`, `case_victim_deployment_id` FROM `icms_case_victim_deployment` WHERE `case_victim_deployment_date` = '" . $aParam . "'";

        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }
    
    //NEW    
    public function getDeployedDateRel($aParam) {
        $sql = "SELECT `case_victim_id`, `case_victim_deployment_id` FROM `icms_case_victim_deployment` WHERE `case_victim_deployment_date` = '" . $aParam . "'";

        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }

    public function getVictimByCaseVictimId($aParam) {
        $sql = "SELECT `victim_id` FROM `icms_case_victim` WHERE `case_victim_id` = '" . $aParam . "'";

        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }
    
    //OLD
    public function _getDeployedCountryRel($aParam) {
        $sql = "SELECT `case_victim_id` FROM `icms_case_victim_deployment` WHERE `case_victim_deployment_country_destination` = '" . $aParam . "'";

        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }
    
    //NEW
    public function getDeployedCountryRel($aParam) {
         $sql = "SELECT `case_victim_id`, `case_victim_deployment_id` FROM `icms_case_victim_deployment` WHERE `case_victim_deployment_country_destination` = '" . $aParam . "'";

        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }

    public function getTrafficPurposeRel($aParam) {
        $sql = "SELECT `case_victim_id` FROM `icms_case_victim_tip` WHERE `case_victim_tip_type_content_id` = '" . $aParam . "' AND `case_victim_tip_type_id` = '2'";

        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }

    public function getCaseVictimList() {
        $sql = "SELECT * FROM `icms_case_victim`";

        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }

    // insert to validation table
    public function addVictimToValidationTbl($aValues) {
        $sql = "INSERT INTO `icms_case_victim_validation`
                 (`icms_validation_victim_id`, `icms_validation_count`, `icms_validation_victim_info_id`, `icms_validation_relevance_desc` , `icms_validation_relevance`, `icms_validation_content`, `icms_validation_content_rel`) 
                 VALUES " . $aValues . "
               ";

        $aResponse = $this->yel->exec($sql);

        return $aResponse;
    }

    public function getMaxCount() {
        $sql = "SELECT MAX(`icms_validation_count`) FROM `icms_case_victim_validation`";

        $aResponse = $this->yel->GetOne($sql);

        return $aResponse;
    }
    
    public function getAllValidateVictim($aParam) {
        $sql = " 
            SELECT 
                COUNT(`a`)
            FROM 
                `icms_case_victim_validation` `a` 
            WHERE 
                `icms_validation_count` = '" .$aParam['count_id']. "'
            GROUP BY `icms_validation_victim_info_id`
            ORDER BY percent DESC
        ";

        $aResponse = $this->yel->GetOne($sql);

        return $aResponse;
    }
    
    public function getAllValidateVictimWithDetails($aParam){
        $aResponse = [];

        $sList = " 
             SELECT 
                `a`.`icms_validation_victim_id`,
                (SELECT `victim_info_id` FROM `icms_victim_info` WHERE `victim_id` = `a`.`icms_validation_victim_id` AND `victim_info_is_assumed` = 0) as `victim_info_id`,
                ROUND(SUM(`a`.`icms_validation_content_rel`)/" .$aParam['total_fields']. ") as final_rel,
                (SELECT CONCAT( `victim_info_last_name`,', ',' ',  `victim_info_first_name`,' ', COALESCE(`victim_info_middle_name`, '')) FROM `icms_victim_info` WHERE `victim_id` = `a`.`icms_validation_victim_id` AND `victim_info_is_assumed` = 0) as `full_name`,
                (SELECT `victim_info_dob` FROM `icms_victim_info` WHERE `victim_id` = `a`.`icms_validation_victim_id` AND `victim_info_is_assumed` = 0) as `victim_info_dob`,
                (SELECT `victim_info_city_pob` FROM `icms_victim_info` WHERE `victim_id` = `a`.`icms_validation_victim_id` AND `victim_info_is_assumed` = 0) as `victim_info_city_pob`,
                (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`= `victim_info_city_pob` AND `location_type_id`='5') as `city`,
                (SELECT COUNT(`case_id`) FROM `icms_case_victim` WHERE `victim_id` = `a`.`icms_validation_victim_id`) as `cases`
            FROM 
                `icms_case_victim_validation` `a` 
            WHERE 
                `icms_validation_count` = '" .$aParam['count_id']. "'
            GROUP BY `icms_validation_victim_id`
            ORDER BY final_rel DESC
            LIMIT  " . $aParam['start'] . "," . $aParam['limit'] . " 
        ";
//        echo $sList;
        $aResponse['list'] = $this->yel->GetAll($sList);

        $sCount = "
             SELECT 
                COUNT(`icms_validation_id`) as `count`
            FROM 
                `icms_case_victim_validation`
            WHERE 
                `icms_validation_count` = '" .$aParam['count_id']. "'
            GROUP BY `icms_validation_victim_id`
                ";
        
        $aResponse['count'] = $this->yel->GetAll($sCount);

        return $aResponse;
    }
    
    public function getAllVictimWithInfoId($aParam) {
        $sql = " 
            SELECT 
                `a`.* 
            FROM 
                `icms_case_victim_validation` `a` 
            WHERE 
                `icms_validation_count` = '" . $aParam . " '
            AND `icms_validation_victim_info_id` != 0
            GROUP BY `icms_validation_victim_info_id`
        ";

        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }

    public function getAllVictimWOInfoId($aParam) {
        $sql = "SELECT 
                    `a`.*  
               FROM 
                    `icms_case_victim_validation` `a` 
               WHERE 
                    `icms_validation_count` = '" . $aParam . "'  
               AND 
                    `icms_validation_victim_info_id` = '0' 
               GROUP BY `icms_validation_victim_id`";


        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }

    public function getVictimInfoId($aParam) {
        $sql = "SELECT `victim_info_id` FROM `icms_victim_info` WHERE `victim_id` = '" . $aParam . "' AND `victim_info_is_assumed` = '0' LIMIT 1";

        $aResponse = $this->yel->GetOne($sql);

        return $aResponse;
    }

    public function getTotalRelByVictimInfoId($aParam, $count_id) {
        $sql = "SELECT `a`.`icms_validation_victim_id`, `a`.`icms_validation_victim_info_id`,  SUM(`a`.`icms_validation_relevance`) as `total`,
                (SELECT CONCAT_WS('', `victim_info_last_name`,', ',' ',  `victim_info_first_name`,' ', `victim_info_middle_name`) FROM `icms_victim_info` WHERE `victim_info_id` = `a`.`icms_validation_victim_info_id`) as `full_name`,
                (SELECT `victim_info_dob` FROM `icms_victim_info` WHERE `victim_info_id` = `a`.`icms_validation_victim_info_id`) as `victim_info_dob`,
                (SELECT `victim_info_city_pob` FROM `icms_victim_info` WHERE `victim_info_id` = `a`.`icms_validation_victim_info_id`) as `victim_info_city_pob`,
                (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`= `victim_info_city_pob` AND `location_type_id`='5') as `city`,
                (SELECT COUNT(`case_id`) FROM `icms_case_victim` WHERE `victim_id` = `a`.`icms_validation_victim_id`) as `cases`
                FROM `icms_case_victim_validation` `a` WHERE `a`.`icms_validation_victim_info_id` = '" . $aParam . "' AND `a`.`icms_validation_count` = '" . $count_id . "' GROUP BY `a`.`icms_validation_victim_info_id`";
        $aResponse = $this->yel->GetRow($sql);

        return $aResponse;
    }

    public function getTotalRelByVictimId($aParam, $count_id) {
        $sql = "SELECT `a`.`icms_validation_victim_id`, `a`.`icms_validation_victim_info_id`, SUM(`a`.`icms_validation_relevance`) as `total`,
                (SELECT CONCAT(`victim_info_last_name`, ', ', `victim_info_first_name`, ' ', `victim_info_middle_name`) FROM `icms_victim_info` WHERE `victim_id` = `a`.`icms_validation_victim_id` AND `victim_info_is_assumed` = '0' LIMIT 1) as `full_name`,
                (SELECT `victim_info_dob` FROM `icms_victim_info` WHERE `victim_id` = `a`.`icms_validation_victim_id` AND `victim_info_is_assumed` = '0' LIMIT 1) as `victim_info_dob`,
                (SELECT `victim_info_city_pob` FROM `icms_victim_info` WHERE `victim_id` = `a`.`icms_validation_victim_id` AND `victim_info_is_assumed` = '0' LIMIT 1) as `victim_info_city_pob`,
                (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`= `victim_info_city_pob` AND `location_type_id`='5') as `city`,
                (SELECT COUNT(`case_id`) FROM `icms_case_victim` WHERE `victim_id` = `a`.`icms_validation_victim_id`) as `cases`
                FROM `icms_case_victim_validation` `a` WHERE `a`.`icms_validation_victim_info_id` = '0' AND `a`.`icms_validation_victim_id` = '" . $aParam . "' AND `a`.`icms_validation_count` = '" . $count_id . "' GROUP BY `a`.`icms_validation_victim_info_id`";

        $aResponse = $this->yel->GetRow($sql);

        return $aResponse;
    }

    public function getTotalRelByInfoToVictimId($aParam, $count_id) {
        $sql = "SELECT SUM(`icms_validation_relevance`) as `total` FROM `icms_case_victim_validation` WHERE `icms_validation_victim_info_id` = '0' AND `icms_validation_victim_id` = '" . $aParam . "' AND `icms_validation_count` = '" . $count_id . "'";

        $aResponse = $this->yel->GetOne($sql);

        return $aResponse;
    }

    public function getVictimCaseList($aParam) {
        $sql = "SELECT `a`.`case_victim_id`, `a`.`case_id`, `a`.`victim_id`, DATE(`b`.`case_date_added`) as `date_added`, `b`.`case_added_by`,
                (SELECT `agency_id` FROM `icms_agency_branch` WHERE `agency_branch_id` = (SELECT `agency_branch_id` FROM `icms_user` WHERE `user_id` = `b`.`case_added_by`)) as `agency_id`,
                (SELECT `agency_name` FROM `icms_agency` WHERE `agency_id` = (SELECT `agency_id` FROM `icms_agency_branch` WHERE `agency_branch_id` = (SELECT `agency_branch_id` FROM `icms_user` WHERE `user_id` = `b`.`case_added_by`))) as `encoded_agency_name`,
                (SELECT `agency_branch_name` FROM `icms_agency_branch` WHERE `agency_branch_id` = (SELECT `agency_branch_id` FROM `icms_user` WHERE `user_id` = `b`.`case_added_by`)) as `encoded_agency_branch_name`,
		(SELECT `case_number` FROM `icms_case` WHERE `case_id` = `a`.`case_id` LIMIT 1) as `case_number`,
                (SELECT `employer_name` FROM `icms_employer` WHERE `employer_id` = (SELECT `employer_id` FROM `icms_case_victim_employment` WHERE `case_victim_id` = `a`.`case_victim_id` LIMIT 1)) as `employer_name`,
                (SELECT `recruitment_agency_name` FROM `icms_recruitment_agency` WHERE `recruitment_agency_id` = (SELECT `recruitment_agency_id_local` FROM `icms_case_victim_employment` WHERE `case_victim_id` = `a`.`case_victim_id` LIMIT 1)) as `agency_name`,
                (SELECT `case_victim_deployment_date` FROM `icms_case_victim_deployment` WHERE `case_victim_id` = `a`.`case_victim_id` LIMIT 1) as `case_victim_deployment_date`,
                (SELECT `country_name` FROM `icms_global_country` WHERE `country_id` = (SELECT `case_victim_deployment_country_destination` FROM `icms_case_victim_deployment` WHERE `case_victim_id` = `a`.`case_victim_id` LIMIT 1)) as `country`,
                (SELECT `case_victim_deployment_country_destination` FROM `icms_case_victim_deployment` WHERE `case_victim_id` = `a`.`case_victim_id` LIMIT 1) as `case_victim_deployment_country_destination`,
                (SELECT `recruitment_agency_id_local` FROM `icms_case_victim_employment` WHERE `case_victim_id` = `a`.`case_victim_id` LIMIT 1) as `recruitment_agency_id_local`,
                (SELECT `employer_id` FROM `icms_case_victim_employment` WHERE `case_victim_id` = `a`.`case_victim_id` LIMIT 1) as `employer_id`,
                (SELECT `case_victim_deployment_id` FROM `icms_case_victim_deployment` WHERE `case_victim_id` = `a`.`case_victim_id` LIMIT 1) as `case_victim_deployment_id`
                FROM `icms_case_victim` `a`, `icms_case` `b` WHERE `a`.`victim_id` = " . $aParam . " AND `b`.`case_id` = `a`.`case_id` AND `a`.`case_victim_is_active` = '1' ORDER BY `a`.`case_victim_date_added` DESC";
        
//        print_r($sql);

        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }

    public function getVictimDetails($aParam) {
        $sql = "SELECT `a`.*,
                (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`= `a`.`victim_info_city_pob` AND `location_type_id`='5') as `city`
                FROM `icms_victim_info` `a` WHERE `a`.`victim_info_id` = '" . $aParam . "'";

        $aResponse = $this->yel->GetRow($sql);

        return $aResponse;
    }

    public function getRelValDescByVictimInfoId($aParam) {
        $sql = "SELECT `icms_validation_relevance_desc` FROM `icms_case_victim_validation` WHERE `icms_validation_count` = '" . $aParam['count'] . "' AND `icms_validation_victim_info_id` = '" . $aParam['victim_info_id'] . "' GROUP BY `icms_validation_relevance_desc`";

        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }

    public function getRelValDescByVictimId($aParam) {
        $sql = "SELECT `icms_validation_relevance_desc` FROM `icms_case_victim_validation` WHERE `icms_validation_count` = '" . $aParam['count'] . "' AND `icms_validation_victim_id` = '" . $aParam['victim_id'] . "' AND `icms_validation_victim_info_id` = '0' GROUP BY `icms_validation_relevance_desc`";

        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }
    
    public function getRelevanceByVictimId($aParam) {
        $sql = "SELECT `icms_validation_relevance_desc`, `icms_validation_victim_info_id` FROM `icms_case_victim_validation` WHERE `icms_validation_count` = '" . $aParam['count'] . "' AND `icms_validation_victim_id` = '" . $aParam['victim_id'] . "' GROUP BY `icms_validation_relevance_desc`";

        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }

    public function getCaseVictimDetails($aParam) {
        $sql = "SELECT `a`.*, 
                (SELECT `victim_info_first_name` FROM `icms_victim_info` WHERE `victim_info_id` = '" . $aParam['victim_info_id'] . "') as `victim_info_first_name`,
                (SELECT `victim_info_last_name` FROM `icms_victim_info` WHERE `victim_info_id` = '" . $aParam['victim_info_id'] . "') as `victim_info_last_name`,
                (SELECT `victim_info_middle_name` FROM `icms_victim_info` WHERE `victim_info_id` = '" . $aParam['victim_info_id'] . "') as `victim_info_middle_name`,
                (SELECT `victim_info_dob` FROM `icms_victim_info` WHERE `victim_info_id` = '" . $aParam['victim_info_id'] . "') as `victim_info_dob`,
                (SELECT `victim_info_city_pob` FROM `icms_victim_info` WHERE `victim_info_id` = '" . $aParam['victim_info_id'] . "') as `victim_info_city_pob`,
                (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`= `victim_info_city_pob` AND `location_type_id`='5') as `city`,
                (SELECT `case_offender_name` FROM `icms_case_offender` WHERE `case_id` = `a`.`case_id`) as `case_offender_name`,
                (SELECT `employer_id` FROM `icms_case_victim_employment` WHERE `case_victim_id` = `a`.`case_victim_id`) as `employer_id`,
                (SELECT `employer_name` FROM `icms_employer` WHERE `employer_id` = `employer_id` LIMIT 1) as `employer_name`,
                (SELECT `recruitment_agency_id_local` FROM `icms_case_victim_employment` WHERE `case_victim_id` = `a`.`case_victim_id`  LIMIT 1) as `recruitment_agency_id_local`,
                (SELECT `recruitment_agency_name` FROM `icms_recruitment_agency` WHERE `recruitment_agency_id` = `recruitment_agency_id_local` LIMIT 1) as `recruitment_agency_name`,
                (SELECT `case_victim_deployment_date` FROM `icms_case_victim_deployment` WHERE `case_victim_id` = `a`.`case_victim_id`) as `case_victim_deployment_date`,
                (SELECT `case_victim_deployment_country_destination` FROM `icms_case_victim_deployment` WHERE `case_victim_id` = `a`.`case_victim_id`) as `country`
                FROM `icms_case_victim` `a`
                WHERE `a`.`case_victim_id` = '" . $aParam['case_victim_id'] . "'";

        $aResponse = $this->yel->GetRow($sql);

        return $aResponse;
    }

    public function getReportDetailsValidateById($case_id) {
        $sql = "
            SELECT                 
                `cv`.`case_victim_id` , 
                `cv`.`case_id`, 
                
                (SELECT 
                    `recruitment_agency_id_local` 
                FROM 
                    `icms_case_victim_employment` 
                WHERE 
                    `case_victim_id` = `cv`.`case_victim_id` LIMIT 1
                ) as recruitment_agency_id_local,
                
                (SELECT     
                    `recruitment_agency_name`
                 FROM 
                    `icms_recruitment_agency`
                 WHERE 
                    `recruitment_agency_id` = recruitment_agency_id_local
                 LIMIT 1 
                ) as `recruitment_agency_local_name`, 
                
                (SELECT 
                    `recruitment_agency_id_foreign` 
                FROM 
                    `icms_case_victim_employment` 
                WHERE 
                    `case_victim_id` = `cv`.`case_victim_id` LIMIT 1
                ) as recruitment_agency_id_foreign,
                
                (SELECT     
                    `recruitment_agency_name`
                 FROM 
                    `icms_recruitment_agency`
                 WHERE 
                    `recruitment_agency_id` = recruitment_agency_id_foreign
                 LIMIT 1 
                ) as `recruitment_agency_foreign_name`, 
                
                (SELECT 
                    `case_victim_deployment_country_destination`
                FROM 
                    `icms_case_victim_deployment`
                WHERE 
                    `case_victim_id` = `cv`.`case_victim_id` LIMIT 1) as `case_victim_deployment_country_destination_id`, 
                
                (SELECT 
                    `country_name`
                 FROM 
                    `icms_global_country` 
                WHERE `country_id` = `case_victim_deployment_country_destination_id` LIMIT 1 ) as `country_name`, 
                
                (SELECT `case_date_added` FROM `icms_case` WHERE `case_id` = `cv`.`case_id`) as case_filled_date, 
                (SELECT `case_added_by` FROM `icms_case` WHERE `case_id` = `cv`.`case_id`) as case_filled_by, 
                (SELECT CONCAT(`ab`.`agency_branch_name`, ' (',(SELECT `agency_abbr` FROM `icms_agency` WHERE `agency_id` = `ab`.`agency_id` LIMIT 1),')') FROM `icms_agency_branch` `ab` WHERE `ab`.`agency_branch_id` = (SELECT `agency_branch_id` FROM `icms_user` WHERE `user_id` = `case_filled_by` LIMIT 1) LIMIT 1) as `filed_by_agency`,
                
                (SELECT `case_complainant_name` FROM `icms_case_complainant` WHERE `case_victim_id` = `cv`.`case_victim_id`  LIMIT 1 ) as `case_complainant_name`, 
                (SELECT `case_complainant_date_complained` FROM `icms_case_complainant` WHERE `case_victim_id` = `cv`.`case_victim_id`  LIMIT 1 )  as `case_complainant_date_complained`
                                
            FROM
                `icms_case_victim` `cv`
            WHERE
                `cv`.`case_id` = " . $case_id . "
            ";
        $aResponse = $this->yel->GetRow($sql);
        return $aResponse;
    }

}

