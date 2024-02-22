<?php 

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class PostCardExtended extends Composer
{
     /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.post-card-extended',
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'title' => get_the_title($this->data->get('post')->ID),
            'thumbnail' => get_the_post_thumbnail($this->data->get('post')->ID, 'post-card-extended'),
            'url' => get_permalink($this->data->get('post')->ID),
            'excerpt' => get_the_excerpt($this->data->get('post')->ID),
            'date' => get_the_date($this->data->get('post')->ID),
        ];
    }

}