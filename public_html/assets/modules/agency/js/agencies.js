
function copyAgencyLogoToDrive() {
    var data = new FormData();
    var file = document.getElementById("imageselect").files;
    var uploadURL = window.location.origin + '/ajax/drive/ajax';
    data.append('file', file[0]);
    data.append('type', 'uploadFile');
    $.ajax({
        xhr: function ()
        {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function (evt) {

                if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    var total = percentComplete * 100;
                    var num = Math.round(total);
                    var percentVal = num + '%';
                    // progress bar 
                    progress = $('.upload-progress');
                    progress.removeClass('hide');
                    progress.find('.determinate').css('width', percentVal);
                    progress.find('.upload-progress-caption').html(" " + percentVal + " uploading file.");
                }
            }, false);
            return xhr;
        },
        url: uploadURL,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: 'POST',
        success: function (rs) {
            var imageHash = rs.data.output.hash;
            addAgencyLogo(imageHash);
        },
        error: function () {

            //something went wrong
//                location.reload();
        }

    });
}
function addAgencyLogo(imageHash) {
    $.post(sAjaxAgencies, {
        type: "addAgencyTypeLogo",
        id: $('#btn-save_manage').attr('data-id'),
        hash: imageHash,
    }, function (rs) {
        setAgencyDetails(imageHash);
    }, 'json');
}
function setAgencyDetails(imageHash = "") {

    $.post(sAjaxAgencies, {
        type: "setAgencyType",
        id: $('#btn-save_manage').attr('data-id'),
        agencyname: $('#txt-agn-name').val(),
        abbr: $('#text-agn-abbr').val(),
        category: $('#sel-category').val(),
        description: $('#description').val(),
        status: $('#sel-status').val(),
        curStatus: localStorage.getItem('cur_stats'),
    }, function (rs) {
        $('.content-title').html("Manage Agency Details");
        var body = '';
        body += '<div class="text-center">';
        if (rs.data.php_validation.flag == "0") {
            $('.h5-title').html("Warning");
            body += 'Incomplete Values';
        } else {
            if (rs.data.result.flag != '0' || imageHash !== "") {
                body += 'Agency was successfully updated';
                $('#mdl-manage_agency').modal('hide');
                getAgencyList();
            } else {
                body += 'No changes made';
            }

        }

        body += '</div>';
        $('.msgmodal-body').html(body);
        var footer = '  <button type="button" class="btn btn-secondary btn-save-done" data-dismiss="modal">Close</button>';
        $('.msgmodal-footer').html(footer);
        $('.close').hide();
        $('#msgmodal').modal('show');
    }, 'json');
}
function clickManageAgencyDetail(aParam) {
    $('#mdl-view_agency').modal('hide');
    $('#btn-save_manage').attr('data-id', aParam.id);
    $('#txt-agn-name').val(aParam.name);
    $('#text-agn-abbr').val(aParam.abbr);
    $('#sel-category').val(aParam.type).change();
    $('#description').val(aParam.desc);
    $('#sel-status').val(aParam.status).change();
    $('#mdl-manage_agency').modal('show');
}

