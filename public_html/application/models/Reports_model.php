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
                  AND   `gc`.`country_id` IN (SELECT `case_victim_deployment_country_destination` FROM `icms_case_victim_deployment` WHERE `case_victim_deployment_is_active` = 1)
                  ORDER BY 
                        `gc`.`country_name` ASC
               ";

        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function getGenerateVictimReportGraph($aParam) {
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
                    `icms_victim` `v`, 
                    `icms_case_victim_deployment` `cvd`, 
                    `icms_case_complainant` `cc` , 
                    `icms_case_victim_employment` `cve`
                WHERE 
                    `cv`.`case_id` = `c`.`case_id`
                AND `cvd`.`case_victim_id` = `cv`.`case_victim_id`
                AND `cc`.`case_victim_id` = `cv`.`case_victim_id`
                AND `cve`.`case_victim_id` = `cv`.`case_victim_id`               
                AND `cv`.`victim_id` =  `v`.`victim_id` 
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
                    `icms_case_victim_deployment` `cvd`, 
                    `icms_case_victim` `cv`,
                    `icms_victim_info` `vi`, 
                    `icms_victim` `v`
                WHERE 
                    `cv`.`case_id` = `c`.`case_id`
                AND `cvd`.`case_victim_id` = `cv`.`case_victim_id`
                AND `cv`.`victim_id` = `vi`.`victim_id`
                AND `cv`.`victim_id` = `v`.`victim_id`
                AND `vi`.`victim_info_is_assumed` = 0
                AND TIMESTAMPDIFF(YEAR, `vi`.`victim_info_dob`, `cvd`.`case_victim_deployment_date`) >= 18
                AND  DATE(`cvd`.`case_victim_deployment_date`) BETWEEN '" . $aParam['start_date'] . "' AND '" . $aParam['end_date'] . "'
                " . $aParam['where'] . "
                " . $aParam['groupBy'] . "
            ";
//        echo '<pre>';echo $sql; exit();
        $aResponse = $this->yel->getAll($sql);
        return $aResponse;
    }

}
