<figure>
  <div class="swiper-container slider-block">
    <div class="swiper">
      <div class="swiper-wrapper">
        @foreach ($slides as $slide)
          <div class="swiper-slide">
            <figure>
              {!! wp_get_attachment_image($slide['attachment_id'], 'full') !!}
            </figure>
          </div>
        @endforeach
      </div>
    </div>

    <button class="btn btn-nav swiper-button swiper-button-prev">
      <i class="fa-solid fa-angle-left"></i>
    </button>
    <button class="btn btn-nav swiper-button swiper-button-next">
      <i class="fa-solid fa-angle-right"></i>
    </button>

    <div class="swiper-pagination-fractions"></div>
  </div>

  @if (! empty($caption))
    <figcaption class="text-center">
      <em>{{ $caption }}</em>
    </figcaption>
  @endif
</figure>
