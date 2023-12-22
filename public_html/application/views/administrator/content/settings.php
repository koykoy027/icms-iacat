<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content">
    <!-- BEGIN PAGE CONTENT INNER -->
    <div class="page-content-inner ">
        <div class="mt-content-body">
            <div class="row container-padding" >
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card" > 
                        <div class="card-title">
                            <p> Settings Page</p>
                            <small class="card-desc"> Add or update settings or global parameter  </small> 
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="settings_content ">
                                    <ul class="nav setting-ul" id="myTab">
                                        <li class="nav-item nav-inner-item">
                                            <a class="nav-link active nav-tab" id="case-tab" data-toggle="tab" href="#div_globaldata">Global Data</a>
                                        </li>
                                        <li class="nav-item nav-inner-item">
                                            <a class="nav-link nav-tab" id="ph-port-tab" data-toggle="tab" href="#div_phPort">Philippine Ports</a>
                                        </li>
                                        <li class="nav-item nav-inner-item">
                                            <a class="nav-link nav-tab" id="data-dictionary-tab" data-toggle="tab" href="#div_data_dictionary">Data Dictionary</a>
                                        </li>
                                        <li class="nav-item nav-inner-item">
                                            <a class="nav-link nav-tab" id="tip-details-tab" data-toggle="tab" href="#div_data_tip_details">TIP Category</a>
                                        </li>
                                        <li class="nav-item nav-inner-item">
                                            <a class="nav-link nav-tab" id="services-tab" data-toggle="tab" href="#div_data_services">Services</a>
                                        </li>
                                        <li class="nav-item nav-inner-item"style="display: none">
                                            <a class="nav-link nav-tab" id="restriction-tab" data-toggle="tab" href="#div_restriction">Restriction</a>
                                        </li>
                                    </ul>
                                    <div class=" card-stats-inner">
                                        <div class="tab-content" id="myTabContent">

                                            <div class="tab-pane fade show active" id="div_globaldata" role="tabpanel" aria-labelledby="recent-case-tab">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 gbl-data-list" >
                                                        <div class="card-title">
                                                            <span class="text-left content-title"><a>Global Data List</a></span><br>
                                                            <small class="content-desc">List of Global Parameter</small>
                                                        </div>
                                                        <hr>
                                                        <div class="nav flex-column global-ul nav-pills list-globaldata v-pills-tab"  role="tablist" aria-orientation="vertical">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9">
                                                        <div class="tab-content" id="v-pills-tabContent">
                                                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                                <div class="row">
                                                                    <div class="col-lg-4 col-md-12 col-sm-12" >
                                                                        <div class="case-title"> 
                                                                            <h4 class="border-0 inp-title lbl-global_data-title mb-4" type="text"> Global Data Title here</h4> 
                                                                            <input class="border-0 inp-title noTyping" type="text" id="global_data-title" value="Global Data Title here"  style="display: none;"> 
                                                                            <input class="border-0 inp-description noTyping" type="text" id="global_data-description" value="Global Data Title here" style="display: none;">
                                                                            <a href="#" id="bnt-save_global_desc" class="hide">
                                                                                <span class="badge badge-primary">SAVE</span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-8 col-md-12 col-sm-12 mb-3" >
                                                                        <div class="text-right">
                                                                            <a href="#" class="btn add-setting-btn btn-secondary-light_blue" role="button" id="btn-add_global_data" data-toggle="modal" data-target="#mdl-create_global_data">
                                                                                <i class="fa fa-plus"></i> Add 
                                                                                <span class="lbl-global_data-title">-</span> 
                                                                            </a>                                                                           
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--                                                                <div class="form-group pull-right">
                                                                                                                                    <a href="#" class="btn add-setting-btn btn-secondary-light_blue" role="button" id="btn-add_global_data" data-toggle="modal" data-target="#mdl-create_global_data">
                                                                                                                                        <i class="fa fa-plus"></i> Add 
                                                                                                                                        <span class="lbl-global_data-title">-</span> 
                                                                                                                                    </a>
                                                                                                                                </div>-->
