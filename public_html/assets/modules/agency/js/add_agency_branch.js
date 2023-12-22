function  getAgencyType() {
    $.post(sAjaxAgencies, {
        type: "getAgencyTypes"
    }, function (rs) {
        l = "<option value=''></option>";
        $.each(rs.data, function (key, val) {
            l += "<option class='input_check'  value='" + val.agency_id + "'>" + val.agency_name + " (" + val.agency_abbr + ")" + " </option>";
        });
        $('#sel-Agency').html(l);
        $('#sel-Agency').chosen();
    }, 'json');
}

function  getCountry() {
    $.post(sAjaxGlobalData, {
        type: "getCountries"
    }, function (rs) {
        l = "<option value=''></option>";
        $.each(rs.data, function (key, val) {
            l += "<option value='" + val.country_id + "'>" + val.country_name + " </option>";
        });
        $('#sel_country').html(l);
        $('#sel_country_con').html(l);
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
        $('#sel_region_con').html(l);
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
function  getStates_con(country_id) {
    $('#sel_region_con').html("<option value='0' selected disabled>Select Region</option>");
    $('#sel_city_con').html("<option value='0' selected disabled>Select City</option>");
    $('#sel_brgy_con').html("<option value='0' selected disabled>Select Barangay</option>");
    $.post(sAjaxGlobalData, {
        type: "getStateByCountryID",
        country_id: country_id,
    }, function (rs) {
        l = "<option value='0' selected disabled>Select States</option>";
        $.each(rs.data, function (key, val) {
            l += "<option value='" + val.location_count_id + "'>" + val.location_name + " </option>";
        });
        $('#sel_state_prov_con').html(l);
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
function getProvinceByRegionID_con(region_id) {
    $.post(sAjaxGlobalData, {
        type: "getProvinceByRegionID",
        region_id: region_id,
    }, function (rs) {
        l = "<option value='0' selected disabled>Select Province</option>";
        $.each(rs.data, function (key, val) {
            l += "<option value='" + val.location_count_id + "'>" + val.location_name + " </option>";
        });
        $('#sel_state_prov_con').html(l);
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
function getCities_con(province_id) {
    $.post(sAjaxGlobalData, {
        type: "getCityByProvinceID",
        province_id: province_id,
    }, function (rs) {
        l = "<option value='0' selected disabled>Select City</option>";
        $.each(rs.data, function (key, val) {
            l += "<option value='" + val.location_count_id + "'>" + val.location_name + " </option>";
        });
        $('#sel_city_con').html(l);
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
function  getBrgy_con(city_id) {
    $.post(sAjaxGlobalData, {
        type: "getBrgyByCityID",
        city_id: city_id,
    }, function (rs) {
        l = "<option value='0' selected disabled>Select Barangay</option>";
        $.each(rs.data, function (key, val) {
            l += "<option value='" + val.location_count_id + "'>" + val.location_name + " </option>";
        });
        $('#sel_brgy_con').html(l);
    }, 'json');
}


$('#form-manage-address').validate({
    rules: {
        sel_country: {required: true},
        sel_state_prov: {required: true},
        area_detailed: {required: true},
    },
    errorElement: 'div',
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
        $('#mdl-manage-agn-address').modal('hide');
        var full_address = '';
        full_address += $('#area_detailed').val();
        full_address += ($('#sel_brgy').val() === null) ? "" : " " + $('#sel_brgyv :selected').text();
        full_address += ($('#sel_city').val() === null) ? "" : " " + $('#sel_city :selected').text();
        full_address += $('#sel_state_prov :selected').text();
        full_address += ($('#sel_region').val() === null) ? "" : " " + $('#sel_region :selected').text();
        full_address += ', ' + $('#sel_country :selected').text();
        $('.address_container').show();
        $('.lbl-agency_datails_address').text(full_address);
    }
});
$('#form-manage-address-con').validate({
    rules: {
        sel_country_con: {required: true},
        sel_state_prov_con: {required: true},
        area_detailed_con: {required: true},
    },
    errorElement: 'div',
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
        var full_address = '';
        full_address += $('#area_detailed_con').val();
        full_address += ($('#sel_brgy_con').val() === null) ? "" : "  " + $('#sel_brgy_con :selected').text();
        full_address += ($('#sel_city_con').val() === null) ? "" : "  " + $('#sel_city_con :selected').text();
        full_address += ' ' + $('#sel_state_prov_con :selected').text();
        full_address += ($('#sel_region_con').val() === null) ? "" : "  " + $('#sel_region_con :selected').text();
        full_address += ', ' + $('#sel_country_con :selected').text();
        $('.lbl-cont_datails_address').text(full_address);
        $('#mdl-manage-cont-address').modal('hide');
        $('#mdl-add-contact-person').modal('show');
        $('#mdl-manage-cont-address').modal('hide');
    }
});
$('#frm_agency').validate({
    rules: {
        sel_category: {required: true},
        txt_brachname: {required: true},
        sel_category: {required: true},
        txt_email: {required: true, email: true},
        txt_tel: {minlength: 8, number: true},
        txt_mobile: {minlength: 11, number: true},
        txt_cont_fname: {required: true},
        txt_cont_lname: {required: true},
        txt_cont_email: {required: true},
        txt_cont_tel: {required: true},
    },
    errorElement: 'div',
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
        var agncountry = $('#sel_country').val();
        var agnprov = $('#sel_state_prov').val();
        var agnadd = $('#area_detailed').val();
        var agncountrycon = $('#sel_country_con').val();
        var agnprovcon = $('#sel_state_prov_con').val();
        var agnaddcon = $('#area_detailed_con').val();
        if (agncountry == "0" || agnprov == "0" || agnadd == "") {
            $('.h5-title').html("Warning");
            var body = '';
            body += '<div class="text-center">';
            body += 'Please check the agency address';
            body += '</div>';
            $('.msgmodal-body').html(body);
            var footer = '  <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>';
            $('.msgmodal-footer').html(footer);
            $('.close').hide();
            $('#msgmodal').modal('show');
        } else if (agncountrycon == "0" || agnprovcon == "0" || agnaddcon == "") {
            $('.h5-title').html("Warning");
            var body = '';
            body += '<div class="text-center">';
            body += 'Please check the agency contact address';
            body += '</div>';
            $('.msgmodal-body').html(body);
            var footer = '  <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>';
            $('.msgmodal-footer').html(footer);
            $('.close').hide();
            $('#msgmodal').modal('show');
        } else {
//            $('.btn-add-agency-branch').attr("disabled", "disabled");
            addAgencyBranch();
        }
    }
});
function addAgencyBranch() {
    var agncountry = $('#sel_country').val();
    var agnregion = $('#sel_region').val();
    var agnprov = $('#sel_state_prov').val();
    var agncity = $('#sel_city').val();
    var agnbrgy = $('#sel_brgy').val();
    var agnadd = $('#area_detailed').val();
    var branchname = $('#txt_brachname').val();
    var agntype = $('#sel-Agency').val();
    var agnemail = $('#txt_email').val();
    var agntel = $('#txt_tel').val();
    var agnmobile = $('#txt_mobile').val();
    var description = $('#area_description').val();
    var agnconperson = sessionStorage.getItem('contact_person');
    var services = ($('#service_dropdown').val().join());
    $.post(sAjaxAgencies, {
        type: "addAgencyBranch",
        agnconperson: agnconperson,
        agncountry: agncountry,
        agnregion: agnregion,
        agnprov: agnprov,
        agncity: agncity,
        agnbrgy: agnbrgy,
        agnadd: agnadd,
        branchname: branchname,
        agntype: agntype,
        agnemail: agnemail,
        agntel: agntel,
        agnmobile: agnmobile,
        description: description,
        services: services
    }, function (rs) {
        if (rs.data.flag != '0') {
            var success = '';
            success += '   <div class="modal-body msgmodal-success-body m-body text-center p-5">';
            success += '        <div class="success-checkmark">';
            success += '            <div class="check-icon">';
            success += '                <span class="icon-line line-tip"></span>';
            success += '                <span class="icon-line line-long"></span>';
            success += '                <div class="icon-circle"></div>';
            success += '                <div class="icon-fix"></div>';
            success += '            </div>';
            success += '        </div>';
            success += '       <p  class="sub-content-success p2">New agency branch is added to list. Do  you want to add again?</p>';
            success += '    </div>';
            success += '    <div class="modal-footer msgmodal-success-footer m-footer shadow" style="background: #dee2e6;"> ';
            success += '        <div class="msg-saving-footer" style="margin: 0 auto;">';
            success += '            <button type="submit" class="btn btn-primary-orange btn-next btn-success-action-back " id="btn-no" data-dismiss="modal">Back</button>  <button type="submit" class="btn btn-primary-orange btn-next btn-close-success" id="btn-yes" data-dismiss="modal">Yes</button>';
            success += '        </div>';
            success += '   </div>';
            $('.msgmodal-success-content').html(success);
            $('#msgmodal-success').modal('show');
            //window.location.href = "agency_branch"; //redirect for the meantime
        } else {
            $('#errormodal').modal('show');
            setTimeout(function () {
                $('#errormodal').modal('hide');
            }, 5000);
            window.location.reload(true);
        }

    }, 'json');
}

$('#form-add-contact-person').validate({
    rules: {
        txt_cont_fname: {required: true},
        txt_cont_lname: {required: true},
        txt_cont_email: {required: true, email: true},
        txt_cont_tel: {minlength: 8, number: true},
        txt_cont_mob: {minlength: 11, number: true},
    },
    errorElement: 'div',
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
        if (($('#sel_country_con').val() === null) || ($('#sel_country_con').val() == 0) || ($('#sel_country_con').val() === undefined)) {
            //alert('Please check contact person address');
        } else {
            storeAgencyContactPerson();
        }
    }
});
function storeAgencyContactPerson() {
    var fname = $('#txt_cont_fname').val();
    var mname = $('#txt_cont_mname').val();
    var lname = $('#txt_cont_lname').val();
    var tel = $('#txt_cont_tel').val();
    var mob = $('#txt_cont_mob').val();
    var email = $('#txt_cont_email').val();
    var country = $('#sel_country_con').val();
    var region = $('#sel_region_con').val();
    var pro_state = $('#sel_state_prov_con').val();
    var city = $('#sel_city_con').val();
    var brgy = $('#sel_brgy_con').val();
    var fadd = $('#area_detailed_con').val();
    var is_primary = $('#is_primary').is(':checked') ? "1" : "0";
    var contact_person = {
        'fname': fname,
        'mname': mname,
        'lname': lname,
        'tel': tel,
        'mob': mob,
        'email': email,
        'country': country,
        'region': region,
        'pro_state': pro_state,
        'city': city,
        'brgy': brgy,
        'fadd': fadd,
        'is_primary': is_primary
    };
    // id = 1 (add)
    // id = 2 (update)    
    var id = $('#btn-add-contact_person').attr('data-id');
    if (id != '2') {
        //add
        var new_contact_person = [];
        new_contact_person = JSON.parse(sessionStorage.getItem('contact_person'));
        new_contact_person.push(contact_person);
        sessionStorage.setItem('contact_person', JSON.stringify(new_contact_person));
    } else {
        //update
        var index = $('#btn-add-contact_person').attr('data-index');
        current_contact_person = JSON.parse(sessionStorage.getItem('contact_person'));
        current_contact_person[index] = contact_person;
        sessionStorage.setItem('contact_person', JSON.stringify(current_contact_person));
    }
    $('#mdl-add-contact-person').modal('hide');
    loadContactAgencyList();
}

function loadContactAgencyList() {
    var list = '';
    var aContent = JSON.parse(sessionStorage.getItem('contact_person'));
    if (parseInt(aContent.length) >= 1) {
        $('.no-contact_person').hide();
//        $('#tbl-agency_contact_person').show();
        $('#tbl-agency-contact_container').show();
        $('.div-is_primary').show();
        $.each(aContent, function (key, val) {

            list += '<tr>';
            list += '    <td>' + val.fname + ' ' + val.mname + ' ' + val.lname;
            if (val.is_primary != '1') {
                list += '';
            } else {
                $('.div-is_primary').hide();
                list += '<span style="padding-left:10px;"> <i class="fas fa-star primary-contact"></i> </span>';
            }
            list += '</td>';
            list += '    <td>' + val.email + '</td>';
            list += '    <td class="text-center"><div class="btn-group ellipse-action " data-id="' + key + '" data-tab="validate">';
            list += '            <a class="a-ellipse a-ellipse-' + key + '">  <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </a>';
            list += '            <div class="action-menu" id="' + key + '">';
            list += '                <a class="dropdown-item disabled action-title" href="#">Select Action</a>';
            list += '                <a class="dropdown-item mng-validate_id" data-id="' + key + '">Manage contact info</a>';
            list += '                <a class="dropdown-item rm-validate_id" data-id="' + key + '">Remove</a>';
            list += '            </div>';
            list += '        </div></td>';
            list += '</tr>';
        });
    } else {
//        $('#tbl-agency_contact_person').hide();
        $(".div-contact_person").show();
        $('.no-contact_person').show();
        $('#tbl-agency-contact_container').hide();
    }


    $('.list-agency_contact').html(list);
}

function selectContactAddress() {
    var sel_region_con = $('#sel_region_con').attr('data-id');
    var sel_city_con = $('#sel_city_con').attr('data-id');
    var sel_brgy_con = $('#sel_brgy_con').attr('data-id');
    var sel_state_prov_con = $('#sel_state_prov_con').attr('data-id');
    $('#sel_region_con').val(sel_region_con).change();
    setTimeout(function () {
        $('#sel_state_prov_con').val(sel_state_prov_con).change();
        setTimeout(function () {
            $('#sel_city_con').val(sel_city_con).change();
            setTimeout(function () {
                $('#sel_brgy_con').val(sel_brgy_con).change();
            }, 200);
        }, 200);
    }, 200);
}

function getServicesAll() {

    $.post(sAjaxAgencies, {
        type: "getServices"
    }, function (rs) {

        var l = "<option value=''></option>",
                sImmediate = '<optgroup label="Immediate services">',
                sMtoLterm = '<optgroup label="Mid to long term services">';
        $.each(rs.data.list, function (key, val) {
            var iType = parseInt(val.service_type_id);
            switch (iType) {
                case 1:
                    sImmediate += '<option value="' + val.services_id + '">' + val.service_name + '</option>';
                    break;
                case 2:
                    sMtoLterm += '<option value="' + val.services_id + '">' + val.service_name + '</option>';
                    break;
                default:
            }
        });
        sImmediate += '</optgroup>';
        sMtoLterm += '</optgroup>';
        l += sImmediate + sMtoLterm;
        $('#service_dropdown').html(l);
        $('#service_dropdown').chosen();
    }, 'json');
}

$(document).ready(function () {

    var sFooter = '<button type="button" class="btn btn-add_contact_person" style="background-color: #7ba5e4; color: #fff; align-item: center; width:200px;"> ADD CONTACT PERSON </button>';
    var sMessage = 'NO CONTACT PERSON ADDED';
    var l = getNoDataFound({
        message: sMessage,
        footer: sFooter
    });
    $('.no-contact_person').html(l);
    getAgencyType();
    getCountry();
    getRegions();
    getServicesAll();
    var new_contact_person = [];
    sessionStorage.setItem('contact_person', JSON.stringify(new_contact_person));
    loadContactAgencyList();
    $('.btn-add_contact_person').click(function () {

        $('#form-add-contact-person')[0].reset();
        $('#form-manage-address-con')[0].reset();
        $('#form-add-contact-person').validate().resetForm();
        $('#form-manage-address-con').validate().resetForm();
        $("#mdl-add-contact-person").modal('show');
        $('#btn-add-contact_person').attr('data-id', 1);
        $('.lbl-cont_datails_address').text('');
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
    $('#sel_country_con').change(function () {

        var country_id = $(this).val();
        if (country_id == '173') {
            $('.grp-brgy-con').show();
            $('.grp-city-con').show();
            $('.grp-region-con').show();
            $('#sel_region').trigger("click");
            getRegions(country_id);
        } else {
            $('#sel_brgy_con').val("0");
            $('#sel_city_con').val("0");
            $('#sel_region_con').val("0").change();
            $('.grp-brgy-con').css("display", "none");
            $('.grp-city-con').css("display", "none");
            $('.grp-region-con').css("display", "none");
            getStates_con(country_id);
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
    $('#sel_region_con').change(function () {
        var country_id = $('#sel_country_con').val();
        if (country_id == '173') {
            var region_id = $(this).val();
            $('#sel_city_con').html("<option value='0' selected disabled>Select City</option>");
            $('#sel_brgy_con').html("<option value='0' selected disabled>Select Barangay</option>");
            getProvinceByRegionID_con(region_id);
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
    $('#sel_state_prov_con').change(function () {
        var country_id = $('#sel_country_con').val();
        if (country_id == '173') {
            var province_id = $(this).val();
            getCities_con(province_id);
        }
        $('#sel_brgy_con').html("<option value='0' selected disabled>Select Barangay</option>");
    });
    $('#sel_city').change(function () {
        var country_id = $('#sel_country').val();
        if (country_id == '173') {
            var city_id = $(this).val();
            getBrgy(city_id);
        }
    });
    $('#sel_city_con').change(function () {
        var country_id = $('#sel_country_con').val();
        if (country_id == '173') {
            var city_id = $(this).val();
            getBrgy_con(city_id);
        }
    });
    $('.btn-add-address').click(function () {
        $('#form-manage-address').submit();
    });
    $('.btn-add-address_con').click(function () {
        $('#form-manage-address-con').submit();
    });
    $('.btn-add-agency-branch').click(function () {
        $('#frm_agency').submit();
    });
    $('.list-agency_contact').delegate('.ellipse-action', 'click', function (e) {
        var id = $(this).attr('data-id');
        if ($('#' + id).is(":visible")) {
            $('#' + id).hide();
            $('.a-ellipse').removeClass('ellipse-selected');
        } else {
            $('.action-menu').hide();
            $('.a-ellipse').removeClass('ellipse-selected');
            $('#' + id).show();
            $('.a-ellipse-' + id).addClass('ellipse-selected');
        }
    });
    $('#btn-add-contact_person').click(function () {
        $('#form-add-contact-person').submit();
    });
    $('.list-agency_contact').delegate('.rm-validate_id', 'click', function (e) {
        var id = $(this).attr('data-id');
        var aContent = JSON.parse(sessionStorage.getItem('contact_person'));
        aContent.splice(id, 1);
        sessionStorage.setItem('contact_person', JSON.stringify(aContent));
        $('.action-menu').hide();
        $('.a-ellipse').removeClass('ellipse-selected');
        loadContactAgencyList();
    });
    $('.list-agency_contact').delegate('.mng-validate_id', 'click', function () {

        $('#form-add-contact-person')[0].reset();
        $('#form-manage-address-con')[0].reset();
        $('#form-add-contact-person').validate().resetForm();
        $('#form-manage-address-con').validate().resetForm();
        var id = $(this).attr('data-id');
        var aContent = JSON.parse(sessionStorage.getItem('contact_person'));
        $('#btn-add-contact_person').attr('data-index', id);
        $('#txt_cont_fname').val(aContent[id]['fname']);
        $('#txt_cont_mname').val(aContent[id]['mname']);
        $('#txt_cont_lname').val(aContent[id]['lname']);
        $('#txt_cont_tel').val(aContent[id]['tel']);
        $('#txt_cont_mob').val(aContent[id]['mob']);
        $('#txt_cont_email').val(aContent[id]['email']);
        $('#sel_country_con').val(aContent[id]['country']).change();
        $('#sel_state_prov_con').attr('data-id', aContent[id]['pro_state']);
        $('#sel_region_con').attr('data-id', aContent[id]['region']);
        $('#sel_city_con').attr('data-id', aContent[id]['city']);
        $('#sel_brgy_con').attr('data-id', aContent[id]['brgy']);
        $('#area_detailed_con').val(aContent[id]['fadd']);
        $('.lbl-cont_datails_address').text('');
        selectContactAddress();
        $('#mdl-add-contact-person').modal('show');
        $('#btn-add-contact_person').attr('data-id', 2);
    });
    $('.input_check').iCheck({
        checkboxClass: 'icheckbox_square-orange',
        radioClass: 'iradio_square-orange',
        increaseArea: '20%' // optional
    });
    $('.btn-cont-address').click(function () {
        $('#mdl-add-contact-person').modal('hide');
        $('#mdl-manage-cont-address').modal('show');
    });
    $('.btn-close_modal_address_con').click(function () {
        $('#mdl-add-contact-person').modal('show');
        $('#mdl-manage-cont-address').modal('hide');
    });
    $('#msgmodal').delegate('#btn-yes', 'click', function (e) {
        window.location.reload();
    });
    $('#msgmodal').delegate('#btn-no', 'click', function (e) {
        window.location.href = "agency_branch";
    });

});
