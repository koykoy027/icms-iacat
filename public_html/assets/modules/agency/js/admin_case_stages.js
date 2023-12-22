



var aStagesAdmin = [
    {
        "content": [
            {
                "stage": "8",
                "name": "<b>VIII </b> <br> Writ of Execution",
                "class_name": "stage_8"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "7",
                "name": "<b> VII</b> <br> Appeal to the DOLE Secretary",
                "class_name": "stage_7"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "6",
                "name": "<b>VI </b> <br> Resolution of the Case",
                "class_name": "stage_6"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "5",
                "name": "<b>V </b> <br> Submission for Resolution",
                "class_name": "stage_5"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "4",
                "name": "<b>IV </b> <br> Preliminary Hearing",
                "class_name": "stage_4"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "3",
                "name": "<b>III </b> <br> Issuance of Order of preventive suspension",
                "class_name": "stage_3"
            }
        ]
    },
    {
        "content": [{
                "stage": "2",
                "name": "<b> II</b> <br> Conciliation Stage",
                "class_name": "stage_2"
            }]

    },
    {
        "content": [{
                "stage": "1",
                "name": "<b> I</b> <br> Docketing and Assignment of Cases",
                "class_name": "stage_1"
            }]

    }
];

function resetContentAdminStage() {
    $.each(aStagesAdmin, function (sKey, aVal) {

        $.each(aVal.content, function (cKey, cVal) {
            $('.' + cVal.class_name).hide();

        });

    });
}

$(document).ready(function () {

    resetContentAdminStage();


    var l = '';
    $.each(aStagesAdmin, function (key, val) {
        var aContent = val.content;
        var iCount = aContent.length;

        switch (parseInt(iCount)) {
            case 1:
                l += ' <li class="timeline-inverted">';
                l += '     <div class="timeline-badge warning"></div>';
                l += '     <div class="card card-tabs ' + aContent[0]['name'] + '" style="background-color:#f5f6fa; " attr-class_name = "' + aContent[0]['class_name'] + '">';
                l += '         <div class="card-body">';
                l += '           <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue mb-0 px-0" style="    text-align: center;">';
                l += aContent[0]['name'];
                l += '             </div>';
                l += '         </div>';
                l += '     </div>';
                l += ' </li>';
                break;
            case 2:
                l += '<li class="timeline-inverted">';
                l += '    <div class="timeline-badge warning"></div>';
                l += '    <div class="card ' + aContent[0]['name'] + '" style="background-color:#f5f6fa; " attr-class_name = "' + aContent[0]['class_name'] + '">';
                l += '        <div class="card-body">';
                l += '            <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue" style="padding: 0px;">' + aContent[0]['name'] + '</div>';
                l += '        </div>';
                l += '    </div>';
                l += '    <div class="card ' + aContent[1]['name'] + '" style=" background-color: #f5f6fa; margin-left: -134px; margin-top: -72px; width: 90px;" attr-class_name = "' + aContent[1]['class_name'] + '">';
                l += '        <div class="card-body">';
                l += '            <div class="col-lg-12 col-md-12 col-sm-12 card-sub-title blue" style="padding: 0px;">' + aContent[1]['name'] + '</div>';
                l += '        </div>';
                l += '    </div>';
                l += '</li>';

                break;
            default:
        }
    });


    $('#ul-stages_admin_case').html(l);

    $('#ul-stages_admin_case').delegate('.card', 'click', function () {
        resetContentAdminStage();
        var className = $(this).attr('attr-class_name');
        console.log(className);
        $('.' + className).show();
    });

    $("#collapseList").addClass("show");
    $("#ul-stages_admin_case li:first-child").addClass('active');

    $('#ul-stages_admin_case').delegate('.card', 'click', function () {
        $(".col-tab-content div:last-child").removeClass('show');
    });



    $(".col-tab-content div:last-child").css({display: "block !important"});


    $('#ul-stages_admin_case').delegate('.timeline-inverted', 'click', function () {
        var clickbtn = $(this);
        $("#collapseList").removeClass("show");
        if ($("#ul-stages_admin_case>li").hasClass('active')) {
            $('.timeline-inverted').removeClass('active');
            clickbtn.addClass('active');
        }

    });


});
