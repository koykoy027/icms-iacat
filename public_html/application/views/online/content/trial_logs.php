

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
                                    <div class="col-lg-4 col-md-12 col-sm-12 pl-0" style=" border-right: 1px solid #eee;">
                                        <!--stepper goes here-->
                                        <div class="history-tl-container">
                                            <ul class="tl" id="ul-stages">

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-12 col-sm-12 col-tab-content">
                                        <div class="container  p-2" >
                                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                                <div class="panel panel-default">
                                                    <p>
                                                        <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                            Click to see Victim 
                                                        </button>
                                                    </p>
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
                                                                                <th>Slip Number</th>
                                                                                <th>Status</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="vlist-table">
                                                                            <tr>
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

                                        <!--stage 1-->
                                        <div class="stage_1"  style="background: #f8f9fa;">
                                            <div class="m-2 py-3">
                                                <div class="rowform-row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue  txt-W-500">Filing of Complaint</div>
                                                            </div>

                                                            <div class="px-5">
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label > Prosecutor's Office</label>
                                                                        <input type="text" class="form-control case-date_complained " >
                                                                    </div>
                                                                </div>  
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label > Place</label>
                                                                        <input type="text" class="form-control case-date_complained " >
                                                                    </div>
                                                                </div> 
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label >Name of Investigating Prosecutor </label>
                                                                        <input type="text" class="form-control case-date_complained " >
                                                                    </div>
                                                                </div>  
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label >NPS Number (Docket Number)</label>
                                                                        <input type="text" class="form-control case-date_complained "  >
                                                                    </div>
                                                                </div> 
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="row">
                                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                <label >Case Title</label>
                                                                                <input type="text" class="form-control case-date_complained "  >
                                                                            </div>
                                                                        </div>  
                                                                        <div class="row">
                                                                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                                <label>Date Filed </label>
                                                                                <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY" >
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
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content-footer float-right  match-buttons mt-4">
                                                <button type="submit" class="btn btn-secondary-light_blue btn-next " data-tab="employment" style="margin-left:0px;">Update</button>
                                            </div>
                                        </div>
                                        <!--end stage 1-->

                                        <!--stage 2-->
                                        <div class="stage_2 " style="background: #f8f9fa;">
                                            <div class="m-2 py-3">
                                                <div class="rowform-row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">

                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="personal-info-sub_forms">
                                                                    <div class="card-sub-title txt-W-500"> OTHER VICTIM INFORMATION
                                                                        <hr class="card-sub-title_border"></div>


                                                                    <div class="row">
                                                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                                                            <div class="list-group sub-form-list" id="list-tab" role="tablist">
                                                                                <a class="list-group-item list-group-item-action active" id="list-contact_info" data-toggle="list" href="#tab_prelim" role="tab" aria-controls="home">Preliminary Investigation<span class="float-right hide"> <i class="fa fa-caret-right" aria-hidden="true"></i></span></a>
                                                                                <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#tab-inquest" role="tab" aria-controls="prelim">Inquest<span class="float-right hide"> <i class="fa fa-caret-right" aria-hidden="true"></i></span></a>
                                                                                <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#tab-rip" role="tab" aria-controls="profile">Resolution of the Investigation Prosecutor<span class="float-right hide"> <i class="fa fa-caret-right" aria-hidden="true"></i></span></a>
                                                                                <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#tab-mr" role="tab" aria-controls="messages">Motion for Reconsideration on the Resolution<span class="float-right hide"> <i class="fa fa-caret-right" aria-hidden="true"></i></span></a>
                                                                                <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#tab-rcpp" role="tab" aria-controls="settings">Review of the City or Provincial Prosecutor<span class="float-right hide"> <i class="fa fa-caret-right" aria-hidden="true"></i></span></a>
                                                                                <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#tab-psj" role="tab" aria-controls="soj">Petition for review to the Secretary of Justice<span class="float-right hide"> <i class="fa fa-caret-right" aria-hidden="true"></i></span></a>
                                                                                <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#tab-soj" role="tab" aria-controls="s">Motion for Reconsideration on the Resolution of the SOJ<span class="float-right hide"> <i class="fa fa-caret-right" aria-hidden="true"></i></span></a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                                                            <div class="tab-content tab-sub-info-content" id="nav-tabContent" style=" padding: 0px 20px;">

                                                                                <div class="tab-pane fade show active" id="tab_prelim" role="tabpanel" aria-labelledby="list-home-list">
                                                                                    <div class="inner-box matched_contents mt-2 mb-0">
                                                                                        <div class="ul-container">
                                                                                            <div class="row-header-border">
                                                                                                <div class="card">
                                                                                                    <div class="row">
                                                                                                        <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                                            <span>Accused Details</span>
                                                                                                        </div>
                                                                                                        <div class="col-lg-2 col-md-2 col-sm-2 ">
                                                                                                            <span>Action</span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="list-container-wrapper">
                                                                                                <ul class="nav list_content div-agencies-list" id="legal-services-list">
                                                                                                    <?php for ($i = 0; $i < 10; $i++) { ?>  
                                                                                                        <li style="width:100%" data-toggle="modal" data-target="#mdl_prelim_inv">
                                                                                                            <div class="card" style="font-family: source sans pro;border-bottom: 1px solid #dee2e6 !important;">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                                                        <div class="d-flex">
                                                                                                                            <div> 
                                                                                                                                <span class="label-bold"> Dale, Mari Katelyn</span><br>
                                                                                                                                <span class="icms-text-secondary">Created by: </span><span>National Bureau of Investigation (NBI)</span>     <br>                  
                                                                                                                                <span class="icms-text-secondary">Date created: </span><span>2019-07-10 01:56:36</span><br>
                                                                                                                                <span class="icms-text-secondary">Date Updated: </span><span>June 2, 201910:23am</span>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-lg-2 col-md-2 col-sm-2 ">
                                                                                                                        <button class="btn dropdown-toggle " type="button" id="dropdown_service" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </button>
                                                                                                                        <div class="dropdown-menu shadow action-menu" aria-labelledby="dropdown_service"> <a class="dropdown-item disabled action-title" href="#">Select Action</a>
                                                                                                                            <button class="dropdown-item" type="button" data-toggle="modal" data-target="#mdl_prelim_inv">Add new update</button>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </li>
                                                                                                    <?php }
                                                                                                    ?>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="tab-pane fade " id="tab-inquest" role="tabpanel" aria-labelledby="list-home-list">
                                                                                    <div class="inner-box matched_contents mt-2 mb-0">
                                                                                        <div class="ul-container">
                                                                                            <div class="row-header-border">
                                                                                                <div class="card">
                                                                                                    <div class="row">
                                                                                                        <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                                            <span>Accused Details</span>
                                                                                                        </div>
                                                                                                        <div class="col-lg-2 col-md-2 col-sm-2 ">
                                                                                                            <span>Action</span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="list-container-wrapper">
                                                                                                <ul class="nav list_content " >
                                                                                                    <?php for ($i = 0; $i < 10; $i++) { ?>  
                                                                                                        <li style="width:100%" data-toggle="modal" data-target="#mdl_inquest">
                                                                                                            <div class="card" style="font-family: source sans pro;border-bottom: 1px solid #dee2e6 !important;">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                                                        <div class="d-flex">
                                                                                                                            <div> 
                                                                                                                                <span class="label-bold"> Ayop, Annalyn</span><br>
                                                                                                                                <span class="icms-text-secondary">Date : </span><span>June 2, 2019 10:23am</span><br>
                                                                                                                                <span class="icms-text-secondary">Remarks : </span>
                                                                                                                                <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                                                                                                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</span><br>
                                                                                                                                <span class="icms-text-secondary">Date Updated: </span><span>June 2, 201910:23am</span>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>

                                                                                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                                                                                        <button class="btn dropdown-toggle " type="button" id="dropdown_service" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </button>
                                                                                                                        <div class="dropdown-menu shadow action-menu" aria-labelledby="dropdown_service"> <a class="dropdown-item disabled action-title" href="#">Select Action</a>
                                                                                                                            <button class="dropdown-item" type="button" data-toggle="modal" data-target="#mdl_inquest">Add new update</button>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </li> 
                                                                                                    <?php }
                                                                                                    ?>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="tab-pane fade" id="tab-rip" role="tabpanel" aria-labelledby="list-profile-list">
                                                                                    <div class="inner-box matched_contents mt-2 mb-0">
                                                                                        <div class="ul-container">
                                                                                            <div class="row-header-border">
                                                                                                <div class="card">
                                                                                                    <div class="row">
                                                                                                        <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                                            <span>Accused Details</span>
                                                                                                        </div>
                                                                                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                                                                                            <span>Action</span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="list-container-wrapper">
                                                                                                <ul class="nav list_content " >
                                                                                                    <?php for ($i = 0; $i < 10; $i++) { ?>  
                                                                                                        <li style="width:100%" data-toggle="modal" data-target="#mdl_resolution_inv">
                                                                                                            <div class="card" style="font-family: source sans pro;border-bottom: 1px solid #dee2e6 !important;">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                                                        <div> 
                                                                                                                            <span class="label-bold"> Ayop, Annalyn</span><br>
                                                                                                                            <span class="icms-text-secondary">Date : </span><span>June 2, 2019 10:23am</span><br>
                                                                                                                            <span class="icms-text-secondary">Remarks : </span>
                                                                                                                            <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                                                                                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</span><br>
                                                                                                                            <span class="icms-text-secondary">Date Updated: </span><span>June 2, 201910:23am</span>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                                                                                        <button class="btn dropdown-toggle " type="button" id="dropdown_service" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </button>
                                                                                                                        <div class="dropdown-menu shadow action-menu" aria-labelledby="dropdown_service"> <a class="dropdown-item disabled action-title" href="#">Select Action</a>
                                                                                                                            <button class="dropdown-item" type="button" data-toggle="modal" data-target="#mdl_resolution_inv">Add new update</button>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </li>
                                                                                                    <?php }
                                                                                                    ?>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="tab-pane fade" id="tab-mr" role="tabpanel" aria-labelledby="list-messages-list">
                                                                                    <div class="inner-box matched_contents mt-2 mb-0">
                                                                                        <div class="ul-container">
                                                                                            <div class="row-header-border">
                                                                                                <div class="card">
                                                                                                    <div class="row">
                                                                                                        <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                                            <span>Accused Details</span>
                                                                                                        </div>
                                                                                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                                                                                            <span>Action</span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="list-container-wrapper">
                                                                                                <ul class="nav list_content " >
                                                                                                    <?php for ($i = 0; $i < 10; $i++) { ?>  
                                                                                                        <li style="width:100%" data-toggle="modal" data-target="#mdl_motion_recon">
                                                                                                            <div class="card" style="font-family: source sans pro;border-bottom: 1px solid #dee2e6 !important;">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                                                        <div class="d-flex">
                                                                                                                            <div> 
                                                                                                                                <span class="label-bold"> Ayop, Annalyn</span><br>                         
                                                                                                                                <span class="icms-text-secondary">Created by: </span><span>National Bureau of Investigation (NBI)</span><br>                       
                                                                                                                                <span class="icms-text-secondary">Date created: </span><span>2019-07-10 01:56:36</span><br>
                                                                                                                                <span class="icms-text-secondary">Date Updated: </span><span>June 2, 201910:23am</span>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-sm-2 col-md-2 col-sm-2">
                                                                                                                        <button class="btn dropdown-toggle " type="button" id="dropdown_service" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </button>
                                                                                                                        <div class="dropdown-menu shadow action-menu" aria-labelledby="dropdown_service"> <a class="dropdown-item disabled action-title" href="#">Select Action</a>
                                                                                                                            <button class="dropdown-item" type="button" data-toggle="modal" data-target="#mdl_motion_recon">Add new update</button>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </li>
                                                                                                    <?php }
                                                                                                    ?>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>


                                                                                <div class="tab-pane fade" id="tab-rcpp" role="tabpanel" aria-labelledby="list-settings-list">
                                                                                    <div class="inner-box matched_contents mt-2 mb-0">
                                                                                        <div class="ul-container">
                                                                                            <div class="row-header-border">
                                                                                                <div class="card">
                                                                                                    <div class="row">
                                                                                                        <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                                            <span>Accused Details</span>
                                                                                                        </div>
                                                                                                        <div class="col-sm-2 col-md-2 col-sm-2">
                                                                                                            <span>Action</span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="list-container-wrapper">
                                                                                                <ul class="nav list_content " >
                                                                                                    <?php for ($i = 0; $i < 10; $i++) { ?>  
                                                                                                        <li style="width:100%" data-toggle="modal" data-target="#mdl_review_of_city">
                                                                                                            <div class="card" style="font-family: source sans pro;border-bottom: 1px solid #dee2e6 !important;">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                                                        <div class="d-flex">
                                                                                                                            <div> 
                                                                                                                                <span class="label-bold"> Ayop, Annalyn</span><br>                        
                                                                                                                                <span class="icms-text-secondary">Created by: </span><span>National Bureau of Investigation (NBI)</span> <br>                      
                                                                                                                                <span class="icms-text-secondary">Date created: </span><span>2019-07-10 01:56:36</span><br>
                                                                                                                                <span class="icms-text-secondary">Date Updated: </span><span>June 2, 201910:23am</span>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                                                                                        <button class="btn dropdown-toggle " type="button" id="dropdown_service" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </button>
                                                                                                                        <div class="dropdown-menu shadow action-menu" aria-labelledby="dropdown_service"> <a class="dropdown-item disabled action-title" href="#">Select Action</a>
                                                                                                                            <button class="dropdown-item" type="button" data-toggle="modal" data-target="#mdl_review_of_city">Add new update</button>
                                                                                                                        </div>
                                                                                                                    </div>

                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </li>
                                                                                                    <?php }
                                                                                                    ?>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="tab-pane fade" id="tab-psj" role="tabpanel" aria-labelledby="list-settings-list">
                                                                                    <div class="inner-box matched_contents mt-2 mb-0">
                                                                                        <div class="ul-container">
                                                                                            <div class="row-header-border">
                                                                                                <div class="card">
                                                                                                    <div class="row">
                                                                                                        <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                                            <span>Accused Details</span>
                                                                                                        </div>
                                                                                                        <div class="col-lg-2 col-md-2 col-sm-2 ">
                                                                                                            <span>Action</span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="list-container-wrapper">
                                                                                                <ul class="nav list_content " >
                                                                                                    <?php for ($i = 0; $i < 10; $i++) { ?>  
                                                                                                        <li style="width:100%" data-toggle="modal" data-target="#mdl_petition">
                                                                                                            <div class="card" style="font-family: source sans pro;border-bottom: 1px solid #dee2e6 !important;">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                                                        <div class="d-flex">
                                                                                                                            <div>
                                                                                                                                <span class="label-bold"> Ayop, Annalyn</span><br>                       
                                                                                                                                <span class="icms-text-secondary">Created by: </span><span>National Bureau of Investigation (NBI)</span>  <br>                     
                                                                                                                                <span class="icms-text-secondary">Date created: </span><span>2019-07-10 01:56:36</span><br>
                                                                                                                                <span class="icms-text-secondary">Date Updated: </span><span>June 2, 201910:23am</span>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-lg-2 col-md-2 col-sm-2  ">
                                                                                                                        <button class="btn dropdown-toggle " type="button" id="dropdown_service" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </button>
                                                                                                                        <div class="dropdown-menu shadow action-menu" aria-labelledby="dropdown_service"> <a class="dropdown-item disabled action-title" href="#">Select Action</a>
                                                                                                                            <button class="dropdown-item" type="button" data-toggle="modal" data-target="#mdl_petition">Add new update</button>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </li>
                                                                                                    <?php }
                                                                                                    ?>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="tab-pane fade" id="tab-soj" role="tabpanel" aria-labelledby="list-settings-list">

                                                                                    <div class="inner-box matched_contents mt-2 mb-0">
                                                                                        <div class="ul-container">
                                                                                            <div class="row-header-border">
                                                                                                <div class="card">
                                                                                                    <div class="row">
                                                                                                        <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                                            <span>Accused Details</span>
                                                                                                        </div>
                                                                                                        <div class="col-lg-2 col-md-2 col-sm-2 ">
                                                                                                            <span>Action</span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="list-container-wrapper">
                                                                                                <ul class="nav list_content " >
                                                                                                    <?php for ($i = 0; $i < 10; $i++) { ?>  
                                                                                                        <li style="width:100%" data-toggle="modal" data-target="#mdl_motion_recon_soj">
                                                                                                            <div class="card" style="font-family: source sans pro;border-bottom: 1px solid #dee2e6 !important;">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                                                        <div class="d-flex">
                                                                                                                            <div> 
                                                                                                                                <span class="label-bold"> Ayop, Annalyn</span><br>                        
                                                                                                                                <span class="icms-text-secondary">Created by: </span><span>National Bureau of Investigation (NBI)</span><br>                       
                                                                                                                                <span class="icms-text-secondary">Date created: </span><span>2019-07-10 01:56:36</span><br>
                                                                                                                                <span class="icms-text-secondary">Date Updated: </span><span>June 2, 201910:23am</span>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-lg-2 col-md-2 col-sm-2  ">
                                                                                                                        <button class="btn dropdown-toggle " type="button" id="dropdown_service" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </button>
                                                                                                                        <div class="dropdown-menu shadow action-menu" aria-labelledby="dropdown_service"> <a class="dropdown-item disabled action-title" href="#">Select Action</a>
                                                                                                                            <button class="dropdown-item" type="button" data-toggle="modal" data-target="#mdl_motion_recon_soj">Add new update</button>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </li>
                                                                                                    <?php }
                                                                                                    ?>
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
                                                        <div class="content-footer float-right  match-buttons mt-4">
                                                            <button type="submit" class="btn btn-secondary-light_blue btn-next " data-tab="employment" style="margin-left:0px;">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end stage 2-->

                                        <!--stage 3-->
                                        <div class="stage_3" style="background: #f8f9fa;">
                                            <div class="m-2 py-3">
                                                <div class="rowform-row">
                                                    <div class="col-12">
                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-12 card-sub-title blue  txt-W-500">Filing of Information in Court</div>
                                                            </div>
                                                            <div class="px-5">
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label > Criminal Case Number</label>
                                                                        <input type="text" class="form-control case-date_complained " >
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label > Criminal Case Title</label>
                                                                        <input type="text" class="form-control case-date_complained " >
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label > Prosecutor’s Name</label>
                                                                        <input type="text" class="form-control case-date_complained " >
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label > Presiding Judge</label>
                                                                        <input type="text" class="form-control case-date_complained " >
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label > Regional Trial Court Branch Number</label>
                                                                        <input type="text" class="form-control case-date_complained " >
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label > Place</label>
                                                                        <input type="text" class="form-control case-date_complained " >
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label > Accused</label>
                                                                        <input type="text" class="form-control case-date_complained " >
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label > Charges</label>
                                                                        <input type="text" class="form-control case-date_complained " >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content-footer float-right  match-buttons mt-4">
                                                <button type="submit" class="btn btn-secondary-light_blue btn-next " data-tab="employment" style="margin-left:0px;">Update</button>
                                            </div>
                                        </div>
                                        <!--end stage 3--> 

                                        <!--stage 4-->
                                        <div class="stage_4" style="background: #f8f9fa;">
                                            <div class="m-2 py-3">
                                                <div class="rowform-row">
                                                    <div class="col-12">

                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-12 card-sub-title blue  txt-W-500"> Dismissal or Issuance of Warrant or Arrest or Commitment Order  </div>
                                                            </div>
                                                            <div class="inner-box matched_contents mt-2 mb-0">
                                                                <div class="ul-container">
                                                                    <div class="row-header-border">
                                                                        <div class="card">
                                                                            <div class="row">
                                                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                    <span>Accused Details</span>
                                                                                </div>
                                                                                <div class="col-lg-2 col-md-2 col-sm-2 ">
                                                                                    <span>Action</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="list-container-wrapper">
                                                                        <ul class="nav list_content " >
                                                                            <?php for ($i = 0; $i < 5; $i++) { ?>  
                                                                                <li style="width:100%" data-toggle="modal" data-target="#mdl_dismissal">
                                                                                    <div class="card" style="font-family: source sans pro;border-bottom: 1px solid #dee2e6 !important;">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                                <div class="d-flex">
                                                                                                    <div> 
                                                                                                        <span class="label-bold"> Ayop, Annalyn</span><br>                         
                                                                                                        <span class="icms-text-secondary">Created by: </span><span>National Bureau of Investigation (NBI)</span> <br>                      
                                                                                                        <span class="icms-text-secondary">Date created: </span><span>2019-07-10 01:56:36</span><br>
                                                                                                        <span class="icms-text-secondary">Date Updated: </span><span>June 2, 201910:23am</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-2 col-md-2 col-sm-2  ">
                                                                                                <button class="btn dropdown-toggle " type="button" id="dropdown_service" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </button>
                                                                                                <div class="dropdown-menu shadow action-menu" aria-labelledby="dropdown_service"> <a class="dropdown-item disabled action-title" href="#">Select Action</a>
                                                                                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#mdl_dismissal">Add new update</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            <?php }
                                                                            ?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end stage 4-->

                                        <!--stage 5-->
                                        <div class="stage_5" style="background: #f8f9fa;">
                                            <div class="m-2 py-3">
                                                <div class="rowform-row">
                                                    <div class="col-12">
                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-12 card-sub-title blue  txt-W-500">Bail-Hearing and Resolution of Petition for Bail</div>
                                                            </div>
                                                            <div class="inner-box matched_contents mt-2 mb-0">
                                                                <div class="ul-container">
                                                                    <div class="row-header-border">
                                                                        <div class="card">
                                                                            <div class="row">
                                                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                    <span>Accused Details</span>
                                                                                </div>
                                                                                <div class="col-lg-2 col-md-2 col-sm-2 ">
                                                                                    <span>Action</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="list-container-wrapper">
                                                                        <ul class="nav list_content " >
                                                                            <?php for ($i = 0; $i < 10; $i++) { ?>  
                                                                                <li style="width:100%" data-toggle="modal" data-target="#mdl_bail">
                                                                                    <div class="card" style="font-family: source sans pro;border-bottom: 1px solid #dee2e6 !important;">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                                <div class="d-flex">
                                                                                                    <div> 
                                                                                                        <span class="label-bold">Toledo, Kim Arvin</span><br>                 
                                                                                                        <span class="icms-text-secondary">Created by: </span><span>National Bureau of Investigation (NBI)</span> <br>                      
                                                                                                        <span class="icms-text-secondary">Date created: </span><span>2019-07-10 01:56:36</span><br>
                                                                                                        <span class="icms-text-secondary">Date Updated: </span><span>June 2, 201910:23am</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-2 col-md-2 col-sm-2  ">
                                                                                                <button class="btn dropdown-toggle " type="button" id="dropdown_service" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </button>
                                                                                                <div class="dropdown-menu shadow action-menu" aria-labelledby="dropdown_service"> <a class="dropdown-item disabled action-title" href="#">Select Action</a>
                                                                                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#mdl_bail">Add new update</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            <?php }
                                                                            ?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content-footer float-right  match-buttons mt-4">
                                                <button type="submit" class="btn btn-secondary-light_blue btn-next " data-tab="employment" style="margin-left:0px;">Update</button>
                                            </div>
                                        </div>
                                        <!--end stage 5-->

                                        <!--stage 6-->
                                        <div class="stage_6"  style="background: #f8f9fa;">
                                            <div class="m-2 py-3">
                                                <div class="rowform-row">
                                                    <div class="col-12">
                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="agency_details">
                                                                <span class="icms-text-secondary">Criminal Case Number : </span><span class=""><b> CCN1900007</b></span>
                                                                <br>  <span class="icms-text-secondary"> Case Title : </span><span> Prosecution of Offenses </span>
                                                                <br>  <span class="icms-text-secondary">Prosecutor Name : </span><span> Mikael Narvas </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="rowform-row">
                                                    <div class="col-12">
                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-12 card-sub-title blue  txt-W-500">Arraignment and Pre-Trial Conference</div>
                                                            </div>
                                                            <div class="inner-box matched_contents mt-2 mb-0">
                                                                <div class="ul-container">
                                                                    <div class="row-header-border">
                                                                        <div class="card">
                                                                            <div class="row">
                                                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                    <span>Accused Details</span>
                                                                                </div>
                                                                                <div class="col-lg-2 col-md-2 col-sm-2 ">
                                                                                    <span>Action</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="list-container-wrapper">
                                                                        <ul class="nav list_content " >
                                                                            <?php for ($i = 0; $i < 10; $i++) { ?>  
                                                                                <li style="width:100%" data-toggle="modal" data-target="#mdl_pre_trial">
                                                                                    <div class="card" style="font-family: source sans pro;border-bottom: 1px solid #dee2e6 !important;">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                                <div class="d-flex">
                                                                                                    <div> 
                                                                                                        <span class="label-bold">Bado, Kimberly Visperas</span><br>                
                                                                                                        <span class="icms-text-secondary">Created by: </span><span>National Bureau of Investigation (NBI)</span>  <br>                     
                                                                                                        <span class="icms-text-secondary">Date created: </span><span>2019-07-10 01:56:36</span><br>
                                                                                                        <span class="icms-text-secondary">Date Updated: </span><span>June 2, 201910:23am</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-2 col-md-2 col-sm-2  ">
                                                                                                <button class="btn dropdown-toggle " type="button" id="dropdown_service" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </button>
                                                                                                <div class="dropdown-menu shadow action-menu" aria-labelledby="dropdown_service"> <a class="dropdown-item disabled action-title" href="#">Select Action</a>
                                                                                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#mdl_pre_trial">Add new update</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            <?php }
                                                                            ?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end stage 6-->

                                        <!--stage 7-->
                                        <div class="stage_7" style="background: #f8f9fa;">
                                            <div class="m-2 py-3">
                                                <div class="rowform-row">
                                                    <div class="col-12">
                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-12 card-sub-title blue  txt-W-500">Trial</div>
                                                            </div>
                                                            <div class="inner-box matched_contents mt-2 mb-0">
                                                                <div class="ul-container">
                                                                    <div class="row-header-border">
                                                                        <div class="card">
                                                                            <div class="row">
                                                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                    <span>Accused Details</span>
                                                                                </div>
                                                                                <div class="col-lg-2 col-md-2 col-sm-2 ">
                                                                                    <span>Action</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="list-container-wrapper">
                                                                        <ul class="nav list_content " >
                                                                            <?php for ($i = 0; $i < 10; $i++) { ?>  

                                                                                <li style="width:100%" data-toggle="modal" data-target="#mdl_trial">
                                                                                    <div class="card" style="font-family: source sans pro;border-bottom: 1px solid #dee2e6 !important;">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                                <div class="d-flex">
                                                                                                    <div> 
                                                                                                        <span class="label-bold">Trangia, Mark Lester</span>     <br>          
                                                                                                        <span class="icms-text-secondary">Created by: </span><span>National Bureau of Investigation (NBI)</span> <br>                      
                                                                                                        <span class="icms-text-secondary">Date created: </span><span>2019-07-10 01:56:36</span><br>
                                                                                                        <span class="icms-text-secondary">Date Updated: </span><span>June 2, 201910:23am</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-2 col-md-2 col-sm-2  ">
                                                                                                <button class="btn dropdown-toggle " type="button" id="dropdown_service" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </button>
                                                                                                <div class="dropdown-menu shadow action-menu" aria-labelledby="dropdown_service"> <a class="dropdown-item disabled action-title" href="#">Select Action</a>
                                                                                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#mdl_trial">Add new update</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            <?php }
                                                                            ?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content-footer float-right  match-buttons mt-4">
                                                <button type="submit" class="btn btn-secondary-light_blue btn-next " data-tab="employment" style="margin-left:0px;">Update</button>
                                            </div>
                                        </div>
                                        <!--end stage 7-->

                                        <!--stage 8-->
                                        <div class="stage_8" style="background: #f8f9fa;">
                                            <div class="m-2 py-3">
                                                <div class="mb-3 bg-white p-3">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <div class="agency_details">
                                                                <span class="icms-text-secondary">Criminal Case Number : </span><span class=""> <b>CCN1900007</b></span>
                                                                <br>  <span class="icms-text-secondary"> Case Title : </span><span> Prosecution of Offenses </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <div class="agency_details">
                                                                <span class="icms-text-secondary">Prosecutor's Name: </span><span class=""> Kim Arvin Toledo</span>
                                                                <br>  <span class="icms-text-secondary"> Presiding Judge : </span><span> Mark Lester Trangia </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="rowform-row">
                                                    <div class="col-12">
                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-12 card-sub-title blue  txt-W-500">Submission for Resolution</div>
                                                            </div>
                                                            <div class="inner-box matched_contents mt-2 mb-0">
                                                                <div class="ul-container">
                                                                    <div class="row-header-border">
                                                                        <div class="card">
                                                                            <div class="row">
                                                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                    <span>Accused Details</span>
                                                                                </div>
                                                                                <div class="col-lg-2 col-md-2 col-sm-2 ">
                                                                                    <span>Action</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="list-container-wrapper">
                                                                        <ul class="nav list_content " >
                                                                            <?php for ($i = 0; $i < 10; $i++) { ?>  

                                                                                <li style="width:100%" data-toggle="modal" data-target="#mdl_submit_resolution">
                                                                                    <div class="card" style="font-family: source sans pro;border-bottom: 1px solid #dee2e6 !important;">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                                <div class="d-flex">
                                                                                                    <div> 
                                                                                                        <span class="label-bold">Bado, Kimberly Visperas</span>     <br>          
                                                                                                        <span class="icms-text-secondary">Created by: </span><span>National Bureau of Investigation (NBI)</span> <br>                      
                                                                                                        <span class="icms-text-secondary">Date created: </span><span>2019-07-10 01:56:36</span><br>
                                                                                                        <span class="icms-text-secondary">Date Updated: </span><span>June 2, 201910:23am</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-2 col-md-2 col-sm-2  ">
                                                                                                <button class="btn dropdown-toggle " type="button" id="dropdown_service" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </button>
                                                                                                <div class="dropdown-menu shadow action-menu" aria-labelledby="dropdown_service"> <a class="dropdown-item disabled action-title" href="#">Select Action</a>
                                                                                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#mdl_submit_resolution">Add new update</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            <?php }
                                                                            ?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content-footer float-right  match-buttons mt-4">
                                                <button type="submit" class="btn btn-secondary-light_blue btn-next " data-tab="employment" style="margin-left:0px;">Update</button>
                                            </div>
                                        </div>
                                        <!--end stage 8-->

                                        <!--stage 9-->
                                        <div class="stage_9" style="background: #f8f9fa;">
                                            <div class="m-2 py-3">
                                                <div class="rowform-row">
                                                    <div class="col-12">
                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-12 card-sub-title blue  txt-W-500">Promulgation of Judgment</div>
                                                            </div>
                                                            <div class="inner-box matched_contents mt-2 mb-0">
                                                                <div class="ul-container">
                                                                    <div class="row-header-border">
                                                                        <div class="card">
                                                                            <div class="row">
                                                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                    <span>Accused Details</span>
                                                                                </div>
                                                                                <div class="col-lg-2 col-md-2 col-sm-2 ">
                                                                                    <span>Action</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="list-container-wrapper">
                                                                        <ul class="nav list_content " >
                                                                            <?php for ($i = 0; $i < 7; $i++) { ?>  
                                                                                <li style="width:100%" data-toggle="modal" data-target="#mdl_promulgation">
                                                                                    <div class="card" style="font-family: source sans pro;border-bottom: 1px solid #dee2e6 !important;">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                                <div class="d-flex">
                                                                                                    <div> 
                                                                                                        <span class="label-bold">Ayop, Annalyn</span> <br>                        
                                                                                                        <span class="icms-text-secondary">Created by: </span><span>National Bureau of Investigation (NBI)</span> <br>                      
                                                                                                        <span class="icms-text-secondary">Date created: </span><span>2019-07-10 01:56:36</span><br>
                                                                                                        <span class="icms-text-secondary">Date Updated: </span><span>June 2, 201910:23am</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-2 col-md-2 col-sm-2  ">
                                                                                                <button class="btn dropdown-toggle " type="button" id="dropdown_service" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </button>
                                                                                                <div class="dropdown-menu shadow action-menu" aria-labelledby="dropdown_service"> <a class="dropdown-item disabled action-title" href="#">Select Action</a>
                                                                                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#mdl_promulgation">Add new update</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            <?php }
                                                                            ?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content-footer float-right  match-buttons mt-4">
                                                <button type="submit" class="btn btn-secondary-light_blue btn-next " data-tab="employment" style="margin-left:0px;">Update</button>
                                            </div>
                                        </div>
                                        <!--end stage 9-->

                                        <!--stage 10-->
                                        <div class="stage_10" style="background: #f8f9fa;">
                                            <div class="m-2 py-3">
                                                <div class="rowform-row">
                                                    <div class="col-12">
                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-12 card-sub-title blue  txt-W-500">Motion for Reconsideration or New Trial </div>
                                                            </div>     
                                                            <div class="inner-box matched_contents mt-2 mb-0">
                                                                <div class="ul-container">
                                                                    <div class="row-header-border">
                                                                        <div class="card">
                                                                            <div class="row">
                                                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                    <span>Accused Details</span>
                                                                                </div>
                                                                                <div class="col-lg-2 col-md-2 col-sm-2 ">
                                                                                    <span>Action</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="list-container-wrapper">
                                                                        <ul class="nav list_content " >
                                                                            <?php for ($i = 0; $i < 10; $i++) { ?>  
                                                                                <li style="width:100%" data-toggle="modal" data-target="#mdl_motion_recon_new_trial">
                                                                                    <div class="card" style="font-family: source sans pro;border-bottom: 1px solid #dee2e6 !important;">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                                <div class="d-flex">
                                                                                                    <div> 
                                                                                                        <span class="label-bold">Toledo, Kim Arvin</span> <br>                        
                                                                                                        <span class="icms-text-secondary">Created by: </span><span>National Bureau of Investigation (NBI)</span> <br>                      
                                                                                                        <span class="icms-text-secondary">Date created: </span><span>2019-07-10 01:56:36</span><br>
                                                                                                        <span class="icms-text-secondary">Date Updated: </span><span>June 2, 201910:23am</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-2 col-md-2 col-sm-2  ">
                                                                                                <button class="btn dropdown-toggle " type="button" id="dropdown_service" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </button>
                                                                                                <div class="dropdown-menu shadow action-menu" aria-labelledby="dropdown_service"> <a class="dropdown-item disabled action-title" href="#">Select Action</a>
                                                                                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#mdl_motion_recon_new_trial">Add new update</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            <?php }
                                                                            ?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content-footer float-right  match-buttons mt-4">
                                                <button type="submit" class="btn btn-secondary-light_blue btn-next " data-tab="employment" style="margin-left:0px;">Update</button>
                                            </div>
                                        </div>
                                        <!--end stage 10-->

                                        <!--stage 11-->
                                        <div class="stage_11" style="background: #f8f9fa;">
                                            <div class="m-2 py-3">
                                                <div class="rowform-row">
                                                    <div class="col-12">
                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="agency_details">
                                                                <span class="icms-text-secondary">Criminal Case Number : </span><span class=""> <b>CCN1900007</b></span>
                                                                <br>  <span class="icms-text-secondary"> Case Title : </span><span> Prosecution of Offenses </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="rowform-row">
                                                        <div class="col-12">
                                                            <div class="mb-3 bg-white p-3">
                                                                <div class="row ">
                                                                    <div class="col-12 card-sub-title blue  txt-W-500">Appeal to Court of Appeals</div>
                                                                </div>
                                                                <div class="inner-box matched_contents mt-2 mb-0">
                                                                    <div class="ul-container">
                                                                        <div class="row-header-border">
                                                                            <div class="card">
                                                                                <div class="row">
                                                                                    <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                        <span>Accused Details</span>
                                                                                    </div>
                                                                                    <div class="col-lg-2 col-md-2 col-sm-2 ">
                                                                                        <span>Action</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="list-container-wrapper">
                                                                            <ul class="nav list_content " >
                                                                                <?php for ($i = 0; $i < 10; $i++) { ?>  
                                                                                    <li style="width:100%" data-toggle="modal" data-target="#mdl_appeal">
                                                                                        <div class="card" style="font-family: source sans pro;border-bottom: 1px solid #dee2e6 !important;">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                                    <div class="d-flex">
                                                                                                        <div> 
                                                                                                            <span class="label-bold">Ayop, Annalyn</span>   <br>                      
                                                                                                            <span class="icms-text-secondary">Created by: </span><span>National Bureau of Investigation (NBI)</span>  <br>                     
                                                                                                            <span class="icms-text-secondary">Date created: </span><span>2019-07-10 01:56:36</span><br>
                                                                                                            <span class="icms-text-secondary">Date Updated: </span><span>June 2, 201910:23am</span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-lg-2 col-md-2 col-sm-2  ">
                                                                                                    <button class="btn dropdown-toggle " type="button" id="dropdown_service" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </button>
                                                                                                    <div class="dropdown-menu shadow action-menu" aria-labelledby="dropdown_service"> <a class="dropdown-item disabled action-title" href="#">Select Action</a>
                                                                                                        <button class="dropdown-item" type="button" data-toggle="modal" data-target="#mdl_appeal">Add new update</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                                                <?php }
                                                                                ?>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="content-footer float-right  match-buttons mt-4">
                                                    <button type="submit" class="btn btn-secondary-light_blue btn-next " data-tab="employment" style="margin-left:0px;">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end stage 11-->

                                        <!--stage 12-->
                                        <div class="stage_12" style="background: #f8f9fa;">
                                            <div class="m-2 py-3">
                                                <div class="rowform-row">
                                                    <div class="col-12">
                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-12 card-sub-title blue  txt-W-500">Motion for Reconsideration on the decision of CA</div>
                                                            </div>
                                                            <div class="inner-box matched_contents mt-2 mb-0">
                                                                <div class="ul-container">
                                                                    <div class="row-header-border">
                                                                        <div class="card">
                                                                            <div class="row">
                                                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                    <span>Accused Details</span>
                                                                                </div>
                                                                                <div class="col-lg-2 col-md-2 col-sm-2 ">
                                                                                    <span>Action</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="list-container-wrapper">
                                                                        <ul class="nav list_content " >
                                                                            <?php for ($i = 0; $i < 10; $i++) { ?>  
                                                                                <li style="width:100%" data-toggle="modal" data-target="#mdl_motion_recon_ca">
                                                                                    <div class="card" style="font-family: source sans pro;border-bottom: 1px solid #dee2e6 !important;">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                                <div class="d-flex">
                                                                                                    <div> 
                                                                                                        <span class="label-bold">Trangia, Mark</span><br>                      
                                                                                                        <span class="">Created by: </span><span>National Bureau of Investigation (NBI)</span>   <br>                    
                                                                                                        <span>Date created: </span><span>2019-07-10 01:56:36</span><br>
                                                                                                        <span class="icms-text-secondary">Date Updated: </span><span>June 2, 201910:23am</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-2 col-md-2 col-sm-2  ">
                                                                                                <button class="btn dropdown-toggle " type="button" id="dropdown_service" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </button>
                                                                                                <div class="dropdown-menu shadow action-menu" aria-labelledby="dropdown_service"> <a class="dropdown-item disabled action-title" href="#">Select Action</a>
                                                                                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#mdl_motion_recon_ca">Add new update</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            <?php }
                                                                            ?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content-footer float-right  match-buttons mt-4">
                                                <button type="submit" class="btn btn-secondary-light_blue btn-next " data-tab="employment" style="margin-left:0px;">Update</button>
                                            </div>
                                        </div>
                                        <!--end stage 12-->

                                        <!--stage 13-->
                                        <div class="stage_13" style="background: #f8f9fa;">
                                            <div class="m-2 py-3">
                                                <div class="rowform-row">
                                                    <div class="col-12">
                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-12 card-sub-title blue  txt-W-500">Decision of CA</div>
                                                            </div>
                                                            <div class="inner-box matched_contents mt-2 mb-0">
                                                                <div class="ul-container">
                                                                    <div class="row-header-border">
                                                                        <div class="card">
                                                                            <div class="row">
                                                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                    <span>Accused Details</span>
                                                                                </div>
                                                                                <div class="col-lg-2 col-md-2 col-sm-2 ">
                                                                                    <span>Action</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="list-container-wrapper">
                                                                        <ul class="nav list_content " >
                                                                            <?php for ($i = 0; $i < 10; $i++) { ?>  
                                                                                <li style="width:100%" data-toggle="modal" data-target="#mdl_decision_ca">
                                                                                    <div class="card" style="font-family: source sans pro;border-bottom: 1px solid #dee2e6 !important;">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                                <div class="d-flex">
                                                                                                    <div> 
                                                                                                        <span class="label-bold">Navarro, Ian</span><br>                         
                                                                                                        <span class="icms-text-secondary">Created by: </span><span>National Bureau of Investigation (NBI)</span> <br>                      
                                                                                                        <span class="icms-text-secondary">Date created: </span><span>2019-07-10 01:56:36</span><br>
                                                                                                        <span class="icms-text-secondary">Date Updated: </span><span>June 2, 201910:23am</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-2 col-md-2 col-sm-2  ">
                                                                                                <button class="btn dropdown-toggle " type="button" id="dropdown_service" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </button>
                                                                                                <div class="dropdown-menu shadow action-menu" aria-labelledby="dropdown_service"> <a class="dropdown-item disabled action-title" href="#">Select Action</a>
                                                                                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#mdl_decision_ca">Add new update</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            <?php }
                                                                            ?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content-footer float-right  match-buttons mt-4">
                                                <button type="submit" class="btn btn-secondary-light_blue btn-next " data-tab="employment" style="margin-left:0px;">Update</button>
                                            </div>
                                        </div>
                                        <!--end stage 13-->

                                        <!--stage 14-->
                                        <div class="stage_14"  style="background: #f8f9fa;">
                                            <div class="m-2 py-3">
                                                <div class="rowform-row">
                                                    <div class="col-12">
                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-12 card-sub-title blue  txt-W-500">Appeal to the Supreme Court</div>
                                                            </div>
                                                            <div class="inner-box matched_contents mt-2 mb-0">
                                                                <div class="ul-container">
                                                                    <div class="row-header-border">
                                                                        <div class="card">
                                                                            <div class="row">
                                                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                    <span>Accused Details</span>
                                                                                </div>
                                                                                <div class="col-lg-2 col-md-2 col-sm-2 ">
                                                                                    <span>Action</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="list-container-wrapper">
                                                                        <ul class="nav list_content " >
                                                                            <?php for ($i = 0; $i < 10; $i++) { ?>  
                                                                                <li style="width:100%" data-toggle="modal" data-target="#mdl_appeal_sc">
                                                                                    <div class="card" style="font-family: source sans pro;border-bottom: 1px solid #dee2e6 !important;">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                                <div class="d-flex">
                                                                                                    <div> 
                                                                                                        <span class="label-bold">Navarro, Ian</span> <br>                      
                                                                                                        <span class="icms-text-secondary">Created by: </span><span>National Bureau of Investigation (NBI)</span> <br>                      
                                                                                                        <span class="icms-text-secondary">Date created: </span><span>2019-07-10 01:56:36</span><br>
                                                                                                        <span class="icms-text-secondary">Date Updated: </span><span>June 2, 201910:23am</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-2 col-md-2 col-sm-2  ">
                                                                                                <button class="btn dropdown-toggle " type="button" id="dropdown_service" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </button>
                                                                                                <div class="dropdown-menu shadow action-menu" aria-labelledby="dropdown_service"> <a class="dropdown-item disabled action-title" href="#">Select Action</a>
                                                                                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#mdl_appeal_sc">Add new update</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            <?php }
                                                                            ?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content-footer float-right  match-buttons mt-4">
                                                <button type="submit" class="btn btn-secondary-light_blue btn-next " data-tab="employment" style="margin-left:0px;">Update</button>
                                            </div>
                                        </div>
                                        <!--end stage 14-->

                                        <!--stage 15-->
                                        <div class="stage_15 "  style="background: #f8f9fa;">
                                            <div class="m-2 py-3">
                                                <div class="rowform-row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="mb-3 bg-white p-3">
                                                            <div class="row ">
                                                                <div class="col-lg-12 col-md-12 co-l-sm-12 card-sub-title blue  txt-W-500">Decision of SC</div>
                                                            </div>
                                                            <div class="inner-box matched_contents mt-2 mb-0">
                                                                <div class="ul-container">
                                                                    <div class="row-header-border">
                                                                        <div class="card">
                                                                            <div class="row">
                                                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                    <span>Accused Details</span>
                                                                                </div>
                                                                                <div class="col-lg-2 col-md-2 col-sm-2 ">
                                                                                    <span>Action</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="list-container-wrapper">
                                                                        <ul class="nav list_content " >
                                                                            <?php for ($i = 0; $i < 5; $i++) { ?>  
                                                                                <li style="width:100%" data-toggle="modal" data-target="#mdl_decision_sc">
                                                                                    <div class="card" style="font-family: source sans pro;border-bottom: 1px solid #dee2e6 !important;">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                                <div class="d-flex">
                                                                                                    <div> 
                                                                                                        <span class="label-bold">Toledo, Kim Arvin</span><br>                        
                                                                                                        <span class="">Created by: </span><span>National Bureau of Investigation (NBI)</span>  <br>                     
                                                                                                        <span>Date created: </span><span>2019-07-10 01:56:36</span><br>
                                                                                                        <span class="icms-text-secondary">Date Updated: </span><span>June 2, 201910:23am</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-2 col-md-2 col-sm-2  ">
                                                                                                <button class="btn dropdown-toggle " type="button" id="dropdown_service" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </button>
                                                                                                <div class="dropdown-menu shadow action-menu" aria-labelledby="dropdown_service"> <a class="dropdown-item disabled action-title" href="#">Select Action</a>
                                                                                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#mdl_decision_sc">Add new update</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            <?php }
                                                                            ?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content-footer float-right  match-buttons mt-4">
                                                <button type="submit" class="btn btn-secondary-light_blue btn-next " data-tab="employment" style="margin-left:0px;">Update</button>
                                            </div>
                                        </div>
                                        <!--end stage 15-->
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
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
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
                                    <button type="button" class="btn btn-secondary-light_blue  btn-add_layover float-right"><i class="fa fa-plus"></i> Add </button>
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
                                        <td><i class="fas fa-eye blue"></i> Preview  </td>

                                    </tr>

                                    <tr>
                                        <td>MR2.doc</td>
                                        <td><i class="fas fa-eye blue"></i> Preview </td>
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
                                    <button type="button" class="btn btn-secondary-light_blue  btn-add_layover float-right"><i class="fa fa-plus"></i> Add </button>
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
                                        <td><i class="fas fa-eye blue"></i> Preview  </td>

                                    </tr>

                                    <tr>
                                        <td>warrant2.doc</td>
                                        <td><i class="fas fa-eye blue"></i> Preview </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


                <div class="row mgn-L-15">
                    <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue" style="padding-left: 15px;">Pre-Trial Conference  <br> 

                    </div>
                       <!--<button type="button" class="btn btn-secondary-light_blue  btn-add_layover float-right"><i class="fa fa-plus"></i> Add </button>-->
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
                                        <td><i class="fas fa-eye blue"></i> Preview  </td>
                                    </tr>
                                    <tr>
                                        <td>trail_order2.doc</td>
                                        <td><i class="fas fa-eye blue"></i> Preview </td>
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
                                <button type="button" class="btn btn-secondary-light_blue  btn-add_layover float-right"><i class="fa fa-plus"></i> Add </button>
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
                                <button type="button" class="btn btn-secondary-light_blue  btn-add_layover float-right"><i class="fa fa-plus"></i> Add </button>
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
                                    <td>July 29, 2019</td>
                                    <td><i class="fas fa-eye blue"></i> At the end of the case, you will be asked to answer questions that deal with the issues of liability and an assessment of damages for pain and suffering, out-of-pocket expenses, wage loss to trial and into the future, housekeeping expenses to trial and into the future and claims for future care costs.  </td>

                                </tr>

                                <tr>
                                    <td>August 12, 2019</td>
                                    <td><i class="fas fa-eye blue"></i> The evidence to be introduced and the witnesses to be called are entirely in the control of counsel that I have just introduced to you. </td>
                                </tr>

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
                                <!--<button type="button" class="btn btn-secondary-light_blue  btn-add_layover float-right"><i class="fa fa-plus"></i> Add </button>-->
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
                                <button type="button" class="btn btn-secondary-light_blue  btn-add_layover float-right"><i class="fa fa-plus"></i> Add </button>
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
                                    <td><i class="fas fa-eye blue"></i> A judgment may be provided either in written or oral form depending on the circumstances.[ </td>
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
                                <!--<button type="button" class="btn btn-secondary-light_blue  btn-add_layover float-right"><i class="fa fa-plus"></i> Add </button>-->
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
                                <button type="button" class="btn btn-secondary-light_blue  btn-add_layover float-right"><i class="fa fa-plus"></i> Add </button>
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
                                    <td><i class="fas fa-eye blue"></i> A judgment may be provided either in written or oral form depending on the circumstances.[ </td>
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
                                <!--<button type="button" class="btn btn-secondary-light_blue  btn-add_layover float-right"><i class="fa fa-plus"></i> Add </button>-->
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
                                <button type="button" class="btn btn-secondary-light_blue  btn-add_layover float-right"><i class="fa fa-plus"></i> Add </button>
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
                                    <td><i class="fas fa-eye blue"></i> A judgment may be provided either in written or oral form depending on the circumstances.[ </td>
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
                                <button type="button" class="btn btn-secondary-light_blue  btn-add_layover float-right mb-2"><i class="fa fa-plus"></i> Add </button>
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
                                    <td><i class="fas fa-eye blue"></i> Preview  </td>

                                </tr>

                                <tr>
                                    <td>Document2.doc</td>
                                    <td><i class="fas fa-eye blue"></i> Preview </td>
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
                        <div class="col-6 card-sub-title blue  txt-W-500">Documents Attached</div>
                        <div class="col-6">
                            <button type="button" class="btn btn-secondary-light_blue  btn-add_layover float-right mb-2"><i class="fa fa-plus"></i> Add </button>
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
                                    <td><i class="fas fa-eye blue"></i> Preview  </td>

                                </tr>

                                <tr>
                                    <td>MR2.doc</td>
                                    <td><i class="fas fa-eye blue"></i> Preview </td>
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
                            <button type="button" class="btn btn-secondary-light_blue  btn-add_layover float-right"><i class="fa fa-plus"></i> Upload </button>
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
                                <td><i class="fas fa-eye blue"></i> Preview  </td>

                            </tr>

                            <tr>
                                <td>warrant2.doc</td>
                                <td><i class="fas fa-eye blue"></i> Preview </td>
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
                        <button type="button" class="btn btn-secondary-light_blue  btn-add_layover float-right"><i class="fa fa-plus"></i> Upload </button>
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
                                    <td><i class="fas fa-eye blue"></i> <span class="text-gray-500"> Preview </span> </td>
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
<div class="modal fade bd-example-modal-lg" id="mdl_trial"  role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title ">Trial</h5>
            </div>
            <div class="modal-body msgmodal-body" style="height:650px; overflow-y: scroll;">
                <form class="col-12">

                    <div class="card card_tbl-container">
                        <div class="card_tbl-action">
                            <div class="tbl_info card-sub-title">
                                <label class="text-gray-500" >Prosecution’s Presentation of Evidence</label>
                                <button type="button" class="btn btn-secondary-light_blue  btn-add_layover float-right"><i class="fa fa-plus"></i> Add Evidence </button>
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
                    <hr>
                    <div class="mb-3 bg-white p-3">
                        <div class="card card_tbl-container">
                            <div class="card_tbl-action">
                                <div class="tbl_info card-sub-title">
                                    <span class="" >Defense’s Presentation of Evidence</span>
                                    <button type="button" class="btn btn-secondary-light_blue  btn-add_layover float-right"><i class="fa fa-plus"></i> Add </button>
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
                                        <td>July 29, 2019</td>
                                        <td><i class="fas fa-eye blue"></i> At the end of the case, you will be asked to answer questions that deal with the issues of liability and an assessment of damages for pain and suffering, out-of-pocket expenses, wage loss to trial and into the future, housekeeping expenses to trial and into the future and claims for future care costs.  </td>

                                    </tr>

                                    <tr>
                                        <td>August 12, 2019</td>
                                        <td><i class="fas fa-eye blue"></i> The evidence to be introduced and the witnesses to be called are entirely in the control of counsel that I have just introduced to you. </td>
                                    </tr>

                                </tbody>
                            </table>
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
                                <button type="button" class="btn btn-secondary-light_blue  btn-add_layover float-right"><i class="fa fa-plus"></i> Add </button>
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
                                    <td><i class="fas fa-eye blue"></i> Preview  </td>

                                </tr>

                                <tr>
                                    <td>judgment2.doc</td>
                                    <td><i class="fas fa-eye blue"></i> Preview </td>
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
                            <label>Date </label>
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
                            <button type="button" class="btn btn-secondary-light_blue  btn-add_layover float-right"><i class="fa fa-plus"></i> Add </button>
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
                                <td><i class="fas fa-eye blue"></i> A judgment may be provided either in written or oral form depending on the circumstances.</td>
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
                            <button type="button" class="btn btn-secondary-light_blue  btn-add_layover float-right"><i class="fa fa-plus"></i> Add </button>
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
                                <td><i class="fas fa-eye blue"></i> A judgment may be provided either in written or oral form depending on the circumstances.</td>
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