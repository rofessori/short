// Tab data
var tabData = {
    "Etusivu":"frontpage",
    "Lataa":"fileupload",
    "Lyhenna":"urlshorten",
    "ShareX":"sharex",
    "Hallitse":"control",
    "Projekti":"project"
};

$(document).ready(function() {
    // Handle tabs
	$(window).on('hashchange',function(event) {
		tabHashCheck();
	});

    tabHashCheck();
});

function tabHashCheck() {
    var hash = window.location.hash;
    var hashfail = false;
    if (hash == undefined || hash.length == 0) {
        hashfail = true;
    }
    else if (hash == "") {
        return true;
    }
    else {
        hash = hash.substr(1);
    }

    if (hashfail == false && tabData[hash] == undefined) {
        hashfail = true;
    }
    else {
        var tab = tabData[hash];
    }

    if (hashfail == true) {
        var tab = "frontpage";
        window.location.hash = "";
    }

    $(".tab-container > div").hide();
    $("#tab-" + tab).show();
}
