@extends('layouts.app')

@section('content')
    <div class="mcontainer thank-container">
        <div class="wrapper-thank">
            <div class="wrapp-title visible-viewportchecker visibility--check hidden">
                <div class="title">{{ trans('main.thanks_for') }}</div>
                <p>{{ trans('main.we_will_call') }}</p>
            </div>
            <div class="to-back">
                <a href="{{ route('main') }}">{{ trans('main.back_to_main') }}</a>
            </div>
        </div>
    </div>

@endsection
