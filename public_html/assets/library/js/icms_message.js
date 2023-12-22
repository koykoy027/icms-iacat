
function icmsMessage(x) {
    $('#icmsMessage').remove();
    $('footer').prepend('<div id="icmsMessage"></div>');
    if (x.type) {

        // remove modal backdrop
        $('.modal-backdrop').remove();
        // remove modal backdrop
//        var iCount = $('.modal-backdrop').length;
//        if (iCount > 1) {
//            $('.modal-backdrop').last().remove();
//        }


        var l = '';
        switch (x.type) {
            case 'msgError':

                // default body content
                if (!x.body) {
                    x.body = 'Something went wrong.';
                }

                // build message content
                l = msgError(x);
                $('#icmsMessage').html(l);


                // ini call back
                getCallBack(x);

                break;

            case 'msgSuccess':

                // default body content
                if (!x.body) {
                    x.body = 'Successfully saved.';
                }

                // default link content
                if (!x.link) {
                    x.link = '';
                } else {
                    var content = '', link = '';
                    if (x.link.content) {
                        content = x.link.content;
                    }
                    if (x.link.link) {
                        link = x.link.link;
                    }
                    x.link = ' <a href="' + sAjaxUrl + '/' + link + '" class="blue btn-agency_list"> ' + content + ' </a> ';
                }

                // build message content
                l = msgSuccess(x);
                $('#icmsMessage').html(l);

                // ini call back
                getCallBack(x);


                break;

            case 'msgPreloader':

                if (x.visible === true) {
                    // default  content
                    if (!x.body) {
                        x.body = 'Please wait while saving information.';
                    }

                    // build message content
                    l = msgPreloader(x);
                    $('#icmsMessage').html(l);

                    // ini call back
                    getCallBack(x);
                }

                if (x.visible === false) {
                    // Hide Modal
                    $('#' + x.type).modal('hide');
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');
                }



                break;

            case 'msgWarning':

                // default  content
                if (!x.body) {
                    x.body = 'Something went wrong.';
                }

                if (!x.caption) {
                    x.caption = "Back";
                }
                // build message content
                l = msgWarning(x);
                $('#icmsMessage').html(l);

                // ini call back
                getCallBack(x);


                break;

            case 'msgConfirmation':

                // default  title
                if (!x.title) {
                    x.title = 'You are about to save this information.';
                }

                // default  content
                if (!x.body) {
                    x.body = 'Click save button if you wish to continue.';
                }

                // defaul label confirm 
                if (!x.LblBtnConfirm) {
                    x.LblBtnConfirm = 'Save';
                }

                // defaul label confirm 
                if (!x.LblBtnCancel) {
                    x.LblBtnCancel = 'Cancel';
                }

                // build message content
                l = msgConfirmation(x);
                $('#icmsMessage').html(l);

                // ini call back
                getCallBack(x);


                break;

            default:
                alert("Type doesn't exist.");
        }

    } else {
        alert("Something went wrong. Please check your parameters");
    }

}

function getCallBack(x) {

    // remove padding-right in body
    $('body').css("padding-right", "");

    // onHide 
    if (x.onHide) {
        $("#" + x.type).on('hide.bs.modal', function () {
            x.onHide();
            x.onHide = function () {
            };
        });
    }

    // onShow
    if (x.onShow) {
        $("#" + x.type).on('show.bs.modal', function () {
            x.onShow();
            x.onShow = function () {
            };
        });
    }

    // click confirm
    if (x.onConfirm) {
        $('#icmsMessage').delegate('#msgConfirmation-confirm', 'click', function () {
            x.onConfirm();
            x.onConfirm = function () {
            };
            x = defaultValue();
        });
    }

    // click cancel
    if (x.onCancel) {
        $('#icmsMessage').delegate('#msgConfirmation-cancel', 'click', function () {
            x.onCancel();
            x.onCancel = function () {
            };
            x = defaultValue();
        });
    }

    // Show Modal
    $('#' + x.type).modal('show', );



}

function defaultValue() {
    x = {
        type: '',
        body: '',
        title: '',
        link: {
            content: '',
            link: ''
        },
        onConfirm: function () {
        },
        onCancel: function () {
        },
        onShow: function () {
        },
        onHide: function () {
        }
    };
    return x;
}

