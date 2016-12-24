<?php

// Web class
Class Web {
    // Google Analytics
    public function getGoogleAnalytics() {
        return "<script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-73022175-4', 'auto');
          ga('send', 'pageview');

        </script>";
    }

    // Html head
    public function getHtmlHead() {
        return '
        <title>Kjeh.fi</title>
        <meta charset="utf-8">

        <link rel="apple-touch-icon" sizes="57x57" href="/src/icon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/src/icon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/src/icon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/src/icon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/src/icon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/src/icon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/src/icon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/src/icon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/src/icon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/src/icon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/src/icon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/src/icon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/src/icon/favicon-16x16.png">

        <link rel="manifest" href="/src/icon/manifest.json">

        <meta name="msapplication-TileColor" content="#101010">
        <meta name="msapplication-TileImage" content="/src/icon/ms-icon-144x144.png">
        <meta name="msapplication-config" content="/src/img/logo/browserconfig.xml">
        <meta name="msapplication-navbutton-color" content="#101010">

        <meta name="theme-color" content="#101010">

        <meta name="apple-mobile-web-app-status-bar-style" content="#101010">

        <link href="src/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="src/font-awesome.min.css">
        <link href="src/kjeh.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,400italic,700" rel="stylesheet" type="text/css">
        <script src="src/jquery-3.1.1.min.js"></script>
        <script src="src/tether.min.js"></script>
        <script src="src/bootstrap/js/bootstrap.min.js"></script>
        <script src="src/kjeh.js"></script>
        ';
    }

}

// Instantiate
$web = new Web;

?>
