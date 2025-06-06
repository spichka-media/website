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
        class="btn btn-nav link-to-content text-body fs-3 lh-1 bg-white d-flex align-items-center justify-content-center rounded-circle text-decoration-none z-1"
        href="#start">
        <i class="fa-solid fa-angle-down"></i>
      </a>
    </div>

    <video
      poster="{{ wp_get_attachment_url(carbon_get_post_meta(get_the_ID(), 'front_banner_video_poster')) }}"
      class="video-element position-absolute z-0 top-0 start-0 bottom-0 end-0 object-fit-cover w-100 h-100"
      autoplay
      muted
      playsinline
      loop>
      <source
        src="{{ wp_get_attachment_url(carbon_get_post_meta(get_the_ID(), 'front_banner_video')) }}"
        type="video/webm" />
    </video>
  </section>

  <section id="start" class="mt-7 mt-lg-10 program-articles-section">
    <div class="container">
      @php
        $term = carbon_get_post_meta(get_the_ID(), 'front_program_articles_taxonomy');
        $program_term_link = ! empty($term[0]) ? get_term_link(intval($term[0]['id'])) : null;
      @endphp

      @if (! empty($program_term_link) && ! is_wp_error($program_term_link))
        <h2 class="h1 mb-3 mb-lg-5 break-word">
          <a class="link-dark" href="{!! $program_term_link !!}">
            {{ carbon_get_post_meta(get_the_ID(), 'front_program_articles_header') }}
          </a>
        </h2>
      @endif
    </div>

    <div class="container-fluid">
      <div class="swiper-block position-relative" data-swiper-type="articles">
        @php
          const MAX_RECENT_PROGRAM_ARTICLES = 10;
          $program_articles = get_posts([
            'include' => array_pluck(carbon_get_post_meta(get_the_ID(), 'front_program_articles'), 'id'),
            'posts_per_page' => MAX_RECENT_PROGRAM_ARTICLES,
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

            @if (count($program_articles) === MAX_RECENT_PROGRAM_ARTICLES && carbon_get_post_meta(get_the_ID(), 'front_program_articles_taxonomy'))
              <div class="swiper-slide">
                <div class="post-card">
                  @if (! empty($program_term_link) && ! is_wp_error($program_term_link))
                    <a href="{!! $program_term_link !!}">
                      {!! wp_get_attachment_image(carbon_get_theme_option('posts_more_image'), 'post-card') !!}
                    </a>
                  @endif
                </div>
              </div>
            @endif
          </div>
          <button class="btn btn-nav swiper-button swiper-button-prev">
            <i class="fa-solid fa-angle-left"></i>
          </button>
          <button class="btn btn-nav swiper-button swiper-button-next">
            <i class="fa-solid fa-angle-right"></i>
          </button>
        </div>

        <div class="swiper-pagination-bullets mt-2"></div>
      </div>
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

    <div class="container-fluid">
      <div class="swiper-block position-relative" data-swiper-type="articles">
        @php
          const MAX_RECENT_POSTS = 10;
          $recent_posts = get_posts([
            'posts_per_page' => MAX_RECENT_POSTS,
            'tax_query' => [
              'relation' => 'OR',
              [
                'taxonomy' => 'translation_lang',
                'field' => 'slug',
                'terms' => 'ru',
              ],
              [
                'taxonomy' => 'translation_lang',
                'field' => 'id',
                'operator' => 'NOT EXISTS',
              ],
            ],
          ]);
        @endphp

        <div class="swiper">
          <div class="swiper-wrapper">
            @foreach ($recent_posts as $post)
              <div class="swiper-slide">
                <x-post-card :post="$post" />
              </div>
            @endforeach

            @if (count($recent_posts) === MAX_RECENT_POSTS)
              <div class="swiper-slide">
                <div class="post-card">
                  <a
                    href="{!! get_permalink(get_option('page_for_posts')) !!}">
                    {!! wp_get_attachment_image(carbon_get_theme_option('posts_more_image'), 'post-card') !!}
                  </a>
                </div>
              </div>
            @endif
          </div>
          <button class="btn btn-nav swiper-button swiper-button-prev">
            <i class="fa-solid fa-angle-left"></i>
          </button>
          <button class="btn btn-nav swiper-button swiper-button-next">
            <i class="fa-solid fa-angle-right"></i>
          </button>
        </div>

        <div class="swiper-pagination-bullets mt-2"></div>
      </div>
    </div>
  </section>

  <section class="mt-7 mt-lg-10 recent-notes-section">
    <div class="container">
      <h2 class="h1 mb-3 mb-lg-5">
        <a class="link-dark" href="{!! get_post_type_archive_link('note') !!}">
          {{ carbon_get_post_meta(get_the_ID(), 'front_recent_notes_header') }}
        </a>
      </h2>
    </div>

    <div class="container-fluid">
      <div class="swiper-block position-relative" data-swiper-type="articles">
        @php
          const MAX_RECENT_NOTES = 10;
          $recent_notes = get_posts([
            'posts_per_page' => 10,
            'post_type' => 'note',
          ]);
        @endphp

        <div class="swiper">
          <div class="swiper-wrapper">
            @foreach ($recent_notes as $note)
              <div class="swiper-slide">
                <x-post-card :post="$note" />
              </div>
            @endforeach

            @if (count($recent_notes) === MAX_RECENT_NOTES)
              <div class="swiper-slide">
                <div class="post-card">
                  <a href="{!! get_post_type_archive_link('note') !!}">
                    {!! wp_get_attachment_image(carbon_get_theme_option('notes_more_image'), 'post-card') !!}
                  </a>
                </div>
              </div>
            @endif
          </div>
        </div>

        <button class="btn btn-nav swiper-button swiper-button-prev">
          <i class="fa-solid fa-angle-left"></i>
        </button>
        <button class="btn btn-nav swiper-button swiper-button-next">
          <i class="fa-solid fa-angle-right"></i>
        </button>

        <div class="swiper-pagination-bullets mt-2"></div>
      </div>
    </div>
  </section>

  <section class="mt-7 mt-lg-10 categories-section">
    <div class="container">
      <h2 class="h1 mb-3 mb-lg-5">
        {{ carbon_get_post_meta(get_the_ID(), 'front_article_categories_header') }}
      </h2>
    </div>

    <div class="container">
      <div class="row row-cols-1 row-cols-lg-3 g-3">
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

  @php
    $connect_cards = carbon_get_post_meta(get_the_ID(), 'front_connect_blocks');
  @endphp

  @if (! empty($connect_cards))
    <section class="my-7 my-lg-10 connect-section">
      <div class="container">
        <h2 class="h1 break-word mb-3 mb-lg-5">
          {{ carbon_get_post_meta(get_the_ID(), 'front_connect_header') }}
        </h2>

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
  @endif
@endsection
