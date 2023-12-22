function getMyUsers(page) {
    $("input[type=submit]").attr("disabled", "disabled");
    var page = $('#user_list-my_users').attr('datapage');
    localStorage.clear();
    var keyword = $('#txt_search_my_user').val();
    var filter = $('#searchby').val();
    var aStatus = [];
    var aUserRole = [];
    var orderby = [];
    var aStatus = [];
    var aUserRole = [];

    $.each($("input[name='mystatus']:checked"), function () {
        aStatus.push($(this).val());
    });
    $.each($("input[name='myUserRole']:checked"), function () {
        aUserRole.push($(this).val());
    });
    $.each($("input[name='myorderBy']:checked"), function () {
        orderby.push($(this).val());
    });
    orderby = orderby.join();

    aStatus = aStatus.join();
    aUserRole = aUserRole.join();

    var limit = 10;
    $.post(sAjaxAdminUsers, {
        type: "getMyUsers",
        limit: limit,
        page: page,
        orderby: orderby,
        keyword: keyword,
        aUserRole: aUserRole,
        aStatus: aStatus,
        filter: filter,
        aUserRole: aUserRole
    }, function (rs) {
        getLoadingList();
        if (parseInt(rs.data.count) > 0) {
            $('#user_list').show();
            $('#user_list-no-content').remove();

            var l = buildUsersList(rs.data.list, "my");
            $('.filter_load_placeholder').hide();
            $('#div-my-user-list').html(l + "<br><br>");

            // prevent scroll up during 
            $("a[href='#']").click(function (e) {
                e.preventDefault();
            });

            if (parseInt(rs.data.count) <= parseInt(limit)) {
                limit = rs.data.count;
            }

            // pagination - library
            buildPagination({
                parent: 'my-rs-list',
                info: 'my-rs-info',
                pagination: 'my-rs-pagination',
                offset: 'rs-offset',
                data: {
                    page: page,
                    offset: limit,
                    count: rs.data.count
                }
            });
        } else {
            $('.filter_load_placeholder').hide();
            var sFooter = '';
            var sMessage = 'SORRY, WE COULDN\'T FIND ANY USERS RELATED TO <span class = "font-italic" >"<span>' + keyword + '</span>"</span>.';

            if (!(keyword)) {
                sMessage = 'NO USER FOUND.';
            }
            var l = getNoDataFound({
                message: sMessage,
                footer: sFooter
            });

            $('#myuser_list').hide();
            $('#user_list-no-content').remove();
            $('#div-my-user-list').html("<div class='container' id='user_list-no-content'>" + l + "</div>");
        }


    }, 'json');
}
function buildUsersList(rs, fr) {
    var tbl = "";
    var forId = "id";
    if (fr == "my") {
        forId = "myid";
    }
    $.each(rs, function (key, val) {
        var stat = '<span class="badge_cc" data-id="' + val.user_id + '" data-stat="' + val.user_is_active + '"></span><span class="stat_">Active</span>';

        var show_change_stat = '1';
        if (val.user_is_active == '0') {
            // Uncomment this after 
            stat = '<span class="stat-change stat_inactive" style="cursor:pointer" data-id="' + val.user_id + '" data-stat="' + val.user_is_active + '">Inactive</span>';
            // Unverified
//            stat = '<span class="stat-change stat_inactive" style="cursor:pointer" data-id="' + val.user_id + '" data-stat="' + val.user_is_active + '">Unverified</span>';
        }
        if (val.agency_branch_is_active == '0') {
            stat = '<span class="stat_inactive">Inactive Agency Branch</span>';
            show_change_stat = '0';
        }
        if (val.agency_is_active == '0') {
            stat = '<span class="stat_inactive_agency">Inactive Agency</span>';
            show_change_stat = '0';
        }

        tbl += '  <li style="width:100%">';
        tbl += '      <div class="card">';
        tbl += '           <div class="row d-flex">';
        tbl += '                <div class="col-lg-8 col-md-8 col-sm-8  align-items-center ">';
        tbl += '                      <div class="row nav-data_list">';
        tbl += '                            <div class="col-lg-2 col-md-3 col-sm-4 data_list_img">';
        tbl += '                                 <div class="img_content"> ';
        tbl += '                                      <img src="' + sDriveViewer + val.photo + '" onerror="ifBrokenProfile(this);" >  ';
        tbl += '                                  </div>';
        tbl += '                            </div>';
        tbl += '                            <div class="col-lg-10 col-md-9 col-sm-8 test2 desc_content">';
        tbl += '                                 <div class="agency_details"> <span class="content-title ">' + val.user_firstname + ' ' + val.user_middlename + ' ' + val.user_lastname + ' </span>';
        tbl += '                                 <span style="color: #6c757d"> | ' + val.user_level_description + '   </span> <br> ';
        tbl += '                                 <span style="color: #333c48;">  ' + val.agency_abbr;
        if (val.agency_branch_is_main == "1") {
            tbl += '<span> (' + val.agency_branch_name + ' - Main)</span>';
        } else {
            tbl += val.agency_branch_name + ' Branch';
        }
        tbl += '                                 </span>  <br> ';
        tbl += '                                 <small style="color: #6c757d !important;"> <span >' + val.user_email + ' </span></small>   <br>';
        tbl += '                                 <small style="color: #6c757d !important;">' + val.user_mobile_number + ' | ' + val.user_phone_number + '</small>';

        tbl += '                             </div>';
        tbl += '                      </div>';
        tbl += '                  </div>';

        tbl += '                </div>';
        tbl += '               <div class="col-lg-2 col-md-2 col-sm-2 txt-align_center d-flex align-items-center justify-content-center">';
        tbl += stat;
        tbl += '               </div>';
        tbl += '               <div class="col-lg-2 col-md-2 col-sm-2 txt-align_center d-flex align-items-center justify-content-center">';
        tbl += '                    <div class="btn-group ellipse-action " data-id="' + val.user_id + '">';
        tbl += '                         <a class="a-ellipse a-ellipse-' + val.user_id + ' "  style="color: #8fafd1;">  <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </a>';
        tbl += '                            <div class="action-menu" data-level ="' + val.user_level_id + '" id="' + forId + '-' + val.user_id + '" agn-type="' + val.govt_agency_type_name + '"  agn-brn="' + val.govt_agency_branch_name + '">';
        tbl += '                                 <a class="dropdown-item disabled action-title" href="#">Select Action</a>';
        tbl += '                                 <a class="dropdown-item a-manage-user" data-id="' + val.user_id + '" href="#">Manage User</a>';
        tbl += '                                 <a class="dropdown-item a-manage-details"  data-id="' + val.user_id + '" href="#">View Cases</a>';
        tbl += '                                 <a class="dropdown-item a-manage-password"  data-id="' + val.user_id + '" href="#">Reset Password</a>';
        tbl += '                             </div>';
        tbl += '                    </div>';
        tbl += '               </div>';
        tbl += '      </div>';
        tbl += '    </li>';
    });

    return tbl;
}

