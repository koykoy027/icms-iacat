function removeContactDetails(id) {
    icmsMessage({
        type: "msgPreloader",
        visible: true,
        body: "Please wait while removing contact details.",
    });

    $.post(sAjaxAgencies, {
        type: "setAgencyContact",
        id: id,
        agn_id: $('#inp-h-agency_branch_id').val(),
        agn_name: $('#txt_agency').val(),
        agn_branch: $('#txt_branchname').val()

    }, function (rs) {
        icmsMessage({
            type: "msgPreloader",
            visible: false,
        });
        icmsMessage({
            type: "msgSuccess",
            body: "You have successfully removed the agency contact",
            onShow: function () {
                loadContactAgencyList();
            }
        });

    }, 'json');
}
function saveAgencyBranchAddress() {
    var country = $('#sel_country').val();
    var region = $('#sel_region').val();
    var prov = $('#sel_state_prov').val();
    var city = $('#sel_city').val();
    var brgy = $('#sel_brgy').val();
    var detailed = $('#area_detailed').val();
    var addressid = $('.btn-save-agn-address').attr('data-address-id');

    $.post(sAjaxAgencies, {
        type: "setAgencyAddress",
        country: country,
        region: region,
        prov: prov,
        city: city,
        brgy: brgy,
        detailed: detailed,
        addressid: addressid,
        agn_id: $('#inp-h-agency_branch_id').val(),
        agn_name: $('#txt_agency').val(),
        agn_branch: $('#txt_branchname').val()
    }, function (rs) {
        icmsMessage({
            type: "msgPreloader",
            visible: false,
        });

        icmsMessage({
            type: "msgSuccess",
            body: "Agency address was successfully saved!",
            onShow: function () {
                $('.btn-save-cancel-agn-address').trigger("click");
            }
        });


    }, 'json');
}

function saveAgencyDetails() {

    var branch_name = $('#txt_branchname').val();
    var txt_email = $('#txt_email').val();
    var oldEmail = $('#txt_email').attr('oldemailvalue');
    var changeEmail = 1;
    if (txt_email == oldEmail) {
        changeEmail = 0;
    }
    var txt_tel = $('#txt_tel').val();
    var txt_mobile = $('#txt_mobile').val();
    var agn_branch_id = $('.btn-save-agn-details').attr('data-agency-id');
    var service_dropdown = $('#service_dropdown').val().toString();
    $('#service_dropdown').attr('current-service', service_dropdown);
    getServicesAll(); 
    
    var txt_agency = $('#txt_agency').val();
    var agency_branch_is_active = $('#inp-branch_status').val();
    $.post(sAjaxAgencies, {
        type: "setAgencyDetails",
        branch_name: branch_name,
        txt_email: txt_email,
        txt_tel: txt_tel,
        txt_mobile: txt_mobile,
        services_selected: service_dropdown,
        agn_branch_id: agn_branch_id,
        txt_agency: txt_agency,
        changeEmail: changeEmail,
        agency_branch_is_active: agency_branch_is_active
    }, function (rs) {
        icmsMessage({
            type: "msgPreloader",
            visible: false,
        });
        if (rs.data.result == "1") {
            icmsMessage({
                type: "msgSuccess",
                body: "You have successfully updated the agency branch",
                onShow: function () {
                    $('.btn-edit-cancel-agn-details').trigger("click");
                }
            });
        } else {
            icmsMessage({
                type: "msgWarning",
                body: "Email is not available"
            });

        }
    }, 'json');
}
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
        $('#sel_country').val($('#sel_country').attr('dataid')).change();
        $('#sel_country_con').html(l);
        if ($('#sel_country').attr('dataid') === "173") {
            $('#sel_region').parent('div').show();
            $('#sel_city').parent('div').show();
            $('#sel_brgy').parent('div').show();
        } else {
            $('#sel_region').parent('div').css("display", "none");
            $('#sel_city').parent('div').css("display", "none");
            $('#sel_brgy').parent('div').css("display", "none");
        }




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
        $('#sel_region').val($('#sel_region').attr('dataid')).change();
        $('#sel_region_con').html(l);

        $('#sel_region_con').val($('.btn-cont-address').attr('data-region')).change();

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
        $('#sel_state_prov').val($('#sel_state_prov').attr('dataid')).change();
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
        $('#sel_state_prov_con').val($('.btn-cont-address').attr('data-province')).change();


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
        $('#sel_state_prov').val($('#sel_state_prov').attr('dataid')).change();
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
        $('#sel_state_prov_con').val($('.btn-cont-address').attr('data-province')).change();


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
        $('#sel_city').val($('#sel_city').attr('dataid')).change();
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
        $('#sel_city_con').val($('.btn-cont-address').attr('data-city')).change();
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

        $('#sel_brgy').val($('#sel_brgy').attr('dataid')).change();
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
        $('#sel_brgy_con').val($('.btn-cont-address').attr('data-brgy')).change();

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
        $('.lbl-agency_datails_address').text(full_address);
    }
});

