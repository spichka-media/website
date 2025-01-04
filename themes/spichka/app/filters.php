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

  $content = str_replace(
    '<figure class="wp-block-table">',
    '<figure class="wp-block-table table-responsive">',
    $content
  );

  $content = str_replace(
    '<table>',
    '<table class="table table-bordered table-striped">',
    $content
  );

  $content = str_replace('<thead>', '<thead class="table-dark">', $content);

  return $content;
});

add_filter('wp_calculate_image_sizes', function ($sizes) {
  $sizes =
    '(max-width: 576px) 200px, (min-width: 577px) and (max-width: 767px) 500px, (min-width: 768px) 900px';

  return $sizes;
});

add_filter('publishpress_authors_load_style_in_frontend', function () {
  return false;
});

add_filter('get_search_form', function () {
  return \Roots\view('partials.searchform');
});

// Algolia search
function wds_algolia_custom_fields($attributes, $post)
{
  return array_intersect_key(
    $attributes,
    array_flip([
      'post_title',
      'content',
      'post_id',
      'taxonomies',
      'post_excerpt',
      'taxonomies_hierarchical',
    ])
  );
}

add_filter(
  'algolia_post_shared_attributes',
  function ($attributes, $post) {
    return wds_algolia_custom_fields($attributes, $post);
  },
  10,
  2
);

add_filter(
  'algolia_searchable_post_shared_attributes',
  function ($attributes, $post) {
    return wds_algolia_custom_fields($attributes, $post);
  },
  10,
  2
);

add_filter(
  'algolia_should_index_searchable_post',
  function ($should_index, $post) {
    return $should_index && in_array($post->post_type, ['post', 'note']);
  },
  10,
  2
);

add_filter(
  'algolia_searchable_posts_index_settings',
  function () {
    return [
      'searchableAttributes' => [
        'unordered(post_title)',
        'unordered(taxonomies)',
        'unordered(content)',
        'unordered(post_excerpt)',
        'unordered(taxonomies_hierarchical)',
      ],
      'attributeForDistinct' => 'post_id',
      'distinct' => true,
      'attributesToSnippet' => ['post_title:30', 'content:30'],
      'snippetEllipsisText' => '…',
    ];
  },
  10,
  0
);

add_filter('rest_authentication_errors', function ($result) {
  // If a previous authentication check was applied,
  // pass that result along without modification.
  if (true === $result || is_wp_error($result)) {
    return $result;
  }

  $excluded_routes = ['/wp-json/custom-fields/theme_options'];

  $current_route = isset($_SERVER['REQUEST_URI'])
    ? $_SERVER['REQUEST_URI']
    : '';

  foreach ($excluded_routes as $excluded_route) {
    if (strpos($current_route, $excluded_route) !== false) {
      return $result;
    }
  }

  // No authentication has been performed yet.
  // Return an error if user is not logged in.
  if (!is_user_logged_in()) {
    return new \WP_Error(
      'rest_not_logged_in',
      __('You are not currently logged in.'),
      ['status' => 401]
    );
  }

  // Our custom authentication check should have no effect
  // on logged-in requests
  return $result;
});

add_filter('xmlrpc_enabled', '__return_false');

add_filter('get_the_archive_title_prefix', function ($prefix) {
  if (is_post_type_archive()) {
    return '';
  }
  return $prefix;
});

/**
 * You can filter the list of URLs that get purged by Cloudflare after a post is
 * modified by implementing a filter for the "cloudflare_purge_by_url" hook.
 *
 * @Example:
 *
 * /**
 *  * @param array $urls A list of post related URLs
 *  * @param integer $post_id the post ID that was modified
 *  * /
 * function your_cloudflare_url_filter($urls, $post_id) {
 *   // modify urls
 *   return $urls;
 * }
 */
add_filter(
  'cloudflare_purge_by_url',
  function ($urls, $post_id) {
    array_push($urls, get_home_url());

    return $urls;
  },
  10,
  2
);
