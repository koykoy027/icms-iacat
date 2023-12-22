/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// get list of global data
function getListGlobalData() {
    var l = '';
    $.post(sAjaxSettings, {
        type: "getListGlobalData"
    }, function (rs) {
        // other
        $.each(rs.data.other, function (key, val) {
            l += `<a class="nav-link dropdown-item" data-toggle="pill" href="#" role="tab" aria-selected="false" attr-type= "3" attr-id = ${val.type}>   ${val.parameter_title}   </a> `;
        });
        // transaction
        $.each(rs.data.transaction, function (key, val) {
            if (key == 0) {
                l += '<a class="nav-link dropdown-item active"  data-toggle="pill" href="#" role="tab" aria-selected="true" attr-type= "1" attr-id = ' + val.transaction_parameter_type_id + '> ' + val.transaction_parameter_type_name + ' </a> ';
                getListTransactionParameterByID(val.transaction_parameter_type_id);
            } else {
                l += ' <a class="nav-link dropdown-item" data-toggle="pill" href="#" role="tab" aria-selected="false" attr-type= "1" attr-id = ' + val.transaction_parameter_type_id + '> ' + val.transaction_parameter_type_name + ' </a> ';
            }

        });
        // global data
        $.each(rs.data.global, function (key, val) {
            l += ' <a class="nav-link dropdown-item" data-toggle="pill" href="#" role="tab" aria-selected="false" attr-type= "2" attr-id = ' + val.global_parameter_type_id + '> ' + val.global_parameter_type_name + ' </a> ';
        });
        $('.list-globaldata').html(l);
    }, 'json');
}

// get list of province
function getProvinces() {
    $.post(sAjaxGlobalData, {
        type: "getProvinces",
    }, function (rs) {
        l = "<option value='0' selected disabled>Select Province</option>";
        $.each(rs.data, function (key, val) {
            l += "<option value='" + val.location_count_id + "'>" + val.location_name + " </option>"
        });
        $('#sel_ph_state_prov').html(l);
    }, 'json');
}

// get list of cities in add 
function getCities(province_id) {
    $.post(sAjaxGlobalData, {
        type: "getCityByProvinceID",
        province_id: province_id,
    }, function (rs) {
        l = "<option value='0' selected disabled>Select City</option>";
        $.each(rs.data, function (key, val) {
            l += "<option value='" + val.location_count_id + "'>" + val.location_name + " </option>";
        });
        $('#sel_ph_city').html(l);
    }, 'json');
}


/* 
 *     Start Ph Port 
 */

// get ph port list 
function getPhPort(page = 1) {
    var limit = 10;
    var l = '';
    var keyword = $('#search-port').val();

    $.post(sAjaxSettings, {
        limit: limit,
        page: page,
        keyword: keyword,
        type: "getPhPort"
    }, function (rs) {
        if (parseInt(rs.data.content.count) > 0) {
            $('#tbl-cnt-portList').show();
            $('#portList-no-content').remove();

            var other = "";
            $.each(rs.data.content.list, function (key, val) {
                var status = "Inactive";
                var x = val.port_name;
                if (val.port_is_active == '1') {
                    status = "Active";
                }

                if (x.toLowerCase() == "other") {
                    other += '<tr class="tbody-details">';
                    other += '<td>';
                    other += '                      <span class="icms-text-secondary">Port Name: </span>';
                    other += '                      <span class="">' + val.port_name + ' </span><br>';
                    other += '                      <span class="icms-text-secondary">Port Type : </span>';
                    other += '                      <span class=""><span>' + val.parameter_name + '</span></span><br>';
                    other += '                      <span class="icms-text-secondary">Location: </span>';
                    other += '                      <span class="">' + val.province + ' ' + val.city + '</span><br>';
                    other += '</td>';
                    other += '<td>';
                    other += '                  ' + status + '';
                    other += '</td>';
                    other += '<td>';
                    other += '	<div class="btn-group ellipse-action " data-id="' + val.port_id + '">';
                    other += '          <a class="a-ellipse a-ellipse-' + val.port_id + ' " >  <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </a>';
                    other += '          <div class="action-menu" id="port-' + val.port_id + '">';
                    other += '              <a class="dropdown-item a-port_manage" href="#" attr-port-id= "' + val.port_id + '" attr-port-name="' + val.port_name + '" attr-port-province="' + val.province_id + '" attr-port-city="' + val.city_id + '"attr-port-parameter="' + val.parameter_name + '"attr-port-type="' + val.port_type + '"attr-port-status="' + status + '" attr-port-is-active="' + val.port_is_active + '" >Manage</a>';
                    other += '  	</div>';
                    other += '</td>';
                    other += '</tr>';

                } else {
                    l += '<tr class="tbody-details">';
                    l += '<td>';
                    l += '                      <span class="icms-text-secondary">Port Name: </span>';
                    l += '                      <span class="">' + val.port_name + ' </span><br>';
                    l += '                      <span class="icms-text-secondary">Port Type : </span>';
                    l += '                      <span class=""><span>' + val.parameter_name + '</span></span><br>';
                    l += '                      <span class="icms-text-secondary">Location: </span>';
                    l += '                      <span class="">' + val.province + ' ' + val.city + '</span><br>';
                    l += '</td>';
                    l += '<td>';
                    l += '       ' + status + '';
                    l += '</td>';
                    l += '<td>';
                    l += '	<div class="btn-group ellipse-action " data-id="' + val.port_id + '">';
                    l += '          <a class="a-ellipse a-ellipse-' + val.port_id + ' " >  <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </a>';
                    l += '          <div class="action-menu" id="port-' + val.port_id + '">';
                    l += '              <a class="dropdown-item a-port_manage" href="#" attr-port-id= "' + val.port_id + '" attr-port-name="' + val.port_name + '" attr-port-province="' + val.province_id + '" attr-port-city="' + val.city_id + '"attr-port-parameter="' + val.parameter_name + '"attr-port-type="' + val.port_type + '"attr-port-status="' + status + '" attr-port-is-active="' + val.port_is_active + '" >Manage</a>';
                    l += '  	</div>';
                    l += '</td>';
                    l += '</tr>';
                }
            });
            if (other != "") {
                l += other;
            }

            $('.tbodyPortList').html(l);

            // pagination
            buildPagination({
                parent: 'rs-list-port',
                info: 'rs-info-port',
                pagination: 'rs-pagination-port',
                offset: 'rs-offset',
                data: {
                    page: page,
                    offset: limit,
                    count: rs.data.content.count
                }
            });
        } else {

            var sMessage = 'SORRY, WE COULDN\'T FIND ANY PHILIPPINE PORT/S DETAILS RELATED TO <span class = "font-italic" >"<span>' + keyword + '</span>"</span>.';
            if (!(keyword)) {
                sMessage = 'NO PHILIPPINE PORT/S DETAILS FOUND.';
            }
            var l = getNoDataFound({
                message: sMessage,
                footer: ''
            });

            $('#tbl-cnt-portList').hide();
            $('#portList-no-content').remove();
            $('#tbl-cnt-portList').after("<div id='portList-no-content'>" + l + "</div>");
        }


    }, 'json');
}

