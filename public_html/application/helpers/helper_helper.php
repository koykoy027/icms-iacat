<?php

/**
 *  Email Helper 
 * 
 * - GLOBAL Email Library 
 * - EMAIL TEMPLATE
 * 
 * @author Ebusiness Developers
 * @since 2016
 */
defined('BASEPATH') OR exit('No direct script access allowed');

const FAILED_RESPONSE=0;
const SUCCESS_RESPONSE=1;

function is_exist($param) {
    $rs = FAILED_RESPONSE;
    if ((isset($param) !== false) and ( $param !== "") and ( empty($param) == false) and ( $param !== "NULL")) {
        $rs = SUCCESS_RESPONSE;
    }
    return $rs;
}

function convert_date_format($param, $format, $column_index = "") {


    $rs = [];
    try {

            // string 
        if (is_string($param)) {
            if (is_exist($param)) {
                $param = date($format, strtotime($param));
                $rs = $param;
            }
        }

            // array row 
        if (is_array($param)) {

                // Single 
            if (count($param) == count($param, COUNT_RECURSIVE)) {

                    // single index 
                if (is_string($column_index)) {
                    if (is_exist($param[$column_index])) {
                        $param[$column_index] = date($format, strtotime($param[$column_index]));

                    }
                }
                    // multiple index 
                if (is_array($column_index)) {
                    foreach ($column_index as $index) {
                        if (is_exist($param[$index])) {
                            $param[$index] = date($format, strtotime($param[$index]));
                        }
                    }
                }
            }
                // Multidimensional
            else {
                    // single index 
                if (is_string($column_index)) {
                    foreach ($param as $key => $val) {
                        if (is_exist($val[$column_index])) {
                            $param[$key][$column_index]  = date($format, strtotime($val[$column_index]));
                        }
                    }
                }

                    // multiple index 
                if (is_array($column_index)) {
                    foreach ($param as $key => $val) {
                        foreach ($column_index as $index) {
                            if (is_exist($val[$index])) {
                             $param[$key][$index]  = date($format, strtotime($val[$index]));
                         }
                     }
                 }
             }
         }
     }
     $rs = $param;
 } catch (\Exception $e) {
    $rs = 'invalid date format';
}

return $rs;
}

/**
 * Generate Unique Temporary File
 *
 * @param $extension name
 *
 * @return string
 */
function generateTempFile($ext) {

    $isAllowed = _allowedExtensionFileName($ext);
    if ($isAllowed === true) {
        $file_name = uniqid() . '.' . $ext;
    }

    return $file_name;
}

/**
 * check allowed filename extension
 *
 * @param $extension
 * @return boolean
 */
function _allowedExtensionFileName($ext) {
    $allowed_ext = array('pdf', 'docx', 'html', 'odt');

    if (in_array($ext, $allowed_ext)) {
        return true;
    } else {
        return false;
    }
}


