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

                            <div class="col-lg-5 col-md-12 col-sm-12"> 
                                <div class="card-title">
                                    <p> ICMS Agency List</p>
                                    <small class="card-desc"> List of all agencies in ICMS</small> 
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-12 col-sm-12 ">
                                <div class="list-action" style="margin-top: 32px;">
                                    <input class="txt_search" id="txt_search_agency_list" type="search" placeholder="keyword..." aria-label="Search">

                                    <select class="select select-filter sel-search_by hide">
                                        <option disabled selected>Search by </option>
                                        <option value="0">All</option>
                                        <option value="1">Agency</option>
                                        <option value="2">Abbreviation</option>
                                    </select>

                                    <select class="select sel-filter chosen-select" data-placeholder="Filter" tabindex="-1" multiple="">
                                        <optgroup label="Status" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </optgroup>
                                        <optgroup label="Category" name="category">
                                            <option value="2">Government</option>
                                            <option value="1">Non Government</option>
                                        </optgroup>
                                    </select>

                                    <select class="select select-filter sel-orderby">
                                        <option value="0" disabled selected="">Order by</option>
                                        <option value="1" >Agency Name (A-Z)</option>
                                        <option value="2" >Agency Name (Z-A)</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="page-body-container" id="agency_listing" style=" margin-left: 30px;">
                            <div class="div-list">
                                <div class="card" style="background:#F5F6FA;">
                                    <div class="row">

                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <span>Agency</span>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 txt-align_center">
                                            <span>Status</span>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 txt-align_center">
                                            <span>Action</span>
                                        </div>
                                    </div>
                                </div>
                                <ul class="nav agency-list_content div-agencies-list"></ul>
                            </div>  
                            <div class="pagination-wrapper rs-list">
                                <div class="row">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <p class="pagination-details rs-info"></p>
                                    </div>
                                    <div class="col-lg-8 col-md-12 col-sm-12 text-right">
                                        <ul class="pagination rs-pagination">
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

<div class="modal fade show" id="mdl-view_agency" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <!--<span class="content-title" style="padding-top: 25px; margin-left:7%;"> Agency Details </span>-->
            <!--<small class="content-sub-title" style="margin-left: 7%;">Brief details of the case.</small>-->
            <div class="modal-header">
                <h5 class="modal-title h5-title msgmodal-header">Agency Details</h5>
            </div>
            <div class="modal-body pt-0">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="nav-data_list">
                            <div class="agency_details">
                                <div class="card card-img-loc">
                                    <img class='modal-img-details' src="" height="100px;" onerror="ifBrokenLogo(this);" style="float: left;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-6">
                        <div class="pt-4 ml-n5">
                            <span class="agency_name blue">Inter-Agency Council Against Trafficking ( IACAT )</span>
                            <br> <span class="">Non Government Agency</span>
                        </div>

                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="col-12" id="victim_list">
                            <div class="row-header">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-header"><span class="padding-l-10">Description </span></div>
                                </div>
                                <ul class=" list_content ">
                                    <li style="width:100%">
                                        <div class="card">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12"> 
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
                                    </li>
                                </ul>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn-close float-right" data-dismiss="modal"> Close </button>
            </div>
        </div>
    </div>
    <div class="modal-dialog modal-dialog-centered hide" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h5-title msgmodal-header">Agency Details</h5>
            </div>
            <div class="modal-body">
                <div class="container mdl-body_view_agency">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="card card-img-loc">
                                <!--test-->
                                <img class='modal-img-details' src="" height="100px;" onerror="ifBrokenLogo(this);" style="float: left;">
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <span class="desc_name lbl-agency_abbr" >  IACAT </span><br>
                            <span class="desc_name lbl-agency_name" >  Inter-Agency Council Against Trafficking   </span>
                            <br> <span class="desc_sub_name lbl-agency_typ" > Non Government</span>
                            <br> <span class="desc_agency_description"> 
                            </span>

                            <!--                            <h5 class="text-center lbl-agency_name" >-</h5>
                                                        <p class="content lbl-agency_abbr"> - </p>
                                                        <p class="content lbl-agency_status"> - </p>
                                                        <p class=" lbl-agency_type"> - </p>-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">



                                <div class="tile_description">
                                    <span>Description</span>
                                </div>
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



                    <!--                    <div class="text-center">
                                            <img class='modal-img-details' src="" height="100px;" onerror="ifBrokenLogo(this);" style="float: left;">
                                        </div>
                                        <h5 class="text-center lbl-agency_name" >-</h5>
                                        <p class="content lbl-agency_abbr"> - </p>
                                        <p class="content lbl-agency_status"> - </p>
                                        <p class=" lbl-agency_type"> - </p>-->



                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">  
                            <!--<p class="desc lbl-agency_desc"> - </p>-->
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn  btn-cancel btn-modal-cancel btn-close" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary-orange hide">Manage</button>
            </div>
        </div>
    </div>
</div>

<!-- End View Agency Modal -->


<!-- Update Agency Modal -->

<div class="modal fade show" id="mdl-manage_agency" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--<h5 class="modal-title">Manage Agency Details</h5>-->
                <p class="content-title" style="text-align:center;">Manage Agency Details</p>

            </div>
            <div class="modal-body">
                <div class="container mdl-body_view_agency">

                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <div class="form-group">
                                    <!--<label style=" color: #343a40;">Agency Logo</label>-->
                                    <div class="div-image modal-div-image text-center">
                                        <i class="fas fa-upload"></i>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control-file" id="imageselect">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12"></div> <label>Status </label>
                                    <select id="sel-status" name="sel_status" class="form-control">
                                        <option value="0">Inactive</option>
                                        <option value="1">Active</option>
                                    </select>
                                </div> 
                            </div>

                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <form id="frm-UpdateAgency" class=" form-update">
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <label>Agency Name </label>
                                            <input type="text" id="txt-agn-name" name="txt_name" class="form-control" placeholder="Ople Center">
                                        </div>
                                    </div>
                                    <div class="row"> 
                                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                            <label>Agency Name Abbreviation </label>
                                            <input type="text" maxlength="8" id="text-agn-abbr" name="txt_abbr" class="form-control text-uppercase" placeholder="Ople">
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
                                            <label>Description </label>
                                            <textarea name="area_desc" class="form-control" style="" id="description" ></textarea>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-cancel btn-modal-cancel btn-close" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary-orange btn-save" id="btn-save_manage">Save</button>
            </div>

        </div>
    </div>
</div>

<!-- End Update Agency Modal -->

<!-- END MODAL -->
