
function buildVictimList(res) {
    var l = '';
    $.each(res, function (key, val) {
        l += '  <li class="victim-list-content">';
        l += '                               <div class="card p-0" >';
        l += '                                   <div class="row p-2">';
        l += '                                       <div class="col-lg-8 col-md-8 col-sm-8  align-items-center be-view-victim" attr-id = "' + val.victim_id + '">';
        l += '                                           <span class="victim-id">#' + val.victim_number + ' </span> ';
        l += '                                            <div class="nav-data_list " >';
        l += '                                               <div class="agency_details"  style="color:#343a40;"> ';
//        l += '                                                     <span style="color:  #356397; font-weight:600;">  ' + val.info.victim_info_first_name + ' ' + val.info.victim_info_middle_name + ' ' + val.info.victim_info_last_name + ' ' + val.info.victim_info_suffix + ' </span>';
        if (val.assumed_full_name) {
            l += '                                                     <span style="color:  #356397;">  Real name : </span> <span>  ' + val.real_full_name + ' </span>';
            l += '                                                     <br> <span style="color:  #973535;">  Assumed name : </span> <span>  ' + val.assumed_full_name + ' </span>';
        } else {
            l += '                                                     <span> ' + val.real_full_name + '</span>';
        }

//        l += '                                                    <br> <span> <span style="text-transform:capitalize">' + val.address_list.f_address + ', ' + val.address_list.brgy + ', ' + val.address_list.city + ', ' + val.address_list.province + ' </span>';
//        l += '                                                        <br> <span>' + val.contact_details.victim_contact_detail_content + '</span>';
        l += '                                                    <br> <span style="color:#495057;"> <span style="text-transform:capitalize">';
        l += val.address_list.f_address ? val.address_list.f_address + ", " : "";
        l += val.address_list.brgy ? val.address_list.brgy + ", " : "";
        l += val.address_list.city ? val.address_list.city + ", " : "";
        l += val.address_list.province ? val.address_list.province + " " : "";
        l += '                                                         </span>';
        l += '                                                </div>';
        l += '                                            </div>';
        l += '                                        </div>';
        l += '                                       <div class="col-lg-2 col-md-2 col-sm-2 txt-align_center d-flex align-items-center be-view-victim" attr-id = "' + val.victim_id + '"> <span class="badge badge-light"> ' + val.count_associated_case + ' Associated Case</span></div>';
        l += '                                       <div class="col-lg-2 col-md-2 col-sm-2 txt-align_center d-flex align-items-center justify-content-center">';
        l += '                                           <div class="btn-group ellipse-action " data-id="' + val.victim_id + '">';
        l += '                                                <a class="a-ellipse a-ellipse-' + val.victim_id + '  action_btn"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </a>';
        l += '                                                <div class="action-menu"  id="id-' + val.victim_id + '" > ';
        l += '                                                    <a class="dropdown-item disabled action-title" href="#">Select Action</a> ';
        l += '                                                     <a class="dropdown-item a-view_victim_details" attr-id="' + val.victim_id + '">View Victim Details</a>';
        l += '                                                    <a class="dropdown-item a-view_services" attr-id="' + val.victim_id + '"> Services provided</a> ';
        l += '                                                    <a class="dropdown-item a-view_cases" attr-id="' + val.victim_id + '" data-toggle="modal" data-target="#mdl-case-list"> Cases</a> ';
        l += '                                                    <a class="dropdown-item a-view_victim_profile lvl-ch" attr-id="' + val.victim_id + '"> Victim Profile</a> ';
        l += '                                               </div>';
        l += '                                            </div>';
        l += '                                      </div>';
        l += '                               </div>';
        l += '                           </div>';
        l += ' </li>';
    });
    $('.victim_list').html(l);
    grantLevel();
}

function getVictimList(page = 1) {

    var limit = 10;
    var keyword = $('#txt_search-victim').val();
    $.post(sAjaxVictims, {
        type: 'getVictimList',
        limit: limit,
        keyword: keyword,
        page: page
    }, function (rs) {
        if (parseInt(rs.data.content.count) > 0) {
            $('.filter_load_placeholder').hide();
            $('#victim_list').show();
            $('#victim_list-no-content').remove();
            buildVictimList(rs.data.content.list);
            if (parseInt(rs.data.content.count) <= parseInt(limit)) {
                limit = rs.data.content.count;
            }

            // pagination - library
            buildPagination({
                parent: 'rs-list',
                info: 'rs-info',
                pagination: 'rs-pagination',
                offset: 'rs-offset',
                data: {
                    page: page,
                    offset: limit,
                    count: rs.data.content.count
                }
            });

        } else {

            var sMessage = 'SORRY, WE COULDN\'T FIND ANY VICTIM DETAILS RELATED TO <span class = "font-italic" >"<span>' + keyword + '</span>"</span>.';
            if (!(keyword)) {
                sMessage = 'NO VICTIM DETAILS FOUND.';
            }
            var l = getNoDataFound({
                message: sMessage,
                footer: ''
            });
            $('#victim_list').hide();
            $('#victim_list-no-content').remove();
            $('#victim_list').after("<div id='victim_list-no-content'>" + l + "</div>");
        }


    }, 'json');
}

