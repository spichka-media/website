@extends('layouts.app')

@section('content')
  <div class="container">
    @include('partials.page-header')


    @if (!have_posts())
      <x-alert type="warning">
        {!! __('Sorry, but the page you are trying to view does not exist.', 'spichka') !!}
      </x-alert>

      {!! get_search_form(false) !!}
    @endif
  </div>
@endsection
