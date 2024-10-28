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

      if (is_singular('post')) {
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

    if (is_page('about-us')) {
      bundle('about-us')->enqueue();
    }

    wp_dequeue_style('modern_footnotes');

    if (is_singular('post')) {
      bundle('single-post')->enqueue();
    } else {
      wp_dequeue_script('modern_footnotes');
    }

    wp_enqueue_script(
      'font-awesome',
      esc_url('https://kit.fontawesome.com/4eacfc294a.js'),
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
  if (is_singular('post')) {
    wp_enqueue_style('modern_footnotes');
  }
});
