<?php

/**
 * Reports Internal Ajax
 * 
 * @module Ajax Loader
 * @author LBS eBusiness Solutions Corp. 
 * @since 2017
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

    const SUCCESS_RESPONSE = 1;
    const FAILED_RESPONSE = 0;
    const ZERO_COUNT = 0;
    const NO_RECORD = 'No record.';

    public function __construct() {
        parent::__construct();

        // load models
        $this->load->model('administrator/Reports_model');
        $this->load->model('administrator/Agencies_model');
    }

    /**
     * Ajax Route :: Action Controller
     */
    public function ajax() {

        // route ajax api
        $this->base_action_ajax();
    }

    public function sessionDestruct() {
        // session destroy
        $this->sessionPushLogout('admininistrator');
    }

    public function getAllGlobalParameter() {
        $aResponse = [];
        $aResult = [];
        $aResponse['flag'] = self::FAILED_RESPONSE;

        $aResult['base_report']['victim'] = $this->Reports_model->getBaseReportVictim();
        $aResult['base_report']['case'] = $this->Reports_model->getBaseReportCase();
        $aResult['base_report']['casevictim'] = $this->Reports_model->getBaseReportCaseVictim();
        $aResult['base_report']['minor'] = $this->Reports_model->getBaseReportMinor();

        // getGlobalParambyId($id) .. $id = parameter type id  
        $aResult['sex'] = $this->Reports_model->getGlobalParambyId(9);
        $aResult['civil_status'] = $this->Reports_model->getGlobalParambyId(3);
        $aResult['case_status'] = $this->Reports_model->getTransactionParambyId(3);
        $aResult['case_priority'] = $this->Reports_model->getTransactionParambyId(2);
        $aResult['employment_type'] = $this->Reports_model->getGlobalParambyId(7);
        $aResult['visa_type'] = $this->Reports_model->getGlobalParambyId(11);
        $aResult['complainant_source'] = $this->Reports_model->getGlobalParambyId(13);
        $aResult['deployment_type'] = $this->Reports_model->getGlobalParambyId(5);
        $aResult['country'] = $this->Reports_model->getCountries();
        $aResult['region'] = $this->Reports_model->getRegion();

        // get TIP Details 
        $aResult['tip_act'] = $this->Reports_model->getTIPDetailsById(1);
        $aResult['tip_purpose'] = $this->Reports_model->getTIPDetailsById(2);
        $aResult['tip_mean'] = $this->Reports_model->getTIPDetailsById(3);

        if (array_filter($aResult)) {
            $aResponse = $aResult;
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
        }
        return $aResult;
    }

    function remove_element($array, $value) {
        return array_diff($array, (is_array($value) ? $value : array($value)));
    }

    // Start Victim 
    public function getBaseReportVictimPrimaryCondition($id) {
        $aQuery = [];
        switch ((int) $id) {
            // by sex 
            case 1:
                $aQuery['select'] = "
                        ( SELECT 
                                `gp`.`parameter_name`
                          FROM 
                                `icms_global_parameter` `gp`
                          WHERE `gp`.`parameter_type_id` = 9 
                          AND `gp`.`parameter_count_id`= `v`.`sex_id` 
                          LIMIT 1
                        )
                ";
                $aQuery['groupBy'] = "
                        GROUP BY 
                        `v`.`sex_id`
                ";
                $aQuery['base'] = $this->Reports_model->getGlobalParambyId(9);
                break;
            // by civil status 
            case 2:
                $aQuery['select'] = "
                        ( SELECT 
                                `gp`.`parameter_name`
                          FROM 
                                `icms_global_parameter` `gp`
                          WHERE `gp`.`parameter_type_id` = 3
                          AND `gp`.`parameter_count_id`= `v`.`civil_status_id` 
                          LIMIT 1
                        )
                ";
                $aQuery['groupBy'] = "
                        GROUP BY 
                        `v`.`civil_status_id`
                ";
                $aQuery['base'] = $this->Reports_model->getGlobalParambyId(3);
                break;
            // by region
            case 3:
                $aQuery['select'] = "
                    (   SELECT 
                            `gc`.`location_name`
                        FROM 
                            `icms_global_location` `gc`
                        WHERE 
                            `gc`.`location_is_active` = 1 
                           AND `gc`.`location_type_id`='3'
                           AND `gc`.`location_prerequisite_id`='173'      
                           AND `gc`.`location_count_id` = `v`.`region_id`
                        LIMIT 1 
                    )
                ";

                $aQuery['groupBy'] = "
                        GROUP BY 
                        `v`.`region_id`
                ";

                $aQuery['base'] = $this->Reports_model->getRegion();
                break;

            default:
                $aQuery['select'] = "";
                $aQuery['groupBy'] = "";
                break;
        }
        array_push($aQuery['base'], array('name' => self::NO_RECORD));

        $aQuery['groupBy'] .= " , `date`  ORDER BY `v`.`case_date_added` ";
        return $aQuery;
    }

    public function __getBaseReportVictimPrimaryCondition($id) {
        $aQuery = [];
        switch ((int) $id) {
            case 1:
                $aQuery['select'] = "
                        ( SELECT 
                                `gp`.`parameter_name`
                          FROM 
                                `icms_global_parameter` `gp`
                          WHERE `gp`.`parameter_type_id` = 9 
                          AND `gp`.`parameter_count_id`= `v`.`victim_gender` 
                          LIMIT 1
                        )
                ";
                $aQuery['groupBy'] = "
                        GROUP BY 
                        `v`.`victim_gender`
                ";
                $aQuery['base'] = $this->Reports_model->getGlobalParambyId(9);
                break;
            case 2:
                $aQuery['select'] = "
                        ( SELECT 
                                `gp`.`parameter_name`
                          FROM 
                                `icms_global_parameter` `gp`
                          WHERE `gp`.`parameter_type_id` = 3
                          AND `gp`.`parameter_count_id`= `v`.`victim_civil_status` 
                          LIMIT 1
                        )
                ";
                $aQuery['groupBy'] = "
                        GROUP BY 
                        `v`.`victim_civil_status`
                ";
                $aQuery['base'] = $this->Reports_model->getGlobalParambyId(3);
                break;

            default:
                $aQuery['select'] = "";
                $aQuery['groupBy'] = "";
                break;
        }
        array_push($aQuery['base'], array('name' => self::NO_RECORD));

        $aQuery['groupBy'] .= " , `date`  ORDER BY `v`.`victim_date_added` ";
        return $aQuery;
    }

    public function getReportTypeVictimCondition($id) {

        switch ((int) $id) {
            case 1:
                //daily
                $aQuery['date'] = "
                    (DATE_FORMAT(`v`.`case_date_added`, '%M %d, %Y'))
                ";
                break;
            case 2:
                //weekly 
                $aQuery['date'] = "

                    (CONCAT((DATE_FORMAT(`v`.`case_date_added`, '%V')), CASE
                        WHEN (DATE_FORMAT(`v`.`case_date_added`, '%V'))%100 BETWEEN 11 AND 13 THEN 'th'
                        WHEN (DATE_FORMAT(`v`.`case_date_added`, '%V'))%10 = 1 THEN 'st'
                        WHEN (DATE_FORMAT(`v`.`case_date_added`, '%V'))%10 = 2 THEN 'nd'
                        WHEN (DATE_FORMAT(`v`.`case_date_added`, '%V'))%10 = 3 THEN 'rd'
                        ELSE 'th'
                     END, ' week of ', DATE_FORMAT(`v`.`case_date_added`, '%Y')))

                ";
                break;
            case 3:
                //monthly 
                $aQuery['date'] = "
                    (DATE_FORMAT(`v`.`case_date_added`, '%M %Y'))
                ";
                break;
            case 4:
                //quarterly                 
                $aQuery['date'] = "
                    (CONCAT( (QUARTER(`v`.`case_date_added`)) , 

                    CASE
                        WHEN (QUARTER(`v`.`case_date_added`)) = 1  THEN 'st'
                        WHEN (QUARTER(`v`.`case_date_added`)) = 2  THEN 'nd'
                        WHEN (QUARTER(`v`.`case_date_added`)) = 3 THEN  'rd'
                        ELSE 'th'
                    END, 

                    ' Quarter' ,' of ', DATE_FORMAT(`v`.`case_date_added`, '%Y')))
                ";
                break;
            case 5:
                //yearly 
                $aQuery['date'] = "
                    (DATE_FORMAT(`v`.`case_date_added`, '%Y'))
                ";
                break;
            default:
                $aQuery['date'] = "";
                break;
        }
        return $aQuery;
    }

    public function generateVictimReport($aParam) {

        $aResponse = [];
        $aResult = [];
        $aParamCon = [];
        $aTempStorage = [];
        $aResult['output'] = [];
        $aParamCon['groupBy'] = '';
        $aParamCon['select'] = '';
        $aParamCon['where'] = '';
        $iCount = 0;
        $aResponse['flag'] = self:: FAILED_RESPONSE;
        $aResult['optData'] = $aParam['optData'];

        $aParam = $this->yel->clean_array($aParam);

        //Date Range
        $aParamCon['start_date'] = $aParam['start_date'];
        $aParamCon['end_date'] = $aParam['end_date'];

        $aResult['br_primary'] = '';

        if (!isset($aParam['br_primary']) !== true) {
            $aResult['br_primary'] = $this->getBaseReportVictimPrimaryCondition($aParam['br_primary']);
            $aResult['date'] = $this->getReportTypeVictimCondition($aParam['report_type']);
            $aParamCon['groupBy'] = $aResult['br_primary']['groupBy'];
            $aParamCon['select'] = $aResult['br_primary']['select'];
            $aParamCon['date'] = $aResult['date']['date'];
            $aResult['base'] = $aResult['br_primary']['base'];
        }
        
        $aResult['optData'] = json_decode($aResult['optData'], true);

        if (!empty($aResult['optData']['civil_status']) !== false) {
            $sNull = '';
            if (in_array("no_record", $aResult['optData']['civil_status'], TRUE)) {
                $aResult['optData']['civil_status'] = $this->remove_element($aResult['optData']['civil_status'], 'no_record');
                //array_push($aResult['optData']['civil_status'], 'NULL', "''", "' '");
                $sNull = ' OR `v`.`civil_status_id` IS NULL ';
            }

            $aTemp = $aResult['optData']['civil_status'];
            if ((count($aTemp) == 0) && ($sNull != '')) {
                $aParamCon['where'] .= ' AND `v`.`civil_status_id` IS NULL ';
            } else {
                $aParamCon['where'] .= ' AND (`v`.`civil_status_id` IN (' . join(", ", $aResult['optData']['civil_status']) . ') ' . $sNull . ')';
            }
        }

        if (!empty($aResult['optData']['sex']) !== false) {
            $sNull = '';
            if (in_array("no_record", $aResult['optData']['sex'], TRUE)) {
                $aResult['optData']['sex'] = $this->remove_element($aResult['optData']['sex'], 'no_record');
                //array_push($aResult['optData']['sex'], 'NULL', "''", "' '");
                $sNull = ' OR `v`.`sex_id` IS NULL ';
            }

            $aTemp = $aResult['optData']['sex'];
            if ((count($aTemp) == 0) && ($sNull != '')) {
                $aParamCon['where'] .= ' AND `v`.`sex_id` IS NULL ';
            } else {
                $aParamCon['where'] .= ' AND (`v`.`sex_id` IN (' . join(", ", $aResult['optData']['sex']) . ') ' . $sNull . ')';
            }
        }

        // region 
        if (!empty($aResult['optData']['region']) !== false) {
            $sNull = '';
            if (in_array("no_record", $aResult['optData']['region'], TRUE)) {
                $aResult['optData']['region'] = $this->remove_element($aResult['optData']['region'], 'no_record');
                $sNull = ' OR `region_id` IS NULL ';
            }

            $aTemp = $aResult['optData']['region'];
            if ((count($aTemp) == 0) && ($sNull != '')) {
                $aParamCon['where'] .= ' AND `v`.`region_id` IS NULL ';
            } else {
                $aParamCon['where'] .= ' AND (`v`.`region_id`   IN (' . join(", ", $aResult['optData']['region']) . ') ' . $sNull . ') ';
            }
        }

        // for minor 
        if ($aParam['is_minor'] == '1') {
            $aParamCon['where'] .= " AND `deployment_age` <= 17 ";
        }

        // for admin only 
        if ($aParam['agency_id'] != '0') {
            $aParamCon['where'] .= ' 
                AND `v`.`added_user_agency_id` IN 
                    (SELECT `user_id` FROM `icms_user` 
                     WHERE `agency_branch_id` IN (SELECT `agency_branch_id` FROM `icms_agency_branch` WHERE `agency_id` = "' . $aParam['agency_id'] . '")
                    )
               ';
            if ($aParam['agency_branch_id'] != '0') {
                $aParamCon['where'] .= " AND `v`.`added_user_agency_id` IN (SELECT `user_id` FROM `icms_user` WHERE `agency_branch_id` = '" . $aParam['agency_branch_id'] . "')";
            }
        }


        $aResult['graph'] = $this->Reports_model->getGenerateVictimReportGraph($aParamCon);

        if (count($aResult['graph']) > 0) {
            // gather all null records   
            foreach ($aResult['graph'] as $key => $value) {
                if (isset($aResult['graph'][$key]['variable']) != true) {
                    $aResult['graph'][$key]['variable'] = self::NO_RECORD;
                }
            }

            $aResult['date'] = array_unique(array_column($aResult['graph'], 'date'));
            $aResult['variables'] = array_unique(array_column($aResult['graph'], 'variable'));

            // reset array index 
            $aResult['date'] = array_values($aResult['date']);

            $x = 0;
            $aTemplate = [];
            $aNewGraph = [];
            foreach ($aResult['date'] as $dK => $dV) {
                foreach ($aResult['variables'] as $vK => $vV) {
                    $aTemplate[$x]['variable'] = $vV;
                    $aTemplate[$x]['date'] = $dV;
                    $x++;
                }
            }

            $x = 0;
            foreach ($aTemplate as $tK => $tV) {
                $aNewGraph[$x]['date'] = $tV['date'];
                $aNewGraph[$x]['variable'] = $tV['variable'];
                $count = 0;
                foreach ($aResult['graph'] as $gK => $gV) {

                    if (($tV['variable'] == $gV['variable']) && ($tV['date'] == $gV['date'])) {
                        $count = $count + $gV['count'];
                    }
                }
                $aNewGraph[$x]['count'] = $count;
                $x++;
            }
            $aResult['graph'] = $aNewGraph;

            $x = 0;
            foreach ($aResult['date'] as $dK => $dV) {
                // get index of same date
                $aRes['indexDate'] = array_keys(array_column($aResult['graph'], 'date'), $dV);
                // get value of array
                $iIndexDate = 0;
                $aIndexDate = [];
                foreach ($aRes['indexDate'] as $key => $value) {
                    $aIndexDate[$iIndexDate] = $aResult['graph'][$value];
                    $iIndexDate++;
                }

                foreach ($aResult['base'] as $key => $value) {
                    $aResult['output']['seperate'][$x]['variable'] = $value['name'];
                    $aResult['output']['seperate'][$x]['count'] = self::ZERO_COUNT;
                    $aResult['output']['seperate'][$x]['date'] = $dV;
                    $iKey = array_search($value['name'], array_column($aIndexDate, 'variable'));
                    if ($iKey !== false) {
                        $aResult['output']['seperate'][$x]['count'] = $aIndexDate[$iKey]['count'];
                        $aResult['output']['seperate'][$x]['date'] = $aIndexDate[$iKey]['date'];
                    }
                    $x++;
                }
            }

            foreach ($aResult['date'] as $dK => $dV) {
                $aResult['output']['by_date'][$dK]['date'] = $dV;
                foreach ($aResult['output']['seperate'] as $osK => $osV) {
                    if ($dV == $osV['date']) {
                        $aResult['output']['by_date'][$dK][$osV['variable']] = $osV['count'];
                    }
                }
            }

            foreach ($aResult['base'] as $key => $value) {
                $iSum = 0;
                foreach ($aResult['output']['seperate'] as $osK => $osV) {
                    if ($value['name'] == $osV['variable']) {
                        $iSum += $osV['count'];
                    }
                }
                $aResult['output']['by_variable'][$key]['variable'] = $value['name'];
                $aResult['output']['by_variable'][$key]['count'] = $iSum;
            }

            $aResult['graph'] = $aResult['output'];

            unset($aResult['optData'], $aResult['br_primary'], $aResult['base'], $aResult['output']);
            $aResponse = $aResult;
            $aResponse['flag'] = self:: SUCCESS_RESPONSE;
        }

        return $aResponse;
    }

    // End Victim
    // Start Case 
    public function getBaseReportCasePrimaryCondition($id) {
        $aQuery = [];
        switch ((int) $id) {
            case 1:
                $aQuery['select'] = "
                        ( SELECT 
                                `tp`.`transaction_parameter_name`
                          FROM 
                                `icms_transaction_parameter` `tp`
                          WHERE `tp`.`transaction_parameter_type_id` = 3
                          AND `tp`.`transaction_parameter_count_id` = `c`.`case_status_id`
                          LIMIT 1
                        )
                ";
                $aQuery['groupBy'] = "
                        GROUP BY 
                        `c`.`case_status_id`
                ";
                $aQuery['base'] = $this->Reports_model->getTransactionParambyId(3);
                break;
            case 2:
                $aQuery['select'] = "
                        ( SELECT 
                                `tp`.`transaction_parameter_name`
                          FROM 
                                `icms_transaction_parameter` `tp`
                          WHERE `tp`.`transaction_parameter_type_id` = 2
                          AND `tp`.`transaction_parameter_count_id` = `c`.`case_priority_level_id`
                          LIMIT 1
                        )
                ";
                $aQuery['groupBy'] = "
                        GROUP BY 
                        `c`.`case_priority_level_id`
                ";
                $aQuery['base'] = $this->Reports_model->getTransactionParambyId(2);
                break;
            default:
                $aQuery['select'] = "";
                $aQuery['groupBy'] = "";
                break;
        }

        return $aQuery;
    }

    public function generateCaseReport($aParam) {
        $aResponse = [];
        $aResult = [];
        $aParamCon = [];
        $aTempStorage = [];
        $aParamCon['groupBy'] = '';
        $aParamCon['select'] = '';
        $aParamCon['where'] = '';
        $iCount = 0;
        $aResult['optData'] = $aParam['optData'];

        $aParam = $this->yel->clean_array($aParam);

        //Date Range
        $aParamCon['start_date'] = $aParam['start_date'];
        $aParamCon['end_date'] = $aParam['end_date'];

        $aResult['br_primary'] = '';

        if (!isset($aParam['br_primary']) !== true) {
            $aResult['br_primary'] = $this->getBaseReportCasePrimaryCondition($aParam['br_primary']);
            $aParamCon['groupBy'] = $aResult['br_primary']['groupBy'];
            $aParamCon['select'] = $aResult['br_primary']['select'];
            $aResult['base'] = $aResult['br_primary']['base'];
        }

        $aResult['optData'] = json_decode($aResult['optData'], true);

        if (!empty($aResult['optData']['case_priority']) !== false) {
            $sNull = '';
            if (in_array("no_record", $aResult['optData']['case_priority'], TRUE)) {
                $aResult['optData']['case_priority'] = $this->remove_element($aResult['optData']['case_priority'], 'no_record');
                //array_push($aResult['optData']['case_priority'], 'NULL', "''", "' '");
                $sNull = ' OR `c`.`case_priority_level_id` IS NULL ';
            }

            $aTemp = $aResult['optData']['case_priority'];
            if ((count($aTemp) == 0) && ($sNull != '')) {
                $aParamCon['where'] .= ' AND `c`.`case_priority_level_id` IS NULL ';
            } else {
                $aParamCon['where'] .= ' AND (`c`.`case_priority_level_id` IN (' . join(", ", $aResult['optData']['case_priority']) . ') ' . $sNull . ')';
            }
        }

        if (!empty($aResult['optData']['case_status']) !== false) {
            $sNull = '';
            if (in_array("no_record", $aResult['optData']['case_status'], TRUE)) {
                $aResult['optData']['case_status'] = $this->remove_element($aResult['optData']['case_status'], 'no_record');
                //array_push($aResult['optData']['case_status'], 'NULL', "''", "' '");
                $sNull = ' OR `c`.`case_status_id` IS NULL ';
            }
            $aTemp = $aResult['optData']['case_status'];
            if ((count($aTemp) == 0) && ($sNull != '')) {
                $aParamCon['where'] .= ' AND `c`.`case_status_id` IS NULL ';
            } else {
                $aParamCon['where'] .= ' AND (`c`.`case_status_id` IN (' . join(", ", $aResult['optData']['case_status']) . ') ' . $sNull . ')';
            }
        }


        $aResult['graph'] = $this->Reports_model->getGenerateCaseReportGraph($aParamCon);


        foreach ($aResult['graph'] as $key => $value) {
            if (isset($aResult['graph'][$key]['variable']) != true) {
                $iCount += $aResult['graph'][$key]['count'];
                unset($aResult['graph'][$key]);
            }
        }

        // reset array index 
        $aResult['graph'] = array_values($aResult['graph']);

        $aResult['output'] = [];

        // get no record found
        $x = 0;
        foreach ($aResult['base'] as $key => $value) {//            
            $aResult['output'][$x]['variable'] = $value['name'];
            $aResult['output'][$x]['count'] = self::ZERO_COUNT;
            $iKey = array_search($value['name'], array_column($aResult['graph'], 'variable'));
            if ($iKey !== false) {
                $aResult['output'][$x]['count'] = $aResult['graph'][$iKey]['count'];
            }
            $x++;
        }

        $aResult['graph'] = $aResult['output'];

        if ($iCount > 0) {
            $sVariable = 'No record';
            $aNoRecord = array(
                'count' => $iCount,
                'variable' => $sVariable
            );
            $aResult['graph'][count($aResult['graph'])] = $aNoRecord;
        }


        //Unset Data
        unset($aResult['optData'], $aResult['br_primary'], $aResult['base'], $aResult['output']);


        $aResponse = $aResult;
        return $aResponse;
    }

    // End Case 
    // Start Case Victim 

    public function getBaseReportVictimCasePrimaryCondition($id) {
        $aQuery = [];

        $aQuery['select'] = "";
        $aQuery['groupBy'] = " GROUP BY `variable`";
        $aQuery['where'] = "";
        $aQuery['base'] = "";
        $aQuery['limit'] = "";

        switch ((int) $id) {
            case 1:
                $aQuery['select'] = "
                        (SELECT 
                            `gp`.`parameter_name`
                        FROM 
                            `icms_global_parameter` `gp` 
                        WHERE 
                            `gp`.`parameter_type_id` = 5
                        AND `gp`.`parameter_count_id` =  `cvd`.`case_victim_deployment_type`
                        LIMIT 1)
                ";
                $aQuery['base'] = $this->Reports_model->getGlobalParambyId(5);
                break;
            case 2:
                $aQuery['select'] = "
                        (SELECT 
                            `gp`.`parameter_name`
                        FROM 
                            `icms_global_parameter` `gp` 
                        WHERE 
                            `gp`.`parameter_type_id` = 13
                        AND `gp`.`parameter_count_id` =  `cc`.`case_complainant_source_id`                            
                        LIMIT 1)
                ";
                $aQuery['base'] = $this->Reports_model->getGlobalParambyId(13);
                break;
            case 3:
                $aQuery['select'] = "
                        (SELECT 
                            `gp`.`parameter_name`
                        FROM 
                            `icms_global_parameter` `gp` 
                        WHERE 
                            `gp`.`parameter_type_id` = 11
                        AND `gp`.`parameter_count_id` =  `cvd`.`case_victim_visa_category_id` LIMIT 1 )
                ";
                $aQuery['base'] = $this->Reports_model->getGlobalParambyId(11);
                break;
            case 4:
                $aQuery['select'] = "
                        (SELECT 
                            `gp`.`parameter_name`
                        FROM 
                            `icms_global_parameter` `gp` 
                        WHERE 
                            `gp`.`parameter_type_id` = 7
                        AND `gp`.`parameter_count_id` = `cve`.`case_victim_employment_type` LIMIT 1 )                          
                ";
                $aQuery['base'] = $this->Reports_model->getGlobalParambyId(7);
                break;
            case 5:
                // purpose 
                $aQuery['select'] = "(
                        SELECT 
                            `td`.`tip_details_name`
                        FROM 
                            `icms_tip_details` `td` 
                        WHERE 
                            `td`.`tip_form_type_id` = 2
                        AND `td`.`tip_details_count` = (
                            SELECT 
                                `cvt`.`case_victim_tip_type_content_id` 
                            FROM 
                                `icms_case_victim_tip` `cvt`
                            WHERE 
                                `cvt`.`case_victim_id` = `cv`.`case_victim_id`
                            LIMIT 1 
                        )
                        LIMIT 1 
                    )                          
                ";

                $aQuery['where'] = "
                        AND `cv`.`case_victim_id` IN (
                            SELECT 
                                `cvt`.`case_victim_id`
                            FROM 
                                `icms_case_victim_tip` `cvt`
                            WHERE
                                `cvt`.`case_victim_tip_type_id` = 2
                        )                         
                ";
                $aQuery['base'] = $this->Reports_model->getTIPDetailsById(2);
                break;
            case 6:
                // act 
                $aQuery['select'] = "(
                        SELECT 
                            `td`.`tip_details_name`
                        FROM 
                            `icms_tip_details` `td` 
                        WHERE 
                            `td`.`tip_form_type_id` = 1
                        AND `td`.`tip_details_count` = (
                            SELECT 
                                `cvt`.`case_victim_tip_type_content_id` 
                            FROM 
                                `icms_case_victim_tip` `cvt`
                            WHERE 
                                `cvt`.`case_victim_id` = `cv`.`case_victim_id`
                            LIMIT 1 
                        )
                        LIMIT 1 
                    )                          
                ";

                $aQuery['where'] = "
                        AND `cv`.`case_victim_id` IN (
                            SELECT 
                                `cvt`.`case_victim_id`
                            FROM 
                                `icms_case_victim_tip` `cvt`
                            WHERE
                                `cvt`.`case_victim_tip_type_id` = 1
                        )                         
                ";
                $aQuery['base'] = $this->Reports_model->getTIPDetailsById(1);
                break;
            case 7:
                // mean 
                $aQuery['select'] = "(
                        SELECT 
                            `td`.`tip_details_name`
                        FROM 
                            `icms_tip_details` `td` 
                        WHERE 
                            `td`.`tip_form_type_id` = 3
                        AND `td`.`tip_details_count` = (
                            SELECT 
                                `cvt`.`case_victim_tip_type_content_id` 
                            FROM 
                                `icms_case_victim_tip` `cvt`
                            WHERE 
                                `cvt`.`case_victim_id` = `cv`.`case_victim_id`
                            LIMIT 1 
                        )
                        LIMIT 1 
                    )                          
                ";

                $aQuery['where'] = "
                        AND `cv`.`case_victim_id` IN (
                            SELECT 
                                `cvt`.`case_victim_id`
                            FROM 
                                `icms_case_victim_tip` `cvt`
                            WHERE
                                `cvt`.`case_victim_tip_type_id` = 3
                        )                         
                ";
                $aQuery['base'] = $this->Reports_model->getTIPDetailsById(3);
                break;

            case 8:

                $aQuery['select'] = "
                    (   SELECT 
                            `gc`.`country_name`
                        FROM 
                            `icms_global_country` `gc`
                        WHERE 
                            `gc`.`is_active` = 1 
                        AND `gc`.`country_id` =
                            (SELECT `cved`.`country_id` 
                             FROM `icms_case_victim_employment_details` `cved` 
                             WHERE  
                             `cved`.`case_victim_employment_id` = `cve`.`case_victim_employment_id` 
                             AND `cved`.`case_victim_employment_details_is_actual` = 1
                            )                            
                        LIMIT 1 
                    )
                ";
                $aQuery['base'] = $this->Reports_model->getCountries();
                break;

            default:
                $aQuery['select'] = "";
                $aQuery['limit'] = "";
                break;
        }
        array_push($aQuery['base'], array('name' => self::NO_RECORD));
        $aQuery['groupBy'] .= " , `date`  ORDER BY `c`.`case_date_added` " . $aQuery['limit'];
        return $aQuery;
    }

    public function getBaseReportVictimCasePrimaryConditionView($id) {
        $aQuery = [];

        $aQuery['select'] = "";
        $aQuery['groupBy'] = " GROUP BY `variable`";
        $aQuery['where'] = "";
        $aQuery['base'] = "";
        $aQuery['limit'] = "";

        switch ((int) $id) {

            // complainant source 
            case 2:
                $aQuery['select'] = "
                        (SELECT 
                            `gp`.`parameter_name`
                        FROM 
                            `icms_global_parameter` `gp` 
                        WHERE 
                            `gp`.`parameter_type_id` = 13
                        AND `gp`.`parameter_count_id` = `complainant_source_id`                            
                        LIMIT 1)
                ";
                $aQuery['base'] = $this->Reports_model->getGlobalParambyId(13);
                break;

            // country of deployment 
            case 8:
                $aQuery['select'] = "
                    (   SELECT 
                            `gc`.`country_name`
                        FROM 
                            `icms_global_country` `gc`
                        WHERE 
                            `gc`.`is_active` = 1 
                        AND `gc`.`country_id` =
                           `deployment_country_id`                         
                        LIMIT 1 
                    )
                ";
                $aQuery['base'] = $this->Reports_model->getCountries();
                break;

            // region 
            case 9:
                $aQuery['select'] = "
                    (   SELECT 
                            `gc`.`location_name`
                        FROM 
                            `icms_global_location` `gc`
                        WHERE 
                            `gc`.`location_is_active` = 1 
                           AND `gc`.`location_type_id`='3'
                           AND `gc`.`location_prerequisite_id`='173'      
                           AND `gc`.`location_count_id` = `region_id`
                        LIMIT 1 
                    )
                ";
                $aQuery['base'] = $this->Reports_model->getRegion();
                break;

            //  civil status 
            case 10:
                $aQuery['select'] = "
                        (SELECT 
                            `gp`.`parameter_name`
                        FROM 
                            `icms_global_parameter` `gp` 
                        WHERE 
                            `gp`.`parameter_type_id` = 3
                        AND `gp`.`parameter_count_id` = `civil_status_id`                            
                        LIMIT 1)
                ";
                $aQuery['base'] = $this->Reports_model->getGlobalParambyId(3);
                break;

            // sex 
            case 11:
                $aQuery['select'] = "
                        (SELECT 
                            `gp`.`parameter_name`
                        FROM 
                            `icms_global_parameter` `gp` 
                        WHERE 
                            `gp`.`parameter_type_id` = 9
                        AND `gp`.`parameter_count_id` = `sex_id`                            
                        LIMIT 1)
                ";
                $aQuery['base'] = $this->Reports_model->getGlobalParambyId(9);
                break;

            // csae priority 
            case 12:
                $aQuery['select'] = "
                        (SELECT 
                            `gp`.`transaction_parameter_name`
                        FROM 
                            `icms_transaction_parameter` `gp` 
                        WHERE 
                            `gp`.`transaction_parameter_type_id` = 2
                        AND `gp`.`transaction_parameter_count_id` = `priority_level_id`                            
                        LIMIT 1)
                ";
                $aQuery['base'] = $this->Reports_model->getTransactionParambyId(2);
                break;

            default:
                $aQuery['select'] = "";
                $aQuery['limit'] = "";
                break;
        }
        array_push($aQuery['base'], array('name' => self::NO_RECORD));
        $aQuery['groupBy'] .= " , `date`  ORDER BY `case_date_added` " . $aQuery['limit'];
        return $aQuery;
    }

    public function getBaseReportVictimAllegedCasePrimaryCondition($id) {
        $aQuery = [];

        $aQuery['select'] = "";
        $aQuery['groupBy'] = " GROUP BY `variable`";
        $aQuery['where'] = "";
        $aQuery['base'] = "";
        $aQuery['limit'] = "";

        switch ((int) $id) {

            // offender type 
            case 5:
                $aQuery['select'] = "
                        (case_offender_type_name)
                ";

                $aQuery['base'] = $this->Reports_model->getTransactionParambyId(10);
                break;

            // local 
            case 2:
                $aQuery['select'] = "
                    (`case_offender_name`)
                ";
                $aQuery['base'] = $this->Reports_model->getNameOffenderRecords(2);
                $aQuery['where'] = " AND `case_offender_type_id` = '2' ";
                break;

            // foreign 
            case 3:
                $aQuery['select'] = "
                    (`case_offender_name`)
                ";
                $aQuery['base'] = $this->Reports_model->getNameOffenderRecords(3);
                $aQuery['where'] = " AND `case_offender_type_id` = '3' ";
                break;

            // employer 
            case 1:
                $aQuery['select'] = "
                    (`case_offender_name`)
                ";
                $aQuery['base'] = $this->Reports_model->getNameOffenderRecords(1);
                $aQuery['where'] = " AND `case_offender_type_id` = '1' ";
                break;

            // other 
            case 4:
                $aQuery['select'] = "
                    (`case_offender_name`)
                ";
                $aQuery['base'] = $this->Reports_model->getNameOffenderRecords(4);
                $aQuery['where'] = " AND `case_offender_type_id` = '4' ";
                break;

            default:
                $aQuery['select'] = "";
                $aQuery['limit'] = "";
                break;
        }
        array_push($aQuery['base'], array('name' => self::NO_RECORD));
        $aQuery['groupBy'] .= " , `date`  ORDER BY `case_date_added` " . $aQuery['limit'];
        return $aQuery;
    }

    public function getBaseReportServicesCasePrimaryCondition($id) {
        $aQuery = [];

        $aQuery['select'] = "";
        $aQuery['groupBy'] = " GROUP BY `variable`";
        $aQuery['where'] = "";
        $aQuery['base'] = "";
        $aQuery['limit'] = "";

        switch ((int) $id) {

            // all agency  
            case 1:
                $aQuery['select'] = "
                    (`agency_name`)
                ";
                $aQuery['base'] = $this->Reports_model->getAgencyTypes();
                break;

            default:
                $aQuery['select'] = "";
                $aQuery['limit'] = "";
                break;
        }
        array_push($aQuery['base'], array('name' => self::NO_RECORD));
        $aQuery['groupBy'] .= " , `date`  ORDER BY `case_victim_services_agency_tag_added_date` " . $aQuery['limit'];
        return $aQuery;
    }

    public function getReportTypeVictimCaseCondition($id) {

        switch ((int) $id) {
            case 1:
                //daily
                $aQuery['date'] = "
                    (DATE_FORMAT(`c`.`case_date_added`, '%M %d, %Y'))
                ";
                break;
            case 2:
                //weekly 
                $aQuery['date'] = "

                    (CONCAT((DATE_FORMAT(`c`.`case_date_added`, '%V')), CASE
                        WHEN (DATE_FORMAT(`c`.`case_date_added`, '%V'))%100 BETWEEN 11 AND 13 THEN 'th'
                        WHEN (DATE_FORMAT(`c`.`case_date_added`, '%V'))%10 = 1 THEN 'st'
                        WHEN (DATE_FORMAT(`c`.`case_date_added`, '%V'))%10 = 2 THEN 'nd'
                        WHEN (DATE_FORMAT(`c`.`case_date_added`, '%V'))%10 = 3 THEN 'rd'
                        ELSE 'th'
                     END, ' week of ', DATE_FORMAT(`c`.`case_date_added`, '%Y')))

                ";
                break;
            case 3:
                //monthly 
                $aQuery['date'] = "
                    (DATE_FORMAT(`c`.`case_date_added`, '%M %Y'))
                ";
                break;
            case 4:
                //quarterly                                 
                $aQuery['date'] = "
                    (CONCAT( (QUARTER(`c`.`case_date_added`)) , 

                    CASE
                        WHEN (QUARTER(`c`.`case_date_added`)) = 1  THEN 'st'
                        WHEN (QUARTER(`c`.`case_date_added`)) = 2  THEN 'nd'
                        WHEN (QUARTER(`c`.`case_date_added`)) = 3 THEN  'rd'
                        ELSE 'th'
                    END, 

                    ' Quarter' ,' of ', DATE_FORMAT(`c`.`case_date_added`, '%Y')))
                ";
                break;
            case 5:
                //yearly 
                $aQuery['date'] = "
                    (DATE_FORMAT(`c`.`case_date_added`, '%Y'))
                ";
                break;
            default:
                $aQuery['date'] = "";
                break;
        }
        return $aQuery;
    }

    public function getReportTypeVictimCaseConditionView($id) {

        switch ((int) $id) {
            case 1:
                //daily
                $aQuery['date'] = "
                    (DATE_FORMAT(`case_date_added`, '%M %d, %Y'))
                ";
                break;
            case 2:
                //weekly 
                $aQuery['date'] = "

                    (CONCAT((DATE_FORMAT(`case_date_added`, '%V')), CASE
                        WHEN (DATE_FORMAT(`case_date_added`, '%V'))%100 BETWEEN 11 AND 13 THEN 'th'
                        WHEN (DATE_FORMAT(`case_date_added`, '%V'))%10 = 1 THEN 'st'
                        WHEN (DATE_FORMAT(`case_date_added`, '%V'))%10 = 2 THEN 'nd'
                        WHEN (DATE_FORMAT(`case_date_added`, '%V'))%10 = 3 THEN 'rd'
                        ELSE 'th'
                     END, ' week of ', DATE_FORMAT(`case_date_added`, '%Y')))

                ";
                break;
            case 3:
                //monthly 
                $aQuery['date'] = "
                    (DATE_FORMAT(`case_date_added`, '%M %Y'))
                ";
                break;
            case 4:
                //quarterly                                 
                $aQuery['date'] = "
                    (CONCAT( (QUARTER(`case_date_added`)) , 

                    CASE
                        WHEN (QUARTER(`case_date_added`)) = 1  THEN 'st'
                        WHEN (QUARTER(`case_date_added`)) = 2  THEN 'nd'
                        WHEN (QUARTER(`case_date_added`)) = 3 THEN  'rd'
                        ELSE 'th'
                    END, 

                    ' Quarter' ,' of ', DATE_FORMAT(`case_date_added`, '%Y')))
                ";
                break;
            case 5:
                //yearly 
                $aQuery['date'] = "
                    (DATE_FORMAT(`case_date_added`, '%Y'))
                ";
                break;
            default:
                $aQuery['date'] = "";
                break;
        }
        return $aQuery;
    }

    public function getReportTypeVictimAllegedCaseCondition($id) {

        switch ((int) $id) {
            case 1:
                //daily
                $aQuery['date'] = "
                    (DATE_FORMAT(`case_date_added`, '%M %d, %Y'))
                ";
                break;
            case 2:
                //weekly 
                $aQuery['date'] = "

                    (CONCAT((DATE_FORMAT(`case_date_added`, '%V')), CASE
                        WHEN (DATE_FORMAT(`case_date_added`, '%V'))%100 BETWEEN 11 AND 13 THEN 'th'
                        WHEN (DATE_FORMAT(`case_date_added`, '%V'))%10 = 1 THEN 'st'
                        WHEN (DATE_FORMAT(`case_date_added`, '%V'))%10 = 2 THEN 'nd'
                        WHEN (DATE_FORMAT(`case_date_added`, '%V'))%10 = 3 THEN 'rd'
                        ELSE 'th'
                     END, ' week of ', DATE_FORMAT(`case_date_added`, '%Y')))

                ";
                break;
            case 3:
                //monthly 
                $aQuery['date'] = "
                    (DATE_FORMAT(`case_date_added`, '%M %Y'))
                ";
                break;
            case 4:
                //quarterly                                 
                $aQuery['date'] = "
                    (CONCAT( (QUARTER(`case_date_added`)) , 

                    CASE
                        WHEN (QUARTER(`case_date_added`)) = 1  THEN 'st'
                        WHEN (QUARTER(`case_date_added`)) = 2  THEN 'nd'
                        WHEN (QUARTER(`case_date_added`)) = 3 THEN  'rd'
                        ELSE 'th'
                    END, 

                    ' Quarter' ,' of ', DATE_FORMAT(`case_date_added`, '%Y')))
                ";
                break;
            case 5:
                //yearly 
                $aQuery['date'] = "
                    (DATE_FORMAT(`case_date_added`, '%Y'))
                ";
                break;
            default:
                $aQuery['date'] = "";
                break;
        }
        return $aQuery;
    }

    public function getReportTypeCaseServicesCondition($id) {

        switch ((int) $id) {
            case 1:
                //daily
                $aQuery['date'] = "
                    (DATE_FORMAT(`case_victim_services_agency_tag_added_date`, '%M %d, %Y'))
                ";
                break;
            case 2:
                //weekly 
                $aQuery['date'] = "

                    (CONCAT((DATE_FORMAT(`case_victim_services_agency_tag_added_date`, '%V')), CASE
                        WHEN (DATE_FORMAT(`case_victim_services_agency_tag_added_date`, '%V'))%100 BETWEEN 11 AND 13 THEN 'th'
                        WHEN (DATE_FORMAT(`case_victim_services_agency_tag_added_date`, '%V'))%10 = 1 THEN 'st'
                        WHEN (DATE_FORMAT(`case_victim_services_agency_tag_added_date`, '%V'))%10 = 2 THEN 'nd'
                        WHEN (DATE_FORMAT(`case_victim_services_agency_tag_added_date`, '%V'))%10 = 3 THEN 'rd'
                        ELSE 'th'
                     END, ' week of ', DATE_FORMAT(`case_victim_services_agency_tag_added_date`, '%Y')))

                ";
                break;
            case 3:
                //monthly 
                $aQuery['date'] = "
                    (DATE_FORMAT(`case_victim_services_agency_tag_added_date`, '%M %Y'))
                ";
                break;
            case 4:
                //quarterly                                 
                $aQuery['date'] = "
                    (CONCAT( (QUARTER(`case_victim_services_agency_tag_added_date`)) , 

                    CASE
                        WHEN (QUARTER(`case_victim_services_agency_tag_added_date`)) = 1  THEN 'st'
                        WHEN (QUARTER(`case_victim_services_agency_tag_added_date`)) = 2  THEN 'nd'
                        WHEN (QUARTER(`case_victim_services_agency_tag_added_date`)) = 3 THEN  'rd'
                        ELSE 'th'
                    END, 

                    ' Quarter' ,' of ', DATE_FORMAT(`case_victim_services_agency_tag_added_date`, '%Y')))
                ";
                break;
            case 5:
                //yearly 
                $aQuery['date'] = "
                    (DATE_FORMAT(`case_victim_services_agency_tag_added_date`, '%Y'))
                ";
                break;
            default:
                $aQuery['date'] = "";
                break;
        }
        return $aQuery;
    }

    public function generateCaseVictimReport($aParam) {
        $aResponse = [];
        $aResult = [];
        $aParamCon = [];
        $aTempStorage = [];
        $aResult['output'] = [];
        $aParamCon['groupBy'] = '';
        $aParamCon['select'] = '';
        $aParamCon['where'] = '';
        $iCount = 0;
        $aResponse['flag'] = self:: FAILED_RESPONSE;
        $aResult['optData'] = $aParam['optData'];

        $aParam = $this->yel->clean_array($aParam);

        //Date Range
        $aParamCon['start_date'] = $aParam['start_date'];
        $aParamCon['end_date'] = $aParam['end_date'];

        $aResult['br_primary'] = '';

        if (!isset($aParam['br_primary']) !== true) {
            $aResult['br_primary'] = $this->getBaseReportVictimCasePrimaryConditionView($aParam['br_primary']);
            $aResult['date'] = $this->getReportTypeVictimCaseConditionView($aParam['report_type']);
            $aParamCon['groupBy'] = $aResult['br_primary']['groupBy'];
            $aParamCon['date'] = $aResult['date']['date'];
            $aParamCon['select'] = $aResult['br_primary']['select'];
            $aParamCon['where'] .= $aResult['br_primary']['where'];
            $aParamCon['limit'] = $aResult['br_primary']['limit'];
            $aResult['base'] = $aResult['br_primary']['base'];
        }

        $aResult['optData'] = json_decode($aResult['optData'], true);



        // complainant source 
        if (!empty($aResult['optData']['complainant_source']) !== false) {
            $sNull = '';
            if (in_array("no_record", $aResult['optData']['complainant_source'], TRUE)) {
                $aResult['optData']['complainant_source'] = $this->remove_element($aResult['optData']['complainant_source'], 'no_record');
                $sNull = ' OR `complainant_source_id` IS NULL ';
            }

            $aTemp = $aResult['optData']['complainant_source'];
            if ((count($aTemp) == 0) && ($sNull != '')) {
                $aParamCon['where'] .= ' AND `complainant_source_id` IS NULL ';
            } else {
                $aParamCon['where'] .= ' AND (`complainant_source_id`   IN (' . join(", ", $aResult['optData']['complainant_source']) . ') ' . $sNull . ') ';
            }
        }

        // region 
        if (!empty($aResult['optData']['region']) !== false) {
            $sNull = '';
            if (in_array("no_record", $aResult['optData']['region'], TRUE)) {
                $aResult['optData']['region'] = $this->remove_element($aResult['optData']['region'], 'no_record');
                $sNull = ' OR `region_id` IS NULL ';
            }

            $aTemp = $aResult['optData']['region'];
            if ((count($aTemp) == 0) && ($sNull != '')) {
                $aParamCon['where'] .= ' AND `region_id` IS NULL ';
            } else {
                $aParamCon['where'] .= ' AND (`region_id`   IN (' . join(", ", $aResult['optData']['region']) . ') ' . $sNull . ') ';
            }
        }

        // civil_status 
        if (!empty($aResult['optData']['civil_status']) !== false) {
            $sNull = '';
            if (in_array("no_record", $aResult['optData']['civil_status'], TRUE)) {
                $aResult['optData']['civil_status'] = $this->remove_element($aResult['optData']['civil_status'], 'no_record');
                $sNull = ' OR `civil_status_id` IS NULL ';
            }

            $aTemp = $aResult['optData']['civil_status'];
            if ((count($aTemp) == 0) && ($sNull != '')) {
                $aParamCon['where'] .= ' AND `civil_status_id` IS NULL ';
            } else {
                $aParamCon['where'] .= ' AND (`civil_status_id`   IN (' . join(", ", $aResult['optData']['civil_status']) . ') ' . $sNull . ') ';
            }
        }

        // country 
        if (!empty($aResult['optData']['country']) !== false) {
            $sNull = '';
            if (in_array("no_record", $aResult['optData']['country'], TRUE)) {
                $aResult['optData']['country'] = $this->remove_element($aResult['optData']['country'], 'no_record');
                $sNull = ' OR `deployment_country_id` IS NULL ';
            }
            $aTemp = $aResult['optData']['country'];
            if ((count($aTemp) == 0) && ($sNull != '')) {
                $aParamCon['where'] .= ' AND `deployment_country_id` IS NULL ';
            } else {
                $aParamCon['where'] .= ' AND (`deployment_country_id`   IN (' . join(", ", $aResult['optData']['country']) . ') ' . $sNull . ') ';
            }
        }

        // sex 
        if (!empty($aResult['optData']['sex']) !== false) {
            $sNull = '';
            if (in_array("no_record", $aResult['optData']['sex'], TRUE)) {
                $aResult['optData']['sex'] = $this->remove_element($aResult['optData']['sex'], 'no_record');
                $sNull = ' OR `sex_id` IS NULL ';
            }
            $aTemp = $aResult['optData']['sex'];
            if ((count($aTemp) == 0) && ($sNull != '')) {
                $aParamCon['where'] .= ' AND `sex_id` IS NULL ';
            } else {
                $aParamCon['where'] .= ' AND (`sex_id`   IN (' . join(", ", $aResult['optData']['sex']) . ') ' . $sNull . ') ';
            }
        }

        // base type report 
        if ($aParam['base_type_report'] != 'case_victim_id') {
            $aParamCon['where'] .= " AND `" . $aParam['base_type_report'] . "` = '1' ";
        }

        // for minor 
        if ($aParam['is_minor'] == '1') {
            $aParamCon['where'] .= " AND `deployment_age` <= 17 ";
        }


        // for admin only 
        if ($aParam['agency_id'] != '0') {
            $aParamCon['where'] .= ' 
                AND `added_user_agency_id` = "' . $aParam['agency_id'] . '"
               ';
            if ($aParam['agency_branch_id'] != '0') {
                $aParamCon['where'] .= " AND `added_user_agency_branch_id` = '" . $aParam['agency_branch_id'] . "' ";
            }
        }

        $aResult['graph'] = $this->Reports_model->getGenerateCaseReportGraphView($aParamCon);


        if (count($aResult['graph']) > 0) {
            // gather all null records   
            foreach ($aResult['graph'] as $key => $value) {
                if (isset($aResult['graph'][$key]['variable']) != true) {
                    $aResult['graph'][$key]['variable'] = self::NO_RECORD;
                }
            }

            $aResult['date'] = array_unique(array_column($aResult['graph'], 'date'));
            $aResult['variables'] = array_unique(array_column($aResult['graph'], 'variable'));

            // reset array index 
            $aResult['date'] = array_values($aResult['date']);

            $x = 0;
            $aTemplate = [];
            $aNewGraph = [];
            foreach ($aResult['date'] as $dK => $dV) {
                foreach ($aResult['variables'] as $vK => $vV) {
                    $aTemplate[$x]['variable'] = $vV;
                    $aTemplate[$x]['date'] = $dV;
                    $x++;
                }
            }

            $x = 0;
            foreach ($aTemplate as $tK => $tV) {
                $aNewGraph[$x]['date'] = $tV['date'];
                $aNewGraph[$x]['variable'] = $tV['variable'];
                $count = 0;
                foreach ($aResult['graph'] as $gK => $gV) {

                    if (($tV['variable'] == $gV['variable']) && ($tV['date'] == $gV['date'])) {
                        $count = $count + $gV['count'];
                    }
                }
                $aNewGraph[$x]['count'] = $count;
                $x++;
            }
            $aResult['graph'] = $aNewGraph;

            $x = 0;
            foreach ($aResult['date'] as $dK => $dV) {
                // get index of same date
                $aRes['indexDate'] = array_keys(array_column($aResult['graph'], 'date'), $dV);
                // get value of array
                $iIndexDate = 0;
                $aIndexDate = [];
                foreach ($aRes['indexDate'] as $key => $value) {
                    $aIndexDate[$iIndexDate] = $aResult['graph'][$value];
                    $iIndexDate++;
                }

                foreach ($aResult['base'] as $key => $value) {
                    $aResult['output']['seperate'][$x]['variable'] = $value['name'];
                    $aResult['output']['seperate'][$x]['count'] = self::ZERO_COUNT;
                    $aResult['output']['seperate'][$x]['date'] = $dV;
                    $iKey = array_search($value['name'], array_column($aIndexDate, 'variable'));
                    if ($iKey !== false) {
                        $aResult['output']['seperate'][$x]['count'] = $aIndexDate[$iKey]['count'];
                        $aResult['output']['seperate'][$x]['date'] = $aIndexDate[$iKey]['date'];
                    }
                    $x++;
                }
            }

            foreach ($aResult['date'] as $dK => $dV) {
                $aResult['output']['by_date'][$dK]['date'] = $dV;
                foreach ($aResult['output']['seperate'] as $osK => $osV) {
                    if ($dV == $osV['date']) {
                        $aResult['output']['by_date'][$dK][$osV['variable']] = $osV['count'];
                    }
                }
            }

            foreach ($aResult['base'] as $key => $value) {
                $iSum = 0;
                foreach ($aResult['output']['seperate'] as $osK => $osV) {
                    if ($value['name'] == $osV['variable']) {
                        $iSum += $osV['count'];
                    }
                }
                $aResult['output']['by_variable'][$key]['variable'] = $value['name'];
                $aResult['output']['by_variable'][$key]['count'] = $iSum;
            }

            $aResult['graph'] = $aResult['output'];

            unset($aResult['optData'], $aResult['br_primary'], $aResult['base'], $aResult['output']);
            $aResponse = $aResult;
            $aResponse['flag'] = self:: SUCCESS_RESPONSE;
        }

        return $aResponse;
    }

    public function generateCaseVictimReport_backup($aParam) {
        $aResponse = [];
        $aResult = [];
        $aParamCon = [];
        $aTempStorage = [];
        $aResult['output'] = [];
        $aParamCon['groupBy'] = '';
        $aParamCon['select'] = '';
        $aParamCon['where'] = '';
        $iCount = 0;
        $aResponse['flag'] = self:: FAILED_RESPONSE;
        $aResult['optData'] = $aParam['optData'];

        $aParam = $this->yel->clean_array($aParam);

        //Date Range
        $aParamCon['start_date'] = $aParam['start_date'];
        $aParamCon['end_date'] = $aParam['end_date'];

        $aResult['br_primary'] = '';

        if (!isset($aParam['br_primary']) !== true) {
            $aResult['br_primary'] = $this->getBaseReportVictimCasePrimaryCondition($aParam['br_primary']);
            $aResult['date'] = $this->getReportTypeVictimCaseCondition($aParam['report_type']);
            $aParamCon['groupBy'] = $aResult['br_primary']['groupBy'];
            $aParamCon['date'] = $aResult['date']['date'];
            $aParamCon['select'] = $aResult['br_primary']['select'];
            $aParamCon['where'] .= $aResult['br_primary']['where'];
            $aParamCon['limit'] = $aResult['br_primary']['limit'];
            $aResult['base'] = $aResult['br_primary']['base'];
        }

        $aResult['optData'] = json_decode($aResult['optData'], true);

        if (!empty($aResult['optData']['employment_type']) !== false) {
            $sNull = '';
            if (in_array("no_record", $aResult['optData']['employment_type'], TRUE)) {
                $aResult['optData']['employment_type'] = $this->remove_element($aResult['optData']['employment_type'], 'no_record');
                //array_push($aResult['optData']['employment_type'], 'NULL', "''", "' '");
                $sNull = ' OR `cve`.`case_victim_employment_type` IS NULL ';
            }

            $aTemp = $aResult['optData']['employment_type'];
            if ((count($aTemp) == 0) && ($sNull != '')) {
                $aParamCon['where'] .= ' AND `cve`.`case_victim_employment_type` IS NULL ';
            } else {
                $aParamCon['where'] .= ' AND (`cve`.`case_victim_employment_type`  IN (' . join(", ", $aResult['optData']['employment_type']) . ') ' . $sNull . ')';
            }
        }

        if (!empty($aResult['optData']['visa_type']) !== false) {
            $sNull = '';
            if (in_array("no_record", $aResult['optData']['visa_type'], TRUE)) {
                $aResult['optData']['visa_type'] = $this->remove_element($aResult['optData']['visa_type'], 'no_record');
                array_push($aResult['optData']['visa_type'], '0');
//                $sNull = ' OR `cvd`.`case_victim_visa_category_id` IS NULL ';
            }

//            $aTemp = $aResult['optData']['visa_type'];
//            if ((count($aTemp) == 0) && ($sNull != '')) {
//                $aParamCon['where'] .= ' AND `cvd`.`case_victim_visa_category_id` IS NULL ';
//            } else {
//                $aParamCon['where'] .= ' AND `cvd`.`case_victim_visa_category_id` IN (' . join(", ", $aResult['optData']['visa_type']) . ') ' . $sNull;
//            }

            $aParamCon['where'] .= ' AND `cvd`.`case_victim_visa_category_id` IN (' . join(", ", $aResult['optData']['visa_type']) . ') ';
        }

        if (!empty($aResult['optData']['complainant_source']) !== false) {
            $sNull = '';
            if (in_array("no_record", $aResult['optData']['complainant_source'], TRUE)) {
                $aResult['optData']['complainant_source'] = $this->remove_element($aResult['optData']['complainant_source'], 'no_record');
                //array_push($aResult['optData']['complainant_source'], 'NULL', "''", "' '");
                $sNull = ' OR `cc`.`case_complainant_source_id` IS NULL ';
            }

            $aTemp = $aResult['optData']['complainant_source'];
            if ((count($aTemp) == 0) && ($sNull != '')) {
                $aParamCon['where'] .= ' AND `cc`.`case_complainant_source_id` IS NULL ';
            } else {
                $aParamCon['where'] .= ' AND (`cc`.`case_complainant_source_id`   IN (' . join(", ", $aResult['optData']['complainant_source']) . ') ' . $sNull . ') ';
            }
        }

        if (!empty($aResult['optData']['deployment_type']) !== false) {

            $sNull = '';

            if (in_array("no_record", $aResult['optData']['deployment_type'], TRUE)) {
                $aResult['optData']['deployment_type'] = $this->remove_element($aResult['optData']['deployment_type'], 'no_record');
                array_push($aResult['optData']['deployment_type'], '0');
                //$sNull = ' OR `cvd`.`case_victim_deployment_type` IS NULL ';
            }

            //$aTemp = $aResult['optData']['deployment_type'];
            //if ((count($aTemp) == 0) && ($sNull != '')) {
            //    $aParamCon['where'] .= ' AND `cvd`.`case_victim_deployment_type` IS NULL ';
            //} else {
            //    $aParamCon['where'] .= ' AND `cvd`.`case_victim_deployment_type` IN (' . join(", ", $aResult['optData']['deployment_type']) . ') ' . $sNull;
            //}

            $aParamCon['where'] .= ' AND `cvd`.`case_victim_deployment_type` IN (' . join(", ", $aResult['optData']['deployment_type']) . ') ';
        }

        if (!empty($aResult['optData']['tip_act']) !== false) {
            $aParamCon['where'] .= ' 
                  AND `cv`.`case_victim_id` IN (
                            SELECT 
                                `cvt`.`case_victim_id`
                            FROM 
                                `icms_case_victim_tip` `cvt`
                            WHERE
                                `cvt`.`case_victim_tip_type_id` = 1
                            AND 
                                `cvt`.`case_victim_tip_type_content_id` IN (' . join(", ", $aResult['optData']['tip_act']) . ')
                            GROUP BY  `cvt`.`case_victim_id`
                        )  
            ';
        }

        if (!empty($aResult['optData']['tip_purpose']) !== false) {
            $aParamCon['where'] .= ' 
                  AND `cv`.`case_victim_id` IN (
                            SELECT 
                                `cvt`.`case_victim_id`
                            FROM 
                                `icms_case_victim_tip` `cvt`
                            WHERE
                                `cvt`.`case_victim_tip_type_id` = 2
                            AND 
                                `cvt`.`case_victim_tip_type_content_id` IN (' . join(", ", $aResult['optData']['tip_purpose']) . ')
                            GROUP BY  `cvt`.`case_victim_id`
                        )  
            ';
        }

        if (!empty($aResult['optData']['tip_mean']) !== false) {
            $aParamCon['where'] .= ' 
                  AND `cv`.`case_victim_id` IN (
                            SELECT 
                                `cvt`.`case_victim_id`
                            FROM 
                                `icms_case_victim_tip` `cvt`
                            WHERE
                                `cvt`.`case_victim_tip_type_id` = 3
                            AND 
                                `cvt`.`case_victim_tip_type_content_id` IN (' . join(", ", $aResult['optData']['tip_mean']) . ')
                            GROUP BY  `cvt`.`case_victim_id`
                        )  
            ';
        }

        if (!empty($aResult['optData']['country']) !== false) {

            $sNull = '';

            if (in_array("no_record", $aResult['optData']['country'], TRUE)) {
                $aResult['optData']['country'] = $this->remove_element($aResult['optData']['country'], 'no_record');
                //array_push($aResult['optData']['country'], 'NULL', "''", "' '");
                $sNull = ' OR `cved`.`country_id` IS NULL ';
            }

            $aTemp = $aResult['optData']['country'];
            if ((count($aTemp) == 0) && ($sNull != '')) {
                $aParamCon['where'] .= ' 
                AND `cv`.`case_victim_id` IN (        
                    SELECT `acve`.`case_victim_id` FROM `icms_case_victim_employment` `acve` WHERE `acve`.`case_victim_employment_id` 
                    IN  (SELECT `cved`.`case_victim_employment_id`
                            FROM `icms_case_victim_employment_details` `cved` 
                            WHERE  
                            `cved`.`case_victim_employment_details_is_actual` = 1
                            AND  `cved`.`country_id` IS NULL
                    ) 
                )       
            ';
            } else {
                if ($sNull !== "") {
                    $aParamCon['where'] .= ' 
                        AND `cv`.`case_victim_id` IN (        
                            SELECT `acve`.`case_victim_id` FROM `icms_case_victim_employment` `acve` WHERE `acve`.`case_victim_employment_id` 
                            IN  (SELECT `cved`.`case_victim_employment_id`
                                    FROM `icms_case_victim_employment_details` `cved` 
                                    WHERE  
                                    `cved`.`case_victim_employment_details_is_actual` = 1
                                    AND (`cved`.`country_id` IN (' . join(", ", $aResult['optData']['country']) . ') ' . $sNull . ')
                            ) 
                        )       
                    ';
                } else {
                    $aParamCon['where'] .= ' 
                        AND `cv`.`case_victim_id` IN (        
                            SELECT `acve`.`case_victim_id` FROM `icms_case_victim_employment` `acve` WHERE `acve`.`case_victim_employment_id` 
                            IN  (SELECT `cved`.`case_victim_employment_id`
                                    FROM `icms_case_victim_employment_details` `cved` 
                                    WHERE  
                                    `cved`.`case_victim_employment_details_is_actual` = 1
                                    AND `cved`.`country_id` IN (' . join(", ", $aResult['optData']['country']) . ') 
                            ) 
                        )       
                    ';
                }
            }
        }

        // for admin only 
        if ($aParam['agency_id'] != '0') {
            $aParamCon['where'] .= ' 
                AND `c`.`case_added_by` IN 
                    (SELECT `user_id` FROM `icms_user` 
                     WHERE `agency_branch_id` IN (SELECT `agency_branch_id` FROM `icms_agency_branch` WHERE `agency_id` = "' . $aParam['agency_id'] . '")
                    )
               ';
            if ($aParam['agency_branch_id'] != '0') {
                $aParamCon['where'] .= " AND `c`.`case_added_by` IN (SELECT `user_id` FROM `icms_user` WHERE `agency_branch_id` = '" . $aParam['agency_branch_id'] . "')";
            }
        }

        $aResult['graph'] = $this->Reports_model->getGenerateCaseVictimReportGraph($aParamCon);

        if (count($aResult['graph']) > 0) {
            // gather all null records   
            foreach ($aResult['graph'] as $key => $value) {
                if (isset($aResult['graph'][$key]['variable']) != true) {
                    $aResult['graph'][$key]['variable'] = self::NO_RECORD;
                }
            }

            $aResult['date'] = array_unique(array_column($aResult['graph'], 'date'));
            $aResult['variables'] = array_unique(array_column($aResult['graph'], 'variable'));

            // reset array index 
            $aResult['date'] = array_values($aResult['date']);

            $x = 0;
            $aTemplate = [];
            $aNewGraph = [];
            foreach ($aResult['date'] as $dK => $dV) {
                foreach ($aResult['variables'] as $vK => $vV) {
                    $aTemplate[$x]['variable'] = $vV;
                    $aTemplate[$x]['date'] = $dV;
                    $x++;
                }
            }

            $x = 0;
            foreach ($aTemplate as $tK => $tV) {
                $aNewGraph[$x]['date'] = $tV['date'];
                $aNewGraph[$x]['variable'] = $tV['variable'];
                $count = 0;
                foreach ($aResult['graph'] as $gK => $gV) {

                    if (($tV['variable'] == $gV['variable']) && ($tV['date'] == $gV['date'])) {
                        $count = $count + $gV['count'];
                    }
                }
                $aNewGraph[$x]['count'] = $count;
                $x++;
            }
            $aResult['graph'] = $aNewGraph;

            $x = 0;
            foreach ($aResult['date'] as $dK => $dV) {
                // get index of same date
                $aRes['indexDate'] = array_keys(array_column($aResult['graph'], 'date'), $dV);
                // get value of array
                $iIndexDate = 0;
                $aIndexDate = [];
                foreach ($aRes['indexDate'] as $key => $value) {
                    $aIndexDate[$iIndexDate] = $aResult['graph'][$value];
                    $iIndexDate++;
                }

                foreach ($aResult['base'] as $key => $value) {
                    $aResult['output']['seperate'][$x]['variable'] = $value['name'];
                    $aResult['output']['seperate'][$x]['count'] = self::ZERO_COUNT;
                    $aResult['output']['seperate'][$x]['date'] = $dV;
                    $iKey = array_search($value['name'], array_column($aIndexDate, 'variable'));
                    if ($iKey !== false) {
                        $aResult['output']['seperate'][$x]['count'] = $aIndexDate[$iKey]['count'];
                        $aResult['output']['seperate'][$x]['date'] = $aIndexDate[$iKey]['date'];
                    }
                    $x++;
                }
            }

            foreach ($aResult['date'] as $dK => $dV) {
                $aResult['output']['by_date'][$dK]['date'] = $dV;
                foreach ($aResult['output']['seperate'] as $osK => $osV) {
                    if ($dV == $osV['date']) {
                        $aResult['output']['by_date'][$dK][$osV['variable']] = $osV['count'];
                    }
                }
            }

            foreach ($aResult['base'] as $key => $value) {
                $iSum = 0;
                foreach ($aResult['output']['seperate'] as $osK => $osV) {
                    if ($value['name'] == $osV['variable']) {
                        $iSum += $osV['count'];
                    }
                }
                $aResult['output'][''][$key]['variable'] = $value['name'];
                $aResult['output']['by_variable'][$key]['count'] = $iSum;
            }

            $aResult['graph'] = $aResult['output'];

            unset($aResult['optData'], $aResult['br_primary'], $aResult['base'], $aResult['output']);
            $aResponse = $aResult;
            $aResponse['flag'] = self:: SUCCESS_RESPONSE;
        }

        return $aResponse;
    }

    // End Case Victim 
    // Start Report Minor 

    public function getBaseReportVictimMinorCasePrimaryCondition($id) {
        $aQuery = [];

        $aQuery['select'] = "";
        $aQuery['groupBy'] = " GROUP BY `variable`";
        $aQuery['where'] = "";
        $aQuery['base'] = "";
        $aQuery['limit'] = "";

        switch ((int) $id) {
            case 1:
                $aQuery['select'] = "
                    (   SELECT 
                            `gc`.`country_name`
                        FROM 
                            `icms_global_country` `gc`
                        WHERE 
                            `gc`.`is_active` = 1 
                        AND `gc`.`country_id` =
                            (SELECT `cved`.`country_id` 
                             FROM `icms_case_victim_employment_details` `cved` 
                             WHERE  
                             `cved`.`case_victim_employment_id` = `cve`.`case_victim_employment_id` 
                             AND `cved`.`case_victim_employment_details_is_actual` = 1
                            )                            
                        LIMIT 1 
                    )
                ";
                $aQuery['base'] = $this->Reports_model->getCountries();
                break;

            case 2:
                $aQuery['select'] = "
                        ( SELECT 
                                `gp`.`parameter_name`
                          FROM 
                                `icms_global_parameter` `gp`
                          WHERE `gp`.`parameter_type_id` = 9 
                          AND `gp`.`parameter_count_id`= 
                            (SELECT `v`.`victim_gender` FROM `icms_victim` `v` WHERE `v`.`victim_id` = `cv`.`victim_id` LIMIT 1)
                          LIMIT 1
                        )
                ";
                $aQuery['groupBy'] = "
                        GROUP BY 
                        `variable`
                ";
                $aQuery['base'] = $this->Reports_model->getGlobalParambyId(9);
                break;


            default:
                $aQuery['select'] = "";
                $aQuery['limit'] = "";
                break;
        }
        array_push($aQuery['base'], array('name' => self::NO_RECORD));
        $aQuery['groupBy'] .= " , `date`  ORDER BY `cvd`.`case_victim_deployment_date` " . $aQuery['limit'];
        return $aQuery;
    }

    public function getReportTypeVictimMinorCaseCondition($id) {

        switch ((int) $id) {
            case 1:
                //daily
                $aQuery['date'] = "
                    (DATE_FORMAT(`cvd`.`case_victim_deployment_date`, '%M %d, %Y'))
                ";
                break;
            case 2:
                //weekly 
                $aQuery['date'] = "

                     (CONCAT((DATE_FORMAT(`cvd`.`case_victim_deployment_date`, '%V')), CASE
                        WHEN (DATE_FORMAT(`cvd`.`case_victim_deployment_date`, '%V'))%100 BETWEEN 11 AND 13 THEN 'th'
                        WHEN (DATE_FORMAT(`cvd`.`case_victim_deployment_date`, '%V'))%10 = 1 THEN 'st'
                        WHEN (DATE_FORMAT(`cvd`.`case_victim_deployment_date`, '%V'))%10 = 2 THEN 'nd'
                        WHEN (DATE_FORMAT(`cvd`.`case_victim_deployment_date`, '%V'))%10 = 3 THEN 'rd'
                        ELSE 'th'
                     END, ' week of ', DATE_FORMAT(`cvd`.`case_victim_deployment_date`, '%Y')))

                ";
                break;
            case 3:
                //monthly 
                $aQuery['date'] = "
                    (DATE_FORMAT(`cvd`.`case_victim_deployment_date`, '%M %Y'))
                ";
                break;
            case 4:
                //quarterly 
                $aQuery['date'] = "
                    (CONCAT( (QUARTER(`cvd`.`case_victim_deployment_date`)) , 

                    CASE
                        WHEN (QUARTER(`cvd`.`case_victim_deployment_date`)) = 1  THEN 'st'
                        WHEN (QUARTER(`cvd`.`case_victim_deployment_date`)) = 2  THEN 'nd'
                        WHEN (QUARTER(`cvd`.`case_victim_deployment_date`)) = 3 THEN  'rd'
                        ELSE 'th'
                    END, 

                    ' Quarter' ,' of ', DATE_FORMAT(`cvd`.`case_victim_deployment_date`, '%Y')))
                ";
                break;
            case 5:
                //yearly 
                $aQuery['date'] = "
                    (DATE_FORMAT(`cvd`.`case_victim_deployment_date`, '%Y'))
                ";
                break;
            default:
                $aQuery['date'] = "";
                break;
        }
        return $aQuery;
    }

    public function generateCaseVictimMinorReport($aParam) {
        $aResponse = [];
        $aResult = [];
        $aParamCon = [];
        $aTempStorage = [];
        $aResult['output'] = [];
        $aParamCon['groupBy'] = '';
        $aParamCon['select'] = '';
        $aParamCon['where'] = '';
        $iCount = 0;
        $aResponse['flag'] = self:: FAILED_RESPONSE;
        $aResult['optData'] = $aParam['optData'];

        $aParam = $this->yel->clean_array($aParam);

        //Date Range
        $aParamCon['start_date'] = $aParam['start_date'];
        $aParamCon['end_date'] = $aParam['end_date'];

        $aResult['br_primary'] = '';

        if (!isset($aParam['br_primary']) !== true) {
            $aResult['br_primary'] = $this->getBaseReportVictimMinorCasePrimaryCondition($aParam['br_primary']);
            $aResult['date'] = $this->getReportTypeVictimMinorCaseCondition($aParam['report_type']);
            $aParamCon['groupBy'] = $aResult['br_primary']['groupBy'];
            $aParamCon['date'] = $aResult['date']['date'];
            $aParamCon['select'] = $aResult['br_primary']['select'];
            $aParamCon['where'] .= $aResult['br_primary']['where'];
            $aParamCon['limit'] = $aResult['br_primary']['limit'];
            $aResult['base'] = $aResult['br_primary']['base'];
        }

        $aResult['optData'] = json_decode($aResult['optData'], true);

        if (!empty($aResult['optData']['sex']) !== false) {
            $sNull = '';
            if (in_array("no_record", $aResult['optData']['sex'], TRUE)) {
                $aResult['optData']['sex'] = $this->remove_element($aResult['optData']['sex'], 'no_record');
                //array_push($aResult['optData']['sex'], 'NULL');
                $sNull = ' OR `victim_gender` IS NULL ';
            }

            $aTemp = $aResult['optData']['sex'];
            if ((count($aTemp) == 0) && ($sNull != '')) {
                $aParamCon['where'] .= ' AND `cv`.`case_victim_id` IN (SELECT `case_victim_id` FROM `icms_case_victim` WHERE  `victim_id` IN (SELECT `victim_id` FROM `icms_victim` WHERE `victim_gender` IS NULL ))';
            } else {
                $aParamCon['where'] .= ' AND `cv`.`case_victim_id` IN (SELECT `case_victim_id` FROM `icms_case_victim` WHERE  `victim_id` IN (SELECT `victim_id` FROM `icms_victim` WHERE `victim_gender`  IN (' . join(", ", $aResult['optData']['sex']) . ') ' . $sNull . ' ))';
            }
        }

        if (!empty($aResult['optData']['country']) !== false) {
            $sNull = '';
            if (in_array("no_record", $aResult['optData']['country'], TRUE)) {
                $aResult['optData']['country'] = $this->remove_element($aResult['optData']['country'], 'no_record');
                //array_push($aResult['optData']['country'], 'NULL');
                $sNull = ' OR `cved`.`country_id` IS NULL ';
            }

            $aTemp = $aResult['optData']['country'];
            if ((count($aTemp) == 0) && ($sNull != '')) {
                $aParamCon['where'] .= ' 
                AND `cv`.`case_victim_id` IN (        
                    SELECT `acve`.`case_victim_id` FROM `icms_case_victim_employment` `acve` WHERE `acve`.`case_victim_employment_id` 
                    IN  (SELECT `cved`.`case_victim_employment_id`
                            FROM `icms_case_victim_employment_details` `cved` 
                            WHERE  
                            `cved`.`case_victim_employment_details_is_actual` = 1
                            AND `cved`.`country_id` IS NULL
                    ) 
                )

                ';
            } else {
                $aParamCon['where'] .= ' 
                AND `cv`.`case_victim_id` IN (        
                    SELECT `acve`.`case_victim_id` FROM `icms_case_victim_employment` `acve` WHERE `acve`.`case_victim_employment_id` 
                    IN  (SELECT `cved`.`case_victim_employment_id`
                            FROM `icms_case_victim_employment_details` `cved` 
                            WHERE  
                            `cved`.`case_victim_employment_details_is_actual` = 1
                            AND (`cved`.`country_id` IN (' . join(", ", $aResult['optData']['country']) . ') ' . $sNull . ')
                    ) 
                )

                ';
            }
        }

        // for admin only 
        if ($aParam['agency_id'] != '0') {
            $aParamCon['where'] .= ' 
                AND `c`.`case_added_by` IN 
                    (SELECT `user_id` FROM `icms_user` 
                     WHERE `agency_branch_id` IN (SELECT `agency_branch_id` FROM `icms_agency_branch` WHERE `agency_id` = "' . $aParam['agency_id'] . '")
                    )
               ';
            if ($aParam['agency_branch_id'] != '0') {
                $aParamCon['where'] .= ' AND `c`.`case_added_by` IN (SELECT `user_id` FROM `icms_user` WHERE `agency_branch_id` = "' . $aParam['agency_branch_id'] . '")';
            }
        }

        $aResult['graph'] = $this->Reports_model->getGenerateCaseVictimMinorReportGraph($aParamCon);

        if (count($aResult['graph']) > 0) {
            // gather all null records   
            foreach ($aResult['graph'] as $key => $value) {
                if (isset($aResult['graph'][$key]['variable']) != true) {
                    $aResult['graph'][$key]['variable'] = self::NO_RECORD;
                }
            }

            $aResult['date'] = array_unique(array_column($aResult['graph'], 'date'));
            $aResult['variables'] = array_unique(array_column($aResult['graph'], 'variable'));

            // reset array index 
            $aResult['date'] = array_values($aResult['date']);

            $x = 0;
            $aTemplate = [];
            $aNewGraph = [];
            foreach ($aResult['date'] as $dK => $dV) {
                foreach ($aResult['variables'] as $vK => $vV) {
                    $aTemplate[$x]['variable'] = $vV;
                    $aTemplate[$x]['date'] = $dV;
                    $x++;
                }
            }

            $x = 0;
            foreach ($aTemplate as $tK => $tV) {
                $aNewGraph[$x]['date'] = $tV['date'];
                $aNewGraph[$x]['variable'] = $tV['variable'];
                $count = 0;
                foreach ($aResult['graph'] as $gK => $gV) {

                    if (($tV['variable'] == $gV['variable']) && ($tV['date'] == $gV['date'])) {
                        $count = $count + $gV['count'];
                    }
                }
                $aNewGraph[$x]['count'] = $count;
                $x++;
            }
            $aResult['graph'] = $aNewGraph;

            $x = 0;
            foreach ($aResult['date'] as $dK => $dV) {
                // get index of same date
                $aRes['indexDate'] = array_keys(array_column($aResult['graph'], 'date'), $dV);
                // get value of array
                $iIndexDate = 0;
                $aIndexDate = [];
                foreach ($aRes['indexDate'] as $key => $value) {
                    $aIndexDate[$iIndexDate] = $aResult['graph'][$value];
                    $iIndexDate++;
                }

                foreach ($aResult['base'] as $key => $value) {
                    $aResult['output']['seperate'][$x]['variable'] = $value['name'];
                    $aResult['output']['seperate'][$x]['count'] = self::ZERO_COUNT;
                    $aResult['output']['seperate'][$x]['date'] = $dV;
                    $iKey = array_search($value['name'], array_column($aIndexDate, 'variable'));
                    if ($iKey !== false) {
                        $aResult['output']['seperate'][$x]['count'] = $aIndexDate[$iKey]['count'];
                        $aResult['output']['seperate'][$x]['date'] = $aIndexDate[$iKey]['date'];
                    }
                    $x++;
                }
            }

            foreach ($aResult['date'] as $dK => $dV) {
                $aResult['output']['by_date'][$dK]['date'] = $dV;
                foreach ($aResult['output']['seperate'] as $osK => $osV) {
                    if ($dV == $osV['date']) {
                        $aResult['output']['by_date'][$dK][$osV['variable']] = $osV['count'];
                    }
                }
            }

            foreach ($aResult['base'] as $key => $value) {
                $iSum = 0;
                foreach ($aResult['output']['seperate'] as $osK => $osV) {
                    if ($value['name'] == $osV['variable']) {
                        $iSum += $osV['count'];
                    }
                }
                $aResult['output']['by_variable'][$key]['variable'] = $value['name'];
                $aResult['output']['by_variable'][$key]['count'] = $iSum;
            }

            $aResult['graph'] = $aResult['output'];

            unset($aResult['optData'], $aResult['br_primary'], $aResult['base'], $aResult['output']);
            $aResponse = $aResult;
            $aResponse['flag'] = self:: SUCCESS_RESPONSE;
        }

        return $aResponse;
    }

    // End Report Minor


    public function generateCaseVictimAllegedReport($aParam) {

        $aResponse = [];
        $aResult = [];
        $aParamCon = [];
        $aTempStorage = [];
        $aResult['output'] = [];
        $aParamCon['groupBy'] = '';
        $aParamCon['select'] = '';
        $aParamCon['where'] = '';
        $iCount = 0;
        $aResponse['flag'] = self:: FAILED_RESPONSE;

        $aParam = $this->yel->clean_array($aParam);

        //Date Range
        $aParamCon['start_date'] = $aParam['start_date'];
        $aParamCon['end_date'] = $aParam['end_date'];

        $aResult['br_primary'] = '';

        if (!isset($aParam['br_primary']) !== true) {
            $aResult['br_primary'] = $this->getBaseReportVictimAllegedCasePrimaryCondition($aParam['br_primary']);
            $aResult['date'] = $this->getReportTypeVictimAllegedCaseCondition($aParam['report_type']);
            $aParamCon['groupBy'] = $aResult['br_primary']['groupBy'];
            $aParamCon['date'] = $aResult['date']['date'];
            $aParamCon['select'] = $aResult['br_primary']['select'];
            $aParamCon['where'] .= $aResult['br_primary']['where'];
            $aParamCon['limit'] = $aResult['br_primary']['limit'];
            $aResult['base'] = $aResult['br_primary']['base'];
        }

        $aResult['graph'] = $this->Reports_model->generateCaseVictimAllegedReport($aParamCon);


        if (count($aResult['graph']) > 0) {
            // gather all null records   
            foreach ($aResult['graph'] as $key => $value) {
                if (isset($aResult['graph'][$key]['variable']) != true) {
                    $aResult['graph'][$key]['variable'] = self::NO_RECORD;
                }
            }

            $aResult['date'] = array_unique(array_column($aResult['graph'], 'date'));
            $aResult['variables'] = array_unique(array_column($aResult['graph'], 'variable'));

            // reset array index 
            $aResult['date'] = array_values($aResult['date']);

            $x = 0;
            $aTemplate = [];
            $aNewGraph = [];
            foreach ($aResult['date'] as $dK => $dV) {
                foreach ($aResult['variables'] as $vK => $vV) {
                    $aTemplate[$x]['variable'] = $vV;
                    $aTemplate[$x]['date'] = $dV;
                    $x++;
                }
            }

            $x = 0;
            foreach ($aTemplate as $tK => $tV) {
                $aNewGraph[$x]['date'] = $tV['date'];
                $aNewGraph[$x]['variable'] = $tV['variable'];
                $count = 0;
                foreach ($aResult['graph'] as $gK => $gV) {

                    if (($tV['variable'] == $gV['variable']) && ($tV['date'] == $gV['date'])) {
                        $count = $count + $gV['count'];
                    }
                }
                $aNewGraph[$x]['count'] = $count;
                $x++;
            }
            $aResult['graph'] = $aNewGraph;

            $x = 0;
            foreach ($aResult['date'] as $dK => $dV) {
                // get index of same date
                $aRes['indexDate'] = array_keys(array_column($aResult['graph'], 'date'), $dV);
                // get value of array
                $iIndexDate = 0;
                $aIndexDate = [];
                foreach ($aRes['indexDate'] as $key => $value) {
                    $aIndexDate[$iIndexDate] = $aResult['graph'][$value];
                    $iIndexDate++;
                }

                foreach ($aResult['base'] as $key => $value) {
                    $aResult['output']['seperate'][$x]['variable'] = $value['name'];
                    $aResult['output']['seperate'][$x]['count'] = self::ZERO_COUNT;
                    $aResult['output']['seperate'][$x]['date'] = $dV;
                    $iKey = array_search($value['name'], array_column($aIndexDate, 'variable'));
                    if ($iKey !== false) {
                        $aResult['output']['seperate'][$x]['count'] = $aIndexDate[$iKey]['count'];
                        $aResult['output']['seperate'][$x]['date'] = $aIndexDate[$iKey]['date'];
                    }
                    $x++;
                }
            }

            foreach ($aResult['date'] as $dK => $dV) {
                $aResult['output']['by_date'][$dK]['date'] = $dV;
                foreach ($aResult['output']['seperate'] as $osK => $osV) {
                    if ($dV == $osV['date']) {
                        $aResult['output']['by_date'][$dK][$osV['variable']] = $osV['count'];
                    }
                }
            }

            foreach ($aResult['base'] as $key => $value) {
                $iSum = 0;
                foreach ($aResult['output']['seperate'] as $osK => $osV) {
                    if ($value['name'] == $osV['variable']) {
                        $iSum += $osV['count'];
                    }
                }
                $aResult['output']['by_variable'][$key]['variable'] = $value['name'];
                $aResult['output']['by_variable'][$key]['count'] = $iSum;
            }

            $aResult['graph'] = $aResult['output'];

            unset($aResult['optData'], $aResult['br_primary'], $aResult['base'], $aResult['output']);
            $aResponse = $aResult;
            $aResponse['flag'] = self:: SUCCESS_RESPONSE;
        }

        return $aResponse;
    }

    public function generateCaseServicesReport($aParam) {
        $aResponse = [];
        $aResult = [];
        $aParamCon = [];
        $aTempStorage = [];
        $aResult['output'] = [];
        $aParamCon['groupBy'] = '';
        $aParamCon['select'] = '';
        $aParamCon['where'] = '';
        $iCount = 0;
        $aResponse['flag'] = self:: FAILED_RESPONSE;

        $aParam = $this->yel->clean_array($aParam);

        //Date Range
        $aParamCon['start_date'] = $aParam['start_date'];
        $aParamCon['end_date'] = $aParam['end_date'];

        $aResult['br_primary'] = '';

        if (!isset($aParam['br_primary']) !== true) {
            $aResult['br_primary'] = $this->getBaseReportServicesCasePrimaryCondition($aParam['br_primary']);
            $aResult['date'] = $this->getReportTypeCaseServicesCondition($aParam['report_type']);
            $aParamCon['groupBy'] = $aResult['br_primary']['groupBy'];
            $aParamCon['date'] = $aResult['date']['date'];
            $aParamCon['select'] = $aResult['br_primary']['select'];
            $aParamCon['where'] .= $aResult['br_primary']['where'];
            $aParamCon['limit'] = $aResult['br_primary']['limit'];
            $aResult['base'] = $aResult['br_primary']['base'];
        }

        $aResult['graph'] = $this->Reports_model->generateCaseServicesReport($aParamCon);

        if (count($aResult['graph']) > 0) {

            // set new param 
            $mehParam = $aParamCon;

            // base agency with status
            $parent = "";
            $base_agency = $this->Reports_model->getDateStatusCaseServicesReport($mehParam);

            // aging_status
            // base agency branch with status 
            $parent = "";
            $mehParam['select'] = '(`agency_branch_name`)';
            $base_agency_branch = $this->Reports_model->getDateStatusCaseServicesReport($mehParam);

            // per branch         
            $mehParam['select'] = '(`agency_branch_name`)';
            $parent = ", (`agency_name`)  as parent";
            $aResult['hold']['count_sub_a'] = $this->Reports_model->generateCaseServicesReport($mehParam, $parent);
            $aResult['hold']['count_sub_a_date_status'] = $this->Reports_model->getDateStatusCaseServicesReport($mehParam);

            $base = $this->Reports_model->AgencyBranchNameList();

            // base service 
            $parent = "(`agency_name`)  as parent, ";
            $mehParam['group_by'] = " GROUP BY  `service_name_full`, `variable` , `date` ORDER BY `case_victim_services_agency_tag_added_date`";
            $base_service = $this->Reports_model->getDateServiceNameCaseServicesReport($mehParam, $parent);

            // base service with status 
            $parent = "(`agency_name`)  as parent, ";
            $mehParam['group_by'] = " GROUP BY  `status_name`, `service_name_full`, `variable` , `date` ORDER BY `case_victim_services_agency_tag_added_date`";
            $base_service_with_status = $this->Reports_model->getDateServiceNameCaseServicesReport($mehParam, $parent);


            $aResult['hold']['sum'] = $this->prepareGraphFormatWithParent($aResult['hold']['count_sub_a'], $base, $base_service, $base_service_with_status, $base_agency_branch, 1);
            $aResult['hold']['sum']['by_date'] = $this->mergeServicesDataParent($base_agency, $aResult['hold']['sum']['by_date']);

            $aResult['graph'] = $this->prepareGraphFormat($aResult['graph'], $aResult['base']);

            //$date_status = $this->Reports_model->getDateStatusCaseServicesReport($aParamCon);
            //$aResult['graph']['by_date_status'] = $this->mergeServicesData($date_status, $aResult['graph']['by_date']);
            $aResult['graph']['by_date_status'] = $aResult['hold']['sum']['by_date'];

            unset($aResult['optData'], $aResult['br_primary'], $aResult['base'], $aResult['output'], $aResult['hold']);
            $aResponse = $aResult;
            $aResponse['flag'] = self:: SUCCESS_RESPONSE;
        }

        return $aResponse;
    }

    public function generateCaseServicesAgingReport($aParam) {
        $aResponse = [];
        $aResult = [];
        $aParamCon = [];
        $aTempStorage = [];
        $aResult['output'] = [];
        $aParamCon['groupBy'] = '';
        $aParamCon['select'] = '';
        $aParamCon['where'] = '';
        $iCount = 0;
        $aResponse['flag'] = self:: FAILED_RESPONSE;

        $aParam = $this->yel->clean_array($aParam);

        //Date Range
        $aParamCon['start_date'] = $aParam['start_date'];
        $aParamCon['end_date'] = $aParam['end_date'];

        $aResult['br_primary'] = '';

        if (!isset($aParam['br_primary']) !== true) {
            $aResult['br_primary'] = $this->getBaseReportServicesCasePrimaryCondition($aParam['br_primary']);
            $aResult['date'] = $this->getReportTypeCaseServicesCondition($aParam['report_type']);
            $aParamCon['groupBy'] = $aResult['br_primary']['groupBy'];
            $aParamCon['date'] = $aResult['date']['date'];
            $aParamCon['select'] = $aResult['br_primary']['select'];
            $aParamCon['where'] .= $aResult['br_primary']['where'];
            $aParamCon['limit'] = $aResult['br_primary']['limit'];
            $aResult['base'] = $aResult['br_primary']['base'];
        }

        $aResult['graph'] = $this->Reports_model->generateCaseServicesReport($aParamCon);

        if (count($aResult['graph']) > 0) {

            // set new param 
            $mehParam = $aParamCon;

            // base agency with status
            $parent = "";
            $base_agency = $this->Reports_model->getDateStatusCaseServicesAgingReport($mehParam);

            // base agency branch with status 
            $parent = "";
            $mehParam['select'] = '(`agency_branch_name`)';
            $base_agency_branch = $this->Reports_model->getDateStatusCaseServicesAgingReport($mehParam);

            // per branch         
            $mehParam['select'] = '(`agency_branch_name`)';
            $parent = ", (`agency_name`)  as parent";
            $aResult['hold']['count_sub_a'] = $this->Reports_model->generateCaseServicesReport($mehParam, $parent);
            $aResult['hold']['count_sub_a_date_status'] = $this->Reports_model->getDateStatusCaseServicesAgingReport($mehParam);

            $base = $this->Reports_model->AgencyBranchNameList();

            // base service 
            $parent = "(`agency_name`)  as parent, ";
            $mehParam['group_by'] = " GROUP BY  `service_name_full`, `variable` , `date` ORDER BY `case_victim_services_agency_tag_added_date`";
            $base_service = $this->Reports_model->getDateServiceNameCaseServicesAgingReport($mehParam, $parent);

            // base service with status 
            $parent = "(`agency_name`)  as parent, ";
            $mehParam['group_by'] = " GROUP BY  `aging_status`, `service_name_full`, `variable` , `date` ORDER BY `case_victim_services_agency_tag_added_date`";
            $base_service_with_status = $this->Reports_model->getDateServiceNameCaseServicesAgingReport($mehParam, $parent);


            $aResult['hold']['sum'] = $this->prepareGraphFormatWithParent($aResult['hold']['count_sub_a'], $base, $base_service, $base_service_with_status, $base_agency_branch, 2);
            $aResult['hold']['sum']['by_date'] = $this->mergeServicesAgingDataParent($base_agency, $aResult['hold']['sum']['by_date']);

            $aResult['graph'] = $this->prepareGraphFormat($aResult['graph'], $aResult['base']);

            //$date_status = $this->Reports_model->getDateStatusCaseServicesReport($aParamCon);
            //$aResult['graph']['by_date_status'] = $this->mergeServicesData($date_status, $aResult['graph']['by_date']);
            $aResult['graph']['by_date_status'] = $aResult['hold']['sum']['by_date'];

            unset($aResult['optData'], $aResult['br_primary'], $aResult['base'], $aResult['output'], $aResult['hold']);
            $aResponse = $aResult;
            $aResponse['flag'] = self:: SUCCESS_RESPONSE;
        }

        return $aResponse;
    }

    public function mergeServicesDataParent($date_status, $rs) {
        // by date status 
        foreach ($rs as $dK => $dV) {
            $new_cur_date = $dV['date'];
            unset($dV['date'], $dV['No record.']);
            foreach ($dV as $ddK => $ddV) {
                $new_stat = [];
                $count = 0;
                $count_total = 0;

                $new_stat[$count] = array(
                    "status" => "Total",
                    "count" => $count_total,
                );

                $list_stat = $this->Reports_model->getTransactionParambyId(1);
                foreach ($list_stat as $lsK => $lsV) {
                    $count++;
                    $new_stat[$count] = array(
                        "status" => $lsV['name'],
                        "count" => 0,
                    );
                }

                foreach ($date_status as $sK => $sV) {
                    if (($sV['date'] == $new_cur_date) && ($sV['variable'] == $ddK)) {
                        foreach ($new_stat as $nsK => $nsV) {
                            if ($sV['status_name'] == $nsV['status']) {
                                $new_stat[$nsK]['status'] = $sV['status_name'];
                                $new_stat[$nsK]['count'] = $sV['count'];
                                $count_total += (int) $sV['count'];
                            }
                        }
                    }
                }

                $new_stat[0] = array(
                    "status" => "Total",
                    "count" => $count_total,
                );

                // for checking 
//                if ($count_total != 0) {
//                    echo '<pre>';
//                    print_r($new_stat);
//                    exit();
//                }

                $rs[$dK][$ddK]['status'] = $new_stat;
                $rs[$dK][$ddK]['count'] = $count_total;
            }
        }


        return $rs;
    }

    public function mergeServicesAgingDataParent($date_status, $rs) {
//          echo '<pre>';        print_r($date_status);        print_r($rs); exit(); 
        // by date status 
        foreach ($rs as $dK => $dV) {
            $new_cur_date = $dV['date'];
            unset($dV['date'], $dV['No record.']);
            foreach ($dV as $ddK => $ddV) {
                $new_stat = [];
                $count = 0;
                $count_total = 0;

                $new_stat[$count] = array(
                    "status" => "Total",
                    "count" => $count_total,
                );

                $new_stat = $this->setDefaultServiceAgingStatus();
//                print_r($list_stat); exit(); 
//                foreach ($list_stat as $lsK => $lsV) {
//                    $count++;
//                    $new_stat[$count] = array(
//                        "status" => $lsV['name'],
//                        "count" => 0,
//                    );
//                }

                foreach ($date_status as $sK => $sV) {
                    if (($sV['date'] == $new_cur_date) && ($sV['variable'] == $ddK)) {
                        foreach ($new_stat as $nsK => $nsV) {
                            if ($sV['aging_status'] == $nsV['status']) {
                                $new_stat[$nsK]['status'] = $sV['aging_status'];
                                $new_stat[$nsK]['count'] = $sV['count'];
                                $count_total += (int) $sV['count'];
                            }
                        }
                    }
                }

                $new_stat[0] = array(
                    "status" => "Total",
                    "count" => $count_total,
                );

                // for checking 
//                if ($count_total != 0) {
//                    echo '<pre>';
//                    print_r($new_stat);
//                    exit();
//                }

                $rs[$dK][$ddK]['status'] = $new_stat;
                $rs[$dK][$ddK]['count'] = $count_total;
            }
        }


        return $rs;
    }

    public function mergeRowServicesData($date_status, $rs) {

        $new_stat = $this->setDefaultServiceStatus($rs['count']);

        foreach ($date_status as $sK => $sV) {
            if (
                    ($sV['date'] == $rs['date']) &&
                    ($sV['variable'] == $rs['variable'])
            ) {
                foreach ($new_stat as $nsK => $nsV) {
                    if ($sV['status_name'] == $nsV['status']) {
                        $new_stat[$nsK]['status'] = $sV['status_name'];
                        $new_stat[$nsK]['count'] = $sV['count'];
                    }
                }
            }
        }

        return $new_stat;
    }

    public function mergeRowAgingData($date_status, $rs) {

        $new_stat = $this->setDefaultServiceAgingStatus($rs['count']);
//   echo '<pre>';print_r($date_status); print_r($rs); print_r($new_stat);  exit(); 
        foreach ($date_status as $sK => $sV) {
            if (
                    ($sV['date'] == $rs['date']) &&
                    ($sV['variable'] == $rs['variable'])
            ) {
                foreach ($new_stat as $nsK => $nsV) {
                    if ($sV['aging_status'] == $nsV['status']) {
                        $new_stat[$nsK]['status'] = $sV['aging_status'];
                        $new_stat[$nsK]['count'] = $sV['count'];
                    }
                }
//                echo '<pre>';print_r($new_stat);exit(); 
            }
        }

        return $new_stat;
    }

    public function prepareGraphFormatWithParent($param, $base, $base_service, $base_service_with_status, $base_agency_branch, $status_type) {
        $aResult = [];
        $aResult['graph'] = $param;
        $aResult['base'] = $base;

        // gather all null records   
        foreach ($aResult['graph'] as $key => $value) {
            if (isset($aResult['graph'][$key]['variable']) != true) {
                $aResult['graph'][$key]['variable'] = self::NO_RECORD;
            }
        }

        $aResult['date'] = array_unique(array_column($aResult['graph'], 'date'));
        $aResult['variables'] = array_unique(array_column($aResult['graph'], 'variable'));

        // reset array index 
        $aResult['date'] = array_values($aResult['date']);

        $x = 0;
        $aTemplate = [];
        $aNewGraph = [];
        foreach ($aResult['date'] as $dK => $dV) {
            foreach ($aResult['variables'] as $vK => $vV) {
                $aTemplate[$x]['variable'] = $vV;
                $aTemplate[$x]['date'] = $dV;
                $x++;
            }
        }

        $x = 0;
        foreach ($aTemplate as $tK => $tV) {
            $aNewGraph[$x]['date'] = $tV['date'];
            $aNewGraph[$x]['variable'] = $tV['variable'];
            $count = 0;
            $parent = "";
            foreach ($aResult['graph'] as $gK => $gV) {

                if (($tV['variable'] == $gV['variable']) && ($tV['date'] == $gV['date'])) {
                    $count = $count + $gV['count'];
                }

                if (($tV['variable'] == $gV['variable'])) {
                    $parent = $gV['parent'];
                }
            }
            $aNewGraph[$x]['count'] = $count;
            $aNewGraph[$x]['parent'] = $parent;
            $x++;
        }
        $aResult['graph'] = $aNewGraph;

        $x = 0;
        foreach ($aResult['date'] as $dK => $dV) {
            // get index of same date
            $aRes['indexDate'] = array_keys(array_column($aResult['graph'], 'date'), $dV);

            // get value of array
            $iIndexDate = 0;
            $aIndexDate = [];
            foreach ($aRes['indexDate'] as $key => $value) {
                $aIndexDate[$iIndexDate] = $aResult['graph'][$value];
                $iIndexDate++;
            }

            foreach ($aResult['base'] as $key => $value) {
                $aResult['output']['seperate'][$x]['variable'] = $value['name'];
                $aResult['output']['seperate'][$x]['count'] = self::ZERO_COUNT;
                $aResult['output']['seperate'][$x]['date'] = $dV;
                $aResult['output']['seperate'][$x]['parent'] = $this->searchParent($aResult['graph'], $value['name']);
                $iKey = array_search($value['name'], array_column($aIndexDate, 'variable'));
                if ($iKey !== false) {
                    $aResult['output']['seperate'][$x]['count'] = $aIndexDate[$iKey]['count'];
                    $aResult['output']['seperate'][$x]['date'] = $aIndexDate[$iKey]['date'];
                }
                $x++;
            }
        }

        // by date 
        foreach ($aResult['date'] as $dK => $dV) {
            $aResult['output']['by_date'][$dK]['date'] = $dV;
            $base_parent = $this->Reports_model->getAgencyTypes();

            foreach ($base_parent as $bpK => $bpV) {
                $parent = $bpV['name'];
                $count = 0;
                foreach ($aResult['output']['seperate'] as $osK => $osV) {
                    if (($dV == $osV['date']) && ($parent == $osV['parent'])) {

                        $setDefaultStatus = [];
                        // service 
                        if ($status_type == '1') {
                            $setDefaultStatus = $this->setDefaultServiceStatus();
                        }
                        // service aging 
                        else if ($status_type == '2') {
                            $setDefaultStatus = $this->setDefaultServiceAgingStatus();
                        }

                        $aResult['output']['by_date'][$dK][$osV['parent']]['status'] = $setDefaultStatus;
                        $aResult['output']['by_date'][$dK][$osV['parent']]['content'][$count]['variable'] = $osV['variable'];
                        $aResult['output']['by_date'][$dK][$osV['parent']]['content'][$count]['count'] = $osV['count'];

                        // service 
                        if ($status_type == '1') {
                            $aResult['output']['by_date'][$dK][$osV['parent']]['content'][$count]['status'] = $this->mergeRowServicesData($base_agency_branch, $osV);
                        }
                        // service aging 
                        else if ($status_type == '2') {
                            $aResult['output']['by_date'][$dK][$osV['parent']]['content'][$count]['status'] = $this->mergeRowAgingData($base_agency_branch, $osV);
                        }

                        $content = [];
                        $content = $this->Reports_model->getOfferedServicesByBranchNameView($osV['variable']);

                        $check = 0;
                        $counting = 1;
                        foreach ($content as $mK => $mV) {
                            $con_service_name_full = $mV['service_name_full'];
                            $counting++;
                            $done = 0;
                            $content[$mK]['status'] = $setDefaultStatus;

                            foreach ($base_service as $bsK => $bsV) {
                                if (($done == 0) && ( ($dV == $bsV['date']) && ($osV['variable'] == $bsV['variable']) && ($con_service_name_full == $bsV['service_name_full']) )) {
                                    $check = 1;
                                    $content[$mK]['count'] = $bsV['count'];
                                    $content[$mK]['status'] = $this->mergeServicesAgencyBranchData($base_service_with_status, $bsV, $status_type);
                                }
                            }
                        }

//                        if ($check == 1) {
//                            echo '<pre>';
//                            print_r($content);
//                            exit();
//                        }

                        $aResult['output']['by_date'][$dK][$osV['parent']]['content'][$count]['content'] = $content;

                        $count++;
                    }
                }
            }
        }

        foreach ($aResult['base'] as $key => $value) {
            $iSum = 0;
            foreach ($aResult['output']['seperate'] as $osK => $osV) {
                if ($value['name'] == $osV['variable']) {
                    $iSum += $osV['count'];
                }
            }
            $aResult['output']['by_variable'][$key]['variable'] = $value['name'];
            $aResult['output']['by_variable'][$key]['count'] = $iSum;
        }


        return $aResult['output'];
    }

    public function searchParent($aParam = null, $search = "") {
        $parent = "";
        foreach ($aParam as $gK => $gV) {

            if (($search == $gV['variable'])) {
                $parent = $gV['parent'];
            }
        }
        return $parent;
    }

    public function prepareGraphFormat($param, $base) {
        $aResult = [];
        $aResult['graph'] = $param;
        $aResult['base'] = $base;

        // gather all null records   
        foreach ($aResult['graph'] as $key => $value) {
            if (isset($aResult['graph'][$key]['variable']) != true) {
                $aResult['graph'][$key]['variable'] = self::NO_RECORD;
            }
        }

        $aResult['date'] = array_unique(array_column($aResult['graph'], 'date'));
        $aResult['variables'] = array_unique(array_column($aResult['graph'], 'variable'));

        // reset array index 
        $aResult['date'] = array_values($aResult['date']);

        $x = 0;
        $aTemplate = [];
        $aNewGraph = [];
        foreach ($aResult['date'] as $dK => $dV) {
            foreach ($aResult['variables'] as $vK => $vV) {
                $aTemplate[$x]['variable'] = $vV;
                $aTemplate[$x]['date'] = $dV;
                $x++;
            }
        }

        $x = 0;
        foreach ($aTemplate as $tK => $tV) {
            $aNewGraph[$x]['date'] = $tV['date'];
            $aNewGraph[$x]['variable'] = $tV['variable'];
            $count = 0;
            foreach ($aResult['graph'] as $gK => $gV) {

                if (($tV['variable'] == $gV['variable']) && ($tV['date'] == $gV['date'])) {
                    $count = $count + $gV['count'];
                }
            }
            $aNewGraph[$x]['count'] = $count;
            $x++;
        }
        $aResult['graph'] = $aNewGraph;

        $x = 0;
        foreach ($aResult['date'] as $dK => $dV) {
            // get index of same date
            $aRes['indexDate'] = array_keys(array_column($aResult['graph'], 'date'), $dV);
            // get value of array
            $iIndexDate = 0;
            $aIndexDate = [];
            foreach ($aRes['indexDate'] as $key => $value) {
                $aIndexDate[$iIndexDate] = $aResult['graph'][$value];
                $iIndexDate++;
            }

            foreach ($aResult['base'] as $key => $value) {
                $aResult['output']['seperate'][$x]['variable'] = $value['name'];
                $aResult['output']['seperate'][$x]['count'] = self::ZERO_COUNT;
                $aResult['output']['seperate'][$x]['date'] = $dV;
                $iKey = array_search($value['name'], array_column($aIndexDate, 'variable'));
                if ($iKey !== false) {
                    $aResult['output']['seperate'][$x]['count'] = $aIndexDate[$iKey]['count'];
                    $aResult['output']['seperate'][$x]['date'] = $aIndexDate[$iKey]['date'];
                }
                $x++;
            }
        }

        // by date 
        foreach ($aResult['date'] as $dK => $dV) {
            $aResult['output']['by_date'][$dK]['date'] = $dV;
            foreach ($aResult['output']['seperate'] as $osK => $osV) {
                if ($dV == $osV['date']) {
                    $aResult['output']['by_date'][$dK][$osV['variable']] = $osV['count'];
                }
            }
        }

        foreach ($aResult['base'] as $key => $value) {
            $iSum = 0;
            foreach ($aResult['output']['seperate'] as $osK => $osV) {
                if ($value['name'] == $osV['variable']) {
                    $iSum += $osV['count'];
                }
            }
            $aResult['output']['by_variable'][$key]['variable'] = $value['name'];
            $aResult['output']['by_variable'][$key]['count'] = $iSum;
        }


        return $aResult['output'];
    }

    public function mergeServicesData($date_status, $rs) {
        // by date status 
        foreach ($rs as $dK => $dV) {

            $new_cur_date = $dV['date'];
            unset($dV['date'], $dV['No record.']);
            foreach ($dV as $ddK => $ddV) {

                $new_stat = [];
                $count = 0;

                $new_stat[$count] = array(
                    "status" => "Total",
                    "count" => $ddV,
                );

                $list_stat = $this->Reports_model->getTransactionParambyId(1);
                foreach ($list_stat as $lsK => $lsV) {
                    $count++;
                    $new_stat[$count] = array(
                        "status" => $lsV['name'],
                        "count" => 0,
                    );
                }

                foreach ($date_status as $sK => $sV) {
                    if (($sV['date'] == $new_cur_date) && ($sV['variable'] == $ddK)) {
                        foreach ($new_stat as $nsK => $nsV) {
                            if ($sV['status_name'] == $nsV['status']) {
                                $new_stat[$nsK]['status'] = $sV['status_name'];
                                $new_stat[$nsK]['count'] = $sV['count'];
                            }
                        }
                    }
                }

                $rs[$dK][$ddK] = array(
                    "status" => $new_stat
                );
            }
        }

        return $rs;
    }

    public function setDefaultServiceStatus($total = 0) {

        $new_stat = [];
        $count = 0;

        $new_stat[$count] = array(
            "status" => "Total",
            "count" => $total,
        );


        $list_stat = $this->Reports_model->getTransactionParambyId(1);
        foreach ($list_stat as $lsK => $lsV) {
            $count++;
            $new_stat[$count] = array(
                "status" => $lsV['name'],
                "count" => 0,
            );
        }

        return $new_stat;
    }

    public function setDefaultServiceAgingStatus($total = 0) {

        $new_stat = [];
        $count = 0;

        $new_stat[$count++] = array(
            "status" => "Total",
            "count" => $total,
        );

        $new_stat[$count++] = array(
            "status" => "Past due",
            "count" => 0,
        );

        $new_stat[$count++] = array(
            "status" => "Within due",
            "count" => 0,
        );

        $new_stat[$count++] = array(
            "status" => "Updated",
            "count" => 0,
        );

        $new_stat[$count++] = array(
            "status" => "Done",
            "count" => 0,
        );

        return $new_stat;
    }

    public function mergeServicesAgencyBranchData($date_status, $rs, $status_type) {
        // unset status name of rs 
        unset($rs['status_name']);
        // by date status 
        // service 
        if ($status_type == '1') {
            $new_stat = $this->setDefaultServiceStatus($rs['count']);
        }
        // service aging 
        else if ($status_type == '2') {
            $new_stat = $this->setDefaultServiceAgingStatus($rs['count']);
        }

//        echo '<pre>';        print_r($new_stat); exit(); 


        foreach ($date_status as $sK => $sV) {
            if (
                    ($sV['date'] == $rs['date']) &&
                    ($sV['variable'] == $rs['variable']) &&
                    ($sV['parent'] == $rs['parent']) &&
                    ($sV['service_name_full'] == $rs['service_name_full'])
            ) {

                foreach ($new_stat as $nsK => $nsV) {

                    if ($sV['status_name'] == $nsV['status']) {

                        $new_stat[$nsK]['status'] = $sV['status_name'];
                        $new_stat[$nsK]['count'] = $sV['count'];
                        //echo $sV['service_name_full'] .'-'. $sV['count']. '<br>';
                    }
                }
            }
        }

        $rs['status'] = $new_stat;
        return $new_stat;
    }

}
