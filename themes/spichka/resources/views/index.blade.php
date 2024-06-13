@extends('layouts.app')

@section('content')
  <div class="container py-6">
    @include('partials.page-header')

    <div class="row gy-3 mt-1 mt-lg-3 row-cols-1 row-cols-md-2 row-cols-lg-3">
      @while (have_posts())
        @php(the_post())

        <div class="col">
          <x-post-card-extended />
        </div>
      @endwhile
    </div>

    {!! bs_get_the_posts_pagination() !!}
  </div>
@endsection
