<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="page-content-inner">
    <div class="content-body">    
        <div class="card p-3" >
            <div class="content-body-container">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="card-title">
                            <p>  Criminal Case</p>
                        </div>
                    </div>
                </div>
                <div class="card p-3" >
                    <div class="content-body-container "> 
                        <div class="row">
                            <div class="col-md-12 col-lg-6 col-sm-12 col-xs-12">
                                <ul class="nav nav-pills nav-fill legal-ul" id="legal-ul" data-id="1">
                                    <li class="nav-item nav-inner-item li-all-cases" id="tab-investigation_list">
                                        <a class="nav-link active nav-tab" data-toggle="tab" href="#legal_cases">Investigation</a>
                                    </li>
                                    <li class="nav-item nav-inner-item li-created-cases" id="tab-batch_list">
                                        <a class="nav-link  nav-tab" data-toggle="tab" href="#batch_list">Criminal Case</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content tab-legal" >
                            <div class="tab-pane fade show active " id="legal_cases" role="tabpanel" aria-labelledby="recent-case-tab">
                                <div class="tab-content tab-inner px-0 pt-0" >

                                    <div class="row mb-3">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <p class="stat-header mb-0 mt-0 padding-l-15"></p>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12">

                                            <div class="list-action "
                                                 <div class=" mt-1 show list-action-filter float-right">
                                                    <input class="txt_search d-inline-block" type="search" placeholder="Search Report ID" id="txt_search-investigation" aria-label="Search">
                                                    <div class="btn-group d-inline-block">
                                                        <button type="button" class="btn btn-secondary-light_blue"   data-toggle="modal" data-target="#modal-create_new_batch">
                                                            <i class="fa fa-cog" aria-hidden="true"></i> Create Docket
                                                        </button>
<!--                                                        <div class="dropdown-menu shadow-sm">
                                                            <a class="dropdown-item disabled action-title txt-gray-500" href="#" >Options</a>
                                                            <button class="dropdown-item" type="button"  data-toggle="modal" data-target="#modal-create_new_batch" >Create new branch</button>
                                                            <button class="dropdown-item" type="button"   data-toggle="modal" data-target="#modal-add_victim">Add victim to a batch</button>
                                                        </div>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-6">
                                            <div class="ul-container">
                                                <div id="cnt_cci_listing">
                                                    <div class="row-header-border">
                                                        <div class="card">
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                                    <span>Victim List</span>
                                                                </div>
                                                                <div class="col-lg-3 col-md-3 col-sm-6 txt-align_center">
                                                                    <span>Investigation Slip No</span>
                                                                </div>
                                                                <div class="col-lg-3 col-md-3 col-sm-6 txt-align_center">
                                                                    <span>Action</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                                               
                                                    <ul class="nav list_content div-agencies-list" id="legal-services-list">
                                                    </ul>  
                                                    <div class="pagination-wrapper rs-list-all">
                                                        <div class="row">
                                                            <div class="col m12 s12 l4">
                                                                <p class="pagination-details rs-info-all"></p>
                                                            </div>
                                                            <div class="col m12 s12 l8 text-right">
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
                                <div class="tab-pane fade" id="batch_list" role="tabpanel" aria-labelledby="recent-case-tab"> 
                                    <div class="tab-content tab-inner px-0" >

                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <p class="stat-header mb-0 mt-0 padding-l-15"></p>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-sm-12">

                                                <div class="list-action ">
                                                    <div class=" mt-1 show list-action-filter float-right">
                                                        <input class="txt_search d-inline-block" type="search" placeholder="Search Docket #" id="txt_search-batchlist" aria-label="Search">
                                                        <div class="btn-group d-inline-block">
                                                            <button type="button" class="btn btn-secondary-light_blue"  data-toggle="modal" data-target="#modal-create_new_batch">
                                                                <i class="fa fa-cog" aria-hidden="true"></i> Create Docket
                                                            </button>
