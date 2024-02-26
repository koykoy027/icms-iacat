<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<head>
    <link rel="stylesheet" href="<?= MAIN_SITE_URL ?>assets/global/template/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= MAIN_SITE_URL ?>assets/library/fonts/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="<?= MAIN_SITE_URL ?>assets/library/fonts/fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="<?= SITE_ASSETS ?>library/fonts/fontawesome/css/all.css">
    <link rel="stylesheet" href="<?= MAIN_SITE_URL ?>assets/modules/icms/css/landing_page.css">
</head>

<body>
    <img src="assets/global/images/public_bg.jpg" alt="Girl in a jacket" width="100%" height="100%" class="bg-landing">

    <div class="masthead">
        <div class="masthead-content- masthead_inner text-white">
            <div class="card card-icms p-5 shadow-lg">
                <div class="container-fluid p-4 px-lg-0">
                    <img src="<?php echo SITE_ASSETS ?>global/images/iacat_logo.png" class="brand_logo" alt="Logo">
                    <p class="sub-heading text-center text-dark">Welcome to <br><span class="icms_txt"> INTEGRATED
                            CASE
                            MANAGEMENT
                            SYSTEM
                        </span> </p>
                    <!-- <p class="mb-5 sub-heading text-dark">We're working hard to finish the development of this site.
                        Sign up below to receive updates and to be notified when we launch!</p> -->
                    <form id="search_form">
                        <!-- <div class="form-group has-search">
						<span class="fa fa-search form-control-feedback"></span>
						<input type="text" class="form-control" placeholder="Search">
					</div> -->
                        <div class="row input-group-newsletter">
                            <div class="col-sm-9 col-md-9 col-lg-9">
                                <input type="text" class="form-control cn-text" name="search_text" placeholder="Search Here">
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <button class="btn btn-search" type="submit">Search</button>
                            </div>
                        </div>
                        <br>
                        <a href="/file_complaint" class="d-flex justify-content-end">
                            <small class="text-dark">Are you filling a complaint?</small></a>
                    </form>
                </div>
            </div>

        </div>
    </div>

</body>

</html>