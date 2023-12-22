<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
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
                            <div class="div-agency">
                                <div class="row"> 
                                    <div class="col-6 card-title"> 
                                        Government Agencies <br> 
                                        <small class="card-desc"> List of all the department and agencies </small> 
                                    </div>
                                    <div class="col-6 form-group pull-right">
                                        <button class="btn icms-btn_primary tab-addagency" data-action="1" data-id="0" data-toggle="modal" data-target="#mdlCreateCase" type="submit"><i class="fas fa-plus-circle"></i> Create Case</button>
                                    </div>
                                </div>
                                <div class="content-box">
                                    <div class="tbl-container">
                                        <!-- <table id="agencyDTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead class="text-center">
                                                <tr>
                                                    <th class="th-sm">Logo</th>
                                                    <th class="th-sm">Agency Name </th>
                                                    <th class="th-sm">Email  </th>
                                                    <th class="th-sm">Admin</th>
                                                    <th class="th-sm">Telephone</th>
                                                    <th class="th-sm">Mobile no.</th>
                                                    <th class="th-sm">Status</th>
                                                    <th class="th-sm">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="tbody-agency-list">
                                            </tbody>
                                        </table>  -->

                                        <table  class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead class="text-center">
                                                <tr>
                                                    <th class="th-sm">Logo</th>
                                                    <th class="th-sm">Agency Name </th>
                                                    <th class="th-sm">Email  </th>
                                                    <th class="th-sm">Admin</th>
                                                    <th class="th-sm">Telephone</th>
                                                    <th class="th-sm">Mobile no.</th>
                                                    <th class="th-sm">Status</th>
                                                    <th class="th-sm">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="tbody-agency-list">
                                            </tbody>
                                        </table>    

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
                            <div class="div-addagency">
                                <div class="row"> 
                                    <div class="col-6 card-title"> 
                                        Government Agency Details<br> 
                                        <small class="card-desc">Form of Government Agency  Details</small> 
                                    </div>
                                    <div class="col-6 form-group pull-right">
                                        <button class="btn icms-btn_primary tab-addagency" data-action="1" data-id="0" data-toggle="modal" data-target="#mdlCreateCase" type="submit"><i class="fas fa-plus-circle"></i> Create Case</button>
                                    </div>
                                </div>
                                <div class="content-box">
                                    <form id="frm_agency">
                                        <div class="container"> 
                                            <div class="row">
                                                <div class="col-md-7 ">
                                                    <h5 class="card-title div-tab-title">Agency Details</h5>

                                                    <label for="txt_email" class="lbl">Agency </label>
                                                    <select class="browser-default custom-select sel_agency_type" name="opt_agency"></select>

                                                    <label for="txt_email" class="lbl">Email Address</label>
                                                    <input type="text" id="txt_email" name="txt_email" class="form-control">

                                                    <label for="txt_tel" class="lbl">Telephone Number</label>
                                                    <input type="text" id="txt_tel" name="txt_tel" class="form-control">

                                                    <label for="txt_mobile" class="lbl">Mobile Number</label>
                                                    <input type="text" id="txt_mobile" name="txt_mobile" class="form-control">

                                                    <label for="txt_desc" class="lbl">Description</label>
                                                    <input type="text" id="txt_desc" name="txt_desc" class="form-control">

                                                    <label for="txt_desc" class="lbl">Agency Logo</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFileLang" lang="es">
                                                        <label class="custom-file-label" for="customFileLang">Select Picture</label>
                                                    </div>

                                                    <button type="button" id="btn_agency_address" country_id="" region_id="" state_province_id="" city_id="" brgy_id="" detailed_address=""  class="btn btn-info btn_address btn_agency_address">SELECT ADDRESS</button>

                                                </div>
                                                <div class="col-md-4 ">
                                                    <h5 class="card-title div-tab-title">Agency Contact Person</h5>
                                                    <label for="txt_cont_fname" class="lbl">Firstname </label>
                                                    <input type="text" id="txt_cont_fname" name="txt_cont_fname" class="form-control">

                                                    <label for="txt_cont_mname" class="lbl">Middlename</label>
                                                    <input type="text" id="txt_cont_mname" name="txt_cont_mname" class="form-control">

                                                    <label for="txt_cont_lname" class="lbl">Lastname</label>
                                                    <input type="text" id="txt_cont_lname" name="txt_cont_lname" class="form-control">

                                                    <label for="txt_cont_mobile" class="lbl">Mobile Number</label>
                                                    <input type="text" id="txt_cont_mobile" name="txt_cont_mobile" class="form-control">

                                                    <label for="txt_cont_tel" class="lbl">Telephone Number</label>
                                                    <input type="text" id="txt_cont_tel" name="txt_cont_tel" class="form-control">

                                                    <label for="txt_cont_email" class="lbl">Email Address</label>
                                                    <input type="text" id="txt_cont_email" name="txt_cont_email" class="form-control">

                                                    <button type="button" id="btn_cont_address" country_id="" region_id="" state_province_id="" city_id="" brgy_id="" detailed_address="" class="btn btn-info btn_address btn_cont_address ">SELECT CONTACT ADDRESS</button>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="content-footer float-right">
                                            <button type="submit" class="btn btn-info btn_save_agency">SAVE</button>
                                            <button type="button" class="btn btn-info tab-agency">Cancel</button>
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


