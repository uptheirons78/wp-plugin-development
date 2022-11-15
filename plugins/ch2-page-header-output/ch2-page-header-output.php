<?php
/**
 * Plugin Name: CH2 - Page Header Output
 * Plugin URI:
 * Description: Output content in page Head. Version 2.
 * Version: 1.0
 * Author: Mauro Bono
 * Author URI: https://maurobono.com
 * License: GPLv2
 */

add_action( 'wp_head', 'ch2_page_header_output' );

function ch2_page_header_output()
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

add_filter( 'the_content', 'ch2_link_filter_analytics' );

function ch2_link_filter_analytics($the_content)
{
  $new_content = str_replace('href', 'onClick="recordOutboundLink( this ); return false;" href', $the_content);
  return $new_content;
}

add_action( 'wp_footer', 'ch2_footer_analytics_code' );

function ch2_footer_analytics_code()
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

// Here start the upgrade to version 1
register_activation_hook( __FILE__, 'ch2_set_default_options_array' );

function ch2_set_default_options_array()
{
  ch2_get_options();
}

function ch2_get_options()
{
  $options = get_option( 'ch2_pho_options', array() );

  $new_options['ga_account_name'] = 'UA-0000000-0';
  $new_options['track_ongoing_links'] = false;

  $merged_options = wp_parse_args( $options, $new_options );

  $compare_options = array_diff_key( $new_options, $options );

  if ( empty( $options ) || !empty( $compare_options ) ) {
      update_option( 'ch2_pho_options', $merged_options );
  }

  return $merged_options;
}