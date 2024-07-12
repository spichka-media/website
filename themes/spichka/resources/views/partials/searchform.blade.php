<form role="search" method="get" action="{{ home_url('/') }}">
  <label class="screen-reader-text" for="s">{{ __('Search') }}</label>
  <div
    class="d-flex align-items-center form-group has-search p-3 bg-tertiary bg-opacity-10">
    <span class="fa fa-search text-tertiary form-control-feedback l-1"></span>

    <input
      type="search"
      value="{{ get_search_query() }}"
      name="s"
      class="form-control w-100 ms-2 bg-transparent focus-ring shadow-none text-white border-0"
      placeholder="{{ __('Search') }}" />

    <button
      class="btn d-flex p-2 align-items-center justify-content-center btn-secondary rounded-circle"
      type="reset"
      title="{{ __('Reset') }}">
      <i class="small fa-solid text-tertiary fa-xmark"></i>
    </button>
  </div>
</form>
