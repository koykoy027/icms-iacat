let temp_id = $("#div-temporary_case").attr('data-id');
let tdata = [];
let tremarks = [];

function addRemarks() {

    icmsMessage({
        type: 'msgPreloader',
        visible: true
    });

    let data = dg__objectAssign({
        type: "AddTemporaryCaseRemarksByUser",
        temporary_case_id: temp_id
    },
        dg__getFormValues({
            type: "obj",
            form: "#form-remarks"
        }));

    $.post(sAjaxTemporaryCase, data, function (rs) {
        $('#form-remarks')[0].reset();
        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });

        if (rs.data.flag !== '0') {
            icmsMessage({
                type: 'msgSuccess',
                onHide: function () {
                    icmsMessage({
                        type: 'msgPreloader',
                        visible: true,
                        body: 'Loading...'
                    });
                    getRemarkList(1);
                }
            });
        } else {
            icmsMessage({
                type: 'msgError'
            });
        }
    }, 'json');
}

function manageRemarks() {

    icmsMessage({
        type: 'msgPreloader',
        visible: true
    });

    let data = dg__objectAssign({
        type: "updateTemporaryCaseRemarks",
        temporary_case_remarks_id: $("#btn-add_remarks").attr("data-id")
    },
        dg__getFormValues({
            type: "obj",
            form: "#form-remarks"
        }));

    $.post(sAjaxTemporaryCase, data, function (rs) {
        $('#form-remarks')[0].reset();
        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });

        if (rs.data.flag !== '0') {
            icmsMessage({
                type: 'msgSuccess',
                onHide: function () {
                    icmsMessage({
                        type: 'msgPreloader',
                        visible: true,
                        body: 'Loading...'
                    });
                    getRemarkList(1);
                }
            });

        } else {
            icmsMessage({
                type: 'msgError'
            });
        }
    }, 'json');
}

function manageVictim() {

    icmsMessage({
        type: 'msgPreloader',
        visible: true
    });

    let form_data = dg__getFormValues({
        type: "obj",
        form: "#form-victim"
    });

    let data = dg__objectAssign({
        type: "updateVictimInfoByTemporaryCaseId",
        temporary_case_id: temp_id
    }, form_data);

    $.post(sAjaxTemporaryCase, data, function (rs) {
        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });
        if (rs.data.flag !== '0') {
            icmsMessage({
                type: 'msgSuccess'
            });
            tdata = Object.assign(tdata, form_data);
            $("#form-victim .btn-cancel").click();
        } else {
            icmsMessage({
                type: 'msgError'
            });
        }
    }, 'json');
}

