{{-- @todo Remove inline style --}}
<div class="container" style="padding-top: 7rem">
  <div class="row">
    <div class="col d-flex flex-column">
      <span class="h1 font-weight-bold text-dark mb-0">
        My<span class="text-primary">Vegan</span>Dashboard
      </span>
      <span class="text-gray">customizable dashboard with news, resources and inspiration</span>
    </div>

    {{-- Enable once we support authentication --}}
    @if(false)
    <div class="col-auto">
      <button type="button" class="btn rounded-pill bg-tertiary text-white mr-3">Sign up</button>
      <button type="button" class="btn rounded-pill btn-secondary text-white">Log in</button>
    </div>
    @endif
  </div>
</div>
