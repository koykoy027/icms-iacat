<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
//echo"<pre>";
//$_SESSION['userData']['user_level_id']=1;
//echo $this->yel->generateCaseControlNumber();
//1629 case victim
//1139 case
?>


<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content">

    <!-- BEGIN PAGE CONTENT INNER -->
    <div class="page-content-inner">
        <div class="mt-content-body">
            <div class="row container-padding" >
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card" >

                        <div class="page-body-container mx-3" >

                            <div class="victim_details_summary" data-cid="<?= $case_id ?>">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class=" card-sub-title txt-W-500"> Victim details<br> 
                                            <small class="card-desc"> Summary of victim details. </small> 
                                            <?php
                                            if (isset($this->uri->rsegments[4])) {
                                                ?>
                                                <div class="float-right">
                                                    <a  href="<?= SITE_URL ?>cases" class=" btn btn-primary right">Back to List</a>
                                                </div>
                                                <?php
                                            }
                                            ?>

                                            <hr class="card-sub-title_border">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 ">
                                        <div class="padding-l-15">

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <!--<div class="card-sub-title blue" > Personal Information</div>-->
                                                    <div class="row ">
                                                        <div class="col-3">
                                                            Victim name
                                                            <span class="float-right">:</span>
                                                        </div> 
                                                        <div class="col-9 summary-details div-fullname">
                                                            <div class="linear-background" >
                                                                <div class="inter-draw "></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-3 summary-lbl">
                                                            Date of birth
                                                            <span class="float-right">:</span>
                                                        </div>
                                                        <div class="col-9 summary-details div-dob">
                                                            <div class="linear-background">
                                                                <div class="inter-draw "></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-3 summary-lbl">
                                                            Place of birth
                                                            <span class="float-right">:</span>
                                                        </div>

                                                        <div class="col-9 summary-details div-pob">
                                                            <div class="linear-background">
                                                                <div class="inter-draw "></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-3 summary-lbl">
                                                            Sex
                                                            <span class="float-right">:</span>
                                                        </div>
                                                        <div class="col-9 summary-details div-sex">
                                                            <div class="linear-background">
                                                                <div class="inter-draw "></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-3 summary-lbl">
                                                            Civil status
                                                            <span class="float-right">:</span>
                                                        </div>
                                                        <div class="col-9 summary-details div-civil">
                                                            <div class="linear-background">
                                                                <div class="inter-draw "></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-3 summary-lbl">
                                                            Religion
                                                            <span class="float-right">:</span>
                                                        </div>
                                                        <div class="col-9 summary-details div-religion">
                                                            <div class="linear-background">
                                                                <div class="inter-draw "></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>


                                    </div>
                                    <div class="col-lg-6" >
                                        <div class="fake-info-content bg-transparent" >
                                            <div class=" card-sub-title mgn-b-5 txt-orange"> Assumed information of victim
                                            </div>
                                            <div class="fake-info-content_form">
                                                <div class="row ">
                                                    <div class="col-3 summary-lbl">
                                                        Name
                                                        <span class="float-right">:</span>
                                                    </div>
                                                    <div class="col-9 summary-details div-assumed-name">
                                                        <div class="linear-background">
                                                            <div class="inter-draw "></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-3 summary-lbl">
                                                        Date of birth 
                                                        <span class="float-right">:</span>
                                                    </div>
                                                    <div class="col-9 summary-details div-assumed-dob">
                                                        <div class="linear-background">
                                                            <div class="inter-draw"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="employment_details_summary mgn-t-35">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class=" card-sub-title txt-W-500"> Employment details<br> 
                                            <small class="card-desc"> Summary of employment details. </small> 
                                            <hr class="card-sub-title_border">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="padding-l-15">

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <!--<div class="card-sub-title blue" > Personal Information</div>-->
                                                    <div class="row ">
                                                        <div class="col-4 summary-lbl">
                                                            Employment type
                                                            <span class="float-right">:</span>
                                                        </div>
                                                        <div class="col-8 summary-details div-empt-type">
                                                            <div class="linear-background">
                                                                <div class="inter-draw"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-4 summary-lbl">
                                                            Employer / Company name
                                                            <span class="float-right">:</span>
                                                        </div>
                                                        <div class="col-8 summary-details div-empr-name">
                                                            <div class="linear-background">
                                                                <div class="inter-draw"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-4 summary-lbl">
                                                            Employer address
                                                            <span class="float-right">:</span>
                                                        </div>
                                                        <div class="col-8 summary-details div-empr-address">
                                                            <div class="linear-background">
                                                                <div class="inter-draw"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-4 summary-lbl">
                                                            Employment position
                                                            <span class="float-right">:</span>
                                                        </div>
                                                        <div class="col-8 summary-details div-empt-position">
                                                            <div class="linear-background">
                                                                <div class="inter-draw"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-4 summary-lbl">
                                                            Local agency name
                                                            <span class="float-right">:</span>
                                                        </div>
                                                        <div class="col-8 summary-details div-local-rect-name">
                                                            <div class="linear-background">
                                                                <div class="inter-draw"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-4 summary-lbl">
                                                            Address
                                                            <span class="float-right">:</span>
                                                        </div>
                                                        <div class="col-8 summary-details div-local-rect-address">
                                                            <div class="linear-background">
                                                                <div class="inter-draw"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-4 summary-lbl">
                                                            Foreign agency name
                                                            <span class="float-right">:</span>
                                                        </div>
                                                        <div class="col-8 summary-details div-foreign-rect-name">
                                                            <div class="linear-background">
                                                                <div class="inter-draw"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-4 summary-lbl">
                                                            Address
                                                            <span class="float-right">:</span>
                                                        </div>
                                                        <div class="col-8 summary-details div-foreign-rect-address">
                                                            <div class="linear-background">
                                                                <div class="inter-draw"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <!--<div class="card-sub-title blue" > Personal Information</div>-->

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="padding-l-15">
                                            <div class="fake-info-content bg-transparent" >
                                                <div class=" card-sub-title mgn-b-5 txt-orange"> Deployment details
                                                </div>
                                                <div class="row ">
                                                    <div class="col-4 summary-lbl">
                                                        Departure type
                                                        <span class="float-right">:</span>
                                                    </div>
                                                    <div class="col-8 summary-details div-departure-type">
                                                        <div class="linear-background">
                                                            <div class="inter-draw"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-4 summary-lbl">
                                                        Port of exit
                                                        <span class="float-right">:</span>
                                                    </div>
                                                    <div class="col-8 summary-details div-port-type">
                                                        <div class="linear-background">
                                                            <div class="inter-draw"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-4 summary-lbl">
                                                        Visa Category
                                                        <span class="float-right">:</span>
                                                    </div>
                                                    <div class="col-8 summary-details div-visa-cat">
                                                        <div class="linear-background">
                                                            <div class="inter-draw"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-4 summary-lbl">
                                                        Country of destination 
                                                        <span class="float-right">:</span> 
                                                    </div>
                                                    <div class="col-8 summary-details div-destination" >
                                                        <div class="linear-background">
                                                            <div class="inter-draw"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-4 summary-lbl">
                                                        Deployment date 
                                                        <span class="float-right">:</span> 
                                                    </div>
                                                    <div class="col-8 summary-details div-deployment-date">
                                                        <div class="linear-background">
                                                            <div class="inter-draw"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-4 summary-lbl">
                                                        Arrival date
                                                        <span class="float-right">:</span>
                                                    </div>
                                                    <div class="col-8 summary-details div-arrival">
                                                        <div class="linear-background">
                                                            <div class="inter-draw"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="case_details_summary mgn-t-35">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class=" card-sub-title txt-W-500"> Case details<br> 
                                            <small class="card-desc"> Summary of case details. </small> 
                                            <hr class="card-sub-title_border">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6" >
                                        <div class="fake-info-content bg-transparent" >
                                            <div class=" card-sub-title mgn-b-5 txt-orange"> Case information
                                            </div>
                                            <div class="row ">
                                                <div class="col-3 summary-lbl">
                                                    Acts 
                                                    <span class="float-right">:</span> 
                                                </div>
                                                <div class="col-9 summary-details div-act">
                                                    <div class="linear-background">
                                                        <div class="inter-draw"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="col-3 summary-lbl">
                                                    Means 
                                                    <span class="float-right">:</span> 
                                                </div>
                                                <div class="col-9 summary-details div-means">
                                                    <div class="linear-background">
                                                        <div class="inter-draw"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="col-3 summary-lbl">
                                                    Purpose
                                                    <span class="float-right">:</span>
                                                </div>
                                                <div class="col-9 summary-details div-purpose">
                                                    <div class="linear-background">
                                                        <div class="inter-draw"></div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-8 col-offset-4" >
                                        <div class="fake-info-content bg-transparent" >
                                            <div class="row ">
                                                <div class="col-4 summary-lbl">
                                                    Brief facts of the Case 
                                                </div>
                                                <div class="col-9 summary-details div-fact">
                                                    <div class="linear-background linear-paragraph">
                                                        <div class="inter-draw"></div>
                                                    </div>
                                                    <div class="linear-background linear-paragraph">
                                                        <div class="inter-draw"></div>
                                                    </div>
                                                    <div class="linear-background linear-paragraph">
                                                        <div class="inter-draw"></div>
                                                    </div>
                                                    <div class="linear-background linear-paragraph">
                                                        <div class="inter-draw"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6" >
                                        <div class="fake-info-content bg-transparent" >
                                            <div class=" card-sub-title mgn-b-5 txt-orange"> Complainant information
                                            </div>
                                            <div class="row ">
                                                <div class="col-4 summary-lbl">
                                                    Date complained
                                                    <span class="float-right">:</span>
                                                </div>
                                                <div class="col-8 summary-details div-date-complain">
                                                    <div class="linear-background">
                                                        <div class="inter-draw"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="col-4 summary-lbl">
                                                    Source  
                                                    <span class="float-right">:</span>
                                                </div>
                                                <div class="col-8 summary-details div-complain-source">
                                                    <div class="linear-background">
                                                        <div class="inter-draw"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="col-4 summary-lbl">
                                                    Complainant
                                                    <span class="float-right">:</span>
                                                </div>
                                                <div class="col-8 summary-details div-complainant">
                                                    <div class="linear-background">
                                                        <div class="inter-draw"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="col-4 summary-lbl">
                                                    Relationship to victim
                                                    <span class="float-right">:</span>
                                                </div>
                                                <div class="col-8 summary-details div-relation-to-victim">
                                                    <div class="linear-background">
                                                        <div class="inter-draw"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="case_details_summary mgn-t-35">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class=" card-sub-title txt-W-500"> Case evaluation<br> 
                                            <small class="card-desc"> Summary of case evaluation. </small> 
                                            <hr class="card-sub-title_border">
                                        </div>
                                    </div>
                                </div>

                                <div class='row' >
                                    <div class="col-lg-8 col-offset-4" >
                                        <div class="fake-info-content bg-transparent" >
                                            <div class="row ">
                                                <div class="col-4 summary-lbl txt-orange">
                                                    Case evaluation 
                                                </div>
                                                <div class="col-9 summary-details div-case-evaluation">
                                                    <?php
                                                    for ($x = 1; $x <= 3; $x++) {
                                                        ?>
                                                        <div class="linear-background linear-paragraph">
                                                            <div class="inter-draw"></div>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="col-4 summary-lbl txt-orange">
                                                    Risk assessment 
                                                </div>
                                                <div class="col-9 summary-details div-risk-assessment">
                                                    <?php
                                                    for ($x = 1; $x <= 3; $x++) {
                                                        ?>
                                                        <div class="linear-background linear-paragraph">
                                                            <div class="inter-draw"></div>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                    <div class='col-lg-10 col-lg-offset-2'>
                                        <div class="fake-info-content bg-transparent" >
                                            <div class=" card-sub-title mgn-b-5 txt-orange"> Victim needs / services
                                            </div>
                                            <div class="fake-info-content bg-transparent div-case-victim_services" >
                                                <?php
                                                for ($x = 1; $x <= 3; $x++) {
                                                    ?>
                                                    <div class="linear-background linear-paragraph">
                                                        <div class="inter-draw"></div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="priority_summary mgn-t-35" >
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class=" card-sub-title txt-W-500"> Priority level<br> 
                                            <small class="card-desc"> Set priority level for this case.</small> 
                                            <hr class="card-sub-title_border">
                                        </div>
                                    </div>
                                </div>
                                <div class='row' >
                                    <div class="col-lg-8 col-md-12 col-sm-12" >
                                        <div class="fake-info-content bg-transparent padding-l-15" >
                                            <div class="row">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="recommendedLevel" id="inlineRadio1" disabled>
                                                    <label class="form-check-label" for="">High priority <small class=" icms-text-default ">( should be addressed within one or two work days. )</small></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="recommendedLevel" id="inlineRadio2" disabled>
                                                    <label class="form-check-label" for="">Medium priority <small class=" icms-text-default ">( should be addressed between three work days and three weeks. )</small></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="recommendedLevel" id="inlineRadio3" disabled>
                                                    <label class="form-check-label" for="">Low priority <small class=" icms-text-default ">( will be addressed, but will likely take more than three weeks. )</small></label>
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
</div>





