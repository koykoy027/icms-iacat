<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Notif_model extends CI_Model {

    /**
     * Create notification
     * 
     * @param array $aParam
     * @return array $aResponse
     */
    public function createNotification($aParam) {

        $aResponse = [];

        $sSequel = "
            INSERT IGNORE INTO `icms_notification` SET
            `notification_type_id`='" . $aParam['notif_type'] . "',
            `notification_message` = '" . $aParam['msg'] . "',
            `notification_method` = '" . $aParam['method'] . "',
            `table_id` = '" . $aParam['tbl_id'] . "',
            `notification_receiver_user_id` = '" . $aParam['receiver'] . "',
            `notification_sender_user_id` = '" . $aParam['sender_id'] . "',
            `notification_sender_agency_branch_id` = '" . $aParam['sender_branch_id'] . "',
            `notification_date_added` = now()
            ";
        $aResponse = $this->yel->exec($sSequel);
        return $aResponse;
    }

    /**
     * get unread notification for header
     * 
     * @param array $user_id
     * @return array $aResponse
     */
    public function getUnreadNotification($user_id) {

        $aResponse = [];

        $sSequel = "
                SELECT 
                    `notification_id`, 
                    `notification_message`, 
                    `notification_is_read`,
                    `notification_date_added` 
                FROM 
                    `icms_notification`
                WHERE
                    `notification_receiver_user_id`='" . $user_id . "'
                AND `notification_is_read`='0'  ORDER BY `notification_date_added` DESC  LIMIT 5
            ";

        $aResponse['list'] = $this->yel->GetAll($sSequel);

        $sql = "
                SELECT 
                    COUNT(1)
                FROM 
                    `icms_notification`
                WHERE
                    `notification_receiver_user_id`='" . $user_id . "'
                AND `notification_is_read`='0'
            ";
        $aResponse['count'] = $this->yel->GetOne($sql);
        return $aResponse;
    }

    /**
     * get all notification
     * 
     * @param array $user_id
     * @return array $aResponse
     */
    public function getUserNotification($aParam) {

        $aResponse = [];

        $sSequel = "
                 SELECT 
                    `n`.`notification_id`, 
                    `n`.`notification_message`, 
                    `n`.`notification_is_read`,
                    `n`.`notification_date_added`,
                    (SELECT `notification_name` FROM `icms_notification_type` WHERE `notification_type_id`=`n`.`notification_type_id` LIMIT 1) as `notification_type`
                FROM 
                    `icms_notification` `n`
                WHERE
                    `n`.`notification_receiver_user_id`='" . $aParam['user_id'] . "'
                ORDER BY `n`.`notification_date_added` DESC 
                LIMIT " . $aParam['limit_start'] . "," . $aParam['limit_count'];



        $aResponse['list'] = $this->yel->GetAll($sSequel);

        $sql = "
                SELECT 
                    COUNT(1)
                FROM 
                    `icms_notification`
                WHERE
                    `notification_receiver_user_id`='" . $aParam['user_id'] . "'
            ";
        $aResponse['count'] = $this->yel->GetOne($sql);
        return $aResponse;
    }

    /**
     * set notification as read
     * 
     * @param array $aParam
     * @return array $aResponse
     */
    public function setUserNotificationAsRead($notif_id) {

        $aResponse = [];

        $sSequel = "
            UPDATE 
                `icms_notification`
            SET
                `notification_is_read` = '1'
            WHERE
                `notification_id`='" . $notif_id . "'
            ";
        $aResponse = $this->yel->exec($sSequel);
        return $aResponse;
    }

    /**
     * set notification as read
     * 
     * @param array $aParam
     * @return array $aResponse
     */
    public function setAllUserNotificationAsRead($user_id) {

        $aResponse = [];

        $sSequel = "
            UPDATE 
                `icms_notification`
            SET
                `notification_is_read` = '1'
            WHERE
                `notification_receiver_user_id`='" . $user_id . "'
            ";
        $aResponse = $this->yel->exec($sSequel);
        return $aResponse;
    }

    /**
     * set notification as read by method name and table id
     * 
     * @param array $aParam
     * @return array $aResponse
     */
    public function setUserNotificationByMethodAndId($method_name, $table_id) {

        $aResponse = [];
        $sSequel = "
            UPDATE 
                `icms_notification`
            SET
                `notification_is_read` = '1'
            WHERE
                `notification_method`='" . $method_name . "'
            AND `table_id`='" . $table_id . "'
            AND `notification_receiver_user_id`='". $_SESSION['userData']['user_id'] ."'
            ";
        $aResponse = $this->yel->exec($sSequel);
        return $aResponse;
    }
    
    
    /**
     * set notification as read by method name and table id
     * 
     * @param array $aParam
     * @return array $aResponse
     */
    public function setUserNotificationByMethodName($method_name) {

        $aResponse = [];
        $sSequel = "
            UPDATE 
                `icms_notification`
            SET
                `notification_is_read` = '1'
            WHERE
                `notification_method`='" . $method_name . "'
            AND `notification_receiver_user_id`='". $_SESSION['userData']['user_id'] ."'
            ";
        $aResponse = $this->yel->exec($sSequel);
        return $aResponse;
    }

    /**
     * Get Victim Contact Information
     * 
     * @param array $aParam
     * @return array
     */
    public function getVictimContactInformation($aParam) {
        $sql = "
            SELECT 
            
                (SELECT `ivcd`.`victim_contact_detail_content` 
                FROM `icms_victim_contact_details` `ivcd` 
                WHERE `ivcd`.`victim_contact_detail_type` = 3 
                AND `ivcd`.`victim_contact_details_is_active` = 1
                AND  `ivcd`.`victim_id` = `icv`.`victim_id` 
                LIMIT 1 ) as temporary_complainant_email_address, 

                (SELECT `ivcd`.`victim_contact_detail_content` 
                FROM `icms_victim_contact_details` `ivcd` 
                WHERE `ivcd`.`victim_contact_detail_type` = 1
                AND `ivcd`.`victim_contact_details_is_active` = 1
                AND  `ivcd`.`victim_id` = `icv`.`victim_id` 
                LIMIT 1 ) as temporary_complainant_mobile_number, 

                `icv`.`case_victim_date_added` as temporary_case_date_added 

            FROM `icms_case_victim` `icv`
            WHERE `icv`.`case_id` = '". $aParam['case_id'] . "'
        "; 
        return $this->yel->GetRow($sql);
    }

}
