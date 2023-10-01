<article>
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        @php(the_post_thumbnail('medium'))
      </div>
      <div class="col-sm-6">
        <h1>
          @php(the_title())
        </h1>

        <div>
          @php(the_author())
          @php(the_category())
          @php(the_date())
        </div>
        <div>
          {!! do_shortcode('[ez-toc]') !!}
        </div>
      </div>
    </div>


    <div class="row">
      @php(the_content())
    </div>
  </div>
</article>
