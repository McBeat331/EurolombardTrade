@extends('layouts.app')
@include('includes.meta_tags')
@section('content')

    <div class="mainTitle mcontainer">{!! trans('main.MainTitle') !!}</div>

    <div class="main-wrap-calc mcontainer" id="rateBlock">
        <example-component></example-component>
    </div>


    <section class="services-section" id="serviceBlock">
        <div class="mcontainer">
            @include('includes.main-smail-slide-front')
        </div>
    </section>

     <section class="advantages-section" id="advantageBlock">
    <div class="mcontainer">
        @include('includes.advantages-company-front')
            </div>
        </section>

    <section class="common-questions">
        <div class="mcontainer">
            @include('includes.common-questions-front')
        </div>
    </section>


    <section class="review-submission small-slide-section visible-viewportchecker visibility--check hidden">
        <div class="mcontainer">
            <div class="review-wrap-section">
                <span class="icon-bg-line"></span>
                <div class="title">{{ trans('main.feedbacks') }}</div>
                <div class="init-review-slide">
                    @if(isset($reviews))
                    @forelse($reviews as $feedbackItem)
                        <div class="el-review">
                            {{$feedbackItem->description}}
                            <span>{{$feedbackItem->name}}</span>
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