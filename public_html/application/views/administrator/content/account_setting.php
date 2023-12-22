<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
$userData = $_SESSION['userData'];
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>     

<!-- BEGIN PAGE CONTENT BODY -->
<!-- BEGIN PAGE CONTENT INNER -->
<div class="page-content-inner">
    <div class="content-body">


        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="card card-gradient-bg"></div>
                <div class="card padding1rem">

                    <div id="content-body-container container-wrapper">
                        <div class="profile_image-container profile-pic center">   
                            <img  class="img-fluid shadow img-profile-pic" src="<?= MAIN_SITE_URL ?>drive/file/<?= $_SESSION['userData']['profile_pic'] ?>" onerror="ifBrokenProfile(this);"><br><br>
                        </div><br>

                        <div class="text-center">
                            <span class="text-semi-bold accnt-name"><?= $userData['user_firstname'] ?> <?= $userData['user_lastname'] ?></span><br>
                            <span class="text-normal accnt-username"><?= $userData['user_username'] ?></span> |  <span class="text-normal accnt-username"><?= $userData['user_level'] ?></span><br>
                            <?php
                            if (isset($userData['user_phone_number']) == true && !empty($userData['user_phone_number']) == true && isset($userData['user_mobile_number']) == true && !empty($userData['user_mobile_number']) == true) {
                                echo '<span class="text-normal">' . $userData['user_phone_number'] . ' | ' . $userData['user_mobile_number'] . '</span>';
                            } else {
                                if (isset($userData['user_phone_number']) == true && !empty($userData['user_phone_number']) == true) {
                                    echo '<span class="text-normal">' . $userData['user_phone_number'] . '</span>';
                                }

                                if (isset($userData['user_mobile_number']) == true && !empty($userData['user_mobile_number']) == true) {
                                    echo '<span class="text-normal">' . $userData['user_mobile_number'] . '</span>';
                                }
                            }
                            ?>
                            <br>
                            <span class="text-normal"><?= $userData['user_email'] ?></span><br>
                            <span class="text-normal"><?= $userData['agency_name'] ?> (<?= $userData['agency_abbr'] ?>)</span><br>
                            <span class="text-normal">
                                <?= $userData['agency_branch_name'] ?>  -  <?= $userData['agency_branch_is_main'] == '1' ? "Main" : "" ?>
                            </span><br><br>

                            <!--buttons-->
                            <button type="button" class="btn btn-reset-pw btn-change-pw">Reset Password</button>
                            <button type="button" class="btn btn-reset-pw change-pic">Change Picture</button>

                            <br><br>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">
                                    <span class="case-count active-case-count ">0</span><br>
                                    <span class=" icms-text-lochmara"><a>Currently Handling </a></span>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">
                                    <span class="case-count">0</span><br>
                                    <span class=" icms-text-lochmara"><a>Case Handled </a></span>
                                </div>
                            </div>
                        </div>
                    </div><br>
                </div><br>
            </div>

            <div class="col-lg-8 col-md-12 col-sm-12 mb-5">

                <!--Task Scheduler Start -->
                <!-- <div class="card">
                    <div id="content-body-container" >
                        <div class="row pt-4" >
                            <div class="col-lg-9 col-md-9 col-sm-9" >
                                <span class="text-left content-title"><a>Task Scheduler</a></span><br>
                                <small class="content-desc">Schedule your task in this area.</small>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <button class="btn btn-primary-orange sched-task" data-toggle="modal" data-target="#mdl-sched-task">Schedule task</button>
                            </div>
                        </div><hr>
                        <div class="task-list">
                            <div class="card-body" >
                                <div class="row form-row">
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <div class="text-center">
                                            <span class="task-date">9</span><br>
                                            <span class="task-month">APR</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10 ">
                                        <span class="task-subj">This is a sample task</span><br>
                                        <span class="task-desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum 
                                            has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                                            of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also
                                            the leap into electronic typesetting, remaining essentially unchanged.</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row form-row">
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <div class="text-center">
                                            <span class="task-date">30</span><br>
                                            <span class="task-month">JUNE</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10 ">
                                        <span class="task-subj">This is a sample task</span><br>
                                        <span class="task-desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum 
                                            has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                                            of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also
                                            the leap into electronic typesetting, remaining essentially unchanged.</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row form-row">
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <div class="text-center">
                                            <span class="task-date">16</span><br>
                                            <span class="task-month">AUGUST</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10 ">
                                        <span class="task-subj">This is a sample task</span><br>
                                        <span class="task-desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum 
                                            has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                                            of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also
                                            the leap into electronic typesetting, remaining essentially unchanged.</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row form-row">
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <div class="text-center">
                                            <span class="task-date">9</span><br>
                                            <span class="task-month">APR</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10 ">
                                        <span class="task-subj">This is a sample task</span><br>
                                        <span class="task-desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum 
                                            has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                                            of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also
                                            the leap into electronic typesetting, remaining essentially unchanged.</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row form-row">
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <div class="text-center">
                                            <span class="task-date">30</span><br>
                                            <span class="task-month">JUNE</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10 ">
                                        <span class="task-subj">This is a sample task</span><br>
                                        <span class="task-desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum 
                                            has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                                            of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also
                                            the leap into electronic typesetting, remaining essentially unchanged.</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row form-row">
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <div class="text-center">
                                            <span class="task-date">9</span><br>
                                            <span class="task-month">APR</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10 ">
                                        <span class="task-subj">This is a sample task</span><br>
                                        <span class="task-desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum 
                                            has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                                            of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also
                                            the leap into electronic typesetting, remaining essentially unchanged.</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row form-row">
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <div class="text-center">
                                            <span class="task-date">30</span><br>
                                            <span class="task-month">JUNE</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10 ">
                                        <span class="task-subj">This is a sample task</span><br>
                                        <span class="task-desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum 
                                            has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                                            of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also
                                            the leap into electronic typesetting, remaining essentially unchanged.</span>
                                    </div>
                                </div>
                                <hr>

                            </div>
                        </div>
                    </div>
                </div>-->
                <!--Task Scheduler End -->

                <!--Activity Logs Start-->
                <div class="card" >
                    <div id="content-body-container mgn-T-18 ">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 pt-4">
                                <span class="text-left content-title"><a>Activity Logs</a></span><br>
                                <small class="content-desc">All activity logs of the user.</small>
                            </div>
                        </div><hr>
                        <div class="case-list" id="activity_log_container">
                            <div class="card-body p-0"  id="activity_log_content" datapage="1" datapageend="0">
                            </div>
                        </div>
                    </div>
                </div>
                <!--Activity Logs End-->

            </div>



            <div class="row" style="display: none">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <!--Activity Logs Start-->
                    <!--<div class="card py-3" >
                        <div id="content-body-container mgn-T-18 ">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 pt-4">
                                    <span class="text-left content-title"><a>Activity Logs</a></span><br>
                                    <small class="content-desc">All activity logs of the user.</small>
                                </div>
                            </div><hr>
                            <div class="case-list" id="activity_log_container">
                                <div class="card-body p-0"  id="activity_log_content" datapage="1" datapageend="0">
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <!--Activity Logs End-->
                </div>
                <br>
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <!--Notes Start-->
                    <!--<div class="card" style="height:620px;">
                       <div id="content-body-container">
                           <div class="row p-3">
                               <div class="col-lg-9 col-md-9 col-sm-9" >
                                   <span class="text-left content-title"><a>Notes</a></span><br>
                                   <small class="content-desc">Notes is designed for whatever’s on your mind.  </small>
                               </div>
                               <div class="col-lg-3 col-md-3 col-sm-3">
                                   <button class="btn btn-primary-orange sched-task" data-toggle="modal" data-target="#mdl-new-note">New Note</button>
                               </div>
                           </div><hr>
                           <div class="row">
                               <div class="col-lg-3 col-md-3 col-sm-12">
                                   <div class="list-group note-list" id="list-tab" role="tablist">
                                       <a class="list-group-item list-group-item-action active" id="list-contact_info" data-toggle="list" href="#tab-contact_info" role="tab" aria-controls="home"> <b>Notes from the ground</b><br><span class="">Ali Diouri</span></a>
                                       <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#tab-education" role="tab" aria-controls="profile"><b>Notes from the ground</b><br> <span class="">Ali Diouri</span></a>
                                       <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#tab-address_info" role="tab" aria-controls="messages"> <b>Notes from the ground</b><br><span class="">Ali Diouri</span></a>
                                       <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#tab-next_kin" role="tab" aria-controls="settings"> <b>Notes from the ground</b><br><span class="">Ali Diouri</span></a>
                                   </div>
                               </div>
                               <div class="col-lg-9 col-md-9 col-sm-12">
                                   <div class="tab-content tab-sub-info-content px-4" id="nav-tabContent" >

                                       <div class="tab-pane fade show active" id="tab-contact_info" role="tabpanel" aria-labelledby="list-home-list">
                                           <span class="">There is something wonderful in writing.
                                               We believe it's the ability of words to create emotional, inspiring and thrilling stories.
                                               Notes was created on top of that belief.
                                               It's your place of expressing yourself.</span>
                                       </div>
                                       <div class="tab-pane fade" id="tab-education" role="tabpanel" aria-labelledby="list-profile-list">
                                           <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text
                                               ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived 
                                               not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </span>
                                       </div>
                                       <div class="tab-pane fade" id="tab-address_info" role="tabpanel" aria-labelledby="list-messages-list">
                                           <span>Ali Diouri. Ali revamped all the code of Notes from the ground up. He made everything tick. Thanks to him, Notes is one of the 
                                               fastest and reliable apps on our computers. He integrated the most advanced technologies out there so you could sit back knowing that
                                               someone has put most of his efforts so you could have a flawless experience. </span>
                                       </div>
                                       <div class="tab-pane fade" id="tab-next_kin" role="tabpanel" aria-labelledby="list-settings-list">
                                           <span>Alex Spataru. Thanks to Alex updating Notes is wonderfully easy and simple across many and different operating systems. He turned
                                               what was once a hassle into a delightful experience you will eagerly wait to happen. </span>
                                       </div>
                                   </div>

                               </div>
                           </div>

                       </div>
                   </div>-->
                    <!--Notes End-->
                </div>

            </div>


        </div>
    </div>



    <div class="modal fade" id="mdl-change-pw" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title h5-title msgmodal-header">Change Password</h5>
                </div>
                <div class="modal-body">
                    <form id="frm-change-password">
                        <div class="form-group">
                            <label>Current Password</label> 
                            <label class="col-form-label lbl-show-hide-current  text-gray-500 float-right mr-2" data-stat="1">Show</label>
                            <input type="password" name="currentpassword" class="form-control input-pw" id="pw-cur" placeholder="••••••••">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>New Password</label>  
                            <label class="col-form-label lbl-show-hide-new  text-gray-500 mr-2 float-right" data-stat="1" >Show</label>
                            <input type="password" name="newpassword" class="form-control input-pw " id="pw-new" check_strength='true' minlength="8" placeholder="••••••••">
                        </div>
                        <div class="form-group mt-2">
                            <label>Confirm Password</label>  
                            <label class="col-form-label lbl-show-hide-new-confirm  text-gray-500 mr-2 float-right" data-stat="1" >Show</label>
                            <input type="password" name="confirm_newpassword" class="form-control input-pw" id="pw-conform_new" minlength="8" placeholder="••••••••">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-save">Update</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade  bd-example-modal-lg" id="mdl-profile-change" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title h5-title msgmodal-header">Change Profile</h5>
                </div>

                <div class="modal-body px-4 pb-2">
                    <div class="card ">
                        <div class="row">
                            <div class="col-md-4 center mt-0 pt-0">
                                <div class="row" >
                                </div>
                                <div class="row">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="upload-wrapper">
                                    <div class="upload-wrapper-inner">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2"></div>
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="profile-actiion btn-select-pic">
                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 div-image">
                                                        <div class="card-body px-4 py-3">
                                                            <img src="https://www.calloutcomputers.org/wp-content/uploads/2017/01/cloud_backup.png" class="upload-icon avatar">
                                                        </div>
                                                    </div> </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <span class="browse"><br><u class="btn-select-pic text--blue pointer">Browse</u> photo to Upload.</span><br><br>
                                                <span class="profile-actiion">
                                                    <small class="badge-light btn-select-upload icms-bg-primary shadow pointer">&nbsp; UPLOAD PHOTO</small>
                                                </span>
                                                <div style="display:none">
                                                    <label for="imageselect">Select Photo</label>
                                                    <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control-file" id="imageselect">
                                                </div> 
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card">
                                    <span> Suggested Photos </span>
                                    <div class="row row-images">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade myModal" id="mdl-view-wide-image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <img class="wide-image" src="" onerror="ifBrokenProfile(this);" data-dismiss="modal">
            </div>
        </div>
    </div>



    <div class="modal fade" id="mdl-sched-task"  role="dialog">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  msgmodal-header modal-header_title "> Schedule Task</h5>

                </div>
                <div class="modal-body msgmodal-body">
                    <form id="form-add_education_info" class="col-lg-12 col-md-12 col-sm-12">

                        <div class="px-5">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label>Subject </label>
                                    <input type="text" class="form-control case-date_complained">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label>Date </label>
                                    <input type="text" class="form-control case-date_complained datepicker" placeholder="MM/DD/YYYY">
                                </div>
                            </div>
                            <div class="form-group">
                                <label >Description </label>
                                <textarea class="form-control case-evaluation textarea-xs" id="exampleFormControlTextarea1" ></textarea>
                            </div>
                            <div class="content-footer float-right  match-buttons">
                                <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                                <button type="submit" class="btn btn-primary-orange btn-next ml-0" >Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="mdl-new-note"  role="dialog">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  msgmodal-header modal-header_title "> New Note</h5>

            </div>
            <div class="modal-body msgmodal-body">
                <form id="form-add_education_info" class="col-lg-12 col-md-12 col-sm-12">

                    <div class="px-5">
                        <div class="form-group">
                            <label >Description </label>
                            <textarea class="form-control case-evaluation textarea-xs" id="exampleFormControlTextarea1" ></textarea>
                        </div>
                        <div class="content-footer float-right  match-buttons">
                            <button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal" >Cancel</button>
                            <button type="submit" class="btn btn-primary-orange btn-next ml-0" >Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>