@extends('layouts.app')

@section('content')
  @if (!wp_is_mobile())
    <section class="video-section text-white">
      <div class="video-container d-flex justify-content-center position-relative">
        <div class="details justify-content-center d-flex flex-column ">
          <div class="text-container d-flex flex-column position-relative gap-5">
            <h1>{{ carbon_get_post_meta(get_the_ID(), 'front_banner_header') }}</h1>
            <p class="h4">{{ carbon_get_post_meta(get_the_ID(), 'front_banner_description') }}</p>
          </div>
          <a class="link-to-content" href="#start">
            <i class="icon fas fa-angle-down"></i>
          </a>
        </div>
        <video class="video-element" autoplay muted playsinline loop>
          <source src="{{ wp_get_attachment_url(carbon_get_post_meta(get_the_ID(), 'front_banner_video')) }}"
            type="video/mp4">
        </video>
      </div>
    </section>
  @endif

  <section id="start" class="mt-5 mb-5 ms-0 me-0 program-articles">
    <div class="container">
      <h2 class="mb-3">
        {{ carbon_get_post_meta(get_the_ID(), 'front_program_articles_header') }}
      </h2>
    </div>

    @php
      $program_articles = get_posts([
          'include' => array_pluck(carbon_get_post_meta(get_the_ID(), 'front_program_articles'), 'id'),
      ]);
    @endphp

    <div class="container-fluid">
      <div class="swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
          <!-- Slides -->
          @foreach ($program_articles as $post)
            <div class="swiper-slide">
              <x-post-card :post="$post" />
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <section class="mt-5 mb-5 ms-0 me-0 program-articles">
    <div class="container">
      <h2 class="mb-3">
        {{ carbon_get_post_meta(get_the_ID(), 'front_recent_articles_header') }}
      </h2>
    </div>

    <div class="container-fluid">
      @php
        $recent_posts = get_posts([
            'posts_per_page' => 10,
        ]);
      @endphp
      <div class="swiper">
        <div class="swiper-wrapper">
          @foreach ($recent_posts as $post)
            <div class="swiper-slide">
              <x-post-card :post="$post" />
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>


  <section class="mt-5 mb-5 ms-0 me-0 categories">
    <div class="container">
      <h2 class="mb-3">
        {{ carbon_get_post_meta(get_the_ID(), 'front_article_categories_header') }}
      </h2>
    </div>

    <div class="container">
      <div class="row row-cols-1 row-cols-lg-4 g-2 g-lg-3">
        @foreach (get_categories() as $category)
          <div class="col">
            <div class="card">
              <div class="card-body">
                <a href="{{ get_category_link($category->term_id) }}">/{{ $category->name }}</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <section class="mt-5 mb-5 ms-0 me-0 donate-section text-white pt-5 pb-5 bg-dark">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h2 class="mb-3">
            {{ carbon_get_post_meta(get_the_ID(), 'front_donate_header') }}
          </h2>

          <p>
            {{ carbon_get_post_meta(get_the_ID(), 'front_donate_description') }}
          </p>

          <a href="{{ carbon_get_post_meta(get_the_ID(), 'front_donate_button_link') }}" target="_blank"
            class="btn btn-outline-light fs-5 fw-600 border-2 text-decoration-none">
            <i class="fas fa-coins"></i>{{ carbon_get_post_meta(get_the_ID(), 'front_donate_button_text') }}
          </a>
        </div>

        <div class="col-sm-6">
          {!! wp_get_attachment_image(carbon_get_post_meta(get_the_ID(), 'front_donate_image'), [550, 350]) !!}
        </div>
      </div>
    </div>
  </section>

  <section class="mt-5 mb-5 ms-0 me-0 connect">
    <div class="container">
      <h2 class="mb-3">
        {{ carbon_get_post_meta(get_the_ID(), 'front_connect_header') }}
      </h2>


      <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-2">
        @foreach (carbon_get_post_meta(get_the_ID(), 'front_connect_blocks') as $block)
          <div class="col">
            <div class="card h-100">
              <div class="card-body bg-dark text-white text-center px-4 py-5">
                <h3 class="card-title">{{ $block['front_connect_blocks_block_header'] }}</h3>
                <p class="card-text">{{ $block['front_connect_blocks_block_description'] }}</p>

                @if ($block['front_connect_blocks_block_button_text'])
                  <a class="btn btn-outline-light fs-5 fw-600 border-2 text-decoration-none"
                    href="mailto:{{ carbon_get_theme_option('theme_email') }}"><i class="far fa-envelope"></i>
                    {{ $block['front_connect_blocks_block_button_text'] }}</a>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>
  </section>
@endsection
