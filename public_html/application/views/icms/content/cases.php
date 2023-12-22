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
                    <div class="card card-stats" >

                        <div class="col-12">
                            <p class="case-title"> Submit New Case<br><small> This will be created as new case base from receipt of report.</small></p>
                        </div>


                        <div class="col-4">
                            <ul class="nav nav-pills nav-fill case-ul" id="myTab">
                                <li class="nav-item nav-inner-item">
                                    <a class="nav-link active nav-tab" id="case-tab" data-toggle="tab" href="#created_case_tab">Created Case</a>
                                </li>
                                <li class="nav-item nav-inner-item">
                                    <a class="nav-link nav-tab" id="case-summary-tab" data-toggle="tab" href="#tagged_case_tab">Tagged Case </a>
                                </li>
                            </ul>
                        </div>
                        <div class=" card-stats-inner" >
                            <div class="col-12">
                                <div class="tab-content" id="myTabContent">
                                    <!--CREATED CASE TAB-->
                                    <div class="tab-pane fade show active" id="created_case_tab" role="tabpanel" aria-labelledby="recent-case-tab">


                                        <p class="case-title"> Case List <br><small>List of cases created by Agency</small></p>
                                        <div class="form-group pull-right">
                                            <!--<a href="<?php echo SITE_URL ?>icms/add_case" class="btn add-case" role="button"><i class="fas fa-plus-circle"></i> Create Case</a>-->
                                        </div>
                                        <div class="tbl-cases">
                                            <table id="caseList" class="table" >
                                                <div class="row filter-row">
                                                    <div class="col-3">
                                                        <div class="input-form"> 
                                                            <input class="form-control mr-sm-1 inp-search " type="search" placeholder="Search" aria-label="Search">
                                                            <!--<label for="search-input" class="search-input"><i class="fa fa-search" aria-hidden="true"></i><span class="sr-only">Search icons</span></label>--> 
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
                                                <thead>
                                                    <tr class="cases-info">
                                                        <th>Name</th>
                                                        <th>Acts</th>
                                                        <th>Means</th>
                                                        <th>Purpose</th>
                                                        <th>Priority</th>
                                                        <th>Case Age</th>
                                                        <th>Expiry Date</th>
                                                        <th>Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="case-details">
                                                        <td>Kimberly Bado</td>
                                                        <td>Lorem Ipsum</td>
                                                        <td>Lorem Ipsum</td>
                                                        <td>Lorem Ipsum</td>
                                                        <td><span class="badge badge-pill badge-warning pending"></span>Pending</td>
                                                        <td>Lorem Ipsum</td>
                                                        <td>Lorem Ipsum</td>
                                                        <td><button class="btn btn-manage" data-toggle="modal" data-target="#"><i class="fas fa-ellipsis-v"></i></button></td>
                                                    </tr> 
                                                    <tr class="case-details">
                                                        <td>Kimberly Bado</td>
                                                        <td>Lorem Ipsum</td>
                                                        <td>Lorem Ipsum</td>
                                                        <td>Lorem Ipsum</td>
                                                        <td><span class="badge badge-pill badge-warning pending"></span>Pending</td>
                                                        <td>Lorem Ipsum</td>
                                                        <td>Lorem Ipsum</td>
                                                        <td><button class="btn btn-manage" data-toggle="modal" data-target="#"><i class="fas fa-ellipsis-v"></i></button></td>
                                                    </tr> 
                                                    <tr class="case-details">
                                                        <td>Kimberly Bado</td>
                                                        <td>Lorem Ipsum</td>
                                                        <td>Lorem Ipsum</td>
                                                        <td>Lorem Ipsum</td>
                                                        <td><span class="badge badge-pill badge-warning pending"></span>Pending</td>
                                                        <td>Lorem Ipsum</td>
                                                        <td>Lorem Ipsum</td>
                                                        <td><button class="btn btn-manage" data-toggle="modal" data-target="#"><i class="fas fa-ellipsis-v"></i></button></td>
                                                    </tr> 
                                                    <tr class="case-details">
                                                        <td>Kimberly Bado</td>
                                                        <td>Lorem Ipsum</td>
                                                        <td>Lorem Ipsum</td>
                                                        <td>Lorem Ipsum</td>
                                                        <td><span class="badge badge-pill badge-warning pending"></span>Pending</td>
                                                        <td>Lorem Ipsum</td>
                                                        <td>Lorem Ipsum</td>
                                                        <td><button class="btn btn-manage" data-toggle="modal" data-target="#"><i class="fas fa-ellipsis-v"></i></button></td>
                                                    </tr> 
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!--END CREATED CASE TAB-->

                                    <!--TAGGED CASE-->
                                    <div class="tab-pane fade" id="tagged_case_tab" role="tabpanel" aria-labelledby="recent-case-tab">
                                        <p class="case-title"> Case List <br><small>List of cases created by Agency</small></p>
                                        <div class="form-group pull-right">
                                            <!--<a href="<?php echo SITE_URL ?>icms/add_case" class="btn add-case" role="button"><i class="fas fa-plus-circle"></i> Create Case</a>-->
                                        </div>

                                        <div class="tbl-cases">
                                            <div class="row filter-row">
                                                <div class="col-3">
                                                    <div class="input-form"> 
                                                        <input class="form-control mr-sm-1 inp-search " type="search" placeholder="Search" aria-label="Search">
                                                        <!--<label for="search-input" class="search-input"><i class="fa fa-search" aria-hidden="true"></i><span class="sr-only">Search icons</span></label>--> 
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

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="showAgency" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item">NBI <span class="pull-right">21 days</span></li>
                    <li class="list-group-item">NBI <span class="pull-right">21 days</span></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Create Case modal-->
