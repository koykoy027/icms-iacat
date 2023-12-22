<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Victim_services_model extends CI_Model {

    public function deleteService($aParam)
    {
        $aResponse = [];
        
        $sql = "
                UPDATE `icms_case_victim_services` 
                SET `case_victim_services_is_active` = '0' 
                WHERE `case_victim_services_id` = ".$aParam['case_victim_services_id']."
              ";
        $aResponse['case_victim_services'] = $this->yel->exec($sql);
        
        $sql = "
              UPDATE `icms_case_victim_services_agency_tag` 
              SET `case_victim_services_agency_tag_is_active` = '0' 
              WHERE `case_victim_services_id` = ".$aParam['case_victim_services_id']."
            ";

        $aResponse['case_victim_services_agency_tag'] = $this->yel->exec($sql);

        return $aResponse;
    }
    
    public function getVictimServices($aParam) {
        $aResponse = [];
        $sql = "
                SELECT 
                    `cvs`.`case_victim_services_id`,
                    `cvs`.`services_id`,
                    (SELECT `service_name` FROM `icms_services` WHERE `services_id`=`cvs`.`services_id` LIMIT 1) as `service_name`,
                    (SELECT `transaction_parameter_name` FROM `icms_transaction_parameter` `itp`,`icms_services` `is` WHERE `itp`.`transaction_parameter_type_id`='8' AND `itp`.`transaction_parameter_count_id`=`is`.`service_type_id` AND `is`.`services_id`=`cvs`.`services_id` LIMIT 1) as `service_duration`,
                    `cvsat`.`case_victim_services_agency_tag_id`,
                    `cvsat`.`case_victim_services_id`,
                    `cvsat`.`agency_branch_id`,
                    `cvsat`.`case_victim_services_agency_tag_status`,
                    (SELECT `transaction_parameter_name` FROM `icms_transaction_parameter` WHERE `transaction_parameter_type_id`='1' AND `transaction_parameter_count_id`=`cvsat`.`case_victim_services_agency_tag_status` LIMIT 1) as `service_status`,
                    `cvsat`.`case_victim_services_agency_tag_added_by`,
                    `cvsat`.`case_victim_services_agency_tag_added_date`,
                    `cvsat`.`case_victim_services_agency_tag_date_modified`,
                    `cvsat`.`case_victim_services_agency_tag_date_completed`
                    
                FROM
                    `icms_case_victim_services` `cvs`,
                    `icms_case_victim_services_agency_tag` `cvsat`
                WHERE
                    `cvs`.`case_victim_services_is_active` = '1' AND 
                    `cvsat`.`case_victim_services_agency_tag_is_active` = '1'  AND 
                    `cvs`.`case_victim_id`='" . $aParam['case_victim_id'] . "'
                AND `cvsat`.`case_victim_services_id`=`cvs`.`case_victim_services_id`
              ";

        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function getTaggedAgencyBranchByUsingUserID($user_id) {
        $aResponse = [];
        $sql = "
                SELECT
                    `iu`.`agency_branch_id`,
                    `iab`.`agency_branch_name`,
                    `ia`.`agency_name`,
                    `ia`.`agency_abbr`
                FROM
                    `icms_user` `iu`,
                    `icms_agency_branch` `iab`,
                    `icms_agency` `ia`
                WHERE
                    `iu`.`user_id`='" . $user_id . "'
                AND `iab`.`agency_branch_id`=`iu`.`agency_branch_id`
                AND `ia`.`agency_id`=`iab`.`agency_id`
                LIMIT 1
              ";
        $aResponse = $this->yel->GetRow($sql);
        return $aResponse;
    }

    public function getTaggedToAgencyBranchByUsingBranchID($branch_id) {
        $aResponse = [];
        $sql = "
                SELECT
                    `iab`.`agency_branch_id`,
                    `iab`.`agency_branch_name`,
                    `ia`.`agency_name`,
                    `ia`.`agency_abbr`
                FROM
                    `icms_agency_branch` `iab`,
                    `icms_agency` `ia`
                WHERE
                 `iab`.`agency_branch_id`='" . $branch_id . "'
                AND `ia`.`agency_id`=`iab`.`agency_id`
                LIMIT 1
              ";
        $aResponse = $this->yel->GetRow($sql);
        return $aResponse;
    }

    public function saveNewServiceHistory($aParam) {
        $sql = "
                INSERT INTO
                    `icms_case_victim_services_history`
                SET
                    `case_victim_services_id`='" . $aParam['cvsid'] . "',
                    `case_victim_services_history_subject`='" . $aParam['subj'] . "',
                    `case_victim_services_history_remarks`='" . $aParam['remarks'] . "',
                    `document_hash`='" . $aParam['document_hash'] . "',
                    `case_vistim_services_history_added_by`='" . $_SESSION['userData']['user_id'] . "'
              ";
        $aResult = $this->yel->exec($sql);
        return $aResult;
    }

    public function addServiceReminderHistory($aParam) {
        $sql = "
                INSERT INTO
                    `icms_case_victim_services_reminders`
                SET
                    `case_victim_services_id`='" . $aParam['cvsid'] . "',
                    `case_victim_services_reminder_date`='" . $aParam['date_remind'] . "',
                    `case_victim_services_reminder_remarks`='" . $aParam['reminder_remarks'] . "',
                    `case_victim_services_reminder_added_by`='" . $_SESSION['userData']['user_id'] . "'
              ";
        $aResult = $this->yel->exec($sql);
        return $aResult;
    }

    public function setServicestatus($aParam) {
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

    public function setServiceTagDate($aParam) {
        $sql = "
                UPDATE 
                    `icms_case_victim_services_agency_tag`
                SET
                    `case_victim_services_agency_tag_date_modified` = NOW() 
                WHERE
                    `case_victim_services_agency_tag_id`='" . $aParam['tagged_id'] . "'
              ";
        $aResult = $this->yel->exec($sql);
        return $aResult;
    }

    public function getServicestatus($aParam) {
        $sql = "
                SELECT  
                    `a`.`case_victim_services_agency_tag_id`,
                    (SELECT `transaction_parameter_name` FROM `icms_transaction_parameter` WHERE `transaction_parameter_type_id`=1 AND `transaction_parameter_count_id`=`a`.`case_victim_services_agency_tag_status` LIMIT 1) as `status`
                FROM
                    `icms_case_victim_services_agency_tag` `a`
                WHERE
                    `case_victim_services_agency_tag_id`='" . $aParam['tagged_id'] . "'
                    AND `a`.`case_victim_services_agency_tag_is_active` = 1 
              ";
        $aResult = $this->yel->getAll($sql);
        return $aResult;
    }

    public function getServicesIdByBranchId($aParam) {
        $sql = "
                SELECT 
                    `services_id`
                FROM 
                    `icms_agency_services_offered` 
                WHERE
                    `agency_branch_id` = " . $aParam['agency_branch_id'] . "
              ";
        $aResult = $this->yel->getAll($sql);
        return $aResult;
    }

}