// add ph port 
function addPort() {

    icmsMessage({
        type: 'msgPreloader',
        visible: true
    });

    var port_name = $('#name_port_name').val();
    var port_province = $('#sel_ph_state_prov').val();
    var port_city = $('#sel_ph_city').val();
    var global_port_type = $('#inp-global_port_type').val();
    var global_port_status = $('#inp-global_port_status').val();
    $.post(sAjaxSettings, {
        type: "addPhPort",
        port_name: port_name,
        port_province: port_province,
        port_city: port_city,
        global_port_type: global_port_type,
        global_port_status: global_port_status
    }, function (rs) {

        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });

        icmsMessage({
            type: 'msgSuccess',
            onShow: function () {
                $('#form-add_port')[0].reset();
                getPhPort();
            }
        });

    }, 'json');
}

//manage province
function getManageProvinces() {
    $.post(sAjaxGlobalData, {
        type: "getProvinces",
    }, function (rs) {
        l = "<option value='0' selected disabled>Select Province</option>";
        $.each(rs.data, function (key, val) {
            l += "<option value='" + val.location_count_id + "'>" + val.location_name + " </option>"
        });
        $('#sel_ph_manage_state_prov').html(l);
    }, 'json');
}

// manage cities
function getManageCities(port_city = 0) {
    var province_id = $('#sel_ph_manage_state_prov').val();
    $.post(sAjaxGlobalData, {
        type: "getCityByProvinceID",
        province_id: province_id,
    }, function (rs) {
        l = "<option value='0' selected disabled>Select City</option>";
        $.each(rs.data, function (key, val) {
            l += "<option value='" + val.location_count_id + "'>" + val.location_name + " </option>";
        });
        $('#sel_manage_city').html(l);
        $('#sel_manage_city').val(port_city).change();
    }, 'json');
}

// set pg port  
function setPort() {

    icmsMessage({
        type: 'msgPreloader',
        visible: false
    });

    var port_name = $('#manage_port_name').val();
    var port_id = $('#btn_update_port').attr('attr-port-id');
    var port_province = $('#sel_ph_manage_state_prov').val();
    var port_city = $('#sel_manage_city').val();
    var global_port_type = $('#inp-manage_port_type').val();
    var global_port_status = $('#inp-manage_port_status').val();
    $.post(sAjaxSettings, {
        type: "setPhPort",
        port_name: port_name,
        port_id: port_id,
        province_id: port_province,
        city_id: port_city,
        global_port_type: global_port_type,
        global_port_status: global_port_status
    }, function (rs) {

        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });

        icmsMessage({
            type: 'msgSuccess',
            onHide: function () {
                $('#mdl-manage_port').modal('hide');
                $('#form-manage_port')[0].reset();
                getPhPort();
            }
        });


    }, 'json');
}

/* 
 *       End Ph Port 
 */


/* 
 * Start of Dictionary
 */

function addDictionary() {

    icmsMessage({
        type: 'msgPreloader',
        visible: true
    });

    var term = $('#add_term').val();
    var term_description = $('#add_description').val();
    var term_status = $('#inp-add_term_status').val();
    $.post(sAjaxSettings, {
        type: "addDictionary",
        term: term,
        term_description: term_description,
        term_status: term_status
    }, function (rs) {

        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });

        icmsMessage({
            type: 'msgSuccess',
            onShow: function () {
                $('#mdl-add_data_dictionary').modal('hide');
                $('#form-add_data_dictionary')[0].reset();
                getDictionary();
            }
        });

    }, 'json');
}

function getDictionary(page = 1) {
    var keyword = $('#inp-dictionary_search').val();
    var limit = 10;
    $.post(sAjaxSettings, {
        type: "getDictionary",
        limit: limit,
        page: page,
        keyword: keyword,
        limit: limit
    }, function (rs) {

        if (parseInt(rs.data.content.count) > 0) {
            $('#tbl-cnt-dataDictionaryList').show();
            $('#dataDictionaryList-no-content').remove();
            var l = '';
            $.each(rs.data.content.list, function (key, val) {
                var status = "Hidden";
                var dictionary = "";
                var desc = val.dictionary_description;
                var newDesc = '';
                if (desc.length >= 220) {
                    if (desc.length > 220) {
                        newDesc += '<span id ="summary-desc_' + val.agency_id + '">';
                        newDesc += desc.substr(0, 220) + '...';
                        newDesc += '   <a class="view_more"> <span class ="ellipse-selected"> read more </span> </a>';
                        newDesc += '</span>';
                        newDesc += '<span class="hide" id ="full-desc_' + val.agency_id + '">' + desc;
                        newDesc += '   <a class="view_less" attr-id="' + val.agency_id + '"> <span class="ellipse-selected"> read less </span> </a>';
                        newDesc += '</span>';
                    }
                } else {
                    newDesc = desc;
                }

                if (val.dictionary_is_active == '1') {
                    status = "Show";
                }

                l += '<tr class="tbody-details">';
                l += '<td style="width:70%">';
                l += '    <span class="dictionary-word"><pre>' + val.dictionary_name + '</pre></span><br>';
                l += '    <span class="">' + newDesc + '</span>';
                l += '</td>';
                l += '      <td style="width:15%">' + status + '</td>';
                l += '      <td style="width:10%">';
                l += '            <div class="btn-group ellipse-action " data-id="' + val.dictionary_id + '">';
                l += '          <a class="a-ellipse a-ellipse-' + val.dictionary_id + ' " >  <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </a>';
                l += '          <div class="action-menu" id="dictionary-' + val.dictionary_id + '">';
                // l += '              <a class="dropdown-item disabled action-title" href="#">Select Action</a>';
                l += '              <a class="dropdown-item a-dictionary_manage" href="#" attr-dictionary-id= "' + val.dictionary_id + '" attr-dictionary-name="' + val.dictionary_name + '" attr-dictionary-description="' + val.dictionary_description + '"attr-dictionary-status="' + val.dictionary_is_active + '" >Manage</a>';
                l += '          </div>';
                l += '      </td>'
                l += '</tr>';
            });
            $('.tbodyDataDictionary').html(l);

            // pagination
            buildPagination({
                parent: 'rs-list-datadictionary',
                info: 'rs-info-datadictionary',
                pagination: 'rs-pagination-datadictionary',
                offset: 'rs-offset',
                data: {
                    page: page,
                    offset: limit,
                    count: rs.data.content.count
                }
            });

        } else {

            var sMessage = 'SORRY, WE COULDN\'T FIND ANY DATA DICTIONARY DETAILS RELATED TO <span class = "font-italic" >"<span>' + keyword + '</span>"</span>.';
            if (!(keyword)) {
                sMessage = 'NO DATA DICTIONARY DETAILS FOUND.';
            }
            var l = getNoDataFound({
                message: sMessage,
                footer: ''
            });

            $('#tbl-cnt-dataDictionaryList').hide();
            $('#dataDictionaryList-no-content').remove();
            $('#tbl-cnt-dataDictionaryList').after("<div id='dataDictionaryList-no-content'>" + l + "</div>");

        }

    }, 'json');
}

function setDictionary() {

    icmsMessage({
        type: 'msgPreloader',
        visible: true
    });

    var term = $('#manage_term').val();
    var dictionary_id = $('#btn_update_dictionary').attr('attr-dictionary-id');
    var term_description = $('#manage_description').val();
    var term_status = $('#inp-manage_term_status').val();
    $.post(sAjaxSettings, {
        type: "setDictionary",
        term: term,
        dictionary_id: dictionary_id,
        term_description: term_description,
        term_status: term_status
    }, function (rs) {

        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });

        icmsMessage({
            type: 'msgSuccess',
            onShow: function () {
                $('#mdl-data_dictionary').modal('hide');
                $('#form-data_dictionary')[0].reset();
                getDictionary();
            }
        });

    }, 'json');
}

