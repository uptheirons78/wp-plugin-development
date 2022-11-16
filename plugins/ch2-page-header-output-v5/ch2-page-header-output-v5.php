<?php

/**
 * Plugin Name: CH2 - Page Header Output V5
 * Plugin URI:
 * Description: Output content in page Head. Version 5.
 * Version: 1.0
 * Author: Mauro Bono
 * Author URI: https://maurobono.com
 * License: GPLv2
 */

add_action('wp_head', 'ch2_page_header_output_v5');

function ch2_page_header_output_v5()
{
?>
  <script>
    (function(i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r;
      i[r] = i[r] || function() {
          (i[r].q = i[r].q || []).push(arguments)
        },
        i[r].l = 1 * new Date();
      a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m)
    })
    (window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-0000000-0', 'auto');
    ga('send', 'pageview');
  </script>
<?php
}

add_filter('the_content', 'ch2_link_filter_analytics_v5');

function ch2_link_filter_analytics_v5($the_content)
{
  $new_content = str_replace('href', 'onClick="recordOutboundLink( this ); return false;" href', $the_content);
  return $new_content;
}

add_action('wp_footer', 'ch2_footer_analytics_code_v5');

function ch2_footer_analytics_code_v5()
{
?>
  <script type="text/javascript">
    function recordOutboundLink(link) {
      ga('send', 'event', 'Outbound Links',
        'Click',
        link.href, {
          'transport': 'beacon',
          'hitCallback': function() {
            document.localtion = link.href;
          }
        }
      )
    }
  </script>
<?php
}


register_activation_hook(__FILE__, 'ch2_set_default_options_array_v5');

function ch2_set_default_options_array_v5()
{
  ch2_get_options_v5();
}

function ch2_get_options_v5()
{
  $options = get_option('ch2_pho_options', array());

  $new_options['ga_account_name'] = 'UA-0000000-0';
  $new_options['track_ongoing_links'] = false;

  $merged_options = wp_parse_args($options, $new_options);

  $compare_options = array_diff_key($new_options, $options);

  if (empty($options) || !empty($compare_options)) {
    update_option('ch2_pho_options', $merged_options);
  }

  return $merged_options;
}

// This WP action hook register a function to be called when WP
// is building the administration menu
add_action('admin_menu', 'ch2_settings_menu_v5', 1);

// This custom function make a call to add_options_page WP function
function ch2_settings_menu_v5()
{
  // this WP function add an item in Settings menu
  // Note: manage_options make it visible to WP users with administrative rights 😉
  add_options_page(
    'My Google Analytics Configuration',
    'My Google Analytics',
    'manage_options',
    'ch2-my-google-analytics',
    'ch2_ga_config_page'
  );
}

// Here start the upgrade to version 4 👇
function ch2_ga_config_page()
{
  // Retrieve plugin options from database with a ch2_get_options_v5 function defined above
  $options = ch2_get_options_v5();

?>
  <div id="ch2pho-general" class="wrap">
    <h2>My Google Analytics</h2><br />
    <form action="admin-post.php" method="post">
      <input type="hidden" name="action" value="save_ch2pho_options" />
      <!-- Adding hidden security referrer field -->
      <?php wp_nonce_field('ch2pho'); ?>
      Account Name: <input type="text" name="ga_account_name" value="<?php echo esc_html($options['ga_account_name']); ?>" /><br />
      Track Ongoing Links: <input type="checkbox" name="track_ongoing_links" id="track_ongoing_links" <?php checked( $options['track_ongoing_links'] ); ?> /><br /><br />
      <input type="submit" value="Submit" class="button-primary" />
    </form>
  </div>
<?php
}
