<div class="page-header">
  <h1 class="my-0 mt-lg-6 mb-lg-3">{!! $title !!}</h1>

  @if (is_author() && str_contains(get_the_author_meta('last_name'), '*'))
    @php
      $prevention_text = carbon_get_theme_option('author_foreign_agent_prevention_text');
    @endphp

    <p>
      {{ get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name') . ' ' . $prevention_text }}
    </p>
  @endif
</div>
