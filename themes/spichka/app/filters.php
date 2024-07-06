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

add_filter(
  'nav_menu_css_class',
  function ($classes, $item, $args) {
    $classes[] = 'nav-item';
    return $classes;
  },
  1,
  3
);

add_filter('wp_nav_menu', function ($ulСlass) {
  return preg_replace('/<a /', '<a class="nav-link fw-medium"', $ulСlass);
});

// Remove unused image sizes
add_filter('intermediate_image_sizes', function ($sizes) {
  $targets = [
    'thumbnail',
    'medium',
    'medium_large',
    'large',
    '1536x1536',
    '2048x2048',
  ];

  foreach ($sizes as $size_index => $size) {
    if (in_array($size, $targets)) {
      unset($sizes[$size_index]);
    }
  }

  return $sizes;
});

/**
 * Automatically add IDs to headings such as <h2></h2>
 */

add_filter('the_content', function ($content) {
  $content = preg_replace_callback(
    '/(\<h[1-6](.*?))\>(.*)(<\/h[1-6]>)/i',
    function ($matches) {
      if (!stripos($matches[0], 'id=')):
        $id = sanitize_text_field(
          str_replace(
            ['?', ',', ':', ';', '.', '&nbsp;', '!', '*', '&nbsp'],
            '',
            str_replace([' '], '-', $matches[3])
          )
        );
        $matches[0] =
          $matches[1] .
          $matches[2] .
          ' id="' .
          $id .
          '">' .
          $matches[3] .
          $matches[4];
      endif;
      return $matches[0];
    },
    $content
  );

  return $content;
});

add_filter('wp_calculate_image_sizes', function ($sizes) {
  $sizes =
    '(max-width: 576px) 200px, (min-width: 577px) and (max-width: 767px) 500px, (min-width: 768px) 900px';

  return $sizes;
});
