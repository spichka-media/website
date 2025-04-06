{{-- overflow-hidden - fixes horizontal scroll for the slider on mobile. --}}
<article class="mt-md-4 mb-4 mt-lg-6 mb-lg-6 overflow-hidden">
  <div class="container">
    <div class="row justify-content-center gx-md-7 gy-3 gy-md-0">
      <div class="col-md-6 col-xl-5">
        @php(the_post_thumbnail('xs', ['data-no-lazy' => '1', 'decoding' => 'auto', 'id' => 'featured-image']))
      </div>
      <div class="col-md-6 col-xl-5 d-flex flex-column row-gap-5">
        <h1 class="mb-0">
          @php(the_title())
        </h1>

        <div class="d-flex flex-column row-gap-2">
          <div class="d-flex align-items-baseline" id="article-categories">
            <i class="fa-fw me-2 fas fa-bookmark"></i>
            <span>
              <span class="fw-x-bold">{{ _e('Categories') }}:</span>
              <span>@php(the_category(', '))</span>
            </span>
          </div>

          @if (has_tag())
            <div class="d-flex align-items-baseline" id="article-tags">
              <i class="fa-fw me-2 fas fa-tags"></i>
              <span>
                <span class="fw-x-bold">{{ _e('Tags') }}:</span>
                <span>@php(the_tags('', ', '))</span>
              </span>
            </div>
          @endif

          <div class="d-flex align-items-baseline">
            <i class="fa-fw me-2 fas fa-user"></i>
            {!! do_shortcode('[publishpress_authors_box]') !!}
          </div>
        </div>

        <div class="d-flex align-items-baseline">
          <i class="fa-fw me-2 fa-regular fa-calendar"></i>
          <span>@php(the_date('j F, Y'))</span>
        </div>

        @if ($show_toc)
          {!! do_shortcode('[ez-toc]') !!}
        @endif
      </div>
    </div>
  </div>

  <div class="container mt-8 fs-6 container-body">
    <div class="row justify-content-center">
      <div id="content" class="col-12 col-lg-9 col-xl-8 px-xl-6">
        @if (has_excerpt())
          <p class="fs-4">{!! strip_tags(get_the_excerpt()) !!}</p>
        @endif

        @php(the_content())
      </div>

      @php($telegramChannel = carbon_get_theme_option('theme_telegram_channel'))
      @php($telegramPostId = carbon_get_post_meta(get_the_ID(), 'post_telegram_post_id'))
      @php($callToActions = carbon_get_theme_option('theme_call_to_action'))

      {{-- В настройках массив по порядку, с постом, потом без  --}}
      @php($callToActionSettings = $callToActions[$telegramPostId ? 0 : 1] ?? [])

      @if ($callToActionSettings && $telegramChannel)
        <div class="col-12 col-lg-9 col-xl-8 px-xl-6">
          <div class="call-to-action position-relative text-white bg-dark p-6">
            @if (!empty($callToActionSettings['video']))
              <div
                class="media position-absolute z-0 top-0 bottom-0 object-fit-cover d-flex justify-content-end">
                <video class="video h-100 w-100" playsinline autoplay muted loop>
                  <source
                    src="{{ wp_get_attachment_url($callToActionSettings['video']) }}"
                    type="video/mp4"/>
                </video>
              </div>
            @endif

            <div
              class="row align-items-center justify-content-between position-relative z-2">
              <div class="col-md-6">
                <div class="h3 mt-0 fw-bold">
                  {{ $callToActionSettings['title'] }}
                </div>

                <p class="sf-6 mb-0">
                  {{ $callToActionSettings['description'] }}
                </p>
              </div>

              <div class="col-md-4">
                <a
                  href="{{ "https://t.me/$telegramChannel" . ($telegramPostId ? "/$telegramPostId" : '') }}"
                  target="_blank"
                  data-gtag-event="called_to_action"
                  class="btn btn-outline-light fw-bold border-2 text-decoration-none w-100 d-flex align-items-center justify-content-center">
                  @if (!empty($callToActionSettings['button_icon']))
                    <img
                      alt="button_icon"
                      src="{{ wp_get_attachment_url($callToActionSettings['button_icon']) }}"
                      class="me-2 fs-4"/>
                  @endif
                  {{ $callToActionSettings['button_text'] }}
                </a>
              </div>
            </div>
          </div>
        </div>
      @endif

      @php($recommended_posts = get_post_recommendations(get_the_ID()))
      @if (count($recommended_posts))
        <div class="col-12 col-lg-9 col-xl-8 px-xl-6">
          <div class="h3 fw-medium">
            {{ carbon_get_theme_option('recommended_posts_title') }}
          </div>
          <hr class="my-0" />
          <div class="mt-5 mb-6">
            <div class="gx-5 gy-5 row">
              @foreach ($recommended_posts as $recommended_post)
                <a
                  class="d-block recommended-card col-md-6"
                  href="{{ get_the_permalink($recommended_post->ID) }}">
                  <span class="row">
                    @if (has_post_thumbnail($recommended_post->ID))
                      <span class="d-block col-auto">
                        <span class="d-block overflow-hidden">
                          {!! preg_replace('/(srcset|sizes)="[^"]*"/', '', get_the_post_thumbnail($recommended_post->ID, [65, 92])) !!}
                        </span>
                      </span>
                    @endif

                    <span class="d-block col ps-1">
                      <span class="title text-dark fs-7 fw-semibold">
                        {{ get_the_title($recommended_post->ID) }}
                      </span>

                      @if (has_excerpt($recommended_post->ID))
                        <span
                          class="d-block excerpt mt-1 mb-0 fs-8 text-secondary">
                          {{ get_the_excerpt($recommended_post->ID) }}
                        </span>
                      @endif
                    </span>
                  </span>
                </a>
              @endforeach
            </div>
          </div>
        </div>
      @endif

      @if (carbon_get_post_meta(get_the_ID(), 'post_show_comments') && $telegramChannel && $telegramPostId)
        <div class="col-12 col-lg-9 col-xl-8 px-xl-6">
          <script
            async
            src="https://telegram.org/js/telegram-widget.js?22"
            data-telegram-discussion="{{ $telegramChannel . '/' . $telegramPostId }}"
            data-comments-limit="5"
            data-color="343638"
            data-dark-color="FFFFFF"></script>
        </div>
      @endif
    </div>
  </div>
</article>
