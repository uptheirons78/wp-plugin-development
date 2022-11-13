<?php

/**
 * Plugin Name: CH1 - Page Header Output
 * Plugin URI:
 * Description: Output content in page Head
 * Version: 1.0
 * Author: Mauro Bono
 * Author URI: https://maurobono.com
 * License: GPLv2
 */

add_action('wp_head', 'ch1_page_header_output');

function ch1_page_header_output()
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
    (window, document, 'script','https://www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-0000000-0', 'auto');
    ga('send', 'pageview');
  </script>
<?php
}
