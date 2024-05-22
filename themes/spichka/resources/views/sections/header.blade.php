<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="px-4 container-fluid">
      <a class="navbar-brand fw-bold" href="{{ home_url('/') }}">
        {!! $siteName !!}
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#headerMenu"
        aria-controls="headerMenu"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="headerMenu">
        @if (has_nav_menu('primary_navigation'))
          {!!
            wp_nav_menu([
              'theme_location' => 'primary_navigation',
              'container_class' => '',
              'menu_class' => 'navbar-nav',
            ])
          !!}
        @endif
      </div>
    </div>
  </nav>
</header>