$('.victim_list').delegate('.ellipse-action', 'click', function (e) {

    var id = $(this).attr('data-id');
    if ($('#id-' + id).is(":visible")) {
        $('#id-' + id).hide();
        $('.a-ellipse').removeClass('ellipse-selected');
    } else {
        $('.action-menu').hide();
        $('.a-ellipse').removeClass('ellipse-selected');
        $('#id-' + id).show();
        $('.a-ellipse-' + id).addClass('ellipse-selected');
    }
});
$('.victim_list').delegate('.a-view_services', 'click', function (e) {
    var id = $(this).attr('attr-id');
    window.location.href = 'view_victim_services'
});
$(document).ready(function () {
    getLoadingList();
// load victim list 
    getVictimList();
    $('.datepicker').datepicker();
    $('.rs-pagination').delegate('.page-link', 'click', function () {
        var page = parseInt($(this).attr('data-page'));
        getVictimList(page);
    });
    $('#txt_search-victim').on('keypress', function (e) {
        if (e.which == 13) {
            getVictimList();
        }
    });
    $('#txt_search-victim').change(function () {
        setTimeout(function () {
            getVictimList();
        }, 1000);
    });
    $('#victim_list').delegate('.be-view-victim', 'click', function () {
        var id = $(this).attr('attr-id');
        $.post(sAjaxVictims, {
            type: 'getVitimInfoById',
            victim_id: id
        }, function (rs) {
            res = rs.data.res;
            // start first row 
            var l = '';
            var name_details = '<br> <span>' + res.real_full_name + '</span>';
            name_details += '<br> <span style="color:  #356397;">Date of birth </span>' + res.real_dob;
            l += '<span class="victim-id" >#' + res.victim_number + '</span> ';
            if (res.assumed_full_name) {
                name_details = '<br> <span style="color:  #356397;">Real name: </span> ' + res.real_full_name;
                name_details += '<br> <span style="color:  #356397;">Date of birth </span>' + res.real_dob;
                name_details += '<br> <span style="color:  #973535;">Assumed name: </span>' + res.assumed_full_name;
                name_details += '<br> <span style="color:  #973535;">Assumed of birth </span>' + res.assumed_dob;
            }
            l += name_details;
//            l += '<br> <span class="">35 years old</span>';
            $('#vd-first-row').html(l);
            // end of first row 

            // start second row 
            l = '';
//            l += '<span style="text-transform:capitalize">sample branch address  , Magallanes , Cavite </span>';
//            l += '<br> <span>(02) 523 8481</span>';
            l += '<br> <span style="color:  #356397;">Religion: </span>' + res.region_name;
            l += '<br> <span style="color:  #356397;">Civil status: </span>' + res.civil_status_name;
            l += '<br> <span style="color:  #356397;">Sex: </span>' + res.gender_name;
            $('#vd-second-row').html(l);
            // end of second row

            // start case list
            l = '';
            $.each(res.case_list, function (key, val) {
                l += '<li style="width:100%">';
                l += '    <div class="card" >';
                l += '        <div class="row">';
                l += '            <div class="col-lg-3 col-md-3 col-sm-3 align-items-center ">  <span style="text-transform:capitalize"> ' + val.case_number + '</span> </div>';
                l += '            <div class="col-lg-6 col-md-6 col-sm-6 align-items-center case_status_name text-center">  <span style="text-transform:capitalize"> ' + val.case_status_name + '</span> </div>';
//                l += '            <div class="col-lg-6 col-md-6 col-sm-6 txt-align_center d-flex align-items-center "> <span class="stat_"> Department of Labor and Employment </span></div>';
                l += '            <div class="col-lg-3 col-md-3 col-sm-3 t d-flex text-right justify-content-center">' + val.case_date_added + ' </div>';
                l += '        </div>';
                l += '    </div>';
                l += '</li>';
            });
            $('#vd-case_list').html(l);
            //end case list 
            $('#mdl-victim-details').modal('show');
        }, 'json');
    });
});
$('.victim_list').delegate('.a-view_cases', 'click', function () {
    var victim_id = $(this).attr('attr-id');
    $.post(sAjaxVictims, {
        type: 'getVictimCaseList',
        victim_id: victim_id,
        include_all: 0
    }, function (rs) {

        if (rs.data.flag > 0) {
            var victim_real_name = rs.data.content.info.victim_info_last_name + ', ' + rs.data.content.info.victim_info_first_name + ' ' + rs.data.content.info.victim_info_middle_name;
            $('.vic-number').html(rs.data.content.info.victim_number);
            $('.vic-assumed-name').html('');
            if (rs.data.content.info.victim_info_is_assumed == 0) {
                $('.vic-real-name').html(victim_real_name);
                if (rs.data.content.assumed) {
                    var victim_assumed_name = rs.data.content.assumed.victim_info_last_name + ', ' + rs.data.content.assumed.victim_info_first_name + ' ' + rs.data.content.assumed.victim_info_middle_name;
                    $('.vic-assumed-name').html(victim_assumed_name);
                }
            } else {
                $('.vic-real-name').html(victim_real_name);
            }


//            if (rs.data.content.assumed) {
//                var victim_assumed_name = rs.data.content.assumed.victim_info_last_name + ', ' + rs.data.content.assumed.victim_info_first_name + ' ' + rs.data.content.assumed.victim_info_middle_name;
//                $('.vic-assumed-name').html(victim_assumed_name);
//            }

            if (rs.data.content.address) {
                var address = rs.data.content.address.f_address + ', ' + rs.data.content.address.brgy + ', ' + rs.data.content.address.city + ', ' + rs.data.content.address.province;
                $('.vic-address').html(address);
            }
        }

        var l = '';
        $('.case_list_content').html(l);
        if (rs.data.cases.length > 0) {
            l += '<ul class="list_content">';
            $.each(rs.data.cases, function (key, val) {
                l += '        <li>';
                l += '            <div class="card">';
                l += '                <div class="col-lg-12 col-md-12 align-items-center">';
                l += '                    <p class="desc_name" style="color: #e88f15;">Case Number: ' + val.case_number + '</p>';
                l += '                    <p style="color: #356397;">Agency: ' + val.agency_name + ' </p>';
                l += '                    <p style="text-transform:capitalize">Employer: ' + val.employer_name + '</p>';
                if (val.case_offender_name == '') {
                    l += '                    <p>Offender Name: N/A</p>';
                } else {
                    l += '                    <p>Offender Name: ' + val.case_offender_name + '</p>';
                }
                if (val.case_victim_deployment_date == '') {
                    l += '                    <p>Deployment Date: N/A</p>';
                } else {
                    l += '                    <p>Deployment Date: ' + val.case_victim_deployment_date + '</p>';
                }
                if (val.country == '') {
                    l += '                    <p>Country: N/A</p>'
                } else {
                    l += '                    <p>Country: ' + val.country + '</p>'
                }

//                if (val.passport) {
//                    $.each(val.passport, function (key, val) {
//                        console.log(val);
//                    });
//                }
                l += '                </div>';
                l += '            </div>';
                l += '        </li>';
            });
            l += '    </ul>';
        } else {
            console.log('No Record');
        }

        $('.case_list_content').html(l);
    }, 'json');
});
$('.victim_list').delegate('.a-view_victim_profile', 'click', function () {

    icmsMessage({
        type: 'msgPreloader',
        visible: true,
        body: 'Please wait while loading.'
    });

    var victim_id = $(this).attr('attr-id');
    $.post(sAjaxVictims, {
        type: 'getVictimCaseList',
        victim_id: victim_id,
        include_all: 1
    }, function (rs) {

        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });

        if (rs.data.flag > 0) {
            $('#mdl-victim_info').attr('data-vctm-id', victim_id);
            var victim_real_name = rs.data.content.info.victim_info_last_name + ', ' + rs.data.content.info.victim_info_first_name + ' ' + rs.data.content.info.victim_info_middle_name;
            $('.vict-info-number').html(rs.data.content.info.victim_number);
            $('.vict-info-assumed-name').html('');
            if (rs.data.content.info.victim_info_is_assumed == 0) {
                $('.vict-info-real-name').html(victim_real_name);
                if (rs.data.content.assumed.victim_info_first_name) {
                    var victim_assumed_name = rs.data.content.assumed.victim_info_last_name + ', ' + rs.data.content.assumed.victim_info_first_name + ' ' + rs.data.content.assumed.victim_info_middle_name;
                    $('.vict-info-assumed-name').html(victim_assumed_name);
                }
            } else {
                $('.vict-info-real-name').html(victim_real_name);
            }


            if (rs.data.content.address) {
                var radd = rs.data.content.address;
                var l = radd.f_address ? radd.f_address + ", " : "";
                l += radd.brgy ? radd.brgy + ", " : "";
                l += radd.city ? radd.city + ", " : "";
                l += radd.province ? radd.province + " " : "";
                $('.vict-info-address').html(l);
            }

            $.each(rs.data.victim_details, function (key, val) {
                $('.vict-' + key).html(val);
            });
            // address section
            var addr = '';
            $('.vict-address-section').html(addr);
            if (rs.data.content.victim_address_list.length > 0) {
                addr += '<ul class="list-group list-group-flush">';
                $.each(rs.data.content.victim_address_list, function (key, val) {
                    var address = val.victim_address_list_address + ', ' + val.brgy + ', ' + val.city + ', ' + val.province;
                    addr += '   <li class="list-group-item list-group-item-action">';
                    addr += '   <div class="row">';
                    addr += '   <div class="col-md-10">';
                    addr += '   <h7>' + address + '</h7>';
                    addr += '   <div>' + val.region + '</div>';
                    addr += '   <div>' + val.country + '</div>';
                    addr += '   </div>';
                    addr += '   <div class="col-md-2 li-edit-btn">';
                    addr += '   <a class="edit-btn" data-vctm_address_id="' + val.victim_address_list_id + '">EDIT</a>';
                    addr += '   <a class="del-btn" data-vctm_address_id="' + val.victim_address_list_id + '">DELETE</a>';
                    addr += '   </div>';
                    addr += '   </div';
                    addr += '   </li>';
                });
                addr += '</ul>';
            } else {
                addr += 'No Record';
            }

            $('.vict-address-section').html(addr);
            // contact details section
            var contact = '';
            $('.vict-contact-section').html(contact);
            if (rs.data.content.contact_details.length > 0) {
                contact += '<ul class="list-group list-group-flush">';
                $.each(rs.data.content.contact_details, function (key, val) {
                    contact += '   <li class="list-group-item list-group-item-action">';
                    contact += '   <div class="row">';
                    contact += '   <div class="col-md-10">';
                    contact += '   <div class="row">';
                    contact += '   <label class="col-sm-3">' + val.contact_type + ': </label>';
                    contact += '   <div class="col-sm-9">';
                    contact += '       <p>' + val.victim_contact_detail_content + '</p>';
                    contact += '   </div>';
                    contact += '   </div>';
                    contact += '   </div>';
                    contact += '   <div class="col-md-2 li-edit-btn">';
                    contact += '      <a class="edit-btn" data-id="' + val.victim_contact_details_id + '">EDIT</a>';
                    contact += '      <a class="del-btn" data-id="' + val.victim_contact_details_id + '">DELETE</a>';
                    contact += '   </div>';
                    contact += '   </div>';
                    contact += '   </li>';
                });
                contact += '</ul>';
            } else {
                contact += 'No Record';
            }

            $('.vict-contact-section').html(contact);
            // education details section
            var education = '';
            $('.vict-education-section').html(contact);
            if (rs.data.content.victim_education_info.length > 0) {
                education += '<ul class="list-group list-group-flush">';
                $.each(rs.data.content.victim_education_info, function (key, val) {
                    education += '   <li class="list-group-item list-group-item-action">';
                    education += '   <div class="row">';
                    education += '   <div class="col-md-10">';
                    education += '      <div class="row">';
                    education += '          <label class="col-sm-3">Name of School: </label>';
                    education += '          <div class="col-sm-9">';
                    education += '               <p>' + val.victim_education_school + '</p>';
                    education += '          </div>';
                    education += '      </div>';
                    education += '      <div class="row">';
                    education += '          <label class="col-sm-3">Level: </label>';
                    education += '          <div class="col-sm-9">';
                    education += '               <p>' + val.education_type_name + '</p>';
                    education += '          </div>';
                    education += '      </div>';
                    if (val.victim_education_course != '') {
                        education += '      <div class="row">';
                        education += '          <label class="col-sm-3">Course: </label>';
                        education += '          <div class="col-sm-9">';
                        education += '               <p>' + val.victim_education_course + '</p>';
                        education += '          </div>';
                        education += '      </div>';
                    }

                    education += '      <div class="row">';
                    education += '          <label class="col-sm-3">Year: </label>';
                    education += '          <div class="col-sm-9">';
                    education += '               <p>' + val.victim_education_start + ' - ' + val.victim_education_end + '</p>';
                    education += '          </div>';
                    education += '      </div>';
                    education += '      </div>';
                    education += '   <div class="col-md-2 li-edit-btn">';
                    education += '      <a class="edit-btn" data-id="' + val.victim_education_id + '">EDIT</a>';
                    education += '      <a class="del-btn" data-id="' + val.victim_education_id + '">DELETE</a>';
                    education += '   </div>';
                    education += '   </div>';
                    education += '   </li>';
                });
                education += '</ul>';
            } else {
                education += 'No Record';
            }

            $('.vict-education-section').html(education);
            // relatives section
            var relatives = '';
            $('.vict-relatives-section').html(relatives);
            if (rs.data.content.victim_relatives_info.length > 0) {
                relatives += '<ul class="list-group list-group-flush">';
                $.each(rs.data.content.victim_relatives_info, function (key, val) {
                    var address = val.victim_relative_address + ' ' + val.brgy + ', ' + val.city + ', ' + val.province;
                    relatives += '   <li class="list-group-item list-group-item-action">';
                    relatives += '   <div class="row">';
                    relatives += '   <div class="col-md-10">';
                    relatives += '   <h7>' + val.victim_relative_fullname + '</h7>';
                    if (val.victim_relative_type == '5') {
                        var description = ' (' + val.victim_relative_type_other + ')';
                    }
                    relatives += '   <div>' + val.victim_relative_type_name + description + '</div>';

                    relatives += '   <div>' + val.victim_relative_primary_contact_number + ', ' + val.victim_relative_second_contact_number + '</div>';
//                    relatives += '   <div>' + address + '</div>';
//                    relatives += '   <div>' + val.region + '</div>';
                    relatives += '   <div>' + val.victim_relative_email + '</div>';
                    relatives += '   </div>';
                    relatives += '   <div class="col-md-2 li-edit-btn">';
                    relatives += '      <a class="edit-btn" data-id="' + val.victim_relative_id + '">EDIT</a>';
                    relatives += '      <a class="del-btn" data-id="' + val.victim_relative_id + '">DELETE</a>';
                    relatives += '   </div>';
                    relatives += '   </div>';
                    relatives += '   </li>';
                });
                relatives += '</ul>';
            } else {
                relatives += 'No Record';
            }

            $('.vict-relatives-section').html(relatives);
            // cases section
            var cases = '';
            $('.vict-cases-section').html(cases);
            if (rs.data.cases.length > 0) {
                cases += '<ul class="list-group list-group-flush">';
                $.each(rs.data.cases, function (key, val) {
//                    console.log(val);
                    cases += '   <li class="list-group-item list-group-item-action">';
                    cases += '   <div class="row">';
                    cases += '   <div class="col-md-10">';
                    cases += '   <h7>' + val.case_number + '</h7>';
                    cases += '   <div>' + val.agency_name + '</div>';
                    cases += '   <div>' + val.employer_name + '</div>';
                    cases += '   <div>' + val.case_offender_name + '</div>';
                    cases += '   <div>' + val.case_victim_deployment_date + '</div>';
                    cases += '   <div>' + val.country + '</div>';
                    cases += '      </div>';
                    cases += '   <div class="col-md-2 li-edit-btn">';
                    cases += '   <a>EDIT</a>';
                    cases += '   </div>';
                    cases += '   </div>';
                    cases += '   </li>';
                });
                cases += '</ul>';
            } else {
                cases += 'No Record';
            }

            $('.vict-cases-section').html(cases);
        }

        $("#mdl-victim_info").modal('show');

    }, 'json');

});
$('.btn-edit-vctm-info').click(function () {
    getProvinces();
    getSex();
    getCivilStatus();
    getReligions();
    $(document).one("ajaxStop", function () {
        var victim_id = $('#mdl-victim_info').attr('data-vctm-id');
        $.post(sAjaxVictims, {
            type: 'getVictimInfoByID',
            victim_id: victim_id,
        }, function (rs) {
            console.log(rs);
            if (rs.data.flag > 0) {
                if (rs.data.resp) {
                    $.each(rs.data.resp, function (key, val) {
                        $('.u-vctm-info-' + key).val(val);
                    });
                    if (rs.data.resp.real) {
                        $.each(rs.data.resp.real, function (key, val) {
                            $('.u-vctm-real-info-' + key).val(val);
                        });
                    }

                    if (rs.data.resp.assumed) {
                        $.each(rs.data.resp.assumed, function (key, val) {
                            $('.u-vctm-assumed-info-' + key).val(val);
                        });
                    }
                }
            }

        }, 'json');
    });
});

