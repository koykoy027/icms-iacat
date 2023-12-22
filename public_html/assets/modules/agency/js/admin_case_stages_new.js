var sCurrentUrl = window.location.href;
var aCurrentUrl = sCurrentUrl.split('/');
var legal_ac_docket_id = aCurrentUrl[aCurrentUrl.length - 1];
var initialDetails = '';

var aStagesAdmin = [{
        "content": [{
                "stage": "1",
                "stage_name": " <span class='  pl-1'>I</span>",
                "name": " Docketing and Assignment of Cases",
                "class_name": "stage_1"
            }]

    },
    {
        "content": [{
                "stage": "2",
                "stage_name": " <span class='  pl-1'>II</span>",
                "name": " Conciliation Stage",
                "class_name": "stage_2"
            }]

    },
    {
        "content": [{
                "stage": "3",
                "stage_name": " <span class='  pl-1'>III</span>",
                "name": " Issuance of Order of preventive suspension",
                "class_name": "stage_3"
            }]
    },
    {
        "content": [{
                "stage": "4",
                "stage_name": " <span class='  pl-1'>IV</span>",
                "name": "Preliminary Hearing",
                "class_name": "stage_4"
            }]
    },
    {
        "content": [{
                "stage": "5",
                "stage_name": " <span class='  pl-1'>V</span>",
                "name": " Submission for Resolution",
                "class_name": "stage_5"
            }]
    },
    {
        "content": [{
                "stage": "6",
                "stage_name": " <span class='  pl-1'>VI</span>",
                "name": " Resolution of the Case",
                "class_name": "stage_6"
            }]
    },
    {
        "content": [{
                "stage": "7",
                "stage_name": " <span class='  pl-1'>VII</span>",
                "name": " Appeal to the DOLE Secretary",
                "class_name": "stage_7"
            }]
    },
    {
        "content": [{
                "stage": "8",
                "stage_name": " <span class='  pl-1'>VIII </span>",
                "name": " Writ of Execution",
                "class_name": "stage_8"
            }]
    },
];

function resetContentAdminStage() {
    $.each(aStagesAdmin, function (sKey, aVal) {
        $.each(aVal.content, function (cKey, cVal) {
            $('.' + cVal.class_name).hide();
        });
    });
}

function showButtonForUpdating() {
    $('.btn-edit').hide();
    $('.btn-submit').show();
    $('form .btn-cancel').show();
}

function defaulButtonDisplay() {
    $('.btn-edit').show();
    $('.btn-submit').hide();
    $('form .btn-cancel').hide();
    $(".btn-modal-cancel").show();

    // disabled forms 
    $("form :input").prop("disabled", true);

    // enable update button 
    $(".btn").prop("disabled", false);
    $(".btn-quick-actions").prop("disabled", true);

}

