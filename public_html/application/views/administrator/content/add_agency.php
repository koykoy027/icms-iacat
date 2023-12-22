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
                <div class="col-lg-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card" >
                        <div class="div-container">
                            <div class="div-agency-container">
                                <div class="row"> 

                                    <div class="col-lg-12 col-md-12 col-sm-12 card-title ml-0 mt-2"> 
                                        <p class="stat-header mb-0">Agency Details</p>
                                        <!--<p> Add Agency</p>-->
                                        <small class="card-desc"> Add new agency and its details. </small> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="tbl-container">
                                            <form id="frm-add-agency">
                                                <div class="container-inner  bg-white">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class=" ">
                                                                <span class="text-left content-title">Agency Logo <font color="red"> <b>*</b> </font></span>
                                                            </div>
                                                            <div class="card">
                                                                <div class="row" >
                                                                    <div class="form-group col-lg-12  div-image shadow-sm">
                                                                        <div class="card-body text-center p-5" id="fileupload_div">
                                                                            <i class="fas fa-upload text-gray-500"></i><br>
                                                                            <span class="small text-gray-500 mgn-T-18">Choose file to upload.<br>(5MB max. image size)</span>
                                                                        </div>
                                                                        <div class="card-body text-center p-5" id="fileupload_preview" style="display: none;"> 
                                                                             <img id="logo-preview" src="" height="100px;" onerror="ifBrokenLogo(this);">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 px-0"> 
                                                                        <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control-file badge-light item-img" id="imageselect" name="imageselect">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-12">
                                                            <div class=" ">
                                                                <span class="text-left content-title">Agency Details</span>
                                                                <p class="content-sub-title">Agency details form and description for agency.</p>
                                                            </div>
                                                            <div class="card">
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Agency Name <font color="red"> <b>*</b> </font> </label>
                                                                        <input type="text" data-exist="0" minlength="5" maxlength="70" id="txt-agn-name" name="txt_name"  class="form-control letNumDash inp-agn-name" placeholder="ex. OPLE Center" required>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                                                        <label>Agency Name Abbreviation  <font color="red"> <b>*</b> </font></label>
                                                                        <input type="text" maxlength="8" minlength="2" id="text-agn-abbr"  name="txt_abbr"  class="form-control lettersOnly text-uppercase" placeholder="ex. OPLE" required >
                                                                    </div>
                                                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                                                        <label>Category</label>
                                                                        <select id="sel-category" name="sel_category" class="form-control">

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                                                        <label>Description  <font color="red"> <b>*</b> </font> </label>
                                                                        <textarea name="area_desc" maxlength="1000" class="form-control textarea-xl" id="description" rows="5" cols="" placeholder="Insert agency description here (1000 characters)"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="content-footer float-right">
                                                    <button type="button" class="btn btn_save_agency btn-add-agency btn-save">Add Agency</button>
                                                </div>
                                            </form>
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
        </div>
    </div>
</div>
<!--End Modal-->