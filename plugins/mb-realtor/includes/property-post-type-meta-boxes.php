<?php
/**
 * Register Meta Box with Custom Fields
 */
add_action('admin_init', 'mbr_admin_init');

function mbr_admin_init()
{
  add_meta_box(
    'mbr_details_meta_box',
    esc_html__('Property Details', 'mb-realtor'),
    'mbr_display_details_meta_box',
    'properties',
    'normal',
    'high'
  );
}

function mbr_display_details_meta_box($property)
{
  $property_price = get_post_meta($property->ID, 'meta-box-property-price', true);
  $property_state = get_post_meta($property->ID, 'meta-box-property-state', true);
?>
  <table>
    <tr>
      <td><?php esc_html_e('Property Price', 'mb-realtor'); ?></td>
      <td>
        <input style="width: 100%;" type="text" name="meta-box-property-price" value="<?php echo intval($property_price); ?>" />
      </td>
    </tr>
    <tr>
      <td><?php echo esc_html_e('Property State', 'mb-realtor'); ?></td>
      <td>
        <input style="width: 100%;" type="text" name="meta-box-property-state" value="<?php echo esc_html($property_state); ?>" />
      </td>
    </tr>
  </table>
<?php
}

add_action('save_post', 'mbr_add_property_fields', 10, 2);

function mbr_add_property_fields($property_id, $property)
{
  if (!current_user_can("edit_post", $property_id)) {
    return $property_id;
  }

  if (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) {
    return $property_id;
  }

  $slug = "properties";

  if ($slug != $property->post_type) {
    return $property_id;
  }

  $meta_box_property_price = "";
  $meta_box_property_state = "";

  if (isset($_POST["meta-box-property-price"])) {
    $meta_box_property_price = intval($_POST["meta-box-property-price"]);
  }
  update_post_meta($property_id, "meta-box-property-price", intval($meta_box_property_price));

  if (isset($_POST["meta-box-property-state"])) {
    $meta_box_property_state = sanitize_text_field($_POST["meta-box-property-state"]);
  }
  update_post_meta($property_id, "meta-box-property-state", sanitize_text_field($meta_box_property_state));
}
