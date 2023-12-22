<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Service_log_model extends CI_Model {

    public function getServicesLogs($aParam) {
        $sql = "
                SELECT 
                    `h`.`case_victim_services_history_id`,
                    `h`.`case_victim_services_history_subject`,
                    `h`.`case_victim_services_history_remarks`,
                    `h`.`document_hash`,
                    `h`.`case_vistim_services_history_date_added`,
                    `h`.`case_vistim_services_history_added_by`
                FROM
                    `icms_case_victim_services_history` `h`
                WHERE
                    `h`.`case_victim_services_id`='" . $aParam['service_id'] . "'                        
                ORDER BY `h`.`case_vistim_services_history_date_added` DESC
                ";
        $aResult = $this->yel->getAll($sql);
        return $aResult;
    }

    public function getUserDetailsByUserId($user_id) {
        $sql = "
                SELECT 
                    `u`.`agency_branch_id`,
                    `ab`.`agency_branch_name`,
                    `a`.`agency_name`,
                    `a`.`agency_abbr`
                FROM
                    `icms_user` `u`,
                    `icms_agency_branch` `ab`,
                    `icms_agency` `a`
                    
                WHERE
                    `u`.`user_id`='" . $user_id . "'
                AND `ab`.`agency_branch_id`=`u`.`agency_branch_id`
                AND `a`.`agency_id`=`ab`.`agency_id`
                LIMIT 1";
        $aResult = $this->yel->getRow($sql);
        return $aResult;
    }

}
