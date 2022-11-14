<?php
/**
 * Plugin Name: CH1 - Private Item Text
 * Plugin URI:
 * Description: Custom shortcode for creating private text
 * Version: 1.0
 * Author: Mauro Bono
 * Author URI: https://maurobono.com
 * License: GPLv2
 */
add_shortcode( 'private', 'ch1_private_shortcode' );

function ch1_private_shortcode( $atts, $content = null )
{
  if ( is_user_logged_in() ) {
    return '<div class="pit-private">' . $content . '</div>';
  } else {
    $output = '<div class="pit-register">';
    $output .= 'You need to become a member to access this content.';
    $output .= '</div>';

    return $output;
  }
}

add_action( 'wp_enqueue_scripts', 'ch1_pit_enqueue_styles');

function ch1_pit_enqueue_styles()
{
  wp_enqueue_style( 'private_shortcode_styles', plugins_url( 'style.css', __FILE__ ) );
}
