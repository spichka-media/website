<?php

const MAX_RECOMMENDED_POSTS = 4;

function get_post_recommendations(int $post_id)
{
  $manual_recommendations = carbon_get_post_meta($post_id, 'recommended_posts');

  if ($manual_recommendations && count($manual_recommendations)) {
    return get_posts([
      'include' => array_pluck($manual_recommendations, 'id'),
    ]);
  }

  $tag_posts = [];
  $tags = get_the_tags($post_id);

  if ($tags && count($tags)) {
    $args = [
      'numberposts' => MAX_RECOMMENDED_POSTS,
      'post_type' => 'post',
      'post_status' => 'publish',
      'tax_query' => [
        [
          'taxonomy' => 'post_tag',
          'field' => 'slug',
          'terms' => array_pluck($tags, 'slug'),
        ],
      ],
      'exclude' => [$post_id],
    ];

    $tag_posts = get_posts($args);

    if (count($tag_posts) === MAX_RECOMMENDED_POSTS) {
      return $tag_posts;
    }
  }
  $args = [
    'numberposts' => MAX_RECOMMENDED_POSTS - count($tag_posts),
    'post_type' => 'post',
    'post_status' => 'publish',
    'category' => array_pluck(get_the_category($post_id), 'term_id'),
    'exclude' => [...array_pluck($tag_posts, 'ID'), $post_id],
  ];

  $category_posts = get_posts($args);

  return array_merge($tag_posts, $category_posts);
}

// Need to purge cache for all related post to update recommendations
add_filter(
  'cloudflare_purge_by_url',
  function ($urls, $post_id) {
    if (get_post_type($post_id) !== 'post') {
      return $urls;
    }

    $tags = get_the_tags($post_id);

    if ($tags && count($tags)) {
      $args = [
        'numberposts' => -1,
        'post_type' => 'post',
        'post_status' => 'publish',
        'tax_query' => [
          [
            'taxonomy' => 'post_tag',
            'field' => 'slug',
            'terms' => array_pluck($tags, 'slug'),
          ],
        ],
        'exclude' => [$post_id],
      ];

      $tag_posts = get_posts($args);

      foreach ($tag_posts as $tag_post) {
        array_push($urls, get_permalink($tag_post->ID));
      }
    }

    $args = [
      'numberposts' => -1,
      'post_type' => 'post',
      'post_status' => 'publish',
      'category' => array_pluck(get_the_category($post_id), 'term_id'),
      'exclude' => [$post_id],
    ];

    $category_posts = get_posts($args);

    foreach ($category_posts as $category_post) {
      array_push($urls, get_permalink($category_post->ID));
    }

    return $urls;
  },
  10,
  2
);
