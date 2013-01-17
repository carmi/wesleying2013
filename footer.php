<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 */
?>
  </div><!-- #main .wrapper -->
  <footer id="colophon" role="contentinfo">
  <div class="site-info">
    <span><a href="<?php get_site_url(); ?>">Wesleying</a> is designed, powered<span title="Who gives a fuck about an oxford comma? Wesleying does.">,</span> and written by current Wesleyan students.<span>
        <?php wp_loginout(); ?>.
        <a href="#" class="back-to-top" title="Yes, a button that instantly takes you to the top is cool, however this does not mean we endorse the socially contructed 'top is better' hegemonic neoliberalist idealogy.">
          <button class="back-to-top">Top <i class="icon-double-angle-up"></i></button></a>
      </div><!-- .site-info -->
      </footer><!-- #colophon -->
    </div><!-- #page -->

    <?php wp_footer(); ?>
  </body>
</html>
