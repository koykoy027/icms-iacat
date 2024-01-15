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
                                    <p> Agency Branch List</p>
                                    <small class="card-desc"> List of all agency branch.  </small> 
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-12 col-sm-12"> 
                                <div class="list-action" style="float:right; margin-top: 20px;">
                                    <input class="txt_search" id="txt_search_agency_branch" type="search" placeholder="keyword..." aria-label="Search">

                                    <select class="select sel-filter" id="sel-filterby" data-placeholder="Filter" tabindex="-1" multiple=""></select>

                                    <select class="select select-filter" id="sel-orderby">
                                        <option value="0" disabled selected="">Order by</option>
                                        <option value="1" >Agency Name (A-Z)</option>
                                        <option value="2" >Agency Name (Z-A)</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="page-body-container" style=" margin-left: 30px;" id="agency_branch_list">

                            <div class="div-list">
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
                                <ul class="nav agency-list_content div-agencies-list ">
<!--                                    <li class="hide" style="width:100% ">
                                        <div class="card" style="   ">
                                            <div class="row">
                                                <div class="col-lg-8 col-md-8 ">
                                                    <div class="row nav-data_list">
                                                        <div class="col-lg-2 data_list_img">
                                                            <div class="img_content"> <img src="http://administrator.dev.icms.com/assets/global/images/logo-default.png" onerror="ifBrokenLogo(this);"> </div>
                                                        </div>
                                                        <div class="col-lg-10 test2 desc_content">
                                                            <div class="agency_details">
                                                                <span class="content-title">Ermita Metro Manila   |  </span> <span style="color: #e88f15"> Main Branch </span> 
                                                                <br> <span style="color:  #356397;">  Inter-Agency Council Against Trafficking     (IACAT)   </span> <br>
                                                                <span style="color:#495057;"><span style="text-transform:capitalize"> sample branch address Kabulusan Magallanes Cavite Region IV-A (Calabarzon) Philippines</span><br>
                                                                    <span class="txt-light">(02) 523 8481  | 02) 523 8481 </span><br> <span class="txt-light">jaycee@s2-tech.com</span>

                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-2 txt-align_center"> <span class="stat_"  >Active</span> </div>
                                                <div class="col-lg-2 col-md-2 txt-align_center">
                                                    <div class="btn-group ellipse-action " data-id="iZb0XWIqBZQwFs5XJsRXJH0U85Ew87sM9M5GPC0bVusQiCY3Q5l">
                                                        <a class="a-ellipse a-ellipse-iZb0XWIqBZQwFs5XJsRXJH0U85Ew87sM9M5GPC0bVusQiCY3Q5l action_btn"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </a>
                                                        <div class="action-menu" data-cur-stat="1" id="" data-logo="http://dev.icms.com/drive/file/" style="display: none;">
                                                            <a class="dropdown-item disabled action-title" href="#">Select Action</a>
                                                            <a class="dropdown-item a-view_agency" attr-id="" attr-type="Non Government" attr-name="Inter-Agency Council Against Trafficking" attr-status="Active" attr-abbr="IACAT">View Agency Details</a> 
                                                            <a class="dropdown-item a-manage_agency" attr-id="" attr-type="1"  attr-status="1"> Manage Agency Details</a> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>-->
                                </ul>



                            </div>  
                            <div class="pagination-wrapper rs-list">
                                <div class="row">
                                    <div class="col m12 s12 l4">
                                        <p class="pagination-details rs-info"></p>
                                    </div>
                                    <div class="col m12 s12 l8 text-right">
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


<div class="modal fade show" id="mdl-view_agency1" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content mdl-view-details-lg">
            <div class="modal-header">
                <h5 class="modal-title h5-title msgmodal-header">Agency Details</h5>
            </div>
            <div class="modal-body pt-0">
                <div class="container mdl-body_view_details">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card card-img-loc">
                                <!--test-->
                                <img class='modal-img-details' src="" height="100px;" onerror="ifBrokenLogo(this);" style="float: left;">
                            </div>
                        </div>
                        <div class="col-lg-8 p-3">
                            <span class="desc_name lbl-agency_abbr" >  IACAT </span><br>
                            <span class="desc_name lbl-agency_name" >  Inter-Agency Council Against Trafficking   </span>
                            <br> <span class="desc_sub_name lbl-agency_typ" > Non Government</span>
                            <br> <span class="desc_agency_description"> 
                            </span>
                        </div>
                    </div>
                    <div class="row p-2">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="tile_description">
                                    <span>Contact Person</span>
                                </div>
                                <div class="li-contact-person">
                                    <span>Annalyn Ayop</span><br>
                                    <span>Supervisor</span><br>
                                    <span> +6831091231221</span><br>
                                    <span>ayop@gmail.com</span>
                                </div>
                                <div class="li-contact-person">
                                    <span>Annalyn Ayop</span><br>
                                    <span>Supervisor</span><br>
                                    <span> +6831091231221</span><br>
                                    <span>ayop@gmail.com</span>
                                </div>

                                <!--                                <div class="lbl-agency_desc">
                                                                    The Inter-Agency Council Against Trafficking (IACAT) is the body mandated by law to coordinate and 
                                                                    monitor the implementation of Republic Act No. 9208, or the Anti-Trafficking in Persons Act of 2003,
                                                                    with the Department of justice as the lead agency. It was formed under section 20 of R.A. 9208, and is 
                                                                    composed of the following government agencies and non-government sectoral representatives:
                                
                                                                    The IACAT conducts many different projects geared towards the elimination of trafficking in persons in the Philippines, prevention of 
                                                                    the occurrence of trafficking, the protection and rehabilitation of victims and conviction of trafficking offenders.
                                                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn  btn-cancel btn-modal-cancel btn-close" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary-orange ">Manage</button>
            </div>
        </div>
    </div>
</div>