<!--                                                            <div class="dropdown-menu shadow-sm">
                                                                <a class="dropdown-item disabled action-title txt-gray-500" href="#"  >Options</a>
                                                                <button class="dropdown-item" type="button"  data-toggle="modal" data-target="#modal-create_new_batch" >Create new branch</button>
                                                                <button class="dropdown-item" type="button"   data-toggle="modal" data-target="#modal-add_victim">Add victim to a batch</button>
                                                            </div>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="ul-container"  id="cnt_ccb_listing">
                                        <div class="row-header-border">
                                            <div class="card">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12  align-items-center ">
                                                        <span>Docket Details</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="nav list_content div-agencies-list" id="cc_batch_list">                                        
                                        </ul>  
                                        <div class="pagination-wrapper rs-list-batach_list">
                                            <div class="row">
                                                <div class="col m12 s12 l4">
                                                    <p class="pagination-details rs-info-batach_list"></p>
                                                </div>
                                                <div class="col m12 s12 l8 text-right">
                                                    <ul class="pagination rs-pagination-batach_list">
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



    <!--ADD VICTIM TO  BATCH-->
    <div class="modal fade" id="modal-add_victim"  role="dialog" data-backdrop="static">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  msgmodal-header modal-header_title "> Add Victim to Batch</h5>
                </div>
                <div class="modal-body msgmodal-body">
                    <form id="" class="col-lg-12 col-md-12 col-sm-12">
                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <div class="row field-education_grade_year">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label>Batch Code/Number </label>

                                    <input type="text" class="form-control " placeholder="Docket No. 108236">
                                </div>
                            </div>
                            <div class="row field-education_grade_year">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label> Victim/s </label>

                                    <input type="text" class="form-control ">
                                    <small id="emailHelp" class="form-text text-muted">Input name of victim to add to batch. (optional)</small>
                                </div>
                                <div class="victim_list_container">

                                    <div class="tag-area">
                                        <div class="tag">Annalyn Ayop<span>×</span></div>
                                        <div class="tag">Lester Trangia<span>×</span></div>
                                        <div class="tag">Andres Bonifacio<span>×</span></div>
                                        <div class="tag">Jaycee Liwayway<span>×</span></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="content-footer float-right  match-buttons">
                            <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                            <button type="submit" class="btn btn-primary-orange btn-next ml-0" >Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--ADD VICTIM TO  BATCH - SINGLE VICTIM-->
    <div class="modal fade" id="modal-add_to_batch"  role="dialog" data-backdrop="static">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  msgmodal-header modal-header_title "> Add Victim to Batch</h5>

                </div>
                <div class="modal-body msgmodal-body">
                    <form id="form-add_education_info" class="col-lg-12 col-md-12 col-sm-12">
                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <div class="row field-education_grade_year">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label>Batch Code/Number </label>

                                    <input type="text" class="form-control " placeholder="Docket No. 108236">
                                </div>
                            </div>
                            <div class="row field-education_grade_year">
                                <div class="form-groupcol-lg-12 col-md-12 col-sm-12">
                                    <label> Victim name </label>
                                    <input type="text" class="form-control " placeholder="Lester Trangia">
                                    <small class="text-gray-500">Victim will be removed on the list and will be transferred to a batch.</small>
                                </div>

                            </div>
                        </div>
                        <div class="content-footer float-right  match-buttons">
                            <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                            <button type="submit" class="btn btn-primary-orange btn-next ml-0" >Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--CREATE NEW BATCH-->
    <div class="modal fade" id="modal-create_new_batch"  role="dialog" data-backdrop="static">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  msgmodal-header modal-header_title "> Create Docket Number </h5>
                </div>
                <div class="modal-body msgmodal-body">
                    <form id="form-create_batch" class="col-lg-12 col-md-12 col-sm-12">
                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <!--                        <div class="row">
                                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                            <label>Select Batch Type </label>
                                                            <select class="form-control sel-education " name="batch_type">
                                                                <option>Docket</option>
                                                            </select>
                                                        </div>
                                                    </div>-->
                            <div class="row field-education_grade_year">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label> Docket  Number  <font color="red"> <b>*</b></font> </label>
                                    <input type="text" class="form-control" name="inp_docket_num" id="inp_docket_num">
                                </div>
                            </div>
                            <div class="row field-education_grade_year">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label> Victim/s </label>
                                    <input type="text" class="form-control" id="inp-create-search" autocomplete="off">
                                    <small id="emailHelp" class="form-text text-muted">Search name of victim or report id to add to batch. (optional)</small>
                                    <ul class="list-group c-out" style="overflow:z auto; max-height: 200px;" id="create-report-victim-search">   
                                    </ul>
                                </div>
                                <div class="victim_list_container">
                                    <div class="tag-area" id="create-tags">
                                        <!--<div class="tag">Annalyn Ayop<span>×</span></div>-->
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="content-footer float-right  match-buttons">
                            <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                            <button type="submit" class="btn btn-primary-orange btn-next ml-0"  >Add Batch</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--------------Victim logs Modals--------------->
    <!--CREATE NEW REMARKS/UPDATES-->
    <div class="modal fade" id="modal-add_new_remarks"  role="dialog" data-backdrop="static">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  msgmodal-header modal-header_title "> Investigation and Evidence Gathering </h5>
                </div>
                <div class="modal-body msgmodal-body">
                    <form id="form-update_investigation" class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label>Victim Name <font color="red"> <b>*</b> </font> </label>
                                <input type="text" class="form-control " minlength="2" maxlength="100" name="inp_v_full_name" id="inp_v_full_name" disabled >
                            </div>
                        </div>
                        <div class="form-group ">
                            <label>Status <font color="red"> <b>*</b> </font> </label>
                            <select class="form-control valid" aria-invalid="false" name="inp_status" id="inp_status">
                                <option value="0" selected=""> Ongoing </option>
                                <option value="1"> Done </option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label>Investigation Slip No.  <font color="red"> <b>*</b> </font> </label>
                                <input type="text" class="form-control" minlength="2" maxlength="100" name="inp_isn" id="inp_isn">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label>Law Enforcement Officer <font color="red"> <b>*</b> </font> </label>
                                <input type="text" class="form-control" name="inp_officer_name" id="inp_officer_name" minlength="2" maxlength="100">
                            </div>
                        </div>  
                        <div class="row"> 
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label>Date  <font color="red"> <b>*</b> </font> </label>
                                <input type="text" name="inp_filed_date" class="form-control datepicker" id="inp_filed_date" placeholder="MM/DD/YYYY">
                            </div>
                        </div>
                        <div class="content-footer float-right  match-buttons">
                            <button type="button" class="btn btn-cancel btn-modal-cancel">Cancel</button>
                            <button type="submit" class="btn btn-primary-orange btn-next ml-0"  >Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

