<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
//echo"<pre>";
// print_r($_SESSION);
//
//echo $this->yel->generateCaseControlNumber();
?>


<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content">

    <!-- BEGIN PAGE CONTENT INNER -->
    <div class="page-content-inner">
        <div class="mt-content-body">
            <div class="row container-padding" >
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card" >
                        <div class="row"> 

                            <div class="col-lg-5 col-md-4 col-sm-12"> 
                                <div class="card-title ml-3">
                                    <p> ICMS Agency List</p>
                                    <small class="card-desc"> List of all agencies in ICMS</small> 
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-8 col-sm-12 ">
                                <div class="list-action mt-5 mr-5">

                                    <div class=" mt-1 show list-action-filter float-right">
                                        <input class="txt_search" id="txt_search_agency_list" type="search" placeholder="search keyword..." aria-label="Search">
                                        <div class="d-inline-block pl-1">
                                            <button type="button" class="btn btn-secondary-light_blue  btn-quick-actions " data-target="dropdownnotifyButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Filter <i class="fas fa-angle-down pl-3"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown_filter shadow pb-0" id="dropdownnotifyButton"  x-placement="bottom-start">
                                                <a class="dropdown-item disabled action-title" href="#" >Filter By</a>
                                                <ul class="list-group list-status">
                                                    <li class="list-group-item filter-title pl-2">
                                                        Status
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input chk-filter" name="status" type="checkbox" id="inlineCheckbox1" value="1">
                                                            <label class="form-check-label" for="0">Active</label>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input chk-filter" name="status" type="checkbox" id="inlineCheckbox2" value="0">
                                                            <label class="form-check-label" for="1">Inactive</label>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <ul class="list-group">
                                                    <li class="list-group-item filter-title pl-2">
                                                        Category
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input chk-filter" name="category" type="checkbox" id="inlineCheckbox1" value="2">
                                                            <label class="form-check-label" for="0">Government</label>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input chk-filter" name="category" type="checkbox" id="inlineCheckbox3" value="1" >
                                                            <label class="form-check-label" for="2">Non Government</label>
                                                        </div>
                                                    </li>
                                                    <li class="filter_action-btn hide">
                                                        <button class="dropdown-item btn-filter_clear " type="button">Clear</button>
                                                        <button class="dropdown-item btn-filter_list " type="button">Filter </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div  class="d-inline-block">
                                            <button type="button" class="btn btn-secondary-light_blue  btn-quick-actions " data-target="dropdownnotifyButton1"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Order By <i class="fas fa-angle-down pl-3"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown_filter shadow pb-0" id="dropdownnotifyButton1"  x-placement="bottom-start">
                                                <a class="dropdown-item disabled action-title" href="#" >Order by</a>
                                                <ul class="list-group">

                                                    <li class="list-group-item">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input chk-filter" name="orderBy" type="checkbox" id="AN_1"  value="1">
                                                            <label class="form-check-label" for="1">Agency Name (A-Z)</label>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input chk-filter" name="orderBy" type="checkbox" id="AN_2" value="2" >
                                                            <label class="form-check-label" for="2">Agency Name (Z-A)</label>
                                                        </div>
                                                    </li>
                                                    <li class="filter_action-btn hide">
                                                        <button class="dropdown-item btn-filter_clear "  type="button">Clear</button>
                                                        <button class="dropdown-item btn-filter_list " type="button">Filter </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="page-body-container mx-3  mt-3" id="agency_listing">
                            <div class="div-list mx-4">
                                <div class=" row-header-border">
                                    <div class="card pb-2 bg-light-gray">
                                        <div class="row ">
                                            <div class="col-lg-8 col-md-6 col-sm-6">
                                                <span>Agency</span>
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-sm-3 txt-align_center toggle_actions">
                                                <span>Status</span>
                                            </div>
                                            <div class="col-lg-2 col-md-3 col-sm-3 txt-align_center toggle_actions">
                                                <span>Action</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <ul class="nav agency-list_content list-content  div-agencies-list">
                                    <?php for ($x = 0; $x <= 10; $x++) { ?> 
                                        <li  class="wd-full">
                                            <div class="card">
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-6 col-sm-6 details-col">
                                                        <div class="linear-background m-2">
                                                            <div class="inter-draw"></div>
                                                            <div class="inter-crop"></div>
                                                            <div class="inter-right--top"></div>
                                                            <div class="inter-right--bottom"></div>
                                                            <div class="inter-right--bottom2"></div>
                                                            <div class="inter-right--bottom3"></div>
                                                            <div class="inter-right--bottom4"></div>
                                                            <div class="inter-right--bottom5"></div>
                                                            <div class="inter-right--bottom6"></div>
                                                            <div class="inter-right--bottom7"></div>
                                                            <div class="inter-right--bottom8"></div>
                                                            <div class="inter-right--bottom9"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-3 col-sm-3 txt-align_center status-col"> 
                                                        <div class="linear-background">
                                                            <div class="inter-draw"></div>
                                                            <div class="inter-crop"></div>
                                                            <div class="inter-right--top"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-3 col-sm-3 txt-align_center action-col">
                                                        <div class="linear-background">
                                                            <div class="inter-draw"></div>
                                                            <div class="inter-crop"></div>
                                                            <div class="inter-right--top"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                    <?php } ?>
                                </ul>
                            </div>  
                            <div class="pagination-wrapper rs-list">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <p class="pagination-details rs-info mt-3"></p>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-12 text-right">
                                        <ul class="pagination rs-pagination mt-2">
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