function msgError(x) {
    var l = '';
    l += '<div class="modal" id="msgError" tabindex="-1" role="dialog"  aria-hidden="true">';
    l += '    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">';
    l += '        <div class="modal-content">';
    l += '            <div class="modal-header p-0 msgmodal-error-header mb-0 pt-3" style="margin: 0 auto !important;">';
    l += '                <div class="modal-body  msgmodal-error-body" id="modal-body-update"  style="margin: 0 auto !important;">';
    l += '                    <div class="row">';
    l += '                        <div class="col-12 text-center">';
    l += '                            <span class="notif-title center">ERROR</span> <br> ';
    l += '                            <p class="mt-3 center">' + x.body + '</p>';
    l += '                        </div>';
    l += '                    </div>';
    l += '                </div>';
    l += '            </div>';
    l += '            <div class="modal-footer msgmodal-error-footer m-footer p-2" data-dismiss="modal"> ';
    l += '                <button type="button" class="btn btn-close-warning-modal" >Close</button>';
    l += '            </div>';
    l += '        </div>';
    l += '    </div>';
    l += '</div> ';
    return l;
}

function msgSuccess(x) {
    var l = '';
    l += '<div class="modal fade " id="msgSuccess"  tabindex="-1" role="dialog"  aria-hidden="true">';
    l += '    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">';
    l += '        <div class="modal-content" >';
    l += '            <div class="modal-content msgmodal-success-content">';
    l += '                <div class="modal-body msgmodal-success-body m-body text-center p-5">';
    l += '                    <div class="success-checkmark">';
    l += '                        <div class="check-icon">';
    l += '                            <span class="icon-line line-tip"></span>';
    l += '                            <span class="icon-line line-long"></span>';
    l += '                            <div class="icon-circle"></div>';
    l += '                            <div class="icon-fix"></div>';
    l += '                        </div>';
    l += '                    </div>';
    l += '                    <p  class="sub-content-confirm p2 text-center">' + x.body + '</p>';
    l += '                    ' + x.link + '';
    l += '                </div>';
    l += '                <div class="modal-footer msgmodal-success-footer m-footer shadow" style="background: #dee2e6;"> ';
    l += '                    <div class="msg-saving-footer text-center">';
    l += '                        <button type="submit" class="btn btn-primary-orange btn-next " data-dismiss="modal" >Close</button>';
    l += '                    </div>';
    l += '                </div>';
    l += '            </div>';
    l += '        </div>';
    l += '    </div> ';
    l += '</div>';
    return l;
}

function msgPreloader(x) {
    var l = '';
    l += '<div class="modal fade" id="msgPreloader"  tabindex="-1" role="dialog"  aria-hidden="true" data-backdrop="static">';
    l += '    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">';
    l += '        <div class="modal-content" >';
    l += '            <div class="modal-content shadow-sm">';
    l += '                <div class="modal-body msgmodal-saving-body m-body text-center">';
    l += '                    <p class="msgmodal-saving-header m-header ">   <span class="spinner-border text-warning" role="status">';
    l += '                            <span class="sr-only">Loading...</span>';
    l += '                        </span></p>';
    l += '                    <span class="sub-content-confirm p2">' + x.body + '</span>';
    l += '                </div>';
    l += '            </div>';
    l += '        </div>';
    l += '    </div> ';
    l += '</div>';
    return l;
}

function msgWarning(x) {

    var l = '';
    l += '<div class="modal fade  modal-warning" id="msgWarning"  tabindex="-1" role="dialog"  aria-hidden="true" data-backdrop="static" data-keyboard="false">';
    l += '    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">';
    l += '        <div class="modal-content">';
    l += '            <div class="modal-header p-0 msgmodal-error-header mb-0 pt-3" style="margin: 0 auto !important;">';
    l += '                <div class="modal-body  msgmodal-warning-body" id="modal-body-update">';
    l += '                    <div class="row">';
    l += '                        <div class="col-12">';
    l += '                            <div class="text-center">';
    l += '                                <span class="notif-title">WARNING</span<br> ';
    l += '                            </div>';
    l += "                            <p class='mt-3' id='warning-msg'>" + x.body + "</p>";
    l += '                        </div>';
    l += '                    </div>';
    l += '                </div>';
    l += '            </div>';
    l += '            <button type="button" class="btn btn-close-warning-modal" data-dismiss="modal" p-0 m-auto style="margin:-1px; padding:0;">';
    l += '            <div class="modal-footer msgmodal-warning-footer m-footer pt-2" id="msgmodal-warning-footer"> ';
    l += '                  <span class="m-auto" style="color:#fff;" > ' + x.caption + ' </span>';
//    l += '                <button type="button" class="btn btn-close-warning-modal" data-dismiss="modal" >' + x.caption + '</button>';
    l += '            </div>';
    l += '            </button>';
    l += '        </div>';
    l += '    </div>';
    l += '</div> ';
    return l;
}

