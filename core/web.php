<?php

// Web class
Class Web {

    public $kjeh;
    public $logourl;

    private $kjehlist = array(
        "Kjeh kjeh!",
        "Kjäh kjäh!",
        "Kjeh röh!",
        "==))",

        "Viinaa pittää juua!",
        "Töihin siitä!",
        "Saisit töihi mennä sinäki!",

        array("Top kjeh!",1),

        array("Mene töihin!",2),

        "https://kjeh.kjeh.fi/",
        "Olovi kolome (3)"
    );

    private $urllist = array(
        "kjeh",
        "top_kjeh",
        "mene_töihin"
    );

    // Web construction
    public function __construct() {
        // Get random kjeh
        $kjehobj = $this->kjehlist[rand() % count($this->kjehlist)];

        $this->kjeh = is_array($kjehobj) ? $kjehobj[0] : $kjehobj;
        $this->logourl = $this->urllist[is_array($kjehobj) ? $kjehobj[1] : 0];
    }

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
        <link rel="stylesheet" href="src/normalize.css">
        <link href="src/kjeh.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,400italic,700" rel="stylesheet" type="text/css">
        <script src="src/jquery-3.1.1.min.js"></script>
        <script src="src/tether.min.js"></script>
        <script src="src/bootstrap/js/bootstrap.min.js"></script>
        <script src="src/kjeh.js"></script>
        ';
    }

    // Html page header
    public function getHtmlHeader() {
        return '
        <div class="container-fluid container-main container-shadow pd-vert-50-b no-gutter"  style="background:#26282B; margin-top:20px;">
            <div class="col-xs-12 pd-vert-50-t no-gutter">
                <div class="center-block" style="display: table;">
                    <div class="col-xs-4 text-center">
                        <div class="center-block pd-side-10">
                            <a href="#Etusivu" class="nolink">
                                <img src="/src/img/' . $this->logourl . '.png" class="frontpage-logo" alt="Kjeh">
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-8">
                        <div class="center-block pd-side-10 text-center">
                            <p class="frontpage-header"><a href="#Etusivu" class="nolink">Kjeh.fi</a></p>
                            <p class="graytext">"' . $this->kjeh . '"</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }

    // Html page header
    public function getHtmlFooter() {
        return '
        <div class="pd-vert-50 graytext" style="width:100%;">
            <p class="inliner center-block graytext" style="display: table;"><a href="#Etusivu" class="shadowlink">Kjeh.fi - Kynä niska kloppi ompi tehny</a></p>
            <div class="inliner center-block pd-vert-20" style="display: table;">
                <div class="pd-side-20 inliner">
                    <a href="#Etusivu"><img src="/src/img/kjeh_bw.png" class="footer-logo" alt="Kjeh" title="Kjeh"></a>
                </div>
                <div class="pd-side-20 inliner">
                    <a href="https://github.com/Chatne/Kjeh/"><img src="/src/img/github.png" class="footer-logo" alt="GitHub" title="GitHub"></a>
                </div>
            </div>
            <p class="inliner center-block graytext" style="display: table;">© <a href="https://github.com/Chatne/" class="shadowlink" title="Kynä niska kloppi">Chatne</a> 2016</p>
            <a href="#Projekti" class="inliner center-block shadowlink" style="display: table;">Lisätiejot rojektista</a>
        </div>';
    }

    // Html page navbar
    public function getHtmlNavbar() {
        return '
        <div class="container-fluid navbar">
            <div class="container-main">
                <nav class="navbar text-center">
                    <button class="navbar-toggler hidden-sm-up nolink " type="button" data-toggle="collapse" data-target="#exCollapsingNavbar2" aria-controls="exCollapsingNavbar2" aria-expanded="false" aria-label="Toggle navigation">&#9776;</button>
                    <div class="collapse navbar-toggleable-xs" id="exCollapsingNavbar2">
                        <ul class="nav navbar-nav text-center">
                            <li class="nav-item active nav-item-container">
                                <a class="nav-link text-center nolink" href="#Etusivu">Etusivu</a>
                            </li>
                            <li class="nav-item nav-item-container">
                                <a class="nav-link text-center nolink" href="#Lataa">Lataa tiedostoja</a>
                            </li>
                            <li class="nav-item nav-item-container">
                                <a class="nav-link text-center nolink" href="#Lyhenna">Lyhennä osoitteita</a>
                            </li>
                            <li class="nav-item nav-item-container">
                                <a class="nav-link text-center nolink" href="#ShareX">ShareX-asetukset</a>
                            </li>
                            <li class="nav-item nav-item-container">
                                <a class="nav-link text-center nolink" href="#Hallitse">Tilin hallinta</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>';
    }

    // User data functions
    public function getFilekeyBar() {
        // Globals
        global $user;

        return '
        <div class="alert alert-kjeh-info">
            Tiedot tallentuvat tilille <b>' . $user->filekey . '</b>. Asetukset ja lisätiedot <a href="#Hallitse" class="nolink">hallinnasta</a>.
        </div>';

    }


}

// Instantiate
$web = new Web;

?>
