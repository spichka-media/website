@extends('layouts.app')

@section('content')
  <div class="container pt-5 pb-5">
    @include('partials.page-header')

    @if (! have_posts())
      {!! __('Sorry, no results were found.', 'spichka') !!}
    @endif

    <div class="row">
      @while (have_posts())
        @php(the_post())

        <div class="col-sm-3 mb-2">
          <x-post-card-extended />
        </div>
      @endwhile
    </div>

    {!! bs_get_the_posts_pagination() !!}
  </div>
@endsection