$('.vict-address-section').delegate('.li-edit-btn .edit-btn', 'click', function (e) {
    getRegions();
    getProvinces();
    getCities();
    getBarangay();
    var addr_id = $(this).attr('data-vctm_address_id');
    var victim_id = $('#mdl-victim_info').attr('data-vctm-id');
    // data type 1 is for edit
    $('#victim-addr-form').attr('data-type', '1');
    $('#victim-addr-form').attr('data-id', addr_id);
    $(document).one("ajaxStop", function () {
        $.post(sAjaxVictims, {
            type: 'getVictimAddressByID',
            victim_id: victim_id,
            victim_address_list_id: addr_id
        }, function (rs) {

            if (rs.data.flag > 0) {
                if (rs.data.resp) {
                    console.log(rs.data.resp);
                    $.each(rs.data.resp, function (key, val) {
                        $('.vctm-addr-' + key).val(val);
                    });
                }
            }

        }, 'json');
    });
});

$('.vict-contact-section').delegate('.li-edit-btn .edit-btn', 'click', function (e) {
    getContactTypes();
    var contact_id = $(this).attr('data-id');
    var victim_id = $('#mdl-victim_info').attr('data-vctm-id');
    // data type 1 is for edit
    $('#victim-contact-form').attr('data-type', '1');
    $('#victim-contact-form').attr('data-id', contact_id);
    $(document).one("ajaxStop", function () {
        $.post(sAjaxVictims, {
            type: 'getVictimContactInfoById',
            victim_id: victim_id,
            victim_contact_details_id: contact_id
        }, function (rs) {


            if (rs.data.flag > 0) {
                if (rs.data.victim_contact_info) {
                    console.log(rs.data.victim_contact_info);
                    $.each(rs.data.victim_contact_info, function (key, val) {
                        $('.vctm-contact-' + key).val(val);
                    });
                }
            }
        }, 'json');
    });
});

