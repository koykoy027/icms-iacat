<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal fade" id="modal_session"  tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content mdl-session">
            <div class="modal-body">

                <i class="fab fa-expeditedssl"></i><br>
                <p class="session-text text-center">Your session has been expired <br>due to inactivity.</p>

            </div>
        </div>
    </div>
</div>
<!--//-------------DEFAULT MODAL ----------------------//-->
<div class="modal" id="msgmodal"  tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h5-title msgmodal-header m-header"> Please wait...</h5>
                <small class="small-desc"></small>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!--<span aria-hidden="true">&times;</span>-->
                </button>
            </div>
            <div class="modal-body msgmodal-body m-body">

            </div>
            <div class="modal-footer msgmodal-footer m-footer">
            </div>
        </div>
    </div>
</div>

<!--//-------------CONFIRMATION MODAL ----------------------//-->
<div class="modal fade " id="msgmodal-confirm"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body msgmodal-confirm-body m-body text-center">
                <p class="msgmodal-confirm-header m-header " style=" padding-top: 22px;" id="msgmodal-confirm-header"> You're about to add new agency.</p>
                <span class="sub-content-confirm p2" id="sub-content-confirm">Click save button if you wish to continue.</span>
            </div>
            <div class="modal-footer msgmodal-confirm-footer m-footer" id="msgmodal-confirm-footer"> 
                <button type="button" class="btn btn-close-confirm-modal" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary-orange modal-button-save">Save</button>
            </div>
        </div>
    </div>
</div>
<!--//-------------WARNING MODAL ----------------------//-->
<!--<div class="modal fade " id="msgmodal-warning"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content" style="border-top: 5px solid #ef9110;">
            <div class="modal-header p-0 msgmodal-warning-header mb-0">
                <div class="d-flex flex-row bd-highlight ">
                    <div class="p-2 bd-highlight warning-icon"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></div>
                    <div class="p-2 bd-highlight">
                        <p class="msgmodal-header m-header pt-2"> You're about to add new agency.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer msgmodal-warning-footer m-footer pt-0"> 
                <button type="button" class="btn btn-close-warning-modal" data-dismiss="modal">Back</button>
            </div>

        </div>
    </div>
</div> -->

<div class="modal fade  modal-warning" id="msgmodal-warning"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content modal-msg-warning">
            <div class="modal-header p-0 msgmodal-error-header mb-0 pt-3" style="margin: 0 auto !important;">
                <div class="modal-body  msgmodal-warning-body" id="modal-body-update">
                    <div class="row">
                        <div class="col-12">
                            <div>
                                <span class="notif-title" >WARNING</span<br> 
                            </div>
                            <p class="mt-3" id="warning-msg"> You're about to add new agency.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer msgmodal-warning-footer m-footer pt-2" id="mdl-warning-btn"> 
                <button type="button" class="btn btn-close-warning-modal" data-dismiss="modal">Back</button>
            </div>

        </div>
    </div>
</div> 
<!--//-------------PRE LOADER ON SAVING  MODAL ----------------------//-->
<div class="modal fade " id="msgmodal-saving"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content" >
            <div class="modal-content shadow-sm">
                <div class="modal-body msgmodal-saving-body m-body text-center">
                    <p class="msgmodal-saving-header m-header ">   <span class="spinner-border text-warning" role="status">
                            <span class="sr-only">Loading...</span>
                        </span></p>
                    <span class="sub-content-confirm p2">Please wait ...</span>
                </div>
            </div>
        </div>
    </div> 
</div>
<!--//-------------SUCCESS MODAL ----------------------//-->
<div class="modal fade " id="msgmodal-success"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content" >
            <div class="modal-content msgmodal-success-content">
                <div class="modal-body msgmodal-success-body m-body text-center p-5">

                    <div class="success-checkmark">
                        <div class="check-icon">
                            <span class="icon-line line-tip"></span>
                            <span class="icon-line line-long"></span>
                            <div class="icon-circle"></div>
                            <div class="icon-fix"></div>
                        </div>
                    </div>
                    <p  class="sub-content-confirm p2">You have successfully added an agency.</p>
                </div>
                <div class="modal-footer msgmodal-success-footer m-footer shadow" style="background: #dee2e6;"> 
                    <div class="msg-saving-footer text-center">
                        <button type="submit" class="btn btn-primary-orange btn-next " data-dismiss="modal" >Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
