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

    // Character replacement
    public function strPrettify($str) {
        $old = "abcdef0123456789";
        $new = "aitneslokupvrjhy";

        $str = str_replace(str_split($old), str_split($new), $str);

        return $str;
    }

    // Generate uid
    public function getRandomUid($file = true) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

        // Get uid array
        $uidarr = [];

        // Generate 5 random characters
        for ($i = 0; $i < 5; $i++) {
            // If not file, first one is number
            if (!$i && !$file) {
                $uidarr[] = rand() % 10;
                continue;
            }
            $uidarr[] = $chars[rand() % strlen($chars)];
        }

        // Shuffle
        shuffle($uidarr);

        // Get uid str
        $uid = implode($uidarr);

        return $uid;

    }


}

// Instantiate
$generation = new Generation;

?>
