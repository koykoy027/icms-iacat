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
defined('BASEPATH') or exit('No direct script access allowed');
?>


<div class="page-content-inner">
    <div class="content-body">
        <div class="card p1rem">
            <div class="content-body-container">
                <div class=" card-stats-inner ">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card-title ">
                                <p> List of Reintegration Services</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12 col-sm-12">

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 text-right float-right">
                                <div class="list-action mb-3">
                                    <input class="txt_search" id="txt_search-lls" type="search" placeholder="Search Report ID..." aria-label="Search">
                                    <!--                                    <select class="select select-filter sel-filter">
                                        <option disabled selected>Search by </option>
                                        <option value="0">All</option>
                                        <option value="1">Victim number</option>
                                        <option value="2">Name</option>
                                    </select>

                                    <select class="select select-filter sel-orderby">
                                        <option value="0" disabled selected="">Order by</option>
                                        <option value="0">All</option>
                                        <option value="1">Victim number</option>
                                        <option value="2">Name</option>
                                        <option value="2">Date created</option>
                                    </select>-->
                                    <!--<div class="d-inline-block pl-1">
                                        <button type="button" class="btn btn-secondary-light_blue  btn-quick-actions " data-target="dropdownnotifyButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Search By <i class="fas fa-angle-down pl-3"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown_filter shadow pb-0" id="dropdownnotifyButton" x-placement="bottom-start">
                                            <a class="dropdown-item disabled action-title" href="#">Search By</a>
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
                                    </div>-->
                                    <!--<div class="d-inline-block">
                                        <button type="button" class="btn btn-secondary-light_blue  btn-quick-actions " data-target="dropdownnotifyButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Order By <i class="fas fa-angle-down pl-3"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown_filter shadow pb-0" id="dropdownnotifyButton1" x-placement="bottom-start">
                                            <a class="dropdown-item disabled action-title" href="#">Order by</a>
                                            <ul class="list-group">

                                                <li class="list-group-item">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input chk-filter" name="orderBy" type="checkbox" id="AN_1" value="1">
                                                        <label class="form-check-label" for="1">All</label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input chk-filter" name="orderBy" type="checkbox" id="AN_2" value="2">
                                                        <label class="form-check-label" for="2">Victim Number</label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input chk-filter" name="orderBy" type="checkbox" id="AN_2" value="2">
                                                        <label class="form-check-label" for="3">Name</label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input chk-filter" name="orderBy" type="checkbox" id="AN_2" value="2">
                                                        <label class="form-check-label" for="4">Date</label>
                                                    </div>
                                                </li>
                                                <li class="filter_action-btn hide">
                                                    <button class="dropdown-item btn-filter_clear " type="button">Clear</button>
                                                    <button class="dropdown-item btn-filter_list " type="button">Filter </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>-->
                                    <!--<div class="d-inline-block">
                                        <button type="button" class="btn btn-secondary-light_blue  btn-quick-actions " data-target="dropdownnotifyButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                           Filter
                                            <i class="fas fa-angle-down pl-3"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown_filter shadow pb-0" id="dropdownnotifyButton1" x-placement="bottom-start">
                                            <a class="dropdown-item disabled action-title" href="#">Legal Services</a>
                                            <ul class="list-group filter_list">

                                                <li class="list-group-item">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input chk-filter" name="orderBy" type="checkbox" id="AN_1" value="1">
                                                        <label class="form-check-label" for="1">All</label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input chk-filter" name="orderBy" type="checkbox" id="AN_2" value="2">
                                                        <label class="form-check-label" for="2">Victim Number</label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input chk-filter" name="orderBy" type="checkbox" id="AN_2" value="2">
                                                        <label class="form-check-label" for="3">Name</label>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input chk-filter" name="orderBy" type="checkbox" id="AN_2" value="2">
                                                        <label class="form-check-label" for="4">Date</label>
                                                    </div>
                                                </li>
                                                <li class="filter_action-btn hide">
                                                    <button class="dropdown-item btn-filter_clear " type="button">Clear</button>
                                                    <button class="dropdown-item btn-filter_list " type="button">Filter </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 px-5" id="victim_list">
                            <div class="row-header">
                                <div class="row row-header-border">
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-header py-2 px-2">Service Details</div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-header py-2 px-2">Status</div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-header py-2 px-2">Action</div>
                                </div>
                            </div>

                            <div class="card-height">
                                <ul class="list_content" id="ul-list">
                                    <!--<li style="width:100%">
                                        <div class="card">
                                            <div class="row">
                                                <div class="col-lg-7 col-md-7 col-sm-7  align-items-center " data-toggle="modal" data-target="#modal-manage-accused">
                                                    <div class="nav-data_list ">
                                                        <div class="agency_details">
                                                            <span class="icms-text-secondary">Name of Accused : </span><span>Ian Joseph G. Navarro </span>
                                                            <br> <span class="icms-text-secondary">Stage of Case : </span><span> Preliminary Investigation </span>
                                                            <br> <span class="icms-text-secondary">Date Archived : </span><span> August 22, 2019 06:14:24 PM </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 txt-align_center d-flex align-items-center " data-toggle="modal" data-target="#modal-manage-accused"> <span class="stat_">Criminal Case</span></div>
                                                <div class="col-lg-2 col-md-2 col-sm-2">
                                                    <button class="btn dropdown-toggle" type="button" id="dropdown_service" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </button>
                                                    <div class="dropdown-menu shadow action-menu" aria-labelledby="dropdown_service">
                                                        <a class="dropdown-item disabled action-title" href="#">Select Action</a>
                                                        <button class="dropdown-item" type="button" data-toggle="modal" data-target="#modal-manage-accused">Manage Service</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li style="width:100%">
                                        <div class="card">
                                            <div class="row">
                                                <div class="col-lg-7 col-md-7 col-sm-7  align-items-center " data-toggle="modal" data-target="#modal-manage-accused">
                                                    <div class="nav-data_list ">
                                                        <div class="agency_details">
                                                            <span class="icms-text-secondary">Name of Accused : </span><span>Annalyn Ayop</span>
                                                            <br> <span class="icms-text-secondary">Stage of Case : </span><span> Preliminary Investigation </span>
                                                            <br> <span class="icms-text-secondary">Date Archived : </span><span> August 22, 2019 06:14:24 PM </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3  txt-align_center d-flex align-items-center " data-toggle="modal" data-target="#modal-manage-accused"> <span class="stat_1">Administrative Case</span></div>
                                                <div class="col-lg-2 col-md-2 col-sm-2">
                                                    <button class="btn dropdown-toggle" type="button" id="dropdown_service" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </button>
                                                    <div class="dropdown-menu shadow action-menu" aria-labelledby="dropdown_service">
                                                        <a class="dropdown-item disabled action-title" href="#">Select Action</a>
                                                        <button class="dropdown-item" type="button" data-toggle="modal" data-target="#modal-manage-accused">Manage Service</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li style="width:100%">
                                        <div class="card">
                                            <div class="row">
                                                <div class="col-lg-7 col-md-7 col-sm-7   align-items-center " data-toggle="modal" data-target="#modal-manage-accused">
                                                    <div class="nav-data_list ">
                                                        <div class="agency_details">
                                                            <span class="icms-text-secondary">Name of Accused : </span><span>Raymark Sevilla</span>
                                                            <br> <span class="icms-text-secondary">Stage of Case : </span><span> Preliminary Investigation </span>
                                                            <br> <span class="icms-text-secondary">Date Archived : </span><span> August 22, 2019 06:14:24 PM </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3  txt-align_center d-flex align-items-center " data-toggle="modal" data-target="#modal-manage-accused"> <span class="stat_">Criminal Case</span></div>
                                                <div class="col-lg-2 col-md-2 col-sm-2">
                                                    <button class="btn dropdown-toggle" type="button" id="dropdown_service" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </button>
                                                    <div class="dropdown-menu shadow action-menu" aria-labelledby="dropdown_service">
                                                        <a class="dropdown-item disabled action-title" href="#">Select Action</a>
                                                        <button class="dropdown-item" type="button" data-toggle="modal" data-target="#modal-manage-accused">Manage Service</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li style="width:100%">
                                        <div class="card">
                                            <div class="row">
                                                <div class="col-lg-7 col-md-7 col-sm-7  align-items-center " data-toggle="modal" data-target="#modal-manage-accused">
                                                    <div class="nav-data_list ">
                                                        <div class="agency_details">
                                                            <span class="icms-text-secondary">Name of Accused : </span><span>Jocel Christine Laya-an</span>
                                                            <br> <span class="icms-text-secondary">Stage of Case : </span><span> Preliminary Investigation </span>
                                                            <br> <span class="icms-text-secondary">Date Archived : </span><span> August 22, 2019 06:14:24 PM </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 txt-align_center d-flex align-items-center " data-toggle="modal" data-target="#modal-manage-accused"> <span class="stat_">Criminal Case</span></div>
                                                <div class="col-lg-2 col-md-2 col-sm-2">
                                                    <button class="btn dropdown-toggle" type="button" id="dropdown_service" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </button>
                                                    <div class="dropdown-menu shadow action-menu" aria-labelledby="dropdown_service">
                                                        <a class="dropdown-item disabled action-title" href="#">Select Action</a>
                                                        <button class="dropdown-item" type="button" data-toggle="modal" data-target="#modal-manage-accused">Manage Service</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>-->
                                </ul>
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
    </div>
