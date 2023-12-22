var sInitial = '';

function getLisLegalServices(x) {
    var limit = 10;
    var keyword = $('#txt_search-investigation').val();

    $.post(sAjaxCriminalCase, {
        type: 'getCriminalCaseList',
        limit: limit,
        page: x.page,
        keyword: keyword
    }, function (rs) {

        var l = '';
        $('#legal-services-list').html(l);

        if (rs.data.services.listing.length > 0) {

            $('#cnt_cci_listing').show();
            $('#cnt_cci_listing-no-content').remove();

            $.each(rs.data.services.listing, function (key, val) {

                var slip_no = '-';

                if (val.legal_cc_slip_investigation_no) {
                    slip_no = val.legal_cc_slip_investigation_no;
                }
                var s_tagged = '';
                $.each(val.tagged_agency, function (tkey, tval) {
                    s_tagged += ' <span>' + tval.agency_name + ' (' + tval.agency_abbr + ')</span> ';
                });

                l += '<li style="width:100%">';
                l += '    <div class="card">';
                l += '        <div class="row">';
                l += '            <div class="col-lg-6 col-md-6 col-sm-12">';
                l += '                <div class="d-flex">';
                l += '                    <div>';
                l += '                        <span class="label-bold">Report ID: ' + val.case_number + '</span><br>';
                l += '                        <span class="label-bold">Victim name : ' + val.victim_name + '</span>';
                l += '                        <div>';
                l += '                            <small class="text-gray-500">';
                l += '                                <div> <span> Created by:       </span>    <span>' + val.agency_name + ' (' + val.agency_abbr + ')</span> </div>';
                l += '                                <div> <span> Tagged agencies:  </span>    ' + s_tagged + ' </div>';
                l += '                                <div> <span> Date created:     </span>    <span>' + val.case_date_added + '</span>  </div>';
//                l += '                                <div> <span> No of day/s left: </span>    <span>' + val.case_date_added + '</span>  </div>';
                l += '                            </small>';
                l += '                        </div>';
                l += '                    </div>';
                l += '                </div>';
                l += '            </div>';
                l += '            <div class="col-lg-3 col-md-3 col-sm-6 txt-align_center time-frame-status">';
                l += '              <small style=" color: #6c757d  !important;"> ';
                l += '                     <span class="pl-3">' + slip_no + '</span><br>';
                l += '              </small>';
                l += '            </div>';
                l += '            <div class="col-lg-3 col-md-3 col-sm-6 txt-align_center ">';
                l += '                <button class="btn dropdown-toggle" type="button" id="dropdown_service" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                l += '                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>';
                l += '                </button>';
                l += '                <div class="dropdown-menu shadow action-menu" aria-labelledby="dropdown_service">';
                l += '                    <a class="dropdown-item disabled action-title" href="#">Select Action</a>';
//                l += '                    <a class="dropdown-item" type="button" href="'+ window.location.origin +'/legal_services_logs">View logs</a>';
//                l += '                    <button class="dropdown-item" type="button">View logs</button>';
                l += '                    <button class="dropdown-item btn-update-services" type="button" data-case_id="' + val.case_id + '" data-victim_name="' + val.victim_name + '">Update service</button>';
//                l += '                    <button class="dropdown-item btn-add-batch" type="button" data-toggle="modal" data-case_id="' + val.case_id + '" data-target="#modal-add_to_batch">Add victim to batch</button>';
                l += '                </div>';
                l += '            </div>';
                l += '        </div>';
                l += '    </div>';
                l += '</li>';
            });

            if (parseInt(rs.data.services.count) <= parseInt(limit)) {
                limit = rs.data.services.count;
            }

            // pagination
            buildPagination({
                parent: 'rs-list-all',
                info: 'rs-info-all',
                pagination: 'rs-pagination-all',
                offset: 'rs-offset',
                data: {
                    page: x.page,
                    offset: limit,
                    count: rs.data.services.count
                }
            });

        } else {
            var sFooter = '';
            var sMessage = 'SORRY, WE COULDN\'T FIND ANY REPORT ID/INVESTIGATION SLIP NO  RELATED TO  <span class = "font-italic" >"<span>' + keyword + '</span>"</span>.';

            if (!(keyword)) {
                sMessage = 'NO REPORT ID/INVESTIGATION SLIP FOUND.';
            }
            var l = getNoDataFound({
                message: sMessage,
                footer: sFooter
            });

            $('#cnt_cci_listing').hide();
            $('#cnt_cci_listing-no-content').remove();
            $('#cnt_cci_listing').after("<div id='cnt_cci_listing-no-content'>" + l + "</div>");
        }

        $('#legal-services-list').html(l);

    }, 'json');
}

