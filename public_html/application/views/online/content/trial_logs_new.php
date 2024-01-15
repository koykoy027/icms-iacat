<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>



<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content">

    <!-- BEGIN PAGE CONTENT INNER -->
    <div class="page-content-inner">

        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card" style=" "> 
                <div class="card-title">
                    <p>Criminal Case </p>
                    <small>Next step will show only when you're done with the current</small>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="settings_content" style="margin-left: 30px;">

                            <div class=" card-stats-inner">
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 col-sm-12 pl-0" style=" border-right: 1px solid #eee;">
                                        <!--stepper goes here-->
                                        <div class="history-tl-container">
                                            <ul class="tl" id="ul-stages">

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-12 col-tab-content">
                                        <div class="container  p-2" >
                                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                                <div class="panel panel-default">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="float-right">
                                                                <button class="btn btn-light-blue btn-victim-list" type="button" data-toggle="collapse" data-target="#collapseVictim" aria-expanded="true" id="btnCollapse">
                                                                    Click to see Victim 
                                                                </button>
                                                                <button class="btn btn-light-blue btn-victim-list btn-nav-tab" id="tria_logs" data-id="tria_logs" type="button" data-toggle="tab" data-target="#tria_logs_tab">
                                                                    See activity logs
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="collapseList collapse " id="collapseVictim" style="">
                                                                <div class="card card-body">
                                                                    <div class="panel-body p-3 card-acordion">
                                                                        <small>
                                                                            Toggle switch to change victim status.
                                                                        </small>
                                                                        <div class="inner-box matched_contents mt-2 mb-0">

                                                                            <table class="table">
                                                                                <thead class="thead-grey">
                                                                                    <tr>
                                                                                        <th>Victim Name</th>
                                                                                        <th>Slip Number</th>
                                                                                        <th>Status</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody class="vlist-table" id="list-victim">
                                                                                    <!--<tr>
                                                                                        <td>Kim Arvin Antonio Toledo</td>
                                                                                        <td class="text-gray-500">SN#63245633</td>
                                                                                        <td>
                                                                                            <div class="custom-control custom-switch active">
                                                                                                <input type="checkbox" class="custom-control-input " id="customSwitch1" checked="">
                                                                                                <label class="custom-control-label active" for="customSwitch1"></label>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Mark Lester Abubakar Trangia</td>
                                                                                        <td class="text-gray-500">SN#6754443</td>
                                                                                        <td>
                                                                                            <div class="custom-control custom-switch">
                                                                                                <input type="checkbox" class="custom-control-input" id="customSwitch2" checked="">
                                                                                                <label class="custom-control-label active" for="customSwitch2"></label>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Kimberly Visperas Bado</td>
                                                                                        <td class="text-gray-500">SN#12312321</td>
                                                                                        <td>
                                                                                            <div class="custom-control custom-switch">
                                                                                                <input type="checkbox" class="custom-control-input" id="customSwitch3" checked="">
                                                                                                <label class="custom-control-label active" for="customSwitch3"></label>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>-->
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div> 
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-content pt-0">
                                            <div class="tab-pane fade show active px-3  mt-5" id="criminal_case_tab" role="tabpanel" aria-labelledby="recent-case-tab">

                                                <div class="">
                                                    <!--Victim List-->

                                                    <!--stage 1-->
                                                    <div class="stage stage_1 show">
                                                        <form id="form-filling_complaint"> 
                                                            <div class="m-2 py-3">
                                                                <div class="rowform-row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="mb-3 bg-white p-3">
                                                                            <div class="row ">
                                                                                <div class="col-6 card-sub-title blue  txt-W-500 mb-0">Filing of Complaint</div>
                                                                                <div class="col-6 card-sub-title blue  txt-W-500 mb-0">
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
                                                                                                            <input class="form-check-input inp-stat-done" type="radio" name="stage_status" id="inp-stat-done"  value="1">
                                                                                                            <label class="form-check-label" for="inp-stat-done">
                                                                                                                Done
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- <div class="d-inline-block">
                                                                                            <button type="button" class="btn btn-action  btn-update-stage">Update</button>
                                                                                        </div> -->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 bg-white p-3">

                                                                            <div class="px-5">
                                                                                <div class="row">
                                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                        <label >NPS Number (Docket Number)   <font color="red"> <b>*</b> </font> </label>
                                                                                        <input type="text" class="form-control case-date_complained stage1-legal_cc_batch_nps_no " name="legal_cc_batch_nps_no" >
                                                                                    </div>
                                                                                </div> 
                                                                                <div class="row">
                                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                        <label>Date Filed</label>
                                                                                        <input type="text" class="form-control case-date_complained datepicker stage1-legal_cc_batch_date_filed " placeholder="MM/DD/YYYY">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                        <label >Case Title</label>
                                                                                        <input type="text" class="form-control case-date_complained stage1-legal_cc_batch_case_title"  >
                                                                                    </div>
                                                                                </div>  

                                                                                <div class="row">
                                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                        <label >Name of Investigating Prosecutor </label>
                                                                                        <input type="text" class="form-control stage1-legal_cc_batch_investigating_name  " >
                                                                                    </div>
                                                                                </div>  
                                                                                <div class="row">
                                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                        <div class="row">
                                                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                                <label > Prosecutor's Office</label>
                                                                                                <input type="text" class="form-control stage1-legal_cc_batch_prosecutor_office " >
                                                                                            </div>
                                                                                        </div>  
                                                                                        <!--<div class="form-group">
                                                                                            <label >Remarks</label>
                                                                                            <textarea class="form-control" style="height: 150px !important;" ></textarea>
                                                                                        </div>-->
                                                                                        <div class="row">
                                                                                            <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                                <div class="content-footer float-right match-buttons">
                                                                                                    <button type="button" class="btn btn-action  btn-cancel" style="margin-left:0px; display: none">Cancel</button>
                                                                                                    <button type="button" class="btn btn-primary-orange btn-next btn-edit" style="margin-left:0px;">Edit</button>
                                                                                                    <button type="submit" class="btn btn-primary-orange btn-next btn-submit" style="margin-left:0px; display: none">Submit</button>
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
                                                        </form>
                                                    </div>
                                                    <!--end stage 1-->

                                                    <!--stage 2-->
                                                    <div class="stage stage_2 "  >
                                                        <div class="m-2 py-3">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <div class="mb-3 bg-white p-3">
                                                                        <div class="row ">
                                                                            <div class="col-6 card-sub-title blue  txt-W-500 mb-0">Preliminary Investigation</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="personal-info-sub_forms">

                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                                                <div class="list-group sub-form-list" id="list-tab" role="tablist">
                                                                                    <a class="list-group-item list-group-item-action active" attr-stage="2_1" data-toggle="list" href="#tab_prelim" role="tab" aria-controls="home">Preliminary Investigation</a>
                                                                                    <a class="list-group-item list-group-item-action" attr-stage="2_2" data-toggle="list" href="#tab-inquest" role="tab" aria-controls="prelim">Inquest</a>
                                                                                    <a class="list-group-item list-group-item-action" attr-stage="2_3" data-toggle="list" href="#tab-rip" role="tab" aria-controls="profile">Resolution of the Investigation Prosecutor</a>
                                                                                    <a class="list-group-item list-group-item-action" attr-stage="2_4" data-toggle="list" href="#tab-mr" role="tab" aria-controls="messages">Motion for Reconsideration on the Resolution</a>
                                                                                    <a class="list-group-item list-group-item-action" attr-stage="2_5" data-toggle="list" href="#tab-rcpp" role="tab" aria-controls="settings">Review of the City or Provincial Prosecutor</a>
                                                                                    <a class="list-group-item list-group-item-action" attr-stage="2_6" data-toggle="list" href="#tab-psj" role="tab" aria-controls="soj">Petition for review to the Secretary of Justice</a>
                                                                                    <a class="list-group-item list-group-item-action" attr-stage="2_7" data-toggle="list" href="#tab-soj" role="tab" aria-controls="s">Motion for Reconsideration on the Resolution of the SOJ</a>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-8 col-md-12 col-sm-12 px-0">
                                                                                <div class="tab-content tab-sub-info-content" id="nav-tabContent p-1" >
                                                                                    <div class="tab-pane fade show active bg-white" id="tab_prelim" role="tabpanel" aria-labelledby="list-home-list">
                                                                                        <form id="form-stage-2_1"> 
                                                                                            <div class="card ">
                                                                                                <div class="row ">
                                                                                                    <div class="col-6  txt-W-500 mb-0">Preliminary Investigation</div>
                                                                                                    <div class="col-6 card-sub-title blue  txt-W-500 mb-0">
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
                                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status" id="inp-stat-done"  value="1">
                                                                                                                                <label class="form-check-label" for="inp-stat-done">
                                                                                                                                    Done
                                                                                                                                </label>
                                                                                                                            </div>
                                                                                                                        </li>
                                                                                                                    </ul>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <!--<div class="d-inline-block">
                                                                                                                <button type="button" class="btn btn-action  "  data-toggle="modal"  data-target="#">Update </button>
                                                                                                            </div>-->
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>

                                                                                            </div>
                                                                                            <div class="card">
                                                                                                <div class="row">
                                                                                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                                        <label>Date <font color="red"> <b>*</b> </font></label>
                                                                                                        <input type="text" class="form-control datepicker " name="inp_date_remarks" placeholder="MM/DD/YYYY">
                                                                                                    </div>

                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                                    <textarea class="form-control" name="inp_remarks_desc" style="height: 150px !important;"></textarea>
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                                        <div class="content-footer float-right  match-buttons">
                                                                                                            <button type="button" class="btn btn-action  btn-cancel" style="margin-left:0px; display: none">Cancel</button>
                                                                                                            <button type="button" class="btn btn-primary-orange btn-next btn-edit" style="margin-left:0px;">Edit</button>
                                                                                                            <button type="submit" class="btn btn-primary-orange btn-next btn-submit" style="margin-left:0px; display: none">Submit</button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                    <div class="tab-pane fade " id="tab-inquest" role="tabpanel" aria-labelledby="list-home-list">
                                                                                        <form id="form-stage-2_2"> 
                                                                                            <div class="card ">
                                                                                                <div class="row ">
                                                                                                    <div class="col-6  txt-W-500 mb-0">Inquest</div>
                                                                                                    <div class="col-6 card-sub-title blue  txt-W-500 mb-0">
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
                                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status" id="inp-stat-done"  value="1">
                                                                                                                                <label class="form-check-label" for="inp-stat-done">
                                                                                                                                    Done
                                                                                                                                </label>
                                                                                                                            </div>
                                                                                                                        </li>
                                                                                                                    </ul>                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <!--<div class="d-inline-block">
                                                                                                                <button type="button" class="btn btn-action  "  data-toggle="modal"  data-target="#">Update </button>
                                                                                                            </div>-->
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="card">
                                                                                                <div class="row">
                                                                                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                                        <label>Date <font color="red"> <b>*</b> </font></label>
                                                                                                        <input type="text" class="form-control datepicker"  name="inp_date_remarks" placeholder="MM/DD/YYYY">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                                    <textarea class="form-control" style="height: 150px !important;" name="inp_remarks_desc"></textarea>
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                                        <div class="content-footer float-right  match-buttons">
                                                                                                            <button type="button" class="btn btn-action  btn-cancel" style="margin-left:0px; display: none">Cancel</button>
                                                                                                            <button type="button" class="btn btn-primary-orange btn-next btn-edit" style="margin-left:0px;">Edit</button>
                                                                                                            <button type="submit" class="btn btn-primary-orange btn-next btn-submit" style="margin-left:0px; display: none">Submit</button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                    <div class="tab-pane fade" id="tab-rip" role="tabpanel" aria-labelledby="list-profile-list">
                                                                                        <form id="form-stage-2_3"> 
                                                                                            <div class="card ">
                                                                                                <div class="row ">
                                                                                                    <div class="col-6  txt-W-500 mb-0">Resolution of the Investigation Prosecutor</div>
                                                                                                    <div class="col-6 card-sub-title blue  txt-W-500 mb-0">
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
                                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status" id="inp-stat-done"  value="1">
                                                                                                                                <label class="form-check-label" for="inp-stat-done">
                                                                                                                                    Done
                                                                                                                                </label>
                                                                                                                            </div>
                                                                                                                        </li>
                                                                                                                    </ul>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <!--<div class="d-inline-block">
                                                                                                                <button type="button" class="btn btn-action  "  data-toggle="modal"  data-target="#">Update </button>
                                                                                                            </div>-->
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="card">
                                                                                                <div class="row">
                                                                                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                                        <label>Date <font color="red"> <b>*</b> </font></label>
                                                                                                        <input type="text" class="form-control datepicker"  name="inp_date_remarks" placeholder="MM/DD/YYYY">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                                    <textarea class="form-control" style="height: 150px !important;" name="inp_remarks_desc"></textarea>
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                                        <div class="content-footer float-right  match-buttons">
                                                                                                            <button type="button" class="btn btn-action  btn-cancel" style="margin-left:0px; display: none">Cancel</button>
                                                                                                            <button type="button" class="btn btn-primary-orange btn-next btn-edit" style="margin-left:0px;">Edit</button>
                                                                                                            <button type="submit" class="btn btn-primary-orange btn-next btn-submit" style="margin-left:0px; display: none">Submit</button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                    <div class="tab-pane fade" id="tab-mr" role="tabpanel" aria-labelledby="list-messages-list">
                                                                                        <form id="form-stage-2_4"> 
                                                                                            <div class="card ">
                                                                                                <div class="row ">
                                                                                                    <div class="col-6  txt-W-500 mb-0">Motion for Reconsideration on the Resolution</div>
                                                                                                    <div class="col-6 card-sub-title blue  txt-W-500 mb-0">
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
                                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status" id="inp-stat-done"  value="1">
                                                                                                                                <label class="form-check-label" for="inp-stat-done">
                                                                                                                                    Done
                                                                                                                                </label>
                                                                                                                            </div>
                                                                                                                        </li>
                                                                                                                    </ul>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <!--<div class="d-inline-block">
                                                                                                                <button type="button" class="btn btn-action  "  data-toggle="modal"  data-target="#">Update </button>
                                                                                                            </div>-->
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="card">
                                                                                                <div class="row">
                                                                                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                                        <label>Date <font color="red"> <b>*</b> </font></label>
                                                                                                        <input type="text" class="form-control datepicker"  name="inp_date_remarks" placeholder="MM/DD/YYYY">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                                    <textarea class="form-control" style="height: 150px !important;" name="inp_remarks_desc"></textarea>
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                                        <div class="content-footer float-right  match-buttons">
                                                                                                            <button type="button" class="btn btn-action  btn-cancel" style="margin-left:0px; display: none">Cancel</button>
                                                                                                            <button type="button" class="btn btn-primary-orange btn-next btn-edit" style="margin-left:0px;">Edit</button>
                                                                                                            <button type="submit" class="btn btn-primary-orange btn-next btn-submit" style="margin-left:0px; display: none">Submit</button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form> 
                                                                                    </div>
                                                                                    <div class="tab-pane fade" id="tab-rcpp" role="tabpanel" aria-labelledby="list-settings-list">
                                                                                        <form id="form-stage-2_5"> 
                                                                                            <div class="card ">
                                                                                                <div class="row ">
                                                                                                    <div class="col-6  txt-W-500 mb-0">Review of the City or Provincial Prosecutor </div>
                                                                                                    <div class="col-6 card-sub-title blue  txt-W-500 mb-0">
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
                                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status" id="inp-stat-done"  value="1">
                                                                                                                                <label class="form-check-label" for="inp-stat-done">
                                                                                                                                    Done
                                                                                                                                </label>
                                                                                                                            </div>
                                                                                                                        </li>
                                                                                                                    </ul>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <!--<div class="d-inline-block">
                                                                                                                <button type="button" class="btn btn-action  "  data-toggle="modal"  data-target="#">Update </button>
                                                                                                            </div>-->
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="card">
                                                                                                <div class="row">
                                                                                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                                        <label>Date <font color="red"> <b>*</b> </font></label>
                                                                                                        <input type="text" class="form-control datepicker"  name="inp_date_remarks" placeholder="MM/DD/YYYY">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                                    <textarea class="form-control" style="height: 150px !important;" name="inp_remarks_desc"></textarea>
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                                        <div class="content-footer float-right  match-buttons">
                                                                                                            <button type="button" class="btn btn-action  btn-cancel" style="margin-left:0px; display: none">Cancel</button>
                                                                                                            <button type="button" class="btn btn-primary-orange btn-next btn-edit" style="margin-left:0px;">Edit</button>
                                                                                                            <button type="submit" class="btn btn-primary-orange btn-next btn-submit" style="margin-left:0px; display: none">Submit</button>
                                                                                                        </div>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form> 
                                                                                    </div>
                                                                                    <div class="tab-pane fade" id="tab-psj" role="tabpanel" aria-labelledby="list-settings-list">
                                                                                        <form id="form-stage-2_6"> 
                                                                                            <div class="card ">
                                                                                                <div class="row ">
                                                                                                    <div class="col-6  txt-W-500 mb-0">Petition for review to the Secretary of Justice</div>
                                                                                                    <div class="col-6 card-sub-title blue  txt-W-500 mb-0">
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
                                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status" id="inp-stat-done"  value="1">
                                                                                                                                <label class="form-check-label" for="inp-stat-done">
                                                                                                                                    Done
                                                                                                                                </label>
                                                                                                                            </div>
                                                                                                                        </li>
                                                                                                                    </ul>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <!--<div class="d-inline-block">
                                                                                                                <button type="button" class="btn btn-action  "  data-toggle="modal"  data-target="#">Update </button>
                                                                                                            </div>-->
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="card">
                                                                                                <div class="row">
                                                                                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                                        <label>Date <font color="red"> <b>*</b> </font></label>
                                                                                                        <input type="text" class="form-control datepicker"  name="inp_date_remarks" placeholder="MM/DD/YYYY">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                                    <textarea class="form-control" style="height: 150px !important;" name="inp_remarks_desc"></textarea>
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                                        <div class="content-footer float-right  match-buttons">
                                                                                                            <button type="button" class="btn btn-action  btn-cancel" style="margin-left:0px; display: none">Cancel</button>
                                                                                                            <button type="button" class="btn btn-primary-orange btn-next btn-edit" style="margin-left:0px;">Edit</button>
                                                                                                            <button type="submit" class="btn btn-primary-orange btn-next btn-submit" style="margin-left:0px; display: none">Submit</button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                    <div class="tab-pane fade" id="tab-soj" role="tabpanel" aria-labelledby="list-settings-list">
                                                                                        <form id="form-stage-2_7"> 
                                                                                            <div class="card ">
                                                                                                <div class="row ">
                                                                                                    <div class="col-6  txt-W-500 mb-0">Motion for Reconsideration on the Resolution of the SOJ</div>
                                                                                                    <div class="col-6 card-sub-title blue  txt-W-500 mb-0">
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
                                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status" id="inp-stat-done"  value="1">
                                                                                                                                <label class="form-check-label" for="inp-stat-done">
                                                                                                                                    Done
                                                                                                                                </label>
                                                                                                                            </div>
                                                                                                                        </li>
                                                                                                                    </ul>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <!--<div class="d-inline-block">
                                                                                                                <button type="button" class="btn btn-action  "  data-toggle="modal"  data-target="#">Update </button>
                                                                                                            </div>-->
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="card">
                                                                                                <div class="row">
                                                                                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                                        <label>Date <font color="red"> <b>*</b> </font></label>
                                                                                                        <input type="text" class="form-control datepicker"  name="inp_date_remarks" placeholder="MM/DD/YYYY">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                                    <textarea class="form-control" style="height: 150px !important;" name="inp_remarks_desc"></textarea>
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                                        <div class="content-footer float-right  match-buttons">
                                                                                                            <button type="button" class="btn btn-action  btn-cancel" style="margin-left:0px; display: none">Cancel</button>
                                                                                                            <button type="button" class="btn btn-primary-orange btn-next btn-edit" style="margin-left:0px;">Edit</button>
                                                                                                            <button type="submit" class="btn btn-primary-orange btn-next btn-submit" style="margin-left:0px; display: none">Submit</button>
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
                                                        </div>
                                                    </div>
                                                    <!--end stage 2-->

                                                    <!--stage 3-->
                                                    <div class="stage stage_3">
                                                        <form id="form-filing_court"> 
                                                            <div class="m-2 py-3">
                                                                <div class="rowform-row">
                                                                    <div class="col-12">
                                                                        <div class="mb-3 bg-white ">
                                                                            <div class="card ">
                                                                                <div class="row ">
                                                                                    <div class="col-6  card-sub-title blue  txt-W-500 mb-0">Filing of Information in Court</div>
                                                                                    <div class="col-6 card-sub-title blue  txt-W-500 mb-0">
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
                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status" id="inp-stat-done"  value="1">
                                                                                                                <label class="form-check-label" for="inp-stat-done">
                                                                                                                    Done
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </li>
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!-- <div class="d-inline-block">
                                                                                                <button type="button" class="btn btn-action  btn-update-stage">Update</button>
                                                                                            </div> -->
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 bg-white p-3">
                                                                            <div class="px-5">
                                                                                <div class="row">
                                                                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                        <label>Date <font color="red"> <b>*</b> </font></label>
                                                                                        <input type="text" class="form-control datepicker stage3-legal_cc_batch_stage_date" name="inp_date_remarks" placeholder="MM/DD/YYYY">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                        <label > Criminal Case Number <font color="red"> <b>*</b> </font></label>
                                                                                        <input type="text" class="form-control stage3-legal_cc_batch_criminal_no" name="legal_cc_batch_criminal_no">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                        <label > Criminal Case Title <font color="red"> <b>*</b> </font></label>
                                                                                        <input type="text" class="form-control stage3-legal_cc_batch_criminal_case_title" name="legal_cc_batch_criminal_case_title">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                        <label > Prosecutor’s Name <font color="red"> <b>*</b> </font></label>
                                                                                        <input type="text" class="form-control stage3-legal_cc_batch_prosecutor_name" name="legal_cc_batch_prosecutor_name">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                        <label > Prosecutor’s Office <font color="red"> <b>*</b> </font></label>
                                                                                        <input type="text" class="form-control stage3-legal_cc_batch_prosecutor_office_address" name="legal_cc_batch_prosecutor_office_address">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                        <label > Presiding Judge <font color="red"> <b>*</b> </font></label>
                                                                                        <input type="text" class="form-control stage3-legal_cc_batch_judge_name" name="legal_cc_batch_judge_name">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                        <label > Regional Trial Court Branch Number <font color="red"> <b>*</b> </font></label>
                                                                                        <input type="text" class="form-control stage3-legal_cc_batch_branch_no" name="legal_cc_batch_branch_no">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                        <div class="content-footer float-right  match-buttons">
                                                                                            <button type="button" class="btn btn-action  btn-cancel" style="margin-left:0px; display: none">Cancel</button>
                                                                                            <button type="button" class="btn btn-primary-orange btn-next btn-edit" style="margin-left:0px;">Edit</button>
                                                                                            <button type="submit" class="btn btn-primary-orange btn-next btn-submit" style="margin-left:0px; display: none">Submit</button>
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
                                                    <!--end stage 3--> 

                                                    <!--stage 4-->
                                                    <div class="stage stage_4">
                                                        <form id="form-stage-4"> 
                                                            <div class="m-2 py-3">
                                                                <div class="rowform-row">
                                                                    <div class="col-12">
                                                                        <div class="mb-3 bg-white">
                                                                            <div class="card ">
                                                                                <div class="row ">
                                                                                    <div class="col-6  card-sub-title blue  txt-W-500 mb-0">Dismissal or Issuance of Warrant or Arrest or Commitment Order </div>
                                                                                    <div class="col-6 card-sub-title blue  txt-W-500 mb-0">
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
                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status" id="inp-stat-done"  value="1">
                                                                                                                <label class="form-check-label" for="inp-stat-done">
                                                                                                                    Done
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </li>
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!-- <div class="d-inline-block">
                                                                                                <button type="button" class="btn btn-action  "  data-toggle="modal"  data-target="#">Update </button>
                                                                                            </div> -->

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 bg-white p-3">
                                                                            <div class="card">
                                                                                <div class="row">
                                                                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                        <label>Date <font color="red"> <b>*</b> </font></label>
                                                                                        <input type="text" class="form-control datepicker"  name="inp_date_remarks" placeholder="MM/DD/YYYY">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                    <textarea class="form-control" style="height: 150px !important;" name="inp_remarks_desc"></textarea>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                        <div class="content-footer float-right  match-buttons">
                                                                                            <button type="button" class="btn btn-action  btn-cancel" style="margin-left:0px; display: none">Cancel</button>
                                                                                            <button type="button" class="btn btn-primary-orange btn-next btn-edit" style="margin-left:0px;">Edit</button>
                                                                                            <button type="submit" class="btn btn-primary-orange btn-next btn-submit" style="margin-left:0px; display: none">Submit</button>
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
                                                    <!--end stage 4-->

                                                    <!--stage 5-->
                                                    <div class="stage stage_5" >
                                                        <form id="form-stage-5"> 
                                                            <div class="m-2 py-3">
                                                                <div class="rowform-row">
                                                                    <div class="col-12">
                                                                        <div class="mb-3 bg-white ">
                                                                            <div class="card ">
                                                                                <div class="row ">
                                                                                    <div class="col-6  card-sub-title blue  txt-W-500 mb-0"> Bail-Hearing and Resolution of Petition for Bail </div>
                                                                                    <div class="col-6 card-sub-title blue  txt-W-500 mb-0">
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
                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status" id="inp-stat-done"  value="1">
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
                                                                        <div class="mb-3 bg-white p-3">
                                                                            <div class="card">
                                                                                <div class="row">
                                                                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                        <label>Date <font color="red"> <b>*</b> </font></label>
                                                                                        <input type="text" class="form-control datepicker"  name="inp_date_remarks" placeholder="MM/DD/YYYY">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                    <textarea class="form-control" style="height: 150px !important;" name="inp_remarks_desc"></textarea>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                        <div class="content-footer float-right  match-buttons">
                                                                                            <button type="button" class="btn btn-action  btn-cancel" style="margin-left:0px; display: none">Cancel</button>
                                                                                            <button type="button" class="btn btn-primary-orange btn-next btn-edit" style="margin-left:0px;">Edit</button>
                                                                                            <button type="submit" class="btn btn-primary-orange btn-next btn-submit" style="margin-left:0px; display: none">Submit</button>
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
                                                    <!--end stage 5-->

                                                    <!--stage 6-->
                                                    <div class="stage stage_6">
                                                        <form id="form-stage-6"> 
                                                            <div class="m-2 py-3">
                                                                <div class="rowform-row">
                                                                    <div class="col-12">
                                                                        <div class="mb-3 bg-white">
                                                                            <div class="card ">
                                                                                <div class="row ">
                                                                                    <div class="col-6  card-sub-title blue  txt-W-500 mb-0"> Arraignment and Pre-Trial Conference </div>
                                                                                    <div class="col-6 card-sub-title blue  txt-W-500 mb-0">
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
                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status" id="inp-stat-done"  value="1">
                                                                                                                <label class="form-check-label" for="inp-stat-done">
                                                                                                                    Done
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </li>
                                                                                                    </ul>                                                                                                </div>
                                                                                            </div>
                                                                                            <!-- <div class="d-inline-block">
                                                                                                <button type="button" class="btn btn-action  "  data-toggle="modal"  data-target="#">Update </button>
                                                                                            </div> -->

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 bg-white p-3">
                                                                            <div class="card">
                                                                                <div class="row">
                                                                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                        <label>Date <font color="red"> <b>*</b> </font></label>
                                                                                        <input type="text" class="form-control datepicker"  name="inp_date_remarks" placeholder="MM/DD/YYYY">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                    <textarea class="form-control" style="height: 150px !important;" name="inp_remarks_desc"></textarea>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                        <div class="content-footer float-right  match-buttons">
                                                                                            <button type="button" class="btn btn-action  btn-cancel" style="margin-left:0px; display: none">Cancel</button>
                                                                                            <button type="button" class="btn btn-primary-orange btn-next btn-edit" style="margin-left:0px;">Edit</button>
                                                                                            <button type="submit" class="btn btn-primary-orange btn-next btn-submit" style="margin-left:0px; display: none">Submit</button>
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
                                                    <!--end stage 6-->

                                                    <!--stage 7-->
                                                    <div class="stage stage_7">
                                                        <form id="form-stage-7_1">
                                                            <div class="m-2 py-3">
                                                                <div class="rowform-row">
                                                                    <div class="col-12">
                                                                        <div class="mb-3 bg-white p-2">
                                                                            <div class="row ">
                                                                                <div class="col-lg-3 col-md-3 col-sm-3 card-sub-title blue  txt-W-500 mb-0"> Trial</div>
                                                                                <div class="col-lg-9 col-md-9 col-sm-9 card-sub-title blue  txt-W-500 mb-0">
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
                                                                                                            <input class="form-check-input inp-stat-done" type="radio" name="stage_status" id="inp-stat-done"  value="1">
                                                                                                            <label class="form-check-label" for="inp-stat-done">
                                                                                                                Done
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="d-inline-block">
                                                                                            <button type="button" class="btn btn-primary-orange "  data-toggle="modal"  data-target="#mdl_trial">
                                                                                                <i class="fa fa-plus"></i> 
                                                                                                Add 
                                                                                            </button>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 bg-white p-3">
                                                                            <div class="card card_tbl-container">
                                                                                <div class='row'>
                                                                                    <div class='col-12'>
                                                                                        <div class="list-action">


                                                                                        </div>
                                                                                        <table class="table">
                                                                                            <thead class="thead-grey">
                                                                                                <tr>
                                                                                                    <th width="30%">Trial Date</th>
                                                                                                    <th width="70%">Remarks</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody class="tbl-transit-list"  id="list-trial">
                                                                                                <tr><td colspan="2" class="text-center"> No Trial </td></tr>
