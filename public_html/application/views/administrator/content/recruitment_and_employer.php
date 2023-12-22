<?php
/**
 * Page Security
 */
defined('BASEPATH') or exit('No direct script access allowed');
//echo"<pre>";
// print_r($_SESSION);
//
//echo $this->yel->generateCaseControlNumber();
?>


<div class="page-content-inner">
    <div class="content-body">
        <div class="card p1rem">
            <div class="content-body-container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card-title ">
                            <p> Recruitment and Employers</p>
                            <small class="card-desc">List of all recruitment agencies and employers with associated
                                case.</small>
                        </div>
                    </div>
                </div>
                <div class="row tab-header mt-3">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <ul class="nav nav-pills nav-fill case-ul" id="case-ul" data-id="1">
                            <li class="nav-item nav-inner-item li-all-cases">
                                <a class="nav-link active nav-tab" data-toggle="tab" href="#local_rec_tab">Local
                                    Recruitment Agencies</a>
                            </li>
                            <li class="nav-item nav-inner-item li-created-cases">
                                <a class="nav-link  nav-tab" data-toggle="tab" href="#foreign_rec_tab">Foreign
                                    Recruitment Agencies</a>
                            </li>
                            <li class="nav-item nav-inner-item li-tagged-cases">
                                <a class="nav-link nav-tab" data-toggle="tab" href="#employer_tab">Employer </a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class=" card-stats-inner">

                    <div class="tab-content mgn-T-18 " id="myTabContent">
                        <!--ALL CASE TAB-->
                        <div class="tab-pane fade show active" id="local_rec_tab" role="tabpanel"
                            aria-labelledby="recent-case-tab">

                            <div class="row px-3 mx-1 mt-3">
                                <div class="col-lg-6 col-sm-12 col-md-12 ">
                                    <div class="card-header card-sub-title bg-white p-0 m-0">
                                        Local Recruitment Agency<br>
                                        <small class="card-desc"> List of all local recruitment agencies. </small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-md-12">
                                    <div class=" list-action  list-action-filter">
                                        <input class="txt_search" id="txt_search-local_recruitment" type="search"
                                            placeholder="keyword..." aria-label="Search">
                                        <span class="hidden_tooltip_all" data-toggle="tooltip" data-placement="top"
                                            title='Press "Enter" to search keyword'></span>
                                        <select class="select select-filter sel-local-orderby">
                                            <option value="0" disabled selected="">Order by</option>
                                            <option value="0">All</option>
                                            <option value="1">Agency (ASC)</option>
                                            <option value="2">Agency (DESC)</option>
                                            <option value="3">Case Count (ASC)</option>
                                            <option value="4">Case Count (DESC) </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!------------->
                            <div class="bg-grey p-3 mx-3">
                                <div class="tab-content " id="case_involement">
                                    <!--ALL CASE TAB-->
                                    <div class="tab-pane fade show active" id="local_rec_tab" role="tabpanel"
                                        aria-labelledby="recent-case-tab">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12 col-sm-12 float-right">
                                                <nav class="nav nav-inner-tab">
                                                    <a class="nav-link txt-14 tab_local active " data-toggle="tab"
                                                        href="#case_involement" data-id="with_cases">
                                                        Agency with case involvement
                                                    </a>
                                                    <a class="nav-link txt-14 tab_local" data-toggle="tab"
                                                        href="#all_agency" data-id="all_agency">
                                                        All Local Recruitment Agency
                                                    </a>
                                                </nav>


                                            </div>
                                        </div>
                                        <div class="mt-2 ">
                                            <div class="list-container_local">
                                                <div class="row-header">
                                                    <div class="row victim-list-header row-header-border m-0">
                                                        <div
                                                            class="col-lg-8 col-md-8 col-sm-8  col-header  pl-3 bg-white">
                                                            Recruitment Details</div>
                                                        <div
                                                            class=" col-lg-2 col-md-2 col-sm-2  d-flex align-items-center justify-content-center bg-white col-header">
                                                            Case Involvement</div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2  col-header bg-white">
                                                            Action</div>
                                                    </div>
                                                </div>


                                                <!-------------Loading Empty Placeholder for list  ------------>
                                                <ul class="nav agency-list_content filter_load_placeholder"> </ul>
                                                <!-------------------------------------------------------------->
                                                <ul
                                                    class="nav agency-list_content div-all case-list list_content  list-local_recruiter">
                                                </ul>
                                                <div
                                                    class="pagination-wrapper pt-3 rs-list-local_recruitment_with_case  bg-white px-3">
                                                    <div class="row">
                                                        <div class="col col-lg-4 col-md-12 col-sm-12">
                                                            <p class="pagination-details rs-info-local_recruitment"></p>
                                                        </div>
                                                        <div class="col col-lg-8 col-md-12 col-sm-12 text-right">
                                                            <ul class="pagination rs-pagination-local_recruitment">
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="empty-search"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--END LOCAL TAB-->

                        <!--FOREIGN TAB-->
                        <div class="tab-pane fade  " id="foreign_rec_tab" role="tabpanel"
                            aria-labelledby="recent-case-tab">

                            <div class="row px-3 mx-1 mt-3">
                                <div class="col-lg-6 col-sm-12 col-md-12 ">
                                    <div class="card-header card-sub-title bg-white p-0 m-0">
                                        Foreign Recruitment Agency<br>
                                        <small class="card-desc"> List of all foreign recruitment agency. </small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-md-12 ">
                                    <div class=" list-action  list-action-filter">
                                        <input class="txt_search" id="txt_search-foreign_recruitment" type="search"
                                            placeholder="keyword..." aria-label="Search">
                                        <select class="select select-filter sel-foreign-orderby">
                                            <option value="0" disabled selected="">Order by</option>
                                            <option value="0">All</option>
                                            <option value="1">Agency (ASC)</option>
                                            <option value="2">Agency (DESC)</option>
                                            <option value="3">Case Count (ASC)</option>
                                            <option value="4">Case Count (DESC) </option>
                                        </select>
                                        <span class="hidden_tooltip_all" data-toggle="tooltip" data-placement="top"
                                            title='Press "Enter" to search keyword'></span>

                                    </div>
                                </div>
                            </div>
                            <div class="bg-grey p-3 mx-3">
                                <div class="tab-content">
                                    <!--ALL CASE TAB-->
                                    <div class="tab-pane fade show active" id="" role="tabpanel"
                                        aria-labelledby="recent-case-tab">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12 col-sm-12 float-right">
                                                <nav class="nav nav-inner-tab">
                                                    <a class="nav-link txt-14 tab_foreign active " data-toggle="tab"
                                                        href="" data-id="with_cases">
                                                        Agencies with case involvement
                                                    </a>
                                                    <a class="nav-link txt-14 tab_foreign" data-toggle="tab" href=""
                                                        data-id="all_agency">
                                                        All Foreign Recruitment Agencies
                                                    </a>
                                                </nav>
                                            </div>
                                        </div>
                                        <div class="mt-2 ">
                                            <div class="list-container_foreign">
                                                <div class="row-header">
                                                    <div class="row victim-list-header row-header-border bg-white m-0">
                                                        <div
                                                            class="col-lg-8 col-md-8 col-sm-8  col-header pl-3  bg-white">
                                                            Recruitment Details</div>
                                                        <div
                                                            class=" col-lg-2 col-md-2 col-sm-2  d-flex align-items-center justify-content-center col-header bg-white">
                                                            Case Involvement</div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2  col-header bg-white">
                                                            Action</div>
                                                    </div>
                                                </div>

                                                <!-------------Loading Empty Placeholder for list  ------------>
                                                <ul class="nav agency-list_content filter_load_placeholder"> </ul>
                                                <!-------------------------------------------------------------->
                                                <ul class="nav agency-list_content list-foreign_recruitment"></ul>

                                                <div
                                                    class="pagination-wrapper pt-3 rs-list-foreign_recruitment  bg-white px-3">
                                                    <div class="row">
                                                        <div class="col col-lg-4 col-md-12 col-sm-12">
                                                            <p class="pagination-details rs-info-foreign_recruitment">
                                                            </p>
                                                        </div>
                                                        <div class="col col-lg-8 col-md-12 col-sm-12 text-right">
                                                            <ul class="pagination rs-pagination-foreign_recruitment">
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="empty-search"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="tab-pane fade  " id="employer_tab" role="tabpanel"
                            aria-labelledby="recent-case-tab">

                            <div class="row px-3 mx-1 mt-3">
                                <div class="col-lg-6 col-sm-12 col-md-12">
                                    <div class="card-header card-sub-title bg-white p-0 m-0">
                                        Employer List<br>
                                        <small class="card-desc"> List of all employers.</small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-md-12 ">
                                    <div class=" list-action  list-action-filter">
                                        <input class="txt_search" id="txt_search-employer" type="search"
                                            placeholder="keyword..." aria-label="Search">
                                        <select class="select select-filter sel-emp-orderby">
                                            <option value="0" disabled selected="">Order by</option>
                                            <option value="0">All</option>
                                            <option value="1">Employer (ASC)</option>
                                            <option value="2">Employer (DESC)</option>
                                            <option value="3">Case Count (ASC)</option>
                                            <option value="4">Case Count (DESC) </option>
                                        </select>
                                        <span class="hidden_tooltip_all" data-toggle="tooltip" data-placement="top"
                                            title='Press "Enter" to search keyword'></span>

                                    </div>
                                </div>
                            </div>
                            <div class="bg-grey p-3 mx-3">
                                <div class="tab-content">
                                    <!--ALL CASE TAB-->
                                    <div class="tab-pane fade show active" id="" role="tabpanel"
                                        aria-labelledby="recent-case-tab">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12 col-sm-12 float-right">
                                                <nav class="nav nav-inner-tab">
                                                    <a class="nav-link txt-14 tab_employer active " data-toggle="tab"
                                                        href="" data-id="with_cases">
                                                        Employer with case involvement
                                                    </a>
                                                    <a class="nav-link txt-14 tab_employer" data-toggle="tab" href=""
                                                        data-id="all_agency">
                                                        All Employer
                                                    </a>
                                                </nav>
                                            </div>
                                        </div>
                                        <div class="mt-2 ">
                                            <div class="list-container_employer">
                                                <div class="row-header">
                                                    <div class="row victim-list-header row-header-border bg-white m-0">
                                                        <div
                                                            class="col-lg-8 col-md-8 col-sm-8  col-header pl-3  bg-white">
                                                            Employer Details</div>
                                                        <div
                                                            class=" col-lg-2 col-md-2 col-sm-2  d-flex align-items-center justify-content-center col-header">
                                                            Case Involvement</div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2  col-header bg-white">
                                                            Action</div>
                                                    </div>
                                                </div>

                                                <!-------------Loading Empty Placeholder for list  ------------>
                                                <ul class="nav agency-list_content filter_load_placeholder"> </ul>

                                                <!-------------------------------------------------------------->
                                                <ul class="nav agency-list_content list-employer"></ul>
                                                <div class="pagination-wrapper pt-3 rs-list-employer  bg-white px-3">
                                                    <div class="row">
                                                        <div class="col col-lg-4 col-md-12 col-sm-12">
                                                            <p class="pagination-details rs-info-employer"></p>
                                                        </div>
                                                        <div class="col col-lg-8 col-md-12 col-sm-12 text-right">
                                                            <ul class="pagination rs-pagination-employer">
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="empty-search"></div>
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
<!-- BEGIN PAGE CONTENT BODY -->


