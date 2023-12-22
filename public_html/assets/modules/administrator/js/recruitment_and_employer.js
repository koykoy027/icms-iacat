
function getListLocalRecruitment(page = 1, display = "with_cases") {
    getLoadingList();
    var limit = 10;
    var keyword = $('#txt_search-local_recruitment').val();
    var orderby = $('.sel-local-orderby').val();

    $.post(sAjaxRecruitment, {
        type: 'getListLocalRecruitment',
        limit: limit,
        page: page,
        keyword: keyword,
        orderby: orderby,
        display: display
    }, function (rs) {

        if (parseInt(rs.data.content.count) > 0) {
            $('.empty-search').hide();
            $('.list-container_foreign').show();
//            $('.filter_load_placeholder').hide();
            $('#list-local_recruiter-no-content').remove();
            var builType = "local";
            buildListOfRecruitment(rs.data.content.list, builType);
            // pagination - library
            buildPagination({
                parent: 'rs-list-local_recruitment',
                info: 'rs-info-local_recruitment',
                pagination: 'rs-pagination-local_recruitment',
                offset: 'rs-offset',
                data: {
                    page: page,
                    offset: limit,
                    count: rs.data.content.count
                }
            });
        } else {
            var sMessage = 'SORRY, WE COULDN\'T FIND ANY LOCAL RECRUITER DETAILS RELATED TO <span class = "font-italic" >"<span>' + keyword + '</span>"</span>.';
            if (!(keyword)) {
                sMessage = 'NO LOCAL RECRUITER DETAILS FOUND.';
            }
            var l = getNoDataFound({
                message: sMessage,
                footer: ''
            });
            $('.list-container_local').hide();
            $('.empty-search').show();
            $('.empty-search').html(l);
        }

    }, 'json');
}


function getListForeignRecruitment(page = 1, display = "with_cases") {
    getLoadingList();
    var limit = 10;
    var keyword = $('#txt_search-foreign_recruitment').val();
    var orderby = $('.sel-foreign-orderby').val();
    $.post(sAjaxRecruitment, {
        type: 'getListForeignRecruitment',
        limit: limit,
        page: page,
        keyword: keyword,
        orderby: orderby,
        display: display
    }, function (rs) {
        if (parseInt(rs.data.content.count)) {
            $('.empty-search').hide();
            $('.list-container_foreign').show();
            $('.filter_load_placeholder').hide();
            $('#list-foreign_recruiter-no-content').remove();
            var builType = "foreign";
            buildListOfRecruitment(rs.data.content.list, builType);
            // pagination - library
            buildPagination({
                parent: 'rs-list-foreign_recruitment',
                info: 'rs-info-foreign_recruitment',
                pagination: 'rs-pagination-foreign_recruitment',
                offset: 'rs-offset',
                data: {
                    page: page,
                    offset: limit,
                    count: rs.data.content.count
                }
            });
        } else {
            var sMessage = 'SORRY, WE COULDN\'T FIND ANY FOREIGN RECRUITER DETAILS RELATED TO <span class = "font-italic" >"<span>' + keyword + '</span>"</span>.';
            if (!(keyword)) {
                sMessage = 'NO FOREIGN RECRUITER DETAILS FOUND.';
            }
            var l = getNoDataFound({
                message: sMessage,
                footer: ''
            });
            $('.list-container_foreign').hide();
            $('.empty-search').show();
            $('.empty-search').html(l);
        }

    }, 'json');
}


