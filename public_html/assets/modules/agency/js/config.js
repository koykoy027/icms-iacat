var sAjaxUrl = window.location.origin;
var sAjaxCase = sAjaxUrl + '/ajax/agency/Case_ctrl/ajax';
var sAjaxAccess = sAjaxUrl + '/ajax/User_access/ajax';
var sAjaxAgencies = sAjaxUrl + '/ajax/agency/Agencies/ajax';
var sAjaxGlobalData = sAjaxUrl + '/ajax/agency/Global_data/ajax';
var sAjaxUsers = sAjaxUrl + '/ajax/agency/Users/ajax';
var sAjaxAdminUsers = sAjaxUrl + '/ajax/administrator/Users/ajax';
var sAjaxSettings = sAjaxUrl + '/ajax/agency/Settings/ajax';
var sAjaxDashboard = sAjaxUrl + '/ajax/agency/Dashboard/ajax';
var sAjaxVictims = sAjaxUrl + '/ajax/agency/Victims/ajax';
var sAjaxAccSettings = sAjaxUrl + '/ajax/agency/Account_settings/ajax';
var sAjaxRecruitment = sAjaxUrl + '/ajax/agency/Recruitment/ajax';
var sAjaxEmployer = sAjaxUrl + '/ajax/agency/Employer/ajax';
var sAjaxReports = sAjaxUrl + '/ajax/agency/Reports/ajax';
var sAjaxVictimServicesLog = sAjaxUrl + '/ajax/agency/Service_logs/ajax';
var sAjaxVictimServices = sAjaxUrl + '/ajax/agency/Victim_services/ajax';
var sAjaxValidate = sAjaxUrl + '/ajax/agency/Validate/ajax';
var sAjaxCaseDetails = sAjaxUrl + '/ajax/agency/Case_details/ajax';
var sAjaxAssignee = sAjaxUrl + '/ajax/agency/Assignee/ajax';
var sAjaxServiceDetails = sAjaxUrl + '/ajax/agency/Service_details/ajax';
var sAjaxCriminalCase = sAjaxUrl + '/ajax/agency/Criminal_case/ajax';
var sAjaxAdministrativeCase = sAjaxUrl + '/ajax/agency/Administrative_case/ajax';


var aDriveAddress = ["icms.com", "dev.icms.com"];
var sDriveAPI = window.location.origin + '/ajax/drive/ajax';
var sDriveViewer = '';
var sBaseURL = '';

$.each(aDriveAddress, function (key, url) {
    if (window.location.origin.indexOf(url) !== -1) {
        sDriveViewer = window.location.protocol + '//' + url + '/drive/file/';
        sDriveViewer = '';
        sBaseURL = url;     
    }
});

var altLogo = sAjaxUrl + "/assets/global/images/logo-default.png";
var altUser = sAjaxUrl + "/assets/global/images/user-default.png";

