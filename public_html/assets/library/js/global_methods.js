/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$('input').addClass('noSpcStart');
$('area').addClass('noSpcStart');

//additional validation age
try {
    $.validator.addMethod("dateOfBirth", function (value, element) {
        if (value == "") {
            return true;
        }
        function less_years(dt, n)
        {
            return new Date(dt.setFullYear(dt.getFullYear() - n));
        }
        var dt = new Date();
        var less18 = less_years(dt, 18);

        if (new Date(less18) >= new Date(value)) {
            return true;
        }

    }, "Age must be 18 years old or above");
} catch (e) {

}

//additional validation date must be in the past
try {
    $.validator.addMethod("pastDate", function (value, element) {
        if (new Date(value) <= new Date()) {
            return true;
        }
    }, "Cannot be current/future dated");
} catch (e) {

}


//additional validation date must be in the past or current
try {
    $.validator.addMethod("pastDateNow", function (value, element) {
        if (new Date(value) <= new Date()) {
            return true;
        }
    }, "Cannot be future dated");
} catch (e) {

}

//additional validation date must be in the past but not required
try {
    $.validator.addMethod("pastDateOptional", function (value, element) {
        if (new Date(value) <= new Date()) {
            return true;
        }

        if (!value) {
            return true;
        }

    }, "Cannot be current/future dated");
} catch (e) {

}

//additional validation date must be in the past
try {
    $.validator.addMethod("pastYear", function (value, element) {
        var currentTime = new Date();
        var year = currentTime.getFullYear();
        if (parseInt(value) >= 1960 && parseInt(value) <= parseInt(year)) {
            return true;
        }
    }, "Cannot be current/future dated");
} catch (e) {
}


//additional validation date must be in the past optional
try {
    $.validator.addMethod("pastYearOption", function (value, element) {
        var currentTime = new Date();
        var year = currentTime.getFullYear();
        if (parseInt(value) >= 1960 && parseInt(value) <= parseInt(year)) {
            return true;
        }

        if (!value) {
            return true;
        }

    }, "Cannot be current/future dated");
} catch (e) {
}


//additional validation date must be in the future
try {
    $.validator.addMethod("futureDate", function (value, element) {

        if (new Date(value) >= new Date()) {
            return true;
        }

        if (!value) {
            return true;
        }

    }, "Cannot be current/back dated");
} catch (e) {
}
//additional validation for dropdown
try {
    $.validator.addMethod("selectNotDefault", function (value, element) {
        if (value !== "0" || value !== "") {
            return true;
        }

    }, "Please choose a value!");
} catch (e) {
}

// local@domail.reservedDomain
try {
    $.validator.addMethod("emailFormat", function (value, element) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(value)) {
            return false;
        } else {
            return true;
        }
    }, "Please enter valid email address");

} catch (e) {
}


//numeric decimal
$(".decimal").keypress(function (event) {
    $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
    if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
});

