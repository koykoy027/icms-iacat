
// Store Global Parameter Key
var aGPData = [];
var sPeriod = '';
var exportData = [];

function downloadTabular(tab) {
    var tableData = [
        {
            "sheetName": "Sheet1",
            "data": exportData[tab]
        }
    ];
    var options = {
        fileName: "report"
    };
    Jhxlsx.export(tableData, options);
}

function getAllGlobalParameter() {

    var type = 'getAllGlobalParameter';
    $.post(sAjaxReports, {
        type: type
    }, function (rs) {
        var sOption = '';
        var name = ''; // for select place holder

        //vitim select 
        name = 'Data Category';
        sOption = iniGlobalSelect(rs.data.base_report.victim.primary, name);
        $('#brv-primary').html(sOption);

        var iCount = 0;
        $.each(rs.data, function (key, val) {
            aGPData[iCount] = key;
            $('#vr-opt-' + key).html(iniCheckOption(val, key, 'vr'));
            iCount++;
        });

        //case select 
        name = 'Data Category';
        sOption = iniGlobalSelect(rs.data.base_report.case.primary, name);
        $('#brc-primary').html(sOption);

        var iCount = 0;
        $.each(rs.data, function (key, val) {
            aGPData[iCount] = key;
            $('#cr-opt-' + key).html(iniCheckOption(val, key, 'cr'));
            iCount++;
        });

        // case victim select 
        name = 'Data Category';
        sOption = iniGlobalSelect(rs.data.base_report.casevictim.primary, name);
        $('#brcv-primary').html(sOption);

        var iCount = 0;
        $.each(rs.data, function (key, val) {
            aGPData[iCount] = key;
            $('#cvr-opt-' + key).html(iniCheckOption(val, key, 'cv'));
            iCount++;
        });

        // report select 
        name = 'Data Category';
        sOption = iniGlobalSelect(rs.data.base_report.minor.primary, name);
        $('#brrm-primary').html(sOption);

        var iCount = 0;
        $.each(rs.data, function (key, val) {
            aGPData[iCount] = key;
            $('#rm-opt-' + key).html(iniCheckOption(val, key, 'rm'));
            iCount++;
        });

        aGPData.join();
        aGPData.splice(0, 1);

    }, 'json');
}

function _iniCheckOption(rs, name, abr) {
    var l = '';
    l += ' <div class="custom-control custom-checkbox">';
    l += '    <input type="checkbox" class="' + abr + '-opt-check_all custom-control-input"  value="0" name="opt' + name + '" id="opt-' + name + '">';
    l += '    <label class="custom-control-label" for="opt-' + name + '">Check All</label>';
    l += '</div>';

    $.each(rs, function (key, val) {
        l += ' <div class="custom-control custom-checkbox">';
        l += '    <input type="checkbox" class="custom-control-input be-' + abr + '-opt opt-' + name + '"  value="' + val.id + '" name="opt-' + name + '" id="opt' + name + '-' + val.id + '">';
        l += '    <label class="custom-control-label" for="opt' + name + '-' + val.id + '">' + val.name + '</label>';
        l += '</div>';
    });
    return l;
}

function iniCheckOption(rs, name, abr) {
    var l = '';
    l += ' <div class="custom-control custom-checkbox">';
    l += '    <input type="checkbox" class="' + abr + '-opt-check_all custom-control-input"  value="0" name="opt' + abr + '_' + name + '" id="opt-' + abr + '_' + name + '">';
    l += '    <label class="custom-control-label" for="opt-' + abr + '_' + name + '">Check All</label>';
    l += '</div>';

    $.each(rs, function (key, val) {
        l += ' <div class="custom-control custom-checkbox">';
        l += '    <input type="checkbox" class="custom-control-input be-' + abr + '-opt opt-' + abr + '_' + name + '"  value="' + val.id + '" name="opt-' + abr + '_' + name + '" id="opt' + abr + '_' + name + '-' + val.id + '">';
        l += '    <label class="custom-control-label" for="opt' + abr + '_' + name + '-' + val.id + '">' + val.name + '</label>';
        l += '</div>';
    });

    var aName = name.split('_');
    if (aName.indexOf('tip') != 0) {
        l += ' <div class="custom-control custom-checkbox">';
        l += '    <input type="checkbox" class="custom-control-input be-' + abr + '-opt opt-' + abr + '_' + name + '"  value="no_record" name="opt-' + abr + '_' + name + '" id="opt' + abr + '_' + name + '-no_record">';
        l += '    <label class="custom-control-label" for="opt' + abr + '_' + name + '-no_record">No Record</label>';
        l += '</div>';
    }

    return l;
}

function iniGlobalSelect(rs, name) {
    var l = '<option value="0" disabled selected> Select ' + name + '</option>';
    $.each(rs, function (key, val) {
        l += ' <option value="' + val.id + '">' + val.name + '</option> ';
    });
    return l;
}

function columnChart(aData, name, tab) {
    // Create chart instance
    switch (parseInt(tab)) {
        case 1:
            var chart = am4core.create("vr-chartdiv", am4charts.XYChart);
            break;
        case 2:
            var chart = am4core.create("cr-chartdiv", am4charts.XYChart);
            break;
        case 3:
            var chart = am4core.create("cvr-chartdiv", am4charts.XYChart);
            break;
        case 4:
            var chart = am4core.create("rmr-chartdiv", am4charts.XYChart);
            break;
        case 5:
            var chart = am4core.create("cra-chartdiv", am4charts.XYChart);
            break;
        case 6:
            var chart = am4core.create("cs-chartdiv", am4charts.XYChart);
            break;
        case 7:
            var chart = am4core.create("csa-chartdiv", am4charts.XYChart);
            break;

        default:
    }

    $.each(aData, function (key, val) {
        aData[key]['color'] = chart.colors.next();
    });

    chart.data = aData;

    // Create axes
    var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "variable";
    categoryAxis.numberFormatter.numberFormat = "#";
    categoryAxis.renderer.inversed = true;
    categoryAxis.renderer.minGridDistance = 10;

    var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());

    // Create series
    var series = chart.series.push(new am4charts.ColumnSeries3D());
    series.dataFields.valueX = "count";
    series.dataFields.categoryY = "variable";
    series.name = "Income";
    series.columns.template.propertyFields.fill = "color";
    series.columns.template.tooltipText = "{valueX}";
    series.columns.template.column3D.stroke = am4core.color("#fff");
    series.columns.template.column3D.strokeOpacity = 0.2;

    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineX.disabled = true;
    chart.cursor.lineY.disabled = false;

    // Chart responsive 
    chart.responsive.enabled = true;

    // Enable export
    chart.exporting.menu = new am4core.ExportMenu();

    chart.exporting.menu.align = "right";
    chart.exporting.menu.verticalAlign = "bottom";
    chart.exporting.menu.items = [
        {
            "label": "Download Graph",
            "menu": [
                {
                    "label": "Image",
                    "menu": [
                        {"type": "png", "label": "PNG"},
                        {"type": "jpg", "label": "JPG"},
//                        {"type": "gif", "label": "GIF"},
//                        {"type": "svg", "label": "SVG"},
                        {"type": "pdf", "label": "PDF"}
                    ]
                },
//                {
//                    "label": "Data",
//                    "menu": [
//                        {"type": "json", "label": "JSON"},
//                        {"type": "csv", "label": "CSV"},
//                        {"type": "xlsx", "label": "XLSX"}
//                    ]
//                }, 
                {
                    "label": "Print", "type": "print"
                }
            ]
        }
    ];

}

