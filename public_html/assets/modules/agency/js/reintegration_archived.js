
function getArchivedReintegrationList(x) {

    var limit = 10;
    var keyword = $('#txt_search-lls').val();

    $.post(sAjaxServiceDetails, {
        type: 'getArchivedReintegrationList',
        limit: limit,
        page: x.page,
        keyword: keyword
    }, function (rs) {

        if (rs.data.flag == 1) {
            var l = '';
            $('#ul-list').show();
            $('.rs-list').show();
            $('#ul-list-no-content').remove();

            $.each(rs.data.list.listing, function (key, val) {
                l += '<li style="width:100%" class="li-service_' + key + '" data-id="' + key + '" data-case_id ="' + val.case_id + '" data-tag_id ="' + val.case_victim_services_agency_tag_id + '"  data-victim_id="' + val.victim_id + '" data-agency_branch_id="' + val.agency_branch_id + '" data-service_title ="' + val.service_name + ' - ' + val.service_duration + '" data-victim_name ="' + val.victim_name + '" data-cvsid="' + val.case_victim_services_id + '" >';
                l += '    <div class="card">';
                l += '        <div class="row">';
                l += '            <div class="col-lg-7 col-md-7 col-sm-7  align-items-center trigger-modal_view"  data-id="' + key + '">';
                l += '                <div class="nav-data_list ">';
                l += '                    <div class="agency_details service_details">';
                l += '                        <span class="icms-text-secondary">Report Id : </span><span> ' + val.case_number + ' </span>';
                l += '                        <br> <span class="icms-text-secondary">Name of Accused : </span><span> ' + val.victim_name + ' </span>';
                l += '                        <br> <span class="icms-text-secondary">Assessment : </span><span>' + val.service_duration + '</span>';
                l += '                        <br> <span class="icms-text-secondary">Service : </span><span>' + val.service_name + '</span>';
                l += '                        <br> <span class="icms-text-secondary">Tagged to : </span><span> ' + val.tagged_to.agency_abbr + ' - ' + val.tagged_to.agency_branch_name + ' </span>';
                l += '                        <br> <span class="icms-text-secondary">Added by : </span><span> ' + val.tagged_by.agency_abbr + ' - ' + val.tagged_by.agency_branch_name + ' </span>';
                l += '                        <br> <span class="icms-text-secondary">Date Created : </span><span> ' + val.case_victim_services_agency_tag_added_date + ' </span>';
                l += '                        <br> <span class="icms-text-secondary">Date Last Modified : </span><span> ' + val.case_victim_services_agency_tag_date_modified + ' </span>';
                l += '                    </div>';
                l += '                </div>';
                l += '            </div>';
                l += '            <div class="col-lg-3 col-md-3 col-sm-3 txt-align_center d-flex align-items-center trigger-modal_view"  data-id="' + key + '"> <span class="stat_1 status">' + val.service_status + '</span></div>';
                l += '            <div class="col-lg-2 col-md-2 col-sm-2">';
                l += '                <button class="btn dropdown-toggle" type="button" id="dropdown_service" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                l += '                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>';
                l += '                </button>';
                l += '                <div class="dropdown-menu shadow action-menu" aria-labelledby="dropdown_service" style="display: none;">';
                l += '                    <a class="dropdown-item disabled action-title" href="#">Select Action</a>';
                l += '                    <button class="dropdown-item trigger-modal_view" type="button" data-id="' + key + '">Manage Service</button>';
                l += '                </div>';
                l += '            </div>';
                l += '        </div>';
                l += '    </div>';
                l += '</li>';
            });

            $('.list_content').html(l);

            buildPagination({
                parent: 'rs-list',
                info: 'rs-info',
                pagination: 'rs-pagination',
                offset: 'rs-offset',
                data: {
                    page: x.page,
                    offset: limit,
                    count: rs.data.list.count
                }
            });

        } else {
            var keyword = $('#txt_search-lls').val();
            var sFooter = '';
            var sMessage = 'SORRY, WE COULDN\'T FIND ANY REINTEGRATION SERVICE RELATED TO <span class = "font-italic" >"<span>' + keyword + '</span>"</span>.';
            if (!keyword) {
                sMessage = 'NO CLOSED/INAPPLICABLE LEGAL SERVICE AVAILABLE YET';
            }
            var l = getNoDataFound({
                message: sMessage,
                footer: sFooter
            });
            $('#ul-list').hide();
            $('.rs-list').hide();
            $('#ul-list-no-content').remove();
            $('#ul-list').after("<div id='ul-list-no-content'>" + l + "</div>");
        }


    }, 'json');
}

