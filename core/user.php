<?php

// User class
Class User {

    private $filekey;
    private $id;

    // Construct user
    public function __construct() {

        // Globals
        global $database;
        global $post;

        // Get filekey
        $this->filekey = $post->getFilekey();

        // Check if user exists
        while (!$userid = $database->getUserByFilekey($this->filekey)) {
            # No user, create one
            $database->addUser($this->filekey);
        }

        // Set userid
        $this->userid = $userid;

        // If not ajax, nothing to do anymore
        if (!$ajax->active) {
            return True;
        }

        // Get method
        $method = $post->getMethod();

        // Call method
        $ajax->methodCall($method);

    }

    // Error printer
    private function getError($type) {
        switch ($type) {

            default:
                $error = "Tuntematon käyttäjävirhe!";
                break;
        }

        // Print error
        new Json($error, false);
    }
}

?>
