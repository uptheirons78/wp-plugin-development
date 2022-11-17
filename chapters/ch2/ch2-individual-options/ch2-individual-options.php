<?php
/**
 * Plugin Name: CH2 - Individual Options
 * Plugin URI:
 * Description: Store individual options data inside the database
 * Version: 1.0
 * Author: Mauro Bono
 * Author URI: https://maurobono.com
 * License: GPLv2
 */

// This hook is used to indicate WP to call a specific function when the plugin is activated
register_activation_hook( __FILE__, 'ch2_set_default_options' );

function ch2_set_default_options()
{
  // retrieve a specific option from wp_options table inside database (if it exists)
  $ga_account = get_option( 'ch2_ga_account_name' );
  // check if there is that specific option, and if not...
  if (!$ga_account ) {
    // ...add it to the wp_options table inside database
    add_option( 'ch2_ga_account_name', 'UA-0000000-0' );
  }
}