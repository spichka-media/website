<?php 

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class PostCard extends Composer
{
     /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.post-card',
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
            'thumbnail' => get_the_post_thumbnail($this->data->get('post')->ID, 'post-card'),
            'url' => get_permalink($this->data->get('post')->ID),
        ];
    }

}