function loadAdministrativeCaseInfoBatchByStages(stage) {

    $('.form-check-input').prop('checked', false);

    icmsMessage({
        type: 'msgPreloader',
        visible: true,
        body: 'Please wait while loading'
    });

    $.post(sAjaxAdministrativeCase, {
        type: 'loadAdministrativeCaseInfoBatchByStages',
        stage: stage,
        legal_ac_docket_id: legal_ac_docket_id
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
            iStatus = 0;
            $('.inp-stat-ongoing').prop('checked', true);
            if (rs.data.res.legal_ac_docket_log_status == '1') {
                sStatus = 'Status: Done';
                $('.inp-stat-done').prop('checked', true);
                iStatus = 1;
            }
            $('.btn-quick-actions').text(sStatus);

            /*             * End Status             */

            $("#form-stage-" + stage + " input[name='inp_date_remarks']").val(rs.data.res.legal_ac_docket_log_date);
            $("#form-stage-" + stage + " textarea[name='inp_remarks']").val(rs.data.res.legal_ac_docket_log_remarks);
            if (stage === '3') {
                $("#form-stage-" + stage + " select[name='inp_issue_status']").val(rs.data.res.legal_ac_docket_log_param_one);
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

function iniCaseStages() {
    var l = '';
    $.each(aStagesAdmin, function (key, val) {
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
                l += '           <div class="col-lg-10 col-md-9 col-sm-9 card-sub-title_ blue mb-0 px-0" style="    text-align: center;">';
                l += aContent[0]['name'];
                l += '             </div>';
                l += '             </div>';
                l += '         </div>';
                l += '     </div>';
                l += ' </li>';
                break;
            case 2:
                l += '<li class="timeline-inverted">';
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

    $('#ul-stages_admin_case').html(l);

}

function setDateRemarksPerDocketStageId(stage) {

    icmsMessage({
        type: 'msgPreloader',
        visible: true
    });

    var legal_ac_docket_log_status = $("#form-stage-" + stage + " input[name='stage_status']:checked").val();
    var legal_ac_docket_log_date = $("#form-stage-" + stage + " input[name='inp_date_remarks']").val();
    var legal_ac_docket_log_remarks = $("#form-stage-" + stage + " textarea[name='inp_remarks']").val();

    $.post(sAjaxAdministrativeCase, {
        type: 'setDateRemarksPerDocketStageId',
        legal_ac_docket_id: legal_ac_docket_id,
        legal_ac_docket_log_status: legal_ac_docket_log_status,
        legal_ac_docket_log_date: legal_ac_docket_log_date,
        legal_ac_docket_log_remarks: legal_ac_docket_log_remarks,
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
                    //$('.btn-cancel').click();
                    defaulButtonDisplay();
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

/*
 * For form with Param one
 * @param {type} stage
 * @return {undefined}
 */
function setPerDocketStageId(stage) {

    icmsMessage({
        type: 'msgPreloader',
        visible: true
    });

    var legal_ac_docket_log_param_one = $("#form-stage-" + stage + " select[name='inp_issue_status']").val();
    var legal_ac_docket_log_status = $("#form-stage-" + stage + " input[name='stage_status']:checked").val();
    var legal_ac_docket_log_date = $("#form-stage-" + stage + " input[name='inp_date_remarks']").val();
    var legal_ac_docket_log_remarks = $("#form-stage-" + stage + " textarea[name='inp_remarks']").val();

    $.post(sAjaxAdministrativeCase, {
        type: 'setDateRemarksPerDocketStageId',
        legal_ac_docket_id: legal_ac_docket_id,
        legal_ac_docket_log_status: legal_ac_docket_log_status,
        legal_ac_docket_log_date: legal_ac_docket_log_date,
        legal_ac_docket_log_remarks: legal_ac_docket_log_remarks,
        legal_ac_docket_log_param_one: legal_ac_docket_log_param_one,
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
                    //$('.btn-cancel').click();
                    defaulButtonDisplay();
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

function getVictimListPerBatch() {
    var l = '';
    $.post(sAjaxAdministrativeCase, {
        type: 'getVictimListPerBatch',
        legal_ac_docket_id: legal_ac_docket_id
    }, function (rs) {

        if (rs.data.res.length > 0) {
            $.each(rs.data.res, function (key, val) {

                sCheck = '';
                if (val.legal_ac_docket_is_active == '1') {
                    sCheck = 'checked';
                }

                l += '<tr>';
                l += '    <td>' + val.victim_info_first_name + ' ' + val.victim_info_middle_name + ' ' + val.victim_info_last_name + ' ' + val.victim_info_suffix + '</td>';
                l += '    <td class="text-gray-500">' + val.legal_ac_case_no + '</td>';
                l += '    <td>';
                l += '        <div class="custom-control custom-switch">';
                l += '            <input type="checkbox" class="custom-control-input inp-chck-victim" id="' + val.legal_ac_docket_case_id + '" ' + sCheck + '>';
                l += '            <label class="custom-control-label active" for="' + val.legal_ac_docket_case_id + '"></label>';
                l += '        </div>';
                l += '    </td>';
                l += '</tr>';

            });
        }
        $('#list-victim').html(l);
    }, 'json');
}

function setBatchVictimStatus(legal_ac_docket_case_id, status) {

    $.post(sAjaxAdministrativeCase, {
        type: 'setBatchVictimStatus',
        legal_ac_docket_id: legal_ac_docket_id,
        legal_ac_docket_case_id: legal_ac_docket_case_id,
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

function getLogsByCCBatchId(page) {
    var limit_count = 10;
    var limit_start = (page * limit_count) - limit_count;
    $.post(sAjaxAdministrativeCase, {
        type: "getLogsByACBatchId",
        limit_start: limit_start,
        limit_count: limit_count,
        legal_ac_docket_id: legal_ac_docket_id
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
                $('#act-logs-content').append("<center class='end_user_logs'> End of user logs </center>");
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

    // load Administrative Case Info stage 1 
    loadAdministrativeCaseInfoBatchByStages(1);

    // initalize stages
    iniCaseStages();

    // reset content admin stage 
    resetContentAdminStage();

    // reset ini display 
    defaulButtonDisplay();

    getIssueStatus();

    // set initial attribute 
    $('.btn-edit').attr('data-stage_level', '1');
    $('.btn-cancel').attr('data-stage_level', '1');

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
    });

    // click cancel in stages
    $('form .btn-cancel').click(function () {
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
                        loadAdministrativeCaseInfoBatchByStages(stage);
                    }
                });
            } else {
                // default body display  
                defaulButtonDisplay();
                removeErrorClass();
            }
        }
    });



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

    $('#btnCollapse').click(function () {

        if ($('#collapseVictim').hasClass('show')) {
            // hide victim list 
            $('#btnCollapse').text('View victim list');
            $('#btnCollapse').removeClass('btn-victim-hover').addClass('btn-light');
        } else {
            // show victim list 
            /*             * load victim list              */
            getVictimListPerBatch();

            $('#btnCollapse').text('Close victim list');
            $('#btnCollapse').addClass('btn-victim-hover').removeClass('btn-light');
        }
    });

    // click ul li main  stages 
    $('#ul-stages_admin_case').delegate('.card', 'click', function () {
        resetContentAdminStage();
        var className = $(this).attr('attr-class_name');
        $('.' + className).show();
        $('.criminal_case').trigger('click');

        var aClassName = className.split('_');
        var stage = aClassName[aClassName.length - 1];


        if ((stage !== '2') && (stage !== '4') && (stage !== '7')) {
            loadAdministrativeCaseInfoBatchByStages(stage);
        } else {
            switch (stage) {
                case '2':
                    $('#a-frm_6').click();
                    break;
                case '4':
                    $('#a-frm_11').click();
                    break;
                case '7':
                    $('#a-frm_17').click();
                    break;
                default:
            }
        }

        // set attribute 
        $('.btn-edit').attr('data-stage_level', stage);
        $('.btn-cancel').attr('data-stage_level', stage);

        if ($('#tria_logs_tab').hasClass('active')) {
            $('#tria_logs_tab').removeClass('active show');
            $('#criminal_case_tab').addClass('active show');
        }
        $('.stage_1').removeClass('active');

        defaulButtonDisplay();

        removeErrorClass();

    });

    // click ul li sub stages 
    $('.sub-form-list').delegate('.list-group-item-action', 'click', function () {
        var className = $(this).attr('attr-class_name');
        var aClassName = className.split('-');
        var stage = aClassName[aClassName.length - 1];
        loadAdministrativeCaseInfoBatchByStages(stage);

        // set attribute 
        $('.btn-edit').attr('data-stage_level', stage);
        $('.btn-cancel').attr('data-stage_level', stage);

        if ($('#tria_logs_tab').hasClass('active')) {
            $('#tria_logs_tab').removeClass('active show');
            $('#criminal_case_tab').addClass('active show');
        }

        $('.stage_1').removeClass('active');

        defaulButtonDisplay();
        removeErrorClass();
    });

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
        defaulButtonDisplay();
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

    // radio box for on/off victim list 
    $('#list-victim').delegate('.inp-chck-victim', 'click', function () {
        var legal_ac_docket_case_id = $(this).attr('id');
        var status = 1;
        if ($(this).is(":not(:checked)")) {
            status = 0;
        }
        setBatchVictimStatus(legal_ac_docket_case_id, status);
    });

    $("#collapseList").addClass("show");

    $("#ul-stages_admin_case li:first-child").addClass('active');

    $('#ul-stages_admin_case').delegate('.card', 'click', function () {
        $(".col-tab-content div.stage-bg:first-child").removeClass('show');
    });

    $(".col-tab-content div:last-child").css({display: "block !important"});

    $('#ul-stages_admin_case').delegate('.timeline-inverted', 'click', function () {
        var clickbtn = $(this);
        $("#collapseList").removeClass("show");
        if ($("#ul-stages_admin_case>li").hasClass('active')) {
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

    /*
     * Stage 1 
     *  Docketing and Assignment of Cases
     */
    $('#form-stage-1').validate({
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
                title: 'You are about to update docketing and assignment of cases.',
                onConfirm: function () {
                    setDateRemarksPerDocketStageId('1');
                }
            });
        }
    });

    /*
     * ****  Stage 2 Conciliation Stage **** *
     */

    /*
     * Show Cause Order / Summons
     */

    $('#form-stage-2_1').validate({
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
                title: 'You are about to update show cause order/summons.',
                onConfirm: function () {
                    setDateRemarksPerDocketStageId('2_1');
                }
            });
        }
    });

    /*
     * Filing of Answer
     */

    $('#form-stage-2_2').validate({
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
                title: 'You are about to update filing of answer.',
                onConfirm: function () {
                    setDateRemarksPerDocketStageId('2_2');
                }
            });
        }
    });

    /*
     * Filing of Reply
     */

    $('#form-stage-2_3').validate({
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
                title: 'You are about to update filing of reply.',
                onConfirm: function () {
                    setDateRemarksPerDocketStageId('2_3');
                }
            });
        }
    });

    /*
     * Motion for extension to file a verified answer
     */
    $('#form-stage-2_4').validate({
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
                title: 'You are about to update motion for extension to file a verified answer.',
                onConfirm: function () {
                    setDateRemarksPerDocketStageId('2_4');
                }
            });
        }
    });

    /*
     * Stage 3
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
                title: 'You are about to update issuance of order of preventive suspension.',
                onConfirm: function () {
                    setPerDocketStageId('3');
                }
            });
        }
    });

    /*
     * *** Stage 4 *** * 
     */

    /*
     * Preliminary Hearing
     */

    $('#form-stage-4_1').validate({
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
                title: 'You are about to update preliminary hearing.',
                onConfirm: function () {
                    setDateRemarksPerDocketStageId('4_1');
                }
            });
        }
    });

    /*
     * Hearing for Clarificatory Questions
     */

    $('#form-stage-4_2').validate({
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
                title: 'You are about to update hearing for clarificatory questions.',
                onConfirm: function () {
                    setDateRemarksPerDocketStageId('4_2');
                }
            });
        }
    });

    /*
     * Order to appear/to produce documents
     */

    $('#form-stage-4_3').validate({
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
                title: 'You are about to update order to appear/to produce documents.',
                onConfirm: function () {
                    setDateRemarksPerDocketStageId('4_3');
                }
            });
        }
    });

    /*
     * Summary Judgment
     */

    $('#form-stage-4_4').validate({
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
                title: 'You are about to update summary judgment.',
                onConfirm: function () {
                    setDateRemarksPerDocketStageId('4_4');
                }
            });
        }
    });

    /*
     * *** Stage 5 *** *
     */

    $('#form-stage-5').validate({
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
                title: 'You are about to update submission for resolution.',
                onConfirm: function () {
                    setDateRemarksPerDocketStageId('5');
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
                title: 'You are about to update resolution of the case.',
                onConfirm: function () {
                    setDateRemarksPerDocketStageId('6');
                }
            });
        }
    });

    /*
     * Stage 7
     */

    /*
     * Appeal to the DOLE Secretary
     */
    $('#form-stage-7_1').validate({
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
                title: 'You are about to update appeal to the DOLE secretary.',
                onConfirm: function () {
                    setDateRemarksPerDocketStageId('7_1');
                }
            });
        }
    });

    /*
     * Entry of Judgment
     */
    $('#form-stage-7_2').validate({
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
                title: 'You are about to update entry of judgment.',
                onConfirm: function () {
                    setDateRemarksPerDocketStageId('7_2');
                }
            });
        }
    });


    /*
     * Resolution of Appeal
     */
    $('#form-stage-7_3').validate({
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
                title: 'You are about to update resolution of appeal.',
                onConfirm: function () {
                    setDateRemarksPerDocketStageId('7_3');
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
                title: 'You are about to update writ of execution.',
                onConfirm: function () {
                    setDateRemarksPerDocketStageId('8');
                }
            });
        }
    });
});
