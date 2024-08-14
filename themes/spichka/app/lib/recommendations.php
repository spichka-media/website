<?php

const MAX_RECOMENDATIONS_AMOUNT = 4;

function get_post_recommendations(int $post_id)
{
  $manual_recommendations = carbon_get_post_meta(
    get_the_ID(),
    'front_program_articles'
  );

  if (count($manual_recommendations)) {
    return $manual_recommendations;
  }

  $tag_posts = [];
  $tags = get_the_tags($post_id);

  if ($tags && count($tags)) {
    $args = [
      'numberposts' => MAX_RECOMENDATIONS_AMOUNT,
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

    if (count($tag_posts) === MAX_RECOMENDATIONS_AMOUNT) {
      return $tag_posts;
    }
  }

  $args = [
    'numberposts' => MAX_RECOMENDATIONS_AMOUNT - count($tag_posts),
    'post_type' => 'post',
    'post_status' => 'publish',
    'category' => array_pluck(get_the_category($post_id), 'term_id'),
    'exclude' => [$post_id],
  ];

  $category_posts = get_posts($args);

  return array_merge($tag_posts, $category_posts);
}
