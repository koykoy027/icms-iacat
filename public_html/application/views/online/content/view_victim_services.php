<?php
//echo "<pre>";
//print_r($_SESSION);

/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="page-content-inner">
    <div class="content-body">    
        <div class="card" style="padding: 1rem;">
            <div class="content-body-container" >


                <div class=" card-stats-inner " >
                    <div class="row">
                        <div class="col-lg-5 col-md-12 col-sm-12">
                            <div class="card-title  div-title" data-mnid="<?= $this->yel->encrypt_param("1") ?>" data-brid="<?= $this->yel->encrypt_param($_SESSION['userData']['agency_branch_id']) ?>">
                                <p> Services logs</p>
                                <!--<small class="card-desc"> List of all agency branch.  </small>-->
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-12 col-sm-12">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <!--<span class="text-left content-title"><a>Services logs</a></span>-->
                            <div class='row'>
                                <div class='col-8'>
                                    <div class="pl-2 victim-title div_case_victim" dataloglnk="<?= $userLogLink ?>" datacasevictimid="<?= $case_victim['case_victim_id'] ?>">
                                        <span class="" style="font-size: 16px;">Report Details</span><br>
                                        <span class="spn_case" datacaseid="<?= $case_details['case_id'] ?>">Report Number: <?= $case_details['case_number'] ?> </span><span class=" divider_ px-2">·</span>
                                        <span class="spn_victim" datacvid="<?= $case_victim['case_victim_id'] ?>" datavictimid="<?= $victim_details['victim_id'] ?>">Victim name: <?= $victim_details['victim_info_first_name'] ?> <?= $victim_details['victim_info_middle_name'] ?> <?= $victim_details['victim_info_last_name'] ?> <?= $victim_details['victim_info_suffix'] ?></span><span class="divider_ px-2">·</span>
                                        <span class="">Added by <?= $case_details['agency_abbr'] ?> - <?= $case_details['agency_branch'] ?> </span><span clas="ml-2 "> on <?= date("F d, Y h:i A", strtotime($case_details['case_date_added'])) ?> </span>
                                    </div>
                                </div>
                                <div class='col-4'>
                                    <br><br> 
                                    <div class="list-action" style="float:right;    margin-top: -22px;">
<!--                                        <select class="select select-filter ml-1" id="sel-orderby">
                                        <option value="0" disabled="" selected="">Order by</option>
                                        <option value="1">Agency Name (A-Z)</option>
                                        <option value="2">Agency Name (Z-A)</option>
                                    </select>-->
                                        <button type="button" class="btn btn-secondary-light_blue lvl-ce lvl-ra" data-toggle="modal" data-target="#mdl-add-services" id="btn-mdl-newservices">
                                            <i class="fa fa-plus mr-1"></i> 
                                            Provide new service
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="container-services">
                                <div class="row col-head-services mb-4">
                                    <div class="col-lg-2 col-md-2 col-sm-3 col-header pl-2"> Date Modified</div>
                                    <div class="col-lg-7 col-md-7  col-sm-6 col-header pl-3">Tagged Agency</div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-header pl-5">Service Status</div>
                                </div>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

        </div>
    </div>
</div>
<!------------ Update Services Modal ------------->
<div class="modal fade " id="mdl-show-logs" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Service</h5>

            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

<!------------ Add Services Modal ------------->
<div class="modal fade" id="mdl-add-services"  role="dialog" data-backdrop="static"> 
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title "> Add Services Information</h5>
            </div>
            <div class="modal-body msgmodal-body">
                <form id="form-add_assessment_info" class="col-lg-12 col-md-12 col-sm-12"  data-assessmecol-12nt ="0" data-service ="0"  data-agencies ="0" onSubmit="return false;">
                    <div class="col-lg-12 col-md-12 col-sm-12">

                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label>Assessment Type <font color="red">*</font></label>
                                <select id="cd-mdl-sel-assmnt-type" name="assessment_type" class="form-control">
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label>Services <font color="red">*</font></label>
                                <select id="cd-mdl-sel-service" name="sel_service" class="form-control">
                                    <option selected disabled="true">Choose </option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label> Agencies <font color="red">*</font></label>
                                <br>
                                <select id="cd-mdl-sel-agncy" name="sel_agency" tabindex="-1" style="width: 100%; border-radius: 5px; height: 32px;" required="true">
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label> Expected delivery of service </label>
                                <input type="text" id="cd-mdl-txt-set-age_label" class="form-control" disabled="true">
                                <input type="hidden" id="cd-mdl-txt-set-age" class="form-control datepicker" placeholder="MM/DD/YYYY">
                            </div>
                        </div>
                        <div class="row row-cd-departure" style="display: none;">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label> Departure Date </label>
                                <input type="text" id="cd-mdl-txt-departure-date" class="form-control datetimepicker" placeholder="MM/DD/YYYY">
                            </div>
                        </div>
                        <div class="row row-cd-arrival" style="display: none;">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label> Arrival Date </label>
                                <input type="text" id="cd-mdl-txt-arrival-date"  class="form-control datetimepicker" placeholder="MM/DD/YYYY">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label>Remarks </label>
                                <textarea type="text" id="cd-mdl-txt-remarks"  maxlength="1000" class="form-control noSpcStart" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="content-footer float-right  match-buttons">
                        <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                        <button type="submit" class="btn btn-primary-orange btn-next btn-save-assessment ml-0"  disabled="disabled" >Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!--CREATE NEW REMARKS/UPDATES-->
<div class="modal fade" id="mdl-add_new_remarks"  role="dialog">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdl-add-new-update">Add New Update</h5>

            </div>
            <div class="modal-body">
                <form id="form-new-service-update" class="col-12">
                    <div class="col-12">
                        <div class="row ">
                            <div class="form-group col-12">
                                <label>Subject <font color="red"><b>*</b></font></label>

                                <input name="txt_subject" id="txt_subject" class="form-control " placeholder="Brief status report..."  >
                                <small class="text-gray-500 ">
                                    ex. Preliminary Investigation
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Description/ Remarks <font color="red"><b>*</b></font></label>

                                <textarea name="area_remarks" id="area_remarks" class="form-control " placeholder="" style="height: 110px !important;" ></textarea>
                                <small class="text-gray-500 ">
                                    This is a status remarks.
                                </small>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="form-group col-12">
                                <label>Service Status</label>

                                <select name="sel_service_stat" id="sel_service_stat" class="form-control" isChange="0">
                                </select>
                                <small class="text-gray-500 ">
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label>Set Reminder</label>
                                <input  id="txt_reminder" type="text" class="form-control log-reminder datetimepicker" name="reminder" placeholder="MM/DD/YYYY" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Reminder Description/ Remarks</label>

                                <textarea name="area_reminderremarks" id="area_reminderremarks" class="form-control " placeholder="" style="height: 110px !important;" ></textarea>
                                <small class="text-gray-500 ">
                                    This is a status remarks.
                                </small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-12">
                                <label>Document</label>
                                <input type="file" name="cdDocFile" id="cd-doc-file" accept="image/x-png,image/gif,image/jpeg,application/pdf,application/vnd.ms-excel,application/doc,application/docx,application/xls,application/xlsx,application/csv" class="form-control-file"  >
                                <small class="text-gray-500 ">
                                    Choose the file/zip file for this update
                                </small>
                            </div>
                        </div>
                    </div>

                </form>
                <div class="content-footer float-right  match-buttons">
                    <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                    <button type="submit" class="btn btn-primary-orange btn-modal-save" style="margin-left:0px;" >Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