function getUserLevel() {
    $.post(sAjaxAgencies, {
        type: "getUserLevelWithCondition",
        agencyid: "1",
    }, function (rs) {
        l = "<option  selected disabled>Select level</option>";
        $.each(rs.data, function (key, val) {
            l += "<option value='" + val.transaction_parameter_count_id + "'>" + val.transaction_parameter_name + " </option>";
        });
        $("#sel_userlevel").html(l);
    }, 'json');
}

function buildCasesList(aListing) {
    var l = '';
    $.each(aListing, function (key, val) {
        l += '<li class="case-content w-100 ">';
        l += '    <div class="card">';
        l += '        <div class="row cases">'
        l += '            <div class="col-12" attr-id="' + val.case_id + '">';

        l += '                <ul class="list-group list-group-horizontal nav-case_details list_content  ul-report-list" data-cid="' + val.case_id + '">';
        l += '                    <li class="list-group-item w-100 text-left">';
        l += '                        <span class="tags ' + getPriorityTag(val.case_priority_level_id) + '"></span> <a target="_blank" href="update_case/' + val.case_id + '"><span class="case-id">' + val.case_number + '</span> </a>';
        l += '                        <br>';
        l += '                        <span style="color: #343a40;">Victim Name : &nbsp; </span><span class="">' + val.victim_name + '</span>';
        l += '                        <br>';
        l += '                        <span style="color: #343a40;">Created by : &nbsp;</span><span class="">' + val.filed_by + ' | ' + val.filed_by_agency + '</span>';
        l += '                        <br>';
        l += '                        <span style="color: #343a40;">Date created : &nbsp; </span><span class="">' + val.case_date_added + '</span>';
        l += '                    </li>';

        l += '                </ul>';
        l += '            </div>';

        l += '        </div>';
        l += '    </div>';
        l += '</li>';
    });

    return l;

}

