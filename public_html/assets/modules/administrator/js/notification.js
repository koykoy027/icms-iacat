function markAllNotificationAsRead() {
    $.post(sAjaxGlobalData, {
        type: "readAllNotifications"
    }, function (rs) {
        icmsMessage({
            type: "msgPreloader",
            visible: false
        });
        icmsMessage({
            type: "msgSuccess",
            body: "You have successfully marked all notification as read",
            onShow: function () {
                $('.div-mark-all').addClass('hide');
                $('.unread-count-note').addClass('hide');
                $('#notif-badge-count').addClass('hide');
                
            }
        });

    }, 'json');
}

function getAllNotifications(page) {
    var limit_count = 15;
    var limit_start = (page * limit_count) - limit_count;
    $.post(sAjaxGlobalData, {
        type: "getAllNotifications",
        limit_start: limit_start,
        limit_count: limit_count,
    }, function (rs) {
//        console.log(rs);
        if (parseInt(rs.data.count) >= 1) {
            var date_checker = $('.div-agency').attr("datechecker");
            var list = "";
            $.each(rs.data.list, function (key, val) {
                var date_checker = $('.div-agency').attr("datechecker");
                var sDate = val.notification_date_added.split(" ");
                if (sDate[0] == date_checker) {
                    list += '<div class="div-user-list notif-box" dataread="' + val.notification_is_read + '" dataid="' + val.notification_id + '">';
                    list += '   <div class="row notifications">';
                    list += '   <div class="col col-sm-2 col-body notif-type">' + val.notification_type + '</div>';
                    list += '   <div class="col col-sm-2 col-body">LOGO</div>';
                    list += '   <div class="col col-sm-6 col-body"><b>' + val.notification_message + '</b></div>';
                    list += '   <div class="col col-sm-2 col-body"><i class="fas fa-clock"></i>&nbsp;' + localTime(sDate[1]) + '</div>';
                    list += '   </div>';
                    list += '</div>';
                } else {
                    list += '<p class="today-notif">' + dateViewingFormat(val.notification_date_added) + '</p>';
                    list += '<div class="div-user-list notif-box" dataread="' + val.notification_is_read + '" dataid="' + val.notification_id + '">';
                    list += '   <div class="row notifications">';
                    list += '   <div class="col col-sm-2 col-body notif-type">' + val.notification_type + '</div>';
                    list += '   <div class="col col-sm-2 col-body">LOGO</div>';
                    list += '   <div class="col col-sm-6 col-body"><b>' + val.notification_message + '</b></div>';
                    list += '   <div class="col col-sm-2 col-body"><i class="fas fa-clock"></i>&nbsp;' + localTime(sDate[1]) + '</div>';
                    list += '   </div>';
                    list += '</div>';
                }

                $('.div-agency').attr("datechecker", sDate[0]);
            });
            $('.div-agency').append(list);
            if (rs.data.count <= (page * limit_count) && rs.data.count >= limit_start) {
                $('.div-agency').attr('datapageend', 1);
                var notif = "";
                notif += '<div class="div-user-list notif-box">';
                notif += '     <div class="row notifications">';
                notif += '      <div class="col col-body notif-type">End of notifications</div>';
                notif += '     </div>';
                notif += '</div>';
                $('.div-agency').append(notif);
            }


        } else {
            if ($('.div-agency').attr('datapageend') == "0") {
                var notif = "";
                notif += '<div class="div-user-list notif-box">';
                notif += '     <div class="row notifications">';
                notif += '      <div class="col col-body notif-type">There is no notification found!</div>';
                notif += '     </div>';
                notif += '</div>';
                $('.div-agency').append(notif);
            } else {
                var notif = "";
                notif += '<div class="div-user-list notif-box">';
                notif += '     <div class="row notifications">';
                notif += '      <div class="col col-body notif-type">End of notifications</div>';
                notif += '     </div>';
                notif += '</div>';
                $('.div-agency').append(notif);
            }
            $('.div-agency').attr('datapageend', 1);
        }
    }, 'json');
}

$(document).ready(function () {
    getAllNotifications(1);
    $(document).bind('scroll', function () {
//        console.log($(document).height() - $(document).scrollTop());
        if ($(document).height() - $(document).scrollTop() <= $(window).height()) { // 615 footer
            if ($('.div-agency').attr('datapageend') == "0") {
                var page = $('.div-agency').attr('datapage');
                page = parseInt(page) + 1;
                $('.div-agency').attr('datapage', page);
                getAllNotifications(page);
            }
        }
    });

    $('.div-agency').delegate('.notif-box', 'click', function () {
        var isread = $(this).attr('dataread');
        if (isread == "0") {
            var id = $(this).attr('dataid');
            $.post(sAjaxGlobalData, {
                type: "setNotificationAsRead",
                id: id,
            }, function (rs) {
                getUnreadNotification();
            }, 'json');
            $(this).css('background-color', '#fff');
        }
    });

    $('.btn-mark-all').click(function () {
        icmsMessage({
            type: "msgConfirmation",
            title: "Mark all notification as read",
            body: 'Click OK to continue',
            LblBtnConfirm: 'OK',
            onConfirm: function () {
                icmsMessage({
                    type: "msgPreloader",
                    body:"Please wait...",
                    visible: true
                });
                markAllNotificationAsRead();

            },
            onCancel: function () {

            }
        });
    });

});