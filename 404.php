<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 */
$descriptions = array("hip", "cool", "underground", "sick", "rad", "wicked");
$adj = array_rand($descriptions, 1);
get_header(); ?>

  <div id="primary" class="site-content">
    <div id="content" role="main">

      <article id="post-0" class="post error404 no-results not-found">
        <header class="entry-header">
        <h1 class="entry-title">This page is so <?php echo $descriptions[$adj] ?> it doesn't even exist yet!</h1>
        </header>

        <div class="entry-content">
          <p>Perhaps searching will lead you to a page that does exist.</p>
          <?php get_search_form(); ?>
        </div><!-- .entry-content -->
      </article><!-- #post-0 -->

    </div><!-- #content -->
  </div><!-- #primary -->

<?php get_footer(); ?>
