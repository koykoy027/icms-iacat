<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Agencies_model extends CI_Model {

    public function getAgencies($aParam) {

        $aResponse = [];

        $sSequelListing = "
                SELECT 
                    `a`.*, 
                    `at`.*,
                    (SELECT `document_hash` FROM `icms_image_upload` WHERE `photo_type_id`='2' AND `panel_id`='1' AND `image_upload_is_active`='1' AND `image_upload_is_primary`='1' AND `user_Id`=`a`.`agency_id`) as `logo`
                    " . $aParam['sRelevance'] . "
                FROM 
                    `icms_agency_branch` `a`,
                    `icms_agency` `at`
                WHERE
                    `at`.`agency_id`=`a`.`agency_id` 
                    " . $aParam['cRelevance'] . "
                    " . $aParam['cOrderBy'] . "  
                LIMIT " . $aParam['start'] . "," . $aParam['limit'] . "
                ";

        $sSequelCount = "
                SELECT 
                    COUNT(1)
                FROM 
                     `icms_agency_branch` `a`,
                    `icms_agency` `at`
                WHERE
                   `at`.`agency_id`=`a`.`agency_id` 
                   " . $aParam['cRelevance'] . "
        ";

//echo($sSequelListing);
        $aResponse['count'] = $this->yel->GetOne($sSequelCount);

        $aResponse['listing'] = $this->yel->GetAll($sSequelListing);

        return $aResponse;
    }

    public function getAgencyTypeList($aParam) {

        $aResponse = [];

        $sSequelListing = "
                SELECT 
                    `igat`.*, 
                    `igp`.`parameter_name` as `govt_agency_type_category_name`,
                    (SELECT `document_hash` FROM `icms_image_upload` WHERE `photo_type_id`='2' AND `panel_id`='1' AND `image_upload_is_active`='1' AND `image_upload_is_primary`='1' AND `user_Id`=`igat`.`agency_id` LIMIT 1) as `photo`
                    " . $aParam['sRelevance'] . "
                FROM 
                    `icms_agency` as `igat` ,
                    `icms_global_parameter` as `igp`
                WHERE 
                    `igat`.`agency_category_id` = `igp`.`parameter_count_id`
                AND 
                    `igp`.`parameter_type_id` = 12
                    " . $aParam['cRelevance'] . "
                    " . $aParam['cOrderBy'] . "
                LIMIT " . $aParam['start'] . "," . $aParam['limit'] . "
                ";

        $sSequelCount = "
                SELECT 
                    COUNT(1)
                FROM 
                    `icms_agency` as `igat` 
                WHERE
                    `igat`.`agency_id` IS NOT NULL
                    " . $aParam['cRelevance'] . "
        ";
//        echo($sSequelListing);
        $aResponse['count'] = $this->yel->GetOne($sSequelCount);
        $aResponse['listing'] = $this->yel->GetAll($sSequelListing);

        return $aResponse;
    }

    public function getAgencyTypes() {
        $sql = "
                  SELECT 
                    * 
                  FROM 
                    `icms_agency` 
                  WHERE
                    `agency_is_active`='1'
                  ORDER BY 
                    `agency_id` ASC
                ";

        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function addGovernmentAgencyContactAddress($aParam) {
        $sql = "
                INSERT INTO 
                    `icms_address_list`
                SET 
                    `address_type_id` ='2',
                    `origin_id` ='" . $aParam['lastInsertId'] . "',
                    `country_id` ='" . $aParam['cont_country_id'] . "',
                    `region_id` ='" . $aParam['cont_region_id'] . "',
                    `province_id` ='" . $aParam['cont_province_id'] . "',
                    `city_id` ='" . $aParam['cont_city_id'] . "',
                    `brgy_id` ='" . $aParam['cont_brgy_id'] . "',
                    `address` ='" . $aParam['cont_detailed_address'] . "',
                    `origin_address_type_id` ='1',
                    `origin_address_type_is_active` ='1'
                ";
        $result = $this->yel->exec($sql);
    }

    public function addGovernmentAgencyAddress($aParam) {
        $sql = "
                   INSERT INTO 
                    `icms_address_list`
                SET 
                    `address_type_id` ='1',
                    `origin_id` ='" . $aParam['lastInsertId'] . "',
                    `country_id` ='" . $aParam['agency_country_id'] . "',
                    `region_id` ='" . $aParam['agency_region_id'] . "',
                    `province_id` ='" . $aParam['agency_province_id'] . "',
                    `city_id` ='" . $aParam['agency_city_id'] . "',
                    `brgy_id` ='" . $aParam['agency_brgy_id'] . "',
                    `address` ='" . $aParam['agency_detailed_address'] . "',
                    `origin_address_type_id` ='1',
                    `origin_address_type_is_active` ='1'
                ";
        $result = $this->yel->exec($sql);
    }

    public function getGovernmentAddressByID($id) {
        $sql = "
                SELECT
                   `al`.*,
                   (SELECT `country_name` FROM `icms_global_country` WHERE `country_id`=`al`.`address_list_country`) as country,
                   (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`al`.`address_list_region` AND `location_type_id`='3') as region,
                   (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`al`.`address_list_province` AND `location_type_id`='4') as province,
                   (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`al`.`address_list_province` AND `location_type_id`='2' AND `location_prerequisite_id`=`al`.`address_list_country`) as state,
                   (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`al`.`address_list_city` AND `location_type_id`='5') as city,
                   (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`al`.`address_list_brgy` AND `location_type_id`='6') as brgy
                FROM 
                    `icms_address_list` `al`
                WHERE
                    `al`.`address_list_origin_id`='" . $id . "'
                AND
                    `al`.`address_list_address_type`='1'
                ";
        $result = $this->yel->GetRow($sql);
        return $result;
    }

    public function getGovernmentContactAddressByID($id) {
        $sql = "
                 SELECT
                   `al`.*,
                   (SELECT `country_name` FROM `icms_global_country` WHERE `country_id`=`al`.`address_list_country`) as country,
                   (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`al`.`address_list_region` AND `location_type_id`='3') as region,
                   (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`al`.`address_list_province` AND `location_type_id`='4') as province,
                   (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`al`.`address_list_province` AND `location_type_id`='2' AND `location_prerequisite_id`=`al`.`address_list_country`) as state,
                   (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`al`.`address_list_city` AND `location_type_id`='5') as city,
                   (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`al`.`address_list_brgy` AND `location_type_id`='6') as brgy
                FROM 
                    `icms_address_list` `al`
                WHERE
                    `al`.`address_list_origin_id`='" . $id . "'
                AND
                    `al`.`address_list_address_type`='2'
                ";

        $result = $this->yel->GetRow($sql);
        return $result;
    }

    //==================
    public function setGovernmentAgency($aParam) {
        $sql = "
                UPDATE
                    `icms_govt_agency`
                SET 
                    `govt_agency_type_id` ='" . $aParam['agency_type'] . "',
                    `govt_agency_email` ='" . $aParam['agency_email'] . "',
                    `govt_agency_telephone_number` ='" . $aParam['agency_telno'] . "',
                    `govt_agency_mobile_number` ='" . $aParam['agency_mobile'] . "',
                    `govt_agency_description` ='" . $aParam['agency_desc'] . "',
                    `govt_agency_contact_person_firstname` ='" . $aParam['cont_fname'] . "',
                    `govt_agency_contact_person_middle_name` ='" . $aParam['cont_mname'] . "',
                    `govt_agency_contact_person_lastname` ='" . $aParam['cont_lname'] . "',
                    `govt_agency_contact_person_mobile_number` ='" . $aParam['cont_mobile'] . "',
                    `govt_agency_contact_person_telephone_number` ='" . $aParam['cont_tel'] . "',
                    `govt_agency_contact_person_email` ='" . $aParam['cont_email'] . "'
                WHERE
                    `govt_agency_id`='" . $aParam['agency_id'] . "'
                ";
        $result = $this->yel->exec($sql);
        return $result;
    }

    public function setGovernmentAgencyContactAddress($aParam) {
        $sql = "
                UPDATE 
                    `icms_address_list`
                SET 
                    `country_id` ='" . $aParam['cont_country_id'] . "',
                    `region_id` ='" . $aParam['cont_region_id'] . "',
                    `province_id` ='" . $aParam['cont_province_id'] . "',
                    `city_id` ='" . $aParam['cont_city_id'] . "',
                    `brgy_id` ='" . $aParam['cont_brgy_id'] . "',
                    `address` ='" . $aParam['cont_detailed_address'] . "'
               WHERE
                    `address_type_id` ='2'
               AND  `origin_id` ='" . $aParam['agency_id'] . "'
                ";
        $result = $this->yel->exec($sql);
        return $result;
    }

    public function setGovernmentAgencyAddress($aParam) {
        $sql = "
                UPDATE
                    `icms_address_list`
                SET 
                    `country_id` ='" . $aParam['agency_country_id'] . "',
                    `region_id` ='" . $aParam['agency_region_id'] . "',
                    `province_id` ='" . $aParam['agency_province_id'] . "',
                    `city_id` ='" . $aParam['agency_city_id'] . "',
                    `brgy_id` ='" . $aParam['agency_brgy_id'] . "',
                    `address` ='" . $aParam['agency_detailed_address'] . "'
               WHERE
                    `address_type_id` ='1'
               AND  `origin_id` ='" . $aParam['agency_id'] . "'
                ";
        $result = $this->yel->exec($sql);
        return $result;
    }

    public function addAgencyType($aParam) {

        $sql = "
                   INSERT INTO 
                    `icms_agency`
                SET 
                    `agency_category_id` ='" . $aParam['category'] . "',
                    `agency_name` ='" . $aParam['agencyname'] . "',
                    `agency_abbr` ='" . $aParam['abbr'] . "',
                    `agency_description` ='" . $aParam['description'] . "'
                ";
        $result = $this->yel->exec($sql);
        return $result['insert_id'];
    }

    public function addAgencyTypeLogo($aParam) {
        $sql = "
                UPDATE
                    `icms_image_upload`
                SET 
                    `image_upload_is_primary`='0'
                WHERE
                    `photo_type_id` ='2'
                AND `panel_id` ='1'
                AND `user_Id` ='" . $aParam['userid'] . "'
                ";
        $this->yel->exec($sql);


        $sql = "
                INSERT INTO 
                    `icms_image_upload`
                SET 
                    `photo_type_id` ='2',
                    `panel_id` ='1',
                    `user_Id` ='" . $aParam['userid'] . "',
                    `document_hash` ='" . $aParam['hash'] . "'
                ";
        $result = $this->yel->exec($sql);

        return $result;
    }

    public function getAgencyBranchAdminIfExist($aParam) {
        $sql = "
                SELECT 
                    COUNT(1)                    
                FROM 
                    `icms_agency_branch`
                WHERE
                    `agency_id`='" . $aParam['agntype'] . "'
                AND `agency_branch_is_main`='1'";
        $result = $this->yel->GetOne($sql);
        return $result;
    }

    public function addAgencyBranch_govt_agency($aParam) {
        $sql = "
                INSERT INTO 
                    `icms_agency_branch`
                SET 
                    `agency_branch_name` ='" . $aParam['branchname'] . "',
                    `agency_id` ='" . $aParam['agntype'] . "',
                    `agency_branch_email` ='" . $aParam['agnemail'] . "',
                    `agency_branch_telephone_number` ='" . $aParam['agntel'] . "',
                    `agency_branch_mobile_number` ='" . $aParam['agnmobile'] . "',
                    `agency_branch_is_main`='" . $aParam['isbranchadmin'] . "'
                ";

        $result = $this->yel->exec($sql);
        return $result['insert_id'];
    }

    public function addAgencyBranch_govt_contact($aParam) {

        $sql = "
                INSERT INTO 
                    `icms_agency_contact`
                SET 
                    `agency_branch_id` ='" . $aParam['agency_id'] . "',
                    `agency_contact_firstname` ='" . $aParam['fname'] . "',
                    `agency_contact_middle_name` ='" . $aParam['mname'] . "',
                    `agency_contact_lastname` ='" . $aParam['lname'] . "',
                    `agency_contact_mobile_number` ='" . $aParam['mob'] . "',
                    `agency_contact_telephone_number` ='" . $aParam['tel'] . "',
                    `agency_contact_is_primary` ='" . $aParam['is_primary'] . "',
                    `agency_contact_email` ='" . $aParam['email'] . "'
                ";
        $result = $this->yel->exec($sql);
        return $result['insert_id'];
    }

    public function addAgencyBranch_address($aParam) {
        $sql = "
                INSERT INTO 
                    `icms_address_list`
                SET 
                    `address_list_address_type` ='1',
                    `address_list_origin_id` ='" . $aParam['agency_id'] . "',
                    `address_list_country` ='" . $aParam['agncountry'] . "',
                    `address_list_region` ='" . $aParam['agnregion'] . "',
                    `address_list_province` ='" . $aParam['agnprov'] . "',
                    `address_list_city` ='" . $aParam['agncity'] . "',
                    `address_list_brgy` ='" . $aParam['agnbrgy'] . "',
                    `address_list_address` ='" . $aParam['agnadd'] . "',
                    `address_list_origin_address` ='1'
                ";
        $result = $this->yel->exec($sql);
        return $result;
    }

    public function addAgencyBranch_contactaddress($aParam) {

        $sql = "
                INSERT INTO 
                    `icms_address_list`
                SET 
                    `address_list_address_type` ='2',
                    `address_list_origin_id` ='" . $aParam['agency_contact_id'] . "',
                    `address_list_country` ='" . $aParam['country'] . "',
                    `address_list_region` ='" . $aParam['region'] . "',
                    `address_list_province` ='" . $aParam['pro_state'] . "',
                    `address_list_city` ='" . $aParam['city'] . "',
                    `address_list_brgy` ='" . $aParam['brgy'] . "',
                    `address_list_address` ='" . $aParam['fadd'] . "',
                    `address_list_origin_address` ='1'
                ";

        $result = $this->yel->exec($sql);
        return $result;
    }

    public function getAgencyAdminExist($aParam) {
        $sql = "
            SELECT 
                COUNT(1)
            FROM
                `icms_user`
            WHERE
                `agency_branch_id`='" . $aParam['agencyid'] . "'
            AND `user_level_id`='1'
            ";
        $result = $this->yel->GetOne($sql);
        return $result;
    }

    public function getUserLevel($aParam) {
        $sql = "
            SELECT 
               `transaction_parameter_count_id`,
               `transaction_parameter_name`
            FROM
                `icms_transaction_parameter`
            WHERE
                 " . $aParam['cond'];
        $result = $this->yel->GetAll($sql);
        return $result;
    }

    public function getAgencyInformationbyId($aParam) {

        $sql = "
            SELECT 
                `iga`.`agency_branch_id`, 
                `iga`.`agency_branch_name`, 
                `iga`.`agency_branch_email`, 
                `iga`.`agency_branch_telephone_number`, 
                `iga`.`agency_branch_mobile_number`, 
                `iga`.`agency_branch_description`,
                `iga`.`agency_branch_is_main`,
                `igat`.`agency_name`,
                `igat`.`agency_abbr`,
                `iga`.`agency_branch_is_active`,
                (SELECT `document_hash` FROM `icms_image_upload` WHERE `photo_type_id`='2' AND `panel_id`='1' AND `image_upload_is_active`='1' AND `image_upload_is_primary`='1' AND `user_Id`=`igat`.`agency_id`) as `logo`
            
            FROM
                `icms_agency_branch`  as `iga`, 
                `icms_agency` as `igat` 
            WHERE
                `iga`.`agency_branch_id` = " . $aParam['agency_id'] . " AND 
                `iga`.`agency_id` =  `igat`.`agency_id` 
        ";

        $result = $this->yel->GetRow($sql);

        return $result;
    }

    public function getGovernmentContactPersonbyAgencyID($aParam) {

        $sql = "
            SELECT 
                `igac`.`agency_contact_firstname`, 
                `igac`.`agency_contact_middle_name`, 
                `igac`.`agency_contact_lastname`, 
                `igac`.`agency_contact_mobile_number`, 
                `igac`.`agency_contact_telephone_number`, 
                `igac`.`agency_contact_email`,
                (SELECT `country_name` FROM `icms_global_country`  WHERE `country_id` = `ial`.`address_list_country` LIMIT 1  ) as `country_name`, 
                (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`ial`.`address_list_region` AND `location_type_id`='3') as region,
                (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`ial`.`address_list_province` AND `location_type_id`='4') as province,
                (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`ial`.`address_list_province` AND `location_type_id`='2' AND `location_prerequisite_id`=`ial`.`address_list_country`) as state,
                (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`ial`.`address_list_city` AND `location_type_id`='5') as city,
                (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`ial`.`address_list_brgy` AND `location_type_id`='6') as brgy,
                `ial`.`address_list_address`
            FROM
                `icms_agency_contact`  as `igac`, 
                `icms_address_list` as `ial`
            WHERE
                `igac`.`agency_branch_id` = '" . $aParam['agency_id'] . "' 
            AND `igac`.`agency_contact_is_active` = 1 
            AND `ial`.`address_list_address_type` = 2 
            AND `ial`.`address_list_origin_id` = `igac`.`agency_contact_id`
        ";
        $result = $this->yel->GetAll($sql);

        return $result;
    }

    public function getAgencyTypeById($aParam) {
        $sql = "SELECT * FROM `icms_agency` WHERE  `agency_id`  = '" . $aParam['id'] . "'";
        $result = $this->yel->GetRow($sql);
        return $result;
    }

    public function setAgencyType($aParam) {

        $sql = "
                UPDATE `icms_agency` SET
                    `agency_category_id` ='" . $aParam['category'] . "',
                    `agency_name` ='" . $aParam['agencyname'] . "',
                    `agency_abbr` ='" . $aParam['abbr'] . "',
                    `agency_description` = '" . $aParam['description'] . "', 
                    `agency_is_active` = " . $aParam['status'] . "
                WHERE 
                    `agency_id`  = " . $aParam['id'] . "
                ";
        $result = $this->yel->exec($sql);
        return $result;
    }

    public function setAgencyBranchStatusAndItsUsers($aParam) {
        $aResult = [];
        $sql_branch = "
                UPDATE `icms_agency_branch` SET
                    `agency_branch_is_active` ='" . $aParam['newStat'] . "'
                WHERE 
                    `agency_branch_id`  = '" . $aParam['agency_id'] . "'
                ";
        $aResult['brn'] = $this->yel->exec($sql_branch);

        $sql_user = "
                UPDATE `icms_user` SET
                    `agency_branch_is_active` ='" . $aParam['newStat'] . "'
                WHERE 
                    `agency_branch_id`  = '" . $aParam['agency_id'] . "'
                AND ('agency_branch_id' != '1' AND `user_level_id` != '1' AND `user_id` !='1')
                ";
        $aResult['usr'] = $this->yel->exec($sql_user);
        return $aResult;
    }

    public function getAgencyBranchIdByAgency($aParam) {
        $sql = "
                SELECT 
                    `agency_branch_id`
                FROM
                    `icms_agency_branch`
                WHERE
                    `agency_id`='" . $aParam['id'] . "'
            ";
        $aResult = $this->yel->GetAll($sql);
        return $aResult;
    }

    public function setAllAgencyBranchAndAllUsersByBranchId($aParam) {
        $sql = "
                UPDATE `icms_agency_branch` SET
                    `agency_is_active` ='" . $aParam['status'] . "'
                WHERE 
                    `agency_branch_id` IN (" . $aParam['filterid'] . ")
                ";
        $aResult = $this->yel->exec($sql);

        $qry = "
                UPDATE `icms_user` SET
                    `agency_branch_is_active` ='" . $aParam['status'] . "',
                    `agency_is_active` ='" . $aParam['status'] . "'
                WHERE 
                    `agency_branch_id` IN (" . $aParam['filterid'] . ")
                AND ('agency_branch_id' != '1' AND `user_level_id` != '1' AND `user_id` !='1')       
                ";
        $aResult = $this->yel->exec($qry);

        return $aResult;
    }

    public function addAgencyServicesOffered($aParam) {
        $sql = "
                INSERT INTO 
                `icms_agency_services_offered`
                    (`services_id`, `agency_branch_id`) 
                VALUES (" . $aParam['service_id'] . "," . $aParam['agency_id'] . ")
            ";
        $aResponse = $this->yel->exec($sql);
        return $aResponse;
    }

    public function getAgencyServicesOfferedByAgencyBranchID($id) {
        $sql = "
                SELECT 
                    `aso`.* 
                FROM 
                    `icms_agency_services_offered`  `aso`,
                    `icms_services` `s`
                WHERE 
                    `aso`.`agency_branch_id` ='" . $id . "' 
                AND `aso`.`agency_services_offered_is_active`='1' 
                AND `aso`.`services_id` = `s`.`services_id`
                ORDER BY 
                    `s`.`service_type_id`
            ";
        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function getAgencyContactByAgencyBranchID($id) {
        $sql = "
               SELECT * FROM `icms_agency_contact` WHERE `agency_branch_id` ='" . $id . "' AND `agency_contact_is_active` = '1'
            ";
        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function setAgencyAddress($aParam) {
        $sql = "
               UPDATE `icms_address_list` 
               SET
               `address_list_country`='" . $aParam['country'] . "',
               `address_list_region`='" . $aParam['region'] . "',
               `address_list_province`='" . $aParam['prov'] . "',
               `address_list_city`='" . $aParam['city'] . "',
               `address_list_brgy`='" . $aParam['brgy'] . "',
               `address_list_address`='" . $aParam['detailed'] . "'
               WHERE `address_list_id` ='" . $aParam['addressid'] . "'
            ";
        $aResponse = $this->yel->exec($sql);
        return $aResponse;
    }
     public function addNewAgencyAddress($aParam) {
        $sql = "
                INSERT INTO 
                    `icms_address_list` 
                SET
                    `address_list_address_type`='1',
                    `address_list_origin_id`='".$aParam['agency_id']."',
                    `address_list_country`='" . $aParam['country'] . "',
                    `address_list_region`='" . $aParam['region'] . "',
                    `address_list_province`='" . $aParam['prov'] . "',
                    `address_list_city`='" . $aParam['city'] . "',
                    `address_list_brgy`='" . $aParam['brgy'] . "',
                    `address_list_address`='" . $aParam['detailed'] . "'
            ";
        $aResponse = $this->yel->exec($sql);
        return $aResponse;
    }

    public function getEmailValidation($aParam) {
        $sql = "SELECT 
                `agency_branch_id`
               FROM 
                `icms_agency_branch`
               WHERE
                `agency_branch_email`='" . $aParam['txt_email'] . "'
                    limit 1
              ";

        $aResponse = $this->yel->GetOne($sql);
        return $aResponse;
    }

    public function setAgencyDetails($aParam) {
        $sql = "
               UPDATE `icms_agency_branch` 
               SET
               `agency_branch_name`='" . $aParam['branch_name'] . "',
               `agency_branch_email`='" . $aParam['txt_email'] . "',
               `agency_branch_telephone_number`='" . $aParam['txt_tel'] . "',
               `agency_branch_mobile_number`='" . $aParam['txt_mobile'] . "',
               `agency_branch_is_active`='" . $aParam['agency_branch_is_active'] . "'
               WHERE `agency_branch_id` ='" . $aParam['agn_branch_id'] . "'
            ";
        $aResponse = $this->yel->exec($sql);
        return $aResponse;
    }

    public function disabledServicesById($aParam) {
        $sql = "
               UPDATE `icms_agency_services_offered` 
               SET
               `agency_services_offered_is_active`='0'
               WHERE `agency_branch_id` ='" . $aParam['agn_branch_id'] . "'
            ";
        $aResponse = $this->yel->exec($sql);
        return $aResponse;
    }

    public function getServiceIfDisabled($service, $agnID) {
        $sql = "SELECT COUNT(1) FROM `icms_agency_services_offered` WHERE `services_id` = '" . $service . "' AND `agency_branch_id` = '" . $agnID . "'";
        $aResponse = $this->yel->GetOne($sql);
        return $aResponse;
    }

    public function setServiceEnabled($service, $agnID) {
        $sql = "UPDATE `icms_agency_services_offered` SET `agency_services_offered_is_active`='1' WHERE `services_id` = '" . $service . "' AND `agency_branch_id` = '" . $agnID . "'";
        $aResponse = $this->yel->GetOne($sql);
        return $aResponse;
    }

    public function addAgencyBrancgService($service, $agnID) {
        $sql = "INSERT INTO  `icms_agency_services_offered` SET `agency_services_offered_is_active`='1',`services_id` = '" . $service . "', `agency_branch_id` = '" . $agnID . "'";
        $aResponse = $this->yel->exec($sql);
        return $aResponse;
    }

    public function setAgencyContactDeleted($aParam) {
        $sql = "UPDATE `icms_agency_contact` SET `agency_contact_is_active`='0' WHERE `agency_contact_id` = '" . $aParam['id'] . "'";
        $aResponse = $this->yel->exec($sql);
        return $aResponse;
    }

    public function addNewAgencyContactDetails($aParam) {
        $sql = "INSERT INTO  `icms_agency_contact` 
                    SET 
                    `agency_branch_id`='" . $aParam['agencyid'] . "',
                    `agency_contact_firstname` ='" . $aParam['fname'] . "',
                    `agency_contact_middle_name` ='" . $aParam['mname'] . "',
                    `agency_contact_lastname` ='" . $aParam['lname'] . "',
                    `agency_contact_mobile_number` ='" . $aParam['mob'] . "',
                    `agency_contact_telephone_number` ='" . $aParam['tel'] . "',
                    `agency_contact_email` ='" . $aParam['email'] . "',
                    `agency_contact_is_primary` ='" . $aParam['is_primary'] . "'
                    ";
        $aResponse = $this->yel->exec($sql);
        return $aResponse['insert_id'];
    }

    public function setAgencyContactDetails($aParam) {
        $sql = "UPDATE  `icms_agency_contact` 
                    SET 
                    `agency_contact_firstname` ='" . $aParam['fname'] . "',
                    `agency_contact_middle_name` ='" . $aParam['mname'] . "',
                    `agency_contact_lastname` ='" . $aParam['lname'] . "',
                    `agency_contact_mobile_number` ='" . $aParam['mob'] . "',
                    `agency_contact_telephone_number` ='" . $aParam['tel'] . "',
                    `agency_contact_email` ='" . $aParam['email'] . "',
                    `agency_contact_is_primary` ='" . $aParam['is_primary'] . "'
                    WHERE `agency_contact_id`='" . $aParam['contactid'] . "'
                    ";
        $aResponse = $this->yel->exec($sql);
        return $aResponse['insert_id'];
    }

    public function getAgencyContactDetails($aParam) {
        $sql = "SELECT
                    `agency_branch_id`,
                    `agency_contact_firstname`,
                    `agency_contact_middle_name`,
                    `agency_contact_lastname`,
                    `agency_contact_mobile_number`,
                    `agency_contact_telephone_number`,
                    `agency_contact_email`,
                    CASE WHEN `agency_contact_is_primary`='1' THEN 'Primary' ELSE 'Secondary' END AS contact_type
                FROM 
                    `icms_agency_contact` 
                WHERE `agency_contact_id`='" . $aParam['contactid'] . "'
                    ";
        $aResponse = $this->yel->GetROw($sql);
        return $aResponse;
    }

    public function addNewAgencyContactAddressDetails($aParam) {
        $sql = "INSERT INTO  `icms_address_list` 
                    SET 
                    `address_list_address_type`='2',
                    `address_list_origin_id` ='" . $aParam['newContactId'] . "',
                    `address_list_country` ='" . $aParam['country'] . "',
                    `address_list_region` ='" . $aParam['region'] . "',
                    `address_list_province` ='" . $aParam['province'] . "',
                    `address_list_city` ='" . $aParam['city'] . "',
                    `address_list_brgy` ='" . $aParam['brgy'] . "',
                    `address_list_origin_address` = '2',
                    `address_list_address` ='" . $aParam['address'] . "'
                    ";
        $aResponse = $this->yel->exec($sql);
        return $aResponse;
    }

    public function setAgencyContactAddressDetails($aParam) {
        $sql = "UPDATE  `icms_address_list` 
                    SET 
                    `address_list_country` ='" . $aParam['country'] . "',
                    `address_list_region` ='" . $aParam['region'] . "',
                    `address_list_province` ='" . $aParam['province'] . "',
                    `address_list_city` ='" . $aParam['city'] . "',
                    `address_list_brgy` ='" . $aParam['brgy'] . "',
                    `address_list_address` ='" . $aParam['address'] . "'
                    WHERE `address_list_id`='" . $aParam['addressid'] . "'
                    ";
        $aResponse = $this->yel->exec($sql);
        return $aResponse;
    }

    public function getAgencyBranchDetails($aParam) {
        $sql = "  SELECT  
                        `agency_branch_name`,
                        `agency_branch_email`,
                        `agency_branch_telephone_number`,
                        `agency_branch_mobile_number`
                    FROM
                        `icms_agency_branch`
                    WHERE `agency_branch_id`='" . $aParam['agn_branch_id'] . "'
                    ";
        $aResponse = $this->yel->GetRow($sql);
        return $aResponse;
    }

    public function getAgencyBranchIDbyAgencyAddressId($address_id) {
        $sql = "
                SELECT 
                   `address_list_origin_id`
                FROM 
                   `icms_address_list`
                WHERE 
                   `address_list_id`='" . $address_id . "'
                LIMIT 1
                ";

        $oResponse = $this->yel->GetOne($sql);
        return $oResponse;
    }

    public function getAgencyToAgencyBranchDetailsByAgencyBranchID($branch_id) {
        $sql = "
                SELECT 
                    `a`.*, 
                    `at`.*
                FROM 
                    `icms_agency_branch` `a`,
                    `icms_agency` `at`
                WHERE 
                     `a`.`agency_branch_id`= '" . $branch_id . "'
                AND `at`.`agency_id`=`a`.`agency_id` 
                ";

        $aResponse = $this->yel->GetRow($sql);

        return $aResponse;
    }

    public function getAddressByAddressID($aParam) {
        $sql = "
                SELECT 
                   `al`.`address_list_id`,
                   `al`.`address_list_address` as detailed_address,
                   (SELECT `country_name` FROM `icms_global_country` WHERE `country_id`=`al`.`address_list_country`) as country,
                   (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`al`.`address_list_region` AND `location_type_id`='3') as region,
                   (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`al`.`address_list_province` AND `location_type_id`='4') as province,
                   (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`al`.`address_list_province` AND `location_type_id`='2' AND `location_prerequisite_id`=`al`.`address_list_country`) as state,
                   (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`al`.`address_list_city` AND `location_type_id`='5') as city,
                   (SELECT `location_name` FROM `icms_global_location` WHERE `location_count_id`=`al`.`address_list_brgy` AND `location_type_id`='6') as brgy
                FROM 
                  `icms_address_list` `al`
                WHERE 
                     `address_list_id`='" . $aParam['addressid'] . "'
                ";
        $aResponse = $this->yel->GetRow($sql);

        return $aResponse;
    }

    public function getAgencyNameByKeyword($aParam) {
        $sql = "
                 SELECT 
                    `agency_name`,
                    `agency_abbr`
                FROM
                    `icms_agency`
                WHERE
                    `agency_name`='" . $aParam['keyword'] . "'
                LIMIT 3
              ";
        
        $aResult = $this->yel->getAll($sql);
        return $aResult;
    }

}
