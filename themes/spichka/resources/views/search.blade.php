@extends('layouts.app')

@section('content')
  <div class="container">


    @include('partials.page-header')

    @if (!have_posts())
      {!! __('Sorry, no results were found.', 'spichka') !!}

      {!! get_search_form(false) !!}
    @endif

    <div class="row">


      @while (have_posts())
        @php(the_post())

        <div class="col-sm-3 mb-2">

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