<!--modal parts-->

<div class="modal fade bd-example-modal-lg" id="modal-update-recruitment-details" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Manage Recruitment Details</h5>
            </div>
            <div class="modal-body">

                <form id="agency-details" onsubmit="return false;">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="lbl">Recruitment Agency Name</label>
                                    <input type="text" maxlength="50" id="txt-agency-name" name="txtAgencyName"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="lbl">Country </label>
                                    <select id="sel-agency-country" name="selAgencyCountry" class="form-control">
                                        <option>Select</option>
                                    </select>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="lbl">City/State </label>
                                    <select id="sel-agency-state" name="selAgencyState" class="form-control">
                                        <option>Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="lbl">Recruitment Agency Email </label>
                                    <input type="email" maxlength="50" id="txt-agency-email" name="txtAgencyEmail"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="lbl">Recruitment Agency Website </label>
                                    <input type="text" maxlength="50" id="txt-agency-website" name="txtAgencyWebsite"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="lbl">Contact Number</label>
                                    <input type="text" maxlength="11" minlength="7" id="txt-agency-telephone"
                                        name="txtAgencyTelephone" class="form-control">
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="lbl">Fax Number </label>
                                    <input type="text" maxlength="50" id="txt-agency-fax" name="txtAgencyFax"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="lbl">Recruitment Agency Detailed Address </label>
                                    <input type="text" maxlength="50" id="txt-agency-address" name="txtAgencyAddress"
                                        class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="lbl">Agency Owner</label>
                                    <input type="text" maxlength="50" id="txt-agency-owner" name="txtAgencyOwner"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="lbl">Owner's Email</label>
                                    <input type="text" maxlength="50" id="txt-agency-owner-email"
                                        name="txtAgencyOwnerEmail" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="lbl">Owner's Contact Number</label>
                                    <input type="text" maxlength="11" minlength="7" id="txt-agency-owner-contact"
                                        name="txtAgencyOwnerContact" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="lbl">Owner's Detailed Address</label>
                                    <input type="text" maxlength="200" id="txt-agency-owner-address"
                                        name="txtAgencyOwnerAddress" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="lbl">Agency Type </label>
                                    <select id="sel-agency-type" name="selAgencyType" class="form-control">
                                        <option value="" selected disabled>Select</option>
                                        <option value="0">Foreign Recruitment Agency</option>
                                        <option value="1">Local Recruitment Agency</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-secondary-light_blue btn-save-details">Update</button>
            </div>
        </div>
    </div>
