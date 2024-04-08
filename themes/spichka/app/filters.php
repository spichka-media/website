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
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Read more'));
});

/**
 * Filters the navigation markup template.
 * Compatible with Bootstrap 5.
 * 
 * @param  string $template The default template.
 * @return string           The navigation markup.
 */

add_filter( 'navigation_markup_template', function ($template) {
    return str_replace( '"navigation %1$s"', '"navigation %1$s" role="navigation"', $template );
}, 10, 2 );

add_filter('nav_menu_css_class',function ($classes, $item, $args) {
    $classes[] = 'nav-item';
    return $classes;
},1,3);


add_filter('wp_nav_menu', function ($ulclass) {
    return preg_replace('/<a /', '<a class="nav-link"', $ulclass);
});

