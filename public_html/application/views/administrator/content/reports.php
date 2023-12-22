
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
        <div class="mt-content-body">
            <div class="row container-padding" >
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card" style="padding-bottom: 50px !important;">
                        <div class="row"> 
                            <div class="col-lg-12 col-md-12 col-sm-12" > 
                                    <span class="text-left content-title"><a>Reports and Analytics</a></span><br>
                                    <small class="content-desc">Graph, Charts and Statistics</small>
                            </div>
                        </div>
                        <div class="collapse-body-content" style="padding: 15px;">
                          
                            <div class="page-body-container " style=" margin: 0px 30px 50px 30px;">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">

                                        <div class="d-flex justify-content-between bd-highlight">
                                            <div class="bd-highlight">  <div class=" card-sub-title " style="  color: #333538;display: inline-block;"> RECOMMENDED REPORTS<br> 
                                                </div></div>
                                            <div class="bd-highlight">
                                                  <!--<a class="btn btn-primary-orange btn-next" href="<?php echo SITE_URL ?>reports_sub_page">Choose Report to Generate</a>-->
                                                <a class="btn btn-primary-orange " href="<?php echo SITE_URL ?>generate_report"  role="button">Choose Report to Generate</a>
                                                <!--<a type="submit" class="btn btn-primary-orange btn-next " href="<?php echo SITE_URL ?>reports_sub_page" style="margin-left:0px;">Choose Report to Generate</a>-->
                                                <!--                                                <button type="submit" class="btn btn-primary-orange btn-next float-right" data-toggle="dropdown"  id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false" style="margin-left:0px;display: inline-block;">Choose Report to generate</button>
                                                
                                                
                                                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                                                    <div class="row">
                                                                                                        <div class="col-lg-6">
                                                                                                            <span class=" bold" > Trafficked Person</span>
                                                                                                            <a class="dropdown-item" href="#">By Age Group and  Trafficked Purpose</a>
                                                                                                            <a class="dropdown-item" href="#">By Educational Attainment And Sex</a>
                                                                                                            <a class="dropdown-item" href="#">Place of origin</a>
                                                                                                            <a class="dropdown-item" href="#">Civil Status</a>
                                                                                                            <a class="dropdown-item" href="#">Educational Attainment</a>
                                                                                                        </div>
                                                                                                        <div class="col-lg-6">
                                                                                                            <span class=" bold" > Trafficked Person</span>
                                                                                                            <a class="dropdown-item" href="#">By Age Group and  Trafficked Purpose</a>
                                                                                                            <a class="dropdown-item" href="#">By Educational Attainment And Sex</a>
                                                                                                            <a class="dropdown-item" href="#">Place of origin</a>
                                                                                                            <a class="dropdown-item" href="#">Civil Status</a>
                                                                                                            <a class="dropdown-item" href="#">Educational Attainment</a>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="row">
                                                                                                        <div class="col-lg-6">
                                                                                                            <span class=" bold" > Trafficked Person</span>
                                                                                                            <a class="dropdown-item" href="#">By Age Group and  Trafficked Purpose</a>
                                                                                                            <a class="dropdown-item" href="#">By Educational Attainment And Sex</a>
                                                                                                            <a class="dropdown-item" href="#">Place of origin</a>
                                                                                                            <a class="dropdown-item" href="#">Civil Status</a>
                                                                                                            <a class="dropdown-item" href="#">Educational Attainment</a>
                                                                                                        </div>
                                                                                                        <div class="col-lg-6">
                                                                                                            <span class=" bold" > Trafficked Person</span>
                                                                                                            <a class="dropdown-item" href="#">By Age Group and  Trafficked Purpose</a>
                                                                                                            <a class="dropdown-item" href="#">By Educational Attainment And Sex</a>
                                                                                                            <a class="dropdown-item" href="#">Place of origin</a>
                                                                                                            <a class="dropdown-item" href="#">Civil Status</a>
                                                                                                            <a class="dropdown-item" href="#">Educational Attainment</a>
                                                                                                        </div>
                                                                                                    </div>
                                                
                                                                                                </div>-->
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="card">
                                    <div class="row">
                                        <div class="col-lg-4">

                                            <div class="card card-report">

                                                <div class="card-header" style="    padding: 20px;
                                                     background: #f8f9fc;">
                                                    <div class="" style="   font-size: 15px;    color: #e88f15;">Trafficked Person per Month</div>
                                                    <small> As of June 2019 - July 2019</small>
                                                </div>
                                                <div class="" style="    padding: 20px 20px;">
                                                    <canvas id="myChart"></canvas>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="col-lg-4"> 
                                            <div class="card card-report">

                                                <div class="card-header" style="    padding: 20px;
                                                     background: #f8f9fc;">
                                                    <div class="" style="   font-size: 15px;    color: #e88f15;">Trafficked Person per Year</div>
                                                    <small> As of June 2019 - July 2019</small>
                                                </div>
                                                <div class="" style="    padding: 20px 20px;">
                                                    <div id="chartdiv"></div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="card card-report">

                                                <div class="card-header" style="    padding: 20px;
                                                     background: #f8f9fc;">
                                                    <div class="" style="   font-size: 15px;    color: #e88f15;">Trafficked Person per Agency</div>
                                                    <small> As of June 2019 - July 2019</small>
                                                </div>
                                                <div class="" style="    padding: 20px 20px;">
                                                    <div id="piegraph"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="row">
                                        <div class="col-lg-4">

                                            <div class="card card-report">

                                                <div class="card-header" style="    padding: 20px;
                                                     background: #f8f9fc;">
                                                    <div class="" style="   font-size: 15px;    color: #e88f15;">Trafficked Person per Age Group</div>
                                                    <small> As of June 2019 - July 2019</small>
                                                </div>
                                                <div class="" style="    padding: 20px 20px;">
                                                    <div id="clusteredbarchart"></div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="col-lg-4"> 
                                            <div class="card card-report">

                                                <div class="card-header" style="    padding: 20px;
                                                     background: #f8f9fc;">
                                                    <div class="" style="   font-size: 15px;    color: #e88f15;">Trafficked Person per Sex</div>
                                                    <small> As of June 2019 - July 2019</small>
                                                </div>
                                                <div class="" style="    padding: 20px 20px;">
                                                    <div id="columnchart"></div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <!--                                        <div class="card card-report">
                                            
                                                                                        <div class="card-header" style="    padding: 20px;
                                                                                             background: #f8f9fc;">
                                                                                            <div class="" style="   font-size: 15px;    color: #e88f15;">Trafficked Person per Agency</div>
                                                                                            <small> As of June 2019 - July 2019</small>
                                                                                        </div>
                                                                                        <div class="" style="    padding: 20px 20px;">
                                                                                            <div id="piegraph"></div>
                                                                                        </div>
                                                                                    </div>-->
                                        </div>
                                    </div>
                                </div>





                                <div id="validate-details hide" class="content" role="tabpanel" aria-labelledby="validate-details-trigger" style="display:none;padding-left:0px;">

                                    <div class="row">
                                        <div class="col-lg-4" style="padding-left:0px !important;    border: 1px solid #adb5bd;">
                                            <div class="accordion" id="accordionExample">
                                                <div class="card">
                                                    <div class="card-header" id="headingOne">
                                                        <h2 class="mb-0">
                                                            <button class="btn btn-link btn-collapsible" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                Trafficked Person
                                                            </button>
                                                        </h2>
                                                    </div>
                                                    <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample" style="border-bottom: 1px solid #adb5bd;">
                                                        <div class="card-body">

                                                            <div class="list-group" >
                                                                <a  class="list-group-item list-group-item-action"  data-toggle="pill10" href="<?php echo SITE_URL ?>reports_sub_page" role="tab" aria-selected="false" > <span>By Age group and  Sex </span><span class="float-right "><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
                                                                <a href="<?php echo SITE_URL ?>" class="list-group-item list-group-item-action">  <span>By Age Group and  Trafficked Purpose  </span><span class="float-right"><i class="fa fa-chevron-right " aria-hidden="true"></i></span></a>
                                                                <a href="<?php echo SITE_URL ?>" class="list-group-item list-group-item-action ">  <span> By Educational Attainment And Sex  </span><span class="float-right"><i class="fa fa-chevron-right " aria-hidden="true"></i></span></a>
                                                                <a href="<?php echo SITE_URL ?>" class="list-group-item list-group-item-action ">  <span>Place of origin  </span><span class="float-right"><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
                                                                <a href="<?php echo SITE_URL ?>" class="list-group-item list-group-item-action ">  <span>Civil Status  </span><span class="float-right"><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
                                                                <a href="<?php echo SITE_URL ?>" class="list-group-item list-group-item-action "> <span>Educational Attainment </span><span class="float-right"><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingTwo">
                                                        <h2 class="mb-0">
                                                            <button class="btn btn-link collapsed btn-collapsible" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                Case Details
                                                            </button>
                                                        </h2>
                                                    </div>
                                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample" style="border-bottom: 1px solid #adb5bd;">
                                                        <div class="card-body">
                                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingThree">
                                                        <h2 class="mb-0">
                                                            <button class="btn btn-link collapsed btn-collapsible" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                Employment Details
                                                            </button>
                                                        </h2>
                                                    </div>
                                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample" style="border-bottom: 1px solid #adb5bd;">
                                                        <div class="card-body">
                                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingThree">
                                                        <h2 class="mb-0">
                                                            <button class="btn btn-link collapsed btn-collapsible" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                Agency Reports
                                                            </button>
                                                        </h2>
                                                    </div>
                                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample" style="border-bottom: 1px solid #adb5bd;">
                                                        <div class="card-body">
                                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8" style="padding-left:0px !important;    border: 1px solid #adb5bd;">

                                        </div>
                                    </div>



                                    <div class="row" style="margin-top:50px;">
                                        <div class="col-lg-6">
                                            <div class="card" >
                                                <div class="" style="margin-bottom:20px;    font-size: 15px;">Trafficked Person</div>
                                                <div class="list-group" style="padding:20px;background:#dee2e6">
                                                    <a  class="list-group-item list-group-item-action"  data-toggle="pill10" href="<?php echo SITE_URL ?>reports_sub_page" role="tab" aria-selected="false" >            <span class="report_icon1"><i class="fa fa-transgender" aria-hidden="true"></i></span>By Age group and  Sex</a>
                                                    <a href="<?php echo SITE_URL ?>" class="list-group-item list-group-item-action">  <span class="report_icon1"><i class="fa fa-transgender" aria-hidden="true"></i></span>By Age Group and  Trafficked Purpose</a>
                                                    <a href="<?php echo SITE_URL ?>" class="list-group-item list-group-item-action ">  <span class="report_icon1"><i class="fa fa-transgender" aria-hidden="true"></i></span>By Educational Attainment And Sex</a>
                                                    <a href="<?php echo SITE_URL ?>" class="list-group-item list-group-item-action ">  <span class="report_icon1"><i class="fa fa-transgender" aria-hidden="true"></i></span>Place of origin</a>
                                                    <a href="<?php echo SITE_URL ?>" class="list-group-item list-group-item-action ">  <span class="report_icon1"><i class="fa fa-transgender" aria-hidden="true"></i></span>Civil Status</a>
                                                    <a href="<?php echo SITE_URL ?>" class="list-group-item list-group-item-action ">  <span class="report_icon1"><i class="fa fa-transgender" aria-hidden="true"></i></span>Educational Attainment</a>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card" >
                                                <div class="" style="margin-bottom:20px;    font-size: 15px;">Employment</div>
                                                <div class="list-group" style="padding:20px;background:#dee2e6">
                                                    <a href="#" class="list-group-item list-group-item-action ">  <span class="report_icon1"><i class="fa fa-transgender" aria-hidden="true"></i></span> By Place of Designation</a>
                                                    <a href="#" class="list-group-item list-group-item-action">  <span class="report_icon1"><i class="fa fa-transgender" aria-hidden="true"></i></span>By Migration History</a>
                                                    <a href="#" class="list-group-item list-group-item-action ">  <span class="report_icon1"><i class="fa fa-transgender" aria-hidden="true"></i></span>Falsified Documents</a>
                                                    <a href="#" class="list-group-item list-group-item-action ">  <span class="report_icon1"><i class="fa fa-transgender" aria-hidden="true"></i></span>Illegal Recruitment</a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card" >
                                                <div class="" style="margin-bottom:20px;    font-size: 15px;">Case Details</div>
                                                <div class="list-group" style="padding:20px;background:#dee2e6">
                                                    <a href="#" class="list-group-item list-group-item-action">  <span class="report_icon1"><i class="fa fa-transgender" aria-hidden="true"></i></span>By Exploitative purpose</a>


                                                    <a href="#" class="list-group-item list-group-item-action "> <span class="report_icon1"><i class="fa fa-transgender" aria-hidden="true"></i></span>By Means</a>
                                                    <a href="#" class="list-group-item list-group-item-action">  <span class="report_icon1"><i class="fa fa-transgender" aria-hidden="true"></i></span>By Acts</a>
                                                    <a href="#" class="list-group-item list-group-item-action ">  <span class="report_icon1"><i class="fa fa-transgender" aria-hidden="true"></i></span>By Services Provided</a>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card" >
                                                <div class="" style="margin-bottom:20px;    font-size: 15px;">Agency Reports</div>
                                                <div class="list-group" style="padding:20px;background:#dee2e6">
                                                    <a href="#" class="list-group-item list-group-item-action">  <span class="report_icon1"><i class="fa fa-transgender" aria-hidden="true"></i></span> Services Provided per Agency / per Month report</a>
                                                    <a href="#" class="list-group-item list-group-item-action ">            <span class="report_icon1"><i class="fa fa-transgender" aria-hidden="true"></i></span> By Type of Services Provided</a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--                                    <div class=" card-sub-title txt-W-500"> Validate Victim Details
                                                                            <br>
                                                                            <small class="card-desc"> Provide the details to check if the case is already existing </small>
                                                                        </div>-->

                                    <!--                                    <div class="form-actions">
                                                                            <div class="row">
                                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                    <div style=" float: right;">
                                                                                        <button type="submit" class="form-control btn btn-secondary-grey btn-validate">Validate</button>
                                                                                        <button type="submit" class="btn btn-secondary-light_blue float-right btn-validate">Validate</button>
                                    
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>-->

                                    <hr>
                                    <div class="content-footer float-right  match-buttons">

                                        <button type="submit" class="btn btn-primary-orange btn-next btn-next_tab" data-tab="victims" style="margin-left: 0px; display: none;">Next</button>
                                    </div>
                                </div>

                                <div class="div-list hide">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class=" card-sub-title "> Victim Details<br> 
                                              <!--<small class="card-desc"> Provide the details to check if the case is already existing </small>--> 
                                            </div>


                                            <div class="feature-small-container fade-in animation-delay__7">
                                                <div class="feature-small">
                                                    <div class="feature-icon">
                                                        <span class="report_icon" style=" font-size: 28px;">18+</span>
                                                    </div>
                                                    <h4 class="subtitle subtitle__small">Age</h4>
                                                    <p class="description description__small">Chart.js is a community maintained project, contributions welcome!</p>
                                                </div>
                                                <div class="feature-small">
                                                    <div class="feature-icon">
                                                        <span class="report_icon"><i class="fa fa-transgender" aria-hidden="true"></i></span>
                                                    </div>
                                                    <h4 class="subtitle subtitle__small">Education</h4>
                                                    <p class="description description__small">Visualize your data in 8 different ways; each of them animated and customisable.</p>
                                                </div>
                                                <div class="feature-small">
                                                    <div class="feature-icon">
                                                        <span class="report_icon"><i class="fa fa-transgender" aria-hidden="true"></i></span>
                                                    </div>
                                                    <h4 class="subtitle subtitle__small">Sex</h4>
                                                    <p class="description description__small">Great rendering performance across all modern browsers (IE11+).</p>
                                                </div>
                                                <div class="feature-small">
                                                    <div class="feature-icon">
                                                        <span class="report_icon"><i class="fa fa-transgender" aria-hidden="true"></i></span>
                                                    </div>
                                                    <h4 class="subtitle subtitle__small">Civil Status</h4>
                                                    <p class="description description__small">Redraws charts on window resize for perfect scale granularity.</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div> 
                            </div>


                            <div class="row " style="margin-top: 10px;">
                                <div class="col-lg-3">
                                    <div class="form-group col-12">
                                        <strong>Acts</strong>
                                        <select class="form-control sel-traffic_purpose v-traffic_purpose">
                                            <option value="">Select Act</option>
                                            <option value="undefined" data-name="undefined">undefined</option>
                                            <option value="undefined" data-name="undefined">undefined</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <strong>Means</strong>
                                        <select class="form-control sel-traffic_purpose v-traffic_purpose">
                                            <option value="">Select Means</option>
                                            <option value="undefined" data-name="undefined">undefined</option>
                                            <option value="undefined" data-name="undefined">undefined</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <strong>Means</strong>
                                        <select class="form-control sel-traffic_purpose v-traffic_purpose">
                                            <option value="">Select Purpose</option>
                                            <option value="undefined" data-name="undefined">undefined</option>
                                            <option value="undefined" data-name="undefined">undefined</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3" id="employment-stat" style="display:block;padding-left: 30px;">

                                    <div class="form-group col-12">
                                        <strong>Country</strong>
                                        <select class="form-control sel-traffic_purpose v-traffic_purpose">
                                            <option value="">Select Country</option>
                                            <option value="undefined" data-name="undefined">undefined</option>
                                            <option value="undefined" data-name="undefined">undefined</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <strong>Visa Type</strong>
                                        <select class="form-control sel-traffic_purpose v-traffic_purpose">
                                            <option value="">Select Visa type</option>
                                            <option value="undefined" data-name="undefined">undefined</option>
                                            <option value="undefined" data-name="undefined">undefined</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <strong>Job / Work Description</strong>
                                        <select class="form-control sel-traffic_purpose v-traffic_purpose">
                                            <option value="">Select Job</option>
                                            <option value="undefined" data-name="undefined">undefined</option>
                                            <option value="undefined" data-name="undefined">undefined</option>
                                        </select>
                                    </div>


                                </div>

                                <div class="col-lg-3">
                                    <strong> Status</strong>
                                    <div class="mgn-b-5">
                                        <input class="jo-checkbox filled-in" value="1" name="Active Looking For Job" type="checkbox" id="js-1">
                                        <label for="js-1">Pending </label>
                                    </div>
                                    <div class="mgn-b-5">
                                        <input class="jo-checkbox filled-in" value="3" name="Passively Looking for a Job" type="checkbox" id="js-3">
                                        <label for="js-3">On Going</label>
                                    </div>
                                    <div class="mgn-b-5">
                                        <input class="jo-checkbox filled-in" value="2" name="Just Browsing" type="checkbox" id="js-2">
                                        <label class="jo-checkbox filled-in" for="js-2">Lorem ipsum</label>
                                    </div>

                                    <strong> Employment Type </strong>
                                    <div class="mgn-b-5">
                                        <input class="jo-checkbox filled-in" name="Full Time " value="1" type="checkbox" id="ep-1">
                                        <label for="ep-1">Direct </label>
                                    </div>
                                    <div class="mgn-b-5">
                                        <input class="jo-checkbox filled-in" name="Full Time " value="1" type="checkbox" id="ep-1">
                                        <label for="ep-1">Recruitment </label>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <strong> Age </strong>
                                    <div id="gender_stat row">
                                        <div style="display:inline-block;margin-right: 28px;">
                                            <small style="font-size: 11px;">Min</small>
                                            <select class="form-control sel-traffic_purpose v-traffic_purpose" style="width:70px">
                                                <option value="">Select Purpose</option>
                                                <option value="undefined" data-name="undefined">undefined</option>
                                                <option value="undefined" data-name="undefined">undefined</option>
                                            </select>
                                        </div>
                                        <div style="display:inline-block;margin-right: 28px;">
                                            <small style="font-size: 11px;">Max</small>
                                            <select class="form-control sel-traffic_purpose v-traffic_purpose" style="width:70px">
                                                <option value="">Select Purpose</option>
                                                <option value="undefined" data-name="undefined">undefined</option>
                                                <option value="undefined" data-name="undefined">undefined</option>
                                            </select>


                                        </div>
                                    </div>
                                    <div id="gender_stat">
                                        <strong> Sex </strong>
                                        <div class="mgn-b-5">
                                            <input class="jo-radio with-gap" value="1" name="Gender" type="radio" id="gt-male">
                                            <label for="gt-male">Male</label>
                                        </div>
                                        <div class="mgn-b-5">
                                            <input class="jo-radio with-gap" value="2" name="Gender" type="radio" id="gt-female">
                                            <label for="gt-female">Female </label>
                                        </div>
                                        <div class="mgn-b-5">
                                            <input class="jo-radio with-gap" value="3" name="Gender" type="radio" id="gt-any">
                                            <label for="gt-any">Any / Both </label>
                                        </div>
                                    </div>


                                </div>

                            </div>


                            <div class="row hide">
                                <div class="col-lg-12">

                                    <!--SHOW MATCHES IN VALIDATING CASE-->
                                    <div class="inner-box hide matched_results" style="display: block;">
                                        <div class="row form-row" style="background-color: #f8f9fc;margin:0;">

                                            <div class="col-12 card-sub-title blue" style="padding-left: 15px;">Generated Report <span class="matched_count"></span>
                                                <br>
                                                <small class="card-desc">Please see matched results from the list </small>
                                            </div>
                                            <div class="col-12">
                                                <div class="inner-box matched_contents" style="display: none;">
                                                    <table class="table table-stripped">
                                                        <thead class="thead-grey">
                                                            <tr>
                                                                <th scope="col">Victim</th>
                                                                <th scope="col">Date Created</th>
                                                                <th scope="col">Created By Agency</th>
                                                                <th scope="col">Status</th>
                                                                <th scope="col">Match</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="match-result-content">
                                                            <tr>
                                                                <th scope="row">Juan Manoban Dela Cruz
                                                                    <br>Test
                                                                    <br>Test</th>
                                                                <td>Birthdate: January 30, 1992</td>
                                                                <td>Province: Laguna</td>
                                                                <td>@mdo</td>
                                                                <td>100%</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">2</th>
                                                                <td>Jacob</td>
                                                                <td>Thornton</td>
                                                                <td>@fat</td>
                                                                <td>80%</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">3</th>
                                                                <td>Larry</td>
                                                                <td>the Bird</td>
                                                                <td>@twitter</td>
                                                                <td>50%</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>
                                                <div class="inner-box matched_none" style="padding: 44px 216px;background-color: #f8f9fc;">
                                                    <img src="http://administrator.dev.icms.com/assets/library/images/no_records.png" height="110px" alt="">

                                                    <div class="">

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!--            <div class="content-footer float-left  match-buttons">
                            
                                            <button type="button" class="form-control btn btn-add_victim">Add to Victim List</button>
                            
                                            <button type="button" class="btn btn-outline btn-view_victim_list" style="width:150px;">View Victim List</button>
                                            <p>Click this button if you want to add the details to victim’s information.<br>
                                                For multiple victim filing, click the button to the add the victim to list, <br>
                                                input new details to form and validate to check if the case is not duplicated.</p>
                            
                                        </div>-->

                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="page-body-container hide" style="    margin-left: 30px;    margin-bottom: 58px;">
                            <div class=" card-sub-title " style="  color: #333538;"> CHOOSE TYPE OF REPORT TO GENERATE<br> 
                            </div>
                            <div id="validate-details" class="content" role="tabpanel" aria-labelledby="validate-details-trigger" style="display:block">
                                <div class=" card-sub-title txt-W-500"> Validate Victim Details
                                    <br>
                                    <small class="card-desc"> Provide the details to check if the case is already existing </small>
                                </div>
                                <form id="form-validate_victim" class="col-12" onsubmit="return false;" novalidate="novalidate">
                                    <div class="form-row">

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label>First Name </label>
                                                    <input type="text" class="form-control v-first_name" name="first_name">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label>Middle Name </label>
                                                    <input type="text" class="form-control v-middle_name">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label> Last Name</label>
                                                    <input type="text" class="form-control v-last_name" name="last_name">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label> Date of Birth </label>
                                                    <input type="text" class="form-control datepicker v-dob" placeholder="MM/DD/YYYY">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label> Place of Birth </label>
                                                    <select class="form-control v-pob sel-provinces">

                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">

                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label>Offender's Name</label>
                                                    <input type="text" class="form-control v-offender_name">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label>Employer Name / Company Name</label>
                                                    <input type="text" class="form-control v-employer_name">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label>Local Recruitment Agency</label>
                                                    <input type="text" class="form-control v-local_recruitment_agency">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-lg-5 col-lg-offset-2 form-currency">
                                                    <label>Deployed Date</label>
                                                    <input type="text" class="form-control datepicker v-deployed_date" placeholder="MM/DD/YYYY">
                                                </div>
                                                <div class="form-group col-lg-4 form-salary">
                                                    <label>Deployment Country</label>
                                                    <select class="form-control v-deployment_country sel-country">

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label>Purpose of Report</label>
                                                    <select class="form-control sel-traffic_purpose v-traffic_purpose">
                                                        <option value="">Select Purpose</option>
                                                        <option value="undefined" data-name="undefined">undefined</option>
                                                        <option value="undefined" data-name="undefined">undefined</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!--                
                                                            <div class="form-group col-lg-6 col-lg-offset-3">
                                                                <label>Deployed Date</label>
                                                                <input type="text" class="form-control datepicker v-deployed_date" placeholder="MM/DD/YYYY">
                                                            </div>
                                                            <div class="form-group col-lg-6">
                                                                <label>Deployment Country</label>
                                                                <select class="form-control v-deployed_country sel-country">
                                                                </select>
                                                            </div>-->

                                            <!--                                                                    <div class="form-group col-md-9 offset-md-3">
                                                                                                                    <button type="submit" class="form-control btn btn-secondary-grey btn-validate">Validate</button>
                                                                                                                </div>-->

                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div style=" float: right;">
                                                    <!--<button type="submit" class="form-control btn btn-secondary-grey btn-validate">Validate</button>-->
                                                    <button type="submit" class="btn btn-secondary-light_blue float-right btn-validate">Validate</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <hr>
                                <div class="content-footer float-right  match-buttons">

                                    <button type="submit" class="btn btn-primary-orange btn-next btn-next_tab" data-tab="victims" style="margin-left: 0px; display: none;">Next</button>
                                </div>
                            </div>

                            <div class="div-list">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class=" card-sub-title "> Victim Details<br> 
                                          <!--<small class="card-desc"> Provide the details to check if the case is already existing </small>--> 
                                        </div>


                                        <div class="feature-small-container fade-in animation-delay__7">
                                            <div class="feature-small">
                                                <div class="feature-icon">
                                                    <span class="report_icon" style=" font-size: 28px;">18+</span>
                                                </div>
                                                <h4 class="subtitle subtitle__small">Age</h4>
                                                <p class="description description__small">Chart.js is a community maintained project, contributions welcome!</p>
                                            </div>
                                            <div class="feature-small">
                                                <div class="feature-icon">
                                                    <span class="report_icon"><i class="fa fa-transgender" aria-hidden="true"></i></span>
                                                </div>
                                                <h4 class="subtitle subtitle__small">Education</h4>
                                                <p class="description description__small">Visualize your data in 8 different ways; each of them animated and customisable.</p>
                                            </div>
                                            <div class="feature-small">
                                                <div class="feature-icon">
                                                    <span class="report_icon"><i class="fa fa-transgender" aria-hidden="true"></i></span>
                                                </div>
                                                <h4 class="subtitle subtitle__small">Sex</h4>
                                                <p class="description description__small">Great rendering performance across all modern browsers (IE11+).</p>
                                            </div>
                                            <div class="feature-small">
                                                <div class="feature-icon">
                                                    <span class="report_icon"><i class="fa fa-transgender" aria-hidden="true"></i></span>
                                                </div>
                                                <h4 class="subtitle subtitle__small">Civil Status</h4>
                                                <p class="description description__small">Redraws charts on window resize for perfect scale granularity.</p>
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
    </div> 
</div>

<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content">

    <!-- BEGIN PAGE CONTENT INNER -->
    <div class="page-content-inner">
        <div class="mt-content-body">
            <div class="row container-padding" >
                <div class="col-12">
<!--                    <img src="assets/modules/administrator/img/8.png">
                    <img src="assets/modules/administrator/img/9.png">-->
                </div>
            </div>
        </div>
    </div>

</div>