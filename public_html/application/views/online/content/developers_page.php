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
<div class="page-content">

    <!-- BEGIN PAGE CONTENT INNER -->
    <div class="page-content-inner">
        <div class="mt-content-body">
            <div class="row container-padding" >
                <div class="col-12">
            










                    <!--                    <div class="card" >
                                            <div class="row"> 
                    
                                                <div class="col-12 "> 
                                                    <div class="card-title">
                                                        <p> Developers page</p>
                                                        <small class="card-desc">   </small> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="page-body-container" style="    margin-left: 30px;">
                    
                                                <input type="checkbox" id="flat-checkbox-1">
                                                <label for="flat-checkbox-1" class="">Checkbox 1</label>
                    
                                                <input type="checkbox" checked>
                                                <input type="radio" name="iCheck">
                                                <input type="radio" name="iCheck" checked>
                    
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="button-group">
                                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> <span class="caret"></span></button>
                                                                <input type="email" class="form-control dropdown-toggle" id="exampleDropdownFormEmail2" placeholder="email@example.com"  data-toggle="dropdown">
                      
                                                            <ul class="dropdown-menu" style="padding:10px;">
                                                                <li ><a href="#" class="lb" data-value="option1" tabIndex="-1" style="    color: #495057;
                                                                        font-size: 14px;
                                                                        font-family: helvetica neue;"><input class="input_check"  type="checkbox"/>&nbsp;Option 1</a></li>
                                                                <li><a href="#" class="small" data-value="option2" tabIndex="-1"><input class="input_check" type="checkbox"/>&nbsp;Option 2</a></li>
                                                                <li><a href="#" class="small" data-value="option3" tabIndex="-1"><input class="input_check" type="checkbox"/>&nbsp;Option 3</a></li>
                                                                <li><a href="#" class="small" data-value="option4" tabIndex="-1"><input class="input_check" type="checkbox"/>&nbsp;Option 4</a></li>
                                                                <li><a href="#" class="small" data-value="option5" tabIndex="-1"><input class="input_check" type="checkbox"/>&nbsp;Option 5</a></li>
                                                                <li><a href="#" class="small" data-value="option6" tabIndex="-1"><input class="input_check" type="checkbox"/>&nbsp;Option 6</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <select id="select" class="select-multiple" multiple="multiple">
                                                    <option value="1">January</option>
                                                    <option value="2">February</option>
                                                    <option value="3">March</option>
                                                    <option value="4">April</option>
                                                    <option value="5">May</option>
                                                    <option value="6">June</option>
                                                    <option value="7">July</option>
                                                    <option value="8">August</option>
                                                    <option value="9">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                                </select>
                    
                    
                    
                                                <div class="row hide">
                                                    <div class="col-3">
                                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-dropdown" role="tab" aria-controls="v-pills-home" aria-selected="true">Dropdown Select</a>
                                                            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
                                                            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</a>
                                                            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
                                                            <a class="nav-link" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                Link with href
                                                            </a>
                                                            <div class="collapse" id="collapseExample">
                                                                <div class="card card-body">
                                                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                                        <a class="nav-link " id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home1" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</a>
                                                                        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile1" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
                                                                        <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages1" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</a>
                                                                        <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings1" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="tab-content" id="v-pills-tabContent">
                                                            <div class="tab-pane fade show active" id="v-pills-dropdown" role="tabpanel" aria-labelledby="v-pills-dropdown-tab">
                                                                <div class="card-stats-inner">
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-lg-12 col-sm-12">
                    
                                                                            <span class="text-left tab-content-title"><a>List of Case</a></span>
                                                                            <p class="content-sub-title">List of all created and tagged cases</p>
                    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
                                                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
                                                            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                            </div>
                    
                    
                    
                    
                    
                    
                    
                                        </div>-->
                </div> 
            </div> 
        </div> 
    </div> 
</div>




