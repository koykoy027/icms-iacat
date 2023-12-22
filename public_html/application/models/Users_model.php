<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Users_model extends CI_Model {

    public function test($aParam) {

        $aResponse = [];

        $sql = "";

//        $aResponse = $this->yel->GetRow($sql);

        return $aResponse;
    }

    public function getAllUsers($aParam) {

        $aResponse = [];

        $sql = "
            SELECT 
                `u`.`user_id`,
                `u`.`user_firstname`,
                `u`.`user_lastname`,
                `u`.`user_phone_number`,
                `u`.`user_mobile_number`,
                `u`.`user_job_title`,
        	`u`.`user_email`,
                `u`.`govt_agency_id`,
                `u`.`user_level_id`,
                `u`.`user_is_active`,
                `u`.`govt_agency_type_is_active`,
                `u`.`govt_agency_is_active`,
                `u`.`user_level_is_active`,
                `u`.`user_date_added`,
                `u`.`user_date_modified`,
                `gat`.`govt_agency_type_name`,
                `ga`.`govt_agency_branch_name`,
                (SELECT `transaction_parameter_name`  FROM `icms_transaction_parameter` 
                WHERE `transaction_parameter_type_id` = 5 
                AND `transaction_parameter_count_id` = `u`.`user_level_id` LIMIT 1 ) AS `user_level_description`
            FROM
                `icms_user` `u`,
                `icms_govt_agency` `ga`,
                `icms_govt_agency_type` `gat`
            WHERE 
            " . $aParam['filter'] . "
                (`ga`.`govt_agency_id`= `u`.`govt_agency_id`
            AND `gat`.`govt_agency_type_id`=`ga`.`govt_agency_type_id` )" . $aParam['orderby'] . " LIMIT  " . $aParam['page'] . "," . $aParam['limit']
        ;


        $aResponse['list'] = $this->yel->GetAll($sql);
        $qry = "
            SELECT 
               COUNT(1)
         FROM
                `icms_user` `u`,
                `icms_govt_agency` `ga`,
                `icms_govt_agency_type` `gat`
            WHERE 
            " . $aParam['filter'] . "
                (`ga`.`govt_agency_id`= `u`.`govt_agency_id`
            AND `gat`.`govt_agency_type_id`=`ga`.`govt_agency_type_id` )" . $aParam['orderby'] . " LIMIT  " . $aParam['page'] . "," . $aParam['limit']
        ;
        $aResponse['count'] = $this->yel->GetOne($qry);

        return $aResponse;
    }

    public function getUserIDByFilter_username($aParam) {

        $sql = "
                SELECT 
                    `user_id`
                FROM 
                    `icms_user` 
                WHERE 
                     MATCH (`user_firstname`,`user_lastname`)AGAINST('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)
             ";
        $result = $this->yel->GetAll($sql);
        return $result;
    }

    public function getUserIDByFilter_branch($aParam) {
        $sql = "
                SELECT 
                    `u`.`user_id`
                FROM 
                    `icms_user` `u`,
                    `icms_govt_agency` `iga`
                WHERE 
                     MATCH (`iga`.`govt_agency_branch_name`)AGAINST('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)
                AND `u`.`govt_agency_id`=`iga`.`govt_agency_id`
             ";
        $result = $this->yel->GetAll($sql);
        return $result;
    }

    public function getUserIDByFilter_agencyname($aParam) {
        $sql = "
                SELECT 
                    `u`.`user_id`
                FROM 
                    `icms_user` `u`,
                    `icms_govt_agency` `iga`,
                    `icms_govt_agency_type` `igat`
                WHERE 
                     MATCH (`igat`.`govt_agency_type_name`)AGAINST('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE)
                AND `iga`.`govt_agency_type_id`=`igat`.`govt_agency_type_id`
                AND `u`.`govt_agency_id`=`iga`.`govt_agency_id`
             ";


        $result = $this->yel->GetAll($sql);
        return $result;
    }

    public function validateUsername($aParam) {
        $sql = "
                SELECT 
                    COUNT(1) 
                FROM 
                    `icms_user` 
                WHERE 
                    `user_username`=BINARY '" . $aParam['username'] . "' 
                LIMIT 1
             ";
        $aResponse = $this->yel->GetOne($sql);
        return $aResponse;
    }

    public function AddUsers($aParam) {
        $sql = "
                INSERT INTO 
                    `icms_user`
                SET    
                    `user_firstname`='" . $aParam['fname'] . "',
                    `user_lastname`='" . $aParam['lname'] . "',
                    `user_phone_number`='" . $aParam['telno'] . "',
                    `user_mobile_number`='" . $aParam['mobile'] . "',
                    `gender_id`='" . $aParam['gender_id'] . "',
                    `user_job_title`='" . $aParam['job_title'] . "',
                    `user_username`='" . $aParam['username'] . "',
                    `user_email`='" . $aParam['email'] . "',
                    `user_password`='" . $this->yel->encrypt($aParam['password']) . "',
                    `govt_agency_id`='" . $aParam['agency_id'] . "',
                    `user_level_id`='" . $aParam['user_level_id'] . "'
             ";

        $result = $this->yel->exec($sql);
        return $result['insert_id'];
    }

    public function addUserAddress($aParam) {
        $sql = "
                INSERT INTO 
                    `icms_address_list`
                SET
                    `address_type_id`='3',
                    `origin_id`='" . $aParam['newUserID'] . "',
                    `country_id`='" . $aParam['country_id'] . "',
                    `region_id`='" . $aParam['region_id'] . "',
                    `province_id`='" . $aParam['province_id'] . "',
                    `city_id`='" . $aParam['city_id'] . "',
                    `brgy_id`='" . $aParam['brgy_id'] . "',
                    `address`='" . $aParam['address'] . "',
                    `origin_address_type_id`='1'
             ";
        $result = $this->yel->exec($sql);
        return $result;
    }

    public function addUserUserRole($aParam) {
        $sql = "
                INSERT INTO 
                    `icms_user_role`
                SET
                    `user_id`='" . $aParam['newUserID'] . "',
                    `user_role_type_id`='" . $aParam['userRoleId'] . "'
             ";
        $result = $this->yel->exec($sql);
        return $result;
    }

    public function getUsersInfobyID($aParam) {
        $sql = "
               SELECT 
                `iu`.*
               FROM 
                `icms_user` `iu`
               WHERE 
                `iu`.`user_id` = " . $aParam['user_id'] . "
             ";
        $aResponse = $this->yel->GetRow($sql);
        return $aResponse;
    }

    public function getAgencyTypeIDByKeyword($keyword) {
        $sql = "
             SELECT 
                `govt_agency_type_id` 
             FROM 
                `icms_govt_agency_type` 
             WHERE 
                MATCH (`govt_agency_type_name`)AGAINST('+" . $keyword . "*' IN BOOLEAN MODE)
             ";
        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function getAgencyBranchByKeyword($keyword) {
        $sql = "
             SELECT 
                `govt_agency_id` 
             FROM 
                `icms_govt_agency` 
             WHERE 
                MATCH (`govt_agency_branch_name`)AGAINST('+" . $keyword . "*' IN BOOLEAN MODE)
             ";
        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function getAgencyIDByFilteredID($ids) {
        $sql = "
             SELECT 
                `govt_agency_id` 
             FROM 
                `icms_govt_agency` 
             WHERE 
                (`govt_agency_type_id`) IN ($ids)
             ";
        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

    public function getAgencyIDFilterByName($aParam) {
        $sql = "
             SELECT 
                `u`.`govt_agency_id` 
             FROM 
                `icms_user`  `u`
             WHERE 
               MATCH (`u`.`user_firstname`,`u`.`user_lastname`)AGAINST('+" . $aParam['keyword'] . "*' IN BOOLEAN MODE) 
             ";
        $aResponse = $this->yel->GetAll($sql);
        return $aResponse;
    }

   

}
