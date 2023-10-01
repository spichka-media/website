<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our theme. We will simply require it into the script here so that we
| don't have to worry about manually loading any of our classes later on.
|
*/

if (! file_exists($composer = __DIR__.'/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'sage'));
}

require $composer;

/*
|--------------------------------------------------------------------------
| Register The Bootloader
|--------------------------------------------------------------------------
|
| The first thing we will do is schedule a new Acorn application container
| to boot when WordPress is finished loading the theme. The application
| serves as the "glue" for all the components of Laravel and is
| the IoC container for the system binding all of the various parts.
|
*/

if (! function_exists('\Roots\bootloader')) {
    wp_die(
        __('You need to install Acorn to use this theme.', 'sage'),
        '',
        [
            'link_url' => 'https://roots.io/acorn/docs/installation/',
            'link_text' => __('Acorn Docs: Installation', 'sage'),
        ]
    );
}

\Roots\bootloader()->boot();

/*
|--------------------------------------------------------------------------
| Register Sage Theme Files
|--------------------------------------------------------------------------
|
| Out of the box, Sage ships with categorically named theme files
| containing common functionality and setup to be bootstrapped with your
| theme. Simply add (or remove) files from the array below to change what
| is registered alongside Sage.
|
*/

collect(['setup', 'filters'])
    ->each(function ($file) {
        if (! locate_template($file = "app/{$file}.php", true, true)) {
            wp_die(
                /* translators: %s is replaced with the relative file path */
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file)
            );
        }
    });


/**
 * Custom thumbnail sizes
 */
add_image_size( 'post-card', 290, 410 );


/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 *  <snip />
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins() {
    $plugins = array(
        array(
            'name'      => 'footnotes',
            'slug'      => 'footnotes',
            'required'  => false,
        ),
        array(
            'name' => 'Easy Table of Contents',
            'slug'      => 'easy-table-of-contents',
            'required'  => false,
        )
    );

   $config = array(
       'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
       'default_path' => '',                      // Default absolute path to bundled plugins.
       'menu'         => 'tgmpa-install-plugins', // Menu slug.
       'parent_slug'  => 'themes.php',            // Parent menu slug.
       'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
       'has_notices'  => true,                    // Show admin notices or not.
       'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
       'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
       'is_automatic' => false,                   // Automatically activate plugins after installation or not.
       'message'      => '',                      // Message to output right before the plugins table.
       /*
       'strings'      => array(
           'page_title'                      => __( 'Install Required Plugins', 'theme-slug' ),
           'menu_title'                      => __( 'Install Plugins', 'theme-slug' ),
           // <snip>...</snip>
           'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
       )
       */
   );

   tgmpa( $plugins, $config );

}



/**
 * Automatically add IDs to headings such as <h2></h2>
 */
function auto_id_headings( $content ) {

	$content = preg_replace_callback( '/(\<h[1-6](.*?))\>(.*)(<\/h[1-6]>)/i', function( $matches ) {
		if ( ! stripos( $matches[0], 'id=' ) ) :
			$matches[0] = $matches[1] . $matches[2] . ' id="' . sanitize_text_field( str_replace( ' ', '-', $matches[3]) ) . '">' . $matches[3] . $matches[4];
		endif;
		return $matches[0];
	}, $content );

    return $content;

}
add_filter( 'the_content', 'auto_id_headings' );