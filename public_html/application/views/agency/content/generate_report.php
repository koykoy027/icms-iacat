
<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="page-content">

    <!-- BEGIN PAGE CONTENT INNER -->
    <div class="page-content-inner">
        <div class="mt-content-body" style="font-family: source sans pro;">
            <div class="row container-padding" >
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card" >
                        <div class="row"> 
                            <div class="col-lg-12 col-md-12 col-sm-12"> 
                                <div class="card-title">
                                    <p> Reports and Analytics</p>
                                    <!--<small class="card-desc"> List of all departments : government and non government agencies.  </small>--> 
                                </div>
                            </div>
                        </div>

                        <div class="collapse-body-content" style="padding: 15px;">

                            <div class="d-inline-flex bd-highlight">
                                <ul class=" reports-ul nav " id="myTab" role="tablist">                                   
                                    <li class="nav-item nav-inner-item">
                                        <a class="nav-link nav-tab active" id="case-victim-tab" data-toggle="tab" href="#case_victim-con" role="tab" aria-controls="profile" aria-selected="false">Report</a>
                                    </li>  
                                    <li class="nav-item hide nav-inner-item">
                                        <a class="nav-link nav-tab" id="case-tab" data-toggle="tab" href="#case-con" role="tab" aria-controls="contact" aria-selected="false">Case</a>
                                    </li>
                                    <li class="nav-item nav-inner-item">
                                        <a class="nav-link nav-tab" id="victim-tab" data-toggle="tab" href="#victim-con" role="tab" aria-controls="home" aria-selected="true">Victim</a>
                                    </li>  
                                    <li class="nav-item nav-inner-item">
                                        <a class="nav-link nav-tab" id="case-respondents-tab" data-toggle="tab" href="#case_respondents-con" role="tab" aria-controls="profile" aria-selected="false">Offender</a>
                                    </li>  
                                    <li class="nav-item nav-inner-item">
                                        <a class="nav-link nav-tab" id="case-services-tab" data-toggle="tab" href="#case_services-con" role="tab" aria-controls="profile" aria-selected="false">Service</a>
                                    </li>  
                                    <li class="nav-item nav-inner-item">
                                        <a class="nav-link nav-tab" id="case-services-aging-tab" data-toggle="tab" href="#case_services_aging-con" role="tab" aria-controls="profile" aria-selected="false">Aging</a>
                                    </li>  
                                    <li class="nav-item hide nav-inner-item">
                                        <a class="nav-link nav-tab" id="report-minor-tab" data-toggle="tab" href="#report_minor-con" role="tab" aria-controls="profile" aria-selected="false">Report for minor</a>
                                    </li>    
                                    <li class="nav-item hide nav-inner-item">
                                        <a class="nav-link nav-tab" id="agency-achievement-tab" data-toggle="tab" href="#agency-achievement-con" role="tab" aria-controls="contact" aria-selected="false">Agency Achievements</a>
                                    </li>
                                    <li class="nav-item hide nav-inner-item">
                                        <a class="nav-link nav-tab" id="criminal-cases-tab" data-toggle="tab" href="#criminal_cases-con" role="tab" aria-controls="contact" aria-selected="false">Criminal Case</a>
                                    </li>
                                    <li class="nav-item hide nav-inner-item">
                                        <a class="nav-link nav-tab" id="administrative-cases-tab" data-toggle="tab" href="#administrative_cases-con" role="tab" aria-controls="contact" aria-selected="false">Administrative Case</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content" id="myTabContent">

                                <!--Start Victim Report-->
                                <div class="tab-pane fade" id="victim-con" role="tabpanel" aria-labelledby="victim-tab" style="padding:20px;">

                                    <div class=" card-sub-title txt-W-500"> Generate Victim Report
                                        <br>
                                        <!--<small class="card-desc"> Details that related in victims that registered in the system. </small>-->
                                        <hr class="card-sub-title_border">
                                    </div>

                                    <div id="collapseVictim">
                                        <div class="card ">
                                            <div class="card-header card-wrapper blue" id="headingVictim" data-toggle="collapse" data-target="#collapseVictimFilter" aria-expanded="true" aria-controls="collapseOne">
                                                <div class=" card-sub-title txt-W-500"> Victim Details
                                                    <br>
                                                    <!--<small class="card-desc">Generate service report based on the detail's of victims.</small>-->
                                                </div>
                                            </div>
                                            <div id="collapseVictimFilter" class="collapse show" aria-labelledby="headingVictim" data-parent="#collapseVictim">
                                                <div class="card-body">
                                                    <div class="row">                                                        
                                                        <!--start left criteria-->
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <!--<div class="ribbon"><span>Base Report</span></div>-->
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <div class=" shadow-sm p-3 card-wrapper-report">
                                                                        <div class="row">
                                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                <p class="stat-header mb-3 txt-blue">Base Report</p>
                                                                                <label>Data Category:<font color="red"> <b>*</b> </font></label>
                                                                                <select class="form-control wd-full" id="brv-primary"> 
                                                                                </select>
                                                                                <div id="brv-primary-error" class="error" style="display: none"> This field is required. </div>
                                                                            </div>
                                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                <label>Type of graph: <font color="red"> <b>*</b> </font></label>
                                                                                <select class="form-control" id="brv-rt" style="width: 100%;">
                                                                                    <option value="1">Bar Graph - 3D </option> 
                                                                                    <option value="2">Pie Graph - Variable Height</option> 
                                                                                    <option value="3">Pie Chart - Variable Radius</option> 
                                                                                    <option value="4">Line Chart - Reverse Value Axis</option> 
                                                                                </select>
                                                                                <div id="brv-rt-error" class="error" style="display: none"> This field is required. </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>  
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                           <!--<div class="ribbon"><span>Date Range</span></div>-->
                                                            <div class=" shadow-sm p-3 card-wrapper-report">
                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                    <div class="pt-2">   
                                                                        <p class="stat-header mb-3 txt-blue">Date Range</p>
                                                                        <p class="stat-header mb-0">Report Type: 
                                                                            <span id="vr-txt-report_type">Daily</span>
                                                                        </p>   
                                                                        <small>Options: Daily, weekly, monthly, quarterly and annually</small>   
                                                                    </div>
                                                                    <div class="pt-3">        
                                                                        <label>Select Date Victim Registered Range: </label>
                                                                        <input id="vr-reportrange" class="form-control daterangepicker-field"/>   
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <!--<div class="ribbon"><span>Victim Details</span></div>-->
                                                            <div class=" shadow-sm p-3 card-wrapper-report">
                                                                <div class="container">
                                                                    <p class="stat-header mb-3 txt-blue">Report Details Filter</p>
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <p class="stat-header">Region:</p>
                                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12" id="vr-opt-region"> </div>
                                                                        </div>    
                                                                        <div class="col-6">
                                                                            <p class="stat-header">Minor Victim:</p>
                                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="vr-opt-check_all custom-control-input noSpcStart" value="1" name="optvr_minor" id="opt-vr_minor">
                                                                                    <label class="custom-control-label" for="opt-vr_minor">Age 18 below</label>
                                                                                </div>
                                                                            </div>
                                                                            <p class="stat-header">Sex:</p>
                                                                            <div class="form-group col-12" id="vr-opt-sex">
                                                                            </div>
                                                                            <p class="stat-header">Civil Status:</p>
                                                                            <div class="form-group col-12" id="vr-opt-civil_status">
                                                                            </div>
                                                                        </div>                                                                      
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row btn-generate ">
                                                    <button class="btn btn-primary-orange" id="btn-generate_report_victim">Generate</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Start result-->
                                    <div class="row" id="vr-result" style="display: none;">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <!--SHOW MATCHES IN VALIDATING CASE-->
                                            <div class="inner-box  matched_results">
                                                <div class="row form-row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue" style="padding-left: 15px;">Generated Statistics and Report <span class="matched_count"></span>
                                                        <br>
                                                        <!--<small class="card-desc">Description here. </small>-->
                                                    </div>
                                                    <div class="col-lg-12 col-ms-12 col-md-12">
                                                        <div class="card card-report">
                                                            <div class="card-header" style="padding: 20px; background: #fff;">                                                               
                                                                <div class="be-vr_title_name" style="font-size: 15px;    color: #e88f15;">Trafficked Person per Age Group and Sex</div>
                                                                <small class="be-vr_title_date"> As of June 2019 - July 2019</small>
                                                                <div class="row mgn-T-18 hide">
                                                                    <div class="col-lg-2 col-md-2 col-ms-2">
                                                                        <p style="color: #356396;"> Criteria:</p>
                                                                    </div>
                                                                    <div class="col-lg-10 col-md-10 col-sm-10">
                                                                        <span class="d-inline-block fw-6">Age :</span><span class="d-inline-block padding-l-10">18 - 20 years old</span><br>
                                                                        <span class="d-inline-block fw-6">Sex :</span><span class="d-inline-block padding-l-10">Male and Female</span><br>
                                                                        <span class="d-inline-block fw-6">Country :</span><span class="d-inline-block padding-l-10">Saudi Arabia</span><br>
                                                                        <span class="d-inline-block fw-6">Period :</span><span class="d-inline-block padding-l-10">June 2019 - July 2019</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="" style="padding: 20px 20px;">
                                                                <div class="row ">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">

                                                                        <!--Start Graph-->
                                                                        <div class="inner-box matched_contents container_graph">
                                                                            <div class="" style="padding: 20px 20px;">
                                                                                <p class="d-inline-block  blue fw-6">Graph: </p>
                                                                                <div class="" style="padding: 20px 20px; ">
                                                                                    <div class="chartdiv" id="vr-chartdiv"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!--End Graph-->

                                                                        <!--Start Tabular--> 
                                                                        <div class="inner-box matched_contents">   
                                                                            <div style="padding: 20px 20px;">
                                                                                <div class="float-right">         
                                                                                    <button type="button" class="btn btn-info export_print_report" data-tab="vr-result">
                                                                                        <i class="fa fa-print" aria-hidden="true"></i> Print 
                                                                                    </button>
                                                                                    <button type="button" class="btn btn-info export_download_report" data-tab="1">
                                                                                        <i class="fa fa-download" aria-hidden="true"></i> Download 
                                                                                    </button>
                                                                                </div>
                                                                                <p class="d-inline-block  blue fw-6">Tabular:</p>
                                                                                <div style="padding: 20px 20px">
                                                                                    <div class="victim-tabular">
                                                                                        <div class="row-header">
                                                                                            <div class="row row-header-border">
                                                                                                <div class="col-lg-4 col-md- col-sm-4 col-header">Date</div>
                                                                                                <div class="col-lg-4 col-md- col-sm-4 col-header be-vr_title_name">-</div>
                                                                                                <div class="col-lg-4 col-md- col-sm-4 col-header">Count</div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="div-allcase-list1  case-list1" >
                                                                                            <ul class=" list_content" id="vt-body">
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!--End Tabular-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End result-->
                                </div>
                                <!--End Victim Report-->

                                <!--Start Case Victim Report-->
                                <div class="tab-pane fade show active" id="case_victim-con" role="tabpanel" aria-labelledby="case-victim-tab" style="padding:20px;">

                                    <div class=" card-sub-title txt-W-500"> Generate Filled Report
                                        <br>
                                        <!--<small class="card-desc"> Details that related in filled report.  </small>-->
                                        <hr class="card-sub-title_border">
                                    </div>

                                    <div id="collapseCaseVictim">
                                        <div class="card">
                                            <div class="card-header card-wrapper blue" id="headingCaseVictim" data-toggle="collapse" data-target="#collapseCaseVictimFilter" aria-expanded="true" aria-controls="collapseOne">
                                                <div class=" card-sub-title txt-W-500">  Details of Report
                                                    <br>
                                                    <!--<small class="card-desc"> Generate report based on the detail's of reports/cases. </small>-->
                                                </div>
                                            </div>
                                            <div id="collapseCaseVictimFilter" class="collapse show" aria-labelledby="headingVictim" data-parent="#collapseCaseVictim">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <!--<div class="ribbon"><span>Base Report</span></div>-->
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <div class=" shadow-sm p-3 card-wrapper-report">
                                                                        <div class="row">
                                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                <p class="stat-header mb-3 txt-blue">Base Report</p>
                                                                                <label>Base type of report: <font color="red"> <b>*</b> </font> </label>
                                                                                <select class="form-control wd-full" id="brcv-base_type_report">
                                                                                    <option value="case_victim_id">A. Number of cases</option>
                                                                                    <option value="case_is_tip">B. Number of trafficking cases</option>
                                                                                    <option value="case_is_other_law">C. Number of illegal recruitment cases</option>
                                                                                    <option value="case_is_illegal_rec">D. Number of other charges </option>
                                                                                    <option class="hide" value="5">E. Number of complaints filed</option>
                                                                                    <option class="hide" value="6">F. Number of cases referred or endorsed to Secretariat per agency</option>
                                                                                    <option class="hide" value="7">G. Number of cases referred or endorsed by the Secretariat to member-agencies</option>
                                                                                    <option class="hide" value="8">H. Number of cases handled by each agency</option>
                                                                                </select>
                                                                                <div id="brcv-type_report-error" class="error" style="display: none"> This field is required. </div>
                                                                            </div>
                                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                <label> Data Category: <font color="red"> <b>*</b> </font> </label>
                                                                                <select class="form-control wd-full" id="brcv-primary">
                                                                                </select>
                                                                                <div id="brcv-primary-error" class="error" style="display: none"> This field is required. </div>
                                                                            </div>
                                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                <label>Type of graph: <font color="red"> <b>*</b> </font></label>
                                                                                <select class="form-control" id="brcv-rt" style="width: 100%;">
                                                                                    <option value="1">Bar Graph - 3D </option> 
                                                                                    <option value="2">Pie Graph - Variable Height</option> 
                                                                                    <option value="3">Pie Chart - Variable Radius</option> 
                                                                                    <option value="4">Line Chart - Reverse Value Axis</option> 
                                                                                </select>
                                                                                <div id="brcv-rt-error" class="error" style="display: none"> This field is required. </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <!--<div class="ribbon"><span>Date Range</span></div>-->
                                                            <div class=" shadow-sm p-3 card-wrapper-report">
                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">                                                                   
                                                                    <div class="pt-2">   
                                                                        <p class="stat-header mb-3 txt-blue">Date Range</p>
                                                                        <p class="stat-header mb-0">Report Type: 
                                                                            <span id="cvr-txt-report_type">Daily</span>
                                                                        </p>    
                                                                        <small>Options: Annual, quarterly, monthly, weekly and daily.</small>   
                                                                    </div>
                                                                    <div class="pt-3">   
                                                                        <!--<label>Select Date Filled Report Range: </label>-->
                                                                        <label>Select Date Range: </label>
                                                                        <input id="cvr-reportrange" class="form-control daterangepicker-field"/>       
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><br>

                                                    <div class="row">                                                        
                                                        <!--start left criteria-->
                                                        <div class="col-12">
                                                            <!--<div class="ribbon"><span>Report Details</span></div>--> 
                                                            <div class="shadow-sm p-3 card-wrapper-report">
                                                                <div class="container">
                                                                    <p class="stat-header mb-3 txt-blue">Report Details Filter</p>
                                                                    <div class="row">

                                                                        <div class="col-lg-4 col-md-4 col-sm-12"> 

                                                                            <p class="stat-header">Minor Victim:</p>
                                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="cv-opt-check_all custom-control-input" value="1" name="optcv_minor" id="opt-cv_minor">
                                                                                    <label class="custom-control-label" for="opt-cv_minor">Age 18 below</label>
                                                                                </div>
                                                                            </div>

                                                                            <p class="stat-header">Country:</p>
                                                                            <div class="container" style="max-height: 400px; overflow-y: scroll">
                                                                                <div class="form-group " id="cvr-opt-country">
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                        <div class="col-lg-4 col-md-4 col-sm-12"> 

                                                                            <p class="stat-header">Region:</p>
                                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12" id="cvr-opt-region">
                                                                            </div>

                                                                        </div>

                                                                        <div class="col-lg-4 col-md-4 col-sm-12"> 

                                                                            <div class="row">
                                                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                                                    <p class="stat-header">Source of Complaint:</p>
                                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12" id="cvr-opt-complainant_source">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                                                    <p class="stat-header">Civil Status:</p>
                                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12" id="cvr-opt-civil_status">
                                                                                    </div>                                                                                  
                                                                                </div>    
                                                                            </div>

                                                                            <div class="row">                                                                                
                                                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                                                    <p class="stat-header">Sex:</p>
                                                                                    <div class="form-group col-12" id="cvr-opt-sex">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                                                    <p class="stat-header">Case Priority:</p>
                                                                                    <div class="form-group col-12" id="cvr-opt-case_priority">
                                                                                    </div>
                                                                                </div>                                                                                
                                                                            </div>

                                                                        </div>

                                                                        <br>
                                                                        <div class="col-12 mt-4 hide"> 
                                                                            <div class="row"> 
                                                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                                                    <p class="stat-header">Acts:</p>
                                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12" id="cvr-opt-tip_act">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                                                    <p class="stat-header">Means:</p>
                                                                                    <div class="form-group col-lg-12 colm-md-12 col-sm-12" id="cvr-opt-tip_mean">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                                                    <p class="stat-header">Purposes:</p>
                                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12" id="cvr-opt-tip_purpose">
                                                                                    </div>
                                                                                </div>                                                                                
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="row float-right" style="margin: 20px 10px;">
                                                    <button class="btn btn-primary-orange" id="btn-generate_report_casevictim">Generate</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Start result-->
                                    <div class="row" id="cvr-result" style="display: none;">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <!--SHOW MATCHES IN VALIDATING CASE-->
                                            <div class="inner-box  matched_results">
                                                <div class="row form-row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue" style="padding-left: 15px;">Generated Statistics and Report <span class="matched_count"></span>
                                                        <br>
                                                        <!--<small class="card-desc">Description here. </small>-->
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="card card-report">
                                                            <div class="card-header" style="padding: 20px; background: #fff;">                                                                
                                                                <div class="be-cvr_title_name" style="font-size: 15px;    color: #e88f15;">Trafficked Person per Age Group and Sex</div>
                                                                <small class="be-cvr_title_date"> As of June 2019 - July 2019</small>
                                                                <div class="row mgn-T-18 hide">
                                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                                        <p style="color: #356396;"> Criteria:</p>
                                                                    </div>
                                                                    <div class="col-lg-10 col-md-10 col-sm-12">
                                                                        <span class="d-inline-block fw-6">Age :</span><span class="d-inline-block padding-l-10">18 - 20 years old</span><br>
                                                                        <span class="d-inline-block fw-6">Sex :</span><span class="d-inline-block padding-l-10">Male and Female</span><br>
                                                                        <span class="d-inline-block fw-6">Country :</span><span class="d-inline-block padding-l-10">Saudi Arabia</span><br>
                                                                        <span class="d-inline-block fw-6">Period :</span><span class="d-inline-block padding-l-10">June 2019 - July 2019</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="" style="padding: 20px 20px;">
                                                                <div class="row ">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <!--Start Graph-->
                                                                        <div class="inner-box matched_contents container_graph">
                                                                            <div class="" style="padding: 20px 20px;">
                                                                                <p class="d-inline-block  blue fw-6">Graph: </p>
                                                                                <div class="" style="padding: 20px 20px;">
                                                                                    <div class="chartdiv" id="cvr-chartdiv"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!--End Graph-->

                                                                        <!--Start Tabular--> 
                                                                        <div class="inner-box matched_contents">   
                                                                            <div style="padding: 20px 20px;">
                                                                                <div class="float-right">                                                         
                                                                                    <button type="button" class="btn btn-info export_print_report" data-tab="cvr-result">
                                                                                        <i class="fa fa-print" aria-hidden="true"></i> Print 
                                                                                    </button>
                                                                                    <button type="button" class="btn btn-info export_download_report" data-tab="3">
                                                                                        <i class="fa fa-download" aria-hidden="true"></i> Download 
                                                                                    </button>
                                                                                </div>
                                                                                <p class="d-inline-block  blue fw-6">Tabular:</p>
                                                                                <div style="padding: 20px 20px">
                                                                                    <div class="victim-tabular">
                                                                                        <div class="row-header">
                                                                                            <div class="row row-header-border">
                                                                                                <div class="col-lg-4 col-md- col-sm-4 col-header">Date</div>
                                                                                                <div class="col-lg-4 col-md- col-sm-4 col-header be-cvr_title_name">-</div>
                                                                                                <div class="col-lg-4 col-md- col-sm-4 col-header">Count</div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="div-allcase-list1  case-list1" >
                                                                                            <ul class=" list_content" id="cvt-body">
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!--End Tabular-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End result-->

                                </div>
                                <!--End Case Victim Report-->

                                <!--Start Case Respondents Report-->
                                <div class="tab-pane fade p-4" id="case_respondents-con" role="tabpanel" aria-labelledby="case-respondents-tab" >

                                    <div class=" card-sub-title txt-W-500"> Generate Alleged Offender in Filed Report
                                        <br>
                                        <!--<small class="card-desc"> Details that related in alleged offender in filled report.  </small>-->
                                        <hr class="card-sub-title_border">
                                    </div>

                                    <div id="collapseCaseRespondents">
                                        <div class="card">
                                            <div class="card-header card-wrapper blue" id="headingCaseRespondents" data-toggle="collapse" data-target="#collapseCaseRespondentsFilter" aria-expanded="true" aria-controls="collapseOne">
                                                <div class=" card-sub-title txt-W-500"> Alleged Offender Details
                                                    <br>
                                                    <!--<small class="card-desc"> Generate service report based on the detail's of offenders.  </small>-->
                                                </div>
                                            </div>
                                            <div id="collapseCaseRespondentsFilter" class="collapse show" aria-labelledby="headingrespondents" data-parent="#collapseCaseRespondents">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <!--<div class="ribbon"><span>Base Report</span></div>-->
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <div class=" shadow-sm p-3 card-wrapper-report">
                                                                        <div class="row">
                                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                <p class="stat-header mb-3 txt-blue">Base Report</p>
                                                                                <label>Data Category:<font color="red"> <b>*</b> </font> </label>
                                                                                <select class="form-control wd-full" id="brcra-primary">
                                                                                    <option value="5">Alleged offender type</option> 
                                                                                    <option value="2">Local recruitment agency</option> 
                                                                                    <option value="3">Foreign recruitment agency</option> 
                                                                                    <option value="1">Employer</option> 
                                                                                    <!--<option value="4">Other</option>--> 
                                                                                </select>
                                                                                <div id="brcra-primary-error" class="error" style="display: none"> This field is required. </div>
                                                                            </div>
                                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                <label>Type of graph: <font color="red"> <b>*</b> </font></label>
                                                                                <select class="form-control  wd-full" id="brcra-rt"  >
                                                                                    <option value="1">Bar Graph - 3D </option> 
                                                                                    <option value="2">Pie Graph - Variable Height</option> 
                                                                                    <option value="3">Pie Chart - Variable Radius</option> 
                                                                                    <option value="4">Line Chart - Reverse Value Axis</option> 
                                                                                </select>
                                                                                <div id="brcra-rt-error" class="error" style="display: none"> This field is required. </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <!--<div class="ribbon"><span>Date Range</span></div>-->
                                                            <div class=" shadow-sm p-3 card-wrapper-report">
                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                    <div class="pt-2">   
                                                                        <p class="stat-header mb-3 txt-blue">Date Range</p>
                                                                        <p class="stat-header mb-0">Report Type: 
                                                                            <span id="cra-txt-report_type">Daily</span>
                                                                        </p>   
                                                                        <small>Options: Annual, quarterly, monthly, weekly and daily.</small>   
                                                                    </div>
                                                                    <div class="pt-3">   
                                                                        <label>Select Date Filled Report Range: </label>
                                                                        <input id="cra-reportrange" class="form-control daterangepicker-field"/>       
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><br>
                                                </div>
                                                <div class="row float-right mx-2 my-4">
                                                    <button class="btn btn-primary-orange" id="btn-generate_report_caserespondents">Generate</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Start result-->
                                    <div class="row" id="cra-result" style="display: none;">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <!--SHOW MATCHES IN VALIDATING CASE-->
                                            <div class="inner-box  matched_results">
                                                <div class="row form-row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue pl-3">Generated Statistics and Report <span class="matched_count"></span>
                                                        <br>
                                                        <!--<small class="card-desc">Description here. </small>-->
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="card card-report">
                                                            <div class="card-header p-4 bg-white">                                                                
                                                                <div class="be-cra_title_name text--15 text--orange">Trafficked Person per Age Group and Sex</div>
                                                                <small class="be-cra_title_date"> As of June 2019 - July 2019</small>
                                                                <div class="row mgn-T-18 hide">
                                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                                        <p  class="blue"> Criteria:</p>
                                                                    </div>
                                                                    <div class="col-lg-10 col-md-10 col-sm-12">
                                                                        <span class="d-inline-block fw-6">Age :</span><span class="d-inline-block padding-l-10">18 - 20 years old</span><br>
                                                                        <span class="d-inline-block fw-6">Sex :</span><span class="d-inline-block padding-l-10">Male and Female</span><br>
                                                                        <span class="d-inline-block fw-6">Country :</span><span class="d-inline-block padding-l-10">Saudi Arabia</span><br>
                                                                        <span class="d-inline-block fw-6">Period :</span><span class="d-inline-block padding-l-10">June 2019 - July 2019</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row ">
                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <!--Start Graph-->
                                                                    <div class="inner-box matched_contents container_graph">
                                                                        <div class="p-4">
                                                                            <p class="d-inline-block  blue fw-6">Graph: </p>
                                                                            <!--                                                                            <div class="p-4">-->
                                                                            <div class="chartdiv cra-chartdiv" id="cra-chartdiv"></div>
                                                                            <!--</div>-->
                                                                        </div>
                                                                    </div>
                                                                    <!--End Graph-->

                                                                    <!--Start Tabular--> 
                                                                    <div class="inner-box matched_contents">   
                                                                        <div class="p-4">
                                                                            <div class="float-right">        
                                                                                <button type="button" class="btn btn-info export_print_report" data-tab="cra-result">
                                                                                    <i class="fa fa-print" aria-hidden="true"></i> Print 
                                                                                </button>
                                                                                <button type="button" class="btn btn-info export_download_report" data-tab="3">
                                                                                    <i class="fa fa-download" aria-hidden="true"></i> Download 
                                                                                </button>
                                                                            </div>
                                                                            <p class="d-inline-block  blue fw-6">Tabular:</p>
                                                                            <div class="p-4">
                                                                                <div class="respondents-tabular">
                                                                                    <div class="row-header">
                                                                                        <div class="row row-header-border">
                                                                                            <div class="col-lg-4 col-md- col-sm-4 col-header ">Date</div>
                                                                                            <div class="col-lg-4 col-md- col-sm-4 col-header text-align_center be-cra_title_name">-</div>
                                                                                            <div class="col-lg-4 col-md- col-sm-4 col-header text-align_center m-auto">Count</div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="div-allcase-list1  case-list1" >
                                                                                        <ul class="list_content" id="cra-body">
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--End Tabular-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End result-->

                                </div>
                                <!--End Case Respondents Report-->

                                <!--Start Case Services Report-->
                                <div class="tab-pane fade p-4" id="case_services-con" role="tabpanel" aria-labelledby="case-services-tab" >

                                    <div class=" card-sub-title txt-W-500"> Generate Services Report
                                        <br>
                                        <!--<small class="card-desc"> Details that related in services report.  </small>-->
                                        <hr class="card-sub-title_border">
                                    </div>

                                    <div id="collapseCaseServices">
                                        <div class="card">
                                            <div class="card-header card-wrapper blue" id="headingCaseServices" data-toggle="collapse" data-target="#collapseCaseServicesFilter" aria-expanded="true" aria-controls="collapseOne">
                                                <div class=" card-sub-title txt-W-500"> Services Report Details
                                                    <br>
                                                    <!--<small class="card-desc">  Generate service report based on the detail's of case services.  </small>-->
                                                </div>
                                            </div>
                                            <div id="collapseCaseServicesFilter" class="collapse show" data-parent="#collapseCaseServices">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <!--<div class="ribbon"><span>Base Report</span></div>-->
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <div class=" shadow-sm p-3 card-wrapper-report">
                                                                        <div class="row">
                                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12 pt-5" style="display: none">
                                                                                <label>Base type of report: <font color="red"> <b>*</b> </font> </label>
                                                                                <select class="form-control wd-full" id="brcs-base_type_report" disabled>
                                                                                </select>
                                                                                <div id="brcs-type_report-error" class="error" style="display: none"> This field is required. </div>
                                                                            </div>
                                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                <p class="stat-header mb-3 txt-blue">Base Report</p>
                                                                                <label>Data Category:<font color="red"> <b>*</b> </font> </label>
                                                                                <select class="form-control wd-full" id="brcs-primary" disabled>
                                                                                    <option value="1">Agency</option> 
                                                                                    <option value="1">Service</option> 
                                                                                </select>
                                                                                <div id="brcs-primary-error" class="error" style="display: none"> This field is required. </div>
                                                                            </div>
                                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                <label>Type of graph: <font color="red"> <b>*</b> </font></label>
                                                                                <select class="form-control  wd-full" id="brcs-rt"  >
                                                                                    <option value="1">Bar Graph - 3D </option> 
                                                                                    <option value="2">Pie Graph - Variable Height</option> 
                                                                                    <option value="3">Pie Chart - Variable Radius</option> 
                                                                                    <option value="4">Line Chart - Reverse Value Axis</option> 
                                                                                </select>
                                                                                <div id="brcs-rt-error" class="error" style="display: none"> This field is required. </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <!--<div class="ribbon"><span>Date Range</span></div>-->
                                                            <div class=" shadow-sm p-3 card-wrapper-report">
                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                    <div class="pt-2">   
                                                                        <p class="stat-header mb-3 txt-blue">Date Range</p>
                                                                        <p class="stat-header mb-0">Report Type: 
                                                                            <span id="cs-txt-report_type">Daily</span>
                                                                        </p>    
                                                                        <small>Options: Annual, quarterly, monthly, weekly and daily.</small>   
                                                                    </div>
                                                                    <div class="pt-3">   
                                                                        <label>Select Date Created Service Range: </label>
                                                                        <input id="cs-reportrange" class="form-control daterangepicker-field"/>       
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><br>

                                                    <div class="row" style="display: none;">                                                        
                                                        <!--start left criteria-->
                                                        <div class="col-12">
                                                            <div class="ribbon"><span>Report Details</span></div> 
                                                            <div class="shadow-sm p-3 card-wrapper-report pt-5">
                                                                <div class="container">
                                                                    <div class="row">



                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="row float-right mx-2 my-4">
                                                    <button class="btn btn-primary-orange" id="btn-generate_report_caseservices">Generate</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Start result-->
                                    <div class="row" id="cs-result" style="display: none;">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <!--SHOW MATCHES IN VALIDATING CASE-->
                                            <div class="inner-box  matched_results">
                                                <div class="row form-row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue pl-3">Generated Statistics and Report <span class="matched_count"></span>
                                                        <br>
                                                        <!--<small class="card-desc">Description here. </small>-->
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="card card-report">
                                                            <div class="card-header p-4 bg-white">                                                                
                                                                <div class="be-cs_title_name text--15 text--orange">Trafficked Person per Age Group and Sex</div>
                                                                <small class="be-cs_title_date"> As of June 2019 - July 2019</small>
                                                                <div class="row mgn-T-18 hide">
                                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                                        <p  class="blue"> Criteria:</p>
                                                                    </div>
                                                                    <div class="col-lg-10 col-md-10 col-sm-12">
                                                                        <span class="d-inline-block fw-6">Age :</span><span class="d-inline-block padding-l-10">18 - 20 years old</span><br>
                                                                        <span class="d-inline-block fw-6">Sex :</span><span class="d-inline-block padding-l-10">Male and Female</span><br>
                                                                        <span class="d-inline-block fw-6">Country :</span><span class="d-inline-block padding-l-10">Saudi Arabia</span><br>
                                                                        <span class="d-inline-block fw-6">Period :</span><span class="d-inline-block padding-l-10">June 2019 - July 2019</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row ">
                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <!--Start Graph-->
                                                                    <div class="inner-box matched_contents container_graph">
                                                                        <div class="p-4">
                                                                            <p class="d-inline-block  blue fw-6">Graph: </p>
                                                                            <!--                                                                            <div class="p-4">-->
                                                                            <div class="chartdiv cs-chartdiv" id="cs-chartdiv"></div>
                                                                            <!--</div>-->
                                                                        </div>
                                                                    </div>
                                                                    <!--End Graph-->

                                                                    <!--Start Tabular--> 
                                                                    <div class="inner-box matched_contents">   
                                                                        <div class="p-4">
                                                                            <div class="float-right">        
                                                                                <button type="button" class="btn btn-info export_print_report" data-tab="cs-result">
                                                                                    <i class="fa fa-print" aria-hidden="true"></i> Print 
                                                                                </button>
                                                                                <button type="button" class="btn btn-info export_download_report" data-tab="3">
                                                                                    <i class="fa fa-download" aria-hidden="true"></i> Download 
                                                                                </button>
                                                                            </div>
                                                                            <p class="d-inline-block  blue fw-6">Tabular:</p>
                                                                            <div class="p-4">
                                                                                <div class="victim-tabular">
                                                                                    <div class="row-header">
                                                                                        <div class="row row-header-border">
                                                                                            <div class="col-4 col-header ">Date</div>
                                                                                            <div class="col-4 col-header text-align_center be-cs_title_name">-</div>
                                                                                            <div class="col-4 col-header text-align_center m-auto">Count</div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="div-allcase-list1  case-list1" >
                                                                                        <ul class=" list_content" id="cst-body">
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--End Tabular-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End result-->

                                </div>
                                <!--End Case Services Report-->

                                <!--Start Case Services Aging Report-->
                                <div class="tab-pane fade p-4" id="case_services_aging-con" role="tabpanel" aria-labelledby="case-services_aging-tab" >

                                    <div class=" card-sub-title txt-W-500"> Generate Services Aging Report
                                        <br>
                                        <!--<small class="card-desc"> Details that related in services aging report.  </small>-->
                                        <hr class="card-sub-title_border">
                                    </div>

                                    <div id="collapseCaseServicesAging">
                                        <div class="card">
                                            <div class="card-header card-wrapper blue" id="headingCaseServicesAging" data-toggle="collapse" data-target="#collapseCaseServicesAgingFilter" aria-expanded="true" aria-controls="collapseOne">
                                                <div class=" card-sub-title txt-W-500"> Services Aging Report Details
                                                    <br>
                                                    <!--<small class="card-desc"> Generate service report based on the detail's of case services. </small>-->
                                                </div>
                                            </div>
                                            <div id="collapseCaseServicesAgingFilter" class="collapse show" data-parent="#collapseCaseServicesAging">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <!--<div class="ribbon"><span>Base Report</span></div>-->
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <div class=" shadow-sm p-3 card-wrapper-report">
                                                                        <div class="row">
                                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12 pt-5" style="display: none">
                                                                                <label>Base type of report: <font color="red"> <b>*</b> </font> </label>
                                                                                <select class="form-control wd-full" id="brcsa-base_type_report" disabled>
                                                                                </select>
                                                                                <div id="brcsa-type_report-error" class="error" style="display: none"> This field is required. </div>
                                                                            </div>
                                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                <p class="stat-header mb-3 txt-blue">Base Report</p>
                                                                                <label>Data Category:<font color="red"> <b>*</b> </font> </label>
                                                                                <select class="form-control wd-full" id="brcsa-primary" disabled>
                                                                                    <option value="1">Agency</option> 
                                                                                    <option value="1">Service</option> 
                                                                                </select>
                                                                                <div id="brcsa-primary-error" class="error" style="display: none"> This field is required. </div>
                                                                            </div>
                                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                <label>Type of graph: <font color="red"> <b>*</b> </font></label>
                                                                                <select class="form-control  wd-full" id="brcsa-rt"  >
                                                                                    <option value="1">Bar Graph - 3D </option> 
                                                                                    <option value="2">Pie Graph - Variable Height</option> 
                                                                                    <option value="3">Pie Chart - Variable Radius</option> 
                                                                                    <option value="4">Line Chart - Reverse Value Axis</option> 
                                                                                </select>
                                                                                <div id="brcsa-rt-error" class="error" style="display: none"> This field is required. </div>
                                                                            </div>
                                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12" >
                                                                                <label>Agency: </label>
                                                                                <select class="form-control sel_agency  wd-full" data-key="brcsa" id="brcsa-agency"  disabled>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12 c-brcsa-agency_branch" style="display: none">
                                                                                <label>Agency Branch: </label>
                                                                                <select class="form-control wd-full" id="brcsa-agency_branch"  >
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <!--<div class="ribbon"><span>Date Range</span></div>-->
                                                            <div class=" shadow-sm p-3 card-wrapper-report">
                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                    <div class="pt-2">   
                                                                        <p class="stat-header mb-3 txt-blue">Date Range</p>
                                                                        <p class="stat-header mb-0">Report Type: 
                                                                            <span id="csa-txt-report_type">Daily</span>
                                                                        </p>    
                                                                        <small>Options: Annual, quarterly, monthly, weekly and daily.</small>   
                                                                    </div>
                                                                    <div class="pt-3">   
                                                                        <label>Select Date Created Service Range: </label>
                                                                        <input id="csa-reportrange" class="form-control daterangepicker-field"/>       
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><br>

                                                    <div class="row" style="display: none;">                                                        
                                                        <!--start left criteria-->
                                                        <div class="col-12">
                                                            <div class="ribbon"><span>Report Details</span></div> 
                                                            <div class="shadow-sm p-3 card-wrapper-report pt-5">
                                                                <div class="container">
                                                                    <div class="row">



                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="row float-right mx-2 my-4">
                                                    <button class="btn btn-primary-orange" id="btn-generate_report_caseservicesaging">Generate</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Start result-->
                                    <div class="row" id="csa-result" style="display: none;">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <!--SHOW MATCHES IN VALIDATING CASE-->
                                            <div class="inner-box  matched_results">
                                                <div class="row form-row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue pl-3">Generated Statistics and Report <span class="matched_count"></span>
                                                        <br>
                                                        <!--<small class="card-desc">Description here. </small>-->
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="card card-report">
                                                            <div class="card-header p-4 bg-white">                                                                
                                                                <div class="be-csa_title_name text--15 text--orange">Trafficked Person per Age Group and Sex</div>
                                                                <small class="be-csa_title_date"> As of June 2019 - July 2019</small>
                                                                <div class="row mgn-T-18 hide">
                                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                                        <p  class="blue"> Criteria:</p>
                                                                    </div>
                                                                    <div class="col-lg-10 col-md-10 col-sm-12">
                                                                        <span class="d-inline-block fw-6">Age :</span><span class="d-inline-block padding-l-10">18 - 20 years old</span><br>
                                                                        <span class="d-inline-block fw-6">Sex :</span><span class="d-inline-block padding-l-10">Male and Female</span><br>
                                                                        <span class="d-inline-block fw-6">Country :</span><span class="d-inline-block padding-l-10">Saudi Arabia</span><br>
                                                                        <span class="d-inline-block fw-6">Period :</span><span class="d-inline-block padding-l-10">June 2019 - July 2019</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row ">
                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <!--Start Graph-->
                                                                    <div class="inner-box matched_contents container_graph">
                                                                        <div class="p-4">
                                                                            <p class="d-inline-block  blue fw-6">Graph: </p>
                                                                            <!--                                                                            <div class="p-4">-->
                                                                            <div class="chartdiv csa-chartdiv" id="csa-chartdiv"></div>
                                                                            <!--</div>-->
                                                                        </div>
                                                                    </div>
                                                                    <!--End Graph-->

                                                                    <!--Start Tabular--> 
                                                                    <div class="inner-box matched_contents">   
                                                                        <div class="p-4">
                                                                            <div class="float-right">        
                                                                                <button type="button" class="btn btn-info export_print_report" data-tab="csa-result">
                                                                                    <i class="fa fa-print" aria-hidden="true"></i> Print 
                                                                                </button>
                                                                                <button type="button" class="btn btn-info export_download_report" data-tab="3">
                                                                                    <i class="fa fa-download" aria-hidden="true"></i> Download 
                                                                                </button>
                                                                            </div>
                                                                            <p class="d-inline-block  blue fw-6">Tabular:</p>
                                                                            <div class="p-4">
                                                                                <div class="victim-tabular">
                                                                                    <div class="row-header">
                                                                                        <div class="row row-header-border">
                                                                                            <div class="col-4 col-header ">Date</div>
                                                                                            <div class="col-4 col-header text-align_center be-csa_title_name">-</div>
                                                                                            <div class="col-4 col-header text-align_center m-auto">Count</div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="div-allcase-list1  case-list1" >
                                                                                        <ul class=" list_content" id="csat-body">
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--End Tabular-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End result-->

                                </div>
                                <!--End Case Services Aging Report-->

                                <!--Start Report for Minor-->
                                <div class="tab-pane fade" id="report_minor-con" role="tabpanel" aria-labelledby="case-victim-tab" style="padding:20px;">

                                    <div class=" card-sub-title txt-W-500"> Generate Report for Minor
                                        <br>
                                        <small class="card-desc"> Details that related in filled report for minor.  </small>
                                        <hr class="card-sub-title_border">
                                    </div>

                                    <div id="collapseReportMinor">
                                        <div class="card">
                                            <div class="card-header card-wrapper blue" id="headingReportMinor" data-toggle="collapse" data-target="#collapseReportMinorFilter" aria-expanded="true" aria-controls="collapseOne">
                                                <div class=" card-sub-title txt-W-500"> Report Details 
                                                    <br>
                                                    <!--<small class="card-desc"> Generate report based from filed report. </small>-->
                                                </div>
                                            </div>
                                            <div id="collapseReportMinorFilter" class="collapse show" aria-labelledby="headingReportMinor" data-parent="#collapseReportMinor">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <!--<div class="ribbon"><span>Base Report</span></div>-->
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <div class=" shadow-sm p-3 card-wrapper-report">
                                                                        <div class="row">                                                                            
                                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                <p class="stat-header mb-3 txt-blue">Base Report</p>
                                                                                <label>Data Category:<font color="red"> <b>*</b> </font> </label>
                                                                                <select class="form-control wd-full" id="brrm-primary"  >
                                                                                </select>
                                                                                <div id="brrm-primary-error" class="error" style="display: none"> This field is required. </div>
                                                                            </div>
                                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                <label>Type of graph: <font color="red"> <b>*</b> </font></label>
                                                                                <select class="form-control" id="brrm-rt" style="width: 100%;">
                                                                                    <option value="1">Bar Graph - 3D </option> 
                                                                                    <option value="2">Pie Graph - Variable Height</option> 
                                                                                    <option value="3">Pie Chart - Variable Radius</option> 
                                                                                    <option value="4">Line Chart - Reverse Value Axis</option> 
                                                                                </select>
                                                                                <div id="brrm-rt-error" class="error" style="display: none"> This field is required. </div>
                                                                            </div>                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <!--<div class="ribbon"><span>Date Range</span></div>-->
                                                            <div class=" shadow-sm p-3 card-wrapper-report">
                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                    <div class="pt-2">   
                                                                        <p class="stat-header mb-3 txt-blue">Date Range</p>
                                                                        <p class="stat-header">Report Type: 
                                                                            <span id="rm-txt-report_type">Daily</span>
                                                                        </p>    
                                                                        <small>Options: Annual, quarterly, monthly, weekly and daily.</small>      
                                                                    </div>
                                                                    <div class="pt-3">      
                                                                        <label>Select Date Deployment Range: </label>
                                                                        <input id="rm-reportrange" class="form-control daterangepicker-field"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><br>

                                                    <div class="row">                                                        
                                                        <!--start left criteria-->
                                                        <div class="col-12">
                                                            <div class="ribbon"><span>Report Details</span></div> 
                                                            <div class="shadow-sm p-3 card-wrapper-report pt-5">
                                                                <div class="container">
                                                                    <div class="row">

                                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                                            <p class="stat-header">Country:</p>
                                                                            <div class="container" style="max-height: 300px; overflow-y: scroll">
                                                                                <div class="form-group " id="rm-opt-country">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                                            <p class="stat-header">Sex:</p>
                                                                            <div class="form-group col-12" id="rm-opt-sex">
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="row float-right" style="margin: 20px 10px;">
                                                    <button class="btn btn-primary-orange" id="btn-generate_report_minor">Generate</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Start result-->
                                    <div class="row" id="rmr-result" style="display: none;">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <!--SHOW MATCHES IN VALIDATING CASE-->
                                            <div class="inner-box  matched_results">
                                                <div class="row form-row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue" style="padding-left: 15px;">Generated Statistics and Report <span class="matched_count"></span>
                                                        <br>
                                                        <!--<small class="card-desc">Description here. </small>-->
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="card card-report">
                                                            <div class="card-header" style="padding: 20px; background: #fff;">                                                               
                                                                <div class="be-rm_title_name" style="font-size: 15px;    color: #e88f15;">Trafficked Person per Age Group and Sex</div>
                                                                <small class="be-rm_title_date"> As of June 2019 - July 2019</small>
                                                                <div class="row mgn-T-18 hide">
                                                                    <div class="col-lg-2 col-md-2 col-sm-2">    
                                                                        <p style="color: #356396;"> Criteria:</p>
                                                                    </div>
                                                                    <div class="col-lg-10 col-md-10 col-sm-12">
                                                                        <span class="d-inline-block fw-6">Age :</span><span class="d-inline-block padding-l-10">18 - 20 years old</span><br>
                                                                        <span class="d-inline-block fw-6">Sex :</span><span class="d-inline-block padding-l-10">Male and Female</span><br>
                                                                        <span class="d-inline-block fw-6">Country :</span><span class="d-inline-block padding-l-10">Saudi Arabia</span><br>
                                                                        <span class="d-inline-block fw-6">Period :</span><span class="d-inline-block padding-l-10">June 2019 - July 2019</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="" style="padding: 20px 20px;">
                                                                <div class="row ">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <!--Start Graph-->
                                                                        <div class="inner-box matched_contents container_graph">
                                                                            <div class="" style="padding: 20px 20px;">
                                                                                <p class="d-inline-block  blue fw-6">Graph: </p>
                                                                                <div class="" style="padding: 20px 20px;">
                                                                                    <div class="chartdiv" id="rmr-chartdiv"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!--End Graph-->

                                                                        <!--Start Tabular--> 
                                                                        <div class="inner-box matched_contents">   
                                                                            <div style="padding: 20px 20px;">
                                                                                <div class="float-right">                                                         
                                                                                    <button type="button" class="btn btn-info export_print_report" data-tab="rmr-result">
                                                                                        <i class="fa fa-print" aria-hidden="true"></i> Print 
                                                                                    </button>
                                                                                    <button type="button" class="btn btn-info export_download_report" data-tab="4">
                                                                                        <i class="fa fa-download" aria-hidden="true"></i> Download 
                                                                                    </button>
                                                                                </div>
                                                                                <p class="d-inline-block  blue fw-6">Tabular:</p>                                                                               
                                                                                <div style="padding: 20px 20px">
                                                                                    <div class="minor-tabular">
                                                                                        <div class="row-header">
                                                                                            <div class="row row-header-border">
                                                                                                <div class="col-lg-4 col-md- col-sm-4 col-header">Date</div>
                                                                                                <div class="col-lg-4 col-md- col-sm-4 col-header be-cvr_title_name">-</div>
                                                                                                <div class="col-lg-4 col-md- col-sm-4 col-header">Count</div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="div-allcase-list1  case-list1" >
                                                                                            <ul class=" list_content" id="rmt-body">
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!--End Tabular-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End result-->
                                </div>
                                <!--End Report for Minor-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div> 
</div> 


<!--====================== export tabular section ======================-->
<div id="tabular-content-print" class="hide">
</div>