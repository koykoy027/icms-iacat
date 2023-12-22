
<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 
 * 
 * With comments
 */
?>

<div class="page-content">

    <!-- BEGIN PAGE CONTENT INNER -->
    <div class="page-content-inner">
        <div class="mt-content-body" style="font-family: source sans pro;">
            <div class="row container-padding" >
                <div class="col-12">
                    <div class="card" style="padding-bottom: 50px !important;">
                        <div class="row"> 

                            <div class="col-lg-12 col-md-12 col-sm-12"> 
                                <div class="card-title">
                                    <p> Reports and Analytics</p>
                                    <small class="card-desc"> List of all departments : government and non government agencies.  </small> 
                                </div>
                            </div>
                        </div>

                        <div class="collapse-body-content" style="padding: 15px;">

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#victim" role="tab" aria-controls="home" aria-selected="true">Victim</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Case Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Employment</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact1" role="tab" aria-controls="contact" aria-selected="false">Agency Achievements</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="victim" role="tabpanel" aria-labelledby="home-tab" style="padding:20px;">

                                    <div class=" card-sub-title txt-W-500"> Generate Report for Trafficked Person by Age Group
                                        <br>
                                        <small class="card-desc"> Details  such as the name of the company, company address, designation, salary, job type, etc. </small>
                                        <hr class="card-sub-title_border">
                                    </div>

                                    <div id="collapseVictim">
                                        <div class="card ">
                                            <div class="card-header blue" id="headingVictim" data-toggle="collapse" data-target="#collapseVictimFilter" aria-expanded="true" aria-controls="collapseOne">
                                                <div class="col-12 blue" >Criteria
                                                    <br>
                                                    <small class="card-desc">Description here.</small>
                                                </div>
                                            </div>
                                            <div id="collapseVictimFilter" class="collapse show" aria-labelledby="headingVictim" data-parent="#collapseVictim">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class=" shadow-sm p-3 ">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <p class="stat-header">Victim Details:</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-6">
                                                                                <p class="stat-header">Sex:</p>
                                                                                <div class="form-group col-12" id="vr-opt-sex">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <p class="stat-header">Civil Status:</p>
                                                                                <div class="form-group col-12" id="vr-opt-civil_status">
                                                                                </div>
                                                                            </div>         
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class=" shadow-sm p-3 ">
                                                                        <div>
                                                                            <p class="stat-header">Base Report</p>
                                                                        </div>
                                                                        <div class="form-group col-12">
                                                                            <div class="form-group col-12">
                                                                                <label>Primary: </label>
                                                                                <select class="form-control" id="br-primary" style="width: 100%;">
                                                                                    <option selected="" disabled=""></option>
                                                                                    <option value="1" ></option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class=" shadow-sm p-3 ">
                                                                        <div>
                                                                            <p class="stat-header">Date Range: <br> <small>Victim registered date to the system.</small></p>                                                                            
                                                                        </div>
                                                                        <div class="form-group col-12">
                                                                            <div id="vr-reportrange" style="background: #fff; cursor: pointer; padding: 2px 8px; border: 1px solid #ccc; width: max-content; font-size: 12px;">
                                                                                <i class="fa fa-calendar"></i>&nbsp;
                                                                                <span></span> <i class="fa fa-caret-down"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="row float-right" style="margin: 20px 10px;">
                                                        <button class="btn btn-primary-orange" id="btn-generate_report">Generate</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!--<div class="card" style=" padding: 10px 41px !important;">
                                                                                    <div class="report-group" style="background: #fff; border-radius: 4px;">
                                                                                        <div class="" style="margin-bottom:20px;font-size: 15px;    color: #e88f15;">Generate Report for Trafficked Person by Age Group</div>
                                                                                        <div class="d-inline-flex  bd-highlight">
                                                                                            <div class="form-group col-12">
                                                                                                <label>Report Type</label>
                                                                                                <select class="form-control selectpicker">
                                                                                                    <option value="0"  >Select Report Type</option>
                                                                                                    <option value="1" >By Age group and  Sex</option>
                                                                                                    <option value="2" >By Age Group and  Trafficked Purpose</option>
                                                                                                    <option value="3" >By Educational Attainment And Sex</option>
                                                                                                    <option value="4" >Place of origin</option>
                                                                                                    <option value="5" >Civil Status</option>
                                                                                                    <option value="5" >Educational Attainment</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row " style="margin-top: 10px;">
                                        
                                                                                            <div class="col-lg-4">
                                                                                                <div class="form-group col-12" >
                                                                                                    <label> Age </label>
                                                                                                    <div id="gender_stat row">
                                                                                                        <div style="display:inline-block;margin-right: 28px;">
                                                                                                            <small style="font-size: 11px !important;">Min</small>
                                                                                                            <select class="form-control sel-traffic_purpose v-traffic_purpose" style="width:70px">
                                                                                                                <option value="">15</option>
                                                                                                                <option value="undefined" data-name="undefined">16</option>
                                                                                                                <option value="undefined" data-name="undefined">17</option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                        <div style="display:inline-block;margin-right: 28px;">
                                                                                                            <small style="font-size: 11px !important;">Max</small>
                                                                                                            <select class="form-control sel-traffic_purpose v-traffic_purpose" style="width:70px">
                                                                                                                <option value="">60</option>
                                                                                                                <option value="undefined" data-name="undefined">61</option>
                                                                                                                <option value="undefined" data-name="undefined">62</option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                        
                                                                                                <div class="form-group col-12">
                                                                                                    <label> Sex </label>
                                                                                                    <div id="gender_stat row">
                                                                                                        <div style="display:inline-block;margin-right: 28px;">
                                        
                                                                                                            <small style="font-size: 11px;">Female</small>
                                                                                                            <input class="jo-checkbox filled-in" value="1" name="Active Looking For Job" type="checkbox" id="js-1">
                                                                                                        </div>
                                                                                                        <div style="display:inline-block;margin-right: 28px;">
                                                                                                            <small style="font-size: 11px;">Male</small>
                                                                                                            <input class="jo-checkbox filled-in" value="1" name="Active Looking For Job" type="checkbox" id="js-1">
                                        
                                        
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                        
                                                                                            </div>
                                                                                            <div class="col-lg-4" id="employment-stat" style="display:block;padding-left: 30px;">
                                                                                                <div class="form-group col-12">
                                                                                                    <label  class="mgn-b-5">Country</label>
                                                                                                    <select class="form-control sel-traffic_purpose v-traffic_purpose">
                                                                                                        <option value="">Select Country</option>
                                                                                                        <option value="undefined" data-name="undefined">undefined</option>
                                                                                                        <option value="undefined" data-name="undefined">undefined</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div class="form-group col-12">
                                                                                                    <label  class="mgn-b-5"> Period</label>
                                                                                                    <select class="form-control sel-traffic_purpose v-traffic_purpose">
                                                                                                        <option value="">Select Means</option>
                                                                                                        <option value="undefined" data-name="undefined">undefined</option>
                                                                                                        <option value="undefined" data-name="undefined">undefined</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                        
                                                                                            <div class="col-lg-4 hide">
                                                                                                <strong> Status</strong>
                                                                                                <div class="mgn-b-5">
                                                                                                    <input class="jo-checkbox filled-in" value="1" name="Active Looking For Job" type="checkbox" id="js-1">
                                                                                                    <label for="js-1" class="mgn-b-5">Pending </label>
                                                                                                </div>
                                                                                                <div class="mgn-b-5">
                                                                                                    <input class="jo-checkbox filled-in" value="3" name="Passively Looking for a Job" type="checkbox" id="js-3">
                                                                                                    <label for="js-3"  class="mgn-b-5">On Going</label>
                                                                                                </div>
                                                                                                <div class="mgn-b-5">
                                                                                                    <input class="jo-checkbox filled-in" value="2" name="Just Browsing" type="checkbox" id="js-2">
                                                                                                    <label class="jo-checkbox filled-in" for="js-2"  class="mgn-b-5">Lorem ipsum</label>
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
                                        
                                        
                                                                                        </div>
                                                                                        <div class="content-footer float-right  match-buttons">
                                        
                                                                                            <button type="button" class="btn btn-previous_tab " data-tab="validate">Previous</button>
                                                                                            <button type="submit" class="btn btn-primary-orange btn-next " data-tab="employment" style="margin-left:0px;">Generate Report</button>
                                                                                        </div>
                                        
                                        
                                                                                        <div class="row hide">
                                                                                            <div class="col-lg-6">
                                        
                                                                                                <div class="form-group col-12">
                                                                                                    <label>Sex</label>
                                                                                                    <select class="form-control sel-traffic_purpose v-traffic_purpose">
                                                                                                        <option value="">Select Sex</option>
                                                                                                        <option value="undefined" data-name="undefined">Male</option>
                                                                                                        <option value="undefined" data-name="undefined">Female</option>
                                                                                                    </select>
                                                                                                </div>
                                        
                                                                                                <div class="form-group col-12">
                                                                                                    <label> Age </label>
                                                                                                    <div id="gender_stat row">
                                                                                                        <div class="col-g-6" style="display:inline-block;">
                                                                                                            <small style="    font-weight: 200;">Min</small>
                                                                                                            <select class="form-control sel-traffic_purpose v-traffic_purpose" style="width:100px">
                                                                                                                <option value="">15</option>
                                                                                                                <option value="undefined" data-name="undefined">16</option>
                                                                                                                <option value="undefined" data-name="undefined">17</option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                        <div class="col-g-6" style="display:inline-block;">
                                                                                                            <small style="    font-weight: 200;">Min</small>
                                                                                                            <select class="form-control sel-traffic_purpose v-traffic_purpose" style="width:100px">
                                                                                                                <option value="">15</option>
                                                                                                                <option value="undefined" data-name="undefined">16</option>
                                                                                                                <option value="undefined" data-name="undefined">17</option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div> 
                                        
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-group col-12">
                                                                                                    <label>Acts</label>
                                                                                                    <select class="form-control sel-traffic_purpose v-traffic_purpose">
                                                                                                        <option value="">Select Act</option>
                                                                                                        <option value="undefined" data-name="undefined">undefined</option>
                                                                                                        <option value="undefined" data-name="undefined">undefined</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div class="form-group col-12">
                                                                                                    <label>Acts</label>
                                                                                                    <select class="form-control sel-traffic_purpose v-traffic_purpose">
                                                                                                        <option value="">Select Act</option>
                                                                                                        <option value="undefined" data-name="undefined">undefined</option>
                                                                                                        <option value="undefined" data-name="undefined">undefined</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                        
                                                                                        </div>
                                                                                    </div>
                                        
                                        
                                        
                                        
                                                                                </div>
                                        -->
                                        <div class="row" id="vr-result" style="display: none;">
                                            <div class="col-lg-12">
                                                <!--SHOW MATCHES IN VALIDATING CASE-->
                                                <div class="inner-box  matched_results">
                                                    <div class="row form-row">

                                                        <div class="col-12 card-sub-title blue" style="padding-left: 15px;">Generated Statistics and Report <span class="matched_count"></span>
                                                            <br>
                                                            <small class="card-desc">Description here. </small>
                                                        </div>
                                                        <div class="col-12">
                                                            <!--                                                        <div class="inner-box matched_contents" style="display: block;   background-color: #C8DCF2;height:50px;">
                                                            
                                                            
                                                                                                                    </div>-->
                                                            <div class="card card-report">

                                                                <div class="card-header" style="padding: 20px; background: #fff;">
                                                                    <div class="be-vr_title_name" style="font-size: 15px;    color: #e88f15;">Trafficked Person per Age Group and Sex</div>
                                                                    <small class="be-vr_title_date"> As of June 2019 - July 2019</small>
                                                                    <div class="row mgn-T-18 hide">
                                                                        <div class="col-lg-2">
                                                                            <p style="color: #356396;"> Criteria:</p>

                                                                        </div>
                                                                        <div class="col-lg-10">
                                                                            <span class="d-inline-block fw-6">Age :</span><span class="d-inline-block padding-l-10">18 - 20 years old</span><br>
                                                                            <span class="d-inline-block fw-6">Sex :</span><span class="d-inline-block padding-l-10">Male and Female</span><br>
                                                                            <span class="d-inline-block fw-6">Country :</span><span class="d-inline-block padding-l-10">Saudi Arabia</span><br>
                                                                            <span class="d-inline-block fw-6">Period :</span><span class="d-inline-block padding-l-10">June 2019 - July 2019</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="" style="    padding: 20px 20px;">
                                                                    <div class="row ">

                                                                        <!--                                                                    <div class="card-sub-title blue" style="padding-left: 15px;"> Victim List<br> 
                                                                                                                                                <small class="card-desc"> Here's the list of victim you added  </small> 
                                                                                                                                            </div>-->
                                                                        <div class="col-12">
                                                                            <div class="d-flex justify-content-between bd-highlight">
                                                                                <div class="bd-highlight">
                                                                                    <span class="d-inline-block  blue fw-6"> Total Number of Trafficked Person per Month :</span><span class="d-inline-block padding-l-10  blue fw-6">90</span>
                                                                                </div>
                                                                                <div class="bd-highlight">
                                                                                    <label class="switch">
                                                                                        <input type="checkbox">
                                                                                        <span class="slider round"></span>
                                                                                    </label>
                                                                                    <span >Toggle to show Graphical Report</span>
                                                                                </div>

                                                                            </div>

                                                                            <div class="inner-box matched_contents">
                                                                                <div class="" style="padding: 20px 20px;">
                                                                                    <p class="d-inline-block  blue fw-6">Graph: </p>
                                                                                    <div class="" style="padding: 20px 20px; height: 500px;">
                                                                                        <!--<div id="piegraph"></div>-->
                                                                                        <div class="vr-chartdiv"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="inner-box matched_contents">   
                                                                                <div style="padding: 20px 20px;">
                                                                                    <p class="d-inline-block  blue fw-6">Tabular:</p>
                                                                                    <div style="padding: 20px 20px">
                                                                                        <table class="table table-stripped hide">
                                                                                            <thead class="thead-grey">
                                                                                                <tr>
                                                                                                    <th scope="col">Age</th>
                                                                                                    <th scope="col">Sex Created</th>
                                                                                                    <th scope="col">Country</th>
                                                                                                    <th scope="col">Total</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody class="match-result-content">
                                                                                                <tr>

                                                                                                    <td>18</td>
                                                                                                    <td>Female</td>
                                                                                                    <td>Saudi Arabia</td>
                                                                                                    <td>30</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>19</td>
                                                                                                    <td>Female</td>
                                                                                                    <td>Saudi Arabia</td>
                                                                                                    <td>30</td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>20</td>
                                                                                                    <td>MAle</td>
                                                                                                    <td>Saudi Arabia</td>
                                                                                                    <td>30</td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>

                                                                                        <div class="victim-tabular">
                                                                                            <div class="row">
                                                                                                <div class="col-6">
                                                                                                    <div class="text-center" id="vt-variable"style="font-size: 15px;color: #e88f15;"></div>
                                                                                                </div>
                                                                                                <div class="col-6">
                                                                                                    <div class="text-center" style="font-size: 15px;color: #e88f15;">Count</div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div id="vt-body"> 
                                                                                                <div class="row">
                                                                                                    <div class="col-6">
                                                                                                        Male
                                                                                                    </div>
                                                                                                    <div class="col-6">
                                                                                                        <p class="text-center">20</p>
                                                                                                    </div>                                                                                                
                                                                                                    <div class="col-6">
                                                                                                        Female
                                                                                                    </div>
                                                                                                    <div class="col-6">
                                                                                                        <p class="text-center">20</p>
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
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                                <div class="tab-pane fade" id="contact1" role="tabpanel" aria-labelledby="contact-tab">...</div>





                                <!--                            <div class=" card-sub-title "> CHOOSE TYPE OF REPORT TO GENERATE<br> 
                                                            </div>
                                                            <div class="row">
                                                                <div class="col s6 m6 l6 baseReport-field " style="padding-left: 0px;">
                                                                </div>
                                                            </div>-->
                                <div class="card hide" style=" padding: 10px 41px !important;">
                                    <div class="" style="margin-bottom:20px;    font-size: 15px;">Trafficked Person</div>
                                    <div class="report-group" style="padding:20px;background: #f8f9fc; border-radius: 4px;">
                                        <div class="" style="margin-bottom:20px;    font-size: 15px;    color: #e88f15;">Generate Report for Trafficked Person by Age Group</div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group col-12">
                                                    <label>Acts</label>
                                                    <select class="form-control sel-traffic_purpose v-traffic_purpose">
                                                        <option value="">Select Act</option>
                                                        <option value="undefined" data-name="undefined">undefined</option>
                                                        <option value="undefined" data-name="undefined">undefined</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-12">
                                                    <label>Acts</label>
                                                    <select class="form-control sel-traffic_purpose v-traffic_purpose">
                                                        <option value="">Select Act</option>
                                                        <option value="undefined" data-name="undefined">undefined</option>
                                                        <option value="undefined" data-name="undefined">undefined</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group col-12">
                                                    <label>Acts</label>
                                                    <select class="form-control sel-traffic_purpose v-traffic_purpose">
                                                        <option value="">Select Act</option>
                                                        <option value="undefined" data-name="undefined">undefined</option>
                                                        <option value="undefined" data-name="undefined">undefined</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-12">
                                                    <label>Acts</label>
                                                    <select class="form-control sel-traffic_purpose v-traffic_purpose">
                                                        <option value="">Select Act</option>
                                                        <option value="undefined" data-name="undefined">undefined</option>
                                                        <option value="undefined" data-name="undefined">undefined</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row " style="margin-top: 10px;">
                                <div class="col-lg-3"> 
                                    <!--<canvas id="myChart" width="400" height="400"></canvas>-->
                                </div>
                                <div class="col-lg-3">

                                </div>
                                <div class="col-lg-3">
                                    <div id="piegraph"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div> 
        </div> 
    </div> 
</div>