$('.btn-cont-address').click(function () {
    $('#mdl-add-contact-person').modal('hide');
    $('#mdl-manage-cont-address').modal('show');
    $('.btn-cont-address').css('border', '1px solid #ced4da');
    $('#txt_cont_error').addClass('hide');

});

$.validator.addMethod("validateConnectionAddress", function (value, element) {
    if ($('.btn-cont-address').attr('data-country') == "0") {
        $('.btn-cont-address').css('border', '1px solid #fd7e14');
        $('#txt_cont_error').removeClass('hide');
    }
    return true;
}, "");

$('#form-add-contact-person').validate({
    rules: {
        txt_cont_fname: {required: true},
        txt_cont_lname: {required: true},
        txt_cont_mob: {required: true},
        txt_cont_email: {
            required: true,
            emailFormat: true,
            validateConnectionAddress: true
        },
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
        var country = $('#sel_country_con').val();
        var pro = $('#sel_state_prov_con').val();
        var address = $('#area_detailed_con').val();
        //comment agency contact person address condition
//        if (country !== "" && country !== null && pro !== "" && pro !== null && address !== "" && address !== null) {
        $('#mdl-add-contact-person').modal('hide');
        icmsMessage({
            type: "msgConfirmation",
            title: "You are about to add new agency contact",
            onConfirm: function () {
                icmsMessage({
                    type: "msgPreloader",
                    visible: true
                });
                addNewAgencyContactDetails();
            },
            onCancel: function () {
                $('#mdl-add-contact-person').modal('show');
            }
        });
//        }


    }
});

$.validator.addMethod("validateRegionCon", function (value, element) {
    if ($('.grp-region-con:visible').length == 0) {
        return true;
    } else {
        if (parseInt($('#sel_region_con').val()) >= 1) {
            return true;
        }
    }

}, "This field is required.");
$('#form-manage-address-con').validate({
    rules: {
        sel_country_con: {required: true},
        sel_state_prov_con: {required: true},
        area_detailed_con: {required: true},
        sel_region_con: {
            validateRegionCon: true,
        },
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
        $('.btn-cont-address').attr('data-country', $('#sel_country_con').val() === null ? "0" : $('#sel_country_con').val());
        $('.btn-cont-address').attr('data-region', $('#sel_region_con').val() === null ? "0" : $('#sel_region_con').val());
        $('.btn-cont-address').attr('data-province', $('#sel_state_prov_con').val() === null ? "0" : $('#sel_state_prov_con').val());
        $('.btn-cont-address').attr('data-city', $('#sel_city_con').val() === null ? "0" : $('#sel_city_con').val());
        $('.btn-cont-address').attr('data-brgy', $('#sel_brgy_con').val() === null ? "0" : $('#sel_brgy_con').val());
        $('.btn-cont-address').attr('data-address', $('#area_detailed_con').val());
    }
});