<!--                                                                <p class="case-title"> 
                                                                    <input class="border-0 inp-title noTyping" type="text" id="global_data-title" value="Global Data Title here"> <br>
                                                                    <input class="border-0 inp-description noTyping" type="text" id="global_data-description" value="Global Data Title here" style="display: none;">
                                                                    <br>
                                                                    <a href="#" id="bnt-save_global_desc" class="hide">
                                                                        <span class="badge badge-primary">SAVE</span>
                                                                    </a>
                                                                </p>-->

                                                                <div class="tbl-settings">
                                                                    <div class="row mb-3">
                                                                        <div class="col-5 offset-7">
                                                                            <input class="form-control" type="search" id="inp-gbl-search" placeholder="Search" value="">
                                                                        </div>
                                                                    </div>
                                                                    <table class="table" id="tbl-global_data">
                                                                        <thead class="row-header-border">
                                                                            <tr class="cases-info">
                                                                                <th>Name</th>
                                                                                <th>Status</th>
                                                                                <th>Manage</th>

                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="tbody-global_data">
                                                                            <tr class="tbody-details">
                                                                                <td>-</td>
                                                                                <td>-</td>
                                                                                <td>
                                                                                    <button class="btn btn-manage" data-toggle="modal" data-target="#"><i class="fas fa-ellipsis-v"></i></button>
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
                                            <!--END CREATED CASE TAB-->


                                            <!--PH ports-->
                                            <div class="tab-pane fade" id="div_phPort" role="tabpanel" aria-labelledby="recent-case-tab">
                                                <div class="tbl-settings">
                                                    <div class="row" >
                                                        <div class="col-lg-4 col-md-4 col-sm-12" >
                                                            <div class="card-title">
                                                                <span class="text-left content-title"><a>Philippine Ports</a></span><br>
                                                                <!--<small class="content-desc">Description goes here </small>-->
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-12 p1rem" >
                                                            <div class="text-right">
                                                                <input class="txt_search inp-search" id="search-port" type="search" placeholder="search..." aria-label="Search">
                                                                <a href="#" class="btn btn-add-ph-port btn-secondary-light_blue" role="button" id="btn-add-port">
                                                                    <i class="fas fa-plus"></i> Add Port 
                                                                </a> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="tbl-cnt-portList">
                                                        <table id="portList" class="table" >
                                                            <thead>
                                                                <tr class="cases-info">
                                                                    <th>Port Details</th>
                                                                    <th>Status</th>
                                                                    <th>Action</th>                           
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tbody class = "tbodyPortList">
                                                            </tbody>
                                                        </table>

                                                        <div class="pagination-wrapper rs-list-port">
                                                            <div class="row">
                                                                <div class="col m12 s12 l4">
                                                                    <p class="pagination-details rs-info-port"></p>
                                                                </div>
                                                                <div class="col m12 s12 l8 text-right">
                                                                    <ul class="pagination rs-pagination-port">
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                            <!--END PH port-->


                                            <!--Data Dictionary-->
                                            <div class="tab-pane fade" id="div_data_dictionary" role="tabpanel" aria-labelledby="recent-case-tab">
                                                <div class="tbl-data-dnry">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-12" >
                                                            <div class="card-title" >
                                                                <span class="text-left content-title"><a> Data Dictionary</a></span><br>
                                                                <!--<small class="content-desc">Description goes here </small>-->
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-12 p1rem" >
                                                            <div class="text-right">
                                                                <input class="txt_search  inp-search" id="inp-dictionary_search" type="search" placeholder="search..." aria-label="Search">

                                                                <a href="#" class="btn btn-add-term btn-secondary-light_blue " role="button" id="btn-add-data-dictionary">
                                                                    <i class="fas fa-plus"></i> Add Term
                                                                </a> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tbl-settings" id="tbl-cnt-dataDictionaryList">
                                                    <table id="dataDictionaryList" class="table" >
                                                        <thead>
                                                            <tr class="cases-info">
                                                                <th>Term</th>
                                                                <th>Status</th>
                                                                <th>Action</th>                        
                                                            </tr>
                                                        </thead>
                                                        <tbody class = "tbodyDataDictionary">
                                                        </tbody>
                                                    </table>

                                                    <div class="pagination-wrapper rs-list-datadictionary">
                                                        <div class="row">
                                                            <div class="col m12 s12 l4">
                                                                <p class="pagination-details rs-info-datadictionary"></p>
                                                            </div>
                                                            <div class="col m12 s12 l8 text-right">
                                                                <ul class="pagination rs-pagination-datadictionary">
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                            <!--END PH port-->

                                            <!--TIP Details-->
                                            <div class="tab-pane fade" id="div_data_tip_details" role="tabpanel" aria-labelledby="tip-details-tab">
                                                <div class="row ">
                                                    <div class="col-lg-3 col-md-3 col-sm-3  gbl-data-list" >
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                                                                <div class="card-title"  >
                                                                    <span class="text-left content-title"><a> TIP Details Data List</a></span><br>
                                                                    <small class="content-desc">List of TIP Details </small>
                                                                </div>
                                                            </div>
                                                        </div><hr>
                                                        <div class="nav flex-column nav-pills list-tip_details v-pills-tab"  role="tablist" aria-orientation="vertical">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9">
                                                        <div class="tab-content">
                                                            <div class="tab-pane fade show active"  role="tabpanel" aria-labelledby="v-pills-home-tab">

                                                                <div class="row">
                                                                    <!--                                                                    <div class="col-lg-4 col-md-4 col-sm-12" >
                                                                                                                                            <div class="card-title" >
                                                                                                                                                <span id="tip_details-title"></span><br>
                                                                                                                                                <small id="tip_details-description"> </small>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                        <div class="col-lg-8 col-md-8 col-sm-12" style=" margin-top: 2rem;">
                                                                                                                                            <div class="text-right">
                                                                                                                                                <input class="txt_search  inp-search" id="inp-tip_category" type="search" placeholder="search..." aria-label="Search">
                                                                    
                                                                                                                                                <a href="#" class="btn btn-secondary-light_blue add-setting-btn" role="button" id="btn-add_tip_details" data-toggle="modal" data-target="#mdl-create_tip_details">
                                                                                                                                                    <i class="fas fa-plus"></i> Add Term
                                                                                                                                                </a> 
                                                                                                                                            </div>
                                                                                                                                        </div>-->

                                                                    <div class="tbl-data-dnry">
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-md-2 col-sm-12" >
                                                                                <div class="card-title" >
                                                                                    <span id="tip_details-title"></span><br>
                                                                                    <small id="tip_details-description" style="display: none"></small>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-8 col-md-10 col-sm-12 mb-3" >
                                                                                <div class="text-right">
                                                                                    <input class="txt_search  inp-search" id="inp-tip_category" type="search" placeholder="search..." aria-label="Search">

                                                                                    <a href="#" class="btn btn-secondary-light_blue btn-add-term" role="button" id="btn-add_tip_details" data-toggle="modal" data-target="#mdl-create_tip_details">
                                                                                        <i class="fas fa-plus"></i> Add Term
                                                                                    </a> 
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tbl-settings" id="tbl-cnt-tip_category">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr class="cases-info">
                                                                                <th>Name</th>
                                                                                <th>Status</th>
                                                                                <th>Manage</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="tbody-tipcategory">
                                                                        </tbody>
                                                                    </table>

                                                                    <div class="pagination-wrapper rs-list-tip_category">
                                                                        <div class="row">
                                                                            <div class="col m12 s12 l4">
                                                                                <p class="pagination-details rs-info-tip_category"></p>
                                                                            </div>
                                                                            <div class="col m12 s12 l8 text-right">
                                                                                <ul class="pagination rs-pagination-tip_category">
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
                                            <!--TIP Details End-->

                                            <!--TAGGED CASE-->
                                            <div class="tab-pane fade" id="div_newtab" role="tabpanel" aria-labelledby="recent-case-tab">
                                                <p class="case-title"> Title here <br><small>Description here</small></p>
                                                <div class="form-group pull-right">
                                                    <a href="#" class="btn add-case" role="button"><i class="fas fa-plus-circle"></i> Create Sample hee</a>
                                                </div>

                                                <div class="tbl-settings">
                                                    <div class="row filter-row">
                                                        <div class="col-3">
                                                            <div class="input-form"> 
                                                                <input class="form-control mr-sm-1 inp-search " type="search" placeholder="Search" aria-label="Search">
                                                            </div>
                                                        </div> &nbsp;
                                                        <br>
                                                        <div class="col-2">
                                                            <select class="form-control form-control-sm filter">
                                                                <option>Choose your filter</option>
                                                                <option></option>
                                                                <option></option>
                                                                <option></option>
                                                            </select>
                                                        </div>
                                                        <div class="col-2">
                                                            <select class="form-control form-control-sm sortBy">
                                                                <option>Choose your filter</option>
                                                                <option></option>
                                                                <option></option>
                                                                <option></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <table id="caseList" class="table" >
                                                        <thead>
                                                            <tr class="cases-info">
                                                                <th>Name</th>
                                                                <th>Acts</th>
                                                                <th>Means</th>
                                                                <th>Purpose</th>
                                                                <th>Priority</th>
                                                                <th>Case Age</th>
                                                                <th>Agency</th>
                                                                <th>Action</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="case-details">
                                                                <td>Kimberly Bado</td>
                                                                <td>Lorem Ipsum</td>
                                                                <td>Lorem Ipsum</td>
                                                                <td>Lorem Ipsum</td>
                                                                <td><span class="badge badge-pill badge-warning pending"></span>&nbsp;Pending</td>
                                                                <td>Lorem Ipsum</td>
                                                                <td class="agency-name">DOLE</td>
                                                                <td><button class="btn btn-manage" data-toggle="modal" data-target="#"><i class="fas fa-ellipsis-v"></i></button></td>
                                                            </tr> 
                                                            <tr class="case-details">
                                                                <td>Kimberly Bado</td>
                                                                <td>Lorem Ipsum</td>
                                                                <td>Lorem Ipsum</td>
                                                                <td>Lorem Ipsum</td>
                                                                <td><span class="badge badge-pill badge-warning pending"></span>&nbsp;Pending</td>
                                                                <td>Lorem Ipsum</td>
                                                                <td class="agency-name">DOLE</td>
                                                                <td><button class="btn btn-manage" data-toggle="modal" data-target="#"><i class="fas fa-ellipsis-v"></i></button></td>
                                                            </tr> 
                                                            <tr class="case-details">
                                                                <td>Kimberly Bado</td>
                                                                <td>Lorem Ipsum</td>
                                                                <td>Lorem Ipsum</td>
                                                                <td>Lorem Ipsum</td>
                                                                <td><span class="badge badge-pill badge-warning pending"></span>&nbsp;Pending</td>
                                                                <td>Lorem Ipsum</td>
                                                                <td class="agency-name">DOLE</td>
                                                                <td><button class="btn btn-manage" data-toggle="modal" data-target="#"><i class="fas fa-ellipsis-v"></i></button></td>
                                                            </tr> 

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!--END TAGGED CASE-->


                                            <!--PH ports-->
                                            <div class="tab-pane fade" id="div_restriction" role="tabpanel" aria-labelledby="recent-case-tab">

                                                <div class="tbl-settings">
                                                    <div class="row" >
                                                        <div class="col-lg-4 col-md-4 col-sm-12" style=" padding-top: 20px;">

                                                            <div class="card-title"  style=" margin-left: 0px! important; margin-top:0px;">
                                                                <p> Restriction </p>
                                                                <small class="card-desc"> Description goes here  </small> 
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="div-list">
                                                        <div class=" row-header-border">
                                                            <div class="card" style="background:#F5F6FA;">
                                                                <div class="row ">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <span>List of Agency</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <ul class="nav list_content">
                                                            <li style="width:100%" data-toggle="modal" data-target="#mdl-resctriction">
                                                                <div class="card" >
                                                                    <div class="row">
                                                                        <div class="col-lg-7 col-md-7 col-sm-7 align-items-center ">  <span style="text-transform:capitalize" class="desc_name"> Department of the Interior and Local Government (DILG)</span> </div> 
                                                                        <div class="col-lg-3 col-md-3 col-sm-3 txt-align_center d-flex align-items-center justify-content-center"><span>Government</span> </div>
                                                                        <div class="col-lg-2 col-md-2 col-sm-2 txt-align_center d-flex align-items-center justify-content-center"> <span class="stat_">Active</span> </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li style="width:100%" data-toggle="modal" data-target="#mdl-resctriction">
                                                                <div class="card" >
                                                                    <div class="row">
                                                                        <div class="col-lg-7 col-md-7 col-sm-7 align-items-center ">  <span style="text-transform:capitalize" class="desc_name"> Philippine Overseas Labor Office (POLO)</span> </div> 
                                                                        <div class="col-lg-3 col-md-3 col-sm-3 txt-align_center d-flex align-items-center justify-content-center"><span>Government</span> </div>
                                                                        <div class="col-lg-2 col-md-2 col-sm-2 txt-align_center d-flex align-items-center justify-content-center"> <span class="stat_">Active</span> </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li style="width:100%" data-toggle="modal" data-target="#mdl-resctriction">
                                                                <div class="card" >
                                                                    <div class="row">
                                                                        <div class="col-lg-7 col-md-7 col-sm-7 align-items-center ">  <span style="text-transform:capitalize" class="desc_name">Bureau of Immigration (BI) </span> </div> 
                                                                        <div class="col-lg-3 col-md-3 col-sm-3 txt-align_center d-flex align-items-center justify-content-center"><span>Government</span> </div>
                                                                        <div class="col-lg-2 col-md-2 col-sm-2 txt-align_center d-flex align-items-center justify-content-center"> <span class="stat_">Active</span> </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li style="width:100%" data-toggle="modal" data-target="#mdl-resctriction">
                                                                <div class="card" >
                                                                    <div class="row">
                                                                        <div class="col-lg-7 col-md-7 col-sm-7 align-items-center ">  <span style="text-transform:capitalize" class="desc_name"> Department of Foreign Affairs (DFA)</span> </div> 
                                                                        <div class="col-lg-3 col-md-3 col-sm-3 txt-align_center d-flex align-items-center justify-content-center"><span>Government</span> </div>
                                                                        <div class="col-lg-2 col-md-2 col-sm-2 txt-align_center d-flex align-items-center justify-content-center"> <span class="stat_">Active</span> </div>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                        </ul>
                                                    </div> 
                                                </div>
                                            </div>
                                            <!--END PH port-->

                                            <!--Services-->
                                            <div class="tab-pane fade" id="div_data_services" role="tabpanel" aria-labelledby="services-tab">

                                                <div class="row ">
                                                    <div class="col-3 gbl-data-list" id="services_type_list">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                                                                <div class="card-title" >
                                                                    <p> Services Category List </p>
                                                                    <small class="card-desc"> List of Service Category Details </small> 
                                                                </div>
                                                            </div>  
                                                        </div><hr>
                                                        <div class="nav flex-column nav-pills list-category_services v-pills-tab"  role="tablist" aria-orientation="vertical">
                                                        </div>
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="tab-content">
                                                            <div class="tab-pane fade show active"  role="tabpanel" aria-labelledby="v-pills-home-tab">

                                                                <!--                                                                <div class="row">
                                                                                                                                    <div class="col-lg-4 col-md-4 col-sm-12" style=" padding-top: 20px;">
                                                                                                                                        <div class="card-title" style=" margin-left: 0px! important; margin-top:0px;">
                                                                                                                                            <p id="service-title"></p>
                                                                                                                                            <small class="card-desc" id="service-description"></small> 
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                    <div class="col-lg-8 col-md-8 col-sm-12" style=" margin-top: 2rem;">
                                                                                                                                        <div class="text-right">
                                                                                                                                            <input class="txt_search  inp-search" id="inp-services" type="search" placeholder="search..." aria-label="Search">
                                                                                                                                            <a href="#" class="btn btn-secondary-light_blue add-setting-btn" role="button" id="btn-add_service" data-toggle="modal" data-target="#mdl-add_services">
                                                                                                                                                <i class="fa fa-plus"></i> Add 
                                                                                                                                                <span class="lbl-service-title">-</span> 
                                                                                                                                            </a>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>-->
                                                                <div class="row">
                                                                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" >
                                                                        <div class="card-title" >
                                                                            <span class="text-left content-title" id="service-title"></span><br>
                                                                            <small class="content-desc" id="service-description" style="display: none"> </small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-8 col-md-12 col-sm-12 mb-3" >
                                                                        <div class="text-right">
                                                                            <input class="txt_search  inp-search" id="inp-services" type="search" placeholder="search..." aria-label="Search">

                                                                            <a href="#" class="btn btn-secondary-light_blue btn-add-term" role="button" id="btn-add_service" data-toggle="modal" data-target="#mdl-add_services">
                                                                                <i class="fa fa-plus"></i> Add 
                                                                                <span class="lbl-service-title">-</span> 
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tbl-settings" id="tbl-cnt-services">

                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr class="cases-info">
                                                                                <th>Name</th>
                                                                                <th>Service Type</th>
                                                                                <th>Number of Days</th>
                                                                                <th>Status</th>
                                                                                <th>Manage</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="tbody-services">
                                                                        </tbody>
                                                                    </table>

                                                                    <div class="pagination-wrapper rs-list-services">
                                                                        <div class="row">
                                                                            <div class="col m12 s12 l4">
                                                                                <p class="pagination-details rs-info-services"></p>
                                                                            </div>
                                                                            <div class="col m12 s12 l8 text-right">
                                                                                <ul class="pagination rs-pagination-services">
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

                                            <!--END services-->
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



