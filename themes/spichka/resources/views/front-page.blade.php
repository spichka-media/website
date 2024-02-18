@extends('layouts.app')

@section('content')
  <section class="section-banner-video">
    <video class="banner-video" autoplay muted playsinline loop>
      <source src="{{ wp_get_attachment_url(carbon_get_post_meta(get_the_ID(), 'front_banner_video')) }}" type="video/mp4">
    </video>

    <div class="container">
      <div class="header">
        <div class="row">
          <div class="col-sm-6">
            <h1>{{ carbon_get_post_meta(get_the_ID(), 'front_banner_header') }}</h1>
            <p>{{ carbon_get_post_meta(get_the_ID(), 'front_banner_description') }}</p>
          </div>
        </div>
        </p>
      </div>
    </div>
  </section>

  <section class="program-articles">
    <div class="container">
      <h2>
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
              @include('partials.post-card', [
                  'title' => get_the_title($post->ID),
                  'thumbnail' => get_the_post_thumbnail($post->ID, 'post-card'),
                  'url' => get_permalink($post->ID),
              ])
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <section class="program-articles">
    <div class="container">
      <h2>
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
              @include('partials.post-card', [
                  'title' => get_the_title($post->ID),
                  'thumbnail' => get_the_post_thumbnail($post->ID, 'post-card'),
                  'url' => get_permalink($post->ID),
              ])
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>


  <section class="categories">
    <div class="container">
      <h2>
        {{ carbon_get_post_meta(get_the_ID(), 'front_article_categories_header') }}
      </h2>
    </div>

    <div class="container">
      <div class="row">
        @foreach (get_categories() as $category)
          <div class="col-sm-3">
            <a href="{{ get_category_link($category->term_id) }}">/{{ $category->name }}</a>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <section class="donate-section">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h2>
            {{ carbon_get_post_meta(get_the_ID(), 'front_donate_header') }}
          </h2>

          <p>
            {{ carbon_get_post_meta(get_the_ID(), 'front_donate_description') }}
          </p>

          <a class="btn btn-outline-light btn-big">
            <i class="fas fa-coins"></i>{{ carbon_get_post_meta(get_the_ID(), 'front_donate_button_text') }}
          </a>
        </div>

        <div class="col-sm-6">
          {!! wp_get_attachment_image(carbon_get_post_meta(get_the_ID(), 'front_donate_image'), [550, 350]) !!}
        </div>
      </div>
    </div>
  </section>

  <section class="connect">
    <div class="container">
      <h2>
        {{ carbon_get_post_meta(get_the_ID(), 'front_connect_header') }}
      </h2>

      <div class="swiper-connect stretch-cards">
        <div class="swiper-wrapper">
          @foreach (carbon_get_post_meta(get_the_ID(), 'front_connect_blocks') as $block)
            <div class="swiper-slide">
              <div class="connect-card">
                <h3>{{ $block['front_connect_blocks_block_header'] }}</h3>
                <p>{{ $block['front_connect_blocks_block_description'] }}</p>

                @if ($block['front_connect_blocks_block_button_text'])
                  <a class="btn btn-outline-light btn-big" href="mailto:info@spichka.media"><i
                      class="far fa-envelope"></i>
                    {{ $block['front_connect_blocks_block_button_text'] }}</a>
                @endif
              </div>
            </div>
          @endforeach
        </div>
      </div>
  </section>
@endsection
