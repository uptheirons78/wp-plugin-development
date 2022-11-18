<?php
/**
 * Plugin Name: CH3 - Book Reviews
 * Plugin URI:
 * Description: This plugin create a custom post type for book reviews with different features
 * Version: 1.0
 * Author: Mauro Bono
 * Author URI: https//maurobono.com
 * License: GPLv2
 */

add_action( 'init', 'ch3_br_create_book_post_type' );

function ch3_br_create_book_post_type()
{
  $menu_icon = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>';

  $labels = array(
    'name'               => 'Book Reviews',
    'singular_name'      => 'Book Review',
    'add_new'            => 'Add New',
    'add_new_item'       => 'Add New Book Review',
    'edit'               => 'Edit',
    'edit_item'          => 'Edit Book Review',
    'new_item'           => 'New Book Review',
    'view'               => 'View',
    'view_item'          => 'View Book Review',
    'search_items'       => 'Search Book Reviews',
    'not_found'          => 'No Book Reviews Found',
    'not_found_in_trash' => 'No Book Reviews Found In Trash',
    'parent'             => 'Parent Book Review',
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'menu_position' => 20,
    'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields' ),
    'taxonomies' => array( '' ),
    'menu_icon' => 'data:image/svg+xml;base64,' . base64_encode( $menu_icon ),
    'has_archive' => false,
    'exclude_from_search' => true,
    // if you want to use Gutenberg use show_in_rest => true
    // 'show_in_rest' => true,
    'rewrite' => array( 'slug' => 'best-book-reviews' ),
  );

  register_post_type( 'book_reviews', $args );
}