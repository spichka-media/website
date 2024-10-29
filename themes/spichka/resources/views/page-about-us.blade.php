@extends('layouts.app')

@section('content')
  <section class="hero-section">
    <div class="container position-relative">
      <div class="row border-sm-start border-sm-end border-0">
        <div class="col-12 col-sm-9 border-lg-end border-0">
          <h1 class="fw-x-bold lh-1 text-uppercase text-dark">
            {!! strip_tags(wpautop(carbon_get_post_meta(get_the_ID(), 'banner_title')), '<br>') !!}
          </h1>

          <div class="col-12 offset-lg-4 col-md-8 description fs-6">
            {!! wpautop(carbon_get_post_meta(get_the_ID(), 'banner_description')) !!}
          </div>
        </div>
      </div>

      <div class="image d-none d-lg-block position-absolute bottom-0 end-0">
        {!! wp_get_attachment_image(carbon_get_post_meta(get_the_ID(), 'banner_image'), 'full') !!}
      </div>
    </div>
  </section>

  <section class="about-section border-top">
    <div class="container">
      <div class="row border-sm-start border-sm-end border-0">
        <div class="col-12 col-md-4 border-sm-end border-0">
          <h2 class="mt-6">
            {{ carbon_get_post_meta(get_the_ID(), 'about_title') }}
          </h2>
        </div>

        <div class="col-12 col-md-8 col-lg-5">
          <div class="description py-4 fs-6">
            {!! wpautop(carbon_get_post_meta(get_the_ID(), 'about_description')) !!}
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="program-articles-section border-top">
    <div class="container">
      <h2 class="mt-6">
        {{ carbon_get_post_meta(get_the_ID(), 'articles_title') }}
      </h2>
    </div>

    <div class="mt-4 mb-8 swiper-container position-relative container-fluid">
      @php
        $program_articles = get_posts([
          'tax_query' => [
            [
              'taxonomy' => 'category',
              'field' => 'slug',
              'terms' => 'programm',
            ],
          ],
          'numberposts' => -1,
        ]);
      @endphp

      <div class="swiper pb-5">
        <div class="swiper-wrapper">
          @foreach ($program_articles as $post)
            <div class="swiper-slide">
              <x-post-card :post="$post" />
            </div>
          @endforeach

          <div class="swiper-slide">
            <div class="post-card">
              @if (! empty($program_term_link) && ! is_wp_error($program_term_link))
                <a href="{!! $program_term_link !!}">
                  {!! wp_get_attachment_image(carbon_get_theme_option('posts_more_image'), 'post-card') !!}
                </a>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </section>

  <section class="join-section border-top">
    <div class="container">
      <div class="row border-sm-start border-sm-end border-0">
        <div class="col-12 col-md-4 border-sm-end border-0">
          <h2 class="mt-6">
            {{ carbon_get_post_meta(get_the_ID(), 'join_title') }}
          </h2>
        </div>

        <div class="col-12 col-md-8 col-lg-5">
          <div class="description py-4 fs-6">
            {!! wpautop(carbon_get_post_meta(get_the_ID(), 'join_description')) !!}

            <a
              href="{{ carbon_get_post_meta(get_the_ID(), 'join_button_link') }}"
              target="_blank"
              class="btn btn-outline-dark fw-bold">
              {{ carbon_get_post_meta(get_the_ID(), 'join_button_text') }}
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="support-section border-top">
    <div class="container">
      <div class="row border-sm-start border-sm-end border-0">
        <div class="col-12 col-md-4 col-lg-3 border-sm-end border-0">
          <h2 class="mt-6">
            {{ carbon_get_post_meta(get_the_ID(), 'support_title') }}
          </h2>
        </div>

        <div
          class="col-12 col-md-4 col-lg-3 align-self-center border-md-end border-0 fs-6">
          <div class="my-6">
            <h3>
              {{ carbon_get_post_meta(get_the_ID(), 'support_block_1_title') }}
            </h3>

            {!! wpautop(carbon_get_post_meta(get_the_ID(), 'support_block_1_description')) !!}

            <a
              href="{{ carbon_get_post_meta(get_the_ID(), 'support_block_1_button_link') }}"
              target="_blank"
              class="btn mt-6 btn-outline-dark fw-bold w-100">
              {{ carbon_get_post_meta(get_the_ID(), 'support_block_1_button_text') }}
            </a>
          </div>
        </div>

        <div class="col-12 col-md-4 col-lg-3 border-lg-end border-0 fs-6">
          <h3 class="mt-6">
            {{ carbon_get_post_meta(get_the_ID(), 'support_block_1_title') }}
          </h3>

          {!! wpautop(carbon_get_post_meta(get_the_ID(), 'support_block_2_description')) !!}

          <a
            href="{{ carbon_get_post_meta(get_the_ID(), 'support_block_2_button_link') }}"
            target="_blank"
            class="mt-6 mb-4 btn btn-outline-dark fw-bold w-100">
            {{ carbon_get_post_meta(get_the_ID(), 'support_block_2_button_text') }}
          </a>
        </div>

        <div class="col-12 col-lg-3 p-lg-0 image">
          {!! wp_get_attachment_image(carbon_get_post_meta(get_the_ID(), 'support_image'), 'full') !!}
        </div>
      </div>
    </div>
  </section>

  <section class="footer-section border-top">
    <div class="container">
      <div class="row border-sm-start border-sm-end border-0">
        <div class="d-none d-sm-block col-3 border-sm-end border-0"></div>
        <div class="d-none d-sm-block col-3 border-sm-end border-0"></div>
        <div class="col align-self-end my-7">
          <div class="m-0 fs-5 fw-bold text-md-end">
            {{ carbon_get_post_meta(get_the_ID(), 'footer_title') }}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