<!--//-------------ERROR MODAL ----------------------//-->

<div class="modal fade " id="errormodal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header p-0 msgmodal-error-header mb-0 pt-3" style="margin: 0 auto !important;">

                <div class="modal-body  msgmodal-error-body" id="modal-body-update"  style="margin: 0 auto !important;">
                    <div class="row">
                        <div class="col-12">
                            <span class="notif-title">ERROR</span> <br> 
                            <p class="mt-3"> Something went wrong.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer msgmodal-error-footer m-footer p-2"> 
                <button type="button" class="btn btn-close-warning-modal" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div> 

<!--//-----------Pre loader-------///-->
<div class="modal fade" id="loadMeloader" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-pre-loader" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="loader"></div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="session"  tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content mdl-session">
            <div class="modal-body">

                <i class="fab fa-expeditedssl"></i><br>
                <p class="session-text text-center">Your session has been expired <br>due to inactivity.</p>

            </div>
        </div>
    </div>
</div>

<!--ADVANCE SEARCH MODAL -->
<div class="modal fade" id="advance-search" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body" >
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title header-search" id="exampleModalLabel">Advance Search</h5>
                <p class="case-title-search"> Filter your search <br></p>
                <form class="adv-search-field">  

                    <div class="row form-row">
                        <div class="col-lg-6 col-md-6 col-sm-12  card-sub-title"> 
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>Case Number</label>
                                    <input type="text" class="form-control" placeholder="Case Number" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" placeholder="First Name" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>Middle Name</label>
                                    <input type="text" class="form-control" placeholder="Middle Name" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" placeholder="Last Name" >
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12  card-sub-title"> 
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>Date Added</label>
                                    <input type="text" class="form-control datepicker" placeholder="Date" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>Sex</label>
                                    <select class="form-control">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>Age</label>
                                    <input type="text" class="form-control"  >
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>City</label>
                                    <select class="form-control">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-12">
                                    <label>Province</label>
                                    <select class="form-control">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-reset" >Reset all filter</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-advSearch">Search</button>
            </div>
        </div>
    </div>
</div>


<!--icms_modal-->
<div id="icmsMessage"></div>

<!--<div style="    background-color: rgba(0,0,0,0.5);
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1160;"></div>-->
<!-- END OF ADVANCE SEARCH MODAL -->

<!-- BEGIN FOOTER -->
<div class="page-footer ">
    <div class="page-footer-inner"> &nbsp; 2019 &copy;
        <span class="footer-content">Integrated Case Management System</span>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->

<div id="icmsMessage"></div>


<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
</div>
</body>
<footer>

    <!-- jQuery library -->
    <script src="<?= SITE_ASSETS ?>global/jquery/jquery.js"></script>
    <script src="<?= SITE_ASSETS ?>library/plugin/Bs-stepper/js/bs-stepper.min.js"></script>
    <script src="<?= SITE_ASSETS ?>library/plugin/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="<?= SITE_ASSETS ?>global/jquery/popper.min.js"></script>
    <!-- Bootstrap JS library -->
    <script src="<?= SITE_ASSETS ?>global/template/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= SITE_ASSETS ?>library/plugin/timeago.js"  type="text/javascript" ></script>
    <script src="<?= SITE_ASSETS ?>modules/administrator/js/header.js"  type="text/javascript" ></script>
    <?php
    $dir_asset = [];

    $dir_asset['panel'] = trim($this->session->userdata('panel'));
    $dir_asset['page'] = trim($this->session->userdata('menu'));
    $dir_asset['js'] = BASE_MODULES . $dir_asset['panel'] . DS . 'js' . DS;
    $dir_asset['css'] = BASE_MODULES . $dir_asset['panel'] . DS . 'css' . DS;
    $dir_asset['addJS'] = BASE_EXT_LIBRARY . 'js' . DS;
    $dir_asset['addCSS'] = BASE_EXT_LIBRARY . 'css' . DS;

    _assetFooterLibrary($libraries, $dir_asset);
    ?>    
</footer>

</html>
