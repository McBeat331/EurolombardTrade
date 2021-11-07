@extends('layouts.app')
@include('includes.meta_tags')
@section('content')

    <div class="mcontainer">
        <div class="title visible-viewportchecker visibility--check hidden">{{ trans('main.contact_title') }}</div>
    </div>

    <section class="office-departments">
        <div class="mcontainer">
            <div id="tabBlock2" class="toggle-block visible-viewportchecker visibility--check hidden">
                <div class="departments-list-block">
                    @foreach(addressSelectedCity()->addresses as $address)
                    <div class="departments-item">

                        <div class="departments-item__location">
                            <div class="item__city">{{ trans('main.cityLatter') }} {{ addressSelectedCity()->name }}</div>
                            <div class="item__street">{{ $address->name }}</div>
                        </div>
                        <div class="departments-item__time">
                            <div class="item__time-description">{{ trans('main.time-description') }}</div>
                            <div class="item__time">
                                @if($address->round_the_clock == 1)
                                    {{ trans('main.time-work') }}
                                    @else
                                    {{ $address->time_work }}
                                @endif
                            </div>
                        </div>
                        <div class="departments-item__phone">
                            <div class="item__phone-description">{{ trans('main.contacts') }}</div>
                            <div class="item__phone">
                                <a href="tel:{{ $address->phones }}">{{ $address->phones }}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
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

            </div>
        </div>
    </section>

    <section class="common-questions visible-viewportchecker visibility--check hidden">
        <div class="mcontainer">
            @include('includes.callback-questions-form-front')
        </div>
    </section>

@endsection