<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Offline_update_model extends CI_Model {

    /**
     * Create user log
     * 
     * @param array $aParam
     * @return array $aResponse
     */
    public function icms_case() {
        $sql = " SELECT * FROM `icms_case` WHERE `case_date_added` > DATE_SUB(NOW(),INTERVAL 1 YEAR)";
        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function add_case($aParam) {
        $aResponse = [];
        $sql = "
                INSERT INTO 
                    `icms_case` 
                SET                 
                    `case_priority_level_id`= '" . $aParam['case_priority_level_id'] . "', 
                    `case_facts`= " . $this->yel->checkifStringExist($aParam['case_facts']) . ", 
                    `case_evaluation`= " . $this->yel->checkifStringExist($aParam['case_evaluation']) . ", 
                    `case_risk_assessment`= " . $this->yel->checkifStringExist($aParam['case_risk_assessment']) . ", 
                    `case_is_illegal_rec`= " . $this->yel->checkifStringExist($aParam['case_is_illegal_rec']) . ", 
                    `case_is_other_law`= " . $this->yel->checkifStringExist($aParam['case_is_other_law']) . ", 
                    `case_is_other_law_desc`= " . $this->yel->checkifStringExist($aParam['case_is_other_law_desc']) . ", 
                    `case_status_id`= '1', 
                    `case_date_added`=now(), 
                    `case_added_by`=" . $this->yel->checkifStringExist($aParam['case_added_by']) . ", 
                    `case_date_modified`=now(), 
                    `case_modified_by`=" . $this->yel->checkifStringExist($aParam['case_modified_by']) . "
               ";
        $aResponse = $this->yel->exec($sql);

        return $aResponse;
    }

    public function update_case_number($aParam) {
        $sql = "UPDATE `icms_case` 
                SET `case_number`='" . $aParam['case_number'] . "' 
                WHERE `case_id`='" . $aParam['case_id'] . "'
                ";
        $rs = $this->yel->exec($sql);

        return $rs;
    }

    public function add_victim($aParam) {
        $sql = "INSERT INTO  `icms_victim` 
                SET 
                `victim_civil_status`='" . $aParam['victim_civil_status'] . "',
                `victim_gender`='" . $aParam['victim_gender'] . "',
                `victim_religion`='" . $aParam['victim_religion'] . "',
                `victim_added_by`='" . $aParam['victim_added_by'] . "',
                `victim_modified_by`='" . $aParam['victim_modified_by'] . "' 
                ";
        $rs = $this->yel->exec($sql);

        return $rs;
    }

    public function update_victim_number($aParam) {
        $sql = "UPDATE `icms_victim` 
                SET `victim_number`='" . $aParam['victim_number'] . "' 
                WHERE `victim_id`='" . $aParam['victim_id'] . "'
                ";
        $rs = $this->yel->exec($sql);

        return $rs;
    }

    public function add_case_victim($aParam) {
        $sql = "INSERT INTO  `icms_case_victim` 
                SET 
                `case_id`='" . $aParam['case_id'] . "',
                `victim_id`='" . $aParam['victim_id'] . "',
                `case_facts`='" . $aParam['case_facts'] . "'
                ";
        $rs = $this->yel->exec($sql);

        return $rs['insert_id'];
    }

}
