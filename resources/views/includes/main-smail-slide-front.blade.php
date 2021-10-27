<div class="wrap-slide-item">
  <div class="title visible-viewportchecker visibility--check">{{ trans('main.last_actions') }}</div>
  <span class="icon-bg-line"></span>
  <div class="control-slide">
      <div class="interface-widget">
          <ul class="arrow-list">
              <li class="next-card">
                  <span class="icon-arrow-l-primaryColor"></span>
              </li>
              <li class="prev-card">
                  <span class="icon-arrow-r-pimaryColor"></span>
              </li>
          </ul>
          <div class="slick__nav">
              <span class="total-dots"></span>
          </div>
          <div class="slider-progress">
              <div class="progress"></div>
          </div>
      </div>
      <div class="ref-all-card">
          <a href="#">
             <span class="btn-card">{{ trans('main.all_actions') }}</span>
             <span class="icon-arrow-l-secondColor"></span>
          </a>
      </div>
  </div>
  <div class="itself-slider">
      <div class="init-small-slide">
          @if(isset($actions))
          @forelse($actions as $action)
          <div class="el-card visible-viewportchecker visibility--check">
            <div class="content-card">
                <div class="el-img">
                  <img src="{{ asset('storage/images/action/'.$action->photo) }}" alt="{{ $action->title_ru }}">
                </div>
                @if($action->start_at or $action->finish_at)
                <div class="el-data">
                  <span class="icon-calendar"></span>
                  <p class="el-season">@if($action->start_at)
                          {{ trans('main.from') }} {{ \Jenssegers\Date\Date::parse($action->start_at)->format('d F') }}
                      @endif
                      @if($action->finish_at)
                          {{ trans('main.to') }} {{ \Jenssegers\Date\Date::parse($action->finish_at)->format('d F Y') }}
                      @endif</p>
                </div>
                @endif
                <div class="el-title">{{ $action['title_'.$locale] }}</div>
                {{-- <div class="el-title">Графік роботи 8 березня</div> --}} <!-- только в разделе новостей и акций есть этот заголовок -->
                {{-- <div class="el-description">
                    {!! str_limit(strip_tags($action['description_'.$locale]), 80, ' ...') !!}
                </div> --}}
                <a href="{{ route('actions.show', ['actions' => $action->alias]) }}" class="link-news">
                    <div class="btn-link">
                      <span>{{ trans('main.details') }}</span>
                      <span class="icon-arrow-l-secondColor"></span>
                    </div>
                </a>
            </div>
          </div>
          @empty
          @endforelse
          @endif
      </div>
  </div>
</div>