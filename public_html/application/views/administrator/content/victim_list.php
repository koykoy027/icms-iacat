<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
//echo"<pre>";
// print_r($_SESSION);
//
//echo $this->yel->generateCaseControlNumber();
?>
<div class="page-content-inner ">
    <div class="content-body">    
        <div class="card">
            <div class="content-body-container">
                <div class=" card-stats-inner p-2">
                    <!--                        
                                            
                    <div class="page-content-inner">
                        <div class="content-body">    
                            <div class="row container-padding">
                                <div class="col-lg-12 col-md-12 col-sm-12" >
                    
                    
                                    <div class=" card" >-->
                    <div class="row">
                        <div class="col-md-12 col-lg-6 col-sm-12">
                            <div class="card-title ">
                                <p> List of Victim</p>
                                <small class="card-desc">List of all victims.</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                            <div class="list-action" >

                                <div class=" mt-1 show list-action-filter float-right">
                                    <input class="txt_search" id="txt_search-victim" type="search" placeholder="search keyword..." aria-label="Search">
                                    <div class="d-inline-block pl-1">
                                        <button type="button" class="btn btn-secondary-light_blue  btn-quick-actions " data-target="dropdownnotifyButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Search By <i class="fas fa-angle-down pl-3"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown_filter shadow pb-0" id="dropdownnotifyButton"  x-placement="bottom-start">
                                            <a class="dropdown-item disabled action-title" href="#" >Search By</a>
                                            <ul class="list-group list-status">
                                                <li class="list-group-item">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input chk-filter" name="status" type="checkbox" id="inlineCheckbox1" value="1">
                                                        <label class="form-check-label" for="1">All</label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input chk-filter" name="status" type="checkbox" id="inlineCheckbox2" value="0">
                                                        <label class="form-check-label" for="2">Victim Number</label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input chk-filter" name="status" type="checkbox" id="inlineCheckbox2" value="0">
                                                        <label class="form-check-label" for="3">Name</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div  class="d-inline-block">
                                        <button type="button" class="btn btn-secondary-light_blue  btn-quick-actions " data-target="dropdownnotifyButton1"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Order By <i class="fas fa-angle-down pl-3"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown_filter shadow pb-0" id="dropdownnotifyButton1"  x-placement="bottom-start">
                                            <a class="dropdown-item disabled action-title" href="#" >Order by</a>
                                            <ul class="list-group">

                                                <li class="list-group-item">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input chk-filter" name="orderBy" type="checkbox" id="AN_1"  value="1">
                                                        <label class="form-check-label" for="1">All</label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input chk-filter" name="orderBy" type="checkbox" id="AN_2" value="2" >
                                                        <label class="form-check-label" for="2">Victim Number</label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input chk-filter" name="orderBy" type="checkbox" id="AN_2" value="2" >
                                                        <label class="form-check-label" for="3">Name</label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input chk-filter" name="orderBy" type="checkbox" id="AN_2" value="2" >
                                                        <label class="form-check-label" for="4">Date</label>
                                                    </div>
                                                </li>
                                                <li class="filter_action-btn hide">
                                                    <button class="dropdown-item btn-filter_clear "  type="button">Clear</button>
                                                    <button class="dropdown-item btn-filter_list " type="button">Filter </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>



                            </div>
                        </div>
                    </div>
                        <div class="row-header mt-3">
                            <div class="row row-header-border">
                                <div class="col-lg-8 col-md-8 col-sm-8 col-header"><span class="padding-l-10">Victim Details </span></div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-header">Case Count</div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-header txt-align_center">Action</div>

                            </div>
                        </div>
                        <div class="div-allcase-list1  case-list1" >
                            <!-------------Loading Empty Placeholder for list  ------------>
                            <ul class="nav agency-list_content filter_load_placeholder"> </ul>
                            <!-------------------------------------------------------------->
                            <ul class=" list_content victim_list"></ul>   
                            <div class="pagination-wrapper rs-list">
                                <div class="row">
                                    <div class="col m12 s12 l4">
                                        <p class="pagination-details rs-info"></p>
                                    </div>
                                    <div class="col m12 s12 l8 text-right">
                                        <ul class="pagination rs-pagination">
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


