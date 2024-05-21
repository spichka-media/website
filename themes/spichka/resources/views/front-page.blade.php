@extends('layouts.app')

@section('content')
  <div id="front-page">
    @if (! wp_is_mobile())
      <section
        class="video-section flex-column text-white d-flex position-relative">
        <div class="container z-1">
          <div class="row">
            <div class="details">
              <h1 class="mb-5 pb-3 display-5 fw-bold">
                {{ carbon_get_post_meta(get_the_ID(), 'front_banner_header') }}
              </h1>
              <p class="h4 fw-bold">
                {{ carbon_get_post_meta(get_the_ID(), 'front_banner_description') }}
              </p>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-center pt-3 mt-auto pb-5">
          <a
            class="link-to-content text-body fs-3 lh-1 bg-white d-flex align-items-center justify-content-center rounded-circle text-decoration-none z-1"
            href="#start">
            <i class="fa-solid fa-angle-down"></i>
          </a>
        </div>
        <video
          class="video-element position-absolute z-0 top-0 start-0 bottom-0 end-0 object-fit-cover w-100 h-100"
          autoplay
          muted
          playsinline
          loop>
          <source
            src="{{ wp_get_attachment_url(carbon_get_post_meta(get_the_ID(), 'front_banner_video')) }}"
            type="video/mp4" />
        </video>
      </section>
    @endif

    <section id="start" class="ps-1 program-articles">
      <div class="container">
        <h1>
          {{ carbon_get_post_meta(get_the_ID(), 'front_program_articles_header') }}
        </h1>
      </div>

      <div class="swiper-container position-relative container-fluid">
        @php
          $program_articles = get_posts([
            'include' => array_pluck(carbon_get_post_meta(get_the_ID(), 'front_program_articles'), 'id'),
          ]);
        @endphp

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
        <div class="swiper-pagination"></div>
      </div>
    </section>

    <section class="ps-1 recent-articles">
      <div class="container">
        <h1>
          {{ carbon_get_post_meta(get_the_ID(), 'front_recent_articles_header') }}
        </h1>
      </div>

      <div class="swiper-container position-relative container-fluid">
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
        <div class="swiper-pagination"></div>
      </div>
    </section>

    <section class="ps-1 categories">
      <div class="container">
        <h1>
          {{ carbon_get_post_meta(get_the_ID(), 'front_article_categories_header') }}
        </h1>
      </div>

      <div class="container">
        <div class="row row-cols-1 row-cols-lg-4 g-3 g-lg-3">
          @foreach (get_categories() as $category)
            <div class="col">
              <div class="card categories-card">
                <div class="card-body">
                  <a href="{{ get_category_link($category->term_id) }}">
                    /{{ $category->name }}
                  </a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <section class="donate-section text-white pt-5 pb-5 ps-1 bg-dark">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <h1>
              {{ carbon_get_post_meta(get_the_ID(), 'front_donate_header') }}
            </h1>

            <p class="regular-text">
              {{ carbon_get_post_meta(get_the_ID(), 'front_donate_description') }}
            </p>

            <a
              href="{{ carbon_get_post_meta(get_the_ID(), 'front_donate_button_link') }}"
              target="_blank"
              class="btn btn-outline-light fs-5 fw-600 border-2 text-decoration-none">
              <i class="fas fa-coins me-1"></i>
              {{ carbon_get_post_meta(get_the_ID(), 'front_donate_button_text') }}
            </a>
          </div>

          @if (! wp_is_mobile())
            <div class="d-sm-block col-sm-6">
              {!! wp_get_attachment_image(carbon_get_post_meta(get_the_ID(), 'front_donate_image'), [550, 350]) !!}
            </div>
          @endif
        </div>
      </div>
    </section>

    <section class="ps-1 connect">
      <div class="container">
        <h1>
          {{ carbon_get_post_meta(get_the_ID(), 'front_connect_header') }}
        </h1>
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-2">
          @foreach (carbon_get_post_meta(get_the_ID(), 'front_connect_blocks') as $block)
            <div class="col">
              <div
                class="d-flex flex-column justify-content-between row-gap-5 card h-100 card-body bg-dark text-white px-4 py-5">
                <div>
                  <h3 class="card-title fw-semibold">
                    {{ $block['front_connect_blocks_block_header'] }}
                  </h3>
                  <p class="regular-text card-text">
                    {{ $block['front_connect_blocks_block_description'] }}
                  </p>
                </div>

                @if ($block['front_connect_blocks_block_button_text'])
                  <a
                    class="btn btn-outline-light fs-5 fw-600 border-2 text-decoration-none"
                    href="mailto:{{ carbon_get_theme_option('theme_email') }}">
                    <i class="far fa-envelope"></i>
                    {{ $block['front_connect_blocks_block_button_text'] }}
                  </a>
                @endif
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  </div>
@endsection
