var sAjaxUrl = window.location.origin;
var sAjaxCase = sAjaxUrl + '/ajax/administrator/Case_ctrl/ajax';
var sAjaxCaseDetails = sAjaxUrl + '/ajax/administrator/Case_details/ajax';
var sAjaxAccess = sAjaxUrl + '/ajax/User_access/ajax';
var sAjaxAgencies = sAjaxUrl + '/ajax/administrator/Agencies/ajax';
var sAjaxGlobalData = sAjaxUrl + '/ajax/administrator/Global_data/ajax';
var sAjaxUsers = sAjaxUrl + '/ajax/administrator/Users/ajax';
var sAjaxSettings = sAjaxUrl + '/ajax/administrator/Settings/ajax';
var sAjaxDashboard = sAjaxUrl + '/ajax/administrator/Dashboard/ajax';
var sAjaxVictims = sAjaxUrl + '/ajax/administrator/Victims/ajax';
var sAjaxAccSettings = sAjaxUrl + '/ajax/administrator/Account_settings/ajax';
var sAjaxRecruitment = sAjaxUrl + '/ajax/administrator/Recruitment/ajax';
var sAjaxEmployer = sAjaxUrl + '/ajax/administrator/Employer/ajax';
var sAjaxReports = sAjaxUrl + '/ajax/administrator/Reports/ajax';
var sAjaxReportDetails = sAjaxUrl + '/ajax/Report_details/ajax';
var sAjaxAssignee = sAjaxUrl + '/ajax/administrator/Assignee/ajax';
var sAjaxValidate = sAjaxUrl + '/ajax/administrator/Validate/ajax';
var sAjaxServiceDetails = sAjaxUrl + '/ajax/administrator/Service_details/ajax';
var sAjaxVictimServices = sAjaxUrl + '/ajax/administrator/Victim_services/ajax';
var sAjaxVictimServicesLog = sAjaxUrl + '/ajax/administrator/Service_logs/ajax';
var sAjaxCriminalCase = sAjaxUrl + '/ajax/administrator/Criminal_case/ajax';
var sAjaxAdministrativeCase = sAjaxUrl + '/ajax/administrator/Administrative_case/ajax';
var sAjaxTemporaryCase = sAjaxUrl + '/ajax/administrator/Temporary_case/ajax';

var aDriveAddress = ["icms.com", "dev.icms.com","icmstech.org"];
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

