<div class="col-sm-4">

  @include('partials.post-card', [
      'title' => get_the_title($post->ID),
      'thumbnail' => get_the_post_thumbnail($post->ID, 'post-card'),
      'url' => get_post_permalink($post->ID),
  ])


  {{-- <article @php(post_class())>
    <header>
      <h2 class="entry-title">
        <a href="{{ get_permalink() }}">
          {!! $title !!}
        </a>
      </h2>

      @includeWhen(get_post_type() === 'post', 'partials.entry-meta')
    </header>

    <div class="entry-summary">
      @php(the_excerpt())
    </div>
  </article> --}}
</div>
