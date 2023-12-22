var legal_ac_case_no = 0;
var initialDetails = '';

var aStages = [

    {
        "content": [{
                "stage": "1",
                "stage_name": " <span class='pr-3'>I</span>",
                "name": "Filing and Receipt of Complaints",
                "class_name": "stage_1"
            }]

    }, {
        "content": [{
                "stage": "2",
                "stage_name": " <span class='pr-3'>II</span>",
                "name": "On-Site Complaints for Violation of POEA Rules",
                "class_name": "stage_2"
            }]

    },
    {
        "content": [
            {
                "stage": "3",
                "stage_name": " <span class='pr-3'>III</span>",
                "name": "Issuance and Implementation of Closure Order",
                "class_name": "stage_3"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "4",
                "stage_name": " <span class='pr-3'>IV</span>",
                "name": "Mandatory Conciliation of Complaints",
                "class_name": "stage_4"
            }
        ]
    }
];


function resetContent() {
    $.each(aStages, function (sKey, aVal) {
        $.each(aVal.content, function (cKey, cVal) {
            $('.' + cVal.class_name).hide();
        });
    });
}

function showButtonForUpdating() {
    $('.btn-edit').hide();
    $('.btn-submit').show();
    $('.btn-cancel').show();
}

function getAdministrativeCaseList(page = 1) {
    var limit = 10;
    var keyword = $('#txt_search-report_list').val();

    $.post(sAjaxAdministrativeCase, {
        type: 'getAdministrativeCaseList',
        limit: limit,
        page: page,
        keyword: keyword
    }, function (rs) {

        var l = '';
        $('#rl-list').html(l);

        if (rs.data.services.listing.length > 0) {

            $('#cnt_rl_listing').show();
            $('#cnt_rl_listing-no-content').remove();

            $.each(rs.data.services.listing, function (key, val) {
                var s_tagged = '';
                $.each(val.tagged_agency, function (tkey, tval) {
                    s_tagged += ' <span>' + tval.agency_name + ' (' + tval.agency_abbr + ')</span> ';
                });

                var s_stage = '-';
                if (val.last_legal_ac_stage_status) {
                    var s_status = 'On going';
                    if (val.last_legal_ac_stage_status == '1') {
                        s_status = 'Done';
                    }
                    s_stage = '                  <span class="">Status: </span> <span class="icms-text-black"> ' + s_status + '</span><br> ';
                    s_stage += '                  <span class="">Stage : </span> <span class="icms-text-black">' + val.last_stage_id_name + '</span>';
                }


                l += '<li  class="li-a-rl_list wd-full" data-victim_id = "' + val.victim_id + '" data-case_id="' + val.case_id + '" >';
                l += '    <div class="card">';
                l += '        <div class="row">';
                l += '            <div class="col-lg-9 col-md-9 col-sm-9  align-items-center ">';
                l += '                    <div>';
                l += '                        <span class="label-bold">Report ID: ' + val.case_number + '</span>';
                l += '                        <span class="label-bold">Victim name : ' + val.victim_name + '</span>';
                l += '                        <div>';
                l += '                            <small class="text-gray-500">';
                l += '                                <div> <span> Created by:       </span>    <span>' + val.agency_name + ' (' + val.agency_abbr + ')</span> </div>';
                l += '                                <div> <span> Tagged agencies:  </span>    ' + s_tagged + ' </div>';
                l += '                                <div> <span> Date created:     </span>    <span>' + val.case_date_added + '</span>  </div>';
                l += '                            </small>';
                l += '                        </div>';
                l += '                    </div>';
                l += '            </div>';
                l += '                <div class="col-lg-3 col-md-3 col-sm-3">';
                l += s_stage;
                l += '                </div>';
                l += '        </div>';
                l += '    </div>';
                l += '</li>';

            });

            if (parseInt(rs.data.services.count) <= parseInt(limit)) {
                limit = rs.data.services.count;
            }

            // pagination
            buildPagination({
                parent: 'rs-list-rl',
                info: 'rs-info-rl',
                pagination: 'rs-pagination-rl',
                offset: 'rs-offset',
                data: {
                    page: page,
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

            $('#cnt_rl_listing').hide();
            $('#cnt_rl_listing-no-content').remove();
            $('#cnt_rl_listing').after("<div id='cnt_rl_listing-no-content'>" + l + "</div>");
        }

        $('#rl-list').html(l);

    }, 'json');
}

function iniCaseStages() {
    var l = '';
    $('#ul-stages').html(l);

    // set attribute 
    $('.btn-edit').attr('data-stage_level', 1);
    $('.btn-cancel').attr('data-stage_level', 1);

    $.each(aStages, function (key, val) {
        var aContent = val.content;
        var iCount = aContent.length;

        switch (parseInt(iCount)) {
            case 1:
                l += ' <li class="timeline-inverted li-stages_' + aContent[0]['stage'] + '">';
                l += '     <div class="timeline-badge warning"></div>';
                l += '     <div class="card card-tabs ' + aContent[0]['name'] + '" style="background-color:#f5f6fa; " attr-class_name = "' + aContent[0]['class_name'] + '"  id="li-stage_' + aContent[0]['stage'] + '">';
                l += '         <div class="card-body">';
                l += '           <div class="row">';
                l += '           <div class="col-lg-2 col-md-3 col-sm-3 card-sub-title_ blue  px-0 text-center" >';
                l += aContent[0]['stage_name'];
                l += '             </div>';
                l += '           <div class="col-lg-10 col-md-9 col-sm-9 card-sub-title_ blue mb-0 px-0" >';
                l += aContent[0]['name'];
                l += '             </div>';
                l += '             </div>';
                l += '         </div>';
                l += '     </div>';
                l += ' </li>';
                break;
            case 2:
                l += '<li class="timeline-inverted li-stages_' + aContent[0]['stage'] + '">';
                l += '    <div class="timeline-badge warning"></div>';
                l += '    <div class="card ' + aContent[0]['name'] + '" style="background-color:#f5f6fa; " attr-class_name = "' + aContent[0]['class_name'] + '">';
                l += '        <div class="card-body">';
                l += '            <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue" style="padding: 0px;">' + aContent[0]['name'] + '</div>';
                l += '        </div>';
                l += '    </div>';
                l += '    <div class="card ' + aContent[1]['name'] + '" style=" background-color: #f5f6fa; margin-left: -134px; margin-top: -72px; width: 90px;" attr-class_name = "' + aContent[1]['class_name'] + '">';
                l += '        <div class="card-body">';
                l += '            <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue" style="padding: 0px;">' + aContent[1]['name'] + '</div>';
                l += '        </div>';
                l += '    </div>';
                l += '</li>';

                break;
            default:
        }
    });
    $('#ul-stages').html(l);
}

function defaulButtonDisplay() {

    $('.btn-edit').show();
    $('.btn-submit').hide();
    $('.btn-cancel').hide();
    $(".btn-modal-cancel").show();
    $('.modal-footer button').show();

    // disabled forms 
    $("form :input").prop("disabled", true);

    // enable update button 
    $(".btn").prop("disabled", false);
    $(".btn-quick-actions").prop("disabled", true);

    // enable create docket 
    $("#form-create_batch :input").prop("disabled", false);

}

function addSetFilingReceiptComplaints() {

    icmsMessage({
        type: 'msgPreloader',
        visible: true
    });

    var legal_ac_case_no = $("#form-stage-1 input[name='case_number']").val();
    var legal_ac_case_log_status = $("#form-stage-1 input[name='stage_status']:checked").val();
    var legal_ac_case_log_date = $("#form-stage-1 input[name='inp_date_remarks']").val();
    var legal_ac_case_log_remarks = $("#form-stage-1 textarea[name='inp_remarks']").val();
    var victim_id = $('#mdl-victim-details').attr('data-victim_id');
    var case_id = $('#mdl-victim-details').attr('data-case_id');

    $.post(sAjaxAdministrativeCase, {
        type: 'addSetFilingReceiptComplaints',
        legal_ac_case_no: legal_ac_case_no,
        legal_ac_case_log_status: legal_ac_case_log_status,
        legal_ac_case_log_date: legal_ac_case_log_date,
        legal_ac_case_log_remarks: legal_ac_case_log_remarks,
        victim_id: victim_id,
        case_id: case_id
    }, function (rs) {

        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });

        if (typeof (rs.data.flag = '1')) {
            icmsMessage({
                type: 'msgSuccess',
                onShow: function () {
                    // $('.btn-cancel').click();
                    // default body display  
                    defaulButtonDisplay();
                    removeErrorClass();
                },
                onHide: function () {
                    $('.li-stages_2').show();
                    $('.li-stages_3').show();
                    $('.li-stages_4').show();
                    $('#mdl-victim-details').modal('show');
                }
            });
        } else {
            icmsMessage({
                type: 'msgWarning',
                onHide: function () {
                    location.reload('true');
                }
            });
        }

    }, 'json');

    getAdministrativeCaseList();

}

function setDateRemarksPerStageId(stage) {

    icmsMessage({
        type: 'msgPreloader',
        visible: true
    });

    console.log('run function false');

    var legal_ac_case_no = $("#form-stage-" + stage + " input[name='case_number']").val();
    var legal_ac_case_log_status = $("#form-stage-" + stage + " input[name='stage_status']:checked").val();
    var legal_ac_case_log_date = $("#form-stage-" + stage + " input[name='inp_date_remarks']").val();
    var legal_ac_case_log_remarks = $("#form-stage-" + stage + " textarea[name='inp_remarks']").val();
    var victim_id = $('#mdl-victim-details').attr('data-victim_id');
    var case_id = $('#mdl-victim-details').attr('data-case_id');

    $.post(sAjaxAdministrativeCase, {
        type: 'setDateRemarksPerStageId',
        legal_ac_case_no: legal_ac_case_no,
        legal_ac_case_log_status: legal_ac_case_log_status,
        legal_ac_case_log_date: legal_ac_case_log_date,
        legal_ac_case_log_remarks: legal_ac_case_log_remarks,
        victim_id: victim_id,
        case_id: case_id,
        stage: stage

    }, function (rs) {

        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });

        if (rs.data.flag = '1') {
            icmsMessage({
                type: 'msgSuccess',
                onShow: function () {
                    // $('.btn-cancel').click();
                    // default body display  
                    defaulButtonDisplay();
                    removeErrorClass();
                },
                onHide: function () {
                    $('#mdl-victim-details').modal('show');
                }
            });
        } else {
            icmsMessage({
                type: 'msgWarning',
                onHide: function () {
                    location.reload('true');
                }
            });
        }

    }, 'json');

    getAdministrativeCaseList();
}

