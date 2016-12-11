<?php

// Generation class
Class Generation {
    // Generate cryptographically secure pseudo random string
    public function getRandomString($len = 32, $prettify = false) {
        // Generate pseudo random bytes and SHA512 hash
        $hash = hash('sha256', openssl_random_pseudo_bytes(32));

        // Cut hash to wanted length
        $hash = substr($hash, 0, $len);

        if ($prettify) {
            $hash = $this->strPrettify($hash);
        }

        return $hash;
    }

    public function strPrettify($str) {
        $old = "abcdef0123456789";
        $new = "aitneslokupvrjhy";

        $str = str_replace(str_split($old), str_split($new), $str);

        return $str;
    }
}

// Instantiate
$generation = new Generation();

?>