/* 
 *End of dictionary
 */

/* 
 * Start Global Parameter 
 */

function getListGlobalParameterByID(id = '') {

    $('#bnt-save_global_desc').attr('attr-type', '2');
    $('#bnt-save_global_desc').attr('attr-id', id);
    var parameter_type_id = id;
    var l = '';
    $('#tbody-global_data').html(l);
    $.post(sAjaxSettings, {
        type: "getListGlobalParameterByID",
        parameter_type_id: parameter_type_id
    }, function (rs) {

        var sDescription = rs.data.detail.global_parameter_description;
        if (sDescription.length == 0) {
            sDescription = 'No description found.';
        }

        $('#global_data-description').val(sDescription);
        $('#global_data-title').val(rs.data.detail.global_parameter_type_name);
        $('.lbl-global_data-title').text(rs.data.detail.global_parameter_type_name);
        $('.lbl-global_data-title').attr('data-text', rs.data.detail.global_parameter_type_name);
        $.each(rs.data.list, function (key, val) {

            var status = 'Inactive';
            var mStatus = 'Active';
            if (val.parameter_status != 0) {
                status = 'Active';
                mStatus = 'Deactive';
            }

            l += ' <tr class="tbody-details">';
            l += '     <td>' + val.parameter_name + '</td>';
            l += '     <td>' + status + '</td>';
            l += '     <td>';
            l += '      <div class="btn-group ellipse-action " data-id="' + val.parameter_count_id + '">';
            l += '          <a class="a-ellipse a-ellipse-' + val.parameter_count_id + ' " >  <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </a>';
            l += '          <div class="action-menu" id="' + val.parameter_count_id + '">';
            l += '              <a class="dropdown-item disabled action-title" href="#">Select Action</a>';
            l += '              <a class="dropdown-item a-global_manage" href="#" attr-count-id= "' + val.parameter_count_id + '" attr-stat="' + val.parameter_status + '" attr-name="' + val.parameter_name + '" >Manage</a>';
            l += '              <a class="dropdown-item a-global_change_status" href="#" attr-stat="' + val.parameter_status + '" attr-count-id= "' + val.parameter_count_id + '" >Change Status to ' + mStatus + '</a>';
            l += '       	</div>';
            l += '     </td>';
            // l += '     <td><button class="btn btn-manage" data-toggle="modal" data-target="#"><i class="fas fa-ellipsis-v"></i></button></td>';

            l += '</tr>';
        });
        // clear data table
        $("#tbl-global_data").DataTable().clear().destroy();
        // build 
        $('#tbody-global_data').html(l);
        // ini data table 
        declareGBLDatatable();
    }, 'json');
}

function getListTransactionParameterByID(id = '') {

    $('#bnt-save_global_desc').attr('attr-type', '1');
    $('#bnt-save_global_desc').attr('attr-id', id);
    var transaction_parameter_type_id = id;
    var l = '';
    $('#tbody-global_data').html(l);
    $.post(sAjaxSettings, {
        type: "getListTransactionParameterByID",
        transaction_parameter_type_id: transaction_parameter_type_id
    }, function (rs) {


        var sDescription = rs.data.detail.transaction_parameter_description;
        if (sDescription.length == 0) {
            sDescription = 'No description found.';
        }

        $('#global_data-description').val(sDescription);
        $('#global_data-title').val(rs.data.detail.transaction_parameter_type_name);
        $('.lbl-global_data-title').text(rs.data.detail.transaction_parameter_type_name);
        $('.lbl-global_data-title').attr('data-text', rs.data.detail.transaction_parameter_type_name);
        // $('#global_data-title').style.width =  (($('#global_data-title').value.length + 1) * 10) + 'px';


        $.each(rs.data.list, function (key, val) {

            var status = 'Inactive';
            var mStatus = 'Active';
            if (val.transaction_parameter_status != 0) {
                status = 'Active';
                mStatus = 'Deactive';
            }

            l += ' <tr class="tbody-details">';
            l += '     <td>' + val.transaction_parameter_name + '</td>';
            l += '     <td>' + status + '</td>';
            l += '     <td>';
            l += '      <div class="btn-group ellipse-action " data-id="' + val.transaction_parameter_count_id + '">';
            l += '          <a class="a-ellipse a-ellipse-' + val.transaction_parameter_count_id + ' " >  <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </a>';
            l += '          <div class="action-menu" id="' + val.transaction_parameter_count_id + '">';
            l += '              <a class="dropdown-item disabled action-title" href="#">Select Action</a>';
            l += '              <a class="dropdown-item a-global_manage" href="#" attr-count-id= "' + val.transaction_parameter_count_id + '" attr-stat="' + val.transaction_parameter_status + '" attr-name="' + val.transaction_parameter_name + '" >Manage</a>';
            l += '              <a class="dropdown-item a-global_change_status" href="#" attr-stat="' + val.transaction_parameter_status + '" attr-count-id= "' + val.transaction_parameter_count_id + '" >Change Status to ' + mStatus + '</a>';
            l += '       	</div>';
            // l += '			<button class="btn btn-manage" data-toggle="modal" data-target="#"> <i class="fas fa-ellipsis-v"></i></button>';

            l += '     </td>';
            l += '</tr>';
        });

        // clear data table
        $("#tbl-global_data").DataTable().clear().destroy();
        // build 
        $('#tbody-global_data').html(l);
        // ini data table 
        declareGBLDatatable();
    }, 'json');
}

function setGlobalDetails() {
    var sType = $('#bnt-save_global_desc').attr('attr-type');
    var id = $('#bnt-save_global_desc').attr('attr-id');
    var sTitle = $('#global_data-title').val();
    var sDesc = $('#global_data-description').val();
    if (sDesc == 'No description found.') {
        sDesc = '';
    }

    $.post(sAjaxSettings, {
        type: "setGlobalDetails",
        id: id,
        sType: sType,
        sTitle: sTitle,
        sDesc: sDesc
    }, function (rs) {

        if (rs.data.res.stat !== '0') {
            $('#bnt-save_global_desc').removeClass('show').addClass('hide');
            alert('Successfully saved.');
        } else {
            alert('Something went wrong, please try again.');
        }

    }, 'json');
}

function addGlobalData() {

    icmsMessage({
        type: 'msgPreloader',
        visible: true
    });

    var sType = $('#bnt-save_global_desc').attr('attr-type');
    var id = $('#bnt-save_global_desc').attr('attr-id');
    var name = $('#inp-global_name').val();
    var status = $('#inp-global_status').val();
    $.post(sAjaxSettings, {
        type: "addGlobalData",
        id: id,
        sType: sType,
        name: name,
        status: status
    }, function (rs) {

        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });

        if (rs.data.res.stat !== '0') {
            $('#form-create_global_model')[0].reset();
            $('#mdl-create_global_data').modal('hide');
            if (sType == '1') {
                getListTransactionParameterByID(id);
                icmsMessage({
                    type: 'msgSuccess'
                });
            } else if (sType == '2') {
                getListGlobalParameterByID(id);
                icmsMessage({
                    type: 'msgSuccess'
                });
            } else if (sType == '3') {
                getListOfOccupation();
                icmsMessage({
                    type: 'msgSuccess'
                });
            } else {
                icmsMessage({
                    type: 'msgError'
                });
            }
        } else {
            icmsMessage({
                type: 'msgError'
            });
        }

    }, 'json');
}

