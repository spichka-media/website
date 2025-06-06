<footer class="py-9 bg-light">
  <div class="container">
    <div class="d-flex align-items-center flex-column">
      <div class="img-container">
        {!!
          wp_get_attachment_image(carbon_get_theme_option('theme_footer_image'), [80, 100], false, [
            'id' => 'footer-image',
            'data-bs-toggle' => 'tooltip',
            'data-bs-placement' => 'right',
            'data-bs-title' => carbon_get_theme_option('theme_footer_image_quote'),
            'data-bs-offset' => '0,20',
            'data-bs-custom-class' => 'portraits-tooltip',
          ])
        !!}
      </div>

      <nav>
        <ul class="social d-flex list-unstyled mt-5 mb-0">
          @foreach (carbon_get_theme_option('theme_socials') as $social)
            <li class="mx-1">
              <a
                class="d-flex align-items-center justify-content-center rounded-circle fs-7 social-link"
                target="_blank"
                href="{{ $social['theme_social_link'] }}">
                <i class="{{ $social['theme_social_icon'] }}"></i>
              </a>
            </li>
          @endforeach
        </ul>
      </nav>

      @if (carbon_get_theme_option('theme_footer_text'))
        <div class="row justify-content-center my-7">
          <div class="col">
            <p class="text-center mb-0">
              {!! strip_tags(wpautop(carbon_get_theme_option('theme_footer_text')), '<br>') !!}
            </p>
          </div>
        </div>
      @endif

      @if (carbon_get_theme_option('theme_email'))
        <a
          class="email-button btn fs-7 btn-outline-dark rounded-0 text-decoration-none"
          href="mailto:{{ carbon_get_theme_option('theme_email') }}">
          <i class="far fa-envelope me-1"></i>
          {{ carbon_get_theme_option('theme_email') }}
        </a>
      @endif
    </div>
  </div>
</footer>
