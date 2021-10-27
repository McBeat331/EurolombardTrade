@extends('layouts.app')
@include('includes.meta_tags')
@section('content')

    <div class="wrap-content-banners">

        <div class="init-banner-slick">
            @if(isset($banners))
                @foreach($banners as $banner)
                    <div class="item-banner">
                        <picture>
                            <source srcset="{{ asset('storage/images/banners/'.$banner->image_mobile) }}" media="(max-width: 665px)" type="image/jpg">
                            <source srcset="{{ asset('storage/images/banners/'.$banner->image) }}" media="(min-width: 666px)" type="image/jpg">
                            <img srcset="" alt="">
                        </picture>
                        <div class="wrap-descript-content-banner">
                            <div class="title-content-banner">{!!  $banner['title_'.$locale] !!}</div>
                            <div class="subtitle-content-banner">
                                {!! $banner['description_'.$locale] !!}
                            </div>
                            <a href="{{ $banner->link }}"><button class="button">{{ $banner['button_name_'.$locale] }}</button></a>
                        </div>
                    </div>
                @endforeach
            @endif


        </div>

        <div class="control-slide">
            <div class="interface-widget">
                <ul class="arrow-list">
                    <li class="next-main-banner">
                        <span class="icon-arrow-l-primaryColor"></span>
                    </li>
                    <li class="prev-main-banner">
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
        </div>

    </div>

    <div class="main-wrap-calc">
        <example-component :show-tabs="true"></example-component>
    </div>

    <section class="advantages-section">
        <div class="mcontainer">
            @include('includes.advantages-company-front')
        </div>
    </section>

    <section class="pictorial-section">
        <div class="mcontainer">
            @include('includes.pictorial-value-front')
        </div>
    </section>

    <!-- <section class="advantages-section">
    <div class="mcontainer">
        @include('includes.advantages-company-front')
            </div>
        </section> -->

    <section class="new-action-section small-slide-section">
        <div class="mcontainer">
            @include('includes.main-smail-slide-front')
        </div>
    </section>

    <section class="common-questions">
        <div class="mcontainer">
            @include('includes.common-questions-front')
        </div>
    </section>

    <section class="new-news-section small-slide-section">
        <div class="mcontainer">
            @include('includes.main-smail-slide-front-news')

        </div>
    </section>

    <section class="review-submission small-slide-section visible-viewportchecker visibility--check hidden">
        <div class="mcontainer">
            <div class="review-wrap-section">
                <span class="icon-bg-line"></span>
                <div class="title">{{ trans('main.feedbacks') }}</div>
                <div class="init-review-slide">
                    @if(isset($feedback))
                    @forelse($feedback as $feedbackItem)
                        <div class="el-review">
                            {{$feedbackItem->body}}
                            <span>{{$feedbackItem->name}}, {{$feedbackItem->city}}</span>
                        </div>
                    @empty
                    @endforelse
                        @endif
                </div>
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
                    <button class="button btn-modal_review">{{ trans('main.feedback_send') }}</button>
                </div>
            </div>
        </div>
    </section>

@endsection