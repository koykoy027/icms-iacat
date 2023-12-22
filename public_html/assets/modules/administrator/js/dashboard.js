
function buildCaseFilingActivitiesTemplate(res) {
    l = '';
    $.each(res, function (key, val) {
        l += '<li class="list-dashboard">';
        l += '    <div class="d-inline-block">';
        l += '        <span class="tags ' + getPriorityTag(val.case_priority_level_id) + '"></span> <span class="case-id">' + val.case_number + '</span><br>';
        l += '        <span>Created by : </span><span class="icms-btn-secondary">' + val.filed_by_agency + '</span> <br>';
        l += '        <span>Date created : </span><span class="icms-btn-secondary">   ' + val.case_date_added + '</span><br>';
        l += '        <span class="icms-btn-secondary p-r-10 "> <i class="fa fa-user p-r-10 text-gray-500" aria-hidden="true"></i>' + val.victim_count + ' Victims</span>';
        l += '    </div>';
        l += '</li>';
    });
    return l;
}

function getCaseFilingActivity() {
    var type = 'getCaseFilingActivity';
    $.post(sAjaxDashboard, {
        type: type
    }, function (rs) {
        $('#list-recent_cases').html(buildCaseFilingActivitiesTemplate(rs.data.recent_case));
        $('#list-high_priority_cases').html(buildCaseFilingActivitiesTemplate(rs.data.high_priority_case));
        $('#list-for_review_cases').html(buildCaseFilingActivitiesTemplate(rs.data.for_review_case));
    }, 'json');
}

function getTopActiveAgency() {
    var type = 'getTopActiveAgency';
    $.post(sAjaxDashboard, {
        type: type
    }, function (rs) {
        var l = '';
        var iCount = 0;
        $.each(rs.data.top_active_agency, function (key, val) {
            iCount++;
            l += ' <li class="list-dashboard">';
            l += '     <div class="d-inline-block">';
            l += '         <span class="top-agency-num">' + iCount + '</span>';
            l += '         <span class="case-id">' + val.filed_by_agency_branch + '</span><br>';
            l += '         <span class="small text-gray-500 achievement">' + val.filed_by_agency + '</span><br>';
            l += '         <span class="icms-btn-secondary p-r-10 achievement"> <i class="fa fa-trophy p-r-10 txt-orange" aria-hidden="true"></i>' + val.case_count + ' Case</span>';
            l += '     </div>';
            l += ' </li>';
        });
        // uncomment this after presentation 
        $('#top-branch_agency').html(l);
    }, 'json');
}

function getDashboardHeaderStat() {

    var type = 'getDashboardHeaderStat';

    $.post(sAjaxDashboard, {
        type: type
    }, function (rs) {
        $.each(rs.data, function (key, val) {
            if (val === '') {
                $('.header-' + key).text('0');
            } else {
                $('.header-' + key).text(val);
            }
        });

    }, 'json');
}

function getTopTipPerCountry() {
    var type = 'getTopTipPerCountry';
    $.post(sAjaxDashboard, {
        type: type
    }, function (rs) {
        getSampleChart2(rs.data.TopTipPerCountry);
    }, 'json');
}

function getTopNatureOfCase() {
    var type = 'getTopNatureOfCase';
    $.post(sAjaxDashboard, {
        type: type
    }, function (rs) {
        getSampleChart1(rs.data.top_5);
    }, 'json');
}

function getSampleChart1(aData) {
    am4core.useTheme(am4themes_animated);

    var chart = am4core.create("piegraph", am4charts.PieChart);

    chart.data = aData;

    chart.innerRadius = am4core.percent(50);
    // Add and configure Series
    var pieSeries = chart.series.push(new am4charts.PieSeries());
    pieSeries.dataFields.value = "percentage";
    pieSeries.dataFields.category = "purpose";

    pieSeries.ticks.template.disabled = true;

    pieSeries.alignLabels.disabled = true;
    pieSeries.labels.template.text = "{value.percent.formatNumber('#.0')}%";
    pieSeries.labels.template.radius = am4core.percent(10);
    pieSeries.labels.template.fill = am4core.color("white");

    chart.legend = new am4charts.Legend();
}

function getSampleChart2(aData) {
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("columnchart", am4charts.XYChart);

    // Add data
    chart.data = aData;

    // Create axes

    // Themes begin
    am4core.useTheme(am4themes_animated);

    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "country";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 30;

    categoryAxis.renderer.labels.template.adapter.add("dy", function (dy, target) {
        if (target.dataItem && target.dataItem.index & 2 == 2) {
            return dy + 25;
        }
        return dy;
    });

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

    // Create series
    var series = chart.series.push(new am4charts.ColumnSeries());
    series.dataFields.valueY = "count";
    series.dataFields.categoryX = "country";
    series.name = "Counts";
    series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
    series.columns.template.fillOpacity = .8;


    var columnTemplate = series.columns.template;
    columnTemplate.strokeWidth = 2;
    columnTemplate.strokeOpacity = 1;
}


function getUserActivityLogs(page) {
    var limit_count = 10;
    var limit_start = (page * limit_count) - limit_count;
    $.post(sAjaxDashboard, {
        type: "getActivityLogs_adminUser",
        limit_start: limit_start,
        limit_count: limit_count,
    }, function (rs) {
        if (rs.data.result.count >= 1) {
            var list = "";
            $.each(rs.data.result.list, function (key, val) {
                list += '<li class="list-dashboard">';
                list += '<div class="row">';
                list += '   <div class="col-lg-1 col-md-1 col-sm-1">';
                list += '           <div class="p-2 bd-highlight"><span class="notif-type-badge ' + val.badge_class + '"><i class="' + val.badge + '" aria-hidden="true"></i></span></div>';
                list += '   </div>';
                list += '   <div class="col-lg-8 col-md-8 col-sm-8">';
                list += '           <div class="p-2 bd-highlight"> <span class="case-id"  style="font-size: 15px;font-weight: 600;">' + val.user_log_fullname + ' </span><span class=""> ' + val.user_log_message + ' on ' + val.user_log_date_added + '</span><br>';
                list += '               <span class="text-gray-500">' + val.agency_abbr + ' - ' + val.agency_branch + '</span>';
                list += '           </div>';
                list += '   </div>';
                list += '   <div class="col-lg-3 col-md-3 col-sm-3">';
                list += '       <div class="icms-btn-secondary p-r-10 "> <i class="fa fa-clock-o p-r-10 text-gray-500" aria-hidden="true"></i>' + jQuery.timeago(val.user_log_date_added) + '</div>';
                list += '   </div>';
                list += '</div>';
                list += '</li>';
            });
            $('#list-all_logs').html(list);
            if (rs.data.result.count <= (page * limit_count) && rs.data.result.count >= limit_start) {
                $('#act-logs-content').attr('datapageend', 1);
                $('#act-logs-content').html("<center>End of user logs</center>");
            }
        } else {
            if ($('#act-logs-content').attr('datapageend') == "0") {
                $('#list-all_logs').html("<li><hr><center>No user logs found<li></center>");
            } else {
                $('#list-all_logs').html("><li><hr><center>End of user logs<li></center>");
            }
            $('#act-logs-content').attr('datapageend', 1);
        }
    }, 'json');
}
$(document).ready(function () {
    $("g[aria-labelledby]").hide();

    getDashboardHeaderStat();
    getCaseFilingActivity();
    getTopActiveAgency();
    getUserActivityLogs(1);
    grantLevel();
    getTopTipPerCountry();
    getTopNatureOfCase();

});

