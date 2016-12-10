<?php

// Post class
Class Post {

    // If ajax requests
    public $isAjaxRequest;

    // Ajax construction
    public function __construct() {
        // Check if ajax request
        $this->isAjaxRequest = $this->isAjaxRequest();
    }

    // Check if request is ajax or not
    private function isAjaxRequest() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                return true;
                break;

            case 'GET':
                return false;
                break;

            default:
                $this->getError("requestmethod");
                break;
        }
    }

    // Get filekey from post variable
    public function getFilekey() {
        $filekey = $this->getParameter("filekey");
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

    private function getParameter($param) {
        if (!isset($_POST[$param])) {
            $this->getError("notset");
        }

        if (strlen($_POST[$param]) === 0) {
            $this->getError("novalue");
        }

        return $_POST[$param];
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
