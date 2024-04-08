<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
  return sprintf(
    ' &hellip; <a href="%s">%s</a>',
    get_permalink(),
    __('Read more')
  );
});

/**
 * Filters the navigation markup template.
 * Compatible with Bootstrap 5.
 *
 * @param  string $template The default template.
 * @return string           The navigation markup.
 */

add_filter(
  'navigation_markup_template',
  function ($template) {
    return str_replace(
      '"navigation %1$s"',
      '"navigation %1$s" role="navigation"',
      $template
    );
  },
  10,
  2
);
