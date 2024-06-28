@extends('layouts.app')

@section('content')
  <section
    class="video-section flex-column text-white d-flex position-relative">
    <div class="container z-1" id="video-section-container">
      <div class="row">
        <div class="col-md-6">
          <div class="details">
            <h1 class="mb-5 pb-3 display-5">
              {!! strip_tags(wpautop(carbon_get_post_meta(get_the_ID(), 'front_banner_header')), '<br>') !!}
            </h1>
            <p class="h4 fw-bold">
              {{ carbon_get_post_meta(get_the_ID(), 'front_banner_description') }}
            </p>
          </div>
        </div>

        <div class="d-none d-md-block col-md-6">
          <ul class="social d-flex list-unstyled mb-0 float-end">
            @foreach (carbon_get_theme_option('theme_socials') as $social)
              <li class="mx-2">
                <a
                  class="d-flex align-items-center justify-content-center rounded-circle fs-5 social-link"
                  target="_blank"
                  href="{{ $social['theme_social_link'] }}">
                  <i class="text-dark {{ $social['theme_social_icon'] }}"></i>
                </a>
              </li>
            @endforeach
          </ul>
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

  <section id="start" class="mt-7 mt-lg-10 program-articles-section">
    <div class="container">
      <h2 class="h1 mb-3 mb-lg-5 break-word">
        <a
          class="link-dark"
          href="{!! get_term_link(intval(carbon_get_post_meta(get_the_ID(), 'front_program_articles_taxonomy')[0]['id'])) !!}">
          {{ carbon_get_post_meta(get_the_ID(), 'front_program_articles_header') }}
        </a>
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

          @if (carbon_get_post_meta(get_the_ID(), 'front_program_articles_taxonomy'))
            <div class="swiper-slide">
              <div class="post-card">
                <a
                  href="{!! get_term_link(intval(carbon_get_post_meta(get_the_ID(), 'front_program_articles_taxonomy')[0]['id'])) !!}">
                  {!! wp_get_attachment_image(carbon_get_theme_option('posts_more_image'), 'post-card') !!}
                </a>
              </div>
            </div>
          @endif
        </div>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </section>

  <section class="mt-7 mt-lg-10 recent-articles-section">
    <div class="container">
      <h2 class="h1 mb-3 mb-lg-5">
        <a
          class="link-dark"
          href="{!! get_permalink(get_option('page_for_posts')) !!}">
          {{ carbon_get_post_meta(get_the_ID(), 'front_recent_articles_header') }}
        </a>
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

          <div class="swiper-slide">
            <div class="post-card">
              <a href="{!! get_permalink(get_option('page_for_posts')) !!}">
                {!! wp_get_attachment_image(carbon_get_theme_option('posts_more_image'), 'post-card') !!}
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </section>

  <section class="mt-7 mt-lg-10 categories-section">
    <div class="container">
      <h2 class="h1 mb-3 mb-lg-5">
        {{ carbon_get_post_meta(get_the_ID(), 'front_article_categories_header') }}
      </h2>
    </div>

    <div class="container">
      <div class="row row-cols-1 row-cols-lg-3 g-3 g-lg-3">
        @foreach (carbon_get_post_meta(get_the_ID(), 'front_article_categories') as $category)
          <div class="col">
            <div class="card border-dark border-2">
              <a
                class="fw-bold"
                href="{{ get_category_link($category['id']) }}">
                <div class="card-body">
                  /{{ mb_strtolower(get_cat_name($category['id'])) }}
                </div>
              </a>
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
          <h2 class="h1 mb-3 mb-lg-5">
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

        <div class="d-none d-sm-block col-sm-6 text-end">
          {!! wp_get_attachment_image(carbon_get_post_meta(get_the_ID(), 'front_donate_image'), [550, 350], false, ['class' => 'floating-image']) !!}
        </div>
      </div>
    </div>
  </section>

  <section class="my-7 my-lg-10 connect-section">
    <div class="container">
      <h2 class="h1 break-word mb-3 mb-lg-5">
        {{ carbon_get_post_meta(get_the_ID(), 'front_connect_header') }}
      </h2>

      @php
        $connect_cards = carbon_get_post_meta(get_the_ID(), 'front_connect_blocks');
      @endphp

      <div class="row g-3">
        <div class="col-12 col-xl-4">
          <x-connect-card :card="$connect_cards[0]" />
        </div>
        <div class="col-12 col-xl-8">
          <div class="row g-3">
            <div class="col-12 col-md-6">
              <x-connect-card :card="$connect_cards[1]" />
            </div>
            <div class="col-12 col-md-6">
              <x-connect-card :card="$connect_cards[2]" />
            </div>
            <div class="col-12 text-body">
              <x-connect-card :card="$connect_cards[3]" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
