<?php

/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Form Validation
 * Assertion of Entries
 *
 * version 1.0.0
 * @author : LBS eBusiness
 */
class Assert {

    // constants
    const SUCCESS = 1;
    const FAILED = 0;
    const MATCHED = 1;
    const UNMATCHED = 0;

    // create new object | load yel framework
    private $yel;

    public function __construct() {

        // load yel for sanitization
        $this->yel = new Yel();
    }

    /**
     * Get Log Message
     *
     * @param string $sMessageID
     * @return string $aLogMessage
     */
    private function getMessage($sMessageID, $aAdds = null) {

        $aLogMessage = '';

        switch ($sMessageID) {
            case '_improperRules':
                $aLogMessage = "Improper Rules";
                break;

            case '_improperParam':
                $aLogMessage = "Improper Param";
                break;

            case '_incompleteInputs';
                $aLogMessage = "Incomplete  Parameters";
                break;


            case '_incorrectInputs':
                $aLogMessage = "Incorrect  Parameters";
                break;

            case '_passed':
                $aLogMessage = "Passed";
                break;

            case '_success':
                $aLogMessage = "Success";
                break;

            case '_failed':
                $aLogMessage = "Failed";
                break;

            default:
                $aLogMessage = 'Wrong Entry';
                break;
        }


        return $aLogMessage;
    }

    /**
     * Prepare for Expression
     *
     * @param mixed $mEntry
     * @return mixed $mEntry
     */
    private function forExpression($mEntry) {
        $mEntry = $this->yel->clean(trim($mEntry));
        return $mEntry;
    }

    /**
     * Validate Entry
     *
     * @param mixed $mValue
     * @param string $sRule
     * @return array $aResponse
     */
    private function validateEntry($mValue = null, $sRule = null) {

        // initialize
        $aResponse = [];

        // display rule
        $aResponse['rule'] = $sRule;
        $aResponse['status'] = self::FAILED;

        switch ($sRule) {

            case 'required':
            case 'should':
            case 'must':

                if (!empty($mValue) !== false) {
                    $aResponse['status'] = self::SUCCESS;
                }

                break;

            case 'email':

                if (filter_var($mValue, FILTER_VALIDATE_EMAIL) !== false) {
                    $aResponse['status'] = self::SUCCESS;
                }

                break;


            case 'link':
            case 'url':
            case 'valid_url':

                // Remove all illegal characters from a url
                $url = filter_var($mValue, FILTER_SANITIZE_URL);

                // validate
                if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
                    $aResponse['status'] = self::SUCCESS;
                }

                break;


            case stristr($sRule, 'min_length'):

                preg_match_all("/\\[(.*?)\\]/", $sRule, $matches);
                if (!empty($matches[1][0])) {
                    $iLength = (int) $matches[1][0];

                    if (strlen($mValue) >= $iLength) {
                        $aResponse['status'] = self::SUCCESS;
                    }
                }

                break;

            case stristr($sRule, 'max_length'):

                preg_match_all("/\\[(.*?)\\]/", $sRule, $matches);
                if (!empty($matches[1][0])) {
                    $iLength = (int) $matches[1][0];

                    if (strlen($mValue) <= $iLength) {
                        $aResponse['status'] = self::SUCCESS;
                    }
                }

                break;

            case stristr($sRule, 'required_length'):

                preg_match_all("/\\[(.*?)\\]/", $sRule, $matches);
                if (!empty($matches[1][0])) {
                    $iLength = (int) $matches[1][0];

                    if (strlen($mValue) == $iLength) {
                        $aResponse['status'] = self::SUCCESS;
                    }
                }

                break;

            case 'numeric':

                if (is_int((int) $mValue) !== false) {
                    $aResponse['status'] = self::SUCCESS;
                }

                break;

            case 'alpha':

                if (ctype_alpha($mValue) !== false) {
                    $aResponse['status'] = self::SUCCESS;
                }

                break;

            case 'alphanumeric':

                if (ctype_alnum($mValue) !== false) {
                    $aResponse['status'] = self::SUCCESS;
                }

                break;

            case 'valid_ip':

                if (filter_var($mValue, FILTER_VALIDATE_IP) !== false) {
                    $aResponse['status'] = self::SUCCESS;
                }


                break;
        }


