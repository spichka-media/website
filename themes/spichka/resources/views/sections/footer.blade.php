<footer>
  <div class="container">

    <img class="stalin" src="https://spichka.media/wp-content/uploads/2022/01/Сталин-2.png.webp" alt="">

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
          <p><?php echo carbon_get_theme_option('theme_footer_text'); ?></p>
        </div>
      </div>
    @endif

    @if (carbon_get_theme_option('theme_email'))
      <a class="btn btn-outline-dark" href="mailto:<?php echo carbon_get_theme_option('theme_email'); ?>"><i class="far fa-envelope"></i>
        <?php echo carbon_get_theme_option('theme_email'); ?></a>
    @endif
  </div>

</footer>
