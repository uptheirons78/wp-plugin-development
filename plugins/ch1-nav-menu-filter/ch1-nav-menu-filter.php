<?php
/**
 * Plugin Name: CH1 - Nav Menu Filter
 * Plugin URI:
 * Description: A plugin to filter nav menu
 * Version: 1.0
 * Author: Mauro Bono
 * Author URI: https://maurobono.com
 * License: GPLv2
 */
add_filter( 'wp_nav_menu_objects', 'ch1_new_nav_menu_items', 10, 2);

function ch1_new_nav_menu_items( $sorted_menu_items, $args )
{
  if ( !is_user_logged_in() ) {
    foreach( $sorted_menu_items as $key => $sorted_menu_item) {
      if ( 'Private Area' == $sorted_menu_item->title) {
        unset( $sorted_menu_items[ $key ] );
      }
    }
  }

  return $sorted_menu_items;
}