//integer value
$('.numbersOnly').keypress(function (event) {
    $(this).val($(this).val().replace(/[^\d].+/, ""));
    if ((event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
});

// letter ,number, space backspace
$('.noSpecChar').keypress(function (event) {
    if (event.which == 8 || event.which == 32 || (event.which >= 48 && event.which <= 57) || (event.which <= 90 && event.which >= 65) || (event.which <= 122 && event.which >= 97)) {
        // do nothing
        if (event.which === 32 && !this.value.length) {
            event.preventDefault();
        } else {
            if ($(this).val().substring(0, 1) == " ") {
                $(this).val($(this).val().trim());
            }
            $(this).val($(this).val().replace(/\s+/g, ' '));
        }
    } else {
        event.preventDefault();
    }
});

$('.noSpecChar').keyup(function (event) {
    if ($(this).val().substring(0, 1) == " ") {
        $(this).val($(this).val().trim());
    }
});

$('.noTyping').keypress(function (e) {
    return false
});

// letter ,number, space backspace !@$
$('.limitedSpecChar').keypress(function (event) {
    if (event.which == 8 || event.which == 64 || event.which == 33 || event.which == 32 || event.which == 36 || (event.which >= 48 && event.which <= 57) || (event.which <= 90 && event.which >= 65) || (event.which <= 122 && event.which >= 97)) {
        // do nothing
        if (event.which === 32 && !this.value.length) {
            event.preventDefault();
        } else {
            if ($(this).val().substring(0, 1) == " ") {
                $(this).val($(this).val().trim());
            }
            $(this).val($(this).val().replace(/\s+/g, ' '));
        }
    } else {
        event.preventDefault();
    }
});

$('.limitedSpecChar').keyup(function (event) {
    if ($(this).val().substring(0, 1) == " ") {
        $(this).val($(this).val().trim());
    }
});

// letter  space backspace
$('.lettersOnly').keypress(function (event) {
    if (event.which == 8 || event.which == 32 || (event.which <= 90 && event.which >= 65) || (event.which <= 122 && event.which >= 97)) {
        // do nothing
        if (event.which === 32 && !this.value.length) {
            event.preventDefault();
        } else {
            if ($(this).val().substring(0, 1) == " ") {
                $(this).val($(this).val().trim());
            }
            $(this).val($(this).val().replace(/\s+/g, ' '));
        }

    } else {
        event.preventDefault();
    }
});
$('.lettersOnly').keyup(function (event) {
    if ($(this).val().substring(0, 1) == " ") {
        $(this).val($(this).val().trim());
    }
});

// letter  space backspace and hypen
$('.letterDash').keypress(function (event) {
    if (event.which == 8 || event.which == 32 || event.which == 45 || (event.which <= 90 && event.which >= 65) || (event.which <= 122 && event.which >= 97)) {
        // do nothings
        if (event.which === 32 && $(this).val().length <= 0) {
            event.preventDefault();
        } else {

            $(this).val($(this).val().replace(/\s+/g, ' '));
            if ($(this).val().substring(0, 1) == " ") {
                $(this).val($(this).val().trim());
            }
        }
    } else {
        event.preventDefault();
    }
});
$('.letterDash').keyup(function (event) {
    if ($(this).val().substring(0, 1) == " ") {
        $(this).val($(this).val().trim());
    }
});

// letter number space backspace and hypen
$('.letNumDash').keypress(function (event) {
    if (event.which == 8 || event.which == 32 || event.which == 45 || (event.which >= 48 && event.which <= 57) || (event.which <= 90 && event.which >= 65) || (event.which <= 122 && event.which >= 97)) {
        // do nothings
        if (event.which === 32 && $(this).val().length <= 0) {
            event.preventDefault();
        } else {

            $(this).val($(this).val().replace(/\s+/g, ' '));
            if ($(this).val().substring(0, 1) == " ") {
                $(this).val($(this).val().trim());
            }
        }
    } else {
        event.preventDefault();
    }
});

$('.letNumDash').keyup(function (event) {
    if ($(this).val().substring(0, 1) == " ") {
        $(this).val($(this).val().trim());
    }
});

$('.noSpcStart').keyup(function (event) {
    $(this).val($(this).val().replace(/\s+/g, ' '));
    if ($(this).val().substring(0, 1) == " ") {
        $(this).val($(this).val().trim());
    }
});

$('.noSpcStart').keypress(function (event) {
    if (event.which === 32 && !this.value.length) {
        event.preventDefault();
    }
});


// closing update modal
$('.closeUpdate').click(function () {
    var parentModal = $(this).attr('parentModal');
    $('#' + parentModal).modal('hide');
    if ($(this).attr('changes') == "1") {
        icmsMessage({
            type: "msgConfirmation",
            title: "Confirmation",
            LblBtnConfirm: "Ok",
            LblBtnCancel: "Cancel",
            body: "Changes in some fields has been done.<br>Closing this form will be lost your changes. ",
            onConfirm: function () {
                $('.modal').modal("hide");
                $(this).attr('changes', "0");

                $('#' + parentModal).on('hidden.bs.modal', function (e) {
                    $(this)
                            .find("input,textarea,select")
                            .val('')
                            .end()
                            .find("input[type=checkbox], input[type=radio]")
                            .prop("checked", "")
                            .end();
                })

            },
            onCancel: function () {
                $('#' + parentModal).modal('show');
            }
        });
    } else {
        $('.modal').modal("hide");
        $(this).attr('changes', "0");
    }
});

function changeReset() {
    $('.closeUpdate').attr('changes', '0');
}

var url = $(location).attr('href').split("/");

//$('.numbersOnly').bind('copy paste cut', function (e) {
//    if (url[3].toLowerCase() !== "add_case") {
//        e.preventDefault(); //disable cut,copy,paste 
//    }
//
//});
//
//$('.lettersOnly').bind('copy paste cut', function (e) {
//    if (url[3].toLowerCase() !== "add_case") {
//        e.preventDefault(); //disable cut,copy,paste 
//    }
//});
//$('.letterDash').bind('copy paste cut', function (e) {
//    if (url[3].toLowerCase() !== "add_case") {
//        e.preventDefault(); //disable cut,copy,paste 
//    }
//});
//
//$('.letNumDash').bind('copy paste cut', function (e) {
//    if (url[3].toLowerCase() !== "add_case") {
//        e.preventDefault(); //disable cut,copy,paste 
//    }
//});
//$('.noSpecChar').bind('copy paste cut', function (e) {
//    if (url[3].toLowerCase() !== "add_case") {
//        e.preventDefault(); //disable cut,copy,paste 
//    }
//});
//$('.decimal').bind('copy paste cut', function (e) {
//    if (url[3].toLowerCase() !== "add_case") {
//        e.preventDefault(); //disable cut,copy,paste 
//    }
//});
//
//$('.noSpcStart').bind('copy paste cut', function (e) {
//    if (url[3].toLowerCase() !== "add_case") {
//        e.preventDefault(); //disable cut,copy,paste 
//    }
//});


/* 
 * this is the restriction for the user level
 * this is opposite value
 * hide element in userlevel if the system found these classes 
 */
grantLevel();
function grantLevel() {
    var userLevel = $('#ul-header-user').attr('data-level'); // global for agency panel
    switch (userLevel) {
        case "2": //hide to Case Encoder
            $('.lvl-ce').remove();
            break;
        case "3"://hide to Case Handler
            $('.lvl-ch').remove();
            break;
        case"4"://hide case Administrator
            console.log('here');
            $('.lvl-ca').remove();
            break;
        case"5"://hide Reports And Analytics 
            $('.lvl-ra').remove();
            break;
        default:
        // branch administrator
        //lvl-ce lvl-ch lvl-ca lvl-ra
    }
}


//======================the following codes are placed for image/file type validation

function loadMime(file, callback) {

    //List of known mimes
    var mimes = [
        {
            mime: 'image/jpeg',
            pattern: [0xFF, 0xD8, 0xFF],
            mask: [0xFF, 0xFF, 0xFF],
        },
        {
            mime: 'image/png',
            pattern: [0x89, 0x50, 0x4E, 0x47],
            mask: [0xFF, 0xFF, 0xFF, 0xFF],
        }
    ];

    function check(bytes, mime) {
        for (var i = 0, l = mime.mask.length; i < l; ++i) {
            if ((bytes[i] & mime.mask[i]) - mime.pattern[i] !== 0) {
                return false;
            }
        }
        return true;
    }

    var blob = file.slice(0, 4); //read the first 4 bytes of the file

    var reader = new FileReader();
    reader.onloadend = function (e) {
        if (e.target.readyState === FileReader.DONE) {
            var bytes = new Uint8Array(e.target.result);

            for (var i = 0, l = mimes.length; i < l; ++i) {
                if (check(bytes, mimes[i]))
                    //return mime | browser -(mime is original type browser is renamed) 
                    return callback(mimes[i].mime + "|" + file.type);
            }
            //return mime | browser -(mime is original type browser is renamed)
            return callback("unknown|" + file.type);
        }
    };
    reader.readAsArrayBuffer(blob);
}
//end of image validation

function getMimetype(signature) {
    switch (signature) {
        case '89504E47':
            return 'image/png'
        case '47494638':
            return 'image/gif'
        case '25504446':
            return 'application/pdf'
        case 'FFD8FFDB':
        case 'FFD8FFE0':
        case 'FFD8FFE1':
            return 'image/jpeg'
        case '504B0304':
            return 'application/zip'
        default:
            return 'Unknown filetype'
    }
}

// check file format
/*
 * event = function (event)
 * min_size = 
 * element = element id 
 * modal_id = will show or not
 */
function checkFileFormat(event, min_size, elem, modal_id) {
    var file = event.target.files[0];
    var size = event.target.files[0].size;
    if (parseInt(size) <= parseInt(min_size)) {
        var filereader = new FileReader();
        filereader.onloadend = function (evt) {
            if (evt.target.readyState === FileReader.DONE) {
                var uint = new Uint8Array(evt.target.result)
                var bytes = []
                uint.forEach((byte) => {
                    bytes.push(byte.toString(16))
                })
                var hex = bytes.join('').toUpperCase()
                var filename = file.name;
                var filetype = file.type ? file.type : 'Unknown/Extension missing';
                var binaryFileType = getMimetype(hex);
                var hex = hex;

                // true 
                if (filetype == binaryFileType) {
                    // code here 
                }
                //false
                else {
                    // close current open modal 
                    $('.modal').modal('hide');
                    if (binaryFileType.split("/")[1]) {
                        icmsMessage({
                            type: "msgWarning",
                            body: "<center>Invalid file type.<br><br>(<small>This was originally <b>" + filetype.split("/")[1] + "</b> and was renamed to <b>" + binaryFileType.split("/")[1] + "</b></small>)</center>",
                            onHide: function () {
                                $('#' + elem).val('');
                                if (modal_id) {
                                    $('#' + modal_id).modal('show');
                                }
                            }
                        });
                    } else {
                        icmsMessage({
                            type: "msgWarning",
                            body: "<center>Invalid file type.<br><br>(<small>Please upload image or pdf file</small>)</center>",
                            onHide: function () {
                                $('#' + elem).val('');
                                if (modal_id) {
                                    $('#' + modal_id).modal('show');
                                }
                            }
                        });
                    }
                }
            }
        }

        var blob = file.slice(0, 4);
        filereader.readAsArrayBuffer(blob);
    } else {
        $('.modal').modal('hide');
        icmsMessage({
            type: "msgWarning",
            body: "Please select " + bytesToSize(min_size) + " file size or lower",
            onHide: function () {
                $('#' + elem).val('');
                if (modal_id) {
                    $('#' + modal_id).modal('show');
                }
            }
        });
    }
}


// bytes to size 
function prettySize(bytes, separator = ' ', postFix = '') {
    if (bytes) {
        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        const i = Math.min(parseInt(Math.floor(Math.log(bytes) / Math.log(1024)), 10), sizes.length - 1);
        return `${(bytes / (1024 ** i)).toFixed(i ? 1 : 0)}${separator}${sizes[i]}${postFix}`;
    }
    return 'n/a';
}

// filter array 
function filter_array(test_array) {
    // remove null, 0, undefiend, '', Nan, undefined, false 
    var index = -1,
            arr_length = test_array ? test_array.length : 0,
            resIndex = -1,
            result = [];

    while (++index < arr_length) {
        var value = test_array[index];

        if (value !== "0") {
            result[++resIndex] = value;
        }
    }

    return result;
}

//get form values 
function getFormValues(sForm) {
    var sData = '';
    $('form#' + sForm + ' :input').each(function (index) {
        var input = $(this);
        if (input.val()) {
            sData += input.val();
//            console.log('elemet=>' + input + '<-> value=>' + input.val());
        }
    });
    return sData;
}

function html_entity_decode(param) {
    var con = param;
    var result = '';

    if (isArray(con) === true) {
        var result = [];
        $.each(param, function (key, val) {
            //console.log(val);
            var newValue = {};
            $.each(val, function (nKey, nVal) {
                newValue[nKey] = html_entity_decode(nVal);
            });
            //console.log(newValue);
            result[key] = newValue;
        });
        //console.log(result);
        return result; 

    } else if (isObject(con) === true) {
        var result = {};
        $.each(param, function (key, val) {
            result[key] = html_entity_decode(val);
        });
        return result;
    } else {
        return $("<textarea/>").html(param).text();
    }

    return "";
}


function isNull(x) {
    try {
        if (x == "" || x.length === 0 || x.length == null || x === undefined) {
            return true;
        } else {
            return false;
        }
    } catch (e) {
    }
}

function convertArray() {

    if (isArray(str) === true) {
        str = Array.prototype.map.call(str, function (item) {
            html_entity_decode(str);
            return $("<textarea/>").html(item).text();
        });
        return str;
    } else if (isObject(str) === true) {
        //var x = isObject.length; 
        $.each(str, function (key, val) {
            str[key] = html_entity_decode(val);
        });
    } else {
        str = $("<textarea/>").html(str).text();
        return str;
    }

}


// Check the variable is object
function isObject(value) {
    return value && typeof value === "object" && value.constructor === Object;
}

// Check the variable is array
function isArray(x) {
    return Array.isArray(x);
}


//
//function html_entity_encode($data) {
//    if (is_array($data)) {
//        return array_map(array($this,'encode'), $data);
//    }
//    if (is_object($data)) {
//        $tmp = clone $data; // avoid modifing original object
//        foreach ( $data as $k => $var )
//            $tmp->{$k} = $this->encode($var);
//        return $tmp;
//    }
//    return htmlentities($data);
//}
//
//function html_entity_decode($data) {
//    if (is_array($data)) {
//        return array_map(array($this,'html_entity_decode'), $data);
//    }
//    if (is_object($data)) {
//        $tmp = clone $data; // avoid modifing original object
//        foreach ( $data as $k => $var )
//            $tmp->{$k} = $this->html_entity_decode($var);
//        return $tmp;
//    }
//    return html_entity_decode($data);
//}
//    
//    