function manageComplainant() {

    icmsMessage({
        type: 'msgPreloader',
        visible: true
    });
    let form_data = dg__getFormValues({
        type: "obj",
        form: "#form-complainant"
    });
    let data = dg__objectAssign({
        type: "updateComplainantInfoByTemporaryCaseId",
        temporary_case_id: temp_id
    }, form_data);

    $.post(sAjaxTemporaryCase, data, function (rs) {

        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });

        if (rs.data.flag !== '0') {
            icmsMessage({
                type: 'msgSuccess'
            });
            tdata = Object.assign(tdata, form_data);
            $("#form-complainant .btn-cancel").click();
        } else {
            icmsMessage({
                type: 'msgError'
            });
        }
    }, 'json');
}
function getData(fload = 0) {

    icmsMessage({
        type: 'msgPreloader',
        visible: true,
        body: 'Loading...'
    });

    $.post(sAjaxTemporaryCase, {
        type: "getTemporaryCaseByTemporaryCaseId",
        temporary_case_id: temp_id
    }, function (rs) {

        tdata = rs.data.recordset;

        if (fload == 1) {
            icmsMessage({
                type: 'msgPreloader',
                visible: false
            });
        }

        dg__iniFormValue({
            form: '#form-complainant',
            value: tdata
        });

        dg__iniFormValue({
            form: '#form-victim',
            value: tdata
        });

        dg__iniFormValue({
            form: '#form-status',
            value: tdata
        });

        $("#s-date_created").html(tdata.temporary_case_date_added);
        $("#s-status").html(tdata.temporary_case_status_name);
        $("#s-temporary_case_number").html(tdata.temporary_case_number);

        $("#a-case_number").hide();

        // added to case 
        if (tdata.temporary_case_status_id == "3") {
            $("#div-temporary_case .fa-edit").remove();
            $("#s-case_number").html(tdata.case_number);
            $("#a-case_number").attr("href", tdata.case_link);
            $("#a-case_number").show();
        }

        if(tdata.temporary_complainant_relation != 5){
            $("#div-other-relationship").hide();
            $("#div-other-relationship input").val("");
        }else{
            $("#div-other-relationship").show();            
        }

        getRemarkList();
        getLogs(); 

    }, 'json');

}
function buildRemarkList() {

    let l = "";
    $.each(tremarks, function (key, val) {

        l += `
        <li class="timeline-inverted" id="li-remarks-${val.temporary_case_remarks_id}">     
            <div class="timeline-badge warning"></div>     
            <div class="card card-tabs Filing and Receipt of Complaints mb-2" style="background-color:#fff; " attr-class_name="stage_1" id="li-stage_1">         
                <div class="card-body">           
                    <div class="row">             
                        <div class="col-12 ml-1 mb-0 px-0 pull-left"> `;

        if (val.is_system_generated == "0") {
            l += `             <p class="text-right blue mb-0 mr-3">
                                    <i class="fa fa-edit" aria-hidden="true" data-id="${val.temporary_case_remarks_id}" data-index="${key}"></i>
                                    <i class="fa fa-trash" aria-hidden="true" data-id="${val.temporary_case_remarks_id}"></i>
                                </p>`;
        }


        l += `              <p class="text-right font-weight-bold mr-3">${val.temporary_case_remarks_date_added}</p>`;
        if(val.log_type == "remarks"){

            l += `              <p>${val.temporary_case_remarks}</p>`; 

        }else if(val.log_type == "service"){
            l += `              <p><b> Service </b>: ${val.service_name} - ${val.service_duration}</p>
                                <p><b> Agency </b>: ${val.agency} </p>
                                <p><b> Status </b>: ${val.service_status} </p>
            `; 
        }else if(val.log_type == "legal"){
            l += `              <p><b> Service </b>: ${val.service_name} - ${val.service_duration}</p>
                                <p><b> Agency </b>: ${val.agency} </p>
                                <p><b> Status </b>: ${val.service_status} </p>
            `; 

            if(val.service_type == "criminal_case"){
                l += `          <p><b> Slip Investigation Number </b>: ${val.slip_investigation_no || "-" }</p>
                                <p><b> Docket Number </b>: ${val.docket_number || "-" } </p>
                `;  

            }else if(val.service_type == "administrative_case"){

                l += `          <p><b> Case Number </b>: ${val.case_no || "-" } </p>
                                <p><b> Docket Number </b>: ${val.docket_number || "-" } </p>
                `;  

            }
        }
        

        l += `          </div>             
                    </div>         
                </div>     
            </div> 
        </li>
        `;
    });
    $("#ul-remarks").html(l);

}

function getRemarkList(fload = 0) {

    $.post(sAjaxTemporaryCase, {
        type: "getTemporaryCaseRemarksByTemporaryCaseId",
        temporary_case_id: temp_id
    }, function (rs) {

        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });

        if (rs.data.flag == 1) {
            tremarks = rs.data.recordset.listing;
            buildRemarkList();
            $("#ul-remarks-nodata").hide();
        } else {
            $("#ul-remarks-nodata").show();
        }

    }, 'json');
}

