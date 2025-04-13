<?php

// Cookie class
Class Cookie {
    // Get filekey from cookies
    public function getFilekey() {
        // Globals
        global $check;

        // If filekey is not given, check from cookies, else generate new
        if (!$filekey = $this->getCookie("filekey", false)) {
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

    // Get cookie values
    public function getCookie($param, $require = true) {
        if (!array_key_exists($param, $_COOKIE)) {
            if ($require) {
                new KjehError($this, "notset");
            }
            else {
                return false;
            }
        }

        if (strlen($_COOKIE[$param]) === 0) {
            if ($require) {
                new KjehError($this, "novalue");
            }
            else {
                return false;
            }
        }

        return $_COOKIE[$param];
    }

    public function setCookie($name, $value, $expire = 2000000000) {
        setcookie($name, $value, $expire);
    }
}

// Instantiate
$cookie = new Cookie;

?>