<div class="modal fade bd-example-modal-lg" id="mdl-victim-details" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <span class="content-title pl-5 pt-5"> Victim Assessment List </span>
            <small class="content-sub-title pl-5">Brief details of the case.</small>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="nav-data_list padding-l-10">
                            <div class="agency_details padding-l-10" id="vd-first-row">
                                <span class="desc_name lbl-desc">#VN1900001 </span> 
                                <br> <span class="lbl-name">  Melinda Quynn Samson </span>
                                <br> <span class="lbl-name">35 years old</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6" id="vd-second-row">
                        <span class="lbl-name" style="text-transform:capitalize">sample branch address  , Magallanes , Cavite </span>
                        <br> <span class="lbl-nmae">(02) 523 8481</span>
                        <span class="lbl-name">Married</span>
                        <br> <span class="lbl-name">Female</span>
                    </div>
                </div><br>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="col-12" id="victim_list">
                            <div class="row-header">
                                <div class="row thead-border-blue">
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-header">Reports</div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-header ">Status</div>
                                </div>
                                <ul class="list_content" id="vd-case_list_">
                                    <li>
                                        <div class="card" >
                                            <div class="row">
                                                <div class="align-items-center col-lg-9 col-md-9 col-sm-12"> 
                                                    <span class="case-id">CN09876688</span>
                                                    <br> <span class="icms-btn-secondary">Created by : &nbsp;</span><span class="">Kimberly Bado | Ermita Metro Manila (IACAT) </span>
                                                    <br> <span class="icms-btn-secondary">Date created : &nbsp;</span><span class="">August 22,2019 4:09am</span>
                                                </div>
                                                <div class="align-items-center col-lg-3 col-md-3 col-sm-12"> 
                                                    <span class="stat_">On Going </span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="card" >
                                            <div class="row">
                                                <div class="align-items-center col-lg-9 col-md-9 col-sm-12"> 
                                                    <span class="case-id">CN09876688</span>
                                                    <br> <span class="icms-btn-secondary">Created by : &nbsp; </span><span class="">Kimberly Bado | Ermita Metro Manila (IACAT) </span>
                                                    <br> <span class="icms-btn-secondary">Date created : &nbsp; </span><span class="">August 22,2019 4:09am</span>
                                                </div>
                                                <div class="align-items-center col-lg-3 col-md-3 col-sm-12"> 
                                                    <span class="stat_">On Going </span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                </ul>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-close btn-cancel float-right" data-dismiss="modal"> Close </button>        
            </div>
        </div>
    </div>
</div>     


<!--modal for victim case list-->
<!--<div class="modal fade bd-example-modal-lg" id="mdl-case-list" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="vic-name">
                <span class="content-title" style="padding-top: 25px; margin-left:7%;"></span> <i class="fas fa-check-circle text-success" hidden></i>
            </div>
            <div class="vic-city">
                <small class="content-sub-title" style="margin-left: 7%;"></small> <i class="fas fa-check-circle text-success" hidden></i>
            </div>
            <div class="vic-victim_info_dob">
                <small class="content-sub-title" style="margin-left: 7%;"></small> <i class="fas fa-check-circle text-success" hidden></i>
            </div>
            <div class="modal-body">
                <div class="container-inner bg-white">
                    <span class="content-title" style="padding-top: 25px; margin-left:7%;"> List of Cases </span><br>
                    <small class="content-sub-title" style="margin-left: 7%;">This is the result of case validation.</small>
                    <button type="button" class="btn btn-secondary-light_blue float-right mrg-t-n-10 validate-add-new-btn"><i class="fa fa-plus"></i> Add New Case</button>
                    <div class="container-match-result validation-case-list">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-close float-right" data-dismiss="modal"> Close </button>
            </div>
        </div>
    </div>
</div>-->


