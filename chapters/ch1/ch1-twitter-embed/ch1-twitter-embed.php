<?php
/**
 * Plugin Name: CH1 - Twitter Embed
 * Plugin URI:
 * Description: Custom shortcode for embedding Twitter on posts or pages
 * Version: 1.0
 * Author: Mauro Bono
 * Author URI: https://maurobono.com
 * License: GPLv2
 */
add_shortcode( 'twitter_embed', 'ch1_twitter_embed_shortcode' );

function ch1_twitter_embed_shortcode( $atts )
{
  extract( shortcode_atts( array(
    'user_name' => 'UpTheIrons1978'
  ), $atts ) );

  if ( empty( $user_name ) ) {
    $user_name = 'UpTheIrons1978';
  } else {
    $user_name = sanitize_text_field( $user_name );
  }

  $user_link = 'https://twitter.com/' . $user_name;

  $output = '<p>';
  $output .= '<a href="' . $user_link . '" class="twitter-timeline">';
  $output .= 'Tweets by ' . esc_html( $user_name );
  $output .= '</a>';
  $output .= '<p>';
  $output .= '<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>';

  return $output;
}
