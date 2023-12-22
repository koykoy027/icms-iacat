/*
 *
 * Initial variable
 */
let temp_form = [];
temp_form["check_mdl_session"] = 0;

/*
 * List of functions
 */

// Check if value is null
/*
 *
 * @param {type} x
 * @returns {Boolean}
 */
function dg__isNull(x = "") {
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
    } catch (e) {}
}

// Check if value exist
/*
 *
 * @param {type} x
 * @returns {Boolean}
 */
function dg__isExist(x = "") {
    try {
        if (x == "" || x.length === 0 || x.length == null || x === undefined) {
            return false;
        } else {
            return true;
        }
    } catch (e) {}
}

// Check the variable is array
function dg__isArray(x) {
    return Array.dg__isArray(x);
}

// Insert values in form from object
function dg__iniFormValue(x) {
    if (dg__isNull(x.form) === true) {
        return "No form id defined";
    }

    if (dg__isNull(x.value) === true) {
        $.each(x.value, function (key, val) {
            // for input fields
            $(x.form + " [name=" + key + "]").val(val);

            // for select elements
            $(x.form + " [name=" + key + "]")
                .val(val)
                .change();

            //for editor
            if (x.editor === true) {
                var el = $(x.form + " [name=" + key + "]");
                var hasClass = el.hasClass("editor");

                //if the element has editor class
                if (hasClass === true) {
                    $(x.form + " [name=" + key + "]").summernote("code", val);
                }
            }

            // check select value is not exist and set to null
            let current_value = $(x.form + " [name=" + key + "]").val();
            if (!current_value) {
                $(x.form + " [name=" + key + "]")
                    .val("")
                    .change();
            }
        });
    } else {
        return "No form value defined";
    }

    if (dg__isNull(x.checkbox === true)) {
        $.each(x.checkbox, function (k, v) {
            if (dg__isNull(x.value) === true) {
                $.each(x.value, function (key, val) {
                    // for input fields
                    if (v == key) {
                        if (val >= 1) {
                            $(x.form + " [name=" + key + "]").attr(
                                "checked",
                                true
                            );
                        } else {
                            $(x.form + " [name=" + key + "]").removeAttr(
                                "checked"
                            );
                            $(x.form + " [name=" + key + "]").attr(
                                "checked",
                                false
                            );
                        }
                    }
                });
            }
            if (dg__isNull(x.label) === true) {
                $.each(x.label, function (key, val) {
                    // for input fields
                    if (v == key) {
                        if (val >= 1) {
                            $(x.form + " [name=" + key + "]").attr(
                                "checked",
                                true
                            );
                        } else {
                            $(x.form + " [name=" + key + "]").attr(
                                "checked",
                                false
                            );
                        }
                    }
                });
            }
        });
    }

    if (dg__isNull(x.label) === true) {
        $.each(x.label, function (key, val) {
            // for input fields
            $(x.form + " [name=" + key + "]").val(val);

            // for select elements
            $(x.form + " [name=" + key + "]")
                .html(val)
                .change();
        });
    } else {
        return "No form label defined";
    }
    return true;
}

// Check the variable is object
function dg__isObject(value) {
    return value && typeof value === "object" && value.constructor === Object;
}

// Object assigning all parameters
function dg__objectAssign() {
    var x = arguments.length;
    if (x > 0) {
        var newObject = {};
        for (i = 0; i < x; i++) {
            if (dg__isObject(arguments[i]) === true) {
                newObject = Object.assign(newObject, arguments[i]);
            }
        }
        return newObject;
    } else {
        return false;
    }
}

/*
 * Skeleton Screen
 */

dg__singleSkeleton = (x) => {
    var column_width =
        x.column_width == 100 ? "100%" : `calc(${x.column_width}% - 18px)`;

    var cols = "";
    for (var i = 1; i <= x.column; i++) {
        var column_gap =
            i != x.column && x.column_width != 100 ? "margin-right:16px;" : "";
        cols += `<div style="width:${column_width};${column_gap}"></div>`;
    }

    var rows = "";
    for (var i = 0; i < x.row; i++) {
        rows += `
            <li class="skeleton__item list-group-item">
                <div class="skeleton__item-body single d-flex flex-wrap justify-content-between inner-wrapper">${cols}</div>
            </li>`;
    }

    return `
        <ul class="skeleton list-group m-2" id="${x.container_id}-skeleton">
            ${rows}
        </ul>
    `;
};

