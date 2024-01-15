<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content-inner ">
    <div class="content-body">    
        <div class="card" style="padding: 1rem;">
            <div class="content-body-container" >
                <div class=" card-stats-inner" >
                    <form id="frm_agency">
                        <div class="container" style="margin-top: 20px"> 

                            <span class="text-left content-title">Agency Branch Details</span>
                            <p>Provide details of agency branch.</p>
                            <div class="row form-row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label>Agency</label> <br>
                                                    <select id="sel-Agency" name="sel_category" class="form-control"  data-placeholder="Choose a Agency..."  tabindex="1"> 
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label for="txt_brachname" class="lbl">Branch Name</label><br>
                                                    <input type="text" id="txt_brachname" name="txt_brachname" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label for="txt_email" class="lbl">Email Address</label>
                                                    <input type="email" id="txt_email" name="txt_email" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label for="txt_tel" class="lbl">Telephone Number</label>
                                                    <input type="text" id="txt_tel" name="txt_tel" class="form-control numeric-wd">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label for="txt_mobile" class="lbl">Mobile Number</label>
                                                    <input type="text" id="txt_mobile" name="txt_mobile" class="form-control numeric-nd">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label for="service_dropdown" class="lbl">Services Offered</label><br>
                                                    <select id="service_dropdown" name="service_dropdown" class="form-control"  data-placeholder="Choose services..."  tabindex="1" multiple="true"> </select>
                                                </div>
                                            </div>                                
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label for="txt_desc" class="lbl">Agency Address</label><br>
                                                    <div class="address_container hide" ><p>Full Address</p><span class="lbl-agency_datails_address"></span>
                                                    </div>
                                                    <button type="button" data-country="0" data-region="0" data-province="0" data-city="0" data-brgy="0" data-address="" class="btn btn-outline-secondary form-control text-center btn-agency-address" data-toggle="modal" data-target="#mdl-manage-agn-address"><i class="fas fa-home"></i>&nbsp;&nbsp;&nbsp;Manage Address</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <span class="text-left content-title">Contact Person</span>
                            <p>Provide branch agency contact person.</p>
                            <div class="row form-row">
                                <div class="col-12">
                                    <div id="tbl-agency-contact_container" style="display:none;">
                                        <button type="button" class="btn btn-secondary-light_blue btn-light btn-add_contact_person float-right " style="margin-bottom:10px;"><i class="fa fa-plus"></i> Add Contact Person</button>

                                        <table class="table border-bottom" id="tbl-agency_contact_person">
                                            <thead class="thead-grey">
                                                <tr>

                                                    <th scope="col">Name</th>
                                                    <th scope="col">Email Address</th>
                                                    <th scope="col" class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list-agency_contact">
                                            </tbody>
                                        </table>


                                    </div>

                                    <div class="no-contact_person">                                        
                                    </div>
                                </div>
                            </div>
                            <div class="content-footer float-right">
                                <button type="button" class="btn btn-primary-orange btn_save_agency btn-add-agency-branch ">Add Agency Branch</button>
                            </div>
                    </form>
                </div> 

            </div>
        </div>
    </div>
</div>

<!--Start Modal-->

<div class="modal fade" id="mdl-add-contact-person" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title "> Contact Person Address</h5>

            </div>
            <div class="modal-body msgmodal-body mdl-add-contact-person">
                <form class="form-manage-address  mx-2 px-2" id="form-add-contact-person">
                    <div class="div">

                        <div class="row">
                            <div class="form-group col-12 div-is_primary">
                                <input type="checkbox" name="checkbox" id="is_primary" value="">
                                <label for="is_primary" class="icms-text-primary pl-2">Set this as primary contact person</label>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="form-group col-12 ">
                                <label for="txt_cont_fname" class="lbl">Firstname </label>
                                <input type="text" id="txt_cont_fname" name="txt_cont_fname" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="txt_cont_mname" class="lbl">Middlename</label>
                                <input type="text" id="txt_cont_mname" name="txt_cont_mname" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="txt_cont_lname" class="lbl">Lastname</label>
                                <input type="text" id="txt_cont_lname" name="txt_cont_lname" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="txt_cont_tel" class="lbl">Telephone Number</label>
                                <input type="text" id="txt_cont_tel" name="txt_cont_tel" class="form-control">
                            </div>
                            <div class="form-group col-6">
                                <label for="txt_cont_mob" class="lbl">Mobile Number</label>
                                <input type="text" id="txt_cont_mob" name="txt_cont_mob" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="txt_cont_email" class="lbl">Email Address</label>
                                <input type="email" id="txt_cont_email" name="txt_cont_email" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="txt_desc" class="lbl">Agency Contact Address</label><br>
                                <p class="lbl-cont_datails_address"></p>
                                <button type="button" data-country="0" data-region="0" data-province="0" data-city="0" data-brgy="0" data-address="" class="btn btn-outline-secondary form-control text-center btn-cont-address"><i class="fas fa-home"></i>&nbsp;Manage Address</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer msgmodal-footer">
                <button type="button" class="btn btn-cancel btn-modal-cancel  btn-close-modal-agn" data-dismiss="modal" >Cancel</button>
                <button type="submit" class="btn btn-primary-orange btn-next shadow" id="btn-add-contact_person" style="margin-left:0px;" >Save</button>

            </div>
        </div>
    </div>
