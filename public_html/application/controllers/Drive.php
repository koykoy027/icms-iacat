<?php

/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Drive Controller
 * 
 * @module Main Controller
 * @author eBusiness Corp.
 * @since 2018
 * @code_review : Last March 13, 2019
 */
Class Drive extends CI_Controller {

    public function __construct() {

        parent::__construct();

        // load models
        $this->load->model('Drive_model');
    }

    public function index() {
        die("Forbidden Page #403");
    }

    /**
     * Ajax Route :: Action Controller
     */
    public function api() {

        // route ajax api
        $this->base_action_api();
    }

    /**
     * Test Page
     * 
     * @param array $aParam
     * @return array $aResponse
     */
    protected function test($aParam) {

        $aResponse = [];

        $aResponse['directory'] = 1;

        $aResponse['param'] = $aParam;

        $aResponse['path'] = DRIVE_ROOT;

        $aResponse['files'] = scandir($aResponse['path'] . $aResponse['directory'] . DS);

        return $aResponse;
    }

    /**
     * FOR COMMERCIAL USE
     */
    public function file() {

        $iHeight = 0;
        $iWidth = 0;
        $sType = 'auto';

        if (!empty($this->uri->segment(3)) !== false) {

            // hash id
            $sDocumentHashID = $this->yel->clean($this->uri->segment(3));

            $aDocumentAttr = $this->Drive_model->getFile($sDocumentHashID);

            // validate : if recordset does exist
            if (empty($aDocumentAttr['documents_id']) !== false) {
                die("Invalid Parameter");
            }

            // build document path
            $sFile = DRIVE_ROOT . $aDocumentAttr['documents_directory'] . DS . $aDocumentAttr['documents_name'];
            $sFileName = $aDocumentAttr['documents_name'];

            // validate : if physical file does exist
            if (file_exists($sFile) !== true) {
                die("Document not found.");
            }

            // validate dimensions | height
            if (!empty($this->uri->segment(4)) !== false) {
                $iWidth = $this->uri->segment(4);
            }

            // validate dimensions | width
            if (!empty($this->uri->segment(5)) !== false) {
                $iHeight = $this->uri->segment(5);
            }

            $aResolutionType = array("fixed", "auto");
            // validate dimensions | width
            if (!empty($this->uri->segment(6)) !== false) {
                $sType = strtolower($this->uri->segment(6));
                if (in_array($sType, $aResolutionType) !== false) {
                    $sType = $sType;
                }
            }

            // preview mode
            $this->previewByMimeType($sFile, $sFileName, $aDocumentAttr, $iWidth, $iHeight, $sType);
        } else {
            die("Invalid Link");
        }
    }

    /**
     * Debugger 
     * 
     * @param array $aData
     * @reuturn array $aData
     */
    private function debug($aData) {
        echo "<pre>";
        print_r($aData);
        echo "</pre>";
    }

    /**
     * View as MS Word
     */
    public function viewMSWord() {

        if (empty($this->uri->segment(3)) !== false || empty($this->uri->segment(4)) !== false) {
            die("Invalid URL");
        }
        $mPath = DRIVE_ROOT . $this->uri->segment(3) . DS . $this->uri->segment(4);
        if (file_exists($mPath) !== true) {
            die("Something went wrong. Document not found.");
        }
        $mDocFile = $mPath;
        header('Content-disposition: inline');
        header('Content-type: application/msword'); // not sure if this is the correct MIME type
        readfile($mDocFile);
        exit;
    }

    /**
     * Mime content type
     * 
     * @param mixed $mFile
     * @return object $oImage
     */
    private function controlByMimeType($mFile) {

        $mMime = mime_content_type($mFile);

        switch ($mMime) {

            case 'image/png':
                $oImage = imagecreatefrompng($mFile);
                break;

            case 'image/gif':
                $oImage = imagecreatefromgif($mFile);
                break;

            case 'image/jpeg':
            case 'image/jpg':
                $oImage = imagecreatefromjpeg($mFile);
                break;

            case 'image/bmp':
                $oImage = imagecreatefrombmp($mFile);
                break;

            case 'image/webp':
                $oImage = imagecreatefromwebp($mFile);
                break;

            default:
                $oImage = null;
        }
        return $oImage;
    }

    /**
     * Image Builder By Type
     * 
     * @param mixed $mImageFile
     * @param mixed $nameAsPreview
     * @param string $sImageMimeType
     */
    private function imageBuilderByType($mImageFile, $nameAsPreview, $sImageMimeType) {

        switch ($sImageMimeType) {

            case 'image/png':
                imagepng($mImageFile, $nameAsPreview);
                break;

            case 'image/gif':
                imagegif($mImageFile, $nameAsPreview);
                break;

            case 'image/jpeg':
            case 'image/jpg':
                imagejpeg($mImageFile, $nameAsPreview);
                break;

            case 'image/bmp':
                imagebmp($mImageFile, $nameAsPreview);
                break;

            case 'image/webp':
                imagewebp($mImageFile, $nameAsPreview);
                break;

            default:
                imagejpeg($mImageFile, $nameAsPreview);
        }
        imagedestroy($mImageFile);
    }

    /**
     * Resize Image
     * 
     * @param mixed $file
     * @param mixed $w
     * @param mixed $h
     * @param mixed $crop
     * @param mixed $sType
     * @return mixed $dst
     */
    private function resizeImage($file, $w, $h, $crop = FALSE, $sType = "auto") {

        list($width, $height) = getimagesize($file);
        $r = $width / $height;

        // if request as orinigal size
        if ((int) $w == 0 && (int) $h == 0) {
            $w = getimagesize($file)[0];
            $h = getimagesize($file)[1];
        }

        if ((int) $w != 0 && (int) $h == 0) {
            $w = $w;
            $h = $w;
        }


        if ((int) $w >= 3000 || (int) $h >= 3000) {
            $w = getimagesize($file)[0];
            $h = getimagesize($file)[1];
        }



        if ($crop) {
            if ($width > $height) {
                $width = ceil($width - ($width * abs($r - $w / $h)));
            } else {
                $height = ceil($height - ($height * abs($r - $w / $h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {

            // image control
            if ($sType == "auto") {
                // auto adjust
                if ($w / $h > $r) {
                    $newwidth = $h * $r;
                    $newheight = $h;
                } else {
                    $newheight = $w / $r;
                    $newwidth = $w;
                }
            } else {
                // fixed based on user demand
                $newheight = $h;
                $newwidth = $w;
            }
        }

        $src = $this->controlByMimeType($file);

        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        // $white = imagecolorallocate($dst, 255, 255, 255);
        $black = imagecolorallocate($dst, 0, 0, 0);
        imagecolortransparent($dst, $black);
        // imagefill($dst, 0, 0, $white);

        return $dst;
    }

    /**
     * Preview By Mime Type
     *
     * @param string $sFile
     * @param array $aDocument
     */
    private function previewByMimeType($sFile, $sFileName, $aDocument, $iWidth, $iHeight, $sType = 'auto') {

        $sMimeType = strtolower($aDocument['documents_mime_type']);
        switch ($sMimeType) {

            /**
             * PDF PREVIEW
             */
            case 'pdf':

                $mPDFFile = $sFile;
                header('Content-Type: application/pdf');
                header('Content-Disposition: inline; filename=' . $mPDFFile);
                header('Content-Transfer-Encoding: binary');
                header('Accept-Ranges: bytes');
                readfile($mPDFFile);

                break;

            /**
             * DOCUMENT PREVIEW
             */
            case 'docx':
            case 'doc':

                $mDocFile = $sFile;
                $embed_format = '<html> <body style="margin:0px 0px 0px 0px;"> <iframe src="https://docs.google.com/viewer?url=' . SITE_URL . 'drive/viewMSWord/' . $aDocument['documents_directory'] . DS . $aDocument['documents_name'] . '&embedded=true" frameBorder="0" width="100%" height="100%"></iframe> </body></html>';
                echo $embed_format;

                break;


            /**
             * IMAGE PREVIEW
             * w/ flexible options
             */
            case 'png':
            case 'jpg':
            case 'jpeg':
            case 'gif':
            case 'bmp':

                // name as preview
                $mTempPath = DRIVE_ROOT . 'temp';

                if (file_exists($mTempPath) !== true) {
                    mkdir($mTempPath, 0777, true);
                }

                $oFile = $mTempPath . DS . $sFileName;

                // delete if image exist
                if (file_exists($oFile) !== false) {
                    unlink($oFile);
                }

                // resize image
                $sImageMimeType = mime_content_type($sFile);
                $mImageFile = $this->resizeImage($sFile, $iWidth, $iHeight, FALSE, $sType);

                // image builer
                $this->imageBuilderByType($mImageFile, $oFile, $sImageMimeType);

                // preview
                $fp = fopen($oFile, 'rb');
                header("Content-Type: " . $sImageMimeType . ";");
                header("Content-Length: " . filesize($oFile));
                header('Content-Transfer-Encoding: binary');
                header('Accept-Ranges: bytes');
                fpassthru($fp);
                fclose($fp);
                exit;

                break;

            default:

                die('Document type not supprted');
        }
    }

}
