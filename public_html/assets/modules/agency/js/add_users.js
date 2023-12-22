function getAgencyType() {
    $.post(sAjaxAgencies, {
        type: "getAgencyTypes"
    }, function (rs) {
        console.log(rs);
        l = "<option value='0' selected disabled>Select Agency</option>";
        $.each(rs.data, function (key, val) {
            l += "<option value='" + val.agency_id + "'>" + val.agency_name + "(" + val.agency_abbr + ")" + " </option>";
        });
        $('#sel_agency').html(l);
    }, 'json');
}

function getSex() {
    $.post(sAjaxGlobalData, {
        type: "getSex"
    }, function (rs) {
        l = "<option value='0' selected disabled>Select Sex</option>";
        $.each(rs.data, function (key, val) {
            l += "<option value='" + val.parameter_count_id + "'>" + val.parameter_name + " </option>";
        });
        $('#sel_sex').html(l);
    }, 'json');
}

function  getCountry() {
    $.post(sAjaxGlobalData, {
        type: "getCountries"
    }, function (rs) {
        l = "<option value='0' selected disabled>Select Country</option>";
        $.each(rs.data, function (key, val) {
            l += "<option value='" + val.country_id + "'>" + val.country_name + " </option>";
        });
        $('#sel_country').html(l);
    }, 'json');
}

function getRegions() {
    $('#sel_state_prov').html("<option value='0' selected disabled>Select States</option>");
    $('#sel_city').html("<option value='0' selected disabled>Select City</option>");
    $('#sel_brgy').html("<option value='0' selected disabled>Select Barangay</option>");

    $('#sel_state_prov_con').html("<option value='0' selected disabled>Select States</option>");
    $('#sel_city_con').html("<option value='0' selected disabled>Select City</option>");
    $('#sel_brgy_con').html("<option value='0' selected disabled>Select Barangay</option>");

    $.post(sAjaxGlobalData, {
        type: "getRegions"
    }, function (rs) {

        l = "<option value='0' selected disabled>Select Region</option>";
        $.each(rs.data, function (key, val) {
            l += "<option value='" + val.location_count_id + "'>" + val.location_name + " </option>";
        });
        $('#sel_region').html(l);
    }, 'json');
}

function getAgencyBranchByAgencyTypeID(agencytypeid) {
    $.post(sAjaxAgencies, {
        type: "getAgencyBranchByAgencyTypeID",
        agencytypeid: agencytypeid
    }, function (rs) {
        if (rs.data.result == "1") {
            l = "<option value='0' selected disabled>Select Agency Branch</option>";
            $.each(rs.data.branches, function (key, val) {
                l += "<option value='" + val.agency_branch_id + "'>" + val.agency_branch_name + " </option>";
            });
            $('#sel_branch').html(l);
        } else {
            $('#sel_branch').html("<option value='0' selected disabled>Select Agency Branch</option>");
            $('.h5-title').html("Warning");
            var body = '';
            body += '<div class="text-center">';
            body += 'There is no added agency branch in this agency type.<br>Please add agency first';
            body += '</div>';
            $('.msgmodal-body').html(body);
            var footer = '  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
            $('.msgmodal-footer').html(footer);

            $('.close').hide();
            $('#msgmodal').modal('show');
        }

    }, 'json');
}

function getUserLevelWithCondition(agencyid) {
    $.post(sAjaxAgencies, {
        type: "getUserLevelWithCondition",
        agencyid: agencyid
    }, function (rs) {
        l = "<option value='0' selected disabled>Select Userlevel</option>";
        $.each(rs.data, function (key, val) {
            l += "<option value='" + val.transaction_parameter_count_id + "'>" + val.transaction_parameter_name + " </option>";
        });
        $("#sel_userlevel").html(l);
    }, 'json');
}


