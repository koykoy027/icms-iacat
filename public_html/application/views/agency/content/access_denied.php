<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Access Denied</title>
        <link rel="stylesheet" href="<?= MAIN_SITE_URL ?>assets/global/template/bootstrap/css/bootstrap.min.css" >
        <link rel="stylesheet" href="<?= MAIN_SITE_URL ?>assets/library/fonts/fontawesome/css/fontawesome.min.css" >
        <link rel="stylesheet" href="<?= MAIN_SITE_URL ?>assets/library/fonts/fontawesome/css/fontawesome.css" >
        <link rel="stylesheet" href="<?= SITE_ASSETS ?>library/fonts/fontawesome/css/all.css">
        <link rel="stylesheet" href="<?= MAIN_SITE_URL ?>assets/modules/administrator/css/access_denied.css" >
    </head>
    <body class="overflow-hidden access-wrapper">
        <div class="card access-container">
            <div class="row">
                <div class="col-md-5 col-sm-12 col-lg-5">
                    <div class="d-flex justify-content-end">
                        <p class="four-o-one">  OOPS!!! </p>
                    </div>
                </div>
                <div class="col-md-7 col-sm-12 col-lg-7">
                    <div class="card card-four-o-one d-block ml-5">
                        <div class="d-flex justify-content-start">
                            <img class="iacat-logo" src="assets/modules/administrator/img/iacat_logo.png">
                        </div>
                        <div class="d-flex justify-content-center px-3 pb-4">
                            <img src="assets/modules/administrator/img/access.jpg" class="img-access">
                        </div>
                        <div class="wrapper-content d-flex justify-content-center mt-1">
                            <p class="access-title text-center">Sorry, you don't have access to this page.</p>
                        </div>
                        <div class="px-5 py-0" style="display: none;">
                            <p class="d-flex justify-content-center align-items-center access__p text-align_center">The page or resource you were trying to to reach is absolutely forbidden for some reason</p>
                        </div>
                        <a href="javascript:history.back()" >
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-block btn-go_back mt-2"><i class="fas fa-arrow-left"></i> Go Back</button>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <footer>
        <script src="<?= SITE_ASSETS ?>global/template/bootstrap/js/bootstrap.min.js"></script>
    </footer>
</html>