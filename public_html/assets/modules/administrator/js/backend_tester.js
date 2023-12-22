showAll = (rs) => {
    var html = '';

    if (rs.flag) { //if flag has value
        if (rs.flag == '1') { //if flag = 1

            icmsMessage({
                type: 'msgSuccess',
                body: 'Success',
            });

            if (Array.isArray(rs.recordset)) { //if recordset is an array

                html += '<b>Flag:</b><i>' + rs.flag + '</i><br><br>';

                //get all
                if (rs.recordset.length > 0) {
                    html += '<b>Length:</b><i>' + rs.recordset.length + '</i><br><br>';
                    $.each(rs.recordset, function (key, val) {

                        if (typeof (val) == 'object') {

                            html += '<b>' + key + '</b> : <i>' + val + '</i></div>';
                            html += ' {<br>';
                            $.each(val, function (k, v) {

                                if (typeof (v) == 'object') {

                                    html += '<span style="padding-left:15px;"></span><b>' + k + '</b> : <i>' + v + '</i>';
                                    html += ' {<br>';
                                    $.each(v, function (kk, vv) {
                                        if (typeof (vv) == 'object') {
                                            html += '<span style="padding-left:15px;"></span><b>' + k + '.' + kk + '</b> : <i>' + vv + '</i>';
                                            html += ' {<br>';
                                            $.each(vv, function (kkk, vvv) {
                                                if (typeof (vv) == 'object') {
                                                    html += '<span style="padding-left:15px;"></span><b>' + k + '.' + kk + '.' + kkk + '</b> : <i>' + vvv + '</i>';
                                                    html += ' {<br>';
                                                    $.each(vvv, function (kkkk, vvvv) {
                                                        if (typeof (vvv) == 'object') {
                                                            html += '<span style="padding-left:15px;"></span><b>' + k + '.' + kk + '.' + kkk + '.' + kkkk + '</b> : <i>' + vvvv + '</i><br>';
                                                        } else {
                                                            html += '<span style="padding-left:15px;"></span><b>' + k + '.' + kk + '.' + kkk + '.' + kkkk + '</b> : <i>' + vvvv + '</i><br>';
                                                        }
                                                        html += ' {<br>';
                                                    });
                                                } else {
                                                    html += '<span style="padding-left:15px;"></span><b>' + k + '.' + kk + '.' + kkk + '</b> : <i>' + vvv + '</i>';
                                                }

                                                html += '}<br>';
                                            });
                                        } else {
                                            html += '<span style="padding-left:15px;"></span><b>' + k + '.' + kk + '</b> : <i>' + vv + '</i>';
                                        }

                                        html += '}<br>';

                                    });

                                    html += '}<br>';
                                } else {
                                    html += '<span style="padding-left:15px;"></span><span style="color:#7FFF00;"><b>' + k + '</b></span> : <span style="color:white;"><i>' + v + '</i></span><br>';
                                }
                            });

                            html += '}<br>';

                        } else {
                            html += '<b>' + key + '</b> : <i>' + val + '</i><br>';
                        }

                        html += '<br>';
                    });
                } else {
                    html += '<b>recordset: </b> <i>0 results</i><br>';
                }
            } else { //if recordset is array|  get row

                if (typeof (rs.recordset) == 'object') { //get row

                    $.each(rs.recordset, function (key, val) {

                        if (typeof (val) == 'object') {
                            html += '<b>' + key + '</b> : <i>' + val + '</i><br>';
                            $.each(val, function (k, v) {

                                if (typeof (v) == 'object') {
                                    html += '<b>' + key + '.' + k + '</b> : <i>' + v + '</i><br>';

                                    $.each(v, function (kk, vv) {
                                        if (typeof (vv) == 'object') {
                                            html += '<b>' + key + '.' + k + '.' + kk + '</b> : <i>' + vv + '</i><br>';
                                            $.each(vv, function (kkk, vvv) {
                                                if (typeof (vv) == 'object') {
                                                    html += '<b>' + key + '.' + k + '.' + kk + '.' + kkk + '</b> : <i>' + vvv + '</i><br>';
                                                    $.each(vvv, function (kkkk, vvvv) {
                                                        if (typeof (vvv) == 'object') {
                                                            html += '<b>' + key + '.' + k + '.' + kk + '.' + kkk + '.' + kkkk + '</b> : <i>' + vvvv + '</i><br>';
                                                        } else {
                                                            html += '<b>' + key + '' + k + '.' + kk + '.' + kkk + '.' + kkkk + '</b> : <i>' + vvvv + '</i><br>';
                                                        }
                                                    });
                                                } else {
                                                    html += '<b>' + key + '.' + k + '.' + kk + '.' + kkk + '</b> : <i>' + vvv + '</i><br>';
                                                }
                                            });
                                        } else {
                                            html += '<b>' + key + '.' + k + '.' + kk + '</b> : <i>' + vv + '</i><br>';
                                        }

                                    });
                                } else {
                                    html += '<b>' + key + '.' + k + '</b> : <i>' + v + '</i><br><br>';
                                }
                            });
                        } else {
                            html += '<b>' + key + '</b> : <i>' + val + '</i><br><br>';
                        }
                    });
                } else { //single return

                    $.each(rs, function (k, v) {
                        html += '<b>' + k + ': </b> <i>' + v + '</i><br/><br/>';
                    });

                }
            }


        } else { //if flag = 0

            html += '<b>Flag: </b><i>' + rs.flag + '</i><br><br>';

            if (typeof (rs.message) == 'object') {
                $.each(rs.message, function (k, v) {
                    html += '<b>' + k + '</b> : <i>' + v + '</i><br><br>';
                });
                html += '<br>';

            } else {
                html += '<p style="color:red !important;"><b>Error: </b> <i>' + rs.message + '</i></p><br><br>';
            }
        }
    } else { //has invalid response
        html += '<p style="color:red !important;"><b>Error: </b> <i>' + rs.message + '</i></p><br><br>';
    }

    $("#console").html(html);
}

