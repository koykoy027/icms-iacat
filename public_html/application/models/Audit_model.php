<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Audit_model extends CI_Model {

    /**
     * Create user log
     * 
     * @param array $aParam
     * @return array $aResponse
     */
    public function createUserLogs($aParam) {

        $aResponse = [];

        $sSequel = "
            INSERT IGNORE INTO `icms_user_log` SET
            `user_id` = '" . $aParam['user_id'] . "',
            `user_log_panel` = '" . $aParam['log_panel'] . "',
            `user_log_event_type_id` = '" . $aParam['log_event_type'] . "',
            `module_primary_id`='". $aParam['module_primary_id']."',
            `sub_module_primary_id`='". $aParam['sub_module_primary_id']."',
            `agency_abbr` = '" . $aParam['log_abbr'] . "',
            `user_log_fullname` = '" . $aParam['log_fullname'] . "',
            `user_log_message` = '" . $aParam['log_message'] . "',
            `user_log_date_added` = now()
            ";
        $aResponse = $this->yel->exec($sSequel);
        return $aResponse;
    }
    


    /**
     * Save User Log Source
     * 
     * @param array $aParam
     * @return array $aResponse
     */
    public function saveUserLogSource($aParam) {

        $aResponse = [];

        $sSequel = "
            INSERT IGNORE INTO `icms_user_log_source` SET
            `user_log_id` = '" . $aParam['user_log_id'] . "',
            `user_log_source_ip` = '" . $aParam['user_log_source_ip'] . "',
            `user_log_source_user_agent` = '" . $aParam['user_log_source_user_agent'] . "'
            ";

        $aResponse = $this->yel->exec($sSequel);

        return $aResponse;
    }

    /**
     * Save User Log Source
     * 
     * @param array $aParam
     * @return array $aResponse
     */
    public function saveUserLogOldAndNewParameterValue($aParam, $old_val, $new_val, $field) {


        $aResponse = [];

        $sSequel = "
            INSERT IGNORE INTO `icms_user_log_update_parameter` SET
            `user_log_id` = '" . $aParam['user_log_id'] . "',
            `user_log_update_field_name` = '" . $field . "',
            `user_log_update_old_parameter` = '" . $old_val . "',
            `user_log_update_new_parameter` = '" . $new_val . "'
            ";
        $aResponse = $this->yel->exec($sSequel);

        return $aResponse;
    }

    /**
     * get USer Log Param
     * 
     * @param int $iLogId
     * @return array $aResponse
     */
    public function getUserActivityLogs($aParam) {
        $aResponse = [];

        $sSequel = "
                SELECT 
                    `user_log_id`,
                    `user_log_event_type_id`,
                    `agency_abbr`,
                    `user_log_fullname`,
                    `user_log_message`,
                    `user_log_date_added`
                FROM 
                    `icms_user_log` 
                WHERE
                    `user_id`='" . $aParam['user_id'] . "' AND `user_log_panel`='" . $aParam['log_panel'] . "' AND `user_log_is_deleted`='0'
                ORDER BY `user_log_date_added` DESC 
                LIMIT " . $aParam['limit_start'] . "," . $aParam['limit_count'];

        $aResponse['list'] = $this->yel->GetAll($sSequel);

        $sql = "SELECT 
                  COUNT(1)
                FROM 
                    `icms_user_log` 
                WHERE
                    `user_id`='" . $aParam['user_id'] . "' AND `user_log_panel`='" . $aParam['log_panel'] . "' AND `user_log_is_deleted`='0'";
        $aResponse['count'] = $this->yel->GetOne($sql);

        return $aResponse;
    }

    /**
     * get USer Log Param this is for the main admin IACAT
     * 
     * @param int $iLogId
     * @return array $aResponse
     */
    public function getActivityLogs_adminUser($aParam) {
        $aResponse = [];

        $sSequel = "
                SELECT 
                    `ul`.`user_id`,
                    `ul`.`user_log_id`,
                    `ul`.`user_log_event_type_id`,
                    `ul`.`agency_abbr`,
                    `ul`.`user_log_fullname`,
                    `ul`.`user_log_message`,
                    `ul`.`user_log_date_added`,
                    (SELECT `user_log_event_type_icon` FROM `icms_user_log_event_type` WHERE `user_log_event_type_id`=`ul`.`user_log_event_type_id` LIMIT 1) as 'badge',
                    (SELECT `user_log_event_type_class` FROM `icms_user_log_event_type` WHERE `user_log_event_type_id`=`ul`.`user_log_event_type_id` LIMIT 1) as 'badge_class',
                    (SELECT `br`.`agency_branch_name` FROM `icms_agency_branch` `br`, `icms_user` `iu` WHERE `br`.`agency_branch_id`=`iu`.`agency_branch_id` AND `iu`.`user_id`=`ul`.`user_id` LIMIT 1) as agency_branch
                FROM 
                    `icms_user_log` `ul`
                WHERE
                   `ul`.`user_log_is_deleted`='0'
                ORDER BY `ul`.`user_log_date_added` DESC 
                 LIMIT " . $aParam['limit_start'] . "," . $aParam['limit_count'];

        $aResponse['list'] = $this->yel->GetAll($sSequel);

        $sql = "SELECT 
                  COUNT(1)
                FROM 
                    `icms_user_log` 
                WHERE
                   `user_log_is_deleted`='0'";
        $aResponse['count'] = $this->yel->GetOne($sql);

        return $aResponse;
    }

    public function getUsersID() {
        $aResponse = [];
        $sql = "SELECT `user_id` FROM `icms_user` WHERE `agency_branch_id`='" . $_SESSION['userData']['agency_branch_id'] . "'";
        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    /**
     * get USer Log Param this is for the agency Branches
     * 
     * @param int $iLogId
     * @return array $aResponse
     */
    public function getActivityLogs_branchUser($aParam) {
        $aResponse = [];

        $sSequel = "
                SELECT 
                    `ul`.`user_id`,
                    `ul`.`user_log_id`,
                    `ul`.`user_log_event_type_id`,
                    `ul`.`agency_abbr`,
                    `ul`.`user_log_fullname`,
                    `ul`.`user_log_message`,
                    `ul`.`user_log_date_added`,
                    (SELECT `user_log_event_type_icon` FROM `icms_user_log_event_type` WHERE `user_log_event_type_id`=`ul`.`user_log_event_type_id` LIMIT 1) as 'badge',
                    (SELECT `user_log_event_type_class` FROM `icms_user_log_event_type` WHERE `user_log_event_type_id`=`ul`.`user_log_event_type_id` LIMIT 1) as 'badge_class',
                    (SELECT `br`.`agency_branch_name` FROM `icms_agency_branch` `br`, `icms_user` `iu` WHERE `br`.`agency_branch_id`=`iu`.`agency_branch_id` AND `iu`.`user_id`=`ul`.`user_id` LIMIT 1) as agency_branch
                FROM 
                    `icms_user_log` `ul`
                WHERE
                   `ul`.`user_log_is_deleted`='0' AND `ul`.`user_id` IN(" . $aParam['usersID'] . ")
                ORDER BY `ul`.`user_log_date_added` DESC 
                LIMIT " . $aParam['limit_start'] . "," . $aParam['limit_count'];
        
        $aResponse['list'] = $this->yel->GetAll($sSequel);

        $sql = "SELECT 
                  COUNT(1)
                FROM 
                    `icms_user_log` `ul`
                WHERE
                   `ul`.`user_log_is_deleted`='0' AND `ul`.`user_id` IN(" . $aParam['usersID'] . ")
        ";
        $aResponse['count'] = $this->yel->GetOne($sql);

        return $aResponse;
    }

    /**
     * get USer Log Param
     * 
     * @param int $iLogId
     * @return array $aResponse
     */
    public function getChangedValuesPerLogID($aParam) {
        $aResponse = [];

        $sSequel = "
                SELECT 
                   `user_log_update_field_name`,
                   `user_log_update_old_parameter`,
                   `user_log_update_new_parameter`
                FROM 
                    `icms_user_log_update_parameter` 
                WHERE
                    `user_log_id`='" . $aParam . "'";

        $aResponse['list'] = $this->yel->GetAll($sSequel);
        $aResponse['count'] = count($aResponse['list']);
        return $aResponse;
    }
    
    
    /**
     * get USer Log Param 
     * 
     * @return array $aResponse
     */
    public function getActivityLogsCriminalCase($aParam) {
        $aResponse = [];

        $sSequel = "
                SELECT 
                    `ul`.`user_id`,
                    `ul`.`user_log_id`,
                    `ul`.`user_log_event_type_id`,
                    `ul`.`agency_abbr`,
                    `ul`.`user_log_fullname`,
                    `ul`.`user_log_message`,
                    `ul`.`user_log_date_added`,
                    (SELECT `user_log_event_type_icon` FROM `icms_user_log_event_type` WHERE `user_log_event_type_id`=`ul`.`user_log_event_type_id` LIMIT 1) as 'badge',
                    (SELECT `user_log_event_type_class` FROM `icms_user_log_event_type` WHERE `user_log_event_type_id`=`ul`.`user_log_event_type_id` LIMIT 1) as 'badge_class',
                    (SELECT `br`.`agency_branch_name` FROM `icms_agency_branch` `br`, `icms_user` `iu` WHERE `br`.`agency_branch_id`=`iu`.`agency_branch_id` AND `iu`.`user_id`=`ul`.`user_id` LIMIT 1) as agency_branch
                FROM 
                    `icms_user_log` `ul`
                WHERE
                        `ul`.`user_log_is_deleted`='0'
                AND     `ul`.`user_log_event_type_id` IN ( SELECT `user_log_event_type_id` 
                                                           FROM `icms_user_log_event_type` 
                                                           WHERE `sub_module_id`  =  41 
                                                         )
                " . $aParam['c_batch_id'] . "           
                ORDER BY `ul`.`user_log_date_added` DESC 
                LIMIT " . $aParam['limit_start'] . "," . $aParam['limit_count'];
        
        $aResponse['list'] = $this->yel->GetAll($sSequel);

        $sql = "
                SELECT 
                  COUNT(1)
                FROM 
                    `icms_user_log` `ul`
                WHERE
                   `ul`.`user_log_is_deleted`='0'
                AND     `ul`.`user_log_event_type_id` IN ( SELECT `user_log_event_type_id` 
                                                           FROM `icms_user_log_event_type` 
                                                           WHERE `sub_module_id`  =  41 
                                                         )
                " . $aParam['c_batch_id'] . "                     
            ";
        $aResponse['count'] = $this->yel->GetOne($sql);

        return $aResponse;
    }
    
    /**
     * get USer Log Param 
     * 
     * @return array $aResponse
     */
    public function getActivityLogsAdministrativeCase($aParam) {
        $aResponse = [];

        $sSequel = "
                SELECT 
                    `ul`.`user_id`,
                    `ul`.`user_log_id`,
                    `ul`.`user_log_event_type_id`,
                    `ul`.`agency_abbr`,
                    `ul`.`user_log_fullname`,
                    `ul`.`user_log_message`,
                    `ul`.`user_log_date_added`,
                    (SELECT `user_log_event_type_icon` FROM `icms_user_log_event_type` WHERE `user_log_event_type_id`=`ul`.`user_log_event_type_id` LIMIT 1) as 'badge',
                    (SELECT `user_log_event_type_class` FROM `icms_user_log_event_type` WHERE `user_log_event_type_id`=`ul`.`user_log_event_type_id` LIMIT 1) as 'badge_class',
                    (SELECT `br`.`agency_branch_name` FROM `icms_agency_branch` `br`, `icms_user` `iu` WHERE `br`.`agency_branch_id`=`iu`.`agency_branch_id` AND `iu`.`user_id`=`ul`.`user_id` LIMIT 1) as agency_branch
                FROM 
                    `icms_user_log` `ul`
                WHERE
                        `ul`.`user_log_is_deleted`='0'
                AND     `ul`.`user_log_event_type_id` IN ( SELECT `user_log_event_type_id` 
                                                           FROM `icms_user_log_event_type` 
                                                           WHERE `sub_module_id`  =  44 
                                                         )
                " . $aParam['c_batch_id'] . "           
                ORDER BY `ul`.`user_log_date_added` DESC 
                LIMIT " . $aParam['limit_start'] . "," . $aParam['limit_count'];
        
        $aResponse['list'] = $this->yel->GetAll($sSequel);

        $sql = "
                SELECT 
                  COUNT(1)
                FROM 
                    `icms_user_log` `ul`
                WHERE
                   `ul`.`user_log_is_deleted`='0'
                AND     `ul`.`user_log_event_type_id` IN ( SELECT `user_log_event_type_id` 
                                                           FROM `icms_user_log_event_type` 
                                                           WHERE `sub_module_id`  =  44
                                                         )
                " . $aParam['c_batch_id'] . "                     
            ";
        $aResponse['count'] = $this->yel->GetOne($sql);

        return $aResponse;
    }
    
    
}
