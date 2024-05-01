<article class="mt-5 mb-5">
  <div class="container container-header">
    <div class="row gy-4">
      <div class="col-sm-6">
        @php(the_post_thumbnail('medium'))
      </div>
      <div class="col-sm-6 d-flex flex-column row-gap-4">
        <h1>
          @php(the_title())
        </h1>

        <div class="d-flex flex-column row-gap-3">
          <div class="d-flex align-items-baseline" id="post-categories">
            <i class="icon me-2 fas fa-bookmark"></i>
            <div>
              <span>{{ _e('Categories') }}:</span><span class="ms-1">@php(the_category(', '))</span>
            </div>
          </div>

          @if(has_tag())
            <div class="d-flex align-items-baseline" id="post-tags">
              <i class="icon me-2 fas fa-tags"></i>
              <span>{{ _e('Tags') }}:</span>
              <div>@php(the_tags('', ', '))</div>
            </div>
          @endif

          <div class="d-flex align-items-baseline">
            <i class="icon me-2 fas fa-user"></i>
            <div>{!! do_shortcode('[publishpress_authors_box layout="ppma_boxes_15606"]') !!}</div>
          </div>
        </div>

        <div class="d-flex align-items-baseline">
          @php(the_date('j F, Y'))
        </div>

        <div>
          {!! do_shortcode('[ez-toc]') !!}
        </div>
      </div>
    </div>
  </div>

  <div class="container container-body mt-5">
    <div class="row">
      <div class="col-xs-12">
        @php(the_content())

        @php(do_shortcode('[mistape format="text"]'))

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
