<div class="toggle-tab-flex ">
    <div class="tab-item visible-viewportchecker visibility--check hidden {{ Route::is('calculator.gold') ? ' actived' : '' }}" >
        <span class="title-tab">{{ trans('main.bail_gold') }}</span>
        <span class="icon-bg-line"></span>
        <img class="image-def" src="/img/icon-gold-tab-def.png" alt="">
        <img class="image-actived" src="/img/icon-gold-tab.png" alt="">
        <a class="btn-actived-tabs" href="{{ route('calculator.gold')}}"></a>
      </div>
    <div class="tab-item visible-viewportchecker visibility--check hidden {{ Route::is('calculator.silver') ? ' actived' : '' }}" >
        <span class="title-tab">{{ trans('main.bail_silver') }}</span>
        <span class="icon-bg-line"></span>
        <img class="image-def" src="/img/icon-silver-tab-def.png" alt="">
        <img class="image-actived" src="/img/icon-silver-tab.png" alt="">
        <a class="btn-actived-tabs" href="{{ route('calculator.silver')}}"></a>
      </div>
    <div class="tab-item visible-viewportchecker visibility--check hidden {{ Route::is('calculator.technics') ? ' actived' : '' }}" >
        <span class="title-tab">{{ trans('main.bail_gadget') }}</span>
        <span class="icon-bg-line"></span>
        <img class="image-def" src="/img/icon-technicks-tab-def.png" alt="">
        <img class="image-actived" src="/img/icon-technicks-tab.png" alt="">
        <a class="btn-actived-tabs" href="{{ route('calculator.technics')}}"></a>
      </div>
</div>