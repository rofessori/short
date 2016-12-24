<?php

// Require config
require_once("config.php");

// Error reporting
if ($config->debug->showerrors) {
    ini_set('display_errors', 1);
    error_reporting(~0);
}

// Require other core files
require_once("json.php");
require_once("error.php");
require_once("check.php");
require_once("cookie.php");
require_once("post.php");
require_once("database.php");
require_once("generation.php");
require_once("ajax.php");
require_once("file.php");
require_once("user.php");
require_once("web.php");


// Headers
if ($post->ajaxParams) {
    header('Content-Type: application/json');
}
else {
    header('Content-Type: text/html;');
}

?>
