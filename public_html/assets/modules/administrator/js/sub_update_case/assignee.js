function loadListUsers() {

    var case_id = $('#case_id').val();
    $.post(sAjaxAssignee, {
        type: "getUserListByAgencyId",
        case_id: case_id,
    }, function (rs) {
        rs = html_entity_decode(rs);
        l = '';
        $.each(rs.data.list, function (key, val) {
            l += '<tr>';
            l += '<td scope="row">';
            l += '    <div class="row">';
            l += '        <div class="col-6">' + val.user_firstname + ' ' + val.user_lastname + '</div>';
            l += '        <div class="col-4">' + val.user_level + '</div>';
            l += '        <div class="col-2">';
            l += '            <div class="custom-control custom-switch">';
            if (parseInt(val.check) > 0) {
                l += '                <input type="checkbox" class="custom-control-input switch-assignee" data-fname="' + val.user_firstname + '" data-email="' + val.user_email + '" value = "1" id="' + val.user_id + '" checked>';
            } else {
                l += '                <input type="checkbox" class="custom-control-input switch-assignee" data-fname="' + val.user_firstname + '" data-email="' + val.user_email + '" value = "1" id="' + val.user_id + '" >';
            }
            l += '                <label class="custom-control-label" for="' + val.user_id + '"></label>';
            l += '            </div>';
            l += '        </div>';
            l += '    </div>';
            l += '</td>';
            l += '</tr>';
        });
        $('#tbl-list-assignee').html(l);
    }, 'json');
}

function setAssignee(user_id, status, email, fname) {
    icmsMessage({
        type: "msgPreloader",
        body: "Processing... Please wait!",
        visible: true
    });
    var case_id = localStorage.getItem('cid');
    $.post(sAjaxAssignee, {
        type: "setAssigneeByCaseId",
        case_id: case_id,
        user_id: user_id,
        status: status,
        email: email,
        fname: fname,
    }, function (rs) {
        var msg = fname + " was successfully assigned!";
        if (status == "0") {
            var msg = fname + " was successfully unassigned!";
        }

        icmsMessage({
            type: "msgSuccess",
            body: msg,
        });
        
    }, 'json');
}

$(document).ready(function () {
    
//    loadListUsers();

    $('#tbl-list-assignee').delegate('.switch-assignee', 'click', function () {
        $('.switch-assignee').removeClass("lastClick");
        $(this).addClass("lastClick");
        var user_id = $(this).attr('id');
        var status = 1;
        var email = $(this).attr('data-email');
        var fname = $(this).attr('data-fname');
        var msg = "You are about to assign " + fname + " for the case";
        if ($(this).is(":not(:checked)")) {
            status = 0;
            msg = "You are about to unassign " + fname + " for the case";

        }

        icmsMessage({
            type: "msgConfirmation",
            title: msg,
            body: "Click Confirm button if you wish to continue.",
            LblBtnConfirm: "Confirm",
            onConfirm: function () {
                setAssignee(user_id, status, email, fname);
            },
            onCancel: function () {
                if (status == "1") {
                    $(".lastClick").prop("checked", false);
                } else {
                    $(".lastClick").prop("checked", true);
                }

            }
        });

    });
});

