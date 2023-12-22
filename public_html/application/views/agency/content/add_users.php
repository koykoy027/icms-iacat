<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content">

    <!-- BEGIN PAGE CONTENT INNER -->
    <div class="page-content-inner">
        <div class="mt-content-body">
            <div class="row container-padding" >
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card" >
                        <div class="div-container">
                            <div class="div-agency">
                                <!--                                <div class="row"> 
                                                                    <div class="col-6 card-title"> Select User Type<br> 
                                                                        <small class="card-desc"> Choose type of user you want to add. </small> 
                                                                    </div>
                                                                </div>-->
                                <div class="row">
                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                        <span class="text-left content-title"><a>Select User Type</a></span>
                                        <p class="content-sub-title">Choose type of user you want to add.</p>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <!--                                        <div class="col-6 card-title">
                                                                                    <p class="text-left content-title"><a>Select User Type</a></p>
                                                                                    <small class="content-desc">Choose type of user you want to add.</small>
                                                                                </div>-->


                                        <div class="container-inner">
                                            <form id="frm-user-type-details">
                                                <div class="row"> 
                                                    <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                                        <label class="float-left">Select Agency</label><br>
                                                        <select id="sel_agency" name="sel_agency" class="form-control text-capital">
                                                            <option selected>Choose...</option>
                                                            <option>...</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                                        <label class="">Select Branch</label><br>
                                                        <select id="sel_branch" name="sel_branch" class="form-control " disabled>
                                                            <option selected>Choose...</option>
                                                            <option>...</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                                        <label class="">User Level</label><br>
                                                        <select id="sel_userlevel" name="sel_userlevel" class="form-control"  disabled>
                                                            <option selected>Choose...</option>
                                                            <option>...</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                        <hr>

                                        <div class="row"> 

                                            <div class="col-lg-6 col-md-6 col-sm-12 card-title">
                                                <p class="text-left content-title"><a>Select Details</a></p>
                                                <small class="content-desc">Contains personal information about the user.</small>
                                            </div>
                                        </div>
                                        <form id="frm-user-details">
                                            <div class="row form-row">
                                                <div class="col-lg-6 col-md-6 col-sm-12 ">
                                                    <div class="col-lg-6 col-md-6 col-sm-12 card-sub-title"> Personal Information </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                            <label for="txt_fname" class="lbl">First Name</label><br>
                                                            <input type="text" id="txt_fname" name="txt_fname" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                            <label for="txt_mname" class="lbl">Middle Name</label><br>
                                                            <input type="text" id="txt_mname" name="txt_mname" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                            <label for="txt_lname" class="lbl">Last Name</label><br>
                                                            <input type="text" id="txt_lname" name="txt_lname" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                            <label for="sel_sex" class="lbl">Sex</label><br>
                                                            <select id="sel_sex" name="sel_sex" class="form-control text-capital">
                                                                <option selected>Choose...</option>
                                                                <option>...</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                            <label for="area_desc" class="lbl">Job Description</label><br>
                                                            <textarea id="area_desc" name="area_desc" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-12 ">
                                                  <div class="col-lg-6 col-md-6 col-sm-12 card-sub-title"> User Contact Information </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                            <label for="txt_email" class="lbl">Email</label><br>
                                                            <input type="email" id="txt_email" name="txt_email" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                            <label for="txt_tel" class="lbl">Telephone Number</label><br>
                                                            <input type="text" id="txt_tel" name="txt_tel" class="form-control  numeric-nd">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                            <label for="txt_mob" class="lbl">Mobile Number</label><br>
                                                            <input type="text" id="txt_mob" name="txt_mob" class="form-control numeric-nd">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                            <label for="txt_desc" class="lbl">User Address</label><br>
                                                            <button type="button" class="btn btn-outline-secondary form-control text-center  btn-manage-address" data-toggle="modal" data-target="#mdl-manage-address"><i class="fas fa-home"></i>&nbsp;&nbsp;&nbsp;Manage Address</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <button type="button" class="btn btn-save float-right" id="btn_save_user">Save New User</button>

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




<!--MODAL TO MANAGE ADDRESS IN ADDING AGENCY BRANCH-->
<div class="modal fade" id="mdl-manage-address" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <p class="modal-header"> Manage Agency Address</p>
            <div class="modal-body mdl-manage-address">

                <form class="form-manage-address" id="form-manage-address">
                    <div class="form-group">
                        <label for="sel_country" class="col-form-label">Country</label>
                        <select id="sel_country" name="sel_country" class="form-control text-capital">
                            <option value="0">...</option>
                        </select>
                    </div>
                    <div class="form-group grp-region">
                        <label for="sel_region" class="col-form-label">Region</label>
                        <select id="sel_region"  name="sel_region" class="form-control text-capital">
                            <option value="0">...</option>
                        </select>
                    </div>
                    <div class="form-group grp-prov-state">
                        <label for="sel_state_prov" class="col-form-label">Province / State</label>
                        <select id="sel_state_prov" name="sel_state_prov" class="form-control text-capital">
                            <option value="0">...</option>
                        </select>
                    </div>
                    <div class="form-group grp-city">
                        <label for="sel_city" class="col-form-label">City</label>
                        <select id="sel_city" name="sel_city" class="form-control text-capital">
                            <option value="0">...</option>
                        </select>
                    </div>
                    <div class="form-group grp-brgy">
                        <label for="sel_brgy" class="col-form-label">Barangay</label>
                        <select id="sel_brgy" name="sel_brgy" class="form-control text-capital">
                            <option value="0">...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="area_detailed" class="col-form-label">Detailed Address</label>
                        <textarea class="form-control" name="area_detailed" id="area_detailed" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-close btn-close-modal-agn" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-save btn-add-address"> Save </button>
            </div>
        </div>

    </div>
</div>      

