function loadBrowseImage(thisFile, mime) {

    //check file original type
    var org_type = mime.split("|");
    if (org_type[0] == org_type[1]) {
        //this is the original file type
        if (thisFile.files[0].size > 5249494) {
            icmsMessage({
                type: "msgWarning",
                body: "Please select 5MB image size or lower",
                onHide: function () {
                    $('#imageselect').val('');
                }
            });
            var imgTxt = '';
            imgTxt += '<div class="card-body text-center" style="padding: 50px 20px;" id="fileupload_div">';
            imgTxt += '     <i class="fas fa-upload text-gray-500"></i><br>';
            imgTxt += '     <span class="small text-gray-500 mgn-T-18">Choose file to upload.<br>(5MB max. image size)</span>';
            imgTxt += '</div>';
            $('.div-image').html(imgTxt);
        } else {
            var input = thisFile;
            var url = $(thisFile).val();
            var ext = url.substring(url.lastIndexOf('.') + 1);
            if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg"))
            {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.div-image').html("<div class='card-body text-center' style='padding: 30px 20px;'><img class='img-agency shadow'  style='height:110px; width: 130px; ' src='" + e.target.result + "' /></div>");

                }
                reader.readAsDataURL(input.files[0]);
            } else
            {
                $('.div-image').html(" <div class='card-body text-center' style='padding: 50px 20px;'> <i class='fas fa-upload text-gray-500'></i><br><span class='small text-gray-500 mgn-T-18'>Click choose file button to select image.</span>");
            }
        }
    } else {
        icmsMessage({
            type: "msgWarning",
//            body: "<center>Invalid file type.<br><br>(<small>This was originally <b>"+org_type[0]+"</b> and was renamed to <b>"+org_type[1]+"</b></small>)</center>",
            body: "<center>There was an upload error.<br><br>Make sure  to upload a JPG, JPEG or PNG and try again</center>",
            onHide: function () {
                $('#imageselect').val('');
            }
        });
        var imgTxt = '';
        imgTxt += '<div class="card-body text-center" style="padding: 50px 20px;" id="fileupload_div">';
        imgTxt += '     <i class="fas fa-upload text-gray-500"></i><br>';
        imgTxt += '     <span class="small text-gray-500 mgn-T-18">Choose file to upload.<br>(5MB max. image size)</span>';
        imgTxt += '</div>';
        $('.div-image').html(imgTxt);
    }
}

function confirmedSaveAgency() {
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
            var fileHash = rs.data.output.hash;
            addAgencyType(fileHash);
        },
        error: function () {
            //do nothing
        }

    });
}


function getAgencyType() {
    $.post(sAjaxGlobalData, {
        type: "getAgencyTypesCategory"
    }, function (rs) {
        l = "<option disabled>Select Category</option>";
        $.each(rs.data, function (key, val) {
            l += "<option value='" + val.parameter_count_id + "'>" + val.parameter_name + "</option>";
        });
        $('#sel-category').html(l);
    }, 'json');
}


$.validator.addMethod("agn_exist", function (value, element) {
    var is_exist = $('#txt-agn-name').attr('data-exist');
    if (is_exist == "1") {
        return false;
    } else {
        return true;
    }
}, "Agency name is already exist");

$('#frm-add-agency').validate({
    rules: {
        txt_name: {
            required: true,
            agn_exist: true},
        txt_abbr: {required: true},
        sel_category: {required: true},
        area_desc: {required: true},
        imageselect: {required: true}
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
            title: "You are about to add new agency.<br>Click save button if you wish to continue.",
            onConfirm: function () {
                icmsMessage({
                    type: "msgPreloader",
                    visible: true
                });

                //confirmedSaveAgency();
                var imgSrc = $('#logo-preview').attr('src');
                $.post(sDriveAPI, {
                    type: 'uploadCropImage',
                    image_source: imgSrc
                }, function (rs) {
                    if (rs.data.flag == 1) {
                        var logo_hash = rs.data.output.hash;
                        addAgencyType(logo_hash);
                    } else {
                        alert('Something went wrong. Kindly try to reupload your logo');
                        location.reload();
                    }
                }, 'json');
            }
        });

    }
});


function addAgencyType(hash) {

    var hash = hash;
    var agencyname = $('#txt-agn-name').val();
    var abbr = $('#text-agn-abbr').val().toUpperCase();
    var category = $('#sel-category').val();
    var description = $('#description').val();
    $.post(sAjaxAgencies, {
        type: "addAgencyType",
        hash: hash,
        agencyname: agencyname,
        abbr: abbr,
        category: category,
        description: description,
    }, function (rs) {
        if (rs.data.php_validation.flag == "0") {
            icmsMessage({
                type: "msgWarning",
                body: "Please check your inputs"
            });

        } else {
            icmsMessage({
                type: "msgSuccess",
                body: "You have successfully added an agency",
                link: {
                    link: "agencies",
                    content: "Go to Agency List"
                },
                onShow: function () {
                    resetFields();
                }
            });
        }

    }, 'json');
}
function resetFields() {
    $('#txt-agn-name').val("");
    $('#text-agn-abbr').val("");
    $('#sel-category').val("");
    $('#description').val("");
    $('.div-image').html(" <div class='card-body text-center' style='padding: 50px 20px;'> <i class='fas fa-upload text-gray-500'></i><br><span class='small text-gray-500 mgn-T-18'>Click choose file button to select image.</span>");
    $("#imageselect").val('');
}

$(document).ready(function () {

    getAgencyType();


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
        $uploadCrop.croppie('bind', {
            url: rawImg
        }).then(function () {
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
            $('#fileupload_preview').show();
            $('#fileupload_div').hide();
            $('#cropImagePop').modal('hide');
            $('#logo-preview').attr('src', imgSrc);
        });
    });

    $('#cropImagePop .btn-cancel').click(function () {
        setTimeout(function () {
            $('#mdl-manage_agency').modal('show');
        }, 500);
    });

//    //change logo display
//    $("input[type=file]").on('change', function () {
//        console.log('sadsad'); 
//        var thisFile = this;
//        loadMime(this.files[0], function (mime) {
//            loadBrowseImage(thisFile, mime);
//        });
//    });

    $('.btn_save_agency').click(function () {
        $('#frm-add-agency').submit();
    });

    $('#text-agn-abbr').keypress(function (e) {
        if (parseInt(e.which) == 8 || (parseInt(e.which) >= 65 && parseInt(e.which) <= 90) || (parseInt(e.which) >= 97 && parseInt(e.which) <= 122)) {
            //do nothing
        } else {
            e.preventDefault();
        }
    });


    $('.div-image').click(function () {
        $('#imageselect').trigger('click');
    });

    $('.msgmodal-success-content').delegate('.btn-next', 'click', function () {
        $('#msgmodal-saving').modal('hide');
    });
    $('.msgmodal-success-content').delegate('.btn-agency_list', 'click', function () {
        window.location.href = "agency_branch";
    });
    $('#text-agn-abbr').on('change', function () {

    });
    $('#txt-agn-name').on('change', function () {
        var orgVal = $(this).val();
        $(this).val(orgVal.replace(/[^\w\s]/gi, ''))


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



    $('#description').keyup(function (event) {
        if ($(this).val().substring(0, 1) == " ") {
            $(this).val($(this).val().trim());
        }
        $(this).val($(this).val().substring(0, 1000));
    });
    $('#description').change(function (event) {
        $(this).val($(this).val().substring(0, 1000));
        console.log($(this).val().length)
    });
});

