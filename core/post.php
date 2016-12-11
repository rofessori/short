<?php

// Post class
Class Post {

    // If ajax requests
    public $ajaxParams;

    // Ajax construction
    public function __construct() {
        // Check if ajax request
        $this->ajaxParams = &$this->getAjaxParams();
    }

    // Check if request is ajax or not
    private function &getAjaxParams() {
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
                $this->getError("requestmethod");
                break;
        }
    }

    // Get filekey from post variable
    public function getFilekey() {
        // Globals
        global $generation;

        // If filekey is not given, generate new onw
        if (!$filekey = $this->getParameter("filekey", false)) {
            $filekey = $generation->getRandomString(32, true);
        }

        // Check key length
        $filekey = $this->getStr($filekey, 32, 32);

        return $filekey;
    }

    // Get method from post variable
    public function getMethod() {
        $method = $this->getParameter("method");

        return $method;
    }

    // Format checking functions
    private function getStr($str, $minlen = NULL, $maxlen = NULL) {
        if (!is_string($str)) {
            $this->getError("wrongtype");
        }

        if (!is_null($minlen) && $minlen > strlen($str)) {
            $this->getError("tooshort");
        }

        if (!is_null($maxlen) && $maxlen < strlen($str)) {
            $this->getError("toolong");
        }

        return $str;
    }

    private function getInt($int, $min = NULL, $max = NULL) {
        if (!ctype_digit($int)) {
            $this->getError("wrongtype");
        }

        $int = intval($int);

        if (!is_null($min) && $min > $int) {
            $this->getError("toosmall");
        }

        if (!is_null($max) && $max < $int) {
            $this->getError("toolarge");
        }

        return $int;
    }

    private function getParameter($param, $require = true) {
        if (!isset($this->ajaxParams[$param])) {
            if ($require) {
                $this->getError("notset");
            }
            else {
                return false;
            }
        }

        if (strlen($this->ajaxParams[$param]) === 0) {
            $this->getError("novalue");
        }

        return $this->ajaxParams[$param];
    }

    // Error printer
    private function getError($type) {
        switch ($type) {
            case "requestmethod":
                $error = "Virheellinen pyyntö!";
                break;

            case "notset":
                $error = "Tarvittavaa parametria ei annettu!";
                break;

            case "novalue":
                $error = "Parametrilla ei ole arvoa!";
                break;

            case "wrongtype":
                $error = "Parametrin arvo on väärää muotoa!";
                break;

            case "toolong":
                $error = "Parametrin arvo on liian pitkä!";
                break;

            case "tooshort":
                $error = "Parametrin arvo on liian lyhyt!";
                break;

            case "toolarge":
                $error = "Parametrin arvo on liian suuri!";
                break;

            case "toosmall":
                $error = "Parametrin arvo on liian pieni!";
                break;

            default:
                $error = "Tuntematon parametrivirhe!";
                break;
        }

        // Print error
        new Json($error, false);
    }
}

// Instantiate
$post = new Post;

?>
