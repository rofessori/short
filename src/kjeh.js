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

$("#urlshortenbutton").on("click", function() {
  let longUrl = $("#urlshorten-textarea").val().trim();
  if (!longUrl) {
    alert("Please enter a URL!");
    return;
  }
  $.ajax({
    type: "POST",
    url: "/pages/app.php?method=shortenUrl",
    data: { url: longUrl },
    success: function(response) {
      // response should be the short URL
      $("#urllink-textarea").val(response);
      // Switch the subtab from input to result, etc.
    },
    error: function() {
      alert("Shortening failed!");
    }
  });
});
