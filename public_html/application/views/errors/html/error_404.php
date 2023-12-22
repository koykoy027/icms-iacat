<?php
/**
 * Page Security
 */
//echo $this->yel->encrypt("a");
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
    <style>
        .no-access-img {
            width: 300px;
        }
        .no-access-container {
            margin-top:150px;
        }
        .fs-65 {
            font-size: 65px;
        }
        .btn-go_back {
            background-color: #2c5596;
            color: #fff;
        }

        .btn-go_back:hover {
            background-color: #2c5596;
            color: #fff;
        }

    </style>

    <head>
        <title>Access Denied</title>
        <link rel="stylesheet" href="<?= MAIN_SITE_URL ?>assets/global/template/bootstrap/css/bootstrap.min.css" >
        <link rel="stylesheet" href="<?= MAIN_SITE_URL ?>assets/library/fonts/fontawesome/css/fontawesome.min.css" >
        <link rel="stylesheet" href="<?= MAIN_SITE_URL ?>assets/library/fonts/fontawesome/css/fontawesome.css" >
        <link rel="stylesheet" href="<?= SITE_ASSETS ?>library/fonts/fontawesome/css/all.css">
    </head>
    <style>

    </style>
    <body class="overflow-hidden">
        <div class="container">
            <div class="row py-5">
                <div class="col-md-12 col-sm-12 col-lg-12">
                    <div class="no-access-container ">
                        <div class="d-block text-center">
                            <img src="<?= SITE_ASSETS ?>modules/administrator/img/no_access.png" class="no-access-img d-flex m-auto">
                            <h1>Integrated Case Management System</h1>
                            <div class="fs-65 d-flex justify-content-center mb-0 font-italic" style="font-size: 29px;">
                                Oops, <div class="text-lowercase"><?php echo $message; ?></div>
                            </div>
                            <!--<p>The page or resource you are trying to access is absolutely forbidden for some reason</p>-->
                            <a href="javascript:history.back()"><button type="button" class="btn btn-go_back mt-2" style="background-color:  #2c5596; color: #fff;"><i class="fas fa-arrow-left"></i> Go Back</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <footer>
        <script src="<?= SITE_ASSETS ?>global/template/bootstrap/js/bootstrap.min.js"></script>
    </footer>
</html>