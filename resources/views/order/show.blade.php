@extends('layouts.app')
@include('includes.meta_tags')
@section('content')

    <div class="mcontainer">
        <div class="title visible-viewportchecker visibility--check hidden">{{ trans('main.order_title') }}</div>
    </div>

    <section class="success-order">
        <div class="mcontainer">
            <div class="flexBlock">
                <div class="flexInfoItem">
                    <span class="infoLabel">{{ trans('main.your_order_give') }}</span>
                    <span class="infoValue infoCurrency">{{ $order->price_buy }} {{ $order->currency_sale }}</span>
                </div>
                <div class="flexInfoItem">
                    <span class="infoLabel">{{ trans('main.your_order_get') }}</span>
                    <span class="infoValue infoCurrency">{{ $order->price_sale }} {{ $order->currency_buy }}</span>
                </div>
                <div class="flexInfoItem">
                    <span class="infoLabel">{{ trans('main.your_order_course') }}</span>
                    <span class="infoValue infoRate">{{ $order->rate_sale }} {{ $order->currency_sale }}/{{ $order->currency_buy }}</span>
                    <span class="infoTip">{{ trans('main.order_tip') }}</span>
                </div>
            </div>
            <div class="flexBlock">
                <div class="flexInfoItem">
                    <span class="infoLabel">{{ trans('main.your_order_department') }}</span>
                    <span class="infoValue">{{ trans('main.cityLatter') }}{{ $currentCity->name }}, {{ $currentCity->addresses->first()->name }}</span>
                </div>
                <div class="flexInfoItem">
                    <span class="infoLabel">{{ trans('main.your_order_name') }}</span>
                    <span class="infoValue">{{ $order->fio }}</span>
                </div>
                <div class="flexInfoItem">
                    <span class="infoLabel">{{ trans('main.your_order_phone') }}</span>
                    <span class="infoValue">{{ $order->phone }}</span>
                </div>
                <div class="flexInfoItem">
                    <span class="infoLabel">{{ trans('main.your_order_mail') }}</span>
                    <span class="infoValue">{{ $order->email }}</span>
                </div>
            </div>
            <div class="linkBlock">
                <a href="{{ route('main') }}">{{ trans('main.back_to_main_short') }}</a>
            </div>
        </div>
    </section>

@endsection