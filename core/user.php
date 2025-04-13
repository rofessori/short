<?php

// User class
Class User {

    public $filekey;
    public $id;

    // Construct user
    public function __construct() {

        // Globals
        global $database;
        global $post;
        global $ajax;
        global $generation;
        global $cookie;

        // Get filekey
        $postkey = $post->getFilekey();
        $cookiekey = $cookie->getFilekey();

        // If both false
        if (!$postkey && !$cookiekey) {
            $this->filekey = $generation->getRandomString(32, true);
        }
        // If postkey is true
        else if ($postkey) {
            $this->filekey = $postkey;
        }
        // If cookiekey is true
        else {
            $this->filekey = $cookiekey;
        }

        // Set cookie if not set
        if (!$cookiekey) {
            $cookie->setCookie("filekey", $this->filekey);
        }



        // Check if user exists
        while (!$userdata = $database->getUserByFilekey($this->filekey)) {
            // No user, create one
            $database->addUser($this->filekey);
        }

        // Set userid
        $this->id = $userdata["id"];
    }
}

// Instantiate
$user = new User;

?>
