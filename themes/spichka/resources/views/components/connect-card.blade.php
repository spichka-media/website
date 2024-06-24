<div
  class="card border-0 h-100"
  style="
  @if($color) color: {{ $color }}; @endif
  background-color: {!! $background_color !!}">
  <div class="d-flex flex-column row-gap-5 card-body p-6">
    <h3 class="card-title fw-bold">
      {!! $title !!}
    </h3>
    <div class="fs-6">
      {!! $description !!}
    </div>

    @if ($button_text)
      <a
        class="btn btn-outline-light fw-bold border-2 text-decoration-none mt-auto"
        href="mailto:{{ carbon_get_theme_option('theme_email') }}">
        {!! $button_text !!}
      </a>
    @endif
  </div>
</div>
