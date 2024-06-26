<div
  class="card border-0 h-100"
  style="
  @if($color) color: {{ $color }}; @endif
  background-color: {!! $background_color !!}">
  <div class="d-flex flex-column card-body p-6">
    <h3 class="card-title fw-bold mb-3">
      {!! $title !!}
    </h3>
    <div class="description fs-6">
      {!! $description !!}
    </div>

    @if ($button_text)
      <div class="pt-3 pt-sm-10 mt-sm-auto">
        <a
          class="btn btn-outline-light fw-bold border-2 text-decoration-none w-100"
          href="mailto:{{ carbon_get_theme_option('theme_email') }}">
          {!! $button_text !!}
        </a>
      </div>
    @endif
  </div>
</div>
