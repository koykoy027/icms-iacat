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
        <div class="mt-content-body">
            <div class="row container-padding">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">

                        <div class="page-body-container mx-3">

                            <div class="pb-2" id="div-temporary_case" data-id="<?= $id ?>">

                                <div class="row">
                                    <div class="col-lg-12 ">
                                        <div class="padding-l-15">


                                            <div class="d-flex justify-content-between">
                                                <div class="card-title d-flex">
                                                    <p class="m-auto"> Temporary Case Number:
                                                        <span id="s-temporary_case_number">-</span>
                                                    </p>
                                                </div>
                                                <div class="div">
                                                    <p class="text-right mb-0">Date Created:
                                                        <span class="blue" id="s-date_created">-</span>
                                                    </p>
                                                    <p class="text-right mb-1">Status:
                                                        <span class="badge badge-success" id="s-status"></span>
                                                        <a href="#" id="a-case_number">
                                                            <span class="badge badge-success" id="s-case_number"></span>
                                                        </a>
                                                        <i class="fa fa-edit blue" aria-hidden="true"
                                                            data-toggle="modal" data-target="#modal-manage_status"></i>
                                                    </p>
                                                    <!-- <button type="submit" class=" float-right match-buttons btn btn-primary-orange btn-next ml-0">Update Status</button> -->
                                                </div>
                                            </div>


                                            <!-- ********** NEW ************* -->
                                            <div class="divider">
                                                <h2 class="text-divider">
                                                    <span class="card-sub-title blue">Complainant Details</span>
                                                </h2>
                                            </div>
                                            <!-- Complainant -->
                                            <form id="form-complainant">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="row">
                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                <label>First Name <font color="red"> <b>*</b> </font>
                                                                </label>
                                                                <input type="text" maxlength="50"
                                                                    class="form-control noSpcStart"
                                                                    name="temporary_complainant_firstname">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                <label>Mobile Number</label>
                                                                <font color="red"><b>*</b></font>
                                                                <input type="number"
                                                                    class="form-control noSpcStart numbersOnly"
                                                                    name="temporary_complainant_mobile_number">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                <label>Relationship to the victim </label>
                                                                <font color="red"><b>*</b></font>
                                                                <select class="form-control valid sel-relation"
                                                                    name="temporary_complainant_relation"
                                                                    aria-invalid="false">
                                                                    <option selected="" value="">Select Relationship
                                                                    </option>
                                                                    <option value="1">Family</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                <label>Address</label>
                                                                <font color="red"><b>*</b></font>
                                                                <input type="text" maxlength="50"
                                                                    class="form-control noSpcStart"
                                                                    name="temporary_complainant_address">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="row">
                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                <label>Middle Name </label>
                                                                <input type="text" maxlength="50"
                                                                    class="form-control noSpcStart"
                                                                    name="temporary_complainant_middlename">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                <label>Email Address</label>
                                                                <font color="red"><b>*</b></font>
                                                                <input type="email" class="form-control noSpcStart"
                                                                    name="temporary_complainant_email_address">
                                                            </div>
                                                        </div>
                                                        <div class="row" id="div-other-relationship">
                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                <label>Other relationship</label>
                                                                <input type="text" class="form-control noSpcStart"
                                                                    name="temporary_complainant_relation_other">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                <label>Preffered Contact Method </label>
                                                                <font color="red"><b>*</b></font>
                                                                <select class="form-control valid"
                                                                    name="temporary_complainant_preffered_contact_method"
                                                                    aria-invalid="false">
                                                                    <option selected="" value="2">Email Address</option>
                                                                    <option value="1">Mobile Number</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="row">
                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                <label>Last Name</label>
                                                                <font color="red"><b>*</b></font>
                                                                <input type="text" maxlength="50"
                                                                    class="form-control noSpcStart"
                                                                    name="temporary_complainant_lastname">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                <label>Complain</label>
                                                                <font color="red"><b>*</b></font>
                                                                <textarea class="form-control" maxlength="10000"
                                                                    name="temporary_complainant_complain"
                                                                    rows="7"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div
                                                            class="content-footer d-flex justify-content-center match-buttons">
                                                            <button type="button"
                                                                class="btn btn-action btn-add_layover btn-cancel ml-0 mb-2 btn-cancel px-4 mr-1"
                                                                style="display: none;">Cancel</button>
                                                            <button type="button"
                                                                class="btn btn-primary-orange btn-next btn-edit ml-0 mb-2 btn-edit px-4">Edit</button>
                                                            <button type="submit"
                                                                class="btn btn-primary-orange btn-next btn-submit ml-0 mb-2 btn-submit px-4"
                                                                style="display: none;">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                            <div class="divider">
                                                <h2 class="text-divider">
                                                    <span class="card-sub-title blue">Victim Details</span>
                                                </h2>
                                            </div>
                                            <!-- Victim -->
                                            <form id="form-victim">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="row">
                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                <label>First Name <font color="red"> <b>*</b> </font>
                                                                </label>
                                                                <input type="text" maxlength="50"
                                                                    class="form-control noSpcStart"
                                                                    name="temporary_victim_firstname">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                <label>Suffix </label>
                                                                <input type="text" maxlength="50"
                                                                    class="form-control noSpcStart"
                                                                    name="temporary_victim_suffix">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                <label>Mobile Number</label>
                                                                <font color="red"><b>*</b></font>
                                                                <input type="number"
                                                                    class="form-control noSpcStart numbersOnly"
                                                                    name="temporary_victim_mobile_number">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                <label>Civil Status</label>
                                                                <font color="red"><b>*</b></font>
                                                                <select class="form-control valid sel-civil"
                                                                    name="temporary_victim_civil_status"
                                                                    aria-invalid="false">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="row">
                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                <label>Middle Name </label>
                                                                <input type="text" maxlength="50"
                                                                    class="form-control noSpcStart"
                                                                    name="temporary_victim_middlename">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                <label>Date of Birth</label>
                                                                <font color="red"><b>*</b></font>
                                                                <input type="text"
                                                                    class="form-control noSpcStart datepicker noSpcStart"
                                                                    name="temporary_victim_dob"
                                                                    placeholder="MM/DD/YYYY">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                <label>Sex</label>
                                                                <font color="red"><b>*</b></font>
                                                                <select class="form-control valid sel-sex"
                                                                    name="temporary_victim_sex" aria-invalid="false">
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                <label>Departure Type</label>
                                                                <font color="red"><b>*</b></font>
                                                                <select class="form-control valid" id="sel-departure"
                                                                    name="temporary_victim_departure_type"
                                                                    aria-invalid="false">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="row">
                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                <label>Last Name</label>
                                                                <font color="red"><b>*</b></font>
                                                                <input type="text" maxlength="50"
                                                                    class="form-control noSpcStart"
                                                                    name="temporary_victim_lastname">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                <label>Email Address</label>
                                                                <font color="red"><b>*</b></font>
                                                                <input type="email" class="form-control noSpcStart"
                                                                    name="temporary_victim_email_address">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                <label>Country of Deployment</label>
                                                                <font color="red"><b>*</b></font>
                                                                <select class="form-control valid sel-country"
                                                                    name="temporary_victim_country_deployment"
                                                                    aria-invalid="false">
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                <label>Address</label>
                                                                <font color="red"><b>*</b></font>
                                                                <input type="text" maxlength="50"
                                                                    class="form-control noSpcStart"
                                                                    name="temporary_victim_address">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div
                                                            class="content-footer d-flex justify-content-center match-buttons">
                                                            <button type="button"
                                                                class="btn btn-action btn-add_layover btn-cancel ml-0 mb-2 btn-cancel px-4 mr-1"
                                                                style="display: none;">Cancel</button>
                                                            <button type="button"
                                                                class="btn btn-primary-orange btn-next btn-edit ml-0 mb-2 btn-edit px-4">Edit</button>
                                                            <button type="submit"
                                                                class="btn btn-primary-orange btn-next btn-submit ml-0 mb-2 btn-submit px-4"
                                                                style="display: none;">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>


                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="divider">
                                                        <h2 class="text-divider">
                                                            <span class="card-sub-title blue">Complaint Updates</span>
                                                        </h2>
                                                    </div>

                                                    <div class="card card-remarks">
                                                        <div class="row d-flex justify-content-end match-buttons">
                                                            <button type="button"
                                                                class="btn btn-primary-orange btn-next ml-0 mb-2"
                                                                id="btn-add_remarks" data-toggle="modal"
                                                                data-target="#modal-add_remarks">
                                                                Add Remarks
                                                            </button>
                                                        </div>
                                                        <!--stepper goes here-->
                                                        <div class="history-tl-container">
                                                            <p id="ul-remarks-nodata" class="text-center mt-5"
                                                                style="display:none;">No data found</p>
                                                            <ul class="tl w-100" id="ul-remarks">
                                                                <!-- <li class="timeline-inverted" style="display: none;">
                                                                    <div class="timeline-badge warning"></div>
                                                                    <div class="card card-tabs Filing and Receipt of Complaints"
                                                                        style="background-color:#f5f6fa; "
                                                                        attr-class_name="stage_1" id="li-stage_1">
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div
                                                                                    class="col-12 card-sub-title_ blue ml-1 mb-0 px-0 pull-left">
                                                                                    <p class="text-right">August 8, 2021
                                                                                        10:30PM</p>
                                                                                    <p>Lorem ipsum dolor, sit amet
                                                                                        consectetur adipisicing elit.
                                                                                        Ipsam error dolore aspernatur
                                                                                        unde doloribus quam obcaecati,
                                                                                        quidem sit omnis cupiditate,
                                                                                        eveniet, sint quia quas iusto
                                                                                        rem amet minus molestias iste.
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li> -->
                                                            </ul>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="divider">
                                                        <h2 class="text-divider">
                                                            <span class="card-sub-title blue">Access Logs</span>
                                                        </h2>
                                                    </div>

                                                    <div class="card card-remarks">
                                                        <div class="card card-tabs mb-2" style="background-color:#fff;" id="ul-logs-nodata">
                                                            <div class="card-body">
                                                                <p class="text-center">No Data Found </p>
                                                            </div>
                                                        </div>
                                                        <div class="history-tl-container" id="ul-logs">
                                                            <div class="card card-tabs mb-2"
                                                                style="background-color:#fff; display:none;"
                                                                attr-class_name="stage_1" id="li-stage_1">
                                                                <div class="card-body">
                                                                    <div class="row ">
                                                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                                            <p class="blue">
                                                                                August 8,
                                                                                2021 10:30PM
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-lg-8 col-md-6 col-sm-12">
                                                                            <p> - attempt tosadsd </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- ********** NEW ************* -->


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

