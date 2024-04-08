<?php

/**
 * Paginated navigation markup.
 * Compatible with Bootstrap 5.
 *
 * @param  array $links The paginate links.
 * @param  array $args  Array or string of arguments for generating paginated links for archives.
 * @return string       Navigation template tag.
 */
function bs_navigation_markup($links, $args)
{
  $navigation = '';

  if ($links) {
    $pagination =
      '<ul class="pagination pagination-md mb-0 flex-wrap justify-content-center">';

    foreach ($links as $link) {
      $active = strpos($link, 'current');
      $disabled = strpos($link, 'dots');
      $link = str_replace('page-numbers', 'page-numbers page-link', $link);

      if ($active) {
        $pagination .= "<li class=\"page-item active\">{$link}</li>";
      } elseif ($disabled) {
        $pagination .= "<li class=\"page-item disabled\">{$link}</li>";
      } else {
        $pagination .= "<li class=\"page-item\">{$link}</li>";
      }
    }

    $pagination .= '</ul>';
    $navigation = _navigation_markup(
      $pagination,
      $args['class'],
      $args['screen_reader_text'],
      $args['aria_label']
    );
  }

  return '<div class="mt-4">' . $navigation . '</div>';
}

/**
 * Retrieves a paginated navigation to next/previous set of posts, when applicable.
 * Compatible with Bootstrap 5.
 *
 * @param array $args {
 *     Optional. Default pagination arguments, see paginate_links().
 *
 *     @type string $screen_reader_text Screen reader text for navigation element.
 *                                      Default 'Posts navigation'.
 *     @type string $aria_label         ARIA label text for the nav element. Default 'Posts'.
 *     @type string $class              Custom class for the nav element. Default 'posts-pagination'.
 * }
 * @return string Markup for pagination links.
 */
function bs_get_the_posts_pagination($args = [])
{
  $navigation = '';

  // Don't print empty markup if there's only one page.
  if ($GLOBALS['wp_query']->max_num_pages > 1) {
    // Make sure the nav element has an aria-label attribute: fallback to the screen reader text.
    if (!empty($args['screen_reader_text']) && empty($args['aria_label'])) {
      $args['aria_label'] = $args['screen_reader_text'];
    }

    $args = wp_parse_args($args, [
      'end_size' => 1,
      'mid_size' => 3,
      'prev_next' => false,
      'prev_text' => _x('Previous', 'previous set of posts'),
      'next_text' => _x('Next', 'next set of posts'),
      'type' => 'array',
      'screen_reader_text' => __('Posts navigation'),
      'aria_label' => __('Posts'),
      'class' => 'posts-pagination',
    ]);

    // Set up paginated links.
    $links = paginate_links($args);

    if ($links) {
      $navigation = bs_navigation_markup($links, $args);
    }
  }

  return $navigation;
}