function buildAgencyList(rs) {
    var tbl = "";
    $.each(rs.data.content.listing, function (key, val) {
        $('#agency_listing').show();
        $('#agency_listing-no-content').remove();

        var stat = '<span class="stat_">Active</span>';
        var sStat = 'Active';
        if (val.agency_is_active == '0') {
            stat = '<span class="stat_inactive">Inactive</span>';
            sStat = 'Inactive';
        }
        var desc = val.agency_description;
        var newDesc = '';
        if (desc.length >= 220) {
            if (desc.length > 220) {
                newDesc += '<span id ="summary-desc_' + val.agency_id + '">';
                newDesc += desc.substr(0, 220) + '...';
                newDesc += '   <a class="view_more" attr-id="' + val.agency_id + '"> <span class ="ellipse-selected"> read more </span> </a>';
                newDesc += '</span>';
                newDesc += '<span class="hide" id ="full-desc_' + val.agency_id + '">' + desc;
                newDesc += '   <a class="view_less" attr-id="' + val.agency_id + '"> <span class="ellipse-selected"> read less </span> </a>';
                newDesc += '</span>';
            }
        } else {
            newDesc = desc;
        }
        tbl += '    <li style="width:100%">  ';
        tbl += '          <div class="card" style="   ">';
        tbl += '                <div class="row">';
        tbl += '                  <div class="col-lg-8 col-md-8 col-sm-8" >';
        tbl += '                      <div class="row nav-data_list">';
        tbl += '                          <div class="col-lg-3 col-md-3 col-sm-3 data_list_img">';
        tbl += '                                 <div class="img_content" >';
        tbl += '                                      <img src="' + sDriveViewer + val.photo + '" onerror="ifBrokenLogo(this);" > ';
        tbl += '                                   </div>';
        tbl += '                          </div>';
        tbl += '                          <div class="col-lg-9 col-md-9 col-sm-9 test2 desc_content">';
        tbl += '                                      ';
        tbl += '                                <span class="desc_name" >  ' + val.agency_name + '  <span class="desc_abbr">(' + val.agency_abbr + ')</span></span> <br>';
        tbl += '                                <span class="desc_sub_name"> ' + val.govt_agency_type_category_name + '</span><br>';
        tbl += '                          </div>';
        tbl += '                      </div>';
        tbl += '                   </div>';
        tbl += '                  <div class="col-lg-2 col-md-2 col-sm-2">';
        tbl += stat;
        tbl += '                  </div>';
        tbl += '                            <div class="col-lg-2 col-md-2 col-sm-2 txt-align_center">';
        tbl += '                                <div class="btn-group ellipse-action " data-id="' + val.agency_id + '">';
        tbl += '                                    <a class="a-ellipse a-ellipse-' + val.agency_id + '  action_btn "> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </a>';
        tbl += '                                    <div class="action-menu" data-cur-stat="' + val.agency_is_active + '"  id="id-' + val.agency_id + '" data-logo="' + sDriveViewer + val.photo + '">';
        tbl += '                                          <a class="dropdown-item disabled action-title" href="#">Select Action</a>';
        tbl += '                                          <a class="dropdown-item a-view_agency" attr-id= "' + val.agency_id + '"  attr-type="' + val.govt_agency_type_category_name + '" attr-name= "' + val.agency_name + '"  attr-status ="' + sStat + '" attr-abbr= "' + val.agency_abbr + '"  attr-desc= "' + val.agency_description + '" >View Agency Details</a>';
        tbl += '                                          <a class="dropdown-item a-manage_agency"  attr-id= "' + val.agency_id + '"  attr-type="' + val.agency_category_id + '" attr-name= "' + val.agency_name + '"  attr-status ="' + val.agency_is_active + '" attr-abbr= "' + val.agency_abbr + '"  attr-desc= "' + val.agency_description + '" > Manage Agency Details</a>';
        tbl += '                                    </div>';
        tbl += '                             </div>';
        tbl += '                          </div>';
        tbl += '                      </div>';
        tbl += '                   </div>';
        tbl += '               </li>';
    });

    $('.div-agencies-list').html(tbl);
}
function getAgencyList(page = 1) {

    var limit = 10;
    var keyword = $('#txt_search_agency_list').val();
    var orderby = $('.sel-orderby').val();
    var aStatus = [];
    var aCategory = [];

    $('.sel-filter').find("option:selected").each(function () {
        // values based on each group 
        var sName = $(this).parent().attr("name");
        filterId = $(this).val();

        if (filterId) {
            if (sName === 'status') {
                aStatus.push(filterId); // Get Status Id 
            } else if (sName === 'category') {
                aCategory.push(filterId); // Get Gender Id 
            }
        }
    });

    aStatus = aStatus.join();
    aCategory = aCategory.join();

    $.post(sAjaxAgencies, {
        type: "getAgencyList",
        page: page,
        limit: limit,
        orderby: orderby,
        aStatus: aStatus,
        aCategory: aCategory,
        keyword: keyword,
    }, function (rs) {
    //------------PRELOADER_----------//
    $('#loadMeloader').modal('show');
    setTimeout(function () {
        $('#loadMeloader').modal('hide');
    }, 1000);
    //-----------end of preloader-------//
        if (rs.data.flag != 0) {
            buildAgencyList(rs);

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
            var sFooter = '<a href="' + sAjaxUrl + '/add_agency"> <button type="button" class="btn" style="background-color: #e88f15; color: #fff;"> ADD AGENCY </button> </a>';
            var sMessage = 'SORRY, WE COULDN\'T FIND ANY AGENCY RELATED TO <span class = "font-italic" >"<span>' + keyword + '</span>"</span>.';

            if (!(keyword)) {
                sMessage = 'NO AGENCY FOUND.';
            }
            var l = getNoDataFound({
                message: sMessage,
                footer: sFooter
            });

            $('#agency_listing').hide();
            $('#agency_listing-no-content').remove();
            $('#agency_listing').after("<div id='agency_listing-no-content'>" + l + "</div>");
        }

    }, 'json');
}