dg__multiLineListSkeleton = (x) => {
    var rows = "";
    for (i = 0; i < x.row; i++) {
        rows += `
            <li class="skeleton__item list-group-item">
                <div class="skeleton__item-header d-flex">
                    <div></div><div></div>
                </div>
                <div class="skeleton__item-body d-flex flex-wrap">
                    <div></div><div></div><div></div><div></div>
                </div>
            </li>`;
    }

    return `
        <ul class="skeleton list-group" id="${x.container_id}-skeleton">
            ${rows}
        </ul>
    `;
};

function dg__iniSkeleton(x) {
    x.row = x.row || 10;
    x.column = x.column || 1;
    x.column_width = 100 / x.column;
    x.container_id = $(x.container).attr("id");

    $(x.container + "-skeleton").remove();
    $(x.container + "-empty").remove();

    if (x.visible == true) {
        $(x.container).hide(); // hide container

        let skeleton = "";
        let templateType = x.template;

        switch (templateType) {
            case "single":
                skeleton = dg__singleSkeleton(x);
                break;

            default:
                skeleton = dg__multiLineListSkeleton(x);
        }

        $(x.container).after(skeleton);
    } else {
        $(x.container).show(); // show container
        $(x.container + "-skeleton").remove();
    }

    if (x.onLoad) {
        x.onLoad();
        x.onLoad = function () {};
    }
}

function dg__emptyState(x = null) {
    var img =
        '<img src="/vendors/scp/empty_state/search.svg" class="empty-state empty_search pb-2">';
    var title = "No Data Found";
    var body = "";
    var footer = "";

    // hide empty state
    $(x.parent_container_id + "-empty").remove();

    // hide empty state
    if (dg__isExist(x.visible) == "0" && x.visible == false) {
        $(x.parent_container_id).show();
        $(x.parent_container_id + "-empty").remove();
        return;
    }

    if (dg__isNull(x.parent_container_id) == true) {
        alert("Parent Container not found");
    }

    $(x.parent_container_id).hide();

    if (dg__isExist(x.title) == true) {
        title = x.title;
    }

    if (dg__isExist(x.body) == true) {
        body = x.body;
    }

    if (dg__isExist(x.footer) == true) {
        footer = x.footer;
    }

    l =
        ' <div id="' +
        x.parent_container_id.replace("#", "") +
        '-empty"' +
        ">" +
        '<div class="d-flex justify-content-center p-4">' +
        '     <div class=" empty-state-container text-center display-block">' +
        img +
        "         <h4>" +
        title +
        "</h4>" +
        "         <p>" +
        body +
        "</p>" +
        "         " +
        footer +
        "     </div>" +
        " </div>" +
        "<div>";

    $(x.parent_container_id).after(l);
}

/*
 * Remove and clean array
 * Remove null, 0, undefiend, '', Nan, undefined, false
 */
function dg__clean_array(x) {
    var index = -1,
        arr_length = x ? x.length : 0,
        resIndex = -1,
        result = [];
    while (++index < arr_length) {
        var value = x[index];

        if (value !== "0") {
            result[++resIndex] = value;
        }
    }
    return result;
}

/*
 *
 * @param {string} form id
 * @returns {null}
 */
function dg__resetFormValues(sForm = "") {
    let custom_file_input_html = "";

    try {
        if ($(sForm)) {
            $(sForm).validate().resetForm();
            $(sForm)[0].reset();
            $("form" + sForm + " :input").each(function (index) {
                let attr_name = $(this).attr("name");
                $("#" + attr_name + "-error").remove();

                // remove class error in input
                $(this).removeClass("error");

                // summer note
                if ($(this).next(".note-editor").length !== 0) {
                    $(this).summernote("code", "");
                }

                if ($(this).attr("type") == "file") {
                    
                    let id_attr = $(this).attr("id");
                    $(this).value = null;
                    //remove label
                    $(sForm + " #lbl-" + attr_name).html("");

                    custom_file_input_html = $(this).next();

                    // check if has class
                    if ($(this).hasClass("custom-file-input")) {
                        l = `
                        <label class="custom-file-label d-flex" for="${id_attr}">
                        <img src="/vendors/scp/images/upload.svg" class="img__upload">
                        </label>
                        `;
                        custom_file_input_html.html(l);
                        custom_file_input_html.removeAttr("style");
                    }
                } else {
                    $(this).val("").trigger("change");
                    if ($(this).hasClass("select2")) {
                        // remove class error
                        $("#" + attr_name + "-error").remove();

                        $select2 = $(this).next();
                        $select2.removeClass("error");
                    }
                }
            });
        } else {
            $("form").validate().resetForm();
            $("form")[0].reset();
        }
    } catch (err) {
        dg__checkErrorMsg(err);
    }
}

/*
 *
 * @param {string} elem
 * @returns {bollean}
 */
