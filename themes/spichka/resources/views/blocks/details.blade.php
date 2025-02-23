<div class="accordion my-6" id="accordion-{{ $accordionId }}">
  <div class="accordion-item overflow-hidden">
    <button
      class="accordion-button collapsed"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#{{ $accordionContentId }}"
      aria-expanded="false"
      aria-controls="{{ $accordionContentId }}">
      <span class="header fs-6 fw-bold">
        {{ $header }}
      </span>
    </button>

    <div
      id="{{ $accordionContentId }}"
      class="accordion-collapse collapse"
      data-bs-parent="#accordion-{{ $accordionId }}">
      <div class="accordion-body last-mb-0">
        {!! wpautop($body) !!}
      </div>
    </div>
  </div>
</div>
