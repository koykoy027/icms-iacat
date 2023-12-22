function getServiceDetails() {
    var caseid = $('#case_id').val();
    $.post(sAjaxServiceDetails, {
        type: "getServiceDetails",
        caseid: caseid,
    }, function (rs) {
        rs = html_entity_decode(rs);
        //success
        var serv = "";
        if (parseInt(rs.data.result) >= 1) {
            var counter = 0;
            $.each(rs.data.services, function (key, val) {
                serv += "<tr class='tr-services' data-rs='" + btoa(JSON.stringify(rs.data.services[counter])) + "'>";
                serv += "  <td>" + val.service_name + "</td>";
                serv += "  <td>" + val.assessment_term + "</td>";
                serv += "  <td>" + val.agency_abbr + "(" + val.agency_branch + ")</td>";
                serv += "  <td>" + val.service_days + "</td>";
                serv += "  <td>" + dateViewingFormat(val.case_victim_services_agency_tag_added_date) + "</td>";
                serv += "  <td>" + val.tagged_status + "</td>";
                serv += "</tr>";
                counter++;
            });

            parseInt(rs.data.services.length) >= 10 ? $('.btn-add_assessment').prop('disabled', true) : $('.btn-add_assessment').prop('disabled', false);

        } else {
            serv = "<tr><td colspan='6'><center>No services added</center></td></tr>";
        }

        $('#tbl-services-list').html(serv);
        var sl = "";
        $.each(rs.data.service_status, function (ky, vl) {
            sl += "<option value='" + vl.transaction_parameter_count_id + "'>" + vl.transaction_parameter_name + "</option>";
        });
        $('#sel-new-stat').html(sl);
    }, 'json');
}

function setNewTaggedServiceStatus() {
    icmsMessage({
        type: "msgPreloader",
        body: "Saving... Please wait!",
        visible: true
    });
    var stats = $('#sel-new-stat').val();
    var remarks = $('#area-new-tagged-remarks').val();
    $.post(sAjaxServiceDetails, {
        type: "setServiceDetailStatus",
        case_id: $('#case_id').val(),
        servicetaggedid: $('#btn-stat-update').attr("servicetaggedid"),
        remarks: remarks,
        stats: stats,
    }, function (rs) {
        getServiceDetails();
        notifyChangesInReport();
    }, 'json');
    s
}


