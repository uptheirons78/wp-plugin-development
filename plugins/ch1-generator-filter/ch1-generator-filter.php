<?php
/**
 * Plugin Name: CH1 - Generator Filter
 * Plugin URI:
 * Description: A plugin to filter the generator meta tag
 * Version: 1.0
 * Author: Mauro Bono
 * Author URI: https://maurobono.com
 * License: GPLv2
 */

// Note how to let the function ch1_generator_filter accepts 2 parameters:
// $html and $type
add_filter('the_generator', 'ch1_generator_filter', 10, 2);

// With this function it is possible to filter the_generator output inside head
function ch1_generator_filter($html, $type)
{
  // first: check if the type is xhtml (html)
  if ($type == 'xhtml') {
    // if it is xhtml (html) replace the word "Wordpress.version" with desired output
    // inside the filtered html
    $html = preg_replace('("WordPress.*?")', '"Mauro Bono"', $html);
  }
  // in the end: return html (also if it is not type == xhtml)
  // Important: always remember to return it when using filters
  return $html;
}
