var aGPData = [];

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
        //        l += '<ul class="div-all case-list list_content list-case-details" id="list-all_cases">';
        l += '<li style="width:100%;" class="case-content">';
        //        l += '    <div class="card" data-toggle="modal" data-target="#mdl-case-details">';
        l += '    <div class="card">';
        l += '        <div class="row cases">';
        // with status
        //        l += '            <div class="col-lg-8 col-md-8 col-sm-8  bk-trig-cmodal" attr-id="' + val.case_id + '">';
        // with out status
        l +=
            '            <div class="col-lg-10 col-md-9 col-sm-9 col-xs-9  bk-trig-cmodal" attr-id="' +
            val.case_id +
            '">';
        l +=
            '                <ul class="list-group list-group-horizontal nav-case_details list_content  ul-report-list" data-cid="' +
            val.case_id +
            '">';
        l += '                    <li class="list-group-item">';
        l +=
            '                        <span class="tags ' +
            getPriorityTag(val.case_priority_level_id) +
            '"></span> <span class="case-id">' +
            val.case_number +
            "</span>";
        l += "                        <br>";
        l +=
            '                        <span style="color: #343a40;">Victim Name : &nbsp; </span><span class="">' +
            val.victim_name +
            "</span>";
        l += "                        <br>";
        l +=
            '                        <span style="color: #343a40;">Created by : &nbsp;</span><span class="">' +
            val.filed_by +
            " | " +
            val.filed_by_agency +
            "</span>";
        l += "                        <br>";
        l +=
            '                        <span style="color: #343a40;">Date created : &nbsp; </span><span class="">' +
            val.case_date_added +
            "</span>";
        l += "                    </li>";
        l += "                </ul>";
        l += "            </div>";
        l +=
            '             <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 " style="  padding: 10px 48px;">';
        l +=
            '                <div class="btn-group ellipse-action " data-id = "' +
            val.case_id +
            '">';
        l +=
            '                    <a class="a-ellipse a-ellipse-i action_btn a-ellipse-' +
            val.case_id +
            ' "> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </a>';
        l +=
            '                    <div class="action-menu action-' +
            val.case_id +
            '" data-cur-stat="1" style="display: none;">';
        l +=
            '                        <a class="dropdown-item disabled action-title" href="#">Select Action</a>';
        l +=
            '                        <a class="dropdown-item lvl-ch " href="' +
            sAjaxUrl +
            "/update_case/" +
            val.case_id +
            '">Manage Report</a>';
        l +=
            '                        <a class="dropdown-item lvl-ce a-view_services" href="' +
            sAjaxUrl +
            "/view_victim_services/" +
            val.case_id +
            "/" +
            val.victim_id +
            '">Service Monitoring</a>';
        l +=
            '                        <a class="dropdown-item" href="' +
            sAjaxUrl +
            "/report_details/" +
            val.case_id +
            "/" +
            val.victim_id +
            '">View Report Details</a>';
        l += "                    </div>";
        l += "                </div>";
        l += "            </div>";
        l += "        </div>";
        l += "    </div>";
        l += "</li>";
    });
    return l;
}

