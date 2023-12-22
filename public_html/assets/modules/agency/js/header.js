/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function getUnreadNotification() {

    $.post(sAjaxGlobalData, {
        type: "getUnreadNotification",
    }, function (rs) {
        console.log(rs);
        var list = "";
        if (parseInt(rs.data.count) >= 1) {
            $('#notif-icon').removeClass('pr-2');
            $('#notif-badge-count').removeClass('hide');
            $('#notif-badge-count').html(rs.data.count);
            $.each(rs.data.list, function (key, val) {
                list += '<li class="tagged-case li-notif-list" dataid="' + val.notification_id + '">';
                list += '   <div class="row">';
                list += '       <div class="col-8 notif-content">';
                list += '           <small class="">' + val.notification_message + '</small>';
                list += '       </div>';
                list += '       <div class="col-4">';
                list += '           <p class="notif-time">' + jQuery.timeago(val.notification_date_added) + '</p>';
                list += '       </div>';
                list += '   </div>';
                list += '</li><hr>';
            });

        } else {
            $('#notif-badge-count').html("0");
            $('#notif-badge-count').addClass('hide');
            $('#notif-icon').addClass('pr-2');
            list += '<li class="tagged-case">';
            list += '   <div class="row">';
            list += '       <div class="col-12 notif-content">';
            list += '             <center><h5>No active notification found!<h5></center>';
            list += '       </div>';
            list += '   </div>';
            list += '</li>';
        }

        $('#ul-notif-list').html(list);

        setTimeout(function () {
            getUnreadNotification();
        }, 10000);
    }, 'json');

}


$(document).ready(function () {
    getUnreadNotification();


    $(".notif-dropdown").click(function () {
        $(".list-notif").toggle("change_it");
    });

    $(".messages").click(function () {
        $(".messages-list").toggle("change_it");
    });

    $(".user-name").click(function () {
        $(".accnt-settings").toggle("change_it");
    });

    $('ul li a:not(:only-child)').click(function (e) {
        $(this).siblings('.agency-menu').toggle();
        // Close one dropdown when selecting another
        $('.agency-menu').not($(this).siblings()).hide();
        e.stopPropagation();
    });

    $('ul li a:not(:only-child)').click(function (e) {
        $(this).siblings('.case-menu').toggle();
        // Close one dropdown when selecting another
        $('.case-menu').not($(this).siblings()).hide();
        e.stopPropagation();
    });

    $('ul li a:not(:only-child)').click(function (e) {
        $(this).siblings('.accnt-settings').toggle();
        // Close one dropdown when selecting another
        $('.accnt-settings').not($(this).siblings()).hide();
        e.stopPropagation();
    });

    $('ul li a:not(:only-child)').click(function (e) {
        $(this).siblings('.list-notif').toggle();
        // Close one dropdown when selecting another
        $('.list-notif').not($(this).siblings()).hide();
        e.stopPropagation();
    });

    $('ul li a:not(:only-child)').click(function (e) {
        $(this).siblings('.messages-list').toggle();
        // Close one dropdown when selecting another
        $('.messages-list').not($(this).siblings()).hide();
        e.stopPropagation();
    });


    $('html').click(function () {
        $('.agency-menu').hide();
        $('.case-menu').hide();
        $('.accnt-settings').hide();
        $('.list-notif').hide();
        $('.messages-list').hide();
    });


});


