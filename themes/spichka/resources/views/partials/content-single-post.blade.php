<article>
  <div class="container max-width-720">
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

          <div>
            {{ _e('Categories') }}:
            @php(the_category(', '))
          </div>

          <div>
            @php(the_date())
          </div>
        </div>
      </div>

      <div class="col-xs-12">
        {!! do_shortcode('[ez-toc]') !!}
      </div>

      <div class="col-xs-12">
        @php(the_content())

        @php(do_shortcode('[mistape format="text"]'))
      </div>
    </div>



  </div>
</article>
