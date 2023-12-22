<?php

/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Audit Trail 
 *
 * @author eBusiness Team
 */
class Audit extends CI_Controller {

    // constant
    const SUCCESS_RESPONSE = 1;
    const FAILED_RESPONSE = 0;

    // load yel framework
    private $yel;
    private $CI;

    // form load 
    public function __construct() {

        // load yel for sanitization
        $this->yel = new Yel();

        // instance loader
        $this->CI = & get_instance();

        // load models
        $this->CI->load->model('Audit_model');
    }

    /**
     * Create User Log
     * 
     * @param string $aParam
     *      event_type_id : id source ['mis_user_log_event_type']
     * @return array $aResponse
     */
    public function create($aParam) {

        // global
        $aResponse = [];

        // initial flag 
        $aResponse['flag'] = self::FAILED_RESPONSE;

        // sanitize 
        $aParam = $this->yel->safe_mode_clean_array($aParam);


        if (empty($aParam['log_event_type']) !== false) {
            $aResponse['message'] = '[LOG] Event Type is required';
            return $aResponse;
        }

        if (empty($aParam['log_message']) !== false) {
            $aResponse['message'] = '[LOG] Message is required';
            return $aResponse;
        }

        // add system data to existing param
        //set user id from session
        $aParam['user_id'] = $this->yel->clean($_SESSION['userData']['user_id']);
        //set panel type id from session
        if ($_SESSION['userData']['loginFrom'] == "administrator") {
            $aParam['log_panel'] = 1;
        } else {
            $aParam['log_panel'] = 2;
        }

        if (isset($aParam['module_primary_id']) == false) {
            $aParam['module_primary_id'] = "";
        }
        if (isset($aParam['sub_module_primary_id']) == false) {
            $aParam['sub_module_primary_id'] = "";
        }

        //set agency abbreviation from session
        $aParam['log_abbr'] = $this->yel->clean($_SESSION['userData']['agency_abbr']);
        //set user fullname from session
        $aParam['log_fullname'] = $this->yel->clean($_SESSION['userData']['user_firstname']) . " " . $this->yel->clean($_SESSION['userData']['user_lastname']);
        //clean data
        $aParam['log_event_type'] = (int) $this->yel->clean($aParam['log_event_type']);
        // mis_user_logs
        $aAudit['user_logs'] = $this->CI->Audit_model->createUserLogs($aParam);

        // prepare for log source table
        $aParam['user_log_id'] = $aAudit['user_logs']['insert_id'];
        $aParam['user_log_source_ip'] = $this->yel->clean($_SERVER['REMOTE_ADDR']);
        $aParam['user_log_source_user_agent'] = $this->yel->clean_minor($_SERVER['HTTP_USER_AGENT']);
        // mis_user_log_source
        $aAudit['user_log_source'] = $this->CI->Audit_model->saveUserLogSource($aParam);

        if (isset($aParam['log_action']) == true && $aParam['log_action'] == "2") {
            $this->user_log_update_parameter($aParam);
        }


        $aResponse['flag'] = self::SUCCESS_RESPONSE;
        return $aResponse;
    }

    private function user_log_update_parameter($aParam) {

        $old_data = json_decode($this->yel->decrypt_param($aParam['old_data']), true);
        $new_data = json_decode($this->yel->decrypt_param($aParam['new_data']), true);

        if (count($old_data) >= 1) { /* do nothing */
        } else {
            foreach ($new_data as $key => $val) {
                $old_data[$key] = "";
            }
        }
        $diff = array_diff($old_data, $new_data);
        if (!empty($diff) == true && count($diff) >= 1) {
            foreach ($diff as $key => $value) {
                $field = str_replace('_', ' ', $key);
                $old_data[$key] = $this->yel->clean($old_data[$key]);
                $new_data[$key] = $this->yel->clean($new_data[$key]);
                $this->CI->Audit_model->saveUserLogOldAndNewParameterValue($aParam, $old_data[$key], $new_data[$key], $field);
            }
        }
        return $aParam;
    }