function getAllCaseLists(x) {

    var optData = {};
    var sOptData = '';

    optData['age_min'] = isNaN(parseInt($(".inp-min_age").val())) ? 0 : parseInt($(".inp-min_age").val());
    optData['age_max'] = isNaN(parseInt($(".inp-max_age").val())) ? 0 : parseInt($(".inp-max_age").val());

    $("#max_age-error").hide(); 

    if(optData['age_min'] > optData['age_max']){
        $("#max_age-error").show();
        return; 
    }

    var sFilter = "";
    switch (String(x.tab)) {
        case "1":
            sFilter = getValueFilter({ id: "ac-filter_button", name: "status" });
            break;
        case "2":
            sFilter = getValueFilter({ id: "cc-filter_button", name: "status" });
            break;
        case "3":
            sFilter = getValueFilter({ id: "tac-filter_button", name: "status" });
            break;
        case "4":
            sFilter = getValueFilter({ id: "tuc-filter_button", name: "status" });
            break;
    }

    var limit = 10;
   
    $.each(aGPData, function (key, val) {
        optData[val] = $('.opt-cv_' + val + ':checked').map(function () {
            return this.value;
        }).get();
    });

    optData['region'] = $(".a-vi-address_region").val();
    optData['province'] = $(".a-vi-address_province").val();
    optData['city'] = $(".a-vi-address_city").val();
    optData['date_filed'] = $('#cvr-reportrange').val();
    optData['date_filed_start'] = $('#cvr-reportrange').attr('data-start');
    optData['date_filed_end'] = $('#cvr-reportrange').attr('data-end');
    optData['sex'] = isNaN(parseInt($(".vi-sex").val())) ? "" : parseInt($(".vi-sex").val());
    optData['job'] = $(".vi-job").val();
    optData['departure_type'] = $("#emp-sel-departure").val();
    optData['agecies_branch'] = $(".sel-agencies-branches").val();
    optData['services'] = $(".sel-assessment-services").val();
    optData['local_agency_id'] = $('.emp-local-recruitment_agency_name').attr('data-id');
    optData['foreign_agency_id'] = $('.emp-foreign-recruitment_agency_name').attr('data-id');
    optData['employer_id'] = $('.emp-employer-employer_name').attr('data-id');

    sOptData = JSON.stringify(optData);

    $.post(
        sAjaxCase, {
        type: "getAllCaseLists",
        limit: limit,
        page: x.page,
        tab: x.tab,
        keyword: getKeyword(x.tab),
        filter: sFilter,
        optData: sOptData,
    },
        function (rs) {
            rs = html_entity_decode(rs);
            if (rs.data.flag == 1) {
                $("#tab-content-" + x.tab).show();
                $("#tab-no-content-" + x.tab).hide();
                switch (parseInt(x.tab)) {
                    case 1:
                        $("#list-all_cases").html(buildCasesList(rs.data.content.listing));
                        $(".filter_load_placeholder").hide();
                        grantLevel();
                        // pagination
                        buildPagination({
                            parent: "rs-list-all",
                            info: "rs-info-all",
                            pagination: "rs-pagination-all",
                            offset: "rs-offset",
                            data: {
                                page: x.page,
                                offset: limit,
                                count: rs.data.content.count
                            }
                        });
                        break;
                    case 2:
                        $("#list-created").html(buildCasesList(rs.data.content.listing));
                        $(".filter_load_placeholder").hide();
                        grantLevel();
                        // pagination
                        buildPagination({
                            parent: "rs-list-created",
                            info: "rs-info-created",
                            pagination: "rs-pagination-created",
                            offset: "rs-offset",
                            data: {
                                page: x.page,
                                offset: limit,
                                count: rs.data.content.count
                            }
                        });
                        break;
                    case 3:
                        $("#list-tagged").html(buildCasesList(rs.data.content.listing));
                        $(".filter_load_placeholder").hide();
                        grantLevel();
                        // pagination
                        buildPagination({
                            parent: "rs-list-tagged",
                            info: "rs-info-tagged",
                            pagination: "rs-pagination-tagged",
                            offset: "rs-offset",
                            data: {
                                page: x.page,
                                offset: limit,
                                count: rs.data.content.count
                            }
                        });
                        break;
                    case 4:
                        $("#list-tagged_user").html(
                            buildCasesList(rs.data.content.listing)
                        );
                        $(".filter_load_placeholder").hide();
                        grantLevel();
                        // pagination
                        buildPagination({
                            parent: "rs-list-tagged_user",
                            info: "rs-info-tagged_user",
                            pagination: "rs-pagination-tagged_user",
                            offset: "rs-offset",
                            data: {
                                page: x.page,
                                offset: limit,
                                count: rs.data.content.count
                            }
                        });
                        break;
                }
            } else {
                var sFooter =
                    '<a href="' +
                    sAjaxUrl +
                    '/add_case"> <button type="button" class="btn" style="background-color: #e88f15; color: #fff;"> ADD CASE </button> </a>';
                var sMessage =
                    'SORRY, WE COULDN\'T FIND ANY CASE RELATED TO <span class = "font-italic" >"<span>' +
                    keyword +
                    '</span>"</span>.';
                if (!getKeyword(x.tab)) {
                    sMessage = "NO CASES AVAILABLE YET.";
                }
                var l = getNoDataFound({
                    message: sMessage,
                    footer: sFooter
                });
                $("#tab-content-" + x.tab).hide();
                $("#tab-no-content-" + x.tab).remove();
                $("#tab-content-" + x.tab).after(
                    "<div id='tab-no-content-" + x.tab + "'>" + l + "</div>"
                );
            }
        },
        "json"
    );
}