function dg__resetCustomFile(elem = "") {
    if ($(elem).attr("type") == "file") {
        $(elem).value = null;

        custom_file_input_html = $(elem).next();

        // check if has class
        if ($(elem).hasClass("custom-file-input")) {
            let id_attr = $(elem).attr("id");
            l = `
            <label class="custom-file-label d-flex" for="${id_attr}">
            <img src="/vendors/scp/images/upload.svg" class="img__upload">
            </label>
            `;
            custom_file_input_html.html(l);
            custom_file_input_html.removeAttr("style");
            return true;
        }
    }

    return false;
}

/*
 *
 * @param {string} str
 * @param {int} maxLen
 * @param {string} last
 *  @param {string} parent_container
 * @returns {string}
 */
function dg__shortenString(
    _str,
    maxLen = 20,
    last = "see more",
    parent_container = ""
) {
    let _d = Math.random().toString(36).substring(7);
    let str = _str;
    if (_str.length > maxLen) {
        // str = _str.substring(0, maxLen);
        str = _str.substr(0, str.lastIndexOf(" ", maxLen));
        str +=
            '<br><span> <button type="button" class=" see-more btn btn-flat btn-see_more text-align-justify waves-effect waves-light px_4 py_4" id="' +
            _d +
            '-more" data-id="' +
            _d +
            '"> ' +
            last +
            "</button></span>";
        str +=
            '<span class="hidden" id="container-' +
            _d +
            '-less" data-id="' +
            _d +
            '">' +
            _str.substring(maxLen, _str.length) +
            "</span>";
        str +=
            '<br><span> <button type="button" class=" see-less btn btn-flat btn-see_less text-align-justify waves-effect waves-light px_4 py_4 hidden"  id="' +
            _d +
            '-less" data-id="' +
            _d +
            '"> see less </button></span>';

        $(parent_container).delegate(".see-more", "click", function () {
            let _id = $(this).attr("data-id");
            // set hidden
            $(this).addClass("hidden");
            // remove hidden class
            $("#container-" + _id + "-less").removeClass("hidden");
            $("#" + _id + "-less").removeClass("hidden");
        });

        $(parent_container).delegate(".see-less", "click", function () {
            let _id = $(this).attr("data-id");
            // set hidden
            $(this).addClass("hidden");
            $("#container-" + _id + "-less").addClass("hidden");
            // remove hidden class
            $("#" + _id + "-more").removeClass("hidden");
        });
    }
    return str;
}
/*
 * List of Methods
 */

/*
 * get form values
 * form = .class_name // if class
 * form = #id_name // if id
 * return string values / object
 */

function dg__getFormValues(x = null) {
    if (dg__isNull(x.form) === true) {
        return false;
    } else {
        if (x.type == "obj") {
            // //get disabled inputs
            var disabled_select = $(x.form).find("select:disabled");
            var disabled_input = $(x.form).find("input:disabled");

            //enable all disabled form fields before serialize to get data
            $(x.form + " select").prop("disabled", false);
            $(x.form + " input").prop("disabled", false);

            var requestParams = {};
            var values = $(x.form).serializeArray();

            $.each(values, function (k, v) {
                let s_value = v["value"].trim();
                requestParams[v["name"]] = s_value.replace(/\n/g, "<br>");
            });

            //disabled automatically the disabled field of the form
            $.each(disabled_select, function (k, v) {
                if (v.name != "") {
                    $(x.form + " [name=" + v.name + "]").prop("disabled", true);
                }
            });
            $.each(disabled_input, function (k, v) {
                if (v.name != "") {
                    $(x.form + " [name=" + v.name + "]").prop("disabled", true);
                }
            });

            if (x.submit_disabled) {
                // disable submit button
                dg__formSubmit({
                    form: x.form,
                    disabled: true,
                });

                if (!x.disabled_loading_message) {
                    let message = x.loading_message
                        ? x.loading_message
                        : "Saving... Please wait.";
                    toastr.info(message);
                }
            } else {
                // enable submit button
                dg__formSubmit({
                    form: x.form,
                    disabled: false,
                });
            }

            return requestParams;
        } else if (x.type == "str") {
            var sData = "";
            var values = $(x.form).serializeArray();
            $.each(values, function (k, v) {
                let s_value = v["value"].trim();
                s_value = s_value.replace(/\n/g, "<br>");
                sData += s_value;
            });
            return sData;
        }
    }
}