function  getStates(country_id) {
    $('#sel_region').html("<option value='0' selected disabled>Select Region</option>");
    $('#sel_city').html("<option value='0' selected disabled>Select City</option>");
    $('#sel_brgy').html("<option value='0' selected disabled>Select Barangay</option>");
    $.post(sAjaxGlobalData, {
        type: "getStateByCountryID",
        country_id: country_id,
    }, function (rs) {
        l = "<option value='0' selected disabled>Select States</option>";
        $.each(rs.data, function (key, val) {
            l += "<option value='" + val.location_count_id + "'>" + val.location_name + " </option>";
        });
        $('#sel_state_prov').html(l);
    }, 'json');
}


function getProvinceByRegionID(region_id) {
    $.post(sAjaxGlobalData, {
        type: "getProvinceByRegionID",
        region_id: region_id,
    }, function (rs) {
        l = "<option value='0' selected disabled>Select Province</option>";
        $.each(rs.data, function (key, val) {
            l += "<option value='" + val.location_count_id + "'>" + val.location_name + " </option>";
        });
        $('#sel_state_prov').html(l);
    }, 'json');
}


function getCities(province_id) {
    $.post(sAjaxGlobalData, {
        type: "getCityByProvinceID",
        province_id: province_id,
    }, function (rs) {
        l = "<option value='0' selected disabled>Select City</option>";
        $.each(rs.data, function (key, val) {
            l += "<option value='" + val.location_count_id + "'>" + val.location_name + " </option>";
        });
        $('#sel_city').html(l);
    }, 'json');
}


function  getBrgy(city_id) {
    $.post(sAjaxGlobalData, {
        type: "getBrgyByCityID",
        city_id: city_id,
    }, function (rs) {
        l = "<option value='0' selected disabled>Select Barangay</option>";
        $.each(rs.data, function (key, val) {
            l += "<option value='" + val.location_count_id + "'>" + val.location_name + " </option>";
        });
        $('#sel_brgy').html(l);
    }, 'json');
}


$('#form-manage-address').validate({
    rules: {
        sel_country: {required: true},
        sel_state_prov: {required: true},
        area_detailed: {required: true},
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
        $('#mdl-manage-address').modal('hide');
    }
});


$('#frm-user-type-details').validate({
    rules: {
        sel_agency: {required: true},
        sel_branch: {required: true},
        sel_userlevel: {required: true},
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
        $('#frm-user-details').submit();
    }
});

$('#frm-user-details').validate({
    rules: {

        txt_fname: {required: true},
        txt_lname: {required: true},
        sel_sex: {required: true},
        txt_email: {required: true},
        area_desc: {required: true},
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

        var tstcountry = $('#sel_country').val();
        var tstprov = $('#sel_state_prov').val();
        var tstaddress = $('#area_detailed').val();


        if (tstcountry == "0" || tstprov == "0" || tstaddress == "") {
            $('.h5-title').html("Warning");
            var body = '';
            body += '<div class="text-center">';
            body += 'Please check the address details';
            body += '</div>';
            $('.msgmodal-body').html(body);
            var footer = ' <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
            $('.msgmodal-footer').html(footer);
            $('.close').hide();
            $('#msgmodal').modal('show');
        } else {
            $('#btn_save_user').attr("disabled", "disabled");
            addNewAgencyUser();
        }
    }
});

