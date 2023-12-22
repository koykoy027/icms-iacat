<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Service_details_model extends CI_Model {

    public function getServiceDetails($aParam) {
        $sql = "
                SELECT 
                    `cv`.`case_victim_id`,
                    `cvs`.`case_victim_services_id`,
                    `cvs`.`services_id`,
                    (SELECT `service_name` FROM `icms_services` WHERE `services_id`=`cvs`.`services_id` LIMIT 1) as `service_name`,
                    (SELECT `service_days` FROM `icms_services` WHERE `services_id`=`cvs`.`services_id` LIMIT 1) as `service_days`,
                    `cvs`.`case_victim_services_assessment_type`,
                    (SELECT 
                            `transaction_parameter_name` 
                     FROM 
                            `icms_transaction_parameter` 
                    WHERE 
                            `transaction_parameter_type_id`='8' 
                    AND `transaction_parameter_count_id`= (SELECT `service_type_id` FROM `icms_services` WHERE `services_id` = `cvs`.`services_id` LIMIT 1)
                    LIMIT 1) as `assessment_term`,
                    `cvs`.`case_victim_services_remarks`,
                    `cvs`.`case_victim_services_recommendation`,
                    `cvs`.`case_victim_services_aging_date`,
                    
                    `cvs`.`case_victim_services_departure_date`,
                    `cvs`.`case_victim_services_arrival_date`,
                    `cvsat`.`agency_branch_id`,
                    (SELECT `agency_branch_name` FROM `icms_agency_branch` WHERE `agency_branch_id`=`cvsat`.`agency_branch_id` LIMIT 1) as `agency_branch`,
                    (SELECT `agency_abbr` FROM `icms_agency` `ia`,`icms_agency_branch` `ab` WHERE `ab`.`agency_branch_id`=`cvsat`.`agency_branch_id` AND `ia`.`agency_id`=`ab`.`agency_id` LIMIT 1) as `agency_abbr`,
                    `cvsat`.`case_victim_services_agency_tag_remarks`,
                    `cvsat`.`case_victim_services_agency_tag_status`,
                    `cvsat`.`case_victim_services_agency_tag_id`,
                    `cvsat`.`case_victim_services_agency_tag_added_date`,
                    (SELECT `transaction_parameter_name` FROM `icms_transaction_parameter` WHERE `transaction_parameter_type_id`='1' AND `transaction_parameter_count_id`=`cvsat`.`case_victim_services_agency_tag_status` LIMIT 1) as `tagged_status`
                FROM    
                    `icms_case_victim` `cv`,
                    `icms_case_victim_services` `cvs`,
                    `icms_case_victim_services_agency_tag` `cvsat`
                WHERE
                    `cv`.`case_id`='" . $aParam['caseid'] . "'
                AND `cvs`.`case_victim_id`=`cv`.`case_victim_id`
                AND `cvs`.`case_victim_services_is_active`='1'
                AND `cvsat`.`case_victim_services_id`=`cvs`.`case_victim_services_id`
                AND `cvsat`.`case_victim_services_agency_tag_is_active`='1'
            ";
        $result = $this->yel->GetAll($sql);
        return $result;
    }

    public function getLisLegalServices($aParam) {
        $sql = "SELECT 
                    `cv`.`case_victim_id`,
                    `cv`.`victim_id`,
          
                     (CASE WHEN 
                        (SELECT COUNT(`victim_info_id`) FROM `icms_victim_info` WHERE `victim_id` = `cv`.`victim_id` AND `victim_info_is_assumed` = '0' AND `victim_info_is_active` = '1' LIMIT 1) > '0' 
                           THEN (SELECT `victim_info_id` FROM `icms_victim_info` WHERE `victim_id` = `cv`.`victim_id` AND `victim_info_is_assumed` = '0' AND `victim_info_is_active` = '1' LIMIT 1) 
                           WHEN (SELECT COUNT(`victim_info_id`) FROM `icms_victim_info` WHERE `victim_id` = `cv`.`victim_id` AND `victim_info_is_assumed` = '0' AND `victim_info_is_active` = '1' LIMIT 1) = '0' 
                           THEN (SELECT `victim_info_id` FROM `icms_victim_info` WHERE `victim_id` = `cv`.`victim_id` AND `victim_info_is_assumed` = '1' AND `victim_info_is_active` = '1' LIMIT 1) 
                     END) as `vict_info_id`,
                           
                     (SELECT CONCAT(`victim_info_last_name`, ', ', `victim_info_first_name`, ' ', `victim_info_middle_name`) FROM `icms_victim_info` WHERE `victim_info_id` = `vict_info_id`) as `victim_name`,      
                           
                    `cvs`.`case_victim_services_id`, 
                    `cvs`.`services_id`,
                    (SELECT `case_number` FROM `icms_case` WHERE `case_id` = `cv`.`case_id` LIMIT 1) as `case_number`,
                    (SELECT `case_added_by` FROM `icms_case` WHERE `case_id` = `cv`.`case_id` LIMIT 1) as `case_added_by`,
                    (SELECT CONCAT(`user_lastname`, ', ', `user_firstname`, ' ', `user_middlename` ) FROM `icms_user` WHERE `user_id` = `case_added_by` LIMIT 1) as `user_full_name`,
                    (SELECT `agency_id` FROM `icms_agency_branch` WHERE `agency_branch_id` = (SELECT `agency_branch_id` FROM `icms_user` WHERE `user_id` = `case_added_by` LIMIT 1)) as `agnc_id`,
                    (SELECT `agency_name` FROM `icms_agency` WHERE `agency_id` = `agnc_id` LIMIT 1) as `agency_name`,
                    (SELECT `agency_abbr` FROM `icms_agency` WHERE `agency_id` = `agnc_id` LIMIT 1) as `agency_abbr`,
                    (SELECT `case_date_added` FROM `icms_case` WHERE `case_id` = `cv`.`case_id` LIMIT 1) as `case_date_added`,
                    
                    (SELECT `service_name` FROM `icms_services` WHERE `services_id`=`cvs`.`services_id` LIMIT 1) as `service_name`,
                    (SELECT `service_days` FROM `icms_services` WHERE `services_id`=`cvs`.`services_id` LIMIT 1) as `service_days`,
                    
                    (SELECT 
                            `transaction_parameter_name` 
                     FROM 
                            `icms_transaction_parameter` 
                    WHERE 
                            `transaction_parameter_type_id`='8' 
                    AND `transaction_parameter_count_id`= (SELECT `service_type_id` FROM `icms_services` WHERE `services_id` = `cvs`.`services_id` LIMIT 1)
                    LIMIT 1) as `assessment_term`,
                    
                    (SELECT 
                            `transaction_parameter_name` 
                     FROM 
                            `icms_transaction_parameter` 
                    WHERE 
                            `transaction_parameter_type_id`='11' 
                    AND `transaction_parameter_count_id`= (SELECT `service_category` FROM `icms_services` WHERE `services_id` = `cvs`.`services_id` LIMIT 1)
                    LIMIT 1) as `assessment_cat`,
                    
                    `cvs`.`case_victim_services_remarks`,
                    `cvs`.`case_victim_services_aging_date`
            FROM    
                    `icms_case_victim` `cv`,
                    `icms_case_victim_services` `cvs`
            WHERE
               `cvs`.`case_victim_id`=`cv`.`case_victim_id`
            AND `cvs`.`case_victim_services_is_active`='1'
            AND `cvs`.`services_id` IN (SELECT `services_id` FROM `icms_services` WHERE `service_category` = 1)
            GROUP BY `cvs`.`case_victim_services_id`
            LIMIT " . $aParam['start'] . "," . $aParam['limit'] . "
            ";

        $result['listing'] = $this->yel->GetAll($sql);

        $qry = "
                SELECT
                    COUNT(1)
                 FROM    
                    `icms_case_victim` `cv`,
                    `icms_case_victim_services` `cvs`
            WHERE
               `cvs`.`case_victim_id`=`cv`.`case_victim_id`
            AND `cvs`.`case_victim_services_is_active`='1'
            AND `cvs`.`services_id` IN (SELECT `services_id` FROM `icms_services` WHERE `service_category` = 1)
               ";

        $result['count'] = $this->yel->GetOne($qry);

        return $result;
    }

    public function getServicesByServiceId($service_id) {
        $sql = " 
               SELECT 
                   `is`.`service_name`, 
                   (SELECT 
                           `transaction_parameter_name` 
                    FROM 
                           `icms_transaction_parameter` 
                   WHERE 
                           `transaction_parameter_type_id`='8' 
                   AND `transaction_parameter_count_id`= (SELECT `service_type_id` FROM `icms_services` WHERE `services_id` = `is`.`services_id` LIMIT 1)
                   LIMIT 1) as `assessment_term`
               FROM    
                       `icms_services` `is`
               WHERE
                `is`.`services_id` = " . $service_id . "
           ";
        $result = $this->yel->GetRow($sql);
        return $result;
    }

    public function getServiceStatus($aParam) {
        $sql = "  SELECT 
                    `transaction_parameter_name`,
                    `transaction_parameter_count_id`
                FROM 
                    `icms_transaction_parameter` 
                WHERE 
                    `transaction_parameter_type_id`='1' 
                AND
                    `transaction_parameter_status`='1'";
        $result = $this->yel->GetAll($sql);
        return $result;
    }

    public function setServiceDetailStatus($aParam) {
        $sql = "UPDATE 
                    `icms_case_victim_services_agency_tag`
                SET
                    `case_victim_services_agency_tag_status`='" . $aParam['stats'] . "',
                    `case_victim_services_agency_tag_remarks`='" . $aParam['remarks'] . "'
                WHERE 
                    `case_victim_services_agency_tag_id`='" . $aParam['servicetaggedid'] . "'
                ";
        $result = $this->yel->exec($sql);
        return $result;
    }

    public function setServiceDetailByTaggedID($aParam) {
        $sql = "
                SELECT 
                    `at`.`case_victim_services_agency_tag_remarks` as `Remarks`,
                    (SELECT `transaction_parameter_name` FROM `icms_transaction_parameter` WHERE `transaction_parameter_type_id`='1' AND `transaction_parameter_count_id`=`at`.`case_victim_services_agency_tag_status` LIMIT 1 ) as status
                FROM
                    `icms_case_victim_services_agency_tag` `at`
                WHERE 
                    `at`.`case_victim_services_agency_tag_is_active` = 1  AND 
                    `at`.`case_victim_services_agency_tag_id`='" . $aParam['servicetaggedid'] . "'
                LIMIT 1
                ";
        $result = $this->yel->GetRow($sql);
        return $result;
    }

    public function getArchivedLegalList($aParam) {
        $sql = "
            SELECT 
                    `cvs`.`case_victim_services_id`,
                    `cvs`.`services_id`,
                    `cv`.`case_id`, 
                    `cv`.`victim_id`, 
                    `c`.`case_number`, 
                    (SELECT `service_name` FROM `icms_services` WHERE `services_id`=`cvs`.`services_id` LIMIT 1) as `service_name`,
                    (SELECT `transaction_parameter_name` FROM `icms_transaction_parameter` `itp`,`icms_services` `is` WHERE `itp`.`transaction_parameter_type_id`='8' AND `itp`.`transaction_parameter_count_id`=`is`.`service_type_id` AND `is`.`services_id`=`cvs`.`services_id` LIMIT 1) as `service_duration`,
                    (SELECT `case_number` FROM `icms_case` WHERE `case_id` = `cv`.`case_id` LIMIT 1) as `case_number`,
                    
                    (CASE WHEN 
                        (SELECT COUNT(`victim_info_id`) FROM `icms_victim_info` WHERE `victim_id` = `cv`.`victim_id` AND `victim_info_is_assumed` = '0' AND `victim_info_is_active` = '1' LIMIT 1) > '0' 
                           THEN (SELECT `victim_info_id` FROM `icms_victim_info` WHERE `victim_id` = `cv`.`victim_id` AND `victim_info_is_assumed` = '0' AND `victim_info_is_active` = '1' LIMIT 1) 
                           WHEN (SELECT COUNT(`victim_info_id`) FROM `icms_victim_info` WHERE `victim_id` = `cv`.`victim_id` AND `victim_info_is_assumed` = '0' AND `victim_info_is_active` = '1' LIMIT 1) = '0' 
                           THEN (SELECT `victim_info_id` FROM `icms_victim_info` WHERE `victim_id` = `cv`.`victim_id` AND `victim_info_is_assumed` = '1' AND `victim_info_is_active` = '1' LIMIT 1) 
                     END) as `vict_info_id`,
                     
                    (SELECT CONCAT(`victim_info_last_name`, ', ', `victim_info_first_name`, ' ', `victim_info_middle_name`) FROM `icms_victim_info` WHERE `victim_info_id` = `vict_info_id`) as `victim_name`,   
                    
                    `cvsat`.`case_victim_services_agency_tag_id`,
                    `cvsat`.`case_victim_services_id`,
                    `cvsat`.`agency_branch_id`,
                    `cvsat`.`case_victim_services_agency_tag_status`,
                    (SELECT `transaction_parameter_name` FROM `icms_transaction_parameter` WHERE `transaction_parameter_type_id`='1' AND `transaction_parameter_count_id`= `cvsat`.`case_victim_services_agency_tag_status` LIMIT 1) as `service_status`,
                    `cvsat`.`case_victim_services_agency_tag_status`, 
                    `cvsat`.`case_victim_services_agency_tag_added_by`,
                    `cvsat`.`case_victim_services_agency_tag_added_date`,
                    `cvsat`.`case_victim_services_agency_tag_date_modified`,
                    `cvsat`.`case_victim_services_agency_tag_date_completed`                    
                FROM
                    `icms_case_victim_services` `cvs`,
                    `icms_case_victim_services_agency_tag` `cvsat`, 
                    `icms_case_victim` `cv`,
                    `icms_case` `c`
                WHERE
                    `cvs`.`case_victim_id` = `cv`.`case_victim_id`
                AND `cvs`.`case_victim_services_is_active` = 1
                AND `cvsat`.`case_victim_services_agency_tag_is_active` = 1 
                AND `cv`.`case_id` = `c`.`case_id`
                AND `cvsat`.`case_victim_services_agency_tag_status` IN (2,3)
                AND `cvsat`.`case_victim_services_id`=`cvs`.`case_victim_services_id`               
                AND `cvs`.`services_id` IN (SELECT `s`.`services_id` FROM `icms_services` `s` WHERE `s`.`service_category` = '1')
                " . $aParam['c_keyword'] . "
                ORDER BY `cvsat`.`case_victim_services_agency_tag_date_modified`
                LIMIT " . $aParam['start'] . "," . $aParam['limit'] . "
            ";

        $result['listing'] = $this->yel->GetAll($sql);

        $qry = "
                SELECT
                    COUNT(1)
                FROM
                    `icms_case_victim_services` `cvs`,
                    `icms_case_victim_services_agency_tag` `cvsat`, 
                    `icms_case_victim` `cv`,
                    `icms_case` `c`
                WHERE
                    `cvs`.`case_victim_id` = `cv`.`case_victim_id`
                AND `cvs`.`case_victim_services_is_active` = 1
                AND `cvsat`.`case_victim_services_agency_tag_is_active` = 1 
                AND `cv`.`case_id` = `c`.`case_id`
                AND `cvsat`.`case_victim_services_agency_tag_status` IN (2,3)
                AND `cvsat`.`case_victim_services_id`=`cvs`.`case_victim_services_id`               
                AND `cvs`.`services_id` IN (SELECT `s`.`services_id` FROM `icms_services` `s` WHERE `s`.`service_category` = '1')
                " . $aParam['c_keyword'] . "
               ";

        $result['count'] = $this->yel->GetOne($qry);

        return $result;
    }

    public function reOpenLegalService($aParam) {
        $sql = "
                UPDATE 
                    `icms_case_victim_services_agency_tag`
                SET
                    `case_victim_services_agency_tag_status`='" . $aParam['service_stats'] . "'
                WHERE
                    `case_victim_services_agency_tag_id`='" . $aParam['tagged_id'] . "'
              ";
        $aResult = $this->yel->exec($sql);
        return $aResult;
    }

    public function reOpenReintegrationService($aParam) {
        $sql = "
                UPDATE 
                    `icms_case_victim_services_agency_tag`
                SET
                    `case_victim_services_agency_tag_status`='" . $aParam['service_stats'] . "'
                WHERE
                    `case_victim_services_agency_tag_id`='" . $aParam['tagged_id'] . "'
              ";
        $aResult = $this->yel->exec($sql);
        return $aResult;
    }

    public function getArchivedReintegrationList($aParam) {
        $sql = "
            SELECT 
                    `cvs`.`case_victim_services_id`,
                    `cvs`.`services_id`,
                    `cv`.`case_id`, 
                    `cv`.`victim_id`, 
                    `c`.`case_number`, 
                    (SELECT `service_name` FROM `icms_services` WHERE `services_id`=`cvs`.`services_id` LIMIT 1) as `service_name`,
                    (SELECT `transaction_parameter_name` FROM `icms_transaction_parameter` `itp`,`icms_services` `is` WHERE `itp`.`transaction_parameter_type_id`='8' AND `itp`.`transaction_parameter_count_id`=`is`.`service_type_id` AND `is`.`services_id`=`cvs`.`services_id` LIMIT 1) as `service_duration`,
                    (SELECT `case_number` FROM `icms_case` WHERE `case_id` = `cv`.`case_id` LIMIT 1) as `case_number`,
                    
                    (CASE WHEN 
                        (SELECT COUNT(`victim_info_id`) FROM `icms_victim_info` WHERE `victim_id` = `cv`.`victim_id` AND `victim_info_is_assumed` = '0' AND `victim_info_is_active` = '1' LIMIT 1) > '0' 
                           THEN (SELECT `victim_info_id` FROM `icms_victim_info` WHERE `victim_id` = `cv`.`victim_id` AND `victim_info_is_assumed` = '0' AND `victim_info_is_active` = '1' LIMIT 1) 
                           WHEN (SELECT COUNT(`victim_info_id`) FROM `icms_victim_info` WHERE `victim_id` = `cv`.`victim_id` AND `victim_info_is_assumed` = '0' AND `victim_info_is_active` = '1' LIMIT 1) = '0' 
                           THEN (SELECT `victim_info_id` FROM `icms_victim_info` WHERE `victim_id` = `cv`.`victim_id` AND `victim_info_is_assumed` = '1' AND `victim_info_is_active` = '1' LIMIT 1) 
                     END) as `vict_info_id`,
                     
                    (SELECT CONCAT(`victim_info_last_name`, ', ', `victim_info_first_name`, ' ', `victim_info_middle_name`) FROM `icms_victim_info` WHERE `victim_info_id` = `vict_info_id`) as `victim_name`,   
                    
                    `cvsat`.`case_victim_services_agency_tag_id`,
                    `cvsat`.`case_victim_services_id`,
                    `cvsat`.`agency_branch_id`,
                    `cvsat`.`case_victim_services_agency_tag_status`,
                    (SELECT `transaction_parameter_name` FROM `icms_transaction_parameter` WHERE `transaction_parameter_type_id`='1' AND `transaction_parameter_count_id`= `cvsat`.`case_victim_services_agency_tag_status` LIMIT 1) as `service_status`,
                    `cvsat`.`case_victim_services_agency_tag_status`, 
                    `cvsat`.`case_victim_services_agency_tag_added_by`,
                    `cvsat`.`case_victim_services_agency_tag_added_date`,
                    `cvsat`.`case_victim_services_agency_tag_date_modified`,
                    `cvsat`.`case_victim_services_agency_tag_date_completed`                    
                FROM
                    `icms_case_victim_services` `cvs`,
                    `icms_case_victim_services_agency_tag` `cvsat`, 
                    `icms_case_victim` `cv`,
                    `icms_case` `c`
                WHERE
                    `cvs`.`case_victim_id` = `cv`.`case_victim_id`
                AND `cvs`.`case_victim_services_is_active` = 1
                AND `cvsat`.`case_victim_services_agency_tag_is_active` = 1 
                AND `cv`.`case_id` = `c`.`case_id`
                AND `cvsat`.`case_victim_services_agency_tag_status` IN (2,3)
                AND `cvsat`.`case_victim_services_id`=`cvs`.`case_victim_services_id`               
                AND `cvs`.`services_id` IN (SELECT `s`.`services_id` FROM `icms_services` `s` WHERE `s`.`service_category` = '2')
                " . $aParam['c_keyword'] . "
                ORDER BY `cvsat`.`case_victim_services_agency_tag_date_modified`
                LIMIT " . $aParam['start'] . "," . $aParam['limit'] . "
            ";

        $result['listing'] = $this->yel->GetAll($sql);

        $qry = "
                SELECT
                    COUNT(1)
                FROM
                    `icms_case_victim_services` `cvs`,
                    `icms_case_victim_services_agency_tag` `cvsat`, 
                    `icms_case_victim` `cv`,
                    `icms_case` `c`
                WHERE
                    `cvs`.`case_victim_id` = `cv`.`case_victim_id`
                AND `cvs`.`case_victim_services_is_active` = 1
                AND `cvsat`.`case_victim_services_agency_tag_is_active` = 1 
                AND `cv`.`case_id` = `c`.`case_id`
                AND `cvsat`.`case_victim_services_agency_tag_status` IN (2,3)
                AND `cvsat`.`case_victim_services_id`=`cvs`.`case_victim_services_id`               
                AND `cvs`.`services_id` IN (SELECT `s`.`services_id` FROM `icms_services` `s` WHERE `s`.`service_category` = '2')
                " . $aParam['c_keyword'] . "
               ";

        $result['count'] = $this->yel->GetOne($qry);

        return $result;
    }

}
