jQuery(document).ready(function() {
    // initialization code goes here
    console.log("This was loaded!");
    //jQuery('div#featured-bar a').map(function() { return jQuery(this).data().postid });
    
    // hijack featured post links
    jQuery('div#featured-bar a').click(function(event) {
      var $link = jQuery(this);
      var postid = $link.data().postid;
      var $article = jQuery('article#post-'+postid);
      // see if the article exists on the page
      if($article.length != 0) {
        event.preventDefault();
        jQuery('html, body').animate({
          scrollTop: $article.offset().top
        }, 1000);
      }
    });
});
