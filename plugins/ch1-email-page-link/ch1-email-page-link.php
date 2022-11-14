<?php
/**
 * Plugin Name: CH1 - Email Page Link
 * Plugin URI:
 * Description: A plugin to email the page link to other people
 * Version: 1.0
 * Author: Mauro Bono
 * Author URI: https://maurobono.com
 * License: GPLv2
 */
add_filter('the_content', 'ch1_email_page_link');

function ch1_email_page_link( $the_content )
{
  $mail_icon_url = esc_url( plugins_url( 'mailicon.png', __FILE__ ) );
  $title = get_the_title();
  $permalink = get_permalink();

  $html = "
    <div class='email_link'>
    <a title='Email article link' href='mailto:someone@somewhere.com?subject=Check out this interesting article entitled: $title&body=Hi! %0A%0AYou might enjoy reading this article entitled: $title%0A%0A$permalink%0A%0AEnjoy!%0A%0AMauro Bono'>
    <img alt='Email icon' src='$mail_icon_url' />
    </a>
    </div>
  ";

  $new_content = $the_content . $html;

  return $new_content;
}
