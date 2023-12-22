$(document).ready(function () {

    $('.input_check').iCheck({
        checkboxClass: 'icheckbox_square-orange',
        radioClass: 'iradio_square-orange',
        increaseArea: '20%' // optional
    });


    $('#select').multipleSelect({
        width: 500
    })

//    $('.select-multiple').delegate('.ellipse-action', 'click', function () {
//
//        var id = $(this).attr('data-id');
//        var tab = $(this).attr('data-tab');
//
//        if ($('#' + tab + id).is(":visible")) {
//            $('.a-ellipse').removeClass('ellipse-selected');
//            $('#' + tab + +id).hide();
//        } else {
//            $('.action-menu').hide();
//            $('.a-ellipse').removeClass('ellipse-selected');
//            $('#' + tab + id).show();
//            $('.a-ellipse-' + id).addClass('ellipse-selected');
//        }
//    });



    $('.select-multiple').on('click', function () {
//        alert(1);

    });
});