<!-- Start Modal -->


<!-- Start Create Global Data -->
<div class="modal fade" id="mdl-create_global_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title "> Create <span class="lbl-global_data-title">-</span></h5>
            </div>
            <!--<span class="content-title" style="padding: 25px; margin-left: 17%;"> Create <span class="lbl-global_data-title">-</span>  </span>-->
            <div class="modal-body ">

                <form id="form-create_global_model">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Name <font color="red">*</font> </label>
                        <input  class="form-control" maxlength="100" id="inp-global_name" type="text" name="inp_global_name">
                        <label for="recipient-name" class="col-form-label">Status</label>
                        <select id="inp-global_status" class="form-control" name="inp_global_status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-save" id="btn-save_create_globa_model">Save</button>
            </div>
        </div>

    </div>
</div>   
<!-- End Create Global Data -->


<!-- Start Update  Global Data -->
<div class="modal fade" id="mdl-update_global_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title "> Manage <span class="lbl-global_data-title">-</span></h5>
            </div>
            <!--<span class="content-title" style="padding: 25px; margin-left: 17%;">Update <span class="lbl-global_data-title">-</span></span>-->
            <div class="modal-body ">

                <form id="form-update_global_model">
                    <div class="form-group">
                        <label for="inp-update-global_name" class="col-form-label">Name <font color="red">*</font></label>
                        <input  class="form-control" maxlength="100" id="inp-update-global_name" type="text" name="inp_update_global_name">
                        <label for="inp-update-global_status" class="col-form-label">Status</label>
                        <select id="inp-update-global_status" class="form-control" name="inp_update_global_status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-save" id="btn-save_update_globa_model">Save</button>
            </div>
        </div>

    </div>