function buildListOfRecruitment(res, builType) {

    var l = '';
    $.each(res, function (key, val) {

        l += '<li class="" style="width:100%">';
        l += '  <div class="card">';
        l += '      <div class="row">';
        l += '          <div class="col-lg-8 col-md-8 col-sm-8 ">';
        l += '              <div class="agency_details"> <span class="content-title"> ' + val.recruitment_agency_name + ' </span>';
        var stateProv = val.province;
        if (val.province == "") {
            stateProv = val.state;
        }
        l += '                   <br> <span class="desc_sub_name">  ' + val.recruitment_agency_address + ' ' + stateProv + ' ' + val.country + ' </span>';
        l += '                   <br><span class="txt-light">' + val.recruitment_agency_email + '</span>';
        l += '                   <br> <span class="txt-light">' + val.recruitment_agency_tel_no + '</span>';
        l += '                </div>';
        l += '             </div>';

        l += '             <div class="col-lg-2 col-md-2 col-sm-2  d-flex align-items-center justify-content-center">';
        if (val.case_count == "1") {
            l += '                  <span class="icms-btn-secondary" style="color: #263548;font-weight: 600;"> <i class="fa fa-suitcase pr-2" aria-hidden="true" style="color: #adb5bd;"></i>' + val.case_count + '' + ' Case</span>';

        } else if (val.case_count == "0") {
            l += '                  <span class="icms-btn-secondary" style="color: #263548;font-weight: 500;"> ' + val.case_count + '' + ' </span>';
        } else {
            l += '                  <span class="icms-btn-secondary" style="color: #263548;font-weight: 600;"> <i class="fa fa-suitcase pr-2" aria-hidden="true" style="color: #adb5bd;"></i>' + val.case_count + '' + ' Cases</span>';

        }
        l += '             </div>';
        l += '             <div class="col-lg-2 col-md-2 col-sm-2  d-flex align-items-center justify-content-center ">';
        if (builType == "local") {
            l += '              <div class="btn-group ellipse-action " data-id="' + val.recruitment_agency_id + '">';
            l += '                   <a class="a-ellipse a-ellipse-' + val.recruitment_agency_id + '   action_btn"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </a>';
            l += '                   <div class="action-menu l' + val.recruitment_agency_id + '"  id="' + val.recruitment_agency_id + '" style="display: none;"> ';
            l += '                        <a class="dropdown-item disabled action-title" href="#">Select Action</a>';
            l += '                        <a class="dropdown-item a-manage-details" >Manage Details</a> ';
            l += '                    </div>';
            l += '               </div>';
        } else {
            l += '               <div class="btn-group ellipse-action " data-id="' + val.recruitment_agency_id + '">';
            l += '                     <a class="a-ellipse a-ellipse-' + val.recruitment_agency_id + '   action_btn"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </a>';
            l += '                     <div class="action-menu  f' + val.recruitment_agency_id + '"  id="' + val.recruitment_agency_id + '"> ';
            l += '                          <a class="dropdown-item disabled action-title" href="#">Select Action</a>';
            l += '                          <a class="dropdown-item a-manage-details" >Manage Details</a> ';
            l += '                      </div>';
            l += '                </div>';
        }
        l += '                    </div>';
        l += '            </div>';
        l += '      </div>';
        l += '   </div>';
        l += ' </li>';
    });
    $('.filter_load_placeholder').hide();
    if (builType == "local") {
        $('.list-local_recruiter').html(l);
    } else {
        $('.list-foreign_recruitment').html(l);
    }
}



function buildListEmployer(res) {
    var l = '';
    $.each(res, function (key, val) {

        l += '  <li class="" style="width:100%">';
        l += '                                <div class="card">';
        l += '                                    <div class="row">';
        l += '                                       <div class="col-lg-8 col-md-8 col-sm-8  align-items-center ">';
        l += '                                            <div class="agency_details"> <span class="content-title "> ' + val.employer_name + '</span>';
        l += '                                               <br> <span class="text-normal"> ' + val.employer_full_address + ' ' + val.employer_city + ' ' + val.country + '</span>';
        l += '                                            </div>';
        l += '                                        </div>';
        l += '                                        <div class="col-lg-2 col-md-2 col-sm-2 txt-align_center">';
        if (val.case_count == "1") {
            l += '                  <span class="icms-btn-secondary" style="color: #263548;font-weight: 500;"> <i class="fa fa-suitcase pr-2" aria-hidden="true" style="color: #adb5bd;"></i>' + val.case_count + '' + ' Case</span>';

        } else if (val.case_count == "0") {
            l += '                  <span class="icms-btn-secondary" style="color: #263548;font-weight: 500;"> ' + val.case_count + '' + ' </span>';
        } else {
            l += '                  <span class="icms-btn-secondary" style="color: #263548;font-weight: 500;"> <i class="fa fa-suitcase pr-2" aria-hidden="true" style="color: #adb5bd;"></i>' + val.case_count + '' + ' Cases</span>';

        }
        l += '                                        </div>';
        l += '                                        <div class="col-lg-2 col-md-2 col-sm-2 txt-align_center ">';
        l += '                                            <div class="btn-group ellipse-action " data-id="' + val.employer_id + '">';
        l += '                                                <a class="a-ellipse a-ellipse-' + val.employer_id + '   action_btn"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </a>';
        l += '                                               <div class="action-menu e' + val.employer_id + '" id="' + val.employer_id + '" style="display: none;"> ';
        l += '                                                   <a class="dropdown-item disabled action-title" href="#">Select Action</a>';
        l += '                                                   <a class="dropdown-item a-manage-details"  href="#">Manage Details</a>';
        l += '                                                </div>';
        l += '                                           </div>';
        l += '                                        </div>';
        l += '                                    </div>';
        l += '                                </div>';
        l += '                            </li>';
    });
    $('.filter_load_placeholder').hide();
    $('.list-employer').html(l);
}