$('.vict-education-section').delegate('.li-edit-btn .edit-btn', 'click', function (e) {
    getEducationalAttainments();
    var educ_id = $(this).attr('data-id');
    var victim_id = $('#mdl-victim_info').attr('data-vctm-id');
    // data type 1 is for edit
    $('#victim-educ-form').attr('data-type', '1');
    $('#victim-educ-form').attr('data-id', educ_id);

    $(document).one("ajaxStop", function () {
        $.post(sAjaxVictims, {
            type: 'getVictimEducationInfoById',
            victim_id: victim_id,
            victim_education_id: educ_id
        }, function (rs) {

            if (rs.data.flag > 0) {
                if (rs.data.victim_education_info) {
                    console.log(rs.data.victim_education_info);
                    $.each(rs.data.victim_education_info, function (key, val) {
                        $('.vctm-educ-' + key).val(val);
                    });
                }
            }
        }, 'json');
    });
});

$('.vict-relatives-section').delegate('.li-edit-btn .edit-btn', 'click', function (e) {
    getFamilyRelations();
    var victim_relative_id = $(this).attr('data-id');
    var victim_id = $('#mdl-victim_info').attr('data-vctm-id');
    // data type 1 is for edit
    $('#victim-relative-form').attr('data-type', '1');
    $('#victim-relative-form').attr('data-id', victim_relative_id);
    $(document).one("ajaxStop", function () {
        $.post(sAjaxVictims, {
            type: 'getVictimRelativeInfoById',
            victim_id: victim_id,
            victim_relative_id: victim_relative_id
        }, function (rs) {

            if (rs.data.flag > 0) {
                if (rs.data.victim_relative_info) {
                    console.log(rs.data.victim_relative_info);

                    if (rs.data.victim_relative_info.victim_relative_type == '5') {
                        $('.rel-other-txtbox').removeAttr('hidden');
                    } else {
                        $('.rel-other-txtbox').attr('hidden', true);
                    }

                    $.each(rs.data.victim_relative_info, function (key, val) {
                        $('.vctm-rel-' + key).val(val);
                    });
                }
            }
        }, 'json');
    });
});

