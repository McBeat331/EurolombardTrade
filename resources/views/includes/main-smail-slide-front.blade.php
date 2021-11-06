<div class="advantages-content-wrap">
    <div class="title visible-viewportchecker visibility--check hidden">{{ trans('main.ourServices') }}</div>
    <div class="advantages-item-wrapper">
        @if(isset($services))
            @forelse($services as $service)
                <div class="elem-card visible-viewportchecker visibility--check">
                    <div class="content-card">
                        <div class="elem-img">
                            <img src="{{ asset('storage/services/'.$service->image) }}" alt="{{ $service->title }}">
                        </div>
                        <div class="elem-title">{{ $service->title }}</div>
                        @if($service->link)
                            <a href="{{$service->link}}" class="blank-link-news" target="_blank">
                                <span>{{ trans('main.details') }}</span>
                            </a>
                        @elseif($service->email)
                            <a href="#" class="link-news" data-servicesId="{{ $service->id }}">
                                <span>{{ trans('main.zayava') }}</span>
                            </a>
                        @endif
                    </div>
                </div>
            @empty
            @endforelse
        @endif


    </div>
</div>