<?php
// Require library
require_once("../core/library.php");

// If ajax, execute method
if ($post->ajaxParams) {
    // Get method
    $method = $post->getMethod();

    // Call method
    $ajax->methodCall($method);
}
// Else, load html
else {
?>

<!DOCTYPE html>
<html>
<head>

</head>
<body>
    
</body>
</html>

<?php
}
?>