$('.vctm-addr-victim_address_list_region_id').change(function () {
    getProvincesByRegionId(this.value);
    $('.vctm-addr-victim_address_list_province_id').attr('disabled', false);
});

$('.vctm-addr-victim_address_list_province_id').change(function () {
    getCityByProvinceId(this.value);
    $('.vctm-addr-victim_address_list_city_id').attr('disabled', false);
});

$('.vctm-addr-victim_address_list_city_id').change(function () {
    getBrgyByCityID(this.value);
    $('.vctm-addr-victim_address_list_brgy_id').attr('disabled', false);
});

$("#victim-info-form").validate({
    rules: {
        victim_info_first_name: {required: true},
        victim_info_last_name: {required: true}
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
        // update function for victim info

    }
});

$("#victim-addr-form").validate({
    rules: {
        region: {required: true},
        province: {required: true},
        city: {required: true},
        address: {required: true}
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
        // update function for victim address
        addOrUpdateVictimAddressInfoById();
    }
});

$("#victim-contact-form").validate({
    rules: {
        contact_type: {required: true},
        contact_content: {required: true}
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
        // update function for victim contact
        addOrUpdateVictimContactInfoById();
    }
});

$("#victim-educ-form").validate({
    rules: {
        education_type: {required: true},
        education_school: {required: true}
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
        // update function for victim education
        addOrUpdateVictimEducationInfoById();
    }
});

