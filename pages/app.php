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
    <?php echo $web->getHtmlHead(); ?>
</head>
<body style="background:#111111;">
    <?php echo $web->getGoogleAnalytics(); ?>
    <div style="background:#222222;">
        <div class="container-fluid container-main pd-vert-50-b ">
            Olovi kolome (3)
            <?php
                for ($i=0; $i < 100; $i++) {
                    echo $generation->getRandomUid();
                    echo "<br>";
                    echo $generation->getRandomUid(false);
                    echo "<br>";
                }
            ?>
        </div>
    </div>
    <div class="">

    </div>
</body>
</html>

<?php
}
?>
