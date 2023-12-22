<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Temporary_case_model extends CI_Model {

    public function getTemporaryCaseByStatus($aParam) {

        $result = [];
        $result['count'] = '';
        $result['listing'] = '';

        $sql = "
        SELECT 
        `itc`.*, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='31' AND `parameter_count_id`=`itc`.`temporary_complainant_relation`) as `relation_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='30' AND `parameter_count_id`=`itc`.`temporary_complainant_preffered_contact_method`) as `contact_method_name`, 
        (SELECT `country_name` FROM `icms_global_country` WHERE `country_id`=`itc`.`temporary_victim_country_deployment`) as `country_deployment_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='3' AND `parameter_count_id`=`itc`.`temporary_victim_civil_status`) as `civil_status_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='5' AND `parameter_count_id`=`itc`.`temporary_victim_departure_type`) as `departure_type_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='9' AND `parameter_count_id`=`itc`.`temporary_victim_sex`) as `sex_name`, 
        (SELECT `transaction_parameter_name` FROM `icms_transaction_parameter` WHERE `transaction_parameter_type_id`='12' AND `transaction_parameter_count_id`=`itc`.`temporary_case_status_id`) as `temporary_case_status_name` 
        FROM
        `icms_temporary_case` `itc` 
        WHERE 
        `itc`.`temporary_case_id` IS NOT NULL  
        " . $aParam['cRelevance'] . "
        " . $aParam['cOrderBy'] . "
        LIMIT " . $aParam['start'] . "," . $aParam['limit'] . "
        ";

        $sqlCount = "
        SELECT 
        COUNT(1)
        FROM 
        `icms_temporary_case` as `itc` 
        WHERE
        `itc`.`temporary_case_id` IS NOT NULL
        " . $aParam['cRelevance'] . "
        ";
//        echo($sSequelListing);
        $result['count'] = $this->yel->GetOne($sqlCount);
        $result['listing'] = $this->yel->GetAll($sql);

        // print_r($sqlCount);
        return $result;
    }

    public function getAllTemporaryCaseList($aParam) {

        $result = [];
        $result['count'] = '';
        $result['listing'] = '';

        $sql = "
            SELECT 
            `itc`.*, 
            (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='31' AND `parameter_count_id`=`itc`.`temporary_complainant_relation`) as `relation_name`, 
            (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='30' AND `parameter_count_id`=`itc`.`temporary_complainant_preffered_contact_method`) as `contact_method_name`, 
            (SELECT `country_name` FROM `icms_global_country` WHERE `country_id`=`itc`.`temporary_victim_country_deployment`) as `country_deployment_name`, 
            (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='3' AND `parameter_count_id`=`itc`.`temporary_victim_civil_status`) as `civil_status_name`, 
            (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='5' AND `parameter_count_id`=`itc`.`temporary_victim_departure_type`) as `departure_type_name`, 
            (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='9' AND `parameter_count_id`=`itc`.`temporary_victim_sex`) as `sex_name`, 
            (SELECT `transaction_parameter_name` FROM `icms_transaction_parameter` WHERE `transaction_parameter_type_id`='12' AND `transaction_parameter_count_id`=`itc`.`temporary_case_status_id`) as `temporary_case_status_name` 
            FROM
            `icms_temporary_case` `itc` 
            WHERE 
            `itc`.`temporary_case_status_id` IS NOT NULL
            " . $aParam['cFilter'] . "
            " . $aParam['cRelevance'] . "
            " . $aParam['cOrderBy'] . "
            LIMIT " . $aParam['start'] . "," . $aParam['limit'] . "
        ";

        $sqlCount = "
            SELECT 
            COUNT(1)
            FROM 
            `icms_temporary_case` as `itc` 
            WHERE
            `itc`.`temporary_case_status_id` IS NOT NULL
            " . $aParam['cFilter'] . "
            " . $aParam['cRelevance'] . "
        ";
        $result['count'] = $this->yel->GetOne($sqlCount);
        $result['listing'] = $this->yel->GetAll($sql);
        return $result;
    }
    
     public function getPendingTemporaryCases($aParam) {

        // $sql = "
        // SELECT 
        // * 
        // FROM
        // `icms_temporary_case` `itc` 
        // WHERE
        // `itc`.`temporary_case_status_id`= '1' 
        // ";

        $result = [];
        $result['count'] = '';
        $result['listing'] = '';

        $sql = "
        SELECT 
        `itc`.*, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='31' AND `parameter_count_id`=`itc`.`temporary_complainant_relation`) as `relation_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='30' AND `parameter_count_id`=`itc`.`temporary_complainant_preffered_contact_method`) as `contact_method_name`, 
        (SELECT `country_name` FROM `icms_global_country` WHERE `country_id`=`itc`.`temporary_victim_country_deployment`) as `country_deployment_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='3' AND `parameter_count_id`=`itc`.`temporary_victim_civil_status`) as `civil_status_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='5' AND `parameter_count_id`=`itc`.`temporary_victim_departure_type`) as `departure_type_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='9' AND `parameter_count_id`=`itc`.`temporary_victim_sex`) as `sex_name`, 
        (SELECT `transaction_parameter_name` FROM `icms_transaction_parameter` WHERE `transaction_parameter_type_id`='12' AND `transaction_parameter_count_id`=`itc`.`temporary_case_status_id`) as `temporary_case_status_name` 
        FROM
        `icms_temporary_case` `itc` 
        WHERE 
        `itc`.`temporary_case_status_id` = '1' 
        " . $aParam['cFilter'] . "
        " . $aParam['cRelevance'] . "
        " . $aParam['cOrderBy'] . "
        LIMIT " . $aParam['start'] . "," . $aParam['limit'] . "
        ";

        $sqlCount = "
        SELECT 
        COUNT(1)
        FROM 
        `icms_temporary_case` as `itc` 
        WHERE
        `itc`.`temporary_case_status_id` = '1' 
        " . $aParam['cFilter'] . "
        " . $aParam['cRelevance'] . "
        ";