function setGlobalData() {

    icmsMessage({
        type: 'msgPreloader',
        visible: true
    });

    var sType = $('#bnt-save_global_desc').attr('attr-type');
    var parameter_type_id = $('#bnt-save_global_desc').attr('attr-id');
    var paramer_count_id = $('#btn-save_update_globa_model').attr('attr-paramer_count_id');
    var name = $('#inp-update-global_name').val();
    var status = $('#inp-update-global_status').val();
    $.post(sAjaxSettings, {
        type: "setGlobalData",
        sType: sType,
        parameter_type_id: parameter_type_id,
        paramer_count_id: paramer_count_id,
        name: name,
        status: status
    }, function (rs) {

        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });

        if (rs.data.res.stat !== '0') {
            $('#form-update_global_model')[0].reset();
            $('#mdl-update_global_data').modal('hide');
            if (sType == '1') {
                icmsMessage({
                    type: 'msgSuccess',
                    onShow: function () {
                        getListTransactionParameterByID(parameter_type_id);
                    }
                });
            } else if (sType == '2') {
                icmsMessage({
                    type: 'msgSuccess',
                    onShow: function () {
                        getListGlobalParameterByID(parameter_type_id);
                    }
                });
            } else if (sType == '3') {
                icmsMessage({
                    type: 'msgSuccess',
                    onShow: function () {
                        getListOfOccupation();
                    }
                });
            } else {
                icmsMessage({
                    type: 'msgError'
                });
            }
        } else {
            icmsMessage({
                type: 'msgWarning',
                body: 'No changes was made.'
            });
        }

    }, 'json');
}

/*
 * End Global Parameter 
 */

/*
 * Start TIP 
 */

function getListTIPCategoryByID(page = 1, id) {

    var keyword = $('#inp-tip_category').val();
    var limit = 10;

    $.post(sAjaxSettings, {
        id: id,
        keyword: keyword,
        page: page,
        limit: limit,
        type: "getListTIPCategoryByID"
    }, function (rs) {

        if (rs.data.content.list.length > 0) {
            $('#tbl-cnt-tip_category').show();
            $('#tip_category-no-content').remove();

            var name = $('.li-tip_case_cat.active').attr('data-name');
            var desc = $('.li-tip_case_cat.active').attr('data-desc');
            var count_id = $('.li-tip_case_cat.active').attr('data-id');
            var type_id = $('.li-tip_case_cat.active').attr('data-type-id');



            $('#tip_details-title').html(name);
            $('#tip_details-description').html(desc);
            $('.lbl-tip-details-title').html(name);
            $('#btn-add_tip_details').attr('data-type_id', type_id);
            $('#btn-add_tip_details').attr('data-count_id', count_id);
            var l = '';
            $.each(rs.data.content.list, function (key, val) {
                var status = 'Inactive';
                if (val.tip_details_is_active != 0) {
                    status = 'Active';
                }

                l += '<tr class="tbody-details">';
                l += '  <td>' + val.tip_details_name + '</td>';
                l += '  <td>' + status + '</td>';
                l += '  <td>';
                l += '    <div class="btn-group ellipse-action " data-id="' + val.tip_details_id + '">';
                l += '        <a class="a-ellipse a-ellipse-' + val.tip_details_id + ' "> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </a>';
                l += '        <div class="action-menu" id="tip-' + val.tip_details_id + '">';
                l += '             <a class="dropdown-item disabled action-title" href="#">Select Action</a> ';
                l += '             <a class="dropdown-item a-tipcat_manage" href="#" attr-tip_details_id="' + val.tip_details_id + '" attr-stat="' + val.tip_details_is_active + '" attr-name="' + val.tip_details_name + '">Manage</a>';
                l += '        </div>';
                l += '    </div> ';
                l += '  </td>';
                l += '</tr>';
            });
            $('#tbody-tipcategory').html(l);

            // pagination
            buildPagination({
                parent: 'rs-list-tip_category',
                info: 'rs-info-tip_category',
                pagination: 'rs-pagination-tip_category',
                offset: 'rs-offset',
                data: {
                    page: page,
                    offset: limit,
                    count: rs.data.content.count
                }
            });

        } else {
            var sMessage = 'SORRY, WE COULDN\'T FIND ANY TIP DETAILS RELATED TO <span class = "font-italic" >"<span>' + keyword + '</span>"</span>.';
            if (!(keyword)) {
                sMessage = 'NO TIP DETAILS FOUND.';
            }
            var l = getNoDataFound({
                message: sMessage,
                footer: ''
            });

            $('#tbl-cnt-tip_category').hide();
            $('#tip_category-no-content').remove();
            $('#tbl-cnt-tip_category').after("<div id='tip_category-no-content'>" + l + "</div>");
        }

    }, 'json');
}

function getListTIPCategory() {
    $.post(sAjaxSettings, {
        type: "getListTIPCategory"
    }, function (rs) {
        var l = '';
        $.each(rs.data.list, function (key, val) {

            if ((val.transaction_parameter_description.length == 0) || (val.transaction_parameter_description === undefined) || (val.transaction_parameter_description === null)) {
                val.transaction_parameter_description = 'No description found.';
            }

            if (key == 0) {
                l += '<a class="nav-link dropdown-item li-tip_case_cat active"  data-toggle="pill" href="#" role="tab" aria-selected="true" attr-id = ' + val.transaction_parameter_count_id;
                l += ' data-type-id = "' + val.transaction_parameter_type_id + '" data-name = "' + val.transaction_parameter_name + '" data-desc = "' + val.transaction_parameter_description + '"  data-status = "' + val.transaction_parameter_status + '" ';
                l += '> ' + val.transaction_parameter_name + ' </a> ';
                getListTIPCategoryByID(1, val.transaction_parameter_count_id);
            } else {
                l += ' <a class="nav-link dropdown-item li-tip_case_cat" data-toggle="pill" href="#" role="tab" aria-selected="false" attr-id = ' + val.transaction_parameter_count_id;
                l += ' data-type-id = "' + val.transaction_parameter_type_id + '" data-name = "' + val.transaction_parameter_name + '" data-desc = "' + val.transaction_parameter_description + '"  data-status = "' + val.transaction_parameter_status + '" ';
                l += '> ' + val.transaction_parameter_name + ' </a> ';
            }
        });
        $('.list-tip_details').html(l);
    }, 'json');
}

function addTIPDetailsPerCategoryId() {

    icmsMessage({
        type: 'msgPreloader',
        visible: true
    });

    var name = $('#add_tip_category_name').val();
    var status = $('#add_tip_category_status').val();
    var id = $('.list-tip_details .li-tip_case_cat.active').attr('attr-id');

    $.post(sAjaxSettings, {
        type: "addTIPDetails",
        tip_details_name: name,
        tip_form_type_id: id,
        tip_details_is_active: status
    }, function (rs) {

        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });
        if (rs.data.res.stat !== '0') {
            icmsMessage({
                type: 'msgSuccess',
                onShow: function () {
                    $('#mdl-create_tip_details').modal('hide');
                    $('#form-add_tip_category')[0].reset();
                    getListTIPCategoryByID(1, id);
                }
            });
        } else {
            icmsMessage({
                type: 'msgWarning'
            });
        }
    }, 'json');
}

