<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Ajax Failed To Request
 * @return int
 */
function system_ajaxFailedRequest() {
    $aMessage = array(
        'flag' => 0,
        'message' => 'Ajax Failed Request. Some part of parameters are missing.'
    );

    return $aMessage;
}

/**
 * Ajax Missing Method
 *
 * @return int
 */
function system_ajaxMissingMethod() {
    $aMessage = array(
        'flag' => 0,
        'message' => 'Ajax Failed Request. Method not found. '
    );

    return $aMessage;
}

/**
 * For Test
 * @return type
 */
function system_getData() {

    return array('panel' => 'test');
}

/**
 * Message for Ajax Production Mode
 *
 * @return string
 */
function system_ajaxProductionMode() {
    $aMessage = array(
        'flag' => 0,
        'message' => 'Request not allowed. Production Mode '
    );

    return $aMessage;
}

/**
 * System Libraries
 *
 * @param array $aLibraries
 * @return mixed
 */
function system_libraries($aLibraries) {


    // set as array on fire
    $aResponse = [];

    // initialization
    $aResponse['flag'] = false;

    // load library
    $CI = & get_instance();
    $CI->load->library('yel');

    // clean
    $aResponse['libraries'] = [];
    if (is_array($aLibraries) !== false) {
        $aResponse['libraries'] = $CI->yel->clean_array_walk_recursive($aLibraries);
    }

    $aResponse['flag'] = true;
    return $aResponse;
}

/**
 * Generate Session Code
 * @return mixed
 */
function generateSessionCode() {
    return md5(uniqid());
}

/**
 * Generate Captcha
 *
 * @return array Captcha
 */
function generate_captcha() {

    $CI = get_instance();
    $CI->load->helper('captcha');
    $vals = array(
        'word' => '',
        'img_path' => BASE_MODULES . 'captcha/',
        'img_url' => SITE_MODULES . 'captcha/',
        'font_path' => BASE_MODULES . 'captcha/images/texb.ttf',
        'img_width' => 200,
        'img_height' => 50,
        'expiration' => 180,
        'word_length' => 5,
        'font_size' => 25,
        'img_id' => 'Imageid',
        'pool' => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
        // White background and border, black text and red grid
        'colors' => array(
            'background' => array(255, 255, 255),
            'border' => array(255, 255, 255),
            'text' => array(0, 0, 0),
            'grid' => array(255, 255, 40)
        )
    );

    if (file_exists(BASE_MODULES . 'captcha/' . $CI->session->userdata('captchaTime') . '.jpg')) {
        $files = glob(BASE_MODULES . 'captcha/');
        foreach ($files as $file) { // iterate files
            if (is_file($file))
                unlink($file); // delete file
        }
    }

    $cap = create_captcha($vals);
    $CI->session->set_userdata('captchaTime', $cap['time']);
    $CI->session->set_userdata('captchaWord', $cap['word']);

    return $cap['image'];
}

function check_captcha($str) {
    $CI = get_instance();
    $word = $CI->session->userdata('captchaWord');
    if (strcmp(strtoupper($str), strtoupper($word)) == 0) {
        return true;
    } else {
//        $CI->form_validation->set_message('check_captcha', 'Please enter correct words!');
        return false;
    }
}

/**
 * Date format :: "Y/m/d"
 *
 * @param object $oDate
 * @return object $oDate
 */
function formatDate($oDate) {
    $oDate = date_format(date_create($oDate), "Y-m-d");
    return $oDate;
}

/**
 * Random String
 *
 * @return string random string
 */
function randomString() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 4; $i++) {
        $randstring .= $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}

/**
 * Build page url
 *
 * @param string $sLink
 * @param string $sParam
 * @return return mixed
 */
function __buildLink($sLink, $sParam = null) {

    $sURL = SITE_URL . $sLink;
    $sParameters = "";
    if (filter_var($sURL, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)) {

        if (is_null($sParam) !== true) {
            $sParameters = $sParam;
        }

        return $sURL . $sParameters;
    } else {
        return SITE_URL;
    }
}

/**
 * Inject System footer
 * Load footer for all panel
 */
function __injectSystemFooter() {

    if (file_exists(BASE_GLOBAL_VIEW . 'asset_loader.php') !== false) {
        require_once(BASE_GLOBAL_VIEW . 'asset_loader.php');
    } else {
        die("Library Asset loader is not active");
    }
}

/**
 * Load Sub Page
 */
function __loadPage($mFileName) {
    $CI = get_instance();
    // formulate file name
    $mCompleteFileName = BASE_VIEW . $CI->session->userdata('panel') . DS . 'content' . DS . $mFileName . '.php';
    if (strpos($mFileName, '.php') !== false) {
        $mCompleteFileName = BASE_VIEW . $CI->session->userdata('panel') . DS . 'content' . DS . $mFileName;
    }

    // check if file exist
    if (file_exists($mCompleteFileName) !== false) {
        require($mCompleteFileName);
    } else {
        echo("File not found");
    }
}

/**
 *  Force Page 404
 *
 * @param string $sMessage
 */
function __page404($sMessage = '', $sURL = "window.location.origin") {
    echo "<script type='text/javascript'>alert('" . $sMessage . "'); location.assign(" . $sURL . ");</script>";
    exit($sMessage);
}

/**
 * Active Navbar
 *
 * @param array|mixed $aNav
 * @return string as class
 */
function __activeNav($aNav) {

    $CI = get_instance();
    $sMenu = $CI->session->userdata('menu');

    if (is_array($aNav) !== false) {

        if (in_array($sMenu, $aNav) !== false) {
            return ' active ';
        } else {
            return '  ';
        }
    } else {
        if ($sMenu == $aNav) {
            return ' active ';
        } else {
            return '  ';
        }
    }
}
