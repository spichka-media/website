<article class="mt-5 mb-5">
  <div class="container max-width-1140">
    <div class="row">
      <div class="col-sm-6">
        @php(the_post_thumbnail('medium'))
      </div>
      <div class="col-sm-6">
        <h1>
          @php(the_title())
        </h1>

        <div>
          {!! do_shortcode('[publishpress_authors_box layout="ppma_boxes_15606"]') !!}

          <div id="post-categories">
            {{ _e('Categories') }}:
            @php(the_category(', '))
          </div>

          <div class="mt-2 fs-6 fw-400">
            <span>@svg('images.calendar-regular')</span>
            @php(the_date('j F, Y'))
          </div>
        </div>

        <div>
          {!! do_shortcode('[ez-toc]') !!}
        </div>
      </div>
    </div>
  </div>

  <div class="container max-width-720 mt-5">
    <div class="row">
      <div class="col-xs-12">
        @php(the_content())

        @php(do_shortcode('[mistape format="text"]'))
      </div>
    </div>
  </div>
</article>
