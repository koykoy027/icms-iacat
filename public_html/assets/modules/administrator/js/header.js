/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    getUnreadNotification();

    $('#ul-notif-list').delegate('.li-notif-list', 'click', function () {
        var id = $(this).attr('dataid');
        $.post(sAjaxGlobalData, {
            type: "setNotificationAsRead",
            id: id,
        }, function (rs) {
            getUnreadNotification();
        }, 'json');
    });

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


//$(".nav-item ")
//        .mouseover(function () {
//            $(this).addClass('show').attr('aria-expanded', "true");
//            $(this).find('.dropdown-menu ').addClass('show');
//        })
//        .mouseout(function () {
//            $(this).removeClass('show').attr('aria-expanded', "false");
//            $(this).find('.dropdown-menu ').removeClass('show');
//        });





//$(".dropdown-toggle ").mouseover(function () {
//    var id = $(this).attr('data-id');
//    alert(id);
//});

$('#dropdown-search').on('click', function (event) {
//    alert(1);
    // The event won't be propagated up to the document NODE and 
    // therefore delegated events won't be fired
    event.stopPropagation();
});
$('.trigger_advanced_search').click(function () {
    $('#advance-search').modal('show');
});
var search_btn = document.getElementById("trigger_advanced_search");
trigger_advanced_search.onmouseenter = function () {
    search_btn.style.color = "#daa255";
    search_btn.style.cursor = "pointer";
}
trigger_advanced_search.onmouseleave = function () {
    search_btn.style.color = "#e88f15";
}