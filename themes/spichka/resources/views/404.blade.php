@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        @include('partials.page-header')

        @if (!have_posts())
          {!! __('Sorry, no results were found.', 'spichka') !!}

          {!! get_search_form(false) !!}
      </div>
      @endif
    </div>
  </div>
@endsection