function dg__getGlobalDadg__tabulk(param) {
    var data = { type: "dg__getGlobalDadg__tabulk", aData: param };
    axios
        .post(sGlobalAjaxUrl, data)
        .then(function (rs) {
            if (rs.data.response) {
                $.each(rs.data.response, function (key, val) {
                    // for select
                    var l = "";
                    var r = "";
                    $.each(val, function (vKey, vVal) {
                        if (dg__isExist(vVal.descr) != true) {
                            var desc = "";
                        } else {
                            var desc = 'descr="' + vVal.descr + '"';
                        }

                        if (dg__isExist(vVal.descr2) != true) {
                            var desc2 = "";
                        } else {
                            var desc2 = 'descr2="' + vVal.descr2 + '"';
                        }

                        if (vVal.name) {
                            l +=
                                "<option " +
                                desc +
                                " " +
                                desc2 +
                                " value=" +
                                vVal.id +
                                ">" +
                                dg__html_entity_decode(vVal.name) +
                                "</option>";
                        }
                    });

                    r = l;
                    var check = $("#div_applicant_drawer").html();
                    if (dg__isNull(check) == true) {
                        // initalizing select
                        $('select[gb-name="' + key + '"]').each(function () {
                            let curr_val = $(this).val();
                            if (dg__isExist(curr_val) == true) {
                                return 0;
                            }

                            // reset select
                            l = r;

                            // for initial value
                            var placeholder = $(this).attr("gb-placeholder");
                            if (placeholder) {
                                l =
                                    "<option value=''>" +
                                    placeholder +
                                    "</option>" +
                                    l;
                            }

                            // for adding class
                            var add_class = $(this).attr("gb-class");
                            if (add_class) {
                                l = l
                                    .split("value")
                                    .join(" class='" + add_class + "'  value");
                            }

                            // build html
                            $(this).html(l);

                            // for select2
                            var select2 = $(this).attr("gb-select2");
                            if (select2 == "true") {
                                var s_param = {};
                                var s2_parent = $(this).attr(
                                    "gb-select2-parent"
                                );
                                if (dg__isExist(s2_parent) == true) {
                                    s_param = {
                                        dropdownParent: $(s2_parent),
                                    };
                                }
                                // initialize select 2
                                $(this).select2(s_param);
                            }

                            // for select 2 create tag
                            var select2create = $(this).attr(
                                "gb-s2-create_tag"
                            );
                            if (select2create == "true") {
                                var s_param = {};
                                var s2_parent = $(this).attr(
                                    "gb-select2-parent"
                                );
                                if (dg__isExist(s2_parent) == true) {
                                    s_param = {
                                        dropdownParent: $(s2_parent),
                                    };
                                }
                                var new_s_param = dg__objectAssign(
                                    {
                                        tags: true,
                                        createTag: function (params) {
                                            return {
                                                id: params.term,
                                                text: params.term,
                                                newOption: true,
                                            };
                                        },
                                        templateResult: function (data) {
                                            var $result = $("<span></span>");
                                            $result.text(data.text);
                                            if (data.newOption) {
                                                $result.append(
                                                    " <em>(new)</em>"
                                                );
                                            }
                                            return $result;
                                        },
                                    },
                                    s_param
                                );
                                // initialize select 2
                                $(this).select2(new_s_param);
                            }

                            // set value
                            var setVal = $(this).attr("gb-value");
                            if (setVal) {
                                $(this).val(setVal).change();
                            }
                        });
                    } else {
                        // initalizing select
                        $(
                            '#div_applicant_drawer select[gb-name="' +
                                key +
                                '"]'
                        ).each(function () {
                            let curr_val = $(this).val();
                            if (dg__isExist(curr_val) == true) {
                                return 0;
                            }

                            // reset select
                            l = r;

                            // for initial value
                            var placeholder = $(this).attr("gb-placeholder");
                            if (placeholder) {
                                l =
                                    "<option value=''>" +
                                    placeholder +
                                    "</option>" +
                                    l;
                            }

                            // for adding class
                            var add_class = $(this).attr("gb-class");
                            if (add_class) {
                                l = l
                                    .split("value")
                                    .join(" class='" + add_class + "'  value");
                            }

                            // build html
                            $(this).html(l);

                            // for select2
                            var select2 = $(this).attr("gb-select2");
                            if (select2 == "true") {
                                var s_param = {};
                                var s2_parent = $(this).attr(
                                    "gb-select2-parent"
                                );
                                if (dg__isExist(s2_parent) == true) {
                                    s_param = {
                                        dropdownParent: $(s2_parent),
                                    };
                                }
                                // initialize select 2
                                $(this).select2(s_param);
                            }

                            // for select 2 create tag
                            var select2create = $(this).attr(
                                "gb-s2-create_tag"
                            );
                            if (select2create == "true") {
                                var s_param = {};
                                var s2_parent = $(this).attr(
                                    "gb-select2-parent"
                                );
                                if (dg__isExist(s2_parent) == true) {
                                    s_param = {
                                        dropdownParent: $(s2_parent),
                                    };
                                }
                                var new_s_param = dg__objectAssign(
                                    {
                                        tags: true,
                                        createTag: function (params) {
                                            return {
                                                id: params.term,
                                                text: params.term,
                                                newOption: true,
                                            };
                                        },
                                        templateResult: function (data) {
                                            var $result = $("<span></span>");
                                            $result.text(data.text);
                                            if (data.newOption) {
                                                $result.append(
                                                    " <em>(new)</em>"
                                                );
                                            }
                                            return $result;
                                        },
                                    },
                                    s_param
                                );
                                // initialize select 2
                                $(this).select2(new_s_param);
                            }

                            // set value
                            var setVal = $(this).attr("gb-value");
                            if (setVal) {
                                $(this).val(setVal).change();
                            }
                        });
                    }
                });
            } else {
                toastr.error(error);
            }
        })
        .catch(function (err) {
            dg__checkErrorMsg(err);
            dg__initializeGlobalData();
        });
}

