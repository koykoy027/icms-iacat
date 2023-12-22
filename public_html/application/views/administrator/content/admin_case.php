<?php
/**
 * Page Security
 */
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="page-content-inner">
    <div class="content-body">
        <div class="card p1rem">
            <div class="content-body-container">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="card-title">
                            <p>Administrative Case</p>
                        </div>
                    </div>
                </div>
                <div class="card p1rem">
                    <div class="content-body-container ">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-sm-12 ">
                                <ul class="nav nav-pills nav-fill legal-ul" id="legal-ul" data-id="1">
                                    <li class="nav-item nav-inner-item li-all-cases">
                                        <a class="nav-link active nav-tab" id="a-report_list" data-toggle="tab" href="#victim_list">Report List</a>
                                    </li>
                                    <li class="nav-item nav-inner-item li-created-cases">
                                        <a class="nav-link  nav-tab" id="a-administrative_list" data-toggle="tab" href="#admin_case">Administrative Case </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content tab-legal">
                            <div class="tab-pane fade show active " id="victim_list" role="tabpanel" aria-labelledby="recent-case-tab">
                                <div class=" card-stats-inner ">
                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                        <div class="row mb-3">
                                            <div class="col-md-4 col-lg-4 col-sm-12">
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 text-right">
                                                <div class="list-action">
                                                    <input class="txt_search" id="txt_search-report_list" type="search" placeholder="Search Report ID" aria-label="Search">
                                                    <div class="btn-group d-inline-block">
                                                        <button type="button" class="btn btn-secondary-light_blue" data-toggle="modal" data-target="#modal-create_new_batch">
                                                            <i class="fa fa-cog" aria-hidden="true"></i> Create Docket
                                                        </button>
<!--                                                        <div class="dropdown-menu shadow-sm">
                                                            <a class="dropdown-item disabled action-title" href="#">Options</a>
                                                            <button class="dropdown-item" type="button" data-toggle="modal" data-target="#modal-create_new_batch">Create docket</button>
                                                        </div>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12" id="cnt_rl_listing">
                                            <div class="row-header">
                                                <div class="row row-header-border">
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-header"><span class="padding-l-10">Report Details </span></div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-header"></div>
                                                </div>
                                            </div>
                                            <ul class=" list_content victim_list" id="rl-list">
                                            </ul>
                                            <div class="pagination-wrapper rs-list-rl">
                                                <div class="row">
                                                    <div class="col m12 s12 l4">
                                                        <p class="pagination-details rs-info-rl"></p>
                                                    </div>
                                                    <div class="col m12 s12 l8 text-right">
                                                        <ul class="pagination rs-pagination-rl">
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--ADMINISTRATIVE CASE-->
                            <div class="tab-pane fade" id="admin_case" role="tabpanel" aria-labelledby="recent-case-tab">
                                <div class=" card-stats-inner ">
                                    <div class="col-md-12 col-lg-12 col-sm-12">

                                        <div class="row mb-3">
                                            <div class="col-md-4 col-lg-4 col-sm-4">
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 text-right">
                                                <div class="list-action">
                                                    <input class="txt_search" id="txt_search-batchlist" type="search" placeholder="Search Batch ID" aria-label="Search">
                                                    <div class="btn-group d-inline-block">
                                                        <button type="button" class="btn btn-secondary-light_blue" data-toggle="modal" data-target="#modal-create_new_batch">
                                                            <i class="fa fa-cog" aria-hidden="true"></i> Create Docket
                                                        </button>
<!--                                                        <div class="dropdown-menu shadow-sm">
                                                            <a class="dropdown-item disabled action-title text-gray-500" href="#">Options</a>
                                                            <button class="dropdown-item" type="button" data-toggle="modal" data-target="#modal-create_new_batch">Create docket</button>
                                                        </div>-->
                                                    </div>
                                                    <select class="select select-filter sel-filter" style="display: none">
                                                        <option disabled selected>Search by </option>
                                                        <option value="0">All</option>
                                                        <option value="1">Victim number</option>
                                                        <option value="2">Name</option>
                                                    </select>

                                                    <select class="select select-filter sel-orderby" style="display: none">
                                                        <option value="0" disabled selected="">Order by</option>
                                                        <option value="0">All</option>
                                                        <option value="1">Victim number</option>
                                                        <option value="2">Name</option>
                                                        <option value="2">Date created</option>
                                                    </select>
                                                    <!--<button class="btn btn-secondary-light_blue" data-toggle="modal" data-target="#modal-add_new_remarks">Add group</button>-->
                                                </div>

                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12" id="cnt_ac_listing">
                                                <div class="row-header-border">
                                                    <div class="card">
                                                        <div class="row">
                                                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12  align-items-center ">
                                                                <span>Batch Details</span>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 txt-align_center d-flex align-items-center ">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="">

                                                    <ul class=" list_content victim_list" id="ac_batch_list">

                                                    </ul>
                                                    <div class="pagination-wrapper rs-list-batch_list">
                                                        <div class="row">
                                                            <div class="col m12 s12 l4">
                                                                <p class="pagination-details rs-info-batch_list"></p>
                                                            </div>
                                                            <div class="col m12 s12 l8 text-right">
                                                                <ul class="pagination rs-pagination-batch_list">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--CASE MANAGEMENT STAGES-->
