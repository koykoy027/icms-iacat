
function getUserActivityLogs(page) {
    var limit_count = 25;
    var limit_start = (page * limit_count) - limit_count;
    $.post(sAjaxDashboard, {
        type: "getActivityLogs_adminUser",
        limit_start: limit_start,
        limit_count: limit_count,
    }, function (rs) {
        console.log(rs);
        if (rs.data.result.count >= 1) {
            var list = "";

            $.each(rs.data.result.list, function (key, val) {
                var sDate = val.user_log_date_added.split(" ");
                list += '<tr class="logs-details">';
                list += '   <td><span class="notif-type-badge ' + val.badge_class + '"><i class="' + val.badge + '" aria-hidden="true"></i></span></td>';
                list += '   <td><blue class="user-name">' + val.user_log_fullname + ' </blue>' + val.user_log_message + ' <br> <span class="text-gray-500">' + val.agency_abbr + ' - ' + val.agency_branch + '</span>';
                 if (parseInt(val.changes.count) >= 1) {
                    var toJson = JSON.stringify(val.changes.list);
                    var encrypt = btoa(toJson);
                    list += '<span class="text-normal"><small><a data-updated=' + encrypt + ' style="color: #007bff;text-decoration: none;cursor:pointer;background-color: transparent" class="a-log-view-details"><br>View details</a></small></span>';
                }
                list += '   </td>';
                list += '   <td><span class="date-frmt-text">' + dateViewingFormat(sDate[0]) + '</span><br><span class="time-frmt-text">' + localTime(sDate[1]) + '</span>' ;
                list += '   <td> <span class="duration-frmt-text"> ' + jQuery.timeago(val.user_log_date_added) +'</span></td>';
                list += '</tr>';

            });
            $('.activity-logs-content').append(list);
            if (rs.data.result.count <= (page * limit_count) && rs.data.result.count >= limit_start) {
                $('.activity-logs-content').attr('datapageend', 1);
                $('.activity-logs-content').append("<tr><td colspan='3'><hr><center>End of user logs</center></td></tr>");
            }
        } else {
            if ($('.activity-logs-content').attr('datapageend') == "0") {
                $('.activity-logs-content').append("<tr><td colspan='3'><hr><center>No user logs found</center></td></tr>");
            } else {
                $('.activity-logs-content').append("<tr><td colspan='3'><hr><center>End of user logs</center></td></tr>");
            }
            $('.activity-logs-content').attr('datapageend', 1);

        }
    }, 'json');
}
$(document).ready(function () {
    getUserActivityLogs(1);
    $(document).bind('scroll', function () {
        if ($(document).height() - $(document).scrollTop() <= $(window).height()) { // 615 footer
            if ($('.activity-logs-content').attr('datapageend') == "0") {
                var page = $('.activity-logs-content').attr('datapage');
                page = parseInt(page) + 1;
                $('.activity-logs-content').attr('datapage', page);
                getUserActivityLogs(page);
            }

        }
    });
    
    
$('.activity-logs-content').delegate('.a-log-view-details', 'click', function () {
    var frJson = $(this).attr('data-updated');
    var decrypt = atob(frJson);
    var newVal = JSON.parse(decrypt);
    var details = "";
    
    $.each(newVal, function (key, val) {
        details += "<div class='row' style='border-bottom: 1px solid rgba(0,0,0,0.1);padding-bottom: 11px;'>";
        details += "    <div class='col-lg-12 col-md-12 col-sm-12'><b>Label : </b>" + val.user_log_update_field_name;
        details += "    <b><br>From : </b>" + val.user_log_update_old_parameter;
        details += "                     <br><b>To :</b> " + val.user_log_update_new_parameter + "</div>";
        details += "</div>";        
    });

    $('.modal-header').html("<span class='content-title text-align_center' style='padding-top: 25px;'> Log Details </span>");
    $('.small-desc').html("<small class ='content-sub-title' style = 'margin-left: 7%;'> Updated Information </small>");

    $('.msgmodal-body').html("<div style='min-height: 100px;max-height: 200px;overflow-y: auto;overflow-x: hidden;'>" + details + "</div>");
    var footer = '  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
    $('.msgmodal-footer').html(footer);
    $('#msgmodal').modal('show');
});
});