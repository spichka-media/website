<footer class="pt-5 pb-5">
  <div class="container">

    <div class="d-flex align-items-center flex-column">
      {!! wp_get_attachment_image(carbon_get_theme_option('theme_footer_image'), [100, 80]) !!}

      <nav>
        <ul class="social d-flex list-unstyled mt-3 mb-3">
          @foreach (carbon_get_theme_option('theme_socials') as $social)
            <li class="ms-1 me-1">
              <a class="d-flex align-items-center justify-content-center rounded-circle fs-5 social-link" arget="_blank"
                href="{{ $social['theme_social_link'] }}">
                <i class="{{ $social['theme_social_icon'] }}"></i>
              </a>
            </li>
          @endforeach
        </ul>
      </nav>

      @if (carbon_get_theme_option('theme_footer_text'))
        <div class="row justify-content-center">
          <div class="col col-lg-6">
            <p class="text-center"> {{ carbon_get_theme_option('theme_footer_text') }} </p>
          </div>
        </div>
      @endif

      @if (carbon_get_theme_option('theme_email'))
        <a class="btn btn-outline-dark text-decoration-none"
          href="mailto:{{ carbon_get_theme_option('theme_email') }}"><i class="far fa-envelope"></i>
          {{ carbon_get_theme_option('theme_email') }} </a>
      @endif
    </div>
  </div>

</footer>
