<?php
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname(__FILE__) . '/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'my_theme_register_required_plugins');

/**
 * Register the required plugins for this theme.
 *
 *  <snip />
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins()
{
  $plugins = [
    [
      'name' => 'Modern Footnotes',
      'slug' => 'modern-footnotes',
      'required' => true,
      'force_activation' => true,
      'version' => '1.4.19',
    ],
    [
      'name' => 'Easy Table of Contents',
      'slug' => 'easy-table-of-contents',
      'required' => true,
      'force_activation' => true,
      'version' => '2.0.68.1',
    ],
    [
      'name' => 'PublishPress Authors',
      'slug' => 'publishpress-authors',
      'required' => true,
      'force_activation' => true,
      'version' => '4.7.0',
    ],
    [
      'name' => 'Carbon fields',
      'slug' => 'carbon-fields',
      'source' =>
        get_stylesheet_directory() . '/plugins/carbon-fields-3.6.5.zip',
      'required' => true,
      'force_activation' => true,
      'version' => '3.6.5',
    ],
    [
      'name' => 'Simple History',
      'slug' => 'simple-history',
      'required' => false,
      'force_activation' => false,
      'version' => '4.15.1',
    ],
    [
      'name' => 'Site Kit by Google',
      'slug' => 'google-site-kit',
      'required' => false,
      'force_activation' => false,
      'version' => '1.129.1',
    ],
    [
      'name' => 'Performance Lab',
      'slug' => 'performance-lab',
      'required' => false,
      'force_activation' => false,
      'version' => '3.3.1',
    ],
    [
      'name' => 'Lazy Load - Optimize Images',
      'slug' => 'rocket-lazy-load',
      'required' => false,
      'force_activation' => false,
      'version' => '2.3.9',
    ],
    [
      'name' => 'WebP Express',
      'slug' => 'webp-express',
      'required' => false,
      'force_activation' => false,
      'version' => '0.25.9',
    ],
    [
      'name' => 'WP Search with Algolia',
      'slug' => 'wp-search-with-algolia',
      'required' => false,
      'force_activation' => false,
      'version' => '2.8.1',
    ],
    [
      'name' => 'SVG Support',
      'slug' => 'svg-support',
      'required' => false,
      'force_activation' => false,
      'version' => '2.5.8',
    ],
  ];

  $config = [
    'id' => 'tgmpa', // Unique ID for hashing notices for multiple instances of TGMPA.
    'default_path' => '', // Default absolute path to bundled plugins.
    'menu' => 'tgmpa-install-plugins', // Menu slug.
    'parent_slug' => 'themes.php', // Parent menu slug.
    'capability' => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
    'has_notices' => true, // Show admin notices or not.
    'dismissable' => true, // If false, a user cannot dismiss the nag message.
    'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
    'is_automatic' => false, // Automatically activate plugins after installation or not.
    'message' => '', // Message to output right before the plugins table.
    /*
       'strings'      => array(
           'page_title'                      => __( 'Install Required Plugins', 'theme-slug' ),
           'menu_title'                      => __( 'Install Plugins', 'theme-slug' ),
           // <snip>...</snip>
           'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
       )
       */
  ];

  tgmpa($plugins, $config);
}
