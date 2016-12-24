<?php

// File class
Class File {

    public $id;
    public $uid;
    public $ext;
    public $path;
    public $size;

    // Construct file
    public function __construct($uid = NULL) {
        // Globals
        global $user;
        global $database;

        // If new file
        $this->uid = $uid ? $uid : $this->addFile();

        // Get data from database
        if (!$data = $database->getFileByUid($this->uid, $user->id)) {
            new Error($this, "nofound");
        }

        // Set data
        $this->id = $data["id"];
        $this->ext = $data["filetype"];
        $this->size = $data["filesize"];
        $this->path = $this->getFilePath($this->uid, $this->ext);

    }

    // Add new file
    private function addFile() {
        // Globals
        global $database;
        global $user;
        global $generation;
        global $check;

        // Get file variable
        if (!$file = isset($_FILES["file"]) ? $_FILES["file"] : false) {
            new Error($this, "nofile");
        }

        // Check file upload errors
        switch ($file["error"]) {
            case 0:
                break;

            case 1:
            case 2:
                new Error($this, "toobig");

            case 3:
                new Error($this, "partial");

            case 4:
                new Error($this, "nofile");

            default:
                new Error($this, "upload");

        }

        // Check if file exists in temp folder
        if (!file_exists($file["tmp_name"])) {
            new Error($this, "nofile");
        }


        // Generate new unique uid
        for ($fail = 0;; $fail++) {
            $uid = $generation->getRandomUid();

            // Check if unique
            if (!$database->checkUid($uid)) {
                break;
            }

            // If not unique over 5 times
            if ($fail > 4) {
                new Error($this, "unique");
            }
        }

        // Get and check data
        if ($file["name"] === $ext = end((explode(".", $file["name"])))) {
            new Error($this, "invalid");
        }

        // Check ext
        $ext = $check->checkFileExtension($ext);
        $ext = $check->checkAlphanumeric($ext);

        $check->getStr($ext, 1, 30);

        if (!$size = $file["size"]) {
            new Error($this, "nofile");
        }

        // Add data to database
        if (!$database->addFile($user->id, $uid, $ext, $size)) {
            new Error($this, "nofile");
        }

        $path = $this->getFilePath($uid, $ext, false);
        $filepath = $this->getFilePath($uid, $ext);

        // Create folders
        if (!mkdir($path, 0777, true)) {
            new Error($this, "folder");
        }

        // Move file
        move_uploaded_file($file["tmp_name"], $filepath);

        // Return uid
        return $uid;

    }

    public function deleteFile() {

    }

    public function checkExistance() {

    }

    public function transferFile($target) {

    }

    // Get filepath
    private function getFilePath($uid, $ext, $includefile = true) {
        $path = "../files/" . substr($uid, 0, 2) . "/" . $uid . "/";
        $filename = $uid . "." . $ext;

        return ($includefile) ? $path . $filename : $path;
    }

}

?>
