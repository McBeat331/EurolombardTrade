<ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            LANGUAGE ({{config('app.locales')[app()->getLocale()]}})
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            @foreach(config('app.locales') as $locale=>$name)
                @if($locale == config('app.fallback_locale'))
                    <a class="dropdown-item" href="{{ url('/') }}">{{$name}}</a>
                @else
                    <a class="dropdown-item" href="{{ url($locale) }}">{{$name}}</a>
                @endif
            @endforeach
        </div>
    </li>
</ul>
