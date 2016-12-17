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
            new Error($this, "connection");
        }
    }



    // Get funcitons

    // Get user id with filekey
    public function getUserByFilekey($filekey) {
        // Query to select user id
       $query = "SELECT id FROM kjeh_users WHERE filekey = :filekey";

       // Prepare
       $stmt = $this->connection->prepare($query);
       $stmt->bindParam(':filekey', $filekey);

       // Execute
       if ($stmt->execute() === false) {
           new Error($this, "execution");
       }

       // Fetch
       $userinfo = $stmt->fetch(PDO::FETCH_ASSOC);

       return $userinfo;
    }


    // Add functions

    // Add new user
    public function addUser($filekey) {
        // Query to add work to database
        $query = "INSERT INTO kjeh_users (filekey) VALUES (:filekey);";

        // Prepare
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':filekey', $filekey);

        // Execute
        if ($stmt->execute() === false) {
            new Error($this, "execution");
        }

        return ($stmt->rowCount());
    }



    // Update functions



    // Del functions

    

}

// Instantiate
$database = new Database;

?>
