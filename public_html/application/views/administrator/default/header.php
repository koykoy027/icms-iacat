<?php
/**
 * Page Security
 */
defined('BASEPATH') or exit('No direct script access allowed');
$method = $this->router->fetch_method();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?=$seo['page_title']?></title>
    <meta charset="utf-8">
    <meta name="description" content="<?=$seo['page_description']?>">
    <meta name="keywords" content="<?=$seo['page_keyword']?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="<?=$seo['page_author']?>">
    <meta http-equiv="refresh" content="<?=$seo['page_refresh']?>">
    <meta name="csrf-param" content="_csrf_protection">
    <meta name="csrf-token" content="<?=$this->security->get_csrf_hash()?>">
    <meta name="csrf-author" content="<?=$this->security->get_csrf_token_name()?>">

    <!-- CSS Library -->
    <link rel="stylesheet" href="<?= SITE_ASSETS ?>global/template/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= SITE_ASSETS ?>modules/administrator/css/global.css" type="text/css">
    <link rel="stylesheet" href="<?= SITE_ASSETS ?>library/plugin/Bs-stepper/css/bs-stepper.css" type="text/css">
    <link rel="stylesheet" href="<?= SITE_ASSETS ?>library/plugin/Bs-stepper/css/bs-stepper.min.css" type="text/css">
    <link rel="stylesheet" href="<?= SITE_ASSETS ?>library/plugin/bootstrap-select/dist/css/bootstrap-select.min.css"
        type="text/css">
    <link rel="stylesheet" href="<?= SITE_ASSETS ?>library/plugin/icheck/skins/square/orange.css" type="text/css">

    <!--font awesome-->
    <link rel="stylesheet" href="<?= SITE_ASSETS ?>library/fonts/fontawesome/css/all.css">


    <!--CSS font-->
    <script>
    function ifBrokenLogo(image) {
        image.onerror = "";
        image.src = "<?=SITE_ASSETS?>global/images/logo-default.png";
        return true;
    }

    function ifBrokenProfile(image) {
        image.onerror = "";
        image.src = "<?=SITE_ASSETS?>global/images/user-default-gray.png";
        return true;
    }
    </script>

    <?php
$dir_asset = [];
$dir_asset['panel'] = trim($this->session->userdata('panel'));

$dir_asset['page'] = trim($this->session->userdata('menu'));
$dir_asset['css'] = BASE_MODULES . $dir_asset['panel'] . DS . 'css' . DS;
$dir_asset['addCSS'] = BASE_EXT_LIBRARY . 'css' . DS;
_assetHeaderLibrary($libraries, $dir_asset);
?>
</head>

<!-- Body BEGIN -->

