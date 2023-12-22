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
<div class="page-content-inner ">
    <div class="content-body">    
        <div class="card" >
            <div class="content-body-container" >
                <div class=" card-stats-inner p-2" >
                    <div class="row"> 
                        <div class="col-lg-5 col-md-12 col-sm-12"> 
                            <div class="card-title">
                                <p> Agency Branch List</p>
                                <small class="card-desc"> List of all agency branch.  </small> 
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-12 col-sm-12"> 
                            <div class="list-action   mb-3">
                                <input class="txt_search" id="txt_search_agency_branch" type="search" placeholder="keyword..." aria-label="Search">
                                <div class="d-inline-block pl-1 filter-list">
                                    <button type="button" class="btn btn-secondary-light_blue  btn-quick-actions " data-target="dropdownnotifyButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Filter <i class="fas fa-angle-down pl-3"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown_filter shadow pb-0" id="dropdownnotifyButton" x-placement="bottom-start">
                                        <a class="dropdown-item disabled action-title px-2" href="#">Filter By</a>
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
                                                Branch
                                            </li>
                                            <li class="list-group-item">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input chk-filter" name="branch" type="checkbox" id="inlineCheckbox1" value="1">
                                                    <label class="form-check-label" for="0">Main Branch</label>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input chk-filter" name="branch" type="checkbox" id="inlineCheckbox3" value="0" >
                                                    <label class="form-check-label" for="2"> Sub Branch</label>
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
                                    <div class="dropdown-menu dropdown_filter shadow pb-0 dropdown--order_by" id="dropdownnotifyButton1" x-placement="bottom-start">
                                        <a class="dropdown-item disabled action-title px-2" href="#" >Order by</a>
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
                    <div class="page-body-container ml-4"  id="agency_branch_list">

                        <div class="div-list">
                            <div class="row-header-border">
                                <div class="card" style="background:#F5F6FA;">
                                    <div class="row">
                                        <div class="col-8">
                                            <span>Agency</span>
                                        </div>
                                        <div class="col-2 txt-align_center">
                                            <span>Status</span>
                                        </div>
                                        <div class="col-2 txt-align_center">
                                            <span>Action</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-------------Loading Empty Placeholder for list  ------------>
                            <ul class="nav agency-list_content filter_load_placeholder"> </ul>
                            <!-------------------------------------------------------------->
                            <!-------------Loading Empty Placeholder for list  ------------>
                            <div  class="search_load_placeholder"> </div>
                            <!-------------------------------------------------------------->

                            <ul class="nav agency-list_content div-agencies-list "></ul>
                        </div>  
                        <div class="pagination-wrapper rs-list mt-3">
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