function getAllCaseLists(x) {

    $('#tab-content-4').hide();
    $('#tab-content-4').prev().show();
    $('#tab-no-content-' + x.tab).remove();

    var sFilter = '';
    var limit = 10;
    $.post(sAjaxCase, {
        type: "getAllCaseLists",
        limit: limit,
        page: x.page,
        tab: x.tab,
        keyword: '',
        filter: sFilter,
        user_id: x.user_id
    }, function (rs) {

        $('#tab-content-4').show();
        $('#tab-content-4').prev().hide();

        if (rs.data.flag == 1) {
            $('#tab-content-' + x.tab).show();
            $('#tab-no-content-' + x.tab).hide();

            $('#list-tagged').html(buildCasesList(rs.data.content.listing));
            $('.filter_load_placeholder').hide();
            grantLevel();
            // pagination
            buildPagination({
                parent: 'rs-list-tagged_user',
                info: 'rs-info-tagged_user',
                pagination: 'rs-pagination-tagged_user',
                offset: 'rs-offset',
                data: {
                    page: x.page,
                    offset: limit,
                    count: rs.data.content.count
                }
            });
        } else {

            sMessage = 'NO CASES AVAILABLE YET.';
            var l = getNoDataFound({
                message: sMessage,
                footer: ''
            });
            $('#tab-content-' + x.tab).hide();
            $('#tab-no-content-' + x.tab).remove();
            $('#tab-content-' + x.tab).after("<div id='tab-no-content-" + x.tab + "'>" + l + "</div>");

            $('#list-tagged').html('no data found');
        }

    }, 'json');
}

function getUserLevelWithCondition() {
    $.post(sAjaxAgencies, {
        type: "getUserLevelWithCondition"
    }, function (rs) {
        l = "<option selected disabled> Select user level</option>";
        $.each(rs.data, function (key, val) {
            l += "<option value='" + val.transaction_parameter_count_id + "'>" + val.transaction_parameter_name + " </option>";
        });
        $("#sel_userlevel").html(l);
        $("#mng_sel_userlevel").html(l);
    }, 'json');
}


function addUser() {
    var usrfname = $('#txt_fname').val();
    var usrmname = $('#txt_mname').val();
    var usrlname = $('#txt_lname').val();
    var usrsex = $('#sex').val();
    var usrdesc = $('#txt_job_descr').val();
    var usremail = $('#txt_email').val();
    var usrtel = $('#txt_tel').val();
    var usrmob = $('#txt_mob').val();
    var userlevel = $('#sel_userlevel').val();

    $.post(sAjaxUsers, {
        type: "addNewAgencyUser",
        fname: usrfname,
        mname: usrmname,
        lname: usrlname,
        sex: usrsex,
        area_desc: usrdesc,
        email: usremail,
        tel: usrtel,
        mob: usrmob,
        userlevel: userlevel
    }, function (rs) {
        icmsMessage({
            type: "msgPreloader",
            visible: false
        });
        if (rs.data.php_validation.flag == "0") {
            icmsMessage({
                type: "msgWarning",
                body: "Please check all inputs",
            });
        } else {
            if (rs.data.result == "1") {
                icmsMessage({
                    type: "msgWarning",
                    body: '<b>' + usremail + '</b> is already registered in this branch.'
                });
            } else {
                var body = "";
                body += '<p  class="sub-content-success p2">New agency user was successfully added</p> ';
                body += '<span>The login access was sent to <b>' + usremail + '<b></span>';

                icmsMessage({
                    type: "msgSuccess",
                    body: body,
                    onShow: function () {
                        // reset form content
                        resetFormById('form-add_user');
                        // get list of user 
                        getMyUsers();
                        // close form 
                        $(".btn-close_add_user").click();
                    }
                });

            }
        }

    }, 'json');
}

