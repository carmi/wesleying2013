jQuery(document).ready(function() {
    // hijack featured post links
    var scrollDuration = 500;
    jQuery('div#featured-bar a').click(function(event) {
      var $link = jQuery(this);
      var postid = $link.data().postid;
      var $article = jQuery('article#post-'+postid);
      // see if the article exists on the page
      if($article.length != 0) {
        event.preventDefault();
        jQuery('html, body').animate({
          scrollTop: $article.offset().top
        }, scrollDuration);
      }
    });
});
