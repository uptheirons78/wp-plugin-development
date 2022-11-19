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
    'supports' => array( 'title', 'editor', 'comments', 'thumbnail' ),
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

add_action( 'admin_init', 'ch3_br_admin_init' );

function ch3_br_admin_init()
{
  add_meta_box(
    'ch3_br_review_details_meta_box',
    'Book Review Details',
    'ch3_br_display_review_details_mb',
    'book_reviews',
    'normal',
    'high'
  );
}

function ch3_br_display_review_details_mb( $book_review )
{
  $book_author = get_post_meta( $book_review->ID, 'book_author', true);
  $book_rating = get_post_meta( $book_review->ID, 'book_rating', true);

  ?>
    <table>
      <tr>
        <td>Book Author</td>
        <td><input type="text" style="width: 100%;" name="book_review_author_name" value="<?php echo esc_html( $book_author ); ?>"></td>
      </tr>
      <tr>
        <td style="width: 150px;">Book Rating</td>
        <td>
          <select name="book_review_rating" style="width: 130px;">
            <option value="">Select rating</option>
            <?php for ( $rating = 5; $rating >= 1; $rating -- ) { ?>
              <option value="<?php echo intval( $rating ); ?>" <?php echo selected( $rating, $book_rating ); ?>"><?php echo intval( $rating ); ?> stars</option>
            <?php } ?>
          </select>
        </td>
      </tr>
    </table>
  <?php
}

add_action( 'save_post', 'ch3_br_add_book_review_fields', 10, 2);

function ch3_br_add_book_review_fields( $book_review_id, $book_review )
{
  if ( 'book_reviews' != $book_review->post_type ) {
    return;
  }

  if ( isset( $_POST[ 'book_review_author_name' ] ) ) {
    update_post_meta (
      $book_review_id,
      'book_author',
      sanitize_text_field( $_POST['book_review_author_name'] )
    );
  }

  if ( isset( $_POST[ 'book_review_rating' ] ) && !empty( $_POST['book_review_rating'] ) ) {
    update_post_meta (
      $book_review_id,
      'book_rating',
      intval( $_POST['book_review_rating'] )
    );
  }

}