function addSetInvestigation() {
    var inp_status = $("#form-update_investigation select[name=inp_status]").val();
    var inp_isn = $("#form-update_investigation input[name=inp_isn]").val();
    var inp_officer_name = $("#form-update_investigation input[name=inp_officer_name]").val();
    var inp_filed_date = $("#form-update_investigation #inp_filed_date").val();
    var case_id = $("#form-update_investigation").attr('data-case_id');

    $.post(sAjaxCriminalCase, {
        type: 'addSetInvestigation',
        legal_cc_slip_investigation_no: inp_isn,
        legal_cc_slip_status: inp_status,
        legal_cc_slip_officer_name: inp_officer_name,
        legal_cc_slip_date_filed: inp_filed_date,
        case_id: case_id
    }, function (rs) {

        // load Investigation list 
        getLisLegalServices({page: 1});

        if (rs.data.flag != '0') {
            // there's changes
            icmsMessage({
                type: 'msgSuccess',
                body: 'You have successfully updated an investigation and evidence gathering.'
            });
        } else {
            // no chages  made 
            icmsMessage({
                type: 'msgWarning',
                caption: 'Close',
                body: 'No changes was made, please check your inputs.',
                onHide: function () {
                    $('#modal-add_new_remarks').modal('show');
                }
            });

        }
    }, 'json');

    // load Investigation list 
    getLisLegalServices({page: 1});

    // load docket list 
    getBatchDocketList({page: 1});


}

function getInvestigationByCaseVicticeServicesId(case_id) {
    $.post(sAjaxCriminalCase, {
        type: 'getInvestigationByCaseVicticeServicesId',
        case_id: case_id
    }, function (rs) {

        if (rs.data.flag == '1') {
            var res = rs.data.res;
            var victim_name = $('#form-update_investigation').attr('data-victim_name');
            $('#inp_v_full_name').val(victim_name);

            $('#inp_status').val(res.legal_cc_slip_status).change();
            $('#inp_isn').val(res.legal_cc_slip_investigation_no);
            $('#inp_officer_name').val(res.legal_cc_slip_officer_name);
            $('#inp_filed_date').val(res.legal_cc_slip_date_filed_formated);

            // close preloader
            icmsMessage({
                type: 'msgPreloader',
                visible: false
            });

            // open modal
            $('#modal-add_new_remarks').modal('show');

            // initial data 
            sInitial = getFormValues('form-update_investigation');
        } else {
            // warning message
            icmsMessage({
                type: 'msgWarning',
                caption: 'Close',
                onHide: function () {
                    location.reload('true');
                }
            });
        }

    }, 'json');
}

function getCriminalCaseListReportForBatch() {

    var keyword = $('#inp-create-search').val();

    var case_id = filter_array(_getStorageData('batch_case_id'));

    $.post(sAjaxCriminalCase, {
        type: 'getCriminalCaseListReportForBatch',
        keyword: keyword,
        case_id: case_id
    }, function (rs) {
        var l = '';
        if (rs.data.flag == '1') {
            $.each(rs.data.res, function (key, val) {
                l += '<li class="list-group-item" data-id="' + val.case_id + '">' + val.case_number + ' | ' + val.victim_name + '</li>';
            });
        } else {
            l = "<li class='list-group-item' data-id='0'>No Victim/s name or report id related to <i>" + keyword + " </i></li>";
        }
        $('#create-report-victim-search').show();
        $('#create-report-victim-search').html(l);

    }, 'json');
}

