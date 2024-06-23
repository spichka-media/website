<div class="post-card-extended card border-0 h-100">
  <a href="{!! $url !!}">
    {!! $thumbnail !!}
  </a>

  <div class="card-body pt-6 pb-3 px-5 bg-light">
    <h4 class="card-title break-word mb-3 fs-5">
      <a class="link-dark" href="{!! $url !!}">{!! $title !!}</a>
    </h4>

    @if ($excerpt)
      <p class="fw-medium text-secondary">
        {!! $excerpt !!}
      </p>
    @endif
  </div>
  <div
    class="card-footer fs-7 fw-medium text-tertiary bg-light border-0 pt-0 px-5 pb-6">
    {!! $date !!}
  </div>
</div>