function getTipContentToString(aParam) {
    var aItem = [];
    var sItem = "-";
    var i = 0;
    if (aParam.length > 0) {
        $.each(aParam, function (key, val) {
            aItem[i] = val.details;
            i++;
        });
        sItem = aItem.join(", ");
    }

    return sItem;
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

function getProvinceByRegionID(id) {
    $.post(
        sAjaxGlobalData, {
        type: "getProvinceByRegionID",
        region_id: id
    },
        function (rs) {
            var l = "<option selected disabled >Select Province</option>";
            $(".sel-provincesByRegionId").html(l);
            if (rs.data) {
                $.each(rs.data, function (key, val) {
                    l +=
                        "<option value='" +
                        val.location_count_id +
                        "' data-name='" +
                        val.location_name +
                        "'>" +
                        val.location_name +
                        "</option>";
                });
                $(".sel-provincesByRegionId").html(l);
                var iVal = $(".u-vi-address_province").attr("data-id");
                if (iVal) {
                    $(".u-vi-address_province").val(iVal).change();
                }
            }
        },
        "json"
    );
}

function getCityByProvinceId(id) {
    $.post(
        sAjaxGlobalData, {
        type: "getCityByProvinceId",
        province_id: id
    },
        function (rs) {
            var l = "<option selected disabled >Select City</option>";
            $(".sel-cities").html(l);
            if (rs.data) {
                $.each(rs.data, function (key, val) {
                    l +=
                        "<option value='" +
                        val.location_count_id +
                        "' data-name='" +
                        val.location_name +
                        "'>" +
                        val.location_name +
                        "</option>";
                });
                $(".sel-cities").html(l);
                var iVal = $(".u-vi-address_city").attr("data-id");
                if (iVal) {
                    $(".u-vi-address_city").val(iVal).change();
                }
            }
        },
        "json"
    );
}

function initialLoad() {
    getCountries();
    getRegions();
    getProvinces();
    getSex();
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

    var aName = name.split('_');
    if (aName.indexOf('tip') != 0) {
        l += ' <div class="custom-control custom-checkbox">';
        l += '    <input type="checkbox" class="custom-control-input be-' + abr + '-opt opt-' + abr + '_' + name + '"  value="no_record" name="opt-' + abr + '_' + name + '" id="opt' + abr + '_' + name + '-no_record">';
        l += '    <label class="custom-control-label" for="opt' + abr + '_' + name + '-no_record">No Record</label>';
        l += '</div>';
    }

    return l;
}

function iniGlobalSelect(rs, name) {
    var l = '<option value="0" disabled selected> Select ' + name + '</option>';
    $.each(rs, function (key, val) {
        l += ' <option value="' + val.id + '">' + val.name + '</option> ';
    });
    return l;
}

function iniDateRangePicker() {

    // Start  Initialized Date range picker 
    //case victim
    $('#cvr-reportrange').daterangepicker({
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
            $('#cvr-reportrange').attr('data-start', startDate.format('YYYY-MM-DD'));
            $('#cvr-reportrange').attr('data-end', endDate.format('YYYY-MM-DD'));
        }
    });

    $('#cvr-reportrange').val(""); 
    
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
        $('#emp-sel-departure').html(l);
    }, 'json');
}

function getEmployerByKeyword() {

    // remove attr 
    $('.emp-employer-employer_name').removeAttr('data-id');

    var keyword = $('.emp-employer-employer_name').val();
    $.post(sAjaxEmployer, {
        type: 'getEmployerByKeyword',
        keyword: keyword,
    }, function (rs) {
        rs = html_entity_decode(rs);
        if (rs.data.flag != '0') {
            $('#employer-search').show();
            var l = '';
            $.each(rs.data.list, function (key, val) {
                l += " <li class='list-group-item' data-id='" + val.employer_id + "' data-name='" + val.employer_name +"'> " + val.employer_name + "</li>";
            });
            $('#employer-search').html(l);
        } else {
            $('#employer-search').hide();

        }
    }, 'json');
}

function getLocalRecruitmentByKeyword() {
     // remove attr 
    $('.emp-local-recruitment_agency_name').removeAttr('data-id');
    var keyword = $('.emp-local-recruitment_agency_name').val();
    $.post(sAjaxRecruitment, {
        type: 'getLocalRecruitmentByKeyword',
        keyword: keyword,
    }, function (rs) {
        if (rs.data.flag != '0') {
            $('#ra-local-search').show();
            var l = '';
            $.each(rs.data.list, function (key, val) {
                l += " <li class='list-group-item' data-id='" + val.recruitment_agency_id + "' data-name='"+ val.recruitment_agency_name +"'> " + val.recruitment_agency_name + "</li>";
            });
            $('#ra-local-search').html(l);
        } else {
            $('#ra-local-search').hide();
        }
    }, 'json');
}