<div class="modal fade bd-example-modal-xl" id="mdl-victim-details" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Administrative Case Management </h5>
            </div>
            <div class="modal-body overflow-auto">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="settings_content">
                            <div class="row">
                                <div class="col-lg-4 col-md-5 col-sm-12 pl-0 border-right">
                                    <!--stepper goes here-->
                                    <div class="history-tl-container">
                                        <ul class="tl" id="ul-stages">
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-8 col-tab-content">
                                    <div class="container  p-2">
                                        <div class=""></div>

                                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                            <div class="panel panel-default">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="stage_1 stage-bg active show">
                                        <form id="form-stage-1" class="form-stage-1">
                                            <div class="m-2 p-3">
                                                <div class="rowform-row">
                                                    <div class="col-12">
                                                        <div class="mb-3 bg-white ">
                                                            <div class="card">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-lg-6 col-sm-12  card-sub-title blue  txt-W-500 mb-0"> Filing and Receipt of Complaints</div>
                                                                    <div class="col-md-12 col-lg-6 col-sm-12  card-sub-title blue txt-W-500 mb-0">
                                                                        <div class="mt-1 list-action-filter float-right">
                                                                            <div class=" mt-1 show list-action-filter float-right">
                                                                                <div class="d-inline-block pl-1">
                                                                                    <button type="button" class="btn btn-primary-orange  btn-quick-actions " data-target="dropdownnotifyButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                                        Status <i class="fas fa-angle-down pl-3"></i>
                                                                                    </button>
                                                                                    <div class="dropdown-menu dropdown_filter shadow pb-0" id="dropdownnotifyButton" x-placement="bottom-start">
                                                                                        <a class="dropdown-item disabled action-title pl-2" href="#">Select status</a>
                                                                                        <ul class="list-group list-status">
                                                                                            <li class="list-group-item">
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input inp-stat-ongoing" type="radio" name="stage_status" id="inp-stat-ongoing" value="0">
                                                                                                    <label class="form-check-label" for="inp-stat-ongoing">
                                                                                                        On Going
                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="list-group-item">
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input inp-stat-done" type="radio" name="stage_status" id="inp-stat-done" value="1">
                                                                                                    <label class="form-check-label" for="inp-stat-done">
                                                                                                        Done
                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                                <!--                                                                                <div class="d-inline-block">
                                                                                                                                                                    <button type="button" class="btn btn-action btn-add_layover "  data-toggle="modal"  data-target="#">Update </button>
                                                                                                                                                                </div>-->

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 bg-white p-2">
                                                            <div class="card">
                                                                <div class="row">
                                                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                        <label>Date <font color="red"> <b>*</b> </font> </label>
                                                                        <input type="text" class="form-control datepicker" placeholder="MM/DD/YYYY" name="inp_date_remarks">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Case Number <font color="red"> <b>*</b> </font> </label>
                                                                        <input type="text" class="form-control" name="case_number">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Remarks <font color="red"> <b>*</b> </font> </label>
                                                                    <textarea class="form-control textarea-xs" name="inp_remarks"></textarea>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="content-footer float-right match-buttons">
                                                                            <button type="button" class="btn btn-action btn-add_layover btn-cancel ml-0 mb-2" style=" display: none">Cancel</button>
                                                                            <button type="button" class="btn btn-primary-orange btn-next btn-edit ml-0" >Edit</button>
                                                                            <button type="submit" class="btn btn-primary-orange btn-next btn-submit ml-0 mb-2" style=" display: none">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!--Stage 2-->
                                    <div class="stage_2 stage-bg">
                                        <form id="form-stage-2" class="form-stage-2">
                                            <div class="m-2 py-3">
                                                <div class="rowform-row">
                                                    <div class="col-12">
                                                        <div class="mb-3 bg-white ">
                                                            <div class="card">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-lg-6 col-sm-12  card-sub-title blue  txt-W-500 mb-0"> On-Site Complaints for Violation of POEA Rules</div>
                                                                    <div class="col-md-12 col-lg-6 col-sm-12 card-sub-title blue txt-W-500 mb-0">
                                                                        <div class="mt-1 list-action-filter float-right">
                                                                            <div class=" mt-1 show list-action-filter float-right">
                                                                                <div class="d-inline-block pl-1">
                                                                                    <button type="button" class="btn btn-primary-orange  btn-quick-actions " data-target="dropdownnotifyButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                                        Status <i class="fas fa-angle-down pl-3"></i>
                                                                                    </button>
                                                                                    <div class="dropdown-menu dropdown_filter shadow pb-0" id="dropdownnotifyButton" x-placement="bottom-start">
                                                                                        <a class="dropdown-item disabled action-title pl-2" href="#">Select status</a>
                                                                                        <ul class="list-group list-status">
                                                                                            <li class="list-group-item">
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input inp-stat-ongoing" type="radio" name="stage_status" id="inp-stat-ongoing" value="0">
                                                                                                    <label class="form-check-label" for="inp-stat-ongoing">
                                                                                                        On Going
                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="list-group-item">
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input inp-stat-done" type="radio" name="stage_status" id="inp-stat-done" value="1">
                                                                                                    <label class="form-check-label" for="inp-stat-done">
                                                                                                        Done
                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                                <!--                                                                                <div class="d-inline-block">
                                                                                                                                                                    <button type="button" class="btn btn-action btn-add_layover "  data-toggle="modal"  data-target="#">Update </button>
                                                                                                                                                                </div>-->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="card">
                                                                <div class="row">
                                                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                        <label>Date <font color="red"> <b>*</b> </font> </label>
                                                                        <input type="text" class="form-control datepicker" placeholder="MM/DD/YYYY" name="inp_date_remarks">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Remarks <font color="red"> <b>*</b> </font> </label>
                                                                    <textarea class="form-control textarea-xs" name="inp_remarks"></textarea>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="content-footer float-right match-buttons">
                                                                            <button type="button" class="btn btn-action btn-add_layover btn-cancel ml-0 mb-2" style="display: none">Cancel</button>
                                                                            <button type="button" class="btn btn-primary-orange btn-next btn-edit ml-0" >Edit</button>
                                                                            <button type="submit" class="btn btn-primary-orange btn-next btn-submit ml-0 mb-2" style="display: none">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!--End Stage 2-->
                                    <div class="stage_3 stage-bg">
                                        <form id="form-stage-3" class="form-stage-3">
                                            <div class="m-2 py-3">
                                                <div class="rowform-row">
                                                    <div class="col-12">
                                                        <div class="mb-3 bg-white ">
                                                            <div class="card">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-lg-6 col-sm-12  card-sub-title blue  txt-W-500 mb-0"> Issuance and Implementation of Closure Order</div>
                                                                    <div class="col-md-12 col-lg-6 col-sm-12 card-sub-title blue txt-W-500 mb-0">
                                                                        <div class="mt-1 list-action-filter float-right">
                                                                            <div class=" mt-1 show list-action-filter float-right">
                                                                                <div class="d-inline-block pl-1">
                                                                                    <button type="button" class="btn btn-primary-orange  btn-quick-actions " data-target="dropdownnotifyButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                                        Status <i class="fas fa-angle-down pl-3"></i>
                                                                                    </button>
                                                                                    <div class="dropdown-menu dropdown_filter shadow pb-0" id="dropdownnotifyButton" x-placement="bottom-start">
                                                                                        <a class="dropdown-item disabled action-title pl-2" href="#">Select status</a>
                                                                                        <ul class="list-group list-status">
                                                                                            <li class="list-group-item">
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input inp-stat-ongoing" type="radio" name="stage_status" id="inp-stat-ongoing" value="0">
                                                                                                    <label class="form-check-label" for="inp-stat-ongoing">
                                                                                                        On Going
                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="list-group-item">
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input inp-stat-done" type="radio" name="stage_status" id="inp-stat-done" value="1">
                                                                                                    <label class="form-check-label" for="inp-stat-done">
                                                                                                        Done
                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                                <!--                                                                                <div class="d-inline-block">
                                                                                                                                                                    <button type="button" class="btn btn-action btn-add_layover "  data-toggle="modal"  data-target="#">Update </button>
                                                                                                                                                                </div>-->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="card">
                                                                <div class="row">
                                                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                        <label>Date <font color="red"> <b>*</b> </font> </label>
                                                                        <input type="text" class="form-control datepicker" placeholder="MM/DD/YYYY" name="inp_date_remarks">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Remarks <font color="red"> <b>*</b> </font> </label>
                                                                    <textarea class="form-control textarea-xs" name="inp_remarks"></textarea>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="content-footer float-right match-buttons">
                                                                            <button type="button" class="btn btn-action btn-add_layover btn-cancel ml-0 mb-2" style="display: none">Cancel</button>
                                                                            <button type="button" class="btn btn-primary-orange btn-next btn-edit ml-0" >Edit</button>
                                                                            <button type="submit" class="btn btn-primary-orange btn-next btn-submit ml-0 mb-2" style="display: none">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="stage_4 stage-bg ">
                                        <form id="form-stage-4" class="form-stage-4">
                                            <div class="m-2 py-3">
                                                <div class="rowform-row">
                                                    <div class="col-12">
                                                        <div class="mb-3 bg-white">
                                                            <div class="card">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-lg-6 col-sm-12  card-sub-title blue  txt-W-500 mb-0"> Mandatory Conciliation of Complaints</div>
                                                                    <div class="col-md-12 col-lg-6 col-sm-12 card-sub-title blue txt-W-500 mb-0">
                                                                        <div class="mt-1 list-action-filter float-right">
                                                                            <div class=" mt-1 show list-action-filter float-right">
                                                                                <div class="d-inline-block pl-1">
                                                                                    <button type="button" class="btn btn-primary-orange  btn-quick-actions " data-target="dropdownnotifyButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                                        Status <i class="fas fa-angle-down pl-3"></i>
                                                                                    </button>
                                                                                    <div class="dropdown-menu dropdown_filter shadow pb-0" id="dropdownnotifyButton" x-placement="bottom-start">
                                                                                        <a class="dropdown-item disabled action-title pl-2" href="#">Select status</a>
                                                                                        <ul class="list-group list-status">
                                                                                            <li class="list-group-item">
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input inp-stat-ongoing" type="radio" name="stage_status" id="inp-stat-ongoing" value="0">
                                                                                                    <label class="form-check-label" for="inp-stat-ongoing">
                                                                                                        On Going
                                                                                                    </label>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="list-group-item">
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input inp-stat-done" type="radio" name="stage_status" id="inp-stat-done" value="1">
                                                                                                    <label class="form-check-label" for="inp-stat-done">
                                                                                                        Done
                                                                                                    </label>
                                                                                                </div>
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
                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="card">
                                                                <div class="row">
                                                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                        <label>Date <font color="red"> <b>*</b> </font> </label>
                                                                        <input type="text" class="form-control datepicker" placeholder="MM/DD/YYYY" name="inp_date_remarks">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Remarks <font color="red"> <b>*</b> </font> </label>
                                                                    <textarea class="form-control textarea-xs" name="inp_remarks"></textarea>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="content-footer float-right match-buttons">
                                                                            <button type="button" class="btn btn-action btn-add_layover btn-cancel ml-0 mb-2" style="display: none">Cancel</button>
                                                                            <button type="button" class="btn btn-primary-orange btn-next btn-edit ml-0">Edit</button>
                                                                            <button type="submit" class="btn btn-primary-orange btn-next btn-submit ml-0 mb-2" style=" display: none">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary-orange btn-next float-right mr-4" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!--CREATE NEW BATCH-->
<div class="modal fade" id="modal-create_new_batch" role="dialog" data-backdrop="static">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title "> Create Docket </h5>
            </div>
            <div class="modal-body msgmodal-body">
                <form id="form-create_batch" class="col-lg-12 col-md-12 col-sm-12">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row field-education_grade_year">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label> Docket Number <font color="red"> <b>*</b></font> </label>
                                <input type="text" class="form-control" name="inp_docket_num" id="inp_docket_num">
                            </div>
                        </div>
                        <div class="row field-education_grade_year">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label> Victim/s </label>
                                <input type="text" class="form-control" id="inp-create-search" autocomplete="off">
                                <small id="emailHelp" class="form-text text-muted">Search name of victim or report id to add to batch. (optional)</small>
                                <ul class="list-group c-out overflow-scroll" style=" max-height: 200px;" id="create-report-victim-search">
                                </ul>
                            </div>
                            <div class="victim_list_container">
                                <div class="tag-area" id="create-tags">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="content-footer float-right  match-buttons">
                        <button type="button" class="btn btn-cancel btn-modal-cancel" id="btn-close-mdl_create_batch">Cancel</button>
                        <button type="submit" class="btn btn-primary-orange btn-next ml-0">Add Batch</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--------------Victim logs Modals--------------->