function getLogs() {
    $.post(sAjaxTemporaryCase, {
        type: "getTemporaryCaseAccessLogsByTemporaryCaseId",
        temporary_case_id: temp_id
    }, function (rs) {
        if (rs.data.flag == 1) {
            let l = "";
            $.each(rs.data.recordset.listing, function (key, val) {
            l += `<div class="card card-tabs mb-2"
                        style="background-color:#fff; "
                        attr-class_name="stage_1" id="li-stage_1">
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <p class="blue">${val.date_added} </p>
                                </div>
                                <div class="col-lg-8 col-md-6 col-sm-12">
                                    <p> ${val.temporary_case_access_log_description} </p>
                                </div>
                            </div>
                        </div>
                    </div>`;
            });
            $("#ul-logs").html(l);
            $("#ul-logs-nodata").hide();
        } else {
            $("#ul-logs-nodata").show();
        }
    }, 'json');
}
function manageStatus() {

    let data = dg__objectAssign({
        type: "updateTemporaryCaseStatusById",
        temporary_case_id: temp_id
    }, dg__getFormValues({
        type: "obj",
        form: "#form-status"
    }));

    if (data.temporary_case_status_id == '3') {
        location.assign(sAjaxUrl + "/add_case/" + temp_id);
    } else {
        icmsMessage({
            type: 'msgPreloader',
            visible: true
        });

        $.post(sAjaxTemporaryCase, data, function (rs) {
            icmsMessage({
                type: 'msgPreloader',
                visible: false
            });

            if (rs.data.flag !== '0') {
                icmsMessage({
                    type: 'msgSuccess'
                });
                $("#s-status").html($("#sel-temporary_case_status_id option:selected").text());
            } else {
                icmsMessage({
                    type: 'msgError'
                });
            }
        }, 'json');
    }
}
function getDepartureType() {
    $.post(sAjaxGlobalData, {
        type: "getDepartureType"
    }, function (rs) {
        l = "<option class='pl' value='0' selected>Select Departure Type</option>",
            other = "";
        $.each(rs.data, function (key, val) {
            var x = val.parameter_name;
            if (x.toLowerCase() == "other") {
                other = "<option value='" + val.parameter_count_id + "' data-name='" + val.parameter_name + "'>" + val.parameter_name + " </option>";
            } else {
                l += "<option value='" + val.parameter_count_id + "' data-name='" + val.parameter_name + "'>" + val.parameter_name + " </option>";
            }
        });
        if (other != "") {
            l += other;
        }
        $('#sel-departure').html(l);
    }, 'json');
}
function getTempStatus() {
    $.post(sAjaxGlobalData, {
        type: "getTransactionParameter",
        transaction_type: 12,
        type_id: 12,
        status: 1
    }, function (rs) {
        var l = "<option selected value=''>Select Status</option>";
        $.each(rs.data, function (key, val) {
            val.transaction_parameter_name = val.transaction_parameter_count_id == 3 ? "Add to Case" : val.transaction_parameter_name;
            l += `<option value=${val.transaction_parameter_count_id}>${val.transaction_parameter_name}</option>`;
        });
        $("#sel-temporary_case_status_id").html(l);
    }, "json");
}
$(document).ready(function () {

    getCountries();
    getSex();
    getCivilStatus();
    getFamilyRelations();
    getDepartureType();
    getTempStatus();

    // Get Data
    getData(1);

    // click add remarks 
    $("#btn-add_remarks").click(function () {
        $("#btn-add_remarks").removeAttr("data-id");
    });

    // on change relationship to victim 
    $(".sel-relation").change(function() {
        let id = $(this).val();
        if(id != 5){
            $("#div-other-relationship").hide();
            $("#div-other-relationship input").val("");
        }else{
            $("#div-other-relationship").show();            
        }
    });
      
    // click edit remarks 
    $('#ul-remarks').delegate('.fa-edit', 'click', function () {
        $("#btn-add_remarks").attr("data-id", $(this).attr("data-id"));
        $("#form-remarks [name=temporary_case_remarks]").val(tremarks[$(this).attr("data-index")]["temporary_case_remarks"]);
        $("#modal-add_remarks").modal("show");
    });

    // click edit remarks 
    $('#ul-remarks').delegate('.fa-trash', 'click', function () {
        let id = $(this).attr("data-id");
        icmsMessage({
            type: 'msgConfirmation',
            title: 'You are about to remove an temporary case remarks.',
            body: 'Click continue button if you wish to continue.',
            LblBtnConfirm: 'Continue', LblBtnCancel: 'Cancel',
            onConfirm: function () {

                icmsMessage({
                    type: 'msgPreloader',
                    visible: true
                });

                $.post(sAjaxTemporaryCase, {
                    type: "deleteTemporaryCaseRemarks",
                    temporary_case_remarks_id: id
                }, function (rs) {

                    icmsMessage({
                        type: 'msgPreloader',
                        visible: false
                    });

                    if (rs.data.flag !== '0') {
                        icmsMessage({
                            type: 'msgSuccess'
                        });
                        $("#li-remarks-" + id).remove();
                    } else {
                        icmsMessage({
                            type: 'msgError'
                        });
                    }
                }, 'json');

            },
        });
    });

    // Date Picker 
    $('.datepicker').datetimepicker({
        timepicker: false,
        format: 'm/d/Y',
        scrollMonth: false,
        scrollInput: false
    });

    // Form Complainant
    $("#form-complainant :input").attr('disabled', true);
    $("#form-complainant button").attr('disabled', false);
    // Form Victim
    $("#form-victim :input").attr('disabled', true);
    $("#form-victim button").attr('disabled', false);

    // Buttons 

    // Complainant edit 
    $("#form-complainant .btn-edit").click(function () {
        $("#form-complainant :input").attr('disabled', false);
        $(this).hide();
        $("#form-complainant .btn-submit").show();
        $("#form-complainant .btn-cancel").show();
    });

    // Victim edit 
    $("#form-victim .btn-edit").click(function () {
        $("#form-victim :input").attr('disabled', false);
        $(this).hide();
        $("#form-victim .btn-submit").show();
        $("#form-victim .btn-cancel").show();
    });

    // Complainant cancel 
    $("#form-complainant .btn-cancel").click(function () {
        $("#form-complainant :input").attr('disabled', true);
        $("#form-complainant button").attr('disabled', false);
        $(this).hide();
        $("#form-complainant .btn-submit").hide();
        $("#form-complainant .btn-edit").show();

        dg__iniFormValue({
            form: '#form-complainant',
            value: tdata
        });

    });

    // Victim cancel 
    $("#form-victim .btn-cancel").click(function () {
        $("#form-victim :input").attr('disabled', true);
        $("#form-victim button").attr('disabled', false);
        $(this).hide();
        $("#form-victim .btn-submit").hide();
        $("#form-victim .btn-edit").show();

        dg__iniFormValue({
            form: '#form-victim',
            value: tdata
        });

    });

    // Form Validation

    // Add Remarks
    $('#form-remarks').validate({
        rules: {
            temporary_case_remarks: { required: true },
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
            $('#modal-add_remarks').modal('hide');
            if ($("#btn-add_remarks").attr("data-id")) {
                manageRemarks();
            } else {
                addRemarks();
            }
        }
    });

    // Manage Remarks
    $('#form-manage_remarks').validate({
        rules: {
            temporary_case_remarks: { required: true },
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
            $('#modal-manage_remarks').modal('hide');
            addRemarks();
        }
    });

    // Manage Complainant 
    $('#form-complainant').validate({
        rules: {
            temporary_complainant_firstname: { required: true },
            temporary_complainant_lastname: { required: true },
            temporary_complainant_mobile_number: { required: true },
            temporary_complainant_email_address: { required: true },
            temporary_complainant_relation: { required: true },
            temporary_complainant_address: { required: true },
            temporary_complainant_preffered_contact_method: { required: true },
            temporary_complain: { required: true }
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
            manageComplainant();
        }
    });

    // Manage Victim 
    $('#form-victim').validate({
        rules: {
            temporary_victim_firstname: { required: true },
            temporary_victim_lastname: { required: true },
            temporary_victim_mobile_number: { required: true },
            temporary_victim_email_address: { required: true },
            temporary_victim_dob: { required: true },
            temporary_victim_address: { required: true },
            temporary_victim_country_deployment: { required: true },
            temporary_victim_civil_status: { required: true },
            temporary_victim_departure_type: { required: true },
            temporary_victim_sex: { required: true }
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
            manageVictim();
        }
    });

    $('#form-status').validate({
        rules: {
            temporary_case_status_id: { required: true },
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
            $("#modal-manage_status").modal("hide");
            manageStatus();
        }
    });

});