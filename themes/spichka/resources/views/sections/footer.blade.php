<footer class="py-9 bg-light" id="theme-main-footer">
  <div class="container">
    <div class="d-flex align-items-center flex-column">
      <article
        id="theme-main-footer-image-wrapper"
        data-bs-toggle="tooltip"
        data-bs-title="''"
        data-bs-custom-class="custom-headliners-tooltip">
        {!! wp_get_attachment_image(carbon_get_theme_option('theme_footer_image'), [95, 120], false, ['id' => 'theme-main-footer-image']) !!}
      </article>

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
