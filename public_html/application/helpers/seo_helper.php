<?php

/**
 * Page Security 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

function _buildSEO($aSEO) {

    // set as array on fire
    $aResponse = [];

    // initialization
    $aSEO_refine = [];
    $aResponse['flag'] = false;

    // initial value
    $sPageTitle = SEO_TITLE;
    $sPageDescription = SEO_DESCRIPTION;
    $sPageKeyword = SEO_KEYWORD;
    $sPageAuthor = SEO_AUTHOR;
    $sPageRefresh = SEO_REFRESH;

    // load library
    $CI = & get_instance();
    $CI->load->library('yel');

    if (is_array($aSEO) !== false) {

        // sanitize
        $aSEO = $CI->yel->clean_array($aSEO);
        
    }

        // title
        if (!empty($aSEO['page_title']) !== false) {
            $sPageTitle = $aSEO['page_title'];
        }

        // description
        if (!empty($aSEO['page_description']) !== false) {
            $sPageDescription = $aSEO['page_description'];
        }

        // keyword
        if (!empty($aSEO['page_keyword']) !== false) {
            $sPageKeyword = $aSEO['page_keyword'];
        }

        // author
        if (!empty($aSEO['page_author']) !== false) {
            $sPageAuthor = $aSEO['page_author'];
        }

        // setting up
        $aSEO_refine = array(
            'page_title' => $sPageTitle,
            'page_description' => $sPageDescription,
            'page_keyword' => $sPageKeyword,
            'page_author' => $sPageAuthor,
            'page_refresh' => $sPageRefresh
        );

        $aResponse['seo'] = $aSEO_refine;
        $aResponse['flag'] = true;
    

    return $aResponse;
}

function _getSEO() {
    
}

function _destroySEO() {
    
}
