@extends('layouts.app')

@section('content')
  <div id="front-page">
    <section
      class="video-section flex-column text-white d-flex position-relative">
      <div class="container z-1">
        <div class="row">
          <div class="col-md-6">
            <div class="details">
              <h1 class="break-word mb-5 pb-3 display-5">
                {!! strip_tags(wpautop(carbon_get_post_meta(get_the_ID(), 'front_banner_header')), '<br>') !!}
              </h1>
              <p class="h4 fw-bold">
                {{ carbon_get_post_meta(get_the_ID(), 'front_banner_description') }}
              </p>
            </div>
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
        poster="{{ wp_is_mobile() ? wp_get_attachment_url(carbon_get_post_meta(get_the_ID(), 'front_banner_video_poster')) : '' }}"
        class="video-element position-absolute z-0 top-0 start-0 bottom-0 end-0 object-fit-cover w-100 h-100"
        autoplay
        muted
        playsinline
        loop>
        @if (! wp_is_mobile())
          <source
            src="{{ wp_get_attachment_url(carbon_get_post_meta(get_the_ID(), 'front_banner_video')) }}"
            type="video/mp4" />
        @endif
      </video>
    </section>

    <section id="start" class="mt-7 mt-lg-10 program-articles-section">
      <div class="container">
        <h2 class="mb-5 break-word">
          {{ carbon_get_post_meta(get_the_ID(), 'front_program_articles_header') }}
        </h2>
      </div>

      <div class="swiper-container position-relative container-fluid">
        @php
          $program_articles = get_posts([
            'include' => array_pluck(carbon_get_post_meta(get_the_ID(), 'front_program_articles'), 'id'),
          ]);
        @endphp

        <div class="swiper pb-5">
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

    <section class="mt-7 mt-lg-10 recent-articles-section">
      <div class="container">
        <h2 class="mb-5">
          {{ carbon_get_post_meta(get_the_ID(), 'front_recent_articles_header') }}
        </h2>
      </div>

      <div class="swiper-container position-relative container-fluid">
        @php
          $recent_posts = get_posts([
            'posts_per_page' => 10,
          ]);
        @endphp

        <div class="swiper pb-5">
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

    <section class="mt-7 mt-lg-10 categories-section">
      <div class="container">
        <h2 class="mb-5">
          {{ carbon_get_post_meta(get_the_ID(), 'front_article_categories_header') }}
        </h2>
      </div>

      <div class="container">
        <div class="row row-cols-1 row-cols-lg-4 g-3 g-lg-3">
          @foreach (get_categories() as $category)
            <div class="col">
              <div class="card border-dark border-2">
                <div class="card-body">
                  <a
                    class="fw-bold text-dark"
                    href="{{ get_category_link($category->term_id) }}">
                    /{{ $category->name }}
                  </a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <section class="donate-section mt-7 mt-lg-10 text-white py-7 bg-dark">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-sm-6">
            <h2 class="mb-5">
              {{ carbon_get_post_meta(get_the_ID(), 'front_donate_header') }}
            </h2>

            <p class="fs-6">
              {{ carbon_get_post_meta(get_the_ID(), 'front_donate_description') }}
            </p>

            <a
              href="{{ carbon_get_post_meta(get_the_ID(), 'front_donate_button_link') }}"
              target="_blank"
              class="btn btn-outline-light fw-bold border-2 text-decoration-none">
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

    <section class="my-7 my-lg-10 connect-section">
      <div class="container">
        <h2 class="break-word mb-5">
          {{ carbon_get_post_meta(get_the_ID(), 'front_connect_header') }}
        </h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-2">
          @foreach (carbon_get_post_meta(get_the_ID(), 'front_connect_blocks') as $block)
            <div class="col">
              <div class="card h-100 bg-dark">
                <div
                  class="d-flex flex-column row-gap-5 card-body p-6 text-white">
                  <h3 class="card-title fw-semibold">
                    {{ $block['front_connect_blocks_block_header'] }}
                  </h3>
                  <p class="card-text fs-6">
                    {{ $block['front_connect_blocks_block_description'] }}
                  </p>

                  @if ($block['front_connect_blocks_block_button_text'])
                    <a
                      class="btn btn-outline-light fw-bold border-2 text-decoration-none mt-auto"
                      href="mailto:{{ carbon_get_theme_option('theme_email') }}">
                      <i class="far fa-envelope fs-5"></i>
                      {{ $block['front_connect_blocks_block_button_text'] }}
                    </a>
                  @endif
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  </div>
@endsection