$("#victim-relative-form").validate({
    rules: {
        relative_type: {required: true},
        relative_name: {required: true},
        email: {email: true},
        primary_contact: {maxlength: 13, minlength: 7},
        secondary_contact: {maxlength: 13, minlength: 7}
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
        // update function for victim relatives
        addOrUpdateVictimRelativeInfoById();

    }
});

$('.btn-add-vctm-addr').click(function () {
    getRegions();
    getProvinces();
    getCities();
    getBarangay();
//    var addr_id = $(this).attr('data-vctm_address_id');
    // data type 1 is for edit
    $('#victim-addr-form').attr('data-type', '0');
//    $('#victim-addr-form').attr('data-id', addr_id);

});

function addOrUpdateVictimAddressInfoById() {
    var victim_id = $('#mdl-victim_info').attr('data-vctm-id');
    // if request type 1 = edit 0 = add
    var request_type = $('#victim-addr-form').attr('data-type');
    var victim_address_list_id = $('#victim-addr-form').attr('data-id');
    var type = '';
    if (request_type == '1') {
        type = "updateVictimAddrById";
    } else {
        type = "addVictimAddrById";
    }

    $.post(sAjaxVictims, {
        type: type,
        victim_id: victim_id,
        victim_address_list_id: victim_address_list_id,
        victim_address_list_region_id: $('.vctm-addr-victim_address_list_region_id').val(),
        victim_address_list_province_id: $('.vctm-addr-victim_address_list_province_id').val(),
        victim_address_list_city_id: $('.vctm-addr-victim_address_list_city_id').val(),
        victim_address_list_brgy_id: $('.vctm-addr-victim_address_list_brgy_id').val(),
        victim_address_list_address: $('.vctm-addr-victim_address_list_address').val()
    }, function (rs) {
        console.log(rs);
    }, 'json');
}