/**
 * For Stage #3 only
 * @param {type} stage
 * @return {undefined}
 */
function setStageDetails(stage) {

    icmsMessage({
        type: 'msgPreloader',
        visible: true
    });


    var legal_ac_case_no = $("#form-stage-" + stage + " input[name='case_number']").val();
    var legal_ac_case_log_status = $("#form-stage-" + stage + " input[name='stage_status']:checked").val();
    var legal_ac_case_log_param_one = $("#form-stage-" + stage + " select[name='inp_issue_status']").val();
    var legal_ac_case_log_date = $("#form-stage-" + stage + " input[name='inp_date_remarks']").val();
    var legal_ac_case_log_remarks = $("#form-stage-" + stage + " textarea[name='inp_remarks']").val();
    var victim_id = $('#mdl-victim-details').attr('data-victim_id');
    var case_id = $('#mdl-victim-details').attr('data-case_id');

    $.post(sAjaxAdministrativeCase, {
        type: 'setDateRemarksPerStageId',
        legal_ac_case_no: legal_ac_case_no,
        legal_ac_case_log_status: legal_ac_case_log_status,
        legal_ac_case_log_date: legal_ac_case_log_date,
        legal_ac_case_log_remarks: legal_ac_case_log_remarks,
        legal_ac_case_log_param_one: legal_ac_case_log_param_one,
        victim_id: victim_id,
        case_id: case_id,
        stage: stage

    }, function (rs) {

        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });

        if (rs.data.flag = '1') {
            icmsMessage({
                type: 'msgSuccess',
                onShow: function () {
                    // $('.btn-cancel').click();
                    // default body display  
                    defaulButtonDisplay();
                    removeErrorClass();
                },
                onHide: function () {
                    $('#mdl-victim-details').modal('show');
                }
            });
        } else {
            icmsMessage({
                type: 'msgWarning',
                onHide: function () {
                    location.reload('true');
                }
            });
        }

    }, 'json');

    getAdministrativeCaseList();
}

