@extends('layouts.app')
@include('includes.meta_tags')
@section('content')

    <div class="mcontainer">
        <div class="breadcrumbs">
            <ul class="breadcrumbs-wrap">
                <li class="breadcrumbs-link"><a href="{{ route('main') }}">{{ trans('main.main') }}</a></li>
                <span class="icon-bg-line"></span>
                <li class="breadcrumbs-link active-link">{{ __('main.offices') }}</li>
            </ul>
        </div>
        <div class="title visible-viewportchecker visibility--check hidden">{{ __('main.offices') }}</div>
    </div>

    <section class="office-departments">
        <div class="mcontainer">
            <div class="category-wrapper">
                <div class="filter-block">
                    <div class="chosen-wrapper select">
                        <span class="sup-title">{{ __('main.city') }}</span>
                        <span class="icon-arrow-down-gray"></span>
                        <select name="city" id="city_id">
                            <option value="empty">{{ __('main.choose_city') }}</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div id="categoriesMenu" class="wrap-tabs">
                    <div class="content-container">
                        <button data-target="tabBlock1" class="category tab active">{{ trans('main.on_the_map') }}</button>
                        <button data-target="tabBlock2" class="category tab">{{ trans('main.on_the_list') }}</button>
                    </div>
                </div>
            </div>
            <div class="toggle-block-list">
                <div id="tabBlock1" class="toggle-block active visible-viewportchecker visibility--check hidden">
                    <div class="map-wrapper">
                        <div id="departmentsMap" class="departments-map departmentMap"
                             data-lat="47.856350"
                             data-lng="35.106594"></div>
                    </div>
                </div>
                <div id="tabBlock2" class="toggle-block visible-viewportchecker visibility--check hidden">
                    <div class="departments-list-block">
                        <div class="departments-item">
                            <div class="departments-item__img">
                                <img src="/img/zp_sobor181.png" alt="">
                            </div>
                            <div class="departments-item__location">
                                <div class="item__city">{{ trans('main.address_city') }}</div>
                                <div class="item__street">{{ trans('main.address_street') }}</div>
                            </div>
                            <div class="departments-item__time">
                                <div class="item__time-description">{{ trans('main.time-description') }}</div>
                                <div class="item__time">{{ trans('main.time-work') }}</div>
                            </div>
                            <div class="departments-item__phone">
                                <div class="item__phone-description">{{ trans('main.contacts') }}</div>
                                <div class="item__phone">
                                    <a href="tel:+380671000000">067 100 00 00</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="career-callback-form visible-viewportchecker visibility--check hidden">
        <div class="mcontainer">
            @include('includes.callback-questions-form-front')
        </div>
    </section>

@endsection