<?php

function get_posts_translations(int $post_id)
{
  $manual_translations = carbon_get_post_meta($post_id, 'translated_posts');
  $posts = get_posts(['include' => array_pluck($manual_translations, 'id')]);
  $langs_result = [];

  if (!($manual_translations && count($manual_translations))) {
    return [];
  }

  foreach ($posts as $post) {
    $langs = get_the_terms($post, 'translation_lang');
    if (count($langs) == 0) {
      continue;
    }
    foreach ($langs as $lang) {
      $key = get_object_vars($lang)['name'];
      $langs_result[$key] = $post;
    }
  }

  return $langs_result;
}