function setTIPDetailsPerCategoryId() {


    icmsMessage({
        type: 'msgPreloader',
        visible: true
    });


    var name = $('#update_tip_category_name').val();
    var status = $('#update_tip_category_status').val();
    var id = $('.list-tip_details .li-tip_case_cat.active').attr('attr-id');
    var tip_details_id = $('#btn_update_tip_category').attr('data-id');
    $.post(sAjaxSettings, {
        type: "setTIPDetailsPerCategoryId",
        tip_details_id: tip_details_id,
        tip_details_name: name,
        tip_form_type_id: id,
        tip_details_is_active: status
    }, function (rs) {

        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });

        if (rs.data.res.stat !== '0') {
            icmsMessage({
                type: 'msgSuccess',
                onShow: function () {
                    $('#mdl-update_tip_details').modal('hide');
                    $('#form-update_tip_category')[0].reset();
                    getListTIPCategoryByID(1, id);
                }
            });

        } else {
            icmsMessage({
                type: 'msgError'
            });
        }
    }, 'json');
}

/*
 * End TIP
 */

/*
 * Start Services
 */

function getListServicesType() {
    $.post(sAjaxSettings, {
        transaction_parameter_type_id: 11,
        transaction_parameter_status: 1,
        type: "getListTransactionParameterByID"
    }, function (rs) {
        var l = '';
        $.each(rs.data.list, function (key, val) {

            if ((val.transaction_parameter_description.length == 0) || (val.transaction_parameter_description === undefined) || (val.transaction_parameter_description === null)) {
                val.transaction_parameter_description = 'No description found.';
            }

            if (key == 0) {
                l += '<a class="nav-link dropdown-item li-services active"  data-toggle="pill" href="#" role="tab" aria-selected="true" attr-id = ' + val.transaction_parameter_count_id;
                l += ' data-type-id = "' + val.transaction_parameter_type_id + '" data-name = "' + val.transaction_parameter_name + '" data-desc = "' + val.transaction_parameter_description + '"  data-status = "' + val.transaction_parameter_status + '" ';
                l += '> ' + val.transaction_parameter_name + ' </a> ';
                getListServicesTypeById(1, val.transaction_parameter_count_id);
            } else {
                l += ' <a class="nav-link dropdown-item li-services " data-toggle="pill" href="#" role="tab" aria-selected="false" attr-id = ' + val.transaction_parameter_count_id;
                l += ' data-type-id = "' + val.transaction_parameter_type_id + '" data-name = "' + val.transaction_parameter_name + '" data-desc = "' + val.transaction_parameter_description + '"  data-status = "' + val.transaction_parameter_status + '" ';
                l += '> ' + val.transaction_parameter_name + ' </a> ';
            }
        });
        $('.list-category_services').html(l);
    }, 'json');
}

function getListServicesTypeById(page = 1, id) {
    var keyword = $('#inp-services').val();
    var limit = 10;

    $.post(sAjaxSettings, {
        id: id,
        keyword: keyword,
        page: page,
        limit: limit,
        type: "getListServicesTypeById"
    }, function (rs) {

        if (rs.data.content.list.length > 0) {
            $('#tbl-cnt-services').show();
            $('#services-no-content').remove();

            var name = $('.li-services.active').attr('data-name');
            var desc = $('.li-services.active').attr('data-desc');
            var count_id = $('.li-services.active').attr('data-id');
            var type_id = $('.li-services.active').attr('data-type-id');

            $('#service-title').html(name);
            $('#service-description').html(desc);
            $('.lbl-service-title').html(name);
            $('#btn-add_tip_service').attr('data-type_id', type_id);
            $('#btn-add_tip_service').attr('data-count_id', count_id);

            var l = '';
            $.each(rs.data.content.list, function (key, val) {
                var status = 'Inactive';
                if (val.service_is_active != 0) {
                    status = 'Active';
                }

                l += '<tr class="tbody-details">';
                l += '  <td>' + val.service_name + '</td>';
                l += '  <td>' + val.service_type_name + '</td>';
                l += '  <td>' + val.service_days + '</td>';
                l += '  <td>' + status + '</td>';
                l += '  <td>';
                l += '    <div class="btn-group ellipse-action " data-id="' + val.services_id + '">';
                l += '        <a class="a-ellipse a-ellipse-1 "> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </a>';
                l += '        <div class="action-menu" id="services-' + val.services_id + '">';
                l += '             <a class="dropdown-item disabled action-title" href="#">Select Action</a> ';
                l += '             <a class="dropdown-item a-service_manage" href="#" attr-service_id="' + val.services_id + '" attr-stat="' + val.service_is_active + '" attr-name="' + val.service_name + '" attr-service_type_id ="' + val.service_type_id + '" attr-days = "' + val.service_days + '" attr-editable = "' + val.service_description + '">Manage</a>';
                l += '        </div>';
                l += '    </div> ';
                l += '  </td>';
                l += '</tr>';

            });
            $('#tbody-services').html(l);

            // pagination
            buildPagination({
                parent: 'rs-list-services',
                info: 'rs-info-services',
                pagination: 'rs-pagination-services',
                offset: 'rs-offset',
                data: {
                    page: page,
                    offset: limit,
                    count: rs.data.content.count
                }
            });

        } else {
            var sMessage = 'SORRY, WE COULDN\'T FIND ANY SERVICES RELATED TO <span class = "font-italic" >"<span>' + keyword + '</span>"</span>.';
            if (!(keyword)) {
                sMessage = 'NO SERVICES DETAILS FOUND.';
            }
            var l = getNoDataFound({
                message: sMessage,
                footer: ''
            });

            $('#tbl-cnt-services').hide();
            $('#services-no-content').remove();
            $('#tbl-cnt-services').after("<div id='services-no-content'>" + l + "</div>");
        }

    }, 'json');
}

function getListServiceType() {
    $.post(sAjaxSettings, {
        transaction_parameter_type_id: 8,
        transaction_parameter_status: 1,
        type: "getListTransactionParameterByID"
    }, function (rs) {
        var l = '';
        $.each(rs.data.list, function (key, val) {
            l += '<option value="' + val.transaction_parameter_count_id + '">' + val.transaction_parameter_name + '</option>';
        });
        $('.sel_services_type').html(l);
    }, 'json');
}

function addService() {

    icmsMessage({
        type: 'msgPreloader',
        visible: true
    });

    var service_type_id = $('#add_services_type').val(),
            service_category = $('.list-category_services  .li-services.active').attr('attr-id'),
            service_days = $('#add_service_days').val(),
            service_name = $('#add_services_name').val(),
            service_is_active = $('#add_services_status').val();

    $.post(sAjaxSettings, {
        service_type_id: service_type_id,
        service_category: service_category,
        service_days: service_days,
        service_name: service_name,
        service_is_active: service_is_active,
        type: "addService"
    }, function (rs) {

        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });

        if (rs.data.res.stat !== '0') {

            icmsMessage({
                type: 'msgSuccess',
                onShow: function () {
                    $('#mdl-add_services').modal('hide');
                    $('#form-add_services')[0].reset();
                    getListServicesTypeById(1, service_category);
                }
            });

        } else {
            icmsMessage({
                type: 'msgWarning'
            });
        }
    }, 'json');
}