    public function getActivityLogs($aParam) {
        // global
        $aResponse = [];

        // initial flag 
        $aResponse['flag'] = self::FAILED_RESPONSE;

        // sanitize 
        $aParam = $this->yel->safe_mode_clean_array($aParam);
        $result = $this->CI->Audit_model->getUserActivityLogs($aParam);

        //loop to check if log is from update then get details on what was updated
        foreach ($result['list'] as $key => $val) {
            $result['list'][$key]['changes'] = $this->switchCases($val['user_log_event_type_id'], $val['user_log_id']);
        }
        $aResponse['flag'] = self::SUCCESS_RESPONSE;
        $aResponse['result'] = $result;
        return $aResponse;
    }

    private function switchCases($event_type, $log_id) {
        $result = [];

        switch ($event_type) {
            case '3': // update Agency Details
            case '6': // update Agency Branch Details
            case '10': // update Agency Branch contact Details
            case '11': // update Agency Branch contact Address Details
            case '14': // update user status
            case '15': // update user account details
            case '16': // update user Address Details
            case '18': // update complainant Details
            case '21': // update act means purpose
            case '22': // update case evalation
            case '25': // update case offender
            case '28': // update recruitment agency
            case '39': // update local recruitment agency
            case '40': // update foreign recruitment agency
            case '57': // Update victim's contact info
            case '59': // Update Educational Background
            case '61': // Update victim address
            case '63': // Update next of kin
            case '75': // Update victim sub info
            case '76': // Update victim info
            case '77': // Update service status and remarks
            case '67': // Update victim's contact info
            case '69': // Update victim's contact info
            case '71': // Update victim's contact info
            case '73': // Update victim's contact info
            case '75': // Update victim's contact info
            case '76': // Update victim's contact info
            case '83': // Update Criminal Case  Filing of Complaint
            case '85': // Update Criminal Case Preliminary Investigation
            case '87': // Update Criminal Case Inquest
            case '89': // Update Criminal Case Resolution of the Investigation Prosecutor
            case '91': // Update Criminal Case Motion for Reconsideration on the Resolution
            case '93': // Update Criminal Case Review of the City or Provincial Prosecutor
            case '95': // Update Criminal Case Petition for review to the Secretary of Justice
            case '97': // Update Criminal Case Motion for Reconsideration on the Resolution of the SOJ
            case '99': // Update Criminal Case Filing of Information in Court
            case '101': // Update Criminal Case Dismissal or Issuance of Warrant or Arrest or Commitment Order
            case '103': // Update Criminal Case Bail-Hearing and Resolution of Petition for Bail
            case '105': // Update Criminal Case Arraignment and Pre-Trial Conference
            case '107': // Update Criminal Case Trial Status
            case '109': // Update Criminal Case Submission for Resolution
            case '111': // Update Criminal Case Promulgation of Judgment
            case '113': // Update Criminal Case Motion for Reconsideration or New Trial
            case '115': // Update Criminal Case Appeal to Court of Appeals
            case '117': // Update Criminal Case Motion for Reconsideration on the decision of CA
            case '119': // Update Criminal Case Decision of CA
            case '121': // Update Criminal Case Appeal to the Supreme Court
            case '123': // Update Criminal Case Decision of SC
            case '128': // Update service status
            case '130': // Update Admin Case filing and receipt of complaints
            case '132':
            case '134':
            case '136':
            case '138':
            case '140':
            case '142':
            case '144':
            case '146':
            case '148':
            case '150':
            case '152':
            case '154':
            case '156':
            case '158':
            case '160':
            case '162':
            case '164':
            case '166':
            case '168':
            case '171': // Update case priority level 
                $result = $this->CI->Audit_model->getChangedValuesPerLogID($log_id);
                break;
            default :
                $result['list'] = "";
                $result['count'] = "0";
        }
        return $result;
    }