$('.btn-add-vctm-contact').click(function () {
    getContactTypes();
//    var contact_id = $(this).attr('data-vctm_address_id');
    // data type 1 is for edit
    $('#victim-contact-form').attr('data-type', '0');
//    $('#victim-contact-form').attr('data-id', contact_id);

});

function addOrUpdateVictimContactInfoById() {
    var victim_id = $('#mdl-victim_info').attr('data-vctm-id');
    // if request type 1 = edit 0 = add
    var request_type = $('#victim-contact-form').attr('data-type');
    var victim_contact_details_id = $('#victim-contact-form').attr('data-id');
    var type = '';
    if (request_type == '1') {
        type = "updateVictimContactById";
    } else {
        type = "addVictimContactById";
    }

    $.post(sAjaxVictims, {
        type: type,
        victim_id: victim_id,
        victim_contact_details_id: victim_contact_details_id,
        victim_contact_detail_type: $('.vctm-contact-victim_contact_detail_type').val(),
        victim_contact_detail_content: $('.vctm-contact-victim_contact_detail_content').val()

    }, function (rs) {
        console.log(rs);
    }, 'json');
}

$('.btn-add-vctm-education').click(function () {
    getEducationalAttainments();
//    var education_id = $(this).attr('data-vctm_address_id');
    // data type 1 is for edit
    $('#victim-educ-form').attr('data-type', '0');
//    $('#victim-educ-form').attr('data-id', education_id);

});

function addOrUpdateVictimEducationInfoById() {
    var victim_id = $('#mdl-victim_info').attr('data-vctm-id');
    // if request type 1 = edit 0 = add
    var request_type = $('#victim-educ-form').attr('data-type');
    var victim_education_id = $('#victim-educ-form').attr('data-id');
    var type = '';
    if (request_type == '1') {
        type = "updateVictimEducationById";
    } else {
        type = "addVictimEducationById";
    }

    $.post(sAjaxVictims, {
        type: type,
        victim_id: victim_id,
        victim_education_id: victim_education_id,
        victim_education_type: $('.vctm-educ-victim_education_type').val(),
        victim_education_grade_year: $('.vctm-educ-victim_education_grade_year').val(),
        victim_education_school: $('.vctm-educ-victim_education_school').val(),
        victim_education_course: $('.vctm-educ-victim_education_course').val(),
        victim_education_start: $('.vctm-educ-victim_education_start').val(),
        victim_education_end: $('.vctm-educ-victim_education_end').val()

    }, function (rs) {
        console.log(rs);

    }, 'json');
}

$('.btn-add-vctm-relative').click(function () {
    getFamilyRelations();

    // data type 1 is for edit
    $('#victim-relative-form').attr('data-type', '0');

});

