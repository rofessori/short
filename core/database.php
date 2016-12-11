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
    public function getUserByFilekey($filekey) {
        // Query to select user id
       $query = "SELECT id FROM kjeh_users WHERE filekey = :filekey";

       // Prepare
       $stmt = $this->connection->prepare($query);
       $stmt->bindParam(':filekey', $filekey);

       // Execute
       if ($stmt->execute() === false) {
           return false;
       }

       // Fetch
       $userinfo = $stmt->fetch(PDO::FETCH_ASSOC);

       return $userinfo;
    }


    // Add functions
    public function addUser($filekey) {
        // Query to add work to database
        $query = "INSERT INTO kjeh_users (filekey) VALUES (:filekey);";

        // Prepare
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':filekey', $filekey);

        // Execute
        if ($stmt->execute() === false) {
            return false;
        }

        return ($stmt->rowCount());
    }

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