function addBatchListForDocket() {

    icmsMessage({
        type: 'msgPreloader',
        visible: true
    });

    var legal_cc_batch_nps_no = $('#inp_docket_num').val();
    var case_id = filter_array(_getStorageData('batch_case_id'));
    $.post(sAjaxCriminalCase, {
        type: 'addBatchListForDocket',
        case_id: case_id,
        legal_cc_batch_nps_no: legal_cc_batch_nps_no
    }, function (rs) {
        getBatchDocketList({page: 1});
        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });

        // reset form
        $("#form-create_batch")[0].reset();
        $('#create-tags').html('');
        // remove batch_case_id to local storage 
        localStorage.removeItem('batch_case_id');

        if (rs.data.flag == '1') {
            icmsMessage({
                type: 'msgSuccess',
                body: 'You have successfully add a new batch/docket number.'
            });
        } else {
            // no chages  made 
            icmsMessage({
                type: 'msgWarning',
                onHide: function () {
                    location.reload('true');
                }
            });
        }

    }, 'json');

    // load Investigation list 
    getLisLegalServices({page: 1});

    // load docket list 
    getBatchDocketList({page: 1});

}

function getBatchDocketList(x) {
    var limit = 10;
    var keyword = $('#txt_search-batchlist').val();

    $.post(sAjaxCriminalCase, {
        type: 'getBatchDocketList',
        limit: limit,
        page: x.page,
        keyword: keyword
    }, function (rs) {

        var l = '';
        $('#cc_batch_list').html(l);

        if (rs.data.res.count > 0) {

            $('#cnt_ccb_listing').show();
            $('#cnt_ccb_listing-no-content').remove();

            $.each(rs.data.res.listing, function (key, val) {

                var status = 'On going' // 0 - On going , 1 - Done  
                if (val.last_stage_status == '1') {
                    status = 'Done';
                }

                l += '<li style="width:100%">';
                l += '    <a  href="/criminal_case_stages/' + val.legal_cc_batch_id + '" target="_blank">';
                l += '        <div class="card batch-wrapper" >';
                l += '            <div class="row">';
                l += ' <div class="col-lg-6 col-md-12 col-sm-12">';
                l += '       <div class="row">';
                l += '            <div class="col-md-12 col-sm-12 col-lg-6">';
                l += '                 <span class=""> Docket Number : </span><span class="icms-text-black label-bold">' + val.legal_cc_batch_nps_no + '</span>';
                l += '            </div>';
                l += '            <div class="col-md-12 col-sm-12 col-lg-6">';
                l += '                  <span class="">Created By : </span> <span class="icms-text-black">' + val.user_full_name + '</span><br>';
                l += '                  <span class="">Date Created : </span> <span class="icms-text-black">' + val.legal_cc_batch_date_added + '</span>';
                l += '            </div>';
                l += '       </div>';
                l += ' </div>';
                l += ' <div class="col-lg-6 col-md-12 col-sm-12">';
                l += '        <div class="row">';
                l += '             <div class="col-md-12 col-sm-12 col-lg-6">';
                l += '                  <span class="">Status: </span> <span class="icms-text-black">' + status + '</span><br>';
                l += '                  <span class="">Stage : </span> <span class="icms-text-black">' + val.last_stage_id_name + '</span>';
                l += '              </div>';
                l += '              <div class="col-md-12 col-sm-12 col-lg-6">';
                l += '                   <span class="status">' + val.victim_count + ' Victims</span>';
                l += '              </div>';
                l += '         </div>';
                l += ' </div>';
                l += '            </div>';
                l += '        </div>';
                l += '    </a>';
                l += '</li>';
            });

            if (parseInt(rs.data.res.count) <= parseInt(limit)) {
                limit = rs.data.res.count;
            }

            // pagination
            buildPagination({
                parent: 'rs-list-batach_list',
                info: 'rs-info-batach_list',
                pagination: 'rs-pagination-batach_list',
                offset: 'rs-offset',
                data: {
                    page: x.page,
                    offset: limit,
                    count: rs.data.res.count
                }
            });

        } else {

            var sFooter = '';
            var sMessage = 'SORRY, WE COULDN\'T FIND ANY BATCH NUMBER RELATED TO <span class = "font-italic" >"<span>' + keyword + '</span>"</span>.';

            if (!(keyword)) {
                sMessage = 'NO BATCH NUMBER FOUND.';
            }
            var l = getNoDataFound({
                message: sMessage,
                footer: sFooter
            });

            $('#cnt_ccb_listing').hide();
            $('#cnt_ccb_listing-no-content').remove();
            $('#cnt_ccb_listing').after("<div id='cnt_ccb_listing-no-content'>" + l + "</div>");

        }

        $('#cc_batch_list').html(l);

    }, 'json');
}