function partitionedBarChart(aData, name, tab, date) {

    // Create chart instance
    switch (parseInt(tab)) {
        case 1:
            var chart = am4core.create("vr-chartdiv", am4charts.XYChart);
            break;
        case 2:
            var chart = am4core.create("cr-chartdiv", am4charts.XYChart);
            break;
        case 3:
            var chart = am4core.create("cvr-chartdiv", am4charts.XYChart);
            break;
        default:
    }


// Add data
//    chart.data = aData;
    chart.data = [
        {
            "region": "Central",
            "state": "North Dakota",
            "sales": 920
        },
        {
            "region": "Central",
            "state": "South Dakota",
            "sales": 1317
        },
        {
            "region": "Central",
            "state": "Kansas",
            "sales": 2916
        },
        {
            "region": "Central",
            "state": "Iowa",
            "sales": 4577
        },
        {
            "region": "Central",
            "state": "Nebraska",
            "sales": 7464
        },
        {
            "region": "Central",
            "state": "Oklahoma",
            "sales": 19686
        },
        {
            "region": "Central",
            "state": "Missouri",
            "sales": 22207
        },
        {
            "region": "Central",
            "state": "Minnesota",
            "sales": 29865
        },
        {
            "region": "Central",
            "state": "Wisconsin",
            "sales": 32125
        },
        {
            "region": "Central",
            "state": "Indiana",
            "sales": 53549
        },
        {
            "region": "Central",
            "state": "Michigan",
            "sales": 76281
        },
        {
            "region": "Central",
            "state": "Illinois",
            "sales": 80162
        },
        {
            "region": "Central",
            "state": "Texas",
            "sales": 170187
        },
        {
            "region": "East",
            "state": "West Virginia",
            "sales": 1209
        },
        {
            "region": "East",
            "state": "Maine",
            "sales": 1270
        },
        {
            "region": "East",
            "state": "District of Columbia",
            "sales": 2866
        },
        {
            "region": "East",
            "state": "New Hampshire",
            "sales": 7294
        },
        {
            "region": "East",
            "state": "Vermont",
            "sales": 8929
        },
        {
            "region": "East",
            "state": "Connecticut",
            "sales": 13386
        },
        {
            "region": "East",
            "state": "Rhode Island",
            "sales": 22629
        },
        {
            "region": "East",
            "state": "Maryland",
            "sales": 23707
        },
        {
            "region": "East",
            "state": "Delaware",
            "sales": 27453
        },
        {
            "region": "East",
            "state": "Massachusetts",
            "sales": 28639
        },
        {
            "region": "East",
            "state": "New Jersey",
            "sales": 35763
        },
        {
            "region": "East",
            "state": "Ohio",
            "sales": 78253
        },
        {
            "region": "East",
            "state": "Pennsylvania",
            "sales": 116522
        },
        {
            "region": "East",
            "state": "New York",
            "sales": 310914
        },
        {
            "region": "South",
            "state": "South Carolina",
            "sales": 8483
        },
        {
            "region": "South",
            "state": "Louisiana",
            "sales": 9219
        },
        {
            "region": "South",
            "state": "Mississippi",
            "sales": 10772
        },
        {
            "region": "South",
            "state": "Arkansas",
            "sales": 11678
        },
        {
            "region": "South",
            "state": "Alabama",
            "sales": 19511
        },
        {
            "region": "South",
            "state": "Tennessee",
            "sales": 30662
        },
        {
            "region": "South",
            "state": "Kentucky",
            "sales": 36598
        },
        {
            "region": "South",
            "state": "Georgia",
            "sales": 49103
        },
        {
            "region": "South",
            "state": "North Carolina",
            "sales": 55604
        },
        {
            "region": "South",
            "state": "Oregon",
            "sales": 70641
        },
        {
            "region": "South",
            "state": "Florida",
            "sales": 89479
        },
        {
            "region": "West",
            "state": "Wyoming",
            "sales": 1603
        },
        {
            "region": "West",
            "state": "Idaho",
            "sales": 4380
        },
        {
            "region": "West",
            "state": "New Mexico",
            "sales": 4779
        },
        {
            "region": "West",
            "state": "Montana",
            "sales": 5589
        },
        {
            "region": "West",
            "state": "Utah",
            "sales": 11223
        },
        {
            "region": "West",
            "state": "Nevada",
            "sales": 16729
        },
        {
            "region": "West",
            "state": "Oregon",
            "sales": 17431
        },
        {
            "region": "West",
            "state": "Colorado",
            "sales": 32110
        },
        {
            "region": "West",
            "state": "Arizona",
            "sales": 35283
        },
        {
            "region": "West",
            "state": "Washington",
            "sales": 138656
        },
        {
            "region": "West",
            "state": "California",
            "sales": 457731
        }
    ];


// Create axes
    var yAxis = chart.yAxes.push(new am4charts.CategoryAxis());
    // demo details 
    yAxis.dataFields.category = "state";
    //working details 
//    yAxis.dataFields.category = "variable";
    yAxis.renderer.grid.template.location = 0;
    yAxis.renderer.labels.template.fontSize = 10;
    yAxis.renderer.minGridDistance = 10;

    var xAxis = chart.xAxes.push(new am4charts.ValueAxis());

// Create series
    var series = chart.series.push(new am4charts.ColumnSeries());
    // demo details 
    series.dataFields.valueX = "sales";
    series.dataFields.categoryY = "state";
    //working details 
//    series.dataFields.valueX = "count";
//    series.dataFields.categoryY = "variable";
    series.columns.template.tooltipText = "{categoryY}: [bold]{valueX}[/]";
    series.columns.template.strokeWidth = 0;
    series.columns.template.adapter.add("fill", function (fill, target) {
        if (target.dataItem) {

            // demo details
            switch (target.dataItem.dataContext.region) {
                case "Central":
                    return chart.colors.getIndex(0);
                    break;
                case "East":
                    return chart.colors.getIndex(1);
                    break;
                case "South":
                    return chart.colors.getIndex(2);
                    break;
                case "West":
                    return chart.colors.getIndex(3);
                    break;
            }

            // working details 
//            $.each(date, function (key, val) {
//                if (val === target.dataItem.dataContext.date) {
//                    return  chart.colors.getIndex(key);
//                }
//            });

        }
        return fill;
    });

// Add ranges
    function addRange(label, start, end, color) {
        var range = yAxis.axisRanges.create();
        range.category = start;
        range.endCategory = end;
        range.label.text = label;
        range.label.disabled = false;
        range.label.fill = color;
        range.label.location = 0;
        range.label.dx = -130;
        range.label.dy = 12;
        range.label.fontWeight = "bold";
        range.label.fontSize = 12;
        range.label.horizontalCenter = "left"
        range.label.inside = true;

        range.grid.stroke = am4core.color("#396478");
        range.grid.strokeOpacity = 1;
        range.tick.length = 200;
        range.tick.disabled = false;
        range.tick.strokeOpacity = 0.6;
        range.tick.stroke = am4core.color("#396478");
        range.tick.location = 0;

        range.locations.category = 1;
    }

    // demo details
    addRange("Central", "Texas", "North Dakota", chart.colors.getIndex(0));
    addRange("East", "New York", "West Virginia", chart.colors.getIndex(1));
    addRange("South", "Florida", "South Carolina", chart.colors.getIndex(2));
    addRange("West", "California", "Wyoming", chart.colors.getIndex(3));

    // working
//    $.each(date, function (key, val) {
//        addRange(val, aData[0]['variable'], aData[parseInt(aData.length) - 1]['variable'], chart.colors.getIndex(0));
//    });

    chart.cursor = new am4charts.XYCursor();
    chart.responsive.enabled = true;
}

