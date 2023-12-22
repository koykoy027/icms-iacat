<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//session_destroy();
//echo "<pre>";
//print_r($_SESSION);
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="page-content-inner lvl-ra">
    <div class="content-body">
        <div class="card p1rem">
            <div class="content-body-container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card-title ">
                            <p> List of Reports</p>
                            <small class="card-desc">List of all created and tagged reports</small>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-end ">
                        <div class="card-title ">
                            <button type="button" class="btn btn-secondary-light_blue btn-quick-actions"
                                    id="btn-advanced_filter" aria-expanded="true"> Advance Filter </button>
                        </div>
                    </div>
                </div>

                 <div class="container-advanced_filter hide">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="shadow-sm p-3 card-wrapper-report">
                                <div class="container" id="div-advanced_filter">
                                    <div class="d-flex justify-content-between">
                                        <p class="stat-header mb-3 txt-blue">Advance Filter</p>
                                        <span class=" btn-close-floater btn-close_filter"><i
                                                class="fas fa-times"></i></span>
                                    </div>

                                    <form id="form-advanced_filter">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                    <p class="stat-header">Country:</p>
                                                    <div class="container"
                                                         style="max-height: 400px; overflow-y: scroll">
                                                        <div class="form-group " id="cvr-opt-country">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                    <label> Region </label>
                                                    <select class="form-control sel-regions a-vi-address_region"
                                                            name="region">
                                                    </select>
                                                </div>

                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                    <label> Province </label>
                                                    <select
                                                        class="form-control sel-provincesByRegionId a-vi-address_province"
                                                        name="province" disabled>
                                                    </select>
                                                </div>

                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                    <label> City </label>
                                                    <select class="form-control sel-cities a-vi-address_city"
                                                            name="city" disabled>
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-12">

                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                    <label>Departure Type</label>
                                                    <select class="form-control" id="emp-sel-departure"></select>
                                                </div>

                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                    <label> Age </label>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <input type="number" class="form-control inp-max_age"
                                                                   name="" aria-invalid="false" placeholder="From">
                                                        </div>
                                                        <div class="col-6">
                                                            <fieldset class="form-group">
                                                                <input type="number" class="form-control inp-min_age"
                                                                       name="" aria-invalid="false" placeholder="To">
                                                                </select>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                    <label>Sex</label>
                                                    <select class="form-control sel-sex vi-sex sel-sex-select2" name="sex">
                                                    </select>
                                                </div>

                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                    <label>Occupation</label>
                                                    <select class="form-control sel-occupations vi-job" name="">
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                    <label>Employer:</label>
                                                    <input type="text" class="form-control emp-employer-employer_name noSpcStart valid" 
                                                           name="employer_name" maxlength="50" autocomplete="off" aria-invalid="false">
                                                    <ul class="list-group c-out" style="width: 100%; overflow: scroll; max-height: 300px; display: none" id="employer-search">                        
                                                    </ul>
                                                </div>

                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                    <label>Local Agency:</label>
                                                    <input type="text" class="form-control emp-local-recruitment_agency_name ignore" name="agency_name" autocomplete="off">
                                                    <ul class="list-group c-out" style="width: 100%; overflow: scroll; max-height: 300px; display: none" id="ra-local-search"></ul>
                                                </div>

                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                    <label>Foreign Agency:</label>
                                                    <input type="text" class="form-control emp-foreign-recruitment_agency_name ignore" name="agency_name" autocomplete="off">
                                                    <ul class="list-group c-out" style="width: 100%; overflow: scroll; max-height: 300px; display: none;" id="ra-foreign-search"></ul> 
                                                </div>
                                                
                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                    <label> Service Agencies:</label>
                                                    <select class="form-control sel-agencies-branches"></select>
                                                </div>

                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                    <label> Service:</label>
                                                    <select class="form-control sel-assessment-services"></select>
                                                </div>

                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-12">

                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                    <p class="stat-header">Acts:</p>
                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12"
                                                         id="cvr-opt-tip_act">
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                    <p class="stat-header">Means:</p>
                                                    <div class="form-group col-lg-12 colm-md-12 col-sm-12"
                                                         id="cvr-opt-tip_mean">
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                    <p class="stat-header">Purposes:</p>
                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12"
                                                         id="cvr-opt-tip_purpose">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </form>

                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-secondary-light_blue"
                                                id="btn-search-advanced_filter" aria-expanded="true"> Search </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row tab-header mt-3">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <ul class="nav nav-pills nav-fill case-ul" id="case-ul" data-id="1">
                            <li class="nav-item nav-inner-item li-all-cases lvl-ce lvl-ch lvl-ca lvl-ra">
                                <a class="nav-link active nav-tab" data-toggle="tab" href="#all_case_tab">All
                                    User-Created Reports</a>
                            </li>
                            <li class="nav-item nav-inner-item li-created-cases lvl-ra lvl-ch">
                                <a class="nav-link  nav-tab" id="li-a_cct" data-toggle="tab"
                                    href="#created_case_tab">Created Reports</a>
                            </li>
                            <!--Tagged Agency Report-->
                            <li class="nav-item nav-inner-item li-tagged-cases lvl-ch lvl-ce lvl-ra">
                                <a class="nav-link nav-tab" data-toggle="tab" href="#tagged_case_tab">Tagged
                                    Services</a>
                            </li>
                            <!--Tagged User Report-->
                            <li class="nav-item nav-inner-item li-tagged-user-cases lvl-ra">
                                <a class="nav-link nav-tab" data-toggle="tab" href="#tagged_user_tab">Tagged Reports
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class=" card-stats-inner ">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="tab-content mgn-T-18 " id="myTabContent">
                            <!--ALL CASE TAB-->
                            <div class="tab-pane fade show active" id="all_case_tab" role="tabpanel"
                                aria-labelledby="recent-case-tab">
                                <div class="row">
                                    <div class="col-md-12 col-lg-6 col-sm-12">
                                        <span class="tags_ fw-400">Legend :</span>

                                        <div class="tags_item high-prio"> </div>
                                        <span class="tags_item-label">High Priority</span>

                                        <div class="tags_item med-prio"> </div>
                                        <span class="tags_item-label">Medium Priority</span>

                                        <div class="tags_item low-prio"> </div>
                                        <span class="tags_item-label">Low Priority</span>

                                    </div>

                                    <div class="col-md-12 col-lg-6 col-sm-12">

                                        <div class=" list-action  list-action-filter">
                                            <input class="txt_search" type="search" placeholder="search by report id..."
                                                id="txt_search-all" aria-label="Search" tab-count="1">
                                            <span class="hidden_tooltip_all" data-toggle="tooltip" data-placement="top"
                                                title='Press "Enter" to search keyword'></span>
                                            <button type="button"
                                                class="btn btn-secondary-light_blue  btn-quick-actions "
                                                data-target="ac-filter_button" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="true">
                                                Filter <i class="fas fa-angle-down pl-3"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown_filter shadow pb-0" id="ac-filter_button"
                                                x-placement="bottom-start">
                                                <ul class="list-group list-status">
                                                    <li class="list-group-item filter-title pl-2">
                                                        <a class="dropdown-item disabled action-title" href="#">Priority
                                                            level</a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input chk-filter" name="status"
                                                                type="checkbox" id="ac-f_hp" value="3">
                                                            <label class="form-check-label" for="ac-f_hp">High
                                                                Priority</label>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input chk-filter" name="status"
                                                                type="checkbox" id="ac-f_mp" value="2">
                                                            <label class="form-check-label" for="ac-f_mp">Medium
                                                                Priority </label>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input chk-filter" name="status"
                                                                type="checkbox" id="ac-f_lp" value="1">
                                                            <label class="form-check-label" for="ac-f_lp">Low Priority
                                                            </label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="mt-3" id="tab-content-1">
                                    <div class="row-header">
                                        <div class="row victim-list-header">
                                            <div class="col-lg-10 col-md-9 col-sm-9 col-xs-9 col-header"><span
                                                    class="padding-l-10">Reports</span></div>
                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 col-header"
                                                style="  padding: 10px 48px;">Action</div>
                                        </div>
                                    </div>
                                    <div class="div-allcase-list1  case-list1">

                                        <!-------------Loading Empty Placeholder for list  ------------>
                                        <ul class="nav agency-list_content filter_load_placeholder"> </ul>
                                        <!-------------------------------------------------------------->
                                        <ul class="div-all case-list list_content" id="list-all_cases"> </ul>
                                    </div>
                                    <div class="pagination-wrapper rs-list-all">
                                        <div class="row">
                                            <div class="col col-lg-6 col-md-6 col-sm-12">
                                                <p class="pagination-details rs-info-all"></p>
                                            </div>
                                            <div class="col col-lg-6 col-md-6 col-sm-12 text-right">
                                                <ul class="pagination rs-pagination-all">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--END ALL CASE TAB-->

                            <!--CREATED CASE TAB-->
                            <div class="tab-pane fade  " id="created_case_tab" role="tabpanel"
                                aria-labelledby="recent-case-tab">
                                <div class="row">
                                    <div class="col-md-12 col-lg-6 col-sm-12">
                                        <span class="tags_ fw-400">Legend :</span>

                                        <div class="tags_item high-prio"> </div>
                                        <span class="tags_item-label">High Priority</span>

                                        <div class="tags_item med-prio"> </div>
                                        <span class="tags_item-label">Medium Priority</span>

                                        <div class="tags_item low-prio"> </div>
                                        <span class="tags_item-label">Low Priority</span>

                                    </div>

                                    <div class="col-md-12 col-lg-6 col-sm-12">

                                        <div class="list-action  list-action-filter text-right">
                                            <input class="txt_search" type="search" placeholder="search by report id..."
                                                id="txt_search-created" aria-label="Search">
                                            <span class="hidden_tooltip_created" data-toggle="tooltip"
                                                data-placement="top" title='Press "Enter" to search keyword'
                                                tab-count="2"></span>
                                            <button type="button"
                                                class="btn btn-secondary-light_blue  btn-quick-actions "
                                                data-target="cc-filter_button" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="true">
                                                Filter <i class="fas fa-angle-down pl-3"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown_filter shadow pb-0" id="cc-filter_button"
                                                x-placement="bottom-start">
                                                <ul class="list-group list-status">
                                                    <li class="list-group-item filter-title pl-2">
                                                        <a class="dropdown-item disabled action-title" href="#">Priority
                                                            level</a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input chk-filter" name="status"
                                                                type="checkbox" id="cc-f_hp" value="2">
                                                            <label class="form-check-label" for="cc-f_hp">High
                                                                Priority</label>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input chk-filter" name="status"
                                                                type="checkbox" id="cc-f_mp" value="3">
                                                            <label class="form-check-label" for="cc-f_mp">Medium
                                                                Priority </label>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input chk-filter" name="status"
                                                                type="checkbox" id="cc-f_lp" value="1">
                                                            <label class="form-check-label" for="cc-f_lp">Low Priority
                                                            </label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="mt-3" id="tab-content-2">
                                    <div class="row-header ">
                                        <div class="row victim-list-header">
                                            <div class="col-lg-10 col-md-9 col-sm-9 col-xs-9 col-header"><span
                                                    class="padding-l-10">Case details</span></div>
                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 col-header"
                                                style="  padding: 10px 48px;">Action</div>
                                        </div>
                                    </div>
                                    <div class="div-allcase-list1  case-list1">
                                        <!-------------Loading Empty Placeholder for list  ------------>
                                        <ul class="nav agency-list_content filter_load_placeholder"> </ul>
                                        <!-------------------------------------------------------------->
                                        <ul class="div-allcase-list  case-list list_content " id="list-created">
                                        </ul>

                                    </div>

                                    <div class="pagination-wrapper rs-list-created">
                                        <div class="row">
                                            <div class="col col-lg-6 col-md-6 col-sm-12">
                                                <p class="pagination-details rs-info-created"></p>
                                            </div>
                                            <div class="col col-lg-6 col-md-6 col-sm-12 text-right">
                                                <ul class="pagination rs-pagination-created">

                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--END CREATED CASE TAB-->

                            <!--TAGGED Agency CASE-->
                            <div class="tab-pane fade" id="tagged_case_tab" role="tabpanel"
                                aria-labelledby="recent-case-tab">


                                <div class="row">
                                    <div class="col-md-12 col-lg-6 col-sm-12">
                                        <span class="tags_" style="font-weight:400">Legend :</span>

                                        <div class="tags_item high-prio"> </div>
                                        <span class="tags_item-label">High Priority</span>

                                        <div class="tags_item med-prio"> </div>
                                        <span class="tags_item-label">Medium Priority</span>

                                        <div class="tags_item low-prio"> </div>
                                        <span class="tags_item-label">Low Priority</span>

                                    </div>

                                    <div class="col-md-12 col-lg-6 col-sm-12">

                                        <div class=" list-action  list-action-filter text-right">
                                            <input class="txt_search" type="search" placeholder="search by report id..."
                                                id="txt_search-tagged" aria-label="Search" tab-count="3">
                                            <span class="hidden_tooltip_tagged" data-toggle="tooltip"
                                                data-placement="top" title='Press "Enter" to search keyword'></span>
                                            <button type="button"
                                                class="btn btn-secondary-light_blue  btn-quick-actions "
                                                data-target="tac-filter_button" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="true">
                                                Filter <i class="fas fa-angle-down pl-3"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown_filter shadow pb-0"
                                                id="tac-filter_button" x-placement="bottom-start">
                                                <ul class="list-group list-status">
                                                    <li class="list-group-item filter-title pl-2">
                                                        <a class="dropdown-item disabled action-title" href="#">Priority
                                                            level</a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input chk-filter" name="status"
                                                                type="checkbox" id="tac-f_hp" value="2">
                                                            <label class="form-check-label" for="tac-f_hp">High
                                                                Priority</label>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input chk-filter" name="status"
                                                                type="checkbox" id="tac-f_mp" value="3">
                                                            <label class="form-check-label" for="tac-f_mp">Medium
                                                                Priority </label>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input chk-filter" name="status"
                                                                type="checkbox" id="tac-f_lp" value="1">
                                                            <label class="form-check-label" for="tac-f_lp">Low Priority
                                                            </label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-3" id="tab-content-3">

                                    <div class="row-header">
                                        <div class="row victim-list-header">
                                            <div class="col-lg-10 col-md-9 col-sm-9 col-xs-9 col-header"><span
                                                    class="padding-l-10">Tagged details</span></div>
                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 col-header"
                                                style="  padding: 10px 48px;">Action</div>
                                        </div>

                                        <div class="div-allcase-list1  case-list1">
                                            <!-------------Loading Empty Placeholder for list  ------------>
                                            <ul class="nav agency-list_content filter_load_placeholder"> </ul>
                                            <!-------------------------------------------------------------->
                                            <ul class="div-allcase-list  case-list list_content " id="list-tagged"></ul>
                                        </div>

                                        <div class="pagination-wrapper rs-list-tagged">
                                            <div class="row">
                                                <div class="col col-lg-6 col-md-6 col-sm-12">
                                                    <p class="pagination-details rs-info-tagged"></p>
                                                </div>
                                                <div class="col col-lg-6 col-md-6 col-sm-12 text-right">
                                                    <ul class="pagination rs-pagination-tagged">
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--END TAGGED AGENCY CASE-->

                            <!--TAGGED USER CASE TAB-->
                            <div class="tab-pane fade" id="tagged_user_tab" role="tabpanel"
                                aria-labelledby="recent-case-tab">


                                <div class="row">
                                    <div class="col-md-12 col-lg-6 col-sm-12">
                                        <span class="tags_" style="font-weight:400">Legend :</span>

                                        <div class="tags_item high-prio"> </div>
                                        <span class="tags_item-label">High Priority</span>

                                        <div class="tags_item med-prio"> </div>
                                        <span class="tags_item-label">Medium Priority</span>

                                        <div class="tags_item low-prio"> </div>
                                        <span class="tags_item-label">Low Priority</span>

                                    </div>

                                    <div class="col-md-12 col-lg-6 col-sm-12">

                                        <div class=" list-action  list-action-filter text-right">
                                            <input class="txt_search" type="search" placeholder="search by report id..."
                                                id="txt_search-tagged_user" aria-label="Search" tab-count="3">
                                            <span class="hidden_tooltip_tagged" data-toggle="tooltip"
                                                data-placement="top" title='Press "Enter" to search keyword'></span>
                                            <button type="button"
                                                class="btn btn-secondary-light_blue  btn-quick-actions "
                                                data-target="tuc-filter_button" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="true">
                                                Filter <i class="fas fa-angle-down pl-3"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown_filter shadow pb-0"
                                                id="tuc-filter_button" x-placement="bottom-start">
                                                <ul class="list-group list-status">
                                                    <li class="list-group-item filter-title pl-2">
                                                        <a class="dropdown-item disabled action-title" href="#">Priority
                                                            level</a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input chk-filter" name="status"
                                                                type="checkbox" id="tuc-f_hp" value="2">
                                                            <label class="form-check-label" for="tuc-f_hp">High
                                                                Priority</label>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input chk-filter" name="status"
                                                                type="checkbox" id="tuc-f_mp" value="3">
                                                            <label class="form-check-label" for="tuc-f_mp">Medium
                                                                Priority </label>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input chk-filter" name="status"
                                                                type="checkbox" id="tuc-f_lp" value="1">
                                                            <label class="form-check-label" for="tuc-f_lp">Low Priority
                                                            </label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-3" id="tab-content-4">

                                    <div class="row-header">
                                        <div class="row victim-list-header">
                                            <div class="col-lg-10 col-md-9 col-sm-9 col-xs-9 col-header"><span
                                                    class="padding-l-10">Tagged details</span></div>
                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 col-header"
                                                style="  padding: 10px 48px;">Action</div>
                                        </div>

                                        <div class="div-allcase-list1  case-list1">
                                            <!-------------Loading Empty Placeholder for list  ------------>
                                            <ul class="nav agency-list_content filter_load_placeholder"> </ul>
                                            <!-------------------------------------------------------------->
                                            <ul class="div-allcase-list  case-list list_content " id="list-tagged_user">
                                            </ul>
                                        </div>

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
                            <!--END TAGGED USER CASE TAB-->

                            <div class="tab-pane fade" id="archived_case_tab" role="tabpanel"
                                aria-labelledby="recent-case-tab">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="row-header">
                                        <div class="row">
                                            <div class="col col-md-2 col-sm-2 col-lg-2 col-header">Case Number</div>
                                            <div class="col col-md-3 col-md-3 col-lg-3 col-header">Case Details</div>
                                            <div class="col col-md-2 col-md-2 col-lg-2 col-header">Victim/s Name</div>
                                            <div class="col col-md-1 col-md-1 col-lg-1 col-header">Date Created</div>
                                            <div class="col col-md-2 col-md-2 col-lg-2 col-header">Created By</div>
                                            <div class="col col-md-1 col-md-1 col-lg-1 col-header">Status</div>
                                            <div class="col col-md-1 col-md-1 col-lg-1 col-header text-center">Action
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--pagination end-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>