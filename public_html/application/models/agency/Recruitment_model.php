<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Recruitment_model extends CI_Model {

    public function getListLocalRecruitment($aParam) {
        $aResponse = [];

        $sListAll = "
                SELECT 
                    `ra`.`recruitment_agency_address`,
                    `ra`.`recruitment_agency_email`,
                    `ra`.`recruitment_agency_fax_no`,
                    `ra`.`recruitment_agency_id`,
                    `ra`.`recruitment_agency_name`,
                    `ra`.`recruitment_agency_owner_address`,
                    `ra`.`recruitment_agency_owner_contact_no`,
                    `ra`.`recruitment_agency_owner_email`,
                    `ra`.`recruitment_agency_owner_name`,
                    `ra`.`recruitment_agency_tel_no`,
                    `ra`.`recruitment_agency_website`,
                    (SELECT `country_name` FROM `icms_global_country` WHERE `country_id`=`ra`.`country_id`) as country,
                    (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`ra`.`state_id` AND `location_type_id`='4') as province,
                    (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`ra`.`state_id` AND `location_type_id`='2' AND `location_prerequisite_id`=`ra`.`country_id`) as state,
                    ( SELECT COUNT(1) FROM `icms_case_victim_employment` WHERE  `recruitment_agency_id_local` = `ra`.`recruitment_agency_id`) as `case_count`
                    " . $aParam['sRelevance'] . "
                FROM 
                    `icms_recruitment_agency` `ra`                 
                WHERE 
                    `ra`.`recruitment_agency_is_local` = 1  
                    " . $aParam['c_agency_local'] . "
                    " . $aParam['cRelevance'] . "
                    " . $aParam['orderby'] . "
                LIMIT  " . $aParam['start'] . "," . $aParam['limit'] . " 
               ";
        $aResponse['list'] = $this->yel->GetAll($sListAll);

        $sCount = "
                SELECT
                    COUNT(1)
                FROM
                    `icms_recruitment_agency`  `ra`
                WHERE 
                    `ra`.`recruitment_agency_is_local` = 1  
                    " . $aParam['c_agency_local'] . "
                    " . $aParam['cRelevance'] . "
               ";

        $aResponse['count'] = $this->yel->GetOne($sCount);

        return $aResponse;
    }

    function getListForeignRecruitment($aParam) {
        $aResponse = [];

        $sList = "
                SELECT 
                   `ra`.`recruitment_agency_address`,
                    `ra`.`recruitment_agency_email`,
                    `ra`.`recruitment_agency_fax_no`,
                    `ra`.`recruitment_agency_id`,
                    `ra`.`recruitment_agency_name`,
                    `ra`.`recruitment_agency_owner_address`,
                    `ra`.`recruitment_agency_owner_contact_no`,
                    `ra`.`recruitment_agency_owner_email`,
                    `ra`.`recruitment_agency_owner_name`,
                    `ra`.`recruitment_agency_tel_no`,
                    `ra`.`recruitment_agency_website`,
                    (SELECT `country_name` FROM `icms_global_country` WHERE `country_id`=`ra`.`country_id`) as country,
                    (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`ra`.`state_id` AND `location_type_id`='4') as province,
                    (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`ra`.`state_id` AND `location_type_id`='2' AND `location_prerequisite_id`=`ra`.`country_id`) as state,
                    ( SELECT COUNT(1) FROM `icms_case_victim_employment` WHERE  `recruitment_agency_id_local` = `ra`.`recruitment_agency_id`) as `case_count`
                    " . $aParam['sRelevance'] . "
                FROM 
                    `icms_recruitment_agency` `ra`                 
                WHERE 
                    `ra`.`recruitment_agency_is_local` = 0  
                     " . $aParam['c_agency_foreign'] . "
                    " . $aParam['cRelevance'] . "
                    " . $aParam['orderby'] . "
                LIMIT  " . $aParam['start'] . "," . $aParam['limit'] . " 
               ";
        $aResponse['list'] = $this->yel->GetAll($sList);

        $sCount = "
                SELECT
                    COUNT(1)
                FROM
                    `icms_recruitment_agency`  `ra`
                WHERE 
                    `ra`.`recruitment_agency_is_local` = 0
                    " . $aParam['c_agency_foreign'] . "
                    " . $aParam['cRelevance'] . "
               ";
        $aResponse['count'] = $this->yel->GetOne($sCount);

        return $aResponse;
    }

    public function getRecruitmentDetailsByID($aParam) {

        // get based info of recruitment agency 
        $sql = "
                SELECT 
                    * 
                FROM 
                    `icms_recruitment_agency` 
                WHERE 
                    `recruitment_agency_id`='" . $aParam['agency_id'] . "'
        ";
        $aResponse = $this->yel->GetRow($sql);

        // get owner details 
        $sql = "
                SELECT 
                   `recruitment_agency_info_name`, 
                   `recruitment_agency_info_address`, 
                   `recruitment_agency_info_contact_number`
                FROM 
                    `icms_recruitment_agency_info` 
                WHERE 
                    `recruitment_agency_id`='" . $aParam['agency_id'] . "' 
                AND `recruitment_agency_info_is_active` = '1' 
                AND `recruitment_agency_info_type_id` = '1'
        ";
        $aResponse['owner_details'] = $this->yel->GetRow($sql);

        // get representative details 
        $sql = "
                SELECT 
                   `recruitment_agency_info_name`, 
                   `recruitment_agency_info_address`, 
                   `recruitment_agency_info_contact_number`
                FROM 
                    `icms_recruitment_agency_info` 
                WHERE 
                    `recruitment_agency_id`='" . $aParam['agency_id'] . "' 
                AND `recruitment_agency_info_is_active` = '1' 
                AND `recruitment_agency_info_type_id` = '2'
        ";
        $aResponse['rep_details'] = $this->yel->GetRow($sql);

        // get agent details 
        $sql = "
                SELECT 
                   `recruitment_agency_info_name`, 
                   `recruitment_agency_info_address`, 
                   `recruitment_agency_info_contact_number`
                FROM 
                    `icms_recruitment_agency_info` 
                WHERE 
                    `recruitment_agency_id`='" . $aParam['agency_id'] . "' 
                AND `recruitment_agency_info_is_active` = '1' 
                AND `recruitment_agency_info_type_id` = '3'
        ";
        $aResponse['agent_details'] = $this->yel->GetRow($sql);

        return $aResponse;
    }

    public function setRecruitmentAgencyDetails($aParam) {
        $sql = "
                    UPDATE `icms_recruitment_agency`
                    SET
                        `recruitment_agency_name`='" . $aParam['agency_name'] . "',
                        `recruitment_agency_address`='" . $aParam['agency_address'] . "',
                        `recruitment_agency_tel_no`='" . $aParam['agency_tel'] . "',
                        `recruitment_agency_email`='" . $aParam['agency_email'] . "',
                        `recruitment_agency_fax_no`='" . $aParam['agency_fax'] . "',
                        `recruitment_agency_website`='" . $aParam['agency_website'] . "',
                        `country_id`='" . $aParam['agency_country'] . "',
                        `state_id`='" . $aParam['agency_state'] . "',
                        `recruitment_agency_owner_name`='" . $aParam['agency_owner'] . "',
                        `recruitment_agency_owner_address`='" . $aParam['agency_owner_address'] . "',
                        `recruitment_agency_owner_contact_no`='" . $aParam['agency_owner_contact'] . "',
                        `recruitment_agency_owner_email`='" . $aParam['agency_owner_email'] . "',
                        `recruitment_agency_is_local`='" . $aParam['agency_type'] . "',
                        `recruitment_agency_modified_by`='" . $aParam['user_id'] . "'
                   WHERE
                        `recruitment_agency_id`='" . $aParam['agency_id'] . "'
               ";
        $aResponse = $this->yel->exec($sql);
        return $aResponse;
    }

    public function getRecruitmentAgencyDetails($aParam) {
        $sql = "
                    SELECT
                        `ra`.`recruitment_agency_name`,
                        `ra`.`recruitment_agency_address`,
                        `ra`.`recruitment_agency_tel_no`,
                        `ra`.`recruitment_agency_email`,
                        `ra`.`recruitment_agency_fax_no`,
                        `ra`.`recruitment_agency_website`,
                        (SELECT `country_name` FROM `icms_global_country`  WHERE `country_id` = `ra`.`country_id` LIMIT 1  ) as `country_name`, 
                        (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`ra`.`state_id` AND `location_type_id`='2' AND `location_prerequisite_id`=`ra`.`country_id` LIMIT 1) as state,
                        `ra`.`recruitment_agency_owner_name`,
                        `ra`.`recruitment_agency_owner_address`,
                        `ra`.`recruitment_agency_owner_contact_no`,
                        `ra`.`recruitment_agency_owner_email`,
                        (SELECT CASE WHEN `ra`.`recruitment_agency_is_local`='1' THEN 'Local Agency' ELSE 'Foreign Agency' END) as `recruitment_type`
                    FROM
                        `icms_recruitment_agency`  `ra` 
                    WHERE
                        `recruitment_agency_id`='" . $aParam['agency_id'] . "'
                    LIMIT 1
               ";

        $aResponse = $this->yel->GetRow($sql);
        return $aResponse;
    }

    public function getLocalRecruitmentByKeyword($aParam) {
        $aResponse = [];

        $sList = "
                SELECT 
                    `ra`.`recruitment_agency_address`,
                    `ra`.`recruitment_agency_email`,
                    `ra`.`recruitment_agency_fax_no`,
                    `ra`.`recruitment_agency_id`,
                    `ra`.`recruitment_agency_name`,
                    `ra`.`recruitment_agency_tel_no`,
                    `ra`.`recruitment_agency_website`,
                    (SELECT `country_name` FROM `icms_global_country` WHERE `country_id`=`ra`.`country_id`) as country,
                    (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`ra`.`state_id` AND `location_type_id`='4') as province,
                    (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`ra`.`state_id` AND `location_type_id`='2' AND `location_prerequisite_id`=`ra`.`country_id`) as state,
                    ( SELECT COUNT(1) FROM `icms_case_victim_employment` WHERE  `recruitment_agency_id_local` = `ra`.`recruitment_agency_id`) as `case_count`, 
                    MATCH (`ra`.`recruitment_agency_name`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)  as relevance 
                FROM 
                    `icms_recruitment_agency` `ra`                 
                WHERE 
                    `ra`.`recruitment_agency_is_local` = 1  
                AND (MATCH (`ra`.`recruitment_agency_name`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE))           
                    ORDER BY relevance
               ";

        $aResponse = $this->yel->GetAll($sList);


        return $aResponse;
    }

    public function getForeignRecruitmentByKeyword($aParam) {
        $aResponse = [];

        $sList = "
                SELECT 
                    `ra`.`recruitment_agency_address`,
                    `ra`.`recruitment_agency_email`,
                    `ra`.`recruitment_agency_fax_no`,
                    `ra`.`recruitment_agency_id`,
                    `ra`.`recruitment_agency_name`,
                    `ra`.`recruitment_agency_tel_no`,
                    `ra`.`recruitment_agency_website`,
                    (SELECT `country_name` FROM `icms_global_country` WHERE `country_id`=`ra`.`country_id`) as country,
                    (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`ra`.`state_id` AND `location_type_id`='4') as province,
                    (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`ra`.`state_id` AND `location_type_id`='2' AND `location_prerequisite_id`=`ra`.`country_id`) as state,
                    ( SELECT COUNT(1) FROM `icms_case_victim_employment` WHERE  `recruitment_agency_id_local` = `ra`.`recruitment_agency_id`) as `case_count`, 
                    MATCH (`ra`.`recruitment_agency_name`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)  as relevance 
                FROM 
                    `icms_recruitment_agency` `ra`                 
                WHERE 
                    `ra`.`recruitment_agency_is_local` = 0
                AND (MATCH (`ra`.`recruitment_agency_name`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE))           
                    ORDER BY relevance
               ";

        $aResponse = $this->yel->GetAll($sList);


        return $aResponse;
    }

}