function iniTabular(aData, name, tab) {

    var l = '';
    var iSum = 0;
    var count = 0;
    var aNewData = [];
    var count_collapse = 0;

    aNewData[count] = [{
            "merge": {
                "c": 3
            },
            "style": {
                "font": {
                    "bold": true
                }
            },
            "text": name + ' as of ' + $('.tab-pane.active.show .daterangepicker-field').val()
        }];
    count++;

    aNewData[count] = [{text: 'Date'}, {text: name}, {text: 'Count'}];
    count++;

    var is_status = 0;
    if (aData.by_date_status) {
        aData.by_date = aData.by_date_status;
        is_status = 1;
    }

    $.each(aData.by_date, function (key, val) {
        aNewData[count] = [{
                text: val.date
            }];
        count++;

        l += '<div class="row mt-4">';
        l += '    <div class="col-lg-12 col-md-12 col-sm-12 font-weight-bold"> ' + val.date + ' </div>';
        l += '</div>';

        l += '<div class="row">';
        var rSum = 0;

        if (is_status == 0) {
            $.each(val, function (vKey, vVal) {
                if (vKey !== 'date') {

                    var aNew = [{text: ''}, {text: vKey}, {text: vVal}]
                    aNewData[count] = aNew;
                    count++;

                    l += '    <div class="col-lg-4 col-md-4 col-sm-4 "> </div>';
                    l += '    <div class="col-lg-4 col-md-4 col-sm-4 text-align_center"> ' + vKey + ' </div>';
                    l += '    <div class="col-lg-4 col-md-4 col-sm-4 text-align_center"> ' + vVal + ' </div>';
                    iSum += parseInt(vVal);
                    rSum += parseInt(vVal);
                }
            });
        } else if (is_status == 1) {
            $.each(val, function (vKey, vVal) {

                if (vKey !== 'date' && vKey !== "No record.") {
                    content = vVal.content[0];
                    count_branch = 0;

                    var aNew = [{text: ''}, {text: vKey}, {text: vVal.count}]
                    aNewData[count] = aNew;
                    count++;

                    // new row 
                    aNewData[count] = [{text: ''}];
                    count++;

                    var temp_length = content.status;
                    temp_length = parseInt(temp_length.length) + 1;

                    aNewData[count] = [{text: ''}, {
                            "merge": {
                                "c": temp_length
                            },
                            "style": {
                                "font": {
                                    "bold": true
                                }
                            },
                            "text": `Summary of service in ${vKey} of ${val.date }`
                        }];
                    count++;

                    // new row 
                    aNewData[count] = [{text: ''}];
                    count++;

                    var aNew = [];
                    var me = 0;
                    var sT = {};

                    // new col 
                    aNew[me] = {text: ''};
                    me++;
                    // new col 
                    aNew[me] = {text: ''};
                    me++;

                    // status row 
                    $.each(content.status, function (key, val) {
                        if (val.status == "Total") {
                            sT = {text: val.status};
                        } else {
                            aNew[me] = {text: val.status};
                            me++;
                        }

                    });
                    aNew[me] = sT;
                    aNewData[count] = aNew;
                    count++;


                    // new row 
                    aNewData[count] = [{text: ''}];
                    count++;


                    l += `   
                        <div class="col-12">                        
                            <div class="row">
                                 <div class="col-4">
                                 </div>
                                 <div class="col-8">
                                     <div class="row">
                                         <div class="col-6 text-align_center">${vKey}</div>
                                         <div class="col-6 text-align_center">
                                         <span class="ml-5">${vVal.count}</span>
                                         <button class="btn btn-primary-orange float-right mb-4 view_more" type="button" data-toggle="collapse" data-target="#collapse_${count_collapse}" aria-expanded="false" aria-controls="collapse_${count_collapse}">
                                               <i class="fa fa-arrow-down" aria-hidden="true"></i>
                                               <i class="fa fa-arrow-left" style="display:none; aria-hidden="true"></i>
                                         </button>
                                         </div>
                                     </div>                            
                                 </div>
                             </div>
                    
                             <div class="row">
                                <div class="col align-self-center"> 
                                    <div class="collapse inner-box matched_contents" id="collapse_${count_collapse}">
                                        <div class=" card-sub-title txt-W-500 text-center"> 
                                            Summary of service in ${vKey} of ${val.date }
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table">
                                               <thead>
                                                <tr>
                                                  <th scope="col"></th>
                    ${buildTableStatus({
                        start: `<th scope="col">`,
                        end: `</th>`,
                        content: content.status,
                        get: 'status'
                    })}
                                                </tr>
                                              </thead>
                                              <tbody>`;

                    // for branch 
                    $.each(vVal.content, function (bKey, bVal) {

                        // for branch 
                        var aNew = [{text: ''}, {text: bVal.variable}]
                        aNewData[count] = aNew;
                        count++;

                        // services offered 
                        $.each(bVal.content, function (Skey, Sval) {
                            var aNew = [{text: ''}, {text: Sval.service_name_full}];
                            var me = aNew.length;
                            var sT = {};

                            // status row 
                            $.each(Sval.status, function (key, val) {
                                if (val.status == "Total") {
                                    sT = {text: val.count};
                                } else {
                                    aNew[me] = {text: val.count};
                                    me++;
                                }
                            });
                            aNew[me] = sT;
                            aNewData[count] = aNew;
                            count++;
                        });


                        count_branch++;
                        var status_value = [];
                        status_value = bVal.status;


                        // total 
                        var aNew = [{text: ''}, {text: "Total"}];
                        var me = aNew.length;
                        var sT = {};
                        $.each(status_value, function (key, val) {
                            if (val.status == "Total") {
                                sT = {text: val.count};
                            } else {
                                aNew[me] = {text: val.count};
                                me++;
                            }
                        });
                        aNew[me] = sT;
                        aNewData[count] = aNew;
                        count++;

                        l += `                  <tr>
                                                  <th scope="row">${bVal.variable}</th>
                        ${buildTableStatus({
                            start: `<td>`,
                            end: `</td>`,
                            content: bVal.status,
                            get: 'service_empty'
                        })}
                                                </tr>
                         ${buildTableStatus({
                            start: `<tr>`,
                            end: `</tr>`,
                            content: bVal.content,
                            get: 'service_name_full'
                        })}
                        
                        <tr class="text-center font-weight-bold">  
                            <td> 
                                <div class="ml-3"> Total </div> 
                            </td> 
                        ${buildTableStatus({
                            start: `<td>`,
                            end: `</td>`,
                            content: status_value,
                            get: 'status_value'
                        })}
                        </tr>
                        `;

                        // new row 
                        aNewData[count] = [{text: ''}];
                        count++;

                    });

                    if (count_branch > 1) {

                        var status_value_agency = [];
                        status_value_agency = vVal.status;

                        // over all total 
                        var aNew = [{text: ''}, {text: "Overall total"}];
                        var me = aNew.length;
                        var sT = {};
                        $.each(status_value_agency, function (key, val) {
                            if (val.status == "Total") {
                                sT = {text: val.count};
                            } else {
                                aNew[me] = {text: val.count};
                                me++;
                            }
                        });
                        aNew[me] = sT;
                        aNewData[count] = aNew;
                        count++;

                        // new row 
                        aNewData[count] = [{text: ''}];
                        count++;

                        l += `
                                                <tr class="text-center font-weight-bold">  
                                                   <td> 
                                                       <div class="ml-3"> Overall total </div> 
                                                   </td> 
                    ${buildTableStatus({
                            start: `<td>`,
                            end: `</td>`,
                            content: status_value_agency,
                            get: 'status_value'
                        })}
                                               </tr>`;
                    }


                    l += `                        </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                             </div>

                        </div>
                    `;
                    count_collapse++;
                    iSum += parseInt(vVal.count);
                    rSum += parseInt(vVal.count);
                }
            });
        }

        // new row 
        aNewData[count] = [{text: ''}];
        count++;

        var aNew = [{text: ''}, {text: 'Total'}, {text: rSum}]
        aNewData[count] = aNew;
        count++;

        l += '<hr>';
        l += '    <div class="col-lg-4 col-md-4 col-sm-4 "> </div>';
        l += '    <div class="col-lg-4 col-md-4 col-sm-4 text-total text-align_center"> Total: </div>';
        l += '    <div class="col-lg-4 col-md-4 col-sm-4 text-total text-align_center"> ' + rSum + ' </div>';

        l += '</div>';
    });

    var aNew = [{text: ''}]
    aNewData[count] = aNew;
    count++;

    var aNew = [{text: ''}, {text: 'Grand Total'}, {text: iSum}]
    aNewData[count] = aNew;
    count++;

    exportData[tab] = aNewData;

    l += '<hr>';
    l += '<div class="row">';
    l += '    <div class="col-lg-4 col-md-4 col-sm-4"> </div>';
    l += '    <div class="col-lg-4 col-md-4 col-sm-4 text-gtotal text-align_center"> GRAND TOTAL: </div>';
    l += '    <div class="col-lg-4 col-md-4 col-sm-4 text-gtotal text-align_center"> ' + iSum + ' </div>';
    l += '</div>';

    // Create chart instance
    switch (parseInt(tab)) {
        case 1:
            $('#vt-variable').text(name);
            $('#vt-body').html(l);
            break;
        case 2:
            $('#ct-variable').text(name);
            $('#ct-body').html(l);
            break;
        case 3:
            $('#cvt-variable').text(name);
            $('#cvt-body').html(l);
            break;
        case 4:
            $('#rmt-variable').text(name);
            $('#rmt-body').html(l);
            break;
        case 5:
            $('#cra-variable').text(name);
            $('#cra-body').html(l);
            break;
        case 6:
            $('#cst-variable').text(name);
            $('#cst-body').html(l);
            break;
        case 7:
            $('#csat-variable').text(name);
            $('#csat-body').html(l);
            break;
        default:
    }
}

function buildTableStatus(x = null) {
    var l = "";
    var l_total = "";
    var get = x.get;
    var content = [];
    content = x.content;

    $.each(content, function (bKey, bVal) {
        if (get == "status") {
            if (bVal.status == "Total") {
                l_total += `${x.start} ${bVal.status} ${x.end}`;
            } else {
                l += `${x.start} ${bVal.status} ${x.end}`;
            }
        } else if (get == "service_name_full") {


            var status_value = [];
            status_value = bVal.status;

            var content_stat = "";
            content_stat = buildTableStatus({
                start: `<td class="text-center">`,
                end: `</td>`,
                content: status_value,
                get: 'status_value'
            });
            l += `${x.start}  
                    <td scope="col">  
                        <div class="ml-3">${bVal.service_name_full} </div> 
                    </td> 
                    ${content_stat} 
                  ${x.end} 
                `;

        } else if (get == "status_value") {
            if (bVal.status == "Total") {
                l_total += `${x.start} <span class="font-weight-bold"> ${bVal.count} </span> ${x.end}`;
            } else {
                l += `${x.start} ${bVal.count} ${x.end}`;
            }
        } else if (get == "service_empty") {
            l += `${x.start} ${x.end}`;
        }

    });
    l += l_total;
    return l;
}

