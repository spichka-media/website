<header class="sticky-top">
  <nav class="navbar navbar-dark">
    <div class="px-4 container-fluid">
      <a class="navbar-brand fw-bold" href="{{ home_url('/') }}">
        {!! $siteName !!}
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasDarkNavbar"
        aria-controls="offcanvasDarkNavbar"
        aria-label="Toggle navigation">
        <i class="fas fa-fw fa-bars"></i>
      </button>
      <div
        class="offcanvas offcanvas-end text-bg-dark"
        tabindex="-1"
        id="offcanvasDarkNavbar"
        aria-labelledby="offcanvasDarkNavbar">
        <div class="offcanvas-header">
          <button
            type="button"
            class="btn-close btn btn-dark border-0 rounded-circle d-flex align-items-center justify-content-center"
            data-bs-dismiss="offcanvas"
            aria-label="Close">
            <i class="fa-solid fa-xmark"></i>
          </button>
        </div>
        <div class="offcanvas-body">
          {{ get_search_form() }}

          @if (has_nav_menu('primary_navigation'))
            {!!
              wp_nav_menu([
                'theme_location' => 'primary_navigation',
                'container_class' => '',
                'menu_class' => 'navbar-nav my-3',
              ])
            !!}
          @endif

          @if (has_nav_menu('secondary_navigation'))
            <hr class="bg-white" />

            {!!
              wp_nav_menu([
                'theme_location' => 'secondary_navigation',
                'container_class' => '',
                'menu_class' => 'navbar-nav my-3',
              ])
            !!}
          @endif
        </div>
      </div>
    </div>
  </nav>

  @if (is_singular('post'))
    <div
      id="single-post-progressbar"
      class="progress"
      role="progressbar"
      aria-valuenow="0"
      aria-valuemin="0"
      aria-valuemax="100">
      <div class="progress-bar" style="width: 0%"></div>
    </div>
  @endif
</header>
