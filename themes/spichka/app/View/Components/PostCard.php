<?php

namespace App\View\Components;

use Roots\Acorn\View\Component;

class PostCard extends Component
{
    public $title;
    public $thumbnail;
    public $url;

    public function __construct($post) {
        $this->title = get_the_title($post->ID);
        $this->thumbnail = get_the_post_thumbnail($post->ID, 'post-card');
        $this->url = get_permalink($post->ID);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return $this->view('components.post-card');
    }
}
