
    <li class="lang-btn">
        @foreach(config('app.locales') as $locale=>$name)
            @if($locale == config('app.fallback_locale'))
                    <span {{ app()->getLocale() === $locale ? 'class=active' : '' }}>
                        <a href="{{ url('/') }}">UA</a>
                    </span>
                <a class="dropdown-item" href="{{ url('/') }}">{{$name}}</a>
            @else
                    <span {{ app()->getLocale() === $locale ? 'class=active' : '' }}>
                        <a class="dropdown-item" href="{{ url($locale) }}">{{$name}}</a>
                    </span>
            @endif
        @endforeach
    </li>