<div class="modal fade" id="mdlCreateCase" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header mdl-header-case">
                <h5 class="modal-title mdl-header-text" id="exampleModalLabel"><i class="fas fa-suitcase"></i> &nbsp;Create Case</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <div class="info-title"><i class="fas fa-user-tag">&nbsp;</i>Personal Information</div><hr>
                <form class="create-case-form">
                    <div class="row">
                        <div class="col">
                            <label for="formGroupExampleInput">First Name</label>
                            <input type="text" class="form-control" >
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput">Last Name</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="formGroupExampleInput">Middle Name</label>
                            <input type="text" class="form-control" >
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput">Suffix</label>
                            <input type="text" class="form-control">
                        </div>
                    </div><br>
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-2 pt-0">Radios</legend>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                    <label class="form-check-label" for="gridRadios1">Real Name </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                                    <label class="form-check-label" for="gridRadios2">Assumed Name </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="validationTooltip05">Civil Status</label>
                                <select id="inputState" class="form-control">
                                    <option disabled>Civil Status</option>
                                    <option>Single</option>
                                    <option>Married</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-row">
                        <div class="col-4">
                            <label for="validationTooltip03">Date of Birth</label>
                            <input type="text" class="form-control" id="validationTooltip03"  required>
                            <div class="invalid-tooltip">
                                Please provide a valid city.
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="validationTooltip04">Age</label>
                            <input type="text" class="form-control" id="validationTooltip04"  required>
                            <div class="invalid-tooltip">
                                Please provide a valid state.
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="validationTooltip05">Sex</label>
                            <select id="inputState" class="form-control">
                                <option>Female</option>
                                <option>Male</option>
                            </select>
                        </div>

                    </div>
                </form>
                <div class="TitleBreak"></div>
                <div class="info-title"><i class="fas fa-id-card-alt"></i>&nbsp;Contact Information</div><hr>
                <form class="create-case-form">
                    <div class="row">
                        <div class="col">
                            <label for="formGroupExampleInput">Region</label>
                            <select id="inputState" class="form-control">
                                <option disabled>Select Region</option>
                                <option>1</option>
                                <option>2</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput">City</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="formGroupExampleInput">Complete Address</label>
                            <input type="text" class="form-control" >
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col">
                            <label for="formGroupExampleInput">Mobile Number</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput">Telephone Number</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </form>
                <div class="TitleBreak"></div>
                <div class="info-title"><i class="fas fa-passport"></i>&nbsp;Passport Information</div><hr>
                <form class="create-case-form">
                    <div class="row">
                        <div class="col">
                            <label for="formGroupExampleInput">Passport Number</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput">Place Issue</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="formGroupExampleInput">Date of Issue</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput">Date Expiry</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-create-case">Create Case</button>
            </div>

        </div>
    </div>
</div>



<!--Manage case modal-->
<div class="modal fade" id="mdlManageCase" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header mdl-header-case">
                <h5 class="modal-title mdl-header-text" id="exampleModalLabel"><i class="fas fa-suitcase"></i> &nbsp;Create Case</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <div class="info-title"><i class="fas fa-user-tag">&nbsp;</i>Personal Information</div><hr>
                <form class="create-case-form">
                    <div class="row">
                        <div class="col">
                            <label for="formGroupExampleInput">First Name</label>
                            <input type="text" class="form-control" >
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput">Last Name</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="formGroupExampleInput">Middle Name</label>
                            <input type="text" class="form-control" >
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput">Suffix</label>
                            <input type="text" class="form-control">
                        </div>
                    </div><br>
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-2 pt-0">Radios</legend>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                    <label class="form-check-label" for="gridRadios1">Real Name </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                                    <label class="form-check-label" for="gridRadios2">Assumed Name </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="validationTooltip05">Civil Status</label>
                                <select id="inputState" class="form-control">
                                    <option disabled>Civil Status</option>
                                    <option>Single</option>
                                    <option>Married</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-row">
                        <div class="col-4">
                            <label for="validationTooltip03">Date of Birth</label>
                            <input type="text" class="form-control" id="validationTooltip03"  required>
                            <div class="invalid-tooltip">
                                Please provide a valid city.
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="validationTooltip04">Age</label>
                            <input type="text" class="form-control" id="validationTooltip04"  required>
                            <div class="invalid-tooltip">
                                Please provide a valid state.
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="validationTooltip05">Sex</label>
                            <select id="inputState" class="form-control">
                                <option>Female</option>
                                <option>Male</option>
                            </select>
                        </div>

                    </div>
                </form>
                <div class="TitleBreak"></div>
                <div class="info-title"><i class="fas fa-id-card-alt"></i>&nbsp;Contact Information</div><hr>
                <form class="create-case-form">
                    <div class="row">
                        <div class="col">
                            <label for="formGroupExampleInput">Region</label>
                            <select id="inputState" class="form-control">
                                <option disabled>Select Region</option>
                                <option>1</option>
                                <option>2</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput">City</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="formGroupExampleInput">Complete Address</label>
                            <input type="text" class="form-control" >
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col">
                            <label for="formGroupExampleInput">Mobile Number</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput">Telephone Number</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </form>
                <div class="TitleBreak"></div>
                <div class="info-title"><i class="fas fa-passport"></i>&nbsp;Passport Information</div><hr>
                <form class="create-case-form">
                    <div class="row">
                        <div class="col">
                            <label for="formGroupExampleInput">Passport Number</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput">Place Issue</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="formGroupExampleInput">Date of Issue</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput">Date Expiry</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-create-case">Create Case</button>
            </div>

        </div>
    </div>
</div>