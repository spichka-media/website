<header>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand ms-4 fs-6" href="{{ home_url('/') }}">{!! $siteName !!}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu([
            'theme_location' => 'primary_navigation',
            'container_class' => '',
            'menu_class' => 'navbar-nav',
        ]) !!}
      @endif

      {{-- {!! get_search_form(false) !!} --}}
    </div>
  </nav>



</header>