function generateCaseReport() {

    icmsMessage({
        type: 'msgPreloader',
        body: 'Please wait while generating your report.',
        visible: true
    });

    var start_date = $('#cr-reportrange').attr('data-start');
    var end_date = $('#cr-reportrange').attr('data-end');
    var br_primary = $('#brc-primary').val();
    var br_primary_name = $('#brv-primary option:selected').text();
    var optData = {};
    var sOptData = '';
    $.each(aGPData, function (key, val) {
        optData[val] = $('.opt-' + val + ':checked').map(function () {
            return this.value;
        }).get();
    });
    sOptData = JSON.stringify(optData);

    var type = 'generateCaseReport';
    $.post(sAjaxReports, {
        type: type,
        br_primary: br_primary,
        start_date: start_date,
        end_date: end_date,
        optData: sOptData
    }, function (rs) {

        $('#chartdiv').removeAttr('id');
        if (rs.data.graph.by_date.length > 0) {
            $('#cr-result-no-content').remove();
            $('#cr-result').show();
            $('.be-cr_title_name').text(br_primary_name);
            $('.be-cr_title_date').text(' as of' + $('#cr-reportrange').text());
            columnChart(rs.data.graph, br_primary_name, 2);
            iniTabular(rs.data.graph, br_primary_name, 2);
        } else {
            var sMessage = 'NO DATA FOUNDS';
            var l = getNoDataFound({
                message: sMessage,
                footer: ''
            });
            $('#cr-result').hide();
            $('#cr-result-no-content').remove();
            $('#cr-result').after("<div id='cr-result-no-content'>" + l + "</div>");
        }

        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });

    }, 'json');
}

function setChartType(c_type, aData, br_primary_name, tab) {
    var by_variable = aData.by_variable;
    var by_date = aData.by_date;
    var seperated = aData.seperate;

    // For chart type
    switch (parseInt(c_type)) {
        case 1:
            columnChart(by_variable, br_primary_name, tab);
            break;
        case 2:
            variableHeight3PieChart(by_variable, br_primary_name, tab);
            break;
        case 3:
            variableRadiusPieChart(by_variable, br_primary_name, tab);
            break;
        case 4:
            reverseValueAxis(by_date, br_primary_name, tab);
            break;
        default:
    }

}

function generateVictimReport() {

    icmsMessage({
        type: 'msgPreloader',
        body: 'Please wait while creating your report.',
        visible: true
    });

    var start_date = $('#vr-reportrange').attr('data-start');
    var end_date = $('#vr-reportrange').attr('data-end');
    var report_type = $('#vr-reportrange').attr('data-report-type');
    var br_primary = $('#brv-primary').val();
    var br_secondary = $('br-secondary').val();
    var br_primary_name = $('#brv-primary option:selected').text();
    var brv_agency = $('#brv-agency').val();
    var brv_agency_branch = $('#brv-agency_branch').val();
    var c_type = $('#brv-rt').val();
    var is_minor = ($('#opt-vr_minor').prop("checked") == true) ? '1' : '0';
    var optData = {};
    var sOptData = '';
    $.each(aGPData, function (key, val) {
        optData[val] = $('.opt-vr_' + val + ':checked').map(function () {
            return this.value;
        }).get();
    });

    sOptData = JSON.stringify(optData);
    var type = 'generateVictimReport';
    $.post(sAjaxReports, {
        type: type,
        br_primary: br_primary,
        br_secondary: br_secondary,
        report_type: report_type,
        start_date: start_date,
        end_date: end_date,
        optData: sOptData,
        agency_id: brv_agency,
        agency_branch_id: brv_agency_branch,
        is_minor: is_minor
    }, function (rs) {
        if (rs.data.flag != '0') {
            $('#vr-result-no-content').remove();
            $('#vr-result').show();
            $('.be-vr_title_name').text(br_primary_name);
            $('.be-vr_title_date').text(' as of ' + $('#vr-reportrange').val());

            // For Column Chart 
            setChartType(c_type, rs.data.graph, br_primary_name, 1);

            //For Partition Bar Chart,
//            partitionedBarChart(rs.data.graph.seperate, br_primary_name, 1, rs.data.date);
//            clusteredColumnChart(rs.data.graph.seperate, br_primary_name, 1, rs.data.date);

            // Generate Tabular 
            iniTabular(rs.data.graph, br_primary_name, 1);

            $('html, body').animate({
                scrollTop: $("div#vr-result").offset().top
            }, 2000);

        } else {
            var sMessage = 'NO DATA FOUNDS';
            var l = getNoDataFound({
                message: sMessage,
                footer: ''
            });
            $('#vr-result').hide();
            $('#vr-result-no-content').remove();
            $('#vr-result').after("<div id='vr-result-no-content'>" + l + "</div>");

            $('html, body').animate({
                scrollTop: $("div#vr-result-no-content").offset().top
            }, 2000);

        }

        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });



    }, 'json');
}

function generateCaseVictimMinorReport() {

    icmsMessage({
        type: 'msgPreloader',
        body: 'Please wait while creating your report.',
        visible: true
    });

    var start_date = $('#rm-reportrange').attr('data-start');
    var end_date = $('#rm-reportrange').attr('data-end');
    var report_type = $('#rm-reportrange').attr('data-report-type');
    var br_primary = $('#brrm-primary').val();
    var br_secondary = $('brrm-secondary').val();
    var br_primary_name = $('#brrm-primary option:selected').text();

    var brrm_agency = $('#brrm-agency').val();
    var brrm_agency_branch = $('#brrm-agency_branch').val();
    var c_type = $('#brrm-rt').val();
    var optData = {};
    var sOptData = '';
    $.each(aGPData, function (key, val) {
        optData[val] = $('.opt-rm_' + val + ':checked').map(function () {
            return this.value;
        }).get();
    });

    sOptData = JSON.stringify(optData);
    var type = 'generateCaseVictimMinorReport';
    $.post(sAjaxReports, {
        type: type,
        br_primary: br_primary,
        br_secondary: br_secondary,
        report_type: report_type,
        start_date: start_date,
        end_date: end_date,
        optData: sOptData,
        agency_id: brrm_agency,
        agency_branch_id: brrm_agency_branch

    }, function (rs) {
        if (rs.data.flag != '0') {
            $('#rmr-result-no-content').remove();
            $('#rmr-result').show();
            $('.be-rm_title_name').text(br_primary_name);
            $('.be-rm_title_date').text(' as of ' + $('#rm-reportrange').val());

            setChartType(c_type, rs.data.graph, br_primary_name, 4);
            // For Column Chart 
//            columnChart(rs.data.graph.by_variable, br_primary_name, 4);

            //For Partition Bar Chart,
//            partitionedBarChart(rs.data.graph.seperate, br_primary_name, 1, rs.data.date);
//            clusteredColumnChart(rs.data.graph.seperate, br_primary_name, 1, rs.data.date);

            // Generate Tabular 
            iniTabular(rs.data.graph, br_primary_name, 4);

            $('html, body').animate({
                scrollTop: $("div#rmr-result").offset().top
            }, 2000);

        } else {
            var sMessage = 'NO DATA FOUNDS';
            var l = getNoDataFound({
                message: sMessage,
                footer: ''
            });
            $('#rmr-result').hide();
            $('#rmr-result-no-content').remove();
            $('#rmr-result').after("<div id='rmr-result-no-content'>" + l + "</div>");

            $('html, body').animate({
                scrollTop: $("div#rmr-result-no-content").offset().top
            }, 2000);

        }

        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });


    }, 'json');
}

