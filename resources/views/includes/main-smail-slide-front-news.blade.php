<div class="wrap-slide-item">
    <div class="title visible-viewportchecker visibility--check">{{ trans('main.last_news') }}</div>
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
                <span class="btn-card">{{ trans('main.all_news') }}</span>
                <span class="icon-arrow-l-secondColor"></span>
            </a>
        </div>
    </div>
    <div class="itself-slider">
        <div class="init-small-slide">
            @if(isset($news))
            @forelse($news as $new)
            <div class="el-card visible-viewportchecker visibility--check">
                <div class="content-card">
                    <div class="el-img">
                        <img src="{{ asset('storage/images/news/'.$new->image_small) }}" alt="{{ $new->title_ru }}">
                    </div>
                    @if($new->start_at or $new->date)
                    <div class="el-data">
                        <span class="icon-calendar"></span>
                        <p class="el-season">{{ \Jenssegers\Date\Date::parse($new->date)->format('d F Y') }}</p>
                    </div>
                    @endif
                    <div class="el-title">{{ $new['title_'.$locale] }}</div>
                    {{-- <div class="el-title">Графік роботи 8 березня</div> --}} <!-- только в разделе новостей и акций есть этот заголовок -->
                    <div class="el-description">
                        {!! str_limit(strip_tags($new['description_'.$locale]), 50, ' ...') !!}
                    </div>
                    <a href="{{ route('news.show', ['actions' => $new->alias]) }}" class="link-news">
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