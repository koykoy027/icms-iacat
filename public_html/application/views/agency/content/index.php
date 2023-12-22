<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!--        <div class="page-content-wrapper">
             BEGIN CONTENT BODY 
             BEGIN PAGE HEAD

            <div class="container">

                <div class="row d-flex bd-highlight" >
                     BEGIN TOP BAR LEFT PART 
                    <div class="col-5 flex-fill">
                        <div class="page-title">
                            <p>Dashboard</p>
                        </div>
                    </div>

                    <div class="col-5 additional-shop-info flex-fill">

                        <ul class="page-breadcrumb breadcrumb">
                            <li>
                                <span>Home > </span>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span class="dashboard">&nbsp; Dashboard</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> 
        </div>-->

<!--        <div class="main">
            <div class="page-content ">
                <div class="container main-content">

                     BEGIN PAGE CONTENT INNER 
                    <div class="page-content-inner">

                    </div>
                </div>
            </div>
        </div>-->

<!-- BEGIN PAGE HEAD-->
<div class="page-head">
    <div class="container">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <div class="" style="border-left: 3px solid #4f6785;">
                <div class="" style="    margin-left: 15px;">
                    <p style="margin-bottom: 0px;">Dashboard</p>
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <span>HOME  </span>
                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                        </li>

                        <li>
                            <span class="dashboard">&nbsp; DASHBOARD</span>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
        <!-- END PAGE TITLE -->
        <!-- BEGIN PAGE BREADCRUMBS -->
        <div>
            <!--                <ul class="page-breadcrumb breadcrumb">
                                <li>
                                    <span>Home > </span>
                                    <i class="fa fa-angle-right"></i>
                                </li>
                                <li>
                                    <span class="dashboard">&nbsp; Dashboard</span>
                                </li>
                            </ul>-->
        </div>
        <!-- END PAGE BREADCRUMBS -->
    </div>