function generateCaseVictimReport() {

    icmsMessage({
        type: 'msgPreloader',
        body: 'Please wait while creating your report.',
        visible: true
    });

    var start_date = $('#cvr-reportrange').attr('data-start');
    var end_date = $('#cvr-reportrange').attr('data-end');
    var br_primary = $('#brcv-primary').val();
    var br_primary_name = $('#brcv-primary option:selected').text();
    var report_type = $('#cvr-reportrange').attr('data-report-type');

    var cvr_agency = $('#brcv-agency').val();
    var cvr_agency_branch = $('#brcv-agency_branch').val();

    var optData = {};
    var sOptData = '';
    $.each(aGPData, function (key, val) {
        optData[val] = $('.opt-cv_' + val + ':checked').map(function () {
            return this.value;
        }).get();
    });

    sOptData = JSON.stringify(optData);

    var c_type = $('#brcv-rt').val();
    var base_type_report = $("#brcv-base_type_report").val();
    var is_minor = ($('#opt-cv_minor').prop("checked") == true) ? '1' : '0';
    var type = 'generateCaseVictimReport';
    $.post(sAjaxReports, {
        type: type,
        br_primary: br_primary,
        start_date: start_date,
        end_date: end_date,
        optData: sOptData,
        report_type: report_type,
        agency_id: cvr_agency,
        agency_branch_id: cvr_agency_branch,
        base_type_report: base_type_report,
        is_minor: is_minor
    }, function (rs) {
        if (rs.data.flag != '0') {
            $('#cvr-result-no-content').remove();
            $('#cvr-result').show();
            $('.be-cvr_title_name').text(br_primary_name);
            $('.be-cvr_title_date').text(' as of ' + $('#cvr-reportrange').val());

            setChartType(c_type, rs.data.graph, br_primary_name, 3);

            // For Column Chart 
//            columnChart(rs.data.graph.by_variable, br_primary_name, 3);

            //For Partition Bar Chart,
//            partitionedBarChart(rs.data.graph.seperate, br_primary_name, 1, rs.data.date);
//            clusteredColumnChart(rs.data.graph.seperate, br_primary_name, 1, rs.data.date);

            // Generate Tabular 
            iniTabular(rs.data.graph, br_primary_name, 3);

            $('html, body').animate({
                scrollTop: $("div#cvr-result").offset().top
            }, 2000);

        } else {

            var sMessage = 'NO DATA FOUNDS';
            var l = getNoDataFound({
                message: sMessage,
                footer: ''
            });
            $('#cvr-result').hide();
            $('#cvr-result-no-content').remove();
            $('#cvr-result').after("<div id='cvr-result-no-content'>" + l + "</div>");

            $('html, body').animate({
                scrollTop: $("div#cvr-result-no-content").offset().top
            }, 2000);
        }

        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });



    }, 'json');
}

function generateCaseVictimAllegedReport() {

    icmsMessage({
        type: 'msgPreloader',
        body: 'Please wait while creating your report.',
        visible: true
    });

    var start_date = $('#cra-reportrange').attr('data-start');
    var end_date = $('#cra-reportrange').attr('data-end');
    var br_primary = $('#brcra-primary').val();
    var br_primary_name = $('#brcra-primary option:selected').text();
    var report_type = $('#cra-reportrange').attr('data-report-type');

    var c_type = $('#brcra-rt').val();
    var type = 'generateCaseVictimAllegedReport';
    $.post(sAjaxReports, {
        type: type,
        br_primary: br_primary,
        start_date: start_date,
        end_date: end_date,
        report_type: report_type,
    }, function (rs) {
        if (rs.data.flag != '0') {
            $('#cra-result-no-content').remove();
            $('#cra-result').show();
            $('.be-cra_title_name').text(br_primary_name);
            $('.be-cra_title_date').text(' as of ' + $('#cra-reportrange').val());

            setChartType(c_type, rs.data.graph, br_primary_name, 5);

            // For Column Chart 
//            columnChart(rs.data.graph.by_variable, br_primary_name, 3);

            //For Partition Bar Chart,
//            partitionedBarChart(rs.data.graph.seperate, br_primary_name, 1, rs.data.date);
//            clusteredColumnChart(rs.data.graph.seperate, br_primary_name, 1, rs.data.date);

            // Generate Tabular 
            iniTabular(rs.data.graph, br_primary_name, 5);

            $('html, body').animate({
                scrollTop: $("div#cra-result").offset().top
            }, 2000);

        } else {

            var sMessage = 'NO DATA FOUNDS';
            var l = getNoDataFound({
                message: sMessage,
                footer: ''
            });
            $('#cra-result').hide();
            $('#cra-result-no-content').remove();
            $('#cra-result').after("<div id='cra-result-no-content'>" + l + "</div>");

            $('html, body').animate({
                scrollTop: $("div#cra-result-no-content").offset().top
            }, 2000);
        }

        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });



    }, 'json');
}

function generateCaseServicesReport() {

    icmsMessage({
        type: 'msgPreloader',
        body: 'Please wait while creating your report.',
        visible: true
    });

    var start_date = $('#cs-reportrange').attr('data-start');
    var end_date = $('#cs-reportrange').attr('data-end');
//    var br_primary = $('#brcs-primary').val();
    var br_primary = '1';
    var br_primary_name = $('#brcs-primary option:selected').text();
    var report_type = $('#cs-reportrange').attr('data-report-type');

    var brcs_agency = $('#brcs-agency').val();
    var brcs_agency_branch = $('#brcs-agency_branch').val();

    var c_type = $('#brcs-rt').val();
    var type = 'generateCaseServicesReport';
    $.post(sAjaxReports, {
        type: type,
        br_primary: br_primary,
        start_date: start_date,
        end_date: end_date,
        report_type: report_type,
        agency_id: brcs_agency,
        agency_branch_id: brcs_agency_branch
    }, function (rs) {
        if (rs.data.flag != '0') {
            $('#cs-result-no-content').remove();
            $('#cs-result').show();
            $('.be-cs_title_name').text(br_primary_name);
            $('.be-cs_title_date').text(' as of ' + $('#cs-reportrange').val());

            setChartType(c_type, rs.data.graph, br_primary_name, 6);

            // For Column Chart 
//            columnChart(rs.data.graph.by_variable, br_primary_name, 3);

            //For Partition Bar Chart,
//            partitionedBarChart(rs.data.graph.seperate, br_primary_name, 1, rs.data.date);
//            clusteredColumnChart(rs.data.graph.seperate, br_primary_name, 1, rs.data.date);

            // Generate Tabular 
            iniTabular(rs.data.graph, br_primary_name, 6);

            $('html, body').animate({
                scrollTop: $("div#cs-result").offset().top
            }, 2000);

        } else {

            var sMessage = 'NO DATA FOUND';
            var l = getNoDataFound({
                message: sMessage,
                footer: ''
            });
            $('#cs-result').hide();
            $('#cs-result-no-content').remove();
            $('#cs-result').after("<div id='cs-result-no-content'>" + l + "</div>");

            $('html, body').animate({
                scrollTop: $("div#cs-result-no-content").offset().top
            }, 2000);
        }

        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });
    }, 'json');
}

function generateCaseServicesAgingReport() {

    icmsMessage({
        type: 'msgPreloader',
        body: 'Please wait while creating your report.',
        visible: true
    });

    var start_date = $('#csa-reportrange').attr('data-start');
    var end_date = $('#csa-reportrange').attr('data-end');
//    var br_primary = $('#brcs-primary').val();
    var br_primary = '1';
    var br_primary_name = $('#brcsa-primary option:selected').text();
    var report_type = $('#csa-reportrange').attr('data-report-type');

    var brcs_agency = $('#brcsa-agency').val();
    var brcs_agency_branch = $('#brcsa-agency_branch').val();

    var c_type = $('#brcsa-rt').val();
    //generateCaseServicesReport
    var type = 'generateCaseServicesAgingReport';
    $.post(sAjaxReports, {
        type: type,
        br_primary: br_primary,
        start_date: start_date,
        end_date: end_date,
        report_type: report_type,
        agency_id: brcs_agency,
        agency_branch_id: brcs_agency_branch
    }, function (rs) {
        if (rs.data.flag != '0') {
            $('#csa-result-no-content').remove();
            $('#csa-result').show();
            $('.be-csa_title_name').text(br_primary_name);
            $('.be-csa_title_date').text(' as of ' + $('#csa-reportrange').val());

            setChartType(c_type, rs.data.graph, br_primary_name, 7);

            // For Column Chart 
//            columnChart(rs.data.graph.by_variable, br_primary_name, 3);

            //For Partition Bar Chart,
//            partitionedBarChart(rs.data.graph.seperate, br_primary_name, 1, rs.data.date);
//            clusteredColumnChart(rs.data.graph.seperate, br_primary_name, 1, rs.data.date);

            // Generate Tabular 
            iniTabular(rs.data.graph, br_primary_name, 7);

            $('html, body').animate({
                scrollTop: $("div#csa-result").offset().top
            }, 2000);

        } else {

            var sMessage = 'NO DATA FOUND';
            var l = getNoDataFound({
                message: sMessage,
                footer: ''
            });
            $('#csa-result').hide();
            $('#csa-result-no-content').remove();
            $('#csa-result').after("<div id='csa-result-no-content'>" + l + "</div>");

            $('html, body').animate({
                scrollTop: $("div#csa-result-no-content").offset().top
            }, 2000);
        }

        icmsMessage({
            type: 'msgPreloader',
            visible: false
        });
    }, 'json');
}