<div class="modal fade" id="mdl-case-list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="victim_info">
                    <h5 class="vic-real-name"></h5>
                    <h6 class="vic-assumed-name"></h6>
                    <p class="vic-address"></p>
                    <p class="vic-number">VN23238172</p>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>List of Cases</h6>
                <div class="case_list_content">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="mdl-victim_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5>Victim Details</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="padding: 0px 20px;">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="card-title font-weight-bold vict-info-number"></h5>
                            <h5 class="card-title font-weight-bold vict-info-real-name"></h5>
                            <h6 class="card-subtitle mb-2 text-muted vict-info-assumed-name"></h6>
                            <p class="card-text vict-info-address"></p>
                        </div>
                    </div>
                    <hr>
                </div>

                <div style="padding: 10px 20px;">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="list-group" id="list-tab" role="tablist">
                                <a class="list-group-item list-group-item-action active" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Profile</a>
                                <!--<a class="list-group-item list-group-item-action" id="list-passport-list" data-toggle="list" href="#list-passport" role="tab" aria-controls="passport">Passport</a>-->
                                <a class="list-group-item list-group-item-action" id="list-cases-list" data-toggle="list" href="#list-cases" role="tab" aria-controls="cases">Cases</a>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="tab-content" id="vic-details-nav-content">
                                <div class="tab-pane fade show active" id="list-profile" role="tabpanel" aria-labelledby="list-passport-list">
                                    <h5>Victim Info <a class="btn-edit-vctm-info">EDIT</a></h5>
                                    <div class="vic-details-tab-content victim-info-prev">
                                        <div class="row">
                                            <label class="col-sm-3">Date of Birth</label>
                                            <div class="col-sm-9">
                                                <p class="vict-victim_info_dob"></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-3">Place of Birth</label>
                                            <div class="col-sm-9">
                                                <p class="vict-city"></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-3">Sex</label>
                                            <div class="col-sm-9">
                                                <p class="vict-gender"></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-3">Civil Status</label>
                                            <div class="col-sm-9">
                                                <p class="vict-civil_status"></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-3">Religion</label>
                                            <div class="col-sm-9">
                                                <p class="vict-religion"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="vic-details-tab-content" style="
                                         margin-bottom: 20px;
                                         border: 1px solid #eee;
                                         background: #f5f6fa;">
                                        <h6>Victim Information Form</h6>
                                        <form id="victim-info-form">
                                            <div class="form-group row">
                                                <label class="col-sm-3">First Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="victim_info_first_name" class="form-control u-vctm-real-info-victim_info_first_name">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3">Last Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="victim_info_last_name" class="form-control u-vctm-real-info-victim_info_last_name">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3">Middle Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control u-vctm-real-info-victim_info_middle_name">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3">Suffix</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control u-vctm-info-victim_info_suffix">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3">Date of Birth</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control datepicker u-vctm-real-info-victim_info_dob">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3">Place of Birth</label>
                                                <div class="col-sm-9">
                                                    <select type="text" class="form-control sel-provinces u-vctm-info-victim_info_city_pob">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3">Sex</label>
                                                <div class="col-sm-9">
                                                    <select type="text" class="form-control sel-sex u-vctm-info-victim_gender"></select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3">Civil Status</label>
                                                <div class="col-sm-9">
                                                    <select type="text" class="form-control sel-civil u-vctm-info-victim_civil_status"></select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3">Religion</label>
                                                <div class="col-sm-9">
                                                    <select type="text" class="form-control sel-religion u-vctm-info-victim_religion"></select>
                                                </div>
                                            </div>

                                            <h6>Assumed Victim Information Form</h6>

                                            <div class="form-group row">
                                                <label class="col-sm-3">Assumed First Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control u-vctm-assumed-info-victim_info_first_name">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3">Assumed Last Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control u-vctm-assumed-info-victim_info_last_name">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3">Assumed Middle Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control u-vctm-assumed-info-victim_info_middle_name">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3">Assumed Date of Birth</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control datepicker u-vctm-assumed-info-victim_info_dob">
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button type="button" class="btn btn-cancel">Cancel</button>
                                                <button type="submit" class="btn btn-primary-orange">Save</button>

                                            </div>
                                        </form>
                                    </div>


                                    <h5>Address <a class="btn-add-vctm-addr">ADD</a></h5>
                                    <div class="vic-details-tab-content">
                                        <div class="vict-address-section"></div>

                                        <div class="vic-details-tab-content" style=" 
                                             margin-bottom: 20px;
                                             border: 1px solid #eee;
                                             background: #f5f6fa;">
                                            <h6 class="vctm-addr-form-title">Victim Address Form</h6>
                                            <form id="victim-addr-form">
                                                <div class="form-group row">
                                                    <label class="col-sm-3">Region</label>
                                                    <div class="col-sm-9">
                                                        <select name="region" class="form-control vctm-addr-victim_address_list_region_id sel-regions">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3">Province / State</label>
                                                    <div class="col-sm-9">
                                                        <select type="text" name="province" class="form-control vctm-addr-victim_address_list_province_id sel-provincesByRegionId sel-provinces" disabled>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3">City</label>
                                                    <div class="col-sm-9">
                                                        <select type="text" name="city" class="form-control vctm-addr-victim_address_list_city_id sel-cities" disabled>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3">Barangay</label>
                                                    <div class="col-sm-9">
                                                        <select type="text" class="form-control vctm-addr-victim_address_list_brgy_id sel-barangay" disabled>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3">Complete Address</label>
                                                    <div class="col-sm-9">
                                                        <textarea type="text" name="address" class="form-control vctm-addr-victim_address_list_address"></textarea>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="button" class="btn btn-cancel">Cancel</button>
                                                    <button type="submit" class="btn btn-primary-orange">Save</button>

                                                </div>
                                            </form>
                                        </div>

                                    </div>

                                    <h5>Contact <a class="btn-add-vctm-contact">ADD</a></h5>
                                    <div class="vic-details-tab-content">
                                        <div class="vict-contact-section"></div>

                                        <div class="vic-details-tab-content" style=" 
                                             margin-bottom: 20px;
                                             border: 1px solid #eee;
                                             background: #f5f6fa;">
                                            <h6 class="vctm-contact-form-title">Victim Contact Form</h6>
                                            <form id="victim-contact-form">
                                                <div class="form-group row">
                                                    <label class="col-sm-3">Contact type</label>
                                                    <div class="col-sm-9">
                                                        <select name="contact_type" class="form-control vctm-contact-victim_contact_detail_type sel-contact_type">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3">Value</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="contact_content" class="form-control vctm-contact-victim_contact_detail_content">
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="button" class="btn btn-cancel">Cancel</button>
                                                    <button type="submit" class="btn btn-primary-orange btn-next">Save</button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <h5>Education <a class="btn-add-vctm-education">ADD</a></h5>
                                    <div class="vic-details-tab-content">
                                        <div class="vict-education-section"></div>

                                        <div class="vic-details-tab-content victim-educ-form" style=" 
                                             margin-bottom: 20px;
                                             border: 1px solid #eee;
                                             background: #f5f6fa;">
                                            <h6 class="vctm-educ-form-title">Victim Education Form</h6>
                                            <form id="victim-educ-form">
                                                <div class="form-group row">
                                                    <label class="col-sm-3">Education Type</label>
                                                    <div class="col-sm-9">
                                                        <select name="education_type" class="form-control vctm-educ-victim_education_type sel-education">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3">Grade or Year level</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control vctm-educ-victim_education_grade_year ">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3">School Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="education_school" class="form-control vctm-educ-victim_education_school ">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3">Course</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control vctm-educ-victim_education_course ">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3">Year Start</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control vctm-educ-victim_education_start ">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3">Year End</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control vctm-educ-victim_education_end ">
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="button" class="btn btn-cancel">Cancel</button>
                                                    <button type="submit" class="btn btn-primary-orange btn-next">Save</button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <h5>Relatives <a class="btn-add-vctm-relative">ADD</a></h5>
                                    <div class="vic-details-tab-content ">
                                        <div class="vict-relatives-section"></div>

                                        <div class="vic-details-tab-content" style=" 
                                             margin-bottom: 20px;
                                             border: 1px solid #eee;
                                             background: #f5f6fa;">
                                            <h6 class="vctm-relative-form-title">Victim Relative Form</h6>
                                            <form id="victim-relative-form">   
                                                <div class="form-group row">
                                                    <label class="col-sm-3">Family Relation</label>
                                                    <div class="col-sm-9">
                                                        <select name="relative_type" class="form-control vctm-rel-victim_relative_type sel-relation">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row rel-other-txtbox" hidden>
                                                    <label class="col-sm-3">Description</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control vctm-rel-victim_relative_type_other" >
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3">Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="relative_name" class="form-control vctm-rel-victim_relative_fullname ">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3">Primary Contact Number</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="primary_contact" class="form-control vctm-rel-victim_relative_primary_contact_number ">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3">Secondary Contact Number</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="secondary_contact" class="form-control vctm-rel-victim_relative_second_contact_number ">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3">Email</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="email" class="form-control vctm-rel-victim_relative_email ">
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="button" class="btn btn-cancel">Cancel</button>
                                                    <button type="submit" class="btn btn-primary-orange btn-next">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="list-cases" role="tabpanel" aria-labelledby="list-cases-list">
                                    <h5>Cases</h5>
                                    <div class="vic-details-tab-content">
                                        <div class="vict-cases-section"></div>
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