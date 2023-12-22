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
class Api extends CI_Controller {

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
//        $this->CI->load->model('Audit_model');
    }

    public function getUsers() {
//        $sql= " SELECT 
//                    `user_id`,
//                    `user_firstname`,
//                    `user_middlename`,
//                    `user_lastname`,
//                    `user_phone_number`,
//                    `user_mobile_number`,
//                    `user_gender`,
//                    `user_job_title`,
//                    `user_username`,
//                    `user_email`,
//                    `user_password`,
//                    `user_access_code`,
//                    `agency_branch_id`,
//                    `user_level_id`,
//                    `user_is_active`,
//                    `agency_is_active`,
//                    `agency_branch_is_active`,
//                    `user_level_is_active`,
//                    `user_is_verified`
//                from 
//                    icms_user
//                LIMIT 1000";
//        $aResponse= $this->yel->GetAll($sql);
//        return $aResponse;
    }

}