</div>
<!-- END PAGE HEAD-->
<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content">
 
    <div class="container">
                <div class="row" style="padding-top: 25px; ">

                                <div class="col-3">
                                    <div class="card card-stats" >
                                        <div class="row no-gutters">
                                            <div class="col-md-4 stat_1">
                                                <div class=""><i class="material-icons bookmarks">bookmarks</i></div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <p class="stat-header">Total Casessdasdadasdadf</p>
                                                    <p class="stat-count">28</p>
                                                    <!--<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card card-stats" >
                                        <div class="row no-gutters">
                                            <div class="col-md-4 stat_1">
                                                <div class=""><i class="material-icons bookmarks">bookmarks</i></div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <p class="stat-header">On Going CaseaSDASDFASDFS</p>
                                                    <p class="stat-count">3</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card card-stats" >
                                        <div class="row no-gutters">
                                            <div class="col-md-4 stat_1">
                                                <div class=""><i class="material-icons bookmarks">bookmarks</i></div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <p class="stat-header">Closed Case</p>
                                                    <p class="stat-count">54</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card card-stats" >
                                        <div class="row no-gutters">
                                            <div class="col-md-4 stat_1">
                                                <div class=""><i class="material-icons bookmarks">bookmarks</i></div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <p class="stat-header">Stagnant Case</p>
                                                    <p class="stat-count">9</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 

        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="mt-content-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card case-list card-container">

                        <!-- End Statistics Row-->
                            <div class="row">
                                <!--Monthly Statistics and Report-->
                                <div class="col-8"> 
                                                  <p class="card-text monthly-stats"> Statistics and Report</p>
                                    <div class="card case-list card-container">
                                        
                                        <div class="card-body" style=" max-height: 500px; overflow-y: scroll;">
                                            <!--<p class="card-text monthly-stats"> Statistics and Report</p>-->

                                            <ul class="nav nav-pills nav-fill stats-ul" id="myTab" >
                                                <li class="nav-item">
                                                    <a class="nav-link active nav-tab" id="recent-case-tab" data-toggle="tab" href="#recent" role="tab">Recent Case</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link nav-tab" id="high-prio-tab" data-toggle="tab" href="#highPriority" role="tab">High Priority Case</a>
                                                </li> 
                                                <li class="nav-item">
                                                    <a class="nav-link nav-tab" id="stagnant-tab" data-toggle="tab" href="#stagnant" role="tab">Stagnant Case</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link nav-tab" id="expired-tab" data-toggle="tab" href="#expired" role="tab">Expired Tag</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="recent" role="tabpanel" aria-labelledby="recent-case-tab">
                                                    <div class="card report-list">
                                                        <hr><div class="card-body">
                                                            <p class="case-number">ICMS-000-001</p>
                                                            <p class="victim-name">Kimberly Visperas Bado</p>
                                                            <p class="victim-details">B20 L23 Kamias Alley St. Ph 4B Dela Paz, Antipolo City 1870</p>
                                                            <p class="victim-details"> 22 years old</p>
                                                            <p class="victim-details"> Case Category : <span class="nature-case">Labor</span> </p>
                                                        </div>
                                                    </div> <hr>
                                                    <div class="card report-list">
                                                        <div class="card-body">
                                                            <p class="case-number">ICMS-000-001</p>
                                                            <p class="victim-name">Kimberly Visperas Bado</p>
                                                            <p class="victim-details">B20 L23 Kamias Alley St. Ph 4B Dela Paz, Antipolo City 1870</p>
                                                            <p class="victim-details"> 22 years old</p>
                                                            <p class="victim-details"> Case Category : <span class="nature-case">Labor</span> </p>
                                                        </div>
                                                    </div> <hr>
                                                    <div class="card report-list">
                                                        <div class="card-body">
                                                            <p class="case-number">ICMS-000-001</p>
                                                            <p class="victim-name">Kimberly Visperas Bado</p>
                                                            <p class="victim-details">B20 L23 Kamias Alley St. Ph 4B Dela Paz, Antipolo City 1870</p>
                                                            <p class="victim-details"> 22 years old</p>
                                                            <p class="victim-details"> Case Category : <span class="nature-case">Labor</span> </p>
                                                        </div>
                                                    </div> <hr>
                                                </div>


                                                <div class="tab-pane fade" id="highPriority" role="tabpanel" aria-labelledby="high-prio-tab">
                                                    <div class="card report-list">
                                                        <hr><div class="card-body">
                                                            <p class="case-number">ICMS-000-001</p>
                                                            <p class="victim-name">Jaycee Diaz Apple</p>
                                                            <p class="victim-details">B20 L23 Kamias Alley St. Ph 4B Dela Paz, Antipolo City 1870</p>
                                                            <p class="victim-details"> 22 years old</p>
                                                            <p class="victim-details"> Case Category : <span class="nature-case">Labor</span> </p>
                                                        </div>
                                                    </div> <hr>
                                                    <div class="card report-list">
                                                        <div class="card-body">
                                                            <p class="case-number">ICMS-000-001</p>
                                                            <p class="victim-name">Jaycee Diaz Apple</p>
                                                            <p class="victim-details">B20 L23 Kamias Alley St. Ph 4B Dela Paz, Antipolo City 1870</p>
                                                            <p class="victim-details"> 22 years old</p>
                                                            <p class="victim-details"> Case Category : <span class="nature-case">Labor</span> </p>
                                                        </div>
                                                    </div> <hr>
                                                </div>


                                                <div class="tab-pane fade" id="stagnant" role="tabpanel" aria-labelledby="contact-tab">
                                                    <div class="card report-list">
                                                        <hr><div class="card-body">
                                                            <p class="case-number">ICMS-000-001</p>
                                                            <p class="victim-name">Kim Arvin Toledo</p>
                                                            <p class="victim-details">B20 L23 Kamias Alley St. Ph 4B Dela Paz, Antipolo City 1870</p>
                                                            <p class="victim-details"> 22 years old</p>
                                                            <p class="victim-details"> Case Category : <span class="nature-case">Labor</span> </p>
                                                        </div>
                                                    </div> <hr>
                                                    <div class="card report-list">
                                                        <div class="card-body">
                                                            <p class="case-number">ICMS-000-001</p>
                                                            <p class="victim-name">Kim Arvin Toledo</p>
                                                            <p class="victim-details">B20 L23 Kamias Alley St. Ph 4B Dela Paz, Antipolo City 1870</p>
                                                            <p class="victim-details"> 22 years old</p>
                                                            <p class="victim-details"> Case Category : <span class="nature-case">Labor</span> </p>
                                                        </div>
                                                    </div>
                                                </div> 


                                                <div class="tab-pane fade" id="expired" role="tabpanel" aria-labelledby="contact-tab"> 
                                                    <hr><div class="card-body">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="ribbon reserved high-prio"><span class="ads-ribbon">CRITICAL</span></div>
                                                                <p class="case-number-ex">ICMS-000-001</p>
                                                                <p class="victim-name-ex">Kim Arvin Toledo</p>
                                                                <p class="gov-agency">Government Agency :<span class="badge badge-success">DOLE</span></p>
                                                            </div>
                                                            <div class="col-6" style=" padding-top: 10px;">
                                                                <p class="victim-details">Date Expired :<span class="date-expire"> MAY 2,2018 </span></p>
                                                                <p class="victim-details"> Case Category : <span class="nature-case">Labor</span> </p>
                                                                <p class="victim-details">Days Expired <span class=""></span></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr><div class="card-body">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="ribbon reserved low-prio"><span class="ads-ribbon">LOW</span></div>
                                                                <p class="case-number-ex">ICMS-000-001</p>
                                                                <p class="victim-name-ex">Kim Arvin Toledo</p>
                                                                <p class="gov-agency">Government Agency :<span class="badge badge-success">NBI</span></p>
                                                            </div>
                                                            <div class="col-6" style=" padding-top: 10px;">
                                                                <p class="victim-details">Date Expired :<span class="date-expire"> MAY 2,2018 </span></p>
                                                                <p class="victim-details"> Case Category : <span class="nature-case">Labor</span> </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr><div class="card-body">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="ribbon reserved low-prio"><span class="ads-ribbon">LOW</span></div>
                                                                <p class="case-number-ex">ICMS-000-001</p>
                                                                <p class="victim-name-ex">Kim Arvin Toledo</p>
                                                                <p class="gov-agency">Government Agency :<span class="badge badge-success">PNP</span></p>
                                                            </div>
                                                            <div class="col-6" style=" padding-top: 10px;">
                                                                <p class="victim-details">Date Expired :<span class="date-expire"> MAY 2,2018 </span></p>
                                                                <p class="victim-details"> Case Category : <span class="nature-case">Labor</span> </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div> 

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="card case-list">
                                        <div class="card-body" style=" max-height: 500px; overflow-y: scroll;">
                                            <p class="card-text monthly-stats">HISTORY LOGS</p>
                                            <div class="card report-list">
                                                <div class="card-body history-logs">
                                                    <ul class="timeline">
                                                        <li>
                                                            <span class="log-time">May 2, 2019 9:02am</span>
                                                            <p class="victim-details">Update Case ICMS-000-001</p>
                                                        </li>
                                                        <li>
                                                            <span class="log-time">May 2, 2019 9:02am</span>
                                                            <p class="victim-details">Update Case ICMS-000-001</p>
                                                        </li>
                                                        <li>
                                                            <span class="log-time">May 2, 2019 9:02am</span>
                                                            <p class="victim-details">Update Case ICMS-000-001</p>
                                                        </li>
                                                        <li>
                                                            <span class="log-time">May 2, 2019 9:02am</span>
                                                            <p class="victim-details">Update Case ICMS-000-001</p>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="TitleBreak"></div>

   


            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>
</div>
<!-- END PAGE CONTENT BODY -->
<!-- END CONTENT BODY -->
</div>