<!-- START MODAL -->

<!-- View Agency Modal -->

<div class="modal fade " id="mdl-view_agency" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg  modal-details modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-5">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <div class="nav-data_list">
                            <div class="agency_details mt-4">
                                <div class="card card-img-loc d-flex">
                                    <img class='modal-img-details float-left' src="" height="100px;" onerror="ifBrokenLogo(this);">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12 col-sm-12">
                        <div class="pt-4 agency-details">
                            <span class="agency_name blue">Inter-Agency Council Against Trafficking ( IACAT )</span>
                            <br> <span class="agency_type">Non Government Agency</span>
                            <span class="agency_status pl-3"></span>
                            <br><br>
                            <br> <span class="text-gray-500 fw-600">Agency Description </span>
                            <div class="lbl-agency_desc">
                                The Inter-Agency Council Against Trafficking (IACAT) is the body mandated by law to coordinate and 
                                monitor the implementation of Republic Act No. 9208, or the Anti-Trafficking in Persons Act of 2003,
                                with the Department of justice as the lead agency. It was formed under section 20 of R.A. 9208, and is 
                                composed of the following government agencies and non-government sectoral representatives:

                                The IACAT conducts many different projects geared towards the elimination of trafficking in persons in the Philippines, prevention of 
                                the occurrence of trafficking, the protection and rehabilitation of victims and conviction of trafficking offenders.
                            </div>
                        </div>

                    </div>
                </div>
                <br>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- End View Agency Modal -->


<!-- Update Agency Modal -->

<div class="modal fade modal-manage" id="mdl-manage_agency" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-details" role="document">
        <div class="modal-content ">
            <div class="modal-header p-0">
                <h5 class="modal-title h5-title msgmodal-header">Manage Agency Details</h5>
            </div>
            <div class="modal-body">
                <div class="container mdl-body_view_agency">

                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="card border-0">
                                    <div class="row" >
                                        <div class="form-group col-lg-12  div-image shadow-sm">
                                            <div class="card-body  modal-div-image text-center"  id="fileupload_div">
                                                <i class="fas fa-upload text-gray-500"></i><br>
                                                <span class="small text-gray-500 mgn-T-18">Choose file to upload.</span>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12 px-0">
                                            <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control-file badge-light item-img" id="imageselect">
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <label>Status </label>
                                    <select id="sel-status" name="sel_status" class="form-control">
                                        <option value="0">Inactive</option>
                                        <option value="1">Active</option>
                                    </select>
                                </div> 
                            </div>

                            <div class="col-lg-8 col-md-12 col-sm-12">

                                <form id="frm-UpdateAgency" class=" form-update">
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <label>Agency Name <font color="red">*</font></label>
                                            <input type="text" maxlength="60" minlength="5" id="txt-agn-name" name="txt_name" class="form-control letNumDash" placeholder="Ople Center" required>
                                        </div>
                                    </div>
                                    <div class="row"> 
                                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                            <label>Agency Name Abbreviation <font color="red">*</font> </label>
                                            <input type="text" maxlength="8" minlength="2" id="text-agn-abbr" name="txt_abbr" class="form-control letterDash text-uppercase" placeholder="Ople" required>
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                            <label>Category</label>
                                            <select id="sel-category" name="sel_category" class="form-control">
                                                <option value="0" disabled="">Select Category</option>
                                                <option value="2">Government</option>
                                                <option value="1">Non Government</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <label>Description <font color="red">*</font> </label>
                                            <textarea name="area_desc"  class="form-control" id="description" placeholder="1000 charater max" ></textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-cancel closeUpdate" parentModal="mdl-manage_agency" changes="0">Close</button>
                <button type="button" class="btn btn-save btn-save" id="btn-save_manage" >Save</button>
            </div>

        </div>
    </div>
</div>

<!-- End Update Agency Modal -->

<!-- END MODAL -->

<!-- Modal -->
<div id="cropImagePop" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body m-5">
                <div class="col-xs-12 col-sm-4 col-sm-offset-4" style="display: contents">
                    <div  class="container" style="display: block; width: 300px; height: 300px;">
                        <div id="upload-demo"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel"  data-dismiss="modal" >Cancel</button>
                <button type="button" id="cropImageBtn" class="btn btn-save">Crop</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
