<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Account_settings_model extends CI_Model {

    public function addProfilePhoto($aParam) {

        $aResponse = [];

        $qry = "
                UPDATE 
                    `icms_image_upload`
                SET
                    `image_upload_is_primary`='0'
                WHERE
                    `user_Id`='" . $aParam['user_id'] . "'
                AND `photo_type_id`='1'
                AND `panel_id`='1'
                ";

        $aResponse['update'] = $this->yel->exec($qry);

        $sql = "
                INSERT INTO
                    `icms_image_upload`
                SET
                    `photo_type_id`='1',
                    `panel_id`='1',
                    `user_Id`='" . $aParam['user_id'] . "',
                    `document_hash`='" . $aParam['fileHash'] . "',
                    `image_upload_is_primary`='1'
                ";

        $aResponse['add'] = $this->yel->exec($sql);

        return $aResponse;
    }

    public function getProfilePhoto($aParam) {
        $sql = "
               SELECT 
                    `image_upload_id`,
                    `document_hash`,
                    `image_upload_is_primary`
               FROM
                    `icms_image_upload`
               WHERE
                    `user_Id`='" . $aParam['user_id'] . "'
               AND `photo_type_id`='1'    
               AND `image_upload_is_active`='1'
               ORDER BY  `image_upload_is_primary` DESC
                ";
        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }

    public function setPhotoAsPrimary($aParam) {
        $aResponse = [];

        $qry = "
                UPDATE 
                    `icms_image_upload`
                SET
                    `image_upload_is_primary`='0'
                WHERE
                    `user_Id`='" . $aParam['user_id'] . "'
                AND `photo_type_id`='1'
                AND `panel_id`='1'
                ";

        $aResponse['update'] = $this->yel->exec($qry);

        $sql = "
                UPDATE 
                    `icms_image_upload`
                SET
                    `image_upload_is_primary`='1'
                WHERE
                    `image_upload_id`='" . $aParam['id'] . "'
                ";

        $aResponse['set'] = $this->yel->exec($sql);
        return $aResponse;
    }

    public function getProfileHash($aParam) {
        $sql = "
                SELECT 
                    `document_hash`
                FROM
                    `icms_image_upload`
                WHERE
                    `image_upload_id`='" . $aParam['id'] . "'
                LIMIT 1
                ";

        $pic = $this->yel->GetOne($sql);
        return $pic;
    }

    public function removePicture($aParam) {

        $sql = "
                UPDATE 
                    `icms_image_upload`
                SET
                    `image_upload_is_active`='0'
                WHERE
                    `image_upload_id`='" . $aParam['id'] . "'
                ";

        $aResponse = $this->yel->exec($sql);
        return $aResponse;
    }

    public function getCaseCountPerUser($aParam) {
        $aResponse = [];
        $sql_active = "
                SELECT   COUNT(1) 
                FROM `icms_case`
                WHERE `case_status_id`='1' AND `case_added_by`='" . $aParam['user_id'] . "'
                ";

        $sql_added = "
                SELECT   COUNT(1) 
                FROM `icms_case`
                WHERE `case_added_by`='" . $aParam['user_id'] . "'
                ";

        $aResponse['added'] = $this->yel->GetOne($sql_added);
        $aResponse['active'] = $this->yel->GetOne($sql_active);
        return $aResponse;
    }

}
