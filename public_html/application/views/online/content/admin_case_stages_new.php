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
            <div class="card" > 
                <div class="card-title">
                    <p>Administrative Case</p>
                    <small>Next step will show only when you're done with the current</small>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="settings_content">
                            <div class=" card-stats-inner">
                                <div class="row">
                                    <div class="col-lg-3 col-md-5 col-sm-12 pl-0 br1" >
                                        <!--stepper goes here-->
                                        <div class="history-tl-container">
                                            <ul class="tl" id="ul-stages_admin_case">
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-7 col-sm-8 col-tab-content">
                                        <div class="container  p-2 " >
                                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                                <div class="panel panel-default">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="float-right">
                                                                <button class="btn btn-light btn-victim-list  bg-light-blue text--white" type="button" data-toggle="collapse" id="btnCollapse" data-target="#collapseVictim" aria-expanded="false" aria-controls="collapseExample">
                                                                    Click to see victim 
                                                                </button>
                                                                <button class="btn btn-light btn-victim-list btn-nav-tab bg-light-blue text--white" id="tria_logs" data-id="tria_logs" type="button" data-toggle="tab" data-target="#tria_logs_tab">
                                                                    See Trial logs
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="collapse collapseList" id="collapseVictim">
                                                                <div class="card card-body">
                                                                    <div class="panel-body p-3 card-acordion">
                                                                        <small>
                                                                            Toggle switch to deactivate victim.
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
                                                                                                <input type="checkbox" class="custom-control-input " id="customSwitch1" checked>
                                                                                                <label class="custom-control-label active" for="customSwitch1"></label>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Mark Lester Abubakar Trangia</td>
                                                                                        <td class="text-gray-500">SN#6754443</td>
                                                                                        <td>
                                                                                            <div class="custom-control custom-switch">
                                                                                                <input type="checkbox" class="custom-control-input" id="customSwitch2" checked>
                                                                                                <label class="custom-control-label active" for="customSwitch2"></label>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Kimberly Visperas Bado</td>
                                                                                        <td class="text-gray-500">SN#12312321</td>
                                                                                        <td>
                                                                                            <div class="custom-control custom-switch">
                                                                                                <input type="checkbox" class="custom-control-input" id="customSwitch3" checked>
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
                                                <div class="tab-content pt-0">
                                                    <div class="tab-pane fade show active px-3  mt-5" id="criminal_case_tab" role="tabpanel" aria-labelledby="recent-case-tab">
                                                        <div class="">
                                                            <!--Stage 1-->
                                                            <div class="stage_1 stage-bg show">
                                                                <form id="form-stage-1" class="form-stage-1"> 
                                                                    <div class="m-2 p-3">
                                                                        <div class="rowform-row">
                                                                            <div class="col-12">
                                                                                <div class="mb-3 bg-white ">
                                                                                    <div class="card">
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 col-lg-6 col-sm-12  card-sub-title blue  txt-W-500 mb-0"> Docketing and Assignment of Cases </div>
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
                                                                                                                            <input class="form-check-input inp-stat-ongoing" type="radio" name="stage_status"  value="0">
                                                                                                                            <label class="form-check-label" for="inp-stat-ongoing">
                                                                                                                                On Going
                                                                                                                            </label>
                                                                                                                        </div>
                                                                                                                    </li>
                                                                                                                    <li class="list-group-item">
                                                                                                                        <div class="form-check">
                                                                                                                            <input class="form-check-input inp-stat-done" type="radio" name="stage_status"   value="1">
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
                                                                                            <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                            <textarea class="form-control textarea-xs"name="inp_remarks"></textarea>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                                <div class="content-footer float-right match-buttons">
                                                                                                    <button type="button" class="btn btn-action btn-add_layover btn-cancel ml-0" style="display: none">Cancel</button>
                                                                                                    <button type="button" class="btn btn-primary-orange btn-next btn-edit ml-0">Edit</button>
                                                                                                    <button type="submit" class="btn btn-primary-orange btn-next btn-submit ml-0" style="display: none">Submit</button>
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
                                                            <!--End Stage 1-->

                                                            <!--Stage 2-->                                                        
                                                            <div class="stage_2 stage-bg">
                                                                <div class="m-2 py-3">
                                                                    <div class="mb-3 bg-white p-3">
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title  txt-W-500 mb-0">Conciliation Stage</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-3 col-md-12 col-sm-12">
                                                                            <div class="list-group sub-form-list" id="list-tab" role="tablist">
                                                                                <a class="list-group-item list-group-item-action active" id="a-frm_6" attr-class_name="stage-2_1"  data-toggle="list" href="#tab_summons" role="tab" aria-controls="home">Show Cause Order / Summons</a>
                                                                                <a class="list-group-item list-group-item-action" id="a-frm_7" attr-class_name="stage-2_2"  data-toggle="list" href="#tab_answers" role="tab" aria-controls="prelim">Filing of Answer</a>
                                                                                <a class="list-group-item list-group-item-action" id="a-frm_8" attr-class_name="stage-2_3"  data-toggle="list" href="#tab_reply" role="tab" aria-controls="profile">Filing of Reply</a>
                                                                                <a class="list-group-item list-group-item-action" id="a-frm_9" attr-class_name="stage-2_4"  data-toggle="list" href="#tab_motion" role="tab" aria-controls="messages">Motion for extension to file a verified answer</a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-9 col-md-12 col-sm-12 px-0">
                                                                            <div class="tab-content tab-sub-info-content" id="nav-tabContent p-1" >

                                                                                <!--Stage 2-1 --> 
                                                                                <div class="tab-pane fade show active bg-white" id="tab_summons" role="tabpanel" aria-labelledby="list-home-list">
                                                                                    <form id="form-stage-2_1" class="form-stage-2_1"> 
                                                                                        <div class="card">
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 col-lg-6 col-sm-12  txt-W-500 mb-0">Show Cause Order / Summons</div>
                                                                                                <div class="col-md-12 col-lg-6 col-sm-12 card-sub-title blue  txt-W-500 mb-0">
                                                                                                    <div class=" mt-1 show list-action-filter float-right">
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
                                                                                                                                <input class="form-check-input inp-stat-ongoing" type="radio" name="stage_status"  value="0">
                                                                                                                                <label class="form-check-label" for="inp-stat-ongoing">
                                                                                                                                    On Going
                                                                                                                                </label>
                                                                                                                            </div>
                                                                                                                        </li>
                                                                                                                        <li class="list-group-item">
                                                                                                                            <div class="form-check">
                                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status"   value="1">
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
                                                                                        <div class="card">
                                                                                            <div class="row">
                                                                                                <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                                    <label>Date <font color="red"> <b>*</b> </font> </label>
                                                                                                    <input type="text" class="form-control datepicker" placeholder="MM/DD/YYYY" name="inp_date_remarks">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                                <textarea class="form-control textarea-xs" name="inp_remarks"></textarea>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                                    <div class="content-footer float-right  match-buttons">
                                                                                                        <button type="button" class="btn btn-action btn-add_layover btn-cancel ml-0" style="display: none">Cancel</button>
                                                                                                        <button type="button" class="btn btn-primary-orange btn-next btn-edit ml-0">Edit</button>
                                                                                                        <button type="submit" class="btn btn-primary-orange btn-next btn-submit ml-0" style="display: none">Submit</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                                <!--End Stage 2-1 -->

                                                                                <!--Stage 2-2 --> 
                                                                                <div class="tab-pane fade  bg-white" id="tab_answers" role="tabpanel" aria-labelledby="list-home-list">
                                                                                    <form id="form-stage-2_2" class="form-stage-2_2"> 
                                                                                        <div class="card">
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 col-lg-6 col-sm-12  txt-W-500 mb-0">Filing of Answer</div>
                                                                                                <div class="col-md-12 col-lg-6 col-sm-12 card-sub-title blue  txt-W-500 mb-0">
                                                                                                    <div class=" mt-1 show list-action-filter float-right">
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
                                                                                                                                <input class="form-check-input inp-stat-ongoing" type="radio" name="stage_status"  value="0">
                                                                                                                                <label class="form-check-label" for="inp-stat-ongoing">
                                                                                                                                    On Going
                                                                                                                                </label>
                                                                                                                            </div>
                                                                                                                        </li>
                                                                                                                        <li class="list-group-item">
                                                                                                                            <div class="form-check">
                                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status"   value="1">
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
                                                                                        <div class="card">
                                                                                            <div class="row">
                                                                                                <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                                    <label>Date <font color="red"> <b>*</b> </font> </label>
                                                                                                    <input type="text" class="form-control datepicker" placeholder="MM/DD/YYYY" name="inp_date_remarks">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                                <textarea class="form-control textarea-xs" name="inp_remarks"></textarea>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                                    <div class="content-footer float-right  match-buttons">
                                                                                                        <button type="button" class="btn btn-action btn-add_layover btn-cancel ml-0" style="display: none">Cancel</button>
                                                                                                        <button type="button" class="btn btn-primary-orange btn-next btn-edit ml-0" >Edit</button>
                                                                                                        <button type="submit" class="btn btn-primary-orange btn-next btn-submit ml-0" style="display: none">Submit</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>  
                                                                                    </form>
                                                                                </div>
                                                                                <!-- End Stage 2-2 --> 

                                                                                <!--Stage 2-3 --> 
                                                                                <div class="tab-pane fade  bg-white" id="tab_reply" role="tabpanel" aria-labelledby="list-home-list">
                                                                                    <form id="form-stage-2_3" class="form-stage-2_3"> 
                                                                                        <div class="card">
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 col-lg-6 col-sm-12  txt-W-500 mb-0">Filing of Reply</div>
                                                                                                <div class="col-md-12 col-lg-6 col-sm-12 card-sub-title blue  txt-W-500 mb-0">
                                                                                                    <div class=" mt-1 show list-action-filter float-right">
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
                                                                                                                                <input class="form-check-input inp-stat-ongoing" type="radio" name="stage_status"  value="0">
                                                                                                                                <label class="form-check-label" for="inp-stat-ongoing">
                                                                                                                                    On Going
                                                                                                                                </label>
                                                                                                                            </div>
                                                                                                                        </li>
                                                                                                                        <li class="list-group-item">
                                                                                                                            <div class="form-check">
                                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status"   value="1">
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
                                                                                        <div class="card">
                                                                                            <div class="row">
                                                                                                <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                                    <label>Date <font color="red"> <b>*</b> </font> </label>
                                                                                                    <input type="text" class="form-control datepicker" placeholder="MM/DD/YYYY" name="inp_date_remarks">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                                <textarea class="form-control textarea-xs"  name="inp_remarks"></textarea>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                                    <div class="content-footer float-right  match-buttons">
                                                                                                        <button type="button" class="btn btn-action btn-add_layover btn-cancel ml-0" style=" display: none">Cancel</button>
                                                                                                        <button type="button" class="btn btn-primary-orange btn-next btn-edit ml-0" >Edit</button>
                                                                                                        <button type="submit" class="btn btn-primary-orange btn-next btn-submit ml-0" style=" display: none">Submit</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                                <!-- End Stage 2-3 --> 

                                                                                <!--Stage 2-4 --> 
                                                                                <div class="tab-pane fade bg-white" id="tab_motion" role="tabpanel" aria-labelledby="list-home-list">
                                                                                    <form id="form-stage-2_4" class="form-stage-2_4"> 
                                                                                        <div class="card">
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 col-lg-6 col-sm-12 txt-W-500 mb-0">Motion for extension to file a verified answer</div>
                                                                                                <div class="col-md-12 col-lg-6 col-sm-12card-sub-title blue  txt-W-500 mb-0">
                                                                                                    <div class=" mt-1 show list-action-filter float-right">
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
                                                                                                                                <input class="form-check-input inp-stat-ongoing" type="radio" name="stage_status"  value="0">
                                                                                                                                <label class="form-check-label" for="inp-stat-ongoing">
                                                                                                                                    On Going
                                                                                                                                </label>
                                                                                                                            </div>
                                                                                                                        </li>
                                                                                                                        <li class="list-group-item">
                                                                                                                            <div class="form-check">
                                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status"   value="1">
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
                                                                                        <div class="card">
                                                                                            <div class="row">
                                                                                                <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                                    <label>Date <font color="red"> <b>*</b> </font> </label>
                                                                                                    <input type="text" class="form-control datepicker" placeholder="MM/DD/YYYY" name="inp_date_remarks">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                                <textarea class="form-control" style="height: 150px !important;" name="inp_remarks"></textarea>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                                    <div class="content-footer float-right  match-buttons">
                                                                                                        <button type="button" class="btn btn-action btn-add_layover btn-cancel ml-0" style=" display: none">Cancel</button>
                                                                                                        <button type="button" class="btn btn-primary-orange btn-next btn-edit ml-0" >Edit</button>
                                                                                                        <button type="submit" class="btn btn-primary-orange btn-next btn-submit ml-0" style="display: none">Submit</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                                <!-- End Stage 2-4 --> 

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>                                                     
                                                            <!--End Stage 2-->  

                                                            <!--Stage 3-->
                                                            <div class="stage_3 stage-bg">
                                                                <form id="form-stage-3" class="form-stage-3"> 
                                                                    <div class="m-2 py-3">
                                                                        <div class="rowform-row">
                                                                            <div class="col-12">
                                                                                <div class="mb-3 bg-white ">
                                                                                    <div class="card">
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 col-lg-6 col-sm-12  card-sub-title blue  txt-W-500 mb-0"> Issuance of Order of preventive suspension</div>
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
                                                                                                                            <input class="form-check-input inp-stat-ongoing" type="radio" name="stage_status"  value="0">
                                                                                                                            <label class="form-check-label" for="inp-stat-ongoing">
                                                                                                                                On Going
                                                                                                                            </label>
                                                                                                                        </div>
                                                                                                                    </li>
                                                                                                                    <li class="list-group-item">
                                                                                                                        <div class="form-check">
                                                                                                                            <input class="form-check-input inp-stat-done" type="radio" name="stage_status"   value="1">
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
                                                                                            <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                            <textarea class="form-control textarea-xs" name="inp_remarks"></textarea>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label>Issue Status </label>
                                                                                            <select class="form-control sel-issue-status" aria-invalid="false" name="inp_issue_status" >
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                                <div class="content-footer float-right match-buttons">
                                                                                                    <button type="button" class="btn btn-action btn-add_layover btn-cancel ml-0" style="display: none">Cancel</button>
                                                                                                    <button type="button" class="btn btn-primary-orange btn-next btn-edit ml-0" >Edit</button>
                                                                                                    <button type="submit" class="btn btn-primary-orange btn-next btn-submit ml-0" style="display: none">Submit</button>
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
                                                            <!--End Stage 3-->

                                                            <!--Stage 4-->
                                                            <div class="stage_4 stage-bg">
                                                                <div class="m-2 py-3">
                                                                    <div class="row">
                                                                        <div class="col-lg-3 col-md-12 col-sm-12">
                                                                            <div class="list-group sub-form-list" id="list-tab" role="tablist">
                                                                                <a class="list-group-item list-group-item-action active" id="a-frm_11" attr-class_name="stage-4_1" data-toggle="list" href="#tab_hearing" role="tab" aria-controls="home">Preliminary Hearing</a>
                                                                                <a class="list-group-item list-group-item-action" id="a-frm_12" attr-class_name="stage-4_2" data-toggle="list" href="#tab_question" role="tab" aria-controls="prelim">Hearing for clarificatory Questions</a>
                                                                                <a class="list-group-item list-group-item-action" id="a-frm_13" attr-class_name="stage-4_3" data-toggle="list" href="#tab_documents" role="tab" aria-controls="profile">Order to appear/to produce documents</a>
                                                                                <a class="list-group-item list-group-item-action" id="a-frm_14" attr-class_name="stage-4_4" data-toggle="list" href="#tab_judgement" role="tab" aria-controls="messages">Summary Judgment</a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-9 col-md-12 col-sm-12 px-0">
                                                                            <div class="tab-content tab-sub-info-content" id="nav-tabContent p-1" >

                                                                                <!--Stage 4-1 -->
                                                                                <div class="tab-pane  fade  show active bg-white" id="tab_hearing" role="tabpanel" aria-labelledby="list-home-list">
                                                                                    <form id="form-stage-4_1" class="form-stage-4_1"> 
                                                                                        <div class="card">
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 col-lg-6 col-sm-12  txt-W-500 mb-0">Preliminary Hearing</div>
                                                                                                <div class="col-md-12 col-lg-6 col-sm-12 card-sub-title blue  txt-W-500 mb-0">
                                                                                                    <div class=" mt-1 show list-action-filter float-right">
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
                                                                                                                                <input class="form-check-input inp-stat-ongoing" type="radio" name="stage_status"  value="0">
                                                                                                                                <label class="form-check-label" for="inp-stat-ongoing">
                                                                                                                                    On Going
                                                                                                                                </label>
                                                                                                                            </div>
                                                                                                                        </li>
                                                                                                                        <li class="list-group-item">
                                                                                                                            <div class="form-check">
                                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status"   value="1">
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
                                                                                        <div class="card">
                                                                                            <div class="row">
                                                                                                <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                                    <label>Date <font color="red"> <b>*</b> </font> </label>
                                                                                                    <input type="text" class="form-control datepicker" placeholder="MM/DD/YYYY" name="inp_date_remarks">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                                <textarea class="form-control textarea-xs" name="inp_remarks"></textarea>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                                    <div class="content-footer float-right  match-buttons">
                                                                                                        <button type="button" class="btn btn-action btn-add_layover btn-cancel ml-0" style="display: none">Cancel</button>
                                                                                                        <button type="button" class="btn btn-primary-orange btn-next btn-edit ml-0" >Edit</button>
                                                                                                        <button type="submit" class="btn btn-primary-orange btn-next btn-submit ml-0" style="display: none">Submit</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                                <!--End Stage 4-1 -->

                                                                                <!--Stage 4-2 -->
                                                                                <div class="tab-pane fade bg-white" id="tab_question" role="tabpanel" aria-labelledby="list-home-list">
                                                                                    <form id="form-stage-4_2" class="form-stage-4_2"> 
                                                                                        <div class="card">
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 col-lg-6 col-sm-12  txt-W-500 mb-0">Hearing for Clarificatory Questions</div>
                                                                                                <div class="col-md-12 col-lg-6 col-sm-12 card-sub-title blue  txt-W-500 mb-0">
                                                                                                    <div class=" mt-1 show list-action-filter float-right">
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
                                                                                                                                <input class="form-check-input inp-stat-ongoing" type="radio" name="stage_status"  value="0">
                                                                                                                                <label class="form-check-label" for="inp-stat-ongoing">
                                                                                                                                    On Going
                                                                                                                                </label>
                                                                                                                            </div>
                                                                                                                        </li>
                                                                                                                        <li class="list-group-item">
                                                                                                                            <div class="form-check">
                                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status"   value="1">
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
                                                                                        <div class="card">
                                                                                            <div class="row">
                                                                                                <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                                    <label>Date <font color="red"> <b>*</b> </font> </label>
                                                                                                    <input type="text" class="form-control datepicker" placeholder="MM/DD/YYYY" name="inp_date_remarks">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                                <textarea class="form-control textarea-xs"  name="inp_remarks"></textarea>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                                    <div class="content-footer float-right  match-buttons">
                                                                                                        <button type="button" class="btn btn-action btn-add_layover btn-cancel ml-0" style="display: none">Cancel</button>
                                                                                                        <button type="button" class="btn btn-primary-orange btn-next btn-edit ml-0" >Edit</button>
                                                                                                        <button type="submit" class="btn btn-primary-orange btn-next btn-submit ml-0" style="display: none">Submit</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                                <!--End Stage 4-2 -->

                                                                                <!--Stage 4-3 -->
                                                                                <div class="tab-pane  fade bg-white" id="tab_documents" role="tabpanel" aria-labelledby="list-home-list">
                                                                                    <form id="form-stage-4_3" class="form-stage-4_3"> 
                                                                                        <div class="card">
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 col-lg-6 col-sm-12  txt-W-500 mb-0">Order to appear/to produce documents</div>
                                                                                                <div class="col-md-12 col-lg-6 col-sm-12 card-sub-title blue  txt-W-500 mb-0">
                                                                                                    <div class=" mt-1 show list-action-filter float-right">
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
                                                                                                                                <input class="form-check-input inp-stat-ongoing" type="radio" name="stage_status"  value="0">
                                                                                                                                <label class="form-check-label" for="inp-stat-ongoing">
                                                                                                                                    On Going
                                                                                                                                </label>
                                                                                                                            </div>
                                                                                                                        </li>
                                                                                                                        <li class="list-group-item">
                                                                                                                            <div class="form-check">
                                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status"   value="1">
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
                                                                                        <div class="card">
                                                                                            <div class="row">
                                                                                                <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                                    <label>Date <font color="red"> <b>*</b> </font> </label>
                                                                                                    <input type="text" class="form-control datepicker" placeholder="MM/DD/YYYY" name="inp_date_remarks">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                                <textarea class="form-control textarea-xs" name="inp_remarks"></textarea>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                                    <div class="content-footer float-right  match-buttons">
                                                                                                        <button type="button" class="btn btn-action btn-add_layover btn-cancel ml-0" style=" display: none">Cancel</button>
                                                                                                        <button type="button" class="btn btn-primary-orange btn-next btn-edit ml-0" >Edit</button>
                                                                                                        <button type="submit" class="btn btn-primary-orange btn-next btn-submit ml-0" style="display: none">Submit</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                                <!--End Stage 4-3 -->

                                                                                <!--Stage 4-4 -->
                                                                                <div class="tab-pane fade  bg-white" id="tab_judgement" role="tabpanel" aria-labelledby="list-home-list">
                                                                                    <form id="form-stage-4_4" class="form-stage-4_4"> 
                                                                                        <div class="card">
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 col-lg-6 col-sm-12  txt-W-500 mb-0">Summary Judgment</div>
                                                                                                <div class="col-md-12 col-lg-6 col-sm-12 card-sub-title blue  txt-W-500 mb-0">
                                                                                                    <div class=" mt-1 show list-action-filter float-right">
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
                                                                                                                                <input class="form-check-input inp-stat-ongoing" type="radio" name="stage_status"  value="0">
                                                                                                                                <label class="form-check-label" for="inp-stat-ongoing">
                                                                                                                                    On Going
                                                                                                                                </label>
                                                                                                                            </div>
                                                                                                                        </li>
                                                                                                                        <li class="list-group-item">
                                                                                                                            <div class="form-check">
                                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status"   value="1">
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
                                                                                        <div class="card">
                                                                                            <div class="row">
                                                                                                <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                                    <label>Date <font color="red"> <b>*</b> </font> </label>
                                                                                                    <input type="text" class="form-control datepicker" placeholder="MM/DD/YYYY" name="inp_date_remarks">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                                <textarea class="form-control textarea-xs" name="inp_remarks"></textarea>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                                    <div class="content-footer float-right  match-buttons">
                                                                                                        <button type="button" class="btn btn-action btn-add_layover btn-cancel ml-0" style="display: none">Cancel</button>
                                                                                                        <button type="button" class="btn btn-primary-orange btn-next btn-edit ml-0">Edit</button>
                                                                                                        <button type="submit" class="btn btn-primary-orange btn-next btn-submit ml-0" style="isplay: none">Submit</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                                <!--End Stage 4-4 -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--End Stage 4-->

                                                            <!--Stage 5-->
                                                            <div class="stage_5 stage-bg">
                                                                <form id="form-stage-5" class="form-stage-5"> 
                                                                    <div class="m-2 py-3">
                                                                        <div class="rowform-row">
                                                                            <div class="col-12">
                                                                                <div class="mb-3 bg-white ">
                                                                                    <div class="card">
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 col-lg-6 col-sm-12  card-sub-title blue  txt-W-500 mb-0"> Submission for Resolution</div>
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
                                                                                                                            <input class="form-check-input inp-stat-ongoing" type="radio" name="stage_status"  value="0">
                                                                                                                            <label class="form-check-label" for="inp-stat-ongoing">
                                                                                                                                On Going
                                                                                                                            </label>
                                                                                                                        </div>
                                                                                                                    </li>
                                                                                                                    <li class="list-group-item">
                                                                                                                        <div class="form-check">
                                                                                                                            <input class="form-check-input inp-stat-done" type="radio" name="stage_status"   value="1">
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
                                                                                                <label>Date of Submission </label><font color="red"> <b>*</b> </font>
                                                                                                <input type="text" class="form-control datepicker" placeholder="MM/DD/YYYY" name="inp_date_remarks">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                            <textarea class="form-control textarea-xs" name="inp_remarks"></textarea>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                                <div class="content-footer float-right match-buttons">
                                                                                                    <button type="button" class="btn btn-action btn-add_layover btn-cancel ml-0" style=" display: none">Cancel</button>
                                                                                                    <button type="button" class="btn btn-primary-orange btn-next btn-edit ml-0" >Edit</button>
                                                                                                    <button type="submit" class="btn btn-primary-orange btn-next btn-submit ml-0" style="display: none">Submit</button>
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
                                                            <!--End Stage 5-->

                                                            <!--Stage 6-->
                                                            <div class="stage_6 stage-bg">
                                                                <form id="form-stage-6" class="form-stage-6"> 
                                                                    <div class="m-2 py-3">
                                                                        <div class="rowform-row">
                                                                            <div class="col-12">
                                                                                <div class="mb-3 bg-white ">
                                                                                    <div class="card">
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 col-lg-6 col-sm-12  card-sub-title blue  txt-W-500 mb-0"> Resolution of the Case</div>
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
                                                                                                                            <input class="form-check-input inp-stat-ongoing" type="radio" name="stage_status"  value="0">
                                                                                                                            <label class="form-check-label" for="inp-stat-ongoing">
                                                                                                                                On Going
                                                                                                                            </label>
                                                                                                                        </div>
                                                                                                                    </li>
                                                                                                                    <li class="list-group-item">
                                                                                                                        <div class="form-check">
                                                                                                                            <input class="form-check-input inp-stat-done" type="radio" name="stage_status"   value="1">
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
                                                                                            <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                            <textarea class="form-control textarea-xs" name="inp_remarks"></textarea>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                                <div class="content-footer float-right match-buttons">
                                                                                                    <button type="button" class="btn btn-action btn-add_layover btn-cancel ml-0" style=" display: none">Cancel</button>
                                                                                                    <button type="button" class="btn btn-primary-orange btn-next btn-edit ml-0" >Edit</button>
                                                                                                    <button type="submit" class="btn btn-primary-orange btn-next btn-submit ml-0" style="display: none">Submit</button>
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
                                                            <!--End Stage 6-->

                                                            <!--Stage 7-->
                                                            <div class="stage_7 stage-bg">
                                                                <div class="m-2 py-3">
                                                                    <div class="row">
                                                                        <div class="col-lg-3 col-md-12 col-sm-12">
                                                                            <div class="list-group sub-form-list" id="list-tab" role="tablist">
                                                                                <a class="list-group-item list-group-item-action active" id="a-frm_17" attr-class_name="stage-7_1" data-toggle="list" href="#tab_frm17" role="tab" aria-controls="Appeal to the DOLE Secretary">Appeal to the DOLE Secretary</a>
                                                                                <a class="list-group-item list-group-item-action" id="a-frm_18"  attr-class_name="stage-7_2"  data-toggle="list" href="#tab_frm18" role="tab" aria-controls="Entry of Judgment">Entry of Judgment</a>
                                                                                <a class="list-group-item list-group-item-action" id="a-frm_19"  attr-class_name="stage-7_3"  data-toggle="list" href="#tab_frm19" role="tab" aria-controls="Resolution of Appeal">Resolution of Appeal</a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-9 col-md-12 col-sm-12 px-0">
                                                                            <div class="tab-content tab-sub-info-content" id="nav-tabContent p-1" >

                                                                                <!--Stage 7-1 -->
                                                                                <div class="tab-pane  fade  show active bg-white" id="tab_frm17" role="tabpanel" aria-labelledby="list-home-list">
                                                                                    <form id="form-stage-7_1" class="form-stage-7_1"> 
                                                                                        <div class="card">
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 col-lg-6 col-sm-12  txt-W-500 mb-0">Appeal to the DOLE Secretary</div>
                                                                                                <div class="col-md-12 col-lg-6 col-sm-12 card-sub-title blue  txt-W-500 mb-0">
                                                                                                    <div class=" mt-1 show list-action-filter float-right">
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
                                                                                                                                <input class="form-check-input inp-stat-ongoing" type="radio" name="stage_status"  value="0">
                                                                                                                                <label class="form-check-label" for="inp-stat-ongoing">
                                                                                                                                    On Going
                                                                                                                                </label>
                                                                                                                            </div>
                                                                                                                        </li>
                                                                                                                        <li class="list-group-item">
                                                                                                                            <div class="form-check">
                                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status"   value="1">
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
                                                                                        <div class="card">
                                                                                            <div class="row">
                                                                                                <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                                    <label>Date <font color="red"> <b>*</b> </font> </label>
                                                                                                    <input type="text" class="form-control datepicker" placeholder="MM/DD/YYYY" name="inp_date_remarks">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                                <textarea class="form-control textarea-xs" name="inp_remarks"></textarea>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                                    <div class="content-footer float-right  match-buttons">
                                                                                                        <button type="button" class="btn btn-action btn-add_layover btn-cancel ml-0" style="display: none">Cancel</button>
                                                                                                        <button type="button" class="btn btn-primary-orange btn-next btn-edit ml-0">Edit</button>
                                                                                                        <button type="submit" class="btn btn-primary-orange btn-next btn-submit ml-0" style="display: none">Submit</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                                <!--End Stage 7-1 -->

                                                                                <!--Stage 7-2 -->
                                                                                <div class="tab-pane fade bg-white" id="tab_frm18" role="tabpanel" aria-labelledby="list-home-list">
                                                                                    <form id="form-stage-7_2" class="form-stage-7_2"> 
                                                                                        <div class="card">
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 col-lg-6 col-sm-12 txt-W-500 mb-0">Entry of Judgment</div>
                                                                                                <div class="col-md-12 col-lg-6 col-sm-12 card-sub-title blue  txt-W-500 mb-0">
                                                                                                    <div class=" mt-1 show list-action-filter float-right">
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
                                                                                                                                <input class="form-check-input inp-stat-ongoing" type="radio" name="stage_status"  value="0">
                                                                                                                                <label class="form-check-label" for="inp-stat-ongoing">
                                                                                                                                    On Going
                                                                                                                                </label>
                                                                                                                            </div>
                                                                                                                        </li>
                                                                                                                        <li class="list-group-item">
                                                                                                                            <div class="form-check">
                                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status"   value="1">
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
                                                                                        <div class="card">
                                                                                            <div class="row">
                                                                                                <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                                    <label>Date <font color="red"> <b>*</b> </font> </label>
                                                                                                    <input type="text" class="form-control datepicker" placeholder="MM/DD/YYYY" name="inp_date_remarks">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                                <textarea class="form-control textarea-xs" name="inp_remarks"></textarea>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                                    <div class="content-footer float-right  match-buttons">
                                                                                                        <button type="button" class="btn btn-action btn-add_layover btn-cancel ml-0" style="display: none">Cancel</button>
                                                                                                        <button type="button" class="btn btn-primary-orange btn-next btn-edit ml-0">Edit</button>
                                                                                                        <button type="submit" class="btn btn-primary-orange btn-next btn-submit ml-0" style="display: none">Submit</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                                <!--End Stage 7-2 -->

                                                                                <!--Stage 7-3 -->
                                                                                <div class="tab-pane  fade bg-white" id="tab_frm19" role="tabpanel" aria-labelledby="list-home-list">
                                                                                    <form id="form-stage-7_3" class="form-stage-7_3"> 
                                                                                        <div class="card">
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 col-lg-6 col-sm-12 txt-W-500 mb-0">Resolution of Appeal</div>
                                                                                                <div class="col-md-12 col-lg-6 col-sm-12 card-sub-title blue  txt-W-500 mb-0">
                                                                                                    <div class=" mt-1 show list-action-filter float-right">
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
                                                                                                                                <input class="form-check-input inp-stat-ongoing" type="radio" name="stage_status"  value="0">
                                                                                                                                <label class="form-check-label" for="inp-stat-ongoing">
                                                                                                                                    On Going
                                                                                                                                </label>
                                                                                                                            </div>
                                                                                                                        </li>
                                                                                                                        <li class="list-group-item">
                                                                                                                            <div class="form-check">
                                                                                                                                <input class="form-check-input inp-stat-done" type="radio" name="stage_status"   value="1">
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
                                                                                        <div class="card">
                                                                                            <div class="row">
                                                                                                <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                                                                                    <label>Date <font color="red"> <b>*</b> </font> </label>
                                                                                                    <input type="text" class="form-control datepicker" placeholder="MM/DD/YYYY" name="inp_date_remarks">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                                <textarea class="form-control textarea-xs" name="inp_remarks"></textarea>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                                                    <div class="content-footer float-right  match-buttons">
                                                                                                        <button type="button" class="btn btn-action btn-add_layover btn-cancel ml-0" style=" display: none">Cancel</button>
                                                                                                        <button type="button" class="btn btn-primary-orange btn-next btn-edit ml-0" >Edit</button>
                                                                                                        <button type="submit" class="btn btn-primary-orange btn-next btn-submit ml-0" style=" display: none">Submit</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                                <!--End Stage 7-3 -->

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--End Stage 7-->

                                                            <!--Stage 8-->
                                                            <div class="stage_8 stage-bg ">
                                                                <form id="form-stage-8" class="form-stage-8"> 
                                                                    <div class="m-2 py-3">
                                                                        <div class="rowform-row">
                                                                            <div class="col-12">
                                                                                <div class="mb-3 bg-white ">
                                                                                    <div class="card">
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 col-lg-6 col-sm-12 card-sub-title blue  txt-W-500 mb-0"> Writ of Execution</div>
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
                                                                                                                            <input class="form-check-input inp-stat-ongoing" type="radio" name="stage_status"  value="0">
                                                                                                                            <label class="form-check-label" for="inp-stat-ongoing">
                                                                                                                                On Going
                                                                                                                            </label>
                                                                                                                        </div>
                                                                                                                    </li>
                                                                                                                    <li class="list-group-item">
                                                                                                                        <div class="form-check">
                                                                                                                            <input class="form-check-input inp-stat-done" type="radio" name="stage_status"   value="1">
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
                                                                                            <label>Remarks<font color="red"> <b>*</b> </font></label>
                                                                                            <textarea class="form-control textarea-xs" name="inp_remarks"></textarea>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                                <div class="content-footer float-right match-buttons">
                                                                                                    <button type="button" class="btn btn-action btn-add_layover btn-cancel ml-0" style="display: none">Cancel</button>
                                                                                                    <button type="button" class="btn btn-primary-orange btn-next btn-edit ml-0" >Edit</button>
                                                                                                    <button type="submit" class="btn btn-primary-orange btn-next btn-submit ml-0" style="display: none">Submit</button>
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
                                                            <!--End Stage 8-->

                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade   px-3 mt-5 bg-faded" id="tria_logs_tab" role="tabpanel" aria-labelledby="recent-case-tab">
                                                        <div class="m-2 py-3">
                                                            <div class="rowform-row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <div class="row mb-2">
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 mb-0 "> 
                                                                            <button class="btn btn-light  btn-nav-tab float-right icms-bg-primary text--white" id="criminal_case" data-id="criminal_case" type="button" data-toggle="tab" data-target="#criminal_case_tab" >
                                                                                Return to Criminal Case
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 bg-white p-3">
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue  txt-W-500 mb-0"><p class="stat-header blue mb-0">Activity Logs</p></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 bg-white p-3">
                                                                        <div id="act-log-container">
                                                                            <div class="card-nav act-logs m-x-0 padding-T-15 " id="act-logs-content" style="max-height: 500px;overflow-y: scroll;" datapage="1" datapageend="0">
                                                                                <ul class="div-all list_content" id="list-all_logs">
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
            </div>
        </div>
    </div>
</div>
<!--</div>-->