addDocument = (hash) => {
    alert(hash);
}

convertParameterValues = () => {

    var num_fields = 1;
    do {
        //naming parameter function
        var param_name = 'param' + num_fields;
        //convert string to variable
        var param_ = eval(param_name);
        //store value on parameter
        param = $("#param" + num_fields).val();
        //change value name to parameter name
        $("#value" + num_fields).attr("name", param);

        num_fields++;
    } while (num_fields <= 11) //11 is the maximum input fields


}

$(document).ready(function () {

    $("#reset").click(function () {
        $("#console").html('Output');
    });
    /*
     * Validate form
     */
    $("#form-test").validate({
        rules: {
            function_name: {
                required: true
            },
            ajaxUrl: {
                required: true
            }
        },
        errorElement: "div",
        errorElement: "div",
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            var function_name = $("#function_name").val();
            var ajaxUrl = $("#ajaxUrl").val();

            callback(function_name, ajaxUrl);
        }
    });

    $("#form-add_document").validate({
        rules: {
            document_hash: {
                required: true,
            },
        },
        errorElement: "div",
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            // file_upload({
            //     form: "#form-add_document",
            //     el: "document_hash",
            //     callback: "addDocument",
            // });
            file_upload({
                form: "#form-add_document",
                el: "document_hash",
                callback: "addDocument",
                method: "csv_upload_to_import",
                import_table: "sample_table"
            });
        },
    });

});

callback = (function_name, ajaxUrl) => {
    $("#console").html('Loading request......');
    var ajax = eval(ajaxUrl);

    convertParameterValues();

    var params = objectAssign({
        type: function_name,
    }, getFormValues({
        type: "obj",
        form: "#form-test",
    }));
    $.post(ajax, params, function (rs) {

        var rs = rs.data;
        
        
        console.log(rs);

        showAll(rs);

    }, 'json')
            .catch(function (error) {
                $("#console").html('<p class="error">' + JSON.stringify(error) + '</p>');
            });

}


