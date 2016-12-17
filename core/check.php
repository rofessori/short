<?php

// Check class
Class Check {

    // Format checking functions

    public function getStr($str, $minlen = NULL, $maxlen = NULL, $require = true) {
        if (!is_string($str)) {
            if ($require) {
                new Error($this, "wrongtype");
            }
            else {
                return false;
            }
        }

        if (!is_null($minlen) && $minlen > strlen($str)) {
            if ($require) {
                new Error($this, "tooshort");
            }
            else {
                return false;
            }
        }

        if (!is_null($maxlen) && $maxlen < strlen($str)) {
            if ($require) {
                new Error($this, "toolong");
            }
            else {
                return false;
            }
        }

        return $str;
    }

    public function getInt($int, $min = NULL, $max = NULL, $require = true) {
        if (!ctype_digit($int)) {
            if ($require) {
                new Error($this, "wrongtype");
            }
            else {
                return false;
            }
        }

        $int = intval($int);

        if (!is_null($min) && $min > $int) {
            if ($require) {
                new Error($this, "toosmall");
            }
            else {
                return false;
            }
        }

        if (!is_null($max) && $max < $int) {
            if ($require) {
                new Error($this, "toolarge");
            }
            else {
                return false;
            }
        }

        return $int;
    }

    public function checkKey($key, $require = true) {
        $allowed = "aitneslokupvrjhy";
        foreach (str_split($key) as $char) {
            if (strpos($allowed, $char) === false) {
                if ($require) {
                    new Error($this, "wrongtype");
                }
                else {
                    return false;
                }
            }
        }
        return true;
    }

}

// Instantiate
$check = new Check;

?>