$('#frm_agency').validate({
    rules: {
        sel_category: {required: true},
        txt_brachname: {required: true},
        sel_category: {required: true},
        txt_email: {required: true},
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
            addAgencyBranch();
        }
    }
});


function loadContactAgencyList() {

    icmsMessage({
        type: "msgPreloader",
        visible: true,
        body: "Please wait while loading information."
    });

    $.post(sAjaxAgencies, {
        type: "getAgencyContactByAgencyBranchID",
        agency_id: $('#inp-h-agency_branch_id').val(),
    }, function (rs) {

        icmsMessage({
            type: "msgPreloader",
            visible: false
        });

        var list = '';
        if (rs.data.result == "1") {
            var ctr = 1;
            $.each(rs.data.list, function (key, val) {
                list += '<tr>';

                list += '    <td><b>Name</b> :' + val.agency_contact_firstname + ' ' + val.agency_contact_middle_name + ' ' + val.agency_contact_lastname;
                if (val.is_primary != '1') {
                    list += '';

                } else {
                    $('.div-is_primary').hide();
                    list += '<span style="padding-left:10px;"> <i class="fas fa-star primary-contact"></i> </span>';
                }

                list += '<br>';

                if (val.agency_contact_mobile_number !== "" && val.agency_contact_telephone_number !== "") {
                    list += "<b>Contact</b> : " + val.agency_contact_mobile_number + " | " + val.agency_contact_telephone_number;
                } else if (val.agency_contact_mobile_number !== "") {
                    list += "<b>Contact</b> : " + val.agency_contact_mobile_number;
                } else if (val.agency_contact_telephone_number !== "") {
                    list += "<b>Contact</b> : " + val.agency_contact_telephone_number;
                }
                list += '<br>';
                list += "<b>Email</b> : " + val.agency_contact_email;
                list += '</td>';
                list += '    <td>' + val.address.address_list_address + ' ' + val.address.brgy + ' ' + val.address.city + ' ' + val.address.province + ' ' + val.address.country + '</td>';

                list += '    <td class="text-center">';
                list += '       <div class="btn-group ellipse-action " data-id="' + ctr + '" data-tab="validate">';
                list += '            <a class="a-ellipse a-ellipse-' + ctr + '">  <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </a>';
                list += '            <div class="action-menu" id="' + ctr + '" cont-prime="' + val.agency_contact_is_primary + '" country="' + val.address.address_list_country + '" region="' + val.address.address_list_region + '" province="' + val.address.address_list_province + '" city="' + val.address.address_list_city + '" brgy="' + val.address.address_list_brgy + '" detailed="' + val.address.address_list_address + '">';
                list += '                <a class="dropdown-item disabled action-title" href="#">Select Action</a>';
                list += '                <a class="dropdown-item mng-validate_id" addressid="' + val.address.address_list_id + '" email="' + val.agency_contact_email + '" tel="' + val.agency_contact_telephone_number + '" mob="' + val.agency_contact_mobile_number + '" lname="' + val.agency_contact_lastname + '" mname="' + val.agency_contact_middle_name + '" fname="' + val.agency_contact_firstname + '" dataid="' + val.agency_contact_id + '">Manage contact info</a>';
                list += '                <a class="dropdown-item rm-validate_id" dataid="' + val.agency_contact_id + '">Remove</a>';
                list += '            </div>';
                list += '        </div>';
                list += '    </td>';
                list += '</tr>';
                ctr++;
            });
            $('.list-agency_contact').html(list);
            $('#tbl-agency_contact_person').show();
            $(".div-contact_person").hide();
            $('.no-contact_person').hide();
            $('#tbl-agency-contact_container').show();

        } else {
            $('#tbl-agency_contact_person').hide();
            $(".div-contact_person").show();
            $('.no-contact_person').show();
            $('#tbl-agency-contact_container').hide();
        }
    }, 'json');


}

