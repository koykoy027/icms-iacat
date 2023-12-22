<?php
/**
 * Page Security
 */
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content-inner ">
    <div class="content-body">
        <div class="card">
            <div class="content-body-container">
                <div class=" card-stats-inner p-2">
                    <div id="container-user-list">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="card-title">
                                    <p>User List</p>
                                    <small class="card-desc"> List of all Users.</small>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-end">
                                <div class="card-title ">
                                    <button type="button" class="btn btn-secondary-light_blue btn-quick-actions"
                                            id="btn-add_user" aria-expanded="true"> Register User </button>
                                </div>
                            </div>
                        </div>

                        <div class="container-add_user hide">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="shadow-sm p-3 card-wrapper-report">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="card-title ">
                                                        <span class="text-left content-title"> User Details</span>
                                                        <p class="content-sub-title">Contains personal information
                                                            about the user.</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-end">
                                                    <span class=" btn-close-floater btn-close_add_user"><i
                                                            class="fas fa-times"></i></span>
                                                </div>
                                            </div>

                                            <form id="form-add_user" onsubmit="return false">
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-8 col-sm-12">
                                                        <div class="card-sub-title"> Personal Information
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="txt_fname" class="lbl">First Name
                                                                    </label>
                                                                    <span class="required"> *</span>
                                                                    <input type="text" maxlength="20" id="txt_fname"
                                                                           name="txt_fname"
                                                                           class="form-control letNumDash">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="txt_mname" class="lbl">Middle
                                                                        Name</label>
                                                                    <input type="text" maxlength="32" id="txt_mname"
                                                                           name="txt_mname"
                                                                           class="form-control lettersOnly">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="txt_lname" class="lbl">Last Name</label>
                                                                    <span class="required"> *</span>
                                                                    <input type="text" maxlength="32" id="txt_lname"
                                                                           name="txt_lname"
                                                                           class="form-control lettersOnly">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12">

                                                                <div class="form-group">
                                                                    <label for="user_level" class="">User Level <font
                                                                            color="red">*</font></label>
                                                                    <select class="form-control" name="sel_userlevel"
                                                                            id="sel_userlevel">
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="sex" class="lbl">Sex </label>
                                                                    <span class="required"> *</span>
                                                                    <select class="form-control sel-sex vi-sex"
                                                                            name="sex" id="sex">
                                                                        <option selected="">Sex</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="txt_job_descr" class="lbl">Job
                                                                        Description </label>
                                                                    <span class="required"> *</span>
                                                                    <textarea class="form-control" maxlength="1000"
                                                                              id="txt_job_descr" name="job_descr"
                                                                              class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                                        <div class=" card-sub-title"> User Contact
                                                            Information </div>

                                                        <div class="form-group">
                                                            <label for="txt_email" class="lbl">Email </label>
                                                            <span class="required"> *</span>
                                                            <input type="email" maxlength="50" id="txt_email"
                                                                   name="txt_email" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="txt_tel" class="lbl">Telephone
                                                                Number</label><br>
                                                            <input type="text" id="txt_tel" maxlength="20" maxlength="7"
                                                                   name="txt_tel" class="form-control  numbersOnly">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="txt_mob" class="lbl">Mobile Number </label>
                                                            <span class="required"> *</span>
                                                            <input type="text" maxlength="20" minlength="7" id="txt_mob"
                                                                   name="txt_mob" class="form-control numbersOnly">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-center">
                                                    <button type="submit" class="btn btn-primary-orange"
                                                            aria-expanded="true"> Register </button>
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-body-content mt-4">
                            <div class="tab-title border-bottom">
                                <div class="row tab-header">
                                    <div class="col-md-12 col-lg-6 col-sm-12 col-xs-12">
                                        <ul class="nav nav-pills nav-fill case-ul" id="case-ul" data-id="1">
                                            <li class="nav-item nav-inner-item li-all-cases">
                                                <a class="nav-link active nav-tab " data-toggle="tab"
                                                   href="#iacat_users">My Users</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class=" card-stats-inner card-tab-inner">
                                <div class="tab-content">

                                    <!--start my users-->
                                    <div class="tab-pane fade show active px-3" id="iacat_users" role="tabpanel"
                                         aria-labelledby="recent-case-tab">

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="list-action mt-2">
                                                    <div class=" mt-1 show list-action-filter float-right">
                                                        <input class="txt_search mytxt_search " id="txt_search_my_user"
                                                               type="search" placeholder="search keyword..."
                                                               aria-label="Search">
                                                        <div class="d-inline-block pl-1">
                                                            <button type="button"
                                                                    class="btn btn-secondary-light_blue  btn-quick-actions "
                                                                    data-target="dropdownnotifyButton"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="true">
                                                                Filter <i class="fas fa-angle-down pl-3"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown_filter shadow pb-0"
                                                                 id="dropdownnotifyButton" x-placement="bottom-start">
                                                                <a class="dropdown-item disabled action-title"
                                                                   href="#">Filter By</a>
                                                                <ul class="list-group list-status">
                                                                    <li class="list-group-item filter-title pl-2">
                                                                        Status
                                                                    </li>
                                                                    <li class="list-group-item">
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input chk-filter"
                                                                                   name="mystatus" type="checkbox"
                                                                                   id="inlineCheckbox1" value="1">
                                                                            <label class="form-check-label"
                                                                                   for="0">Active</label>
                                                                        </div>
                                                                    </li>
                                                                    <li class="list-group-item">
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input chk-filter"
                                                                                   name="mystatus" type="checkbox"
                                                                                   id="inlineCheckbox2" value="0">
                                                                            <label class="form-check-label"
                                                                                   for="1">Unverified</label>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                               <ul class="list-group">
                                                                    <li class="list-group-item filter-title pl-2">
                                                                        User Role
                                                                    </li>
                                                                    <li class="list-group-item">
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input chk-filter" name="myUserRole" type="checkbox" id="inlineCheckbox1" value="1">
                                                                            <label class="form-check-label" for="0">Administrator</label>
                                                                        </div>
                                                                    </li>
                                                                    <li class="list-group-item">
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input chk-filter" name="myUserRole" type="checkbox" id="inlineCheckbox3" value="2">
                                                                            <label class="form-check-label" for="2">Report/Case Encoder </label>
                                                                        </div>
                                                                    </li>
                                                                    <li class="list-group-item">
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input chk-filter" name="myUserRole" type="checkbox" id="inlineCheckbox3" value="3">
                                                                            <label class="form-check-label" for="3">Report/Case Handler </label>
                                                                        </div>
                                                                    </li>
                                                                    <li class="list-group-item">
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input chk-filter" name="myUserRole" type="checkbox" id="inlineCheckbox4" value="4">
                                                                            <label class="form-check-label" for="4">Report/Case Administrator  </label>
                                                                        </div>
                                                                    </li>
                                                                    <li class="list-group-item">
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input chk-filter" name="myUserRole" type="checkbox" id="inlineCheckbox5" value="5">
                                                                            <label class="form-check-label" for="5">Reports And Analytics  </label>
                                                                        </div>
                                                                    </li>
                                                                    <li class="filter_action-btn hide">
                                                                        <button class="dropdown-item btn-filter_clear mybtn-filter_clear " type="button">Clear</button>
                                                                        <button class="dropdown-item btn-filter_list mybtn-filter_list " type="button">Filter </button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <button type="button"
                                                                    class="btn btn-secondary-light_blue  btn-quick-actions "
                                                                    data-target="dropdownnotifyButton1"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="true">
                                                                Order By <i class="fas fa-angle-down pl-3"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown_filter shadow pb-0"
                                                                 id="dropdownnotifyButton1" x-placement="bottom-start">
                                                                <a class="dropdown-item disabled action-title"
                                                                   href="#">Order by</a>
                                                                <ul class="list-group">
                                                                    <li class="list-group-item">
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input chk-filter"
                                                                                   name="myorderBy" type="checkbox"
                                                                                   id="AN_3" value="2">
                                                                            <label class="form-check-label" for="2">User
                                                                                Name </label>
                                                                        </div>
                                                                    </li>
                                                                    <li class="list-group-item">
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input chk-filter"
                                                                                   name="myorderBy" type="checkbox"
                                                                                   id="AN_4" value="2">
                                                                            <label class="form-check-label" for="2">User
                                                                                Level </label>
                                                                        </div>
                                                                    </li>
                                                                    <li class="filter_action-btn hide">
                                                                        <button
                                                                            class="dropdown-item btn-filter_clear mybtn-filter_clear "
                                                                            type="button">Clear</button>
                                                                        <button
                                                                            class="dropdown-item btn-filter_list mybtn-filter_list  "
                                                                            type="button">Filter </button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--table goes here-->
                                        <div id="user_list-my_users" datapage="1">
                                            <div class=" ul-container mt-3">
                                                <div class="row-header-border">
                                                    <div class="card" style="background:#F5F6FA;">
                                                        <div class="row">
                                                            <div class="col-lg-8 col-md-8 col-sm-8">
                                                                <span>User</span>
                                                            </div>
                                                            <div
                                                                class="col-lg-2 col-md-2 col-sm-2 txt-align_center d-flex align-items-center justify-content-center">
                                                                <span>Status</span>
                                                            </div>
                                                            <div
                                                                class="col-lg-2 col-md-2 col-sm-2 txt-align_center d-flex align-items-center justify-content-center">
                                                                <span>Action</span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="div-list">
                                                    <!-------------Loading Empty Placeholder for list  ------------>
                                                    <ul
                                                        class="nav agency-list_content myfilter_load_placeholder filter_load_placeholder">
                                                    </ul>
                                                    <!-------------------------------------------------------------->
                                                    <ul class="nav agency-list_content div-agencies-list div-user-list_ "
                                                        id="div-my-user-list">
                                                    </ul>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="pagination-wrapper my-rs-list px-4 pt-2">
                                                <div class="row">
                                                    <div class="col col-lg-4 col-sm-12 col-md-12">
                                                        <p class="pagination-details my-rs-info"></p>
                                                    </div>
                                                    <div class="col col-lg-8 col-md-12 col-sm-12 text-right">
                                                        <ul class="pagination my-rs-pagination">
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end my users-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="mdl-caselist" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body msgmodal-body">
                <div class="container">
                    <div class="mt-3">
                        <div class="row-header">
                            <div class="row victim-list-header">
                                <div class="col-lg-12 col-header">
                                    <h4 class="padding-l-10">Reports</h4>
                                </div>
                            </div>
                        </div>

                        <ul class="nav" id="case-preloader">
                            <li class="w-100">
                                <div class="card" style="">
                                    <div class="row">
                                        <div class="col-lg-8 col-md-8 col-sm-8 details-col">
                                            <div class="linear-background">
                                                <div class="inter-draw"></div>
                                                <div class="inter-crop"></div>
                                                <div class="inter-right--top"></div>
                                                <div class="inter-right--bottom"></div>
                                                <div class="inter-right--bottom2"></div>
                                                <div class="inter-right--bottom3"></div>
                                                <div class="inter-right--bottom4"></div>
                                                <div class="inter-right--bottom5"></div>
                                                <div class="inter-right--bottom6"></div>
                                                <div class="inter-right--bottom7"></div>
                                                <div class="inter-right--bottom8"></div>
                                                <div class="inter-right--bottom9"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2  col-sm-2 txt-align_center status-col">
                                            <div class="linear-background">
                                                <div class="inter-draw"></div>
                                                <div class="inter-crop"></div>
                                                <div class="inter-right--top"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 txt-align_center action-col">
                                            <div class="linear-background">
                                                <div class="inter-draw"></div>
                                                <div class="inter-crop"></div>
                                                <div class="inter-right--top"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="w-100">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-lg-8 col-md-8 col-sm-8 details-col">
                                            <div class="linear-background">
                                                <div class="inter-draw"></div>
                                                <div class="inter-crop"></div>
                                                <div class="inter-right--top"></div>
                                                <div class="inter-right--bottom"></div>
                                                <div class="inter-right--bottom2"></div>
                                                <div class="inter-right--bottom3"></div>
                                                <div class="inter-right--bottom4"></div>
                                                <div class="inter-right--bottom5"></div>
                                                <div class="inter-right--bottom6"></div>
                                                <div class="inter-right--bottom7"></div>
                                                <div class="inter-right--bottom8"></div>
                                                <div class="inter-right--bottom9"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2  col-sm-2 txt-align_center status-col">
                                            <div class="linear-background">
                                                <div class="inter-draw"></div>
                                                <div class="inter-crop"></div>
                                                <div class="inter-right--top"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 txt-align_center action-col">
                                            <div class="linear-background">
                                                <div class="inter-draw"></div>
                                                <div class="inter-crop"></div>
                                                <div class="inter-right--top"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="w-100">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-lg-8 col-md-8 col-sm-8 details-col">
                                            <div class="linear-background">
                                                <div class="inter-draw"></div>
                                                <div class="inter-crop"></div>
                                                <div class="inter-right--top"></div>
                                                <div class="inter-right--bottom"></div>
                                                <div class="inter-right--bottom2"></div>
                                                <div class="inter-right--bottom3"></div>
                                                <div class="inter-right--bottom4"></div>
                                                <div class="inter-right--bottom5"></div>
                                                <div class="inter-right--bottom6"></div>
                                                <div class="inter-right--bottom7"></div>
                                                <div class="inter-right--bottom8"></div>
                                                <div class="inter-right--bottom9"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2  col-sm-2 txt-align_center status-col">
                                            <div class="linear-background">
                                                <div class="inter-draw"></div>
                                                <div class="inter-crop"></div>
                                                <div class="inter-right--top"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 txt-align_center action-col">
                                            <div class="linear-background">
                                                <div class="inter-draw"></div>
                                                <div class="inter-crop"></div>
                                                <div class="inter-right--top"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>

                        <div class="div-allcase-list1  case-list1" id="tab-content-4">
                            <ul class="div-all case-list list_content" id="list-tagged">

                            </ul>
                            <div class="pagination-wrapper rs-list-tagged_user">
                                <div class="row">
                                    <div class="col col-lg-6 col-md-6 col-sm-12">
                                        <p class="pagination-details rs-info-tagged_user"></p>
                                    </div>
                                    <div class="col col-lg-6 col-md-6 col-sm-12 text-right">
                                        <ul class="pagination rs-pagination-tagged_user">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-footer float-right  match-buttons">
                    <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Start -->