function dg__initializeGlobalData() {
    var aData = [];
    var x = 0;

    // select
    $("select[gb-name]").each(function () {
        var name = $(this).attr("gb-name");
        if (dg__isNull(name) == false) {
            var name = $(this).attr("gb-name");
            var placeholder = $(this).attr("gb-placeholder");
            placeholder =
                dg__isNull(placeholder) == true ? placeholder : placeholder.trim();
            aData[x] = {
                name: name.trim(),
                place_holder: placeholder,
            };
            x++;
        }
    });
    // input auto complete
    $("input[gb-name]").each(function () {
        var name = $(this).attr("gb-name");
        if (dg__isNull(name) == false) {
            var name = $(this).attr("gb-name");
            var placeholder = $(this).attr("gb-placeholder");
            placeholder =
                dg__isNull(placeholder) == true ? placeholder : placeholder.trim();
            aData[x] = {
                name: name.trim(),
                place_holder: placeholder,
            };
            x++;
        }
    });

    if (aData.length > 0) {
        dg__getGlobalDadg__tabulk(aData);
    }
}
/**
 * Download Temporary File
 */
function dg__downloadTempFile(elem_id, file) {
    if (dg__isNull(elem_id) !== true || dg__isNull(file) !== true) {
        $(elem_id).attr("href", sDriveTemp + file);

        var elem_type = elem_id.charAt(0);
        var elem = elem_id.substring(1);
        if (elem_type == "#") {
            document.getElementById(elem).click();
        }
        if (elem_type == ".") {
            document.getElementByClassName(elem).click();
        }
    } else {
        toastr.error("Error in downloading temporary file");
    }
}

/**
 * Open and view temporary file on another dg__tab
 */
function dg__viewTempFile(file) {
    if (dg__isNull(file) !== true) {
        window.open(sDriveTemp + file, "_blank");
    } else {
        toastr.error("Error in downloading temporary file");
    }
}

/**
 * Open and view temporary file on iframe
 */
function dg__viewTempFileOnIframe(elem_id, file) {
    if (dg__isNull(file) !== true) {
        $(elem_id).attr("src", sDriveTemp + file);
    } else {
        toastr.error("Error in showing pdf file");
    }
}

function dg__tab() {
    $("dg__tab").each(function () {
        var x = $(this).attr("count");
        if (!x) {
            x = 1;
        }
        $(this).css("margin-left", x * 20 + "px");
    });
}
/*
 *
 * @param {type} x
 * @returns {undefined}
 */
function dg__formSubmit(x = null) {
    // check form value
    if (dg__isExist(x.form) == false) {
        toastr.error("Form is missing.");
        return;
    }

    // disable
    if (x.disabled == true) {
        // get name of form, set global
        $("#layout-id").attr("data-form_submit", x.form);

        $("button[type=submit]", x.form).prop("disabled", true);
        $("input[type=submit]", x.form).prop("disabled", true);
    }

    // enable
    else {
        $("button[type=submit]", x.form).prop("disabled", false);
        $("input[type=submit]", x.form).prop("disabled", false);
    }
}

function dg__checkErrorMsg(msg = "") {
    // error essage viewed in console
    console.warn("Error:" + msg);

    let form_submit = $("#layout-id").attr("data-form_submit");

    // enable last form submit button
    if (form_submit) {
        dg__formSubmit({
            form: form_submit,
            disabled: false,
        });
    } else if (msg == "Error: Request failed with status code 419") {
        if (
            !$("#arms-modal").hasClass("show") &&
            temp_form["check_mdl_session"] == 0
        ) {
            temp_form["check_mdl_session"] = 1;
            armsMessage({
                type: "warning",
                title: "Notification",
                body: ` 
                <div class="text-center"> 
                        <h4> 
                        <strong>
                            Sorry, your session has expired, this page will reload after this message. 
                        </strong>
                        </h4>
                 </div>`,
                onHide: function () {},
                onShow: function () {},
                onConfirm: function () {},
                onCancel: function () {
                    location.reload();
                },
                lbl_confirm: {
                    show: false,
                    label: "Continue",
                },
                lbl_cancel: {
                    show: true,
                    label: "Close",
                },
            });
        }
    }
}

