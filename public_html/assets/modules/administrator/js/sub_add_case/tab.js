
$("#validate-details-tab1").click(function () {
    $('#validate-details').show();
    $('.v_label').addClass('bs-stepper-label_active');
    $('.v_circle').addClass('bs-stepper-circle_active');

    $('#victims-details').hide();
    $('.vd_label').removeClass('bs-stepper-label_active');
    $('.vd_circle').removeClass('bs-stepper-circle_active');

    $('#employment-details').hide();
    $('.e_label').removeClass('bs-stepper-label_active');
    $('.e_circle').removeClass('bs-stepper-circle_active');

    $('#case-details').hide();
    $('.c_label').removeClass('bs-stepper-label_active');
    $('.c_circle').removeClass('bs-stepper-circle_active');

    $('#summary').hide();
    $('.s_label').removeClass('bs-stepper-label_active');
    $('.s_circle').removeClass('bs-stepper-circle_active');
});

$("#victims-details-tab1").click(function () {
    $('#validate-details').hide();
    $('.v_label').removeClass('bs-stepper-label_active');
    $('.v_circle').removeClass('bs-stepper-circle_active');
    //** victim active *//
    $('#victims-details').show();
    $('.vd_label').addClass('bs-stepper-label_active');
    $('.vd_circle').addClass('bs-stepper-circle_active');

    $('#employment-details').hide();
    $('.e_label').removeClass('bs-stepper-label_active');
    $('.e_circle').removeClass('bs-stepper-circle_active');

    $('#case-details').hide();
    $('.c_label').removeClass('bs-stepper-label_active');
    $('.c_circle').removeClass('bs-stepper-circle_active');

    $('#summary').hide();
    $('.s_label').removeClass('bs-stepper-label_active');
    $('.s_circle').removeClass('bs-stepper-circle_active');

});

$("#employment-details-tab1").click(function () {
    $('#validate-details').hide();
    $('.v_label').removeClass('bs-stepper-label_active');
    $('.v_circle').removeClass('bs-stepper-circle_active');

    $('#victims-details').hide();
    $('.vd_label').removeClass('bs-stepper-label_active');
    $('.vd_circle').removeClass('bs-stepper-circle_active');
    //** empoyment active *//
    $('#employment-details').show();
    $('.e_label').addClass('bs-stepper-label_active');
    $('.e_circle').addClass('bs-stepper-circle_active');

    $('#case-details').hide();
    $('.c_label').removeClass('bs-stepper-label_active');
    $('.c_circle').removeClass('bs-stepper-circle_active');

    $('#summary').hide();
    $('.s_label').removeClass('bs-stepper-label_active');
    $('.s_circle').removeClass('bs-stepper-circle_active');

});

$("#case-details-tab1").click(function () {
    $('#validate-details').hide();
    $('.v_label').removeClass('bs-stepper-label_active');
    $('.v_circle').removeClass('bs-stepper-circle_active');

    $('#victims-details').hide();
    $('.vd_label').removeClass('bs-stepper-label_active');
    $('.vd_circle').removeClass('bs-stepper-circle_active');

    $('#employment-details').hide();
    $('.e_label').removeClass('bs-stepper-label_active');
    $('.e_circle').removeClass('bs-stepper-circle_active');
    //** case active *//
    $('#case-details').show();
    $('.c_label').addClass('bs-stepper-label_active');
    $('.c_circle').addClass('bs-stepper-circle_active');

    $('#summary').hide();
    $('.s_label').removeClass('bs-stepper-label_active');
    $('.s_circle').removeClass('bs-stepper-circle_active');

});

$("#summary-details-tab1").click(function () {
    $('#validate-details').hide();
    $('.v_label').removeClass('bs-stepper-label_active');
    $('.v_circle').removeClass('bs-stepper-circle_active');

    $('#victims-details').hide();
    $('.vd_label').removeClass('bs-stepper-label_active');
    $('.vd_circle').removeClass('bs-stepper-circle_active');

    $('#employment-details').hide();
    $('.e_label').removeClass('bs-stepper-label_active');
    $('.e_circle').removeClass('bs-stepper-circle_active');

    $('#case-details').hide();
    $('.c_label').removeClass('bs-stepper-label_active');
    $('.c_circle').removeClass('bs-stepper-circle_active');
    //** summary active *//
    $('#summary').show();
    $('.s_label').addClass('bs-stepper-label_active');
    $('.s_circle').addClass('bs-stepper-circle_active');

});