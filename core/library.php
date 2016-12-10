<?php

// Require core files
require_once("config.php");
require_once("json.php");
require_once("post.php");
require_once("database.php");
require_once("generation.php");
require_once("ajax.php");
require_once("user.php");

// Error reporting
if ($config->debug->showerror) {
    ini_set('display_errors', 1);
    error_reporting(~0);
}

// Headers
if ($post->isAjaxRequest) {
    header('Content-Type: application/json');
}
else {
    header('Content-Type: text/html;');
}


?>