</div>


<!--modal for employer-->

<div class="modal fade" id="modal-update-employer-details" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Manage Employer Details</h5>
            </div>
            <div class="modal-body">
                <form id="frm-emp-details" onsubmit="return false;">

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label class="lbl">Employer Name</label>
                            <input type="text" maxlength="50" id="txt-emp-name" name="txtEmpName" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label class="lbl">Representative</label>
                            <input type="text" maxlength="50" id="txt-emp-rep" name="txtEmpRep" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label class="lbl">Contact Number</label>
                            <input type="text" maxlength="11" minlength="11" id="txt-emp-contact" name="txtEmpContact"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label class="lbl">Email Address</label>
                            <input type="text" maxlength="50" id="txt-emp-email" name="txtEmpEmail"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label class="lbl">Employer Country </label>
                            <select id="sel-emp-country" name="selEmpCountry" class="form-control">
                                <option>Select</option>
                            </select>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label class="lbl">City</label>
                            <input type="text" maxlength="50" id="txt-emp-city" name="txtEmpCity" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label class="lbl">Detailed Address</label>
                            <input type="text" maxlength="100" id="txt-emp-address" name="txtEmpAddress"
                                class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-save btn-save-emp-details">Save Changes</button>
            </div>
        </div>
    </div>
</div>