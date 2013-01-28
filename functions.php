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


// Customize the read more link
add_filter( 'the_content_more_link', 'my_more_link', 10, 2 );

function my_more_link( $more_link, $more_link_text ) {
    return str_replace( $more_link_text, 'Continue reading &rarr;', $more_link );
}

function wrap_readmore($more_link)
{
    return '<div class="more-link">'.$more_link.'</div>';
}
add_filter('the_content_more_link', 'wrap_readmore', 10, 1);

// Disable custom backgrounds
function remove_custom_background_theme() {
    global $_wp_theme_features;
    unset($_wp_theme_features['custom-background']);
}
add_action('after_setup_theme', 'remove_custom_background_theme', 11);


// Functions used in header.php to get first_image of featured posts
/*
 * first_image()
 * return the first image or an empty string for a given post
 * Note: does not handle default images here
 */
function featured_post_image() {
  global $post, $posts;
  $img_url = "";
  ob_start();
  ob_end_clean();

  if (empty($post)) return;
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $match = $matches[1];


  // Find Youtube Videos IDS from URLs
  $search = '%          # Match any youtube URL in the wild.
      (?:https?://)?    # Optional scheme. Either http or https
      (?:www\.)?        # Optional www subdomain
      (?:               # Group host alternatives
        youtu\.be/      # Either youtu.be,
      | youtube\.com    # or youtube.com
        (?:             # Group path alternatives
          /embed/       # Either /embed/
        | /v/           # or /v/
        | /watch\?v=    # or /watch\?v=
        )               # End path alternatives.
      )                 # End host alternatives.
      ([\w\-]{10,12})   # Allow 10-12 for 11 char youtube id.
      \b                # Anchor end to word boundary.
      %x';

    $output = preg_match_all($search, $post->post_content, $youtube_matches);

    $use_photon = true;


    if (has_post_thumbnail($post->ID)) {
      $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'single-post-thumbnail' );
      $img_url = $thumb['0'];
    } elseif (!empty($match)) {
      $img_url = $match[0];
    } elseif (!empty($youtube_matches)) {
      $use_photon = false;
      $youtube_match = $youtube_matches[1][0];
      $img_url = 'http://img.youtube.com/vi/'.$youtube_match.'/mqdefault.jpg';
    } else {
      $img_url = get_bloginfo("stylesheet_directory")."/images/no-featured-image.jpg";
    }

    //return $img_url;
    // Hack to use Photon API for these images
    // http://i2.wp.com/dev.wesleying.org/wp-content/uploads/2013/01/wesleying.jpg?w=230

    if ($use_photon) {
      $img_url = str_replace( 'http://', '', $img_url );
      return "http://i2.wp.com/".$img_url."?w=230";
    }
    return $img_url;

}
add_action('wp_head', 'featured_post_image');

/*
 * Build category-flyer html for a given post
 */
function build_category_flyer ( $post ) {
  $category = $icon = $title = $desc = '';
  if ( has_category( 'featured', $post ) ) {
    $category = 'featured';
    $icon = "icon-star-empty";
    $title = "This is a featured post";
    $desc = "FEATURED";
  } elseif ( has_category( 'events', $post ) ) {
    $category = 'events';
    $icon = "icon-calendar";
    $title = "This is an event post";
    $desc = "EVENT";
  } elseif ( has_category( 'music', $post ) ) {
    $category = 'music';
    $icon = "icon-music";
    $title = "This is a music post";
    $desc = "MUSIC";
  }

  return sprintf('<div class="category-tag %s" title="%s"><a href="%s"><i class="%s"></i> %s</a></div>',
    $category,
    $title,
    get_category_link( get_cat_ID($category) ),
    $icon,
    $desc);
}
add_action('wp_head', 'build_category_flyer');


function add_search_box($items, $args) {

        ob_start();
        get_search_form();
        $searchform = ob_get_contents();
        ob_end_clean();

        $items .= '<li class="searchform"><div class="searchbox">' . $searchform . '</div></li>';

    return $items;
}
add_filter('wp_nav_menu_items','add_search_box', 10, 2);

/**
 * I want to use the basic 2012 theme but don't want TinyMCE to create
 * unwanted HTML. By removing editor-style.css from the $editor_styles
 * global, this code effectively undoes the call to add_editor_style()
 * http://wordpress.org/support/topic/strange-behaviour-making-lists-in-the-visual-editor?replies=8#post-3760332
 */
add_action( 'after_setup_theme', 'foobar_setup', 11 );
function foobar_setup() {
  global $editor_styles;
  $editor_styles = array();
}
