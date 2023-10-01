<?php

namespace App\View\Components;

use Roots\Acorn\View\Component;

class PostCard extends Component
{

    public $title;

    public $thumbnail;
    public $url;


    public function __construct($title, $url, $thumbnail = null)
    {
        $this->title = $title;
        $this->thumbnail = $thumbnail;
        $this->url = $url;
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
