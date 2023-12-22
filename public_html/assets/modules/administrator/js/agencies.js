
function loadBrowseImage(thisFile, mime) {
    //check file original type
    var org_type = mime.split("|");
    if (org_type[0] == org_type[1]) {
        if (thisFile.files[0].size > 5249494) {
            $('#mdl-manage_agency').modal('hide');
            icmsMessage({
                type: "msgWarning",
                body: "Please select 5MB image size or lower",
                onHide: function () {
                    $('#imageselect').val('');
                    $('#mdl-manage_agency').modal('show');
                }
            });
            var logo = $('.modal-div-image').attr('data-old-logo');
            var imageContent = ' <img class="img-manage"  data-change="0" src="' + logo + '" onerror="ifBrokenLogo(this);"> ';
            $('.modal-div-image').html(imageContent);
        } else {
            var input = thisFile;
            var url = $(thisFile).val();
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
        }

    } else {
        $('#mdl-manage_agency').modal('hide');
        icmsMessage({
            type: "msgWarning",
            body: "<center>Invalid file type.<br><br>(<small>This was originally <b>" + org_type[0] + "</b> and was renamed to <b>" + org_type[1] + "</b></small>)</center>",
            onHide: function () {
                $('#imageselect').val('');
                $('#mdl-manage_agency').modal('show');
            }
        });
        var logo = $('.modal-div-image').attr('data-old-logo');
        var imageContent = ' <img class="img-manage"  data-change="0" src="' + logo + '" onerror="ifBrokenLogo(this);"> ';
        $('.modal-div-image').html(imageContent);
    }

}


