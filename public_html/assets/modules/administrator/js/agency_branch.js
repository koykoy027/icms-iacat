function getAgencyInformationbyId(id) {
    var id = id;
    var sFooter = '';
    var l = '<h3 class="text-center modal-title"> Processing..... </h3>';
    if (id != null) {

        $.post(sAjaxAgencies, {
            type: "getAgencyInformationbyId",
            agency_id: id
        }, function (rs) {
            var res = rs.data;
            $('.msgmodal-body').html(l);

            if (rs.data.flag !== '0') {
                l = '';

                l += '  <h5 class="modal-title" style="color: #204985;">Agency Details</h5>';
                l += '        <div style="padding: 0em 3em;">';
                l += '            <div class="row">';
                l += '                <div class="col-lg-3 col-md-3 col-sm-3">';
                l += '                        <img src="' + sDriveViewer + res.logo + '" onerror="ifBrokenLogo(this);" style="margin-top: 0px; height:70px; width:70px">';
                l += '                </div>   ';
                l += '                <div class="col-lg-9 col-md-9 col-sm-9">';
                l += '                  <span  style="font-size:16px;">' + res.agency_name + '</span>';
                l += '                  <p>' + res.agency_abbr + ' - ' + res.agency_branch_name + '</p>';

                l += '                  <p>' + res.agency_branch_email;
                if (res.agency_branch_telephone_number !== "" && res.agency_branch_mobile_number !== "") {
                    l += '<br>' + res.agency_branch_telephone_number + ' | ' + res.agency_branch_mobile_number;
                } else {
                    if (res.agency_branch_telephone_number !== "") {
                        l += '<br>' + res.agency_branch_telephone_number;
                    }
                    if (res.agency_branch_mobile_number !== "") {
                        l += '<br>' + res.agency_branch_mobile_number;
                    }
                }

                if (typeof res.govt_agency_address.country !== "undefined") {
                    var provState = res.govt_agency_address.province;
                    if (provState == "") {
                        provState = res.govt_agency_address.state;
                    }
                    l += '<br><span style="text-transform:capitalize">' + res.govt_agency_address.address_list_address + ' ' + res.govt_agency_address.brgy + ' ' + res.govt_agency_address.city + ' ' + res.govt_agency_address.province + ' ' + res.govt_agency_address.region + ' ' + res.govt_agency_address.country + '</span>';
                }
                l += '                  </p>';

                l += '                </div>   ';
                l += '            </div>';

                if (res.contact_details_result == "1") {
                    l += '            <h5 style="color: #204985; font-size:18px; text-align:center; ">Agency Contact Details</h5><br>';
                    l += '            <div class="row">';
                    l += '                <div class="col-lg-3 col-md-3 col-sm-3">';
//                    l += '                        <img src="' + sDriveViewer + res.logo + '" onerror="ifBrokenLogo(this);" style="margin-top: 0px; height:70px; width:70px">';
                    l += '                    ';
                    l += '                </div>   ';
                    l += '             <div class = "col-lg-9 col-md-9 col-sm-9">';
//                    l += '                <span class="card-desc"> List of agency contact details </span>';
                    l += '                <div class="lbl-agencies_contact_list">';

                    $.each(res.contact_details, function (key, val) {
                        l += '              <p>';
                        l += val.agency_contact_firstname + ' ' + val.agency_contact_lastname;
                        l += '<br><br><br>';
                        if (val.agency_contact_mobile_number !== "" && val.agency_contact_telephone_number !== "") {
                            l += '<br>' + val.agency_contact_mobile_number + ' |  ' + val.agency_contact_telephone_number;
                        } else {
                            if (val.agency_contact_telephone_number !== "") {
                                l += '<br>' + val.agency_contact_telephone_number;
                            }
                            if (val.agency_branch_mobile_number !== "") {
                                l += '<br>' + val.agency_branch_mobile_number;
                            }
                        }
                        l += '                    <p>' + val.agency_contact_email + '</p>';
                        var provState = val.province;
                        if (provState == "") {
                            var provState = val.state;
                        }
                        if (typeof val.country_name !== "undefined") {
                            l += '                    <p style="text-transform:capitalize">' + val.brgy + ' ' + val.city + ' ' + provState + '</p>';
                        }
                        l += '                     </p>';

                    });

                    l += '                </div>';
                    l += '             </div>';
                }

                l += '            </div>';
                l += '        </div>';

                sFooter += '<button type="button" class="btn btn-cancel btn-modal-cancel" data-dismiss="modal">Close</button>';
                $('.msgmodal-body').html(l);
                $('.msgmodal-footer').html(sFooter);
                $('#msgmodal').modal('show');
            }

        }, 'json');


    } else {
        alert('Something went wrong, please try again.');
    }

}

