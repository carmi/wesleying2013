<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7 | IE 8]>
<html class="ie" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
<script src="<?php echo get_bloginfo('stylesheet_directory'); ?>/js/wesleying2013.js" type="text/javascript"></script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
  <header id="masthead" class="site-header" role="banner">

    <?php $header_image = get_header_image();
    if ( ! empty( $header_image ) ) : ?>

      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" title="<?php bloginfo( 'description' ); ?>" alt="" /></a>
    <?php endif; ?>

<?php /*
    <hgroup>
    <?php $tagline =  get_bloginfo('description');
    if ( ! empty ( $tagline ) ) : ?> 
      <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
    <?php endif; ?>
    </hgroup>
 */ ?>

    <nav id="site-navigation" class="main-navigation" role="navigation">
      <h3 class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></h3>
      <div class="skip-link assistive-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a></div>
      <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
    </nav><!-- #site-navigation -->

    <div id="featured-bar">  
        <ul id="carousel">  
            <?php
            $featured_posts = get_posts('numberposts=4&category=12290');
            foreach( $featured_posts as $post ) {
                $image = featured_post_image();
                ?>
                  <li><a href="<?php echo get_permalink($post->ID) ?>" title="<?php echo $post->post_title ?>" data-postid="<?php echo $post->ID ?>">
                  <i class="icon-arrow-down featured-post-bar"></i>
                  <span class="featured-post-title"><?php echo $post->post_title ?></span>
                  <img src="<?php echo $image ?>" alt="<?php echo $post->post_title ?>" />
                </a></li>
          <?php 
            }
            ?>
        </ul>
        <div class="clear"></div>
    </div>

  </header><!-- #masthead -->

  <div id="main" class="wrapper">
