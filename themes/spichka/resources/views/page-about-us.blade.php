@extends('layouts.app')

@section('content')
  <section class="hero-section">
    <div class="container position-relative">
      <div class="row gx-6 border-sm-start border-sm-end border-0">
        <div class="col-12 col-lg-9 border-lg-end border-0">
          <div class="row">
            <div class="col-12">
              <h1 class="fw-x-bold lh-1 text-uppercase text-dark mt-9 mt-lg-14">
                {!! strip_tags(wpautop(carbon_get_post_meta(get_the_ID(), 'banner_title')), '<br>') !!}
              </h1>
            </div>

            <div class="d-lg-none ms-auto col-6 my-7">
              <div class="image position-relative">
                {!! wp_get_attachment_image(carbon_get_post_meta(get_the_ID(), 'banner_image'), 'full') !!}
              </div>
            </div>

            <div
              class="col-12 offset-lg-4 col-lg-8 description pb-9 pt-4 py-lg-14 fs-6">
              {!! wpautop(carbon_get_post_meta(get_the_ID(), 'banner_description')) !!}
            </div>
          </div>
        </div>
      </div>

      <div class="image d-none d-lg-block position-absolute bottom-0 end-0">
        {!! wp_get_attachment_image(carbon_get_post_meta(get_the_ID(), 'banner_image'), 'full') !!}
      </div>
    </div>
  </section>

  <section class="about-section border-top pb-9 py-sm-0">
    {!! wp_get_attachment_image(carbon_get_post_meta(get_the_ID(), 'about_decoration'), 'full', false, ['class' => 'd-sm-none']) !!}

    <div class="container">
      <div class="row gx-6 border-sm-start border-sm-end border-0">
        <div class="col-12 col-md-3 border-0">
          <h2 class="h3 pt-0 pt-sm-6 mb-6 mb-md-0">
            {{ carbon_get_post_meta(get_the_ID(), 'about_title') }}
          </h2>
        </div>

        <div class="col-12 col-md-8 col-lg-5 border-md-start">
          <div class="description pt-md-14 mb-sm-9 mb-md-6 fs-6">
            {!! wpautop(carbon_get_post_meta(get_the_ID(), 'about_description')) !!}
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="program-articles-section border-top border-lg-0">
    <div class="container">
      <div class="row gx-6 border-sm-start border-sm-end border-0 py-9 py-sm-0">
        <div class="offset-lg-3 col-12 col-lg-9 border-lg-start border-0">
          <h2 class="h3 pt-0 pt-sm-6 mb-4 mb-md-0">
            {{ carbon_get_post_meta(get_the_ID(), 'articles_title') }}
          </h2>
        </div>

        <div class="offset-lg-3 col border-lg-start border-0">
          <div class="mt-4 mb-8 swiper-container position-relative">
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
        </div>
      </div>
    </div>
  </section>

  <section class="join-section border-top">
    <div class="container overflow-hidden">
      <div class="row gx-6 border-sm-start border-sm-end border-0 py-9 py-sm-0">
        <div class="col-12 col-md-3 border-0">
          <h2 class="h3 pt-0 pt-sm-6 mb-6 mb-md-0">
            {{ carbon_get_post_meta(get_the_ID(), 'join_title') }}
          </h2>
        </div>

        <div class="col-12 col-md-8 col-lg-5 border-md-start">
          <div class="description py-md-14 fs-6">
            {!! wpautop(carbon_get_post_meta(get_the_ID(), 'join_description')) !!}

            <a
              href="{{ carbon_get_post_meta(get_the_ID(), 'join_button_link') }}"
              target="_blank"
              class="mt-6 mb-sm-9 mb-md-0 btn btn-outline-dark fw-bold">
              {{ carbon_get_post_meta(get_the_ID(), 'join_button_text') }}
            </a>
          </div>
        </div>
      </div>

      {!! wp_get_attachment_image(carbon_get_post_meta(get_the_ID(), 'join_decoration'), 'full', false, ['class' => 'd-sm-none join-decoration w-100']) !!}
    </div>
  </section>

  <section class="support-section border-top">
    <div class="container overflow-hidden">
      <div class="row gx-6 border-sm-start border-sm-end border-0 py-9 py-sm-0">
        <div class="col-12 col-md-3 border-0">
          <h2 class="h3 m-0 pt-sm-6">
            {{ carbon_get_post_meta(get_the_ID(), 'support_title') }}
          </h2>
        </div>

        <div
          class="col-12 col-md-4 col-lg-3 mt-9 mt-md-0 border-md-start border-md-end border-0 fs-6">
          <div class="support-block-1">
            <h3 class="h5">
              {{ carbon_get_post_meta(get_the_ID(), 'support_block_1_title') }}
            </h3>

            {!! wpautop(carbon_get_post_meta(get_the_ID(), 'support_block_1_description')) !!}

            <a
              href="{{ carbon_get_post_meta(get_the_ID(), 'support_block_1_button_link') }}"
              target="_blank"
              class="btn mt-4 btn-outline-dark fw-bold w-md-100">
              {{ carbon_get_post_meta(get_the_ID(), 'support_block_1_button_text') }}
            </a>
          </div>
        </div>

        {!! wp_get_attachment_image(carbon_get_post_meta(get_the_ID(), 'support_decoration'), 'full', false, ['class' => 'd-sm-none my-6 support-decoration']) !!}

        <div
          class="col-12 col-md-4 col-lg-3 mt-sm-9 mt-md-0 border-lg-end border-0 fs-6">
          <h3 class="h5 mt-0 mt-md-6">
            {{ carbon_get_post_meta(get_the_ID(), 'support_block_2_title') }}
          </h3>

          {!! wpautop(carbon_get_post_meta(get_the_ID(), 'support_block_2_description')) !!}

          <a
            href="{{ carbon_get_post_meta(get_the_ID(), 'support_block_2_button_link') }}"
            target="_blank"
            class="mt-3 mb-sm-9 mb-md-0 mb-md-0 btn btn-outline-dark fw-bold w-md-100">
            {{ carbon_get_post_meta(get_the_ID(), 'support_block_2_button_text') }}
          </a>
        </div>

        <div class="d-none d-lg-block col-lg-3 p-lg-0">
          {!! wp_get_attachment_image(carbon_get_post_meta(get_the_ID(), 'support_image'), 'full') !!}
        </div>
      </div>
    </div>
  </section>

  <section class="footer-section border-top">
    <div
      class="d-lg-none image-container container-fluid mt-9 mt-lg-0 mb-4 mb-lg-0"
      style="
        background-image: url({{ wp_get_attachment_url(carbon_get_post_meta(get_the_ID(), 'footer_pattern')) }});
      ">
      <div class="row gx-6">
        <div class="ms-auto col-6 col-sm-5 d-flex">
          {!! wp_get_attachment_image(carbon_get_post_meta(get_the_ID(), 'support_image'), 'full', false, ['class' => 'ms-auto mb-4']) !!}
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row gx-6 border-lg-start border-lg-end border-0">
        <div class="d-none d-lg-block col-3 border-0"></div>
        <div
          class="d-none d-lg-block col-3 border-lg-start border-lg-end border-0"></div>
        <div class="col align-self-end py-7">
          <div class="m-0 fs-5 fw-bold text-lg-end">
            {{ carbon_get_post_meta(get_the_ID(), 'footer_title') }}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
