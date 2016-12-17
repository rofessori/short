<?php

// Post class
Class Post {

    // If ajax requests
    public $ajaxParams;

    // Ajax construction
    public function __construct() {
        // Check if ajax request
        $this->ajaxParams = $this->getAjaxParams();
    }

    // Check if request is ajax or not
    private function getAjaxParams() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                return $_POST;
                break;

            case 'GET':
                if (isset($_GET["method"])) {
                    return $_GET;
                }
                return false;
                break;

            default:
                new Error($this, "requestmethod");
                break;
        }
    }

    // Get filekey from post variable
    public function getFilekey() {
        // Globals
        global $check;

        // If filekey is not given, check from cookies, else generate new
        if (!$filekey = $this->getParameter("filekey", false)) {
            return false;
        }

        // Check key length
        if (!$filekey = $check->getStr($filekey, 32, 32, false)) {
            return false;
        }

        // Check key characters
        if (!$check->checkKey($filekey, false)) {
            return false;
        }

        return $filekey;
    }

    // Get method from post variable
    public function getMethod() {
        $method = $this->getParameter("method");

        return $method;
    }

    // Get parameter
    private function getParameter($param, $require = true) {
        if (!isset($this->ajaxParams[$param])) {
            if ($require) {
                new Error($this, "notset");
            }
            else {
                return false;
            }
        }

        if (strlen($this->ajaxParams[$param]) === 0) {
            new Error($this, "novalue");
        }

        return $this->ajaxParams[$param];
    }



    // Get errorcode
    public function getErrorCode() {
        return (isset($_GET["errorcode"]) ? $_GET["errorcode"] : false);
    }
}

// Instantiate
$post = new Post;

?>
