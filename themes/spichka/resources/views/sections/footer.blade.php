<footer>
  <div class="container">
    <img class="stalin" src="{{ wp_get_attachment_url(carbon_get_theme_option('theme_footer_image')) }}">

    <div>
      <ul class="social">

        @foreach (carbon_get_theme_option('theme_socials') as $social)
          <li>
            <a arget="_blank" href="{{ $social['theme_social_link'] }}">
              <i class="{{ $social['theme_social_icon'] }}"></i>
            </a>
          </li>
        @endforeach
      </ul>
    </div>

    @if (carbon_get_theme_option('theme_footer_text'))
      <div class="row justify-content-md-center">
        <div class="col col-lg-6">
          <p> {{ carbon_get_theme_option('theme_footer_text') }} </p>
        </div>
      </div>
    @endif

    @if (carbon_get_theme_option('theme_email'))
      <a class="btn btn-outline-dark" href="mailto:{{ carbon_get_theme_option('theme_email') }}"><i
          class="far fa-envelope"></i>
        {{ carbon_get_theme_option('theme_email') }} </a>
    @endif
  </div>

</footer>