function addOrUpdateVictimRelativeInfoById() {
    var victim_id = $('#mdl-victim_info').attr('data-vctm-id');
    // if request type 1 = edit 0 = add
    var request_type = $('#victim-relative-form').attr('data-type');
    var victim_relative_id = $('#victim-relative-form').attr('data-id');
    var type = '';
    if (request_type == '1') {
        type = "updateVictimRelativeById";
    } else {
        type = "addVictimRelativeById";
    }

    $.post(sAjaxVictims, {
        type: type,
        victim_id: victim_id,
        victim_relative_id: victim_relative_id,
        victim_relative_fullname: $('.vctm-rel-victim_relative_fullname').val(),
        victim_relative_type_other: $('.victim_relative_type_other').val(),
        victim_relative_type: $('.vctm-rel-victim_relative_type').val(),
        victim_relative_primary_contact_number: $('.vctm-rel-victim_relative_primary_contact_number').val(),
        victim_relative_second_contact_number: $('.vctm-rel-victim_relative_second_contact_number').val(),
        victim_relative_type_other: $('.vctm-rel-victim_relative_type_other').val(),
        victim_relative_email: $('.vctm-rel-victim_relative_email').val()

    }, function (rs) {
        console.log(rs);

    }, 'json');
}

$('.vctm-rel-victim_relative_type').change(function () {
    console.log($(this).val());
    $('.vctm-rel-victim_relative_type_other').val('');

    var id = $(this).val();
    if (id == 5) {
        $('.rel-other-txtbox').removeAttr('hidden');
    } else {
        $('.rel-other-txtbox').attr('hidden', true);
    }
});

function updateVictimDetailsById() {
    var victim_id = $('#mdl-victim_info').attr('data-vctm-id');
    // if request type 1 = edit 0 = add
//    var request_type = $('#victim-relative-form').attr('data-type');
//    var victim_relative_id = $('#victim-relative-form').attr('data-id');
    var type = 'updateVictimDetailsById';


    $.post(sAjaxVictims, {
        type: type,
        victim_id: victim_id,
        victim_info_first_name: $('.vctm-rel-victim_info_first_name').val(),
        victim_info_last_name: $('.victim_info_last_name').val(),
        victim_info_middle_name: $('.vctm-rel-victim_info_middle_name').val(),
        victim_info_suffix: $('.vctm-rel-victim_info_suffix').val(),
        victim_info_dob: $('.vctm-rel-victim_info_dob').val(),
        victim_info_city_pob: $('.vctm-rel-victim_info_city_pob').val(),
        victim_gender: $('.vctm-rel-victim_gender').val(),
        victim_civil_status: $('.vctm-rel-victim_gender').val(),
        victim_religion: $('.vctm-rel-victim_gender').val(),
        assumed_victim_info_first_name: $('.vctm-rel-victim_gender').val(),
        assumed_victim_info_last_name: $('.vctm-rel-victim_gender').val(),
        assumed_victim_info_middle_name: $('.vctm-rel-victim_gender').val(),
        assumed_victim_info_dob: $('.vctm-rel-victim_gender').val(),

    }, function (rs) {
        console.log(rs);

    }, 'json');
}

$('.vict-address-section').delegate('.li-edit-btn .del-btn', 'click', function (e) {
    var addr_id = $(this).attr('data-vctm_address_id');

//    $(document).one("ajaxStop", function () {
    $.post(sAjaxVictims, {
        type: 'deleteVictimAddressInfoById',
        victim_address_list_id: addr_id
    }, function (rs) {

        if (rs.data.flag > 0) {
            if (rs.data.victim_address_info) {
                console.log(rs.data.victim_address_info);

            }
        }
    }, 'json');
//    });
});

$('.vict-contact-section').delegate('.li-edit-btn .del-btn', 'click', function (e) {
    var contact_id = $(this).attr('data-id');

//    $(document).one("ajaxStop", function () {
    $.post(sAjaxVictims, {
        type: 'deleteVictimContactInfoById',
        victim_contact_details_id: contact_id
    }, function (rs) {

        if (rs.data.flag > 0) {
            if (rs.data.victim_contact_info) {
                console.log(rs.data.victim_contact_info);

            }
        }
    }, 'json');
//    });
});


$('.vict-education-section').delegate('.li-edit-btn .del-btn', 'click', function (e) {
    var educ_id = $(this).attr('data-id');

//    $(document).one("ajaxStop", function () {
    $.post(sAjaxVictims, {
        type: 'deleteVictimEducationInfoById',
        victim_education_id: educ_id
    }, function (rs) {

        if (rs.data.flag > 0) {
            if (rs.data.victim_education_info) {
                console.log(rs.data.victim_education_info);

            }
        }
    }, 'json');
//    });
});

$('.vict-relatives-section').delegate('.li-edit-btn .del-btn', 'click', function (e) {
    var rel_id = $(this).attr('data-id');

//    $(document).one("ajaxStop", function () {
    $.post(sAjaxVictims, {
        type: 'deleteVictimRelativeInfoById',
        victim_relative_id: rel_id
    }, function (rs) {

        if (rs.data.flag > 0) {
            if (rs.data.victim_relative_info) {
                console.log(rs.data.victim_relative_info);

            }
        }
    }, 'json');
//    });
});