function loadCriminalCaseInfoByStages(stage) {

    // reset form
    resetForm();
    $('.modal-footer button').show();

    // hide modal 
    $('#mdl-victim-details').modal('hide');

    icmsMessage({
        type: 'msgPreloader',
        visible: true,
        body: 'Please wait while loading'
    });

    var victim_id = $('#mdl-victim-details').attr('data-victim_id');
    var case_id = $('#mdl-victim-details').attr('data-case_id');

    $.post(sAjaxAdministrativeCase, {
        type: 'loadCriminalCaseInfoByStages',
        stage: stage,
        victim_id: victim_id,
        case_id: case_id
    }, function (rs) {


        delay(function () {
            icmsMessage({
                type: 'msgPreloader',
                visible: false,
            });
            // show modal 
            $('#mdl-victim-details').modal('show');
        }, 500);

        if (rs.data.flag = '1') {

            if (stage == '1') {
                if (rs.data.res.legal_ac_case_no) {
                    $('.li-stages_2').show();
                    $('.li-stages_3').show();
                    $('.li-stages_4').show();
                } else {
                    $('.li-stages_2').hide();
                    $('.li-stages_3').hide();
                    $('.li-stages_4').hide();
                }
            }

            /*             * Status 
             *      0 - On going | 1 - Done              */

            sStatus = 'Status: On going';
            iStatus = 0;
            $('.inp-stat-ongoing').prop('checked', true);
            if (rs.data.res.legal_ac_case_log_status == '1') {
                sStatus = 'Status: Done';
                $('.inp-stat-done').prop('checked', true);
                iStatus = 1;
            }
            $('.btn-quick-actions').text(sStatus);

            /*             * End Status             */


            $.each(rs.data.res, function (key, val) {
                $('.stage' + stage + '-' + key).val(val);
            });

            $("#form-stage-" + stage + " input[name='inp_date_remarks']").val(rs.data.res.legal_ac_case_log_date);
            $("#form-stage-" + stage + " textarea[name='inp_remarks']").val(rs.data.res.legal_ac_case_log_remarks);


            if (rs.data.res.legal_ac_case_no) {
                $("#form-stage-" + stage + " input[name='case_number']").val(rs.data.res.legal_ac_case_no);
            }


            // set default button display 
            defaulButtonDisplay();


            // set attribute 
            $('.btn-edit').attr('data-stage_level', stage);
            $('.btn-cancel').attr('data-stage_level', stage);

            initialDetails = iStatus + getFormValues("form-stage-" + stage);

        } else {
            icmsMessage({
                type: 'msgWarning',
                onHide: function () {
                    location.reload('true');
                }
            });
        }


    }, 'json');
}

