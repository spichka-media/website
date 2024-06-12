<footer class="pb-8 pt-8">
  <div class="container">
    <div class="d-flex align-items-center flex-column">
      {!! wp_get_attachment_image(carbon_get_theme_option('theme_footer_image'), [100, 80]) !!}

      <nav>
        <ul class="social d-flex list-unstyled mt-3 mb-3">
          @foreach (carbon_get_theme_option('theme_socials') as $social)
            <li class="ms-1 me-1">
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
        <div class="row justify-content-center">
          <div class="col text-center">
            {!! wpautop(carbon_get_theme_option('theme_footer_text')) !!}
          </div>
        </div>
      @endif

      @if (carbon_get_theme_option('theme_email'))
        <a
          class="email-button btn fs-7 btn-outline-dark rounded-0 text-decoration-none"
          href="mailto:{{ carbon_get_theme_option('theme_email') }}">
          <i class="far fa-envelope"></i>
          {{ carbon_get_theme_option('theme_email') }}
        </a>
      @endif
    </div>
  </div>
</footer>
