@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        @include('partials.page-header')

        @if (!have_posts())
          <x-alert type="warning">
            {!! __('Sorry, no results were found.', 'spichka') !!}
          </x-alert>

          {!! get_search_form(false) !!}
      </div>
      @endif
    </div>
  </div>
@endsection
