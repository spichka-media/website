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

// This will remove the default image sizes and the medium_large size.
add_filter('intermediate_image_sizes_advanced', function ($sizes) {
  unset($sizes['small']); // 150px
  unset($sizes['medium']); // 300px
  unset($sizes['medium_large']); // 768px
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
            ['?', ',', ':', ';', '.', '&nbsp;', '!'],
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

//----------------------------------------------------------/
//  responsive images [ 1) add img-responsive class 2) remove dimensions ]
//----------------------------------------------------------/

function bootstrap_responsive_images($html)
{
  $classes = 'img-responsive'; // separated by spaces, e.g. 'img image-link'

  // check if there are already classes assigned to the anchor
  if (preg_match('/<img.*? class="/', $html)) {
    $html = preg_replace(
      '/(<img.*? class=".*?)(".*?\/>)/',
      '$1 ' . $classes . ' $2',
      $html
    );
  } else {
    $html = preg_replace(
      '/(<img.*?)(\/>)/',
      '$1 class="' . $classes . '" $2',
      $html
    );
  }
  // remove dimensions from images,, does not need it!
  $html = preg_replace('/(width|height)=\"\d*\"\s/', '', $html);
  return $html;
}
add_filter(
  'the_content',
  function ($html) {
    return bootstrap_responsive_images($html);
  },
  10
);
add_filter(
  'post_thumbnail_html',
  function ($html) {
    return bootstrap_responsive_images($html);
  },
  10
);
