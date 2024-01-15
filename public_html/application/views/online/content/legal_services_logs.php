
<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//session_destroy();
//echo "<pre>";
//print_r($log_details);
//echo "</pre>";

/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="page-content-inner">
    <div class="content-body">    
        <div class="card p1rem">
            <div class="content-body-container" >
                <div class=" card-stats-inner " >
                    <div class="col-md-12 col-lg-12 col-sm-12">

                        <div class="row">
                            <div class="col-md-12 col-lg-6 col-sm-12">
                                <span class="text-left content-title" id="vsid" datavsid="<?= $log_details['case_services']['case_victim_services_id'] ?>"><a>List of Service Log</a></span><br>
                                <small class="content-desc"><?= $log_details['case_services']['service_name'] ?></small><br>
                                <small class="content-desc"><?= $log_details['case_services']['service_duration'] ?></small>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <span class="icms-text-secondary">Report Number : </span><span><?= $log_details['case_details']['case_number'] ?></span><br>
                                <span class="icms-text-secondary">Victim Name : </span>
                                <span> <?= ucwords($log_details['victim_details']['victim_info_last_name']) ?>,</span>
                                <span> <?= ucwords($log_details['victim_details']['victim_info_first_name']) ?></span>
                                <span> <?= ucwords($log_details['victim_details']['victim_info_middle_name']) ?></span>
                                <br>
                                <span class="icms-text-secondary">Added By :</span>
                                <span>  
                                    <?= $log_details['case_details']['agency_abbr'] ?> - 
                                    <?= $log_details['case_details']['agency_branch'] ?>
                                    on 
                                    <?= date("F d Y, h:i:s A", strtotime($log_details['case_details']['case_date_added'])) ?>


                                </span>
                            </div>
                        </div>

                        <!--                        <div class="p-3 mt-3 victim-title">
                                                    <span class="" style="font-size: 16px;">Report Details</span><br>
                                                    <span class="">Report Number: CN093058 </span><span class=" divider_ px-2">·</span>
                                                    <span class="">Victim name: Annalyn Ayop </span><span class="divider_ px-2">·</span>
                                                    <span class="">Added by OPLE Center </span><span clas="ml-2 "> on July 31, 2019 10:55:39 PM </span>
                                                </div>-->
                        <div class=" case-list">
                            <div class="card-body" style="padding: 20px 0px;">
                                <div class=" form-row-services col-header row-header-border">
                                    <div class=" text-center date-services">
                                        <span class="text-normal ">Date</span>
                                    </div>
                                    <div class="details-services padding-l-10">
                                        <span class="text-normal "> Details</span>

                                    </div>
                                </div>

                                <div class="card-wrapper-services" id="log-history-container">
                                    <div class="initial-loading" style="text-align: center">
                                        <div class="spinner-grow text-primary" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <div class="spinner-grow text-primary" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <div class="spinner-grow text-primary" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <br>
                                        Please wait . . .
                                    </div>
                                    <hr>

                                    <!--                                    <div class="row form-row form-row-services">
                                                                            <div class="col-lg-2 col-md-2 col-sm-2">
                                                                                <div class="text-center">
                                                                                    <span class="task-date">9</span><br>
                                                                                    <span class="task-month">APR 2019</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-10 col-md-10 col-sm-10 ">
                                                                                <span class="task-subj">This is a sample task</span><br>
                                                                                <div class="details-services ">
                                                                                    <div class="" style="font-size: 14px;">
                                                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum 
                                                                                        has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                                                                                        of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also
                                                                                        the leap into electronic typesetting, remaining essentially unchanged. 
                                                                                    </div>
                                                                                </div>
                                                                                <div class="subremarks_details mt-2 ">     
                                                                                    <span>Remarks by: </span><span>OPLE Center </span><br>
                                                                                </div>
                                                                            </div>
                                                                        </div><hr>-->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--CREATE NEW REMARKS/UPDATES-->
<div class="modal fade" id="modal-add_new_remarks"  role="dialog">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title "> Add Service Update</h5>

            </div>
            <div class="modal-body msgmodal-body">
                <form id="form-add_education_info" class="col-12">
                    <div class="col-12">
                        <div class="row field-education_grade_year">
                            <div class="form-group col-12">
                                <label>Subject</label>

                                <textarea class="form-control " placeholder="Brief status report..." style="height: 50px !important;" ></textarea>
                                <small class="text-gray-500 ">
                                    ex. Preliminary Investigation
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Description/ Remarks </label>

                                <textarea class="form-control " placeholder="" style="height: 110px !important;" ></textarea>
                                <small class="text-gray-500 ">
                                    This is a status remarks for legal service.
                                </small>
                            </div>
                        </div>

                    </div>
                    <div class="content-footer float-right  match-buttons">
                        <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                        <button type="submit" class="btn btn-primary-orange btn-next" style="margin-left:0px;" >Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>