function addNewAgencyContactDetails() {

    $.post(sAjaxAgencies, {
        type: "addNewAgencyContactDetails",
        country: $('.btn-cont-address').attr('data-country'),
        region: $('.btn-cont-address').attr('data-region'),
        province: $('.btn-cont-address').attr('data-province'),
        city: $('.btn-cont-address').attr('data-city'),
        brgy: $('.btn-cont-address').attr('data-brgy'),
        address: $('.btn-cont-address').attr('data-address'),
        is_primary: $("#is_primary").attr("checked") ? 1 : 0,
        fname: $('#txt_cont_fname').val(),
        mname: $('#txt_cont_mname').val(),
        lname: $('#txt_cont_lname').val(),
        tel: $('#txt_cont_tel').val(),
        mob: $('#txt_cont_mob').val(),
        email: $('#txt_cont_email').val(),
        agencyid: $('#btn-add-contact_person').attr('agn-id'),
        action: $('#btn-add-contact_person').attr('dataaction'),
        contactid: $('#btn-add-contact_person').attr('contactid'),
        addressid: $('.btn-cont-address').attr('data-addressid'),
        agn_name: $('#txt_agency').val(),
        agn_branch: $('#txt_branchname').val()
    }, function (rs) {

        icmsMessage({
            type: "msgPreloader",
            visible: false
        });

        if (rs.data.result == "1") {
            icmsMessage({
                type: "msgSuccess",
                body: "You have successfully added an agency branch contact",
            });
            $('.btn-cont-address').attr('data-country', "0");
            $('.btn-cont-address').attr('data-region', "0");
            $('.btn-cont-address').attr('data-province', "0");
            $('.btn-cont-address').attr('data-city', "0");
            $('.btn-cont-address').attr('data-brgy', "0");
            $('.btn-cont-address').attr('data-address', "0");
            $('#form-add-contact-person')[0].reset();
            $('#form-manage-address-con')[0].reset();
            $('#form-add-contact-person').validate().resetForm();
            $('#form-manage-address-con').validate().resetForm();
            loadContactAgencyList();

        } else {
            icmsMessage({
                type: "msgWarning",
                body: "Please check input details carefully"
            });
        }


    }, 'json');


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

        var aServices = [];

        var l = "<option value=''></option>";
        $.each(rs.data.type_name, function (k_tn, v_tn) {
            l += '<optgroup label="' + v_tn + '">';
            $.each(rs.data.list, function (key, val) {
                if (v_tn == val.service_type_name) {
                    aServices[val.services_id ] = v_tn + ' | ' + val.service_name;
                    l += '<option value="' + val.services_id + '">' + val.service_name + '</option>';
                }
            });
            l += '</optgroup>';
        });

        $('#service_dropdown').html(l);
                                                                            
        l = '';
        var arr_selected = $('#service_dropdown').attr('current-service');
        if (arr_selected.length >= 1) {
            var current_service = arr_selected.split(',');
            $.each(current_service, function (key, val) {
                $("#service_dropdown option[value=" + val + "]").prop("selected", true);
                l += '<li>' + aServices[val] + '</li>';
            });
        }
        $('#service_dropdown').chosen();
        $('#ul-agency-services-label').html(l); 
        $('.div-agency-services').hide();
        
    }, 'json');



}

function disabledAddress() {
    $('#sel_country').attr("disabled", "disabled");
    $('#sel_region').attr("disabled", "disabled");
    $('#sel_state_prov').attr("disabled", "disabled");
    $('#sel_city').attr("disabled", "disabled");
    $('#sel_brgy').attr("disabled", "disabled");
    $('#area_detailed').attr("disabled", "disabled");
}

function enabledAddress() {
    $('.btn-save-agn-address').removeClass('hide');
    $('#sel_country').removeAttr("disabled");
    $('#sel_region').removeAttr("disabled");
    $('#sel_state_prov').removeAttr("disabled");
    $('#sel_city').removeAttr("disabled");
    $('#sel_brgy').removeAttr("disabled");
    $('#area_detailed').removeAttr("disabled");
}