function buildBranchList(rs) {
    var tbl = "";
    $.each(rs.data.content.listing, function (key, val) {
        var stat = '<span class="badge_cc"></span><span class="stat_">Active</span>';
        if (val.agency_branch_is_active == '0') {
            stat = '<span class="stat_inactive">Inactive</span>';
        }
        if (val.agency_is_active == '0') {
            stat = '<span class="stat_inactive_agency">Inactive Agency</span>';
        }
        tbl += '   <li style="width:100%">';
        tbl += '     <div class="card">';
        tbl += '       <div class="row">';
//        tbl += '                                  <a class="dropdown-item a-view_agency" attr-id="' + val.agency_branch_id + '" >';
        tbl += '                                       <div class="col-lg-8 col-md-8 col-sm-8  align-items-center "  >';
        tbl += '                                           <div class="row nav-data_list">';
        tbl += '                                                 <div class="col-lg-2 col-md-3 col-sm-4 data_list_img">';
//        tbl += '                                                   <div class="img_content"> <img src="' + sDriveViewer + val.logo + '" onerror="ifBrokenLogo(this);"> </div>';
        tbl += '                                               </div>';
        tbl += '                                              <div class="col-lg-10 col-md-9 col-sm-8 test2 desc_content">';
        tbl += '                                                    <div class="agency_details">';
        tbl += '                                                       <span class="content-title ">' + val.agency_branch_name + '  </span> ';


        if (val.agency_branch_is_main == '1') {
            tbl += '                           </span>  <span  style="color: #e88f15"> | Main Branch';
        }

        tbl += '                        </span><br>   <span style="color: #495057;">  ' + val.agency_name + '     (' + val.agency_abbr + ')   </span> <br> ';
        tbl += '                                                       <span>';

        if (typeof val.address.country !== "undefined") {
            
            var provState = val.address.province;
            if (provState == "") {
                provState = val.address.state;
            }
            tbl += ' <span style="text-transform:capitalize">';
            tbl += val.address.address_list_address ? val.address.address_list_address + " " : "";
            tbl += val.address.city ? val.address.city  + " " : "";
            tbl += val.address.province ? val.address.province + " " : "";
            tbl += ' </span><br>';
        }

        if (val.agency_branch_telephone_number !== "" && val.agency_branch_mobile_number !== "") {
            tbl += '                                 <span class="txt-light">' + val.agency_branch_telephone_number + ' | ' + val.agency_branch_mobile_number + '</span>';
        } else {
            if (val.agency_branch_telephone_number !== "") {
                tbl += '                             <span class="txt-light">' + val.agency_branch_telephone_number + '</span>';
            }
            if (val.agency_branch_mobile_number !== "") {
                tbl += '                            <span class="txt-light">' + val.agency_branch_mobile_number + '</span>';
            }
        }

        tbl += '                                                        <br> <span class="txt-light">' + val.agency_branch_email + '</span>';
        tbl += '                                                    </div>';
        tbl += '                                               </div>';
        tbl += '                                            </div>';
        tbl += '                                        </div>';
//        tbl += '                                        </a>';
        tbl += '                                        <div class="col-lg-2 col-md-2 col-sm-2 txt-align_center d-flex align-items-center justify-content-center"> ' + stat + '</div> ';
        tbl += '                                        <div class="col-lg-2 col-md-2 col-sm-2 txt-align_center d-flex align-items-center justify-content-center">';
        tbl += '                                           <div class="btn-group ellipse-action " data-id="' + val.agency_branch_id + '">';
        tbl += '                                                <a class="a-ellipse a-ellipse-' + val.agency_branch_id + '  action_btn"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </a>';
        tbl += '                                               <div class="action-menu" data-cur-stat="1" id="id-' + val.agency_branch_id + '" style="display: none;">';
        tbl += '                                                   <a class="dropdown-item disabled action-title" href="#">Select Action</a>';
        tbl += '                                                    <a class="dropdown-item a-view_agency" attr-id="' + val.agency_branch_id + '" >View Agency Details</a> ';
        tbl += '                                                    <a href="manage_agency_branch/' + val.agency_branch_id + '" class="dropdown-item a-manage_agency" attr-id="' + val.agency_branch_id + '" > Manage Agency Details</a> ';
//        if (val.agency_is_active == '1') {
//            tbl += '                                                    <a class="dropdown-item a-change-status" data-stat="' + val.agency_branch_is_active + '" attr-id= "' + val.agency_branch_id + '">Change Status</a></div>';
//        }
        tbl += '                                           </div>';
        tbl += '                                       </div>';
        tbl += '                                    </div>';
        tbl += '                                </div>';
        tbl += ' </li>';
        ;
    });
//    localStorage.clear();

    return tbl;
}