</div>

<div class="modal fade " id="modal-manage-accused" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content mdl-case-details">
            <span class="content-title mdl-legal-title"> Manage Legal Service details</span>
            <small class="content-sub-title">Update details of legal services.</small>
            <form id="frm-reopen"> 
                <div class="modal-body">
                    <div class="row" id="mdl-body-case-detais">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="pl-25 ">
                                <div class="mdl-content">
                                    <span class="icms-text-secondary">Name of Accused : </span><span class="icms-text-black">Kimberly Visperas Bado</span><br>
                                    <span class="icms-text-secondary">Type of Case : </span><span class="icms-text-black">Administrative Case</span><br>
                                    <span class="icms-text-secondary">Date Archived : </span><span class="icms-text-black">June 23, 2019</span><br>
                                    <span class="icms-text-secondary">Stage of Case: </span><span class="icms-text-black">Preliminary Investigation</span><br>
                                    <span class="icms-text-secondary">Last update : </span><span class="icms-text-black">June 23, 2019</span><br>
                                    <span class="icms-text-secondary">Description/Remarks<font color="red"><b>*</b></font> : </span><br>
                                </div>
                                <span class="icms-text-secondary">Description/Remarks<font color="red"><b>*</b></font> : </span><br>
                                <textarea name="area_remarks" id="area_remarks" class="form-control" placeholder="" style="height: 110px !important;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-close btn-cancel float-right" data-dismiss="modal"> Close </button>
                    <button type="submit" class="btn btn-update">Re-open Service</button>
                </div>
            </form> 
        </div>
    </div>
</div>