function getReportTypeValue(sName, sTab) {

    var lblName = '#' + sTab + '-txt-report_type';
    var inpId = '#' + sTab + '-' + 'reportrange';
    switch (sName) {
        case 'Day':
            $(lblName).html('Daily');
            $(inpId).attr('data-report-type', 1);
            break;
        case 'Week':
            $(lblName).html('Weekly');
            $(inpId).attr('data-report-type', 2);
            break;
        case 'Month':
            $(lblName).html('Monthly');
            $(inpId).attr('data-report-type', 3);
            break;
        case 'Quarter':
            $(lblName).html('Quarterly');
            $(inpId).attr('data-report-type', 4);
            break;
        case 'Year':
            $(lblName).html('Yearly');
            $(inpId).attr('data-report-type', 5);
            break;
        default:
            $(inpId).attr('data-report-type', 1);
    }

}

function iniDateRangePicker() {

    // Start  Initialized Date range picker 

    //victim 
    $('#vr-reportrange').daterangepicker({
        forceUpdate: true,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        callback: function (startDate, endDate, period) {
            //  Build Date and add class to daterangepicker
            var title = startDate.format('L') + ' – ' + endDate.format('L');
            $(this).val(title);
            $('#vr-reportrange').attr('data-start', startDate.format('YYYY-MM-DD'));
            $('#vr-reportrange').attr('data-end', endDate.format('YYYY-MM-DD'));
        }
    });


    //case victim
    $('#cvr-reportrange').daterangepicker({
        forceUpdate: true,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        callback: function (startDate, endDate, period) {
            //  Build Date and add class to daterangepicker
            var title = startDate.format('L') + ' – ' + endDate.format('L');
            $(this).val(title);
            $('#cvr-reportrange').attr('data-start', startDate.format('YYYY-MM-DD'));
            $('#cvr-reportrange').attr('data-end', endDate.format('YYYY-MM-DD'));
        }
    });

    //case victim
    $('#rm-reportrange').daterangepicker({
        forceUpdate: true,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        callback: function (startDate, endDate, period) {
            //  Build Date and add class to daterangepicker
            var title = startDate.format('L') + ' – ' + endDate.format('L');
            $(this).val(title);
            $('#rm-reportrange').attr('data-start', startDate.format('YYYY-MM-DD'));
            $('#rm-reportrange').attr('data-end', endDate.format('YYYY-MM-DD'));
        }
    });

    // alleged offender 
    $('#cra-reportrange').daterangepicker({
        forceUpdate: true,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        callback: function (startDate, endDate, period) {
            //  Build Date and add class to daterangepicker
            var title = startDate.format('L') + ' – ' + endDate.format('L');
            $(this).val(title);
            $('#cra-reportrange').attr('data-start', startDate.format('YYYY-MM-DD'));
            $('#cra-reportrange').attr('data-end', endDate.format('YYYY-MM-DD'));
        }
    });

    // service cases 
    $('#cs-reportrange').daterangepicker({
        forceUpdate: true,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        callback: function (startDate, endDate, period) {
            //  Build Date and add class to daterangepicker
            var title = startDate.format('L') + ' – ' + endDate.format('L');
            $(this).val(title);
            $('#cs-reportrange').attr('data-start', startDate.format('YYYY-MM-DD'));
            $('#cs-reportrange').attr('data-end', endDate.format('YYYY-MM-DD'));
        }
    });

    // service cases aging
    $('#csa-reportrange').daterangepicker({
        forceUpdate: true,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        callback: function (startDate, endDate, period) {
            //  Build Date and add class to daterangepicker
            var title = startDate.format('L') + ' – ' + endDate.format('L');
            $(this).val(title);
            $('#csa-reportrange').attr('data-start', startDate.format('YYYY-MM-DD'));
            $('#csa-reportrange').attr('data-end', endDate.format('YYYY-MM-DD'));
        }
    });

    //case 
//    function cr(start, end) {
//        $('#cr-reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
//        $('#cr-reportrange').attr('data-start', start.format('YYYY-MM-D'));
//        $('#cr-reportrange').attr('data-end', end.format('YYYY-MM-D'));
//    }
//
//    $('#cr-reportrange').daterangepicker({
//        startDate: start,
//        endDate: end,
//        ranges: {
//            'Today': [moment(), moment()],
//            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
//            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
//            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
//            'This Month': [moment().startOf('month'), moment().endOf('month')],
//            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
//        }
//    }, cr);
//    cr(start, end);

    // End Initialized Date range picker 
}

function clusteredColumnChart(aData, name, tab, date) {


    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end


    // Create chart instance
    switch (parseInt(tab)) {
        case 1:
            var chart = am4core.create("vr-chartdiv", am4charts.XYChart);
            break;
        case 2:
            var chart = am4core.create("cr-chartdiv", am4charts.XYChart);
            break;
        case 3:
            var chart = am4core.create("cvr-chartdiv", am4charts.XYChart);
            break;
        case 4:
            var chart = am4core.create("rmr-chartdiv", am4charts.XYChart);
            break;
        default:
    }


    // Add data
    chart.data = [{
            "year": "2003",
            "europe": 2.5,
            "namerica": 2.5,
            "asia": 2.1,
            "lamerica": 1.2,
            "meast": 0.2,
            "africa": 0.1
        }, {
            "year": "2004",
            "europe": 2.6,
            "namerica": 2.7,
            "asia": 2.2,
            "lamerica": 1.3,
            "meast": 0.3,
            "africa": 0.1
        }, {
            "year": "2005",
            "europe": 2.8,
            "namerica": 2.9,
            "asia": 2.4,
            "lamerica": 1.4,
            "meast": 0.3,
            "africa": 0.1
        }];

    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "year";
    categoryAxis.title.text = "Local country offices";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 20;
    categoryAxis.renderer.cellStartLocation = 0.1;
    categoryAxis.renderer.cellEndLocation = 0.9;

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.min = 0;
    valueAxis.title.text = "Expenditure (M)";

    // Create series
    function createSeries(field, name, stacked) {
        var series = chart.series.push(new am4charts.ColumnSeries());
        series.dataFields.valueY = field;
        series.dataFields.categoryX = "year";
        series.name = name;
        series.columns.template.tooltipText = "{name}: [bold]{valueY}[/]";
        series.stacked = stacked;
        series.columns.template.width = am4core.percent(95);
    }

    createSeries("europe", "Europe", false);
    createSeries("namerica", "North America", true);
    createSeries("asia", "Asia", false);
    createSeries("lamerica", "Latin America", true);
    createSeries("meast", "Middle East", true);
    createSeries("africa", "Africa", true);

    // Add legend
    chart.legend = new am4charts.Legend();
}

function getAgencyType() {
    $.post(sAjaxAgencies, {
        type: "getAgencyTypes"
    }, function (rs) {
        l = "<option value='0' selected> All Agencies </option>";
        $.each(rs.data, function (key, val) {
            l += "<option value='" + val.agency_id + "'>" + val.agency_name + " (" + val.agency_abbr + ")" + " </option>";
        });
        $('.sel_agency').html(l);

    }, 'json');
}