function getAgenciesBranchList(page = 1) {

    var limit = 10;
    var keyword = $('#txt_search_agency_branch').val();
    var orderby = [];
    var aStatus = [];
//    var aAgency = [];
//    var isMain = '';
    var abranch = [];


//    $('#sel-filterby').find("option:selected").each(function () {
//        // values based on each group 
//        var sName = $(this).parent().attr("name");
//        filterId = $(this).val();
//        if (filterId) {
//            if (sName === 'status') {
//                aStatus.push(filterId); // Get Status Id 
//            } else if (sName === 'agency') {
//                aAgency.push(filterId); // Get Gender Id 
//            } else if (sName === 'branch') {
//                isMain = filterId
//            }
//        }
//    });]
//    var orderby = $("input[name='orderBy']:checked").val();

    $.each($("input[name='status']:checked"), function () {
        aStatus.push($(this).val());
    });
    $.each($("input[name='branch']:checked"), function () {
        abranch.push($(this).val());
    });
    $.each($("input[name='orderBy']:checked"), function () {
        orderby.push($(this).val());

    });
    aStatus = aStatus.join();
    abranch = abranch.join();
    orderby = orderby.join();

    $.post(sAjaxAgencies, {
        type: "getAgenciesBranchList",
        keyword: keyword,
        aStatus: aStatus,
//        aAgency: aAgency,
        orderby: orderby,
        isMain: abranch,
        page: page,
        limit: limit
    }, function (rs) {




        if (rs.data.flag != '0') {
            $('#agency_branch_list-no-content').remove();
            $('#agency_branch_list').show();

            var tbl = buildBranchList(rs);
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


            $('.filter_load_placeholder').hide();
            $('.div-agencies-list').html(tbl);
        } else {

            var sFooter = '<a href="' + sAjaxUrl + '/add_agency_branch"> <button type="button" class="btn" style="background-color: #e88f15; color: #fff;"> ADD AGENCY </button> </a>';
            var sMessage = 'SORRY, WE COULDN\'T FIND ANY BRANCH AGENCY RELATED TO <span class = "font-italic" >"<span>' + keyword + '</span>"</span>.';

            if (!(keyword)) {
                sMessage = 'NO AGENCY BRANCH FOUND.';
            }
            var l = getNoDataFound({
                message: sMessage,
                footer: sFooter
            });

            $('#agency_branch_list').hide();
            $('#agency_branch_list-no-content').remove();
            $('#agency_branch_list').after("<div id='agency_branch_list-no-content'>" + l + "</div>");

        }

    }, 'json');
}

function getFilterOption() {
    var l = '';
    $.post(sAjaxAgencies, {
        type: "getAgencyTypes"
    }, function (rs) {

        l += '<optgroup label="Status" name="status">';
        l += '    <option value="1">Active</option>';
        l += '    <option value="0">Inactive</option>';
        l += '</optgroup>';

        l += '<optgroup label="Branch" name="branch">';
        l += '    <option value="1">Main branch</option>';
        l += '</optgroup>';

        if (rs.data.length > 0) {
            l += '<optgroup label="Agency" name="agency">';
            $.each(rs.data, function (key, val) {
                l += "<option value='" + val.agency_id + "'>" + val.agency_abbr + " </option>";
            });
            l += '</optgroup>';
        }

        $('#sel-filterby').html(l);
        // ini chosen, filter by 
        $('#sel-filterby').chosen();

    }, 'json');

}


