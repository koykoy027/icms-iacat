<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2018, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package CodeIgniter
 * @author  EllisLab Dev Team
 * @copyright   Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright   Copyright (c) 2014 - 2018, British Columbia Institute of Technology (http://bcit.ca/)
 * @license http://opensource.org/licenses/MIT  MIT License
 * @link    https://codeigniter.com
 * @since   Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    Libraries
 * @author      EllisLab Dev Team
 * @link        https://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

    /**
     * Reference to the CI singleton
     *
     * @var object
     */
    private static $instance;
    // panel
    public $sPanel;

    //  status
    const ACTIVE_STATUS = true;
    const INACTIVE_STATUS = false;

    /**
     * Class constructor
     *
     * @return  void
     */
    public function __construct() {

        // time zone
        date_default_timezone_set("Asia/Manila");


        self::$instance = & $this;

        // Assign all the class objects that were instantiated by the
        // bootstrap file (CodeIgniter.php) to local class variables
        // so that CI can run as one big super object.
        foreach (is_loaded() as $var => $class) {
            $this->$var = & load_class($class);
        }

        $this->load = & load_class('Loader', 'core');
        $this->load->initialize();
        log_message('info', 'Controller Class Initialized');


        /**
         * COMPANY LINK CONTROL
         */
        // determine panel :: default load
        $this->sPanel = DEFAULT_ROUTE;

        // initial
        $sSubPanel = DEFAULT_ROUTE;

        // whenever the user access the site using sub domain
        if (!empty($this->config->config['is_sub_domain']) !== false) {

            $sSubDomain = $this->yel->clean(explode('.', $_SERVER['SERVER_NAME'])[0]);

            if (in_array($sSubDomain, $this->config->config['valid_sub_domain']) !== false) {

                $sSubPanel = $this->config->config['active_sub_domain'];

                $this->sPanel = strtolower($sSubPanel);
            } else {

                $aRegisteredLinks = $this->validateSubDomain($sSubDomain);

                // if company has web template and it's ID
                if (!empty($aRegisteredLinks['company_web_id']) !== false) {

                    if ($aRegisteredLinks['company_web_status'] == self::ACTIVE_STATUS) {

                        // set controller
                        $this->sPanel = COMPANY_ROUTE;

                        // set active dns sub domain
                        $this->config->set_item('cp_active_dns', $sSubDomain);

                        // get web configuration
                        $this->config->set_item('cp_active_config', $aRegisteredLinks);

                        // save to session too
                        $this->session->set_userdata('cp_active_dns', $sSubDomain);
                        $this->session->set_userdata('cp_active_config', $aRegisteredLinks);
                    } else {
                        die(" This link is inactive.  ");
                    }
                } else {

                    // mailer
                    $aMailer = array('news', 'mail');
                    if (in_array($sSubDomain, $aMailer) !== false) {
                        @header('Location: ' . SITE_SCHEME . DOMAIN_NAME);
                    } else {
                        die(" This link is not available. ");
                    }
                }
            }
        } else {

            // if the user used non sub domain
            if (!empty($_SERVER['PATH_INFO']) === true) {
                $this->sPanel = strtolower(explode(DS, $_SERVER['PATH_INFO'])[1]);
            }
        }

        // serve to session
        $this->session->set_userdata('panel', $this->sPanel);
    }

    /**
     * Validate Sub Domain
     *
     * @param string $sSubDomain
     * @return array
     */
    private function validateSubDomain($sSubDomain) {
        return $this->yel->GetRow(" SELECT * FROM `mis_company_web` WHERE `company_web_url` = '" . $sSubDomain . "'  LIMIT 1");
    }

    // --------------------------------------------------------------------

    /**
     * Get the CI singleton
     *
     * @static
     * @return  object
     */
    public static function &get_instance() {
        return self::$instance;
    }

    /**
     * Determine if User access it as thru ajax request
     *
     * @return bollean
     */
    public function isXmlHttpRequest() {
        $header = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? $_SERVER['HTTP_X_REQUESTED_WITH'] : null;
        return ($header === 'XMLHttpRequest');
    }

    /**
     * Validate Entity Request
     *
     * @param array $aParam
     */
    private function validateEntityRequest() {

        if (in_array($_SERVER['REMOTE_ADDR'], $this->config->config['cron_trusted_ips']) === false) {
            header('HTTP/1.0 403 Forbidden');
            die('You ' . $_SERVER['REMOTE_ADDR'] . ' are not authorized to access this server');
            exit;
        }
    }

    /**
     * Validate XML HTTP checker
     * - ajax request security
     *
     * @param array $aParam
     */
    private function validateEnvironment($aParam, $bIsXmlHttpRequest = self::ACTIVE_STATUS, $bIsExcludeDigest = self::ACTIVE_STATUS) {


        if (!empty($aParam['environment']) !== false) {



            // check ENVIRONMENT
            if (ENVIRONMENT == 'production') {
                header('HTTP/1.0 403 Forbidden');
                die("Production mode");
                exit;
            }

            // check AJAX_DEBUGGER
            if (strtolower($aParam['environment']) != AJAX_DEBUGGER) {
                header('HTTP/1.0 403 Forbidden');
                die('YEL');
                exit;
            }

        } else {

            // if XMLHttpRequest | for ajax request
            if ($bIsXmlHttpRequest == self::ACTIVE_STATUS) {

                // you are not authorized | for AJAX
                if (!$this->isXmlHttpRequest()) {
                    header('HTTP/1.0 403 Forbidden');
                    die('You are not authorized to access this page.');
                    exit;
                }

                // digest param
                if ($bIsExcludeDigest == self::ACTIVE_STATUS) {
                    $this->digest_param($aParam);
                }
            } else {



                // die($_SERVER['HTTP_USER_AGENT']);
                // add new validation here .. maybe soon
                // for API | external request

                // // you are not authorized | for AJAX
                // if (!$this->isXmlHttpRequest()) {
                //     header('HTTP/1.0 403 Forbidden');
                //     die('You are not authorized to access this page.');
                //     exit;
                // }

                // digest param
                // if ($bIsExcludeDigest == self::ACTIVE_STATUS) {
                //     $this->digest_param($aParam);
                // }
            }
        }
    }

    /**
     * ConstructMethod Simulation
     *
     * @param array $aParam
     * @param array $aResponse
     * @return mixed $aResponse
     */
    private function constructMethod($aParam, $aResponse) {

        // build parameter
        if (empty($aParam['type']) === true) {
            $aResponse = system_ajaxFailedRequest();
        } else {

            // business logic & model
            $sMethod = $aParam['type'];
            if (method_exists($this, $sMethod) === true) {
                $aResponse = $this->$sMethod($aParam);
            } else {
                $aResponse = system_ajaxMissingMethod();
            }
        }

        // determine callback type
        $sCallBack = $this->callBack($aParam);
        if ($sCallBack === 'json') {
            $this->printJSON($aResponse, $aParam);
        } else {
            $this->printPHP($aResponse);
        }
    }

    /**
     * Digest Parameters
     *
     * @return mixed|boolean|int|array $aResponse
     */
    private function digest_param($aParam) {

        $aResponse = [];

        $sDigestParamForTest = $this->yel->clean($aParam['__seguridad']);

        unset($aParam['csrf']);
        unset($aParam['__seguridad']);

        ksort($aParam);

        //implode parameter and get only the key value
        $sDigestParameters = implode(',', array_map(
            function ($v, $k) {
                if (is_array($v) !== false) {
                    if (count($v) > 0) {
                        return json_encode($v);
                    } else {
                        return '[]';
                    }
                } else {
                    if ($v != '') {
                        return $v;
                    } else {
                        return '';
                    }
                }
            }, $aParam, array_keys($aParam)
        ));

        // encryption
        $sDigestParamImplode = str_replace('"', "", $sDigestParameters);
        // concat csrf and make it as a salt
        $sDigestParameters = SHA1($sDigestParamImplode);

        if (strcmp($sDigestParamForTest, $sDigestParameters) != 0) {
            header('HTTP/1.0 403 Forbidden');
            die('!');
            exit;
        }

        $aResponse['test'] = $sDigestParamForTest;
        $aResponse['string'] = $sDigestParamImplode;
        $aResponse['key'] = $sDigestParameters;

        return $aResponse;
    }

    /**
     * Ajax Route | For JO Drive
     * :: Action Controller
     *
     * @var array $aParam
     * @return mixed|boolean|int|array $aResponse
     */
    public function base_action_ajax_drive() {

        // initialize
        $aResponse = [];
        $aParam = [];

        // parameter
        $aParam = $this->parameters();

        // validate http access
        $this->validateEnvironment($aParam, self::ACTIVE_STATUS, self::INACTIVE_STATUS);

        // method constructor | response
        $this->constructMethod($aParam, $aResponse);
    }

    /**
     * Ajax Route
     * :: Action Controller
     *
     * @var array $aParam
     * @return mixed|boolean|int|array $aResponse
     */
    public function base_action_ajax() {

        // initialize
        $aResponse = [];
        $aParam = [];

        // parameter
        $aParam = $this->parameters();
        $aParam['environment'] = ENVIRONMENT;
        // validate http access
        $this->validateEnvironment($aParam);

        // method constructor | response
        $this->constructMethod($aParam, $aResponse);
    }

    /**
     * Cron Ajax Route
     * :: Action Controller
     *
     * @var array $aParam
     * @return mixed|boolean|int|array $aResponse
     */
    public function base_action_cron() {

        // initialize
        $aResponse = [];
        $aParam = [];

        // parameter
        $aParam = $this->parameters();

        // validate http access
        $this->validateEntityRequest();

        // method constructor | response
        $this->constructMethod($aParam, $aResponse);
    }

    /**
     * Ajax API Route
     * :: Action Controller
     *
     * @var array $aParam
     * @return mixed|boolean|int|array $aResponse
     */
    public function base_action_api() {


        // @note : you modify this line if restriction is required, hence,
        // allowing other client to request data from server side
        @header('Access-Control-Allow-Origin: *');

        // memory limit
        ini_set('memory_limit', '32M');

        // initialize
        $aResponse = [];
        $aParam = [];

        // parameter
        $method = $_SERVER['REQUEST_METHOD'];
        $aParam = $_REQUEST;
        
        $aParam['environment'] = ENVIRONMENT;

        // validate http access
        $this->validateEnvironment($aParam, self::INACTIVE_STATUS, self::INACTIVE_STATUS);


        //validate if parameters contains type parameter
        // build parameter
        if (empty($aParam['type']) === true) {
            $aResponse = array('xhr'=>array(
                'status_code' => 404,
                'message' => 'Method type not found.'
            ));
        } else { 

            //validate if the method exists
            $sMethod = $aParam['type'];
            if (method_exists($this, $sMethod) === true) {
                $aResponse = $this->$sMethod($aParam);
            } else {
                $aResponse = array('xhr'=>array(
                    'status_code' => 404,
                    'message' => 'Method type invalid.'
                ));
            }
        }

        // determine callback type
        $sCallBack = $this->callBack($aParam);
        if ($sCallBack === 'json') {
            $aRecordSet = [];
            $aRecordSet = $aResponse;
            // $aRecordSet['xhr']['transaction_id'] = $this->yel->transaction_key(uniqid());

        } else {
            $aRecordSet = [];
            $aRecordSet = $aResponse;
            // $aRecordSet['xhr']['transaction_id'] = $this->yel->transaction_key(uniqid());
        }

        //save token as reference id

        return $this->output
        ->set_content_type('application/json')
        ->set_status_header($aResponse['xhr']['status_code'])
        ->set_output(json_encode($aResponse));
    }

    /**
     * Ajax API Route | Non-CSRF
     * :: Action Controller
     *
     * @var array $aParam
     * @return mixed|boolean|int|array $aResponse
     */
    public function base_action_global_ajax() {

        // @note : you modify this line if restriction is required, hence,
        // allowing other client to request data from server side
        @header('Access-Control-Allow-Origin: *');

        // memory limit
        ini_set('memory_limit', '32M');

        // initialize
        $aResponse = [];
        $aParam = [];

        // parameter
        $aParam = $this->parameters();

        // build parameter
        if (empty($aParam['type']) === true) {
            $aResponse = system_ajaxFailedRequest();
        } else {

            // business logic & model
            $sMethod = $aParam['type'];
            if (method_exists($this, $sMethod) === true) {
                $aResponse = $this->$sMethod($aParam);
            } else {
                $aResponse = system_ajaxMissingMethod();
            }
        }

        // determine callback type
        $sCallBack = $this->callBack($aParam);

        $aRecordSet = [];
        if ($sCallBack === 'json') {

            $aRecordSet = $this->jsonEncodeArray($aResponse);

            echo json_encode($aRecordSet);
        } else {

            $aRecordSet = $this->jsonEncodeArray($aResponse);

            echo '<pre>';
            print_r($aRecordSet);
            echo '</pre>';
        }
    }

    /**
     * Ajax Route | DataTable
     * :: Action Controller
     *
     * @var array $aParam
     * @return mixed|boolean|int|array $aResponse
     */
    public function base_action_dt_ajax() {

        // initialize
        $aResponse = [];
        $aParam = [];

        // parameter
        $aParam = $this->parameters();

        // validate http access
        $this->isXmlHttpRequest();

        // build parameter
        if (empty($aParam['type']) === true) {
            $aResponse = system_ajaxFailedRequest();
        } else {

            // business logic & model
            $sMethod = $aParam['type'];
            if (method_exists($this, $sMethod) === true) {
                $aResponse = $this->$sMethod($aParam);
            } else {
                $aResponse = system_ajaxMissingMethod();
            }
        }

        // determine callback type
        $sCallBack = $this->callBack($aParam);
        if ($sCallBack === 'json') {
            $this->printDTJSON($aResponse);
        } else {
            $this->printDTPHP($aResponse);
        }
    }

    /**
     * Build Parameter
     * :: Determine server request method
     * :: weither post|get|request|cookie
     *
     * @var string REQUEST_METHOD
     * @return array $aParam
     */
    public function parameters() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $aParam = $_POST;
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $aParam = $_GET;
        } else {
            $aParam = $_REQUEST;
        }

        return $aParam;
    }

    /**
     * Display parameter
     * either php or json
     *
     * @return array|mixed $aResponse
     */
    public function callBack($aParam = null) {
        // initialize
        $sResponseType = 'json';

        // determine callback type
        if (empty($aParam['callback']) === true) {
            $sResponseType = 'json';
        } else {
            $sResponseType = strtolower($aParam['callback']);
        }

        return $sResponseType;
    }

    /**
     * Convert all charset to utf8
     * jsonEncodeArray
     *
     * @param array $array
     * @return array $array
     */
    public function jsonEncodeArray($array) {

        if (!empty($array) !== false) {

            if (is_array($array) !== false) {
                array_walk_recursive($array, function(&$item) {
                    $item = utf8_encode($item);
                });
            }
            return $array;
        } else {

            return array(
                'message' => 'return value is empty',
                'status' => 'error');
        }
    }

    /**
     * Print recordset as PHP Array
     * :: used for debuggin'
     *
     * @param $aResponse
     * @return array $aResponse
     */
    public function printPHP($aResponse = null) {
        $aRecordSet = [];
        $aRecordSet['data'] = $this->jsonEncodeArray($aResponse);
        $aRecordSet['_xhr'] = array(
            '_csrf' => $this->security->get_csrf_hash(),
            '_transaction' => $this->yel->transaction_key(uniqid())
        );
        echo '<pre>';
        print_r($aRecordSet);
        echo '</pre>';
    }

    /**
     * Print recordset as PHP Array | DataTable
     * :: used for debuggin'
     *
     * @param $aResponse
     * @return array $aResponse
     */
    public function printDTPHP($aResponse = null) {
        $aRecordSet = [];
        $aRecordSet = $this->jsonEncodeArray($aResponse);
        $aRecordSet['_xhr'] = array(
            '_csrf' => $this->security->get_csrf_hash(),
            '_transaction' => $this->yel->transaction_key(uniqid())
        );
        echo '<pre>';
        print_r($aRecordSet);
        echo '</pre>';
    }

    /**
     * Print recordset as JSON
     * :: for Ajax Response
     *
     * @param $aResponse
     * @return mixed $aResponse
     */
    public function printJSON($aResponse = null, $aParam = null) {
        $aRecordSet = [];
        $aRecordSet['data'] = $this->jsonEncodeArray($aResponse);
        $aRecordSet['_xhr'] = array(
            '_csrf' => $this->security->get_csrf_hash(),
            '_transaction' => $this->yel->transaction_key(uniqid())
        );

        // for development purposes : testing
        // $aRecordSet['_digest'] = $this->digest_param($aParam);

        echo json_encode($aRecordSet);
    }

    /**
     * Print recordset as JSON | DataTable
     * :: for Ajax Response
     *
     * @param $aResponse
     * @return mixed $aResponse
     */
    public function printDTJSON($aResponse = null) {
        $aRecordSet = [];
        $aRecordSet = $this->jsonEncodeArray($aResponse);
        $aRecordSet['_xhr'] = array(
            '_csrf' => $this->security->get_csrf_hash(),
            '_transaction' => $this->yel->transaction_key(uniqid())
        );

        echo json_encode($aRecordSet);
    }

    /**
     * Error Handler
     *
     * @param boollean $bError
     */
    private function errorHandler($bError = false) {
        error_reporting($bError);
    }

    /**
     * Force Logout for inactive user
     * Hence, session should be created thru login segment
     *
     * @param string $sChannel
     */
    public function sessionPushLogout($sChannel) {

        // session destroy
        $this->session->sess_destroy();

        // clear all cached
        clearstatcache();

        // redirect to login page
        redirect(SITE_URL . 'login');
    }

    /**
     *  Session Handler for Active user
     *
     * @param boolean $bActiveSession
     */
    private function sessionHandler($bActiveSession) {


        if ($bActiveSession === self::ACTIVE_STATUS) {

            $sChannel = strtolower($this->session->userdata('channel'));
            $sCombineSession = $sChannel . '_is_logged_in';
            if (!empty($this->session->userdata($sCombineSession)) === true) {

                if ($this->session->userdata($sCombineSession) === self::ACTIVE_STATUS) {

                    if (strtolower($this->router->fetch_class()) === strtolower($this->session->userdata('channel'))) {

                        // session control was successfully established for this page
                    } else {

                        // force logout since session was inactive ::directing to other level
                        $this->sessionPushLogout($this->session->userdata('channel'));
                    }
                } else {

                    // force logout since session was inactive
                    $this->sessionPushLogout($this->sPanel);
                }
            } else {
                // page should state to unrestricted page such as login ,register and etc.
                $this->sessionPushLogout($this->sPanel);
            }
        } else {
            // session destroy :: clear session before login process
            // $this->session->sess_destroy();
        }
    }

    /**
     * Session Menu
     *
     * @param string $sMenu
     */
    private function sessionMenu($sMenu) {
        $this->session->unset_userdata('menu');
        $this->session->set_userdata('menu', $sMenu);
    }

    /**
     * sass builder | Auto generate during development mode
     */
    public function sass2cssBuilder() {

        if (ENVIRONMENT == "development") {
            $sSCSS = BASE_MODULES . $this->sPanel . DS . 'scss' . DS;
            $sCSS = BASE_MODULES . $this->sPanel . DS . 'css' . DS;

            $this->sass->run($sSCSS . DS, $sCSS);

            if (is_dir($sSCSS) !== false && is_dir($sCSS) !== false) {

                // run compiler
                $this->sass->run($sSCSS . DS, $sCSS);
            } else {
                //die("SASS and CSS might not active or out of permission. ");
            }
        }
    }

    /**
     * Render Page Template
     * Syntax : session - header - sidebar - content - footer
     *
     *
     * @param string $sPageName
     * @param array $aRecordSet

     * @param string $sModifiedContent
     * @param boolean $bRenderHeader
     * @param boolean $bRenderFooter
     * @param boolean $bRenderSideBar
     * @param boolean $bActiveSession
     * @param boolean $bIncludeGlobalView
     *
     * @param array $aLibrary | Include JS/CSS Library
     * @param array $aSEO | Search Engine Optimization
     *
     */
    public function setTemplate($sPageName, $aRecordSet = [], $sModifiedContent = '', $bRenderHeader = true, $bRenderFooter = true, $bRenderSidebar = true, $bActiveSession = true, $bIncludeGlobalView = true, $aLibraries = [], $aSEO = []) {

        // Session Verification
        $this->sessionHandler($bActiveSession);

        $sPageIndex = $sPageName;
        if (strpos($sPageName, DS) !== false) {
            $oPage = explode(DS, $sPageName);
            $sPageIndex = end($oPage);
        }


        // Menu
        $this->sessionMenu($sPageIndex);

        // initialization
        $aHeaderAttribute = [];

        // sass builder | Auto generate during development mode
        $this->sass2cssBuilder();

        // template configuration
        $aPageStructure = array(
            'header' => $bRenderHeader,
            'footer' => $bRenderFooter,
            'sidebar' => $bRenderSidebar,
            'session' => $bActiveSession
        );
        $this->config->set_item('page_structure', $aPageStructure);

        // Global Header & Sidebar
        if ($bRenderHeader === true) {

            // view :: header
            if (file_exists(BASE_VIEW . $this->sPanel . DS . 'default' . DS . 'header.php') === true) {

                // build seo
                $aHeaderAttribute = array_merge(_buildSEO($aSEO), system_libraries($aLibraries));

                // header
                $this->load->view($this->sPanel . DS . 'default' . DS . 'header.php', $aHeaderAttribute);
            } else {
                die('Failed to load page header');
            }
        }

        // Page Side Bar
        if ($bRenderSidebar === true) {
            // view :: sidebar
            if (file_exists(BASE_VIEW . $this->sPanel . DS . 'default' . DS . 'sidebar.php') === true) {
                $this->load->view($this->sPanel . DS . 'default' . DS . 'sidebar.php');
            } else {
                die('Failed to load page sidebar');
            }
        }

        // Page Content
        if (isset($sPageName) === true) {

            if (!empty($sModifiedContent) === true) {
                $sContent = $sModifiedContent;
            } else {
                $sContent = $sPageName;
            }

            // view :: content
            if (file_exists(BASE_VIEW . $this->sPanel . DS . 'content' . DS . $sContent . '.php') === true) {

                if (!empty($aRecordSet) !== false) {
                    $aRecordSet = array_merge($aRecordSet, system_libraries($aLibraries), _buildSEO($aSEO));
                } else {
                    $aRecordSet = array_merge(system_libraries($aLibraries), _buildSEO($aSEO));
                }

                $this->load->view($this->sPanel . DS . 'content' . DS . $sContent . '.php', $aRecordSet);
                if ($bIncludeGlobalView === true) {
                    $this->load->view('global' . DS . 'system');
                }
            } else {
                die('Failed to load page content');
            }
        } else {
            die('Something went wrong.');
        }

        // Global Footer
        if ($bRenderFooter === true) {

            // view :: footer
            if (file_exists(BASE_VIEW . $this->sPanel . DS . 'default' . DS . 'footer.php') === true) {
                $this->load->view($this->sPanel . DS . 'default' . DS . 'footer.php', system_libraries($aLibraries));
            } else {
                die('Failed to load page footer');
            }
        }
    }

    /**
     * Session Handler for User
     *
     * @param string $sUserPanel
     * @param string $sUserId
     * @param string $sUserControlId
     */
    public function sessionActiveUser($sUserPanel = null, $sUserId = null, $sUserControlId = null) {
        $this->session->set_userdata('channel', $sUserPanel);
        $this->session->set_userdata('id', $sUserId);
        $this->session->set_userdata($sUserPanel . '_is_logged_in', self::ACTIVE_STATUS);
        $this->session->set_userdata('is_active', self::ACTIVE_STATUS);
        $this->session->set_userdata('control_id', $sUserControlId);
    }

}