<!--                                                                                                <tr>
                                                                                                    <td>July 29, 2019</td>
                                                                                                    <td> At the end of the case, you will be asked to answer questions that deal with the issues of liability and an assessment of damages for pain and suffering, out-of-pocket expenses, wage loss to trial and into the future, housekeeping expenses to trial and into the future and claims for future care costs. </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>August 12, 2019</td>
                                                                                                    <td> The evidence to be introduced and the witnesses to be called are entirely in the control of counsel that I have just introduced to you. </td>
                                                                                                </tr>-->
                                                                                            </tbody>
                                                                                        </table>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!--end stage 7-->

                                                    <!--stage 8-->
                                                    <div class="stage stage_8">
                                                        <form id="form-stage-8"> 
                                                            <div class="m-2 py-3">
                                                                <div class="rowform-row">
                                                                    <div class="col-12">
                                                                        <div class="mb-3 bg-white ">
                                                                            <div class="card ">
                                                                                <div class="row ">
                                                                                    <div class="col-6  card-sub-title blue  txt-W-500 mb-0"> Submission for Resolution </div>
                                                                                    <div class="col-6 card-sub-title blue  txt-W-500 mb-0">
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
                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status" id="inp-stat-done"  value="1">
                                                                                                                <label class="form-check-label" for="inp-stat-done">
                                                                                                                    Done
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </li>
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!--<div class="d-inline-block">
                                                                                                <button type="button" class="btn btn-action  "  data-toggle="modal"  data-target="#">Update </button>
                                                                                            </div>-->
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 bg-white p-3">
                                                                            <div class="card">
                                                                                <div class="row">
                                                                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                        <label>Date <font color="red"> <b>*</b> </font></label>
                                                                                        <input type="text" class="form-control datepicker"  name="inp_date_remarks" placeholder="MM/DD/YYYY">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                    <textarea class="form-control" style="height: 150px !important;" name="inp_remarks_desc"></textarea>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                        <div class="content-footer float-right  match-buttons">
                                                                                            <button type="button" class="btn btn-action  btn-cancel" style="margin-left:0px; display: none">Cancel</button>
                                                                                            <button type="button" class="btn btn-primary-orange btn-next btn-edit" style="margin-left:0px;">Edit</button>
                                                                                            <button type="submit" class="btn btn-primary-orange btn-next btn-submit" style="margin-left:0px; display: none">Submit</button>
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
                                                    <!--end stage 8-->

                                                    <!--stage 9-->
                                                    <div class="stage stage_9">
                                                        <form id="form-stage-9">
                                                            <div class="m-2 py-3">
                                                                <div class="rowform-row">
                                                                    <div class="col-12">
                                                                        <div class="mb-3 bg-white">
                                                                            <div class="card ">
                                                                                <div class="row ">
                                                                                    <div class="col-6  card-sub-title blue  txt-W-500 mb-0">Promulgation of Judgment </div>
                                                                                    <div class="col-6 card-sub-title blue  txt-W-500 mb-0">
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
                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status" id="inp-stat-done"  value="1">
                                                                                                                <label class="form-check-label" for="inp-stat-done">
                                                                                                                    Done
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </li>
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!-- <div class="d-inline-block">
                                                                                                <button type="button" class="btn btn-action  "  data-toggle="modal"  data-target="#">Update </button>
                                                                                            </div> -->

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 bg-white p-3">
                                                                            <div class="card">
                                                                                <div class="row">
                                                                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                        <label>Date <font color="red"> <b>*</b> </font></label>
                                                                                        <input type="text" class="form-control datepicker"  name="inp_date_remarks" placeholder="MM/DD/YYYY">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                    <textarea class="form-control" style="height: 150px !important;" name="inp_remarks_desc"></textarea>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                        <div class="content-footer float-right  match-buttons">
                                                                                            <button type="button" class="btn btn-action  btn-cancel" style="margin-left:0px; display: none">Cancel</button>
                                                                                            <button type="button" class="btn btn-primary-orange btn-next btn-edit" style="margin-left:0px;">Edit</button>
                                                                                            <button type="submit" class="btn btn-primary-orange btn-next btn-submit" style="margin-left:0px; display: none">Submit</button>
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
                                                    <!--end stage 9-->

                                                    <!--stage 10-->
                                                    <div class="stage stage_10">
                                                        <form id="form-stage-10">
                                                            <div class="m-2 py-3">
                                                                <div class="rowform-row">
                                                                    <div class="col-12">
                                                                        <div class="mb-3 bg-white ">
                                                                            <div class="card ">
                                                                                <div class="row ">
                                                                                    <div class="col-6  card-sub-title blue  txt-W-500 mb-0">Motion for Reconsideration or New Trial</div>
                                                                                    <div class="col-6 card-sub-title blue  txt-W-500 mb-0">
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
                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status" id="inp-stat-done"  value="1">
                                                                                                                <label class="form-check-label" for="inp-stat-done">
                                                                                                                    Done
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </li>
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!--<div class="d-inline-block">
                                                                                                <button type="button" class="btn btn-action  "  data-toggle="modal"  data-target="#">Update </button>
                                                                                            </div>-->
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 bg-white p-3">
                                                                            <div class="card">
                                                                                <div class="row">
                                                                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                        <label>Date <font color="red"> <b>*</b> </font></label>
                                                                                        <input type="text" class="form-control datepicker"  name="inp_date_remarks" placeholder="MM/DD/YYYY">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                    <textarea class="form-control" style="height: 150px !important;" name="inp_remarks_desc"></textarea>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                        <div class="content-footer float-right  match-buttons">
                                                                                            <button type="button" class="btn btn-action  btn-cancel" style="margin-left:0px; display: none">Cancel</button>
                                                                                            <button type="button" class="btn btn-primary-orange btn-next btn-edit" style="margin-left:0px;">Edit</button>
                                                                                            <button type="submit" class="btn btn-primary-orange btn-next btn-submit" style="margin-left:0px; display: none">Submit</button>
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
                                                    <!--end stage 10-->

                                                    <!--stage 11-->
                                                    <div class="stage stage_11">
                                                        <form id="form-stage-11"> 
                                                            <div class="m-2 py-3">
                                                                <div class="rowform-row">
                                                                    <div class="col-12">
                                                                        <div class="mb-3 bg-white ">
                                                                            <div class="card ">
                                                                                <div class="row ">
                                                                                    <div class="col-6  card-sub-title blue  txt-W-500 mb-0">Appeal to Court of Appeals</div>
                                                                                    <div class="col-6 card-sub-title blue  txt-W-500 mb-0">
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
                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status" id="inp-stat-done"  value="1">
                                                                                                                <label class="form-check-label" for="inp-stat-done">
                                                                                                                    Done
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </li>
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!-- <div class="d-inline-block">
                                                                                                <button type="button" class="btn btn-action  "  data-toggle="modal"  data-target="#">Update </button>
                                                                                            </div> -->

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 bg-white p-3">
                                                                            <div class="card">
                                                                                <div class="row">
                                                                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                        <label>Date <font color="red"> <b>*</b> </font></label>
                                                                                        <input type="text" class="form-control datepicker"  name="inp_date_remarks" placeholder="MM/DD/YYYY">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                    <textarea class="form-control" style="height: 150px !important;" name="inp_remarks_desc"></textarea>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                        <div class="content-footer float-right  match-buttons">
                                                                                            <button type="button" class="btn btn-action  btn-cancel" style="margin-left:0px; display: none">Cancel</button>
                                                                                            <button type="button" class="btn btn-primary-orange btn-next btn-edit" style="margin-left:0px;">Edit</button>
                                                                                            <button type="submit" class="btn btn-primary-orange btn-next btn-submit" style="margin-left:0px; display: none">Submit</button>
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
                                                    <!--end stage 11-->

                                                    <!--stage 12-->
                                                    <div class="stage stage_12">
                                                        <form id="form-stage-12"> 
                                                            <div class="m-2 py-3">
                                                                <div class="rowform-row">
                                                                    <div class="col-12">
                                                                        <div class="mb-3 bg-white ">
                                                                            <div class="card ">
                                                                                <div class="row ">
                                                                                    <div class="col-6  card-sub-title blue  txt-W-500 mb-0">Motion for Reconsideration on the decision of CA </div>
                                                                                    <div class="col-6 card-sub-title blue  txt-W-500 mb-0">
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
                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status" id="inp-stat-done"  value="1">
                                                                                                                <label class="form-check-label" for="inp-stat-done">
                                                                                                                    Done
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </li>
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!--<div class="d-inline-block">
                                                                                                <button type="button" class="btn btn-action  "  data-toggle="modal"  data-target="#">Update </button>
                                                                                            </div>-->
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 bg-white p-3">
                                                                            <div class="card">
                                                                                <div class="row">
                                                                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                        <label>Date <font color="red"> <b>*</b> </font></label>
                                                                                        <input type="text" class="form-control datepicker"  name="inp_date_remarks" placeholder="MM/DD/YYYY">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                    <textarea class="form-control" style="height: 150px !important;" name="inp_remarks_desc"></textarea>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                        <div class="content-footer float-right  match-buttons">
                                                                                            <button type="button" class="btn btn-action  btn-cancel" style="margin-left:0px; display: none">Cancel</button>
                                                                                            <button type="button" class="btn btn-primary-orange btn-next btn-edit" style="margin-left:0px;">Edit</button>
                                                                                            <button type="submit" class="btn btn-primary-orange btn-next btn-submit" style="margin-left:0px; display: none">Submit</button>
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
                                                    <!--end stage 12-->

                                                    <!--stage 13-->
                                                    <div class="stage stage_13">
                                                        <form id="form-stage-13"> 
                                                            <div class="m-2 py-3">
                                                                <div class="rowform-row">
                                                                    <div class="col-12">
                                                                        <div class="mb-3 bg-white ">
                                                                            <div class="card ">
                                                                                <div class="row ">
                                                                                    <div class="col-6  card-sub-title blue  txt-W-500 mb-0">Decision of CA</div>
                                                                                    <div class="col-6 card-sub-title blue  txt-W-500 mb-0">
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
                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status" id="inp-stat-done"  value="1">
                                                                                                                <label class="form-check-label" for="inp-stat-done">
                                                                                                                    Done
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </li>
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!-- <div class="d-inline-block">
                                                                                                <button type="button" class="btn btn-action  "  data-toggle="modal"  data-target="#">Update </button>
                                                                                            </div> -->
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 bg-white p-3">
                                                                            <div class="card">
                                                                                <div class="row">
                                                                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                        <label>Date <font color="red"> <b>*</b> </font></label>
                                                                                        <input type="text" class="form-control datepicker"  name="inp_date_remarks" placeholder="MM/DD/YYYY">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                    <textarea class="form-control" style="height: 150px !important;" name="inp_remarks_desc"></textarea>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                        <div class="content-footer float-right  match-buttons">
                                                                                            <button type="button" class="btn btn-action  btn-cancel" style="margin-left:0px; display: none">Cancel</button>
                                                                                            <button type="button" class="btn btn-primary-orange btn-next btn-edit" style="margin-left:0px;">Edit</button>
                                                                                            <button type="submit" class="btn btn-primary-orange btn-next btn-submit" style="margin-left:0px; display: none">Submit</button>
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
                                                    <!--end stage 13-->

                                                    <!--stage 14-->
                                                    <div class="stage stage_14">
                                                        <form id="form-stage-14"> 
                                                            <div class="m-2 py-3">
                                                                <div class="rowform-row">
                                                                    <div class="col-12">
                                                                        <div class="mb-3 bg-white ">
                                                                            <div class="card ">
                                                                                <div class="row ">
                                                                                    <div class="col-6  card-sub-title blue  txt-W-500 mb-0">Appeal to the Supreme Court</div>
                                                                                    <div class="col-6 card-sub-title blue  txt-W-500 mb-0">
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
                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status" id="inp-stat-done"  value="1">
                                                                                                                <label class="form-check-label" for="inp-stat-done">
                                                                                                                    Done
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </li>
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!--<div class="d-inline-block">
                                                                                                <button type="button" class="btn btn-action  "  data-toggle="modal"  data-target="#">Update </button>
                                                                                            </div>-->
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 bg-white p-3">
                                                                            <div class="card">
                                                                                <div class="row">
                                                                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                        <label>Date <font color="red"> <b>*</b> </font></label>
                                                                                        <input type="text" class="form-control datepicker"  name="inp_date_remarks" placeholder="MM/DD/YYYY">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                    <textarea class="form-control" style="height: 150px !important;" name="inp_remarks_desc"></textarea>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                        <div class="content-footer float-right  match-buttons">
                                                                                            <button type="button" class="btn btn-action  btn-cancel" style="margin-left:0px; display: none">Cancel</button>
                                                                                            <button type="button" class="btn btn-primary-orange btn-next btn-edit" style="margin-left:0px;">Edit</button>
                                                                                            <button type="submit" class="btn btn-primary-orange btn-next btn-submit" style="margin-left:0px; display: none">Submit</button>
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
                                                    <!--end stage 14-->

                                                    <!--stage 15-->
                                                    <div class="stage stage_15">
                                                        <form id="form-stage-15">
                                                            <div class="m-2 py-3">
                                                                <div class="rowform-row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="mb-3 bg-white ">
                                                                            <div class="card ">
                                                                                <div class="row ">
                                                                                    <div class="col-6  card-sub-title blue  txt-W-500 mb-0">Decision of SC</div>
                                                                                    <div class="col-6 card-sub-title blue  txt-W-500 mb-0">
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
                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status" id="inp-stat-done"  value="1">
                                                                                                                <label class="form-check-label" for="inp-stat-done">
                                                                                                                    Done
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </li>
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!-- <div class="d-inline-block">
                                                                                                <button type="button" class="btn btn-action  "  data-toggle="modal"  data-target="#">Update </button>
                                                                                            </div> -->
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 bg-white p-3">
                                                                            <div class="card">
                                                                                <div class="row">
                                                                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                        <label>Date <font color="red"> <b>*</b> </font></label>
                                                                                        <input type="text" class="form-control datepicker"  name="inp_date_remarks" placeholder="MM/DD/YYYY">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                    <textarea class="form-control" style="height: 150px !important;" name="inp_remarks_desc"></textarea>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                        <div class="content-footer float-right  match-buttons">
                                                                                            <button type="button" class="btn btn-action  btn-cancel" style="margin-left:0px; display: none">Cancel</button>
                                                                                            <button type="button" class="btn btn-primary-orange btn-next btn-edit" style="margin-left:0px;">Edit</button>
                                                                                            <button type="submit" class="btn btn-primary-orange btn-next btn-submit" style="margin-left:0px; display: none">Submit</button>
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
                                                    <!--end stage 15-->
                                                </div>
                                            </div>
                                            <div class="tab-pane fade   px-3 mt-5" id="tria_logs_tab" role="tabpanel" aria-labelledby="recent-case-tab" style="background: #f5f6fa;">
                                                <div class="m-2 py-3">
                                                    <div class="rowform-row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="row mb-2">
                                                                <div class="col-lg-12 col-md-12 col-sm-12 mb-0 "> 
                                                                    <button class="btn btn-light  btn-nav-tab float-right" id="criminal_case" data-id="criminal_case" type="button" data-toggle="tab" data-target="#criminal_case_tab" style="background: #e88f13;color:#fff !important;">
                                                                        Return to Criminal Case
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 bg-white p-3">
                                                                <div class="row ">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue  txt-W-500 mb-0"><p class="stat-header blue mb-0">Activity Logs</p></div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 bg-white p-3">

                                                                <div id="act-log-container">
                                                                    <div class="card-nav act-logs m-x-0 padding-T-15" id="act-logs-content" style="max-height: 500px;overflow-y: scroll;" datapage="1" datapageend="0">
                                                                        <ul class="div-all list_content" id="list-all_logs">
                                                                        </ul>   
                                                                    </div>
                                                                </div>

                                                                <!--                                                                <ul class="div-all list_content" id="list-all_logs">
                                                                                                                                    <div class="">
                                                                                                                                        <li class="list-dashboard px-2 pt-1">  
                                                                                                                                            <div class="row">
                                                                                                                                                <div class="col-lg-9 col-md-9 col-sm-8  ">
                                                                                                                                                    <div class="p-2 bd-highlight"> <span class="case-id" style="font-size: 15px;font-weight: 600;">Andres III Monterey </span>
                                                                                                                                                        <span class=""> Logged in an account on 2019-09-26 14:38:53</span>
                                                                                                                                                        <br> <span class="text-gray-500">IACAT - Ermita Metro Manila </span> 
                                                                
                                                                                                                                                    </div>
                                                                                                                                                </div>
                                                                                                                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                                                                                                                    <div class="p-r-10 "> <i class="fa fa-clock-o p-r-10 text-gray-500" aria-hidden="true"></i>2019-09-26 14:38:53</div>
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                        </li>
                                                                                                                                        <li class="list-dashboard px-2 pt-1">  
                                                                                                                                            <div class="row">
                                                                                                                                                <div class="col-lg-9 col-md-9 col-sm-8  ">
                                                                                                                                                    <div class="p-2 bd-highlight"> <span class="case-id" style="font-size: 15px;font-weight: 600;">Andres III Monterey </span>
                                                                                                                                                        <span class=""> added remarks on appeal to court of appeals.</span>
                                                                                                                                                        <br> <span class="text-gray-500">IACAT - Ermita Metro Manila </span> 
                                                                
                                                                                                                                                    </div>
                                                                                                                                                </div>
                                                                                                                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                                                                                                                    <div class="p-r-10 "> <i class="fa fa-clock-o p-r-10 text-gray-500" aria-hidden="true"></i>2019-09-26 14:38:53</div>
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                        </li>
                                                                                                                                        <li class="list-dashboard px-2 pt-1">  
                                                                                                                                            <div class="row">
                                                                                                                                                <div class="col-lg-9 col-md-9 col-sm-8  ">
                                                                                                                                                    <div class="p-2 bd-highlight"> <span class="case-id" style="font-size: 15px;font-weight: 600;">Andres III Monterey </span>
                                                                                                                                                        <span class=""> updated Promulgation of judgement.</span>
                                                                                                                                                        <br> <span class="text-gray-500">IACAT - Ermita Metro Manila </span> 
                                                                
                                                                                                                                                    </div>
                                                                                                                                                </div>
                                                                                                                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                                                                                                                    <div class="p-r-10 "> <i class="fa fa-clock-o p-r-10 text-gray-500" aria-hidden="true"></i>2019-09-26 14:38:53</div>
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                        </li>
                                                                                                                                        <li class="list-dashboard px-2 pt-1">  
                                                                                                                                            <div class="row">
                                                                                                                                                <div class="col-lg-9 col-md-9 col-sm-8  ">
                                                                                                                                                    <div class="p-2 bd-highlight"> <span class="case-id" style="font-size: 15px;font-weight: 600;">Andres III Monterey </span>
                                                                                                                                                        <span class=""> added remarks on filing of compalint.</span>
                                                                                                                                                        <br> <span class="text-gray-500">IACAT - Ermita Metro Manila </span> 
                                                                                                                                                    </div>
                                                                                                                                                </div>
                                                                                                                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                                                                                                                    <div class="p-r-10 "> <i class="fa fa-clock-o p-r-10 text-gray-500" aria-hidden="true"></i>2019-09-26 14:38:53</div>
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                        </li>
                                                                                                                                    </div>
                                                                                                                                </ul>-->

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