$(document).ready(function () {

    var sFooter = '<button type="button" class="btn btn-add_contact_person" style="background-color: #7ba5e4; color: #fff;"> ADD CONTACT PERSON </button>';
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
        $('#btn-add-contact_person').attr('dataaction', 1);
        $('.lbl-cont_datails_address').text('');
        $('#btn-add-contact_person').attr('contactid', 0);

        $('.btn-cont-address').attr('data-country', "0");
        $('.btn-cont-address').attr('data-region', "0");
        $('.btn-cont-address').attr('data-province', "0");
        $('.btn-cont-address').attr('data-city', "0");
        $('.btn-cont-address').attr('data-brgy', "0");
        $('.btn-cont-address').attr('data-address', "0");
        $("#is_primary").prop("checked", false);
        $('#txt_cont_fname').val("");
        $('#txt_cont_mname').val("");
        $('#txt_cont_lname').val("");
        $('#txt_cont_tel').val("");
        $('#txt_cont_mob').val("");
        $('#txt_cont_email').val("");


    });

    $('.list-agency_contact').delegate('.mng-validate_id', 'click', function () {
        $('#btn-add-contact_person').attr('dataaction', 2);
        $('#btn-add-contact_person').attr('contactid', $(this).attr('dataid'));

        $('.btn-cont-address').attr('data-country', $(this).parent('div').attr('country'));
        $('.btn-cont-address').attr('data-region', $(this).parent('div').attr('region'));
        $('.btn-cont-address').attr('data-brgy', $(this).parent('div').attr('brgy'));
        $('.btn-cont-address').attr('data-province', $(this).parent('div').attr('province'));
        $('.btn-cont-address').attr('data-city', $(this).parent('div').attr('city'));
        $('.btn-cont-address').attr('data-addressid', $(this).attr('addressid'));
        $('.btn-cont-address').attr('data-address', $(this).parent('div').attr('detailed'));
        $('#area_detailed_con').val($(this).parent('div').attr('detailed'));
        var prim = $(this).parent('div').attr('cont-prime');
        if (prim == "1") {
            $("#is_primary").prop("checked", true);
        } else {
            $("#is_primary").prop("checked", false);
        }
        $('#txt_cont_fname').val($(this).attr('fname'));
        $('#txt_cont_mname').val($(this).attr('mname'));
        $('#txt_cont_lname').val($(this).attr('lname'));
        $('#txt_cont_tel').val($(this).attr('tel'));
        $('#txt_cont_mob').val($(this).attr('mob'));
        $('#txt_cont_email').val($(this).attr('email'));

        $('#sel_country_con').val($('.btn-cont-address').attr('data-country')).change();

        $("#mdl-add-contact-person").modal('show');
    });

    $('#btn-add-contact_person').click(function () {
        var action = $(this).attr("dataaction");
        if (action == "1") {
            //new contact
            $('#form-add-contact-person').submit();
        } else {
            //update contact
            $('#form-add-contact-person').submit();
        }
    });

    $('#sel_country').change(function () {
        var country_id = $(this).val();
        if (country_id == '173') {
            $('#sel_region').parent('div').show();
            $('#sel_city').parent('div').show();
            $('#sel_brgy').parent('div').show();
            getRegions();
        } else {
            $('#sel_brgy').val("0");
            $('#sel_city').val("0");
            $('#sel_region').val("0").change();
            $('#sel_region').parent('div').css("display", "none");
            $('#sel_city').parent('div').css("display", "none");
            $('#sel_brgy').parent('div').css("display", "none");
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




    $('.input_check').iCheck({
        checkboxClass: 'icheckbox_square-orange',
        radioClass: 'iradio_square-orange',
        increaseArea: '20%' // optional
    });

    $('.btn-cont-address').click(function () {
//        $('#mdl-add-contact-person').modal('hide');
//        $('#mdl-manage-cont-address').modal('show');
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

    $('.btn-edit-cancel-agn-details').click(function () {
        var caption = $(this).text();
        if (caption == "Manage") {
            $(this).text("Cancel");
            $('.btn-save-agn-details').removeClass('hide');
            $('#txt_branchname').removeAttr("disabled");
            $('#txt_email').removeAttr("disabled");
            $('#txt_tel').removeAttr("disabled");
            $('#txt_mobile').removeAttr("disabled");
            $('#service_dropdown').removeAttr("disabled");
            //$('#service_dropdown_chosen').removeClass("chosen-disabled");
            $('.div-agency-services').show();
            $('.div-agency-services-label').hide();
            $('#inp-branch_status').removeAttr("disabled");
        } else {
            $(this).text("Manage");
            $('.btn-save-agn-details').addClass('hide');
            $('#txt_branchname').attr("disabled", "disabled");
            $('#txt_email').attr("disabled", "disabled");
            $('#txt_tel').attr("disabled", "disabled");
            $('#txt_mobile').attr("disabled", "disabled");
            $('#service_dropdown').attr("disabled", "disabled");
            //$('#service_dropdown_chosen').addClass("chosen-disabled");
             $('.div-agency-services-label').show();
             $('.div-agency-services').hide();
            $('#inp-branch_status').attr("disabled", "disabled");
        }
    });

    $('.btn-save-cancel-agn-address').click(function () {
        var caption = $(this).text();
        if (caption == "Manage") {
            $(this).text("Cancel");
            enabledAddress();
        } else {
            $(this).text("Manage");
            $('.btn-save-agn-address').addClass("hide");
            disabledAddress();
        }

    });

    $('.btn-save-agn-address').click(function () {
        $('#frm-agency-address').submit();
    });

    $.validator.addMethod("validateRegion", function (value, element) {
        if ($('.grp-region:visible').length == 0) {
            return true;
        } else {
            if (parseInt($('#sel_region').val()) >= 1) {
                return true;
            }
        }
    }, "This field is required.");

    $('#frm-agency-address').validate({
        rules: {
            sel_country: {required: true},
            sel_region: {validateRegion: true},
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
            icmsMessage({
                type: "msgConfirmation",
                title: "You are about to update agency branch address details.",
                onConfirm: function () {
                    icmsMessage({
                        type: "msgPreloader",
                        visible: true
                    });
                    saveAgencyBranchAddress();
                }
            });
        }
    });

    $('.btn-save-agn-details').click(function () {
        $('#div-agency-services-error').remove();
        var srv = $('#service_dropdown').val();
        if (srv.length <= 0) {
            $('.div-agency-services').append('<div id="div-agency-services-error" class="error">This field is required.</div>');
        } else {
            $('#frm-agn-branch').submit();
        }
    });

    $('#frm-agn-branch').validate({
        rules: {
            txt_branchname: {required: true},
            txt_email: {
                required: true,
                emailFormat: true,
            },
            service_dropdown: {required: true},
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
            icmsMessage({
                type: "msgConfirmation",
                title: "You are about to update agency branch details.",
                onConfirm: function () {
                    icmsMessage({
                        type: "msgPreloader",
                        visible: true
                    });
                    saveAgencyDetails();
                }
            });
        }
    });

    $('.list-agency_contact').delegate('.rm-validate_id', 'click', function () {
        var id = $(this).attr('dataid');
        icmsMessage({
            type: "msgConfirmation",
            title: "You are about to remove agency contact.",
            onConfirm: function () {
                icmsMessage({
                    type: "msgPreloader",
                    visible: true
                });
                removeContactDetails(id);
            }
        });

    });




    $('#msgmodal').delegate('.msg-modal-warning-address', 'click', function () {
        $('#mdl-add-contact-person').modal('show');
        $('#msgmodal').modal('hide');
    });

});