function copyAgencyLogoToDrive() {
    var data = new FormData();
    var file = document.getElementById("imageselect").files;
    var uploadURL = window.location.origin + '/ajax/drive/ajax';
    data.append('file', file[0]);
    data.append('type', 'uploadFile');
    $.ajax({
        xhr: function () {
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
        $('.img-manage').attr('src', sDriveViewer + imageHash);
        icmsMessage({
            type: 'msgSuccess',
            body: 'Agency was successfully updated.',
            onHide: function () {
                getAgencyList();
                setTimeout(function () {
                    $('#mdl-manage_agency').modal('show');
                }, 500);
            }
        });
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

        if (rs.data.php_validation.flag == "0") {

            icmsMessage({
                type: 'msgError',
                onHide: function () {
                    location.reload('true');
                }
            });

        } else {
            if (rs.data.result.flag != '0' || imageHash !== "") {

                icmsMessage({
                    type: 'msgPreloader',
                    visible: false
                });

                icmsMessage({
                    type: 'msgSuccess',
                    body: 'Agency was successfully updated.',
                    onShow: function () {
                        getAgencyList();
                        changeReset();
                    }
                });

            } else {
                icmsMessage({
                    type: 'msgWarning',
                    body: 'No changes were made.'
                });
            }
        }
    }, 'json');
}
function clickManageAgencyDetail(aParam) {
    $('#mdl-view_agency').modal('hide');
    $('#btn-save_manage').attr('data-id', aParam.id);
    $('#txt-agn-name').val(aParam.name);
    $('#txt-agn-name').attr('oldval', aParam.name);
    $('#text-agn-abbr').val(aParam.abbr);
    $('#sel-category').val(aParam.type).change();
    $('#description').val(aParam.desc);
    $('#sel-status').val(aParam.status).change();
    $('#mdl-manage_agency').modal('show');
    $('.closeUpdate').attr('changes', '0');
}
function buildAgencyList(rs) {
    var tbl = "";
    $.each(rs.data.content.listing, function (key, val) {
        $('#agency_listing').show();
        $('#agency_listing-no-content').remove();

        var stat = "<span class='badge_cc'></span><span class='stat_'>Active</span>";
        var sStat = 'Active';
        if (val.agency_is_active == '0') {
            stat = "<span class='stat_inactive'>Inactive</span>";
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
        tbl += '          <div class="card" >';
        tbl += '                <div class="row">';
        tbl += '                  <div class="col-lg-8 col-md-6 col-sm-6 a-view_agency "  attr-id = "' + val.agency_id + '" data-toggle="modal" data-target="#mdl-view_agency" >';
        tbl += '                      <div class="row nav-data_list">';
        tbl += '                          <div class="col-lg-2 col-md-4 col-sm-4 data_list_img">';
        tbl += '                                 <div class="img_content" >';
        tbl += '                                      <img src="' + sDriveViewer + val.photo + '" onerror="ifBrokenLogo(this);" > ';
        tbl += '                                   </div>';
        tbl += '                          </div>';
        tbl += '                          <div class="col-lg-10 col-md-8 col-sm-8 test2 desc_content py-3">';
        tbl += '                                <span class="desc_name" >  ' + val.agency_name + '  <span class="desc_abbr">(' + val.agency_abbr + ')</span></span> <br>';
        tbl += '                                <span class="desc_sub_name"> ' + val.govt_agency_type_category_name + '</span><br>';
        tbl += '                          </div>';
        tbl += '                      </div>';
        tbl += '                   </div>';
//        tbl += '                  <div class="col-lg-2 col-md-3 col-sm-3 py-3 txt-align_center toggle_actions" data-toggle="modal" data-target="#mdl-view_agency" >';
        tbl += '                  <div class="col-lg-2 col-md-3 col-sm-3 py-3  "  >';
        tbl += stat;
        tbl += '                  </div>';
        tbl += '                            <div class="col-lg-2 col-md-3 col-sm-3 py-2 px-0 txt-align_center toggle_actions">';
        tbl += '                                <div class="btn-group ellipse-action " data-id="' + val.agency_id + '">';
        tbl += '                                    <a class="a-ellipse a-ellipse-' + val.agency_id + '  action_btn "> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </a>';
        tbl += '                                    <div class="action-menu" data-cur-stat="' + val.agency_is_active + '"  id="id-' + val.agency_id + '" data-logo="' + sDriveViewer + val.photo + '">';
        tbl += '                                          <a class="dropdown-item disabled action-title" href="#">Select Action</a>';
        tbl += '                                          <a class="dropdown-item a-view_agency id-' + val.agency_id + '" attr-id= "' + val.agency_id + '"  attr-type="' + val.govt_agency_type_category_name + '" attr-name= "' + val.agency_name + '"  attr-status ="' + stat + '" attr-abbr= "' + val.agency_abbr + '"  attr-desc= "' + val.agency_description + '" >View Agency Details</a>';
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
    var aStatus = [];
    var aCategory = [];
    var orderby = [];

    $.each($("input[name='status']:checked"), function () {
        aStatus.push($(this).val());
    });
    $.each($("input[name='category']:checked"), function () {
        aCategory.push($(this).val());
    });
    $.each($("input[name='orderBy']:checked"), function () {
        orderby.push($(this).val());

    });
    aStatus = aStatus.join();
    orderby = orderby.join();
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

    $('#mdl-manage_agency input').change(function () {
        $('.closeUpdate').attr('changes', 1);
    });
    $('#mdl-manage_agency select').change(function () {
        $('.closeUpdate').attr('changes', 1);
    });
    $('#mdl-manage_agency textarea').change(function () {
        $('.closeUpdate').attr('changes', 1);
    });
    $('.div-image').click(function () {
        $('#imageselect').click();
    });

    var $uploadCrop,
            tempFilename,
            rawImg,
            imageId;

    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.upload-demo').addClass('ready');
                $('#cropImagePop').modal('show');
                rawImg = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            swal("Sorry - you're browser doesn't support the FileReader API");
        }
    }

    $uploadCrop = $('#upload-demo').croppie({
        viewport: {
            width: 250,
            height: 250,
        }
    });

    $('#cropImagePop').on('shown.bs.modal', function () {
        // alert('Shown pop');
        $uploadCrop.croppie('bind', {
            url: rawImg
        }).then(function () {
            console.log('jQuery bind complete');
            $('#mdl-manage_agency').modal('hide');
        });
    });

    $('.item-img').on('change', function () {
        imageId = $(this).data('id');
        tempFilename = $(this).val();
        $('#cancelCropBtn').data('id', imageId);
        readFile(this);
    });

    $('#cropImageBtn').on('click', function (ev) {
        $uploadCrop.croppie('result', {
            type: 'base64',
            format: 'jpeg',
            size: {width: 1000, height: 1000}
        }).then(function (imgSrc) {

            icmsMessage({
                type: 'msgConfirmation',
                title: 'You are about to update agency logo.',
                onConfirm: function () {

                    icmsMessage({
                        type: 'msgPreloader',
                        visible: true
                    });

                    $('#item-img-output').attr('src', imgSrc);
                    $('.img-manage').attr('src', imgSrc);

                    $('#cropImagePop').modal('hide');

                    $('#logo-container').attr('src', imgSrc);

                    $.post(sDriveAPI, {
                        type: 'uploadCropImage',
                        image_source: imgSrc
                    }, function (rs) {
                        if (rs.data.flag == 1) {
                            var logo_hash = rs.data.output.hash;
                            addAgencyLogo(logo_hash);
                        } else {
                            alert('Something went wrong. Kindly try to reupload your logo');
                            location.reload();
                        }
                    }, 'json');


                },
                onShow: function () {
                    $('#cropImagePop').modal('hide');
                },
                onCancel: function () {
                    $('#cropImagePop').modal('show');
                }
            });
        });
    });

    $('#cropImagePop .btn-cancel').click(function () {
        setTimeout(function () {
            $('#mdl-manage_agency').modal('show');
        }, 500);
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

    //action menu view
    $('.div-agencies-list').delegate('.a-view_agency', 'click', function (e) {
        var id = $(this).attr('attr-id');
        var name = $('.id-' + id).attr('attr-name');
        var abbr = $('.id-' + id).attr('attr-abbr');
        var status = $('.id-' + id).attr('attr-status');
        var desc = $('.id-' + id).attr('attr-desc');
        var type = $('.id-' + id).attr('attr-type');
        var logo = $('.id-' + id).parent('div').attr('data-logo');
        $('.modal-img-details').attr('src', logo);
        $('.modal-img-details').attr('onerror', 'ifBrokenLogo(this);');
        $('.agency_name').text(name + ' (' + abbr + ')');
        $('.agency_type').text(type);
        $('.agency_status').html(status);
        $('.lbl-agency_abbr').text(abbr);
        $('.lbl-agency_status').text(status);
        $('.lbl-agency_desc').text(desc);
        $('.lbl-agency_type').text(type);
        $('#mdl-view_agency').modal('show');
    });

    // action menu manage
    $('.div-agencies-list').delegate('.a-manage_agency', 'click', function (e) {

        // choose file 
        $('#imageselect').val('');

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

    $('#txt-agn-name').on('change', function () {
        var keyword = $(this).val();
        $.post(sAjaxAgencies, {
            type: "getAgencyNameByKeyword",
            keyword: keyword
        }, function (rs) {
            console.log(rs);
            if (rs.data.result == "1") {
                $('#txt-agn-name').attr('data-exist', 1);
            } else {
                $('#txt-agn-name').attr('data-exist', 0);
            }
        }, 'json');
    });

    $.validator.addMethod("agn_exist", function (value, element) {
        var is_exist = $('#txt-agn-name').attr('data-exist');
        var oldval = $('#txt-agn-name').attr('oldval');
        if (is_exist == "1" && (oldval.trim().toLowerCase() !== value.trim().toLowerCase())) {
            return false;
        } else {
            return true;
        }
    }, "Agency name is already exist");

    $('#frm-UpdateAgency').validate({
        rules: {
            txt_name: {required: true, agn_exist: true},
            txt_abbr: {required: true},
            sel_category: {required: true},
            area_desc: {required: true, maxlength: 1000},
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
            icmsMessage({
                type: 'msgConfirmation',
                title: 'You are about to update agency details.',
                onConfirm: function () {

                    icmsMessage({
                        type: 'msgPreloader',
                        visible: true
                    });

                    var isChanged = $('.img-manage').attr('data-change');
                    if (isChanged == "1") {
                        copyAgencyLogoToDrive();
                    } else {
                        setAgencyDetails();
                    }

                },
                onShow: function () {
                    $('#mdl-manage_agency').modal('hide');
                },
                onCancel: function () {
                    setTimeout(function () {
                        $('#mdl-manage_agency').modal('show');
                    }, 500);
                }
            });
        }
    });

    $('#btn-save_manage').click(function () {
        $('#frm-UpdateAgency').submit();
    });


    // ini chosen select
    $('.chosen-select').chosen();

    // pagination
    $('.rs-pagination').delegate('.page-link', 'click', function () {
        var page = parseInt($(this).attr('data-page'));
        getAgencyList(page);
    });


    $('.btn-filter_list').click(function () {
        setTimeout(function () {
            getAgencyList();

        }, 100);
    });
    $('.btn-filter_clear').click(function () {
        $('.chk-filter').prop('checked', false);
        setTimeout(function () {
            getAgencyList();
        }, 100);

    });

    $('#msgmodal-warning').delegate('.msgmodal-warning-footer', 'click', function () {
        $('.btn-close-warning-modal').click();
    });

    $('#description').keypress(function (event) {
        if (this.value.length >= 1000) {
            $(this).val($(this).val().substring(0, 1000));
            event.preventDefault();
        }
    });

    $('#description').bind('copy paste cut', function (e) {

        if (this.value.length >= 1000) {
            $(this).val($(this).val().substring(0, 1000));
            event.preventDefault();
        }
    });
});