<?php

/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Sass Compiler 
 *
 * @author LBS eBusiness
 * @version 1.2
 */
class Sass {

    const SUCCESS_RESPONSE = 1;
    const FAILED_RESPONSE = 0;

    public function run($scss_folder = null, $css_folder = null, $format_style = "scss_formatter") {

        $oOutput = '';
        if (is_null($scss_folder) !== false || is_null($css_folder) !== false) {
            return array(
                'flag' => self::FAILED_RESPONSE
            );
        }

        // load third party  library 
        /*_getThirdPartyLibrary('Scssc');

        // scssc will be loaded automatically via Composer
        $scss_compiler = new Scssc();
        // set the path where your _mixins are
        $scss_compiler->setImportPaths($scss_folder);
        // set css formatting (normal, nested or minimized), @see http://leafo.net/scssphp/docs/#output_formatting
        $scss_compiler->setFormatter($format_style);
        // get all .scss files from scss folder
        $filelist = glob($scss_folder . "*.scss");

        // step through all .scss files in that folder
        foreach ($filelist as $file_path) {
            // get path elements from that file
            $file_path_elements = pathinfo($file_path);
            // get file's name without extension
            $file_name = $file_path_elements['filename'];
            // get .scss's content, put it into $string_sass
            $string_sass = file_get_contents($scss_folder . $file_name . ".scss");
            // compile this SASS code to CSS
            $string_css = $scss_compiler->compile($string_sass);

            // validate if css directory is writtable
            if (is_writable($css_folder) === false) {
                die(" Directory permission denied. ");
            }

            // write CSS into file with the same filename, but .css extension
            $oOutput = file_put_contents($css_folder . $file_name . ".css", $string_css);
        }

        return array(
            'flag' => self::SUCCESS_RESPONSE,
            'output' => $oOutput
        );*/
    }

}