<div class="modal fade" id="mdl-update_trial"  role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-body msgmodal-body" style='overflow-y: scroll; height:950px;'>
                <div class="row mgn-L-15">
                    <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue" style="padding-left: 15px;">  Update Trial<br> 

                    </div>
                </div>
                <div class="inner-box matched_results ">
                    <div class="row form-row" style="background-color: #daebfb ;margin:0;">

                        <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue" style="padding-left: 15px;"> List of Victim<br> 
                            <small class="card-desc"> List of all active victim in this batch</small> 
                        </div>
                        <div class="my-2  pl-4 note_desc">
                            <span class="" style="font-size: 16px;">Note:</span><br>
                            <span class="">Switch off to remove victim form the list.</span>

                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="inner-box matched_contents">
                                <table class="table">
                                    <thead class="thead-grey">
                                        <tr>
                                            <th>Victim Name</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Kim Arvin Antonio Toledo</td>
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                                    <label class="custom-control-label active" for="customSwitch1"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kim Arvin Antonio Toledo</td>
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                                    <label class="custom-control-label active" for="customSwitch1"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kim Arvin Antonio Toledo</td>
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                                    <label class="custom-control-label active" for="customSwitch1"></label>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row mgn-L-15">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input emp-is_documented" id="exampleCheck1">
                            <label class="form-check-label employment_documented" for="exampleCheck1" style="color:#e88f13 !important;">Preliminary Investigation<br>
                                <small class="card-desc"> Preliminary Investigation Information</small>

                            </label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input emp-is_documented" id="exampleCheck1">
                            <label class="form-check-label employment_documented" for="exampleCheck1" style="color:#e88f13 !important;">Inquest<br>
                                <small class="card-desc">Inquest Information</small>

                            </label>
                        </div>
                    </div>
                </div>

                <!--Preliminary Investigation OR Inquest end -->

                <div class="row mgn-L-15 form-row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue" style="padding-left: 15px;"> Review of the City or Provincial Prosecutor<br> 

                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label>Date  </label>
                                <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label >Remarks</label>
                            <textarea class="form-control case-evaluation" style="height: 150px !important;" id="exampleFormControlTextarea1" ></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue" style="padding-left: 15px;">Motion for Reconsideration on the Resolution<br> 

                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label>Date  </label>
                                <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label >Remarks</label>
                            <textarea class="form-control case-evaluation" style="height: 150px !important;" id="exampleFormControlTextarea1" ></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue" style="padding-left: 15px;"> Petition for review to the Secretary of Justice <br> 

                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label>Date  </label>
                                <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label >Remarks</label>
                            <textarea class="form-control case-evaluation" style="height: 150px !important;" id="exampleFormControlTextarea1" ></textarea>
                        </div>
                    </div>

                </div>


                <div class="row mgn-L-15">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue" style="padding-left: 15px;">Motion for Reconsideration on the Resolution of the SoJ<br> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label>Date  </label>
                                        <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY" >
                                    </div>
                                </div>
                                <div class="row mgn-L-10 ">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input emp-is_documented" id="exampleCheck1">
                                        <label class="form-check-label employment_documented" for="exampleCheck1" >Dismiss<br>

                                        </label>
                                        <br>
                                        <input type="checkbox" class="form-check-input emp-is_documented" id="exampleCheck1">
                                        <label class="form-check-label employment_documented" for="exampleCheck1" >Probable Cause<br>

                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card card_tbl-container">
                            <div class="card_tbl-action">
                                <div class="tbl_info card-sub-title">
                                    <span class="" >Documents Attached</span>
                                    <button type="button" class="btn btn-secondary-light_blue   float-right"><i class="fa fa-plus"></i> Add </button>
                                </div>
                                <div class='float-right'>

                                </div> 
                            </div><br>
                            <table class="table">
                                <thead class="thead-grey">
                                    <tr>
                                        <th scope="col">Document Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="tbl-transit-list">
                                    <tr>
                                        <td>MR1.doc</td>
                                        <td> Preview  </td>

                                    </tr>

                                    <tr>
                                        <td>MR2.doc</td>
                                        <td> Preview </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <hr>

                <div class="row mgn-L-15">
                    <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue" style="padding-left: 15px;">Filing of Information in Court <br> 

                    </div>
                </div>
                <div class="row mgn-L-15 form-row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label > Criminal Case Number</label>
                                    <input type="text" class="form-control case-date_complained " >
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label > Criminal Case Title</label>
                                    <input type="text" class="form-control case-date_complained " >
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label > Prosecutor’s Name</label>
                                    <input type="text" class="form-control case-date_complained " >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label > Presiding Judge</label>
                                    <input type="text" class="form-control case-date_complained " >
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label > Regional Trial Court Branch Number</label>
                                    <input type="text" class="form-control case-date_complained " >
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label > Place</label>
                                    <input type="text" class="form-control case-date_complained " >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mgn-L-15">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="row ">
                            <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue" style="padding-left: 15px;"> Arraignment and Plea<br> 

                            </div>
                        </div>
                        <div class="row mgn-L-10 ">
                            <form>
                                <label class="radio-inline">
                                    <input type="radio" name="optradio" checked> At Large
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="optradio" checked> Detained
                                </label>
                            </form>
                        </div><br>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label >Criminal Case Number </label>
                                    <input type="text" class="form-control case-date_complained " >
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label > Criminal Case Title</label>
                                    <input type="text" class="form-control case-date_complained " >
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label > Prosecutor’s Name</label>
                                    <input type="text" class="form-control case-date_complained " >
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card card_tbl-container">
                            <div class="card_tbl-action">
                                <div class="tbl_info card-sub-title">
                                    <span class="" >Documents Attached</span>
                                    <button type="button" class="btn btn-secondary-light_blue   float-right"><i class="fa fa-plus"></i> Add </button>
                                </div>
                                <div class='float-right'>

                                </div> 
                            </div><br>
                            <table class="table">
                                <thead class="thead-grey">
                                    <tr>
                                        <th scope="col">Document Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="tbl-transit-list">
                                    <tr>
                                        <td>warrant1.doc</td>
                                        <td> Preview  </td>

                                    </tr>

                                    <tr>
                                        <td>warrant2.doc</td>
                                        <td> Preview </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


                <div class="row mgn-L-15">
                    <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue" style="padding-left: 15px;">Pre-Trial Conference  <br> 

                    </div>
                       <!--<button type="button" class="btn btn-secondary-light_blue   float-right"><i class="fa fa-plus"></i> Add </button>-->
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card card_tbl-container">

                            <table class="table">
                                <thead class="thead-grey">
                                    <tr>
                                        <th scope="col">Document Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="tbl-transit-list">
                                    <tr>
                                        <td>trail_order1.doc</td>
                                        <td> Preview  </td>
                                    </tr>
                                    <tr>
                                        <td>trail_order2.doc</td>
                                        <td> Preview </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row mgn-L-15">
                    <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue" style="padding-left: 15px;">Bail-Hearing and Resolution of Petition for Bail <br> 

                    </div>
                </div>
                <div class="row mgn-L-15 form-row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label > Criminal Case Number</label>
                                    <input type="text" class="form-control case-date_complained " >
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label > Criminal Case Title</label>
                                    <input type="text" class="form-control case-date_complained " >
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label > Bail Resolution</label>
                                    <input type="text" class="form-control case-date_complained " >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label > Prosecutor</label>
                                    <input type="text" class="form-control case-date_complained " >
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label > Presiding Judge</label>
                                    <input type="text" class="form-control case-date_complained " >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label >Remarks</label>
                            <textarea class="form-control case-evaluation" style="height: 150px !important;" id="exampleFormControlTextarea1" ></textarea>
                        </div>
                    </div>
                </div>


                <div class="row mgn-L-15">
                    <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue" style="padding-left: 15px;"> Trial<br> 

                    </div>
                </div>
                <div class="row mgn-L-15">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card_tbl-action">
                            <div class="tbl_info card-sub-title">
                                <span class="" >Prosecution’s Presentation of Evidence</span>
                                <button type="button" class="btn btn-secondary-light_blue   float-right"><i class="fa fa-plus"></i> Add </button>
                            </div>
                        </div>
                        <table class="table">
                            <thead class="thead-grey">
                                <tr>
                                    <th scope="col">Trial Date</th>
                                    <th scope="col">Remarks</th>
                                </tr>
                            </thead>
                            <tbody class="tbl-transit-list">
                                <tr>
                                    <td>June 21, 2019</td>
                                    <td>Members of the jury, plaintiff and defence counsel have chosen you as the jury to decide this case. In the next few minutes  </td>

                                </tr>

                                <tr>
                                    <td>July 12, 2019</td>
                                    <td>The party who brings a lawsuit is called the plaintiff. In this action, the plaintiff Mr. Smith, sues to recover damages for injuries which he says he received as a result of a motor vehicle accident that occurred on January 1, 1900. </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card_tbl-action">
                            <div class="tbl_info card-sub-title">
                                <span class="" >Defense’s Presentation of Evidence</span>
                                <button type="button" class="btn btn-secondary-light_blue   float-right"><i class="fa fa-plus"></i> Add </button>
                            </div>
                        </div>
                        <table class="table">
                            <thead class="thead-grey">
                                <tr>
                                    <th scope="col">Trial Date</th>
                                    <th scope="col">Remarks</th>
                                </tr>
                            </thead>
                            <tbody class="tbl-transit-list">
                                <!--<tr>
                                    <td>July 29, 2019</td>
                                    <td> At the end of the case, you will be asked to answer questions that deal with the issues of liability and an assessment of damages for pain and suffering, out-of-pocket expenses, wage loss to trial and into the future, housekeeping expenses to trial and into the future and claims for future care costs.  </td>
                                </tr>
                                <tr>
                                    <td>August 12, 2019</td>
                                    <td> The evidence to be introduced and the witnesses to be called are entirely in the control of counsel that I have just introduced to you. </td>
                                </tr>-->
                            </tbody>
                        </table>
                    </div>
                </div>



                <div class="row mgn-L-15">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card_tbl-action">
                            <div class="tbl_info card-sub-title">
                                <span class="" >Promulgation of Judgment</span>
                                 <!--<small class="card-desc"> No description found.</small>--> 
                                <!--<button type="button" class="btn btn-secondary-light_blue   float-right"><i class="fa fa-plus"></i> Add </button>-->
                            </div>
                        </div>
                        <div class="row mgn-L-10 ">
                            <!--                            <form>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="optradio" checked> Convicted
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="optradio" checked> Dismissed
                                                            </label>
                                                        </form>-->
                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-2 pt-0">Judgement</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                            <label class="form-check-label" for="gridRadios1">
                                                Convicted
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                                            <label class="form-check-label" for="gridRadios2">
                                                Dismissed
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div><br>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label > Penalty</label>
                                    <input type="text" class="form-control case-date_complained " placeholder="Convicted" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label > Number of Years</label>
                                    <input type="text" class="form-control case-date_complained " placeholder="2 years" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label > Damages</label>
                                    <input type="text" class="form-control case-date_complained " placeholder="Damages" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card_tbl-action">
                            <div class="tbl_info card-sub-title">
                                <span class="" >Judgment / Decision Attachment </span>
                                <button type="button" class="btn btn-secondary-light_blue   float-right"><i class="fa fa-plus"></i> Add </button>
                            </div>
                        </div>
                        <table class="table">
                            <thead class="thead-grey">
                                <tr>
                                    <th scope="col">Judgment/Decision</th>
                                    <th scope="col">Remarks</th>
                                </tr>
                            </thead>
                            <tbody class="tbl-transit-list">
                                <tr>
                                    <td>July 29, 2019</td>
                                    <td><i class="fas fa-eye blue"></i>Decisions of a quasi-judicial body and administrative bodies may be colloquially referred to as "judgments. </td>

                                </tr>

                                <tr>
                                    <td>August 12, 2019</td>
                                    <td> A judgment may be provided either in written or oral form depending on the circumstances.[ </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row mgn-L-15">
                    <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue" style="padding-left: 15px;">Motion for Reconsideration or New Trial <br> 

                    </div>
                </div>
                <div class="row mgn-L-15">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label >Criminal Case Number</label>
                                        <input type="text" class="form-control case-date_complained datepicker" >
                                    </div>
                                </div>  
                                <div class="row">
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label > Criminal Case Title</label>
                                        <input type="text" class="form-control case-date_complained datepicker" >
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label >Resolution</label>
                                        <input type="text" class="form-control case-date_complained datepicker" >
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label >Remarks</label>
                                    <textarea class="form-control case-evaluation" style="height: 150px !important;" id="exampleFormControlTextarea1" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>



                <div class="row mgn-L-15">
                    <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue" style="padding-left: 15px;"> Appeal to CA <br> 

                    </div>
                </div>
                <div class="row mgn-L-15">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label >Criminal Case Number</label>
                                        <input type="text" class="form-control case-date_complained datepicker" >
                                    </div>
                                </div>  
                                <div class="row">
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label > Criminal Case Title</label>
                                        <input type="text" class="form-control case-date_complained datepicker" >
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label>Date Complained </label>
                                        <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label >CA Docket Number</label>
                                        <input type="text" class="form-control case-date_complained datepicker" >
                                    </div>
                                </div>  
                                <div class="row">
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label >CA Division</label>
                                        <input type="text" class="form-control case-date_complained datepicker" >
                                    </div>
                                </div>  
                            </div>  
                        </div>
                    </div>
                </div>




                <div class="row mgn-L-15">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card_tbl-action">
                            <div class="tbl_info card-sub-title">
                                <span class="" >Decision</span>
                                 <!--<small class="card-desc"> No description found.</small>--> 
                                <!--<button type="button" class="btn btn-secondary-light_blue   float-right"><i class="fa fa-plus"></i> Add </button>-->
                            </div>
                        </div>
                        <div class="row mgn-L-10 ">
                            <form>
                                <label class="radio-inline">
                                    <input type="radio" name="optradio" checked> Affirmed
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="optradio" checked> Reverse
                                </label>
                            </form>
                        </div><br>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card_tbl-action">
                            <div class="tbl_info card-sub-title">
                                <span class="" >Decision Attachment</span>
                                <button type="button" class="btn btn-secondary-light_blue   float-right"><i class="fa fa-plus"></i> Add </button>
                            </div>
                        </div>
                        <table class="table">
                            <thead class="thead-grey">
                                <tr>
                                    <th scope="col">Judgment/Decision</th>
                                    <th scope="col">Remarks</th>
                                </tr>
                            </thead>
                            <tbody class="tbl-transit-list">
                                <tr>
                                    <td>July 29, 2019</td>
                                    <td><i class="fas fa-eye blue"></i>Decisions of a quasi-judicial body and administrative bodies may be colloquially referred to as "judgments. </td>

                                </tr>

                                <tr>
                                    <td>August 12, 2019</td>
                                    <td> A judgment may be provided either in written or oral form depending on the circumstances.[ </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row mgn-L-15">
                    <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue" style="padding-left: 15px;"> Appeal to the Supreme Court<br> 
                    </div>
                </div>
                <div class="row mgn-L-15">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label >Criminal Case Number</label>
                                        <input type="text" class="form-control case-date_complained datepicker" >
                                    </div>
                                </div>  
                                <div class="row">
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label > Criminal Case Title</label>
                                        <input type="text" class="form-control case-date_complained datepicker" >
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label >SC Docket Number</label>
                                        <input type="text" class="form-control case-date_complained datepicker" >
                                    </div>
                                </div>  
                                <div class="row">
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label >SC Division Number</label>
                                        <input type="text" class="form-control case-date_complained datepicker" >
                                    </div>
                                </div>  
                            </div>  
                        </div>
                    </div>
                </div>


                <div class="row mgn-L-15">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card_tbl-action">
                            <div class="tbl_info card-sub-title">
                                <span class="" >Decision</span>
                                 <!--<small class="card-desc"> No description found.</small>--> 
                                <!--<button type="button" class="btn btn-secondary-light_blue   float-right"><i class="fa fa-plus"></i> Add </button>-->
                            </div>
                        </div>
                        <div class="row mgn-L-10 ">
                            <form>
                                <label class="radio-inline">
                                    <input type="radio" name="optradio" checked> Affirmed
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="optradio" checked> Reverse
                                </label>
                            </form>
                        </div><br>

                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card_tbl-action">
                            <div class="tbl_info card-sub-title">
                                <span class="" >Decision Attachment</span>
                                <button type="button" class="btn btn-secondary-light_blue   float-right"><i class="fa fa-plus"></i> Add </button>
                            </div>
                        </div>
                        <table class="table">
                            <thead class="thead-grey">
                                <tr>
                                    <th scope="col">Judgment/Decision</th>
                                    <th scope="col">Remarks</th>
                                </tr>
                            </thead>
                            <tbody class="tbl-transit-list">
                                <tr>
                                    <td>July 29, 2019</td>
                                    <td><i class="fas fa-eye blue"></i>Decisions of a quasi-judicial body and administrative bodies may be colloquially referred to as "judgments. </td>

                                </tr>

                                <tr>
                                    <td>August 12, 2019</td>
                                    <td> A judgment may be provided either in written or oral form depending on the circumstances.[ </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div><!--MODAL END-->
        </div>


    </div>
</div>



<!--MODAL PER STAGES-->

<!--STAGE 2 - PI-->
<div class="modal fade" id="mdl_prelim_inv"  role="dialog">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title ">Preliminary Investigation</h5>
            </div>
            <div class="modal-body msgmodal-body">
                <form class="col-12">
                    <div class="mb-3 bg-cream p1rem">
                        <div class="agency_details">                 
                            <span class="icms-text-secondary"> Victim Name :  </span><span> Kimberly Visperas Bado </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label>Date  </label>
                            <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label >Remarks</label>
                        <textarea class="form-control case-evaluation" style="height: 150px !important;" id="exampleFormControlTextarea1" ></textarea>
                    </div>
                    <div class="content-footer float-right  match-buttons">
                        <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                        <button type="submit" class="btn btn-primary-orange btn-next" style="margin-left:0px;" >Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--END STAGE 2 PI-->

<!--stage 2.1-->
<div class="modal fade" id="mdl_inquest"  role="dialog">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title ">Inquest</h5>
            </div>
            <div class="modal-body msgmodal-body">
                <form class="col-12">
                    <div class="mb-3 bg-cream p1rem">
                        <div class="agency_details">                 
                            <span class="icms-text-secondary"> Victim Name :  </span><span> Kimberly Visperas Bado </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label>Date  </label>
                            <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label >Remarks</label>
                        <textarea class="form-control case-evaluation" style="height: 150px !important;" id="exampleFormControlTextarea1" ></textarea>
                    </div>
                    <div class="content-footer float-right  match-buttons">
                        <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                        <button type="submit" class="btn btn-primary-orange btn-next" style="margin-left:0px;" >Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end stage 2.1-->

<!--stage 2.2--> 
<div class="modal fade" id="mdl_resolution_inv"  role="dialog">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title ">Resolution of the Investigation Prosecutor</h5>
            </div>
            <div class="modal-body msgmodal-body">
                <form class="col-12">
                    <div class="mb-3 bg-cream p1rem">
                        <div class="agency_details">                 
                            <span class="icms-text-secondary"> Victim Name :  </span><span> Kimberly Visperas Bado </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label>Date  </label>
                            <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label > Name of Prosecutor</label>
                            <input type="text" class="form-control case-date_complained datepicker">
                        </div>
                    </div>  
                    <div class=" card_tbl-container">
                        <div class="card_tbl-action">
                            <div class="tbl_info card-sub-title mb-2">
                                <button type="button" class="btn btn-secondary-light_blue   float-right mb-2"><i class="fa fa-plus"></i> Add </button>
                            </div>

                        </div>
                        <table class="table">
                            <thead class="thead-grey">
                                <tr>
                                    <th scope="col">Document Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="tbl-transit-list">
                                <tr>
                                    <td>Document1.doc</td>
                                    <td> Preview  </td>

                                </tr>

                                <tr>
                                    <td>Document2.doc</td>
                                    <td> Preview </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="content-footer float-right  match-buttons">
                        <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                        <button type="submit" class="btn btn-primary-orange btn-next" style="margin-left:0px;" >Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end stage 2.2-->

<!--stage 2.3-->
<div class="modal fade" id="mdl_motion_recon"  role="dialog">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title ">Motion for Reconsideration on the Resolution</h5>
            </div>
            <div class="modal-body msgmodal-body">
                <form class="col-12">
                    <div class="mb-3 bg-cream p1rem">
                        <div class="agency_details">                 
                            <span class="icms-text-secondary"> Victim Name :  </span><span> Kimberly Visperas Bado </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label>Date  </label>
                            <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label >Remarks</label>
                        <textarea class="form-control case-evaluation" style="height: 150px !important;" id="exampleFormControlTextarea1" ></textarea>
                    </div>
                    <div class="content-footer float-right  match-buttons">
                        <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                        <button type="submit" class="btn btn-primary-orange btn-next" style="margin-left:0px;" >Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end stage 2.3-->


<!--stage 2.4-->
<div class="modal fade" id="mdl_review_of_city"  role="dialog">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title ">Review of the City or Provincial Prosecutor</h5>
            </div>
            <div class="modal-body msgmodal-body">
                <form class="col-12">
                    <div class="mb-3 bg-cream p1rem">
                        <div class="agency_details">                 
                            <span class="icms-text-secondary"> Victim Name :  </span><span> Kimberly Visperas Bado </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label>Date  </label>
                            <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label >Remarks</label>
                        <textarea class="form-control case-evaluation" style="height: 150px !important;" id="exampleFormControlTextarea1" ></textarea>
                    </div>
                    <div class="content-footer float-right  match-buttons">
                        <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                        <button type="submit" class="btn btn-primary-orange btn-next" style="margin-left:0px;" >Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end stage 2.4-->

<!--stage 2.5-->
<div class="modal fade" id="mdl_petition"  role="dialog">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title ">Petition for review to the Secretary of Justice</h5>
            </div>
            <div class="modal-body msgmodal-body">
                <form class="col-12">
                    <div class="mb-3 bg-cream p1rem">
                        <div class="agency_details">                 
                            <span class="icms-text-secondary"> Victim Name :  </span><span> Kimberly Visperas Bado </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label>Date  </label>
                            <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label >Remarks</label>
                        <textarea class="form-control case-evaluation" style="height: 150px !important;" id="exampleFormControlTextarea1" ></textarea>
                    </div>
                    <div class="content-footer float-right  match-buttons">
                        <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                        <button type="submit" class="btn btn-primary-orange btn-next" style="margin-left:0px;" >Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end stage 2.5-->

<!--stage 2.6-->
<div class="modal fade bd-example-modal-lg" id="mdl_motion_recon_soj"  role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title ">Motion for Reconsideration on the Resolution of the SoJ</h5>
            </div>
            <div class="modal-body msgmodal-body">
                <form class="col-12">
                    <div class="mb-3 bg-cream p1rem">
                        <div class="agency_details">                 
                            <span class="icms-text-secondary"> Victim Name :  </span><span> Kimberly Visperas Bado </span>
                        </div>
                    </div>
                    <fieldset class="form-group">
                        <div class="row">
                            <label>Resolution Stage</label>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                    <label class="form-check-label" for="gridRadios1">
                                        Dismissed
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                                    <label class="form-check-label" for="gridRadios2">
                                        Probable Cause
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label>Date  </label>
                            <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label >Remarks</label>
                        <textarea class="form-control case-evaluation" style="height: 150px !important;" id="exampleFormControlTextarea1" ></textarea>
                    </div><br>
                    <div class="row ">
                        <div class="col-6 card-sub-title blue  txt-W-500 mb-0">Documents Attached</div>
                        <div class="col-6">
                            <button type="button" class="btn btn-secondary-light_blue   float-right mb-2"><i class="fa fa-plus"></i> Add </button>
                        </div>
                    </div>
                    <div class=" card_tbl-container">

                        <table class="table">
                            <thead class="thead-grey">
                                <tr>
                                    <th scope="col">Document Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="tbl-transit-list">
                                <tr>
                                    <td>MR1.doc</td>
                                    <td> Preview  </td>

                                </tr>

                                <tr>
                                    <td>MR2.doc</td>
                                    <td> Preview </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="content-footer float-right  match-buttons">
                        <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                        <button type="submit" class="btn btn-primary-orange btn-next" style="margin-left:0px;" >Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end stagae 2.6-->

<!--stage 4-->
<div class="modal fade" id="mdl_dismissal"  role="dialog">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title ">Dismissal or Issuance of Warrant of Arrest or Commitment Order</h5>
            </div>
            <div class="modal-body msgmodal-body">
                <form class="col-12">
                    <div class="mb-3 bg-cream p1rem">
                        <div class="agency_details">                 
                            <span class="icms-text-secondary"> Victim Name :  </span><span> Kimberly Visperas Bado </span>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="inputState">Status</label>
                        <select class="form-control sel-traffic_purpose v-traffic_purpose valid" aria-invalid="false">
                            <option value="0" selected="">Select Status</option>
                            <option value="1">Dismissal </option>
                            <option value="2">Issuance of Warrant </option>
                            <option value="3">Arrest </option>
                            <option value="4">Commitment Order </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label >Remarks</label>
                        <textarea class="form-control case-evaluation" style="height: 150px !important;" id="exampleFormControlTextarea1" ></textarea>
                    </div><br>
                    <div class="card_tbl-action">
                        <div class="tbl_info card-sub-title">
                            <span class="" >Documents Attached</span>
                            <button type="button" class="btn btn-secondary-light_blue   float-right"><i class="fa fa-plus"></i> Upload </button>
                        </div>
                    </div>
                    <table class="table">
                        <thead class="thead-grey">
                            <tr>
                                <th scope="col">Document Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbl-transit-list">
                            <tr>
                                <td>warrant1.doc</td>
                                <td> Preview  </td>

                            </tr>

                            <tr>
                                <td>warrant2.doc</td>
                                <td> Preview </td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="content-footer float-right  match-buttons">
                        <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                        <button type="submit" class="btn btn-primary-orange btn-next" style="margin-left:0px;" >Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end stage 4-->

<!--stage 5-->
<div class="modal fade" id="mdl_bail"  role="dialog">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title ">Bail-Hearing and Resolution of Petition for Bail</h5>
            </div>
            <div class="modal-body msgmodal-body">
                <form class="col-12">
                    <div class="mb-3 bg-cream p1rem">
                        <div class="agency_details">                 
                            <span class="icms-text-secondary"> Victim Name :  </span><span> Kimberly Visperas Bado </span>
                        </div>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label > Bail Resolution</label>
                                <input type="text" class="form-control case-date_complained " >
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label > Prosecutor</label>
                                <input type="text" class="form-control case-date_complained " >
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label > Presiding Judge</label>
                                <input type="text" class="form-control case-date_complained " >
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                        <label >Remarks</label>
                        <textarea class="form-control case-evaluation" style="height: 150px !important;" id="exampleFormControlTextarea1" ></textarea>
                    </div>
                    <div class="content-footer float-right  match-buttons">
                        <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                        <button type="submit" class="btn btn-primary-orange btn-next" style="margin-left:0px;" >Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end stage 5-->


<!--stage 6-->
<div class="modal fade" id="mdl_pre_trial"  role="dialog">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title ">Arraignment and Pre-Trial Conference</h5>
            </div>
            <div class="modal-body msgmodal-body">

                <div class="mb-3 bg-cream p1rem">
                    <div class="agency_details">                 
                        <span class="icms-text-secondary"> Victim Name :  </span><span> Kimberly Visperas Bado </span>
                    </div>
                </div>
                <div class="row mgn-L-10 ">
                    <form>
                        <label class="radio-inline">
                            <input type="radio" name="optradio" checked> At Large
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="optradio" checked> Detained
                        </label>
                    </form>
                </div><br>
                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label >Criminal Case Number </label>
                            <input type="text" class="form-control case-date_complained " >
                        </div>
                    </div>
                </div>
                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label > Criminal Case Title</label>
                            <input type="text" class="form-control case-date_complained " >
                        </div>
                    </div>
                </div>
                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label > Prosecutor’s Name</label>
                            <input type="text" class="form-control case-date_complained " >
                        </div>
                    </div>
                </div>
                <div class="mb-3 bg-white p-3">
                    <div class="tbl_info card-sub-title">
                        <span class="">Documents Attached</span>
                        <button type="button" class="btn btn-secondary-light_blue   float-right"><i class="fa fa-plus"></i> Upload </button>
                    </div>
                    <div class="card card_tbl-container">

                        <table class="table">
                            <thead class="thead-grey">
                                <tr>
                                    <th scope="col">Document Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="tbl-transit-list">
                                <tr>
                                    <td>warrant1.doc</td>
                                    <td><i class="fas fa-eye blue"></i><span class="text-gray-500"> Preview </span> </td>

                                </tr>

                                <tr>
                                    <td>warrant2.doc</td>
                                    <td> <span class="text-gray-500"> Preview </span> </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="content-footer float-right  match-buttons">
                    <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                    <button type="submit" class="btn btn-primary-orange btn-next" style="margin-left:0px;" >Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end stage 6-->

<!--stage 7-->
<div class="modal fade " id="mdl_trial"  role="dialog">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title ">Trial</h5>
            </div>
            <div class="modal-body msgmodal-body">
                <form id="form-stage-7">
                    <div class="card">
                        <div class="row">
                            <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                <label>Date <font color="red"> <b>*</b> </font></label>
                                <input type="text" class="form-control datepicker" name="inp_date_remarks" placeholder="MM/DD/YYYY" disabled="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Remarks<font color="red"> <b>*</b> </font></label>
                            <textarea class="form-control" style="height: 150px !important;" name="inp_remarks_desc" disabled=""></textarea>
                        </div>
                        <!--<div class="form-group">
                            <label for="exampleFormControlSelect1">Status</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>On going</option>
                                <option>Done</option>
                            </select>
                        </div>-->
                    </div>
                    <div class="content-footer float-right  match-buttons mb-3">
                        <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                        <button type="submit" class="btn btn-primary-orange btn-next" style="margin-left:0px;" >Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end stage 7-->

<!--stage 8-->
<div class="modal fade" id="mdl_submit_resolution"  role="dialog">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title ">Submission for Resolution</h5>
            </div>
            <div class="modal-body msgmodal-body">
                <form class="col-12">
                    <div class="mb-3 bg-cream p1rem">
                        <div class="agency_details">                 
                            <span class="icms-text-secondary"> Victim Name :  </span><span> Kimberly Visperas Bado </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label >Criminal Case Number</label>
                            <input type="text" class="form-control case-date_complained datepicker" >
                        </div>
                    </div>  
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label > Criminal Case Title</label>
                            <input type="text" class="form-control case-date_complained datepicker" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label >Prosecutor</label>
                            <input type="text" class="form-control case-date_complained datepicker" >
                        </div>
                    </div>  
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label >Presiding Judge</label>
                            <input type="text" class="form-control case-date_complained datepicker" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label>Date of Submission </label>
                            <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label >Remarks</label>
                        <textarea class="form-control case-evaluation" style="height: 150px !important;" id="exampleFormControlTextarea1" ></textarea>
                    </div>
                    <div class="content-footer float-right  match-buttons">
                        <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                        <button type="submit" class="btn btn-primary-orange btn-next" style="margin-left:0px;" >Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end stage 8-->

<!--stage 9-->
<div class="modal fade" id="mdl_promulgation"  role="dialog">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title ">Promulgation of Judgment</h5>
            </div>
            <div class="modal-body msgmodal-body">
                <form class="col-12">

                    <div class="mb-3 bg-cream p1rem">
                        <div class="agency_details">                 
                            <span class="icms-text-secondary"> Victim Name :  </span><span> Kimberly Visperas Bado </span>
                        </div>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label > Judgment</label>
                            </div>
                        </div>
                        <form class="ml-4">
                            <label class="radio-inline">
                                <input type="radio" name="optradio" checked> Convicted
                            </label>
                            <label class="radio-inline ml-3">
                                <input type="radio" name="optradio" checked> Dismissed
                            </label>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label > Sentence</label>
                                <input type="text" class="form-control case-date_complained " >
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label > Number of Years</label>
                                <input type="text" class="form-control case-date_complained " placeholder="2 years" >
                            </div>
                        </div>
                    </div>
                    <div class="card card_tbl-container">
                        <div class="card_tbl-action">
                            <div class="tbl_info card-sub-title">
                                <span class="" >Documents Attached</span>
                                <button type="button" class="btn btn-secondary-light_blue   float-right"><i class="fa fa-plus"></i> Add </button>
                            </div>
                            <div class='float-right'>

                            </div> 
                        </div><br>
                        <table class="table">
                            <thead class="thead-grey">
                                <tr>
                                    <th scope="col">Document Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="tbl-transit-list">
                                <tr>
                                    <td>judgment1.doc</td>
                                    <td> Preview  </td>

                                </tr>

                                <tr>
                                    <td>judgment2.doc</td>
                                    <td> Preview </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="content-footer float-right  match-buttons">
                        <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                        <button type="submit" class="btn btn-primary-orange btn-next" style="margin-left:0px;" >Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end stage 9-->


<!--stage 10-->
<div class="modal fade" id="mdl_motion_recon_new_trial"  role="dialog">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title ">Motion for Reconsideration or New Trial</h5>
            </div>
            <div class="modal-body msgmodal-body">
                <form class="col-12">

                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label >Date of Motion</label>
                                    <input type="text" class="form-control case-date_complained datepicker" >
                                </div>
                            </div>  
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label > Resolution</label>
                                    <input type="text" class="form-control case-date_complained datepicker" >
                                </div>
                            </div>  
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label >Remarks</label>
                                    <textarea class="form-control case-evaluation" style="height: 150px !important;" id="exampleFormControlTextarea1" ></textarea>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="content-footer float-right  match-buttons">
                        <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                        <button type="submit" class="btn btn-primary-orange btn-next" style="margin-left:0px;" >Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end stage 10-->

<!--stage 11-->
<div class="modal fade" id="mdl_appeal"  role="dialog">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title ">Appeal to Court of Appeals</h5>
            </div>
            <div class="modal-body msgmodal-body">
                <form class="col-12">
                    <div class="mb-3 bg-cream p1rem">
                        <div class="agency_details">                 
                            <span class="icms-text-secondary"> Victim Name :  </span><span> Kimberly Visperas Bado </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label >CA Docket Number.</label>
                                    <input type="text" class="form-control case-date_complained datepicker" >
                                </div>
                            </div>  
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label >CA Division</label>
                                    <input type="text" class="form-control case-date_complained datepicker" >
                                </div>
                            </div>  
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label>Date of Appeal </label>
                                    <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label >Status of Appeal</label>
                                    <input type="text" class="form-control case-date_complained datepicker" >
                                </div>
                            </div>  
                        </div>  
                    </div> 
                    <div class="content-footer float-right  match-buttons">
                        <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                        <button type="submit" class="btn btn-primary-orange btn-next" style="margin-left:0px;" >Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end stage 11-->


<!--stage 12-->
<div class="modal fade" id="mdl_motion_recon_ca"  role="dialog">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title ">Motion for Reconsideration on the decision of CA</h5>
            </div>
            <div class="modal-body msgmodal-body">
                <form class="col-12">
                    <div class="mb-3 bg-cream p1rem">
                        <div class="agency_details">                 
                            <span class="icms-text-secondary"> Victim Name :  </span><span> Kimberly Visperas Bado </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label>Date <font color="red"> <b>*</b> </font></label>
                            <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label >Remarks</label>
                            <textarea class="form-control case-evaluation" style="height: 150px !important;" id="exampleFormControlTextarea1" ></textarea>
                        </div>
                    </div>  
                    <div class="content-footer float-right  match-buttons">
                        <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                        <button type="submit" class="btn btn-primary-orange btn-next" style="margin-left:0px;" >Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end stage 12-->

<!--stage 13-->
<div class="modal fade" id="mdl_decision_ca"  role="dialog">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title ">Decision of CA</h5>
            </div>
            <div class="modal-body msgmodal-body">
                <form class="col-12">
                    <div class="mb-3 bg-cream p1rem">
                        <div class="agency_details">                 
                            <span class="icms-text-secondary"> Victim Name :  </span><span> Kimberly Visperas Bado </span>
                        </div>
                    </div>
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-2 pt-0">Decision Status</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                    <label class="form-check-label" for="gridRadios1">
                                        Affirmed
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                                    <label class="form-check-label" for="gridRadios2">
                                        Reverse
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label>Dates of Decision Release </label>
                            <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY" >
                        </div>
                    </div>

                    <div class="card_tbl-action mt-3">
                        <div class="tbl_info card-sub-title">
                            <span class="" >Decision Attachment</span>
                            <button type="button" class="btn btn-secondary-light_blue   float-right"><i class="fa fa-plus"></i> Add </button>
                        </div>
                    </div>
                    <table class="table">
                        <thead class="thead-grey">
                            <tr>
                                <th scope="col">Judgment/Decision</th>
                                <th scope="col">Remarks</th>
                            </tr>
                        </thead>
                        <tbody class="tbl-transit-list">
                            <tr>
                                <td>July 29, 2019</td>
                                <td><i class="fas fa-eye blue"></i>Decisions of a quasi-judicial body and administrative bodies may be colloquially referred to as "judgments. </td>

                            </tr>

                            <tr>
                                <td>August 12, 2019</td>
                                <td> A judgment may be provided either in written or oral form depending on the circumstances.</td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="content-footer float-right  match-buttons">
                        <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                        <button type="submit" class="btn btn-primary-orange btn-next" style="margin-left:0px;" >Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end stage 13-->

<!--stage 14-->
<div class="modal fade" id="mdl_appeal_sc"  role="dialog">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title ">Appeal to the Supreme Court</h5>
            </div>
            <div class="modal-body msgmodal-body">
                <form class="col-12">
                    <div class="mb-3 bg-cream p1rem">
                        <div class="agency_details">                 
                            <span class="icms-text-secondary"> Victim Name :  </span><span> Kimberly Visperas Bado </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label >SC Docket Number</label>
                                    <input type="text" class="form-control case-date_complained datepicker" >
                                </div>
                            </div>  
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label >SC Division Number</label>
                                    <input type="text" class="form-control case-date_complained datepicker" >
                                </div>
                            </div>  
                        </div>  
                    </div>
                    <div class="content-footer float-right  match-buttons">
                        <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                        <button type="submit" class="btn btn-primary-orange btn-next" style="margin-left:0px;" >Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end stage 14-->

<!--stage 15-->
<div class="modal fade" id="mdl_decision_sc"  role="dialog">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title ">Decision of SC</h5>
            </div>
            <div class="modal-body msgmodal-body">
                <form class="col-12">
                    <div class="mb-3 bg-cream p1rem">
                        <div class="agency_details">                 
                            <span class="icms-text-secondary"> Victim Name :  </span><span> Kimberly Visperas Bado </span>
                        </div>
                    </div>
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                    <label class="form-check-label" for="gridRadios1">
                                        Affirmed
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                                    <label class="form-check-label" for="gridRadios2">
                                        Reverse
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label>Dates of Decision Release </label>
                            <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY" >
                        </div>
                    </div>

                    <div class="card_tbl-action mt-3">
                        <div class="tbl_info card-sub-title">
                            <span class="" >Decision Attachment</span>
                            <button type="button" class="btn btn-secondary-light_blue   float-right"><i class="fa fa-plus"></i> Add </button>
                        </div>
                    </div>
                    <table class="table">
                        <thead class="thead-grey">
                            <tr>
                                <th scope="col">Judgment/Decision</th>
                                <th scope="col">Remarks</th>
                            </tr>
                        </thead>
                        <tbody class="tbl-transit-list">
                            <tr>
                                <td>July 29, 2019</td>
                                <td><i class="fas fa-eye blue"></i>Decisions of a quasi-judicial body and administrative bodies may be colloquially referred to as "judgments. </td>

                            </tr>

                            <tr>
                                <td>August 12, 2019</td>
                                <td> A judgment may be provided either in written or oral form depending on the circumstances.</td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="content-footer float-right  match-buttons">
                        <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                        <button type="submit" class="btn btn-primary-orange btn-next" style="margin-left:0px;" >Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end stage 15-->