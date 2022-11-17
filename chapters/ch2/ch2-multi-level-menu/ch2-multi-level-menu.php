<?php
/**
 * Plugin Name: CH2 - Multi Level Menu
 * Plugin URI:
 * Description: Create a multi-level menu inside WordPress administration panel
 * Version: 1.0
 * Author: Mauro Bono
 * Author URI: https://maurobono.com
 * License: GPLv2
 */
define('ch2mlm', 1);
define( 'MLM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

if (is_admin()) {
  require_once MLM_PLUGIN_DIR . 'ch2-multi-level-menu-admin-functions.php';
}