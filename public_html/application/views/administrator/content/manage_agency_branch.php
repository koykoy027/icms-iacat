<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Page Security
 */
//echo $this->yel->encrypt_param("1");
//echo "<pre>";
//print_r($agency_services);
//echo "</pre>";
$ctr = 0;
foreach ($agency_services as $key => $val) {
    if ($ctr == 0) {
        $service_selected = $val['services_id'];
    } else {
        $service_selected .= ',' . $val['services_id'];
    }
    $ctr++;
}
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content-inner ">
    <div class="content-body">    
        <div class="card p1rem">
            <div class="content-body-container" >
                <div class=" card-stats-inner" >
                    <div class="container pt-5"> 
                        <div class="card-title">
                            <input type="hidden" id="inp-h-agency_branch_id" value="<?= $agency_details['agency_branch_id'] ?>">
                            <p>Manage Agency Branch Details </p>
                            <small class="card-desc"> Provide details of agency branch.  </small> 
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="row">
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label>Agency</label> 
                                        <input type="text" id="txt_agency" value="<?= $agency_details['agency_name'] ?>"  disabled name="txt_agency" class="form-control">
                                    </div>
                                </div>
                                <form id="frm-agn-branch">
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <label for="txt_brachname" class="lbl">Branch Name <font color="red"> * </font></label><br>
                                            <input type="text" id="txt_branchname"   maxlength="60" value="<?= $agency_details['agency_branch_name'] ?>" oldVal="<?= $agency_details['agency_branch_name'] ?>" disabled name="txt_branchname" class="form-control letNumDash">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <label for="txt_email" class="lbl">Email Address <font color="red"> * </font> </label>
                                            <input type="email" id="txt_email" maxlength="60" oldemailvalue="<?= $agency_details['agency_branch_email'] ?>" value="<?= $agency_details['agency_branch_email'] ?>" oldVal="<?= $agency_details['agency_branch_email'] ?>" disabled name="txt_email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <label for="txt_tel" class="lbl">Telephone Number </label>
                                            <input type="text" id="txt_tel" maxlength="20" minlength="7" oldVal="<?= $agency_details['agency_branch_telephone_number'] ?>" value="<?= $agency_details['agency_branch_telephone_number'] ?>" disabled  name="txt_tel" class="form-control numbersOnly">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <label for="txt_mobile" class="lbl">Mobile Number <font color="red"> * </font> </label>
                                            <input type="text" id="txt_mobile" maxlength="20" minlength="7" oldVal="<?= $agency_details['agency_branch_mobile_number'] ?>" value="<?= $agency_details['agency_branch_mobile_number'] ?>" disabled name="txt_mobile" class="form-control numbersOnly">
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12 div-agency-services">
                                            <label for="service_dropdown" class="lbl">Services Offered <font color="red"> * </font></label><br>
                                            <select id="service_dropdown" oldVal="<?= $ctr == 0 ? "0" : $service_selected ?>" current-service="<?= $ctr == 0 ? "0" : $service_selected ?>"  name="service_dropdown" class="form-control"  data-placeholder="Choose services..."  tabindex="1" multiple="true"> </select>
                                        </div>

                                        <div class="form-group col-lg-12 col-md-12 col-sm-12 div-agency-services-label">
                                            <label class="lbl">Services Offered <font color="red"> * </font></label><br>
                                            <ul id="ul-agency-services-label"> 
                                            </ul>
                                        </div>

                                    </div>   
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <label for="inp-branch_status">Status</label>
                                            <select id="inp-branch_status" class="form-control text-capital" disabled=""  oldVal="<?= $agency_details['agency_branch_is_active']?>">
                                                <option value="1" <?= $agency_details['agency_branch_is_active'] == '1' ? ' selected="selected"' : ''; ?>>Active</option>
                                                <option value="0" <?= $agency_details['agency_branch_is_active'] == '0' ? ' selected="selected"' : ''; ?>>Inactive</option>
                                            </select>
                                        </div> 
                                    </div>
                                </form>

                                <div class="row">
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12"><br>
                                        <button type="button" class="btn btn-secondary-light_blue btn-edit-cancel-agn-details">Manage</button>   
                                        <button type="button" class="btn btn-save btn-save-agn-details hide " data-agency-id="<?= $agency_details['agency_branch_id'] ?>" >Save</button>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <form id="frm-agency-address">
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <label for="sel_country">Country <font color="red"> * </font></label>
                                            <select id="sel_country" class="form-control text-capital" disabled dataid="<?= empty($agency_address) ? "" : $agency_address['address_list_country'] ?>" name="sel_country"  data-placeholder="Choose a Country..."  tabindex="1">
                                                <option value="0">...</option>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="form-group  grp-region col-lg-12 col-md-12 col-sm-12">
                                            <label for="sel_region" >Region <font color="red"> * </font></label>
                                            <select id="sel_region" class="form-control text-capital" disabled dataid="<?= empty($agency_address) ? "" : $agency_address['address_list_region'] ?>"  name="sel_region">
                                                <option value="0">...</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <label for="sel_state_prov" >Province / State <font color="red"> * </font></label>
                                            <select id="sel_state_prov" class="form-control text-capital" disabled dataid="<?= empty($agency_address) ? "" : $agency_address['address_list_province'] ?>" name="sel_state_prov">
                                                <option value="0">...</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <label for="sel_city">City</label>
                                            <select id="sel_city" class="form-control text-capital" disabled  dataid="<?= empty($agency_address) ? "" : $agency_address['address_list_city'] ?>" name="sel_city" >
                                                <option value="0">...</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <label for="sel_brgy" >Barangay</label>
                                            <select id="sel_brgy" class="form-control text-capital" disabled  dataid="<?= empty($agency_address) ? "" : $agency_address['address_list_brgy'] ?>" name="sel_brgy" >
                                                <option value="0">...</option>
                                            </select>
                                        </div></div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <label for="area_detailed">Detailed Address <font color="red"> * </font></label>
                                            <textarea class="form-control " contenteditable=true maxlength="100" name="area_detailed" disabled dataid="<?= empty($agency_address) ? "" : $agency_address['address_list_address'] ?>" id="area_detailed" rows="10"> <?= empty($agency_address) ? "" : $agency_address['address_list_address'] ?></textarea>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12"><br>
                                        <button type="button" class="btn btn-secondary-light_blue btn-save-cancel-agn-address" >Manage</button>   
                                        <button type="button" class="btn btn-save btn-save-agn-address hide" data-address-id="<?= $agency_address['address_list_id'] ?>">Save</button>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <div class="card-title">
                                    <p> Contact Person </p>
                                    <small class="card-desc"> Provide branch agency contact person.  </small> 
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <button type="button" class="btn btn-add_contact_person btn-secondary-light_blue float-right mb-3"><i class="fa fa-plus"></i> Add Contact Person</button>
                            </div>
                        </div>

                        <div class="row form-row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div id="tbl-agency-contact_container" >
                                    <table class="table" id="tbl-agency_contact_person">
                                        <thead class="thead-grey">
                                            <tr>

                                                <th scope="col">Contact Details</th>
                                                <!--<th scope="col">Address</th>-->
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
                    </div>        
                </div>
            </div>
        </div>
    </div>
