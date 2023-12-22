
function getVictimDetails(case_id) {
    $.post(sAjaxReportDetails, {
        type: "getVictimPersonalInfoByCaseId",
        case_id: case_id
    }, function (rs) {
        $.each(rs.data.result, function (key, val) {
            victim_id = val.victim_id;
            case_victim_id = val.case_victim_id;
            var fullname = val.victim_info_first_name + " " + val.victim_info_middle_name + " " + val.victim_info_last_name + " " + val.victim_info_suffix;
            if (val.victim_info_is_assumed == "0") {
                $('.div-fullname').text(fullname);
                $('.div-dob').text(dateViewingFormat(val.victim_info_dob));
                $('.div-pob').text(val.victim_pob);
                $('.div-sex').text(val.sex);
                $('.div-civil').text(val.civil_status);
                $('.div-religion').text(val.religion);
            } else {
                $('.div-assumed-name').text(fullname);
                $('.div-assumed-dob').text(dateViewingFormat(val.victim_info_dob));
            }
        });
        getEmploymentDetails(case_victim_id);
        getDeploymentDetails(case_victim_id);
        getActMeansPurpose(case_victim_id);
        getReportComplainant(case_victim_id);
        getReportServices(case_victim_id);
    }, 'json');
}

function getEmploymentDetails(case_victim_id) {
    $.post(sAjaxReportDetails, {
        type: "getEmploymentDetails",
        case_victim_id: case_victim_id
    }, function (rs) {
        var dr = rs.data.result;
        $('.div-empt-type').text(dr.employment_type);

        if (dr.employer.result == "1") {
            $('.div-empr-name').text(dr.employer.details.employer_name);
            $('.div-empr-address').text(dr.employer.details.employer_full_address + " " + dr.employer.details.employer_city + " " + dr.employer.details.country);
        } else {
            $('.div-empr-name').text("");
            $('.div-empr-address').text("");
        }

        var actual = "";
        var differ = "";
        if (dr.actual_work !== "") {
            work = dr.actual_work + "(Based in Contract)";
        }
        if (dr.actual_work !== "") {
            work = dr.actual_work + "(Different from Contract)";
        }
        $('.div-empt-position').text(actual + " - " + differ);

        if (dr.local_recruitment.result == "1") {
            $('.div-local-rect-name').text(dr.local_recruitment.details.recruitment_agency_name);
            $('.div-local-rect-address').text(dr.local_recruitment.details.recruitment_agency_address + "  " + dr.local_recruitment.details.province);
        } else {
            $('.div-local-rect-name').text("");
            $('.div-local-rect-address').text("");
        }
        if (dr.foreign_recruitment.result == "1") {
            $('.div-foreign-rect-name').text(dr.foreign_recruitment.details.recruitment_agency_name);
            $('.div-foreign-rect-address').text(dr.foreign_recruitment.details.recruitment_agency_address + " " + dr.foreign_recruitment.details.state + " " + dr.foreign_recruitment.details.country);
        } else {
            $('.div-foreign-rect-name').text("");
            $('.div-foreign-rect-address').text("");
        }
    }, 'json');
}

function getDeploymentDetails(case_victim_id) {
    $.post(sAjaxReportDetails, {
        type: "getDeploymentDetails",
        case_victim_id: case_victim_id
    }, function (rs) {
        var dr = rs.data;
        $('.div-departure-type').text(dr.departure_type);
        $('.div-port-type').text(dr.port_type);
        $('.div-visa-cat').text(dr.visa_category);
        $('.div-destination').text(dr.country);
        $('.div-deployment-date').text(dateViewingFormat(dr.case_victim_deployment_arrival_date));
        $('.div-arrival').text(dateViewingFormat(dr.case_victim_deployment_arrival_date));
    }, 'json');
}

