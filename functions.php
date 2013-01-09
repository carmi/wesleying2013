<?php
/**
 * Wesleying2 Theme - functions.php overrides
 *
 * This belongs in a child theme.
 *
 */



/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
  $content_width = 625;


function mytheme_dequeue_fonts() {
   wp_dequeue_style( 'twentytwelve-fonts' );
}
add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );


if ( ! function_exists( 'twentytwelve_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentytwelve_entry_meta() to override in a child theme.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_entry_meta() {
  // Translators: used between list items, there is a space after the comma.
  $categories_list = get_the_category_list( __( ', ', 'twentytwelve' ) );

  // Translators: used between list items, there is a space after the comma.
  $tag_list = get_the_tag_list( '', __( ', ', 'twentytwelve' ) );

  $date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a> at %5$s',
    esc_url( get_permalink() ),
    esc_attr( get_the_time() ),
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() ),
    esc_attr( get_the_time() )
  );

  $author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
    esc_attr( sprintf( __( 'View all posts by %s', 'twentytwelve' ), get_the_author() ) ),
    get_the_author()
  );

  // Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
  if ( is_single() ) {
    if ( $tag_list ) {
      $utility_text = __( 'Posted <span class="by-author"> by %4$s</span> in %1$s and tagged %2$s on %3$s.', 'twentytwelve' );
    } elseif ( $categories_list ) {
      $utility_text = __( 'Posted <span class="by-author"> by %4$s</span> in %1$s on %3$s.', 'twentytwelve' );
    } else {
      $utility_text = __( 'Posted <span class="by-author"> by %4$s</span> on %3$s.', 'twentytwelve' );
    }
  } else {
      $utility_text = __( 'Posted <span class="by-author"> by %4$s</span> on %3$s.', 'twentytwelve' );
  }

  printf(
    $utility_text,
    $categories_list,
    $tag_list,
    $date,
    $author
  );
}
endif;


// Customize 
add_filter( 'the_content_more_link', 'my_more_link', 10, 2 );

function my_more_link( $more_link, $more_link_text ) {
    return str_replace( $more_link_text, 'Continue reading &rarr;', $more_link );
}

function wrap_readmore($more_link)
{
    return '<div class="more-link">'.$more_link.'</div>';
}
add_filter('the_content_more_link', 'wrap_readmore', 10, 1);