function addBatchListForDocket() {
    icmsMessage({
        type: 'msgPreloader',
        visible: true
    });

    var legal_ac_docket_number = $('#inp_docket_num').val();
    var case_id = filter_array(_getStorageData('batch_case_id'));
    $.post(sAjaxAdministrativeCase, {
        type: 'addBatchListForDocket',
        case_id: case_id,
        legal_ac_docket_number: legal_ac_docket_number
    }, function (rs) {

        getAdministrativeCaseBatchList(1);

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
}

function getAdministrativeCaseListReportForBatch() {
    var keyword = $('#inp-create-search').val();

    var case_id = filter_array(_getStorageData('batch_case_id'));

    $.post(sAjaxAdministrativeCase, {
        type: 'getAdministrativeCaseListReportForBatch',
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

function getAdministrativeCaseBatchList(page = 1) {
    var limit = 10;
    var keyword = $('#txt_search-batchlist').val();

    $.post(sAjaxAdministrativeCase, {
        type: 'getAdministrativeCaseBatchList',
        limit: limit,
        page: page,
        keyword: keyword
    }, function (rs) {

        var l = '';
        $('#ac_batch_list').html(l);

        if (rs.data.res.count > 0) {

            $('#cnt_ac_listing').show();
            $('#cnt_ac_listing-no-content').remove();

            $.each(rs.data.res.listing, function (key, val) {

                var status = '-';
                if (val.last_stage_status) {
                    // 0 - On going , 1 - Done 
                    status = 'On going';
                    if (val.last_stage_status == '1') {
                        status = 'Done';
                    }
                }

                var last_stage = '-';
                if (val.last_stage_id_name) {
                    last_stage = val.last_stage_id_name;
                }

//                l += '<li style="width:100%">';
//                l += '    <a  href="/admin_case_stages/' + val.legal_ac_docket_id + '" target="_blank">';
//                l += '        <div class="card batch-wrapper" >';
//                l += '            <div class="row">';
//                l += '                <div class="col-lg-3 col-md-6 col-sm-6">';
//                l += '                    <span class=""> Batch Number : </span><span class="icms-text-black label-bold">' + val.legal_ac_docket_number + '</span><br>';
//                l += '                </div>';
//                l += '                <div class="col-lg-3 col-md-6 col-sm-6">';
//                l += '                    <span class="">Created By : </span> <span class="icms-text-black">' + val.user_full_name + '</span><br>';
//                l += '                    <span class="">Date Created : </span> <span class="icms-text-black">' + val.legal_ac_docket_date_added + '</span>';
//                l += '                </div>';
//                l += '                <div class="col-lg-3 col-md-6 col-sm-6">';
//                l += '                    <span class="">Status: </span> <span class="icms-text-black">' + status + '</span><br>';
//                l += '                    <span class="">Stage : </span> <span class="icms-text-black">' + last_stage + '</span>';
//                l += '                </div>';
//                l += '                <div class="col-lg-3 col-md-6 col-sm-6">';
//                l += '                    <span class="status">' + val.victim_count + ' Victims</span>';
//                l += '                </div>';
//                l += '            </div>';
//                l += '        </div>';
//                l += '    </a>';
//                l += '</li>';

                l += '<li style="width:100%">';
                l += '    <a  href="/admin_case_stages/' + val.legal_ac_docket_id + '" target="_blank">';
                l += '        <div class="card batch-wrapper" >';
                l += '            <div class="row">';
                l += ' <div class="col-lg-6 col-md-12 col-sm-12">';
                l += '       <div class="row">';
                l += '            <div class="col-md-12 col-sm-12 col-lg-6">';
                l += '                 <span class=""> Batch Number : </span><span class="icms-text-black label-bold">' + val.legal_ac_docket_number + '</span><br>';
                l += '            </div>';
                l += '            <div class="col-md-12 col-sm-12 col-lg-6">';
                l += '                  <span class="">Created By : </span> <span class="icms-text-black">' + val.user_full_name + '</span><br>';
                l += '                  <span class="">Date Created : </span> <span class="icms-text-black">' + val.legal_ac_docket_date_added + '</span>';
                l += '            </div>';
                l += '       </div>';
                l += ' </div>';
                l += ' <div class="col-lg-6 col-md-12 col-sm-12">';
                l += '        <div class="row">';
                l += '             <div class="col-md-12 col-sm-12 col-lg-6">';
                l += '                  <span class="">Status: </span> <span class="icms-text-black">' + status + '</span><br>';
                l += '                  <span class="">Stage : </span> <span class="icms-text-black">' + last_stage + '</span>';
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
                parent: 'rs-list-batch_list',
                info: 'rs-info-batch_list',
                pagination: 'rs-pagination-batch_list',
                offset: 'rs-offset',
                data: {
                    page: page,
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

            $('#cnt_ac_listing').hide();
            $('#cnt_ac_listing-no-content').remove();
            $('#cnt_ac_listing').after("<div id='cnt_ac_listing-no-content' class='col-12'>" + l + "</div>");

        }

        $('#ac_batch_list').html(l);

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

    // give id in radio's
    var x = 0;
    jQuery(".inp-stat-ongoing:input[name='stage_status']").each(function () {
        $(this).attr('id', 'stage-ongoing-' + x);
        $(this).next().attr('for', 'stage-ongoing-' + x);
        x++;
    });

    var x = 0;
    jQuery(".inp-stat-done:input[name='stage_status']").each(function () {
        $(this).attr('id', 'stage-done-' + x);
        $(this).next().attr('for', 'stage-done-' + x);
        x++;
    });

    // remove batch_case_id to local storage 
    localStorage.removeItem('batch_case_id');

    // load report list 
    getAdministrativeCaseList();

    // initalize Stages 
    iniCaseStages();

    // reset ini display 
    defaulButtonDisplay();

    resetContent();

    /*
     *    Ini Datepicker
     */

    // for date
    $('.datepicker').datetimepicker({
        timepicker: false,
        format: 'm/d/Y',
    });
    // for date and time
    $('.datetimepicker').datetimepicker();


    // click edit in stages
    $('.btn-edit').click(function () {
        var stage_level = $(this).attr('data-stage_level');
        showButtonForUpdating();
        $(".form-stage-" + stage_level + " :input").prop("disabled", false);
        $('.modal-footer button').hide();
    });

    // click cancel in stages
    $('.btn-cancel').click(function () {

        var sForm = $(this).closest('form').attr('id');
        var iStatus = $("#" + sForm + " input[name='stage_status']:checked").val();
        var currentDetails = iStatus + getFormValues(sForm);
//        console.log('a->' + initialDetails);
//        console.log('b->' + currentDetails);
        var txt = sForm;
        var stage = txt.match(/\d/g);
        if (stage) {
            stage = stage.join("");
            if ((currentDetails != '') && (currentDetails != initialDetails)) {
                // have an update
                icmsMessage({
                    type: "msgConfirmation",
                    title: "You made some changes. Do you want to disregard changes?",
                    body: "Click yes button if you want to continue",
                    LblBtnConfirm: "Yes",
                    onConfirm: function () {
                        loadCriminalCaseInfoByStages(stage);
                    },
                    onCancel: function () {
                        $('#mdl-victim-details').modal('show');
                    },
                    onShow: function () {
                        $('#mdl-victim-details').modal('hide');
                    }
                });

            } else {
                // default body display  
                defaulButtonDisplay();
                removeErrorClass();
                $('.modal-footer button').show();
            }
        }
    });

    // report list tab
    $('#a-report_list').click(function () {
        getAdministrativeCaseList(1);
    });

    // administrative case list tab
    $('#a-administrative_list').click(function () {
        getAdministrativeCaseBatchList(1);
    });

    // change radio button  for status
    $('.form-check-input').change(function () {
        var status = $(this).val();
        var sName = "Status: On going";
        if (status == '1') {
            sName = "Status: Done";
        }
        $('.btn-quick-actions').text(sName);
    });

    // search in report list 
    // type
    $('#txt_search-report_list').on('keypress', function (e) {
        var keyword = $('#txt_search-report_list').val();
        if (e.which == 13) {
            getAdministrativeCaseList(1);
        }
    });

    // search in administrative case list 
    $('#txt_search-batchlist').on('keypress', function (e) {
        var keyword = $('#txt_search-batchlist').val();
        if (e.which == 13) {
            getAdministrativeCaseBatchList(1);
        }
    });

    // Pagination for report list
    $('.rs-list-rl').delegate('.page-link', 'click', function () {
        var page = parseInt($(this).attr('data-page'));
        getAdministrativeCaseList(page);
    });

    // Pagination for administrative case list 
    $('.rs-list-batch_list').delegate('.page-link', 'click', function () {
        var page = parseInt($(this).attr('data-page'));
        getAdministrativeCaseBatchList(page);
    });

    // click stages tab to view 
    $('#ul-stages').delegate('.card', 'click', function () {
        resetContent();
        var className = $(this).attr('attr-class_name');
        $('.' + className).show();
        $('.criminal_case').trigger('click');
        var aClassName = className.split('_');
        var stage = aClassName[aClassName.length - 1];

        // set attribute 
        $('.btn-edit').attr('data-stage_level', stage);
        $('.btn-cancel').attr('data-stage_level', stage);

        if ($('#tria_logs_tab').hasClass('active')) {
            $('#tria_logs_tab').removeClass('active show');
            $('#criminal_case_tab').addClass('active show');
        }
        $('.stage_1').removeClass('active').removeClass('show');
        defaulButtonDisplay();
        loadCriminalCaseInfoByStages(stage);
    });

    $('#ul-stages').delegate('.card', 'click', function () {
        resetContent();
        var className = $(this).attr('attr-class_name');
        $('.' + className).show();
        $('.criminal_case').trigger('click');

        var aClassName = className.split('_');
        var stage = aClassName[aClassName.length - 1];

        // set attribute 
        $('.btn-edit').attr('data-stage_level', stage);
        $('.btn-cancel').attr('data-stage_level', stage);

        if ($('#tria_logs_tab').hasClass('active')) {
            $('#tria_logs_tab').removeClass('active show');
            $('#criminal_case_tab').addClass('active show');
        }
        $('.stage_1').removeClass('active').removeClass('show');
        defaulButtonDisplay();
    });

    // Click victim List 
    $('#create-report-victim-search').delegate('.list-group-item', 'click', function () {

        var id = $(this).attr('data-id');

        if (id != '0') {
            var name = $(this).html();
            $('#create-tags').append('<div class="tag">' + name + '<span data-id="' + id + '">×</span></div>');
        }

        var storage = filter_array(_getStorageData('batch_case_id'));
        ;
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

    // modal open in report list 
    $('#rl-list').delegate('.li-a-rl_list', 'click', function () {
        var victim_id = $(this).attr('data-victim_id');
        var case_id = $(this).attr('data-case_id');
        $('#mdl-victim-details').attr('data-victim_id', victim_id);
        $('#mdl-victim-details').attr('data-case_id', case_id);
        $('#li-stage_1').click();
        legal_ac_case_no = 0;
    });

    $("#collapseList").addClass("show");
    $("#ul-stages li:first-child").addClass('active');

    $('#ul-stages').delegate('.card', 'click', function () {
        $(".col-tab-content div.stage-bg:first-child").removeClass('show');
    });

    $(".col-tab-content div:last-child").css({display: "block !important"});

    $('#ul-stages').delegate('.timeline-inverted', 'click', function () {
        var clickbtn = $(this);
        $("#collapseList").removeClass("show");
        if ($("#ul-stages>li").hasClass('active')) {
            $('.timeline-inverted').removeClass('active');
            clickbtn.addClass('active');
        }

    });

    $('.btn-nav-tab').on('click', function () {
        if ($('.btn-nav-tab').hasClass('active')) {
            $('.btn-nav-tab').removeClass('active');
        }
        var navbtn = $(this).attr('data-id');
        $('.' + navbtn).addClass('active');
    });

    // for search employer 
    $('#inp-create-search').on('keyup', function (e) {
        var keyword = $('#inp-create-search').val();
        delay(function () {
            if (keyword.length) {
                getAdministrativeCaseListReportForBatch();
            }
        }, 1000);
    });

    // for close modal create docket 
    $('#btn-close-mdl_create_batch').click(function () {
        var sCurrent = getFormValues('form-create_batch');
        sCurrent += localStorage.getItem('batch_case_id');
        if (sCurrent == 'null') {
            // no update 
            resetCreateDocket();
            $('#modal-create_new_batch').modal('hide');
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
                },
                onShow: function () {
                    $('#modal-create_new_batch').modal('hide');
                }
            });
        }
    })

    // reset when modal open 
//    $("#modal-create_new_batch .btn-modal-cancel").click(function () {
//        // reset form
//        $("#form-create_batch")[0].reset();
//        $('#create-tags').html('');
//        // remove batch_case_id to local storage 
//        localStorage.removeItem('batch_case_id');
//    });

    /*
     * Creat docket number 
     */

    // validate create batch     
    $('#form-create_batch').validate({
        rules: {
            inp_docket_num: {required: true, maxlength: 250,}
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


    /*
     * Stage 1 
     *   Filing and Receipt of Complaints
     */
    $('#form-stage-1').validate({
        rules: {
            case_number: {required: true, maxlength: 50},
            inp_date_remarks: {required: true},
            inp_remarks: {required: true, maxlength: 2000},
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
                title: 'You are about to update filing and receipt of complaints.',
                onShow: function () {
                    $('#mdl-victim-details').modal('hide');
                },
                onCancel: function () {
                    $('#mdl-victim-details').modal('show');
                },
                onConfirm: function () {
                    addSetFilingReceiptComplaints('1');
                }
            });
        }
    });

    /*
     * Stage 2 
     *  On-Site Complaints for Violation of POEA Rules
     */
    $('#form-stage-2').validate({
        rules: {
            inp_date_remarks: {required: true},
            inp_remarks: {required: true, maxlength: 2000},
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
                title: 'You are about to update on-site complaints for violation of POEA rules.',
                onShow: function () {
                    $('#mdl-victim-details').modal('hide');
                },
                onCancel: function () {
                    $('#mdl-victim-details').modal('show');
                },
                onConfirm: function () {
                    setDateRemarksPerStageId('2');
                }
            });
        }
    });

    /*
     * Stage 3
     *  Issuance and Implementation of Closure Order
     */
    $('#form-stage-3').validate({
        rules: {
            inp_date_remarks: {required: true},
            inp_remarks: {required: true, maxlength: 2000},
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
                title: 'You are about to update issuance and implementation of closure order.',
                onShow: function () {
                    $('#mdl-victim-details').modal('hide');
                },
                onCancel: function () {
                    $('#mdl-victim-details').modal('show');
                },
                onConfirm: function () {
                    setDateRemarksPerStageId('3');
                }
            });
        }
    });

    /*
     * Stage 4
     *  Mandatory Conciliation of Complaints
     */
    $('#form-stage-4').validate({
        rules: {
            inp_date_remarks: {required: true},
            inp_remarks: {required: true, maxlength: 2000},
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
                title: 'You are about to update mandatory conciliation of complaints.',
                onShow: function () {
                    $('#mdl-victim-details').modal('hide');
                },
                onCancel: function () {
                    $('#mdl-victim-details').modal('show');
                },
                onConfirm: function () {
                    setDateRemarksPerStageId('4');
                }
            });
        }
    });

});
