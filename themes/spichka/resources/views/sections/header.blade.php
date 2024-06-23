<header class="sticky-top">
  @if (is_singular('post'))
    <div
      id="single-post-progressbar"
      class="progress z-3"
      role="progressbar"
      aria-valuenow="0"
      aria-valuemin="0"
      aria-valuemax="100">
      <div class="progress-bar" style="width: 0%"></div>
    </div>
  @endif

  <nav class="navbar navbar-expand-lg navbar-dark z-2">
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
