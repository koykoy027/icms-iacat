
$(document).ready(function () {
    getCaseCountPerUser();
    getUserActivityLogs(1);

    //  password strength
    // $("#pw-new").passwordStrength();

    //change picture display
    $("input[type=file]").on('change', function () {
        var input = this;
        var url = $(this).val();
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.div-image').html("<div class='card-body'   style='padding: 15px 10px;'><img  class='imagePrev'  style='height:95px; width: 100px; border-radius:50%;' src='" + e.target.result + "' /></div>");

            }
            reader.readAsDataURL(input.files[0]);
        } else {
            $('.div-image').html('<div class="card-body "   style="padding: 15px 10px;"> <img class="imagePrev" src="" onerror="ifBrokenProfile(this);"  style="height:95px; width: 100px; border-radius:50%;"> </div>');
        }
    });

    $('.btn-select-upload').click(function () {
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
                var fileHash = rs.data.output.hash;
                addProfilePhoto(fileHash);
            },
            error: function () {
                //something went wrong
            }

        });
    });


    $('.btn-change-pw').click(function () {

        $('.lbl-show-hide-new').text("show");
        $('.lbl-show-hide-new').attr('data-stat', '1');
        $('#pw-new').attr("type", "password");
        $('#pw-new').attr("placeholder", "••••••••");


        $('.lbl-show-hide-new-confirm').text("show");
        $('.lbl-show-hide-new-confirm').attr('data-stat', '1');
        $('#pw-conform_new').attr("type", "password");
        $('#pw-conform_new').attr("placeholder", "••••••••");


        $('.lbl-show-hide-current').text("show");
        $('.lbl-show-hide-current').attr('data-stat', '1');
        $('#pw-cur').attr("type", "password");
        $('#pw-cur').attr("placeholder", "••••••••");

        $("#pw-new-error-password-validate").text("");
        $('#mdl-change-pw').modal('show');
        resetForm();
    });

    $('.row-images').delegate('.icn-chk', 'click', function () {
        var id = $(this).attr('data-id');
        setPhotoAsPrimary(id);
    });

    $('.row-images').delegate('.icn-x', 'click', function () {
        var id = $(this).attr('data-id');
        $('.h5-title').html("Confirmation");
        $('.msgmodal-body').html('Click "Remove" to delete');
        var footer = '<button type="button" class="btn btn-secondary btn-remove" data-id="' + id + '">Remove</button>';
        footer += '  <button type="button" class="btn btn-secondary btn-cancel">Cancel</button>';
        $('.msgmodal-footer').html(footer);
        $('#msgmodal').modal('show');
        $('#mdl-profile-change').modal('hide');
    });

    $('#msgmodal').delegate('.btn-cancel', 'click', function () {
        $('#msgmodal').modal('hide');
        $('#mdl-profile-change').modal('show');
    });
    $('#msgmodal').delegate('.btn-remove', 'click', function () {
        var id = $(this).attr('data-id');
        $('.h5-title').html("Processing");
        $('.msgmodal-body').html('Please wait . . .');
        $('.msgmodal-footer').html("");

        $.post(sAjaxAccSettings, {
            type: "removePicture",
            id: id,
        }, function (rs) {
            $('.h5-title').html("Result");
            $('.msgmodal-body').html('Profile picture was successfully deleted');
            $('.msgmodal-footer').html('<button type="button" class="btn btn-secondary btn-cancel">Close</button>');
            getProfilePhoto();
        }, 'json');
    });

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
            $('#pw-new').attr("type", "password")
            $('#pw-new').attr("placeholder", "••••••••")
        }
    });

    $('.lbl-show-hide-new-confirm').click(function () {
        var stat = $(this).attr('data-stat');
        if (stat == "1") {
            $(this).text("hide");
            $(this).attr('data-stat', '0');
            $('#pw-conform_new').attr("type", "text");
            $('#pw-conform_new').attr("placeholder", "password")
        } else {
            $(this).text("show");
            $(this).attr('data-stat', '1');
            $('#pw-conform_new').attr("type", "password")
            $('#pw-conform_new').attr("placeholder", "••••••••")
        }
    });

    $('.lbl-show-hide-current').click(function () {
        var stat = $(this).attr('data-stat');
        if (stat == "1") {
            $(this).text("hide");
            $(this).attr('data-stat', '0');
            $('#pw-cur').attr("type", "text");
            $('#pw-cur').attr("placeholder", "password")
        } else {
            $(this).text("show");
            $(this).attr('data-stat', '1');
            $('#pw-cur').attr("type", "password")
            $('#pw-cur').attr("placeholder", "••••••••")
        }
    });

    $('.btn-save').click(function () {
        $('#frm-change-password').submit();
    });

    $('.btn-select-pic').click(function () {
        $('#imageselect').click();
    });


    $('#msgmodal').delegate('.btn-cancel-change', 'click', function () {
        $('#mdl-change-pw').modal('show');
        $('#msgmodal').modal('hide');
    });

    $('.change-pic').click(function () {
        getProfilePhoto();
    });

    $('.img-accnt-profile').click(function () {
        var src = $(this).attr('src');
        $('.wide-image').attr('src', src);
        $('#mdl-view-wide-image').modal("show");
    });

    $('.row-images').delegate('.img_thumb', 'click', function () {
        var src = $(this).attr('src');
        $('.wide-image').attr('src', src);
        $('#mdl-view-wide-image').modal("show");
    });

    $('.div-image').delegate('.imagePrev', 'click', function () {
        var src = $(this).attr('src');
        $('.wide-image').attr('src', src);
        $('#mdl-view-wide-image').modal("show");
    });


    $('#activity_log_container').bind('scroll', function () {
        if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            if ($('#activity_log_content').attr('datapageend') == "0") {
                var page = $('#activity_log_content').attr('datapage');
                page = parseInt(page) + 1;
                $('#activity_log_content').attr('datapage', page);
                getUserActivityLogs(page);
            }

        }
    });
});

