<div class="wrap-slide-item">
  <div class="title visible-viewportchecker visibility--check">{{ trans('main.ourServices') }}</div>
  <div class="itself-slider">
      <div class="init-small-slide">
          @if(isset($services))
          @forelse($services as $service)
          <div class="el-card visible-viewportchecker visibility--check">
            <div class="content-card">
                <div class="el-img">
                  <img src="{{ asset('storage/services/'.$service->image) }}" alt="{{ $service->title }}">
                </div>
                <div class="el-title">{{ $service->title }}</div>
                {{-- <div class="el-title">{{ $service->title }} </div> --}} <!-- только в разделе новостей и акций есть этот заголовок -->
                {{-- <div class="el-description">
                    {!! str_limit(strip_tags($service->description), 80, ' ...') !!}
                </div> --}}
                <a href="#" class="link-news">
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