function getActMeansPurpose(case_victim_id) {
    var case_id = $('.victim_details_summary').attr('data-cid');
    $.post(sAjaxReportDetails, {
        type: "getActMeansPurpose",
        case_victim_id: case_victim_id,
        case_id: case_id
    }, function (rs) {
        var acts = "";
        var means = "";
        var purps = "";
        $.each(rs.data.tip, function (key, val) {
            switch (val.case_victim_tip_type_id) {
                case "1": //act
                    if (acts == "") {
                        acts = val.tip_type;
                    } else {
                        acts += " ," + val.tip_type;
                    }
                    break;
                case "2": //purpose
                    if (purps == "") {
                        purps = val.tip_type;
                    } else {
                        purps += " ," + val.tip_type;
                    }
                    break;
                case "3": //means
                    if (means == "") {
                        means = val.tip_type;
                    } else {
                        means += " ," + val.tip_type;
                    }
                    break;
                default:
            }
        });

        $('.div-act').text(acts);
        $('.div-means').text(means);
        $('.div-purpose').text(purps);
        $('.div-fact').html("<br><br>" + rs.data.fact.case_facts);
        $('.div-case-evaluation').html("<br><br>" + rs.data.fact.case_evaluation);
        $('.div-risk-assessment').html("<br><br>" + rs.data.fact.case_risk_assessment);
        switch (rs.data.fact.case_priority_level_id) {
            case "2":
                $('#inlineRadio2').prop("checked", true);
                break;
            case "3":
                $('#inlineRadio3').prop("checked", true);
                break;
            default:
                $('#inlineRadio1').prop("checked", true);
        }

    }, 'json');

}

function getReportComplainant(case_victim_id) {
    $.post(sAjaxReportDetails, {
        type: "getReportComplainant",
        case_victim_id: case_victim_id
    }, function (rs) {

        var dr = rs.data;
        $('.div-date-complain').text(dr.case_complainant_date_complained);
        $('.div-complain-source').text(dr.complain_source);
        $('.div-complainant').text(dr.case_complainant_name);
        if (dr.case_complainant_relation.toString().toLowerCase() == "other") {
            $('.div-relation-to-victim').text(dr.case_complainant_relation_other);
        } else {
            $('.div-relation-to-victim').text(dr.case_complainant_relation);
        }

    }, 'json');
}
function getCaseEvaluationAndRiskAssessment(case_id) {
    $.post(sAjaxReportDetails, {
        type: "getCaseEvaluationAndRiskAssessment",
        case_id: case_id
    }, function (rs) {
        var dr = rs.data;
        $('.div-date-complain').text(dr.case_complainant_date_complained);
        $('.div-complain-source').text(dr.complain_source);
        $('.div-complainant').text(dr.case_complainant_name);
        if (dr.case_complainant_relation.toLowerCase() == "other") {
            $('.div-relation-to-victim').text(dr.case_complainant_relation_other);
        } else {
            $('.div-relation-to-victim').text(dr.case_complainant_relation);
        }

    }, 'json');
}
function  getReportServices(case_victim_id) {
    $.post(sAjaxReportDetails, {
        type: "getReportServices",
        case_victim_id: case_victim_id
    }, function (rs) {
        var dr = rs.data;
        console.log(dr.length);
        var list = "";
        if (dr.result == "1") {
            list += "<table class='table>";
            list += "<thead class='thead-grey row-header-border'>";
            list += "<tr>";
            list += "<th scope='col'>Service Name</th><th scope='col'>Service Category</th><th scope='col'>Service Type</th>";
            list += "</tr>";
            list += "</thead>";
            list += "<tbody>";
            $.each(dr.services, function (key, val) {
                list += "<tr>";
                list += "<td>" + val.service_name + "</td>";
                list += "<td>" + val.service_category + "</td>";
                list += "<td>" + val.service_type + "</td>";
                list += "</tr>";
            });
            list += "<tbody>";
            list += "</table>";
        }
        $('.div-case-victim_services').html(list);
    }, 'json');
}
$(document).ready(function () {
    var case_id = $('.victim_details_summary').attr('data-cid');
    getVictimDetails(case_id);
}); 