//        echo($sSequelListing);
        $result['count'] = $this->yel->GetOne($sqlCount);
        $result['listing'] = $this->yel->GetAll($sql);

        // print_r($sqlCount);
        return $result;
    }

    public function getForVerificationTemporaryCases($aParam) {

        // $sql = "
        // SELECT 
        // * 
        // FROM
        // `icms_temporary_case` `itc` 
        // WHERE
        // `itc`.`temporary_case_status_id`= '2' 
        // ";

        $result = [];
        $result['count'] = '';
        $result['listing'] = '';

        $sql = "
        SELECT 
        `itc`.*, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='31' AND `parameter_count_id`=`itc`.`temporary_complainant_relation`) as `relation_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='30' AND `parameter_count_id`=`itc`.`temporary_complainant_preffered_contact_method`) as `contact_method_name`, 
        (SELECT `country_name` FROM `icms_global_country` WHERE `country_id`=`itc`.`temporary_victim_country_deployment`) as `country_deployment_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='3' AND `parameter_count_id`=`itc`.`temporary_victim_civil_status`) as `civil_status_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='5' AND `parameter_count_id`=`itc`.`temporary_victim_departure_type`) as `departure_type_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='9' AND `parameter_count_id`=`itc`.`temporary_victim_sex`) as `sex_name`, 
        (SELECT `transaction_parameter_name` FROM `icms_transaction_parameter` WHERE `transaction_parameter_type_id`='12' AND `transaction_parameter_count_id`=`itc`.`temporary_case_status_id`) as `temporary_case_status_name` 
        FROM
        `icms_temporary_case` `itc` 
        WHERE 
        `itc`.`temporary_case_status_id` = '2' 
        " . $aParam['cRelevance'] . "
        " . $aParam['cFilter'] . "
        " . $aParam['cOrderBy'] . "
        LIMIT " . $aParam['start'] . "," . $aParam['limit'] . "
        ";

        $sqlCount = "
        SELECT 
        COUNT(1)
        FROM 
        `icms_temporary_case` as `itc` 
        WHERE
        `itc`.`temporary_case_status_id` = '2' 
        " . $aParam['cFilter'] . "
        " . $aParam['cRelevance'] . "
        ";
