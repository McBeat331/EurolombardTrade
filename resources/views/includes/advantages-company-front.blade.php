<div class="advantages-content-wrap">
  <div class="title visible-viewportchecker visibility--check hidden">{{ trans('main.advantages_title') }}</div>
  <div class="advantages-item-wrapper">
    @if(isset($yougets))
    @forelse($yougets as $youget)
    <div class="advantages-item visible-viewportchecker visibility--check hidden">
      <div class="advant-card"></div>
      <div class="item-icon icon-rocket">
        <img src="{{ asset('storage/images/main/'.$youget->image) }}" alt="{{ $youget->title_ru }}">
      </div>
      <div class="item-title">{{ $youget['title_'.$locale] }}</div>
      <div class="item-text">
        {!! nl2br($youget['description_'.$locale]) !!}
      </div>
    </div>
    @empty
    @endforelse
      @endif


  </div>
</div>