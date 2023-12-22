<?php

/**
 * Case Internal Ajax
 * 
 * @module Ajax Loader
 * @author LBS eBusiness Solutions Corp. 
 * @since 2017
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Case_ctrl extends CI_Controller {

    const SUCCESS_RESPONSE = 1;
    const FAILED_RESPONSE = 0;

    public function __construct() {
        parent::__construct();

        // load models
        $this->load->model('Case_model');
    }

    /**
     * Ajax Route :: Action Controller
     */
    public function ajax() {
//        echo 'test'; exit();
        // route ajax api
        $this->base_action_ajax();
    }

    public function sessionDestruct() {
        // session destroy
        $this->sessionPushLogout('admininistrator');
    }
    
    public function test(){
        
        echo 'test';
        
        return 'boom';
    }

    

}