//        echo($sSequelListing);
        $result['count'] = $this->yel->GetOne($sqlCount);
        $result['listing'] = $this->yel->GetAll($sql);

        // print_r($sqlCount);
        return $result;
    }

    public function getAddedToCaseTemporaryCases($aParam) {
        // $sql = "
        // SELECT 
        // * 
        // FROM
        // `icms_temporary_case` `itc` 
        // WHERE
        // `itc`.`temporary_case_status_id`= '3' 
        // ";

        $result = [];
        $result['count'] = '';
        $result['listing'] = '';

        $sql = "
        SELECT 
        `itc`.*, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='31' AND `parameter_count_id`=`itc`.`temporary_complainant_relation`) as `relation_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='30' AND `parameter_count_id`=`itc`.`temporary_complainant_preffered_contact_method`) as `contact_method_name`, 
        (SELECT `country_name` FROM `icms_global_country` WHERE `country_id`=`itc`.`temporary_victim_country_deployment`) as `country_deployment_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='3' AND `parameter_count_id`=`itc`.`temporary_victim_civil_status`) as `civil_status_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='5' AND `parameter_count_id`=`itc`.`temporary_victim_departure_type`) as `departure_type_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='9' AND `parameter_count_id`=`itc`.`temporary_victim_sex`) as `sex_name`, 
        (SELECT `transaction_parameter_name` FROM `icms_transaction_parameter` WHERE `transaction_parameter_type_id`='12' AND `transaction_parameter_count_id`=`itc`.`temporary_case_status_id`) as `temporary_case_status_name` 
        FROM
        `icms_temporary_case` `itc` 
        WHERE 
        `itc`.`temporary_case_status_id` = '3' 
        " . $aParam['cRelevance'] . "
        " . $aParam['cFilter'] . "
        " . $aParam['cOrderBy'] . "
        LIMIT " . $aParam['start'] . "," . $aParam['limit'] . "
        ";

        $sqlCount = "
        SELECT 
        COUNT(1)
        FROM 
        `icms_temporary_case` as `itc` 
        WHERE
        `itc`.`temporary_case_status_id` = '3' 
        " . $aParam['cRelevance'] . "
        " . $aParam['cFilter'] . "
        ";