$(document).ready(function () {

    getAgencyList();
    $("input[type=file]").on('change', function () {
        var input = this;
        var url = $(this).val();
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))
        {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.modal-div-image').html("<img  class='img-manage'  data-change='1' src='" + e.target.result + "' />");
            }
            reader.readAsDataURL(input.files[0]);
        } else
        {
            var logo = $('.modal-div-image').attr('data-old-logo');
            var imageContent = ' <img class="img-manage"  data-change="0" src="' + logo + '" onerror="ifBrokenLogo(this);"> ';
            $('.modal-div-image').html(imageContent);
        }
    });
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
        var name = $(this).attr('attr-name');
        var abbr = $(this).attr('attr-abbr');
        var status = $(this).attr('attr-status');
        var desc = $(this).attr('attr-desc');
        var type = $(this).attr('attr-type');
        var logo = $(this).parent('div').attr('data-logo');
        $('.modal-img-details').attr('src', logo);
        $('.modal-img-details').attr('onerror', 'ifBrokenLogo(this);');
        $('.lbl-agency_name').text(name);
        $('.lbl-agency_abbr').text(abbr);
        $('.lbl-agency_status').text(status);
        $('.lbl-agency_desc').text(desc);
        $('.lbl-agency_type').text(type);
        $('#mdl-view_agency').modal('show');
    });
    $('.div-agencies-list').delegate('.a-manage_agency', 'click', function (e) {

        clickManageAgencyDetail({
            id: $(this).attr('attr-id'),
            name: $(this).attr('attr-name'),
            abbr: $(this).attr('attr-abbr'),
            status: $(this).attr('attr-status'),
            desc: $(this).attr('attr-desc'),
            type: $(this).attr('attr-type'),
        });
        var logo = $(this).parent('div').attr('data-logo');
        var imageContent = ' <img class="img-manage"  data-change="0" src="' + logo + '" onerror="ifBrokenLogo(this);"> ';
        $('.modal-div-image').html(imageContent);
        $('.modal-div-image').attr('data-old-logo', logo);
    });



    // for searching keyword 
    $('#txt_search_agency_list').on('keypress', function (e) {
        if (e.which == 13) {
            getAgencyList();
        }
    });
    $('#txt_search_agency_list').change(function () {
        setTimeout(function () {
            getAgencyList();
        }, 500);
    });

    $('.sel-filter').change(function () {
        setTimeout(function () {
            getAgencyList();
        }, 500);
    });

    $('.sel-search_by').change(function () {
        getAgencyList();
    });

    $('.sel-orderby').change(function () {
        getAgencyList();
    });


    $('.div-agencies-list').delegate('.view_more', 'click', function () {
        var id = $(this).attr('attr-id');
        $('#summary-desc_' + id).addClass('hide');
        $('#full-desc_' + id).removeClass('hide');
    });
    $('.div-agencies-list').delegate('.view_less', 'click', function () {
        var id = $(this).attr('attr-id');
        $('#summary-desc_' + id).removeClass('hide');
        $('#full-desc_' + id).addClass('hide');
    });
    $('#frm-UpdateAgency').validate({
        rules: {
            txt_name: {required: true},
            txt_abbr: {required: true},
            sel_category: {required: true},
            area_desc: {required: true},
//            validatelogo: {required: true}
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

            $('.h5-title').html("Confirmation");
            var body = '';
            body += '<div class="text-center">';
            body += 'Click "Save" to continue';
            body += '</div>';
            $('.msgmodal-body').html(body);
            var footer = '  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>';
            footer += '<button type="button" class="btn btn-primary modal-button-save" id="btn-save_update">Save</button>';
            $('.msgmodal-footer').html(footer);
            $('.close').hide();
            $('#msgmodal').modal('show');
        }
    });

    $('#btn-save_manage').click(function () {
        $('#frm-UpdateAgency').submit();
    });

    $('#msgmodal').delegate('#btn-save_update', 'click', function () {
        var isChanged = $('.img-manage').attr('data-change');
        if (isChanged == "1") {
            copyAgencyLogoToDrive();
        } else {
            setAgencyDetails();
        }
    });

    // ini chosen select
    $('.chosen-select').chosen();

    // pagination
    $('.rs-pagination').delegate('.page-link', 'click', function () {
        var page = parseInt($(this).attr('data-page'));
        getAgencyList(page);
    });

});
