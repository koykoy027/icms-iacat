var aGPData = [];
var country_list = [];

function getKeyword(iTag) {
    switch (parseInt(iTag)) {
        case 1:
            keyword = $("#txt_search-all").val();
            break;
        case 2:
            keyword = $("#txt_search-created").val();
            break;
        case 3:
            keyword = $("#txt_search-tagged").val();
            break;
        case 4:
            keyword = $("#txt_search-tagged_user").val();
            break;
    }
    return keyword;
}

function buildCasesList(aListing) {
    var l = "";
    $.each(aListing, function (key, val) {
        l += '<li style="width:100%;" class="case-content">';
        l += '    <div class="card">';
        l += '        <div class="row cases">';
        l += '            <div class="col-lg-10 col-md-9 col-sm-9 col-xs-9  bk-trig-cmodal" attr-id="' + val.temporary_case_id + '">';
        // l += '                <ul class="list-group list-group-horizontal nav-case_details list_content  ul-report-list" data-cid="' + val.temporary_case_id + '">';
        // l += '                    <li class="list-group-item">';
        // l += '                        <span style="color: #343a40;">Status : &nbsp; </span><span class="badge badge-sucess">' + val.temporary_case_status_name + "</span>";
        // l += "                        <br>";
        // l += '                        <span style="color: #343a40;">Complainant Name : &nbsp; </span><span class="">' + val.temporary_complainant_firstname + ' ' + val.temporary_complainant_middlename + ' ' + val.temporary_complainant_lastname + "</span>";
        // l += "                        <br>";
        // l += '                        <span style="color: #343a40;">Victim Name : &nbsp; </span><span class="">' + val.temporary_victim_firstname + ' ' + val.temporary_victim_middlename + ' ' + val.temporary_victim_lastname + "</span>";
        // l += "                        <br>";
        // l += '                        <span style="color: #343a40;">Date created : &nbsp; </span><span class="">' + val.temporary_case_date_added + "</span>";
        // l += "                    </li>";
        // l += "                </ul>";
        l += '                <ul class="list-group list-group-horizontal nav-case_details list_content  ul-report-list row" data-cid="' + val.temporary_case_id + '">';
        l += '                      <div class="col-6">';
        l += '                           <li class="list-group-item">';
        l += '                                <span style="color: #343a40;">Victim Name : &nbsp; </span><span class="">' + val.temporary_victim_firstname + ' ' + val.temporary_victim_middlename + ' ' + val.temporary_victim_lastname + "</span>";
        l += "                                <br>";
        l += '                                <span style="color: #343a40;">Date created : &nbsp; </span><span class="">' + val.temporary_case_date_added + "</span>";
        l += "                                <br>";
        l += '                            </li>';
        l += '                      </div>';
        l += '                      <div class="col-6">';
        l += '                           <li class="list-group-item">';
        l += '                               <span style="color: #343a40;">Complainant Name : &nbsp; </span><span class="">' + val.temporary_complainant_firstname + ' ' + val.temporary_complainant_middlename + ' ' + val.temporary_complainant_lastname + "</span>";
        l += "                               <br>";
        l += '                               <span style="color: #343a40;">Status : &nbsp; </span><span class="badge badge-sucess">' + val.temporary_case_status_name + "</span>";
        l += '                               </li>';
        l += '                      </div>';
        l += "                </ul>";
        l += "            </div>";
        l += '             <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 " style="  padding: 10px 48px;">';
        l += '                <div class="btn-group ellipse-action " data-id = "' + val.temporary_case_id + '">';
        l += '                    <a class="a-ellipse a-ellipse-i action_btn a-ellipse-' + val.temporary_case_id + ' "> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </a>';
        l += '                    <div class="action-menu action-' + val.temporary_case_id + '" data-cur-stat="1" style="display: none;">';
        l += '                        <a class="dropdown-item disabled action-title" href="#">Select Action</a>';
        l += '                        <a class="dropdown-item lvl-ch " href="' + sAjaxUrl + "/temporary_case/" + val.temporary_case_id + '">Manage Report</a>';
        l += "                    </div>";
        l += "                </div>";
        l += "            </div>";
        l += "        </div>";
        l += "    </div>";
        l += "</li>";
    });
    return l;
}

