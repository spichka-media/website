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
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'spichka'));
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
        __('You need to install Acorn to use this theme.', 'spichka'),
        '',
        [
            'link_url' => 'https://roots.io/acorn/docs/installation/',
            'link_text' => __('Acorn Docs: Installation', 'spichka'),
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
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'spichka'), $file)
            );
        }
    });


/**
 * Custom thumbnail sizes
 */


add_filter( 'intermediate_image_sizes_advanced', 'prefix_remove_default_images' );
// This will remove the default image sizes and the medium_large size. 
function prefix_remove_default_images( $sizes ) {
 unset( $sizes['small']); // 150px
 unset( $sizes['medium']); // 300px
 unset( $sizes['large']); // 1024px
 unset( $sizes['medium_large']); // 768px
 return $sizes;
}


 // Post-card
 add_image_size( 'post-card', 290, 410 );

 // Post card extended
 add_image_size( 'post-card-extended', 416, 588 );


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
			'name'               => 'footnotes',
			'slug'               => 'footnotes', 
			'source'             => get_stylesheet_directory() . '/plugins/footnotes.zip', 
			'required'           => true, 
			'force_activation'   => true, 
		),
        array(
			'name'               => 'mistape',
			'slug'               => 'mistape', 
			'source'             => get_stylesheet_directory() . '/plugins/mistape.zip', 
			'required'           => true, 
			'force_activation'   => true, 
		),
        array(
            'name' => 'Easy Table of Contents',
            'slug'      => 'easy-table-of-contents',
            'required'  => true,
			'force_activation'   => true, 
        ),
        array(
            'name' => 'Contact form 7',
            'slug' => 'contact-form-7',
            'required' => true
        ),
        array(
            'name' => 'Wordfence Security – Firewall, Malware Scan, and Login Security',
            'slug' => 'wordfence',
            'required' => true,
			'force_activation'   => true,
        ),
        array(
            'name' => 'PublishPress Authors',
            'slug' => 'publishpress-authors',
            'required' => true,
			'force_activation'   => true,
        ),
        array(
            'name' => 'Font Awesome',
            'slug' => 'font-awesome',
            'required' => true,
			'force_activation'   => true,
        ),
        array(
            'name' => 'Yoast SEO',
            'slug' => 'wordpress-seo',
            'required' => true,
			'force_activation'   => true, 
        ),
        array(
			'name'               => 'Carbon fields',
			'slug'               => 'carbon-fields', 
			'source'             => get_stylesheet_directory() . '/plugins/carbon-fields.zip', 
			'required'           => true, 
			'force_activation'   => true, 
		),
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
            $id = sanitize_text_field( str_replace( array('?', ',', ":", ";", ".", '&nbsp;', "!"), '', str_replace( array(' '), '-', $matches[3]) ) );
			$matches[0] = $matches[1] . $matches[2] . ' id="' . $id . '">' . $matches[3] . $matches[4];
		endif;
		return $matches[0];
	}, $content );

    return $content;

}
add_filter( 'the_content', 'auto_id_headings' );


//----------------------------------------------------------/
//  responsive images [ 1) add img-responsive class 2) remove dimensions ]
//----------------------------------------------------------/

function bootstrap_responsive_images( $html ){
    $classes = 'img-responsive'; // separated by spaces, e.g. 'img image-link'
  
    // check if there are already classes assigned to the anchor
    if ( preg_match('/<img.*? class="/', $html) ) {
      $html = preg_replace('/(<img.*? class=".*?)(".*?\/>)/', '$1 ' . $classes . ' $2', $html);
    } else {
      $html = preg_replace('/(<img.*?)(\/>)/', '$1 class="' . $classes . '" $2', $html);
    }
    // remove dimensions from images,, does not need it!
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
  }
  add_filter( 'the_content','bootstrap_responsive_images',10 );
  add_filter( 'post_thumbnail_html', 'bootstrap_responsive_images', 10 );


/**
 * Pluck an array of values from an array. (Only for PHP 5.3+)
 *
 * @param  $array - data
 * @param  $key - value you want to pluck from array
 *
 * @return plucked array only with key data
 */
function array_pluck($array, $key) {
    return array_map(function($v) use ($key) {
      return is_object($v) ? $v->$key : $v[$key];
    }, $array);
}

require_once dirname( __FILE__ ) . '/app/lib/pagination.php';

require_once dirname( __FILE__ ) . '/app/custom-fields.php';
