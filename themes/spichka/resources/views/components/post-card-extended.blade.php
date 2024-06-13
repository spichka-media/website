<div class="post-card-extended card border-0 h-100">
  <a href="{!! $url !!}">
    {!! $thumbnail !!}
  </a>

  <div class="card-body p-6 bg-light">
    <h4 class="card-title break-word mb-xl-4 fs-5">
      <a class="link-dark" href="{!! $url !!}">{!! $title !!}</a>
    </h4>

    <p class="card-text d-none d-lg-block">
      {!! $excerpt !!}
    </p>

    <div class="d-none d-lg-block fs-7 fw-medium text-secondary">
      {!! $date !!}
    </div>
  </div>
</div>