function getListEmployer(page = 1, display = "with_cases") {
    getLoadingList();
    var limit = 10;
    var keyword = $('#txt_search-employer').val();
    var orderby = $('.sel-emp-orderby').val();
    $.post(sAjaxEmployer, {
        type: 'getListEmployer',
        limit: limit,
        page: page,
        keyword: keyword,
        orderby: orderby,
        display: display,
    }, function (rs) {
        if (parseInt(rs.data.content.count) > 0) {
            $('.empty-search').hide();
            $('.list-container_employer').show();

            $('#list-employer-no-content').remove();
            buildListEmployer(rs.data.content.list);
            // pagination - library
            buildPagination({
                parent: 'rs-list-employer',
                info: 'rs-info-employer',
                pagination: 'rs-pagination-employer',
                offset: 'rs-offset',
                data: {
                    page: page,
                    offset: limit,
                    count: rs.data.content.count
                }
            });
        } else {
            var sMessage = 'SORRY, WE COULDN\'T FIND ANY EMPLOYER DETAILS RELATED TO <span class = "font-italic" >"<span>' + keyword + '</span>"</span>.';
            if (!(keyword)) {
                sMessage = 'NO  EMPLOYER DETAILS FOUND.';
            }
            var l = getNoDataFound({
                message: sMessage,
                footer: ''
            });
            $('.list-container_employer').hide();
            $('.empty-search').show();
            $('.empty-search').html(l);
        }
    }, 'json');
}

function getCountryList() {
    $.post(sAjaxGlobalData, {
        type: "getCountryISO"
    }, function (rs) {
        l = "";
        $.each(rs.data.country, function (key, val) {
            l += "<option value='" + val.country_id + "'>" + val.country_name + " </option>";
        });
        $('#sel-agency-country').html(l);
        $('#sel-emp-country').html(l);
    }, 'json');
}

function getProvinceState(id) {
    var type = "getProvinces";
    if (id !== "173") {
        type = "getStatesByCountryID";
    }
    $.post(sAjaxGlobalData, {
        type: type,
        id: id,
    }, function (rs) {
        l = "";
        l += "<option value='' disabled>Select State/Province</option>";
        $.each(rs.data, function (key, val) {
            l += "<option value='" + val.location_count_id + "'>" + val.location_name + " </option>";
        });
        $('#sel-agency-state').html(l);
        var selected = $('#sel-agency-state').attr('data-id');
        $('#sel-agency-state').val(selected).change();
    }, 'json');
}


$('#agency-details').validate({
    rules: {
        txtAgencyName: {required: true},
        txtAgencyEmail: {required: true},
        txtAgencyTelephone: {required: true},
        selAgencyCountry: {required: true},
        selAgencyState: {required: true},
        txtAgencyAddress: {required: true},
        txtAgencyOwner: {required: true},
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
        setRecruitmentAgencyDetails();
    }
});
$('#frm-emp-details').validate({
    rules: {
        txtEmpName: {required: true},
        txtEmpRep: {required: true},
        txtEmpContact: {required: true},
        txtEmpEmail: {required: true},
        selEmpCountry: {required: true},
        txtEmpCity: {required: true},
        txtEmpAddress: {required: true},
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
        setEmployerDetails();
    }
});
function setRecruitmentAgencyDetails() {
    $.post(sAjaxRecruitment, {
        type: "setRecruitmentAgencyDetails",
        agency_id: $('.btn-save-details').attr('data-id'),
        agency_name: $('#txt-agency-name').val(),
        agency_email: $('#txt-agency-email').val(),
        agency_website: $('#txt-agency-website').val(),
        agency_tel: $('#txt-agency-telephone').val(),
        agency_fax: $('#txt-agency-fax').val(),
        agency_state: $('#sel-agency-state').val(),
        agency_country: $('#sel-agency-country').val(),
        agency_address: $('#txt-agency-address').val(),
        agency_owner: $('#txt-agency-owner').val(),
        agency_owner_email: $('#txt-agency-owner-email').val(),
        agency_owner_contact: $('#txt-agency-owner-contact').val(),
        agency_owner_address: $('#txt-agency-owner-address').val(),
        agency_type: $('#sel-agency-type').val(),
    }, function (rs) {
        if (rs.data.php_validation.flag == "0") {
            $('#modal-update-recruitment-details').modal('hide');
            icmsMessage({
                type: 'msgError'
            });
        } else {
            $('#modal-update-recruitment-details').modal('hide');
            icmsMessage({
                type: 'msgSuccess',
                onHide: function () {
                    getListLocalRecruitment();
                    getListForeignRecruitment();

                }
            });
        }


    }, 'json');
}

