@extends('layouts.app')

@section('content')
  <div class="container pt-5 pb-5">
    @include('partials.page-header')

    <div class="row gy-3 mt-3">
      @while (have_posts())
        @php(the_post())

        <div class="col-sm-4">
          <x-post-card-extended :post="$post" />
        </div>
      @endwhile
    </div>
    {!! get_the_posts_pagination(['class' => 'mt-4']) !!}
  </div>
@endsection
