
$(document).ready(function () {

    $(".description_overflow").on("click", function () {
        if ($(this).hasClass("text_wrap_normal")) {
            $(this).removeClass("text_wrap_normal");
        } else {
            $(this).addClass("text_wrap_normal");
        }

    });

    getServiceLogsHistory();

    $('.btn-return').on('click', function () {
        window.history.back();
    });
    $('#add-updates').tooltip({boundary: 'window'})
    $('.btn-return').tooltip({boundary: 'window'})
});

function getServiceLogsHistory() {
    var service_id = $("#vsid").attr('datavsid');

    $.post(sAjaxVictimServicesLog, {
        type: "getServicesLogs",
        service_id: service_id
    }, function (rs) {
        var logs = "";
        if (rs.data.result == "1") {
            $.each(rs.data.logs, function (key, val) {

                var dt = val.case_vistim_services_history_date_added.split(" ");
                var dte = dt[0].split("-");

                console.log(dte);
                logs += '<div class="row form-row form-row-services">';
                logs += '   <div class="col-lg-2 col-md-2 col-sm-2">';
                logs += '       <div class="text-center">';
                logs += '           <span class="task-date">' + dte[2] + '</span><br>';
                logs += '           <span class="task-month">' + GetMonthName(parseInt(dte[1])) + ' ' + dte[0] + '</span>';
                logs += '       </div>';
                logs += '   </div>';
                logs += '   <div class="col-lg-10 col-md-10 col-sm-10 ">';
                logs += '       <span class="task-subj">' + val.case_victim_services_history_subject + '</span><br>';
                logs += '       <div class="details-services ">';
                logs += '           <div class="" style="font-size: 14px;">';
                logs += val.case_victim_services_history_remarks;
                logs += '           </div>';
                logs += '       </div>';
                if (val.document_hash !== "" && val.document_hash !== null) {
                    logs += '       <br><span class="">attachment : <a target="_blank" href="' + sDriveViewer + val.document_hash + '">' + val.document_hash + '</a></span><br>';
                }

                logs += '       <div class="subremarks_details mt-2 ">     ';
                logs += '           <span>Remarks by: </span><span>' + val.user.agency_abbr + ' - ' + val.user.agency_branch_name + ' </span><br>';
                logs += '       </div>';
                logs += '   </div>';
                logs += '</div><hr>';
            });


        } else {
            logs += '<div class="row form-row form-row-services">';
            logs += '   <div class="col-lg-12 col-md-12 col-sm-12">';
            logs += '      <br><br> <center> No service log found! </center><br><br>';
            logs += '   </div>';
            logs += '</div>';
            logs += '<hr>';
        }

        $('#log-history-container').html(logs);
    }, 'json');

}