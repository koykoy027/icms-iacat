<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="page-content-inner">
    <div class="mt-content-body">
        <div class="row container-padding">
            <div class="col-12">
                <div class="card">
                    <div class="div-container">
                        <div class="div-agency">
                            <div class="row"> 
                                <div class="col-12 card-title"> 
                                    Global Data <br> 
                                    <small class="card-desc"> Lorraine ipsum monterey lesly potpot </small> 
                                </div>
                            </div>
                            <div class="content-box">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="card-content">
                                            <div class="card-title text-center"> Global Data  </div>
                                            <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical" id="list-globaldata">
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                        <div class="card-content table-list">
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


<!--Start Modal-->


<div class="modal fade" id="modalAddParameter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title white-text w-100 font-weight-bold py-2">Add <span class="mdl-title"> </span> Form</h4>

            </div>
            <form id="frm_add"> 
                <div class="modal-body">
                    <div class="md-form mb-0">
                        <label class="lbl">Description/Name:</label>    
                        <input type="text" class="form-control" id="inp-desc" name="inp_desc">
                    </div>
                    <div class="md-form mb-0">
                        <label class="lbl">Status:</label>
                        <select class="browser-default custom-select" id="inp-status" name="inp_status">
                            <option value="1"> Active </option>
                            <option value="0"> Inactive </option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn  btn-info modal-btn-add" >Add</button>
                    <button type="button" class="btn  btn-info">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="modalUpdateParameter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title white-text w-100 font-weight-bold py-2"> Update <span class="mdl-title"> </span> Form</h4>
            </div>
            <form id="frm_update"> 
                <div class="modal-body">
                    <div class="md-form mb-0">
                        <label class="lbl">Description/Name:</label>    
                        <input type="text" class="form-control" id="u_inp-desc" name="u_inp_desc">
                    </div>
                    <div class="md-form mb-0">
                        <label class="lbl">Status:</label>
                        <select class="browser-default custom-select" id="u_inp-status" name="u_inp_status">
                            <option value="1"> Active </option>
                            <option value="0"> Inactive </option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn  btn-info modal-btn-update" >Save</button>
                    <button type="button" class="btn  btn-info">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--End Modal-->