function updateICMSUser() {

    $.post(sAjaxUsers, {
        type: "setUserDetails", // update details
        user_id: $('#frm-user-details').attr('data-id'),
        fname: $("#mng_txt_fname").val(),
        mname: $("#mng_txt_mname").val(),
        lname: $("#mng_txt_lname").val(),
        sex: $("#mng_sel_sex").val(),
        area_desc: $("#mng_area_desc").val(),
        tel: $("#mng_txt_tel").val(),
        mob: $("#mng_txt_mob").val(),
        userLevel: $("#mng_sel_userlevel").val(),
        txt_email: $("#mng_txt_email").val(),
        user_stats: $('#mng_sel_status').val(),
    }, function (rs) {
        icmsMessage({
            type: "msgPreloader",
            visible: false
        });
        if (rs.data.php_validation.flag == "1") {
            if (rs.data.result == "1") {
                icmsMessage({
                    type: "msgSuccess",
                    body: "You have successfully updated user datails",
                    onShow: function () {
                        getMyUsers();
                    }
                });
            } else {
                icmsMessage({
                    type: "msgWarning",
                    body: "Please check your inputs"
                });
            }
        } else {
            icmsMessage({
                type: "msgWarning",
                body: "Please check your inputs"
            });
        }
    }, 'json');

}

function proceedToUpdate() {
    icmsMessage({
        type: "msgConfirmation",
        title: "You are about to update user details.",
        onConfirm: function () {
            icmsMessage({
                type: "msgPreloader",
                visible: true
            });
            updateICMSUser();
        },
        onCancel: function () {
            $('#modalUpdateUser').modal('show');
        }
    });
}