<div class="modal fade" id="modalUpdateUser" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <!--Header-->

            <div class="modal-header">
                <h5 class="modal-title h5-title msgmodal-header">Manage User Details</h5>
            </div>

            <!--Body-->
            <div class="modal-body" id="modal-body-update" >

                <form id="frm-user-details" onsubmit="return false">    

                    <div class="row px-5">
                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <div class="form-group row">
                                <div class="form-group col-4 px-1">
                                    <label class="">Username: <span id="lbl-user_name">-</span> </label>
                                </div>
                            </div>

                            <div class="form-group row pb-3">
                                <div class="form-group div-access col-4 px-1">
                                    <label class="">User Level <font color="red">*</font> </label><br>
                                    <select id="mng_sel_userlevel" name="sel_userlevel" class="form-control">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                                <div class="form-group col-4 px-1">
                                    <label class="">Status <font color="red">*</font> </label><br>
                                    <select id="mng_sel_status" name="status" class="form-control">
                                        <option selected disabled>Choose...</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-4 px-1">
                                    <label for="mng_txt_fname" class="lbl">First Name <font color="red">*</font></label><br>
                                    <input type="text" id="mng_txt_fname" maxlength="36" name="txt_fname"
                                           class="form-control letNumDash">
                                </div>

                                <div class="form-group col-4 px-1">
                                    <label for="txt_mname" class="lbl">Middle Name</label><br>
                                    <input type="text" id="mng_txt_mname" maxlength="36" name="txt_mname"
                                           class="form-control lettersOnly">
                                </div>

                                <div class="form-group col-4 px-1">
                                    <label for="mng_txt_lname" class="lbl">Last Name <font color="red">*</font></label><br>
                                    <input type="text" id="mng_txt_lname" maxlength="36" name="txt_lname"
                                           class="form-control lettersOnly">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="form-group col-6 px-1">
                                    <label for="sel_sex" class="lbl">Sex <font color="red">*</font></label><br>
                                    <select id="mng_sel_sex" name="sel_sex" class="form-control sel-sex">
                                    </select>
                                </div>
                                <div class="form-group access-adj col-6 px-1">
                                    <label for="txt_email" class="lbl">Email Address <font color="red">*</font>
                                    </label><br>
                                    <input type="email" id="mng_txt_email" maxlength="60" name="txt_email"
                                           class="form-control noSpcStart">
                                </div>
                            </div>
                            <div class="form-group row access-adj">
                                <div class="form-group col-6 px-1">
                                    <label for="txt_tel" class="lbl">Telephone Number</label><br>
                                    <input type="text" id="mng_txt_tel" maxlength="20" name="txt_tel"
                                           class="form-control numbersOnly">
                                </div>
                                <div class="form-group col-6 px-1">
                                    <label for="txt_mob" class="lbl">Mobile Number <font color="red">*</font>
                                    </label><br>
                                    <input type="text" id="mng_txt_mob" maxlength="20" name="txt_mob"
                                           class="form-control numbersOnly">
                                </div>
                            </div>

                            <div class="form-group row px-1">
                                <label for="area_desc" class="lbl">Job Description <font color="red">*</font>
                                </label><br>
                                <textarea id="mng_area_desc" name="area_desc"
                                          class="form-control letNumDash txtarea--job_desc" rows="3" col=""></textarea>
                            </div>


                        </div>
                    </div>
                    <div class="content-footer float-right">
                        <button type="button" class="btn btn-cancel btn-modal-cancel closeUpdate" changes="0"
                                parentModal="modalUpdateUser" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-update btn-primary-orange btn-update-user">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="mdl-change-pw" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h5-title msgmodal-header">Reset Password</h5>
            </div>
            <div class="modal-body">
                <form id="frm-change-password" onsubmit="return false">  
                    <div class="form-group">
                        <label>New Password</label>
                        <label class="col-form-label lbl-show-hide-new  text-gray-500 mr-2 float-right"
                               data-stat="1">Show</label>
                        <font color="red"> *</font></label><br>
                        <input type="password" name="newpassword" class="form-control input-pw " check_strength='true' id="pw-new"
                               minlength="8" placeholder="••••••••">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-save">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>