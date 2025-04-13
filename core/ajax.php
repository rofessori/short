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
            new KjehError($this, "invalid");
        }

        // Check from blacklist functions
        $blacklist = array("methodCall", "methodExists");
        if (in_array($method, $blacklist)) {
            new KjehError($this, "invalid");
        }
    }

    // Post new file
    public function postFile() {
        // Globals
        $file = new File;

        $payload = "https://kjeh.fi/" . $file->uid;

        new Json($payload, true);

    }
public function shortenUrl() {
    // 1. Gather the submitted URL
    $longUrl = trim($_POST['url'] ?? '');
    if (empty($longUrl)) {
        new KjehError($this, "No URL provided");
    }

    // 2. Validate the URL
    if (!filter_var($longUrl, FILTER_VALIDATE_URL)) {
        new KjehError($this, "Invalid URL format");
    }

    // 3. Generate a short UID (5 characters).
    //    You can use Generation::getRandomUid(false) or your own logic.
    require_once("generation.php");  // If not already required globally
    $gen = new Generation;
    $uid = $gen->getRandomUid(false); // false = don't treat as file, if you want digits possible.

    // 4. Insert into kjeh_urls table
    require_once("database.php"); // Adjust based on how your DB is included
    $db = Database::getInstance(); // or new Database() depending on your setup

    // Example using mysqli prepared statements
    $stmt = $db->prepare("INSERT INTO kjeh_urls (uid, userid, url, deleted) VALUES (?, ?, ?, 0)");
    $userid = 0;  // If you want to associate with a user, set accordingly
    $stmt->bind_param("sis", $uid, $userid, $longUrl);
    if (!$stmt->execute()) {
        new KjehError($this, "Database error: " . $stmt->error);
    }

    // 5. Return the short URL to front-end
    $shortUrl = "https://kjeh.fi/" . $uid;
    new Json($shortUrl, true);
}

public function getRedirect() {
    // 1. Read the uid from GET
    $uid = trim($_GET['uid'] ?? '');
    if (empty($uid)) {
        new KjehError($this, "No UID provided");
    }

    // 2. Fetch the long URL from the DB
    require_once("database.php");
    $db = Database::getInstance();

    $stmt = $db->prepare("SELECT url FROM kjeh_urls WHERE uid=? AND deleted=0 LIMIT 1");
    $stmt->bind_param("s", $uid);
    $stmt->execute();
    $stmt->bind_result($longUrl);

    if ($stmt->fetch() && !empty($longUrl)) {
        // 3. Redirect the browser to the original link
        header("Location: " . $longUrl);
        exit;
    } else {
        // If not found
        new KjehError($this, "UID not found or invalid");
    }
}
}

// Instantiate
$ajax = new Ajax;

?>