function getFormValues(x = null) {
    if (isNull(x.form) === true) {
        return false;
    } else {
        if (x.type == "obj") {

            //get disabled inputs
            var disabled_select = $(x.form).find('select:disabled');
            var disabled_input = $(x.form).find('input:disabled');
            var disabled_textarea = $(x.form).find('textarea:disabled');

            //enable all disabled form fields before serialize to get data
            $(x.form + ' select').prop("disabled", false);
            $(x.form + ' input').prop("disabled", false);
            $(x.form + ' textarea').prop("disabled", false);

            var requestParams = {};
            var values = $(x.form).serializeArray();

            $.each(values, function (k, v) {
                let s_value = v["value"].trim();
                requestParams[v["name"]] = s_value.replace(/\n/g, "<br>");
            });

            if (x.submit_disabled) {
                // disable submit button
                formSubmit({
                    form: x.form,
                    disabled: true,
                });
            } else {
                // enable submit button
                formSubmit({
                    form: x.form,
                    disabled: false,
                });
            }

            //disabled automatically the disabled field of the form
            $.each(disabled_select, function (k, v) {
                $(x.form + ' [name=' + v.name + ']').prop("disabled", true);
            });
            $.each(disabled_input, function (k, v) {
                $(x.form + ' [name=' + v.name + ']').prop("disabled", true);
            });
            $.each(disabled_textarea, function (k, v) {
                $(x.form + ' [name=' + v.name + ']').prop("disabled", true);
            });

            return requestParams;
        } else if (x.type == "str") {
            //get disabled inputs
            var disabled_select = $(x.form).find('select:disabled');
            var disabled_input = $(x.form).find('input:disabled');
            var disabled_textarea = $(x.form).find('textarea:disabled');

            //enable all disabled form fields before serialize to get data
            $(x.form + ' select').prop("disabled", false);
            $(x.form + ' input').prop("disabled", false);
            $(x.form + ' textarea').prop("disabled", false);

            var sData = "";
            var values = $(x.form).serializeArray();
            $.each(values, function (k, v) {
                let s_value = v["value"].trim();
                s_value = s_value.replace(/\n/g, "<br>");
                sData += s_value;
            });

            //disabled automatically the disabled field of the form
            $.each(disabled_select, function (k, v) {
                $(x.form + ' [name=' + v.name + ']').prop("disabled", true);
            });
            $.each(disabled_input, function (k, v) {
                $(x.form + ' [name=' + v.name + ']').prop("disabled", true);
            });
            $.each(disabled_textarea, function (k, v) {
                $(x.form + ' [name=' + v.name + ']').prop("disabled", true);
            });

            return sData;
        }

}
}

function objectAssign() {
    var x = arguments.length;
    if (x > 0) {
        var newObject = {};
        for (i = 0; i < x; i++) {
            if (isObject(arguments[i]) === true) {
                newObject = Object.assign(newObject, arguments[i]);
            }
        }
        return newObject;
    } else {
        return false;
    }
}

function formSubmit(x = null) {
    // check form value
    if (isExist(x.form) == false) {

        icmsMessage({
            type: 'msgError',
            body: 'Form is missing',
        });
        return;
    }

    // disable
    if (x.disabled == true) {
        // get name of form, set global
        $("#env-mode").attr("data-form_submit", x.form);

        $("button[type=submit]", x.form).prop("disabled", true);
        $("input[type=submit]", x.form).prop("disabled", true);
    }

    // enable
    else {
        $("button[type=submit]", x.form).prop("disabled", false);
        $("input[type=submit]", x.form).prop("disabled", false);
}
}

function isExist(x = "") {
    try {
        if (x == "" || x.length === 0 || x.length == null || x === undefined) {
            return false;
        } else {
            return true;
        }
    } catch (e) {
}
}

/*
 * Check the variable is array
 * @param {object}{array}{string}
 * @return {boolean}
 */
function isArray(x) {
    return Array.isArray(x);
}

/*
 * Check the variable is object
 * @param {object}{array}{string}
 * @return {boolean}
 */
function isObject(value) {
    return value && typeof value === "object" && value.constructor === Object;
}

/*
 * Check if value is null
 * @param {type} any 
 * @returns {Boolean}
 */
function isNull(x = "") {
    try {
        if (x == "" || x === undefined) {
            //if no value
            return true;
        } else {
            if (x.length == null || x.length === 0) {
                //if has value but not array
                return true;
            } else {
                return false;
            }
        }
    } catch (e) {
}
}


