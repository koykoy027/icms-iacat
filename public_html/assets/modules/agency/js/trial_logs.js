


var aStages = [
    {
        "content": [
            {
                "stage": "15",
                "name": "<b>XV</b> <br> Decision of SC",
                "class_name": "stage_15"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "14",
                "name": " <b>XIV</b> <br> Appeal to the Supreme Court",
                "class_name": "stage_14"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "13",
                "name": "<b>XIII</b> <br> Decision of CA",
                "class_name": "stage_13"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "12",
                "name": "<b>XII</b> <br> Motion for Reconsideration on the Decision of CA ",
                "class_name": "stage_12"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "11",
                "name": "<b>XI</b> <br> Appeal to Court of Appeals ",
                "class_name": "stage_11"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "10",
                "name": "<b>X</b> <br> Motion for Reconsideration or New Trial ",
                "class_name": "stage_10"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "9",
                "name": "<b>IX</b> <br> Promulgation of Judgment ",
                "class_name": "stage_9"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "8",
                "name": "<b>VIII</b> <br> Submission for Resolution ",
                "class_name": "stage_8"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "7",
                "name": "<b>VII</b> <br> Trial ",
                "class_name": "stage_7"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "6",
                "name": "<b>VI</b> <br> Arraignment and Pre-Trial Conference",
                "class_name": "stage_6"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "5 ",
                "name": "<b>V</b> <br> Bail-Hearing and Resolution of Petition for Bail ",
                "class_name": "stage_5"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "4",
                "name": "<b>IV</b> <br> Dismissal or Issuance of Warrant or Arrest or Commitment Order ",
                "class_name": "stage_4"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "3",
                "name": "<b>III</b> <br> Filing of Information in Court ",
                "class_name": "stage_3"
            }
        ]
    },
    {
        "content": [
            {
                "stage": "2",
                "name": "<b>II</b> <br> Preliminary Investigation",
                "class_name": "stage_2"
            }
        ]
    },
    {
        "content": [{
                "stage": "1",
                "name": "<b>I</b> <br> Filing of Complaint",
                "class_name": "stage_1"
            }]

    }
];

function resetContent() {
    $.each(aStages, function (sKey, aVal) {

        $.each(aVal.content, function (cKey, cVal) {
            $('.' + cVal.class_name).hide();

        });

    });
}


$(document).ready(function () {

    resetContent();

    var l = '';
    $.each(aStages, function (key, val) {
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
    $('#ul-stages').html(l);


    $('#ul-stages').delegate('.card', 'click', function () {
        resetContent();
        var className = $(this).attr('attr-class_name');
        console.log(className);
        $('.' + className).show();
    });

    $("#collapseList").addClass("show");
    $("#ul-stages li:first-child").addClass('active');
    $(".col-tab-content div:last-child").addClass('show');
    $(".col-tab-content div:last-child").css({display: "block !important"});

    $('#ul-stages').delegate('.card', 'click', function () {
        $(".col-tab-content div:last-child").removeClass('show');
    });

    $('#ul-stages').delegate('.timeline-inverted', 'click', function () {
        var clickbtn = $(this);
        $("#collapseList").removeClass("show")
        if ($("#ul-stages>li").hasClass('active')) {
            $('.timeline-inverted').removeClass('active');
            clickbtn.addClass('active');
        }

    });

    $('.action-collapse').delegate('.btn-action-collapse', 'click', function () {
        var IdName = $(this).attr('attr');
//           alert(IdName);
//        $("#collapseList").removeClass("show")
        if ($(".action-collapse>.collapse").hasClass('show')) {
            $('#' + IdName).addClass('show');
            $('.action-collapse>.collapse').removeClass('show');

        }

    });

    $('#convicts_').click(function () {

    });



});
