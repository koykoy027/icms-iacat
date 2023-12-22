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
    <div class="container">

        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content-inner">
            <div class="content-body">      
                <div class="card">

                    <div class="card-content">
                        <div id="container-user-list" class="container" style="padding: 2rem;">
                            <div style="padding-bottom: 2rem;">
                                <span class="card-title text-left">Users Information</span>
                                <span class="float-right"> <button class="btn btn-primary" id="btn-add">Add User</button></span>
                            </div>
                            <table id="tblUsers" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Government Agency</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody-agency-list">
                                    <tr> 
                                        <td>
                                            <h5>DOJ - <span style="font-size: 12px">MANILA</span></h5>  
                                        </td>
                                        <td>
                                            <p class="text-center">Kim Arvin Toledo</p>
                                            <div class="row">
                                                <div class="col-6">
                                                    <p> <i class="fa fa-address-book" aria-hidden="true"></i> 09757842616 </p>
                                                </div>
                                                <div class="col-6">
                                                    <p> <i class="fa fa-envelope" aria-hidden="true"></i> kim.toledo@s2-tech.com </p>
                                                </div>               
                                            </div>                            
                                        </td>
                                        <td>
                                            <p>Active</p>
                                        </td>
                                        <td>
                                            <button class=" tbl-btn_manage">MANAGE</button>
                                        </td>
                                    </tr>                                  
                                </tbody>

                            </table>
                        </div>


                        <form onsubmit="return false">
                            <div id="container-user-add" class="container hide" style="padding: 2rem;">
                                <h3 class="text-center"> User Form </h3>

                                <h5>Personal Information</h5>
                                <hr>


                                <div class="row">

                                    <div class="col-md-5">
                                        <div class="md-form mb-0">
                                            <label class="lbl">First Name:</label>
                                            <input type="text" class="form-control" id="inp-fname"></input>
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        <div class="md-form mb-0">
                                            <label class="lbl">Last Name:</label>
                                            <input type="text" class="form-control" id="inp-lname"></input>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="md-form mb-0">
                                            <label class="lbl">Gender:</label>
                                            <select class="browser-default custom-select sel_gender" id="inp-gender" name="opt_gender" ></select>
                                        </div>
                                    </div>

                                </div>


                                <hr>
                                <h5>Contact Information</h5>
                                <hr>


                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="md-form mb-0">
                                            <label class="lbl">Email:</label>
                                            <input type="email" class="form-control" id="inp-email"></input>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="md-form mb-0">
                                            <label class="lbl">Phone Number:</label>
                                            <input type="text" class="form-control" id="inp-phone_number"></input>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="md-form mb-0">
                                            <label class="lbl">Mobile Number:</label>
                                            <input type="text" class="form-control" id="inp-mobile_number"></input>

                                        </div>
                                    </div>

                                </div>


                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="md-form mb-0">
                                            <label for="txt_email" class="lbl">Country </label>
                                            <select class="browser-default custom-select sel_country">

                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="md-form mb-0">
                                            <label for="txt_email" class="lbl">Region </label>
                                            <select class="browser-default custom-select sel_region">

                                            </select>

                                        </div>
                                    </div>

                                </div>


                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="md-form mb-0">
                                            <label for="txt_email" class="lbl">Province/State </label>
                                            <select class="browser-default custom-select sel_state_prov">

                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="md-form mb-0">
                                            <label for="txt_email" class="lbl">City </label>
                                            <select class="browser-default custom-select sel_city">

                                            </select>

                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="md-form mb-0">
                                            <label for="txt_email" class="lbl">Barangay </label>
                                            <select class="browser-default custom-select sel_brgy">

                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="md-form mb-0">
                                            <label for="txt_address" class="lbl">Detailed Address</label>
                                            <input type="text" id="txt_address" name="txt_address" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5>Account Information</h5>
                                <hr>



                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="md-form mb-0">
                                            <label class="lbl">Goverment Agency:</label>
                                            <select class="browser-default custom-select sel_govt_agency"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="md-form mb-0">
                                            <label class="lbl">User level:</label>
                                            <select class="browser-default custom-select" id="sel-user-level"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="md-form mb-0">
                                            <label class="lbl">User Role</label>
                                            <button type="button" class="form-control btn btn-info btn-select-role " data-toggle="modal" data-target="#modalUserRole">Select Role</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="md-form mb-0">
                                            <label class="lbl">Job Title:</label>
                                            <input type="text" class="form-control" id="inp-jobtitle"></input>
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="md-form mb-0">
                                            <label for="txt_address" class="lbl">Username</label>
                                            <input type="text" id="inp-username"  class="form-control">
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="md-form mb-0">
                                            <label for="txt_address" class="lbl">Password</label>
                                            <input type="password" id="inp-password"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="md-form mb-0">
                                            <label for="txt_address" class="lbl">Confirm Password</label>
                                            <input type="password" id="inp-confirmpassword"  class="form-control">
                                        </div>
                                    </div>
                                </div>


                                <div class="div-form-footer" >
                                    <button class="btn-cancel btn  btn-info"> Cancel </button>
                                    <button class="btn-save btn  btn-info"> Save </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT INNER -->
        </div>
    </div>
    <!-- END PAGE CONTENT BODY -->
    <!-- END CONTENT BODY -->
</div>



<!-- Modal Start -->

<div class="modal fade" id="modalUserRole" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header text-center">
                <h4 class="modal-title white-text w-100 font-weight-bold py-2">User Roles</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body" id="div-user-role-list">


            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
                <a type="button" class="btn  btn-info  btn-modal-user-role-done"  selected-role="0" data-dismiss="modal" aria-label="Close">Done</a>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->