
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

<script>
    var temp_data =  '<?= $temp_details ?>'; 
    temp_data = JSON.parse(temp_data);
</script>

<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content ">

    <!-- BEGIN PAGE CONTENT INNER -->
    <div class="page-content-inner">
        <div class="mt-content-body">
            <div class="row container-padding" >
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card" >

                        <div class="row"> 

                            <div class="col-lg-12 col-md-12 col-sm-12 "> 
                                <div class="card-title">
                                    <p> Create New Report | Intake Form</p>
                                    <small class="card-desc"> Follow the steps to file new report.  </small> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="bs-stepper" >
                                    <div class="bs-stepper-header" role="tablist" >
                                        <!-- your steps here -->
                                        <div class="step" data-target="#logins-part">
                                            <button type="button" class="step-trigger validation-trigger" role="tab" aria-controls="logins-part" id="validate-details-tab1">
                                                <span class="bs-stepper-circle v_circle bs-stepper-circle_active">1</span>
                                                <span class="bs-stepper-label v_label bs-stepper-label_active">Validate</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#information-part">
                                            <button type="button" class="step-trigger victim-details-trigger return-top" role="tab" cx id="victims-details-tab1">
                                                <span class="bs-stepper-circle vd_circle">2</span>
                                                <span class="bs-stepper-label vd_label">Victim's Details</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#information-part">
                                            <button type="button" class="step-trigger victim-details-trigger" role="tab" aria-controls="information-part" id="employment-details-tab1">
                                                <span class="bs-stepper-circle e_circle">3</span>
                                                <span class="bs-stepper-label e_label">Employment Details</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#information-part">
                                            <button type="button" class="step-trigger victim-details-trigger" role="tab" aria-controls="information-part" id="case-details-tab1">
                                                <span class="bs-stepper-circle c_circle">4</span>
                                                <span class="bs-stepper-label c_label">Incident Details</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#information-part">
                                            <button type="button" class="step-trigger victim-details-trigger" role="tab" aria-controls="information-part" id="summary-details-tab1">
                                                <span class="bs-stepper-circle s_circle">5</span>
                                                <span class="bs-stepper-label s_label">Summary</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-nav" >
                                        <div class="bs-stepper-content">
                                            <!-- your steps content here -->
                                            <div id="validate-details" class="content " role="tabpanel" aria-labelledby="validate-details-trigger" style="display:block">
                                                <?= __loadPage('sub_add_case/validate'); ?>
                                            </div>
                                            <!--END VALIDATE INFORMATION-->
                                            <!--VICTIM INFORMATION-->
                                            <div id="victims-details" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                                <?= __loadPage('sub_add_case/victim_details'); ?>
                                            </div>

                                            <!--EMPLOYMENT INFORMATION-->
                                            <div id="employment-details" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                                <?= __loadPage('sub_add_case/employment_details'); ?>


                                            </div>
                                            <div id="case-details" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                                <?= __loadPage('sub_add_case/case_details'); ?>

                                                <!--                                            <div class="row form-row">
                                                             <div class="col-6">
                                                                 <div class="col-12 card-sub-title"> File Upload <br> 
                                                                     <small class="card-desc">Upload important documents that can help progress the case.</small> 
                                                                 </div>
                                                                 <div class="card" style="width: 18rem;">
                                                                     <div class="card-body">
                                                                         <i class="fas fa-upload"></i><br>
                                                                         <label style=" margin-left: 32%; margin-top: 13px;">Drag files here </label>
                                                                     </div>
                                                                 </div>
                                                                 <br>
                                                                 <div class="input-group mb-3" style=" margin-left: 0px! important; width:74%;">
                                                                     <div class="custom-file">
                                                                         <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                                                         <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>-->
                                            </div>
                                            <div id="summary" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                                <?= __loadPage('sub_add_case/summary'); ?>
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
</div>

<div class="modal fade" id="msgAddCasePreloader" tabindex="-1" role="dialog" data-backdrop="static" style="padding-right: 17px;" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-content shadow-sm">
                <div class="modal-body msgmodal-saving-body m-body text-center">
                    <div class="row">
                        <div class="col-12 text-center">                            
                            <h2 class="center">SAVING DETAILS</h2> 
                        </div>

                        <div class="col-12 text-left" style="font-size:2em; ">
                            <div class="container">
                                <div class="row mb-3">
                                    <span class="pr-4">   
                                        <div class="spinner-border text-secondary" role="status" id="tab1-0" status="0">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <i class="far fa-check-circle p-r-10 txt-orange" aria-hidden="true" id="tab1-1" status="1" style="display:none"></i>
                                        Victim Details
                                    </span>
                                </div>  
                                 <div class="row mb-3">
                                    <span class="pr-4">   
                                        <div class="spinner-border text-secondary" role="status" id="tab2-0" status="0">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <i class="far fa-check-circle p-r-10 txt-orange" aria-hidden="true" id="tab2-1" status="1" style="display:none"></i>
                                        Employment Details
                                    </span>
                                </div>
                                 <div class="row mb-3">
                                    <span class="pr-4">   
                                        <div class="spinner-border text-secondary" role="status" id="tab3-0" status="0">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <i class="far fa-check-circle p-r-10 txt-orange" aria-hidden="true" id="tab3-1" status="1" style="display:none"></i>
                                        Incident Details
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-5">
                            <p class="text-center mb-0">
                                <span id="details-loading"> Saving initial information  </span> 
                                <span class="dot-loading"> </span> 
                            </p>
                            <div id="myProgress">
                                <div id="myBar">10%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

