<?php

/**
 * Database Library 
 * - Sequel Action
 * - Sanitize 
 * - Encryption
 * 
 * @since 2017
 * @author Ebiz Developers
 */
class Yel {

    private $db; // * Query to perform
    private $query;  //query holder
    private $result; // Result holds data retrieved from server
    private $num_rows; // store the nos of rows in a result

    public function __construct() {

        // php config
        ini_set('memory_limit', '-1');

        // connect to database
        $this->con();
    }

    /**
     * Connect to Database with parameters
     */
    function con() {
        try {
            set_error_handler(array($this, 'errHandler'));
            $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . '; dbname=' . DB_NAME, DB_USER, DB_PASSWORD, array(
                PDO::ATTR_PERSISTENT => true,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));
            restore_error_handler();
            $this->state = true;

            // if(!empty($_SESSION['timezone']))
            // $this->db->exec("SET time_zone='".$_SESSION['timezoneoffset']."' ");
            if (!empty($_SESSION['timezone']))
                date_default_timezone_set($_SESSION['timezone']);
            if ($this->db === null) {
                echo "error";
            }
        } catch (PDOException $e) {
            // die('Please contact Yel . Thank you. #ERROR [ 404 ] ');
            echo 'Connection Failed: ' . $e->getMessage();
        }
    }

    /**
     * Error Handler
     * 
     * @param type $errno
     * @param type $errstr
     */
    public function errHandler($errno, $errstr) {
        // echo 'Error found';
    }

    /**
     * Sleep Database Process
     * 
     * @return array
     */
    public function __sleep() {
        return array('mysql:host=' . DB_HOST . '; dbname=' . DB_NAME, DB_USER, DB_PASSWORD);

        // do kill
        // $x = $this->db->GetAll("select concat('KILL ',id,';') as sleep from information_schema.processlist where `user` like 'abibaa_yel' AND `command` like 'SLEEP'");
        // foreach($x as $s){ $this->db->exec($s['sleep']); }
    }

    /**
     * Reconnect Database Process
     * 
     * @return array
     */
    public function __wakeup() {
        $this->con();
    }

    /**
     * Connect Database 
     */
    function connect() {
        if ($this->db == null) {
            $this->con();
        }
    }

    /**
     * Disconnect from database
     */
    function disconnect() {
        if ($this->db != null) {
            $this->db = null;
            unset($this->db);
        }
    }

    /**
     * Sanitize [ Strip HTML Tags ]
     * 
     * @param mixed $value
     * @return mixed
     */
    public function strip_html_tags($value) {
        $value = preg_replace(
                array(
            // Remove invisible content
            '@<head[^>]*?>.*?</head>@siu',
            '@<style[^>]*?>.*?</style>@siu',
            '@<script[^>]*?.*?</script>@siu',
            '@<object[^>]*?.*?</object>@siu',
            '@<embed[^>]*?.*?</embed>@siu',
            '@<applet[^>]*?.*?</applet>@siu',
            '@<noframes[^>]*?.*?</noframes>@siu',
            '@<noscript[^>]*?.*?</noscript>@siu',
            '@<noembed[^>]*?.*?</noembed>@siu'
                ), array(
            '', '', '', '', '', '', '', '', ''), $value);

        return strip_tags($value);
    }

    /**
     * Sanitize [ Fix page ] 
     * 
     * @param mixed $value
     * @return mixed
     */
    public function fix_page($value) {
        $value = htmlspecialchars(trim($value));
        if (get_magic_quotes_gpc())
            $value = stripslashes($value);
        return $value;
    }

    /**
     * Fix Encoding as htmlentities 
     * 
     * @param array $value
     * @return array $value
     */
    public function fix_html_entities($value) {

        array_walk_recursive($value, function(&$item) {
            $item = htmlentities($item);
        });
        return $value;
    }

    /**
     * Sanittize [ Fix Mysql Sequel ]
     * 
     * @param mixed $value
     * @return mixed
     */
    public function fix_mysql($value) {
        if (get_magic_quotes_gpc()) {
            $value = stripslashes($value);
        }
        //  $value = $this->db->real_escape_string(trim($value));
        return $value;
    }

    /**
     * Generate Transaction Key
     * 
     * @param string $value
     * return mixed
     */
    public function transaction_key($sValue) {
        $sValue = strtoupper(substr(sha1(md5(sha1(BASE_SALT) . sha1($sValue))), 2, 22));

        return $sValue;
    }

    /**
     * Sanitize [ Clean ]
     * 
     * @param mixed $value
     * @return mixed
     */
    public function clean($value) {
        $value = $this->strip_html_tags($value);
        $value = $this->fix_page($value);
        $bad = array("=", "<", ">", "/", "\"", "`", "~", "'", "$", "%", "#", "?", ".exe", "DROP", "DELETE", "SLEEP(", "truncate", "Truncate", "TRUNCATE");
        $value = str_ireplace($bad, "", $value);
        // $value = $this->fix_mysql($value);
        return $value;
    }

    /**
     * Sanitize [ Deep Clean ]
     * 
     * @param mixed $value
     * @return mixed
     */
    public function cln($value) {
        if (!empty($value)) {
            $value = $this->fix_page($value);
            $value = $this->strip_html_tags($value);
            $bad1 = array("=", "/", "\"", "`", "~", "'", "$", "%", "#", "?", "+"); // acceptable string
            foreach ($bad1 as $a) {
                $value = str_replace($a, "\\" . $a, $value);
            }
            $input = strtolower($value);
            $bad2 = array(";", "<", ">", ".exe", ".sh", "drop", "delete", "truncate",); // prohibited string
            foreach ($bad2 as $b) {
                if (strpos($input, $b) !== false) {
                    $flag = true;
                    break;
                }
            } if ($flag == true) {
                $value = '';
            }
        } else {
            $value = '';
        }
        return $value;
    }

    /**
     * Clean [ Soft Clean ]
     * 
     * @param mixed $value
     * @return mixed
     */
    public function clean_minor($value) {
        $value = $this->strip_html_tags($value);
        $value = $this->fix_page($value);
        $bad = array("=", "<s", "'", "$", "%", "?", ".exe", "DROP", "drop", "Drop", "DELETE", "Delete", "delete");
        $value = str_replace($bad, "", $value);
        //$value = $this->fix_mysql($value);
        return $value;
    }

    /**
     * Clean Array [ Soft Clean for an Array ]
     * 
     * @param array $aValue 
     * @param array $aExcept 
     * @return array $aNewValue
     */
    public function clean_array($aValue, $aExcept = null) {
        $aNewValue = array();

        if (is_array($aValue) === true && sizeof($aValue) > 0) {

            foreach ($aValue as $key => $val) {

                if (is_array($aExcept) !== false) {

                    if (sizeof($aExcept) > 0) {
                        if (in_array($key, $aExcept) === true) {
                            $aNewValue = array_merge($aNewValue, array($this->clean($key) => $this->clean_minor($val)));
                        } else {
                            $aNewValue = array_merge($aNewValue, array($this->clean($key) => $this->clean($val)));
                        }
                    } else {
                        $aNewValue = array_merge($aNewValue, array($this->clean($key) => $this->clean($val)));
                    }
                } else {
                    $aNewValue = array_merge($aNewValue, array($this->clean($key) => $this->clean($val)));
                }
            }
        }

        return $aNewValue;
    }

    /**
     * Clean Array Walk Recursive [ Soft Clean for an Array ] w/ utf8
     * 
     * @param array $aValue 
     * @param array $aExcept 
     * @return array $aNewValue
     */
    public function clean_array_walk_recursive($aNewValue) {
        array_walk_recursive($aNewValue, function(&$item) {
            $item = $this->clean_minor(utf8_encode($item));
        });

        return $aNewValue;
    }

    /**
     * Clean Array Recursive [ Soft Clean for an Array ]
     * 
     * @param array $aValue 
     * @param array $aExcept 
     * @return array $aNewValue
     */
    public function clean_array_recursive($aNewValue) {

        if (is_array($aNewValue) !== false) {
            array_walk_recursive($aNewValue, function(&$item) {
                $item = $this->clean($item);
            });

            return $aNewValue;
        } else {
            return $this->clean_array($aNewValue);
        }
    }

    /**
     * Fetch one rows in a result and store it as  array
     * 
     * @param string $sql
     * @return string
     */
    public function query($sql) {
        if (!empty($sql)) {
            $this->connect(); //connect to database
            try {
                // $this->vlookup($sql);
                $q = $this->db->prepare($sql);
                $q->execute();
                $q->setFetchMode(PDO::FETCH_ASSOC);
                $data = $q->fetchAll();

                return $data;
                //echo json_encode($data);
                $this->disconnect(); //disconnect from database
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        } else {
            return 'No query provided';
            die;
        }
    }

    /**
     * Execute Sequel
     * 
     * @param string $sql
     * @param string $foradmin
     * @return boolean|string
     */
    public function exec($sql, $foradmin = false) {
        if (!empty($sql)) {
            $this->connect(); //connect to database
            try {
                if (!$this->checkrestrictedwords($sql) || $foradmin || stristr($sql, 'sessionlogs')) {
                    // $this->vlookup($sql);
                    $q = $this->db->prepare($sql);
                    $q->execute();
                    if ($q->errorInfo()[0] == 0000) {
                        return array('stat' => $q->rowCount(), 'msg' => "Success :: " . $q->rowCount() . " as Affected rows.", 'insert_id' => $this->db->lastInsertId());
                    } else {
                        return "Error # : " . $q->errorInfo()[0] . " :: " . $q->errorInfo()[1] . "<br/>" . "Message :" . $q->errorInfo()[2];
                    }
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        } else {
            return 'No query provided';
            die;
        }
        $this->disconnect(); //disconnect from database
    }

    /**
     * Fetch one column
     * 
     * @param string $sql
     * @return string
     */
    public function GetOne($sql) {
        $this->connect(); //connect to database
        if (!empty($sql)) {
            try {
                $re = $this->db->prepare($sql);
                $re->execute();
                return $re->fetchColumn();
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        } else {
            return 'No query provided';
            die;
        }
        $this->disconnect(); //disconnect from database
    }

    /**
     * fetch one rows in a result and store it as an  object
     * 
     * @param string $sql
     * @return string
     */
    public function GetRow($sql) {
        if (!empty($sql)) {
            $this->connect(); //connect to database
            try {
                //	$this->vlookup($sql);
                //	$sql = str_replace("LIKE","=",$sql);
                $q = $this->db->prepare($sql);
                $q->execute();
                return (array) $q->fetch(PDO::FETCH_OBJ);
                $this->disconnect(); //disconnect from database
            } catch (PDOException $e) {
                return $e->getMessage();
            }
            $this->disconnect(); //disconnect from database
        } else {
            return 'No query provided';
            die;
        }
    }

    /**
     * Fetch all rows in a result to assoc_array
     * 
     * @param string $sql
     * @return string
     */
    public function GetAll($sql) {
        if (!empty($sql)) {
            $this->connect(); //connect to database
            try {
                $q = $this->db->prepare($sql);
                $q->execute();
                $q->setFetchMode(PDO::FETCH_ASSOC);
                $data = $q->fetchAll();

                return $data;
                //echo json_encode($data);
            } catch (PDOException $e) {
                return $e->getMessage();
            }
            $this->disconnect(); //disconnect from database
        } else {
            return 'No query provided';
            die;
        }
    }

    /**
     * Fetch one rows in a result and store it as an  object
     * 
     * @param string $sql
     * @return string
     */
    public function GetRowObject($sql) {

        if (!empty($sql)) {
            $this->connect(); //connect to database
            try {
                $q = $this->db->prepare($sql);
                $q->execute();
                return $q->fetch(PDO::FETCH_OBJ);
                $this->disconnect(); //disconnect from database
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        } else {
            return 'No query provided';
            die;
        }
    }

    /**
     * Get Max Value / ID
     * Hence, id should be present 
     * 
     * @param string $sTableName
     * @param string $sFieldName
     */
    public function GetMax($sTableName, $sFieldName) {

        if (!empty($sTableName) === true && !empty($sFieldName) === true) {

            // perform to get the latest id 
            $iId = $this->query("
                SELECT
                    MAX(`" . $sFieldName . "`) as ID
                FROM 
                `" . $sTableName . "`
                ");
            return $iId;
        } else {
            return 'No parameter provided';
            die;
        }
    }


    /**
     * String Encoding [ utf8_encode as default ] 
     * PHP 5.4 and above | JSON Compability
     * 
     * @param string|mixed $value
     * @param string $encoding
     * @return string|mixed
     */
    public function string_encoding($value, $encoding = 'utf8_encode') {

        // convert string encoding
        $value = $encoding($value);

        return $value;
    }

    /**
     * Convert all charset to utf8 
     * jsonEncodeArray
     * 
     * @param array $array
     * @return array $array
     */
    public function jsonEncodeArray($array) {
        array_walk_recursive($array, function(&$item) {
            $item = utf8_encode($item);
        });
        return $array;
    }

}
