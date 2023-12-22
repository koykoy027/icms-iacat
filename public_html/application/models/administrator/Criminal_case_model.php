<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Criminal_case_model extends CI_Model {

    public function getCriminalCaseList($aParam) {
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
                
                (SELECT `service_days` FROM `icms_services` WHERE `services_id` = 40) as `service_day`
                
            FROM    
                `icms_case_victim` `cv`,
                `icms_case_victim_services` `cvs`, 
                `icms_case` `c`
            WHERE
                `cvs`.`case_victim_id`=`cv`.`case_victim_id` 
            AND `cvs`.`case_victim_services_is_active`= 1
            AND `cvs`.`services_id` = 40
            AND `c`.`case_id` = `cv`.`case_id`
            " . $aParam['c_keyword'] . " 
            GROUP BY `cv`.`case_id`
            LIMIT " . $aParam['start'] . "," . $aParam['limit'] . "  
        ";
        
//        print_r($sql); exit();
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
            AND `cvs`.`services_id` = 40
            AND `c`.`case_id` = `cv`.`case_id`
            " . $aParam['c_keyword'] . " 
            GROUP BY `cv`.`case_id`
        ";

        $aResponse['count'] = $this->yel->GetAll($sql);
        $aResponse['count'] = sizeof($aResponse['count']);

        return $aResponse;
    }

    public function getCriminalCaseListTaggedAgencyById($case_id) {

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
            AND `cvsat`.`case_victim_services_agency_tag_is_active` = 1 
            AND `cvs`.`services_id` = 40
            AND `c`.`case_id` = `cv`.`case_id`
            AND `cvs`.`case_victim_services_id` = `cvsat`.`case_victim_services_id`
            AND `c`.`case_id` = " . $case_id . "
            GROUP BY `cvsat`.`agency_branch_id`
        ";

        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }

    public function addInvestigation($aParam) {

        $sql = " 
            INSERT INTO 
                `icms_legal_cc_slip`
            SET 
                `case_id`   = " . $aParam['case_id'] . ",
                `victim_id` = (SELECT `victim_id` FROM `icms_case_victim` WHERE `case_id` = " . $aParam['case_id'] . " LIMIT 1), 
                `legal_cc_slip_investigation_no` = '" . $aParam['legal_cc_slip_investigation_no'] . "',
                `legal_cc_slip_officer_name` = '" . $aParam['legal_cc_slip_officer_name'] . "' ,
                `legal_cc_slip_date_filed` = '" . $aParam['legal_cc_slip_date_filed'] . "',
                `legal_cc_slip_status` = " . $aParam['legal_cc_slip_status'] . ",
                `legal_cc_slip_date_added` = now(), 
                `legal_cc_slip_date_added_by` = " . $this->session->userdata('userData')['user_id'] . ", 
                `legal_cc_slip_date_done` = " . $aParam['legal_cc_slip_date_done'] . "
            ";

        $aResponse = $this->yel->exec($sql);

        return $aResponse;
    }

    public function setInvestigation($aParam) {

        $sql = " 
            UPDATE
                `icms_legal_cc_slip`
            SET 
                `victim_id` = (SELECT `victim_id` FROM `icms_case_victim` WHERE `case_id` = " . $aParam['case_id'] . "), 
                `legal_cc_slip_investigation_no` = '" . $aParam['legal_cc_slip_investigation_no'] . "',
                `legal_cc_slip_officer_name` = '" . $aParam['legal_cc_slip_officer_name'] . "' ,
                `legal_cc_slip_date_filed` = '" . $aParam['legal_cc_slip_date_filed'] . "',
                `legal_cc_slip_status` = " . $aParam['legal_cc_slip_status'] . ",
                `legal_cc_slip_date_done` = " . $aParam['legal_cc_slip_date_done'] . "
            WHERE 
                `case_id`  = " . $aParam['case_id'] . "
            ";
        $aResponse = $this->yel->exec($sql);

        return $aResponse;
    }

    public function checkInvestigationSlipExist($aParam) {

        $sql = "
            SELECT
                COUNT(1)
            FROM    
               `icms_legal_cc_slip`
            WHERE 
               `case_id` = " . $aParam['case_id'] . "
        ";

        $aResponse = $this->yel->GetOne($sql);

        return $aResponse;
    }

    public function getInvestigationByCaseVicticeServicesId($aParam) {

        
        $sql = " SELECT 
            `cc`.*, DATE_FORMAT(`cc`.`legal_cc_slip_date_filed`, '%m/%d/%Y') as `legal_cc_slip_date_filed_formated` ,
            (select CONCAT_WS (' ', `victim_info_first_name` , `victim_info_middle_name`, `victim_info_last_name`, `victim_info_suffix`) as v_name 
            from `icms_victim_info`
            where `victim_id` = `cc`.`victim_id`  AND `victim_info_is_assumed` = 0 limit 1) as name
            FROM `icms_legal_cc_slip` `cc` WHERE   `case_id` = " . $aParam['case_id'] . " ";
        
        
//        print_r($sql); exit();
        $aResponse = $this->yel->getRow($sql);
        return $aResponse;
    }

    public function getCriminalCaseListReportForBatch($aParam) {
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
            AND `cvs`.`services_id` = 40 
            AND `vi`.`victim_info_is_assumed` = 0
            AND `vi`.`victim_id` = `cv`.`victim_id`
            AND `c`.`case_id` = `cv`.`case_id`
            AND `c`.`case_id` IN (SELECT `case_id` FROM `icms_legal_cc_slip` WHERE `legal_cc_slip_is_active` = 1)
            AND `c`.`case_id` NOT IN (SELECT `case_id` FROM `icms_legal_cc_batch_victims`) 
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

    public function addInitialLegalCCBatch($aParam) {

        $sql = " 
            INSERT INTO 
                `icms_legal_cc_batch`
            SET 
                `legal_cc_batch_nps_no` = '" . $aParam['legal_cc_batch_nps_no'] . "', 
                `legal_cc_batch_date_added` = now(), 
                `legal_cc_batch_added_by`= " . $this->session->userdata('userData')['user_id'] . "
            ";

        $aResponse = $this->yel->exec($sql);

        return $aResponse;
    }

    public function addLegalCCBatchVictims($case_id, $legal_cc_batch_id) {
        $sql = " 
            INSERT INTO 
                `icms_legal_cc_batch_victims`
            SET 
                `legal_cc_slip_id` = (SELECT `legal_cc_slip_id` FROM `icms_legal_cc_slip` WHERE `case_id` = " . $case_id . "), 
                `case_id` = " . $case_id . ", 
                `legal_cc_batch_id` = " . $legal_cc_batch_id . ", 
                `victim_id` = (SELECT `victim_id` FROM `icms_case_victim` WHERE `case_id` = " . $case_id . "),  
                `legal_cc_batch_victim_is_active` = 1, 
                `legal_cc_batch_victim_date_added` =  now(), 
                `legal_cc_batch_victim_added_by` = " . $this->session->userdata('userData')['user_id'] . "
            ";

        $aResponse = $this->yel->exec($sql);

        return $aResponse;
    }

    public function getBatchDocketList($aParam) {

        $aResponse = [];

        $sql = " 
            SELECT 
                `lccb`.`legal_cc_batch_id`,
                `lccb`.`legal_cc_batch_nps_no`,
                DATE_FORMAT (`lccb`.`legal_cc_batch_date_added`, '%M %d, %Y') as legal_cc_batch_date_added,
                (SELECT COUNT(1) FROM `icms_legal_cc_batch_victims`  WHERE  `legal_cc_batch_id` =  `lccb`.`legal_cc_batch_id` LIMIT 1 ) as `victim_count`, 
                (SELECT CONCAT(`user_firstname`, ' ', `user_lastname` ) FROM `icms_user` WHERE `user_id` = `lccb`.`legal_cc_batch_added_by` LIMIT 1) as `user_full_name`,
                (SELECT `legal_cc_stage_id` FROM `icms_legal_cc_batch_stages` WHERE `legal_cc_batch_id` = `lccb`.`legal_cc_batch_id` ORDER BY `legal_cc_stage_id` DESC  LIMIT 1) as `last_stage_id`,
                ( SELECT `legal_cc_stage_name` 
                 FROM `icms_legal_cc_stages` 
                 WHERE  
                        `legal_cc_stage_id` = (SELECT `legal_cc_stage_id` FROM `icms_legal_cc_batch_stages` WHERE `legal_cc_batch_id` = `lccb`.`legal_cc_batch_id` ORDER BY `legal_cc_stage_id` DESC  LIMIT 1) 
                 LIMIT 1
                ) as `last_stage_id_name`,
                (SELECT `legal_cc_batch_stage_status` FROM `icms_legal_cc_batch_stages` WHERE `legal_cc_batch_id` = `lccb`.`legal_cc_batch_id` ORDER BY `legal_cc_stage_id` DESC  LIMIT 1) as `last_stage_status`
            FROM 
                `icms_legal_cc_batch` `lccb`
            " . $aParam['c_keyword'] . "  
            ORDER BY `lccb`.`legal_cc_batch_id`  DESC 
            LIMIT " . $aParam['start'] . "," . $aParam['limit'] . "  
        ";

        $aResponse['listing'] = $this->yel->getAll($sql);

        $sql = " 
            SELECT 
                COUNT(1)
            FROM 
                `icms_legal_cc_batch` `lccb`
            " . $aParam['c_keyword'] . "  
        ";

        $aResponse['count'] = $this->yel->getOne($sql);

        return $aResponse;
    }

    public function getVictimListPerBatch($aParam) {
        $sql = " 
            SELECT 
                `lccbv`.`legal_cc_batch_victim_id`, 
                `lccbv`.`legal_cc_batch_id`, 
                `lccbv`.`legal_cc_slip_id`, 
                `lccbv`.`case_id`, 
                `lccbv`.`victim_id`, 
                `vi`.`victim_info_first_name`,
                `vi`.`victim_info_middle_name`,
                `vi`.`victim_info_last_name`, 
                `vi`.`victim_info_suffix`, 
                `lccs`.`legal_cc_slip_investigation_no`,
                `lccbv`.`legal_cc_batch_victim_is_active`                
            FROM 
                `icms_legal_cc_batch_victims`  `lccbv`, 
                `icms_victim_info` `vi`,
                `icms_legal_cc_slip` `lccs`
            WHERE       
                `lccbv`.`legal_cc_batch_id` = " . $aParam['legal_cc_batch_id'] . "
            AND `lccbv`.`victim_id` = `vi`.`victim_id`
            AND `vi`.`victim_info_is_assumed` = 0 
            AND  `lccbv`.`legal_cc_slip_id` = `lccs`.`legal_cc_slip_id` 
        ";
        $aResponse = $this->yel->getAll($sql);
        return $aResponse;
    }

    public function getVictimNamePerCCBatchVictimId($aParam) {
        $sql = " 
            SELECT 
                CONCAT_WS (' ', `vi`.`victim_info_first_name`,
                `vi`.`victim_info_middle_name`,
                `vi`.`victim_info_last_name`,
                `vi`.`victim_info_suffix` ) as `victim_full_name`
            FROM 
                `icms_legal_cc_batch_victims`  `lccbv`, 
                `icms_victim_info` `vi`
            WHERE       
                `lccbv`.`legal_cc_batch_victim_id` = " . $aParam['legal_cc_batch_victim_id'] . "
            AND `lccbv`.`victim_id` = `vi`.`victim_id`
            AND `vi`.`victim_info_is_assumed` = 0 
        ";

        $aResponse = $this->yel->getOne($sql);
        return $aResponse;
    }

    public function setBatchVictimStatus($aParam) {
        $sql = " 
            UPDATE
                `icms_legal_cc_batch_victims`
            SET 
                `legal_cc_batch_victim_is_active` = " . $aParam['status'] . ", 
                `legal_cc_batch_victim_date_modified` = now()
            WHERE 
                `legal_cc_batch_victim_id`  = " . $aParam['legal_cc_batch_victim_id'] . "
            ";
        $aResponse = $this->yel->exec($sql);

        return $aResponse;
    }

    public function getFillingOfComplaintPerId($aParam) {

        $sql = " 
            SELECT 
                `lcb`.*
            FROM 
                `icms_legal_cc_batch` `lcb`
            WHERE       
                `lcb`.`legal_cc_batch_id` = " . $aParam['legal_cc_batch_id'] . "
        ";
        //print_r($sql); exit();

        $aResponse = $this->yel->getRow($sql);

        return $aResponse;
    }

    public function addBatchStagesForStage1($aParam) {
        $sql = " 
            INSERT INTO 
                `icms_legal_cc_batch_stages`
            SET 
                `legal_cc_batch_id` = " . $aParam['legal_cc_batch_id'] . ", 
                `legal_cc_batch_stage_status` = 0,
                `legal_cc_stage_id` = 1,
                `legal_cc_batch_stage_added_by` = " . $this->session->userdata('userData')['user_id'] . ",
                `legal_cc_batch_stage_date_added` = now()
        ";
        $aResponse = $this->yel->exec($sql);

        return $aResponse;
    }

    public function setFillinfOfComplaint($aParam) {

        $sql = " 
            UPDATE
                `icms_legal_cc_batch`
            SET 
                `legal_cc_batch_nps_no` = " . $this->yel->checkifStringExist($aParam['legal_cc_batch_nps_no']) . " ,
                `legal_cc_batch_date_filed` = " . $this->yel->checkDateIfExist($aParam['legal_cc_batch_date_filed']) . " ,
                `legal_cc_batch_prosecutor_office` = " . $this->yel->checkifStringExist($aParam['legal_cc_batch_prosecutor_office']) . " ,
                `legal_cc_batch_investigating_name` = " . $this->yel->checkifStringExist($aParam['legal_cc_batch_investigating_name']) . " ,
                `legal_cc_batch_case_title` = " . $this->yel->checkifStringExist($aParam['legal_cc_batch_case_title']) . ", 
                `legal_cc_batch_date_modified` = now()
            WHERE 
               `legal_cc_batch_id` = " . $aParam['legal_cc_batch_id'] . " 
            ";
//        echo '<pre>';        echo $sql; exit();
        $aResponse = $this->yel->exec($sql);

        return $aResponse;
    }

    public function checkIfStageExist($aParam) {

        $sql = " 
                SELECT 
                    COUNT(1)
                FROM 
                    `icms_legal_cc_batch_stages`
                WHERE 
                    `legal_cc_batch_id` = " . $aParam['legal_cc_batch_id'] . "
                AND   `legal_cc_stage_id` =  " . $aParam['legal_cc_stage_id'] . "
                LIMIT 1 
            ";

        $aResponse = $this->yel->getOne($sql);

        return $aResponse;
    }

    public function addLegalCCBatchPerStage($aParam) {
        $sql = " 
            INSERT INTO 
                `icms_legal_cc_batch_stages`
            SET 
                `legal_cc_batch_id` = " . $aParam['legal_cc_batch_id'] . ", 
                `legal_cc_stage_id` = " . $aParam['legal_cc_stage_id'] . ",
                `legal_cc_batch_stage_date` = " . $this->yel->checkDateIfExist($aParam['legal_cc_batch_stage_date']) . ",  
                `legal_cc_batch_stage_remarks` = " . $this->yel->checkifStringExist($aParam['legal_cc_batch_stage_remarks']) . ",
                `legal_cc_batch_stage_status` = " . $aParam['legal_cc_batch_stage_status'] . ",
                `legal_cc_batch_stage_added_by` = " . $this->session->userdata('userData')['user_id'] . ",
                `legal_cc_batch_stage_date_added` = now()
        ";

        $aResponse = $this->yel->exec($sql);
        return $aResponse;
    }

    public function addCourtTrialBatchInStage($aParam) {
        $sql = " 
            INSERT INTO 
                `icms_legal_cc_batch_stages`
            SET 
                `legal_cc_batch_id` = " . $aParam['legal_cc_batch_id'] . ", 
                `legal_cc_stage_id` = " . $aParam['legal_cc_stage_id'] . ",
                `legal_cc_batch_stage_added_by` = " . $this->session->userdata('userData')['user_id'] . ",
                `legal_cc_batch_stage_date_added` = now()
        ";

        $aResponse = $this->yel->exec($sql);
        return $aResponse;
    }

    public function addBatchCourtTrial($aParam) {
        $sql = " 
            INSERT INTO 
                `icms_legal_cc_batch_court_trials`
            SET 
                `legal_cc_batch_id` = " . $aParam['legal_cc_batch_id'] . ", 
                `legal_cc_batch_court_trial_date` = " . $this->yel->checkDateIfExist($aParam['legal_cc_batch_stage_date']) . ",  
                `legal_cc_batch_court_trial_remarks` = " . $this->yel->checkifStringExist($aParam['legal_cc_batch_stage_remarks']) . ",
                `legal_cc_batch_court_trial_date_added` = now(), 
                `legal_cc_batch_court_trial_added_by` = " . $this->session->userdata('userData')['user_id'] . "
        ";

        $aResponse = $this->yel->exec($sql);
        return $aResponse;
    }

    public function setLegalCCBatchPerStage($aParam) {
        $sql = " 
            UPDATE  
                `icms_legal_cc_batch_stages`
            SET 
                `legal_cc_batch_stage_date` = " . $this->yel->checkDateIfExist($aParam['legal_cc_batch_stage_date']) . ",  
                `legal_cc_batch_stage_remarks` = " . $this->yel->checkifStringExist($aParam['legal_cc_batch_stage_remarks']) . ",
                `legal_cc_batch_stage_status` = " . $aParam['legal_cc_batch_stage_status'] . ",
                `legal_cc_batch_stage_date_modified` = now()
            WHERE 
                 `legal_cc_batch_id` = " . $aParam['legal_cc_batch_id'] . "
            AND  `legal_cc_stage_id` = " . $aParam['legal_cc_stage_id'] . "
        ";

        $aResponse = $this->yel->exec($sql);
        return $aResponse;
    }

    public function setBatchStatus($aParam) {
        $sql = " 
            UPDATE  
                `icms_legal_cc_batch_stages`
            SET 
                `legal_cc_batch_stage_status` = " . $aParam['legal_cc_batch_stage_status'] . ",
                `legal_cc_batch_stage_date_modified` = now()
            WHERE 
                 `legal_cc_batch_id` = " . $aParam['legal_cc_batch_id'] . "
            AND  `legal_cc_stage_id` = " . $aParam['legal_cc_stage_id'] . "
        ";
        $aResponse = $this->yel->exec($sql);
        return $aResponse;
    }

    public function getCourtTrialsByBatch($aParam) {
        $sql = " 
                SELECT 
                    `legal_cc_batch_court_trial_date`, 
                    `legal_cc_batch_court_trial_remarks`, 
                    DATE_FORMAT(`legal_cc_batch_court_trial_date`, '%M %d, %Y') as `legal_cc_batch_court_trial_date_full` 
                FROM 
                    `icms_legal_cc_batch_court_trials`
                WHERE 
                    `legal_cc_batch_id` = " . $aParam['legal_cc_batch_id'] . "
        ";

        $aResponse = $this->yel->getAll($sql);

        return $aResponse;
    }

    public function setFillingInformationInCourt($aParam) {
        $sql = " 
            UPDATE  
                `icms_legal_cc_batch`
            SET 
                `legal_cc_batch_criminal_no` = " . $this->yel->checkifStringExist($aParam['legal_cc_batch_criminal_no']) . ",
                `legal_cc_batch_criminal_case_title` = " . $this->yel->checkifStringExist($aParam['legal_cc_batch_criminal_case_title']) . ",
                `legal_cc_batch_prosecutor_name` = " . $this->yel->checkifStringExist($aParam['legal_cc_batch_prosecutor_name']) . ",
                `legal_cc_batch_prosecutor_office_address` = " . $this->yel->checkifStringExist($aParam['legal_cc_batch_prosecutor_office_address']) . ",
                `legal_cc_batch_judge_name` = " . $this->yel->checkifStringExist($aParam['legal_cc_batch_judge_name']) . ",
                `legal_cc_batch_branch_no` = " . $this->yel->checkifStringExist($aParam['legal_cc_batch_branch_no']) . ", 
                `legal_cc_batch_date_modified` = now()            
            WHERE 
               `legal_cc_batch_id` = " . $aParam['legal_cc_batch_id'] . " 
        ";
        $aResponse = $this->yel->exec($sql);
        return $aResponse;
    }

    public function addFillingInformationInCourt($aParam) {
        $sql = " 
            INSERT INTO 
                `icms_legal_cc_batch_stages`
            SET 
                `legal_cc_batch_id` = " . $aParam['legal_cc_batch_id'] . ", 
                `legal_cc_stage_id` = 9,
                `legal_cc_batch_stage_date` = " . $this->yel->checkDateIfExist($aParam['legal_cc_batch_stage_date']) . ",  
                `legal_cc_batch_stage_added_by` = " . $this->session->userdata('userData')['user_id'] . ",
                `legal_cc_batch_stage_date_added` = now()
        ";

        $aResponse = $this->yel->exec($sql);
        return $aResponse;
    }

    public function checkFillingInformationInCourtExist($aParam) {
        $sql = " 
            SELECT 
                COUNT(1)
            FROM
                `icms_legal_cc_batch_stages`
            WHERE
                `legal_cc_batch_id` = " . $aParam['legal_cc_batch_id'] . "
            AND `legal_cc_stage_id` = 9
            LIMIT 1 
        ";
        $aResponse = $this->yel->getOne($sql);
        return $aResponse;
    }

    public function getCCDateRemarksPerStage($aParam) {

        $sql = " 
                SELECT 
                     `legal_cc_batch_stage_id`,
                     `legal_cc_batch_id`,
                     `legal_cc_stage_id`,
                     `legal_cc_batch_stage_date`,
                     `legal_cc_batch_stage_remarks`,
                     `legal_cc_batch_stage_status`
                FROM 
                    `icms_legal_cc_batch_stages`
                WHERE 
                    `legal_cc_batch_id` = " . $aParam['legal_cc_batch_id'] . "
                AND   `legal_cc_stage_id` =  " . $aParam['legal_cc_stage_id'] . "
        ";

        $aResponse = $this->yel->getRow($sql);

        return $aResponse;
    }

    public function getCCBatchNPSNo($aParam) {
        $sql = " 
                SELECT 
                    `legal_cc_batch_nps_no`
                FROM 
                    `icms_legal_cc_batch`
                WHERE 
                    `legal_cc_batch_id` = " . $aParam['legal_cc_batch_id'] . "
        ";
        $aResponse = $this->yel->getOne($sql);
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

}