function addNewAgencyUser() {
    var country = $('#sel_country').val();
    var region = $('#sel_region').val();
    var prov = $('#sel_state_prov').val();
    var city = $('#sel_city').val();
    var brgy = $('#sel_brgy').val();
    var address = $('#area_detailed').val();
    var fname = $('#txt_fname').val();
    var mname = $('#txt_mname').val();
    var lname = $('#txt_lname').val();
    var sex = $('#sel_sex').val();
    var email = $('#txt_email').val();
    var tel = $('#txt_tel').val();
    var mob = $('#txt_mob').val();
    var agencytype = $('#sel_agency').val();
    var agencyid = $('#sel_branch').val();
    var userlevel = $('#sel_userlevel').val();
    var area_desc = $('#area_desc').val();
    $.post(sAjaxUsers, {
        type: "addNewAgencyUser",
        country: country,
        region: region,
        prov: prov,
        city: city,
        brgy: brgy,
        address: address,
        fname: fname,
        mname: mname,
        lname: lname,
        sex: sex,
        email: email,
        tel: tel,
        mob: mob,
        agencytype: agencytype,
        agencyid: agencyid,
        userlevel: userlevel,
        area_desc: area_desc
    }, function (rs) {
        if (rs.data.php_validation.flag == "0") {
            var body = '';
            $('.h5-title').html("Warning");
            body += 'Insufficient Values';
            $('.msgmodal-body').html(body);
            var footer = '  <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>';
            $('.msgmodal-footer').html(footer);
            $('#msgmodal').modal('show');
        } else {
            if (rs.data.result == "1") {
                //the email is already on the system
                $('.h5-title').html("Warning");
                var body = '';

                body += 'Opps!<br>';
                body += ' <b>' + email + '</b> is already registered in the system';

                $('.msgmodal-body').html(body);
                var footer = '  <button type="button" class="btn btn-secondary " data-dismiss="modal">OK</button>';
                $('.msgmodal-footer').html(footer);
                $('#msgmodal').modal('show');

            } else {
                $('.h5-title').html("Result");
                var body = '';
                body += '<div class="text-center">';
                body += 'New agency user was successfully added<br>';
                body += 'The login access was sent to <b>' + email + '<b>';
                body += '</div>';
                $('.msgmodal-body').html(body);
                var footer = '  <button type="button" class="btn btn-secondary " data-dismiss="modal">OK</button>';
                $('.msgmodal-footer').html(footer);
                $('.close').hide();
                $('#msgmodal').modal('show');
                setTimeout(reloadPage, 3000);
            }
        }

    }, 'json');
}

function reloadPage() {
    location.reload();
}

$(document).ready(function () {
    getAgencyType();
    getSex();

    getCountry();
    getRegions();

    $('#sel_agency').change(function () {
        $("#sel_branch").removeAttr("disabled");
        $("#sel_userlevel").attr("disabled");
        var agencytypeid = $(this).val();
        getAgencyBranchByAgencyTypeID(agencytypeid);
    });

    $("#sel_branch").change(function () {
        $("#sel_userlevel").removeAttr("disabled");
        var agencyid = $(this).val();
        getUserLevelWithCondition(agencyid);
    });



    $('#sel_country').change(function () {
        var country_id = $(this).val();
        if (country_id == '173') {
            $('.grp-brgy').show();
            $('.grp-city').show();
            $('.grp-region').show();
            getRegions();
        } else {
            $('#sel_brgy').val("0");
            $('#sel_city').val("0");
            $('#sel_region').val("0").change();
            $('.grp-brgy').css("display", "none");
            $('.grp-city').css("display", "none");
            $('.grp-region').css("display", "none");
            getStates(country_id);
        }
    });


    $('#sel_region').change(function () {
        var country_id = $('#sel_country').val();
        if (country_id == '173') {
            var region_id = $(this).val();
            $('#sel_city').html("<option value='0' selected disabled>Select City</option>");
            $('#sel_brgy').html("<option value='0' selected disabled>Select Barangay</option>");
            getProvinceByRegionID(region_id);
        }
    });

    $('#sel_state_prov').change(function () {
        var country_id = $('#sel_country').val();
        if (country_id == '173') {
            var province_id = $(this).val();
            getCities(province_id);
        }
        $('#sel_brgy').html("<option value='0' selected disabled>Select Barangay</option>");
    });


    $('#sel_city').change(function () {
        var country_id = $('#sel_country').val();
        if (country_id == '173') {
            var city_id = $(this).val();
            getBrgy(city_id);
        }
    });

    $('.btn-add-address').click(function () {
        $('#form-manage-address').submit();
    });

    $('#btn_save_user').click(function () {
        $('#frm-user-type-details').submit();
    });



});