/*
 *
 * @param {object} x = ;
 * @param {string} form;
 * @param {string} message;
 * @return
 */
function dg__checkResponse(x = null, form = "", message = "") {
    if (dg__isExist(x.flag) == false) {
        console.warn("Flag response is missing.");
        return;
    }

    if (dg__isExist(form) == true) {
        $(form + " span.error").remove();
        $(form + " :input").removeClass("error");

        // enable submit button
        dg__formSubmit({
            form: form,
            disabled: false,
        });

        // re initialize form
        $(form + ' select[gb-select2="true"]').each(function () {
            let pl = $(this).attr("gb-placeholder");
            $(this).select2({
                dropdownParent: $(form),
                placeholder: pl,
                allowClear: true,
            });
        });
    }

    if (x.flag == "0") {
        if (dg__isObject(x.message) === true) {
            $.each(x.message, function (key, val) {
                if (dg__isExist(form) == true) {
                    if ($(form + " [name=" + key + "]")[0]) {
                        var message =
                            '<span id="' +
                            key +
                            '-error" class="error">' +
                            val.toString() +
                            ".</span>";

                        var parent = $(form + " [name=" + key + "]").parent();
                        $(parent).append(message);

                        $(form + " [name=" + key + "]").addClass("error");
                    } else {
                        toastr.error(
                            "Error [" + key + "] :  " + val.toString()
                        );
                    }
                } else {
                    toastr.error("Error [" + key + "] :  " + val.toString());
                }
            });
        }
        return x;
    }

    if (x.flag == "1" && !x.message) {
        // for listing
        return dg__html_entity_decode(x);
    } else if (x.flag == "1" && x.message.length > 0) {
        // for add/delete/manage
        return dg__html_entity_decode(x);
    } else if (x.flag == "1" && x.message) {
        // for no message
        return dg__html_entity_decode(x);
    }

    return x;
}

function dg__html_entity_decode(param) {
    var con = param;
    var result = "";

    try {
        if (dg__isArray(con) === true) {
            var result = [];
            $.each(param, function (key, val) {
                var newValue = {};
                $.each(val, function (nKey, nVal) {
                    newValue[nKey] = dg__html_entity_decode(nVal);
                });
                result[key] = newValue;
            });
            return result;
        } else if (dg__isObject(con) === true) {
            var result = {};
            $.each(param, function (key, val) {
                result[key] = dg__html_entity_decode(val);
            });
            return result;
        } else {
            return $("<textarea/>").html(param).text();
        }
    } catch (err) {
        console.warn(err);
        return param;
    }

    return param;
}


/**
 * Set local storage in array
 * @param {type} data
 * @param {type} storageName
 */
function dg__setStorageData(data, storageName) {
    var enc = JSON.stringify(data);
    localStorage.setItem(storageName, enc);
}

/**
 * Get local storage by name
 *
 * @param {type} storageName
 * @return {Boolean|String}
 */
function dg__getStorageData(storageName) {
    var data = localStorage.getItem(storageName);

    if (data === null) {
        return false;
    } else {
        var dec = data;
        return JSON.parse(dec);
    }
}

/**
 * Remove storage data by storage/index id
 *
 * @param {type} array
 * @param {type} element
 */
function dg__rmStorageDatabyId(array, element) {
    const index = array.indexOf(element);

    if (index !== -1) {
        array.splice(index, 1);
    }
}

/**
 * Clear input file label
 *
 * @param {type} element
 */
function dg__clearInputFileLabel(element) {
    if (dg__isNull(element) !== true) {
        $(element).html("");
    }
}

/*
 *  Change custom file upload
 * @returns
 */
