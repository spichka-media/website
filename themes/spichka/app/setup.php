<?php

/**
 * Theme setup.
 */

namespace App;

use function Roots\bundle;

/**
 * Register the theme assets.
 *
 * @return void
 */
add_action(
  'wp_enqueue_scripts',
  function () {
    bundle('app')->enqueue();

    if (!is_user_logged_in()) {
      wp_deregister_style('dashicons');
      wp_deregister_script('jquery');

      if (is_singular(['post', 'note'])) {
        wp_register_script(
          'jquery',
          '/wp-includes/js/jquery/jquery.min.js',
          [],
          null,
          [
            'strategy' => 'defer',
          ]
        );
        wp_enqueue_script('jquery');
      }
    }

    if (is_front_page()) {
      bundle('front-page')->enqueue();
    }

    if (is_archive() || is_home() || is_search()) {
      bundle('archive')->enqueue();
    }

    if (is_404()) {
      bundle('404')->enqueue();
    }

    if (get_page_template_slug() === 'template-about-us.blade.php') {
      bundle('about-us')->enqueue();
    }

    wp_dequeue_style('modern_footnotes');

    if (is_singular(['post', 'note'])) {
      bundle('single-article')->enqueue();
    } else {
      wp_dequeue_script('modern_footnotes');
    }

    wp_enqueue_script(
      'font-awesome',
      esc_url(
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js'
      ),
      [],
      '6.x',
      ['strategy' => 'defer']
    );

    wp_dequeue_style('wp-block-library'); // Remove WordPress core CSS
  },
  100
);

/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
add_action(
  'enqueue_block_editor_assets',
  function () {
    bundle('editor')->enqueue();
  },
  100
);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action(
  'after_setup_theme',
  function () {
    /**
     * Enable features from the Soil plugin if activated.
     *
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil', [
      'clean-up',
      'nav-walker',
      'nice-search',
      'relative-urls',
    ]);

    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
      'primary_navigation' => __('Primary Navigation', 'spichka'),
    ]);

    register_nav_menus([
      'secondary_navigation' => __('Secondary Navigation', 'spichka'),
    ]);

    register_nav_menus([
      'header_navigation' => __('Header Navigation', 'spichka'),
    ]);

    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
      'caption',
      'gallery',
      'search-form',
      'script',
      'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Custom thumbnail sizes
     */
    // Post-card
    add_image_size('post-card', 290, 410);

    // Post card extended
    add_image_size('post-card-extended', 416, 588);

    remove_image_size('1536x1536');
    remove_image_size('2048x2048');

    add_image_size('md', 1000);
    add_image_size('xs', 600);
  },
  20
);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
  //
});

/**
 * Deregister jquery-migrate
 *
 * @return void
 */
add_action('wp_default_scripts', function ($scripts) {
  if (!empty($scripts->registered['jquery'])) {
    $scripts->registered['jquery']->deps = array_diff(
      $scripts->registered['jquery']->deps,
      ['jquery-migrate']
    );
  }
});

add_action('get_footer', function () {
  if (is_singular(['post', 'note'])) {
    wp_enqueue_style('modern_footnotes');
  }
});

add_action('init', function () {
  $args = [
    'label' => 'Заметки',
    'labels' => [
      'menu_name' => 'Заметки',
      'name_admin_bar' => 'Заметка',
      'add_new' => 'Добавить заметку',
      'add_new_item' => 'Добавить заметку',
      'new_item' => 'Новая заметка',
      'edit_item' => 'Изменить заметку',
      'view_item' => 'Просмотр заметки',
      'update_item' => 'Обновить заметку',
      'all_items' => 'Все заметки',
      'search_items' => 'Поиск заметки',
      'parent_item_colon' => 'Родительская заметка',
      'not_found' => 'Заметка не найдена',
      'not_found_in_trash' => 'Заметка не найдена в корзине',
      'name' => 'Заметки',
      'singular_name' => 'Заметка',
    ],
    'public' => true,
    'exclude_from_search' => false,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_nav_menus' => true,
    'show_in_admin_bar' => true,
    'show_in_rest' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'has_archive' => true,
    'query_var' => true,
    'can_export' => true,
    'rewrite_no_front' => false,
    'show_in_menu' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-admin-page',
    'supports' => [
      'title',
      'editor',
      'author',
      'thumbnail',
      'revisions',
      'excerpt',
    ],
    'taxonomies' => ['category', 'post_tag'],
    'rewrite' => [
      'slug' => 'notes',
    ],
  ];

  register_post_type('note', $args);
});

add_action('pre_get_posts', function ($query) {
  if (
    !is_admin() &&
    $query->is_main_query() &&
    ($query->is_category() || $query->is_tag())
  ) {
    // Add your custom post type(s) to the query
    $query->set('post_type', ['post', 'note']);
  }
});
