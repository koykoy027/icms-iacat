<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Page Security
 */
defined('BASEPATH') or exit('No direct script access allowed');
?>


<div class="page-content-inner lvl-ra">
    <div class="content-body">
        <div class="card p1rem">
            <div class="content-body-container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card-title ">
                            <p> List of temporary cases</p>
                            <small class="card-desc">List of all temporary cases</small>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-end">
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
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                    <label>Country of deployment:</label>
                                                    <div class="container"
                                                         style="max-height: 400px; overflow-y: scroll">
                                                        <div class="form-group " id="cvr-opt-country">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-12">

                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                    <label> Name of Complainant</label>
                                                    <input type="text" class="form-control" name="name_complainant" aria-invalid="false">
                                                </div>

                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                    <label> Name of Victim </label>
                                                    <input type="text" class="form-control" name="name_victim" aria-invalid="false">
                                                </div>

                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                    <label> Date Submitted</label>
                                                    <input id="inp-date_submitted" class="form-control daterangepicker-field" />
                                                </div>

                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                    <label>Departure Type</label>
                                                    <select class="form-control valid" id="sel-departure" name="temporary_victim_departure_type" aria-invalid="false">
                                                    </select>
                                                </div>

                                                <!--<div class="form-group col-lg-12 col-md-12 col-sm-12">
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
                                                </div>-->

                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                    <label>Sex</label>
                                                    <select class="form-control sel-sex vi-sex sel-sex-select2" name="temporary_victim_sex">
                                                    </select>
                                                </div>

                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                    <label>Civil Status</label>
                                                    <select class="form-control valid sel-civil" name="temporary_victim_civil_status" aria-invalid="false">
                                                    </select>
                                                </div>

                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                    <label> Status</label>
                                                    <select class="form-control" id="sel-temporary_case_status_id" name="temporary_case_status_id">
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </form>

                                    <div class="d-flex justify-content-center m-3">
                                        <button type="button" class="btn btn-secondary-light_blue"
                                                id="btn-search-advanced_filter" aria-expanded="true"> Search </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" card-stats-inner ">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="tab-pane fade show active lvl-ce lvl-ch lvl-ca lvl-ra p-2" id="temporary_cases"
                             role="tabpanel" aria-labelledby="recent-case-tab">
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
                                    <ul class="div-all case-list list_content" id="list-temporary_cases"> </ul>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>