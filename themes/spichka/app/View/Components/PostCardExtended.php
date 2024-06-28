<?php

namespace App\View\Components;

use Roots\Acorn\View\Component;

class PostCardExtended extends Component
{
  public $title;
  public $thumbnail;
  public $url;
  public $excerpt;
  public $date;

  public function __construct()
  {
    $this->title = get_the_title();
    $this->thumbnail = get_the_post_thumbnail(null, 'post-card-extended');
    $this->url = get_permalink();
    $this->excerpt = has_excerpt() ? get_the_excerpt() : null;
    $this->date = get_the_date();
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\View\View|string
   */
  public function render()
  {
    return $this->view('components.post-card-extended');
  }
}