$(document).ready(function () {

    getAllGlobalParameter();
    iniDateRangePicker();
    getAgencyType();

    /*
     * Generate Report Buttons 
     */

    // Button generate report victim
    $('#btn-generate_report_victim').click(function () {
        jQuery.noConflict();
        var br_primary = $('#brv-primary').val();
        if (br_primary == null) {
            $('#brv-primary-error').show();
            $('html, body').animate({scrollTop: 0}, '300');
            icmsMessage({
                type: 'msgWarning',
                body: 'Please choose data category'
            });
        } else {
            $('#brv-primary-error').hide();
            generateVictimReport();
        }
    });

    // hide error message
    $('#brv-primary').change(function () {
        $('#brv-primary-error').hide();
    });

    // Button generate case victim details 
    $('#btn-generate_report_casevictim').click(function () {
        jQuery.noConflict();
        var br_primary = $('#brcv-primary').val();
        if (br_primary == null) {
            $('#brcv-primary-error').show();
            $('html, body').animate({scrollTop: 0}, '300');
            icmsMessage({
                type: 'msgWarning',
                body: 'Please choose data category'
            });
        } else {
            $('#brcv-primary-error').hide();
            generateCaseVictimReport();
        }
    });

    // hide error message
    $('#brcv-primary').change(function () {
        $('#brcv-primary-error').hide();
    });

    // Button generate alleged offender
    $('#btn-generate_report_caserespondents').click(function () {
        jQuery.noConflict();
        var br_primary = $('#brcra-primary').val();
        if (br_primary == null) {
            $('#brcra-primary-error').show();
            $('html, body').animate({scrollTop: 0}, '300');
            icmsMessage({
                type: 'msgWarning',
                body: 'Please choose data category'
            });
        } else {
            $('#brcra-primary-error').hide();
            generateCaseVictimAllegedReport();
        }
    });

    // hide error message
    $('#brcra-primary').change(function () {
        $('#brcra-primary-error').hide();
    });

    // Button generate services
    $('#btn-generate_report_caseservices').click(function () {
        jQuery.noConflict();
        var br_primary = $('#brcs-primary').val();
        if (br_primary == null) {
            $('#brcs-primary-error').show();
            $('html, body').animate({scrollTop: 0}, '300');
            icmsMessage({
                type: 'msgWarning',
                body: 'Please choose data category'
            });
        } else {
            $('#brcs-primary-error').hide();
            generateCaseServicesReport();
        }
    });

    // hide error message
    $('#brcs-primary').change(function () {
        $('#brcs-primary-error').hide();
    });


    // Button generate services aging 
    $('#btn-generate_report_caseservicesaging').click(function () {
        jQuery.noConflict();
        var br_primary = $('#brcs-primary').val();
        if (br_primary == null) {
            $('#brcsa-primary-error').show();
            $('html, body').animate({scrollTop: 0}, '300');
            icmsMessage({
                type: 'msgWarning',
                body: 'Please choose data category'
            });
        } else {
            $('#brcsa-primary-error').hide();
            generateCaseServicesAgingReport();
        }
    });

    // hide error message
    $('#brcsa-primary').change(function () {
        $('#brcsa-primary-error').hide();
    });

    // Button generate case  details 
    $('#btn-generate_report_case').click(function () {
        jQuery.noConflict();
        var br_primary = $('#brc-primary').val();
        if (br_primary == null) {
            $('#brc-primary-error').show();
            $('html, body').animate({scrollTop: 0}, '300');
            icmsMessage({
                type: 'msgWarning',
                body: 'Please choose data category'
            });
        } else {
            $('#brc-primary-error').hide();
            generateCaseReport();
        }
    });

    // hide error message
    $('#brc-primary').change(function () {
        $('#brc-primary-error').hide();
    });


    // Button generate report minor
    $('#btn-generate_report_minor').click(function () {
        jQuery.noConflict();
        var br_primary = $('#brrm-primary').val();
        if (br_primary == null) {
            $('#brrm-primary-error').show();
            $('html, body').animate({scrollTop: 0}, '300');
            icmsMessage({
                type: 'msgWarning',
                body: 'Please choose data category'
            });
        } else {
            $('#brrm-primary-error').hide();
            generateCaseVictimMinorReport();
        }
    });

    // hide error message
    $('#brrm-primary').change(function () {
        $('#brrm-primary-error').hide();
    });

    /*
     * Check box 
     */

    // Check All Option Victim Tab 
    $('#collapseVictimFilter').delegate('.vr-opt-check_all', 'click', function () {
        name = $(this).attr('id');
        if ($(this).is(":checked")) {
            $('.' + name).prop("checked", true);
        } else {
            $('.' + name).prop("checked", false);
        }
    });

    // Check Option Victim Tab
    $('#collapseVictimFilter').delegate('.be-vr-opt', 'change', function () {
        name = $(this).attr('name');
        if ($(this).is(":checked")) {
            var isAllChecked = 0;
            $('.' + name).each(function () {
                if (!this.checked)
                    isAllChecked = 1;
            });
            if (isAllChecked === 0) {
                $("#" + name).prop("checked", true);
            }
        } else {
            $("#" + name).prop("checked", false);
        }
    });

    // Check All Option Case Tab 
    $('#collapseCaseFilter').delegate('.cr-opt-check_all', 'click', function () {
        name = $(this).attr('id');
        if ($(this).is(":checked")) {
            $('.' + name).prop("checked", true);
        } else {
            $('.' + name).prop("checked", false);
        }
    });

    // Check Option Case Tab
    $('#collapseCaseFilter').delegate('.be-cr-opt', 'change', function () {
        name = $(this).attr('name');
        if ($(this).is(":checked")) {
            var isAllChecked = 0;
            $('.' + name).each(function () {
                if (!this.checked)
                    isAllChecked = 1;
            });
            if (isAllChecked === 0) {
                $("#" + name).prop("checked", true);
            }
        } else {
            $("#" + name).prop("checked", false);
        }
    });

    // Check All Option Victim Tab 
    $('#collapseCaseVictimFilter').delegate('.cv-opt-check_all', 'click', function () {
        name = $(this).attr('id');
        if ($(this).is(":checked")) {
            $('.' + name).prop("checked", true);
        } else {
            $('.' + name).prop("checked", false);
        }
    });

    // Check Option Victim Tab
    $('#collapseCaseVictimFilter').delegate('.be-cv-opt', 'change', function () {
        name = $(this).attr('name');
        if ($(this).is(":checked")) {
            var isAllChecked = 0;
            $('.' + name).each(function () {
                if (!this.checked)
                    isAllChecked = 1;
            });
            if (isAllChecked === 0) {
                $("#" + name).prop("checked", true);
            }
        } else {
            $("#" + name).prop("checked", false);
        }
    });

    // Check All Option Report Minor Tab 
    $('#collapseReportMinorFilter').delegate('.rm-opt-check_all', 'click', function () {
        name = $(this).attr('id');
        if ($(this).is(":checked")) {
            $('.' + name).prop("checked", true);
        } else {
            $('.' + name).prop("checked", false);
        }
    });

    // Check Option Report Minor Tab
    $('#collapseReportMinorFilter').delegate('.be-rm-opt', 'change', function () {
        name = $(this).attr('name');
        if ($(this).is(":checked")) {
            var isAllChecked = 0;
            $('.' + name).each(function () {
                if (!this.checked)
                    isAllChecked = 1;
            });
            if (isAllChecked === 0) {
                $("#" + name).prop("checked", true);
            }
        } else {
            $("#" + name).prop("checked", false);
        }
    });

    /*
     * Date picker 
     */

    $('.daterangepicker-field').attr('data-report-type', 1);

    $('body').delegate('.daterangepicker.opened .period', 'click', function () {
        var sReportTypeName = $('.daterangepicker.opened .period.active').html();
        getReportTypeValue(sReportTypeName, sPeriod);
    });

    // victim 
    $('#vr-reportrange').click(function () {
        sPeriod = 'vr';
    });

    // report  
    $('#cvr-reportrange').click(function () {
        sPeriod = 'cvr';
    });

    // report minor 
    $('#rm-reportrange').click(function () {
        sPeriod = 'rm';
    });

    // offender 
    $('#cra-reportrange').click(function () {
        sPeriod = 'cra';
    });

    // Aging
    $('#csa-reportrange').click(function () {
        sPeriod = 'csa';
    });

    // service
    $('#cs-reportrange').click(function () {
        sPeriod = 'cs';
    });


    // for agency
    $('.sel_agency').change(function () {
        var agencytypeid = $(this).val();
        var kcode = $(this).attr('data-key');
        if (agencytypeid == 0) {
            $('.c-' + kcode + '-agency_branch').hide();
        } else {
            getAgencyBranchByAgencyTypeID(agencytypeid, kcode);
        }

    });

    // Print 
    $('.export_print_report').click(function () {
        var tab = $(this).attr('data-tab');
        // collapse show 
        $('#' + tab + " .collapse").addClass("show");
        // print 
        setTimeout(function () {
            confirmPassword({
                onSubmit: function () {
                    printGraphAndTabular(tab);
                }
            });
        }, 500);
    });

    // Export excel tabular 
    $('.export_download_report').click(function () {
        var tab = $(this).attr('data-tab');
        confirmPassword({
            onSubmit: function () {
                downloadTabular(tab);
            }
        });
    });


    // view more 
//    $('#cst-body').delegate('.view_more', 'click', function () {
//        var check = $(this).attr("aria-expanded");
//        var l = "";
//        if (check == "true") {
//            l = `<i class="fa fa-arrow-left" aria-hidden="true"></i>`;
//        } else {
//            l = `<i class="fa fa-arrow-down" aria-hidden="true"></i>`;
//        }
//        $(this).html(l);
//    });


});