//        echo($sSequelListing);
        $result['count'] = $this->yel->GetOne($sqlCount);
        $result['listing'] = $this->yel->GetAll($sql);

        // print_r($sqlCount);
        return $result;
    }

    public function getArchivedTemporaryCases($aParam) {
        // $sql = "
        // SELECT 
        // * 
        // FROM
        // `icms_temporary_case` `itc` 
        // WHERE
        // `itc`.`temporary_case_status_id`= '4' 
        // ";

        $result = [];
        $result['count'] = '';
        $result['listing'] = '';

        $sql = "
        SELECT 
        `itc`.*, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='31' AND `parameter_count_id`=`itc`.`temporary_complainant_relation`) as `relation_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='30' AND `parameter_count_id`=`itc`.`temporary_complainant_preffered_contact_method`) as `contact_method_name`, 
        (SELECT `country_name` FROM `icms_global_country` WHERE `country_id`=`itc`.`temporary_victim_country_deployment`) as `country_deployment_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='3' AND `parameter_count_id`=`itc`.`temporary_victim_civil_status`) as `civil_status_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='5' AND `parameter_count_id`=`itc`.`temporary_victim_departure_type`) as `departure_type_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='9' AND `parameter_count_id`=`itc`.`temporary_victim_sex`) as `sex_name`, 
        (SELECT `transaction_parameter_name` FROM `icms_transaction_parameter` WHERE `transaction_parameter_type_id`='12' AND `transaction_parameter_count_id`=`itc`.`temporary_case_status_id`) as `temporary_case_status_name` 
        FROM
        `icms_temporary_case` `itc` 
        WHERE 
        `itc`.`temporary_case_status_id` = '4' 
        " . $aParam['cRelevance'] . "
        " . $aParam['cFilter'] . "
        " . $aParam['cOrderBy'] . "
        LIMIT " . $aParam['start'] . "," . $aParam['limit'] . "
        ";

        $sqlCount = "
        SELECT 
        COUNT(1)
        FROM 
        `icms_temporary_case` as `itc` 
        WHERE
        `itc`.`temporary_case_status_id` = '4' 
        " . $aParam['cFilter'] . "
        " . $aParam['cRelevance'] . "
        ";

        $result['count'] = $this->yel->GetOne($sqlCount);
        $result['listing'] = $this->yel->GetAll($sql);

        return $result;
    }

    public function getTemporaryCaseByTemporaryCaseId($aParam) {
        $sql = "
        SELECT 
        `itc`.*, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='31' AND `parameter_count_id`=`itc`.`temporary_complainant_relation`) as `relation_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='30' AND `parameter_count_id`=`itc`.`temporary_complainant_preffered_contact_method`) as `contact_method_name`, 
        (SELECT `country_name` FROM `icms_global_country` WHERE `country_id`=`itc`.`temporary_victim_country_deployment`) as `country_deployment_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='3' AND `parameter_count_id`=`itc`.`temporary_victim_civil_status`) as `civil_status_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='5' AND `parameter_count_id`=`itc`.`temporary_victim_departure_type`) as `departure_type_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='9' AND `parameter_count_id`=`itc`.`temporary_victim_sex`) as `sex_name`, 
        (SELECT `transaction_parameter_name` FROM `icms_transaction_parameter` WHERE `transaction_parameter_type_id`='12' AND `transaction_parameter_count_id`=`itc`.`temporary_case_status_id`) as `temporary_case_status_name` 
        FROM
        `icms_temporary_case` `itc` 
        WHERE
        `itc`.`temporary_case_id`= '" . $aParam['temporary_case_id'] . "' 
        ";

        $result = $this->yel->GetRow($sql);
        return $result;
    }

    public function getTemporaryCaseByCaseId($aParam) {
        $sql = "
        SELECT 
        `itc`.*, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='31' AND `parameter_count_id`=`itc`.`temporary_complainant_relation`) as `relation_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='30' AND `parameter_count_id`=`itc`.`temporary_complainant_preffered_contact_method`) as `contact_method_name`, 
        (SELECT `country_name` FROM `icms_global_country` WHERE `country_id`=`itc`.`temporary_victim_country_deployment`) as `country_deployment_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='3' AND `parameter_count_id`=`itc`.`temporary_victim_civil_status`) as `civil_status_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='5' AND `parameter_count_id`=`itc`.`temporary_victim_departure_type`) as `departure_type_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='9' AND `parameter_count_id`=`itc`.`temporary_victim_sex`) as `sex_name`, 
        (SELECT `transaction_parameter_name` FROM `icms_transaction_parameter` WHERE `transaction_parameter_type_id`='12' AND `transaction_parameter_count_id`=`itc`.`temporary_case_status_id`) as `temporary_case_status_name` 
        FROM
        `icms_temporary_case` `itc` 
        WHERE
        `itc`.`case_id`= '" . $aParam['case_id'] . "' 
        ";
        // exit($sql);
        $result = $this->yel->GetRow($sql);
        return $result;
    }

    public function getTemporaryCaseByCaseVictimId($aParam) {
        $sql = "
        SELECT 
        `itc`.*, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='31' AND `parameter_count_id`=`itc`.`temporary_complainant_relation`) as `relation_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='30' AND `parameter_count_id`=`itc`.`temporary_complainant_preffered_contact_method`) as `contact_method_name`, 
        (SELECT `country_name` FROM `icms_global_country` WHERE `country_id`=`itc`.`temporary_victim_country_deployment`) as `country_deployment_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='3' AND `parameter_count_id`=`itc`.`temporary_victim_civil_status`) as `civil_status_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='5' AND `parameter_count_id`=`itc`.`temporary_victim_departure_type`) as `departure_type_name`, 
        (SELECT `parameter_name` FROM `icms_global_parameter` WHERE `parameter_type_id`='9' AND `parameter_count_id`=`itc`.`temporary_victim_sex`) as `sex_name`, 
        (SELECT `transaction_parameter_name` FROM `icms_transaction_parameter` WHERE `transaction_parameter_type_id`='12' AND `transaction_parameter_count_id`=`itc`.`temporary_case_status_id`) as `temporary_case_status_name` 
        FROM
        `icms_temporary_case` `itc` 
        WHERE
        `itc`.`case_id`= (SELECT `icv`.`case_id` FROM `icms_case_victim` `icv` WHERE  `case_victim_id` = '" . $aParam['case_victim_id'] . "') 
        ";
        // exit($sql);
        $result = $this->yel->GetRow($sql);
        return $result;
    }

    public function getTemporaryCaseNumberByTemporaryCaseId($aParam) {
        $sql = "
        SELECT 
        `temporary_case_number` 
        FROM 
        `icms_temporary_case` 
        WHERE 
        `temporary_case_id` = '" . $aParam['temporary_case_id'] . "' 
        ";

        $result = $this->yel->getOne($sql);
        return $result;
    }

    public function getTemporaryCaseNumberByTemporaryCaseRemarksId($aParam) {
        $sql = "
        SELECT 
        `itc`.`temporary_case_number` 
        FROM 
        `icms_temporary_case` `itc`, 
        `icms_temporary_case_remarks` `itcr`  
        WHERE 
        `itcr`.`temporary_case_remarks_id` = '" . $aParam['temporary_case_remarks_id'] . "'  
        AND 
        `itcr`.`temporary_case_id` = `itc`.`temporary_case_id` 
        ";

        $result = $this->yel->getOne($sql);
        return $result;
    }

    public function getTemporaryCaseIdByTemporaryCaseRemarksId($aParam) {
        $sql = "
        SELECT 
        `itc`.`temporary_case_id` 
        FROM 
        `icms_temporary_case` `itc`, 
        `icms_temporary_case_remarks` `itcr`  
        WHERE 
        `itcr`.`temporary_case_remarks_id` = '" . $aParam['temporary_case_remarks_id'] . "'  
        AND 
        `itcr`.`temporary_case_id` = `itc`.`temporary_case_id` 
        ";

        $result = $this->yel->getOne($sql);
        return $result;
    }

    public function updateComplainantInfoByTemporaryCaseId($aParam) {
        $sql = "
        UPDATE 
        `icms_temporary_case` 
        SET 
        `temporary_complainant_firstname` = '" . $aParam['temporary_complainant_firstname'] . "', 
        `temporary_complainant_middlename` = '" . $aParam['temporary_complainant_middlename'] . "', 
        `temporary_complainant_lastname` = '" . $aParam['temporary_complainant_lastname'] . "', 
        `temporary_complainant_mobile_number` = '" . $aParam['temporary_complainant_mobile_number'] . "', 
        `temporary_complainant_email_address` = '" . $aParam['temporary_complainant_email_address'] . "', 
        `temporary_complainant_relation` = '" . $aParam['temporary_complainant_relation'] . "', 
        `temporary_complainant_relation_other` = '" . $aParam['temporary_complainant_relation_other'] . "', 
        `temporary_complainant_address` = '" . $aParam['temporary_complainant_address'] . "', 
        `temporary_complainant_preffered_contact_method` = '" . $aParam['temporary_complainant_preffered_contact_method'] . "', 
        `temporary_complainant_complain` = '" . $aParam['temporary_complainant_complain'] . "', 
        `temporary_case_date_updated` = now(), 
        `temporary_case_updated_by` = '" . $aParam['temporary_case_updated_by'] . "' 
        WHERE 
        `temporary_case_id` = '" . $aParam['temporary_case_id'] . "' 
        ";

        $result = $this->yel->exec($sql);
        return $result;
    }

    public function updateVictimInfoByTemporaryCaseId($aParam) {
        $sql = "
        UPDATE 
        `icms_temporary_case` 
        SET 
        `temporary_victim_firstname` = '" . $aParam['temporary_victim_firstname'] . "', 
        `temporary_victim_middlename` = '" . $aParam['temporary_victim_middlename'] . "', 
        `temporary_victim_lastname` = '" . $aParam['temporary_victim_lastname'] . "', 
        `temporary_victim_suffix` = '" . $aParam['temporary_victim_suffix'] . "', 
        `temporary_victim_dob` = '" . $aParam['temporary_victim_dob'] . "', 
        `temporary_victim_email_address` = '" . $aParam['temporary_victim_email_address'] . "', 
        `temporary_victim_mobile_number` = '" . $aParam['temporary_victim_mobile_number'] . "', 
        `temporary_victim_country_deployment` = '" . $aParam['temporary_victim_country_deployment'] . "', 
        `temporary_victim_civil_status` = '" . $aParam['temporary_victim_civil_status'] . "', 
        `temporary_victim_departure_type` = '" . $aParam['temporary_victim_departure_type'] . "', 
        `temporary_victim_sex` = '" . $aParam['temporary_victim_sex'] . "', 
        `temporary_victim_address` = '" . $aParam['temporary_victim_address'] . "', 
        `temporary_case_date_updated` = now(), 
        `temporary_case_updated_by` = '" . $aParam['temporary_case_updated_by'] . "' 
        WHERE 
        `temporary_case_id` = '" . $aParam['temporary_case_id'] . "' 
        ";

        $result = $this->yel->exec($sql);
        return $result;
    }

    public function getTemporaryCaseRemarksByTemporaryCaseId($aParam) {

        $sql = "
                SELECT 
                *, `itcr`.`temporary_case_remarks_date_added` as `date_added` , 
                'remarks' as log_type
                FROM
                `icms_temporary_case_remarks` `itcr` 
                WHERE
                `itcr`.`temporary_case_id`= '" . $aParam['temporary_case_id'] . "'
                 AND  `itcr`.`is_active` = 1
                ORDER BY `temporary_case_remarks_id` DESC 
                ";

        $result = $this->yel->GetAll($sql);

        return $result;
    }

    public function AddTemporaryCaseRemarksByUser($aParam) {
        $sql = "
        INSERT INTO 
        `icms_temporary_case_remarks` 
        SET 
        `temporary_case_id`='" . $aParam['temporary_case_id'] . "', 
        `temporary_case_remarks`='" . $aParam['temporary_case_remarks'] . "', 
        `temporary_case_remarks_date_added`= now(), 
        `temporary_case_remarks_added_by`='" . $aParam['temporary_case_remarks_added_by'] . "', 
        `temporary_case_remarks_date_updated`=now(), 
        `temporary_case_remarks_updated_by` = '" . $aParam['temporary_case_remarks_added_by'] . "', 
        `is_active`='1', 
        `is_editable`='1', 
        `is_system_generated`='0' 
        ";

        $result = $this->yel->exec($sql);
        return $result;
    }

    public function AddTemporaryCaseRemarksBySystem($aParam) {
        $sql = "
        INSERT INTO 
        `icms_temporary_case_remarks` 
        SET 
        `temporary_case_id`='" . $aParam['temporary_case_id'] . "', 
        `temporary_case_remarks`='" . $aParam['temporary_case_remarks'] . "', 
        `temporary_case_remarks_date_added`= now(), 
        `temporary_case_remarks_added_by`='" . $aParam['temporary_case_remarks_added_by'] . "', 
        `temporary_case_remarks_date_updated`=now(), 
        `temporary_case_remarks_updated_by` = '" . $aParam['temporary_case_remarks_added_by'] . "', 
        `is_active`='1', 
        `is_editable`='0', 
        `is_system_generated`='1' 
        ";

        $result = $this->yel->exec($sql);
        return $result;
    }

    public function updateTemporaryCaseRemarks($aParam) {
        $sql = "
        UPDATE  
        `icms_temporary_case_remarks` 
        SET 
        `temporary_case_remarks`='" . $aParam['temporary_case_remarks'] . "', 
        `temporary_case_remarks_updated_by`='" . $aParam['temporary_case_remarks_updated_by'] . "', 
        `temporary_case_remarks_date_updated`=now() 
        WHERE 
        `temporary_case_remarks_id` = '" . $aParam['temporary_case_remarks_id'] . "' 
        ";

        $result = $this->yel->exec($sql);
        return $result;
    }
    
    public function deleteTemporaryCaseRemarks($aParam) {
        $sql = "
        UPDATE  
        `icms_temporary_case_remarks` 
        SET 
        `is_active`= 0, 
        `temporary_case_remarks_updated_by`='" . $aParam['temporary_case_remarks_updated_by'] . "', 
        `temporary_case_remarks_date_updated`=now() 
        WHERE 
        `temporary_case_remarks_id` = '" . $aParam['temporary_case_remarks_id'] . "' 
        ";
        $result = $this->yel->exec($sql);
        return $result;
    }

    public function addTemporaryCaseAccessLog($aParam) {
        $sql = "
            INSERT INTO 
            `icms_temporary_case_access_logs` 
            SET 
            `temporary_case_id` = '" . $aParam['temporary_case_id'] . "', 
            `temporary_case_access_log_description` = '" . $aParam['temporary_case_access_log_description'] . "', 
            `temporary_case_access_log_date_added` = now() 
        ";
        $result = $this->yel->exec($sql);
        return $result;
    }

    public function updateTemporaryCaseStatusById($aParam) {
        $sql = "
        UPDATE  
        `icms_temporary_case` 
        SET 
        `temporary_case_status_id` = '" . $aParam['temporary_case_status_id'] . "', 
        `temporary_case_date_updated` = now() 
        WHERE 
        `temporary_case_id` = '" . $aParam['temporary_case_id'] . "' 
        ";

        $result = $this->yel->exec($sql);
        return $result;
    }

    public function getTemporaryCaseAccessLogsByTemporaryCaseId($aParam) {

        $sql = "
                SELECT 
                *, `itcal`.`temporary_case_access_log_date_added` as `date_added` 
                FROM
                `icms_temporary_case_access_logs` `itcal` 
                WHERE
                `itcal`.`temporary_case_id`= '" . $aParam['temporary_case_id'] . "'
                ORDER BY `temporary_case_access_log_id` DESC 
                ";
        // exit($sql);
        $result = $this->yel->GetAll($sql);

        return $result;
    }

    public function getServices($aParam) {

        $sql = "
            SELECT
                `cvs`.`case_victim_services_id`,
                `cvs`.`services_id`,
                (SELECT `service_name` FROM `icms_services` WHERE `services_id`=`cvs`.`services_id` LIMIT 1) as `service_name`,
                (SELECT `transaction_parameter_name` FROM `icms_transaction_parameter` `itp`,`icms_services` `is` WHERE `itp`.`transaction_parameter_type_id`='8' AND `itp`.`transaction_parameter_count_id`=`is`.`service_type_id` AND `is`.`services_id`=`cvs`.`services_id` LIMIT 1) as `service_duration`,
                `cvsat`.`case_victim_services_agency_tag_id`,
                `cvsat`.`case_victim_services_id`,
                `cvsat`.`agency_branch_id`,
                (
                    SELECT CONCAT(`ia`.`agency_name`, ' - ' , `iab`.`agency_branch_name`)
                    FROM `icms_agency_branch` `iab`, `icms_agency` `ia` 
                    WHERE  `iab`.`agency_id` = `ia`.`agency_id`
                    AND `iab`.`agency_branch_id` = `cvsat`.`agency_branch_id`
                    LIMIT 1
                ) as agency_branch_name,
                `cvsat`.`case_victim_services_agency_tag_status`,
                (SELECT `transaction_parameter_name` FROM `icms_transaction_parameter` WHERE `transaction_parameter_type_id`='1' AND `transaction_parameter_count_id`=`cvsat`.`case_victim_services_agency_tag_status` LIMIT 1) as `service_status`,
                `cvsat`.`case_victim_services_agency_tag_added_by`,
                `cvsat`.`case_victim_services_agency_tag_added_date`, 
                `cvsat`.`case_victim_services_agency_tag_added_date` as temporary_case_remarks_date_added, 
                `cvsat`.`case_victim_services_agency_tag_date_modified`,
                `cvsat`.`case_victim_services_agency_tag_date_completed`, 
                `cvs`.`case_victim_services_id` as temporary_case_remarks_id, 
                '" . $aParam['temporary_case_id'] . "' as temporary_case_id, 
                'service' as log_type, 
                (SELECT 
                `is`.`service_category` 
                FROM `icms_services` `is`
                WHERE `is`.`services_id` = `cvs`.`services_id`
                LIMIT 1 ) as `service_category_type`
            FROM
                `icms_case_victim_services` `cvs`,
                `icms_case_victim_services_agency_tag` `cvsat`
            WHERE
                `cvs`.`case_victim_id` =  (SELECT
                                                `case_victim_id`
                                            FROM `icms_case_victim`
                                            WHERE `case_id` = (SELECT `case_id`
                                                                    FROM `icms_temporary_case`
                                                                    WHERE `temporary_case_id` = '" . $aParam['temporary_case_id'] . "' LIMIT 1)
                                            LIMIT 1)
            AND `cvs`.`case_victim_services_is_active` = 1
            AND `cvsat`.`case_victim_services_agency_tag_is_active` = 1
            AND `cvsat`.`case_victim_services_id`=`cvs`.`case_victim_services_id`
            ORDER BY `cvs`.`case_victim_services_id` DESC
        ";
        // exit($sql);
        $result = $this->yel->GetAll($sql);

        return $result;
    }

    public function getServiceLogs($aParam){
        $sql ="

            SELECT *,
            (SELECT `iul`.`user_log_date_added`
            FROM `icms_user_log` `iul` 
            WHERE `iulup`.`user_log_id` = `iul`.`user_log_id` LIMIT 1) as temporary_case_remarks_date_added

            FROM `icms_user_log_update_parameter` `iulup` 
            WHERE `iulup`.`user_log_id` IN (

            SELECT `iul`.`user_log_id` FROM `icms_user_log` `iul`
            WHERE  `iul`.`user_log_event_type_id` = 128 
            AND     `iul`.`module_primary_id` IN (SELECT `icvsat`.`case_victim_services_agency_tag_id` 
                                            FROM `icms_case_victim_services_agency_tag` `icvsat`
                                            WHERE `icvsat`.`case_victim_services_id` = '" . $aParam['case_victim_services_id'] . "')
            )
            
            ORDER BY `user_log_id` DESC
        ";
        return $this->yel->GetAll($sql); 
    }

    public function getCriminalCaseForRemarks($aParam){

        $result = [];

        # investigation slip number 
        $sql = "
        SELECT 
            `ilcs`.`legal_cc_slip_investigation_no`
        FROM `icms_legal_cc_slip` `ilcs`
        WHERE `ilcs`.`case_id` ='". $aParam['case_id'] ."'
        LIMIT 1";

        $result['slip_investigation_no'] = $this->yel->GetOne($sql);

        # docket number 
        $sql = "
        SELECT 
            `lcbnn`.`legal_cc_batch_nps_no` 
        FROM 
            `icms_legal_cc_batch` `lcbnn`
        WHERE 
            `lcbnn`.`legal_cc_batch_nps_no` =  (SELECT 
                `ilcbv`.`legal_cc_batch_id `
            FROM `icms_legal_cc_batch_victims` `ilcbv`
            WHERE `ilcbv`.`case_id` ='". $aParam['case_id'] ."'
            LIMIT 1)
        LIMIT 1
        ";

        $result['docket_number'] = $this->yel->GetOne($sql);

        return $result; 

    }

    public function getAdministrativeCaseForRemarks($aParam){

        $result = [];

        # docket number
        $sql = "
        SELECT 
            `ilacd`.`legal_ac_docket_number`
        FROM `icms_legal_ac_dockets` `ilacd`
        WHERE `ilacd`.`legal_ac_docket_id` =
            (SELECT 
            `iladc`.`legal_ac_docket_id`
            FROM `icms_legal_ac_docket_cases` `iladc`
            WHERE
            `iladc`.`case_id` = '". $aParam['case_id'] ."'
            LIMIT 1
            )
        LIMIT 1";

        $result['docket_number'] = $this->yel->GetOne($sql);

        # case number
        $sql = "
        SELECT 
            `iladc`.`legal_ac_case_no`
        FROM `icms_legal_ac_cases` `iladc`
        WHERE
            `iladc`.`case_id` = '". $aParam['case_id'] ."'
        LIMIT 1
        ";

        $result['case_no'] = $this->yel->GetOne($sql);

        return $result; 
    }

    public function getCaseDetails($aParam){
        # case number
        $sql = "
            SELECT 
                *
            FROM `icms_case`
            WHERE
                `case_id` = '". $aParam['case_id'] ."'
            LIMIT 1
        ";
        return $this->yel->GetRow($sql);
    }

    public function getCaseNumberByCaseID($aParam){
        # case number
        $sql = "
            SELECT 
                *
            FROM `icms_case`
            WHERE
                `case_id` = '". $aParam['case_id'] ."'
            LIMIT 1
        ";
        return $this->yel->GetOne($sql);
    }
}