</div>   
<!-- End Update Global Data -->

<!-- Start modal -->

<div class="modal fade" id="mdl-add_port" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title ">  Add Port </h5>
            </div>
            <!--<span class="content-title" style="padding: 25px; margin-left: 36%;"> Add Port </span>-->
            <div class="modal-body ">

                <form id = "form-add_port">
                    <div class="row">
                        <div class="form-group col-12">
                            <label> Port Name <font color="red">*</font></label>
                            <input type="text" maxlength="100" id = "name_port_name" class="form-control" type = "text" name = "name_port_name">
                        </div>
                    </div>

                    <!--  <div class="row">
                         <div class="form-group col-12">
                             <label> Location </label>
                             <input type="text" id = "name_address" class="form-control" name = "name_address" >
                         </div>
                     </div> -->
                    <div class="form-group grp-prov-state">
                        <label for="sel_ph_state_prov" class="col-form-label">Province / State <font color="red">*</font></label>
                        <select id="sel_ph_state_prov" name="sel_ph_state_prov" class="form-control">
                            <option>...</option>
                        </select>
                    </div>
                    <div class="form-group grp-city">
                        <label for="sel_ph_city" class="col-form-label">City <font color="red">*</font></label>
                        <select id="sel_ph_city" name="sel_ph_city" class="form-control">
                            <option>...</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label> Port Type </label>
                            <select id="inp-global_port_type" class="form-control" name="inp_global_port_type">
                                <option value="1">Airport</option>
                                <option value="2">Seaport</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <label> Port Status </label>
                            <select id="inp-global_port_status" class="form-control" name="inp_global_port_status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-save" id="btn_insert_port">Save</button>
            </div>
        </div> 
    </div>