function setEmployerDetails() {
    $.post(sAjaxEmployer, {
        type: 'setEmployerDetails',
        employer_id: $('.btn-save-emp-details').attr('data-id'),
        employer_name: $('#txt-emp-name').val(),
        employer_representative_name: $('#txt-emp-rep').val(),
        employer_tel_no: $('#txt-emp-contact').val(),
        employer_email: $('#txt-emp-email').val(),
        employer_country_id: $('#sel-emp-country').val(),
        employer_city: $('#txt-emp-city').val(),
        employer_full_address: $('#txt-emp-address').val(),
    }, function (rs) {
        getListEmployer();
        $('#modal-update-employer-details').modal("hide");
    }, 'json');
}

function addModalDetails(id) {

    $('.btn-save-details').attr('data-id', id);
    $.post(sAjaxRecruitment, {
        type: "getRecruitmentDetailsByID",
        id: id,
    }, function (rs) {
        console.log(rs);
        if (rs.data.result == "1") {
            var res = rs.data.details;
            $('#txt-agency-name').val(res.recruitment_agency_name);
            $('#txt-agency-email').val(res.recruitment_agency_email);
            $('#txt-agency-website').val(res.recruitment_agency_website);
            $('#txt-agency-telephone').val(res.recruitment_agency_tel_no);
            $('#txt-agency-fax').val(res.recruitment_agency_fax_no);
            $('#sel-agency-state').attr('data-id', res.state_id);
            $('#sel-agency-country').val(res.country_id).change();
            $('#txt-agency-address').val(res.recruitment_agency_address);
            $('#txt-agency-owner').val(res.recruitment_agency_owner_name);
            $('#txt-agency-owner-email').val(res.recruitment_agency_owner_email);
            $('#txt-agency-owner-contact').val(res.recruitment_agency_owner_contact_no);
            $('#txt-agency-owner-address').val(res.recruitment_agency_owner_address);
            $('#sel-agency-type').val(res.recruitment_agency_is_local).change();
            $('#msgmodal-saving').modal('hide');
        }
    }, 'json');
    $('#modal-update-recruitment-details').modal({
        backdrop: 'static',
        keyboard: false,
        show: true
    });
}

function addEmployerModalDetails(id) {
    $('.btn-save-emp-details').attr('data-id', id);
    $.post(sAjaxEmployer, {
        type: 'getEmployerDetailsByID',
        employer_id: id,
    }, function (rs) {
        if (rs.data.result == "1") {
            $('#txt-emp-name').val(rs.data.details.employer_name);
            $('#txt-emp-rep').val(rs.data.details.employer_representative_name);
            $('#txt-emp-contact').val(rs.data.details.employer_tel_no);
            $('#txt-emp-email').val(rs.data.details.employer_email);
            $('#sel-emp-country').val(rs.data.details.employer_country_id).change();
            $('#txt-emp-city').val(rs.data.details.employer_city);
            $('#txt-emp-address').val(rs.data.details.employer_full_address);
        }
    }, 'json');
    $('#modal-update-employer-details').modal({
        backdrop: 'static',
        keyboard: false,
        show: true
    });
}



