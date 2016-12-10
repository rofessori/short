<?php

// Database class
Class Database {
    // Connection variable
    private $connection;

    // Construct connection
    public function __construct() {
        // Globals
        global $config;

        // Try to create database connection, echo errors if fail then exit app
        try {
            $this->connection = new PDO(
                'mysql:host=' . $config->database->host . ';dbname=' . $config->database->database,
                $config->database->username,
                $config->database->password,
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                )
            );

        }
        catch(PDOException $e) {
            $this->getError("connection");
        }
    }



    // Get funcitons

    // Add functions

    // Update functions

    // Del functions



    // Error printer
    private function getError($type) {
        switch ($type) {
            case "connection":
                $error = "Yhteyttä tietokantapalvelimeen ei voitu muodostaa!";
                break;

            case "execution":
                $error = "Toimintoa ei voitu suorittaa tietokantavirheen vuoksi!";
                break;

            default:
                $error = "Tuntematon tietokantavirhe!";
                break;
        }

        // Print error
        new Json($error, false);
    }
}

// Instantiate
$database = new Database;

?>
