<header>

  <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand ms-4 fs-6" href="{{ home_url('/') }}">{!! $siteName !!}</a>
  </nav>


  {{-- @if (has_nav_menu('primary_navigation'))
    <nav class="nav-primary" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
      {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'echo' => false]) !!}
    </nav>
  @endif --}}
</header>
