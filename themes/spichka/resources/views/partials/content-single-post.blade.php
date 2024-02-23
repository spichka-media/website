<article class="mt-5 mb-5">
  <div class="container container-header">
    <div class="row gy-4">
      <div class="col-sm-6">
        @php(the_post_thumbnail('medium'))
      </div>
      <div class="col-sm-6">
        <h1>
          @php(the_title())
        </h1>

        <div>
          <small>{!! do_shortcode('[publishpress_authors_box layout="ppma_boxes_15606"]') !!}</small>

          <div id="post-categories">
            <small>{{ _e('Categories') }}:
              @php(the_category(', '))</small>
          </div>

          <div>
            <span>@svg('images.calendar-regular')</span>
            <small>@php(the_date('j F, Y'))</small>
          </div>
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
      </div>
    </div>
  </div>
</article>