$('#frm-change-password').validate({
    rules: {
        currentpassword: {
            required: true,
            minlength: "0",
        },
        newpassword: {
            required: true,
            minlength: "8",
        },
        confirm_newpassword: {
            equalTo: '#pw-new'
        }
    },
    messages: {
        confirm_newpassword: {
            equalTo: "Confirm password doesn't match."
        }
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
    
                    $.post(sAjaxAccess, {
                        type: "setPersonalPassword",
                        old_pwd: $('#pw-cur').val(),
                        new_pwd: $('#pw-new').val(),
                    }, function (rs) {
                        if (rs.data.php_validation.flag == "1") {
                            if (rs.data.result == "1") {
    
                                icmsMessage({
                                    type: 'msgSuccess',
                                    body: 'Password was successfully Changed.',
                                    onShow: function () {
                                        $('#pw-cur').val("");
                                        $('#pw-new').val("");
                                        $('#pw-conform_new').val("");
                                    }
                                });
    
                            } else {
    
                                icmsMessage({
                                    type: 'msgWarning',
                                    body: 'Current Password mismatched!',
                                    onHide: function () {
                                        $('#mdl-change-pw').modal('show');
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

function addProfilePhoto(fileHash) {
    $.post(sAjaxAccSettings, {
        type: "addProfilePhoto",
        fileHash: fileHash,
    }, function (rs) {
        var src = sDriveViewer + fileHash;
        $('.img-accnt-profile').attr("src", src);
        $('.user-profile-pic').attr("src", src);
        $('.img-nav-pic').attr("src", src);
        $('.div-image').html('<div class="card-body " style="padding: 15px 10px;";> <img class="imagePrev" src="" onerror="ifBrokenProfile(this);" style="height: 60px; width: 60px;border-radius:50%;"> </div>');
        getProfilePhoto();
    }, 'json');
}

function getProfilePhoto() {
    $.post(sAjaxAccSettings, {
        type: "getProfilePhoto"
    }, function (rs) {
        var l = "";
        if (rs.data.result == "1") {
            $.each(rs.data.profile, function (key, val) {
                l += '<div class="col" style="text-align:center">';
                l += '      <img class="img_thumb" src="' + sDriveViewer + val.document_hash + '" onerror="ifBrokenProfile(this);">';
                l += '      <br>';
                var active = "";

                if (val.image_upload_is_primary == "1") {
                    l += '    <span  style="color:#356397;font-family: source sans pro;">Active</span>';
                } else {
                    l += '      <span class="icn-x" data-id="' + val.image_upload_id + '"><i class="fa fa-times"  aria-hidden="true"></i></span>';
                    l += '      <span class="icn-chk" data-id="' + val.image_upload_id + '"><i class="fa fa-check" aria-hidden="true"></i></span>';

                }

                l += '</div>';
            });
            $('.row-images').html(l);
        } else {
            //no record
        }

        $('#mdl-profile-change').modal('show');

    }, 'json');
}

function setPhotoAsPrimary(id) {
    $.post(sAjaxAccSettings, {
        type: "setPhotoAsPrimary",
        id: id,
    }, function (rs) {
        var src = sDriveViewer + rs.data;
        $('.img-accnt-profile').attr("src", src);
        $('.user-profile-pic').attr("src", src);
        $('.img-nav-pic').attr("src", src);
        $('.div-image').html('<div class="card-body style="    padding: 10px;"> <img class="imagePrev" src="" onerror="ifBrokenProfile(this);" style="height:95px; width: 100px; border-radius: 50%;"> </div>');
        getProfilePhoto();
    }, 'json');
}

function getCaseCountPerUser() {
    $.post(sAjaxAccSettings, {
        type: "getCaseCountPerUser",
    }, function (rs) {
        $('.active-case-count').html(rs.data.active);
        $('.added-case-count').html(rs.data.added);
    }, 'json');
}

function getUserActivityLogs(page) {
    var limit_count = 10;
    var limit_start = (page * limit_count) - limit_count;
    $.post(sAjaxAccSettings, {
        type: "getUserActivityLogs",
        limit_start: limit_start,
        limit_count: limit_count,
    }, function (rs) {

        if (rs.data.result.count >= 1) {
            var list = "";

            $.each(rs.data.result.list, function (key, val) {
                var sDate = val.user_log_date_added.split(" ");

                list += '<div class="row form-row">';
//                list += '   <div class="col-2">';
//                if (parseInt(val.changes.count) >= 1) {
//                    list += '<i class="fas fa-user-edit mgn-L-15" style="font-size: 20px; color: #e88f15;"></i>';
//                } else {
//                    list += '<i class="fas fa-user-circle mgn-L-15" style=" font-size: 20px! important ;color: #015176; font-weight: 600;"></i>';
//                }
//                list += '   </div> ';

                list += '   <div class="col-lg-6 col-md-6 col-sm-6">';
                list += '       <div class="text-center">';
                list += '            <span class=" date-frmt-text">' + dateViewingFormat(sDate[0]) + '</span><br>';
                list += '            <span class=" time-frmt-text">' + localTime(sDate[1]) + '</span>';
                list += '       </div>';
                list += '   </div> ';

                list += '    <div class="col-lg-6 col-md-6 col-sm-6">';
                list += '       <div class="text-center">';
                list += '           <span class="text-normal">' + val.user_log_message + '</span> <br> ';
                if (parseInt(val.changes.count) >= 1) {
                    var toJson = JSON.stringify(val.changes.list);
                    var encrypt = btoa(toJson);
                    list += '           <span class="text-normal"><small><a data-updated=' + encrypt + ' style="color: #007bff;text-decoration: none;cursor:pointer;background-color: transparent" class="a-log-view-details">View Details</a></small></span>';
                }
                list += '       </div> ';
                list += '   </div> ';

                list += '</div><hr>';

            });
            $('#activity_log_content').append(list);
            if (rs.data.result.count <= (page * limit_count) && rs.data.result.count >= limit_start) {
                $('#activity_log_content').attr('datapageend', 1);
                $('#activity_log_content').append("<center>End of user logs</center>");
            }
        } else {
            if ($('#activity_log_content').attr('datapageend') == "0") {
                $('#activity_log_content').html("No Logs Found");
            } else {
                $('#activity_log_content').append("<center>End of user logs</center>");
            }
            $('#activity_log_content').attr('datapageend', 1);

        }

    }, 'json');
}

$('#activity_log_content').delegate('.a-log-view-details', 'click', function () {
    var frJson = $(this).attr('data-updated');
    var decrypt = atob(frJson);
    var newVal = JSON.parse(decrypt);
    var details = "";

    $.each(newVal, function (key, val) {
        details += "<div class='row'>";
        details += "    <div class='col-lg-12 col-md-12 col-sm-12'><b>Label : </b>" + val.user_log_update_field_name;
        details += "    <b><br>From : </b>" + val.user_log_update_old_parameter;
        details += "                     <br><b>To :</b> " + val.user_log_update_new_parameter + "</div>";
        details += "</div><hr>";
    });



    $('.h5-title').html("<h5 class='modal-title h5-title msgmodal-header'>Log Details</h5>");
    //    $('.modal-header').html("    <h5 class='modal-title h5-title msgmodal-header'>Log Details</h5> ");
    //    $('.small-desc').html("<small class ='content-sub-title' style = 'margin-left: 7%;'> Updated Information </small>");

    $('.msgmodal-body').html("<div style='max-height: 250px;    overflow: scroll;'>" + details + "</div>");
    var footer = '  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>';
    $('.msgmodal-footer').html(footer);
    $('#msgmodal').modal('show');
});