function setServiceById() {

    icmsMessage({
        type: 'msgPreloader',
        visible: true
    });

    var service_type_id = $('#update_services_type').val(),
            service_category = $('.list-category_services  .li-services.active').attr('attr-id'),
            service_days = $('#update_service_days').val(),
            service_name = $('#update_services_name').val(),
            service_is_active = $('#update_services_status').val(),
            services_id = $('#btn_update_services').attr('data-id');

    $.post(sAjaxSettings, {
        service_type_id: service_type_id,
        service_category: service_category,
        service_days: service_days,
        service_name: service_name,
        service_is_active: service_is_active,
        services_id: services_id,
        type: "setServiceById"
    }, function (rs) {

        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });

        if (rs.data.res.stat !== '0') {
            icmsMessage({
                type: 'msgSuccess',
                onShow: function () {
                    $('#mdl-update_services').modal('hide');
                    $('#form-update_services')[0].reset();
                    getListServicesTypeById(1, service_category);
                }
            });
        } else {
            icmsMessage({
                type: 'msgWarning'
            });
        }
    }, 'json');
}

/*
 * End Services
 */

/*
 * Start Occupation 
 */

function getListOfOccupation() {
    let id = 'occupation';
    $('#bnt-save_global_desc').attr('attr-type', '3');
    $('#bnt-save_global_desc').attr('attr-id', id);
    var parameter_type_id = id;
    var l = '';
    $('#tbody-global_data').html(l);
    $.post(sAjaxSettings, {
        type: "getListOccupation"
    }, function (rs) {
        let title = 'Occupation';

        $('#global_data-title').val(title);
        $('.lbl-global_data-title').text(title);
        $('.lbl-global_data-title').attr('data-text', title);

        $.each(rs.data.list, function (key, val) {
            l += ' <tr class="tbody-details">';
            l += '     <td>' + val.name + '</td>';
            l += '     <td> Active </td>';
            l += '     <td>';
            l += '      <div class="btn-group ellipse-action " data-id="' + val.id + '">';
            l += '          <a class="a-ellipse a-ellipse-' + val.id + ' " >  <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </a>';
            l += '          <div class="action-menu" id="' + val.id + '">';
            l += '              <a class="dropdown-item disabled action-title" href="#">Select Action</a>';
            l += '              <a class="dropdown-item a-global_manage" href="#" attr-stat="1" attr-count-id= "' + val.id + '" attr-name="' + val.name + '" >Manage</a>';
            l += '          </div>';
            l += '     </td>';
            l += '</tr>';
        });

        // clear data table
        $("#tbl-global_data").DataTable().clear().destroy();
        // build 
        $('#tbody-global_data').html(l);
        // ini data table 
        declareGBLDatatable();
    }, 'json');
}

/*
 * End Occupation
 */


function declareGBLDatatable() {
    // ini data table
    ini_datatable = $("#tbl-global_data").DataTable({
        bAutoWidth: false,
        aoColumns: [
            {sWidth: '70%'},
            {sWidth: '15%'},
            {sWidth: '15%'},
        ],
        lengthChange: false,
        dom: "ltipr",
        language: {
            paginate: {
                first: '<i class="fa fa-fw fa-chevron-right">',
                next: '<i class="fa fa-fw fa-chevron-right">',
                previous: '<i class="fa fa-fw fa-chevron-left">',
            },
        },
    });

    // enable search
    $("#inp-gbl-search").keyup(function () {
        ini_datatable.search(this.value).draw();
    });
}

