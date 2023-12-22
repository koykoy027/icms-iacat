<?php

/**
 * DRIVE Controller - AJAX 
 * 
 * @module Ajax Loader
 * @author eBusiness Corp. 
 * @since 2018
 */
// page security
defined('BASEPATH') OR exit('No direct script access allowed');

class Drive extends CI_Controller {

    const SUCCESS_RESPONSE = 1;
    const FAILED_RESPONSE = 0;
    const DIR_CREATE_ENTRY = 1;

    public $iDirectory;

    /**
     * Constructor 
     */
    public function __construct() {
        parent::__construct();

        // load models
        $this->load->model('Drive_model');

        $this->load->helper(array('form', 'url'));
    }

    /**
     * Ajax Route :: Action Controller
     */
    public function ajax() {

        // route ajax api
        $this->base_action_ajax_drive();
    }

    /**
     * Upload File
     * 
     * @param array $aParam
     * @return array $aResponse
     */
    public function uploadFile($aParam) {

        /**
         * INITIALIZE
         */
        $aResponse = [];
        $aDocumentData = [];
        $aOutput = [];
        $aDeBug = [];

        // flaf - 0 
        $aResponse['flag'] = self::FAILED_RESPONSE;

        // sanitize
        $aParam = $this->yel->clean_array($aParam);

        $aDeBug['file'] = $_FILES;

        // if empty file
        if (empty($aDeBug['file'])) {
            return $aResponse;
        }

        /**
         * DRIVE HISTORY
         */
        $aDirectorySummary = $this->Drive_model->getDirectory($aParam);

        if (isset($aDirectorySummary['drive_summary_file_count']) == false) {
            $aDirectorySummary['drive_summary_file_count'] = 0;
            $iActiveDirectory = 1;
            $aNewDir = $this->Drive_model->createDirectory($iActiveDirectory);
            // create directory 
            if (file_exists(DRIVE_ROOT . $iActiveDirectory) !== true) {
                mkdir(DRIVE_ROOT . $iActiveDirectory, 0777, true);
            }
        }

        if ((int) $aDirectorySummary['drive_summary_file_count'] >= MAX_FILE_COUNT_PER_DIR) {
            // create new drive 
            $iActiveDirectory = (int) $aDirectorySummary['drive_summary_directory'] + 1;
            $aNewDir = $this->Drive_model->createDirectory($iActiveDirectory);
            // create directory 
            if (file_exists(DRIVE_ROOT . $iActiveDirectory) !== true) {
                mkdir(DRIVE_ROOT . $iActiveDirectory, 0777, true);
            }
        }

        // refetch active drive summary
        $aDirectorySummary = $this->Drive_model->getDirectory($aParam);
        $iFileCount = (int) $aDirectorySummary['drive_summary_file_count'] + 1;

        $sDirectory = $aDirectorySummary['drive_summary_directory'];

        // confirm if directory does exists
        if (file_exists(DRIVE_ROOT . $sDirectory) !== true) {
            mkdir(DRIVE_ROOT . $sDirectory, 0777, true);
        }

        /**
         * FILE UPLOAD w/ VALIDATION
         */
        $mFileName = basename($_FILES['file']['name']);
        $mTempName = $_FILES['file']['tmp_name'];
        $mFileSize = $_FILES['file']['size'];
        $mFileType = $_FILES['file']['type'];
        $mExtension = pathinfo($mFileName, PATHINFO_EXTENSION);
        $mTargetPath = DRIVE_ROOT . $sDirectory . DS;


        $TempMimeContentType = mime_content_type($mTempName);

        $aAllowMimeType = array(
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/msword',
            'application/x-zip',
            'application/vnd.ms-office',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/octet-stream',
            'image/bmp', 'image/x-bmp', 'image/x-bitmap', 'image/x-xbitmap', 'image/x-win-bitmap', 'image/x-windows-bmp', 'image/ms-bmp', 'image/x-ms-bmp', 'application/bmp', 'application/x-bmp', 'application/x-win-bitmap',
            'image/gif',
            'image/jpeg', 'image/pjpeg',
            'image/png', 'image/x-png',
            'application/pdf', 'application/force-download', 'application/x-download', 'binary/octet-stream'
        );

        if (in_array($TempMimeContentType, $aAllowMimeType) !== true) {
            return $aResponse;
        }


        /**
         * UPDATE DOCUMENT LISTING
         */
        $aDocumentData['documents_name'] = $this->yel->document_key() . '.' . $mExtension;
        $aDocumentData['documents_display_name'] = $this->yel->clean($mFileName);
        $aDocumentData['documents_description'] = $TempMimeContentType;
        $aDocumentData['documents_mime_type'] = strtolower($mExtension);
        $aDocumentData['documents_size'] = $mFileSize;
        $aDocumentData['documents_directory'] = $sDirectory;
        $aDocumentData['documents_hash'] = $this->yel->document_key(24);

        /**
         * Supports Directory Access
         */
        $iParentDirectoryID = 0;
        if (!empty($aParam['dir_hash']) !== false) {

            // get directory id
            $aDeBug['dir_data'] = $this->Drive_model->getParentDirectoryId($aParam['dir_hash']);
            $iParentDirectoryID = (int) $aDeBug['dir_data']['document_directory_id'];
        }


        // file upload 
        $aDeBug['file_action'] = @move_uploaded_file($mTempName, $mTargetPath . $aDocumentData['documents_name']);
        if ((int) $aDeBug['file_action'] !== self::SUCCESS_RESPONSE) {
            return $aResponse;
        }

        // insert to database
        $aDeBug['document'] = $this->Drive_model->insertDocumentData($aDocumentData, $iParentDirectoryID);

        // output
        $aOutput['display_name'] = $aDocumentData['documents_display_name'];
        $aOutput['mime_type'] = $aDocumentData['documents_mime_type'];
        $aOutput['size'] = $aDocumentData['documents_size'];
        $aOutput['hash'] = $aDocumentData['documents_hash'];
        $aResponse['output'] = $aOutput;

        // sub folder
        if ($iParentDirectoryID != 0) {
            $aResponse['listing'] = $this->Drive_model->getDirectoryContent($iParentDirectoryID);
        }

        /**
         * UPDATE DRIVE :: FILE COUNT OF ACTIVE DIR
         */
        $aDeBug['status'] = $this->Drive_model->updateActiveDirectory($iFileCount, $aDirectorySummary);

        $aResponse['flag'] = self::SUCCESS_RESPONSE;

        return $aResponse;
    }

