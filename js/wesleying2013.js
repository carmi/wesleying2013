jQuery(document).ready(function() {
    // initialization code goes here
    console.log("This was loaded");
    jQuery('div#featured-bar a').map(function() { return jQuery(this).data().postid });
});
