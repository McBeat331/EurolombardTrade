<div class="content-wrap {{ Route::is('calculator.gold') ? ' gold' : '' }} {{ Route::is('calculator.silver') ? ' silver' : '' }} {{ Route::is('calculator.technics') ? ' technics' : '' }}">
  <div class="content">
    <div class="aside-title visible-viewportchecker visibility--check hidden visible animated bounceInLeft">
    {{ trans('main.conducted_assessment') }}
    </div>
    <div class="aside-description visible-viewportchecker visibility--check hidden visible animated bounceInLeft">
    {{ trans('main.assessment') }}
    </div>
  </div>
</div>