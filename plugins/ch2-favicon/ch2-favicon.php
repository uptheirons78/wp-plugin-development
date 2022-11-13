<?php
/**
 * Plugin Name: Chapter 2 - Favicon
 * Plugin URI:
 * Description: Add a website favicon
 * Version: 1.0
 * Author: Mauro Bono
 * Author URI: https://maurobono.com
 * License: GPLv2
 */
add_action('wp_head', 'ch2_add_favicon_in_header');

function ch2_add_favicon_in_header()
{
  // Check if user added a custom favicon via customizer
  $site_icon_url = get_site_icon_url();
  // if there is a favicon added by user display the site icon meta tag
  if ( !empty($site_icon_url) ) {
    wp_site_icon();
  } else {
    // else grab the favicon in our plugin directory
    // and display it with the following html tag inside head
    $icon = plugins_url( 'favicon.ico', __FILE__ );
    ?>
      <link rel="shortcut icon" href="<?php echo esc_url( $icon ); ?>" type="image/x-icon">
    <?php
  }
}