<body class="corporate" id="body">
    <!-- BEGIN TOP BAR -->

    <header class="icms-header-content">
        <div class="row bg-white">
            <div class="col-lg-6 col-md-6 col-sm-9 col-xs-12">
                <div class=" bg-white header-navigation ">
                    <div class="mr-auto p-2 bd-highlight ml-3"> <a class="site-logo pb-0">
                            <img src="<?php echo SITE_ASSETS ?>global/images/iacat_logo.png" height="75px" alt="">
                            <h4 class="header-title">INTEGRATED CASE MANAGEMENT SYSTEM</h4>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-3 col-xs-12">
                <div class="nav-header-items ">
                    <ul class="list-unstyled list-inline pre-header-user d-inline-flex hide" id="ul-header-user"
                        data-level="<?php echo $_SESSION['userData']['user_level_id'] ?>">
                        <li class="nav-item head-action-nav hide">
                            <a class='dropdown-button btn-flat navbarDropdown' id="search_dropdown" href="#"
                                role="button" aria-expanded="true" data-activates='dropdown1'>
                                <i class="fa fa-search pr-2 header-search-icon" aria-hidden="true"></i>
                            </a>
                            <div class="dropdown-menu list-notif shadow animate slideIn p-0" id="dropdown-search"
                                aria-labelledby="search_dropdown">
                                <div class="form-group p-4">
                                    <!--<small >Search Name / ID</small>-->
                                    <input type="email" class="form-control" id="keyword_search"
                                        aria-describedby="emailHelp" placeholder="keyword ...">
                                    <a id="trigger_advanced_search" class="form-text trigger_advanced_search"
                                        data-toggle="modal" data-target="#advance-search">Advance Search</a>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item notif-dropdown head-action-nav">
                            <a class='dropdown-button btn-flat navbarDropdown' id="navbarDropdown" href="#"
                                role="button" aria-expanded="true" data-activates='dropdown1'>
                                <i class="fa fa-bell pr-2" aria-hidden="true" id="notif-icon"></i>
                                <span class="badge notif-badge hide" id="notif-badge-count"> 0 </span>
                            </a>
                            <div class="dropdown-menu list-notif  animate slideIn shadow p-0"
                                aria-labelledby="navbarDropdown">
                                <h6 class="dropdown-header">
                                    Notifications
                                </h6>
                                <ul class="list-unstyled list-notif-ul" id="ul-notif-list">
                                    <li class="tagged-case">
                                        <div class="row">
                                            <div class="col-12 notif-content">
                                                <center>
                                                    <h4>Loading Content . . .</h4>
                                                </center>
                                            </div>

                                        </div>
                                    </li>
                                    <hr>
                                </ul>
                                <a class="dropdown-item text-center small text-gray-500"
                                    href="<?php echo SITE_URL ?>notification">See all notifications</a>
                            </div>

                        </li>
                        <li class="nav-item user-name head-action-nav">
                            <a class='dropdown-button btn-flat dropdown-toggle' id="navbarDropdown" href="#"
                                role="button" aria-expanded="true" data-activates='dropdown2'>
                                <img src="<?=MAIN_SITE_URL?>drive/file/<?=$_SESSION['userData']['profile_pic']?>"
                                    onerror="ifBrokenProfile(this);" class="user-profile-pic">
                            </a>

                            <div class="dropdown-menu notif-menu accnt-settings  animate slideIn shadow"
                                aria-labelledby="navbarDropdown">

                                <ul class="list-group">
                                    <li class="list-group-item list-wrapper border-0 pb-0">
                                        <span class="img_user-profile"> <img class="img-nav-pic"
                                                src="<?=MAIN_SITE_URL?>drive/file/<?=$_SESSION['userData']['profile_pic']?>"
                                                onerror="ifBrokenProfile(this);"> </span>
                                        <p class="info_user-profile"><?=$_SESSION['userData']['user_firstname']?>
                                            <?=$_SESSION['userData']['user_lastname']?><br><span
                                                class="text-muted"><?=$_SESSION['userData']['user_level']?></span></p>
                                    </li>
                                    <li class="list-group-item list-wrapper border-0 pt-0">
                                        <a class="dropdown-item menu-accnt <?php echo $method == " account_setting " ? "active " : " " ?>"
                                            data-toggle="pill12" href="<?php echo ADMIN_SITE_URL ?>account_setting" role="tab"
                                            aria-selected="false"><i class="fas fa-user-circle"></i>&nbsp;&nbsp;Account
                                            Setting</a>
                                    </li>
                                    <li class="list-group-item list-wrapper border-0 pt-0">
                                        <a class="dropdown-item menu-accnt <?php echo $method == " logout " ? "active " : " " ?>"
                                            data-toggle="pill13" href="<?php echo ADMIN_SITE_URL ?>logout" role="tab"
                                            aria-selected="false"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;Logout
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </li>
                        &nbsp;

                    </ul>
                </div>
            </div>
        </div>

        <div class="header ">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <a href="javascript:void(0);" class="mobi-toggler hide"><i class="fa fa-bars"></i></a>
                    <!-- BEGIN NAVIGATION -->

                    <div class="header-navigation " class="topnav" id="myTopnav">
                        <ul class="nav nav-pills nav-items-tab nav-menu-item d-flex justify-content-start nav-header-menu"
                            id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link <?php echo $method == "dashboard" ? "active" : "" ?>"
                                    data-toggle="pill1" href="<?php echo ADMIN_SITE_URL ?>dashboard" role="tab"
                                    aria-selected="true">Home</a>
                            </li>

                            <li class="nav-item dropdown agency-dropdown lvl-ce lvl-ch lvl-ca lvl-ra">
                                <a class=" nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="true" aria-expanded="false">Agencies</a>

                                <div class="dropdown-menu agency-menu menu-carret" aria-labelledby="navbarDropdown3">
                                    <div class="row">
                                        <div class="col-sm-4 col-md-4 col-lg-4 ">
                                            <div class="card-body">
                                                <p class="agency-title-menu">Agency Listing</p>
                                                <a class="dropdown-item <?php echo $method == "add_agency" ? "active" : "" ?>"
                                                    data-toggle="pill4" href="<?php echo ADMIN_SITE_URL ?>add_agency"
                                                    role="tab" aria-selected="false">&nbsp;&nbsp;Add Agency</a>
                                                <a class="dropdown-item <?php echo $method == "agencies" ? "active" : "" ?>"
                                                    data-toggle="pill3" href="<?php echo ADMIN_SITE_URL ?>agencies" role="tab"
                                                    aria-selected="false">&nbsp;&nbsp;Agency List</a>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-4 col-lg-4">
                                            <div class="card-body">
                                                <p class="agency-title-menu">Agency Branch Listing</p>
                                                <a class="dropdown-item <?php echo $method == "add_agency_branch" ? "active" : "" ?>"
                                                    data-toggle="pill5" href="<?php echo ADMIN_SITE_URL ?>add_agency_branch"
                                                    role="tab" aria-selected="false">&nbsp;&nbsp;Add Agency Branch</a>
                                                <a class="dropdown-item <?php echo $method == "agency_branch" ? "active" : "" ?>"
                                                    data-toggle="pill3" href="<?php echo ADMIN_SITE_URL ?>agency_branch"
                                                    role="tab" aria-selected="false">&nbsp;&nbsp;Agency Branch List</a>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-4 col-lg-4 lvl-ce lvl-ca lvl-ch lvl-ra">
                                            <div class="card-body">
                                                <p class="agency-title-menu">Users</p>
                                                <a class="dropdown-item <?php echo $method == "users" ? "active" : "" ?>"
                                                    data-toggle="pill6" href="<?php echo ADMIN_SITE_URL ?>users" role="tab"
                                                    aria-selected="false">&nbsp;&nbsp;User List</a>
                                                <a class="dropdown-item <?php echo $method == "add_users" ? "active" : "" ?>"
                                                    data-toggle="pill7" href="<?php echo ADMIN_SITE_URL ?>add_users"
                                                    role="tab" aria-selected="false">&nbsp;&nbsp;Add User</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown case-dropdown lvl-ra">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
                                    id="navbarDropdownCase" role="button" aria-haspopup="true"
                                    aria-expanded="false">Case Management</a>
                                <div class="dropdown-menu case-menu menu-carret" aria-labelledby="navbarDropdown"
                                    id="case-menu">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                            <div class="card-body">
                                                <p class="agency-title-menu">Case Management</p>
                                                <a class="dropdown-item lvl-ch <?php echo $method == "add_case" ? "active" : "" ?>"
                                                    data-toggle="pill9" href="<?php echo ADMIN_SITE_URL ?>add_case" role="tab"
                                                    aria-selected="false">&nbsp;&nbsp;Add New Report </a>
                                                <a class="dropdown-item <?php echo $method == "cases" ? "active" : "" ?>"
                                                    data-toggle="pill8" href="<?php echo ADMIN_SITE_URL ?>cases" role="tab"
                                                    aria-selected="false">&nbsp;&nbsp;Report List</a>
                                                <a class="dropdown-item <?php echo $method == "temporary_cases" ? "active" : "" ?>"
                                                    data-toggle="pill8" href="<?php echo ADMIN_SITE_URL ?>temporary_cases" role="tab"
                                                    aria-selected="false">&nbsp;&nbsp;Temporary Case List</a>
                                                <a class="dropdown-item lvl-ra <?php echo $method == "recruitment_and_employer" ? "active" : "" ?>"
                                                    data-toggle="pill8"
                                                    href="<?php echo ADMIN_SITE_URL ?>recruitment_and_employer" role="tab"
                                                    aria-selected="false">&nbsp;&nbsp;Recruiter and Employer</a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6  lvl-ce">
                                            <div class="card-body">
                                                <p class="agency-title-menu">Legal Case</p>
                                                <a class="lvl-ce dropdown-item <?php echo $method == "criminal_case_list" ? "active" : "" ?>"
                                                    data-toggle="pill9" href="<?php echo ADMIN_SITE_URL ?>criminal_case_list"
                                                    role="tab" aria-selected="false">&nbsp;&nbsp;Criminal Case</a>
                                                <a class="lvl-ce dropdown-item <?php echo $method == "admin_case" ? "active" : "" ?>"
                                                    data-toggle="pill15" href="<?php echo ADMIN_SITE_URL ?>admin_case"
                                                    role="tab" aria-selected="false">&nbsp;&nbsp;Administrative Case</a>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <!--Hide victim list-->
                                        <div class="col-sm-6 col-md-6 col-lg-6" style="display:none">
                                            <div class="card-body">
                                                <p class="agency-title-menu">Trafficked Person</p>
                                                <a class="dropdown-item <?php echo $method == "cases" ? "active" : "" ?>"
                                                    data-toggle="pill8" href="<?php echo ADMIN_SITE_URL ?>victim_list"
                                                    role="tab" aria-selected="false">&nbsp;&nbsp;Victim List</a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-6 lvl-ce lvl-ch lvl-ca lvl-ra">
                                            <div class="card-body">
                                                <p class="agency-title-menu">Inactive Services</p>
                                                <a class="dropdown-item <?php echo $method == "legal_services_archived" ? "active" : "" ?>"
                                                    data-toggle="pill12"
                                                    href="<?php echo ADMIN_SITE_URL ?>legal_services_archived" role="tab"
                                                    aria-selected="false">&nbsp;&nbsp;Legal</a>
                                                <a class="dropdown-item <?php echo $method == "reintegration_archived" ? "active" : "" ?>"
                                                    data-toggle="pill13"
                                                    href="<?php echo ADMIN_SITE_URL ?>reintegration_archived" role="tab"
                                                    aria-selected="false">&nbsp;&nbsp;Reintegration</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--                                        <a class="dropdown-item <?php echo $method == "cases" ? "active" : "" ?>"   data-toggle="pill8" href="<?php echo SITE_URL ?>cases" role="tab" aria-selected="false">&nbsp;&nbsp;Case List</a>
                                            <a class="dropdown-item <?php echo $method == "add_case" ? "active" : "" ?>"   data-toggle="pill9" href="<?php echo SITE_URL ?>add_case" role="tab" aria-selected="false">&nbsp;&nbsp;Add New Case </a>-->
                                </div>
                            </li>
                            <li class="nav-item lvl-ra hide">
                                <a class="nav-link <?php echo $method == "recruitment_and_employer" ? "active" : "" ?>"
                                    data-toggle="pill10" href="<?php echo ADMIN_SITE_URL ?>recruitment_and_employer"
                                    role="tab" aria-selected="false">Recruiter and Employer</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $method == "reports" ? "active" : "" ?>"
                                    data-toggle="pill16" href="<?php echo ADMIN_SITE_URL ?>generate_report" role="tab"
                                    aria-selected="false">Analytics</a>
                            </li>
                            <li class="nav-item lvl-ce lvl-ch lvl-ca lvl-ra">
                                <a class="nav-link <?php echo $method == "settings" ? "active" : "" ?>"
                                    data-toggle="pill11" href="<?php echo ADMIN_SITE_URL ?>settings" role="tab"
                                    aria-selected="false">Settings</a>
                            </li>
                        </ul>


                    </div>
                    <!-- END NAVIGATION -->
                    <!--</div>-->
                </div>


            </div>
        </div>

        <div class="page-content-wrapper">

            <div class="page-head page-head-height">

                <div class="page-breadcrumbs">

                    <div class="page-title pt-2">
                        <div class="row pt-1">
                            <div class="col-lg-12 col-md-12 col-sm-12 breadcrumbs-line">
                                <div class="mt-1">
                                    <ul class="page-breadcrumb breadcrumb">
                                        <li>
                                            <span>HOME </span>
                                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                        </li>

                                        <li>
                                            <span class="dashboard">&nbsp; <?=$seo['page_title']?></span>
                                        </li>
                                    </ul>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>



            <!--------------------START OF FLOATER--------------------------------->
            <div id="overlay-in"></div>
            <div class="floater-container ">
                <div class="d-contents">
                    <div class="floater" id="floater-directory">
                        <i class="far fa-address-card" id="icon" data-toggle="tooltip" data-placement="right"
                            title=" ICMS Directory"></i>
                    </div>
                    <div class="floater" id="floater-dictionary">
                        <i class="fas fa-atlas icon-sidebar" id="icon-dictionary" data-toggle="tooltip"
                            data-placement="right" title=" ICMS Dictionary"></i>
                    </div>

                    <div class="shadow-sm directory-menu-style btn-close-floater btn-close-directory hide" id="menu">
                    </div>

                    <div class=" sidebar-directory" id="sidebar">
                        <div id="sbar_inside">
                            <div class="d-flex bd-highlight">
                                <div class="flex-fill bd-highlight">
                                    <p>ICMS DIRECTORY</p>
                                </div>
                                <div class="flex-fill bd-highlight">
                                    <div class="form-search">
                                        <div class="d-flex bd-highlight">
                                            <div class=" flex-fill bd-highlight">
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-2 col-form-label"></label>
                                                    <div class="col-sm-10">
                                                        <input type="search" class="form-control"
                                                            id="txt-directory-search"
                                                            placeholder="Type in keyword or name..">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" flex-fill bd-highlight">
                                    <div class=" flex-fill bd-highlight">
                                        <button type="button" class="btn btn-directory_search ">Search</button>
                                    </div>
                                </div>
                                <span class=" btn-close-floater btn-close-directory hide"><i
                                        class="fas fa-times"></i></span>

                            </div>
                            <div class="directory-container">
                                <ul class="nav agency-list_content  " id="list-directory"
                                    style="margin-bottom:25px !important;">
                                </ul>
                                <div class="text-center p-5 m-5">
                                    <div class="nd-header">
                                        <div class="spinner-border txt-orange" style="width: 5em; height: 5em;">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                    <div class="nd-body">
                                        <h5 class="nd-body-content">Loading information...</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="">
                    <div class="shadow-sm directory-menu-style btn-close-floater btn-close-directory hide">
                    </div>

                    <div class="" id="sidebar-dictionary">
                        <div id="sbar_inside">
                            <div class="d-flex bd-highlight">
                                <div class="flex-fill bd-highlight">
                                    <p>DATA DICTIONARY</p>
                                </div>
                                <div class="flex-fill bd-highlight">
                                    <div class="form-search">
                                        <div class="d-flex bd-highlight">
                                            <div class=" flex-fill bd-highlight">
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-2 col-form-label"></label>
                                                    <div class="col-sm-10">
                                                        <input type="search" class="form-control"
                                                            id="txt-data-dic-search"
                                                            placeholder="Type in keyword or name..">

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class=" flex-fill bd-highlight">
                                    <div class=" flex-fill bd-highlight">
                                        <button type="button"
                                            class="btn btn-directory_search icms-bg-primary">Search</button>
                                    </div>
                                </div>
                                <span class=" btn-close-floater btn-close-dictionary hide "><i
                                        class="fas fa-times"></i></span>
                            </div>

                            <div class="directory-container">
                                <ul class="nav agency-list_content " id="list-dictionary">
                                </ul>
                                <div class="text-center p-5 m-5">
                                    <div class="nd-header">
                                        <div class="spinner-border txt-orange" style="width: 5em; height: 5em;">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                    <div class="nd-body">
                                        <h5 class="nd-body-content">Loading information...</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="#" class="float float-dtry hide">
                <i class="fa fa-address-card my-float " aria-hidden="true"></i>
            </a>


        </div>
        </div>
    </header>
    <!-- END TOP BAR -->



    <div class="page-content">