$(document).ready(function () {
    getListLocalRecruitment();
    getListForeignRecruitment();
    getListEmployer();
    getCountryList();

    // For Local Recruitment Pagination
    $('.rs-pagination-local_recruitment').delegate('.page-link', 'click', function () {
        var page = parseInt($(this).attr('data-page'));
        getListLocalRecruitment(page);
    });
    // For Foreign Recruitment Pagination
    $('.rs-pagination-foreign_recruitment').delegate('.page-link', 'click', function () {
        var page = parseInt($(this).attr('data-page'));
        getListForeignRecruitment(page);
    });
    // For Employer Pagination
    $('.rs-pagination-employer').delegate('.page-link', 'click', function () {
        var page = parseInt($(this).attr('data-page'));
        getListEmployer(page);
    });
    // Search for local recruitment
    $('#txt_search-local_recruitment').change(function () {
        setTimeout(function () {
            getListLocalRecruitment();
        }, 1000);
    });

    $.fn.enterKey = function (fnc) {
        return this.each(function () {
            $(this).keypress(function (ev) {
                var keycode = (ev.keyCode ? ev.keyCode : ev.which);
                if (keycode == '13') {
                    fnc.call(this, ev);
                }
            })
        })
    }
    $('#txt_search-local_recruitment').on('search', function () {
        getListLocalRecruitment();
    });

    // Search for foreign recruitment
    $('#txt_search-foreign_recruitment').on('search', function () {
        getListForeignRecruitment();
    });
    $('#txt_search-employer').on('search', function () {
        getListEmployer();
    });
    // Search for employer 
    $('.sel-emp-orderby').change(function () {
        getListEmployer();
    });
    $('.sel-local-orderby').change(function () {
        getListLocalRecruitment();
    });
    $('.sel-foreign-orderby').change(function () {
        getListForeignRecruitment();
    });
    $('#sel-agency-country').change(function () {
        var id = $(this).val();
        getProvinceState(id);
    });
    $('.list-employer').delegate('.ellipse-action', 'click', function (e) {
        var id = $(this).attr('data-id');
        if ($('.e' + id).is(":visible")) {
            $('.e' + id).hide();
            $('.a-ellipse').removeClass('ellipse-selected');
        } else {
            $('.action-menu').hide();
            $('.a-ellipse').removeClass('ellipse-selected');
            $('.e' + id).show();
            $('.a-ellipse-e' + id).addClass('ellipse-selected');
        }
    });
    $('.list-local_recruiter').delegate('.ellipse-action', 'click', function (e) {
        var id = $(this).attr('data-id');
        if ($('.l' + id).is(":visible")) {
            $('.l' + id).hide();
            $('.a-ellipse').removeClass('ellipse-selected');
        } else {
            $('.action-menu').hide();
            $('.a-ellipse').removeClass('ellipse-selected');
            $('.l' + id).show();
            $('.a-ellipse-l' + id).addClass('ellipse-selected');
        }
    });
    $('.list-local_recruiter').delegate('.a-manage-details', 'click', function (e) {
        var id = $(this).parent('div').attr('id');
        addModalDetails(id);
    });
    $('.list-foreign_recruitment').delegate('.a-manage-details', 'click', function (e) {
        var id = $(this).parent('div').attr('id');
        addModalDetails(id);
    });
    $('.list-employer').delegate('.a-manage-details', 'click', function (e) {
        var id = $(this).parent('div').attr('id');
        addEmployerModalDetails(id);
    });
    $('.list-foreign_recruitment').delegate('.ellipse-action', 'click', function (e) {
        var id = $(this).attr('data-id');
        if ($('.f' + id).is(":visible")) {
            $('.f' + id).hide();
            $('.a-ellipse').removeClass('ellipse-selected');
        } else {
            $('.action-menu').hide();
            $('.a-ellipse').removeClass('ellipse-selected');
            $('.f' + id).show();
            $('.a-ellipse-f' + id).addClass('ellipse-selected');
        }
    });
    $('.btn-save-details').click(function () {
        $('#agency-details').submit();
    });
    $('.btn-save-emp-details').click(function () {
        $('#frm-emp-details').submit();
    });

    //get list for local agency
    $('.tab_local').click(function () {
        var display = $(this).attr('data-id');
        getListLocalRecruitment(1, display);
    });
    //get list for foreign agency
    $('.tab_foreign').click(function () {
        var display = $(this).attr('data-id');
        getListForeignRecruitment(1, display);
    });
    //get list for employer list
    $('.tab_employer').click(function () {
        var display = $(this).attr('data-id');
        getListEmployer(1, display);
    });
});

