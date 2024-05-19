<?php
/*
Plugin Name: Lessons Plugin
Version: 0.0.1
*/

register_activation_hook(__FILE__, 'child_plugin_activate');
function child_plugin_activate()
{
  // Require parent plugin
  if (
    !is_plugin_active('carbon-fields/carbon-fields-plugin.php') and
    current_user_can('activate_plugins')
  ) {
    // Stop activation redirect and show error
    wp_die(
      'Sorry, but this plugin requires the Parent Plugin to be installed and active. <br><a href="' .
        admin_url('plugins.php') .
        '">&laquo; Return to Plugins</a>'
    );
  }
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Carbon_Fields;

function create_lessons_post_type()
{
  register_post_type('lessons', [
    'labels' => [
      'name' => __('Lessons'),
      'singular_name' => __('Lesson'),
    ],
    'supports' => ['title'],
    'public' => true,
    'show_in_rest' => true,
    'has_archive' => false,
  ]);
}

add_action('init', 'create_lessons_post_type');

function lesson_courses_taxonomy()
{
  register_taxonomy('lesson_courses', 'lessons', [
    'hierarchical' => true,
    'public' => true,
    'show_admin_column' => 'true',
    'show_in_rest' => true,
    'label' => 'Courses',
  ]);
}
add_action('init', 'lesson_courses_taxonomy');

/**
 * Display a custom taxonomy dropdown in admin
 * @author Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
add_action('restrict_manage_posts', 'tsm_filter_post_type_by_taxonomy');
function tsm_filter_post_type_by_taxonomy()
{
  global $typenow;
  $post_type = 'lessons';
  $taxonomy = 'lesson_courses';
  if ($typenow == $post_type) {
    $selected = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
    $info_taxonomy = get_taxonomy($taxonomy);
    wp_dropdown_categories([
      'show_option_all' => sprintf(__('Show all %s'), $info_taxonomy->label),
      'taxonomy' => $taxonomy,
      'name' => $taxonomy,
      'orderby' => 'name',
      'selected' => $selected,
      'show_count' => true,
      'hide_empty' => true,
    ]);
  }
}
/**
 * Filter posts by taxonomy in admin
 * @author  Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
add_filter('parse_query', 'tsm_convert_id_to_term_in_query');
function tsm_convert_id_to_term_in_query($query)
{
  global $pagenow;
  $post_type = 'lessons';
  $taxonomy = 'lesson_courses';
  $q_vars = &$query->query_vars;
  if (
    $pagenow == 'edit.php' &&
    isset($q_vars['post_type']) &&
    $q_vars['post_type'] == $post_type &&
    isset($q_vars[$taxonomy]) &&
    is_numeric($q_vars[$taxonomy]) &&
    $q_vars[$taxonomy] != 0
  ) {
    $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
    $q_vars[$taxonomy] = $term->slug;
  }
}

add_action(
  'carbon_fields_register_fields',
  function () {
    Container::make('post_meta', __('Настройки поста'))
      ->where('post_type', '=', 'lessons')
      ->add_tab(__('Детали'), [
        Field::make('complex', 'topics', 'Темы')
          ->set_layout('tabbed-vertical')
          ->set_visible_in_rest_api(true)
          ->add_fields([
            Field::make('text', 'title', 'Заголовок'),
            Field::make('complex', 'resources', 'Материал')
              ->set_layout('tabbed-vertical')
              ->add_fields([
                Field::make('text', 'title', 'Заголовок'),
                Field::make('select', 'type', __('Тип'))->add_options([
                  'document' => __('Документ'),
                  'text' => __('Текст'),
                ]),
                Field::make('text', 'document_page_start', 'Со страницы')
                  ->set_attribute('type', 'number')
                  ->set_conditional_logic([
                    [
                      'field' => 'type',
                      'value' => 'document',
                      'compare' => '=',
                    ],
                  ]),
                Field::make('text', 'document_page_end', 'До страницы')
                  ->set_attribute('type', 'number')
                  ->set_conditional_logic([
                    [
                      'field' => 'type',
                      'value' => 'document',
                      'compare' => '=',
                    ],
                  ]),
                Field::make('file', 'document', __('Книга'))
                  ->set_type(['application/pdf'])
                  ->set_conditional_logic([
                    [
                      'field' => 'type',
                      'value' => 'document',
                      'compare' => '=',
                    ],
                  ]),
                Field::make(
                  'rich_text',
                  'text',
                  'Текст'
                )->set_conditional_logic([
                  [
                    'field' => 'type',
                    'value' => 'text',
                    'compare' => '=',
                  ],
                ]),
              ]),
          ]),
      ]);
  },
  100
);

/**
 * Plugin Name: WP REST API filter parameter
 * Description: This plugin adds a "filter" query parameter to API post collections to filter returned results based on public WP_Query parameters, adding back the "filter" parameter that was removed from the API when it was merged into WordPress core.
 * Author: WP REST API Team
 * Author URI: http://v2.wp-api.org
 * Version: 0.1
 * License: GPL2+
 **/

add_action('rest_api_init', 'rest_api_filter_add_filters');

/**
 * Add the necessary filter to each post type
 **/
function rest_api_filter_add_filters()
{
  foreach (get_post_types(['show_in_rest' => true], 'objects') as $post_type) {
    add_filter(
      'rest_' . $post_type->name . '_query',
      'rest_api_filter_add_filter_param',
      10,
      2
    );
  }
}

/**
 * Add the filter parameter
 *
 * @param  array           $args    The query arguments.
 * @param  WP_REST_Request $request Full details about the request.
 * @return array $args.
 **/
function rest_api_filter_add_filter_param($args, $request)
{
  // Bail out if no filter parameter is set.
  if (empty($request['filter']) || !is_array($request['filter'])) {
    return $args;
  }

  $filter = $request['filter'];

  if (
    isset($filter['posts_per_page']) &&
    ((int) $filter['posts_per_page'] >= 1 &&
      (int) $filter['posts_per_page'] <= 100)
  ) {
    $args['posts_per_page'] = $filter['posts_per_page'];
  }

  global $wp;
  $vars = apply_filters('rest_query_vars', $wp->public_query_vars);

  // Allow valid meta query vars.
  $vars = array_unique(
    array_merge($vars, ['meta_query', 'meta_key', 'meta_value', 'meta_compare'])
  );

  foreach ($vars as $var) {
    if (isset($filter[$var])) {
      $args[$var] = $filter[$var];
    }
  }
  return $args;
}
