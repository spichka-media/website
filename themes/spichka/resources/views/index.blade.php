@extends('layouts.app')

@section('content')
  <div class="container pt-5 pb-4">
    @include('partials.page-header')

    <div class="row gy-3 mt-3">
      @while (have_posts())
        @php(the_post())

        <div class="col-sm-4">
          <x-post-card-extended :post="$post" />
        </div>
      @endwhile
    </div>

    {!! bs_get_the_posts_pagination() !!}
  </div>
@endsection