$(document).ready(function () {

    // *    
    // **  
    // *** 
    //     **** On Load Function ****
    // ***         
    // **           
    // *          


    getPhPort();
    getListGlobalData();
    getDictionary();
    getListTIPCategory();
    getListServicesType();

    // For fetching Manage Provinces and cities
    getManageProvinces();
    // For fetching service type 
    getListServiceType();


    // click nav link in global data 
    $('.list-globaldata').delegate('.nav-link', 'click', function () {

        $('#bnt-save_global_desc').removeClass('show').addClass('hide');
        var id = $(this).attr('attr-id');
        var type = $(this).attr('attr-type');
        switch (type) {
            case '1':
                getListTransactionParameterByID(id);
                break;
            case '2':
                getListGlobalParameterByID(id);
                break;
            case '3':
                getListOfOccupation();
                break;
            default:
                alert('Something went wrong.');
        }
    });

    // extending lenght  in global parameter 
    $('#global_data-title').on('input', function (e) {
        $('#bnt-save_global_desc').removeClass('hide').addClass('show');
        this.style.width = ((this.value.length + 1) * 10) + 'px';
    });

    // extending lenght  in global parameter 
    $('#global_data-description').on('input', function (e) {
        $('#bnt-save_global_desc').removeClass('hide').addClass('show');
        this.style.width = ((this.value.length + 1) * 8) + 'px';
    });

    // click  update global data details 
    $('#bnt-save_global_desc').click(function () {
        setGlobalDetails();
    });

    // click save created global data 
    $('#btn-save_create_globa_model').click(function () {
        $('#form-create_global_model').submit();
    });

    // vlaidate form create global data 
    $('#form-create_global_model').validate({
        rules: {
            inp_global_name: {required: true},
            inp_global_status: {required: true}
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
                type: 'msgConfirmation',
                title: 'You are about to add new <span class="text-lowercase"> ' + $('.lbl-global_data-title').attr('data-text') + '</span>.',
                onConfirm: function () {
                    addGlobalData();
                },
                onShow: function () {
                    $('#mdl-create_global_data').modal('hide');
                },
                onCancel: function () {
                    $('#mdl-create_global_data').modal('show');
                }
            });

        }
    });

    // validate form update global data 
    $('#form-update_global_model').validate({
        rules: {
            inp_update_global_name: {required: true},
            inp_update_global_status: {required: true}
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

            icmsMessage({
                type: 'msgConfirmation',
                title: 'You are about to manage <span class="text-lowercase"> ' + $('.lbl-global_data-title').attr('data-text') + '</span>.',
                onConfirm: function () {
                    setGlobalData();
                },
                onShow: function () {
                    $('#mdl-update_global_data').modal('hide');
                },
                onCancel: function () {
                    $('#mdl-update_global_data').modal('show');
                }
            });

        }
    });

    // validate form add port
    $('#form-add_port').validate({
        rules: {
            name_port_name: {required: true},
            sel_ph_state_prov: {required: true},
            sel_ph_city: {required: true}
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
            icmsMessage({
                type: 'msgConfirmation',
                title: 'You are about to add new port.',
                onConfirm: function () {
                    addPort();
                },
                onShow: function () {
                    $('#mdl-add_port').modal('hide');
                },
                onCancel: function () {
                    $('#mdl-add_port').modal('show');
                }
            });
        }
    });

    // trigger submit add port
    $('#mdl-add_port').delegate('#btn_insert_port', 'click', function () {
        $('#form-add_port').submit();
    });

    // change state province in add ph port 
    $('#sel_ph_state_prov').change(function () {
        var province_id = $(this).val();
        getCities(province_id);
    });

    // validate manage port 
    $('#form-manage_port').validate({
        rules: {
            manage_port_name: {required: true},
            sel_ph_manage_state_prov: {required: true},
            sel_manage_city: {required: true}
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
            icmsMessage({
                type: 'msgConfirmation',
                title: 'You are about to manage port information.',
                onConfirm: function () {
                    setPort();
                },
                onShow: function () {
                    $('#mdl-manage_port').modal('hide');
                },
                onCancel: function () {
                    $('#mdl-manage_port').modal('show');
                }
            });
        }
    });

    // trigger submit manage port
    $('#mdl-manage_port').delegate('#btn_update_port', 'click', function () {
        $('#form-manage_port').submit();
    });

    //  global data table ellipes hide/show 
    $('#tbody-global_data').delegate('.ellipse-action', 'click', function (e) {
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

    //  port list table ellipes hide/show 
    $('.tbodyPortList').delegate('.ellipse-action', 'click', function (e) {

        var id = $(this).attr('data-id');
        if ($('#port-' + id).is(":visible")) {
            $('#port-' + id).hide();
            $('.a-ellipse').removeClass('ellipse-selected');
        } else {
            $('.action-menu').hide();
            $('.a-ellipse').removeClass('ellipse-selected');
            $('#port-' + id).show();
            $('.a-ellipse-' + id).addClass('ellipse-selected');
        }
    });

    // click manage button in port list 
    $('.tbodyPortList').delegate('.a-port_manage', 'click', function (e) {
        var port_name = $(this).attr('attr-port-name');
        var port_id = $(this).attr('attr-port-id');
        var port_province = $(this).attr('attr-port-province');
        var port_city = $(this).attr('attr-port-city');
        var port_parameter = $(this).attr('attr-port-type');
        var port_status = $(this).attr('attr-port-is-active');
        $('#btn_update_port').attr('attr-port-id', port_id);
        $('#mdl-manage_port').modal('show');
        $('#manage_port_name').val(port_name);
        $('#inp-manage_port_type').val(port_parameter).change();
        $('#inp-manage_port_status').val(port_status).change();
        $('#sel_ph_manage_state_prov').val(port_province).change();
        getManageCities(port_city);
    });

    // click action in data dictionary
    $('.tbodyDataDictionary').delegate('.ellipse-action', 'click', function (e) {
        var id = $(this).attr('data-id');
        if ($('#dictionary-' + id).is(":visible")) {
            $('#dictionary-' + id).hide();
            $('.a-ellipse').removeClass('ellipse-selected');
        } else {
            $('.action-menu').hide();
            $('.a-ellipse').removeClass('ellipse-selected');
            $('#dictionary-' + id).show();
            $('.a-ellipse-' + id).addClass('ellipse-selected');
        }
    });

    // action change province in ph port 
    $('#sel_ph_manage_state_prov').change(function () {
        getManageCities();
    });

    //  click manage data dictionary 
    $('.tbodyDataDictionary').delegate('.a-dictionary_manage', 'click', function (e) {

        var dictionary_name = $(this).attr('attr-dictionary-name');
        var dictionary_id = $(this).attr('attr-dictionary-id');
        var dictionary_description = $(this).attr('attr-dictionary-description');
        var dictionary_status = $(this).attr('attr-dictionary-status');
        $('#btn_update_dictionary').attr('attr-dictionary-id', dictionary_id);
        $('#mdl-data_dictionary').modal('show');
        $('#manage_term').val(dictionary_name);
        $('#manage_description').val(dictionary_description);
        $('#inp-manage_term_status').val(dictionary_status).change();
    });

    //click view more in data dictionary 
    $('.tbodyDataDictionary').delegate('.view_more', 'click', function () {
        var id = $(this).attr('attr-id');
        $('#summary-desc_' + id).addClass('hide');
        $('#full-desc_' + id).removeClass('hide');
    });

    // click view less in data dictionary 
    $('.tbodyDataDictionary').delegate('.view_less', 'click', function () {
        var id = $(this).attr('attr-id');
        $('#summary-desc_' + id).removeClass('hide');
        $('#full-desc_' + id).addClass('hide');
    });

    // validate form add data dictionary 
    $('#form-data_dictionary').validate({
        rules: {
            manage_term: {required: true},
            manage_description: {required: true}
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
                type: 'msgConfirmation',
                title: 'You are about to manage data dictionary.',
                onConfirm: function () {
                    setDictionary();
                },
                onShow: function () {
                    $('#mdl-data_dictionary').modal('hide');
                },
                onCancel: function () {
                    $('#mdl-data_dictionary').modal('show');
                }
            });


        }
    });

    //validate form manage data dictionary 
    $('#mdl-data_dictionary').delegate('#btn_update_dictionary', 'click', function () {
        $('#form-data_dictionary').submit();
    });

    // validate add form data dictionary 
    $('#form-add_data_dictionary').validate({
        rules: {
            add_term: {required: true},
            add_description: {required: true}
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
                type: 'msgConfirmation',
                title: 'You are about to add new data dictionary.',
                onConfirm: function () {
                    addDictionary();
                },
                onShow: function () {
                    $('#mdl-add_data_dictionary').modal('hide');
                },
                onCancel: function () {
                    $('#mdl-add_data_dictionary').modal('show');
                }
            });
        }
    });

    // trigger submit form add dictionary 
    $('#mdl-add_data_dictionary').delegate('#btn_add_dictionary', 'click', function () {
        $('#form-add_data_dictionary').submit();
    });

    // click modal show add dictionary 
    $('#btn-add-data-dictionary').click(function () {
        $('#mdl-add_data_dictionary').modal('show');
    });

    // click change status in global data 
    $('#tbody-global_data').delegate('.a-global_change_status', 'click', function (e) {

        icmsMessage({
            type: 'msgPreloader',
            visible: true
        });

        var sType = $('#bnt-save_global_desc').attr('attr-type');
        var parameter_type_id = $('#bnt-save_global_desc').attr('attr-id');
        var paramer_count_id = $(this).attr('attr-count-id');
        var stat = $(this).attr('attr-stat');
        var nStat = '1';
        if (stat != '0') {
            nStat = '0'
        }

        $.post(sAjaxSettings, {
            type: "setGlobalDataStatus",
            sType: sType,
            parameter_type_id: parameter_type_id,
            paramer_count_id: paramer_count_id,
            nStat: nStat
        }, function (rs) {

            icmsMessage({
                type: 'msgPreloader',
                visible: false
            });

            if (sType == '1') {
                icmsMessage({
                    type: 'msgSuccess',
                    body: 'Successfully change status.',
                    onShow: function () {
                        getListTransactionParameterByID(parameter_type_id);
                    }
                });
            } else if (sType == '2') {
                icmsMessage({
                    type: 'msgSuccess',
                    body: 'Successfully change status.',
                    onShow: function () {
                        getListGlobalParameterByID(parameter_type_id);
                    }
                });

            } else {
                icmsMessage({
                    type: 'msgError'
                });
            }

        }, 'json');
    });

    // click manage in global data list
    $('#tbody-global_data').delegate('.a-global_manage', 'click', function (e) {

        var sType = $('#bnt-save_global_desc').attr('attr-type');
        var parameter_type_id = $('#bnt-save_global_desc').attr('attr-id');
        var paramer_count_id = $(this).attr('attr-count-id');
        var stat = $(this).attr('attr-stat');
        var name = $(this).attr('attr-name');
        $('#btn-save_update_globa_model').attr('attr-paramer_count_id', paramer_count_id);
        $('#mdl-update_global_data').modal('show');
        $('#inp-update-global_name').val(name);
        $('#inp-update-global_status').val(stat).change();
    });

    // trigger submit update form global model
    $('#btn-save_update_globa_model').click(function () {
        $('#form-update_global_model').submit();
    });

    // click add port, modal show 
    $('#btn-add-port').click(function () {
        $('#mdl-add_port').modal('show');
        getProvinces();
        getCities();
    });

    // click menu in tip details
    $('.list-tip_details').delegate('.li-tip_case_cat', 'click', function (e) {
        var id = $(this).attr('attr-id');
        getListTIPCategoryByID(1, id);
    });

    // click submit add tip category 
    $('#btn_add_tip_category').click(function () {
        $('#form-add_tip_category').submit();
    });

    // validate add tip category form 
    $('#form-add_tip_category').validate({
        rules: {
            add_tip_category_name: {required: true}
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
                type: 'msgConfirmation',
                title: 'You are about to TIP category.',
                onConfirm: function () {
                    addTIPDetailsPerCategoryId();
                },
                onShow: function () {
                    $('#mdl-create_tip_details').modal('hide');
                },
                onCancel: function () {
                    $('#mdl-create_tip_details').modal('show');
                }
            });
        }
    });

    // validate update tip category form 
    $('#form-update_tip_category').validate({
        rules: {
            update_tip_category_name: {required: true}
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
                type: 'msgConfirmation',
                title: 'You are about to update TIP details.',
                onConfirm: function () {
                    setTIPDetailsPerCategoryId();
                },
                onShow: function () {
                    $('#mdl-update_tip_details').modal('hide');
                },
                onCancel: function () {
                    $('#mdl-update_tip_details').modal('show');
                }
            });

        }
    });


    // tip category  table ellipes hide/show 
    $('#tbody-tipcategory').delegate('.ellipse-action', 'click', function (e) {

        var id = $(this).attr('data-id');
        if ($('#tip-' + id).is(":visible")) {
            $('#tip-' + id).hide();
            $('.a-ellipse').removeClass('ellipse-selected');
        } else {
            $('.action-menu').hide();
            $('.a-ellipse').removeClass('ellipse-selected');
            $('#tip-' + id).show();
            $('.a-ellipse-' + id).addClass('ellipse-selected');
        }
    });

    // tip category table manage , open modal
    $('#tbody-tipcategory').delegate('.a-tipcat_manage', 'click', function () {
        var id = $(this).attr('attr-tip_details_id');
        var name = $(this).attr('attr-name');
        var status = $(this).attr('attr-stat');
        $('#update_tip_category_name').val(name);
        $('#update_tip_category_status').val(status).change();
        $('#btn_update_tip_category').attr('data-id', id);
        $('#mdl-update_tip_details').modal('show');
    });

    // validate update tip category 
    $('#btn_update_tip_category').click(function () {
        $('#form-update_tip_category').submit();
    });

    // click side menu in services 
    $('.list-category_services').delegate('.li-services', 'click', function () {
        var id = $(this).attr('attr-id');
        $('#inp-services').val('');
        getListServicesTypeById(1, id);
    });

    // click submit add service 
    $('#btn_add_services').click(function () {
        $('#form-add_services').submit();
    });

    // click submit update service 
    $('#btn_update_services').click(function () {
        $('#form-update_services').submit();
    });

    // validate add service
    $('#form-add_services').validate({
        rules: {
            add_services_name: {required: true},
            add_services_type: {required: true},
            add_service_days: {required: true, number: true}
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
                type: 'msgConfirmation',
                title: 'You are about to add service.',
                onConfirm: function () {
                    addService();
                },
                onShow: function () {
                    $('#mdl-add_services').modal('hide');
                },
                onCancel: function () {
                    $('#mdl-add_services').modal('show');
                }
            });

        }
    });

    // validate update service
    $('#form-update_services').validate({
        rules: {
            add_services_name: {required: true},
            add_services_type: {required: true},
            add_service_days: {required: true, number: true}
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
                type: 'msgConfirmation',
                title: 'You are about to update service.',
                onConfirm: function () {
                    setServiceById();
                },
                onShow: function () {
                    $('#mdl-update_services').modal('hide');
                },
                onCancel: function () {
                    $('#mdl-update_services').modal('show');
                }
            });
        }
    });


    // click action in services
    $('#tbody-services').delegate('.ellipse-action', 'click', function (e) {
        var id = $(this).attr('data-id');
        if ($('#services-' + id).is(":visible")) {
            $('#services-' + id).hide();
            $('.a-ellipse').removeClass('ellipse-selected');
        } else {
            $('.action-menu').hide();
            $('.a-ellipse').removeClass('ellipse-selected');
            $('#services-' + id).show();
            $('.a-ellipse-' + id).addClass('ellipse-selected');
        }
    });

    // tip services table manage , open modal
    $('#tbody-services').delegate('.a-service_manage', 'click', function () {

        var services_id = $(this).attr('attr-service_id'),
                service_type_id = $(this).attr('attr-service_type_id'),
                service_days = $(this).attr('attr-days'),
                service_name = $(this).attr('attr-name'),
                service_is_active = $(this).attr('attr-stat'),
                is_editable = $(this).attr('attr-editable');

        is_editable == 1 ? $('#update_services_name').prop('disabled', false) : $('#update_services_name').prop('disabled', true);

        $('#btn_update_services').attr('data-id', services_id);
        $('#update_services_status').val(service_is_active).change();
        $('#update_services_name').val(service_name);
        $('#update_services_type').val(service_type_id).change();
        $('#update_service_days').val(service_days);
        $('#mdl-update_services').modal('show');
    });

    // *    
    // **  
    // *** 
    //     **** For Pagination ****
    // ***         
    // **           
    // *             

    // PH Port Pagination
    $('.rs-list-port').delegate('.page-link', 'click', function () {
        var page = parseInt($(this).attr('data-page'));
        getPhPort(page);
    });

    // Data Dictionary Pagination 
    $('.rs-list-datadictionary').delegate('.page-link', 'click', function () {
        var page = parseInt($(this).attr('data-page'));
        getDictionary(page);
    });

    // TIP Category Pagination 
    $('.rs-list-tip_category').delegate('.page-link', 'click', function () {
        var page = parseInt($(this).attr('data-page'));
        var id = $('.list-tip_details .li-tip_case_cat.active').attr('attr-id');
        getListTIPCategoryByID(page, id);
    });

    // Services Pagination 
    $('.rs-list-services').delegate('.page-link', 'click', function () {
        var page = parseInt($(this).attr('data-page'));
        var id = $('.list-category_services  .li-services.active').attr('attr-id');
        getListServicesTypeById(page, id);
    });

    // *    
    // **  
    // *** 
    //     **** For Search ****
    // ***         
    // **           
    // *      

    // search in PH port 
    $('#search-port').on('keypress', function (e) {
        if (e.which == 13) {
            getPhPort();
        }
    });

    // search in data dictionary 
    $('#inp-dictionary_search').on('keypress', function (e) {
        if (e.which == 13) {
            getDictionary();
        }
    });

    // search in tip category 
    $('#inp-tip_category').on('keypress', function (e) {
        if (e.which == 13) {
            var id = $('.list-tip_details .li-tip_case_cat.active').attr('attr-id');
            getListTIPCategoryByID(1, id);
        }
    });

    // search in tip category 
    $('#inp-services').on('keypress', function (e) {
        if (e.which == 13) {
            var id = $('.list-category_services  .li-services.active').attr('attr-id');
            getListServicesTypeById(1, id);
        }
    });

});
