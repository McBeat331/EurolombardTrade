
    <li class="lang-btn">
        @foreach(config('app.locales') as $locale=>$name)
            @if($locale == config('app.fallback_locale'))
                    <span {{ app()->getLocale() === $locale ? 'class=active' : '' }}>
                        <a href="{{ url('/') }}" style="text-transform: uppercase">{{$locale}}</a>
                    </span>
            @else
                    <span {{ app()->getLocale() === $locale ? 'class=active' : '' }}>
                        <a class="dropdown-item" style="text-transform: uppercase" href="{{ url($locale) }}">{{$locale}}</a>
                    </span>
            @endif
        @endforeach
    </li>

