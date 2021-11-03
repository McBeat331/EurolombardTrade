@extends('layouts.404_page')

@section('content')
    <div class="mcontainer">
        <div class="wrapper-error-contant">
            <div class="title-error">
                <p>{{ trans('main.not_found1') }}</p>
                <p>{{ trans('main.not_found2') }}</p>
            </div>

            <div class="banner-er">
                <img src="/images/er-banner.png" alt="">
            </div>

            <div class="to-back">
                <a href="{{ route('main') }}">{{ trans('main.back_to_main') }}</a>
            </div>
        </div>
    </div>

@endsection