<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Employer_model extends CI_Model {

    public function getListEmployer($aParam) {

        $aResponse = [];

        $sList = "
                SELECT 
                    `ie`.`employer_id`,
                    `ie`.`employer_name`,
                    `ie`.`employer_representative_name`,
                    `ie`.`employer_full_address`,
                    `ie`.`employer_tel_no`,
                    `ie`.`employer_email`, 
                    `ie`.`employer_city`, 
                    (SELECT `country_name` FROM `icms_global_country` WHERE `country_id`=`ie`.`employer_country_id`) as country,
                    (SELECT COUNT(1) FROM `icms_case_victim_employment` WHERE `employer_id` = `ie`.`employer_id`) as `case_count`
                    " . $aParam['sRelevance'] . "
                FROM 
                    `icms_employer` `ie` 
                WHERE 
                    `employer_is_active` = 1 
                    " . $aParam['c_agency_employer'] . "
                    " . $aParam['cRelevance'] . "
                    " . $aParam['orderby'] . "
                LIMIT  " . $aParam['start'] . "," . $aParam['limit'] . " 
               ";

        $aResponse['list'] = $this->yel->GetAll($sList);

        $sCount = "
                SELECT
                    COUNT(1)
                FROM
                    `icms_employer` `ie`
                WHERE 
                    `ie`.`employer_is_active` = 1 
                    " . $aParam['c_agency_employer'] . "
                    " . $aParam['cRelevance'] . "
               ";
        $aResponse['count'] = $this->yel->GetOne($sCount);

        return $aResponse;
    }

    public function getEmployerDetailsByID($aParam) {
        $sql = "
                SELECT 
                    `ie`.`employer_id`,
                    `ie`.`employer_name`,
                    `ie`.`employer_country_id`,
                    `ie`.`employer_representative_name`,
                    `ie`.`employer_full_address`,
                    `ie`.`employer_tel_no`,
                    `ie`.`employer_email`, 
                    `ie`.`employer_city`, 
                    (SELECT `country_name` FROM `icms_global_country` WHERE `country_id`=`ie`.`employer_country_id`) as country
                FROM 
                    `icms_employer` `ie` 
                WHERE 
                   `ie`.`employer_id`='" . $aParam['employer_id'] . "'
                   
               ";
        $aResponse = $this->yel->GetRow($sql);
        return $aResponse;
    }

    public function setEmployerDetails($aParam) {
        $sql = "
                UPDATE `icms_employer` 
                SET
                    `employer_name`='" . $aParam['employer_name'] . "',
                    `employer_representative_name`='" . $aParam['employer_representative_name'] . "',
                    `employer_tel_no`='" . $aParam['employer_tel_no'] . "',
                    `employer_email`='" . $aParam['employer_email'] . "',
                    `employer_country_id`='" . $aParam['employer_country_id'] . "',
                    `employer_city`='" . $aParam['employer_city'] . "',
                    `employer_full_address`='" . $aParam['employer_full_address'] . "',
                    `employer_date_modified_by`='" . $aParam['user_id'] . "'
                WHERE 
                   `employer_id`='" . $aParam['employer_id'] . "'
               ";
        $aResponse = $this->yel->exec($sql);
        return $aResponse;
    }

    public function getEmployerByKeyword($aParam) {
        $sList = "
                SELECT 
                    `ie`.`employer_id`,
                    `ie`.`employer_name`,
                    `ie`.`employer_representative_name`,
                    `ie`.`employer_full_address`,
                    `ie`.`employer_tel_no`,
                    `ie`.`employer_email`, 
                    `ie`.`employer_city`, 
                    (SELECT `country_name` FROM `icms_global_country` WHERE `country_id`=`ie`.`employer_country_id`) as country,
                    (SELECT COUNT(1) FROM `icms_case_victim_employment` WHERE `employer_id` = `ie`.`employer_id`) as `case_count`,
                    MATCH (`ie`.`employer_name`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)  as relevance
                FROM 
                    `icms_employer` `ie` 
                WHERE 
                    `employer_is_active` = 1 
                  AND (MATCH (`ie`.`employer_name`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE))         
                ORDER BY `relevance`
               ";

        $aResponse = $this->yel->GetAll($sList);

        return $aResponse;
    }

}