function setStatus() {
    var subj = 'Reopen reintegration service';
    var remarks = $('#area_remarks').val();
    var service_stats = '1';
    var case_id = $('#frm-reopen').attr('data-case_id');
    var tag_id = $('#frm-reopen').attr('data-tag_id');
    var victim_id = $('#frm-reopen').attr('data-victim_id');
    var agency_branch_id = $('#frm-reopen').attr('data-agency_branch_id');
    var service_title = $('#frm-reopen').attr('data-service_title');
    var victim_name = $('#frm-reopen').attr('data-victim_name');
    var cvsid = $('#frm-reopen').attr('data-cvsid');

    $.post(sAjaxServiceDetails, {
        type: 'reOpenReintegrationService',
        remarks: remarks,
        service_stats: service_stats,
        subj: subj,
        case_id: case_id,
        tagged_id: tag_id,
        vicitm_id: victim_id,
        agency_branch_id: agency_branch_id,
        service_title: service_title,
        victim_name: victim_name,
        cvsid: cvsid
    }, function (rs) {

        if (rs.data.stat.stat == '1') {
            icmsMessage({
                type: 'msgSuccess',
                body: "You have been successfully reopen a service.",
                link: {
                    content: 'Go to service monitorig',
                    link: 'view_victim_services/' + case_id + '/' + victim_id
                },
            });
            $('#area_remarks').val('');

            getArchivedReintegrationList({
                page: 1
            });

        } else {
            icmsMessage({
                type: "msgWarning",
                visible: false,
            });
        }
    }, 'json');
}

$(document).ready(function () {

    getArchivedReintegrationList({
        page: 1
    });

    $('.list_content').delegate('.trigger-modal_view', 'click', function () {
        console.log('asdsad');
        var key = $(this).attr('data-id');
        var case_id = $(".li-service_" + key).attr('data-case_id');
        var tag_id = $(".li-service_" + key).attr('data-tag_id');
        var victim_id = $(".li-service_" + key).attr('data-victim_id');
        var agency_branch_id = $(".li-service_" + key).attr('data-agency_branch_id');
        var service_title = $(".li-service_" + key).attr('data-service_title');
        var victim_name = $(".li-service_" + key).attr('data-victim_name');
        var cvsid = $(".li-service_" + key).attr('data-cvsid');
        var sDetails = $(".li-service_" + key + " .service_details").html();

        $('#frm-reopen').attr('data-case_id', case_id);
        $('#frm-reopen').attr('data-tag_id', tag_id);
        $('#frm-reopen').attr('data-victim_id', victim_id);
        $('#frm-reopen').attr('data-service_title', service_title);
        $('#frm-reopen').attr('data-agency_branch_id', agency_branch_id);
        $('#frm-reopen').attr('data-victim_name', victim_name);
        $('#frm-reopen').attr('data-cvsid', cvsid);

        $('.mdl-content').html(sDetails);
        $('#modal-manage-accused').modal('show');
    });

    // validation 
    $('#frm-reopen').validate({
        rules: {
            area_remarks: {
                required: true,
                maxlength: 100
            },
        },
        errorElement: 'div',
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
                type: 'msgConfirmation',
                title: 'You are about to reopen this service',
                onConfirm: function () {
                    setStatus();
                },
                onShow: function () {
                    $('#modal-manage-accused').modal('hide');
                },
                onCancel: function () {
                    $('#modal-manage-accused').modal('show');
                }
            });

        }
    });

    // Search keyword
    $('#txt_search-lls').on('search', function () {
        getArchivedReintegrationList({
            page: 1
        });
    });

    // Pagination 
    $('.rs-pagination').delegate('.page-link', 'click', function () {
        var page = parseInt($(this).attr('data-page'));
        getArchivedReintegrationList({page: page});
    });

    // confimation of closing
    $('#modal-manage-accused .btn-cancel').click(function () {
        var sVal = $('#area_remarks').val();
        if (sVal !== '') {
            icmsMessage({
                type: 'msgConfirmation',
                title: 'You have some changes, do you realy want to disregard?',
                body: ' Click yes button if you wish to continue.',
                LblBtnConfirm: 'Yes',
                onConfirm: function () {
                    $('#area_remarks').val('');
                },
                onCancel: function () {
                    $('#modal-manage-accused').modal('show');
                }
            });
        }
    });

});
