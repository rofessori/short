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
            new Json("Virheellinen pyyntö!", false);
        }

        // Check from blacklist functions
        $blacklist = array("methodCall", "methodExists");
        if (in_array($method, $blacklist)) {
            new Json("Virheellinen pyyntö!", false);
        }
    }

    // Methods
    private function getUserCalendar() {
        $data = array(
            "tässä" => "on",
            "paljon" => "tietoa"
        );

        // Echo results
        new Json($data, true);
    }
}

// Instantiate
$ajax = new Ajax();

?>