function getAgencyBranchByAgencyTypeID(agencytypeid, kcode) {
    $.post(sAjaxAgencies, {
        type: "getAgencyBranchByAgencyTypeID",
        agencytypeid: agencytypeid
    }, function (rs) {
        l = "<option value='0' selected>All Branch</option>";
        if (rs.data.result == "1") {
            $.each(rs.data.branches, function (key, val) {
                l += "<option value='" + val.agency_branch_id + "'>" + val.agency_branch_name + " </option>";
            });
            // show branch
            $('.c-' + kcode + '-agency_branch').show();
        } else {
            // hide branch
            $('.c-' + kcode + '-agency_branch').hide();
        }
        $('#' + kcode + '-agency_branch').html(l);
    }, 'json');
}

function variableHeight3PieChart(aData, name, tab) {

    // Create chart instance
    switch (parseInt(tab)) {
        case 1:
            var chart = am4core.create("vr-chartdiv", am4charts.PieChart3D);
            break;
        case 2:
            var chart = am4core.create("cr-chartdiv", am4charts.PieChart3D);
            break;
        case 3:
            var chart = am4core.create("cvr-chartdiv", am4charts.PieChart3D);
            break;
        case 4:
            var chart = am4core.create("rmr-chartdiv", am4charts.PieChart3D);
            break;
        case 5:
            var chart = am4core.create("cra-chartdiv", am4charts.PieChart3D);
            break;
        case 6:
            var chart = am4core.create("cs-chartdiv", am4charts.PieChart3D);
            break;
        default:
    }

    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

    chart.data = aData;

    chart.innerRadius = am4core.percent(40);
    chart.depth = 120;

    chart.legend = new am4charts.Legend();

    var series = chart.series.push(new am4charts.PieSeries3D());
    series.dataFields.value = "count";
    series.dataFields.depthValue = "count";
    series.dataFields.category = "variable";
    series.slices.template.cornerRadius = 5;
    series.colors.step = 3;

    // Chart responsive 
    chart.responsive.enabled = true;

    // Enable export
    chart.exporting.menu = new am4core.ExportMenu();

    chart.exporting.menu.align = "right";
    chart.exporting.menu.verticalAlign = "bottom";
    chart.exporting.menu.items = [
        {
            "label": "Download Graph",
            "menu": [
                {
                    "label": "Image",
                    "menu": [
                        {"type": "png", "label": "PNG"},
                        {"type": "jpg", "label": "JPG"},
//                        {"type": "gif", "label": "GIF"},
//                        {"type": "svg", "label": "SVG"},
                        {"type": "pdf", "label": "PDF"}
                    ]
                },
//                {
//                    "label": "Data",
//                    "menu": [
//                        {"type": "json", "label": "JSON"},
//                        {"type": "csv", "label": "CSV"},
//                        {"type": "xlsx", "label": "XLSX"}
//                    ]
//                }, 
                {
                    "label": "Print", "type": "print"
                }
            ]
        }
    ];

}

function variableRadiusPieChart(aData, name, tab) {

    // Create chart instance
    switch (parseInt(tab)) {
        case 1:
            var chart = am4core.create("vr-chartdiv", am4charts.PieChart);
            break;
        case 2:
            var chart = am4core.create("cr-chartdiv", am4charts.PieChart);
            break;
        case 3:
            var chart = am4core.create("cvr-chartdiv", am4charts.PieChart);
            break;
        case 4:
            var chart = am4core.create("rmr-chartdiv", am4charts.PieChart);
            break;
        case 5:
            var chart = am4core.create("cra-chartdiv", am4charts.PieChart);
            break;
        case 6:
            var chart = am4core.create("cs-chartdiv", am4charts.PieChart);
            break;
        default:
    }

    chart.hiddenState.properties.opacity = 0;

    // Add data
    chart.data = aData;

    var series = chart.series.push(new am4charts.PieSeries());
    series.dataFields.value = "count";
    series.dataFields.radiusValue = "count";
    series.dataFields.category = "variable";
    series.slices.template.cornerRadius = 6;
    series.colors.step = 3;

    series.hiddenState.properties.endAngle = -90;

    chart.legend = new am4charts.Legend();

    // Chart responsive 
    chart.responsive.enabled = true;

    // Enable export
    chart.exporting.menu = new am4core.ExportMenu();

    chart.exporting.menu.align = "right";
    chart.exporting.menu.verticalAlign = "bottom";
    chart.exporting.menu.items = [
        {
            "label": "Download Graph",
            "menu": [
                {
                    "label": "Image",
                    "menu": [
                        {"type": "png", "label": "PNG"},
                        {"type": "jpg", "label": "JPG"},
//                        {"type": "gif", "label": "GIF"},
//                        {"type": "svg", "label": "SVG"},
                        {"type": "pdf", "label": "PDF"}
                    ]
                },
//                {
//                    "label": "Data",
//                    "menu": [
//                        {"type": "json", "label": "JSON"},
//                        {"type": "csv", "label": "CSV"},
//                        {"type": "xlsx", "label": "XLSX"}
//                    ]
//                }, 
                {
                    "label": "Print", "type": "print"
                }
            ]
        }
    ];

}

function reverseValueAxis(aData, name, tab) {

    // Create chart instance
    switch (parseInt(tab)) {
        case 1:
            var chart = am4core.create("vr-chartdiv", am4charts.XYChart);
            break;
        case 2:
            var chart = am4core.create("cr-chartdiv", am4charts.XYChart);
            break;
        case 3:
            var chart = am4core.create("cvr-chartdiv", am4charts.XYChart);
            break;
        case 4:
            var chart = am4core.create("rmr-chartdiv", am4charts.XYChart);
            break;
        case 5:
            var chart = am4core.create("cra-chartdiv", am4charts.XYChart);
            break;
        case 6:
            var chart = am4core.create("cs-chartdiv", am4charts.XYChart);
            break;
        default:
    }

    // Add data
    chart.data = aData;

    // Create category axis
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "date";
    categoryAxis.renderer.opposite = true;

    // Create value axis
    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.inversed = true;
    valueAxis.title.text = "Count";
    valueAxis.renderer.minLabelPosition = 0.01;


    var aSeries = [];
    $.each(aData[0], function (key, val) {
        if (key != 'date') {
            // Create series
            aSeries[key] = chart.series.push(new am4charts.LineSeries());
            aSeries[key].dataFields.valueY = key;
            aSeries[key].dataFields.categoryX = "date";
            aSeries[key].name = key;
            aSeries[key].strokeWidth = 3;
            aSeries[key].bullets.push(new am4charts.CircleBullet());
            aSeries[key].tooltipText = "{name} in {categoryX}: {valueY}";
            aSeries[key].legendSettings.valueText = "{valueY}";
            aSeries[key].visible = false;
        }
    });


    // Add chart cursor
    chart.cursor = new am4charts.XYCursor();
    chart.cursor.behavior = "zoomY";

    // Add legend
    chart.legend = new am4charts.Legend();

    // Chart responsive 
    chart.responsive.enabled = true;

    // Enable export
    chart.exporting.menu = new am4core.ExportMenu();

    chart.exporting.menu.align = "right";
    chart.exporting.menu.verticalAlign = "bottom";
    chart.exporting.menu.items = [
        {
            "label": "Download Graph",
            "menu": [
                {
                    "label": "Image",
                    "menu": [
                        {"type": "png", "label": "PNG"},
                        {"type": "jpg", "label": "JPG"},
//                        {"type": "gif", "label": "GIF"},
//                        {"type": "svg", "label": "SVG"},
                        {"type": "pdf", "label": "PDF"}
                    ]
                },
//                {
//                    "label": "Data",
//                    "menu": [
//                        {"type": "json", "label": "JSON"},
//                        {"type": "csv", "label": "CSV"},
//                        {"type": "xlsx", "label": "XLSX"}
//                    ]
//                }, 
                {
                    "label": "Print", "type": "print"
                }
            ]
        }
    ];

}

function printGraphAndTabular(container) {
    var iniContent = $('#' + container).html();
    $('#tabular-content-print').html(iniContent);
    $('#tabular-content-print button').remove();
    $('#tabular-content-print .container_graph').remove();

    var divToPrint = document.getElementById('tabular-content-print');

    setTimeout(function () {
        var newWin = window.open('', 'Print-Window');
//        newWin.document.open();
        var html = divToPrint.innerHTML ;
        var content = '<!DOCTYPE html><html>' + $('head').html() + '<body>' + html + '<script>window.print();</script></body>' + $('footer').html() + '</html>';
        newWin.document.write(content);
//        newWin.document.write('<html> ' + $('head').html() + ' <body onload="window.print()">' + divToPrint.innerHTML + '</body> ' + $('footer').html() + '</html>');
//        newWin.document.close();
//        setTimeout(function () {
//            newWin.close();
//        }, 10);
    }, 500);
}