</div>   
<!-- End modal -->


<!-- Start manage port modal -->

<div class="modal fade" id="mdl-manage_port" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title ">  Manage Port </h5>
            </div>
            <div class="modal-body ">

                <form id = "form-manage_port">
                    <div class="row">
                        <div class="form-group col-12">
                            <label> Port Name <font color="red">*</font> </label>
                            <input type="text" maxlength="100" id = "manage_port_name" class="form-control" type = "text" name = "manage_port_name">
                        </div>
                    </div>

                    <div class="form-group grp-prov-state">
                        <label for="sel_ph_manage_state_prov" class="col-form-label">Province <font color="red">*</font></label>
                        <select id="sel_ph_manage_state_prov" name="sel_ph_manage_state_prov" class="form-control">
                            <option>...</option>
                        </select>
                    </div>
                    <div class="form-group grp-city">
                        <label for="sel_manage_city" class="col-form-label">City <font color="red">*</font></label>
                        <select id="sel_manage_city" name="sel_manage_city" class="form-control">
                            <option>...</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <label> Port Type </label>
                            <select id="inp-manage_port_type" class="form-control" name="inp-manage_port_type">
                                <option value="1">Airport</option>
                                <option value="2">Seaport</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <label> Port Status </label>
                            <select id="inp-manage_port_status" class="form-control" name="inp-manage_port_status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-save" id="btn_update_port">Save</button>
            </div>
        </div> 
    </div>
