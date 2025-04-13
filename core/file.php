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
            new KjehError($this, "nofound");
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
            new KjehError($this, "nofile");
        }

        // Check file upload errors
        switch ($file["error"]) {
            case 0:
                break;

            case 1:
            case 2:
                new KjehError($this, "toobig");

            case 3:
                new KjehError($this, "partial");

            case 4:
                new KjehError($this, "nofile");

            default:
                new KjehError($this, "upload");

        }

        // Check if file exists in temp folder
        if (!file_exists($file["tmp_name"])) {
            new KjehError($this, "nofile");
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
                new KjehError($this, "unique");
            }
        }

        // Get and check data
        if ($file["name"] === $ext = end((explode(".", $file["name"])))) {
            new KjehError($this, "invalid");
        }

        // Check ext
        $ext = $check->checkFileExtension($ext);
        $ext = $check->checkAlphanumeric($ext);

        $check->getStr($ext, 1, 30);

        if (!$size = $file["size"]) {
            new KjehError($this, "nofile");
        }

        // Add data to database
        if (!$database->addFile($user->id, $uid, $ext, $size)) {
            new KjehError($this, "nofile");
        }

        $path = $this->getFilePath($uid, $ext, false);
        $filepath = $this->getFilePath($uid, $ext);

        // Create folders
        if (!mkdir($path, 0777, true)) {
            new KjehError($this, "folder");
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
