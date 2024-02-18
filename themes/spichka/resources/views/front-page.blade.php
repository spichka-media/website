@extends('layouts.app')

@section('content')
  <section class="section-banner-video">
    <video class="banner-video" autoplay muted playsinline loop>
      <source src="https://spichka.media/wp-content/uploads/2020/12/%D1%81%D0%BF%D0%B8%D1%87%D0%BA%D0%B8.mp4"
        type="video/mp4">
    </video>

    <div class="container">
      <div class="header">
        <div class="row">
          <div class="col-sm-6">
            <h1>Марксистский журнал для умных, молодых и злых.</h1>
            <p>Рассказываем просто и интересно про общество, политику, историю, экономику, культуру и философию.
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

    <div class="container-fluid">
      @php
        // the query
        $program_posts = get_posts([
            'posts_per_page' => 10,
        ]);
      @endphp



      <div class="swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
          <!-- Slides -->
          @foreach ($program_posts as $post)
            <div class="swiper-slide">
              @include('partials.post-card', [
                  'title' => get_the_title($post->ID),
                  'thumbnail' => get_the_post_thumbnail($post->ID, 'post-card'),
                  'url' => get_post_permalink($post->ID),
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
        // the query
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
                  'url' => get_post_permalink($post->ID),
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
      @php
        // the query
        $categories = get_categories();
      @endphp
      <div class="row">
        @foreach ($categories as $category)
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

      <div class="swiper-connect strech-cards">
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
