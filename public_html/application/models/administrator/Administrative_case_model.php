<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Administrative_case_model extends CI_Model {

    public function getAdministrativeCaseList($aParam) {
        $aResponse = [];

        $sql = "
            SELECT 
                `cv`.`case_victim_id`,
                `cv`.`victim_id`,
                `c`.`case_id`, 
                (SELECT CONCAT_WS(' ', `victim_info_first_name` , `victim_info_middle_name`, `victim_info_last_name`, `victim_info_suffix`) FROM `icms_victim_info` WHERE `victim_id` = `cv`.`victim_id` AND `victim_info_is_assumed` = 0) as `victim_name`,      
                
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
                `cvs`.`case_victim_services_aging_date`, 
                
                (SELECT `legal_cc_slip_investigation_no` FROM `icms_legal_cc_slip` WHERE  `case_id` = `cv`.`case_id` LIMIT 1) as `legal_cc_slip_investigation_no`, 
                
                (SELECT `service_days` FROM `icms_services` WHERE `services_id` = 41) as `service_day`, 
                
                ( SELECT 
                    `laccl`.`legal_ac_stage_id` 
                  FROM 
                    `icms_legal_ac_case_logs` `laccl` 
                  WHERE 
                          `laccl`.`legal_ac_case_id` = (SELECT `lac`.`legal_ac_case_id` FROM `icms_legal_ac_cases` `lac` WHERE `lac`.`victim_id` = `cv`.`victim_id` AND `lac`.`case_id` = `c`.`case_id`)
                  ORDER BY `laccl`.`legal_ac_stage_id` DESC LIMIT 1
                ) as `last_legal_ac_stage_id`, 
                                            
                (SELECT 
                    `legal_ac_stage_name` 
                 FROM 
                    `icms_legal_ac_stages` 
                 WHERE 
                    `legal_ac_stage_id` =  `last_legal_ac_stage_id`
                )  as `last_stage_id_name`,
                 
                ( SELECT 
                    `laccl`.`legal_ac_case_log_status` 
                  FROM 
                    `icms_legal_ac_case_logs` `laccl` 
                  WHERE 
                          `laccl`.`legal_ac_case_id` = (SELECT `lac`.`legal_ac_case_id` FROM `icms_legal_ac_cases` `lac` WHERE `lac`.`victim_id` = `cv`.`victim_id` AND `lac`.`case_id` = `c`.`case_id`)
                  ORDER BY `laccl`.`legal_ac_stage_id` DESC LIMIT 1
                ) as `last_legal_ac_stage_status`
                
                
            FROM    
                `icms_case_victim` `cv`,
                `icms_case_victim_services` `cvs`, 
                `icms_case` `c`
            WHERE
                `cvs`.`case_victim_id`=`cv`.`case_victim_id` 
            AND `cvs`.`case_victim_services_is_active`= 1
            AND `cvs`.`services_id` = 41
            AND `c`.`case_id` = `cv`.`case_id`
            " . $aParam['c_keyword'] . " 
            GROUP BY `cv`.`case_id`
            LIMIT " . $aParam['start'] . "," . $aParam['limit'] . "  
        ";

        $aResponse['listing'] = $this->yel->GetAll($sql);

        $sql = "
            SELECT
                COUNT(1)
            FROM    
               `icms_case_victim` `cv`,
               `icms_case_victim_services` `cvs`, 
               `icms_case` `c`
            WHERE
                `cvs`.`case_victim_id`=`cv`.`case_victim_id` 
            AND `cvs`.`case_victim_services_is_active`= 1
            AND `cvs`.`services_id` = 41
            AND `c`.`case_id` = `cv`.`case_id`
            " . $aParam['c_keyword'] . " 
            GROUP BY `cv`.`case_id`
        ";

        $aResponse['count'] = $this->yel->GetAll($sql);
        $aResponse['count'] = sizeof($aResponse['count']);

        return $aResponse;
    }

    public function getAdministrativeCaseListReportForBatch($aParam) {

        $sql = "    
            SELECT 
                `cv`.`case_victim_id`,
                `cv`.`victim_id`,
                `cv`.`case_id`, 
                 CONCAT_WS(' ', `vi`.`victim_info_first_name` , `vi`.`victim_info_middle_name`, `vi`.`victim_info_last_name`, `vi`.`victim_info_suffix`)  as `victim_name`,    
                `cvs`.`case_victim_services_id`, 
                `cvs`.`services_id`,
                `c`.`case_number`, 
                MATCH (`c`.`case_number`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)  as relevance1, 
                MATCH (`vi`.`victim_info_first_name` , `vi`.`victim_info_middle_name`, `vi`.`victim_info_last_name`, `vi`.`victim_info_suffix`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)  as relevance2
            FROM    
                `icms_case_victim` `cv`,
                `icms_case_victim_services` `cvs`, 
                `icms_victim_info` `vi`,
                `icms_case` `c`
            WHERE
                `cvs`.`case_victim_id` = `cv`.`case_victim_id`
            AND `cvs`.`case_victim_services_is_active` = 1
            AND `cvs`.`services_id` = 41 
            AND `vi`.`victim_info_is_assumed` = 0
            AND `vi`.`victim_id` = `cv`.`victim_id`
            AND `c`.`case_id` = `cv`.`case_id`
            AND `c`.`case_id` IN (SELECT `lac`.`case_id` FROM `icms_legal_ac_cases` `lac` WHERE `lac`.`legal_ac_case_id` IN (SELECT `lacl`.`legal_ac_case_id` FROM `icms_legal_ac_case_logs` `lacl` WHERE `lacl`.`legal_ac_stage_id` = 4 AND `lacl`.`legal_ac_case_log_status` = 1 ))
            AND `c`.`case_id` NOT IN (SELECT `case_id` FROM `icms_legal_ac_docket_cases` WHERE `legal_ac_docket_is_active` = 1) 
            AND ( MATCH (`c`.`case_number`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)
                  OR MATCH (`vi`.`victim_info_first_name` , `vi`.`victim_info_middle_name`, `vi`.`victim_info_last_name`, `vi`.`victim_info_suffix`) AGAINST ('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)
                 )
            " . $aParam['condition'] . "
            GROUP BY `cv`.`case_id`
            ORDER BY  (relevance1 + relevance2)  DESC
        ";
        
        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function addBatchListForDocket($aParam) {
        $sql = " 
            INSERT INTO 
                `icms_legal_ac_dockets`
            SET 
                `legal_ac_docket_number`   = '" . $aParam['legal_ac_docket_number'] . "',
                `legal_ac_docket_date_added` = now(),
                `legal_ac_docket_added_by` = " . $this->session->userdata('userData')['user_id'] . "
            ";

        $aResponse = $this->yel->exec($sql);

        return $aResponse;
    }

    public function addLegalACDocketCasesVictim($aParam) {
        $sql = " 
            INSERT INTO 
                `icms_legal_ac_docket_cases`
            SET 
                `legal_ac_docket_id`   = '" . $aParam['legal_ac_docket_id'] . "',
                `legal_ac_case_id` =  '" . $aParam['legal_ac_case_id'] . "',
                `case_id` =  '" . $aParam['case_id'] . "',
                `victim_id` =  '" . $aParam['victim_id'] . "',
                `legal_ac_docket_is_active` = 1, 
                `legal_ac_docket_case_date_added` = now(),
                `legal_ac_docket_case_added_by` = " . $this->session->userdata('userData')['user_id'] . "    
            ";

        $aResponse = $this->yel->exec($sql);

        return $aResponse;
    }

    public function getVictimIdByCaseID($case_id) {
        $sql = "
            SELECT
               `victim_id`
            FROM    
               `icms_case_victim` `cv`
            WHERE
                `cv`.`case_id` = '" . $case_id . "'
        ";

        $aResponse = $this->yel->GetOne($sql);

        return $aResponse;
    }

    public function getLegalACCaseIdByCaseID($case_id) {
        $sql = "
            SELECT
               `legal_ac_case_id`
            FROM    
               `icms_legal_ac_cases`
            WHERE
                `case_id` = '" . $case_id . "'
        ";

        $aResponse = $this->yel->GetOne($sql);

        return $aResponse;
    }
    
    public function getAdministrativeCaseBatchList($aParam) {

        $aResponse = [];

        $sql = " 
            SELECT 
                `lacd`.`legal_ac_docket_id`,
                `lacd`.`legal_ac_docket_number`,
                DATE_FORMAT (`lacd`.`legal_ac_docket_date_added`, '%M %d, %Y') as legal_ac_docket_date_added,
                (SELECT COUNT(1) FROM `icms_legal_ac_docket_cases`  WHERE  `legal_ac_docket_id` =  `lacd`.`legal_ac_docket_id` LIMIT 1 ) as `victim_count`, 
                (SELECT CONCAT(`user_firstname`, ' ', `user_lastname` ) FROM `icms_user` WHERE `user_id` = `lacd`.`legal_ac_docket_added_by` LIMIT 1) as `user_full_name`,
                (SELECT `legal_ac_stage_id` FROM `icms_legal_ac_docket_logs` WHERE `legal_ac_docket_id` = `lacd`.`legal_ac_docket_id` ORDER BY `legal_ac_stage_id` DESC  LIMIT 1) as `last_stage_id`,
                ( SELECT `legal_ac_stage_name` 
                  FROM `icms_legal_ac_stages` 
                  WHERE  
                        `legal_ac_stage_id` = `last_stage_id`
                  LIMIT 1
                ) as `last_stage_id_name`,
                (SELECT `legal_ac_docket_log_status` FROM `icms_legal_ac_docket_logs` WHERE `legal_ac_docket_id` = `lacd`.`legal_ac_docket_id` ORDER BY `legal_ac_stage_id` DESC  LIMIT 1) as `last_stage_status`
            FROM 
                `icms_legal_ac_dockets` `lacd`
            " . $aParam['c_keyword'] . "  
            ORDER BY `lacd`.`legal_ac_docket_id`  DESC 
            LIMIT " . $aParam['start'] . "," . $aParam['limit'] . "  
        ";
        
//         echo $sql; exit();

        $aResponse['listing'] = $this->yel->getAll($sql);

        $sql = " 
            SELECT 
                COUNT(1)
            FROM 
                `icms_legal_ac_dockets` `lacd`
            " . $aParam['c_keyword'] . "  
        ";

        $aResponse['count'] = $this->yel->getOne($sql);

        return $aResponse;
    }

    public function getAdministrativeCaseListTaggedAgencyById($case_id) {

        $sql = "
            SELECT
               (SELECT `agency_id` FROM `icms_agency_branch` WHERE `agency_branch_id` = `cvsat`.`agency_branch_id`) as `agnc_id`,
               (SELECT `agency_name` FROM `icms_agency` WHERE `agency_id` = `agnc_id`  LIMIT 1) as `agency_name`,
               (SELECT `agency_abbr` FROM `icms_agency` WHERE `agency_id` = `agnc_id`  LIMIT 1) as `agency_abbr`
            FROM    
               `icms_case_victim` `cv`,
               `icms_case_victim_services` `cvs`, 
               `icms_case` `c`, 
               `icms_case_victim_services_agency_tag` `cvsat`
            WHERE
                `cvs`.`case_victim_id`=`cv`.`case_victim_id` 
            AND `cvs`.`case_victim_services_is_active`= 1
            AND `cvs`.`services_id` = 41
            AND `c`.`case_id` = `cv`.`case_id`
            AND `cvs`.`case_victim_services_id` = `cvsat`.`case_victim_services_id`
            AND `c`.`case_id` = " . $case_id . "
            GROUP BY `cvsat`.`agency_branch_id`
        ";

        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }

    public function checkFillingRecieptComplaintsExist($aParam) {

        $sql = " 
            SELECT 
                COUNT(1)
            FROM 
                `icms_legal_ac_cases`
            WHERE 
                `case_id`   = " . $aParam['case_id'] . "
            AND `victim_id` = " . $aParam['victim_id'] . "              
        ";
        $aResponse = $this->yel->GetOne($sql);
        return $aResponse;
    }

    public function addFilingReceiptComplaints($aParam) {
        $sql = " 
            INSERT INTO 
                `icms_legal_ac_cases`
            SET 
                `case_id`   = " . $aParam['case_id'] . ",
                `victim_id` = " . $aParam['victim_id'] . ",
                `legal_ac_case_no` = '" . $aParam['legal_ac_case_no'] . "',
                `legal_ac_case_date_added` = now(), 
                `legal_ac_case_added_by` = " . $this->session->userdata('userData')['user_id'] . "
            ";

        $aResponse = $this->yel->exec($sql);

        return $aResponse;
    }

    public function setFilingReceiptComplaints($aParam) {
        $sql = " 
            UPDATE  
                `icms_legal_ac_cases`
            SET 
                `legal_ac_case_no` = '" . $aParam['legal_ac_case_no'] . "'
            WHERE 
                `case_id`   = " . $aParam['case_id'] . "
            AND `victim_id` = " . $aParam['victim_id'] . "
        ";

        $aResponse = $this->yel->exec($sql);

        return $aResponse;
    }

    public function addACCaseLogs($aParam) {
        $sql = " 
            INSERT INTO 
                `icms_legal_ac_case_logs`
            SET 
                `legal_ac_case_id`   = " . $aParam['legal_ac_case_id'] . ",
                `legal_ac_stage_id` = " . $aParam['legal_ac_stage_id'] . ",
                `legal_ac_case_log_date` = " . $this->yel->checkDateTimeIfExist($aParam['legal_ac_case_log_date']) . ",
                `legal_ac_case_log_remarks` = " . $this->yel->checkifStringExist($aParam['legal_ac_case_log_remarks']) . ",
                `legal_ac_case_log_status` = " . $aParam['legal_ac_case_log_status'] . ",
                `legal_ac_case_log_date_added` = now(), 
                `legal_ac_case_log_date_done` = " . $aParam['legal_ac_case_log_date_done'] . ",
                `legal_ac_case_log_added_by` = " . $this->session->userdata('userData')['user_id'] . "
            ";
        
        $aResponse = $this->yel->exec($sql);
        return $aResponse;
    }

    public function setACCaseLogs($aParam) {
        $sql = " 
            UPDATE
                `icms_legal_ac_case_logs`
            SET 
                `legal_ac_case_log_date` = " . $this->yel->checkDateTimeIfExist($aParam['legal_ac_case_log_date']) . ",
                `legal_ac_case_log_remarks` = " . $this->yel->checkifStringExist($aParam['legal_ac_case_log_remarks']) . ",
                `legal_ac_case_log_status` = " . $aParam['legal_ac_case_log_status'] . ",
                `legal_ac_case_log_date_modified` = now(), 
                `legal_ac_case_log_date_done` = " . $aParam['legal_ac_case_log_date_done'] . "
            WHERE 
                `legal_ac_case_id`  = (SELECT `legal_ac_case_id` FROM `icms_legal_ac_cases` WHERE  `case_id` = " . $aParam['case_id'] . " AND `victim_id` = " . $aParam['victim_id'] . " LIMIT 1)
            AND `legal_ac_stage_id` = " . $aParam['legal_ac_stage_id'] . "
        ";
        
        $aResponse = $this->yel->exec($sql);
        return $aResponse;
    }

    public function getFillingReceiptOfComplaintPerId($aParam) {

        $sql = " 
            SELECT 
                *
            FROM 
                `icms_legal_ac_cases` `lcb`
            WHERE       
                `case_id` = " . $aParam['case_id'] . "
            AND `victim_id` = " . $aParam['victim_id'] . "
        ";
        
        $aResponse = $this->yel->getRow($sql);

        return $aResponse;
    }

    public function getCCDateRemarksPerStage($aParam) {
        $sql = " 
                SELECT 
                    `legal_ac_case_log_id`,
                    `legal_ac_case_id`,
                    `legal_ac_stage_id`,
                    DATE_FORMAT(`legal_ac_case_log_date`, '%m/%d/%Y') as `legal_ac_case_log_date`,
                    `legal_ac_case_log_remarks`,
                    `legal_ac_case_log_status`
                FROM 
                    `icms_legal_ac_case_logs`
                WHERE 
                    `legal_ac_case_id` = (SELECT `legal_ac_case_id` FROM `icms_legal_ac_cases` WHERE  `case_id` = " . $aParam['case_id'] . " AND `victim_id` = " . $aParam['victim_id'] . " LIMIT 1)
                AND `legal_ac_stage_id` =  " . $aParam['legal_ac_stage_id'] . "
        ";
//        echo '<pre>';        echo $sql; exit();
        $aResponse = $this->yel->getRow($sql);

        return $aResponse;
    }
    
    public function getACDetailsPerStage($aParam) {
        $sql = " 
                SELECT 
                    `legal_ac_case_log_id`,
                    `legal_ac_case_id`,
                    `legal_ac_stage_id`,
                    DATE_FORMAT(`legal_ac_case_log_date`, '%m/%d/%Y') as `legal_ac_case_log_date`,
                    `legal_ac_case_log_remarks`,
                    `legal_ac_case_log_status`,
                    `legal_ac_case_log_param_one`
                FROM 
                    `icms_legal_ac_case_logs`
                WHERE 
                    `legal_ac_case_id` = (SELECT `legal_ac_case_id` FROM `icms_legal_ac_cases` WHERE  `case_id` = " . $aParam['case_id'] . " AND `victim_id` = " . $aParam['victim_id'] . " LIMIT 1)
                AND `legal_ac_stage_id` =  " . $aParam['legal_ac_stage_id'] . "
        ";
//        echo '<pre>';        echo $sql; exit();
        $aResponse = $this->yel->getRow($sql);

        return $aResponse;
    }

    public function getCCDateRemarksPerBatchStage($aParam) {
        $sql = " 
                SELECT 
                    `legal_ac_docket_log_id`,
                    `legal_ac_docket_id`,
                    `legal_ac_stage_id`,
                    DATE_FORMAT(`legal_ac_docket_log_date`, '%m/%d/%Y') as `legal_ac_docket_log_date`,
                    `legal_ac_docket_log_remarks`,
                    `legal_ac_docket_log_param_one`,
                    `legal_ac_docket_log_status`
                FROM 
                    `icms_legal_ac_docket_logs`
                WHERE 
                    `legal_ac_docket_id` = " . $aParam['legal_ac_docket_id'] . "
                AND `legal_ac_stage_id` =  " . $aParam['legal_ac_stage_id'] . "
        ";
        
        $aResponse = $this->yel->getRow($sql);

        return $aResponse;
    }

    public function getACCaseNo($aParam) {
        $sql = " 
                SELECT 
                    `legal_ac_case_no` 
                FROM 
                    `icms_legal_ac_cases` 
                WHERE  
                    `case_id` = " . $aParam['case_id'] . " 
                AND `victim_id` = " . $aParam['victim_id'] . "             
        ";

        $aResponse = $this->yel->getOne($sql);

        return $aResponse;
    }

    public function getACCaseId($aParam) {
        $sql = " 
                SELECT 
                    `legal_ac_case_id` 
                FROM 
                    `icms_legal_ac_cases` 
                WHERE  
                    `case_id` = " . $aParam['case_id'] . " 
                AND `victim_id` = " . $aParam['victim_id'] . "             
        ";

        $aResponse = $this->yel->getOne($sql);

        return $aResponse;
    }

    public function checkIfStageExist($aParam) {

        $sql = " 
                SELECT 
                    COUNT(1)
                FROM 
                    `icms_legal_ac_case_logs`
                WHERE 
                    `legal_ac_case_id` = " . $aParam['legal_ac_case_id'] . "
                AND   `legal_ac_stage_id` =  " . $aParam['legal_ac_stage_id'] . "
                LIMIT 1 
            ";

        $aResponse = $this->yel->getOne($sql);

        return $aResponse;
    }

    public function setACDocketLogs($aParam) {
        $sql = " 
            UPDATE
                `icms_legal_ac_docket_logs`
            SET 
                `legal_ac_docket_log_date` = " . $this->yel->checkDateTimeIfExist($aParam['legal_ac_docket_log_date']) . ",
                `legal_ac_docket_log_remarks` = " . $this->yel->checkifStringExist($aParam['legal_ac_docket_log_remarks']) . ",
                `legal_ac_docket_log_status` = " . $aParam['legal_ac_docket_log_status'] . ",
                `legal_ac_docket_date_modified` = now(), 
                `legal_ac_docket_log_date_done` = " . $aParam['legal_ac_docket_log_date_done'] . "
                " . $aParam['param']. "    
            WHERE 
                `legal_ac_docket_id`  = " . $aParam['legal_ac_docket_id'] . "
            AND `legal_ac_stage_id` = " . $aParam['legal_ac_stage_id'] . "
        ";
        $aResponse = $this->yel->exec($sql);
        return $aResponse;
    }

    public function addACDocketLogs($aParam) {
        $sql = " 
            INSERT INTO 
                `icms_legal_ac_docket_logs`
            SET 
                `legal_ac_docket_id`   = " . $aParam['legal_ac_docket_id'] . ",
                `legal_ac_stage_id` = " . $aParam['legal_ac_stage_id'] . ",
                `legal_ac_docket_log_date` = " . $this->yel->checkDateTimeIfExist($aParam['legal_ac_docket_log_date']) . ",
                `legal_ac_docket_log_remarks` = " . $this->yel->checkifStringExist($aParam['legal_ac_docket_log_remarks']) . ",
                `legal_ac_docket_log_status` = " . $aParam['legal_ac_docket_log_status'] . ",
                `legal_ac_docket_date_added` = now(), 
                `legal_ac_docket_log_date_done` = " . $aParam['legal_ac_docket_log_date_done'] . ",
                `legal_ac_docket_added_by` = " . $this->session->userdata('userData')['user_id'] . "
                " . $aParam['param']. "
            ";

        $aResponse = $this->yel->exec($sql);
        return $aResponse;
    }

    public function checkIfBatchStageExist($aParam) {
        $sql = " 
                SELECT 
                    COUNT(1)
                FROM 
                    `icms_legal_ac_docket_logs`
                WHERE 
                    `legal_ac_docket_id` = " . $aParam['legal_ac_docket_id'] . "
                AND   `legal_ac_stage_id` =  " . $aParam['legal_ac_stage_id'] . "
                LIMIT 1 
            ";

        $aResponse = $this->yel->getOne($sql);

        return $aResponse;
    }

    public function getVictimListPerBatch($aParam) {
        $sql = " 
            SELECT 
                `lacdc`.`legal_ac_docket_case_id`, 
                `lacdc`.`legal_ac_docket_id`, 
                `lacdc`.`legal_ac_case_id`, 
                `lacc`.`case_id`, 
                `lacc`.`victim_id`, 
                `vi`.`victim_info_first_name`,
                `vi`.`victim_info_middle_name`,
                `vi`.`victim_info_last_name`, 
                `vi`.`victim_info_suffix`, 
                `lacc`.`legal_ac_case_no`,
                `lacdc`.`legal_ac_docket_is_active`                
            FROM 
                `icms_legal_ac_docket_cases`  `lacdc`, 
                `icms_victim_info` `vi`,
                `icms_legal_ac_cases` `lacc`
            WHERE       
                `lacdc`.`legal_ac_docket_id` = " . $aParam['legal_ac_docket_id'] . "
            AND `lacdc`.`victim_id` = `vi`.`victim_id`
            AND `vi`.`victim_info_is_assumed` = 0 
            AND  `lacdc`.`legal_ac_case_id` = `lacc`.`legal_ac_case_id` 
        ";
        $aResponse = $this->yel->getAll($sql);
        return $aResponse;
    }

    public function setBatchVictimStatus($aParam) {
        $sql = " 
            UPDATE
                `icms_legal_ac_docket_cases`
            SET 
                `legal_ac_docket_is_active` = " . $aParam['status'] . ", 
                `legal_ac_docket_cases_date_modified` = now()
            WHERE 
                `legal_ac_docket_case_id`  = " . $aParam['legal_ac_docket_case_id'] . "
            ";
        $aResponse = $this->yel->exec($sql);

        return $aResponse;
    }

    public function getCaseNo($aParam) {
        $sql = " 
                SELECT 
                    `case_number`
                FROM 
                    `icms_case`
                WHERE 
                    `case_id` = " . $aParam['case_id'] . "
        ";
        $aResponse = $this->yel->getOne($sql);
        return $aResponse;
    }
    
     public function getDocketNo($aParam) {
        $sql = " 
                SELECT 
                    `legal_ac_docket_number`
                FROM 
                    `icms_legal_ac_dockets`
                WHERE 
                    `legal_ac_docket_id` = " . $aParam['legal_ac_docket_id'] . "
        ";
        $aResponse = $this->yel->getOne($sql);
        return $aResponse;
    }
    
    public function getVictimNamePerACBatchVictimId($aParam) {
         $sql = " 
            SELECT 
                CONCAT_WS (' ', `vi`.`victim_info_first_name`,
                `vi`.`victim_info_middle_name`,
                `vi`.`victim_info_last_name`,
                `vi`.`victim_info_suffix` ) as `victim_full_name`
            FROM 
                `icms_legal_ac_docket_cases`  `lacdc`, 
                `icms_victim_info` `vi`
            WHERE       
                `lacdc`.`legal_ac_docket_case_id`  = " . $aParam['legal_ac_docket_case_id'] . "
            AND `lacdc`.`victim_id` = `vi`.`victim_id`
            AND `vi`.`victim_info_is_assumed` = 0 
        ";

        $aResponse = $this->yel->getOne($sql);
        return $aResponse;
    }

}
