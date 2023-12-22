

function getCreatedCase(page = 1) {
    var keyword = $('.txt_search').val();
    var orderby = $('.sel-orderby').val();
    var filter = $('.sel-filter').val();
    var limit = 10;

    $.post(sAjaxCase, {
        type: "getCreatedCase",
        limit: limit,
        page: page,
        orderby: orderby,
        keyword: keyword,
        filter: filter,
    }, function (rs) {
        var l = buildCaseList(rs.data.list, 2);
        console.log(l);
        $('.div-createdcase-list').html(l);

        if (parseInt(rs.data.count) <= parseInt(limit)) {
            limit = rs.data.count;
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
                count: rs.data.count
            }
        });
    }, 'json');
}

function getCaseLists(page = 1) {
//    validateSession();
    var keyword = $('.txt_search').val();
    var orderby = $('.sel-orderby').val();
    var filter = $('.sel-filter').val();
    var limit = 10;

    $.post(sAjaxCase, {
        type: "getCaseLists",
        limit: limit,
        page: page,
        orderby: orderby,
        keyword: keyword,
        filter: filter,
    }, function (rs) {
        var l = buildCaseList(rs.data.list);
        $('.div-allcase-list').html(l);

        if (parseInt(rs.data.count) <= parseInt(limit)) {
            limit = rs.data.count;
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
                count: rs.data.count
            }
        });
    }, 'json');
}



function getTaggedCase(page = 1) {
//    validateSession();
    var keyword = $('.txt_search').val();
    var orderby = $('.sel-orderby').val();
    var filter = $('.sel-filter').val();
    var limit = 10;

    $.post(sAjaxCase, {
        type: "getTaggedCase",
        limit: limit,
        page: page,
        orderby: orderby,
        keyword: keyword,
        filter: filter,
    }, function (rs) {
        var l = buildCaseList(rs.data.list);
        $('.div-taggedcase-list').html(l);

        if (parseInt(rs.data.count) <= parseInt(limit)) {
            limit = rs.data.count;
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
                count: rs.data.count
            }
        });
    }, 'json');
}



function buildCaseList(rs, tab = 1) {

    var l = "";
    $.each(rs, function (key, val) {
        l += '<div class="row " style="border-bottom:1px solid rgba(0,0,0,0.1);">';
        l += '<div class="col  col-md-2" style="">' + val.case_control_id + '</div>';

        var fact = val.case_facts;
        if (fact.length > 120) {
            fact = fact.substr(0, 80) + '<span class="viewmore ellipse-selected" data-details="' + fact + '">[<i class="fa fa-ellipsis-h" aria-hidden="true" style=""></i>]</span>';
        }
        l += '<div class="col col-md-3 justify-content-center" >' + fact + '</div>';
        var victims = "";
        var more = "";
        var ctr = 1;
        if (val.victims.count >= 2) {
            $.each(val.victims.list, function (k, v) {
                if (ctr < 2) {
                    victims += "<p dataid='" + v.worker_id + "'>" + v.worker_name_list_first_name + " " + v.worker_name_list_middle_name + " " + v.worker_name_list_last_name + " " + v.worker_name_list_suffix + "</p>"
                }
                more += "<p dataid='" + v.worker_id + "'>" + v.worker_name_list_first_name + " " + v.worker_name_list_middle_name + " " + v.worker_name_list_last_name + " " + v.worker_name_list_suffix + "</p>"
                ctr++;
            });

            victims += '<span class="viewmore ellipse-selected" data-details="' + more + '">[ View all ]</span>'
        } else {
            $.each(val.victims.list, function (k, v) {
                victims += "<p dataid='" + v.worker_id + "'>" + v.worker_name_list_first_name + " " + v.worker_name_list_middle_name + " " + v.worker_name_list_last_name + " " + v.worker_name_list_suffix + "</p>"
            });
        }

        l += '<div class="col col-md-2 ">' + victims + '</div>';
        var added_by_details = "";
        if (tab !== 2) {
            added_by_details += "<p style='margin:0px'>" + val.agency_added_by + "</p>";
        }
        added_by_details += "<p style='margin:0px'><small>" + val.branch_added_by + "</small></p>";
        added_by_details += "<p style='margin:0px'><small>" + val.user_added_by + "</small></p>";

        l += '<div class="col col-md-1" style="">' + val.case_date_added + '</div>';
        l += '<div class="col col-md-2" style="">' + added_by_details + '</div>';
        l += '<div class="col col-md-1" style="white-space:nowrap;">' + val.case_status + '</div>';
        l += '  <div class="col col-md-1 col-body text-center">';
        l += '      <div class="btn-group ellipse-action " data-id="' + val.case_control_id + '">';
        l += '          <a class="a-ellipse a-ellipse-' + val.case_control_id + ' " >  <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </a>';
        l += '          <div class="action-menu" id="' + val.case_control_id + '">';
        l += '              <a class="dropdown-item disabled action-title" href="#">Select Action</a>';
        l += '              <a class="dropdown-item" href="#">Manage Case</a>';
        l += '              <a class="dropdown-item" href="#">View Tagged Agency</a>';
        l += '              <a class="dropdown-item" href="#">View Summary</a>';
        l += '         </div>';
        l += '      </div>';
        l += '  </div>';
        l += '</div>';
    });

    return  l;
}



$(document).ready(function () {
//
//    getCaseLists();
//
//
//
//    $('.case-list').delegate('.viewmore', 'click', function () {
//        var details = $(this).attr('data-details');
//        $(this).parent('div').html(details);
//    });
//
////    $('.rs-pagination').delegate('.page-link', 'click', function () {
////        var page = parseInt($(this).attr('data-page'));
////        getAllUsers(page);
////    });
//
//    $('.case-list').delegate('.ellipse-action', 'click', function (e) {
//        var id = $(this).attr('data-id');
//        if ($('#' + id).is(":visible")) {
//            $('#' + id).hide();
//            $('.a-ellipse').removeClass('ellipse-selected');
//        } else {
//            $('.action-menu').hide();
//            $('.a-ellipse').removeClass('ellipse-selected');
//            $('#' + id).show();
//            $('.a-ellipse-' + id).addClass('ellipse-selected');
//        }
//    });
//
//    $('.li-all-cases').click(function () {
//        $('#case-ul').attr('data-id', '1');
//        getCaseLists();
//    });
//
//    $('.li-created-cases').click(function () {
//        $('#case-ul').attr('data-id', '2');
//        getCreatedCase();
//    });
//
//    $('.li-tagged-cases').click(function () {
//        $('#case-ul').attr('data-id', '3');
//        getTaggedCase();
//    });
//
//    $('.sel-agency').selectpicker();
////    $('.sel-orderby').selectpicker();
//



});