</div>   
<!-- End manage port modal -->


<!-- Start data dictionary modal -->

<div class="modal fade" id="mdl-data_dictionary" tabindex="-1" role="dialog" aria-labelledby="dataDictionary" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title "> Manage Data Dictionary</h5>
            </div>
            <!--<span class="content-title" style="padding: 25px; margin-left: 30%;"> Edit Data Description </span>-->
            <div class="modal-body ">

                <form id = "form-data_dictionary">
                    <div class="row">
                        <div class="form-group col-12">
                            <label> Term </label>
                            <input type="text" maxlength="100" id = "manage_term" class="form-control" type = "text" name = "manage_term">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">

                            <label> Description </label>
                            <textarea class=" form-control data-desc_textarea" maxlength="1000" id = "manage_description" name = "manage_description" style="height: 175px! important;" rows="3" cols=""></textarea>
                        </div>    
                    </div>


                    <div class="row">
                        <div class="form-group col-12">
                            <label> Status </label>
                            <select id="inp-manage_term_status" class="form-control" name="inp-manage_term_status">
                                <option value="1">Show</option>
                                <option value="0">Hide</option>
                            </select>
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-save" id="btn_update_dictionary">Save</button>
            </div>
        </div> 
    </div>
</div>   
<!-- End manage port modal -->

