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

    <div class="row">


      @while (have_posts())
        @php(the_post())
        @include('partials.content-search')
      @endwhile
    </div>
    {!! get_the_posts_navigation() !!}
  </div>
@endsection
