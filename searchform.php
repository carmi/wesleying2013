<?php
/**
 * The template for displaying search forms
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" >
  <div>
    <label class="screen-reader-text" for="s">Search for:</label>
    <input type="search" value="<?php echo get_search_query() ?>" name="s" id="s" placeholder="Search" />
    <button type="submit" id="searchsubmit" value="Search"><i class="icon-search"></i></button>
  </div>
</form>
