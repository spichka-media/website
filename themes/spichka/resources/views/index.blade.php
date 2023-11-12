@extends('layouts.app')

@section('content')
  <div class="container">
    @include('partials.page-header')

    @if (!have_posts())
      <x-alert type="warning">
        {!! __('Sorry, no results were found.', 'spichka') !!}
      </x-alert>

      {!! get_search_form(false) !!}
    @endif

    <div class="row gy-3 g-md-3" data-masonry='{"percentPosition": true }'>


      @while (have_posts())
        @php(the_post())

        <div class="col-sm-4">
          @include('partials.post-card-extended', [
              'title' => get_the_title($post),
              'thumbnail' => get_the_post_thumbnail($post, 'post-card-extended'),
              'url' => get_post_permalink($post),
              'excerpt' => get_the_excerpt($post),
              'date' => get_the_date($post),
          ])
        </div>
      @endwhile
    </div>
    {!! get_the_posts_navigation() !!}
  </div>
@endsection