<!-- Hide tab 

<div class="card">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link tab-link tab-agency active" >Agencies</a>
            </li>
            <li class="nav-item">
                <a class="nav-link tab-link tab-addagency" data-action="1" data-id="0">Add Agency</a>
            </li> 
        </ul>
    </div>
    <div class="card-body">
    </div>
</div>

-->


<div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-notify modal-warning" role="document">
    <!--Content-->
    <div class="modal-content">
        <!--Header-->
        <div class="modal-header text-center">
            <h4 class="modal-title white-text w-100 font-weight-bold py-2">Address</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="white-text">&times;</span>
            </button>
        </div>

        <!--Body-->
        <div class="modal-body">

            <div class="row">
                <!--Grid column-->
                <div class="col-md-6">
                    <div class="md-form mb-0">
                        <label for="txt_email" class="lbl">Country </label>
                        <select class="browser-default custom-select sel_country">

                        </select>

                    </div>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-6">
                    <div class="md-form mb-0">
                        <label for="txt_email" class="lbl">Region </label>
                        <select class="browser-default custom-select sel_region">

                        </select>

                    </div>
                </div>
                <!--Grid column-->
            </div>


            <div class="row">
                <!--Grid column-->
                <div class="col-md-6">
                    <div class="md-form mb-0">
                        <label for="txt_email" class="lbl">Province/State </label>
                        <select class="browser-default custom-select sel_state_prov">

                        </select>

                    </div>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-6">
                    <div class="md-form mb-0">
                        <label for="txt_email" class="lbl">City </label>
                        <select class="browser-default custom-select sel_city">

                        </select>

                    </div>
                </div>
                <!--Grid column-->
            </div>

            <div class="row">
                <!--Grid column-->
                <div class="col-md-6">
                    <div class="md-form mb-0">
                        <label for="txt_email" class="lbl">Barangay </label>
                        <select class="browser-default custom-select sel_brgy">

                        </select>

                    </div>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-6">
                    <div class="md-form mb-0">
                        <label for="txt_address" class="lbl">Detailed Address</label>
                        <input type="text" id="txt_address" name="txt_address" class="form-control">
                    </div>
                </div>
                <!--Grid column-->
            </div>


        </div>

        <!--Footer-->
        <div class="modal-footer justify-content-center">
            <a type="button" class="btn  btn-info btn-address-done ">Done</a>
        </div>
    </div>
    <!--/.Content-->
</div>
</div>


<div class="modal fade" id="modal_view_agency" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog modal-lg  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title white-text w-100 font-weight-bold py-2">Agency Details</h4>

            </div>
            <div class="modal-body">
                <h5>Agency</h5>
                <div class="alert alert-secondary" role="alert">

                    <div class="container">
                        <div class="row">
                            <div class="col"> Agency Name</div>
                            <div class="col-9 view-agn-name">  </div>
                        </div>
                        <div class="row">
                            <div class="col"> Email Address</div>
                            <div class="col-9 view-agn-email"> </div>
                        </div>
                        <div class="row">
                            <div class="col">Telephone Number</div>
                            <div class="col-9 view-agn-tel">  </div>
                        </div>
                        <div class="row">
                            <div class="col"> Mobile Number</div>
                            <div class="col-9 view-agn-mob"> </div>
                        </div>
                        <div class="row">
                            <div class="col">Description</div>
                            <div class="col-9 view-agn-desc"> </div>
                        </div> 
                        <div class="row">
                            <div class="col"> Address</div>
                            <div class="col-9 view-agn-address"> </div>
                        </div>
                    </div>
                </div>

                <h5>Agency Contact Person </h5>
                <div class="alert alert-secondary" role="alert">
                    <div class="container">
                        <div class="row">
                            <div class="col"> Agency Name</div>
                            <div class="col-9 view-cont-name">  </div>
                        </div>
                        <div class="row">
                            <div class="col"> Email Address</div>
                            <div class="col-9 view-cont-email"> </div>
                        </div>
                        <div class="row">
                            <div class="col">Telephone Number</div>
                            <div class="col-9 view-cont-tel">  </div>
                        </div>
                        <div class="row">
                            <div class="col"> Mobile Number</div>
                            <div class="col-9 view-cont-mob"> </div>
                        </div>
                        <div class="row">
                            <div class="col">Description</div>
                            <div class="col-9 view-cont-desc"> </div>
                        </div> 
                        <div class="row">
                            <div class="col"> Address</div>
                            <div class="col-9 view-cont-address"> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <a type="button" class="btn  btn-info modal-btn-agn-update ">Update</a>
                <a type="button" class="btn  btn-info modal-btn-agn-close ">Close</a>
            </div>
        </div>
    </div>
</div>



<!-- 
<style>
    .card {
        margin-right: 20px;
        margin-bottom: 30px
    }
    .div-updateagency  {
        display: none;
    }
    .tab-updateagency{
        display: none;
    }
    .div-addagency{
        display: none;
    }
    .div-agency{
        overflow: scroll;
    }
    .btn-amber{
        background-color: #ffa000!important;
        color: #fff;
    }
    .div-r{
        margin-left: 2px;
    }
    .lbl{
        margin-top: 3px;
    }
    .btn_address{
        margin-top: 10px;
        width: 100%;
    }
</style> -->