</div>



<!--MODAL TO MANAGE CONTACT ADDRESS-->
<div class="modal fade" id="mdl-manage-cont-address" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h5-title msgmodal-header">Manage Agency Contact Address </h5>
            </div>
            <div class="modal-body mdl-manage-address">

                <form class="form-manage-address" id="form-manage-address-con">
                    <div class="form-group">
                        <label for="sel_country_con" class="col-form-label">Country <font color="red">*</font></label>
                        <select id="sel_country_con" name="sel_country_con" class="form-control  text-capital">
                            <option value="0">...</option>
                        </select>
                    </div>
                    <div class="form-group  grp-region-con">
                        <label for="sel_region_con" class="col-form-label">Region <font color="red">*</font></label>
                        <select id="sel_region_con"  name="sel_region_con" class="form-control  text-capital">
                            <option value="0">...</option>
                        </select>
                    </div>
                    <div class="form-group grp-prov-state-con">
                        <label for="sel_state_prov_con" class="col-form-label">Province / State <font color="red">*</font></label>
                        <select id="sel_state_prov_con" name="sel_state_prov_con" class="form-control  text-capital">
                            <option value="0">...</option>
                        </select>
                    </div>
                    <div class="form-group grp-city-con">
                        <label for="sel_city_con" class="col-form-label">City</label>
                        <select id="sel_city_con" name="sel_city_con" class="form-control  text-capital">
                            <option value="0">...</option>
                        </select>
                    </div>
                    <div class="form-group grp-brgy-con">
                        <label for="sel_brgy_con" class="col-form-label">Barangay</label>
                        <select id="sel_brgy_con" name="sel_brgy_con" class="form-control text-capital">
                            <option value="0">...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="area_detailed_con" class="col-form-label">Unit No.,House No.,Bldg, Street Name <font color="red">*</font></label>
                        <textarea class="form-control textarea-unset" name="area_detailed_con" id="area_detailed_con" rows="5"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-close btn-close_modal_address_con" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-save btn-add-address_con">Save</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="mdl-add-contact-person" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h5-title msgmodal-header">Agency Branch Contact Person</h5>
            </div>
            <!--<p class="modal-header">Agency Branch Contact Person </p>-->
            <div class="modal-body mdl-add-contact-person">

                <form id="form-add-contact-person">
                    <div class="row">
                        <div class="form-group col-12 div-is_primary">
                            <input type="checkbox" name="checkbox" id="is_primary" value="">
                            <label for="is_primary">Primary Contact</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12 ">
                            <label for="txt_cont_fname" class="lbl">Firstname <font color="red">*</a></label>
                            <input type="text" id="txt_cont_fname" maxlength="32" name="txt_cont_fname" class="form-control letNumDash ">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="txt_cont_mname" class="lbl">Middlename</label>
                            <input type="text" id="txt_cont_mname"  maxlength="32" name="txt_cont_mname" class="form-control lettersOnly">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="txt_cont_lname" class="lbl">Lastname <font color="red">*</a></label>
                            <input type="text" id="txt_cont_lname" maxlength="32" name="txt_cont_lname" class="form-control lettersOnly">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="txt_cont_tel" class="lbl">Telephone Number</label>
                            <input type="text" id="txt_cont_tel" maxlength="32" name="txt_cont_tel" class="form-control numbersOnly">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <label for="txt_cont_mob" class="lbl">Mobile Number <font color="red">*</a></label>
                            <input type="text" id="txt_cont_mob" maxlength="32" name="txt_cont_mob" class="form-control numbersOnly">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="txt_cont_email" class="lbl">Email Address <font color="red">*</a></label>
                            <input type="email" id="txt_cont_email" name="txt_cont_email" class="form-control">
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-save" agn-id="<?= $agency_details['agency_branch_id'] ?>" id="btn-add-contact_person">Save</button>
            </div>
        </div>
    </div>
</div>