    /**
     * Upload Crop Image 
     * 
     * @param array $aParam
     * @return array $aResponse
     */
    public function uploadCropImage($aParam) {

        $aResponse = [];

        // flaG - 0 
        $aResponse['flag'] = self::FAILED_RESPONSE;

        // sanitize
        $aParam = $this->yel->safe_mode_clean_array($aParam);

        // simulation for image creation
        $oImageArray1 = explode(";", $aParam['image_source']);
        $oImageArray2 = explode(",", $oImageArray1[1]);
        $aParam['image_source'] = base64_decode($oImageArray2[1]);


        // parameter should be required
        if (empty($aParam['image_source']) !== false) {
            return $aResponse;
        }

        // validate if image is image
        $oImage = imagecreatefromstring($aParam['image_source']);
        if (!$oImage) {
            return $aResponse;
        }

        // if image has size 
        $oSize = getimagesizefromstring($aParam['image_source']);
        if (!$oSize || $oSize[0] == 0 || $oSize[1] == 0 || !$oSize['mime']) {
            return $aResponse;
        }

        /**
         * DRIVE HISTORY
         */
        $aDirectorySummary = $this->Drive_model->getDirectory($aParam);


        if (!empty($aDirectorySummary['drive_summary_directory']) !== true) {
            return $aResponse;
        }

        if ((int) $aDirectorySummary['drive_summary_file_count'] >= MAX_FILE_COUNT_PER_DIR) {

            // create new drive 
            $iActiveDirectory = (int) $aDirectorySummary['drive_summary_directory'] + 1;
            $aNewDir = $this->Drive_model->createDirectory($iActiveDirectory);

            // create directory 
            if (file_exists(DRIVE_ROOT . $iActiveDirectory) !== true) {
                mkdir(DRIVE_ROOT . $iActiveDirectory, 0777, true);
            }
        }

        // refetch active drive summary
        $aDirectorySummary = $this->Drive_model->getDirectory($aParam);
        $iFileCount = (int) $aDirectorySummary['drive_summary_file_count'] + 1;

        $sDirectory = $aDirectorySummary['drive_summary_directory'];

        // confirm if directory does exists
        if (file_exists(DRIVE_ROOT . $sDirectory) !== true) {
            mkdir(DRIVE_ROOT . $sDirectory, 0777, true);
        }

        // statis as png 
        $mExtension = 'png';
        $mTargetPath = DRIVE_ROOT . $sDirectory . DS;
        $TempMimeContentType = $oSize['mime'];

        /**
         * UPDATE DOCUMENT LISTING
         */
        $aDocumentData['documents_name'] = $this->yel->document_key() . '.' . $mExtension;
        $aDocumentData['documents_display_name'] = 'image';
        $aDocumentData['documents_description'] = $TempMimeContentType;
        $aDocumentData['documents_mime_type'] = strtolower($mExtension);
        $aDocumentData['documents_size'] = strlen($aParam['image_source']);
        $aDocumentData['documents_directory'] = $sDirectory;
        $aDocumentData['documents_hash'] = $this->yel->document_key(24);

        /**
         * Supports Directory Access
         */
        $iParentDirectoryID = 0;
        if (!empty($aParam['dir_hash']) !== false) {

            // get directory id
            $aDeBug['dir_data'] = $this->Drive_model->getParentDirectoryId($aParam['dir_hash']);
            $iParentDirectoryID = (int) $aDeBug['dir_data']['document_directory_id'];
        }

        $aAllowMimeType = array(
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/msword',
            'application/x-zip',
            'application/vnd.ms-office',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/octet-stream',
            'image/bmp', 'image/x-bmp', 'image/x-bitmap', 'image/x-xbitmap', 'image/x-win-bitmap', 'image/x-windows-bmp', 'image/ms-bmp', 'image/x-ms-bmp', 'application/bmp', 'application/x-bmp', 'application/x-win-bitmap',
            'image/gif',
            'image/jpeg', 'image/pjpeg',
            'image/png', 'image/x-png',
            'application/pdf', 'application/force-download', 'application/x-download', 'binary/octet-stream'
        );

        if (in_array($TempMimeContentType, $aAllowMimeType) !== true) {
            return $aResponse;
        }


        // file upload 
        $aDeBug['log'] = @file_put_contents($mTargetPath . $aDocumentData['documents_name'], $aParam['image_source']);
        if ((int) $aDeBug['log'] <= 0) {
            return $aResponse;
        }

        // insert to database
        $aDeBug['document'] = $this->Drive_model->insertDocumentData($aDocumentData, $iParentDirectoryID);

        // output
        $aOutput['display_name'] = $aDocumentData['documents_display_name'];
        $aOutput['mime_type'] = $aDocumentData['documents_mime_type'];
        $aOutput['size'] = $aDocumentData['documents_size'];
        $aOutput['hash'] = $aDocumentData['documents_hash'];
        $aResponse['output'] = $aOutput;

        // sub folder
        if ($iParentDirectoryID != 0) {
            $aResponse['listing'] = $this->Drive_model->getDirectoryContent($iParentDirectoryID);
        }

        /**
         * UPDATE DRIVE :: FILE COUNT OF ACTIVE DIR
         */
        $aDeBug['status'] = $this->Drive_model->updateActiveDirectory($iFileCount, $aDirectorySummary);

        // indicate uploading file was success
        $aResponse['flag'] = self::SUCCESS_RESPONSE;

        return $aResponse;
    }

