<?php

/**
 * Plugin Name: CH2 - Settings API
 * Plugin URL:
 * Description: A plugin that uses the Settings API
 * Version: 1.0
 * Author: Mauro Bono
 * Author URI: https://maurobono.com
 * License: GPLv2
 */
register_activation_hook(__FILE__, 'ch2api_set_default_options');

function ch2api_set_default_options()
{
  ch2api_get_options();
}

function ch2api_get_options()
{
  $options = get_option('ch2api_options', array());

  $new_options['ga_account_name'] = 'UA-0000000-0';
  $new_options['track_outgoing_links'] = false;
  $new_options['select_list'] = 'First';
  $new_options['ga_text_area'] = 'This is a test';

  $merged_options = wp_parse_args($options, $new_options);

  $compare_options = array_diff_key($new_options, $options);

  if (empty($options) || !empty($compare_options)) {
    update_option('ch2api_options', $merged_options);
  }

  return $merged_options;
}

add_action('admin_init', 'ch2api_admin_init');

function ch2api_admin_init()
{
  /**
   * Register a setting group with a validation function
   * so that post data handling is done automatically
   * for us
   */
  register_setting('ch2api_settings', 'ch2api_options', 'ch2api_validate_options');

  /**
   * Add a new settings section within the group
   */
  add_settings_section(
    'ch2api_main_section',
    'Main Settings',
    'ch2api_main_setting_section_callback',
    'ch2api_settings_section'
  );

  /**
   * Add each field with its name and function to
   * use for our new settings, put in new section
   */
  add_settings_field(
    'ga_account_name',
    'Account Name',
    'ch2api_display_text_field',
    'ch2api_settings_section',
    'ch2api_main_section',
    array('name' => 'ga_account_name')
  );

  add_settings_field(
    'track_outgoing_links',
    'Track Outgoing Links',
    'ch2api_display_check_box',
    'ch2api_settings_section',
    'ch2api_main_section',
    array('name' => 'track_outgoing_links')
  );

  add_settings_field(
    'select_list',
    'Select List',
    'ch2api_select_list',
    'ch2api_settings_section',
    'ch2api_main_section',
    array(
      'name' => 'select_list',
      'choices' => array('First', 'Second', 'Third')
    )
  );

  add_settings_field(
    'ga_text_area',
    'Big text field',
    'ch2api_display_text_area',
    'ch2api_settings_section',
    'ch2api_main_section',
    array('name' => 'ga_text_area')
  );
}

function ch2api_validate_options($input)
{
  foreach ( array('ga_account_name', 'select_list', 'ga_text_area') as $option_name ) {
    if (isset($input[$option_name])) {
      $input[$option_name] = sanitize_text_field($input[$option_name]);
    }
  }

  foreach (array('track_outgoing_links') as $option_name) {
    if (isset($input[$option_name])) {
      $input[$option_name] = true;
    } else {
      $input[$option_name] = false;
    }
  }

  return $input;
}

function ch2api_main_setting_section_callback()
{
?>
  <p>This is the main configuration section.</p>
<?php
}

function ch2api_display_text_field($data = array())
{

  extract($data);

  $options = ch2api_get_options();

?>
  <input type="text" name="ch2api_options[<?php echo esc_html($name); ?>]" value="<?php echo esc_html($options[$name]); ?>" /><br />
<?php

}

function ch2api_display_check_box($data = array())
{
  extract($data);
  $options = ch2api_get_options();
?>
  <input type="checkbox" name="ch2api_options[<?php echo esc_html($name); ?>]" <?php checked($options[$name]); ?> />
<?php
}

function ch2api_select_list( $data = array() )
{
  extract($data);
  $options = ch2api_get_options();
?>
  <select name='ch2api_options[<?php echo esc_html($name); ?>]'>
    <?php foreach ($choices as $item) { ?>
      <option value="<?php echo esc_html($item); ?>" <?php selected($options[$name] == $item); ?>><?php echo esc_html($item); ?></option>;
    <?php } ?>
  </select>
<?php
}

function ch2api_display_text_area( $data = array() )
{
  extract($data);
  $options = ch2api_get_options();
?>
  <textarea type='text' name='ch2api_options[<?php echo esc_html($name); ?>]' rows='5' cols='30'><?php echo esc_html($options[$name]); ?></textarea>
<?php
}

add_action('admin_menu', 'ch2api_settings_menu');

function ch2api_settings_menu()
{
  add_options_page(
    'My Google Analytics Configuration',
    'My Google Analytics - Settings API',
    'manage_options',
    'ch2api-my-google-analytics',
    'ch2api_config_page'
  );
}

function ch2api_config_page()
{
?>
  <div id="ch2api-general" class="wrap">
    <h2>My Google Analytics - Settings API</h2>

    <form name="ch2api_options_form_settings_api" method="post" action="options.php">

      <?php settings_fields('ch2api_settings'); ?>
      <?php do_settings_sections('ch2api_settings_section'); ?>

      <input type="submit" value="Submit" class="button-primary" />
    </form>
  </div>
<?php
}
