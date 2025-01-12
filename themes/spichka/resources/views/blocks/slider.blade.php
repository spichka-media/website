<div class="swiper-container">
  <div class="swiper">
    <div class="swiper-wrapper">
      @foreach ($slides as $slide)
        <div class="swiper-slide">
          {!! wp_get_attachment_image($slide['attachment_id'], 'full') !!}
        </div>
      @endforeach
    </div>

    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
  </div>
</div>

<figure>
  <figcaption><p>{{ $slides[0]['caption'] }}</p></figcaption>
</figure>
