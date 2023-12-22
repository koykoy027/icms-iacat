<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Settings_model extends CI_Model {

    public function getListContentByTable($sTableName) {

        $aResponse = [];

        $sql = "
        	SELECT 
        		*
        	FROM 
        		`" . $sTableName . "`
        ";

        $aResponse = $this->yel->GetAll($sql);

        return $aResponse;
    }

    public function addDatabyTableName($aParam) {
        $aResponse = [];

        $sql = "
        	INSERT
                    INTO 
                        `".$aParam['tbl_name']."`
                         (`".$aParam['clm_name_desc']."`, 
                          `is_active`)
                    VALUES
                        ('".$aParam['description']."', '".$aParam['is_active']."')
                    
                        
        ";

        $aResponse = $this->yel->exec($sql);

        return $aResponse;
    }
    
    public function setDatabyTableName($aParam) {
        $aResponse = [];

        $sql = "
        	UPDATE
                    `".$aParam['tbl_name']."`
                    SET
                        `".$aParam['clm_name_desc']."` = '".$aParam['description']."', 
                        `is_active` = '".$aParam['is_active']."'
                    WHERE
                        `".$aParam['clm_id']."` = ".$aParam['id']."
                    
                        
        ";

        $aResponse = $this->yel->exec($sql);

        return $aResponse;
    }


}
