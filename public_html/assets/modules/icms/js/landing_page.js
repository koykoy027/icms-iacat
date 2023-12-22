$('#search_form').validate({
    rules: {
        search_text: {required: true},
        
    },
    errorElement: 'div',
    errorPlacement: function (error, element) { 
        var placement = $(element).data('error');
        if (placement) {
            $(placement).append(error);
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function (form) {
        searchCase();
    }
});

function searchCase() {

    let data =  dg__objectAssign({
        type: "searchCase",
        case_no: $('.cn-text').val()
    });

    $.post(sAjaxWebPublic,data, function (rs) {
        console.log(rs);
        // icmsMessage({
        //     type: 'msgPreloader',
        //     visible: true
        // });
        if (rs.data.flag != '0') {
            // icmsMessage({
            //     type: 'msgSuccess'
            // });

            // console.log(rs);
            window.location.assign(window.location.protocol + rs.data.link);
        
        } else {
            icmsMessage({
                type: 'msgError'
            });
        }
    }, 'json');
}