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

    public function __construct() {
        parent::__construct();

        // load models
        $this->load->model('Reports_model');
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
    
    

}