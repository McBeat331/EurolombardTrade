<div class="advantages-content-wrap">
  <div class="title visible-viewportchecker visibility--check hidden">{{ trans('main.advantages_title') }}</div>
  <div class="advantages-item-wrapper">
    @if(isset($advantages))
    @forelse($advantages as $advantage)
    <div class="advantages-item visible-viewportchecker visibility--check hidden">
      <div class="advant-card"></div>
      <div class="item-icon icon-rocket">
        <img src="{{ asset('storage/advantages/'.$advantage->image) }}" alt="{{ $advantage->title }}">
      </div>
      <div class="item-title">{{ $advantage->title }}</div>
      <div class="item-text">
        {!! nl2br($advantage->description) !!}
      </div>
    </div>
    @empty
    @endforelse
      @endif


  </div>
</div>