<!-- Start Add Data Dictionary modal -->

<div class="modal fade" id="mdl-add_data_dictionary" tabindex="-1" role="dialog" aria-labelledby="dataDictionary" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title ">  Add Data Dictionary </h5>
            </div>
            <!--<span class="content-title" style="padding: 25px; margin-left: 30%;"> Add data dictionary </span>-->
            <div class="modal-body ">

                <form id = "form-add_data_dictionary">
                    <div class="row">
                        <div class="form-group col-12">
                            <label> Term </label>
                            <input type="text" maxlength="100" id = "add_term" class="form-control" type = "text" name = "add_term">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <label> Description </label>
                            <textarea class="data-add_desc_textarea form-control" maxlength="1000" id = "add_description" name = "add_description" style="height: 175px! important;" rows="3" cols=""></textarea>
                        </div>    
                    </div>


                    <div class="row">
                        <div class="form-group col-12">
                            <label> Status </label>
                            <select id="inp-add_term_status" class="form-control" name="inp-add_term_status">
                                <option value="1">Show</option>
                                <option value="0">Hide</option>
                            </select>
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-save" id="btn_add_dictionary">Save</button>
            </div>
        </div> 
    </div>
</div>   
<!-- End Add modal -->



<!-- Start Add TIP Details modal -->
<div class="modal fade" id="mdl-create_tip_details" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title msgmodal-header modal-header_title "> Add TIP Category</h5>
            </div>
            <div class="modal-body ">

                <form id = "form-add_tip_category">
                    <div class="row">
                        <div class="form-group col-12">
                            <label> Name </label>
                            <input type="text" maxlength="100" id = "add_tip_category_name" class="form-control" type = "text" name = "add_tip_category_name">
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="form-group col-12">
                            <label> Status </label>
                            <select id="add_tip_category_status" class="form-control" name="add_tip_category_status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-save" id="btn_add_tip_category">Save</button>
            </div>
        </div> 
    </div>
</div>   
<!-- End Add modal -->



