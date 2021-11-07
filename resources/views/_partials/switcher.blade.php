
    <li class="lang-btn">
        @foreach(config('app.locales') as $locale=>$name)
            <span {{ app()->getLocale() === $locale ? 'class=active' : '' }}>
                <a class="dropdown-item" style="text-transform: uppercase" href="{{ getRouteLocaleUrl($locale) }}">{{$locale}}</a>
            </span>
        @endforeach
    </li>

