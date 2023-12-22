<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Reports_model extends CI_Model {

    public function getBaseReportVictim() {
        $aResponse = [];

        $sqlPrimary = "
               SELECT 
                    parameter_count_id as id, 
                    parameter_name as name
               FROM 
                    `icms_global_parameter` 
               WHERE 
                    `parameter_type_id` = 19 
               AND `parameter_status` = '1' 
               ORDER BY `parameter_id` DESC
            ";
        $aResponse['primary'] = $this->yel->getAll($sqlPrimary);

        $sqlSecondary = "
               SELECT 
                    parameter_count_id as id, 
                    parameter_name as name
               FROM 
                    `icms_global_parameter` 
               WHERE 
                    `parameter_type_id` = 20 
               AND `parameter_status` = '1' 
               ORDER BY `parameter_id` DESC
            ";
        $aResponse['secondary'] = $this->yel->getAll($sqlSecondary);

        return $aResponse;
    }

    public function getBaseReportCase() {
        $aResponse = [];

        $sqlPrimary = "
               SELECT 
                    parameter_count_id as id, 
                    parameter_name as name
               FROM 
                    `icms_global_parameter` 
               WHERE 
                    `parameter_type_id` = 23
               AND `parameter_status` = '1' 
               ORDER BY `parameter_id` DESC
            ";
        $aResponse['primary'] = $this->yel->getAll($sqlPrimary);

        $sqlSecondary = "
               SELECT 
                    parameter_count_id as id, 
                    parameter_name as name
               FROM 
                    `icms_global_parameter` 
               WHERE 
                    `parameter_type_id` = 24
               AND `parameter_status` = '1' 
               ORDER BY `parameter_id` DESC
            ";
        $aResponse['secondary'] = $this->yel->getAll($sqlSecondary);

        return $aResponse;
    }

    public function getBaseReportCaseVictim() {
        $aResponse = [];

        $sqlPrimary = "
               SELECT 
                    parameter_count_id as id, 
                    parameter_name as name
               FROM 
                    `icms_global_parameter` 
               WHERE 
                    `parameter_type_id` = 21
               AND `parameter_status` = '1' 
               ORDER BY `parameter_id` DESC
            ";
        $aResponse['primary'] = $this->yel->getAll($sqlPrimary);

        $sqlSecondary = "
               SELECT 
                    parameter_count_id as id, 
                    parameter_name as name
               FROM 
                    `icms_global_parameter` 
               WHERE 
                    `parameter_type_id` = 22
               AND `parameter_status` = '1' 
               ORDER BY `parameter_id` DESC
            ";
        $aResponse['secondary'] = $this->yel->getAll($sqlSecondary);

        return $aResponse;
    }

    public function getBaseReportMinor() {
        $aResponse = [];

        $sqlPrimary = "
               SELECT 
                    parameter_count_id as id, 
                    parameter_name as name
               FROM 
                    `icms_global_parameter` 
               WHERE 
                    `parameter_type_id` = 28
               AND `parameter_status` = '1' 
               ORDER BY `parameter_id` DESC
            ";
        $aResponse['primary'] = $this->yel->getAll($sqlPrimary);

        return $aResponse;
    }

    public function getAgencyTypes() {
        $sql = "
                  SELECT 
                    `agency_id` as id, 
                    `agency_name` as name
                  FROM 
                    `icms_agency` 
                  WHERE
                    `agency_is_active`='1'
                  ORDER BY 
                    `agency_id` ASC
                ";

        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    // $id = Parameter type id 
    public function getGlobalParambyId($id) {
        $sql = "
               SELECT 
                    `parameter_count_id` as `id`, 
                    `parameter_name` as `name`
               FROM 
                    `icms_global_parameter` 
               WHERE 
                    `parameter_type_id` = " . $id . " 
               AND `parameter_status` = '1' 
               ORDER BY `parameter_count_id` DESC
            ";
        $aResponse = $this->yel->getAll($sql);

        return $aResponse;
    }

    // $id = Transaction type id 
    public function getTransactionParambyId($id) {
        $sql = "
               SELECT 
                    `transaction_parameter_count_id` as id, 
                    `transaction_parameter_name` as name
               FROM 
                    `icms_transaction_parameter` 
               WHERE 
                    `transaction_parameter_type_id` = " . $id . " 
               AND `transaction_parameter_status` = '1' 
               ORDER BY `transaction_parameter_count_id` DESC
            ";
        $aResponse = $this->yel->getAll($sql);

        return $aResponse;
    }

    // $id =  tip form type id 
    public function getTIPDetailsById($id) {
        $sql = "
               SELECT 
                    `tip_details_count` as id, 
                    `tip_details_name` as name
               FROM 
                    `icms_tip_details` 
               WHERE 
                    `tip_form_type_id` = " . $id . " 
               AND `tip_details_is_active` = '1' 
               ORDER BY `tip_details_count` ASC
            ";
        $aResponse = $this->yel->getAll($sql);

        return $aResponse;
    }

    public function getCountries() {

        $aResponse = [];

        $sql = "
                  SELECT 
                       `gc`.`country_id` as `id`, 
                       `gc`.`country_name` as `name`
                  FROM 
                        `icms_global_country`  `gc`
                  WHERE 
                        `gc`.`is_active` = 1 
                  AND   `gc`.`country_id` IN (SELECT `country_id` FROM `icms_case_victim_employment_details` WHERE `case_victim_employment_details_is_actual` = '1' )
                  ORDER BY 
                        `gc`.`country_name` ASC
               ";

        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function getEmployers() {

        $aResponse = [];

        $sql = "
                SELECT                   
                    `case_offender_id` as `id`,
                    `case_offender_name` as `name`
                FROM
                    `view_report_offender_summary`
                WHERE
                    `case_offender_type_id`  = 1 
               ";

        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function getNameOffenderRecords($type_id) {

        $aResponse = [];

        $sql = "
                SELECT                   
                    `case_offender_id` as `id`,
                    `case_offender_name` as `name`
                FROM
                    `view_report_offender_summary`
                WHERE
                    `case_offender_type_id` = " . $type_id . "
               ";
//        exit($sql); 
        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function getOther() {

        $aResponse = [];

        $sql = "
                SELECT                   
                    `case_offender_id` as `id`,
                    `case_offender_type_name` as `name`
                FROM
                    `view_report_offender_summary`
                WHERE `case_offender_type_id` = '4'
                LIMIT 1
               ";
//        exit($sql); 
        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function getRegion() {

        $aResponse = [];

        $sql = "
                SELECT 
                    `location_count_id` as `id`, 
                    `location_name` as `name`
                FROM 
                    `icms_global_location`
                WHERE 
                    `location_is_active`='1'
                AND `location_type_id`='3'
                AND `location_prerequisite_id`='173'
                ORDER BY `location_name` ASC
               ";

        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function __getGenerateVictimReportGraph($aParam) {
        $sql = "
               SELECT 
                    COUNT(1) as `count`, 
                    " . $aParam['select'] . " as `variable`,
                    " . $aParam['date'] . " as `date` 
                FROM 
                    `icms_victim` `v`
                WHERE 
                    DATE(`v`.`victim_date_added`) BETWEEN '" . $aParam['start_date'] . "' AND '" . $aParam['end_date'] . "'
                " . $aParam['where'] . "
                " . $aParam['groupBy'] . "
            ";
//        echo'<pre>';   echo $sql;   exit();
        $aResponse = $this->yel->getAll($sql);

        return $aResponse;
    }
    
    public function getGenerateVictimReportGraph($aParam) {
        $sql = "
               SELECT 
                    COUNT(`case_victim_id`) as `count`, 
                   " . $aParam['select'] . " as `variable`,
                   " . $aParam['date'] . " as `date`
                FROM 
                    `view_report_summary` `v`
                WHERE 
                    `v`.`case_victim_id` IN (SELECT `case_victim_id` FROM `view_report_summary` GROUP BY `victim_id`)
                    AND  DATE(`case_date_added`) BETWEEN '" . $aParam['start_date'] . "' AND '" . $aParam['end_date'] . "'
                " . $aParam['where'] . "
                " . $aParam['groupBy'] . "
            ";
//        echo '<pre>';exit($sql); 
        $aResponse = $this->yel->getAll($sql);
        return $aResponse;
    }

    public function getGenerateCaseReportGraph($aParam) {
        $sql = "
               SELECT 
                    COUNT(1) as `count`, 
                    " . $aParam['select'] . " as `variable`
                FROM 
                    `icms_case` `c`
                WHERE 
                    DATE(`c`.`case_date_added`) BETWEEN '" . $aParam['start_date'] . "' AND '" . $aParam['end_date'] . "'
                " . $aParam['where'] . "
                " . $aParam['groupBy'] . "
            ";

        $aResponse = $this->yel->getAll($sql);

        return $aResponse;
    }

    public function getGenerateCaseVictimReportGraph($aParam) {
        $sql = "
               SELECT 
                    COUNT(`cv`.`case_victim_id`) as `count`, 
                   " . $aParam['select'] . " as `variable`,
                   " . $aParam['date'] . " as `date`
                FROM 
                    `icms_case` `c`, 
                    `icms_case_victim` `cv`, 
                    `icms_case_victim_deployment` `cvd`, 
                    `icms_case_complainant` `cc` ,
                    `icms_case_victim_employment` `cve`
                WHERE 
                    `cv`.`case_id` = `c`.`case_id`
                AND `cv`.`case_victim_id` = `cvd`.`case_victim_id`
                AND `cv`.`case_victim_id` = `cc`.`case_victim_id`
                AND `cv`.`case_victim_id` = `cve`.`case_victim_id`
                AND  DATE(`c`.`case_date_added`) BETWEEN '" . $aParam['start_date'] . "' AND '" . $aParam['end_date'] . "'
                " . $aParam['where'] . "
                " . $aParam['groupBy'] . "
            ";
//        echo '<pre>';echo $sql; exit();
        $aResponse = $this->yel->getAll($sql);
        return $aResponse;
    }

    public function getGenerateCaseVictimMinorReportGraph($aParam) {
        $sql = "
               SELECT 
                    COUNT(`cv`.`case_victim_id`) as `count`, 
                   " . $aParam['select'] . " as `variable`,
                   " . $aParam['date'] . " as `date`
                FROM 
                    `icms_case` `c`, 
                    `icms_case_victim` `cv`, 
                    `icms_case_victim_deployment` `cvd`, 
                    `icms_case_victim_employment` `cve`
                WHERE 
                    `cv`.`case_id` = `c`.`case_id`
                AND `cv`.`case_victim_id` = `cvd`.`case_victim_id` 
                AND `cv`.`case_victim_id` = `cve`.`case_victim_id` 
                
                AND TIMESTAMPDIFF(YEAR, 
                        ( SELECT `vi`.`victim_info_dob` FROM `icms_victim_info` `vi` WHERE  `vi`.`victim_info_is_assumed` = 0 AND `vi`.`victim_id` = `cv`.`victim_id` )
                 , `cvd`.`case_victim_deployment_date`) <= 17
                AND  DATE(`cvd`.`case_victim_deployment_date`) BETWEEN '" . $aParam['start_date'] . "' AND '" . $aParam['end_date'] . "'
                " . $aParam['where'] . "
                " . $aParam['groupBy'] . "
            ";
//        echo '<pre>';echo $sql; exit();
        $aResponse = $this->yel->getAll($sql);
        return $aResponse;
    }

    public function getGenerateCaseReportGraphView($aParam) {
        $sql = "
               SELECT 
                    COUNT(`case_victim_id`) as `count`, 
                   " . $aParam['select'] . " as `variable`,
                   " . $aParam['date'] . " as `date`
                FROM 
                    `view_report_summary` 
                WHERE 
                     DATE(`case_date_added`) BETWEEN '" . $aParam['start_date'] . "' AND '" . $aParam['end_date'] . "'
                " . $aParam['where'] . "
                " . $aParam['groupBy'] . "
            ";
//        echo '<pre>';exit($sql); 
        $aResponse = $this->yel->getAll($sql);
        return $aResponse;
    }

    public function generateCaseVictimAllegedReport($aParam) {
        $sql = "
               SELECT 
                    COUNT(`case_id`) as `count`, 
                   " . $aParam['select'] . " as `variable`,
                   " . $aParam['date'] . " as `date`
                FROM 
                    `view_report_offender_summary` 
                WHERE 
                     DATE(`case_date_added`) BETWEEN '" . $aParam['start_date'] . "' AND '" . $aParam['end_date'] . "'
                " . $aParam['where'] . "
                " . $aParam['groupBy'] . "
            ";
//        exit($sql); 
        $aResponse = $this->yel->getAll($sql);
        return $aResponse;
    }

    public function generateCaseServicesReport($aParam, $parent = "") {
        $sql = "
               SELECT 
                    COUNT(`case_victim_services_id`) as `count`, 
                   " . $aParam['select'] . " as `variable`,
                   " . $aParam['date'] . " as `date`
                   " . $parent . "
                FROM 
                    `view_services_summary` 
                WHERE 
                     DATE(`case_victim_services_agency_tag_added_date`) BETWEEN '" . $aParam['start_date'] . "' AND '" . $aParam['end_date'] . "'
                " . $aParam['where'] . "
                " . $aParam['groupBy'] . "
            ";
//          exit($sql);
        $aResponse = $this->yel->getAll($sql);
        return $aResponse;
    }

    public function getDateStatusCaseServicesReport($aParam) {
        $sql = "
               SELECT 
                    COUNT(`case_victim_services_id`) as `count`, 
                   " . $aParam['select'] . " as `variable`,
                   " . $aParam['date'] . " as `date`,
                  `case_victim_services_agency_tag_status_name` as `status_name`
                FROM 
                    `view_services_summary` 
                WHERE 
                     DATE(`case_victim_services_agency_tag_added_date`) BETWEEN '" . $aParam['start_date'] . "' AND '" . $aParam['end_date'] . "'
                " . $aParam['where'] . "
                GROUP BY  `status_name`, `variable` , `date` ORDER BY `case_victim_services_agency_tag_added_date`
            ";
//            exit($sql); 
        $aResponse = $this->yel->getAll($sql);
        return $aResponse;
    }

    public function getDateStatusCaseServicesAgingReport($aParam) {
        $sql = "
               SELECT 
                    COUNT(`case_victim_services_id`) as `count`, 
                   " . $aParam['select'] . " as `variable`,
                   " . $aParam['date'] . " as `date`,
                  `aging_status` as `aging_status`
                FROM 
                    `view_services_summary` 
                WHERE 
                     DATE(`case_victim_services_agency_tag_added_date`) BETWEEN '" . $aParam['start_date'] . "' AND '" . $aParam['end_date'] . "'
                " . $aParam['where'] . "
                GROUP BY  `aging_status`, `variable` , `date` ORDER BY `case_victim_services_agency_tag_added_date`
            ";
//            exit($sql); 
        $aResponse = $this->yel->getAll($sql);
        return $aResponse;
    }

    public function getDateServiceNameCaseServicesReport($aParam, $parent) {
        $sql = "
               SELECT 
                    " . $aParam['date'] . " as `date`,
                    " . $parent . "
                    " . $aParam['select'] . " as `variable`,
                    `service_name_full` as `service_name_full`, 
                    COUNT(`case_victim_services_id`) as `count`, 
                    `case_victim_services_agency_tag_status_name` as `status_name`
                FROM 
                    `view_services_summary` 
                WHERE 
                     DATE(`case_victim_services_agency_tag_added_date`) BETWEEN '" . $aParam['start_date'] . "' AND '" . $aParam['end_date'] . "'
                " . $aParam['where'] . "
                " . $aParam['group_by'] . "
            ";
//        echo '<pre>';  echo $sql; 
//         exit($sql); 
        $aResponse = $this->yel->getAll($sql);
        return $aResponse;
    }

    public function getDateServiceNameCaseServicesAgingReport($aParam, $parent) {
        $sql = "
               SELECT 
                    " . $aParam['date'] . " as `date`,
                    " . $parent . "
                    " . $aParam['select'] . " as `variable`,
                    `service_name_full` as `service_name_full`, 
                    COUNT(`case_victim_services_id`) as `count`, 
                    `aging_status` as `status_name`
                FROM 
                    `view_services_summary` 
                WHERE 
                     DATE(`case_victim_services_agency_tag_added_date`) BETWEEN '" . $aParam['start_date'] . "' AND '" . $aParam['end_date'] . "'
                " . $aParam['where'] . "
                " . $aParam['group_by'] . "
            ";
//        echo '<pre>';  echo $sql; 
//         exit($sql); 
        $aResponse = $this->yel->getAll($sql);
        return $aResponse;
    }

    public function AgencyBranchNameList() {
        $sql = "
            SELECT 
                CONCAT(`ia`.`agency_abbr`, ' - ', `iab`.`agency_branch_name`) name, 
                `iab`.`agency_branch_id` as id
            FROM `icms_agency` `ia`, `icms_agency_branch` `iab`
            WHERE 
                `ia`.`agency_id` = `iab`.`agency_id`
        ";

        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function getOfferedServicesByBranchNameView($agency_branch_name) {

        $sql = "
            SELECT 
                `iaso`.`services_id`, 
                CONCAT(`is`.`service_name`, ' - ', (SELECT `itp`.`transaction_parameter_name`
                                FROM `icms_transaction_parameter` `itp`
                                WHERE `itp`.`transaction_parameter_type_id` = 8  
                                AND `itp`.`transaction_parameter_count_id` = `is`.`service_type_id`
                                LIMIT 1 )
                )  as `service_name_full`, 
                '0' as `count`
            FROM 
                `icms_agency_services_offered` `iaso`, 
                `icms_services` `is`
            WHERE 
                `is`.`services_id` = `iaso`.`services_id` AND 
                `iaso`.`agency_branch_id` = (
                    SELECT 
                        `vsm`.`agency_branch_id`
                    FROM 
                        `view_services_summary` `vsm`
                    WHERE 
                        `vsm`.`agency_branch_name` = '" . $agency_branch_name . "'
                    LIMIT 1 )
        ";
//        exit($sql); 
        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

}
