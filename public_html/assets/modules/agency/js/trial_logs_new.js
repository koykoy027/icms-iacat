var sCurrentUrl = window.location.href;
var aCurrentUrl = sCurrentUrl.split('/');
var legal_cc_batch_id = aCurrentUrl[aCurrentUrl.length - 1];
var sContent = '';
var initial_stage = 0;

var aStages = [

    {
        "content": [{
                "stage": "1",
                "stage_name": " <span class='  pl-1'>I</span>",
                "name": "  Filing of Complaint",
                "class_name": "stage_1"
            }]

    },
    {
        "content": [
            {
                "stage": "2",
                "stage_name": " <span class='  pl-1'>II</span> ",
                "name": "Preliminary Investigation",
                "class_name": "stage_2"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "3",
                "stage_name": " <span class='  pl-1'>III</span> ",
                "name": "Filing of Information in Court ",
                "class_name": "stage_3"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "4",
                "stage_name": " <span class='  pl-1'>IV</span>",
                "name": " Dismissal or Issuance of Warrant or Arrest or Commitment Order ",
                "class_name": "stage_4"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "5 ",
                "stage_name": " <span class='  pl-1'>V</span>",
                "name": " Bail-Hearing and Resolution of Petition for Bail ",
                "class_name": "stage_5"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "6",
                "stage_name": " <span class='  pl-1'>VI</span>",
                "name": " Arraignment and Pre-Trial Conference",
                "class_name": "stage_6"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "7",
                "stage_name": " <span class='  pl-1'>VII</span>",
                "name": "Trial ",
                "class_name": "stage_7"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "8",
                "stage_name": " <span class='  pl-1'>VIII</span>",
                "name": " Submission for Resolution ",
                "class_name": "stage_8"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "9",
                "stage_name": " <span class='  pl-1'>IX</span>",
                "name": " Promulgation of Judgment ",
                "class_name": "stage_9"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "10",
                "stage_name": "<span class='  pl-1'>X</span> ",
                "name": "Motion for Reconsideration or New Trial ",
                "class_name": "stage_10"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "11",
                "stage_name": " <span class='  pl-1'>XI</span>",
                "name": " Appeal to Court of Appeals ",
                "class_name": "stage_11"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "12",
                "stage_name": "<span class='  pl-1'>XII</span>  ",
                "name": " Motion for Reconsideration on the Decision of CA ",
                "class_name": "stage_12"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "13",
                "stage_name": " <span class='  pl-1'>XIII</span> ",
                "name": " Decision of CA",
                "class_name": "stage_13"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "14",
                "stage_name": " <span class='  pl-1'>XIV</span>",
                "name": "   Appeal to the Supreme Court",
                "class_name": "stage_14"
            }
        ]

    },
    {
        "content": [
            {
                "stage": "15",
                "stage_name": " <span class='  pl-1'>XV</span>",
                "name": "  Decision of SC",
                "class_name": "stage_15"
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

function loadCriminalCaseInfoByStages(stage) {

    initial_stage = stage;

    $('.form-check-input').prop('checked', false);

    // disable form
    $(".stage_" + stage + " form :input").prop("disabled", true);

    icmsMessage({
        type: 'msgPreloader',
        visible: true,
        body: 'Please wait while loading'
    });

    $.post(sAjaxCriminalCase, {
        type: 'loadCriminalCaseInfoByStages',
        stage: stage,
        legal_cc_batch_id: legal_cc_batch_id
    }, function (rs) {

        delay(function () {
            icmsMessage({
                type: 'msgPreloader',
                visible: false,
            });
        }, 500);

        var sStatus = 'Select Status';

        if (rs.data.flag = '1') {

            /*             * Status 
             *      0 - On going | 1 - Done              */

            sStatus = 'Status: On going';
            $('.inp-stat-ongoing').prop('checked', true);
            if (rs.data.res.legal_cc_batch_stage_status == '1') {
                sStatus = 'Status: Done';
                $('.inp-stat-done').prop('checked', true);
            }
            $('.btn-quick-actions').text(sStatus);

            /*             * End Status             */

            // for hide and show tab prelim
            if (stage == '2') {
                stage = '2_1';
            }

            if (stage == '7') {
                var l = '';
                $.each(rs.data.res, function (key, val) {
                    l += '<tr>';
                    l += '    <td>' + val.legal_cc_batch_court_trial_date_full + '</td>';
                    l += '    <td> ' + val.legal_cc_batch_court_trial_remarks + '</td>';
                    l += '</tr>';
                });

                $('#list-trial').html(l);
                $("#form-stage-7_1 button").prop("disabled", false);

            } else {

                $.each(rs.data.res, function (key, val) {
                    $('.stage' + stage + '-' + key).val(val);
                });

                $("#form-stage-" + stage + " input[name='inp_date_remarks']").val(rs.data.res.legal_cc_batch_stage_date);
                $("#form-stage-" + stage + " textarea[name='inp_remarks_desc']").val(rs.data.res.legal_cc_batch_stage_remarks);

                // set default button display 
                defaulButtonDisplay();
            }

            // set attribute 
            $('.btn-edit').attr('data-stage_level', stage);
            $('.btn-cancel').attr('data-stage_level', stage);

        } else {
            icmsMessage({
                type: 'msgWarning',
                onHide: function () {
                    location.reload('true');
                }
            });
        }
        var name_form = $('.stage_' + stage).find('form:first').attr('id');
        sContent = getFormValues(name_form);
        if (!sContent) {
            sContent = getFormValues('form-stage-' + stage);
        }

    }, 'json');
}

function setFillinfOfComplaint() {

    icmsMessage({
        type: 'msgPreloader',
        visible: true
    });


    var legal_cc_batch_nps_no = $('.stage1-legal_cc_batch_nps_no').val();
    var legal_cc_batch_prosecutor_office = $('.stage1-legal_cc_batch_prosecutor_office').val();
    var legal_cc_batch_investigating_name = $('.stage1-legal_cc_batch_investigating_name').val();
    var legal_cc_batch_case_title = $('.stage1-legal_cc_batch_case_title').val();
    var legal_cc_batch_date_filed = $('.stage1-legal_cc_batch_date_filed').val();
    var legal_cc_batch_stage_status = $("#form-filling_complaint input[name='stage_status']:checked").val();

    $.post(sAjaxCriminalCase, {
        type: 'setFillinfOfComplaint',
        legal_cc_batch_id: legal_cc_batch_id,
        legal_cc_batch_nps_no: legal_cc_batch_nps_no,
        legal_cc_batch_date_filed: legal_cc_batch_date_filed,
        legal_cc_batch_prosecutor_office: legal_cc_batch_prosecutor_office,
        legal_cc_batch_investigating_name: legal_cc_batch_investigating_name,
        legal_cc_batch_case_title: legal_cc_batch_case_title,
        legal_cc_batch_stage_status: legal_cc_batch_stage_status
    }, function (rs) {

        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });

        if (typeof (rs.data.flag = '1')) {
            icmsMessage({
                type: 'msgSuccess',
                onShow: function () {
                    defaulButtonDisplay();
                    removeErrorClass();
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

}

function setDateRemarksPerStageId(stage) {

    icmsMessage({
        type: 'msgPreloader',
        visible: true
    });

    var legal_cc_batch_stage_status = $("#form-stage-" + stage + " input[name='stage_status']:checked").val();
    var date_remarks = $("#form-stage-" + stage + " input[name='inp_date_remarks']").val();
    var remarks = $("#form-stage-" + stage + " textarea[name='inp_remarks_desc']").val();


    $.post(sAjaxCriminalCase, {
        type: 'setDateRemarksPerStageId',
        legal_cc_batch_id: legal_cc_batch_id,
        stage: stage,
        date_remarks: date_remarks,
        remarks: remarks,
        legal_cc_batch_stage_status: legal_cc_batch_stage_status
    }, function (rs) {

        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });

        if (rs.data.flag = '1') {
            icmsMessage({
                type: 'msgSuccess',
                onShow: function () {
                    defaulButtonDisplay();
                    removeErrorClass();
                },
                onHide: function () {
                    if (stage == '7') {
                        // reset trial form
                        $('#form-stage-7')[0].reset();
                        loadCriminalCaseInfoByStages(stage);
                    }
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
}

function setFillingInformationInCourt() {

    icmsMessage({
        type: 'msgPreloader',
        visible: true
    });

    var legal_cc_batch_stage_date = $('.stage3-legal_cc_batch_stage_date').val();
    var legal_cc_batch_criminal_no = $('.stage3-legal_cc_batch_criminal_no').val();
    var legal_cc_batch_criminal_case_title = $('.stage3-legal_cc_batch_criminal_case_title').val();
    var legal_cc_batch_prosecutor_name = $('.stage3-legal_cc_batch_prosecutor_name').val();
    var legal_cc_batch_prosecutor_office_address = $('.stage3-legal_cc_batch_prosecutor_office_address').val();
    var legal_cc_batch_judge_name = $('.stage3-legal_cc_batch_judge_name').val();
    var legal_cc_batch_branch_no = $('.stage3-legal_cc_batch_branch_no').val();
    var legal_cc_batch_stage_status = $("#form-filing_court input[name='stage_status']:checked").val();

    $.post(sAjaxCriminalCase, {
        type: 'setFillingInformationInCourt',
        legal_cc_batch_id: legal_cc_batch_id,
        legal_cc_batch_stage_date: legal_cc_batch_stage_date,
        legal_cc_batch_criminal_no: legal_cc_batch_criminal_no,
        legal_cc_batch_criminal_case_title: legal_cc_batch_criminal_case_title,
        legal_cc_batch_prosecutor_name: legal_cc_batch_prosecutor_name,
        legal_cc_batch_prosecutor_office_address: legal_cc_batch_prosecutor_office_address,
        legal_cc_batch_judge_name: legal_cc_batch_judge_name,
        legal_cc_batch_branch_no: legal_cc_batch_branch_no,
        legal_cc_batch_stage_status: legal_cc_batch_stage_status
    }, function (rs) {

        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });

        if (typeof (rs.data.flag = '1')) {
            icmsMessage({
                type: 'msgSuccess',
                onShow: function () {
                    defaulButtonDisplay();
                    removeErrorClass();
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
}

function iniCaseStages() {
    var l = '';
    $.each(aStages, function (key, val) {
        var aContent = val.content;
        var iCount = aContent.length;

        switch (parseInt(iCount)) {
            case 1:
                l += ' <li class="timeline-inverted">';
                l += '     <div class="timeline-badge warning"></div>';
                l += '     <div class="card card-tabs ' + aContent[0]['name'] + '" style="background-color:#f5f6fa; " attr-class_name = "' + aContent[0]['class_name'] + '">';
                l += '         <div class="card-body">';
                l += '           <div class="row">';
                l += '           <div class="col-lg-2 col-md-3 col-sm-3 card-sub-title_ blue  px-0" style="text-align: center;">';
                l += aContent[0]['stage_name'];
                l += '             </div>';
                l += '           <div class="col-lg-10 col-md-9 col-sm-9 card-sub-title_ blue  px-0" style="    text-align: center;">';
                l += aContent[0]['name'];
                l += '             </div>';
                l += '           <div>';
                l += '         </div>';
                l += '     </div>';
                l += ' </li>';
                break;
            case 2:
                l += '<li class="timeline-inverted">';
                l += '    <div class="timeline-badge warning"></div>';
                l += '    <div class="card ' + aContent[0]['name'] + '" style="background-color:#f5f6fa; " attr-class_name = "' + aContent[0]['class_name'] + '">';
                l += '        <div class="card-body">';
                l += '            <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title_ blue" style="padding: 0px;">' + aContent[0]['name'] + '</div>';
                l += '        </div>';
                l += '    </div>';
                l += '    <div class="card ' + aContent[1]['name'] + '" style=" background-color: #f5f6fa; margin-left: -134px; margin-top: -72px; width: 90px;" attr-class_name = "' + aContent[1]['class_name'] + '">';
                l += '        <div class="card-body">';
                l += '            <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title_ blue" style="padding: 0px;">' + aContent[1]['name'] + '</div>';
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

    // disabled forms 
    $("form :input").prop("disabled", true);

    // enable trial
    $("#form-stage-7 :input").prop("disabled", false);

    // enable update button 
    $(".btn").prop("disabled", false);
    $(".btn-quick-actions").prop("disabled", true);

}

function showButtonForUpdating() {
    $('.btn-edit').hide();
    $('.btn-submit').show();
    $('.btn-cancel').show();
}

function getVictimListPerBatch() {

    var l = '';
    $.post(sAjaxCriminalCase, {
        type: 'getVictimListPerBatch',
        legal_cc_batch_id: legal_cc_batch_id
    }, function (rs) {

        if (rs.data.res.length > 0) {
            $.each(rs.data.res, function (key, val) {

                sCheck = '';
                if (val.legal_cc_batch_victim_is_active == '1') {
                    sCheck = 'checked';
                }

                l += '<tr>';
                l += '    <td>' + val.victim_info_first_name + ' ' + val.victim_info_middle_name + ' ' + val.victim_info_last_name + ' ' + val.victim_info_suffix + '</td>';
                l += '    <td class="text-gray-500">' + val.legal_cc_slip_investigation_no + '</td>';
                l += '    <td>';
                l += '        <div class="custom-control custom-switch">';
                l += '            <input type="checkbox" class="custom-control-input inp-chck-victim" id="' + val.legal_cc_batch_victim_id + '" ' + sCheck + '>';
                l += '            <label class="custom-control-label active" for="' + val.legal_cc_batch_victim_id + '"></label>';
                l += '        </div>';
                l += '    </td>';
                l += '</tr>';

            });
        }
        $('#list-victim').html(l);
    }, 'json');
}

function setBatchVictimStatus(legal_cc_batch_victim_id, status) {

    $.post(sAjaxCriminalCase, {
        type: 'setBatchVictimStatus',
        legal_cc_batch_id: legal_cc_batch_id,
        legal_cc_batch_victim_id: legal_cc_batch_victim_id,
        status: status
    }, function (rs) {
        if (typeof (rs.data.flag = '1')) {
            icmsMessage({
                type: 'msgSuccess',
                body: 'Victim status was been updated '
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
}

function setStatusTrial(status) {
    $.post(sAjaxCriminalCase, {
        type: 'setStatusTrial',
        legal_cc_batch_id: legal_cc_batch_id,
        legal_cc_batch_stage_status: status
    }, function (rs) {
        if (typeof (rs.data.flag = '1')) {
            icmsMessage({
                type: 'msgSuccess',
                body: 'VII Trial status was updated'
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
}

function getLogsByCCBatchId(page) {
    var limit_count = 10;
    var limit_start = (page * limit_count) - limit_count;
    $.post(sAjaxCriminalCase, {
        type: "getLogsByCCBatchId",
        limit_start: limit_start,
        limit_count: limit_count,
        legal_cc_batch_id: legal_cc_batch_id
    }, function (rs) {
        if (rs.data.count >= 1) {
            var list = "";
            $.each(rs.data.list, function (key, val) {
                list += '<li class="list-dashboard">';
                list += '    <div class="row">';
                list += '         <div class="col-md-12 col-sm-12 col-lg-9">';
                list += '               <div class="row">';
                list += '                     <div class="col-md-2 col-sm-2 col-lg-2">';
                list += '                            <div class="p-2 bd-highlight"><span class="notif-type-badge ' + val.badge_class + '"><i class="' + val.badge + '" aria-hidden="true"></i></span></div>';
                list += '                      </div>';
                list += '                      <div class="col-md-10 col-sm-10 col-lg-10">';
                list += '                           <div class="p-2 bd-highlight"> <span class="case-id"  style="font-size: 15px;font-weight: 600;">' + val.user_log_fullname + ' </span><span class=""> ' + val.user_log_message + ' on ' + val.user_log_date_added + '</span><br>';
                list += '                                <span class="text-gray-500">' + val.agency_abbr + ' - ' + val.agency_branch + '</span>';
                list += '                           </div>';
                list += '                       </div>';
                list += '                </div>';
                list += '         </div>';
                list += '         <div class="col-md-12 col-sm-12 col-lg-3">';
                list += '              <div class="icms-btn-secondary p-r-10 "> <i class="fa fa-clock-o p-r-10 text-gray-500" aria-hidden="true"></i>' + jQuery.timeago(val.user_log_date_added) + '</div>';
                list += '         </div>';
                list += '     </div>';
                list += '</li>';
            });
            $('#list-all_logs').append(list);
            if (rs.data.count <= (page * limit_count) && rs.data.count >= limit_start) {
                $('#act-logs-content').attr('datapageend', 1);
                $('#act-logs-content').append("<center class='end_user_logs'>End of user logs</center>");
            }
        } else {
            if ($('#act-logs-content').attr('datapageend') == "0") {
                $('#list-all_logs').html("<li><hr><center>No activity logs found<li></center>");
            } else {
                $('#list-all_logs').html("<li><hr><center>End of activity logs<li></center>");
            }
            $('#act-logs-content').attr('datapageend', 1);
        }
    }, 'json');
}

$(document).ready(function () {

    // load Criminal Case Info stage 1 
    loadCriminalCaseInfoByStages(1);

    // reset content
    resetContent();
    //  ini Case Stages 
    iniCaseStages();

    // click see activity logs 
    $('#tria_logs').click(function () {
        // clear content 
        $('#list-all_logs').html('');
        $('#act-logs-content').attr('datapage', '1');
        $('#act-logs-content').attr('datapageend', '0');
        $('.end_user_logs').remove();
        // load cc logs 
        getLogsByCCBatchId(1);
    });

    //  scroll 
    $('#act-logs-content').bind('scroll', function () {
        if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            if ($('#act-logs-content').attr('datapageend') == "0") {
                var page = $('#act-logs-content').attr('datapage');
                page = parseInt(page) + 1;
                $('#act-logs-content').attr('datapage', page);
                getLogsByCCBatchId(page);
            }
        }
    });


    // disabled forms inputs
    $("form :input").prop("disabled", true);

    // enable forms input
    $('.btn-update-stage').click(function () {
        var stage_level = $(this).attr('data-stage_level');
        $(".stage_" + stage_level + " form :input").prop("disabled", false);
    });

    // click edit 
    $('.btn-edit').click(function () {
        var stage_level = $(this).attr('data-stage_level');
        showButtonForUpdating();
        $(".stage_" + stage_level + " form :input").prop("disabled", false);
        $("#form-stage-" + stage_level + " :input").prop("disabled", false);
    });

    // click cancel 
    $('.btn-cancel').click(function () {

        var name_form = $('.stage_' + initial_stage).find('form:first').attr('id');
        sCurrent = getFormValues(name_form);
        if (!sCurrent) {
            sCurrent = getFormValues('form-stage-' + initial_stage);
        }

        if (sCurrent == sContent) {
            defaulButtonDisplay();
            removeErrorClass();
        } else {
            // have an update
            icmsMessage({
                type: "msgConfirmation",
                title: "You made some changes. Do you want to disregard changes?",
                body: "Click yes button if you want to continue",
                LblBtnConfirm: "Yes",
                onConfirm: function () {
                    loadCriminalCaseInfoByStages(initial_stage);
                    defaulButtonDisplay();
                    removeErrorClass();
                },
            });
        }

    });

    $('#mdl_trial .btn-next').click(function () {
        $("#mdl_trial").attr('data-add', 1);
    })

    $('#btn-trig-mdl_trial').click(function () {
        $("#mdl_trial").attr('data-add', 0);
    })

    // modal close 
    $("#mdl_trial").on('hide.bs.modal', function () {
        if ($("#mdl_trial").attr('data-add') == '0') {
            $('#form-stage-7_1 .btn-quick-actions').prop("disabled", false);
            sCurrent = getFormValues('form-stage-7');
            if (sCurrent !== '') {
                icmsMessage({
                    type: "msgConfirmation",
                    title: "You made some changes. Do you want to disregard changes?",
                    body: "Click yes button if you want to continue",
                    LblBtnConfirm: "Yes",
                    onConfirm: function () {
                        removeErrorClass();
                        $("#form-stage-7").validate().resetForm();
                        $("#form-stage-7")[0].reset();
                    },
                    onCancel: function () {
                        $("#mdl_trial").modal('show');
                    }
                });
            }
        }
    });

    // change radio button 

    $('.form-check-input').change(function () {
        var status = $(this).val();
        var sName = "Status: On going";
        if (status == '1') {
            sName = "Status: Done";
        }
        $('.btn-quick-actions').text(sName);
    });


//    $('#list-victim').html(l);   inp-chck-victim

    // radio box for on/off victim list 
    $('#list-victim').delegate('.inp-chck-victim', 'click', function () {
        var legal_cc_batch_victim_id = $(this).attr('id');
        var status = 1;
        if ($(this).is(":not(:checked)")) {
            status = 0;
        }
        setBatchVictimStatus(legal_cc_batch_victim_id, status);
    });



    /*
     *    Ini Datepicker
     */

    // for date
    $('.datepicker').datetimepicker({
        timepicker: false,
        format: 'm/d/Y',
        scrollMonth: false,
        scrollInput: false
    });
    // for date and time
    $('.datetimepicker').datetimepicker({
        scrollMonth: false,
        scrollInput: false
    });

    // select primary stage 
    $('#ul-stages').delegate('.card', 'click', function () {

        defaulButtonDisplay();

        $(".stage_1").removeClass('show');
        if ($(".col-tab-content.stage").hasClass('show')) {
            $('.stage').removeClass('show');
        }
        $('.criminal_case').trigger('click');
        if ($('#tria_logs_tab').hasClass('active')) {
            $('#tria_logs_tab').removeClass('active show');
            $('#criminal_case_tab').addClass('active show');
        }
        resetContent();
        var className = $(this).attr('attr-class_name');
        var aClassName = className.split('_');
        var stage_id = aClassName[aClassName.length - 1];

        // show content
        $('.' + className).show();

        loadCriminalCaseInfoByStages(stage_id);

        if (stage_id == '7') {
            $(".stage_7 form :input").prop("disabled", false);
            $("#form-stage-7_1 :input").prop("disabled", false);
        } else if (stage_id == '2') {
            $('.stage_2 .tab-pane').removeClass('show');
            $('#list-tab .list-group-item-action').removeClass('active');
            $('#list-tab .list-group-item-action[attr-stage="2_1"]').click();
        }

        removeErrorClass();

    });


    // select sub stage 2
    $('#list-tab').delegate('.list-group-item-action ', 'click', function () {
        defaulButtonDisplay();

        var stage_id = $(this).attr('attr-stage');
        loadCriminalCaseInfoByStages(stage_id);

        removeErrorClass();
    });

    // trial status 

    $('#form-stage-7_1').delegate('.form-check-input', 'change', function () {
        var status = $(this).val();
        setStatusTrial(status);
    });


    $("#collapseList").addClass("show");
    $("#ul-stages li:first-child").addClass('active');
    $(".col-tab-content div.stage:first-child").addClass('show');
    $(".col-tab-content div:last-child").css({display: "block !important"});

    $('#ul-stages').delegate('.card', 'click', function () {
        $(".col-tab-content div:last-child").removeClass('show');
    });

    $('#ul-stages').delegate('.timeline-inverted', 'click', function () {
        var clickbtn = $(this);
        $("#collapseList").removeClass("show")
        if ($("#ul-stages>li").hasClass('active')) {
            $('.timeline-inverted').removeClass('active');
            clickbtn.addClass('active');
        }

    });

    $('#btnCollapse').click(function () {
        if ($('#collapseVictim').hasClass('show')) {
            // hide victim list 
            $('#btnCollapse').text(' View victim list');
            $('#btnCollapse').removeClass('btn-victim-hover').addClass('btn-light');
        } else {

            // show victim list 
            /*             * load victim list              */
            getVictimListPerBatch();

            $('#btnCollapse').text(' Close victim list');
            $('#btnCollapse').addClass('btn-victim-hover').removeClass('btn-light');
        }
    });


    $('.btn-nav-tab').on('click', function () {
        if ($('.btn-nav-tab').hasClass('active')) {
            $('.btn-nav-tab').removeClass('active');
        }
        var navbtn = $(this).attr('data-id');
        $('.' + navbtn).addClass('active');
    });



    if ($('#collapseVictim').hasClass('show')) {
    }

    /*
     * **** Stage 1 ***
     */

    // validate  form Filing of Complaint
    $('#form-filling_complaint').validate({
        rules: {
            legal_cc_batch_nps_no: {required: true, maxlength: 100},
            legal_cc_batch_nps_no: {required: true, maxlength: 100}
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
                title: 'You are about to update filling of complaint.',
                onConfirm: function () {
                    setFillinfOfComplaint();
                }
            });
        }
    });

    /*
     * *** Stage 2 *** 
     */

    // validate form priliminary investigation 
    $('#form-stage-2_1').validate({
        rules: {
            inp_date_remarks: {required: true},
            inp_remarks_desc: {required: true, maxlength: 2000}
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
                title: 'You are about to update preliminary investigation.',
                onConfirm: function () {
                    setDateRemarksPerStageId('2_1');
                }
            });
        }
    });

    // validate form inquest
    $('#form-stage-2_2').validate({
        rules: {
            inp_date_remarks: {required: true},
            inp_remarks_desc: {required: true, maxlength: 2000}
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
                title: 'You are about to update inquest.',
                onConfirm: function () {
                    setDateRemarksPerStageId('2_2');
                }
            });
        }
    });

    // validate form Resolution of the Investigation Prosecutor
    $('#form-stage-2_3').validate({
        rules: {
            inp_date_remarks: {required: true},
            inp_remarks_desc: {required: true, maxlength: 2000}
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
                title: 'You are about to update resolution of the investigation prosecutor.',
                onConfirm: function () {
                    setDateRemarksPerStageId('2_3');
                }
            });
        }
    });

    // validate form Motion for Reconsideration on the Resolution
    $('#form-stage-2_4').validate({
        rules: {
            inp_date_remarks: {required: true},
            inp_remarks_desc: {required: true, maxlength: 2000}
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
                title: 'You are about to update motion for reconsideration on the resolution.',
                onConfirm: function () {
                    setDateRemarksPerStageId('2_4');
                }
            });
        }
    });

    // validate form Motion for Resolution of the Investigation Prosecutor
    $('#form-stage-2_5').validate({
        rules: {
            inp_date_remarks: {required: true},
            inp_remarks_desc: {required: true, maxlength: 2000}
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
                title: 'You are about to update review of the city or provincial prosecutor.',
                onConfirm: function () {
                    setDateRemarksPerStageId('2_5');
                }
            });
        }
    });

    // validate form Petition for review to the Secretary of Justice
    $('#form-stage-2_6').validate({
        rules: {
            inp_date_remarks: {required: true},
            inp_remarks_desc: {required: true, maxlength: 2000}
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
                title: 'You are about to update petition for review to the secretary of justice.',
                onConfirm: function () {
                    setDateRemarksPerStageId('2_6');
                }
            });
        }
    });

    // validate form Motion for Reconsideration on the Resolution of the SOJ
    $('#form-stage-2_7').validate({
        rules: {
            inp_date_remarks: {required: true},
            inp_remarks_desc: {required: true, maxlength: 2000}
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
                title: 'You are about to update motion for reconsideration on the resolution of the SOJ.',
                onConfirm: function () {
                    setDateRemarksPerStageId('2_7');
                }
            });
        }
    });

    /*
     * Stage 3 
     */

    // validate  form Filing of Information in Court
    $('#form-filing_court').validate({
        rules: {
            inp_date_remarks: {required: true},
            legal_cc_batch_criminal_no: {required: true, maxlength: 100},
            legal_cc_batch_criminal_case_title: {required: true, maxlength: 100},
            legal_cc_batch_prosecutor_name: {required: true, maxlength: 100},
            legal_cc_batch_prosecutor_office_address: {required: true, maxlength: 100},
            legal_cc_batch_judge_name: {required: true, maxlength: 100},
            legal_cc_batch_branch_no: {required: true, maxlength: 100}
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
                title: 'You are about to update filing of information in court.',
                onConfirm: function () {
                    setFillingInformationInCourt();
                },
                onCancel: function () {

                }
            });
        }
    });

    /*
     * Stage 4 
     */

    // validate form Dismissal or Issuance of Warrant or Arrest or Commitment Order
    $('#form-stage-4').validate({
        rules: {
            inp_date_remarks: {required: true},
            inp_remarks_desc: {required: true, maxlength: 2000}
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
                title: 'You are about to update dismissal or issuance of warrant or arrest or commitment Order.',
                onConfirm: function () {
                    setDateRemarksPerStageId('4');
                }
            });
        }
    });

    /*
     * Stage 5
     */

    // validate form Bail-Hearing and Resolution of Petition for Bail
    $('#form-stage-5').validate({
        rules: {
            inp_date_remarks: {required: true},
            inp_remarks_desc: {required: true, maxlength: 2000}
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
                title: 'You are about to update bail-hearing and resolution of petition for bail.',
                onConfirm: function () {
                    setDateRemarksPerStageId('5');
                }
            });
        }
    });

    /*
     * Stage 6
     */

    $('#form-stage-6').validate({
        rules: {
            inp_date_remarks: {required: true},
            inp_remarks_desc: {required: true, maxlength: 2000}
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
                title: 'You are about to update arraignment and pre-trial conference',
                onConfirm: function () {
                    setDateRemarksPerStageId('6');
                }
            });
        }
    });

    /*
     * Stage 7
     */

    $('#form-stage-7').validate({
        rules: {
            inp_date_remarks: {required: true},
            inp_remarks_desc: {required: true, maxlength: 2000}
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
                title: 'You are about to update trial.',
                onConfirm: function () {
                    setDateRemarksPerStageId('7');
                },
                onShow: function () {
                    $('#mdl_trial').modal('hide');
                },
                onCancel: function () {
                    $('#mdl_trial').modal('show');
                }
            });
        }
    });

    /*
     * Stage 8
     */

    $('#form-stage-8').validate({
        rules: {
            inp_date_remarks: {required: true},
            inp_remarks_desc: {required: true, maxlength: 2000}
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
                title: 'You are about to update submission for resolution.',
                onConfirm: function () {
                    setDateRemarksPerStageId('8');
                }
            });
        }
    });

    /*
     * Stage 9
     */

    $('#form-stage-9').validate({
        rules: {
            inp_date_remarks: {required: true},
            inp_remarks_desc: {required: true, maxlength: 2000}
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
                title: 'You are about to update promulgation of judgment.',
                onConfirm: function () {
                    setDateRemarksPerStageId('9');
                }
            });
        }
    });

    /*
     * Stage 10
     */

    $('#form-stage-10').validate({
        rules: {
            inp_date_remarks: {required: true},
            inp_remarks_desc: {required: true, maxlength: 2000}
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
                title: 'You are about to update motion for reconsideration or new trial.',
                onConfirm: function () {
                    setDateRemarksPerStageId('10');
                }
            });
        }
    });

    /*
     * Stage 11
     */

    $('#form-stage-11').validate({
        rules: {
            inp_date_remarks: {required: true},
            inp_remarks_desc: {required: true, maxlength: 2000}
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
                title: 'You are about to update appeal to court of appeals.',
                onConfirm: function () {
                    setDateRemarksPerStageId('11');
                }
            });
        }
    });

    /*
     * Stage 12
     */

    $('#form-stage-12').validate({
        rules: {
            inp_date_remarks: {required: true},
            inp_remarks_desc: {required: true, maxlength: 2000}
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
                title: 'You are about to update motion for reconsideration on the decision of CA.',
                onConfirm: function () {
                    setDateRemarksPerStageId('12');
                }
            });
        }
    });

    /*
     * Stage 13
     */

    $('#form-stage-13').validate({
        rules: {
            inp_date_remarks: {required: true},
            inp_remarks_desc: {required: true, maxlength: 2000}
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
                title: 'You are about to update decision of CA.',
                onConfirm: function () {
                    setDateRemarksPerStageId('13');
                }
            });
        }
    });

    /*
     * Stage 14
     */

    $('#form-stage-14').validate({
        rules: {
            inp_date_remarks: {required: true},
            inp_remarks_desc: {required: true, maxlength: 2000}
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
                title: 'You are about to update appeal to the supreme court.',
                onConfirm: function () {
                    setDateRemarksPerStageId('14');
                }
            });
        }
    });

    /*
     * Stage 15
     */

    $('#form-stage-15').validate({
        rules: {
            inp_date_remarks: {required: true},
            inp_remarks_desc: {required: true, maxlength: 2000}
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
                title: 'You are about to update decision of SC.',
                onConfirm: function () {
                    setDateRemarksPerStageId('15');
                }
            });
        }
    });

});
