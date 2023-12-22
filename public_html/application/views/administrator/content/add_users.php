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

<div class="page-content">
    <!-- BEGIN PAGE CONTENT INNER -->
    <div class="page-content-inner">
        <div class="mt-content-body">
            <div class="row container-padding" >
                <div class="col-lg-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card" >
                        <div class="div-container">
                            <div class="div-agency-container">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="card-title">
                                            <p> Add user</p>
                                            <small class="card-desc"> Add user for each agency.</small> 
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="card card-body-content mt-4">
                                            <div class="div-container">
                                                <div class="div-agency">
                                                    <div class="card">
                                                        <div class="">
                                                            <span class="text-left content-title">Select User Type</span>
                                                            <p class="content-sub-title">Choose type of user you want to add.</p>
                                                        </div>
                                                        <div class="container-inner-blue">

                                                            <form id="frm-user-type-details">
                                                                <div class="row"> 
                                                                    <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                                                        <label class="float-left"> Agency Name <font color="red">*</font></label><br>
                                                                        <select id="sel_agency" name="sel_agency" class="form-control text-capital">
                                                                            <option selected>Choose...</option>
                                                                            <option>...</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                                                        <label class="">Agency Branch <font color="red">*</font></label><br>
                                                                        <select id="sel_branch" name="sel_branch" class="form-control " disabled>
                                                                            <option selected>Choose...</option>
                                                                            <option>...</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                                                        <label class="">User Level <font color="red">*</font></label><br>
                                                                        <select id="sel_userlevel" name="sel_userlevel" class="form-control"  disabled>
                                                                            <option selected>Choose...</option>
                                                                            <option>...</option>
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <hr>

                                                    <div class="card p-3">
                                                        <div class="">
                                                            <span class="text-left content-title"> User Details</span>
                                                            <p class="content-sub-title">Contains personal information about the user.</p>
                                                        </div>
                                                        <form id="frm-user-details">
                                                            <div class="row form-row">
                                                                <div class="col-lg-5 col-md-6 col-sm-12 px-3">
                                                                    <div class="card-sub-title"> Personal Information </div>
                                                                    <div class="row">
                                                                        <div class="form-group col-lg-9 col-md-12 col-sm-12">
                                                                            <label for="txt_fname" class="lbl">First Name <font color="red">*</font> </label><br>
                                                                            <input type="text" maxlength="20" id="txt_fname" name="txt_fname" class="form-control letNumDash">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group col-lg-9 col-md-12 col-sm-12">
                                                                            <label for="txt_mname" class="lbl">Middle Name</label><br>
                                                                            <input type="text" maxlength="32" id="txt_mname" name="txt_mname" class="form-control lettersOnly">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group col-lg-9 col-md-12 col-sm-12">
                                                                            <label for="txt_lname" class="lbl">Last Name <font color="red">*</font></label><br>
                                                                            <input type="text" maxlength="32" id="txt_lname" name="txt_lname" class="form-control lettersOnly">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group col-lg-9 col-md-12 col-sm-12">
                                                                            <label for="sel_sex" class="lbl">Sex <font color="red">*</font></label><br>
                                                                            <select id="sel_sex" name="sel_sex" class="form-control text-capital">
                                                                                <option selected>Choose...</option>
                                                                                <option>...</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group col-lg-9 col-md-12 col-sm-12">
                                                                            <label for="area_desc" class="lbl">Job Description<font color="red">*</font></label><br>
                                                                            <textarea class="form-control" maxlength="1000" id="area_desc" name="area_desc" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-5 col-md-6 col-sm-12 px-3 ">
                                                                    <div class=" card-sub-title"> User Contact Information </div>

                                                                    <div class="row">
                                                                        <div class="form-group col-lg-9 col-md-12 col-sm-12">
                                                                            <label for="txt_email" class="lbl">Email<font color="red">*</font></label><br>
                                                                            <input type="email" maxlength="50" id="txt_email" name="txt_email" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group col-lg-9 col-md-12 col-sm-12">
                                                                            <label for="txt_tel" class="lbl">Telephone Number</label><br>
                                                                            <input type="text" id="txt_tel" maxlength="20" maxlength="7" name="txt_tel" class="form-control  numbersOnly">

                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group col-lg-9 col-md-12 col-sm-12">
                                                                            <label for="txt_mob" class="lbl">Mobile Number <font color="red">*</font></label><br>
                                                                            <input type="text" maxlength="20" minlength="7" id="txt_mob" name="txt_mob" class="form-control numbersOnly">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>


                                                    </div>
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
        </div>
    </div>
</div>




<!--MODAL TO MANAGE ADDRESS IN ADDING AGENCY BRANCH-->
<div class="modal fade " id="mdl-manage-address" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h5-title msgmodal-header">Manage User Address Details</h5>
            </div>
            <!--<p class="modal-header"> Manage Agency Address</p>-->
            <div class="modal-body mdl-manage-address">

                <form class="form-manage-address" id="form-manage-address">
                    <div class="form-group">
                        <label for="sel_country" class="col-form-label">Country <font color="red">*</font></label>
                        <select id="sel_country" name="sel_country" class="form-control text-capital">
                            <option value="0">...</option>
                        </select>
                    </div>
                    <div class="form-group grp-region">
                        <label for="sel_region" class="col-form-label">Region <font color="red">*</font></label>
                        <select id="sel_region"  name="sel_region" class="form-control text-capital">
                            <option value="0">...</option>
                        </select>
                    </div>
                    <div class="form-group grp-prov-state">
                        <label for="sel_state_prov" class="col-form-label">Province / State <font color="red">*</font></label>
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
                        <label for="area_detailed" class="col-form-label">Detailed Address <font color="red">*</font></label>
                        <textarea class="form-control detailed-add limitedSpecChar" name="area_detailed" id="area_detailed" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-close btn-cancel btn-close-modal-agn closeUpdate" changes="0" parentModal="mdl-manage-address" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-save btn-add-address"> Save </button>
            </div>
        </div>

    </div>
</div>      