    public function getActivityLogs_adminUser($aParam) {
        // global
        $aResponse = [];

        // initial flag 
        $aResponse['flag'] = self::FAILED_RESPONSE;

        // sanitize 
        $aParam = $this->yel->safe_mode_clean_array($aParam);
        $result = $this->CI->Audit_model->getActivityLogs_adminUser($aParam);

        //loop to check if log is from update then get details on what was updated
        foreach ($result['list'] as $key => $val) {
            $result['list'][$key]['changes'] = $this->switchCases($val['user_log_event_type_id'], $val['user_log_id']);
        }
        $aResponse['flag'] = self::SUCCESS_RESPONSE;
        $aResponse['result'] = $result;
        return $aResponse;
    }

    public function getActivityLogsCriminalCase($aParam) {
        // global
        $aResponse = [];

        // initial flag 
        $aResponse['flag'] = self::FAILED_RESPONSE;

        // sanitize 
        $aParam = $this->yel->safe_mode_clean_array($aParam);

        $aParam['c_batch_id'] = '';
        if (empty($aParam['legal_cc_batch_id']) == false) {
            $aParam['encrypt_legal_cc_batch_id'] = $aParam['legal_cc_batch_id'];
            $aParam['legal_cc_batch_id'] = $this->yel->decrypt_param($aParam['legal_cc_batch_id']);
            $aParam['c_batch_id'] = " AND     `ul`.`module_primary_id` = " . $aParam['legal_cc_batch_id'] . "";
        }

        $result = $this->CI->Audit_model->getActivityLogsCriminalCase($aParam);

        return $result;
    }

    public function getActivityLogsAdministrativeCase($aParam) {
        // global
        $aResponse = [];

        // initial flag 
        $aResponse['flag'] = self::FAILED_RESPONSE;

        // sanitize 
        $aParam = $this->yel->safe_mode_clean_array($aParam);

        $aParam['c_batch_id'] = '';
        if (empty($aParam['legal_ac_docket_id']) == false) {
            $aParam['encrypt_legal_ac_docket_id'] = $aParam['legal_ac_docket_id'];
            $aParam['legal_ac_docket_id'] = $this->yel->decrypt_param($aParam['legal_ac_docket_id']);
            $aParam['c_batch_id'] = " AND     `ul`.`module_primary_id` = " . $aParam['legal_ac_docket_id'] . "";
        }

        $result = $this->CI->Audit_model->getActivityLogsAdministrativeCase($aParam);

        return $result;
    }

    public function getActivityLogs_branchUser($aParam) {
       
        // global
        $aResponse = [];

        // initial flag 
        $aResponse['flag'] = self::FAILED_RESPONSE;

        // sanitize 
        $aParam = $this->yel->safe_mode_clean_array($aParam);
        //get user's id with the same branch
        $ids = $this->CI->Audit_model->getUsersID();
        $aParam['usersID'] = "";
        $ctr = 0;
        foreach ($ids as $k => $v) {
            if ($ctr <= 0) {
                $aParam['usersID'] = $v['user_id'];
            } else {
                $aParam['usersID'] .= "," . $v['user_id'];
            }
            $ctr++;
        }

        $result = $this->CI->Audit_model->getActivityLogs_branchUser($aParam);
        
        //loop to check if log is from update then get details on what was updated
        foreach ($result['list'] as $key => $val) {
            switch ($val['user_log_event_type_id']) {
                case '3': // update Agency Details
                    $result['list'][$key]['changes'] = $this->CI->Audit_model->getChangedValuesPerLogID($val['user_log_id']);
                    break;
                default :
                    $result['list'][$key]['changes']['list'] = "";
                    $result['list'][$key]['changes']['count'] = "0";
            }
        }
        $aResponse['flag'] = self::SUCCESS_RESPONSE;
        $aResponse['result'] = $result;
        return $aResponse;
    }

}
