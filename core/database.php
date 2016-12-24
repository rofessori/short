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

    // Get file data with uid
    public function getFileByUid($uid, $userid) {
        // Query to select file data
       $query = "SELECT id, uid, filetype, filesize
                 FROM kjeh_files
                 WHERE uid = :uid AND userid = :userid AND deleted = 0;";

       // Prepare
       $stmt = $this->connection->prepare($query);
       $stmt->bindParam(':uid', $uid);
       $stmt->bindParam(':userid', $userid);

       // Execute
       if ($stmt->execute() === false) {
           new Error($this, "execution");
       }

       // Fetch
       $userinfo = $stmt->fetch(PDO::FETCH_ASSOC);

       return $userinfo;
    }

    // Get url with uid
    public function getUrlByUid($uid, $userid) {
        // Query to select url
       $query = "SELECT id, uid, url
                 FROM kjeh_urls
                 WHERE uid = :uid AND userid = :userid AND deleted = 0;";

       // Prepare
       $stmt = $this->connection->prepare($query);
       $stmt->bindParam(':uid', $uid);
       $stmt->bindParam(':userid', $userid);

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

    // Add new file
    public function addFile($userid, $uid, $ext, $size) {
        // Query to add work to database
        $query = "INSERT INTO kjeh_files (uid, userid, filetype, filesize)
                  VALUES (:uid, :userid, :filetype, :filesize);";

        // Prepare
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':userid', $userid);
        $stmt->bindParam(':uid', $uid);
        $stmt->bindParam(':filetype', $ext);
        $stmt->bindParam(':filesize', $size);

        // Execute
        if ($stmt->execute() === false) {
            new Error($this, "execution");
        }

        return ($stmt->rowCount());
    }

    // Add new url
    public function addUrl($userid, $uid, $url) {
        // Query to add work to database
        $query = "INSERT INTO kjeh_files (uid, userid, url)
                  VALUES (:uid, :userid, :url);";

        // Prepare
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':userid', $userid);
        $stmt->bindParam(':uid', $uid);
        $stmt->bindParam(':url', $url);

        // Execute
        if ($stmt->execute() === false) {
            new Error($this, "execution");
        }

        return ($stmt->rowCount());
    }


    // Update functions



    // Del functions


    // Chcek functions
    public function checkUid($uid, $file = true) {
        // Query to check if unique id is unique
        if ($file) {
            $query = "SELECT uid FROM kjeh_files WHERE uid = :uid;";
        }
        else {
            $query = "SELECT uid FROM kjeh_urls WHERE uid = :uid;";
        }

        // Prepare
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':uid', $uid);

        // Execute
        if ($stmt->execute() === false) {
            new Error($this, "execution");
        }

        return ($stmt->rowCount());
    }

}

// Instantiate
$database = new Database;

?>
