<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class=" card-sub-title txt-W-500"> Validate Victim Details<br> 
    <small class="card-desc"> Provide the details to check if the case is already existing </small> 
</div>
<form id="form-validate_victim" class="col-12" onSubmit="return false;">
    <div class="form-row">

        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="row">
                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                    <label>First Name </label>
                    <input type="text" class="form-control v-first_name" name="first_name">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                    <label>Middle Name </label>
                    <input type="text" class="form-control v-middle_name" >
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                    <label> Last Name</label>
                    <input type="text" class="form-control v-last_name" name="last_name" >
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                    <label> Date of Birth </label>
                    <input type="text" class="form-control datepicker v-dob" placeholder="MM/DD/YYYY">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                    <label> Place of Birth </label>
                    <select class="form-control v-pob sel-provinces" >
                    </select>
                </div>
            </div>

        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">


            <div class="row">
                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                    <label>Alleged Offender's Name</label>
                    <input type="text" class="form-control v-offender_name" >
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                    <label>Employer Name / Company Name</label>
                    <input type="text" class="form-control v-employer_name" >
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                    <label>Local Recruitment Agency</label>
                    <input type="text" class="form-control v-local_recruitment_agency" >
                </div>
            </div>
            <div class="row" >
                <div class="form-group col-lg-5 col-md-12 col-sm-12 form-currency">
                    <label>Deployed Date</label>
                    <input type="text" class="form-control datepicker v-deployed_date" placeholder="MM/DD/YYYY">
                </div>
                <div class="form-group col-lg-6 col-md-12 col-sm-12 form-salary">
                    <label>Deployment Country</label>
                    <select class="form-control v-deployment_country sel-country">
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                    <label>Purpose of Report</label>
                    <select class="form-control sel-traffic_purpose v-traffic_purpose">
                    </select>
                </div>
            </div>



            <!--                
                            <div class="form-group col-lg-6 col-lg-offset-3">
                                <label>Deployed Date</label>
                                <input type="text" class="form-control datepicker v-deployed_date" placeholder="MM/DD/YYYY">
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Deployment Country</label>
                                <select class="form-control v-deployed_country sel-country">
                                </select>
                            </div>-->

            <!--                                                                    <div class="form-group col-md-9 offset-md-3">
                                                                                    <button type="submit" class="form-control btn btn-secondary-grey btn-validate">Validate</button>
                                                                                </div>-->

        </div>
    </div>



    <div class="form-actions">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div  style=" float: right;">
                    <!--<button type="submit" class="form-control btn btn-secondary-grey btn-validate">Validate</button>-->
                    <button type="submit" class="btn btn-secondary-light_blue float-right btn-validate">Validate</button>


                </div>
            </div>
        </div>
    </div>
</form>



<hr>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">

        <!--SHOW MATCHES IN VALIDATING CASE-->
        <div class="inner-box  matched_results" >
            <div class="row form-row" style="background-color: #daebfb ;margin:0;">

                <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue" style="padding-left: 15px;"> Matched Results <span class="matched_count"></span><br> 
                    <small class="card-desc">Please see matched results from the list </small> 
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="inner-box matched_contents">
                        <table class="table ">
                            <thead class="thead-grey">
                                <tr>
                                    <th>Victim</th>
                                    <th>Date Created</th>
                                    <th>Created By Agency</th>
                                    <th>Status</th>
                                    <th>Match</th>
                                </tr>
                            </thead>
                            <tbody class="match-result-content">
                                <tr class="match-result-details" data-toggle="modal" data-target="#mdl-victim-details">
                                    <td>
                                        <b>Kimberly V. Bado </b><br>
                                        Birthday : July 7, 1997<br>
                                        Province : Pangasinan
                                    </td>
                                    <td>February 2,2019</td>
                                    <td>OPLE Center</td>
                                    <td>For Review</td>
                                    <td><b>90%</b></td>
                                </tr><hr>
                                 <tr class="match-result-details">
                                    <td>
                                        <b>Kimberly V. Bado </b><br>
                                        Birthday : July 7, 1997<br>
                                        Province : Pangasinan
                                    </td>
                                    <td>February 2,2019</td>
                                    <td>OPLE Center</td>
                                    <td>For Review</td>
                                    <td><b>90%</b></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="inner-box matched_none hide" >
                        <!--<img src="<?= SITE_ASSETS ?>library/images/no_records.png" height="110px" alt="">-->
                        <div class="no-contact_person">
                            <div class="container-fluid text-center" id="no-data_found">
                                <div class="nd-header">
                                    <div> <i class="fas fa-exclamation-triangle"></i> </div>
                                </div>
                                <div class="nd-body">
                                    <h5 class="nd-body-content ">NO MATCHED RESULT FOUND</h5> </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--            <div class="content-footer float-left  match-buttons">
            
                            <button type="button" class="form-control btn btn-add_victim">Add to Victim List</button>
            
                            <button type="button" class="btn btn-outline btn-view_victim_list" style="width:150px;">View Victim List</button>
                            <p>Click this button if you want to add the details to victim’s information.<br>
                                For multiple victim filing, click the button to the add the victim to list, <br>
                                input new details to form and validate to check if the case is not duplicated.</p>
            
            
                        </div>-->


        </div>
    </div>
</div>
<div class="content-footer float-right  match-buttons">

    <button type="submit" class="btn btn-primary-orange btn-next btn-next_tab" data-tab="victims" style="margin-left:0px;">Next</button>
</div>



<div class="modal fade bd-example-modal-lg" id="mdl-victim-details" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <span class="content-title" style="padding-top: 25px; margin-left:7%;"> Victim Assessment List </span>
            <small class="content-sub-title" style="margin-left: 7%;">Brief details of the case.</small>
            <div class="modal-body">
           
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="col-12" id="victim_list">
                            <div class="row-header">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-header"><span class="padding-l-10">Assessment Offered </span></div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-header" style="padding-left: 25px;">Tagged Agency</div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-header txt-align_center">Date</div>
                                </div>
                                <ul class=" list_content ">
                                    <li style="width:100%">
                                        <div class="card" >
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 align-items-center ">  <span style="text-transform:capitalize"> Legal</span> </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 txt-align_center d-flex align-items-center "> <span class="stat_"> Department of Labor and Employment </span></div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 txt-align_center d-flex align-items-center justify-content-center">June 12, 2019 </div>
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
</div>
