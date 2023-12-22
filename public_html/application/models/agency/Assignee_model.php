<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Assignee_model extends CI_Model {

    public function checkCaseTaggedExist($aParam) {

        $aResponse = [];

        $sql = "
            SELECT 
                COUNT(1)
            FROM 
                `icms_case_tagged_users`
            WHERE 
                `case_id` = " . $aParam['case_id'] . "
            AND `user_id` = " . $aParam['user_id'] . "
        ";
        $aResponse = $this->yel->GetOne($sql);

        return $aResponse;
    }

    public function addCaseTagged($aParam) {
        $aResponse = [];

        $sql = "
            INSERT 
            INTO 
                `icms_case_tagged_users` 
                    (`case_id`, `user_id`,`case_tagged_users_status`,`case_tagged_users_added_by`) 
           VALUES   (" . $aParam['case_id'] . "," . $aParam['user_id'] . "," . $aParam['status'] . "," . $aParam['inp_user_id'] . ")        
        ";
        $aResponse = $this->yel->exec($sql);

        return $aResponse;
    }

    public function updateCaseTagged($aParam) {

        $sql = "
            UPDATE 
                `icms_case_tagged_users` 
            SET                
                `case_tagged_users_status`  = " . $aParam['status'] . ",  
                `case_tagged_users_modified_by`  = " . $aParam['inp_user_id'] . "
            WHERE 
                `case_id` = " . $aParam['case_id'] . " 
            AND 
                `user_id`  = " . $aParam['user_id'] . " 
        ";
        $this->yel->exec($sql);
        
        $qry = " SELECT 
                    `case_tagged_users_id` 
                FROM 
                    `icms_case_tagged_users` 
                WHERE 
                    `case_id` = " . $aParam['case_id'] . " 
                AND 
                    `user_id`  = " . $aParam['user_id'] . " LIMIT 1";
        $aResponse = $this->yel->GetOne($qry);

        return $aResponse;
    }

    // Except Admin 
    public function getAndCheckUserListByCaseAndAgencyId($aParam) {
        $sql = "
                SELECT   `u`.`user_id`, 
                    `u`.`user_lastname`, 
                    `u`.`user_firstname`, 
                    `u`.`user_middlename`, 
                    `u`.`user_email`, 
                    (SELECT COUNT(1) FROM `icms_case_tagged_users` `ctu` WHERE `ctu`.`user_id` = `u`.`user_id` AND `case_id`='".$aParam['case_id']."') as `count`, 
                     (
                      CASE
                        WHEN  (SELECT COUNT(1) FROM `icms_case_tagged_users` `ctu` WHERE `ctu`.`user_id` = `u`.`user_id` AND `ctu`.`case_tagged_users_status` AND `case_id`='".$aParam['case_id']."') > 0 THEN '1'
                        ELSE '0'
                    END
                    ) as `check`,
                    (SELECT `transaction_parameter_name` FROM `icms_transaction_parameter` WHERE `transaction_parameter_type_id`='5' AND `transaction_parameter_count_id`=`u`.`user_level_id` AND `transaction_parameter_status`='1' LIMIT 1) as `user_level`
                FROM 
                    `icms_user`  `u`
                WHERE 
                    `u`.`agency_branch_id` = '" . $aParam['agency_branch_id'] . "' 
                AND 
                    `u`.`user_is_active` = '1' 
                AND     
                    `u`.`user_level_id` NOT IN (1,5)
             ";

        $result = $this->yel->GetAll($sql);

        return $result;
    }

    public function getAssigneeStatus($aParam) {
        $sql = "
                SELECT 
                    `case_tagged_users_status`, 
                    `case_tagged_users_date_added`, 
                    `case_tagged_users_added_by`, 
                    `case_tagged_users_date_modified`, 
                    `case_tagged_users_modified_by`
                FROM 
                    `icms_case_tagged_users` 
                WHERE 
                    `case_id` = " . $aParam['case_id'] . " 
                AND 
                    `user_id`  = " . $aParam['user_id'] . " 
                LIMIT 1 
             ";

        $result = $this->yel->GetRow($sql);

        return $result;
    }

    public function getCaseNumberByCaseId($aParam) {
        $sql = "
                SELECT 
                    `case_number`
                FROM 
                    `icms_case` 
                WHERE 
                    `case_id` = " . $aParam['case_id'] . " 
             ";

        $result = $this->yel->GetOne($sql);

        return $result;
    }

}