function resetCreateDocket() {
    // reset form      
    removeErrorClass();
    resetForm();
    // reset fields
    var validator = $("#form-create_batch").validate();
    validator.resetForm();
    $("#form-create_batch")[0].reset();
    $('#create-tags').html('');
    // remove batch_case_id to local storage 
    localStorage.removeItem('batch_case_id');
}

$(document).ready(function () {

    // remove batch_case_id to local storage 
    localStorage.removeItem('batch_case_id');

    // load Investigation list 
    getLisLegalServices({page: 1});

    // load docket list 
    getBatchDocketList({page: 1});

    // click batch tab
    $('#tab-batch_list').click(function () {
        getBatchDocketList({page: 1});
    });

    // click investigation tab 
    $('#tab-investigation_list').click(function () {
        getLisLegalServices({page: 1});
    });

    // text search in investigation 
    // on type
//    $('#txt_search-investigation').on('keyup', function (e) {
//        var keyword = $('#txt_search-investigation').val();
//        delay(function () {
//            if (keyword.length) {
//                getLisLegalServices({page: 1, keyword: keyword});
//            }
//        }, 500);
//    });
    // on enter 
    $('#txt_search-investigation').on('keypress', function (e) {
        var keyword = $('#txt_search-investigation').val();
        if (e.which == 13) {
            getLisLegalServices({page: 1});
        }
    });


    // text search in batch list  
    // on type
//    $('#txt_search-batchlist').on('keyup', function (e) {
//        var keyword = $('#txt_search-batchlist').val();
//        delay(function () {
//            if (keyword.length) {
//                getBatchDocketList({page: 1});
//            }
//        }, 500);
//    });
    // on enter
    $('#txt_search-batchlist').on('keypress', function (e) {
        var keyword = $('#txt_search-batchlist').val();
        if (e.which == 13) {
            getBatchDocketList({page: 1});
        }
    });


    // Remove Tags
    $("#create-tags").on("click", ".tag > span", function () {
        $(this).parent().remove();
        var id = $(this).attr('data-id');
        var batch_case_id = filter_array(_getStorageData('batch_case_id'));
        var batch_case_id = batch_case_id.filter(function (e) {
            return e !== id
        })
        _setStorageData(batch_case_id, 'batch_case_id');
    });

    // Pagination for investigation 
    $('.rs-pagination-all').delegate('.page-link', 'click', function () {
        var page = parseInt($(this).attr('data-page'));
        getLisLegalServices({page: page});
    });

    // Pagination for batch
    $('.rs-list-batach_list').delegate('.page-link', 'click', function () {
        var page = parseInt($(this).attr('data-page'));
        getBatchDocketList({page: page});
    });


    $('.services-tab').delegate('.nav-link ', 'click', function () {
        var className = $(this).attr('attr');
        $('.mini-label').text(className);
    });

    $('#legal-services-list').delegate('.btn-update-services', 'click', function () {
        var case_id = $(this).attr('data-case_id');
        var victim_name = $(this).attr('data-victim_name');

        $('#form-update_investigation').attr('data-case_id', case_id);
        $('#form-update_investigation').attr('data-victim_name', victim_name);

        // reset fields
        var validator = $("#form-update_investigation").validate();
        validator.resetForm();
        $("#form-update_investigation")[0].reset();


        icmsMessage({
            type: 'msgPreloader',
            visible: true,
            body: 'Please wait while loading'
        });

        getInvestigationByCaseVicticeServicesId(case_id);

        removeErrorClass();

    });

    // set date picker 
    $('.datepicker').datetimepicker({
        timepicker: false,
        format: 'm/d/Y',
        scrollMonth: false,
        scrollInput: false
    });

    // validate  form update_investigation
    $('#form-update_investigation').validate({
        rules: {
            inp_status: {required: true},
            inp_isn: {required: true},
            inp_status: {required: true},
            inp_officer_name: {required: true},
            inp_filed_date: {
                required: true,
                pastDateNow: true
            }
        },
        errorElement: 'div',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error);
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            icmsMessage({
                type: 'msgConfirmation',
                title: 'You are about to update this investigation and evidence gathering.',
                onConfirm: function () {
                    addSetInvestigation();
                },
                onShow: function () {
                    $('#modal-add_new_remarks').modal('hide');
                },
                onCancel: function () {
                    $('#modal-add_new_remarks').modal('show');
                }
            });

        }
    });

    // validate create batch     
    $('#form-create_batch').validate({
        rules: {
            inp_docket_num: {
                required: true,
                maxlength: 250,
                minlength: 3,
            }
        },
        errorElement: 'div',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error);
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            var batch_case_id = filter_array(_getStorageData('batch_case_id'));


            if ((!batch_case_id) || (batch_case_id.length <= 0)) {
                icmsMessage({
                    type: 'msgWarning',
                    caption: 'Close',
                    body: 'Please tag victim/s to create a new batch of docket number.',
                    onHide: function () {
                        $('#modal-create_new_batch').modal('show');
                    },
                    onShow: function () {
                        $('#modal-create_new_batch').modal('hide');
                    }
                });
            } else {
                icmsMessage({
                    type: 'msgConfirmation',
                    title: 'You are about to create a new batch of docket number.',
                    body: 'Make sure the docket number is correct. Click save button if you wish to continue.',
                    onConfirm: function () {
                        addBatchListForDocket();
                    },
                    onShow: function () {
                        $('#modal-create_new_batch').modal('hide');
                    },
                    onCancel: function () {
                        $('#modal-create_new_batch').modal('show');
                    }
                });
            }


        }
    });

    // for search employer 
    $('#inp-create-search').on('keyup', function (e) {
        var keyword = $('#inp-create-search').val();
        delay(function () {
            getCriminalCaseListReportForBatch();
        }, 1000);
    });

    // Click victim List 
    $('#create-report-victim-search').delegate('.list-group-item', 'click', function () {

        var id = $(this).attr('data-id');

        if (id != '0') {
            var name = $(this).html();
            $('#create-tags').append('<div class="tag">' + name + '<span data-id="' + id + '">×</span></div>');
        }

        var storage = filter_array(_getStorageData('batch_case_id'));
        if (!storage) {
            var batch_case_id = [id];
            _setStorageData(batch_case_id, 'batch_case_id');
        } else {
            var batch_case_id = id;
            storage.push(batch_case_id);
            _setStorageData(storage, 'batch_case_id');
        }

        $('#inp-create-search').val('');
    });


    // reset when modal open 
    $("#modal-create_new_batch .btn-modal-cancel").click(function () {
        var sCurrent = getFormValues('form-create_batch');
        sCurrent += localStorage.getItem('batch_case_id');
        if (sCurrent == 'null') {
            // no update 
            resetCreateDocket();
        } else {
            // have an update
            icmsMessage({
                type: "msgConfirmation",
                title: "You made some changes. Do you want to disregard changes?",
                body: "Click yes button if you want to continue",
                LblBtnConfirm: "Yes",
                onConfirm: function () {
                    resetCreateDocket();
                },
                onCancel: function () {
                    $('#modal-create_new_batch').modal('show');
                }
            });
        }
    });


    // reset when modal open 
    $("#modal-add_new_remarks .btn-modal-cancel").click(function () {
        $("#modal-add_new_remarks").modal('hide');
        var sCurrent = getFormValues('form-update_investigation');
        if (sCurrent == sInitial) {
            // no update 
            $('#modal-add_new_remarks').modal('hide');
        } else {
            // have an update
            icmsMessage({
                type: "msgConfirmation",
                title: "You made some changes. Do you want to disregard changes?",
                body: "Click yes button if you want to continue",
                LblBtnConfirm: "Yes",
                onConfirm: function () {
                    resetCreateDocket();
                },
                onCancel: function () {
                    $('#modal-add_new_remarks').modal('show');
                }
            });
        }
    });

});
