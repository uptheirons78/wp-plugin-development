<?php
/**
 * Plugin Name: MB Realtor
 * Plugin URI: https://maurobono.com
 * Description: This plugin add a 'Property' custom post type to your WordPress website and allows Realtors or Real Estate * Agents to show and list their properties portfolio.
 * Version: 1.0
 * Author: Mauro Bono
 * Author URI: https://maurobono.com
 * Text Domain: mb-realtor
 * License: GPLv2
 */

define( 'MBREALTOR_VERSION', '1.0' );

define( 'MBREALTOR_PLUGIN', __FILE__ );

define( 'MBREALTOR_PLUGIN_BASENAME', plugin_basename( MBREALTOR_PLUGIN ) );

define( 'MBREALTOR_PLUGIN_NAME', trim( dirname( MBREALTOR_PLUGIN_BASENAME ), '/' ) );

define( 'MBREALTOR_PLUGIN_DIR', untrailingslashit( dirname( MBREALTOR_PLUGIN ) ) );

include_once MBREALTOR_PLUGIN_DIR . '/includes/property-post-type.php';
include_once MBREALTOR_PLUGIN_DIR . '/includes/property-post-type-meta-boxes.php';