<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
$method = $this->router->fetch_method();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?= $seo['page_title'] ?></title>
        <meta charset="utf-8">
        <meta name="description" content="<?= $seo['page_description'] ?>">
        <meta name="keywords" content="<?= $seo['page_keyword'] ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="author" content="<?= $seo['page_author'] ?>">
        <meta http-equiv="refresh" content="<?= $seo['page_refresh'] ?>">
        <meta name="csrf-param" content="_csrf_protection">
        <meta name="csrf-token" content="<?= $this->security->get_csrf_hash() ?>">
        <meta name="csrf-author" content="<?= $this->security->get_csrf_token_name() ?>">

        <!-- CSS Library -->
        <link rel="stylesheet" href="<?= SITE_ASSETS ?>global/template/bootstrap/css/bootstrap.min.css">        
        <link rel="stylesheet" href="<?= SITE_ASSETS ?>modules/icms/css/global.css" type="text/css">
        <link rel="stylesheet" href="<?= SITE_ASSETS ?>library/plugin/Bs-stepper/css/bs-stepper.css" type="text/css">
        <link rel="stylesheet" href="<?= SITE_ASSETS ?>library/plugin/Bs-stepper/css/bs-stepper.min.css" type="text/css">


        <!--CSS font-->
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">


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
    <body class="corporate">
        <!-- BEGIN TOP BAR -->
        <div class="pre-header">
            <div class="container container-fluid">

                <div class="row d-flex bd-highlight" >
                    <!-- BEGIN TOP BAR LEFT PART -->
                    <div class="col-lg-7 col-md-7 col-sm-12 flex-fill">
                        <a class="site-logo" ><img src="https://www.1343actionline.ph/images/logos/iacat.png" height="75px" alt=""> 
                            <h4 class="header-title">INTEGRATED CASE MANAGEMENT SYSTEM</h4></a>
                    </div>

                    <div class="col-lg-5 col-md-5 col-sm-12 additional-shop-info flex-fill">

                        <ul class="list-unstyled list-inline pre-header-user d-inline-flex">
                            <li><img src="https://i2.wp.com/myaeon.com.au/wp-content/uploads/2017/04/avatar-round-1.png?ssl=1" class="user-profile-pic"></li>
                            <li class="user-name"> Kimberly Bado </li>
                            <li class="nav-item  notif-dropdown">
                                <a class='dropdown-button btn-flat dropdown-toggle' href="#" role="button" aria-expanded="true" data-activates='dropdown1'><i class="material-icons" style="color: #333c48;">notifications</i><span class="badge notif-badge"> 10 </span></a>
                                <div class="dropdown-menu list-notif" aria-labelledby="navbarDropdown" id="case-menu">
                                    <ul class="list-unstyled">
                                        <li class="header-li">Notifications</li>
                                        <li class="tagged-case"> 
                                            <div class="row ">
                                                <div class="col-2">
                                                    <i class="fas fa-briefcase icon-tagged"></i>
                                                </div>
                                                <div class="col-6">
                                                    <p class="notif-title">OPLE tagged a Case</p>
                                                    <small class="notif-content">Lorem IpsumLorem IpsumLorem IpsumLorem Ipsum</small>
                                                </div>
                                                <div class="col-4">
                                                    <p class="notif-time"> 23 minutes ago</p>
                                                </div>
                                            </div>
                                        </li><hr>
                                        <li class="tagged-case"> 
                                            <div class="row ">
                                                <div class="col-2">
                                                    <i class="fas fa-exclamation-triangle icon-expired"></i>
                                                </div>
                                                <div class="col-6">
                                                    <p class="notif-title">Expiring Case</p>
                                                    <small class="notif-content">Lorem IpsumLorem IpsumLorem IpsumLorem Ipsum</small>
                                                </div>
                                                <div class="col-4">
                                                    <p class="notif-time">  1 week 2 days</p>
                                                </div>
                                            </div>
                                        </li><hr>
                                        <li class="tagged-case"> 
                                            <div class="row ">
                                                <div class="col-2">
                                                    <i class="fas fa-stopwatch icon-time"></i>
                                                </div>
                                                <div class="col-6">
                                                    <p class="notif-title">Due Case</p>
                                                    <small class="notif-content">Lorem IpsumLorem IpsumLorem IpsumLorem Ipsum</small>
                                                </div>
                                                <div class="col-4">
                                                    <p class="notif-time"> 2 weeks </p>
                                                </div>
                                            </div>
                                        </li><hr>
                                        <li class="footer-li">See All</li>
                                    </ul>
                                </div>
                            </li>


                            <li><a class='dropdown-button btn-flat' href="#" data-activates="notification-bar" class="notification-collapse"><i class="material-icons">chat_bubble_outline</i><span class="badge chat-badge"> 5 </span></a></li>
                        </ul>

                    </div>


                </div>
            </div>        
        </div>
    </body>
    <!-- END TOP BAR -->


    <div class="header">
        <div class="row">
            <div class="col-8">

                <a href="javascript:void(0);" class="mobi-toggler hide"  ><i class="fa fa-bars"></i></a>
                <!-- BEGIN NAVIGATION -->
                <div class="header-navigation " class="topnav" id="myTopnav">
                    <!--                <ul>
                                        <li class="<?php
                    if ($this->router->fetch_method() == 'index') {
                        echo 'active';
                    }
                    ?>"><a href="<?= SITE_URL ?>">Home</a></li>
                                        <li>Home</li>
                                    </ul>-->

                    <ul class="nav nav-pills mb-3 nav-items-tab" id="pills-tab" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link <?php echo $method == "dashboard" ? "active" : "" ?>" data-toggle="pill1" href="<?php echo SITE_URL ?>dashboard" role="tab"  aria-selected="true">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $method == "newsfeed" ? "active" : "" ?>"  data-toggle="pill2" href="<?php echo SITE_URL ?>newsfeed" role="tab"  aria-selected="false">Newsfeed</a>
                        </li>
                        <!--                        <li class="nav-item">
                                                    <a class="nav-link <?php echo $method == "users" ? "active" : "" ?>"  data-toggle="pill3" href="<?php echo SITE_URL ?>users" role="tab" aria-selected="false">Users</a>
                                                </li>-->
                        <li class="nav-item dropdown agency-dropdown">
                            <!--<a class="nav-link <?php echo $method == "agencies" ? "active" : "" ?>"   data-toggle="pill4" href="<?php echo SITE_URL ?>agencies" role="tab" aria-selected="false">Government Agencies</a>-->
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="navbarDropdown1" role="button" aria-haspopup="true" aria-expanded="false">Government Agencies</a>
                            <div class="dropdown-menu agency-menu" aria-labelledby="navbarDropdown1" id="agency-menu">
                                <a class="dropdown-item <?php echo $method == "agencies" ? "active" : "" ?>"   data-toggle="pill3" href="<?php echo SITE_URL ?>agencies" role="tab" aria-selected="false"><i class="fas fa-list"></i>&nbsp;&nbsp;Agency List</a>
                                <a class="dropdown-item <?php echo $method == "add_agency" ? "active" : "" ?>"   data-toggle="pill4" href="<?php echo SITE_URL ?>add_agency" role="tab" aria-selected="false"><i class="fas fa-cogs"></i>&nbsp;&nbsp;Create Agency</a>
                                <a class="dropdown-item <?php echo $method == "add_agency_branch" ? "active" : "" ?>"   data-toggle="pill5" href="<?php echo SITE_URL ?>add_agency_branch" role="tab" aria-selected="false"><i class="fas fa-cogs"></i>&nbsp;&nbsp;Create Agency</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown case-dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">Case Management</a>
                            <div class="dropdown-menu case-menu" aria-labelledby="navbarDropdown" id="case-menu">
                                <a class="dropdown-item <?php echo $method == "cases" ? "active" : "" ?>"   data-toggle="pill6" href="<?php echo SITE_URL ?>cases" role="tab" aria-selected="false"><i class="fas fa-list"></i>&nbsp;&nbsp;Case List</a>
                                <a class="dropdown-item <?php echo $method == "add_case" ? "active" : "" ?>"   data-toggle="pill7" href="<?php echo SITE_URL ?>add_case" role="tab" aria-selected="false"><i class="fas fa-cogs"></i>&nbsp;&nbsp;Create New Case </a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $method == "reports" ? "active" : "" ?>"  data-toggle="pill8" href="<?php echo SITE_URL ?>reports" role="tab" aria-selected="false">Reports</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $method == "directory" ? "active" : "" ?>"   data-toggle="pill9" href="<?php echo SITE_URL ?>directory" role="tab"  aria-selected="false">Settings</a>
                        </li>
                    </ul>

                </div>
                <!-- END NAVIGATION -->
                <!--</div>-->
            </div>
            <div class="col-4">
                <form class="form-inline my-2 my-lg-0 navbar-search"> 
                    <div class="input-form"> 
                        <input class="form-control mr-sm-1 search-field " style=" margin-left: 0px;" type="search" placeholder="Search" aria-label="Search">
                    </div>

                    <label class=" my-2 my-sm-0 lbl-name" data-toggle="modal" data-target="#advance-search">Advance Search</label>
                </form>
            </div>
        </div>
    </div>
    <div class="page-content-wrapper">

        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <div class="container">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <div class="" style="border-left: 3px solid #4f6785;">
                        <div class="" style="    margin-left: 15px;">
                            <p style="margin-bottom: 0px;"><?= $seo['page_title'] ?></p>
                            <ul class="page-breadcrumb breadcrumb">
                                <li>
                                    <span>HOME  </span>
                                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                </li>

                                <li>
                                    <span class="dashboard">&nbsp; <?= $seo['page_title'] ?></span>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
                <!-- END PAGE TITLE -->
            </div>
        </div>
        <!-- END PAGE HEAD-->



        <div class="modal fade" id="advance-search" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body" >
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title header-search" id="exampleModalLabel">Advance Search</h5>
                        <p class="case-title-search"> Filter by case detail <br></p>
                        <form class="adv-search-field">  
                            <div class="form-row">
                                <div class="col-4">
                                    <label>Case ID</label>
                                    <input type="text" class="form-control" >
                                </div>
                                <div class="col-8">
                                    <label>Nature of Case</label>
                                    <select id="inputState" class="form-control">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row" >
                                <div class="col-4">
                                    <label>Date Created</label>
                                    <input type="text" class="form-control" >
                                </div>
                                <div class="col-4">
                                    <label>Source</label>
                                    <select id="inputState" class="form-control">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label>Reference Agency</label>
                                    <select id="inputState" class="form-control">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                        <br>
                        <p class="case-title-search"> Filter by worker's information <br></p>
                        <form class="adv-search-field">  
                            <div class="form-row" >
                                <div class="col-4">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" >
                                </div>
                                <div class="col-4">
                                    <label>Middle Name</label>
                                    <input type="text" class="form-control" >
                                </div>
                                <div class="col-4">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" >
                                </div>
                            </div>
                            <div class="form-row" >
                                <div class="col-3">
                                    <label>Gender</label>
                                    <select id="inputState" class="form-control">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label>Birthday</label>
                                    <input type="text" class="form-control" >
                                </div>
                                <div class="col-3">
                                    <label>City</label>
                                    <select id="inputState" class="form-control">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label>Province</label>
                                    <select id="inputState" class="form-control">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                        <br>
                        <p class="case-title-search"> Filter by worker's information <br></p>
                        <form class="adv-search-field">  
                            <div class="form-row" >
                                <div class="col-4">
                                    <label>Agency</label>
                                    <select id="inputState" class="form-control">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label>Employer</label>
                                    <select id="inputState" class="form-control">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label>Country of Origin</label>
                                    <select id="inputState" class="form-control">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <label class="pull-left">Reset all filters</label>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-advSearch">Search</button>
                    </div>
                </div>
            </div>
        </div>
