<?php

/**
 * Case Internal Ajax
 * 
 * @module Ajax Loader
 * @author LBS eBusiness Solutions Corp. 
 * @since 2017
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Validate extends CI_Controller {

    const SUCCESS_RESPONSE = 1;
    const FAILED_RESPONSE = 0;

    public function __construct() {
        parent::__construct();

        // load models
        $this->load->model('agency/Validate_model');
    }

    /**
     * Ajax Route :: Action Controller
     */
    public function ajax() {
        $this->base_action_ajax();
    }

    public function sessionDestruct() {
        // session destroy
        $this->sessionPushLogout('agency');
    }

    /*
     * New Validate
     */
    public function validate($aParam) {
        $aResponse = [];

        $aParam = $this->yel->clean_array($aParam);
        $aResponse['flag'] = self::FAILED_RESPONSE;
        $total_fields = 2;
        $tf = 1;
        
        // initialize variable for compiled validate data
        $aResponse['validate_text'] = '';
        
        // get victim relevance by name
        $resp['resp_name'] = [];
        if (!empty($aParam['victim_info_middle_name']) !== false) {
            // get victim relevance by full name
            $aParam['full_name'] = $aParam['victim_info_first_name'] . ' ' . $aParam['victim_info_middle_name'] . ' ' . $aParam['victim_info_last_name'];
            $resp['resp_name'] = $this->Validate_model->getVictimWithRelFullName($aParam['full_name']);
            $total_fields = $total_fields + 1;
            $aResponse['validate_text'] = $aParam['full_name']; 
        } else {
            // get victim relevance by full name
            $aParam['full_name'] = $aParam['victim_info_first_name'] . ' ' . $aParam['victim_info_last_name'];
            $resp['resp_name'] = $this->Validate_model->getVictimWithRelName($aParam['full_name']);
            $aResponse['validate_text'] = $aParam['full_name']; 
        }


        $i = 0;
        foreach ($resp['resp_name'] as $key => $val) {
            $resp['resp_name'][$i] = $val;
            similar_text(strtolower($aParam['full_name']),strtolower($val['rel_content']),$percent);
            $resp['resp_name'][$i]['rel_percentage'] = $percent;
            $resp['resp_name'][$i]['rel_desc'] = 'rel_name';
            $i++;
        }

        // get victim relevance by dob
        $resp['resp_dob'] = [];
        if (!empty($aParam['victim_info_dob']) !== false) {
            $date = $aParam['victim_info_dob'];
            $aParam['victim_info_dob'] = $this->dateFormat($date);
            $resp['resp_dob'] = $this->Validate_model->getVictimWithRelDob($aParam['victim_info_dob']);

//            if ($resp['resp_dob']) {
            $i = 0;
            foreach ($resp['resp_dob'] as $key => $val) {
                $resp['resp_dob'][$i] = $val;
                $resp['resp_dob'][$i]['rel'] = 10;
                $resp['resp_dob'][$i]['rel_content'] = $aParam['victim_info_dob'];
                $resp['resp_dob'][$i]['rel_percentage'] = 100;
                $resp['resp_dob'][$i]['rel_desc'] = 'rel_dob';
                $i++;
            }
            $total_fields = $total_fields + 1;
            $tf = $tf + 1;
            $aResponse['validate_text'] = $aResponse['validate_text'] . ' ' . $aParam['victim_info_dob'];
        }

        // get victim relevance by pob
        $resp['resp_pob'] = [];
        if ((!empty($aParam['victim_info_city_pob']) !== false) && ($aParam['victim_info_city_pob'] != 'null')) {
            $resp['resp_pob'] = $this->Validate_model->getVictimWithRelPob($aParam['victim_info_city_pob']);
            $i = 0;
            foreach ($resp['resp_pob'] as $key => $val) {
                $resp['resp_pob'][$i] = $val;
                $resp['resp_pob'][$i]['rel'] = 10;
                $resp['resp_pob'][$i]['rel_content'] = $aParam['victim_info_city_pob_text'];
                $resp['resp_pob'][$i]['rel_percentage'] = 100;
                $resp['resp_pob'][$i]['rel_desc'] = 'rel_pob';
                $i++;
            }

            $total_fields = $total_fields + 1;
            $tf = $tf + 1;
            $aResponse['validate_text'] = $aResponse['validate_text'] . ' ' . $aParam['victim_info_city_pob_text'];
        }

        // get victim relevance by offender name
        $resp['resp_offenders'] = [];
        if (!empty($aParam['offender_name']) !== false) {
            $resp['resp_offenders'] = $this->Validate_model->getVictimWithRelOffendersName($aParam['offender_name']);
            $i = 0;
            foreach ($resp['resp_offenders'] as $key => $val) {
                similar_text(strtolower($aParam['offender_name']),strtolower($val['case_offender_name']),$percent);
                $resp['resp_offenders'][$i] = $this->Validate_model->getVictimByCaseId($val['case_id']); //victim id
                $resp['resp_offenders'][$i]['victim_info_id'] = $val['case_offender_id']; 
                $resp['resp_offenders'][$i]['rel'] = $val['rel_offender'];
                $resp['resp_offenders'][$i]['rel_content'] = $val['case_offender_name'];
                $resp['resp_offenders'][$i]['rel_desc'] = 'rel_offender';
                $resp['resp_offenders'][$i]['rel_percentage'] = $percent;
                $i++;
            }

            $total_fields = $total_fields + 1;
            $tf = $tf + 1;
            $aResponse['validate_text'] = $aResponse['validate_text'] . ' ' . $aParam['offender_name'];
        }

        // get victim relevance by employer name
        $resp['resp_employers'] = [];
        if (!empty($aParam['employer_name']) !== false) {
            $aParam['employers'] = $this->Validate_model->getEmployerNameRel($aParam['employer_name']);
            
            $i = 0;
            foreach ($aParam['employers'] as $key => $val) {
                $aParam['v_details'] = $this->Validate_model->getVictimByEmployerId($val['employer_id']);
                
                foreach ($aParam['v_details'] as $k => $v) {
                    if (!empty($v['victim_id']) !== false) {
                        similar_text(strtolower($aParam['employer_name']),strtolower($val['employer_name']),$percent);
                        $resp['resp_employers'][$i]['victim_info_id'] = $val['employer_id'];
                        $resp['resp_employers'][$i]['victim_id'] = $v['victim_id'];
                        $resp['resp_employers'][$i]['rel'] = $val['rel_employer'];
                        $resp['resp_employers'][$i]['rel_content'] = $val['employer_name'];
                        $resp['resp_employers'][$i]['rel_desc'] = 'rel_employer';
                        $resp['resp_employers'][$i]['rel_percentage'] = $percent;
                    }
                    $i++;
                }
                
            }

            $total_fields = $total_fields + 1;
            $tf = $tf + 1;
            $aResponse['validate_text'] = $aResponse['validate_text'] . ' ' . $aParam['employer_name'];
        }

        // get victim relevance by local recruitment agency
        $resp['resp_agency'] = [];
        if (!empty($aParam['local_recruitment_agency']) !== false) {
            $aParam['agency'] = $this->Validate_model->getAgencyNameRel($aParam['local_recruitment_agency']);
            $i = 0;
            foreach ($aParam['agency'] as $key => $val) {
                $aParam['v_details'] = $this->Validate_model->getVictimByAgencyId($val['recruitment_agency_id']);

                foreach ($aParam['v_details'] as $k => $v) {
                    if (!empty($v['victim_id']) !== false) {
                        similar_text(strtolower($aParam['local_recruitment_agency']),strtolower($val['recruitment_agency_name']),$percent);
                        $resp['resp_agency'][$i]['victim_info_id'] = $val['recruitment_agency_id'];
                        $resp['resp_agency'][$i]['victim_id'] = $v['victim_id'];
                        $resp['resp_agency'][$i]['rel'] = $val['rel_agency'];
                        $resp['resp_agency'][$i]['rel_content'] = $val['recruitment_agency_name'];
                        $resp['resp_agency'][$i]['rel_desc'] = 'rel_agency';
                        $resp['resp_agency'][$i]['rel_percentage'] = $percent;
                    }

                    $i++;
                }
            }

            $total_fields = $total_fields + 1;
            $tf = $tf + 1;
            $aResponse['validate_text'] = $aResponse['validate_text'] . ' ' . $aParam['local_recruitment_agency'];
        }

        // get victim relevance by delployed date
        $resp['resp_deployed'] = [];
        if (!empty($aParam['deployed_date']) !== false) {
            $date = $aParam['deployed_date'];
            $aParam['deployed_date'] = $this->dateFormat($date);
            $aParam['deployed'] = $this->Validate_model->getDeployedDateRel($aParam['deployed_date']);
            $i = 0;
            foreach ($aParam['deployed'] as $key => $val) {
                $aParam['v_details'] = $this->Validate_model->getVictimByCaseVictimId($val['case_victim_id']);
                foreach ($aParam['v_details'] as $k => $v) {
                    if (!empty($v['victim_id']) !== false) {
                        $resp['resp_deployed'][$i]['victim_info_id'] = $val['case_victim_deployment_id']; // case victim deployment id
                        $resp['resp_deployed'][$i]['victim_id'] = $v['victim_id'];
                        $resp['resp_deployed'][$i]['rel'] = 10;
                        $resp['resp_deployed'][$i]['rel_content'] = $aParam['deployed_date'];
                        $resp['resp_deployed'][$i]['rel_desc'] = 'rel_deployed';
                        $resp['resp_deployed'][$i]['rel_percentage'] = 100;
                    }
                    $i++;
                }
            }

            $total_fields = $total_fields + 1;
            $tf = $tf + 1;
            $aResponse['validate_text'] = $aResponse['validate_text'] . ' ' . $aParam['deployed_date'];
        }

        // get victim relevance by delployed country
        $resp['resp_country'] = [];

        if (!empty($aParam['deployment_country']) !== false && $aParam['deployment_country'] !== null && $aParam['deployment_country'] !== "" && $aParam['deployment_country'] !== "null") {
            $aParam['country'] = $this->Validate_model->getDeployedCountryRel($aParam['deployment_country']);
            $i = 0;
            foreach ($aParam['country'] as $key => $val) {
                $aParam['v_details'] = $this->Validate_model->getVictimByCaseVictimId($val['case_victim_id']);
                
                foreach ($aParam['v_details'] as $k => $v) {
                    if (!empty($v['victim_id']) !== false) {
                        $resp['resp_country'][$i]['victim_info_id'] = $val['case_victim_deployment_id'];// case victim deployment id
                        $resp['resp_country'][$i]['victim_id'] = $v['victim_id'];
                        $resp['resp_country'][$i]['rel'] = 10;
                        $resp['resp_country'][$i]['rel_content'] = $aParam['deployment_country_text'];
                        $resp['resp_country'][$i]['rel_desc'] = 'rel_country';
                        $resp['resp_country'][$i]['rel_percentage'] = 100;
                    }
                    $i++;
                }
            }

            $total_fields = $total_fields + 1;
            $tf = $tf + 1;
            $aResponse['validate_text'] = $aResponse['validate_text'] . ' ' . $aParam['deployment_country_text'];
        }

        // get victim relevance by traffic purpose
        $resp['resp_purpose'] = [];
        if ((!empty($aParam['traffic_purpose']) !== false) && ($aParam['traffic_purpose'] != 'null')) {
            $aParam['purpose'] = $this->Validate_model->getTrafficPurposeRel($aParam['traffic_purpose']);
            $i = 0;
            foreach ($aParam['purpose'] as $key => $val) {
                $aParam['v_details'] = $this->Validate_model->getVictimByCaseVictimId($val['case_victim_id']);
                foreach ($aParam['v_details'] as $k => $v) {
                    if (!empty($v['victim_id']) !== false) {
                        $resp['resp_purpose'][$i]['victim_id'] = $v['victim_id'];
                        $resp['resp_purpose'][$i]['rel'] = 10;
                        $resp['resp_purpose'][$i]['rel_content'] = $aParam['traffic_purpose_text'];
                        $resp['resp_purpose'][$i]['rel_desc'] = 'rel_purpose';
                        $resp['resp_purpose'][$i]['rel_percentage'] = 100;
                    }
                    $i++;
                }
                
            }

            $total_fields = $total_fields + 1;
            $tf = $tf + 1;
            $aResponse['validate_text'] = $aResponse['validate_text'] . ' ' . $aParam['traffic_purpose_text'];
        }
        
        $aResponse['validate_text'] = strtolower($aResponse['validate_text']);
        $arr = array_merge($resp['resp_name'], $resp['resp_dob'], $resp['resp_pob'], $resp['resp_offenders'], $resp['resp_employers'], $resp['resp_agency'], $resp['resp_deployed'], $resp['resp_country'], $resp['resp_purpose']);

        if ($arr) {
            // get max count
            $count = $this->Validate_model->getMaxCount();
            $aResponse['count'] = $count + 1;

            // create values for insert
            $i = 0;
            $values = '';
            foreach ($arr as $key => $val) {
                similar_text($aResponse['validate_text'],strtolower($val['rel_content']),$percent);
                if (!empty($val['victim_info_id']) !== false) {
                    $val['victim_info_id'] = $val['victim_info_id'];
                } else {
                    $val['victim_info_id'] = '0';
                }
                $values = $values . "('" . $val['victim_id'] . "', '" . $aResponse['count'] . "', '" . $val['victim_info_id'] . "', '" . $val['rel_desc'] . "', '" . $val['rel'] . "', '" . $val['rel_content'] . "', '" . $val['rel_percentage'] . "' ),";
            }

            $aResponse['total_fields'] = $total_fields;
            $aResponse['tf'] = $tf;
            $aResponse['ins'] = $this->Validate_model->addVictimToValidationTbl(substr($values, 0, -1));
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
        }
        
        return $aResponse;
    }

    /*
     * New Get Validation Result
     */
    public function getAllStoredVictims($aParam) {
        $aResponse = [];

        $aParam = $this->yel->safe_mode_clean_array($aParam);
        $aResponse['flag'] = self::FAILED_RESPONSE;

        $aParam['count_id'] = $aParam['count'];

        // include pagination parameter 
        $aParam = $this->yel->pagination($aParam);
        
        // fetch victim with info id
        $aResponse['total_rel_by_info_id'] = $this->Validate_model->getAllValidateVictimWithDetails($aParam);
        $aResponse['count'] = count($aResponse['total_rel_by_info_id']['count']);
        
        // encrypt victim_id
        foreach ($aResponse['total_rel_by_info_id']['list'] as $k => $v) {
            $aResponse['total_rel_by_info_id']['list'][$k]['icms_validation_victim_id'] = $this->yel->encrypt_param($v['icms_validation_victim_id']);
        }
        $aResponse['flag'] = self::SUCCESS_RESPONSE;

        return $aResponse;
    }

   /*
     * New
     */
    public function getVictimCaseList($aParam) {
        $aResponse = [];

        $aParam = $this->yel->clean_array($aParam);
        $aResponse['flag'] = self::FAILED_RESPONSE;
        
        $date = $aParam['victim_info_dob'];
        $aParam['victim_info_dob'] = $this->dateFormat($date);
        $date = $aParam['deployed_date'];
        $aParam['deployed_date'] = $this->dateFormat($date);

        // decrypt 
        $aParam['victim_id'] = $this->yel->decrypt_param($aParam['victim_id']);
        $aResponse['victim_info'] = $this->Validate_model->getVictimDetails($aParam['victim_info_id']);


        $aResponse['cases'] = $this->Validate_model->getVictimCaseList($aParam['victim_id']);
        $aResponse['rel_desc'] = $this->Validate_model->getRelevanceByVictimId($aParam);

        if ($aResponse['victim_info']['victim_id']) {
            $aResponse['victim_info']['victim_id'] = $this->yel->encrypt_param($aResponse['victim_info']['victim_id']);
            
            foreach ($aResponse['rel_desc'] as $k => $v){
                switch($v['icms_validation_relevance_desc']) {
                    case 'rel_name':
                        $aResponse['victim_info']['rel_name_check'] = 1;
                        break;
                    case 'rel_dob':
                        $aResponse['victim_info']['rel_name_dob'] = 1;
                        break;
                    case 'rel_pob':
                        $aResponse['victim_info']['rel_name_pob'] = 1;
                        break;  
                }
            }
            
            $x = 0;
            foreach ($aResponse['cases'] as $key => $val) {
                $aResponse['test'][$x] = $val;
                foreach ($aResponse['rel_desc'] as $k => $v) {

                    if ($v['icms_validation_relevance_desc'] == 'rel_employer') {
                        
                        if ($v['icms_validation_victim_info_id'] == $val['employer_id']) {
                            $aResponse['test'][$x]['rel_emp_check'] = 1;
                        }
                    }

                    if ($v['icms_validation_relevance_desc'] == 'rel_agency') {
                        $agency_ids = $this->Validate_model->getAgencyNameRel($aParam['local_recruitment_agency']);
                        $i = 0;
                        foreach ($agency_ids as $a => $b) {
                            if ($b['recruitment_agency_id'] == $val['recruitment_agency_id_local']) {
                                $aResponse['test'][$x]['rel_agency_check'] = 1;
                            }
                            $i++;
                        }
                    }

                    if ($v['icms_validation_relevance_desc'] == 'rel_offender') {
                        $offenders = $this->Validate_model->getVictimWithRelOffendersName($aParam['offender_name']);
                        $i = 0;
                        foreach ($offenders as $a => $b) {
                            if ($b['case_id'] == $val['case_id']) {
                                $aResponse['test'][$x]['rel_offender_check'] = 1;
                            }
                            $i++;
                        }
                    }

                    if ($v['icms_validation_relevance_desc'] == 'rel_deployed') {
                        $deployed = $this->Validate_model->getDeployedDateRel($aParam['deployed_date']);
                        $i = 0;
                        foreach ($deployed as $a => $b) {
                            if ($b['case_victim_id'] == $val['case_victim_id']) {
                                $aResponse['test'][$x]['rel_deployed_check'] = 1;
                            }
                            $i++;
                        }
                    }

                    if ($v['icms_validation_relevance_desc'] == 'rel_country') {
                        $deployed_country = $this->Validate_model->getDeployedCountryRel($aParam['deployment_country']);
                        $i = 0;
                        foreach ($deployed_country as $a => $b) {
                            if ($b['case_victim_id'] == $val['case_victim_id']) {
                                $aResponse['test'][$x]['rel_deployed_country_check'] = 1;
                            }
                            $i++;
                        }
                    }

                    if ($v['icms_validation_relevance_desc'] == 'rel_purpose') {
                        $purpose = $this->Validate_model->getTrafficPurposeRel($aParam['traffic_purpose']);
                        $i = 0;
                        foreach ($purpose as $a => $b) {
                            if ($b['case_victim_id'] == $val['case_victim_id']) {
                                $aResponse['test'][$x]['rel_purpose_check'] = 1;
                            }
                            $i++;
                        }
                    }
                }
                $x++;
            }
            
            $aResponse['flag'] = self::SUCCESS_RESPONSE;
        }

        return $aResponse;
    }

    public function getCaseVictimDetails($aParam) {
        $aResponse = [];

        $aParam = $this->yel->clean_array($aParam);

        // get case victim details
        $aResponse['resp'] = $this->Validate_model->getCaseVictimDetails($aParam);

        return $aResponse;
    }

    private function dateFormat($date) {

        $m = substr($date, 0, 2);
        $d = substr($date, 2, 2);
        $y = substr($date, 4, 4);
        $date = $m . '/' . $d . '/' . $y;
        $fDate = date('Y-m-d', strtotime($date));

        return $fDate;
    }


}
