<?php
// Rename this file to config.php

// Define vars for config
$vars = array(
    "database" => array(                // Database connection variables
        "host" => "localhost",          // Host address
        "username" => "root",            // Username
        "password" => "",                // Password
        "database" => "root"             // Database name
    )
);


// Config class
Class Config {
    // Config construction
    public function __construct($vars) {
        // Loop through variables given
        foreach ($vars as $key => $var) {
            // Define public variable if not array, else iterate
            $this->$key = (is_array($var)) ? new Config($var) : $var;
        }
    }
}


// Instantiate
$config = new Config($vars);

?>