function getAllLists(x) {

    $("#list-temporary_cases").hide();
    var optData = {};
    // var sOptData = '';

    // optData['age_min'] = isNaN(parseInt($(".inp-min_age").val())) ? 0 : parseInt($(".inp-min_age").val());
    // optData['age_max'] = isNaN(parseInt($(".inp-max_age").val())) ? 0 : parseInt($(".inp-max_age").val());

    // $("#max_age-error").hide(); 

    // if(optData['age_min'] > optData['age_max']){
    //     $("#max_age-error").show();
    //     return; 
    // }

    $.each(aGPData, function (key, val) {
        optData[val] = $('.opt-cv_' + val + ':checked').map(function () {
            return this.value;
        }).get();
    });

    let filters = dg__getFormValues({
        type: "obj",
        form: "#form-advanced_filter"
    });

    filters['start_temporary_case_date_added'] = $("#inp-date_submitted").attr("data-start");
    filters['end_temporary_case_date_added'] = $("#inp-date_submitted").attr("data-end");
    filters['temporary_victim_country_deployment'] = optData['country'];

    //default all case 
    x.type = "getAllTemporaryCaseList";

    switch (filters['temporary_case_status_id']) {
        case '1':
            x.type = "getPendingTemporaryCaseList";
            break;
        case '2':
            x.type = "getForVerificationTemporaryCaseList";
            break;
        case '3':
            x.type = "getAddedToCaseTemporaryCaseList";
            break;
        case '4':
            x.type = "getArchivedTemporaryCaseList";
            break;
    }

    $.post(sAjaxTemporaryCase, {
        type: x.type,
        limit: 10,
        page: x.page,
        filters: JSON.stringify(filters),
    }, function (rs) {
        rs = html_entity_decode(rs);
        $(".filter_load_placeholder").hide();

        if (rs.data.flag == 1) {
            $("#list-temporary_cases").html(buildCasesList(rs.data.recordset.listing));
            // pagination
            buildPagination({
                parent: "rs-list-all",
                info: "rs-info-all",
                pagination: "rs-pagination-all",
                offset: "rs-offset",
                data: {
                    page: x.page,
                    offset: 10,
                    count: rs.data.recordset.count
                }
            });
            $("#list-temporary_cases").show();
            $(".rs-list-all").show();
            $("#list-temporary_cases-no-content").remove();
        } else {
            var l = getNoDataFound({
                message: "NO DATA FOUND.",
                footer: ""
            });
            $("#list-temporary_cases").hide();
            $(".rs-list-all").hide();
            $("#list-temporary_cases-no-content").remove();
            $("#list-temporary_cases").after("<div id='list-temporary_cases-no-content'>" + l + "</div>");
        }
    }, "json");
}

function getValueFilter(x) {
    var z = [];
    var y = "";
    $("#" + x.id + " input[name=" + x.name + "]:checked").each(function () {
        z.push($(this).val());
    });
    y = z.join(",");
    return y;
}

function initialLoad() {
    getSex();
    getCivilStatus();
    getFamilyRelations();
    getDepartureType();
    getTempStatus();
    getCountryDep();
}

function getCountryDep() {
    $.post(sAjaxGlobalData, {
        type: "getCountries",
    }, function (rs) {
        $.each(rs.data, function (key, val) {
            let data = [];
            data['id'] = val.country_id;
            data['name'] = val.country_name;
            country_list[key] = data;
        });

        getAllGlobalParameter();

    }, "json");
}

function getAllGlobalParameter() {

    var type = 'getAllGlobalParameter';
    $.post(sAjaxReports, {
        type: type
    }, function (rs) {
        var sOption = '';
        var name = ''; // for select place holder

        //vitim select 
        name = 'Data Category';
        sOption = iniGlobalSelect(rs.data.base_report.victim.primary, name);
        $('#brv-primary').html(sOption);

        var iCount = 0;
        $.each(rs.data, function (key, val) {
            aGPData[iCount] = key;
            $('#vr-opt-' + key).html(iniCheckOption(val, key, 'vr'));
            iCount++;
        });

        //case select 
        name = 'Data Category';
        sOption = iniGlobalSelect(rs.data.base_report.case.primary, name);
        $('#brc-primary').html(sOption);

        var iCount = 0;
        $.each(rs.data, function (key, val) {
            aGPData[iCount] = key;
            $('#cr-opt-' + key).html(iniCheckOption(val, key, 'cr'));
            iCount++;
        });

        // case victim select 
        name = 'Data Category';
        sOption = iniGlobalSelect(rs.data.base_report.casevictim.primary, name);
        $('#brcv-primary').html(sOption);

        var iCount = 0;
        $.each(rs.data, function (key, val) {
            aGPData[iCount] = key;
            $('#cvr-opt-' + key).html(iniCheckOption(val, key, 'cv'));
            iCount++;
        });

        // report select 
        name = 'Data Category';
        sOption = iniGlobalSelect(rs.data.base_report.minor.primary, name);
        $('#brrm-primary').html(sOption);

        var iCount = 0;
        $.each(rs.data, function (key, val) {
            aGPData[iCount] = key;
            $('#rm-opt-' + key).html(iniCheckOption(val, key, 'rm'));
            iCount++;
        });

        aGPData.join();
        aGPData.splice(0, 1);

    }, 'json');
}