<!-- Start Update TIP Details modal -->
<div class="modal fade" id="mdl-update_tip_details" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title msgmodal-header modal-header_title "> Update TIP Category</h5>
            </div>
            <div class="modal-body ">

                <form id = "form-update_tip_category">
                    <div class="row">
                        <div class="form-group col-12">
                            <label> Name </label>
                            <input type="text" maxlength="100" id = "update_tip_category_name" class="form-control" type = "text" name = "update_tip_category_name">
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="form-group col-12">
                            <label> Status </label>
                            <select id="update_tip_category_status" class="form-control" name="update_tip_category_status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-save" id="btn_update_tip_category">Save</button>
            </div>
        </div> 
    </div>
</div>   
<!-- End Update modal -->

<!-- Start Add Services  modal -->
<div class="modal fade" id="mdl-add_services" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title msgmodal-header modal-header_title "> Add Services</h5>
            </div>
            <div class="modal-body ">

                <form id = "form-add_services">
                    <div class="row">
                        <div class="form-group col-12">
                            <label> Name </label>
                            <input type="text" maxlength="100" id = "add_services_name" class="form-control" type = "text" name = "add_services_name">
                        </div>
                    </div>    
                    <div class="row">
                        <div class="form-group col-12">
                            <label> Service Type </label>
                            <select id="add_services_type" class="form-control sel_services_type" name="add_services_type">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label> Total of days  </label>
                            <input type="number" maxlength="5" id = "add_service_days" class="form-control" type = "text" name = "add_service_days">
                        </div>
                    </div>                   
                    <div class="row">
                        <div class="form-group col-12">
                            <label> Status </label>
                            <select id="add_services_status" class="form-control" name="add_services_status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-save" id="btn_add_services">Save</button>
            </div>
        </div> 
    </div>
</div>   
<!-- End Services modal -->

<!-- Start Update Services  modal -->
<div class="modal fade" id="mdl-update_services" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title msgmodal-header modal-header_title "> Update Services</h5>
            </div>
            <div class="modal-body">
                <form id = "form-update_services">
                    <div class="row">
                        <div class="form-group col-12">
                            <label> Name </label>
                            <input type="text" maxlength="100" id = "update_services_name" class="form-control" type = "text" name = "add_services_name">
                        </div>
                    </div>    
                    <div class="row">
                        <div class="form-group col-12">
                            <label> Service Type </label>
                            <select id="update_services_type" class="form-control sel_services_type" name="add_services_type">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label> Total of days  </label>
                            <input type="number" maxlength="5" id = "update_service_days" class="form-control" type = "text" name = "add_service_days">
                        </div>
                    </div>                   
                    <div class="row">
                        <div class="form-group col-12">
                            <label> Status </label>
                            <select id="update_services_status" class="form-control" name="add_services_status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-save" id="btn_update_services">Save</button>
            </div>
        </div> 
    </div>
</div>   
<!-- End Services modal -->

<!--RESTRICTION-->
<div class="modal fade bd-example-modal-lg" id="mdl-resctriction" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <span class="content-title" style="padding-top: 25px; margin-left:7%;"> Manage Restriction</span>
            <small class="content-sub-title" style="margin-left: 7%;">Manage restriction in every agency.</small>
            <div class="modal-body">
                <div class="inner-box matched_results ">
                    <div class="row form-row" style="background-color: #daebfb ;margin:0;">
                        <div class="my-2  pl-4 note_desc">
                            <span class="" style="font-size: 14px;">Note:</span><br>
                            <small class="">Switch off to restrict this module to this agency.</small>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="inner-box matched_contents">
                                <table class="table">
                                    <thead class="thead-grey">
                                        <tr>
                                            <th>Module Name</th>
                                            <th>Restrict</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Adding of Case</td>
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                                                    <label class="custom-control-label active" for="customSwitch1"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Updating of Case</td>
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch2">
                                                    <label class="custom-control-label active" for="customSwitch2"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Viewing of Legal Services</td>
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch3">
                                                    <label class="custom-control-label active" for="customSwitch3"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Viewing of Victim List</td>
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch4" checked>
                                                    <label class="custom-control-label active" for="customSwitch4"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Viewing of Recruitment Agency and Employer</td>
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch5">
                                                    <label class="custom-control-label active" for="customSwitch5"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Generate Report</td>
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch6">
                                                    <label class="custom-control-label active" for="customSwitch6"></label>
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

            <div class="modal-footer">
                <button type="button" class="btn btn-close btn-cancel float-right" data-dismiss="modal"> Close </button>        
            </div>

        </div>
    </div>
</div>     