$(document).ready(function () {
    getUserLevelWithCondition();
    getLoadingList();
    getMyUsers();
    getSex();

    // new update
    $("#btn-add_user").click(function () {
        $(".container-add_user").removeClass("hide");
    });

    $(".btn-close_add_user").click(function () {
        $(".container-add_user").addClass("hide");
    });

    // show pw
    $('.lbl-show-hide-new').click(function () {
        var stat = $(this).attr('data-stat');
        if (stat == "1") {
            $(this).text("hide");
            $(this).attr('data-stat', '0');
            $('#pw-new').attr("type", "text");
            $('#pw-new').attr("placeholder", "password")
        } else {
            $(this).text("show");
            $(this).attr('data-stat', '1');
            $('#pw-new').attr("type", "password");
            $('#pw-new').attr("placeholder", "••••••••");
        }
    });

     // reset user password
     $('#container-user-list').delegate('.a-manage-password', 'click', function () {
        // reset show hide password 
        $(".lbl-show-hide-new").text("show");
        $(".lbl-show-hide-new").attr('data-stat', '1');
        $('#pw-new').attr("type", "password")
        $('#pw-new').attr("placeholder", "••••••••")
        
        $("#pw-new").attr("data-id", $(this).attr('data-id'));
        $("#pw-new").val("");
        $('#pw-new').attr("type", "password");
        $('#pw-new').attr("placeholder", "••••••••");
        $('#mdl-change-pw').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });

        // reset password 
        $("#pw-new-error-password-validate").text("");
   });

    // manage user details 
    $('#div-my-user-list').delegate('.a-manage-user', 'click', function () {
        let id = $(this).attr('data-id');
        $.post(sAjaxUsers, {
            type: "getUserDetails",
            user_id: id,
        }, function (rs) {
            let user = rs.data;
            $("#lbl-user_name").html(user.user_username);
            $("#mng_sel_userlevel").val(user.user_level_id).change();
            $("#mng_sel_status").val(user.user_is_active).change();
            $('#mng_txt_fname').val(user.user_firstname);
            $('#mng_txt_mname').val(user.user_middlename);
            $('#mng_txt_lname').val(user.user_lastname);
            $('#mng_sel_sex').val(user.user_gender).change();
            $('#mng_txt_email').val(user.user_email);
            $('#mng_txt_email').attr('data-email', user.user_email);
            $('#area_desc').val(user.user_job_title);
            $('#mng_txt_tel').val(user.user_phone_number);
            $('#mng_txt_mob').val(user.user_mobile_number);
            $('#mng_area_desc').val(user.user_job_title);

            $('#frm-user-details').attr('data-id', id);

            $('#modalUpdateUser').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });

        }, 'json');
    });

    // form validation for add 
    $('#form-add_user').validate({
        rules: {
            txt_fname: {required: true},
            txt_lname: {required: true},
            sex: {required: true},
            txt_email: {required: true},
            txt_mob: {required: true},
            job_descr: {required: true},
            sel_userlevel: {required: true}
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
        invalidHandler: function (form, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
                $("body").animate({scrollTop: -300}, "fast");
            }

        },
        submitHandler: function (form) {
            icmsMessage({
                type: "msgConfirmation",
                title: "You are about to register this user.",
                onConfirm: function () {
                    icmsMessage({
                        type: "msgPreloader",
                        visible: true
                    });
                    addUser();
                }
            });
        }
    });

    // validate manage user details 
    $('#frm-user-details').validate({
        rules: {
            txt_fname: {required: true},
            txt_lname: {required: true},
            sex: {required: true},
            txt_email: {required: true},
            txt_mob: {required: true},
            area_desc: {required: true},
            sel_userlevel: {required: true},
            status: {required: true}
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
            $('#modalUpdateUser').modal('hide');

            if ($('#mng_txt_email').val() == $('#mng_txt_email').attr('data-email')) {
                //proceed
                proceedToUpdate();
            } else {
                icmsMessage({
                    type: "msgPreloader",
                    body: "Checking email availability, Please wait . . .",
                    visible: true
                });

                $.post(sAjaxUsers, {
                    type: "getEmailAvailability", // update details
                    email: $('#mng_txt_email').val(),
                }, function (rs) {
                    icmsMessage({
                        type: "msgPreloader",
                        visible: false
                    });
                    if (parseInt(rs.data) >= 1) {
                        icmsMessage({
                            type: "msgWarning",
                            body: "Email is already taken!",
                            caption: "Close",
                            onHide: function () {
                                $('#modalUpdateUser').modal('show');
                            }
                        });
                    } else {
                        //proceed
                        proceedToUpdate();
                    }
                }, 'json');
            }

        }

    });

    $('#frm-change-password').validate({
        rules: {
            newpassword: {
                required: true,
                minlength: "8",
            },
        },
        messages: {},
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
            if($('#pw-new').attr('check_strength_is_valid') == '1'){
                $('#mdl-change-pw').modal('hide');
                icmsMessage({
                    type: 'msgConfirmation',
                    title: 'You are about to update your password.',
                    onConfirm: function () {

                        icmsMessage({
                            type: 'msgPreloader',
                            visible: true
                        });

                        $.post(sAjaxUsers, {
                            type: "changePassword",
                            user_id: $('#pw-new').attr('data-id'),
                            password: $('#pw-new').val(),
                        }, function (rs) {
                            if (rs.data.php_validation.flag == "1") {
                                if (rs.data.flag == "1") {
                                    icmsMessage({
                                        type: 'msgSuccess',
                                        body: 'Password was successfully reset.',
                                        onShow: function () {
                                            $('#pw-new').val("");
                                        }
                                    });
                                }
                            } else {
                                icmsMessage({
                                    type: 'msgWarning',
                                    body: 'Insufficient Values!',
                                    onHide: function () {
                                        $('#mdl-change-pw').modal('show');
                                    }
                                });
                            }
                        }, 'json');

                    },
                    onShow: function () {
                        $('#mdl-change-pw').modal('hide');
                    },
                    onCancel: function () {
                        $('#mdl-change-pw').modal('show');
                    }
                });
            }
        }
    });

    // new update end
    $('#div-my-user-list').delegate('.a-reset-pwd', 'click', function () {
        var email = $(this).attr('data-email');
        var user_id = $(this).attr('dataid');
        var fname = $(this).attr('data-fname');
        var lname = $(this).attr('data-lname');
        var branchname = $(this).attr('data-branchname');
        var abbr = $(this).attr('data-abbr');
        var body = '';
        body += ' <p class="msgmodal-confirm-header m-header " style=" padding-top: 22px;"> You are about to update user password.</p>';
        body += '  <span class="sub-content-confirm p2">Click <b>"Reset"</b> button to confirm<br>Link will be sent to <br><b>' + email + '</b></span>';
        $('.msgmodal-confirm-body').html(body);
        var footer = '   <button type="button" class="btn btn-close-confirm-modal btn-close-update-confirm " data-dismiss="modal">Cancel</button>';
        footer += '      <button type="button" class="btn btn-primary-orange modal-button-save  btn-modal-reset" data-lname="' + lname + '"  data-abbr="' + abbr + '"  data-branchname="' + branchname + '"   data-fname="' + fname + '" data-email="' + email + '" data-id="' + user_id + '" data-dismiss="modal">Reset</button></div>';
        $('.msgmodal-confirm-footer').html(footer);
        $('.close').hide();
        $('#msgmodal-confirm').modal('show');
    });


    $('#div-my-user-list').delegate('.a-manage-details', 'click', function () {
        var user_id = $(this).attr('data-id');
        $('#mdl-caselist').attr('data-id', user_id);
        $('#mdl-caselist').modal('show');
        getAllCaseLists({page: 1, tab: 4, user_id: user_id});
    });

    // For Tagged Case user Pagination
    $('.rs-list-tagged_user').delegate('.page-link', 'click', function () {
        var page = parseInt($(this).attr('data-page'));
        var user_id = $('#mdl-caselist').attr('data-id');
        getAllCaseLists({page: page, tab: 4, user_id: user_id});
    });

    $('#msgmodal').delegate('.btn-close-update-confirm', 'click', function () {
        $('#modalUpdateUser').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    });


    $('.my-rs-pagination').delegate('.page-link', 'click', function () {
        var page = parseInt($(this).attr('data-page'));
        $('#user_list-my_users').attr('datapage', page);
        getMyUsers(page);
    });

    $('#div-my-user-list').delegate('.ellipse-action', 'click', function (e) {
        var id = $(this).attr('data-id');
        if ($('#myid-' + id).is(":visible")) {
            $('#myid-' + id).hide();
            $('.a-ellipse').removeClass('ellipse-selected');
        } else {
            $('.action-menu').hide();
            $('.a-ellipse').removeClass('ellipse-selected');
            $('#myid-' + id).show();
            $('.a-ellipse-' + id).addClass('ellipse-selected');
        }
    });

    $('.mytxt_search').change(function () {
        setTimeout(function () {
            $('#user_list-my_users').attr('datapage', 1);
            getMyUsers();
        }, 200);
    });


    $('.mybtn-filter_list').click(function () {
        $('.myfilter_load_placeholder').show();
        getLoadingList();
        setTimeout(function () {
            getMyUsers();

        }, 100);
    });
    $('.mybtn-filter_clear').click(function () {
        $('.myfilter_load_placeholder').show();
        $('.chk-filter').prop('checked', false);
        getLoadingList();
        setTimeout(function () {
            getMyUsers();
        }, 100);
    });
    //---------- end of filter function--------//
    
});