function iniCheckOption(rs, name, abr) {
    if (name == 'country') {
        rs = country_list;
    }
    var l = '';
    l += ' <div class="custom-control custom-checkbox">';
    l += '    <input type="checkbox" class="' + abr + '-opt-check_all custom-control-input"  value="0" name="opt' + abr + '_' + name + '" id="opt-' + abr + '_' + name + '">';
    l += '    <label class="custom-control-label" for="opt-' + abr + '_' + name + '">Check All</label>';
    l += '</div>';

    $.each(rs, function (key, val) {
        l += ' <div class="custom-control custom-checkbox">';
        l += '    <input type="checkbox" class="custom-control-input be-' + abr + '-opt opt-' + abr + '_' + name + '"  value="' + val.id + '" name="opt-' + abr + '_' + name + '" id="opt' + abr + '_' + name + '-' + val.id + '">';
        l += '    <label class="custom-control-label" for="opt' + abr + '_' + name + '-' + val.id + '">' + val.name + '</label>';
        l += '</div>';
    });

    // var aName = name.split('_');
    // if (aName.indexOf('tip') != 0) {
    //     l += ' <div class="custom-control custom-checkbox">';
    //     l += '    <input type="checkbox" class="custom-control-input be-' + abr + '-opt opt-' + abr + '_' + name + '"  value="no_record" name="opt-' + abr + '_' + name + '" id="opt' + abr + '_' + name + '-no_record">';
    //     l += '    <label class="custom-control-label" for="opt' + abr + '_' + name + '-no_record">No Record</label>';
    //     l += '</div>';
    // }

    return l;
}

function iniGlobalSelect(rs, name) {
    var l = '<option value="0" disabled selected> Select ' + name + '</option>';
    $.each(rs, function (key, val) {
        l += ' <option value="' + val.id + '">' + val.name + '</option> ';
    });
    return l;
}

function getDepartureType() {
    $.post(sAjaxGlobalData, {
        type: "getDepartureType"
    }, function (rs) {
        l = "<option class='pl' value='' selected>Select Departure Type</option>",
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
            l += `<option value=${val.transaction_parameter_count_id }>${val.transaction_parameter_name}</option>`;
        });
        $("#sel-temporary_case_status_id").html(l);
    }, "json");
}

$(document).ready(function () {

    // skeletal 
    getLoadingList();

    //get global, location and transaction data
    initialLoad();

    getAllLists({
        page: 1,
        type: "getAllTemporaryCaseList"
    });


    // Pagination
    $('.rs-pagination-all').delegate('.page-link', 'click', function () {
        getAllLists({
            page: parseInt($(this).attr('data-page')),
            type: "getAllTemporaryCaseList"
        });
    });


    // date picker 
    $('#inp-date_submitted').daterangepicker({
        forceUpdate: true,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        callback: function (startDate, endDate, period) {
            //  Build Date and add class to daterangepicker
            var title = startDate.format('L') + ' – ' + endDate.format('L');
            $(this).val(title);
            $('#inp-date_submitted').attr('data-start', startDate.format('YYYY-MM-DD'));
            $('#inp-date_submitted').attr('data-end', endDate.format('YYYY-MM-DD'));
        }
    });


    // click advance 
    $("#btn-search-advanced_filter").click(function () {
        getLoadingList();
        getAllLists({
            page: 1,
            type: "getAllTemporaryCaseList"
        });
    });

    $("#btn-advanced_filter").click(function () {
        var l = "";
        $(".a-vi-address_province").html(l);
        $(".a-vi-address_province").prop("disabled", true);
        $(".a-vi-address_city").html(l);
        $(".a-vi-address_city").prop("disabled", true);
        $(".container-advanced_filter").removeClass("hide");
        let check = $("#btn-advanced_filter").attr('data-chosen');
        if (!check) {
            $("#btn-advanced_filter").attr('data-chosen', '1');
            $(".vi-job").chosen();
            $(".sel-agencies-branches").chosen();
            $(".sel-assessment-services").chosen();
        }
    });

    $(".btn-close_filter").click(function () {
        $("#form-advanced_filter")[0].reset();
        $(".container-advanced_filter").addClass("hide");
    });

    $('#form-advanced_filter').delegate('.cv-opt-check_all', 'click', function () {
        let name = $(this).attr('id');
        if ($(this).is(":checked")) {
            $('.' + name).prop("checked", true);
        } else {
            $('.' + name).prop("checked", false);
        }
    });

    $('#form-advanced_filter').delegate('.be-cv-opt', 'change', function () {
        let name = $(this).attr('name');
        if ($(this).is(":checked")) {
            var isAllChecked = 0;
            $('.' + name).each(function () {
                if (!this.checked)
                    isAllChecked = 1;
            });
            if (isAllChecked === 0) {
                $("#" + name).prop("checked", true);
            }
        } else {
            $("#" + name).prop("checked", false);
        }
    });

    // For All Case Pagination
    $(".rs-pagination-all").delegate(".page-link", "click", function () {
        var page = parseInt($(this).attr("data-page"));
        getAllCaseLists({page: page, tab: 1});
    });

    // action list 
    $('#list-temporary_cases').delegate('.ellipse-action', 'click', function (e) {
        var id = $(this).attr('data-id');
        if ($('.action-' + id).is(":visible")) {
            $('.action-' + id).hide();
            $('.a-ellipse').removeClass('ellipse-selected');
        } else {
            $('.action-menu').hide();
            $('.a-ellipse').removeClass('ellipse-selected');
            $('.action-' + id).show();
            $('.a-ellipse-' + id).addClass('ellipse-selected');
        }
    });


});