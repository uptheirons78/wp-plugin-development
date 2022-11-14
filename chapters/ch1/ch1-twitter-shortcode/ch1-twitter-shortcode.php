<?php
/**
 * Plugin Name: CH1 - Twitter Shortcode
 * Plugin URI:
 * Description: Custom shortcode for Twitter
 * Version: 1.0
 * Author: Mauro Bono
 * Author URI: https://maurobono.com
 * License: GPLv2
 */
add_shortcode( 'twitter_feed', 'ch1_twitter_link_shortcode' );

function ch1_twitter_link_shortcode( $atts )
{
  $twitter_link = 'https://twitter.com/UpTheIrons1978';

  $output = '<a href="' . esc_url( $twitter_link ) . '">';
  $output .= 'Twitter Feed</a>';

  return $output;
}