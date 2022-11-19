<?php

add_action('init', 'mbr_register_property_post_type');

function mbr_register_property_post_type()
{

  $labels = array(
    'name'               => esc_html__('Properties', 'mb-realtor'),
    'singular_name'      => esc_html__('Property', 'mb-realtor'),
    'add_new'            => esc_html__('Add New', 'mb-realtor'),
    'add_new_item'       => esc_html__('Add New Property', 'mb-realtor'),
    'edit'               => esc_html__('Edit', 'mb-realtor'),
    'edit_item'          => esc_html__('Edit Property', 'mb-realtor'),
    'new_item'           => esc_html__('New Property', 'mb-realtor'),
    'view'               => esc_html__('View', 'mb-realtor'),
    'view_item'          => esc_html__('View Property', 'mb-realtor'),
    'search_items'       => esc_html__('Search Properties', 'mb-realtor'),
    'not_found'          => esc_html__('No Properties Found', 'mb-realtor'),
    'not_found_in_trash' => esc_html__('No Properties Found in trash', 'mb-realtor'),
    'parent'             => esc_html__('Parent Property', 'mb-realtor'),
    'menu_name'          => esc_html__('Properties', 'mb-realtor'),
    'name_admin_bar'     => esc_html__('Property', 'mb-realtor'),
    'update_item'        => esc_html__('View Property', 'mb-realtor'),
    'all_items'          => esc_html__('All Properties', 'mb-realtor'),
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'menu_position' => 20,
    'supports' => array('title', 'editor', 'thumbnail'),
    'taxonomies' => array(''),
    'menu_icon' => 'dashicons-admin-home',
    'has_archive' => false,
    'exclude_from_search' => true,
    'rewrite' => array('slug' => 'properties', 'with_front' => false),
  );

  register_post_type('properties', $args);
}