function msgConfirmation(x) {

    var l = '';
    l += '<div class="modal fade " id="msgConfirmation"  tabindex="-1" role="dialog"  aria-hidden="true" data-backdrop="static">';
    l += '    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">';
    l += '        <div class="modal-content">';
    l += '            <div class="modal-body msgmodal-confirm-body m-body text-center">';
    l += "                <p class='msgmodal-confirm-header m-header' style='padding-top: 22px;' id='msgmodal-confirm-header'>" + x.title + "</p>";
    l += '                <span class="sub-content-confirm p2" id="sub-content-confirm">' + x.body + '</span>';
    l += '            </div>';
    l += '            <div class="modal-footer msgmodal-confirm-footer m-footer" id="msgmodal-confirm-footer"> ';
    l += '                <button type="button" class="btn btn-cancel btn-close-confirm-modal " data-dismiss="modal" id="msgConfirmation-cancel"> ' + x.LblBtnCancel + ' </button>';
    l += '                <button type="button" class="btn btn-primary-orange modal-button-save" data-dismiss="modal" id="msgConfirmation-confirm"> ' + x.LblBtnConfirm + ' </button>';
    l += '            </div>';
    l += '        </div>';
    l += '    </div>';
    l += '</div>';

    return l;
}

function confirmPassword(x = ''){

    $('#icmsMessage').remove();
    $('footer').prepend('<div id="icmsMessage"></div>');
    
    $('#icmsMessage').delegate( ".toggle-password_icon", "click", function() {
        let inp_type = $('#inp-pass-confirm').attr('type'); 
        $('#inp-pass-confirm').attr('type', (inp_type == 'password') ? 'text' : 'password');
    });

    $('#icmsMessage').delegate( "#btn-submit-confirm-password", "click", function() {

        $("#inp-pass-confirm-error").html(''); 

        let password = $('#inp-pass-confirm').val(); 
        if (!password){
            password = $('#inp-pass-confirm').val().trim()
            $("#inp-pass-confirm-error").html('This field is required.'); 
            return false;
        }
        
        let attempt = parseInt($('#inp-pass-confirm').attr('data-attempt')); 

        $.post(sAjaxAccess, {
            type: "checkAccountPassword",
            old_pwd: password,
        }, function (rs) {
            if(rs.data.flag == "1"){
                //confirm
                if (x.onSubmit) {
                    x.onSubmit();
                    x.onSubmit = function () {};
                    x = defaultValue();
                }
                $('#msgPasswordConfirm').modal('hide');
            }else{
                attempt++; 
                $('#inp-pass-confirm').attr('data-attempt', attempt); 
                $("#inp-pass-confirm-error").html('Password incorrect.'); 

                //wrong
                if(attempt >= 3){
                    $("#inp-pass-confirm-error").html(''); 
                    $("#inp-pass-confirm-error").html('Too many attempts! <br> You will be directed to login page.'); 
                    setTimeout(function () {
                        var lnk = logout_url = sAjaxUrl + '/logout'
                        location.assign(lnk); // to logout
                    }, 3000);
                }
            }
        }, 'json');
    }); 

    let l = `
        <div class="modal modal-warning" id="msgPasswordConfirm" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header p-0 msgmodal-error-header mb-0 pt-3" style="margin: 0 auto !important;">
                        <div class="modal-body"  style="margin: 0 auto !important;">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <span class="notif-title center">Please confirm your password</span> <br> 
                                    <div class="form-group">
                                        <label for="inp-pass-confirm"> <span class="lbl-capslock text-danger font-weight-bold"></span>
                                        </label>
                                        <input  type="password" 
                                                data-attempt=0 
                                                id="inp-pass-confirm" 
                                                class="form-control input_pass noSpcStart w-100" 
                                                aria-describedby="" placeholder="password">
                                        <span class="spn_icon-show"><i class="fa toggle-password_icon fa-eye-slash" aria-hidden="true"></i></span>
                                    </div>
                                    <div id="inp-pass-confirm-error" class="error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer msgmodal-warning-footer m-footer p-2"> 
                        <button type="button" class="btn" id="btn-submit-confirm-password">CONFIRM</button>
                    </div>
                </div>
            </div>
        </div> 
    `;

    // build message content
    $('#icmsMessage').html(l);

     // Show Modal
     $('#msgPasswordConfirm').modal('show');

}