function getForeignRecruitmentByKeyword() {
     // remove attr 
    $('.emp-foreign-recruitment_agency_name').removeAttr('data-id');
    var keyword = $('.emp-foreign-recruitment_agency_name').val();
    $.post(sAjaxRecruitment, {
        type: 'getForeignRecruitmentByKeyword',
        keyword: keyword,
    }, function (rs) {

        if (rs.data.flag != '0') {
            $('#ra-foreign-search').show();
            var l = '';
            $.each(rs.data.list, function (key, val) {
                l += " <li class='list-group-item' data-id='" + val.recruitment_agency_id + "' data-name='"+ val.recruitment_agency_name +"'> " + val.recruitment_agency_name + "</li>";
            });
            $('#ra-foreign-search').html(l);
        } else {
            $('#ra-foreign-search').hide();
        }
    }, 'json');
}

$(document).ready(function () {

    //get global, location and transaction data
    initialLoad();
    
    getAllGlobalParameter();
    getActiveOccupations(); 
    getAgenciesBranches(); 
    getLoadingList();
    getDepartureType(); 
    getAssessmentServices(); 

    getAllCaseLists({ page: 1, tab: 1 });
    getAllCaseLists({ page: 1, tab: 2 });
    getAllCaseLists({ page: 1, tab: 3 });
    getAllCaseLists({ page: 1, tab: 4 });
   
    // for searching
    $('.emp-employer-employer_name').on('keyup', function (e) {
        var keyword = $(this).val();
        setTimeout(function () {
            if (keyword.length) {
                getEmployerByKeyword();
            }
        }, 1000);
    });

     // select employer list 
     $('#employer-search').delegate('.list-group-item', 'click', function () {
        var name = $(this).attr('data-name');
        var id = $(this).attr('data-id');
        $('.emp-employer-employer_name').attr('data-id', id);
        $('.emp-employer-employer_name').val(name);
    });


    // for search foreign recruitment 
    $('.emp-foreign-recruitment_agency_name').on('keyup', function (e) {
        var keyword = $(this).val();
        setTimeout(function () {
            if (keyword.length) {
                getForeignRecruitmentByKeyword();
            }
        }, 1000);
    });

    // select foreign list list 
    $('#ra-foreign-search').delegate('.list-group-item', 'click', function () {
        var name = $(this).attr('data-name');
        var id = $(this).attr('data-id');
        $('.emp-foreign-recruitment_agency_name').attr('data-id', id);
        $('.emp-foreign-recruitment_agency_name').val(name);
    });

     // for search local recruitment 
     $('.emp-local-recruitment_agency_name').on('keyup', function (e) {
        var keyword = $(this).val();
        setTimeout(function () {
            if (keyword.length) {
                getLocalRecruitmentByKeyword();
            }
        }, 1000);
    });

    // select local list list 
    $('#ra-local-search').delegate('.list-group-item', 'click', function () {
        var name = $(this).attr('data-name');
        var id = $(this).attr('data-id');
        $('.emp-local-recruitment_agency_name').attr('data-id', id);
        $('.emp-local-recruitment_agency_name').val(name);
    });

    var userLevel = $("#ul-header-user").attr("data-level"); // global for agency panel
    if (userLevel !== "4") {
        $("#li-a_cct").click();
    }

    iniDateRangePicker();

    // date picker 
    $('.datepicker').datetimepicker({
        timepicker: false,
        format: 'm/d/Y',
        scrollMonth: false,
        scrollInput: false
    });

    // click advance 
    $("#btn-search-advanced_filter").click(function () {
        getLoadingList();
        getAllCaseLists({ page: 1, tab: 1 });
        getAllCaseLists({ page: 1, tab: 2 });
        getAllCaseLists({ page: 1, tab: 3 });
        getAllCaseLists({ page: 1, tab: 4 });
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

    $('.a-vi-address_region').change(function () {
        getProvincesByRegionId(this.value);
        $('.a-vi-address_province').attr('disabled', false);
        $('.a-vi-address_city').html("");
        $('.a-vi-address_city').prop("disabled", true);
    });

    $('.a-vi-address_province').change(function () {
        getCityByProvinceId(this.value);
        $('.a-vi-address_city').attr('disabled', false);
    });

    // tagged by whole agency
    $(".li-tagged-cases").click(function () {
        getAllCaseLists({ page: 1, tab: 3 });
    });
    // For All Case Pagination
    $(".rs-pagination-all").delegate(".page-link", "click", function () {
        var page = parseInt($(this).attr("data-page"));
        getAllCaseLists({ page: page, tab: 1 });
    });
    // For  Created Cases Pagination
    $(".rs-pagination-created").delegate(".page-link", "click", function () {
        var page = parseInt($(this).attr("data-page"));
        getAllCaseLists({ page: page, tab: 2 });
    });
    // For Tagged Case Pagination
    $(".rs-pagination-tagged").delegate(".page-link", "click", function () {
        var page = parseInt($(this).attr("data-page"));
        getAllCaseLists({ page: page, tab: 3 });
    });
    // For Tagged Case user Pagination
    $(".rs-pagination-tagged_user").delegate(".page-link", "click", function () {
        var page = parseInt($(this).attr("data-page"));
        getAllCaseLists({ page: page, tab: 4 });
    });
    // For Searching All Case
    $("#txt_search-all").on("keypress", function (e) {
        if (e.which == 13) {
            getAllCaseLists({ page: 1, tab: 1 });
        }
    });
    $("#txt_search-all").change(function () {
        setTimeout(function () {
            getAllCaseLists({ page: 1, tab: 1 });
        }, 1000);
    });
    // For Searaching Created Case
    $("#txt_search-created").on("keypress", function (e) {
        if (e.which == 13) {
            getAllCaseLists({ page: 1, tab: 2 });
        }
    });
    $("#txt_search-created").change(function () {
        setTimeout(function () {
            getAllCaseLists({ page: 1, tab: 2 });
        }, 1000);
    });
    // For Tagged Case
    $("#txt_search-tagged").on("keypress", function (e) {
        if (e.which == 13) {
            getAllCaseLists({ page: 1, tab: 3 });
        }
    });
    $("#txt_search-tagged").change(function () {
        setTimeout(function () {
            getAllCaseLists({ page: 1, tab: 3 });
        }, 1000);
    });
    // For Tagged User Case
    $("#txt_search-tagged_user").on("keypress", function (e) {
        if (e.which == 13) {
            getAllCaseLists({ page: 1, tab: 4 });
        }
    });
    $("#txt_search-tagged_user").change(function () {
        setTimeout(function () {
            getAllCaseLists({ page: 1, tab: 4 });
        }, 1000);
    });
    // action list
    $("#myTabContent").delegate(".ellipse-action", "click", function (e) {
        var id = $(this).attr("data-id");
        if ($(".action-" + id).is(":visible")) {
            $(".action-" + id).hide();
            $(".a-ellipse").removeClass("ellipse-selected");
        } else {
            $(".action-menu").hide();
            $(".a-ellipse").removeClass("ellipse-selected");
            $(".action-" + id).show();
            $(".a-ellipse-" + id).addClass("ellipse-selected");
        }
    });

    //    $('#myTabContent').delegate('.ul-report-list', 'click', function () {
    //        var id = $(this).attr('data-cid');
    //        var link = sAjaxUrl + '/report_details/' + id;
    //        window.open(link, "popupWindow", "width=1024, height=800, scrollbars=yes");
    //    });

    // All Users Created Filter
    $("#ac-filter_button .chk-filter").click(function () {
        getAllCaseLists({ page: 1, tab: 1 });
    });

    // Created Filter
    $("#cc-filter_button .chk-filter").click(function () {
        getAllCaseLists({ page: 1, tab: 2 });
    });

    // Tagged Filter
    $("#tac-filter_button .chk-filter").click(function () {
        getAllCaseLists({ page: 1, tab: 3 });
    });

    // Tagged Filter
    $("#tuc-filter_button .chk-filter").click(function () {
        getAllCaseLists({ page: 1, tab: 4 });
    });

    // user restirction view of tab
    var userLevel = $("#ul-header-user").attr("data-level"); // global for agency panel
    switch (userLevel) {
        case "2": //hide to Case Encoder
            break;
        case "3": //hide to Case Handler
            $(".li-tagged-user-cases a").click();
            break;
        case "4": //hide case Administrator
            $(".li-tagged-user-cases a").click();
            break;
        case "5": //hide Reports And Analytics
            break;
        default:
        // branch administrator
        //lvl-ce lvl-ch lvl-ca lvl-ra
    }
});