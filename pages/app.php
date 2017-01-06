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
<body style="background:#181A1F;">
    <?php echo $web->getGoogleAnalytics(); ?>
    <?php echo $web->getHtmlHeader(); ?>
    <?php echo $web->getHtmlNavbar(); ?>

    <div class="container-fluid container-main container-shadow no-gutter" style="background:#26282B;">
        <div class="col-xs-12 pd-side-35 pd-vert-35 tab-container">

            <!-- Tabs !-->

            <div id="tab-frontpage" style="display: none;">
                <div class="col-xs-12 col-md-6">
                    <h2 style="border-left:10px solid #5C7072; padding-left:20px;">täyte tekstijä</h2>
                    <div class="col-xs-12" style="padding-left:30px;">
                        <p>Tämmöstä työ ukon ommaa täyte tekstijä,,, =) vähä piristystä päevään kjhe kejh</p>
                        <p>-- liirum laarum ---</p>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <h2 style="border-left:10px solid #5C7072; padding-left:20px;">Oispa olvi III (3)</h2>
                    <div class="col-xs-12" style="padding-left:30px;">
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                    </div>
                </div>
            </div>

            <div id="tab-fileupload" style="display: none;">
                <?php echo $web->getFilekeyBar(); ?>
                Lataa
            </div>

            <div id="tab-urlshorten" style="display: none;">
                <?php echo $web->getFilekeyBar(); ?>
                Url
            </div>

            <div id="tab-sharex" style="display: none;">
                <?php echo $web->getFilekeyBar(); ?>
                ShareX
            </div>

            <div id="tab-control" style="display: none;">

            </div>

            <div id="tab-project" style="display: none;">
                Projekti
            </div>

        </div>
    </div>


    <?php echo $web->getHtmlFooter(); ?>
</body>
</html>

<?php
}
?>