$(document).ready(function () {

    $('#tbl-services-list').delegate('.tr-services', 'click', function () {
        var rs = JSON.parse(atob($(this).attr("data-rs")));
        $('#div-service-remarks').text(rs.case_victim_services_remarks);
        $('#div-service').text(rs.service_name);
        $('#div-service-term').text(rs.assessment_term);
        $('#div-agency').text(rs.agency_abbr + " - " + rs.agency_branch);
        $('#div-date-tagged').text(dateViewingFormat(rs.case_victim_services_agency_tag_added_date));
        $('#div-days-number').text(rs.service_days);
        $('#div-tagged-remarks').text(rs.case_victim_services_agency_tag_remarks);
        $('#div-tagged-status').text(rs.tagged_status);
        $('#sel-new-stat').attr('cur-stat', rs.case_victim_services_agency_tag_status);
        $('#mdl-case-details').modal('show');
        $('#btn-stat-update').attr("servicetaggedid", rs.case_victim_services_agency_tag_id);
    });

    $('#lnk-change-stats').click(function () {
        $('.div-update').removeClass('hide');
        $('.div-view-details').addClass('hide');
    });

    $('#btn-stat-cancel').click(function () {
        $('.div-update').addClass('hide');
        $('.div-view-details').removeClass('hide');
    });

    $('#btn-stat-update').click(function () {
        $('#frm-update-status').submit();
    });

    $('.btn-save-assessment').click(function () {

    });

    //additional validation for dropdown
    $.validator.addMethod("validateOldStatus", function (value, element) {
        var cur_stat = $('#sel-new-stat').attr('cur-stat');
        if (value !== cur_stat) {
            return true;
        }
    }, "Status remain unchanged");

    // validation for date 
    $.validator.addMethod("checkArrival", function (value, element) {
        var a = new Date(value);
        var b = new Date($("#cd-mdl-txt-departure-date").val());
        if (a >= b) {
            return true;
        }
        if (!value) {
            return true;
        }
    }, "Arrival date cannot be less than departure date");

    $('#form-add_assessment_info').validate({
        rules: {
            assessment_type: {
                required: true
            },
            service: {
                required: true
            },
            agencies: {
                required: true
            },
            arrival_date: {
                checkArrival: true
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
                type: "msgConfirmation",
                title: "You are about to add new services and tagged agency ",
                onConfirm: function () {
                    icmsMessage({
                        type: "msgPreloader",
                        body: "Saving... Please wait!",
                        visible: true
                    });

                    $.post(sAjaxCaseDetails, {
                        type: "addServiceInformation",
                        deliveryService: $('#cd-mdl-txt-set-age').val(),
                        services_id: $('#cd-mdl-sel-service').val(),
                        service_name: $('#cd-mdl-sel-service option:selected').text(),
                        remark: $('#cd-mdl-txt-remarks').val(),
                        agency_id: $('#cd-mdl-sel-agncy').val(),
                        case_id: $('#case_id').val(),
                    }, function (rs) {
                        icmsMessage({
                            type: "msgPreloader",
                            visible: false
                        });
                        icmsMessage({
                            type: "msgSuccess",
                            body: "Adding of new service was successful!",
                            onShow: function () {
                                getServiceDetails();

                            }
                        });

                    }, 'json');


                },
                onShow: function () {
                    $('#modal-Initial-asssessment').modal('hide');
                },
                onCancel: function () {
                    $('#modal-Initial-asssessment').modal('show');
                }
            });
        }
    });

    $('#frm-update-status').validate({
        rules: {
            selNewStat: {required: true, validateOldStatus: true},
            areaNewTaggedRemarks: {required: true},

        },
        errorElement: 'div',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            icmsMessage({
                type: "msgConfirmation",
                title: "You are about to change service status ",
                onConfirm: function () {
                    setNewTaggedServiceStatus();
                },
                onShow: function () {
                    $('#mdl-case-details').modal('hide');
                },
                onCancel: function () {
                    $('#mdl-case-details').modal('show');
                }
            });
        }
    });


    $('#cd-mdl-sel-service').change(function () {

        $('#cd-mdl-txt-set-age_label').val();
        $('#cd-mdl-txt-set-age').val();

        var id = $(this).val();

        switch (id) {
            case "9":
            case "15":
            case "42":
            case "43":
            case "2":
            case "3":
            case "14":
            case "44":
                $('.row-cd-arrival').show();
                $('.row-cd-departure').show();
                break;
            default:
                $('.row-cd-arrival').css("display", "none");
                $('.row-cd-departure').css("display", "none");
        }

        var days = $('#cd-mdl-sel-service option:selected').attr('data-days');

        var monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        var nowDate = new Date();
        var numberOfDaysToAdd = parseInt(days);
        nowDate.setDate(nowDate.getDate() + numberOfDaysToAdd);
        var dd = nowDate.getDate();
        var mm = nowDate.getMonth();
        var y = nowDate.getFullYear();

        if (days) {
            $('#cd-mdl-txt-set-age_label').val(monthNames[mm] + ' ' + dd + ', ' + y + ' or  within ' + days + ' day/s.');
            $('#cd-mdl-txt-set-age').val((mm + 1) + '/' + dd + '/' + y);
        }

        getAgenciesWhichOfferServices(id);

    });


    $('.btn-add_assessment').click(function () {
        $('#modal-Initial-asssessment').modal('show');
        $('#form-add_assessment_info').attr("stored-id", "");
        $("#modal-Initial-asssessment").modal('show');
        $('#form-add_assessment_info').attr("data-assessment", "0");
        $('#form-add_assessment_info').attr("data-service", "0");
        $('#form-add_assessment_info').attr("data-agencies", "0");
        $('.btn-save-assessment').prop('disabled', true);
        $('#form-add_assessment_info')[0].reset();
        $('#cd-mdl-sel-agncy').html('');
    });


});