$(document).ready(function () {
    getAgenciesBranchList();
    getFilterOption();
    getLoadingList();


    $('.div-agencies-list').delegate('.ellipse-action', 'click', function (e) {

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

    $('.div-agencies-list').delegate('.a-view_agency', 'click', function (e) {
        var id = $(this).attr('attr-id');
        var sBodyModal = '';
        $('.modal-header').addClass('hide');
        $('.msgmodal-body').html(sBodyModal);
        getAgencyInformationbyId(id, sBodyModal);
//        $('#mdl-view_agency1').modal('show');

    });


    $('.div-agencies-list').delegate('.a-change-status', 'click', function (e) {
        var aid = $(this).attr('attr-id');
        var cur_stat = $(this).attr('data-stat');

        $('.msgmodal-header').html("Change Status");
        var msg = "";
        if (cur_stat == "1") {
            msg += '<div class="div-rdo-active">';
            msg += '<input type="radio" name="rdo_stat" id="rdo_1" value="1" checked> <label for="rdo_1">Active</label>';
            msg += '</div>';
            msg += '<divclass="div-rdo-inactive">';
            msg += '<input type="radio" name="rdo_stat" id="rdo_0" value="0"> <label for="rdo_0">Inactive</label>';
            msg += '</div>';
        } else {
            msg += '<div>';
            msg += '<input type="radio" name="rdo_stat" id="rdo_1" value="1" > <label for="rdo_1">Active</label>';
            msg += '</div>';
            msg += '<div>';
            msg += '<input type="radio" name="rdo_stat" id="rdo_0" value="0" checked> <label for="rdo_0">Inactive</label>';
            msg += '</div>';
        }
        msg += '</div>';
        $('.msgmodal-body').html(msg);
        var footer = ' <a type="button" class="btn  btn-info  btn-modal-status-change" data-cur_stat="' + cur_stat + '" data-aid="' + aid + '" >Change</a>';
        footer += '<a type="button" class="btn  btn-info"  data-dismiss="modal" aria-label="Close">Cancel</a>';
        $('.msgmodal-footer').html(footer);
        $('#msgmodal').modal('show');

    });

    $('#msgmodal').delegate('.btn-modal-status-change', 'click', function () {
        var aid = $(this).attr('data-aid');
        var cur_stat = $(this).attr('data-cur_stat');
        var newStat = $('input[name=rdo_stat]:checked').val();

        if (cur_stat !== newStat) {
            $.post(sAjaxAgencies, {
                type: "setAgencyBranchStatusAndItsUsers",
                aid: aid,
                newStat: newStat,
            }, function (rs) {
                if (rs.data.php_validation.flag == "1") {
                    $('.msgmodal-header').html("Result");
                    $('.msgmodal-body').html("Branch status was successfully changed");
                    var footer = '<a type="button" class="btn  btn-info"  data-dismiss="modal" aria-label="Close">Close</a>';
                    $('.msgmodal-footer').html(footer);
                    getAgenciesBranchList();
                } else {
                    $('.msgmodal-header').html("Warning");
                    $('.msgmodal-body').html("insufficient Values");
                    var footer = '<a type="button" class="btn  btn-info"  data-dismiss="modal" aria-label="Close">Close</a>';
                    $('.msgmodal-footer').html(footer);
                }


            }, 'json');
        } else {
            $('.msgmodal-header').html("Result");
            $('.msgmodal-body').html("No changes were made");
            var footer = '<a type="button" class="btn  btn-info"  data-dismiss="modal" aria-label="Close">Close</a>';
            $('.msgmodal-footer').html(footer);
        }

    });


    // For searching keyword
    $('#txt_search_agency_branch').on('keypress', function (e) {
        if (e.which == 13) {
            getAgenciesBranchList();
        }
    });

    $('#txt_search_agency_branch').change(function () {
        setTimeout(function () {
            getAgenciesBranchList();
        }, 1000);
    });

    // pagination
    $('.rs-pagination').delegate('.page-link', 'click', function () {
        var page = parseInt($(this).attr('data-page'));
        getAgenciesBranchList(page);
    });

    //Order by 
    $('#sel-orderby').change(function () {
        getAgenciesBranchList();
    });

    //Filter by 
    $('#sel-filterby').change(function () {
        getAgenciesBranchList();
    });
    $('.btn-filter_list').click(function () {
        $('.filter_load_placeholder').show();
        getLoadingList();
        setTimeout(function () {
            getAgenciesBranchList();

        }, 100);
    });
    $('.btn-filter_clear').click(function () {
        $('.filter_load_placeholder').show();
        $('.chk-filter').prop('checked', false);
        getLoadingList();
        setTimeout(function () {
            getAgenciesBranchList();
        }, 100);

    });

});

