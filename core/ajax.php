<?php

// Ajax class
Class Ajax {
    // Ajax method calling
    public function methodCall($method) {
        // Check if method exists
        $this->methodExists($method);

        // Call method
        $this->$method();
    }

    // Method checker
    private function methodExists($method) {
        if (!method_exists($this, $method)) {
            new Error($this, "invalid");
        }

        // Check from blacklist functions
        $blacklist = array("methodCall", "methodExists");
        if (in_array($method, $blacklist)) {
            new Error($this, "invalid");
        }
    }

    // Methods
    public function getRedirect() {

    }

    // Post new file
    public function postFile() {
        // Globals
        $file = new File;

        $payload = "https://kjeh.fi/" . $file->uid;

        new Json($payload, true);

    }
}

// Instantiate
$ajax = new Ajax;

?>
