<?php

namespace App\View\Components;

use Roots\Acorn\View\Component;

class ConnectCard extends Component
{
  public $title;
  public $description;
  public $button_text;
  public $background_color;
  public $color;

  public function __construct($card)
  {
    $this->title = $card['front_connect_blocks_block_header'];
    $this->description = wpautop(
      $card['front_connect_blocks_block_description']
    );
    $this->button_text = $card['front_connect_blocks_block_button_text'];
    $this->background_color =
      $card['front_connect_blocks_block_background_color'];
    $this->color = $card['front_connect_blocks_block_color'];
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\View\View|string
   */
  public function render()
  {
    return $this->view('components.connect-card');
  }
}