function dg__changeCustomFileUpload() {
    // when file change
    let custom_file_input = [];

    $("input.custom-file-input").change(function (e) {
        // reset global
        custom_file_input = [];

        if (dg__isNull($(this).val()) == false) {
            // ini vairables
            let file_value = $(this).val();
            let file_name = e.target.files[0].name;
            let lbl_html = $(this).next();
            let id_attr = $(this).attr("id");

            // hide label
            lbl_html.attr("style", "display: none !important");

            // set global
            custom_file_input["file_value"] = file_value;
            custom_file_input["file_name"] = file_name;
            custom_file_input["lbl_html"] = lbl_html;

            // run time
            setTimeout(function () {
                
                if (dg__isExist(custom_file_input["file_value"]) == true) {
                    let file_name = dg__shortenString(
                        custom_file_input["file_name"],
                        10,
                        "..."
                    );
                    let l = `

                    <div class="d-block m-auto uploaded_file_container">
                    <i class="feather icon-x-circle remove_uploaded_file"></i>
                    <img src="/vendors/scp/images/doc.png" class="img__uploaded_file">
                    <p class="uploaded_file_name">${file_name}</p>
                    </div>

                    `;
                    custom_file_input["lbl_html"].html(l);
                    custom_file_input["lbl_html"].removeAttr("style");
                } else {
                    // back to upload
                    l = `
                    <label class="custom-file-label d-flex" for="${id_attr}">
                    <img src="/vendors/scp/images/upload.svg" class="img__upload">
                    </label>
                    `;
                    custom_file_input["lbl_html"].html(l);
                    custom_file_input["lbl_html"].removeAttr("style");
                }
            }, 400);
        }
    });

    // when file click remove
    $(".custom-file-label i.remove_uploaded_file").click(function () {
        let el = $(this).closest("input").html();

        if (el.attr("type") == "file") {
            

            $(this).value = null;
            //remove label
            $(sForm + " #lbl-" + attr_name).html("");

            custom_file_input_html = $(this).next();

            // check if has class
            if ($(this).hasClass("custom-file-input")) {
                let id_attr = $(this).attr("id");
                l = `
                <label class="custom-file-label d-flex" for="${id_attr}">
                <img src="/vendors/scp/images/upload.svg" class="img__upload">
                </label>
                `;
                custom_file_input_html.html(l);
                custom_file_input_html.removeAttr("style");
            }
        }
    });
}

/**
 * set time value using pickatime
 * @param {type} param
 *
 */
function dg__setTimeValue(param) {
    //form and column is required
    if (
        dg__isNull(param.form) === false &&
        dg__isNull(param.column) === false &&
        dg__isNull(param.value) === false
    ) {
        var picker = $(param.form + " [name=" + param.column + "]").pickatime(
            "picker"
        );
        var time = param.value;
        picker.set("select", [time.substr(0, 2), time.substr(3, 2)]);
    }
}

/*
 * set error placement
 * @param error
 * @param element
 */
function dg__validateErrorPlacement(error = "", element = "") {
    // for input group
    if (element.parent(".input-group").length) {
        error.insertAfter(element.parent());
    } else if (element.hasClass("select2-hidden-accessible")) {
        error.insertAfter(element.next("span")); // select2
        // element.next("span").addClass("error");
        //element.next("span").addClass("error").removeClass("valid");
    } else if (element.hasClass("editor")) {
        error.insertAfter(element.siblings(".note-editor"));
    }

    // for normal
    else {
        error.insertAfter(element);
    }
}

function dg__unhighlight(element, errorClass, validClass) {
    var elem = $(element);
    if (elem.hasClass("select2-hidden-accessible")) {
        elem.next("span").removeClass("error").addClass("valid");
        $("#select2-" + elem.attr("id") + "-container")
            .parent()
            .removeClass(errorClass);
    } else {
        elem.removeClass(errorClass);
    }
}