    /**
     * Get Directory Data
     * 
     * @param array $aParam
     * @return array $aResponse
     */
    public function getDirectoryData($aParam) {

        // initialize
        $aResponse = [];
        $aDebug = [];
        $aData = [];
        $aDirKey = [];

        // declaration
        $aData['mode'] = 'all';
        $aData['hash'] = '';
        $aData['mkdir'] = 0;

        // sanitize
        $aParam = $this->yel->clean_array($aParam);

        // validate mode | permission
        if (!empty($aParam['mode']) !== false) {
            $aMode = array('all', 'view', 'read', 'write');
            if (in_array($aParam['mode'], $aMode) !== false) {
                $aData['mode'] = $aParam['mode'];
            }
        }

        // validate hash | directory hash value
        if (!empty($aParam['hash']) !== false) {
            $aData['hash'] = $aParam['hash'];
        }

        // validate mkdir | make directory
        if (!empty($aParam['mdir']) !== false) {
            $aData['mkdir'] = (int) $aParam['mdir'];
        }


        // create entry 
        if ($aData['mkdir'] == self::DIR_CREATE_ENTRY) {

            // generate : ID
            $aDirKey['all'] = $this->yel->document_key(15);
            $aDirKey['view'] = $this->yel->document_key(15);

            $aDebug['attribute'] = $this->Drive_model->createEntry($aData, $aDirKey);
            $aResponse['dir_key'] = $aDirKey;
        } else {

            // validate directory id
            switch ($aData['mode']) {

                case 'all':
                case 'write':
                    $aResponse['get_dir_id'] = $this->Drive_model->getDirAttrAll($aData['hash']);
                    break;

                case 'view':
                case 'read':
                    $aResponse['get_dir_id'] = $this->Drive_model->getDirAttrtView($aData['hash']);

                    break;
                default:
                    // default
                    $aResponse['get_dir_id'] = $this->Drive_model->getDirAttrAll($aData['hash']);
            }

            $aResponse['listing'] = [];
            if (!empty($aResponse['get_dir_id']['document_directory_id']) !== false) {
                $aResponse['listing'] = $this->Drive_model->getDirectoryContent($aResponse['get_dir_id']['document_directory_id']);
            }
        }

        return $aResponse;
    }