</div>

<!--MODAL TO MANAGE AGENCY ADDRESS-->
<div class="modal fade" id="mdl-manage-agn-address" tabindex="-1" role="dialog" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title "> Manage Agency Address</h5>

            </div>
            <div class="modal-body msgmodal-body mdl-manage-address">
                <form class="form-manage-address  mx-2 px-2" id="form-manage-address" >
                    <div class="div">

                        <div class="row">
                            <div class="form-group col-12">
                                <label for="sel_country" class="lbl">Country</label>
                                <select id="sel_country" name="sel_country" class="form-control"  data-placeholder="Choose a Country..."  tabindex="1">
                                    <option value="0">...</option>
                                </select>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="form-group grp-region col-12">
                                <label for="sel_region" class="lbl">Region</label>
                                <select id="sel_region"  name="sel_region" class="form-control">
                                    <option value="0">...</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group grp-prov-state col-12">
                                <label for="sel_state_prov" class="lbl">Province / State</label>
                                <select id="sel_state_prov" name="sel_state_prov" class="form-control">
                                    <option value="0">...</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group grp-city col-12">
                                <label for="sel_city" class="lbl">City</label>
                                <select id="sel_city" name="sel_city" class="form-control">
                                    <option value="0">...</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group grp-brgy col-12">
                                <label for="sel_brgy" class="lbl">Barangay</label>
                                <select id="sel_brgy" name="sel_brgy" class="form-control">
                                    <option value="0">...</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="area_detailed" class="lbl">Detailed Address: </label>
                                <textarea class="form-control " name="area_detailed" id="area_detailed" rows="10" style="height: 50px !important;"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer msgmodal-footer">
                <button type="button" class="btn btn-cancel btn-modal-cancel btn-close-modal-agn" data-dismiss="modal" >Cancel</button>
                <button type="submit" class="btn btn-primary-orange btn-next  btn-add-address shadow" style="margin-left:0px;" >Save</button>

            </div>
        </div>
    </div>
</div>


<!--MODAL TO MANAGE CONTACT ADDRESS-->
<div class="modal fade" id="mdl-manage-cont-address" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title "> Contact Person Address</h5>

            </div>
            <div class="modal-body msgmodal-body mdl-manage-address">
                <form class="form-manage-address  mx-2 px-2" id="form-manage-address-con">
                    <div class="div">

                        <div class="row">
                            <div class="form-group col-12">
                                <label for="sel_country_con" class="lbl">Country</label>
                                <select id="sel_country_con" name="sel_country_con" class="form-control">
                                    <option value="0">...</option>
                                </select>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="form-group  grp-region-con col-12">
                                <label for="sel_region_con" class="lbl">Region</label>
                                <select id="sel_region_con"  name="sel_region_con" class="form-control">
                                    <option value="0">...</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group grp-prov-state-con col-12">
                                <label for="sel_state_prov_con" class="lbl">Province / State</label>
                                <select id="sel_state_prov_con" name="sel_state_prov_con" class="form-control">
                                    <option value="0">...</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group grp-city-con col-12">
                                <label for="sel_city_con" class="lbl">City</label>
                                <select id="sel_city_con" name="sel_city_con" class="form-control">
                                    <option value="0">...</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group grp-brgy-con col-12">
                                <label for="sel_brgy_con" class="lbl">Barangay</label>
                                <select id="sel_brgy_con" name="sel_brgy_con" class="form-control">
                                    <option value="0">...</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="area_detailed_con" class="lbl">Detailed Address</label>
                                <textarea class="form-control" style="height: unset !important;" name="area_detailed_con" id="area_detailed_con" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer msgmodal-footer">
                <button type="button" class="btn btn-cancel btn-modal-cancel  btn-close_modal_address_con" data-dismiss="modal" >Cancel</button>
                <button type="submit" class="btn btn-primary-orange btn-next  btn-add-address_con shadow" style="margin-left:0px;" >Save</button>

            </div>
        </div>
    </div>
</div>
<!--//////---------------------------------------//-->
<div class="modal fade" id="modal-add_contact_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title ">Add Contact Info</h5>

            </div>
            <div class="modal-body msgmodal-body">
                <form class="form-manage-address  mx-2 px-2" id="form-add_contact_info"  onSubmit="return false;">
                    <div class="div">

                        <div class="row ">
                            <div class="form-group col-12 ">
                                <label>Contact type </label>
                                <select class="form-control sel-contact_type a-vi-contact_type" name="contact_type" >
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label> Value </label>
                                <input type="text" class="form-control a-vi-contact_content" name="contact_content">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer msgmodal-footer">
                <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                <button type="submit" class="btn btn-primary-orange btn-next" style="margin-left:0px;" >Save</button>
            </div>
        </div>
    </div>
</div>