$(document).ready(function () {
    // add valid and remove error classes on select2 element if valid
    $(".select2-hidden-accessible").on("change", function () {
        if ($(this).valid()) {
            $(this).next("span").removeClass("error").addClass("valid");
        }
    });
    
    /*
     * List of Classes that have special functions for inputs
     */

    // Allow numeric decimal keypress
    $(".inp-decimal").keypress(function (event) {
        $(this).val(
            $(this)
                .val()
                .replace(/[^0-9\.]/g, "")
        );
        if (
            (event.which != 46 || $(this).val().indexOf(".") != -1) &&
            (event.which < 48 || event.which > 57)
        ) {
            event.preventDefault();
        }
    });

    // Allow integer value keypress
    $(".inp-number").keypress(function (event) {
        $(this).val(
            $(this)
                .val()
                .replace(/[^\d].+/, "")
        );
        if (event.which < 48 || event.which > 57) {
            event.preventDefault();
        }
    });

    // letter ,number, space backspace
    $(".inp-no_spec_char").keypress(function (event) {
        if (
            event.which == 8 ||
            event.which == 32 ||
            (event.which >= 48 && event.which <= 57) ||
            (event.which <= 90 && event.which >= 65) ||
            (event.which <= 122 && event.which >= 97)
        ) {
            // do nothing
            if (event.which === 32 && !this.value.length) {
                event.preventDefault();
            } else {
                if ($(this).val().substring(0, 1) == " ") {
                    $(this).val($(this).val().trim());
                }
                $(this).val($(this).val().replace(/\s+/g, " "));
            }
        } else {
            event.preventDefault();
        }
    });

    // no typing
    $(".inp-notyping").keypress(function (e) {
        return false;
    });

    // letter ,number, space backspace !@$
    $(".inp-limited_spec_char").keypress(function (event) {
        if (
            event.which == 8 ||
            event.which == 64 ||
            event.which == 33 ||
            event.which == 32 ||
            event.which == 36 ||
            (event.which >= 48 && event.which <= 57) ||
            (event.which <= 90 && event.which >= 65) ||
            (event.which <= 122 && event.which >= 97)
        ) {
            // do nothing
            if (event.which === 32 && !this.value.length) {
                event.preventDefault();
            } else {
                if ($(this).val().substring(0, 1) == " ") {
                    $(this).val($(this).val().trim());
                }
                $(this).val($(this).val().replace(/\s+/g, " "));
            }
        } else {
            event.preventDefault();
        }
    });

    // letter only keypress
    $(".inp-letter_only").keypress(function (event) {
        if (
            event.which == 8 ||
            event.which == 32 ||
            (event.which <= 90 && event.which >= 65) ||
            (event.which <= 122 && event.which >= 97)
        ) {
            // do nothing
            if (event.which === 32 && !this.value.length) {
                event.preventDefault();
            } else {
                if ($(this).val().substring(0, 1) == " ") {
                    $(this).val($(this).val().trim());
                }
                $(this).val($(this).val().replace(/\s+/g, " "));
            }
        } else {
            event.preventDefault();
        }
    });

    // letter space backspace and hypen keypress
    $(".inp-ld").keypress(function (event) {
        if (
            event.which == 8 ||
            event.which == 32 ||
            event.which == 45 ||
            (event.which <= 90 && event.which >= 65) ||
            (event.which <= 122 && event.which >= 97)
        ) {
            // do nothings
            if (event.which === 32 && $(this).val().length <= 0) {
                event.preventDefault();
            } else {
                $(this).val($(this).val().replace(/\s+/g, " "));
                if ($(this).val().substring(0, 1) == " ") {
                    $(this).val($(this).val().trim());
                }
            }
        } else {
            event.preventDefault();
        }
    });

    // letter number space backspace and hypen key press
    $(".inp-lnd").keypress(function (event) {
        if (
            event.which == 8 ||
            event.which == 32 ||
            event.which == 45 ||
            (event.which >= 48 && event.which <= 57) ||
            (event.which <= 90 && event.which >= 65) ||
            (event.which <= 122 && event.which >= 97)
        ) {
            // do nothings
            if (event.which === 32 && $(this).val().length <= 0) {
                event.preventDefault();
            } else {
                $(this).val($(this).val().replace(/\s+/g, " "));
                if ($(this).val().substring(0, 1) == " ") {
                    $(this).val($(this).val().trim());
                }
            }
        } else {
            event.preventDefault();
        }
    });

    // no space start when key up
    $(".inp-nps").keyup(function (event) {
        $(this).val($(this).val().replace(/\s+/g, " "));
        if ($(this).val().substring(0, 1) == " ") {
            $(this).val($(this).val().trim());
        }
    });

    // no space start when key press
    $(".inp-nps").keypress(function (event) {
        if (event.which === 32 && !this.value.length) {
            event.preventDefault();
        }
    });

    //pasting is not allowed
    $(".inp-nopasting").on("paste", function (event) {
        event.preventDefault();
    });

    //custom input file change function
    $(".inp-file").change(function (e) {
        var name_value = e.target.attributes[2].value;
        $(".inp-file-" + name_value).html(e.target.files[0].name);
    });

    // no space while typing and copy paste
    $(".inp-np").on("input", function () {
        $(this).val($(this).val().replace(/ /g, ""));
    });

    $(".toggle-pass_visibility").on("click", function () {
        let passInput = $(this).parent().find("input.password");
        let passInputType =
            $(passInput).attr("type") === "password" ? "text" : "password";
        let passInputIcon = $(this).find("i.fa");

        if (passInputIcon.hasClass("fa-eye")) {
            passInputIcon.removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            passInputIcon.removeClass("fa-eye-slash").addClass("fa-eye");
        }

        $(passInput).attr("type", passInputType);
    });

    $("form select").on("select2:close", function (e) {
        try {
            if ($(this).valid() && $(this).hasClass("error")) {
                $(this).removeClass("error");
            }
        } catch (err) {
            console.warn(err);
        }
    });
});
