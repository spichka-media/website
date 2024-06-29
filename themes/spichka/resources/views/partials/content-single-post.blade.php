<article class="my-4 my-lg-6">
  <div class="container">
    <div class="row justify-content-center gx-md-7 gy-3 gy-md-0">
      <div class="col-md-6 col-xl-5">
        @php(the_post_thumbnail('xs', ['data-no-lazy' => '1', 'decoding' => 'auto']))
      </div>
      <div class="col-md-6 col-xl-5 d-flex flex-column row-gap-5">
        <h1 class="mb-0">
          @php(the_title())
        </h1>

        <div class="d-flex flex-column row-gap-2">
          <div class="d-flex align-items-baseline" id="post-categories">
            <i class="fa-fw me-2 fas fa-bookmark"></i>
            <span>
              <span class="fw-x-bold">{{ _e('Categories') }}:</span>
              <span class="ms-1">@php(the_category(', '))</span>
            </span>
          </div>

          @if (has_tag())
            <div class="d-flex align-items-baseline" id="post-tags">
              <i class="fa-fw me-2 fas fa-tags"></i>
              <span>
                <span class="fw-x-bold">{{ _e('Tags') }}:</span>
                <span>@php(the_tags('', ', '))</span>
              </span>
            </div>
          @endif

          <div class="d-flex align-items-baseline">
            <i class="fa-fw me-2 fas fa-user"></i>
            {!! do_shortcode('[publishpress_authors_box layout="ppma_boxes_15606"]') !!}
          </div>
        </div>

        <div class="d-flex align-items-baseline">
          <i class="fa-fw me-2 fa-regular fa-calendar"></i>
          <span>@php(the_date('j F, Y'))</span>
        </div>

        {!! do_shortcode('[ez-toc]') !!}
      </div>
    </div>
  </div>

  <div class="container mt-10 fs-6 container-body">
    <div class="row justify-content-center">
      <div id="content" class="col-12 col-lg-9 col-xl-8 px-xl-6">
        @if (has_excerpt())
          <p class="fs-4">{!! strip_tags(get_the_excerpt()) !!}</p>
        @endif

        @php(the_content())
      </div>

      <div class="col-12 col-lg-9 col-xl-8 px-xl-6">
        @if (carbon_get_post_meta(get_the_ID(), 'post_show_comments') && carbon_get_theme_option('theme_telegram_channel'))
          <script
            async
            src="https://telegram.org/js/telegram-widget.js?22"
            data-telegram-discussion="{{ carbon_get_theme_option('theme_telegram_channel') }}{{ carbon_get_post_meta(get_the_ID(), 'post_telegram_post_id') ? '/' . carbon_get_post_meta(get_the_ID(), 'post_telegram_post_id') : '' }}"
            data-comments-limit="5"
            data-color="343638"
            data-dark-color="FFFFFF"></script>
        @endif
      </div>
    </div>
  </div>
</article>
