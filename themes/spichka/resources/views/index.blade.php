@extends('layouts.app')

@section('content')
  <div class="container pt-5 pb-5">
    @include('partials.page-header')

    <div class="row gy-3 mt-3">
      @while (have_posts())
        @php(the_post())

        <div class="col-sm-4">
          @include('partials.post-card-extended', [
              'title' => get_the_title($$post->ID),
              'thumbnail' => get_the_post_thumbnail($post->ID, 'post-card-extended'),
              'url' => get_permalink($post->ID),
              'excerpt' => get_the_excerpt($post->ID),
              'date' => get_the_date($post->ID),
          ])
        </div>
      @endwhile
    </div>
    {!! get_the_posts_pagination() !!}
  </div>
@endsection
