<?php

// Generation class
Class Generation {
    // Generate cryptographically secure pseudo random string
    public function getRandomString($len = 32) {
        // Generate pseudo random bytes and SHA512 hash
        $hash = hash('sha256', openssl_random_pseudo_bytes(32));

        // Cut hash to wanted length
        $cuthash = substr($hash, 0, $len);

        return $cuthash;
    }
}

// Instantiate
$generation = new Generation();

?>
