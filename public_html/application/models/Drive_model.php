<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Drive_model extends CI_Model {

    public function getFile($sDocumentHashID) {

        $aResponse = [];

        $sSequel = "
           SELECT 
           * 
           FROM 
           `icms_documents`
           WHERE
           `documents_is_active` = '1' AND 
           `documents_hash` = '" . $sDocumentHashID . "'
           ";
        
        $aResponse = $this->yel->GetRow($sSequel);

        return $aResponse;
    }

    public function getDirectory($aParam) {

        $aResponse = [];

        $sSequel = "
           SELECT 
           * 
           FROM 
           `icms_drive_summary`
           ORDER BY `drive_summary_id` DESC
           LIMIT 1
           ";

        $aResponse = $this->yel->GetRow($sSequel);

        return $aResponse;
    }

    public function createDirectory($iActiveDirectory) {

        $aResponse = [];

        $sSequel = "
           INSERT INTO `icms_drive_summary` SET
           `drive_summary_directory` = '" . $iActiveDirectory . "'               
           ";

        $aResponse = $this->yel->exec($sSequel);

        return $aResponse;
    }

    public function updateActiveDirectory($iFileCount, $aDirectorySummary) {

        $aResponse = [];

        $sSequel = "
           UPDATE `icms_drive_summary` SET
           `drive_summary_file_count` = '" . $iFileCount . "',
           `drive_summary_date_modified` = NOW()
           WHERE 
           `drive_summary_id` = '" . $aDirectorySummary['drive_summary_id'] . "'
           ";

        $aResponse = $this->yel->exec($sSequel);

        return $aResponse;
    }

    public function insertDocumentData($aDocumentData, $iParentDirectoryID = 0) {

        $aResponse = [];

        $sSequel = "
           INSERT INTO `icms_documents` SET
           `documents_name` = '" . $aDocumentData['documents_name'] . "',
           `documents_description` = '" . $aDocumentData['documents_description'] . "',
           `documents_display_name` = '" . $aDocumentData['documents_display_name'] . "',
           `documents_mime_type` = '" . $aDocumentData['documents_mime_type'] . "',
           `documents_size` = '" . $aDocumentData['documents_size'] . "',    
           `documents_directory` = '" . $aDocumentData['documents_directory'] . "',
           `document_directory_id` = '" . $iParentDirectoryID . "',
           `documents_hash` = '" . $aDocumentData['documents_hash'] . "'
           ";

        $aResponse = $this->yel->exec($sSequel);

        return $aResponse;
    }

    public function createEntry($aData, $aDirKey) {

        $aResponse = [];

        $sSequel = "
            INSERT INTO `icms_document_directory` SET
            `document_directory_hash_all` = '" . $aDirKey['all'] . "',
            `document_directory_hash_view` = '" . $aDirKey['view'] . "'
            ";

        $aResponse = $this->yel->exec($sSequel);

        return $aResponse;
    }

    public function getDirAttrAll($sHash) {

        $aResponse = [];

        $sSequel = "
            SELECT * 
            FROM 
            `icms_document_directory`
            WHERE
            `document_directory_hash_all` = '" . $sHash . "' 
            LIMIT 1
            ";

        $aResponse = $this->yel->GetRow($sSequel);

        return $aResponse;
    }

    public function getDirAttrtView($sHash) {

        $aResponse = [];

        $sSequel = "
            SELECT * 
            FROM 
            `icms_document_directory`
            WHERE
            `document_directory_hash_view` = '" . $sHash . "' 
            LIMIT 1
            ";

        $aResponse = $this->yel->GetRow($sSequel);

        return $aResponse;
    }

    public function getDirectoryContent($iDirectoryID) {

        $aResponse = [];

        $sSequel = "
            SELECT * 
            FROM 
            `icms_documents`
            WHERE
            `document_directory_id` = '" . $iDirectoryID . "' AND 
            `documents_is_active` = '1'
            ";

        $aResponse = $this->yel->GetAll($sSequel);

        return $aResponse;
    }

    public function getParentDirectoryId($iDirectoryKey) {

        $aResponse = [];

        $sSequel = "
            SELECT 
            *
            FROM 
            `icms_document_directory`
            WHERE
            `document_directory_hash_all` = '" . $iDirectoryKey . "' OR
            `document_directory_hash_view` = '" . $iDirectoryKey . "'
            LIMIT 1
            ";

        $aResponse = $this->yel->GetRow($sSequel);

        return $aResponse;
    }

    public function removeFile($iParentDirectoryID, $sHash) {

        $aResponse = [];

        $sSequel = "
            UPDATE `icms_documents` SET
            `documents_is_active` = '0'
            WHERE
            `documents_hash` = '" . $sHash . "' AND 
            `document_directory_id` = '" . $iParentDirectoryID . "'
            ";

        $aResponse = $this->yel->exec($sSequel);

        return $aResponse;
    }
    
    public function removeSingleFileUpload($aParam) {

        $aResponse = [];

        $sSequel = "
            UPDATE `icms_documents` SET
            `documents_is_active` = '0'
            WHERE
            `documents_hash` = '" . $aParam['documents_hash'] . "' 
            ";

        $aResponse = $this->yel->exec($sSequel);

        return $aResponse;
    }

}
