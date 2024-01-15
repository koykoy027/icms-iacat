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
                <div class="col-12">
                    <div class="card" >
                        <div class="div-container">
                            <div class="div-agency-container">
                                <div class="row"> 

                                    <div class="col-6 card-title ml-0"> 
                                        <p> Add Agency</p>
                                        <small class="card-desc"> Create new agency and add details. </small> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="tbl-container">
                                            <form id="frm-add-agency">
                                                <div class="container-inner  bg-white">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-m-12">
                                                            <div class=" ">
                                                                <span class="text-left content-title">Agency Logo</span>
                                                            </div>
                                                            <div class="card">
                                                                <div class="row" >
                                                                    <div class="form-group col-lg-12 div-image shadow">
                                                                        <div class="card-body text-center" style="padding: 50px 20px;">
                                                                            <i class="fas fa-upload text-gray-500"></i><br>
                                                                            <span class="small text-gray-500 mgn-T-18">Click choose file button to select image.</span>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12"><br>
                                                                        <label for="imageselect" >Select Photo</label>
                                                                        <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control-file badge-light" id="imageselect">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-lg-8 col-m-12">
                                                            <div class=" ">
                                                                <span class="text-left content-title">Agency Details</span>
                                                                <p class="content-sub-title">Agency details form and description for agency.</p>
                                                            </div>
                                                            <div class="card">
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12">
                                                                        <label>Agency Name </label>
                                                                        <input type="text" id="txt-agn-name" name="txt_name"  class="form-control" placeholder="ex. OPLE Center" >
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-6">
                                                                        <label>Agency Name Abbreviation </label>
                                                                        <input type="text" maxlength="8" id="text-agn-abbr"  name="txt_abbr"  class="form-control text-uppercase" placeholder="ex. OPLE" >
                                                                    </div>
                                                                    <div class="form-group col-lg-6">
                                                                        <label>Category</label>
                                                                        <select id="sel-category" name="sel_category" class="form-control">

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-lg-12">
                                                                        <label>Description </label>
                                                                        <textarea name="area_desc" class="form-control" style="height: 230px! important;" id="description" rows="5" cols="" placeholder="Insert agency description here ..."></textarea>
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