    /**
     * Remove File
     * 
     * @param array $aParam
     * @return array $aResponse
     */
    public function removeFile($aParam) {

        // initialize
        $aResponse = [];

        // sanitize
        $aParam = $this->yel->clean_array($aParam);

        $aResponse['flag'] = self::FAILED_RESPONSE;

        $aResponse['get_dir_id'] = $this->Drive_model->getDirAttrAll($aParam['active_directory']);
        if (!empty($aResponse['get_dir_id']['document_directory_id']) !== false) {
            $iParentDirectoryID = (int) $aResponse['get_dir_id']['document_directory_id'];

            // hide file
            $aResponse['act'] = $this->Drive_model->removeFile($iParentDirectoryID, $aParam['documents_hash']);

            // refresh list
            $aResponse['listing'] = $this->Drive_model->getDirectoryContent($iParentDirectoryID);

            $aResponse['flag'] = self::SUCCESS_RESPONSE;
        }


        return $aResponse;
    }

    public function removeSingleFileUpload($aParam) {

        $aResponse = [];

        $aParam = $this->yel->clean_array($aParam);

        $aResponse['flag'] = self::FAILED_RESPONSE;

        if (!empty($aParam['documents_hash']) !== false) {

            $aResponse['act'] = $this->Drive_model->removeSingleFileUpload($aParam);

            $aResponse['flag'] = self::SUCCESS_RESPONSE;
        }

        return $aResponse;
    }

}
