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
            <div class="card" style=""> 
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
                                        <div class="container  p-2" >
                                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                                <div class="panel panel-default">
                                                    <div class="collapse collapseList" id="collapseExample">
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
                                                                                <th>Status</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="vlist-table">
                                                                            <tr>
                                                                                <td>Kim Arvin Antonio Toledo</td>
                                                                                <td>
                                                                                    <div class="custom-control custom-switch active">
                                                                                        <input type="checkbox" class="custom-control-input " id="customSwitch1" checked>
                                                                                        <label class="custom-control-label active" for="customSwitch1"></label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Mark Lester Abubakar Trangia</td>
                                                                                <td>
                                                                                    <div class="custom-control custom-switch">
                                                                                        <input type="checkbox" class="custom-control-input" id="customSwitch2" checked>
                                                                                        <label class="custom-control-label active" for="customSwitch2"></label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Kimberly Visperas Bado</td>
                                                                                <td>
                                                                                    <div class="custom-control custom-switch">
                                                                                        <input type="checkbox" class="custom-control-input" id="customSwitch3" checked>
                                                                                        <label class="custom-control-label active" for="customSwitch3"></label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Victim List-->

                                        <!--End Victim List-->

                                        <div class="stage_1 stage-bg">
                                            <div class="m-2 p-3">
                                                <div class="rowform-row">
                                                    <div class="mb-3 bg-white p-3">
                                                        <div class="form-group ">
                                                            <label for="inputState" class="blue  txt-W-500 pb-2">Docketing and Assignment of Cases</label>

                                                        </div>
                                                        <div class="px-5">
                                                            <div class="row">
                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                    <label>Date  </label>
                                                                    <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                    <label>Docket Number </label>
                                                                    <input type="text" class="form-control case-date_complained ">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                    <label>Name of Overseas Employment Adjudicator </label>
                                                                    <input type="text" class="form-control case-date_complained ">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- Consolation Stage--->
                                        <div class="stage_2 stage-bg">
                                            <div class="m-2 py-3">
                                                <div class="rowform-row">
                                                    <div class="col-12">

                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-12 card-sub-title blue  txt-W-500">Show Cause Order / Summons</div>
                                                            </div>
                                                            <div class="px-5">
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Issued By </label>
                                                                        <input type="text" class="form-control case-date_complained ">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Date of Issuance </label>
                                                                        <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Date of Service </label>
                                                                        <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Date Received </label>
                                                                        <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-12 card-sub-title blue  txt-W-500">Filing of Answer</div>
                                                            </div>
                                                            <div class="px-5">
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Date </label>
                                                                        <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-12 card-sub-title blue  txt-W-500">Filing of Reply</div>
                                                            </div>
                                                            <div class="px-5">
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Date </label>
                                                                        <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-12 card-sub-title blue  txt-W-500">Motion for extension to file a verified answer</div>
                                                            </div>
                                                            <div class="px-5">
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Date </label>
                                                                        <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Venue </label>
                                                                        <input type="text" class="form-control case-date_complained">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group ">
                                                                    <label for="inputState">Status</label>
                                                                    <select class="form-control sel-traffic_purpose v-traffic_purpose valid" aria-invalid="false">
                                                                        <option value="0" selected="">Select Status</option>
                                                                        <option value="1">No Motion Filed</option>
                                                                        <option value="2"> Motion has been Filed</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label >Reasons for Extension</label>
                                                                    <textarea class="form-control case-evaluation textarea-wrap" style="height: 150px !important;" id="exampleFormControlTextarea1" ></textarea>
                                                                </div>
                                                            </div>

                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <br>            

                                        <div class="stage_3 stage-bg">
                                            <div class="m-2 py-3">
                                                <div class="rowform-row">
                                                    <div class="col-12">

                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-12 card-sub-title blue  txt-W-500">Issuance of Order of preventive suspension</div>
                                                            </div>
                                                            <div class="px-5">
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Date of  Issuance</label>
                                                                        <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Duration </label>
                                                                        <input type="text" class="form-control case-date_complained ">
                                                                    </div>
                                                                </div>
                                                                <div class="row">

                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <label for="inputState">Attachment</label>
                                                                        <div class="card" >
                                                                            <div class="row" >
                                                                                <div class="form-group col-lg-12  div-image shadow-sm" >
                                                                                    <div class="card-body text-center"  id="fileupload_div">
                                                                                        <i class="fas fa-upload text-gray-500"></i><br>
                                                                                        <span class="small text-gray-500 mgn-T-18">Choose file to upload.</span>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 px-0">
                                                                                    <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control-file badge-light" id="imageselect">
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

                                        <div class="stage_4 stage-bg">
                                            <div class="m-2 py-3">
                                                <div class="rowform-row">
                                                    <div class="col-12">

                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-12 card-sub-title blue  txt-W-500">Preliminary Hearing</div>
                                                            </div>
                                                            <div class="px-5">
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Date of  Issuance</label>
                                                                        <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Division / Venue </label>
                                                                        <input type="text" class="form-control case-date_complained ">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-12 card-sub-title blue  txt-W-500">Hearing for clarificatory Questions</div>
                                                            </div>
                                                            <div class="px-5">
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Date of Hearing </label>
                                                                        <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-12 card-sub-title blue  txt-W-500">Order to appear/to produce documents</div>
                                                            </div>
                                                            <div class="px-5">
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Date of Order </label>
                                                                        <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Date of Service </label>
                                                                        <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY">
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-12 card-sub-title blue  txt-W-500">Summary Judgment</div>
                                                            </div>
                                                            <div class="px-5">
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Date </label>
                                                                        <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Decision </label>
                                                                        <input type="text" class="form-control case-date_complained ">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Penalty </label>
                                                                        <input type="text" class="form-control case-date_complained ">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Fine </label>
                                                                        <input type="text" class="form-control case-date_complained ">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="stage_5 stage-bg">
                                            <div class="m-2 py-3">
                                                <div class="rowform-row">
                                                    <div class="col-12">

                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-12 card-sub-title blue  txt-W-500">Submission for Resolution</div>
                                                            </div>
                                                            <div class="px-5">
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Date </label>
                                                                        <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY">
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Attachments</label>
                                                                        <div class="card" >
                                                                            <div class="row" >
                                                                                <div class="form-group col-lg-12  div-image shadow-sm" >
                                                                                    <div class="card-body text-center"  id="fileupload_div">
                                                                                        <i class="fas fa-upload text-gray-500"></i><br>
                                                                                        <span class="small text-gray-500 mgn-T-18">Choose file to upload.</span>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 px-0">
                                                                                    <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control-file badge-light" id="imageselect">
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

                                        <div class="stage_6 stage-bg">
                                            <div class="m-2 py-3">
                                                <div class="rowform-row">
                                                    <div class="col-12">

                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-12 card-sub-title blue  txt-W-500">Resolution of the Case</div>
                                                            </div>
                                                            <div class="px-5">
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Date </label>
                                                                        <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY">

                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Decision </label>
                                                                        <input type="text" class="form-control case-date_complained ">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Penalty </label>
                                                                        <input type="text" class="form-control case-date_complained ">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Fine </label>
                                                                        <input type="text" class="form-control case-date_complained ">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Attachments</label>
                                                                        <div class="card" >
                                                                            <div class="row" >
                                                                                <div class="form-group col-lg-12  div-image shadow-sm" >
                                                                                    <div class="card-body text-center"  id="fileupload_div">
                                                                                        <i class="fas fa-upload text-gray-500"></i><br>
                                                                                        <span class="small text-gray-500 mgn-T-18">Choose file to upload.</span>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 px-0">
                                                                                    <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control-file badge-light" id="imageselect">
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

                                        <div class="stage_7 stage-bg">
                                            <div class="m-2 py-3">
                                                <div class="rowform-row">
                                                    <div class="col-12">
                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-12 card-sub-title blue  txt-W-500">Appeal to the DOLE Secretary</div>
                                                            </div>
                                                            <div class="px-5">
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Division / Venue </label>
                                                                        <input type="text" class="form-control case-date_complained ">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Date of Filing</label>
                                                                        <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-12 card-sub-title blue  txt-W-500">Entry of Judgment</div>
                                                            </div>
                                                            <div class="px-5">
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Date of Entry </label>
                                                                        <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-12 card-sub-title blue  txt-W-500">Resolution of Appeal</div>
                                                            </div>
                                                            <div class="px-5">
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Date of Resolution </label>
                                                                        <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY">

                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Decision </label>
                                                                        <input type="text" class="form-control case-date_complained ">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Penalty </label>
                                                                        <input type="text" class="form-control case-date_complained ">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Fine </label>
                                                                        <input type="text" class="form-control case-date_complained ">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Attachements</label>
                                                                        <div class="card" >
                                                                            <div class="row" >
                                                                                <div class="form-group col-lg-12  div-image shadow-sm" >
                                                                                    <div class="card-body text-center"  id="fileupload_div">
                                                                                        <i class="fas fa-upload text-gray-500"></i><br>
                                                                                        <span class="small text-gray-500 mgn-T-18">Choose file to upload.</span>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 px-0">
                                                                                    <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control-file badge-light" id="imageselect">
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



                                        <div class="stage_8 stage-bg active show">
                                            <div class="m-2 py-3">
                                                <div class="rowform-row">
                                                    <div class="col-12">

                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-12 card-sub-title blue  txt-W-500">Writ of Execution</div>
                                                            </div>
                                                            <div class="px-5">
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Date of Issuance of Writ </label>
                                                                        <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Date of Service </label>
                                                                        <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Date of Execution </label>
                                                                        <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY">
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="card" >
                                                                            <div class="row" >
                                                                                <div class="form-group col-lg-12  div-image shadow-sm" >
                                                                                    <div class="card-body text-center"  id="fileupload_div">
                                                                                        <i class="fas fa-upload text-gray-500"></i><br>
                                                                                        <span class="small text-gray-500 mgn-T-18">Choose file to upload.</span>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 px-0">
                                                                                    <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control-file badge-light" id="imageselect">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-close btn-cancel float-right" data-dismiss="modal"> Close </button> 
                    <button type="button" class="btn btn-secondary-light_blue">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!--</div>-->