        return $aResponse;
    }

    /**
     * Do Validation via Rules Parameters
     *
     * @param mixed $mValue
     * @param array $aRules
     * @return array $aResponse
     */
    private function setValidate($mField = null, $mValue = null, $aRules = null) {

        // initialize
        $aResponse = [];

        // prepare
        $i = 0;
        $s = 0;

        // default
        $sStatus = self::FAILED;

        // console
        $aResponse['field'] = $mField;
        $aResponse['value'] = $mValue;

        if (is_array($aRules) !== false) {

            /**
             * FOR ARRAY ENTRIES
             */
            // do seperate validation for array
            foreach ($aRules as $k => $r) {

                // for expression
                $sRule = $this->forExpression($r);

                // non array
                if (!empty($sRule) !== false) {

                    // validate
                    $aResponse['rules'][$i] = $this->validateEntry($mValue, $sRule);

                    // increment

                    $s = $s + (int) $aResponse['rules'][$i]['status'];
                    $i++;
                }
            }

            // pass to all checking
            if ($s == $i) {
                $sStatus = self::SUCCESS;
            }

            $aResponse['status'] = $sStatus;
        } else {

            /**
             * NON ARRAY | STRING TO ARRAY
             */
            // for expression
            $sRule = $this->forExpression($aRules);

            // re change to array
            $aFlexRules = explode("|", $sRule);


            // do seperate validation for array
            foreach ($aFlexRules as $k => $r) {

                // for expression
                $sRule = $this->forExpression($r);

                // non array
                if (!empty($sRule) !== false) {

                    // validate
                    $aResponse['rules'][$i] = $this->validateEntry($mValue, $sRule);

                    // increment

                    $s = $s + (int) $aResponse['rules'][$i]['status'];
                    $i++;
                }
            }

            // pass to all checking
            if ($s == $i) {
                $sStatus = self::SUCCESS;
            }

            $aResponse['status'] = $sStatus;


            /**
              // non array
              if (!empty($sRule) !== false) {

              // validate
              $aResponse['rules'] = $this->validateEntry($mValue, $sRule);
              $aResponse['status'] = $aResponse['rules']['status'];
              }
             */
        }

        return $aResponse;
    }

    /**
     * Form Validate
     *
     * @param array $aParam
     * @param array $aRules
     * @return array $aResponse
     */
    public function formValidate($aParam = null, $aRules = null) {

        $aResponse = [];

        // basis [ flag ]
        $aResponse['flag'] = self::FAILED;


        // validate rules
        if (is_array($aRules) !== true) {
            $aResponse['log'] = $this->getMessage('_improperRules');
            return $aResponse;
        }

        // validate rules
        if (is_array($aParam) !== true) {
            $aResponse['log'] = $this->getMessage('_improperParam');
            return $aResponse;
        }

        // initialize
        $i = 0;
        $ctrVF = 0;
        $ctrEF = 0;
        $aResponse['assert'] = [];

        // initial
        // consider failed on top
        $aResponse['assert']['validate']['status'] = self::FAILED;
        $aResponse['assert']['exist']['status'] = self::FAILED;

        $aResponse['status'] = $this->getMessage('_failed');
        $aResponse['message'] = $this->getMessage('_incorrectInputs');
        // $aResponse['debug'] = $aParam;

        foreach ($aRules as $f => $r) {

            // $aResponse['assert'][$i]['field'] = $f;
            // $aResponse['assert'][$i]['rules'] = $r;

            $aResponse['assert']['exist']['simulation'][$i]['status'] = self::UNMATCHED;

            if (array_key_exists($this->forExpression($f), $aParam) !== false) {
                $aResponse['assert']['exist']['simulation'][$i]['status'] = self::MATCHED;

                // set validate
                $aResponse['assert']['validate']['simulation'][$i] = $this->setValidate($f, $aParam[$f], $r);

                // increment $ctr if failed response found
                if ($aResponse['assert']['validate']['simulation'][$i]['status'] == self::FAILED) {
                    $ctrVF++;
                }
            } else {
                $ctrEF++;
            }


            // increament
            $i++;
        }

        // incomplete parameters
        if ($ctrEF != 0) {

            $aResponse['status'] = $this->getMessage('_failed');
            $aResponse['message'] = $this->getMessage('_incompleteInputs');

            return $aResponse;
        } else {
            $aResponse['assert']['exist']['status'] = self::SUCCESS;
        }


        // determine everything goes well
        if ($ctrVF == 0) {

            // status
            $aResponse['assert']['validate']['status'] = self::SUCCESS;

            // msg
            $aResponse['status'] = $this->getMessage('_success');
            $aResponse['message'] = $this->getMessage('_passed');

            // flag
            $aResponse['flag'] = self::SUCCESS;
        }

        return $aResponse;
    }

}