<!-- Start Modals -->
<div class="modal fade" id="modal-add_remarks" role="dialog" data-backdrop="static">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header mt-0 mb-0">
                <h5 class="modal-title  msgmodal-header modal-header_title">Remarks</h5>
            </div>
            <div class="modal-body msgmodal-body mt-0 mb-0">
                <form id="form-remarks" onsubmit="return false">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row field-education_grade_year">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label>Remarks <font color="red"> <b>*</b></font> </label>
                                <textarea class="form-control" maxlength="10000" name="temporary_case_remarks"
                                    rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="content-footer float-right  match-buttons">
                        <button type="button" class="btn btn-cancel btn-modal-cancel"
                            data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary-orange btn-next ml-0">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-manage_status" role="dialog" data-backdrop="static">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header mt-0 mb-0">
                <h5 class="modal-title  msgmodal-header modal-header_title">Update Status</h5>
            </div>
            <div class="modal-body msgmodal-body mt-0 mb-0">
                <form id="form-status" onsubmit="return false">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row field-education_grade_year">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label>Status <font color="red"> <b>*</b></font> </label>
                                <select class="form-control valid" name="temporary_case_status_id"
                                    id="sel-temporary_case_status_id" aria-invalid="false">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="content-footer float-right  match-buttons">
                        <button type="button" class="btn btn-cancel btn-modal-cancel"
                            data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary-orange btn-next ml-0">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- End Modal -->